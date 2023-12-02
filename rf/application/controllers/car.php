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
        $this->load->model('Cart_Model');
        $this->load->library('xml_to_array');
        $this->helpMenuLink = $this->Help_Model->fetchHelpLinks();

        $controller = $this->router->fetch_class();
        parent::validate_modules($controller);
    }

    public function home(){
    	
		$data['banners'] = $this->Help_Model->getHomeSettings();
		$data['portfolio'] = $this->Help_Model->getAllPortfolio();
        $data['discounted_flights'] = $this->flight_model->get_discounted_flights('Flight');
        $data['discounted_hotels'] = $this->flight_model->get_discounted_flights('Hotel');
		$this->load->view('car/car_index',$data);	
    }

	public function index(){
       
		$this->load->view('car/car_index', $data);	
	}

    public function search(){
        $request = $this->input->post();

        if($request['dropoff'] == ''){

                if(strpos($request['pickup'], " (All Airports)")){
                $to_destination=str_replace(" (All Airports)","",$request['pickup']);
                }else{
                $to_destination=$request['pickup'];
                }

        }else{

            if(strpos($request['dropoff'], " (All Airports)")){
            $to_destination=str_replace(" (All Airports)","",$request['dropoff']);
            }else{
            $to_destination=$request['dropoff'];
            }
            
        }


            if(strpos($request['pickup'], " (All Airports)")){
                $from_origin=str_replace(" (All Airports)","",$request['pickup']);
            }else{
                $from_origin=$request['pickup'];
            }
        
            

        $request = array(
            'pickup' => substr(chop(substr($from_origin, -5), ')'), -3),
            'dropoff' => substr(chop(substr($to_destination, -5), ')'), -3),
            'depart_date' => str_replace("/","-",$request['cdepature']),
            'depart_time' => $request['cdepature_time'],
            'depart_min' => $request['cdepature_min'],
            'return_date' => str_replace("/","-",$request['creturn']),
            'return_time' => $request['creturn_time'],
            'return_min' => $request['creturn_min'],
            //'age' => $request['age'],
            'Car_Category' => $request['Car_Category'],
            'Door_Count' => $request['Door_Count'],
            'Transmission' => $request['Transmission'],
            'Fuel_Type' => $request['Fuel_Type'],
            'Vehicle_Class' => $request['Vehicle_Class'],
            'MinPrice' => $request['MinPrice'],
            'MaxPrice' => $request['MaxPrice'],
        );
       // echo '<pre>';print_r($request);die;
        //$data['request_array'] = $request;
        $request = json_encode($request);
        $data['req'] = json_decode($request);
        $data['request']  = base64_encode($request);

      
       
        $VehicleSearchAvailabilityReq_Res = VehicleSearchAvailabilityReq($data['req']);
       
        $aMarkup = $this->account_model->get_markup('CAR'); //get markup
        $aMarkup = $aMarkup['markup'];

        $MyMarkup = $this->account_model->get_my_markup(); //get agent markup
        $myMarkup = $MyMarkup['markup'];

        $results = $this->formatResponse($VehicleSearchAvailabilityReq_Res, $aMarkup, $myMarkup);
       // echo "<pre>";print_r($results);
        $data['cars'] = $results;
       
        $this->load->view('car/car_results', $data);
        
    }



    public function car_search() {


    $request = json_decode(base64_decode($this->input->post('next_request')));
    
    //print_r($request);die;

    if($this->input->post('nextlink')!=null)
    {
        $request->nextlink = $this->input->post('nextlink');
        
    }
    else
    {
        $request->nextlink ='';
       

    }
    

    $VehicleSearchAvailabilityReq_Res = VehicleSearchAvailabilityReq($request);

    $aMarkup = $this->account_model->get_markup('CAR'); //get markup
        $aMarkup = $aMarkup['markup'];

        $MyMarkup = $this->account_model->get_my_markup(); //get agent markup
        $myMarkup = $MyMarkup['markup'];

        $results = $this->formatResponse($VehicleSearchAvailabilityReq_Res, $aMarkup, $myMarkup);


    $data['cars'] = $results;
    $data['request']  = base64_encode(json_encode($request));
    $data['req']  = $request;
    if(isset($results[0]['NextResultReference'])){
   
    $nextlink=$results[0]['NextResultReference'];
    }else{
       $nextlink=''; 
    }
    $Html = $this->load->view('car/ajax_result', $data, TRUE);

    echo json_encode(array('result' => $Html,'nextlink' => $nextlink));
}


    public function GetAgain($request=''){
         $data['request'] = $request;
        $req = base64_decode($request);
         $req = json_decode($req);
         $data['req'] = $req;
        $VehicleSearchAvailabilityReq_Res = VehicleSearchAvailabilityReq($data['req']);

        
        $aMarkup = $this->account_model->get_markup('CAR'); //get markup
        $aMarkup = $aMarkup['markup'];

        $MyMarkup = $this->account_model->get_my_markup(); //get agent markup
        $myMarkup = $MyMarkup['markup'];

        $results = $this->formatResponse($VehicleSearchAvailabilityReq_Res, $aMarkup, $myMarkup);


        if($results){
            $data['cars'] = $results;
           $allview=$this->load->view('car/car_results', $data,TRUE);
        }else{
            $allview=$this->load->view('car/no_result');
        }

         echo json_encode(array('result' => $allview));
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
                $data['voucher_details'] =  $this->booking_model->getBookingvoucherinvoicedetails()->row();
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
                $data['voucher_details'] =  $this->booking_model->getBookingvoucherinvoicedetails()->row();
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
               
                $data['voucher_details'] =  $this->booking_model->getBookingvoucherinvoicedetails()->row();

                 $data['message'] = $this->load->view('car/mail_voucher', $data,TRUE);
                $data['to'] = $data['Booking']->BILLING_EMAIL;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                
                $data['booking_status'] = strtolower($booking->booking_status);
                
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
             
                  $data['voucher_details'] =  $this->booking_model->getBookingvoucherinvoicedetails()->row();
                 $data['message'] = $this->load->view('car/mail_invoice', $data,TRUE);
                $data['to'] = $data['Booking']->BILLING_EMAIL;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                

                $data['booking_status'] = strtolower($booking->booking_status);
               
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
        $car = $this->input->post('temp_d');
        $car = json_decode(base64_decode($car));
 $this->Cart_Model->removeAllCart();
        $request = $this->input->post('temp_r');
        $request = json_decode(base64_decode($request));
        


        $CarImage = $this->input->post('temp_i');
         //echo '<pre>';print_r($request);
        // echo '<pre>';print_r($car);die;
        
        //echo '<pre>';print_r($first_seg);echo $first_seg->Origin;
        $pickupCityName =  $this->flight_model->get_airport_cityname($request->pickup);
        $dropoffCityName =  $this->flight_model->get_airport_cityname($request->dropoff);
        
        $DepartureDateTime = $this->flight_model->get_unixtimestamp($car->PickupDateTime);
        $ReturnDateTime = $this->flight_model->get_unixtimestamp($car->ReturnDateTime);

        //$DepartureDateTime = $
        $cart_car = array(
            'request' => $this->input->post('temp_r'),
            'response' => $this->input->post('temp_d'),
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
               if($cartt->module == 'CAR'){
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
                }
            }
            $data['GRAND_TOTAL'] = $this->account_model->currency_convertor(array_sum($GRAND_TOTAL));
        }
        //echo '<pre>';print_r($cart_flight);die;
        //echo json_encode($data);
         $data_C_URL = WEB_URL.'/booking/'.$session_id;
       redirect($data_C_URL);
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
        $NextResultReference='';
        $VehicleSearchRes = $VehicleSearchRes['SOAP:Body']['vehicle:VehicleSearchAvailabilityRsp'];
        if(isset($VehicleSearchRes['vehicle:Vehicle'])){
            $ResponseMessage = isset($VehicleSearchRes['vehicle_v31_0:ResponseMessage'])?$VehicleSearchRes['vehicle_v31_0:ResponseMessage']:'';
        }
        if(isset($VehicleSearchRes['common_v31_0:NextResultReference'])){
                $NextResultReference = isset($VehicleSearchRes['common_v31_0:NextResultReference']['@content'])?$VehicleSearchRes['common_v31_0:NextResultReference']['@content']:'';
        }
        
        $VehicleDateLocation = $VehicleSearchRes['vehicle:VehicleDateLocation'];
        $VehicleDateLocation_Attr = $VehicleDateLocation['@attributes'];
        $VehicleDateLocation_Attr = json_decode(json_encode($VehicleDateLocation_Attr));
        $VendorLocation = isset($VehicleDateLocation['vehicle:VendorLocation'])?$VehicleDateLocation['vehicle:VendorLocation']:'';
        $VendorLocation_attr = isset($VendorLocation['@attributes'])?$VendorLocation['@attributes']:'';
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
         $Vehicles_full_det = $VehicleSearchRes['vehicle:Vehicle']; $details=array();
        

       if(array_key_exists(0,$Vehicles_full_det)){

            $Vehicles = $VehicleSearchRes['vehicle:Vehicle'];

        }else{
            $Vehicles = array(0 =>$VehicleSearchRes['vehicle:Vehicle']);
          
        }
