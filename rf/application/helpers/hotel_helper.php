<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  |--------------------------------------------------------------------------|
  | Author: Provab Technosoft Pvt Ltd.									   |
  |--------------------------------------------------------------------------|
  | Developer: Provab											   |
  | Started Date: 2014-09-11T11:45:00										   |
  | Ended Date:  										   					   |
  |--------------------------------------------------------------------------|
 */



function get_hotel_search_results($data) {

$data=json_decode(base64_decode($data));
// echo "<pre>";print_r($data);die;
   
    if(isset($data->nextlink) && $data->nextlink!='')
	{
		$nextlink= '<com:NextResultReference xmlns:com="http://www.travelport.com/schema/common_v33_0" ProviderCode="1G">'.$data->nextlink.'</com:NextResultReference>';	
	}
	else
	{
		$nextlink= '';
	}
 if(isset($data->room_type) && $data->room_type!=null)
  {
    $room_type='<HotelBedding Type="'.$data->room_type.'" />';

  }else{
    $room_type='';
  }

  if(isset($data->area) && $data->area!=null)
  {
    $area='<hot:ReferencePoint>'.$data->area.'</hot:ReferencePoint>';
  } else {
  $area='';
  }
$Amenities='';

   if(isset($data->Amenities) &&  count($data->Amenities)>1)
  { 
                        $Amenities.='<hot:Amenities>';
                        foreach ($data->Amenities as $Amenitie) {
                          if($Amenitie!=''){
                        $Amenities.='<hot:Amenity Code="'.$Amenitie.'"/>';
                            }
                        }
                        $Amenities.='</hot:Amenities>';
                        
  }


   if(isset($data->checkin) && $data->checkin!=null)
  {
    $data->check_in=$data->checkin;
  }

  if(isset($data->checkout) && $data->checkout!=null)
  {
    $data->check_out=$data->checkout;
  }
  if(isset($data->roomcount) && $data->roomcount!=null)
  {
    $data->rooms=$data->roomcount;
  }
$child_modifiers='';
$child_age='';
  if($data->child>0){
    
                    for ($c=0; $c<$data->child; $c++) { 
                       $child_age.='<hot:Age>10</hot:Age>';
                    }

                    $child_modifiers.='<hot:NumberOfChildren Count="'.$data->child.'">
                                        '.$child_age.'
                                        </hot:NumberOfChildren>';
  }

	//NumberOfChildrens="' . $data->child . '" ,AvailableHotelsOnly="true",MaxProperties="5"
  //MaxWait="50000" AggregateResults="true"  IsRelaxed="true"
    $city_code = $data->city_code;
    $xml_request = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                    <soapenv:Header/>
                    <soapenv:Body>
                      <hot:HotelSearchAvailabilityReq xmlns:hot="http://www.travelport.com/schema/hotel_v33_0"  AuthorizedBy="user"  TraceId="trace" TargetBranch="P7003720">
                        <com:BillingPointOfSaleInfo xmlns:com="http://www.travelport.com/schema/common_v33_0" OriginApplication="UAPI"/>
						 <com:OverridePCC xmlns:com="http://www.travelport.com/schema/common_v33_0" ProviderCode="1G" PseudoCityCode="6I90" />
						 '.$nextlink.'
                        <hot:HotelSearchLocation>
                          <hot:HotelLocation Location="'.$city_code.'"/>
                           '.$area.'
                           <!--<com:Distance Direction="N" Units="MI" Value="5"/>-->
                        </hot:HotelSearchLocation>
                        <hot:HotelSearchModifiers AvailableHotelsOnly="true" ReturnPropertyDescription="true"  NumberOfAdults="' . $data->adult . '" NumberOfRooms="' . $data->rooms . '"  PreferredCurrency="EUR" >
                        <com:PermittedProviders xmlns:com="http://www.travelport.com/schema/common_v33_0">
                        <com:Provider Code="1G"/>
                        </com:PermittedProviders>
                        <hot:HotelRating RatingProvider="NTM"><hot:RatingRange MinimumRating="1" MaximumRating="5" /></hot:HotelRating>
                        <hot:HotelRating RatingProvider="AAA"><hot:RatingRange MaximumRating="5" MinimumRating="1"/></hot:HotelRating>
                       '.$Amenities.'
                       '.$room_type.'
                       <!--<hot:HotelPaymentType>PostPay</hot:HotelPaymentType>-->
                      '.$child_modifiers.'
                        </hot:HotelSearchModifiers>
                        <hot:HotelStay>
                          <hot:CheckinDate>' . $data->check_in . '</hot:CheckinDate>
                          <hot:CheckoutDate>' . $data->check_out . '</hot:CheckoutDate>
                        </hot:HotelStay>
                      </hot:HotelSearchAvailabilityReq>
                    </soapenv:Body>
                  </soapenv:Envelope>';
                 
  
    $respone = curl($xml_request);
 
   $file = "XMLs/HotelSearchAvailabilityRes.xml";
  prettyPrint($respone,$file);
  $file1 = "XMLs/HotelSearchAvailabilityReq.xml";
  prettyPrint($xml_request,$file1);

	$retrundata['request']=$xml_request;
	$retrundata['response']=$respone;

    return $retrundata;
}

