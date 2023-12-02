<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Viabeta_Model extends CI_Model {

    //private $url = 'http://testph.via.com/webserviceAPI?source=TEST&auth=test@!234&actionId='; ### Test URL
    private $url = 'http://ph.via.com/webserviceAPI?source=REDTAG&auth=redtag@123&actionId='; #### Live URL
     ## Live ##
    /* private $new_url = 'https://ph.via.com/apiv2/flight/';
     private $access_Token = '212807fc-bfca-24e3-pdre-uae96240c52e';*/
      ## Test ##
    private $new_url = 'http://testph.via.com/apiv2/flight/';
    private $access_Token = 'c51b5435-cec6-4de2-b133-4t9e3s12ta02';

    function getFlightAvailabilityOw($searchParms) {
	
    //print_r($searchParms);die;
		$prefAirlineslist='';$round_trip_='';
        $request_id = 'RDT' . date('YmdHis');
    
    if($searchParms['pref_airline']!=null){
       $prefAirlineslist='prefAirlines:[{"code":"'.substr($searchParms['pref_airline'],-2).'"}],'; 
    }

    if($searchParms['travelClass']=='A'){
            $travelClass='ALL';
    }elseif ($searchParms['travelClass']=='E') {
           $travelClass='ECONOMY';
    }elseif ($searchParms['travelClass']=='B') {
           $travelClass='BUSINESS';
    }elseif ($searchParms['travelClass']=='F') {
            $travelClass='FIRST';
    }else{
     $travelClass=$searchParms['travelClass'];
    }


/*Calss /ECONOMY_FULL/ECONOMY_
PREMIUM/REFUNDABLE/OTHERS
Route/DIRECT/DIRECT_NONSTOP
/SINGLE_CONNECTING

*/

        if(isset($searchParms['journey_type']) && $searchParms['journey_type']== 'round_trip'){
             $round_trip_=',{
            "src": {
              "code": "'.trim($searchParms['toCode']).'"
            },
            "dest": {
              "code": "'.trim($searchParms['fromCode']).'"
            },
            "date": "'.trim($searchParms['ed']).'"
         }';
            }
		

		$postData = '{
		  "sectorInfos": [{
			"src": {
			  "code": "'.trim($searchParms['fromCode']).'"
			},
			 "dest": {
			  "code": "'.trim($searchParms['toCode']).'"
			},
			 "date": "'.trim($searchParms['sd']).'"
		 }'.$round_trip_.'],
		  "class":"'.$travelClass.'",
          '.$prefAirlineslist.'
			"paxCount":  {
				"adt": "'.trim($searchParms['adult']).'",
				"chd": "'.trim($searchParms['child']).'",
				"inf": "'.trim($searchParms['infant']).'"
			  },
				"route": "'.(($searchParms['route']!='')?$searchParms['route']:'ALL').'",
                "senior": "'.(($searchParms['sr_ctzn']==true)?$searchParms['sr_ctzn']:'false').'",
                "multiCity": "false"
			   
		  
		}'; 
	
$curlConnection = curl_init();

