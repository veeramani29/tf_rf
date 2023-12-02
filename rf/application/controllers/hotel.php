<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hotel extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Auth_Model');
        $current_url = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
        $current_url = $this->config->site_url() . $this->uri->uri_string() . $current_url;
        $this->url = array(
            'continue' => $current_url
            );
      
        $this->helpMenuLink = "";
        $this->load->model('Help_Model');
        $this->helpMenuLink = $this->Help_Model->fetchHelpLinks();
        $this->load->model('example_model');
        $this->load->model('Hotel_Model');
        $this->load->model('Flight_Model');
        $this->load->helper('hotel_helper');
        $this->load->helper('flight_helper');
        $this->load->model('booking_model');
        $this->load->model('email_model');
        $this->load->model('Cart_Model');


        $this->load->library('xml_to_array');

        $controller = $this->router->fetch_class();
        parent::validate_modules($controller);
    }

    public function home(){

    
    	  $this->session->set_userdata($this->url);
    	//$data['banners'] = $this->Help_Model->getHomeSettings();
    	//$data['portfolio'] = $this->Help_Model->getAllPortfolio();
        $data['hotel_amenities']=$this->Hotel_Model->travelport_hotel_amenities();
        //$data['room_types']=$this->Hotel_Model->room_types();
        $data['discounted_flights'] = $this->flight_model->get_discounted_flights('Flight');
        $data['discounted_hotels'] = $this->flight_model->get_discounted_flights('Hotel');
        $this->load->view('hotel/hotel_index',$data);	
    }
    
    public function search() {


        $checkin_explode_date = explode('/', $this->input->post('hotel_checkin'));
        $checkout_explode_date = explode('/', $this->input->post('hotel_checkout'));
        $checkin_explode_date=array_reverse($checkin_explode_date);
        $checkout_explode_date=array_reverse($checkout_explode_date);
        $check_in =implode('-',$checkin_explode_date);
        $check_out =implode('-',$checkout_explode_date);

        $explode = explode('  - ', $this->input->post('hotel_city'));
        $city_code = isset($explode[1])?trim($explode[1]):$explode[0];
        $check_in = $check_in;
        $check_out = $check_out;
        $rooms = $this->input->post('rooms');
        $adult = $this->input->post('adult');
        $child = $this->input->post('child');
        $Amenities='';
        
        $Facilities =($this->input->post('Facil')!=null)?$this->input->post('Facil'):'';
        $Area = $this->input->post('Area');
        $RoomType = $this->input->post('RoomType');
        $MinPrice = $this->input->post('MinPrice');
        $MaxPrice = $this->input->post('MaxPrice');
        $Amenities=$Facilities;
        





   if (!empty($city_code) && !empty($check_in) && !empty($check_out) && !empty($rooms) && !empty($adult)) {
    $request['city_name_full'] = $this->input->post('hotel_city');
    $request['city_code'] = $city_code;
    $request['check_in'] = $check_in;
    $request['check_out'] = $check_out;
    $request['rooms'] = $rooms;
    $request['adult'] = $adult;
    $request['child'] = $child;
    $cname=explode(", ",$explode[0]);
    $request['city_name'] = isset($cname[0])?$cname[0]:'';
    $request['country_name'] = isset($cname[1])?$cname[1]:'';

    $request['Amenities'] = $Amenities;

    $request['area'] = $Area;
   
    $request['min_price'] = $MinPrice;
    $request['max_price'] = $MaxPrice;

    if($this->input->post('nextlink')!=null)
    {
        $request['nextlink'] = $this->input->post('nextlink');
        $request['nextlink_set'] = $this->input->post('nextlink');
    }
    else
    {
        $request['nextlink'] ='';
        $request['nextlink_set'] = '';

    }

    $diff =  strtotime($request['check_out'])- strtotime($request['check_in']) ;;
    $sec   = $diff % 60;
    $diff  = intval($diff / 60);
    $min   = $diff % 60;
    $diff  = intval($diff / 60);
    $hours = $diff % 24;
    $request['days'] =intval($diff / 24);

    $data['Hotel_search_result']=array();
    $returndata = get_hotel_search_results(base64_encode(json_encode($request)));

    $data['Hotel_search_result']=$this->formatResponse($returndata); 

    $data['request']  = $request;
//echo "<pre>"; print_r($data); exit;
    $allview=$this->load->view('hotel/results', $data);
    echo $allview;
} else {
    redirect('');
}


}



