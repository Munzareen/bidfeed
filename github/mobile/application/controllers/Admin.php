<?php defined('BASEPATH') OR exit('No direct script access allowed'); error_reporting(0);
class Admin extends CI_Controller {
    public function login_view(){
        if(!empty($this->session->userdata('admin_info')->admin_email)){
        redirect(base_url('admin/dashboard'));
        }else{
        $this->load->view('admin/login');
        }
    }
    public function forgot_password(){
        $this->load->view('admin/forgot-password');
    }
    public function login_fun(){
        $admin_email = $this->input->post('admin_email');
        $admin_password = $this->input->post('admin_password');

        try {
        if(empty($admin_email)){
            $data['admin_status'] = 'alert-danger';
            $data['admin_message'] = 'Sorry Email address is required.';
        }else if(empty($admin_password)){
            $data['admin_status'] = 'alert-danger';
            $data['admin_message'] = 'Sorry Password is required.';
        }else{
            $admin_email_check = $this->Admin_model->get_admin_obj_field_count(['admin_email'=>$admin_email]);
            if($admin_email_check>0){
            $admin_password_check = $this->Admin_model->get_admin_obj_field_count(['admin_email'=>$admin_email,'admin_password'=>sha1($admin_password)]);
            if($admin_password_check>0){
                $admin_obj = $this->Admin_model->get_admin_obj_field(['admin_email'=>$admin_email,'admin_password'=>sha1($admin_password)]);


                $this->session->set_userdata('admin_info',$admin_obj);
                redirect(base_url('admin/dashboard'));
            }else{
                $data['admin_status'] = 'alert-danger';
                $data['admin_message'] = 'Sorry this Password is incorrect.';
            }
            }else{
            $data['admin_status'] = 'alert-danger';
            $data['admin_message'] = 'Sorry this Email address is not exist.';
            }
        }
        } catch (\Exception $e) {
        $data['admin_status'] = 'alert-danger';
        $data['admin_message'] = $e->getMessage();
        }
        $this->session->set_flashdata('message',$data);
        redirect(base_url('admin'));
    }
    public function forgot_password_fun(){
        $admin_email = $this->input->post('admin_email');
        try {
        if(empty($admin_email)){
            $data['admin_status'] = 'alert-danger';
            $data['admin_message'] = 'Sorry Email address is required.';
        }else{
            $admin_email_check = $this->Admin_model->get_admin_obj_field_count(['admin_email'=>$admin_email]);
            if($admin_email_check>0){
            $admin_obj = $this->Admin_model->get_admin_obj_field(['admin_email'=>$admin_email]);
            $otp_password = rand(1000,9000);
            $update_admin = $this->Admin_model->update_admin($admin_obj->admin_id,['admin_password'=>sha1($otp_password)]);
            $email_arr = array(
                "email"=>$admin_obj->admin_email,
                "subject"=>"Forgot Password admin",
                "content"=>"This is your new password: ".$otp_password
            );
            $email_res = email_hit($email_arr);
            if($email_res){
                $data['admin_status'] = 'alert-success';
                $data['admin_message'] = 'Successfully! Email has been send on your email.';
            }else{
                $data['admin_status'] = 'alert-danger';
                $data['admin_message'] = 'Sorry there is some problem.';
            }
            }else{
            $data['admin_status'] = 'alert-danger';
            $data['admin_message'] = 'Sorry this Email address is not exist.';
            }
        }
        } catch (\Exception $e) {
        $data['admin_status'] = 'alert-danger';
        $data['admin_message'] = $e->getMessage();
        }
        $this->session->set_flashdata('message',$data);
        redirect(base_url('admin/forgot_password'));
    }
    public function dashboard(){
        if(!empty($this->session->userdata('admin_info')->admin_email)){
        $data['head_title'] = "Dashboard";
        $this->load->view('admin/dashboard',$data);
        }else{
        redirect(base_url('admin'));
        }
    }
    public function update_profile(){
        $admin_id = $this->input->post('admin_id');
        $admin_update['admin_name'] = $this->input->post('admin_name');
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');
        $admin_profile = isset($_FILES['admin_profile']['name'])?$_FILES['admin_profile']['name']:"";

        try {
        if(empty($admin_id)){
            $data['admin_status'] = 'alert-danger';
            $data['admin_message'] = 'Admin ID is required.';
        }else{
            if(!empty($admin_profile)){
            $get_admin_obj = $this->Admin_model->get_admin_obj_field(['admin_id'=>$admin_id]);
            $unlink = unlink(getcwd()."/uploads/admin/".$get_admin_obj->admin_profile);
            if($unlink>0){
                $admin_profile = mt_rand().".jpg";
                move_uploaded_file($_FILES['admin_profile']['tmp_name'],getcwd()."/uploads/admin/".$admin_profile);
                $admin_update['admin_profile'] = $admin_profile;
            }
            }
            if(!empty($new_password)){
            if($new_password != $confirm_password){
                $data['admin_status'] = 'alert-danger';
                $data['admin_message'] = 'New Password & Confirm Password does not match.';
            }else{
                $admin_update['admin_password'] = sha1($new_password);
                $update_admin_data = $this->Admin_model->update_admin($admin_id,$admin_update);
                if($update_admin_data){
                $data['admin_status'] = 'alert-success';
                $data['admin_message'] = 'Account Update Successfully.';
                }else{
                $data['admin_status'] = 'alert-danger';
                $data['admin_message'] = 'Sorry there is some problem.';
                }
            }
            }else{
            $update_admin_data = $this->Admin_model->update_admin($admin_id,$admin_update);
            if($update_admin_data){
                $data['admin_status'] = 'alert-success';
                $data['admin_message'] = 'Account Update Successfully.';
            }else{
                $data['admin_status'] = 'alert-danger';
                $data['admin_message'] = 'Sorry there is some problem.';
            }
            }
        }
        } catch (\Exception $e) {
            $data['admin_status'] = 'alert-danger';
            $data['admin_message'] = $e->getMessage();
        }
        $this->session->unset_userdata('admin_info');
        $get_admin_obj_session = $this->Admin_model->get_admin_obj_field(['admin_id'=>$admin_id]);
        $this->session->set_userdata('admin_info',$get_admin_obj_session);
        $this->session->set_flashdata('message',$data);
        redirect(base_url('admin/dashboard'));
    }
    public function user_listing(){
        if(!empty($this->session->userdata('admin_info')->admin_email)){
        $data['head_title'] = "User's";
        $data['user_obj'] = $this->Admin_model->get_users_list();
        $this->load->view('admin/user_listing',$data);
        }else{
        redirect(base_url('admin'));
        }
    }

