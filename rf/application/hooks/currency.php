<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Currency{
	function __construct(){
       $display_currency;
       $display_icon;
       $curr_val;
    }

    function initializeData() {
    	$ci =& get_instance();
        $ci->load->library('session');
        $ci->load->helper('cookie');
        $ci->load->helper('file');
        $ci->load->helper('form');

        // if($ci->session->userdata('currency')){
        //     //redirect('http://www.google.com/'); 
        //     $currency = $ci->session->userdata('currency');
        // }else{
        // 	$currency =  array(
        //         'currency' => 'USD',
        //         'icon' => '$',
        //         'provider' => 'InnoGlobe'
        //     );
        //     $ci->session->set_userdata($currency);
        // }

        if($ci->input->cookie('currency')){
            $ci->display_currency = $ci->input->cookie('currency');
            $ci->display_icon = $ci->input->cookie('icon');
        }else{
        	$cookie = array(
			    'name'   => 'currency',
			    'value'  => CURR,
			    'expire' => '86500'
			);
            $ci->input->set_cookie($cookie);
            $cookie = array(
                'name'   => 'icon',
                'value'  => CURR_ICON,
                'expire' => '86500'
            );
            $ci->input->set_cookie($cookie);
            $ci->display_currency = CURR;
            $ci->display_icon = CURR_ICON;
        }
        $ci->curr_val = $ci->account_model->get_curr_val($ci->display_currency);

        if($ci->session->userdata('b2b_id')){
            $b2b_id = $ci->session->userdata('b2b_id');
            $modules = $ci->privilege_model->get_modules_by_b2b_id($b2b_id)->result();
            //echo $controller;
            //echo '<pre>';print_r($modules);
            $mod = array();
            foreach ($modules as $value) {
                $mod[] = $value->controller;
            }
            //echo '<pre>';print_r($mod);die;
            $ci->mod = $mod;
        }
    }
}