<?php
function authentication(){
    return bin2hex(random_bytes(64));
}
function email_hit($email_arr)
{
  $ci =& get_instance();
  $ci->email->from('no-reply@appsstaging.com');
  $ci->email->to($email_arr['email']);
  $ci->email->subject($email_arr['subject']);
  $ci->email->message($email_arr['content']);
  if ($ci->email->send()) {
    return 1;
  } else {
    return 0;
  }
}
?>
