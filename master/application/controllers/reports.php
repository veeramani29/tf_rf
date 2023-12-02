<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {

	

		public function __construct()
		{
		parent::__construct();
		//$this->load->model('Reports_Model');
		
		}

	
		public function index()
		{
		$this->load->view('reports');
		}

	public function subscription_edit($edit_id='')
	{

		if($edit_id!=null){

		$get_all_subscriptions=$this->Subscriptions_Model->get_edit_subscriptions($edit_id);
		$data['edit_subscriptions']=$get_all_subscriptions;
		return $this->load->view('ajax/quickedit',$data);
		}else{
		return $this->load->view('errors/error_404');
		}

		
	}


		
	
}
