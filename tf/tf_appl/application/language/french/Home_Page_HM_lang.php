<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		       
// Language Name :  french 
// Language Title :   Home_Page_HM
$ci =& get_instance();
$ci->load->model('Language_Model');
$languages = $ci->Language_Model->getlangdata('french','Home_Page_HM');
foreach($languages as $lng){
	$lang[$lng->label] = $lng->french;
}