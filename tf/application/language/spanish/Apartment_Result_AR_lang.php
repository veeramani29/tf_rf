<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		       
// Language Name :  Spanish 
// Language Title :   Apartment_Result_AR
$ci =& get_instance();
$ci->load->model('Language_Model');
$languages = $ci->Language_Model->getlangdata('spanish','Apartment_Result_AR');
foreach($languages as $lng){
	$lang[$lng->label] = $lng->spanish;
}