curl_setopt($curlConnection, CURLOPT_HTTPHEADER, array( "Content-Encoding: UTF-8","Content-Type: application/json","Via-Access-Token: ".$this->access_Token));
curl_setopt($curlConnection, CURLOPT_URL, $this->new_url.'search');
curl_setopt($curlConnection, CURLOPT_POST, TRUE);
curl_setopt($curlConnection, CURLOPT_POSTFIELDS, $postData);
curl_setopt($curlConnection, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($curlConnection, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curlConnection, CURLOPT_SSL_VERIFYPEER, FALSE);
$results = curl_exec($curlConnection);
 $res = json_decode($results, true);


$reqfile = fopen($_SERVER['DOCUMENT_ROOT'].'/agent/Viaapi/xml_logs/'.$searchParms['journey_type']."req.json", "w") or die("Unable to open file!");
$rspfile = fopen($_SERVER['DOCUMENT_ROOT'].'/agent/Viaapi/xml_logs/'.$searchParms['journey_type']."rsp.json", "w") or die("Unable to open file!");
fwrite($reqfile, $postData);
fwrite($rspfile, $results);
fclose($reqfile);fclose($rspfile);



if(isset($searchParms['journey_type']) && $searchParms['journey_type'] == 'round_trip'){
    if (trim($searchParms['fromCountry']) == 'Philippines' && trim($searchParms['toCountry']) == 'Philippines') {
    $data = $this->getRoundTripDomFlights($res);
    } else {
    $data = $this->getRoundTripIntlFlights($res);
    }
}else{
  $data = $this->getOnewayDomFlights($res);   
}

$error = curl_getinfo($curlConnection, CURLINFO_HTTP_CODE);
curl_close($curlConnection);
        return $data;
    }

    function getOnewayDomFlights($res) {
		#echo "<pre>";print_r($res);die;
		$filters['count'] = count($res['onwardJourneys']);
        return array('via_data' => $res['onwardJourneys'],'filters' => $filters);
    }

    function getOnewayIntlFlights($res) {
       
    }

    function getFlightAvailabilityRt($searchParams) {
       
    }

     function getRoundTripIntlFlights($res) {
        $count = 0;
       
       # echo '<pre />';print_r($res);die;
        $filters['count'] = count($res['combinedJourneys']);
        return array('via_data' => ($res['combinedJourneys']), 'filters' => $filters);
    }

    function getRoundTripDomFlights($res) {
       
        $count = 0;
        $viaData['Inbound'] = $res['onwardJourneys'];
        $viaData['Outbound'] = $res['returnJourneys'];
        $filters['count'] = count($res['onwardJourneys']);
        return array('via_data' => $viaData, 'filters' => $filters);
    }

   

    function flightDetails($onward, $return = '', $requestId = '', $searchData, $admin_markup, $agent_markup,$flgtType) {

          #echo "<pre>";print_r($onward);die;
        $booking_final_data = '';
        $mid = '';
        $mark = 0;
        $xml = '';

	   if ($searchData['journey_type'] == 'one_way') {
         
			
			$postData = '{
			  "keys": ["'.trim($requestId).'"],
			  "isSSRReq" : "true",
			   "isExReq" : "true"
			}'; 
			
        } else {
            $return_dom='';
            if(!empty($return)){
                $return_dom=',"'.$return['key'].'"';
            }
            $postData = '{
              "keys": ["'.trim($onward['key']).'"'.$return_dom.'],
              "isSSRReq" : "true",
               "isExReq" : "true"
            }'; 
          
        }




        
    
        #echo $postData;die;
       
		$curlConnection = curl_init();
		
		curl_setopt($curlConnection, CURLOPT_HTTPHEADER, array( "Content-Encoding: UTF-8","Content-Type: application/json","Via-Access-Token: ".$this->access_Token));
		curl_setopt($curlConnection, CURLOPT_URL, $this->new_url.'review');
		 #curl_setopt($curlConnection, CURLOPT_TIMEOUT, 180);
		curl_setopt($curlConnection, CURLOPT_POST, TRUE);
		 #curl_setopt($curlConnection, CURLOPT_RETURNTRANSFER, 1);
		 #curl_setopt($curlConnection, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curlConnection, CURLOPT_POSTFIELDS, $postData);
		curl_setopt($curlConnection, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($curlConnection, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlConnection, CURLOPT_SSL_VERIFYPEER, FALSE);

		 $results = curl_exec($curlConnection);
		 $res = json_decode($results, true);
		
        $reqfile = fopen($_SERVER['DOCUMENT_ROOT'].'/agent/Viaapi/xml_logs/'.$searchData['journey_type']."PricecheckReq.json", "w") or die("Unable to open file!");
$rspfile = fopen($_SERVER['DOCUMENT_ROOT'].'/agent/Viaapi/xml_logs/'.$searchData['journey_type']."PricecheckRsp.json", "w") or die("Unable to open file!");
fwrite($reqfile, $postData);
fwrite($rspfile, $results);
fclose($reqfile);fclose($rspfile);

		 $error = curl_getinfo($curlConnection, CURLINFO_HTTP_CODE);
		 curl_close($curlConnection);
		 $booking_final_data = 	$res;
		//echo "<pre>";print_r($booking_final_data);
        //echo $mark;die;
        if($booking_final_data != ''){
            return array('booking_final_data' => $booking_final_data);
        } else {
            return array('booking_final_data' => $booking_final_data);
        }
    }

    function flightDetailsIntl($onward, $return = '', $requestId = '', $searchData, $admin_markup, $agent_markup, $flightType) {
        $booking_final_data = '';
        $mid = '';
        $mark = 0;
        $request = $requestId;
        foreach ($onward['Inbound']['legs'] as $leg) {
            $mid .= '<OnwardFlights>
                        <Flight>
                          <CarrierId>' . $leg['Carrier_code'] . '</CarrierId>
                          <FlightNumber>' . $leg['FlightNumber'] . '</FlightNumber>
                          <Source>' . $leg['Source'] . '</Source>
                          <Destination>' . $leg['Destination'] . '</Destination>
                          <DepartureTimeStamp>' . $leg['DepartureTimeStamp'] . '</DepartureTimeStamp>
                          <ArrivalTimeStamp>' . $leg['ArrivalTimeStamp'] . '</ArrivalTimeStamp>
                          <Class>' . $leg['Class'] . '</Class>
                          <FareBasis>' . $leg['FareBasis'] . '</FareBasis>
                        </Flight>
                    </OnwardFlights>';
        }
        foreach ($onward['Inbound']['legs'] as $leg) {
            $mid .= '<ReturnFlights>
                        <Flight>
                          <CarrierId>' . $leg['Carrier_code'] . '</CarrierId>
                          <FlightNumber>' . $leg['FlightNumber'] . '</FlightNumber>
                          <Source>' . $leg['Source'] . '</Source>
                          <Destination>' . $leg['Destination'] . '</Destination>
                          <DepartureTimeStamp>' . $leg['DepartureTimeStamp'] . '</DepartureTimeStamp>
                          <ArrivalTimeStamp>' . $leg['ArrivalTimeStamp'] . '</ArrivalTimeStamp>
                          <Class>' . $leg['Class'] . '</Class>
                          <FareBasis>' . $leg['FareBasis'] . '</FareBasis>
                        </Flight>
                    </ReturnFlights>';
        }
        $xml = '<AirPriceRequest>
                    <RequestId>' . $request . '</RequestId>
                     <Itinerary>
                        ' . $mid . '
                    </Itinerary>
                    <PassengerCount>
                      <Adults>' . $searchData['adult'] . '</Adults>
                      <Children>' . $searchData['child'] . '</Children>
                      <Infants>' . $searchData['infant'] . '</Infants>
                    </PassengerCount>
                </AirPriceRequest>';

        //echo $xml;die;
        $url = $this->url . 'AirPriceRequest';

        //setting the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // Following line is compulsary to add as it is:
        curl_setopt($ch, CURLOPT_POSTFIELDS, "xmlRequest=" . $xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        //echo $response;die; 
        $res = new DOMDocument();
        $res->loadXML($response);

        if($res->getElementsByTagName('Error')->length > 0){
            $booking_final_data = '';
            $mark = 0;
        } else {
            if ($res->getElementsByTagName('AirPriceResponse')->length > 0) {
            $booking_final_data['isBlockingAllowed'] = $res->getElementsByTagName('isBlockingAllowed')->item(0)->nodeValue;
            $booking_final_data['OperatingCarrier'] = $res->getElementsByTagName('OperatingCarrier')->item(0)->nodeValue;

            if ($res->getElementsByTagName('PricedItinerary')->length > 0) {
                $flights = $res->getElementsByTagName('PricedItinerary');
                $onwardFlights = $res->getElementsByTagName('OnwardFlights');
                $returnFlights = $res->getElementsByTagName('ReturnFlights');
                $charges = $flights->item(0)->getElementsByTagName('Pricing')->item(0)->getElementsByTagName('ServiceCharges');

                $tot = $flights->item(0)->getElementsByTagName('Pricing')->item(0)->getElementsByTagName('TotalAmount')->item(0)->nodeValue;
                $booking_final_data['TotalAmount_org'] = $tot;
                if ($admin_markup['type'] == 'fixed') {
                    $mark = $admin_markup['international'];
                    $tot = ($tot + $admin_markup['international']);
                } else {
                    $mark = (($admin_markup['international'] / 100) * $tot);
                    $tot = $tot + $mark;
                }
                
                if ($agent_markup['type'] == 'fixed') {
                    $agentmark = $agent_markup['international'];
                    $tot = ($tot + $agent_markup['international']);
                } else {
                    $agentmark = (($agent_markup['international'] / 100) * $tot);
                    $tot = $tot + $mark;
                }
                
                $booking_final_data['TotalAmount'] = $tot;
                $k = 0;
                foreach ($charges as $charge) {
                    $booking_final_data['fare'][$k]['type'] = $charge->getAttribute('type');
                    $booking_final_data['fare'][$k]['ChargeType'] = $charge->getAttribute('ChargeType');
                    if ($k == 0 && $booking_final_data['fare'][$k]['ChargeType'] != 'totalAmount') {
                        $booking_final_data['fare'][$k]['price'] = ($charge->nodeValue + $mark);
                    } else if($booking_final_data['fare'][$k]['ChargeType'] == 'totalAmount'){
                        $booking_final_data['fare'][$k]['price'] = ($charge->nodeValue + $mark);
                    } else {
                        $booking_final_data['fare'][$k]['price'] = $charge->nodeValue;
                    }
                    $k++;
                }

                $legs = $onwardFlights->item(0)->getElementsByTagName('Flight');
                $j = 0;
                foreach ($legs as $leg) {
                    $booking_final_data['Inbound']['legs'][$j]['Carrier_code'] = $leg->getElementsByTagName('Carrier')->item(0)->getAttribute('id');
                    $booking_final_data['Inbound']['legs'][$j]['Carrier'] = $leg->getElementsByTagName('Carrier')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['FlightNumber'] = $leg->getElementsByTagName('FlightNumber')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['Source'] = $leg->getElementsByTagName('Source')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['Destination'] = $leg->getElementsByTagName('Destination')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['DepartureTimeStamp'] = $leg->getElementsByTagName('DepartureTimeStamp')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['ArrivalTimeStamp'] = $leg->getElementsByTagName('ArrivalTimeStamp')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['Class'] = $leg->getElementsByTagName('Class')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['FareBasis'] = $leg->getElementsByTagName('FareBasis')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['WarningText'] = $leg->getElementsByTagName('WarningText')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['TicketType'] = $leg->getElementsByTagName('TicketType')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['Refundable'] = $leg->getElementsByTagName('Refundable')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['SeatLeft'] = $leg->getElementsByTagName('SeatLeft')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['BaggageInfo'] = $leg->getElementsByTagName('BaggageInfo')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['MealInfo'] = $leg->getElementsByTagName('MealInfo')->item(0)->nodeValue;

                    $j++;
                }

                if ($onwardFlights->item(0)->getElementsByTagName('SinglePassengerBaggageOptions')->length > 0) {
                    $baggages = $onwardFlights->item(0)->getElementsByTagName('SinglePassengerBaggageOptions')->item(0)->getElementsByTagName('option');
                    $m = 0;
                    foreach ($baggages as $baggage) {
                        $booking_final_data['Inbound']['baggage'][$m]['size'] = $baggage->getAttribute('size');
                        $booking_final_data['Inbound']['baggage'][$m]['price'] = $baggage->getAttribute('price');
                        $m++;
                    }
                }


                $legs = $returnFlights->item(0)->getElementsByTagName('Flight');
                $j = 0;
                foreach ($legs as $leg) {
                    $booking_final_data['Outbound']['legs'][$j]['Carrier_code'] = $leg->getElementsByTagName('Carrier')->item(0)->getAttribute('id');
                    $booking_final_data['Outbound']['legs'][$j]['Carrier'] = $leg->getElementsByTagName('Carrier')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['FlightNumber'] = $leg->getElementsByTagName('FlightNumber')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['Source'] = $leg->getElementsByTagName('Source')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['Destination'] = $leg->getElementsByTagName('Destination')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['DepartureTimeStamp'] = $leg->getElementsByTagName('DepartureTimeStamp')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['ArrivalTimeStamp'] = $leg->getElementsByTagName('ArrivalTimeStamp')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['Class'] = $leg->getElementsByTagName('Class')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['FareBasis'] = $leg->getElementsByTagName('FareBasis')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['WarningText'] = $leg->getElementsByTagName('WarningText')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['TicketType'] = $leg->getElementsByTagName('TicketType')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['Refundable'] = $leg->getElementsByTagName('Refundable')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['SeatLeft'] = $leg->getElementsByTagName('SeatLeft')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['BaggageInfo'] = $leg->getElementsByTagName('BaggageInfo')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['MealInfo'] = $leg->getElementsByTagName('MealInfo')->item(0)->nodeValue;

                    $j++;
                }

                if ($returnFlights->item(0)->getElementsByTagName('SinglePassengerBaggageOptions')->length > 0) {
                    $baggages = $returnFlights->item(0)->getElementsByTagName('SinglePassengerBaggageOptions')->item(0)->getElementsByTagName('option');
                    $m = 0;
                    foreach ($baggages as $baggage) {
                        $booking_final_data['Outbound']['baggage'][$m]['size'] = $baggage->getAttribute('size');
                        $booking_final_data['Outbound']['baggage'][$m]['price'] = $baggage->getAttribute('price');
                        $m++;
                    }
                }
            }
        }
        }
        
        if($booking_final_data != ''){
            return array('booking_final_data' => $booking_final_data, 'admin_markup' => $mark, 'agent_markup'=>$agentmark);
        } else {
            return array('booking_final_data' => $booking_final_data, 'admin_markup' => 0, 'agent_markup'=>0);
        }
    }


    public function get_countrycode_by_name($code){
        $this->db->select('countries_iso_code as countrycode');
        $this->db->where('countries_isd_code', $code);
        # $this->db->where('countries_name', $name);
        $data = $this->db->get('country_phone_code')->row();
        return $data->countrycode;
    }

    function booking($postData, $onwardDetails, $requestData, $priceFinalData, $requestId, $masterId) {
      

#echo "<pre>";print_r($priceFinalData);
//fromCountry,
/*"addToCoTraveller": true,
*/
/**/






    $countrycode=$this->get_countrycode_by_name($postData['mobile_code']);
          $adults='';  $childs='';  $infants='';
         for ($a=0; $a <$requestData['adult'] ; $a++) { 
            $adob=explode('-', $postData['adult_dob'][$a]);
            $adob=array_reverse($adob);
            $adob=implode('-', $adob);
            $adultpassport='';
             if(isset($postData['adult_passport_no'][$a]) && $postData['adult_passport_no'][$a]!=''){
            
            $adultpassport=',"passport" : {"nat":"'.$countrycode.'","num":"'.$postData['adult_passport_no'][$a].'","doe":"2020-10-12","doi":"2014-05-13"}';
            }
 $adultSSR=''; $adultBaggageOnward=''; $adultBaggageReturn=''; $adultMealsOnward=''; $adultMealsReturn='';
  if(isset($postData['adultBaggageOnward'][$a]) && $postData['adultBaggageOnward'][$a]!=''){
$adultBaggageOnward='{
"code": "'.$postData['adultBaggageOnward'][$a].'",
"ssrType": "baggage",
"key": "'.$priceFinalData['ssr']['ssrHeap']['baggage'][0]['key'].'"
}';
}

 if(isset($postData['adultBaggageReturn'][$a]) && $postData['adultBaggageReturn'][$a]!=''){
$adultBaggageReturn='{
"code": "'.$postData['adultBaggageReturn'][$a].'",  
"ssrType": "baggage",
"key": "'.$priceFinalData['ssr']['ssrHeap']['baggage'][1]['key'].'"
}';
}

 if(isset($postData['adultMealsOnward'][$a]) && $postData['adultMealsOnward'][$a]!=''){
$adultMealsOnward='{
"code": "'.$postData['adultMealsOnward'][$a].'",
"ssrType": "meal",
"key": "'.$priceFinalData['ssr']['ssrHeap']['meal'][0]['key'].'"


}';
}

 if(isset($postData['adultMealsReturn'][$a]) && $postData['adultMealsReturn'][$a]!=''){
$adultMealsReturn='{
"code": "'.$postData['adultMealsReturn'][$a].'",
"ssrType": "meal",
"key": "'.$priceFinalData['ssr']['ssrHeap']['meal'][1]['key'].'"


}';
}

