<?php if (!defined('BASEPATH'))exit('No direct script access allowed');
class Orders extends CI_Controller {

    protected $domain_id;

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Admin_Model');
        $this->load->model('Domain_Model');
        $this->load->model('B2c_Model');
        $this->load->model('Email_Model');
        $this->load->model('Home_Model');
        $this->load->model('Support_Model');
	    $this->load->model('booking_model');
        $this->load->model('manage_orders_model');
        $this->check_isvalidated();
        $this->load->library('form_validation');

        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        //$this->domain_id = $this->checkuserdomain();

        if ($this->session->userdata('admin_logged_in')) {
            $this->load->helper('url');
            $controller = $this->router->fetch_class();
            parent::check_modules($controller);
            $this->load->model('Privilege_Model');
            $sub_admin_id = $this->session->userdata('admin_id');
            $this->data['modules'] = $this->Privilege_Model->get_privileges_by_sub_admin_id($sub_admin_id)->result();
        }
    }

    private function check_isvalidated() {
        if (!$this->session->userdata('admin_logged_in') && !$this->session->userdata('sa_logged_in')) {
            redirect('login/index');
        }
    }

    public function b2c_orders(){
        $data['Bookings'] = $this->booking_model->getAllBookings_b2c()->result();
        //echo '<pre>';print_r($data['Bookings']);
        $this->load->view('orders/b2c_orders',$data);
    }
	  public function b2b_orders(){
        $data['Bookings'] = $this->booking_model->getAllBookings_b2b()->result();
    //   echo '<pre>';print_r($data['Bookings']);
        $this->load->view('orders/b2b_orders',$data);
    }
	  public function guest_orders(){
        $data['Bookings'] = $this->booking_model->getAllBookings_guest()->result();
        //echo '<pre>';print_r($data['Bookings']);
        $this->load->view('orders/guest_orders',$data);
    }
	 public function index(){
        $data['Bookings'] = $this->booking_model->getAllBookings()->result();
        //echo '<pre>';print_r($data['Bookings']);
        $this->load->view('orders/orders',$data);
    }
    public function voucher($module,$pnr_no){
        $pnr_no = base64_decode(base64_decode($pnr_no));
        $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($pnr_no,$module)->row();
        $data['voucher_details'] =  $this->booking_model->getBookingvoucherinvoicedetails()->row();
        //echo '<pre>';print_r($data['Booking']);die;
        if($module == 'APARTMENT'){
            $data['Map'] = $this->getStaticMap($data['Booking']->PROP_LATITUDE, $data['Booking']->PROP_LONGITUDE);
            $data['host_profile_link'] = WEB_URL.'users/show/'.$data['Booking']->user_id;
            $data['apt_link'] = WEB_URL.'apartment/rooms/'.$data['Booking']->PROP_ID;
            $this->load->view('orders/apartment_voucher',$data);
        }else if($module == 'FLIGHT'){
            $this->load->view('orders/flight_voucher',$data);
        }else if($module == 'HOTEL'){

            $checkin_date = strtotime($booking->checkin);
            $checkout_date = strtotime($booking->checkout);
                
            $absDateDiff = abs($checkout_date - $checkin_date);
            $data['number_of_nights'] = floor($absDateDiff/(60*60*24));

            $this->load->view('orders/hotel_voucher',$data);
        }else if($module == 'CAR'){
			  
            $this->load->view('orders/car_voucher',$data);
        }else if($module == 'VACATION'){
            $this->load->view('orders/vacation_voucher',$data);
        }
        
    }

    public function invoice($module,$pnr_no){
        $pnr_no = base64_decode(base64_decode($pnr_no));
        $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($pnr_no,$module)->row();
        //echo '<pre>';print_r($data['Booking']);die;
        if($module == 'APARTMENT'){
            $data['Map'] = $this->getStaticMap($data['Booking']->PROP_LATITUDE, $data['Booking']->PROP_LONGITUDE);
            $data['host_profile_link'] = WEB_URL.'users/show/'.$data['Booking']->user_id;
            $data['apt_link'] = WEB_URL.'apartment/rooms/'.$data['Booking']->PROP_ID;
            $data['Transaction'] = $this->booking_model->getBookingApartmentTransaction($pnr_no)->row();
            $this->load->view('orders/apartment_invoice',$data);
        }else if($module == 'FLIGHT'){
            $this->load->view('orders/flight_voucher',$data);
        }else if($module == 'HOTEL'){

            $checkin_date = strtotime($booking->checkin);
            $checkout_date = strtotime($booking->checkout);
                
            $absDateDiff = abs($checkout_date - $checkin_date);
            $data['number_of_nights'] = floor($absDateDiff/(60*60*24));

            $this->load->view('orders/hotel_voucher',$data);
        }else if($module == 'CAR'){
              
            $this->load->view('orders/car_voucher',$data);
        }else if($module == 'VACATION'){
            $this->load->view('orders/vacation_voucher',$data);
        }
        
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
        $url="http://maps.googleapis.com/maps/api/staticmap?zoom=13&size=627x327&maptype=ROADMAP&".urlencode("center")."=".$locstring."&sensor=false";
        return $url;
    }

    function checkuserdomain() {
        $domain_id = $this->session->userdata('domain_id');
        if (!empty($domain_id)) {
            return $domain_id;
        } else {
            return false;
        }
    }

    public function mail_invoice($module,$pnr_no) {
         $pnr_no = base64_decode(base64_decode($pnr_no));
        $data['Booking'] = $booking = $this->booking_model->getBooking($pnr_no)->row();
        $data['Transaction'] = $this->booking_model->getBookingApartmentTransaction($pnr_no)->row();
        $data['email_access'] = $this->Email_Model->get_email_acess();
        $email_type = 'ApartmentUserInvoice';
        $data['email_template'] = $this->Email_Model->get_email_template($email_type)->row();
        $data['email'] = $this->input->post('iemail');
        //$data['user_data'] = $this->account_model->GetUserData($Booking->PROP_USER_TYPE, $Booking->PROP_USER_ID)->row();
        $data['social_url'] = array(
            'facebook_social_url' => 'https://www.facebook.com',
            'twitter_social_url' => 'https://twitter.com',
            'google_social_url' => 'https://google.com',
        );
       $this->Email_Model->sendmail_apartmentUserInvoice($data);
         redirect('orders/b2c_orders');
    }

    public function mail_voucher($module,$pnr_no) {
        $pnr_no = base64_decode(base64_decode($pnr_no));
        $data['Booking'] = $booking = $this->booking_model->getBooking($pnr_no)->row();
        $data['Map'] = $this->getStaticMap($data['Booking']->PROP_LATITUDE, $data['Booking']->PROP_LONGITUDE);
        $data['host_profile_link'] = WEB_URL.'users/show/'.$data['Booking']->user_id;
        $data['apt_link'] = WEB_URL.'apartment/rooms/'.$data['Booking']->PROP_ID;
        $data['Transaction'] = $this->booking_model->getBookingApartmentTransaction($pnr_no)->row();
        $data['email_access'] = $this->Email_Model->get_email_acess();
        $email_type = 'ApartmentVoucher';
        $data['email_template'] = $this->Email_Model->get_email_template($email_type)->row();
        $data['host_data'] = $this->booking_model->GetUserData($booking->PROP_USER_TYPE, $booking->PROP_USER_ID)->row();
        $data['social_url'] = array(
            'facebook_social_url' => 'https://www.facebook.com',
            'twitter_social_url' => 'https://twitter.com',
            'google_social_url' => 'https://google.com',
        );
        $data['email'] = $this->input->post('vemail');
        $this->Email_Model->sendmail_apartmentVoucher($data);
        redirect('orders/b2c_orders');

    }

     public function flight_mail_invoice($module,$pnr_no){
        $pnr_no = base64_decode(base64_decode($pnr_no));
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1){
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if($b_data->module == 'FLIGHT'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
                $data['message'] = $this->load->view('orders/flight/mail_invoice', $data,TRUE);
                $data['to'] = $this->input->post('fiemail');
                $data['email_access'] = $this->Email_Model->get_email_acess();
                $email_type = 'ApartmentUserInvoice';
                $data['email_template'] = $this->Email_Model->get_email_template($email_type)->row();
                $data['booking_status'] = strtolower($booking->booking_status);
                $data['social_url'] = array(
                    'facebook_social_url' => 'https://www.facebook.com',
                    'twitter_social_url' => 'https://twitter.com',
                    'google_social_url' => 'https://google.com',
                );
                $this->Email_Model->sendmail_flightInvoice($data);
               redirect('orders/b2c_orders');
            }
        }else{
            redirect('orders/b2c_orders');
        }
    }

    public function flight_mail_voucher($module,$pnr_no){
        $pnr_no = base64_decode(base64_decode($pnr_no));
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1){
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if($b_data->module == 'FLIGHT'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
                $data['message'] = $this->load->view('orders/flight/mail_voucher', $data,TRUE);
                $data['to'] = $this->input->post('fvemail');
                $data['email_access'] = $this->Email_Model->get_email_acess();
                $email_type = 'ApartmentVoucher';
                $data['email_template'] = $this->Email_Model->get_email_template($email_type)->row();
                $data['booking_status'] = strtolower($booking->booking_status);
                $data['social_url'] = array(
                    'facebook_social_url' => 'https://www.facebook.com',
                    'twitter_social_url' => 'https://twitter.com',
                    'google_social_url' => 'https://google.com',
                );
                $Response = $this->Email_Model->sendmail_flightVoucher($data);
                redirect('orders/b2c_orders');
            }
        }else{
            redirect('orders/b2c_orders');
        }
    }

    public function hotel_mail_voucher($module,$pnr_no){
        $pnr_no = base64_decode(base64_decode($pnr_no));
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


                $getHotelTemplateRow = $this->Email_Model->get_email_template('HOTEL_BOOKING_VOUCHER')->row();
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

                $data['to'] = $this->input->post('hvemail');
                $data['email_access'] = $this->Email_Model->get_email_acess();
                $email_type = 'ApartmentVoucher';
                $data['email_template'] = $this->Email_Model->get_email_template($email_type)->row();
                $data['social_url'] = array(
                    'facebook_social_url' => 'https://www.facebook.com',
                    'twitter_social_url' => 'https://twitter.com',
                    'google_social_url' => 'https://google.com',
                );
                $this->Email_Model->sendmail_hotelVoucher($data);
               redirect('orders/b2c_orders');
            }
        }else{
            redirect('orders/b2c_orders');
        }
    }

    public function hotel_mail_invoice($module,$pnr_no){
        $pnr_no = base64_decode(base64_decode($pnr_no));
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1){
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if($b_data->module == 'HOTEL'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
                $data['global'] = $booking1 = $this->booking_model->getBookingPnr($pnr_no)->row();
                $checkin_date = strtotime($booking->checkin);
                $checkout_date = strtotime($booking->checkout);
                
                $absDateDiff = abs($checkout_date - $checkin_date);
                $data['number_of_nights'] = floor($absDateDiff/(60*60*24));
                $data['message'] = $this->load->view('orders/hotel/mail_invoice', $data,TRUE);
                $data['to'] = $this->input->post('hiemail');
                $data['email_access'] = $this->Email_Model->get_email_acess();
                $email_type = 'ApartmentUserInvoice';
                $data['email_template'] = $this->Email_Model->get_email_template($email_type)->row();
                $data['booking_status'] = strtolower($booking->booking_status);
                $data['social_url'] = array(
                    'facebook_social_url' => 'https://www.facebook.com',
                    'twitter_social_url' => 'https://twitter.com',
                    'google_social_url' => 'https://google.com',
                );
               $this->Email_Model->sendmail_flightInvoice($data);
               redirect('orders/b2c_orders');
            }
        }else{
           redirect('orders/b2c_orders');
        }
    }

    public function car_mail_voucher($module,$pnr_no){
        $pnr_no = base64_decode(base64_decode($pnr_no));
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1){
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if($b_data->module == 'CAR'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
                $data['global'] = $booking = $this->booking_model->getBookingPnr($pnr_no)->row();
                $data['message'] = $this->load->view('orders/car/mail_voucher', $data,TRUE);
                $data['to'] = $this->input->post('cvemail');
                $data['email_access'] = $this->Email_Model->get_email_acess();
                $email_type = 'ApartmentVoucher';
                $data['email_template'] = $this->Email_Model->get_email_template($email_type)->row();
                $data['booking_status'] = strtolower($booking->booking_status);
                $data['social_url'] = array(
                    'facebook_social_url' => 'https://www.facebook.com',
                    'twitter_social_url' => 'https://twitter.com',
                    'google_social_url' => 'https://google.com',
                );
                $this->Email_Model->sendmail_carVoucher($data);
               redirect('orders/b2c_orders');
            }
        }else{
            redirect('orders/b2c_orders');
        }
    }

    public function car_mail_invoice($module,$pnr_no){
        $pnr_no = base64_decode(base64_decode($pnr_no));
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1){
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if($b_data->module == 'CAR'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
                $data['global'] = $booking = $this->booking_model->getBookingPnr($pnr_no)->row();
                $data['message'] = $this->load->view('orders/car/mail_invoice', $data,TRUE);
                $data['to'] = $this->input->post('ciemail');
                $data['email_access'] = $this->Email_Model->get_email_acess();
                $email_type = 'ApartmentInvoice';
                $data['email_template'] = $this->Email_Model->get_email_template($email_type)->row();
                $data['booking_status'] = strtolower($booking->booking_status);
                $data['social_url'] = array(
                    'facebook_social_url' => 'https://www.facebook.com',
                    'twitter_social_url' => 'https://twitter.com',
                    'google_social_url' => 'https://google.com',
                );
                $this->Email_Model->sendmail_carInvoice($data);
                redirect('orders/b2c_orders');
            }
        }else{
           redirect('orders/b2c_orders');
        }
    }
    public function vacation_mail_voucher($module,$pnr_no){
        $pnr_no = base64_decode(base64_decode($pnr_no));
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1){
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if($b_data->module == 'VACATION'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
                $data['global'] = $booking = $this->booking_model->getBookingPnr($pnr_no)->row();
                $data['message'] = $this->load->view('orders/vacation/mail_voucher', $data,TRUE);
                $data['to'] = $this->input->post('vvemail');
                $data['email_access'] = $this->Email_Model->get_email_acess();
                $email_type = 'ApartmentVoucher';
                $data['email_template'] = $this->Email_Model->get_email_template($email_type)->row();
                $data['booking_status'] = strtolower($booking->booking_status);
                $data['social_url'] = array(
                    'facebook_social_url' => 'https://www.facebook.com',
                    'twitter_social_url' => 'https://twitter.com',
                    'google_social_url' => 'https://google.com',
                );
                $this->Email_Model->sendmail_carVoucher($data);
                redirect('orders/b2c_orders');
            }
        }else{
            redirect('orders/b2c_orders');
        }
    }

    public function vacation_mail_invoice($module,$pnr_no){
        $pnr_no = base64_decode(base64_decode($pnr_no));
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1){
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if($b_data->module == 'VACATION'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
                $data['global'] = $booking = $this->booking_model->getBookingPnr($pnr_no)->row();
                $data['message'] = $this->load->view('vacation/mail_invoice', $data,TRUE);
                $data['to'] = $this->input->post('viemail');
                $data['email_access'] = $this->Email_Model->get_email_acess();
                $email_type = 'ApartmentVoucher';
                $data['email_template'] = $this->Email_Model->get_email_template($email_type)->row();
                $data['booking_status'] = strtolower($booking->booking_status);
                $data['social_url'] = array(
                    'facebook_social_url' => 'https://www.facebook.com',
                    'twitter_social_url' => 'https://twitter.com',
                    'google_social_url' => 'https://google.com',
                );
                $this->Email_Model->sendmail_carInvoice($data);
                redirect('orders/b2c_orders');
            }
        }else{
             redirect('orders/b2c_orders');
        }
    }

    public function refund($module,$pnr_no){
        $pnr_no = base64_decode(base64_decode($pnr_no));
        $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($pnr_no,$module)->row();
        //echo '<pre>';print_r($data['Booking']);die;
        if($module == 'APARTMENT'){
            $data['Map'] = $this->getStaticMap($data['Booking']->PROP_LATITUDE, $data['Booking']->PROP_LONGITUDE);
            $data['host_profile_link'] = WEB_URL.'users/show/'.$data['Booking']->user_id;
            $data['apt_link'] = WEB_URL.'apartment/rooms/'.$data['Booking']->PROP_ID;
            $this->load->view('orders/refund/apartment',$data);
        }else if($module == 'FLIGHT'){
            $this->load->view('orders/refund/flight',$data);
        }else if($module == 'HOTEL'){

            $checkin_date = strtotime($booking->checkin);
            $checkout_date = strtotime($booking->checkout);
                
            $absDateDiff = abs($checkout_date - $checkin_date);
            $data['number_of_nights'] = floor($absDateDiff/(60*60*24));

            $this->load->view('orders/refund/hotel',$data);
        }else if($module == 'CAR'){
              
            $this->load->view('orders/refund/car',$data);
        }else if($module == 'VACATION'){
            $this->load->view('orders/refund/vacation',$data);
        }
        
    }
    public function refund_amount($module,$pnr_no){
        $input = $this->input->post();
        $new_pnr_no = base64_decode(base64_decode($pnr_no));
        if(!empty($input))
        {
            $array = array();
            $array['refund_subject'] = $input['refund_subject'];
            $array['refund'] = $input['refund'];
            $array['refund_date'] = date('Y-m-d H:i:s');
            if($input['amount'] == '1')
            {
                $array['refund_amount'] = $input['full_amount'];
            }elseif($input['amount'] == '0')
            {
                $array['refund_amount'] = $input['other_amount'];
            }
            $array['refund_status'] = '1';
            $this->booking_model->updateRefundAmount($array, $module, $new_pnr_no);

            $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($new_pnr_no,$module)->row();
            $data['to'] = $booking->RES_GUEST_EMAIL;
            $data['email_access'] = $this->Email_Model->get_email_acess();
            $email_type = 'refund_email';
            $data['email_template'] = $this->Email_Model->get_email_template($email_type)->row();
            $data['social_url'] = array(
                    'facebook_social_url' => 'https://www.facebook.com',
                    'twitter_social_url' => 'https://twitter.com',
                    'google_social_url' => 'https://google.com',
                );
            $this->Email_Model->sendmail_refund($data);

            redirect('orders/b2c_orders');
        }else{
            redirect('orders/refund/'.$module.'/'.$pnr_no);
        }
                
    }

    public function cancel($module,$pnr_no){
        $pnr_no = base64_decode(base64_decode($pnr_no));
        $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($pnr_no,$module)->row();
        //echo '<pre>';print_r($data['Booking']);die;
        if($module == 'APARTMENT'){
            $data['Map'] = $this->getStaticMap($data['Booking']->PROP_LATITUDE, $data['Booking']->PROP_LONGITUDE);
            $data['host_profile_link'] = WEB_URL.'users/show/'.$data['Booking']->user_id;
            $data['apt_link'] = WEB_URL.'apartment/rooms/'.$data['Booking']->PROP_ID;
            $this->load->view('orders/cancel/apartment',$data);
        }else if($module == 'FLIGHT'){
            $this->load->view('orders/cancel/flight',$data);
        }else if($module == 'HOTEL'){

            $checkin_date = strtotime($booking->checkin);
            $checkout_date = strtotime($booking->checkout);
                
            $absDateDiff = abs($checkout_date - $checkin_date);
            $data['number_of_nights'] = floor($absDateDiff/(60*60*24));

            $this->load->view('orders/cancel/hotel',$data);
        }else if($module == 'CAR'){
              
            $this->load->view('orders/cancel/car',$data);
        }else if($module == 'VACATION'){
            $this->load->view('orders/cancel/vacation',$data);
        }
        
    }

    public function cancel_ticket($module,$pnr_no){
        $input = $this->input->post();
        $new_pnr_no = base64_decode(base64_decode($pnr_no));
        if(!empty($input))
        {
            $array = $input;
            $booking = $this->booking_model->updateRefundAmount($array, $module, $new_pnr_no);
            redirect('orders/b2c_orders');
        }else{
            redirect('orders/refund/'.$module.'/'.$pnr_no);
        }
                
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
