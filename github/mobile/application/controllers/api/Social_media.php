<?php defined('BASEPATH') OR exit('No direct script access allowed'); require APPPATH.'libraries/REST_Controller.php';
class Social_media extends REST_Controller {
	private $_getJson = array();
	public function __construct(){
		parent::__construct();
	}
	public function create_post_post(){
		$user_id = $this->input->post('user_id');
		$create_post['post_user_id'] = $user_id;
		$create_post['post_type'] = 'file';
		$create_post['post_text'] = $this->input->post('post_text');
		$create_post['post_color'] = $this->input->post('post_color');
		$create_post['post_type'] = $this->input->post('post_type');
		$create_post['post_is_blocked'] = "0";
		$create_post['post_created'] = date('Y-m-d H:i:s');

		$post_image = isset($_FILES['post_image']['name'])?$_FILES['post_image']['name']:"";
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
					if(!empty($post_image)){
						$ext = pathinfo($post_image, PATHINFO_EXTENSION);
						$post_image = mt_rand().".".$ext;
						$move = move_uploaded_file($_FILES['post_image']['tmp_name'],getcwd()."/uploads/post/".$post_image);
						$create_post['post_image'] = $post_image;
					}					
					$post_create = $this->Social_media_model->create_post($create_post);
					if($post_create){
						$get_post_by_id = $this->Social_media_model->get_post_by_id($post_create);

						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Post create Successfully.";
						$this->_getJson['data'] = $get_post_by_id;
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
	public function get_product_category_get(){
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
					$get_product_category = $this->Social_media_model->get_product_category();
					if(count($get_product_category)>0){
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Product category found Successfully.";
						$this->_getJson['data'] = $get_product_category;
						$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is no product category found.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
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
	public function home_list_get(){
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
					$get_product_featured = $this->Social_media_model->get_product_featured($user_id);
					$get_product_upcoming = $this->Social_media_model->get_product_upcoming($user_id);
					$get_product = [
						"featured"=>$get_product_featured,
						"upcoming"=>$get_product_upcoming
					];
					if(count($get_product)>0){
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Product found Successfully.";
						$this->_getJson['data'] = $get_product;
						$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is no product found.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
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
	public function create_product_post(){
		$user_id = $this->input->post('user_id');
		$create_product['product_user_id'] = $user_id;
		$create_product['product_pc_id'] = $this->input->post('product_pc_id');
		$create_product['product_condition'] = $this->input->post('product_condition'); 
		$create_product['product_description'] = $this->input->post('product_description');
		$create_product['product_is_featured'] = $this->input->post('product_is_featured');
		$create_product['product_upcoming'] = $this->input->post('product_upcoming');
		$create_product['product_is_blocked'] = "0";
		$create_product['product_created'] = date('Y-m-d H:i:s');
		// product Pricing
		$product_pricing['pp_type'] = $this->input->post('pp_type'); //'auction', 'buy_now'
		$product_pricing['pp_time'] = $this->input->post('pp_time');
		$product_pricing['pp_price'] = $this->input->post('pp_price');
		$product_pricing['pp_created'] = date('Y-m-d H:i:s');
		// Product Delivery
		$product_delivery['pd_cost'] = $this->input->post('pd_cost');
		$product_delivery['pd_internationally'] = $this->input->post('pd_internationally'); // 0,1
		$product_delivery['pd_created'] = date('Y-m-d H:i:s');
		// Product Delivery Detail
		$product_delivery_detail['pdd_pounds'] = $this->input->post('pdd_pounds');
		$product_delivery_detail['pdd_ounces'] = $this->input->post('pdd_ounces');
		$product_delivery_detail['pdd_lenght'] = $this->input->post('pdd_lenght');
		$product_delivery_detail['pdd_width'] = $this->input->post('pdd_width');
		$product_delivery_detail['pdd_height'] = $this->input->post('pdd_height');
		$product_delivery_detail['pdd_created'] = date('Y-m-d H:i:s');
		// Product Delivery Service
		$product_delivery_service['pds_type'] = $this->input->post('pds_type');
		$product_delivery_service['pds_title'] = $this->input->post('pds_title');
		$product_delivery_service['pds_price'] = $this->input->post('pds_price');
		$product_delivery_service['pds_time'] = $this->input->post('pds_time');
		$product_delivery_service['pds_created'] = date('Y-m-d H:i:s');
		// For multiple file
		$product_image = $_FILES['product_image']['name'];
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
			}else if(empty($product_image)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Product Image is Required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else if(empty($product_pricing['pp_type'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Product Type is Required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED; 
			}else if(empty($product_pricing['pp_price'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Product Price is Required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else if(empty($product_delivery['pd_cost'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Product Delivery cost is Required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else if(empty($product_delivery_detail['pdd_pounds'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Product delivery pounds is Required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else if(empty($product_delivery_detail['pdd_ounces'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Product delivery ounces is Required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else if(empty($product_delivery_detail['pdd_lenght'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Product delivery lenght is Required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else if(empty($product_delivery_detail['pdd_width'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Product delivery width is Required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else if(empty($product_delivery_service['pds_type'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Product Delivery ship type is Required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else if(empty($product_delivery_service['pds_title'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Product Delivery title type is Required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else if(empty($product_delivery_service['pds_price'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Product Delivery price type is Required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){
					$product_id = $this->Social_media_model->create_product($create_product);
					if($product_id){
						$product_pricing['pp_product_id'] = $product_id;
						$create_pricing = $this->Social_media_model->create_pricing($product_pricing);
						for($i=0;$i<count((array)$product_image);$i++){
							$product_image = mt_rand().".png";
							$move = move_uploaded_file($_FILES['product_image']['tmp_name'][$i],getcwd()."/uploads/product/".$product_image);
							$product_file['pf_product_id'] = $product_id;
							$product_file['pf_file'] = $product_image;
							$product_file['pf_created'] = date('Y-m-d H:i:s');
							$post_create = $this->Social_media_model->create_product_file($product_file);
						}
						$product_delivery['pd_product_id'] = $product_id;
						$create_product_delivery = $this->Social_media_model->create_product_delivery($product_delivery);
						$product_delivery_detail['pdd_pd_id'] = $create_product_delivery;
						$create_product_delivery_detail = $this->Social_media_model->create_product_delivery_detail($product_delivery_detail);
						$product_delivery_service['pds_pd_id'] = $create_product_delivery;
						$create_product_delivery_service = $this->Social_media_model->create_product_delivery_service($product_delivery_service);
						if($create_product_delivery_service){
							$this->_getJson['status'] = 1;
							$this->_getJson['message'] = "Product create Successfully.";
							$error_code = REST_Controller::HTTP_OK;
						}else{
							$this->_getJson['status'] = 0;
							$this->_getJson['message'] = "Sorry! there is some problem.";
							$error_code = REST_Controller::HTTP_BAD_GATEWAY;
						}
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry! there is some problem while create product.";
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
	public function product_detail_get(){
		$user_id = $this->input->get('user_id');
		$product_id = $this->input->get('product_id');
		$auth_token = $this->input->get_request_header('Authentication');
		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($product_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Product ID is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else if(empty($auth_token)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Authentication is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){
					$get_product = $this->Social_media_model->get_product_detail($user_id,$product_id);
					if(count((array)$get_product)>0){
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Product detail found Successfully.";
						$this->_getJson['data'] = $get_product;
						$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is no product found.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
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
	public function create_like_post(){
		$user_id = $this->input->post('user_id');
		$other_id = $this->input->post('other_id'); // product ID and post ID
		$type = $this->input->post('type'); // product and post
		$auth_token = $this->input->get_request_header('Authentication');
		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($other_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Other ID is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else if(empty($type)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Type is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else if(empty($auth_token)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Authentication is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){
					$check_like = $this->Social_media_model->check_like($user_id,$other_id,$type);
					if(count((array)$check_like)>0){
						// unlike
						$unlike = $this->Social_media_model->unlike($check_like->like_id);
						if($unlike){
							$this->_getJson['status'] = 1;
							$this->_getJson['message'] = "Unlike Successfully.";
							$error_code = REST_Controller::HTTP_OK;
						}else{
							$this->_getJson['status'] = 0;
							$this->_getJson['message'] = "Sorry there is some problem.";
							$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
						}						
					}else{
						// like
						$row_like['like_user_id'] = $user_id;
						$row_like['like_other_id'] = $other_id;
						$row_like['like_type'] = $type;
						$row_like['like_created'] = date('Y-m-d H:i:s');
						$link = $this->Social_media_model->like($row_like);


						if($type == "post"){
							$user_id_push = $this->db->select('b_user.user_id,b_post.post_id as p_id')
							->from('b_post')
							->where('b_post.post_id', $other_id)
							->join('b_user', 'b_user.user_id = b_post.post_user_id', 'left')
							->get()
							->row(); 
						}else{
							$user_id_push = $this->db->select('b_user.user_id,b_product.product_id as p_id')
							->from('b_product')
							->where('b_product.product_id', $other_id)
							->join('b_user', 'b_user.user_id = b_product.product_user_id', 'left')
							->get()
							->row(); 
						}
						 
						$user_name_push = $this->db->select('user_id,user_name')->get_where('b_user',['user_id'=>$user_id])->row();

						$message_push = array(
							"user_id"=>$user_id_push->user_id,
							"other_id"=>$user_id_push->p_id,
							"sender_user_id"=>$user_name_push->user_id,
							"message"=>$user_name_push->user_name." liked your ".$type,
							"type"=>$type."_like"
						);

						if($user_id_push->user_id != $user_id){
							$this->push_notification_function($message_push);
						}



						if($link){
							$this->_getJson['status'] = 1;
							$this->_getJson['message'] = "Like Successfully.";
							$error_code = REST_Controller::HTTP_OK;
						}else{
							$this->_getJson['status'] = 0;
							$this->_getJson['message'] = "Sorry there is some problem.";
							$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
						}	
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
	public function create_comment_post(){
        error_reporting(0);
		$user_id = $this->input->post('user_id');
		$other_id = $this->input->post('other_id'); // product ID and post ID
		$text = $this->input->post('text'); // product ID and post ID
		$type = $this->input->post('type'); // product and post
		$auth_token = $this->input->get_request_header('Authentication');
		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($other_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Other ID is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else if(empty($text)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Text is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else if(empty($type)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Type is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else if(empty($auth_token)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Authentication is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){
					$row_comment['comment_user_id'] = $user_id;
					$row_comment['comment_other_id'] = $other_id;
					$row_comment['comment_comment'] = $text;
					$row_comment['comment_type'] = $type;
					$row_comment['comment_created'] = date('Y-m-d H:i:s');					
					$create_comment = $this->Social_media_model->create_comment($row_comment);

					if($type == "post"){
						$user_id_push = $this->db->select('b_user.user_id,b_post.post_id as p_id')
						->from('b_post')
						->where('b_post.post_id', $other_id)
						->join('b_user', 'b_user.user_id = b_post.post_user_id', 'left')
						->get()
						->row(); 
					}else{
						$user_id_push = $this->db->select('b_user.user_id,b_product.product_id as p_id')
						->from('b_product')
						->where('b_product.product_id', $other_id)
						->join('b_user', 'b_user.user_id = b_product.product_user_id', 'left')
						->get()
						->row(); 
					}
					 
					$user_name_push = $this->db->select('user_id,user_name')->get_where('b_user',['user_id'=>$user_id])->row();

					$message_push = array(
						"user_id"=>$user_id_push->user_id,
						"other_id"=>$user_id_push->p_id,
						"sender_user_id"=>$user_name_push->user_id,
						"message"=>$user_name_push->user_name." Comment on your ".$type,
						"type"=>$type."_comment"
					);

					if($user_id_push->user_id != $user_id){
						$this->push_notification_function($message_push);
					}

					if($create_comment){
						// get comment
						$get_comment = $this->Social_media_model->get_comment($create_comment);
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Comment Successfully.";
						$this->_getJson['data'] = $get_comment;
						$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is some problem.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
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
	public function list_comment_get(){
		$user_id = $this->input->get('user_id');
		$other_id = $this->input->get('other_id');
		$type = $this->input->get('type');
		$auth_token = $this->input->get_request_header('Authentication');
		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($other_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Other ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($type)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Type is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($auth_token)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Authentication is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){
					$get_comments = $this->Social_media_model->get_comments($other_id,$type);
					if(count((array)$get_comments)>0){
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Comment list is found Successfully.";
						$this->_getJson['data'] = $get_comments;
						$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is no comment list found.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
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
	public function user_product_list_get(){
		$user_id = $this->input->get('user_id');
		$other_id = $this->input->get('other_id'); //other user_id
		$auth_token = $this->input->get_request_header('Authentication');
		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($other_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Other ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($auth_token)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Authentication is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){
					$get_user_product = $this->Social_media_model->get_user_product($user_id,$other_id);
					if(count((array)$get_user_product)>0){
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "User Product list is found Successfully.";
						$this->_getJson['data'] = $get_user_product;
						$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is no user product list found.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
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
	public function user_post_list_get(){
		$user_id = $this->input->get('user_id');
		$other_id = $this->input->get('other_id'); //other user_id
		$auth_token = $this->input->get_request_header('Authentication');
		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($other_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Other ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($auth_token)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Authentication is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){
					$get_user_post = $this->Social_media_model->get_user_post($user_id,$other_id);
					if(count((array)$get_user_post)>0){
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "User post list is found Successfully.";
						$this->_getJson['data'] = $get_user_post;
						$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is no user post list found.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
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
	public function create_follow_post(){
		$user_id = $this->input->post('user_id');
		$create_follow['follow_user_id'] = $user_id;
		$create_follow['follow_follower_id'] = $this->input->post('follower_id');
		$create_follow['follow_created'] = date('Y-m-d H:i:s');
		$auth_token = $this->input->get_request_header('Authentication');
		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($create_follow['follow_follower_id'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Follower ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($auth_token)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Authentication is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){
					$check_follow = $this->Social_media_model->check_follow($user_id,$create_follow['follow_follower_id']);
					if($check_follow>0){
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Already following.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
					}else{
						$create_follow = $this->Social_media_model->create_follow($create_follow);
						if($create_follow){
							$this->_getJson['status'] = 1;
							$this->_getJson['message'] = "Successfully following.";
							$error_code = REST_Controller::HTTP_OK;
						}else{
							$this->_getJson['status'] = 0;
							$this->_getJson['message'] = "Sorry there is some problem.";
							$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
						}
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
	public function list_follow_get(){
		$user_id = $this->input->get('user_id');
		$other_id = $this->input->get('other_id'); //other user_id
		$type = $this->input->get('type'); //follower and following
		$auth_token = $this->input->get_request_header('Authentication');
		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($other_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Other ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($type)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Type is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($auth_token)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Authentication is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){
					if($type == "follower"){
						$get_follower_list = $this->Social_media_model->get_follower_list($user_id,$other_id);
						if(count((array)$get_follower_list)>0){
							$this->_getJson['status'] = 1;
							$this->_getJson['message'] = "Follower list is found Successfully.";
							$this->_getJson['data'] = $get_follower_list;
							$error_code = REST_Controller::HTTP_OK;
						}else{
							$this->_getJson['status'] = 0;
							$this->_getJson['message'] = "Sorry there is no follower list found.";
							$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
						}
					}else if($type == "following"){
						$get_following_list = $this->Social_media_model->get_following_list($user_id,$other_id);
						if(count((array)$get_following_list)>0){
							$this->_getJson['status'] = 1;
							$this->_getJson['message'] = "Following list is found Successfully.";
							$this->_getJson['data'] = $get_following_list;
							$error_code = REST_Controller::HTTP_OK;
						}else{
							$this->_getJson['status'] = 0;
							$this->_getJson['message'] = "Sorry there is no following list found.";
							$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
						}
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
	public function chat_list_get(){
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
					$get_chat_list = $this->Social_media_model->get_chat_list($user_id);
					if(count($get_chat_list)>0){
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Chat list found Successfully.";
						$this->_getJson['data'] = $get_chat_list;
						$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is no Chat list found.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
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
	public function get_message_get(){
		$user_id = $this->input->get('user_id');
		$reciever_id = $this->input->get('reciever_id');
		$offset = $this->input->get('offset');
		$auth_token = $this->input->get_request_header('Authentication');
		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($reciever_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Reciever ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($auth_token)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Authentication is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){
					$get_message_list = $this->Social_media_model->get_message_list($user_id,$reciever_id,$offset);
					if(count($get_message_list)>0){
						$update_read_time = $this->Social_media_model->update_read_time($user_id,$reciever_id);
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Get Message list found Successfully.";
						$this->_getJson['data'] = $get_message_list;
						$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is no Message found.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
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
	public function send_message_post(){
		$user_id = $this->input->post('user_id');
		$reciever_id = $this->input->post('reciever_id');
		$message = $this->input->post('message');
		$auth_token = $this->input->get_request_header('Authentication');
		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($reciever_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Reciever ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($message)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Message is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($auth_token)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Authentication is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){
					$send_message['chat_sender_id'] = $user_id;
					$send_message['chat_reciever_id'] = $reciever_id;
					$send_message['chat_message'] = $message;
					$send_message['chat_status'] = "text";
					$send_message['created_at'] = date('Y-m-d H:i:s');
					$send_message = $this->Social_media_model->send_message($send_message);
					if(count($send_message)>0){
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Send Message found Successfully.";
						$this->_getJson['data'] = $send_message;
						$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is some error.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
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
	public function search_product_list_get(){
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
					$search_product_list = $this->Social_media_model->search_product_list($user_id);
					if($search_product_list){
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Search product listing found Successfully.";
						$this->_getJson['data'] = $search_product_list;
						$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is no product listing found.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
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
	public function search_get(){
		$user_id = $this->input->get('user_id');
		$key = $this->input->get('key');
		$type = $this->input->get('type'); //product , post , user
		$auth_token = $this->input->get_request_header('Authentication');
		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($key)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Key is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($type)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Type is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($auth_token)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Authentication is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){
					if($type == "product"){
						$search = $this->Social_media_model->search_product($user_id,$key);
					}else if($type == "post"){
						$search = $this->Social_media_model->search_post($user_id,$key);
					}else if($type == "user"){
						$search = $this->Social_media_model->search_user($user_id,$key);
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Invalid type.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
					}
					if(count($search)>0){
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Search Successfully.";
						$this->_getJson['data'] = $search;
						$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is no product listing found.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
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
	public function create_order_post(){
		$user_id = $this->input->post('user_id');
		$order_arr['order_user_id'] = $user_id;
		$order_arr['order_number'] = time().$user_id;
		$order_arr['order_total_amount'] = $this->input->post('order_total_amount');
		$order_arr['order_country'] = $this->input->post('order_country');
		$order_arr['order_city'] = $this->input->post('order_city');
		$order_arr['order_state'] = $this->input->post('order_state');
		$order_arr['order_address'] = $this->input->post('order_address');
		$products = $this->input->post('order_item'); //json format
		$auth_token = $this->input->get_request_header('Authentication');
		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($order_arr['order_total_amount'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Total amount is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($order_arr['order_address'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Address is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($products)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Items is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($auth_token)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Authentication is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){

                    $get_wallet = $this->Social_media_model->get_wallet_by_user_id($user_id);

                    if(!empty($get_wallet) && $get_wallet->wallet_amount > 0 && $get_wallet->wallet_amount >= $order_arr['order_total_amount']){
                        $order_id = $this->Social_media_model->create_order($order_arr);
                        if($order_id){
                            $products = json_decode($products);
                            foreach($products as $product){
                                $item_arr['oi_order_id'] = $order_id;
                                $item_arr['oi_product_id'] = $product->product_id;
                                $item_arr['oi_price'] = $product->product_price;
                                // $this->Social_media_model->order_item($item_arr);

                                // Add amount to product user wallet
                                $product_obj = $this->db->select('*')->get_where('b_product',["product_id"=>$product->product_id])->row();
                                $product_user_id = $product_obj->product_user_id;

                                $get_product_user_wallet = $this->Social_media_model->get_wallet_by_user_id($product_user_id);

                                if (!empty($get_product_user_wallet)){
                                    $update_notification = $this->db->where('wallet_user_id',$product_user_id)->update('b_wallet',['wallet_amount'=> $get_product_user_wallet->wallet_amount + $product->product_price]);
                                }
                                else{
                                    $create_wallet['wallet_user_id'] = $product_user_id;
                                    $create_wallet['wallet_amount'] = $product->product_price;
                                    $create_wallet['wallet_created_at'] = date('Y-m-d H:i:s');
                                    $wallet_create = $this->Social_media_model->create_wallet($create_wallet);
                                }
                                // End

                                // Push notification
                                $get_user = $this->User_model->get_user_data_by_field(['user_id' => $product_user_id]);
                                $get_auth_user = $this->User_model->get_user_data_by_field(['user_id' => $user_id]);

                                $message_push = array(
                                    "user_id"=>$get_user->user_id,
                                    "other_id"=>$product->product_id,
                                    "sender_user_id"=>$user_id,
                                    "message"=>$get_auth_user->user_name." purchase your ". $product_obj->product_description . ' product',
                                    "type"=>"order_create",
                                    "title"=>"Product Purchased"
                                );
                                if($get_user->user_id != $get_auth_user->user_id){
                                    $this->push_notification_function($message_push);
                                }
                                // echo "<pre>"; print_r($get_user->user_email); die;
                            }

                            // Cut amount from user wallet
                            $this->db->where('wallet_user_id',$user_id)->update('b_wallet',['wallet_amount'=> $get_wallet->wallet_amount - $order_arr['order_total_amount']]);

                            // Create transaction
                            $transaction_arr['transaction_user_id'] = $user_id;
                            $transaction_arr['transaction_no'] = date('YmdHis');
                            $transaction_arr['transaction_order_id'] = $order_id;
                            $transaction_arr['transaction_order_total_amount'] = $order_arr['order_total_amount'];
                            $transaction_arr['transaction_percent'] = 2.5;
                            $transaction_arr['transaction_percent_amount'] = ($order_arr['order_total_amount'] / 100) * 2.5;
                            $transaction_arr['transaction_created_at'] = date('Y-m-d H:i:s');
                            $this->Social_media_model->create_transaction($transaction_arr);

                            $this->_getJson['status'] = 1;
                            $this->_getJson['message'] = "Order create successfully.";
                            $error_code = REST_Controller::HTTP_OK;

                        }else{
                            $this->_getJson['status'] = 0;
                            $this->_getJson['message'] = "Sorry there is some problem while creating order.";
                            $error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
                        }					
                    }
                    else{
                        $this->_getJson['status'] = 0;
                        $this->_getJson['message'] = "Insufficient wallet amount.";
                        $error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
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
	public function list_order_get(){
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
					$get_order_listing = $this->Social_media_model->get_order_listing($user_id);
					if(count($get_order_listing)>0){
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Order Listing found.";
						$this->_getJson['data'] = $get_order_listing;
						$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is some problem while geting order listing.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
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
	public function detail_order_get(){
		$user_id = $this->input->get('user_id');
		$order_id = $this->input->get('order_id');
		$auth_token = $this->input->get_request_header('Authentication');
		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($order_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Order ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($auth_token)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Authentication is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){
					$get_order_detail = $this->Social_media_model->get_order_detail($order_id);
					if(count($get_order_detail)>0){
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Order Detail found.";
						$this->_getJson['data'] = $get_order_detail;
						$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is some problem while geting order detail.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
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
    public function bid_status_post(){
        $user_id = $this->input->post('user_id');
		$bid_arr['bid_id'] = $this->input->post('bid_id');
        $bid_arr['bid_status'] = $this->input->post('bid_status');
		$auth_token = $this->input->get_request_header('Authentication');

		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($bid_arr['bid_id'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Bid ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($bid_arr['bid_status'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Bid status is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if($bid_arr['bid_status'] != 'accept' && $bid_arr['bid_status'] != 'reject'){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Invalid bid status.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}
            else if(empty($auth_token)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Authentication is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){

                    $update_status = $this->db->where('bid_id',$bid_arr['bid_id'])->update('b_bid', $bid_arr);

					if($update_status){

                        $bid_user = $this->db->select('*')->get_where('b_bid', ['bid_id' => $bid_arr['bid_id']])->row();
                        $auth_user = $this->db->select('user_id,user_name')->get_where('b_user',['user_id'=>$user_id])->row();
						$message_push = array(
							"user_id"=>$bid_user->bid_user_id,
							"other_id"=>$bid_arr['bid_id'],
							"sender_user_id"=>$auth_user->user_id,
							"message"=>$auth_user->user_name . " " . $bid_arr['bid_status'] ." your bid",
							"type"=>"bid_status",
                            "title"=>"Bit ". ucfirst($bid_arr['bid_status'])
						);

						if($bid_user->bid_user_id != $auth_user->user_id){
							$this->push_notification_function($message_push);
						}

						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Bid ". $bid_arr['bid_status'] ." successfully.";
						$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is some problem while updateing bid status.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
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
	public function create_bid_post(){
		$user_id = $this->input->post('user_id');
		$bid_arr['bid_user_id'] = $user_id;
		$bid_arr['bid_product_id'] = $this->input->post('product_id');
		$bid_arr['bid_amount'] = $this->input->post('amount');
		$auth_token = $this->input->get_request_header('Authentication');
		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($bid_arr['bid_product_id'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Product ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($bid_arr['bid_amount'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Bid Amount is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($auth_token)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Authentication is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){
					$create_bid = $this->Social_media_model->create_bid($bid_arr);
					if($create_bid){
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Bid Create successfully.";
						$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is some problem while creating bid.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
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
	public function list_bid_get(){
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
					$get_bid_list = $this->Social_media_model->get_bid_list($user_id);
					if(count($get_bid_list)>0){
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Bid listing found.";
						$this->_getJson['data'] = $get_bid_list;
						$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is some problem while geting Bid listing.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
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

    public function list_review_get(){
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
					// $create_review = $this->Social_media_model->create_review($review_arr);

                    $reviews = $this->db->select('*')
							->from('b_review')
							->where('b_review.review_user_id', $user_id)
							->join('b_product', 'b_product.product_id = b_review.review_product_id', 'left')
							->get()->result_array();

					if(count($reviews) > 0){
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Review list found successfully.";
                        $this->_getJson['data'] = $reviews;
						$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Review list not found.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
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

	public function create_review_post(){
		$user_id = $this->input->post('user_id');
		$review_arr['review_user_id'] = $user_id;
		$review_arr['review_product_id'] = $this->input->post('review_product_id');
		$review_arr['review_rate'] = $this->input->post('review_rate');
		$review_arr['review_review'] = $this->input->post('review_review');
		$auth_token = $this->input->get_request_header('Authentication');
		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($review_arr['review_product_id'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Product ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($auth_token)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Authentication is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){
					$create_review = $this->Social_media_model->create_review($review_arr);
					if($create_review){
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Review Create successfully.";
						$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is some problem while creating Review.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
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
	public function product_review_get(){
		$user_id = $this->input->get('user_id');
		$product_id = $this->input->get('product_id');
		$auth_token = $this->input->get_request_header('Authentication');
		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($product_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Product ID is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else if(empty($auth_token)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Authentication is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){
					$get_product_review_list = $this->Social_media_model->get_product_review_list($product_id);
					if(count($get_product_review_list)>0){
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Product Review listing found.";
						$this->_getJson['data'] = $get_product_review_list;
						$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is some problem while geting Product Review listing.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
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
	public function notification_list_get(){
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
					
					$get_notification = $this->db->select('
						notification_id,
						(select user_name from b_user where user_id = b_notification.notification_sender_id) as user_name,
						(select user_image from b_user where user_id = b_notification.notification_sender_id) as user_image,
						notification_message,
						notification_other_id,
						notification_type,
						notification_is_read,
                        is_admin,
						created_at
					')->from('b_notification')->where(array("notification_user_id"=>$user_id))->order_by("created_at","desc")->get()->result_array();
					if(count($get_notification)>0){
						$update_notification = $this->db->where('notification_user_id',$user_id)->update('b_notification',['notification_is_read'=>'1']);
						$error_code = REST_Controller::HTTP_OK;
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Notification list found";
						$this->_getJson['data'] = $get_notification;
					}else{
						$error_code = REST_Controller::HTTP_BAD_REQUEST;
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is no notification found";
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
    public function notification_count_get(){

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
					
					$get_notification = $this->db->get_where('b_notification',["notification_user_id"=>$user_id,"notification_is_read"=>"0"])->num_rows();
					if($get_notification>0){
						$error_code = REST_Controller::HTTP_OK;
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Notification count found";
						$this->_getJson['data'] = $get_notification;
					}else{
						$error_code = REST_Controller::HTTP_BAD_REQUEST;
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is no notification count found";
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
            return 0;
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

	public function user_profile_get(){
		$user_id = $this->input->get('user_id');
		$other_user_id = $this->input->get('other_id');
		$auth_token = $this->input->get_request_header('Authentication');
		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($other_user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Other User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			}else if(empty($auth_token)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Authentication is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){
					$user_other_profile = $this->Social_media_model->user_other_profile($user_id,$other_user_id);
					if(count($user_other_profile)>0){
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "User Other Profile Successfully.";
						$this->_getJson['data'] = $user_other_profile;
						$error_code = REST_Controller::HTTP_OK;
					}else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is no User Other Profile found.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
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

    public function bank_get(){
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

                    $get_wallet_updated = $this->Social_media_model->get_bank_by_user_id($user_id);

                    if (!empty($get_wallet_updated)){
                        $error_code = REST_Controller::HTTP_OK;
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Bank found";
						$this->_getJson['data'] = $get_wallet_updated;
                    }
                    else{
						$error_code = REST_Controller::HTTP_BAD_REQUEST;
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is no bank found";
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

    public function withdraw_post(){
		$user_id = $this->input->post('user_id');

        $create_withdraw['withdraw_user_id'] = $user_id;
        $create_withdraw['withdraw_amount'] = $this->input->post('withdraw_amount');

		$auth_token = $this->input->get_request_header('Authentication');
		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			} else if(empty($create_withdraw['withdraw_amount'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "withdraw_amount is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			} else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){
                    
                    $get_bank = $this->Social_media_model->get_bank_by_user_id($user_id);
                    if (!empty($get_bank)){

                        $get_wallet = $this->Social_media_model->get_wallet_by_user_id($user_id);

                        if(empty($get_wallet)){
                            $this->_getJson['status'] = 0;
                            $this->_getJson['message'] = "Sorry there is no wallet amount";
                            $error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
                        } else{
                            if($create_withdraw['withdraw_amount'] > $get_wallet->wallet_amount){
                                $this->_getJson['status'] = 0;
                                $this->_getJson['message'] = "Withdraw amount can not be greater then wallet amount";
                                $error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
                            }
                            else{

                                $create_withdraw['created_at'] = date('Y-m-d H:i:s');
                                $bank_create = $this->Social_media_model->create_withdraw($create_withdraw);

                                $update_notification = $this->db->where('wallet_user_id',$user_id)->update('b_wallet',['wallet_amount'=> $get_wallet->wallet_amount - $create_withdraw['withdraw_amount']]);
                                $get_wallet_updated = $this->Social_media_model->get_wallet_by_user_id($user_id);

                                $this->_getJson['status'] = 1;
                                $this->_getJson['message'] = "Withdraw Successfully.";
                                $this->_getJson['data'] = $get_wallet_updated;
                                $error_code = REST_Controller::HTTP_OK;
                            }                        
                        }
                    }
                    else{
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Please add your bank account.";
						$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
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

    public function add_bank_post(){
		$user_id = $this->input->post('user_id');

        $create_bank['bank_user_id'] = $user_id;
        $create_bank['bank_bank_name'] = $this->input->post('bank_bank_name');
        $create_bank['bank_account_holder_name'] = $this->input->post('bank_account_holder_name');
        $create_bank['bank_account_no'] = $this->input->post('bank_account_no');
        $create_bank['bank_iban_no'] = $this->input->post('bank_iban_no');

		$auth_token = $this->input->get_request_header('Authentication');
		try {
			if(empty($user_id)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "User ID is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			} else if(empty($create_bank['bank_bank_name'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "bank_bank_name is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			} else if(empty($create_bank['bank_account_holder_name'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "bank_account_holder_name is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			} else if(empty($create_bank['bank_account_no'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "bank_account_no is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			} else if(empty($create_bank['bank_iban_no'])){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "bank_iban_no is required.";
				$error_code = REST_Controller::HTTP_PRECONDITION_REQUIRED;
			} else if(empty($auth_token)){
				$this->_getJson['status'] = 0;
				$this->_getJson['message'] = "Authentication is required.";
				$error_code = REST_Controller::HTTP_UNAUTHORIZED;
			}else{
				$auth_checking = $this->User_model->get_user_data_by_field_count(array("user_id"=>$user_id,"user_authentication"=>$auth_token));
				if($auth_checking>0){
                    
                    $get_wallet = $this->Social_media_model->get_bank_by_user_id($user_id);
                    if (!empty($get_wallet)){
                        $create_bank['updated_at'] = date('Y-m-d H:i:s');
                        $update_notification = $this->db->where('bank_user_id',$user_id)->update('b_bank', $create_bank);
                        $get_wallet_updated = $this->Social_media_model->get_bank_by_user_id($user_id);

                        $error_code = REST_Controller::HTTP_OK;
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Bank updated Successfully";
						$this->_getJson['data'] = $get_wallet_updated;
                    }
                    else{
                        $create_bank['created_at'] = date('Y-m-d H:i:s');
                        $bank_create = $this->Social_media_model->create_bank($create_bank);
						$get_bank_by_id = $this->Social_media_model->get_bank_by_user_id($user_id);

						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Bank created Successfully.";
						$this->_getJson['data'] = $get_bank_by_id;
						$error_code = REST_Controller::HTTP_OK;
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

    public function wallet_get(){
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

                    $get_wallet_updated = $this->Social_media_model->get_wallet_by_user_id($user_id);

                    if (!empty($get_wallet_updated)){
                        $error_code = REST_Controller::HTTP_OK;
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Wallet found";
						$this->_getJson['data'] = $get_wallet_updated;
                    }
                    else{
						$error_code = REST_Controller::HTTP_BAD_REQUEST;
						$this->_getJson['status'] = 0;
						$this->_getJson['message'] = "Sorry there is no wallet amount";
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
    public function add_wallet_post(){
		$user_id = $this->input->post('user_id');

        $create_wallet['wallet_user_id'] = $user_id;
        $create_wallet['wallet_amount'] = $this->input->post('wallet_amount');
		$create_wallet['wallet_created_at'] = date('Y-m-d H:i:s');

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
                    
                    $get_wallet = $this->Social_media_model->get_wallet_by_user_id($user_id);
                    if (!empty($get_wallet)){
                        $update_notification = $this->db->where('wallet_user_id',$user_id)->update('b_wallet',['wallet_amount'=> $get_wallet->wallet_amount + $create_wallet['wallet_amount']]);
                        $get_wallet_updated = $this->Social_media_model->get_wallet_by_user_id($user_id);

                        $error_code = REST_Controller::HTTP_OK;
						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Wallet found";
						$this->_getJson['data'] = $get_wallet_updated;
                    }
                    else{

                        $wallet_create = $this->Social_media_model->create_wallet($create_wallet);
						$get_wallet_by_id = $this->Social_media_model->get_wallet_by_id($wallet_create);

						$this->_getJson['status'] = 1;
						$this->_getJson['message'] = "Wallet create Successfully.";
						$this->_getJson['data'] = $get_wallet_by_id;
						$error_code = REST_Controller::HTTP_OK;
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
}
