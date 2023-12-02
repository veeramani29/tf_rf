<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('Auth_Model');
        $this->load->model('apartment_model');
        $this->load->model('apt_model');
        $this->load->helper('apartment_helper');
        $this->load->model('wishlist_model');
        $this->load->model('account_model');
        $this->load->model('Help_Model');
        $this->helpMenuLink = $this->Help_Model->fetchHelpLinks();
        
        $this->load->library(array('table','form_validation','session','javascript'));
        $this->load->library('pagination');
    }

    public function page_missing(){
        $this->load->view('errors/404');
    }
	 public function payment($msg='',$id='',$pay_id=''){
		 $data['msg'] = base64_decode($msg);
		 $data['order_id']= $id;
		  $data['pay_id']= $pay_id;
        $this->load->view('errors/payment_failure',$data);
    }
	public function payment_failure($msg=''){
		 $data['msg'] = base64_decode($msg);
		 $data['order_id']= '';
		   $data['pay_id']= '';
        $this->load->view('errors/payment_failure',$data);
    }
    
}

/* End of file apartment.php */
/* Location: ./application/controllers/apartment.php */
