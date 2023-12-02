<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		       
// Language Name :  French 
// Language Title :   Booking_Page_BP
$ci =& get_instance();
$ci->load->model('Language_Model');
$languages = $ci->Language_Model->getlangdata('french','Booking_Page_BP');
foreach($languages as $lng){
	$lang[$lng->label] = $lng->french;
}

