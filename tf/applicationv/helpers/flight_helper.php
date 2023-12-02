<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set("memory_limit",-1);
/*
|--------------------------------------------------------------------------|
| Author: Provab Technosoft Pvt Ltd.                                       |
|--------------------------------------------------------------------------|
| Developer: Provab                                            |
| Started Date: 2014-10-15T16:15:00                                        |
| Ended Date:                                                              |
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





function LowFareSearchReq($request){
   # echo '<pre>';print_r($request);die;
        $oneway = '';
        $circle = '';
        $multicity = '';
        $extra_days='';
        $normal_days='';
        $dep_date='';
        $arrival_date='';
         $provider='';
         $airlines='';

           $LegModifiers='';
    if(isset($request->class) && $request->class!=''){
$LegModifiers='<air:AirLegModifiers>
<air:PreferredCabins>
<com:CabinClass Type="' . $request->class . '" xmlns:com="http://www.travelport.com/schema/common_v33_0" />
</air:PreferredCabins>
</air:AirLegModifiers>'; 
    }

    if($request->type == 'M'){
       
        foreach ($request->origin as $key => $value) {
            $origin = $value;
            $destination = $request->destination[$key];
            $DepPreferredTime = date("Y-m-d",strtotime($request->depart_date[$key]));
            $multicity .= '<air:SearchAirLeg>
                            <air:SearchOrigin>
                                <com:CityOrAirport Code="'.$origin.'" xmlns:com="http://www.travelport.com/schema/common_v33_0" />
                            </air:SearchOrigin>
                            <air:SearchDestination>
                                <com:CityOrAirport Code="'.$destination.'" xmlns:com="http://www.travelport.com/schema/common_v33_0" />
                            </air:SearchDestination>
                            <air:SearchDepTime PreferredTime="'.$DepPreferredTime.'" />
                            '.$LegModifiers.'
                        </air:SearchAirLeg>';
        }      
                      
    }else{
        
        // For ACH Not SUPPORT AirLegModifiers No ISSUE its GET WARNING ERROR
       
        $DepPreferredTime = date("Y-m-d",strtotime($request->depart_date));
        if(isset($request->days) && $request->days ==1){
            $extra_days='<air:SearchDepTime PreferredTime="'.$DepPreferredTime.'" >
                         <air:SearchExtraDays xmlns:air="http://www.travelport.com/schema/common_v33_0" DaysAfter="3" DaysBefore="3" />
                        </air:SearchDepTime>';
                        $dep_date=$extra_days;
        }else{
            $normal_days='<air:SearchDepTime PreferredTime="'.$DepPreferredTime.'" />';
            $dep_date=$normal_days;
        }
        $oneway =  '<air:SearchAirLeg>
                        <air:SearchOrigin>
                            <com:CityOrAirport Code="'.$request->origin.'" xmlns:com="http://www.travelport.com/schema/common_v33_0" />
                        </air:SearchOrigin>
                        <air:SearchDestination>
                            <com:CityOrAirport Code="'.$request->destination.'" xmlns:com="http://www.travelport.com/schema/common_v33_0" />
                        </air:SearchDestination>
                       '.$dep_date.'
                    '.$LegModifiers.'
                    </air:SearchAirLeg>';
                    
                  
     
              if($request->type == 'R'){  
        $DepPreferredTime = date("Y-m-d",strtotime($request->depart_date));     
        $ArrivPreferredTime = date("Y-m-d",strtotime($request->return_date)); 
        if(isset($request->days) && $request->days ==1){
            $extra_days='<air:SearchDepTime PreferredTime="'.$ArrivPreferredTime.'" >
                         <air:SearchExtraDays xmlns:air="http://www.travelport.com/schema/common_v33_0" DaysAfter="3" DaysBefore="3" />
                        </air:SearchDepTime>';
                        $arrival_date=$extra_days;
        }else{
            $normal_days='<air:SearchDepTime PreferredTime="'.$ArrivPreferredTime.'" />';
            $arrival_date=$normal_days;
        }
                    
            $circle = '<air:SearchAirLeg>
                        <air:SearchOrigin>
                            <com:CityOrAirport Code="'.$request->destination.'" xmlns:com="http://www.travelport.com/schema/common_v33_0" />
                        </air:SearchOrigin>
                        <air:SearchDestination>
                            <com:CityOrAirport Code="'.$request->origin.'" xmlns:com="http://www.travelport.com/schema/common_v33_0" />
                        </air:SearchDestination>
                         '.$arrival_date.'
                         '.$LegModifiers.'
                    </air:SearchAirLeg>';
                    
                  
        }
    }

    $adult_patch = $child_patch = $infant_patch = '';

    for($i=1;$i<=$request->ADT;$i++){
        $adult_patch .= '<com:SearchPassenger Code="ADT" xmlns:com="http://www.travelport.com/schema/common_v33_0" />';
    }

    for($i=1;$i<=$request->CHD;$i++){
        $child_patch .= '<com:SearchPassenger Code="CNN" Age="10" xmlns:com="http://www.travelport.com/schema/common_v33_0" />';
    }

    for($i=1;$i<=$request->INF;$i++){
        $infant_patch .= '<com:SearchPassenger Code="INF" Age="1" xmlns:com="http://www.travelport.com/schema/common_v33_0" />';
    }
    if((isset($request->provider) && $request->provider!='') && (isset($request->Carriers) && $request->Carriers!='')){


         $Airline=explode(",",$request->Carriers);
if(is_array($Airline) && count($Airline)>0){
    foreach ($Airline as $airline) {
       $airlines.='<com:Carrier xmlns:com="http://www.travelport.com/schema/common_v33_0" Code="'.$airline.'" />';
    }

}



 $provider='<air:AirSearchModifiers>
                    <air:PreferredProviders>
                        <com:Provider Code="'.$request->provider.'" xmlns:com="http://www.travelport.com/schema/common_v33_0" />
                    </air:PreferredProviders>
                    <air:PermittedCarriers>
                   '.$airlines.'
                 </air:PermittedCarriers>
                </air:AirSearchModifiers>';
               
}else{
    $ach='';
if($request->type != 'M'){
$ach.='<com:Provider Code="ACH" xmlns:com="http://www.travelport.com/schema/common_v33_0" />';
}
    $provider='<air:AirSearchModifiers >
                    <air:PreferredProviders>
                   '.$ach.'
                    <com:Provider Code="1G" xmlns:com="http://www.travelport.com/schema/common_v33_0" />
                    </air:PreferredProviders>
                    <!--  <air:PreferredCarriers>
                    <com:Carrier xmlns:com="http://www.travelport.com/schema/common_v33_0" Code="U2" />
                    </air:PreferredCarriers>
                  <air:FlightType DoubleInterlineCon="false" PreferNonStop="true" DoubleOnlineCon="false" NonStopDirects="true" SingleInterlineCon="false" SingleOnlineCon="false" StopDirects="false" TripleInterlineCon="false" TripleOnlineCon="false"></air:FlightType>-->
                     </air:AirSearchModifiers>';
}


if($request->method=="asynch"){
$search_method="air:LowFareSearchAsynchReq";
$AsynchModifiers='<air:AirSearchAsynchModifiers  >
<air:InitialAsynchResult   MaxWait="02"/>
</air:AirSearchAsynchModifiers>';
}else{
    $search_method="air:LowFareSearchReq";
    $AsynchModifiers="";
}

    $LowFareSearchReq = '<?xml version="1.0" encoding="utf-8"?>
    <s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">
        <s:Header>
            <Action s:mustUnderstand="1" xmlns="http://schemas.microsoft.com/ws/2005/05/addressing/none">http://localhost:8080/kestrel/AirService</Action>
        </s:Header>
        <s:Body xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
            <'.$search_method.' SolutionResult="true" PreferCompleteItinerary="true" TargetBranch="P2629804" AuthorizedBy="user" TraceId="trace" xmlns:air="http://www.travelport.com/schema/air_v33_0">
                <com:BillingPointOfSaleInfo OriginApplication="UAPI" xmlns:com="http://www.travelport.com/schema/common_v33_0" />
                    '.$oneway.'
                    '.$circle.'
                    '.$multicity.'
                    '.$provider.'
                    '.$adult_patch.'
                    '.$child_patch.'
                    '.$infant_patch.'
                      <air:AirPricingModifiers FaresIndicator="PublicAndPrivateFares" CurrencyType="EUR"></air:AirPricingModifiers>
                       '.$AsynchModifiers.'
            </'.$search_method.'>
         
        </s:Body>
    </s:Envelope>';
  
   
      
     $LowFareSearchRes = processRequest($LowFareSearchReq);
     /* echo $LowFareSearchRes;exit;
      $LowFareSearchReq;die;*/
    $file = "XMLs/LowFareSearchReq.xml";
    prettyPrint($LowFareSearchReq,$file);
    $file1 = "XMLs/LowFareSearchRes.xml";
    prettyPrint($LowFareSearchRes,$file1);

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

