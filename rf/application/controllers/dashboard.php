<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct(){
        parent::__construct();
        
        $this->load->model('Auth_Model');
        $this->load->model('account_model');
        $this->load->model('reference_model');
        $this->load->model('email_model');
        $this->load->model('verification_model');
        $this->load->model('Listings_Model');
        $this->load->model('Help_Model');
        $this->load->model('Wishlist_Model');
        $this->load->model('Message_Model');
        $this->load->model('booking_model');
        $this->load->model('apartment_model');
        $this->load->model('Support_Model');
        $this->load->model('Reviews_Model');

        $this->helpMenuLink = $this->Help_Model->fetchHelpLinks();
        
        $current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
        $current_url = $this->config->site_url().$this->uri->uri_string(). $current_url;

        $url =  array(
            'continue' => $current_url,
        );
        $this->session->set_userdata($url);
        $this->islogged_in();
    
    $this->domain_id = '1';
    }

    public function index($page_type = '',$sub_type = ''){
		
        //UserInfo
        $data['b2c_id'] = $b2c_id = $this->session->userdata('b2c_id');
        if($this->session->userdata('b2c_id')){
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        }

        $data['userInfo'] = $this->account_model->GetUserData($user_type, $user_id)->row();
        $data['userEmergency'] = $this->account_model->getUserEmergency($user_type,$b2c_id)->row();
        if(isset($_POST['email_v'])){
            $data['email_v'] = $_POST['email_v'];
        }
        if(isset($_POST['err_v'])){
            $data['err_v'] = $_POST['err_v'];
        }
        if(isset($_POST['d_msg'])){
            $data['d_msg'] = $_POST['d_msg'];
        }
        $data['page_type'] = $page_type;
        $data['sub_type'] = $sub_type;

        if($this->session->userdata('b2c_id')){
            if($data['userInfo']->profile_photo == ''){
                $data['profile_photo'] = ASSETS.'images/user-avatar.jpg';
            }else{
                $data['profile_photo'] = $data['userInfo']->profile_photo;
            }
            $data['email'] = $data['userInfo']->email;
            $data['contact_no'] = $data['userInfo']->contact_no;
        }else if($this->session->userdata('b2b_id')){	
            if($data['userInfo']->agent_logo == ''){
                $data['profile_photo'] = ASSETS.'images/user-avatar.jpg';
            }else{
                $data['profile_photo'] = $data['userInfo']->agent_logo;
            }
            $data['email'] = $data['userInfo']->email_id;
            $data['contact_no'] = $data['userInfo']->mobile;
        }

        $data['get_user_listings'] = $this->Listings_Model->get_user_listings($user_id,$user_type);
        $data['get_user_listings_count'] = count($data['get_user_listings']);
        
        $hostReviewCount = $this->Reviews_Model->get_reviews_about_you($user_id, $user_type)->num_rows();
        $guestReviewCount = $this->Reviews_Model->get_reviews_about_you_guest($user_id, $user_type)->num_rows(); 
        $data['hostReviewsCount'] = $hostReviewCount+$guestReviewCount;

        $data['referencesByYou'] = $referencesByYou = $this->reference_model->get_references_by_you($data['email'], $user_type)->result();
       // print_r($data['referencesByYou']); die();
        $data['referencesAboutYou'] = $this->reference_model->get_references_about_you($user_id, $user_type)->result();
        $data['referencesAboutYouPending'] = $this->reference_model->get_references_about_you_pending($user_id, $user_type)->result();
        $data['PendingCount'] = $this->reference_model->get_references_about_you_pending($user_id, $user_type)->num_rows(); 

        $data['countryCode'] = $this->reference_model->getCountryCode();
        //$data['countries'] = $this->apartment_model->getAllKigoCountries()->result();
        $data['countries'] = $this->account_model->getAllCountries()->result();
        //echo '<pre>';print_r($data['countries']); die();
        $user_type_string = (string)$user_type;
        $data['twoStepVerified'] = $this->verification_model->getTwoStepVeriStatus($user_id, $user_type_string);
        
        $data['getAllWishlist'] = $this->Wishlist_Model->getAllWishlist($user_id, $user_type)->result();

        $data['getWishlistCount'] = $this->Wishlist_Model->getAllWishlist($user_id, $user_type)->num_rows();

        $data['getSMSalertList'] = $this->verification_model->getSMSalertList($user_id, $user_type); //get list of all the list available in sms_alert table
        $data['getSMSalertData'] = $this->verification_model->getSMSalertData($user_id, $user_type); //get joined table between sms_alert and sms_alert_enabled.
        
        $data['getInboxMessages'] = $this->Message_Model->getMessage($user_id, 1)->result(); //get inbox message and all other info.
        $getNewsletterStatus = $this->account_model->getNewsletterStatus($user_id,$user_type)->row();

        $data['bank_details'] = $this->account_model->getBankDetails($user_id,$user_type)->row();
        $data['currentVerifications'] = $this->account_model->checkVerifications($user_id, $user_type)->row();


        /*Transaction Page*/

        $data['upcoming_transaction'] = $this->account_model->getUpComingTransaction($user_id, $user_type)->result();
        $data['completed_transaction'] = $this->account_model->getCompletedTransaction($user_id, $user_type)->result();
        $data['current_transaction'] = $this->account_model->getCurrentTransaction($user_id, $user_type)->result();
        $data['failed_transaction'] = $this->account_model->getFailedTransaction($user_id, $user_type)->result();

        /*Transaction Page*/


//review about you
        $reviewsAboutYouPendingHost = $this->Reviews_Model->reviewsAboutYouPendingHost($b2c_id, $user_type);
        $reviewsAboutYouPendingHostResult = $reviewsAboutYouPendingHost->result();
        $reviewsAboutYouPendingHostCount = $reviewsAboutYouPendingHost->num_rows();

        $reviewsAboutYouPendingGuest = $this->Reviews_Model->reviewsAboutYouPendingGuest($b2c_id, $user_type);
        $reviewsAboutYouPendingGuestResult = $reviewsAboutYouPendingGuest->result();
        $reviewsAboutYouPendingGuestCount = $reviewsAboutYouPendingGuest->num_rows();

        $reviewsAboutYouPending = array_merge($reviewsAboutYouPendingHostResult, $reviewsAboutYouPendingGuestResult);
        $data['reviewsAboutYouPending'] = $reviewsAboutYouPending;
        $data['reviewsAboutYouPendingCount'] = $reviewsAboutYouPendingHostCount + $reviewsAboutYouPendingGuestCount;


        $reviewsAboutYouAcceptedHost = $this->Reviews_Model->reviewsAboutYouAcceptedHost($b2c_id, $user_type);
        $reviewsAboutYouAcceptedHostResult = $reviewsAboutYouAcceptedHost->result();
        $reviewsAboutYouAcceptedHostCount = $reviewsAboutYouAcceptedHost->num_rows();

        $reviewsAboutYouAcceptedGuest = $this->Reviews_Model->reviewsAboutYouAcceptedGuest($b2c_id, $user_type);
        $reviewsAboutYouAcceptedGuestResult = $reviewsAboutYouAcceptedGuest->result();
        $reviewsAboutYouAcceptedGuestCount = $reviewsAboutYouAcceptedGuest->num_rows();        

        $reviewsAboutYouAccepted = array_merge($reviewsAboutYouAcceptedHostResult, $reviewsAboutYouAcceptedGuestResult);
        $data['reviewsAboutYouAccepted'] = $reviewsAboutYouAccepted;

        //print_r($reviewsAboutYouAccepted); die();

        $reviewsAboutPropPending = $this->Reviews_Model->reviewsAboutPropPending($b2c_id, $user_type);
        $data['reviewsAboutPropPending'] = $reviewsAboutPropPending->result();
        $data['reviewsAboutPropPendingCount'] = $reviewsAboutPropPending->num_rows();

        $reviewsAboutPropAccepted = $this->Reviews_Model->reviewsAboutPropAccepted($b2c_id, $user_type);
        $data['reviewsAboutPropAccepted'] = $reviewsAboutPropAccepted->result();

        $data['getNewsletterStatus'] = $getNewsletterStatus->newsletter_subscribe;
        $data['ApartmentBookings'] = $ApartmentBookings = $this->booking_model->getoverallBookings($user_id, $user_type)->result();
		
        $data['ApartmentBookingsCount'] = $this->booking_model->getoverallBookings($user_id, $user_type)->num_rows();

        $data['HostBookings'] = $HostBookings = $this->booking_model->gethostBookings($user_id, $user_type)->result();
        $data['pnr_nos'] = $this->booking_model->getBookingsByUser($user_id, $user_type)->result();
        //echo '<pre>';print_r($data['pnr_nos']); die();

        if ($this->session->userdata('b2b_id') != '') {
            $data['depost_table_data'] = $this->getDepositDetails();
        }

        if ($user_type == 2)  {
            $data['current_agent_markup'] = $data['userInfo']->markup;
        }



        $this->load->view('dashboard/index',$data); 
    }

    public function islogged_in(){
        if (!$this->session->userdata('b2c_id') && !$this->session->userdata('b2b_id')) {
            redirect(WEB_URL);
        }
    }



    public function updateProfile(){
        if($this->session->userdata('b2c_id')){
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        }

        $userInfo = $this->account_model->GetUserData($user_type, $user_id)->row();
        
        if(isset($userInfo->email) && $userInfo->email != "") {
            $email = $userInfo->email;     
        } else if(isset($userInfo->email_id) && $userInfo->email_id != "") {
            $email = $userInfo->email_id;     
        }
        
        
       

        if($user_type == 3) {
			
			if($this->input->post('Required')==1){
				 $dob = $this->input->post('dob');
        $dob = explode('/',$dob);
        $dob = $dob[2].'-'.$dob[1].'-'.$dob[0];

        $about = strip_tags($this->input->post('about')); //remove slashes
        $about = $this->security->xss_clean($about); //remove xss
            $update = array(
                'firstname' => $this->input->post('fname'),
               // 'middlename' => $this->input->post('mname'),
                'lastname' => $this->input->post('lname'),
                'email' => $this->input->post('email'),
                'gender' => $this->input->post('gender'),
                'dob' => $dob,
                'city' => $this->input->post('city'),
                'country' => $this->input->post('country'),
                'postal_code' => $this->input->post('zip'),
                'address' => $this->input->post('Address'),
                 "country_code"=>$this->input->post('country_code'),
                "contact_no"=>$this->input->post('mobile'),
                'about' => $about
                );
          }
          if($this->input->post('Optional')==1){
                $update = array(
                'school' => $this->input->post('school'),
                'work' => $this->input->post('work'),
                'zone' => $this->input->post('zone'),
                'languages' => $this->input->post('languages')
                 );
			 }
                 if($this->input->post('Billing')==1){
                 $update = array(
                'billing_firstname' => $this->input->post('billing_fname'), 
                'billing_lastname' => $this->input->post('billing_lname'), 
                'billing_addressA' => $this->input->post('billing_addrA'), 
                //'billing_addressB' => $this->input->post('billing_addrB'), 
                'billing_email' => $this->input->post('billing_email'),
                 'billing_country_code' => $this->input->post('billing_country_code'),  
                'billing_contact' => $this->input->post('billing_contact'), 
                'billing_country' => $this->input->post('billing_country'), 
                'billing_city' => $this->input->post('billing_city'), 
                'billing_state' => $this->input->post('billing_state'), 
                'billing_postal' => $this->input->post('billing_postal')
            );
				}
        } else if($user_type == 2) {
            $update = array(
                'firstname' => $this->input->post('fname'),
                'lastname' => $this->input->post('lname'),
                 'middlename' => $this->input->post('mname'),
                'email_id' => $this->input->post('email'),
                'gender' => $this->input->post('gender'),
                'dob' => $dob,
                'city' => $this->input->post('city'),
                'country' => $this->input->post('country'),
                'postal_code' => $this->input->post('zip'),
                'address' => $this->input->post('address'),
                'about' => $about,
                'school' => $this->input->post('school'),
                'work' => $this->input->post('work'),
                'zone' => $this->input->post('zone'),
                'languages' => $this->input->post('languages'),
                'billing_firstname' => $this->input->post('billing_fname'), 
                'billing_lastname' => $this->input->post('billing_lname'), 
                'billing_addressA' => $this->input->post('billing_addrA'), 
                //'billing_addressB' => $this->input->post('billing_addrB'), 
                'billing_email' => $this->input->post('billing_email'), 
                'billing_contact' => $this->input->post('billing_contact'), 
                'billing_country' => $this->input->post('billing_country'), 
                'billing_city' => $this->input->post('billing_city'), 
                'billing_state' => $this->input->post('billing_state'), 
                'billing_postal' => $this->input->post('billing_postal')
            );
        }
        
        if($this->input->post('em_name') != '' || $this->input->post('em_phone') != '' || $this->input->post('em_email') != '' || $this->input->post('em_rel') != ''){
            $count = $this->account_model->getUserEmergency($user_type,$user_id)->num_rows();
            if($count == 1){
                $emergency = array(
                    'name' => $this->input->post('em_name'),
                    'phone' => $this->input->post('em_phone'),
                    'email' => $this->input->post('em_email'),
                    'relation' => $this->input->post('em_rel')
                );
                $this->account_model->update_emergency_contact($emergency, $user_type, $user_id);
            }else{
                $emergency = array(
                    'user_type' => $user_type,
                    'user_id' => $user_id,
                    'name' => $this->input->post('em_name'),
                    'phone' => $this->input->post('em_phone'),
                    'email' => $this->input->post('em_email'),
                    'relation' => $this->input->post('em_rel')
                );
                $this->account_model->createEmergency($emergency);
            }
        }
        
        if($user_type == 3) {
            $this->account_model->update_b2c($update, $email);
        } else if($user_type == 2) {
            $this->account_model->update_b2b($update, $email);
        }
        

        echo json_encode(array('status' => '1', 'msg' => 'Changes has been saved!!'));
    }

    public function update_user_profile_image(){
        $ext = end(explode('/', $_FILES["profilePhoto"]["type"]));
        $tmp_name = $_FILES["profilePhoto"]["tmp_name"];

        $name = uniqid() . '.' . $ext;

        move_uploaded_file($tmp_name, ADMIN_UPLOAD_PATH . '1/b2c/images/' . $name);

        $image = UPLOAD_PATH.'1/b2c/images/'.$name;
        
        if($this->session->userdata('b2c_id')){    //identify the session
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        }

        $userInfo = $this->account_model->GetUserData($user_type,$user_id)->row();
        
        if(isset($userInfo->email) && $userInfo->email != "" ) {
            $email = $userInfo->email;
        } else if(isset($userInfo->email_id) && $userInfo->email_id != "") {
            $email = $userInfo->email_id;
        } else {
            return false;
        }

        if(isset($userInfo->profile_photo) && $userInfo->profile_photo != "") {
            $old_image = $userInfo->profile_photo;
        } else if(isset($userInfo->agent_logo) && $userInfo->agent_logo != "") {
            $old_image = $userInfo->agent_logo;
        }
        
        if (strpos($old_image,'1/b2c/images/') !== false) {
            $old_image = explode('1/b2c/images/',$old_image);
            $old_image = ADMIN_UPLOAD_PATH.'1/b2c/images/'.$old_image[1];
            @unlink($old_image);
        }
        


        if($user_type == 3) {
            $update = array('profile_photo' => $image);
            $profile_photo = $this->account_model->update_b2c($update, $email);
        } else if($user_type == 2) {
            $update = array('agent_logo' => $image);
            $profile_photo = $this->account_model->update_b2b($update, $email);
        } else {
            return false;
        }

        echo json_encode(array('img' => $image));
    }

    public function ChangePassword(){
        if($this->session->userdata('b2c_id')){    //identify the session
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        }
		
        $password = $this->input->post('password');
        $update = array('password' => $password);

        if($user_type == 3) {
            $this->account_model->update_b2c_user($update,$user_id);
        } else if($user_type == 2) {
            $this->account_model->update_b2b_user($update,$user_id);
        }
        	$this->sms_model->sms_change_password($user_type,$user_id);
        $response = array(
            'status' => '1',
            'success' => 'true',
            'msg' => "Your password has been updated!"
        );
        echo json_encode($response);
    }
    
    public function Update_public_private()
    {
        $emailaddress=0;
        $phone=0;
        $address=0;
        $facebook=0;
        $twitter=0;
        $google=0;
        
       if($this->input->post('emailaddress'))
       {
           $emailaddress='1';
       }
       
       if($this->input->post('phone'))
       {
            $phone='1';
       }
       
       if($this->input->post('address'))
       {
            $address='1';
       }
         if($this->input->post('facebook'))
       {
           $facebook='1';
       }
       
       if($this->input->post('twitter'))
       {
            $twitter='1';
       }
       
       if($this->input->post('google'))
       {
            $google='1';
       }
       
        $b2c_id = $this->session->userdata('b2c_id');
      
        $update = array(
            'security_email_address' => $emailaddress,
             'security_phone' => $phone,
              'security_address' => $address,
               'security_facebook' => $facebook,
                'security_twitter' => $twitter,
                 'security_google' => $google
        );
        $this->account_model->update_b2c_user($update,$b2c_id);
        $response = array(
            'status' => '1',
            'success' => 'true',
            'msg' => "Saved"
        );
        echo json_encode($response);
    
    
    }
   public function Update_security_question(){
        if($this->session->userdata('b2c_id')){
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        }

        $security_question = mysql_real_escape_string($this->input->post('security_question'));
        if($this->input->post('security_question')=='')
        {
            $security_question = mysql_real_escape_string($this->input->post('security_question_own'));
        }
        $security_answer = mysql_real_escape_string($this->input->post('security_answer'));

        $update = array(
            'security_answer' => $security_answer,
            'security_question' => $security_question
        );
        
        if($user_type == 3) {
            $this->account_model->update_b2c_user($update,$user_id);    
        } else if($user_type == 2) {
            $this->account_model->update_b2b_user($update,$user_id);    
        }
        
        
        redirect(WEB_URL.'/dashboard/settings');
    }
    public function validatePassword(){
        if($this->session->userdata('b2c_id')){
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        }

        $opassword = $this->input->post('opassword');

        if($user_type == 3) {
            $status = $this->account_model->validatePassword($user_id,$opassword)->num_rows();    
        } else if($user_type == 2) {
            $status = $this->account_model->validatePasswordB2b($user_id,$opassword)->num_rows();    
        }
        
        if($status == 1){
            echo 'true';
        }else{
            echo "\"Your old password was incorrect. Please try again.\"";
        }
    }
    
    public function disconnect($provider){
        $b2c_id = $this->session->userdata('b2c_id');
        switch ($provider) {
          case "Facebook":
            $update = array(
                'facebook_id' => ''
            );
            break;
          case "Google":
            $update = array(
                'google_id' => ''
            );
            break;
          case "Twitter":
            $update = array(
                'twitter_id' => ''
            );
            break;
        }
        $this->account_model->update_b2c_user($update,$b2c_id);
        echo '<html><body>
                <form id="vForm1" action="'.WEB_URL.'/dashboard/profile/verifications" method="POST">
                    <input type="hidden" name="d_msg" value="You have been disconnected. You can reconnect again, below."/>
                </form>
                <script>document.getElementById("vForm1").submit();</script>
             </body></html>';
    }

    public function sendReference(){
        $emails = $this->input->post('emails');
        $emails = explode(',',$emails);
        $status = $this->get_mail_content_requestreference($emails);

        $emails = implode(' and ',$emails);
        $response['msg'] = 'We just emailed '.$emails.'.';
        echo json_encode($response);
    }

    public function get_mail_content_requestreference($emails){
        if($this->session->userdata('b2c_id')){    //identify the session
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        }

        $data['emails'] = $emails;
        
        $data['user_data'] = $this->account_model->GetUserData($user_type, $user_id)->row();
        $data['email_access'] = $this->email_model->get_email_acess()->row();
        $email_type = 'RequestReference';
        $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
        
        if(isset($data['user_data']->email) && $data['user_data']->email != "" ) {
            $email_id = $data['user_data']->email;
        } else if(isset($data['user_data']->email_id) && $data['user_data']->email_id != "" ) {
            $email_id = $data['user_data']->email_id;
        } else {
            return false;
        }

        $secret = md5($email_id);
        
        $data['facebook_social_url'] = 'facebook.com';
        $data['twitter_social_url'] = 'twitter.com';
        $data['google_social_url'] = 'google.com';
        
        
        foreach($emails as $email){
            $key = $this->generate_random_key();
            
            $reference = array(
                'b2c_id' => $user_id,
                'user_type' => $user_type,
                'reffered_to' => $email,
                'secret' =>$secret,
                'vid' => $key
            );

            $getReferenceWriterTypeB2b_num = $this->account_model->getUserInfoEmailB2b($email)->num_rows();
            $getReferenceWriterTypeB2c_num = $this->account_model->getUserInfoEmail($email)->num_rows();

            /*first check if the user's email id is registered to InnoGlobe or not. 
            if yes, then proceed else send b2c page link*/
            if($getReferenceWriterTypeB2b_num == 0 && $getReferenceWriterTypeB2c_num == 0) {
                /*The user is not registered and should signup.*/
                $refWriterType = '3';
                $refWriterType_secret = md5($refWriterType);
            } else {
                if($getReferenceWriterTypeB2c_num == 0) {    //if b2c comes up zero, user is b2b type
                    $refWriterType = '2';
                    $refWriterType_secret = md5($refWriterType);
                } else if($getReferenceWriterTypeB2b_num == 0) {  //if b2b comes up zero, user is b2c type
                    $refWriterType = '3';
                    $refWriterType_secret = md5($refWriterType);
                } else if($getReferenceWriterTypeB2b_num == 1 && $getReferenceWriterTypeB2c_num == 1) {   //if b2c and b2b both are 1, then take it as b2c user.
                    $refWriterType = '3';
                    $refWriterType_secret = md5($refWriterType);
                } else {
                    return; //else return 
                }
            }

                


            $data['refrence_link'] = WEB_URL.'/users/validateReference/'.$key.'/'.$secret.'/'.$refWriterType_secret;
            $this->reference_model->addReference($reference);
            $data['email'] = $email;
            $this->email_model->sendmail_request_reference($data);
        }
        
    }

    public function generate_random_key($length = 50) {
        $alphabets = range('A','Z');
        $numbers = range('0','9');
        $additional_characters = array('_','.');
        $final_array = array_merge($alphabets,$numbers,$additional_characters);
             
        $id = '';
      
        while($length--) {
          $key = array_rand($final_array);
          $id .= $final_array[$key];
        }
        return $id;
    }

    public function writeRequestReference($key,$secret){
        if($key == '' || $secret == ''){
            $data['msg'] = 'The link you followed is no longer valid.';
            $data['status'] = '0';
            if (!$this->session->userdata('b2c_id')) {
                $this->load->view('login');
            }else{
                echo '<html><body>
                        <form id="vForm1" action="'.WEB_URL.'/dashboard/profile/references" method="POST">
                            <input type="hidden" name="v_err" value="The link you followed is no longer valid."/>
                        </form>
                        <script>document.getElementById("vForm1").submit();</script>
                     </body></html>';
            }
        }else{
            $count = $this->account_model->isvalidSecrect($key,$secret)->num_rows();
            if($count == 1){
                 $this->load->view('login');
            }else{
                $data['msg'] = 'The link you followed is no longer valid.';
                $data['status'] = '0';
                if (!$this->session->userdata('b2c_id')) {
                    $this->load->view('login');
                }else{
                    echo '<html><body>
                            <form id="vForm" action="'.WEB_URL.'/dashboard/profile/references" method="POST">
                                <input type="hidden" name="err_v" value="The link you followed is no longer valid."/>
                            </form>
                            <script>document.getElementById("vForm").submit();</script>
                         </body></html>';
                }
            }
        }
    }

    public function messages() {
        $this->load->view('dashboard/conversation');
    }
        public function booking_statement() {
   
    if($this->session->userdata('b2c_id')){
          redirect('','refresh');
    }else if($this->session->userdata('b2b_id')){
        $b2c_type = '2';
        $b2c_id = $this->session->userdata('b2b_id');
        $user_data = $this->account_model->GetUserData('2',$b2c_id)->row();
		$data['userType'] = $b2c_type;
    $data['name'] = $user_data->firstname;
 
   
    $data['Bookings'] = $this->booking_model->getoverallBookings($b2c_id, $b2c_type)->result();
		
		
        $this->load->view('dashboard/booking_statement',$data);
    }else{
        redirect('','refresh');
    }
    
    }
    
    public function account_statement() {
   
    if($this->session->userdata('b2c_id')){
          redirect('','refresh');
    }else if($this->session->userdata('b2b_id')){
        $b2c_type = '2';
        $b2c_id = $this->session->userdata('b2b_id');
        $user_data = $this->account_model->GetUserData('2',$b2c_id)->row();
		 $data['userType'] = $b2c_type;
        $data['name'] = $user_data->firstname;
     $data['depost_table_data'] = $this->getDepositDetails();
       $data['account_statment_data'] = $this->account_model->get_account_statment($b2c_id)->result();
	  
        $this->load->view('dashboard/account_statement',$data);
		
    }else{
        redirect('','refresh');
    }
   
    }
     public function support_conversation() {
    
            if($this->session->userdata('b2c_id')){
                $b2c_id = $this->session->userdata('b2c_id');
                $b2c_type = $this->account_model->getUserInfo($b2c_id);
                $b2c_type = $b2c_type->row()->usertype;
                $b2c_type = ($b2c_type)?$b2c_type:'3';
                $user_data = $this->account_model->GetUserData('3',$b2c_id)->row();
            }else if($this->session->userdata('b2b_id')){
                $b2c_type = '2';
                $b2c_id = $this->session->userdata('b2b_id');
                $user_data = $this->account_model->GetUserData('2',$b2c_id)->row();
            }else{
                redirect('','refresh');
            }
            $data['userType'] = $b2c_type;
            $data['name'] = $user_data->firstname;
            $data['support_ticket_subject'] = $this->Support_Model->get_support_subject_list(); 
            $data['support'] = $this->Support_Model->get_support_list($b2c_id,$b2c_type,$this->domain_id ); 
            $data['support_pending'] = $this->Support_Model->get_support_list_pending($b2c_id,$b2c_type,$this->domain_id ); 
            $data['support_sent'] = $this->Support_Model->get_support_list_sent($b2c_id,$b2c_type,$this->domain_id ); 
            $data['support_close'] = $this->Support_Model->get_support_list_close($b2c_id,$b2c_type,$this->domain_id ); 
           // print_r($data);
                $this->load->view('dashboard/support_conversation',$data);
            }
            
    function add_new_ticket(){
            
            //$user = $this->input->post('user');
            if($this->session->userdata('b2c_id')){
                $data['user_type']=$user_type = 3;
                $data['user_id']=$user_id = $this->session->userdata('b2c_id');
                $domain = $this->domain_id;
            }else if($this->session->userdata('b2b_id')){
                $data['user_type']=$user_type = 2;
                $data['user_id']=$user_id = $this->session->userdata('b2b_id');
                $domain = $this->domain_id;
            } else {
                redirect('','refresh');
            }


            /*if($this->session->userdata('b2c_id')){
                $user = $this->session->userdata('b2c_id');
                $domain = $this->domain_id;
                $b2c_type = $this->account_model->GetUserData($user);
                $b2c_type = $b2c_type->row()->usertype;
                $b2c_type = ($b2c_type)?$b2c_type:'3';
                $usertype = $b2c_type;
            }
            else if($this->session->userdata('b2b_id')){
                $b2c_type = '2';
                $b2c_id = $this->session->userdata('b2b_id');
                $domain = $this->domain_id;
            }else{
                redirect('','refresh');
            }*/
            $sub = $this->input->post('subject');
            $message = $this->input->post('message');
            $config['upload_path'] = './admin/upload_files/support_ticket/'.$domain;
            $config['allowed_types'] = '*';
            $this->load->library('upload', $config);
           /* if($_FILES['file_name']['name']!='')
            {
                if ( ! $this->upload->do_upload('file_name'))
                {
                    $error = array('error' => $this->upload->display_errors());
                    $data['status'] ='<div class="alert alert-block alert-danger">
                                          <a href="#" data-dismiss="alert" class="close">×</a>
                                          <h4 class="alert-heading">Attachment File Failed!</h4>
                                          '.$error['error'].'
                                        </div>';
                    $data['support_ticket_subject'] = $this->Support_Model->get_support_subject_list(); 
                    $this->load->view('dashboard/support_conversation',$data);
                }
                $cc = $this->upload->data('file');
                $image_path = 'upload_files/support_ticket/'.$domain.'/'.$cc['file_name'];
            }
            else
            {
                $image_path = '';
            }*/
             foreach($_FILES as $field => $file)
            {
                if($file['error'] == 0)
                {
                    if ($this->upload->do_upload($field))
                    {
                        $data = $this->upload->data();
                        $cc = $this->upload->data('file');
                        $image_path = 'upload_files/support_ticket/'.$domain.'/'.$cc['file_name'];
                    }else{
                        $image_path = '';
                    }
                }else{
                        $image_path = '';
                }
            }
                        
            $support_ticket_id = $this->Support_Model->add_new_support_ticket($domain,$user_type,$user_id,$sub,$message,$image_path);
            $support['support_sent'] = $support_sent = $this->Support_Model->get_support_list_id_row($support_ticket_id);
            $support['user_details'] = $this->Support_Model->get_user_details($support_sent->user_type,$support_sent->user_id);
            $support['user_type'] = $this->Support_Model->get_usertype_details($support_sent->user_type);
            $support['domain'] = $this->Support_Model->get_domain_details($support_sent->domain);
           /* $data['status'] = '<div class="alert alert-block alert-success">
                              <a href="#" data-dismiss="alert" class="close">×</a>
                              <h4 class="alert-heading">Support Ticket Registered Successfully</h4></div>';*/
            //$data['support_ticket_subject'] = $this->Support_Model->get_support_subject_list(); 
            //redirect("dashboard/support_conversation");

            $tickets = $this->load->view('dashboard/support_new_ticket',$support,TRUE);
            $response = array('tickets' => $tickets,'status'=> '1');
            echo json_encode($response);
    }
    
    public function delete_ticket($id){
        $wheres = "support_ticket_id = '$id'";
        $this->db->delete('support_ticket', $wheres);
        $wheres = "support_ticket_id = '$id'";
        $this->db->delete('support_ticket_history', $wheres);
        redirect("dashboard/support_conversation","refresh");
    }
    
    public function view_ticket($id){
        $data['status']='';
        $data['ticket'] = $this->Support_Model->get_support_list_id($id); 
        $data['ticketrow'] = $this->Support_Model->get_support_list_id_row($id); 
        $data['id']=$id;
        $tickets = $this->load->view('dashboard/support_view_ticket',$data,TRUE);
        $response = array('tickets' => $tickets,'status'=> '1');
        echo json_encode($response);
    }
        public function close_ticket($sid){
         $this->Support_Model->close_ticket($sid); 
        $response = array('status'=> '1');
        echo json_encode($response);
       // redirect("dashboard/support_conversation","refresh");
    }
    function reply_ticket($id)
    {
            $domain = $this->input->post('domain');
            $usertype = $this->input->post('user_type');
            $user = $this->input->post('user_id');
            $sub = $this->input->post('subject');
            $message = $this->input->post('message');
            $support_ticket_id = $this->input->post('support_ticket_id');
            $config['upload_path'] = './admin/upload_files/support_ticket/'.$domain;
            $config['allowed_types'] = '*';
            $this->load->library('upload', $config);

           /* $config['upload_path'] = './uploads/tickets';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '100';
            $config['max_width']  = '0';
            $config['max_height']  = '0';
            $this->load->library('upload', $config);*/
            foreach($_FILES as $field => $file)
            {
                if($file['error'] == 0)
                {
                    if ($this->upload->do_upload($field))
                    {
                        $data = $this->upload->data();
                        $cc = $this->upload->data('file');
                        $image_path = 'upload_files/support_ticket/'.$domain.'/'.$cc['file_name'];
                    }else{
                        $image_path = '';
                    }
                }else{
                        $image_path = '';
                }
            }
            /*if($_FILES['rfile_name']['name']!=''){
                
                if ( ! $this->upload->do_upload('rfile_name'))
                {
                    $error = array('error' => $this->upload->display_errors());
                    $data['status'] ='<div class="alert alert-block alert-danger">
                                          <a href="#" data-dismiss="alert" class="close">×</a>
                                          <h4 class="alert-heading">Attachment File Failed!</h4>
                                          '.$error['error'].'
                                        </div>';
                    $data['ticket'] = $this->Support_Model->get_support_list_id($id); 
                    $data['ticketrow'] = $this->Support_Model->get_support_list_id_row($id); 
                        $data['id']=$id;
                    $this->load->view('dashboard/support_conversation',$data);
                }
                $cc = $this->upload->data('file');
                
                $image_path = 'upload_files/support_ticket/'.$domain.'/'.$cc['file_name'];
            }else{
                        $image_path = '';
            }*/
            
            $last_id = $this->Support_Model->add_new_support_ticket_updates($support_ticket_id,$domain,$usertype,$user,$sub,$message,$image_path);
            $data['ticket'] = $this->Support_Model->getSupportHistoryRow($last_id);
            $ticketrow = $this->Support_Model->get_support_list_id_row($id);
            $data['user_details'] = $this->Support_Model->get_user_details($ticketrow->user_type,$ticketrow->user_id);
            $tickets = $this->load->view('dashboard/support_view_ticket_ajax',$data,TRUE);
            $response = array('tickets' => $tickets,'status'=> '1','id'=>$id);
            echo json_encode($response);
            //redirect('dashboard/support_conversation/'.$id,'refresh');
    }
    
    public  function download_file($file){
        $this->load->helper('download');
            $name=  base64_decode($file);
       
        $data = file_get_contents($name); // Read the file's contents
       
        $a = explode('support_ticket', $name);
        $name1 = substr($a[1],2);
        if($data != ''){
            force_download($name1, $data); 
        }else{
            redirect('dashboard/support_conversation/','refresh');
        }
    }

    public function ajax_getListing() {
        $list_type = $this->input->post('list_type');
        
        $b2c_id = $this->session->userdata('b2c_id');
        $b2b_id = $this->session->userdata('b2b_id');
        
        if(!empty($b2c_id)){
        	$user_id = $b2c_id;
        	$user_type = 3;
        }elseif (!empty($b2b_id)) {
        	$user_id = $b2b_id;
        	$user_type = 2;
        }

        $data['get_user_listings'] = $this->Listings_Model->get_user_listings($user_id, $user_type,'',$list_type);
        $getHtml = $this->load->view('dashboard/yourlisting_ajax', $data, true);
        echo json_encode($getHtml);
    }

    public function getDepositDetails() {
        if ($this->session->userdata('b2b_id')=='') {
            redirect(WEB_URL);
        } else {
            $b2b_type = $this->session->userdata('user_type');
            $b2b_id = $this->session->userdata('b2b_id');
            
            $data['deposit'] = $this->account_model->agent_deposit_details($b2b_id)->result();
            $data['deposit_amount'] = $this->account_model->get_deposit_amount($b2b_id)->row();

            return $data;
        }
    }

  

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
