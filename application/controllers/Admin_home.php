<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Admin_home extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('superadmin_logged_in')){
			redirect('admin_login');
		}
        $this->load->model('Post_model');
    }
    public function index(){
        $student_id=$this->session->userdata('superadmin_logged_in')['username'];
        $present_semester=$this->session->userdata('superadmin_logged_in')['email'];
        //$data['courses'] = $this->Post_model->my_done_courses($student_id);
        $this->load->view('admin_home');
        
    }
    //public function delete(){
        
       // $id=$this->input->post('id');
       // $result = $this->db->query('DELETE FROM add_courses WHERE id ="'.$id.'"')->result_array();
       // $this->load->view('mycourses');
        
   // }
  
}
?>