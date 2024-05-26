<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Unenrolled_course_list extends CI_Controller{
        public function __construct(){
            parent::__construct();
            if(!$this->session->has_userdata('superadmin_logged_in')){
                redirect('admin_auth');
            }
            $this->load->model('Post_model');
            $this->load->model('Common_model');
        }
        public function index(){
            $student_id=$this->session->userdata('superadmin_logged_in')['username'];
            $present_semester=$this->session->userdata('superadmin_logged_in')['present_semester'];
            $data['courses'] = $this->Post_model->unenrolled_courses($present_semester);
            $this->load->view('unenrolled_course_view',$data);
            
        }
        public function reenroll($id){
            $result = $this->db->query("UPDATE add_courses SET status = 0 WHERE id = '".$id."' ");//$this->Common_model->delete('add_courses',$id);
            if($result){
                $this->session->set_flashdata('massage','<div class="alert alert-success" role="alert">
                Course Reenrolled Successfully
              </div>');
                redirect('/admin_home');  
            }
        }
       

    }

?>