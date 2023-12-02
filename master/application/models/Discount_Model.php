<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Discount_Model extends CI_Model  {

	public function __construct()
		{
		 parent::__construct();
		
		}

		

	public function get_all_discounts()
	{				
			$discount_alldetails=array();
			$get_results = $this->db->get(DISCOUNTS);
			$discount_alldetails['num_rows']=$get_results->num_rows;
			if($get_results->num_rows>0){
				$discount_alldetails['results']=$get_results->result_array();
			}
			
			return $discount_alldetails;
	}

	public function get_edit_discounts($edit_id)
	{
		//debug($this->session->userdata('admin_data'),1);
		
		$this->db->where('discount_code_id',$edit_id);
		$get_results = $this->db->get(DISCOUNTS)->row_array();
		
		
		return $get_results;
	}

	public function	update_discounts($post_data,$edit_id){
			
			$this->db->where('discount_code_id',$edit_id);
			$this->db->update(DISCOUNTS,$post_data);
			
			
			}

			public function	get_all_subscriptions_user(){


				$user_alldetails=array();
			$get_results = $this->db->get(ORDERS);
			$user_alldetails['num_rows']=$get_results->num_rows;
			if($get_results->num_rows>0){
				$user_alldetails['results']=$get_results->result_array();
			}
			
			return $user_alldetails;
			
			
			
			
			}

	public function	insert_discounts($post_data){
			
			 $this->db->insert(DISCOUNTS,$post_data);
				return $this->db->insert_id();
			
					
			}





	
}
