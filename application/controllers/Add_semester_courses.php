<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Add_semester_courses extends CI_Controller{
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
        $data['courses'] = $this->Post_model->all_course_list();
        $this->load->view('add_semester_courses_list',$data);
        
    }
    }
?>