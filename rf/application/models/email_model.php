<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------|
| Author: Provab Technosoft Pvt Ltd.                                       |
|--------------------------------------------------------------------------|
| Developer: Provab                                              |
| Started Date: 2014-08-19T18:00:00                                        |
| Ended Date:                                                              |
|--------------------------------------------------------------------------|
*/

class Email_Model extends CI_Model {
    
    public function commonMail($subject, $body, $to_email_id, $from_email_id, $from_name){
        $access = $this->get_email_acess()->row();

        $this->load->library('email');
        $config['protocol'] = 'mail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';

        $config['mailtype'] = 'html';
        $config['protocol'] = $access->smtp;
        $config['smtp_host'] = $access->host;
        $config['smtp_port'] = $access->port;
        $config['smtp_user'] = $access->username;
        $config['smtp_pass'] = $access->password;
 	//$config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $this->email->initialize($config);

        $this->email->from($from_email_id, $from_name);
        $to = $to_email_id;
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($body);

        if ($this->email->send()) {
            return true;
        } else {
            $this->email->print_debugger();
            die;
            return false;
        }
    }

    public function get_email_acess() {
        return $this->db->get('email_access');
    }

    public function get_email_template($email_type) {
        $this->db->where('email_type', $email_type);
        return $this->db->get('email_template');
    }

    public function get_social_links()
        {
            $this->db->select('*')
                ->from('social_links');
            $query = $this->db->get();
            if ( $query->num_rows > 0 ) {
             return $query->row();
            }
            return false;
        }

    public function sendmail_reg($data) {
        $template_message = $data['email_template']->message;
        $delimiters = $data['email_template']->to_email;
        $email_to = explode(";", $delimiters);
         $email_to_1 = isset($email_to[0])?$email_to[0]:'';
        $email_to_2 = isset($email_to[1])?$email_to[1]:'';
        if($data['user_data']->profile_photo == ''){
            $profile_photo = WEB_FRONT_DIR.'assets/images/user-avatar.jpg';
        }else{
            $profile_photo = $data['user_data']->profile_photo;
        }

        $socials=$this->get_social_links();

        $order_mes=array("{%%FIRSTNAME%%}","{%%USERNAME%%}","{%%PASSWORD%%}",
            "{%%USERIMAGE%%}","{%%CONFIRMLINK%%}","{%%FB%%}","{%%TW%%}","{%%GP%%}","{%%WEB_URL%%}","##WEB_NAME##");
        $replace_mes=array($data['user_data']->firstname,$data['user_data']->email,
            $data['password'],$profile_photo,$data['confirm_link'],$socials->facebook,$socials->twitter,$socials->google,
            WEB_FRONT_DIR,WEB_NAME);
        $message=str_replace($order_mes, $replace_mes, $template_message);

        $lang_order_mes=array("{%%TRAVELLER_BES_TFRND%%}","{%%REG_THANKS%%}","{%%DEAR%%}",
            "{%%CONFIRM_MSG%%}","{%%MAIL_USERNAME%%}","{%%MAIL_PASSWORD%%}","{%%CLICK_CONFIRM%%}");
        $lang_replace_mes=array(lang_line('TRAVELLER_BES_TFRND'),lang_line('REG_THANKS'),lang_line('DEAR'),
            lang_line('CONFIRM_MSG'),lang_line('MAIL_USERNAME'),lang_line('MAIL_PASSWORD'),lang_line('CLICK_CONFIRM'),);
            $message=str_replace($lang_order_mes, $lang_replace_mes, $message);
       
        
        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($data['user_data']->email, $email_to_1, $email_to_2);
        $this->email->subject($data['email_template']->subject);
        $this->email->message($message);
        $this->email->send();
    }

    //for forgot password mail
    public function sendmail_forgot_password($data) {

        $template_message = $data['email_template']->message;
        $delimiters = $data['email_template']->to_email;
        $email_to = explode(";", $delimiters);
         $email_to_1 = isset($email_to[0])?$email_to[0]:'';
        $email_to_2 = isset($email_to[1])?$email_to[1]:'';

        if($data['user_data']->profile_photo == ''){
            $profile_photo =  WEB_FRONT_DIR.'assets/images/user-avatar.jpg';
        }else{
            $profile_photo = $data['user_data']->profile_photo;
        }

     
         $socials=$this->get_social_links();


        $order_mes=array("{%%FIRSTNAME%%}","{%%USERNAME%%}","{%%PASSWORD%%}",
            "{%%USERIMAGE%%}","{%%RESETLINK%%}","{%%FB%%}","{%%TW%%}","{%%GP%%}","{%%WEB_URL%%}","##WEB_NAME##");
        $replace_mes=array($data['user_data']->firstname,$data['user_data']->email,
            $data['password'],$profile_photo,$data['reset_link'],$socials->facebook,$socials->twitter,$socials->google,
            WEB_FRONT_DIR,WEB_NAME);
        $message=str_replace($order_mes, $replace_mes, $template_message);

        $lang_order_mes=array("{%%TRAVELLER_BES_TFRND%%}","{%%RESET_PASSWORD_LINK%%}","{%%DEAR%%}",
            "{%%RESET_PASSWORD_MSG%%}","{%%CLICK_PASSWORD%%}");
        $lang_replace_mes=array(lang_line('TRAVELLER_BES_TFRND'),lang_line('RESET_PASSWORD_LINK'),lang_line('DEAR'),
            lang_line('RESET_PASSWORD_MSG'),lang_line('CLICK_PASSWORD'));
            $message=str_replace($lang_order_mes, $lang_replace_mes, $message);



        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($data['user_data']->email, $email_to_1, $email_to_2);
        $this->email->subject($data['email_template']->subject);
        $this->email->message($message);
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }

    //for e-mail verification mail
    public function sendmail_email_verification($data) {

        $message1 = $data['email_template']->message;
        $delimiters = $data['email_template']->to_email;
        $email_to = explode(";", $delimiters);
       $email_to_1 = isset($email_to[0])?$email_to[0]:'';
        $email_to_2 = isset($email_to[1])?$email_to[1]:'';

        $message1 = str_replace("{%%FIRSTNAME%%}", $data['user_data']->firstname, $message1);
        $message1 = str_replace("{%%CONFIRMLINK%%}", $data['confirm_link'], $message1);
		$message1 = str_replace("{%%WEB_URL%%}", WEB_FRONT_DIR, $message1);
       $socials=$this->get_social_links();
$message1 = str_replace("{%%FB%%}", $socials->facebook, $message1);
$message1 = str_replace("{%%TW%%}", $socials->twitter, $message1);
$message1 = str_replace("{%%GP%%}", $socials->google, $message1);
        
        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        $email_id = (isset($data['user_data']->email)) ? $data['user_data']->email : $data['user_data']->email_id;
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($email_id, $email_to_1, $email_to_2);
        $this->email->subject($data['email_template']->subject);
        $this->email->message($message1);
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }

