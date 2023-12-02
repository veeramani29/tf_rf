<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_Model extends CI_Model  {

	public function __construct()
		{
		 parent::__construct();
		
		}

		

	public function get_all_users()
	{				
			$users_alldetails=array();
			//debug($this->session->userdata('admin_data'),1);
		
			$this->db->where('access_level','ACC-4');
			$get_results = $this->db->get(USERS);
			$users_alldetails['num_rows']=$get_results->num_rows;
			if($get_results->num_rows>0){
				$users_alldetails['results']=$get_results->result_array();
			}
			
			return $users_alldetails;
	}


	public function get_edit_users($edit_id)
	{
		$this->db->where('user_id',$edit_id);
		$get_results = $this->db->get(USERS)->row_array();
		
		
		return $get_results;
	}

			public function	update_users($post_data,$edit_id){
			
			$this->db->where('user_id',$edit_id);
			$this->db->update(USERS,$post_data);

			}

			

			public function	update_users_password($post_data,$edit_id){
			
			$this->db->where('user_id',$edit_id);
			$this->db->update(USERS,$post_data);

			}

			public function	insert_users($post_data){
			
			
			$this->db->insert(USERS,$post_data);

			}

	
}
