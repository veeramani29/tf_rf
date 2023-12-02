<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Discount extends CI_Controller {

	

		public function __construct()
		{
		parent::__construct();
		$this->load->model('Discount_Model');
		$this->load->model('Subscriptions_Model');
		}

	public function index()
	{
		$data['success_msg']='';
		
		if($this->input->post('hdnMethod')=='Active'){
			$this->active($this->input->post('Checkall'));
			$data['success_msg']='Selected items are activated';
		}elseif($this->input->post('hdnMethod')=='Inactive'){
			$this->inactive($this->input->post('Checkall'));
			$data['success_msg']='Selected items are inactivated';
		}
		$get_all_discounts=$this->Discount_Model->get_all_discounts();
		$data['all_discounts']=$get_all_discounts;
		$this->load->view('manage_discounts',$data);
	}

	public function add()
	{
		$data['success_msg']='';$data['error_msg']='';
		
		$this->form_validation->set_rules('product_id', 'Product Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('subscription_id', 'Subscription Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('discount_code', 'Discount Code', 'trim|xss_clean|required|is_unique['.DISCOUNTS.'.discount_code]');
		$this->form_validation->set_rules('discount_type', 'Discount Type', 'trim|required|xss_clean');
		
		if($this->input->post('discount_type')==1){
			$this->form_validation->set_rules('discount', 'Discount', 'trim|required|xss_clean|callback_maximumCheck');
		}else{

			$this->form_validation->set_rules('discount', 'Discount', 'trim|required|xss_clean');
			$this->form_validation->set_rules('currency', 'Currency', 'trim|required|xss_clean');
		}
		
		
		$this->form_validation->set_rules('end_date', 'End Date', 'trim|required|xss_clean');



		if ($this->form_validation->run() == TRUE)
		{ 
			$post_data=$this->input->post();
			
			$post_data['added_by']=$this->session->userdata('admin_data')['user_id'];
			$post_data['added_on']=date("Y-m-d H:i:s");
			$get_last_id=$this->Discount_Model->insert_discounts($post_data);
			$data['success_msg']='Successfully added  discount details';
		}
		$get_products=$this->Subscriptions_Model->get_products();
		$data['products_all']=$get_products;
		$this->load->view('add_discount',$data);
	}


		function maximumCheck($num)
		{
		if ($num >= 100)
		{
		$this->form_validation->set_message('maximumCheck','The %s field must be less than 100');
		return FALSE;
		}
		else
		{
		return TRUE;
		}
		}








public function send($edit_id='')
	{
$this->load->model('Email_Model');

		if($edit_id!=null){

$data['error_msg']='';$data['success_msg']='';


		$sender_id=$this->session->userdata('admin_data')['user_id'];
		$this->form_validation->set_rules('send_user_list', 'User List', 'required|xss_clean');
		$this->form_validation->set_rules('send_subject', 'Subject', 'trim|required|xss_clean');
		$this->form_validation->set_rules('send_msg', 'Message', 'trim|required|xss_clean');






		if ($this->form_validation->run() == TRUE)
		{ 


		
			$post_data=$this->input->post();
			$post_data['send_by']=$sender_id;
			$post_data['send_on']=date("Y-m-d");
			if($this->input->post('send_user_list')!=null){ $post_data['send_user_list']=json_encode($this->input->post('send_user_list')); }
			



			
			$get_results=$this->Discount_Model->update_discounts($post_data,$edit_id);
			$get_all_discounts=$this->Discount_Model->get_edit_discounts($edit_id);
			$this->Email_Model->send_discount_mail($get_all_discounts,$post_data);
			$data['success_msg']='Successfully sent discounts details';
			
		}


		

		$get_all_discounts=$this->Discount_Model->get_edit_discounts($edit_id);
		$data['send_discounts']=$get_all_discounts;
		$this->load->view('send_discount',$data);
		}else{
		$this->load->view('errors/error_404');
		}
	}


	public function edit($edit_id='')
	{

		if($edit_id!=null){

$data['error_msg']='';$data['success_msg']='';

$editor_id=$this->session->userdata('admin_data')['user_id'];

$this->form_validation->set_rules('product_id', 'Product Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('subscription_id', 'Subscription Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('discount_code', 'Discount Code', 'trim|required|is_unique_edit['.DISCOUNTS.'.discount_code.discount_code_id.'.$edit_id.']|xss_clean');
		$this->form_validation->set_rules('discount_type', 'Discount Type', 'trim|required|xss_clean');
		

		if($this->input->post('discount_type')==1){
			$this->form_validation->set_rules('discount', 'Discount', 'trim|required|xss_clean|callback_maximumCheck');
		}else{

			$this->form_validation->set_rules('discount', 'Discount', 'trim|required|xss_clean');
			$this->form_validation->set_rules('currency', 'Currency', 'trim|required|xss_clean');
		}
		$this->form_validation->set_rules('end_date', 'End Date', 'trim|required|xss_clean');





		if ($this->form_validation->run() == TRUE)
		{ 


		
			$post_data=$this->input->post();
			$post_data['modified_by']=$editor_id;
			$post_data['modified_on']=date("Y-m-d H:i:s");
			
			
			
			$get_results=$this->Discount_Model->update_discounts($post_data,$edit_id);
			$data['success_msg']='Successfully updated discounts details';
			
		



			
		}


		

		$get_all_discounts=$this->Discount_Model->get_edit_discounts($edit_id);
		$data['edit_discounts']=$get_all_discounts;
		$get_products=$this->Subscriptions_Model->get_products();
$data['products_all']=$get_products;
		$this->load->view('add_discount',$data);
		}else{
		$this->load->view('errors/error_404');
		}
	}


						public function	delete($id){
						$this->db->where('discount_code_id',$id);
						$this->db->delete(DISCOUNTS);
						
						}

						

			public function	inactive($id){
			
			$this->db->where_in('discount_code_id',$id);
			$this->db->update(DISCOUNTS,array('discount_status' => 'Inactive' ));
			
			}
			public function	active($id){
			
			$this->db->where_in('discount_code_id',$id);
			$this->db->update(DISCOUNTS,array('discount_status' => 'Active' ));
			
			}

	
	
}
