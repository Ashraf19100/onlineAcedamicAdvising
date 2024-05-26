<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Creat_semester extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('superadmin_logged_in')){
			redirect('admin_auth');
		}
        $this->load->model('Post_model');
    }
    public function index(){
        $this->load->view('creat_semester_form'); 
    }
    public function new_semester_add(){
        if($this->duplicate_course_check()==true){
            $data = array(
                'semester_name' => $this->input->post('semester_name'),
                'year' => $this->input->post('year'),
            );
            $result = $this->Post_model->semester_insert($data);
            if($result){
                
                $this->session->unset_userdata('superadmin_logged_in');
                $this->session->sess_destroy();
                redirect('admin_auth','refresh');
                
            }
        }else{
            $this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">You are trying to input the current semester.please Enter a new semester name</div>');
                redirect('admin_home','refresh');
        }
        
    }
    public function duplicate_course_check(){
        $query=$this->db->query('select * from semesters where semester_name ="'.$this->input->post('semester_name').'" and year= "'.$this->input->post('year').'"')->result_array();
        if($query==null){
            return true;
        }else{
            return false;
        }
    }
    }
?>