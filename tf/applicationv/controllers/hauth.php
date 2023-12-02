<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hauth extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Auth_Model');
        $this->load->model('Help_Model');
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

    public function login($provider){
        //log_message('debug', "controllers.HAuth.login($provider) called");

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
                    $data['b2c_id'] = $this->login_auth($provider,$user_profile);
                    $status = $this->Auth_Model->check_islogged_in($data['b2c_id']);
                    if($status == 1){
                        $b2c_session =  array(
                            'b2c_id' => $data['b2c_id'],
                            'provider' => $provider
                        );
                        $this->session->set_userdata($b2c_session);
                        //$this->load->view('auth/done',$data);
                        redirect('hauth');
                    }else{
                        $this->logout($provider, $data['b2c_id']);
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

    public function endpoint()
    {

        //log_message('debug', 'controllers.HAuth.endpoint called.');
        //log_message('info', 'controllers.HAuth.endpoint: $_REQUEST: '.print_r($_REQUEST, TRUE));

        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            log_message('debug', 'controllers.HAuth.endpoint: the request method is GET, copying REQUEST array into GET array.');
            $_GET = $_REQUEST;
           // print_r($_GET);
        }

        //log_message('debug', 'controllers.HAuth.endpoint: loading the original HybridAuth endpoint script.');
        require_once APPPATH.'/third_party/hybridauth/index.php';

    }

    public function logout($provider, $b2c_id){
        $this->load->library('HybridAuthLib');
        $service = $this->hybridauthlib->authenticate($provider);
        $user_profile = $service->logout();
        $this->logout_auth($provider,$b2c_id);
        redirect('hauth');
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
        if(isset($user_profile->DOB)){
        	$dob = $user_profile->DOB;
        }else{
        	$dob = '';
        }
        if($user_profile->lastName == ''){
            $lastName = '';
        }else{
             $lastName = $user_profile->lastName;
        }
        $post = array(
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
            'status' => '1',
            'logged_in' => '1',
            'loggedin_with' => $provider
        );
        echo '<pre>';print_r($user_profile);
        $b2c_id = $this->Auth_Model->login_auth($post,$auth_id);
        return $b2c_id;
    }

    public function logout_auth($provider, $b2c_id){
        $update = array(
            'logged_in' => '0'
        );
        $b2c_id = $this->Auth_Model->logout_auth($update,$b2c_id);
        $this->session->unset_userdata('sessionUserInfo');
        $this->session->sess_destroy();
    }
}

/* End of file hauth.php */
/* Location: ./application/controllers/hauth.php */
