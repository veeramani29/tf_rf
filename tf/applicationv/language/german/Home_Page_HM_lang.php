<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		       
// Language Name :  german 
// Language Title :   Home_Page_HM
$ci =& get_instance();
$ci->load->model('Language_Model');
$languages = $ci->Language_Model->getlangdata('german','Home_Page_HM');
foreach($languages as $lng){
	$lang[$lng->label] = $lng->german;
}