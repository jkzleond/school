<?php
/**
 * Created by PhpStorm.
 * User: jkzleond
 * Date: 14-12-22
 * Time: 下午9:27
 */


class Achievement_subject_model extends Base_model
{
    public $table = 'mod_achievement_subject';
    public $pk_name = 'id';

    public function __construct()
    {
        parent::__construct();
    }
}