    public function user_withdraw(){
        if(!empty($this->session->userdata('admin_info')->admin_email)){
            $data['head_title'] = "User's Withdraw";
            $data['user_withdraw_obj'] = $this->Admin_model->get_user_withdraw();
            $this->load->view('admin/user_withdraw',$data);
        }else{
            redirect(base_url('admin'));
        }
    }

    public function transaction(){
        if(!empty($this->session->userdata('admin_info')->admin_email)){
            $data['head_title'] = "Transaction's";
            $data['transaction_obj'] = $this->Admin_model->get_transactions();
            $this->load->view('admin/transaction',$data);
        }else{
            redirect(base_url('admin'));
        }
    }

    // Working
    public function view_order(){
        if(!empty($this->session->userdata('admin_info')->admin_email)){
            $order_id = $this->input->get('id');
            $data['order_details'] = $this->Social_media_model->get_order_detail($order_id);

            // echo "<pre>"; print_r($data['order_details']); die;

            $data['head_title'] = "Order Details";
            $this->load->view('admin/view_order', $data);
        }else{
            redirect(base_url('admin'));
        }
    }
    // End

    public function withdraw_status(){
        $withdraw_id = $this->input->get('id');
        $withdraw_status = $this->input->get('status');
        
        $res = $this->Admin_model->withdraw_status_update($withdraw_id,$withdraw_status);
        if($res>0){

            $user_withdraw = $this->Admin_model->get_user_withdraw_row($withdraw_id);

            if($withdraw_status == 'rejected'){
                $get_wallet = $this->Social_media_model->get_wallet_by_user_id($user_withdraw->withdraw_user_id);
                $update_notification = $this->db->where('wallet_user_id', $user_withdraw->withdraw_user_id)->update('b_wallet',['wallet_amount'=> $get_wallet->wallet_amount + $user_withdraw->withdraw_amount]);
            }

            if(!empty($user_withdraw)){
                $message_push = array(
                    "user_id"=>$user_withdraw->withdraw_user_id,
                    "other_id"=>$withdraw_id,
                    "sender_user_id"=>0,
                    "message"=>'Your Withdraw Request has been '.ucfirst($withdraw_status),
                    "type"=>"withdraw_request",
                    "title"=>"Withdraw Request"
                );
                $this->push_notification_function($message_push);
            }

            $data['admin_status'] = 'alert-success';
            $data['admin_message'] = 'Withdraw ' . ucfirst($withdraw_status);

            $this->session->set_flashdata('message',$data);
            redirect(base_url("admin/user_withdraw"));
        }else{
            echo "Error Reload";
        }
    }

