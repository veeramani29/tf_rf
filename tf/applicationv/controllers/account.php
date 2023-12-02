<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Account extends CI_Controller {
	public function __construct(){
        parent::__construct();
     	$this->load->model('account_model');
     	$this->load->model('booking_model');
     	$this->load->model('email_model');
     	$this->load->model('Auth_Model');  
     	$this->load->model('Help_Model');
     	$this->load->model('Wishlist_Model');
     	$this->helpMenuLink = $this->Help_Model->fetchHelpLinks(); 
		
    }

	public function index(){
	}
	
	public function create(){
		$postData = array(
			'firstname' => $this->input->post('fname'),
			'lastname' => $this->input->post('lname'),
			'middlename' => $this->input->post('mname'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'register_date' => date('Y-m-d H:i:s'),
			'status' => '1',
			'logged_in' => '1',
			'profile_photo' =>  ASSETS.'images/user-avatar.jpg',
			'loggedin_with' => 'Ticketfinder'
		);
		$count = $this->account_model->isRegistered($this->input->post('email'))->num_rows();
		if($count == 0){
			$this->account_model->createUsers($postData);
			$user_data = $this->account_model->isRegistered($this->input->post('email'))->row();
			$b2c_session =  array(
                'b2c_id' => $user_data->user_id,
                'user_type' => '3',
                'provider' => 'Ticketfinder'
            );
            $this->session->set_userdata($b2c_session);
            $this->account_model->assignDefaultverfication($this->session->userdata('b2c_id'),3);
			$this->Wishlist_Model->assignDefaultWishlist($this->session->userdata('b2c_id'),3);
			if($this->input->post('continue')!=null){
				$continue = $this->session->userdata('continue');
			}else{
				$continue = '';
			}
			
			$response = array(
				'status' => '1',
				'success' => 'true',
				'msg' => 'Success!',
				'rid' => $user_data->user_id,
				'fname' =>  $user_data->firstname,
				'profile_photo' =>  $user_data->profile_photo,
				'continue' => $continue
			);
			
			//$this->email_model->commonMail();
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$this->get_email_content($user_data->user_id, 'Registration', $password);
		}else{
			$response = array(
				'status' => '0',
				'success' => 'false',
				'msg' => 'That email address is already in use. Please log in.'
			);
		}
		echo json_encode($response);
	}

	public function login(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		//print_r($this->input->post());exit;
		$count = $this->account_model->isRegistered($email)->num_rows();  //check for the email
		if($count == 1){ //if count ='s one then move fwd
			$userInfo = $this->account_model->isRegistered($email)->row(); //check if registered user or not
			if($userInfo->status == 1){   
				$count = $this->account_model->isValidUser($email,$password)->num_rows(); //check username and password
				if($count == 1){  //give invalid password
					$user_data = $this->account_model->isValidUser($email,$password)->row(); //get the user data b2c id etc 
					$b2c_session =  array(
		                'b2c_id' => $user_data->user_id,
		                'user_type' => '3',
		                'provider' => 'Ticketfinder'
		            );

		            $update_login = array(
		            	'loggedin_with' => 'Ticketfinder'
		            );
		            $this->account_model->update_b2c_user($update_login,$user_data->user_id);
					//check if two step verification is enabled

					$checkVeriType = $this->account_model->checkTwoStepVerification($user_data->user_id,3);
					if(!empty($checkVeriType) && $checkVeriType != "" ) {
						if($checkVeriType->two_step_verification == 1  && $checkVeriType->two_step_type > 0) {
							$this->session->set_userdata('temp_b2c_id', $user_data->user_id);   //setting temp_b2c_id
							$this->session->set_userdata('temp_email_id', $user_data->email);   //setting temp_email_id
							$response = array(
								'status' => '2'
							);
						} else {
							$this->session->set_userdata($b2c_session); //start session, log user in without two steps
							$response = array(
								'status' => '1',
								'success' => 'true',
								'msg' => 'Success!',
								'rid' => $user_data->user_id,
								'fname' =>  $user_data->firstname,
								'profile_photo' =>  $user_data->profile_photo
							);
						}
					} else {
						$this->session->set_userdata($b2c_session); //start session, log user in without two steps
				
						$continue = $this->session->userdata('continue');
							//print_r($this->session->userdata);exit;

						$response = array(
							'status' => '1',
							'success' => 'true',
							'msg' => 'Success!',
							'rid' => $user_data->user_id,
							'fname' =>  $user_data->firstname,
							'profile_photo' =>  $user_data->profile_photo,
							'continue' => $continue
						);
					}
				}else{
					$response = array(
						'status' => '0',
						'success' => 'false',
						'msg' => 'Invalid Password.'
					);
				}
			}else{
				$response = array(
					'status' => '0',
					'success' => 'false',
					'msg' => "Invalid password. If you previously logged in with ".$userInfo->loggedin_with.", click 'Log in with ".$userInfo->loggedin_with."' to access your Ticketfinder account."
				);
			}
		}else{
			$response = array(
				'status' => '0',
				'success' => 'false',
				'msg' => 'Invalid Email.'
			);
		}
		//print_r($this->session->userdata);exit;
		echo json_encode($response);
	}

	public function forgetpwd(){
		//print_r($this->input->post());exit;
		$email = $this->input->post('email');
		
		  $count = $this->account_model->isRegistered($email)->num_rows();
		if($count == 1){
			$userInfo = $this->account_model->isRegistered($email)->row();
			if($userInfo->status == 1){
				 $password = $userInfo->password;
				 $status = $this->get_mail_content_forgotpass($email, $password);
				if($status == 1){
					
					$response = array(
						'status' => '1',
						'success' => 'true',
						'msg' => "A link to reset your password has been sent to ".$email.".!"
					);
				}else{
				$response = array(
					'status' => '0',
					'success' => 'false',
					'msg' => "Invalid Email."
				);
			}
			}else{
				$response = array(
					'status' => '0',
					'success' => 'false',
					'msg' => "Invalid Email."
				);
			}
		}else{
			$response = array(
				'status' => '0',
				'success' => 'false',
				'msg' => 'Invalid Email.'
			);
		}
		
		echo json_encode($response);
	}

	public function get_email_content($b2c_id, $email_type, $password) {
        $data['user_data'] = $user_data = $this->account_model->getUserInfo($b2c_id)->row();
        $data['password'] = $password;
        
        $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
        $data['facebook_social_url'] = 'facebook.com';
        $data['twitter_social_url'] = 'twitter.com';
        $data['google_social_url'] = 'google.com';
        $email = $user_data->email;
        $key = $this->generate_random_key();
        $secret = md5($email);
        $this->account_model->updatePwdResetLink($data['user_data']->user_id, $key, $secret);
        $data['confirm_link'] = WEB_URL.'/verification/email/'.$key.'/'.$secret;
        $data['email_access'] = $this->email_model->get_email_acess()->row();
        $this->email_model->sendmail_reg($data);
    }

    public function get_mail_content_forgotpass($email, $password) {
		$data['password'] = $password;
        $data['user_data'] = $this->account_model->getUserInfoEmail($email)->row();
        $data['email_access'] = $this->email_model->get_email_acess()->row();
        $email_type = 'forgotpassword';
        $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
        $key = $this->generate_random_key();
        $secret = md5($email);
        $this->account_model->updatePwdResetLink($data['user_data']->user_id, $key, $secret);
        $data['reset_link'] = WEB_URL.'/account/set_password/'.$key.'/'.$secret;
        $Response = $this->email_model->sendmail_forgot_password($data);
        
        return $Response;
    }

    public function set_password($key,$secret){
    	if($key == '' || $secret == ''){
    		$data['msg'] = 'sorry link has been expired, plese reset again';
    		$data['status'] = '0';
    	}else{
    		$count = $this->account_model->isvalidSecrect($key,$secret)->num_rows();
    		if($count == 1){
    			$user_data = $this->account_model->isvalidSecrect($key,$secret)->row();
    			$data['status'] = '1';
    			$data['email'] = $user_data->email;
    		}else{
    			$data['msg'] = 'sorry link has been expired, plese reset again';
				$data['status'] = '0';
    		}
    	}
    	$this->load->view('account/b2c/resetpwd', $data);
    }

    public function resetpwd(){
    	$email = $this->input->post('email');
    	$password = $this->input->post('password');
    	$update = array(
    		'password' => $password,
    		'key' => ''
    	);
    	$this->account_model->update_b2c($update,$email);
    	$response = array(
			'status' => '1',
			'success' => 'true',
			'msg' => "Your password has been changed you can login now!"
		);
		echo json_encode($response);
    }

    public function sendEmailVerification(){
        if($this->session->userdata('b2c_id')){
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        } else {
        	return false;
        }

        $userInfo = $this->account_model->GetUserData($user_type, $user_id)->row();
        if(isset($userInfo->email) && $userInfo->email != "") {
        	$email = $userInfo->email;
        } else if(isset($userInfo->email_id) && $userInfo->email_id != "") {
        	$email = $userInfo->email_id;
        } else {
        	return false;
        }

        $status = $this->get_mail_content_emailVerification($email, $user_type);
        $response = array(
			'status' => '1',
			'success' => 'true'
		);
		echo json_encode($response);
    }

    public function get_mail_content_emailVerification($email, $user_type) {
    	if($user_type == 3) {
    		$data['user_data'] = $this->account_model->getUserInfoEmail($email)->row();	
    	} else if($user_type == 2) {
    		$data['user_data'] = $this->account_model->getUserInfoEmailB2b($email)->row();	
    	} else {
    		return false;
    	}
        
        $data['email_access'] = $this->email_model->get_email_acess()->row();
        $email_type = 'EmailConfirmation';
        $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
        $key = $this->generate_random_key();
        $secret = md5($email);
        if($user_type == 3) {
        	$this->account_model->updatePwdResetLink($data['user_data']->user_id, $key, $secret);
        } else if($user_type == 2) {
        	$this->account_model->updatePwdResetLinkB2b($data['user_data']->agent_id, $key, $secret);
        }
        
       
        $data['confirm_link'] = WEB_URL.'/verification/email/'.$key.'/'.$secret;
        $Response = $this->email_model->sendmail_email_verification($data);
       
        return $Response;
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
    
    public function update_b2c_user_listing_property_access(){
		if(empty($_POST)){
			redirect(WEB_URL.'/dashboard/listing');			
		}
		else{
			$this->account_model->update_b2c_user_listing_property_access($_POST);
			redirect(WEB_URL.'/dashboard/listing');	
		}
	}

	public function updateB2cUserListingAjax(){
		if(empty($_POST)){
			$response_array = array('status'=>0, 'page'=>0);
			echo json_encode($response_array);		
		}
		else{
			$this->account_model->update_b2c_user_listing_property_access($_POST);

			if($this->session->userdata('b2c_id')){
	            $data['user_type']=$user_type = 3;
	            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
	        }else if($this->session->userdata('b2b_id')){
	            $data['user_type']=$user_type = 2;
	            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
	        }

			$checkVerif = $this->account_model->checkVerifications($user_id, $user_type)->row();

			if(!empty($checkVerif)) {

				if($checkVerif->email == 1 && $checkVerif->mobile == 1) {
					$response_array = array('status'=>1, 'verif'=>1);
					echo json_encode($response_array);			
				} else {
					$response_array = array('status'=>1, 'verif'=>0);
					echo json_encode($response_array);				
				}

			} else {
				$response_array = array('status'=>1, 'verif'=>0);
				echo json_encode($response_array);		
			}
			
		}
	}

	public function updateB2bUserListingAjax() {
		if(empty($_POST)){
			$response_array = array('status'=>0, 'page'=>0);
			echo json_encode($response_array);		
		}
		else{
			$this->account_model->update_b2b_user_listing_property_access($_POST);

			if($this->session->userdata('b2c_id')){
	            $data['user_type']=$user_type = 3;
	            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
	        }else if($this->session->userdata('b2b_id')){
	            $data['user_type']=$user_type = 2;
	            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
	        }

	        $checkVerif = $this->account_model->checkVerifications($user_id, $user_id)->row();

			if(!empty($checkVerif)) {

				if($checkVerif->email == 1 && $checkVerif->mobile == 1) {
					$response_array = array('status'=>1, 'verif'=>1);
					echo json_encode($response_array);			
				} else {
					$response_array = array('status'=>1, 'verif'=>0);
					echo json_encode($response_array);				
				}

			} else {
				$response_array = array('status'=>1, 'verif'=>0);
				echo json_encode($response_array);		
			}		
		}
	}

	public function update_b2b_user_listing_property_access(){
		if(empty($_POST)){
			redirect(WEB_URL.'/dashboard/listing');			
		}
		else{
			$this->account_model->update_b2b_user_listing_property_access($_POST);
			redirect(WEB_URL.'/dashboard/listing');	
		}
	}

	public function addDeposit() {
		$b2b_user_id = $this->session->userdata('b2b_id');
		if($b2b_user_id == "") {
			redirect(WEB_URL);
		}
		$this->load->view('deposit/addDeposit');

	}

	public function saveDeposit() {
		$agent_id = $this->session->userdata('b2b_id');
		if($agent_id == "") {
			redirect(WEB_URL);
		}

		$amount = $this->input->post('amount');
		$deposit_date = $this->input->post('deposited_date');
		$remark = $this->input->post('remarks');

		$this->account_model->saveDeposit_model($agent_id, $amount, $deposit_date, $remark);	
		redirect('dashboard/deposit');
	}

	public function checkVerifications($non_ajax=null) {
		if($this->session->userdata('b2c_id')){
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        }

        $verificationData = $this->account_model->checkVerifications($user_id, $user_type)->row();

        if($non_ajax == 1) {
        	if(empty($verificationData)) {
        		return false;
	        } else if($verificationData->mobile == 1 && $verificationData->email == 1) {
	        	return true;
	        } else {
	        	return false;
	        }
        } else {
        	if(empty($verificationData)) {
        		$response_array = array('status'=>0);
        		echo json_encode($response_array);
	        } else if($verificationData->mobile == 1 && $verificationData->email == 1) {
	        	$response_array = array('status'=>1);
	        	echo json_encode($response_array);
	        } else {
	        	$response_array = array('status'=>0);
	        	echo json_encode($response_array);
	        }	
        }
        

	}

	public function addBankDetails() {
		if(!$this->checkVerifications(1)) {
			$response_array = array('status'=>0);
			echo json_encode($response_array);
		} else {
			$bank_data = $this->input->post();
			if($this->session->userdata('b2c_id')){
	            $data['user_type']=$user_type = 3;
	            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
	        }else if($this->session->userdata('b2b_id')){
	            $data['user_type']=$user_type = 2;
	            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
	        }

			$data['Bank'] = 1;
			$data['bank_account_name'] = $bank_data['account_name'];
			$data['bank_name'] = $bank_data['bank_name'];
			$data['bank_card_number'] = $bank_data['bank_card_number'];
			$data['bank_account_number'] = $bank_data['bank_acc_number'];
			$data['bank_account_cvv'] = $bank_data['bank_cvv_number'];
			$data['user_id'] = $user_id;
			$data['user_type'] = $user_type;

			if(!$this->checkBankDetailsExist($user_id, $user_type)) {
				$this->account_model->addBankDetails($data);
			} else {
				$this->account_model->updateBankDetails($data, $user_id, $user_type);
			}

			$response_array = array('status'=>1);
			echo json_encode($response_array);
		}
	}

	public function checkBankDetailsExist($user_id, $user_type) {
		$isPresent = $this->account_model->checkBankDetailsExist($user_id, $user_type)->num_rows();

		if($isPresent == 1) {
			return true;
		} else {
			return false;
		}

	}

	public function addPaypalDetails() {
		if(!$this->checkVerifications(1)) {
			$response_array = array('status'=>0);
			echo json_encode($response_array);
		} else {
			$paypal_data = $this->input->post();
			if($this->session->userdata('b2c_id')){
	            $data['user_type']=$user_type = 3;
	            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
	        }else if($this->session->userdata('b2b_id')){
	            $data['user_type']=$user_type = 2;
	            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
	        }

			$data['Paypal'] = 1;
			$data['paypal_account_name'] = $paypal_data['paypal_acc_name'];
			$data['paypal_email_id'] = $paypal_data['paypal_email_id'];

			if(!$this->checkBankDetailsExist($user_id, $user_type)) {
				$this->account_model->addPaypalDetails($data);
			} else {
				$this->account_model->updatePaypalDetails($data, $user_id, $user_type);
			}

			$response_array = array('status'=>1);
			echo json_encode($response_array);
		}
	}


	public function transactionStatusChange() {
		$request = $this->input->post();
		$accept_bit = $request['accept_bit'];
		$accept_pnr = $request['accept_pnr'];

		if($this->session->userdata('b2c_id')){
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        }

        if($user_id != "" && $user_type != "") {
			if($accept_bit == 1) {
				$depositStatus = array("payout_status"=>"Recived", "payout_host_status"=>"Recived");
				$bitTrackingStatus = array("recived"=>'1');
			} else {
				$depositStatus = array("payout_status"=>"Recived", "payout_host_status"=>"NotRecived");
				$bitTrackingStatus = array("recived"=>'0');
			}

			$updated_id = $this->account_model->updateTransactionHostStatus($user_id, $user_type, $accept_pnr, $depositStatus);
			$transId = $updated_id->transaction_id;
			$this->account_model->updateTransactionTracking($user_id, $user_type, $transId, $bitTrackingStatus);
			$response_array = array("status"=>1);
			echo json_encode($response_array);
		}
	}
	
	public function trackTransaction() {
		$pnr = $this->input->post('track_id');

		$data['getAptTransaction'] = $getAptTransaction = $this->account_model->getAptTransaction($pnr)->row();
		
		if(!empty($getAptTransaction)) {
			$transactionId = $getAptTransaction->transaction_id;
			$data['getTransactionHistory'] = $this->account_model->getTransactionHistory($transactionId)->result();
			
			$pnr_no = $pnr;
	        $count = $this->booking_model->getBooking($pnr_no)->num_rows();
	        
            $data['Booking'] = $this->booking_model->getBooking($pnr_no)->row();
            $data['Transaction'] = $this->booking_model->getBookingApartmentTransaction($pnr_no)->row();
            $data['host_profile_link'] = WEB_URL . '/users/show/' . $data['Booking']->user_type.'/'.$data['Booking']->user_id;
            $data['apt_link'] = WEB_URL . '/apartment/rooms/' . $data['Booking']->PROP_ID;
            $data['global'] = $booking = $this->booking_model->getBookingPnr($pnr_no)->row();

			$getView = $this->load->view('dashboard/transactionTracker', $data, true);
			$response_array = array("status"=>1, "view"=>$getView);
			echo json_encode($response_array);
		} else {
			$response_array = array("status"=>0, "view"=>"Please check the tracking number.");
			echo json_encode($response_array);
		}
	}

	public function getStaticMap($lat, $long) {
        $locstring = '';
        $firstloc = 0;
        //$long = "77.5667";
        //$lat = "12.9667";

        if ($firstloc == 0) {
            $locstring = $locstring . $lat . ',' . $long . '&markers=icon:http://travelapt.hs24.info/assets/images/marker_out.png%7C' . $lat . ',' . $long;
            $firstloc = 1;
        } else {
            $locstring = $locstring . '&markers=icon:'.ASSETS.'images/marker_out.png%7C' . $lat . ',' . $long;
        }
        $url = "http://maps.googleapis.com/maps/api/staticmap?zoom=16&size=627x327&maptype=ROADMAP&" . urlencode("center") . "=" . $locstring . "&sensor=false";
        return $url;
    }

    public function checkOwnerAccVerif($ajax_req=null) {
    	if($this->session->userdata('b2c_id')){
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        } else {
        	return false;
        }

        $checkAdminReq =    $this->account_model->checkAdminReq($user_id, $user_type)->row();
        $checkUserVerif =   $this->account_model->checkUserVerif($user_id, $user_type)->row();
        $checkBankDetails = $this->account_model->checkBankDetails($user_id, $user_type)->row();

       

    	if(!empty($checkAdminReq)) {
    		if($checkAdminReq->property_owner_request == 1) {
    			$data['adminReq'] = 1;
    		} else {
    			$data['adminReq'] = 0;
    		}
    	} else {
    		$data['adminReq'] = 0;
    	}

    	if(!empty($checkUserVerif)) {
    		if($checkUserVerif->email == 1 && $checkUserVerif->mobile == 1) {
    			$data['userVerification'] = 1;
    		} else {
    			$data['userVerification'] = 0;
    		}
    	} else {
    		$data['userVerification'] = 0;
    	}

    	if(!empty($checkBankDetails)) {
    		if($checkBankDetails->Bank == 1 || $checkBankDetails->Paypal == 1) {
    			$data['bankVerification'] = 1;
    		} else {
    			$data['bankVerification'] = 0;
    		}
    	} else {
    		$data['bankVerification'] = 0;
    	}

    	if($ajax_req == 1) {
    		return $data;
    	} else {
    		echo json_encode($data);	
    	}
    	
    }

   
    public function RedeemPoints(){
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('b2c_id');
         $PointsDetails = $this->account_model->get_loyalty_points_balance($user_id, $user_type);
        /*if($TotalAmount >= $PointsDetails){
        	$TotalPayableAmt = $TotalAmount - ($PointsDetails * 0.0075);
        }else{
        	$TotalPayableAmt = 0;
        }*/
       
        $_SESSION['RedeemStatus'] = 'Yes';
        $_SESSION['RedeemPoints'] = round($PointsDetails);
        echo json_encode($PointsDetails);
    }

    public function allusrdata()
    {
    	unset($_SESSION['RedeemStatus']);
    	unset($_SESSION['RedeemPoints']);
    	echo "<pre>";
        print_r($_SESSION);
        exit;
    }

}

/* End of file account.php */
/* Location: ./application/controllers/account.php */
