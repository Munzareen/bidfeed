<?php defined('BASEPATH') OR exit('No direct script access allowed');
//*******Admin Registration*******//
$route['admin']                                   = 'Admin/login_view';
$route['admin/login_fun']                         = 'Admin/login_fun';
$route['admin/forgot_password']                   = 'Admin/forgot_password';
$route['admin/forgot_password_fun']               = 'Admin/forgot_password_fun';
$route['admin/dashboard']                         = 'Admin/user_listing';
$route['admin/update_profile']                    = 'Admin/update_profile';
$route['content']                                 = 'Admin/content';
//*******Admin Menu*******//
$route['admin/user_listing']                      = 'Admin/user_listing';
$route['admin/block_user/(:any)']                 = 'Admin/block_user';
$route['admin/unblock_user/(:any)']               = 'Admin/unblock_user';

$route['admin/user_blocked']                      = 'Admin/user_blocked';
$route['content_update']                          = 'Admin/content_update';
$route['admin/logout']                            = 'Admin/logout';


//*******Api's Registration*********//
$route['api/user']                        = 'api/User/user';
$route['api/login']                       = 'api/User/login';
$route['api/social_login']                = 'api/User/social_login';
$route['api/verification_code']           = 'api/User/verification_code';
$route['api/resend_code']                 = 'api/User/resend_code';
$route['api/update_profile']              = 'api/User/update_profile';
$route['api/forgot_password']             = 'api/User/forgot_password';
$route['api/content']                     = 'api/User/content';

// Social media module
$route['api/create_post']                 = 'api/Social_media/create_post';
$route['api/get_product_category']        = 'api/Social_media/get_product_category';
$route['api/home_list']                   = 'api/Social_media/home_list';
$route['api/create_product']              = 'api/Social_media/create_product';
$route['api/product_detail']              = 'api/Social_media/product_detail';
$route['api/create_like']                 = 'api/Social_media/create_like';
$route['api/create_comment']              = 'api/Social_media/create_comment';
$route['api/list_comment']                = 'api/Social_media/list_comment';
$route['api/search_product_list']         = 'api/Social_media/search_product_list';
$route['api/search']                      = 'api/Social_media/search';
$route['api/user_product_list']           = 'api/Social_media/user_product_list';
$route['api/user_post_list']              = 'api/Social_media/user_post_list';
$route['api/create_follow']               = 'api/Social_media/create_follow';
$route['api/list_follow']                 = 'api/Social_media/list_follow';
$route['api/chat_list']                   = 'api/Social_media/chat_list';
$route['api/get_message']                 = 'api/Social_media/get_message';
$route['api/send_message']                = 'api/Social_media/send_message';
$route['api/create_order']                = 'api/Social_media/create_order';
$route['api/list_order']                  = 'api/Social_media/list_order';
$route['api/detail_order']                = 'api/Social_media/detail_order';
$route['api/create_bid']                  = 'api/Social_media/create_bid';
$route['api/list_bid']                    = 'api/Social_media/list_bid';
$route['api/bid_status']                  = 'api/Social_media/bid_status';

$route['api/list_review']                 = 'api/Social_media/list_review';
$route['api/create_review']               = 'api/Social_media/create_review';
$route['api/product_review']              = 'api/Social_media/product_review';
$route['api/notification_list']           = 'api/Social_media/notification_list';
$route['api/notification_count']          = 'api/Social_media/notification_count';
$route['api/user_profile']                = 'api/Social_media/user_profile';

// Wallet module
$route['api/get_wallet']                  = 'api/Social_media/wallet';
$route['api/add_wallet']                  = 'api/Social_media/add_wallet';

// Bank module
$route['api/get_bank']                  = 'api/Social_media/bank';
$route['api/add_bank']                  = 'api/Social_media/add_bank';

// Withdraw
$route['api/withdraw']                  = 'api/Social_media/withdraw';