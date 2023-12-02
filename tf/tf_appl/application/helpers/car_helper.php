<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------|
| Author: Provab Technosoft Pvt Ltd.									   |
|--------------------------------------------------------------------------|
| Developer: Provab											   |
| Started Date: 2014-11-05T01:00:00										   |
| Ended Date:  										   					   |
|--------------------------------------------------------------------------|
*/
function VehicleSearchAvailabilityReq($request=''){
    //echo '<pre>';print_r($request);die;
    $PickupDateTime = date("Y-m-d",strtotime($request->depart_date)).'T'.date("H:i:s",strtotime($request->depart_time));
    if($request->dropoff != ''){
        $return = 'ReturnLocation="'.$request->dropoff.'"';
    }else{
        $return = 'ReturnLocation="'.$request->pickup.'"';
    }
    $ReturnDateTime = date("Y-m-d",strtotime($request->return_date)).'T'.date("H:i:s",strtotime($request->return_time));
    $VehicleSearchAvailabilityReq = '<?xml version="1.0" encoding="UTF-8"?>
                                <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://www.travelport.com/schema/common_v28_0" xmlns:veh="http://www.travelport.com/schema/vehicle_v28_0">
                                   <soapenv:Header />
                                   <soapenv:Body>
                                      <veh:VehicleSearchAvailabilityReq AuthorizedBy="user" ReturnAllRates="false" TargetBranch="P105180" TraceId="trace">
                                         <com:BillingPointOfSaleInfo OriginApplication="UAPI" />
                                         <veh:VehicleDateLocation PickupDateTime="'.$PickupDateTime.'" PickupLocation="'.$request->pickup.'" ReturnDateTime="'.$ReturnDateTime.'" '.$return.'/>
                                      </veh:VehicleSearchAvailabilityReq>
                                   </soapenv:Body>
                                </soapenv:Envelope>';
    $VehicleSearchAvailabilityRes = processCarRequest($VehicleSearchAvailabilityReq);
    $VehicleSearchAvailabilityReq_Res = array(
        'VehicleSearchAvailabilityReq' => $VehicleSearchAvailabilityReq,
        'VehicleSearchAvailabilityRes' => $VehicleSearchAvailabilityRes
    );
    return $VehicleSearchAvailabilityReq_Res;
}

function VehicleMediaReq($car=''){
    //echo '<pre>';print_r($request);die;
    $VehicleMediaReq = '<?xml version="1.0" encoding="UTF-8"?>
                        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://www.travelport.com/schema/common_v28_0" xmlns:veh="http://www.travelport.com/schema/vehicle_v28_0">
                           <soapenv:Header />
                           <soapenv:Body>
                              <veh:VehicleMediaLinksReq AuthorizedBy="user" TargetBranch="P105180" TraceId="trace">
                                 <com:BillingPointOfSaleInfo OriginApplication="UAPI" />
                                 <veh:VehiclePickupLocation PickUpLocation="'.$car->PickupLocation.'">
                                    <veh:Vendor Code="'.$car->VendorCode.'" />
                                    <veh:VehicleModifier AirConditioning="'.$car->AirConditioning.'" Category="'.$car->Category.'" DoorCount="'.$car->DoorCount.'" TransmissionType="'.$car->TransmissionType.'" VehicleClass="'.$car->VehicleClass.'" />
                                 </veh:VehiclePickupLocation>
                              </veh:VehicleMediaLinksReq>
                           </soapenv:Body>
                        </soapenv:Envelope>';
    $VehicleMediaRes = processCarRequest($VehicleMediaReq);
    return $VehicleMediaRes;
}

function VehicleKeywordReq($car='',$request='',$type='',$KeywordList_xml=''){
    if($type == 'list'){
        $PickupLocation = '';
        $list = 'true';
    }else if($type == 'inf'){
        $PickupLocation = '';
        $list = 'false';
    }
    //echo '<pre>';print_r($request);die;
    $VehicleKeywordReq = '<?xml version="1.0" encoding="UTF-8"?>
                        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://www.travelport.com/schema/common_v28_0" xmlns:veh="http://www.travelport.com/schema/vehicle_v28_0">
                           <soapenv:Header />
                           <soapenv:Body>
                              <veh:VehicleKeywordReq AuthorizedBy="user" KeywordList="'.$list.'" TargetBranch="P105180" TraceId="trace">
                                 <com:BillingPointOfSaleInfo OriginApplication="UAPI" />
                                 <veh:Vendor Code="'.$car->VendorCode.'" />
                                 <veh:PickupDateLocation Date="'.date("Y-m-d",strtotime($request->depart_date)).'" '.$PickupLocation.'/>
                                 '.$KeywordList_xml.'
                              </veh:VehicleKeywordReq>
                           </soapenv:Body>
                        </soapenv:Envelope>';
    if($type == 'inf'){
        //return $VehicleKeywordReq;
    }                        
                        
    $VehicleKeywordRes = processCarRequest($VehicleKeywordReq);
    return $VehicleKeywordRes;
}

