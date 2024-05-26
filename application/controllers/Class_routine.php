<?php
    //defined('BASEPATH') OR exit('No direct script access allowed');
    defined('BASEPATH') or exit('No direct script access allowed');
    class Class_routine extends CI_Controller{
        public function __construct()
        {
            parent::__construct();
            if(!$this->session->has_userdata('admin_logged_in')){
                redirect('auth');
            }
            $this->load->model('Post_model');
        }
        public function index(){
            $this->load->view('class_routine_view');
        }
    }
?>