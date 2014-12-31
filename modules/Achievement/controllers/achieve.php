<?php
/**
 * Created by PhpStorm.
 * User: jkzleond
 * Date: 14-12-22
 * Time: 上午1:41
 */

class Achieve extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        redirect();
    }

    public function get_list($student_number, $student_name, $exam_id='any', $limit=1){
        $this->load->model('achievement_achieve_model','achieve_model');
        $condition = array(
            'order_by' => 'student_number ASC, exam.start_date DESC, subject.ordering ASC'
        );

        $exam_id !== 'any'  and $condition['exam_id'] = $exam_id;
        $condition['student_number'] = $student_number;
        $condition['student_name'] = urldecode($student_name);
        $condition['limit'] = $limit;

        $achieves = $this->achieve_model->get_list($condition);
        $this->xhr_output($achieves);
    }

    public function get_subject()
    {
        $this->load->model('achievement_subject_model', 'subject_model');
        $condition = array(
            'order_by' => 'ordering ASC'
        );
        $subjects = $this->subject_model->get_list($condition);
        $this->xhr_output($subjects);
    }

    public function get_exam()
    {
        $this->load->model('achievement_exam_model', 'exam_model');
        $condition = array(
            'order_by' => 'start_date DESC'
        );
        $exams = $this->exam_model->get_list($condition);

        $this->xhr_output($exams);
    }
} 