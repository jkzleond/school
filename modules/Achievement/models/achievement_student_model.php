<?php
/**
 * Created by PhpStorm.
 * User: jkzleond
 * Date: 14-12-22
 * Time: 下午9:26
 */

class Achievement_student_model extends Base_model
{
    public $table = 'mod_achievement_student';
    public $pk_name = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function save($data)
    {
        if(!$this->_check_before_save($data))
        {
            return false;
        }
        return parent::save($data);

    }

    public function _check_before_save($data)
    {
        return !empty($data['id']) or !$this->exists(array('number' => $data['number']));
    }
}