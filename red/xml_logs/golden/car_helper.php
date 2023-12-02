<?php
defined('BASEPATH') OR exit('No direct script access allowed');

define('ACTIVITY_APIKEY', 'wydw5tykv7htwwjq6k84sahn');
define('ACTIVITY_SECRETKEY', 'szsZ4wN2vQ');
define('ENABLE_TEST', 'test.');
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

function PurchaseConfirmReqCartActivity($postData,$bookedData,$searchData,$indexs){
#echo "<pre>";print_r($postData);  die;
$answers = '';
if(!empty($postData['answers'])){
for ($a = 0; $a < count($postData['answers'][$indexs]); $a++)
                {
$answers .= '<answers>
<question code="'.$postData['questions_code'][$indexs][$a].'" required="true">
<text>'.$postData['questions'][$indexs][$a].'</text>
</question>
<answer>'.$postData['answers'][$indexs][$a].'</answer>
</answers>';
   
}
}
          $occupency = '';
    for ($j = 0; $j < $searchData['adult']; $j++)
      {
       $occupency .= '<paxes age = "30" name = "'.$postData['adultFname'][$indexs][$j].'" surname = "'.$postData['adultLname'][$indexs][$j].'" type = "ADULT"/>';
      }
            
            if(isset($searchData['child']) && $searchData['child'] > 0)
            {
                for ($k = 0; $k < $searchData['child']; $k++)
                { $kk=$searchData['adult']+$k+1;

                //$searchData['child_age'][0][$k]
               $occupency .= '<paxes age = "'.$postData['childage'][$indexs][$k].'" name = "'.$postData['childFname'][$indexs][$k].'" surname = "'.$postData['childLname'][$indexs][$k].'" type = "CHILD"/>';

                   
                   
                }
            }
      
   $PurchaseConfirmRQ='<?xml version="1.0" encoding="UTF-8"?>
<BookingCreditConfirmRequest platform="55">
    <activities>
        <from>'.$bookedData['DateFrom'].'</from>
        '.$occupency.'
        <preferedLanguage>en</preferedLanguage>
        <rateKey>'.$bookedData['rateKey'].'</rateKey>
        <serviceLanguage>en</serviceLanguage>
        <to>'.$bookedData['DateTo'].'</to>
       '.$answers.'
    </activities>
    <clientReference>Agency test</clientReference>
    <holder email = "testholder@hotelbeds.com" name = "TestHolder" surname = "Test" telephones = "123456789"/>
    <language>en</language>
</BookingCreditConfirmRequest>';



$Activity_apiKey = ACTIVITY_APIKEY;
$Activity_Secret = ACTIVITY_SECRETKEY;
$signature = hash("sha256", $Activity_apiKey.$Activity_Secret.time());
$endpoint = "https://api.".ENABLE_TEST."hotelbeds.com/activity-api/3.0/bookings";

  $file = "xml/PurchaseConfirmRQ_Activity.xml";
    prettyPrint($PurchaseConfirmRQ,$file);
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_RETURNTRANSFER => 1,
        #CURLOPT_PUT=>1,
        CURLOPT_POST=>1,
        CURLOPT_POSTFIELDS=> $PurchaseConfirmRQ,
        CURLOPT_ENCODING=> "gzip",
        CURLOPT_URL => $endpoint,
        CURLOPT_HTTPHEADER => ['Accept:application/xml' ,'Content-Type:application/xml' , 'Api-key:'.$Activity_apiKey.'', 'X-Signature:'.$signature.'']
        ));
         $PurchaseConfirmRS = curl_exec($curl);
       // echo curl_getinfo($curl, CURLINFO_HTTP_CODE);die;
#'X-HTTP-Method-Override: PUT',

  if (!curl_errno($curl)) {
    switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
      case 200:  # OK
      //$file = "xml/PurchaseConfirmRQ_Activity.xml";
    //prettyPrint($PurchaseConfirmRQ,$file);
    $file1 = "xml/PurchaseConfirmRS_Activity.xml";
    prettyPrint($PurchaseConfirmRS,$file1);
        break;
     
    }
  }
  curl_close($curl);
//  echo $PurchaseConfirmRQ;
//die;
return Read_Boookning_info_act($PurchaseConfirmRS);
           #return $PurchaseConfirmRS;
       

    
}



