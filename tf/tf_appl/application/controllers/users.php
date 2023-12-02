<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('account_model');
        $this->load->model('reference_model');
		$this->load->model('reviews_model');
        $this->load->model('Auth_Model');
        $this->load->model('email_model');
        $this->load->model('verification_model');
        $this->load->model('Wishlist_Model');
        $this->load->model('apartment_model');
        $this->load->model('Listings_Model');
        $current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
        $current_url = $this->config->site_url().$this->uri->uri_string(). $current_url;
        $url =  array(
            'continue' => $current_url,
        );
        $this->session->set_userdata($url);
        $this->load->model('Help_Model');
        $this->helpMenuLink = $this->Help_Model->fetchHelpLinks();
    }

	public function index($user_id = ''){
       redirect(WEB_URL);
    }
    
    public function listings_login(){   
		//$this->load->view('errors/accessdenied');
        if($this->session->userdata('b2c_id') || $this->session->userdata('b2b_id')){
            redirect(WEB_URL.'/listings/add_new_listings');
        }else {
            $data['msg'] = 'Please login/signup to add your listings.';
            $this->load->view('listings/login', $data);
        }
        
	}

    public function show($user_type = '',$user_id = '',$key = '') {
        if($user_id != '' && $user_type != ''){
            $count = $this->account_model->getPublicProfile($user_id,$user_type)->num_rows();

            if($count == 1){
                $data['userInfo'] = $userInfo = $this->account_model->getPublicProfile($user_id,$user_type)->row();
                
               /* Below lines are commented by Vikas on Nov 11th due to no use in user profile view page. */
              
                /*if($this->session->userdata('b2c_id')){
                    if($data['userInfo']->profile_photo == ''){
                        $data['profile_photo'] = ASSETS.'images/user-avatar.jpg';
                    }else{
                        $data['profile_photo'] = $data['userInfo']->profile_photo;
                    }
                    $data['email'] = $data['userInfo']->email;
                    $data['contact_no'] = $data['userInfo']->contact_no;
                    $data['user_id']=$user_id = $this->session->userdata('b2c_id');
                    $user_type = 3;
                }else if($this->session->userdata('b2b_id')){
                    if($data['userInfo']->agent_logo == ''){
                        $data['profile_photo'] = ASSETS.'images/user-avatar.jpg';
                    }else{
                        $data['profile_photo'] = $data['userInfo']->agent_logo;
                    }
                    $data['email'] = $data['userInfo']->email_id;
                    $data['contact_no'] = $data['userInfo']->mobile;
                    $data['user_id']=$user_id = $this->session->userdata('b2b_id');
                    $user_type = 2;
                }*/

                $data['b2c_id'] = $user_id;
                $data['user_type'] = $user_type;
                if($key != ''){ 
                    $rcount = $this->reference_model->isvalidKey($key)->num_rows();
                    if($rcount == 1){ 
                        $rdata = $this->reference_model->isvalidKey($key)->row();
                    
                        if($rdata->vstatus == '1'){ 
                            $ecount = $this->account_model->getUserInfoEmail($rdata->reffered_to)->num_rows();
                            $reffered_to_type = 3;      //refering guy is b2c type.

                            if($ecount == 0) {
                                $ecount = $this->account_model->getUserInfoEmailB2b($rdata->reffered_to)->num_rows();
                                $reffered_to_type = 2;      //refering guy is b2b type.
                            }

                            if($ecount == 1){
                                if (!$this->session->userdata('b2c_id') && !$this->session->userdata('b2b_id')) { 
                                    $data['msg'] = 'Sign up / Login to write a reference for your friend.';
                                    $this->load->view('login',$data);
                                }else{
                                    if($this->session->userdata('b2c_id')){
                                        $user_id = $this->session->userdata('b2c_id');
                                    }else if($this->session->userdata('b2b_id')){
                                        $user_id = $this->session->userdata('b2b_id');
                                    }

                                    if($reffered_to_type == 3) {
                                        $ecount = $this->account_model->getUserInfoEmail($rdata->reffered_to)->row();    
                                    } else if($reffered_to_type == 2) {
                                        $ecount = $this->account_model->getUserInfoEmailB2b($rdata->reffered_to)->row();    
                                    }    
                                    
                                    if(isset($ecount->user_id) && $ecount->user_id != "") {
                                        $ecount_user_id = $ecount->user_id;
                                    } else if(isset($ecount->agent_id) && $ecount->agent_id != "") {
                                        $ecount_user_id = $ecount->agent_id;
                                    } else {
                                        return false;
                                    }
                                    
                                    if($user_id == $ecount_user_id){ 
                                        $data['key'] = $key;
                                        
                                        if($reffered_to_type == 3) {
                                            $data['referecebyData'] = $this->account_model->getUserInfoEmail($rdata->reffered_to)->row();
                                        } elseif($reffered_to_type == 2) {
                                            $data['referecebyData'] = $this->account_model->getUserInfoEmailB2b($rdata->reffered_to)->row();
                                        }

                                        $data['referecetoData'] = $this->account_model->GetUserData($user_type, $rdata->b2c_id)->row();
                                 //       print_r($data['referecetoData']); die();
                                        $data['rdata'] = $this->reference_model->isvalidKey($key)->row();
                                    }else{
                                        $data['msg'] = 'Sign up / Login with same account to write a reference for your friend.';
                                        $this->load->view('login',$data);
                                    }
                                }
                            }else{
                                $data['msg'] = 'Sign up / Login to write a reference for your friend.';
                                $this->load->view('login',$data);
                            }
                        }else{
                            $data['key'] = $key;
                        }
                    }else{
                        $data['key'] = $key;
                    }
                }else{
                    $data['key'] = $key;
                }

                $data['referencesAboutYou'] = $this->reference_model->get_references_about_you($user_id, $user_type, 0, 3)->result();
                $data['referencesCount'] = $this->reference_model->get_references_about_you($user_id, $user_type)->num_rows();
				
                $data['reviewsCount_you'] = $this->reviews_model->get_reviews_about_you($user_id, $user_type)->num_rows();
                
				$data['reviewsCountAbtYou'] =  $data['reviewsCount_you'];
                $data['reviewsCount_prop_d'] = $this->reviews_model->getUserReviews($user_id, $user_type, 0, 3)->result(); //limit the results by three reviewsecho 'sdada';exit;
               
                $data['reviewsCountAbtProperty'] = $this->reviews_model->getGuestReview($user_id,$user_type)->num_rows();
				$data['reviewsAbtProperty'] = $this->reviews_model->getGuestReview($user_id,$user_type, 0, 3)->result();//load reviews

                $data['publicWishlist'] = $this->Wishlist_Model->getPublicWishlist($user_id, $user_type)->result();
                $data['publicWishlist_count'] = $this->Wishlist_Model->getPublicWishlist($user_id, $user_type)->num_rows();


                $data['listings'] = $listings = $this->Listings_Model->get_public_profile_user_listings($user_id);

                if(!empty($listings)){
                    $data['listing_photo'] = array();
                    foreach($data['listings'] as $data_key) {
                        $property_id = $data_key->PROPERTY_ID; 
                        $get_property_photos = $this->Listings_Model->get_property_photos($property_id, 1);
                        array_push($data['listing_photo'] , $get_property_photos);
                    }
                }
                
                $data['user_id'] = $user_id;
                $data['user_type'] = $user_type;

                $this->load->view('public_profile/profile',$data); 
            }else{
                redirect(WEB_URL);
            }
        }else{
            redirect(WEB_URL);
        }
    }


    public function loadAboutUserReviews() {
       $limitFrom = $this->input->post('lf');
       $totalResult = $this->input->post('tr');
       $user_id = $this->input->post('ppu');
       $user_type = $this->input->post('ppt');
        
       $getResult = $this->reviews_model->getUserReviews($user_id, $user_type, $limitFrom, $totalResult)->result();

       echo json_encode($getResult);
    }

    public function loadAboutUserPropertyReviews() {
       $limitFrom = $this->input->post('lf');
       $totalResult = $this->input->post('tr');
       $user_id = $this->input->post('ppu');
        
       $getResult = $this->reviews_model->getGuestReview($user_id, $limitFrom, $totalResult)->result();

       echo json_encode($getResult);
    }

    public function loadReferences() {
       $limitFrom = $this->input->post('lf');
       $totalResult = $this->input->post('tr');
       $user_id = $this->input->post('ppu');
        
       $getResult = $this->reference_model->get_references_about_you($user_id, $limitFrom, $totalResult)->result();

       echo json_encode($getResult);   
    }
	
    public function validateReference($key='',$secret='',$secret_user_type=''){
        if($key == '' || $secret == '' ||  $secret_user_type == ''){
            $data['msg'] = 'The link you followed is no longer valid.';
            $data['status'] = '0';
            $this->load->view('login',$data);
        }else{

            $rcount = $this->reference_model->isvalidKey($key)->num_rows();
            
            if($rcount == 1){     //if valide, go to next step
                if (!$this->session->userdata('b2c_id') && !$this->session->userdata('b2b_id') ) {
                    if($secret_user_type == 'c81e728d9d4c2f636f067f89cc14862c') { //==2
                        $data['secret_user_type'] = $secret_user_type;
                        $this->load->view('login_b2b',$data);
                    } else if($secret_user_type == 'eccbc87e4b5ce2fe28308fd9f2a7baf3') { //==3
                        $data['secret_user_type'] = $secret_user_type;
                        $this->load->view('login',$data);
                    }
                }else{ 
                    
                    $rdata = $this->reference_model->isvalidKey($key)->row();
                   
                    $ecount = $this->account_model->getUserInfoEmail($rdata->reffered_to)->num_rows();  //try with the b2c table first.
                    $reffered_to_type = 3;              //the person asked for reference is a b2c type
                    
                    if($ecount == 0) {                      //if ecount is zero from the b2c table check, then search for the b2b table
                        $ecount = $this->account_model->getUserInfoEmailB2b($rdata->reffered_to)->num_rows();
                        $reffered_to_type = 2;              //the person asked for reference is a b2b type
                    }
                    
                    if($ecount == 1){ 
                        if($this->session->userdata('b2c_id')){
                            $data['user_type']=$user_type = 3;
                            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
                        }else if($this->session->userdata('b2b_id')){
                            $data['user_type']=$user_type = 2;
                            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
                        }

                        /*Get the user data using email from the table containing data. Check which table {*/
                        if($reffered_to_type == 3) {
                            $ecount = $this->account_model->getUserInfoEmail($rdata->reffered_to)->row();    
                        } else if($reffered_to_type == 2) {
                            $ecount = $this->account_model->getUserInfoEmailB2b($rdata->reffered_to)->row();
                        }
                        /*Get the data from the table containing data. Check which table has it. b2b or b2c}*/
                        
                        if(isset($ecount->user_id) && $ecount->user_id != "") {
                            $ecount_user_id = $ecount->user_id;
                        } else if(isset($ecount->agent_id) && $ecount->agent_id != "") {
                            $ecount_user_id = $ecount->agent_id;
                        } else {
                            return false;
                        }

                        if($user_id == $ecount_user_id){
                            $reference = array(
                                'vstatus' => '1'
                            );

                            $this->reference_model->updateReference($reference,$key);

                            $rdata = $this->reference_model->isvalidKey($key)->row();

                            $b2c_id = $rdata->b2c_id;
                            $user_type = $rdata->user_type; 
                            redirect(WEB_URL.'/users/show/'.$user_type.'/'.$b2c_id.'/'.$key);
                        }else{
                            $data['msg'] = 'Sign up / Login with same account to write a reference for your friend.';
                            
                            if($secret_user_type == 'c81e728d9d4c2f636f067f89cc14862c') { //==2
                                $data['secret_user_type'] = $secret_user_type;
                                $this->load->view('login_b2b',$data);
                            } else if($secret_user_type == 'eccbc87e4b5ce2fe28308fd9f2a7baf3') { //==3
                                $data['secret_user_type'] = $secret_user_type;
                                $this->load->view('login',$data);
                            }
                        }
                    }else{
                         $data['msg'] = 'Sign up / Login to write a reference for your friend.';
                         
                         if($secret_user_type == 'c81e728d9d4c2f636f067f89cc14862c') { //==2
                            $data['secret_user_type'] = $secret_user_type;
                            $this->load->view('login_b2b',$data);
                        } else if($secret_user_type == 'eccbc87e4b5ce2fe28308fd9f2a7baf3') { //==3
                            $data['secret_user_type'] = $secret_user_type;
                            $this->load->view('login',$data);
                        }
                    }
                }
            }else{
                $data['msg'] = 'The link you followed is no longer valid.';
                $data['status'] = '0';
                $this->load->view('login',$data);
            }
        }
    }

 	public function validateReview($key='',$secret='',$user_type_secret='',$stop=''){
        if($key == '' || $secret == '' || $user_type_secret == ''){
            $data['msg'] = 'The link you followed is no longer valid.';
            $data['status'] = '0';
            $this->load->view('login',$data);
        }else{
            $rcount = $this->reviews_model->isvalidKey($key)->num_rows();
            if($rcount == 1){
                if($this->session->userdata('b2c_id')){
                    $data['user_type']=$user_type = 3;
                    $data['user_id']=$user_id = $this->session->userdata('b2c_id');
                }else if($this->session->userdata('b2b_id')){
                    $data['user_type']=$user_type = 2;
                    $data['user_id']=$user_id = $this->session->userdata('b2b_id');
                } else {
                    $data['user_type']=$user_type = "";
                    $data['user_id']=$user_id = "";
                }
                
                if ($user_id == "") {
                    if($user_type_secret == "eccbc87e4b5ce2fe28308fd9f2a7baf3") { //user type: 3
                        $data['secret_user_type'] = $user_type_secret;
                        $data['msg'] = 'Sign up / Login to write a review for your recent booking.';
                        $this->load->view('login',$data);
                    } else if($user_type_secret == "c81e728d9d4c2f636f067f89cc14862c") { //user_type: 2
                        $data['secret_user_type'] = $user_type_secret;
                        $data['msg'] = 'Sign up / Login to write a review for your recent booking.';
                        $this->load->view('login_b2b',$data);
                    } else {
                        return false;
                    }
                    
                }else{
                    $rdata = $this->reviews_model->isvalidKey($key)->row();
                    $ecount = $this->account_model->GetUserData($rdata->user_type, $rdata->user_id)->num_rows();
					
					if($ecount == 1){
                        if($this->session->userdata('b2c_id')){
                            $user_type = 3;
                            $user_id = $this->session->userdata('b2c_id');
                        }else if($this->session->userdata('b2b_id')){
                            $user_type = 2;
                            $user_id = $this->session->userdata('b2b_id');
                        }else {
                            $user_type = '';
                            $user_id = '';
                        }
                        
                        $ecount = $this->account_model->GetUserData($rdata->user_type, $rdata->user_id)->row();
						if(isset($ecount->user_id) && $ecount->user_id != "") {
                            $ecount_user_id = $ecount->user_id; 
                        } else if(isset($ecount->agent_id) && $ecount->agent_id != "") {
                            $ecount_user_id = $ecount->agent_id;
                        } else{
                            return false;
                        }

                        if($user_id == $ecount_user_id){  
                            $reference = array(
                                'vstatus' => '1'
                            );
                            $this->reviews_model->updateReference($reference,$key);
                            $rdata = $this->reviews_model->isvalidKey($key)->row();
                            $b2c_id = $rdata->user_id;
                          if($stop==1)
						  {
						    redirect(WEB_URL.'/reviews/user_reviews/'.$key.'/'.$rdata->booking_apartment_id.'/1');
						  }
						  else
						  {
							redirect(WEB_URL.'/reviews/user_reviews/'.$key.'/'.$rdata->booking_apartment_id);
						  }
                        }else{ 
                            if($user_type_secret == "eccbc87e4b5ce2fe28308fd9f2a7baf3") { //user type: 3
                                $data['secret_user_type'] = $user_type_secret;
                                $data['msg'] = 'Sign up / Login to write a review for your recent booking.';
                                $this->load->view('login',$data);
                            } else if($user_type_secret == "c81e728d9d4c2f636f067f89cc14862c") { //user_type: 2
                                $data['secret_user_type'] = $user_type_secret;
                                $data['msg'] = 'Sign up / Login to write a review for your recent booking.';
                                $this->load->view('login_b2b',$data);
                            } else {
                                return false;
                            }
                        }
                    }else{
                        if($user_type_secret == "eccbc87e4b5ce2fe28308fd9f2a7baf3") { //user type: 3
                            $data['secret_user_type'] = $user_type_secret;
                            $data['msg'] = 'Sign up / Login to write a review for your recent booking.';
                            $this->load->view('login',$data);
                        } else if($user_type_secret == "c81e728d9d4c2f636f067f89cc14862c") { //user_type: 2
                            $data['secret_user_type'] = $user_type_secret;
                            $data['msg'] = 'Sign up / Login to write a review for your recent booking.';
                            $this->load->view('login_b2b',$data);
                        } else {
                            $this->load->view('login',$data);
                        }
                    }
                }
            }else{
                $data['msg'] = 'The link you followed is no longer valid.';
                $data['status'] = '0';
                $this->load->view('login',$data);
            }
        }
    }
	
	
	public function validatehostReview($key='',$secret='',$host_type_secret='',$stop=''){
        if($key == '' || $secret == '' || $host_type_secret == ''){
            $data['msg'] = 'The link you followed is no longer valid.';
            $data['status'] = '0';
            $this->load->view('login',$data);
        }else{

            $rcount = $this->reviews_model->isvalidKey_host($key)->num_rows();
            
            if($rcount == 1){


                if($this->session->userdata('b2c_id')){
                    $data['user_type']=$user_type = 3;
                    $data['user_id']=$user_id = $this->session->userdata('b2c_id');
                }else if($this->session->userdata('b2b_id')){
                    $data['user_type']=$user_type = 2;
                    $data['user_id']=$user_id = $this->session->userdata('b2b_id');
                } else {
                    $data['user_type']=$user_type = "";
                    $data['user_id']=$user_id = "";
                }


                if ($user_id == "") {
                    if($host_type_secret == "eccbc87e4b5ce2fe28308fd9f2a7baf3") { //user type: 3
                        $data['secret_user_type'] = $host_type_secret;
                        $data['msg'] = 'Sign up / Login to write a review for your recent booking.';
                        $this->load->view('login',$data);
                    } else if($host_type_secret == "c81e728d9d4c2f636f067f89cc14862c") { //user_type: 2
                        $data['secret_user_type'] = $host_type_secret;
                        $data['msg'] = 'Sign up / Login to write a review for your recent booking.';
                        $this->load->view('login_b2b',$data);
                    } else {
                        return false;
                    }
                    
                }else{
                    $rdata = $this->reviews_model->isvalidKey_host($key)->row();
                    $ecount = $this->account_model->GetUserData($rdata->host_type, $rdata->host_id)->num_rows();
					
					if($ecount == 1){
                        if($this->session->userdata('b2c_id')){
                            $user_type = 3;
                            $user_id = $this->session->userdata('b2c_id');
                        }else if($this->session->userdata('b2b_id')){
                            $user_type = 2;
                            $user_id = $this->session->userdata('b2b_id');
                        }else {
                            $user_type = '';
                            $user_id = '';
                        }


                        $ecount = $this->account_model->GetUserData($rdata->host_type, $rdata->host_id)->row();
						
                        if(isset($ecount->user_id) && $ecount->user_id != "") {
                            $ecount_user_id = $ecount->user_id; 
                        } else if(isset($ecount->agent_id) && $ecount->agent_id != "") {
                            $ecount_user_id = $ecount->agent_id;
                        } else{
                            return false;
                        }

                       
                        if($user_id == $ecount_user_id){
                            $reference = array(
                                'vstatus' => '1'
                            );
                            $this->reviews_model->updateReference_host($reference,$key);
                            $rdata = $this->reviews_model->isvalidKey_host($key)->row();
                            $b2c_id = $rdata->host_id;
						  
						  if($stop==1)
						  {
						    redirect(WEB_URL.'/reviews/host_reviews/'.$key.'/'.$rdata->booking_apartment_id.'/1');
						  }
						  else
						  {
							redirect(WEB_URL.'/reviews/host_reviews/'.$key.'/'.$rdata->booking_apartment_id);
						  }
                         
                        }else{
                            if($host_type_secret == "eccbc87e4b5ce2fe28308fd9f2a7baf3") { //user type: 3
                                $data['secret_user_type'] = $host_type_secret;
                                $data['msg'] = 'Sign up / Login to write a review for your recent booking.';
                                $this->load->view('login',$data);
                            } else if($host_type_secret == "c81e728d9d4c2f636f067f89cc14862c") { //user_type: 2
                                $data['secret_user_type'] = $host_type_secret;
                                $data['msg'] = 'Sign up / Login to write a review for your recent booking.';
                                $this->load->view('login_b2b',$data);
                            } else {
                                return false;
                            }
                        }
                    }else{
                        if($host_type_secret == "eccbc87e4b5ce2fe28308fd9f2a7baf3") { //user type: 3
                            $data['secret_user_type'] = $host_type_secret;
                            $data['msg'] = 'Sign up / Login to write a review for your recent booking.';
                            $this->load->view('login',$data);
                        } else if($host_type_secret == "c81e728d9d4c2f636f067f89cc14862c") { //user_type: 2
                            $data['secret_user_type'] = $host_type_secret;
                            $data['msg'] = 'Sign up / Login to write a review for your recent booking.';
                            $this->load->view('login_b2b',$data);
                        } else {
                            return false;
                        }
                    }
                }
            }else{
                if($host_type_secret == "eccbc87e4b5ce2fe28308fd9f2a7baf3") { //user type: 3
                    $data['secret_user_type'] = $host_type_secret;
                    $data['msg'] = 'The link you followed is no longer valid.';
                    $data['status'] = '0';
                    $this->load->view('login',$data);
                } else if($host_type_secret == "c81e728d9d4c2f636f067f89cc14862c") { //user_type: 2
                    $data['secret_user_type'] = $host_type_secret;
                    $data['msg'] = 'The link you followed is no longer valid.';
                    $data['status'] = '0';
                    $this->load->view('login_b2b',$data);
                } else {
                    return false;
                }
            }
        }
    }
	
		public function validateguestReview($key='',$secret='', $user_type_secret='', $stop=''){
        if($key == '' || $secret == '' || $user_type_secret == ''){
            $data['msg'] = 'The link you followed is no longer valid.';
            $data['status'] = '0';
            $this->load->view('login',$data);
        }else{
            $rcount = $this->reviews_model->isvalidKey_guest($key)->num_rows();
            if($rcount == 1){
                if($this->session->userdata('b2c_id')){
                    $data['user_type']=$user_type = 3;
                    $data['user_id']=$user_id = $this->session->userdata('b2c_id');
                }else if($this->session->userdata('b2b_id')){
                    $data['user_type']=$user_type = 2;
                    $data['user_id']=$user_id = $this->session->userdata('b2b_id');
                } else {
                    $data['user_type']=$user_type = "";
                    $data['user_id']=$user_id = "";
                }

                if ($user_id == "") { 
                    if($user_type_secret == "eccbc87e4b5ce2fe28308fd9f2a7baf3") { //user type: 3
                        $data['secret_user_type'] = $user_type_secret;
                        $data['msg'] = 'Sign up / Login to write a review for your recent booking.';
                        $this->load->view('login',$data);
                    } else if($user_type_secret == "c81e728d9d4c2f636f067f89cc14862c") { //user_type: 2
                        $data['secret_user_type'] = $user_type_secret;
                        $data['msg'] = 'Sign up / Login to write a review for your recent booking.';
                        $this->load->view('login_b2b',$data);
                    } else {
                        return false;
                    }
                } else{
                    $rdata = $this->reviews_model->isvalidKey_guest($key)->row();

                    $ecount = $this->account_model->GetUserData($rdata->user_type, $rdata->user_id)->num_rows();
					
					if($ecount == 1){
                        if($this->session->userdata('b2c_id')){
                            $user_type = 3;
                            $user_id = $this->session->userdata('b2c_id');
                        }else if($this->session->userdata('b2b_id')){
                            $user_type = 2;
                            $user_id = $this->session->userdata('b2b_id');
                        }else {
                            $user_type = '';
                            $user_id = '';
                        }
                        
                        $ecount = $this->account_model->GetUserData($rdata->user_type, $rdata->user_id)->row();
                        if(isset($ecount->user_id) && $ecount->user_id != "") {
                            $ecount_user_id = $ecount->user_id; 
                        } else if(isset($ecount->agent_id) && $ecount->agent_id != "") {
                            $ecount_user_id = $ecount->agent_id;
                        } else{
                            return false;
                        }
						//echo '<pre/>';
						//print_r($rdata);exit;
                        
                        if($user_id == $ecount_user_id){
                            $reference = array(
                                'vstatus' => '1'
                            );
                            $this->reviews_model->updateReference_guest($reference,$key);
                            $rdata = $this->reviews_model->isvalidKey_guest($key)->row();
                            $b2c_id = $rdata->host_id;
						  
						  if($stop==1)
						  {
						    redirect(WEB_URL.'/reviews/guest_reviews/'.$key.'/'.$rdata->booking_apartment_id.'/1');
						  }
						  else
						  {
							redirect(WEB_URL.'/reviews/guest_reviews/'.$key.'/'.$rdata->booking_apartment_id);
						  }
                         
                        }else{ 
                            if($user_type_secret == "eccbc87e4b5ce2fe28308fd9f2a7baf3") { //user type: 3
                                $data['secret_user_type'] = $user_type_secret;
                                $data['msg'] = 'Sign up / Login to write a review for your recent booking.';
                                $this->load->view('login',$data);
                            } else if($user_type_secret == "c81e728d9d4c2f636f067f89cc14862c") { //user_type: 2
                                $data['secret_user_type'] = $user_type_secret;
                                $data['msg'] = 'Sign up / Login to write a review for your recent booking.';
                                $this->load->view('login_b2b',$data);
                            } else {
                                return false;
                            }
                        }
                    }else{
                        if($user_type_secret == "eccbc87e4b5ce2fe28308fd9f2a7baf3") { //user type: 3
                            $data['secret_user_type'] = $user_type_secret;
                            $data['msg'] = 'Sign up / Login to write a review for your recent booking.';
                            $this->load->view('login',$data);
                        } else if($user_type_secret == "c81e728d9d4c2f636f067f89cc14862c") { //user_type: 2
                            $data['secret_user_type'] = $user_type_secret;
                            $data['msg'] = 'Sign up / Login to write a review for your recent booking.';
                            $this->load->view('login_b2b',$data);
                        } else {
                            return false;
                        }
                    }
                }
            }else{
                $data['msg'] = 'The link you followed is no longer valid.';
                $data['status'] = '0';
                $this->load->view('login',$data);
            }
        }
    }
	public function validatehostReviewssd($key='',$secret='',$stop=''){
        if($key == '' || $secret == ''){
            $data['msg'] = 'The link you followed is no longer valid.';
            $data['status'] = '0';
            $this->load->view('login',$data);
        }else{
            $rcount = $this->reviews_model->isvalidKey_host($key)->num_rows();
            if($rcount == 1){
                if (!$this->session->userdata('b2c_id')) {
                    $data['msg'] = 'Sign up / Login to write a review for your friend.';
                    $this->load->view('login',$data);
                }else{
                    $rdata = $this->reviews_model->isvalidKey_host($key)->row();

                    $ecount = $this->account_model->getUserInfo($rdata->host_id)->num_rows();
					
					if($ecount == 1){
                        $b2c_id = $this->session->userdata('b2c_id');
                        $ecount = $this->account_model->getUserInfo($rdata->host_id)->row();
						
                        if($b2c_id == $ecount->user_id){
                            $reference = array(
                                'vstatus' => '1'
                            );
                            $this->reviews_model->updateReference_host($reference,$key);
                            $rdata = $this->reviews_model->isvalidKey_host($key)->row();
                            $b2c_id = $rdata->host_id;
						  
						  if($stop==1)
						  {
						    redirect(WEB_URL.'/reviews/host_reviews/'.$key.'/'.$rdata->booking_apartment_id.'/1');
						  }
						  else
						  {
							redirect(WEB_URL.'/reviews/host_reviews/'.$key.'/'.$rdata->booking_apartment_id);
						  }
                         
                        }else{
                             $data['msg'] = 'Sign up / Login with same account to write a review for your friend.';
                             $this->load->view('login',$data);
                        }
                    }else{
                         $data['msg'] = 'Sign up / Login to write a review for your friend.';
                         $this->load->view('login',$data);
                    }
                }
            }else{
                $data['msg'] = 'The link you followed is no longer valid.';
                $data['status'] = '0';
                $this->load->view('login',$data);
            }
        }
    }
	
	
    public function addRefMsg(){
        $relationship_type = $this->input->post('relationship_type');
        $recommendation = $this->input->post('recommendation');
        $refid = $this->input->post('refid');
        $refid_firstname = $this->input->post('refid_firstname');
        $reference = array(
            'relationship' => $relationship_type,
            'msg' => $recommendation,
            'm_status' => '1',
            'timestamp' => date('Y-m-d h:i:s')
        );
        $this->reference_model->updateReferenceById($reference,$refid);
        $rdata = $this->reference_model->getReferenceById($refid)->row();
        //$userdata = $this->account_model->getUserInfo($rdata->b2c_id)->row();

        $data['msg'] = 'Thanks, your reference has been sent to'.$refid_firstname.' for approval. You can request references of your own to build your reputation on InnoGlobe.';
        echo json_encode($data);
    }

    public function wishlist($user_type, $user_id, $wishlist_id) {
        if($user_id !="" && $wishlist_id != "") {
            $data['getWishes_num_rows'] = $this->Wishlist_Model->getUserBasedWishlist($user_id, $user_type, $wishlist_id)->num_rows(); 
            $data['getWishes'] = $this->Wishlist_Model->getUserBasedWishlist($user_id, $user_type, $wishlist_id)->result(); //all wishlists
            
            $data['userInfo'] = $this->account_model->GetUserData($user_type, $user_id)->row();
           
            $all_images = array();
            foreach($data['getWishes'] as $data_key) {
                
                $count = $this->apartment_model->getApartmentImages($data_key->PROPERTY_ID)->num_rows();
            
                if($count > 0){
                    $getBaseImage = $this->apartment_model->getApartmentImages($data_key->PROPERTY_ID)->result();
                    array_push($all_images, $getBaseImage);
                }    
            }
            
            $data['wishImgPack'] = $all_images;
            $this->load->view('public_profile/user_profile_wishlist', $data);
        } else {
            redirect(WEB_URL);
        }
    }

    public function subscribeUser() {
        $subscriberEmail = $this->input->post('subEmail');
        $current_b2c_session = $this->session->userdata('b2c_id');
        $current_b2b_session = $this->session->userdata('b2b_id');

        if($current_b2c_session != "") { //check if user is b2c
            $checkSubEmail = $this->account_model->checkSubEmailB2c($current_b2c_session, $subscriberEmail); //check if email entered by the user is same as his logged in account email
            $countRows = $checkSubEmail->num_rows(); //fetch the number of rows 
            if($countRows == 1) {
                $this->account_model->addB2cNewsletterSub($current_b2c_session);  //if email is same as the newsletter subscriber email than make subsscriber status of newsletter as 1 in b2c table.    
            } else {
                $data = array('email_id'=>$subscriberEmail); 
                $isSubscribed = $this->isSubscribed($subscriberEmail); //check if already subscribed
                
                if($isSubscribed) {   //else add it to the subscription table.
                    $this->account_model->addSubscriberEmail($data);    //if no, then add to the table
                    $response = array('status'=>1);
                    echo json_encode($response);                
                } else {                                    //else, leave out all the rest
                    $response = array('status'=>0);   
                    echo json_encode($response);
                }
            }
        } else if($current_b2b_session != "") { //check if user is a b2b user.
            $checkSubEmail = $this->account_model->checkSubEmailB2b($current_b2b_session, $subscriberEmail); //same as b2c procedure
            $countRows = $checkSubEmail->num_rows(); //same as b2c procedure
            
            if($countRows == 1) {
                $this->account_model->addB2bNewsletterSub($current_b2b_session); //if email is same as the newsletter subscriber email than make subsscriber status of newsletter as 1 in b2b table.
                $response = array('status'=>1);
                echo json_encode($response);  
            } else {
                $data = array('email_id'=>$subscriberEmail);
                $isSubscribed = $this->isSubscribed($subscriberEmail); //check if already subscribed
                
                if($isSubscribed) {   //else add it to the subscription table.
                    $this->account_model->addSubscriberEmail($data);    //if no, then add to the table
                    $response = array('status'=>1);
                    echo json_encode($response);                
                } else {                                    //else, leave out all the rest
                    $response = array('status'=>0);   
                    echo json_encode($response);
                }    
            }
            
            /*$response = array('status'=>1);
            echo json_encode($response);*/
        } else {
            $data = array('email_id'=>$subscriberEmail);
            $isSubscribed = $this->isSubscribed($subscriberEmail); //check if already subscribed
                
            if($isSubscribed) {   //else add it to the subscription table.
                $this->account_model->addSubscriberEmail($data);    //if no, then add to the table
                $response = array('status'=>1);
                echo json_encode($response);                
            } else {                                    //else, leave out all the rest
                $response = array('status'=>0);   
                echo json_encode($response);
            }
        }

    }

    public function isSubscribed($subscriberEmail) {
        $checkSubscribeTable = $this->account_model->isSubscribed($subscriberEmail);
        $countSubscriberTableRows = $checkSubscribeTable->num_rows();

        if($countSubscriberTableRows > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function subscribeUserCheckbox() {
        $currentLogInId_B2c = $this->session->userdata('b2c_id');
        $currentLogInId_B2b = $this->session->userdata('b2b_id');

        $checkBxStatus = $this->input->post('setbit');

        if($currentLogInId_B2c != "") {
            $currentLogInId = $currentLogInId_B2c;
            $data = array('newsletter_subscribe'=>$checkBxStatus);
            $this->account_model->addB2cNewsletterSubCheckBx($currentLogInId, $data);
        } else if($currentLogInId_B2b != "") {
            $currentLogInId = $currentLogInId_B2b;
            $data = array('newsletter_subscribe'=>$checkBxStatus);
            $this->account_model->addB2bNewsletterSubCheckBx($currentLogInId, $data);
        }

        $response = array('status'=>1);
        echo json_encode($response);
    }

}

/* End of file users.php */
/* Location: ./application/controllers/users.php */
