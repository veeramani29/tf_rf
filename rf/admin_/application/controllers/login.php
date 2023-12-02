<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
      parent::__construct();
	  $this->load->database(); 
	  $this->load->model('Home_Model');
			
 	  #$this->load->model('Support_Model');
	
	  $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      $this->output->set_header("Pragma: no-cache");

	}
	
	public function index(){
	
		if($this->session->userdata('sa_logged_in')){
	      	redirect('home');
		} else if($this->session->userdata('admin_logged_in')){
		    redirect('sdadmin');
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email-Id', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$data['status']='';
		if ( $this->form_validation->run() !== false ) {
		
		
			 $res = $this
					  ->Home_Model
					  ->check_admin_login(
						 $this->input->post('email'), 
						 $this->input->post('password')
					  ); 


			 if ( $res !== false ){
				   if($res->usertype==0){
						$sessionUserInfo = array( 
						'sa_id' 		=> $res->a_id,
						'sa_email'	 	=> $res->username,
						'sa_logged_in' 	=> TRUE
						);
						$this->session->set_userdata($sessionUserInfo);
						redirect('home/dashboard', 'refresh'); 
					
					}else{
						$sessionUserInfo = array( 
					'admin_id' 		=> $res->a_id,
					'admin_email'	 	=> $res->username,
					'admin_type'	 	=> 'admin',
					'admin_logged_in' 	=> TRUE
					);
					$this->session->set_userdata($sessionUserInfo);
					  
					redirect('sdadmin/index/'.$res->domain, 'refresh'); 
					
					}
					
			 }else{
			      $data['status']= 'Login Failed';
          	 }

		}	
		
		
		$this->load->view('login',$data);
	
	}

		
	public function admin_login(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email-Id', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$data['status']='';
		if ( $this->form_validation->run() !== false ) {
		
			$res = $this
				  ->Home_Model
				  ->check_admin_login(
					 $this->input->post('email'), 
					 $this->input->post('password')
				  ); 


			 if ( $res !== false ) 
			 {
				   if($res->usertype==0)
					{
						$sessionUserInfo = array( 
						'sa_id' 		=> $res->a_id,
						'sa_email'	 			=> $res->username,
						'sa_logged_in' 	=> TRUE
						);
						$this->session->set_userdata($sessionUserInfo);
						redirect('home/dashboard', 'refresh'); 
										
					}else{
						$sessionUserInfo = array( 
					'admin_id' 		=> $res->a_id,
					'admin_email'	 	=> $res->username,
					'admin_type'	 	=> 'admin',
					'admin_logged_in' 	=> TRUE
					);
					$this->session->set_userdata($sessionUserInfo);
					  
					redirect('sdadmin/index/'.$res->domain, 'refresh'); 
					
					}
					
			 }else{
			      $data['status']= 'Login Failed';
          	 }

		}	
		
		
		$this->load->view('login',$data);
	
	}
	
	public function supplier_login(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email-Id', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$data['status']='';
		if ( $this->form_validation->run() !== false ) {
		
			$res = $this
				  ->Home_Model
				  ->check_supplier_login(
					 $this->input->post('email'), 
					 $this->input->post('password')
				  ); 


			 if ( $res !== false ) 
			 {
				   
						$sessionUserInfo = array( 
					'supplier_id' 		=> $res->supplier_id,
					'supplier_email'	 	=> $res->email,
					'supplier_logged_in' 	=> TRUE
					);
					$this->session->set_userdata($sessionUserInfo);
					redirect('hotel_mgmt', 'refresh'); 
			 }else{
			      $data['status']= 'Login Failed';
          	 }

		}	
		
		
		$this->load->view('supplier_login',$data);
	
	}
	
	
	public function logout(){
        $this->session->unset_userdata('sessionUserInfo');
		$this->session->sess_destroy();
        redirect('home/login', 'refresh'); 
    }
	public function supplier_logout(){
        $this->session->unset_userdata('sessionUserInfo');
		$this->session->sess_destroy();
		
        redirect('login/supplier_login', 'refresh'); 
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
