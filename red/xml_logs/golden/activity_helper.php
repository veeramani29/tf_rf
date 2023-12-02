<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Test
define('ACTIVITY_APIKEY', 'mvy5xdv2n2dd99yj36c83j6g');
define('ACTIVITY_SECRETKEY', '6EUBDcjDvd');
define('ENABLE_TEST', 'test.');
//Live
/*define('ACTIVITY_APIKEY', 'wydw5tykv7htwwjq6k84sahn');
define('ACTIVITY_SECRETKEY', 'szsZ4wN2vQ');
define('ENABLE_TEST', '');*/
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

function activity_availability($data){


       /* $occupency = '';
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
      }*/


 $sd=explode('/', $data['cin']);
 $sd =$sd[2].'-'.$sd[0].'-'.$sd[1];
  $ed=explode('/', $data['cout']);
 $ed =$ed[2].'-'.$ed[0].'-'.$ed[1];




$ActivitySearchRQ='<?xml version="1.0" encoding="UTF-8" ?>
<ActivitySearchRequest platform="55">
<PaginationData itemsPerPage="999" pageNumber="1"/> 
    <filters>
        <searchFilterItems>
   <type>destination</type>
   <value>'.$data['hbeds_code'].'</value>
  </searchFilterItems>
</filters>
    <from>'.$sd.'</from>
    <to>'.$ed.'</to>
    <language>en</language>
    <!--<pagination>
        <itemsPerPage>10</itemsPerPage>
        <page>1</page>
    </pagination>-->
    <order>DEFAULT</order>
</ActivitySearchRequest>';




$Activity_apiKey = ACTIVITY_APIKEY;
$Activity_Secret = ACTIVITY_SECRETKEY;
$signature = hash("sha256", $Activity_apiKey.$Activity_Secret.time());
$endpoint = "https://api.".ENABLE_TEST."hotelbeds.com/activity-api/3.0/activities";

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_POST=>1,
        CURLOPT_POSTFIELDS=> $ActivitySearchRQ,
        CURLOPT_ENCODING=> "gzip",
        CURLOPT_URL => $endpoint,
        CURLOPT_HTTPHEADER => ['Accept:application/xml' ,'Content-Type:application/xml' , 'Api-key:'.$Activity_apiKey.'', 'X-Signature:'.$signature.'']
        ));
        $ActivitySearchRS = curl_exec($curl);

 
  if (!curl_errno($curl)) {
    switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
      case 200:  # OK
      $file = "xml/ActivitySearchRQ.xml";
    prettyPrint($ActivitySearchRQ,$file);
    $file1 = "xml/ActivitySearchRS.xml";
    prettyPrint($ActivitySearchRS,$file1);
        break;
     
    }
  }
  curl_close($curl);

	

           return $ActivitySearchRS;
       

    
}





function activity_DetailsReq($data){




$sd=explode('/', $data['cin']);
 $sd =$sd[2].'-'.$sd[0].'-'.$sd[1];
  $ed=explode('/', $data['cout']);
 $ed =$ed[2].'-'.$ed[0].'-'.$ed[1];
$Customers='';
if($data['adult']>0){

  for($c=0;$c<$data['adult'];$c++){
  $Customers.='<paxes age="30"></paxes>';
    
}
}


    if($data['child']>0){
    $child_age_=$data['child_age'][0];
    for($j=0;$j<count($child_age_);$j++)
    {
    $Customers.='<paxes age="'.$child_age_[$j].'"></paxes>';
    }
    }

  $ActivityDetailRQ='<?xml version="1.0" encoding="UTF-8"?>
<ActivityDetailRequest platform="55">
    <code>'.$data['activity_code'].'</code>
    <modalityCode>'.$data['modalityCode'].'</modalityCode>
    <from>'.$sd.'</from>
    <language>en</language>
    '.$Customers.'
    <to>'.$ed.'</to>
</ActivityDetailRequest>';

$Activity_apiKey = ACTIVITY_APIKEY;
$Activity_Secret = ACTIVITY_SECRETKEY;
$signature = hash("sha256", $Activity_apiKey.$Activity_Secret.time());
$endpoint = "https://api.".ENABLE_TEST."hotelbeds.com/activity-api/3.0/activities/details";

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_POST=>1,
        CURLOPT_POSTFIELDS=> $ActivityDetailRQ,
        CURLOPT_ENCODING=> "gzip",
        CURLOPT_URL => $endpoint,
        CURLOPT_HTTPHEADER => ['Accept:application/xml' ,'Content-Type:application/xml' , 'Api-key:'.$Activity_apiKey.'', 'X-Signature:'.$signature.'']
        ));
        $ActivityDetailRS = curl_exec($curl);

 
  if (!curl_errno($curl)) {
    switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
      case 200:  # OK
      $file = "xml/ActivityDetailRQ.xml";
    prettyPrint($ActivityDetailRQ,$file);
    $file1 = "xml/ActivityDetailRS.xml";
    prettyPrint($ActivityDetailRS,$file1);
        break;
     
    }
  }
  curl_close($curl);

  

           return $ActivityDetailRS;

    
}


