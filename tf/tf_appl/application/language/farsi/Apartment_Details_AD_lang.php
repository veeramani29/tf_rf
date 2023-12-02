<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		       
// Language Name :  Farsi 
// Language Title :   Apartment_Details_AD
$ci =& get_instance();
$ci->load->model('Language_Model');
$languages = $ci->Language_Model->getlangdata('farsi','Apartment_Details_AD');
foreach($languages as $lng){
	$lang[$lng->label] = $lng->farsi;
}

