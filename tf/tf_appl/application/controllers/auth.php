<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Auth extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Auth_Model');
        $this->load->model('account_model');
        $this->load->model('email_model'); 
        $this->load->model('Help_Model');
		$this->load->model('Wishlist_Model');
        $this->helpMenuLink = $this->Help_Model->fetchHelpLinks(); 
    }

    public function index(){
        if ($this->session->userdata('b2c_id')) {
            $b2c_id = $this->session->userdata('b2c_id');
            $data['b2c_data'] = $b2c_data = $this->Auth_Model->getUserData($b2c_id);
            $data['provider'] = $b2c_data->loggedin_with;
            $this->load->view('auth/done',$data);
        }else{
            $this->load->view('auth/home');    
        }
        
    }

    public function login($provider,$type_login=''){
        //provider is Facebook, type_login is "Login"

        //log_message('debug', "controllers.HAuth.login($provider) called");
        if($type_login != ''){
            $this->preLogout($provider); //logout everything first
        }
        
        if ($this->session->userdata('login_type')) {
            $log = $this->session->userdata('login_type'); //set session for login type if already present
        }else{
            $login_type =  array(
                'login_type' => $type_login
            );
            $this->session->set_userdata($login_type);
        }
        $email = $this->input->post('email');

        if($provider == 'Twitter'){
            if($email != ''){
                try{
                    //log_message('debug', 'controllers.HAuth.login: loading HybridAuthLib');
                    $this->load->library('HybridAuthLib');

                    if ($this->hybridauthlib->providerEnabled($provider)){
                        $service = $this->hybridauthlib->authenticate($provider);

                        if ($service->isUserConnected()){
                            //log_message('debug', 'controller.HAuth.login: user authenticated.');
                            $user_profile = $service->getUserProfile();
                            //$user_contacts = $service->getUserContacts();

                            //log_message('info', 'controllers.HAuth.login: user profile:'.PHP_EOL.print_r($user_profile, TRUE));
                            $user_profile->email = $email;
                            $data['user_profile'] = $user_profile;
                            
                            $data['provider'] = $provider;
                            if($log == "login"){
                                $data['b2c_id'] = $this->login_auth($provider,$user_profile);
                            }else{
                                $data['b2c_id'] = $this->signup_auth($provider,$user_profile);
                            }

                            $status = $this->Auth_Model->check_islogged_in($data['b2c_id']);
                            if($status == 1){
                                $b2c_session =  array(
                                    'b2c_id' => $data['b2c_id'],
                                    'user_type' => '3',
                                    'provider' => $provider
                                );

                                //Two step verifications here...
                                
                                $checkVeriType = $this->account_model->checkTwoStepVerification($data['b2c_id'],3);
                                $emailObject = $data['user_profile'];
                                $email = $emailObject->email;
                                if(!empty($checkVeriType) && $checkVeriType != "" ) {
                                    if($checkVeriType->two_step_verification == 1  && $checkVeriType->two_step_type > 0) {
                                        $this->session->set_userdata('temp_b2c_id', $data['b2c_id']);   //setting temp_b2c_id
                                        $this->session->set_userdata('temp_email_id', $email);   //setting temp_email_id

                                        redirect(WEB_URL.'/security/verifytwostep'); //redirect to take in the verification codes.
                                    }
                                }


                                $this->session->set_userdata($b2c_session);
                                //$this->load->view('auth/done',$data);
                                $continue = $this->session->userdata('continue');
                                redirect($continue);
                            }else{
                               $this->logout($provider, $data['b2c_id'], $continue);
                                //echo 'coming'; die;
                            }
                            
                        }else {// Cannot authenticate user
                            show_error('Cannot authenticate user');
                        }
                    }else {// This service is not enabled.
                        //log_message('error', 'controllers.HAuth.login: This provider is not enabled ('.$provider.')');
                        show_404($_SERVER['REQUEST_URI']);
                    }
                }
                catch(Exception $e){
                    $error = 'Unexpected error';
                    switch($e->getCode())
                    {
                        case 0 : $error = 'Unspecified error.'; break;
                        case 1 : $error = 'Hybriauth configuration error.'; break;
                        case 2 : $error = 'Provider not properly configured.'; break;
                        case 3 : $error = 'Unknown or disabled provider.'; break;
                        case 4 : $error = 'Missing provider application credentials.'; break;
                        case 5 : log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
                                 //redirect();
                                 if (isset($service))
                                 {
                                    //log_message('debug', 'controllers.HAuth.login: logging out from service.');
                                    $service->logout();
                                 }
                                 show_error('User has cancelled the authentication or the provider refused the connection.');
                                 break;
                        case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
                                 break;
                        case 7 : $error = 'User not connected to the provider.';
                                 break;
                    }

                    if (isset($service)){
                        $service->logout();
                    }

                    //log_message('error', 'controllers.HAuth.login: '.$error);
                    show_error('Error authenticating user.');
                }
            }else{
                if($provider == 'Twitter'){
                    $this->load->view('account/b2c/twitterToken');
                }
            }
        }else{
            try{
                    //log_message('debug', 'controllers.HAuth.login: loading HybridAuthLib');
                    $this->load->library('HybridAuthLib');

                    if ($this->hybridauthlib->providerEnabled($provider)){
                        //log_message('debug', "controllers.HAuth.login: service $provider enabled, trying to authenticate.");
                        $service = $this->hybridauthlib->authenticate($provider);

                        if ($service->isUserConnected()){
                            //log_message('debug', 'controller.HAuth.login: user authenticated.');

                            $user_profile = $service->getUserProfile();
                            //$user_contacts = $service->getUserContacts();

                            //log_message('info', 'controllers.HAuth.login: user profile:'.PHP_EOL.print_r($user_profile, TRUE));
                            //$this->UserConnected($user_profile,$provider);

                            $data['user_profile'] = $user_profile;
                            //$user_contacts = '';
                            //$data['user_contacts'] = $user_contacts;
                            
                            $data['provider'] = $provider;
                            //$type_login = $type_login;
                            //$t = (string) 'login';
                            if($log == "login"){
                                $data['b2c_id'] = $this->login_auth($provider,$user_profile);
                            }else{
                                $data['b2c_id'] = $this->signup_auth($provider,$user_profile);
                            }

                            $status = $this->Auth_Model->check_islogged_in($data['b2c_id']);
                            if($status == 1){
                                $b2c_session =  array(
                                    'b2c_id' => $data['b2c_id'],
                                    'user_type' => '3',
                                    'provider' => $provider
                                );
                                //Two step verifications here...
                                
                                $checkVeriType = $this->account_model->checkTwoStepVerification($data['b2c_id'],3);
                                $emailObject = $data['user_profile'];
                                $email = $emailObject->email;
                                if(!empty($checkVeriType) && $checkVeriType != "" ) {
                                    if($checkVeriType->two_step_verification == 1  && $checkVeriType->two_step_type > 0) {
                                        $this->session->set_userdata('temp_b2c_id', $data['b2c_id']);   //setting temp_b2c_id
                                        $this->session->set_userdata('temp_email_id', $email);   //setting temp_email_id

                                        redirect(WEB_URL.'/security/verifytwostep'); //redirect to take in the verification codes.
                                    }
                                } else {
                                    $this->session->set_userdata($b2c_session);  //start the session with ones step login
                                    $continue = $this->session->userdata('continue');
                                    redirect($continue);
                                }

                                
                            }else{
                               $this->logout($provider, $data['b2c_id'], $continue);
                                //echo 'coming'; die;
                            }
                            
                        }else {// Cannot authenticate user
                            show_error('Cannot authenticate user');
                        }
                    }else {// This service is not enabled.
                        //log_message('error', 'controllers.HAuth.login: This provider is not enabled ('.$provider.')');
                        show_404($_SERVER['REQUEST_URI']);
                    }
                }
                catch(Exception $e){
                    $error = 'Unexpected error';
                    switch($e->getCode())
                    {
                        case 0 : $error = 'Unspecified error.'; break;
                        case 1 : $error = 'Hybriauth configuration error.'; break;
                        case 2 : $error = 'Provider not properly configured.'; break;
                        case 3 : $error = 'Unknown or disabled provider.'; break;
                        case 4 : $error = 'Missing provider application credentials.'; break;
                        case 5 : log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
                                 //redirect();
                                 if (isset($service))
                                 {
                                    //log_message('debug', 'controllers.HAuth.login: logging out from service.');
                                    $service->logout();
                                 }
                                 show_error('User has cancelled the authentication or the provider refused the connection.');
                                 break;
                        case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
                                 break;
                        case 7 : $error = 'User not connected to the provider.';
                                 break;
                    }

                    if (isset($service))
                    {
                        $service->logout();
                    }

                    //log_message('error', 'controllers.HAuth.login: '.$error);
                    show_error('Error authenticating user.');
                }
        }
    }

    

    public function endpoint()
    {

        //log_message('debug', 'controllers.HAuth.endpoint called.');
        //log_message('info', 'controllers.HAuth.endpoint: $_REQUEST: '.print_r($_REQUEST, TRUE));

        if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            log_message('debug', 'controllers.HAuth.endpoint: the request method is GET, copying REQUEST array into GET array.');
            $_GET = $_REQUEST;
        }

        //log_message('debug', 'controllers.HAuth.endpoint: loading the original HybridAuth endpoint script.');
        require_once APPPATH.'/third_party/hybridauth/index.php';

    }

    public function logout($provider, $b2c_id, $current_url){
        if($provider == 'Ticketfinder'){
            $this->logout_auth($provider,$b2c_id);
            $current_url = base64_decode($current_url);
            redirect($current_url);
        }else{
            $this->load->library('HybridAuthLib');
            $service = $this->hybridauthlib->authenticate($provider);
            $user_profile = $service->logout();
            $this->logout_auth($provider,$b2c_id);
            $current_url = base64_decode($current_url);
            redirect($current_url);
        }
    }
