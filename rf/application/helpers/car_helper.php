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
    $PickupDateTime = date("Y-m-d",strtotime($request->depart_date)).'T'.date("H:i:s",strtotime($request->depart_time.":".$request->depart_min));
    if($request->dropoff != ''){
        $return = 'ReturnLocation="'.$request->dropoff.'"';
    }else{
        $return = 'ReturnLocation="'.$request->pickup.'"';
    }
$Car_Category='';$Door_Count='';$Transmission='';$Fuel_Type='';$Vehicle_Class='';
    if($request->Car_Category != ''){
    $Car_Category = 'Category="'.$request->Car_Category.'"';
    }

    if($request->Door_Count != ''){
    $Door_Count = 'DoorCount="'.$request->Door_Count.'"';
    }

    if($request->Transmission != ''){
    $Transmission = 'TransmissionType="'.$request->Transmission.'"';
    }

    if($request->Fuel_Type != ''){
    $Fuel_Type = 'FuelType="'.$request->Fuel_Type.'"';
    }
    if($request->Vehicle_Class != ''){
    $Vehicle_Class = 'VehicleClass="'.$request->Vehicle_Class.'"';
    }

    $VehicleModifier=$Car_Category.' '.$Door_Count.' '.$Transmission.' '.$Fuel_Type.' '.$Vehicle_Class;
    //PickupLocationType="CityCenterDowntown",ReturnLocationType="CityCenterDowntown"

if(isset($request->nextlink) && $request->nextlink!='')
  {
    $nextlink= '<com:NextResultReference xmlns:com="http://www.travelport.com/schema/common_v31_0" ProviderCode="1G">'.$request->nextlink.'</com:NextResultReference>';  
  }
  else
  {
    $nextlink= '';
  }
    $ReturnDateTime = date("Y-m-d",strtotime($request->return_date)).'T'.date("H:i:s",strtotime($request->return_time.":".$request->return_min));
     $VehicleSearchAvailabilityReq = '<?xml version="1.0" encoding="UTF-8"?>
                                <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://www.travelport.com/schema/common_v31_0" xmlns:veh="http://www.travelport.com/schema/vehicle_v31_0">
                                   <soapenv:Header />
                                   <soapenv:Body>
                                      <veh:VehicleSearchAvailabilityReq  AuthorizedBy="user"  ReturnAllRates="false"  TargetBranch="P7003720" TraceId="trace">
                                         <com:BillingPointOfSaleInfo OriginApplication="UAPI" />
                                         '.$nextlink.'
                                         <veh:VehicleDateLocation PickupDateTime="'.$PickupDateTime.'" PickupLocation="'.$request->pickup.'" ReturnDateTime="'.$ReturnDateTime.'" '.$return.'/>
                                   <veh:VehicleSearchModifiers>
                                        <!--<veh:SearchDistance Direction="NE" MaxDistance="15" MinDistance="1" Units="KM"/>-->
                                    <veh:VehicleModifier '.$VehicleModifier.'  />

                                     </veh:VehicleSearchModifiers>
                                      </veh:VehicleSearchAvailabilityReq>
                                   </soapenv:Body>
                                </soapenv:Envelope>';
     $VehicleSearchAvailabilityRes = processCarRequest($VehicleSearchAvailabilityReq);
    $VehicleSearchAvailabilityReq_Res = array(
        'VehicleSearchAvailabilityReq' => $VehicleSearchAvailabilityReq,
        'VehicleSearchAvailabilityRes' => $VehicleSearchAvailabilityRes
    );
     $file = "XMLs/VehicleSearchAvailabilityReq.xml";
  prettyPrint($VehicleSearchAvailabilityReq,$file);
  $file1 = "XMLs/VehicleSearchAvailabilityRes.xml";
  prettyPrint($VehicleSearchAvailabilityRes,$file1);
  
    return $VehicleSearchAvailabilityReq_Res;
}

