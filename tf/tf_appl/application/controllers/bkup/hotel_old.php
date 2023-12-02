<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hotel extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Auth_Model');
        $current_url = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
        $current_url = $this->config->site_url() . $this->uri->uri_string() . $current_url;
        $url = array(
            'continue' => $current_url,
        );
        $this->session->set_userdata($url);
        $this->helpMenuLink = "";
        $this->load->model('Help_Model');
        $this->helpMenuLink = $this->Help_Model->fetchHelpLinks();
        $this->load->model('example_model');
        $this->load->model('Hotel_Model');
        $this->load->helper('hotel_helper');
        $this->load->helper('flight_helper');
        $this->load->model('booking_model');
        $this->load->model('email_model');
		
        $this->load->library('xml_to_array');
		
		$controller = $this->router->fetch_class();
        parent::validate_modules($controller);
	}

    public function home(){
    	
    	$data['banners'] = $this->Help_Model->getHomeSettings();
    	$data['portfolio'] = $this->Help_Model->getAllPortfolio();
    	$this->load->view('hotel/hotel_index',$data);	
    }
    
    public function search() {
        
        $checkin_explode_date = explode('-', $_GET['hotel_checkin']);
        $checkout_explode_date = explode('-', $_GET['hotel_checkout']);

        $check_in = $checkin_explode_date['2'] . '-' . $checkin_explode_date['1'] . '-' . $checkin_explode_date['0'];

        $check_out = $checkout_explode_date['2'] . '-' . $checkout_explode_date['1'] . '-' . $checkout_explode_date['0'];

        $data['city_name_full'] = $_GET['city'];
        $data['city_code'] = $_GET['city'];
        $data['check_in'] = $check_in;
        $data['check_out'] = $check_out;
        $data['rooms'] = $_GET['rooms'];
        $data['adult'] = $_GET['adult'];

        $_SESSION['hotel_city_code'] = $data['city_code'];
        $_SESSION['hotel_check_in'] = $data['check_in'];
        $_SESSION['hotel_check_out'] = $data['check_out'];
        $_SESSION['hotel_rooms'] = $data['rooms'];
        $_SESSION['hotel_adult'] = $data['adult'];

        $_SESSION['travel_port'] = array();

        $explode = explode('  - ', $this->input->get('city'));
        $city_code = trim($explode[1]);
        $check_in = $this->input->get('hotel_checkin');
        $check_out = $this->input->get('hotel_checkout');
        $rooms = $this->input->get('rooms');
        $adult = $this->input->get('adult');

        if (!empty($city_code) && !empty($check_in) && !empty($check_out)) {
            $data['city_code'] = $city_code;
			$cname=explode(", ",$explode[0]);
			$data['city_name'] = $cname[0];
			$data['country_name'] = $cname[1];
            $data['check_in'] = $check_in;
            $data['check_out'] = $check_out;
            $data['rooms'] = $rooms;
            $data['adult'] = $adult;
			$cin_val = explode("-",$check_in);
			$cout_val = explode("-",$check_out);
			$diff =  strtotime($cout_val[2].'-'.$cout_val[1].'-'.$cout_val[0])- strtotime($cin_val[2].'-'.$cin_val[1].'-'.$cin_val[0]) ;;
				$sec   = $diff % 60;
				$diff  = intval($diff / 60);
				$min   = $diff % 60;
				$diff  = intval($diff / 60);
				$hours = $diff % 24;
				$data['days'] =intval($diff / 24);
            $this->load->view('hotel/search', $data);
        } else {
            redirect('');
        }
    }

    public function hotel_details() {
        if (isset($_GET['sid']) && isset($_GET['hotelid']) && isset($_GET['city_code']) && isset($_GET['type']) && $_GET['city_code'] != '' && $_GET['sid'] != '' && $_GET['hotelid'] != '' && $_GET['type'] != '') {
            $data['sid'] = $_GET['sid'];
            $data['hotelid'] = $_GET['hotelid'];
			$data['city_code'] = $_GET['city_code'];
			if(isset($_GET['room_count'])){
			 $data['room_count'] = $_GET['room_count'];
			}else{
				$data['room_count'] =1;
			}
			
            //echo '<pre/>';
            //print_r($data);exit;
            $data['checkdate'] = 'notok';
            $data['checkin'] = '';
            $data['checkout'] = '';
            if (isset($_GET['checkin']) && isset($_GET['checkout']) && $_GET['checkin'] != '' && $_GET['checkout'] != '') {
                $data['checkdate'] = 'ok';
                $data['checkin'] = $_GET['checkin'];
                $data['checkout'] = $_GET['checkout'];
            }
            $data['adult'] = 1;
            if (isset($_GET['adult']) && $_GET['adult'] != '') {
                $data['adult'] = $_GET['adult'];
            }
            $type = $_GET['type'];
            $type = base64_decode(base64_decode($type));
            if($type == 'API'){
                $this->load->view('hotel/hotel_details', $data);
            }else if($type == 'CRS'){
                $data['images'] = $this->Hotel_Model->getCRSImages($data['hotelid'])->result();
                $data['hotel_data'] = $this->Hotel_Model->getCRSHotelbyid($data['hotelid'])->row();
                //echo '<pre/>';print_r($data['images']);exit;
                $this->load->view('hotel/hotel_details_crs', $data);
            }
        } else {
            redirect(WEB_URL);
        }
    }

    public function get_hotel_city_suggestions() {
        ini_set('memory_limit', '-1');
        $term = $this->input->get('term'); //retrieve the search term that autocomplete sends
        $term = trim(strip_tags($term));
        $hotels = $this->Hotel_Model->get_hotels_list($term);
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

    public function hotel_search_test() {
        $this->load->view('hotel/search_test');
    }

    public function hotel_search() {


        $data['city_code'] = $_POST['city_code'];
        $data['check_in'] = $_POST['check_in'];
        $data['check_out'] = $_POST['check_out'];
        $data['rooms'] = $_POST['rooms'];
        $data['adult'] = $_POST['adult'];
		if(isset($_POST['nextlink']))
		{
  $data['nextlink'] = $_POST['nextlink'];
   $data3['nextlink_set'] =$_POST['nextlink'];
		}
		else
		{
			  $data['nextlink'] ='';
			  $data3['nextlink_set'] ='';
		}

        $diff = abs(strtotime($data['check_out']) - strtotime($data['check_in']));

        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

        $data['days'] = $days;

        $returndata = get_hotel_search_results($data);
		$hotel_search_results = $returndata['response'];
		$xml_to_array = array();
		if($hotel_search_results!='')
		{
        $xml_to_array = $this->xml_to_array->XmlToArray($hotel_search_results);
		}
		if(isset($xml_to_array['SOAP:Body']['SOAP:Fault']))
		{
			  $xml_log = array(
          'Api' => 'UAPI',
          'XML_Type' => 'HOTEL - SEARCH RESULT - HotelSearchAvailabilityRes ERROR',
          'XML_Request' => $returndata['request'],
          'XML_Response' => $returndata['response'],
          'Ip_address' => $this->input->ip_address(),
          'XML_Time' => date('Y-m-d H:i:s')
		  );
		  $this->xml_model->insert_xml_log($xml_log);
		}
		
		$data3['city_code'] = $_POST['city_code'];
        $data3['check_in'] = $_POST['check_in'];
        $data3['check_out'] = $_POST['check_out'];
        $data3['rooms'] = $_POST['rooms'];
        $data3['adult'] = $_POST['adult'];
		
		
	$data3['nextlink']=	'';
$data3['Hotel_search_result']=array();


 //echo '<pre>';print_r($hotel_crs);die;

if(isset($xml_to_array['SOAP:Body']['hotel:HotelSearchAvailabilityRsp']['hotel:HotelSearchResult']))
{
        if (!empty($xml_to_array['SOAP:Body']['hotel:HotelSearchAvailabilityRsp']['hotel:HotelSearchResult'])) {
            $hotel_search_nodes = $xml_to_array['SOAP:Body']['hotel:HotelSearchAvailabilityRsp']['hotel:HotelSearchResult'];
			if(isset($xml_to_array['SOAP:Body']['hotel:HotelSearchAvailabilityRsp']['common_v28_0:NextResultReference']['@content']))
			{
			$data3['nextlink']=	$xml_to_array['SOAP:Body']['hotel:HotelSearchAvailabilityRsp']['common_v28_0:NextResultReference']['@content'];
			}
			
			
            $data3['Hotel_search_result'] = array();
            if (!empty($hotel_search_nodes)) {
                for ($k = 0; $k < count($hotel_search_nodes); $k++) {
                    if (!empty($hotel_search_nodes['hotel:HotelSearchError']['@attributes']['Code']) && $hotel_search_nodes['hotel:HotelSearchError']['@attributes']['Code'] != 5000) {
						
                        
                    } else {
						
						
                        if (isset($hotel_search_nodes[$k]['hotel:HotelProperty']['@attributes']['Availability'])) {
                            $data['ProviderCode'] = $hotel_search_nodes[$k]['common_v28_0:VendorLocation']['@attributes']['ProviderCode'];
                            $data['VendorCode'] = $hotel_search_nodes[$k]['common_v28_0:VendorLocation']['@attributes']['VendorCode'];
                            $data['VendorLocationID'] = $hotel_search_nodes[$k]['common_v28_0:VendorLocation']['@attributes']['VendorLocationID'];
                            $data['Key'] = $hotel_search_nodes[$k]['common_v28_0:VendorLocation']['@attributes']['Key'];
                            $data['Address'] = $hotel_search_nodes[$k]['hotel:HotelProperty']['hotel:PropertyAddress']['hotel:Address'];

                            $data['Amenity_val'] = array();
							if(isset( $hotel_search_nodes[$k]['hotel:HotelProperty']['hotel:Amenities']['hotel:Amenity']))
							{
                            $Amenity = $hotel_search_nodes[$k]['hotel:HotelProperty']['hotel:Amenities']['hotel:Amenity'];
                            if (isset($Amenity[0])) {

                                for ($l = 0; $l < count($Amenity); $l++) {
                                    if(isset($Amenity[$l]['@attributes']['Code'])){
                                        $data['Amenity_val'][] = $Amenity[$l]['@attributes']['Code'];
                                    }
                                }
                            }
							}
                            $data['HotelChain'] = $hotel_search_nodes[$k]['hotel:HotelProperty']['@attributes']['HotelChain'];
                            $data['HotelCode'] = $hotel_search_nodes[$k]['hotel:HotelProperty']['@attributes']['HotelCode'];
                            $data['HotelLocation'] = $hotel_search_nodes[$k]['hotel:HotelProperty']['@attributes']['HotelLocation'];
                            $data['Name'] = $hotel_search_nodes[$k]['hotel:HotelProperty']['@attributes']['Name'];
                            $data['VendorLocationKey'] = $hotel_search_nodes[$k]['hotel:HotelProperty']['@attributes']['VendorLocationKey'];
							 $data['HotelTransportation'] ='';
							if(isset($hotel_search_nodes[$k]['hotel:HotelProperty']['@attributes']['HotelTransportation']))
							{
                            $data['HotelTransportation'] = $hotel_search_nodes[$k]['hotel:HotelProperty']['@attributes']['HotelTransportation'];
							}
                            $data['ReserveRequirement'] = $hotel_search_nodes[$k]['hotel:HotelProperty']['@attributes']['ReserveRequirement'];
                            $data['ParticipationLevel'] = $hotel_search_nodes[$k]['hotel:HotelProperty']['@attributes']['ParticipationLevel'];
                            $data['Availability'] = $hotel_search_nodes[$k]['hotel:HotelProperty']['@attributes']['Availability'];
                            $data['MinimumAmount'] = 'Not Available';
                            if (isset($hotel_search_nodes[$k]['hotel:RateInfo']['@attributes']['MinimumAmount'])) {
		$TotalPrice = substr($hotel_search_nodes[$k]['hotel:RateInfo']['@attributes']['MinimumAmount'],3);
	    	$TotalPrice_Curr = substr($hotel_search_nodes[$k]['hotel:RateInfo']['@attributes']['MinimumAmount'],0,3);
		$aMarkup = $this->account_model->get_markup('HOTEL'); //get markup
		$aMarkup = $aMarkup['markup'];
		$MyMarkup = $this->account_model->get_my_markup(); //get agent markup
        $myMarkup = $MyMarkup['markup'];
		
	    	$TotalPrice = $this->flight_model->currency_convertor($TotalPrice,$TotalPrice_Curr,CURR);
            $TotalPrice = $this->account_model->PercentageToAmount($TotalPrice,$aMarkup);
	    	$TotalPrice = $this->account_model->PercentageToAmount($TotalPrice,$myMarkup);
			
			
                                $data['MinimumAmount'] = $TotalPrice;
                                $data['MyMarkup'] = $myMarkup;
								
                            }

                            $data3['Hotel_search_result'][] = $data;
                        }
                    }
                }
            }



           
        }
}
		 $_SESSION['travel_port'][] = $data3['Hotel_search_result'];
              //echo '<pre>';
            //print_r($data3);exit;
			//echo 'sdasss43';exit;
            $Html = $this->load->view('hotel/search_result_ajax', $data3, TRUE);

            echo json_encode(array('result' => $Html));
    }


function get_crs_rooms($hotelid, $city_code, $checkin, $checkout, $adult,$roomcount) {
    $data['rooms'] = $rooms = $this->Hotel_Model->getCRSRooms($hotelid)->result();
    $ex_cin = explode('-', $checkin);
    $ex_cout = explode('-', $checkout);

    $custom_cin = $ex_cin[2] . '-' . $ex_cin[1] . '-' . $ex_cin[0];
    $custom_cout = $ex_cout[2] . '-' . $ex_cout[1] . '-' . $ex_cout[0];

    $data['checkin'] = $custom_cin;
    $data['checkout'] = $custom_cout;
    $data['adult'] = $adult;
    $data['hotelid'] = $hotelid;
    $data['city_code'] = $city_code;
    $data['roomcount'] = $roomcount;
    $data['hotel_night_wise'] = $this->Hotel_Model->get_day_wise_chunks($custom_cin, $custom_cout);
    //echo '<pre>';print_r($hotel_night_wise);exit;
    if(!empty($rooms)){
        $hotel_rooms_val1 = $this->load->view('hotel/hotel_rooms_info_crs', $data, true);
    }else{
            $hotel_rooms_val1 = '<div id="cars" class="cars" novalidate="novalidate">                           <ul class="cardis cars"><div class="no_available">
    <div class="noresultimage"><img src="'.ASSETS.' images/noresult.png" alt=""></div>
    <h1>There are no rooms available. </h1>
    <div class="no_available_text">Sorry, we have no prices for rooms in this hotel. One or more of your preferences may be affecting the number of exact matches found. Try searching again with a wider search criteria. <br></div>
</div></ul>
                   </div>';
        $rooms = array();
    }
    print json_encode(array(
        'hotel_rooms_val1' => $hotel_rooms_val1,
        'Hotel_room_info' => count($rooms)
    ));
}



    function get_room_details($sid, $hotelid, $city_code, $checkin, $checkout, $adult,$roomcount) {

        $data['sid'] = $sid;
        $data['hotelid'] = $hotelid;
        $data['checkin'] = $checkin;
        $data['checkout'] = $checkout;
		$data['city_code'] = $city_code;
		$data['adult'] = $adult;
		$data['roomcount'] = $roomcount;

	    $MyMarkup = $this->account_model->get_my_markup(); //get agent markup
        //echo 'hello';print_r($MyMarkup);die;
        $myMarkup = $MyMarkup['markup'];
		$data['MyMarkup'] = $myMarkup;
        $return_data = get_hotel_rooms_results($data);
$hotel_rooms_results = $return_data['response'];

$xml_to_array_rooms = '';
		if($hotel_rooms_results!='')
		{
        $xml_to_array_rooms = $this->xml_to_array->XmlToArray($hotel_rooms_results);
		}

       
		
if(isset($xml_to_array_rooms['SOAP:Body']['SOAP:Fault']))
		{
			  $xml_log = array(
          'Api' => 'UAPI',
          'XML_Type' => 'HOTEL - HOTEL ROOMS - HotelDetailsRes ERROR',
          'XML_Request' => $return_data['request'],
          'XML_Response' => $return_data['response'],
          'Ip_address' => $this->input->ip_address(),
          'XML_Time' => date('Y-m-d H:i:s')
		  );
		  $this->xml_model->insert_xml_log($xml_log);
		}
		//echo '<pre/>';
		//print_r($xml_to_array_rooms);exit;
		if(isset($xml_to_array_rooms['SOAP:Body']['hotel:HotelDetailsRsp']['hotel:RequestedHotelDetails']['hotel:HotelRateDetail']))
		{
			
        $HotelRateDetailw = $xml_to_array_rooms['SOAP:Body']['hotel:HotelDetailsRsp']['hotel:RequestedHotelDetails']['hotel:HotelRateDetail'];
		$HotelRateDetail=array();
		if(!isset($xml_to_array_rooms['SOAP:Body']['hotel:HotelDetailsRsp']['hotel:RequestedHotelDetails']['hotel:HotelRateDetail'][0]))
		{
			
			$HotelRateDetail[] =$HotelRateDetailw;
		}
		else
		{
			$HotelRateDetail =$HotelRateDetailw;
		}


		
		$data['hotel_name'] = $xml_to_array_rooms['SOAP:Body']['hotel:HotelDetailsRsp']['hotel:RequestedHotelDetails']['hotel:HotelProperty']['@attributes']['Name'];
		
        $Hotel_room_info = array();
        if (!empty($HotelRateDetail)) {

            for ($d = 0; $d < count($HotelRateDetail); $d++) {
			//	echo '<pre/>';
//print_r($HotelRateDetail[$d]);exit;
			if(isset($HotelRateDetail[$d]['@attributes']['Total']))
			{
				
					
				


                $data['room_name'] = '';
                $RoomRateDescription_val = array();
	
                $RoomRateDescription = $HotelRateDetail[$d]['hotel:RoomRateDescription'];
                for ($ds = 0; $ds < count($RoomRateDescription); $ds++) {
                    if ($RoomRateDescription[$ds]['@attributes']['Name'] == 'Description') {
                        $data['room_name'] = $RoomRateDescription[$ds]['hotel:Text'];
                    } else {
                        $RoomRateDescription_val[] = array($RoomRateDescription[$ds]['@attributes']['Name'], $RoomRateDescription[$ds]['hotel:Text']);
                    }
                }
                if (isset($RoomRateDescription_val[0])) {
                    $data['RoomRateDescription'] = $RoomRateDescription_val;
                } else {
                    $data['RoomRateDescription'] = '';
                }



                $data['RatePlanType'] = $HotelRateDetail[$d]['@attributes']['RatePlanType'];
               
				$TotalPrice = substr($HotelRateDetail[$d]['@attributes']['Total'],3);
	    	$TotalPrice_Curr = substr($HotelRateDetail[$d]['@attributes']['Total'],0,3);
		$aMarkup = $this->account_model->get_markup('HOTEL'); //get markup
		$aMarkup = $aMarkup['markup'];


		
		
	    	$TotalPrice = $this->flight_model->currency_convertor($TotalPrice,$TotalPrice_Curr,CURR);
            $TotalPrice = $this->account_model->PercentageToAmount($TotalPrice,$aMarkup);
            $data['MyMarkup'] = $this->account_model->PercentageAmount($TotalPrice,$myMarkup);
	    	$TotalPrice = $this->account_model->PercentageToAmount($TotalPrice,$myMarkup);
				
			$data['Total'] = $TotalPrice;
           
			
			$data['org_Total'] =$HotelRateDetail[$d]['@attributes']['Total'];
			if (isset($HotelRateDetail[$d]['@attributes']['Surcharge'])) {
        	$TotalPrice1 = substr($HotelRateDetail[$d]['@attributes']['Surcharge'],3);
	    	$TotalPrice_Curr1 = substr($HotelRateDetail[$d]['@attributes']['Surcharge'],0,3);
		
	
	    	$TotalPrice1 = $this->flight_model->currency_convertor($TotalPrice1,$TotalPrice_Curr1,CURR);
            $TotalPrice1 = $this->account_model->PercentageToAmount($TotalPrice1,$aMarkup);
	    	$TotalPrice1 = $this->account_model->PercentageToAmount($TotalPrice1,$myMarkup);
			$data['Surcharge'] = $TotalPrice1;
			
			
			
                } else {
                   $data['Surcharge'] = 0;
                }

                
if(isset( $HotelRateDetail[$d]['hotel:CancelInfo']['@attributes']['NonRefundableStayIndicator']))
{
                $data['NonRefundableStayIndicator'] = $HotelRateDetail[$d]['hotel:CancelInfo']['@attributes']['NonRefundableStayIndicator'];
}
else
{
	  $data['NonRefundableStayIndicator'] ='';
}
				if(isset($HotelRateDetail[$d]['hotel:CancelInfo']['@attributes']['CancelDeadline']))
				{
					 $data['CancelDeadline'] = $HotelRateDetail[$d]['hotel:CancelInfo']['@attributes']['CancelDeadline'];
					 if(!isset($HotelRateDetail[$d]['hotel:CancelInfo']['@attributes']['CancelPenaltyAmount']))
						{
							  $data['CancelPenaltyAmount'] =0;
		//				echo '<pre/>'	;
			//			print_r($HotelRateDetail[$d]);exit;
						}
						else
						{
						$data['CancelPenaltyAmount'] = $HotelRateDetail[$d]['hotel:CancelInfo']['@attributes']['CancelPenaltyAmount'];
						}	
				}
               else
			   {
				    $data['CancelDeadline'] =date("Y-m-d");
					$data['CancelPenaltyAmount'] = $HotelRateDetail[$d]['@attributes']['Total'];
			   }
				
                $Hotel_room_info[] = $data;
				//echo $data['org_Total'];exit;
				//echo substr($data['org_Total'],3);exit;

				$ma_id = $this->Hotel_Model->insert_temp_result($data);	
			}
			elseif(isset($HotelRateDetail[$d]['hotel:HotelRateByDate']['@attributes']['Base']))
			{
		
                $data['room_name'] = '';
                $RoomRateDescription_val = array();
	
                $RoomRateDescription = $HotelRateDetail[$d]['hotel:RoomRateDescription'];
                for ($ds = 0; $ds < count($RoomRateDescription); $ds++) {
                    if ($RoomRateDescription[$ds]['@attributes']['Name'] == 'Description') {
                        $data['room_name'] = $RoomRateDescription[$ds]['hotel:Text'];
                    } else {
                        $RoomRateDescription_val[] = array($RoomRateDescription[$ds]['@attributes']['Name'], $RoomRateDescription[$ds]['hotel:Text']);
                    }
                }
                if (isset($RoomRateDescription_val[0])) {
                    $data['RoomRateDescription'] = $RoomRateDescription_val;
                } else {
                    $data['RoomRateDescription'] = '';
                }



                $data['RatePlanType'] = $HotelRateDetail[$d]['@attributes']['RatePlanType'];
               
				$TotalPrice = substr($HotelRateDetail[$d]['hotel:HotelRateByDate']['@attributes']['Base'],3);
	    	$TotalPrice_Curr = substr($HotelRateDetail[$d]['hotel:HotelRateByDate']['@attributes']['Base'],0,3);
		$aMarkup = $this->account_model->get_markup('HOTEL'); //get markup
		$aMarkup = $aMarkup['markup'];


		
		
	    	$TotalPrice = $this->flight_model->currency_convertor($TotalPrice,$TotalPrice_Curr,CURR);
            $TotalPrice = $this->account_model->PercentageToAmount($TotalPrice,$aMarkup);
            $data['MyMarkup'] = $this->account_model->PercentageAmount($TotalPrice,$myMarkup);
	    	$TotalPrice = $this->account_model->PercentageToAmount($TotalPrice,$myMarkup);
				
			$data['Total'] = $TotalPrice;
           
			
			$data['org_Total'] =$HotelRateDetail[$d]['hotel:HotelRateByDate']['@attributes']['Base'];
		
                   $data['Surcharge'] = 0;
               

                
if(isset( $HotelRateDetail[$d]['hotel:CancelInfo']['@attributes']['NonRefundableStayIndicator']))
{
                $data['NonRefundableStayIndicator'] = $HotelRateDetail[$d]['hotel:CancelInfo']['@attributes']['NonRefundableStayIndicator'];
}
else
{
	  $data['NonRefundableStayIndicator'] ='';
}
				if(isset($HotelRateDetail[$d]['hotel:CancelInfo']['@attributes']['CancelDeadline']))
				{
					 $data['CancelDeadline'] = $HotelRateDetail[$d]['hotel:CancelInfo']['@attributes']['CancelDeadline'];
					 if(!isset($HotelRateDetail[$d]['hotel:CancelInfo']['@attributes']['CancelPenaltyAmount']))
						{
							  $data['CancelPenaltyAmount'] =0;
		//				echo '<pre/>'	;
			//			print_r($HotelRateDetail[$d]);exit;
						}
						else
						{
						$data['CancelPenaltyAmount'] = $HotelRateDetail[$d]['hotel:CancelInfo']['@attributes']['CancelPenaltyAmount'];
						}	
				}
               else
			   {
				    $data['CancelDeadline'] =date("Y-m-d");
					$data['CancelPenaltyAmount'] = $HotelRateDetail[$d]['hotel:HotelRateByDate']['@attributes']['Base'];
			   }
				
                $Hotel_room_info[] = $data;
				//echo $data['org_Total'];exit;
				//echo substr($data['org_Total'],3);exit;
				$ma_id = $this->Hotel_Model->insert_temp_result($data);	
				
			}
			}
        }
       
 		$data2['Hotel_room_info'] = $this->Hotel_Model->get_temp_result($sid, $hotelid);

        $hotel_rooms_val1 = $this->load->view('hotel/hotel_rooms_info', $data2, true);

		}
		else
		{
			$hotel_rooms_val1 = '<div id="cars" class="cars" novalidate="novalidate">                   	    <ul class="cardis cars"><div class="no_available">
    <div class="noresultimage"><img src="'.ASSETS.'	images/noresult.png" alt=""></div>
    <h1>There are no rooms available. </h1>
    <div class="no_available_text">Sorry, we have no prices for rooms in this hotel. One or more of your preferences may be affecting the number of exact matches found. Try searching again with a wider search criteria. <br></div>
</div></ul>
                   </div>';
			$Hotel_room_info = array();
		}
        print json_encode(array(
            'hotel_rooms_val1' => $hotel_rooms_val1,
            'Hotel_room_info' => count($Hotel_room_info)
        ));
    }

    function get_cancel_policy($sid, $hotelid,$rate,$rateplan,$checkin,$checkout) {
        $data['sid'] = $sid;
        $data['hotelid'] = $hotelid;
		 $data['Base'] = $rate;
		  $data['RatePlanType'] = $rateplan;
		   $data['checkin'] = $checkin;
		    $data['checkout'] = $checkout;

        $returndata = get_cancellation_policy_results($data);

		$cancel_policy_results = $returndata['response'];
		$xml_to_array_details = '';
		if($cancel_policy_results!='')
		{
        $xml_to_array_details = $this->xml_to_array->XmlToArray($cancel_policy_results);
		}

        
		
if(isset($xml_to_array_details['SOAP:Body']['SOAP:Fault']))
		{
			  $xml_log = array(
          'Api' => 'UAPI',
          'XML_Type' => 'HOTEL - CANCELLATION POLICY - HotelRulesRes ERROR',
          'XML_Request' => $returndata['request'],
          'XML_Response' => $returndata['response'],
          'Ip_address' => $this->input->ip_address(),
          'XML_Time' => date('Y-m-d H:i:s')
		  );
		  $this->xml_model->insert_xml_log($xml_log);
		}
		
		
        $RoomRateDescription = $xml_to_array_details['SOAP:Body']['hotel:HotelRulesRsp']['hotel:HotelRateDetail']['hotel:RoomRateDescription'];
        $RoomRateDescription_v1 = array();
        if (!empty($RoomRateDescription)) {

            for ($l = 0; $l < count($RoomRateDescription); $l++) {
                $RoomRateDescriptionval = $RoomRateDescription[$l]['hotel:Text'];
                if (is_array($RoomRateDescriptionval)) {
                    $RoomRateDescriptionval1 = array();
                    for ($ll = 0; $ll < count($RoomRateDescriptionval); $ll++) {
                        $RoomRateDescriptionval1[] = $RoomRateDescriptionval[$ll];
                    }
                    $RoomRateDescriptionval_v1 = implode("<br>", $RoomRateDescriptionval1);
                } else {
                    $RoomRateDescriptionval_v1 = $RoomRateDescriptionval;
                }
                $RoomRateDescription_v1[] = array($RoomRateDescription[$l]['@attributes']['Name'], $RoomRateDescriptionval_v1);
            }
        }
        $data['RoomRateDescription_v1'] = $RoomRateDescription_v1;

//echo '<pre/>';
//print_r($xml_to_array_details);exit;
        ////////////////////////////
        $data['RatePlanType'] = $xml_to_array_details['SOAP:Body']['hotel:HotelRulesRsp']['hotel:HotelRateDetail']['@attributes']['RatePlanType'];
        $data['Base'] =0;
	   if(isset($xml_to_array_details['SOAP:Body']['hotel:HotelRulesRsp']['hotel:HotelRateDetail']['@attributes']['Base']))
	   {
	    $data['Base'] = $xml_to_array_details['SOAP:Body']['hotel:HotelRulesRsp']['hotel:HotelRateDetail']['@attributes']['Base'];
	   }
	   
		  $data['Tax'] = 0;
		if(isset( $xml_to_array_details['SOAP:Body']['hotel:HotelRulesRsp']['hotel:HotelRateDetail']['@attributes']['Tax']))
		{
			  $data['Tax'] = $xml_to_array_details['SOAP:Body']['hotel:HotelRulesRsp']['hotel:HotelRateDetail']['@attributes']['Tax'];
		}
      if(isset($xml_to_array_details['SOAP:Body']['hotel:HotelRulesRsp']['hotel:HotelRateDetail']['@attributes']['Total']))
	  {
       
	    $data['Total'] = $xml_to_array_details['SOAP:Body']['hotel:HotelRulesRsp']['hotel:HotelRateDetail']['@attributes']['Total'];
	  }
	  else
	  {
		   $data['Total'] =  $xml_to_array_details['SOAP:Body']['hotel:HotelRulesRsp']['hotel:HotelRateDetail']['hotel:HotelRateByDate']['@attributes']['Base'];
	  }
		 $data['Surcharge'] = 0;
if(isset($xml_to_array_details['SOAP:Body']['hotel:HotelRulesRsp']['hotel:HotelRateDetail']['@attributes']['Surcharge']))
{
        $data['Surcharge'] = $xml_to_array_details['SOAP:Body']['hotel:HotelRulesRsp']['hotel:HotelRateDetail']['@attributes']['Surcharge'];
}
        $HotelRuleItem = $xml_to_array_details['SOAP:Body']['hotel:HotelRulesRsp']['hotel:HotelRuleItem'];
        $HotelRuleItem_v1 = array();
        if (!empty($HotelRuleItem)) {

            for ($l = 0; $l < count($HotelRuleItem); $l++) {
                $HotelRuleItemval = $HotelRuleItem[$l]['hotel:Text'];
                if (is_array($HotelRuleItemval)) {
                    $HotelRuleItemval1 = array();
                    for ($ll = 0; $ll < count($HotelRuleItemval); $ll++) {
						if(!is_array($HotelRuleItemval[$ll]))
						{
                        $HotelRuleItemval1[] = $HotelRuleItemval[$ll];
						}
                    }
                    $HotelRuleItemval1_v1 = implode("<br>", $HotelRuleItemval1);
                } else {
                    $HotelRuleItemval1_v1 = $HotelRuleItemval;
                }
                $HotelRuleItem_v1[] = array($HotelRuleItem[$l]['@attributes']['Name'], $HotelRuleItemval1_v1);
            }
        }

        $data['HotelRuleItem_v1'] = $HotelRuleItem_v1;

        //echo '<pre/>';
        //print_r($data);exit;

        $hotel_rules_val1 = $this->load->view('hotel/hotel_room_rules_info', $data, true);

        print json_encode(array(
            'hotel_rules_val1' => $hotel_rules_val1
        ));


        //echo '<pre/>';
        //print_r($xml_to_array_details);exit;
    }

    function get_hotel_details($sid, $hotelid,$city_code, $checkin = '', $checkout = '', $adult = '', $roomcount = '') {

        $data['sid'] = $sid;
        $data['hotelid'] = $hotelid;
		 $data['city_code'] = $city_code;
		  $data['roomcount'] = $roomcount;
		 $data['locationcode'] = '';

        $returndata = get_hotel_details_results($data);
		
		$hotel_details_results = $returndata['response'];
		$xml_to_array_details = '';
		if($hotel_details_results!='')
		{
        $xml_to_array_details = $this->xml_to_array->XmlToArray($hotel_details_results);
		}
        
	
if(isset($xml_to_array_details['SOAP:Body']['SOAP:Fault']))
		{
			  $xml_log = array(
          'Api' => 'UAPI',
          'XML_Type' => 'HOTEL - HOTELDETAILS - HotelDetailsRes ERROR',
          'XML_Request' => $returndata['request'],
          'XML_Response' => $returndata['response'],
          'Ip_address' => $this->input->ip_address(),
          'XML_Time' => date('Y-m-d H:i:s')
		  );
		  $this->xml_model->insert_xml_log($xml_log);
		}
		$HotelProperty='';
		if(isset($xml_to_array_details['SOAP:Body']['hotel:HotelDetailsRsp']['hotel:RequestedHotelDetails']['hotel:HotelProperty']))
		{
        $HotelProperty = $xml_to_array_details['SOAP:Body']['hotel:HotelDetailsRsp']['hotel:RequestedHotelDetails']['hotel:HotelProperty'];
		}
		  $HotelDetailItem ='';
		if(isset($xml_to_array_details['SOAP:Body']['hotel:HotelDetailsRsp']['hotel:RequestedHotelDetails']['hotel:HotelDetailItem']))
		{
        $HotelDetailItem = $xml_to_array_details['SOAP:Body']['hotel:HotelDetailsRsp']['hotel:RequestedHotelDetails']['hotel:HotelDetailItem'];
		}
        if (!empty($HotelProperty)) {
            $data['hotel_location'] = $HotelProperty['@attributes']['HotelLocation'];
            $data['hotel_name'] = $HotelProperty['@attributes']['Name'];
            $data['hotel_chain'] = $HotelProperty['@attributes']['HotelChain'];
            $data['hotel_code'] = $HotelProperty['@attributes']['HotelCode'];
            $data['hotel_rating'] = '';
            if (isset($HotelProperty['hotel:HotelRating']['hotel:Rating'])) {
                $data['hotel_rating'] = $HotelProperty['hotel:HotelRating']['hotel:Rating'];
            }

            $contact_details_val = array();
            $contact_details = $HotelProperty['common_v28_0:PhoneNumber'];
            for ($d = 0; $d < count($contact_details); $d++) {
                $contact_details_val[] = array($contact_details[$d]['@attributes']['Type'], $contact_details[$d]['@attributes']['Number']);
            }
            if (isset($contact_details_val[0])) {
                $data['contact_details'] = $contact_details_val;
            } else {
                $data['contact_details'] = '';
            }

            $address_details_val = array();
            $address_details = $HotelProperty['hotel:PropertyAddress']['hotel:Address'];
            for ($d = 0; $d < count($address_details); $d++) {
                $address_details_val[] = $address_details[$d];
            }
            if (isset($address_details_val[0])) {
                $data['address_details'] = implode("<br>", $address_details_val);
            } else {
                $data['address_details'] = '';
            }
        }
		else
		{
			 $data['contact_details'] = '';
			$data['hotel_location'] = '';
            $data['hotel_name'] = '';
            $data['hotel_chain'] ='';
            $data['hotel_code'] = '';
             $data['hotel_rating'] = '';
			  $data['address_details'] = '';
		}
        if (!empty($HotelDetailItem)) {
            $textcontent = array();
            for ($d = 0; $d < count($HotelDetailItem); $d++) {

                $textcontent[] = array($HotelDetailItem[$d]['@attributes']['Name'], $HotelDetailItem[$d]['hotel:Text']);
            }

            if (isset($textcontent[0])) {
                $data['hotel_details'] = $textcontent;
            } else {
                $data['hotel_details'] = '';
            }
        }

        $data['checkdate'] = 'notok';
        $data['checkin'] = '';
        $data['checkout'] = '';
        if (isset($checkin) && isset($checkout) && $checkin != '' && $checkout != '') {
            $data['checkdate'] = 'ok';
            $data['checkin'] = $checkin;
            $data['checkout'] = $checkout;
        }
        $data['adult'] = 1;
        if (isset($adult) && $adult != '') {
            $data['adult'] = $adult;
        }

        $data['DetailUrl'] = WEB_URL . '/hotel/hotel_details?sid=' . $sid . '&hotelid=' . $hotelid;

        $hotel_details_val1 = $this->load->view('hotel/hotel_details_info', $data, true);

        print json_encode(array(
            'hotel_details_val1' => $hotel_details_val1
        ));
    }

    function get_hotel_images($sid, $hotelid) {
        $data['sid'] = $sid;
        $data['hotelid'] = $hotelid;
        $hotel_image_results = get_hotel_image_results($data);

       
		$xml_to_array_image = '';
		if($hotel_image_results!='')
		{
         $xml_to_array_image = $this->xml_to_array->XmlToArray($hotel_image_results);
		}
        
		
	if(isset($xml_to_array_image['SOAP:Body']['hotel:HotelMediaLinksRsp']['hotel:HotelPropertyWithMediaItems']['common_v28_0:MediaItem']))
	{	
        $hotel_images = $xml_to_array_image['SOAP:Body']['hotel:HotelMediaLinksRsp']['hotel:HotelPropertyWithMediaItems']['common_v28_0:MediaItem'];


        $hotel_images_val = array();
        if (!empty($hotel_images)) {
            for ($k = 0; $k < count($hotel_images); $k++) {
                if (isset($hotel_images[$k]['@attributes']['sizeCode'])) {
                    $sizecode = $hotel_images[$k]['@attributes']['sizeCode'];
                    if ($sizecode == 'H') {

                        $hotel_images_val[] = array($hotel_images[$k]['@attributes']['caption'], $hotel_images[$k]['@attributes']['url']);
                    }
                }
            }
			
			if (empty($hotel_images_val)) {
			for ($k = 0; $k < count($hotel_images); $k++) {
                if (isset($hotel_images[$k]['@attributes']['sizeCode'])) {
                    $sizecode = $hotel_images[$k]['@attributes']['sizeCode'];
                    if ($sizecode == 'E') {

                        $hotel_images_val[] = array($hotel_images[$k]['@attributes']['caption'], $hotel_images[$k]['@attributes']['url']);
                    }
                }
            }
			}
			
			
        }

        $data['hotel_images_val'] = $hotel_images_val;
	}
	else
	{
		$data['hotel_images_val'] = array();
	}
        $hotel_images_val1 = $this->load->view('hotel/hotel_image_slider', $data, true);
	//	echo $hotel_images_val1;
//echo '<pre/>';
//print_r($hotel_images);exit;
        print json_encode(array(
            'hotel_images_val1' => $hotel_images_val1
        ));
    }
    
	function get_single_hotel_images($sid, $hotelid) {
		$data['sid'] = $sid;
		$data['hotelid'] = $hotelid;
		$hotel_image_results = get_hotel_image_results($data);
		
		
		$xml_to_array_image = '';
		if($hotel_image_results!='')
		{
        $xml_to_array_image = $this->xml_to_array->XmlToArray($hotel_image_results);
		}
		
        $hotel_images = $xml_to_array_image['SOAP:Body']['hotel:HotelMediaLinksRsp']['hotel:HotelPropertyWithMediaItems']['common_v28_0:MediaItem'];
		

        $hotel_images_val = array();
        if (!empty($hotel_images)) {
            for ($k = 0; $k < count($hotel_images); $k++) {
                if (isset($hotel_images[$k]['@attributes']['sizeCode'])) {
                    $sizecode = $hotel_images[$k]['@attributes']['sizeCode'];
                    if ($sizecode == 'M') {

                        $hotel_images_val[] = array($hotel_images[$k]['@attributes']['caption'], $hotel_images[$k]['@attributes']['url']);
                    }
                }
            }
        }
        
        if(!empty($hotel_images_val[0][1])){
			$data['hotel_images_val'] = $hotel_images_val[0][1];
		}
		else{
			$data['hotel_images_val'] = ""	;
		}
        
        echo json_encode(array('result' => $data['hotel_images_val']));
	}
	public function AddToCart(){
		$type = $_GET['type'];
		$type = base64_decode(base64_decode($type));
        
        if($type == 'API'){
		    $result = $this->Hotel_Model->get_temp_result_id($_GET['temp_id']);
            $cart_hotel = array(
                'session_id' => $result->session_id,
                'api' => $result->api,
                'hotel_name' => $result->hotel_name,
                'imageurl' => $this->input->get('imageurl'),
                'hotel_code' => $result->hotel_code,
                'chain_code' => $result->chain_code,
                'checkin' => $result->checkin,
                'checkout' => $result->checkout,
                'room_name' => $result->room_name,
                'room_code' => $result->room_code,
                'city' => $result->city,
                'org_amount'=> $result->org_amount,
                'city_code' => $result->city_code,
                'roomdescription' => $result->roomdescription,
                'MyMarkup' => $result->MyMarkup,
                'total_cost' => $result->total_cost,
                'base_cost' => $result->base_cost,
                'NonRefundableStayIndicator' => $result->NonRefundableStayIndicator,
                'CancelDeadline' => $result->CancelDeadline,
                'CancelPenaltyAmount' => $result->CancelPenaltyAmount,
                'CancelPenaltyAmount_currency' => $result->CancelPenaltyAmount_currency,
                'status' => $result->status,
                'adult' => $result->adult,
                'room_count' => $result->room_count,
                'SITE_CURR' => CURR,
                'currency' => $result->currency,
                'TIMESTAMP' => date('Y-m-d H:i:s')
            );
        }else if($type == 'CRS'){
            $result = $this->Hotel_Model->get_temp_result_crs($_GET['temp_id'])->row();
            $cart_hotel = array(
                'session_id' => $result->session_id,
                'api' => $result->api,
                'hotel_name' => $result->hotel_name,
                'imageurl' => $this->input->get('imageurl'),
                'hotel_code' => $result->hotel_id,
                'chain_code' => '',
                'checkin' => $result->checkin,
                'checkout' => $result->checkout,
                'room_name' => $result->room_name,
                'room_code' => $result->room_id,
                'city' => $result->city,
                'org_amount'=> '',
                'city_code' => $result->city_code,
                'roomdescription' => $result->roomdescription,
                'MyMarkup' => $result->MyMarkup,
                'total_cost' => $result->total_cost,
                'base_cost' => 0,
                'NonRefundableStayIndicator' => '',
                'CancelPolicy' => $result->CancelPolicy,
                'CancelDeadline' => $result->CancelDeadline,
                'CancelCommision'=> $result->CancelCommision,
                'CancelPenaltyAmount' => 0,
                'CancelPenaltyAmount_currency' => 0,
                'status' => $result->status,
                'adult' => $result->adult,
                'room_count' => $result->room_count,
                'SITE_CURR' => CURR,
                'currency' => $result->currency,
                'TIMESTAMP' => date('Y-m-d H:i:s')
            );
        }
		// /echo '<pre/>';print_r($result);exit;

	    	
			//echo '<pre/>';print_r($cart_hotel);exit;
			$booking_cart_id = $this->Hotel_Model->insert_cart_hotel($cart_hotel);
            //echo $booking_cart_id;die;
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
	            'module' => 'HOTEL',
	            'user_type' => $user_type,
	            'user_id' => $user_id,
	            'session_id' => $session_id,
	            'site_curr' => CURR,
	            'total' => $result->total_cost,
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
		                    'TOTAL' => $cart->TOTAL,
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
                            'TOTAL' => $cart->TotalPrice,
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
                            'TOTAL' => $cart->TotalPrice,
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
                            'TOTAL' => $cart->TotalPrice,
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
	
    function get_random_hotel_images($sid, $hotelid) {
        $data['sid'] = $sid;
        $data['hotelid'] = $hotelid;
        $hotel_image_results = get_hotel_image_results($data);
$xml_to_array_image = '';
		if($hotel_image_results!='')
		{
        $xml_to_array_image = $this->xml_to_array->XmlToArray($hotel_image_results);
		}
        if(isset( $xml_to_array_image['SOAP:Body']['hotel:HotelMediaLinksRsp']['hotel:HotelPropertyWithMediaItems']['common_v28_0:MediaItem']))
		{
        $hotel_images = $xml_to_array_image['SOAP:Body']['hotel:HotelMediaLinksRsp']['hotel:HotelPropertyWithMediaItems']['common_v28_0:MediaItem'];


        $hotel_images_val = array();
        if (!empty($hotel_images)) {
            for ($k = 0; $k < count($hotel_images); $k++) {
                if (isset($hotel_images[$k]['@attributes']['sizeCode'])) {
                    $sizecode = $hotel_images[$k]['@attributes']['sizeCode'];
                    if ($sizecode == 'M') {

                        $hotel_images_val[] = $hotel_images[$k]['@attributes']['url'];
                    }
                }
            }
        }
		
        if (isset($hotel_images_val[0]) && $hotel_images_val[0] != '') {		          
            print json_encode(array(
                'hotel_images_val1' => $hotel_images_val
            ));
        } else {
            print json_encode(array(
                'hotel_images_val1' => ASSETS.'images/ftrlogo.png'
            ));
        }
		}
		else
		{
			  print json_encode(array(
                'hotel_images_val1' => ASSETS.'images/ftrlogo.png'
            ));
		}
    }

    public function hotel_search_sanjay() {


        $data['city_code'] = $_POST['city_code'];
        $data['check_in'] = $_POST['check_in'];
        $data['check_out'] = $_POST['check_out'];
        $data['rooms'] = $_POST['rooms'];
        $data['adult'] = $_POST['adult'];



        $diff = abs(strtotime($data['check_out']) - strtotime($data['check_in']));

        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

        $data['days'] = $days;

        $hotel_search_results = get_hotel_search_results($data);
$xml_to_array = '';
		if($hotel_search_results!='')
		{
         $xml_to_array = $this->xml_to_array->XmlToArray($hotel_search_results);

		}
       
        if (!empty($xml_to_array['SOAP:Body']['hotel:HotelSearchAvailabilityRsp']['hotel:HotelSearchResult'])) {
            $hotel_search_nodes = $xml_to_array['SOAP:Body']['hotel:HotelSearchAvailabilityRsp']['hotel:HotelSearchResult'];

            $provider_code = array();
            $VendorCode = array();
            $VendorLocationID = array();
            $Key = array();
            $hotel_address = array();
            $direction_units = array();
            $direction_value = array();
            $direction = array();

            $hotel_chain = array();
            $hotel_code = array();
            $hotel_location = array();
            $hotel_name = array();
            $hotel_vendorlocation_key = array();
            $hotel_transportation = array();
            $hotel_reserverequirement = array();
            $partipationlevel = array();


            if (!empty($hotel_search_nodes)) {
                foreach ($hotel_search_nodes as $key => $value) {

                    if (!empty($value['hotel:HotelSearchError']['@attributes']['Code']) && $value['hotel:HotelSearchError']['@attributes']['Code'] != 5000) {
                        
                    } else {


                        $provider_code[] = $value['common_v28_0:VendorLocation']['@attributes']['ProviderCode'];
                        $VendorCode[] = $value['common_v28_0:VendorLocation']['@attributes']['VendorCode'];

                        $VendorLocationID[] = $value['common_v28_0:VendorLocation']['@attributes']['VendorLocationID'];
                        $Key[] = $value['common_v28_0:VendorLocation']['@attributes']['Key'];
                        $hotel_address[] = $value['hotel:HotelProperty']['hotel:PropertyAddress']['hotel:Address'];

                        $direction_units[] = $value['hotel:HotelProperty']['common_v28_0:Distance']['@attributes']['Units'];
                        $direction_value[] = $value['hotel:HotelProperty']['common_v28_0:Distance']['@attributes']['Value'];
                        $direction[] = $value['hotel:HotelProperty']['common_v28_0:Distance']['@attributes']['Direction'];

                        $hotel_chain[] = $value['hotel:HotelProperty']['@attributes']['HotelChain'];
                        $hotel_code[] = $value['hotel:HotelProperty']['@attributes']['HotelCode'];
                        $hotel_location[] = $value['hotel:HotelProperty']['@attributes']['HotelLocation'];
                        $hotel_name[] = $value['hotel:HotelProperty']['@attributes']['Name'];
                        $hotel_vendorlocation_key[] = $value['hotel:HotelProperty']['@attributes']['VendorLocationKey'];
                        $hotel_transportation[] = $value['hotel:HotelProperty']['@attributes']['HotelTransportation'];
                        $hotel_reserverequirement[] = $value['hotel:HotelProperty']['@attributes']['ReserveRequirement'];
                        $partipationlevel[] = $value['hotel:HotelProperty']['@attributes']['ParticipationLevel'];
                    }
                }
            }

            $insertion_data = array();

            $insertion_data[] = array('provider_code' => $provider_code,
                'VendorCode' => $VendorCode,
                'VendorLocationID' => $VendorLocationID,
                'Key' => $Key,
                'hotel_address' => $hotel_address,
                'direction_units' => $direction_units,
                'direction_value' => $direction_value,
                'direction' => $direction,
                'hotel_chain' => $hotel_chain,
                'hotel_code' => $hotel_code,
                'hotel_location' => $hotel_location,
                'hotel_name' => $hotel_name,
                'hotel_vendorlocation_key' => $hotel_vendorlocation_key,
                'hotel_transportation' => $hotel_transportation,
                'hotel_reserverequirement' => $hotel_reserverequirement,
                'partipationlevel' => $partipationlevel
            );

            $_SESSION['travel_port'][] = $insertion_data;
            
            $Html = $this->load->view('hotel/search_result_ajax', '', TRUE);

            echo json_encode(array('result' => $Html));
        }
    }

    public function voucher($pnr_no){
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
                
                //$data['Map'] = $this->getStaticMap($data['Booking']->PROP_LATITUDE, $data['Booking']->PROP_LONGITUDE);
                $data['host_profile_link'] = WEB_URL.'/users/show/'.$data['Booking']->user_id;
                //$data['apt_link'] = WEB_URL.'/apartment/rooms/'.$data['Booking']->PROP_ID;
                $this->load->view('hotel/voucher_view', $data);
            }
        }else{
             $this->load->view('errors/404');
        }
    }
    
    public function invoice($pnr_no){
	 if($this->session->userdata('b2b_id')){
		 
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
                
                //$data['Map'] = $this->getStaticMap($data['Booking']->PROP_LATITUDE, $data['Booking']->PROP_LONGITUDE);
                $data['host_profile_link'] = WEB_URL.'/users/show/'.$data['Booking']->user_id;
                //$data['apt_link'] = WEB_URL.'/apartment/rooms/'.$data['Booking']->PROP_ID;
                $this->load->view('hotel/invoice_view', $data);
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
            if($count == 1){
                $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
                if($b_data->module == 'HOTEL'){
                    $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
                    $data['global'] = $booking1 = $this->booking_model->getBookingPnr($pnr_no)->row();
                    $checkin_date = strtotime($booking->checkin);
                    $checkout_date = strtotime($booking->checkout);
                    
                    $absDateDiff = abs($checkout_date - $checkin_date);
                    $data['number_of_nights'] = floor($absDateDiff/(60*60*24));
                    
                    //$data['Map'] = $this->getStaticMap($data['Booking']->PROP_LATITUDE, $data['Booking']->PROP_LONGITUDE);
                    $data['host_profile_link'] = WEB_URL.'/users/show/'.$data['Booking']->user_id;
                    //$data['apt_link'] = WEB_URL.'/apartment/rooms/'.$data['Booking']->PROP_ID;
                    $this->load->view('hotel/invoice_view', $data);
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
            if($b_data->module == 'HOTEL'){
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
                $data['global'] = $booking1 = $this->booking_model->getBookingPnr($pnr_no)->row();
                $checkin_date = strtotime($booking->checkin);
                $checkout_date = strtotime($booking->checkout);
                
                $absDateDiff = abs($checkout_date - $checkin_date);
                $data['number_of_nights'] = floor($absDateDiff/(60*60*24));
                $data['message'] = $this->load->view('hotel/mail_invoice', $data,TRUE);
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

 
    public function cancel($pnr_no){
        $pnr_no = base64_decode(base64_decode($pnr_no));
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1) {
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            //echo '<pre>';print_r($b_data);die;
            if($b_data->booking_status == 'CONFIRMED'){
                $CancelReq_Res = CancelReq($b_data->booking_no);
				$CancelRes = $CancelReq_Res['CancelRes'];
              
			if($CancelRes!='')
			{
         $CancelRes = $this->xml_to_array->XmlToArray($CancelRes);
		
 if(isset($CancelRes['SOAP:Body']['SOAP:Fault'])){
            $xml_log = array(
                'Api' => 'UAPI',
                'XML_Type' => 'HOTEL - CANCELLATION -UniversalRecordCancelRsp ERROR',
                'XML_Request' => $CancelReq_Res['CancelReq'],
                'XML_Response' => $CancelReq_Res['CancelRes'],
                'Ip_address' => $this->input->ip_address(),
                'XML_Time' => date('Y-m-d H:i:s')
            );
            $this->xml_model->insert_xml_log($xml_log);
            return false;
        }
		
		
                //echo '<pre>';print_r($CancelRes);die;
                if(isset($CancelRes['SOAP:Body']['universal:UniversalRecordCancelRsp'])){
                    $CancelRes = $CancelRes['SOAP:Body']['universal:UniversalRecordCancelRsp']['universal:ProviderReservationStatus'];
                    $CancelResAttr = $CancelRes['@attributes'];
                    if($CancelResAttr['Cancelled']){
                        //echo '<pre>';print_r($CancelResAttr);die;
                        $update_booking = array(
                            'booking_status' => 'CANCELED'
                        );
                        $this->booking_model->Update_Booking_Global($pnr_no, $update_booking, 'HOTEL');
                        //$this->cancel_mail_voucher($pnr_no);

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
                        echo json_encode($response);
                    }
                }
				else
				{

					  $xml_log = array(
                        'Api' => 'UAPI',
                        'XML_Type' => 'HOTEL - CANCELLATION -UniversalRecordCancelRsp EMPTY - ERROR',
                        'XML_Request' => $CancelReq_Res['CancelReq'],
                        'XML_Response' => $CancelReq_Res['CancelRes'],
                        'Ip_address' => $this->input->ip_address(),
                        'XML_Time' => date('Y-m-d H:i:s')
                    );
                    $this->xml_model->insert_xml_log($xml_log);
				}
			}else{
            $response = array('status' => 0);
            echo json_encode($response);
        }
			
            }else{
            $response = array('status' => 0);
            echo json_encode($response);
        }
        }else{
            $response = array('status' => 0);
            echo json_encode($response);
        }
    }

    

}