/*
|--------------------------------------------------------------------------|
| Author: Provab Technosoft Pvt Ltd.                                       |
|--------------------------------------------------------------------------|
| Developer: Provab                                              |
| Started Date: 2014-08-06T16:28:00                                        |
| Ended Date:                                                              |
|--------------------------------------------------------------------------|
*/  
    public function preLogout($provider){
        $this->load->library('HybridAuthLib');
        $service = $this->hybridauthlib->logoutAllProviders();
       
    }

    public function UserConnected($user_profile,$provider){
        $data['user_profile'] = $user_profile;
        //$user_contacts = '';
        //$data['user_contacts'] = $user_contacts;
        
        $data['provider'] = $provider;
        $data['b2c_id'] = $this->login_auth($provider,$user_profile);
        $status = $this->Auth_Model->check_islogged_in($data['b2c_id']);
        if($status == 1){
            $b2c_session =  array(
                'b2c_id' => $data['b2c_id'],
                'user_type' => '3',
                'provider' => $provider
            );
            $this->session->set_userdata($b2c_session);
            $this->load->view('auth/done',$data);
        }else{
            $this->logout($provider, $data['b2c_id']);
        }
    }
    public function login_auth($provider,$user_profile){
        $auth_id = $user_profile->auth_id;
        if($user_profile->DOB == NULL){
            $DOB = '0000-00-00';
        } else {
            $DOB = $user_profile->DOB;
        }

        switch ($provider) {
          case "Facebook":
            $facebook_id = $user_profile->auth_id;
            $google_id = '';
            $twitter_id = '';
            $dob = $DOB;
            $lastName = $user_profile->lastName;
            break;
          case "Google":
            $facebook_id = '';
            $google_id = $user_profile->auth_id;
            $twitter_id = '';
            $dob = $DOB;
            $lastName = $user_profile->lastName;
            break;
          case "Twitter":
            $facebook_id = '';
            $google_id = '';
            $twitter_id = $user_profile->auth_id;
            $dob = '';
            $lastName = '';
            break;
        }

        $login = array(
            'usertype' => 3,
            'domain' => 1,
            'facebook_id' => $facebook_id,
            'google_id' => $google_id,
            'twitter_id' => $twitter_id,
            'email' => $user_profile->email,
            'profile_photo' => $user_profile->photoURL,
            'firstname' => $user_profile->firstName,
            'lastName' => $lastName,
            'dob' => $dob,
            'address' => $user_profile->region,
            'postal_code' => $user_profile->zip,
            'status' => '0',
            'logged_in' => '1',
            'loggedin_with' => $provider
        );
        //echo '<pre>';print_r($post);
        $email = $user_profile->email;
        $count = $this->Auth_Model->isRegistered($email)->num_rows();
        if($count == 1){
            switch ($provider) {
              case "Facebook":
                $update = array(
                    'facebook_id' => $facebook_id,
                    'profile_photo' => $user_profile->photoURL,
                    'firstname' => $user_profile->firstName,
                    'lastName' => $user_profile->lastName,
                    'logged_in' => '1',
                    'loggedin_with' => $provider
                );
                break;
              case "Google":
                $update = array(
                    'google_id' => $google_id,
                    'profile_photo' => $user_profile->photoURL,
                    'firstname' => $user_profile->firstName,
                    'lastName' => $user_profile->lastName,
                    'logged_in' => '1',
                    'loggedin_with' => $provider
                );
                break;
              case "Twitter":
                $update = array(
                    'twitter_id' => $twitter_id,
                    'firstname' => $user_profile->firstName,
                    'lastName' => $user_profile->lastName,
                    'logged_in' => '1',
                    'loggedin_with' => $provider
                );
                break;
            }
            
            $this->Auth_Model->update_login_auth($update,$auth_id,$email);
            $b2cInfo = $this->Auth_Model->isRegistered($email)->row();
            $b2c_id = $b2cInfo->user_id;
        }else{
            $b2c_id = $this->Auth_Model->login_auth($login,$auth_id);
        }
        return $b2c_id;
    }

    public function signup_auth($provider,$user_profile){
        $auth_id = $user_profile->auth_id;
        if(isset($user_profile->DOB) && $user_profile->DOB != ''){
			  $DOB = $user_profile->DOB;

        } else {
            $DOB = '0000-00-00';          
        }
		if(isset($user_profile->lastName) && $user_profile->lastName!='')
		{
			$lname =$user_profile->lastName;
		}
		else
		{
			$lname  = $user_profile->firstName;
		}
        switch ($provider) {
          case "Facebook":
            $facebook_id = $user_profile->auth_id;
            $google_id = '';
            $twitter_id = '';
            break;
          case "Google":
            $facebook_id = '';
            $google_id = $user_profile->auth_id;
            $twitter_id = '';
            break;
          case "Twitter":
            $facebook_id = '';
            $google_id = '';
            $twitter_id = $user_profile->auth_id;
            break;
        }

        $password = $this->generate_random_password(); 
        $signup = array(
            'usertype' => 3,
            'domain' => 1,
            'facebook_id' => $facebook_id,
            'google_id' => $google_id,
            'twitter_id' => $twitter_id,
            'email' => $user_profile->email,
            'password' => $password,
            'profile_photo' => $user_profile->photoURL,
            'firstname' => $user_profile->firstName,
            'lastName' => $lname,
            'dob' => $DOB,
            'address' => $user_profile->region,
            'postal_code' => $user_profile->zip,
            'status' => '1',
            'logged_in' => '1',
            'loggedin_with' => $provider
        ); 
        //echo '<pre>';print_r($post);
        $email = $user_profile->email;
        $count = $this->Auth_Model->isRegistered($email)->num_rows();
        if($count == 1){
            // $update = array(
            //     'facebook_id' => $facebook_id,
            //     'google_id' => $google_id,
            //     'twitter_id' => $twitter_id,
            //     'profile_photo' => $user_profile->photoURL,
            //     'firstname' => $user_profile->firstName,
            //     'lastName' => $user_profile->lastName,
            //     'logged_in' => '1',
            //     'loggedin_with' => $provider
            // );
            switch ($provider) {
              case "Facebook":
                $update = array(
                    'facebook_id' => $facebook_id,
                    'profile_photo' => $user_profile->photoURL,
                    'firstname' => $user_profile->firstName,
                    'lastName' => $user_profile->lastName,
                    'logged_in' => '1',
                    'loggedin_with' => $provider
                );
                break;
              case "Google":
                $update = array(
                    'google_id' => $google_id,
                    'profile_photo' => $user_profile->photoURL,
                    'firstname' => $user_profile->firstName,
                    'lastName' => $user_profile->lastName,
                    'logged_in' => '1',
                    'loggedin_with' => $provider
                );
                break;
              case "Twitter":
                $update = array(
                    'twitter_id' => $twitter_id,
                    'firstname' => $user_profile->firstName,
                    'lastName' => $user_profile->lastName,
                    'logged_in' => '1',
                    'loggedin_with' => $provider
                );
                break;
            }
            
            $this->Auth_Model->update_login_auth($update,$auth_id,$email);
            $b2cInfo = $this->Auth_Model->isRegistered($email)->row();
            $b2c_id = $b2cInfo->user_id;
        }else{
            $b2c_id = $this->Auth_Model->login_auth($signup,$auth_id);

			$this->account_model->assignDefaultverfication($b2c_id,3);
			$this->Wishlist_Model->assignDefaultWishlist($b2c_id,3);
			
            $user_data = $this->Auth_Model->getUserData($b2c_id);
            $b2c_id = $user_data->user_id;
            $emailtype = "Registration";
            $password = $password;
            $this->get_email_content($b2c_id, $emailtype, $password);
        }
        return $b2c_id;
    }

    public function logout_auth($provider, $b2c_id){
        $update = array(
            'logged_in' => '0'
        );
        if($this->session->userdata('b2c_id')){
            $user_id = $this->session->userdata('b2c_id');
            $user_type = 3;
        }else if($this->session->userdata('b2b_id')){
            $user_id = $this->session->userdata('b2b_id');
            $user_type = 2;
        }
        $b2c_id = $this->Auth_Model->logout_auth($update,$user_id,$user_type);
        $this->session->unset_userdata('sessionUserInfo');
        $this->session->sess_destroy();
    }

    public function generate_random_password($length = 6) {
        $alphabets = range('A','Z');
        $numbers = range('0','9');
        $additional_characters = array('_','.');
        $final_array = array_merge($alphabets,$numbers,$additional_characters);
             
        $password = '';
      
        while($length--) {
          $key = array_rand($final_array);
          $password .= $final_array[$key];
        }
        return $password;
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

    public function contactAdmin() {
        $agent_id = $this->session->userdata('agent_id');
        if($agent_id != "") {
            $message = $this->input->post('agentMsg');
            $data = array('user_id'=>$agent_id, 'user_type' => 2, 'message'=>$message, 'ipaddress'=>$this->input->ip_address());
            $this->account_model->contactAdmin_model($data);
            $response = array('status' => 1);
            echo json_encode($response);
        }
        
    }
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */
