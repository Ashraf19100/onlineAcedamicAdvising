<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Common_model extends CI_Model{
    public function list($table){
        $this->db->from($table);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }
    public function insert($data,$table){
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function post_edit($table,$id){
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        return $query->row();
    }
    public function update($data,$table,$id){
        $this->db->where('id', $id);
        $query = $this->db->update($table,$data);
        return $query;
    }
    public function delete($table,$id){
        $this->db->where('id', $id);
        $query = $this->db->delete($table);
        return $query;
    }
    public function image_upload($image,$image_name,$location){
		$config['upload_path'] 		= $location;
		$config['allowed_types']    = 'jpeg|gif|jpg|png';
		$config['overwrite'] 		= true;
		$config['image_name'] 		= $image_name;
		
		$this->load->library('upload');
		$this->upload->initialize($config);

		if(!$this->upload->do_upload($image)){
			echo $this->upload->display_errors();
		}else{
			$spinfo = $this->upload->data();//Resposible for Image Upload
			$data[$image] = $location.'/'.$spinfo['file_name'];
			$result = $this->Common_model->update($data,'customers',$image_name);
		}
	}
}