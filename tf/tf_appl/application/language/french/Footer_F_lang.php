<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		       
// Language Name :  french 
// Language Title :   Footer_F
$ci =& get_instance();
$ci->load->model('Language_Model');
$languages = $ci->Language_Model->getlangdata('french','Footer_F');
foreach($languages as $lng){
	$lang[$lng->label] = $lng->french;
}