function VehicleMediaReq($car=''){
    //echo '<pre>';print_r($request);die;
    $VehicleMediaReq = '<?xml version="1.0" encoding="UTF-8"?>
                        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://www.travelport.com/schema/common_v31_0" xmlns:veh="http://www.travelport.com/schema/vehicle_v31_0">
                           <soapenv:Header />
                           <soapenv:Body>
                              <veh:VehicleMediaLinksReq AuthorizedBy="user" TargetBranch="P7003720" TraceId="trace">
                                 <com:BillingPointOfSaleInfo OriginApplication="UAPI" />
                                 <veh:VehiclePickupLocation PickUpLocation="'.$car->PickupLocation.'">
                                    <veh:Vendor Code="'.$car->VendorCode.'" />';
$AirConditioning=($car->AirConditioning!='')?'AirConditioning="'.$car->AirConditioning.'"':'';
$Category=($car->Category!='')?'Category="'.$car->Category.'"':'';
$DoorCount=($car->DoorCount!='')?'DoorCount="'.$car->DoorCount.'"':'';
$TransmissionType=($car->TransmissionType!='')?'TransmissionType="'.$car->TransmissionType.'"':'';
$VehicleClass=($car->VehicleClass!='')?'VehicleClass="'.$car->VehicleClass.'"':'';
 $VehicleModifier=$Category.' '.$AirConditioning.' '.$DoorCount.' '.$TransmissionType.' '.$VehicleClass;

                                    $VehicleMediaReq.='<veh:VehicleModifier '.$VehicleModifier.'  />
                                 </veh:VehiclePickupLocation>
                              </veh:VehicleMediaLinksReq>
                           </soapenv:Body>
                        </soapenv:Envelope>';
     $VehicleMediaRes = processCarRequest($VehicleMediaReq);
      $file = "XMLs/VehicleMediaLinksReq.xml";
  prettyPrint($VehicleMediaReq,$file);
  $file1 = "XMLs/VehicleMediaLinksRsp.xml";
  prettyPrint($VehicleMediaRes,$file1);
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
    // echo '<pre>';print_r($request);die;
    if($request!=''){
      $req=$request;
      $departure_date=$req->depart_date;
    }else{
      $departure_date='';
    }
    
   // echo $request->depart_date;
   
     $VehicleKeywordReq = '<?xml version="1.0" encoding="UTF-8"?>
                        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://www.travelport.com/schema/common_v31_0" xmlns:veh="http://www.travelport.com/schema/vehicle_v31_0">
                           <soapenv:Header />
                           <soapenv:Body>
                              <veh:VehicleKeywordReq AuthorizedBy="user" KeywordList="'.$list.'" TargetBranch="P7003720" TraceId="trace">
                                 <com:BillingPointOfSaleInfo OriginApplication="UAPI" />
                                 <veh:Vendor Code="'.$car->VendorCode.'" />
                                 <veh:PickupDateLocation Date="'.date("Y-m-d",strtotime($departure_date)).'" '.$PickupLocation.'/>
                                 '.$KeywordList_xml.'
                              </veh:VehicleKeywordReq>
                           </soapenv:Body>
                        </soapenv:Envelope>';
                   
                        
    $VehicleKeywordRes = processCarRequest($VehicleKeywordReq);
     $file = "XMLs/VehicleKeywordReq.xml";
  prettyPrint($VehicleKeywordReq,$file);
  $file1 = "XMLs/VehicleKeywordRsp.xml";
  prettyPrint($VehicleKeywordRes,$file1);
    return $VehicleKeywordRes;
}

function VehicleLocationDetailReq($data){
  $retutn_str='';
if($data['ReturnLocation']!='' && $data['ReturnDateTime']!=''){
  $ReturnDateTime='ReturnDateTime="'.$data['ReturnDateTime'].'"';
   $ReturnLocation='ReturnLocation="'.$data['ReturnLocation'].'"';
   $retutn_str=$ReturnLocation." ".$ReturnDateTime;
}
//Category,VehicleClass,
  $VehicleLocationDetailReq='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://www.travelport.com/schema/common_v31_0" xmlns:veh="http://www.travelport.com/schema/vehicle_v31_0">
<soapenv:Header/>
<soapenv:Body>
<veh:VehicleLocationDetailReq AuthorizedBy="user" TargetBranch="P7003720" TraceId="trace">
<com:BillingPointOfSaleInfo OriginApplication="UAPI"/>
<veh:Vendor Code="'.$data['VendorCode'].'"/>
<veh:VehicleDateLocation PickupDateTime="'.$data['PickupDateTime'].'" PickupLocation="'.$data['PickupLocation'].'" '.$retutn_str.' >';




$ProviderCode=($data['ProviderCode']!='')?'ProviderCode="'.$data['ProviderCode'].'"':'ProviderCode="1G"';
$VendorLocationID=($data['VendorLocationID']!='')?'VendorLocationID="'.$data['VendorLocationID'].'"':'';

 


$VehicleLocationDetailReq.='<veh:VendorLocation Key="'.$data['VendorLocationKey'].'" '.$ProviderCode.' VendorCode="'.$data['VendorCode'].'" '.$VendorLocationID.'/>
</veh:VehicleDateLocation>
</veh:VehicleLocationDetailReq>
</soapenv:Body>
</soapenv:Envelope>';

$VehicleLocationDetailRes = processCarRequest($VehicleLocationDetailReq);

$VehicleReq_Res = array(
        'VehicleLocationDetailReq' => $VehicleLocationDetailReq,
        'VehicleLocationDetailRes' => $VehicleLocationDetailRes
    );
$file = "XMLs/VehicleLocationDetailReq.xml";
  prettyPrint($VehicleLocationDetailReq,$file);
  $file1 = "XMLs/VehicleLocationDetailRes.xml";
  prettyPrint($VehicleLocationDetailRes,$file1);
    return $VehicleReq_Res;


}


