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
    redirect(base_url());
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
    redirect(base_url());
  }

  public function create_category(){
    if(!empty($this->session->userdata('admin_info')->admin_email)){
      $data['head_title'] = "Create Category";
      $this->load->view('admin/create_category',$data);
    }else{
      redirect(base_url());
    }
  }
  public function create_charge(){
    if(!empty($this->session->userdata('admin_info')->admin_email)){
      $data['head_title'] = "Create Location";
      $this->load->view('admin/create_charge',$data);
    }else{
      redirect(base_url());
    }
  }
  public function list_category(){
    if(!empty($this->session->userdata('admin_info')->admin_email)){
      $data['head_title'] = "List Category";
      $data['get_category'] = $this->Admin_model->get_category();
      $this->load->view('admin/list_category',$data);
    }else{
      redirect(base_url());
    }
  }
  public function list_charge(){
    if(!empty($this->session->userdata('admin_info')->admin_email)){
      $data['head_title'] = "List Chargies";
      $data['get_chargies'] = $this->Admin_model->get_chargies();
      $this->load->view('admin/list_chargies',$data);
    }else{
      redirect(base_url());
    }
  }
  public function list_order(){
    if(!empty($this->session->userdata('admin_info')->admin_email)){
      $data['head_title'] = "List Order's";
      $data['get_order'] = $this->Admin_model->get_order();
      $this->load->view('admin/list_order',$data);
    }else{
      redirect(base_url());
    }
  }
  public function detail_order(){
    if(!empty($this->session->userdata('admin_info')->admin_email)){
      $order_id = $this->input->get('order_id');
      $data['head_title'] = "Detail Order's";
      $data['get_detail_order'] = $this->Admin_model->get_detail_order($order_id);
      $this->load->view('admin/detail_order',$data);
    }else{
      redirect(base_url());
    }
  }
  public function create_category_fun(){
    if(!empty($this->session->userdata('admin_info')->admin_email)){
      $category_name = $this->input->post('category_name');
      if(!empty($category_name)){
        $arr_cate['category_name'] = $category_name;
        $check_category = $this->Admin_model->check_catgory($arr_cate);
        if($check_category){
          echo json_encode(array("status"=>0,"message"=>"Category name is already exist"));
        }else{
          $insert = $this->Admin_model->create_category($arr_cate);
          if($insert){
            echo json_encode(array("status"=>1,"message"=>"Category name create Successfully"));
          }else{
            echo json_encode(array("status"=>0,"message"=>"Sorry there is some problem."));
          }
        }
      }else{
        echo json_encode(array("status"=>0,"message"=>"Category name is requried"));
      }
    }else{
      echo json_encode(array("status"=>0,"message"=>"Session is required"));
    }
  }
  public function create_chargies_fun(){
    if(!empty($this->session->userdata('admin_info')->admin_email)){
      $dc_amount = $this->input->post('dc_amount');
      $dc_kg = $this->input->post('dc_kg');
      $dc_location = $this->input->post('dc_location');
      if(empty($dc_amount)){
        echo json_encode(array("status"=>0,"message"=>"Chargies amount is requried"));
      }else if(empty($dc_kg)){
        echo json_encode(array("status"=>0,"message"=>"Chargies KG is requried"));
      }else if(empty($dc_location)){
        echo json_encode(array("status"=>0,"message"=>"Chargies location is requried"));
      }else{
        $arr_char['dc_amount'] = $dc_amount;
        $arr_char['dc_kg'] = $dc_kg;
        $arr_char['dc_location'] = $dc_location;
        $check_char = $this->Admin_model->check_char($arr_char);
        if($check_char){
          echo json_encode(array("status"=>0,"message"=>"Delivery Chargies is already exist"));
        }else{
          $insert = $this->Admin_model->create_char($arr_char);
          if($insert){
            echo json_encode(array("status"=>1,"message"=>"Delivery Chargies create Successfully"));
          }else{
            echo json_encode(array("status"=>0,"message"=>"Sorry there is some problem."));
          }
        }
      }
    }else{
      echo json_encode(array("status"=>0,"message"=>"Session is required"));
    }
  }
  public function delete_category(){
    if(!empty($this->session->userdata('admin_info')->admin_email)){
      $category_id = $this->input->get('category_id');
      if(!empty($category_id)){
        $delete_cateogry = $this->Admin_model->delete_category($category_id);
        if($delete_cateogry){
          $data['admin_status'] = 'alert-success';
          $data['admin_message'] = 'Category Delete Successfully.';
        }else{
          $data['admin_status'] = 'alert-danger';
          $data['admin_message'] = 'Sorry there is some problem.';
        }
      }else{
        $data['admin_status'] = 'alert-danger';
        $data['admin_message'] = 'Category ID is required.';
      }
      $this->session->set_flashdata('message',$data);
      redirect(base_url('admin/list_category'));
    }else{
      redirect(base_url());
    }
  }
  public function delete_charge(){
    if(!empty($this->session->userdata('admin_info')->admin_email)){
      $dc_id = $this->input->get('dc_id');
      if(!empty($dc_id)){
        $delete_charge = $this->Admin_model->delete_charge($dc_id);
        if($delete_charge){
          $data['admin_status'] = 'alert-success';
          $data['admin_message'] = 'Charge Delete Successfully.';
        }else{
          $data['admin_status'] = 'alert-danger';
          $data['admin_message'] = 'Sorry there is some problem.';
        }
      }else{
        $data['admin_status'] = 'alert-danger';
        $data['admin_message'] = 'Charge ID is required.';
      }
      $this->session->set_flashdata('message',$data);
      redirect(base_url('admin/list_charge'));
    }else{
      redirect(base_url());
    }
  }
  public function delete_order(){
    if(!empty($this->session->userdata('admin_info')->admin_email)){
      $order_id = $this->input->get('order_id');
      if(!empty($order_id)){
        $delete_order = $this->Admin_model->delete_order($order_id);
        if($delete_order){
          $data['admin_status'] = 'alert-success';
          $data['admin_message'] = 'Order Delete Successfully.';
        }else{
          $data['admin_status'] = 'alert-danger';
          $data['admin_message'] = 'Sorry there is some problem.';
        }
      }else{
        $data['admin_status'] = 'alert-danger';
        $data['admin_message'] = 'Order ID is required.';
      }
      $this->session->set_flashdata('message',$data);
      redirect(base_url('admin/list_order'));
    }else{
      redirect(base_url());
    }
  }
  public function order_status(){
    if(!empty($this->session->userdata('admin_info')->admin_email)){
      $order_id = $this->input->post('order_id');
      if(!empty($order_id)){
        $arr = ["order_status"=>$this->input->post('value_change')];
        $update_order = $this->Admin_model->update_order($order_id,$arr);
        if($update_order){
          echo json_encode(array("status"=>1,"message"=>"Order Status update Successfully."));
        }else{
          echo json_encode(array("status"=>0,"message"=>"Sorry there is some problem."));
        }
      }else{
        echo json_encode(array("status"=>0,"message"=>"Order ID is required."));
      }
    }else{
      redirect(base_url());
    }
  }
}
