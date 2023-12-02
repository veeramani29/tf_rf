<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sdadmin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database(); 
		$this->load->model('Admin_Model');
		$this->load->model('Domain_Model');
		$this->load->library('form_validation');
		$this->load->model('Support_Model');
		$this->load->model('Email_Model');
		$this->load->model('Home_Model');
		$this->load->model('B2c_Model');
		$this->load->model('B2B_Model');
		$this->load->model('Privilege_Model');
		$this->check_isvalidated();
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		if($this->session->userdata('admin_logged_in')){
			$this->load->model('Privilege_Model');
			$sub_admin_id = $this->session->userdata('admin_id');
			$this->data['modules'] = $this->Privilege_Model->get_privileges_by_sub_admin_id($sub_admin_id)->result();
		}

	}
	  
	private function check_isvalidated(){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
	    	}else{
	    		redirect('login/index');
	    	}
	}
	public function dashboard()
	{
		$this->load->view('sun/dashboard');
	}
	public function index(){
		$this->load->view('dashboard');
	}
	public function index1($id){
		$res = $this->Admin_Model->check_admin_login($id); 
					
		if ( $res !== false ) {
			$sessionUserInfo = array( 
				'domain_id'	 	=> $res->domain,
				'domain_name'	 	=> $res->domain_name				
			);
			$this->session->set_userdata($sessionUserInfo);
			$data['domain_id']= $res->domain;
			$data['domain'] = $this->Admin_Model->get_domain_list(); 
			
			// Get registered users 
			$domain_id = $this->session->userdata('domain_id');
			$b2c_users_count = $this->B2c_Model->b2c_users($domain_id);
			$b2b_users_count = $this->B2B_Model->b2b_users($domain_id);
			$data['b2c_users_count'] = $b2c_users_count[0]->count;
			$data['b2b_users_count'] = $b2b_users_count[0]->count;
			
			$this->load->view('sdadmin/dashboard',$data);
		}else{
		   redirect('login/logout'); 
		}
			
	}
	
	public function setsuper_admin()
	{
		$domain_id = $this->session->userdata('domain_id');
		$b2c_users_count = $this->B2c_Model->b2c_users($domain_id);
		$b2b_users_count = $this->B2B_Model->b2b_users($domain_id);
		$data['b2c_users_count'] = $b2c_users_count[0]->count;
		$data['b2b_users_count'] = $b2b_users_count[0]->count;
			
		$sessionUserInfo = array('domain_id'=> "",'domain_name'=> "");
		$this->session->set_userdata($sessionUserInfo);
		$data['domain'] = $this->Admin_Model->get_domain_list(); 
		$this->load->view('sdadmin/dashboard',$data);
	}
	
	function manage_admin(){
		  $data['admin'] = $this->Admin_Model->get_admin_list(); 
		  $this->load->view('sdadmin/manage_admin',$data);
	}

	function add_admin(){
		  $data['domain_list'] = $this->Domain_Model->get_domain_list();
		  $data['privileges'] = $this->Privilege_Model->get_privileges_list()->result();  
		  $this->load->view('sdadmin/add_admin',$data);
		
	}
	function edit_admin($id){
		 if($id){
			 $data['domain_list'] = $this->Domain_Model->get_domain_list(); 
			 $data['admin'] = $this->Admin_Model->get_admin_list_id($id); 
			if(!empty($data['admin'])){
			 	$this->load->view('sdadmin/edit_admin',$data);
			}else{
				redirect('sdadmin/manage_admin');
			}
		}else{
			redirect('sdadmin/manage_admin');
		}
	}
	function update_admin_new($id){
		$name=$_POST['name'];
		$address=$_POST['address'];
		$phone=$_POST['phone'];
		$domain=$_POST['domain'];
		$data=array('firstname' => $name,'address' => $address,'contact_no' => $phone,'domain' => $domain);
		$this->db->where('user_id',$id);
		$this->db->update('admin',$data);
		redirect('sdadmin/manage_admin','refresh');
	}
	function delete_admin($id){

		$admin_data = $this->Admin_Model->get_admin_list_id($id);
		$data['admin_email_id'] = $admin_data->email;
		$data['admin_firstname'] = $admin_data->firstname;

		if($data['admin_email_id'] != "") {
			$data['email_template'] = $this->Email_Model->get_email_template('ADMIN_DELETE_ACCOUNT')->row();
			$this->Email_Model->delete_admin_email($data);
		}

		$wheres = "user_id = $id";
		$this->db->delete('admin', $wheres);
		$this->Privilege_Model->delete_privileges($id);
		redirect('sdadmin/manage_admin','refresh');
	}
	function change_admin_password($id,$status=''){
		if($id){
			$data['status']=$status;
			$data['admin'] = $this->Admin_Model->get_admin_list_id($id); 
			if(!empty($data['admin'])){
				$this->load->view('sdadmin/change_admin_password',$data);
			}else{
				redirect('sdadmin/manage_admin');
			}
		}else{
			redirect('sdadmin/manage_admin');
		}
		
	}
	function update_admin_password($id){
		$r_info = $this->Admin_Model->get_admin_list_id($id);
		if($r_info->password == $this->input->post('cpass')){
			$data['password'] = $npass = $this->input->post('npass');
			$data['firstname'] = $name = $this->input->post('name3');
			$data['emailid'] = $email3 = $this->input->post('email3');
			$data['email_template'] = $this->Email_Model->get_email_template('admin_change_password')->row();
			if ($this->Admin_Model->update_admin_password($npass,$id)) {
				
				$this->Email_Model->send_admin_change_password($data);
				$status=1;
			}else{
				$status=0;
			}
		}else{
			$status=11;
		}
		redirect('sdadmin/change_admin_password/'.$id.'/'.$status,'refresh');
	}
	function add_admin_new(){
		$this->form_validation->set_rules('email3', 'Email', 'required|is_unique[admin.email]');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$status=0;
		if($this->form_validation->run()==FALSE){		
			$data['status']='fail';
			$data['domain_list'] = $this->Domain_Model->get_domain_list();
			$data['privileges'] = $this->Privilege_Model->get_privileges_list()->result();   
		    $this->load->view('sdadmin/add_admin',$data);
		}else{
			$data['password'] = $pw3=$_POST['pw3'];
			$data['firstname'] = $name=$_POST['name'];
			$data['emailid'] = $email3=$_POST['email3'];
			$address=$_POST['address'];
			$phone=$_POST['phone'];
			$domain=$_POST['domain'];
			$data['url'] = WEB_URL.'login/admin_login';
			$data['email_template'] = $this->Email_Model->get_email_template('admin_login_access')->row();
			if($subadmin = $this->Admin_Model->add_new_admin($name,$pw3,$email3,$address,$phone,$domain)){ 
				$privilege = $this->input->post('privilege');

				if(!empty($privilege)) {
					foreach($privilege as $key=>$val){
					  $priv_post = array(
					  	'subadmin_id' => $subadmin,
					  	'role_id' => '1',
					  	'privilege_id' => $val
					  );
					  $this->Privilege_Model->add_privilege($priv_post);
					}
				}

				$this->Email_Model->send_admin_access($data);
			}
		    redirect('sdadmin/manage_admin','refresh');
		}
	}
	function my_profile($status=''){
		$data['status']=$status;
		
		$admin_id = $this->session->userdata('admin_id');
		$data['user_info'] = $this->Admin_Model->get_admin_list_id($admin_id);
		$this->load->view('sdadmin/account/my_profile', $data);
	}
	function change_password($status=''){
		$data['status']=$status;
		$admin_id = $this->session->userdata('admin_id');
		$data['user_info'] = $this->Admin_Model->get_admin_list_id($admin_id);
		$this->load->view('sdadmin/account/sa_change_password', $data);
	}
	function update_password($id){
		$r_info = $this->Admin_Model->get_admin_list_id($id);
		if($r_info->password == $this->input->post('cpass')){
		
		   $npass = $this->input->post('npass');
		  
		   if ($this->Admin_Model->update_admin_password($npass,$id)) {
			   
			   $status=1;
		   }
		   else
		   {
			 
		        $status=0;
		   }
		}
		else
		{
		  $status=11;
			
		}
		redirect('sdadmin/change_password/'.$status,'refresh');
	}
	function update_profile($id){
		
		$this->form_validation->set_rules('username', 'User Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('contact_no', 'Contact No', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		 $status=0;
		if($this->form_validation->run()==FALSE){
			redirect('sdadmin/my_profile/'.$status,'refresh');
		}else{
		   $firstname = $this->input->post('username');
		   $email = $this->input->post('email');
		   $contact_no = $this->input->post('contact_no');
		   $address = $this->input->post('address');
		  
		   if ($this->Admin_Model->update_admin_profile( $firstname,  $email, $contact_no, $address, $id)) {
			 $status=1;
		   }
			
		}
		redirect('sdadmin/my_profile/'.$status,'refresh');
	}

	public function change_admin_status($id=null, $status=null) {
		if($id != "") {

			if($status != "") {
			$r_info = $this->Admin_Model->get_admin_list_id($id);
		        $data['emailid'] =  $email3 = $r_info->email;
		        $data['firstname'] =  $fnam = $r_info->firstname;
		        $data['password'] =  $password = $r_info->password;
		        $data['image'] =  $photo = WEB_DIR."assets/images/logo.png";
				$data['user'] = 'Sub Admin';
				if($status == 1) {
					$status = 1;
					$data['email_template'] = $this->Email_Model->get_email_template('add_user_active')->row();
				} else if($status == 0) {
					$status = 0;
					$data['email_template'] = $this->Email_Model->get_email_template('user_deactivate')->row();
				} else {
					redirect(WEB_URL.'/admin/sdadmin/manage_admin');
				}
				$this->Admin_Model->change_admin_status($id, $status);
  	        	$this->Email_Model->send_add_user_active($data);
				redirect(WEB_URL.'/admin/sdadmin/manage_admin');
			} else {
				redirect(WEB_URL.'/admin/sdadmin/manage_admin');
			}
		} else {
				redirect(WEB_URL.'/admin/sdadmin/manage_admin');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
