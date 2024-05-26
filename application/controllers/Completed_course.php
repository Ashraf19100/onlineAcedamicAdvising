<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Completed_course extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('admin_logged_in')){
			redirect('auth');
		}
        $this->load->model('Post_model');
    }
    public function index(){
        $student_id=$this->session->userdata('admin_logged_in')['student_id'];
        $data['courses'] = $this->Post_model->my_completed_courses($student_id);
        //$data['add_courses'] = $this->Post_model->course_cheack($course_code,$student_id);
        //echo '<pre>';
       //print_r($data);
       //echo '</pre>';
        $this->load->view('mycompleted_course',$data);
        
    }
    }
?>