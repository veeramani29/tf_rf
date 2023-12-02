<?php
	echo '<pre>';print_r($b2c_data);
	// /echo '<pre>';print_r($user_contacts);
	//$this->load->helper('url');
	//echo $user_profile->email;
	echo anchor('hauth/logout/'.$provider.'/'.$b2c_data->user_id,'Logout.').'<br />';
?>
