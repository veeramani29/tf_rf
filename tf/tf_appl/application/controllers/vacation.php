<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vacation extends CI_Controller {
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
        $this->load->model('flight_model');
        $this->load->model('apartment_model');
        $this->load->model('booking_model');
        $this->load->model('email_model');
        $this->helpMenuLink = $this->Help_Model->fetchHelpLinks();
        $controller = $this->router->fetch_class();
        parent::validate_modules($controller);
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
        $this->load->view('vacation/results', $data);
	}

    public function home(){
      
      $data['banners'] = $this->Help_Model->getHomeSettings();
      $data['portfolio'] = $this->Help_Model->getAllPortfolio();
      $data['vacation_types'] = $this->vacation_model->getVacationTypes()->result();
      $this->load->view('vacation/vacation_index',$data); 
    }

    public function search(){
        $request = $this->input->get();
        if($request['vac_city'] != '' && $request['vac_type'] != '' && $request['vac_date'] != ''){
            $city = substr(chop(substr($request['vac_city'], -5), ')'), -3);
            $request = array(
                'city' => $city,
                'type' => $request['vac_type'],
                'date' => $request['vac_date']
            );
            //echo '<pre>';print_r($request);die;
            $query = http_build_query($request);
            $url = WEB_URL.'/vacation/?'.$query;
            redirect($url);
        }else{
            show_404($_SERVER['REQUEST_URI']);
        }
    }

    public function GetResults($request=''){
        $data['req'] = $request;
        $request = base64_decode($request);
        $data['request'] = $request = json_decode($request);
        
        // header("Content-type: text/xml");
        // print_r($VehicleSearchAvailabilityRes);die;  
        $results = $this->vacation_model->get_vacations($request->city, $request->type)->result();
        if($results){
            $data['vacations'] = $results;
            //echo '<pre>';print_r($results);die;
            $this->load->view('vacation/ajax_results', $data);
        }else{
            $this->load->view('vacation/no_result');
        }
    }

    public function detail($id='',$request=''){
        if($id != '' && $request != ''){
            $count = $this->vacation_model->get_vacation_detail($id)->num_rows();
            if($count == 1){
                $data['vacation'] = $this->vacation_model->get_vacation_detail($id)->row();
                $data['days'] = $this->vacation_model->get_vacation_days($id)->result();
                $data['images'] = $this->vacation_model->get_vacation_images($id)->result();
                $data['request'] = $request;

                $this->load->view('vacation/details', $data);
            }else{
                show_404($_SERVER['REQUEST_URI']);
            }
        }else{
            show_404($_SERVER['REQUEST_URI']);
        }
    }

    public function getPrice(){
        //echo '<pre>';print_r($this->input->get());die;
        $guest = $this->input->get('guest');
        $request = $this->input->get('request');
        $date = $this->input->get('date');
        $id = $this->input->get('di');
        $req= base64_decode($request);
        $req = json_decode($req);
        //echo '<pre>';print_r($req);die;
        $vacation = $this->vacation_model->get_vacation_detail($id)->row();
        $aMarkup = $this->account_model->get_markup('VACATION'); //get markup
        $aMarkup = $aMarkup['markup'];
        $MyMarkup = $this->account_model->get_my_markup(); //get agent markup
        $myMarkup = $MyMarkup['markup'];
        $total = $this->account_model->PercentageToAmount($vacation->package_price,$aMarkup);
        $total = $this->account_model->PercentageToAmount($total,$myMarkup);
        $total = $this->account_model->currency_convertor($total);
        if(!empty($guest)){
            $total = $total*$guest;     
        }else{
            $total = $total;
        }
        $request = array(
            'city' => $req->city,
            'type' => $req->type,
            'date' => $date,
            'guests' => $guest
        );
        
        $request = base64_encode(json_encode($request));
   
        $response = array(
            'total' => $total,
            'req' => $request
        );
        echo json_encode($response);
    }

     public function voucher($pnr_no){
        $pnr_no = base64_decode(base64_decode($pnr_no));
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1) {
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if($b_data->module == 'VACATION'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
                $data['global'] = $booking = $this->booking_model->getBookingPnr($pnr_no)->row();
                $this->load->view('vacation/voucher_view', $data);
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
            if($b_data->module == 'VACATION'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
                $data['global'] = $booking = $this->booking_model->getBookingPnr($pnr_no)->row();
                $this->load->view('vacation/invoice_view', $data);
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
            if($b_data->module == 'VACATION'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
                $data['global'] = $booking = $this->booking_model->getBookingPnr($pnr_no)->row();
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
            if($b_data->module == 'VACATION'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
                $data['global'] = $booking = $this->booking_model->getBookingPnr($pnr_no)->row();
                $data['message'] = $this->load->view('vacation/mail_invoice', $data,TRUE);
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
                $Response = $this->email_model->sendmail_carInvoice($data);
                $response = array('status' => 1);
                echo json_encode($response);
            }
        }else{
            $response = array('status' => 0);
            echo json_encode($response);
        }
    }

    public function AddToCart(){
        $request = $this->input->get();
        
        $req = $request['request'];
        $request = json_decode(base64_decode($request['request']));
        //echo '<pre>';print_r($request);die;
        $VacationImage = $this->input->get('image');
        $vacation = $this->vacation_model->get_vacation_detail($this->input->get('id'))->row();
        $vacCityName =  $this->flight_model->get_airport_cityname($vacation->package_cityid);
        $response = base64_encode(json_encode($vacation));
        //$DepartureDateTime = $
        $aMarkup = $this->account_model->get_markup('VACATION'); //get markup
        $aMarkup = $aMarkup['markup'];
        $MyMarkup = $this->account_model->get_my_markup(); //get agent markup
        $myMarkup = $MyMarkup['markup'];
        $price = $this->account_model->PercentageToAmount($vacation->package_price,$aMarkup);
        $Markup = $this->account_model->PercentageAmount($price,$myMarkup);
        $price = $this->account_model->PercentageToAmount($price,$myMarkup);
        if(!empty($request->guests)){
            $total = $price*$request->guests;     
        }else{
            $total = $price;
        }

        
        $cart_vacation = array(
            'request' => $req,
            'response' => $response,
            'city' => $vacation->package_cityid,
            'vacCityName' => $vacCityName,
            'vacDate' => $request->date,
            'VacationImage' => $VacationImage,
            'TotalPrice' => $total,
            'SITE_CURR' => CURR,
            'MyMarkup' => $Markup,
            'TIMESTAMP' => date('Y-m-d H:i:s')
        );
        //echo '<pre/>';print_r($cart_car);die;      
        $booking_cart_id = $this->vacation_model->insert_cart_vacation($cart_vacation);
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
            'module' => 'VACATION',
            'user_type' => $user_type,
            'user_id' => $user_id,
            'session_id' => $session_id,
            'site_curr' => CURR,
            'total' => $price,
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
}

/* End of file welcome.php */
/* Location: ./application/controllers/car.php */