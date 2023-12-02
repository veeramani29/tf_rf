<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
    {
      parent::__construct();
	  $this->load->database(); 
	  $this->load->model('Api_Model');
	  	  $this->load->model('Admin_Model');
		  $this->load->model('Domain_Model');
	$this->load->model('Support_Model');
	$this->load->model('Home_Model');
	$this->check_isvalidated();	
   	$this->load->library('form_validation');
   		
			
	  $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      $this->output->set_header("Pragma: no-cache");
	  if($this->session->userdata('admin_logged_in')){
	  		$this->load->helper('url');
	  		$controller = $this->router->fetch_class();
	  		parent::check_modules($controller);
	  		$this->load->model('Privilege_Model');
	  		$sub_admin_id = $this->session->userdata('admin_id');
	  		$this->data['modules'] = $this->Privilege_Model->get_privileges_by_sub_admin_id($sub_admin_id)->result();
	  }
	  
    }
	  private function check_isvalidated(){
		
	   if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in')){
		       redirect('login/index');
       }
		
		
		
    }
	
	public function view()
	{
		$data['api'] = $this->Api_Model->get_api_list(); 
		$this->load->view('settings/api_view',$data);
	}

	function edit_api($id)
	{
		    $data['status']='';
			$data['domain_list'] = $this->Domain_Model->get_domain_list(); 
			$data['api'] = $this->Api_Model->get_api_list_id($id); 
			$data['id']=$id;
			$this->load->view('settings/edit_api',$data);
	}
	
	
	function update_api($id)
	{
		if($id==1)
		{
			$username = $_POST['username'];
			$username1 = $_POST['username1'];
			$password = $_POST['password'];
			$url1 = $_POST['url1'];
			
				$data = array(
				'username' => $username,
				'username1' => $username1,
				'password' => $password,
				'url1' => $url1
				);
				$where = "api_id = ".$id;
				$this->db->update('api', $data, $where);
		}
		if($id==2)
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			$url1 = $_POST['url1'];
			
			$data = array(
				'username' => $username,
				'password' => $password,
				'url1' => $url1
				);
				$where = "api_id = ".$id;
				$this->db->update('api', $data, $where);
				
		}
			
					redirect('api/view','refresh');
			
	}
	function domain_manage($id)
	{
		    $data['status']='';
			$data['domain_list'] = $this->Domain_Model->get_domain_list(); 
			$data['api'] = $this->Api_Model->get_api_list_id($id); 
			$data['id']=$id;
			$this->load->view('settings/domain_manage',$data);
	}
	function update_api_domain($id)
	{
	
	$this->db->delete('api_domian_status', array('api_id' => $id)); 
	if(isset($_POST['api_domian'][0]))
	{
	for($k=0;$k<count($_POST['api_domian']);$k++)
	{
				$data = array(
				   'domain_id' => $_POST['api_domian'][$k] ,
				   'api_id' => $id ,
				   'status' => '1'
				);
				$this->db->insert('api_domian_status', $data);
	}
	}
				redirect('api/view','refresh');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */