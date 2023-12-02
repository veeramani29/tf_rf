<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 0);
error_reporting(E_ALL);
session_start();
###############################
#   API ID - 1 - roomsxml
#   API ID - 2 - hotelspro
###############################
class Hotel extends CI_Controller {
    private $agentName = '';
    private $companyName = '';
    private $userNo = '';
    public function __construct()
    {
        parent::__construct();	
        $this->load->model('Home_Model');
        $this->load->model('Hotel_Model');
        $this->load->model('Roomsxml_Model');
        $this->load->helper('hotel_helper');
        if(!isset($_SESSION['agent']) || $_SESSION['agent']['logged_in'] != '1'){
            redirect('home/login');
        }
    }
    
    public function search(){
        $_SESSION[session_id()]['hoSearchData'] = '';
        $_SESSION[session_id()]['Hotelspro_data'] = '';
        $_SESSION[session_id()]['Roomsxml_data'] = '';
        $_SESSION[session_id()]['Roomsxml_booking_data'] = '';
        $_SESSION[session_id()]['hofilters'] = '';
        $_SESSION[session_id()]['cancellation_policy'] = '';
        $data['searchData'] = $this->getSearchParams($_GET);
        $_SESSION[session_id()]['hoSearchData'] = $data['searchData'];
        $data['api']=array('1');
        $this->load->view('hotel/search',$data);
    }
    
    public function getSearchParams($data){
        $city = ''; $country = ''; $state = '';
        if($data['cityval'] != '' && $data['hotel_sd'] != '' && $data['hotel_ed'] != ''){
            $destCity = $data['cityval'];
            if (strpos($data['cityval'], ',') !== false){
                $cityDet=explode(',',$_GET['cityval']);
                $count = count($cityDet);
                if($count == 3){
                    $city = $cityDet[0];
                    $country = $cityDet[1];
                    $state = $cityDet[2];
                }else{
                    $city = $cityDet[0];
                    $country = $cityDet[1];
                }
                $destCode = $this->Hotel_Model->getCityDetailsOnName(trim($city), trim($country), trim($state));
                if($destCode != ''){
                    $roomsxml_city_code = $destCode[0]->locId;
                    $hotelspro_city_code = $destCode[1]->locId;
                }else{
                    $roomsxml_city_code = '';
                    $hotelspro_city_code = '';
                }
            } else {
                $roomsxml_city_code = '';
                $hotelspro_city_code = '';
            }
            
            $sd = $data['hotel_sd'];
            $ed = $data['hotel_ed'];
            $adult = $data['adult'];
            $child = $data['child'];
            if(isset($data['child_age'])){
                $child_age = $data['child_age'];
            } else $child_age = '';
            $room_count = $data['room_count'];
            $adult_count = array_sum($adult);
            $child_count = array_sum($child);
            $nights = $data['num_nights'];
            if(trim($country) == 'Philippines'){
                $type = 'dom';
            } else {
                $type = 'intl';
            }
            
            $searchArr = array(
                            'dest_city'=>$destCity,'rmxml_code'=>$roomsxml_city_code,'hpro_code'=>$hotelspro_city_code,'cin'=>$sd,
                            'cout'=>$ed,'adult'=>$adult,'child'=>$child,'child_age'=>$child_age,
                            'room_count'=>$room_count,'adult_count'=>$adult_count,'child_count'=>$child_count,
                            'nights'=>$nights,'type'=>$type
                        );
            
            return $searchArr;
        } else {
            redirect('home');
        }
    }
    
    public function getHotelSearchData($apiId){
        ###############################
        #   API ID - 1 - roomsxml
        #   API ID - 2 - hotelspro
        ###############################
        
        $data['searchData'] = $_SESSION[session_id()]['hoSearchData'];
        
        if($apiId == '1')
        {
            $loc = ''; $amnty = ''; $typ = '';
            $data['result'] = $this->Roomsxml_Model->hotel_availability($data['searchData']);
            $data['cur_val'] = $this->Hotel_Model->getPhpToUsdCurrency();
            $data['admin_markup'] = $this->Home_Model->getHotelAdminMarkup($_SESSION['agent']['user_id']);
            $data['agent_markup'] = $this->Home_Model->getHotelAgentMarkup($_SESSION['agent']['user_id']);
            $_SESSION[session_id()]['Roomsxml_data'] = $data['result'];
            $serchView = $this->load->view('hotel/roomsxml_result',$data,true);
            if($_SESSION[session_id()]['hofilters']['location'] != ''){
                $locations = array_unique($_SESSION[session_id()]['hofilters']['location']);
                foreach($locations as $location){
                $loc .= '<li>
                                <label>
                                    <input type="checkbox" name="location_filter" value="'.$location.'" class="location_filter" checked="checked"> <i class="awe-icon awe-icon-check"></i> '.$location.'
                                </label>
                            </li>';
                }
            }

            if($_SESSION[session_id()]['hofilters']['amenity'] != ''){
                $amenitys = array_unique($_SESSION['agent_filters']['amenity']);
                foreach($amenitys as $amenity){
                    $amnty .= '<li>
                                    <label>
                                        <input type="checkbox" name="amenity_filter" value="'.$amenity.'" class="amenity_filter" checked="checked"> <i class="awe-icon awe-icon-check"></i> '.$amenity.'</label>
                                </li>';
                }
            }

            if($_SESSION[session_id()]['hofilters']['type'] != ''){
                    $typ .='<h3>Accommodation Type</h3>
                                <ul>';
                    $types = array_unique($_SESSION[session_id()]['hofilters']['type']);
                    foreach($types as $type){
                    $typ .=  '<li>
                    <label>
                        <input type="checkbox" name="type_filter" value="'.$type.'" class="type_filter" checked="checked"> <i class="awe-icon awe-icon-check"></i>'.$type.'
                    </label>
                    </li>';
                }

                $typ .= '</ul>';
            }

            echo json_encode(
                array(
                    'hotel_search_result'=>$serchView,
                    'locations'=>$loc,
                    'amenities'=>$amnty,
                    'types'=>$typ
                )
            );
        }
    }
    
    public function details($apiId,$id){
        ###############################
        #   API ID - 1 - roomsxml
        #   API ID - 2 - hotelspro
        ###############################
        if($apiId == '1')
        {
            $data['hotel_data'] = $_SESSION[session_id()]['Roomsxml_data'][$id];
            $hotelId = $_SESSION[session_id()]['Roomsxml_data'][$id]['hotel_id'];
            $path = ROOMSXML_DATA_PATH.$hotelId.'.xml';
            if(file_exists($path))
            {
                $doc = new DOMDocument();
                $doc->load( $path );
                $data['address'] = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Address')->item(0)->getElementsByTagName('Address1')->item(0)->nodeValue;
                $data['address'] .= $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Address')->item(0)->getElementsByTagName('Address2')->item(0)->nodeValue;
                $data['address'] .= $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Address')->item(0)->getElementsByTagName('Address3')->item(0)->nodeValue;
                $data['tel'] = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Address')->item(0)->getElementsByTagName('Tel')->item(0)->nodeValue;
                $data['fax'] = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Address')->item(0)->getElementsByTagName('Fax')->item(0)->nodeValue;
                $data['email'] = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Address')->item(0)->getElementsByTagName('Email')->item(0)->nodeValue;
                $data['url'] = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Address')->item(0)->getElementsByTagName('Url')->item(0)->nodeValue;

                $data['star'] =  $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Stars')->item(0)->nodeValue;
                $data['rank'] =  $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Rank')->item(0)->nodeValue;
                $data['latitude'] = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('GeneralInfo')->item(0)->getElementsByTagName('Latitude')->item(0)->nodeValue;
                $data['longitude'] = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('GeneralInfo')->item(0)->getElementsByTagName('Longitude')->item(0)->nodeValue;

                $photos = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Photo');
                $i=0;
                foreach($photos as $photo)
                {
                    $data['photo_url'][$i]=$photo->getElementsByTagName('Url')->item(0)->nodeValue;
                    $i++;
                }

                $description = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Description');
                $i=0;
                foreach($description as $desc)
                {
                    if($desc->getElementsByTagName('Type')->length > 0)
                    $data['desc'][$i]['type']=$desc->getElementsByTagName('Type')->item(0)->nodeValue;

                    if($desc->getElementsByTagName('Text')->length > 0)
                    $data['desc'][$i]['text']=$desc->getElementsByTagName('Text')->item(0)->nodeValue;
                    $i++;
                }
                $data['amenity'] = '';
                $amenities = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Amenity');
                $i=0;
                foreach($amenities as $amenity)
                {
                    $data['amenity'][$i]=$amenity->getElementsByTagName('Text')->item(0)->nodeValue;
                    $i++;
                }
            }
            else
            {  
                $data['address'] = '';
                $data['tel'] = '';
                $data['fax'] = '';
                $data['email'] = '';
                $data['url'] = '';
                $data['star'] =  '1';
                $data['rank'] =  '';
                $data['photo_url']= '';
                $data['desc']='';
                $data['amenity']='';
                $data['latitude']='';
                $data['longitude']='';
            }
        }

        
        $data['searchData'] = $_SESSION[session_id()]['hoSearchData'];
        $data['cur_val'] = $this->Hotel_Model->getPhpToUsdCurrency();
        $data['admin_markup'] = $this->Home_Model->getHotelAdminMarkup($_SESSION['agent']['user_id']);
        $data['agent_markup'] = $this->Home_Model->getHotelAgentMarkup($_SESSION['agent']['user_id']);
        $data['api_id'] = $apiId;
        $data['hotel_id'] = $id;
        $this->load->view('hotel/details',$data);
    }
    
    public function pre_booking($apiId,$hotelId,$roomId){
        ###############################
        #   API ID - 1 - roomsxml
        #   API ID - 2 - hotelspro
        ###############################
        $data['api_id'] = $apiId;
        $data['searchData'] = $_SESSION[session_id()]['hoSearchData'];
        if($apiId == '1'){
            $_SESSION[session_id()]['Roomsxml_booking_data'] = '';
            $data['id'] = $hotelId;
            $data['room_id']=$roomId;
            $data['hotel_data'] = $_SESSION[session_id()]['Roomsxml_data'][$hotelId];
            $data['room_data'] = $data['hotel_data']['room'][$roomId];
            $data['room_id']=$roomId;
            $hotelId = $_SESSION[session_id()]['Roomsxml_data'][$hotelId]['hotel_id'];
            $data['cur_val'] = $this->Hotel_Model->getPhpToUsdCurrency();
            $data['admin_markup'] = $this->Home_Model->getHotelAdminMarkup($_SESSION['agent']['user_id']);
            $data['agent_markup'] = $this->Home_Model->getHotelAgentMarkup($_SESSION['agent']['user_id']);
            $data['bookingPrepare'] = $this->Roomsxml_Model->booking_prepare($data['hotel_data'],$roomId,$data['searchData']);
            $_SESSION[session_id()]['Roomsxml_booking_data'] = $data['bookingPrepare'];
            $path = ROOMSXML_DATA_PATH.$hotelId.'.xml';
            if(file_exists($path))
            {
               $doc = new DOMDocument();
               $doc->load( $path );
               $data['address'] = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Address')->item(0)->getElementsByTagName('Address1')->item(0)->nodeValue;
               $data['address'] .= $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Address')->item(0)->getElementsByTagName('Address2')->item(0)->nodeValue;
               $data['address'] .= $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Address')->item(0)->getElementsByTagName('Address3')->item(0)->nodeValue;
               $data['star'] =  $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Stars')->item(0)->nodeValue;
               $photos = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Photo');
               $i=0;
               foreach($photos as $photo)
               {
                   $data['photo_url']=$photo->getElementsByTagName('Url')->item(0)->nodeValue;
                   break;
               }
            }
            else
            {  
                 $data['address'] = '';
                 $data['star'] =  '1';
                 $data['photo_url']= '';
            }
        }
        
        $this->load->view('hotel/pre_booking',$data);
        
    }
    
    public function booking_process(){
        ###############################
        #   API ID - 1 - roomsxml
        #   API ID - 2 - hotelspro
        ###############################
        
        if($_POST){
            $data = $_POST;
            $apiId = $this->input->post('aid');
            if($apiId != ''){
                if($apiId == '1'){
                    $this->booking_process_roomsxml($data);
                } else {
                    $this->booking_process_hotelspro($data);
                }
            }
        }
    }
    
