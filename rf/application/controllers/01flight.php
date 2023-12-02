<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set("memory_limit",-1);
class Flight extends CI_Controller {
	public function __construct(){
		//error_reporting(0);
        parent::__construct();
        $this->load->model('Auth_Model');
        $current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
        $current_url = $this->config->site_url().$this->uri->uri_string(). $current_url;
        $this->url =  array(
            'continue' => $current_url,
        );
        
        $this->helpMenuLink = "";
        $this->load->model('Help_Model');
		$this->helpMenuLink = $this->Help_Model->fetchHelpLinks();
		$this->load->helper('flight_helper');
		$this->load->model('flight_model');
		$this->load->model('Cart_Model');
		$this->load->model('apartment_model');
		$this->load->model('booking_model');
		$this->load->model('email_model');
		$this->load->library('xml_to_array');
		


		$controller = $this->router->fetch_class();
        parent::validate_modules($controller);
	}




	public function home(){
		
		$data['banners'] = $this->Help_Model->getHomeSettings();
		$data['portfolio'] = $this->Help_Model->getAllPortfolio();
		$this->load->view('flight/flight_index',$data);
	}

	public function index(){

		

		$this->session->set_userdata($this->url);
		$request = $this->input->get();
	//	echo '<pre>';print_r($request);die;

		$data['request_array'] = $request;
		$request = json_encode($request);
		$data['req'] = json_decode($request);
		$data['request'] = $request = base64_encode($request);
		
		 $this->load->view('flight/results', $data);
	}
	
	public function search_flight(){
		$this->session->set_userdata($this->url);
		$post_request = $this->input->post();
		//print_r($post_request);die;
		$request=array();
		
		if($post_request['trip_type'] != 'multicity'){
			if(strpos($post_request['from'], " (All Airports)")){
				$from_origin=str_replace(" (All Airports)","",$post_request['from']);
			}else{
				$from_origin=$post_request['from'];
			}
		
			if(strpos($post_request['to'], " (All Airports)")){
				$to_destination=str_replace(" (All Airports)","",$post_request['to']);
			}else{
				$to_destination=$post_request['to'];
			}
			$request['origin']=substr(chop(substr($from_origin, -5), ')'), -3);
			$request['destination']=substr(chop(substr($to_destination, -5), ')'), -3);
			$request['depart_date']=str_replace('/', '-', $post_request['depature']);
			if(isset($post_request['days']) && $post_request['days']==1){
			$request['days']=$post_request['days'];
			}else{
			$request['days']='';
			}
			if(isset($post_request['disc_price']) && $post_request['disc_price']!=''){
			$request['disc_price'] =$post_request['disc_price'];
			}else{
			$request['disc_price'] = '';
			}
			if(isset($post_request['Carriers']) && $post_request['Carriers']!=''){
			$request['Carriers']=$post_request['Carriers'];
			}else{
			$request['Carriers'] = '';
			}
			if(isset($post_request['provider']) && $post_request['provider']!=''){
			$request['provider']=$post_request['provider'];
			}else{
			$request['provider'] = '';
			}

			if(isset($post_request['Stop']) && $post_request['Stop']!=''){
				$request['Stop']=$post_request['Stop'];
			}else{
				$request['Stop']='';
			}

			if(isset($post_request['depMinTime']) && $post_request['depMinTime']!=''){
				$request['depMinTime']=$post_request['depMinTime'];
			}else{
				$request['depMinTime']='';
			}

			if(isset($post_request['depMaxTime']) && $post_request['depMaxTime']!=''){
				$request['depMaxTime']=$post_request['depMaxTime'];
			}else{
				$request['depMaxTime']='';
			}

			if(isset($post_request['arrMinTime']) && $post_request['arrMinTime']!=''){
				$request['arrMinTime']=$post_request['arrMinTime'];
			}else{
				$request['arrMinTime']='';
			}

			if(isset($post_request['arrMaxTime']) && $post_request['arrMaxTime']!=''){
				$request['arrMaxTime']=$post_request['arrMaxTime'];
			}else{
				$request['arrMaxTime']='';
			}

			if(isset($post_request['MinDuration']) && $post_request['MinDuration']!=''){
				$request['MinDuration']=$post_request['MinDuration'];
			}else{
				$request['MinDuration']='';
			}

			if(isset($post_request['MaxDuration']) && $post_request['MaxDuration']!=''){
				$request['MaxDuration']=$post_request['MaxDuration'];
			}else{
				$request['MaxDuration']='';
			}

			if(isset($post_request['MinPrice']) && $post_request['MinPrice']!=''){
				$request['MinPrice']=$post_request['MinPrice'];
			}else{
				$request['MinPrice']='';
			}

			if(isset($post_request['MaxPrice']) && $post_request['MaxPrice']!=''){
				$request['MaxPrice']=$post_request['MaxPrice'];
			}else{
				$request['MaxPrice']='';
			}
			$request['Airline']=isset($post_request['Airline'])?$post_request['Airline']:'';

		$request['ADT']=$post_request['adult'];
		$request['CHD']=$post_request['child'];
		$request['INF']=$post_request['infant'];
		$request['class']=$post_request['class'];


		}
		
				if($post_request['trip_type'] == 'oneway'){
			$request['type']  = 'O';
		}else if($post_request['trip_type'] == 'circle'){
			$request['type'] = 'R';
			$request['return_date']=str_replace('/', '-', $post_request['return']);
		}else if($post_request['trip_type'] == 'multicity'){
			$request['type'] = 'M';

			$multi = json_decode(json_encode($this->input->post()));

			foreach ($multi->mfrom as $key => $value) {
				if($value!=''){
					if(strpos($value, " (All Airports)")){
				$from_origin=str_replace(" (All Airports)","",$value);
			}else{
				$from_origin=$value;
			}
		
			if(strpos($multi->mto[$key], " (All Airports)")){
				$to_destination=str_replace(" (All Airports)","",$multi->mto[$key]);
			}else{
				$to_destination=$multi->mto[$key];
			}
			
				$origin[] = substr(chop(substr($from_origin, -5), ')'), -3);
				$destination[] = substr(chop(substr($to_destination, -5), ')'), -3);
				$depature[] = str_replace('/', '-', $multi->mdepature[$key]);
			}
			}

			$multicity = array(
				'type' => 'M',
				'origin' => $origin,
				'destination' => $destination,
				'depart_date' => $depature,
				'days'=>'',
				'Stop'=>$post_request['Stop'],
				'depMinTime'=>$post_request['depMinTime'],
				'depMaxTime'=>$post_request['depMaxTime'],
				'arrMinTime'=>$post_request['arrMinTime'],
				'arrMaxTime'=>$post_request['arrMaxTime'],
				'MinDuration'=>$post_request['MinDuration'],
				'MaxDuration'=>$post_request['MaxDuration'],
				'MinPrice'=>$post_request['MinPrice'],
				'MaxPrice'=>$post_request['MaxPrice'],
				'Airline'=>(isset($post_request['Airline'])?$post_request['Airline']:''),
				'ADT' => $post_request['adult'],
				'CHD' => $post_request['child'],
				'INF' => $post_request['infant'],
				'class' => $post_request['class'],
			);
			$request=$multicity;
			
			
		}
		$method="Asynch";//Asynch
		$request['method']=$method;
		$request = json_encode($request);
		$req_data=json_decode($request);
		 // print_r($req_data);die;
		
		$LowFareSearchRes = LowFareSearchReq($req_data);
		$aMarkup = $this->account_model->get_markup('FLIGHT'); //get markup
		$aMarkup = $aMarkup['markup'];
		$MyMarkup = $this->account_model->get_my_markup(); //get agent markup
		$myMarkup = $MyMarkup['markup'];
		
		if($req_data->type == 'M'){
			$results = $this->formatMultiResponse($LowFareSearchRes, $aMarkup, $myMarkup,$method);
			
		}else{
			$results = $this->formatResponse($LowFareSearchRes, $aMarkup, $myMarkup,$method);
		}
		
		$more_results=$results["more_results"];
		unset($results["more_results"]);
		
	
		if($results){
		if($req_data->days == 1){
					$flex_file='001-1G_FlexRsp.xml';
					$flex_round_file='001-1G_FlexRoundRsp.xml';
			if($req_data->type != 'M'){
					if($request->type == 'O'){
					$flex_air_segment_date=$this->parseOutput($flex_file,0,$request);
					}else{
					$flex_air_segment_date=$this->parseOutput(0,$flex_round_file,$request);
					}
			}
					$data['flex_air_segment_date']=$flex_air_segment_date;
	}
}
		$data['more_results'] = $more_results;
		$data['flights'] = $results;
		$data['req'] = $req_data;
		$data['request']  = $req_data;
		$allview=$this->load->view('flight/flight-result', $data);
		echo $allview;
	}

	
public function GetAgain($request){

		$req_data=json_decode(base64_decode($request));
		
		$LowFareSearchRes = LowFareSearchReq($req_data);
		$aMarkup = $this->account_model->get_markup('FLIGHT'); //get markup
		$aMarkup = $aMarkup['markup'];
		$MyMarkup = $this->account_model->get_my_markup(); //get agent markup
		$myMarkup = $MyMarkup['markup'];
		 //echo ($myMarkup);die;
		if($req_data->type == 'M'){
			$results = $this->formatMultiResponse($LowFareSearchRes, $aMarkup, $myMarkup,$req_data->method);
			
		}else{
			$results = $this->formatResponse($LowFareSearchRes, $aMarkup, $myMarkup,$req_data->method);
		}
		$more_results=$results["more_results"];
		unset($results["more_results"]);
		$data['more_results'] = $more_results;
		$data['flights'] = $results;
		$data['req'] = $req_data;
		$data['request']  = $req_data;
		$allview=$this->load->view('flight/flight-result', $data);
		echo $allview;
	}



	public function RetrieveLowFareSearchReq(){

		$req_data=json_decode(json_encode($this->input->post()));
		//print_r($req_data);die;
		$LowFareSearchRes = RetrieveLowFareSearchReq($req_data);
		$aMarkup = $this->account_model->get_markup('FLIGHT'); //get markup
		$aMarkup = $aMarkup['markup'];
		$MyMarkup = $this->account_model->get_my_markup(); //get agent markup
		$myMarkup = $MyMarkup['markup'];
		 $method="Retrieve";//Asynch
		if($req_data->type == 'M'){
			$results = $this->formatMultiResponse($LowFareSearchRes, $aMarkup, $myMarkup,$method);
			
		}else{
			$results = $this->formatResponse($LowFareSearchRes, $aMarkup, $myMarkup,$method);
		}

		$more_results=$results["more_results"];
		unset($results["more_results"]);
		$data['more_results'] = $more_results;
		$data['flights'] = $results;
		$data['req'] = json_decode(base64_decode($req_data->request));
		$data['request']  = json_decode(base64_decode($req_data->request));
		if($req_data->type=='O'){
		$allview=$this->load->view('flight/ajax_results', $data,true);
		}else if($req_data->type=='R'){
		$allview=$this->load->view('flight/ajax_results_round', $data,true);
		} else if($req_data->type=='M'){
		$allview=$this->load->view('flight/ajax_results_multi', $data,true);
		}

		//echo $allview;
 echo json_encode(array('result' => $allview,'more_results'=>$more_results));
 

		
	}



	
	

	public function discounted_flight($id){
		if($id!=''){
			$data['flight_details'] =$this->flight_model->get_particular_discounted_flights($id);
			$data['flight_banners'] =$this->flight_model->get_discounted_flights_banners($id);
			$data['flight_img'] = $this->flight_model->get_first_img($id);
			$this->load->view('flight/discounted_flight',$data);
		}else{
			 $this->load->view('errors/404');
		}

	}

	public function discounted_hotels($id){
		if($id!=''){
			$data['flight_details'] =$this->flight_model->get_particular_discounted_flights($id);
			$data['flight_banners'] =$this->flight_model->get_discounted_flights_banners($id);
			$data['flight_img'] = $this->flight_model->get_first_img($id);
			$this->load->view('flight/discounted_hotels',$data);
		}else{
			 $this->load->view('errors/404');
		}

	}