//echo "<pre>";print_r($Vehicles_full_det);
 
        $i=0;
        foreach ($Vehicles as  $Vehicle) {
        


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

$for_car_Rates=isset($VehicleRate['vehicle:SupplierRate'])?$VehicleRate['vehicle:SupplierRate']:$VehicleRate['vehicle:ApproximateRate'];
            if(isset($for_car_Rates)){
                $SupplierRate = $for_car_Rates;
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
                $fs[$i]['NextResultReference'] = $NextResultReference;
                
                $fs[$i]['TotalPrice_API'] = $SupplierRate_Attr->EstimatedTotalAmount;
                $fs[$i]['APICurrencyType'] = $CurrencyType;
                $fs[$i]['SITECurrencyType'] = CURR;
                $fs[$i]['PickupLocation'] = $VehicleDateLocation_Attr->PickupLocation;
                $fs[$i]['ReturnLocation'] = $VehicleDateLocation_Attr->ReturnLocation;
                $fs[$i]['PickupDateTime'] = $VehicleDateLocation_Attr->PickupDateTime;
                $fs[$i]['ReturnDateTime'] = $VehicleDateLocation_Attr->ReturnDateTime;
                $fs[$i]['VehicleRateDescription'] = isset($VehicleRate['vehicle:VehicleRateDescription']['vehicle:Text'])?$VehicleRate['vehicle:VehicleRateDescription']['vehicle:Text']:'';
                $fs[$i]['InventoryToken'] =$details['InventoryToken']= $InventoryToken;
                $fs[$i]['RateToken'] =$details['RateToken']= $VehicleRate['vehicle:RateHostIndicator']['@attributes']['RateToken'];
                $fs[$i]['RatePeriod'] =$details['RatePeriod']= $VehicleRate_Attr->RatePeriod;
                $fs[$i]['UnlimitedMileage'] = isset($VehicleRate_Attr->UnlimitedMileage)?$VehicleRate_Attr->UnlimitedMileage:'';
                $fs[$i]['Units'] = $VehicleRate_Attr->Units;
                $fs[$i]['RateSource'] = $VehicleRate_Attr->RateSource;
                $fs[$i]['RateAvailability'] = $VehicleRate_Attr->RateAvailability;
                $fs[$i]['RateCode'] =$details['RateCode']= $VehicleRate_Attr->RateCode;
                $fs[$i]['RateCategory'] =$details['RateCategory']= $VehicleRate_Attr->RateCategory;
                $fs[$i]['RateGuaranteed'] = $RateGuaranteed;
                $fs[$i]['VendorCode'] = $details['VendorCode']=$Vehicle_Attr->VendorCode;
                $fs[$i]['AirConditioning'] =$details['AirConditioning']= $Vehicle_Attr->AirConditioning;
                $fs[$i]['TransmissionType'] =$details['TransmissionType']= $Vehicle_Attr->TransmissionType;
                $fs[$i]['VehicleClass']=$details['VehicleClass'] = $Vehicle_Attr->VehicleClass;
                $fs[$i]['Category']=$details['Category'] = $Vehicle_Attr->Category;
                $fs[$i]['PickupLocation'] =$details['PickupLocation']= $VehicleSearchRes['vehicle:VehicleDateLocation']['@attributes']['PickupLocation'];
                $fs[$i]['ReturnLocation'] =$details['ReturnLocation']= $VehicleSearchRes['vehicle:VehicleDateLocation']['@attributes']['ReturnLocation'];
                $fs[$i]['PickupDateTime'] =$details['PickupDateTime']= $VehicleSearchRes['vehicle:VehicleDateLocation']['@attributes']['PickupDateTime'];
                $fs[$i]['ReturnDateTime'] =$details['ReturnDateTime']= $VehicleSearchRes['vehicle:VehicleDateLocation']['@attributes']['ReturnDateTime'];
                if(isset($VehicleRate['vehicle:RateInclusions']['vehicle:IncludedItem'][0])){
                    $includeted_items=$VehicleRate['vehicle:RateInclusions']['vehicle:IncludedItem'];
                    $includeted_item_arr=array();
                    foreach ($includeted_items as $includeted_item) {
                       $includeted_item_arr[]=$includeted_item['@attributes']['Description'];
                    }
                }else{
                     $includeted_item_arr=array();
                }
                $fs[$i]['IncludedItems']=$includeted_item_arr;     
            
        
                if(isset($Vehicle_Attr->DoorCount)){
                    $DoorCount = $Vehicle_Attr->DoorCount;    
                }else{
                    $DoorCount = '';
                }
                
                $fs[$i]['DoorCount'] =$details['DoorCount']= $DoorCount;
                $fs[$i]['Location'] = $Vehicle_Attr->Location;
                $fs[$i]['VendorLocationKey'] =$details['VendorLocationKey']= $Vehicle_Attr->VendorLocationKey;
                $fs[$i]['ReturnAtPickup'] = $Vehicle_Attr->ReturnAtPickup;
                $fs[$i]['ProviderCode'] =$details['ProviderCode']= isset($VendorLocation_attr['ProviderCode'])?$VendorLocation_attr['ProviderCode']:'';
                $fs[$i]['VendorLocationID'] =$details['VendorLocationID']= isset($VendorLocation_attr['VendorLocationID'])?$VendorLocation_attr['VendorLocationID']:'';
                $fs[$i]['Policy'] =$this->VehiclePolicy($details);
                $fs[$i]['rules'] =$this->Vehicle_rules($details);

               
                
               
            }
             $i++;
            //echo '<pre>';print_r($fs);die;
        }
       // echo '<pre>';print_r($fs);die;
        return $fs;
    }
        public function VehiclePolicy($details){
            
                $Policy=array();
             $VehicleReq_Res=VehicleLocationDetailReq($details);
            $VehicleLocationDetailRes=$VehicleReq_Res['VehicleLocationDetailRes'];
             $VehicleLocationDetailRes = $this->xml_to_array->XmlToArray($VehicleLocationDetailRes);
             
        if(isset($VehicleLocationDetailRes['SOAP:Body']['SOAP:Fault'])){
            $xml_log = array(
                'Api' => 'UAPI',
                'XML_Type' => 'CAR - SEARCH RESULT -VehicleLocationDetailRes ERROR',
                'XML_Request' => $VehicleReq_Res['VehicleLocationDetailReq'],
                'XML_Response' => $VehicleReq_Res['VehicleLocationDetailRes'],
                'Ip_address' => $this->input->ip_address(),
                'XML_Time' => date('Y-m-d H:i:s')
            );
            $this->xml_model->insert_xml_log($xml_log);
            return false;
        }else{

            if(isset($VehicleLocationDetailRes['SOAP:Body']['vehicle:VehicleLocationDetailRsp']['vehicle:VehiclePolicy']['vehicle:VehicleDetail'])){
                $VehiclePolicy=$VehicleLocationDetailRes['SOAP:Body']['vehicle:VehicleLocationDetailRsp']['vehicle:VehiclePolicy']['vehicle:VehicleDetail'];
                
                foreach ($VehiclePolicy as $VehiclePolicy) {
                    if($VehiclePolicy['@attributes']['Class']==$details['VehicleClass'] && $VehiclePolicy['@attributes']['Category']==$details['Category']){
                    $Policy['BagCount']=isset($VehiclePolicy['@attributes']['BagCount'])?$VehiclePolicy['@attributes']['BagCount']:"N/A";
                    $Policy['Code']=isset($VehiclePolicy['@attributes']['Code'])?$VehiclePolicy['@attributes']['Code']:"N/A";
                    $Policy['PassengerCount']=isset($VehiclePolicy['@attributes']['PassengerCount'])?$VehiclePolicy['@attributes']['PassengerCount']:"N/A";
                    $Policy['NumberOfDoors']=isset($VehiclePolicy['@attributes']['NumberOfDoors'])?$VehiclePolicy['@attributes']['NumberOfDoors']:"N/A";
                    $Policy['MakeModel']=isset($VehiclePolicy['@attributes']['MakeModel'])?$VehiclePolicy['@attributes']['MakeModel']:"N/A";
                }
                }
            }

        }

        return $Policy;

    }


     public function Vehicle_rules($details){
            
                $rules=array();
             $VehicleReq_Res=VehicleRulesReq($details);
            $VehicleRulesRes=$VehicleReq_Res['VehicleRulesRes'];
             $VehicleRulesRes = $this->xml_to_array->XmlToArray($VehicleRulesRes);
        if(isset($VehicleRulesRes['SOAP:Body']['SOAP:Fault'])){
            $xml_log = array(
                'Api' => 'UAPI',
                'XML_Type' => 'CAR - SEARCH RESULT -VehiclerulesRes ERROR',
                'XML_Request' => $VehicleReq_Res['VehicleRulesReq'],
                'XML_Response' => $VehicleReq_Res['VehicleRulesRes'],
                'Ip_address' => $this->input->ip_address(),
                'XML_Time' => date('Y-m-d H:i:s')
            );
            $this->xml_model->insert_xml_log($xml_log);
            return false;
        }else{

            if(isset($VehicleRulesRes['SOAP:Body']['vehicle:VehicleRulesRsp']['vehicle:VehicleCharge'])){
                $VehiclePolicys=$VehicleRulesRes['SOAP:Body']['vehicle:VehicleRulesRsp']['vehicle:VehicleCharge'];
               // print_r($VehiclePolicys);
                $i=0;
                foreach ($VehiclePolicys as $VehiclePolicy) {
                    $rules[$i]['Category']=isset($VehiclePolicy['@attributes']['Category'])?$VehiclePolicy['@attributes']['Category']:"N/A";
                    $rules[$i]['IncludedInRate']=isset($VehiclePolicy['@attributes']['IncludedInRate'])?$VehiclePolicy['@attributes']['IncludedInRate']:"N/A";
                    $rules[$i]['Name']=isset($VehiclePolicy['@attributes']['Name'])?$VehiclePolicy['@attributes']['Name']:"N/A";
                    $rules[$i]['Type']=isset($VehiclePolicy['@attributes']['Type'])?$VehiclePolicy['@attributes']['Type']:"N/A";
                    
                $i++;
                }
            }

        }

        return $rules;

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
                
                $data['to'] = $booking->BILLING_EMAIL;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                $email_type = 'ApartmentVoucher';
                $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
                $data['booking_status'] = strtolower($booking->booking_status);
                
                $Response = $this->email_model->sendmail_carcancel($data);
                $response = array('status' => 1);
                
            }
        }
    }
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/car.php */
