<?php
/**
 * Created by PhpStorm.
 * User: jkzleond
 * Date: 14-12-22
 * Time: 下午9:26
 */

class Achievement_achieve_model extends Base_model
{
    public $table = 'mod_achievement_achieve';
    public $student_table = 'mod_achievement_student';
    public $exam_table = 'mod_achievement_exam';
    public $subject_table = 'mod_achievement_subject';
    public $pk_names = array('student_id', 'exam_id', 'subject_id');

    private $_with_count = false;

    public function __construct()
    {
        parent::__construct();
    }

    public function save($data){
        $cleaned_datas = array();
        foreach($data['scores'] as $score)
        {
            $cleaned_datas[] = $this->clean_data($score);
        }

        $batch_data = array();

        foreach($cleaned_datas as $data)
        {
            $where = array();
            foreach($this->pk_names as $pk_name)
            {
                $where[$pk_name] = $data[$pk_name];
            }

            if($this->exists($where))
            {
                $this->{$this->db_group}->where($where);
                $this->{$this->db_group}->update($this->table, $data);
            }else
            {
                $batch_data[] = $data;
            }
        }

        if(!empty($batch_data))
        {
            $this->{$this->db_group}->insert_batch($this->table, $batch_data);
        }
        if($this->{$this->db_group}->affected_rows() !== 0)
        {
            Event::fire('Achievement.score.change');
        }
    }

    public function get_list($where)
    {
        $db = $this->{$this->db_group};

        if(isset($where['grade_id']))
        {
            $where['student.grade_id'] = $where['grade_id'];
            unset($where['grade_id']);
        }
        if(isset($where['class_id']))
        {
            $where['student.class_id'] = $where['class_id'];
            unset($where['class_id']);
        }
        if(isset($where['student_number']))
        {
            $where['student.number'] = $where['student_number'];
            unset($where['student_number']);
        }
        if(isset($where['student_name']))
        {
            $where['student.name'] = $where['student_name'];
            unset($where['student_name']);
        }

        if($subject_stmt = $this->build_subject_field_list())
        {
            $db->select($subject_stmt);
        }
        $db->select('exam_id, SUM(score) as total');
        $db->join($this->exam_table.' as exam', 'exam.id='.$this->table.'.exam_id','inner');
        $db->select($this->table.'.student_id as student_id,student.number as student_number,student.name as student_name, student.grade_id as grade_id, student.class_id as class_id');
        $db->join($this->student_table.' as student','student.id='.$this->table.'.student_id','inner');
        $db->join($this->subject_table.' as subject', 'subject.id='.$this->table.'.subject_id','left');
        if(isset($where['exam_id']))
        {
            $exam_id = $where['exam_id'];
            $klass_rank_table = $this->_build_klass_rank_statement($exam_id);
            $grade_rank_table = $this->_build_grade_rank_statement($exam_id);
            $db->select('class_rank.class_rank as class_rank');
            $db->select('grade_rank.grade_rank as grade_rank');
            $db->join("($klass_rank_table) as class_rank", 'class_rank.student_id='.$this->table.'.student_id', 'left');
            $db->join("($grade_rank_table) as grade_rank", 'grade_rank.student_id='.$this->table.'.student_id', 'left');
        }
        $db->group_by('student_id');
        $achieves = parent::get_list($where);
        $this->_process_achieves($achieves, $where);
        if($this->_with_count)
        {
            $this->_add_count($achieves, $where);
        }
        return $achieves;
    }

    protected function build_subject_field_list()
    {
        $db = $this->{$this->db_group};

        $query = $db->query('SELECT id FROM '.$this->subject_table.' ORDER BY ordering');

        foreach($query->result_array() as $subject)
        {
            $stmt[] = 'SUM(IF(subject.id='.$subject['id'].',score,0)) AS subject'.$subject['id'];
        }

        if(!empty($stmt))
        {
            return implode(',', $stmt);
        }
        return '';
    }

    private function _process_achieves(&$achieves,$where=null)
    {
        foreach($achieves as $key=>$achieve)
        {
            foreach($achieve as $field=>$value)
            {
                if(strncmp($field, 'subject_', 8) != 0 and strncmp($field, 'subject', 7) === 0)
                {
                    unset($achieves[$key][$field]);
                    $subject_id = substr($field, 7);
                    $achieves[$key]['scores'][] = array(
                        'subject_id' => $subject_id,
                        'score' => $value
                    );
                }
            }
        }

        return $achieves;
    }

    private function _build_klass_rank_statement($exam_id)
    {
        $sql = <<<SQL
SELECT
if(@class_id=class_id,@class_rank:=@class_rank,@class_rank:=1),
if(@class_id=class_id,@class_total:=@class_total,@class_total:=0),
if(tt2.total<@class_total,@class_rank:=@class_rank+1,@class_rank) AS class_rank,
@class_total:= tt2.total AS total, tt2.student_id AS student_id, @class_id:=tt2.class_id AS class_id
FROM
(SELECT @class_id:=0, @class_total:=0, @class_rank:=1, SUM(score) AS total,grade_id,class_id,student_id FROM mod_achievement_achieve AS achieve
RIGHT JOIN mod_achievement_student AS student ON student.id=achieve.student_id
WHERE achieve.exam_id=$exam_id
GROUP BY student.id ORDER BY student.grade_id ASC, student.class_id ASC, total DESC
) AS tt2
SQL;
        return $sql;
    }

    private function _build_grade_rank_statement($exam_id)
    {
        $sql = <<<SQL
SELECT
if(@grade_id=grade_id,@grade_rank:=@grade_rank,@grade_rank:=1),
if(@grade_id=grade_id,@grade_total:=@grade_total,@grade_total:=0),
if(tt1.total<@grade_total,@grade_rank:=@grade_rank+1,@grade_rank) AS grade_rank,
@grade_total:= tt1.total AS total, tt1.student_id AS student_id, @grade_id:=tt1.grade_id AS grade_id
FROM
(SELECT @grade_id:=0, @grade_total:=0, @grade_rank:=1, SUM(score) AS total,grade_id,class_id,student_id FROM mod_achievement_achieve AS achieve
RIGHT JOIN mod_achievement_student AS student ON student.id=achieve.student_id
WHERE achieve.exam_id=$exam_id
GROUP BY student.id ORDER BY student.grade_id ASC, total DESC
) AS tt1
SQL;
        return $sql;
    }

    private function _add_count(&$achieves, $where)
    {
        //reset with_count flag
        $this->_with_count = false;
        $db = $this->{$this->db_group};

        isset($where['exam_id']) and $condition['exam_id'] = $where['exam_id'];
        isset($where['student.grade_id']) and $condition['student.grade_id'] = $where['student.grade_id'];
        isset($where['student.class_id']) and $condition['student.class_id'] = $where['student.class_id'];
        isset($where['student.number']) and $condition['student.number'] = $where['student.number'];
        isset($where['student.name']) and $condition['student.name'] = $where['student.name'];

        $db->select('exam_id');
        $db->from($this->table.' as achieve');
        $db->join($this->student_table.' as student', 'achieve.student_id=student.id','inner');
        $db->where($condition);
        $db->group_by('student.id');
        $query = $db->get();
        $counts = $query->num_rows();
        $query->free_result();
        $data = $achieves;
        $achieves = array();
        $achieves['counts'] = $counts;
        $achieves['data'] = $data;
    }

    public function with_count()
    {
        $this->_with_count = true;
        return $this;
    }
}