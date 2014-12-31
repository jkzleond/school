<?php
/**
 * Created by PhpStorm.
 * User: jkzleond
 * Date: 14-12-23
 * Time: 下午7:43
 */

class Grade extends Module_Admin
{
    public function construct()
    {
        $this->load->model('achievement_grade_model', 'grade_model', false);
    }

    public function create()
    {
        $this->grade_model->feed_blank_template($this->template);
        $this->output('admin/grade_detail');
    }

    public function edit($id)
    {
        $this->grade_model->feed_template($id, $this->template);
        $this->output('admin/grade_detail');
    }

    public function save()
    {
        if($this->input->post('name') != '')
        {
            $this->grade_model->save($this->input->post());
            $this->update = array(
                array(
                    'element' => 'moduleAchievementGradeList',
                    'url' => 'module/achievement/grade/get_list'
                ),
                array(
                    'element' => 'moduleAchievementGradeSelect',
                    'url' => 'module/achievement/grade/get_list/option'
                )
            );
            $this->success(lang('ionize_message_operation_ok'));
        }
        else
        {
            $this->error(lang('ionize_message_operation_nok'));
        }
    }

    public function delete($id)
    {
        if($this->grade_model->delete($id) > 0)
        {
            $this->update = array(
                array(
                    'element' => 'moduleAchievementGradeList',
                    'url' => 'module/achievement/grade/get_list'
                ),
                array(
                    'element' => 'moduleAchievementGradeSelect',
                    'url' => 'module/achievement/grade/get_list/option'
                )
            );
            $this->success(lang('ionize_message_operation_ok'));
        }
        else
        {
            $this->error('ionize_message_operation_nok');
        }
    }

    public function get_list($view='', $selected='')
    {
        $condition = array(
            'order_by' => 'name ASC'
        );
        $this->template['grades'] = $this->grade_model->get_list($condition);
        if($view == 'option')
        {
            $this->template['selected'] = $selected;
        }
        $view = $view != ''?'_'.$view:$view;
        $this->output('admin/grade'.$view.'_list');
    }

    public function manage()
    {
        $this->output('admin/grade_manage');
    }
}