<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('debug'))
{
	function debug($item,$ext=0)
	{
		if($ext==1){
			echo  "<pre>";print_r($item);die;
		}else{
			echo  "<pre>";print_r($item);
		}
		

		
	}


	function include_scripts($scriptsfile)
	{


		if(file_exists(APPPATH."views/scripts/$scriptsfile.php")){
					require_once(APPPATH."views/scripts/$scriptsfile.php");

}
		

		
	}
}
