<?php
/**
 * Created by PhpStorm.
 * User: jkzleond
 * Date: 14-12-23
 * Time: 下午7:43
 */

class Klass extends Module_Admin
{
    public function construct()
    {
        $this->load->model('achievement_klass_model', 'klass_model', false);
    }

    public function create()
    {
        $this->klass_model->feed_blank_template($this->template);
        $this->output('admin/klass_detail');
    }

    public function edit($id)
    {
        $this->klass_model->feed_template($id, $this->template);
        $this->output('admin/klass_detail');
    }

    public function save()
    {
        if($this->input->post('name') != '')
        {
            $this->klass_model->save($this->input->post());
            $this->update = array(
                array(
                    'element' => 'moduleAchievementClassList',
                    'url' => 'module/achievement/klass/get_list'
                ),
                array(
                    'element' => 'moduleAchievementClassSelect',
                    'url' => 'module/achievement/klass/get_list/option'
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
        if($this->klass_model->delete($id) > 0)
        {
            $this->update = array(
                array(
                    'element' => 'moduleAchievementClassList',
                    'url' => 'module/achievement/klass/get_list'
                ),
                array(
                    'element' => 'moduleAchievementClassSelect',
                    'url' => 'module/achievement/klass/get_list/option'
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
        $this->template['klasses'] = $this->klass_model->get_list($condition);
        if($view == 'option')
        {
            $this->template['selected'] = $selected;
        }
        $view = $view != ''?'_'.$view:$view;
        $this->output('admin/klass'.$view.'_list');
    }

    public function manage()
    {
        $this->output('admin/klass_manage');
    }
}