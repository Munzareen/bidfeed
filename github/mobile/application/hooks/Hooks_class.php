<?php
class Hooks_class extends CI_Hooks {
	function hooks_verification(){
		$headers = apache_request_headers();
		$password = "Pikkrr@1234";//isset($headers['Access_token'])?$headers['Access_token']:"";
		if(empty($password) || $password == FALSE){
			echo json_encode(array("status"=>0,"message"=>" Access token is required for access api's"));exit;
		}else{
			$res = $this->encryption_password($password);
			if($res>0){
				return;
			}else{
				echo json_encode(array("status"=>0,"message"=>"Wrong Access token! Please enter correct Access token for accessing the api's"));exit;
			}
		}
	}
}