function VehicleRulesReq($data){
  $retutn_str='';
if($data['ReturnLocation']!='' && $data['ReturnDateTime']!=''){
  $ReturnDateTime='ReturnDateTime="'.$data['ReturnDateTime'].'"';
   $ReturnLocation='ReturnLocation="'.$data['ReturnLocation'].'"';
   $retutn_str=$ReturnLocation." ".$ReturnDateTime;
}

  $VehicleRulesReq='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://www.travelport.com/schema/common_v31_0" xmlns:veh="http://www.travelport.com/schema/vehicle_v31_0">
<soapenv:Header/>
<soapenv:Body>
<veh:VehicleRulesReq AuthorizedBy="user" TargetBranch="P7003720" TraceId="trace">
<com:BillingPointOfSaleInfo OriginApplication="UAPI"/>
<veh:VehicleRulesLookup>
<veh:VehicleDateLocation PickupDateTime="'.$data['PickupDateTime'].'" PickupLocation="'.$data['PickupLocation'].'" '.$retutn_str.' />
<veh:VehicleSearchModifiers RateCategory="'.$data['RateCategory'].'" RatePeriod="'.$data['RatePeriod'].'">';

$AirConditioning=($data['AirConditioning']!='')?'AirConditioning="'.$data['AirConditioning'].'"':'';
$Category=($data['Category']!='')?'Category="'.$data['Category'].'"':'';
$DoorCount=($data['DoorCount']!='')?'DoorCount="'.$data['DoorCount'].'"':'';
$TransmissionType=($data['TransmissionType']!='')?'TransmissionType="'.$data['TransmissionType'].'"':'';
$VehicleClass=($data['VehicleClass']!='')?'VehicleClass="'.$data['VehicleClass'].'"':'';
 
 $VehicleModifier=$Category.' '.$AirConditioning.' '.$DoorCount.' '.$TransmissionType.' '.$VehicleClass;

                                  
                                    $VehicleRulesReq.='<veh:VehicleModifier '.$VehicleModifier.'  />
<veh:RateModifiers RateCode="'.$data['RateCode'].'" VendorCode="'.$data['VendorCode'].'"/>
<veh:RateHostIndicator InventoryToken="'.$data['InventoryToken'].'" RateToken="'.$data['RateToken'].'"/>
</veh:VehicleSearchModifiers>
</veh:VehicleRulesLookup>
</veh:VehicleRulesReq>
</soapenv:Body>
</soapenv:Envelope>';




   $VehicleRulesRes = processCarRequest($VehicleRulesReq);


$VehicleReq_Res = array(
        'VehicleRulesReq' => $VehicleRulesReq,
        'VehicleRulesRes' => $VehicleRulesRes
    );
$file = "XMLs/VehicleRulesReq.xml";
  prettyPrint($VehicleRulesReq,$file);
  $file1 = "XMLs/VehicleRulesRes.xml";
  prettyPrint($VehicleRulesRes,$file1);
    return $VehicleReq_Res;
    


}


 