function transfer_availability($data){



        $occupency = '';
      if($data['child']>0){
          $child_age_=$data['child_age'][0];
        $occupency .= '<GuestList>';
        for($j=0;$j<count($child_age_);$j++)
        {
        $occupency .= '<Customer type="CH">
        <Age>'.$child_age_[$j].'</Age>
        <Name>Added Customer'.$j.'</Name>
        <LastName>Added Customer'.$j.'</LastName>
        </Customer>';
        }
        $occupency .= '</GuestList>';
      }
$sd=explode('/', $data['cin']);
 $sd =$sd[2].$sd[0].$sd[1];
if($data['trip_type']==2){
   $ed=explode('/', $data['cout']);
 $ed =$ed[2].$ed[0].$ed[1];
}
       $PickupLocation_=$data['hbeds_org_code'];$DestinationLocation_=$data['hbeds_dest_code'];
      $PickupType="ProductTransferTerminal";
	
      if(!ctype_digit($PickupLocation_) && strlen($PickupLocation_)>3){
      $PickupLocation=  '<Code>'.$PickupLocation_.'</Code>
      <DateTime date="'.$sd.'" time="'.$data['car_start_time'].'" />';
		  if($data['trip_type']==2){
		  $PickupLocationR=  '<Code>'.$PickupLocation_.'</Code>
		  <DateTime date="'.$ed.'" time="'.$data['car_start_time'].'" />';
		}
      }elseif(ctype_digit($PickupLocation_)){
      $PickupLocation=$PickupLocationR=  '<Code>'.$PickupLocation_.'</Code>';
      $PickupType="ProductTransferHotel";
      }else{
      $PickupLocation=  '<IATA>'.$PickupLocation_.'</IATA>
      <DateTime date="'.$sd.'" time="'.$data['car_start_time'].'" />';
    if($data['trip_type']==2){
    $PickupLocationR=  '<IATA>'.$PickupLocation_.'</IATA>
    <DateTime date="'.$ed.'" time="'.$data['car_start_time'].'" />';
    }
      }

      
      $DestinationType="ProductTransferTerminal";
      if(!ctype_digit($DestinationLocation_) && strlen($DestinationLocation_)>3){
        $DestinationLocation=  '<Code>'.$DestinationLocation_.'</Code>
        <DateTime date="'.$sd.'" time="'.$data['car_end_time'].'" />';
        if($data['trip_type']==2){
         $DestinationLocationR=  '<Code>'.$DestinationLocation_.'</Code>
        <DateTime date="'.$ed.'" time="'.$data['car_end_time'].'" />';
      }
      }elseif(ctype_digit($DestinationLocation_)){
        $DestinationLocation=$DestinationLocationR='<Code>'.$DestinationLocation_.'</Code>';
         $DestinationType=$DestinationTypeR="ProductTransferHotel";
      }else{
        $DestinationLocation=  '<IATA>'.$DestinationLocation_.'</IATA>
        <DateTime date="'.$sd.'" time="'.$data['car_end_time'].'" />';
        if($data['trip_type']==2){
        $DestinationLocationR=  '<IATA>'.$DestinationLocation_.'</IATA>
        <DateTime date="'.$ed.'" time="'.$data['car_end_time'].'" />';
      }
      }


 
 
$round='';
if($data['trip_type']==2){
   $ed=explode('/', $data['cout']);
 $ed =$ed[2].$ed[0].$ed[1];
  $round='<AvailData type="OUT">
 <ServiceDate date="'.$ed.'" time="'.$data['car_start_time'].'"/>
 <Occupancy>
 <AdultCount>'.$data['adult'].'</AdultCount>
 <ChildCount>'.$data['child'].'</ChildCount>
'.$occupency.'
 </Occupancy>
 <PickupLocation xsi:type="'.$DestinationType.'">
 '.$DestinationLocationR.'
 </PickupLocation>
 <DestinationLocation xsi:type="'.$PickupType.'">
 '.$PickupLocationR.'
 </DestinationLocation>
 </AvailData>';
}



      //TESTCHAINS

      $TransferValuedAvailRQ='<?xml version="1.0" encoding="UTF-8"?>
     <TransferValuedAvailRQ xsi:schemaLocation="http://www.hotelbeds.com/schemas/2005/06/messages ../xsd/TransferValuedAvailRQ.xsd" xmlns="http://www.hotelbeds.com/schemas/2005/06/messages" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" echoToken="Golden'.time().'car" sessionId="HTM'.time().'" version="2013/12">
    <Language>ENG</Language>
    <Credentials>
     <User>GOLDENEDGEUS262901</User>
         <Password>GOLDENEDGEUS262901</Password>
          <Platform>55</Platform>
    </Credentials>
    <ExtraParamList/>
 <AvailData type="IN">
 <ServiceDate date="'.$sd.'" time="'.$data['car_start_time'].'"/>
 <Occupancy>
 <AdultCount>'.$data['adult'].'</AdultCount>
 <ChildCount>'.$data['child'].'</ChildCount>
'.$occupency.'
 </Occupancy>
 <PickupLocation xsi:type="'.$PickupType.'">
 '.$PickupLocation.'
 </PickupLocation>
 <DestinationLocation xsi:type="'.$DestinationType.'">
   '.$DestinationLocation.'
 </DestinationLocation>
 </AvailData>
 '.$round.'
 <ReturnContents>Y</ReturnContents>
</TransferValuedAvailRQ>';

//echo $TransferValuedAvailRQ; exit;


#'.$data['hbeds_dest_code'].'




          $Url = 'http://testapi.interface-xml.com/appservices/http/FrontendService';
         	$CURL = curl_init();
            curl_setopt($CURL, CURLOPT_URL, $Url); 
            curl_setopt($CURL, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
            curl_setopt($CURL, CURLOPT_POST, 1); 
            curl_setopt($CURL, CURLOPT_POSTFIELDS, $TransferValuedAvailRQ); 
            curl_setopt($CURL, CURLOPT_HEADER, false);
            curl_setopt($CURL, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($CURL, CURLOPT_HTTPHEADER, array("Content-Type: text/xml; charset=UTF-8"));
            curl_setopt($CURL, CURLOPT_ENCODING, "gzip");
            curl_setopt($CURL, CURLOPT_RETURNTRANSFER, true);
             #$TransferValuedAvailRQ;
            $TransferValuedAvailRS = curl_exec($CURL);
            $file = "xml/TransferValuedAvailRQ.xml";
            prettyPrint($TransferValuedAvailRQ,$file);
            $file1 = "xml/TransferValuedAvailRS.xml";
            prettyPrint($TransferValuedAvailRS,$file1);

           return $TransferValuedAvailRS;
       

    
}




function car_ServiceReq($data,$type,$purchaseToken=false){
   $purchaseTokenAttr='';
if($type==1 && $data['searchData']['trip_type']==2){
$data['car_data']=$data['car_data']['oneway'];
$sd=explode('/', $data['searchData']['cin']);
 $sd =$sd[2].$sd[0].$sd[1];
}elseif ($type==2 && $data['searchData']['trip_type']==2) {
   $purchaseTokenAttr='purchaseToken="'.$purchaseToken.'"';
 $data['car_data']=$data['car_data']['return'];
  $ed=explode('/', $data['searchData']['cout']);
 $sd =$ed[2].$ed[0].$ed[1];
}else{
  $data['car_data']=$data['car_data']; 
  $sd=explode('/', $data['searchData']['cin']);
 $sd =$sd[2].$sd[0].$sd[1];
}

  $Contract_Name=$data['car_data']['Contract'];
   $Contract_IncomingOffice=$data['car_data']['IncomingOffice'];
  
#hbeds_org_code,hbeds_dest_code

 

  

      $occupency = '';
      if($data['searchData']['child']>0){
          $child_age_=$data['searchData']['child_age'][0];
        $occupency .= '<GuestList>';
        for($j=0;$j<count($child_age_);$j++)
        {
        $occupency .= '<Customer type="CH">
        <Age>'.$child_age_[$j].'</Age>
        <Name>Added Customer'.$j.'</Name>
        <LastName>Added Customer'.$j.'</LastName>
        </Customer>';
        }
        $occupency .= '</GuestList>';
      }

      $DATE_DATA='<DateFrom date="'.$data['car_data']['Date_From'].'" time="'.$data['car_data']['DateFrom_time'].'"/>';
 $DestinationType="ProductTransferTerminal";
      if(!ctype_digit($data['car_data']['DestinationLocation']['Code']) && strlen($data['car_data']['DestinationLocation']['Code'])>3){
        $DestinationLocation=  '<Code>'.$data['car_data']['DestinationLocation']['Code'].'</Code>
        <DateTime date="'.$sd.'" time="'.$data['searchData']['car_end_time'].'" />';
      }elseif(ctype_digit($data['car_data']['DestinationLocation']['Code'])){
        $DestinationLocation=  '<Code>'.$data['car_data']['DestinationLocation']['Code'].'</Code>';
         $DestinationType="ProductTransferHotel";
      }else{
        $DestinationLocation=  '<IATA>'.$data['car_data']['DestinationLocation']['Code'].'</IATA>
        <DateTime date="'.$sd.'" time="'.$data['searchData']['car_end_time'].'" />';
      }
 $PickupType="ProductTransferTerminal";
      if(!ctype_digit($data['car_data']['PickupLocation']['Code']) && strlen($data['car_data']['PickupLocation']['Code'])>3){
        $PickupLocation=  '<Code>'.$data['car_data']['PickupLocation']['Code'].'</Code>
        <DateTime date="'.$sd.'" time="'.$data['searchData']['car_start_time'].'" />';
      }elseif(ctype_digit($data['car_data']['PickupLocation']['Code'])){
        $PickupLocation=  '<Code>'.$data['car_data']['PickupLocation']['Code'].'</Code>';
        $PickupType="ProductTransferHotel";
      }else{
        $PickupLocation=  '<IATA>'.$data['car_data']['PickupLocation']['Code'].'</IATA>
        <DateTime date="'.$sd.'" time="'.$data['searchData']['car_start_time'].'" />';
      }



     $ServiceAddRQ_='<?xml version="1.0" encoding="UTF-8"?>
     <ServiceAddRQ xmlns="http://www.hotelbeds.com/schemas/2005/06/messages" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.hotelbeds.com/schemas/2005/06/messages ../xsd/ServiceAddRQ.xsd" echoToken="Golden'.time().'ssrf" '.$purchaseTokenAttr.' version="2013/12">
  <Language>ENG</Language>
    <Credentials>
    <User>GOLDENEDGEUS262901</User>
    <Password>GOLDENEDGEUS262901</Password>
     <Platform>55</Platform>
    </Credentials>
  <Service xsi:type="ServiceTransfer" availToken="'.$data['car_data']['availToken'].'" transferType="'.$data['car_data']['transferType'].'">
    <ContractList>
      <Contract>
        <Name>'.$Contract_Name.'</Name>
 <IncomingOffice code="'.$Contract_IncomingOffice.'"/>
      </Contract>
    </ContractList>
     '.$DATE_DATA.'
     <TransferInfo xsi:type="ProductTransfer">
      <Code>'.$data['car_data']['Code'].'</Code>
      <Type code="'.$data['car_data']['Type'].'"/>
      <VehicleType code="'.$data['car_data']['VehicleType'].'"/>
	</TransferInfo>
 	<Paxes>
      <AdultCount>'.$data['searchData']['adult'].'</AdultCount>
      <ChildCount>'.$data['searchData']['child'].'</ChildCount>
      '.$occupency.'
    </Paxes>
     <PickupLocation xsi:type="'.$PickupType.'">
           '.$PickupLocation.'
          </PickupLocation>
        <DestinationLocation xsi:type="'.$DestinationType.'">
         '.$DestinationLocation.'
       </DestinationLocation>
        </Service>
</ServiceAddRQ>'; 

$Url = 'http://testapi.interface-xml.com/appservices/http/FrontendService';
          $CURL = curl_init();
            curl_setopt($CURL, CURLOPT_URL, $Url); 
            curl_setopt($CURL, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
            curl_setopt($CURL, CURLOPT_POST, 1); 
            curl_setopt($CURL, CURLOPT_POSTFIELDS, $ServiceAddRQ_); 
            curl_setopt($CURL, CURLOPT_HEADER, false);
            curl_setopt($CURL, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($CURL, CURLOPT_HTTPHEADER, array("Content-Type: text/xml; charset=UTF-8"));
            curl_setopt($CURL, CURLOPT_ENCODING, "gzip");
            curl_setopt($CURL, CURLOPT_RETURNTRANSFER, true);
               $ServiceAddRS = curl_exec($CURL);
             //echo $ServiceAddRQ_;
            //die;

  $file = "xml/ServiceAddRQ_Transfer".$type.".xml";
    prettyPrint($ServiceAddRQ_,$file);
    $file1 = "xml/ServiceAddRS_Transfer".$type.".xml";
    prettyPrint($ServiceAddRS,$file1);

           return $ServiceAddRS;
       

    
}



function PurchaseConfirmReq($postData,$bookedData,$searchData,$details,$post_service_data,$RoundbookedData){
#echo "<pre>";print_r($post_service_data);die;
         $occupency = ''; $R_occupency = '';
          for ($j = 0; $j < $searchData['adult']; $j++)
            {
                $occupency .= '<Customer type="AD">
                                    <CustomerId>'.($j+1).'</CustomerId>
                                    <Age>45</Age>
                                    <Name>'.$postData['adultFname'][$j].'</Name>
                                    <LastName>'.$postData['adultLname'][$j].'</LastName>
                                </Customer>';
               

            }
            
            if(isset($searchData['child']) && $searchData['child'] > 0)
            {
                for ($k = 0; $k < $searchData['child']; $k++)
                { $kk=$searchData['adult']+$k+1;
                    $occupency .= '<Customer type="CH">
                                    <CustomerId>'.$kk.'</CustomerId>
                                    <Age>'.$searchData['child_age'][0][$k].'</Age>
                                    <Name>'.$postData['childFname'][$k].'</Name>
                                    <LastName>'.$postData['childLname'][$k].'</LastName>
                                </Customer>';
                   
                }
            }

              $adult_child=$searchData['adult']+$searchData['child'];
             for ($j = 0; $j < $searchData['adult']; $j++)
            {
                $R_occupency .= '<Customer type="AD">
                                    <CustomerId>'.($j+1+$adult_child).'</CustomerId>
                                    <Age>45</Age>
                                    <Name>'.$postData['adultFname'][$j].'</Name>
                                    <LastName>'.$postData['adultLname'][$j].'</LastName>
                                </Customer>';
               

            }
            
            if(isset($searchData['child']) && $searchData['child'] > 0)
            {
                for ($k = 0; $k < $searchData['child']; $k++)
                {   $kk=$adult_child+$searchData['adult']+$k+1;
                    $R_occupency .= '<Customer type="CH">
                                    <CustomerId>'.$kk.'</CustomerId>
                                    <Age>'.$searchData['child_age'][0][$k].'</Age>
                                    <Name>'.$postData['childFname'][$k].'</Name>
                                    <LastName>'.$postData['childLname'][$k].'</LastName>
                                </Customer>';
                   
                }
            }
        


$sd=explode('/', $searchData['cin']);
 $sd =$sd[2].$sd[0].$sd[1];
if($searchData['trip_type']==2){
$details_=$details['oneway'];
}else{
  $details_=$details; 
}

        /*<Document docIssueAuthority="Test" docIssueLocation="true" docID="Test" docType="Test" effectiveDate="20060606" expireDate="20180606">
                <DocHolderName>Test</DocHolderName>
                <DocLimitations>Test</DocLimitations>
            </Document>*/
$ServiceDetail=$bookedData['ServiceDetail'];
$round_tripreq = '';
if($searchData['trip_type']==2){
$ed=explode('/', $searchData['cout']);
$ed =$ed[2].$ed[0].$ed[1];
$ServiceDetail1=$RoundbookedData['ServiceDetail'];
$return_details=$details['return'];
#print_r($ServiceDetail1);die;
$round_tripreq.='<ServiceData xsi:type="ConfirmationServiceDataTransfer" SPUI="'.$ServiceDetail1->SPUI.'">
        <CustomerList>
        ' .$R_occupency.'
        </CustomerList>
         <ArrivalTravelInfo>
          <ArrivalInfo xsi:type="ProductTransferTerminal">
            <Code>'.(($return_details['ArrivalTravelInfo']['Code']!='')?$return_details['ArrivalTravelInfo']['Code']:$return_details['PickupLocation']['Code']).'</Code>
      <DateTime date="'.$ed.'" time="'.$searchData['car_start_time'].'"/>
          </ArrivalInfo>
            <TravelNumber>'.(($post_service_data['s-to-arrival-travelnumber']!='')?$post_service_data['s-to-arrival-travelnumber']:$post_service_data['s-to-departure-travelnumber']).'</TravelNumber>

          
        </ArrivalTravelInfo>
        <DepartureTravelInfo>
      <DepartInfo>
        <Code>'.(($return_details['DepartureTravelInfo']['Code']!='')?$return_details['DepartureTravelInfo']['Code']:$return_details['DestinationLocation']['Code']).'</Code>
        <DateTime date="'.$ed.'" time="'.$searchData['car_end_time'].'"/>
      </DepartInfo>
      <TravelNumber>'.$post_service_data['s-to-departure-travelnumber'].'</TravelNumber>
    </DepartureTravelInfo>
      </ServiceData>'; 
}


      $PurchaseConfirmRQ='<?xml version="1.0" encoding="UTF-8"?>
     <PurchaseConfirmRQ echoToken="Golden'.time().'ssrf" version="2013/12" xmlns="http://www.hotelbeds.com/schemas/2005/06/messages" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" >
  <Language>ENG</Language>
   <Credentials>
    <User>GOLDENEDGEUS262901</User>
    <Password>GOLDENEDGEUS262901</Password>
     <Platform>55</Platform>
    </Credentials>
  <ConfirmationData purchaseToken="'.$bookedData['purchaseToken'].'">
    <Holder type="AD">
     <CustomerId>Hldr</CustomerId>
      <Name>'.$postData["adultFname"][0].'</Name>
      <LastName>'.$postData["adultLname"][0].'</LastName>
    </Holder>
    <AgencyReference>Web123myne</AgencyReference>
    <ConfirmationServiceDataList>
      <ServiceData xsi:type="ConfirmationServiceDataTransfer" SPUI="'.$ServiceDetail->SPUI.'">
        <CustomerList>
        ' .$occupency.'
        </CustomerList>
         <ArrivalTravelInfo>
          <ArrivalInfo xsi:type="ProductTransferTerminal">
            <Code>'.(($details_['ArrivalTravelInfo']['Code']!='')?$details_['ArrivalTravelInfo']['Code']:$details_['PickupLocation']['Code']).'</Code>
      <DateTime date="'.$sd.'" time="'.$searchData['car_start_time'].'"/>
          </ArrivalInfo>
          <TravelNumber>'.$post_service_data['s-from-arrival-travelnumber'].'</TravelNumber>
        </ArrivalTravelInfo>
        <DepartureTravelInfo>
      <DepartInfo>
        <Code>'.(($details_['DepartureTravelInfo']['Code']!=null)?$details_['DepartureTravelInfo']['Code']:$details_['DestinationLocation']['Code']).'</Code>
        <DateTime date="'.$sd.'" time="'.$searchData['car_end_time'].'"/>
      </DepartInfo>
      <TravelNumber>'.(($post_service_data['s-from-departure-travelnumber']!='')?$post_service_data['s-from-departure-travelnumber']:$post_service_data['s-to-departure-travelnumber']).'</TravelNumber>
    </DepartureTravelInfo>
      </ServiceData>
      '.$round_tripreq.'
    </ConfirmationServiceDataList>
  </ConfirmationData>
</PurchaseConfirmRQ>';
#echo $PurchaseConfirmRQ;die;
$Url = 'http://testapi.interface-xml.com/appservices/http/FrontendService';
          $CURL = curl_init();
            curl_setopt($CURL, CURLOPT_URL, $Url); 
            curl_setopt($CURL, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
            curl_setopt($CURL, CURLOPT_POST, 1); 
            curl_setopt($CURL, CURLOPT_POSTFIELDS, $PurchaseConfirmRQ); 
            curl_setopt($CURL, CURLOPT_HEADER, false);
            curl_setopt($CURL, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($CURL, CURLOPT_HTTPHEADER, array("Content-Type: text/xml; charset=UTF-8"));
            curl_setopt($CURL, CURLOPT_ENCODING, "gzip");
            curl_setopt($CURL, CURLOPT_RETURNTRANSFER, true);
            $PurchaseConfirmRS = curl_exec($CURL);
             # echo $PurchaseConfirmRS;
            #die;

    $file = "xml/PurchaseConfirmRQ_Transfer.xml";
    prettyPrint($PurchaseConfirmRQ,$file);
    $file1 = "xml/PurchaseConfirmRS_Transfer.xml";
    prettyPrint($PurchaseConfirmRS,$file1);
    return Read_Boookning_info($PurchaseConfirmRS);
           #return $PurchaseConfirmRS;
       

    
}



function PurchaseConfirmReqCart($postData,$bookedData,$searchData,$details,$post_service_data,$RoundbookedData,$indexs){

		
		
         $occupency = ''; $R_occupency = '';
          for ($j = 0; $j < $searchData['adult']; $j++)
            {
                $occupency .= '<Customer type="AD">
                                    <CustomerId>'.($j+1).'</CustomerId>
                                    <Age>45</Age>
                                    <Name>'.$postData['adultFname'][$indexs][$j].'</Name>
                                    <LastName>'.$postData['adultLname'][$indexs][$j].'</LastName>
                                </Customer>';
               

            }
			
			
            
            if(isset($searchData['child']) && $searchData['child'] > 0)
            {
                for ($k = 0; $k < $searchData['child']; $k++)
                { $kk=$searchData['adult']+$k+1;
                    $occupency .= '<Customer type="CH">
                                    <CustomerId>'.$kk.'</CustomerId>
                                    <Age>'.$searchData['child_age'][0][$k].'</Age>
                                    <Name>'.$postData['childFname'][$indexs][$k].'</Name>
                                    <LastName>'.$postData['childLname'][$indexs][$k].'</LastName>
                                </Customer>';
                   
                }
            }
			
			

              $adult_child=$searchData['adult']+$searchData['child'];
             for ($j = 0; $j < $searchData['adult']; $j++)
            {
                $R_occupency .= '<Customer type="AD">
                                    <CustomerId>'.($j+1+$adult_child).'</CustomerId>
                                    <Age>45</Age>
                                    <Name>'.$postData['adultFname'][$indexs][$j].'</Name>
                                    <LastName>'.$postData['adultLname'][$indexs][$j].'</LastName>
                                </Customer>';
               

            }
			
            if(isset($searchData['child']) && $searchData['child'] > 0)
            {
                for ($k = 0; $k < $searchData['child']; $k++)
                {   $kk=$adult_child+$searchData['adult']+$k+1;
                    $R_occupency .= '<Customer type="CH">
                                    <CustomerId>'.$kk.'</CustomerId>
                                    <Age>'.$searchData['child_age'][0][$k].'</Age>
                                    <Name>'.$postData['childFname'][$indexs][$k].'</Name>
                                    <LastName>'.$postData['childLname'][$indexs][$k].'</LastName>
                                </Customer>';
                   
                }
            }
			
$sd=explode('/', $searchData['cin']);
 $sd =$sd[2].$sd[0].$sd[1];
if($searchData['trip_type']==2){
$details_=$details['oneway'];
}else{
  $details_=$details; 
}


        /*<Document docIssueAuthority="Test" docIssueLocation="true" docID="Test" docType="Test" effectiveDate="20060606" expireDate="20180606">
                <DocHolderName>Test</DocHolderName>
                <DocLimitations>Test</DocLimitations>
            </Document>*/
			
$ServiceDetail=$bookedData['ServiceDetail'];
$round_tripreq = '';
if($searchData['trip_type']==2){
$ed=explode('/', $searchData['cout']);
$ed =$ed[2].$ed[0].$ed[1];
$ServiceDetail1=$RoundbookedData['ServiceDetail'];
$return_details=$details['return'];

/* $round_tripreq.='<ServiceData xsi:type="ConfirmationServiceDataTransfer" SPUI="'.$ServiceDetail1->SPUI.'">
        <CustomerList>
        ' .$R_occupency.'
        </CustomerList>
         <ArrivalTravelInfo>
          <ArrivalInfo xsi:type="ProductTransferTerminal">
            <Code>'.(($return_details['ArrivalTravelInfo']['Code']!='')?$return_details['ArrivalTravelInfo']['Code']:$return_details['PickupLocation']['Code']).'</Code>
      <DateTime date="'.$ed.'" time="'.$searchData['car_start_time'].'"/>
          </ArrivalInfo>
          <TravelNumber>'.$post_service_data['s-to-arrival-travelnumber'].'</TravelNumber>
        </ArrivalTravelInfo>
        <DepartureTravelInfo>
      <DepartInfo>
        <Code>'.(($return_details['DepartureTravelInfo']['Code']!='')?$return_details['DepartureTravelInfo']['Code']:$return_details['DestinationLocation']['Code']).'</Code>
        <DateTime date="'.$ed.'" time="'.$searchData['car_end_time'].'"/>
      </DepartInfo>
      <TravelNumber>'.$post_service_data['s-to-departure-travelnumber'].'</TravelNumber>
    </DepartureTravelInfo>
      </ServiceData>';  */
	  
	  $round_tripreq.='<ServiceData xsi:type="ConfirmationServiceDataTransfer" SPUI="'.$ServiceDetail1->SPUI.'">
        <CustomerList>
        ' .$R_occupency.'
        </CustomerList>
         <ArrivalTravelInfo>
          <ArrivalInfo xsi:type="ProductTransferTerminal">
            <Code>'.(($return_details->ArrivalTravelInfo->Code!='')?$return_details->ArrivalTravelInfo->Code:$return_details->PickupLocation->Code).'</Code>
      <DateTime date="'.$ed.'" time="'.$searchData['car_start_time'].'"/>
          </ArrivalInfo>
           <TravelNumber>'.(($post_service_data['s-to-arrival-travelnumber']!='')?$post_service_data['s-to-arrival-travelnumber']:$post_service_data['s-to-departure-travelnumber']).'</TravelNumber>
        </ArrivalTravelInfo>
        <DepartureTravelInfo>
      <DepartInfo>
        <Code>'.(($return_details->DepartureTravelInfo->Code!='')?$return_details->DepartureTravelInfo->Code:$return_details->DestinationLocation->Code).'</Code>
        <DateTime date="'.$ed.'" time="'.$searchData['car_end_time'].'"/>
      </DepartInfo>
      <TravelNumber>'.$post_service_data['s-to-departure-travelnumber'].'</TravelNumber>
    </DepartureTravelInfo>
      </ServiceData>'; 
}


   if($searchData['trip_type']==2)
   {
       $PurchaseConfirmRQ='<?xml version="1.0" encoding="UTF-8"?>
     <PurchaseConfirmRQ echoToken="Golden'.time().'ssrf" version="2013/12" xmlns="http://www.hotelbeds.com/schemas/2005/06/messages" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" >
  <Language>ENG</Language>
   <Credentials>
    <User>GOLDENEDGEUS262901</User>
    <Password>GOLDENEDGEUS262901</Password>
     <Platform>55</Platform>
    </Credentials>
  <ConfirmationData purchaseToken="'.$bookedData['purchaseToken'].'">
    <Holder type="AD">
     <CustomerId>Hldr</CustomerId>
      <Name>'.$postData["adultFname"][$indexs][0].'</Name>
      <LastName>'.$postData["adultLname"][$indexs][0].'</LastName>
    </Holder>
    <AgencyReference>Web123myne</AgencyReference>
    <ConfirmationServiceDataList>
      <ServiceData xsi:type="ConfirmationServiceDataTransfer" SPUI="'.$ServiceDetail->SPUI.'">
        <CustomerList>
        ' .$occupency.'
        </CustomerList>
         <ArrivalTravelInfo>
          <ArrivalInfo xsi:type="ProductTransferTerminal">
            <Code>'.(($details_->ArrivalTravelInfo->Code!=null)?$details_->ArrivalTravelInfo->Code:$details_->PickupLocation->Code).'</Code>
      <DateTime date="'.$sd.'" time="'.$searchData['car_start_time'].'"/>
          </ArrivalInfo>
          <TravelNumber>'.$post_service_data['s-from-arrival-travelnumber'].'</TravelNumber>
        </ArrivalTravelInfo>
        <DepartureTravelInfo>
      <DepartInfo>
        <Code>'.(($details_->DepartureTravelInfo->Code!=null)?$details_->DepartureTravelInfo->Code:$details_->DestinationLocation->Code).'</Code>
        <DateTime date="'.$sd.'" time="'.$searchData['car_end_time'].'"/>
      </DepartInfo>
        <TravelNumber>'.(($post_service_data['s-from-departure-travelnumber']!='')?$post_service_data['s-from-departure-travelnumber']:$post_service_data['s-to-departure-travelnumber']).'</TravelNumber>
    </DepartureTravelInfo>
      </ServiceData>
      '.$round_tripreq.'
    </ConfirmationServiceDataList>
  </ConfirmationData>
</PurchaseConfirmRQ>';

   } else {
	   
	    $PurchaseConfirmRQ='<?xml version="1.0" encoding="UTF-8"?>
     <PurchaseConfirmRQ echoToken="Golden'.time().'ssrf" version="2013/12" xmlns="http://www.hotelbeds.com/schemas/2005/06/messages" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" >
  <Language>ENG</Language>
   <Credentials>
    <User>GOLDENEDGEUS262901</User>
    <Password>GOLDENEDGEUS262901</Password>
     <Platform>55</Platform>
    </Credentials>
  <ConfirmationData purchaseToken="'.$bookedData['purchaseToken'].'">
    <Holder type="AD">
     <CustomerId>Hldr</CustomerId>
      <Name>'.$postData["adultFname"][$indexs][0].'</Name>
      <LastName>'.$postData["adultLname"][$indexs][0].'</LastName>
    </Holder>
    <AgencyReference>Web123myne</AgencyReference>
    <ConfirmationServiceDataList>
      <ServiceData xsi:type="ConfirmationServiceDataTransfer" SPUI="'.$ServiceDetail->SPUI.'">
        <CustomerList>
        ' .$occupency.'
        </CustomerList>
         <ArrivalTravelInfo>
          <ArrivalInfo xsi:type="ProductTransferTerminal">
            <Code>'.(($details_['ArrivalTravelInfo']->Code!=null)?$details_['ArrivalTravelInfo']->Code:$details_['PickupLocation']->Code).'</Code>
      <DateTime date="'.$sd.'" time="'.$searchData['car_start_time'].'"/>
          </ArrivalInfo>
          <TravelNumber>'.$post_service_data['s-from-arrival-travelnumber'].'</TravelNumber>
        </ArrivalTravelInfo>
        <DepartureTravelInfo>
      <DepartInfo>
        <Code>'.(($details_['DepartureTravelInfo']->Code!=null)?$details_['DepartureTravelInfo']->Code:$details_['DestinationLocation']->Code).'</Code>
        <DateTime date="'.$sd.'" time="'.$searchData['car_end_time'].'"/>
      </DepartInfo>
      <TravelNumber>'.$post_service_data['s-from-departure-travelnumber'].'</TravelNumber>
    </DepartureTravelInfo>
      </ServiceData>
      '.$round_tripreq.'
    </ConfirmationServiceDataList>
  </ConfirmationData>
</PurchaseConfirmRQ>';

	   
   }

$Url = 'http://testapi.interface-xml.com/appservices/http/FrontendService';
          $CURL = curl_init();
            curl_setopt($CURL, CURLOPT_URL, $Url); 
            curl_setopt($CURL, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
            curl_setopt($CURL, CURLOPT_POST, 1); 
            curl_setopt($CURL, CURLOPT_POSTFIELDS, $PurchaseConfirmRQ); 
            curl_setopt($CURL, CURLOPT_HEADER, false);
            curl_setopt($CURL, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($CURL, CURLOPT_HTTPHEADER, array("Content-Type: text/xml; charset=UTF-8"));
            curl_setopt($CURL, CURLOPT_ENCODING, "gzip");
            curl_setopt($CURL, CURLOPT_RETURNTRANSFER, true);
            $PurchaseConfirmRS = curl_exec($CURL);
             # echo $PurchaseConfirmRS;
            #die;

    $file = "xml/PurchaseConfirmRQ_Transfer.xml";
    prettyPrint($PurchaseConfirmRQ,$file);
    $file1 = "xml/PurchaseConfirmRS_Transfer.xml";
    prettyPrint($PurchaseConfirmRS,$file1);
    return Read_Boookning_info($PurchaseConfirmRS);
           #return $PurchaseConfirmRS;
       

    
}






      function ServiceAddRS_Rsp_Pharse($response,$type){

          $ci =& get_instance();
          $ci->load->library('xml_to_array');
           $PurchaseDetail=array();
          $result=$ci->xml_to_array->XmlToArray($response);
if(isset($result['ErrorList']['Error'])){
            $PurchaseDetail['ErrorList']=$result['ErrorList']['Error'];
        }

         
        if(isset($result['Purchase']) && !empty($result['Purchase'])){
        $PurchaseTicket=$result['Purchase'];
            $PurchaseDetail['Status']=$PurchaseTicket['Status'];
               $PurchaseDetail['purchaseToken']=$PurchaseTicket['@attributes']['purchaseToken'];
            $PurchaseDetail['Agency_Code']=$PurchaseTicket['Agency']['Code'];
            $PurchaseDetail['Agency_Branch']=$PurchaseTicket['Agency']['Branch'];
             $PurchaseDetail['Language']=$PurchaseTicket['Language'];
             
              $PurchaseDetail['TotalPrice']=$PurchaseTicket['TotalPrice'];
              $PurchaseDetail['PendingAmount']=$PurchaseTicket['PendingAmount'];
          

          
 $PurchaseDetail['Currency']=isset($PurchaseTicket['Currency']['@attributes']['code'])?$PurchaseTicket['Currency']['@attributes']['code']:'';
 if(isset($PurchaseTicket['PaymentData'])){
 $PurchaseDetail['PaymentData']['PaymentType']=$PurchaseTicket['PaymentData']['PaymentType']['@attributes']['code'];
           $PurchaseDetail['PaymentData']['Description']=$PurchaseTicket['PaymentData']['Description'];
}
 $ServiceDetail=array();
if(isset($PurchaseTicket['ServiceList']['Service']) && is_array($PurchaseTicket['ServiceList']['Service'])){
 $ServiceTicket_=$PurchaseTicket['ServiceList']['Service'];
          if($type==2){
             $ServiceTicket_=$PurchaseTicket['ServiceList']['Service'][1];
          # echo "<pre>";print_r($ServiceTicket_);die; 
          }


        $ServiceDetail['Status']=$ServiceTicket_['Status'];
        $ServiceDetail['SPUI']=$ServiceTicket_['@attributes']['SPUI'];
             $ServiceDetail['transferType']=$ServiceTicket_['@attributes']['transferType'];
        $ServiceDetail['Supplier']=$ServiceTicket_['Supplier']['@attributes']['name'];

          $ServiceDetail['DateFrom']=$ServiceTicket_['DateFrom']['@attributes']['date'];
            $ServiceDetail['DateTo']=isset($ServiceTicket_['DateTo']['@attributes']['date'])?$ServiceTicket_['DateTo']['@attributes']['date']:'';

        $ServiceDetail['vatNumber']=$ServiceTicket_['Supplier']['@attributes']['vatNumber'];
        $ServiceDetail['Currency']=$ServiceTicket_['Currency']['@attributes']['code'];
         $ServiceDetail['TotalAmount']=$ServiceTicket_['TotalAmount'];
           $ServiceDetail['NetPrice']=isset($ServiceTicket_['NetPrice'])?$ServiceTicket_['NetPrice']:'';
           if(isset($ServiceTicket_['CommentList'])){
             $CommentList=$ServiceTicket_['CommentList'];
        $ServiceDetail['CommentList']=$CommentList['Comment']['@content'];
           }
       
            $ContractList=$ServiceTicket_['ContractList'];
         $ServiceDetail['Contract_Name']=$ContractList['Contract']['Name'];
        $ServiceDetail['IncomingOffice']=$ContractList['Contract']['IncomingOffice']['@attributes']['code'];

 if(isset($ServiceTicket_['Transferinfo'])){
  $TicketInfo_=$ServiceTicket_['TicketInfo'];
         $DestinationArr['Code']=$TicketInfo_['Code'];
        $DestinationArr['Name']=$TicketInfo_['Name'];
        $DestinationArr['Destination']=$TicketInfo_['Destination']['Name'];
        $DestinationArr['Destination_Code']=$TicketInfo_['Destination']['@attributes']['code'];
        $ServiceDetail['Destination']=$DestinationArr;
      }
         if(isset($ServiceTicket_['SupplementList'])){
        $SupplementList=$ServiceTicket_['SupplementList'];
      
        $SupplementListArr=array('Amount' =>isset($SupplementList['Price']['Amount'])?$SupplementList['Price']['Amount']:$SupplementList['Amount'],
        'DateTimeFrom' =>isset($SupplementList['Price']['DateTimeFrom'])?$SupplementList['Price']['DateTimeFrom']['@attributes']['date']:$SupplementList['DateTimeFrom']['@attributes']['date'],
        'DateTimeTo' =>isset($SupplementList['Price']['DateTimeTo'])?$SupplementList['Price']['DateTimeTo']['@attributes']['date']:$SupplementList['DateTimeTo']['@attributes']['date'],
        'Description' =>isset($SupplementList['Price']['Description'])?$SupplementList['Price']['Description']:'',
        'unitCount' =>isset($SupplementList['Price'])?$SupplementList['Price']['@attributes']['unitCount']:'',
        'paxCount' =>isset($SupplementList['Price'])?$SupplementList['Price']['@attributes']['paxCount']:''
        );
         $ServiceDetail['SupplementList']=$SupplementListArr;
      }


       if(isset($ServiceTicket_['ServiceExtraInfoList'])){
        $ServiceDetail['ServiceExtraInfoList']=$ServiceTicket_['ServiceExtraInfoList']['ExtendedData'];

      }
          

     



        $CancellationPolicy_=array();
    if(isset($ServiceTicket_['CancellationPolicies'])){
        $CancellationPolicy=$ServiceTicket_['CancellationPolicies']['CancellationPolicy'];


        if(isset($CancellationPolicy) && array_key_exists(0, $CancellationPolicy)){
        $CancellationPolicyAr=$CancellationPolicy;

        }else{
        
             $CancellationPolicyAr=array(0=>$CancellationPolicy);
           
       
        }
 #echo "<pre>";print_r($CancellationPolicyAr);die;
        $policy=0; 
        foreach ($CancellationPolicyAr as $CancellationPolicyKey => $CancellationPolicyvalue) {

        $CancellationPolicy_[$policy]=(isset($CancellationPolicyvalue['@attributes']))?$CancellationPolicyvalue['@attributes']:array();
        $policy++;

        }

      }

 $ServiceDetail['CancellationPolicy']=$CancellationPolicy_;
$AdditionalCostList_=array();
 if(isset($ServiceTicket_['AdditionalCostList'])){
        $AdditionalCostList=$ServiceTicket_['AdditionalCostList']['AdditionalCost'];
        $cost=0; 
        foreach ($AdditionalCostList as $AdditionalCostListKey => $AdditionalCostListvalue) {
          //echo "<pre>";print_r($AdditionalCostListvalue);
        $AdditionalCostList_[$cost]=array('Amount' =>isset($AdditionalCostListvalue['Price']['Amount'])?$AdditionalCostListvalue['Price']['Amount']:$AdditionalCostListvalue,
        'type' =>isset($AdditionalCostListvalue['@attributes'])?$AdditionalCostListvalue['@attributes']['type']:$AdditionalCostListvalue);
        $cost++;

        }

      }

            $ServiceDetail['AdditionalCostList']=$AdditionalCostList_;
}


if(isset($ServiceTicket_['TransferWebInformation'])){
  $PurchaseDetail['TransferWebInformation']= $ServiceTicket_['TransferWebInformation'];
$PurchaseDetail['TimeBeforeConsultingWeb']= $ServiceTicket_['TimeBeforeConsultingWeb'];
}

if(isset($ServiceTicket_['TransferPickupTime'])){
  $PurchaseDetail['TransferPickupTime']= $ServiceTicket_['TransferPickupTime']['@attributes'];

}


            $PurchaseDetail['ServiceDetail']= $ServiceDetail;


    

}
 #echo "<pre>";print_r($PurchaseDetail);die;
return $PurchaseDetail;
      }






   function Read_Boookning_info($response){
    

          $ci =& get_instance();
          $ci->load->library('xml_to_array');
          $XmlRes = $ci->xml_to_array->XmlToArray($response);
          $Booking=array();$DiscountList=array();$CommentList=array();
        if(isset($XmlRes['ErrorList']['Error'])){
            $Booking['ErrorList']=$XmlRes['ErrorList']['Error'];
        }
        
        

            if(isset($XmlRes['Purchase'])){
            $PurchaseDetails=$XmlRes['Purchase'];
            $ServiceListDetails=isset($XmlRes['Purchase']['ServiceList']['Service'][0])?$XmlRes['Purchase']['ServiceList']['Service'][0]:$XmlRes['Purchase']['ServiceList']['Service'];

            $RoundServiceListDetails=isset($XmlRes['Purchase']['ServiceList']['Service'][1])?$XmlRes['Purchase']['ServiceList']['Service'][1]:array();
            #$HotelInfo=$ServiceListDetails['TicketInfo'];
            #$AvailableRoom=$ServiceListDetails['AvailableModality'];


          

            
           if(isset($PurchaseDetails['@attributes']['purchaseToken'])){
            $Booking['purchaseToken'] = $PurchaseDetails['@attributes']['purchaseToken'];
            }else{
                $Booking['purchaseToken']='';
            }

            if(isset($PurchaseDetails['Status'])){
            $Booking['Status'] = $PurchaseDetails['Status'];
            }else{
                $Booking['Status']='';
            }
               if(isset($ServiceListDetails['Status'])){
            $Booking['Status_'] = $ServiceListDetails['Status'];
            }else{
                $Booking['Status_']='';
            }

             if(isset($RoundServiceListDetails['Status'])){
            $Booking['RoundStatus_'] = $RoundServiceListDetails['Status'];
            }else{
                $Booking['RoundStatus_']='';
            }

             if(isset($ServiceListDetails['Reference']['FileNumber'])){
            $Booking['FileNumber_'] = $ServiceListDetails['Reference']['FileNumber'];
            }else{
            $Booking['FileNumber_']='';
            }

             if(isset($RoundServiceListDetails['Reference']['FileNumber'])){
            $Booking['RoundFileNumber_'] = $RoundServiceListDetails['Reference']['FileNumber'];
            }else{
            $Booking['RoundFileNumber_']='';
            }

            
             if(isset($ServiceListDetails['Supplier'])){
            $Booking['Supplier'] = $ServiceListDetails['Supplier']['@attributes']['name'];
            }else{
            $Booking['Supplier']='';
            }

if(isset($RoundServiceListDetails['Supplier'])){
            $Booking['RoundSupplier'] = $RoundServiceListDetails['Supplier']['@attributes']['name'];
            }else{
            $Booking['RoundSupplier']='';
            }


            if(isset($ServiceListDetails['Supplier'])){
            $Booking['vatNumber'] = $ServiceListDetails['Supplier']['@attributes']['vatNumber'];
            }else{
            $Booking['vatNumber']='';
            }

             if(isset($RoundServiceListDetails['Supplier'])){
            $Booking['RoundvatNumber'] = $RoundServiceListDetails['Supplier']['@attributes']['vatNumber'];
            }else{
            $Booking['RoundvatNumber']='';
            }

            if(isset($PurchaseDetails['TotalPrice'])){
            $Booking['TotalPrice'] = $PurchaseDetails['TotalPrice'];
            }else{
            $Booking['TotalPrice']=$ServiceListDetails['TotalAmount'];
                
            }

           

            $Currency=$ServiceListDetails['Currency']['@attributes']['code'];
            $Booking['Currency']=$Currency;
            if(isset($PurchaseDetails['Language'])){
            $Booking['Language'] = $PurchaseDetails['Language'];
            }else{
                $Booking['Language']='';
            }


            if(isset($PurchaseDetails['Reference']['FileNumber'])){
            $Booking['FileNumber'] = $PurchaseDetails['Reference']['FileNumber'];
            }else{
            $Booking['FileNumber']='';
            }

            if(isset($PurchaseDetails['Reference']['IncomingOffice'])){
            $Booking['IncomingOffice'] = $PurchaseDetails['Reference']['IncomingOffice']['@attributes']['code'];
            }else{
            $Booking['IncomingOffice']='';
            }
            

            if(isset($PurchaseDetails['CreationDate']['@attributes'])){
            $Booking['CreationDate'] = $PurchaseDetails['CreationDate']['@attributes']['date'];
            }else{
                $Booking['CreationDate']='';
            }

            if(isset($ServiceListDetails['Status'])){
            $Booking['Service_Status'] = $PurchaseDetails['Status'];
            }else{
            $Booking['Service_Status']='';
                
            }



            $CommentList=array();

            if(isset($ServiceListDetails['ContractList']['Contract']['CommentList'])){
            $CommentListDetails=$ServiceListDetails['ContractList']['Contract']['CommentList'];

            foreach ($CommentListDetails as $Comment => $Comment_value) {
            $CommentList[]=array($Comment_value['@attributes']['type']=>$Comment_value['@content']);
            }
            
            }elseif ($ServiceListDetails['CommentList']['Comment']) {
             $CommentList[]=array($ServiceListDetails['CommentList']['Comment']['@attributes']['type']=>$ServiceListDetails['CommentList']['Comment']['@content']);
            }
            $Booking['CommentList']=$CommentList;
            

            
               
                


               

          



                 $CancellationPolicy_=array();
    if(isset($ServiceListDetails['CancellationPolicies'])){
        $CancellationPolicy=$ServiceListDetails['CancellationPolicies']['CancellationPolicy'];


        if(isset($CancellationPolicy) && array_key_exists(0, $CancellationPolicy)){
        $CancellationPolicyAr=$CancellationPolicy;

        }else{
         $CancellationPolicyAr=array(0=>$CancellationPolicy);
           
       
        }

    
 $policy=0;
        foreach ($CancellationPolicyAr as $CancellationPoliciesvalue) {
          
                $CancellationPolicy_[$policy]=array('amount'=>($CancellationPoliciesvalue['@attributes']['amount']),
                 'dateFrom'=>$CancellationPoliciesvalue['@attributes']['dateFrom'],
                
                'time'=>$CancellationPoliciesvalue['@attributes']['time']
                );
               
             $policy++;    
         }

      }

 $Booking['CancellationPolicy']=$CancellationPolicy_;

   if(isset($RoundServiceListDetails['TransferWebInformation'])){
  $Booking['Return_TransferWebInformation']= $RoundServiceListDetails['TransferWebInformation'];
$Booking['Return_TimeBeforeConsultingWeb']= $RoundServiceListDetails['TimeBeforeConsultingWeb'];
}


if(isset($ServiceListDetails['TransferWebInformation'])){
  $Booking['TransferWebInformation']= $ServiceListDetails['TransferWebInformation'];
$Booking['TimeBeforeConsultingWeb']= $ServiceListDetails['TimeBeforeConsultingWeb'];
}

if(isset($ServiceListDetails['TransferPickupTime'])){
  $Booking['TransferPickupTime']= $ServiceListDetails['TransferPickupTime']['@attributes'];

}

if(isset($RoundServiceListDetails['TransferPickupTime'])){
  $Booking['Return_TransferPickupTime']= $RoundServiceListDetails['TransferPickupTime']['@attributes'];

}

                

            # echo '<pre>';print_r($Booking);die;

        }
            return   $Booking;

  
}


if(!function_exists('array_column')){
  function array_column($array,$colname,$Indexkey=''){
    $return_array = array();
    if(is_array($array) || is_object($array)){
      foreach($array as $arrayDATA){
        if(is_object($arrayDATA)){
          if(isset($arrayDATA->{$colname})){
            if(isset($Indexkey) && isset($arrayDATA->{$Indexkey}) ){
              $return_array[$arrayDATA->{$Indexkey}] = $arrayDATA->{$colname};
            } else {
              $return_array[] = $arrayDATA->{$colname};
            }
          }
        } else if(is_array($arrayDATA)) {
          if(isset($arrayDATA[$colname])){
            if(isset($Indexkey) && isset($arrayDATA[$Indexkey]) ){
              $return_array[$arrayDATA[$Indexkey]] = $arrayDATA[$colname];  
            } else {
              $return_array[] = $arrayDATA[$colname]; 
            } 
          } 
        }     
      }
    } 
    return $return_array;
  }
}




function multi_in_array($value, $array) 
{ 
    foreach ($array AS $item) 
    { 
        if (!is_array($item)) 
        { 
            if ($item == $value) 
            { 
                return true; 
            } 
            continue; 
        } 

        if (in_array($value, $item)) 
        { 
            return true; 
        } 
        else if (multi_in_array($value, $item)) 
        { 
            return true; 
        } 
    } 
    return false; 
} 


function myfunction($products, $type, $value)
{


   foreach($products as $key => $product)
   {


      if ($product[$type]['Contract'] == trim($value)){
       return (string)$key;
      }
         
   }
   return false;
}

function transfer_roundtrip($a){
$c=[];
$lastElm=count($a)-1;

foreach($a as $key => $value){
  if($value['transferType']=='TER') {
    if(!multi_in_array($value['Contract'], $c)) {
    $c[$key]['oneway']=$value;
    }else{
     $c[$key-count($c)]['return']=$value;
    }

}elseif($a[0]['transferType']=='IN' && $a[$lastElm]['transferType']=='IN'){

    if(!multi_in_array($value['Contract'], $c)) {
    $c[$key]['oneway']=$value;
    }else{
     $c[$key-count($c)]['return']=$value;
    }
  
}else{
/*if($a[0]['transferType']=='IN' && $a[$lastElm]['transferType']=='OUT') { //Terminal to Hotel
   if(!multi_in_array($value['Contract'], $c) && $value['transferType']!='OUT') {
      $c[$key]['oneway']=$value;
    }else{
      if ($value['transferType']!='IN'){
       $find_key=myfunction($c,'oneway',trim($value['Contract']));
      if($find_key!='')
       $c[$find_key]['return']=$value;
    }
    }
}else{

   if(!multi_in_array($value['Contract'], $c) && $value['transferType']!='IN') {
    $c[$key]['oneway']=$value;
    }else{
    if ($value['transferType']!='OUT'){
 $find_key=myfunction($c,'oneway',trim($value['Contract']));
    if($find_key!='')
      $c[$find_key]['return']=$value;
   
   
    }
    }

}*/
}
}
  #echo "<pre>";print_r($c);die;
/*if($a[0]['transferType']=='IN' && $a[$lastElm]['transferType']=='OUT') { //Terminal to Hotel
$c=array_values(array_filter($c, function($k) {
return (isset( $k['oneway'], $k['return']));
}));
}*/

/*if($a[0]['transferType']=='OUT' && $a[$lastElm]['transferType']=='IN') { //Terminal to Hotel
$c=array_values(array_filter($c, function($k) {
return (isset( $k['oneway'], $k['return']));
}));
}*/


return $c;

}


function transfer_roundtrip_IN_OUT($a){
$data=array();
if($a[0]['transferType']=='OUT' && $a[$lastElm]['transferType']=='IN') { //Terminal to Hotel
$data['oneway']=array_values(array_filter($a, function($k) {
return (isset($k['transferType']) && $k['transferType']=='OUT');
}));

$data['return']=array_values(array_filter($a, function($k) {
return (isset($k['transferType']) && $k['transferType']=='IN');
}));

}else{
$data['oneway']=array_values(array_filter($a, function($k) {
return (isset($k['transferType']) && $k['transferType']=='IN');
}));
$data['return']=array_values(array_filter($a, function($k) {
return (isset($k['transferType']) && $k['transferType']=='OUT');
}));

}
return $data;
}





/*else{ //Hotel to Terminal
  if($value['transferType']=='OUT') {
  $c[$key]['oneway']=$value;
}else{
if (array_key_exists($key-count($c),$c))
   $c[$key-count($c)]['return']=$value;
}
}*/



 function Read_Boookning_info_act($response){

          $ci =& get_instance();
          $ci->load->library('xml_to_array');
          $XmlRes = $ci->xml_to_array->XmlToArray($response);
          $AdditionalCostList=array();$Booking=array();$CommentList=array();
        if(isset($XmlRes['errors']['text'])){
            $Booking['ErrorList']=$XmlRes['errors']['text'];
        }
        
     

            if(isset($XmlRes['booking'])){

            $PurchaseDetails=$XmlRes['booking'];
            $ServiceListDetails=$XmlRes['booking']['activities'];
           
           if(isset($ServiceListDetails['@attributes']['code'])){
            $Booking['code'] = $ServiceListDetails['@attributes']['code'];
            }else{
                $Booking['code']='';
            }
              

            if(isset($PurchaseDetails['status'])){
            $Booking['Status'] = $PurchaseDetails['status'];
            }else{
                $Booking['Status']='';
            }
               if(isset($ServiceListDetails['status'])){
            $Booking['Status_'] = $ServiceListDetails['status'];
            }else{
                $Booking['Status_']='';
            }

             if(isset($ServiceListDetails['activityReference'])){
            $Booking['FileNumber_'] = $ServiceListDetails['activityReference'];
            }else{
            $Booking['FileNumber_']='';
            }


             if(isset($ServiceListDetails['supplier'])){
            $Booking['Supplier'] = $ServiceListDetails['supplier']['name'];
            }else{
            $Booking['Supplier']='';
            }

            if(isset($ServiceListDetails['supplier'])){
            $Booking['vatNumber'] = $ServiceListDetails['supplier']['vatNumber'];
            }else{
            $Booking['vatNumber']='';
            }
            if(isset($PurchaseDetails['total'])){
            $Booking['TotalPrice'] = $PurchaseDetails['total'];
            }else{
            $Booking['TotalPrice']=$ServiceListDetails['total'];
                
            }

            if(isset($PurchaseDetails['totalNet'])){
            $Booking['NetPrice'] = $PurchaseDetails['totalNet'];
            }

            $Currency=$PurchaseDetails['currency'];
            $Booking['Currency']=$Currency;
            /*if(isset($PurchaseDetails['Language'])){
            $Booking['Language'] = $PurchaseDetails['Language'];
            }else{
                $Booking['Language']='';
            }*/


            if(isset($PurchaseDetails['reference'])){
            $Booking['FileNumber'] = $PurchaseDetails['reference'];
            }else{
            $Booking['FileNumber']='';
            }

           /* if(isset($PurchaseDetails['Reference']['IncomingOffice'])){
            $Booking['IncomingOffice'] = $PurchaseDetails['Reference']['IncomingOffice']['@attributes']['code'];
            }else{
            $Booking['IncomingOffice']='';
            }*/
            

            if(isset($PurchaseDetails['creationDate'])){
            $Booking['CreationDate'] = $PurchaseDetails['creationDate'];
            }else{
                $Booking['CreationDate']='';
            }

            if(isset($ServiceListDetails['status'])){
            $Booking['Service_Status'] = $ServiceListDetails['status'];
            }else{
            $Booking['Service_Status']='';
                
            }



            $VouchersList=array();

            if(isset($ServiceListDetails['vouchers'])){
            $VouchersListDetails=$ServiceListDetails['vouchers'];

            foreach ($VouchersListDetails as $Vouchers => $Vouchers_value) {
            $VouchersList[]=array('code'=>$Vouchers_value['@attributes']['code'],
              'language'=>$Vouchers_value['language'],
              'url'=>$Vouchers_value['url'],
              'mimeType'=>$Vouchers_value['mimeType']);
            }
            
            }
            $Booking['VouchersList']=$VouchersList;
            $CommentList=array();

            if(isset($ServiceListDetails['comments'])){
            $CommentListDetails=array($ServiceListDetails['comments']);

            foreach ($CommentListDetails as $Comment => $Comment_value) {
            $CommentList[]=array($Comment_value['@attributes']['type']=>$Comment_value['text']);
            }
            
            }/*elseif ($ServiceListDetails['comments']) {
             $CommentList[]=array($ServiceListDetails['comments']['@attributes']['type']=>$ServiceListDetails['comments']['text']);
            }*/
            $Booking['CommentList']=$CommentList;
            

            
                
                
              


               

          



                 $CancellationPolicy_=array();
    if(isset($ServiceListDetails['cancellationPolicies'])){
        $CancellationPolicy=$ServiceListDetails['cancellationPolicies'];


        if(isset($CancellationPolicy) && array_key_exists(0, $CancellationPolicy)){
        $CancellationPolicyAr=$CancellationPolicy;

        }else{
        
          
             $CancellationPolicyAr=array(0=>$CancellationPolicy);
           
       
        }

        $policy=0; 
        foreach ($CancellationPolicyAr as $CancellationPolicyKey => $CancellationPolicyvalue) {

        $CancellationPolicy_[$policy]=array('Amount' =>isset($CancellationPolicyvalue['@attributes']['amount'])?$CancellationPolicyvalue['@attributes']['amount']:$CancellationPolicyvalue['Amount'],
        'DateTimeFrom' =>isset($CancellationPolicyvalue['@attributes']['dateFrom'])?$CancellationPolicyvalue['@attributes']['dateFrom']:$CancellationPolicyvalue['@attributes']['dateFrom']
       );
        $policy++;

        }

      }
 $Booking['CancellationPolicy']=$CancellationPolicy_;

                

            #echo '<pre>';print_r($Booking);die;

        }

        //echo $response.'<pre>';print_r($Booking);die;
            return   $Booking;

  
}

?>