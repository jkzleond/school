<?php
/**
 * Created by PhpStorm.
 * User: jkzleond
 * Date: 14-12-22
 * Time: 下午9:26
 */

class Achievement_exam_model extends Base_model
{
    public $table = 'mod_achievement_exam';
    public $pk_name = 'id';

    public function __construct()
    {
        parent::__construct();
    }
}