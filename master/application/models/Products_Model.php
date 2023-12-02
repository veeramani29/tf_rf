<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_Model extends CI_Model  {

	public function __construct()
		{
		 parent::__construct();
		
		}

		

			public function get_all_status()
			{				
				$product_allstatus=array();

				$this->db->select('count(*) as Total, SUM(IF(product_status ="Active", 1, 0)) Active, SUM(IF(product_status="Inactive", 1, 0)) Inactive', false);
				$get_status_results = $this->db->get(PRODUCTS)->row_array();
				$product_allstatus['status']=$get_status_results;
				
				return $product_allstatus;
			}

	public function get_all_products($limit, $start)
	{				
			$product_alldetails=array();

			$this->db->order_by('product_id', 'desc');
			$this->db->limit($limit, $start);
			$get_results = $this->db->get(PRODUCTS);

			//echo $this->db->last_query();
			$product_alldetails['num_rows']=$get_results->num_rows;
			if($get_results->num_rows>0){
				$product_alldetails['results']=$get_results->result_array();
			}
			
			return $product_alldetails;
	}


	public function get_edit_products($edit_id)
	{
		//debug($this->session->userdata('admin_data'),1);
		
		$this->db->where('product_id',$edit_id);
		$get_results = $this->db->get(PRODUCTS)->row_array();
		
		
		return $get_results;
	}

			public function	update_products($post_data,$edit_id){
			
			$this->db->where('product_id',$edit_id);
			$this->db->update(PRODUCTS,$post_data);
			
			}

			

			public function	update_admin_password($post_data,$edit_id){
			
			$this->db->where('user_id',$edit_id);
			$this->db->update(ADMIN,$post_data);

			}

			public function	insert_products($post_data){
			
			 $this->db->insert(PRODUCTS,$post_data);
				return $this->db->insert_id();
			
					
			}

			public function	get_products_images($edit_id){
			
			
			$this->db->where('product_id',$edit_id);
			$get_results = $this->db->get(TBL_PRODUCT_IMAGES)->result_array();
				
				return $get_results;

			}

			public function	insert_products_images($post_data){
			$this->db->insert(TBL_PRODUCT_IMAGES,$post_data);
			return $this->db->insert_id();
				}

			public function	update_products_images($post_image,$id){

			foreach ($post_image as $img) {

			$this->db->where('product_images_url',$img);
			$this->db->update(TBL_PRODUCT_IMAGES, array('product_id' =>$id));
			}
			}


			public function	unlink_unwanted_images(){

			$this->db->where('product_id',0);
			$get_results = $this->db->get(TBL_PRODUCT_IMAGES)->result_array();

			foreach ($get_results as $img) {

			@unlink(PRODUCT_IMAGE.$img['product_images_url']);

			$this->db->where('id',$img['id']);
			$this->db->delete(TBL_PRODUCT_IMAGES);
			}
			}

			

	
}
