<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apt extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('Auth_Model');
        $this->load->model('apartment_model');
        $this->load->model('apt_model');
        $this->load->helper('apartment_helper');
        $this->load->model('wishlist_model');
        $this->load->model('account_model');
        $this->load->model('Help_Model');
        $this->load->model('email_model');
        $this->load->model('booking_model');
        $this->helpMenuLink = $this->Help_Model->fetchHelpLinks();
        
        $this->load->library(array('table','form_validation','session','javascript'));
        $this->load->library('pagination');
    }

    public function book_it(){
        $this->islogged_in();
        $checkin = $this->input->get('checkin');
        $checkout = $this->input->get('checkout');
        $nights = $this->input->get('nights');
        $adult = $this->input->get('adult');
        $child = $this->input->get('child');
        $infant = $this->input->get('infant');
        $pid = $this->input->get('pid');
        $rent = $this->input->get('rent');
        $curr = CURR;
        $total = $this->input->get('total');
        if($this->session->userdata('b2c_id')){
            $user_type = 3;
            $user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $user_type = 2;
            $user_id = $this->session->userdata('b2b_id');
        }
        $ex_cin = explode('-',$checkin); 
        $ex_cout = explode('-',$checkout); 
        
        $checkin = $ex_cin[2].'-'.$ex_cin[1].'-'.$ex_cin[0];
        $checkout = $ex_cout[2].'-'.$ex_cout[1].'-'.$ex_cout[0];

        $Property = $this->apartment_model->getApartmentDetails($pid)->row();
        $Images = $this->apartment_model->getApartmentImages($pid)->row();
        $cart_apartment = array(
            'PROP_ID' => $pid,
            'PROP_NAME' => $Property->PROP_NAME,
            'PROP_STREETNO' => $Property->PROP_STREETNO,
            'PROP_ADDR1' => $Property->PROP_ADDR1,
            'PROP_ADDR2' => $Property->PROP_ADDR2,
            'PROP_AUTOCOMPLETE_ADDRESS' => $Property->AUTOCOMPLETE_ADDRESS,
            'PROP_APTNO' => $Property->PROP_APTNO,
            'PROP_POSTCODE' => $Property->PROP_POSTCODE,
            'PROP_CITY' => $Property->PROP_CITY,
            'PROP_REGION' => $Property->PROP_REGION,
            'PROP_COUNTRY' => $Property->PROP_COUNTRY,
            'PROP_COUNTRY_NAME' => $Property->COUNTRY_NAME,
            'PROP_LATITUDE' => $Property->PROP_LATITUDE,
            'PROP_LONGITUDE' => $Property->PROP_LONGITUDE,
            'PROP_TYPE_LABEL' => $Property->PROP_TYPE_LABEL,
            'PROP_CIN_TIME' => $Property->PROP_CIN_TIME,
            'PROP_COUT_TIME' => $Property->PROP_COUT_TIME,
            'PROP_INSTANT_BOOK' => $Property->PROP_INSTANT_BOOK,
            'PROP_SHORTDESCRIPTION' => $Property->PROP_SHORTDESCRIPTION,
            'PROP_AREADESCRIPTION' => $Property->PROP_AREADESCRIPTION,
            'PROP_RENTAL_DETAILS' => $Property->PROP_RENTAL_DETAILS,
            'PROP_ARRIVAL_SHEET' => $Property->PROP_ARRIVAL_SHEET,
            'PROP_RATE_CURRENCY' => $Property->PROP_RATE_CURRENCY,
            'PROP_PHOTO' => $Images->PHOTO_CONTENT,
            'PROP_USER_TYPE' => $Property->USER_TYPE,
            'PROP_USER_ID' => $Property->USER_ID,
            'USER_TYPE' => $user_type,
            'USER_ID' => $user_id,
            'RES_CHECK_IN' => $checkin,
            'RES_CHECK_OUT' => $checkout,
            'NIGHTS' => $nights,
            'RES_N_ADULTS' => $adult,
            'RES_N_CHILDREN' => $child,
            'RES_N_BABIES' => $infant,
            'SITE_CURR' => $curr,
            'TOTAL' => $total,
            'RENT_DATA' => $rent,
            'TIMESTAMP' => date('Y-m-d H:i:s')
        );

        $booking_cart_id = $this->apt_model->insert_cart_apartment($cart_apartment);
        $cart_global = array(
            'parent_cart_id' => 0,
            'ref_id' => $booking_cart_id,
            'module' => 'APARTMENT',
            'prop_id' => $pid,
            'user_type' => $user_type,
            'user_id' => $user_id,
            'session_id' => '',
            'site_curr' => $curr,
            'total' => $total,
            'rent_data' => $rent,
            'ip' =>  $this->input->ip_address(),
            'timestamp' => date('Y-m-d H:i:s')
        );
        $cart_global_id = $this->apt_model->insert_cart_global($cart_global);
        redirect(WEB_URL.'/apt/book/'.$cart_global_id);
    }

    public function book($cart_global_id=''){
        $this->islogged_in();
        if($cart_global_id == ''){
             $this->load->view('errors/404');
        }else{
            $count = $this->apt_model->getBookingTemp($cart_global_id)->num_rows();
            if($count == 1){
                $data['countries'] = $this->apt_model->getAllKigoCountries()->result();
                $data['book_temp_data'] = $book_temp_data = $this->apt_model->getBookingTemp($cart_global_id)->row();
                $data['guests'] = $book_temp_data->RES_N_ADULTS+$book_temp_data->RES_N_CHILDREN+$book_temp_data->RES_N_BABIES;
                $data['RentData'] = json_decode($book_temp_data->RENT_DATA);
                $data['cart_global_id'] = $cart_global_id;
                $b2c_id = $this->session->userdata('b2c_id');
                $data['userInfo'] = $this->account_model->getUserInfo($b2c_id)->row();
                
                if(isset($data['book_temp_data']->profile_photo)) {
                    if($data['book_temp_data']->profile_photo == '') {
                        $data['profile_photo'] = ASSETS . 'images/user-avatar.jpg';
                    } else {
                        $data['profile_photo'] = $data['book_temp_data']->profile_photo;
                    }
                } else if(isset($data['book_temp_data']->agent_logo)) {
                    if($data['book_temp_data']->agent_logo == '') {
                        $data['profile_photo'] = ASSETS . 'images/user-avatar.jpg';
                    } else {
                        $data['profile_photo'] = $data['book_temp_data']->agent_logo;
                    }
                } else {
                    $data['profile_photo'] = ASSETS . 'images/user-avatar.jpg';
                }

                /*if($data['book_temp_data']->profile_photo == ''){
                    $data['profile_photo'] = ASSETS.'images/user-avatar.jpg';
                }else{
                    $data['profile_photo'] = $data['book_temp_data']->profile_photo;
                }*/
                


                $this->load->view('apartment/booking', $data);
            }else{
                $this->load->view('errors/404');
            }
        }
    }

    public function checkout(){
        $checkout_form = $this->input->post();
        //print_r($checkout_form);
        $cart_apartment_data = $this->apt_model->getBookingTemp($checkout_form['cid'])->row();
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
            'PROP_PHOTO' => $cart_apartment_data->PROP_PHOTO,
            'PROP_USER_TYPE' => $cart_apartment_data->PROP_USER_TYPE,
            'PROP_USER_ID' => $cart_apartment_data->PROP_USER_ID,
            'USER_TYPE' => $cart_apartment_data->USER_TYPE,
            'USER_ID' => $cart_apartment_data->USER_ID,
            'RES_CHECK_IN' => $cart_apartment_data->RES_CHECK_IN,
            'RES_CHECK_OUT' => $cart_apartment_data->RES_CHECK_OUT,
            'NIGHTS' => $cart_apartment_data->NIGHTS,
            'RES_N_ADULTS' => $cart_apartment_data->RES_N_ADULTS,
            'RES_N_CHILDREN' => $cart_apartment_data->RES_N_CHILDREN,
            'RES_N_BABIES' => $cart_apartment_data->RES_N_BABIES,
            'RES_GUEST_FIRSTNAME' => $checkout_form['first_name'],
            'RES_GUEST_LASTNAME' => $checkout_form['last_name'],
            'RES_GUEST_EMAIL' => $checkout_form['email'],
            'RES_GUEST_PHONE' => $checkout_form['mobile'],
            'RES_COMMENT_GUEST' => $checkout_form['msg_to_host'],
            'RES_GUEST_COUNTRY' => $checkout_form['country'],
            'RES_GUEST_ADDRESS' => $checkout_form['street_address'].', '.$checkout_form['address2'],
            'RES_GUEST_CITY' => $checkout_form['city'],
            'RES_GUEST_STATE' => $checkout_form['state'],
            'RES_GUEST_ZIP' => $checkout_form['zip'],
            'SITE_CURR' => $cart_apartment_data->SITE_CURR,
            'TOTAL' => $cart_apartment_data->TOTAL,
            'RENT_DATA' => $cart_apartment_data->RENT_DATA,
            'TIMESTAMP' => date('Y-m-d H:i:s')
        );
        $booking_apartment_id = $this->apt_model->insert_booking_apartment($booking_apartment);
        $this->apt_model->clearCart($checkout_form['cid']);
        $data['status'] = 1;
        $data['voucher_url'] = WEB_URL.'/apt/booking/'.$booking_apartment_id;
        echo json_encode($data);
    }

    public function booking($booking_apartment_id){
        $count = $this->apt_model->getBookingApartmentTemp($booking_apartment_id)->num_rows();
        if($count == 1){
            $count = $this->apt_model->CheckDuplicateBooking($booking_apartment_id)->num_rows();
            if($count == 0){
                $book_temp_data = $this->apt_model->getBookingApartmentTemp($booking_apartment_id)->row();
                $booking = array(
                    'module' => 'APARTMENT',
                    'ref_id' => $booking_apartment_id,
                    'user_type' => $book_temp_data->USER_TYPE,
                    'amount' => $book_temp_data->TOTAL,
                    'leadpax' => $book_temp_data->RES_GUEST_FIRSTNAME.' '.$book_temp_data->RES_GUEST_LASTNAME,
                    'user_id' => $book_temp_data->USER_ID,
                    'ip' =>  $this->input->ip_address(),
                    'api_status' => 'CONFIRMED',
                    'booking_status' => 'CONFIRMED'
                );
                $bid = $this->apt_model->Booking_Global($booking);
                $pnr_no = 'TAPT00APT000'.$bid;
                $update_booking = array(
                    'pnr_no' => $pnr_no,
                    'booking_no' => 'XXXXXXXXXX'
                );
                $this->apt_model->Update_Booking_Global($booking_apartment_id, $update_booking);
                $this->get_mail_content_apartmentVoucher($pnr_no);
                redirect(WEB_URL.'/apt/confirm/'.$pnr_no);
            }else{
                 $this->load->view('errors/404');
            }
        }else{
             $this->load->view('errors/404');
        }
    }

    public function get_mail_content_apartmentVoucher($pnr_no) {
        $data['Booking'] = $Booking = $this->booking_model->getBooking($pnr_no)->row();
        $data['email_access'] = $this->email_model->get_email_acess()->row();
        $email_type = 'ApartmentVoucher';
        $data['email_template'] = $this->email_model->get_email_template($email_type)->row();

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
        //return $Response;
    }

    public function mail_voucher($pnr_no){
        $Response = $this->get_mail_content_apartmentVoucher($pnr_no);
        echo json_encode($Response);
    }

    public function confirm($pnr_no){
        $count = $this->booking_model->getBooking($pnr_no)->num_rows();
        if($count == 1){
            $data['Booking'] = $this->booking_model->getBooking($pnr_no)->row();
            $data['Map'] = $this->getStaticMap($data['Booking']->PROP_LATITUDE, $data['Booking']->PROP_LONGITUDE);
            $data['host_profile_link'] = WEB_URL.'/users/show/'.$data['Booking']->user_id;
            $data['apt_link'] = WEB_URL.'/apartment/rooms/'.$data['Booking']->PROP_ID;
            $this->load->view('apartment/voucher', $data);
        }else{
             $this->load->view('errors/404');
        }
    }

    public function voucher($pnr_no){
        $count = $this->booking_model->getBooking($pnr_no)->num_rows();
        if($count == 1){
            $data['Booking'] = $this->booking_model->getBooking($pnr_no)->row();
            $data['Map'] = $this->getStaticMap($data['Booking']->PROP_LATITUDE, $data['Booking']->PROP_LONGITUDE);
            $data['host_profile_link'] = WEB_URL.'/users/show/'.$data['Booking']->user_id;
            $data['apt_link'] = WEB_URL.'/apartment/rooms/'.$data['Booking']->PROP_ID;
            $this->load->view('apartment/voucher_view', $data);
        }else{
             $this->load->view('errors/404');
        }
    }

    public function invoice($pnr_no){
        $count = $this->booking_model->getBooking($pnr_no)->num_rows();
        if($count == 1){
            $data['Booking'] = $this->booking_model->getBooking($pnr_no)->row();
            $this->load->view('apartment/invoice_view', $data);
        }else{
             $this->load->view('errors/404');
        }
    }

    public function islogged_in(){
        if (!$this->session->userdata('b2c_id')) {
           redirect(WEB_URL.'/apt/signup_login');
       }
        // }else if($this->session->userdata('b2c_id')){
        //     if($this->session->userdata('b2c_id')){
        //         $user_type = 3;
        //         $user_id = $this->session->userdata('b2c_id');
        //     }
        //     $b2c_data = $this->apt_model->is_signup($user_id)->num_rows();
        //     if($b2c_data->password == ''){
        //         //redirect(WEB_URL.'/apt/signup_login');
        //     }
        // }
    }

   

    public function signup_login(){
        $data['msg'] = 'Please Sign up to book';
        $this->load->view('login',$data);
    }

    public function getStaticMap($lat, $long){
        $locstring='';$firstloc=0;
        $long="77.5667";
        $lat="12.9667";
                        
        if($firstloc==0){
            $locstring=$locstring.$lat.','.$long.'&markers=icon:http://travelapt.hs24.info/assets/images/marker_out.png%7C'.$lat.','.$long;
            $firstloc=1;
        }else{
            $locstring=$locstring.'&markers=icon:http://travelapt.hs24.info/assets/images/marker_out.png%7C'.$lat.','.$long;
        }        
        $url="http://maps.googleapis.com/maps/api/staticmap?zoom=16&size=627x327&maptype=ROADMAP&".urlencode("center")."=".$locstring."&sensor=false";
        return $url;
    }
}

/* End of file apartment.php */
/* Location: ./application/controllers/apartment.php */
