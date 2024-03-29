<?php
class User_model extends CI_Model {
	public function __construct() {
			parent::__construct();
			$this->load->database();
	}
	public function get_user_data_by_field_count($obj){
		return $this->db->get_where('b_user',$obj)->num_rows();
	}
	public function create_user($data){
		$this->db->insert('b_user',$data);
		return $this->db->insert_id();
	}
	public function get_user_data_by_field($obj){
		return $this->db->select('
			user_id,
			user_name,
			user_email,
			user_dob,
			user_gender,
			concat("'.base_url('uploads/user/').'",user_image) as user_image,
			user_image as user_image_name,
			user_profile_complete,
			user_is_verify,
			user_authentication,
			user_created
		')->get_where('b_user',$obj)->row();
	}
	public function update_user($user_id,$data){
		return $this->db->where("user_id",$user_id)->update('b_user',$data);
	}
	public function get_content($type){
		return $this->db->select('content_content')->get_where('b_content',array("content_type"=>$type))->row();
	}
}