function PurchaseConfirmReq($postData,$bookedData,$searchData){
#echo "<pre>";print_r($postData);#die;
$answers = '';
if(!empty($postData['answers'])){
for ($a = 0; $a < count($postData['answers']); $a++)
                {
$answers .= '<answers>
<question code="'.$postData['questions_code'][$a].'" required="true">
<text>'.$postData['questions'][$a].'</text>
</question>
<answer>'.$postData['answers'][$a].'</answer>
</answers>';
   
}
}
          $occupency = '';
    for ($j = 0; $j < $searchData['adult']; $j++)
      {
       $occupency .= '<paxes age = "30" name = "'.$postData['adultFname'][$j].'" surname = "'.$postData['adultLname'][$j].'" type = "ADULT"/>';
      }
            
            if(isset($searchData['child']) && $searchData['child'] > 0)
            {
                for ($k = 0; $k < $searchData['child']; $k++)
                { $kk=$searchData['adult']+$k+1;

                //$searchData['child_age'][0][$k]
               $occupency .= '<paxes age = "'.$postData['childage'][$k].'" name = "'.$postData['childFname'][$k].'" surname = "'.$postData['childLname'][$k].'" type = "CHILD"/>';

                   
                   
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
return Read_Boookning_info($PurchaseConfirmRS);
           #return $PurchaseConfirmRS;
       

    
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
return Read_Boookning_info($PurchaseConfirmRS);
           #return $PurchaseConfirmRS;
       

    
}
function ActivityDetails_Rsp($response){

$ci =& get_instance();
$ci->load->library('xml_to_array'); $TicketDetail=array();
$result=$ci->xml_to_array->XmlToArray($response);
if(isset($result['ErrorList']['Error'])){
            $TicketDetail['ErrorList']=$result['ErrorList']['Error'];
        }


        if(isset($result['activity'])){
        $eachTicket=$result['activity'];
        if(array_key_exists(0, $eachTicket)){
        $eachTicket_=$eachTicket;
        }else{
        $eachTicket_=array(0=>$eachTicket);
        }
        $t=0;
foreach ($eachTicket_ as $eachTicketkey => $eachTicketvalue) {
       
        $TicketInfo=$eachTicketvalue;


      $TicketDetail[$t]['type']=$TicketInfo['@attributes']['type'];
      $TicketDetail[$t]['code']=$TicketInfo['@attributes']['code'];
      $TicketDetail[$t]['name']=$TicketInfo['@attributes']['name'];
      $TicketDetail[$t]['currency']=$TicketInfo['@attributes']['currency'];
      $TicketDetail[$t]['activityCode']=$TicketInfo['@attributes']['activityCode'];
     

      //Start amountsFromAll_
      $operationDaysAll_=array(); 
 if(isset($TicketInfo['operationDays']) && array_key_exists(0, $TicketInfo['operationDays'])){
        $operationDays=$TicketInfo['operationDays'];
        }else{
        $operationDays=array(0=>$TicketInfo['amountsFrom']);
        }
    foreach ($operationDays as $operationDayskey => $operationDays_value) {

        $operationDaysAll_[]=isset($operationDays_value['@attributes']['code'])?$operationDays_value['@attributes']['code']:'';
        
           
        }


         $TicketDetail[$t]['operationDays']=$operationDaysAll_;
         //End amountsFromAll_ 

 //Start Modelity
         $modalitiesAll_=array();
     if(isset($TicketInfo['modalities']) && array_key_exists(0, $TicketInfo['modalities'])){
        $modalities=$TicketInfo['modalities'];
        }else{
        $modalities=array(0=>$TicketInfo['modalities']);
        }
         $mod=0; 
    foreach ($modalities as $modalitieskey => $modalities_value) {

        $modalitiesAll_[$mod]=array('code' =>isset($modalities_value['@attributes']['code'])?$modalities_value['@attributes']['code']:'',
          'name' =>isset($modalities_value['@attributes']['name'])?$modalities_value['@attributes']['name']:'',
          'duration' =>isset($modalities_value['duration']['value'])?$modalities_value['duration']['value']:'',
          'metric' =>isset($modalities_value['duration']['metric'])?ucfirst(strtolower($modalities_value['duration']['metric'])):'',
          'destinationCode' =>isset($modalities_value['destinationCode'])?(($modalities_value['destinationCode'])):'',
          'amountUnitType' =>isset($modalities_value['amountUnitType'])?ucfirst(strtolower($modalities_value['amountUnitType'])):'',
          'comments' =>isset($modalities_value['comments']['text'])?ucfirst(strtolower($modalities_value['comments']['text'])):''
 
         );
      

       $modalitiesamountsFromAll_=array();
     if(isset($modalities_value['amountsFrom']) && array_key_exists(0, $modalities_value['amountsFrom'])){
        $modamountsFrom=$modalities_value['amountsFrom'];
        }else{
        $modamountsFrom=array(0=>$modalities_value['amountsFrom']);
        }

    foreach ($modamountsFrom as $modamountsFromkey => $modamountsFrom_value) {

          $modalitiesamountsFromAll_[]=array('paxType' =>isset($modamountsFrom_value['@attributes']['paxType'])?ucfirst(strtolower($modamountsFrom_value['@attributes']['paxType'])):'',
          'ageFrom' =>isset($modamountsFrom_value['@attributes']['ageFrom'])?$modamountsFrom_value['@attributes']['ageFrom']:'',
          'ageTo' =>isset($modamountsFrom_value['@attributes']['ageTo'])?$modamountsFrom_value['@attributes']['ageTo']:'',
          'amount' =>isset($modamountsFrom_value['@attributes']['amount'])?$modamountsFrom_value['@attributes']['amount']:'',
          'boxOfficeAmount' =>isset($modamountsFrom_value['@attributes']['boxOfficeAmount'])?$modamountsFrom_value['@attributes']['boxOfficeAmount']:'',
          );
  }

        $modalitiesAll_[$mod]['modamountsFrom']=$modalitiesamountsFromAll_;




        //Strat Quetions 

 if(isset($modalities_value['questions'])){
         $questionsAll_=array();
     if(isset($modalities_value['questions']) && array_key_exists(0, $modalities_value['questions'])){
        $questions=$modalities_value['questions'];
        }else{
        $questions=array(0=>$modalities_value['questions']);
        }

    foreach ($questions as $questionskey => $questions_value) {
$questionsAll_[]=array('code' =>isset($questions_value['@attributes']['code'])?(($questions_value['@attributes']['code'])):'',
  'required' =>isset($questions_value['@attributes']['required'])?$questions_value['@attributes']['required']:'',
  'questions' =>isset($questions_value['text'])?$questions_value['text']:'',
 );
  }


  $modalitiesAll_[$mod]['questions']=$questionsAll_;
}
  //End Questions

$mod++;
        }
 $TicketDetail[$t]['modalities']=$modalitiesAll_;

         //End Modelity

  //Start rateDetails
$rateDetails=array();
if(isset($TicketInfo['modalities']['rates']) && array_key_exists(0, $TicketInfo['modalities']['rates'])){
        $rateElm=$TicketInfo['modalities']['rates'];
        }else{
        $rateElm=array(0=>$TicketInfo['modalities']['rates']);
        }
        $rateElm=$rateElm[0];
      

        $rateDetailsElm=$rateElm['rateDetails'];

      $rateDetails['rateCode']=isset($rateElm['@attributes']['rateCode'])?$rateElm['@attributes']['rateCode']:'';
      $rateDetails['rateKey']=isset($rateDetailsElm['@attributes']['rateKey'])?$rateDetailsElm['@attributes']['rateKey']:'';

      $rateDetails['duration']['min']['value']=isset($rateDetailsElm['minimumDuration']['value'])?$rateDetailsElm['minimumDuration']['value']:'';
      $rateDetails['duration']['min']['metric']=isset($rateDetailsElm['minimumDuration']['metric'])?ucfirst(strtolower($rateDetailsElm['minimumDuration']['metric'])):'';

      $rateDetails['duration']['max']['value']=isset($rateDetailsElm['maximumDuration']['value'])?$rateDetailsElm['maximumDuration']['value']:'';
              $rateDetails['duration']['max']['metric']=isset($rateDetailsElm['maximumDuration']['metric'])?ucfirst(strtolower($rateDetailsElm['maximumDuration']['metric'])):'';

              $rateDetails['totalAmount']=isset($rateDetailsElm['totalAmount']['@attributes']['boxOfficeAmount'])?$rateDetailsElm['totalAmount']['@attributes']['boxOfficeAmount']:'';
              $rateDetails['boxOfficeAmount']=isset($rateDetailsElm['totalAmount']['@attributes']['boxOfficeAmount'])?$rateDetailsElm['totalAmount']['@attributes']['boxOfficeAmount']:'';



                //Start operationDates
         $operationDatesAll_=array();
     if(isset($rateDetailsElm['operationDates']) && array_key_exists(0, $rateDetailsElm['operationDates'])){
        $operationDates=$rateDetailsElm['operationDates'];
        }else{
        $operationDates=array(0=>$rateDetailsElm['operationDates']);
        }
       $od=0;
    foreach ($operationDates as $operationDateskey => $operationDates_value) {

        $operationDatesAll_[$od]=array('from' =>isset($operationDates_value['from'])?$operationDates_value['from']:'',
          'to' =>isset($operationDates_value['to'])?$operationDates_value['to']:''
         
         );


        if(isset($operationDates_value['cancellationPolicies']) && array_key_exists(0, $operationDates_value['cancellationPolicies'])){
        $cancellationPolicies=$operationDates_value['cancellationPolicies'];
        }else{
        $cancellationPolicies=array(0=>$operationDates_value['cancellationPolicies']);
        }
          $cancel=array();
           foreach ($cancellationPolicies as $cancellationPolicieskey => $cancellationPolicies_value) {
            $cancel[]=array(
          'amount' =>isset($cancellationPolicies_value['@attributes']['amount'])?$cancellationPolicies_value['@attributes']['amount']:'',
         'date' =>isset($cancellationPolicies_value['@attributes']['dateFrom'])?$cancellationPolicies_value['@attributes']['dateFrom']:'',
         );
           }

           $operationDatesAll_[$od]['cancellationPolicies']=$cancel;
    $od++;  
}
    
//End operationDates
   

        $rateDetails['operationDates']=$operationDatesAll_;

         $TicketDetail[$t]['rateDetails']=$rateDetails;




         //End rateDetails
$t++;
      }

}
 #echo "<pre>";print_r($TicketDetail);die;
return $TicketDetail;
      }


 function Read_Boookning_info($response){

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




 function Activity_XML_Pharse($response){
      $ci =& get_instance();
      $ci->load->library('xml_to_array');
      $result = $ci->xml_to_array->XmlToArray($response);
      $TicketInfo_=array(); $destinations=array();$DiscountList=array();$CommentList=array();
      if(isset($result['ErrorList']['Error'])){
      $TicketInfo_['ErrorList']=$result['ErrorList']['Error'];
      }

       if(isset($result['activities'])){

              if(isset($result['activities']) && array_key_exists(0, $result['activities'])){
        $eachServiceTicket=$result['activities'];
        }else{
        $eachServiceTicket=array(0=>$result['activities']);
        }

        
        $t=0;
foreach ($eachServiceTicket as $eachServiceTicketkey => $eachServiceTicketvalue) {
        
      $TicketInfo_[$t]['type']=$eachServiceTicketvalue['@attributes']['type'];
      $TicketInfo_[$t]['code']=$eachServiceTicketvalue['@attributes']['code'];
      $TicketInfo_[$t]['name']=$eachServiceTicketvalue['@attributes']['name'];
      $TicketInfo_[$t]['currency']=$eachServiceTicketvalue['@attributes']['currency'];
      $TicketInfo_[$t]['order']=$eachServiceTicketvalue['order'];
      $TicketInfo_[$t]['currencyName']=$eachServiceTicketvalue['currencyName'];

      $destinations['country']=isset($eachServiceTicketvalue['country']['@attributes']['name'])?$eachServiceTicketvalue['country']['@attributes']['name']:'';
      $destinations['country_code']=isset($eachServiceTicketvalue['country']['@attributes']['code'])?$eachServiceTicketvalue['country']['@attributes']['code']:'';

      $destinations['city']=isset($eachServiceTicketvalue['country']['destinations']['@attributes']['name'])?$eachServiceTicketvalue['country']['destinations']['@attributes']['name']:'';
      $destinations['city_code']=isset($eachServiceTicketvalue['country']['destinations']['@attributes']['code'])?$eachServiceTicketvalue['country']['destinations']['@attributes']['code']:'';
       //Start amountsFromAll_
      $amountsFromAll_=array(); 
 if(isset($eachServiceTicketvalue['amountsFrom']) && array_key_exists(0, $eachServiceTicketvalue['amountsFrom'])){
        $amountsFrom=$eachServiceTicketvalue['amountsFrom'];
        }else{
        $amountsFrom=array(0=>$eachServiceTicketvalue['amountsFrom']);
        }
    foreach ($amountsFrom as $amountsFromkey => $amountsFrom_value) {

        $amountsFromAll_[]=array('paxType' =>isset($amountsFrom_value['@attributes']['paxType'])?$amountsFrom_value['@attributes']['paxType']:'',
          'ageFrom' =>isset($amountsFrom_value['@attributes']['ageFrom'])?$amountsFrom_value['@attributes']['ageFrom']:'',
          'ageTo' =>isset($amountsFrom_value['@attributes']['ageTo'])?$amountsFrom_value['@attributes']['ageTo']:'',
          'amount' =>isset($amountsFrom_value['@attributes']['amount'])?$amountsFrom_value['@attributes']['amount']:'',
          'boxOfficeAmount' =>isset($amountsFrom_value['@attributes']['boxOfficeAmount'])?$amountsFrom_value['@attributes']['boxOfficeAmount']:''
      
            );

        }


         $TicketInfo_[$t]['amountsFrom']=$amountsFromAll_;
         //End amountsFromAll_ 

           //Start Modelity
         $modalitiesAll_=array();
     if(isset($eachServiceTicketvalue['modalities']) && array_key_exists(0, $eachServiceTicketvalue['modalities'])){
        $modalities=$eachServiceTicketvalue['modalities'];
        }else{
        $modalities=array(0=>$eachServiceTicketvalue['modalities']);
        }
         $mod=0; 
    foreach ($modalities as $modalitieskey => $modalities_value) {

        $modalitiesAll_[$mod]=array('code' =>isset($modalities_value['@attributes']['code'])?$modalities_value['@attributes']['code']:'',
          'name' =>isset($modalities_value['name'])?$modalities_value['name']:'',
          'duration' =>isset($modalities_value['duration']['value'])?$modalities_value['duration']['value']:'',
          'metric' =>isset($modalities_value['duration']['metric'])?ucfirst(strtolower($modalities_value['duration']['metric'])):'',
          'cancellation_amount' =>isset($modalities_value['cancellationPolicies']['@attributes']['amount'])?$modalities_value['cancellationPolicies']['@attributes']['amount']:'',
         'cancellation_date' =>isset($modalities_value['cancellationPolicies']['@attributes']['dateFrom'])?$modalities_value['cancellationPolicies']['@attributes']['dateFrom']:'',
         );
      

       $modalitiesamountsFromAll_=array();
     if(isset($modalities_value['amountsFrom']) && array_key_exists(0, $modalities_value['amountsFrom'])){
        $modamountsFrom=$modalities_value['amountsFrom'];
        }else{
        $modamountsFrom=array(0=>$modalities_value['amountsFrom']);
        }

    foreach ($modamountsFrom as $modamountsFromkey => $modamountsFrom_value) {

          $modalitiesamountsFromAll_[]=array('paxType' =>isset($modamountsFrom_value['@attributes']['paxType'])?ucfirst(strtolower($modamountsFrom_value['@attributes']['paxType'])):'',
          'ageFrom' =>isset($modamountsFrom_value['@attributes']['ageFrom'])?$modamountsFrom_value['@attributes']['ageFrom']:'',
          'ageTo' =>isset($modamountsFrom_value['@attributes']['ageTo'])?$modamountsFrom_value['@attributes']['ageTo']:'',
          'amount' =>isset($modamountsFrom_value['@attributes']['amount'])?$modamountsFrom_value['@attributes']['amount']:'',
          'boxOfficeAmount' =>isset($modamountsFrom_value['@attributes']['boxOfficeAmount'])?$modamountsFrom_value['@attributes']['boxOfficeAmount']:'',
          );
  }

        $modalitiesAll_[$mod]['modamountsFrom']=$modalitiesamountsFromAll_;

$mod++;
        }
 $TicketInfo_[$t]['modalities']=$modalitiesAll_;

         //End Modelity
      


if(isset($eachServiceTicketvalue['content'])){
         $contentInfo=isset($eachServiceTicketvalue['content'])?$eachServiceTicketvalue['content']:'';

        $TicketInfo_[$t]['contentId']=isset($contentInfo['contentId'])?$contentInfo['contentId']:'';
        $TicketInfo_[$t]['content_name']=$contentInfo['name'];
        $ImageList=$contentInfo['media']['images']['urls'];
        $filtered_image_ARR = array_filter($ImageList, function($eacharr) { return $eacharr['sizeType'] == 'SMALL'; });

        $TicketInfo_[$t]['Image']=array_column($filtered_image_ARR, 'resource');
        #$DescriptionList=$contentInfo['description'];
        $TicketInfo_[$t]['Description']=$contentInfo['description'];
        $Otherlocation=$contentInfo['location']['startingPoints']['meetingPoint'];
        $destinations['address']=isset($Otherlocation['address'])?$Otherlocation['address']:'';
        $destinations['city_']=isset($Otherlocation['city'])?$Otherlocation['city']:'';
        $destinations['zip']=isset($Otherlocation['zip'])?:'';
        $destinations['description']=$Otherlocation['description'];
        $TicketInfo_[$t]['destinations']=$destinations;
    }
        //Start feature
      $featureAll_=array(); 
 if(isset($contentInfo['featureGroups']) && array_key_exists(0, $contentInfo['featureGroups'])){
        $featureGroups=$contentInfo['featureGroups'];
        }else{
        $featureGroups=array(0=>(isset($contentInfo['featureGroups'])?$contentInfo['featureGroups']:array()));
        }
        $feat=0;
    foreach ($featureGroups as $featureGroupskey => $featureGroups_value) {
        $groupCode=isset($featureGroups_value['@attributes']['groupCode'])?$featureGroups_value['@attributes']['groupCode']:'';

        if(isset($featureGroups_value['included'])){
 $featureAll_[$groupCode]=array('included' =>isset($featureGroups_value['included']['description'])?$featureGroups_value['included']['description']:'',
        );
        }
        if(isset($featureGroups_value['excluded'])){
$featureAll_[$groupCode]=array('excluded' =>isset($featureGroups_value['excluded']['description'])?$featureGroups_value['excluded']['description']:'',
        );
        }
       

        }


         $TicketInfo_[$t]['features']=$featureAll_;
         //End features



         if(isset($contentInfo['segmentationGroups'])){
        $Segmentation=$contentInfo['segmentationGroups'];

        $seg=0; $SegmentationInfo_=array();
        foreach ($Segmentation as $Segmentationkey => $Segmentationvalue) {

        $SegmentationInfo_[$seg]['name']=$Segmentationvalue['@attributes']['name'];
        $SegmentationInfo_[$seg]['code']=$Segmentationvalue['@attributes']['code'];
        if(isset($Segmentationvalue['segments']) && array_key_exists(0, $Segmentationvalue['segments'])){
        $SegmentationGroup=$Segmentationvalue['segments'];
        }else{
        $SegmentationGroup=array(0=>$Segmentationvalue['segments']);
        }

        foreach ($SegmentationGroup as $Segmentationvaluekey => $Segmentationvalue_value) {


        $SegmentationInfo_[$seg]['segments'][]=array('name' =>isset($Segmentationvalue_value['@attributes']['name'])?$Segmentationvalue_value['@attributes']['name']:'',
        'code' =>$Segmentationvalue_value['@attributes']['code']);


        }



        $seg++;

        }
         $TicketInfo_[$t]['SegmentationInfo']=$SegmentationInfo_;
        } 



 $t++;
}


}
#echo "<pre>";print_r($TicketInfo_);die;
return $TicketInfo_;
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

 function getbody($filename) {
        $file = file_get_contents($filename);       
        $dom = new DOMDocument;
        $dom->loadHTML($file);
        $getStyleString=$dom->saveHTML($dom->getElementsByTagName('style')->item(0));
         $getStyleString=str_replace('font: 8.5pt Arial;', '', $getStyleString);
        $bodies = $dom->getElementsByTagName('body');
        assert($bodies->length === 1);
        $body = $bodies->item(0);
        for ($i = 0; $i < $body->children->length; $i++) {
            $body->remove($body->children->item($i));
        }
        $stringbody = $dom->saveHTML($body);
        return $getStyleString.($stringbody);
    }


     function booking_cancel($id)
    {
            if($id != ''){
                $exp = explode('-',$id);
                $incomingOffice = $exp[0];
                $fileNo = $exp[1];
            } else {
                $incomingOffice = '';
                $fileNo = '';
            }

$Activity_apiKey = ACTIVITY_APIKEY;
$Activity_Secret = ACTIVITY_SECRETKEY;
$signature = hash("sha256", $Activity_apiKey.$Activity_Secret.time());
 $endpoint = "https://api.".ENABLE_TEST."hotelbeds.com/activity-api/3.0/bookings/en/".$id."?cancellationFlag=CANCELLATION";
$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_CUSTOMREQUEST => "DELETE",
CURLOPT_RETURNTRANSFER => 1,
#CURLOPT_PUT=>1,
CURLOPT_POST=>1,
//CURLOPT_POSTFIELDS=> $PurchaseConfirmRQ,
CURLOPT_ENCODING=> "gzip",
CURLOPT_URL => $endpoint,
CURLOPT_HTTPHEADER => ['Accept:application/xml' ,'Content-Type:application/xml' , 'Api-key:'.$Activity_apiKey.'', 'X-Signature:'.$signature.'']
));

       
       echo $ActivityCancelRS = curl_exec($curl);

 echo $http_code;die;
  if (!curl_errno($curl)) {
    switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
      case 200:  # OK
     
    $file1 = "xml/ActivityCancelRS.xml";
    prettyPrint($ActivityCancelRS,$file1);
        break;
     
    }
  }
  curl_close($curl);
            
            
        
    }
?>