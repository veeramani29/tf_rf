<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 0);
error_reporting(E_ALL);
session_start();
###############################
#   API ID - 1 - roomsxml
#   API ID - 2 - tacenter
#   API ID - 3 - rezlive
###############################

class Hotel extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Home_Model');
        $this->load->model('Hotel_Model');
        $this->load->model('Roomsxml_Model');
        $this->load->model('Tacenter_Model');
        $this->load->model('Rezlive_Model');
        $this->load->library('xml_to_array');
        if (!isset($_SESSION['agent']) || $_SESSION['agent']['logged_in'] != '1') {
            redirect('home/login');
        }
    }

    public function search() {
        $_SESSION[session_id()]['hoSearchData'] = '';
        $_SESSION[session_id()]['Roomsxml_data'] = '';
        $_SESSION[session_id()]['Rezlive_data'] = '';
        $_SESSION[session_id()]['Tacenter_data'] = '';
        $_SESSION[session_id()]['Roomsxml_booking_data'] = '';
        $_SESSION[session_id()]['Rezlive_booking_data'] = '';
        $_SESSION[session_id()]['hofilters'] = '';
        $_SESSION[session_id()]['cancellation_policy'] = '';
        $data['nationality'] = $this->Home_Model->getNationalityList();
        $data['searchData'] = $this->getSearchParams($_GET);
        $_SESSION[session_id()]['hoSearchData'] = $data['searchData'];
        $data['api'] = array('0'=>'1','1'=>'3');
        $this->load->view('hotel/search', $data);
    }

    public function getSearchParams($data) {
        $city = '';
        $country = '';
        $state = '';
        if ($data['cityval'] != '' && $data['hotel_sd'] != '' && $data['hotel_ed'] != '') {
            $destCity = $data['cityval'];
            if (strpos($data['cityval'], ',') !== false) {
                $cityDet = explode(',', $_GET['cityval']);
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
                    $roomsxml_city_code = $destCode[0]['locId'];
                    $tacenter_city_code = $destCode[2]['locId'];
                    $tacenter_country_code = $destCode[2]['conId'];
                    $rezlive_city_code = $destCode[1]['locId'];
                    $rezlive_country_code = $destCode[1]['conId'];
                }else{
                    $roomsxml_city_code = '';
                    $tacenter_city_code = '';
                    $tacenter_country_code = '';
                    $rezlive_city_code = '';
                    $rezlive_country_code = '';
                }
            } else {
                $roomsxml_city_code = '';
                $tacenter_city_code = '';
                $tacenter_country_code = '';
                $rezlive_city_code = '';
                $rezlive_country_code = '';
            }
            $sd = $data['hotel_sd'];
            $ed = $data['hotel_ed'];
            $adult = $data['adult'];
            $child = $data['child'];
            if (isset($data['child_age'])) {
                $child_age = $data['child_age'];
            } else {
                $child_age = '';
            }
            $nation = $data['nationality'];
            $room_count = $data['room_count'];
            $adult_count = array_sum($adult);
            $child_count = array_sum($child);
            $nights = $data['num_nights'];
            if (trim($country) == 'Philippines') {
                $type = 'dom';
            } else {
                $type = 'intl';
            }
            $searchArr = array(
                            'dest_city'=>$destCity,'rmxml_code'=>$roomsxml_city_code,'ta_code'=>$tacenter_city_code,'taCon_code'=>$tacenter_country_code,'cin'=>$sd,
                            'cout'=>$ed,'adult'=>$adult,'child'=>$child,'child_age'=>$child_age,'nation'=>$nation,
                            'room_count'=>$room_count,'adult_count'=>$adult_count,'child_count'=>$child_count,
                            'nights'=>$nights,'type'=>$type,'rez_code'=>$rezlive_city_code,'rezCon_code'=>$rezlive_country_code
                        );
            return $searchArr;
        } else {
            redirect('home');
        }
    }

    public function getHotelSearchData($apiId) {
        ###############################
        #   API ID - 1 - roomsxml
        #   API ID - 2 - tacenter
        #   API ID - 3 - rezlive
        ###############################
        $data['searchData'] = $_SESSION[session_id()]['hoSearchData'];
        if ($apiId == '1') {
            $loc = '';
            $amnty = '';
            $typ = '';
            $data['result'] = $this->Roomsxml_Model->hotel_availability($data['searchData']);
            $data['cur_val'] = $this->Hotel_Model->getPhpToUsdCurrency();
            $data['admin_markup'] = $this->Home_Model->getHotelAdminMarkup($_SESSION['agent']['user_id']);
            $data['agent_markup'] = $this->Home_Model->getHotelAgentMarkup($_SESSION['agent']['user_id']);
            $_SESSION[session_id()]['Roomsxml_data'] = $data['result'];
            $serchView = $this->load->view('hotel/roomsxml_result', $data, true);
            if(isset($data['result']) && $data['result'] != ''){
                if ($_SESSION[session_id()]['hofilters']['location'] != '') {
                    $locations = array_unique($_SESSION[session_id()]['hofilters']['location']);
                    foreach ($locations as $location) {
                        $loc .= '<li>
                                    <label>
                                        <input type="checkbox" name="location_filter" value="' . $location . '" class="location_filter" checked="checked"> <i class="awe-icon awe-icon-check"></i> ' . $location . '
                                    </label>
                                </li>';
                    }
                }
                if ($_SESSION[session_id()]['hofilters']['amenity'] != '') {
                    $amenitys = array_unique($_SESSION['agent_filters']['amenity']);
                    foreach ($amenitys as $amenity) {
                        $amnty .= '<li>
                                        <label>
                                            <input type="checkbox" name="amenity_filter" value="' . $amenity . '" class="amenity_filter" checked="checked"> <i class="awe-icon awe-icon-check"></i> ' . $amenity . '</label>
                                    </li>';
                    }
                }
                if ($_SESSION[session_id()]['hofilters']['type'] != '') {
                    $typ .='<h3>Accommodation Type</h3>
                                    <ul>';
                    $types = array_unique($_SESSION[session_id()]['hofilters']['type']);
                    foreach ($types as $type) {
                        $typ .= '<li>
                        <label>
                            <input type="checkbox" name="type_filter" value="' . $type . '" class="type_filter" checked="checked"> <i class="awe-icon awe-icon-check"></i>' . $type . '
                        </label>
                        </li>';
                    }
                    $typ .= '</ul>';
                }
            }
            echo json_encode(
                    array(
                        'hotel_search_result' => $serchView,
                        'locations' => $loc,
                        'amenities' => $amnty,
                        'types' => $typ
                    )
            );
        }
        
        if($apiId == 2){
            $loc = ''; $amnty = ''; $typ = '';
            $data['result'] = $this->Tacenter_Model->hotel_availability($data['searchData']);
            print_r($data['result']);die;
            $data['cur_val'] = $this->Hotel_Model->getPhpToUsdCurrency();
            $data['admin_markup'] = $this->Home_Model->getHotelAdminMarkup($_SESSION['agent']['user_id']);
            $data['agent_markup'] = $this->Home_Model->getHotelAgentMarkup($_SESSION['agent']['user_id']);
            $_SESSION[session_id()]['Tacenter_data'] = $data['result'];
            $serchView = $this->load->view('hotel/tacenter_result',$data,true);
            echo json_encode(
                array(
                    'hotel_search_result'=>$serchView,
                    'locations'=>$loc,
                    'amenities'=>$amnty,
                    'types'=>$typ
                )
            );
        }
        
        if($apiId == 3){
            $loc = ''; $amnty = ''; $typ = '';
            $data['result'] = $this->Rezlive_Model->hotel_availability($data['searchData']);
            $data['cur_val'] = 1;
            $data['admin_markup'] = $this->Home_Model->getHotelAdminMarkup($_SESSION['agent']['user_id']);
            $data['agent_markup'] = $this->Home_Model->getHotelAgentMarkup($_SESSION['agent']['user_id']);
            $_SESSION[session_id()]['Rezlive_data'] = $data['result'];
            $serchView = $this->load->view('hotel/rezlive_result',$data,true);
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

    public function details($apiId, $id) {
        ###############################
        #   API ID - 1 - roomsxml
        #   API ID - 2 - tacenter
        #   API ID - 3 - tacenter
        ###############################
        if ($apiId == '1') {
            $data['hotel_data'] = $_SESSION[session_id()]['Roomsxml_data'][$id];
            $hotelId = $_SESSION[session_id()]['Roomsxml_data'][$id]['hotel_id'];
            $path = ROOMSXML_DATA_PATH . $hotelId . '.xml';
            if (file_exists($path)) {
                $doc = new DOMDocument();
                $doc->load($path);
                $data['address'] = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Address')->item(0)->getElementsByTagName('Address1')->item(0)->nodeValue;
                $data['address'] .= $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Address')->item(0)->getElementsByTagName('Address2')->item(0)->nodeValue;
                $data['address'] .= $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Address')->item(0)->getElementsByTagName('Address3')->item(0)->nodeValue;
                $data['tel'] = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Address')->item(0)->getElementsByTagName('Tel')->item(0)->nodeValue;
                $data['fax'] = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Address')->item(0)->getElementsByTagName('Fax')->item(0)->nodeValue;
                $data['email'] = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Address')->item(0)->getElementsByTagName('Email')->item(0)->nodeValue;
                $data['url'] = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Address')->item(0)->getElementsByTagName('Url')->item(0)->nodeValue;
                $data['star'] = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Stars')->item(0)->nodeValue;
                $data['rank'] = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Rank')->item(0)->nodeValue;
                $data['latitude'] = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('GeneralInfo')->item(0)->getElementsByTagName('Latitude')->item(0)->nodeValue;
                $data['longitude'] = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('GeneralInfo')->item(0)->getElementsByTagName('Longitude')->item(0)->nodeValue;
                $photos = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Photo');
                $i = 0;
                foreach ($photos as $photo) {
                    $data['photo_url'][$i] = $photo->getElementsByTagName('Url')->item(0)->nodeValue;
                    $i++;
                }
                $description = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Description');
                $i = 0;
                foreach ($description as $desc) {
                    if ($desc->getElementsByTagName('Type')->length > 0)
                        $data['desc'][$i]['type'] = $desc->getElementsByTagName('Type')->item(0)->nodeValue;
                    if ($desc->getElementsByTagName('Text')->length > 0)
                        $data['desc'][$i]['text'] = $desc->getElementsByTagName('Text')->item(0)->nodeValue;
                    $i++;
                }
                $data['amenity'] = '';
                $amenities = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Amenity');
                $i = 0;
                foreach ($amenities as $amenity) {
                    $data['amenity'][$i] = $amenity->getElementsByTagName('Text')->item(0)->nodeValue;
                    $i++;
                }
            } else {
                $data['address'] = '';
                $data['tel'] = '';
                $data['fax'] = '';
                $data['email'] = '';
                $data['url'] = '';
                $data['star'] = '1';
                $data['rank'] = '';
                $data['photo_url'] = '';
                $data['desc'] = '';
                $data['amenity'] = '';
                $data['latitude'] = '';
                $data['longitude'] = '';
            }
        }
        
        if($apiId == '2'){
            $data['hotel_data'] = $_SESSION[session_id()]['Tacenter_data'][$id];
            $hotelId = $_SESSION[session_id()]['Tacenter_data'][$id]['hotel_id'];
            $data['hotelInfo'] = $this->Tacenter_Model->getHotelInformation($hotelId);
            $data['address'] = ($data['hotel_data'] != '' ? $data['hotel_data']['Address'] : '');
            $data['tel'] = '';
            $data['fax'] = '';
            $data['email'] = '';
            $data['url'] = '';
            $data['star'] =  $data['hotel_data']['StarRating'];
            $data['rank'] =  $data['hotel_data']['HotelReviewScore'];
            $data['photo_url'] = (isset($data['hotelInfo']['images']) != '' ? $data['hotelInfo']['images'] : '');
            $data['desc'] = (isset($data['hotelInfo']['HotelDesc']) != '' ? $data['hotelInfo']['HotelDesc'] : '');
            $data['amenity'] = (isset($data['hotelInfo']['facility']) != '' ? $data['hotelInfo']['facility'] : '');
            $data['latitude'] = (isset($data['hotelInfo']['Latitude']) != '' ? $data['hotelInfo']['Latitude'] : '');
            $data['longitude'] = (isset($data['hotelInfo']['Longitude']) != '' ? $data['hotelInfo']['Longitude'] : '');
            $data['cur_val'] = 1;
        }
        
        if($apiId == '3'){
            $data['hotel_data'] = $_SESSION[session_id()]['Rezlive_data'][$id];
            $hotelId = $_SESSION[session_id()]['Rezlive_data'][$id]['hotel_id'];
            $hotelDetails = $this->Hotel_Model->getRezliveHotelInformation($hotelId);
            $hotelDesc = $this->Hotel_Model->getRezliveHotelDesc($hotelId);
            $data['address'] = ($hotelDetails != '' ? $hotelDetails->HotelAddress : '');
            $data['tel'] = '';
            $data['fax'] = '';
            $data['email'] = '';
            $data['url'] = '';
            $data['star'] =  $data['hotel_data']['star'];
            $data['rank'] =  '';
            $data['photo_url']= '';
            $data['desc'] = ($hotelDesc != '' ? $hotelDesc->description : '');
            $data['amenity'] = '';
            $data['latitude'] = ($hotelDetails != '' ? $hotelDetails->Latitude : '');
            $data['longitude'] = ($hotelDetails != '' ? $hotelDetails->Longitude : '');
            $data['cur_val'] = 1;
        }

        $data['searchData'] = $_SESSION[session_id()]['hoSearchData'];
        $data['cur_val'] = $this->Hotel_Model->getPhpToUsdCurrency();
        $data['admin_markup'] = $this->Home_Model->getHotelAdminMarkup($_SESSION['agent']['user_id']);
        $data['agent_markup'] = $this->Home_Model->getHotelAgentMarkup($_SESSION['agent']['user_id']);
        $data['api_id'] = $apiId;
        $data['hotel_id'] = $id;
        $this->load->view('hotel/details', $data);
    }

    public function pre_booking($apiId, $hotelId, $roomId) {
        ###############################
        #   API ID - 1 - roomsxml
        #   API ID - 2 - tacenter
        #   API ID - 3 - rezlive
        ###############################
        $data['api_id'] = $apiId;
        $data['searchData'] = $_SESSION[session_id()]['hoSearchData'];
        if ($apiId == '1') {
            $_SESSION[session_id()]['Roomsxml_booking_data'] = '';
            $data['id'] = $hotelId;
            $data['room_id'] = $roomId;
            $data['hotel_data'] = $_SESSION[session_id()]['Roomsxml_data'][$hotelId];
            $data['room_data'] = $data['hotel_data']['room'][$roomId];
            $data['room_id'] = $roomId;
            $hotelId = $_SESSION[session_id()]['Roomsxml_data'][$hotelId]['hotel_id'];
            $data['cur_val'] = $this->Hotel_Model->getPhpToUsdCurrency();
            $data['admin_markup'] = $this->Home_Model->getHotelAdminMarkup($_SESSION['agent']['user_id']);
            $data['agent_markup'] = $this->Home_Model->getHotelAgentMarkup($_SESSION['agent']['user_id']);
            $data['bookingPrepare'] = $this->Roomsxml_Model->booking_prepare($data['hotel_data'], $roomId, $data['searchData']);
            $_SESSION[session_id()]['Roomsxml_booking_data'] = $data['bookingPrepare'];
            $path = ROOMSXML_DATA_PATH . $hotelId . '.xml';
            if (file_exists($path)) {
                $doc = new DOMDocument();
                $doc->load($path);
                $data['address'] = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Address')->item(0)->getElementsByTagName('Address1')->item(0)->nodeValue;
                $data['address'] .= $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Address')->item(0)->getElementsByTagName('Address2')->item(0)->nodeValue;
                $data['address'] .= $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Address')->item(0)->getElementsByTagName('Address3')->item(0)->nodeValue;
                $data['star'] = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Stars')->item(0)->nodeValue;
                $photos = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Photo');
                $i = 0;
                foreach ($photos as $photo) {
                    $data['photo_url'] = $photo->getElementsByTagName('Url')->item(0)->nodeValue;
                    break;
                }
            } else {
                $data['address'] = '';
                $data['star'] = '1';
                $data['photo_url'] = '';
            }
        }
        
        if($apiId == '2'){
            $_SESSION[session_id()]['Tacenter_booking_data'] = '';
            $data['id'] = $hotelId;
            $data['room_id']=$roomId;
            $data['hotel_data'] = $_SESSION[session_id()]['Tacenter_data'][$hotelId];
            $data['room_data'] = $data['hotel_data']['room'][$roomId];
            $data['room_id']=$roomId;
            $hotelId = $_SESSION[session_id()]['Tacenter_data'][$hotelId]['hotel_id'];
            $data['hotelDetails'] = $this->Hotel_Model->getTacenterHotelInformation($hotelId);
            $data['cur_val'] = 1;
            $data['admin_markup'] = $this->Home_Model->getHotelAdminMarkup($_SESSION['agent']['user_id']);
            $data['agent_markup'] = $this->Home_Model->getHotelAgentMarkup($_SESSION['agent']['user_id']);
            //$data['bookingPrepare'] = $this->Rezlive_Model->booking_prepare($data['hotel_data'],$roomId,$data['searchData']);
            
            $data['address'] = ($data['hotelDetails'] != '' ? $data['hotelDetails']->Address : '');
            $data['star'] =  $data['hotel_data']['StarRating'];
            $data['photo_url']= $data['hotel_data']['FrontPgImage'];
            $data['bookingPrepare'] = '------';
        }
        
        if($apiId == '3'){
            $_SESSION[session_id()]['Rezlive_booking_data'] = '';
            $data['id'] = $hotelId;
            $data['room_id']=$roomId;
            $data['hotel_data'] = $_SESSION[session_id()]['Rezlive_data'][$hotelId];
            $data['room_data'] = $data['hotel_data']['rooms'][$roomId];
            $data['room_id']=$roomId;
            $hotelId = $_SESSION[session_id()]['Rezlive_data'][$hotelId]['hotel_id'];
            $data['hotelDetails'] = $this->Hotel_Model->getRezliveHotelInformation($hotelId);
            $data['cur_val'] = 1;
            $data['admin_markup'] = $this->Home_Model->getHotelAdminMarkup($_SESSION['agent']['user_id']);
            $data['agent_markup'] = $this->Home_Model->getHotelAgentMarkup($_SESSION['agent']['user_id']);
            $data['bookingPrepare'] = $this->Rezlive_Model->booking_prepare($data['hotel_data'],$roomId,$data['searchData']);
            $_SESSION[session_id()]['Rezlive_booking_data'] = $data['bookingPrepare'];
            $data['address'] = ($data['hotelDetails'] != '' ? $data['hotelDetails']->HotelAddress : '');
            $data['star'] =  $data['hotel_data']['star'];
            $data['photo_url']= '';
        }
        $data['depositBalance'] = $this->Home_Model->getAgentDepositBalance($_SESSION['agent']['user_id']);
        $this->load->view('hotel/pre_booking', $data);
    }

    public function booking_process() {
        ###############################
        #   API ID - 1 - roomsxml
        #   API ID - 2 - tacenter
        #   API ID - 3 - rezlive
        ###############################
        if ($_POST) {
            $data = $_POST;
            $apiId = $this->input->post('aid');
            if ($apiId != '') {
                if($apiId == 1){
                    $this->booking_process_roomsxml($data);
                }
                if($apiId == 2){
                    $this->booking_process_tacenter($data);
                } 
                if($apiId == 3){
                    $this->booking_process_rezlive($data);
                }
            }
        }
    }

    function booking_process_roomsxml($data) {
        $_SESSION[session_id()]['Roomsxml_booking_data'] = '';
        if (isset($data) && $data != '') {
            $apiId = $data['aid'];
            $postData = $data;
            $id = $data['mid'];
            $room_id = $data['rid'];
            $details = $_SESSION[session_id()]['Roomsxml_data'][$id];
            $searchData = $_SESSION[session_id()]['hoSearchData'];
            if (isset($_SESSION['agent']) && $_SESSION['agent']['user_id'] != '') {
                $userId = $_SESSION['agent']['user_id'];
                $userType = $_SESSION['agent']['user_type'];
            } else {
                $userId = '';
                $userType = '';
            }
            $bookingPrepare = $this->Roomsxml_Model->booking_prepare($details, $room_id, $searchData);
            $_SESSION[session_id()]['Roomsxml_booking_data'] = $bookingPrepare;
            if (isset($bookingPrepare) && $bookingPrepare != '') {
                $i = 0;
                $totalPrice = 0;
                $totalOrgPrice = 0;
                foreach ($bookingPrepare['rooms'] as $room) {
                    $totalPrice = $totalPrice + $room['TotalSellingPrice'];
                    $totalOrgPrice = $totalOrgPrice + $room['org_TotalSellingPrice'];
                    $i++;
                }
                $cur_val = $this->Hotel_Model->getPhpToUsdCurrency();
                $admin_markup = $this->Home_Model->getHotelAdminMarkup($_SESSION['agent']['user_id']);
                $agent_markup = $this->Home_Model->getHotelAgentMarkup($_SESSION['agent']['user_id']);
                $addData = $this->Hotel_Model->addBookingDataRoomsxml($apiId, $postData, $details, $room_id, $userId, $bookingPrepare, $totalPrice, $totalOrgPrice, $searchData, $cur_val, $admin_markup, $agent_markup);
                $masterId = $addData['master_id'];
                if ($addData['master_id'] != '') {
                    $booking = $this->Roomsxml_Model->booking($masterId, $postData, $details, $room_id, $searchData, $cur_val, $admin_markup, $agent_markup);
                    if ($booking != '' && $booking != 'Failed') {
//                         $this->Home_Model->deductAgentDepositOnBooking($_SESSION['agent']['user_id'],$_SESSION['agent']['user_type'],$addData['total_price'],$addData['admin_markup'],$addData['agent_markup'],'0');
                        redirect('hotel/thankyou/' . $masterId);
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
    
    public function booking_process_rezlive($data){
        if(isset($data) && $data!='')
        {
            $apiId = $data['aid'];
            $postData = $data;
            $id = $data['mid'];
            $room_id = $data['rid'];
            $details = $_SESSION[session_id()]['Rezlive_data'][$id];
            $searchData = $_SESSION[session_id()]['hoSearchData'];
            if(isset($_SESSION['agent']) && $_SESSION['agent']['user_id']!=''){
                $userId = $_SESSION['agent']['user_id'];
                $userType = $_SESSION['agent']['user_type'];
            }else{
                $userId = '';
                $userType = '';
            }

            
            $bookingPrepare = $_SESSION[session_id()]['Rezlive_booking_data'];
            if(isset($bookingPrepare) && $bookingPrepare != ''){
                //echo 'fgfdgdg';die;
                $i = 0;
                $totalPrice = $bookingPrepare['final_price'];
                $totalOrgPrice = $bookingPrepare['final_price'];
                
                $cur_val = 1;
                $admin_markup = $this->Home_Model->getHotelAdminMarkup($_SESSION['agent']['user_id']);
                $agent_markup = $this->Home_Model->getHotelAgentMarkup($_SESSION['agent']['user_id']);
                $addData = $this->Hotel_Model->addBookingDataRezlive($apiId,$postData,$details,$room_id,$userId,$bookingPrepare,$totalPrice,$totalOrgPrice,$searchData,$cur_val,$admin_markup,$agent_markup);
                $masterId = $addData['master_id'];
                if($addData['master_id'] != ''){
                    $booking = $this->Rezlive_Model->booking($masterId,$postData,$details,$room_id,$bookingPrepare,$searchData,$cur_val,$admin_markup,$agent_markup);
                    if($booking != ''){
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
    
    public function booking_process_tacenter($data){
        if(isset($data) && $data!='')
        {
            $apiId = $data['aid'];
            $postData = $data;
            $id = $data['mid'];
            $room_id = $data['rid'];
            $details = $_SESSION[session_id()]['Tacenter_data'][$id];
            $searchData = $_SESSION[session_id()]['hoSearchData'];
            if(isset($_SESSION['agent']) && $_SESSION['agent']['user_id']!=''){
                $userId = $_SESSION['agent']['user_id'];
                $userType = $_SESSION['agent']['user_type'];
            }else{
                $userId = '';
                $userType = '';
            }
            //echo 'fgfdgdg';die;
            $i = 0;
            $totalPrice = $details['room'][$room_id]['price'];
            $totalOrgPrice = $details['room'][$room_id]['org_price'];

            $cur_val = 1;
            $admin_markup = $this->Home_Model->getHotelAdminMarkup($_SESSION['agent']['user_id']);
            $agent_markup = $this->Home_Model->getHotelAgentMarkup($_SESSION['agent']['user_id']);
            $addData = $this->Hotel_Model->addBookingDataTacenter($apiId,$postData,$details,$room_id,$userId,$totalPrice,$totalOrgPrice,$searchData,$cur_val,$admin_markup,$agent_markup);
            $masterId = $addData['master_id'];
            if($addData['master_id'] != ''){
                $booking = $this->Tacenter_Model->booking($masterId,$postData,$details,$room_id,$searchData,$cur_val,$admin_markup,$agent_markup);
                //$booking == 'Failed';
                if($booking != 'Failed'){
//                         $this->Home_Model->deductAgentDepositOnBooking($_SESSION['agent']['user_id'],$_SESSION['agent']['user_type'],$addData['total_price'],$addData['admin_markup'],$addData['agent_markup'],'0');
                     redirect('hotel/thankyou/'.$masterId);
                } else {
                     redirect('hotel/booking_failed/');
                }
            } else {
                redirect('hotel/booking_failed/');
            }
            
        }
    }

    public function booking_failed() {
        unset($_SESSION[session_id()]['Roomsxml_booking_data']);
        unset($_SESSION[session_id()]['Rezlive_booking_data']);
        unset($_SESSION[session_id()]['hoSearchData']);
        unset($_SESSION[session_id()]['Roomsxml_data']);
        unset($_SESSION[session_id()]['Rezlive_data']);
        unset($_SESSION[session_id()]['Tacenter_data']);
        unset($_SESSION[session_id()]['hofilters']);
        $this->load->view('hotel/booking_failed');
    }
    
    function thankyou($masterId) {
        $data['bookingData'] = $this->Hotel_Model->getBookingData($masterId);
        $data['paxDetails'] = $this->Hotel_Model->getBookingPaxData($masterId);
        $data['api'] = $data['bookingData']->api;
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
        if ($data['api'] == 'roomsxml') {
            $message = $this->load->view('hotel/voucher', $data, true);
            $message1 = $this->load->view('hotel/invoice', $data, true);
        } else {
            $message = $this->load->view('hotel/voucher', $data, true);
            $message1 = $this->load->view('hotel/invoice', $data, true);
        }
        mail($to, $subject, $message, $headers);
        mail($to, $subject1, $message1, $headers);
        #######################################################
        $this->load->view('hotel/voucher', $data);
    }

    function voucher($masterId) {
        $data['bookingData'] = $this->Hotel_Model->getBookingData($masterId);
        $data['paxDetails'] = $this->Hotel_Model->getBookingPaxData($masterId);
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
        $message = $this->load->view('b2b/hotel/voucher', $data, true);
        $message1 = $this->load->view('b2b/hotel/invoice', $data, true);
        mail($to, $subject, $message, $headers);
        mail($to, $subject1, $message1, $headers);
        #######################################################
        $this->load->view('hotel/voucher', $data);
    }

    function invoice($id) {
        $data['bookingData'] = $this->Hotel_Model->getBookingData($id);
        $this->load->view('hotel/invoice', $data);
    }

}
