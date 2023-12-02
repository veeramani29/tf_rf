<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
      parent::__construct();
	  $this->load->database(); 
	  $this->load->model('Home_Model');
	  $this->load->model('Admin_Model');
	  $this->load->model('Support_Model');
	  $this->load->model('B2c_Model');
	  $this->load->model('B2B_Model');
	   
	  $this->check_isvalidated();
	  $this->load->library('form_validation');
	 	
	  $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      $this->output->set_header("Pragma: no-cache");
	}
	
	public function index(){
        // Get registered users 
		$domain_id = $this->session->userdata('domain_id');
		$b2c_users_count = $this->B2c_Model->b2c_users($domain_id);
		$b2b_users_count = $this->B2B_Model->b2b_users($domain_id);		
		
		$data['b2c_users_count'] = $b2c_users_count[0]->count;
		$data['b2b_users_count'] = $b2b_users_count[0]->count;
		
		$total_amount = '';
		$data['total_booking_amount'] = '';
		
		$total_b2c_users = $this->Home_Model->get_b2c_users();
		$data['total_b2c_users'] = $total_b2c_users[0]->count;
		
		$total_b2b_users = $this->Home_Model->get_b2b_users();
		$data['total_b2b_users'] = $total_b2b_users[0]->count;
			
		$data['get_b2c_stats'] = $this->Home_Model->get_b2c_stats_model()->result();
		$data['get_b2b_stats'] = $this->Home_Model->get_b2b_stats_model()->result();

			/*For booking stats*/
		$data['get_flight_booking_stats'] = $this->Home_Model->get_flight_booking_stats_model()->result();
		$data['get_hotel_booking_stats']  = $this->Home_Model->get_hotel_booking_stats_model()->result();
		$data['get_car_booking_stats']    = $this->Home_Model->get_apt_booking_stats_model()->result();
		
		$this->load->view('dashboard',$data);
    }

	function settings(){
		$data['email_access'] = $this->Home_Model->get_email_acess();	
		$this->load->view('settings/settings',$data);	
	}
	private function check_isvalidated(){
		if(! $this->session->userdata('sa_logged_in')){
            redirect('login/admin_login');
        }
    }
	
	
	function dashboard(){
		$domain_id = $this->session->userdata('domain_id');
		$b2c_users_count = $this->B2c_Model->b2c_users($domain_id);
		$b2b_users_count = $this->B2B_Model->b2b_users($domain_id);		
		
		$data['b2c_users_count'] = $b2c_users_count[0]->count;
		//$data['b2b_users_count'] = $b2b_users_count[0]->count;
		
		$total_amount = $this->Home_Model->get_overall_booking();
		$data['total_booking_amount'] = $total_amount[0]->total_amount;
		
		$total_b2c_users = $this->Home_Model->get_b2c_users();
		$data['total_b2c_users'] = $total_b2c_users[0]->count;
		
		$total_b2b_users = $this->Home_Model->get_b2b_users();
		//$data['total_b2b_users'] = $total_b2b_users[0]->count;
		
		
		/*Graph Data*/

			/*For B2C and B2B users*/
		$data['get_b2c_stats'] = $this->Home_Model->get_b2c_stats_model()->result();
		
		//$data['get_b2b_stats'] = $this->Home_Model->get_b2b_stats_model()->result();

			/*For booking stats*/
		$data['get_flight_booking_stats'] = $this->Home_Model->get_flight_booking_stats_model()->result();
		$data['get_hotel_booking_stats']  = $this->Home_Model->get_hotel_booking_stats_model()->result();
		$data['get_car_booking_stats']    = $this->Home_Model->get_car_booking_stats_model()->result();
		
		
		/*Graph Data*/

		$this->load->view('dashboard',$data);
	}
	
	function my_profile($status=''){
		$data['status']=$status;
		$data['user_info'] = $this->Home_Model->get_sa_login();
		$this->load->view('account/my_profile', $data);
	}

	function change_password($status=''){
		$data['status']=$status;
		$data['user_info'] = $this->Home_Model->get_sa_login();
		$this->load->view('account/sa_change_password', $data);
	}

	function update_password(){
		$r_info = $this->Home_Model->get_sa_login();
		if($r_info->password == $this->input->post('cpass'))
		{
		
		   $npass = $this->input->post('npass');
		   
		   if ($this->Home_Model->update_sa_password($npass)) {
			   
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
		redirect('home/change_password/'.$status,'refresh');
	}
	function update_profile(){
		
		$this->form_validation->set_rules('username', 'User Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('contact_no', 'Contact No', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		 $status=0;
		if($this->form_validation->run()==FALSE){
			redirect('home/my_profile/'.$status,'refresh');
		}else{
		   $firstname = $this->input->post('username');
		   $email = $this->input->post('email');
		   $contact_no = $this->input->post('contact_no');
		   $address = $this->input->post('address');
		  
		   if ($this->Home_Model->update_sa_profile( $firstname,  $email, $contact_no, $address)) {
					$status=1;
		   }
			
		}
		redirect('home/my_profile/'.$status,'refresh');
	}
	function biz_rules(){
		
		$data['biz_alert'] = $this->Home_Model->get_biz_alert_details();
		$this->load->view('biz/view', $data);
	}
	function update_bizrules()
	{
		$data['biz_margin'] = $this->Home_Model->get_biz_margin_details_();
		$this->load->view('biz/add_biz', $data);
	}
	function update_biz_det()
	{
			$data1 = array(
			'value' => $_POST['discount1']
			);
				$where1 = "biz_rules_id = 1";
		  $this->db->update('biz_rules_margin', $data1, $where1);
		  
		  	$data2 = array(
			'value' => $_POST['discount2']
			);
				$where2 = "biz_rules_id = 2";
		  $this->db->update('biz_rules_margin', $data2, $where2);
		  
		  	$data3 = array(
			'value' => $_POST['discount3']
			);
				$where3 = "biz_rules_id =3 ";
		  $this->db->update('biz_rules_margin', $data3, $where3);
		  
		  	$data4 = array(
			'value' => $_POST['discount4']
			);
				$where4 = "biz_rules_id = 4";
		  $this->db->update('biz_rules_margin', $data4, $where4);
		  
		  	$data5 = array(
			'value' => $_POST['discount5']
			);
				$where5 = "biz_rules_id = 5";
		  $this->db->update('biz_rules_margin', $data5, $where5);
		  
		  	$data6 = array(
			'value' => $_POST['discount6']
			);
				$where6 = "biz_rules_id = 6";
		  $this->db->update('biz_rules_margin', $data6, $where6);
		  
		  redirect('home/update_bizrules','refresh');
	}
	
	function get_tracking_details()
	{		 
		$trackval = $this->Home_Model->fetch_tracking_detail();
	}
	
	function email_content()
	{		
		$data['email_content'] = $this->Home_Model->getEmailContent();
		$this->load->view('settings/email_content',$data);
	}
	
	function add_email_content()
	{
		$data['domain'] = $this->Home_Model->domain_list();		
		$this->load->view('settings/add_email_content',$data);
	}
	
			 
	public function insert_email_content()
	{		
		$domain = $_POST['domain'];
		$image_path = "";
		
		if(!empty($_FILES['footerimage']['name']))
		{
			$config['upload_path'] = IMAGE_UPLOAD_PATH.$domain.'/cms/email';
			
			$config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|JPEG|PNG';
			$this->load->library('upload', $config);
		
			$this->upload->do_upload('footerimage');
			$simg = $this->upload->data('file');
			$image_path = WEB_DIR.'upload_files/'.$domain.'/cms/email/'.$simg['file_name'];
		}
			  
		$data = array(
				'domain_id' => $_POST['domain'],
				'footer_image' => $image_path,
				'footet_left_part' => $_POST['footer_left'],
				'footet_right_part' => $_POST['footer_right']				
				);
		
		$this->db->insert('email_content', $data);
		redirect('home/email_content','refresh');
	}
	
	public function edit_email_content($id)
	{
		$data['email_single_content'] = $this->Home_Model->get_single_email_content($id);
		$data['domain'] = $this->Home_Model->domain_list();	
		$this->load->view('settings/update_email_content',$data);
	}

	public function delete_email_content($id)
	{
		$this->db->delete('email_content', array('id' => $id)); 
		redirect('home/email_content','refresh');
	}
	
	public function update_email_content()
	{
		$domain = $_POST['domain'];
		$email_content_id = $_POST['email_content_id'];
		
		$image_path = "";
		
		if(!empty($_FILES['footerimage']['name']))
		{
			$config['upload_path'] = IMAGE_UPLOAD_PATH.$domain.'/cms/email';
			
			$config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|JPEG|PNG';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			$this->upload->do_upload('footerimage');
			$simg = $this->upload->data('file');
			$image_path = WEB_DIR.'upload_files/'.$domain.'/cms/email/'.$simg['file_name'];
		}
			  
		$data = array(
				'domain_id' => $_POST['domain'],
				'footet_left_part' => $_POST['footer_left'],
				'footet_right_part' => $_POST['footer_right']				
				);
		
		if(!empty($image_path))
		{
			$data['footer_image'] = $image_path;
		}
		
		$this->db->where('id', $email_content_id);
		$this->db->update('email_content', $data);
		redirect('home/email_content','refresh');		
	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