    //for Request Reference mail
    public function sendmail_request_reference($data) {

        $message1 = $data['email_template']->message;
        $to = $data['email'];
        
        if(isset($data['user_data']->profile_photo) && $data['user_data']->profile_photo != "" ) {
            $profile_photo = $data['user_data']->profile_photo;
        } else if(isset($data['user_data']->agent_logo) && $data['user_data']->agent_logo != "" ) {
            $profile_photo = $data['user_data']->agent_logo;
        } else {
            $profile_photo =  WEB_FRONT_DIR.'assets/images/user-avatar.jpg';
        }

        $message1 = str_replace("{%%NAME%%}", $data['user_data']->firstname.' '.$data['user_data']->lastname, $message1);
        $message1 = str_replace("{%%REFERENCELINK%%}", $data['refrence_link'], $message1);
        $message1 = str_replace("{%%USERIMAGE%%}", $profile_photo, $message1);
        $message1 = str_replace("{%%WEB_URL%%}", WEB_FRONT_DIR, $message1);
        // $message1 = str_replace("{%%SOCIALURLFACE%%}", $facebook_social_url->social_url, $message1);
        // $message1 = str_replace("{%%SOCIALURLTWIT%%}", $twitter_social_url->social_url, $message1);
        // $message1 = str_replace("{%%SOCIALURLGPLUS%%}",$google_social_url->social_url, $message1);
        
        $subject = $data['email_template']->subject;
        $subject = str_replace("{%%NAME%%}", $data['user_data']->firstname.' '.$data['user_data']->lastname, $subject);

        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message1);
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }

    //for Apartment Voucher
    public function sendmail_apartmentVoucher($data) {
        $Booking = $data['Booking'];
        $social_url = $data['social_url'];
        $message = $data['email_template']->message;
        $to = $data['email'];
        //echo '<pre>';print_r($data['host_data']);die;
        if(isset($data['host_data']->profile_photo)) {
            $profile_photo = $data['host_data']->profile_photo;
            $user_id = $data['host_data']->user_id;
            $user_type = '3';
            $contact_no = $data['host_data']->contact_no;
        } else if(isset($data['host_data']->agent_logo)) {
            $profile_photo = $data['host_data']->agent_logo;
            $user_id = $data['host_data']->agent_id;
            $user_type = '2';
            $contact_no = $data['host_data']->mobile;
        } else {
            $profile_photo = ASSETS.'images/user-avatar.jpg';
        }


        if($Booking->PROP_CANCELLATION_DESC != ''){
            $CANCELLATION = $Booking->PROP_CANCELLATION_TYPE. ' : ' .$Booking->PROP_CANCELLATION_DESC;;
        }else{
            $CANCELLATION = 'NA';
        }

        if($Booking->PROP_AREADESCRIPTION != ''){
            $AREA = $Booking->PROP_AREADESCRIPTION;
        }else{
            $AREA = 'NA';
        }

        if($Booking->PROP_ARRIVAL_SHEET != ''){
            $CUSTOMER = $Booking->PROP_ARRIVAL_SHEET;
        }else{
            $CUSTOMER = '';
        }

        $apt_link = WEB_URL.'/apartment/rooms/'.$data['Booking']->PROP_ID;
        $host_profile_link = WEB_URL.'/users/show/'.$user_type.'/'.$user_id;
        $guests = $Booking->RES_N_ADULTS+$Booking->RES_N_CHILDREN+$Booking->RES_N_BABIES;
        $RentData = json_decode($Booking->RENT_DATA);

        $message = str_replace("{%%NAME%%}", $data['Booking']->RES_GUEST_FIRSTNAME, $message);
        $message = str_replace("{%%STATUS%%}", $data['Booking']->booking_status, $message);
        $message = str_replace("{%%PNR%%}", $data['Booking']->pnr_no, $message);
        $message = str_replace("{%%MAP%%}", $data['Map'], $message);
        $message = str_replace("{%%APT_LINK%%}", $apt_link, $message);
        $message = str_replace("{%%APARTMENT%%}", $data['Booking']->PROP_NAME.', '.$data['Booking']->PROP_CITY.' and '.$data['Booking']->PROP_COUNTRY_NAME, $message);
        $message = str_replace("{%%APT_TYPE%%}", $data['Booking']->PROP_TYPE_LABEL, $message);
        $message = str_replace("{%%GUEST%%}", $guests, $message);
        $message = str_replace("{%%CHECKIN_DAY%%}", date('D, M', strtotime($Booking->RES_CHECK_IN)), $message);
        $message = str_replace("{%%CHECKIN_DATE%%}", date('d', strtotime($Booking->RES_CHECK_IN)), $message);
        $message = str_replace("{%%CHECKOUT_DAY%%}", date('D, M', strtotime($Booking->RES_CHECK_OUT)), $message);
        $message = str_replace("{%%CHECKOUT_DATE%%}", date('d', strtotime($Booking->RES_CHECK_OUT)), $message);
        $message = str_replace("{%%HOST_IMAGE%%}", $profile_photo, $message);
        $message = str_replace("{%%HOST_LINK%%}", $host_profile_link, $message);
        $message = str_replace("{%%HOST_NAME%%}", $data['host_data']->firstname.' '.$data['host_data']->lastname, $message);
        $message = str_replace("{%%HOST_PHONE%%}", $contact_no, $message);
        $message = str_replace("{%%RENT_SUBTOTAL%%}", CURR_ICON.$data['Booking']->amount, $message);
        //$message = str_replace("{%%RENT_PER%%}", CURR_ICON.$RentData->price_per, $message);
        $message = str_replace("{%%SERVICE_TAX%%}", CURR_ICON.'0', $message);
        $message = str_replace("{%%TOTAL%%}", CURR_ICON.$data['Booking']->amount, $message);
        $message = str_replace("{%%SOCIALURLFACE%%}", $social_url['facebook_social_url'], $message);
        $message = str_replace("{%%SOCIALURLTWIT%%}", $social_url['twitter_social_url'], $message);
        $message = str_replace("{%%SOCIALURLGPLUS%%}",$social_url['google_social_url'], $message);
        $message = str_replace("{%%YEAR%%}", date('Y'), $message);
        $message = str_replace("{%%CANCELLATION%%}", $CANCELLATION, $message);
        $message = str_replace("{%%AREA%%}", $AREA, $message);
        $message = str_replace("{%%CUSTOMER%%}", $CUSTOMER, $message);
		$message = str_replace("{%%WEB_URL%%}", WEB_FRONT_DIR, $message);
		
		$message = str_replace("{%%CL_HEAD%%}", $data['voucher_details']->cl_heading_line, $message);
		$message = str_replace("{%%PAYMENT%%}",  $data['voucher_details']->cl_payment, $message);
		$message = str_replace("{%%SERVICE%%}", $data['voucher_details']->cl_service, $message);
		
        //echo $message;die;
        $subject = $data['email_template']->subject;
        //$subject = str_replace("{%%NAME%%}", $data['user_data']->firstname.' '.$data['user_data']->lastname, $subject);

        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
            return 1;
        }else{
			
            return 0;
        }
    }




