<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$this->load->model('Auth_Model');
		$this->load->model('account_model');
	}
	public function support_conversation() {
		if($this->session->userdata('b2c_id'))
		{
			$b2c_id = $this->session->userdata('b2c_id');
			$b2c_type = $this->account_model->getUserInfo($b2c_id)->user_type;
		}
		else if($this->session->userdata('b2b_id'))
		{
			$b2c_type = $this->session->userdata('b2b_type');
			$b2c_id = $this->session->userdata('b2b_id');
		}else{
			redirect('','refresh');
		}
		echo $b2c_type."<br/>".$b2c_id;
		$this->load->view('dashboard/support_conversation');
    	}
}