function get_hotel_image_results($data) {
   
    $sid = $data['sid'];
    $hotelid = $data['hotelid'];

    $xml_request = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
<soapenv:Header/>
<soapenv:Body>
<hot:HotelMediaLinksReq xmlns:hot="http://www.travelport.com/schema/hotel_v33_0" AuthorizedBy="user" Gallery="true" RichMedia="true" TargetBranch="P7003720" TraceId="trace">
<com:BillingPointOfSaleInfo xmlns:com="http://www.travelport.com/schema/common_v33_0" OriginApplication="UAPI"/>
<hot:HotelProperty HotelChain="'.$sid.'" HotelCode="'.$hotelid.'" >
</hot:HotelProperty>
</hot:HotelMediaLinksReq>
</soapenv:Body>
</soapenv:Envelope>';

    $respone = curl($xml_request);
	
   /**/$file = "XMLs/HotelMediaLinksReq.xml";
  prettyPrint($respone,$file);
  $file1 = "XMLs/HotelMediaLinksRsp.xml";
  prettyPrint($xml_request,$file1);
    return $respone;
}



function get_hotel_details_results($data) {
   
    $sid = $data['sid'];
    $hotelid = $data['hotelid'];
   $locationcode = $data['locationcode'];

    $xml_request = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
<soapenv:Header/>
<soapenv:Body>
<hot:HotelDetailsReq xmlns:hot="http://www.travelport.com/schema/hotel_v33_0" AuthorizedBy="user"  TraceId="trace"  TargetBranch="P7003720">
<com:BillingPointOfSaleInfo xmlns:com="http://www.travelport.com/schema/common_v33_0" OriginApplication="UAPI"/>
<hot:HotelProperty HotelChain="'.$sid.'"  HotelCode="'.$hotelid.'"  />

</hot:HotelDetailsReq>
</soapenv:Body>
</soapenv:Envelope>';

    
  //echo $xml_request;exit;
   $return_data['request'] = $xml_request;
    $return_data['response'] = curl($xml_request);

  $file = "XMLs/HotelDetailsRes.xml";
  prettyPrint($return_data['response'],$file);
  $file1 = "XMLs/HotelDetailsReq.xml";
  prettyPrint($xml_request,$file1);

 // echo $return_data['response'];exit;
    return $return_data;
}






function get_hotel_rooms_results($data) {
   
      $sid = $data['sid'];
      $hotelid = $data['hotelid'];
      $checkin = $data['checkin'];
      $checkout =  $data['checkout'];
      $city_code = $data['city_code'];
      $adult = $data['adult'];
      $child = $data['child'];
      $roomcount = $data['roomcount'];
      $check_ins = $checkin;
      $check_outs = $checkout;


$child_modifiers='';
$child_age='';
  if($child>0){
    
                    for ($c=0; $c<$child; $c++) { 
                       $child_age.='<hot:Age>10</hot:Age>';
                    }

                    $child_modifiers.='<hot:NumberOfChildren Count="'.$child.'">
                                        '.$child_age.'
                                        </hot:NumberOfChildren>';
  }


    $xml_request = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
<soapenv:Header/>
<soapenv:Body>
<hot:HotelDetailsReq xmlns:hot="http://www.travelport.com/schema/hotel_v33_0" AuthorizedBy="user"  TraceId="trace"  TargetBranch="P7003720">
<com:BillingPointOfSaleInfo xmlns:com="http://www.travelport.com/schema/common_v33_0" OriginApplication="UAPI"/>
<hot:HotelProperty HotelChain="'.$sid.'" HotelLocation="'.$city_code.'" HotelCode="'.$hotelid.'"  />
<hot:HotelDetailsModifiers NumberOfRooms="'.$roomcount.'" NumberOfAdults="'.$adult.'" RateRuleDetail="Complete">
<com:PermittedProviders xmlns:com="http://www.travelport.com/schema/common_v33_0">
<com:Provider Code="1G"/>
</com:PermittedProviders>
<hot:HotelStay>
<hot:CheckinDate>'.$check_ins.'</hot:CheckinDate>
<hot:CheckoutDate>'.$check_outs.'</hot:CheckoutDate>
</hot:HotelStay>
'.$child_modifiers.'
</hot:HotelDetailsModifiers>
</hot:HotelDetailsReq>
</soapenv:Body>
</soapenv:Envelope>';

    $return_data['request'] = $xml_request;
    $return_data['response'] = curl($xml_request);
    $file = "XMLs/HotelDetailsroomRes.xml";
  prettyPrint($return_data['response'],$file);
  $file1 = "XMLs/HotelDetailsroomReq.xml";
  prettyPrint($xml_request,$file1);

    return $return_data;
  
   
}