$adultssr_String=$adultBaggageOnward.$adultBaggageReturn.$adultMealsOnward.$adultMealsReturn;
if($adultssr_String!=''){
$adultssr_String=rtrim(str_replace("}", "},", $adultssr_String),',');
if(is_string($adultssr_String) && $adultssr_String!=''){
    $adultSSR=',"ssr":['.$adultssr_String.']'; 
}
}




//'.$adob.'
           $adults.='{
        "title": "Mr",
        "firstName": "'.$postData['adultFname'][$a].'",
        "lastName": "'.$postData['adultLname'][$a].'",
        "pType": "adt",
         "dob":"1990-05-31"
          '.$adultSSR.'
         '.$adultpassport.'
        },';
         }

         for ($c=0; $c <$requestData['child'] ; $c++) { 
            $cdob=explode('-', $postData['child_dob'][$c]);
            $cdob=array_reverse($cdob);
            $cdob=implode('-', $cdob);
            $childpassport='';
              if(isset($postData['child_passport_no'][$c]) && $postData['child_passport_no'][$c]!=''){
            $childpassport=',"passport" : {"nat":"'.$countrycode.'","num":"'.$postData['child_passport_no'][$c].'","doe":"2020-10-12","doi":"2014-05-13"}';
                }

               
$childSSR=''; $childBaggageOnward=''; $childBaggageReturn=''; $childMealsOnward=''; $childMealsReturn='';
  if(isset($postData['childBaggageOnward'][$c]) && $postData['childBaggageOnward'][$c]!=''){
$childBaggageOnward='{
"code": "'.$postData['childBaggageOnward'][$c].'",
"ssrType": "baggage",
"key": "'.$priceFinalData['ssr']['ssrHeap']['baggage'][0]['key'].'"


}';
}

 if(isset($postData['childBaggageReturn'][$c]) && $postData['adultBaggageReturn'][$c]!=''){
$childBaggageReturn='{
"code": "'.$postData['childBaggageReturn'][$c].'",
"ssrType": "baggage",
"key": "'.$priceFinalData['ssr']['ssrHeap']['baggage'][1]['key'].'"


}';
}

 if(isset($postData['childMealsOnward'][$c]) && $postData['childMealsOnward'][$c]!=''){
$childMealsOnward='{
"code": "'.$postData['childMealsOnward'][$c].'",
"ssrType": "meal",
"key": "'.$priceFinalData['ssr']['ssrHeap']['meal'][0]['key'].'"
}';
}

 if(isset($postData['childMealsReturn'][$c]) && $postData['childMealsReturn'][$c]!=''){
$childMealsReturn='{
"code": "'.$postData['childMealsReturn'][$c].'",
"ssrType": "meal",
"key": "'.$priceFinalData['ssr']['ssrHeap']['meal'][1]['key'].'"


}';
}

