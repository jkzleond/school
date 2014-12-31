<?php
/**
 * Created by PhpStorm.
 * User: jkzleond
 * Date: 14-12-19
 * Time: 下午1:39
 */

class TagManager_MyArticles extends TagManager_Article
{
    public static $tag_definitions = array(
        'articles' => 'tag_articles',
    );

    /**
     * Expand the articles
     *
     * @param	FTL_Binding object
     *
     * @return	String
     *
     */
    public static function tag_articles(FTL_Binding $tag)
    {
        $cache = $tag->getAttribute('cache', TRUE);

        // Tag cache
        if ($cache == TRUE && ($str = self::get_cache($tag)) !== FALSE)
            return $str;

        // Returned string
        $str = '';

        // Extend Fields tags
        self::create_extend_tags($tag, 'article');

        // Articles
        $_articles = self::get_articles($tag);
        $_articles = self::prepare_articles($tag, $_articles);

        // Tag data
        $count = count($_articles);
        $tag->set('count', $count);

        // Make articles in random order
        if ( $tag->getAttribute('random') == TRUE)
            shuffle($_articles);

        $tag->set('articles', $_articles);

        // Add data like URL to each article
        // and finally render each article
        foreach($_articles as $key => $article)
        {
            $tag->set('article', $article);

            // Set by self::prepare_articles()
            // $tag->set('index', $key);
            $tag->set('count', $count);

            $str .= $tag->expand();
        }

        // Experimental : To allow tags in articles
        // $str = $tag->parse_as_nested($str);

        $str = self::wrap($tag, $str);

        // Tag cache
        self::set_cache($tag, $str);

        return $str;
    }