    function booking_process_roomsxml($data)
    {
        $_SESSION[session_id()]['Roomsxml_booking_data'] = '';
        if(isset($data) && $data!='')
        {
            $apiId = $data['aid'];
            $postData = $data;
            $id = $data['mid'];
            $room_id = $data['rid'];
            $details = $_SESSION[session_id()]['Roomsxml_data'][$id];
            $searchData = $_SESSION[session_id()]['hoSearchData'];
            if(isset($_SESSION['agent']) && $_SESSION['agent']['user_id']!=''){
                $userId = $_SESSION['agent']['user_id'];
                $userType = $_SESSION['agent']['user_type'];
            }else{
                $userId = '';
                $userType = '';
            }

            $bookingPrepare = $this->Roomsxml_Model->booking_prepare($details,$room_id,$searchData);
            $_SESSION[session_id()]['Roomsxml_booking_data'] = $bookingPrepare;
            if(isset($bookingPrepare) && $bookingPrepare != ''){
                $i = 0;
                $totalPrice = 0;
                $totalOrgPrice = 0;
                foreach($bookingPrepare['rooms'] as $room)
                {
                    $totalPrice = $totalPrice+$room['TotalSellingPrice'];
                    $totalOrgPrice = $totalOrgPrice+$room['org_TotalSellingPrice'];
                    $i++;
                }
                $cur_val = $this->Hotel_Model->getPhpToUsdCurrency();
                $admin_markup = $this->Home_Model->getHotelAdminMarkup($_SESSION['agent']['user_id']);
                $agent_markup = $this->Home_Model->getHotelAgentMarkup($_SESSION['agent']['user_id']);
                $addData = $this->Hotel_Model->addBookingDataRoomsxml($apiId,$postData,$details,$room_id,$userId,$bookingPrepare,$totalPrice,$totalOrgPrice,$searchData,$cur_val,$admin_markup,$agent_markup);
                $masterId = $addData['master_id'];
                if($addData['master_id'] != ''){
                    $booking = $this->Roomsxml_Model->booking($masterId,$postData,$details,$room_id,$searchData,$cur_val,$admin_markup,$agent_markup);
                    if($booking != '' && $booking != 'Failed'){
//                         $this->Home_Model->deductAgentDepositOnBooking($_SESSION['agent']['user_id'],$_SESSION['agent']['user_type'],$addData['total_price'],$addData['admin_markup'],$addData['agent_markup'],'0');
                         redirect('hotel/thankyou/'.$masterId);
                    } else {
                         redirect('hotel/booking_failed/');
                    }
                } else {
                    redirect('hotel/booking_failed/');
                }
            } else {
               redirect('hotel/booking_failed/');
            }
        }
    }
    
    public function booking_failed(){
        unset($_SESSION[session_id()]['Roomsxml_booking_data']);
        unset($_SESSION[session_id()]['hoSearchData']);
        unset($_SESSION[session_id()]['Roomsxml_data']);
        unset($_SESSION[session_id()]['hofilters']);
        unset($_SESSION[session_id()]['Hotelspro_data']);
        
        $this->load->view('hotel/booking_failed');
    }
       
    function booking_process_hotelspro($data)
    {
        if(isset($data) && $data!='')
        {
             //echo '<pre />'; print_r($_POST);die;
             $apiId = $data['api_id'];
             $postData = $data;
             $id = $data['hotel_id'];
             $room_id = $data['room_id'];
             $details = $_SESSION['agent_Hotelspro_data'][$id];

             $roomsQry = $this->db->query($sql="select * from hotelspro_hotel_detail_t where api_temp_hotel_id='".$room_id."'");
             if($roomsQry->num_rows() > 0)
                 $room_data = $data['room_data']= $roomsQry->row();
             else
                 $room_data = $data['room_data'] = '';


             if(isset($_SESSION['agent']) && $_SESSION['agent']['user_id']!=''){
                 $userId = $_SESSION['agent']['user_id'];
             }
             else{
                 $userId = '';
             }
             //echo '<pre />';print_r($room_data);die;
             $masterId = $this->Agent_hotel_Model->addBookingData($apiId,$postData,$details,$room_data,$userId);
             //die;
             $booking = $this->Agent_hotelspro_Model->booking($masterId,$postData,$details,$room_data);
             if($booking != '' && $booking == 'Confirmed'){
                 $this->Agent_Model->deductAgentDepositOnBooking($_SESSION['agent']['user_id'],$_SESSION['agent']['user_type'],$room_data->total_room_cost,$_SESSION['admin_markup'],$_SESSION['agent_markup'],$_SESSION['sub_agent_markup']);
                 redirect('agent_hotel/thankyou/'.$masterId);
             }else{
                 $this->Agent_hotel_Model->deleteFailedHotelData($masterId);
                 redirect('agent_hotel/booking/'.$apiId.'/'.$id.'/'.$room_id.'/failed');
             }
         }
    }

