<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller{
    public function index(){
        if(!$this->session->has_userdata('admin_logged_in')){
            $this->load->view('login');
       }else{
            redirect('course_list');
       }
    }
    public function login_check(){
        $this->form_validation->set_rules('student_email','Email','required');
        $this->form_validation->set_rules('student_id','Email','required');
        $this->form_validation->set_rules('password','Password','required|callback_check_database');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('login');
       }else{
        redirect('allpost','refresh');
       }
    }
    public function check_database($password){
        $data_c['student_email'] = $this->input->post('student_email');
        $data_c['password'] = md5($password);
        $result = $this->db->query('SELECT * FROM students WHERE student_email="'.$data_c['student_email'].'" and password="'.$data_c['password'].'"')->result_array();
        $semesters=$this->db->query('SELECT * FROM `semesters` ORDER BY id DESC LIMIT 1')->result_array();
        $semester=$semesters[0]['semester_name'];
        echo '<pre>';
        print_r($result);
        echo '</pre>';
        if($result){
            if($result[0]['active'] == 1){
                $sess_array = array(
                    'id' => $result[0]['id'],
                    'student_id' => $result[0]['student_id'],
                    'student_email' => $result[0]['student_email'],
                    'department' => $result[0]['department'],
                    'student_name' => $result[0]['student_name'],
                    'admissioned_semester' => $result[0]['admissioned_semester'],
                    'present_semester'=>$semester
                );
                $this->session->set_userdata('admin_logged_in',$sess_array);
                return true;
            }
        }
    }
    
    public function logout(){
    $this->session->unset_userdata('admin_logged_in');
        $this->session->sess_destroy();
        redirect('auth','refresh');
    }
}
?>