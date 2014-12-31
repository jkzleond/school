<?php
/**
 * Created by PhpStorm.
 * User: jkzleond
 * Date: 14-12-21
 * Time: 上午3:23
 */

include_once dirname(__FILE__).'/MyArticles.php';

class TagManager_Assoc extends TagManager_MyArticles
{
    public static $tag_definitions = array(
        'assoc:article' => 'tag_articles_article',
        'article:assoc' => 'tag_article_assoc',
    );

    /**
     * get associative articles of a article
     * @param FTL_Binding $tag
     * @return string
     */
    public static function tag_article_assoc(FTL_Binding $tag)
    {
        $cache = $tag->getAttribute('cache', TRUE);

        if ($cache == TRUE && ($str = self::get_cache($tag)) !== FALSE)
            return $str;

        $article = $tag->get('article');

        if(is_null($article))
        {
           return;
        }

        self::create_extend_tags($tag, 'article');

        $title = $article['title'];

        self::$ci->load->helper('scws');
        $words = get_scws_words(array('data'=>$title, 'attr'=>''));
//        $words = json_decode($scws, true)['words'];
        $available_words = array();
        foreach($words as $word)
        {
//            if(in_array($word['attr'], array('n', 'an', 'nr', 'ns', 'nt', 'nz', 'vn')))
//            {
                $available_words[] = $word['word'];
//            }
        }
        $articles = self::get_assoc_articles($available_words, $tag);
        self::init_articles_urls($articles);
        self::init_articles_views($articles);
        $articles = self::prepare_articles($tag, $articles);
        $count = count($articles);
        $tag->set('articles', $articles);
        $tag->set('count', $count);
        $str = '';
        foreach($articles as $article)
        {
            $tag->set('article', $article);
            $tag->set('count', $count);
            $str .= $tag->expand();
        }

        $str = self::wrap($tag, $str);
        self::set_cache($tag, $str);
        return $str;
    }

    public static function get_assoc_articles($assoc_words, $tag)
    {
        if(empty($assoc_words))
        {
            return array();
        }
        $where = array();
        $limit = $tag->getAttribute('limit');
        if($limit > 0)
        {
            $where['limit'] = $limit;
        }
        foreach($assoc_words as $word)
        {
            $likes[] = 'article_lang.title LIKE \'%' . $word .'%\'';
        }
        if(!empty($likes))
        {
            $where[] = '(' . implode(' OR ', $likes)  .')';
        }
        $lang = Settings::get_lang();
        return self::$ci->article_model->get_lang_list($where, $lang);
    }

}