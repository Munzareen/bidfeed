<?php
class Social_media_model extends CI_Model {
	public function __construct() {
			parent::__construct();
			$this->load->database();
	}
	public function create_post($post_arr){
		$this->db->insert('b_post',$post_arr);
		return $this->db->insert_id();
	}
	public function get_post_by_id($post_id){
		return $this->db->select('
			post_id,
			post_user_id,
			(select user_name from b_user where user_id = b_post.post_user_id) as user_name,
			(select concat("'.base_url('uploads/user/').'",user_image) from b_user where user_id = b_post.post_user_id) as user_image,
			post_text,
			concat("'.base_url('uploads/post/').'",post_image) as post_image,
			post_color,
			post_type,
			post_is_blocked,
			post_created
		')->get_where('b_post',["post_id"=>$post_id])->row();
	}

    public function create_wallet($wallet_arr){
		$this->db->insert('b_wallet',$wallet_arr);
		return $this->db->insert_id();
	}

    public function create_withdraw($withdraw_arr){
		$this->db->insert('b_withdraw',$withdraw_arr);
		return $this->db->insert_id();
	}

    public function get_wallet_by_id($wallet_id){
		return $this->db->select('*')->get_where('b_wallet',["wallet_id"=>$wallet_id])->row();
	}
    public function get_wallet_by_user_id($user_id){
		return $this->db->select('*')->get_where('b_wallet',["wallet_user_id"=>$user_id])->row();
	}

    public function create_transaction($transaction_arr){
		$this->db->insert('b_transaction',$transaction_arr);
		return $this->db->insert_id();
	}

    public function get_bank_by_user_id($user_id){
		return $this->db->select('*')->get_where('b_bank',["bank_user_id"=>$user_id])->row();
	}

    public function create_bank($bank_arr){
		$this->db->insert('b_bank',$bank_arr);
		return $this->db->insert_id();
	}

	public function get_product_category(){
		return $this->db->get('b_product_category')->result_array();
	}
	public function create_product($create_product){
		$this->db->insert('b_product',$create_product);
		return $this->db->insert_id();
	}
	public function create_product_file($product_file){
		$this->db->insert('b_product_file',$product_file);
		return $this->db->insert_id();
	}
	public function create_pricing($product_pricing){
		$this->db->insert('b_product_pricing',$product_pricing);
		return $this->db->insert_id();
	}
	public function create_product_delivery($product_delivery){
		$this->db->insert('b_product_delivery',$product_delivery);
		return $this->db->insert_id();
	}
	public function create_product_delivery_detail($product_delivery_detail){
		$this->db->insert('b_product_delivery_detail',$product_delivery_detail);
		return $this->db->insert_id();
	}
	public function create_product_delivery_service($product_delivery_service){
		$this->db->insert('b_product_delivery_service',$product_delivery_service);
		return $this->db->insert_id();
	}
	public function get_product_featured($user_id){
		return $this->db->select('
			product_id,
			product_user_id,
			(select user_name from b_user where user_id = b_product.product_user_id) as user_name,
			(select concat("'.base_url('uploads/user/').'",user_image) from b_user where user_id = b_product.product_user_id) as user_image,
			(select pc_name from b_product_category where pc_id = b_product.product_pc_id) as pc_name,
			product_pc_id,
			product_description,
			(select concat("'.base_url('uploads/product/').'",pf_file) from b_product_file where pf_product_id = b_product.product_id order by pf_created desc limit 1) as product_image,
			(select count(like_id) from b_like where (like_user_id = "'.$user_id.'" AND like_other_id = b_product.product_id) AND like_type = "product") as is_liked
		')
		->from('b_product')
		->where('product_is_featured',"1")
		->order_by("product_created", "desc")
		->limit(10)
		->get()
		->result_array();
	}
	public function get_product_upcoming($user_id){
		return $this->db->select('
			product_id,
			product_user_id,
			(select user_name from b_user where user_id = b_product.product_user_id) as user_name,
			(select concat("'.base_url('uploads/user/').'",user_image) from b_user where user_id = b_product.product_user_id) as user_image,
			(select pc_name from b_product_category where pc_id = b_product.product_pc_id) as pc_name,
			product_pc_id,
			product_description,
			(select concat("'.base_url('uploads/product/').'",pf_file) from b_product_file where pf_product_id = b_product.product_id order by pf_created desc limit 1) as product_image,
			(select count(like_id) from b_like where (like_user_id = "'.$user_id.'" AND like_other_id = b_product.product_id) AND like_type = "product") as is_liked
		')
		->from('b_product')
		->where('product_upcoming',"1")
		->order_by("product_created", "desc")
		->get()
		->result_array();
	}
	public function get_product_detail($user_id,$product_id){
		$response_detail = $this->db->select('
			b_product.product_id,
			b_product.product_user_id,
			b_product.product_pc_id,
			(select user_name from b_user where user_id = b_product.product_user_id) as user_name,
			(select concat("'.base_url('uploads/user/').'",user_image) from b_user where user_id = b_product.product_user_id) as user_image,
			(select pc_name from b_product_category where pc_id = b_product.product_pc_id) as pc_name,
			b_product.product_condition,
			b_product.product_description,
			b_product_delivery.pd_cost,
			b_product_delivery.pd_internationally,
			b_product_delivery_detail.pdd_pounds,
			b_product_delivery_detail.pdd_ounces,
			b_product_delivery_detail.pdd_lenght,
			b_product_delivery_detail.pdd_width,
			b_product_delivery_detail.pdd_height,
			b_product_delivery_service.pds_type,
			b_product_delivery_service.pds_title,
			b_product_delivery_service.pds_price,
			b_product_delivery_service.pds_time,
			b_product_pricing.pp_type,
			b_product_pricing.pp_time,
			b_product_pricing.pp_price,
			(select count(like_id) from b_like where (like_user_id = "'.$user_id.'" AND like_other_id = b_product.product_id) AND like_type = "product") as is_liked,
			(select count(follow_id) from b_follow where follow_user_id = "'.$user_id.'" AND follow_follower_id = b_product.product_user_id) as is_follow,
			(select count(review_id) from b_review where review_user_id = "'.$user_id.'" AND review_product_id = b_product.product_id) as is_reviewed,
			b_product.product_created
		')
		->from('b_product')
		->where('b_product.product_id',$product_id)
		->join('b_product_delivery', 'b_product_delivery.pd_product_id = b_product.product_id', 'left')
		->join('b_product_delivery_detail', 'b_product_delivery_detail.pdd_pd_id = b_product_delivery.pd_id ', 'left')
		->join('b_product_delivery_service', 'b_product_delivery_service.pds_pd_id = b_product_delivery.pd_id ', 'left')
		->join('b_product_pricing', 'b_product_pricing.pp_product_id = b_product.product_id', 'left')
		->get()
		->row();
		if(count((array)$response_detail)>0){
			$product_files = $this->db->select('
				pf_id,
				pf_product_id,
				concat("'.base_url('uploads/product/').'",pf_file) as pf_file,
				pf_created
			')->get_where('b_product_file',["pf_product_id"=>$response_detail->product_id])->result_array();
			$row_arr['product_id'] = $response_detail->product_id;
			$row_arr['product_user_id'] = $response_detail->product_user_id;
			$row_arr['product_pc_id'] = $response_detail->product_pc_id;
			$row_arr['user_name'] = $response_detail->user_name;
			$row_arr['user_image'] = $response_detail->user_image;
			$row_arr['pc_name'] = $response_detail->pc_name;
			$row_arr['product_condition'] = $response_detail->product_condition;
			$row_arr['product_description'] = $response_detail->product_description;
			$row_arr['pd_cost'] = $response_detail->pd_cost;
			$row_arr['pd_internationally'] = $response_detail->pd_internationally;
			$row_arr['pdd_pounds'] = $response_detail->pdd_pounds;
			$row_arr['pdd_ounces'] = $response_detail->pdd_ounces;
			$row_arr['pdd_lenght'] = $response_detail->pdd_lenght;
			$row_arr['pdd_width'] = $response_detail->pdd_width;
			$row_arr['pdd_height'] = $response_detail->pdd_height;
			$row_arr['pds_type'] = $response_detail->pds_type;
			$row_arr['pds_title'] = $response_detail->pds_title;
			$row_arr['pds_price'] = $response_detail->pds_price;
			$row_arr['pds_time'] = $response_detail->pds_time;
			$row_arr['pp_type'] = $response_detail->pp_type;
			$row_arr['pp_time'] = $response_detail->pp_time;
			$row_arr['pp_price'] = $response_detail->pp_price;
			$row_arr['is_liked'] = $response_detail->is_liked;
			$row_arr['is_follow'] = $response_detail->is_follow;
			$row_arr['is_reviewed'] = $response_detail->is_reviewed;
			$row_arr['product_created'] = $response_detail->product_created;
			$row_arr['product_images'] = $product_files;
			return $row_arr;
		}else{
			return array();
		}
	}
	public function check_like($user_id,$other_id,$type){
		return $this->db->get_where('b_like',["like_user_id"=>$user_id,"like_other_id"=>$other_id,"like_type"=>$type])->row();
	}
	public function unlike($like_id){
		return $this->db->where('like_id',$like_id)->delete('b_like');
	}
	public function like($row_like){
		return $this->db->insert('b_like',$row_like);
	}
	public function create_comment($row_comment){
		$this->db->insert('b_comment',$row_comment);
		return $this->db->insert_id();
	}
	public function get_comment($comment_id){
		return $this->db->select('
			comment_id,
			comment_user_id,
			(select user_name from b_user where user_id = b_comment.comment_user_id) as user_name,
			(select concat("'.base_url('uploads/user/').'",user_image) from b_user where user_id = b_comment.comment_user_id) as user_image,
			comment_other_id,
			comment_comment,
			comment_type,
			comment_created
		')->get_where('b_comment',["comment_id"=>$comment_id])->row();
	}
	public function get_comments($other_id,$type){
		return $this->db->select('
		comment_id,
		comment_user_id,
		(select user_name from b_user where user_id = b_comment.comment_user_id) as user_name,
		(select concat("'.base_url('uploads/user/').'",user_image) from b_user where user_id = b_comment.comment_user_id) as user_image,
		comment_other_id,
		comment_comment,
		comment_type,
		comment_created
	')->get_where('b_comment',["comment_other_id"=>$other_id,"comment_type"=>$type])->result_array();
	}
	public function get_user_product($user_id,$other_id){
		return $this->db->select('
			product_id,
			product_user_id,
			(select user_name from b_user where user_id = b_product.product_user_id) as user_name,
			(select concat("'.base_url('uploads/user/').'",user_image) from b_user where user_id = b_product.product_user_id) as user_image,
			(select pc_name from b_product_category where pc_id = b_product.product_pc_id) as pc_name,
			product_pc_id,
			product_description,
			(select pp_price from b_product_pricing where pp_product_id = b_product.product_id limit 1) as product_price,
			(select concat("'.base_url('uploads/product/').'",pf_file) from b_product_file where pf_product_id = b_product.product_id order by pf_created desc limit 1) as product_image,
			(select count(like_id) from b_like where (like_user_id = "'.$user_id.'" AND like_other_id = b_product.product_id) AND like_type = "product") as is_liked
		')
		->from('b_product')
		->where('product_user_id',$other_id)
		->order_by("product_created", "desc")
		->get()
		->result_array();
	}
	public function get_user_post($user_id,$other_id){
		return $this->db->select('
			post_id,
			post_user_id,
			(select user_name from b_user where user_id = b_post.post_user_id) as user_name,
			(select concat("'.base_url('uploads/user/').'",user_image) from b_user where user_id = b_post.post_user_id) as user_image,
			post_text,
			concat("'.base_url('uploads/post/').'",post_image) as post_image,
			post_color,
			post_type,
			(select count(like_id) from b_like where (like_user_id = "'.$user_id.'" AND like_other_id = b_post.post_id) AND like_type = "post") as is_liked
		')
		->from('b_post')
		->where('post_user_id',$other_id)
		->order_by("post_created", "desc")
		->get()
		->result_array();
	}
	public function check_follow($user_id,$follower_id){
		return $this->db->get_where('b_follow',["follow_user_id"=>$user_id,"follow_follower_id"=>$follower_id])->num_rows();
	}
	public function create_follow($row_follow){
		return $this->db->insert('b_follow',$row_follow);
	}
	public function get_follower_list($user_id,$other_id){
		return $this->db->select('
			follow_id,
			follow_user_id,
			(select user_name from b_user where user_id = b_follow.follow_follower_id) as user_name,
			(select concat("'.base_url('uploads/user/').'",user_image) from b_user where user_id = b_follow.follow_follower_id) as user_image,
			follow_follower_id,
			follow_created,
			(select count(follow_id) from b_follow as b where b.follow_user_id = "'.$user_id.'" and b.follow_follower_id = b_follow.follow_follower_id) as is_following
		')->get_where('b_follow',["follow_user_id"=>$other_id,"follow_follower_id !="=>$user_id])->result_array();
	}
	public function get_following_list($user_id,$other_id){
		return $this->db->select('
			follow_id,
			follow_user_id,
			(select user_name from b_user where user_id = b_follow.follow_user_id) as user_name,
			(select concat("'.base_url('uploads/user/').'",user_image) from b_user where user_id = b_follow.follow_user_id) as user_image,
			follow_follower_id,
			follow_created,
			(select count(follow_id) from b_follow as b where b.follow_user_id = "'.$user_id.'" and b.follow_follower_id = b_follow.follow_user_id) as is_following
		')->get_where('b_follow',["follow_follower_id"=>$other_id,"follow_user_id !="=>$user_id])->result_array();
	}
	public function get_chat_list($user_id){
		return $this->db->query('
		select 
		`user_id`, 
		`user_name`, 
		`user_image`, 
		`chat_message`, 
		`last_chat`,
		`unread`,
		`created_at` 
		from 
		((select 
		`b_user`.`user_id`, 
		`b_user`.`user_name`, 
		`b_user`.`user_image`, 
		`b_chat`.`chat_message`, 
		(select chat_message from b_chat as st where st.chat_sender_id = `b_user`.`user_id` OR st.chat_reciever_id = `b_user`.`user_id` order by created_at desc limit 1) as last_chat,
		`b_chat`.`chat_read_at` as unread, 
		`b_chat`.`created_at` 
		from `b_chat` 
		left join `b_user` on `b_user`.`user_id` = `b_chat`.`chat_sender_id` 
		where `b_chat`.`chat_reciever_id` = "'.$user_id.'") 
		union 
		(select 
		`b_user`.`user_id`, 
		`b_user`.`user_name`, 
		`b_user`.`user_image`, 
		`b_chat`.`chat_message`, 
		(select chat_message from b_chat as st where st.chat_sender_id = `b_user`.`user_id` OR st.chat_reciever_id = `b_user`.`user_id` order by created_at desc limit 1) as last_chat,
		`b_chat`.`chat_read_at` as unread, 
		`b_chat`.`created_at` 
		from `b_chat` 
		left join `b_user` on `b_user`.`user_id` = `b_chat`.`chat_reciever_id` 
		where `b_chat`.`chat_sender_id` = "'.$user_id.'")) as `p_pn` group by `user_id` order by `created_at` desc		
		
		')->result_array();
	}
	public function get_message_list($user_id,$reciever_id,$offset){
		return $this->db->query('select 
		b_user.user_name,
		b_user.user_image, 
		b_chat.chat_id, 
		b_chat.chat_sender_id,
		b_chat.chat_reciever_id, 
		b_chat.chat_message,
		`b_chat`.`chat_read_at` as unread,
		b_chat.created_at
		from b_chat 
		inner join b_user on b_chat.chat_sender_id = b_user.user_id
		WHERE (b_chat.chat_sender_id = "'.$user_id.'"
		AND b_chat.chat_reciever_id="'.$reciever_id.'") 
		OR (b_chat.chat_sender_id="'.$reciever_id.'"
		AND b_chat.chat_reciever_id="'.$user_id.'") 
		order by b_chat.chat_id desc limit 20 offset '.$offset)->result_array();
	}
	public function update_read_time($user_id,$reciever_id){
		return $this->db->query('update `b_chat` SET chat_read_at = NOW() WHERE (b_chat.chat_sender_id = "'.$user_id.'"
		AND b_chat.chat_reciever_id="'.$reciever_id.'") 
		OR (b_chat.chat_sender_id="'.$reciever_id.'"
		AND b_chat.chat_reciever_id="'.$user_id.'")');
	}
	public function send_message($send_message){
		$this->db->insert('b_chat',$send_message);
		$chat_id = $this->db->insert_id();
		if($chat_id){
			return $this->db->query('select 
			b_user.user_name,
			b_user.user_image, 
			b_chat.chat_id, 
			b_chat.chat_sender_id,
			b_chat.chat_reciever_id, 
			b_chat.chat_message,
			`b_chat`.`chat_read_at` as unread, 
			b_chat.created_at
			FROM b_user
			JOIN b_chat
			ON b_user.user_id = b_chat.chat_sender_id
			WHERE b_chat.chat_id = '.$chat_id)->result_array();
		}else{
			return array();
		}
	}
	public function search_product_list($user_id){
		$tranding_products = $this->db->query('select 
			product_id,
			product_user_id,
			(select user_name from b_user where user_id = b_product.product_user_id) as user_name,
			(select concat("'.base_url('uploads/user/').'",user_image) from b_user where user_id = b_product.product_user_id) as user_image,
			(select pc_name from b_product_category where pc_id = b_product.product_pc_id) as pc_name,
			product_pc_id,
			product_description,
			(select concat("'.base_url('uploads/product/').'",pf_file) from b_product_file where pf_product_id = b_product.product_id order by pf_created desc limit 1) as product_image,
			(select count(like_id) from b_like where (like_user_id = "'.$user_id.'" AND like_other_id = b_product.product_id) AND like_type = "product") as is_liked
		from b_product 
		order by (select count(like_id) from b_like where like_other_id = b_product.product_id and like_type = "product") desc limit 25')
		->result_array();

		$popular_products = $this->db->query('select 
			product_id,
			product_user_id,
			(select user_name from b_user where user_id = b_product.product_user_id) as user_name,
			(select concat("'.base_url('uploads/user/').'",user_image) from b_user where user_id = b_product.product_user_id) as user_image,
			(select pc_name from b_product_category where pc_id = b_product.product_pc_id) as pc_name,
			product_pc_id,
			product_description,
			(select concat("'.base_url('uploads/product/').'",pf_file) from b_product_file where pf_product_id = b_product.product_id order by pf_created desc limit 1) as product_image,
			(select count(like_id) from b_like where (like_user_id = "'.$user_id.'" AND like_other_id = b_product.product_id) AND like_type = "product") as is_liked
		from b_product 
		order by (select count(comment_id) from b_comment where comment_other_id = b_product.product_id and comment_type = "product") desc limit 25')
		->result_array();

		return ["tranding_products"=>$tranding_products,"popular_product"=>$popular_products];
	}
	public function search_product($user_id,$key){
		return $this->db->select('
			product_id,
			product_user_id,
			(select user_name from b_user where user_id = b_product.product_user_id) as user_name,
			(select concat("'.base_url('uploads/user/').'",user_image) from b_user where user_id = b_product.product_user_id) as user_image,
			(select pc_name from b_product_category where pc_id = b_product.product_pc_id) as pc_name,
			product_pc_id,
			product_description,
			(select concat("'.base_url('uploads/product/').'",pf_file) from b_product_file where pf_product_id = b_product.product_id order by pf_created desc limit 1) as product_image,
			(select count(like_id) from b_like where (like_user_id = "'.$user_id.'" AND like_other_id = b_product.product_id) AND like_type = "product") as is_liked
		')
		->from('b_product')
		->like('(select pc_name from b_product_category where pc_id = b_product.product_pc_id)', $key, 'both')
		->get()
		->result_array();
	}
	public function search_post($user_id,$key){
		return $this->db->select('
			post_id,
			post_user_id,
			(select user_name from b_user where user_id = b_post.post_user_id) as user_name,
			(select concat("'.base_url('uploads/user/').'",user_image) from b_user where user_id = b_post.post_user_id) as user_image,
			post_text,
			concat("'.base_url('uploads/post/').'",post_image) as post_image,
			post_color,
			post_type,
			(select count(like_id) from b_like where (like_user_id = "'.$user_id.'" AND like_other_id = b_post.post_id) AND like_type = "post") as is_liked
		')
		->from('b_post')
		->like('post_text', $key, 'both')
		->get()
		->result_array();
	}
	public function search_user($user_id,$key){
		return $this->db->select('
			user_id,
			user_name,
			concat("'.base_url('uploads/user/').'",user_image) as user_image,
			(select count(follow_id) from b_follow where follow_user_id = "'.$user_id.'" AND follow_follower_id = b_user.user_id) as is_follow,
			(select count(follow_id) from b_follow where follow_follower_id = b_user.user_id) as total_follower,
			(select count(follow_id) from b_follow where follow_user_id = b_user.user_id) as total_following
		')
		->from('b_user')
		->where('user_id !=',$user_id)
		->like('user_name', $key, 'both')
		->get()
		->result_array();
	}
	public function create_order($order_arr){
		$this->db->insert('b_order',$order_arr);
		return $this->db->insert_id();
	}
	public function order_item($item_arr){
		$this->db->insert('b_order_item',$item_arr);
		return $this->db->insert_id();
	}
	public function get_order_listing($user_id){
		return $this->db->select('order_id,order_number,order_total_amount,order_created_at,(select count(oi_id) from b_order_item where oi_order_id=b_order.order_id) as total_product_count')->get_where('b_order',["order_user_id"=>$user_id])->result_array();
	}
	public function get_order_detail($order_id){
		$get_order = $this->db->get_where('b_order',["order_id"=>$order_id])->row();
		if($get_order){
			$new_arr['order_id'] = $get_order->order_id;
			$new_arr['order_user_id'] = $get_order->order_user_id;
			$new_arr['order_number'] = $get_order->order_number;
			$new_arr['order_total_amount'] = $get_order->order_total_amount;
			$new_arr['order_country'] = $get_order->order_country;
			$new_arr['order_city'] = $get_order->order_city;
			$new_arr['order_state'] = $get_order->order_state;
			$new_arr['order_address'] = $get_order->order_address;
			$new_arr['order_status'] = $get_order->order_status;
			$new_arr['order_created_at'] = $get_order->order_created_at;
			$new_arr['order_products'] = $this->db->select('
				b_product.product_id,
				b_product.product_user_id,
				(select user_name from b_user where user_id = b_product.product_user_id) as user_name,
				(select concat("'.base_url('uploads/user/').'",user_image) from b_user where user_id = b_product.product_user_id) as user_image,
				(select pc_name from b_product_category where pc_id = b_product.product_pc_id) as pc_name,
				b_product.product_pc_id,
				b_product.product_description,
				(select concat("'.base_url('uploads/product/').'",pf_file) from b_product_file where pf_product_id = b_product.product_id order by pf_created desc limit 1) as product_image,
				b_order_item.oi_price
			')
			->from('b_order_item')
			->join('b_product', 'b_product.product_id = b_order_item.oi_product_id', 'left')
			->where('b_order_item.oi_order_id',$get_order->order_id)
			->get()
			->result_array();
			return $new_arr;
		}else{
			return [];
		}
	}
	public function create_bid($bid_arr){
		return $this->db->insert('b_bid',$bid_arr);
	}
	public function get_bid_list($user_id){
		return $this->db->select('
			b_product.product_id,
			b_product.product_user_id,
			(select user_name from b_user where user_id = b_product.product_user_id) as user_name,
			(select concat("'.base_url('uploads/user/').'",user_image) from b_user where user_id = b_product.product_user_id) as user_image,
			(select pc_name from b_product_category where pc_id = b_product.product_pc_id) as pc_name,
			b_product.product_pc_id,
			b_product.product_description,
			(select concat("'.base_url('uploads/product/').'",pf_file) from b_product_file where pf_product_id = b_product.product_id order by pf_created desc limit 1) as product_image,
			b_bid.bid_amount,
            b_bid.bid_status,
            b_bid.bid_id
		')
		->from('b_bid')
		->join('b_product', 'b_product.product_id = b_bid.bid_product_id', 'left')
		->where('b_bid.bid_user_id',$user_id)
		->get()
		->result_array();
	}
	public function create_review($review_arr){
		return $this->db->insert('b_review',$review_arr);
	}
	public function get_product_review_list($product_id){
		return $this->db->select('
			review_id,
			review_user_id,
			(select user_name from b_user where user_id = b_review.review_user_id) as user_name,
			(select concat("'.base_url('uploads/user/').'",user_image) from b_user where user_id = b_review.review_user_id) as user_image,
			avg(review_rate) as review_rate,
			review_review,
			review_created
		')
		->from('b_review')
		->where('review_product_id',$product_id)
		->get()
		->result_array();
	}
	public function user_other_profile($user_id,$other_id){
		return $this->db->select('
			user_id,
			user_name,
			concat("'.base_url('uploads/user/').'",user_image) as user_image,
			(select count(follow_id) from b_follow where follow_user_id = "'.$user_id.'" AND follow_follower_id = b_user.user_id) as is_follow,
			(select count(follow_id) from b_follow where follow_follower_id = b_user.user_id) as total_follower,
			(select count(follow_id) from b_follow where follow_user_id = b_user.user_id) as total_following
		')
		->get_where('b_user',['user_id'=>$other_id])
		->result_array();
	}
}
