<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Add_course extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('superadmin_logged_in')){
			redirect('admin_auth');
		}
        $this->load->model('Post_model');
    }
    public function index($id){
        
        $present_semester=$this->session->userdata('superadmin_logged_in')['present_semester'];
        $data['courses'] = $this->Post_model->one_course_from_list($id);
        $this->load->view('add_course_form',$data);
        
    }
    public function add_to_semester(){
        if($this->duplicate_course_check()==true){
            $data = array(
                'course_code' => $this->input->post('course_code'),
                'course_title' => $this->input->post('course_title'),
                'prerequest_course_cousre_code' => $this->input->post('prerequest_course_cousre_code'),
                'department' => $this->input->post('department'),
                'admissioned_semester' => $this->input->post('admissioned_semester'),
                'present_semester' => $this->input->post('present_semester'),
                'section' => $this->input->post('section'),
                'instructor_name' => $this->input->post('instructor_name'),
                'credit' => $this->input->post('credit'),
                'type' => $this->input->post('type'),
                'limited_seat' => $this->input->post('limited_seat'),
    
            );
            $result = $this->Post_model->course_insert($data);
            if($result){
                $this->session->set_flashdata('massage','<div class="alert alert-success" role="alert">Cousre Added to semester Succesfully</div>');
                redirect('admin_home','refresh');
            }
        }else{
            $this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">Cousre Already Added to semester </div>');
                redirect('admin_home','refresh');
        }
        
    }
    public function duplicate_course_check(){
        $query=$this->db->query('select * from course_offered_bysemester where course_code ="'.$this->input->post('course_code').'" and present_semester= "'.$this->input->post('present_semester').'"')->result_array();
        if($query==null){
            return true;
        }else{
            return false;
        }
    }
    }
?>