    /**
     * Get Articles
     * @TODO : 	Write local cache
     *
     * @param	FTL_Binding
     * @return	Array
     *
     * 1. Try to get the articles from a special URI
     * 2. Get the articles from the current page
     * 3. Filter on the article name if the article name is in URI segment 1
     *
     */
    public static function get_articles(FTL_Binding $tag)
    {
        // Page. 1. Local one, 2. Current page (should never arrived except if the tag is used without the 'page' parent tag)
        $page = $tag->get('page');

        // Only get all articles (no limit to one page) if asked.
        // Filter by current page by default
        if (empty($page) && $tag->getAttribute('all') == NULL)
        {
            $page = self::registry('page');
        }

        if($tag->getAttribute('recursion') != NULL && $tag->getAttribute('all') == NULL )
        {
            $page['ids_page'] = self::$ci->page_model->get_children_ids($page['id_page'], TRUE);
        }

        // Set by Page::get_current_page()
        $is_current_page = isset($page['__current__']) ? TRUE : FALSE;

        // Pagination
        $tag_pagination = $tag->getAttribute('pagination');

        $ionize_pagination = $page['pagination'];

        // Authorizations
        $tag_authorization = $tag->getAttribute('authorization');

        // Type filter, limit, SQL filter
        $type = $tag->getAttribute('type');
        $nb_to_display = $tag->getAttribute('limit', 0);
        $filter = $tag->getAttribute('filter');

        if( ! is_null($filter) )
            $filter = self::process_filter($filter);

        // URL based process of special URI only allowed on current page
        $special_uri_array = self::get_special_uri_array();

        if ($is_current_page)
        {
            // Special URI process
            if ( ! is_null($special_uri_array))
            {
                foreach($special_uri_array as $_callback => $args)
                {
                    if (method_exists(__CLASS__, 'add_articles_filter_'.$_callback))
                        call_user_func(array(__CLASS__, 'add_articles_filter_'.$_callback), $tag, $args);
                }
            }
            // Deactivate "limit" if one pagination is set
            if ($tag_pagination OR $ionize_pagination) $nb_to_display = 0;
        }
        else
        {
            // Deactivate Ionize pagination (Only available of the current page)
            $ionize_pagination = NULL;

            // Deactivate limit if the "pagination" attribute is set
            if ($tag_pagination) $nb_to_display = 0;
        }

        // If pagination is only set by the tag : Call the pagination filter
        if ($tag_pagination)
        {
            if ( is_null($special_uri_array) OR ! array_key_exists('pagination', $special_uri_array))
                self::add_articles_filter_pagination($tag);
        }

        // from categories ?
        // @TODO : Find a way to display articles from a given category : filter ?
        $from_categories = $tag->getAttribute('from_categories');
        $from_categories_condition = ($tag->getAttribute('from_categories_condition') != NULL && $tag->attr['from_categories_condition'] != 'or') ? 'and' : 'or';

        /*
         * Preparing WHERE on articles
         * From where do we get the article : from a page, from the parent page or from the all website ?
         *
         */
        // Order. Default order : ordering ASC
        $order_by = $tag->getAttribute('order_by', 'id_page, ordering ASC');
        $where = array('order_by' => $order_by);

        // Add type to the where array
        if ( ! is_null($type))
        {
            if ($type == '') {
                $where['article_type.type'] = 'NULL';
                $type = NULL;
            }
            else
            {
                if (strpos($type, ',') !== FALSE)
                {
                    $type = preg_replace('/\s+/', '', $type);
                    $type = explode(',', $type);
                    foreach($type as $k=>$t)
                        if (empty($t))
                            unset($type[$k]);

                    $where['where_in'] = array('article_type.type' => $type);
                }
                else
                {
                    $where['article_type.type'] = $type;
                }
            }
        }

        // Get only articles from the detected page
        if ( ! empty($page) && isset($page['ids_page']))
        {
            $where['where_in']['id_page'] = $page['ids_page'];
        }elseif ( !empty($page) )
        {
            $where['id_page'] = $page['id_page'];
        }

        // Set Limit : First : pagination, Second : limit
        $limit = $tag_pagination ? $tag_pagination : $ionize_pagination;
        if ( ! $limit && $nb_to_display > 0) $limit = $nb_to_display;
        if ( $limit ) $where['limit'] = $limit;

        // Get from DB
        $articles = self::$ci->article_model->get_lang_list(
            $where,
            $lang = Settings::get_lang(),
            $filter
        );

        $articles = self::filter_articles($tag, $articles);

        // Filter on authorizations
        if (User()->get('role_level') < 1000)
        {
            $articles = self::_filter_articles_authorization($articles, $tag_authorization);
        }

        // Pagination needs the total number of articles, without the pagination filter
        // TODO : Integrates authorizations in articles count
        if ($tag_pagination OR $ionize_pagination)
        {
            $nb_total_articles = self::count_nb_total_articles($tag, $where, $filter);
            $tag->set('nb_total_items', $nb_total_articles);
        }

        self::init_articles_urls($articles);

        self::init_articles_views($articles);

        return $articles;
    }

    // ------------------------------------------------------------------------


    /**
     * Prepare the articles array
     *
     * @param FTL_Binding	$tag
     * @param Array 		$articles
     *
     * @return	Array		Articles
     *
     */
    protected static function prepare_articles(FTL_Binding $tag, $articles)
    {
        // Articles index starts at 1.
        $index = 1;

        // view
        $view = $tag->getAttribute('view');

        // paragraph limit ?
        $paragraph = $tag->getAttribute('paragraph');

        // auto_link
        // Removed because of double execution
        // (also done by the Tagmanager)
        // $auto_link = $tag->getAttribute('auto_link', TRUE);

        // Last part of the URI
        $uri_last_part = array_pop(explode('/', uri_string()));

        $count = count($articles);

        foreach($articles as $key => $article)
        {
            // Force the view if the "view" attribute is defined
            if ( ! is_null($view))
                $articles[$key]['view'] = $view;

            $articles[$key]['active_class'] = '';

            $article_url = array_pop(explode('/', $article['url']));
            $articles[$key]['is_active'] = ($uri_last_part == $article_url);

            if (!is_null($tag->getAttribute('active_class')))
            {
                if ($uri_last_part == $article_url)
                    $articles[$key]['active_class'] = $tag->attr['active_class'];
            }

            // Limit to x paragraph if the attribute is set
            if ( ! is_null($paragraph))
                $articles[$key]['content'] = tag_limiter($article['content'], 'p', intval($paragraph));

            // Autolink the content
//			if ($auto_link)
//				$articles[$key]['content'] = auto_link($articles[$key]['content'], 'both', TRUE);

            // Article's index
            $articles[$key]['index'] = $index++;

            // Article's count
            $articles[$key]['count'] = $count;

            // Article's ID
            $articles[$key]['id'] = $articles[$key]['id_article'];

        }

        return $articles;
    }