function RetrieveLowFareSearchReq($request){

    //$request->ProviderCode="1G";
   // $SearchId="CD7DE78E0A076477BB9FFFDCEFA3B9C1_RLGWEDI11Nov15EDILGW30Nov15tftnull300-1-1MIU2ACH1GnullfADTff282272";


   $LowFareSearchReq='<?xml version="1.0" encoding="utf-8"?>
 <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:air="http://www.travelport.com/schema/air_v31_0" xmlns:com="http://www.travelport.com/schema/common_v31_0">
<soapenv:Header/>
<soapenv:Body>
<air:RetrieveLowFareSearchReq AuthorizedBy="user" ProviderCode="'.$request->ProviderCode.'" SearchId="'.$request->SearchId.'" TargetBranch="P2629804" TraceId="trace">
<com:BillingPointOfSaleInfo OriginApplication="UAPI"/>
</air:RetrieveLowFareSearchReq>
</soapenv:Body>
</soapenv:Envelope>';

  $LowFareSearchRes = processRequest($LowFareSearchReq);

     $LowFareSearchReq_Res = array(
        'LowFareSearchReq' => $LowFareSearchReq,
        'LowFareSearchRes' => $LowFareSearchRes
    );

     $file = "XMLs/LowFareSearchReq.xml";
    prettyPrint($LowFareSearchReq,$file);
    $file1 = "XMLs/LowFareSearchRes.xml";
    prettyPrint($LowFareSearchRes,$file1);

    return $LowFareSearchReq_Res;

}

