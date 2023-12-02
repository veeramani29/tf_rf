<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		       
// Language Name :  french 
// Language Title :   Help_HLP
$ci =& get_instance();
$ci->load->model('Language_Model');
$languages = $ci->Language_Model->getlangdata('french','Help_HLP');
foreach($languages as $lng){
	$lang[$lng->label] = $lng->french;
}