public function hotel_search() {


    $data['city_code'] = $this->input->post('city_code');
    $data['check_in'] = $this->input->post('check_in');
    $data['check_out'] = $this->input->post('check_out');
    $data['rooms'] = $this->input->post('rooms');
    $data['adult'] = $this->input->post('adult');
    $data['child'] = $this->input->post('child');
    $data['area'] = $this->input->post('Area');
    $data['room_type'] = $this->input->post('room_type');
    $data['Amenities'] = base64_decode(json_decode($this->input->post('Amenities')));
    $data['min_price'] = $this->input->post('min_price');
    $data['max_price'] = $this->input->post('max_price');

    if($this->input->post('nextlink')!=null)
    {
        $data['nextlink'] = $this->input->post('nextlink');
        $data['nextlink_set'] = $this->input->post('nextlink');
    }
    else
    {
        $data['nextlink'] ='';
        $data['nextlink_set'] = '';

    }
    $data['days'] =$this->input->post('days');

    $returndata = get_hotel_search_results(base64_encode(json_encode($data)));
    //echo "<pre>"; print_r($returndata); exit;
     $hotel_search_results=$returndata['response'];
    $data['Hotel_search_result']=array();
    if($hotel_search_results!=''){
        $data['Hotel_search_result']=$this->formatResponse($returndata);

    }
    $data['request']  = $data;
//print_r();
//echo $data['Hotel_search_result']['nextlink'];
    $Html = $this->load->view('hotel/ajax_results', $data, TRUE);

    echo json_encode(array('result' => $Html,'nextlink' => (isset($data['Hotel_search_result']['nextlink'])?$data['Hotel_search_result']['nextlink']:'')));
}

public function GetAgain($request) {


       

    $returndata = get_hotel_search_results($request);
     $hotel_search_results=$returndata['response'];
    $data['Hotel_search_result']=array();
    if($hotel_search_results!=''){
        $data['Hotel_search_result']=$this->formatResponse($returndata);

    }
        $request=json_decode(base64_decode($request));
       
            $data['days']='';
            $data['nextlink']='';
            $data['min_price']='';
            $data['max_price']='';
            $data['max_price']='';
            $data['check_in']=$request->checkin;
            $data['check_out']=$request->checkout;
            $data['rooms']=$request->roomcount;
            $data['city_code']=$request->city_code;
            $data['adult']=$request->adult;
            $data['child']=$request->child;
            $country=$this->Flight_Model->get_airport_countryname($request->city_code);
            $city=$this->Flight_Model->get_airport_cityname($request->city_code);
            $data['city_name']=$city;
            $data['country_name']=$country;
            $data['request']  = $data;
    
            
//ob_start();
//ob_end_clean();

 $allview=$this->load->view('hotel/results', $data,TRUE);
  


    echo json_encode(array('result' => $allview));
}


