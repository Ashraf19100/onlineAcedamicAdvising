<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Admin_unenrolled extends CI_Controller{
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
            $data['courses'] = $this->Post_model->enrolled_courses($present_semester);
            $this->load->view('unenrolled_byAdmin',$data);
            
        }
        public function delete($id){
            $result = $this->db->query("UPDATE add_courses SET status = 1 WHERE id = '".$id."' ");//
            if($result){
                $this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">
                Unenrolled Courses Successfully
              </div>');
                redirect('/admin_home');  
            }
        }
        public function result($id){
            $data['courses_update'] = $this->Post_model->courses_update($id);
            $this->load->view('result_update',$data);
        }
        public function result_upload(){
            if($this->duplicate_course_check()==true){
                if($this->retake_check()==true){
                    if($this->incomplete_check()==true){
                            $CG=$this->input->post('result');
                        if($CG=='F'){
                            $grade=0.00;
                            $status='Failed';
                        }elseif($CG=='A'){
                            $grade=4.00;
                            $status='passed';
                        }elseif($CG=='A-'){
                            $grade=3.75;
                            $status='passed';
                        }elseif($CG=='B+'){
                            $grade=3.30;
                            $status='passed'; 
                        }elseif($CG=='B'){
                            $grade=3.00;
                            $status='passed';
                        }elseif($CG=='B-'){
                            $grade=2.75;
                            $status='passed';
                        }elseif($CG=='C+'){
                            $grade=2.30;
                            $status='passed';
                        }elseif($CG=='C'){
                            $grade=2.00;
                            $status='passed';
                        }elseif($CG=='C-'){
                            $grade=1.75;
                            $status='passed';
                        }elseif($CG=='D+'){
                            $grade=1.30;
                            $status='passed';
                        }elseif($CG=='D'){
                            $grade=1.00;
                            $status='Failed';
                        }elseif($CG=='I'){
                            $grade=0.00;
                            $status='incomplete';
                        }
                        $data = array(
                            'student_id' => $this->input->post('student_id'),                    
                            'course_code' => $this->input->post('course_code'),
                            'course_title' => $this->input->post('course_title'),
                            'result' => $this->input->post('result'), 
                            'grade' => $grade,  
                            'semester' => $this->input->post('present_semester'),
                            'status' => $status
                        );
                        $result = $this->Post_model->result_submit($data);
                        if($result){
                            $this->session->set_flashdata('massage','<div class="alert alert-success" role="alert">Result Uploaded Succesfully</div>');
                            redirect('admin_home','refresh');
                        }
                    }
                }
                
            }else{
                $this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">Result Already Uploaded </div>');
                    redirect('admin_home','refresh');
            }
        }
        public function duplicate_course_check(){
            $query=$this->db->query('select * from completed_courses where student_id ="'.$this->input->post('student_id').'" and course_code= "'.$this->input->post('course_code').'" and semester= "'.$this->input->post('present_semester').'"')->result_array();
            if($query==null){
                return true;
            }else{
                return false;
            }
        }
        public function retake_check(){
            $query=$this->db->query('select * from completed_courses where student_id= "'.$this->input->post('student_id').'" and course_code ="'.$this->input->post('course_code').'" and status= "Failed"')->result_array();
            if($query==null){
                return true;
            }else{
                return false;
            }
        }
        public function incomplete_check(){
            $query=$this->db->query('select * from completed_courses where student_id= "'.$this->input->post('student_id').'" and course_code ="'.$this->input->post('course_code').'" and status= "incomplete"')->result_array();
            if($query==null){
                return true;
            }else{
                return false;
            }
        }
        public function update_failed_to_pass(){
            $result = $this->db->query("UPDATE add_courses SET status = '' WHERE id = '".$id."' ");//
            if($result){
                $this->session->set_flashdata('massage','<div class="alert alert-danger" role="alert">
                Unenrolled Courses Successfully
              </div>');
                redirect('/admin_home');  
            }
        }

    }

?>