function AirPriceReq($flight, $request){
    //echo '<pre>';print_r($flight);die;
   				$segments = '';
                $AirSegmentPricingModifiers='';
                $HostToken_content='';
                $HostToken_content2='';
                $AirSegmentPricingModifiers2='';
                $HostToken_content1='';
                $AirSegmentPricingModifiers1='';
                 $connection_indc='';  
                $exp_conn=array_filter(explode(",",rtrim($flight->Connections,",")));
				 
    //echo '<pre>';print_r($flight->segments);die;
    if($request->type == 'O'){
               
        foreach ($flight->segments as $key => $segment) {


               /*   if($air_pricing_modifiers==''){
        if ($request->class != '') {
                if(isset($segment->CabinClass)){ //echo " 1st ";
                    $air_pricing_modifiers = '<AirPricingModifiers FaresIndicator="PublicAndPrivateFares">
                                <PermittedCabins>
                                <CabinClass Type="' . $segment->CabinClass . '" xmlns="http://www.travelport.com/schema/common_v33_0" />
                                </PermittedCabins>
                            </AirPricingModifiers>';
                }else{ //echo " 2nd ";
                    foreach($segment as $sk=>$sv){
                        if($air_pricing_modifiers==''){
                            $air_pricing_modifiers = '<AirPricingModifiers FaresIndicator="PublicAndPrivateFares">
                                <PermittedCabins>
                                <CabinClass Type="' . $sv->CabinClass . '" xmlns="http://www.travelport.com/schema/common_v33_0" />
                                </PermittedCabins>
                            </AirPricingModifiers>';
                        }
                    }
                }
        }
            }*/

            //echo '<pre>';print_r($segment);die;
            if($segment->OperatingFlightNumber != ''){
            	if($segment->OperatingCarrier!=''){
            		$op_carr='OperatingCarrier="'.$segment->OperatingCarrier.'"';
            	}else{
            		$op_carr='';
            	}
                $CodeshareInfo = '<CodeshareInfo "'.$op_carr.'" OperatingFlightNumber="'.$segment->OperatingFlightNumber.'" ></CodeshareInfo>';
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
                    $AvailabilitySource=(isset($segment->AvailabilitySource))?'AvailabilitySource="'.$segment->AvailabilitySource.'"':'';
                    $PolledAvailabilityOption=(isset($segment->PolledAvailabilityOption))?'PolledAvailabilityOption="'.$segment->PolledAvailabilityOption.'"':'';
                    $ParticipantLevel=(isset($segment->ParticipantLevel))?'ParticipantLevel="'.$segment->ParticipantLevel.'"':'';
                    $LinkAvailability=(isset($segment->LinkAvailability) && $segment->LinkAvailability!='')?'LinkAvailability="'.$segment->LinkAvailability.'"':'';
                    $Distance=(isset($segment->Distance))?'Distance="'.$segment->Distance.'"':'';
                    $AvailabilityDisplayType=(isset($segment->AvailabilityDisplayType))?'AvailabilityDisplayType="'.$segment->AvailabilityDisplayType.'"':'';
                    $APISRequirementsRef=(isset($segment->APISRequirementsRef))?'APISRequirementsRef="'.$segment->APISRequirementsRef.'"':'';
               
					
					if(in_array($key, $exp_conn)){
						$connection_indc='<Connection/>';
					}else{
						$connection_indc='';
					}
 $AirSegmentPricingModifiers.='<AirSegmentPricingModifiers AirSegmentRef="'.$segment->AirSegment_Key.'" FareBasisCode="'.$segment->FareBasis.'" ></AirSegmentPricingModifiers>';
                     $CabinClass = (isset($segment->CabinClass)) ? 'CabinClass="' . $segment->CabinClass . '"' : '';
                    if($segment->ProviderCode=="ACH"){
                        $HostToken_content.='<common_v33_0:HostToken xmlns="http://www.travelport.com/schema/common_v33_0" Key="'.$segment->HostTokenRef.'">'.$HostTokencontent.'</common_v33_0:HostToken>';
                       
                        $segments .= '<AirSegment  ArrivalTime="'.$segment->ArrivalTime.'"  Carrier="'.$segment->Carrier.'"  ClassOfService="'.$segment->BookingCode.'" DepartureTime="'.$segment->DepartureTime.'" Destination="'.$segment->Destination.'" '.$Distance.'  '.$Equipment.' FlightNumber="'.$segment->FlightNumber.'" FlightTime="'.$segment->FlightTime.'" Group="'.$segment->Group.'" '.$HostTokenRef.' Key="'.$segment->AirSegment_Key.'"   Origin="'.$segment->Origin.'" ProviderCode="'.$segment->ProviderCode.'" '.$Status.' '.$SupplierCode.' ></AirSegment>';

                    }else{

                            $segments .= '<AirSegment  Key="'.$segment->AirSegment_Key.'" Group="'.$segment->Group.'" Carrier="'.$segment->Carrier.'" FlightNumber="'.$segment->FlightNumber.'" ProviderCode="'.$segment->ProviderCode.'" Origin="'.$segment->Origin.'" Destination="'.$segment->Destination.'" DepartureTime="'.$segment->DepartureTime.'" ArrivalTime="'.$segment->ArrivalTime.'" FlightTime="'.$segment->FlightTime.'" '.$Distance.' ClassOfService="'.$segment->BookingCode.'" '.$Equipment.' ChangeOfPlane="'.$segment->ChangeOfPlane.'" OptionalServicesIndicator="'.$segment->OptionalServicesIndicator.'" '.$AvailabilitySource.' '.$ParticipantLevel.' '.$PolledAvailabilityOption.' '.$AvailabilityDisplayType.' '.$ETicketability.' '.$LinkAvailability.'>
                            '.$CodeshareInfo.'
                            <AirAvailInfo ProviderCode="'.$segment->ProviderCode.'">
                                <BookingCodeInfo BookingCounts="'.$segment->BookingCounts.'"></BookingCodeInfo>
                            </AirAvailInfo>
                            <FlightDetails '.$Equipment.' '.$OriginTerminal.' '.$DestinationTerminal.' Destination="'.$segment->Destination.'" Origin="'.$segment->Origin.'" Key="'.$segment->FlightDetail_Key.'" FlightTime="'.$segment->FlightTime.'" ArrivalTime="'.$segment->ArrivalTime.'" DepartureTime="'.$segment->DepartureTime.'" ></FlightDetails>
                            '.$connection_indc.'
                          </AirSegment>';
                      }
       }
    }else if($request->type == 'M'){

$ssss=0;
        foreach ($flight->segments as $key => $segment) {

            if(in_array($ssss, $exp_conn)){
                        $connection_indc='<Connection/>';
                    }else{
                        $connection_indc='';
                    }

            //echo '<pre>';print_r($segment);die;
            if(!is_array($segment)){


                if(in_array($ssss, $exp_conn)){
                        $connection_indc='<Connection/>';
                    }else{
                        $connection_indc='';
                    }

            if($segment->OperatingFlightNumber != ''){
            	if($segment->OperatingCarrier!=''){
            		$op_carr='OperatingCarrier="'.$segment->OperatingCarrier.'"';
            	}else{
            		$op_carr='';
            	}
                $CodeshareInfo = '<CodeshareInfo "'.$op_carr.'" OperatingFlightNumber="'.$segment->OperatingFlightNumber.'" ></CodeshareInfo>';
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
                    $AvailabilitySource=(isset($segment->AvailabilitySource))?'AvailabilitySource="'.$segment->AvailabilitySource.'"':'';
                    $PolledAvailabilityOption=(isset($segment->PolledAvailabilityOption))?'PolledAvailabilityOption="'.$segment->PolledAvailabilityOption.'"':'';
                    $ParticipantLevel=(isset($segment->ParticipantLevel))?'ParticipantLevel="'.$segment->ParticipantLevel.'"':'';
                    $LinkAvailability=(isset($segment->LinkAvailability) && $segment->LinkAvailability!='')?'LinkAvailability="'.$segment->LinkAvailability.'"':'';
                    $Distance=(isset($segment->Distance))?'Distance="'.$segment->Distance.'"':'';
                    $AvailabilityDisplayType=(isset($segment->AvailabilityDisplayType))?'AvailabilityDisplayType="'.$segment->AvailabilityDisplayType.'"':'';
                    $APISRequirementsRef=(isset($segment->APISRequirementsRef))?'APISRequirementsRef="'.$segment->APISRequirementsRef.'"':'';
                    $AirSegmentPricingModifiers.='<AirSegmentPricingModifiers AirSegmentRef="'.$segment->AirSegment_Key.'" FareBasisCode="'.$segment->FareBasis.'" ></AirSegmentPricingModifiers>';
                    $CabinClass = (isset($segment->CabinClass)) ? 'CabinClass="' . $segment->CabinClass . '"' : '';

                    if($segment->ProviderCode=="ACH"){
                        $HostToken_content.='<common_v33_0:HostToken xmlns="http://www.travelport.com/schema/common_v33_0" Key="'.$segment->HostTokenRef.'">'.$HostTokencontent.'</common_v33_0:HostToken>';
                        
                    $segments .= '<AirSegment  ArrivalTime="'.$segment->ArrivalTime.'"  Carrier="'.$segment->Carrier.'"  ClassOfService="'.$segment->BookingCode.'" DepartureTime="'.$segment->DepartureTime.'" Destination="'.$segment->Destination.'" '.$Distance.'  '.$Equipment.' FlightNumber="'.$segment->FlightNumber.'" FlightTime="'.$segment->FlightTime.'" Group="'.$segment->Group.'" '.$HostTokenRef.' Key="'.$segment->AirSegment_Key.'"   Origin="'.$segment->Origin.'" ProviderCode="'.$segment->ProviderCode.'" '.$Status.' '.$SupplierCode.' ></AirSegment>';

                    }else{

            $segments .= '<AirSegment  Key="'.$segment->AirSegment_Key.'" Group="'.$segment->Group.'" Carrier="'.$segment->Carrier.'" FlightNumber="'.$segment->FlightNumber.'" ProviderCode="'.$segment->ProviderCode.'" Origin="'.$segment->Origin.'" Destination="'.$segment->Destination.'" DepartureTime="'.$segment->DepartureTime.'" ArrivalTime="'.$segment->ArrivalTime.'" FlightTime="'.$segment->FlightTime.'" '.$Distance.' ClassOfService="'.$segment->BookingCode.'" '.$Equipment.' ChangeOfPlane="'.$segment->ChangeOfPlane.'" OptionalServicesIndicator="'.$segment->OptionalServicesIndicator.'" '.$AvailabilitySource.' '.$ParticipantLevel.' '.$PolledAvailabilityOption.' '.$AvailabilityDisplayType.' '.$ETicketability.' '.$LinkAvailability.'>
                            '.$CodeshareInfo.'
                            <AirAvailInfo ProviderCode="'.$segment->ProviderCode.'">
                                <BookingCodeInfo BookingCounts="'.$segment->BookingCounts.'"></BookingCodeInfo>
                            </AirAvailInfo>
                            <FlightDetails '.$Equipment.' '.$OriginTerminal.' '.$DestinationTerminal.' Destination="'.$segment->Destination.'" Origin="'.$segment->Origin.'" Key="'.$segment->FlightDetail_Key.'" FlightTime="'.$segment->FlightTime.'" ArrivalTime="'.$segment->ArrivalTime.'" DepartureTime="'.$segment->DepartureTime.'" ></FlightDetails>
                          '.$connection_indc.'
                          </AirSegment>';
                      }
                     
                 $ssss++; }else{
                      $extra_segment=$segment;
                      $v=0; 
       foreach($extra_segment as $keys => $segment){


                      if(in_array($ssss, $exp_conn)){
                        $connection_indc='<Connection/>';
                    }else{
                        $connection_indc='';
                    }

            if($segment->OperatingFlightNumber != ''){
            	if($segment->OperatingCarrier!=''){
            		$op_carr='OperatingCarrier="'.$segment->OperatingCarrier.'"';
            	}else{
            		$op_carr='';
            	}
                $CodeshareInfo = '<CodeshareInfo "'.$op_carr.'" OperatingFlightNumber="'.$segment->OperatingFlightNumber.'" ></CodeshareInfo>';
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
                    $AvailabilitySource=(isset($segment->AvailabilitySource))?'AvailabilitySource="'.$segment->AvailabilitySource.'"':'';
                    $PolledAvailabilityOption=(isset($segment->PolledAvailabilityOption))?'PolledAvailabilityOption="'.$segment->PolledAvailabilityOption.'"':'';
                    $ParticipantLevel=(isset($segment->ParticipantLevel))?'ParticipantLevel="'.$segment->ParticipantLevel.'"':'';
                    $LinkAvailability=(isset($segment->LinkAvailability) && $segment->LinkAvailability!='')?'LinkAvailability="'.$segment->LinkAvailability.'"':'';
                    $Distance=(isset($segment->Distance))?'Distance="'.$segment->Distance.'"':'';
                    $AvailabilityDisplayType=(isset($segment->AvailabilityDisplayType))?'AvailabilityDisplayType="'.$segment->AvailabilityDisplayType.'"':'';
                    $APISRequirementsRef=(isset($segment->APISRequirementsRef))?'APISRequirementsRef="'.$segment->APISRequirementsRef.'"':'';
                     $AirSegmentPricingModifiers.='<AirSegmentPricingModifiers AirSegmentRef="'.$segment->AirSegment_Key.'" FareBasisCode="'.$segment->FareBasis.'" ></AirSegmentPricingModifiers>';
                    $CabinClass = (isset($segment->CabinClass)) ? 'CabinClass="' . $segment->CabinClass . '"' : '';
                    if($segment->ProviderCode=="ACH"){
                        $HostToken_content.='<common_v33_0:HostToken xmlns="http://www.travelport.com/schema/common_v33_0" Key="'.$segment->HostTokenRef.'">'.$HostTokencontent.'</common_v33_0:HostToken>';
                       
                   $segments .= '<AirSegment  ArrivalTime="'.$segment->ArrivalTime.'"  Carrier="'.$segment->Carrier.'"  ClassOfService="'.$segment->BookingCode.'" DepartureTime="'.$segment->DepartureTime.'" Destination="'.$segment->Destination.'" '.$Distance.'  '.$Equipment.' FlightNumber="'.$segment->FlightNumber.'" FlightTime="'.$segment->FlightTime.'" Group="'.$segment->Group.'" '.$HostTokenRef.' Key="'.$segment->AirSegment_Key.'"   Origin="'.$segment->Origin.'" ProviderCode="'.$segment->ProviderCode.'" '.$Status.' '.$SupplierCode.' ></AirSegment>';

                    }else{

                      
                    
            $segments .= '<AirSegment  Key="'.$segment->AirSegment_Key.'" Group="'.$segment->Group.'" Carrier="'.$segment->Carrier.'" FlightNumber="'.$segment->FlightNumber.'" ProviderCode="'.$segment->ProviderCode.'" Origin="'.$segment->Origin.'" Destination="'.$segment->Destination.'" DepartureTime="'.$segment->DepartureTime.'" ArrivalTime="'.$segment->ArrivalTime.'" FlightTime="'.$segment->FlightTime.'" '.$Distance.' ClassOfService="'.$segment->BookingCode.'" '.$Equipment.' ChangeOfPlane="'.$segment->ChangeOfPlane.'" OptionalServicesIndicator="'.$segment->OptionalServicesIndicator.'" '.$AvailabilitySource.' '.$ParticipantLevel.' '.$PolledAvailabilityOption.' '.$AvailabilityDisplayType.' '.$ETicketability.' '.$LinkAvailability.'>
                            '.$CodeshareInfo.'
                            <AirAvailInfo ProviderCode="'.$segment->ProviderCode.'">
                                <BookingCodeInfo BookingCounts="'.$segment->BookingCounts.'"></BookingCodeInfo>
                            </AirAvailInfo>
                            <FlightDetails '.$Equipment.' '.$OriginTerminal.' '.$DestinationTerminal.' Destination="'.$segment->Destination.'" Origin="'.$segment->Origin.'" Key="'.$segment->FlightDetail_Key.'" FlightTime="'.$segment->FlightTime.'" ArrivalTime="'.$segment->ArrivalTime.'" DepartureTime="'.$segment->DepartureTime.'" ></FlightDetails>
                           '.$connection_indc.'
                          </AirSegment>';
                      }
       $v++; $ssss++;}
                  }
        }
        
        }else if ($request->type == 'R') {
            
        foreach ($flight->onward->segments as $key => $segment) {
            //echo '<pre>';print_r($request);die;
            if($segment->OperatingFlightNumber != ''){
            	if($segment->OperatingCarrier!=''){
            		$op_carr='OperatingCarrier="'.$segment->OperatingCarrier.'"';
            	}else{
            		$op_carr='';
            	}
                
                $CodeshareInfo = '<CodeshareInfo "'.$op_carr.'" OperatingFlightNumber="'.$segment->OperatingFlightNumber.'" ></CodeshareInfo>';
                   
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
				     
				     if(in_array($key, $exp_conn)){
					$connection_indc='<Connection/>';
					}else{
					$connection_indc='';	
					} 
				
                    $Equipment=(isset($segment->Equipment))?'Equipment="'.$segment->Equipment.'"':'';
                    $ETicketability=(isset($segment->ETicketability))?'ETicketability="'.$segment->ETicketability.'"':'ETicketability=""';
                    $AvailabilitySource=(isset($segment->AvailabilitySource))?'AvailabilitySource="'.$segment->AvailabilitySource.'"':'';
                    $PolledAvailabilityOption=(isset($segment->PolledAvailabilityOption))?'PolledAvailabilityOption="'.$segment->PolledAvailabilityOption.'"':'';
                    $ParticipantLevel=(isset($segment->ParticipantLevel))?'ParticipantLevel="'.$segment->ParticipantLevel.'"':'';
                    $LinkAvailability=(isset($segment->LinkAvailability)  && $segment->LinkAvailability!='')?'LinkAvailability="'.$segment->LinkAvailability.'"':'';
                    $Distance=(isset($segment->Distance))?'Distance="'.$segment->Distance.'"':'';
                    $AvailabilityDisplayType=(isset($segment->AvailabilityDisplayType))?'AvailabilityDisplayType="'.$segment->AvailabilityDisplayType.'"':'';
                    $APISRequirementsRef=(isset($segment->APISRequirementsRef))?'APISRequirementsRef="'.$segment->APISRequirementsRef.'"':'';

$AirSegmentPricingModifiers1.='<AirSegmentPricingModifiers AirSegmentRef="'.$segment->AirSegment_Key.'" FareBasisCode="'.$segment->FareBasis.'" ></AirSegmentPricingModifiers>';
 $CabinClass = (isset($segment->CabinClass)) ? 'CabinClass="' . $segment->CabinClass . '"' : '';
                    if($segment->ProviderCode=="ACH"){
                        $HostToken_content1.='<common_v33_0:HostToken xmlns="http://www.travelport.com/schema/common_v33_0" Key="'.$segment->HostTokenRef.'">'.$HostTokencontent.'</common_v33_0:HostToken>';
                        
                    $segments .= '<AirSegment  ArrivalTime="'.$segment->ArrivalTime.'"  Carrier="'.$segment->Carrier.'"  ClassOfService="'.$segment->BookingCode.'" DepartureTime="'.$segment->DepartureTime.'" Destination="'.$segment->Destination.'" '.$Distance.'  '.$Equipment.' FlightNumber="'.$segment->FlightNumber.'" FlightTime="'.$segment->FlightTime.'" Group="'.$segment->Group.'" '.$HostTokenRef.' Key="'.$segment->AirSegment_Key.'"   Origin="'.$segment->Origin.'" ProviderCode="'.$segment->ProviderCode.'" '.$Status.' '.$SupplierCode.' ></AirSegment>';
                    
                    }else{
                        
                    
             $segments .= '<AirSegment  Key="'.$segment->AirSegment_Key.'" Group="'.$segment->Group.'" Carrier="'.$segment->Carrier.'" FlightNumber="'.$segment->FlightNumber.'" ProviderCode="'.$segment->ProviderCode.'" Origin="'.$segment->Origin.'" Destination="'.$segment->Destination.'" DepartureTime="'.$segment->DepartureTime.'" ArrivalTime="'.$segment->ArrivalTime.'" FlightTime="'.$segment->FlightTime.'" '.$Distance.' ClassOfService="'.$segment->BookingCode.'" '.$Equipment.' ChangeOfPlane="'.$segment->ChangeOfPlane.'" OptionalServicesIndicator="'.$segment->OptionalServicesIndicator.'" '.$AvailabilitySource.' '.$ParticipantLevel.' '.$PolledAvailabilityOption.' '.$AvailabilityDisplayType.' '.$ETicketability.' '.$LinkAvailability.'>
                            '.$CodeshareInfo.'
                            <AirAvailInfo ProviderCode="'.$segment->ProviderCode.'">
                                <BookingCodeInfo BookingCounts="'.$segment->BookingCounts.'"></BookingCodeInfo>
                            </AirAvailInfo>
                            <FlightDetails '.$Equipment.' '.$OriginTerminal.' '.$DestinationTerminal.' Destination="'.$segment->Destination.'" Origin="'.$segment->Origin.'" Key="'.$segment->FlightDetail_Key.'" FlightTime="'.$segment->FlightTime.'" ArrivalTime="'.$segment->ArrivalTime.'" DepartureTime="'.$segment->DepartureTime.'" ></FlightDetails>
                            '.$connection_indc.'
                          </AirSegment>';
                      }
        }
         
        foreach ($flight->return->segments as $key => $segment) {
			$tot_key=count($flight->onward->segments)+$key;
        			if(in_array($tot_key, $exp_conn)){
					$connection_indc='<Connection/>';
					}else{
					$connection_indc='';	
					}  

            //echo '<pre>';print_r($segment);die;
            if($segment->OperatingFlightNumber != ''){
                 if(!isset($segment->OperatingCarrier)){
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
                    $AvailabilitySource=(isset($segment->AvailabilitySource))?'AvailabilitySource="'.$segment->AvailabilitySource.'"':'';
                    $PolledAvailabilityOption=(isset($segment->PolledAvailabilityOption))?'PolledAvailabilityOption="'.$segment->PolledAvailabilityOption.'"':'';
                    $ParticipantLevel=(isset($segment->ParticipantLevel))?'ParticipantLevel="'.$segment->ParticipantLevel.'"':'';
                    $LinkAvailability=(isset($segment->LinkAvailability)  && $segment->LinkAvailability!='')?'LinkAvailability="'.$segment->LinkAvailability.'"':'';
                    $Distance=(isset($segment->Distance))?'Distance="'.$segment->Distance.'"':'';
                   $AvailabilityDisplayType=(isset($segment->AvailabilityDisplayType))?'AvailabilityDisplayType="'.$segment->AvailabilityDisplayType.'"':'';
                    $APISRequirementsRef=(isset($segment->APISRequirementsRef))?'APISRequirementsRef="'.$segment->APISRequirementsRef.'"':'';

            $CabinClass = (isset($segment->CabinClass)) ? 'CabinClass="' . $segment->CabinClass . '"' : '';
            $AirSegmentPricingModifiers2.='<AirSegmentPricingModifiers AirSegmentRef="'.$segment->AirSegment_Key.'" FareBasisCode="'.$segment->FareBasis.'" ></AirSegmentPricingModifiers>';
                    if($segment->ProviderCode=="ACH"){
                        $HostToken_content2.='<common_v33_0:HostToken xmlns="http://www.travelport.com/schema/common_v33_0" Key="'.$segment->HostTokenRef.'">'.$HostTokencontent.'</common_v33_0:HostToken>';
                        
                    //$segments .= '<AirSegment '.$APISRequirementsRef.' ArrivalTime="'.$segment->ArrivalTime.'"  Carrier="'.$segment->Carrier.'" ChangeOfPlane="'.$segment->ChangeOfPlane.'" ClassOfService="'.$segment->BookingCode.'" DepartureTime="'.$segment->DepartureTime.'" Destination="'.$segment->Destination.'" '.$Distance.' '.$ETicketability.' '.$Equipment.' FlightNumber="'.$segment->FlightNumber.'" FlightTime="'.$segment->FlightTime.'" Group="'.$segment->Group.'" '.$HostTokenRef.' Key="'.$segment->AirSegment_Key.'"  OptionalServicesIndicator="'.$segment->OptionalServicesIndicator.'" Origin="'.$segment->Origin.'" ProviderCode="'.$segment->ProviderCode.'" '.$Status.' '.$SupplierCode.' ></AirSegment>';
             $segments .= '<AirSegment  ArrivalTime="'.$segment->ArrivalTime.'"  Carrier="'.$segment->Carrier.'"  ClassOfService="'.$segment->BookingCode.'" DepartureTime="'.$segment->DepartureTime.'" Destination="'.$segment->Destination.'" '.$Distance.'  '.$Equipment.' FlightNumber="'.$segment->FlightNumber.'" FlightTime="'.$segment->FlightTime.'" Group="'.$segment->Group.'" '.$HostTokenRef.' Key="'.$segment->AirSegment_Key.'"   Origin="'.$segment->Origin.'" ProviderCode="'.$segment->ProviderCode.'" '.$Status.' '.$SupplierCode.' ></AirSegment>';
                    }else{
             $segments .= '<AirSegment  Key="'.$segment->AirSegment_Key.'" Group="'.$segment->Group.'" Carrier="'.$segment->Carrier.'" FlightNumber="'.$segment->FlightNumber.'" ProviderCode="'.$segment->ProviderCode.'" Origin="'.$segment->Origin.'" Destination="'.$segment->Destination.'" DepartureTime="'.$segment->DepartureTime.'" ArrivalTime="'.$segment->ArrivalTime.'" FlightTime="'.$segment->FlightTime.'" '.$Distance.' ClassOfService="'.$segment->BookingCode.'" '.$Equipment.' ChangeOfPlane="'.$segment->ChangeOfPlane.'" OptionalServicesIndicator="'.$segment->OptionalServicesIndicator.'" '.$AvailabilitySource.' '.$ParticipantLevel.' '.$PolledAvailabilityOption.' '.$AvailabilityDisplayType.' '.$ETicketability.' '.$LinkAvailability.'>
                            '.$CodeshareInfo.'
                            <AirAvailInfo ProviderCode="'.$segment->ProviderCode.'">
                                <BookingCodeInfo BookingCounts="'.$segment->BookingCounts.'"></BookingCodeInfo>
                            </AirAvailInfo>
                            <FlightDetails '.$Equipment.' '.$OriginTerminal.' '.$DestinationTerminal.' Destination="'.$segment->Destination.'" Origin="'.$segment->Origin.'" Key="'.$segment->FlightDetail_Key.'" FlightTime="'.$segment->FlightTime.'" ArrivalTime="'.$segment->ArrivalTime.'" DepartureTime="'.$segment->DepartureTime.'" ></FlightDetails>
                            '.$connection_indc.'
                          </AirSegment>';
                      }
        }
    }
    $paxId=0;
    $adults = '';
    if($request->ADT != 0){
        for ($i=0; $i < $request->ADT; $i++) { 
            $adults .= '<SearchPassenger BookingTravelerRef="'.$paxId.'" Code="ADT" xmlns="http://www.travelport.com/schema/common_v33_0" ></SearchPassenger>';
            $paxId++;
        }
    }
    $childs = '';
    if($request->CHD != 0){
        for ($i=0; $i < $request->CHD; $i++) { 
            $childs .= '<SearchPassenger BookingTravelerRef="'.$paxId.'" Code="CNN" Age="10" xmlns="http://www.travelport.com/schema/common_v33_0" ></SearchPassenger>';
            $paxId++;
        }
    }
    $infants = '';
    if($request->INF != 0){
        for ($i=0; $i < $request->INF; $i++) { 
            $infants .= '<SearchPassenger BookingTravelerRef="'.$paxId.'" Code="INF" Age="1" xmlns="http://www.travelport.com/schema/common_v33_0" ></SearchPassenger>';
            $paxId++;
        }
    }

//  echo '<pre/>';
//print_r($flight); print_r($flight_segments);exit;
//flight->PlatingCarrier
//$flight_segments[0]->PlatingCarrier
//echo 'naresh-'.$flight->PlatingCarrier;die;
    
    if($flight->PlatingCarrier != ''){
        $AirPricingModifiers = '<AirPricingModifiers PlatingCarrier="'.$flight->PlatingCarrier.'" ></AirPricingModifiers>';
    }else{
        $AirPricingModifiers = '';
    }

   

    $payment='';
     if($segment->ProviderCode=="ACH"){
            $payment='<FormOfPayment xmlns="http://www.travelport.com/schema/common_v33_0" Type="Credit">
          <CreditCard CVV="737" ExpDate="2016-06" Name="Veera K" Number="4111111111111111" Type="VI">
          <BillingAddress>
            <AddressName>Smiths</AddressName>
            <Street>14 Aurora Street</Street>
            <City>Sydney</City>
            <State>NSW</State>
            <PostalCode>2000</PostalCode>
            <Country>AU</Country>
          </BillingAddress>
        </CreditCard>
      </FormOfPayment>';

        $AirPricingModifiers='';
     }else{
         $payment='<FormOfPayment xmlns="http://www.travelport.com/schema/common_v33_0"  Type="Cash"/>';
     }

    $AirPriceReq = '<?xml version="1.0" encoding="utf-8"?>
    <s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">
        <s:Header>
            <Action s:mustUnderstand="1" xmlns="http://schemas.microsoft.com/ws/2005/05/addressing/none">http://localhost:8080/kestrel/AirService</Action>
        </s:Header>
        <s:Body xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
            <AirPriceReq TargetBranch="P2629804" xmlns="http://www.travelport.com/schema/air_v33_0" xmlns:common_v33_0="http://www.travelport.com/schema/common_v33_0">
                <BillingPointOfSaleInfo OriginApplication="UAPI" xmlns="http://www.travelport.com/schema/common_v33_0"></BillingPointOfSaleInfo>
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
                <AirPricingCommand '.$CabinClass.' >'.$AirSegmentPricingModifiers1.$AirSegmentPricingModifiers2.$AirSegmentPricingModifiers.'</AirPricingCommand>
               '.$payment.'
            </AirPriceReq>
        </s:Body>
    </s:Envelope>';

    $AirPriceRes = processRequest($AirPriceReq);
    $AirPriceReq_Res = array(
        'AirPriceReq' => $AirPriceReq,
        'AirPriceRes' => $AirPriceRes
    );
    
    /*echo $AirPriceReq;die;
     echo $AirPriceRes;die;*/
    $file = "XMLs/AirPriceReq.xml";
    prettyPrint($AirPriceReq,$file);
   	$file1 = "XMLs/AirPriceRes.xml";
    prettyPrint($AirPriceRes,$file1);
  
    return $AirPriceReq_Res;
}

function AirCreateReservationReq($cart_flight_data, $checkout_form, $cid,$passengers){
       //  echo "<pre>";
    //print_r(reset($cart_flight_data));die;
    $res=json_decode(base64_decode($cart_flight_data->response));
    $provider=reset($res->Farerulesref_Provider[0]);
    $passengers=json_decode(base64_decode($passengers));
   
    $AirItinerary_xml = $cart_flight_data->AirItinerary_xml;
    $AirPricingSolution_xml = $cart_flight_data->AirPricingSolution_xml;
    $request = json_decode(base64_decode($cart_flight_data->request));
   
    $AirItinerary_xml = str_replace("common_v33_0:",'',$AirItinerary_xml);
    $AirPricingSolution_xml = str_replace('common_v33_0:','',$AirPricingSolution_xml);
    
    $doc = new DOMDocument();
    $doc->loadXML($AirPricingSolution_xml);

     $domds= $doc;

    $OptionalServices = $domds->getElementsByTagName("OptionalServices");
    while ($OptionalServices->length > 0) {
         $node = $OptionalServices->item(0);
         remove_node($node);

    }

    $TaxDetail = $domds->getElementsByTagName("TaxDetail");
    while ($TaxDetail->length > 0) {
         $node = $TaxDetail->item(0);
         remove_node($node);

    }

 if($provider=="ACH"){  
    
$doc_ach = new DOMDocument();
$doc_ach->loadXML($AirItinerary_xml);

$HostToken = $doc_ach->getElementsByTagName("HostToken");

while ($HostToken->length > 0) {
$node = $HostToken->item(0);
remove_node($node);
}
$AirItinerary_xml = $doc_ach->saveXML();
$doc_ach->loadXML($AirItinerary_xml);

}

    $AirPricingSolution_xml = $doc->saveXML();
    $doc->loadXML($AirPricingSolution_xml);

    
    $array_sr=array('<AirItinerary>','</AirItinerary>','<?xml version="1.0"?>');
 $AirItinerary_xml = str_replace($array_sr,'',$AirItinerary_xml);
    $fragment = $doc->createDocumentFragment();
    $fragment->appendXML($AirItinerary_xml);              
    $AirPricingInfo  = $doc->getElementsByTagName("AirPricingInfo")->item(0);
    $doc->documentElement->insertBefore($fragment,$AirPricingInfo);  
        if($provider=="ACH"){                   
        $APISRequirements = $doc->getElementsByTagName("APISRequirements");
      while ($APISRequirements->length > 0) {
             $node = $APISRequirements->item(0);
             remove_node($node);
        }


       


        $AvailableSSR = $doc->getElementsByTagName("AvailableSSR");
      while ($AvailableSSR->length > 0) {
             $node = $AvailableSSR->item(0);
             remove_node($node);
        }


    }
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
    if($provider=="ACH"){ 
     //Only ACH
$AirPricingSolution_xml = preg_replace('/HostToken/','common_v33_0:HostToken',$AirPricingSolution_xml);
$AirPricingSolution_xml = preg_replace('/common_v33_0:HostTokenRef/','HostTokenRef',$AirPricingSolution_xml);
}
    
   
    
    //echo $checkout_form['street_address'];die;
    //echo '<pre>';print_r($checkout_form);die;
  
            $address = ''; $Payment_address = ''; $SSR_w_req = '';$SSR_m_req = ''; $SSR_req_adult='';$SSR_meals_req_adult='';
             $SSR_req_child=''; $SSR_meals_req_child=''; $SSR_req_infant=''; $SSR_meals_req_infant='';
            $LoyaltiCard='';$LoyaltiCard_adult='';$LoyaltiCard_child='';$LoyaltiCard_infant='';
                        $Payment_address='<AddressName>'.$checkout_form->street_address.'</AddressName>
                        <Street>'.$checkout_form->street_address.'</Street>
                        <City>'.$checkout_form->city.'</City>
                        <!--<State>_adultCO</State>-->
                        <PostalCode>'.$checkout_form->zip.'</PostalCode>
                        <Country>'.$checkout_form->country.'</Country>';

                        $address .= '<Address>
                        '.$Payment_address.'
                        </Address>';
            

        $adults = '';$prefix='';
        $fname="first_name"."$cid";
       // $mname="middle_name"."$cid";
        $lname="last_name"."$cid";
        $dob="txtdob"."$cid";
        $gender="selGender"."$cid";
         $ssr_w_request="wheelchair"."$cid";
         $ssr_m_request="meals"."$cid";

         $ffn_Car="ffnCarr"."$cid";
         $ffn_num="ffn"."$cid";
       // $mobile="mobile"."$cid";
        //$email="email"."$cid";
        $doba=explode("/",$checkout_form->$dob);
        $doba=array_reverse($doba);
         $doba=implode("-",$doba);
         if($provider=="ACH"){
                if(substr($checkout_form->$gender,0,1)=="F"){
                    $prefix='Prefix="Ms"';
                }else{
                   $prefix='Prefix="Mr"'; 
                }
            }
            

              if($checkout_form->$ssr_w_request!=null){
            $SSR_w_req.='<SSR  Status="NN" Type="'.$checkout_form->$ssr_w_request.'"/>';
            }
 if($checkout_form->$ssr_m_request!=null){
            $SSR_m_req.= '<SSR  Status="NN" Type="'.$checkout_form->$ssr_m_request.'"/>';
        }

if($checkout_form->$ffn_Car!=null && $checkout_form->$ffn_num!=null){
$LoyaltiCard.= '<LoyaltyCard  CardNumber="'.$checkout_form->$ffn_num.'" SupplierType="Air" SupplierCode="'.$checkout_form->$ffn_Car.'"/>';
}
        // $middle_name=($checkout_form->$mname!='')?'Middle="'.$checkout_form->$mname.'"':'';'.$middle_name.' 
 $adults .= '<BookingTraveler Key="0" TravelerType="ADT" DOB="'.$doba.'" Gender="'.substr($checkout_form->$gender,0,1).'" xmlns="http://www.travelport.com/schema/common_v33_0">
                            <BookingTravelerName '.$prefix.' First="'.$checkout_form->$fname.'"  Last="'.$checkout_form->$lname.'" ></BookingTravelerName>
                            <PhoneNumber Number="'.$checkout_form->mobile.'" Type="Mobile" ></PhoneNumber>
                            <Email EmailID="'.$checkout_form->email.'" Type="P" ></Email> 
                            '.$LoyaltiCard.'
                            '.$SSR_w_req.'  
                            '.$SSR_m_req.'  
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
                if($provider=="ACH"){
                if(substr($passengers->gender[$s]->$audlt,0,1)=="F"){
                    $prefix='Prefix="Ms"';
                }else{
                   $prefix='Prefix="Mr"'; 
                }
            }

        if($passengers->wheel_ssr[$s]->$audlt!=null){
        $SSR_req_adult.='<SSR  Status="NN" Type="'.$passengers->wheel_ssr[$s]->$audlt.'"/>';
        }

        if($passengers->meals_ssr[$s]->$audlt!=null){
        $SSR_meals_req_adult.='<SSR  Status="NN" Type="'.$passengers->meals_ssr[$s]->$audlt.'"/>';
        }

            if($checkout_form->ffn_Car[$s]->$audlt!=null && $checkout_form->ffn_num[$s]->$audlt!=null){
            $LoyaltiCard_adult.= '<LoyaltyCard  CardNumber="'.$checkout_form->ffn_num[$s]->$audlt.'" SupplierType="Air" SupplierCode="'.$checkout_form->ffn_Car[$s]->$audlt.'"/>';
            }

                //$Amiddle_name=($passengers->middle[$s]->$audlt!='')?'Middle="'.$passengers->middle[$s]->$audlt.'"':'';'.$Amiddle_name.'
            $adults .= '<BookingTraveler [$s]->$audltKey="'.$paxId.'" TravelerType="ADT" DOB="'.$doba.'" Gender="'.substr($passengers->gender[$s]->$audlt,0,1).'" xmlns="http://www.travelport.com/schema/common_v33_0">
                            <BookingTravelerName '.$prefix.' First="'.$passengers->first[$s]->$audlt.'"   Last="'.$passengers->last[$s]->$audlt.'" ></BookingTravelerName>
                            <PhoneNumber Number="'.$checkout_form->mobile.'" Type="Mobile" ></PhoneNumber>
                            <Email EmailID="'.$checkout_form->email.'" Type="P" ></Email>
                            '. $LoyaltiCard_adult.'
                            '.$SSR_req_adult.'
                            '.$SSR_meals_req_adult.'
                            '.$address.'
                             </BookingTraveler>';
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
         if($provider=="ACH"){
                if(substr($passengers->gender[$s]->$child,0,1)=="F"){
                    $prefix='Prefix="Ms"';
                }else{
                   $prefix='Prefix="Mr"'; 
                }
            }

            


             if($passengers->wheel_ssr[$s]->$child!=null){
        $SSR_req_child.='<SSR  Status="NN" Type="'.$passengers->wheel_ssr[$s]->$child.'"/>';
        }

        if($passengers->meals_ssr[$s]->$child!=null){
        $SSR_meals_req_child.='<SSR  Status="NN" Type="'.$passengers->meals_ssr[$s]->$child.'"/>';
        }

         if($checkout_form->ffn_Car[$s]->$child!=null && $checkout_form->ffn_num[$s]->$child!=null){
            $LoyaltiCard_child.= '<LoyaltyCard  CardNumber="'.$checkout_form->ffn_num[$s]->$child.'" SupplierType="Air" SupplierCode="'.$checkout_form->ffn_Car[$s]->$child.'"/>';
            }

         // $Cmiddle_name=($passengers->middle[$s]->$child!='')?'Middle="'.$passengers->middle[$s]->$child.'"':'';'.$Cmiddle_name.'
              $childs .= '<BookingTraveler Key="'.$paxId.'" TravelerType="CNN"   DOB="'.$dobc.'" Gender="'.substr($passengers->gender[$s]->$child,0,1).'" xmlns="http://www.travelport.com/schema/common_v33_0">
                            <BookingTravelerName '.$prefix.' First="'.$passengers->first[$s]->$child.'"  Last="'.$passengers->last[$s]->$child.'"  ></BookingTravelerName>
                            <PhoneNumber Number="'.$checkout_form->mobile.'" Type="Mobile" ></PhoneNumber>
                            <Email EmailID="'.$checkout_form->email.'" Type="P" ></Email>
                            '.$LoyaltiCard_child.'
                             '.$SSR_req_child.' 
                             '.$SSR_meals_req_child.' 
                             '.$address.' 
                               
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


                  if($passengers->wheel_ssr[$s]->$infant!=null){
        $SSR_req_infant.='<SSR  Status="NN" Type="'.$passengers->wheel_ssr[$s]->$infant.'"/>';
        }

        if($passengers->meals_ssr[$s]->$infant!=null){
        $SSR_meals_req_infant.='<SSR  Status="NN" Type="'.$passengers->meals_ssr[$s]->$infant.'"/>';
        }


                if($checkout_form->ffn_Car[$s]->$infant!=null && $checkout_form->ffn_num[$s]->$infant!=null){
            $LoyaltiCard_infant.= '<LoyaltyCard  CardNumber="'.$checkout_form->ffn_num[$s]->$infant.'" SupplierType="Air" SupplierCode="'.$checkout_form->ffn_Car[$s]->$infant.'"/>';
            }

               // $Imiddle_name=($passengers->middle[$s]->$infant!='')?'Middle="'.$passengers->middle[$s]->$infant.'"':'';'.$Imiddle_name.'
            $infants .= '<BookingTraveler Key="'.$paxId.'" TravelerType="INF" DOB="'.$dobi.'" Gender="'.substr($passengers->gender[$s]->$infant,0,1).'" xmlns="http://www.travelport.com/schema/common_v33_0">
                            <BookingTravelerName Prefix="Mstr" First="'.$passengers->first[$s]->$infant.'"  Last="'.$passengers->last[$s]->$infant.'" ></BookingTravelerName>
                            <PhoneNumber Number="'.$checkout_form->mobile.'" Type="Mobile" ></PhoneNumber>
                            <Email EmailID="'.$checkout_form->email.'" Type="P" ></Email>
                            '.$LoyaltiCard_infant.'
                             '.$SSR_req_infant.'
                            '.$SSR_meals_req_infant.' 
                             '.$address.'
                                 
                         </BookingTraveler>';
            $paxId++;
        }
    }

 /* $payment = '<FormOfPayment Type="MiscFormOfPayment"  xmlns="http://www.travelport.com/schema/common_v33_0">
              <MiscFormOfPayment Text="'.strtoupper(trim($checkout_form->$fname)).'" Category="Cash,Invoice" />
              </FormOfPayment>';  */

  if($provider=="1G"){
    $payment='<FormOfPayment xmlns="http://www.travelport.com/schema/common_v33_0"  Type="Cash"/>';
     $ActionStatus='<ActionStatus ProviderCode="'.$provider.'" TicketDate="T*" Type="ACTIVE" QueueCategory="01" xmlns="http://www.travelport.com/schema/common_v33_0" ></ActionStatus>';
}else{
    $payment='<FormOfPayment xmlns="http://www.travelport.com/schema/common_v33_0" Type="Credit">
        <CreditCard CVV="737" ExpDate="2016-06" Name="Veera K" Number="4111111111111111" Type="VI">
          <BillingAddress>
           '.$Payment_address.'
          </BillingAddress>
        </CreditCard>
      </FormOfPayment>';
      $ActionStatus='<ActionStatus ProviderCode="'.$provider.'" TicketDate="'.str_replace(" ", "T", date("Y-m-d H:m:s",strtotime("+ 5 Hours"))).'" Type="TAW"  xmlns="http://www.travelport.com/schema/common_v33_0" ></ActionStatus>';
}


    
 //echo $adults.$childs.$infants;die;
    // echo $infants;die;
    $AirCreateReservationReq = '<?xml version="1.0" encoding="utf-8"?>
    <s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">
                        <s:Header/>
                        <s:Body>
                            <univ:AirCreateReservationReq xmlns:common_v33_0="http://www.travelport.com/schema/common_v33_0" xmlns:univ="http://www.travelport.com/schema/universal_v33_0" TargetBranch="P2629804" xmlns="http://www.travelport.com/schema/air_v33_0" RetainReservation="Both">
                            <BillingPointOfSaleInfo  xmlns="http://www.travelport.com/schema/common_v33_0" OriginApplication="UAPI" ></BillingPointOfSaleInfo>
                            '.$adults.'
                            '.$childs.'
                            '.$infants.'
                           <ContinuityCheckOverride xmlns="http://www.travelport.com/schema/common_v33_0">YES</ContinuityCheckOverride>
                             '.$payment.'
                            '.$AirPricingSolution_xml.'
                            '.$ActionStatus.'
                            </univ:AirCreateReservationReq>
                        </s:Body>
                        </s:Envelope>';

                         
    $AirCreateReservationRes = processRequest($AirCreateReservationReq);
    $AirCreateReservationReq_Res = array(
        'AirCreateReservationReq' => $AirCreateReservationReq,
        'AirCreateReservationRes' => $AirCreateReservationRes
    );
	 /*echo $AirCreateReservationReq;
	echo $AirCreateReservationRes;die;die;*/
   
	$file="XMLs/AirCreateReservationReq.xml"; 
	prettyPrint($AirCreateReservationReq,$file);
	$file1="XMLs/AirCreateReservationRes.xml"; 
	prettyPrint($AirCreateReservationRes,$file1);
   // die;
    return $AirCreateReservationReq_Res;
}



function GdsQueuePlaceReq($ProviderLocatorCode){
    
 
$GdsQueuePlaceReq='<?xml version="1.0" encoding="utf-8"?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://www.travelport.com/schema/common_v34_0" xmlns:gds="http://www.travelport.com/schema/gdsQueue_v34_0" xmlns:univ="http://www.travelport.com/schema/universal_v34_0"> 
<soapenv:Header/>   
<soapenv:Body> 
<gds:GdsQueuePlaceReq AuthorizedBy="user" ProviderCode="1G" ProviderLocatorCode="'.$ProviderLocatorCode.'" PseudoCityCode="52GY" TargetBranch="P2629804" TraceId="trace">    
<com:BillingPointOfSaleInfo OriginApplication="UAPI"/>    
<com:QueueSelector Queue="52"/>   
</gds:GdsQueuePlaceReq>  
</soapenv:Body>
</soapenv:Envelope>';
$GdsQueuePlaceRsp = processRequest($GdsQueuePlaceReq,$service='Queue');
$file="XMLs/GdsQueuePlaceReq.xml"; 
prettyPrint($GdsQueuePlaceReq,$file);
$file1="XMLs/GdsQueuePlaceRsp.xml"; 
prettyPrint($GdsQueuePlaceRsp,$file1);
$GdsQueuePlaceReq_Res = array(
'GdsQueuePlaceReq' => $GdsQueuePlaceReq,
'GdsQueuePlaceRsp' => $GdsQueuePlaceRsp

);
    return $GdsQueuePlaceReq_Res;

}

function GdsEnterQueueReq($ProviderLocatorCode){
   

 $GdsEnterQueueReq='<?xml version="1.0" encoding="utf-8"?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
<soapenv:Header/>   <soapenv:Body>
<gds:GdsEnterQueueReq xmlns:com="http://www.travelport.com/schema/common_v34_0" xmlns:gds="http://www.travelport.com/schema/gdsQueue_v34_0" AuthorizedBy="user" ProviderCode="1G" ProviderLocatorCode="'.$ProviderLocatorCode.'" PseudoCityCode="52GY" TargetBranch="P2629804"> 
<com:BillingPointOfSaleInfo OriginApplication="UAPI"/> 
<com:QueueSelector Queue="52"/> 
</gds:GdsEnterQueueReq>
</soapenv:Body>
</soapenv:Envelope>';


   $GdsEnterQueueRsp = processRequest($GdsEnterQueueReq,$service='Queue');
  $file="XMLs/GdsEnterQueueReq.xml"; 
    prettyPrint($GdsEnterQueueReq,$file);
    $file1="XMLs/GdsEnterQueueRsp.xml"; 
    prettyPrint($GdsEnterQueueRsp,$file1);
 $GdsEnterQueueReq_Res = array(
        'GdsEnterQueueReq' => $GdsEnterQueueReq,
        'GdsEnterQueueRsp' => $GdsEnterQueueRsp
    );
    return $GdsEnterQueueReq_Res;
    }



function AirTicketingReq($AirPricingInfo_keys,$AirReservationLocatorCode){
    
 $AirTicketingReq='<?xml version="1.0" encoding="utf-8"?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"> 
<soapenv:Header/>  
<soapenv:Body>    
<air:AirTicketingReq xmlns:air="http://www.travelport.com/schema/air_v33_0" AuthorizedBy="user" BulkTicket="false" ReturnInfoOnFail="true" TargetBranch="P2629804" TraceId="trace">       
<com:BillingPointOfSaleInfo xmlns:com="http://www.travelport.com/schema/common_v33_0" OriginApplication="UAPI"/>     
<air:AirReservationLocatorCode>'.$AirReservationLocatorCode.'</air:AirReservationLocatorCode>';
$total_key=count($AirPricingInfo_keys);
if($total_key>0){
    foreach ($AirPricingInfo_keys as $AirPricingInfo_key) {

    $AirTicketingReq.='<air:AirPricingInfoRef Key="'.$AirPricingInfo_key.'"/>';
}
}
 $AirTicketingReq.='</air:AirTicketingReq></soapenv:Body></soapenv:Envelope>';

  $AirTicketingRsp = processRequest($AirTicketingReq);
  $file="XMLs/AirTicketingReq.xml"; 
    prettyPrint($AirTicketingReq,$file);
    $file1="XMLs/AirTicketingRsp.xml"; 
    prettyPrint($AirTicketingRsp,$file1);
 $AirTicketingReq_Res = array(
        'AirTicketingReq' => $AirTicketingReq,
        'AirTicketingRsp' => $AirTicketingRsp
    );
    return $AirTicketingReq_Res;
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
                    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:com="http://www.travelport.com/schema/common_v33_0" xmlns:univ="http://www.travelport.com/schema/universal_v33_0">
                       <soapenv:Header />
                       <soapenv:Body>
                          <univ:UniversalRecordCancelReq AuthorizedBy="user" TargetBranch="P2629804" TraceId="trace" UniversalRecordLocatorCode="'.$LocatorCode.'" Version="1">
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
    //$response = $response->children('http://schemas.xmlsoap.org/soap/envelope/')->Body->children("http://www.travelport.com/schema/air_v33_0");
     
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

function processRequest($requestData,$service=''){
	
   // max_allowed_packet=500M;
    $CI =& get_instance();
    $CI->load->model('flight_model');
     $CI->load->model('xml_model');
    $credentials = $CI->flight_model->get_api_credentials($service);

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
    // echo $response;exit;
    $error = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    // header("Content-type: text/xml");
    // print_r($response);die;  
    //$response = new SimpleXMLElement($response);
    //$response = $response->children('http://schemas.xmlsoap.org/soap/envelope/')->Body->children("http://www.travelport.com/schema/air_v33_0");
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
