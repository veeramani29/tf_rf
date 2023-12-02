<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set("memory_limit",-1);
/*
|--------------------------------------------------------------------------|
| Author: Provab Technosoft Pvt Ltd.									   |
|--------------------------------------------------------------------------|
| Developer: Provab											   |
| Started Date: 2014-10-15T16:15:00										   |
| Ended Date:  										   					   |
|--------------------------------------------------------------------------|
*/


function prettyPrint($result,$file){
	$dom = new DOMDocument("1.0");
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$dom->loadXML(simplexml_load_string($result)->asXML());
	outputWriter($file,$dom->saveXML());
	return $dom->saveXML();
}
 function outputWriter($file,$content){
	file_put_contents($file, $content);
} 


function FlexSearchReq($request){
	
$circle_flex='';
$oneway_flex='';
	if($request->type != 'M'){
    
       
        $DepPreferredTime = date("Y-m-d",strtotime($request->depart_date)).'T00:00:00';
      
                    
                     $oneway_flex =  '<SearchAirLeg>
                        <SearchOrigin>
                            <CityOrAirport Code="'.$request->origin.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
                        </SearchOrigin>
                        <SearchDestination>
                            <CityOrAirport Code="'.$request->destination.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
                        </SearchDestination>
                        <SearchDepTime PreferredTime="'.$DepPreferredTime.'" >
                         <SearchExtraDays xmlns="http://www.travelport.com/schema/common_v28_0" DaysAfter="3" DaysBefore="3" />
                        </SearchDepTime>
                        <AirLegModifiers>
                            <PreferredCabins>
                                <CabinClass Type="'.$request->class.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CabinClass>
                            </PreferredCabins>
                        </AirLegModifiers>
                    </SearchAirLeg>';
     
			  if($request->type == 'R'){     
        $DepPreferredTime = date("Y-m-d",strtotime($request->depart_date)).'T00:00:00';  
        $ArrivPreferredTime = date("Y-m-d",strtotime($request->return_date)).'T00:00:00';             
            
                    
                   $circle_flex = '<SearchAirLeg>
                        <SearchOrigin>
                            <CityOrAirport Code="'.$request->destination.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
                        </SearchOrigin>
                        <SearchDestination>
                            <CityOrAirport Code="'.$request->origin.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
                        </SearchDestination>
                        <SearchDepTime PreferredTime="'.$ArrivPreferredTime.'" >
                        <SearchExtraDays xmlns="http://www.travelport.com/schema/common_v28_0" DaysAfter="3" DaysBefore="3" />
                        </SearchDepTime>
                    </SearchAirLeg>';
        }
        
        $adult_patch = $child_patch = $infant_patch = '';

    for($i=1;$i<=$request->ADT;$i++){
        $adult_patch .= '<SearchPassenger Code="ADT" xmlns="http://www.travelport.com/schema/common_v28_0" ></SearchPassenger>';
    }

    for($i=1;$i<=$request->CHD;$i++){
        $child_patch .= '<SearchPassenger Code="CNN" Age="10" xmlns="http://www.travelport.com/schema/common_v28_0" ></SearchPassenger>';
    }

    for($i=1;$i<=$request->INF;$i++){
        $infant_patch .= '<SearchPassenger Code="INF" Age="1" xmlns="http://www.travelport.com/schema/common_v28_0" ></SearchPassenger>';
    }
    $provider='';
  /* $provider='<AirSearchModifiers>
                    <PreferredProviders>
                        <Provider Code="1G" xmlns="http://www.travelport.com/schema/common_v28_0" ></Provider>
                    </PreferredProviders>
                </AirSearchModifiers>';*/
    
    $LowFareSearchReq_forflex = '<?xml version="1.0" encoding="utf-8"?>
    <s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">
        <s:Header>
            <Action s:mustUnderstand="1" xmlns="http://schemas.microsoft.com/ws/2005/05/addressing/none">http://localhost:8080/kestrel/AirService</Action>
        </s:Header>
        <s:Body xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
            <LowFareSearchReq TargetBranch="P7028803" xmlns="http://www.travelport.com/schema/air_v28_0">
                <BillingPointOfSaleInfo OriginApplication="UAPI" xmlns="http://www.travelport.com/schema/common_v28_0" ></BillingPointOfSaleInfo>
                    '.$oneway_flex.'
                    '.$circle_flex.'
					'.$provider.'
                    '.$adult_patch.'
                    '.$child_patch.'
                    '.$infant_patch.'
            </LowFareSearchReq>
        </s:Body>
    </s:Envelope>';
    
    if($request->type == 'O'){
   
     $LowFareSearchRes_forflex = processRequest($LowFareSearchReq_forflex);
   //$file1 = "001-1G_TravelAvailabilityRsp.xml";
	//prettyPrint($LowFareSearchRes_forflex,$file1);
	$file = "001-1G_FlexRsp.xml";
	prettyPrint($LowFareSearchRes_forflex,$file);
	
}else{
	
    $LowFareSearchRes_forflex = processRequest($LowFareSearchReq_forflex);
    // echo $LowFareSearchRes_forflex;exit;
    //$file1 = "001-1G_TravelAvailabilityRsp.xml";
	//prettyPrint($LowFareSearchRes_forflex,$file1);
	$file = "001-1G_FlexRoundRsp.xml";
	prettyPrint($LowFareSearchRes_forflex,$file);
	
	

}

 $SearchRes_forflex = array(
        'LowFareSearchReq' => $LowFareSearchReq_forflex,
        'LowFareSearchRes' => $LowFareSearchRes_forflex
    );
   
  // echo $LowFareSearchRes_forflex;
    return $SearchRes_forflex;
    

    }

}

