<?php
/**
 * Created by PhpStorm.
 * User: jkzleond
 * Date: 14-12-18
 * Time: 上午1:01
 */


class TagManager_Today extends TagManager
{
    public static $tag_definitions = array(
        'today' => 'tag_today',
        'today:week_day' => 'tag_today_week_day',
    );


    public static function tag_today(FTL_Binding $tag)
    {
        $format = $tag->getAttribute('format');
        if (!empty($tag->block))
        {
            return $tag->expand();
        }
        return date($format);
    }

    public static function tag_today_week_day(FTL_Binding $tag)
    {
        $week_day = strtolower(date('l'));
        self::$ci->lang->load('date');
        return self::$ci->lang->line($week_day);
    }
}