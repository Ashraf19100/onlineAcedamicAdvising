<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Admin_routine extends CI_Controller{
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
        $data['routine'] = $this->Post_model->routine($present_semester);
        //$data['add_courses'] = $this->Post_model->course_cheack($course_code,$student_id);
        //echo '<pre>';
       //print_r($data);
       //echo '</pre>';
        $this->load->view('routine_adminside',$data);
        
    }

    public function create_routine($id){
        $present_semester=$this->session->userdata('superadmin_logged_in')['present_semester'];
        $data['create_routine'] = $this->Post_model->routine_form($id);
        $this->load->view('routine_form',$data);
        
    }
    public function course_add_routine(){
        $data = array(
            'course_code' => $this->input->post('course_code'),
            'section' => $this->input->post('section'),
            'present_semester' => $this->input->post('present_semester'),
            'sunday' => $this->input->post('sunday'),
            'monday' => $this->input->post('monday'),
            'tuesday' => $this->input->post('tuesday'),
            'wednesday' => $this->input->post('wednesday'),
            'thursday' => $this->input->post('thursday'),
            

        );
        $result = $this->Post_model->course_insert_to_routine($data);
        if($result){
            $this->session->set_flashdata('massage','<div class="alert alert-success" role="alert">Cousre Added to Routine Succesfully</div>');
            redirect('admin_home','refresh');
        }
    }

    }
?>