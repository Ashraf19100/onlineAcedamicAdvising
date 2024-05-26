<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_offered_courses extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('superadmin_logged_in')){
			redirect('admin_auth');
		}
        $this->load->model('Post_model');
    }
    public function index(){
        $present_semester = $this->session->userdata('superadmin_logged_in')['present_semester'];
        $data['course_offered_bysemester'] = $this->Post_model->course_list($present_semester);
        $this->load->view('add_admin_offered_courses',$data);
        
    }
    public function enroll_course(){
        $result = $this->db->query('select * from routine where course_code ="'.$this->input->post('course_code').'" and section= "'.$this->input->post('section').'"')->result_array();
        $sunday = $result[0]['sunday'];
        $monday = $result[0]['monday'];
        $tuesday = $result[0]['tuesday'];
        $wednesday =$result[0]['wednesday'];
        $thursday = $result[0]['thursday'];
        $semester = $this->input->post('present_semester');
        $limited_seat=$this->input->post('limited_seat');
        $section_chk=$this->section_check();
        $num=$section_chk;
        if($num<$limited_seat){
                    $data = array(
                        'course_code' => $this->input->post('course_code'),
                        'course_title' => $this->input->post('course_title'),
                        'student_id' => $this->input->post('student_id'),
                        'semester' => $this->input->post('present_semester'),
                        'sunday' => $sunday,
                        'monday' => $monday,
                        'tuesday' => $tuesday,
                        'wednesday' => $wednesday,
                        'thursday' => $thursday,
                        'section' => $this->input->post('section'),
            
                    );
                    $this->form_validation->set_rules('student_id','student_id','required|callback_course_check');
                    $student_id = $this->input->post('student_id');
                    if ($this->form_validation->run() == FALSE){
                        if($this->routine_time_check() == TRUE){
                            $this->prreqcourse_status_check($data);
                            redirect('admin_home','refresh');
                        }else{
                            $this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">There is a clash in Routine</div>');
                            redirect('admin_home','refresh');
                        }
                }else{
                    
                    redirect('admin_home','refresh');
                    return false;
                }
                    if($result){
                        redirect('admin_home','refreash');  
                    }else{
                        redirect('admin_home','refreash'); 
            
                    }   
        }else{
            $this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">seat fill up. try another section</div>');
            redirect('admin_home','refresh');
        }
    }
    public function course_check($student_id){
        $result = $this->db->query('SELECT * FROM add_courses WHERE student_id="'.$this->input->post('student_id').'" and course_code="'.$this->input->post('course_code').'" and status = 0')->result_array();
        if($result == null){
            $this->unenrolled_check();
            if($this->unenrolled_check() == FALSE){
                $this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">This Course has been unenrolled by admin to enroll this course please go to Unenrolled course list and reenroll</div>');
                return true; 
            }else{
                return false;
            } /////////////////  
            
            }else{
                $this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">Cousre Already Added</div>');
                return true;    
        }
    }
    public function prreqcourse_status_check($data){
        if($this->input->post('prreq_course_code')==null){
            $result = $this->Post_model->post_insert($data);
            $this->session->set_flashdata('massage','<div class="alert alert-success" role="alert">Cousre Added Succesfully</div>');
            return $result;
        }else{
            $query = $this->db->query('SELECT * FROM completed_courses WHERE student_id="'.$this->input->post('student_id').'" and course_code="'.$this->input->post('prreq_course_code').'"')->result_array();
            if($query == null){
                $this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">***to enroll This course you must have to pass the prerequest course***</div>');
                return false;
            }else{
                if($query[0]['status'] == 'passed'){
                    $result = $this->Post_model->post_insert($data);
                    $this->session->set_flashdata('massage','<div class="alert alert-success" role="alert">Cousre Added Succesfully</div>');
                    return $result;
                }else{
                    $this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">***to enroll This course you must have to pass the prerequest course***</div>');
                    return false;

                }
    
            }  
        }
        
    }
    public function prreqcourse_check($data){
        $query = $this->db->query('SELECT * FROM add_courses WHERE student_id="'.$this->input->post('student_id').'" and course_code="'.$this->input->post('prreq_course_code').'"')->result_array();
        if($query == null){
            return true;
        }else{
            $result = $this->Post_model->post_insert($data);
            return $result;
        }
    }

    public function section_check(){
        $row=$this->db->query('SELECT * FROM add_courses WHERE semester="'.$this->input->post('present_semester').'" and course_code="'.$this->input->post('course_code').'" and section="'.$this->input->post('section').'"');
        $count = $row->num_rows();
        return $count;
    }



    public function unenrolled_check(){
        $result = $this->db->query('SELECT * FROM add_courses WHERE student_id="'.$this->input->post('student_id').'" and course_code="'.$this->input->post('course_code').'" and status = 1')->result_array();
        if($result==null){
            return true;
        }else{
            return false;
        }
    }



    public function routine_time_check(){
        $result = $this->db->query('select * from routine where course_code ="'.$this->input->post('course_code').'" and section= "'.$this->input->post('section').'"')->result_array();
        $sunday = $result[0]['sunday'];
        $monday = $result[0]['monday'];
        $tuesday = $result[0]['tuesday'];
        $wednesday =$result[0]['wednesday'];
        $thursday = $result[0]['thursday'];
        $semester = $this->input->post('present_semester');
        $yes=1;
        if($result[0]['sunday']!=null){
            $query_one = $this->db->query('SELECT * FROM add_courses WHERE student_id="'.$this->input->post('student_id').'" and sunday = "'.$sunday .'" and semester = "'.$semester.'"')->result_array();
            if($query_one == null){
                $yes=$yes;
            }else{
                $yes++;
            }
        }
        if($result[0]['monday']!=null)
        {
            $query_two = $this->db->query('SELECT * FROM add_courses WHERE student_id="'.$this->input->post('student_id').'" and monday = "'.$monday .'" and semester = "'.$semester.'"')->result_array();
            if($query_two == null){
                $yes=$yes;
            }else{
                $yes++;
            }
        }
        if($result[0]['tuesday']!=null){
            $query_three = $this->db->query('SELECT * FROM add_courses WHERE student_id="'.$this->input->post('student_id').'" and tuesday = "'.$tuesday .'" and semester = "'.$semester.'"')->result_array();
            if($query_three == null){
                $yes=$yes;
            }else{
                $yes++;
            }
        }
        if($result[0]['wednesday']!=null){
            $query_four = $this->db->query('SELECT * FROM add_courses WHERE student_id="'.$this->input->post('student_id').'" and wednesday = "'.$wednesday .'" and semester = "'.$semester.'"')->result_array();
            if($query_four == null){
                $yes=$yes;
            }else{
                $yes++;
            }
        }
        if($result[0]['thursday']!=null){
            $query_five = $this->db->query('SELECT * FROM add_courses WHERE student_id="'.$this->input->post('student_id').'" and thursday = "'.$thursday .'" and semester = "'.$semester.'"')->result_array();
            if($query_five == null){
                $yes=$yes;
            }else{
                $yes++;
            }
        }

        if($yes > 1){
            return false;
        }else{
            return true;
        }
        
    }
    /*public function enroll_course(){
        
        $section=1;
        $limited_seat=$this->input->post('limited_seat');
        $section_chk=$this->section_check();
        $num=$section_chk/$limited_seat;
        if($num>=$section){
            $section=$num;
        }else{
            $section=$section;
        }



        $data = array(
            'course_code' => $this->input->post('course_code'),
            'course_title' => $this->input->post('course_title'),
            'student_id' => $this->input->post('student_id'),
            'semester' => $this->input->post('present_semester'),
            'sunday' => $this->input->post('sunday'),
            'monday' => $this->input->post('monday'),
            'tuesday' => $this->input->post('tuesday'),
            'wednesday' => $this->input->post('wednesday'),
            'thursday' => $this->input->post('thursday'),
            'section' => $section,

        );
        $student_id = $this->input->post('student_id');
        $course_code = $this->input->post('course_code');
        $this->form_validation->set_rules('student_id','student_id','required|callback_course_check');
        if ($this->form_validation->run() == FALSE){
            
           if($this->routine_time_check() == TRUE){
            $this->prreqcourse_status_check($data);
            redirect('admin_home','refresh');
           }else{
            $this->session->set_flashdata('massage','There is a clash in Routine');
            redirect('admin_home','refresh');
           }
               
            
            
          
       }else{
        //$this->session->set_flashdata('massage','Cousre Already Added');
        redirect('admin_home','refresh');
        
       }
        if($result){
            redirect('admin_home','refreash');  
        }else{
            redirect('admin_home','refreash'); 

        }
    }
    public function course_check($student_id){
        $result = $this->db->query('SELECT * FROM add_courses WHERE student_id="'.$this->input->post('student_id').'" and course_code="'.$this->input->post('course_code').'" and status = 0')->result_array();
        if($result == null){
            $this->unenrolled_check();
            if($this->unenrolled_check() == FALSE){
                $this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">Cousre  Added</div>');
                return true;
 
            }else{
                return false;
            } /////////////////  
            
            }else{
                $this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">Cousre Already Added</div>');
                return true;    
        }
    }
    /*public function course_check($student_id){
        $result = $this->db->query('SELECT * FROM add_courses WHERE student_id="'.$this->input->post('student_id').'" and course_code="'.$this->input->post('course_code').'"')->result_array();
        $course=$this->input->post('course_code');
        if($result == null){
            return false;    
            }else{
            return true;    
        }
    }
    public function prreqcourse_status_check($data){
        if($this->input->post('prreq_course_code')==null){
            $result = $this->Post_model->post_insert($data);
            $this->session->set_flashdata('massage','Cousre Added Succesfully');
            return $result;
        }else{
            $query = $this->db->query('SELECT * FROM completed_courses WHERE student_id="'.$this->input->post('student_id').'" and course_code="'.$this->input->post('prreq_course_code').'"')->result_array();
            if($query == null){
                $this->session->set_flashdata('massage','***to enroll This course you must have to pass the prerequest course***');
                return false;
            }else{
                if($query[0]['status'] == 'passed'){
                    $result = $this->Post_model->post_insert($data);
                    $this->session->set_flashdata('massage','Cousre Added Succesfully');
                    return $result;
                }else{
                    $this->session->set_flashdata('massage','***to enroll This course you must have to pass the prerequest course***');
                    return false;

                }
    
            }  
        }
        
    }
    public function prreqcourse_check($data){
        $query = $this->db->query('SELECT * FROM add_courses WHERE student_id="'.$this->input->post('student_id').'" and course_code="'.$this->input->post('prreq_course_code').'"')->result_array();
        if($query == null){
            return true;
        }else{
            $result = $this->Post_model->post_insert($data);
            return $result;
        }
    }


    public function section_check(){
        $row=$this->db->query('SELECT * FROM add_courses WHERE semester="'.$this->input->post('present_semester').'" and course_code="'.$this->input->post('course_code').'"');
        $count = $row->num_rows();
        return $count;
    }
    public function unenrolled_check(){
        $result = $this->db->query('SELECT * FROM add_courses WHERE student_id="'.$this->input->post('student_id').'" and course_code="'.$this->input->post('course_code').'" and status = 1')->result_array();
        if($result==null){
            return true;
        }else{
            $this->reenroll_check();
            if($this->reenroll_check()== TRUE){
                return false;
            }else{
                return true;
            }
            
        }
    }
    ////////////
    public function reenroll_check(){
        $result = $this->db->query('UPDATE add_courses SET status = 0 WHERE student_id="'.$this->input->post('student_id').'" and course_code="'.$this->input->post('course_code').'" and status = 1')->result_array();

        $yes=1;
        if($yes==1){
            return true;
        }
        

        
    }
    public function routine_time_check(){
        $sunday = $this->input->post('sunday');
        $monday = $this->input->post('monday');
        $tuesday = $this->input->post('tuesday');
        $wednesday = $this->input->post('wednesday');
        $thursday = $this->input->post('thursday');
        $semester =  $this->input->post('present_semester');
        $yes=1;
        if(!empty($sunday)){
            $query_one = $this->db->query('SELECT * FROM add_courses WHERE student_id="'.$this->input->post('student_id').'" and sunday = "'.$sunday .'" and semester = "'.$semester.'"')->result_array();
            if($query_one == null){
                $yes=$yes;
            }else{
                $yes++;
            }
        }
        if(!empty($monday) 
        ){
            $query_two = $this->db->query('SELECT * FROM add_courses WHERE student_id="'.$this->input->post('student_id').'" and monday = "'.$monday .'" and semester = "'.$semester.'"')->result_array();
            if($query_two == null){
                $yes=$yes;
            }else{
                $yes++;
            }
        }
        if(!empty($tuesday)){
            $query_three = $this->db->query('SELECT * FROM add_courses WHERE student_id="'.$this->input->post('student_id').'" and tuesday = "'.$tuesday .'" and semester = "'.$semester.'"')->result_array();
            if($query_three == null){
                $yes=$yes;
            }else{
                $yes++;
            }
        }
        if(!empty($wednesday)){
            $query_four = $this->db->query('SELECT * FROM add_courses WHERE student_id="'.$this->input->post('student_id').'" and wednesday = "'.$wednesday .'" and semester = "'.$semester.'"')->result_array();
            if($query_four == null){
                $yes=$yes;
            }else{
                $yes++;
            }
        }
        if(!empty($thursday)){
            $query_five = $this->db->query('SELECT * FROM add_courses WHERE student_id="'.$this->input->post('student_id').'" and thursday = "'.$thursday .'" and semester = "'.$semester.'"')->result_array();
            if($query_five == null){
                $yes=$yes;
            }else{
                $yes++;
            }
        }

        if($yes > 1){
            return false;
        }else{
            return true;
        }
        
    }*/
    
}