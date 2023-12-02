<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Socialfollow extends CI_Controller {

	public function __construct()
    {
      parent::__construct();
	    $this->load->database(); 
	    $this->load->model('Admin_Model');
	    $this->load->model('Domain_Model');
	    $this->load->model('Socialfollow_Model');
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
	
		 $data['social_detail'] = $this->Socialfollow_Model->get_social_detail_list(); 
		 $this->load->view('cms/socialfollow/view',$data);
		}
		
		function add_follow_url()
		{
			
				$data['domain'] = $this->Socialfollow_Model->get_domain_list(); 
		  $this->load->view('cms/socialfollow/add_socialmedia.php',$data);
			
			}
			
			function insert_socialfollow_detail()
			{
				
				  $twitter = $_POST['twitter'];
		   	 $facebook = $_POST['facebook'];
		   	 $google = $_POST['google'];
		   	 $domain = $_POST['domain'];
		   	
		   	 	$this->Socialfollow_Model->insert_socialfollow_detail($twitter,$facebook,$google,$domain);
		   		redirect('socialfollow/social_view','refresh');
				
				}
		
		function edit_socialfollow_detail($fid)
		{
			
		 	$data['socialfollow_detail'] = $this->Socialfollow_Model->get_socialfollow_detail_single($fid); 
			$this->load->view('cms/socialfollow/edit_socialmedia',$data);
			}
			
	
			function update_socialfollow_detail($fid)
			{
				
				 	$facebook = $_POST['facebook'];
		   	$twitter = $_POST['twitter'];
		   	$google = $_POST['google'];
		 
		
			 $this->Socialfollow_Model->update_socialfollow_detail($fid,$facebook,$twitter,$google);
				redirect('socialfollow/social_view','refresh');
				
				
				}
       
    
	 
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */