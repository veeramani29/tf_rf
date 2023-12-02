<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class _404 extends CI_Controller {

	public function __construct(){
      parent::__construct();
	  
	}
	
	public function index(){
		$this->load->view('404');
	}
	
 

}
 
/* End of file 404.php */
/* Location: ./application/controllers/404.php */
