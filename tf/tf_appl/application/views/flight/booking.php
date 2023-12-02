<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Booking extends CI_Controller {
	public function __construct(){
        parent::__construct();
        // $current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
        // $current_url = $this->config->site_url().$this->uri->uri_string(). $current_url;
        // $url =  array(
        //     'continue' => $current_url,
        // );
        $this->load->model('Auth_Model');
        $this->load->model('apartment_model');
        $this->load->helper('apartment_helper');
        $this->load->model('wishlist_model');
        $this->load->model('account_model');
        $this->load->model('Help_Model');
        $this->load->model('Verification_Model');
        $this->load->model('payment_model');
        $this->load->model('email_model');
        $this->load->model('booking_model');
        $this->load->model('reviews_model');
        $this->load->model('Message_Model');
        $this->load->model('cart_model');
		$this->load->helper('flight_helper');
		$this->load->helper('hotel_helper');
		$this->load->helper('car_helper');
		$this->load->library('xml_to_array');
	

        $this->helpMenuLink = $this->Help_Model->fetchHelpLinks();
    }

   
    
     
    
    public function index($session_id='',$orderIds=''){
		
		//echo $orderId;exit;

		
		
		
        parent::pre_url();
        //echo $continue = $this->session->userdata('continue');die;
        if(!empty($session_id) && empty($orderIds)){
			$this->session->unset_userdata('promos');
            //$this->islogged_in();
            $count = $this->cart_model->getBookingTemp($session_id)->num_rows();
            if($count > 0){
                $data['countries'] = $this->account_model->getAllCountries()->result();
                //$data['countries'] = $this->apartment_model->getAllKigoCountries()->result();
                $data['book_temp_data'] = $book_temp_data = $this->cart_model->getBookingTemp($session_id)->result();
                //$data['guests'] = $book_temp_data->RES_N_ADULTS+$book_temp_data->RES_N_CHILDREN+$book_temp_data->RES_N_BABIES;
                //$data['RentData'] = json_decode($book_temp_data->RENT_DATA);
                //echo '<pre>';print_r($book_temp_data);die;
                foreach ($book_temp_data as $key => $value) {
                    $cart_global_id[] = $value->module.','.$value->cart_id;
                }
                
                $data['cart_global'] = $cart_global_id;
                $data['cart_global_id'] = base64_encode(json_encode($cart_global_id));
                
                $b2c_id = $this->session->userdata('b2c_id');
                if($this->session->userdata('b2c_id')){
                    $data['user_type'] = $user_type = 3;
                    $data['user_id'] = $user_id = $this->session->userdata('b2c_id');
                    $data['userInfo'] = $this->account_model->GetUserData($user_type, $user_id)->row();
                    $data['email'] = $data['userInfo']->email;
                    $data['contact_no'] = $data['userInfo']->contact_no;
                    $data['userInfo'] = $this->account_model->GetUserData($user_type, $user_id)->row();
                }else if($this->session->userdata('b2b_id')){
                    $data['user_type'] = $user_type = 2;
                    $data['user_id'] = $user_id = $this->session->userdata('b2b_id');
                    $data['userInfo'] = $this->account_model->GetUserData($user_type, $user_id)->row();
                    $data['email'] = $data['userInfo']->email_id;
                    $data['contact_no'] = $data['userInfo']->mobile;
                    $data['userInfo'] = $this->account_model->GetUserData($user_type, $user_id)->row();
                }
                
               // echo '<pre>';print_r($cart_global_id);die;
                $this->load->view('apartment/booking2', $data);
                
                }else{
                $this->load->view('errors/expiry');
				}
            
            }else if(!empty($session_id) && !empty($orderIds)){
				
				$count = $this->cart_model->getBookingTemp($session_id)->num_rows();
            if($count > 0){
                $data['countries'] = $this->account_model->getAllCountries()->result();
                //$data['countries'] = $this->apartment_model->getAllKigoCountries()->result();
                $data['book_temp_data'] = $book_temp_data = $this->cart_model->getBookingTemp($session_id)->result();
                //$data['guests'] = $book_temp_data->RES_N_ADULTS+$book_temp_data->RES_N_CHILDREN+$book_temp_data->RES_N_BABIES;
                //$data['RentData'] = json_decode($book_temp_data->RENT_DATA);
                //echo '<pre>';print_r($book_temp_data);die;
                foreach ($book_temp_data as $key => $value) {
                    $cart_global_id[] = $value->module.','.$value->cart_id;
                }
                //echo '<pre>';print_r($cart_global_id);die;
                $data['cart_global'] = $cart_global_id;
                $data['cart_global_id'] = base64_encode(json_encode($cart_global_id));
                $b2c_id = $this->session->userdata('b2c_id');
                if($this->session->userdata('b2c_id')){
                    $data['user_type'] = $user_type = 3;
                    $data['user_id'] = $user_id = $this->session->userdata('b2c_id');
                    $data['userInfo'] = $this->account_model->GetUserData($user_type, $user_id)->row();
                    $data['email'] = $data['userInfo']->email;
                    $data['contact_no'] = $data['userInfo']->contact_no;
                    $data['userInfo'] = $this->account_model->GetUserData($user_type, $user_id)->row();
                }else if($this->session->userdata('b2b_id')){
                    $data['user_type'] = $user_type = 2;
                    $data['user_id'] = $user_id = $this->session->userdata('b2b_id');
                    $data['userInfo'] = $this->account_model->GetUserData($user_type, $user_id)->row();
                    $data['email'] = $data['userInfo']->email_id;
                    $data['contact_no'] = $data['userInfo']->mobile;
                    $data['userInfo'] = $this->account_model->GetUserData($user_type, $user_id)->row();
                }
                
                
                $this->load->view('apartment/booking2', $data);
                
                }else{
                $this->load->view('errors/expiry');
				}
				
				
			}elseif($this->input->get()==true && $this->input->get('orderId')!=''){
				
			$request=$this->input->get();
			 $parent_pnr=trim($request['orderId']);
			  $parent_pnr =base64_decode($parent_pnr);
            $count = $this->booking_model->getBookingByParentPnr($parent_pnr)->num_rows();
            if($count > 0){
                $data['pnr_nos'] = $this->booking_model->getBookingByParentPnr($parent_pnr)->result();
				//echo '<pre>';print_r($data['pnr_nos']);die;
                $this->load->view('apartment/booking2', $data);
            }else{
                $this->load->view('errors/404');
            }
			
		}else{
			
				redirect(base_url());
                $this->load->view('errors/expiry');
            }
       
    }

   
   
    public function checkBillingDetailsB2c($user_id) {
        $billing_details = $this->booking_model->getBillingDetailsB2c($user_id)->row();
        if( $billing_details->billing_firstname == "" &&
            $billing_details->billing_lastname == "" &&
            $billing_details->billing_addressA == "" &&
            $billing_details->billing_middlename == "" &&
            $billing_details->billing_email == "" &&
            $billing_details->billing_contact == "" &&
            $billing_details->billing_country == "" &&
            $billing_details->billing_city == "" &&
            $billing_details->billing_country_code == "" &&
            $billing_details->billing_postal == "") {
            return true;
        } else {
            return false;
        }
    }

   
   
    public function checkBillingDetailsB2b($user_id) {
        $billing_details = $this->booking_model->getBillingDetailsB2b($user_id)->row();
        if( $billing_details->billing_firstname == "" &&
            $billing_details->billing_lastname == "" &&
            $billing_details->billing_addressA == "" &&
            $billing_details->billing_addressB == "" &&
            $billing_details->billing_email == "" &&
            $billing_details->billing_contact == "" &&
            $billing_details->billing_country == "" &&
            $billing_details->billing_city == "" &&
            $billing_details->billing_state == "" &&
            $billing_details->billing_postal == "") {
            return true;
        } else {
            return false;
        }
    }

    public function doPaymentGate($Total, $Email, $OrderId){
		
		$continue = $this->session->userdata('continue');

        $Total = json_decode(base64_decode($Total));
		$Total=number_format(($Total), 2, '.', '');
        //$Total = str_replace('.', '', $Total);
       $tot_amount= json_encode(base64_encode($Total));
       $email_=$Email;
       $OrderId=$OrderId;
       
       /* $data['TotalFare'] = $Total;
     $data['Email'] = jsondecode(base64_decode($Email));
       $data['OrderId'] = json_decode(base64_decode($OrderId));
        $sha1_pwd = 'ticketfinder@123';
        $params = array(
            'AMOUNT' => $Total,
            'CURRENCY' => 'USD',
            'EMAIL' => json_decode(base64_decode($Email)),
            'LANGUAGE' => 'en_US',
            'ORDERID' => json_decode(base64_decode($OrderId)),
            'PSPID' => 'ticketfinder'.$sha1_pwd
        );
      $params = implode($sha1_pwd, array_map(function ($v, $k) { return $k . '=' . $v; }, $params, array_keys($params)));
	//echo $params;exit;
       $data['sha1'] = sha1($params);
        //die;
        $this->load->view('pay/doPayment',$data);
    */
   
        //$url="ideal/pay/requestTransaction.php?amount=$tot_amount&Email=$email_&OrderId=$OrderId";
        redirect($continue."/$OrderId");
       }
    
    
    
   /* public function doPaymentGate($Total, $Email, $OrderId){
        $Total = json_decode(base64_decode($Total));
		$Total=number_format(($Total), 2, '.', '');
        $Total = str_replace('.', '', $Total);
        $data['TotalFare'] = $Total;
        $data['Email'] = json_decode(base64_decode($Email));
        $data['OrderId'] = json_decode(base64_decode($OrderId));
        $sha1_pwd = 'ticketfinder@123';
        $params = array(
            'AMOUNT' => $Total,
            'CURRENCY' => 'USD',
            'EMAIL' => json_decode(base64_decode($Email)),
            'LANGUAGE' => 'en_US',
            'ORDERID' => json_decode(base64_decode($OrderId)),
            'PSPID' => 'ticketfinder'.$sha1_pwd
        );
        $params = implode($sha1_pwd, array_map(function ($v, $k) { return $k . '=' . $v; }, $params, array_keys($params)));
		//echo $params;exit;
        $data['sha1'] = sha1($params);
        //die;
        $this->load->view('common/doPayment',$data);
    }*/

    public function checkout(){
    	//parent::pre_url();
        $checkout_form = $this->input->post();
        $session['checkout']=$this->input->post();
        $this->session->set_userdata($session);
       //print_r($this->input->post());die;
        $checkout_form['address2']='';

        //billing array updates the billing details in respective user tables
        $billing['billing_firstname'] = $checkout_form['first_name'];
        $billing['billing_lastname'] = $checkout_form['last_name'];
         $billing['billing_middlename'] = $checkout_form['middle_name'];
        $billing['billing_addressA'] = $checkout_form['street_address'];
        //$billing['billing_addressB'] = $checkout_form['address2'];
        $billing['billing_email'] = $checkout_form['email'];
        $billing['billing_contact'] = $checkout_form['mobile'];
        $billing['billing_country'] = $checkout_form['country'];
        $billing['billing_country_code'] = $checkout_form['country_code'];
        $billing['billing_city'] = $checkout_form['city'];
        //$billing['billing_state'] = $checkout_form['state'];
        $billing['billing_postal'] = $checkout_form['zip'];
        $BookForBussiness = (isset($checkout_form['BookForBussiness'])) ? $checkout_form['BookForBussiness'] : 'N';
        if($BookForBussiness == 'Y'){
            $billing['BusinessName'] = $checkout_form['company_name'];
            $billing['BusinessVat'] = $checkout_form['company_vat'];
        }        

        //if( $billing_firstname != "" $billing_lastname != "" $billing_addressA != "" $billing_addressB != "" $billing_email != "" $ != "" $ != "" $ != "" $ != "" $ != ""  )

        $total_payable = base64_decode($checkout_form['total']);
        // $total_discount = base64_decode($checkout_form['discount']);
        $cids = base64_decode($checkout_form['cid']);
        $cids = json_decode($cids);
        
        //Promo Code starts here
        $promo_code = base64_decode($checkout_form['code']);
        
        if($promo_code != 'fool'){
	    	 $count = $this->booking_model->check_promocode($promo_code)->num_rows();
	    	if($count == 1){
	    		$promo_data = $this->booking_model->check_promocode($promo_code)->row();
	    		$user_time = time();
	    		 $exp_time = strtotime($promo_data->exp_date);
	    		if ($user_time <= $exp_time) {
	    			$promo_type = $promo_data->promo_type;
	    			$discount = $mdic = $promo_data->discount;
	    			$isCorrent = 'true';
	    		}
	    	}
	    }else{
	    	$isCorrent = 'false';
	    }
	    //echo $promo_type;echo $isCorrent;die;
	    //Promo Code ends here

		if($this->session->userdata('b2c_id')){
            $user_type = 3;
            $user_id = $this->session->userdata('b2c_id');
            $checkBillingDetailsB2c = $this->checkBillingDetailsB2c($user_id);

            //if($checkBillingDetailsB2c) {}
                $this->booking_model->updateBillingDetailsB2c($user_id, $billing);
            
		$payment_method = 'Payment Gateway';
        }else if($this->session->userdata('b2b_id')){
            $user_type = 2;
            $user_id = $this->session->userdata('b2b_id');

            $checkBillingDetailsB2b = $this->checkBillingDetailsB2b($user_id);

            if($checkBillingDetailsB2b) {
                $this->booking_model->updateBillingDetailsB2b($user_id, $billing);
            }

            $status = $this->b2b_check_payment($total_payable, $user_id);
            if($status == false){
            	$data['status'] = -2;
            	echo json_encode($data);die;
            }
			$payment_method = 'Deposit';
        }
        else{
			$payment_method = 'Payment Gateway';
			 $user_type = 0;
			 $user_id = 0;
        	//$data['status'] = -1;
	        //$data['signup_login'] = WEB_URL.'/booking/signup_login';
	       // echo json_encode($data);die;
        }
        
 
        $parent_pnr = $this->generate_parent_pnr();
        
        $ttl = array();
        foreach ($cids as $key => $cid) {
            list($module, $cid) = explode(',', $cid);
            if($module == 'APARTMENT'){
				
					
				$cart_apartment_data = $this->apartment_model->getBookingTemp($cid)->row();
				if($isCorrent == 'true'){
					$total = $cart_apartment_data->TOTAL;
					if($promo_type == 1){
	    				$discount = ($mdic/100) * $total;
	    				$discount = number_format(($discount) ,2,'.','');
	    				$TOTAL = $total-$discount;
	    				$DISCOUNT = $discount;
	    			}else if($promo_type == 2){
	    				$discount = $discount;
	    				if($total >= $promo_data->promo_amount){
	    					$discount = number_format(($discount) ,2,'.','');
		    				$TOTAL = $total-$discount;
		    				$DISCOUNT = $discount;
	    				}else{
	    					$TOTAL = $total;
	    					$DISCOUNT = 0;
	    				}
	    			}
				}else{
					$TOTAL = $cart_apartment_data->TOTAL;
					$DISCOUNT = 0;
				}
				  $ttl[] = $TOTAL;
				  $TravelerDetails = json_encode($checkout_form);
                $booking_apartment = array(
                    'PROP_ID' => $cart_apartment_data->PROP_ID,
                    'PROP_NAME' => $cart_apartment_data->PROP_NAME,
                    'PROP_STREETNO' => $cart_apartment_data->PROP_STREETNO,
                    'PROP_ADDR1' => $cart_apartment_data->PROP_ADDR1,
                    'PROP_ADDR2' => $cart_apartment_data->PROP_ADDR2,
                    'PROP_AUTOCOMPLETE_ADDRESS' => $cart_apartment_data->PROP_AUTOCOMPLETE_ADDRESS,
                    'PROP_APTNO' => $cart_apartment_data->PROP_APTNO,
                    'PROP_POSTCODE' => $cart_apartment_data->PROP_POSTCODE,
                    'PROP_CITY' => $cart_apartment_data->PROP_CITY,
                    'PROP_REGION' => $cart_apartment_data->PROP_REGION,
                    'PROP_COUNTRY' => $cart_apartment_data->PROP_COUNTRY,
                    'PROP_COUNTRY_NAME' => $cart_apartment_data->PROP_COUNTRY_NAME,
                    'PROP_LATITUDE' => $cart_apartment_data->PROP_LATITUDE,
                    'PROP_LONGITUDE' => $cart_apartment_data->PROP_LONGITUDE,
                    'PROP_TYPE_LABEL' => $cart_apartment_data->PROP_TYPE_LABEL,
                    'PROP_CIN_TIME' => $cart_apartment_data->PROP_CIN_TIME,
                    'PROP_COUT_TIME' => $cart_apartment_data->PROP_COUT_TIME,
                    'PROP_INSTANT_BOOK' => $cart_apartment_data->PROP_INSTANT_BOOK,
                    'PROP_SHORTDESCRIPTION' => $cart_apartment_data->PROP_SHORTDESCRIPTION,
                    'PROP_AREADESCRIPTION' => $cart_apartment_data->PROP_AREADESCRIPTION,
                    'PROP_RENTAL_DETAILS' => $cart_apartment_data->PROP_RENTAL_DETAILS,
                    'PROP_ARRIVAL_SHEET' => $cart_apartment_data->PROP_ARRIVAL_SHEET,
                    'PROP_RATE_CURRENCY' => $cart_apartment_data->PROP_RATE_CURRENCY,
                    'PROP_CANCELLATION_TYPE' => $cart_apartment_data->PROP_CANCELLATION_TYPE,
                    'PROP_CANCELLATION_DESC' => $cart_apartment_data->PROP_CANCELLATION_DESC,
                    'PROP_PHOTO' => $cart_apartment_data->PROP_PHOTO,
                    'PROP_USER_TYPE' => $cart_apartment_data->PROP_USER_TYPE,
                    'PROP_USER_ID' => $cart_apartment_data->PROP_USER_ID,
                    'USER_TYPE' => $user_type,
                    'USER_ID' => $user_id,
                    'RES_CHECK_IN' => $cart_apartment_data->RES_CHECK_IN,
                    'RES_CHECK_OUT' => $cart_apartment_data->RES_CHECK_OUT,
                    'NIGHTS' => $cart_apartment_data->NIGHTS,
                    'RES_N_ADULTS' => $cart_apartment_data->RES_N_ADULTS,
                    'RES_N_CHILDREN' => $cart_apartment_data->RES_N_CHILDREN,
                    'RES_N_BABIES' => $cart_apartment_data->RES_N_BABIES,
                    'RES_GUEST_FIRSTNAME' => $checkout_form['first_name'.$cid],
                    'RES_GUEST_LASTNAME' => $checkout_form['last_name'.$cid],
                    'RES_GUEST_EMAIL' => $checkout_form['email'.$cid],
                    'RES_GUEST_PHONE' => $checkout_form['mobile'.$cid],
                    'RES_COMMENT_GUEST' => $checkout_form['msg_to_host'.$cid],
                    'RES_GUEST_COUNTRY' => $checkout_form['country'],
                    'RES_GUEST_ADDRESS' => $checkout_form['street_address'].', '.$checkout_form['address2'],
                    'RES_GUEST_CITY' => $checkout_form['city'],
                    'RES_GUEST_STATE' => $checkout_form['state'],
                    'RES_GUEST_ZIP' => $checkout_form['zip'],
                    'SITE_CURR' => $cart_apartment_data->SITE_CURR,
                    'TOTAL' => $TOTAL,
                    'DISCOUNT' => $DISCOUNT,
					'TravelerDetails' => $TravelerDetails,
					'cid' => $cid,
                    'RENT_DATA' => $cart_apartment_data->RENT_DATA,
                    'TIMESTAMP' => date('Y-m-d H:i:s')
                );
                $booking_apartment_id = $this->apartment_model->insert_booking_apartment($booking_apartment);
				
				$booking = array(
                    'module' => 'APARTMENT',
                    'ref_id' => $booking_apartment_id,
                    'parent_pnr' => $parent_pnr,
                    'user_type' => $user_type,
                    'amount' => $TOTAL,
                    'leadpax' => $checkout_form['first_name'].' '.$checkout_form['last_name'],
                    'user_id' => $user_id,
                    'ip' =>  $this->input->ip_address(),
					'payment_method' => $payment_method
                );
                $bid = $this->apartment_model->Booking_Global($booking);
				 $pnr_no = 'TF'.date('m').'A'.date('dHi').$bid;
                
                $update_booking = array(
                    'pnr_no' => $pnr_no,
					'booking_status' => 'PROCESS',
					'transaction_status' => 'PROCESS'
				);
                $this->apartment_model->Update_Booking_Global($bid, $update_booking, 'APARTMENT');
               
                $this->apartment_model->clearCart($cid);
						
			}else if($module == 'FLIGHT'){
				$cart_flight_data = $this->flight_model->getBookingTemp($cid)->row();

				if($isCorrent == 'true'){
					$total = $cart_flight_data->TotalPrice;
					if($promo_type == 1){
	    				$discount = ($mdic/100) * $total;
	    				$discount = number_format(($discount) ,2,'.','');
	    				$TOTAL = $total-$discount;
	    				$DISCOUNT = $discount;
	    			}else if($promo_type == 2){
	    				 $discount = $discount;
	    				if($total_payable >= $promo_data->promo_amount){
	    					 $discount = number_format(($discount) ,2,'.','');
		    				$TOTAL = $total_payable-$discount;
		    				$DISCOUNT = $discount;
	    				}else{
	    					$TOTAL = $total;
	    					$DISCOUNT = 0;
	    				}
	    			}
				}else{
					$TOTAL = $cart_flight_data->TotalPrice;
					$DISCOUNT = 0;
				}
                $ttl[] = $TOTAL;
				//echo '<pre>';print_r($cart_flight_data);die;
				$TravelerDetails = json_encode($checkout_form);

                if(isset($checkout_form['first_name'.$cid]) && $checkout_form['first_name'.$cid]!=''){
                	$guest_fname=$checkout_form['first_name'.$cid];
                }else{
                	$guest_fname=$checkout_form['first_name'];
                }


                if(isset($checkout_form['last_name'.$cid]) && $checkout_form['last_name'.$cid]!=''){
                	$guest_lname=$checkout_form['last_name'.$cid];
                }else{
                	$guest_lname=$checkout_form['last_name'];
                }


                if(isset($checkout_form['email'.$cid]) && $checkout_form['email'.$cid]!=''){
                	$guest_email=$checkout_form['email'.$cid];
                }else{
                	$guest_email=$checkout_form['email'];
                }

                if(isset($checkout_form['mobile'.$cid]) && $checkout_form['mobile'.$cid]!=''){
                	 $country_code = $this->apartment_model->get_country_phonecode($checkout_form['country_code'.$cid]);
                	$guest_mobile=$country_code.$checkout_form['mobile'.$cid];
                }else{
                	$guest_mobile=$country_code.$checkout_form['mobile'];
                }

                if(isset($checkout_form['middle_name'.$cid]) && $checkout_form['middle_name'.$cid]!=''){
                	$guest_middle_name=$checkout_form['middle_name'.$cid];
                }else{
                	$guest_middle_name='';
                }
                if(isset($checkout_form['selGender'.$cid]) && $checkout_form['selGender'.$cid]!=''){
                	$guest_Gender=$checkout_form['selGender'.$cid];
                }else{
                	$guest_Gender='';
                }
                if(isset($checkout_form['txtdob'.$cid]) && $checkout_form['txtdob'.$cid]!=''){
                	$guest_dob=$checkout_form['txtdob'.$cid];
                }else{
                	$guest_dob='';
                }

                $pass_result=json_decode(base64_decode($checkout_form['passengers']));
                $db_array["middle"]=array();$db_array["gender"]=array();$db_array["first"]=array();$db_array["last"]=array();$db_array["dob"]=array();
                if(isset($checkout_form["pfirst_name$cid"])){
    				$middle_Arr=$checkout_form["pmiddle_name$cid"];
                    $gender_Arr=$checkout_form["pselGender$cid"];
                    $first_Arr=$checkout_form["pfirst_name$cid"];
                    $last_Arr=$checkout_form["plast_name$cid"];
                    $dob_Arr=$checkout_form["ptxtdob$cid"];
                    foreach($middle_Arr as $key=>$value){
                        $db_array["middle"][]=array("$key"=>$value);
                    }
                    foreach($gender_Arr as $key=>$value){
                        $db_array["gender"][]=array("$key"=>$value);
                    }
                    foreach($first_Arr as $key=>$value){
                        $db_array["first"][]=array("$key"=>$value);
                    }
                    foreach($last_Arr as $key=>$value){
                        $db_array["last"][]=array("$key"=>$value);
                    }
                    foreach($dob_Arr as $key=>$value){
                        $db_array["dob"][]=array("$key"=>$value);
                    }
			    }
			    $country_code1 = $this->apartment_model->get_country_phonecode($checkout_form['country_code']);
		        $passenger_full_details=base64_encode(json_encode($db_array));
				$booking_flight = array(
					'request' => $cart_flight_data->request,
					'response' => $cart_flight_data->response,
					'Origin' => $cart_flight_data->Origin,
					'Destination' => $cart_flight_data->Destination,
					'fromCityName' => $cart_flight_data->fromCityName,
					'toCityName' => $cart_flight_data->toCityName,
					'DepartureTime' => $cart_flight_data->DepartureTime,
					'ArrivalTime' => $cart_flight_data->ArrivalTime,
					'duration' => $cart_flight_data->duration,
					'AirImage' => $cart_flight_data->AirImage,
                    'TravelerDetails' => $TravelerDetails,
                    'cid' => $cid,
					'AirPriceRes' => $cart_flight_data->AirPriceRes,
					'GUEST_FIRSTNAME' => $guest_fname,
                    'GUEST_LASTNAME' => $guest_lname,
                    'GUEST_EMAIL' => $guest_email,
                    'GUEST_PHONE' => $guest_mobile ,
					'GUEST_MIDDLENAME' => $guest_middle_name ,
					'GUEST_GENDER' => $guest_Gender ,
					'GUEST_DOB' => date("Y-m-d",strtotime(str_replace("/","-",$guest_dob))) ,
                    'passenger_details' => $checkout_form['passengers'],
                    'passenger_full_details' => $passenger_full_details,
					'BILLING_FIRSTNAME' => $checkout_form['first_name'],
                    'BILLING_MIDDLENAME' => $checkout_form['middle_name'],
                    'BILLING_LASTNAME' => $checkout_form['last_name'],
                    'BILLING_EMAIL' => $checkout_form['email'],
                    'BILLING_ADDRESS' => $checkout_form['street_address'],
                    'BILLING_PHONE' => $country_code1.$checkout_form['mobile'],
                    'BILLING_CITY' => $checkout_form['city'],
                    'BILLING_COUNTRY' => $checkout_form['country'],
                    //'BILLING_STATE' => $checkout_form['state'],
                    'BILLING_ZIP' => $checkout_form['zip'],
					'TotalPrice' => $TOTAL,
					'DISCOUNT' => $DISCOUNT,
                    'RedeemedPoints' => $this->account_model->ReturnRedeemPoints($TOTAL),
					'SITE_CURR' => $cart_flight_data->SITE_CURR,
					'API_CURR' => $cart_flight_data->API_CURR,
                    'MyMarkup' => $cart_flight_data->MyMarkup,
					'BasePrice' => $cart_flight_data->BasePrice,
					'TaxPrice' => $cart_flight_data->TaxPrice,
					'USER_TYPE' => $user_type,
                    'USER_ID' => $user_id,
                    'BookingForBussiness' => $BookForBussiness,
					'AirItinerary_xml' => $cart_flight_data->AirItinerary_xml, 
					'AirPricingSolution_xml' => $cart_flight_data->AirPricingSolution_xml,
					'TIMESTAMP' => date('Y-m-d H:i:s')
				);

				$booking_flight_id = $this->flight_model->insert_booking_flight($booking_flight);
                $FinalTotalPrice = $this->account_model->ReturnRedeemPoints($TOTAL);
                
                if(isset($_SESSION['RedeemStatus']) && $_SESSION['RedeemStatus'] == 'Yes' && $FinalTotalPrice >= 0){
                    $TotalPointsDebited = $TOTAL - $FinalTotalPrice;
                    $PayedAsAmount = $FinalTotalPrice;
                }else{
                    $TotalPointsDebited = 0;
                    $PayedAsAmount = $TOTAL;
                }
                
                $booking = array(
                    'module' => 'FLIGHT',
                    'ref_id' => $booking_flight_id,
                    'parent_pnr' => $parent_pnr,
                    'user_type' => $user_type,
                    'amount' => $TOTAL,
                    'NWERPointsDebited' => $TotalPointsDebited,
                    'PayedAsAmount' => $PayedAsAmount,
                    'leadpax' => $checkout_form['first_name'].' '.$checkout_form['last_name'],
                    'user_id' => $user_id,
                    'ip' =>  $this->input->ip_address(),
					'payment_method' => $payment_method
                );
                $bid = $this->flight_model->Booking_Global($booking);
				
                $pnr_no = 'TF'.date('m').'F'.date('dHi').$bid;
                $update_booking = array(
                    'pnr_no' => $pnr_no,
					'booking_status' => 'PROCESS',
					'transaction_status' => 'PROCESS'
                );
                $this->flight_model->Update_Booking_Global($bid, $update_booking, 'FLIGHT');
                
                if(isset($_SESSION['RedeemStatus']) && $_SESSION['RedeemStatus'] == 'Yes' && isset($_SESSION['RedeemPoints']) && $_SESSION['RedeemPoints'] > 0){
                    $InsertLoyaltyPoints = array(
                        'UserID' => $user_id,
                        'UserType' => $user_type,
                        'Points' => $TotalPointsDebited,
                        'BookingId' => $pnr_no,
                        'TransactionType' => 'Debit',
                        'Description' => 'Debit for Booking - '.$pnr_no,
                        'TransactionStatus' => 'PROCESS'
                    );

                    $this->flight_model->insert_loyalty_points($InsertLoyaltyPoints);
                }else{
                    $InsertLoyaltyPoints = array(
                        'UserID' => $user_id,
                        'UserType' => $user_type,
                        'Points' => (($cart_flight_data->BasePrice*0.75)/100),
                        'BookingId' => $pnr_no,
                        'TransactionType' => 'CREDIT',
                        'Description' => 'Credit for Booking - '.$pnr_no,
                        'TransactionStatus' => 'PROCESS'
                    );

                    $this->flight_model->insert_loyalty_points($InsertLoyaltyPoints);
                }
               //$this->flight_model->clearCart($cid);
				//$pnr_no[] = $this->booking($booking_flight_id, $parent_pnr, $module='FLIGHT');
			}else if($module == 'HOTEL'){
				$cart_hotel_data = $this->hotel_model->getBookingTemp($cid)->row();

				if($isCorrent == 'true'){
					$total = $cart_hotel_data->total_cost;
					if($promo_type == 1){
	    				$discount = ($mdic/100) * $total;
	    				$discount = number_format(($discount) ,2,'.','');
	    				$TOTAL = $total-$discount;
	    				$DISCOUNT = $discount;
	    			}else if($promo_type == 2){
	    				$discount = $discount;
	    				if($total >= $promo_data->promo_amount){
	    					$discount = number_format(($discount) ,2,'.','');
		    				$TOTAL = $total-$discount;
		    				$DISCOUNT = $discount;
	    				}else{
	    					$TOTAL = $total;
	    					$DISCOUNT = 0;
	    				}
	    			}
				}else{
					$TOTAL = $cart_hotel_data->total_cost;
					$DISCOUNT = 0;
				}
				$ttl[] = $TOTAL;
            
           // if($cart_hotel_data->api != 'CRS'){
				$TravelerDetails = json_encode($checkout_form);
                $booking_hotel = array(
                    'session_id' => $cart_hotel_data->session_id,
	                'api' => $cart_hotel_data->api,
	                'hotel_name' => $cart_hotel_data->hotel_name,
	                'imageurl' => $cart_hotel_data->imageurl,
	                'hotel_code' => $cart_hotel_data->hotel_code,
	                'chain_code' => $cart_hotel_data->chain_code,
	                'checkin' => $cart_hotel_data->checkin,
	                'checkout' => $cart_hotel_data->checkout,
	                'room_name' => $cart_hotel_data->room_name,
	                'room_code' => $cart_hotel_data->room_code,
	                'city' => $cart_hotel_data->city,
					 'TravelerDetails' => $TravelerDetails,
	                'city_code' => $cart_hotel_data->city_code,
	                'roomdescription' => $cart_hotel_data->roomdescription,
                    'MyMarkup' => $cart_hotel_data->MyMarkup,
	                'total_cost' => $TOTAL,
	                'DISCOUNT' => $DISCOUNT,
	                'base_cost' => $cart_hotel_data->base_cost,
	                'NonRefundableStayIndicator' => $cart_hotel_data->NonRefundableStayIndicator,
	                'CancelPolicy' => $cart_hotel_data->CancelPolicy,
                    'CancelDeadline' => $cart_hotel_data->CancelDeadline,
                    'CancelCommision'=> $cart_hotel_data->CancelCommision,
	                'CancelPenaltyAmount' => $cart_hotel_data->CancelPenaltyAmount,
	                'CancelPenaltyAmount_currency' => $cart_hotel_data->CancelPenaltyAmount_currency,
	                'status' => $cart_hotel_data->status,
	                'adult' => $cart_hotel_data->adult,
	                'room_count' => $cart_hotel_data->room_count,
					'SITE_CURR' => CURR,
					'currency' => $cart_hotel_data->currency,
					'GUEST_FIRSTNAME' => $checkout_form['first_name'.$cid],
                    'GUEST_LASTNAME' => $checkout_form['last_name'.$cid],
                    'GUEST_EMAIL' => $checkout_form['email'.$cid],
                    'GUEST_PHONE' => $checkout_form['mobile'.$cid],
					'BILLING_FIRSTNAME' => $checkout_form['first_name'],
                    'BILLING_LASTNAME' => $checkout_form['last_name'],
                    'BILLING_EMAIL' => $checkout_form['email'],
                    'BILLING_PHONE' => $checkout_form['mobile'],
                    'BILLING_COUNTRY' => $checkout_form['country'],
                    'BILLING_ADDRESS' => $checkout_form['street_address'].', '.$checkout_form['address2'],
                    'BILLING_CITY' => $checkout_form['city'],
                    'BILLING_STATE' => $checkout_form['state'],
                    'BILLING_ZIP' => $checkout_form['zip'],
					'USER_TYPE' => $user_type,
                    'USER_ID' => $user_id,
					
					'TIMESTAMP' => date('Y-m-d H:i:s')
                );
                $booking_hotel_id = $this->hotel_model->insert_booking_hotel($booking_hotel);
				
				$booking = array(
                    'module' => 'HOTEL',
                    'ref_id' => $booking_hotel_id,
                    'parent_pnr' => $parent_pnr,
                    'user_type' => $user_type,
                    'amount' => $TOTAL,
                    'leadpax' => $checkout_form['first_name'].' '.$checkout_form['last_name'],
                    'user_id' => $user_id,
                    'ip' =>  $this->input->ip_address(),
					'payment_method' => $payment_method
                );
                $bid = $this->hotel_model->Booking_Global($booking);
               
                $pnr_no = 'TF'.date('m').'H'.date('dHi').$bid;
                $update_booking = array(
                    'pnr_no' => $pnr_no,
					'booking_status' => 'PROCESS',
					'transaction_status' => 'PROCESS'
                );
                $this->hotel_model->Update_Booking_Global($bid, $update_booking, 'HOTEL');
                
             
                $this->hotel_model->clearCart($cid);
			}else if($module == 'CAR'){$cart_car_data = $this->car_model->getBookingTemp($cid)->row();
				$car = json_decode(base64_decode($cart_car_data->response));
				if($isCorrent == 'true'){
					$total = $cart_car_data->TotalPrice;
					if($promo_type == 1){
	    				$discount = ($mdic/100) * $total;
	    				$discount = number_format(($discount) ,2,'.','');
	    				$TOTAL = $total-$discount;
	    				$DISCOUNT = $discount;
	    			}else if($promo_type == 2){
	    				$discount = $discount;
	    				if($total >= $promo_data->promo_amount){
	    					$discount = number_format(($discount) ,2,'.','');
		    				$TOTAL = $total-$discount;
		    				$DISCOUNT = $discount;
	    				}else{
	    					$TOTAL = $total;
	    					$DISCOUNT = 0;
	    				}
	    			}
				}else{
					$TOTAL = $cart_car_data->TotalPrice;
					$DISCOUNT = 0;
				}
				 $ttl[] = $TOTAL;
				//echo '<pre>';print_r($cart_flight_data);die;
				$TravelerDetails = json_encode($checkout_form);
				
				//echo '<pre>';print_r($cart_flight_data);die;
				
				$booking_car = array(
					'request' => $cart_car_data->request,
					'response' => $cart_car_data->response,
					'Pickup' => $cart_car_data->Pickup,
		            'Dropoff' => $cart_car_data->Dropoff,
		            'pickupCityName' => $cart_car_data->pickupCityName,
		            'dropoffCityName' => $cart_car_data->dropoffCityName,
		            'DepartureTime' => $cart_car_data->DepartureTime,
		            'ReturnTime' => $cart_car_data->ReturnTime,
		            'CarImage' =>  $cart_car_data->CarImage,
					'GUEST_FIRSTNAME' => $checkout_form['first_name'.$cid],
                    'GUEST_LASTNAME' => $checkout_form['last_name'.$cid],
                    'GUEST_EMAIL' => $checkout_form['email'.$cid],
                    'GUEST_PHONE' => $checkout_form['mobile'.$cid],
					'BILLING_FIRSTNAME' => $checkout_form['first_name'],
                    'BILLING_LASTNAME' => $checkout_form['last_name'],
                    'BILLING_EMAIL' => $checkout_form['email'],
                    'BILLING_PHONE' => $checkout_form['mobile'],
                    'BILLING_COUNTRY' => $checkout_form['country'],
                    'BILLING_ADDRESS' => $checkout_form['street_address'].', '.$checkout_form['address2'],
                    'BILLING_CITY' => $checkout_form['city'],
                    'BILLING_STATE' => $checkout_form['state'],
                    'BILLING_ZIP' => $checkout_form['zip'],
					'TotalPrice' => $TOTAL,
					'DISCOUNT' => $DISCOUNT,
					'BasePrice' => $cart_car_data->BasePrice,
					'SITE_CURR' => $cart_car_data->SITE_CURR,
					'API_CURR' => $cart_car_data->API_CURR,
                    'MyMarkup' => $cart_car_data->MyMarkup,
					'USER_TYPE' => $user_type,
                    'USER_ID' => $user_id,
					//'VehicleCreateReservationRes' => $VehicleCreateReservationRes,
					//'msg' => $Remarks,
					//'booking_res' => $booking_res,
					'TravelerDetails' => $TravelerDetails,
                    'cid' => $cid,
					
					'TIMESTAMP' => date('Y-m-d H:i:s')
				);
				$booking_car_id = $this->car_model->insert_booking_car($booking_car);
				
				
	             $booking = array(
                    'module' => 'CAR',
                    'ref_id' => $booking_car_id,
                    'parent_pnr' => $parent_pnr,
                    'user_type' => $user_type,
                    'amount' => $TOTAL,
                    'leadpax' => $checkout_form['first_name'].' '.$checkout_form['last_name'],
                    'user_id' => $user_id,
                    'ip' =>  $this->input->ip_address(),
					'payment_method' => $payment_method
                );
                $bid = $this->car_model->Booking_Global($booking);
                $pnr_no = 'TF'.date('m').'C'.date('dHi').$bid;
                $update_booking = array(
                    'pnr_no' => $pnr_no,
					'booking_status' => 'PROCESS',
					'transaction_status' => 'PROCESS'
                );
                $this->car_model->Update_Booking_Global($bid, $update_booking, 'CAR');
			
				$this->car_model->clearCart($cid);
			}else if($module == 'VACATION'){	
                $cart_vacation_data = $this->vacation_model->getBookingTemp($cid)->row();
				$vacation = json_decode(base64_decode($cart_vacation_data->response));
				if($isCorrent == 'true'){
					$total = $cart_vacation_data->TotalPrice;
					if($promo_type == 1){
	    				$discount = ($mdic/100) * $total;
	    				$discount = number_format(($discount) ,2,'.','');
	    				$TOTAL = $total-$discount;
	    				$DISCOUNT = $discount;
	    			}else if($promo_type == 2){
	    				$discount = $discount;
	    				if($total >= $promo_data->promo_amount){
	    					$discount = number_format(($discount) ,2,'.','');
		    				$TOTAL = $total-$discount;
		    				$DISCOUNT = $discount;
	    				}else{
	    					$TOTAL = $total;
	    					$DISCOUNT = 0;
	    				}
	    			}
				}else{
					$TOTAL = $cart_vacation_data->TotalPrice;
					$DISCOUNT = 0;
				}
					$ttl[] = $TOTAL;
           			$TravelerDetails = json_encode($checkout_form);
				
			     $booking_vacation = array(
					'request' => $cart_vacation_data->request,
					'response' => $cart_vacation_data->response,
					'city' => $cart_vacation_data->city,
		            'vacCityName' => $cart_vacation_data->vacCityName,
		            'vacDate' => $cart_vacation_data->vacDate,
		            'VacationImage' =>  $cart_vacation_data->VacationImage,
					'GUEST_FIRSTNAME' => $checkout_form['first_name'.$cid],
                    'GUEST_LASTNAME' => $checkout_form['last_name'.$cid],
                    'GUEST_EMAIL' => $checkout_form['email'.$cid],
                    'GUEST_PHONE' => $checkout_form['mobile'.$cid],
					'BILLING_FIRSTNAME' => $checkout_form['first_name'],
                    'BILLING_LASTNAME' => $checkout_form['last_name'],
                    'BILLING_EMAIL' => $checkout_form['email'],
                    'BILLING_PHONE' => $checkout_form['mobile'],
                    'BILLING_COUNTRY' => $checkout_form['country'],
                    'BILLING_ADDRESS' => $checkout_form['street_address'].', '.$checkout_form['address2'],
                    'BILLING_CITY' => $checkout_form['city'],
                    'BILLING_STATE' => $checkout_form['state'],
                    'BILLING_ZIP' => $checkout_form['zip'],
                    'MyMarkup' => $cart_vacation_data->MyMarkup,
					'TotalPrice' => $TOTAL,
					'DISCOUNT' => $DISCOUNT,
					'SITE_CURR' => $cart_vacation_data->SITE_CURR,
					'USER_TYPE' => $user_type,
                    'USER_ID' => $user_id,
					'TravelerDetails' => $TravelerDetails,
					//'msg' => $Remarks,
					//'booking_res' => $booking_res,
					'TIMESTAMP' => date('Y-m-d H:i:s')
				);
				$booking_vacation_id = $this->vacation_model->insert_booking_vacation($booking_vacation);
				
				
				 $booking = array(
                    'module' => 'VACATION',
                    'ref_id' => $booking_vacation_id,
                    'parent_pnr' => $parent_pnr,
                    'user_type' => $user_type,
                    'amount' => $TOTAL,
                    'leadpax' => $checkout_form['first_name'].' '.$checkout_form['last_name'],
                    'user_id' => $user_id,
                    'ip' =>  $this->input->ip_address(),
					'payment_method' => $payment_method
                );
                $bid = $this->vacation_model->Booking_Global($booking);
               $pnr_no = 'TF'.date('m').'V'.date('dHi').$bid;
                $update_booking = array(
                    'pnr_no' => $pnr_no,
					'booking_status' => 'PROCESS',
					'transaction_status' => 'PROCESS'
                );
                $this->vacation_model->Update_Booking_Global($bid, $update_booking, 'VACATION');
				
                $this->vacation_model->clearCart($cid);
			}
        }

        if($this->session->userdata('b2b_id')){
           /* $user_type = 2;
            $user_id = $this->session->userdata('b2b_id');
            $this->booking($parent_pnr);
            $data['status'] = 1;
            $data['voucher_url'] = WEB_URL.'/booking/confirm/'.base64_encode($parent_pnr);
            echo json_encode($data);
			*/
			
			$GateURL = WEB_URL.'/booking/book/'.$parent_pnr;
            $data['status'] = 555;
            $data['GateURL'] = $GateURL;
            echo json_encode($data);
            die;
			
			
        }else{
			
            $Email =  $checkout_form['email'];
            $OrderId = $parent_pnr;
            $TOTAL = array_sum($ttl);
            $TOTAL = base64_encode(json_encode($TOTAL));
            $Email = base64_encode(json_encode($Email));
            $OrderId = base64_encode(json_encode($OrderId));
            
             $GateURL = WEB_URL.'/booking/doPaymentGate/'.$TOTAL.'/'.$Email.'/'.$OrderId;
            $data['status'] = 555;
            $data['GateURL'] = $GateURL;
            echo json_encode($data);
            die;
        }
		
		//echo '<pre>';print_r($pnr_no);die;
    }

    public function booking($booking_id, $parent_pnr, $module){
		
		
		
		if($module == 'APARTMENT'){
			$count = $this->apartment_model->getBookingApartmentTemp($booking_id)->num_rows();
			if($count == 1){
				//$count = $this->apartment_model->CheckDuplicateBooking($booking_id)->num_rows();
				//if($count == 0){
					$book_temp_data = $this->apartment_model->getBookingApartmentTemp($booking_id)->row();
					if($book_temp_data->PROP_INSTANT_BOOK == '1'){
						$bStatus = 'CONFIRMED';
						$aStatus = 'CONFIRMED';
						if($this->session->userdata('b2b_id')){
				            $user_type = 2;
				            $user_id = $this->session->userdata('b2b_id');
				            $this->b2b_do_payment($booking_id,$module,$book_temp_data->TOTAL,'0.00',$user_id);
                        }
                        $Property = $this->apartment_model->getApartmentDetails($book_temp_data->PROP_ID)->row();
                        if ($Property->KIGO_PROPERTY_ID == NULL) {
                            $pid = $Property->PROPERTY_ID;
                        }else{
                            $pid = $Property->KIGO_PROPERTY_ID;
                        }
                        $reservation_calender = array(
                            'PROP_ID' => $pid,
                            'RES_STATUS' => 'CONFIRMED',
                            'RES_CHECK_IN' => $book_temp_data->RES_CHECK_IN,
                            'RES_CHECK_OUT' => $book_temp_data->RES_CHECK_OUT,
                            'RES_IS_FOR' => 0
                        );
                        $this->apartment_model->insert_reservation_calender($reservation_calender);
					}else{
						$bStatus = 'PENDING';
						$aStatus = 'HOLD';
					}
						
					$booking = array(
						'module' => 'APARTMENT',
						'ref_id' => $booking_id,
						'parent_pnr' => $parent_pnr,
						'user_type' => $book_temp_data->USER_TYPE,
						'amount' => $book_temp_data->TOTAL,
						'leadpax' => $book_temp_data->RES_GUEST_FIRSTNAME.' '.$book_temp_data->RES_GUEST_LASTNAME,
						'user_id' => $book_temp_data->USER_ID,
						'ip' =>  $this->input->ip_address(),
						'api_status' => $aStatus,
						'booking_status' => $bStatus
					);
					$bid = $this->apartment_model->Booking_Global($booking);
					$pnr_no = 'TF00APT000'.$bid;
					$update_booking = array(
						'pnr_no' => $pnr_no,
						'booking_no' => 'XXXXXXXXXX'
					);
					
					$this->apartment_model->Update_Booking_Global($bid, $update_booking, 'APARTMENT');
					if($book_temp_data->PROP_INSTANT_BOOK == '1'){
                        if($this->session->userdata('b2b_id')){
                         $user_type = 2;
                         $user_id = $this->session->userdata('b2b_id');
                        	$this->b2b_do_payment_account($pnr_no,$module,$book_temp_data->TOTAL,'0.00',$user_id);
                        }
					}
					 
					if($book_temp_data->PROP_INSTANT_BOOK == '1'){
						$this->get_mail_content_apartmentVoucher($pnr_no);
						$this->sms_model->send_booking_host_sms($book_temp_data->PROP_USER_TYPE,$book_temp_data->PROP_USER_ID,$pnr_no,2);
					}else{
						$this->get_mail_content_apartmentNonInstantVoucher($pnr_no);
						$host_data = $this->account_model->GetUserData($book_temp_data->PROP_USER_TYPE, $book_temp_data->PROP_USER_ID)->row();
						$message_id = $this->generate_random_key(10);
						$message = 'Please accept the request of guest '.$host_data->firstname.' to confirm the reservation #'.$pnr_no.', or decline to cancel reservation';
						$inbox_data = array(
						  'message_id'=>$message_id,
						  'msg_type' => '2',
						  'booking_id' => $pnr_no, 
						  'sender_id'=>$book_temp_data->USER_ID, 
						  'receiver_id'=>$book_temp_data->PROP_USER_ID,
						  'init_user_id'=>$book_temp_data->USER_ID, 
						  'init_receiver_id'=>$book_temp_data->PROP_USER_ID,  
						  'message'=>$message,
						  'msg_date_time'=>date('Y-m-d H:i:s')
						);
						$this->Message_Model->insertMessage($inbox_data);
						
						$this->sms_model->send_booking_host_sms($book_temp_data->PROP_USER_TYPE,$book_temp_data->PROP_USER_ID,$pnr_no,1);
					}
					
					$this->sms_model->send_booking_sms($pnr_no);
					return $pnr_no;
					//redirect(WEB_URL.'/apartment/confirm/'.$pnr_no);
				//}else{
					//echo 'Invalid Data';
				//}
			}else{
				  $this->load->view('errors/404');
			}
		}
		if($module == 'FLIGHT'){
			$count = $this->flight_model->getBookingFlightTemp($booking_id)->num_rows();
			if($count == 1){
				//$count = $this->flight_model->CheckDuplicateBooking($booking_id)->num_rows();
				//if($count == 0){
					$book_temp_data = $this->flight_model->getBookingFlightTemp($booking_id)->row();
					$booking_res = json_decode($book_temp_data->booking_res);
					//echo '<pre>';print_r($booking_res);die;
					if($booking_res->BookingStatus == 'CONFIRMED'){
						$bStatus = 'CONFIRMED';
						$aStatus = 'CONFIRMED';
						if($this->session->userdata('b2b_id')){
				            $user_type = 2;
				            $user_id = $this->session->userdata('b2b_id');
				            $this->b2b_do_payment($booking_id,$module,$book_temp_data->TotalPrice,$book_temp_data->MyMarkup,$user_id);
				        }
					}else{
						$bStatus = 'FAILED';
						$aStatus = 'HOLD';
					}
					$booking = array(
						'module' => 'FLIGHT',
						'ref_id' => $booking_id,
						'parent_pnr' => $parent_pnr,
						'user_type' => $book_temp_data->USER_TYPE,
						'amount' => $book_temp_data->TotalPrice,
						'leadpax' => $book_temp_data->BILLING_FIRSTNAME.' '.$book_temp_data->BILLING_LASTNAME,
						'user_id' => $book_temp_data->USER_ID,
						'ip' =>  $this->input->ip_address(),
						'api_status' => $aStatus,
						'booking_status' => $bStatus
					);
					$bid = $this->flight_model->Booking_Global($booking);
					$pnr_no = 'TF00FLT000'.$bid;
					$update_booking = array(
						'pnr_no' => $pnr_no,
						'booking_no' => $booking_res->LocatorCode
					);
					
					$this->flight_model->Update_Booking_Global($bid, $update_booking, 'FLIGHT');
					if($booking_res->BookingStatus == 'CONFIRMED'){
                        if($this->session->userdata('b2b_id')){
				            $user_type = 2;
				            $user_id = $this->session->userdata('b2b_id');
					       $this->b2b_do_payment_account($pnr_no,$module,$book_temp_data->TotalPrice,$book_temp_data->MyMarkup,$user_id);
                        }
					}
					//Here We have to send mail
                    $this->flight_mail_voucher_pm($pnr_no);
					$this->sms_model->send_booking_sms($pnr_no);
					return $pnr_no;
				//}else{
					//echo 'Invalid inf';
				//}
			}else{
				  $this->load->view('errors/404');
			}
		}
		if($module == 'HOTEL'){
			$count = $this->hotel_model->getBookingHotelTemp($booking_id)->num_rows();
			if($count == 1){
				//$count = $this->flight_model->CheckDuplicateBooking($booking_id)->num_rows();
				//if($count == 0){
					$book_temp_data = $this->hotel_model->getBookingHotelTemp($booking_id)->row();
					$booking_res = json_decode($book_temp_data->booking_res);
					//echo '<pre>';print_r($booking_res);die;
					if($booking_res->BookingStatus == 'CONFIRMED'){
					//echo '<pre>';print_r($booking_res);die;
				
						$bStatus = 'CONFIRMED';
						$aStatus = 'CONFIRMED';
						if($this->session->userdata('b2b_id')){
				            $user_type = 2;
				            $user_id = $this->session->userdata('b2b_id');
				            $this->b2b_do_payment($booking_id,$module,$book_temp_data->total_cost,$book_temp_data->MyMarkup,$user_id);
				        }
					}else{
						$bStatus = 'FAILED';
						$aStatus = 'HOLD';
					}
					$booking = array(
						'module' => 'HOTEL',
						'ref_id' => $booking_id,
						'parent_pnr' => $parent_pnr,
						'user_type' => $book_temp_data->USER_TYPE,
						'amount' => $book_temp_data->total_cost,
						'leadpax' => $book_temp_data->BILLING_FIRSTNAME.' '.$book_temp_data->BILLING_LASTNAME,
						'user_id' => $book_temp_data->USER_ID,
						'ip' =>  $this->input->ip_address(),
						'api_status' => $aStatus,
						'booking_status' => $bStatus
					);
					$bid = $this->hotel_model->Booking_Global($booking);
					$pnr_no = 'TF00HTL000'.$bid;
					$update_booking = array(
						'pnr_no' => $pnr_no,
						'booking_no' => $booking_res->LocatorCode
					);
					$this->hotel_model->Update_Booking_Global($bid, $update_booking, 'HOTEL');
					if($booking_res->BookingStatus == 'CONFIRMED'){
						if($this->session->userdata('b2b_id')){
				            $user_type = 2;
				            $user_id = $this->session->userdata('b2b_id');
					 $this->b2b_do_payment_account($pnr_no,$module,$book_temp_data->total_cost,$book_temp_data->MyMarkup,$user_id);
						}
					}
					//Here We have to send mail
					$this->hotel_mail_voucher($pnr_no);
					$this->sms_model->send_booking_sms($pnr_no);
					return $pnr_no;
				//}else{
					//echo 'Invalid inf';
				//}
			}else{
				  $this->load->view('errors/404');
			}
		}
		if($module == 'CAR'){
			$count = $this->car_model->getBookingCarTemp($booking_id)->num_rows();
			if($count == 1){
				//$count = $this->flight_model->CheckDuplicateBooking($booking_id)->num_rows();
				//if($count == 0){
					$book_temp_data = $this->car_model->getBookingCarTemp($booking_id)->row();
					$booking_res = json_decode($book_temp_data->booking_res);
					//echo '<pre>';print_r($booking_res);die;
					if($booking_res->BookingStatus == 'CONFIRMED'){
						$bStatus = 'CONFIRMED';
						$aStatus = 'CONFIRMED';
						if($this->session->userdata('b2b_id')){
				            $user_type = 2;
				            $user_id = $this->session->userdata('b2b_id');
				            $this->b2b_do_payment($booking_id,$module,$book_temp_data->TotalPrice,$book_temp_data->MyMarkup,$user_id);
				        }
					}else{
						$bStatus = 'FAILED';
						$aStatus = 'FAILED';
					}
					$booking = array(
						'module' => 'CAR',
						'ref_id' => $booking_id,
						'parent_pnr' => $parent_pnr,
						'user_type' => $book_temp_data->USER_TYPE,
						'amount' => $book_temp_data->TotalPrice,
						'leadpax' => $book_temp_data->BILLING_FIRSTNAME.' '.$book_temp_data->BILLING_LASTNAME,
						'user_id' => $book_temp_data->USER_ID,
						'ip' =>  $this->input->ip_address(),
						'api_status' => $aStatus,
						'booking_status' => $bStatus
					);
					$bid = $this->car_model->Booking_Global($booking);
					$pnr_no = 'TF00CAR000'.$bid;
					$update_booking = array(
						'pnr_no' => $pnr_no,
						'booking_no' => $booking_res->LocatorCode
					);
					$this->car_model->Update_Booking_Global($bid, $update_booking, 'CAR');
						if($booking_res->BookingStatus == 'CONFIRMED'){
							if($this->session->userdata('b2b_id')){
				            $user_type = 2;
				            $user_id = $this->session->userdata('b2b_id');
					  $this->b2b_do_payment_account($pnr_no,$module,$book_temp_data->TotalPrice,$book_temp_data->MyMarkup,$user_id);
							}
						}
					//Here We have to send mail
                    $this->car_mail_voucher($pnr_no);
					$this->sms_model->send_booking_sms($pnr_no);
					return $pnr_no;
				//}else{
					//echo 'Invalid inf';
				//}
			}else{
				  $this->load->view('errors/404');
			}
		}
		if($module == 'VACATION'){
			$count = $this->vacation_model->getBookingVacationTemp($booking_id)->num_rows();
			if($count == 1){
				//$count = $this->flight_model->CheckDuplicateBooking($booking_id)->num_rows();
				//if($count == 0){
					$book_temp_data = $this->vacation_model->getBookingVacationTemp($booking_id)->row();
					$booking_res = json_decode($book_temp_data->booking_res);
					//echo '<pre>';print_r($booking_res);die;
					if($booking_res->BookingStatus == 'CONFIRMED'){
						$bStatus = 'CONFIRMED';
						$aStatus = 'CONFIRMED';
						if($this->session->userdata('b2b_id')){
				            $user_type = 2;
				            $user_id = $this->session->userdata('b2b_id');
				            $this->b2b_do_payment($booking_id,$module,$book_temp_data->TotalPrice,$book_temp_data->MyMarkup,$user_id);
				        }
					}else{
						$bStatus = 'FAILED';
						$aStatus = 'FAILED';
					}
					$booking = array(
						'module' => 'VACATION',
						'ref_id' => $booking_id,
						'parent_pnr' => $parent_pnr,
						'user_type' => $book_temp_data->USER_TYPE,
						'amount' => $book_temp_data->TotalPrice,
						'leadpax' => $book_temp_data->BILLING_FIRSTNAME.' '.$book_temp_data->BILLING_LASTNAME,
						'user_id' => $book_temp_data->USER_ID,
						'ip' =>  $this->input->ip_address(),
						'api_status' => $aStatus,
						'booking_status' => $bStatus
					);
					$bid = $this->vacation_model->Booking_Global($booking);
					$pnr_no = 'TF00VAC000'.$bid;
					$update_booking = array(
						'pnr_no' => $pnr_no,
						'booking_no' => $booking_res->LocatorCode
					);
					$this->vacation_model->Update_Booking_Global($bid, $update_booking, 'VACATION');
					if($booking_res->BookingStatus == 'CONFIRMED'){
						
						if($this->session->userdata('b2b_id')){
				            $user_type = 2;
				            $user_id = $this->session->userdata('b2b_id');
					$this->b2b_do_payment_account($pnr_no,$module,$book_temp_data->TotalPrice,$book_temp_data->MyMarkup,$user_id);
						}
					}
					//Here We have to send mail
                    $this->vacation_mail_voucher($pnr_no);
					$this->sms_model->send_booking_sms($pnr_no);
					return $pnr_no;
				//}else{
					//echo 'Invalid inf';
				//}
			}else{
				  $this->load->view('errors/404');
			}
		}
    }

    public function book($parent_pnr){
        $count = $this->payment_model->validate_order_id_org($parent_pnr)->num_rows();
		if($count >= 1){
			$global_ids = $this->payment_model->validate_order_id_org($parent_pnr)->result();
			
			foreach ($global_ids as $key => $global_id) {
				$booking_id = $global_id->ref_id;
				$module = $global_id->module;
				$bid = $global_id->id;
				$pnr_no = $global_id->pnr_no;
				$payment_method = $global_id->payment_method;
				$error_message='';
				
				if($payment_method=='Deposit'){
					$user_type = $global_id->user_type;$user_id = $global_id->user_id;
					if($this->session->userdata('user_type') == $user_type && $this->session->userdata('b2b_id') == $user_id){
						$book_check = 'ok';
						$error_message.='|Deposit - OK.';
					}else{
						$book_check = 'notok';
						$error_message.='|Deposit - User ID and User Type Not a valid.';
					}
				}elseif($payment_method=='Payment Gateway'){
    				$payment_status = $global_id->payment_status;
    				$transaction_status = $global_id->transaction_status;
					if($payment_status == 5 && $transaction_status== 'SUCCESS'){
						$book_check = 'ok';
						$error_message.='|Payment Gateway - OK.';
					}else{
						$book_check = 'notok';
						$error_message.='|Payment Gateway - Status not authorized.';
					}
				}else{
					$book_check = 'notok';
					$error_message.='|Not a valid user.';
				}
			
				if($book_check=='ok'){
			
					if($module == 'APARTMENT'){
						$count = $this->apartment_model->getBookingApartmentTemp($booking_id)->num_rows();
						if($count == 1){
							//$count = $this->flight_model->CheckDuplicateBooking($booking_id)->num_rows();
							//if($count == 0){
							$book_temp_data = $cart_apartment_data = $this->apartment_model->getBookingApartmentTemp($booking_id)->row();
							//echo '<pre>';print_r($book_temp_data);
							if($book_temp_data->PROP_INSTANT_BOOK == '1'){
        						$bStatus = 'CONFIRMED';
        						$aStatus = 'CONFIRMED';
						
                                $Property = $this->apartment_model->getApartmentDetails($book_temp_data->PROP_ID)->row();
                                if ($Property->KIGO_PROPERTY_ID == NULL) {

                                    $pid = $Property->PROPERTY_ID;
                                }else{
                                    $pid = $Property->KIGO_PROPERTY_ID;
                                }
                                $reservation_calender = array(
                                    'PROP_ID' => $pid,
                                    'RES_STATUS' => 'CONFBookIRMED',
                                    'RES_CHECK_IN' => $book_temp_data->RES_CHECK_IN,
                                    'RES_CHECK_OUT' => $book_temp_data->RES_CHECK_OUT,
                                    'RES_IS_FOR' => 0
                                );
                                $this->apartment_model->insert_reservation_calender($reservation_calender);
        					}else{
        						$bStatus = 'PENDING';
        						$aStatus = 'HOLD';
        					}
						
							$update_booking = array(
                                'api_status' => $aStatus,
                                'booking_status' => $bStatus
							);
                            $bookingInfo = $this->apartment_model->getBookingInfo($bid)->row();
                            $nights = $book_temp_data->NIGHTS;
                            if($nights < 15){
                                $rangeType = 1;
                            }else if($nights >= 15){
                                $rangeType = 2;
                            }
                            $rent = json_decode($book_temp_data->RENT_DATA);
							
                            $net_rate = $rent->RentSubtotal_Sys;

                            $service_charge = $this->apartment_model->get_host_charge('Kigo', $rangeType)->row(); 
                            $host_charge = $service_charge->service_charge;
                            $host_charge = $this->account_model->PercentageAmount($net_rate,$host_charge);
                            $payout_host = $net_rate - $host_charge;
                            $host_data = $this->account_model->GetUserData($book_temp_data->PROP_USER_TYPE, $book_temp_data->PROP_USER_ID)->row();
                            if($book_temp_data->PROP_USER_TYPE == '2'){
                                $host_email = $host_data->email_id;
                                $host_image = $host_data->agent_logo;
                            }else if($book_temp_data->PROP_USER_TYPE == '3'){
                                $host_email = $host_data->email;
                                $host_image = $host_data->profile_photo;
                            }
                            $apartment_transaction = array(
                                'pnr_no' => $bookingInfo->pnr_no,
                                'booking_global_id' => $bookingInfo->id,
                                'prop_id' => $book_temp_data->PROP_ID,
                                'prop_name' => $book_temp_data->PROP_NAME,
                                'user_type' => $book_temp_data->USER_TYPE,
                                'user_id' => $book_temp_data->USER_ID,
                                'host_type' => $book_temp_data->PROP_USER_TYPE,
                                'host_id' => $book_temp_data->PROP_USER_ID,
                                'host_email' => $host_email,
                                'host_name' => $host_data->firstname.' '.$host_data->lastname,
                                'host_image' => $host_image,
                                'net_rate' => $net_rate,
                                'apt_charge' => $rent->service_charge_Sys,
                                'booking_amount' => $book_temp_data->TOTAL,
                                'host_charge' => $host_charge,
                                'payout_amount' => $payout_host,
                                'travel_date' => $book_temp_data->RES_CHECK_IN,
                            );
                            $t_id = $this->apartment_model->ApartmentTransaction($apartment_transaction);
                            $apartment_transaction_tracking = array(
                                'apartment_transaction_id' => $t_id,
                                'host_type' => $book_temp_data->PROP_USER_TYPE,
                                'host_id' => $book_temp_data->PROP_USER_ID,
                                'hold' => '1'
                            );
                            $this->apartment_model->ApartmentTransactionTracking($apartment_transaction_tracking);
						    //echo '<pre>';print_r($apartment_transaction);die;
							$this->apartment_model->Update_Booking_Global($bid, $update_booking, 'APARTMENT');
							
							if($book_temp_data->PROP_INSTANT_BOOK == '1'){
        						//$this->get_mail_content_apartmentVoucher($pnr_no);
        						//$this->sms_model->send_booking_host_sms($book_temp_data->PROP_USER_TYPE,$book_temp_data->PROP_USER_ID,$pnr_no,2);
        					}else{
        						//$this->get_mail_content_apartmentNonInstantVoucher($pnr_no);
        						$host_data = $this->account_model->GetUserData($book_temp_data->PROP_USER_TYPE, $book_temp_data->PROP_USER_ID)->row();
        						$message_id = $this->generate_random_key(10);
        						$message = 'Please accept the request of guest '.$host_data->firstname.' to confirm the reservation #'.$pnr_no.', or decline to cancel reservation';
        						$inbox_data = array(
        						  'message_id'=>$message_id,
        						  'msg_type' => '2',
        						  'booking_id' => $pnr_no, 
        						  'sender_id'=>$book_temp_data->USER_ID, 
        						  'receiver_id'=>$book_temp_data->PROP_USER_ID,
        						  'init_user_id'=>$book_temp_data->USER_ID, 
        						  'init_receiver_id'=>$book_temp_data->PROP_USER_ID,  
        						  'message'=>$message,
        						  'msg_date_time'=>date('Y-m-d H:i:s')
        						);
        						$this->Message_Model->insertMessage($inbox_data);
        						
        						//$this->sms_model->send_booking_host_sms($book_temp_data->PROP_USER_TYPE,$book_temp_data->PROP_USER_ID,$pnr_no,1);
        					}
					
					      // $this->sms_model->send_booking_sms($pnr_no);
					
							if($bStatus == 'CONFIRMED'){
								if($this->session->userdata('b2b_id')){
									$user_type = 2;
									$user_id = $this->session->userdata('b2b_id');
									$this->b2b_do_payment_account($pnr_no,$module,$book_temp_data->TOTAL,'0.00',$user_id);
									$error_message.='|'.$booking_id.'-booking amount debited from your account';
								}else{
									$error_message.='|'.$booking_id.'-booking amount not debited from your account. b2b session not  exist';
								}
							}else{
									$error_message.='|'.$booking_id.'-booking amount not debited from your account. booking not confirmed';
							}
						
						}else{
							$error_message.='|'.$booking_id.'-Booking data not there';
						}
					}

					if($module == 'FLIGHT'){
						$count = $this->flight_model->getBookingFlightTemp($booking_id)->num_rows();
						if($count == 1){
							//$count = $this->flight_model->CheckDuplicateBooking($booking_id)->num_rows();
							//if($count == 0){
							$book_temp_data = $cart_flight_data = $this->flight_model->getBookingFlightTemp($booking_id)->row();
							$checkout_form = json_decode($book_temp_data->TravelerDetails);
							$cid = $book_temp_data->cid;
							$passengers=$book_temp_data->passenger_full_details;
							//echo "<pre>";
							//print_r($checkout_form);exit;
							if($this->session->userdata('checkout')!=null){
							$this->session->unset_userdata('checkout');
						}
                            if(isset($_SESSION['RedeemStatus'])){
                                unset($_SESSION);
                            }
							$AirCreateReservationReq_Res = AirCreateReservationReq($cart_flight_data, $checkout_form, $cid,$passengers);
							 $AirCreateReservationReq = $AirCreateReservationReq_Res['AirCreateReservationReq'];
							  $AirCreateReservationRes = $AirCreateReservationReq_Res['AirCreateReservationRes'];
							$AirBookRS = str_replace('SOAP:','',$AirCreateReservationRes);
							$AirBookRS = str_replace('air:','',$AirBookRS);
							$AirBookRS = str_replace('universal:','',$AirBookRS);
							$AirBookRS = str_replace('common_v33_0:','',$AirBookRS);
							$AirBookRS_obj = new SimpleXMLElement($AirBookRS);
		
							$BookingStatus = 'FAILED';
							$Status = 'FAILED';
							$LocatorCode = '';$ProviderLocatorCode = '';$SupplierLocatorCode= '';$AirReservationLocatorCode = '';                              
							$ProviderReservationInfoRef= '';$BookingTravelerRef = '';
							if(!empty($AirBookRS_obj))
							{
								if(isset($AirBookRS_obj->Body->AirCreateReservationRsp->UniversalRecord))
								{
									$UniversalRecord = $AirBookRS_obj->Body->AirCreateReservationRsp->UniversalRecord;
									
									$LocatorCode = (string)$UniversalRecord['LocatorCode'];
									$Status = (string)$UniversalRecord['Status'];
									
									$ProviderReservationInfo = $UniversalRecord->ProviderReservationInfo;
									$ProviderLocatorCode = (string)$ProviderReservationInfo['LocatorCode'];
									$ProviderCode = (string)$ProviderReservationInfo['ProviderCode'];
									
									$AirReservation = $UniversalRecord->AirReservation;
									$AirReservationLocatorCode = (string)$AirReservation['LocatorCode'];
									
									$SupplierLocator = $AirReservation->SupplierLocator;
									if(isset($SupplierLocator[0])){
									$SupplierCode = (string)$SupplierLocator[0]['SupplierCode'];
									$SupplierLocatorCode = (string)$SupplierLocator[0]['SupplierLocatorCode'];
									$ProviderReservationInfoRef = (string)$SupplierLocator[0]['ProviderReservationInfoRef'];
									}else{
									$SupplierCode = (string)$SupplierLocator['SupplierCode'];
									$SupplierLocatorCode = (string)$SupplierLocator['SupplierLocatorCode'];
									$ProviderReservationInfoRef = (string)$SupplierLocator['ProviderReservationInfoRef'];
									}
									$TravelerRef_arr = array();
									$BookingTravelerRef_arr = $AirReservation->BookingTravelerRef;
									foreach($BookingTravelerRef_arr as $travelref){
									$TravelerRef_arr[] = (string)$travelref['Key'];
									}
									$BookingTravelerRef = implode(',',$TravelerRef_arr);
									$BookingStatus = 'CONFIRMED';  
									$Remarks = 'No remarks'; 
									$error_message.='|'.$booking_id.'-FLIGHT RESPONSE SUCCESS';	
								}
								else
								{
									$ErrorInfo = $AirBookRS_obj->Body->Fault->detail->ErrorInfo;
									$Remarks = (string)$ErrorInfo->Description;
									$xml_log = array(
									'Api' => 'UAPI',
									'XML_Type' => 'Flight',
									'XML_Request' => $AirCreateReservationReq_Res['AirCreateReservationReq'],
									'XML_Response' => $AirCreateReservationReq_Res['AirCreateReservationRes'],
									'Ip_address' => $this->input->ip_address(),
									'XML_Time' => date('Y-m-d H:i:s')
									);
									$this->xml_model->insert_xml_log($xml_log);
									$error_message.='|'.$booking_id.'-FLIGHT ERROR RESPONSE';	
								}
							}
							else
							{
								$error_message.='|'.$booking_id.'-FLIGHT EMPTY RESPONSE';
							}
							$booking_res = array(
							'LocatorCode' => $LocatorCode,
							'ProviderLocatorCode' => $ProviderLocatorCode,
							'AirReservationLocatorCode' => $AirReservationLocatorCode,
							'SupplierLocatorCode' => $SupplierLocatorCode,
							'ProviderReservationInfoRef' => $ProviderReservationInfoRef,
							'BookingTravelerRef' => $BookingTravelerRef,
							'BookingStatus' => $BookingStatus,
							'Status' => $Status,
							'Remarks' => $Remarks
							);
							$booking_res = json_encode($booking_res);
						
							$booking_flight = array(
							'AirCreateReservationReq' => $AirCreateReservationReq,
							'AirCreateReservationRes' => $AirCreateReservationRes,
							'booking_res' => $booking_res,
							);
						
							$this->flight_model->Update_Booking_flight($booking_id, $booking_flight);
						
							$booking_res = json_decode($booking_res);
							
							$update_booking = array(
                            'booking_no' => $booking_res->LocatorCode,
							'AirReservationLocatorCode' => $AirReservationLocatorCode,
							'api_status' => $Status,
							'booking_status' => $BookingStatus
							);
						
							$this->flight_model->Update_Booking_Global($bid, $update_booking, 'FLIGHT');



                             // AirTicket Availability Start
                              if ($booking_res->BookingStatus == 'CONFIRMED') {
                                $AirPricingInfos=$AirReservation->AirPricingInfo;

                                $AirPricingInfo_arr = array();
                                    
                                    foreach ($AirPricingInfos as $AirPricingInfo) {
                                        $AirPricingInfo_arr[] = (string) $AirPricingInfo['Key'];
                                    }

                                   $AirPricingInfo_keys = $AirPricingInfo_arr;

                                    $AirTicketingReq_Res = AirTicketingReq($AirPricingInfo_keys,$AirReservationLocatorCode);
                                    $AirTicketingRes = $AirTicketingReq_Res['AirTicketingRsp'];
                                    $AirTicketingRes = $this->xml_to_array->XmlToArray($AirTicketingRes);

                                     if(isset($AirTicketingRes['SOAP:Body']['air:AirTicketingRsp'])){

                                        if(isset($AirTicketingRes['SOAP:Body']['air:AirTicketingRsp']['air:TicketFailureInfo'])){

                    $TicketFailureInfo = $AirTicketingRes['SOAP:Body']['air:AirTicketingRsp']['air:TicketFailureInfo'];
                    $allAttr = $TicketFailureInfo['@attributes'];
                    $update_booking = array(
                            'ticket_status' => 'FAILURE',
                             'ticket_msg' => $allAttr['Message']
                        );
                        $this->flight_model->Update_Booking_Global($bid, $update_booking, 'FLIGHT');
                      }else{
                        $update_booking = array(
                            'ticket_status' => 'CREATED'
                           
                        );
                        $this->flight_model->Update_Booking_Global($bid, $update_booking, 'FLIGHT');

                      }
                       
                    
                }else{
                    $xml_log = array(
                        'Api' => 'UAPI',
                        'XML_Type' => 'FLIGHT - AirTicketing -TicketFailureInfo EMPTY - ERROR',
                        'XML_Request' => $AirTicketingReq_Res['AirTicketingReq'],
                        'XML_Response' => $AirTicketingReq_Res['AirTicketingRsp'],
                        'Ip_address' => $this->input->ip_address(),
                        'XML_Time' => date('Y-m-d H:i:s')
                    );
                    $this->xml_model->insert_xml_log($xml_log);
                }

                                  // echo "<pre>";print_r($AirTicketingRes);die;
                              }

                              // AirTicket Availability Start End

                              
							if($booking_res->BookingStatus == 'CONFIRMED')
							{
								if($this->session->userdata('b2b_id'))
								{
									$user_type = 2;
									$user_id = $this->session->userdata('b2b_id');
									$this->b2b_do_payment($pnr_no,$module,$book_temp_data->TotalPrice,$book_temp_data->MyMarkup,$user_id);
									$this->b2b_do_payment_account($pnr_no,$module,$book_temp_data->TotalPrice,$book_temp_data->MyMarkup,$user_id);
									$error_message.='|'.$booking_id.'-booking amount debited from your account';
								}
								else
								{
									$error_message.='|'.$booking_id.'-booking amount not debited from your account. b2b session not  exist';
								}
							}
							else
							{
									$error_message.='|'.$booking_id.'-booking amount not debited from your account. booking not confirmed';
							}
						
						}
						else
						{
							$error_message.='|'.$booking_id.'-Booking data not there';
						}
					}
				
					if($module == 'HOTEL')
					{
						$count = $this->hotel_model->getBookingHotelTemp($booking_id)->num_rows();
						
						if($count == 1)
						{
							
								
							$book_temp_data = $cart_hotel_data = $this->hotel_model->getBookingHotelTemp($booking_id)->row();
							
							if($book_temp_data->api != 'CRS'){
								
							$checkout_form = json_decode($book_temp_data->TravelerDetails);
							$cid = $book_temp_data->cid;
							
							$returndata = make_hotel_booking($cart_hotel_data, $cid, $checkout_form);	
							
							$make_hotel_booking = $returndata['response'];
							$HotelBookRS = str_replace('SOAP:','',$make_hotel_booking);
							$HotelBookRS = str_replace('hotel:','',$HotelBookRS);
							$HotelBookRS = str_replace('universal:','',$HotelBookRS);
							$HotelBookRS = str_replace('common_v33_0:','',$HotelBookRS);
							$HotelBookRS_obj = new SimpleXMLElement($HotelBookRS);
							$BookingStatus = 'FAILED';
							$LocatorCode = '';
							$Status = 'FAILED';$ProviderLocatorCode = '';$AirReservationLocatorCode = '';	$HotelReservationConfirmationCode='';							
							$BookingTravelerRef = '';
							
							if(!empty($HotelBookRS_obj))
							{
									
							if(isset($HotelBookRS_obj->Body->HotelCreateReservationRsp->UniversalRecord))
								{
										
									$UniversalRecord = $HotelBookRS_obj->Body->HotelCreateReservationRsp->UniversalRecord;
									$LocatorCode = (string)$UniversalRecord['LocatorCode'];
									$Status = (string)$UniversalRecord['Status'];
									$HotelReservation = $UniversalRecord->HotelReservation;
									$HotelReservationLocatorCode = (string)$HotelReservation['LocatorCode'];
									$HotelReservationConfirmationCode = (string)$HotelReservation['BookingConfirmation'];	
									$TravelerRef_arr = array();
									$BookingTravelerRef_arr = $HotelReservation->BookingTravelerRef;
									foreach($BookingTravelerRef_arr as $travelref){
									$TravelerRef_arr[] = (string)$travelref['Key'];
									}
									
									$BookingTravelerRef = implode(',',$TravelerRef_arr);
									
									$BookingStatus = 'CONFIRMED';  
									$Remarks = 'No remarks'; 
									$error_message.='|'.$booking_id.'-HOTEL RESPONSE SUCCESS';	
								}
								else
								{
									
									$ErrorInfo = $HotelBookRS_obj->Body->Fault->detail->ErrorInfo;
									$Remarks = (string)$ErrorInfo->Description;
									$xml_log = array(
															'Api' => 'UAPI',
															'XML_Type' => 'Hotel',
															'XML_Request' => $returndata['request'],
															'XML_Response' => $returndata['response'],
															'Ip_address' => $this->input->ip_address(),
															'XML_Time' => date('Y-m-d H:i:s')
															);
															$this->xml_model->insert_xml_log($xml_log);
									$error_message.='|'.$booking_id.'-HOTEL ERROR RESPONSE';
								}
							}
							else
							{
								
								$error_message.='|'.$booking_id.'-HOTEL EMPTY RESPONSE';
							}
							$books_req =  $returndata['request'];
							$books_res =  $returndata['response'];
							}
							else
							{
							$BookingStatus = 'CONFIRMED';
							$LocatorCode = '';$ProviderLocatorCode = '';$AirReservationLocatorCode = '';$HotelReservationConfirmationCode = '';$BookingTravelerRef = '';
							$Status = 'CONFIRMED';
							$Remarks='';
							$books_req =  'CRS';
							$books_res =  'CRS';
							}
							
							$booking_res = array(
							'LocatorCode' => $LocatorCode,
							'ProviderLocatorCode' => $ProviderLocatorCode,
							'AirReservationLocatorCode' => $AirReservationLocatorCode,
							'HotelReservationConfirmationCode' => $HotelReservationConfirmationCode,
							'BookingTravelerRef' => $BookingTravelerRef,
							'BookingStatus' => $BookingStatus,
							'Status' => $Status,
							'Remarks' => $Remarks
							);
							$booking_res = json_encode($booking_res);
							$booking_hotel = array(
													'HotelCreateReservationReq' =>  $books_req,
													'HotelCreateReservationRes' => $books_res,
													'booking_res' => $booking_res,
													);
						
							$this->hotel_model->Update_Booking_hotel($booking_id, $booking_hotel);
						
							$booking_res = json_decode($booking_res);
	
							
							$update_booking = array(
							'booking_no' => $booking_res->LocatorCode,
							'api_status' => $Status,
							'booking_status' => $BookingStatus
							);
							
							$this->hotel_model->Update_Booking_Global($bid, $update_booking, 'HOTEL');
							if($booking_res->BookingStatus == 'CONFIRMED')
							{
								if($this->session->userdata('b2b_id'))
								{
									$user_type = 2;
									$user_id = $this->session->userdata('b2b_id');
									$this->b2b_do_payment($pnr_no,$module,$book_temp_data->total_cost,$book_temp_data->MyMarkup,$user_id);
									$this->b2b_do_payment_account($pnr_no,$module,$book_temp_data->total_cost,$book_temp_data->MyMarkup,$user_id);
									$error_message.='|'.$booking_id.'-booking amount debited from your account';
								}
								else
								{
									$error_message.='|'.$booking_id.'-booking amount not debited from your account. b2b session not  exist';
								}
							}
							else
							{
									$error_message.='|'.$booking_id.'-booking amount not debited from your account. booking not confirmed';
							}
							
								
							
							}
							else
						{
							$error_message.='|'.$booking_id.'-Booking data not there';
						}
					}
				
					if($module == 'CAR')
					{
						$count = $this->flight_model->getBookingFlightTemp($booking_id)->num_rows();
						if($count == 1)
						{
							//$count = $this->flight_model->CheckDuplicateBooking($booking_id)->num_rows();
							//if($count == 0){
							$book_temp_data = $cart_car_data = $this->car_model->getBookingCarTemp($booking_id)->row();
							$checkout_form = json_decode($book_temp_data->TravelerDetails);
							$cid = $book_temp_data->cid;
							$VehicleCreateReservationReq_Res = $res = VehicleCreateReservationReq($cart_car_data, $checkout_form, $cid);
				$VehicleCreateReservationRes = $VehicleCreateReservationReq_Res['VehicleCreateReservationRes'];
				$VehicleCreateReservationReq = $VehicleCreateReservationReq_Res['VehicleCreateReservationReq'];
						
							$VehicleBookRS = str_replace('SOAP:','',$VehicleCreateReservationRes);
					$VehicleBookRS = str_replace('vehicle:','',$VehicleBookRS);
					$VehicleBookRS = str_replace('universal:','',$VehicleBookRS);
					$VehicleBookRS = str_replace('common_v33_0:','',$VehicleBookRS);
					$VehicleBookRS_obj = new SimpleXMLElement($VehicleBookRS);
		
							$BookingStatus = 'FAILED';
							$Status = 'FAILED';
							$LocatorCode = '';$ProviderLocatorCode = '';$SupplierLocatorCode= '';$AirReservationLocatorCode = '';                              
							$ProviderReservationInfoRef= '';$BookingTravelerRef = '';
							if(!empty($VehicleBookRS_obj)){
						if(isset($VehicleBookRS_obj->Body->VehicleCreateReservationRsp->UniversalRecord)){
							$UniversalRecord = $VehicleBookRS_obj->Body->VehicleCreateReservationRsp->UniversalRecord;
											
							$LocatorCode = (string)$UniversalRecord['LocatorCode'];
							$Status = (string)$UniversalRecord['Status'];
							
							$ProviderReservationInfo = $UniversalRecord->ProviderReservationInfo;
							$ProviderLocatorCode = (string)$ProviderReservationInfo['LocatorCode'];
							$ProviderCode = (string)$ProviderReservationInfo['ProviderCode'];
											
							$VehicleReservation = $UniversalRecord->VehicleReservation;
							$VehicleReservationReservationLocatorCode = (string)$VehicleReservation['LocatorCode'];
											
							
							if(isset($VehicleReservation['SupplierCode'])){
								$SupplierCode = (string)$VehicleReservation['SupplierCode'];
								$ProviderReservationInfoRef = (string)$VehicleReservation['ProviderReservationInfoRef'];
							}
							
							$TravelerRef_arr = array();
							$BookingTravelerRef_arr = $VehicleReservation->BookingTravelerRef;
							foreach($BookingTravelerRef_arr as $travelref){
								$TravelerRef_arr[] = (string)$travelref['Key'];
							}
							
							$BookingTravelerRef = implode(',',$TravelerRef_arr);
							
							$BookingStatus = 'CONFIRMED';  
							$Remarks = 'No remarks'; 
														 
						 }
								else
								{
									$ErrorInfo = $VehicleBookRS_obj->Body->Fault->detail->ErrorInfo;
									$Remarks = (string)$ErrorInfo->Description;
									$xml_log = array(
									'Api' => 'UAPI',
									'XML_Type' => 'Car',
									'XML_Request' => $VehicleCreateReservationReq_Res['VehicleCreateReservationReq'],
									'XML_Response' => $VehicleCreateReservationReq_Res['VehicleCreateReservationRes'],
									'Ip_address' => $this->input->ip_address(),
									'XML_Time' => date('Y-m-d H:i:s')
									);
									$this->xml_model->insert_xml_log($xml_log);
									$error_message.='|'.$booking_id.'-CAR ERROR RESPONSE';	
								}
							}
							else
							{
								$error_message.='|'.$booking_id.'-CAR EMPTY RESPONSE';
							}
							$booking_res = array(
							
							'LocatorCode' => $LocatorCode,
							'ProviderLocatorCode' => $ProviderLocatorCode,
							'AirReservationLocatorCode' => $AirReservationLocatorCode,
							'SupplierLocatorCode' => $SupplierLocatorCode,
							'ProviderReservationInfoRef' => $ProviderReservationInfoRef,
							'BookingTravelerRef' => $BookingTravelerRef,
							'BookingStatus' => $BookingStatus,
							'Status' => $Status,
							'Remarks' => $Remarks
							);
							$booking_res = json_encode($booking_res);
						
							$booking_car = array(
							'CarCreateReservationReq' =>  $VehicleCreateReservationReq,
							'CarCreateReservationRes' => $VehicleCreateReservationRes,
							'booking_res' => $booking_res
							);
						
							$this->car_model->Update_Booking_car($booking_id, $booking_car);
						
							$booking_res = json_decode($booking_res);
							
							
							$update_booking = array(
							'booking_no' => $booking_res->LocatorCode,
							'api_status' => $Status,
							'booking_status' => $BookingStatus
							);
						
							$this->car_model->Update_Booking_Global($bid, $update_booking, 'CAR');
							if($booking_res->BookingStatus == 'CONFIRMED')
							{
								if($this->session->userdata('b2b_id'))
								{
									$user_type = 2;
									$user_id = $this->session->userdata('b2b_id');
									$this->b2b_do_payment($pnr_no,$module,$book_temp_data->TotalPrice,$book_temp_data->MyMarkup,$user_id);
									$this->b2b_do_payment_account($pnr_no,$module,$book_temp_data->TotalPrice,$book_temp_data->MyMarkup,$user_id);
									$error_message.='|'.$booking_id.'-booking amount debited from your account';
								}
								else
								{
									$error_message.='|'.$booking_id.'-booking amount not debited from your account. b2b session not  exist';
								}
							}
							else
							{
									$error_message.='|'.$booking_id.'-booking amount not debited from your account. booking not confirmed';
							}
						
						}
						else
						{
							$error_message.='|'.$booking_id.'-Booking data not there';
						}
					}

					if($module == 'VACATION')
					{
						$count = $this->vacation_model->getBookingVacationTemp($booking_id)->num_rows();
						
						if($count == 1)
						{
						
		
							$BookingStatus = 'CONFIRMED';
							$Status = 'CONFIRMED';
							$LocatorCode = '';$ProviderLocatorCode = '';$SupplierLocatorCode= '';$AirReservationLocatorCode = '';                              
							$ProviderReservationInfoRef= '';$BookingTravelerRef = '';
							
							$booking_res = array(
							
							'LocatorCode' => $LocatorCode,
							'ProviderLocatorCode' => $ProviderLocatorCode,
							'AirReservationLocatorCode' => $AirReservationLocatorCode,
							'SupplierLocatorCode' => $SupplierLocatorCode,
							'ProviderReservationInfoRef' => $ProviderReservationInfoRef,
							'BookingTravelerRef' => $BookingTravelerRef,
							'BookingStatus' => $BookingStatus,
							'Status' => $Status
							);
							$booking_res = json_encode($booking_res);
						
							$booking_vac = array(
							'booking_res' => $booking_res
							);
						
							$this->vacation_model->Update_Booking_vacation($booking_id, $booking_vac);
						
							$booking_res = json_decode($booking_res);
					
							$update_booking = array(
							'booking_no' => $booking_res->LocatorCode,
							'api_status' => $Status,
							'booking_status' => $BookingStatus
							);
						
							$this->vacation_model->Update_Booking_Global($bid, $update_booking, 'VACATION');
							if($booking_res->BookingStatus == 'CONFIRMED')
							{
								if($this->session->userdata('b2b_id'))
								{
									$user_type = 2;
									$user_id = $this->session->userdata('b2b_id');
									$this->b2b_do_payment($pnr_no,$module,$book_temp_data->TotalPrice,$book_temp_data->MyMarkup,$user_id);
									$this->b2b_do_payment_account($pnr_no,$module,$book_temp_data->TotalPrice,$book_temp_data->MyMarkup,$user_id);
									$error_message.='|'.$booking_id.'-booking amount debited from your account';
								}
								else
								{
									$error_message.='|'.$booking_id.'-booking amount not debited from your account. b2b session not  exist';
								}
							}
							else
							{
									$error_message.='|'.$booking_id.'-booking amount not debited from your account. booking not confirmed';
							}
						
						}
						else
						{
							$error_message.='|'.$booking_id.'-Booking data not there';
						}
					}
					
					
				}
				
				
				
				else
				{
					$error_message.='|Booking process failure';
				}
				
				
				$update_booking_process = array(
							'error_message_data' => $error_message
							);
				$this->flight_model->Update_Booking_Global_sol($bid, $update_booking_process);
				
			}
			redirect(WEB_URL.'/booking/confirm/'.base64_encode($parent_pnr), 'refresh');
		}
		else
		{
			$msg = 'Booking Failure, your order doest not exists.';
			$orderid =  $payment_response['parent_pnr'];
			$payid =  '';
			$msg = base64_encode($msg);
			redirect(WEB_URL.'/error/payment/'.$msg.'/'.$order_id.'/'.$payid,'refresh');
		}
   }

    public function confirm($parent_pnr=''){
		
        if(!empty($parent_pnr)){
            $parent_pnr = base64_decode($parent_pnr);
            $count = $this->booking_model->getBookingByParentPnr($parent_pnr)->num_rows();
            if($count > 0){
                $data['pnr_nos'] = $this->booking_model->getBookingByParentPnr($parent_pnr)->result();
				//echo '<pre>';print_r($data['pnr_nos'][0]);die;
				 $currentsessionid=$this->session->userdata('session_id');
				 
				  $count = $this->cart_model->getBookingTemp($currentsessionid)->num_rows();
            if($count > 0){
              
                $book_temp_data = $this->cart_model->getBookingTemp($currentsessionid)->result();
                 foreach ($book_temp_data as $key => $value) {
					 
					 $this->flight_model->clearCart($value->cart_id);
                   
                }
			}
					
				redirect(WEB_URL.'/booking/?orderId='.base64_encode($parent_pnr));
                //$this->load->view('common/voucher', $data);
            }else{
                 $this->load->view('errors/404');
            }
        }else{
             $this->load->view('errors/404');
        }
    }

    public function hotel_mail_voucher($pnr_no){
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1){
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if($b_data->module == 'HOTEL'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
                
                $checkin_day_month = date('D, M', strtotime($booking->checkin));
                $checkin_date = $cin = date('d', strtotime($booking->checkin));
                $checkout_day_month = date('D, M', strtotime($booking->checkout));
                $checkout_date = $cout = date('d', strtotime($booking->checkout));

                $checkin_date = strtotime($booking->checkin);
                $checkout_date = strtotime($booking->checkout);
                    
                $absDateDiff = abs($checkout_date - $checkin_date);
                $number_of_nights = floor($absDateDiff/(60*60*24));


                $getHotelTemplateRow = $this->email_model->get_email_template('HOTEL_BOOKING_VOUCHER')->row();
                $getHotelTemplate = $getHotelTemplateRow->message;
                $getHotelTemplate = str_replace("{%%FIRSTNAME%%}", $booking->GUEST_FIRSTNAME, $getHotelTemplate);
                $getHotelTemplate = str_replace("{%%BOOKING_STATUS%%}", $booking->booking_status, $getHotelTemplate);
                $getHotelTemplate = str_replace("{%%CONFIRMATION_NO%%}", $booking->pnr_no, $getHotelTemplate);
                $getHotelTemplate = str_replace("{%%HOTEL_NAME%%}", $booking->hotel_name, $getHotelTemplate);
                $getHotelTemplate = str_replace("{%%ROOM_TYPE%%}", $booking->room_name, $getHotelTemplate);
                $getHotelTemplate = str_replace("{%%NO_OF_NIGHTS%%}", $number_of_nights, $getHotelTemplate);
                $getHotelTemplate = str_replace("{%%GUEST_COUNT%%}", $booking->adult, $getHotelTemplate);
                $getHotelTemplate = str_replace("{%%GUEST_NAME%%}", $booking->leadpax, $getHotelTemplate);
                $getHotelTemplate = str_replace("{%%CHECKIN_DAY_MONTH%%}", $checkin_day_month, $getHotelTemplate);
                $getHotelTemplate = str_replace("{%%CHECKIN_DATE%%}", $cin, $getHotelTemplate);
                $getHotelTemplate = str_replace("{%%CHECKOUT_DAY_MONTH%%}", $checkout_day_month, $getHotelTemplate);
                $getHotelTemplate = str_replace("{%%CHECKOUT_DATE%%}", $cout, $getHotelTemplate);
             
                $data['message'] = $getHotelTemplate;

                $data['to'] = $booking->BILLING_EMAIL;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                $email_type = 'ApartmentVoucher';
                $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
                $data['social_url'] = array(
                    'facebook_social_url' => 'https://www.facebook.com',
                    'twitter_social_url' => 'https://twitter.com',
                    'google_social_url' => 'https://google.com',
                );
                $Response = $this->email_model->sendmail_hotelVoucher($data);
                $response = array('status' => 1);
                //echo json_encode($response);
            }
        }else{
            $response = array('status' => 0);
            echo json_encode($response);
        }
    }

    public function flight_mail_voucher($pnr_no){
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1){
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if($b_data->module == 'FLIGHT'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
                $data['global'] = $this->booking_model->getBookingPnr($pnr_no)->row();
                $data['message'] = $this->load->view('flight/mail_voucher', $data,TRUE);
                $data['to'] = $booking->BILLING_EMAIL;
                $data['booking_status'] = $booking->booking_status;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                $email_type = 'ApartmentVoucher';
                $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
                $data['social_url'] = array(
                    'facebook_social_url' => 'https://www.facebook.com',
                    'twitter_social_url' => 'https://twitter.com',
                    'google_social_url' => 'https://google.com',
                );
                $Response = $this->email_model->sendmail_flightVoucher($data);
                $response = array('status' => 1);
                //echo json_encode($response);
            }
        }else{
            $response = array('status' => 0);
            echo json_encode($response);
        }
    }


    public function flight_mail_voucher_pm($pnr_no){
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1){
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if($b_data->module == 'FLIGHT'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
                $data['global'] = $this->booking_model->getBookingPnr($pnr_no)->row();
                $data['message'] = $this->load->view('flight/mail_voucher', $data,TRUE);
                $data['to'] = $booking->BILLING_EMAIL;
                $data['booking_status'] = $booking->booking_status;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                $email_type = 'ApartmentVoucher';
                $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
                $data['social_url'] = array(
                    'facebook_social_url' => 'https://www.facebook.com',
                    'twitter_social_url' => 'https://twitter.com',
                    'google_social_url' => 'https://google.com',
                );
                $Response = $this->email_model->sendmail_flightVoucher($data);
                $response = array('status' => 1);
                //echo json_encode($response);
            }
        }else{
            $response = array('status' => 0);
            //echo json_encode($response);
        }
    }

    public function car_mail_voucher($pnr_no){
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1){
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if($b_data->module == 'CAR'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
                $data['global'] = $this->booking_model->getBookingPnr($pnr_no)->row();
                $data['message'] = $this->load->view('car/mail_voucher', $data,TRUE);
                $data['to'] = $booking->BILLING_EMAIL;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                $email_type = 'ApartmentVoucher';
                $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
                $data['booking_status'] = strtolower($booking->booking_status);
                $data['social_url'] = array(
                    'facebook_social_url' => 'https://www.facebook.com',
                    'twitter_social_url' => 'https://twitter.com',
                    'google_social_url' => 'https://google.com',
                );
                $Response = $this->email_model->sendmail_carVoucher($data);
                $response = array('status' => 1);
                //echo json_encode($response);
            }
        }else{
            $response = array('status' => 0);
            echo json_encode($response);
        }
    }

    public function vacation_mail_voucher($pnr_no){
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1){
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if($b_data->module == 'VACATION'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
                $data['global'] = $this->booking_model->getBookingPnr($pnr_no)->row();
                $data['message'] = $this->load->view('vacation/mail_voucher', $data,TRUE);
                $data['to'] = $booking->BILLING_EMAIL;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                $email_type = 'ApartmentVoucher';
                $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
                $data['booking_status'] = strtolower($booking->booking_status);
                $data['social_url'] = array(
                    'facebook_social_url' => 'https://www.facebook.com',
                    'twitter_social_url' => 'https://twitter.com',
                    'google_social_url' => 'https://google.com',
                );
                $Response = $this->email_model->sendmail_carVoucher($data);
                $response = array('status' => 1);
                //echo json_encode($response);
            }
        }else{
            $response = array('status' => 0);
            echo json_encode($response);
        }
    }


    public function get_mail_content_apartmentVoucher($pnr_no) {
        $data['Booking'] = $Booking = $this->booking_model->getBooking($pnr_no)->row();
        $data['email_access'] = $this->email_model->get_email_acess()->row();
        $email_type = 'ApartmentVoucher';
        $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
        //echo '<pre>';print_r($Booking);die;
		 $data['voucher_details'] = $booking = $this->booking_model->getBookingvoucherinvoicedetails()->row();
        $data['email'] = $Booking->RES_GUEST_EMAIL;
        $data['host_data'] = $this->account_model->GetUserData($Booking->PROP_USER_TYPE, $Booking->PROP_USER_ID)->row();
        $data['Map'] = $this->getStaticMap($data['Booking']->PROP_LATITUDE, $data['Booking']->PROP_LONGITUDE);
        $data['social_url'] = array(
            'facebook_social_url' => 'https://www.facebook.com',
            'twitter_social_url' => 'https://twitter.com',
            'google_social_url' => 'https://google.com',
        );
        $Response = $this->email_model->sendmail_apartmentVoucher($data);
        $this->get_mail_content_apartmentInvoice($pnr_no);
        //return $Response;
    }

    public function get_mail_content_apartmentInvoice($pnr_no) {
        $data['Booking'] = $Booking = $this->booking_model->getBooking($pnr_no)->row();
        $data['email_access'] = $this->email_model->get_email_acess()->row();
        $email_type = 'ApartmentInvoice';
        $data['email_template'] = $this->email_model->get_email_template($email_type)->row();

        $data['host_data'] = $this->account_model->GetUserData($Booking->PROP_USER_TYPE, $Booking->PROP_USER_ID)->row();
        $data['social_url'] = array(
            'facebook_social_url' => 'https://www.facebook.com',
            'twitter_social_url' => 'https://twitter.com',
            'google_social_url' => 'https://google.com',
        );
        $Response = $this->email_model->sendmail_apartmentInvoice($data);
        return $Response;
    }
    
    public function get_mail_content_apartmentNonInstantVoucher($pnr_no) {
        $data['Booking'] = $Booking = $this->booking_model->getBooking($pnr_no)->row();
        $data['email_access'] = $this->email_model->get_email_acess()->row();
        $email_type = 'ApartmentNonInstantVoucher';
        $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
 $data['voucher_details'] = $booking = $this->booking_model->getBookingvoucherinvoicedetails()->row();
        $data['email'] = $Booking->RES_GUEST_EMAIL;
        $data['host_data'] = $this->account_model->GetUserData($Booking->PROP_USER_TYPE, $Booking->PROP_USER_ID)->row();
        $data['Map'] = $this->getStaticMap($data['Booking']->PROP_LATITUDE, $data['Booking']->PROP_LONGITUDE);
        $data['social_url'] = array(
            'facebook_social_url' => 'https://www.facebook.com',
            'twitter_social_url' => 'https://twitter.com',
            'google_social_url' => 'https://google.com',
        );
        $Response = $this->email_model->sendmail_apartmentNonInstantVoucher($data);
        //return $Response;
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

    public function generate_parent_pnr($length = 12) {
        $alphabets = range('A','Z');
        $numbers = range('0','9');
        $final_array = array_merge($alphabets,$numbers);
        //$id = date("ymd").date("His");
        $id = '';
        while($length--) {
          $key = array_rand($final_array);
          $id .= $final_array[$key];
        }
        return $id;
    }

    public function promo(){
		$total_payable=array();$total_discount=array();
		$promo_code = $this->input->get('code');
		$total = base64_decode($this->input->get('total'));
    	$count = $this->booking_model->check_promocode($promo_code)->num_rows();
    	if($count == 1){
    		$promo_data = $this->booking_model->check_promocode($promo_code)->row();
    		$user_time = time();
    		$exp_time = strtotime($promo_data->exp_date);
    		if ($user_time <= $exp_time) {
    			$promo_type = $promo_data->promo_type;
    			$discount = $mdic = $promo_data->discount;
    			$cids = base64_decode($this->input->get('cid'));
        		 $cids = json_decode($cids);
        		
    			foreach ($cids as $key => $cid) {
		            list($module, $cid) = explode(',', $cid);
		            if($module == 'APARTMENT'){
		            	$cart = $this->apartment_model->getBookingTemp($cid)->row();
		            	$total = $cart->TOTAL;
		            	if($promo_type == 1){
		    				$discount = ($total/100) * $mdic;
		    				$discount = number_format(($discount) ,2,'.','');
		    				$total_payable[] = $total-$discount;
		    				$total_discount[] = $discount;
		    			}else if($promo_type == 2){
		    				$discount = $discount;
		    				if($total >= $promo_data->promo_amount){
		    					$discount = number_format(($discount) ,2,'.','');
			    				$total_payable[] = $total-$discount;
			    				$total_discount[] = $discount;
		    				}else{
		    					$total_payable[] = $total;
		    				}
		    			}
		            }
		            if($module == 'FLIGHT'){
		            	$cart = $this->flight_model->getBookingTemp($cid)->row();
		            	 $each_cart_total = $cart->TotalPrice;
		            	if($promo_type == 1){
		    				$discount = ($total/100) * $mdic;
		    				$discount = number_format(($discount) ,2,'.','');
                            
                            if(isset($_SESSION['RedeemStatus']) && $_SESSION['RedeemStatus'] == 'Yes' && isset($_SESSION['RedeemPoints']) && $_SESSION['RedeemPoints'] > 0){
		    				  $total_payable[] = $total-$discount-$_SESSION['RedeemPoints'];
                            }else{
                              $total_payable[] = $total-$discount;
                            }
		    				$total_discount[] = $discount;
		    			}else if($promo_type == 2){
		    				$discount = $discount;
		    				if($total >= $promo_data->promo_amount){
		    					$discount = number_format(($discount) ,2,'.','');
                                
                                if(isset($_SESSION['RedeemStatus']) && $_SESSION['RedeemStatus'] == 'Yes' && isset($_SESSION['RedeemPoints']) && $_SESSION['RedeemPoints'] > 0){
                                  $total_payable = $total-$discount-$_SESSION['RedeemPoints'];
                                }else{
                                  $total_payable = $total-$discount;
                                }
			    				$total_discount = $discount;
		    				}else{
								$total_discount = 0;

                                if(isset($_SESSION['RedeemStatus']) && $_SESSION['RedeemStatus'] == 'Yes' && isset($_SESSION['RedeemPoints']) && $_SESSION['RedeemPoints'] > 0){
                                  $total_payable = $total-$_SESSION['RedeemPoints'];
                                }else{
                                  $total_payable = $total;
                                }
		    				}
		    			}
		            }
		            if($module == 'HOTEL'){
		            	$cart = $this->hotel_model->getBookingTemp($cid)->row();
		            	$total = $cart->total_cost;
		            	if($promo_type == 1){
		    				$discount = ($total/100) * $mdic;
		    				$discount = number_format(($discount) ,2,'.','');
		    				$total_payable[] = $total-$discount;
		    				$total_discount[] = $discount;
		    			}else if($promo_type == 2){
		    				$discount = $discount;
		    				if($total >= $promo_data->promo_amount){
		    					$discount = number_format(($discount) ,2,'.','');
			    				$total_payable[] = $total-$discount;
			    				$total-$discount;
			    				$total_discount[] = $discount;
		    				}else{
								
		    					$total_payable[] = $total;
		    				}
		    			}
		            }
		            if($module == 'CAR'){
		            	$cart = $this->car_model->getBookingTemp($cid)->row();
		            	$total = $cart->TotalPrice;
		            	if($promo_type == 1){
		    				$discount = ($total/100) * $mdic;
		    				$discount = number_format(($discount) ,2,'.','');
		    				$total_payable[] = $total-$discount;
		    				$total_discount[] = $discount;
		    			}else if($promo_type == 2){
		    				$discount = $discount;
		    				if($total >= $promo_data->promo_amount){
		    					$discount = number_format(($discount) ,2,'.','');
			    				$total_payable[] = $total-$discount;
			    				$total_discount[] = $discount;
		    				}else{
		    					$total_payable[] = $total;
		    				}
		    			}
		            }
		            if($module == 'VACATION'){
		            	$cart = $this->vacation_model->getBookingTemp($cid)->row();
		            	$total = $cart->TotalPrice;
		            	if($promo_type == 1){
		    				$discount = ($total/100) * $mdic;
		    				$discount = number_format(($discount) ,2,'.','');
		    				$total_payable[] = $total-$discount;
		    				$total_discount[] = $discount;
		    			}else if($promo_type == 2){
		    				$discount = $discount;
		    				if($total >= $promo_data->promo_amount){
		    					$discount = number_format(($discount) ,2,'.','');
			    				$total_payable[] = $total-$discount;
			    				$total_discount[] = $discount;
		    				}else{
		    					$total_payable[] = $total;
		    				}
		    			}
		            }
		        }
		        //echo '<pre>';print_r($total_discount);die;
		        $count = count($total_discount);
		         //$total_payable = array_sum($total_payable);
		         //$total_discount = array_sum($total_discount);
		         $total_payable = ($total_payable);
		         $total_discount = ($total_discount);
		       
    			if($promo_type == 1){
    				$response['discMsg'] = 'Coupon succesfully applied, You save <strong>'.$mdic.'%</strong> of total amount';
    			}else if($promo_type == 2){
					if($total<=$promo_data->promo_amount){
						$response['discMsg']='This coupon code is not valid for this total <strong>'.CURR_ICON.$total.'</strong> amount.valid from <strong>'.CURR_ICON.$promo_data->promo_amount.'</strong>' ;
					}else{
    				$response['discMsg'] = 'Coupon succesfully applied for '.$count.' products, You save <strong>'.CURR_ICON.$total_discount.' </strong> of total amount';
					}
				}
    			$response['discount'] = $total_discount;
    			$response['finalAmt'] = $total_payable;
    			$response['code'] = base64_encode($promo_code);
    			$response['status'] = 1;
                $this->session->set_userdata('promos', $response);
               
    		}else{
    			$response['status'] = 0;
    			$response['discMsg'] = 'Sorry, promo code has expired';
    		}
    	}else{
    		$response['status'] = 0;
    		$response['discMsg'] = 'Not a valid coupon';
    	}
    	echo json_encode($response);
    }

    public function b2b_check_payment($payable_amount,$user_id){
    	$deposit_amount_det = $this->account_model->get_deposit_amount($user_id)->row();
        $credit_amount = $deposit_amount_det->balance_credit;
    	//if($credit_amount >= $payable_amount){
    	if($credit_amount >= $payable_amount){
			return true;
		}else{
			return false;
		}
    }

    public function b2b_do_payment($booking_id,$module,$payable_amount, $myMarkup,$user_id){
    	$deposit_amount_det = $this->account_model->get_deposit_amount($user_id)->row();
    	$credit_amount = $deposit_amount_det->balance_credit;
        //echo $myMarkup;
        $payable_amount = $this->account_model->PercentageMinusAmount($payable_amount,$myMarkup);
        //die;
    	if($credit_amount >= $payable_amount){
			$balance_credit = $credit_amount - $payable_amount;
			$update_credit_amount = array(
				'balance_credit' => $balance_credit,
				'last_debit' => $payable_amount
			);
			
			$this->account_model->update_credit_amount($update_credit_amount,$user_id);
			$payment_transaction = array(
				'module' => $module,
				'reference_id' => $booking_id,
				'user_type' => '2',
				'user_id' => $user_id,
				'amount_deducted' => $payable_amount 
			);
			$this->account_model->update_payment_transaction($payment_transaction);
			
			
			
		}
    }
public function b2b_do_payment_account($booking_id,$module,$payable_amount, $myMarkup,$user_id){
    	$deposit_amount_det = $this->account_model->get_deposit_amount($user_id)->row();
    	$credit_amount = $deposit_amount_det->balance_credit;
        //echo $myMarkup;
        $payable_amount = $this->account_model->PercentageMinusAmount($payable_amount,$myMarkup);
        //die;
    	if($credit_amount >= $payable_amount){
			$balance_credit = $credit_amount;
			$description='Booking - '.$module.' : <a href="'.WEB_URL.'/'.strtolower($module).'/invoice/'.base64_encode(base64_encode($booking_id)).'" target="_blank">'.$booking_id.'</a>';
			$account_transaction = array(
				'statment_type' => 'WITHDRAW',
				'booking_number' => $booking_id,
				'user_type' => '2',
				'user_id' => $user_id,
				'amount' => $payable_amount,
				'balance_amount' => $balance_credit,
				'description' => $description
			);
			$this->account_model->update_account_transaction($account_transaction);
			
		}
    }
    public function islogged_in(){
        // if (!$this->session->userdata('b2c_id')) {
        //    redirect(WEB_URL.'/booking/signup_login');
        // }
        if($this->session->userdata('b2c_id')){
            
        }else if($this->session->userdata('b2b_id')){
            
        }else{
            redirect(WEB_URL.'/booking/signup_login');
        }
        // }else if($this->session->userdata('b2c_id')){
        //     if($this->session->userdata('b2c_id')){
        //         $user_type = 3;
        //         $user_id = $this->session->userdata('b2c_id');
        //     }
        //     $b2c_data = $this->apartment_model->is_signup($user_id)->num_rows();
        //     if($b2c_data->password == ''){
        //         //redirect(WEB_URL.'/apt/signup_login');
        //     }
        // }
    }

    public function getStaticMap($lat, $long){
        $locstring='';$firstloc=0;
        $long="77.5667";
        $lat="12.9667";
                        
        if($firstloc==0){
            $locstring=$locstring.$lat.','.$long.'&markers=icon:'.ASSETS.'images/marker_out.png%7C'.$lat.','.$long;
            $firstloc=1;
        }else{
            $locstring=$locstring.'&markers=icon:'.ASSETS.'images/marker_out.png%7C'.$lat.','.$long;
        }        
        $url="http://maps.googleapis.com/maps/api/staticmap?zoom=16&size=627x327&maptype=ROADMAP&".urlencode("center")."=".$locstring."&sensor=false";
        return $url;
    }
   

    public function signup_login(){
		
	
    	if($this->session->userdata('b2c_id') || $this->session->userdata('b2b_id')){
			
    		 $continue = $this->session->userdata('continue');
            redirect($continue);
            $data['msg'] = 'Please Sign up / Login to book';
        	$this->load->view('login',$data);
        }else{
        	$data['msg'] = 'Please Sign up / Login to book';
        	$this->load->view('login',$data);
        }
        
    }

}

/* End of file apartment.php */
/* Location: ./application/controllers/apartment.php */