function LowFareSearchReq($request){
    //echo '<pre>';print_r($request);die;
		$oneway = '';
        $circle = '';
        $multicity = '';
        $circle_flex='';
        $oneway_flex='';
    if($request->type == 'M'){
       
        foreach ($request->origin as $key => $value) {
            $origin = $value;
            $destination = $request->destination[$key];
            $DepPreferredTime = date("Y-m-d",strtotime($request->depart_date[$key])).'T00:00:00';
            $multicity .= '<SearchAirLeg>
                            <SearchOrigin>
                                <CityOrAirport Code="'.$origin.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
                            </SearchOrigin>
                            <SearchDestination>
                                <CityOrAirport Code="'.$destination.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
                            </SearchDestination>
                            <SearchDepTime PreferredTime="'.$DepPreferredTime.'" ></SearchDepTime>
                            <AirLegModifiers>
                                <PreferredCabins>
                                    <CabinClass Type="'.$request->class.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CabinClass>
                                </PreferredCabins>
                            </AirLegModifiers>
                        </SearchAirLeg>';
        }      
                      
    }else{
		
		
       
        $DepPreferredTime = date("Y-m-d",strtotime($request->depart_date)).'T00:00:00';
        $oneway =  '<SearchAirLeg>
                        <SearchOrigin>
                            <CityOrAirport Code="'.$request->origin.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
                        </SearchOrigin>
                        <SearchDestination>
                            <CityOrAirport Code="'.$request->destination.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
                        </SearchDestination>
                       <SearchDepTime PreferredTime="'.$DepPreferredTime.'" ></SearchDepTime>
                        <AirLegModifiers>
                            <PreferredCabins>
                                <CabinClass Type="'.$request->class.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CabinClass>
                            </PreferredCabins>
                        </AirLegModifiers>
                    </SearchAirLeg>';
                    
                  
     
			  if($request->type == 'R'){     
        $DepPreferredTime = date("Y-m-d",strtotime($request->depart_date)).'T00:00:00';  
        $ArrivPreferredTime = date("Y-m-d",strtotime($request->return_date)).'T00:00:00';             
            $circle = '<SearchAirLeg>
                        <SearchOrigin>
                            <CityOrAirport Code="'.$request->destination.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
                        </SearchOrigin>
                        <SearchDestination>
                            <CityOrAirport Code="'.$request->origin.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
                        </SearchDestination>
                        <SearchDepTime PreferredTime="'.$ArrivPreferredTime.'" ></SearchDepTime>
                        <AirLegModifiers>
                            <PreferredCabins>
                                <CabinClass Type="'.$request->class.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CabinClass>
                            </PreferredCabins>
                        </AirLegModifiers>
                    </SearchAirLeg>';
                    
                  
        }
    }

    $adult_patch = $child_patch = $infant_patch = '';

    for($i=1;$i<=$request->ADT;$i++){
        $adult_patch .= '<SearchPassenger Code="ADT" xmlns="http://www.travelport.com/schema/common_v28_0" ></SearchPassenger>';
    }

    for($i=1;$i<=$request->CHD;$i++){
        $child_patch .= '<SearchPassenger Code="CNN" Age="10" xmlns="http://www.travelport.com/schema/common_v28_0" ></SearchPassenger>';
    }

    for($i=1;$i<=$request->INF;$i++){
        $infant_patch .= '<SearchPassenger Code="INF" Age="1" xmlns="http://www.travelport.com/schema/common_v28_0" ></SearchPassenger>';
    }
    
  /* $provider='<AirSearchModifiers>
                    <PreferredProviders>
                        <Provider Code="1G" xmlns="http://www.travelport.com/schema/common_v28_0" ></Provider>
                    </PreferredProviders>
                </AirSearchModifiers>';*/
$provider='';
    $LowFareSearchReq = '<?xml version="1.0" encoding="utf-8"?>
    <s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">
        <s:Header>
            <Action s:mustUnderstand="1" xmlns="http://schemas.microsoft.com/ws/2005/05/addressing/none">http://localhost:8080/kestrel/AirService</Action>
        </s:Header>
        <s:Body xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
            <LowFareSearchReq TargetBranch="P7028803" xmlns="http://www.travelport.com/schema/air_v28_0">
                <BillingPointOfSaleInfo OriginApplication="UAPI" xmlns="http://www.travelport.com/schema/common_v28_0" ></BillingPointOfSaleInfo>
                    '.$oneway.'
                    '.$circle.'
                    '.$multicity.'
					'.$provider.'
                    '.$adult_patch.'
                    '.$child_patch.'
                    '.$infant_patch.'
            </LowFareSearchReq>
        </s:Body>
    </s:Envelope>';
  
   
     // echo $LowFareSearchReq;exit;
     $LowFareSearchRes = processRequest($LowFareSearchReq);
	$file = "001-1G_TravelAvailabilityRsp.xml";
	prettyPrint($LowFareSearchRes,$file);
	
 
    
      
     
   // echo $LowFareSearchRes;exit;
    $LowFareSearchReq_Res = array(
        'LowFareSearchReq' => $LowFareSearchReq,
        'LowFareSearchRes' => $LowFareSearchRes
    );
   // echo $LowFareSearchRes;die;
    return $LowFareSearchReq_Res;
}

