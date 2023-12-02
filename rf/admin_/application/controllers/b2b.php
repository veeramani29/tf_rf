<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class B2b extends CI_Controller {

	protected $domain_id;
	
	public function __construct(){
		  parent::__construct();
		  $this->load->database(); 
		  $this->load->model('Admin_Model');
		  $this->load->model('B2b_Model');
		  $this->load->model('Home_Model');
		  $this->load->model('Domain_Model');
		  $this->load->model('Deposit_Model');
		  $this->load->model('Support_Model');
		  $this->load->model('Email_Model');
		   $this->load->model('booking_model');
		  $this->check_isvalidated();	
		  $this->load->library('form_validation');
			
		  $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		  $this->output->set_header("Pragma: no-cache");
		  $this->domain_id = $this->checkuserdomain();

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
if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in'))
{
	redirect('login/index');
}
}
	public function b2b_view(){
		if(!empty($this->domain_id)){
			$data['user'] = $this->B2b_Model->get_agentuser_domian_list($this->domain_id);
		}else{
			$data['user'] = $this->B2b_Model->get_agent_list(); 
		}

		$data['promo'] = $this->B2b_Model->get_promo_list(); 
		$this->load->view('b2b/view',$data);
 	}
	
	
	
	function add_agent(){
		//echo '<pre/>';
		//print_r($_POST);exit;
		$this->form_validation->set_rules('fnam', 'First Name', 'required');
		$this->form_validation->set_rules('lname', 'Last Name', 'required');
		$this->form_validation->set_rules('email3', 'Email', 'required|valid_email');
		if($this->form_validation->run()==FALSE){
	  		$data['status']='';
			$data['country'] = $this->Home_Model->get_country_list(); 
			$data['domain_list'] = $this->Domain_Model->get_domain_list(); 
			$this->load->view('b2b/add_agent',$data);
		}else{
			
			 $data['firstname'] =  $name = $_POST['sal'].' '.$_POST['fnam'].' '.$_POST['lname'];
			$data['password'] = $pw3 = $_POST['pw3'];
			 $data['emailid'] = $email3 = $_POST['email3'];
			$address = $_POST['address'];
			$phone = $_POST['phone'];
			$city = $_POST['city'];
			$country = $_POST['country'];
			$postal = $_POST['postal'];
			$domain = $_POST['domain'];
			$company = $_POST['company'];
			$office = $_POST['office'];
			$data['user'] = "Agent";
	    	$data['url'] = WEB_FRONT_URL.'agent/login';
			
			
		$Query="select * from  b2b  where email_id ='".$email3."' and  domain ='".$domain."'";
	 
		 $query=$this->db->query($Query);
		
		if ($query->num_rows() > 0)
		{
			
			$data['status'] = '<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Already Registered!</h4>
							  This Email Address Already Registered, kindly Use Another One !!!
							</div>';
			$data['country'] = $this->Home_Model->get_country_list(); 
			$data['domain_list'] = $this->Domain_Model->get_domain_list(); 
			$this->load->view('b2b/add_agent',$data);
		}
		else
		{
		//	  echo 'asdas';exit;

			$config['upload_path'] = IMAGE_UPLOAD_PATH.$domain.'/b2b/images';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file'))
		{
			$error = array('error' => $this->upload->display_errors());

			$data['status'] ='<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Agent Logo!</h4>
							  '.$error['error'].'
							</div>';
			$data['country'] = $this->Home_Model->get_country_list(); 
			$data['domain_list'] = $this->Domain_Model->get_domain_list(); 
			$this->load->view('b2b/add_agent',$data);
		}
		else
		{
			$cc = $this->upload->data('file');
    			$image_path = WEB_DIR.'upload_files/'.$domain.'/b2b/images/'.$cc['file_name'];
		 
			if($this->B2b_Model->add_agent_user($name,$company,$office,$pw3,$email3,$address,$phone,$city,$country,$postal,$domain,$image_path))
			{
				/*$message = 'Your Agent Account Has Been Activated. Please click the below link to SignIn your account<br><br>';
				$message .='<table width="100%" border="0" cellspacing="5" cellpadding="5"><tr>
				<td rowspan="3"><img src="'.$image_path.'" width="100"></td>
				<td rowspan="3" align="left" valign="top">
				<strong>URL</strong> :'.WEB_URL.'b2b/login<br>
				<strong>Email</strong> : '.$email3.'<br>
				<strong>Password</strong> : '.$pw3.'<br>
				</td>
				</tr>
				</table>';
				 $message_header='Agent Login Acess';
				 $subject='InnoGlobe Agent Login Acess';
				 $this->Email_Model->send_email($name,$subject,$email3,$message_header,$message);*/
				$data['image'] = $image_path;
				$data['email_template'] = $this->Email_Model->get_email_template('add_user_active')->row();

				 $this->Email_Model->send_add_user_active($data);
				 redirect('b2b/b2b_view','refresh');
			}
			else
			{
			$data['status'] = '<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Already Registered!</h4>
							  This Email Address Already Registered, kindly Use Another One !!!
							</div>';
			$data['country'] = $this->Home_Model->get_country_list(); 
			$data['domain_list'] = $this->Domain_Model->get_domain_list(); 
			$this->load->view('b2b/add_agent',$data);
			
			}


		}
	
	  		
		}
		}
	}
	function change_password($id,$status='')
	{
		$data['status']=$status;
		$data['id']=$id;
		$data['user'] = $this->B2b_Model->get_agent_list_id($id); 
		$this->load->view('b2b/change_password', $data);
	}
	function update_password($id)
	{
		
		$data['password'] = $npass = $this->input->post('npass');
		$user = $this->B2b_Model->get_agent_list_id($id); 
		$data['emailid'] = $email3 = $user->email_id;
		$data['firstname'] = $fnam = $user->name;
		$password = $user->password;
		$photo= $user->agent_logo;
		$data['email_template'] = $this->Email_Model->get_email_template('admin_change_password')->row();
		   if ($this->B2b_Model->update_agent_password($npass,$id)) {
			        // echo 'sada';exit;
				/*$message = 'Your Password Has Been Changed. Please Contact Admin<br><br>';
				$message .='<table width="100%" border="0" cellspacing="5" cellpadding="5"><tr>
				<td rowspan="3"><img src="'.$photo.'" width="100"></td>
				<td rowspan="3" align="left" valign="top">
				<strong>URL</strong> : '.WEB_URL.'b2b/login<br>
				<strong>Email</strong> : '.$email3.'<br>
				<strong>Password</strong> : '.$password.'<br>
				</td>
				</tr>
				</table>'; 
				$message_header='Password Changed';
				$subject='InnoGlobe - Your Agent Password Changed';
				$this->Email_Model->send_email($fnam,$subject,$email3,$message_header,$message);*/
				$this->Email_Model->send_admin_change_password($data);
			        $status=1;
		   }
		   else
		   {
			 
		        $status=0;
		   }
		   
		redirect('b2b/view_profile/'.$id,'refresh');
	}
	function view_profile($id)
	{
		$data['user'] = $this->B2b_Model->get_agent_list_id($id); 
		$data['deposit'] = $this->Deposit_Model->agent_deposit_details($id); 
		$data['deposit_amount'] = $this->B2b_Model->get_deposit_amount($id); 
		$data['id']=$id;
		$data['status']='';
		$this->load->view('b2b/agent_view',$data);
	}
	function edit_b2b_user($id)
	{
		
		$data['user'] = $this->B2b_Model->get_agent_list_id($id); 
		$data['deposit'] = $this->Deposit_Model->agent_deposit_details($id); 
		$data['deposit_amount'] = $this->B2b_Model->get_deposit_amount($id); 
		$data['country'] = $this->Home_Model->get_country_list(); 
		$data['domain_list'] = $this->Domain_Model->get_domain_list(); 
		$data['id']=$id;
		$data['status']='';
		if(isset($this->domain_id) && !empty($this->domain_id))
		{
			if($data['user']->domain != $this->domain_id)
			{
				redirect('b2b/b2b_view');
			}
		}
			
		$this->load->view('b2b/edit_agent',$data);
	}
	function update_agent($id)
	{
		
				$name = $_POST['name'];
			$address = $_POST['address'];
			$phone = $_POST['phone'];
			$city = $_POST['city'];
			$country = $_POST['country'];
			$postal = $_POST['postal'];
			$domain = $_POST['domain'];
			$company = $_POST['company'];
			$office = $_POST['office'];
			
			if($this->B2b_Model->update_b2b_agent($id,$name,$address,$phone,$city,$country,$postal,$domain,$company,$office))
			{
						redirect('b2b/view_profile/'.$id,'refresh');
			}
			else
			{
					redirect('b2b/edit_b2b_user/'.$id,'refresh');
			}
	}
	function send_user_promo($user_id)
	{
		$promo_id = $_POST['promoid'];
		$user = $this->B2b_Model->get_agent_list_id($user_id); 
		
		$promo_value = $this->B2b_Model->get_promo_code_id($promo_id); 
		$data['promo_code'] = $promo_value;
        	$exp_date = date('M j,Y', strtotime($promo_value->exp_date));
		$data['email_template'] = $this->Email_Model->get_email_template('promo_code')->row();
		/*$message = '<br>Take it your promo code.<br><br>';
		$message .='Please note, your discount code is <font color="#990033"><blink>'.$promo_value->promo_code.'</blink></font> which can be used to get <strong>'.$promo_value->discount.'% </strong>off while using our services.<br>
		This code is valid upto '.$exp_date;
		$message_header='Promo Code';
		$subject='Promo Code | Special Discount For You !!!';
		*/
		$data['emailid'] = $user->email_id;
       		$data['firstname'] = $user->name;
        	$this->Email_Model->send_promocode_mail($data);
		//$email3 = $user->email_id;
		//$fnam = $user->name;
		//$this->Email_Model->send_email($fnam,$subject,$email3,$message_header,$message);
		redirect('b2b/b2b_view','refresh');
	}
	function update_agent_status($id,$status)
	{
		$user = $this->B2b_Model->get_agent_list_id($id); 
		$data['emailid'] =  $email3 = $user->email_id;
		$data['firstname'] = $fnam = $user->firstname;
		$data['password'] =  $password = $user->password;
		$data['image'] =  $photo= $user->agent_logo;
		$data['user'] = 'Agent';
		$data['url'] = WEB_FRONT_URL . 'agent/login';
		if($status==2)
		{
			
			$supportval = $this->B2b_Model->get_agent_support_ticket($id); 
			
				if($supportval)
				{
					foreach($supportval as $ticketval){

					$this->db->delete('support_ticket_history', array('support_ticket_id' => $ticketval->support_ticket_id)); 
					$this->db->delete('support_ticket', array('support_ticket_id' => $ticketval->support_ticket_id)); 

					}

				}
				$wheres = "agent_id = $id";
				$this->db->delete('b2b', $wheres);
				$this->db->delete('b2b_acc_info', $wheres);
				$this->db->delete('b2b_deposit', $wheres);
				$this->db->delete('b2b_top_cities', $wheres);
				$wheres1 = "user_id  = $id AND user_type = 2";
				$this->db->delete('support_ticket', $wheres1);
				/*$message = 'Your Agent Account Has Been Closed. Please Contact Admin<br><br>';
				$message .='<table width="100%" border="0" cellspacing="5" cellpadding="5"><tr>
				<td rowspan="3"><img src="'.$photo.'" width="100"></td>
				<td rowspan="3" align="left" valign="top">
				<strong>Email</strong> : '.$email3.'<br>
				<strong>Name</strong> : '.$fnam.'<br>
				</td>
				</tr>
				</table>'; 
				$message_header='Closed';
				$subject='InnoGlobe - Your Agent Account Closed';
				$this->Email_Model->send_email($fnam,$subject,$email3,$message_header,$message);*/
				 $data['email_template'] = $this->Email_Model->get_email_template('user_closed')->row();
	   			$this->Email_Model->send_add_user_active($data);
				}
		else
		{
		 $this->B2b_Model->update_agent_status($id,$status); 
		 	if($status==1)
			{
				
				/*$message = 'Your Agent Account Has Been Activated. Please click the below link to SignIn your account<br><br>';
				$message .='<table width="100%" border="0" cellspacing="5" cellpadding="5"><tr>
				<td rowspan="3"><img src="'.$photo.'" width="100"></td>
				<td rowspan="3" align="left" valign="top"><strong>URL</strong> : '.WEB_URL.'b2b/login<br><strong>Email</strong> : '.$email3.'<br><strong>Password</strong> : '.$password.'<br></td>
				</tr>
				</table>';
				$message_header='Activation';
				$subject='InnoGlobe - Your Agent Account Activated';*/
				$data['email_template'] = $this->Email_Model->get_email_template('add_user_active')->row();
  	        		$this->Email_Model->send_add_user_active($data);
			}
			if($status==0)
			{
				/*$message = 'Your Agent Account Has Been DeActivated. Please Contact Admin<br><br>';
				$message .='<table width="100%" border="0" cellspacing="5" cellpadding="5"><tr>
				<td rowspan="3"><img src="'.$photo.'" width="100"></td>
				<td rowspan="3" align="left" valign="top">
				<strong>Email</strong> : '.$email3.'<br>
				<strong>Name</strong> : '.$fnam.'<br>
				</td>
				</tr>
				</table>';
				$message_header='DeActivation';
				$subject='InnoGlobe - Your Agent Account DeActivated';*/
				$data['email_template'] = $this->Email_Model->get_email_template('user_deactivate')->row();
  	        		$this->Email_Model->send_add_user_active($data);
			}
			//$this->Email_Model->send_email($fnam,$subject,$email3,$message_header,$message);
		 	
		}
		  redirect('b2b/b2b_view','refresh');
	}
	function send_user_mail($id)
	{
		    $data['status']='';
			$data['user'] = $this->B2b_Model->get_agent_list_id($id); 
			
			$this->load->view('b2b/send_b2b_mail',$data);
	}
	function send_mail()
	{
		$data['firstname'] = $firstname = $this->input->post('firstname');
		$data['mailid']= $mailid = $this->input->post('mailid');
		$data['subject']= $subject = $this->input->post('subject');
		$data['message']=  $message = $this->input->post('message');
		$data['email_template'] = $this->Email_Model->get_email_template('send_mail_to_user')->row();
		$this->Email_Model->send_mail_to_user($data);
		//$this->Email_Model->send_email_normal($subject,$mailid,$message);
    		redirect('b2b/b2b_view','refresh');
	}
	
	
	function send_notification($aid)
	{
	
		$notification = $_POST['notification'];
		$agent = $this->B2b_Model->get_agent_list_id($aid); 
		$noteval = $this->B2b_Model->insert_notification_value($_POST['notification'],$agent->domain);
		$this->B2b_Model->insert_agent_value($agent->agent_id,$agent->agent_type,$noteval);
		 redirect('b2b/b2b_view','refresh');
	}	
	
	function checkuserdomain()
	{
		$domain_id = $this->session->userdata('domain_id');
		if(!empty($domain_id))
		{
			return $domain_id;
		}
		else
		{
			return false;
		}	
	}
	
	
	
 
 
	
	
	
	// Export Excel File
function export_b2b_users(){
	$selected_ids = $this->input->post('cid');
	
  if(!empty($selected_ids)){
  	
	$this->load->library("Excel");
	$phpExcel = new PHPExcel();
	$prestasi = $phpExcel->setActiveSheetIndex(0);
	//merger
	$phpExcel->getActiveSheet()->mergeCells('A1:I1');
	//manage row hight
	$phpExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(25);
	//style alignment
		$styleArray = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			),
		);
	$phpExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);					
	$phpExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($styleArray);
	//border
	$styleArray1 = array(
		  'borders' => array(
			'allborders' => array(
			  'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		  )
	);
	//background
		$styleArray12 = array(
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array(
					'rgb' => '00acec',
					//'rgb' => '009933',
				),
			),
		);
	//freeepane
		$phpExcel->getActiveSheet()->freezePane('A3');
				//coloum width
		$phpExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4.1);
		$phpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$phpExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
		$phpExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
		$phpExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
		$phpExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
		$phpExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
		$phpExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
		$phpExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
		$prestasi->setCellValue('A1', 'B2B Report');
		$phpExcel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($styleArray);
		$phpExcel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($styleArray1);
		$phpExcel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($styleArray12);
		$prestasi->setCellValue('A2', 'S.No');				
		$prestasi->setCellValue('B2', 'Name');
		$prestasi->setCellValue('C2', 'Mobile Number');
		$prestasi->setCellValue('D2', 'Email');
		$prestasi->setCellValue('E2', 'Address');
		$prestasi->setCellValue('F2', 'City');
		$prestasi->setCellValue('G2', 'Counrty');
		$prestasi->setCellValue('H2', 'Postal');
		$prestasi->setCellValue('I2', 'company_name');
		
		$user_data = $this->B2b_Model->export_b2b_users($selected_ids)->result();
		
		$no=0;
		$rowexcel = 2;
		foreach($user_data as $row){
			$no++;
			$rowexcel++;
			$phpExcel->getActiveSheet()->getStyle('A'.$rowexcel.':I'.$rowexcel)->applyFromArray($styleArray);
			$phpExcel->getActiveSheet()->getStyle('A'.$rowexcel.':I'.$rowexcel)->applyFromArray($styleArray1);
			$prestasi->setCellValue('A'.$rowexcel, $no);
			$prestasi->setCellValue('B'.$rowexcel, $row->name);
			$prestasi->setCellValue('C'.$rowexcel, $row->mobile);
			$prestasi->setCellValue('D'.$rowexcel, $row->email_id);
			$prestasi->setCellValue('E'.$rowexcel, $row->address);
			$prestasi->setCellValue('F'.$rowexcel, $row->city);
			$prestasi->setCellValue('G'.$rowexcel, $row->country);
			$prestasi->setCellValue('H'.$rowexcel, $row->postal_code);
			$prestasi->setCellValue('I'.$rowexcel, $row->company_name);
				
		}
		$prestasi->setTitle('B2C Report');
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"B2b_users.xlsx\"");
		header("Cache-Control: max-age=0");
		$objWriter = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
		$objWriter->save("php://output");
	}
	else {
		
		redirect('b2b/b2b_view');
		}
	}
	
// Export Excel file End
	
	
	public function view_bookings($user_id,$user_type){
		if($user_id){		
		 	$data['ApartmentBookings'] = $ApartmentBookings = $this->booking_model->getApartmentBookings($user_id, $user_type)->result();
			$data['HotelBookings'] = $this->booking_model->getHotelBookings($user_id, $user_type)->result();
            $data['FlightBookings'] = $this->booking_model->getFlightBookings($user_id, $user_type)->result();
            $data['HotelCRSBookings'] = $this->booking_model->getHotelCRSBookings($user_id, $user_type)->result();
            $data['CarBookings'] = $this->booking_model->getCarBookings($user_id, $user_type)->result();
            $data['VacationBookings'] = $this->booking_model->getVacationBookings($user_id, $user_type)->result();
            
			$this->load->view("b2b/view_bookings",$data);
				
		}else{
			redirect('');
		}
			
	}
	
	public function send_Verfication_detatils($agent_id)
	{
	
	$user = $this->B2b_Model->get_agent_list_id($agent_id); 
		
		$data['email_template'] = $this->Email_Model->get_email_template('Agentverfication')->row();
		/*$message = '<br>Take it your promo code.<br><br>';
		$message .='Please note, your discount code is <font color="#990033"><blink>'.$promo_value->promo_code.'</blink></font> which can be used to get <strong>'.$promo_value->discount.'% </strong>off while using our services.<br>
		This code is valid upto '.$exp_date;
		$message_header='Promo Code';
		$subject='Promo Code | Special Discount For You !!!';
		*/
		$data['emailid'] = $user->email_id;
       	$data['firstname'] = $user->firstname;
		$data['temp_email_opt'] = $user->temp_email_opt;
		$data['confirm_url'] = $user->url_string;
		
		$mobil_opt = $user->temp_mobile_opt;
		$mobilenumber = $user->mobile;
		
        $this->Email_Model->send_agentverfication_mail($data);
	
		
		//$email3 = $user->email_id;
		//$fnam = $user->name;
		//$this->Email_Model->send_email($fnam,$subject,$email3,$message_header,$message);
		redirect('b2b/b2b_view','refresh');
	}
	public function create_property_account($user_id){
		$this->load->model('Kigo_Model');		
		$agent = $this->B2b_Model->get_agent_list_id($user_id);		

		$data['OWNER_FIRSTNAME'] = $agent->firstname;
		$data['OWNER_LASTNAME'] = $agent->lastname;
		$data['OWNER_EMAIL'] = $agent->email_id;
		$data['OWNER_PHONE_HOME'] = $agent->mobile;
        $data['OWNER_PHONE_WORK'] = $agent->office_phone;
        $data['OWNER_PHONE_CELL'] = $agent->mobile;
        $data['OWNER_FAX'] = '';
        $data['OWNER_STREETNO'] = '';
        $data['OWNER_ADDR1'] = $agent->address;
        $data['OWNER_ADDR2'] = $agent->address;
        $data['OWNER_ADDR3'] = $agent->address;
        $data['OWNER_POSTCODE'] = $agent->postal_code;
        $data['OWNER_CITY'] = $agent->city;
        $data['OWNER_COUNTRY'] = "";
        $data['OWNER_CONTACT_INFO'] = "";

        $reference_id = $this->Kigo_Model->insert_onwers($data);

        $data_notification['MODULE_NAME'] = 'owners';
        $data_notification['REFERENCE_ID'] = $reference_id;
        $data_notification['ACTION_STATUS'] = 0;
        $data_notification['KIGO_PUSH_STATUS'] = 0;
        $this->Kigo_Model->insert_notification($data_notification);
		
		$this->B2b_Model->update_b2b_onwer_create($user_id,$reference_id);
		redirect('b2b/b2b_view');
	}
	public function check_user_log_detatils($user_id){
		
		$data['agent'] = $this->B2b_Model->get_agent_list_id($user_id);	
			
$data['log_details'] = $this->B2b_Model->get_agent_log_details($user_id);	
		      
		$this->load->view('b2b/user_logs_view',$data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