    public function user_create(){
        if(!empty($this->session->userdata('admin_info')->admin_email)){
            $data['head_title'] = "Add User";
            $this->load->view('admin/user_create',$data);
        }else{
            redirect(base_url('admin'));
        }
    }

    public function user_store(){
        if(!empty($this->session->userdata('admin_info')->admin_email)){

            $user_arr['user_name'] = $this->input->post('user_name');
            $user_arr['user_email'] = $this->input->post('user_email');
            $user_arr['user_dob'] = $this->input->post('user_dob');
            $user_arr['user_phone'] = $this->input->post('user_phone');
            $user_arr['user_gender'] = $this->input->post('user_gender');
            $user_arr['user_password'] = sha1($this->input->post('user_password'));
            $user_arr['user_device'] = 'web';
            $user_arr['user_device_token'] = 'abcd1234';
            $user_arr['user_authentication'] = authentication();
            $user_arr['user_verify_token'] = null;
            $user_arr['user_is_verify'] = '1';
            $user_arr['user_is_blocked'] = '0';
            $user_arr['user_is_active'] = '1';
            $user_arr['user_created'] = date('Y-m-d H:i-s');
            $profile_image = isset($_FILES['user_image']['name'])?$_FILES['user_image']['name']:"";

            $email_check = $this->User_model->get_user_data_by_field_count(array("user_email"=>$user_arr['user_email'],"user_is_blocked"=>"0","user_is_active"=>"1"));

            if($email_check>0){
                $data['admin_status'] = 'alert-danger';
                $data['admin_message'] = 'Sorry! This Email Address is already exist.';
            }else{
                $last_id = $this->User_model->create_user($user_arr);
                if($last_id){
                    if(!empty($profile_image)){
						$profile_image = mt_rand().".png";
						$get_user_obj = $this->User_model->get_user_data_by_field(array("user_id"=>$last_id));
						if(empty($get_user_obj->user_image) || $get_user_obj->user_image == null){
							$move = move_uploaded_file($_FILES['user_image']['tmp_name'],getcwd()."/uploads/user/".$profile_image);
							$user_update['user_image'] = $profile_image;
						}
					    $update_user = $this->User_model->update_user($last_id,$user_update);
					}
                    $data['admin_status'] = 'alert-success';
                    $data['admin_message'] = 'User created successfully';
                    $this->session->set_flashdata('message',$data);
                    redirect(base_url('admin/user_listing'));
                }
                else{
                    $data['admin_status'] = 'alert-danger';
                    $data['admin_message'] = 'Sorry! there is some problem.';
                }
            }
            $this->session->set_flashdata('message',$data);
            redirect(base_url('admin/user_create'));
        }else{
            redirect(base_url('admin'));
        }
    }

