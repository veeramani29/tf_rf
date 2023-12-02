<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('Auth_Model');
        $current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
        $current_url = $this->config->site_url().$this->uri->uri_string(). $current_url;
        $url =  array(
            'continue' => $current_url,
        );
        if($this->router->fetch_method()!='language'){
        	$this->session->set_userdata($url);
        }
        
        $this->helpMenuLink = "";
        $this->load->model('Help_Model');
        $this->load->model('Home_Model');
        $this->load->model('Email_Model');
		$this->helpMenuLink = $this->Help_Model->fetchHelpLinks();
		$this->load->model('flight_model');
		$this->load->model('account_model');
		
    }

	public function index(){
	
		$data['banners'] = $this->Help_Model->getHomeSettings();
		//$data['portfolio'] = $this->Help_Model->getAllPortfolio();
		$data['background'] = $this->Help_Model->getAllBackgroundimages();
	
		$data['discounted_flights'] = $this->flight_model->get_discounted_flights();
		$data['why_we_details'] = $this->flight_model->get_why_we_details();
		$this->load->view('index',$data);	
	}


public function faq(){
		
			$this->load->view('cms/faq');
		

	}


	public function details(){
		if($this->input->post()!=null){
			$request=$this->input->post('temp_r');
			$flight_data=$this->input->post('temp_d');
			$data['req']=json_decode(base64_decode($request));
			$data['flights']=json_decode(base64_decode($flight_data));
			$this->load->view('flight/flight_details/details',$data);
		}else{
			$this->load->view('errors/expiry');
		}

	}
	public function language(){
		$language_v = $this->uri->segment('3');
		$current_url = $this->uri->segment('4');
		$current_url=$this->session->userdata('continue');

		if(isset($language_v) && $language_v!='' && isset($current_url) && $current_url!=''){
		
			$this->lang->load('Home_Page_HM', $language_v);
			$language = array('language' => $language_v);
			$this->session->set_userdata($language);
			
			$current = $current_url;
			redirect($current);
			
			//echo $language_v;exit;	
			
		}else{
			$this->lang->load('Home_Page_HM', 'english');
		}
		
			redirect(WEB_URL,'refresh');
	}
	
	function get_airports(){
		ini_set('memory_limit', '-1');
			$result=array();
		$term = $this->input->get('term'); //retrieve the search term that autocomplete sends
		$term = trim(strip_tags($term));
		if(strlen($term)>=3){
		$airports = $this->flight_model->get_airport_list($term);

		$all_air=$airports['airport'];
		foreach($all_air as $airport){
			 $splcity=count($airport);
			if($splcity>2){
				$air=0;
				foreach($airport as $sec_airport){
					if($air==0){
				$apts1['label'] = $sec_airport['airport_city'].",".$sec_airport['country']." (".$sec_airport['airport_city_code'].") (All Airports)";
				$apts1['value'] = $sec_airport['airport_city'].' ('.$sec_airport['airport_city_code'].') (All Airports)';
				$apts1['id'] = $sec_airport['airport_id'];
				$result[] = $apts1; 
					}else{
			$apts1['label'] = $sec_airport['airport_city'].",".$sec_airport['airport_name'].",".$sec_airport['country'].' ('.$sec_airport['airport_code'].')';
			$apts1['value'] = $sec_airport['airport_city'].','.$sec_airport['airport_name'].",".$sec_airport['country'].' ('.$sec_airport['airport_code'].')';
			$apts1['id'] = $sec_airport['airport_id'];
			$result[] = $apts1; 
				}
			$air++;
			}
			}else{
				array_shift($airport);
				foreach($airport as $sec_airport){
			$apts1['label'] = $sec_airport['airport_city'].",".$sec_airport['airport_name'].",".$sec_airport['country'].' ('.$sec_airport['airport_code'].')';
			$apts1['value'] = $sec_airport['airport_city'].','.$sec_airport['airport_name'].",".$sec_airport['country'].' ('.$sec_airport['airport_code'].')';
			$apts1['id'] = $sec_airport['airport_id'];
			$result[] = $apts1; 
					}
					
				
				
				
			}
			
			
		}
		
		}
		
			
			
			
		//echo "<pre>";
		//print_r($result);exit;
		
		echo json_encode($result);//format the array into json data
	}

	function get_cities(){
		ini_set('memory_limit', '-1');
		$term = $this->input->get('term'); //retrieve the search term that autocomplete sends
		$term = trim(strip_tags($term));
		$airports = $this->flight_model->get_airport_list($term)->result();
		foreach($airports as $airport){
			$apts['label'] = $airport->airport_city.', '.$airport->country.' ('.$airport->airport_code.')';
			$apts['value'] = $airport->airport_city.', '.$airport->country.' ('.$airport->airport_code.')';
			$apts['id'] = $airport->airport_id;
			$result[] = $apts; 
		}
		//print_r($result);
		echo json_encode($result);//format the array into json data
	}
   public function get_hotel_city_suggestions() {
        ini_set('memory_limit', '-1');
        $term = $this->input->get('term'); //retrieve the search term that autocomplete sends
        $term = trim(strip_tags($term));
        $hotels = $this->get_hotels_list($term);
        $result = array();

        foreach ($hotels as $hotel) {
            $apts['label'] = $hotel->CITY . ', ' . $hotel->COUNTRY_NAME ;
            $apts['value'] = ' ' . $hotel->CITY. ', ' . $hotel->COUNTRY_NAME . '  - ' . $hotel->IATA_CODES;
            $apts['id'] = $hotel->ID;
            $result[] = $apts;
        }
        //print_r($result);
        echo json_encode($result); //format the array into json data
    }
  public function get_hotels_list($city){
        $this->db->select('*');
        $this->db->from('hotel_cities');
        $this->db->like('hotel_cities.CITY',$city);
        $this->db->join('hotel_countries','hotel_cities.COUNTRY_CODE = hotel_countries.COUNTRY_CODE');
        $this->db->order_by("hotel_cities.CITY", "asc"); 
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result();
    }
	public function change_currency(){
		$code = $this->input->post('code');
		$icon = $this->input->post('icon');
		if($this->input->cookie('currency')){
            $cookie = array(
			    'name'   => 'currency',
			    'value'  => $code,
			    'expire' => '86500'
			);
            $this->input->set_cookie($cookie);
            $cookie = array(
                'name'   => 'icon',
                'value'  => $icon,
                'expire' => '86500'
            );
            $this->input->set_cookie($cookie);
            $this->display_currency = $code;
            $this->display_icon = $icon;
        }else{
        	$cookie = array(
			    'name'   => 'currency',
			    'value'  => 'USD',
			    'expire' => '86500'
			);
            $this->input->set_cookie($cookie);
            $cookie = array(
                'name'   => 'icon',
                'value'  => '$',
                'expire' => '86500'
            );
            $this->input->set_cookie($cookie);
            $this->display_currency = 'USD';
            $this->display_icon = '$';
        }
        $this->curr_val = $this->account_model->get_curr_val($this->display_currency);
        $response = array(
        	'status' => 1
        );
        echo json_encode($response);
	}

	public function dashboard(){
		$this->load->view('profile');	
	}
	
	public function test_home(){
		$this->load->view('test_home');
	}
	
	public function test_home1(){
		$this->load->view('test_home1');
	}
	
		public function detail(){
		$this->load->view('detail');
	}
	
	public function cancellation_policies(){
		$this->load->view('static/cancellation_policies');
	}
	
	public function ClearTemp(){
		$files = glob(FRONT_UPLOAD_PATH.'temp_image/*');
		foreach($files as $file){ // iterate files
		  if(is_file($file)){
		    unlink($file); // delete file
		  }
		}
		return true;
    }
	
    public function curr(){
    	echo $this->example_model->convert();
    }

    public function contact(){
    	$this->load->helper('captcha');
    	//$data['contact'] = $this->Package_Model->get_contact();
    	/* Setup vals to pass into the create_captcha function */
      	$vals = array(
	        'img_path' => APP_BASE_PATH.'/assets/images/captcha/',
	        'img_url' => base_url().'assets/images/captcha/',
	        'img_width'	=> '200',
    		'img_height' => '40'
	    );
        
      /* Generate the captcha */
      $data['captcha'] = $cap = create_captcha($vals);
      $data['contact'] = $this->Home_Model->getcontact(); 

      $capdata = array(
	    'captcha_time'	=> $cap['time'],
	    'ip_address'	=> $this->input->ip_address(),
	    'word'	=> $cap['word']
	   );
	  
	  $this->Home_Model->addCaptcha($capdata);  
      $this->load->view('static/contact', $data);
	}

	public function contact_us(){
		$this->load->helper('captcha');
		$input = $this->input->post();
		if(!empty($input)){

			//captcha 
	        $validCaptcha = $this->Home_Model->captchaValidation($input['captcha']);

	        if($validCaptcha->count !=0){

				$data['email_template'] = $this->Email_Model->get_email_template('contactus_email')->row();
		        $data['email_access'] = $this->Email_Model->get_email_acess()->row();
		        $return = $this->Email_Model->send_contactus_mail_v1($data,$input);
		        //$data['caption'] = $this->Package_Model->getPageCaption('contact_us')->row();
		        

				if($return){

		        	$data['success'] = "Thank you for contacting us, Will get back to you soon";
					//$data['caption'] = $this->Package_Model->getPageCaption('contact_us')->row();
			    	//$data['contact'] = $this->Package_Model->get_contact();
				}else{
		        	$data['error'] = "There was an error while submitting, Please check it";
					//$data['caption'] = $this->Package_Model->getPageCaption('contact_us')->row();
			    	//$data['contact'] = $this->Package_Model->get_contact();
				}
			}else{
				$data['error'] = "Please provide valid captcha";
				//$data['caption'] = $this->Package_Model->getPageCaption('contact_us')->row();
			    //$data['contact'] = $this->Package_Model->get_contact();

			}
			
			if(file_exists(APP_BASE_PATH.'/assets/images/captcha/'.$input['captchaimage']))
            		unlink(APP_BASE_PATH.'/assets/images/captcha/'.$input['captchaimage']);
			$vals = array(
			        'img_path' => APP_BASE_PATH.'/assets/images/captcha/',
			        'img_url' => base_url().'assets/images/captcha/',
			        'img_width'	=> '200',
    				'img_height' => '40'
			    );
		        
		      /* Generate the captcha */
		      $data['captcha'] = $cap = create_captcha($vals);

		      $capdata = array(
			    'captcha_time'	=> $cap['time'],
			    'ip_address'	=> $this->input->ip_address(),
			    'word'	=> $cap['word']
			   );
			  
			 $this->Home_Model->addCaptcha($capdata); 
			 $this->load->view('static/contact',$data);
		  }
		else{
			redirect('contact');
		}
	}

	public function feedback(){
    	$this->load->view('static/feedback');
	}

	public function feed_back(){
		$input = $this->input->post();
		if(!empty($input)){

			$data['email_template'] = $this->Email_Model->get_email_template('feedback_email')->row();
	        $data['email_access'] = $this->Email_Model->get_email_acess()->row();
	        $return = $this->Email_Model->send_feedback_mail($data,$input);
		        //$data['caption'] = $this->Package_Model->getPageCaption('contact_us')->row();
	        if($return){

	        	$data['success'] = "Thank you for giving your valuable feedback, Will get back to you soon";
				//$data['caption'] = $this->Package_Model->getPageCaption('contact_us')->row();
		    	//$data['contact'] = $this->Package_Model->get_contact();
			}else{
	        	$data['error'] = "There was an error while submitting, Please try again";
				//$data['caption'] = $this->Package_Model->getPageCaption('contact_us')->row();
		    	//$data['contact'] = $this->Package_Model->get_contact();
			}
			
			$this->load->view('static/feedback',$data);
		}else{
			redirect('feedback');
		}
	}

	public function loadcountries(){
		$countries = $this->account_model->getCuntries()->result();
		$i=1;$j=1;
		foreach ($countries as $key => $country) {
			$country_name = $country->COUNTRY_NAME;
			$country_code = $country->COUNTRY_CODE;
			$count = $this->account_model->getcount($country_code)->num_rows();
			if($count == 1){

			}else{
				$update = array(
					'country_code' => $country_code,
					'name' => $country_name,
				);
				$this->account_model->updateCuntries($update);
				echo $i.'. '.$country_name.'<br>';
				$i++;
			}
		
		}
		//echo '<pre>';print_r($countries);die;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */