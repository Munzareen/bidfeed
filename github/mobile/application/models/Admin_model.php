<?php
class Admin_model extends CI_Model {
	public function __construct() {
			parent::__construct();
			$this->load->database();
	}
	public function get_admin_obj_field_count($fields_admin){
		return $this->db->get_where('p_admin',$fields_admin)->num_rows();
	}
	public function get_admin_obj_field($fields_admin){
		return $this->db->get_where('p_admin',$fields_admin)->row();
	}
	public function update_admin($admin_id,$admin_data){
		return $this->db->where('admin_id',$admin_id)->update('p_admin',$admin_data);
	}
	public function get_users_list(){
		return $this->db->select('*')->get('p_user')->result_array();
	}
	public function user_is_blocked($user_id,$value){
		return $this->db->where('user_id',$user_id)->update('p_user',['user_is_blocked'=>$value]);
	}
	public function get_content($type){
		return $this->db->get_where('p_content',array("content_type"=>$type))->row();
	}
	public function content_update($content_id,$content){
		return $this->db->where('content_id',$content_id)->update('p_content',array("content_content"=>$content));
	}

	public function check_catgory($arr_cate){
		return $this->db->get_where('p_category',$arr_cate)->row();
	}
	public function create_category($cate_arr){
		return $this->db->insert('p_category',$cate_arr);
	}
	public function get_category(){
		return $this->db->get('p_category')->result_array();
	}
	public function delete_category($category_id){
		return $this->db->where("category_id",$category_id)->delete('p_category');
	}
	public function check_char($arr_char){
		return $this->db->get_where('p_delivery_charges',$arr_char)->row();
	}
	public function create_char($char_arr){
		return $this->db->insert('p_delivery_charges',$char_arr);
	}
	public function get_chargies(){
		return $this->db->get('p_delivery_charges')->result_array();
	}
	public function delete_charge($dc_id){
		return $this->db->where("dc_id",$dc_id)->delete('p_delivery_charges');
	}
	public function get_order(){
		return $this->db->get('p_order')->result_array();
	}
	public function delete_order($order_id){
		return $this->db->where("order_id",$order_id)->delete('p_order');
	}
	public function get_detail_order($order_id){
		$order_get = $this->db->select('(select user_name from p_user where user_id = p_order.order_user_id) as user_name,p_order.*')->get_where('p_order',["order_id"=>$order_id])->row();
		$get_pickup = $this->db->get_where('p_pickup',["pickup_id"=>$order_get->order_pickup_id])->row();
		$get_delivery = $this->db->get_where('p_delivery',["delivery_id"=>$order_get->order_delivery_id])->row();
		$get_chargies = $this->db->get_where('p_delivery_charges',["dc_id"=>$order_get->order_dc_id])->row();

		return array(
			"information"=>$order_get,
			"pickup"=>$get_pickup,
			"delivery"=>$get_delivery,
			"chargies"=>$get_chargies
		);
	}
	public function update_order($order_id,$arr){
		return $this->db->where("order_id",$order_id)->update('p_order',$arr);
	}
}