function get_cancellation_policy_results($data) {
   
    $sid = $data['sid'];
    $hotelid = $data['hotelid'];
    $Base = $data['Base'];
	$RatePlanType = $data['RatePlanType'];
	$checkin = $data['checkin'];
	$checkout = $data['checkout'];

$xml_request = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://www.travelport.com/schema/common_v33_0" xmlns:hot="http://www.travelport.com/schema/hotel_v33_0">
<soapenv:Header/>
<soapenv:Body>
<hot:HotelRulesReq AuthorizedBy="user" TargetBranch="P7003720" TraceId="trace">
<com:BillingPointOfSaleInfo OriginApplication="UAPI"/>
<hot:HotelRulesLookup Base="'.$Base.'" RatePlanType="'.$RatePlanType.'">
<hot:HotelProperty HotelChain="'.$sid.'" HotelCode="'.$hotelid.'"/>
<hot:HotelStay>
<hot:CheckinDate>'.$checkin.'</hot:CheckinDate>
<hot:CheckoutDate>'.$checkout.'</hot:CheckoutDate>
</hot:HotelStay>
</hot:HotelRulesLookup>
</hot:HotelRulesReq>
</soapenv:Body>
</soapenv:Envelope>';
 $return_data['request'] = $xml_request;
    $return_data['response'] = curl($xml_request);
    $file="XMLs/HotelRulesReq.xml"; 
  prettyPrint($return_data['request'],$file);
  $file1="XMLs/HotelRulesRsp.xml"; 
  prettyPrint($return_data['response'],$file1);
	//echo $return_data['response'];exit;
    return $return_data;
}

