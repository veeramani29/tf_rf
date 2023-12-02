<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usersub_Model extends CI_Model  {

	public function __construct()
		{
		 parent::__construct();
		$this->load->model('Subscriptions_Model');
		}

		

	public function get_all_subscriptions($search)
	{				
			$discount_alldetails=array();
			$this->db->where($search); 
			$this->db->order_by('id', 'desc');
			$get_results = $this->db->get(ORDERS);
			$discount_alldetails['num_rows']=$get_results->num_rows;
			if($get_results->num_rows>0){
				$discount_alldetails['results']=$get_results->result_array();
			}
			
			return $discount_alldetails;
	}


	public function get_all_subscriptions_ref_id($product_id,$subscription_id,$user_id)
	{				
			$subscriptions_alldetails=array();
			if($product_id!=''){ $this->db->where('product_id',$product_id); }
			if($subscription_id!=''){ $this->db->where('subscription_id',$subscription_id); }
			if($user_id!=''){ $this->db->where('id',$user_id); }
			
			$get_results = $this->db->get(ORDERS);
			
			$subscriptions_alldetails['num_rows']=$get_results->num_rows;
			if($get_results->num_rows>0){
				$subscriptions_alldetails['results']=$get_results->result_array();
			}
			
			return $subscriptions_alldetails;
	}


	public function	updates_approved_data($id){


		
			$get_this_results=$this->get_edit_subscriptions($id);
			$get_this_duration=$this->Subscriptions_Model->subscriptions_durtion($get_this_results['subscription_id']);

			$post_data['start_on']=date("Y-m-d");
			if(!is_numeric($get_this_duration)){$get_this_duration=(365*25);}
			$post_data['end_on']=date("Y-m-d",strtotime("+ $get_this_duration Days"));
			
			$post_data['payment_ref_id']=$this->get_payment_ref_id($get_this_results['subscription_ref_id']);
			$post_data['payment_status']='Manual';
			
			$this->db->where('id',$id);
			$this->db->update(ORDERS,$post_data);

			}


			public function get_payment_ref_id($subscription_ref_id)
			{

				$options='';

			if($subscription_ref_id!=''){ $this->db->where('subscription_ref_id',$subscription_ref_id); }
			$get_results = $this->db->get(BANK_TRANSFERS);
			//echo $this->db->last_query();die;
			$results_all=$get_results->result_array();
			
			
			if($get_results->num_rows>0){
				foreach ($results_all as $results) {

					$options.=$results['payment_ref_id'];
				}
			}
			return $options;
			}



			public function get_pro_subs_discounts($product_id,$subscription_id)
	{
		
		$discounts_alldetails=array();
		
		$this->db->where('product_id',$product_id);
		$this->db->where('subscription_id',$subscription_id);
		$this->db->where('discount_status','Active');
		$this->db->where('end_date >',date('Y-m-d'));
		$get_results = $this->db->get(DISCOUNTS);
		


		$discounts_alldetails['num_rows']=$get_results->num_rows;
			if($get_results->num_rows>0){
				$discounts_alldetails['results']=$get_results->result_array();
			}
			
			return $discounts_alldetails;


		
		
			}
		
		
	


	public function get_edit_subscriptions($edit_id)
	{
		//debug($this->session->userdata('admin_data'),1);
		
		$this->db->where('id',$edit_id);
		$get_results = $this->db->get(ORDERS)->row_array();
		
		
		return $get_results;
	}

	public function	update_subscriptions($post_data,$edit_id){
			
			$this->db->where('id',$edit_id);
			$this->db->update(ORDERS,$post_data);
			
			}

	public function	insert_subscriptions($post_data){
			
			 $this->db->insert(ORDERS,$post_data);
				return $this->db->insert_id();
			
					
			}





	
}
