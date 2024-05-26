<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_auth extends CI_Controller{
    public function index(){
        if(!$this->session->has_userdata('superadmin_logged_in')){
            $this->load->view('admin_login');
       }else{
            redirect('admin_home');
       }
    }
    public function login_check(){
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Password','required|callback_check_database');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('admin_login');
       }else{
        redirect('admin_home','refresh');
       }
    }
    public function check_database($password){
        $data_c['email'] = $this->input->post('email');
        $data_c['password'] = md5($password);
        $result = $this->db->query('SELECT * FROM admin WHERE email="'.$data_c['email'].'" and password="'.$data_c['password'].'"')->result_array();
        $semesters=$this->db->query('SELECT * FROM `semesters` ORDER BY id DESC LIMIT 1')->result_array();
        $semester=$semesters[0]['semester_name'];
        echo '<pre>';
        print_r($result);
        echo '</pre>';
        if($result){
            if($result[0]['status'] == 1){
                $sess_array = array(
                    'id' => $result[0]['id'],
                    'username' => $result[0]['username'],
                    'email' => $result[0]['email'],
                    'present_semester'=>$semester
                );
                $this->session->set_userdata('superadmin_logged_in',$sess_array);
                return true;
            }
        }
    }
    
    
    public function logout(){
    $this->session->unset_userdata('superadmin_logged_in');
        $this->session->sess_destroy();
        redirect('admin_auth','refresh');
    }
}
?>