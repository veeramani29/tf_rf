<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CMS extends CI_Controller {
	public function __construct(){
        	parent::__construct();
        	$this->load->model('CMS_Model');
		$this->load->model('Auth_Model');
		$this->load->model('Help_Model');
		$current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
		$current_url = $this->config->site_url().$this->uri->uri_string(). $current_url;
		$url =  array(
		    'continue' => $current_url,
		);
		$this->session->set_userdata($url);
       	 	$this->helpMenuLink = "";
        	$this->load->model('Help_Model');
		$this->helpMenuLink = $this->Help_Model->fetchHelpLinks();
		$this->load->model('example_model');
   	}
	public function getAllPages(){
		$data['staticMenu'] = $this->CMS_Model->getAllPages();
		
	}
	public function pageBySlug($slug){
		$data['page'] = $this->CMS_Model->pageBySlug($slug);
		if(!empty($data['page'])){
			$this->load->view('cms/page',$data);
		}else{
			redirect('');
		}
	}
	public function pageById($id){
		$data['page'] = $this->CMS_Model->pageById($id);
		if(!empty($data['page'])){
			$this->load->view('cms/page',$data);
		}else{
			redirect('');
		}
	}
}
?>
