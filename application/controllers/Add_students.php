<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Add_students extends CI_Controller{
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
        $this->load->view('add_new_student');
        
    }
    public function add_new_students(){
        $password=$this->input->post('password');
        $password_md5=md5($password);

        if($this->duplicate_check()==true){
        $data = array(
            'student_id ' => $this->input->post('student_id'),
            'student_email' => $this->input->post('student_email'),
            'department' => $this->input->post('department'),
            'student_name' => $this->input->post('student_name'),
            'phone_number' => $this->input->post('phone_number'),
            'password' => $password_md5,
            'admissioned_semester' => $this->input->post('admissioned_semester')
        );
        $result = $this->Post_model->student_insert($data);
        if($result){
            $this->session->set_flashdata('massage','<div class="alert alert-success" role="alert">new student Added Succesfully</div>');
            redirect('admin_home','refresh');
        }}else{
            $this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">Duplicate value entry!!!!!.</div>');
            redirect('add_students','refresh');
        }
    }

    public function duplicate_check(){
        $query=$this->db->query('select * from students where student_id ="'.$this->input->post('student_id').'" or student_email= "'.$this->input->post('student_email').'"')->result_array();
        if($query==null){
            return true;
        }else{
            return false;
        }
    }
    }
?>