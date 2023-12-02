<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Privileges extends CI_Controller {

	public function __construct(){
      parent::__construct();
	    $this->load->database(); 
	    $this->load->model('Admin_Model');
	    $this->load->model('Domain_Model');
	    $this->load->model('Socialmedia_Model');
	    $this->load->model('Support_Model');
	    $this->load->model('Home_Model');
	   $this->load->model('Privilege_Model');
	    $this->load->model('B2b_Model');
	    $this->check_isvalidated();	
   		$this->load->library('form_validation');
	  	
	   $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
       $this->output->set_header("Pragma: no-cache");
	
    }

    public function index(){
	 	$data['admin'] = $this->Admin_Model->get_admin_list(); 
	 	$data['privileges'] = $this->Privilege_Model->get_privileges_list()->result(); 
	 	//echo '<pre>';print_r($data['privileges']);
		$this->load->view('privileges/add_privileges',$data);
	}

	public function assign_privileges(){
		$subadmin = $this->input->post('subadmin');
		$privilege = $this->input->post('privilege');
		//$priv = array();
		foreach($privilege as $key=>$val){
		  //$priv[] = array('id' => $val);
		  $priv_post = array(
		  	'subadmin_id' => $subadmin,
		  	'role_id' => '1',
		  	'privilege_id' => $val
		  );
		  $this->Privilege_Model->add_privilege($priv_post);
		}
		//echo '<pre>';print_r($priv);
		redirect('privileges');
	}

	function edit_privileges($id){
		 $data['privileges'] = $this->Privilege_Model->get_privileges_list()->result();  
		 $data['admin'] = $this->Admin_Model->get_admin_list_id($id);
		 $data['modules'] = $this->Privilege_Model->get_modules_by_sub_admin($id)->result(); 
		 $mod = array();
		 foreach ($data['modules'] as $key => $value) {
		 	$mod[] = $value->id;
		 }
		 $data['modules'] = $mod;
		 $this->load->view('privileges/edit_privileges',$data);
	}

	function update_privileges($subadmin){
		$privilege = $this->input->post('privilege');
		$this->Privilege_Model->delete_privileges($subadmin);
		foreach($privilege as $key=>$val){
		  //$priv[] = array('id' => $val);
		  $priv_post = array(
		  	'subadmin_id' => $subadmin,
		  	'role_id' => '1',
		  	'privilege_id' => $val
		  );
		  $this->Privilege_Model->add_privilege($priv_post);
		}
		redirect('sdadmin/manage_admin','refresh');
	}


	function edit($id){
		 $data['privileges'] = $this->Privilege_Model->get_module_privileges_list()->result();  
		 $data['agent'] = $this->B2b_Model->get_agent_list_id($id);
		 $data['modules'] = $this->Privilege_Model->get_modules_by_agent($id)->result(); 
		 $mod = array();
		 foreach ($data['modules'] as $key => $value) {
		 	$mod[] = $value->product_id;
		 }
		 $data['modules'] = $mod;
		 //echo '<pre>';print_r($data['privileges']);die;
		 $this->load->view('privileges/edit_b2b_privileges',$data);
	}

	function update($agent){
		$privilege = $this->input->post('privilege');
		$this->Privilege_Model->delete($agent);
		foreach($privilege as $key=>$val){
		  //$priv[] = array('id' => $val);
		  $priv_post = array(
		  	'b2b_id' => $agent,
		  	'product_id' => $val
		  );
		  $this->Privilege_Model->add($priv_post);
		}
		redirect('b2b/b2b_view','refresh');
	}


     private function check_isvalidated(){
		   if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in')){
				   redirect('login/index');
		   }
	 }


 }

/* 
 * Author 	: Provab
 * Date 	: 13/05/2014
 * Location : ./admin/controllers/privileges.php 
*/
