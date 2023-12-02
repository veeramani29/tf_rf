<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#error_reporting(E_ALL);ini_set("display_errors", "1");
error_reporting(0);



class Car extends CI_Controller {

    public function __construct()

    {
        session_start();

        parent::__construct();	

        $this->load->model('Hotel_Model');
         $this->load->model('Car_Model');
        
        $this->load->helper('car_helper');
        $this->load->library('xml_to_array');
        $_SESSION["system_currency"] = 'EUR';
		
		/* if (isset($_SERVER['HTTP_COOKIE'])) {
			$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
			foreach($cookies as $cookie) {
				$parts = explode('=', $cookie);
				$name = trim($parts[0]);
				setcookie($name, '', time() - (86400 * 30));
				setcookie($name, '', time() - (86400 * 30), '/');
			}
		} */

    }

     public function index(){
        $data=array();
      $this->load->view('car/index',$data);
  }

     public function search(){
         $_SESSION[session_id()]['CarSearchData'] = '';
        $_SESSION[session_id()]['Hotelbeds_SSdata'] = '';
        # print_r($_GET);die;
    $data['searchData'] = $this->getSearchParams_($_GET);
    $_SESSION[session_id()]['CarSearchData'] = $data['searchData'];
    $this->load->view('car/search',$data);
    }

    public function getSearchParams_($data){


        if($data['hotel_origin'] != '' && $data['hotel_dest'] != '' && $data['car_start'] != ''){

            $destCity = $data['hotel_dest'];

             $OrgCity = $data['hotel_origin'];


             $hotelbeds_org_city_code=trim(strstr($OrgCity, '('), '()');
             $hotelbeds_city_code=trim(strstr($destCity, '('), '()');

            $OrgCode='';$destCode='';

            

            $sd = $data['car_start'];

            $ed = $data['car_end'];

            $adult = ($data['adult']!='')?$data['adult']:2;

            $child = ($data['child']!='')?$data['child']:0;
            $car_start_time = $data['car_start_time'];
            $car_end_time = $data['car_end_time'];

          

           if(isset($data['child_age'])){

                $child_age = $data['child_age'];

            } else $child_age = '';


$now = strtotime($ed); // or your date as well
$your_date = strtotime($sd);
$datediff = $now - $your_date;
$nights = floor($datediff / (60 * 60 * 24));

            

            $searchArr = array(
                             'org_city'=>$OrgCity,'org_code'=>$OrgCode,'hbeds_org_code'=>$hotelbeds_org_city_code,'trip_type'=>$data['trip_type'],
                            'dest_city'=>$destCity,'dest_code'=>$destCode,'cin'=>$sd,'hbeds_dest_code'=>$hotelbeds_city_code,'car_end_time'=>str_replace(':', '', $car_end_time),'car_start_time'=>str_replace(':', '', $car_start_time),

                            'cout'=>$ed,'adult'=>$adult,'child'=>$child,'child_age'=>$child_age,'nights'=>$nights

                        );

           

            return $searchArr;

        } else {

            redirect('home');

        }

    }
public function getSearchData(){

            $data['searchData'] = $_SESSION[session_id()]['CarSearchData'];
            
            $Sightseen_response = transfer_availability($data['searchData']);
            $Sightseen_response_pharse=$a= $this->CarAvail_XML_Pharse($Sightseen_response);

            if($data['searchData']['trip_type']==2){
                $lastElm=count($Sightseen_response_pharse)-1;
                if($a[0]['transferType']=='OUT' && $a[$lastElm]['transferType']=='IN') {
                $Sightseen_response_pharse = transfer_roundtrip_IN_OUT($Sightseen_response_pharse);
                 $_SESSION[session_id()]['Hotelbeds_Cardata'] = $data['result']=$Sightseen_response_pharse;
               $serchView = $this->load->view('car/transfer_roundtrip',$data,true);
                }elseif($a[0]['transferType']=='IN' && $a[$lastElm]['transferType']=='OUT') {
                 $Sightseen_response_pharse = transfer_roundtrip_IN_OUT($Sightseen_response_pharse);
                  $_SESSION[session_id()]['Hotelbeds_Cardata'] = $data['result']=$Sightseen_response_pharse;
            $serchView = $this->load->view('car/transfer_roundtrip',$data,true);
                }else{
                $Sightseen_response_pharse = transfer_roundtrip($Sightseen_response_pharse);
                 $_SESSION[session_id()]['Hotelbeds_Cardata'] = $data['result']=$Sightseen_response_pharse;
                $serchView = $this->load->view('car/hotelbeds_carresult',$data,true);
                }
            }else{
                 $_SESSION[session_id()]['Hotelbeds_Cardata'] = $data['result']=$Sightseen_response_pharse;
                $serchView = $this->load->view('car/hotelbeds_carresult',$data,true);
            }
            #echo "<pre>";print_r($Sightseen_response_pharse);die;
           
            $loc = '';
            $amnty = '';
            $typ = '';
            echo json_encode(

                array(

                    'car_search_result'=>$serchView,

                    'locations'=>$loc,

                    'amenities'=>$amnty,

                    'types'=>$typ

                )

            );

        

       

    }

