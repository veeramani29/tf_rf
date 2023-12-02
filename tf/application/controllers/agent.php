<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agent extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('Auth_Model');
        /*$current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
        $current_url = $this->config->site_url().$this->uri->uri_string(). $current_url;
        $url =  array(
            'continue' => $current_url,
        );
        $this->session->set_userdata($url);*/
        $this->load->model('Help_Model');
        $this->load->model('account_model');
        $this->load->model('Wishlist_Model');
        $this->load->model('email_model');
        $this->load->model('reference_model');
        $this->helpMenuLink = $this->Help_Model->fetchHelpLinks();
   
       
    }

	public function index(){
		//$this->load->view('agent/login');	
	}

	public function login(){
        $data['country_code'] = $this->reference_model->getCountryCode();
        $check_agent_id = $this->session->userdata('b2b_id');
        if($check_agent_id == "") {
            $this->load->view('account/agent/login', $data);        
        } else {
            redirect(WEB_URL);
        }
		
	}
public function verification($vid=''){
        $data['country_code'] = $this->reference_model->getCountryCode();
		
		 
        $check_agent_id = $this->session->userdata('b2b_id');
        if($check_agent_id == "" && $vid!='') {
			$data['vid'] = $vid;
			$get_acc_details = $this->account_model->verifyAgentContactDetails_v2($vid)->row();
			if($get_acc_details->status=='-1')
			{
            $this->load->view('account/agent/verfication_agent', $data);        
			}
			else {
            redirect(WEB_URL);
       		}
        } else {
            redirect(WEB_URL);
        }
		
	}
    public function create(){
        
        //process logo image {
        
        $logo_image = explode(".",$_FILES["agent_logo"]["name"]);
        $newlogoname = rand(1,99999) . '.' .end($logo_image);
        
        $tmpnamert=$_FILES['agent_logo']['tmp_name'];
        $dir = "assets/upload_files/b2b_logo/";
        move_uploaded_file($tmpnamert, ADMIN_UPLOAD_PATH.'1/b2b/images/'.$newlogoname);

        //process logo image }        
        
        $country_code = $this->input->post('country_code');
        $mobile_number = $this->input->post('contact_no');  
        $country_code_sr = str_replace("+","",$country_code);      
        $int_mobile_num = $country_code_sr.$mobile_number; //international mobile number
        $email_opt_number = $this->generate_random_key(4, 'SPECIAL');
        $mobile_opt_number = $this->generate_random_key(4, 'SPECIAL');
		$verifi_str = $this->generate_random_key(50);
        $random_url_string = WEB_URL.'/agent/verification/'.$verifi_str;



        $postData = array(
            'firstname' => $this->input->post('fname'),
            'lastname' => $this->input->post('lname'),
            'email_id' => $this->input->post('email'),
            'password' => $this->input->post('pswd'),
            'company_name' => $this->input->post('company'),
            'mobile' => $int_mobile_num,
            'register_date' => date('Y-m-d H:i:s'),
            'status' => '-1',
            'logged_in' => '0',
            'agent_logo' =>  UPLOAD_PATH.'1/b2b/images/'.$newlogoname,
            'temp_email_opt' => $email_opt_number,
            'temp_mobile_opt' => $mobile_opt_number,
            'url_string' => $random_url_string,
			'verification_code' => $verifi_str
        );

        $count = $this->account_model->isAgentRegistered($this->input->post('email'))->num_rows();
        if($count == 0){
            $this->account_model->createAgent($postData);
            $user_data = $this->account_model->isAgentRegistered($this->input->post('email'))->row();
			
			$this->account_model->assignDefaultverfication_agent($user_data->agent_id,2);
            $this->Wishlist_Model->assignDefaultWishlist($user_data->agent_id,2);
            $response = array(
                'status' => '1',
                'success' => 'true',
                'msg' => 'Successfully Registered!, please check your mail for login credentials',
                'rid' => $user_data->agent_id,
                'fname' =>  $user_data->firstname
            );
            
            $this->initializeAccountInfo($user_data->agent_id);
            $this->get_email_content($user_data->agent_id, 'AgentRegistration');
            $this->send_verification_email($user_data->agent_id, 'AGENT_VERIFICATION_CODE', $email_opt_number);
            $this->send_mobileVerification($user_data->agent_id, $int_mobile_num, $mobile_opt_number);

            $this->session->set_userdata('agent_id', $user_data->agent_id);

        }else{
            $response = array(
                'status' => '0',
                'success' => 'false',
                'msg' => 'That email address is already in use. Please log in using credentials.'
            );
        }
        echo json_encode($response);
    }

    public function initializeAccountInfo($agent_id) {
        $this->account_model->initializeAccountInfo_model($agent_id);
        return true;
    }

    public function verifyContactDetails() {

        $email_code = $this->input->post('veri_email');
        $mobile_code = '';

        $agent_id = $this->session->userdata('agent_id'); //get the agent id, set during signing up
        if($agent_id != "") {

           //verify the codes entered by the user.
           $verify_count = $this->account_model->verifyAgentContactDetails($agent_id, $email_code, $mobile_code)->num_rows();
           if($verify_count == 1) {

                $this->account_model->changeAgentStatus($agent_id);
                $getUserInfo = $this->account_model->GetUserData('2', $agent_id)->row();
                $user_verification_data = array('user_type'=>2, 'user_id'=>$agent_id, 'email'=>'1', 'mobile'=>'1', 'two_step_verification'=>'0', 'two_step_type'=>0);
                $this->account_model->insertInUserVerification($user_verification_data);
                $response = array('status'=>1, 'msg'=>'correct');
           } else {
                $response = array('status'=>0, 'msg'=>'Wrong credentials entered.');
           }
        } else {
            $response = array('status'=>2, 'msg'=>'Error occured, Please try in few moments.');
        }

        echo json_encode($response);
    }

  public function verifyContactDetails_v1() {
        $email_code = $this->input->post('veri_email');
        $mobile_code = $this->input->post('veri_mobile');
		$vid = $this->input->post('SKsdjaernHJHD');
		$check_agent_id = $this->session->userdata('b2b_id');
        if($check_agent_id == "") {
			
		if($vid != "") {
           $verify_count = $this->account_model->verifyAgentContactDetails_v1($vid, $email_code, $mobile_code)->num_rows();
           if($verify_count == 1) {
			    $get_acc_details = $this->account_model->verifyAgentContactDetails_v1($vid, $email_code, $mobile_code)->row();
                $this->account_model->changeAgentStatus($get_acc_details->agent_id);
                $response = array('status'=>1, 'msg'=>'correct');
           } else {
                $response = array('status'=>0, 'msg'=>'Wrong credentials entered.');
           }
        } else {
            $response = array('status'=>2, 'msg'=>'Error occured, Please try in few moments.');
        }
		}
		else
		{
			 $response = array('status'=>2, 'msg'=>'Error occured, You have already loggedin.');
		}
        echo json_encode($response);
    }

    public function loginn(){

        $this->checkLoginStatus();  //check if b2c is already present or not. If present than destroy it's session.

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $refferer = $this->input->post('refferer');
        $count = $this->account_model->isAgentRegistered($email)->num_rows();  //check for the email
        $this->cart_model->removeAllCart(); //Clear all cart items
        if($count == 1){ //if count ='s one then move fwd
            $userInfo = $this->account_model->isAgentRegistered($email)->row(); //check if registered user or not
            if($userInfo->status == 1){   
                $count = $this->account_model->isValidAgent($email,$password)->num_rows(); //check username and password
                if($count == 1){  //give invalid password
                    $user_data = $this->account_model->isValidAgent($email,$password)->row(); //get the user data b2c id etc 
                    $b2b_session =  array(
                        'b2b_id' => $user_data->agent_id,
                        'user_type' => '2',
                        'provider' => 'Ticketfinder'
                    );

                    //check if two step verification is enabled
                    $checkVeriType = $this->account_model->checkTwoStepVerification($user_data->agent_id,2);
                    if(!empty($checkVeriType) && $checkVeriType != "" ) {
                        if($checkVeriType->two_step_verification == 1  && $checkVeriType->two_step_type > 0) {
                            $this->session->set_userdata('temp_b2b_id', $user_data->agent_id);   //setting temp_b2c_id
                            $this->session->set_userdata('temp_email_id', $user_data->email_id);   //setting temp_email_id

                            $response = array(
                                'status' => '2'
                            );
                        } else {
                            $this->session->set_userdata($b2b_session); //start session, log user in without two steps
                            $continue = WEB_URL.'/dashboard';
                            if($refferer != ""){
                                $refferer_decode = base64_decode($refferer);
                                if($refferer_decode == 'reference') { 
                                    $continue = $this->session->userdata('continue');
                                }
                            }
                            
                            $response = array(
                                'status' => '1',
                                'success' => 'true',
                                'msg' => 'Success!',
                                'rid' => $user_data->agent_id,
                                'fname' =>  $user_data->firstname,
                                'profile_photo' =>  $user_data->agent_logo,
                                'continue' => $continue
                            );
                        }
                    } else {
                        $this->session->set_userdata($b2b_session); //start session, log user in without two steps
                        //$continue = $this->session->userdata('continue');
                       
                        $continue = WEB_URL.'/dashboard';
                        if($refferer != ""){
                            $refferer_decode = base64_decode($refferer);
                            if($refferer_decode == 'reference') {
                                $continue = $this->session->userdata('continue');
                            }
                        }

                        $response = array(
                            'status' => '1',
                            'success' => 'true',
                            'msg' => 'Success!',
                            'rid' => $user_data->agent_id,
                            'fname' =>  $user_data->firstname,
                            'profile_photo' =>  $user_data->agent_logo,
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
        echo json_encode($response);
    }

    public function checkLoginStatus(){
        $this->session->unset_userdata('b2c_id');
        $this->session->unset_userdata('b2c_type');
        return true;
    }

    public function get_email_content($b2b_id, $email_type) {
        $data['user_data'] = $user_data = $this->account_model->GetUserData('2',$b2b_id)->row();
        //echo '<pre>';print_r($user_data);die;
        $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
        $data['social_url'] = array(
            'facebook_social_url' => 'https://www.facebook.com',
            'twitter_social_url' => 'https://twitter.com',
            'google_social_url' => 'https://google.com',
        );
        $email = $user_data->email_id;
        $data['email_access'] = $this->email_model->get_email_acess()->row();
        $this->email_model->sendmail_agentreg($data);
    }

    public function send_verification_email($b2b_id, $email_type, $email_opt_number) {
        $data['user_data'] = $user_data = $this->account_model->GetUserData('2',$b2b_id)->row();
        $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
        $data['random_code'] = $email_opt_number;
        $email = $user_data->email_id;
        $data['email_access'] = $this->email_model->get_email_acess()->row();
        $this->email_model->sendmail_agentVerification($data);
    }

    public function send_mobileVerification($b2b_id, $mobile_number, $mobile_opt_number) {
		
     
        $response = $this->sms_model->send_mobileVerification_sms($mobile_number,$mobile_opt_number); //get response from the url
        //echo '<pre>';print_r($response);die;   
        if($response != "") {
            $response_array = explode(' ', $response[0]);
            $response_code_array = explode(';', $response[0]);
            $response_sms_global_id_array = explode(' ', $response_code_array[1]);
            $response_sms_global_id = $response_sms_global_id_array[6];
            $sms_global_id_array = explode(':', $response_sms_global_id);
            $sms_global_id = $sms_global_id_array[1];

            if($response_array[0] === "OK:" && $response_array[1] === "0;") {
                return true;
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


    public function generate_random_key($length = '', $special=null) {
        $alphabets = range('A','Z');
        $numbers = range('0','9');
        if($special == 'SPECIAL') {                 //If SPECIAL, than put special characters
            $additional_characters = array('@','*','_');    
        } else {
            $additional_characters = array();       
        }
        
        $final_array = array_merge($alphabets,$numbers,$additional_characters);
             
        $id = '';
      
        while($length--) {
          $key = array_rand($final_array);
          $id .= $final_array[$key];
        }
        return $id;
    }

    public function confirm_login() {
        $this->load->view('account/agent/confirm_agent');
    }

    public function addMarkUp() {
        $markUp_obj = $this->input->post();
        $b2b_agent_id = $this->session->userdata('b2b_id');
        
        if($b2b_agent_id != "") {
            if(!empty($markUp_obj)) {
                $mark_up = $markUp_obj['agent_mark_up'];

                if($mark_up <= 100 && $mark_up >= 0) {
                    $markup_float = (float)$mark_up;
                    $data = array('markup'=>$markup_float);
                    $this->account_model->addMarkUp_model($b2b_agent_id, $data);
                    echo json_encode("DOne");
                }
            }
        } else{
            echo json_encode("value1");
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
