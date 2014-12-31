<?php
/**
 * Created by PhpStorm.
 * User: jkzleond
 * Date: 14-12-23
 * Time: 下午7:43
 */

class Student extends Module_Admin
{
    public function construct()
    {
        $this->load->model('achievement_student_model', 'student_model', false);
    }

    public function create()
    {
        $this->student_model->feed_blank_template($this->template);
        $this->template['grade'] = '';
        $this->template['grade_id'] = '';
        $this->template['class'] = '';
        $this->template['class_id'] = '';
        $this->output('admin/student_detail');
    }

    public function edit($id)
    {
        $this->student_model->feed_template($id, $this->template);
        $this->output('admin/student_detail');
    }

    public function save()
    {
        $data = $this->input->post();
        if($data['name'] != '' and $data['number'] != '' and $data['grade_id'] != '' and $data['class_id'] != '' and $this->student_model->save($data) !== false)
        {
            /*$this->update[] = array(
                'element' => 'moduleAchievementStudentList',
                'url' => 'module/achievement/student/get_list'
            );*/
            $this->callback[] = array(
                'fn' => 'ION.fireEvent',
                'args' =>array(
                    'achievement.student.data.change'
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
        if(!empty($id) and $this->student_model->delete($id) > 0)
        {
//            $this->update = array(
//                array(
//                    'element' => 'moduleAchievementStudentList',
//                    'url' => 'module/achievement/student/get_list'
//                )
//            );
            $this->callback[] = array(
                'fn' => 'function(){$(document).fireEvent("achievement.student.data.change")}'
            );
            $this->success(lang('ionize_message_operation_ok'));
        }
        else
        {
            $this->error('ionize_message_operation_nok');
        }
    }

    public function get_list($grade_id='any', $klass_id='any', $number='any')
    {
        $condition = array(
            'order_by' => 'number ASC'
        );
        $grade_id !== 'any' and $condition['grade_id'] = $grade_id;
        $klass_id !== 'any' and $condition['class_id'] = $klass_id;
        if($number !== 'any')
        {
            if(is_numeric($number))
            {
                $condition['number'] = $number;
            }
            else
            {
                $condition['name'] = urldecode($number);
            }
        }
        $this->template['students'] = $this->student_model->get_list($condition);
        $this->output('admin/student_list');
    }

    public function manage()
    {
        $this->output('admin/student_manage');
    }
}