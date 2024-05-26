<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Add_new_course extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('superadmin_logged_in')){
			redirect('admin_auth');
		}
        $this->load->model('Post_model');
    }
    public function index(){
        
        $present_semester=$this->session->userdata('superadmin_logged_in')['present_semester'];
        $this->load->view('add_new_course_form');
        
    }
    public function add_to_syllabus(){
        if($this->duplicate_course_check()==true){
            $data = array(
                'course_code' => $this->input->post('course_code'),
                'course_title' => $this->input->post('course_title'),
                'prerequest_course_cousre_code' => $this->input->post('prerequest_course_cousre_code'),
                'credit' => $this->input->post('credit'),
                'type' => $this->input->post('type'),
                'department' => $this->input->post('department'),
    
            );
            $result = $this->Post_model->course_insert_syllabus($data);
            if($result){
                $this->session->set_flashdata('massage','<div class="alert alert-success" role="alert">Cousre Added to syllabus Succesfully</div>');
                redirect('admin_home','refresh');
            }
        }else{
            $this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">Cousre Already Added to syllabus </div>');
                redirect('admin_home','refresh');
        }
        
    }
    public function duplicate_course_check(){
        $query=$this->db->query('select * from courses where course_code ="'.$this->input->post('course_code').'" and department= "'.$this->input->post('department').'"')->result_array();
        if($query==null){
            return true;
        }else{
            return false;
        }
    }
    }
?>