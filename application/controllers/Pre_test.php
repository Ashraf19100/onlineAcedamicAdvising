<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pre_test extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('admin_logged_in')){
			redirect('auth');
		}
        $this->load->model('Post_model');
    }
    
    public function index(){
        $admissioned_semester = $this->session->userdata('admin_logged_in')['admissioned_semester'];
        $present_semester = $this->session->userdata('admin_logged_in')['present_semester'];
        $data['course_offered_bysemester'] = $this->Post_model->post_list($admissioned_semester,$present_semester);
        $this->load->view('preP_test_view',$data);
        
    }
    public function add(){
        $this->form_validation->set_rules('post_title','Post Title','required');
        $this->form_validation->set_rules('post_des','Post Description','required');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('test.php');
        }else{
            $data = array(
                'post_title'    => $this->input->post('post_title'),
                'post_des'      => $this->input->post('post_des')
            );
            $result = $this->Post_model->post_insert($data);
            if($result){
                redirect('/');  
            }
        }
    }
    public function edit($id){
        $data['post'] = $this->Post_model->post_edit($id);
        if($data){
            $this->load->view('post-edit',$data);
        }
    }
    public function update(){
        $data = array(
            'post_title'    => $this->input->post('post_title'),
            'post_des'      => $this->input->post('post_des')
        );
        $id =  $this->input->post('id');
        $result = $this->Post_model->post_update($data,$id);
        if($result){
            redirect('/');  
        }
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
                            redirect('mydonecourses','refresh');
                        }else{
                            $this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">There is a clash in Routine</div>');
                            redirect('mydonecourses','refresh');
                        }
                }else{
                    
                    redirect('mydonecourses','refresh');
                    return false;
                }
                    if($result){
                        redirect('mydonecourses','refreash');  
                    }else{
                        redirect('mydonecourses','refreash'); 
            
                    }   
        }else{
            $this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">seat fill up. try another section</div>');
            redirect('mydonecourses','refresh');
        }
    }
    public function course_check($student_id){
        $result = $this->db->query('SELECT * FROM add_courses WHERE student_id="'.$this->input->post('student_id').'" and course_code="'.$this->input->post('course_code').'" and status = 0')->result_array();
        if($result == null){
            $this->unenrolled_check();
            if($this->unenrolled_check() == FALSE){
                $this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">This Course has been unenrolled by admin to enroll please kindly contact with your advisor</div>');
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
}
?>