	public function voucher($pnr_no){
        $pnr_no = base64_decode(base64_decode($pnr_no));
         $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1) {
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if($b_data->module == 'FLIGHT'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
				  if ($this->session->userdata('b2c_id')) {
               			 $c_user_type = 3;
              			  $c_user_id = $this->session->userdata('b2c_id');
					} else if ($this->session->userdata('b2b_id')) {
						 $c_user_type = 2;
                		$c_user_id = $this->session->userdata('b2b_id');
						
					} else {
						$c_user_type = "";
						$c_user_id = "";
					}
//if($c_user_id!='' && $c_user_type!='' && $data['Booking']->user_id == $c_user_id && $data['Booking']->user_type == $c_user_type)
				if($data['Booking']!='')
				{
                	$data['global'] = $booking = $this->booking_model->getBookingPnr($pnr_no)->row();
					$data['voucher_details'] =  $this->booking_model->getBookingvoucherinvoicedetails()->row();
	                $this->load->view('flight/voucher_view', $data);
				}
				else{
             $this->load->view('errors/404');
       			 }
            }
        }else{
             $this->load->view('errors/404');
        }
    }
	
	public function invoice($pnr_no){
		if($this->session->userdata('b2b_id')){
			$pnr_no = base64_decode(base64_decode($pnr_no));
	        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
	        if($count == 1) {
	            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
	            if($b_data->module == 'FLIGHT'){
	                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
	                $data['global'] = $booking = $this->booking_model->getBookingPnr($pnr_no)->row();
	                $this->load->view('flight/invoice_view', $data);
	            }
	        }else{
	              $this->load->view('errors/404');
	        }
		}else{
              $this->load->view('errors/404');
        }
    }

    public function uinvoice($pnr_no){
		if($this->session->userdata('b2c_id')){
			$pnr_no = base64_decode(base64_decode($pnr_no));
	        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
	        if($count == 1) {
	            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
	            if($b_data->module == 'FLIGHT'){
	                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
					if ($this->session->userdata('b2c_id')) {
               			 $c_user_type = 3;
              			  $c_user_id = $this->session->userdata('b2c_id');
					} else if ($this->session->userdata('b2b_id')) {
						 $c_user_type = 2;
                		$c_user_id = $this->session->userdata('b2b_id');
						
					} else {
						$c_user_type = "";
						$c_user_id = "";
					}

				if($c_user_id!='' && $c_user_type!='' && $data['Booking']->user_id == $c_user_id && $data['Booking']->user_type == $c_user_type)
				{
	                $data['global'] = $booking = $this->booking_model->getBookingPnr($pnr_no)->row();
					$data['voucher_details'] =  $this->booking_model->getBookingvoucherinvoicedetails()->row();
	                $this->load->view('flight/user_invoice_view', $data);
					}else{
	              $this->load->view('errors/404');
	        }
	            }
	        }else{
	              $this->load->view('errors/404');
	        }
		}else{
              $this->load->view('errors/404');
        }
    }

    public function mail_uinvoice($pnr_no){
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1){
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if($b_data->module == 'FLIGHT'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
               
                $data['to'] = $booking->BILLING_EMAIL;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                $email_type = 'Flight_Invoice';
                $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
                $data['booking_status'] = strtolower($booking->booking_status);
               
                $Response = $this->email_model->sendmail_flightInvoice($data);
                $response = array('status' => 1);
        		echo json_encode($response);
            }
        }else{
            $response = array('status' => 0);
        	echo json_encode($response);
        }
    }

    public function mail_invoice($pnr_no){
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1){
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if($b_data->module == 'FLIGHT'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
                $data['message'] = $this->load->view('flight/mail_invoice', $data,TRUE);
                $data['to'] = $booking->BILLING_EMAIL;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                $email_type = 'ApartmentUserInvoice';
                $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
                $data['booking_status'] = strtolower($booking->booking_status);
                $data['social_url'] = array(
		            'facebook_social_url' => 'https://www.facebook.com',
		            'twitter_social_url' => 'https://twitter.com',
		            'google_social_url' => 'https://google.com',
		        );
                $Response = $this->email_model->sendmail_flightInvoice($data);
                $response = array('status' => 1);
        		echo json_encode($response);
            }
        }else{
            $response = array('status' => 0);
        	echo json_encode($response);
        }
    }

    public function mail_voucher($pnr_no){
		
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1){
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if($b_data->module == 'FLIGHT'){
		$data['voucher_details'] =  $this->booking_model->getBookingvoucherinvoicedetails()->row();
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
		$data['message'] = $this->load->view('flight/mail_voucher', $data,TRUE);
                $data['to'] = $booking->BILLING_EMAIL;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                $email_type = 'Flight_Booking_Voucher';
                $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
                $data['booking_status'] = strtolower($booking->booking_status);
                
                $Response = $this->email_model->sendmail_flightVoucher($data);
                $response = array('status' => 1);
        		echo json_encode($response);
            }
        }else{
            $response = array('status' => 0);
        	echo json_encode($response);
        }
    }

	public function AddToCart(){


		$flight = $this->input->post('temp_d');
		$flight = json_decode(base64_decode($flight));

		$request = $this->input->post('temp_r');
		$request = json_decode(base64_decode($request));
		if($flight!='' && $request!=''){

			$this->Cart_Model->removeAllCart();


		$AirPriceReq_Res = AirPriceReq($flight, $request);
		 $AirPriceRes = $AirPriceReq_Res['AirPriceRes'];
		
		$aMarkup = $this->account_model->get_markup('FLIGHT'); //get markup
		$aMarkup = $aMarkup['markup'];

		$MyMarkup = $this->account_model->get_my_markup(); //get agent markup
		$myMarkup = $MyMarkup['markup'];
		//header("Content-type: text/xml");
		//print_r($AirPriceRes);die;
		$AirPriceRes = str_replace('SOAP:','',$AirPriceRes);
		$AirPriceRes = str_replace('air:','',$AirPriceRes);
		$AirPriceRes = new SimpleXMLElement($AirPriceRes);
		
		if(isset($AirPriceRes->Body->AirPriceRsp->AirPriceResult)){
			
			$AirItinerary =  $AirPriceRes->Body->AirPriceRsp->AirItinerary;
			$AirItinerary_xml =  $AirItinerary->asXML();
			//echo '<pre/>xml';print_r($AirItinerary_xml);
			
			$AirPricingSolution = $AirPriceRes->Body->AirPriceRsp->AirPriceResult->AirPricingSolution;			
			unset($AirPricingSolution->AirSegmentRef);
			$AirPricingSolution_xml = $AirPricingSolution->asXML();
			$all_passengers=array();$Passenger=array();
			foreach ($AirPricingSolution->AirPricingInfo as $AirPricingInfo) {
			if(isset($AirPricingInfo['ApproximateTotalPrice'])){
				$passngerTotalPrice_ = (string)$AirPricingInfo['ApproximateTotalPrice'];
			}else{
				$passngerTotalPrice_ = (string)$AirPricingInfo['TotalPrice'];
			}
			$passngerTotalPrice = substr($passngerTotalPrice_,3);
			$PTotalPrice_Curr = substr($passngerTotalPrice_,0,3);
			$passngerTotalPrice = $this->flight_model->currency_convertor($passngerTotalPrice,$PTotalPrice_Curr,CURR);
			$passngerTotalPrice = $this->account_model->PercentageToAmount($passngerTotalPrice,$aMarkup);
			$passngerTotalPrice = $this->account_model->PercentageToAmount($passngerTotalPrice,$myMarkup);
			if(isset($AirPricingInfo['EquivalentBasePrice'])){
				$PBasePrice_ = (string)$AirPricingInfo['EquivalentBasePrice'];
			}else{
				$PBasePrice_ = (string)$AirPricingInfo['ApproximateBasePrice'];
			}
			
			$PBasePrice = substr($PBasePrice_,3);
	    	$PBasePrice_Curr = substr($PBasePrice_,0,3);
	    	$PBasePrice = $this->flight_model->currency_convertor($PBasePrice,$PBasePrice_Curr,CURR);
	    	$PBasePrice = $this->account_model->PercentageToAmount($PBasePrice,$aMarkup);
	    	$PBasePrice = $this->account_model->PercentageToAmount($PBasePrice,$myMarkup);
				
				if(isset($AirPricingInfo['ApproximateTaxes'])){
				$PTaxes_ = (string)$AirPricingInfo['ApproximateTaxes'];
			}else{
				$PTaxes_ = (string)$AirPricingInfo['Taxes'];
			}
			$PTaxes = substr($PTaxes_,3);
	    	$PTaxes_Curr = substr($PTaxes_,0,3);
	    	$PTaxes = $this->flight_model->currency_convertor($PTaxes,$PTaxes_Curr,CURR);
	    	$PTaxes = $this->account_model->PercentageToAmount($PTaxes,$aMarkup);
	    	$PTaxes = $this->account_model->PercentageToAmount($PTaxes,$myMarkup);

				 $Passenger['BasePrice']=$PBasePrice;
				 $Passenger['Taxes']=$PTaxes;
				 $Passenger['TotalPrice']=$passngerTotalPrice;
				 foreach ($AirPricingInfo->PassengerType as $PassengerType) {
				 	if(isset($PassengerType['Code']))
        			$passenger_wise=(string)$PassengerType['Code'];
				 	$all_passengers[$passenger_wise][]=$Passenger;
				 	
				 }

				
			}
			 $passenger_details=base64_encode(json_encode($all_passengers));
			//echo '<pre/>';print_r($AirPricingSolution);exit;
			
			if(isset($AirPricingSolution['ApproximateTotalPrice'])){
				$TotalPrice_ = (string)$AirPricingSolution['ApproximateTotalPrice'];
			}else{
				$TotalPrice_ = (string)$AirPricingSolution['TotalPrice'];
			}
				
			 $TotalPrice = substr($TotalPrice_,3);
	    	 $TotalPrice_Curr = substr($TotalPrice_,0,3);
	    	 $TotalPrice = $this->flight_model->currency_convertor($TotalPrice,$TotalPrice_Curr,CURR);
	    	 $TotalPrice = $this->account_model->PercentageToAmount($TotalPrice,$aMarkup);
	    	$TotalPrice = $this->account_model->PercentageToAmount($TotalPrice,$myMarkup);
			$Markup = $this->account_model->PercentageAmount($TotalPrice,$myMarkup);
			if(isset($AirPricingSolution['EquivalentBasePrice'])){
				$BasePricee = (string)$AirPricingSolution['EquivalentBasePrice'];
			}else{
				$BasePricee = (string)$AirPricingSolution['ApproximateBasePrice'];
			}
			$BasePrice = substr($BasePricee,3);
	    	$BasePrice_Curr = substr($BasePricee,0,3);
	    	$BasePrice = $this->flight_model->currency_convertor($BasePrice,$BasePrice_Curr,CURR);
	    	$BasePrice = $this->account_model->PercentageToAmount($BasePrice,$aMarkup);
	    	$BasePrice = $this->account_model->PercentageToAmount($BasePrice,$myMarkup);
				if(isset($AirPricingSolution['ApproximateTaxes'])){
				$Taxes_ = (string)$AirPricingSolution['ApproximateTaxes'];
			}else{
				$Taxes_ = (string)$AirPricingSolution['Taxes'];
			}
			$Taxes = substr($Taxes_,3);
	    	$Taxes_Curr = substr($Taxes_,0,3);
	    	$Taxes = $this->flight_model->currency_convertor($Taxes,$Taxes_Curr,CURR);
	    	$Taxes = $this->account_model->PercentageToAmount($Taxes,$aMarkup);
	    	$Taxes = $this->account_model->PercentageToAmount($Taxes,$myMarkup);
	    	//echo $Taxes_.$BasePricee.$TotalPrice_;die;
	    	if($request->type == 'O'){
	    		
	    		$first_seg = reset($flight->segments);
    			$last_seg = end($flight->segments);
	    	}else if($request->type == 'M'){
				
				$first =reset($flight->segments);
				if(is_array($first)){
					$first_seg = reset($first);
				}else{
					$first_seg =$first;
				}
					
    			$last = end($flight->segments);
    			if(is_array($last)){
					$last_seg = end($last);
				}else{
					$last_seg =$last;
				}
				
			}else if ($request->type == 'R') {
	    		$first_seg = reset($flight->onward->segments);
    			$last_seg = end($flight->onward->segments);
	    	}
	    	//echo '<pre>';print_r($first_seg);echo $first_seg->Origin;
	    	 $fromCityName =  $this->flight_model->get_airport_cityname($first_seg->Origin);

    		 $toCityName =  $this->flight_model->get_airport_cityname($last_seg->Destination);
    		//die;
    		$AirImage = ASSETS.'images/airline_logo/'.$first_seg->Carrier.'.gif';
    		//Exploding T from arrival time  
		    list($date, $time) = explode('T', $last_seg->ArrivalTime);
		    $time = preg_replace("/[.]/", " ", $time);
		    list($time, $TimeOffSet) = explode(" ", $time);
		    $ArrivalDateTime = $date." ".$time; //Exploding T and adding space
		    $ArrivalDateTime = $art = strtotime($ArrivalDateTime);
		    //Exploding T from depature time  
		    list($date, $time) = explode('T', $first_seg->DepartureTime);
		    $time = preg_replace("/[.]/", " ", $time);
		    list($time, $TimeOffSet) = explode(" ", $time);
		    $DepartureDateTime = $date." ".$time; //Exploding T and adding space
		    $DepartureDateTime = $dpt = strtotime($DepartureDateTime);
		    
		    $seconds = $ArrivalDateTime - $DepartureDateTime;
			$days = floor($seconds / 86400);
		    $hours = floor(($seconds - ($days * 86400)) / 3600);
		    $minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
		   	if($days==0){
		        $dur=$hours."h ".$minutes."m";  
		    }else{
		        $dur=$days."d ".$hours."h ".$minutes."m";
		    }

	    	$cart_flight = array(
				'request' => $this->input->post('temp_r'),
				'response' => $this->input->post('temp_d'),
				'Origin' => $first_seg->Origin,
				'Destination' => $last_seg->Destination,
				'fromCityName' => $fromCityName,
				'toCityName' => $toCityName,
				'DepartureTime' => $DepartureDateTime,
				'ArrivalTime' => $ArrivalDateTime,
				'duration' => $dur,
				'AirImage' => $AirImage,
				'AirPriceRes' => base64_encode(json_encode($request)),
				'TotalPrice' => $TotalPrice,
				'SITE_CURR' => CURR,
				'MyMarkup' => $Markup,
				//'VisibleMarkupDiscount' => json_encode($VisibleMarkupsArray),
				//'HiddenMarkupDiscount' => $HiddenFeeAmount,
				'API_CURR' => $TotalPrice_Curr,
				'BasePrice' => $BasePrice,
				'TaxPrice' => $Taxes,
				'passenger_details' => $passenger_details,
				'AirItinerary_xml' => $AirItinerary_xml, 
				'AirPricingSolution_xml' => $AirPricingSolution_xml,
				'TIMESTAMP' => date('Y-m-d H:i:s')
			);

			
			//echo '<pre/>xml';print_r($cart_flight);exit;		
			$booking_cart_id = $this->flight_model->insert_cart_flight($cart_flight);
	        $session_id = $this->session->userdata('session_id');
	        if($this->session->userdata('b2c_id')){
	            $user_type = 3;
	            $user_id = $this->session->userdata('b2c_id');
	        }else if($this->session->userdata('b2b_id')){
	            $user_type = 2;
	            $user_id = $this->session->userdata('b2b_id');
	        }else{
	            $user_type = '';
	            $user_id = '';
	        }
	        $cart_global = array(
	            'parent_cart_id' => 0,
	            'ref_id' => $booking_cart_id,
	            'module' => 'FLIGHT',
	            'user_type' => $user_type,
	            'user_id' => $user_id,
	            'session_id' => $session_id,
	            'site_curr' => CURR,
	            'total' => $TotalPrice,
	            'ip' =>  $this->input->ip_address(),
	            'timestamp' => date('Y-m-d H:i:s')
	        );
	        $cart_global_id = $this->cart_model->insert_cart_global($cart_global);
	        $data['status'] = 1;
	        $cart_data = $this->cart_model->getCartData($session_id)->result();
	        $data['count'] = count($cart_data);
	        $data['is_xml_msg'] = '';
	        if(count($cart_data) > 0){
	            $data['isCart'] = true;
	        }else{
	            $data['isCart'] = false;
	        }
	        if(!empty($cart_data)){
	            $data['C_URL'] = WEB_URL.'/booking/'.$session_id;
	            foreach ($cart_data as $key => $cartt) {
	            	if($cartt->module == 'FLIGHT'){
	                	$cart = $this->cart_model->getCartDataByModule($cartt->cart_id,$cartt->module)->row();
	                	$request = json_decode(base64_decode($cart->request));
	                	
	                	if($request->type == 'O' || $request->type == 'R'){
				    		$originCity = $this->flight_model->get_airport_cityname($request->origin);
	                		$destinationCity = $this->flight_model->get_airport_cityname($request->destination);
	                		$origin = $request->origin;
			    			$destination = $request->destination;
				    	}else if ($request->type == 'M') {
				    		//echo '<pre>';print_r($request);die;
				    		$origin = reset($request->origin);
			    			$destination = end($request->destination);
			    			$originCity = $this->flight_model->get_airport_cityname($origin);
	                		$destinationCity = $this->flight_model->get_airport_cityname($destination);
				    	}
	                	
	                	$data['cart'][] = array(
		                    'RID' => $session_id.'cart'.$key,
		                    'CID' => $cart->cart_id,
		                    'REF_ID' => $cart->ref_id,
		                    'TYPE' => 'flightcart',
		                    'NAME' => $originCity.' ('.$origin.') - '.$destinationCity.' ('.$destination.')',
		                    'URL' => WEB_URL,
		                    'ADDRESS' => date('d M, Y H:i', $cart->DepartureTime).' - '.date('d M, Y H:i', $cart->ArrivalTime),
		                    'TOTAL' => $this->account_model->currency_convertor($cart->TotalPrice),
		                    'IMAGE' => $cart->AirImage
		                );
	                	$GRAND_TOTAL[] = $cart->TotalPrice;
	                }
	            }
	            $data['GRAND_TOTAL'] = $this->account_model->currency_convertor(array_sum($GRAND_TOTAL));
	        }
			$data_C_URL = WEB_URL.'/booking/'.$session_id;
		   	redirect($data_C_URL);
	        
		}else{
			

			$xml_log = array(
	    		'Api' => 'UAPI',
	    		'XML_Type' => 'Flight',
	    		'XML_Request' => $AirPriceReq_Res['AirPriceReq'],
	    		'XML_Response' => $AirPriceReq_Res['AirPriceRes'],
	    		'Ip_address' => $this->input->ip_address(),
	    		'XML_Time' => date('Y-m-d H:i:s')
	    	);
	    	$this->xml_model->insert_xml_log($xml_log);
			$session_id = $this->session->userdata('session_id');
			$cart_data = $this->cart_model->getCartData($session_id)->result();
			 $AirPriceErrorRes = str_replace('SOAP:','',$AirPriceReq_Res['AirPriceRes']);
			 $AirPriceErrorRes = str_replace('common_v33_0:','',$AirPriceErrorRes);
			 $AirPriceErrorRes = new SimpleXMLElement($AirPriceErrorRes);
			 if(isset($AirPriceErrorRes->Body->Fault->detail->ErrorInfo->Description)){
			 $AirPriceErrorRes_msg =$AirPriceErrorRes->Body->Fault->detail->ErrorInfo->Description->asXML();	
		 }else{
		 	 $AirPriceErrorRes_msg = $AirPriceErrorRes->Body->Fault->detail->ErrorInfo;	
		 }
		
		 $this->load->helper('xml');
	     $data['xml_error']=xml_convert($AirPriceReq_Res['AirPriceRes']);
	        $this->load->view('errors/api_error',$data);
	        
		}
		
		   
		
		}
	}
	

	

	function formatResponse($LowFareSearchReq_Res, $aMarkup, $myMarkup,$method){
		$LowFareSearchRes = $LowFareSearchReq_Res['LowFareSearchRes'];
		if(empty($LowFareSearchRes)){
	    	return false;
	    }
	    $LowFareSearchRes = $this->xml_to_array->XmlToArray($LowFareSearchRes);

	   // echo '<pre>';print_r($LowFareSearchRes);die;
	    if(isset($LowFareSearchRes['SOAP:Body']['SOAP:Fault']) || isset($LowFareSearchRes['SOAP-ENV:Body']['SOAP-ENV:Fault'])){
	    	$xml_log = array(
	    		'Api' => 'UAPI',
	    		'XML_Type' => 'Flight',
	    		'XML_Request' => $LowFareSearchReq_Res['LowFareSearchReq'],
	    		'XML_Response' => $LowFareSearchReq_Res['LowFareSearchRes'],
	    		'Ip_address' => $this->input->ip_address(),
	    		'XML_Time' => date('Y-m-d H:i:s')
	    	);
	    	$this->xml_model->insert_xml_log($xml_log);
			return false;
	    }
		else
		{
			if($method=="Asynch"){
			$Search_method="air:LowFareSearchAsynchRsp";
			}elseif($method=="Retrieve"){
				$Search_method="air:RetrieveLowFareSearchRsp";
			}else{
				$Search_method="air:LowFareSearchRsp";
			}
			
			$first_Xml_element=$LowFareSearchRes['SOAP:Body'][$Search_method];

			
		   if(isset($first_Xml_element['@attributes']['CurrencyType'])){
		    $CurrencyType = $first_Xml_element['@attributes']['CurrencyType'];
			}else{
				$CurrencyType=CURR;
			}

			if(isset($first_Xml_element['@attributes']['SearchId'])){
	    $SearchId = $first_Xml_element['@attributes']['SearchId'];
			}else{
				$SearchId='';
			}
	    $FlightDetails = isset($first_Xml_element['air:FlightDetailsList']['air:FlightDetails'])?$first_Xml_element['air:FlightDetailsList']['air:FlightDetails']:'';
	    $AirSegment = isset($first_Xml_element['air:AirSegmentList']['air:AirSegment'])?$first_Xml_element['air:AirSegmentList']['air:AirSegment']:'';
	    $AirPricingSolutions = isset($first_Xml_element['air:AirPricingSolution'])?$first_Xml_element['air:AirPricingSolution']:'';
	    $FareInfos = isset($first_Xml_element['air:FareInfoList']['air:FareInfo'])?$first_Xml_element['air:FareInfoList']['air:FareInfo']:'';
	     $FareBasis = isset($first_Xml_element['air:FareInfoList']['air:FareInfo'])?$first_Xml_element['air:FareInfoList']['air:FareInfo']:'';
	     if(isset($first_Xml_element['air:HostTokenList'])){
	    $HostTokenLists = $first_Xml_element['air:HostTokenList']['common_v33_0:HostToken'];
		}
$AsyncProviderSpecificResponses = isset($first_Xml_element['air:AsyncProviderSpecificResponse'][0])?$first_Xml_element['air:AsyncProviderSpecificResponse']:array(0 =>isset($first_Xml_element['air:AsyncProviderSpecificResponse'])?$first_Xml_element['air:AsyncProviderSpecificResponse']:'');
$more_results=array();


foreach ($AsyncProviderSpecificResponses as $AsyncProviderSpecificResponse) {
	if(isset($AsyncProviderSpecificResponse['@attributes']) && $AsyncProviderSpecificResponse['@attributes']['MoreResults']=="true"){
$more_results=$AsyncProviderSpecificResponse['@attributes'];
}
}
$more_results['SearchId']=$SearchId;
	if(is_array($AirPricingSolutions)){
	  
	    $i=0;
	    foreach ($AirPricingSolutions as $key => $AirPricingSolution) {
//echo $key;die;
if (array_key_exists(0,$AirPricingSolutions))
{
$AirPricingSolution=$AirPricingSolution;
}
else
{
$AirPricingSolution=$AirPricingSolutions;
}

	    	$Journey = isset($AirPricingSolution['air:Journey'])?$AirPricingSolution['air:Journey']:$AirPricingSolutions['air:Journey'];
	    	$AirPricingInfo = isset($AirPricingSolution['air:AirPricingInfo'])?$AirPricingSolution['air:AirPricingInfo']:$AirPricingSolutions['air:AirPricingInfo'];	
	    	$AirPricingSolution_Attr = isset($AirPricingSolution['@attributes'])?$AirPricingSolution['@attributes']:$AirPricingSolutions['@attributes'];
	    	$AirPricingSolution_Attr = json_encode($AirPricingSolution_Attr);
	    	$AirPricingSolution_Attr = json_decode($AirPricingSolution_Attr);
	    	
	    	
	    	//echo '<pre>';print_r($AirPricingSolution_Attr->CompleteItinerary);die;
	    	$fs[$i]['AirPricingSolution_Key'] = $AirPricingSolution_Attr->Key;
	    	

	    	$fs[$i]['CompleteItinerary'] = isset($AirPricingSolution_Attr->CompleteItinerary)?$AirPricingSolution_Attr->CompleteItinerary:'';
	    	  $Connections='';
	    	if(isset($AirPricingSolution['air:Connection'])){
	    		
			$Air_Connections = $AirPricingSolution['air:Connection'];

	    	foreach ($Air_Connections as $air_Connection) {
	    				
	    				if(isset($air_Connection['@attributes'])){
	    				
	    					$Connections.=$air_Connection['@attributes']['SegmentIndex'].",";
	    					
						}else{
							$Connections.=$air_Connection['SegmentIndex'].",";
						}
	    				
	    			}

	    			
	    		}
	    		$fs[$i]['Connections']=$Connections;
	    	
			if(isset($AirPricingSolution_Attr->ApproximateTotalPrice)){
			$TotalPrice_ = ($AirPricingSolution_Attr->ApproximateTotalPrice);
			}else{
			$TotalPrice_ = ($AirPricingSolution_Attr->TotalPrice);
			}
	    	$TotalPrice = substr($TotalPrice_,3);
	    	$TotalPrice_Curr = substr($TotalPrice_,0,3);
	    	$TotalPrice = $this->flight_model->currency_convertor($TotalPrice,$TotalPrice_Curr,CURR);
	    	$TotalPrice = $this->account_model->PercentageToAmount($TotalPrice,$aMarkup);
	    	$TotalPrice = $this->account_model->PercentageToAmount($TotalPrice,$myMarkup);
	    	
	    	if(isset($AirPricingSolution_Attr->EquivalentBasePrice)){
				$BasePrice = substr($AirPricingSolution_Attr->EquivalentBasePrice,3);
		    	$BasePrice_Curr = substr($AirPricingSolution_Attr->EquivalentBasePrice,0,3);
		    	$BasePrice = $this->flight_model->currency_convertor($BasePrice,$BasePrice_Curr,CURR);
		    	$BasePrice = $this->account_model->PercentageToAmount($BasePrice,$aMarkup);
		    	$BasePrice = $this->account_model->PercentageToAmount($BasePrice,$myMarkup);
			}elseif(isset($AirPricingSolution_Attr->ApproximateBasePrice)) {
				
			    $BasePrice = substr($AirPricingSolution_Attr->ApproximateBasePrice,3);
		    	$BasePrice_Curr = substr($AirPricingSolution_Attr->ApproximateBasePrice,0,3);
		    	$BasePrice = $this->flight_model->currency_convertor($BasePrice,$BasePrice_Curr,CURR);
		    	$BasePrice = $this->account_model->PercentageToAmount($BasePrice,$aMarkup);
		    	$BasePrice = $this->account_model->PercentageToAmount($BasePrice,$myMarkup);
			}else{
				$BasePrice = substr($AirPricingSolution_Attr->BasePrice,3);
		    	$BasePrice_Curr = substr($AirPricingSolution_Attr->BasePrice,0,3);
		    	$BasePrice = $this->flight_model->currency_convertor($BasePrice,$BasePrice_Curr,CURR);
		    	$BasePrice = $this->account_model->PercentageToAmount($BasePrice,$aMarkup);
		    	$BasePrice = $this->account_model->PercentageToAmount($BasePrice,$myMarkup);
			}
			
			if(isset($AirPricingSolution_Attr->ApproximateTaxes)){
			$Taxes_ = ($AirPricingSolution_Attr->ApproximateTaxes);
			}else{
			$Taxes_ = ($AirPricingSolution_Attr->Taxes);
			}

			$Taxes = substr($Taxes_,3);
	    	$Taxes_Curr = substr($Taxes_,0,3);
	    	$Taxes = $this->flight_model->currency_convertor($Taxes,$Taxes_Curr,CURR);
	    	$Taxes = $this->account_model->PercentageToAmount($Taxes,$aMarkup);
	    	$Taxes = $this->account_model->PercentageToAmount($Taxes,$myMarkup);

	    	$fs[$i]['TotalPrice'] = $TotalPrice;
	    	$fs[$i]['BasePrice'] = $BasePrice;
	    	$fs[$i]['Taxes'] = $Taxes;
	    	$fs[$i]['TotalPrice_API'] = $AirPricingSolution_Attr->TotalPrice;
	    	$fs[$i]['APICurrencyType'] = $CurrencyType;
	    	$fs[$i]['SITECurrencyType'] = CURR;
	    	$fs[$i]['MyMarkup'] = $myMarkup;
	    	$fs[$i]['aMarkup'] =$aMarkup;
	    	$All_Passenger=array();
	    	if(isset($AirPricingSolution['air:AirPricingInfo'][0])){
	    		$AirPricingInfo_Attr = $AirPricingInfo[0]['@attributes'];
	    		$AirPricingInfo_Attr = json_encode($AirPricingInfo_Attr);
	    		$AirPricingInfo_Attr = json_decode($AirPricingInfo_Attr);
	    		if(isset($AirPricingInfo_Attr->PlatingCarrier)){
	    			$PlatingCarrier = $AirPricingInfo_Attr->PlatingCarrier;
	    		}else{
	    			$PlatingCarrier = '';
	    		}

	    		if(isset($AirPricingInfo_Attr->Refundable)){
	    			$Refundable = $AirPricingInfo_Attr->Refundable;
	    		}else{
	    			$Refundable = false;
	    		}

	    		$AirPricingInfos = $AirPricingInfo;
	    		$Pass_BasePrice=array(); $Pass_Taxes=array();$fare_iNfoss=array();
	    		foreach ($AirPricingInfos as $key => $AirPricingInfo) {


	    			$Passenger_type=$AirPricingInfo['air:PassengerType'];

	    			foreach ($Passenger_type as $key => $Passenger_type_details) {
	    				
	    				if(isset($Passenger_type_details['@attributes'])){
	    					$All_Passenger[]=$Passenger_type_details['@attributes']['Code'];
	    					
						}else{
							$All_Passenger[] = $Passenger_type_details['Code'];
						}
	    				
	    			}


	    			if(isset($AirPricingInfo['@attributes']['EquivalentBasePrice'])){
	    				$BasePrice = substr($AirPricingInfo['@attributes']['EquivalentBasePrice'],3);
				    	$BasePrice_Curr = substr($AirPricingInfo['@attributes']['EquivalentBasePrice'],0,3);
				    	$BasePrice = $this->flight_model->currency_convertor($BasePrice,$BasePrice_Curr,CURR);
				    	
						$Pass_BasePrice[] = $BasePrice;
					}elseif (isset($AirPricingInfo['@attributes']['ApproximateBasePrice'])) {
					$BasePrice = substr($AirPricingInfo['@attributes']['ApproximateBasePrice'],3);
				    	$BasePrice_Curr = substr($AirPricingInfo['@attributes']['ApproximateBasePrice'],0,3);
				    	$BasePrice = $this->flight_model->currency_convertor($BasePrice,$BasePrice_Curr,CURR);
						$Pass_BasePrice[] = $BasePrice;
					}else{
						$BasePrice = substr($AirPricingInfo['@attributes']['BasePrice'],3);
				    	$BasePrice_Curr = substr($AirPricingInfo['@attributes']['BasePrice'],0,3);
				    	$BasePrice = $this->flight_model->currency_convertor($BasePrice,$BasePrice_Curr,CURR);
						$Pass_BasePrice[] = $BasePrice;
					}
					
					if(isset($AirPricingInfo['@attributes']['ApproximateTaxes'])){
					$Taxes = substr($AirPricingInfo['@attributes']['ApproximateTaxes'],3);
			    	$Taxes_Curr = substr($AirPricingInfo['@attributes']['ApproximateTaxes'],0,3);
			    	$Taxes = $this->flight_model->currency_convertor($Taxes,$Taxes_Curr,CURR);
			    	$Pass_Taxes[] = $Taxes;
						}else{
							if(isset($AirPricingInfo['@attributes']['Taxes'])){
					$Taxes = substr($AirPricingInfo['@attributes']['Taxes'],3);
			    	$Taxes_Curr = substr($AirPricingInfo['@attributes']['Taxes'],0,3);
			    	$Taxes = $this->flight_model->currency_convertor($Taxes,$Taxes_Curr,CURR);
			    }else{
			    	$Taxes=0;
			    }
							$Pass_Taxes[] = $Taxes;
						}
						
					
	    		}

				$All_Passengers = implode(',',$All_Passenger);
	    		$Pass_BasePrice = implode(',',$Pass_BasePrice);
				$Pass_Taxes = implode(',',$Pass_Taxes);
						//print_r($AirPricingInfo[0]['air:BookingInfo']);die;
				$BookingInfo = $AirPricingInfo['air:BookingInfo'];	

	    	}else{
					
	    		$AirPricingInfo_Attr = $AirPricingInfo['@attributes'];

	    		$AirPricingInfo_Attr = json_encode($AirPricingInfo_Attr);
	    		$AirPricingInfo_Attr = json_decode($AirPricingInfo_Attr);
	    		if(isset($AirPricingInfo_Attr->PlatingCarrier)){
	    			$PlatingCarrier = $AirPricingInfo_Attr->PlatingCarrier;
	    		}else{
	    			$PlatingCarrier = '';
	    		}

	    		if(isset($AirPricingInfo_Attr->Refundable)){
	    			$Refundable = $AirPricingInfo_Attr->Refundable;
	    		}else{
	    			$Refundable = false;
	    		}

					$Passenger_type=$AirPricingInfo['air:PassengerType'];

	    			foreach ($Passenger_type as $key => $Passenger_type_details) {
	    				
	    				if(isset($Passenger_type_details['@attributes'])){
	    					$All_Passenger[]=$Passenger_type_details['@attributes']['Code'];
	    					
						}else{
							$All_Passenger[] = $Passenger_type_details['Code'];
						}
	    				
	    			}

	    			$All_Passengers = implode(',',$All_Passenger);
	    		if(isset($AirPricingInfo_Attr->EquivalentBasePrice)){
    				$BasePrice = substr($AirPricingInfo_Attr->EquivalentBasePrice,3);
			    	$BasePrice_Curr = substr($AirPricingInfo_Attr->EquivalentBasePrice,0,3);
			    	$BasePrice = $this->flight_model->currency_convertor($BasePrice,$BasePrice_Curr,CURR);
					$Pass_BasePrice = $BasePrice;
				}elseif (isset($AirPricingInfo_Attr->ApproximateBasePrice)) {
				
					$BasePrice = substr($AirPricingInfo_Attr->ApproximateBasePrice,3);
			    	$BasePrice_Curr = substr($AirPricingInfo_Attr->ApproximateBasePrice,0,3);
			    	$BasePrice = $this->flight_model->currency_convertor($BasePrice,$BasePrice_Curr,CURR);
					$Pass_BasePrice = $BasePrice;
				}else{
					$BasePrice = substr($AirPricingInfo_Attr->BasePrice,3);
			    	$BasePrice_Curr = substr($AirPricingInfo_Attr->BasePrice,0,3);
			    	$BasePrice = $this->flight_model->currency_convertor($BasePrice,$BasePrice_Curr,CURR);
					$Pass_BasePrice = $BasePrice;
				}
				if(isset($AirPricingInfo_Attr->ApproximateTaxes)){
					$Taxes = substr($AirPricingInfo_Attr->ApproximateTaxes,3);
		    	$Taxes_Curr = substr($AirPricingInfo_Attr->ApproximateTaxes,0,3);
		    	$Taxes = $this->flight_model->currency_convertor($Taxes,$Taxes_Curr,CURR);
				$Pass_Taxes = $Taxes;
				}else{
				$Taxes = substr($AirPricingInfo_Attr->Taxes,3);
		    	$Taxes_Curr = substr($AirPricingInfo_Attr->Taxes,0,3);
		    	$Taxes = $this->flight_model->currency_convertor($Taxes,$Taxes_Curr,CURR);
				$Pass_Taxes = $Taxes;
				}
				$BookingInfo = $AirPricingInfo['air:BookingInfo'];	
	    	}

	    	if($Refundable == 'true'){
				$FareType = 'Refundable';
	    	}else{
				$FareType = 'Non Refundable';
			}
	    	$fs[$i]['BasePrice_Breakdown'] = $Pass_BasePrice;
	    	$fs[$i]['TaxPrice_Breakdown'] = $Pass_Taxes;
	    	$fs[$i]['Refundable'] = $Refundable;
	    	$fs[$i]['PlatingCarrier'] = $PlatingCarrier;
	    	$fs[$i]['FareType'] = $FareType;
	    	$fs[$i]['All_Passenger'] = $All_Passengers;
	    	$passenger_count=array_count_values($All_Passenger);
	    	$fs[$i]['Adults'] =$passenger_count['ADT'];
	    	if(isset($passenger_count['CNN'])){
	    	$fs[$i]['Childs'] =$passenger_count['CNN'];
	    	}
	    	if(isset($passenger_count['INF'])){
	    	$fs[$i]['Infants'] =$passenger_count['INF'];
	    	}
	    	$split_base_price=explode(",", $Pass_BasePrice);
	    	$fs[$i]['Adults_Base_Price'] =$split_base_price[0];
	    	if(isset($split_base_price[1])){
	    	$fs[$i]['Childs_Base_Price'] =$split_base_price[1];
	    }
	    if(isset($split_base_price[2])){
	    	$fs[$i]['Infants_Base_Price'] =$split_base_price[2];
		}

		$split_tax_price=explode(",", $Pass_Taxes);
		$fs[$i]['Adults_Tax_Price'] =$split_tax_price[0];
	    	if(isset($split_tax_price[1])){
	    	$fs[$i]['Childs_Tax_Price'] =$split_tax_price[1];
	    }
	    if(isset($split_base_price[2])){
	    	$fs[$i]['Infants_Tax_Price'] =$split_tax_price[2];
		}
	    	if(isset($AirPricingSolution['air:Journey'][0])){
				
				 $tot_seg=count($AirPricingSolution['air:Journey']);
				if($tot_seg==2){
					$Tot_time_Attr=array();
					foreach ($AirPricingSolution['air:Journey'] as $tottravel) {
						$Tot_time_Attr[] = $tottravel['@attributes'];
					}
					
					 $fs[$i]['Onward_TravelTime'] = $Tot_time_Attr[0]['TravelTime'];
					 $fs[$i]['Return_TravelTime'] = $Tot_time_Attr[1]['TravelTime'];
				}

				$Journies = $Journey;
	    		//return false;//round trip
	    		$j=0;
	    		foreach ($Journies as $key => $Journey) {
	    			if($j == 0){
						$mode = 'onward';
	    			}else{
						$mode = 'return';
					}
					


					$Journey_Attr = $Journey['@attributes'];
									
					 $TravelTime = $Journey_Attr['TravelTime'];
					$fs[$i]['trip_type'] = $mode;
					$fs[$i]['TravelTime'] = $TravelTime;

					$Stops = 0;
					$AirSegmentRefs = $AirSegmentRef = $Journey['air:AirSegmentRef'];
					//$fs[$i]['Total_segments'] = count($AirSegmentRefs);;
					if(isset($AirSegmentRefs[0])){
						foreach ($AirSegmentRefs as $jk => $AirSegmentRef) {
							$AirSegmentRef_Attr = $AirSegmentRef['@attributes'];									
							$AirSegmentRef_Key = $AirSegmentRef_Attr['Key'];
							$AirSegments = $AirSegment;
							foreach ($AirSegments as $key => $AirSegmentt) {
								$AirSegment_Attr =  $AirSegmentt['@attributes'];										
								$AirSegment_Key = $AirSegment_Attr['Key'];
								
								if($AirSegment_Key == $AirSegmentRef_Key){
									$fs[$i][$mode]['segments'][$jk]['AirSegment_Key'] = $AirSegment_Key;
									$fs[$i][$mode]['segments'][$jk]['Group'] = $Group = $AirSegment_Attr['Group'];									
									$fs[$i][$mode]['segments'][$jk]['Carrier'] = $Carrier = $AirSegment_Attr['Carrier'];
									$fs[$i][$mode]['segments'][$jk]['FlightNumber'] = $FlightNumber = $AirSegment_Attr['FlightNumber'];
									$fs[$i][$mode]['segments'][$jk]['Origin'] = $Origin = $AirSegment_Attr['Origin'];
									$fs[$i][$mode]['segments'][$jk]['Destination'] = $Destination = $AirSegment_Attr['Destination'];
									$fs[$i][$mode]['segments'][$jk]['DepartureTime'] = $DepartureTime = $AirSegment_Attr['DepartureTime'];
									$fs[$i][$mode]['segments'][$jk]['ArrivalTime'] = $ArrivalTime = $AirSegment_Attr['ArrivalTime'];
									$fs[$i][$mode]['segments'][$jk]['FlightTime'] = $FlightTime = $AirSegment_Attr['FlightTime'];
									$fs[$i][$mode]['segments'][$jk]['Distance'] = $Distance = isset($AirSegment_Attr['Distance'])?$AirSegment_Attr['Distance']:'';
									$fs[$i][$mode]['segments'][$jk]['ETicketability'] = $ETicketability = isset($AirSegment_Attr['ETicketability'])?$AirSegment_Attr['ETicketability']:'';
									$fs[$i][$mode]['segments'][$jk]['Equipment'] = $Equipment = $AirSegment_Attr['Equipment'];
									$fs[$i][$mode]['segments'][$jk]['ChangeOfPlane'] = $ChangeOfPlane = $AirSegment_Attr['ChangeOfPlane'];
									$fs[$i][$mode]['segments'][$jk]['ParticipantLevel'] = $ParticipantLevel = isset($AirSegment_Attr['ParticipantLevel'])?$AirSegment_Attr['ParticipantLevel']:'';
									if(isset($AirSegment_Attr['APISRequirementsRef'])){
							$fs[$i][$mode]['segments'][$jk]['APISRequirementsRef'] = $AirSegment_Attr['APISRequirementsRef'];
							}

							if(isset($AirSegment_Attr['AvailabilityDisplayType'])){
							$fs[$i][$mode]['segments'][$jk]['AvailabilityDisplayType'] =  $AirSegment_Attr['AvailabilityDisplayType'];
							}
									if(isset($AirSegment_Attr['SupplierCode'])){
									$fs[$i][$mode]['segments'][$jk]['SupplierCode']  = $AirSegment_Attr['SupplierCode'];
									}
									if(isset($AirSegment_Attr['Status'])){
									$fs[$i][$mode]['segments'][$jk]['Status']  = $AirSegment_Attr['Status'];
									}

									$LinkAvailability = '';
									if(isset($AirSegment_Attr['LinkAvailability'])){
										$LinkAvailability = $AirSegment_Attr['LinkAvailability'];
									}
									$fs[$i][$mode]['segments'][$jk]['LinkAvailability'] = $LinkAvailability;
									$fs[$i][$mode]['segments'][$jk]['PolledAvailabilityOption'] = $PolledAvailabilityOption = isset($AirSegment_Attr['PolledAvailabilityOption'])?$AirSegment_Attr['PolledAvailabilityOption']:'';
									$fs[$i][$mode]['segments'][$jk]['OptionalServicesIndicator'] = $OptionalServicesIndicator = isset($AirSegment_Attr['OptionalServicesIndicator'])?$AirSegment_Attr['OptionalServicesIndicator']:'';
									$AvailabilitySource = '';
									if(isset($AirSegment_Attr['AvailabilitySource'])){	
										$AvailabilitySource = $AirSegment_Attr['AvailabilitySource'];
									}
									$fs[$i][$mode]['segments'][$jk]['AvailabilitySource'] = $AvailabilitySource;
									if(isset($AirSegment['air:CodeshareInfo']) && is_array($AirSegment['air:CodeshareInfo'])){
										$CodeshareInfo_Attr =  $AirSegment['air:CodeshareInfo']['@attributes'];	
										$OperatingCarrier = $CodeshareInfo_Attr['OperatingCarrier'];	

										$OperatingFlightNumber = '';
										if(isset($CodeshareInfo_Attr['OperatingFlightNumber'])){	
											$OperatingFlightNumber = $CodeshareInfo_Attr['OperatingFlightNumber'];		
										}
									}else if(isset($AirSegment['air:CodeshareInfo'])){
										$OperatingCarrier = $AirSegment['air:CodeshareInfo'];
										$OperatingFlightNumber = '';
									}else{
										$OperatingCarrier = '';
										$OperatingFlightNumber = '';
									}
									$fs[$i][$mode]['segments'][$jk]['OperatingCarrier'] = $OperatingCarrier;
									$fs[$i][$mode]['segments'][$jk]['OperatingFlightNumber'] = $OperatingFlightNumber;
									$ProviderCode = '';$BookingCounts = '';
									
									if(isset($AirSegmentt['air:AirAvailInfo'])){
										$ProviderCode = $AirSegmentt['air:AirAvailInfo']['@attributes']['ProviderCode'];
										$BookingCodeInfo_Attr =  $AirSegmentt['air:AirAvailInfo']['air:BookingCodeInfo']['@attributes'];	
										$BookingCounts = $BookingCodeInfo_Attr['BookingCounts'];
									}
									
									$fs[$i][$mode]['segments'][$jk]['ProviderCode'] = $ProviderCode;
									$fs[$i][$mode]['segments'][$jk]['BookingCounts'] = $BookingCounts;
									if(isset($AirSegmentt['air:FlightDetailsRef']['@attributes'])){
										$FlightDetailsRef_Key =  $AirSegmentt['air:FlightDetailsRef']['@attributes']['Key'];	
									}else{
		                                $FlightDetailsRef_Key ='';
		                            }
		                            foreach ($FlightDetails as $key => $FlightDetail) {
		                            	//echo '<pre>';print_r($FlightDetail);
		                            	$FlightDetail_Attr =  $FlightDetail['@attributes'];										
										$FlightDetail_Key = $FlightDetail_Attr['Key'];
										$fs[$i][$mode]['segments'][$jk]['FlightDetail_Key'] = $FlightDetail_Key;
										if($FlightDetail_Key == $FlightDetailsRef_Key){
											//$Equipment = $FlightDetails_attr['Equipment'];													
											$OriginTerminal = '';$DestinationTerminal = '';
											if(isset($FlightDetail_Attr['OriginTerminal'])){
												$OriginTerminal = $FlightDetail_Attr['OriginTerminal'];
											}
											if(isset($FlightDetail_Attr['DestinationTerminal'])){
												$DestinationTerminal = $FlightDetail_Attr['DestinationTerminal'];	
											}
											$fs[$i][$mode]['segments'][$jk]['OriginTerminal'] = $OriginTerminal;
											$fs[$i][$mode]['segments'][$jk]['DestinationTerminal'] = $DestinationTerminal;
											break;
										}
										//die;
		                            }
		                            break;
								}
							}
							if(!isset($OriginTerminal)){
							$OriginTerminal='';
							}
							if(!isset($DestinationTerminal)){
								$DestinationTerminal='';
							}
							$fs[$i][$mode]['segments'][$jk]['OriginTerminal'] = $OriginTerminal;
							$fs[$i][$mode]['segments'][$jk]['DestinationTerminal'] = $DestinationTerminal;
							//echo '<pre>';print_r($BookingInfo);die;
							$BookingInfo_Attr = $BookingInfo[$jk]['@attributes'];
							/*$fs[$i][$mode]['segments'][$jk]['BookingCode'] = $BookingCode = $BookingInfo_Attr['BookingCode'];
							$fs[$i][$mode]['segments'][$jk]['CabinClass'] = $CabinClass = $BookingInfo_Attr['CabinClass'];
							$fs[$i][$mode]['segments'][$jk]['FareInfoRef'] = $FareInfoRef = $BookingInfo_Attr['FareInfoRef'];*/
							
 									$AirBookingInfo=$AirPricingInfo['air:BookingInfo'];
                        foreach ($AirBookingInfo as $key => $BookingInfo_eachArr) {
                        	if(array_key_exists(0, $AirBookingInfo)){
								$BookingInfo_Attrs=$BookingInfo_eachArr['@attributes'];
								}else{
								$BookingInfo_Attrs=$BookingInfo_eachArr;
								}
                               if($AirSegment_Key==$BookingInfo_Attrs['SegmentRef']){
                            $fs[$i][$mode]['segments'][$jk]['BookingCode'] = $BookingCode = $BookingInfo_Attrs['BookingCode'];
                            $fs[$i][$mode]['segments'][$jk]['CabinClass'] = $CabinClass = $BookingInfo_Attrs['CabinClass'];
                            $fs[$i][$mode]['segments'][$jk]['FareInfoRef'] = $FareInfoRef = $BookingInfo_Attrs['FareInfoRef'];
                            }
                        }

							$Farerulesref_Key=array();$Farerulesref_Provider=array();$Farerulesref_content=array();
						foreach ($FareInfos as $key => $FareInfoses) {

	    					if(isset($FareInfoses['air:FareRuleKey'])){
	    					$faredetails=$FareInfoses['air:FareRuleKey'];
								 $FareInfos_Attr =  $faredetails['@attributes'];
								 //echo '<pre>';print_r($AirPricingSolution);die;
								  	$FareInfoRef_key =  $FareInfos_Attr['FareInfoRef'];	
								    $FareInfoRef_provider =  $FareInfos_Attr['ProviderCode'];											
									$farecontent = $faredetails['@content'];
								 if($FareInfoRef==$FareInfoRef_key){
								  
									$Farerulesref_Key[]=$FareInfoRef_key;
									$Farerulesref_Provider[]=$FareInfoRef_provider;
									$Farerulesref_content[]=$farecontent;
									$fs[$i][$mode]['segments'][$jk]['Farerulesref_Key'] =  $FareInfoRef_key;
									$fs[$i][$mode]['segments'][$jk]['Farerulesref_Provider'] =  $FareInfoRef_provider;
									$fs[$i][$mode]['segments'][$jk]['Farerulesref_content'] =  $farecontent;
									}
							}else{
							$faredetails=$FareInfos['air:FareRuleKey'];
								 $FareInfos_Attr =  $faredetails['@attributes'];
								 //echo '<pre>';print_r($AirPricingSolution);die;
								   $FareInfoRef_key =  $FareInfos_Attr['FareInfoRef'];	
								    $FareInfoRef_provider =  $FareInfos_Attr['ProviderCode'];											
									$farecontent = $faredetails['@content'];
									if($FareInfoRef==$FareInfoRef_key){
								  
									$Farerulesref_Key[]=$FareInfoRef_key;
									$Farerulesref_Provider[]=$FareInfoRef_provider;
									$Farerulesref_content[]=$farecontent;
									$fs[$i][$mode]['segments'][$jk]['Farerulesref_Key'] =  $FareInfoRef_key;
									$fs[$i][$mode]['segments'][$jk]['Farerulesref_Provider'] =  $FareInfoRef_provider;
									$fs[$i][$mode]['segments'][$jk]['Farerulesref_content'] =  $farecontent;
									}
									

								}
								
						}
									
									$fs[$i]['Farerulesref_Key'][]=$Farerulesref_Key;
									$fs[$i]['Farerulesref_Provider'][]=$Farerulesref_Provider;
									$fs[$i]['Farerulesref_content'][]=$Farerulesref_content;


							if(isset($BookingInfo_Attr['HostTokenRef'])){
						$fs[$i][$mode]['segments'][$jk]['HostTokenRef']  = $BookingInfo_Attr['HostTokenRef'];
						foreach ($HostTokenLists as $key => $HostTokenList) {
								if(isset($HostTokenList['@attributes'])){
						$HostTokenList_Attr = $HostTokenList['@attributes'];
						//print_r($HostTokenList_Attr);
						$HostTokencontent = $HostTokenList['@content'];
						if($HostTokenList_Attr['Key']==$BookingInfo_Attr['HostTokenRef']){
						$fs[$i][$mode]['segments'][$jk]['HostTokencontent'] = $HostTokencontent;
						}
					}
						}
						}
						
						foreach ($FareBasis as $key => $FareBasiss) {
								$FareBasiss_Attr =$FareBasiss['@attributes'];
								if($FareBasiss_Attr['Key']==$BookingInfo_Attr['FareInfoRef']){
								 $fs[$i][$mode]['segments'][$jk]['FareBasis']=$FareBasiss_Attr['FareBasis'];
							}
							}
							
							$Stops;
							$Stops++;
						}
					}else{
						$AirSegmentRef_Attr = $AirSegmentRef['@attributes'];									
						$AirSegmentRef_Key = $AirSegmentRef_Attr['Key'];
						$AirSegments = $AirSegment;
						foreach ($AirSegment as $key => $AirSegmentt) {
							$AirSegment_Attr =  $AirSegmentt['@attributes'];										
							$AirSegment_Key = $AirSegment_Attr['Key'];
							if($AirSegment_Key == $AirSegmentRef_Key){
								$fs[$i][$mode]['segments'][0]['AirSegment_Key'] = $AirSegment_Key;
								$fs[$i][$mode]['segments'][0]['Group'] = $Group = $AirSegment_Attr['Group'];									
								$fs[$i][$mode]['segments'][0]['Carrier'] = $Carrier = $AirSegment_Attr['Carrier'];
								$fs[$i][$mode]['segments'][0]['FlightNumber'] = $FlightNumber = $AirSegment_Attr['FlightNumber'];
								$fs[$i][$mode]['segments'][0]['Origin'] = $Origin = $AirSegment_Attr['Origin'];
								$fs[$i][$mode]['segments'][0]['Destination'] = $Destination = $AirSegment_Attr['Destination'];
								$fs[$i][$mode]['segments'][0]['DepartureTime'] = $DepartureTime = $AirSegment_Attr['DepartureTime'];
								$fs[$i][$mode]['segments'][0]['ArrivalTime'] = $ArrivalTime = $AirSegment_Attr['ArrivalTime'];
								$fs[$i][$mode]['segments'][0]['FlightTime'] = $FlightTime = isset($AirSegment_Attr['FlightTime'])?$AirSegment_Attr['FlightTime']:'';
								if(isset($AirSegment_Attr['APISRequirementsRef'])){
							$fs[$i][$mode]['segments'][0]['APISRequirementsRef']  = $AirSegment_Attr['APISRequirementsRef'];
							}

							if(isset($AirSegment_Attr['AvailabilityDisplayType'])){
							$fs[$i][$mode]['segments'][0]['AvailabilityDisplayType'] =  $AirSegment_Attr['AvailabilityDisplayType'];
							}
								if(isset($AirSegment_Attr['SupplierCode'])){
									$fs[$i][$mode]['segments'][0]['SupplierCode'] =  $AirSegment_Attr['SupplierCode'];
									}
									if(isset($AirSegment_Attr['Status'])){
									$fs[$i][$mode]['segments'][0]['Status'] =  $AirSegment_Attr['Status'];
									}
									if(isset($AirSegment_Attr['Distance'])){
								$fs[$i][$mode]['segments'][0]['Distance'] = $Distance = $AirSegment_Attr['Distance'];
							}
								if(isset($AirSegment_Attr['ETicketability'])){
								$fs[$i][$mode]['segments'][0]['ETicketability'] = $ETicketability = $AirSegment_Attr['ETicketability'];
							}
									if(isset($AirSegment_Attr['Equipment'])){
								$fs[$i][$mode]['segments'][0]['Equipment'] = $Equipment = $AirSegment_Attr['Equipment'];
							}
								$fs[$i][$mode]['segments'][0]['ChangeOfPlane'] = $ChangeOfPlane = $AirSegment_Attr['ChangeOfPlane'];
								if(isset($AirSegment_Attr['ParticipantLevel'])){
								$fs[$i][$mode]['segments'][0]['ParticipantLevel'] = $ParticipantLevel = $AirSegment_Attr['ParticipantLevel'];
								}
								$LinkAvailability = '';
								if(isset($AirSegment_Attr['LinkAvailability'])){
									$fs[$i][$mode]['segments'][0]['LinkAvailability'] = $LinkAvailability = $AirSegment_Attr['LinkAvailability'];
								}
								if(isset($AirSegment_Attr['PolledAvailabilityOption'])){
								$fs[$i][$mode]['segments'][0]['PolledAvailabilityOption'] = $PolledAvailabilityOption = $AirSegment_Attr['PolledAvailabilityOption'];
								}
								$fs[$i][$mode]['segments'][0]['OptionalServicesIndicator'] = $OptionalServicesIndicator = $AirSegment_Attr['OptionalServicesIndicator'];
								
								$AvailabilitySource = '';
								if(isset($AirSegment_Attr['AvailabilitySource'])){	
									$fs[$i][$mode]['segments'][0]['AvailabilitySource'] = $AvailabilitySource = $AirSegment_Attr['AvailabilitySource'];
								}
								$OperatingCarrier='';
								if(isset($AirSegmentt['air:CodeshareInfo']) && is_array($AirSegmentt['air:CodeshareInfo'])){
									$CodeshareInfo_Attr =  $AirSegmentt['air:CodeshareInfo']['@attributes'];
									if(isset($CodeshareInfo_Attr['OperatingCarrier'])) {	
									$OperatingCarrier = $CodeshareInfo_Attr['OperatingCarrier'];	
											}
									$OperatingFlightNumber = '';
									if(isset($CodeshareInfo_Attr['OperatingFlightNumber'])){	
										$OperatingFlightNumber = $CodeshareInfo_Attr['OperatingFlightNumber'];		
									}
								}else if(isset($AirSegmentt['air:CodeshareInfo'])){
									$OperatingCarrier = $AirSegmentt['air:CodeshareInfo'];
									$OperatingFlightNumber = '';
								}else{
									$OperatingCarrier = '';
									$OperatingFlightNumber = '';
								}
								$fs[$i][$mode]['segments'][0]['OperatingCarrier'] = $OperatingCarrier;
								$fs[$i][$mode]['segments'][0]['OperatingFlightNumber'] = $OperatingFlightNumber;
								$ProviderCode = '';$BookingCounts = '';
								if(isset($AirSegmentt['air:AirAvailInfo'])){
									$ProviderCode = $AirSegmentt['air:AirAvailInfo']['@attributes']['ProviderCode'];
									
									$BookingCodeInfo_Attr =  $AirSegmentt['air:AirAvailInfo']['air:BookingCodeInfo']['@attributes'];	
									$BookingCounts = $BookingCodeInfo_Attr['BookingCounts'];											
								}
								
								$fs[$i][$mode]['segments'][0]['ProviderCode'] = $ProviderCode;
								$fs[$i][$mode]['segments'][0]['BookingCounts'] = $BookingCounts;
								if(isset($AirSegmentt['air:FlightDetailsRef']['@attributes'])){
									$FlightDetailsRef_Key =  $AirSegmentt['air:FlightDetailsRef']['@attributes']['Key'];	
								}else{
	                                $FlightDetailsRef_Key ='';
	                            }
	                            foreach ($FlightDetails as $key => $FlightDetail) {
	                            	$FlightDetail_Attr =  $FlightDetail['@attributes'];										
									$fs[$i][$mode]['segments'][0]['FlightDetail_Key'] = $FlightDetail_Key = $FlightDetail_Attr['Key'];
									if($FlightDetail_Key == $FlightDetailsRef_Key){
										//$Equipment = $FlightDetails_attr['Equipment'];													
										$OriginTerminal = '';$DestinationTerminal = '';
										if(isset($FlightDetail_Attr['OriginTerminal'])){
											$OriginTerminal = $FlightDetail_Attr['OriginTerminal'];
										}
										if(isset($FlightDetail_Attr['DestinationTerminal'])){
											$DestinationTerminal = $FlightDetail_Attr['DestinationTerminal'];	
										}
										$fs[$i][$mode]['segments'][0]['OriginTerminal'] = $OriginTerminal;
										$fs[$i][$mode]['segments'][0]['DestinationTerminal'] = $DestinationTerminal;
										break;
									}
	                            }
	                            break;
							}
						}
						
						//echo '<pre>';print_r($BookingInfo);die;
						$BookingInfo_Attr = $BookingInfo[$j]['@attributes'];
						/*$fs[$i][$mode]['segments'][0]['BookingCode'] = $BookingCode = $BookingInfo_Attr['BookingCode'];
						$fs[$i][$mode]['segments'][0]['CabinClass'] = $CabinClass = $BookingInfo_Attr['CabinClass'];
						$fs[$i][$mode]['segments'][0]['FareInfoRef'] = $FareInfoRef = $BookingInfo_Attr['FareInfoRef'];*/
						$AirBookingInfo=$AirPricingInfo['air:BookingInfo'];
						foreach ($AirBookingInfo as $key => $BookingInfo_eachArr) {

							if(array_key_exists(0, $AirBookingInfo)){
								
								$BookingInfo_Attrs=$BookingInfo_eachArr['@attributes'];
								}else{
								$BookingInfo_Attrs=$BookingInfo_eachArr;
								
								}
                               if($AirSegment_Key==$BookingInfo_Attrs['SegmentRef']){
                            $fs[$i][$mode]['segments'][0]['BookingCode'] = $BookingCode = $BookingInfo_Attrs['BookingCode'];
                            $fs[$i][$mode]['segments'][0]['CabinClass'] = $CabinClass = $BookingInfo_Attrs['CabinClass'];
                            $fs[$i][$mode]['segments'][0]['FareInfoRef'] = $FareInfoRef = $BookingInfo_Attrs['FareInfoRef'];
                            }
                        }
						$fs[$i]['CabinClass'] = $CabinClass;
						$Farerulesref_Key=array();$Farerulesref_Provider=array();$Farerulesref_content=array();
						foreach ($FareInfos as $key => $FareInfoses) {

	    					if(isset($FareInfoses['air:FareRuleKey'])){
	    					$faredetails=$FareInfoses['air:FareRuleKey'];
								 $FareInfos_Attr =  $faredetails['@attributes'];
								 //echo '<pre>';print_r($AirPricingSolution);die;
								  	$FareInfoRef_key =  $FareInfos_Attr['FareInfoRef'];	
								    $FareInfoRef_provider =  $FareInfos_Attr['ProviderCode'];											
									$farecontent = $faredetails['@content'];
								 if($FareInfoRef==$FareInfoRef_key){
								  
									$Farerulesref_Key[]=$FareInfoRef_key;
									$Farerulesref_Provider[]=$FareInfoRef_provider;
									$Farerulesref_content[]=$farecontent;
									$fs[$i][$mode]['segments'][0]['Farerulesref_Key'] =  $FareInfoRef_key;
									$fs[$i][$mode]['segments'][0]['Farerulesref_Provider'] =  $FareInfoRef_provider;
									$fs[$i][$mode]['segments'][0]['Farerulesref_content'] =  $farecontent;
									}
							}else{
							$faredetails=$FareInfos['air:FareRuleKey'];
								 $FareInfos_Attr =  $faredetails['@attributes'];
								 //echo '<pre>';print_r($AirPricingSolution);die;
								   $FareInfoRef_key =  $FareInfos_Attr['FareInfoRef'];	
								    $FareInfoRef_provider =  $FareInfos_Attr['ProviderCode'];											
									$farecontent = $faredetails['@content'];
									if($FareInfoRef==$FareInfoRef_key){
								  
									$Farerulesref_Key[]=$FareInfoRef_key;
									$Farerulesref_Provider[]=$FareInfoRef_provider;
									$Farerulesref_content[]=$farecontent;
									$fs[$i][$mode]['segments'][0]['Farerulesref_Key'] =  $FareInfoRef_key;
									$fs[$i][$mode]['segments'][0]['Farerulesref_Provider'] =  $FareInfoRef_provider;
									$fs[$i][$mode]['segments'][0]['Farerulesref_content'] =  $farecontent;
									}
									

								}
								
						}
									
									$fs[$i]['Farerulesref_Key'][]=$Farerulesref_Key;
									$fs[$i]['Farerulesref_Provider'][]=$Farerulesref_Provider;
									$fs[$i]['Farerulesref_content'][]=$Farerulesref_content;
						foreach ($FareBasis as $key => $FareBasiss) {
								$FareBasiss_Attr =$FareBasiss['@attributes'];
								if($FareBasiss_Attr['Key']==$BookingInfo_Attr['FareInfoRef']){
								 $fs[$i][$mode]['segments'][0]['FareBasis']=$FareBasiss_Attr['FareBasis'];
							}
								
							}
						if(isset($BookingInfo_Attr['HostTokenRef'])){
						$fs[$i][$mode]['segments'][0]['HostTokenRef']  = $BookingInfo_Attr['HostTokenRef'];
						foreach ($HostTokenLists as $key => $HostTokenList) {
								if(isset($HostTokenList['@attributes'])){
						$HostTokenList_Attr = $HostTokenList['@attributes'];
						//print_r($HostTokenList_Attr);
						$HostTokencontent = $HostTokenList['@content'];
						if($HostTokenList_Attr['Key']==$BookingInfo_Attr['HostTokenRef']){
						$fs[$i][$mode]['segments'][0]['HostTokencontent'] = $HostTokencontent;
						}
					}
						}
					}
					}
	    			$j++;
	    		}
	    	}else{
	    		//echo 'oneway';
	    		$Journey_Attr = $Journey['@attributes'];
				$TravelTime = $Journey_Attr['TravelTime'];
				$fs[$i]['TravelTime'] = $TravelTime;
				$Stops = 0;
				$AirSegmentRefs = $Journey['air:AirSegmentRef'];
				if(isset($Journey['air:AirSegmentRef'][0])){
					foreach ($AirSegmentRefs as $jk => $AirSegmentRef) {
						$AirSegmentRef_Attr = $AirSegmentRef['@attributes'];									
						$AirSegmentRef_Key = $AirSegmentRef_Attr['Key'];
						$AirSegments = $AirSegment;

						foreach ($AirSegments as $key => $AirSegmentt) {
							
							$AirSegment_Attr =  $AirSegmentt['@attributes'];
								
							//echo '<pre>';print_r($AirSegmentt);die;
																	
							$AirSegment_Key = $AirSegment_Attr['Key'];
							$fs[$i]['AirSegment_Key'] = $AirSegment_Key;
							if($AirSegment_Key == $AirSegmentRef_Key){
								// /echo 'hi';die;
								$fs[$i]['segments'][$jk]['AirSegment_Key'] = $AirSegment_Key;
								$fs[$i]['segments'][$jk]['Group'] = $Group = $AirSegment_Attr['Group'];									
								$fs[$i]['segments'][$jk]['Carrier'] = $Carrier = $AirSegment_Attr['Carrier'];
								$fs[$i]['segments'][$jk]['FlightNumber'] = $FlightNumber = $AirSegment_Attr['FlightNumber'];
								$fs[$i]['segments'][$jk]['Origin'] = $Origin = $AirSegment_Attr['Origin'];
								$fs[$i]['segments'][$jk]['Destination'] = $Destination = $AirSegment_Attr['Destination'];
								$fs[$i]['segments'][$jk]['DepartureTime'] = $DepartureTime = $AirSegment_Attr['DepartureTime'];
								$fs[$i]['segments'][$jk]['ArrivalTime'] = $ArrivalTime = $AirSegment_Attr['ArrivalTime'];
								$fs[$i]['segments'][$jk]['FlightTime'] = $FlightTime = $AirSegment_Attr['FlightTime'];
								$fs[$i]['segments'][$jk]['Distance'] = $Distance = isset($AirSegment_Attr['Distance'])?$AirSegment_Attr['Distance']:'';
								$fs[$i]['segments'][$jk]['ETicketability'] = $ETicketability = isset($AirSegment_Attr['ETicketability'])?$AirSegment_Attr['ETicketability']:'';
								$fs[$i]['segments'][$jk]['Equipment'] = $Equipment = $AirSegment_Attr['Equipment'];
								$fs[$i]['segments'][$jk]['ChangeOfPlane'] = $ChangeOfPlane = $AirSegment_Attr['ChangeOfPlane'];
								$ParticipantLevel='';
								if(isset($AirSegment_Attr['ParticipantLevel'])){
								$fs[$i]['segments'][$jk]['ParticipantLevel'] = $ParticipantLevel = isset($AirSegment_Attr['ParticipantLevel'])?$AirSegment_Attr['ParticipantLevel']:'';
							}
								if(isset($AirSegment_Attr['APISRequirementsRef'])){
							$fs[$i]['segments'][$jk]['APISRequirementsRef']  = $AirSegment_Attr['APISRequirementsRef'];
							}

							if(isset($AirSegment_Attr['AvailabilityDisplayType'])){
							$fs[$i]['segments'][$jk]['AvailabilityDisplayType'] =  $AirSegment_Attr['AvailabilityDisplayType'];
							}
								if(isset($AirSegment_Attr['SupplierCode'])){
									$fs[$i]['segments'][$jk]['SupplierCode']  = $AirSegment_Attr['SupplierCode'];
									}
									if(isset($AirSegment_Attr['Status'])){
									$fs[$i]['segments'][$jk]['Status']  = $AirSegment_Attr['Status'];
									}

								$LinkAvailability = '';
								if(isset($AirSegment_Attr['LinkAvailability'])){
									$LinkAvailability = $AirSegment_Attr['LinkAvailability'];
								}
								$fs[$i]['segments'][$jk]['LinkAvailability'] = $LinkAvailability;
								$PolledAvailabilityOption='';
								if(isset($AirSegment_Attr['PolledAvailabilityOption'])){
								$fs[$i]['segments'][$jk]['PolledAvailabilityOption'] = $PolledAvailabilityOption = $AirSegment_Attr['PolledAvailabilityOption'];
								}

								$fs[$i]['segments'][$jk]['OptionalServicesIndicator'] = $OptionalServicesIndicator = isset($AirSegment_Attr['OptionalServicesIndicator'])?$AirSegment_Attr['OptionalServicesIndicator']:'';
								$AvailabilitySource = '';
								if(isset($AirSegment_Attr['AvailabilitySource'])){	
									$AvailabilitySource = $AirSegment_Attr['AvailabilitySource'];
								}
								$fs[$i]['segments'][$jk]['AvailabilitySource'] = $AvailabilitySource;
								if(isset($AirSegment['air:CodeshareInfo']) && is_array($AirSegment['air:CodeshareInfo'])){
									$CodeshareInfo_Attr =  $AirSegment['air:CodeshareInfo']['@attributes'];	
									$OperatingCarrier = $CodeshareInfo_Attr['OperatingCarrier'];	

									$OperatingFlightNumber = '';
									if(isset($CodeshareInfo_Attr['OperatingFlightNumber'])){	
										$OperatingFlightNumber = $CodeshareInfo_Attr['OperatingFlightNumber'];		
									}
								}else if(isset($AirSegment['air:CodeshareInfo'])){
									$OperatingCarrier = $AirSegment['air:CodeshareInfo'];
									$OperatingFlightNumber = '';
								}else{
									$OperatingCarrier = '';
									$OperatingFlightNumber = '';
								}
								$fs[$i]['segments'][$jk]['OperatingCarrier'] = $OperatingCarrier;
								$fs[$i]['segments'][$jk]['OperatingFlightNumber'] = $OperatingFlightNumber;
								$ProviderCode = '';$BookingCounts = '';
								
								if(isset($AirSegmentt['air:AirAvailInfo'])){
									$ProviderCode = $AirSegmentt['air:AirAvailInfo']['@attributes']['ProviderCode'];
									$BookingCodeInfo_Attr =  $AirSegmentt['air:AirAvailInfo']['air:BookingCodeInfo']['@attributes'];	
									$BookingCounts = $BookingCodeInfo_Attr['BookingCounts'];
								}
								
								$fs[$i]['segments'][$jk]['ProviderCode'] = $ProviderCode;
								$fs[$i]['segments'][$jk]['BookingCounts'] = $BookingCounts;
								if(isset($AirSegmentt['air:FlightDetailsRef']['@attributes'])){
									$FlightDetailsRef_Key =  $AirSegmentt['air:FlightDetailsRef']['@attributes']['Key'];	
								}else{
	                                $FlightDetailsRef_Key ='';
	                            }
	                            foreach ($FlightDetails as $key => $FlightDetail) {
	                            	//echo '<pre>';print_r($FlightDetail);
	                            	$FlightDetail_Attr =  $FlightDetail['@attributes'];										
									$FlightDetail_Key = $FlightDetail_Attr['Key'];
									$fs[$i]['segments'][$jk]['FlightDetail_Key'] = $FlightDetail_Key;
									if($FlightDetail_Key == $FlightDetailsRef_Key){
										//$Equipment = $FlightDetails_attr['Equipment'];													
										$OriginTerminal = '';$DestinationTerminal = '';
										if(isset($FlightDetail_Attr['OriginTerminal'])){
											$OriginTerminal = $FlightDetail_Attr['OriginTerminal'];
										}
										if(isset($FlightDetail_Attr['DestinationTerminal'])){
											$DestinationTerminal = $FlightDetail_Attr['DestinationTerminal'];	
										}
										$fs[$i]['segments'][$jk]['OriginTerminal'] = $OriginTerminal;
										$fs[$i]['segments'][$jk]['DestinationTerminal'] = $DestinationTerminal;
										break;
									}
									//die;
	                            }
	                            break;
	                        }
						}
						if(!isset($OriginTerminal)){
							$OriginTerminal='';
						}
						if(!isset($DestinationTerminal)){
							$DestinationTerminal='';
						}
						$fs[$i]['segments'][$jk]['OriginTerminal'] = $OriginTerminal;
						$fs[$i]['segments'][$jk]['DestinationTerminal'] = $DestinationTerminal;
						
						$BookingInfo_Attr = $BookingInfo[$jk]['@attributes'];
						 $AirBookingInfo=$AirPricingInfo['air:BookingInfo'];
                        foreach ($AirBookingInfo as $key => $BookingInfo_eachArr) {

								if(array_key_exists(0, $AirBookingInfo)){
								
								$BookingInfo_Attrs=$BookingInfo_eachArr['@attributes'];
								}else{
								$BookingInfo_Attrs=$BookingInfo_eachArr;
								
								}
                        	
                               if($AirSegment_Key==$BookingInfo_Attrs['SegmentRef']){
                            $fs[$i]['segments'][$jk]['BookingCode'] = $BookingCode = $BookingInfo_Attrs['BookingCode'];
                            $fs[$i]['segments'][$jk]['CabinClass'] = $CabinClass = $BookingInfo_Attrs['CabinClass'];
                            $fs[$i]['segments'][$jk]['FareInfoRef'] = $FareInfoRef = $BookingInfo_Attrs['FareInfoRef'];
                            }
                        }
						/*$fs[$i]['segments'][$jk]['BookingCode'] = $BookingCode = $BookingInfo_Attr['BookingCode'];
						$fs[$i]['segments'][$jk]['CabinClass'] = $CabinClass = $BookingInfo_Attr['CabinClass'];
						$fs[$i]['segments'][$jk]['FareInfoRef'] = $FareInfoRef = $BookingInfo_Attr['FareInfoRef'];*/

$Farerulesref_Key=array();$Farerulesref_Provider=array();$Farerulesref_content=array();
						foreach ($FareInfos as $key => $FareInfoses) {

	    					if(isset($FareInfoses['air:FareRuleKey'])){
	    					$faredetails=$FareInfoses['air:FareRuleKey'];
								 $FareInfos_Attr =  $faredetails['@attributes'];
								 //echo '<pre>';print_r($AirPricingSolution);die;
								  	$FareInfoRef_key =  $FareInfos_Attr['FareInfoRef'];	
								    $FareInfoRef_provider =  $FareInfos_Attr['ProviderCode'];											
									$farecontent = $faredetails['@content'];
								 if($FareInfoRef==$FareInfoRef_key){
								  
									$Farerulesref_Key[]=$FareInfoRef_key;
									$Farerulesref_Provider[]=$FareInfoRef_provider;
									$Farerulesref_content[]=$farecontent;
									$fs[$i]['segments'][$jk]['Farerulesref_Key'] =  $FareInfoRef_key;
									$fs[$i]['segments'][$jk]['Farerulesref_Provider'] =  $FareInfoRef_provider;
									$fs[$i]['segments'][$jk]['Farerulesref_content'] =  $farecontent;
									}
							}else{
							$faredetails=$FareInfos['air:FareRuleKey'];
								 $FareInfos_Attr =  $faredetails['@attributes'];
								 //echo '<pre>';print_r($AirPricingSolution);die;
								   $FareInfoRef_key =  $FareInfos_Attr['FareInfoRef'];	
								    $FareInfoRef_provider =  $FareInfos_Attr['ProviderCode'];											
									$farecontent = $faredetails['@content'];
									if($FareInfoRef==$FareInfoRef_key){
								  
									$Farerulesref_Key[]=$FareInfoRef_key;
									$Farerulesref_Provider[]=$FareInfoRef_provider;
									$Farerulesref_content[]=$farecontent;
									$fs[$i]['segments'][$jk]['Farerulesref_Key'] =  $FareInfoRef_key;
									$fs[$i]['segments'][$jk]['Farerulesref_Provider'] =  $FareInfoRef_provider;
									$fs[$i]['segments'][$jk]['Farerulesref_content'] =  $farecontent;
									}
									

								}
								
						}
									
									$fs[$i]['Farerulesref_Key'][]=$Farerulesref_Key;
									$fs[$i]['Farerulesref_Provider'][]=$Farerulesref_Provider;
									$fs[$i]['Farerulesref_content'][]=$Farerulesref_content;


						foreach ($FareBasis as $key => $FareBasiss) {
							if(isset($FareBasiss['@attributes'])){
								$FareBasiss_Attr =$FareBasiss['@attributes'];
							
							}else{
								$FareBasiss_Attr =$FareBasis['@attributes'];
							}
								if(isset($FareBasiss_Attr['Key']) && $FareBasiss_Attr['Key']==$BookingInfo_Attr['FareInfoRef']){
								 $fs[$i]['segments'][$jk]['FareBasis']=$FareBasiss_Attr['FareBasis'];
								}
								
							}
						if(isset($BookingInfo_Attr['HostTokenRef'])){
						$fs[$i]['segments'][$jk]['HostTokenRef']  = $BookingInfo_Attr['HostTokenRef'];
						foreach ($HostTokenLists as $key => $HostTokenList) {
								if(isset($HostTokenList['@attributes'])){
						$HostTokenList_Attr = $HostTokenList['@attributes'];
						//print_r($HostTokenList_Attr);
						$HostTokencontent = $HostTokenList['@content'];
						if($HostTokenList_Attr['Key']==$BookingInfo_Attr['HostTokenRef']){
						$fs[$i]['segments'][$jk]['HostTokencontent'] = $HostTokencontent;
						}
					}
						}
					}
						$Stops;
						$Stops++;
					}
				}else{
					
					//echo 'hello';
					//echo '<pre>';print_r($Journey['air:AirSegmentRef']);die;
					$AirSegmentRefss = $Journey['air:AirSegmentRef'];
					$AirSegmentRef_Attr = $AirSegmentRefss['@attributes'];									
					$AirSegmentRef_Key = $AirSegmentRef_Attr['Key'];
					$AirSegments = $AirSegment;
					
					
						
					foreach ($AirSegments as $key => $AirSegmentt) {
						$AirSegment_Attr =  isset($AirSegmentt['@attributes'])?$AirSegmentt['@attributes']:'';
						//echo '<pre>';print_r($AirSegment_Attr);die;										
						$AirSegment_Key = isset($AirSegment_Attr['Key'])?$AirSegment_Attr['Key']:'';
						$fs[$i]['AirSegment_Key'] = $AirSegment_Key;
						if($AirSegment_Key == $AirSegmentRef_Key){
							$fs[$i]['segments'][0]['AirSegment_Key'] = $AirSegment_Key;
							$fs[$i]['segments'][0]['Group'] = $Group = $AirSegment_Attr['Group'];									
							$fs[$i]['segments'][0]['Carrier'] = $Carrier = $AirSegment_Attr['Carrier'];
							$fs[$i]['segments'][0]['FlightNumber'] = $FlightNumber = $AirSegment_Attr['FlightNumber'];
							$fs[$i]['segments'][0]['Origin'] = $Origin = $AirSegment_Attr['Origin'];
							$fs[$i]['segments'][0]['Destination'] = $Destination = $AirSegment_Attr['Destination'];
							$fs[$i]['segments'][0]['DepartureTime'] = $DepartureTime = $AirSegment_Attr['DepartureTime'];
							$fs[$i]['segments'][0]['ArrivalTime'] = $ArrivalTime = $AirSegment_Attr['ArrivalTime'];
							$fs[$i]['segments'][0]['FlightTime'] = $FlightTime = $AirSegment_Attr['FlightTime'];


							if(isset($AirSegment_Attr['APISRequirementsRef'])){
							$fs[$i]['segments'][0]['APISRequirementsRef']  = $AirSegment_Attr['APISRequirementsRef'];
							}

							if(isset($AirSegment_Attr['AvailabilityDisplayType'])){
							$fs[$i]['segments'][0]['AvailabilityDisplayType'] =  $AirSegment_Attr['AvailabilityDisplayType'];
							}

									if(isset($AirSegment_Attr['SupplierCode'])){
									$fs[$i]['segments'][0]['SupplierCode'] = $AirSegment_Attr['SupplierCode'];
									}
									if(isset($AirSegment_Attr['Status'])){
									$fs[$i]['segments'][0]['Status'] =  $AirSegment_Attr['Status'];
									}
							if(isset($AirSegment_Attr['Distance'])){
							$fs[$i]['segments'][0]['Distance'] = $Distance = $AirSegment_Attr['Distance'];
						}
						if(isset($AirSegment_Attr['ETicketability'])){
							$fs[$i]['segments'][0]['ETicketability'] = $ETicketability = $AirSegment_Attr['ETicketability'];
						}
							if(isset($AirSegment_Attr['Equipment'])){
							$fs[$i]['segments'][0]['Equipment'] = $Equipment = $AirSegment_Attr['Equipment'];
						}
							$fs[$i]['segments'][0]['ChangeOfPlane'] = $ChangeOfPlane = $AirSegment_Attr['ChangeOfPlane'];
							if(isset($AirSegment_Attr['ParticipantLevel'])){
							$fs[$i]['segments'][0]['ParticipantLevel'] = $ParticipantLevel = $AirSegment_Attr['ParticipantLevel'];
}
							$LinkAvailability = '';
							if(isset($AirSegment_Attr['LinkAvailability'])){
								$fs[$i]['segments'][0]['LinkAvailability'] = $LinkAvailability = $AirSegment_Attr['LinkAvailability'];
							}
						if(isset($AirSegment_Attr['PolledAvailabilityOption'])){
							$fs[$i]['segments'][0]['PolledAvailabilityOption'] = $PolledAvailabilityOption = $AirSegment_Attr['PolledAvailabilityOption'];
						}
							$fs[$i]['segments'][0]['OptionalServicesIndicator'] = $OptionalServicesIndicator = $AirSegment_Attr['OptionalServicesIndicator'];
							
							$AvailabilitySource = '';
							if(isset($AirSegment_Attr['AvailabilitySource'])){	
								$fs[$i]['segments'][0]['AvailabilitySource'] = $AvailabilitySource = $AirSegment_Attr['AvailabilitySource'];
							}
							$OperatingCarrier='';
							if(isset($AirSegmentt['air:CodeshareInfo']) && is_array($AirSegmentt['air:CodeshareInfo'])){
								$CodeshareInfo_Attr =  $AirSegmentt['air:CodeshareInfo']['@attributes'];	
									if(isset($CodeshareInfo_Attr['OperatingCarrier'])) {
								$OperatingCarrier = $CodeshareInfo_Attr['OperatingCarrier'];
								}	

								$OperatingFlightNumber = '';
								if(isset($CodeshareInfo_Attr['OperatingFlightNumber'])){	
									$OperatingFlightNumber = $CodeshareInfo_Attr['OperatingFlightNumber'];		
								}
							}else if(isset($AirSegmentt['air:CodeshareInfo'])){
								$OperatingCarrier = $AirSegmentt['air:CodeshareInfo'];
								$OperatingFlightNumber = '';
							}else{
								$OperatingCarrier = '';
								$OperatingFlightNumber = '';
							}
							$fs[$i]['segments'][0]['OperatingCarrier'] = $OperatingCarrier;
							$fs[$i]['segments'][0]['OperatingFlightNumber'] = $OperatingFlightNumber;
							$ProviderCode = '';$BookingCounts = '';
							if(isset($AirSegmentt['air:AirAvailInfo'])){
								$ProviderCode = $AirSegmentt['air:AirAvailInfo']['@attributes']['ProviderCode'];
								
								$BookingCodeInfo_Attr =  $AirSegmentt['air:AirAvailInfo']['air:BookingCodeInfo']['@attributes'];	
								$BookingCounts = $BookingCodeInfo_Attr['BookingCounts'];											
							}
							
							$fs[$i]['segments'][0]['ProviderCode'] = $ProviderCode;
							$fs[$i]['segments'][0]['BookingCounts'] = $BookingCounts;
							if(isset($AirSegmentt['air:FlightDetailsRef']['@attributes'])){
								$FlightDetailsRef_Key =  $AirSegmentt['air:FlightDetailsRef']['@attributes']['Key'];	
							}else{
                                $FlightDetailsRef_Key ='';
                            }
                            foreach ($FlightDetails as $key => $FlightDetail) {
                            	$FlightDetail_Attr =  $FlightDetail['@attributes'];										
								$fs[$i]['segments'][0]['FlightDetail_Key'] = $FlightDetail_Key = $FlightDetail_Attr['Key'];
								if($FlightDetail_Key == $FlightDetailsRef_Key){
									//$Equipment = $FlightDetails_attr['Equipment'];													
									$OriginTerminal = '';$DestinationTerminal = '';
									if(isset($FlightDetail_Attr['OriginTerminal'])){
										$OriginTerminal = $FlightDetail_Attr['OriginTerminal'];
									}
									if(isset($FlightDetail_Attr['DestinationTerminal'])){
										$DestinationTerminal = $FlightDetail_Attr['DestinationTerminal'];	
									}
									$fs[$i]['segments'][0]['OriginTerminal'] = $OriginTerminal;
									$fs[$i]['segments'][0]['DestinationTerminal'] = $DestinationTerminal;
									break;
								}
                            }
                            break;					
						}
					}
					
					//echo '<pre>';print_r($BookingInfo);die;
					$BookingInfo_Attr = $BookingInfo['@attributes'];
					/*$fs[$i]['segments'][0]['BookingCode'] = $BookingCode = $BookingInfo_Attr['BookingCode'];
					$fs[$i]['segments'][0]['CabinClass'] = $CabinClass = $BookingInfo_Attr['CabinClass'];
					$fs[$i]['segments'][0]['FareInfoRef'] = $FareInfoRef = $BookingInfo_Attr['FareInfoRef'];*/
						$AirBookingInfo=$AirPricingInfo['air:BookingInfo'];
                        foreach ($AirBookingInfo as $key => $BookingInfo_eachArr) {
                        	if(array_key_exists(0, $AirBookingInfo)){
								
								$BookingInfo_Attrs=$BookingInfo_eachArr['@attributes'];
								}else{
								$BookingInfo_Attrs=$BookingInfo_eachArr;
								
								}
                        	//echo $key.'<pre>';print_r($BookingInfo_Attrs);die;
                               if($AirSegment_Key==$BookingInfo_Attrs['SegmentRef']){
                            $fs[$i]['segments'][0]['BookingCode'] = $BookingCode = $BookingInfo_Attrs['BookingCode'];
                            $fs[$i]['segments'][0]['CabinClass'] = $CabinClass = $BookingInfo_Attrs['CabinClass'];
                            $fs[$i]['segments'][0]['FareInfoRef'] = $FareInfoRef = $BookingInfo_Attrs['FareInfoRef'];
                            }
                        }

					$Farerulesref_Key=array();$Farerulesref_Provider=array();$Farerulesref_content=array();
						foreach ($FareInfos as $key => $FareInfoses) {

	    					if(isset($FareInfoses['air:FareRuleKey'])){
	    					$faredetails=$FareInfoses['air:FareRuleKey'];
								 $FareInfos_Attr =  $faredetails['@attributes'];
								 //echo '<pre>';print_r($AirPricingSolution);die;
								  	$FareInfoRef_key =  $FareInfos_Attr['FareInfoRef'];	
								    $FareInfoRef_provider =  $FareInfos_Attr['ProviderCode'];											
									$farecontent = $faredetails['@content'];
								 if($FareInfoRef==$FareInfoRef_key){
								  
									$Farerulesref_Key[]=$FareInfoRef_key;
									$Farerulesref_Provider[]=$FareInfoRef_provider;
									$Farerulesref_content[]=$farecontent;
									$fs[$i]['segments'][0]['Farerulesref_Key'] =  $FareInfoRef_key;
									$fs[$i]['segments'][0]['Farerulesref_Provider'] =  $FareInfoRef_provider;
									$fs[$i]['segments'][0]['Farerulesref_content'] =  $farecontent;
									}
							}else{
							$faredetails=$FareInfos['air:FareRuleKey'];
								 $FareInfos_Attr =  $faredetails['@attributes'];
								 //echo '<pre>';print_r($AirPricingSolution);die;
								   $FareInfoRef_key =  $FareInfos_Attr['FareInfoRef'];	
								    $FareInfoRef_provider =  $FareInfos_Attr['ProviderCode'];											
									$farecontent = $faredetails['@content'];
									if($FareInfoRef==$FareInfoRef_key){
								  
									$Farerulesref_Key[]=$FareInfoRef_key;
									$Farerulesref_Provider[]=$FareInfoRef_provider;
									$Farerulesref_content[]=$farecontent;
									$fs[$i]['segments'][0]['Farerulesref_Key'] =  $FareInfoRef_key;
									$fs[$i]['segments'][0]['Farerulesref_Provider'] =  $FareInfoRef_provider;
									$fs[$i]['segments'][0]['Farerulesref_content'] =  $farecontent;
									}
									

								}
								
						}

									$fs[$i]['Farerulesref_Key'][]=$Farerulesref_Key;
									$fs[$i]['Farerulesref_Provider'][]=$Farerulesref_Provider;
									$fs[$i]['Farerulesref_content'][]=$Farerulesref_content;
									

					if(isset($BookingInfo_Attr['HostTokenRef'])){
						$fs[$i]['segments'][0]['HostTokenRef']  = $BookingInfo_Attr['HostTokenRef'];
						
						foreach ($HostTokenLists as $key => $HostTokenList) {
					if(isset($HostTokenList['@attributes'])){
						$HostTokenList_Attr = $HostTokenList['@attributes'];
						//print_r($HostTokenList_Attr);
						$HostTokencontent = $HostTokenList['@content'];
						if($HostTokenList_Attr['Key']==$BookingInfo_Attr['HostTokenRef']){
						$fs[$i]['segments'][0]['HostTokencontent'] = $HostTokencontent;
							}
						}
						}
						
					}
					
					foreach ($FareBasis as $key => $FareBasiss) {
								$FareBasiss_Attr =$FareBasiss['@attributes'];
								//echo "<pre>";
						//print_r($FareBasiss_Attr);
								if($FareBasiss_Attr['Key']==$BookingInfo_Attr['FareInfoRef']){
								 $fs[$i]['segments'][0]['FareBasis']=$FareBasiss_Attr['FareBasis'];
							}
							}
					
					
				}
	    	}
	    	//die;
	    	$i++;
	    	
	    }
		$fs['more_results']=$more_results;
	 // echo '<pre>';print_r($fs);die;
	    return $fs;
			}else{
			$fs['more_results'] = $more_results;
			//  echo '<pre>';print_r($fs);die;
			 return $fs;
			}
		}
	}



	function formatMultiResponse($LowFareSearchReq_Res, $aMarkup, $myMarkup,$method){

		$LowFareSearchRes = $LowFareSearchReq_Res['LowFareSearchRes'];
		if(empty($LowFareSearchRes)){
	    	return false;
	    }
	    $LowFareSearchRes = $this->xml_to_array->XmlToArray($LowFareSearchRes);
	    //echo '<pre>';print_r($LowFareSearchRes);die;
	    if(isset($LowFareSearchRes['SOAP:Body']['SOAP:Fault'])){
	    	$xml_log = array(
	    		'Api' => 'UAPI',
	    		'XML_Type' => 'Flight',
	    		'XML_Request' => $LowFareSearchReq_Res['LowFareSearchReq'],
	    		'XML_Response' => $LowFareSearchReq_Res['LowFareSearchRes'],
	    		'Ip_address' => $this->input->ip_address(),
	    		'XML_Time' => date('Y-m-d H:i:s')
	    	);
	    	$this->xml_model->insert_xml_log($xml_log);
	    	return false;
	    }
	   if($method=="Asynch"){
			$Search_method="air:LowFareSearchAsynchRsp";
			}elseif($method=="Retrieve"){
				$Search_method="air:RetrieveLowFareSearchRsp";
			}else{
				$Search_method="air:LowFareSearchRsp";
			}
			
			$first_Xml_element=$LowFareSearchRes['SOAP:Body'][$Search_method];

			
		   if(isset($first_Xml_element['@attributes']['CurrencyType'])){
		    $CurrencyType = $first_Xml_element['@attributes']['CurrencyType'];
			}else{
				$CurrencyType=CURR;
			}

			if(isset($first_Xml_element['@attributes']['SearchId'])){
	    $SearchId = $first_Xml_element['@attributes']['SearchId'];
			}else{
				$SearchId='';
			}
	    $FlightDetails = isset($first_Xml_element['air:FlightDetailsList']['air:FlightDetails'])?$first_Xml_element['air:FlightDetailsList']['air:FlightDetails']:'';
	    $AirSegment = isset($first_Xml_element['air:AirSegmentList']['air:AirSegment'])?$first_Xml_element['air:AirSegmentList']['air:AirSegment']:'';
	    $AirPricingSolutions = isset($first_Xml_element['air:AirPricingSolution'])?$first_Xml_element['air:AirPricingSolution']:'';
	    $FareInfos = isset($first_Xml_element['air:FareInfoList']['air:FareInfo'])?$first_Xml_element['air:FareInfoList']['air:FareInfo']:'';
	     $FareBasis = isset($first_Xml_element['air:FareInfoList']['air:FareInfo'])?$first_Xml_element['air:FareInfoList']['air:FareInfo']:'';
	     if(isset($first_Xml_element['air:HostTokenList'])){
	    $HostTokenLists = $first_Xml_element['air:HostTokenList']['common_v33_0:HostToken'];
		}
$AsyncProviderSpecificResponses = isset($first_Xml_element['air:AsyncProviderSpecificResponse'][0])?$first_Xml_element['air:AsyncProviderSpecificResponse']:array(0 =>isset($first_Xml_element['air:AsyncProviderSpecificResponse'])?$first_Xml_element['air:AsyncProviderSpecificResponse']:'');
$more_results=array();


foreach ($AsyncProviderSpecificResponses as $AsyncProviderSpecificResponse) {
	if(isset($AsyncProviderSpecificResponse['@attributes']) && $AsyncProviderSpecificResponse['@attributes']['MoreResults']=="true"){
$more_results=$AsyncProviderSpecificResponse['@attributes'];
}
}
$more_results['SearchId']=$SearchId;
	if(is_array($AirPricingSolutions)){
			$i=0;
	    foreach ($AirPricingSolutions as $key => $AirPricingSolution) {
	    	$Journey = $AirPricingSolution['air:Journey'];
	    	$AirPricingInfo = $AirPricingSolution['air:AirPricingInfo'];	
	    	$AirPricingSolution_Attr = $AirPricingSolution['@attributes'];
	    	$AirPricingSolution_Attr = json_encode($AirPricingSolution_Attr);
	    	$AirPricingSolution_Attr = json_decode($AirPricingSolution_Attr);
	    	
	    	
	    	 $fs[$i]['AirPricingSolution_Key'] = $AirPricingSolution_Attr->Key;
	    	$fs[$i]['CompleteItinerary'] = isset($AirPricingSolution_Attr->CompleteItinerary)?$AirPricingSolution_Attr->CompleteItinerary:'';
	    	  $Connections='';
	    	if(isset($AirPricingSolution['air:Connection'])){
	    		
			$Air_Connections = $AirPricingSolution['air:Connection'];
	    	foreach ($Air_Connections as $air_Connection) {
	    				
	    				if(isset($air_Connection['@attributes'])){
	    				
	    					$Connections.=$air_Connection['@attributes']['SegmentIndex'].",";
	    					
						}else{
							$Connections.=$air_Connection['SegmentIndex'].",";
						}
	    				
	    			}

	    			
	    		}
	    		$fs[$i]['Connections']=$Connections;
	    	
					
					if(isset($AirPricingSolution_Attr->ApproximateTotalPrice)){
			$TotalPrice_ = ($AirPricingSolution_Attr->ApproximateTotalPrice);
			}else{
			$TotalPrice_ = ($AirPricingSolution_Attr->TotalPrice);
			}
			
	    	$TotalPrice = substr($TotalPrice_,3);
	    	$TotalPrice_Curr = substr($TotalPrice_,0,3);
	    	$TotalPrice = $this->flight_model->currency_convertor($TotalPrice,$TotalPrice_Curr,CURR);
	    	$TotalPrice = $this->account_model->PercentageToAmount($TotalPrice,$aMarkup);
	    	$TotalPrice = $this->account_model->PercentageToAmount($TotalPrice, $myMarkup);
	    	
	    	if(isset($AirPricingSolution_Attr->EquivalentBasePrice)){
				$BasePrice = substr($AirPricingSolution_Attr->EquivalentBasePrice,3);
		    	$BasePrice_Curr = substr($AirPricingSolution_Attr->EquivalentBasePrice,0,3);
		    	$BasePrice = $this->flight_model->currency_convertor($BasePrice,$BasePrice_Curr,CURR);
		    	$BasePrice = $this->account_model->PercentageToAmount($BasePrice,$aMarkup);
		    	$BasePrice = $this->account_model->PercentageToAmount($BasePrice, $myMarkup);
			}else if(isset($AirPricingSolution_Attr->ApproximateBasePrice)){
			    $BasePrice = substr($AirPricingSolution_Attr->ApproximateBasePrice,3);
		    	$BasePrice_Curr = substr($AirPricingSolution_Attr->ApproximateBasePrice,0,3);
		    	$BasePrice = $this->flight_model->currency_convertor($BasePrice,$BasePrice_Curr,CURR);
		    	$BasePrice = $this->account_model->PercentageToAmount($BasePrice,$aMarkup);
		    	$BasePrice = $this->account_model->PercentageToAmount($BasePrice, $myMarkup);
			}else{
				$BasePrice = substr($AirPricingSolution_Attr->BasePrice,3);
		    	$BasePrice_Curr = substr($AirPricingSolution_Attr->BasePrice,0,3);
		    	$BasePrice = $this->flight_model->currency_convertor($BasePrice,$BasePrice_Curr,CURR);
		    	$BasePrice = $this->account_model->PercentageToAmount($BasePrice,$aMarkup);
		    	$BasePrice = $this->account_model->PercentageToAmount($BasePrice, $myMarkup);
			}
			if(isset($AirPricingSolution_Attr->ApproximateTaxes)){
			$Taxes_ = ($AirPricingSolution_Attr->ApproximateTaxes);
			}else{
			$Taxes_ = ($AirPricingSolution_Attr->Taxes);
			}
			$Taxes = substr($Taxes_,3);
	    	$Taxes_Curr = substr($Taxes_,0,3);
	    	$Taxes = $this->flight_model->currency_convertor($Taxes,$Taxes_Curr,CURR);
	    	$Taxes = $this->account_model->PercentageToAmount($Taxes,$aMarkup);
	    	$Taxes = $this->account_model->PercentageToAmount($Taxes, $myMarkup);

	    	$fs[$i]['TotalPrice'] = $TotalPrice;
	    	$fs[$i]['BasePrice'] = $BasePrice;
	    	$fs[$i]['Taxes'] = $Taxes;
	    	$fs[$i]['TotalPrice_API'] = $AirPricingSolution_Attr->TotalPrice;
	    	$fs[$i]['APICurrencyType'] = $CurrencyType;
	    	$fs[$i]['SITECurrencyType'] = CURR;
	    	$fs[$i]['MyMarkup'] = $myMarkup;
	    	$fs[$i]['aMarkup'] =$aMarkup;
	    	$All_Passenger=array();
	    	if(isset($AirPricingSolution['air:AirPricingInfo'][0])){
				
	    		$AirPricingInfo_Attr = $AirPricingInfo[0]['@attributes'];
	    		$AirPricingInfo_Attr = json_encode($AirPricingInfo_Attr);
	    		$AirPricingInfo_Attr = json_decode($AirPricingInfo_Attr);
	    		if(isset($AirPricingInfo_Attr->PlatingCarrier)){
	    			$PlatingCarrier = $AirPricingInfo_Attr->PlatingCarrier;
	    		}else{
	    			$PlatingCarrier = '';
	    		}

	    		if(isset($AirPricingInfo_Attr->Refundable)){
	    			$Refundable = $AirPricingInfo_Attr->Refundable;
	    		}else{
	    			$Refundable = false;
	    		}
					
	    			$AirPricingInfos = $AirPricingInfo;
	    			$Pass_BasePrice=array(); $Pass_Taxes=array();
	    		foreach ($AirPricingInfos as $key => $AirPricingInfo) {

	    			$Passenger_type=$AirPricingInfo['air:PassengerType'];
	    		
	    			foreach ($Passenger_type as $key => $Passenger_type_details) {
	    				
	    				if(isset($Passenger_type_details['@attributes'])){
	    					$All_Passenger[]=$Passenger_type_details['@attributes']['Code'];
	    					
						}else{
							$All_Passenger[] = $Passenger_type_details['Code'];
						}
	    				
	    			}

	    			if(isset($AirPricingInfo['@attributes']['EquivalentBasePrice'])){
	    				$BasePrice = substr($AirPricingInfo['@attributes']['EquivalentBasePrice'],3);
				    	$BasePrice_Curr = substr($AirPricingInfo['@attributes']['EquivalentBasePrice'],0,3);
				    	$BasePrice = $this->flight_model->currency_convertor($BasePrice,$BasePrice_Curr,CURR);
						$Pass_BasePrice[] = $BasePrice;
					}else if(isset($AirPricingInfo['@attributes']['ApproximateBasePrice'])){
						$BasePrice = substr($AirPricingInfo['@attributes']['ApproximateBasePrice'],3);
				    	$BasePrice_Curr = substr($AirPricingInfo['@attributes']['ApproximateBasePrice'],0,3);
				    	$BasePrice = $this->flight_model->currency_convertor($BasePrice,$BasePrice_Curr,CURR);
						$Pass_BasePrice[] = $BasePrice;
					}else{
						$BasePrice = substr($AirPricingInfo['@attributes']['BasePrice'],3);
				    	$BasePrice_Curr = substr($AirPricingInfo['@attributes']['BasePrice'],0,3);
				    	$BasePrice = $this->flight_model->currency_convertor($BasePrice,$BasePrice_Curr,CURR);
						$Pass_BasePrice[] = $BasePrice;
					}
					if(isset($AirPricingInfo['@attributes']['ApproximateTaxes'])){
					$Taxes = substr($AirPricingInfo['@attributes']['ApproximateTaxes'],3);
			    	$Taxes_Curr = substr($AirPricingInfo['@attributes']['ApproximateTaxes'],0,3);
			    	$Taxes = $this->flight_model->currency_convertor($Taxes,$Taxes_Curr,CURR);
			    	$Pass_Taxes[] = $Taxes;
						}else{
					$Taxes = substr($AirPricingInfo['@attributes']['Taxes'],3);
			    	$Taxes_Curr = substr($AirPricingInfo['@attributes']['Taxes'],0,3);
			    	$Taxes = $this->flight_model->currency_convertor($Taxes,$Taxes_Curr,CURR);
							$Pass_Taxes[] = $Taxes;
						}
					
	    		}

	    		
				$All_Passengers = implode(',',$All_Passenger);
	    		$Pass_BasePrice = implode(',',$Pass_BasePrice);
				$Pass_Taxes = implode(',',$Pass_Taxes);
						
				$BookingInfo = $AirPricingInfo['air:BookingInfo'];	

	    	}else{

	    		$AirPricingInfo_Attr = $AirPricingInfo['@attributes'];
	    		$AirPricingInfo_Attr = json_encode($AirPricingInfo_Attr);
	    		$AirPricingInfo_Attr = json_decode($AirPricingInfo_Attr);
	    		if(isset($AirPricingInfo_Attr->PlatingCarrier)){
	    			$PlatingCarrier = $AirPricingInfo_Attr->PlatingCarrier;
	    		}else{
	    			$PlatingCarrier = '';
	    		}

	    		if(isset($AirPricingInfo_Attr->Refundable)){
	    			$Refundable = $AirPricingInfo_Attr->Refundable;
	    		}else{
	    			$Refundable = false;
	    		}

	    		if(isset($AirPricingInfo_Attr->EquivalentBasePrice)){
    				$BasePrice = substr($AirPricingInfo_Attr->EquivalentBasePrice,3);
			    	$BasePrice_Curr = substr($AirPricingInfo_Attr->EquivalentBasePrice,0,3);
			    	$BasePrice = $this->flight_model->currency_convertor($BasePrice,$BasePrice_Curr,CURR);
					$Pass_BasePrice = $BasePrice;
				}else if(isset($AirPricingInfo_Attr->EquivalentBasePrice)){
					$BasePrice = substr($AirPricingInfo_Attr->ApproximateBasePrice,3);
			    	$BasePrice_Curr = substr($AirPricingInfo_Attr->ApproximateBasePrice,0,3);
			    	$BasePrice = $this->flight_model->currency_convertor($BasePrice,$BasePrice_Curr,CURR);
					$Pass_BasePrice = $BasePrice;
				}else{
					$BasePrice = substr($AirPricingInfo_Attr->BasePrice,3);
			    	$BasePrice_Curr = substr($AirPricingInfo_Attr->BasePrice,0,3);
			    	$BasePrice = $this->flight_model->currency_convertor($BasePrice,$BasePrice_Curr,CURR);
					$Pass_BasePrice = $BasePrice;
				}
				
				if(isset($AirPricingInfo_Attr->ApproximateTaxes)){
    				$Taxes = substr($AirPricingInfo_Attr->ApproximateTaxes,3);
			    	$Taxes_Curr = substr($AirPricingInfo_Attr->ApproximateTaxes,0,3);
			    	$Taxes = $this->flight_model->currency_convertor($BasePrice,$BasePrice_Curr,CURR);
					$Pass_Taxes = $Taxes;
				}else{
					$Taxes = substr($AirPricingInfo_Attr->Taxes,3);
		    	$Taxes_Curr = substr($AirPricingInfo_Attr->Taxes,0,3);
		    	$Taxes = $this->flight_model->currency_convertor($Taxes,$Taxes_Curr,CURR);
				$Pass_Taxes = $Taxes;
				}

				
				
				$BookingInfo = $AirPricingInfo['air:BookingInfo'];	


				$Passenger_type=$AirPricingInfo['air:PassengerType'];

	    			foreach ($Passenger_type as $key => $Passenger_type_details) {
	    				
	    				if(isset($Passenger_type_details['@attributes'])){
	    					$All_Passenger[]=$Passenger_type_details['@attributes']['Code'];
	    					
						}else{
							$All_Passenger[] = $Passenger_type_details['Code'];
						}
	    				
	    			}

	    			$All_Passengers = implode(',',$All_Passenger);
	    	}
	    	//print_r($All_Passenger);

	    	if($Refundable == 'true'){
				$FareType = 'Refundable';
	    	}else{
				$FareType = 'Non Refundable';
			}
	    	$fs[$i]['BasePrice_Breakdown'] = $Pass_BasePrice;
	    	$fs[$i]['TaxPrice_Breakdown'] = $Pass_Taxes;
	    	$fs[$i]['Refundable'] = $Refundable;
	    	$fs[$i]['PlatingCarrier'] = $PlatingCarrier;
	    	$fs[$i]['FareType'] = $FareType;
			$fs[$i]['All_Passenger'] = $All_Passengers;
	    	$passenger_count=array_count_values($All_Passenger);
	    	$fs[$i]['Adults'] =$passenger_count['ADT'];
	    	if(isset($passenger_count['CNN'])){
	    	$fs[$i]['Childs'] =$passenger_count['CNN'];
	    	}
	    	if(isset($passenger_count['INF'])){
	    	$fs[$i]['Infants'] =$passenger_count['INF'];
	    	}
	    	$split_base_price=explode(",", $Pass_BasePrice);
	    	$fs[$i]['Adults_Base_Price'] =$split_base_price[0];
	    	if(isset($split_base_price[1])){
	    	$fs[$i]['Childs_Base_Price'] =$split_base_price[1];
	    }
	    if(isset($split_base_price[2])){
	    	$fs[$i]['Infants_Base_Price'] =$split_base_price[2];
		}

		$split_tax_price=explode(",", $Pass_Taxes);
		$fs[$i]['Adults_Tax_Price'] =$split_tax_price[0];
	    	if(isset($split_tax_price[1])){
	    	$fs[$i]['Childs_Tax_Price'] =$split_tax_price[1];
	    }
	    if(isset($split_base_price[2])){
	    	$fs[$i]['Infants_Tax_Price'] =$split_tax_price[2];
		}
	    	if(isset($AirPricingSolution['air:Journey'][0])){
				
				
				$Journies = $Journey;
	    		//return false;//round trip
	    		$j=0;
	    		foreach ($Journies as $key => $Journey) {
	    			if($j == 0){
						$mode = 'onward';
	    			}else{
						$mode = 'return';
					}
					//echo $j.'<br>';die;
					$Journey_Attr = $Journey['@attributes'];
					$TravelTime = $Journey_Attr['TravelTime'];
					$fs[$i]['trip_type'] = $mode;
					$fs[$i]['TravelTime'] = $TravelTime;
					$Stops = 0;
					$AirSegmentRefs = $AirSegmentRef = $Journey['air:AirSegmentRef'];
					 $jj = $j;
					if(isset($AirSegmentRefs[0])){
						
						$num_seg=0;
						foreach ($AirSegmentRefs as $jk => $AirSegmentRef) {
							$AirSegmentRef_Attr = $AirSegmentRef['@attributes'];									
							$AirSegmentRef_Key = $AirSegmentRef_Attr['Key'];
							$AirSegments = $AirSegment;
							foreach ($AirSegments as $key => $AirSegmentt) {
								$AirSegment_Attr =  $AirSegmentt['@attributes'];										
								$AirSegment_Key = $AirSegment_Attr['Key'];
								
								if($AirSegment_Key == $AirSegmentRef_Key){
									$Tot_Stops[] = $num_seg;
									$fs[$i]['Carrier'] = $Carrier = $AirSegment_Attr['Carrier'];
									
									$fs[$i]['segments'][$jj][$num_seg]['AirSegment_Key'] = $AirSegment_Key;
									$fs[$i]['segments'][$jj][$num_seg]['Group'] = $Group = $AirSegment_Attr['Group'];									
									$fs[$i]['segments'][$jj][$num_seg]['Carrier'] = $Carrier = $AirSegment_Attr['Carrier'];
									$fs[$i]['segments'][$jj][$num_seg]['FlightNumber'] = $FlightNumber = $AirSegment_Attr['FlightNumber'];
									$fs[$i]['segments'][$jj][$num_seg]['Origin'] = $Origin = $AirSegment_Attr['Origin'];
									$fs[$i]['segments'][$jj][$num_seg]['Destination'] = $Destination = $AirSegment_Attr['Destination'];
									$fs[$i]['segments'][$jj][$num_seg]['DepartureTime'] = $DepartureTime = $AirSegment_Attr['DepartureTime'];
									$fs[$i]['segments'][$jj][$num_seg]['ArrivalTime'] = $ArrivalTime = $AirSegment_Attr['ArrivalTime'];
									$fs[$i]['segments'][$jj][$num_seg]['FlightTime'] = $FlightTime = $AirSegment_Attr['FlightTime'];
									$fs[$i]['segments'][$jj][$num_seg]['Distance'] = $Distance = $AirSegment_Attr['Distance'];
									$fs[$i]['segments'][$jj][$num_seg]['ETicketability'] = $ETicketability = $AirSegment_Attr['ETicketability'];
									$fs[$i]['segments'][$jj][$num_seg]['Equipment'] = $Equipment = $AirSegment_Attr['Equipment'];
									$fs[$i]['segments'][$jj][$num_seg]['ChangeOfPlane'] = $ChangeOfPlane = $AirSegment_Attr['ChangeOfPlane'];
									$fs[$i]['segments'][$jj][$num_seg]['ParticipantLevel'] = $ParticipantLevel = $AirSegment_Attr['ParticipantLevel'];
									if(isset($AirSegment_Attr['APISRequirementsRef'])){
							$fs[$i]['segments'][$jj][$num_seg]['APISRequirementsRef'] = $AirSegment_Attr['APISRequirementsRef'];
							}

							if(isset($AirSegment_Attr['AvailabilityDisplayType'])){
							$fs[$i]['segments'][$jj][$num_seg]['AvailabilityDisplayType'] =  $AirSegment_Attr['AvailabilityDisplayType'];
							}
									if(isset($AirSegment_Attr['SupplierCode'])){
									$fs[$i]['segments'][$jj][$num_seg]['SupplierCode'] = $AirSegment_Attr['SupplierCode'];
									}
									if(isset($AirSegment_Attr['Status'])){
									$fs[$i]['segments'][$jj][$num_seg]['Status'] =  $AirSegment_Attr['Status'];
									}

									$LinkAvailability = '';
									if(isset($AirSegment_Attr['LinkAvailability'])){
										$LinkAvailability = $AirSegment_Attr['LinkAvailability'];
									}
									$fs[$i]['segments'][$jj][$num_seg]['LinkAvailability'] = $LinkAvailability;
									$fs[$i]['segments'][$jj][$num_seg]['PolledAvailabilityOption'] = $PolledAvailabilityOption = $AirSegment_Attr['PolledAvailabilityOption'];
									$fs[$i]['segments'][$jj][$num_seg]['OptionalServicesIndicator'] = $OptionalServicesIndicator = $AirSegment_Attr['OptionalServicesIndicator'];
									$AvailabilitySource = '';
									if(isset($AirSegment_Attr['AvailabilitySource'])){	
										$AvailabilitySource = $AirSegment_Attr['AvailabilitySource'];
									}
									$fs[$i]['segments'][$jj][$num_seg]['AvailabilitySource'] = $AvailabilitySource;
									if(isset($AirSegment['air:CodeshareInfo']) && is_array($AirSegment['air:CodeshareInfo'])){
										$CodeshareInfo_Attr =  $AirSegment['air:CodeshareInfo']['@attributes'];	
										$OperatingCarrier = $CodeshareInfo_Attr['OperatingCarrier'];	

										$OperatingFlightNumber = '';
										if(isset($CodeshareInfo_Attr['OperatingFlightNumber'])){	
											$OperatingFlightNumber = $CodeshareInfo_Attr['OperatingFlightNumber'];		
										}
									}else if(isset($AirSegment['air:CodeshareInfo'])){
										$OperatingCarrier = $AirSegment['air:CodeshareInfo'];
										$OperatingFlightNumber = '';
									}else{
										$OperatingCarrier = '';
										$OperatingFlightNumber = '';
									}
									$fs[$i]['segments'][$jj][$num_seg]['OperatingCarrier'] = $OperatingCarrier;
									$fs[$i]['segments'][$jj][$num_seg]['OperatingFlightNumber'] = $OperatingFlightNumber;
									$ProviderCode = '';$BookingCounts = '';
									
									if(isset($AirSegmentt['air:AirAvailInfo'])){
										$ProviderCode = $AirSegmentt['air:AirAvailInfo']['@attributes']['ProviderCode'];
										$BookingCodeInfo_Attr =  $AirSegmentt['air:AirAvailInfo']['air:BookingCodeInfo']['@attributes'];	
										$BookingCounts = $BookingCodeInfo_Attr['BookingCounts'];
									}
									
									$fs[$i]['segments'][$jj][$num_seg]['ProviderCode'] = $ProviderCode;
									$fs[$i]['segments'][$jj][$num_seg]['BookingCounts'] = $BookingCounts;
									if(isset($AirSegmentt['air:FlightDetailsRef']['@attributes'])){
										$FlightDetailsRef_Key =  $AirSegmentt['air:FlightDetailsRef']['@attributes']['Key'];	
									}else{
		                                $FlightDetailsRef_Key ='';
		                            }
		                            foreach ($FlightDetails as $key => $FlightDetail) {
		                            	//echo '<pre>';print_r($FlightDetail);
		                            	$FlightDetail_Attr =  $FlightDetail['@attributes'];										
										$FlightDetail_Key = $FlightDetail_Attr['Key'];
										$fs[$i]['segments'][$jj][$num_seg]['FlightDetail_Key'] = $FlightDetail_Key;
										if($FlightDetail_Key == $FlightDetailsRef_Key){
											//$Equipment = $FlightDetails_attr['Equipment'];													
											$OriginTerminal = '';$DestinationTerminal = '';
											if(isset($FlightDetail_Attr['OriginTerminal'])){
												$OriginTerminal = $FlightDetail_Attr['OriginTerminal'];
											}
											if(isset($FlightDetail_Attr['DestinationTerminal'])){
												$DestinationTerminal = $FlightDetail_Attr['DestinationTerminal'];	
											}
											$fs[$i]['segments'][$jj][$num_seg]['OriginTerminal'] = $OriginTerminal;
											$fs[$i]['segments'][$jj][$num_seg]['DestinationTerminal'] = $DestinationTerminal;
											break;
										}
										//die;
		                            }
		                            break;
								}
							}
							if(!isset($OriginTerminal)){
							$OriginTerminal='';
							}
							if(!isset($DestinationTerminal)){
								$DestinationTerminal='';
							}
							$fs[$i]['segments'][$jj][$num_seg]['OriginTerminal'] = $OriginTerminal;
							$fs[$i]['segments'][$jj][$num_seg]['DestinationTerminal'] = $DestinationTerminal;
							//echo '<pre>';print_r($BookingInfo);die;
							$BookingInfo_Attr = $BookingInfo[$jk]['@attributes'];
							/*$fs[$i]['segments'][$jj][$num_seg]['BookingCode'] = $BookingCode = $BookingInfo_Attr['BookingCode'];
							$fs[$i]['segments'][$jj][$num_seg]['CabinClass'] = $CabinClass = $BookingInfo_Attr['CabinClass'];
							$fs[$i]['segments'][$jj][$num_seg]['FareInfoRef'] = $FareInfoRef = $BookingInfo_Attr['FareInfoRef'];*/
							
								$AirBookingInfo=$AirPricingInfo['air:BookingInfo'];
                            foreach ($AirBookingInfo as $key => $BookingInfo_eachArr) {
                            	if(array_key_exists(0, $AirBookingInfo)){
								
								$BookingInfo_Attrs=$BookingInfo_eachArr['@attributes'];
								}else{
								$BookingInfo_Attrs=$BookingInfo_eachArr;
								
								}
                                 if($AirSegment_Key==$BookingInfo_Attrs['SegmentRef']){
                            $fs[$i]['segments'][$jj][$num_seg]['BookingCode'] = $BookingCode = $BookingInfo_Attrs['BookingCode'];
                            $fs[$i]['segments'][$jj][$num_seg]['CabinClass'] = $CabinClass = $BookingInfo_Attrs['CabinClass'];
                            $fs[$i]['segments'][$jj][$num_seg]['FareInfoRef'] = $FareInfoRef = $BookingInfo_Attrs['FareInfoRef'];
                            }
                        }

							$Farerulesref_Key=array();$Farerulesref_Provider=array();$Farerulesref_content=array();
						foreach ($FareInfos as $key => $FareInfoses) {

	    					if(isset($FareInfoses['air:FareRuleKey'])){
	    					$faredetails=$FareInfoses['air:FareRuleKey'];
								 $FareInfos_Attr =  $faredetails['@attributes'];
								 //echo '<pre>';print_r($AirPricingSolution);die;
								  	$FareInfoRef_key =  $FareInfos_Attr['FareInfoRef'];	
								    $FareInfoRef_provider =  $FareInfos_Attr['ProviderCode'];											
									$farecontent = $faredetails['@content'];
								 if($FareInfoRef==$FareInfoRef_key){
								  
									$Farerulesref_Key[]=$FareInfoRef_key;
									$Farerulesref_Provider[]=$FareInfoRef_provider;
									$Farerulesref_content[]=$farecontent;
									$fs[$i]['segments'][$jj][$num_seg]['Farerulesref_Key'] =  $FareInfoRef_key;
									$fs[$i]['segments'][$jj][$num_seg]['Farerulesref_Provider'] =  $FareInfoRef_provider;
									$fs[$i]['segments'][$jj][$num_seg]['Farerulesref_content'] =  $farecontent;
									}
							}else{
							$faredetails=$FareInfos['air:FareRuleKey'];
								 $FareInfos_Attr =  $faredetails['@attributes'];
								 //echo '<pre>';print_r($AirPricingSolution);die;
								   $FareInfoRef_key =  $FareInfos_Attr['FareInfoRef'];	
								    $FareInfoRef_provider =  $FareInfos_Attr['ProviderCode'];											
									$farecontent = $faredetails['@content'];
									if($FareInfoRef==$FareInfoRef_key){
								  
									$Farerulesref_Key[]=$FareInfoRef_key;
									$Farerulesref_Provider[]=$FareInfoRef_provider;
									$Farerulesref_content[]=$farecontent;
									$fs[$i]['segments'][$jj][$num_seg]['Farerulesref_Key'] =  $FareInfoRef_key;
									$fs[$i]['segments'][$jj][$num_seg]['Farerulesref_Provider'] =  $FareInfoRef_provider;
									$fs[$i]['segments'][$jj][$num_seg]['Farerulesref_content'] =  $farecontent;
									}
									

								}
								
						}
									
									$fs[$i]['Farerulesref_Key'][]=$Farerulesref_Key;
									$fs[$i]['Farerulesref_Provider'][]=$Farerulesref_Provider;
									$fs[$i]['Farerulesref_content'][]=$Farerulesref_content;
							if(isset($BookingInfo_Attr['HostTokenRef'])){
						$fs[$i]['segments'][$jj][$num_seg]['HostTokenRef'] =  $BookingInfo_Attr['HostTokenRef'];
						foreach ($HostTokenLists as $key => $HostTokenList) {
								if(isset($HostTokenList['@attributes'])){
						$HostTokenList_Attr = $HostTokenList['@attributes'];
						//print_r($HostTokenList_Attr);
						$HostTokencontent = $HostTokenList['@content'];
						if($HostTokenList_Attr['Key']==$BookingInfo_Attr['HostTokenRef']){
						$fs[$i]['segments'][$jj][$num_seg]['HostTokencontent'] = $HostTokencontent;
						}
					}
						}
					}
						foreach ($FareBasis as $key => $FareBasiss) {
								$FareBasiss_Attr =$FareBasiss['@attributes'];
								if($FareBasiss_Attr['Key']==$BookingInfo_Attr['FareInfoRef']){
								 $fs[$i]['segments'][$jj][$num_seg]['FareBasis']=$FareBasiss_Attr['FareBasis'];
							}
							}
							$Stops;
							$Stops++;
						
							$num_seg++;
						}
						
					}else{
						
						$AirSegmentRef_Attr = $AirSegmentRef['@attributes'];									
						$AirSegmentRef_Key = $AirSegmentRef_Attr['Key'];
						$AirSegments = $AirSegment;
						foreach ($AirSegment as $key => $AirSegmentt) {
							$AirSegment_Attr =  $AirSegmentt['@attributes'];										
							$AirSegment_Key = $AirSegment_Attr['Key'];
							if($AirSegment_Key == $AirSegmentRef_Key){
									$fs[$i]['Carrier'] = $Carrier = $AirSegment_Attr['Carrier'];
								$fs[$i]['segments'][$jj]['AirSegment_Key'] = $AirSegment_Key;
								$fs[$i]['segments'][$jj]['Group'] = $Group = $AirSegment_Attr['Group'];									
								$fs[$i]['segments'][$jj]['Carrier'] = $Carrier = $AirSegment_Attr['Carrier'];
								$fs[$i]['segments'][$jj]['FlightNumber'] = $FlightNumber = $AirSegment_Attr['FlightNumber'];
								$fs[$i]['segments'][$jj]['Origin'] = $Origin = $AirSegment_Attr['Origin'];
								$fs[$i]['segments'][$jj]['Destination'] = $Destination = $AirSegment_Attr['Destination'];
								$fs[$i]['segments'][$jj]['DepartureTime'] = $DepartureTime = $AirSegment_Attr['DepartureTime'];
								$fs[$i]['segments'][$jj]['ArrivalTime'] = $ArrivalTime = $AirSegment_Attr['ArrivalTime'];
								$fs[$i]['segments'][$jj]['FlightTime'] = $FlightTime = $AirSegment_Attr['FlightTime'];
								if(isset($AirSegment_Attr['APISRequirementsRef'])){
							$fs[$i]['segments'][$jj]['APISRequirementsRef']  = $AirSegment_Attr['APISRequirementsRef'];
							}

							if(isset($AirSegment_Attr['AvailabilityDisplayType'])){
							$fs[$i]['segments'][$jj]['AvailabilityDisplayType'] =  $AirSegment_Attr['AvailabilityDisplayType'];
							}
								if(isset($AirSegment_Attr['SupplierCode'])){
									$fs[$i]['segments'][$jj]['SupplierCode']  = $AirSegment_Attr['SupplierCode'];
									}
									if(isset($AirSegment_Attr['Status'])){
									$fs[$i]['segments'][$jj]['Status']  = $AirSegment_Attr['Status'];
									}
								if(isset($AirSegment_Attr['Distance'])){
								$fs[$i]['segments'][$jj]['Distance'] = $Distance = $AirSegment_Attr['Distance'];
							}
							if(isset($AirSegment_Attr['ETicketability'])){
								$fs[$i]['segments'][$jj]['ETicketability'] = $ETicketability = $AirSegment_Attr['ETicketability'];
							}
								if(isset($AirSegment_Attr['Equipment'])){
								$fs[$i]['segments'][$jj]['Equipment'] = $Equipment = $AirSegment_Attr['Equipment'];
							}
								$fs[$i]['segments'][$jj]['ChangeOfPlane'] = $ChangeOfPlane = $AirSegment_Attr['ChangeOfPlane'];
								if(isset($AirSegment_Attr['ParticipantLevel'])){
								$fs[$i]['segments'][$jj]['ParticipantLevel'] = $ParticipantLevel = $AirSegment_Attr['ParticipantLevel'];
							}
								$LinkAvailability = '';
								if(isset($AirSegment_Attr['LinkAvailability'])){
									$fs[$i]['segments'][$jj]['LinkAvailability'] = $LinkAvailability = $AirSegment_Attr['LinkAvailability'];
								}
								if(isset($AirSegment_Attr['PolledAvailabilityOption'])){
								$fs[$i]['segments'][$jj]['PolledAvailabilityOption'] = $PolledAvailabilityOption = $AirSegment_Attr['PolledAvailabilityOption'];
								}
								$fs[$i]['segments'][$jj]['OptionalServicesIndicator'] = $OptionalServicesIndicator = $AirSegment_Attr['OptionalServicesIndicator'];
								
								$AvailabilitySource = '';
								if(isset($AirSegment_Attr['AvailabilitySource'])){	
									$fs[$i]['segments'][$jj]['AvailabilitySource'] = $AvailabilitySource = $AirSegment_Attr['AvailabilitySource'];
								}

								if(isset($AirSegmentt['air:CodeshareInfo']) && is_array($AirSegmentt['air:CodeshareInfo'])){
									$CodeshareInfo_Attr =  $AirSegmentt['air:CodeshareInfo']['@attributes'];
									$OperatingCarrier = '';
									if(isset($CodeshareInfo_Attr['OperatingCarrier'])){	
									$OperatingCarrier = $CodeshareInfo_Attr['OperatingCarrier'];	
										}
									$OperatingFlightNumber = '';
									if(isset($CodeshareInfo_Attr['OperatingFlightNumber'])){	
										$OperatingFlightNumber = $CodeshareInfo_Attr['OperatingFlightNumber'];		
									}
								}else if(isset($AirSegmentt['air:CodeshareInfo'])){
									$OperatingCarrier = $AirSegmentt['air:CodeshareInfo'];
									$OperatingFlightNumber = '';
								}else{
									$OperatingCarrier = '';
									$OperatingFlightNumber = '';
								}
								$fs[$i]['segments'][$jj]['OperatingCarrier'] = $OperatingCarrier;
								$fs[$i]['segments'][$jj]['OperatingFlightNumber'] = $OperatingFlightNumber;
								$ProviderCode = '';$BookingCounts = '';
								if(isset($AirSegmentt['air:AirAvailInfo'])){
									$ProviderCode = $AirSegmentt['air:AirAvailInfo']['@attributes']['ProviderCode'];
									$BookingCodeInfo_Attr =  $AirSegmentt['air:AirAvailInfo']['air:BookingCodeInfo']['@attributes'];	
									$BookingCounts = $BookingCodeInfo_Attr['BookingCounts'];											
								}
								$fs[$i]['segments'][$jj]['ProviderCode'] = $ProviderCode;
								$fs[$i]['segments'][$jj]['BookingCounts'] = $BookingCounts;
								if(isset($AirSegmentt['air:FlightDetailsRef']['@attributes'])){
									$FlightDetailsRef_Key =  $AirSegmentt['air:FlightDetailsRef']['@attributes']['Key'];	
								}else{
	                                $FlightDetailsRef_Key ='';
	                            }
	                            foreach ($FlightDetails as $key => $FlightDetail) {
	                            	$FlightDetail_Attr =  $FlightDetail['@attributes'];										
									$fs[$i]['segments'][$jj]['FlightDetail_Key'] = $FlightDetail_Key = $FlightDetail_Attr['Key'];
									if($FlightDetail_Key == $FlightDetailsRef_Key){
										//$Equipment = $FlightDetails_attr['Equipment'];													
										$OriginTerminal = '';$DestinationTerminal = '';
										if(isset($FlightDetail_Attr['OriginTerminal'])){
											$OriginTerminal = $FlightDetail_Attr['OriginTerminal'];
										}
										if(isset($FlightDetail_Attr['DestinationTerminal'])){
											$DestinationTerminal = $FlightDetail_Attr['DestinationTerminal'];	
										}
										break;
									}
	                            }
	                            break;
							}
							
						}
						if(!isset($OriginTerminal)){
							$OriginTerminal='';
						}
						if(!isset($DestinationTerminal)){
							$DestinationTerminal='';
						}
						$fs[$i]['segments'][$jj]['OriginTerminal'] = $OriginTerminal;
						$fs[$i]['segments'][$jj]['DestinationTerminal'] = $DestinationTerminal;
						$BookingInfo_Attr = $BookingInfo[$j]['@attributes'];
						/*$fs[$i]['segments'][$jj]['BookingCode'] = $BookingCode = $BookingInfo_Attr['BookingCode'];
						$fs[$i]['segments'][$jj]['CabinClass'] = $CabinClass = $BookingInfo_Attr['CabinClass'];
						$fs[$i]['segments'][$jj]['FareInfoRef'] = $FareInfoRef = $BookingInfo_Attr['FareInfoRef'];*/
						
						 $AirBookingInfo=$AirPricingInfo['air:BookingInfo'];
                        foreach ($AirBookingInfo as $key => $BookingInfo_eachArr) {

                        	if(array_key_exists(0, $AirBookingInfo)){
								
								$BookingInfo_Attrs=$BookingInfo_eachArr['@attributes'];
								}else{
								$BookingInfo_Attrs=$BookingInfo_eachArr;
								
								}

                               if($AirSegment_Key==$BookingInfo_Attrs['SegmentRef']){
                            $fs[$i]['segments'][$jj]['BookingCode'] = $BookingCode = $BookingInfo_Attrs['BookingCode'];
                            $fs[$i]['segments'][$jj]['CabinClass'] = $CabinClass = $BookingInfo_Attrs['CabinClass'];
                            $fs[$i]['segments'][$jj]['FareInfoRef'] = $FareInfoRef = $BookingInfo_Attrs['FareInfoRef'];
                            }
                        }


						$Farerulesref_Key=array();$Farerulesref_Provider=array();$Farerulesref_content=array();
						foreach ($FareInfos as $key => $FareInfoses) {

	    					if(isset($FareInfoses['air:FareRuleKey'])){
	    					$faredetails=$FareInfoses['air:FareRuleKey'];
								 $FareInfos_Attr =  $faredetails['@attributes'];
								 //echo '<pre>';print_r($AirPricingSolution);die;
								  	$FareInfoRef_key =  $FareInfos_Attr['FareInfoRef'];	
								    $FareInfoRef_provider =  $FareInfos_Attr['ProviderCode'];											
									$farecontent = $faredetails['@content'];
								 if($FareInfoRef==$FareInfoRef_key){
								  
									$Farerulesref_Key[]=$FareInfoRef_key;
									$Farerulesref_Provider[]=$FareInfoRef_provider;
									$Farerulesref_content[]=$farecontent;
									$fs[$i]['segments'][$jj]['Farerulesref_Key'] =  $FareInfoRef_key;
									$fs[$i]['segments'][$jj]['Farerulesref_Provider'] =  $FareInfoRef_provider;
									$fs[$i]['segments'][$jj]['Farerulesref_content'] =  $farecontent;
									}
							}else{
							$faredetails=$FareInfos['air:FareRuleKey'];
								 $FareInfos_Attr =  $faredetails['@attributes'];
								 //echo '<pre>';print_r($AirPricingSolution);die;
								   $FareInfoRef_key =  $FareInfos_Attr['FareInfoRef'];	
								    $FareInfoRef_provider =  $FareInfos_Attr['ProviderCode'];											
									$farecontent = $faredetails['@content'];
									if($FareInfoRef==$FareInfoRef_key){
								  
									$Farerulesref_Key[]=$FareInfoRef_key;
									$Farerulesref_Provider[]=$FareInfoRef_provider;
									$Farerulesref_content[]=$farecontent;
									$fs[$i]['segments'][$jj]['Farerulesref_Key'] =  $FareInfoRef_key;
									$fs[$i]['segments'][$jj]['Farerulesref_Provider'] =  $FareInfoRef_provider;
									$fs[$i]['segments'][$jj]['Farerulesref_content'] =  $farecontent;
									}
									

								}
								
						}
									
									$fs[$i]['Farerulesref_Key'][]=$Farerulesref_Key;
									$fs[$i]['Farerulesref_Provider'][]=$Farerulesref_Provider;
									$fs[$i]['Farerulesref_content'][]=$Farerulesref_content;
						
						if(isset($BookingInfo_Attr['HostTokenRef'])){
						$fs[$i]['segments'][$jj]['HostTokenRef'] = $BookingInfo_Attr['HostTokenRef'];
						foreach ($HostTokenLists as $key => $HostTokenList) {
								if(isset($HostTokenList['@attributes'])){
						$HostTokenList_Attr = $HostTokenList['@attributes'];
						//print_r($HostTokenList_Attr);
						$HostTokencontent = $HostTokenList['@content'];
						if($HostTokenList_Attr['Key']==$BookingInfo_Attr['HostTokenRef']){
						$fs[$i]['segments'][$jj]['HostTokencontent'] = $HostTokencontent;
						}
					}
						}
						}
					
							foreach ($FareBasis as $key => $FareBasiss) {
								$FareBasiss_Attr =$FareBasiss['@attributes'];
								if($FareBasiss_Attr['Key']==$BookingInfo_Attr['FareInfoRef']){
								 $fs[$i]['segments'][$jj]['FareBasis']=$FareBasiss_Attr['FareBasis'];
								}
							}
							
							
					}
	    			$j++;
	    		}
	    		//die;
	    	}
	    	//die;
	    	// if($i==56){
	    	// 	echo '<pre>';print_r($fs[55]);die;	
	    	// }
	    	
	    	
	    	//echo '<pre>';print_r($fs);die;
	    	$i++;
	    }

	   $fs['more_results']=$more_results;
	 // echo '<pre>';print_r($fs);die;
	    return $fs;
			}else{
			$fs['more_results'] = $more_results;
			//  echo '<pre>';print_r($fs);die;
			 return $fs;
			}
	}


	
	public function cancel($pnr_no){
        $pnr_no = base64_decode(base64_decode($pnr_no));
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1) {
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
           // echo '<pre>';print_r($b_data);die;
            if($b_data->booking_status == 'CONFIRMED'){
            	 $b_data->booking_no;
            	 $CancelReq_Res = CancelReq($b_data->booking_no);
            	 $CancelRes = $CancelReq_Res['CancelRes'];
            	$CancelRes = $this->xml_to_array->XmlToArray($CancelRes);
			    //echo '<pre>';print_r($CancelRes);die;
				
		
			    if(isset($CancelRes['SOAP:Body']['universal:UniversalRecordCancelRsp'])){
			    	$CancelRes = $CancelRes['SOAP:Body']['universal:UniversalRecordCancelRsp']['universal:ProviderReservationStatus'];
			    	$CancelResAttr = $CancelRes['@attributes'];
			    	if($CancelResAttr['Cancelled']){
			    		//echo '<pre>';print_r($CancelResAttr);die;
			    		$update_booking = array(
							'booking_status' => 'CANCELED'
						);
						$this->booking_model->Update_Booking_Global($pnr_no, $update_booking, 'FLIGHT');
						$this->cancel_mail_voucher($pnr_no);
						$response = array('status' => 1);
        				echo json_encode($response);
			    	}
			    }else{
			    	$xml_log = array(
			    		'Api' => 'UAPI',
			    		'XML_Type' => 'FLIGHT - CANCELLATION -UniversalRecordCancelRsp EMPTY - ERROR',
			    		'XML_Request' => $CancelReq_Res['CancelReq'],
			    		'XML_Response' => $CancelReq_Res['CancelRes'],
			    		'Ip_address' => $this->input->ip_address(),
			    		'XML_Time' => date('Y-m-d H:i:s')
			    	);
			    	$this->xml_model->insert_xml_log($xml_log);
			    }
            }
        }else{
            $response = array('status' => 0);
        	echo json_encode($response);
        }
    }

    public function cancel_mail_voucher($pnr_no){


        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1){
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if($b_data->module == 'FLIGHT'){
            	$data['voucher_details'] =  $this->booking_model->getBookingvoucherinvoicedetails()->row();
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
               
                $data['to'] = $booking->BILLING_EMAIL;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                $email_type = 'ApartmentVoucher';
                $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
                $data['booking_status'] = strtolower($booking->booking_status);
                
                $Response = $this->email_model->sendmail_flightVoucher($data);
                $response = array('status' => 1);
        		
            }
        }
    }
  public function fareRule(){
		$xmlDoc = new DOMDocument();

		 $fare_key=json_decode(base64_decode($_POST['fare_key']));
		$a = explode("|@|",$fare_key);
		$alldetails=$a[0];
		 $total_fare_rule =$a[1];
		 
		 $k=$_POST['elm']-1;
		$expvaleu=explode('|VV|',$alldetails);
		$exp_fare=explode('|KK|',$expvaleu[$k]);
		$fare_rule_key =$exp_fare[0];
		$fare_rule_code =$exp_fare[1];
		$tag_value =$exp_fare[2];
		
	
		 $fare_message = <<<EOM
			<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
				<soapenv:Header/>
				<soapenv:Body>
					<ns2:AirFareRulesReq xmlns="http://www.travelport.com/schema/common_v33_0" xmlns:ns2="http://www.travelport.com/schema/air_v33_0" FareRuleType="long" TargetBranch="P7003720" AuthorizedBy="Test">
					  <BillingPointOfSaleInfo OriginApplication="uAPI" />
					  <ns2:FareRuleKey ProviderCode="$fare_rule_code" FareInfoRef="$fare_rule_key">$tag_value</ns2:FareRuleKey>
					</ns2:AirFareRulesReq>
				</soapenv:Body>
			</soapenv:Envelope>
EOM;
 
		 
		 $fare_result=processRequest($fare_message);
		 
		$xmlDoc->loadXML($fare_result);
		$message = "";
		
		$fare_rules = '';
		$category_array = array(3,5,6,7,16,19,8,12,14,10,1000);
		$fareRule = $xmlDoc->getElementsByTagNameNS('http://www.travelport.com/schema/air_v33_0','FareRuleLong');
		foreach ($fareRule as $value) {
			if ($value->nodeType == XML_ELEMENT_NODE)
				$category = $value->getAttribute("Category");
				if(in_array($category, $category_array)){
					if($category == 3){
						$fare_rules .= '<u>SEASONS</u><br/><br/>';
					}elseif($category == 5){
						$fare_rules .= '<u>ADV RES/TKTG</u><br/><br/>';
					}elseif($category == 6){
						$fare_rules .= '<u>MIN STAY</u><br/><br/>';
					}elseif($category == 7){
						$fare_rules .= '<u>MAX STAY</u><br/><br/>';
					}elseif($category == 16){
						$fare_rules .= '<u>PENALTIES (OR) Change Fee</u><br/><br/>';
					}elseif($category == 19){
						$fare_rules .= '<u>Accompanied Travel Restrictions</u><br/><br/>';
					}elseif($category == 10){
						$fare_rules .= '<u>COMBINATIONS</u><br/><br/>';
					}elseif($category == 8){
						$fare_rules .= '<u>Stopovers</u><br/><br/>';
					}elseif($category == 12){
						$fare_rules .= '<u>SURCHARGES</u><br/><br/>';
					}elseif($category == 14){
						$fare_rules .= '<u>Travel restrictions</u><br/><br/>';
					}elseif($category == 100){
						$fare_rules .= '<u>Terms & Condtions</u><br/><br/>';
					}
					$fare_rules .= $value->nodeValue.'<br/><br/>';
				}
		}
		
		echo $fare_rules.'|@@|'.$total_fare_rule.'|@@|'.$_POST['fare_key'];
	
	} 
    
    
 
