<?php defined('BASEPATH') OR exit('No direct script access allowed');
// $route['default_controller']                      = 'Admin/login_view';
// //*******Admin Registration*******//
// $route['admin/login_fun']                         = 'Admin/login_fun';
// $route['admin/forgot_password']                   = 'Admin/forgot_password';
// $route['admin/forgot_password_fun']               = 'Admin/forgot_password_fun';
// $route['admin/dashboard']                         = 'Admin/user_listing';
// $route['admin/update_profile']                    = 'Admin/update_profile';
//
// $route['admin/create_category']                   = 'Admin/create_category';
// $route['admin/list_category']                     = 'Admin/list_category';
// $route['admin/create_location']                   = 'Admin/create_charge';
// $route['admin/list_location']                     = 'Admin/list_charge';
// $route['admin/list_order']                        = 'Admin/list_order';
// $route['admin/detail_order']                      = 'Admin/detail_order';
// $route['content']                                 = 'Admin/content';
// //*******Admin Menu*******//
// $route['admin/user_listing']                      = 'Admin/user_listing';
// $route['admin/user_blocked']                      = 'Admin/user_blocked';
// $route['content_update']                          = 'Admin/content_update';
// $route['admin/logout']                            = 'Admin/logout';
// $route['admin/create_category_fun']               = 'Admin/create_category_fun';
// $route['admin/create_chargies_fun']               = 'Admin/create_chargies_fun';
// $route['admin/delete_category']                   = 'Admin/delete_category';
// $route['admin/delete_charge']                     = 'Admin/delete_charge';
// $route['admin/delete_order']                      = 'Admin/delete_order';
// $route['admin/order_status']                      = 'Admin/order_status';
//*******Api's Registration*********//
$route['api/user']                        = 'api/User/user';
$route['api/login']                       = 'api/User/login';
$route['api/social_login']                = 'api/User/social_login';
$route['api/verification_code']           = 'api/User/verification_code';
$route['api/resend_code']                 = 'api/User/resend_code';
$route['api/update_profile']              = 'api/User/update_profile';
$route['api/forgot_password']             = 'api/User/forgot_password';
$route['api/content']                     = 'api/User/content';
