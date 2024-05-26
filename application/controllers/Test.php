<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Test extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Post_model');
    }
    public function index(){
        $data['posts'] = $this->Post_model->post_list();
        echo '<pre>';
       print_r($data);
       echo '</pre>';
       // print_r($data);
        $this->load->view('test',$data);
    }
    public function add(){
        $this->form_validation->set_rules('post_title','Post Title','required');
        $this->form_validation->set_rules('post_des','Post Description','required');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('test');
        }else{
            $data = array(
                'post_title'    => $this->input->post('post_title'),
                'post_des'      => $this->input->post('post_des')
            );
            $result = $this->Post_model->post_insert($data);
            if($result){
                redirect('/');  
            }
        }
    }
    public function edit($id){
        $data['post'] = $this->Post_model->post_edit($id);
        if($data){
            $this->load->view('post-edit',$data);
        }
    }
    public function update(){
        $data = array(
            'post_title'    => $this->input->post('post_title'),
            'post_des'      => $this->input->post('post_des')
        );
        $id =  $this->input->post('id');
        $result = $this->Post_model->post_update($data,$id);
        if($result){
            redirect('/');  
        }
    }
}