        public function details($id,$outid=null){
            if($id!=''){
               $data['id'] = $id;

               if($id!='' && $outid!=''){
                 $data['outid'] = (string) $outid;
                $data['car_data']['oneway'] = $_SESSION[session_id()]['Hotelbeds_Cardata']['oneway'][$id];
                $data['car_data']['return'] = $_SESSION[session_id()]['Hotelbeds_Cardata']['return'][$outid];
               }else{
              $data['car_data'] = $_SESSION[session_id()]['Hotelbeds_Cardata'][$id];
               }
           
           
            $data['searchData'] = $_SESSION[session_id()]['CarSearchData'];
           
                
          
            $this->load->view('car/details',$data);


            } else {

            $this->load->view('car/error_page');

            }

        }
		
		public function addCarddetails($id)
		{
			
			 if($id!=''){
			
            $data['post_service_data'] =$_POST;
            $data['car_data'] = $_SESSION[session_id()]['Hotelbeds_Cardata'][$id];
            $data['searchData'] = $_SESSION[session_id()]['CarSearchData'];
            $data['id'] = $id;
           
            $ServiceAddedRsp=car_ServiceReq($data,1);
            $data['ServiceAddedResult']=$ServiceAddedResult=ServiceAddRS_Rsp_Pharse($ServiceAddedRsp,1);
          
            if($data['searchData']['trip_type']==2){
            $ServiceAddedRsp1=car_ServiceReq($data,2,$data['ServiceAddedResult']['purchaseToken']);
            $data['ServiceAddedResult1']=$ServiceAddedResult1=ServiceAddRS_Rsp_Pharse($ServiceAddedRsp1,2);
            }
           
			
			$json = "";
			$session_id = session_id(); 
			$details_json = json_encode($data, true);
			$card_type= "Car";
			$cart_details = $this->Hotel_Model->insertCartGlobals($session_id,$json,$card_type,$details_json);
			
			if($cart_details != "")
			{
				if(isset($_COOKIE['cart_car_cookie'][0]) && $_COOKIE['cart_car_cookie'][0] != "")
				{
					$countOfCookie =  count($_COOKIE['cart_car_cookie']); 
					$cookie_name = "cart_car_cookie[$countOfCookie]";
				}
				else
				{
					$cookie_name = "cart_car_cookie[0]";
				}
				
				if($data['searchData']['trip_type']==2)
				{
					$cart_json[0] = $cart_details;
					$cart_json[1] = $data['car_data']['oneway']['MasterVehicleType'];
					$cart_json[2] = $data['car_data']['oneway']['Image'][0];
				}
				else
				{
					$cart_json[0] = $cart_details;
					$cart_json[1] = $data['car_data']['MasterVehicleType'];
					$cart_json[2] = $data['car_data']['Image'][0];
				}
				
				
				
				
				
				$cart_json = json_encode($cart_json,true);
				
				setcookie($cookie_name, $cart_json, time() + (86400 * 30), "/"); // 86400 = 1 day

			}
			
             echo "1"; exit;
            return $cart_details;     
            

            } 
		}

            