function AirPriceReq($flight, $request){
    //echo '<pre>';print_r($flight);die;
    $segments = '';
    
    //echo '<pre>';print_r($flight->segments);die;
    if($request->type == 'O' || $request->type == 'M'){
        foreach ($flight->segments as $key => $segment) {
            //echo '<pre>';print_r($segment);die;
            if($segment->OperatingFlightNumber != ''){
                $CodeshareInfo = '<CodeshareInfo OperatingCarrier="'.$segment->OperatingCarrier.'" OperatingFlightNumber="'.$segment->OperatingFlightNumber.'" ></CodeshareInfo>';
            }else{
                $CodeshareInfo = '<CodeshareInfo>'.$segment->OperatingCarrier.'</CodeshareInfo>';
            }
            $OriginTerminal = '';
    		
            if($segment->OriginTerminal != ''){
                $OriginTerminal = 'OriginTerminal="'.$segment->OriginTerminal.'"';
            }
            
            $DestinationTerminal = '';
            if($segment->DestinationTerminal != ''){
                $DestinationTerminal = 'DestinationTerminal="'.$segment->DestinationTerminal.'"';
            }
					$Equipment=(isset($segment->Equipment))?$segment->Equipment:"";
					$ETicketability=(isset($segment->ETicketability))?$segment->ETicketability:"";
					$AvailabilitySource=(isset($segment->AvailabilitySource))?$segment->AvailabilitySource:"";
					$PolledAvailabilityOption=(isset($segment->PolledAvailabilityOption))?$segment->PolledAvailabilityOption:"";
					$ParticipantLevel=(isset($segment->ParticipantLevel))?$segment->ParticipantLevel:"";
					$LinkAvailability=(isset($segment->LinkAvailability))?$segment->LinkAvailability:"";
					$Distance=(isset($segment->Distance))?$segment->Distance:"";
                   
            $segments .= '<AirSegment Key="'.$segment->AirSegment_Key.'" ClassOfService="'.$segment->BookingCode.'" ETicketability="'.$ETicketability.'" Equipment="'.$Equipment.'" ChangeOfPlane="'.$segment->ChangeOfPlane.'" AvailabilitySource="'.$AvailabilitySource.'" OptionalServicesIndicator="'.$segment->OptionalServicesIndicator.'" PolledAvailabilityOption="'.$PolledAvailabilityOption.'" Origin="'.$segment->Origin.'" Destination="'.$segment->Destination.'" DepartureTime="'.$segment->DepartureTime.'" FlightNumber="'.$segment->FlightNumber.'" Group="'.$segment->Group.'" Carrier="'.$segment->Carrier.'" ArrivalTime="'.$segment->ArrivalTime.'" ParticipantLevel="'.$ParticipantLevel.'" LinkAvailability="'.$LinkAvailability.'" ProviderCode="'.$segment->ProviderCode.'" FlightTime="'.$segment->FlightTime.'" Distance="'.$Distance.'">
                            '.$CodeshareInfo.'
                            <AirAvailInfo ProviderCode="'.$segment->ProviderCode.'">
                                <BookingCodeInfo BookingCounts="'.$segment->BookingCounts.'"></BookingCodeInfo>
                            </AirAvailInfo>
                            <FlightDetails Equipment="'.$Equipment.'"  '.$OriginTerminal.' '.$DestinationTerminal.' Destination="'.$segment->Destination.'" Origin="'.$segment->Origin.'" Key="'.$segment->FlightDetail_Key.'" FlightTime="'.$segment->FlightTime.'" ArrivalTime="'.$segment->ArrivalTime.'" DepartureTime="'.$segment->DepartureTime.'" ></FlightDetails>
                          </AirSegment>';
        }
    }else if ($request->type == 'R') {
        foreach ($flight->onward->segments as $key => $segment) {
            //echo '<pre>';print_r($segment);die;
            if($segment->OperatingFlightNumber != ''){
                $CodeshareInfo = '<CodeshareInfo OperatingCarrier="'.$segment->OperatingCarrier.'" OperatingFlightNumber="'.$segment->OperatingFlightNumber.'" ></CodeshareInfo>';
            }else{
                $CodeshareInfo = '<CodeshareInfo>'.$segment->OperatingCarrier.'</CodeshareInfo>';
            }
            $OriginTerminal = '';
            
            if($segment->OriginTerminal != ''){
                $OriginTerminal = 'OriginTerminal="'.$segment->OriginTerminal.'"';
            }
            
            $DestinationTerminal = '';
            if($segment->DestinationTerminal != ''){
                $DestinationTerminal = 'DestinationTerminal="'.$segment->DestinationTerminal.'"';
            }
           $Equipment=(isset($segment->Equipment))?$segment->Equipment:"";
              $ETicketability=(isset($segment->ETicketability))?$segment->ETicketability:"";
               $AvailabilitySource=(isset($segment->AvailabilitySource))?$segment->AvailabilitySource:"";
                $PolledAvailabilityOption=(isset($segment->PolledAvailabilityOption))?$segment->PolledAvailabilityOption:"";
                 $ParticipantLevel=(isset($segment->ParticipantLevel))?$segment->ParticipantLevel:"";
                  $LinkAvailability=(isset($segment->LinkAvailability))?$segment->LinkAvailability:"";
                   $Distance=(isset($segment->Distance))?$segment->Distance:"";
            $segments .= '<AirSegment Key="'.$segment->AirSegment_Key.'" ClassOfService="'.$segment->BookingCode.'" ETicketability="'.$ETicketability.'" Equipment="'.$Equipment.'" ChangeOfPlane="'.$segment->ChangeOfPlane.'" AvailabilitySource="'.$AvailabilitySource.'" OptionalServicesIndicator="'.$segment->OptionalServicesIndicator.'" PolledAvailabilityOption="'.$PolledAvailabilityOption.'" Origin="'.$segment->Origin.'" Destination="'.$segment->Destination.'" DepartureTime="'.$segment->DepartureTime.'" FlightNumber="'.$segment->FlightNumber.'" Group="'.$segment->Group.'" Carrier="'.$segment->Carrier.'" ArrivalTime="'.$segment->ArrivalTime.'" ParticipantLevel="'.$ParticipantLevel.'" LinkAvailability="'.$LinkAvailability.'" ProviderCode="'.$segment->ProviderCode.'" FlightTime="'.$segment->FlightTime.'" Distance="'.$Distance.'">
                            '.$CodeshareInfo.'
                            <AirAvailInfo ProviderCode="'.$segment->ProviderCode.'">
                                <BookingCodeInfo BookingCounts="'.$segment->BookingCounts.'"></BookingCodeInfo>
                            </AirAvailInfo>
                            <FlightDetails Equipment="'.$Equipment.'"  '.$OriginTerminal.' '.$DestinationTerminal.' Destination="'.$segment->Destination.'" Origin="'.$segment->Origin.'" Key="'.$segment->FlightDetail_Key.'" FlightTime="'.$segment->FlightTime.'" ArrivalTime="'.$segment->ArrivalTime.'" DepartureTime="'.$segment->DepartureTime.'" ></FlightDetails>
                          </AirSegment>';
        }
        foreach ($flight->return->segments as $key => $segment) {
            //echo '<pre>';print_r($segment);die;
            if($segment->OperatingFlightNumber != ''){
                $CodeshareInfo = '<CodeshareInfo OperatingCarrier="'.$segment->OperatingCarrier.'" OperatingFlightNumber="'.$segment->OperatingFlightNumber.'" ></CodeshareInfo>';
            }else{
                $CodeshareInfo = '<CodeshareInfo>'.$segment->OperatingCarrier.'</CodeshareInfo>';
            }
            $OriginTerminal = '';
            
            if($segment->OriginTerminal != ''){
                $OriginTerminal = 'OriginTerminal="'.$segment->OriginTerminal.'"';
            }
            
            $DestinationTerminal = '';
            if($segment->DestinationTerminal != ''){
                $DestinationTerminal = 'DestinationTerminal="'.$segment->DestinationTerminal.'"';
            }
            
            $Equipment=(isset($segment->Equipment))?$segment->Equipment:"";
              $ETicketability=(isset($segment->ETicketability))?$segment->ETicketability:"";
               $AvailabilitySource=(isset($segment->AvailabilitySource))?$segment->AvailabilitySource:"";
                $PolledAvailabilityOption=(isset($segment->PolledAvailabilityOption))?$segment->PolledAvailabilityOption:"";
                 $ParticipantLevel=(isset($segment->ParticipantLevel))?$segment->ParticipantLevel:"";
                  $LinkAvailability=(isset($segment->LinkAvailability))?$segment->LinkAvailability:"";
                   $Distance=(isset($segment->Distance))?$segment->Distance:"";
                   
            $segments .= '<AirSegment Key="'.$segment->AirSegment_Key.'" ClassOfService="'.$segment->BookingCode.'" ETicketability="'.$ETicketability.'" Equipment="'.$Equipment.'" ChangeOfPlane="'.$segment->ChangeOfPlane.'" AvailabilitySource="'.$AvailabilitySource.'" OptionalServicesIndicator="'.$segment->OptionalServicesIndicator.'" PolledAvailabilityOption="'.$PolledAvailabilityOption.'" Origin="'.$segment->Origin.'" Destination="'.$segment->Destination.'" DepartureTime="'.$segment->DepartureTime.'" FlightNumber="'.$segment->FlightNumber.'" Group="'.$segment->Group.'" Carrier="'.$segment->Carrier.'" ArrivalTime="'.$segment->ArrivalTime.'" ParticipantLevel="'.$ParticipantLevel.'" LinkAvailability="'.$LinkAvailability.'" ProviderCode="'.$segment->ProviderCode.'" FlightTime="'.$segment->FlightTime.'" Distance="'.$Distance.'">
                            '.$CodeshareInfo.'
                            <AirAvailInfo ProviderCode="'.$segment->ProviderCode.'">
                                <BookingCodeInfo BookingCounts="'.$segment->BookingCounts.'"></BookingCodeInfo>
                            </AirAvailInfo>
                            <FlightDetails Equipment="'.$Equipment.'"  '.$OriginTerminal.' '.$DestinationTerminal.' Destination="'.$segment->Destination.'" Origin="'.$segment->Origin.'" Key="'.$segment->FlightDetail_Key.'" FlightTime="'.$segment->FlightTime.'" ArrivalTime="'.$segment->ArrivalTime.'" DepartureTime="'.$segment->DepartureTime.'" ></FlightDetails>
                          </AirSegment>';
        }
    }
    $paxId=0;
    $adults = '';
    if($request->ADT != 0){
        for ($i=0; $i < $request->ADT; $i++) { 
            $adults .= '<SearchPassenger BookingTravelerRef="'.$paxId.'" Code="ADT" xmlns="http://www.travelport.com/schema/common_v28_0" ></SearchPassenger>';
            $paxId++;
        }
    }
    $childs = '';
    if($request->CHD != 0){
        for ($i=0; $i < $request->CHD; $i++) { 
            $childs .= '<SearchPassenger BookingTravelerRef="'.$paxId.'" Code="CNN" Age="10" xmlns="http://www.travelport.com/schema/common_v28_0" ></SearchPassenger>';
            $paxId++;
        }
    }
    $infants = '';
    if($request->INF != 0){
        for ($i=0; $i < $request->INF; $i++) { 
            $infants .= '<SearchPassenger BookingTravelerRef="'.$paxId.'" Code="INF" Age="1" xmlns="http://www.travelport.com/schema/common_v28_0" ></SearchPassenger>';
            $paxId++;
        }
    }
//	echo '<pre/>';
	//print_r($flight);	print_r($flight_segments);exit;
//flight->PlatingCarrier
//$flight_segments[0]->PlatingCarrier
    //echo 'naresh-'.$flight->PlatingCarrier;die;
    if($flight->PlatingCarrier != ''){
        $AirPricingModifiers = '<AirPricingModifiers PlatingCarrier="'.$flight->PlatingCarrier.'" ></AirPricingModifiers>';
    }else{
        $AirPricingModifiers = '';
    }
    

    $AirPriceReq = '<?xml version="1.0" encoding="utf-8"?>
    <s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">
        <s:Header>
            <Action s:mustUnderstand="1" xmlns="http://schemas.microsoft.com/ws/2005/05/addressing/none">http://localhost:8080/kestrel/AirService</Action>
        </s:Header>
        <s:Body xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
            <AirPriceReq TargetBranch="P7028803" xmlns="http://www.travelport.com/schema/air_v28_0">
                <BillingPointOfSaleInfo OriginApplication="UAPI" xmlns="http://www.travelport.com/schema/common_v28_0"></BillingPointOfSaleInfo>
                <AirItinerary>
                    '.$segments.'
                </AirItinerary>
                  '.$AirPricingModifiers.'
                  '.$adults.'
                  '.$childs.'
                  '.$infants.'
                <AirPricingCommand></AirPricingCommand>
            </AirPriceReq>
        </s:Body>
    </s:Envelope>';

    $AirPriceRes = processRequest($AirPriceReq);
    $AirPriceReq_Res = array(
        'AirPriceReq' => $AirPriceReq,
        'AirPriceRes' => $AirPriceRes
    );
    //echo $AirPriceReq;
    //echo $AirPriceRes;die;
    return $AirPriceReq_Res;
}

function AirCreateReservationReq($cart_flight_data, $checkout_form, $cid){
	$AirItinerary_xml = $cart_flight_data->AirItinerary_xml;
	$AirPricingSolution_xml = $cart_flight_data->AirPricingSolution_xml;
	$request = json_decode(base64_decode($cart_flight_data->request));
    //echo '<pre>';print_r($checkout_form);die;
	$AirItinerary_xml = str_replace('<AirItinerary>','',$AirItinerary_xml);
	$AirItinerary_xml = str_replace('</AirItinerary>','',$AirItinerary_xml);
	$AirPricingSolution_xml = str_replace('common_v28_0:','',$AirPricingSolution_xml);
	
	$doc = new DOMDocument();
	$doc->loadXML($AirPricingSolution_xml);
    // $ServiceData = $doc->getElementsByTagName("ServiceData");
    // if($ServiceData->length > 0){
    //     foreach ($ServiceData as $book) {
    //         $BookingTravelerRef = $ServiceData->item(0)->getAttribute('BookingTravelerRef');    
    //         break;
    //         //echo $book->nodeValue, PHP_EOL;
    //     }
    // }else{
    //     $BookingTravelerRef = '';
    // }
    $OptionalService = $doc->documentElement;

    $OptionalServices = $OptionalService->getElementsByTagName("OptionalServices")->item(0);
    $OptionalServices_ = $OptionalService->getElementsByTagName("OptionalServices");
    foreach($OptionalServices_ as $dddd){
        $OptionalService->removeChild($OptionalServices);
    }
    $AirPricingSolution_xml = $doc->saveXML();
    $doc->loadXML($AirPricingSolution_xml);

    $fragment = $doc->createDocumentFragment();
	$fragment->appendXML($AirItinerary_xml);              
	$AirPricingInfo  = $doc->getElementsByTagName("AirPricingInfo")->item(0);
	$doc->documentElement->insertBefore($fragment,$AirPricingInfo);                  
 
	// Removing Endorsement tag
	$xp = new DOMXPath($doc);
	foreach($xp->query('//Endorsement') as $key => $tn){
		$tn->parentNode->removeChild($tn);
	}
	
	// Adding BookingTravelerRef for Passengers
	$PassengerType = $xp->evaluate("/AirPricingSolution/AirPricingInfo//PassengerType");
	for ($i = 0; $i < $PassengerType->length; $i++) {
			$Passenger = $PassengerType->item($i);
            //if($BookingTravelerRef == ''){
                $Passenger->setAttribute("BookingTravelerRef", $i);
            //}else{
                $Passenger->setAttribute("BookingTravelerRef", $i);
            //}                                             
	}
	$AirPricingSolution_xml = str_replace('<?xml version="1.0"?>','',$doc->saveXML());
	
	//echo $AirPricingSolution_xml;die;
	
	//echo $checkout_form['street_address'];die;
	//echo '<pre>';print_r($request);die;
	if($checkout_form->address2 != ''){
		$address = $checkout_form->address2;
	}else{
		$address = $checkout_form->street_address;
	}
	$paxId=0;
    $adults = '';
    if($request->ADT != 0){
        for ($i=0; $i < $request->ADT; $i++) {
			$address = '';
			if($i==0){
				$address .= '<Address>
								<AddressName>'.$checkout_form->street_address.'</AddressName>
								<Street>'.$checkout_form->street_address.'</Street>
								<City>'.$checkout_form->city.'</City>
								<State>CO</State>
								<PostalCode>'.$checkout_form->zip.'</PostalCode>
								<Country>'.$checkout_form->country.'</Country>
							</Address>';
			} 
            $adults .= '<BookingTraveler Key="'.$paxId.'" TravelerType="ADT" xmlns="http://www.travelport.com/schema/common_v28_0">
							<BookingTravelerName Prefix="Mr." First="'.$checkout_form->first_name.$cid.'" Last="'.$checkout_form->last_name.$cid.'" ></BookingTravelerName>
							<PhoneNumber Number="'.$checkout_form->mobile.'" Type="Mobile" ></PhoneNumber>
							<Email EmailID="'.$checkout_form->email.'" Type="P" ></Email>   
							'.$address.'
						</BookingTraveler>';
            $paxId++;
        }
    }
	//echo $adults;die;
    $childs = '';
    if($request->CHD != 0){
        for ($i=0; $i < $request->CHD; $i++) { 
            $childs .= '<BookingTraveler Key="'.$paxId.'" TravelerType="CNN" Age="10" xmlns="http://www.travelport.com/schema/common_v28_0">
							<BookingTravelerName Prefix="Master." First="Hari" Last="Chandana" ></BookingTravelerName>
							<PhoneNumber Number="'.$checkout_form->mobile.'" Type="Mobile" ></PhoneNumber>
							<Email EmailID="'.$checkout_form->email.'" Type="P" ></Email>
							<NameRemark Category="AIR">
								<RemarkData>01JAN04</RemarkData>
							</NameRemark>   
						</BookingTraveler>';
            $paxId++;
        }
    }
    $infants = '';
    if($request->INF != 0){
        for ($i=0; $i < $request->INF; $i++) { 
            $infants .= '<BookingTraveler Key="'.$paxId.'" TravelerType="INF" Age="1" xmlns="http://www.travelport.com/schema/common_v28_0">
							<BookingTravelerName Prefix="Master." First="Hemnashu" Last="Barghav" ></BookingTravelerName>
							<PhoneNumber Number="'.$checkout_form->mobile.'" Type="Mobile" ></PhoneNumber>
							<Email EmailID="'.$checkout_form->email.'" Type="P" ></Email>
							<NameRemark Category="AIR">
								<RemarkData>12FEB13</RemarkData>
							</NameRemark>   
						</BookingTraveler>';
            $paxId++;
        }
    }
	$AirCreateReservationReq = '<?xml version="1.0" encoding="utf-8"?>
	<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">
                        <s:Header>
                            <Action s:mustUnderstand="1" xmlns="http://schemas.microsoft.com/ws/2005/05/addressing/none">http://localhost:8080/kestrel/AirService</Action>
                        </s:Header>
                        <s:Body xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
                            <ns5:AirCreateReservationReq xmlns:ns5="http://www.travelport.com/schema/universal_v28_0" TargetBranch="P7028803" xmlns="http://www.travelport.com/schema/air_v28_0" RetainReservation="Both">
                            <BillingPointOfSaleInfo OriginApplication="UAPI" xmlns="http://www.travelport.com/schema/common_v28_0" ></BillingPointOfSaleInfo>
                            '.$adults.'
                            '.$childs.'
                            '.$infants.'
                            '.$AirPricingSolution_xml.'
                            <ActionStatus ProviderCode="1G" TicketDate="T*" Type="ACTIVE" QueueCategory="01" xmlns="http://www.travelport.com/schema/common_v28_0" ></ActionStatus>
                            </ns5:AirCreateReservationReq>
                        </s:Body>
                        </s:Envelope>';
    //echo $AirCreateReservationReq;die;                      
	$AirCreateReservationRes = processRequest($AirCreateReservationReq);
    $AirCreateReservationReq_Res = array(
        'AirCreateReservationReq' => $AirCreateReservationReq,
        'AirCreateReservationRes' => $AirCreateReservationRes
    );
     //echo $AirCreateReservationReq;die; 
     //echo $AirCreateReservationRes;die; 
    return $AirCreateReservationReq_Res;
}

