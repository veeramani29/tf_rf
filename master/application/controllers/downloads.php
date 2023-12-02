<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Downloads extends CI_Controller {

	

		public function __construct()
		{
		parent::__construct();
		$this->load->model('Downloads_Model');
		$this->load->model('Subscriptions_Model');
		
		}

		public function index()
		{

$data['error_msg']='';
$data['success_msg']='';

$product_id=$this->input->post('product_id');
$get_all_subscriptions=$this->Downloads_Model->get_all_downloads($product_id);
$data['all_Downloads']=$get_all_subscriptions;
$data['product_id']=$product_id;


$data['product_title']=$this->Subscriptions_Model->get_product_name($product_id);
		$get_products=$this->Subscriptions_Model->get_products();
		$data['products_all']=$get_products;

		$this->load->view('manage_downloads',$data);
		}

				public function add(){




 
				$data['error_msg']='';
				$data['success_msg']='';

				$this->form_validation->set_rules('product_id', 'Product Name', 'trim|required|xss_clean');
				$this->form_validation->set_rules('download_title', 'Version  Name', 'trim|required|is_unique['.DOWNLOADS.'.download_title]|xss_clean');
				$this->form_validation->set_rules('download_name', 'Download Name', 'trim|required|xss_clean');
				if ($this->form_validation->run() == TRUE)
						{ 
			$post_data=$this->input->post();
			$post_data['added_by']=$this->session->userdata('admin_data')['user_id'];
			$post_data['added_on']=date("Y-m-d H:i:s");
			$get_results=$this->Downloads_Model->insert_downloads($post_data);
			$data['success_msg']='Successfully added downloads details';
						}
								$get_products=$this->Subscriptions_Model->get_products();
								$data['products_all']=$get_products;
								$this->load->view('add_download',$data);
						
				}


			public function edit($edit_id='')
			{
				



			if($edit_id!=null){

				$this->form_validation->set_rules('download_title', 'Version Name', 'trim|required|is_unique_edit['.DOWNLOADS.'.download_title.download_id.'.$edit_id.']|xss_clean');
				if ($this->form_validation->run() == TRUE)
						{ 
				$post_data=$this->input->post();

				if($this->input->post('latest_release')==null){
				$post_data['latest_release']='No';

					}
					if($this->input->post('downloadable')==null){
				$post_data['downloadable']='No';

					}
			$this->Downloads_Model->update_downloads($post_data,$edit_id);
			$get=$this->Downloads_Model->get_edit_downloads($edit_id);
			$get_array=array();
			$get_array['product']=$this->Subscriptions_Model->get_product_name($get['product_id']);
			$get_array['download_title']=$get['download_title'];
			$get_array['download_name']=$get['download_name'];
			$get_array['latest_release']=$get['latest_release'];
			$get_array['downloadable']=$get['downloadable'];
			echo json_encode($get_array);
			}else{
				echo 2;
			}
			}else{
			echo 0;
			}
			}


	
			public function	delete($id){
						$this->db->where('download_id',$id);
						$this->db->delete(DOWNLOADS);
						
					}

			public function	inactive($id){
			
			$this->db->where('download_id',$id);
			$this->db->update(DOWNLOADS,array('download_status' => 'Inactive' ));
			
			}
			public function	active($id){
			
			$this->db->where('download_id',$id);
			$this->db->update(DOWNLOADS,array('download_status' => 'Active' ));
			
			}
	
}