        public function pre_booking($id,$outid=null){
			
            if($id!=''){
            $data['post_service_data'] =$_POST;
            if($id!='' && $outid!=''){
                  $data['outid'] = (string) $outid;
                $data['car_data']['oneway'] = $_SESSION[session_id()]['Hotelbeds_Cardata']['oneway'][$id];
                $data['car_data']['return'] = $_SESSION[session_id()]['Hotelbeds_Cardata']['return'][$outid];
               }else{
              $data['car_data'] = $_SESSION[session_id()]['Hotelbeds_Cardata'][$id];
               }
            $data['searchData'] = $_SESSION[session_id()]['CarSearchData'];
            $data['id'] = $id;
           
            $ServiceAddedRsp=car_ServiceReq($data,1);
            $data['ServiceAddedResult']=$ServiceAddedResult=ServiceAddRS_Rsp_Pharse($ServiceAddedRsp,1);
          
            if($data['searchData']['trip_type']==2){
            $ServiceAddedRsp1=car_ServiceReq($data,2,$data['ServiceAddedResult']['purchaseToken']);
            $data['ServiceAddedResult1']=$ServiceAddedResult1=ServiceAddRS_Rsp_Pharse($ServiceAddedRsp1,2);
            }
                #echo "<pre>";print_r($data);die;


            $this->load->view('car/booking_customer',$data);


            } else {

            $this->load->view('car/error_page');

            }

        }





         public function booking_process(){

      

        if($_POST){

            $post_data = $_POST;
			
            if(isset($post_data) && $post_data!='')

        {

           

            $postData = $post_data;
             $id = (string) $post_data['id'];
            $outid_ = (string) $post_data['outid'];
            $avl =0;
            if($id!='' && $outid_!=''){
              $details=array();
                $details['oneway'] = $_SESSION[session_id()]['Hotelbeds_Cardata']['oneway'][$id];
                $details['return'] = $_SESSION[session_id()]['Hotelbeds_Cardata']['return'][$outid_];

               }else{
              $details = $_SESSION[session_id()]['Hotelbeds_Cardata'][$id];
               }
          # echo "<pre>";print_r($details);die;
            $searchData = $_SESSION[session_id()]['CarSearchData'];
            $bookedData = json_decode(base64_decode($postData['bookingPrepare']));
            $bookedData =  (array) $bookedData;
            if($searchData['trip_type']==2){
            $RoundbookedData = json_decode(base64_decode($postData['bookingPrepareRound']));
            $RoundbookedData =  (array) $RoundbookedData;
            }else{
            	$RoundbookedData=array();
            }

           
            
             $post_service_data = json_decode(base64_decode($postData['post_service_data']));
            $post_service_data =  (array) $post_service_data;

            $userId = '';
            $userType = '';



            if(isset($bookedData) && $bookedData != ''){

                $cur_val = '1';//$this->Hotel_Model->getPhpToUsdCurrency();

                $admin_markup = 0;//$this->Home_Model->getHotelAdminMarkup($_SESSION['agent']['user_id']);

                $agent_markup = 0;//$this->Home_Model->getHotelAgentMarkup($_SESSION['agent']['user_id']);

                $masterId = $this->Car_Model->addBookingDataHotelbeds($id,$postData,$details,$avl,$userId = 0,$bookedData,$searchData,$cur_val,$admin_markup,$agent_markup);

           

                if($masterId['master_id'] != ''){

                    $booking = PurchaseConfirmReq($postData,$bookedData,$searchData,$details,$post_service_data,$RoundbookedData);

                   if(is_array($booking) && $booking['Status']!='' && $booking['FileNumber_']!=''){


                      $hotelbeds_refrence=$booking['IncomingOffice'].'-'.$booking['FileNumber'];
                      $this->db->query($sql="update car_booking_master set api='Hotelbeds',api_ref_id='".$booking['FileNumber']."',hotelbeds_refrence='".$hotelbeds_refrence."',confirmation_number='".$booking['FileNumber_']."',  hotelbeds_supplier_name='".$booking['Supplier']."',hotelbeds_vat_number='".$booking['vatNumber']."',booking_status='".$booking['Status_']."',currency='".$booking['Currency']."',booking_response='".base64_encode(json_encode($booking))."' where id='".$masterId['master_id']."'");
                            

                         redirect('car/thankyou/'.$masterId['master_id']);

                    } else {

                         redirect('car/booking_failed/');

                    }

                } else {

                    redirect('car/booking_failed/');

                }

            } else {

               redirect('car/booking_failed/');

            }

        }

              

                }

            }




             public function booking_failed(){

        unset($_SESSION[session_id()]['Hotelbeds_Cardata']);

        unset($_SESSION[session_id()]['CarSearchData']);

        $this->load->view('car/booking_failed');

    }

       

    