function CancelReq($LocatorCode){
    $CancelReq = '<?xml version="1.0" encoding="UTF-8"?>
                    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://www.travelport.com/schema/common_v28_0" xmlns:univ="http://www.travelport.com/schema/universal_v28_0">
                       <soapenv:Header />
                       <soapenv:Body>
                          <univ:UniversalRecordCancelReq AuthorizedBy="user" TargetBranch="P7028803" TraceId="trace" UniversalRecordLocatorCode="'.$LocatorCode.'" Version="1">
                             <com:BillingPointOfSaleInfo OriginApplication="UAPI" />
                          </univ:UniversalRecordCancelReq>
                       </soapenv:Body>
                    </soapenv:Envelope>';                
    $CancelRes = processCancelRequest($CancelReq);
    $CancelReq_Res = array(
        'CancelReq' => $CancelReq,
        'CancelRes' => $CancelRes
    );
    return $CancelReq_Res;     
}


function processCancelRequest($requestData){
    $CI =& get_instance();
    $CI->load->model('flight_model');
    $credentials = $CI->flight_model->get_pnr_api_credentials();
if(isset($credentials->username))
{
    $soapAction = '';
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
    //curl_setopt($ch, CURLOPT_SSLVERSION, 3);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);        
    curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
    curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");

    

    // Execute request, store response and HTTP response code
    $response = curl_exec($ch);
    $error = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    // header("Content-type: text/xml");
    // print_r($response);die;  
    //$response = new SimpleXMLElement($response);
    //$response = $response->children('http://schemas.xmlsoap.org/soap/envelope/')->Body->children("http://www.travelport.com/schema/air_v28_0");
	 
    return $response;
}
	else
{
		 $xml_log = array(
          'Api' => 'UAPI',
          'XML_Type' => 'PNR DEACTIVATED',
          'XML_Request' => $requestData,
          'XML_Response' => '',
          'Ip_address' => $_SERVER['REMOTE_ADDR'],
          'XML_Time' => date('Y-m-d H:i:s')
      );
      $CI->xml_model->insert_xml_log($xml_log);
return '';	
}
}