public function formatResponse($hotel_search_results){


    $xml_to_array = array();
    $Hotel_search_result= array();
    if($hotel_search_results['response']!='')
    {
        $xml_to_array = $this->xml_to_array->XmlToArray($hotel_search_results['response']);
    }
        

    if(isset($xml_to_array['SOAP:Body']['SOAP:Fault']))
    {
      $xml_log = array(
          'Api' => 'UAPI',
          'XML_Type' => 'HOTEL - SEARCH RESULT - HotelSearchAvailabilityRes ERROR',
          'XML_Request' => $hotel_search_results['request'],
          'XML_Response' => $hotel_search_results['response'],
          'Ip_address' => $this->input->ip_address(),
          'XML_Time' => date('Y-m-d H:i:s')
          );
      $this->xml_model->insert_xml_log($xml_log);
      return false;
  }else{

    if(isset($xml_to_array['SOAP:Body']['hotel:HotelSearchAvailabilityRsp']['hotel:HotelSearchResult']))
    {
        if (!empty($xml_to_array['SOAP:Body']['hotel:HotelSearchAvailabilityRsp']['hotel:HotelSearchResult'])) {
            $hotel_search_nodes = $xml_to_array['SOAP:Body']['hotel:HotelSearchAvailabilityRsp']['hotel:HotelSearchResult'];
            if(isset($xml_to_array['SOAP:Body']['hotel:HotelSearchAvailabilityRsp']['common_v33_0:NextResultReference']['@content']))
            {
                $Hotel_search_result['nextlink']= $xml_to_array['SOAP:Body']['hotel:HotelSearchAvailabilityRsp']['common_v33_0:NextResultReference']['@content'];
            }
            if(isset($xml_to_array['SOAP:Body']['hotel:HotelSearchAvailabilityRsp']['hotel:ReferencePoint']))
            {  

                 $Hotel_search_result['ReferencePoint']= isset($xml_to_array['SOAP:Body']['hotel:HotelSearchAvailabilityRsp']['hotel:ReferencePoint']['@content'])?$xml_to_array['SOAP:Body']['hotel:HotelSearchAvailabilityRsp']['hotel:ReferencePoint']['@content']:$xml_to_array['SOAP:Body']['hotel:HotelSearchAvailabilityRsp']['hotel:ReferencePoint'];
             
            }

          
            

            if (!empty($hotel_search_nodes)) {
                for ($k = 0; $k < count($hotel_search_nodes); $k++) {
                    if (!empty($hotel_search_nodes['hotel:HotelSearchError']['@attributes']['Code']) && $hotel_search_nodes['hotel:HotelSearchError']['@attributes']['Code'] != 5000) {


                    } else {


                        if (isset($hotel_search_nodes[$k]['hotel:HotelProperty']['@attributes']['Availability'])) {
                            $data['ProviderCode'] = isset($hotel_search_nodes[$k]['common_v33_0:VendorLocation']['@attributes']['ProviderCode'])?$hotel_search_nodes[$k]['common_v33_0:VendorLocation']['@attributes']['ProviderCode']:'';
                            $data['VendorCode'] = isset($hotel_search_nodes[$k]['common_v33_0:VendorLocation']['@attributes']['VendorCode'])?$hotel_search_nodes[$k]['common_v33_0:VendorLocation']['@attributes']['VendorCode']:'';
                            $data['VendorLocationID'] = isset($hotel_search_nodes[$k]['common_v33_0:VendorLocation']['@attributes']['VendorLocationID'])?$hotel_search_nodes[$k]['common_v33_0:VendorLocation']['@attributes']['VendorLocationID']:'';
                            $data['Key'] = isset($hotel_search_nodes[$k]['common_v33_0:VendorLocation']['@attributes']['Key'])?$hotel_search_nodes[$k]['common_v33_0:VendorLocation']['@attributes']['Key']:'';
                            $data['Address'] = isset($hotel_search_nodes[$k]['hotel:HotelProperty']['hotel:PropertyAddress']['hotel:Address'])?$hotel_search_nodes[$k]['hotel:HotelProperty']['hotel:PropertyAddress']['hotel:Address']:'';


$hotel_distance=isset($hotel_search_nodes[$k]['hotel:HotelProperty']['common_v33_0:Distance'])?$hotel_search_nodes[$k]['hotel:HotelProperty']['common_v33_0:Distance']:'';
if($hotel_distance!=''){
    $data['hotel_distance']=$hotel_distance['@attributes']['Value']." ".$hotel_distance['@attributes']['Units'];
}

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
                            $data['HotelLocation'] = isset($hotel_search_nodes[$k]['hotel:HotelProperty']['@attributes']['HotelLocation'])?$hotel_search_nodes[$k]['hotel:HotelProperty']['@attributes']['HotelLocation']:'';
                            $data['Name'] = $hotel_search_nodes[$k]['hotel:HotelProperty']['@attributes']['Name'];
                            $data['VendorLocationKey'] = $hotel_search_nodes[$k]['hotel:HotelProperty']['@attributes']['VendorLocationKey'];
                            $data['HotelTransportation'] ='';
                            if(isset($hotel_search_nodes[$k]['hotel:HotelProperty']['@attributes']['HotelTransportation']))
                            {
                                $data['HotelTransportation'] = $hotel_search_nodes[$k]['hotel:HotelProperty']['@attributes']['HotelTransportation'];
                            }
                            $data['ReserveRequirement'] = isset($hotel_search_nodes[$k]['hotel:HotelProperty']['@attributes']['ReserveRequirement'])?$hotel_search_nodes[$k]['hotel:HotelProperty']['@attributes']['ReserveRequirement']:'';
                            $data['ParticipationLevel'] = isset($hotel_search_nodes[$k]['hotel:HotelProperty']['@attributes']['ParticipationLevel'])?$hotel_search_nodes[$k]['hotel:HotelProperty']['@attributes']['ParticipationLevel']:'';
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
                             $data['MaximumAmount'] = 'Not Available';

                             if (isset($hotel_search_nodes[$k]['hotel:RateInfo']['@attributes']['MaximumAmount'])) {
                            $TotalPrice = substr($hotel_search_nodes[$k]['hotel:RateInfo']['@attributes']['MaximumAmount'],3);
                            $TotalPrice_Curr = substr($hotel_search_nodes[$k]['hotel:RateInfo']['@attributes']['MaximumAmount'],0,3);
                            $aMarkup = $this->account_model->get_markup('HOTEL'); //get markup
                            $aMarkup = $aMarkup['markup'];
                            $MyMarkup = $this->account_model->get_my_markup(); //get agent markup
                            $myMarkup = $MyMarkup['markup'];

                            $TotalPrice = $this->flight_model->currency_convertor($TotalPrice,$TotalPrice_Curr,CURR);
                            $TotalPrice = $this->account_model->PercentageToAmount($TotalPrice,$aMarkup);
                            $TotalPrice = $this->account_model->PercentageToAmount($TotalPrice,$myMarkup);


                            $data['MaximumAmount'] = $TotalPrice;
                            $data['MyMarkup'] = $myMarkup;

                            }

    

    $Hotel_search_result['results'][] = $data;
}
}
}
}




}
}

return $Hotel_search_result;

}

}



public function get_hotel_refrence_points($term) {
                ini_set('memory_limit', '-1');
       
        $term = trim(strip_tags($term));
        $points = $this->Hotel_Model->get_hotel_refrence_points($term);
        $result = '';

        foreach ($points as $point) {
           
            $result.="<option value=".$point->refrence_point_name.">".$point->refrence_point_name."</option>";
        }
       
        echo json_encode($result); //format the array into json data
    }



public function get_hotel_city_suggestions() {
    ini_set('memory_limit', '-1');
        $term = $this->input->get('term'); //retrieve the search term that autocomplete sends
        $term = trim(strip_tags($term));
        $hotels = $this->Hotel_Model->get_hotels_list($term);
        $result = array();

        foreach ($hotels as $hotel) {
            $apts['label'] = $hotel->CITY;
            $apts['value'] = ' ' . $hotel->CITY. ', ' . $hotel->COUNTRY_NAME . '  - ' . $hotel->IATA_CODES;
            $apts['label_code'] =$hotel->IATA_CODES;
            $apts['label_name'] = $hotel->COUNTRY_NAME ;
            $apts['id'] = $hotel->ID;
            $result[] = $apts;
        }
        //print_r($result);
        echo json_encode($result); //format the array into json data
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

$hotel_images = $xml_to_array_image['SOAP:Body']['hotel:HotelMediaLinksRsp']['hotel:HotelPropertyWithMediaItems']['common_v33_0:MediaItem'];

$hotel_all_images = array();

if (!empty($hotel_images)) {
    for ($k = 0; $k < count($hotel_images); $k++) {
        if (isset($hotel_images[$k]['@attributes']['sizeCode'])) {
            $sizecode = $hotel_images[$k]['@attributes']['sizeCode'];
                if ($sizecode == 'M') {

                $hotel_all_images['single_img'][] = array($hotel_images[$k]['@attributes']['caption'], $hotel_images[$k]['@attributes']['url']);
                }elseif($sizecode == 'H') {

                    $hotel_all_images['multi_img'][] = array($hotel_images[$k]['@attributes']['caption'], $hotel_images[$k]['@attributes']['url']);
                }elseif($sizecode == 'E') {

                    $hotel_all_images['multi_img'][] = array($hotel_images[$k]['@attributes']['caption'], $hotel_images[$k]['@attributes']['url']);
                }
        }
      
    }

    
}



if(!empty($hotel_all_images)){
 $data['hotel_single_image'] = $hotel_all_images['single_img'][0][1];
  $data['hotel_all_images'] =$hotel_all_images['multi_img'];
}else{
 $data['hotel_all_images'] = "" ;
   $data['hotel_single_image'] ="";
}

//print_r(json_encode(array('result' => $data)));die; 
echo json_encode(array('result' => $data));
}


function get_hotel_details($sid, $hotelid,$city_code, $checkin = '', $checkout = '', $adult = '',$child='', $roomcount = '') {

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

//echo "<pre>"; print_r($xml_to_array_details); exit;
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
   }else{
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
    $contact_details = $HotelProperty['common_v33_0:PhoneNumber'];
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


   }
   


if (isset($checkin) && isset($checkout) && $checkin != '' && $checkout != '') {
   
    $data['checkin'] = $checkin;
    $data['checkout'] = $checkout;
}else{

$data['checkin'] = '';
$data['checkout'] = '';
}

if (isset($adult) && $adult != '') {
    $data['adult'] = $adult;
    $data['child'] = $child;
}else{
    $data['adult'] = 1;
    $data['child'] = 0;
}




 $hotel_details_val1 = $this->load->view('hotel/hotel_details_info', $data, true);

print json_encode(array(
    'hotel_details_val1' => $hotel_details_val1
    ));
}



function get_room_details($sid, $hotelid, $city_code, $checkin, $checkout, $adult,$child,$roomcount) {

            $data['sid'] = $sid;
            $data['hotelid'] = $hotelid;
            $data['checkin'] = $checkin;
            $data['checkout'] = $checkout;
            $data['city_code'] = $city_code;
            $data['adult'] = $adult;
            $data['child'] = $child;
            $data['roomcount'] = $roomcount;

            $data['search_request']=base64_encode(json_encode($data));

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
       $HotelRateDetail=array();
        if(isset($xml_to_array_rooms['SOAP:Body']['hotel:HotelDetailsRsp']['hotel:RequestedHotelDetails']['hotel:HotelRateDetail']))
       {

        $HotelRateDetailw = $xml_to_array_rooms['SOAP:Body']['hotel:HotelDetailsRsp']['hotel:RequestedHotelDetails']['hotel:HotelRateDetail'];
        
        if(!isset($xml_to_array_rooms['SOAP:Body']['hotel:HotelDetailsRsp']['hotel:RequestedHotelDetails']['hotel:HotelRateDetail'][0]))
        {
            $HotelRateDetail[] =$HotelRateDetailw;
        }else{
         $HotelRateDetail =$HotelRateDetailw;
        }
$HotelProperty = $xml_to_array_rooms['SOAP:Body']['hotel:HotelDetailsRsp']['hotel:RequestedHotelDetails']['hotel:HotelProperty'];


     $data['hotel_name'] = $xml_to_array_rooms['SOAP:Body']['hotel:HotelDetailsRsp']['hotel:RequestedHotelDetails']['hotel:HotelProperty']['@attributes']['Name'];


$address_details = $HotelProperty['hotel:PropertyAddress']['hotel:Address'];
    $address_details_val=array();
    for ($d = 0; $d < count($address_details); $d++) {
        $address_details_val[] = $address_details[$d];
    }
    if (isset($address_details_val[0])) {
        $data['address_details'] = implode("<br>", $address_details_val);
    } else {
        $data['address_details'] = '';
    }



     $Hotel_room_info = array();
     if (!empty($HotelRateDetail)) {

        for ($d = 0; $d < count($HotelRateDetail); $d++) {
          
         if(isset($HotelRateDetail[$d]['@attributes']['Total'])){

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
        //              echo '<pre/>'   ;
            //          print_r($HotelRateDetail[$d]);exit;
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
}elseif(isset($HotelRateDetail[$d]['hotel:HotelRateByDate']['@attributes']['Base']))
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
        //              echo '<pre/>'   ;
            //          print_r($HotelRateDetail[$d]);exit;
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
               
$ma_id = $this->Hotel_Model->insert_temp_result($data); 

}
}
}
//echo "<pre>";
//print_r($Hotel_room_info);

 $data2['Hotel_room_info'] = $this->Hotel_Model->get_temp_result($sid, $hotelid);

  $hotel_rooms_details = $this->load->view('hotel/hotel_rooms_info', $data2, true);

}
else
{
 $hotel_rooms_details = '<div id="cars" class="cars" ><div class="no_available">
 <div class="noresultimage"><img src="'.ASSETS.'images/noresult.png" alt="No Result"></div>
 <h1>There are no rooms available. </h1>
 <div class="no_available_text">Sorry, we have no prices for rooms in this hotel. One or more of your preferences may be affecting the number of exact matches found. Try searching again with a wider search criteria. <br></div>
</div>
</div>';
$Hotel_room_info = array();
}


