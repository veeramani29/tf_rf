<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Car extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('Auth_Model');
        $current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
        $current_url = $this->config->site_url().$this->uri->uri_string(). $current_url;
        $url =  array(
            'continue' => $current_url,
        );
        $this->session->set_userdata($url);
        $this->load->model('Help_Model');
        $this->load->model('account_model');
        $this->load->helper('car_helper');
        $this->load->helper('flight_helper');
        $this->load->model('flight_model');
        $this->load->model('apartment_model');
        $this->load->model('booking_model');
        $this->load->model('email_model');
        $this->load->model('car_model');
        $this->load->library('xml_to_array');
        $this->helpMenuLink = $this->Help_Model->fetchHelpLinks();

        $controller = $this->router->fetch_class();
        parent::validate_modules($controller);
    }

    public function home(){
    	
		$data['banners'] = $this->Help_Model->getHomeSettings();
		$data['portfolio'] = $this->Help_Model->getAllPortfolio();
		$this->load->view('car/car_index',$data);	
    }

	public function index(){
        $request = $this->input->get();
        if($request == ''){
            show_404($_SERVER['REQUEST_URI']);
        }
        //echo '<pre>';print_r($request);die;
        $data['request_array'] = $request;
        $request = json_encode($request);
        $data['req'] = json_decode($request);
        $data['request'] = $request = base64_encode($request);
        //echo '<pre>';print_r($request);die;
		$this->load->view('car/results', $data);	
	}

    public function search(){
        $request = $this->input->get();
        if($request['dropoff'] == ''){
            $dropoff = substr(chop(substr($request['pickup'], -5), ')'), -3);
        }else{
            $dropoff = substr(chop(substr($request['dropoff'], -5), ')'), -3);
        }
        $request = array(
            'pickup' => substr(chop(substr($request['pickup'], -5), ')'), -3),
            'dropoff' => $dropoff,
            'depart_date' => $request['cdepature'],
            'depart_time' => $request['deptime'],
            'return_date' => $request['creturn'],
            'return_time' => $request['rettime'],
        );
        //echo '<pre>';print_r($request);die;
        $query = http_build_query($request);
        $url = WEB_URL.'/car/?'.$query;
        redirect($url);
    }

    public function GetResults($request=''){
        $request = base64_decode($request);
        $data['request'] = $request = json_decode($request);
        $VehicleSearchAvailabilityReq_Res = VehicleSearchAvailabilityReq($request);

        // header("Content-type: text/xml");
        // print_r($VehicleSearchAvailabilityRes);die;
        $aMarkup = $this->account_model->get_markup('CAR'); //get markup
        $aMarkup = $aMarkup['markup'];

        $MyMarkup = $this->account_model->get_my_markup(); //get agent markup
        $myMarkup = $MyMarkup['markup'];

        $results = $this->formatResponse($VehicleSearchAvailabilityReq_Res, $aMarkup, $myMarkup);
        if($results){
            $data['cars'] = $results;
            //echo '<pre>';print_r($results);die;
            $this->load->view('car/ajax_results', $data);
        }else{
            $this->load->view('car/no_result');
        }
    }

    public function GetDetails(){
        $request = $this->input->get();
        $data['car'] = $car = json_decode(base64_decode($request['temp_d']));
        $data['request'] = json_decode(base64_decode($request['temp_r']));
        //echo '<pre>';print_r($car);die;
        $response = array(
            'detail' => $this->load->view('car/ajax_detail', $data, TRUE),
            'status' => 1
        );
        echo json_encode($response);
    }

    public function voucher($pnr_no){
        $pnr_no = base64_decode(base64_decode($pnr_no));
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1) {
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if($b_data->module == 'CAR'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
                $data['global'] = $booking = $this->booking_model->getBookingPnr($pnr_no)->row();
                $this->load->view('car/voucher_view', $data);
            }
        }else{
             $this->load->view('errors/404');
        }
    }
   public function invoice($pnr_no){
	   if($this->session->userdata('b2b_id') || $this->session->userdata('b2c_id')){


        $pnr_no = base64_decode(base64_decode($pnr_no));
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1) {
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if($b_data->module == 'CAR'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
                $data['global'] = $booking = $this->booking_model->getBookingPnr($pnr_no)->row();
                $this->load->view('car/invoice_view', $data);
            }
        }else{
              $this->load->view('errors/404');
        }
		}else{
              $this->load->view('errors/404');
        }
    }
    public function mail_voucher($pnr_no){
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1){
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if($b_data->module == 'CAR'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
                $data['global'] = $booking = $this->booking_model->getBookingPnr($pnr_no)->row();
                $data['message'] = $this->load->view('car/mail_voucher', $data,TRUE);
                $data['to'] = $data['Booking']->BILLING_EMAIL;
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
            if($b_data->module == 'CAR'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
                $data['global'] = $booking = $this->booking_model->getBookingPnr($pnr_no)->row();
                $data['message'] = $this->load->view('car/mail_invoice', $data,TRUE);
                $data['to'] = $data['Booking']->BILLING_EMAIL;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                $email_type = 'ApartmentInvoice';
                $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
                $data['booking_status'] = strtolower($booking->booking_status);
                $data['social_url'] = array(
                    'facebook_social_url' => 'https://www.facebook.com',
                    'twitter_social_url' => 'https://twitter.com',
                    'google_social_url' => 'https://google.com',
                );
                $Response = $this->email_model->sendmail_carInvoice($data);
                $response = array('status' => 1);
                echo json_encode($response);
            }
        }else{
            $response = array('status' => 0);
            echo json_encode($response);
        }
    }

    public function Media($request=''){
         $VehicleMediaReq = VehicleMediaReq1();
		 
         header("Content-type: text/xml");
         print_r($VehicleMediaReq);die;  
    }

    public function AddToCart(){
        $car = $this->input->get('temp_d');
        $car = json_decode(base64_decode($car));

        $request = $this->input->get('temp_r');
        $request = json_decode(base64_decode($request));

        $CarImage = $this->input->get('temp_i');
        // echo '<pre>';print_r($request);
        // echo '<pre>';print_r($car);die;
        
        //echo '<pre>';print_r($first_seg);echo $first_seg->Origin;
        $pickupCityName =  $this->flight_model->get_airport_cityname($request->pickup);
        $dropoffCityName =  $this->flight_model->get_airport_cityname($request->dropoff);
        
        $DepartureDateTime = $this->flight_model->get_unixtimestamp($car->PickupDateTime);
        $ReturnDateTime = $this->flight_model->get_unixtimestamp($car->ReturnDateTime);

        //$DepartureDateTime = $
        $cart_car = array(
            'request' => $this->input->get('temp_r'),
            'response' => $this->input->get('temp_d'),
            'Pickup' => $request->pickup,
            'Dropoff' => $request->dropoff,
            'pickupCityName' => $pickupCityName,
            'dropoffCityName' => $dropoffCityName,
            'DepartureTime' => $DepartureDateTime,
            'ReturnTime' => $ReturnDateTime,
            'CarImage' => $CarImage,
            'TotalPrice' => $car->TotalPrice,
            'SITE_CURR' => $car->SITECurrencyType,
            'API_CURR' => $car->APICurrencyType,
            'MyMarkup' => $car->MyMarkup,
            'BasePrice' => $car->BasePrice,
            'TIMESTAMP' => date('Y-m-d H:i:s')
        );
        //echo '<pre/>';print_r($cart_car);die;      
        $booking_cart_id = $this->car_model->insert_cart_car($cart_car);
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
            'module' => 'CAR',
            'user_type' => $user_type,
            'user_id' => $user_id,
            'session_id' => $session_id,
            'site_curr' => CURR,
            'total' => $car->TotalPrice,
            'ip' =>  $this->input->ip_address(),
            'timestamp' => date('Y-m-d H:i:s')
        );
        $cart_global_id = $this->cart_model->insert_cart_global($cart_global);
        $data['status'] = 1;
        $cart_data = $this->cart_model->getCartData($session_id)->result();
        $data['count'] = count($cart_data);
        if(count($cart_data) > 0){
            $data['isCart'] = true;
        }else{
            $data['isCart'] = false;
        }
        if(!empty($cart_data)){
            $data['C_URL'] = WEB_URL.'/booking/'.$session_id;
            foreach ($cart_data as $key => $cartt) {
                if($cartt->module == 'APARTMENT'){
                    $cart = $this->cart_model->getCartDataByModule($cartt->cart_id,$cartt->module)->row();
                    $data['cart'][] = array(
                        'RID' => $session_id.'cart'.$key,
                        'CID' => $cart->cart_id,
                        'REF_ID' => $cart->ref_id,
                        'TYPE' => 'apartmentcart',
                        'NAME' => $cart->PROP_NAME,
                        'URL' => WEB_URL.'/rooms/'.$cart->PROP_ID,
                        'ADDRESS' => $cart->PROP_ADDR1.', '.$cart->PROP_CITY.', '.$cart->PROP_REGION.', '.$cart->PROP_COUNTRY_NAME,
                        'TOTAL' => $this->account_model->currency_convertor($cart->TOTAL),
                        'IMAGE' => $this->apartment_model->view_property_file($cart->PROP_PHOTO)
                    );
                    $GRAND_TOTAL[] = $cart->TOTAL;
                }else if($cartt->module == 'FLIGHT'){
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
                }else if($cartt->module == 'HOTEL'){
                    $cart = $this->cart_model->getCartDataByModule($cartt->cart_id,$cartt->module)->row();
                    $data['cart'][] = array(
                        'RID' => $session_id.'cart'.$key,
                        'CID' => $cart->cart_id,
                        'REF_ID' => $cart->ref_id,
                        'TYPE' => 'hotelcart',
                        'NAME' => $cart->hotel_name.' ('.$cart->room_name.')',
                        'URL' => WEB_URL,
                        'ADDRESS' => $cart->city,
                        'TOTAL' => $this->account_model->currency_convertor($cart->total_cost),
                        'IMAGE' => $cart->imageurl
                    );
                    $GRAND_TOTAL[] = $cart->total_cost;
                }else if($cartt->module == 'CAR'){
                    $cart = $this->cart_model->getCartDataByModule($cartt->cart_id,$cartt->module)->row();
                    //$request = json_decode(base64_decode($cart->request));
                    $data['cart'][] = array(
                        'RID' => $session_id.'cart'.$key,
                        'CID' => $cart->cart_id,
                        'REF_ID' => $cart->ref_id,
                        'TYPE' => 'carcart',
                        'NAME' => $cart->pickupCityName.' ('.$cart->Pickup.') - '.$cart->dropoffCityName.' ('.$cart->Dropoff.')',
                        'URL' => WEB_URL,
                        'ADDRESS' => date('d M, Y H:i', $cart->DepartureTime).' - '.date('d M, Y H:i', $cart->ReturnTime),
                        'TOTAL' => $this->account_model->currency_convertor($cart->TotalPrice),
                        'IMAGE' => $cart->CarImage
                    );
                    $GRAND_TOTAL[] = $cart->TotalPrice;
                }else if($cartt->module == 'VACATION'){
                    $cart = $this->cart_model->getCartDataByModule($cartt->cart_id,$cartt->module)->row();
                    $vacation = json_decode(base64_decode($cart->response));
                    $data['cart'][] = array(
                        'RID' => $session_id.'cart'.$key,
                        'CID' => $cart->cart_id,
                        'REF_ID' => $cart->ref_id,
                        'TYPE' => 'vacationcart',
                        'NAME' => $cart->vacCityName.' ('.$cart->city.') - '.date('d M, Y H:i', strtotime($cart->vacDate)),
                        'URL' => WEB_URL,
                        'ADDRESS' => $vacation->package_name.' - '.$vacation->package_type,
                        'TOTAL' => $this->account_model->currency_convertor($cart->TotalPrice),
                        'IMAGE' => $cart->VacationImage
                    );
                    $GRAND_TOTAL[] = $cart->TotalPrice;
                }
            }
            $data['GRAND_TOTAL'] = $this->account_model->currency_convertor(array_sum($GRAND_TOTAL));
        }
        //echo '<pre>';print_r($cart_flight);die;
        echo json_encode($data);
    }

    public function formatResponse($VehicleSearchAvailabilityReq_Res, $aMarkup, $myMarkup){
        $VehicleSearchAvailabilityRes = $VehicleSearchAvailabilityReq_Res['VehicleSearchAvailabilityRes'];
        if(empty($VehicleSearchAvailabilityRes)){
            return false;
        }
        $VehicleSearchRes = $this->xml_to_array->XmlToArray($VehicleSearchAvailabilityRes);
        if(isset($VehicleSearchRes['SOAP:Body']['SOAP:Fault'])){
            $xml_log = array(
                'Api' => 'UAPI',
                'XML_Type' => 'CAR - SEARCH RESULT -VehicleSearchAvailabilityRes ERROR',
                'XML_Request' => $VehicleSearchAvailabilityReq_Res['VehicleSearchAvailabilityReq'],
                'XML_Response' => $VehicleSearchAvailabilityReq_Res['VehicleSearchAvailabilityRes'],
                'Ip_address' => $this->input->ip_address(),
                'XML_Time' => date('Y-m-d H:i:s')
            );
            $this->xml_model->insert_xml_log($xml_log);
            return false;
        }
        $VehicleSearchRes = $VehicleSearchRes['SOAP:Body']['vehicle:VehicleSearchAvailabilityRsp'];
        if(isset($VehicleSearchRes['vehicle:Vehicle'])){
            $ResponseMessage = $VehicleSearchRes['common_v28_0:ResponseMessage'];
        }
        $VehicleDateLocation = $VehicleSearchRes['vehicle:VehicleDateLocation'];
        $VehicleDateLocation_Attr = $VehicleDateLocation['@attributes'];
        $VehicleDateLocation_Attr = json_decode(json_encode($VehicleDateLocation_Attr));
        if(!isset($VehicleSearchRes['vehicle:Vehicle'])){
            $xml_log = array(
                'Api' => 'UAPI',
                'XML_Type' => 'CAR - SEARCH RESULT -VehicleSearchAvailabilityRes ERROR - EMPTY ',
                'XML_Request' => $VehicleSearchAvailabilityReq_Res['VehicleSearchAvailabilityReq'],
                'XML_Response' => $VehicleSearchAvailabilityReq_Res['VehicleSearchAvailabilityRes'],
                'Ip_address' => $this->input->ip_address(),
                'XML_Time' => date('Y-m-d H:i:s')
            );
            $this->xml_model->insert_xml_log($xml_log);
            return false;
        }
        $Vehicles = $VehicleSearchRes['vehicle:Vehicle'];
        //echo '<pre>';print_r($Vehicles);die;
        $i=0;
        foreach ($Vehicles as $key => $Vehicle) {
            $Vehicle_Attr = $Vehicle['@attributes'];
            $Vehicle_Attr = json_decode(json_encode($Vehicle_Attr));

            $VehicleRate = $Vehicle['vehicle:VehicleRate'];
            $VehicleRate_Attr = $VehicleRate['@attributes'];
            if(isset($VehicleRate_Attr['RateGuaranteed'])){
                $RateGuaranteed = $VehicleRate_Attr['RateGuaranteed'];
            }else{
                $RateGuaranteed = '';
            }
            $VehicleRate_Attr = json_decode(json_encode($VehicleRate_Attr));


            if(isset($VehicleRate['vehicle:SupplierRate'])){
                $SupplierRate = $VehicleRate['vehicle:SupplierRate'];
                $SupplierRate_Attr = $SupplierRate['@attributes'];
                $SupplierRate_Attr = json_encode($SupplierRate_Attr);
                $SupplierRate_Attr = json_decode($SupplierRate_Attr);

                

                $CurrencyType = substr($SupplierRate_Attr->RateForPeriod,0,3);
                //echo '<pre>';print_r($VehicleRate_Attr);
                
                
                $TotalPrice = substr($SupplierRate_Attr->EstimatedTotalAmount,3);
                $TotalPrice_Curr = substr($SupplierRate_Attr->EstimatedTotalAmount,0,3);
                $TotalPrice = $this->flight_model->currency_convertor($TotalPrice,$TotalPrice_Curr,CURR);
                $TotalPrice = $this->account_model->PercentageToAmount($TotalPrice,$aMarkup);
                $Markup = $this->account_model->PercentageAmount($TotalPrice,$myMarkup);
                $TotalPrice = $this->account_model->PercentageToAmount($TotalPrice,$myMarkup);
                
                
                $BasePrice = substr($SupplierRate_Attr->BaseRate,3);
                $BasePrice_Curr = substr($SupplierRate_Attr->BaseRate,0,3);
                $BasePrice = $this->flight_model->currency_convertor($BasePrice,$BasePrice_Curr,CURR);
                $BasePrice = $this->account_model->PercentageToAmount($BasePrice,$aMarkup);
                $BasePrice = $this->account_model->PercentageToAmount($BasePrice,$myMarkup);
               

                $ExtraMileageCharge = substr($SupplierRate_Attr->ExtraMileageCharge,3);
                $ExtraMileageCharge_Curr = substr($SupplierRate_Attr->ExtraMileageCharge,0,3);
                $ExtraMileageCharge = $this->flight_model->currency_convertor($ExtraMileageCharge,$ExtraMileageCharge_Curr,CURR);
                $ExtraMileageCharge = $this->account_model->PercentageToAmount($ExtraMileageCharge,$aMarkup);
                $ExtraMileageCharge = $this->account_model->PercentageToAmount($ExtraMileageCharge,$myMarkup);

                if(isset($VehicleRate['vehicle:RateHostIndicator']['@attributes']['InventoryToken'])){
                    $InventoryToken = $VehicleRate['vehicle:RateHostIndicator']['@attributes']['InventoryToken'];
                }else{
                    $InventoryToken = '';
                }
                $fs[$i]['MyMarkup'] = $Markup;
                $fs[$i]['TotalPrice'] = $TotalPrice;
                $fs[$i]['BasePrice'] = $BasePrice;
                $fs[$i]['ExtraMileageCharge'] = $ExtraMileageCharge;
                $fs[$i]['TotalPrice_API'] = $SupplierRate_Attr->EstimatedTotalAmount;
                $fs[$i]['APICurrencyType'] = $CurrencyType;
                $fs[$i]['SITECurrencyType'] = CURR;
                $fs[$i]['PickupLocation'] = $VehicleDateLocation_Attr->PickupLocation;
                $fs[$i]['ReturnLocation'] = $VehicleDateLocation_Attr->ReturnLocation;
                $fs[$i]['PickupDateTime'] = $VehicleDateLocation_Attr->PickupDateTime;
                $fs[$i]['ReturnDateTime'] = $VehicleDateLocation_Attr->ReturnDateTime;
                $fs[$i]['VehicleRateDescription'] = $VehicleRate['vehicle:VehicleRateDescription']['vehicle:Text'];
                $fs[$i]['InventoryToken'] = $InventoryToken;
                $fs[$i]['RateToken'] = $VehicleRate['vehicle:RateHostIndicator']['@attributes']['RateToken'];
                $fs[$i]['RatePeriod'] = $VehicleRate_Attr->RatePeriod;
                $fs[$i]['UnlimitedMileage'] = $VehicleRate_Attr->UnlimitedMileage;
                $fs[$i]['Units'] = $VehicleRate_Attr->Units;
                $fs[$i]['RateSource'] = $VehicleRate_Attr->RateSource;
                $fs[$i]['RateAvailability'] = $VehicleRate_Attr->RateAvailability;
                $fs[$i]['RateCode'] = $VehicleRate_Attr->RateCode;
                $fs[$i]['RateCategory'] = $VehicleRate_Attr->RateCategory;
                $fs[$i]['RateGuaranteed'] = $RateGuaranteed;
                $fs[$i]['VendorCode'] = $Vehicle_Attr->VendorCode;
                $fs[$i]['AirConditioning'] = $Vehicle_Attr->AirConditioning;
                $fs[$i]['TransmissionType'] = $Vehicle_Attr->TransmissionType;
                $fs[$i]['VehicleClass'] = $Vehicle_Attr->VehicleClass;
                $fs[$i]['Category'] = $Vehicle_Attr->Category;
                $fs[$i]['PickupLocation'] = $VehicleSearchRes['vehicle:VehicleDateLocation']['@attributes']['PickupLocation'];
                $fs[$i]['ReturnLocation'] = $VehicleSearchRes['vehicle:VehicleDateLocation']['@attributes']['ReturnLocation'];
                $fs[$i]['PickupDateTime'] = $VehicleSearchRes['vehicle:VehicleDateLocation']['@attributes']['PickupDateTime'];
                $fs[$i]['ReturnDateTime'] = $VehicleSearchRes['vehicle:VehicleDateLocation']['@attributes']['ReturnDateTime'];
                if(isset($Vehicle_Attr->DoorCount)){
                    $DoorCount = $Vehicle_Attr->DoorCount;    
                }else{
                    $DoorCount = '';
                }
                
                $fs[$i]['DoorCount'] = $DoorCount;
                $fs[$i]['Location'] = $Vehicle_Attr->Location;
                $fs[$i]['VendorLocationKey'] = $Vehicle_Attr->VendorLocationKey;
                $fs[$i]['ReturnAtPickup'] = $Vehicle_Attr->ReturnAtPickup;
                
                $i++;
            }
            //echo '<pre>';print_r($fs);die;
        }
        //echo '<pre>';print_r($fs);die;
        return $fs;
    }


    public function cancel($pnr_no){
        $pnr_no = base64_decode(base64_decode($pnr_no));
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1) {
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            //echo '<pre>';print_r($b_data);die;
            if($b_data->booking_status == 'CONFIRMED'){
                $CancelReq_Res = CancelReq($b_data->booking_no);
                $CancelRes = $CancelReq_Res['CancelRes'];
                $CancelRes = $this->xml_to_array->XmlToArray($CancelRes);
                //echo '<pre>';print_r($CancelRes);die;
				 if(isset($CancelRes['SOAP:Body']['SOAP:Fault'])){
            $xml_log = array(
                'Api' => 'UAPI',
                'XML_Type' => 'CAR - CANCELLATION -UniversalRecordCancelRsp ERROR',
                'XML_Request' => $CancelReq_Res['CancelReq'],
                'XML_Response' => $CancelReq_Res['CancelRes'],
                'Ip_address' => $this->input->ip_address(),
                'XML_Time' => date('Y-m-d H:i:s')
            );
            $this->xml_model->insert_xml_log($xml_log);
            return false;
        }
                if(isset($CancelRes['SOAP:Body']['universal:UniversalRecordCancelRsp'])){
                    $CancelRes = $CancelRes['SOAP:Body']['universal:UniversalRecordCancelRsp']['universal:ProviderReservationStatus'];
                    $CancelResAttr = $CancelRes['@attributes'];
                    if($CancelResAttr['Cancelled']){
                        //echo '<pre>';print_r($CancelResAttr);die;
                        $update_booking = array(
                            'booking_status' => 'CANCELED'
                        );
                        $this->booking_model->Update_Booking_Global($pnr_no, $update_booking, 'CAR');
                        $this->cancel_mail_voucher($pnr_no);
                        $response = array('status' => 1);
                        echo json_encode($response);
                    }
                }else{
                    $xml_log = array(
                        'Api' => 'UAPI',
                        'XML_Type' => 'CAR - CANCELLATION -UniversalRecordCancelRsp EMPTY - ERROR',
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
            if($b_data->module == 'CAR'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
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
                
            }
        }
    }
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/car.php */