function processRequest($requestData){
    $CI =& get_instance();
    $CI->load->model('flight_model');
	 $CI->load->model('xml_model');
    $credentials = $CI->flight_model->get_api_credentials();
if(isset($credentials->username))
{
    $soapAction = '';
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
    //curl_setopt($ch, CURLOPT_SSLVERSION, 3);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);        
    curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
    curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");

    

    // Execute request, store response and HTTP response code
    $response = curl_exec($ch);
    $error = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    // header("Content-type: text/xml");
    // print_r($response);die;  
    //$response = new SimpleXMLElement($response);
    //$response = $response->children('http://schemas.xmlsoap.org/soap/envelope/')->Body->children("http://www.travelport.com/schema/air_v28_0");
	 $xml_log = array(
           'Api' => 'UAPI',
           'XML_Type' => 'FLIGHT SUPPORT',
           'XML_Request' => $requestData,
           'XML_Response' => $response,
           'Ip_address' => $_SERVER['REMOTE_ADDR'],
           'XML_Time' => date('Y-m-d H:i:s')
       );
      $CI->xml_model->insert_xml_log($xml_log);
    return $response;
}
else
{
		 $xml_log = array(
          'Api' => 'UAPI',
          'XML_Type' => 'FLIGHT - API DEACTIVATED',
          'XML_Request' => $requestData,
          'XML_Response' => '',
          'Ip_address' => $_SERVER['REMOTE_ADDR'],
          'XML_Time' => date('Y-m-d H:i:s')
      );
      $CI->xml_model->insert_xml_log($xml_log);
return '';	
}
}
