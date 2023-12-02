<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class LanguageLoader
{  
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');

         $site_lang = $ci->session->userdata('language');
        if ($site_lang) {
           $lang_file=array('common');
            foreach ($lang_file as $file) {
               $ci->lang->load($file,$ci->session->userdata('language'));
            }
        } else {
            $lang_file=array('common');
            foreach ($lang_file as $file) {
               $ci->lang->load($file,'english');
            }            
        }       
    }
}