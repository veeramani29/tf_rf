<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		       
// Language Name :  spanish 
// Language Title :   Help_HLP
$ci =& get_instance();
$ci->load->model('Language_Model');
$languages = $ci->Language_Model->getlangdata('spanish','Help_HLP');
foreach($languages as $lng){
	$lang[$lng->label] = $lng->spanish;
}

