<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bank_transefers extends CI_Controller {

	

		public function __construct()
		{
		parent::__construct();
		$this->load->model('Transection_Model');
		$this->load->model('Subscriptions_Model');
		$this->load->model('Discount_Model');
		}

	public function index()
	{
		$data['success_msg']='';
		
		$get_all_transections=$this->Transection_Model->get_all_transections();
		$data['all_transections']=$get_all_transections;
		$this->load->view('manage_bank_transefers',$data);
	}


	public function add(){





$data['error_msg']='';
$data['success_msg']='';

$this->form_validation->set_rules('product_id', 'Product Name', 'trim|required|xss_clean');
$this->form_validation->set_rules('subscription_id', 'Subscriptions', 'trim|xss_clean|numeric|required');
$this->form_validation->set_rules('user_id', 'User Name', 'trim|numeric|required|xss_clean');
$this->form_validation->set_rules('currency', 'Currency', 'trim|required|xss_clean');
$this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean');
$this->form_validation->set_rules('payment_type', 'Payment Type', 'trim|required|xss_clean');
$this->form_validation->set_rules('payment_ref_id', 'Payment Ref', 'trim|required|xss_clean');
$this->form_validation->set_rules('payment_date', 'Payment Date', 'trim|required|xss_clean');



if ($this->form_validation->run() == TRUE){ 

$post_data=$this->input->post();
$post_data['added_by']=$this->session->userdata('admin_data')['user_id'];
$post_data['added_on']=date("Y-m-d H:i:s");
$get_results=$this->Transection_Model->insert_transection($post_data);
$data['success_msg']='Successfully added bank transfer details';
		
		}
$get_products=$this->Subscriptions_Model->get_products();
$data['products_all']=$get_products;
$this->load->view('add_transection',$data);
}



			public function	inactive($id){
			
			$this->db->where_in('transfer_id',$id);
			$this->db->update(BANK_TRANSFERS,array('payment_status' => 'Rejected' ));
			
			}


			

			



			public function	active($id){
			
			$this->db->where_in('transfer_id',$id);
			$this->db->update(BANK_TRANSFERS,array('payment_status' => 'Approved','approved_on' => date("Y-m-d H:i:s"),'approved_by' => $this->session->userdata('admin_data')['user_id'] ));
			
			}

	
	
}