public function sendMail($fromname,$fromemail,$to_email,$mail_subject,$mail_content){

    	$mailHeader  = "From:".$fromname." <".$fromemail."> \n" ;
	    $mailHeader .= "X-Sender:". $fromemail." \n";
	    $mailHeader .= "Reply-To: ".$fromname." <".$fromemail."> \n";
	    $mailHeader .= "Content-Type: text/html; charset=iso-8859-1 \n";
	    $mailHeader .= "Return-Path:".$fromemail." \n";
	    $mailHeader .= "Error-To: ".$fromemail." \n";
	    $mailHeader .= "X-Mailer: ".$_SERVER['SERVER_NAME']." \n";
	    $mailHeader .= "MIME-Version: 1.0 \n";
	    
	    $mailresult  = mail($to_email,$mail_subject,$mail_content,$mailHeader);
	    return $mailresult;
    }





//for More Passangers
    public function sendmail_more_passangers($data) {
		
       
        $message= $data['message'];
		
		 $fromemailadd=$data['from'];
       $fromemailname=$data['from_name'];
       $data['email_access'] = $this->get_email_acess()->row();
     
		 $socials=$this->get_social_links();
          

        $order_mes=array("{%%FB%%}","{%%TW%%}","{%%GP%%}","{%%WEB_URL%%}","##WEB_NAME##");
        $replace_mes=array($socials->facebook,$socials->twitter,$socials->google,WEB_FRONT_DIR,WEB_NAME);
        $message=str_replace($order_mes, $replace_mes, $message);

        

        $to = 'info@reservationfactory.com';
       
        
        $subject = $data['subject'];
       
        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'charset' => 'iso-8859-1',
           'mailtype' => 'html',
            'wordwrap' => TRUE
        );
//print_r($config);
		
        $this->load->library('email', $config);
	$this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from($fromemailadd, $fromemailname);
        $this->email->to($to);
        $this->email->subject($subject);
        
         $this->email->message($message);

  $this->sendMail($fromemailname,$fromemailadd,$to,$subject,$message);
        if ($this->email->send()) {
            return 1;
//$this->email->print_debugger();
        }else{
            return 0;
        }
    }


    //for Flight Voucher
    public function sendmail_flightVoucher($data) {
		//print_r($data);die;
        $fromemailadd=$data['email_template']->email_from;
        $fromemailname=$data['email_template']->email_from_name;
       
        $template_message = $data['email_template']->message;
		
		
       
      
	
		 $socials=$this->get_social_links();
          

        $order_mes=array("{%%NAME%%}","{%%PNR%%}","{%%STATUS%%}",
        "{%%FLIGHTDETAILS%%}","{%%LEADPAX%%}","{%%EMAIL%%}","{%%MOBILE%%}","{%%TERMS%%}",
        "{%%FB%%}","{%%TW%%}","{%%GP%%}","{%%WEB_URL%%}","##WEB_NAME##");
        $replace_mes=array($data['Booking']->leadpax,$data['Booking']->pnr_no,
        $data['Booking']->booking_status,$data['message'],$data['Booking']->GUEST_FIRSTNAME.' '.$data['Booking']->GUEST_LASTNAME,
        $data['Booking']->BILLING_EMAIL,$data['Booking']->BILLING_PHONE,$data['voucher_details']->flight_cl_terms,
        $socials->facebook,$socials->twitter,$socials->google,WEB_FRONT_DIR,WEB_NAME);
        $message=str_replace($order_mes, $replace_mes, $template_message);

        $lang_order_mes=array("{%%Booking_Voucher%%}","{%%Hello%%}","{%%Booking_Voucher_Msg%%}",
            "{%%CONFIRMATION_NO%%}","{%%BOOKING_STATUS%%}","{%%LEAD_PAX%%}","{%%EMAIL_ID%%}","{%%MOBILE_NUM%%}","{%%TERMSCOND%%}",
            "{%%Customer_Details%%}","{%%Booking_Cancel%%}","{%%CANCEL_MSG%%}","{%%Cancellation_Details%%}");
        $lang_replace_mes=array(lang_line('Booking_Voucher'),lang_line('Hello'),lang_line('Booking_Voucher_Msg'),
            lang_line('CONF_NO'),lang_line('BOOKING_STATUS'),lang_line('LEAD_PX'),lang_line('EMAIL_ADD')
            ,lang_line('MOBILE_NO'),lang_line('TERMS_CON'),lang_line('Customer_Details'),lang_line('Booking_Cancel'),lang_line('CANCEL_MSG'),lang_line('Cancellation_Details'));
            $message=str_replace($lang_order_mes, $lang_replace_mes, $message);


        $to = $data['to'];
        
        $subject = $data['email_template']->subject;
       
        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'charset' => 'iso-8859-1',
           'mailtype' => 'html',
            'wordwrap' => TRUE
        );
