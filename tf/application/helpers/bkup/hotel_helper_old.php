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
    $explode_check_in = explode('-',$data['check_in']);
    $explode_check_out = explode('-',$data['check_in']);
    
    $checkin_explode_date = explode('-', $data['check_in']);
    $checkout_explode_date = explode('-', $data['check_out']);
    
    $check_in = $explode_check_in['2'].'-'.$explode_check_in['1'].'-'.$explode_check_in['0'];
    $check_out = $explode_check_out['2'].'-'.$explode_check_out['1'].'-'.$explode_check_out['0'];
    if($data['nextlink']!='')
	{
		$nextlink= '<com:NextResultReference xmlns:com="http://www.travelport.com/schema/common_v28_0" ProviderCode="1G">'.$data['nextlink'].'</com:NextResultReference>';	
	}
	else
	{
		$nextlink= '';
	}
	
    $city_code = $data['city_code'];
    $xml_request = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                    <soapenv:Header/>
                    <soapenv:Body>
                      <hot:HotelSearchAvailabilityReq xmlns:hot="http://www.travelport.com/schema/hotel_v28_0" TargetBranch="P105180">
                        <com:BillingPointOfSaleInfo xmlns:com="http://www.travelport.com/schema/common_v28_0" OriginApplication="UAPI"/>
						 <com:OverridePCC xmlns:com="http://www.travelport.com/schema/common_v28_0" ProviderCode="1G" PseudoCityCode="4SA" />
						 '.$nextlink.'
                        <hot:HotelSearchLocation>
                          <hot:HotelLocation Location="'.$city_code.'"/>
                        </hot:HotelSearchLocation>
                        <hot:HotelSearchModifiers NumberOfAdults="' . $data['adult'] . '" NumberOfRooms="' . $data['rooms'] . '" PreferredCurrency="USD" AvailableHotelsOnly="false" IsRelaxed="false">
                        <com:PermittedProviders xmlns:com="http://www.travelport.com/schema/common_v28_0">
                        <com:Provider Code="1G"/>
                        </com:PermittedProviders>
                        </hot:HotelSearchModifiers>
                        <hot:HotelStay>
                          <hot:CheckinDate>' . $check_in . '</hot:CheckinDate>
                          <hot:CheckoutDate>' . $check_out . '</hot:CheckoutDate>
                        </hot:HotelStay>
                      </hot:HotelSearchAvailabilityReq>
                    </soapenv:Body>
                  </soapenv:Envelope>';

    $respone = curl($xml_request);
	//echo $respone;exit;
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
<hot:HotelMediaLinksReq xmlns:hot="http://www.travelport.com/schema/hotel_v28_0" AuthorizedBy="user" Gallery="true" RichMedia="true" TargetBranch="P105180" TraceId="trace">
<com:BillingPointOfSaleInfo xmlns:com="http://www.travelport.com/schema/common_v28_0" OriginApplication="UAPI"/>
<hot:HotelProperty HotelChain="'.$sid.'" HotelCode="'.$hotelid.'" >
</hot:HotelProperty>
</hot:HotelMediaLinksReq>
</soapenv:Body>
</soapenv:Envelope>';

    $respone = curl($xml_request);
	
    return $respone;
}

function get_cancellation_policy_results($data) {
   
    $sid = $data['sid'];
    $hotelid = $data['hotelid'];
    $Base = $data['Base'];
	$RatePlanType = $data['RatePlanType'];
	$checkin = $data['checkin'];
	$checkout = $data['checkout'];

$xml_request = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://www.travelport.com/schema/common_v28_0" xmlns:hot="http://www.travelport.com/schema/hotel_v28_0">
<soapenv:Header/>
<soapenv:Body>
<hot:HotelRulesReq AuthorizedBy="user" TargetBranch="P105180" TraceId="trace">
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
	//echo $respone;exit;
    return $return_data;
}
function get_hotel_details_results($data) {
   
    $sid = $data['sid'];
    $hotelid = $data['hotelid'];
	 $locationcode = $data['locationcode'];

    $xml_request = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
<soapenv:Header/>
<soapenv:Body>
<hot:HotelDetailsReq xmlns:hot="http://www.travelport.com/schema/hotel_v28_0" TargetBranch="P105180">
<com:BillingPointOfSaleInfo xmlns:com="http://www.travelport.com/schema/common_v28_0" OriginApplication="UAPI"/>
<hot:HotelProperty HotelChain="'.$sid.'"  HotelCode="'.$hotelid.'"  />


</hot:HotelDetailsReq>
</soapenv:Body>
</soapenv:Envelope>';

    
	//echo $respone;exit;
   $return_data['request'] = $xml_request;
    $return_data['response'] = curl($xml_request);
	//echo $respone;exit;
    return $return_data;
}

