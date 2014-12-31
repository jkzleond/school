<?php
/**
 * Created by PhpStorm.
 * User: jkzleond
 * Date: 14-12-23
 * Time: 下午7:41
 */

class Subject extends Module_Admin
{
    public function construct()
    {
        $this->load->model('achievement_subject_model', 'subject_model', false);
    }

    public function create()
    {
        $this->subject_model->feed_blank_template($this->template);
        $this->output('admin/subject_detail');
    }

    public function edit($id)
    {
        $this->subject_model->feed_template($id, $this->template);
        $this->output('admin/subject_detail');
    }

    public function save()
    {
        $data = $this->input->post();
        if($data['name'] != '' and $data['title'] != '')
        {
            $this->subject_model->save($data);
            $this->update[] = array(
                'element' => 'moduleAchievementSubjectHeadList',
                'url' => 'module/achievement/subject/get_list/head'
            );
            $this->update[] = array(
                'element' => 'moduleAchievementSubjectList',
                'url' => 'module/achievement/subject/get_list'
            );
            $this->callback = array(
                'fn' => 'ION.fireEvent',
                'args' => array(
                    'achievement.subject.data.change'
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
        if(!empty($id) and $this->subject_model->delete($id) > 0)
        {
            $this->update[] = array(
                'element' => 'moduleAchievementSubjectHeadList',
                'url' => 'module/achievement/subject/get_list/head'
            );
            $this->update[] = array(
                'element' => 'moduleAchievementSubjectList',
                'url' => 'module/achievement/subject/get_list'
            );
            $this->callback = array(
                'fn' => 'ION.fireEvent',
                'args' => array(
                    'achievement.subject.data.change'
                )
            );
            $this->success(lang('ionize_message_operation_ok'));
        }
        else
        {
            $this->error('ionize_message_operation_nok');
        }
    }

    public function get_list($view='main')
    {
        $condition = array(
            'order_by' => 'ordering ASC'
        );
        $this->template['subjects'] = $this->subject_model->get_list($condition);
        $this->output('admin/subject_'.$view.'_list');
    }

    public function manage()
    {
        $this->output('admin/subject_manage');
    }
}