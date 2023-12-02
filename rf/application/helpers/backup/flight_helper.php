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




function ACHSearchReq($request){
  //echo '<pre>';print_r($request);die;
		$oneway = '';
        $circle = '';
        $multicity = '';
        $extra_days='';
        $normal_days='';
        $dep_date='';
        $arrival_date='';
         $provider='';
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
                        </SearchAirLeg>';
        }      
                      
    }else{
		
		
       
        $DepPreferredTime = date("Y-m-d",strtotime($request->depart_date)).'T00:00:00';
        if($request->days ==1){
			$extra_days='<SearchDepTime PreferredTime="'.$DepPreferredTime.'" >
                         <SearchExtraDays xmlns="http://www.travelport.com/schema/common_v28_0" DaysAfter="3" DaysBefore="3" />
                        </SearchDepTime>';
                        $dep_date=$extra_days;
		}else{
			$normal_days='<SearchDepTime PreferredTime="'.$DepPreferredTime.'" ></SearchDepTime>';
			$dep_date=$normal_days;
		}
        $oneway =  '<SearchAirLeg>
                        <SearchOrigin>
                            <CityOrAirport Code="'.$request->origin.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
                        </SearchOrigin>
                        <SearchDestination>
                            <CityOrAirport Code="'.$request->destination.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
                        </SearchDestination>
                       '.$dep_date.'
                    </SearchAirLeg>';
                    
                  
     
			  if($request->type == 'R'){     
        $ArrivPreferredTime = date("Y-m-d",strtotime($request->return_date)).'T00:00:00'; 
        if($request->days ==1){
			$extra_days='<SearchDepTime PreferredTime="'.$ArrivPreferredTime.'" >
                         <SearchExtraDays xmlns="http://www.travelport.com/schema/common_v28_0" DaysAfter="3" DaysBefore="3" />
                        </SearchDepTime>';
                        $arrival_date=$extra_days;
		}else{
			$normal_days='<SearchDepTime PreferredTime="'.$ArrivPreferredTime.'" ></SearchDepTime>';
			$arrival_date=$normal_days;
		}
		            
            $circle = '<SearchAirLeg>
                        <SearchOrigin>
                            <CityOrAirport Code="'.$request->destination.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
                        </SearchOrigin>
                        <SearchDestination>
                            <CityOrAirport Code="'.$request->origin.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
                        </SearchDestination>
                         '.$arrival_date.'
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
    
   $provider='<AirSearchModifiers>
                    <PreferredProviders>
                        <Provider Code="ACH" xmlns="http://www.travelport.com/schema/common_v28_0" ></Provider>
                    </PreferredProviders>
                </AirSearchModifiers>';

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
  
   
    //  echo $LowFareSearchReq;die;
     $LowFareSearchRes = processRequest($LowFareSearchReq);
     // echo $LowFareSearchRes;exit;
	/*$file = "001-1G_TravelAvailabilityRsp.xml";
	prettyPrint($LowFareSearchRes,$file);
	   if($request->days ==1){
		if($request->type == 'O'){
		$file = "001-1G_FlexRsp.xml";
		prettyPrint($LowFareSearchRes,$file);

		}elseif($request->type == 'R'){
		$file = "001-1G_FlexRoundRsp.xml";
		prettyPrint($LowFareSearchRes,$file);
		}
  }*/
     
   
    $LowFareSearchReq_Res = array(
        'LowFareSearchReq' => $LowFareSearchReq,
        'LowFareSearchRes' => $LowFareSearchRes
    );
    return $LowFareSearchReq_Res;

}

function LowFareSearchReq($request){
   // echo '<pre>';print_r($request);die;
		$oneway = '';
        $circle = '';
        $multicity = '';
        $extra_days='';
        $normal_days='';
        $dep_date='';
        $arrival_date='';
         $provider='';
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
		
		// For ACH Not SUPPORT AirLegModifiers No ISSUE its GET WARNING ERROR
       
        $DepPreferredTime = date("Y-m-d",strtotime($request->depart_date)).'T00:00:00';
        if(isset($request->days) && $request->days ==1){
			$extra_days='<SearchDepTime PreferredTime="'.$DepPreferredTime.'" >
                         <SearchExtraDays xmlns="http://www.travelport.com/schema/common_v28_0" DaysAfter="3" DaysBefore="3" />
                        </SearchDepTime>';
                        $dep_date=$extra_days;
		}else{
			$normal_days='<SearchDepTime PreferredTime="'.$DepPreferredTime.'" ></SearchDepTime>';
			$dep_date=$normal_days;
		}
        $oneway =  '<SearchAirLeg>
                        <SearchOrigin>
                            <CityOrAirport Code="'.$request->origin.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
                        </SearchOrigin>
                        <SearchDestination>
                            <CityOrAirport Code="'.$request->destination.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
                        </SearchDestination>
                       '.$dep_date.'
                        <AirLegModifiers>
                            <PreferredCabins>
                                <CabinClass Type="'.$request->class.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CabinClass>
                            </PreferredCabins>
                        </AirLegModifiers>
                    </SearchAirLeg>';
                    
                  
     
			  if($request->type == 'R'){  
		$DepPreferredTime = date("Y-m-d",strtotime($request->depart_date)).'T00:00:00';     
        $ArrivPreferredTime = date("Y-m-d",strtotime($request->return_date)).'T00:00:00'; 
        if(isset($request->days) && $request->days ==1){
			$extra_days='<SearchDepTime PreferredTime="'.$ArrivPreferredTime.'" >
                         <SearchExtraDays xmlns="http://www.travelport.com/schema/common_v28_0" DaysAfter="3" DaysBefore="3" />
                        </SearchDepTime>';
                        $arrival_date=$extra_days;
		}else{
			$normal_days='<SearchDepTime PreferredTime="'.$ArrivPreferredTime.'" ></SearchDepTime>';
			$arrival_date=$normal_days;
		}
		            
            $circle = '<SearchAirLeg>
                        <SearchOrigin>
                            <CityOrAirport Code="'.$request->destination.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
                        </SearchOrigin>
                        <SearchDestination>
                            <CityOrAirport Code="'.$request->origin.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></CityOrAirport>
                        </SearchDestination>
                         '.$arrival_date.'
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
    if((isset($request->provider) && $request->provider!='') && (isset($request->Carriers) && $request->Carriers!='')){
 $provider='<AirSearchModifiers>
                    <PreferredProviders>
                        <Provider Code="'.$request->provider.'" xmlns="http://www.travelport.com/schema/common_v28_0" ></Provider>
                    </PreferredProviders>
                    <PermittedCarriers>
                <Carrier xmlns="http://www.travelport.com/schema/common_v28_0" Code="'.$request->Carriers.'"/>
                 </PermittedCarriers>
                </AirSearchModifiers>';
               
}
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
  
   
      // $LowFareSearchReq;die;
     $LowFareSearchRes = processRequest($LowFareSearchReq);
      //echo $LowFareSearchRes;exit;
	$file = "001-1G_TravelAvailabilityRsp.xml";
	prettyPrint($LowFareSearchRes,$file);
	if(isset($request->days) && $request->days ==1){
		if($request->type == 'O'){
		$file = "001-1G_FlexRsp.xml";
		prettyPrint($LowFareSearchRes,$file);

		}elseif($request->type == 'R'){
		$file = "001-1G_FlexRoundRsp.xml";
		prettyPrint($LowFareSearchRes,$file);
		}
    }
      
     
   
    $LowFareSearchReq_Res = array(
        'LowFareSearchReq' => $LowFareSearchReq,
        'LowFareSearchRes' => $LowFareSearchRes
    );
    return $LowFareSearchReq_Res;
}

function AirPriceReq($flight, $request){
   // echo '<pre>';print_r($flight);
    $segments = '';
                $AirSegmentPricingModifiers='';
                $HostToken_content='';
                $HostToken_content2='';
                $AirSegmentPricingModifiers2='';
                $HostToken_content1='';
                $AirSegmentPricingModifiers1='';
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
    		
            if(isset($segment->OriginTerminal) && $segment->OriginTerminal != ''){
                $OriginTerminal = 'OriginTerminal="'.$segment->OriginTerminal.'"';
            }
            $HostTokenRef='';
            if(isset($segment->HostTokenRef)){
                $HostTokenRef = 'HostTokenRef="'.$segment->HostTokenRef.'"';
            }
            
            $Status='';
            if(isset($segment->Status)){
                $Status = 'Status="'.$segment->Status.'"';
            }
            $SupplierCode='';
            if(isset($segment->SupplierCode)){
                $SupplierCode = 'SupplierCode="'.$segment->SupplierCode.'"';
            }
            
            $HostTokencontent='';
            if(isset($segment->HostTokencontent)){
				 $HostTokencontent =$segment->HostTokencontent;
			}
            
            $DestinationTerminal = '';
            if(isset($segment->DestinationTerminal) && $segment->DestinationTerminal != ''){
                $DestinationTerminal = 'DestinationTerminal="'.$segment->DestinationTerminal.'"';
            }
					$Equipment=(isset($segment->Equipment))?'Equipment="'.$segment->Equipment.'"':'';
					$ETicketability=(isset($segment->ETicketability))?'ETicketability="'.$segment->ETicketability.'"':'ETicketability=""';
					$AvailabilitySource=(isset($segment->AvailabilitySource))?'AvailabilitySource="'.$segment->AvailabilitySource.'"':'AvailabilitySource=""';
					$PolledAvailabilityOption=(isset($segment->PolledAvailabilityOption))?'PolledAvailabilityOption="'.$segment->PolledAvailabilityOption.'"':'PolledAvailabilityOption=""';
					$ParticipantLevel=(isset($segment->ParticipantLevel))?'ParticipantLevel="'.$segment->ParticipantLevel.'"':'ParticipantLevel=""';
					$LinkAvailability=(isset($segment->LinkAvailability) && $segment->LinkAvailability!='')?'LinkAvailability="'.$segment->LinkAvailability.'"':'';
					$Distance=(isset($segment->Distance))?'Distance="'.$segment->Distance.'"':'';
                    $AvailabilityDisplayType=(isset($segment->AvailabilityDisplayType))?'AvailabilityDisplayType="'.$segment->AvailabilityDisplayType.'"':'';
                    $APISRequirementsRef=(isset($segment->APISRequirementsRef))?'APISRequirementsRef="'.$segment->APISRequirementsRef.'"':'';
					
					if($segment->ProviderCode=="ACH"){
						$HostToken_content.='<HostToken xmlns="http://www.travelport.com/schema/common_v28_0" Key="'.$segment->HostTokenRef.'">'.$HostTokencontent.'</HostToken>';
						$AirSegmentPricingModifiers.='<AirSegmentPricingModifiers AirSegmentRef="'.$segment->AirSegment_Key.'" FareBasisCode="'.$segment->FareBasis.'" ></AirSegmentPricingModifiers>';
					$segments .= '<AirSegment '.$APISRequirementsRef.' ArrivalTime="'.$segment->ArrivalTime.'"  Carrier="'.$segment->Carrier.'" ChangeOfPlane="'.$segment->ChangeOfPlane.'" ClassOfService="'.$segment->BookingCode.'" DepartureTime="'.$segment->DepartureTime.'" Destination="'.$segment->Destination.'" '.$Distance.' '.$ETicketability.' '.$Equipment.' FlightNumber="'.$segment->FlightNumber.'" FlightTime="'.$segment->FlightTime.'" Group="'.$segment->Group.'" '.$HostTokenRef.' Key="'.$segment->AirSegment_Key.'"  OptionalServicesIndicator="'.$segment->OptionalServicesIndicator.'" Origin="'.$segment->Origin.'" ProviderCode="'.$segment->ProviderCode.'" '.$Status.' '.$SupplierCode.' ></AirSegment>';

                    }else{

                      
					
            $segments .= '<AirSegment ArrivalTime="'.$segment->ArrivalTime.'" '.$AvailabilityDisplayType.' '.$AvailabilitySource.' Carrier="'.$segment->Carrier.'" ChangeOfPlane="'.$segment->ChangeOfPlane.'" ClassOfService="'.$segment->BookingCode.'" DepartureTime="'.$segment->DepartureTime.'" Destination="'.$segment->Destination.'" '.$Distance.' '.$ETicketability.' '.$Equipment.' FlightNumber="'.$segment->FlightNumber.'" FlightTime="'.$segment->FlightTime.'" Group="'.$segment->Group.'" Key="'.$segment->AirSegment_Key.'" '.$LinkAvailability.' OptionalServicesIndicator="'.$segment->OptionalServicesIndicator.'" Origin="'.$segment->Origin.'" '.$ParticipantLevel.' '.$PolledAvailabilityOption.'  ProviderCode="'.$segment->ProviderCode.'" >
                            '.$CodeshareInfo.'
                            <AirAvailInfo ProviderCode="'.$segment->ProviderCode.'">
                                <BookingCodeInfo BookingCounts="'.$segment->BookingCounts.'"></BookingCodeInfo>
                            </AirAvailInfo>
                            <FlightDetails '.$Equipment.' '.$OriginTerminal.' '.$DestinationTerminal.' Destination="'.$segment->Destination.'" Origin="'.$segment->Origin.'" Key="'.$segment->FlightDetail_Key.'" FlightTime="'.$segment->FlightTime.'" ArrivalTime="'.$segment->ArrivalTime.'" DepartureTime="'.$segment->DepartureTime.'" ></FlightDetails>
                          </AirSegment>';
                      }
        }
    }else if ($request->type == 'R') {
			
        foreach ($flight->onward->segments as $key => $segment) {
            //echo '<pre>';print_r($segment);die;
            if($segment->OperatingFlightNumber != ''){
                if(!isset($request->Carriers) && $request->Carriers == ''){
                $CodeshareInfo = '<CodeshareInfo OperatingCarrier="'.$segment->OperatingCarrier.'" OperatingFlightNumber="'.$segment->OperatingFlightNumber.'" ></CodeshareInfo>';
                    }else{
                    $CodeshareInfo = '';
                }
            }else{
                $CodeshareInfo = '<CodeshareInfo>'.$segment->OperatingCarrier.'</CodeshareInfo>';
            }
            $OriginTerminal = '';
            
            if(isset($segment->OriginTerminal) && $segment->OriginTerminal != ''){
                $OriginTerminal = 'OriginTerminal="'.$segment->OriginTerminal.'"';
            }
            
            $DestinationTerminal = '';
            if(isset($segment->DestinationTerminal) && $segment->DestinationTerminal != ''){
                $DestinationTerminal = 'DestinationTerminal="'.$segment->DestinationTerminal.'"';
            }
            
            $HostTokenRef='';
            if(isset($segment->HostTokenRef)){
                $HostTokenRef = 'HostTokenRef="'.$segment->HostTokenRef.'"';
            }
            
            $Status='';
            if(isset($segment->Status)){
                $Status = 'Status="'.$segment->Status.'"';
            }
            $SupplierCode='';
            if(isset($segment->SupplierCode)){
                $SupplierCode = 'SupplierCode="'.$segment->SupplierCode.'"';
            }
            
            $HostTokencontent='';
            if(isset($segment->HostTokencontent)){
				 $HostTokencontent =$segment->HostTokencontent;
			}
            
                    $Equipment=(isset($segment->Equipment))?'Equipment="'.$segment->Equipment.'"':'';
                    $ETicketability=(isset($segment->ETicketability))?'ETicketability="'.$segment->ETicketability.'"':'ETicketability=""';
                    $AvailabilitySource=(isset($segment->AvailabilitySource))?'AvailabilitySource="'.$segment->AvailabilitySource.'"':'AvailabilitySource=""';
                    $PolledAvailabilityOption=(isset($segment->PolledAvailabilityOption))?'PolledAvailabilityOption="'.$segment->PolledAvailabilityOption.'"':'PolledAvailabilityOption=""';
                    $ParticipantLevel=(isset($segment->ParticipantLevel))?'ParticipantLevel="'.$segment->ParticipantLevel.'"':'ParticipantLevel=""';
                    $LinkAvailability=(isset($segment->LinkAvailability)  && $segment->LinkAvailability!='')?'LinkAvailability="'.$segment->LinkAvailability.'"':'';
                    $Distance=(isset($segment->Distance))?'Distance="'.$segment->Distance.'"':'';
					$AvailabilityDisplayType=(isset($segment->AvailabilityDisplayType))?'AvailabilityDisplayType="'.$segment->AvailabilityDisplayType.'"':'';
                    $APISRequirementsRef=(isset($segment->APISRequirementsRef))?'APISRequirementsRef="'.$segment->APISRequirementsRef.'"':'';

                    if($segment->ProviderCode=="ACH"){
						$HostToken_content1.='<HostToken xmlns="http://www.travelport.com/schema/common_v28_0" Key="'.$segment->HostTokenRef.'">'.$HostTokencontent.'</HostToken>';
						$AirSegmentPricingModifiers1.='<AirSegmentPricingModifiers AirSegmentRef="'.$segment->AirSegment_Key.'" FareBasisCode="'.$segment->FareBasis.'" ></AirSegmentPricingModifiers>';
					$segments .= '<AirSegment '.$APISRequirementsRef.' ArrivalTime="'.$segment->ArrivalTime.'"  Carrier="'.$segment->Carrier.'" ChangeOfPlane="'.$segment->ChangeOfPlane.'" ClassOfService="'.$segment->BookingCode.'" DepartureTime="'.$segment->DepartureTime.'" Destination="'.$segment->Destination.'" '.$Distance.' '.$ETicketability.' '.$Equipment.' FlightNumber="'.$segment->FlightNumber.'" FlightTime="'.$segment->FlightTime.'" Group="'.$segment->Group.'" '.$HostTokenRef.' Key="'.$segment->AirSegment_Key.'"  OptionalServicesIndicator="'.$segment->OptionalServicesIndicator.'" Origin="'.$segment->Origin.'" ProviderCode="'.$segment->ProviderCode.'" '.$Status.' '.$SupplierCode.' ></AirSegment>';
					
					}else{
						
					
             $segments .= '<AirSegment ArrivalTime="'.$segment->ArrivalTime.'" '.$AvailabilityDisplayType.'  '.$AvailabilitySource.' Carrier="'.$segment->Carrier.'" ChangeOfPlane="'.$segment->ChangeOfPlane.'" ClassOfService="'.$segment->BookingCode.'" DepartureTime="'.$segment->DepartureTime.'" Destination="'.$segment->Destination.'" '.$Distance.' '.$ETicketability.' '.$Equipment.' FlightNumber="'.$segment->FlightNumber.'" FlightTime="'.$segment->FlightTime.'" Group="'.$segment->Group.'" Key="'.$segment->AirSegment_Key.'" '.$LinkAvailability.' OptionalServicesIndicator="'.$segment->OptionalServicesIndicator.'" Origin="'.$segment->Origin.'" '.$ParticipantLevel.' '.$PolledAvailabilityOption.'  ProviderCode="'.$segment->ProviderCode.'" >
                            '.$CodeshareInfo.'
                            <AirAvailInfo ProviderCode="'.$segment->ProviderCode.'">
                                <BookingCodeInfo BookingCounts="'.$segment->BookingCounts.'"></BookingCodeInfo>
                            </AirAvailInfo>
                            <FlightDetails '.$Equipment.' '.$OriginTerminal.' '.$DestinationTerminal.' Destination="'.$segment->Destination.'" Origin="'.$segment->Origin.'" Key="'.$segment->FlightDetail_Key.'" FlightTime="'.$segment->FlightTime.'" ArrivalTime="'.$segment->ArrivalTime.'" DepartureTime="'.$segment->DepartureTime.'" ></FlightDetails>
                          </AirSegment>';
					  }
        }
         
        foreach ($flight->return->segments as $key => $segment) {
            //echo '<pre>';print_r($segment);die;
            if($segment->OperatingFlightNumber != ''){
                 if(!isset($request->Carriers) && $request->Carriers == ''){
                $CodeshareInfo = '<CodeshareInfo OperatingCarrier="'.$segment->OperatingCarrier.'" OperatingFlightNumber="'.$segment->OperatingFlightNumber.'" ></CodeshareInfo>';
                }else{
                    $CodeshareInfo = '';
                }
            }else{
                $CodeshareInfo = '<CodeshareInfo>'.$segment->OperatingCarrier.'</CodeshareInfo>';
            }
            $OriginTerminal = '';
            
            if(isset($segment->OriginTerminal) && $segment->OriginTerminal != ''){
                $OriginTerminal = 'OriginTerminal="'.$segment->OriginTerminal.'"';
            }
            
            $DestinationTerminal = '';
            if(isset($segment->DestinationTerminal) && $segment->DestinationTerminal != ''){
                $DestinationTerminal = 'DestinationTerminal="'.$segment->DestinationTerminal.'"';
            }
            
            $HostTokenRef='';
            if(isset($segment->HostTokenRef)){
                $HostTokenRef = 'HostTokenRef="'.$segment->HostTokenRef.'"';
            }
            
            $Status='';
            if(isset($segment->Status)){
                $Status = 'Status="'.$segment->Status.'"';
            }
            $SupplierCode='';
            if(isset($segment->SupplierCode)){
                $SupplierCode = 'SupplierCode="'.$segment->SupplierCode.'"';
            }
            
            $HostTokencontent='';
            if(isset($segment->HostTokencontent)){
				 $HostTokencontent =$segment->HostTokencontent;
			}
            
                    $Equipment=(isset($segment->Equipment))?'Equipment="'.$segment->Equipment.'"':'';
                    $ETicketability=(isset($segment->ETicketability))?'ETicketability="'.$segment->ETicketability.'"':'ETicketability=""';
                    $AvailabilitySource=(isset($segment->AvailabilitySource))?'AvailabilitySource="'.$segment->AvailabilitySource.'"':'AvailabilitySource=""';
                    $PolledAvailabilityOption=(isset($segment->PolledAvailabilityOption))?'PolledAvailabilityOption="'.$segment->PolledAvailabilityOption.'"':'PolledAvailabilityOption=""';
                    $ParticipantLevel=(isset($segment->ParticipantLevel))?'ParticipantLevel="'.$segment->ParticipantLevel.'"':'ParticipantLevel=""';
                    $LinkAvailability=(isset($segment->LinkAvailability)  && $segment->LinkAvailability!='')?'LinkAvailability="'.$segment->LinkAvailability.'"':'';
                    $Distance=(isset($segment->Distance))?'Distance="'.$segment->Distance.'"':'';
                   $AvailabilityDisplayType=(isset($segment->AvailabilityDisplayType))?'AvailabilityDisplayType="'.$segment->AvailabilityDisplayType.'"':'';
                    $APISRequirementsRef=(isset($segment->APISRequirementsRef))?'APISRequirementsRef="'.$segment->APISRequirementsRef.'"':'';

            
					if($segment->ProviderCode=="ACH"){
						$HostToken_content2.='<HostToken xmlns="http://www.travelport.com/schema/common_v28_0" Key="'.$segment->HostTokenRef.'">'.$HostTokencontent.'</HostToken>';
						$AirSegmentPricingModifiers2.='<AirSegmentPricingModifiers AirSegmentRef="'.$segment->AirSegment_Key.'" FareBasisCode="'.$segment->FareBasis.'" ></AirSegmentPricingModifiers>';
					
             $segments .= '<AirSegment '.$APISRequirementsRef.' ArrivalTime="'.$segment->ArrivalTime.'"  Carrier="'.$segment->Carrier.'" ChangeOfPlane="'.$segment->ChangeOfPlane.'" ClassOfService="'.$segment->BookingCode.'" DepartureTime="'.$segment->DepartureTime.'" Destination="'.$segment->Destination.'" '.$Distance.' '.$ETicketability.' '.$Equipment.' FlightNumber="'.$segment->FlightNumber.'" FlightTime="'.$segment->FlightTime.'" Group="'.$segment->Group.'" '.$HostTokenRef.' Key="'.$segment->AirSegment_Key.'"  OptionalServicesIndicator="'.$segment->OptionalServicesIndicator.'" Origin="'.$segment->Origin.'" ProviderCode="'.$segment->ProviderCode.'" '.$Status.' '.$SupplierCode.' ></AirSegment>';
					}else{
             $segments .= '<AirSegment ArrivalTime="'.$segment->ArrivalTime.'" '.$AvailabilityDisplayType.' '.$AvailabilitySource.' Carrier="'.$segment->Carrier.'" ChangeOfPlane="'.$segment->ChangeOfPlane.'" ClassOfService="'.$segment->BookingCode.'" DepartureTime="'.$segment->DepartureTime.'" Destination="'.$segment->Destination.'" '.$Distance.' '.$ETicketability.' '.$Equipment.' FlightNumber="'.$segment->FlightNumber.'" FlightTime="'.$segment->FlightTime.'" Group="'.$segment->Group.'" Key="'.$segment->AirSegment_Key.'" '.$LinkAvailability.' OptionalServicesIndicator="'.$segment->OptionalServicesIndicator.'" Origin="'.$segment->Origin.'" '.$ParticipantLevel.' '.$PolledAvailabilityOption.'  ProviderCode="'.$segment->ProviderCode.'" >
                            '.$CodeshareInfo.'
                            <AirAvailInfo ProviderCode="'.$segment->ProviderCode.'">
                                <BookingCodeInfo BookingCounts="'.$segment->BookingCounts.'"></BookingCodeInfo>
                            </AirAvailInfo>
                            <FlightDetails '.$Equipment.' '.$OriginTerminal.' '.$DestinationTerminal.' Destination="'.$segment->Destination.'" Origin="'.$segment->Origin.'" Key="'.$segment->FlightDetail_Key.'" FlightTime="'.$segment->FlightTime.'" ArrivalTime="'.$segment->ArrivalTime.'" DepartureTime="'.$segment->DepartureTime.'" ></FlightDetails>
                          </AirSegment>';
					  }
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
                    '.$HostToken_content.'
                    '.$HostToken_content1.'
                    '.$HostToken_content2.'
                </AirItinerary>
                  '.$AirPricingModifiers.'
                  '.$adults.'
                  '.$childs.'
                  '.$infants.'
                <AirPricingCommand>'.$AirSegmentPricingModifiers1.$AirSegmentPricingModifiers2.$AirSegmentPricingModifiers.'</AirPricingCommand>
            </AirPriceReq>
        </s:Body>
    </s:Envelope>';

    $AirPriceRes = processRequest($AirPriceReq);
    $AirPriceReq_Res = array(
        'AirPriceReq' => $AirPriceReq,
        'AirPriceRes' => $AirPriceRes
    );
    
	//echo $AirPriceReq;die;
    // echo $AirPriceRes;die;
    /*$file = "pricereq.xml";
    prettyPrint($AirPriceReq,$file);
   $file = "priceres.xml";
    prettyPrint($AirPriceRes,$file);*/
   
    return $AirPriceReq_Res;
}

function AirCreateReservationReq($cart_flight_data, $checkout_form, $cid,$passengers){
       // echo "<pre>";
   // print_r($checkout_form);
    $passengers=json_decode(base64_decode($passengers));
    //print_r($passengers);
	$AirItinerary_xml = $cart_flight_data->AirItinerary_xml;
	$AirPricingSolution_xml = $cart_flight_data->AirPricingSolution_xml;
	$request = json_decode(base64_decode($cart_flight_data->request));
   $array_sr=array('<AirItinerary>','</AirItinerary>','common_v28_0:');
	$AirItinerary_xml = str_replace($array_sr,'',$AirItinerary_xml);
	//$AirItinerary_xml = str_replace('</AirItinerary>','',$AirItinerary_xml);
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
    
     $domds= $doc;

    $OptionalServices = $domds->getElementsByTagName("OptionalServices");
    while ($OptionalServices->length > 0) {
         $node = $OptionalServices->item(0);
         remove_node($node);

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

    $address = '';
          
                $address .= '<Address>
                                <AddressName>'.$checkout_form->street_address.'</AddressName>
                                <Street>'.$checkout_form->street_address.'</Street>
                                <City>'.$checkout_form->city.'</City>
                                <State>CO</State>
                                <PostalCode>'.$checkout_form->zip.'</PostalCode>
                                <Country>'.$checkout_form->country.'</Country>
                            </Address>';
            

        $adults = '';
        $fname="first_name"."$cid";
        $mname="middle_name"."$cid";
        $lname="last_name"."$cid";
        $dob="txtdob"."$cid";
        $gender="selGender"."$cid";
        $mobile="mobile"."$cid";
        $email="email"."$cid";
        $doba=explode("/",$checkout_form->$dob);
        $doba=array_reverse($doba);
         $doba=implode("-",$doba);
 $adults .= '<BookingTraveler Key="0" TravelerType="ADT" DOB="'.$doba.'" Gender="'.substr($checkout_form->$gender,0,1).'" xmlns="http://www.travelport.com/schema/common_v28_0">
                            <BookingTravelerName  First="'.$checkout_form->$fname.'" Middle="'.$checkout_form->$mname.'"  Last="'.$checkout_form->$lname.'" ></BookingTravelerName>
                            <PhoneNumber Number="'.$checkout_form->$mobile.'" Type="Mobile" ></PhoneNumber>
                            <Email EmailID="'.$checkout_form->$email.'" Type="P" ></Email>   
                            '.$address.'
                        </BookingTraveler>';


	$paxId=1;
   
    if($request->ADT >1){
        for ($i=1; $i < $request->ADT; $i++) {
                $s=$i-1;
                $ss=$i+1;
                $audlt="adults"."$ss";
                $doba=explode("/",$passengers->dob[$s]->$audlt);
                $doba=array_reverse($doba);
                $doba=implode("-",$doba);
            $adults .= '<BookingTraveler Key="'.$paxId.'" TravelerType="ADT" DOB="'.$doba.'" Gender="'.substr($passengers->gender[$s]->$audlt,0,1).'" xmlns="http://www.travelport.com/schema/common_v28_0">
							<BookingTravelerName  First="'.$passengers->first[$s]->$audlt.'" Middle="'.$passengers->middle[$s]->$audlt.'"  Last="'.$passengers->last[$s]->$audlt.'" ></BookingTravelerName>
							<PhoneNumber Number="'.$checkout_form->mobile.'" Type="Mobile" ></PhoneNumber>
							<Email EmailID="'.$checkout_form->email.'" Type="P" ></Email>';   
						 $adults .= '</BookingTraveler>';
            $paxId++;
        }
    }
       
 
    

    $childs = '';
    if($request->CHD != 0){
        
        for ($i=0; $i < $request->CHD; $i++) { 
           
                $aa=($request->ADT)-1; 
                 $s=$aa+$i;
                 
            
             $ss=$i+1;
            
        $child="childs"."$ss";
         $dobc=explode("/",$passengers->dob[$s]->$child);
        $dobc=array_reverse($dobc);
         $dobc=implode("-",$dobc);
              $childs .= '<BookingTraveler Key="'.$paxId.'" TravelerType="CNN"   DOB="'.$dobc.'" Gender="'.substr($passengers->gender[$s]->$child,0,1).'" xmlns="http://www.travelport.com/schema/common_v28_0">
							<BookingTravelerName  First="'.$passengers->first[$s]->$child.'" Middle="'.$passengers->middle[$s]->$child.'" Last="'.$passengers->last[$s]->$child.'"  ></BookingTravelerName>
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
        $aa=($request->CHD+$request->ADT)-1; 
           
            $s=$aa+$i;
           
             $ss=$i+1;
              $infant="infants"."$ss";
                $dobi=explode("/",$passengers->dob[$s]->$infant);
                $dobi=array_reverse($dobi);
                $dobi=implode("-",$dobi);
            $infants .= '<BookingTraveler Key="'.$paxId.'" TravelerType="INF" DOB="'.$dobi.'" Gender="'.substr($passengers->gender[$s]->$infant,0,1).'" xmlns="http://www.travelport.com/schema/common_v28_0">
							<BookingTravelerName  First="'.$passengers->first[$s]->$infant.'" Middle="'.$passengers->middle[$s]->$infant.'" Last="'.$passengers->last[$s]->$infant.'" ></BookingTravelerName>
							<PhoneNumber Number="'.$checkout_form->mobile.'" Type="Mobile" ></PhoneNumber>
							<Email EmailID="'.$checkout_form->email.'" Type="P" ></Email>
							<NameRemark Category="AIR">
								<RemarkData>12FEB13</RemarkData>
							</NameRemark>   
						</BookingTraveler>';
            $paxId++;
        }
    }
 //echo $adults.$childs.$infants;die;
    // echo $infants;die;
	$AirCreateReservationReq = '<?xml version="1.0" encoding="utf-8"?>
	<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">
                        <s:Header/>
                        <s:Body>
                            <univ:AirCreateReservationReq xmlns:univ="http://www.travelport.com/schema/universal_v28_0" TargetBranch="P7028803" xmlns="http://www.travelport.com/schema/air_v28_0" RetainReservation="Both">
                            <BillingPointOfSaleInfo  xmlns="http://www.travelport.com/schema/common_v28_0" OriginApplication="UAPI" ></BillingPointOfSaleInfo>
                            '.$adults.'
                            '.$childs.'
                            '.$infants.'
                            '.$AirPricingSolution_xml.'
                            <ActionStatus ProviderCode="1G" TicketDate="T*" Type="ACTIVE" QueueCategory="01" xmlns="http://www.travelport.com/schema/common_v28_0" ></ActionStatus>
                            </univ:AirCreateReservationReq>
                        </s:Body>
                        </s:Envelope>';

                          $AirCreateReservationReq1='<?xml version="1.0" encoding="utf-8"?>
<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">
  <s:Header/>
  <s:Body>
    <univ:AirCreateReservationReq xmlns:univ="http://www.travelport.com/schema/universal_v28_0" xmlns="http://www.travelport.com/schema/air_v28_0" TargetBranch="P7028803" RetainReservation="Both">
      <BillingPointOfSaleInfo xmlns="http://www.travelport.com/schema/common_v28_0" OriginApplication="UAPI"/>
      <BookingTraveler xmlns="http://www.travelport.com/schema/common_v28_0" Key="gr8AVWGCR064r57Jt0+8bA==" TravelerType="ADT" DOB="1990-09-17" Gender="M">
        <BookingTravelerName Prefix="Mr." First="Veera Mani21" Last="cvcv21"/>
        <PhoneNumber Number="xcvcv" Type="Mobile"/>
        <Email EmailID="veera@gmail.com" Type="P"/>
        <Address>
          <AddressName>xcvcv</AddressName>
          <Street>xcvcv</Street>
          <City>xcvcv</City>
          <State>CO</State>
          <PostalCode>xcvcv</PostalCode>
          <Country>NL</Country>
        </Address>
      </BookingTraveler>
      <AirPricingSolution Key="/UMyEdYCSQC7rwabH8LNnQ==" TotalPrice="GBP67.29" BasePrice="GBP54.29" ApproximateTotalPrice="EUR93.68" ApproximateBasePrice="EUR75.58" Taxes="GBP13.00" Services="GBP0.00" ApproximateTaxes="EUR18.10">
        <AirSegment Key="fxNazIttQOObw2wFnzn4yQ==" Group="0" Carrier="U2" FlightNumber="811" ProviderCode="ACH" Origin="LGW" Destination="EDI" DepartureTime="2015-07-31T20:30:00.000+01:00" ArrivalTime="2015-07-31T21:55:00.000+01:00" FlightTime="85" TravelTime="85" ClassOfService="B" ETicketability="Yes" Status="KK" ChangeOfPlane="false" HostTokenRef="5ViH8UhYRn+VyIkE9kGSTg==" SupplierCode="U2" OptionalServicesIndicator="true">
          <CodeshareInfo OperatingCarrier="U2" OperatingFlightNumber="811"/>
        </AirSegment>
         <AirPricingInfo Key="KHCRsqipSomWj4y9EsAUDA==" TotalPrice="GBP67.29" BasePrice="GBP54.29" ApproximateTotalPrice="EUR93.68" ApproximateBasePrice="EUR75.58" ApproximateTaxes="EUR18.10" Taxes="GBP13.00" PricingMethod="Auto" ProviderCode="ACH" SupplierCode="U2">
          <FareInfo Key="QgfmIdqtS32yVPTigTjDhA==" FareBasis="B" PassengerTypeCode="ADT" Origin="LGW" Destination="EDI" EffectiveDate="2015-07-25T06:32:38.971+02:00" DepartureDate="2015-07-31" Amount="GBP54.29" PromotionalFare="false" FareFamily="INCLUSIVE FARE">
            <FareRuleKey FareInfoRef="QgfmIdqtS32yVPTigTjDhA==" ProviderCode="ACH">H4sIAAAAAAAAAK1XzW4cRRBu/4QkOLGd2BHiEKkVLkEyMyiIJBAhWP+FjRZj2RuQcol6Z3pnO+6Z7nT3eHc5ROLCJQc4wIEDb5D34MKJBwAOHOEBuFHVM7sz6zhIY7GH1W5119dfVX1TXfPib3LOGrITqTRwhh1zqZVxgVUsSGIbMGGkyHgwUNYFqYq5DFg0CFrCtB3YDTPjfSMikSXtrK9I8ZmbJxc65FKfGY7WjrDOkWudJ+yYhbkTMmwZw8ZovtchlwUAdZVjchf2O/JRB6iEFZUQqIRAJSyphEgl9FRCoBK26+6At6a0Eypj8pCbYxHx4vTV2unlwW+e2GhrJNoNSXz+Kig454rubuHPTcPZUayGmX1KnpE5SJCGzPED/hST5Mj9hmful945tw4RTMqQBKZUFyU5VLmJIJqrRfCSZUl46AyswKYVwyfn58LwGEm9NtKghTXcHWCqgmmhRl//ev3Hn9lPC2SuTRat+IqPNFZ6uIjf4HS7mYB2S21UilnqkGVmjDhmEtSFGI7cbZiSjoomOViNuWbG5YaXaBgfnHF5at9mjvugIRexsJHKM1dq2ZGPG568PQuARUD5H/A+NzyLzqDr3bq7xxOwLWkVux250xCvdMTUpMwccVcH+6Qh2GcnEAB1OeOJcgKSGiP1MrNXZ61bgFCuXDC55IXym5b5oPTErDjNdkaOZxbKbptnubvfqtzvefk3VPJEc5WS5ztkKYL1LZU5PnJlvJdkuXGag5F2ZLHd6rYcWdjZbvu2sFaZOve/1MjnXvMna6qbihQwWGKR12itCFdmRNqt2K4abjeVOtrmViQ1h3UnIqi8N2fMKVNbW851YljMW1KqYdlQOuSN0npwGuBIQw6W23tbnYeH7S926G7rYMeRuU3tI3+/8aWE5plCLEYVv5eKggWYf3irTLnWZ0n3jIBmutlKme6HlqNgbfOm0poFQLkzzC2DWhVPzqdnaCqbLElYUlRpgoTXVO+EHQjv/A/wSHulZ1gWFy2gIN40FZuzAIB5se/vVDA78sFZeKIr9q3iEcCeiBddeTd79LJsZ0GfFGx9MmRsDZhJuL1vVA6q2z7jfFFHKS56vs/GpU6ad7/9ujvWyfIk5ZnDCGrJWLe5RjgeFzzsdG2ky6fmTvMm5QtgVkaj327/9c88OfeIvO5lsgtk4kdkNdeWS7lZM60UpnYWiwh7T4ec9x7t7emA52ecjipu4BpCexv5vuOHFqC77Ecc3Bz4zc///O6Xb9/6fZ7MPSDnYALJ+ciQ1WrTXp72uPnmxQ/Xl77/4/k8IR4IPtfCs4bvFVI1DEjzss17hzzCDNcS7K+FCzOz1t1mpx1OYavjFlE8zDBozXpQK/V54FBr6asVpSIFk8sb7F3h5KSLn0KyYUr2J2QqjgvQvjOWTrhcxIHB1rnmRtaVeAqJWw2bOdwMM9fHxWKsBuU7slZTGNxkkjOcMxdrt4l2C8+6A07bWSRzK445xULTNLeO9jjVTMRUZLSfS0mZo06knKo+7cG1CKNUQOkpzgL/xtxSRgdKxhS6NL2Za+oUvfXuUfL2BnXghBcuHOIH+pjiJRHhyEUtZ26DRjDeC0cjZmLa55zC80BZnCIVzl9xrKWZchQCFpL1JKeQCKrhdWLALJDOKGd2/IC7ABJMYelYME+kNNNU9QR4Ma0Bfw+KaDFSzazlWcKNpSkbY04AD/7HiKjZGHsP7mP0Bha+XL2BNDeoBn5AfQzUIRrfDmmkpCzkiQhIIONDir0bjt2vTosYrEIfsDDpUBht4DXNz2KW3gQlPwEITGgZLczZbvy2jxjcfKJAZcY7+PxpAJmG4v/1pUgGrsYxFv1yqMKKIzGHr4RA2PoI0VI4eSXgOqoBfxRBYwVSGJsC2u7PBIYLWG6zARWCWPrQGulQgKQgnYUH3ZtdgCrIMRV9OlY5RYg88zWFkPtyDPtbs1m15VvsrHIxH/+p3l3Y4FcdN6n1KotUVqBaSA1H6RgcNvFkeDel1sEmVOWpHnDIwDn9YRgOh8MAlfWkEFy4s4dP4FFYbQ4GLpUBHZ3sAY689woMnoX+1Mdw6uMTQCM/l653p6y2puv1PkP8GWT0kgGvxZeMYPsXicRO3G0RAAA=</FareRuleKey>
        </FareInfo>
          <BookingInfo BookingCode="B" CabinClass="Economy" FareInfoRef="QgfmIdqtS32yVPTigTjDhA==" SegmentRef="fxNazIttQOObw2wFnzn4yQ==" />
          <TaxInfo Category="DU" CarrierDefinedCategory="XT" Amount="GBP13.00" Key="MpkjwcEnTpeU8Idi3C+vlw=="/>
          <PassengerType Code="ADT" BookingTravelerRef="gr8AVWGCR064r57Jt0+8bA=="/>
        </AirPricingInfo>
        <HostToken Key="5ViH8UhYRn+VyIkE9kGSTg==">H4sIAAAAAAAAAFvzloG1hIHVNSg41AgAqOI+SAwAAAA={IS@@@}H4sIAAAAAAAAAFvzloG1hIHZ3SkAAD3MWJcKAAAA{CC@@@ET}ACHSDv01LPD1:c1c7fbba-317b-4852-b70b-e219a575a7a9</HostToken>

      </AirPricingSolution>
      <ActionStatus xmlns="http://www.travelport.com/schema/common_v28_0" ProviderCode="1G" TicketDate="T*" Type="ACTIVE" QueueCategory="01"/>
    </univ:AirCreateReservationReq>
  </s:Body>
</s:Envelope>
';
	$AirCreateReservationRes = processRequest($AirCreateReservationReq);
    $AirCreateReservationReq_Res = array(
        'AirCreateReservationReq' => $AirCreateReservationReq,
        'AirCreateReservationRes' => $AirCreateReservationRes
    );
    // echo $AirCreateReservationReq;die; 
     //echo $AirCreateReservationRes;die;
    //$file="bookreq.xml"; 
   // prettyPrint($AirCreateReservationReq,$file);
     //$file="bookres.xml"; 
    //prettyPrint($AirCreateReservationRes,$file);
 
    return $AirCreateReservationReq_Res;
}

 function remove_node(&$node) 
 {
     $pnode = $node->parentNode;
     remove_children($node);
     $pnode->removeChild($node);
 }
 
 function remove_children(&$node) {
     while ($node->firstChild) {
         while ($node->firstChild->firstChild) {
             remove_children($node->firstChild);
         }
 
         $node->removeChild($node->firstChild);
     }
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
   // max_allowed_packet=500M;
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
    
     // $CI->xml_model->insert_xml_log($xml_log);
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
