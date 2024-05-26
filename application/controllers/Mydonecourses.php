<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Mydonecourses extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('admin_logged_in')){
			redirect('auth');
		}
        $this->load->model('Post_model');
        $this->load->model('Common_model');
    }
    public function index(){
        $student_id=$this->session->userdata('admin_logged_in')['student_id'];
        $present_semester=$this->session->userdata('admin_logged_in')['present_semester'];
        $data['courses'] = $this->Post_model->my_done_courses($student_id);
        $this->load->view('mycourses',$data);
        
    }
    public function delete($id){
        $result = $this->Common_model->delete('add_courses',$id);
        if($result){
            $this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">
            Unenrolled Courses Successfully
          </div>');
            redirect('/mydonecourses');  
        }
    }
   /* public function delete(){
        
        $id=$this->input->post('id');
        $result = $this->db->query('DELETE FROM add_courses WHERE id ="'.$id.'"')->result_array();
        $this->load->view('mycourses');
        
    }*/
  
}
?>