function get_hotel_rooms_results($data) {
   
    $sid = $data['sid'];
    $hotelid = $data['hotelid'];
	$checkin = explode("-",$data['checkin']);
	$checkout =  explode("-",$data['checkout']);
	$city_code = $data['city_code'];
	$adult = $data['adult'];
	$roomcount = $data['roomcount'];
	 $check_ins = $checkin['2'].'-'.$checkin['1'].'-'.$checkin['0'];
    $check_outs = $checkout['2'].'-'.$checkout['1'].'-'.$checkout['0'];

    $xml_request = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
<soapenv:Header/>
<soapenv:Body>
<hot:HotelDetailsReq xmlns:hot="http://www.travelport.com/schema/hotel_v28_0" TargetBranch="P105180">
<com:BillingPointOfSaleInfo xmlns:com="http://www.travelport.com/schema/common_v28_0" OriginApplication="UAPI"/>
<hot:HotelProperty HotelChain="'.$sid.'" HotelLocation="'.$city_code.'" HotelCode="'.$hotelid.'"  />
<hot:HotelDetailsModifiers NumberOfAdults="'.$adult.'" RateRuleDetail="Complete">
<com:PermittedProviders xmlns:com="http://www.travelport.com/schema/common_v28_0">
<com:Provider Code="1G"/>
</com:PermittedProviders>
<hot:HotelStay>
<hot:CheckinDate>'.$check_ins.'</hot:CheckinDate>
<hot:CheckoutDate>'.$check_outs.'</hot:CheckoutDate>
</hot:HotelStay>
</hot:HotelDetailsModifiers>
</hot:HotelDetailsReq>
</soapenv:Body>
</soapenv:Envelope>';

 $return_data['request'] = $xml_request;
    $return_data['response'] = curl($xml_request);
	//echo $return_data;exit;
    return $return_data;
	
   
}

