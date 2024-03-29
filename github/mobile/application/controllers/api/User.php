<?php defined('BASEPATH') OR exit('No direct script access allowed'); require APPPATH.'libraries/REST_Controller.php';
class User extends REST_Controller {
	private $_getJson = array();
	public function __construct(){
		parent::__construct();
	}
	public function user_post(){
		$user_arr['user_name'] = $this->input->post('user_name');
		$user_arr['user_email'] = $this->input->post('user_email');
		$user_arr['user_password'] = sha1($this->input->post('user_password'));
		$user_arr['user_device'] = $this->input->post('user_device');
		$user_arr['user_device_token'] = $this->input->post('user_device_token');
		$user_arr['user_authentication'] = authentication();
		$user_arr['user_verify_token'] = rand(100000,900000);
		$user_arr['user_is_verify'] = '1';
		$user_arr['user_is_blocked'] = '0';
		$user_arr['user_is_active'] = '1';
		$user_arr['user_created'] = date('Y-m-d H:i-s');
		try {
			if(empty($user_arr['user_email'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Email Address is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($user_arr['user_password'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Password is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else{
				$email_check = $this->User_model->get_user_data_by_field_count(array("user_email"=>$user_arr['user_email'],"user_is_blocked"=>"0","user_is_active"=>"1"));
				if($email_check>0){
					$this->_getJson['status'] = 0;
					$this->_getJson['message'] = "Sorry! This Email Address is already exist.";
					$error_code = REST_Controller::HTTP_NOT_FOUND;
				}else{
					$last_id = $this->User_model->create_user($user_arr);
					if($last_id){
						// $email_arr = array(
						// 	"email"=>$user_arr['user_email'],
						// 	"subject"=>"Verification Code",
						// 	"content"=>"Your signup verification code: ".$user_arr['user_verify_token']
						// );
						// $email_res = email_hit($email_arr);

						$get_user_obj = $this->User_model->get_user_data_by_field(array("user_id"=>$last_id,"user_is_blocked"=>"0","user_is_active"=>"1"));
						$data_set['user_id'] = $get_user_obj->user_id;
						$data_set['user_authentication'] = $get_user_obj->user_authentication;
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Successfully Signup! Kindly check your email verification code has been send on your email.";
						$this->_getJson['data'] = $get_user_obj;
						$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry! there is some problem.";
						$error_code = REST_Controller::HTTP_BAD_GATEWAY;
					}
				}
			}
		} catch (\Exception $e) {
			$this->_getJson['status'] = 0;
			$this->_getJson['message'] = $e->getMessage();
			$error_code = REST_Controller::HTTP_BAD_REQUEST;
		}
		$this->response($this->_getJson, $error_code);
	}
	public function login_post(){
		$user_email = $this->input->post('user_email');
		$user_password = sha1($this->input->post('user_password'));
		$user_authentication = authentication();
		$user_device = $this->input->post('user_device');
		$user_device_token = $this->input->post('user_device_token');

		try {
			if(empty($user_email)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Email Address is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($user_password)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Password is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else{
				$email_check = $this->User_model->get_user_data_by_field_count(array("user_email"=>$user_email));
				if($email_check>0){
					$is_blocked_check = $this->User_model->get_user_data_by_field_count(array("user_email"=>$user_email,"user_is_blocked"=>"0"));
					if($is_blocked_check>0){
						$login_check = $this->User_model->get_user_data_by_field_count(array("user_email"=>$user_email,"user_password"=>$user_password));
						if($login_check>0){
							$login_update = $this->User_model->get_user_data_by_field(array("user_email"=>$user_email,"user_password"=>$user_password));
							$update_user_data = $this->User_model->update_user($login_update->user_id,["user_authentication"=>$user_authentication,"user_device"=>$user_device,"user_device_token"=>$user_device_token]);
							$login_response = $this->User_model->get_user_data_by_field(array("user_id"=>$login_update->user_id));
							$verify_check = $this->User_model->get_user_data_by_field_count(array("user_email"=>$user_email,"user_is_verify"=>'1'));
							if($verify_check>0){
								$this->_getJson['status'] = 1;
								$this->_getJson['message'] = "Successfully Login Go and Enjoy your area.";
								$this->_getJson['data'] = $login_response;
								$error_code = REST_Controller::HTTP_OK;
							}else{
								$data_ser['user_id'] = $login_response->user_id;
								$data_ser['user_authentication'] = $login_response->user_authentication;
								$this->_getJson['status'] = 1;
								$this->_getJson['message'] = "Login error! resend your verification code.";
								$this->_getJson['data'] = $data_ser;
								$error_code = REST_Controller::HTTP_OK;
							}
						}else{
							$this->_getJson['status'] = 0;
							$this->_getJson['message'] = "Sorry! Password is incorrect.";
							$error_code = REST_Controller::HTTP_NOT_FOUND;
						}
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry! Yuor account is blocked by admin side.";
						$error_code = REST_Controller::HTTP_NOT_FOUND;
					}
				}else{
					$this->_getJson['status'] = 0;
					$this->_getJson['message'] = "Sorry! This Email Address is not exist.";
					$error_code = REST_Controller::HTTP_NOT_FOUND;
				}
			}
		} catch (\Exception $e) {
			$this->_getJson['status'] = 0;
			$this->_getJson['message'] = $e->getMessage();
			$error_code = REST_Controller::HTTP_BAD_REQUEST;
		}
		$this->response($this->_getJson, $error_code);
	}
	public function social_login_post(){
		$user_phone = $this->input->post('socail_token');
		$user_authentication = authentication();
		$user_device = $this->input->post('user_device');
		$user_device_token = $this->input->post('user_device_token');

		try {
			if(empty($user_phone)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User Phone is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else{
				$social_check = $this->User_model->get_user_data_by_field_count(array("user_phone"=>$user_phone));
				if($social_check>0){
					$login_update = $this->User_model->get_user_data_by_field(array("user_phone"=>$user_phone));
					$update_user_data = $this->User_model->update_user($login_update->user_id,["user_authentication"=>$user_authentication,"user_device"=>$user_device,"user_device_token"=>$user_device_token]);
					$login_response = $this->User_model->get_user_data_by_field(array("user_id"=>$login_update->user_id));
					$this->_getJson['status'] = 1;
					$this->_getJson['message'] = "Successfully Login Go and Enjoy your area.";
					$this->_getJson['data'] = $login_response;
					$error_code = REST_Controller::HTTP_OK;
				}else{
					$social_account = [
						"user_name"=>$this->input->post('user_name'),
						"user_phone"=>$user_phone,
						"user_authentication"=>$user_authentication,
						"user_device"=>$user_device,
						"user_device_token"=>$user_device_token,
						"user_is_blocked"=>"0",
						"user_is_active"=>"1",
						"user_created"=>date('Y-m-d H:i-s'),
					];
					$last_id = $this->User_model->create_user($social_account);
					if($last_id){
							$get_user_obj = $this->User_model->get_user_data_by_field(array("user_id"=>$last_id,"user_is_blocked"=>"0","user_is_active"=>"1"));
							$this->_getJson['status'] = 1;
							$this->_getJson['message'] = "Successfully Social Signup Go and Enjoy your area.";
							$this->_getJson['data'] = $get_user_obj;
							$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry! there is some problem.";
						$error_code = REST_Controller::HTTP_BAD_GATEWAY;
					}
				}
			}
		} catch (\Exception $e) {
			$this->_getJson['status'] = 0;
			$this->_getJson['message'] = $e->getMessage();
			$error_code = REST_Controller::HTTP_BAD_REQUEST;
		}
		$this->response($this->_getJson, $error_code);
	}
	public function verification_code_post(){
		$user_id = $this->input->post('user_id');
		$verification_code = $this->input->post('verification_code');
		$auth_token = $this->input->get_request_header('Authentication');

		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($verification_code)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Verification is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($auth_token)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Authentication is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){
					$match_code = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_verify_token"=>$verification_code));
					if($match_code>0){
						$update_user = $this->User_model->update_user($user_id,['user_verify_token'=>null,'user_is_verify'=>'1']);
						if($update_user>0){
							$get_user_obj = $this->User_model->get_user_data_by_field(array("user_id"=>$user_id));

							$this->_getJson['status'] = 1;
							$this->_getJson['message'] = "Successfully verified account.";
							$this->_getJson['data'] = $get_user_obj;
							$error_code = REST_Controller::HTTP_OK;
						}else{
							$this->_getJson['status'] = 0;
							$this->_getJson['message'] = "Sorry! There is some problem.";
							$error_code = REST_Controller::HTTP_NOT_FOUND;
						}
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry! Invalid.";
						$error_code = REST_Controller::HTTP_NOT_FOUND;
					}
				}else{
					$this->_getJson['status'] = 0;
					$this->_getJson['message'] = "Authentication is not valid.";
					$error_code = REST_Controller::HTTP_UNAUTHORIZED;
				}
			}
		} catch (\Exception $e) {
			$this->_getJson['status'] = 0;
			$this->_getJson['message'] = $e->getMessage();
			$error_code = REST_Controller::HTTP_BAD_REQUEST;
		}
		$this->response($this->_getJson, $error_code);
	}
	public function resend_code_get(){
		$user_id = $this->input->get('user_id');
		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else{
				$user_id_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id));
				if($user_id_checking>0){
					$user_obj = $this->User_model->get_user_data_by_field(array("user_id"=>$user_id));
					$new_code = rand(100000,900000);
					$email_arr = array(
						"email"=>$user_obj->user_email,
						"subject"=>"Resend Code.",
						"content"=>"Your verification code for Resend: ".$new_code
					);
					$email_res = email_hit($email_arr);
					if($email_res>0){
						$this->User_model->update_user($user_id,array("user_verify_token"=>$new_code));

						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Resend code Successfully send.";
						$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry! there is some problem.";
						$error_code = REST_Controller::HTTP_BAD_GATEWAY;
					}
				}else{
					$this->_getJson['status'] = 0;
					$this->_getJson['message'] = "User ID not exist.";
					$error_code = REST_Controller::HTTP_NOT_FOUND;
				}
			}
		} catch (\Exception $e) {
			$this->_getJson['status'] = 0;
			$this->_getJson['message'] = $e->getMessage();
			$error_code = REST_Controller::HTTP_BAD_REQUEST;
		}
		$this->response($this->_getJson, $error_code);
	}
	public function update_profile_post(){
		$user_id = $this->input->post('user_id');
		$user_update['user_name'] = $this->input->post('user_name');
		$user_update['user_dob'] = $this->input->post('user_dob');
		$user_update['user_phone'] = $this->input->post('user_phone');
		$user_update['user_gender'] = $this->input->post('user_gender');
		$user_update['user_profile_complete'] = "1";
		$profile_image = isset($_FILES['user_image']['name'])?$_FILES['user_image']['name']:"";
		$auth_token = $this->input->get_request_header('Authentication');
		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($auth_token)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Authentication is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){
					if(!empty($profile_image)){
						$profile_image = mt_rand().".png";
						$get_user_obj = $this->User_model->get_user_data_by_field(array("user_id"=>$user_id));
						if(empty($get_user_obj->user_image) || $get_user_obj->user_image == null){
							$move = move_uploaded_file($_FILES['user_image']['tmp_name'],getcwd()."/uploads/user/".$profile_image);
							$user_update['user_image'] = $profile_image;
						}else{
							$unlink = unlink(getcwd()."/uploads/user/".$get_user_obj->user_image_name);
							if($unlink>0){
								$move = move_uploaded_file($_FILES['user_image']['tmp_name'],getcwd()."/uploads/user/".$profile_image);
								$user_update['user_image'] = $profile_image;
							}else{
								$this->_getJson['status'] = 0;
								$this->_getJson['message'] = "Sorry! there is some problem.";
								$error_code = REST_Controller::HTTP_BAD_GATEWAY;
							}
						}
					}
					$update_user = $this->User_model->update_user($user_id,$user_update);
					if($update_user){
						$get_user_obj_data = $this->User_model->get_user_data_by_field(array("user_id"=>$user_id));

						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "User data update Successfully.";
						$this->_getJson['data'] = $get_user_obj_data;
						$error_code = REST_Controller::HTTP_OK;

					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry! there is some problem.";
						$error_code = REST_Controller::HTTP_BAD_GATEWAY;
					}
				}else{
					$this->_getJson['status'] = 0;
					$this->_getJson['message'] = "Authentication is not valid.";
					$error_code = REST_Controller::HTTP_UNAUTHORIZED;
				}
			}
		} catch (\Exception $e) {
			$this->_getJson['status'] = 0;
			$this->_getJson['message'] = $e->getMessage();
			$error_code = REST_Controller::HTTP_BAD_REQUEST;
		}
		$this->response($this->_getJson, $error_code);
	}
	public function forgot_password_post(){
		$user_email = $this->input->post('user_email');
		try {
			if(empty($user_email)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Email Address is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else{
				$check_email = $this->User_model->get_user_data_by_field_count(array("user_email"=>$user_email));
				if($check_email>0){
					$get_user_obj = $this->User_model->get_user_data_by_field(array("user_email"=>$user_email));
					$new_password = rand(100000,900000);
					$user_update['user_password'] = sha1($new_password);
					$update_user = $this->User_model->update_user($get_user_obj->user_id,$user_update);
					$email_arr = array(
						"email"=>$user_email,
						"subject"=>"Forgot Password OTP",
						"content"=>"Your OTP password: ".$new_password
					);
					$email_res = email_hit($email_arr);
					if($email_res>0){
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Email has been send on your email.";
						$error_code = REST_Controller::HTTP_OK;

					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry! there is some problem.";
						$error_code = REST_Controller::HTTP_BAD_GATEWAY;
					}
				}else{
					$this->_getJson['status'] = 0;
					$this->_getJson['message'] = "This email is not exist.";
					$error_code = REST_Controller::HTTP_BAD_GATEWAY;
				}
			}
		} catch (\Exception $e) {
			$this->_getJson['status'] = 0;
			$this->_getJson['message'] = $e->getMessage();
			$error_code = REST_Controller::HTTP_BAD_REQUEST;
		}
		$this->response($this->_getJson, $error_code);
	}
	public function user_verification_get(){
		$user_id = $this->input->get('user_id');
		$auth_token = $this->input->get_request_header('Authentication');
		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($auth_token)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Authentication is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){
					$update_user = $this->User_model->update_user($user_id,["user_is_verify"=>"1"]);
					if($update_user){
						$get_user_obj_data = $this->User_model->get_user_data_by_field(array("user_id"=>$user_id));

						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "User data update Successfully.";
						$this->_getJson['data'] = $get_user_obj_data;
						$error_code = REST_Controller::HTTP_OK;

					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry! there is some problem.";
						$error_code = REST_Controller::HTTP_BAD_GATEWAY;
					}
				}else{
					$this->_getJson['status'] = 0;
					$this->_getJson['message'] = "Authentication is not valid.";
					$error_code = REST_Controller::HTTP_UNAUTHORIZED;
				}
			}
		} catch (\Exception $e) {
			$this->_getJson['status'] = 0;
			$this->_getJson['message'] = $e->getMessage();
			$error_code = REST_Controller::HTTP_BAD_REQUEST;
		}
		$this->response($this->_getJson, $error_code);
	}
	public function content_get(){
		$type = $this->input->get('type'); //pp,tc,faqs,contact
		try {
			if(empty($type)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Type is Required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else{
				$get_content = $this->User_model->get_content($type);
				if(!empty($get_content->content_content)){
					$content['content_content'] = $get_content->content_content;

					$this->_getJson['status'] = 1;
					$this->_getJson['message'] = "content found.";
					$this->_getJson['data'] = $content;
					$error_code = REST_Controller::HTTP_OK;
				}else{
					$this->_getJson['status'] = 0;
					$this->_getJson['message'] = "No content found";
					$error_code = REST_Controller::HTTP_BAD_REQUEST;
				}
			}
		} catch (\Exception $e) {
			$this->_getJson['status'] = 0;
			$this->_getJson['message'] = $e->getMessage();
			$error_code = REST_Controller::HTTP_BAD_REQUEST;
		}
		$this->response($this->_getJson, $error_code);
	}

	// Starting delivery module
}