$childssr_String=$childBaggageOnward.$childBaggageReturn.$childMealsOnward.$childMealsReturn;
if($childssr_String!=''){
$childssr_String=rtrim(str_replace("}", "},", $childssr_String),',');
if(is_string($childssr_String) && $childssr_String!=''){
    $childSSR=',"ssr":['.$childssr_String.']'; 
}
}

           $childs.='{
        "title": "Mstr",
        "firstName": "'.$postData['childFname'][$c].'",
        "lastName": "'.$postData['childLname'][$c].'",
       "pType": "chd",
         "dob":"2011-05-31"
           '.$childSSR.'
         '.$childpassport.'
        },';
         }


         for ($i=0; $i <$requestData['infant'] ; $i++) { 
            $idob=explode('-', $postData['infant_dob'][$i]);
            $idob=array_reverse($idob);
            $idob=implode('-', $idob);
            $infantpassport='';
            if(isset($postData['infant_passport_no'][$i]) && $postData['infant_passport_no'][$i]!=''){
                $infantpassport=',"passport" : {"nat":"'.$countrycode.'","num":"'.$postData['infant_passport_no'][$i].'","doe":"2020-10-12","doi":"2014-05-13"}';
            }

             $infantSSR='';$infantBaggageOnward=''; $infantBaggageReturn='';
if(isset($postData['infantBaggageOnward'][$i]) && $postData['infantBaggageOnward'][$i]!=''){
$infantBaggageOnward='{
    "code": "'.$postData['infantBaggageOnward'][$c].'",
    "ssrType": "baggage",
"key": "'.$priceFinalData['ssr']['ssrHeap']['baggage'][0]['data']['key'].'"


}';
}