    function thankyou($masterId)
    {
        unset($_SESSION[session_id()]['Roomsxml_booking_data']);
        unset($_SESSION[session_id()]['hoSearchData']);
        unset($_SESSION[session_id()]['Roomsxml_data']);
        unset($_SESSION[session_id()]['filters']);
        unset($_SESSION[session_id()]['Hotelspro_data']);
        unset($_SESSION[session_id()]['hototalPriceAry']);
        unset($_SESSION[session_id()]['cancellation_policy']);

        $data['bookingData'] = $this->Hotel_Model->getBookingData($masterId);
        $data['paxDetails'] = $this->Hotel_Model->getBookingPaxData($masterId);


         $data['api']=$data['bookingData']->api;
        // $data['hotel_details'] = $this->Agent_hotel_Model->getBookingHotelData($data['bookingData']->hotel_code);
        ##################### MAIL TO USER  ##################################
         $to = $data['bookingData']->email;
         $subject = 'Hotel Booking Voucher';
         $subject1 = 'Hotel Booking Invoice';
         $headers = "From: support@redtagtravels.com\r\n";
         $headers .= "Reply-To: support@redtagtravels.com\r\n";
         $headers .= "CC: support@redtagtravels.com\r\n";
         $headers .= "MIME-Version: 1.0\r\n";
         $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
         if($data['api'] == 'roomsxml'){
             $message = $this->load->view('hotel/voucher',$data,true);
             $message1 = $this->load->view('hotel/invoice',$data,true);
         } else {
             $message = $this->load->view('hotel/voucher',$data,true);
             $message1 = $this->load->view('hotel/invoice',$data,true);
         }
         mail($to, $subject, $message, $headers);
         mail($to, $subject1, $message1, $headers);

        #######################################################
        $this->load->view('hotel/voucher',$data);
    }

    function voucher($masterId)
    {
        $data['bookingData'] = $this->Hotel_Model->getBookingData($masterId);
        $data['paxDetails'] = $this->Hotel_Model->getBookingPaxData($masterId);


         $data['api']=2;
        // $data['hotel_details'] = $this->Agent_hotel_Model->getBookingHotelData($data['bookingData']->hotel_code);
        ##################### MAIL TO USER  ##################################
         $to = $data['bookingData']->email;
         $subject = 'Hotel Booking Voucher';
         $subject1 = 'Hotel Booking Invoice';
         $headers = "From: support@rkltravel.com\r\n";
         $headers .= "Reply-To: support@rkltravel.com\r\n";
         $headers .= "CC: support@rkltravel.com\r\n";
         $headers .= "MIME-Version: 1.0\r\n";
         $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

         $message = $this->load->view('b2b/hotel/voucher',$data,true);
         $message1 = $this->load->view('b2b/hotel/invoice',$data,true);
         mail($to, $subject, $message, $headers);
         mail($to, $subject1, $message1, $headers);

        #######################################################
        $this->load->view('hotel/voucher',$data);
    }

    function invoice($id)
    {
        $data['bookingData'] = $this->Hotel_Model->getBookingData($id);
        $this->load->view('hotel/invoice',$data);
    }
    
    
    function array_column(array $input, $columnKey, $indexKey = null) {
        $array = array();
        foreach ($input as $value) {
            if ( !array_key_exists($columnKey, $value)) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value[$columnKey];
            }
            else {
                if ( !array_key_exists($indexKey, $value)) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if ( ! is_scalar($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array;
    }
    
}