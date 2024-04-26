<?php
class Admin_model extends CI_Model {
	public function __construct() {
			parent::__construct();
			$this->load->database();
	}
	public function get_admin_obj_field_count($fields_admin){
		return $this->db->get_where('b_admin',$fields_admin)->num_rows();
	}
	public function get_admin_obj_field($fields_admin){
		return $this->db->get_where('b_admin',$fields_admin)->row();
	}
	public function update_admin($admin_id,$admin_data){
		return $this->db->where('admin_id',$admin_id)->update('b_admin',$admin_data);
	}
	public function get_users_list(){
		return $this->db->select('*')->get('b_user')->result_array();
	}
    public function get_transactions(){
		return $this->db->select('*')->get('b_transaction')->result_array();
	}
    public function get_user_withdraw(){

        $this->db->select('b_withdraw.*, b_user.user_name, b_user.user_email, b_bank.*')
                ->from('b_withdraw')
                ->join('b_user', 'b_user.user_id = b_withdraw.withdraw_user_id')
                ->join('b_bank', 'b_bank.bank_user_id = b_withdraw.withdraw_user_id');
        $result = $this->db->get();

        return $result->result_array();
	}

    public function get_user_withdraw_row($id){
		return $this->db->get_where('b_withdraw',array("withdraw_id"=>$id))->row();
	}

    public function withdraw_status_update($withdraw_id,$status){
		return $this->db->where('withdraw_id',$withdraw_id)->update('b_withdraw',array("withdraw_status"=>$status));
	}

	public function user_is_blocked($user_id,$value){
		return $this->db->where('user_id',$user_id)->update('b_user',['user_is_blocked'=>$value]);
	}
	public function get_content($type){
		return $this->db->get_where('b_content',array("content_type"=>$type))->row();
	}
	public function content_update($content_id,$content){
		return $this->db->where('content_id',$content_id)->update('b_content',array("content_content"=>$content));
	}
}
