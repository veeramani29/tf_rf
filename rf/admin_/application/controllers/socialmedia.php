<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Socialmedia extends CI_Controller {

	public function __construct()
    {
      parent::__construct();
	    $this->load->database(); 
	    $this->load->model('Admin_Model');
	    $this->load->model('Domain_Model');
	    $this->load->model('Socialmedia_Model');
	    $this->load->model('Support_Model');
	    $this->load->model('Home_Model');
	   
	    
	    $this->check_isvalidated();	
   		$this->load->library('form_validation');
	  	
	   $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
    $this->output->set_header("Pragma: no-cache");
	
    }
    
     private function check_isvalidated()
	  {
		   if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in'))
		   {
				   redirect('login/index');
		   }
		
    }
    
    	public function social_view()
		{
	
		 $data['social_detail'] = $this->Socialmedia_Model->get_social_detail_list(); 
		 $this->load->view('cms/social/view',$data);
		}
		
		function edit_socialmedia_detail($fid)
		{
			
		 	$data['socialmedia_detail'] = $this->Socialmedia_Model->get_socialmedia_detail_single($fid); 
			$this->load->view('cms/social/edit_socialmedia',$data);
			}
			
	
			function update_socialmedia_detail($fid)
			{
				
				 	$appkey = $_POST['appkey'];
		   	$secretkey = $_POST['secretkey'];
		   	$returnurl = $_POST['returnurl'];
		 
		
			 $this->Socialmedia_Model->update_socialmedia_detail($fid,$appkey,$secretkey,$returnurl);
				redirect('socialmedia/social_view','refresh');
				
				
				}
       
    
	 
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */