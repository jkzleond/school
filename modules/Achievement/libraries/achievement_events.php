<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Achievement_Events {

    public static $ci;

    public function __construct()
    {
        self::$ci = get_instance();
        Event::register('Archievement.score.change', array($this, 'save_ranks'));
    }

    public function save_ranks()
    {

    }
} 