//print_r($config);
		
        $this->load->library('email', $config);
	$this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        
         $this->email->message($message);

  $this->sendMail($fromemailname,$fromemailadd,$to,$subject,$message);
        if ($this->email->send()) {
            return 1;
//$this->email->print_debugger();
        }else{
            return 0;
        }
    }

    //for Flight Voucher
    public function sendmail_flightInvoice($data) {
        
        $template_message = $data['email_template']->message;
		
            $socials=$this->get_social_links();
          
        $order_mes=array("{%%NAME%%}","{%%PNR%%}","{%%STATUS%%}",
        "{%%FLIGHTINFO%%}","{%%LEADPAX%%}","{%%EMAIL%%}","{%%MOBILE%%}","{%%PAYDATE%%}",
        "{%%BASEFARE%%}","{%%TAX%%}","{%%TOTAL%%}",
        "{%%FB%%}","{%%TW%%}","{%%GP%%}","{%%WEB_URL%%}","##WEB_NAME##");
        $replace_mes=array(($data['Booking']->leadpax!='')?$data['Booking']->leadpax:$data['Booking']->BILLING_FIRSTNAME,$data['Booking']->pnr_no,
        $data['Booking']->booking_status,$data['Booking']->Origin.' To '.$data['Booking']->Destination,$data['Booking']->GUEST_FIRSTNAME.' '.$data['Booking']->GUEST_LASTNAME,
        $data['Booking']->BILLING_EMAIL,$data['Booking']->BILLING_PHONE,date('D, M d, Y', strtotime($data['Booking']->voucher_date)),
        $data['Booking']->BasePrice,$data['Booking']->TaxPrice,$data['Booking']->TotalPrice,
        $socials->facebook,$socials->twitter,$socials->google,WEB_FRONT_DIR,WEB_NAME);
        $message=str_replace($order_mes, $replace_mes, $template_message);

        $lang_order_mes=array("{%%INVOICE%%}","{%%Receive_Payment%%}","{%%Payment_Details%%}",
            "{%%CONFIRMATION_NO%%}","{%%BOOKING_STATUS%%}","{%%LEAD_PAX%%}","{%%EMAIL_ID%%}","{%%MOBILE_NUM%%}","{%%Tax%%}",
            "{%%Customer_Details%%}","{%%Flight_Info%%}","{%%Base_Fare%%}","{%%Total_Amount%%}");
        $lang_replace_mes=array(lang_line('INVOICE'),lang_line('Receive_Payment'),lang_line('Payment_Details'),
            lang_line('CONF_NO'),lang_line('BOOKING_STATUS'),lang_line('LEAD_PX'),lang_line('EMAIL_ADD')
            ,lang_line('MOBILE_NO'),lang_line('TAX_SUBCHARGE'),lang_line('Customer_Details'),lang_line('Flight_Info'),lang_line('Base_Fare'),lang_line('Total_Amount'));
            $message=str_replace($lang_order_mes, $lang_replace_mes, $message);

        $to = $data['to'];
      
        $subject = $data['email_template']->subject;
      
        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }

    //for Hotel Voucher
    public function sendmail_hotelVoucher($data) {

        
         $template_message = $data['message'];
         $to = $data['to'];
       
        
 		$socials=$this->get_social_links();
      
$order_mes=array("{%%CL_HEAD%%}","{%%PAYMENT%%}","{%%SERVICE%%}","{%%FB%%}","{%%TW%%}","{%%GP%%}","{%%Booking_Voucher%%}","{%%DEAR%%}","{%%Booking_Details%%}","{%%BOOKING_STATUS%%}","{%%CONFIRMATION_NO%%}","{%%HOTEL_DETAILS%%}",
"{%%No_OF_Nights%%}","{%%Room_Type%%}","{%%Guest%%}","{%%Guest_Name%%}","{%%Check_In%%}","{%%Check_Out%%}","{%%ADVISED_MSG%%}","{%%MAIL_THANKS_MSG%%}");
        $replace_mes=array($data['voucher_details']->cl_heading_line,$data['voucher_details']->cl_payment,$data['voucher_details']->cl_service,
        $socials->facebook,$socials->twitter,$socials->google,lang_line('Booking_Voucher'),lang_line('DEAR'),lang_line('Booking_Details'),lang_line('BOOKING_STATUS'),lang_line('CONF_NO'),
lang_line('HOTEL_DETAILS'),lang_line('NO_OF_NIGHTS'),lang_line('ROOM_TYPE'),lang_line('GUESTS'),lang_line('GUESTS').' '.lang_line('NAME'),lang_line('CHECKIN'),lang_line('CHECKOUT'),
lang_line('ADVISED_MSG'),lang_line('MAIL_THANKS_MSG'));
        $message=str_replace($order_mes, $replace_mes, $template_message);


        $subject = $data['email_template']->subject;
      
        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }




 //for Hotel Invoice
    public function sendmail_hotelInvoice($data) {

        
        $template_message = $data['email_template']->message;
        $to = $data['to'];


         $order_mes=array("{%%Hello%%}","{%%MAIL_THANKS_MSG%%}","{%%NAME%%}","{%%CL_HEAD%%}","{%%PAYMENT%%}",
        "{%%SERVICE%%}","{%%INVOICEDETAILS%%}","{%%INVOICE%%}","{%%FB%%}","{%%TW%%}","{%%GP%%}","{%%WEB_URL%%}","##WEB_NAME##");
        $replace_mes=array(lang_line('Hello'),lang_line('MAIL_THANKS_MSG'),($data['Booking']->leadpax!='')?$data['Booking']->leadpax:$data['Booking']->BILLING_FIRSTNAME,
            $data['voucher_details']->cl_heading_line,$data['voucher_details']->cl_payment,$data['voucher_details']->cl_service,$data['message'],
        lang_line('INVOICE'),$socials->facebook,$socials->twitter,$socials->google,WEB_FRONT_DIR,WEB_NAME);
        $message=str_replace($order_mes, $replace_mes, $template_message);

      
        $subject = $data['email_template']->subject;
       

        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }


     //for hotel cancel
    public function sendmail_hotelcancel($data) {
        //print_r($data);die;
        $fromemailadd=$data['email_template']->email_from;
        $fromemailname=$data['email_template']->email_from_name;
       
        $template_message = $data['email_template']->message;
        
    
         $socials=$this->get_social_links();
          

        $order_mes=array("{%%NAME%%}","{%%PNR%%}","{%%STATUS%%}","{%%FB%%}","{%%TW%%}","{%%GP%%}","{%%WEB_URL%%}","##WEB_NAME##");
        $replace_mes=array($data['Booking']->leadpax,$data['Booking']->pnr_no,$data['Booking']->booking_status,
        $socials->facebook,$socials->twitter,$socials->google,WEB_FRONT_DIR,WEB_NAME);
        $message=str_replace($order_mes, $replace_mes, $template_message);

        $lang_order_mes=array("{%%Hello%%}", "{%%CONFIRMATION_NO%%}","{%%BOOKING_STATUS%%}","{%%Booking_Cancel%%}","{%%CANCEL_MSG%%}","{%%Cancellation_Details%%}");
        $lang_replace_mes=array(lang_line('Hello'),lang_line('CONF_NO'),lang_line('BOOKING_STATUS'),lang_line('Booking_Cancel'),lang_line('CANCEL_MSG'),lang_line('Cancellation_Details'));
            $message=str_replace($lang_order_mes, $lang_replace_mes, $message);


        $to = $data['to'];
        
        $subject = $data['email_template']->subject;
       
        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'charset' => 'iso-8859-1',
           'mailtype' => 'html',
            'wordwrap' => TRUE
        );
