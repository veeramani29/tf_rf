<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaction extends CI_Controller {

    protected $domain_id;

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Admin_Model');
        $this->load->model('Domain_Model');
        $this->load->model('Email_Model');
        $this->load->model('Home_Model');
		
        $this->check_isvalidated();
        $this->load->library('form_validation');
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
		
        if($this->session->userdata('admin_logged_in')) 
		{
            $this->load->helper('url');
            $controller = $this->router->fetch_class();
            parent::check_modules($controller);
            $this->load->model('Privilege_Model');
            $sub_admin_id = $this->session->userdata('admin_id');
            $this->data['modules'] = $this->Privilege_Model->get_privileges_by_sub_admin_id($sub_admin_id)->result();
        }
    }
    private function check_isvalidated() {
        if (!$this->session->userdata('admin_logged_in') && !$this->session->userdata('sa_logged_in')) {
            redirect('login/index');
        }
    }
    public function transaction_view() 
	{
        $data['result'] = $this->Transaction_Model->get_transaction_list();
        $this->load->view('transaction/transaction_view', $data);
    }
	public function new_transaction() 
	{
        $data['result'] = $this->Transaction_Model->get_transaction_list_new();
        $this->load->view('transaction/new_view', $data);
    }
	public function pending_transaction() 
	{
	
        $data['result'] = $this->Transaction_Model->get_transaction_list_pending();
        $this->load->view('transaction/pending_view', $data);
    }
	public function failed_transaction() 
	{
	
        $data['result'] = $this->Transaction_Model->get_transaction_list_failed();
        $this->load->view('transaction/failed_view', $data);
    }
	public function all_transaction() 
	{
        $data['result'] = $this->Transaction_Model->get_transaction_list_all();
        $this->load->view('transaction/all_view', $data);
    }
	public function upcoming_transaction() 
	{
        $data['result'] = $this->Transaction_Model->get_transaction_list_upcoming();
        $this->load->view('transaction/upcoming_view', $data);
    }
	public function completed_transaction() 
	{
        $data['result'] = $this->Transaction_Model->get_transaction_list_compelted();
        $this->load->view('transaction/completed_view', $data);
    }
	public function track() 
	{
       
       $this->load->view('transaction/track');
    }
	
	public function transaction_tracking() 
	{
       $pnr_no =  $_POST['pnr'];
	   $data['Booking'] = $booking = $this->Transaction_Model->getBookingbyPnr($pnr_no)->row();
	   $data['Transaction'] = $this->Transaction_Model->get_transaction_details($pnr_no);
	   $data['History'] = $this->Transaction_Model->get_transaction_history($data['Transaction']->transaction_id);
	   $data['Map'] = $this->getStaticMap($data['Booking']->PROP_LATITUDE, $data['Booking']->PROP_LONGITUDE);
       $data['host_profile_link'] = WEB_URL.'users/show/'.$data['Booking']->user_id;
       $data['apt_link'] = WEB_URL.'apartment/rooms/'.$data['Booking']->PROP_ID;
       $this->load->view('transaction/track_result',$data);
    }
    
	  public function getStaticMap($lat, $long){
        $locstring='';$firstloc=0;
        $long="77.5667";
        $lat="12.9667";
                        
        if($firstloc==0){
            $locstring=$locstring.$lat.','.$long.'&markers=icon:'.WEB_FRONT_DIR.'assets/images/marker_out.png%7C'.$lat.','.$long;
            $firstloc=1;
        }else{
            $locstring=$locstring.'&markers=icon:'.WEB_FRONT_DIR.'assets/images/marker_out.png%7C'.$lat.','.$long;
        }        
        $url="http://maps.googleapis.com/maps/api/staticmap?zoom=16&size=627x327&maptype=ROADMAP&".urlencode("center")."=".$locstring."&sensor=false";
        return $url;
    }
	public function update_transaction_status($t_id,$pnr_no) 
	{
		$Transaction = $this->Transaction_Model->get_transaction_details($pnr_no);
		if($Transaction!='')
		{
		$status = $_POST['status'];
		$message = $_POST['message'];
		$host_id =$Transaction->host_id;
		$host_type =$Transaction->host_type;
		if($status=='Process' || $status=='Failed')
		{
			$fail=0;
        $status_s = $this->Transaction_Model->update_transaction_status($t_id, $status,$fail,$message,$host_type,$host_id);
		
		if($status_s==true)
		{
			
			    $data['HOSTIMAGE']= $Transaction->host_image;
				$data['HOSTNAME']= $Transaction->host_name;
				$data['PNR']= $pnr_no;
				$data['STATUS']= $status;
				$data['COMMENTS']= $message;
				$data['NET_RATE']= $Transaction->net_rate;
				$data['PROPNAME']= $Transaction->prop_name;
				$data['TOTAL']= $Transaction->payout_amount;
				$data['TAX']= $Transaction->host_charge;
				$data['REFERENCELINK']= WEB_FRONT_DIR.'apartment/transaction_track/'.$pnr_no;
				$data['emailid'] = $Transaction->host_email;
			$data['email_template'] = $this->Email_Model->get_email_template('Transaction')->row();
			$this->Email_Model->send_transaction_details($data);
					
		$data['message'] = '<div class="alert alert-block alert-success">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Success!</h4>
							  Status Has Been Changed !!!
							</div>';
		}
		else
		{
			$data['message'] = '<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Error!</h4>
							 Status Has not Been Changed !!!
							</div>';
		}
    						if($status=='Process')
							{
			$data['result'] = $this->Transaction_Model->get_transaction_list_pending();
			$this->load->view('transaction/pending_view', $data);
							}
							if($status=='Failed')
							{
			$data['result'] = $this->Transaction_Model->get_transaction_list_failed();
       		$this->load->view('transaction/failed_view', $data);
							}
		}
		else
		{
			$data['message'] = '<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Error!</h4>
							 Incorrect Status !!!
							</div>';
				$data['result'] = $this->Transaction_Model->get_transaction_list_new();
       			$this->load->view('transaction/new_view', $data);
		}
		}
		else
		{
			$data['message'] = '<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Error!</h4>
							 Incorrect PNR !!!
							</div>';
				$data['result'] = $this->Transaction_Model->get_transaction_list_new();
       			$this->load->view('transaction/new_view', $data);
		}
    }
	
	public function update_transaction_status_pend($t_id,$pnr_no)
	{
		$Transaction = $this->Transaction_Model->get_transaction_details($pnr_no);
		if($Transaction!='')
		{
		$status = $_POST['status'];
		$message = $_POST['message'];
		$host_id =$Transaction->host_id;
		$host_type =$Transaction->host_type;
		
		if($status=='Process' || $status=='Failed' || $status=='Failed_d' || $status=='Deposit')
		{
			$fail=1;
			if($status=='Failed_d')
			{
				$fail=2;
				$status='Failed';
			}
			
        $status_s = $this->Transaction_Model->update_transaction_status($t_id, $status,$fail,$message,$host_type,$host_id);
		if($status_s==true)
		{
			 $data['HOSTIMAGE']= $Transaction->host_image;
				$data['HOSTNAME']= $Transaction->host_name;
				$data['PNR']= $pnr_no;
				$data['STATUS']= $status;
				$data['COMMENTS']= $message;
				$data['NET_RATE']= $Transaction->net_rate;
				$data['PROPNAME']= $Transaction->prop_name;
				$data['TOTAL']= $Transaction->payout_amount;
				$data['TAX']= $Transaction->host_charge;
				$data['REFERENCELINK']= WEB_FRONT_DIR.'apartment/transaction_track/'.$pnr_no;
				$data['emailid'] = $Transaction->host_email;
			$data['email_template'] = $this->Email_Model->get_email_template('Transaction')->row();
			$this->Email_Model->send_transaction_details($data);
			
		$data['message'] = '<div class="alert alert-block alert-success">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Success!</h4>
							  Status Has Been Changed !!!
							</div>';
		}
		else
		{
			$data['message'] = '<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Error!</h4>
							 Status Has not Been Changed !!!
							</div>';
		}
      					 if($status=='Process' || $status=='Deposit')
							{
			$data['result'] = $this->Transaction_Model->get_transaction_list_pending();
        	$this->load->view('transaction/pending_view', $data);
							}
							if($status=='Failed')
							{
			$data['result'] = $this->Transaction_Model->get_transaction_list_failed();
       		$this->load->view('transaction/failed_view', $data);
							}
		}
		else
		{
			$data['message'] = '<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Error!</h4>
							 Incorrect Status !!!
							</div>';
							
			  $data['result'] = $this->Transaction_Model->get_transaction_list_pending();
        	$this->load->view('transaction/pending_view', $data);
		}
		}
		else
		{
			$data['message'] = '<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Error!</h4>
							 Incorrect PNR !!!
							</div>';
				 $data['result'] = $this->Transaction_Model->get_transaction_list_pending();
        	$this->load->view('transaction/pending_view', $data);
		}
    }