print json_encode(array(
    'hotel_rooms_details' => $hotel_rooms_details,
    'Hotel_room_info' => count($Hotel_room_info)
    ));
}





    public function hotel_search_test() {
        $this->load->view('hotel/search_test');
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

       $hotel_rules_val1 = '<div id="cars" class="cars" ><div class="no_available">
 <div class="noresultimage"><img src="'.ASSETS.'images/noresult.png" alt="No Result"></div>
 <h1>There are no rules Available. </h1>
 </div>
</div>';

   }else{


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
        $HotelRuleItemval = isset($HotelRuleItem[$l]['hotel:Text'])?$HotelRuleItem[$l]['hotel:Text']:'';
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
    $xxx=isset($HotelRuleItem[$l]['@attributes']['Name'])?$HotelRuleItem[$l]['@attributes']['Name']:'';
    $HotelRuleItem_v1[] = array($xxx, $HotelRuleItemval1_v1);
}
}
$data['HotelRuleItem_v1'] = $HotelRuleItem_v1;
$hotel_rules_val1 = $this->load->view('hotel/hotel_room_rules_info', $data, true);
}


        //echo '<pre/>';
        //print_r($data);exit;



print json_encode(array(
    'hotel_rules_val1' => $hotel_rules_val1
    ));


        //echo '<pre/>';
        //print_r($xml_to_array_details);exit;
}


