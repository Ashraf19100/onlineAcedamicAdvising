<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Post_model extends CI_Model{
    public function post_list($department,$admissioned_semester,$present_semester){
        /*
        $this->db->from('posts');
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
        */
        $query = $this->db->query("select * from course_offered_bysemester where active = 1 and department='".$department."' and admissioned_semester='".$admissioned_semester."' and present_semester='".$present_semester."' order by id desc"); 
        return $query->result();
    }
    public function post_insert($data){
        $this->db->insert('add_courses', $data);
        return $this->db->insert_id();
    }
    public function post_edit($id){
        $this->db->where('id', $id);
        $query = $this->db->get('posts');
        return $query->row();
    }
    public function post_update($data,$id){
        $this->db->where('id', $id);
        $query = $this->db->update('posts',$data);
        return $query;
    }
    public function my_done_courses($student_id){
        $query = $this->db->query("select * from add_courses where student_id = $student_id  and status = 0 order by id desc"); 
        return $query->result();
    }
    public function my_completed_courses($student_id){
        $query = $this->db->query("select * from completed_courses where student_id = $student_id order by id desc"); 
        return $query->result();
    }
    public function course_list($present_semester){
        $query = $this->db->query("select * from course_offered_bysemester where active = 1 and present_semester='".$present_semester."' order by id desc"); 
        return $query->result();
    }
    public function routine($present_semester){
        $query = $this->db->query("select * from routine where present_semester='". $present_semester."' order by id desc"); 
        return $query->result();
    }
    public function enrolled_courses($present_semester){
        $query = $this->db->query("select * from add_courses where semester='". $present_semester."' and status = 0  order by id desc"); 
        return $query->result();
    
    }
    public function unenrolled_courses($present_semester){
        $query = $this->db->query("select * from add_courses where semester='". $present_semester."' and status = 1  order by id desc"); 
        return $query->result();
    
    }

    public function offered_courses($present_semester){
        $query = $this->db->query("select * from course_offered_bysemester where present_semester ='".$present_semester."' order by id desc"); 
        return $query->result();
    }
    public function all_course_list(){
        $query = $this->db->query("select * from courses order by id desc"); 
        return $query->result();
    }
    public function one_course_from_list($id){
        $query = $this->db->query("select * from courses where id='".$id."'"); 
        return $query->result();
    }
    public function course_insert($data){
        $this->db->insert('course_offered_bysemester', $data);
        return $this->db->insert_id();
    }    
    public function student_insert($data){
        $this->db->insert('students', $data);
        return $this->db->insert_id();
    }
    public function routine_form($id){
        $query = $this->db->query("select * from course_offered_bysemester where id='".$id."'"); 
        return $query->result();   
    }
    public function course_insert_to_routine($data){
        $this->db->insert('routine', $data);
        return $this->db->insert_id();
    }
    public function semester_insert($data){
        $this->db->insert('semesters', $data);
        return $this->db->insert_id();
    }
    public function result_submit($data){
        $this->db->insert('completed_courses', $data);
        return $this->db->insert_id();
    }
    public function courses_update($id){
        $query = $this->db->query("select * from add_courses where id='".$id."'"); 
        return $query->result();   
    }
    
    public function course_insert_syllabus($data){
        $this->db->insert('courses', $data);
        return $this->db->insert_id();
    }
}