public function update_transaction_status_failed($t_id,$pnr_no) 
	{
		$Transaction = $this->Transaction_Model->get_transaction_details($pnr_no);
		if($Transaction!='')
		{
		$status = $_POST['status'];
		$message = $_POST['message'];
		$host_id =$Transaction->host_id;
		$host_type =$Transaction->host_type;
		
		if($status=='Process' || $status=='Deposit')
		{
				$fail=0;
        $status_s = $this->Transaction_Model->update_transaction_status($t_id, $status,$fail,$message,$host_type,$host_id);
		if($status_s==true)
		{
			 $data['HOSTIMAGE']= $Transaction->host_image;
				$data['HOSTNAME']= $Transaction->host_name;
				$data['PNR']= $pnr_no;
				$data['STATUS']= $status;
				$data['COMMENTS']= $message;
				$data['NET_RATE']= $Transaction->net_rate;
				$data['PROPNAME']= $Transaction->prop_name;
				$data['TOTAL']= $Transaction->payout_amount;
				$data['TAX']= $Transaction->host_charge;
				$data['REFERENCELINK']= WEB_FRONT_DIR.'apartment/transaction_track/'.$pnr_no;
				$data['emailid'] = $Transaction->host_email;
			$data['email_template'] = $this->Email_Model->get_email_template('Transaction')->row();
			$this->Email_Model->send_transaction_details($data);
			
		$data['message'] = '<div class="alert alert-block alert-success">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Success!</h4>
							  Status Has Been Changed !!!
							</div>';
		}
		else
		{
			$data['message'] = '<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Error!</h4>
							 Status Has not Been Changed !!!
							</div>';
		}
       $data['result'] = $this->Transaction_Model->get_transaction_list_pending();
        $this->load->view('transaction/pending_view', $data);
		}
		else
		{
			$data['message'] = '<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Error!</h4>
							 Incorrect Status !!!
							</div>';
			 $data['result'] = $this->Transaction_Model->get_transaction_list_failed();
       		$this->load->view('transaction/failed_view', $data);
		}
		}
		else
		{
			$data['message'] = '<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Error!</h4>
							 Incorrect PNR !!!
							</div>';
				 $data['result'] = $this->Transaction_Model->get_transaction_list_failed();
       		$this->load->view('transaction/failed_view', $data);
		}
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
