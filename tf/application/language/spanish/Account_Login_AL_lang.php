<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		       
// Language Name :  spanish 
// Language Title :   Account_Login_AL
$ci =& get_instance();
$ci->load->model('Language_Model');
$languages = $ci->Language_Model->getlangdata('spanish','Account_Login_AL');
foreach($languages as $lng){
	$lang[$lng->label]=$lng->spanish;
}