    /**
     * Inits, for each article, the view to use.
     *
     * @param $articles
     *
     */
    protected function init_articles_views(&$articles)
    {
        $nb = count($articles);

        foreach ($articles as $k=>$article)
        {
            if (empty($article['view']))
            {
                if ($nb > 1 && ! empty($article['article_list_view']))
                {
                    $articles[$k]['view'] = $article['article_list_view'];
                }
                else if (! empty($article['article_view']))
                {
                    $articles[$k]['view'] = $article['article_view'];
                }
            }
        }
    }


    /**
     * Filters the articles regarding range.
     *
     */
    public static function filter_articles(FTL_Binding $tag, $articles)
    {
        // Range : Start and stop index, coma separated
        $range = $tag->getAttribute('range');
        if (!is_null($range))
            $range = explode(',', $range);

        // Number of wished displayed medias
        $limit = $tag->getAttribute('limit');

        $from = $to = FALSE;

        if (is_array($range))
        {
            $from = $range[0];
            $to = (isset($range[1]) && $range[1] >= $range[0]) ? $range[1] : FALSE;
        }

        // Return list ?
        // If set to "list", will return the list, coma separated.
        // Usefull for javascript
        // Not yet implemented
        $return = $tag->getAttribute('return', FALSE);

        if ( ! empty($articles))
        {
            // Range / Limit ?
            if ( ! is_null($range))
            {
                $length = ($to !== FALSE) ? $to + 1 - $from  : count($articles) + 1 - $from;

                if ($limit > 0 && $limit < $length) $length = $limit;

                $from = $from -1;

                $articles = array_slice($articles, $from, $length);
            }
            else if ($limit > 0)
            {
                $articles = array_slice($articles, 0, $limit);
            }


            // Other filters
            if ( ! empty($articles))
            {
                // $keys = array_keys($filtered_medias[0]);
                $attributes = $tag->getAttributes();
                $attributes = array_diff(array_keys($attributes), array('tag', 'class', 'type', 'order_by', 'range', 'limit', 'filter', 'return'));

                if ( ! empty($attributes))
                {
                    $filtered_articles = array();

                    while(!empty($articles))
                    {
                        $article = array_pop($articles);
                        $is_filtered = true;
                        foreach($attributes as $attribute)
                        {
                            if(isset($article[$attribute]) && $article[$attribute] != $tag->getAttribute($attribute))
                            {
                                $is_filtered = false;
                                break;
                            }
                        }
                        if($is_filtered)
                        {
                            $filtered_articles[] = $article;
                        }
                    }

                    $articles = $filtered_articles;
                }
            }
        }

        return $articles;
    }


    private static function _filter_articles_authorization($articles, $filter_codes=NULL)
    {
        if ( is_string($filter_codes) ) $filter_codes = explode(',', $filter_codes);
        $codes = array();

        if ( is_array($filter_codes))
        {
            foreach($filter_codes as $code)
                $codes[] = trim($code);
        }

        if (in_array('all', $codes) && count($codes) == 1)
            return $articles;

        $return = array();

        foreach ($articles as $article)
        {
            $resource = 'frontend/article/' . $article['id_article'];

            if ( Authority::cannot('access', $resource, NULL, TRUE))
            {
                if (empty($codes))
                    continue;

                if (in_array($article['deny_code'], $codes))
                    $return[] = $article;
            }
            else
            {
                if (in_array('all', $codes))
                    $return[] = $article;

                else if ( ! empty($codes))
                    continue;

                else
                    $return[] = $article;
            }
        }

        return $return;
    }

}