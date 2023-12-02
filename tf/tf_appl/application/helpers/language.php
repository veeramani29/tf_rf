<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function lang_line($label){
     $ci =& get_instance(); 
    return $ci->lang->line($label);
}