    public function user_update(){
        if(!empty($this->session->userdata('admin_info')->admin_email)){

            $user_arr['user_id'] = $this->input->post('user_id');
            $user_arr['user_name'] = $this->input->post('user_name');
            // $user_arr['user_email'] = $this->input->post('user_email');
            $user_arr['user_dob'] = $this->input->post('user_dob');
            $user_arr['user_phone'] = $this->input->post('user_phone');
            $user_arr['user_gender'] = $this->input->post('user_gender');
            // $user_arr['user_password'] = sha1($this->input->post('user_password'));
            $user_arr['user_device'] = 'web';
            $user_arr['user_device_token'] = 'abcd1234';
            $user_arr['user_authentication'] = authentication();
            $user_arr['user_verify_token'] = null;
            $user_arr['user_is_verify'] = '1';
            $user_arr['user_is_blocked'] = '0';
            $user_arr['user_is_active'] = '1';
            $user_arr['user_created'] = date('Y-m-d H:i-s');
            $profile_image = isset($_FILES['user_image']['name'])?$_FILES['user_image']['name']:"";

            if(!empty($profile_image)){
                $profile_image = mt_rand().".png";
                $get_user_obj = $this->User_model->get_user_data_by_field(array("user_id"=>$user_arr['user_id']));
                if(empty($get_user_obj->user_image) || $get_user_obj->user_image == null){
                    $move = move_uploaded_file($_FILES['user_image']['tmp_name'],getcwd()."/uploads/user/".$profile_image);
                    $user_arr['user_image'] = $profile_image;
                }
            }
            $update_user = $this->User_model->update_user($user_arr['user_id'], $user_arr);

            $data['admin_status'] = 'alert-success';
            $data['admin_message'] = 'User updated successfully';

            $this->session->set_flashdata('message',$data);
            redirect(base_url('admin/user_listing'));
    
        }else{
            redirect(base_url('admin'));
        }
    }

    public function user_edit(){
        if(!empty($this->session->userdata('admin_info')->admin_email)){
            $user_id = $this->input->get('id');

            $get_user_obj = $this->User_model->get_user_data_by_field(array("user_id"=>$user_id));

            if(!empty($get_user_obj)){
                $data['head_title'] = "Update User";
                $data['user_obj'] = $get_user_obj;
                $this->load->view('admin/user_edit',$data);
            } else{
                $data['admin_status'] = 'alert-danger';
                $data['admin_message'] = 'Sorry! there is no user found.';
                $this->session->set_flashdata('message', $data);
                redirect(base_url('admin/user_listing'));
            }
        }else{
            redirect(base_url());
        }
    }

    public function user_delete(){
        if(!empty($this->session->userdata('admin_info')->admin_email)){
            $user_id = $this->input->get('id');

            $get_user_obj = $this->User_model->get_user_data_by_field(array("user_id"=>$user_id));

            if(!empty($get_user_obj)){

                $this->db->where('user_id', $user_id);
                $this->db->delete('b_user');

                $data['admin_status'] = 'alert-success';
                $data['admin_message'] = 'User deleted successfully.';
                $this->session->set_flashdata('message', $data);
            } else{
                $data['admin_status'] = 'alert-danger';
                $data['admin_message'] = 'Sorry! there is no user found.';
                $this->session->set_flashdata('message', $data);
            }
            redirect(base_url('admin/user_listing'));
        }else{
            redirect(base_url());
        }
    }

    public function user_blocked(){
        $user_id = $this->input->get('user_id');
        $value = $this->input->get('value');

        if(empty($user_id)){
        echo json_encode(array("status"=>0,"message"=>"User ID is required"));
        }else{
        $res = $this->Admin_model->user_is_blocked($user_id,$value);
        if($res){
            echo json_encode(array("status"=>1,"message"=>"Successfully"));
        }else{
            echo json_encode(array("status"=>0,"message"=>"Sorry there is some problem"));
        }
        }
    }

