<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_subscriptions extends CI_Controller {

	

		public function __construct()
		{
		parent::__construct();
		$this->load->model('Usersub_Model');
		$this->load->model('Subscriptions_Model');
		
		}

	public function index()
	{
		$data['success_msg']='';
		
		if($this->input->post('hdnMethod')=='Approve'){
			$this->active($this->input->post('Checkall'));
			$data['success_msg']='Selected items are approved';
		}elseif($this->input->post('hdnMethod')=='Cancel'){
			$this->inactive($this->input->post('Checkall'));
			$data['success_msg']='Selected items are cancelled';
		}
		$search=array();
if($this->input->post('user_name')!=null)$search['user_name'] = $this->input->post('user_name');
if($this->input->post('subscription_ref_id')!=null)$search['subscription_ref_id'] = $this->input->post('subscription_ref_id');
if($this->input->post('start_on')!=null)$search['start_on'] = $this->input->post('start_on');
if($this->input->post('end_on')!=null)$search['end_on'] = $this->input->post('end_on');

		//print_r($this->input->post());
		$get_all_subscriptions=$this->Usersub_Model->get_all_subscriptions($search);
		$data['all_subscriptions']=$get_all_subscriptions;
		$this->load->view('manage_user_subscriptions',$data);
	}

	public function add()
	{
		$data['success_msg']='';$data['error_msg']='';
		
		$this->form_validation->set_rules('product_id', 'Product Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('subscription_id', 'Subscription Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('user_name', 'User Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('user_email', 'User Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('subscription_ref_id', 'Subscription Id', 'trim|required|is_unique['.ORDERS.'.subscription_ref_id]|xss_clean');
		//$this->form_validation->set_rules('payment_ref_id', 'Payment Ref', 'trim|required|xss_clean');



		if ($this->form_validation->run() == TRUE)
		{ 
			$post_data=$this->input->post();
			
			$post_data['added_by']=$this->session->userdata('admin_data')['user_id'];
			$post_data['subscription_on']=date("Y-m-d H:i:s");
			//$post_data['start_on']=date("Y-m-d");
			$get_last_id=$this->Usersub_Model->insert_subscriptions($post_data);
			$data['success_msg']='Successfully added  discount details';
		}
		$get_products=$this->Subscriptions_Model->get_products();
		$data['products_all']=$get_products;
		$this->load->view('add_user_subscription',$data);
	}


			public function get_subscriptions($pro_id)
			{

				$options='<option value="">Select</option>';

			$get_response=$this->Subscriptions_Model->get_all_subscriptions($pro_id);
			if($get_response['num_rows']>0){
				foreach ($get_response['results'] as $results) {

					$options.='<option value="'.$results['subscription_id'].'">'.$this->Subscriptions_Model->get_subscriptions_durtion($results['subscription_duration']).'</option>';
				}
			}
			echo  json_encode($options);
			}


			public function get_subscriptions_ref_id($product_id,$subscription_id,$user_id)
			{

				$options='<option value="">Select</option>';

			$get_response=$this->Usersub_Model->get_all_subscriptions_ref_id($product_id,$subscription_id,$user_id);
			if($get_response['num_rows']>0){
				foreach ($get_response['results'] as $results) {

					$options.='<option value="'.$results['subscription_ref_id'].'">'.$results['subscription_ref_id'].'</option>';
				}
			}
			echo  json_encode($options);
			}


				public function get_pro_subs_discounts($product_id,$subscription_id)
	{
		$options='<option value="">Select</option>';

		$get_response=$this->Usersub_Model->get_pro_subs_discounts($product_id,$subscription_id);

	if($get_response['num_rows']>0){
				foreach ($get_response['results'] as $results) {

					$options.='<option value="'.$results['discount_code_id'].'">'.$results['discount_code'].'</option>';
				}
			}
			echo  json_encode($options);
	}


	public function edit($edit_id='')
	{

		if($edit_id!=null){

$data['error_msg']='';$data['success_msg']='';

$editor_id=$this->session->userdata('admin_data')['user_id'];


		$this->form_validation->set_rules('product_id', 'Product Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('subscription_id', 'Subscription Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('user_name', 'User Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('user_email', 'User Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('subscription_ref_id', 'Subscription Id', 'trim|required|is_unique_edit['.ORDERS.'.subscription_ref_id.id.'.$edit_id.']|xss_clean');
		//$this->form_validation->set_rules('payment_ref_id', 'Payment Ref', 'trim|required|xss_clean');


		if ($this->form_validation->run() == TRUE)
		{ 


		
			$post_data=$this->input->post();
			$post_data['modified_by']=$editor_id;
			$post_data['modified_on']=date("Y-m-d H:i:s");
			
			
			
			$get_results=$this->Usersub_Model->update_subscriptions($post_data,$edit_id);
			$data['success_msg']='Successfully updated subscriptions details';
			
		



			
		}


		

		$get_all_subscriptions=$this->Usersub_Model->get_edit_subscriptions($edit_id);
		$data['edit_subscriptions']=$get_all_subscriptions;
		$get_products=$this->Subscriptions_Model->get_products();
		$data['products_all']=$get_products;
		$this->load->view('add_user_subscription',$data);
		}else{
		$this->load->view('errors/error_404');
		}
	}


						public function	delete($id){
						$this->db->where('id',$id);
						$this->db->delete(ORDERS);
						
						}

						

					public function	invoice($id){

					if($id!=null){

						$get_all_subscriptions=$this->Usersub_Model->get_edit_subscriptions($id);
						$data['invoice_details']=$get_all_subscriptions;
						$this->load->view('invoice',$data);
						}else{
						$this->load->view('errors/error_404');
						}

					}

			public function	inactive($id){
			
			$up_array=array();
			$up_array['status']='Cancelled';
			if($this->input->post('cancellation_reason')!=null){
				$up_array['cancellation_reason']=$this->input->post('cancellation_reason');
			}
			
			$this->db->where_in('id',$id);
			$this->db->update(ORDERS,$up_array);
			
			}

			public function	cancellation_msg_update($id){
			
			$this->db->where_in('id',$id);
			$this->db->update(ORDERS,array('status' => 'Cancelled' ));
			
			}

			

			public function	active($id){
			
			
			$this->Usersub_Model->updates_approved_data($id);
			$this->db->where_in('id',$id);
			$this->db->update(ORDERS,array('status' => 'Approved' ));
			
			}

			public function	revoke($id){
			
			$up_array=array();
			$up_array['status']='Disapproved';
			if($this->input->post('disapprove_reason')!=null){
				$up_array['disapprove_reason']=$this->input->post('disapprove_reason');
			}
			
			$this->db->where_in('id',$id);
			$this->db->update(ORDERS,$up_array);
			
			}

	
	
}
