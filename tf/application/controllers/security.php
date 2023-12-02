<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Security extends CI_Controller {
	public function __construct(){
        parent::__construct();
     	$this->load->model('account_model');
     	$this->load->model('email_model'); 
     	$this->load->model('verification_model');
     	$this->load->model('Auth_Model');   
     	$this->load->model('Help_Model');
		$this->helpMenuLink = $this->Help_Model->fetchHelpLinks();
    }

	public function index(){
		$this->load->view('security/index'); 
	}
	
	public function sec_confirm(){
			$this->load->view('security/sec_confirm'); 
	}

/*
* 2-step module controller
* Vikas Arora
*/
/*Get to the initialization page to start the setup.*/
	public function twostep() { 
		if($this->checkVerifiedCredentials()) {
			if($this->isTwoStepEnabled()) {
				$this->setUpTwoStep();
			} else {
				$this->load->view('security/two_step_initialize'); //check if the user has already enabled the 2 step service	
			}
		} else {
			$this->session->set_flashdata('verify_attributes', 1);
			redirect(WEB_URL.'/dashboard/profile/verifications');
		}
	}

/*Takes user to the actual enable verification page*/
	public function setUpTwoStep() {
		if($this->session->userdata('b2c_id')){
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        }
		
		if($user_type == 3) {
			$data['securityQuestionExist'] = $this->verification_model->checkSecurityQuestion($user_id);	
		} else if($user_type == 2) {
			$data['securityQuestionExist'] = $this->verification_model->checkSecurityQuestionB2b($user_id);	
		}
		
		$user_type_string = (string)$user_type;

		$data['twoStepTypeEnabled'] = $this->verification_model->twoStepTypeEnabled($user_id, $user_type_string); //check what type of two step is enabled. Mobile or email type.
		
		$data['userInfo'] = $this->account_model->GetUserData($user_type,$user_id)->row(); //get all user info.

		if($this->checkVerifiedCredentials()) {
			$this->load->view('security/enable_two_step_verification', $data); //start the two step verification
		} else {
			redirect(WEB_URL.'/dashboard/profile/verifications');
		}
		
	}

// /*This will be called by the ajax request and will enable the two step verification*/
	public function enableTwoStepVerification() {
		$verificationType = $this->input->post("verificationType"); //get the verification type via post; email: 1, Phone: 2
		$verificationEnable = '1';  //set the verification on 
		
		if($this->session->userdata('b2c_id')){
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        }
		
		if($this->reVerifyAllCredentials()) {
			$user_type_string = (string)$user_type;
			if($this->verification_model->enableTwoStepVerification($user_id, $user_type_string, $verificationType, $verificationEnable)) {
				
				$this->session->set_flashdata('twoStepEnabled', 'enabled');
				
				if($verificationType == 1) {
					$this->session->set_flashdata('twoStepEnableType', 'two_step_email');	
				} else {
					$this->session->set_flashdata('twoStepEnableType', 'two_step_phone');	
				}

				$response = array('status'=>1);
				echo json_encode($response);
			}	
		}
		
	}

	public function disableTwoStepVerification() {
		if($this->session->userdata('b2c_id')){
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        }

        $user_type_string = (string)$user_type;
		if($this->verification_model->disableTwoStepVerification($user_id, $user_type_string)) {
			redirect(WEB_URL.'/dashboard/settings');
		}
	}

// /*This will update the security question via ajax call*/
	public function updateSecurityQuestionAnswer() {
		if($this->session->userdata('b2c_id')){
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        }

		$security_question = $this->input->post("security_question");
		$security_answer = $this->input->post("security_answer");
		
		if($user_type == 3) {
			if($this->verification_model->b2c_setSecurityQuestion($user_id, $security_question, $security_answer)) {
				echo json_encode("1");
			}
		} else if($user_type == 2) {
			if($this->verification_model->b2b_setSecurityQuestion($user_id, $security_question, $security_answer)) {
				echo json_encode("1");
			}
		}
		
	}

// /*** Helper functions to the 2-step verification module ***/
	
// /*While coming from the settings page to the start setup page, check wheather email and mobile are verified or not by the user*/
	public function checkVerifiedCredentials() {  //this is applicable for b2c user only as b2b user will already be verified at the time of sign up.
		if($this->session->userdata('b2c_id')){
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        }

        if($user_type == 2) {
        	return true;
        } else if($user_type == 3) {
        	$user_type = (string)$user_type;
        	$result = $this->verification_model->checkB2CVerfication($user_id, $user_type)->row();
			
			$email_verified = $result->email;
			$mobile_verified = $result->mobile;
			if($email_verified == 1 AND $mobile_verified == 1) {
				return true;
			} else {
				return false;
			}	
        } else {
        	return false;
        }
	}

	public function isTwoStepEnabled() {	//check if the two step login is already enabled or not.
		if($this->session->userdata('b2c_id')){
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        }

        $user_type_string = (string)$user_type;
		if($this->verification_model->isTwoStepEnabled($user_id, $user_type_string)) {
			return true;
		} else {
			return false;
		}
	}

// /*While activating the 2-step verification, the user will be reverified by this*/
	public function reVerifyAllCredentials() {
		if($this->session->userdata('b2c_id')){
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        }
		$secureQuesAns = $this->account_model->GetUserData($user_type,$user_id)->row(); //get all data from the user_id
		
		if($secureQuesAns->security_question != "" && $secureQuesAns->security_answer !="") {
			$user_type = (string)$user_type;
			$emailMobileVerify = $this->verification_model->reVerifyEmailMobile($user_id, $user_type);

			if($emailMobileVerify->email == 1 && $emailMobileVerify->mobile == 1) {
				return true;
			} else {
				return false;
			} 

		} else {
			return false;
		}
	}


	public function verifytwostep() {

		$ajaxRequest = $this->input->post('ajaxRequest');
		if($this->session->userdata('temp_b2c_id')){
			$user_id = $this->session->userdata('temp_b2c_id');
			$user_type = 3;
		}else if($this->session->userdata('temp_b2b_id')){
			$user_id = $this->session->userdata('temp_b2b_id');
			$user_type = 2;
		}
		//$user_id = $this->session->userdata('temp_b2c_id');
		$data['email_id'] = $email_id = $this->session->userdata('temp_email_id');
		
		$getRedirectUrl = $_SERVER['QUERY_STRING'] ? $_SERVER['QUERY_STRING'] : '';
	 	if($getRedirectUrl != '') {
		 	$redirectUrlArray = explode('url=', $getRedirectUrl);
		 	if($redirectUrlArray[1] != '') {
		 		$data['redirectUrl'] = $redirectUrlArray[1];	
		 	} else {
		 		$data['redirectUrl'] = WEB_URL;
		 	}
		 } else {
		 	$data['redirectUrl'] = WEB_URL;
		 }


		$veriType = $this->checkVerificationType($user_id, $user_type);
		//die();	
		if($veriType == 1) {
			
			$verifyType = $veriType;
			
			$data['twoStepRandomNumber'] = $this->generate_random_key(4); //generate random number
			
			$data['user_data'] = $this->account_model->GetUserData($user_type,$user_id)->row();

        	$data['email_access'] = $this->email_model->get_email_acess()->row();
	        
	        $email_type = 'TWO_STEP_VERIFICATION';
	        $data['email_template'] = $this->email_model->get_email_template($email_type)->row();

	        $data['to'] = $email_id;
	        
	        $this->verification_model->updatePwdTwoStep($user_type,$user_id, $data['twoStepRandomNumber']);
	        
			if($response = $this->email_model->twoStepVerifyEmail_send($data)) {
				if(!empty($ajaxRequest) && $ajaxRequest==1 ) {
					$response = array('verifyType' => $verifyType, 'status' => 1);
					echo json_encode($response);
				} else {
					$data['verify_type'] = $verifyType;
					$this->load->view('security/verification_mobile_email', $data);	
				}
			}
		} 
		else if($veriType == 2){
			$verifyType = $this->checkVerificationType($user_id, $user_type);
			$data['twoStepRandomNumber'] = $this->generate_random_key(4); //generate random number
			
			$data['user_data'] = $this->account_model->getUserInfoEmail($email_id)->row();

			$user_contact_no = $data['user_data']->contact_no;
			
          

  
			$this->verification_model->updatePwdTwoStep($user_type, $user_id, $data['twoStepRandomNumber']);
			  $response = $this->sms_model->send_verifytwostep_sms($user_contact_no,$data['twoStepRandomNumber']);
			//$response = file(WEB_URL.'/security/mobile_test?test=hello world'); //get response from the url
		//	$response = file($sms_url); //get response from the url
			//echo '<pre>';print_r($response);die;
			
			if($response != "") {
				$response_array = explode(' ', $response[0]);
				
				$response_code_array = explode(';', $response[0]);
				$response_sms_global_id_array = explode(' ', $response_code_array[1]);
				$response_sms_global_id = $response_sms_global_id_array[6];
				$sms_global_id_array = explode(':', $response_sms_global_id);
				$sms_global_id = $sms_global_id_array[1];

				if($response_array[0] === "OK:" && $response_array[1] === "0;") {
					if(!empty($ajaxRequest) && $ajaxRequest==1 ) {
						$response = array('verifyType' => $verifyType, 'status' => 1);
						echo json_encode($response);
					} else {
						$data['verify_type'] = $verifyType;
						$this->load->view('security/verification_mobile_email', $data);	
					}
				}
			}
			
		}
	}

	public function mobile_test() {   //Testing function for sms module..
		$get_var = $this->input->get('test');
		if($get_var != "") {
			echo '';
		} else {
			echo "";
		}
		
	}

	public function problemLogIn() {
		$user_id = $this->session->userdata('temp_b2c_id');
		if($user_id != "") {
			$data['security_question'] = $this->verification_model->getSecurityQuestion($user_id);
			$this->load->view('security/problem_log_in', $data);	
		} else {
			redirect(WEB_URL);
		}
	}

	public function checkSecurityAnswer() {
		$user_id = $this->session->userdata('temp_b2c_id');
		$question = $this->input->post('qus');
		$answer = $this->input->post('ansec');
		
		$question_case = strtolower($question);
		$answer_case = strtolower($answer);

		$getData = $this->verification_model->checkSecurityAnswer($user_id);
		if($getData->security_question == $question && $getData->security_answer == $answer_case) {
			$this->session->set_userdata('temp_probLogin', 'PROB_LOGIN_SESSION');
			$response = array('status'=>1);
			echo json_encode($response);
		} else {
			$response = array('status'=>0);
			echo json_encode($response);
		}
	}

	 public function loginBySecurityAnswer() {
	 	$getRedirectUrl = $_SERVER['QUERY_STRING'] ? $_SERVER['QUERY_STRING'] : '';
	 	if($getRedirectUrl != '') {
		 	$redirectUrlArray = explode('url=', $getRedirectUrl);
		 	if($redirectUrlArray[1] != '') {
		 		$redirectUrl = $redirectUrlArray[1];	
		 	}
		 } else {
		 	$redirectUrl = WEB_URL;
		 }
	 	
    	$user_id = $this->session->userdata('temp_b2c_id');
    	$checkSession = $this->session->userdata('temp_probLogin');

    	if($checkSession === 'PROB_LOGIN_SESSION' && $user_id != "" ) {
    		$b2c_session =  array(
				                'b2c_id' => $user_id,
				                'user_type' => '3',
				                'provider' => 'Ticketfinder'
			            	);
	    	$this->session->set_userdata($b2c_session);



	    	redirect($redirectUrl);

    	} else {
    		redirect(WEB_URL);
    	}
    	
    }
 
 	public function cancelAccountVerificationChk() {
 		if($this->isTwoStepEnabled()) {          /*Check if the two step verification is enabled or not.*/
 			if($this->session->userdata('b2c_id')){
				$user_id = $this->session->userdata('b2c_id');
				$user_type = 3;
			}else if($this->session->userdata('b2b_id')){
				$user_id = $this->session->userdata('b2b_id');
				$user_type = 2;
			}
			if($this->checkVerificationType($user_id, $user_type) == 1) { 			//check which type of verification user has enabled
				$response = array('status'=>1, 'enabled'=>1, 'ver'=>1);
			} else if($this->checkVerificationType($user_id, $user_type) == 2) {
				$response = array('status'=>1, 'enabled'=>1, 'ver'=>2);
			} else {
				$response = array('status'=>0, 'enabled'=>1, 'ver'=>'ERR');
			}
 		} else {
			$response = array('status'=>0, 'enabled'=>0, 'ver'=>0);
 		}

 		echo json_encode($response);
 	}

 /*Checks the verification type: email or mobile*/
	public function checkVerificationType($user_id, $user_type) {
		return $this->verification_model->checkVerificationType($user_id,$user_type);
	}

	public function generate_random_key($length = 50) {
        $alphabets = range('A','Z');
        $numbers = range('0','9');
        $final_array = array_merge($alphabets,$numbers);
        $id = '';
        while($length--) {
          $key = array_rand($final_array);
          $id .= $final_array[$key];
        }
        return $id;
    }

    public function verifyTwoStepPassword() {
    	//$user_id = $this->session->userdata('temp_b2c_id');
    	if($this->session->userdata('temp_b2c_id')){
			$user_id = $this->session->userdata('temp_b2c_id');
			$user_type = 3;
		}else if($this->session->userdata('temp_b2b_id')){
			$user_id = $this->session->userdata('temp_b2b_id');
			$user_type = 2;
		}
    	$twoStepPwd = $this->input->post('twoStepPwd');
    	
    	if($userData = $this->verification_model->verifyTwoStepPassword($user_type,$user_id, $twoStepPwd)) {
			if(!empty($userData)) {
				if($this->session->userdata('temp_b2c_id')){
					$b2c_session =  array(
		                'b2c_id' => $userData->user_id,
		                'user_type' => '3',
		                'provider' => 'Ticketfinder'
	            	);
		    		$this->session->set_userdata($b2c_session);
				}else if($this->session->userdata('temp_b2b_id')){
					$b2c_session =  array(
		                'b2b_id' => $userData->agent_id,
		                'user_type' => '2',
		                'provider' => 'Ticketfinder'
	            	);
		    		$this->session->set_userdata($b2c_session);
				}
	    		
	    		$response = array('status' => '1');
    		} else {
    			$response = array('status' => '0');	
    		}    		
    	} else {
    		$response = array('status' => '0');
    	}
    	echo json_encode($response);
    }



    public function verifyTwoStepSMSPassword() {
    	//$user_id = $this->session->userdata('temp_b2c_id');
    	if($this->session->userdata('temp_b2c_id')){
			$user_id = $this->session->userdata('temp_b2c_id');
			$user_type = 3;
		}else if($this->session->userdata('temp_b2b_id')){
			$user_id = $this->session->userdata('temp_b2b_id');
			$user_type = 2;
		}
    	$twoStepPwd = $this->input->post('twoStepPwd');

    	if($userData = $this->verification_model->verifyTwoStepPassword($user_type,$user_id, $twoStepPwd)) {
			if(!empty($userData)) {
	    		if($this->session->userdata('temp_b2c_id')){
					$b2c_session =  array(
		                'b2c_id' => $userData->user_id,
		                'user_type' => '3',
		                'provider' => 'Ticketfinder'
	            	);
		    		$this->session->set_userdata($b2c_session);
				}else if($this->session->userdata('temp_b2b_id')){
					$b2c_session =  array(
		                'b2b_id' => $userData->agent_id,
		                'user_type' => '2',
		                'provider' => 'Ticketfinder'
	            	);
		    		$this->session->set_userdata($b2c_session);
				}
	    		$response = array('status' => '1');
    		} else {
    			$response = array('status' => '0');	
    		}    		
    	} else {
    		$response = array('status' => '0');
    	}
    	echo json_encode($response);

    }

    public function getUserInfo($b2c_id) {
    	return $this->verification_model->reVerifyQuesAns($b2c_id);
    }

    public function sendVerifyMobileNumber() {
    	$phoneNumber = $this->input->post("m_n");
    	$this->session->set_userdata('contact_no', $phoneNumber);
		
		if($this->session->userdata('b2c_id')){
		    $data['user_type']=$user_type = 3;
		    $data['user_id']=$user_id = $this->session->userdata('b2c_id');
		}else if($this->session->userdata('b2b_id')){
		    $data['user_type']=$user_type = 2;
		    $data['user_id']=$user_id = $this->session->userdata('b2b_id');
		}

    	$data['twoStepRandomNumber'] = $this->generate_random_key(4); //generate random number
		$this->verification_model->updatePwdTwoStep($user_type, $user_id, $data['twoStepRandomNumber']);

		if(ctype_digit($phoneNumber)) {
			$user_contact_no = $phoneNumber;	
		} else {
			$response = array('status' => 0);
			echo json_encode($response);
			return false;
		}
		


		//$response = file(WEB_URL.'/security/mobile_test?test=hello world'); //get response from the url
		//$response = file($sms_url); //get response from the url
			 $response = $this->sms_model->send_verifytwostep_sms($user_contact_no,$data['twoStepRandomNumber']);
		if($response != "") {
			$response_array = explode(' ', $response[0]);

			$response_code_array = explode(';', $response[0]);
			$response_sms_global_id_array = explode(' ', $response_code_array[1]);
			$response_sms_global_id =  $response_sms_global_id_array[6];
			$sms_global_id_array = explode(':', $response_sms_global_id);
			$sms_global_id = $sms_global_id_array[1];

			if($response_array[0] === "OK:" && $response_array[1] === "0;") {
				$response = array('status' => 1);
				echo json_encode($response);
			} else {
				$response = array('status' => 0);
				echo json_encode($response);
			}
		}
		
    }

    public function verifyMobileNumber() {
    	//$user_id = $this->session->userdata("b2c_id");
    	if($this->session->userdata('b2c_id')){
			$user_id = $this->session->userdata('b2c_id');
			$user_type = 3;
		}else if($this->session->userdata('b2b_id')){
			$user_id = $this->session->userdata('b2b_id');
			$user_type = 2;
		}
    	$verifyCode = $this->input->post('e_c');
    	if($verifyCode != "") {
    		if($verifyCodeDb = $this->verification_model->verifyTwoStepPassword($user_type,$user_id, $verifyCode)) {
    			$contact = $this->session->userdata('contact_no');
    			if($this->verification_model->updateUserContact($user_id, $contact)) {
    				if($this->verification_model->activateB2cMobileVerification($user_id)) {
    					$response = array('status' => 1);
						echo json_encode($response);
    				}
    			}
    		
    		} else {
    			$response = array('status' => 0);
				echo json_encode($response);
    		}
    	}
    }

	public function cancelAccountSendCode() {

		if($this->session->userdata('b2c_id')){
			$user_id = $this->session->userdata('b2c_id');
			$user_type = 3;
		}else if($this->session->userdata('b2b_id')){
			$user_id = $this->session->userdata('b2b_id');
			$user_type = 2;
		}
		$verType = $this->input->post('ver');

		if($verType == 1) {
			
			$data['twoStepRandomNumber'] = $this->generate_random_key(4); //generate random number

			$data['user_data'] = $user_data = $this->account_model->GetUserData($user_type, $user_id)->row();
			
        	$data['email_access'] = $this->email_model->get_email_acess()->row();
	        if($user_type == 3){
				$data['to'] = $user_data->email;
			}else if($user_type == 2){
				$data['to'] = $user_data->email_id;
			}
	        $email_type = 'TWO_STEP_VERIFICATION';
	        $data['email_template'] = $this->email_model->get_email_template($email_type)->row();

	        
	        $this->verification_model->updatePwdTwoStep($user_type, $user_id, $data['twoStepRandomNumber']);

			if($response = $this->email_model->twoStepVerifyEmail_send($data)) {
				$response = array('verifyType' => $verType, 'status' => 1);
				echo json_encode($response);
			} else {
				$response = array('verifyType' => $verType, 'status' => 0);
				echo json_encode($response);
			}
		} else if($verType == 2){

			$data['twoStepRandomNumber'] = $this->generate_random_key(4); //generate random number
			
			$data['user_data'] = $user_data = $this->account_model->GetUserData($user_type, $user_id)->row();

			if($this->session->userdata('b2c_id')){
				$user_contact_no = $data['user_data']->contact_no;
			}else if($this->session->userdata('b2b_id')){
				$user_contact_no = $data['user_data']->mobile;
			}
			//$user_contact_no = $data['user_data']->contact_no;
		

			$this->verification_model->updatePwdTwoStep($user_id, $data['twoStepRandomNumber']);
			
			//$response = file(WEB_URL.'/security/mobile_test?test=hello world'); //get response from the url
			//$response = file($sms_url); //get response from the url
			 $response = $this->sms_model->send_verifytwostep_sms($user_contact_no,$data['twoStepRandomNumber']);
			if($response != "") {
				$response_array = explode(' ', $response[0]);
				
				$response_code_array = explode(';', $response[0]);
				$response_sms_global_id_array = explode(' ', $response_code_array[1]);
				$response_sms_global_id =  $response_sms_global_id_array[6];
				$sms_global_id_array = explode(':', $response_sms_global_id);
				$sms_global_id = $sms_global_id_array[1];

				if($response_array[0] === "OK:" && $response_array[1] === "0;") {
					$response = array('verType' => $verType, 'status' => 1);
					echo json_encode($response);	
				}
			}
			
		}
	}

	public function cancelAccountVerifyPswd() {
    	if($this->session->userdata('b2c_id')){
		    $data['user_type']=$user_type = 3;
		    $data['user_id']=$user_id = $this->session->userdata('b2c_id');
		}else if($this->session->userdata('b2b_id')){
		    $data['user_type']=$user_type = 2;
		    $data['user_id']=$user_id = $this->session->userdata('b2b_id');
		}

    	$twoStepPwd = $this->input->post('twoStepPwd');
    	
    	if($userData = $this->verification_model->verifyTwoStepPassword($user_type, $user_id, $twoStepPwd)) {
    		$cancelKey = 'CANCELACCOUNTDATA'.$user_id;
    		$this->session->set_userdata('cancel_key', $cancelKey);  //verify this when cancelling function is called
		    $response = array('status' => '1'); 		
    	} else {
    		$response = array('status' => '0');
    	}
    	echo json_encode($response);
    }

    public function cancelAccountData() { 
    	if($this->session->userdata('b2c_id')){
		    $data['user_type']=$user_type = 3;
		    $data['user_id']=$user_id = $this->session->userdata('b2c_id');
		}else if($this->session->userdata('b2b_id')){
		    $data['user_type']=$user_type = 2;
		    $data['user_id']=$user_id = $this->session->userdata('b2b_id');
		}
    	$cancelKey = $this->session->userdata('cancel_key');
    	if(isset($cancelKey) && $cancelKey != "" && $cancelKey == 'CANCELACCOUNTDATA'.$user_id) {
    		if($this->createCancelDataDump($user_id, $user_type)) {
    			$this->deleteUser($user_id, $user_type);
    		}
    	}
    }

//  Create text file dump for the current user.
    public function createCancelDataDump($user_id, $user_type) {
    	$all_user_data = $this->account_model->GetUserData($user_type, $user_id)->row();
    	$filename = "cancel_user_".$user_id.".txt";

    	$fh = fopen('cancel_account_dump/'.$filename, "w");
		foreach($all_user_data as $key => $value) {
			$stringData = $key.":".$value."\n";
			fwrite($fh, $stringData);
		}

		return true;
    }

    public function checkEmailVerification($user_id, $user_type) {
    	return $this->verification_model->checkEmailVerification($user_id, $user_type);
    }

    public function checkPswrdAvail() {
   		if($this->session->userdata('b2c_id')){
    		$data['user_type']=$user_type = 3;
    		$data['user_id']=$user_id = $this->session->userdata('b2c_id');
		}else if($this->session->userdata('b2b_id')){
    		$data['user_type']=$user_type = 2;
    		$data['user_id']=$user_id = $this->session->userdata('b2b_id');
		}

		if($user_type == 3) {
			$checkPswrd = $this->account_model->checkPswrdAvail($user_id);	
		} else if($user_type == 2) {
			$checkPswrd = $this->account_model->B2b_checkPswrdAvail($user_id);	
		}


    	if(trim($checkPswrd->password) == "" && isset($checkPswrd->password)) {
    		$checkEmailVer = $this->checkEmailVerification($user_id, $user_type);

    		if(empty($checkEmailVer)) {
 				$response = array('status'=>0, 'pswrdAvail'=>0, 'emailVerified'=>0);
 				echo json_encode($response);  //will cause redirect to verification page
    		} else {
    			$response = array('status'=>0, 'pswrdAvail'=>0, 'emailVerified'=>1);
    			echo json_encode($response);  //will send verification code
    		}
    	} else {
    		$response = array('status'=>1, 'pswrdAvail'=>1, 'emailVerified'=>2); //password is present already
    		echo json_encode($response);
    	}
    }

    public function deleteUser($user_id, $user_type) {
    	
    	if($user_type == 3) {
	    	if($this->logout_auth('Ticketfinder', $user_id, $user_type)) { 
		    	$this->account_model->deleteUserAccount($user_id); 
		    	$this->account_model->deleteb2cverification($user_id, $user_type); 
		    	$this->account_model->deleteWishlist($user_id, $user_type); 
		    	$this->account_model->deleteWishlist_type($user_id, $user_type); 
		    	$this->account_model->deleteSMSalertType($user_id, $user_type);

		    	$support_ticket_num = $this->account_model->getSupportTicketNumber($user_id, $user_type)->result();

				if(!empty($support_ticket_num)) {
			    	foreach($support_ticket_num as $supp_num_key) {
			    		$this->account_model->deleteSupportTicketHistory($supp_num_key->support_ticket_id);	
			    	}
		    	}
		    	$this->account_model->deleteSupportTicket($user_id, $user_type);
	    		
	    		$this->account_model->deleteMessagesInit($user_id, $user_type);
	    		$this->account_model->deleteMessagesRece($user_id, $user_type);
	    		$this->account_model->deleteReference($user_id, $user_type);
	    		
	    		$this->account_model->deleteReviewGuestBy($user_id, $user_type);
	    		$this->account_model->deleteReviewGuestTo($user_id, $user_type);
	    		
	    		$this->account_model->deleteReviewGuestDataTo($user_id, $user_type);
	    		$this->account_model->deleteReviewGuestDataHost($user_id, $user_type);

	    		$this->account_model->deleteReviewHostTo($user_id, $user_type);
	    		$this->account_model->deleteReviewHostBy($user_id, $user_type);

	    		$this->account_model->deleteReviewHostDataTo($user_id, $user_type);
	    		$this->account_model->deleteReviewHostDataBy($user_id, $user_type);

	    		$this->account_model->deleteReviewUserTo($user_id, $user_type);
	    		$this->account_model->deleteReviewUserBy($user_id, $user_type);

	    		$this->account_model->deleteReviewUserDataTo($user_id, $user_type);
	    		$this->account_model->deleteReviewUserDataBy($user_id, $user_type);


	    		$response = array('status'=>1, 'success'=>1);
	    		echo json_encode($response);
	    	}
	    } else if($user_type == 2) {
	    	if($this->logout_auth('Ticketfinder', $user_id, $user_type)) { 
		    	$this->account_model->b2b_deleteUserAccount($user_id); 
		    	$this->account_model->b2b_deleteb2cverification($user_id, $user_type); 
		    	$this->account_model->b2b_deleteWishlist($user_id, $user_type); 
		    	$this->account_model->b2b_deleteWishlist_type($user_id, $user_type); 
		    	$this->account_model->b2b_deleteSMSalertType($user_id, $user_type); 
	    	
	    		$support_ticket_num = $this->account_model->getSupportTicketNumber($user_id, $user_type)->result();
		    	foreach($support_ticket_num as $supp_num_key) {
		    		$this->account_model->deleteSupportTicketHistory($supp_num_key->support_ticket_id);	
		    	}
		    	$this->account_model->deleteSupportTicket($user_id, $user_type);
		    	
		    	$this->account_model->deleteB2bAccountInfo($user_id);
		    	$this->account_model->deleteB2bDeposit($user_id); 
		    	$this->account_model->deleteB2bTopCities($user_id);
		    	$this->account_model->deleteMessagesInit($user_id, $user_type);
	    		$this->account_model->deleteMessagesRece($user_id, $user_type);
	    		
	    		$this->account_model->deleteReference($user_id, $user_type);

	    		$this->account_model->deleteReviewGuestBy($user_id, $user_type);
	    		$this->account_model->deleteReviewGuestTo($user_id, $user_type);
	    		
	    		$this->account_model->deleteReviewGuestDataTo($user_id, $user_type);
	    		$this->account_model->deleteReviewGuestDataHost($user_id, $user_type);

	    		$this->account_model->deleteReviewHostTo($user_id, $user_type);
	    		$this->account_model->deleteReviewHostBy($user_id, $user_type);

	    		$this->account_model->deleteReviewHostDataTo($user_id, $user_type);
	    		$this->account_model->deleteReviewHostDataBy($user_id, $user_type);

	    		$this->account_model->deleteReviewUserTo($user_id, $user_type);
	    		$this->account_model->deleteReviewUserBy($user_id, $user_type);

	    		$this->account_model->deleteReviewUserDataTo($user_id, $user_type);
	    		$this->account_model->deleteReviewUserDataBy($user_id, $user_type);



	    		$response = array('status'=>1, 'success'=>1);
	    		echo json_encode($response);
	    	}
	    }
    }

    public function logout_auth($provider, $user_id, $user_type){
        $update = array(
            'logged_in' => '0'
        );
        $b2c_id = $this->Auth_Model->logout_auth($update,$user_id, $user_type);
        $this->session->unset_userdata('sessionUserInfo');
        $this->session->sess_destroy();
        return true;
    }

    public function cancelAccountOneStepVerifyPswd() {
		if($this->session->userdata('b2c_id')){
		    $data['user_type']=$user_type = 3;
		    $data['user_id']=$user_id = $this->session->userdata('b2c_id');
		}else if($this->session->userdata('b2b_id')){
		    $data['user_type']=$user_type = 2;
		    $data['user_id']=$user_id = $this->session->userdata('b2b_id');
		}

    	$passwrd = $this->input->post('oneStepPwd');

    	$userInfo = $this->account_model->GetUserData($user_type, $user_id)->row();
    	if($userInfo->password == $passwrd) {
    		if($this->createCancelDataDump($user_id, $user_type)) {
    			$this->deleteUser($user_id, $user_type);
    		}
    	} else {
    		echo "wrong password";
    	}

    }
    
}

/*End of 2-step verification module*/