//print_r($config);
        
        $this->load->library('email', $config);
    $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        
         $this->email->message($message);

  $this->sendMail($fromemailname,$fromemailadd,$to,$subject,$message);
        if ($this->email->send()) {
            return 1;
//$this->email->print_debugger();
        }else{
            return 0;
        }
    }


    //for Car Voucher
    public function sendmail_carVoucher($data) {
   
		$email_type = 'car_voucher';
		$data['email_template'] = $this->get_email_template($email_type)->row();
		$template_message =$data['email_template']->message;

		$to = $data['to'];

        $socials=$this->get_social_links();
        $order_mes=array("{%%NAME%%}","{%%PNR%%}","{%%STATUS%%}","{%%CARDETAILS%%}","{%%FB%%}","{%%TW%%}","{%%GP%%}","{%%WEB_URL%%}","##WEB_NAME##");
        $replace_mes=array($data['Booking']->leadpax,$data['Booking']->pnr_no,$data['Booking']->booking_status,
        $data['message'],$socials->facebook,$socials->twitter,$socials->google,WEB_FRONT_DIR,WEB_NAME);
        $message=str_replace($order_mes, $replace_mes, $template_message);

        $lang_order_mes=array("{%%Hello%%}", "{%%CONFIRMATION_NO%%}","{%%BOOKING_STATUS%%}","{%%Booking_Voucher%%}","{%%MAIL_THANKS_MSG%%}");
        $lang_replace_mes=array(lang_line('Hello'),lang_line('CONF_NO'),lang_line('BOOKING_STATUS'),lang_line('Booking_Voucher'),lang_line('MAIL_THANKS_MSG'));
        $message=str_replace($lang_order_mes, $lang_replace_mes, $message);

		
		
		
		 $subject = $data['email_template']->subject;
		


        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }

    //for Car Invoice
    public function sendmail_carInvoice($data) {
		$email_type = 'car_invoice';
		$data['email_template'] = $this->get_email_template($email_type)->row();
		 $template_message = $data['email_template']->message;
		$to = $data['to'];

        $socials=$this->get_social_links();
        $order_mes=array("{%%NAME%%}","{%%PNR%%}","{%%STATUS%%}","{%%INVOICEDETAILS%%}","{%%FB%%}","{%%TW%%}","{%%GP%%}","{%%WEB_URL%%}","##WEB_NAME##");
        $replace_mes=array($data['Booking']->leadpax,$data['Booking']->pnr_no,$data['Booking']->booking_status,
        $data['message'],$socials->facebook,$socials->twitter,$socials->google,WEB_FRONT_DIR,WEB_NAME);
        $message=str_replace($order_mes, $replace_mes, $template_message);
$lang_order_mes=array("{%%Hello%%}", "{%%CONFIRMATION_NO%%}","{%%BOOKING_STATUS%%}","{%%INVOICE%%}","{%%MAIL_THANKS_MSG%%}");
        $lang_replace_mes=array(lang_line('Hello'),lang_line('CONF_NO'),lang_line('BOOKING_STATUS'),lang_line('INVOICE'),lang_line('MAIL_THANKS_MSG'));
        $message=str_replace($lang_order_mes, $lang_replace_mes, $message);
		
		
		 $subject = $data['email_template']->subject;
		
  //echo "<pre>";
//print_r($data);die;
        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }


     //for hotel cancel
    public function sendmail_carcancel($data) {
        //print_r($data);die;
        $fromemailadd=$data['email_template']->email_from;
        $fromemailname=$data['email_template']->email_from_name;
       
        $template_message = $data['email_template']->message;
        
    
         $socials=$this->get_social_links();
          

        $order_mes=array("{%%NAME%%}","{%%PNR%%}","{%%STATUS%%}","{%%FB%%}","{%%TW%%}","{%%GP%%}","{%%WEB_URL%%}","##WEB_NAME##");
        $replace_mes=array($data['Booking']->leadpax,$data['Booking']->pnr_no,$data['Booking']->booking_status,
        $socials->facebook,$socials->twitter,$socials->google,WEB_FRONT_DIR,WEB_NAME);
        $message=str_replace($order_mes, $replace_mes, $template_message);

        $lang_order_mes=array("{%%Hello%%}", "{%%CONFIRMATION_NO%%}","{%%BOOKING_STATUS%%}","{%%Booking_Cancel%%}","{%%CANCEL_MSG%%}","{%%Cancellation_Details%%}");
        $lang_replace_mes=array(lang_line('Hello'),lang_line('CONF_NO'),lang_line('BOOKING_STATUS'),lang_line('Booking_Cancel'),lang_line('CANCEL_MSG'),lang_line('Cancellation_Details'));
            $message=str_replace($lang_order_mes, $lang_replace_mes, $message);


        $to = $data['to'];
        
        $subject = $data['email_template']->subject;
       
        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'charset' => 'iso-8859-1',
           'mailtype' => 'html',
            'wordwrap' => TRUE
        );