public function AddToCart(){
  $type = $_POST['type'];
  $type = base64_decode(base64_decode($type));
  $this->Cart_Model->removeAllCart();

  if($type == 'API'){
      $result = $this->Hotel_Model->get_temp_result_id($_POST['temp_id']);
      $cart_hotel = array(
        'session_id' => $result->session_id,
        'api' => $result->api,
        'hotel_name' => $result->hotel_name,
        'imageurl' => $this->input->post('imageurl'),
        'hotel_addresses' =>$result->hotel_addresses,
        'search_request' =>$this->input->post('search_request'),
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
        'child' => $result->child,
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
      if($cartt->module == 'HOTEL'){
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
    }
}
$data['GRAND_TOTAL'] = $this->account_model->currency_convertor(array_sum($GRAND_TOTAL));
}




	   //echo '<pre>';print_r($cart_flight);die;
       $data_C_URL = WEB_URL.'/booking/'.$session_id;
       redirect($data_C_URL);
       // echo json_encode($data);
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
    if(isset( $xml_to_array_image['SOAP:Body']['hotel:HotelMediaLinksRsp']['hotel:HotelPropertyWithMediaItems']['common_v33_0:MediaItem']))
    {
        $hotel_images = $xml_to_array_image['SOAP:Body']['hotel:HotelMediaLinksRsp']['hotel:HotelPropertyWithMediaItems']['common_v33_0:MediaItem'];


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
            $data['voucher_details'] =  $this->booking_model->getBookingvoucherinvoicedetails()->row();
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
                 $data['voucher_details'] =  $this->booking_model->getBookingvoucherinvoicedetails()->row();
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


            $data['email_template'] = $this->email_model->get_email_template('HOTEL_BOOKING_VOUCHER')->row();
            $template_message = $data['email_template']->message;


           
            


        $order_mes=array("{%%FIRSTNAME%%}","{%%CONFIRMATION__NO%%}","{%%BOOKING__STATUS%%}",
        "{%%HOTEL_NAME%%}","{%%ROOM_TYPE%%}","{%%NO_OF_NIGHTS%%}","{%%GUEST_COUNT%%}","{%%GUEST_NAME%%}",
        "{%%CHECKIN_DAY_MONTH%%}","{%%CHECKIN_DATE%%}","{%%CHECKOUT_DAY_MONTH%%}","{%%CHECKOUT_DATE%%}","{%%WEB_URL%%}","##WEB_NAME##");
        $replace_mes=array($data['Booking']->leadpax,$data['Booking']->pnr_no,
        $data['Booking']->booking_status,$booking->hotel_name,$booking->room_name,$number_of_nights,$booking->adult,$booking->leadpax,$checkin_day_month,$cin,$checkout_day_month,$cout,WEB_FRONT_DIR,WEB_NAME);
        $template_message=str_replace($order_mes, $replace_mes, $template_message);


            $data['message'] = $template_message;
            $data['voucher_details'] =  $this->booking_model->getBookingvoucherinvoicedetails()->row();
          
            $data['to'] = $booking->BILLING_EMAIL;
            $data['email_access'] = $this->email_model->get_email_acess()->row();
           
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
           
            $checkin_date = strtotime($booking->checkin);
            $checkout_date = strtotime($booking->checkout);

            $absDateDiff = abs($checkout_date - $checkin_date);
            $data['number_of_nights'] = floor($absDateDiff/(60*60*24));
 		     $data['voucher_details'] =  $this->booking_model->getBookingvoucherinvoicedetails()->row();
            $data['message'] = $this->load->view('hotel/mail_invoice', $data,TRUE);
            $data['to'] = $booking->BILLING_EMAIL;
            $data['email_access'] = $this->email_model->get_email_acess()->row();
            $email_type = 'hotel_invoice';
            $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
            $data['booking_status'] = strtolower($booking->booking_status);
           
            $Response = $this->email_model->sendmail_hotelInvoice($data);
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
                    $this->cancel_mail_voucher($pnr_no);

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



public function cancel_mail_voucher($pnr_no){
    $pnr_no = base64_decode(base64_decode($pnr_no));
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1){
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if($b_data->module == 'HOTEL'){
                
                $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($b_data->pnr_no,$b_data->module)->row();
             
                $data['to'] = $booking->BILLING_EMAIL;
                $data['email_access'] = $this->email_model->get_email_acess()->row();
                $email_type = 'ApartmentVoucher';
                $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
                $data['voucher_details'] =  $this->booking_model->getBookingvoucherinvoicedetails()->row();
                
                
                $Response = $this->email_model->sendmail_hotelcancel($data);
                $response = array('status' => 1);
                
            }
        }
    }


}
