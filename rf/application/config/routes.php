<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|

|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['Flight'] = "flight/home";
$route['Hotel'] = "hotel/home";
$route['Car'] = "car/home";
$route['Vacation'] = "vacation/home";
$route['contact'] = "home/contact";
$route['feedback'] = "home/feedback";


$route['dashboard/support'] = "dashboard/support";
$route['dashboard/trips'] = "dashboard/index/trips";
$route['dashboard/profile'] = "dashboard/index/profile";
$route['dashboard/bookings'] = "dashboard/index/bookings";
$route['dashboard/settings'] = "dashboard/index/settings";
$route['dashboard/password'] = "dashboard/index/password";
$route['dashboard/deposit'] = "dashboard/index/deposit";
$route['dashboard/newsletter'] = "dashboard/index/newsletter";
$route['dashboard/profile/update'] = "dashboard/index/profile/update";
$route['dashboard/profile/verifications'] = "dashboard/index/profile/verifications";
$route['dashboard/profile/reviews'] = "dashboard/index/profile/reviews";
$route['dashboard/profile/references'] = "dashboard/index/profile/references";

$route['dashboard/updateProfile'] = "dashboard/updateProfile";
$route['dashboard/update_user_profile_image'] = "dashboard/update_user_profile_image";
$route['dashboard/ChangePassword'] = "dashboard/ChangePassword";
$route['dashboard/Update_public_private'] = "dashboard/Update_public_private";
$route['dashboard/validatePassword'] = "dashboard/validatePassword";
$route['dashboard/disconnect'] = "dashboard/disconnect";
$route['dashboard/disconnect/(:any)'] = "dashboard/disconnect/$1";
$route['dashboard/sendReference'] = "dashboard/sendReference";
$route['dashboard/get_mail_content_requestreference'] = "dashboard/get_mail_content_requestreference";
$route['dashboard/writeRequestReference'] = "dashboard/writeRequestReference";
$route['dashboard/messages'] = "dashboard/messages";

$route['dashboard/account_statement'] = "dashboard/account_statement";
$route['dashboard/booking_statement'] = "dashboard/booking_statement";


$route['dashboard/support_conversation'] = "dashboard/support_conversation";
$route['dashboard/support_conversation/(:any)'] = "dashboard/support_conversation/$1";

$route['dashboard/add_new_ticket'] = "dashboard/add_new_ticket";

$route['dashboard/delete_ticket'] = "dashboard/delete_ticket";
$route['dashboard/delete_ticket/(:any)'] = "dashboard/delete_ticket/$1";

$route['dashboard/view_ticket'] = "dashboard/view_ticket";
$route['dashboard/view_ticket/(:any)'] = "dashboard/view_ticket/$1";

$route['dashboard/close_ticket'] = "dashboard/close_ticket";
$route['dashboard/close_ticket/(:any)'] = "dashboard/close_ticket/$1";

$route['dashboard/reply_ticket'] = "dashboard/reply_ticket";
$route['dashboard/reply_ticket/(:any)'] = "dashboard/reply_ticket/$1";

$route['dashboard/download_file'] = "dashboard/download_file";
$route['dashboard/download_file/(:any)'] = "dashboard/download_file/$1";

$route['dashboard/ajax_getListing'] = "dashboard/ajax_getListing";
$route['dashboard/getDepositDetails'] = "dashboard/getDepositDetails";



$route['dashboard/(:any)'] = "error/page_missing";
//$route['users/(:any)'] = "users/index/$1";

$route['booking/docontinue/(:any)'] = "booking/docontinue/$1";
$route['booking/doPaymentGate/(:any)'] = "booking/doPaymentGate/$1";
$route['booking/promo'] = "booking/promo";
$route['booking/signup_login'] = "booking/signup_login";
$route['booking/checkout'] = "booking/checkout";
$route['booking/book'] = "booking/book";
$route['booking/book/(:any)'] = "booking/book/$1";
$route['booking/confirm'] = "booking/confirm";
$route['booking/confirm/(:any)'] = "booking/confirm/$1";
$route['booking/(:any)'] = "booking/index/$1";
//$route['tutorials/(:any)'] = "tutorials/index"; //this will comply with anything which is not tutorials/add

$route['default_controller'] = "home";
$route['404_override'] = 'error/page_missing';

require_once( BASEPATH .'database/DB'. EXT );
$db =& DB();
$query = $db->get( 'app_routes' );
$result = $query->result();
foreach( $result as $row ){
    $route[ $row->slug ] = "cms/pageById/".$row->id;
}

/* Location: ./application/config/routes.php */