public function parseOutput($flex_file=0,$flex_round_file=0,$request){
		
	$from_date=$request->depart_date;
	if($flex_round_file != 0){
	$to_date=$request->return_date;
}
$plot_data=array();
		//One way Flex
	if($flex_file != 0){
		$flexXmlDoc = new DOMDocument();
		$flexXmlDoc->load($flex_file);
		$flex_air_pricing = $flexXmlDoc->getElementsByTagNameNS('http://www.travelport.com/schema/air_v33_0','AirPricingSolution');
		foreach ($flex_air_pricing as $flex_air_pricing_block){
	        $flex_price[] = $flex_air_pricing_block->getAttribute('TotalPrice');
		}
		$flex_air_segment = $flexXmlDoc->getElementsByTagNameNS('http://www.travelport.com/schema/air_v33_0','AirSegment');
		foreach ($flex_air_segment as $flex_air_segment_block){
			$flex_date[] = explode("T",$flex_air_segment_block->getAttribute('DepartureTime'))[0];
		}
		$count = 0;
		$flex_unique_date = array_unique($flex_date);
		foreach ($flex_unique_date as $key => $value) {
			if($count < 7){
				$flex_unique_order_date[] = $value;
				$count++;
			}
		}
		$flex_price = array_chunk($flex_price, count(array_unique($flex_unique_order_date)))[0];
		if($flex_price){
			$flex_air_segment_date = array_combine($flex_unique_order_date,$flex_price);
			if(count($flex_air_segment_date) < 7){
				for($i=-3;$i<4;$i++){
					$selected_date = explode("-",$from_date);
					
					$date_array[DateTime::createFromFormat('d-m-Y', $from_date+$i."-".$selected_date[1]."-".$selected_date[2])->format('Y-m-d')] = 0;
				}
				
				$flex_air_segment_date = array_merge($date_array,$flex_air_segment_date);
			}
		}else{
			$flex_air_segment_date = 0;
		}
		
	}elseif($flex_round_file){
		$flexRoundXmlDoc = new DOMDocument();
		$flexRoundXmlDoc->load($flex_round_file);
		$flex_round_air_segment = $flexRoundXmlDoc->getElementsByTagNameNS('http://www.travelport.com/schema/air_v33_0','AirSegment');
		foreach ($flex_round_air_segment as $flex_round_air_segment_block){
			$flex_round_date[$flex_round_air_segment_block->getAttribute('Key')] = explode("T",$flex_round_air_segment_block->getAttribute('DepartureTime'))[0];
		}
		$flex_round_air_pricing = $flexRoundXmlDoc->getElementsByTagNameNS('http://www.travelport.com/schema/air_v33_0','AirPricingSolution');
		foreach ($flex_round_air_pricing as $priceblock) {
	        $flex_round_price[] = $priceblock->getAttribute('TotalPrice');
	        $dir=0;
	        $journeyblock = $priceblock->getElementsByTagNameNS('http://www.travelport.com/schema/air_v33_0','Journey');		
			foreach ($journeyblock AS $jblock){
				$seg_index=0;
				$flex_round_air_segment_ref = $jblock->getElementsByTagNameNS('http://www.travelport.com/schema/air_v33_0','AirSegmentRef');
		        foreach ($flex_round_air_segment_ref as $flex_round_air_segment_ref_block){
		        	if($seg_index == 0){
		        		$flex_round_air_segment_key[] = $flex_round_air_segment_ref_block->getAttribute('Key');
		        		$apskey = $priceblock->getAttribute('Key');
		        		$plot_data[$apskey]['price'] =  $priceblock->getAttribute('TotalPrice');
		        		$plot_data[$apskey][$dir] = $flex_round_date[$flex_round_air_segment_ref_block->getAttribute('Key')];
		        		$dir++;
		        	}
		        	$seg_index++; 
		        }
		    }
		}
		if($plot_data){
			$flex_air_segment_date = array_map("unserialize", array_unique(array_map("serialize", $plot_data)));
			if(count($flex_air_segment_date) < 49){
				foreach ($plot_data as $key => $value){
					$start_date = explode("-", $value[0])[2];
					$start_month = explode("-", $value[0])[1];
					$start_year = explode("-", $value[0])[0];
					$return_date = explode("-", $value[1])[2];
					$return_month = explode("-", $value[1])[1];
					$return_year = explode("-", $value[1])[0];
					$data[$start_year.$start_month.$start_date.$return_year.$return_month.$return_date]['price'] = $value['price'];
					$data[$start_year.$start_month.$start_date.$return_year.$return_month.$return_date][0] = $value[0];
					$data[$start_year.$start_month.$start_date.$return_year.$return_month.$return_date][1] = $value[1];
				}
				for($a=-3;$a<4;$a++){
					for($b=-3;$b<4;$b++){
						$timestamp = DateTime::createFromFormat('d-m-Y', $from_date)->format('Y-m-d');
						$start = date('Ymd', strtotime(''.$a.' day', strtotime($timestamp)));
						$timestamp1 = DateTime::createFromFormat('d-m-Y', $to_date)->format('Y-m-d');
						$return = date('Ymd', strtotime(''.$b.' day', strtotime($timestamp1)));
						if(!array_key_exists($start.$return, $data)){
							$data[$start.$return]['price'] = 0;
							$data[$start.$return][0] = 0;
							$data[$start.$return][1] = 0;
						}
					}
				}
				ksort($data);
				$flex_air_segment_date = $data;
			}
		}else{
			$flex_air_segment_date = 0;
		}
		
		
		//print_r($flex_air_segment_date);EXIT;
	}
	
		return $flex_air_segment_date;
				
	
	
}
  



}

/* End of file flight.php */
/* Location: ./application/controllers/flight.php */
