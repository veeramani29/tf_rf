<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transection_Model extends CI_Model  {

	public function __construct()
		{
		 parent::__construct();
		
		}

		

	public function get_all_transections()
	{				
			$transection_alldetails=array();
			$this->db->order_by('transfer_id', 'desc');
			$get_results = $this->db->get(BANK_TRANSFERS);
			$transection_alldetails['num_rows']=$get_results->num_rows;
			if($get_results->num_rows>0){
				$transection_alldetails['results']=$get_results->result_array();
			}
			
			return $transection_alldetails;
	}


		public function	insert_transection($post_data){

		$this->db->insert(BANK_TRANSFERS,$post_data);
		return $this->db->insert_id();


		}

public function get_user_name($id)
			{
			if($id!=null){
			$this->db->select('user_name');
			$this->db->where('id',$id);
			$get_results = $this->db->get(ORDERS)->row_array();

			if(isset($get_results['user_name']) && $get_results['user_name']!=null){
			return $get_results['user_name'];
			}else{
			return "N/A";
			}
			}else{
			return "N/A";
			}


			}

	
}