//print_r($config);
        
        $this->load->library('email', $config);
    $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        
         $this->email->message($message);

  $this->sendMail($fromemailname,$fromemailadd,$to,$subject,$message);
        if ($this->email->send()) {
            return 1;
//$this->email->print_debugger();
        }else{
            return 0;
        }
    }

    //for Apartment Non-Instant Voucher
    public function sendmail_apartmentNonInstantVoucher($data) {
        $Booking = $data['Booking'];
        $social_url = $data['social_url'];
        $message = $data['email_template']->message;
        $to = $data['email'];
        
        if(isset($data['host_data']->profile_photo)) {
            $profile_photo = $data['host_data']->profile_photo;
            $user_id = $data['host_data']->user_id;
            $user_type = '3';
            $contact_no = $data['host_data']->contact_no;
        } else if(isset($data['host_data']->agent_logo)) {
            $profile_photo = $data['host_data']->agent_logo;
            $user_id = $data['host_data']->agent_id;
            $user_type = '2';
            $contact_no = $data['host_data']->mobile;
        } else {
            $profile_photo = ASSETS.'images/user-avatar.jpg';
        }

        $apt_link = WEB_URL.'/apartment/rooms/'.$data['Booking']->PROP_ID;
        $host_profile_link = WEB_URL.'/users/show/'.$user_type.'/'.$user_id;
        $guests = $Booking->RES_N_ADULTS+$Booking->RES_N_CHILDREN+$Booking->RES_N_BABIES;
        $RentData = json_decode($Booking->RENT_DATA);

        $message = str_replace("{%%NAME%%}", $data['Booking']->RES_GUEST_FIRSTNAME, $message);
        $message = str_replace("{%%HOST_NAME%%}", $data['host_data']->firstname, $message);
        $message = str_replace("{%%STATUS%%}", $data['Booking']->booking_status, $message);
        //$message = str_replace("{%%PNR%%}", $data['Booking']->pnr_no, $message);
        //$message = str_replace("{%%MAP%%}", $data['Map'], $message);
        //$message = str_replace("{%%APT_LINK%%}", $apt_link, $message);
        $message = str_replace("{%%APARTMENT%%}", $data['Booking']->PROP_NAME.', '.$data['Booking']->PROP_CITY.' and '.$data['Booking']->PROP_COUNTRY_NAME, $message);
        $message = str_replace("{%%APT_TYPE%%}", $data['Booking']->PROP_TYPE_LABEL, $message);
        $message = str_replace("{%%GUEST%%}", $guests, $message);
        $message = str_replace("{%%CHECKIN_DAY%%}", date('D, M', strtotime($Booking->RES_CHECK_IN)), $message);
        $message = str_replace("{%%CHECKIN_DATE%%}", date('d', strtotime($Booking->RES_CHECK_IN)), $message);
        $message = str_replace("{%%CHECKOUT_DAY%%}", date('D, M', strtotime($Booking->RES_CHECK_OUT)), $message);
        $message = str_replace("{%%CHECKOUT_DATE%%}", date('d', strtotime($Booking->RES_CHECK_OUT)), $message);
        //$message = str_replace("{%%HOST_IMAGE%%}", $profile_photo, $message);
        //$message = str_replace("{%%HOST_LINK%%}", $host_profile_link, $message);
       // $message = str_replace("{%%HOST_NAME%%}", $data['host_data']->firstname.' '.$data['host_data']->lastname, $message);
        //$message = str_replace("{%%HOST_PHONE%%}", $data['host_data']->contact_no, $message);
        //$message = str_replace("{%%RENT_SUBTOTAL%%}", CURR_ICON.$RentData->RentSubtotal, $message);
        //$message = str_replace("{%%RENT_PER%%}", CURR_ICON.$RentData->price_per, $message);
        //$message = str_replace("{%%SERVICE_TAX%%}", CURR_ICON.'0', $message);
        $message = str_replace("{%%TOTAL%%}", CURR_ICON.$data['Booking']->amount, $message);
        $message = str_replace("{%%SOCIALURLFACE%%}", $social_url['facebook_social_url'], $message);
        $message = str_replace("{%%SOCIALURLTWIT%%}", $social_url['twitter_social_url'], $message);
        $message = str_replace("{%%SOCIALURLGPLUS%%}",$social_url['google_social_url'], $message);
        $message = str_replace("{%%YEAR%%}", date('Y'), $message);
		$message = str_replace("{%%WEB_URL%%}", WEB_FRONT_DIR, $message);
        //echo $message;die;
        $subject = $data['email_template']->subject;
        $subject = str_replace("{%%APARTMENT%%}", $data['Booking']->PROP_NAME.', '.$data['Booking']->PROP_CITY.' and '.$data['Booking']->PROP_COUNTRY_NAME, $subject);

        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }

    //for Apartment Invoice
    public function sendmail_apartmentInvoice($data) {
        $Booking = $data['Booking'];
        $social_url = $data['social_url'];
        $message = $data['email_template']->message;
        if(isset($data['host_data']->profile_photo)) {
            $profile_photo = $data['host_data']->profile_photo;
            $user_id = $data['host_data']->user_id;
            $user_type = '3';
            $contact_no = $data['host_data']->contact_no;
            $to = $data['host_data']->email;
        } else if(isset($data['host_data']->agent_logo)) {
            $profile_photo = $data['host_data']->agent_logo;
            $user_id = $data['host_data']->agent_id;
            $user_type = '2';
            $contact_no = $data['host_data']->mobile;
            $to = $data['host_data']->email_id;
        } else {
            $profile_photo = ASSETS.'images/user-avatar.jpg';
        }
        
        
        $RentData = json_decode($Booking->RENT_DATA);

        $message = str_replace("{%%NAME%%}", $data['Booking']->RES_GUEST_FIRSTNAME.' '.$data['Booking']->RES_GUEST_LASTNAME, $message);
        $message = str_replace("{%%STATUS%%}", $data['Booking']->booking_status, $message);
        $message = str_replace("{%%PNR%%}", $data['Booking']->pnr_no, $message);
        $message = str_replace("{%%PROP_NAME%%}", $data['Booking']->PROP_NAME, $message);
        $message = str_replace("{%%CITY_STATE%%}", $data['Booking']->PROP_CITY.', '.$data['Booking']->PROP_REGION, $message);
        $message = str_replace("{%%COUNTRY%%}", $data['Booking']->PROP_COUNTRY_NAME, $message);
        $message = str_replace("{%%ADDRESS1%%}", $data['Booking']->PROP_ADDR1, $message);
        $message = str_replace("{%%ADDRESS2%%}", $data['Booking']->PROP_ADDR2, $message);

        $message = str_replace("{%%APT_TYPE%%}", $data['Booking']->PROP_TYPE_LABEL, $message);
        $message = str_replace("{%%NIGHTS%%}", $data['Booking']->NIGHTS, $message);
        $message = str_replace("{%%CHECKIN%%}", date('D, d M Y', strtotime($Booking->RES_CHECK_IN)), $message);
        $message = str_replace("{%%CHECKIN_TIME%%}", $Booking->PROP_CIN_TIME, $message);
        $message = str_replace("{%%CHECKOUT%%}", date('D, d M Y', strtotime($Booking->RES_CHECK_OUT)), $message);
        $message = str_replace("{%%CHECKOUT_TIME%%}", $Booking->PROP_COUT_TIME, $message);
        $message = str_replace("{%%PAYMENT_DATE%%}", date('D, M d, Y', strtotime($Booking->voucher_date)), $message);
        $message = str_replace("{%%INVOICE%%}", 'XXXXXXXXXX', $message);
        $message = str_replace("{%%INVOICE_DATE%%}", date('D, M d, Y', strtotime($Booking->voucher_date)), $message);
        $message = str_replace("{%%RENT_SUBTOTAL%%}", CURR_ICON.$data['Booking']->amount, $message);
        //$message = str_replace("{%%RENT_PER%%}", CURR_ICON.$RentData->price_per, $message);
        //$message = str_replace("{%%SERVICE_TAX%%}", CURR_ICON.'0', $message);
        $message = str_replace("{%%TOTAL%%}", CURR_ICON.$data['Booking']->amount, $message);
        $message = str_replace("{%%SOCIALURLFACE%%}", $social_url['facebook_social_url'], $message);
        $message = str_replace("{%%SOCIALURLTWIT%%}", $social_url['twitter_social_url'], $message);
        $message = str_replace("{%%SOCIALURLGPLUS%%}",$social_url['google_social_url'], $message);
        $message = str_replace("{%%YEAR%%}", date('Y'), $message);
        $message = str_replace("{%%WEB_URL%%}", WEB_FRONT_DIR, $message);

        
        //echo $message;die;
        $subject = $data['email_template']->subject;
        //$subject = str_replace("{%%NAME%%}", $data['user_data']->firstname.' '.$data['user_data']->lastname, $subject);

        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }

    //for Apartment User Invoice
    public function sendmail_apartmentUserInvoice($data) {
        $Booking = $data['Booking'];
        $social_url = $data['social_url'];
        $message = $data['email_template']->message;
        $to = $data['email'];
        
        
        
        $RentData = json_decode($Booking->RENT_DATA);

        $message = str_replace("{%%NAME%%}", $data['Booking']->RES_GUEST_FIRSTNAME.' '.$data['Booking']->RES_GUEST_LASTNAME, $message);
        $message = str_replace("{%%STATUS%%}", $data['Booking']->booking_status, $message);
        $message = str_replace("{%%PNR%%}", $data['Booking']->pnr_no, $message);
        $message = str_replace("{%%PROP_NAME%%}", $data['Booking']->PROP_NAME, $message);
        $message = str_replace("{%%CITY_STATE%%}", $data['Booking']->PROP_CITY.', '.$data['Booking']->PROP_REGION, $message);
        $message = str_replace("{%%COUNTRY%%}", $data['Booking']->PROP_COUNTRY_NAME, $message);
        $message = str_replace("{%%ADDRESS1%%}", $data['Booking']->PROP_ADDR1, $message);
        $message = str_replace("{%%ADDRESS2%%}", $data['Booking']->PROP_ADDR2, $message);

        $message = str_replace("{%%APT_TYPE%%}", $data['Booking']->PROP_TYPE_LABEL, $message);
        $message = str_replace("{%%NIGHTS%%}", $data['Booking']->NIGHTS, $message);
        $message = str_replace("{%%CHECKIN%%}", date('D, d M Y', strtotime($Booking->RES_CHECK_IN)), $message);
        $message = str_replace("{%%CHECKIN_TIME%%}", $Booking->PROP_CIN_TIME, $message);
        $message = str_replace("{%%CHECKOUT%%}", date('D, d M Y', strtotime($Booking->RES_CHECK_OUT)), $message);
        $message = str_replace("{%%CHECKOUT_TIME%%}", $Booking->PROP_COUT_TIME, $message);
        $message = str_replace("{%%PAYMENT_DATE%%}", date('D, M d, Y', strtotime($Booking->voucher_date)), $message);
      //  $message = str_replace("{%%INVOICE%%}", 'XXXXXXXXXX', $message);
        $message = str_replace("{%%INVOICE_DATE%%}", date('D, M d, Y', strtotime($Booking->voucher_date)), $message);
        $message = str_replace("{%%RENT_SUBTOTAL%%}", CURR_ICON.$data['Transaction']->net_rate, $message);
        //$message = str_replace("{%%RENT_PER%%}", CURR_ICON.$RentData->price_per, $message);
        $message = str_replace("{%%SERVICE_TAX%%}", CURR_ICON.$data['Transaction']->apt_charge, $message);
        $message = str_replace("{%%TOTAL%%}", CURR_ICON.$data['Transaction']->booking_amount, $message);
        $message = str_replace("{%%SOCIALURLFACE%%}", $social_url['facebook_social_url'], $message);
        $message = str_replace("{%%SOCIALURLTWIT%%}", $social_url['twitter_social_url'], $message);
        $message = str_replace("{%%SOCIALURLGPLUS%%}",$social_url['google_social_url'], $message);
        $message = str_replace("{%%YEAR%%}", date('Y'), $message);
         $message = str_replace("{%%WEB_URL%%}", WEB_FRONT_DIR, $message);

        
        //echo $message;die;
        $subject = $data['email_template']->subject;
        //$subject = str_replace("{%%NAME%%}", $data['user_data']->firstname.' '.$data['user_data']->lastname, $subject);

        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }
    
    
      public function send_email_review_user($data_user) {
        $message1 = $data_user['email_template']->message;
        $to = $data_user['user_email'];
        
        if(isset($data_user['host_data']->profile_photo) && $data_user['host_data']->profile_photo != "") {
            $host_photo = $data_user['host_data']->profile_photo;
        } else if(isset($data_user['host_data']->agent_logo) && $data_user['host_data']->agent_logo != "") {
            $host_photo = $data_user['host_data']->agent_logo;
        } else {
            $host_photo = WEB_FRONT_DIR.'images/user-avatar.jpg';
        }

        $message1 = str_replace("{%%NAME%%}", $data_user['user_data']->firstname.' '.$data_user['user_data']->lastname, $message1);
        $message1 = str_replace("{%%REVIEWLINK%%}", $data_user['review_link_user'], $message1);

        $message1 = str_replace("{%%HOSTIMAGE%%}", $host_photo, $message1);
        $message1 = str_replace("{%%HOSTNAME%%}", $data_user['host_data']->firstname.' '.$data_user['host_data']->lastname, $message1);
        $message1 = str_replace("{%%PROPNAME%%}", $data_user['PROPNAME'], $message1);
        $message1 = str_replace("{%%PROPCITY%%}", $data_user['PROPCITY'], $message1);
        $message1 = str_replace("{%%PROPIMAGE%%}", $data_user['PROPIMAGE'], $message1);
        $message1 = str_replace("{%%REVIEWSTOPLINK%%}", $data_user['REVIEWSTOPLINK'], $message1);
        $message1 = str_replace("{%%WEB_URL%%}", WEB_FRONT_DIR, $message1);
        // $message1 = str_replace("{%%SOCIALURLFACE%%}", $facebook_social_url->social_url, $message1);
        // $message1 = str_replace("{%%SOCIALURLTWIT%%}", $twitter_social_url->social_url, $message1);
        // $message1 = str_replace("{%%SOCIALURLGPLUS%%}",$google_social_url->social_url, $message1);
        
        $subject = $data_user['email_template']->subject;
        $subject = str_replace("{%%NAME%%}", $data_user['user_data']->firstname.' '.$data_user['user_data']->lastname, $subject);

        $config = Array(
            'protocol' => $data_user['email_access']->smtp,
            'smtp_host' => $data_user['email_access']->host,
            'smtp_port' => $data_user['email_access']->port,
            'smtp_user' => $data_user['email_access']->username,
            'smtp_pass' => $data_user['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data_user['email_template']->email_from, $data_user['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message1);
      
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }
    
    
     public function send_email_review_host($data_user) {
        $message1 = $data_user['email_template']->message;
        $to = $data_user['host_email'];
        
        if(isset($data_user['user_data']->profile_photo) && $data_user['user_data']->profile_photo != "") {
            $profile_photo = $data_user['user_data']->profile_photo;
        } else if(isset($data_user['user_data']->agent_logo) && $data_user['user_data']->agent_logo != "") {
            $profile_photo = $data_user['user_data']->agent_logo;
        } else {
            $profile_photo = WEB_FRONT_DIR.'images/user-avatar.jpg';
        }

        $message1 = str_replace("{%%HOSTNAME%%}", $data_user['user_data']->firstname.' '.$data_user['user_data']->lastname, $message1);
        $message1 = str_replace("{%%REVIEWLINK%%}", $data_user['review_link_host'], $message1);
        $message1 = str_replace("{%%USERIMAGE%%}", $profile_photo, $message1);
        
        $message1 = str_replace("{%%USERNAME%%}", $data_user['host_data']->firstname.' '.$data_user['host_data']->lastname, $message1);
        $message1 = str_replace("{%%REVIEWSTOPLINK%%}", $data_user['REVIEWSTOPLINK'], $message1);
        $message1 = str_replace("{%%WEB_URL%%}", WEB_FRONT_DIR, $message1);
        $subject = $data_user['email_template']->subject;
        $subject = str_replace("{%%NAME%%}", $data_user['user_data']->firstname.' '.$data_user['user_data']->lastname, $subject);

        $config = Array(
            'protocol' => $data_user['email_access']->smtp,
            'smtp_host' => $data_user['email_access']->host,
            'smtp_port' => $data_user['email_access']->port,
            'smtp_user' => $data_user['email_access']->username,
            'smtp_pass' => $data_user['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data_user['email_template']->email_from, $data_user['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message1);
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }
    
    
 public function send_email_review_guest($data_user) {
        $message1 = $data_user['email_template']->message;
        $to = $data_user['host_email'];
        
        if(isset($data_user['user_data']->profile_photo) && $data_user['user_data']->profile_photo != "") {
            $profile_photo = $data_user['user_data']->profile_photo;
        } else if(isset($data_user['user_data']->agent_logo) && $data_user['user_data']->agent_logo != "") {
            $profile_photo = $data_user['user_data']->agent_logo;
        } else {
            $profile_photo = WEB_FRONT_DIR.'images/user-avatar.jpg';
        }

        $message1 = str_replace("{%%USERNAME%%}", $data_user['user_data']->firstname.' '.$data_user['user_data']->lastname, $message1);
        $message1 = str_replace("{%%REVIEWLINK%%}", $data_user['review_link_host'], $message1);
        $message1 = str_replace("{%%USERIMAGE%%}", $profile_photo, $message1);
        
        $message1 = str_replace("{%%HOSTNAME%%}", $data_user['host_data']->firstname.' '.$data_user['host_data']->lastname, $message1);
        $message1 = str_replace("{%%REVIEWSTOPLINK%%}", $data_user['REVIEWSTOPLINK'], $message1);
       
        $subject = $data_user['email_template']->subject;
        $subject = str_replace("{%%NAME%%}", $data_user['user_data']->firstname.' '.$data_user['user_data']->lastname, $subject);
$message1 = str_replace("{%%WEB_URL%%}", WEB_FRONT_DIR, $message1);
        $config = Array(
            'protocol' => $data_user['email_access']->smtp,
            'smtp_host' => $data_user['email_access']->host,
            'smtp_port' => $data_user['email_access']->port,
            'smtp_user' => $data_user['email_access']->username,
            'smtp_pass' => $data_user['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data_user['email_template']->email_from, $data_user['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message1);
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }
    
    
    public function twoStepVerifyEmail_send($data) {
        $randomNumber = $data['twoStepRandomNumber'];
        $userFirstName = $data['user_data']->firstname;

        $message1 = $data['email_template']->message;
        $delimiters = $data['email_template']->to_email;
        $email_to = explode(";", $delimiters);
        $email_to_1 = $email_to[0];
        $email_to_2 = $email_to[1];

        $message1 = str_replace("{%%FIRSTNAME%%}", $userFirstName, $message1);
        $message1 = str_replace("{%%VERIFICATION_CODE%%}", $randomNumber, $message1);
       $message1 = str_replace("{%%WEB_URL%%}", WEB_FRONT_DIR, $message1);
        // $message1 = str_replace("{%%SOCIALURLFACE%%}", $facebook_social_url->social_url, $message1);
        // $message1 = str_replace("{%%SOCIALURLTWIT%%}", $twitter_social_url->social_url, $message1);
        // $message1 = str_replace("{%%SOCIALURLGPLUS%%}",$google_social_url->social_url, $message1);
        
        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($data['to']);
        $this->email->subject($data['email_template']->subject);
        $this->email->message($message1);

        if ($this->email->send()) {
            return true;
        }else{
            return false;
        }
    }


    //Agent starts here

    public function sendmail_agentreg($data) {
        $message = $data['email_template']->message;
        $social_url = $data['social_url'];
        $delimiters = $data['email_template']->to_email;
        $email_to = explode(";", $delimiters);
        $email_to_1 = $email_to[0];
        $email_to_2 = $email_to[1];
        if($data['user_data']->agent_logo == ''){
            $agent_logo =  WEB_FRONT_DIR.'assets/images/user-avatar.jpg';
        }else{
            $agent_logo = $data['user_data']->agent_logo;
        }
        $message = str_replace("{%%FIRSTNAME%%}", $data['user_data']->firstname, $message);
        $message = str_replace("{%%USERIMAGE%%}", $agent_logo, $message);
        
        
        $message = str_replace("{%%SOCIALURLFACE%%}", $social_url['facebook_social_url'], $message);
        $message = str_replace("{%%SOCIALURLTWIT%%}", $social_url['twitter_social_url'], $message);
        $message = str_replace("{%%SOCIALURLGPLUS%%}",$social_url['google_social_url'], $message);
        $message = str_replace("{%%WEB_URL%%}", WEB_FRONT_DIR, $message);
        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($data['user_data']->email_id);
        $this->email->subject($data['email_template']->subject);
        $this->email->message($message);
        $this->email->send();
    }

//Sends the email verification when agent signs up 
    public function sendmail_agentVerification($data) {
        $message = $data['email_template']->message;
        $delimiters = $data['email_template']->to_email;
        $email_to = explode(";", $delimiters);
        $email_to_1 = $email_to[0];
        $email_to_2 = $email_to[1];
        if($data['user_data']->agent_logo == ''){
            $agent_logo =  WEB_FRONT_DIR.'assets/images/user-avatar.jpg';
        }else{
            $agent_logo = $data['user_data']->agent_logo;
        }
        $message = str_replace("{%%FIRSTNAME%%}", $data['user_data']->firstname, $message);
        $message = str_replace("{%%VERIFICATION_CODE%%}", $data['random_code'], $message);
         $message = str_replace("{%%WEB_URL%%}", WEB_FRONT_DIR, $message);
        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($data['user_data']->email_id);
        $this->email->subject($data['email_template']->subject);
        $this->email->message($message);
        $this->email->send();
    }

    public function send_contactus_mail_v1($data,$input){
        $contactdata = $input['message'];
        $message = $data['email_template']->message;
        $delimiters = $data['email_template']->to_email;
        $email_to = explode(";", $delimiters);
        $email_to_1 = $email_to[0];
       // $to_email  = array($input['email'], $data['email_template']->email_from); 
        $message = str_replace("{%%FIRSTNAME%%}", $input['name'], $message);
        $message = str_replace("{%%MESSAGE%%}", $contactdata, $message);
         
		  $message = str_replace("{%%WEB_URL%%}", WEB_FRONT_DIR, $message);


        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($input['email'], $input['name']);
        $this->email->to($email_to_1);
        $this->email->subject($input['subject']);
        $this->email->message($message);
        if(!$this->email->send()){
            return false;
        }else{
            return true;
        }
    }

     public function send_feedback_mail($data,$input){
        $contactdata = $input['message'];
        $type = $input['type'];
        $message = $data['email_template']->message;
        $delimiters = $data['email_template']->to_email;
        $subject = $data['email_template']->subject;
        $email_to = explode(";", $delimiters);
        $email_to_1 = $email_to[0];
       // $to_email  = array($input['email'], $data['email_template']->email_from); 
        $message = str_replace("{%%FIRSTNAME%%}", $input['name'], $message);
        $message = str_replace("{%%MESSAGE%%}", $contactdata, $message);
        $message = str_replace("{%%TYPE%%}", $type, $message);
           $message = str_replace("{%%WEB_URL%%}", WEB_FRONT_DIR, $message);
          $message = str_replace("{%%YEAR%%}", date('Y'), $message);
        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($input['email'], $input['name']);
        $this->email->to($email_to_1);
        $this->email->subject($subject);
        $this->email->message($message);
        if(!$this->email->send()){
            return false;
        }else{
            return true;
        }
    }

}