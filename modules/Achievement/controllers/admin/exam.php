<?php
/**
 * Created by PhpStorm.
 * User: jkzleond
 * Date: 14-12-23
 * Time: 下午7:36
 */

class Exam extends Module_Admin
{
    public function construct()
    {
        $this->load->model('achievement_exam_model', 'exam_model', false);
    }

    public function create()
    {
        $this->exam_model->feed_blank_template($this->template);
        $this->output('admin/exam_detail');
    }

    public function edit($id)
    {
        $this->exam_model->feed_template($id, $this->template);
        $this->output('admin/exam_detail');
    }

    public function save()
    {
        $data = $this->input->post();
        if($data['name'] != '' and $data['start_date'] != '')
        {
            $this->exam_model->save($this->input->post());
            $this->update[] = array(
                'element' => 'moduleAchievementExamSelect',
                'url' => 'module/achievement/exam/get_list/option'
            );
            $this->update[] = array(
                'element' => 'moduleAchievementExamList',
                'url' => 'module/achievement/exam/get_list'
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
        if($this->exam_model->delete($id) > 0)
        {
            $this->update[] = array(
                'element' => 'moduleAchievementExamSelect',
                'url' => 'module/achievement/exam/get_list/option'
            );
            $this->update[] = array(
                'element' => 'moduleAchievementExamList',
                'url' => 'module/achievement/exam/get_list'
            );
            $this->success(lang('ionize_message_operation_ok'));
        }
        else
        {
            $this->error('ionize_message_operation_nok');
        }
    }

    /**
     * @param string $view
     * @param string $selected represent a selected option when $view == 'option'
     */
    public function get_list($view='', $selected='')
    {
        $condition = array(
            'order_by' => 'start_date DESC'
        );
        $this->template['exams'] = $this->exam_model->get_list($condition);
        if($view == 'option')
        {
            $this->template['selected'] = $selected;
        }
        $view = $view != ''?'_'.$view:$view;

        $this->output('admin/exam'.$view.'_list');
    }

    public function manage()
    {
        $this->output('admin/exam_manage');
    }
}