function VehicleCreateReservationReq($cart_car_data, $checkout_form, $cid){
    $car = json_decode(base64_decode($cart_car_data->response));
    //echo '<pre>';print_r($car);die;
    //2014-11-12T09:00:00.000-06:00

    $VehicleCreateReservationReq = '<?xml version="1.0" encoding="UTF-8"?>
                        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                           <soapenv:Header />
                           <soapenv:Body>
                              <univ:VehicleCreateReservationReq xmlns:univ="http://www.travelport.com/schema/universal_v28_0" AuthorizedBy="user" TargetBranch="P105180" TraceId="trace">
                                 <com:BillingPointOfSaleInfo xmlns:com="http://www.travelport.com/schema/common_v28_0" OriginApplication="UAPI" />
                                 <com:BookingTraveler xmlns:com="http://www.travelport.com/schema/common_v28_0" TravelerType="ADT">
                                    <com:BookingTravelerName First="'.$checkout_form->first_name.'" Last="'.$checkout_form->last_name.'" />
                                    <com:DeliveryInfo>
                                       <com:ShippingAddress>
                                          <com:AddressName>'.$checkout_form->street_address.'</com:AddressName>
                                          <com:Street>'.$checkout_form->street_address.'</com:Street>
                                          <com:City>'.$checkout_form->city.'</com:City>
                                          <com:State>CO</com:State>
                                          <com:PostalCode>'.$checkout_form->zip.'</com:PostalCode>
                                          <com:Country>'.$checkout_form->country.'</com:Country>
                                       </com:ShippingAddress>
                                    </com:DeliveryInfo>
                                    <com:PhoneNumber Number="'.$checkout_form->mobile.'" Type="Home" />
                                    <com:Email EmailID="'.$checkout_form->email.'" Type="Home" />
                                    <com:Address>
                                       <com:AddressName>'.$checkout_form->street_address.'</com:AddressName>
                                       <com:Street>'.$checkout_form->street_address.'</com:Street>
                                       <com:City>'.$checkout_form->city.'</com:City>
                                       <com:State>CO</com:State>
                                       <com:PostalCode>'.$checkout_form->zip.'</com:PostalCode>
                                       <com:Country>'.$checkout_form->country.'</com:Country>
                                    </com:Address>
                                 </com:BookingTraveler>
                                 <veh:VehicleDateLocation xmlns:veh="http://www.travelport.com/schema/vehicle_v28_0" PickupDateTime="'.$car->PickupDateTime.'" PickupLocation="'.$car->PickupLocation.'" PickupLocationType="'.$car->Location.'" ReturnDateTime="'.$car->ReturnDateTime.'" ReturnLocation="'.$car->ReturnLocation.'" />
                                 <veh:Vehicle xmlns:veh="http://www.travelport.com/schema/vehicle_v28_0" AirConditioning="'.$car->AirConditioning.'" Category="'.$car->Category.'" DoorCount="'.$car->DoorCount.'" Location="'.$car->Location.'" TransmissionType="'.$car->TransmissionType.'" VehicleClass="'.$car->VehicleClass.'" VendorCode="'.$car->VendorCode.'">
                                 </veh:Vehicle>
                              </univ:VehicleCreateReservationReq>
                           </soapenv:Body>
                        </soapenv:Envelope>';
    $VehicleCreateReservationRes = processCarRequest($VehicleCreateReservationReq);
    $VehicleCreateReservationReq_Res = array(
        'VehicleCreateReservationReq' => $VehicleCreateReservationReq,
        'VehicleCreateReservationRes' => $VehicleCreateReservationRes
    );
    return $VehicleCreateReservationReq_Res;
}

function processCarRequest($requestData){
    $CI =& get_instance();
    $CI->load->model('flight_model');
	$CI->load->model('xml_model');
    $credentials = $CI->flight_model->get_car_api_credentials();

    $soapAction = '';
	if(isset($credentials->username))
	{
    $Authorization = base64_encode('Universal API/'.$credentials->username.':'.$credentials->password);        

	 
    $httpHeader = array("SOAPAction: {$soapAction}", 
                    "Content-Type: text/xml; charset=UTF-8", 
                    "Content-Encoding: UTF-8",
                    "Authorization: Basic $Authorization",
                    "Content-length: ".strlen($requestData),
                    "Accept-Encoding: gzip,deflate");
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $credentials->url1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 180);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);//sd
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSLVERSION, 4);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);        
    curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
    curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");

    

    // Execute request, store response and HTTP response code
    $response = curl_exec($ch);
    $error = curl_getinfo($ch, CURLINFO_HTTP_CODE);
   // echo curl_error($ch);
    curl_close($ch);

    // header("Content-type: text/xml");
    // print_r($response);die;  
    //$response = new SimpleXMLElement($response);
    //$response = $response->children('http://schemas.xmlsoap.org/soap/envelope/')->Body->children("http://www.travelport.com/schema/air_v28_0");
	
    if($error != '200'){
      $xml_log = array(
          'Api' => 'UAPI',
          'XML_Type' => 'CAR - CURL ERROR',
          'XML_Request' => $requestData,
          'XML_Response' => $response,
          'Ip_address' => $this->input->ip_address(),
          'XML_Time' => date('Y-m-d H:i:s')
      );
      $CI->xml_model->insert_xml_log($xml_log);
    }
	if($response == ''){
      $xml_log = array(
          'Api' => 'UAPI',
          'XML_Type' => 'CAR - EMPTY RESPONSE',
          'XML_Request' => $requestData,
          'XML_Response' => $response,
          'Ip_address' => $_SERVER['REMOTE_ADDR'],
          'XML_Time' => date('Y-m-d H:i:s')
      );
      $CI->xml_model->insert_xml_log($xml_log);
   }
    return $response;
		}
		else
		{
			 $xml_log = array(
          'Api' => 'UAPI',
          'XML_Type' => 'CAR - API DEACTIVATED',
          'XML_Request' => $requestData,
          'XML_Response' => '',
          'Ip_address' => $_SERVER['REMOTE_ADDR'],
          'XML_Time' => date('Y-m-d H:i:s')
      );
      $CI->xml_model->insert_xml_log($xml_log);
	  
		return '';	
		}
		
}