function make_hotel_booking($cart_hotel_data, $cid, $checkout_form,$payment_result)
{
	$payment_result=json_decode(base64_decode($payment_result));
	     $CI = & get_instance();
        $CI->load->model('Hotel_Model');
        $fname="first_name"."$cid";
       // $mname="middle_name"."$cid";
        $lname="last_name"."$cid";
        $Title="selTitle"."$cid";

        $dddd="birth_day"."$cid";
        $mmmm="birth_month"."$cid";
        $yyyy="birth_year"."$cid";
        $doba=$checkout_form->$yyyy.'-'.$checkout_form->$mmmm.'-'.$checkout_form->$dddd;
        $gender="selGender"."$cid";
        

//print_r($cart_hotel_data);
$hotel_address=explode("|||", $cart_hotel_data->hotel_addresses);
if(count($hotel_address)>0){
  $each_address='';
  foreach ($hotel_address as $hotel_address) {
   $each_address.='<hotel:Address>'.$hotel_address.'</hotel:Address>';
  }

  $hotel_addresses='<hotel:PropertyAddress>'.$each_address.'</hotel:PropertyAddress>';
}else{
  $hotel_addresses='';
}


$address = '';$card_details='';
$address .= '<com:AddressName>'.$checkout_form->street_address.'</com:AddressName>
<com:Street>'.$checkout_form->street_address.'</com:Street>
<com:City>'.$checkout_form->city.'</com:City>
<com:State>CO</com:State>
<com:PostalCode>'.$checkout_form->zip.'</com:PostalCode>
<com:Country>'.$checkout_form->country.'</com:Country>';

if(is_array($payment_result)){
  $exdate=$payment_result->Exp_Year.'-'.$payment_result->Exp_Month;
  $card_details='<com:CreditCard CVV="'.$payment_result->Card_Cvc.'" ExpDate="'.$exdate.'"  Name="'.$payment_result->Card_Name.'" Number="'.$payment_result->Card_Num.'" Type="'.$payment_result->payment_type.'" />';
}else{
$card_details='<com:CreditCard CVV="256" ExpDate="2016-06"  Name="Jack Smith" Number="4111111111111111" Type="VI" />';
}
	
$xml_request='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
  <soapenv:Body>
    <univ:HotelCreateReservationReq xmlns:univ="http://www.travelport.com/schema/universal_v33_0" AuthorizedBy="user"  TraceId="trace"   TargetBranch="P7003720" >
      <com:BillingPointOfSaleInfo xmlns:com="http://www.travelport.com/schema/common_v33_0" OriginApplication="UAPI"/>
      <com:BookingTraveler xmlns:com="http://www.travelport.com/schema/common_v33_0" Age="46" DOB="'.$doba.'" Gender="'.substr($checkout_form->$gender, 0,1).'"  >
       
	    <com:BookingTravelerName First="'.$checkout_form->$fname.'" Last="'.$checkout_form->$lname.'" Prefix="'.$checkout_form->$Title.'"  />
		<com:PhoneNumber Number="'.$checkout_form->mobile.'" Type="Mobile"/>
        <com:Email EmailID="'.$checkout_form->email.'" Type="Home"/>
        <com:Address>
       '.$address.'
       </com:Address>
      </com:BookingTraveler>
     <!--<com:FormOfPayment xmlns:com="http://www.travelport.com/schema/common_v33_0"  Type="Credit">
<com:CreditCard CVV="123" ExpDate="2016-12"  Name="Veera K" Number="370000000000028" Type="AX">
<com:BillingAddress>
 '.$address.'
</com:BillingAddress>
</com:CreditCard>
</com:FormOfPayment>-->

      <hotel:HotelRateDetail xmlns:hotel="http://www.travelport.com/schema/hotel_v33_0"  RatePlanType="'.$cart_hotel_data->room_code.'" />
      <hotel:HotelProperty xmlns:hotel="http://www.travelport.com/schema/hotel_v33_0" Availability="Available" HotelChain="'.$cart_hotel_data->chain_code.'" HotelCode="'.$cart_hotel_data->hotel_code.'" HotelLocation="'.$cart_hotel_data->city_code.'" >
      '.$hotel_addresses.'
      </hotel:HotelProperty>
      <hotel:HotelStay xmlns:hotel="http://www.travelport.com/schema/hotel_v33_0">
        <hotel:CheckinDate>'.$cart_hotel_data->checkin.'</hotel:CheckinDate>
        <hotel:CheckoutDate>'.$cart_hotel_data->checkout.'</hotel:CheckoutDate>
      </hotel:HotelStay>
	 <com:Guarantee xmlns:com="http://www.travelport.com/schema/common_v33_0" Type="Deposit">
<com:CreditCard CVV="123" Name="Veera K" ExpDate="2016-12" Number="370000000000028" Type="AX"/>
</com:Guarantee>
      <hotel:GuestInformation xmlns:hotel="http://www.travelport.com/schema/hotel_v33_0" NumberOfRooms="'.$cart_hotel_data->room_count.'">
        <hotel:NumberOfAdults>'.$cart_hotel_data->adult.'</hotel:NumberOfAdults>
      </hotel:GuestInformation>
      <com:HostToken xmlns:com="http://www.travelport.com/schema/common_v33_0"/>
    </univ:HotelCreateReservationReq>
  </soapenv:Body>
</soapenv:Envelope>';

   $return_data['request'] = $xml_request;
    $return_data['response'] = curl($xml_request);
  $file="XMLs/HotelCreateReservationReq.xml"; 
  prettyPrint($return_data['request'],$file);
  $file1="XMLs/HotelCreateReservationRes.xml"; 
  prettyPrint($return_data['response'],$file1);

    return $return_data;
	

  
}


 function helper_get_room_details($sid, $hotelid, $city_code, $checkin, $checkout, $adult,$child,$roomcount) {

    $CI = & get_instance();
    $CI->load->model('Hotel_Model');
    $CI->load->model('xml_model');
    $CI->load->model('account_model');
    
            $data['sid'] = $sid;
            $data['hotelid'] = $hotelid;
            $data['checkin'] = $checkin;
            $data['checkout'] = $checkout;
            $data['city_code'] = $city_code;
            $data['adult'] = $adult;
            $data['child'] = $child;
            $data['roomcount'] = $roomcount;

           
    

        $MyMarkup = $CI->account_model->get_my_markup(); //get agent markup
        //echo 'hello';print_r($MyMarkup);die;
        $myMarkup = $MyMarkup['markup'];
        $data['MyMarkup'] = $myMarkup;
        $return_data = get_hotel_rooms_results($data);
        $hotel_rooms_results = $return_data['response'];

        $xml_to_array_rooms = '';
        if($hotel_rooms_results!='')
        {
            $xml_to_array_rooms = $CI->xml_to_array->XmlToArray($hotel_rooms_results);
        }

    $HotelRateDetail=array(); $Hotel_room_info=array();$data['hotel_rating'] = '';$Hotel_room_info = array();$data['room_count'] = 0;
        if(isset($xml_to_array_rooms['SOAP:Body']['SOAP:Fault']))
        {
           $xml_log = array(
              'Api' => 'UAPI',
              'XML_Type' => 'HOTEL - HOTEL ROOMS - HotelDetailsRes ERROR',
              'XML_Request' => $return_data['request'],
              'XML_Response' => $return_data['response'],
              'Ip_address' => $CI->input->ip_address(),
              'XML_Time' => date('Y-m-d H:i:s')
              );
           $CI->xml_model->insert_xml_log($xml_log);
       }else{
    
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


      if (!empty($HotelProperty)) {
      
      if (isset($HotelProperty['hotel:HotelRating']['hotel:Rating'])) {
      $data['hotel_rating'] = $HotelProperty['hotel:HotelRating']['hotel:Rating'];
      }
      }

      
      if (!empty($HotelRateDetail)) {
      for ($d = 0; $d < count($HotelRateDetail); $d++) {
      
      $Hotel_room_info[] = $d;
      }

      $data['room_count'] = $Hotel_room_info;
      }
}

}
      


return json_encode(array(
  'hotel_rating' => $data['hotel_rating'],
    'Hotel_room_count' => (count($data['room_count'])>1)?count($data['room_count']):0
   
    ));
}



function curl($xml_request) {

    $CI = & get_instance();
    $CI->load->model('Hotel_Model');
    $CI->load->model('xml_model');

    $credentials = $CI->Hotel_Model->get_api_result();
	if(isset($credentials->username))
	{

    $Authorization = base64_encode('Universal API/'.$credentials->username.':'.$credentials->password);        

    $soapAction = '';

    $httpHeader = array("SOAPAction: {$soapAction}",
        "Content-Type: text/xml; charset=UTF-8",
        "Content-Encoding: UTF-8",
        "Authorization: Basic $Authorization",
        "Content-length: " . strlen($xml_request),
        "Accept-Encoding: gzip,deflate");

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $credentials->url1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 180);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_request);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    //curl_setopt($ch, CURLOPT_SSLVERSION, 3);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
    curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");

    // Execute request, store response and HTTP response code
    $response = curl_exec($ch);
    // header("Content-type: text/xml");
     //echo ($response);die;  
    $error = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  
    
    if($error != '200'){
     
      $xml_log = array(
          'Api' => 'UAPI',
          'XML_Type' => 'HOTEL - CURL ERROR',
          'XML_Request' => $xml_request,
          'XML_Response' => $response,
          'Ip_address' => $_SERVER['REMOTE_ADDR'],
          'XML_Time' => date('Y-m-d H:i:s')
      );
      $CI->xml_model->insert_xml_log($xml_log);
    }
	if($response == ''){

      $xml_log = array(
          'Api' => 'UAPI',
          'XML_Type' => 'HOTEL - EMPTY RESPONSE',
          'XML_Request' => $xml_request,
          'XML_Response' => $response,
          'Ip_address' => $_SERVER['REMOTE_ADDR'],
          'XML_Time' => date('Y-m-d H:i:s')
      );
      $CI->xml_model->insert_xml_log($xml_log);
   }
   curl_close($ch);

    return $response;
    
    
	}
	else
	{
    
			 $xml_log = array(
          'Api' => 'UAPI',
          'XML_Type' => 'HOTEL - API DEACTIVATED',
          'XML_Request' => $xml_request,
          'XML_Response' => '',
          'Ip_address' => $_SERVER['REMOTE_ADDR'],
          'XML_Time' => date('Y-m-d H:i:s')
      );
      $CI->xml_model->insert_xml_log($xml_log);
	  return '';
	}
}