function VehicleCreateReservationReq($cart_car_data, $checkout_form, $cid,$payment_result){
    $car = json_decode(base64_decode($cart_car_data->response));
    $payment_result=json_decode(base64_decode($payment_result));
    //echo '<pre>';print_r($payment_result);die;
    //2014-11-12T09:00:00.000-06:00

        $fname="first_name"."$cid";
        $lname="last_name"."$cid";
        $Title="selTitle"."$cid";
        $dddd="birth_day"."$cid";
        $mmmm="birth_month"."$cid";
        $yyyy="birth_year"."$cid";
        $doba=$checkout_form->$yyyy.'-'.$checkout_form->$mmmm.'-'.$checkout_form->$dddd;
        $gender="selGender"."$cid";

        $address='';$card_details='';
          $address='<com:AddressName>'.$checkout_form->street_address.'</com:AddressName>
          <com:Street>'.$checkout_form->street_address.'</com:Street>
          <com:City>'.$checkout_form->city.'</com:City>
          <!-- <com:State>CO</com:State>-->
          <com:PostalCode>'.$checkout_form->zip.'</com:PostalCode>
          <com:Country>'.$checkout_form->country.'</com:Country>';
if(is_array($payment_result)){
  $exdate=$payment_result->Exp_Year.'-'.$payment_result->Exp_Month;
  $card_details='<com:CreditCard CVV="'.$payment_result->Card_Cvc.'" ExpDate="'.$exdate.'"  Name="'.$payment_result->Card_Name.'" Number="'.$payment_result->Card_Num.'" Type="'.$payment_result->payment_type.'">';
}else{
$card_details='<com:CreditCard CVV="256" ExpDate="2016-06"  Name="Jack Smith" Number="4111111111111111" Type="VI">';
}
          

    $VehicleCreateReservationReq = '<?xml version="1.0" encoding="UTF-8"?>
                        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                           <soapenv:Header />
                           <soapenv:Body>
                              <univ:VehicleCreateReservationReq xmlns:univ="http://www.travelport.com/schema/universal_v31_0" AuthorizedBy="user" TargetBranch="P7003720" TraceId="trace">
                                 <com:BillingPointOfSaleInfo xmlns:com="http://www.travelport.com/schema/common_v31_0" OriginApplication="UAPI" />
                                 <com:BookingTraveler xmlns:com="http://www.travelport.com/schema/common_v31_0" TravelerType="ADT">
                                    <com:BookingTravelerName First="'.$checkout_form->$fname.'" Last="'.$checkout_form->$lname.'" />
                                    <com:DeliveryInfo>
                                       <com:ShippingAddress>
                                          '.$address.'
                                       </com:ShippingAddress>
                                    </com:DeliveryInfo>
                                    <com:PhoneNumber Number="'.$checkout_form->mobile.'" Type="Home" />
                                    <com:Email EmailID="'.$checkout_form->email.'" Type="Home" />
                                    <com:Address>
                                      '.$address.'
                                    </com:Address>
                                 </com:BookingTraveler>
                                  <com:FormOfPayment xmlns:com="http://www.travelport.com/schema/common_v31_0"  Type="Credit">
                                  '.$card_details.'
                                  <com:BillingAddress>
                                  '.$address.'
                                  </com:BillingAddress>
                                  </com:CreditCard>
                                  </com:FormOfPayment>
                                 <veh:VehicleDateLocation xmlns:veh="http://www.travelport.com/schema/vehicle_v31_0" PickupDateTime="'.$car->PickupDateTime.'" PickupLocation="'.$car->PickupLocation.'" PickupLocationType="'.$car->Location.'" ReturnDateTime="'.$car->ReturnDateTime.'" ReturnLocation="'.$car->ReturnLocation.'" />';
                                 
$AirConditioning=($car->AirConditioning!='')?'AirConditioning="'.$car->AirConditioning.'"':'';
$Category=($car->Category!='')?'Category="'.$car->Category.'"':'';
$DoorCount=($car->DoorCount!='')?'DoorCount="'.$car->DoorCount.'"':'';
$TransmissionType=($car->TransmissionType!='')?'TransmissionType="'.$car->TransmissionType.'"':'';
$VehicleClass=($car->VehicleClass!='')?'VehicleClass="'.$car->VehicleClass.'"':'';
 
 $VehicleModifier=$Category.' '.$AirConditioning.' '.$DoorCount.' '.$TransmissionType.' '.$VehicleClass;
                                    

                                  $VehicleCreateReservationReq.= '<veh:Vehicle xmlns:veh="http://www.travelport.com/schema/vehicle_v31_0" '.$VehicleModifier.' Location="'.$car->Location.'" VendorCode="'.$car->VendorCode.'">
                                 </veh:Vehicle>
                              </univ:VehicleCreateReservationReq>
                           </soapenv:Body>
                        </soapenv:Envelope>';
    $VehicleCreateReservationRes = processCarRequest($VehicleCreateReservationReq);
    $VehicleCreateReservationReq_Res = array(
        'VehicleCreateReservationReq' => $VehicleCreateReservationReq,
        'VehicleCreateReservationRes' => $VehicleCreateReservationRes
    );

     $file = "XMLs/VehicleCreateReservationReq.xml";
  prettyPrint($VehicleCreateReservationReq,$file);
  $file1 = "XMLs/VehicleCreateReservationRes.xml";
  prettyPrint($VehicleCreateReservationRes,$file1);
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

     //header("Content-type: text/xml");
    // print_r($response);die;  
    //$response = new SimpleXMLElement($response);
    //$response = $response->children('http://schemas.xmlsoap.org/soap/envelope/')->Body->children("http://www.travelport.com/schema/air_v28_0");
	
    if($error != '200'){
      $xml_log = array(
          'Api' => 'UAPI',
          'XML_Type' => 'CAR - CURL ERROR',
          'XML_Request' => $requestData,
          'XML_Response' => $response,
          'Ip_address' =>$_SERVER['REMOTE_ADDR'],
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