function make_hotel_booking($cart_hotel_data, $cid, $checkout_form)
{
	
	$CI = & get_instance();
    $CI->load->model('Hotel_Model');
	

	/*Total="'.$cart_hotel_data->org_amount.'"*/
$xml_request='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
  <soapenv:Body>
    <univ:HotelCreateReservationReq xmlns:univ="http://www.travelport.com/schema/universal_v28_0"  TargetBranch="P105180" >
      <com:BillingPointOfSaleInfo xmlns:com="http://www.travelport.com/schema/common_v28_0" OriginApplication="UAPI"/>
      <com:BookingTraveler xmlns:com="http://www.travelport.com/schema/common_v28_0"  >
       
	    <com:BookingTravelerName First="'.$checkout_form->first_name.'" Last="'.$checkout_form->last_name.'"  />
		<com:PhoneNumber Number="'.$checkout_form->mobile.'" Type="Mobile"/>
        <com:Email EmailID="'.$checkout_form->email.'" Type="Home"/>
       
      </com:BookingTraveler>
      <hot:HotelRateDetail xmlns:hot="http://www.travelport.com/schema/hotel_v28_0"  RatePlanType="'.$cart_hotel_data->room_code.'" />
      <hot:HotelProperty xmlns:hot="http://www.travelport.com/schema/hotel_v28_0"  HotelChain="'.$cart_hotel_data->chain_code.'" HotelCode="'.$cart_hotel_data->hotel_code.'" HotelLocation="'.$cart_hotel_data->city_code.'" >
      </hot:HotelProperty>
      <hot:HotelStay xmlns:hot="http://www.travelport.com/schema/hotel_v28_0">
        <hot:CheckinDate>'.$cart_hotel_data->checkin.'</hot:CheckinDate>
        <hot:CheckoutDate>'.$cart_hotel_data->checkout.'</hot:CheckoutDate>
      </hot:HotelStay>
	 <com:Guarantee xmlns:com="http://www.travelport.com/schema/common_v28_0" Type="Guarantee">
<com:CreditCard ExpDate="2016-07" Number="4111111111111111" Type="VI"/>
</com:Guarantee>
      <hot:GuestInformation xmlns:hot="http://www.travelport.com/schema/hotel_v28_0" NumberOfRooms="'.$cart_hotel_data->room_count.'">
        <hot:NumberOfAdults>'.$cart_hotel_data->adult.'</hot:NumberOfAdults>
      </hot:GuestInformation>
      <com:HostToken xmlns:com="http://www.travelport.com/schema/common_v28_0"/>
    </univ:HotelCreateReservationReq>
  </soapenv:Body>
</soapenv:Envelope>';

 $return_data['request'] = $xml_request;
 $return_data['response'] = curl($xml_request);


    return $return_data;
	
 $response2='<SOAP:Envelope xmlns:SOAP="http://schemas.xmlsoap.org/soap/envelope/"><SOAP:Body><universal:HotelCreateReservationRsp TransactionId="7AE9D9BD0A07647883352EAFB5B0C8DB" ResponseTime="1063" xmlns:universal="http://www.travelport.com/schema/universal_v28_0" xmlns:common_v28_0="http://www.travelport.com/schema/common_v28_0" xmlns:hotel="http://www.travelport.com/schema/hotel_v28_0"><common_v28_0:ResponseMessage Code="5123" Type="Warning" ProviderCode="1G">Price requested and Price received do not match.</common_v28_0:ResponseMessage><universal:UniversalRecord LocatorCode="ZL07ZB" Version="0" Status="Active"><common_v28_0:BookingTraveler Key="atJ2r8uqRjCNHUdbgQRNtQ==" ElStat="A"><common_v28_0:BookingTravelerName First="Ruby" Last="kathiravan"/><common_v28_0:PhoneNumber Key="mcCGzHmAQGaDEOGs6ZGCxg==" Type="Mobile" Location="DXB" Number="919686040071" ElStat="A"><common_v28_0:ProviderReservationInfoRef Key="/LgrzF+7Rf6xMkj0nwis+Q=="/></common_v28_0:PhoneNumber><common_v28_0:Email Key="Lq4Sj9v5SOaexYVz8WDqzg==" Type="Home" EmailID="ruby.provab@gmail.com" ElStat="A"><common_v28_0:ProviderReservationInfoRef Key="/LgrzF+7Rf6xMkj0nwis+Q=="/></common_v28_0:Email></common_v28_0:BookingTraveler><common_v28_0:OSI Key="mIG0UkUbT0in0/fXCeoV9Q==" Carrier="1G" Text="RD31271ARR19DEC CXL:CXL BY 1600 DEC 19 2014 TO AVOID A 81.10GBP CH" ElStat="A" ProviderReservationInfoRef="/LgrzF+7Rf6xMkj0nwis+Q=="/><universal:ProviderReservationInfo Key="/LgrzF+7Rf6xMkj0nwis+Q==" ProviderCode="1G" LocatorCode="ZBC7PU" CreateDate="2014-11-04T13:06:27.530+00:00" ModifiedDate="2014-11-04T13:06:27.530+00:00" HostCreateDate="2014-11-04" OwningPCC="4SA"/>
<hotel:HotelReservation Status="HK" BookingConfirmation="3W8Q5WL" LocatorCode="00RVRFMQ" CreateDate="2014-11-04T13:06:27.519+00:00" ModifiedDate="2014-11-04T13:06:27.530+00:00" ProviderReservationInfoRef="/LgrzF+7Rf6xMkj0nwis+Q==" TravelOrder="1"><common_v28_0:BookingTravelerRef Key="atJ2r8uqRjCNHUdbgQRNtQ=="/><common_v28_0:ReservationName><common_v28_0:BookingTravelerRef Key="atJ2r8uqRjCNHUdbgQRNtQ=="/></common_v28_0:ReservationName><hotel:HotelProperty HotelChain="RD" HotelCode="31271" HotelLocation="LON" Name="RD NEW PROVIDENCE"><hotel:PropertyAddress><hotel:Address>5 FAIRMONT AVENUE</hotel:Address><hotel:Address>LONDON E14 9PJ</hotel:Address></hotel:PropertyAddress><common_v28_0:PhoneNumber Type="Hotel" Number="442079872050"/><common_v28_0:PhoneNumber Type="Fax" Number="442079878424"/></hotel:HotelProperty><hotel:HotelRateDetail RatePlanType="IA00104" Base="GBP81.10" Tax="GBP0.00" Total="GBP95.29" Surcharge="GBP14.19" RateGuaranteed="true"><hotel:RoomRateDescription Name="Total Includes"><hotel:Text>Total includes taxes, surcharges and fees</hotel:Text></hotel:RoomRateDescription><hotel:HotelRateByDate EffectiveDate="2014-12-19" ExpireDate="2014-12-20" Base="GBP81.10"/><hotel:CancelInfo NonRefundableStayIndicator="false" CancelDeadline="2014-12-19T16:00:00.000+00:00"/></hotel:HotelRateDetail><hotel:HotelStay><hotel:CheckinDate>2014-12-19</hotel:CheckinDate><hotel:CheckoutDate>2014-12-20</hotel:CheckoutDate></hotel:HotelStay><common_v28_0:BookingSource Type="IataNumber" Code="99999992"/><hotel:HotelBedding Type="Twin" NumberOfBeds="2"/><hotel:GuestInformation NumberOfRooms="1"><hotel:NumberOfAdults>1</hotel:NumberOfAdults></hotel:GuestInformation><common_v28_0:SellMessage>SERVICE CHARGE AMOUNT:14.19</common_v28_0:SellMessage><common_v28_0:SellMessage>CXL:CXL BY 1600 DEC 19 2014 TO AVOID A 81.10GBP CHARGE.</common_v28_0:SellMessage><common_v28_0:SellMessage>NON-COMMISSIONABLE</common_v28_0:SellMessage><common_v28_0:SellMessage>ROOM DESCRIPTION:EDWARDIAN PAC-SUPERIOR ROOM</common_v28_0:SellMessage><common_v28_0:SellMessage>THANK YOU FOR CHOOSING RADISSON. *</common_v28_0:SellMessage></hotel:HotelReservation><common_v28_0:AgencyInfo><common_v28_0:AgentAction ActionType="Created" AgentCode="UAPI2229588320-335C9650" BranchCode="P105180" AgencyCode="S7027401" EventTime="2014-11-04T13:06:26.569+00:00"/></common_v28_0:AgencyInfo></universal:UniversalRecord></universal:HotelCreateReservationRsp></SOAP:Body></SOAP:Envelope>';
  
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
    // print_r($response);die;  
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
