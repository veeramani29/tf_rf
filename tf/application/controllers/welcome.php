<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('Auth_Model');
        $current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
        $current_url = $this->config->site_url().$this->uri->uri_string(). $current_url;
        $url =  array(
            'continue' => $current_url,
        );
        $this->session->set_userdata($url);
        $this->load->model('Help_Model');
		$this->helpMenuLink = $this->Help_Model->fetchHelpLinks();
    }

	public function index(){
		$this->load->view('index');	
	}
		function sms_test($pnr)
{
	
			$this->db->where('pnr_no',$pnr);    
			$query = $this->db->get('booking_global');   
			if ($query->num_rows() > 0) {
				$book_details = $query->row();
				$user_id =$book_details->user_id;
				$user_type = $book_details->user_type;
				
					$this->db->where('user_id',$user_id);
					$this->db->where('user_type',$user_type);  
					$this->db->where('mobile','1');      
					$query1 = $this->db->get('user_verifications'); 
					
					if ($query1->num_rows() > 0) {
					
							if($user_type=3)
							{
								
								$this->db->where('user_id',$user_id);
								$query2 = $this->db->get('b2c');   
								if ($query2->num_rows() > 0) {
										$user_details = $query2->row();
										$contact_no =$user_details->contact_no;
										
										$this->db->where('user_id',$user_id);
										$this->db->where('user_type',$user_type);
										$this->db->where('alert_action_id','4');   
										$this->db->where('alert_status','1');   
										$query3 = $this->db->get('sms_alert_enabled');   
										if ($query3->num_rows() > 0) {
										
										$pnr_no = $book_details->pnr_no;
										$module = $book_details->module;
										$leadpax = $book_details->leadpax;
										$booking_status = $book_details->booking_status;
										
									
										
										}
								}
							}
							if($user_type=2)
							{
								$this->db->where('agent_id',$user_id);
								$query2 = $this->db->get('b2b');   
								if ($query2->num_rows() > 0) {
										$user_details = $query2->row();
										$contact_no =$user_details->mobile;
										
										$this->db->where('user_id',$user_id);
										$this->db->where('user_type',$user_type);
										$this->db->where('alert_action_id','4');   
										$this->db->where('alert_status','1');   
										$query3 = $this->db->get('sms_alert_enabled');   
										if ($query3->num_rows() > 0) {
										
										$pnr_no = $book_details->pnr_no;
										$module = $book_details->module;
										$leadpax = $book_details->leadpax;
										$booking_status = $book_details->booking_status;
										
										
							
										
										}
								}
							}
					}
				
			}
		
}
	public function detail(){
		$this->load->view('detail');	
	}
	public function search(){
		$this->load->view('results');	
	}
	public function help(){
		$this->load->view('how');	
	}
	public function dashboard(){
		$this->load->view('profile');	
	}
	public function agent(){
		$this->load->view('dashboard/b2b');	
	}
	public function list_property(){
		$this->load->view('property');	
	}
	public function list1(){
		$this->load->view('listing');	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */