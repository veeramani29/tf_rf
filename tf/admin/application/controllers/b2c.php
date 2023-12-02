<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class B2c extends CI_Controller {

    protected $domain_id;

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Admin_Model');
        $this->load->model('Domain_Model');
        $this->load->model('B2c_Model');
        $this->load->model('Email_Model');
        $this->load->model('Home_Model');
        $this->load->model('Support_Model');
	 $this->load->model('booking_model');
        $this->check_isvalidated();
        $this->load->library('form_validation');

        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        $this->domain_id = $this->checkuserdomain();

        if ($this->session->userdata('admin_logged_in')) {
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

    public function b2c_view() {
        $data['user'] = $this->B2c_Model->get_user_list();

        $data['promo'] = $this->B2c_Model->get_promo_list();
        $this->load->view('b2c/view', $data);
    }

    function add_user() {
        $this->form_validation->set_rules('fnam', 'First Name', 'required');
        $this->form_validation->set_rules('lname', 'Last Name', 'required');
        $this->form_validation->set_rules('email3', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) { 
            $data['status'] = '';
            $data['country'] = $this->B2c_Model->get_country_list();
            $data['domain_list'] = $this->Domain_Model->get_domain_list();
            $this->load->view('b2c/add_user', $data);
        } else { 
            $sal = $_POST['sal'];
            $data['firstname'] = $fnam = $_POST['fnam'];
            $lname = $_POST['lname'];
            $data['password'] =  $pw3 = $_POST['pw3'];
            $data['emailid'] = $email3 = $_POST['email3'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $city = $_POST['city'];
            $country = $_POST['country'];
            $postal = $_POST['postal'];
            $domain = $_POST['domain'];
	        $data['user'] = "User";
	        $data['url'] = WEB_URL.'b2c/login';

            $Query = "select * from  b2c  where email ='" . $email3 . "' and  domain ='" . $domain . "'";
            $query = $this->db->query($Query);
            $count = $query->num_rows();
            //echo $count;
            if ($query->num_rows() > 0) {
                $data['status'] = '<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Already Registered!</h4>
							  This Email Address Already Registered, kindly Use Another One !!!
							</div>';
                $data['country'] = $this->B2c_Model->get_country_list();
                $data['domain_list'] = $this->Domain_Model->get_domain_list();
                $this->load->view('b2c/add_user', $data);
            } else {
                //die;
                $config['upload_path'] = IMAGE_UPLOAD_PATH . $domain . '/b2c/images';
                $config['allowed_types'] = 'gif|jpg|png';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('file')) {
                    $error = array('error' => $this->upload->display_errors());
                    $data['status'] = '<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Profile Photo!</h4>
							  ' . $error['error'] . '
							</div>';
                    $data['country'] = $this->B2c_Model->get_country_list();
                    $data['domain_list'] = $this->Domain_Model->get_domain_list();
                    
                    $this->load->view('b2c/add_user', $data);
                } else {
                    $cc = $this->upload->data('file');

                    $image_path = WEB_DIR . 'upload_files/' . $domain . '/b2c/images/' . $cc['file_name'];

                    if ($this->B2c_Model->add_b2c_user($sal, $fnam, $lname, $pw3, $email3, $address, $phone, $city, $country, $postal, $domain, $image_path)) {
			        $data['image'] = $image_path;
			        $data['email_template'] = $this->Email_Model->get_email_template('add_user_active')->row();
			        $this->Email_Model->send_add_user_active($data);
                        /****** EMAIL **********/

                       redirect('b2c/b2c_view', 'refresh');
                    } else {
                        $data['status'] = '<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Already Registered!</h4>
							  This Email Address Already Registered, kindly Use Another One !!!
							</div>';
                        $data['country'] = $this->B2c_Model->get_country_list();
                        $data['domain_list'] = $this->Domain_Model->get_domain_list();
                        $this->load->view('b2c/add_user', $data);
                    }
                }
            }
        }
    }

    function edit_b2c_user($id) {
        $data['status'] = '';
        $data['country'] = $this->B2c_Model->get_country_list();
        $data['user'] = $this->B2c_Model->get_user_list_id($id);
        $data['domain_list'] = $this->Domain_Model->get_domain_list();

        if (isset($this->domain_id) && !empty($this->domain_id)) {
            if ($data['user']->domain != $this->domain_id) {
                redirect('b2c/b2c_view');
            }
        }
        $this->load->view('b2c/edit_user', $data);
    }


    function connection_user($id){
	   $user = $this->B2c_Model->get_user_list_id($id);
       $email = $user->email;
	   $password = $user->password;
	 //  $this->session->unset_userdata('sessionUserInfo');
	   //$this->session->sess_destroy();
		
		 
		/*$b2c_session =  array(
            'b2c_id' => $id,
            'user_type' => '3',
            'provider' => 'InnoGlobe'
        );
	
        $this->ci_session->set_userdata($b2c_session);*/
		//check if two step verification is enabled

		// $checkVeriType = $this->B2c_Model->checkTwoStepVerification($id,3);
		// if(!empty($checkVeriType) && $checkVeriType != "" ) {
		// 	if($checkVeriType->two_step_verification == 1  && $checkVeriType->two_step_type > 0) {
		// 		$this->session->set_userdata('temp_b2c_id', $id);   //setting temp_b2c_id
		// 		$this->session->set_userdata('temp_email_id', $email);   //setting temp_email_id
		// 		$response = array(
		// 			'status' => '2'
		// 		);
		// 	} else {
		// 		$this->session->set_userdata($b2c_session); //start session, log user in without two steps
			
		// 	}
		// } else {
		// 	$this->session->set_userdata($b2c_session); //start session, log user in without two steps
		
		// }
					
				//echo '<pre/>';
				//print_r($this->session->userdata);exit;
		redirect(WEB_FRONT_URL,'refresh');
    }

    function update_user_status($id, $status) {
        $user = $this->B2c_Model->get_user_list_id($id);
        $data['emailid'] =  $email3 = $user->email;
        $data['firstname'] =  $fnam = $user->firstname;
        $data['password'] =  $password = $user->password;
        $data['image'] =  $photo = $user->profile_photo;
	   $data['user'] = 'User';
	   $data['url'] = WEB_URL ;
        if ($status == 2) {
            $supportval = $this->B2c_Model->get_user_support_ticket($id);
            if ($supportval) {
                foreach ($supportval as $ticketval) {

                    $this->db->delete('support_ticket_history', array('support_ticket_id' => $ticketval->support_ticket_id));
                    $this->db->delete('support_ticket', array('support_ticket_id' => $ticketval->support_ticket_id));
                }
            }

            $wheres = "user_id = $id";
            $this->db->delete('b2c', $wheres);

	    $data['email_template'] = $this->Email_Model->get_email_template('user_closed')->row();
	   $this->Email_Model->send_add_user_active($data);
        } else {

            $this->B2c_Model->update_user_status($id, $status);
            if ($status == 1) {
		$data['email_template'] = $this->Email_Model->get_email_template('add_user_active')->row();
  	        $this->Email_Model->send_add_user_active($data);
            }
            if ($status == 0) {
              
		$data['email_template'] = $this->Email_Model->get_email_template('user_deactivate')->row();
  	        $this->Email_Model->send_add_user_active($data);
            }
           
        }
       redirect('b2c/b2c_view', 'refresh');
    }

    function send_user_mail($id) {
        $data['status'] = '';
        $data['user'] = $this->B2c_Model->get_user_list_id($id);
        $this->load->view('b2c/send_b2c_mail', $data);
    }

    function send_user_promo($user_id) {

        $promo_id = $_POST['promoid'];
        $user = $this->B2c_Model->get_user_list_id($user_id);

        $promo_value = $this->B2c_Model->get_promo_code_id($promo_id);
	$data['promo_code'] = $promo_value;
        $exp_date = date('M j,Y', strtotime($promo_value->exp_date));
	$data['email_template'] = $this->Email_Model->get_email_template('promo_code')->row();


        $data['emailid'] = $user->email;
        $data['firstname'] = $user->firstname;
		
        $this->Email_Model->send_promocode_mail($data);
        redirect('b2c/b2c_view', 'refresh');
    }

    function send_mail() {
	$data['firstname'] = $firstname = $this->input->post('firstname');
        $data['mailid']= $mailid = $this->input->post('mailid');
        $data['subject']= $subject = $this->input->post('subject');
        $data['message']=  $message = $this->input->post('message');
	   $data['email_template'] = $this->Email_Model->get_email_template('send_mail_to_user')->row();
        $this->Email_Model->send_mail_to_user($data);
       
        redirect('b2c/b2c_view', 'refresh');
    }

    function update_user($id) {

        $sal = $_POST['sal'];
        $fnam = $_POST['fnam'];
         $mnam = $_POST['mnam'];
        $lname = $_POST['lname'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $postal = $_POST['postal'];
        $domain = $_POST['domain'];
        if ($this->B2c_Model->update_b2c_user($id, $sal, $fnam,$mnam, $lname, $address, $phone, $city, $country, $postal, $domain)) {
            redirect('b2c/b2c_view', 'refresh');
        } else {
            $data['status'] = '<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Error!</h4>
							  Update Has not Been Completed !!!
							</div>';
            $data['country'] = $this->B2c_Model->get_country_list();
            $data['domain_list'] = $this->Domain_Model->get_domain_list();
            $this->load->view('b2c/edit_user', $data);
        }
    }

    function send_notification($uid) {

        $notification = $_POST['notification'];
        $user = $this->B2c_Model->get_user_list_id($uid);
        $noteval = $this->B2c_Model->insert_notification_value($_POST['notification'], $user->domain, $uid);
        $this->B2c_Model->insert_user_value($user->user_id, $user->usertype, $noteval);
        redirect('b2c/b2c_view', 'refresh');
    }

    function checkuserdomain() {
        $domain_id = $this->session->userdata('domain_id');
        if (!empty($domain_id)) {
            return $domain_id;
        } else {
            return false;
        }
    }

// Export Excel File
    function export_b2c_users() {
        $selected_ids = $this->input->post('cid');

        if (!empty($selected_ids)) {

            $this->load->library("Excel");
            $phpExcel = new PHPExcel();
            $prestasi = $phpExcel->setActiveSheetIndex(0);
            //merger
            $phpExcel->getActiveSheet()->mergeCells('A1:H1');
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
            $phpExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray);
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
            $prestasi->setCellValue('A1', 'Candidate Report');
            $phpExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray);
            $phpExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray1);
            $phpExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray12);
            $prestasi->setCellValue('A2', 'S.No');
            $prestasi->setCellValue('B2', 'Name');
            $prestasi->setCellValue('C2', 'Mobile Number');
            $prestasi->setCellValue('D2', 'Email');
            $prestasi->setCellValue('E2', 'Address');
            $prestasi->setCellValue('F2', 'City');
            $prestasi->setCellValue('G2', 'Counrty');
            $prestasi->setCellValue('H2', 'Postal');

            $user_data = $this->B2c_Model->export_b2c_users($selected_ids)->result();

            $no = 0;
            $rowexcel = 2;
            foreach ($user_data as $row) {
                $no++;
                $rowexcel++;
                $phpExcel->getActiveSheet()->getStyle('A' . $rowexcel . ':H' . $rowexcel)->applyFromArray($styleArray);
                $phpExcel->getActiveSheet()->getStyle('A' . $rowexcel . ':H' . $rowexcel)->applyFromArray($styleArray1);
                $prestasi->setCellValue('A' . $rowexcel, $no);
                $prestasi->setCellValue('B' . $rowexcel, $row->firstname . ' ' . $row->lastname);
                $prestasi->setCellValue('C' . $rowexcel, $row->contact_no);
                $prestasi->setCellValue('D' . $rowexcel, $row->email);
                $prestasi->setCellValue('E' . $rowexcel, $row->address);
                $prestasi->setCellValue('F' . $rowexcel, $row->city);
                $prestasi->setCellValue('G' . $rowexcel, $row->country);
                $prestasi->setCellValue('H' . $rowexcel, $row->postal_code);
            }
            $prestasi->setTitle('B2C Report');
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=\"b2c_users.xlsx\"");
            header("Cache-Control: max-age=0");
            $objWriter = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
            $objWriter->save("php://output");
        } else {
            redirect('b2c/b2c_view');
        }
    }

