<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    function lang($label){
    	 $ci =& get_instance(); 
    	return $ci->lang->line($label);
    }