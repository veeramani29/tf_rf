<?php
$atts = array(
  'width'      => '600',
  'height'     => '600',
  'scrollbars' => 'yes',
  'status'     => 'yes',
  'resizable'  => 'yes',
  'screenx'    => '420',
  'screeny'	   => '50',
  'location'   => 'no'
);
	echo anchor_popup('hauth/login/Google','Login With Google.', $atts).'<br />';
	
	echo anchor_popup('hauth/login/Twitter','Login With Twitter.', $atts).'<br />';
	
	echo anchor_popup('hauth/login/Facebook','Login With Facebook.', $atts).'<br />';
	
	echo anchor_popup('hauth/login/LinkedIn','Login With LinkedIn.', $atts).'<br />';
?>