    function thankyou($masterId)

    {

       

        unset($_SESSION[session_id()]['Hotelbeds_Cardata']);

        unset($_SESSION[session_id()]['CarSearchData']);
        $data['bookingData'] = $this->Car_Model->getBookingData($masterId);

        $data['paxDetails'] = $this->Car_Model->getBookingPaxData($masterId);
          // $data['hotel_details'] = $this->Agent_hotel_Model->getBookingHotelData($data['bookingData']->hotel_code);

        ##################### MAIL TO USER  ##################################

         $to = $data['bookingData']->email;

         $subject = 'Ticket Booking Voucher';

         $subject1 = 'Ticket Booking Invoice';

         $headers = "From: support@redtagtravels.com\r\n";

         $headers .= "Reply-To: support@redtagtravels.com\r\n";

         $headers .= "CC: support@redtagtravels.com\r\n";

         $headers .= "MIME-Version: 1.0\r\n";

         $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        

             $message = $this->load->view('car/voucher',$data,true);

            // $message1 = $this->load->view('car/invoice',$data,true);

         

         mail($to, $subject, $message, $headers);

        // mail($to, $subject1, $message1, $headers);



        #######################################################
		
        $this->load->view('car/voucher',$data);

    }

    public function CarAvail_XML_Pharse($response){


        $result=$this->xml_to_array->XmlToArray($response);

        $TransferInfo_=array();
        if(isset($result['ServiceTransfer'])){

              if(isset($result['ServiceTransfer']) && array_key_exists(0, $result['ServiceTransfer'])){
        $eachServiceTransfer=$result['ServiceTransfer'];
        }else{
        $eachServiceTransfer=array(0=>$result['ServiceTransfer']);
        }

        
        $t=0;
foreach ($eachServiceTransfer as $eachServiceTransferkey => $eachServiceTransfervalue) {
$TransferInfo_[$t]['availToken']=$eachServiceTransfervalue['@attributes']['availToken'];
$TransferInfo_[$t]['transferType']=$eachServiceTransfervalue['@attributes']['transferType'];
$TransferInfo_[$t]['Currency']=$eachServiceTransfervalue['Currency']['@attributes']['code'];
$TransferInfo_[$t]['TotalAmount']=isset($eachServiceTransfervalue['TotalAmount'])?$eachServiceTransfervalue['TotalAmount']:'';
$TransferInfo_[$t]['RetailPrice']=isset($eachServiceTransfervalue['RetailPrice'])?$eachServiceTransfervalue['RetailPrice']:'';
$TransferInfo_[$t]['SellingPrice']=isset($eachServiceTransfervalue['SellingPrice'])?$eachServiceTransfervalue['SellingPrice']['@content']:'';
$TransferInfo_[$t]['SellingPrice_mandatory']=$eachServiceTransfervalue['SellingPrice']['@attributes']['mandatory'];
$TransferInfo_[$t]['Date_From']=$eachServiceTransfervalue['DateFrom']['@attributes']['date'];
$TransferInfo_[$t]['DateFrom_time']=$eachServiceTransfervalue['DateFrom']['@attributes']['time'];

$TransferInfo_[$t]['Contract']=$eachServiceTransfervalue['ContractList']['Contract']['Name'];
$TransferInfo_[$t]['IncomingOffice']=$eachServiceTransfervalue['ContractList']['Contract']['IncomingOffice']['@attributes']['code'];

$TransferInfo=$eachServiceTransfervalue['TransferInfo'];
$TransferInfo_[$t]['Code']=$TransferInfo['Code'];
$TransferInfo_[$t]['Type']=$TransferInfo['Type']['@attributes']['code'];
$TransferInfo_[$t]['VehicleType']=$TransferInfo['VehicleType']['@attributes']['code'];
      
        $ImageList=$TransferInfo['ImageList']['Image'];
        $filtered_image_ARR = array_filter($ImageList, function($eacharr) { return $eacharr['Type'] == 'S'; });

        $TransferInfo_[$t]['Image']=array_column($filtered_image_ARR, 'Url');
        $DescriptionList=$TransferInfo['DescriptionList']['Description'];

         foreach ($DescriptionList as $DescriptionListkey => $DescriptionListvalue) {
             $TransferInfo_[$t]['Description'][]=array('content'=>($DescriptionListvalue['@content']),
                'type'=>$DescriptionListvalue['@attributes']['type']
                );
         }

$PickupLocation=$eachServiceTransfervalue['PickupLocation'];
$TransferInfo_[$t]['PickupLocation']['Code']=$PickupLocation['Code'];
$TransferInfo_[$t]['PickupLocation']['Name']=$PickupLocation['Name'];
$TransferInfo_[$t]['PickupLocation']['TransferZone']=$PickupLocation['TransferZone']['Code'];

$DestinationLocation=$eachServiceTransfervalue['DestinationLocation'];
$TransferInfo_[$t]['DestinationLocation']['Code']=$DestinationLocation['Code'];
$TransferInfo_[$t]['DestinationLocation']['Name']=$DestinationLocation['Name'];
$TransferInfo_[$t]['DestinationLocation']['TransferZone']=$DestinationLocation['TransferZone']['Code'];


$DepartureTravelInfo=$eachServiceTransfervalue['DepartureTravelInfo']['DepartInfo'];
$TransferInfo_[$t]['DepartureTravelInfo']['Code']=$DepartureTravelInfo['Code'];
$TransferInfo_[$t]['DepartureTravelInfo']['Name']=$DepartureTravelInfo['Name'];
$TransferInfo_[$t]['DepartureTravelInfo']['TerminalType']=$DepartureTravelInfo['TerminalType'];
$TransferInfo_[$t]['DepartureTravelInfo']['TransferZone']=$DepartureTravelInfo['TransferZone']['Code'];

$ArrivalTravelInfo=$eachServiceTransfervalue['ArrivalTravelInfo']['ArrivalInfo'];
$TransferInfo_[$t]['ArrivalTravelInfo']['Code']=$ArrivalTravelInfo['Code'];
$TransferInfo_[$t]['ArrivalTravelInfo']['Name']=$ArrivalTravelInfo['Name'];
$TransferInfo_[$t]['ArrivalTravelInfo']['TerminalType']=$ArrivalTravelInfo['TerminalType'];
$TransferInfo_[$t]['ArrivalTravelInfo']['TransferZone']=$ArrivalTravelInfo['TransferZone']['Code'];

$TransferPickupInformation=$eachServiceTransfervalue['TransferPickupInformation'];
$TransferInfo_[$t]['TransferPickupInformation']=$TransferPickupInformation['Description'];
       



            
$ProductSpecifications=$eachServiceTransfervalue['ProductSpecifications'];
if(isset($ProductSpecifications['TransferGeneralInfoList']['TransferBulletPoint']) && array_key_exists(0, $ProductSpecifications['TransferGeneralInfoList']['TransferBulletPoint'])){
$TransferBulletPointList=$ProductSpecifications['TransferGeneralInfoList']['TransferBulletPoint'];
}else{
$TransferBulletPointList=array(0=>$ProductSpecifications['TransferGeneralInfoList']['TransferBulletPoint']);
}
foreach ($TransferBulletPointList as $TransferBulletPointkey => $TransferBulletPointvalue) {
$TransferInfo_[$t]['TransferBulletPoint'][]=array('description'=>($TransferBulletPointvalue['Description']),
'type'=>$TransferBulletPointvalue['@attributes']['id']
);
}



$TransferSpecificContent=$TransferInfo['TransferSpecificContent'];
if(isset($TransferSpecificContent['GenericTransferGuidelinesList']['TransferBulletPoint']) && array_key_exists(0, $TransferSpecificContent['GenericTransferGuidelinesList']['TransferBulletPoint'])){
$GenericTransferBulletPointList=$TransferSpecificContent['GenericTransferGuidelinesList']['TransferBulletPoint'];
}else{
$GenericTransferBulletPointList=array(0=>$TransferSpecificContent['GenericTransferGuidelinesList']['TransferBulletPoint']);
}



         foreach ($GenericTransferBulletPointList as $GenericTransferBulletPointkey => $GenericTransferBulletPointvalue) {
             $TransferInfo_[$t]['GenericTransferBulletPoint'][]=array('description'=>($GenericTransferBulletPointvalue['Description']),
                'detail_description'=>($GenericTransferBulletPointvalue['DetailedDescription']),
                'type'=>$GenericTransferBulletPointvalue['@attributes']['id']
                );
         }

       
          if(isset($TransferSpecificContent['SpecificTransferInfoList']['TransferBulletPoint']) && array_key_exists(0, $TransferSpecificContent['SpecificTransferInfoList']['TransferBulletPoint'])){
          $SpecificTransferInfoList=$TransferSpecificContent['SpecificTransferInfoList']['TransferBulletPoint'];
          }else{
           #  echo "<pre>";print_r($TransferSpecificContent);die;
          $SpecificTransferInfoList=array(0=>$TransferSpecificContent['SpecificTransferInfoList']['TransferBulletPoint']);
          }


         foreach ($SpecificTransferInfoList as $SpecificTransferInfokey => $SpecificTransferInfovalue) {
             $TransferInfo_[$t]['SpecificTransferInfoList'][]=array('description'=>($SpecificTransferInfovalue['Description']),
               
                'type'=>$SpecificTransferInfovalue['@attributes']['id']
                );
         }

          $TransferInfo_[$t]['MaximumWaitingTime']=isset($TransferSpecificContent['MaximumWaitingTime'])?$TransferSpecificContent['MaximumWaitingTime']:'';
           $TransferInfo_[$t]['Domestic_waiting']=$TransferSpecificContent['MaximumWaitingTimeSupplierDomestic'];
           $TransferInfo_[$t]['International_waiting']=$TransferSpecificContent['MaximumWaitingTimeSupplierInternational'];



 if(isset($ProductSpecifications['MasterServiceType'])){
  $TransferInfo_[$t]['MasterServiceType']=$ProductSpecifications['MasterServiceType']['@attributes']['name'];
  }


  if(isset($ProductSpecifications['MasterProductType'])){
  $TransferInfo_[$t]['MasterProductType']=$ProductSpecifications['MasterProductType']['@attributes']['name'];
  }

  if(isset($ProductSpecifications['MasterVehicleType'])){
  $TransferInfo_[$t]['MasterVehicleType']=$ProductSpecifications['MasterVehicleType']['@attributes']['name'];
  }


#echo "<pre>";print_r($MasterServiceTypeList);
        

         if(isset($eachServiceTransfervalue['CancellationPolicies']['CancellationPolicy']) && array_key_exists(0, $eachServiceTransfervalue['CancellationPolicies']['CancellationPolicy'])){
          $CancellationPoliciesList=$eachServiceTransfervalue['CancellationPolicies']['CancellationPolicy'];
          }else{
          $CancellationPoliciesList=array(0=>$eachServiceTransfervalue['CancellationPolicies']['CancellationPolicy']);
          }


         foreach ($CancellationPoliciesList as $CancellationPoliciesvalue) {
            #print_r($CancellationPoliciesvalue);
             $TransferInfo_[$t]['CancellationPolicy'][]=array('amount'=>($CancellationPoliciesvalue['@attributes']['amount']),
                 'dateFrom'=>$CancellationPoliciesvalue['@attributes']['dateFrom'],
                
                'time'=>$CancellationPoliciesvalue['@attributes']['time']
                );
         }


      
 $t++;
}


}

#print_r(($TransferInfo_));die;
return $TransferInfo_;
    }