// Export Excel file End




    function export_b2c_users632() {
        $selected_ids = $this->input->post('cid');
        $output = "";
        $table = "b2c"; // Enter Your Table Name 
        foreach ($selected_ids as $id) {
            //$user_data[] = $this->B2c_Model->export_b2c_users($id);
            $user_data[] = $this->B2c_Model->export_b2c_users1($id)->row();
        }

        // Fetch Record from Database

        $output = "";
        $table = "b2c"; // Enter Your Table Name 
        $sql = mysql_query("select * from $table");
        $columns_total = mysql_num_fields($sql);

// Get The Field Name

        for ($i = 0; $i < $columns_total; $i++) {
            $heading = mysql_field_name($sql, $i);
            $output .= '"' . $heading . '",';
        }
        $output .="\n";

// Get Records from the table

        while ($row = mysql_fetch_array($sql)) {
            for ($i = 0; $i < $columns_total; $i++) {
                $output .='"' . $row["$i"] . '",';
            }
            $output .="\n";
        }

// Download the file

        $filename = "myFile.csv";
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);

        echo $output;
        exit;
    }

    function export_b2c_usersaaa() {
        $value = $this->input->post('cid');
        //$contents="usertype,twitter_id,email,firstname,lastname,address,ship_address,contact_no,city,postal_code\n";
        $contents = "";

        if (!empty($value)) {

            for ($m = 0; $m < count($value); $m++) {
                $user_data = $value[$m];
                // print_r($user_data); exit();
                $this->B2c_Model->export_b2c_users($value[$m]);
            }
            $b2c = $this->B2c_Model->export_b2c_users($value);


            for ($i = 0; $i < count($b2c); $i++) {
                $contents.=$b2c[$i]->usertype . "\t";
                $contents.=$b2c[$i]->twitter_id . "\t";
                $contents.=$b2c[$i]->email . "\t";
                $contents.=$b2c[$i]->firstname . "\t";
                $contents.=$b2c[$i]->lastname . "\t";
                $contents.=$b2c[$i]->address . "\t";

                $contents.=$b2c[$i]->ship_address . "\t";
                $contents.=$b2c[$i]->contact_no . "\t";
                $contents.=$b2c[$i]->city . "\t";
                $contents.=$b2c[$i]->postal_code . "\t";


                $datetime = $b2c[$i]->CreatedDate;
                if (strpos($datetime, ' ') !== false) {
                    $datetime1 = str_replace(' ', '_', $datetime);
                    //echo $special1;
                } else {

                    $datetime1 = $datetime;
                }
                $contents.=$datetime1 . "\t";
                $verdatetime = $b2c[$i]->VerificationDate;
                if (strpos($verdatetime, ' ') !== false) {
                    $verdatetime1 = str_replace(' ', '_', $verdatetime);
                    //echo $special1;
                } else {

                    $verdatetime1 = $verdatetime;
                }
                $contents.=$verdatetime1 . "\r\n";
            }

            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=B2C.csv");
            header("Pragma: no-cache");
            header("Expires: 0");
            echo $contents;
        } else {

            redirect('b2c/b2c_view');
        }
    }

    function export_b2c_users321() {

        $value = $this->input->post('cid');

        if (!empty($value)) {

            for ($m = 0; $m < count($value); $m++) {
                $user_data = $value[$m];
                // print_r($user_data); exit();
                $sql = $this->B2c_Model->export_b2c_users($value[$m]);
            }



            $output = "";
            $table = ""; // Enter Your Table Name 
//$sql =  "SELECT usertype,twitter_id,email,firstname,lastname,address,ship_address,contact_no,city,postal_code FROM b2c";
// print_r($sql); exit();
            $columns_total = mysql_num_fields($sql, $m);

// Get The Field Name

            for ($i = 0; $i < $columns_total; $i++) {
                $heading = mysql_field_name($sql, $i);
                $output .= '"' . $heading . '",';
            }
            $output .="\n";

// Get Records from the table

            while ($row = mysql_fetch_array($sql)) {
                for ($i = 0; $i < $columns_total; $i++) {
                    $output .='"' . $row["$i"] . '",';
                }
                $output .="\n";
            }

// Download the file

            $filename = "myFile.csv";
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename=' . $filename);

            echo $output;
            exit;
        } else {
            redirect('b2c/b2c_view');
        }
    }

    function export_b2c_users123() {
        $value = $this->input->post('cid');
//print_r($value);


        for ($m = 0; $m < count($value); $m++) {
            $user_data = $value[$m];
            // print_r($user_data); exit();
            //  $sql=$this->B2c_Model->export_b2c_users($value[$m]);
            $queryString = "SELECT usertype,twitter_id,email,firstname,lastname,address,ship_address,contact_no,city,postal_code FROM b2c where user_id='$value[$m]'";
        }




        $result = mysql_query($queryString);

//print_r($queryString); exit();
// $result = $db_con->query('SELECT * FROM `Activity_Log`');
        if (!$result)
            die('Couldn\'t fetch records');

        $num_fields = mysql_num_fields($result);

        $headers = array();
        for ($i = 0; $i < $num_fields; $i++) {
            $headers[] = mysql_field_name($result, $i);
        }

// $today = date("F_j,_Y,_g:ia");
        $today = date("Ymd_g-ia");

        $fp = fopen('php://output', 'w');
        if ($fp && $result) {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="ADEC_Activty_export-' . ($today) . '.csv"');
            header('Pragma: no-cache');
            header('Expires: 0');
            fputcsv($fp, $headers);
            while ($row = mysql_fetch_row($result)) {
                fputcsv($fp, $row, ",");
            }
            die;
        }
    }
    
    public function create_property_account($b2c_id){
		$this->load->model('Kigo_Model');
		
		$user = $this->B2c_Model->get_user_list_id_owner($b2c_id);		
		if($user!='')
		{
		$data['OWNER_FIRSTNAME'] = $user->firstname;
		$data['OWNER_LASTNAME'] = $user->lastname;
		$data['OWNER_EMAIL'] = $user->email;
		$data['OWNER_PHONE_HOME'] = $user->contact_no;
        $data['OWNER_PHONE_WORK'] = $user->contact_no;
        $data['OWNER_PHONE_CELL'] = $user->contact_no;
        $data['OWNER_FAX'] = '';
        $data['OWNER_STREETNO'] = '';
        $data['OWNER_ADDR1'] = $user->address;
        $data['OWNER_ADDR2'] = $user->address;
        $data['OWNER_ADDR3'] = $user->address;
        $data['OWNER_POSTCODE'] = $user->postal_code;
        $data['OWNER_CITY'] = $user->city;
        $data['OWNER_COUNTRY'] =$user->country;
        $data['OWNER_CONTACT_INFO'] = "";
		
        $reference_id = $this->Kigo_Model->insert_onwers($data);

        $data_notification['MODULE_NAME'] = 'owners';
        $data_notification['REFERENCE_ID'] = $reference_id;
        $data_notification['ACTION_STATUS'] = 0;
        $data_notification['KIGO_PUSH_STATUS'] = 0;
        $this->Kigo_Model->insert_notification($data_notification);
		
		$this->B2c_Model->update_b2c_onwer_create($b2c_id,$reference_id);
		}
		redirect('b2c/b2c_view');
	}                                          

	public function view_bookings($user_id,$user_type){
		if($user_id){		
		 	//$data['ApartmentBookings'] = $ApartmentBookings = $this->booking_model->getApartmentBookings($user_id, $user_type)->result();
			//$data['HotelBookings'] = $this->booking_model->getHotelBookings($user_id, $user_type)->result();
            $data['FlightBookings'] = $this->booking_model->getFlightBookings($user_id, $user_type)->result();
           // $data['HotelCRSBookings'] = $this->booking_model->getHotelCRSBookings($user_id, $user_type)->result();
           // $data['CarBookings'] = $this->booking_model->getCarBookings($user_id, $user_type)->result();
           // $data['VacationBookings'] = $this->booking_model->getVacationBookings($user_id, $user_type)->result();
           
            $this->load->view("b2c/view_bookings",$data);
				
		}else{
			redirect('');
		}
			
	}

    function view_profile($id)
    {
		 $data['pay'] = $this->B2c_Model->view_payment_method($id); 
        $data['user'] = $this->B2c_Model->get_user_list_id($id); 
        $data['id']=$id;
        $data['status']='';
        $this->load->view('b2c/view_profile',$data);
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
