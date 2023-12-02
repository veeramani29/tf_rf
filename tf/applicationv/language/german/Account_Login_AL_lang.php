<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		       
// Language Name :  german 
// Language Title :   Account_Login_AL
$ci =& get_instance();
$ci->load->model('Language_Model');
$languages = $ci->Language_Model->getlangdata('german','Account_Login_AL');
foreach($languages as $lng){
	$lang[$lng->label]=$lng->german;
}
