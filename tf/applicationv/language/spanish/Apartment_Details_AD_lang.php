<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		       
// Language Name :  Spanish 
// Language Title :   Apartment_Details_AD
$ci =& get_instance();
$ci->load->model('Language_Model');
$languages = $ci->Language_Model->getlangdata('spanish','Apartment_Details_AD');
foreach($languages as $lng){
	$lang[$lng->label] = $lng->spanish;
}

