<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	

		public function __construct()
		{
		parent::__construct();
		$this->load->model('Pages_Model');
		
		}

		public function index()
		{

		$user_id=($this->session->userdata('admin_data')['user_id']!=1)?$this->session->userdata('admin_data')['user_id']:'';
		$get_all_pages=$this->Pages_Model->get_all_pages($user_id);
		$data['all_pages']=$get_all_pages;
		
		$this->load->view('manage_pages',$data);
		}


public function add(){

$data['error_msg']='';
$data['success_msg']='';


$this->form_validation->set_rules('page_title', 'Page Title', 'trim|xss_clean|required|callback_check_unique['.$this->session->userdata('admin_data')['user_id'].']');
$this->form_validation->set_rules('expect_url', 'Expected Url', 'trim|required|xss_clean');
$this->form_validation->set_rules('content', 'Content', 'trim|required|xss_clean');




if ($this->form_validation->run() == TRUE){ 

			$post_data=$this->input->post();
			
			$post_data['user_id']=$this->session->userdata('admin_data')['user_id'];
			$get_results=$this->Pages_Model->insert_pages($post_data);
			$data['success_msg']='Successfully added page details';
		
		}


$this->load->view('add_page',$data);
}



 public function check_unique($page, $user_id,$edit_id='')
        {
        	
               $this->db->where('page_title', $page);
               $this->db->where('user_id', $user_id);
               if($edit_id!=null){
               	 $this->db->where('id !=', $edit_id);
               }
               $result = $this->db->get(PAGES);
               //echo $this->db->last_query();die;
               if($result->num_rows() > 0)
               {
                  $this->form_validation->set_message('check_unique','This page already added by you.'); // set your message
                  return false;
               }
               else{ return true;}

        }


			public function edit($edit_id='')
			{

$data['error_msg']='';
$data['success_msg']='';
				

			if($edit_id!=null){

				$post_data=$this->input->post();



$this->form_validation->set_rules('page_title', 'Page Title', 'trim|xss_clean|required|callback_check_unique['.$this->session->userdata('admin_data')['user_id'].']');
$this->form_validation->set_rules('expect_url', 'Expected Url', 'trim|required|xss_clean');
$this->form_validation->set_rules('content', 'Content', 'trim|required|xss_clean');




if ($this->form_validation->run() == TRUE){ 

			$post_data=$this->input->post();
			
		
			$get_results=$this->Pages_Model->update_pages($post_data,$edit_id);
			$data['success_msg']='Successfully added page details';
		
		}
		$get_results=$this->Pages_Model->get_edit_pages($edit_id);
			$data['edit_pages']=$get_results;

		$this->load->view('add_page',$data);
			}else{
				$this->load->view('errors/error_404');
				
			}


}


public function view($view_id='')
{




if($view_id!=null){
	$get_results=$this->Pages_Model->get_edit_pages($view_id);
			$data['view_pages']=$get_results;
$this->load->view('view_page',$data);
}else{
$this->load->view('errors/error_404');

}


}


	
			public function	delete($id){
						$this->db->where('subscription_id',$id);
						$this->db->delete(PAGES);
						
					}

			public function	inactive($id){
			
			$this->db->where('subscription_id',$id);
			$this->db->update(PAGES,array('subscription_status' => 'Inactive' ));
			
			}
			public function	active($id){
			
			$this->db->where('subscription_id',$id);
			$this->db->update(PAGES,array('subscription_status' => 'Active' ));
			
			}
	
}