    public function content(){
        if(!empty($this->session->userdata('admin_info')->admin_email)){
        if($this->input->get('type') == "pp"){
            $content_type = "Privacy Policy";
        }else if($this->input->get('type') == "tc"){
            $content_type = "Terms and Conditions";
        }else if($this->input->get('type') == "faqs"){
            $content_type = "FAQs";
        }else if($this->input->get('type') == "contact"){
            $content_type = "Contact";
        }else if($this->input->get('type') == "about"){
            $content_type = "About";
        }else if($this->input->get('type') == "rp"){
            $content_type = "Return Policy";
        }else{
            $content_type = "Type Not given";
        }
        $data['head_title'] = "Content | ".$content_type;
        $data['content_type'] = $content_type;
        $type = $this->input->get('type');
        $data['content_obj'] = $this->Admin_model->get_content($type);
        $this->load->view('admin/content',$data);
        }else{
            redirect(base_url());
        }
    }

    public function content_update(){
        $content_id = $this->input->post('content_id');
        $content_type = $this->input->post('content_type');
        $content_content = $this->input->post('content_content');

        if(empty($content_id)){
            echo "Error content_id";
        }else if(empty($content_type)){
            echo "Error content_type";
        }else if(empty($content_content)){
            echo "Error content_content";
        }else{
            $res = $this->Admin_model->content_update($content_id,$content_content);
            if($res>0){
                redirect(base_url("admin/content?type=").$content_type);
            }else{
                echo "Error Reload";
            }
        }
    }

    public function logout(){
        $this->session->unset_userdata('admin_info');
        redirect(base_url('admin'));
    }

    public function push_notification_function($obj){
        $notification_check = $this->db->get_where('b_notification',
            [
                "notification_user_id"=>$obj['user_id'],
                "notification_sender_id"=>$obj['sender_user_id'],
                "notification_other_id"=>$obj['other_id'],
                "notification_type"=>$obj['type']
            ]
        )->num_rows();

        if($notification_check==0){
            $message_in_app = array(
                "notification_user_id"=>$obj['user_id'],
                "notification_sender_id"=>$obj['sender_user_id'],
                "notification_message"=>$obj['message'],
                "notification_type"=>$obj['type'],
                "notification_other_id"=>$obj['other_id'],
                "notification_is_read"=>"0",
                "is_admin"=>"1",
                "created_at"=>date('Y-m-d H:i:s'),
                "updated_at"=>date('Y-m-d H:i:s')
            );
            $this->db->insert('b_notification',$message_in_app);
        }
        $get_push_obj = $this->db->select('
            user_device_token,
            user_device,
            concat("'.$obj['message'].'") as message_notification,
            concat("'.$obj['type'].'") as notification_type,
            concat("'.$obj['other_id'].'") as other_id,
            concat("'.$obj['title'].'") as title
        ')->get_where('b_user',["user_id"=>$obj['user_id']])->row();
        if(!empty($get_push_obj->user_device_token)){
            return $this->push_notification($get_push_obj);
        }else{
            return 1;
        }
    }

    public function push_notification($object)
    {       
        $SERVER_API_KEY = 'AAAA1IZ1FxQ:APA91bElKEoLvSLtnX-h1ciJiKuw-oP6Yfc22QB1Wc-MWrqPzC5V0wi039ALSB-qYXmNjOLinYG_ko7sNFHtnKUY1kIaDOVZGOVtWfhjQAPRcddy9hH8lWVcEnSOjvZCxSlloDZveabO';
  
        $data = [
            "registration_ids" => [$object->user_device_token],
            "notification" => [
                "title" => $object->title,
                "body"  => $object->message_notification
            ]
        ];
        $dataString = json_encode($data);
    
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
               
        $response = curl_exec($ch);
  
        return $response;
    }
}