if(isset($postData['infantBaggageReturn'][$i]) && $postData['infantBaggageReturn'][$i]!=''){
$infantBaggageReturn='{
    "code": "'.$postData['infantBaggageReturn'][$c].'",
    "ssrType": "baggage",
"key": "'.$priceFinalData['ssr']['ssrHeap']['baggage'][0]['data']['key'].'"


}';
}


$infantssr_String=$infantBaggageOnward.$infantBaggageReturn;
if($infantssr_String!=''){
$infantssr_String=rtrim(str_replace("}", "},", $infantssr_String),',');
if(is_string($infantssr_String) && $infantssr_String!=''){
    $infantSSR=',"ssr":['.$infantssr_String.']'; 
}
}
            
           $infants.='{
        "title": "Mstr",
        "firstName": "'.$postData['infantFname'][$i].'",
        "lastName": "'.$postData['infantLname'][$i].'",
         "pType": "inf",
          "dob":"2018-01-31"
             '.$infantSSR.'
          '.$infantpassport.'
        },';
         }

         $passangers_details=rtrim($adults.$childs.$infants,',');
          $BookpostData_ = '{
        "deliveryData": {
        "mobile": "'.$postData['phone_number'].'",
        "isdCode": "'.$postData['mobile_code'].'",
        "email": "'.$postData['user_email'].'"
        },
        "travellersData": ['.$passangers_details.'],
        "itinKey": "'.$priceFinalData['itinKey'].'",
        "block": "true",
        "productType": "FLIGHT",
        "payment": {
        "amountToCharge": '.$priceFinalData['fare']['totalFare']['total']['amount'].',
        "itinKey": "'.$priceFinalData['itinKey'].'",
        "productType": "FLIGHT",
        "paymentSubType": "3",
        "paymentMode": "DEPOSIT",
        "paymentDetail": {},
        "voucher": {},
        "depositAmount": 0,
        "voucherAmt": 0,
        "totalMarkup": 0
        }
        }';

       
        $requestId = '';
        $status = '';
        $pnr = '';
        $bookingId = '';
        $BookingStatus = '';
      
        $curlConnection = curl_init();
        curl_setopt($curlConnection, CURLOPT_HTTPHEADER, array( "Content-Encoding: UTF-8","Content-Type: application/json","Via-Access-Token: ".$this->access_Token));
       curl_setopt($curlConnection, CURLOPT_URL, $this->new_url.'book');
        curl_setopt($curlConnection, CURLOPT_POST, TRUE);
       curl_setopt($curlConnection, CURLOPT_POSTFIELDS, $BookpostData_);
        curl_setopt($curlConnection, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($curlConnection, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlConnection, CURLOPT_SSL_VERIFYPEER, FALSE);
        $results = curl_exec($curlConnection);
         $res = json_decode($results, true);  


           $reqfile = fopen($_SERVER['DOCUMENT_ROOT'].'/agent/Viaapi/xml_logs/BookReq.json', "w") or die("Unable to open file!");
$rspfile = fopen($_SERVER['DOCUMENT_ROOT'].'/agent/Viaapi/xml_logs/BookRsp.json', "w") or die("Unable to open file!");
fwrite($reqfile, $BookpostData_);
fwrite($rspfile, $results);
fclose($reqfile);fclose($rspfile);

         if(isset($res['reference']) && isset($res['url'])){
            $bookingArr=array('reference'=>$res['reference'],
                'redirectionValue'=>$res['redirectionValue'],
                'url'=>$res['url'],
                'currencyCode'=>$res['webDta']['envDta']['currencyCode'],
                 'msg'=>(isset($res['msg'])?$res['msg']:'')
                );
        $bookingId = $res['reference'];
       $totalFare =$priceFinalData['fare']['totalFare']['total']['amount'];
        $Retrives=$this->bookingRetrive($bookingId);
         $BookingStatus = $Retrives['status'];
         if(isset($Retrives['travellerDataList'])){
            $travellerDataList=reset($Retrives['travellerDataList']);
         $segmentBookingDetails=reset($travellerDataList['segmentBookingDetails']);
          $pnr = isset($segmentBookingDetails['pnr'])?$segmentBookingDetails['pnr']:'-'; 
         }
        
          #echo "<pre>";print_r($Retrives);die;
         }else{
        $bookingId = $res['reference'];
        $BookingStatus = 'FAILED';
        $totalFare =$priceFinalData['fare']['totalFare']['total']['amount'];
         }
         
        $path = $_SERVER['DOCUMENT_ROOT'] . '/agent/Viaapi/assets/xml_logs/' . $masterId . '_' . date('Y-m-d H:i:s') . '_booking_prepare.txt';
        $logFile = fopen($path, "w");
        fwrite($logFile, $res);
        fclose($logFile);
       $this->db->query($sql = "update flight_booking_beta set pnr = '" . $pnr . "', booking_ref='" . $bookingId . "', booking_status='" . $BookingStatus . "' ,TotalFare_org='".$totalFare."' where id='" . $masterId . "'");
            return array('status'=>$BookingStatus,'fare'=>$totalFare);
        
    }

     function bookingRetrive($ref){

       
        $curlConnection = curl_init();
        curl_setopt($curlConnection, CURLOPT_HTTPHEADER, array( "Content-Encoding: UTF-8","Content-Type: application/json","Via-Access-Token: ".$this->access_Token));
        curl_setopt($curlConnection, CURLOPT_URL, str_replace('flight', 'booking', $this->new_url)."retrieve/".$ref);
        curl_setopt($curlConnection, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($curlConnection, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlConnection, CURLOPT_SSL_VERIFYPEER, FALSE);
        $results = curl_exec($curlConnection);
         $res = json_decode($results, true); # echo "<pre>";print_r($res);die;

         
$rspfile = fopen($_SERVER['DOCUMENT_ROOT'].'/agent/Viaapi/xml_logs/RetrieveRsp.json', "w") or die("Unable to open file!");
fwrite($rspfile, $results);
fclose($rspfile);

        $retrieveData=array('refId' => $res['refId'],
        'orderId' => $res['orderId'],
        'status' => $res['status'],
        'bookDate' => $res['bookDate'],
        'cancellationData' =>(isset($res['cancellations']['cancellationData'])?$res['cancellations']['cancellationData']:''),
         'travellerDataList' =>(isset($res['items']['travellerDataList'])?$res['items']['travellerDataList']:'')
        );
        return $retrieveData;
        
     }

    function bookingRound($onwardDetails, $returnDetails, $postData, $requestData, $priceFinalData, $requestId, $masterId) {
        die;
        $pax = '';
        $onward = '';
        $return = '';
        $i = 0;
        $totalFare = 0;
        foreach ($priceFinalData['Inbound']['legs'] as $leg) {
            $onward .= '<Flight>
                          <CarrierId>' . $leg['Carrier_code'] . '</CarrierId>
                          <FlightNumber>' . $leg['FlightNumber'] . '</FlightNumber>
                          <Source>' . $leg['Source'] . '</Source>
                          <Destination>' . $leg['Destination'] . '</Destination>
                          <DepartureTimeStamp>' . $leg['DepartureTimeStamp'] . '</DepartureTimeStamp>
                          <ArrivalTimeStamp>' . $leg['ArrivalTimeStamp'] . '</ArrivalTimeStamp>
                          <Class>' . $leg['Class'] . '</Class>
                          <FareBasis>' . $onwardDetails['legs'][$i]['FareBasis'] . '</FareBasis>
                        </Flight>';
            $i++;
        }

        $i = 0;
        foreach ($priceFinalData['Outbound']['legs'] as $leg) {
            $return .= '<Flight>
                          <CarrierId>' . $leg['Carrier_code'] . '</CarrierId>
                          <FlightNumber>' . $leg['FlightNumber'] . '</FlightNumber>
                          <Source>' . $leg['Source'] . '</Source>
                          <Destination>' . $leg['Destination'] . '</Destination>
                          <DepartureTimeStamp>' . $leg['DepartureTimeStamp'] . '</DepartureTimeStamp>
                          <ArrivalTimeStamp>' . $leg['ArrivalTimeStamp'] . '</ArrivalTimeStamp>
                          <Class>' . $leg['Class'] . '</Class>
                          <FareBasis>' . $returnDetails['legs'][$i]['FareBasis'] . '</FareBasis>
                        </Flight>';
            $i++;
        }

        for ($i = 0; $i < count($postData['adulttitle']); $i++) {
            $pax .= '<Passenger>
                        <Type>A</Type>
                        <Title>' . $postData['adulttitle'][$i] . '</Title>
                        <FirstName>' . $postData['adultFname'][$i] . '</FirstName>
                        <LastName>' . $postData['adultLname'][$i] . '</LastName>
                        <DOB>18/02/1986</DOB>';
            if (isset($postData['adultBaggageOnward']) && $postData['adultBaggageOnward'][$i] != '') {
                $pax .= '<OnwardBagageOption>' . $postData['adultBaggageOnward'][$i] . '</OnwardBagageOption>';
            }
            if (isset($postData['adultBaggageReturn']) && $postData['adultBaggageReturn'][$i] != '') {
                $pax .= '<ReturnBagageOption>' . $postData['adultBaggageReturn'][$i] . '</ReturnBagageOption>';
            }
            $pax .= '</Passenger>';
        }



        if ($requestData['child'] > 0) {
            for ($i = 0; $i < count($postData['childtitle']); $i++) {
                $pax .= '<Passenger>
                        <Type>C</Type>
                        <Title>' . $postData['childtitle'][$i] . '</Title>
                        <FirstName>' . $postData['childFname'][$i] . '</FirstName>
                        <LastName>' . $postData['childLname'][$i] . '</LastName>
                        <DOB>' . $postData['child_dob'][$i] . '</DOB>';
                if (isset($postData['childBaggageOnward']) && $postData['childBaggageOnward'][$i] != '') {
                    $pax .= '<OnwardBagageOption>' . $postData['childBaggageOnward'][$i] . '</OnwardBagageOption>';
                }
                if (isset($postData['childBaggageReturn']) && $postData['childBaggageReturn'][$i] != '') {
                    $pax .= '<ReturnBagageOption>' . $postData['childBaggageReturn'][$i] . '</ReturnBagageOption>';
                }
                $pax .= '</Passenger>';
            }
        }


        if ($requestData['infant'] > 0) {
            for ($i = 0; $i < count($postData['infanttitle']); $i++) {
                $pax .= '<Passenger>
                        <Type>I</Type>
                        <Title>' . $postData['infanttitle'][$i] . '</Title>
                        <FirstName>' . $postData['infantFname'][$i] . '</FirstName>
                        <LastName>' . $postData['infantLname'][$i] . '</LastName>
                        <DOB>' . $postData['infant_dob'][$i] . '</DOB>';
                if (isset($postData['infantBaggageOnward']) && $postData['infantBaggageOnward'][$i] != '') {
                    $pax .= '<OnwardBagageOption>' . $postData['infantBaggageOnward'][$i] . '</OnwardBagageOption>';
                }
                if (isset($postData['infantBaggageReturn']) && $postData['infantBaggageReturn'][$i] != '') {
                    $pax .= '<ReturnBagageOption>' . $postData['infantBaggageReturn'][$i] . '</ReturnBagageOption>';
                }
                $pax .= '</Passenger>';
            }
        }

        $request_id = 'RDT' . date('YmdHis');
        $xml = '<AirBookingRequest>
                <RequestId>' . $requestId . '</RequestId>
                <Mobile>' . $postData['mobile_code'] . '-' . $postData['phone_number'] . '</Mobile>
                <Email>' . $postData['user_email'] . '</Email>
                <BookingRequestId>RDT' . date('YmdHis') . '</BookingRequestId>
                 <Itinerary>
                    <OnwardFlights>
                    ' . $onward . '
                    </OnwardFlights>
                    <ReturnFlights>
                    ' . $return . '
                    </ReturnFlights>
                 </Itinerary>
                 <Passengers>
                    ' . $pax . '
                </Passengers>
                <DeliveryInformation>
                  <Street></Street>
                  <City></City>
                  <Zipcode></Zipcode>
                  <Phone>' . $postData['mobile_code'] . '-' . $postData['phone_number'] . '</Phone>
                </DeliveryInformation>
                <PaymentInformation>
                  <PaymentType>2</PaymentType>
                </PaymentInformation>
              </AirBookingRequest>';
//echo $xml;die;
        $url = $this->url . 'AirBookingRequest';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "xmlRequest=" . $xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;//die;
        $res = new DOMDocument();
        $res->loadXML($response);
        $path = $_SERVER['DOCUMENT_ROOT'] . '/assets/xml_logs/' . $masterId . '_' . date('Y-m-d H:i:s') . '_booking_prepare.txt';
        $logFile = fopen($path, "w");
        fwrite($logFile, $response);
        fclose($logFile);
        $requestId = '';
        $status = '';
        $pnr = '';
        $bookingId = '';
        $BookingStatus = '';
        if($res->getElementsByTagName('Error')->length > 0 ){
            $BookingStatus = 'Failed';
            $this->db->query($sql = "update flight_booking set pnr = '', booking_ref='', booking_status='" . $BookingStatus . "' where id='" . $masterId . "'");
        } else {
            if ($res->getElementsByTagName('AirBookingResponse')->length > 0) {
                if ($res->getElementsByTagName('RequestId')->length > 0) {
                    $requestId = $res->getElementsByTagName('RequestId')->item(0)->nodeValue;
                }

                if ($res->getElementsByTagName('Status')->length > 0) {
                    $status = $res->getElementsByTagName('Status')->item(0)->nodeValue;
                }

                if ($status == 'Passed') {
                    if ($res->getElementsByTagName('BookingId')->length) {
                        $bookingId = $res->getElementsByTagName('BookingId')->item(0)->nodeValue;
                    }
                    $BookingStatus = 'Passed';
                } else {
                    $BookingStatus = 'Failed';
                }
            }

            if ($bookingId != '' && $BookingStatus == 'Passed') {
                $xmlFinal = '<AirBookingStatusRequest>
                            <RequestID>' . $requestId . '</RequestID>
                            <BookingID>' . $bookingId . '</BookingID>
                          </AirBookingStatusRequest>';
                $url = $this->url . 'AirBookingStatusRequest';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "xmlRequest=" . $xmlFinal);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
                $responseFinal = curl_exec($ch);
                curl_close($ch);
                //echo $responseFinal;die;
                $path = $_SERVER['DOCUMENT_ROOT'] . '/assets/xml_logs/' . $masterId . '_' . date('Y-m-d H:i:s') . '_booking_final.txt';
                $logFile = fopen($path, "w");
                fwrite($logFile, $responseFinal);
                fclose($logFile);
                $resFinal = new DOMDocument();
                $resFinal->loadXML($responseFinal);
                if($res->getElementsByTagName('Error')->length > 0 ){
                    $BookingStatus = 'Failed';
                    $this->db->query($sql = "update flight_booking set pnr = '" . $pnr . "', booking_ref='" . $bookingId . "', booking_status='" . $BookingStatus . "' where id='" . $masterId . "'");
                } else {
                    if ($resFinal->getElementsByTagName('Bookings')->length > 0) {
                        $status = $resFinal->getElementsByTagName('Status')->item(0)->nodeValue;
                        $Flights = $resFinal->getElementsByTagName('Flight');
                        foreach ($Flights as $flight) {
                            $pnr .= $flight->getElementsByTagName('AirlinePNR')->item(0)->nodeValue . '<br>';
                        }
                        $totalFare = $resFinal->getElementsByTagName('Pricing')->item(0)->getElementsByTagName('TotalFare')->item(0)->nodeValue;
                        if($status == 'Aborted'){
                            $BookingStatus = 'Failed';
                            $this->db->query($sql = "update flight_booking set pnr = '" . $pnr . "', booking_ref='" . $bookingId . "', booking_status='" . $BookingStatus . "' where id='" . $masterId . "'");
                        } else {
                            $BookingStatus = $status;
                            $this->db->query($sql = "update flight_booking set pnr = '" . $pnr . "', booking_ref='" . $bookingId . "', booking_status='" . $BookingStatus . "' ,TotalFare_org='".$totalFare."' where id='" . $masterId . "'");
                        }
                    } else {
                        $BookingStatus = 'Failed';
                        $this->db->query($sql = "update flight_booking set pnr = '" . $pnr . "', booking_ref='" . $bookingId . "', booking_status='" . $BookingStatus . "' where id='" . $masterId . "'");
                    }
                }
            } else {
                $this->db->query($sql = "update flight_booking set pnr = '', booking_ref='', booking_status='" . $BookingStatus . "' where id='" . $masterId . "'");
            }

            
            return array('status'=>$BookingStatus,'fare'=>$totalFare);
        }
    }

    function getCurl($url) {
        //echo $url;die;
        $header[] = "Accept: application/xml";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        //echo curl_error($ch);die;
        return $response;
    }

}
