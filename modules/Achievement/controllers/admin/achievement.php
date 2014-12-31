<?php
/**
 * Created by PhpStorm.
 * User: jkzleond
 * Date: 14-12-22
 * Time: 上午1:55
 */

class Achievement extends Module_Admin
{

    public function construct()
    {
        $this->load->model('achievement_achieve_model', 'achieve_model', false);
    }

    public function index()
    {
        $this->output('admin/index');
    }

    public function save()
    {
        $data = $this->input->post();

        if(!empty($data['scores']) and is_array($data['scores']))
        {
            $this->achieve_model->save($data);
            $this->callback[] = array(
                'fn' => 'ION.fireEvent',
                'args' => 'achievement.achieve.data.change'
            );
            $this->success(lang('ionize_message_operation_ok'));
        }
        else
        {
            $this->error(lang('ionize_message_operation_nok'));
        }
    }

    public function delete($exam_id,$student_id)
    {
        $where = array(
            'exam_id' => $exam_id,
            'student_id' => $student_id
        );
        if($this->achieve_model->delete($where) > 0)
        {
            $this->callback[] = array(
                'fn' => 'ION.fireEvent',
                'args' => 'achievement.achieve.data.change'
            );
            $this->success(lang('ionize_message_operation_ok'));
        }
        else
        {
            $this->error('ionize_message_operation_nok');
        }
    }

    public function get_list($exam_id='any', $grade_id='any',$class_id='any', $student_number='any', $limit=30, $page=1)
    {
        $condition = array(
            'order_by' => 'student_number ASC, exam.start_date DESC, subject.ordering ASC'
        );

        $exam_id !== 'any'  and $condition['exam_id'] = $exam_id;
        $grade_id !== 'any' and $condition['grade_id'] = $grade_id;
        $class_id !== 'any' and $condition['class_id'] = $class_id;
        if($student_number !== 'any')
        {
            if(is_numeric($student_number))
            {
                $condition['student_number'] = $student_number;
            }
            else
            {
                $condition['student_name'] = urldecode($student_number);
            }
        }
        $condition['limit'] = $limit;
        $condition['offset'] = $limit*($page-1);

        $achieves = $this->achieve_model->with_count()->get_list($condition);

        $this->template['achieves'] = $achieves;
        $this->template['limit'] = $limit;
        $this->template['page'] = $page;
        $this->output('admin/achieve_list');
    }
}