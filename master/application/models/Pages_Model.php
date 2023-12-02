<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages_Model extends CI_Model  {

	public function __construct()
		{
		 parent::__construct();
		
		}

		

	public function get_all_pages($user_id='')
	{				
			$pages_alldetails=array();
			if($user_id!=''){ $this->db->where('user_id',$user_id); }
			$this->db->order_by('id', 'desc');
			$get_results = $this->db->get(PAGES);
			
			$pages_alldetails['num_rows']=$get_results->num_rows;
			if($get_results->num_rows>0){
				$pages_alldetails['results']=$get_results->result_array();
			}
			
			return $pages_alldetails;
	}


	


	public function get_edit_pages($edit_id)
	{
		
		$this->db->where('id',$edit_id);
		$get_results = $this->db->get(PAGES)->row_array();
		
		
		return $get_results;
	}



	






	


			public function	update_pages($post_data,$edit_id){
			
			$this->db->where('id',$edit_id);
			$get_results =$this->db->update(PAGES,$post_data);
			
			return $get_results;
			}

			

			

			public function	insert_pages($post_data){
			
			
			$this->db->insert(PAGES,$post_data);

			}

	
}