  function veee(){
//echo $_SERVER['DOCUMENT_ROOT'];
ini_set('memory_limit', '-1');
set_time_limit(0);
ini_set('max_execution_time', 300000);
    $inputFileName ='/home/ajtrafyx/public_html/dev/goldenedge/HotelsTransfers.csv';



$file = fopen($inputFileName,"r");



$o=0;
while (($line_array = fgetcsv($file, 800000, '|')) !== false)
            {
                    
              
                
               # echo "<pre>";print_r($line_array);die;
                 $dataArray2[]=$line_array;
                /*if($line_array[0]>2){
                   
                }*/
$o++;
            }
 echo $a=count($dataArray2);
 #echo "<pre>";print_r($dataArray2);die;

    for ($i=0; $i<$a ; $i++) { 
if($i!=0){
    $data = array(
        'dest_type' => 'H',
         'hotel_code' => preg_replace("/[^0-9]/", '', $dataArray2[$i][0]),
        'dest_code' => addslashes($dataArray2[$i][19]),
        'dest_name' => addslashes($dataArray2[$i][1]),
        'longitude' => addslashes($dataArray2[$i][17]),
        'latitude' => addslashes($dataArray2[$i][18])
);

$this->db->insert('hotelbeds_terminal_list', $data);
}
}

  }
    

    

}