<?php

class Rezlive_Model extends CI_Model {

//    private $Url = 'http://test.xmlhub.com/testpanel.php/action/';
//    private $credentials = '<AgentCode>XE3FC42</AgentCode>
//                            <UserName>Redtagtravels</UserName>
//                            <Password>Redtag88!</Password>';
    
    private $Url = 'http://xmlhub.com/simulator.php/action/';
    private $credentials = '<AgentCode>X872</AgentCode>
                            <UserName>redtag</UserName>
                            <Password>2006478</Password>';
    

    function hotel_availability($searchData) {
        $Rezlive_data = '';
        $roomInfo = '';
       
        for ($i = 0; $i < $searchData['room_count']; $i++) {
            $roomInfo .= "<Room>
                            <Type>Room-".($i+1)."</Type>
                            <NoOfAdults>".$searchData['adult'][$i]."</NoOfAdults>
                            <NoOfChilds>".$searchData['child'][$i]."</NoOfChilds>";
            if (isset($searchData['child_age'][$i]) && !empty($searchData['child_age'][$i])){
               $roomInfo .= '<ChildrenAges>';
               for ($k = 0; $k < $searchData['child'][$i]; $k++) {
                   $roomInfo .= "<ChildAge>".$searchData['child_age'][$i][$k]."</ChildAge>";
               }
                $roomInfo .= '</ChildrenAges>';
                    }
               $roomInfo .= '</Room>';
        }
        
        $cin = explode('-',$searchData['cin']);
        $cout = explode('-',$searchData['cout']);
        $xml = '<?xml version="1.0"?>
                    <HotelFindRequest>
                      <Authentication>
                        '.$this->credentials.'
                      </Authentication>
                      <Booking>
                        <ArrivalDate>'.$cin[2].'/'.$cin[1].'/'.$cin[0].'</ArrivalDate>
                        <DepartureDate>'.$cout[2].'/'.$cout[1].'/'.$cout[0].'</DepartureDate>
                        <CountryCode>'.$searchData['rezCon_code'].'</CountryCode>
                        <City>'.$searchData['rez_code'].'</City>
                        <GuestNationality>'.$searchData['nation'].'</GuestNationality>
                        <HotelRatings>
                          <HotelRating>1</HotelRating>
                          <HotelRating>2</HotelRating>
                          <HotelRating>3</HotelRating>
                          <HotelRating>4</HotelRating>
                          <HotelRating>5</HotelRating>
                        </HotelRatings>
                        <Rooms>
                            '.$roomInfo.'
                        </Rooms>
                      </Booking>
                    </HotelFindRequest>';
        
        //echo $xml;die;
//echo $_SERVER['DOCUMENT_ROOT'];die;
        
        //$myfile1 = fopen($_SERVER['DOCUMENT_ROOT']."/rezlive/xml_logs/searchRQ.xml", "w");
        //fwrite($myfile1, $xml);
        //fclose($myfile1);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->Url.'findhotel');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "XML=" . urlencode($xml));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        //$myfile1 = fopen($_SERVER['DOCUMENT_ROOT']."/agent/xml_logs/searchRS.xml", "w");
        //fwrite($myfile1, $response);
        //fclose($myfile1);
       // print_r($response);die;
        $res = new DOMDocument();
        $res->loadXML($response);
        if ($res->getElementsByTagName('HotelFindResponse')->length > 0) {
            if($res->getElementsByTagName('HotelFindResponse')->item(0)->getElementsByTagName('Hotel')->length > 0){
                $hotels = $res->getElementsByTagName('Hotel');
                $i = 0;
                foreach ($hotels as $hotel) {
                    $Rezlive_data[$i]['id'] = $i;
                    $Rezlive_data[$i]['SearchSessionId'] = $res->getElementsByTagName('HotelFindResponse')->item(0)->getElementsByTagName('SearchSessionId')->item(0)->nodeValue;
                    $Rezlive_data[$i]['api'] = 'rezlive';
                    $Rezlive_data[$i]['hotel_id'] = $hotel->getElementsByTagName('Id')->item(0)->nodeValue;
                    $Rezlive_data[$i]['name'] = $hotel->getElementsByTagName('Name')->item(0)->nodeValue;
                    $Rezlive_data[$i]['star'] = $hotel->getElementsByTagName('Rating')->item(0)->nodeValue;
                    $Rezlive_data[$i]['image'] = $hotel->getElementsByTagName('ThumbImages')->item(0)->nodeValue;
                    $Rezlive_data[$i]['Price'] = $hotel->getElementsByTagName('Price')->item(0)->nodeValue;
                    if($hotel->getElementsByTagName('RoomDetails')->length > 0 && $hotel->getElementsByTagName('RoomDetails')->item(0)->getElementsByTagName('RoomDetail')->length > 0){
                        $rooms = $hotel->getElementsByTagName('RoomDetails')->item(0)->getElementsByTagName('RoomDetail');
                        $j = 0;
                        foreach($rooms as $room){
                            $Rezlive_data[$i]['rooms'][$j]['Type'] = $room->getElementsByTagName('Type')->item(0)->nodeValue;
                            $Rezlive_data[$i]['rooms'][$j]['BookingKey'] = $room->getElementsByTagName('BookingKey')->item(0)->nodeValue;
                            $Rezlive_data[$i]['rooms'][$j]['Adults'] = $room->getElementsByTagName('Adults')->item(0)->nodeValue;
                            $Rezlive_data[$i]['rooms'][$j]['Children'] = $room->getElementsByTagName('Children')->item(0)->nodeValue;
                            $Rezlive_data[$i]['rooms'][$j]['ChildrenAges'] = $room->getElementsByTagName('ChildrenAges')->item(0)->nodeValue;
                            $Rezlive_data[$i]['rooms'][$j]['TotalRooms'] = $room->getElementsByTagName('TotalRooms')->item(0)->nodeValue;
                            $Rezlive_data[$i]['rooms'][$j]['TotalRate'] = $room->getElementsByTagName('TotalRate')->item(0)->nodeValue;
                            $Rezlive_data[$i]['rooms'][$j]['BoardBasis'] = $room->getElementsByTagName('BoardBasis')->item(0)->nodeValue;
                            $Rezlive_data[$i]['rooms'][$j]['RoomDescription'] = $room->getElementsByTagName('RoomDescription')->item(0)->nodeValue;
                            $Rezlive_data[$i]['rooms'][$j]['TermsAndConditions'] = $room->getElementsByTagName('TermsAndConditions')->item(0)->nodeValue;
                            $j++;
                        }
                    }
                    $i++;
                }
                return $Rezlive_data;
            }
        }
    }

    function booking_prepare($hotel_data, $room_id, $searchData) {
        $Rezlive_booking_data = '';
        $cin = explode('-',$searchData['cin']);
        $cout = explode('-',$searchData['cout']);
        $xml = '<PreBookingRequest>
                    <Authentication>
                        '.$this->credentials.'
                    </Authentication>
                    <PreBooking>
                        <SearchSessionId>'.$hotel_data['SearchSessionId'].'</SearchSessionId>
                        <ArrivalDate>'.$cin[2].'/'.$cin[1].'/'.$cin[0].'</ArrivalDate>
                        <DepartureDate>'.$cout[2].'/'.$cout[1].'/'.$cout[0].'</DepartureDate>
                        <GuestNationality>'.$searchData['nation'].'</GuestNationality>
                        <CountryCode>'.$searchData['rezCon_code'].'</CountryCode>
                        <City>'.$searchData['rez_code'].'</City>
                        <HotelId>'.$hotel_data['hotel_id'].'</HotelId>
                        <Price>'.$hotel_data['Price'].'</Price>
                        <Currency>PHP</Currency>
                        <RoomDetails>
                            <RoomDetail>
                                <Type>'.$hotel_data['rooms'][$room_id]['Type'].'</Type>
                                <BookingKey>'.$hotel_data['rooms'][$room_id]['BookingKey'].'</BookingKey>
                                <Adults>'.$hotel_data['rooms'][$room_id]['Adults'].'</Adults>
                                <Children>'.$hotel_data['rooms'][$room_id]['Children'].'</Children>
                                <ChildrenAges>'.$hotel_data['rooms'][$room_id]['ChildrenAges'].'</ChildrenAges>
                                <TotalRooms>'.$hotel_data['rooms'][$room_id]['TotalRooms'].'</TotalRooms>
                                <TotalRate>'.$hotel_data['rooms'][$room_id]['TotalRate'].'</TotalRate>
                            </RoomDetail>
                        </RoomDetails>
                    </PreBooking>
                </PreBookingRequest>';
        //echo $xml;die;
        $myfile1 = fopen($_SERVER['DOCUMENT_ROOT']."/rezlive/xml_logs/PreBookingRequest.xml", "w");
        fwrite($myfile1, $xml);
        fclose($myfile1);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->Url.'prebook');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "XML=" . urlencode($xml));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        //print_r($xmlResponse);die;
        $myfile1 = fopen($_SERVER['DOCUMENT_ROOT']."/rezlive/xml_logs/PreBookingResponse.xml", "w");
        fwrite($myfile1, $response);
        fclose($myfile1);
        $res = new DOMDocument();
        $res->loadXML($response);
        if ($res->getElementsByTagName('PreBookingResponse')->length > 0) {
            $cancelDataArray = '';
            $cancelData = '';
            if($res->getElementsByTagName('CancellationInformations')->length > 0){
                if($res->getElementsByTagName('CancellationInformation')->length > 0){
                    $cancels = $res->getElementsByTagName('CancellationInformation');
                    foreach($cancels as $cancel){
                        $startDate = $cancel->getElementsByTagName('StartDate')->item(0)->nodeValue;
                        $endDate = $cancel->getElementsByTagName('EndDate')->item(0)->nodeValue;
                        $chargeType = $cancel->getElementsByTagName('ChargeType')->item(0)->nodeValue;
                        $ChargeAmount = $cancel->getElementsByTagName('ChargeAmount')->item(0)->nodeValue;
                        $Currency = $cancel->getElementsByTagName('Currency')->item(0)->nodeValue;
                        $cancelDataArray .= $startDate.'|'.$endDate.'|'.$chargeType.'|'.$ChargeAmount.'|'.$Currency.'<br>';
                    }
                    
                    $cancelInfo = $res->getElementsByTagName('CancellationInformations')->item(0)->getElementsByTagName('Info')->item(0)->nodeValue;
                }
            }
            $Rezlive_booking_data['City'] = $res->getElementsByTagName('City')->item(0)->nodeValue;
            $Rezlive_booking_data['CountryCode'] = $res->getElementsByTagName('CountryCode')->item(0)->nodeValue;
            $Rezlive_booking_data['Currency'] = $res->getElementsByTagName('Currency')->item(0)->nodeValue;
            $Rezlive_booking_data['Type'] = $res->getElementsByTagName('Type')->item(0)->nodeValue;
            $Rezlive_booking_data['Adults'] = $res->getElementsByTagName('Adults')->item(0)->nodeValue;
            $Rezlive_booking_data['Children'] = $res->getElementsByTagName('Children')->item(0)->nodeValue;
            $Rezlive_booking_data['ChildrenAges'] = $res->getElementsByTagName('ChildrenAges')->item(0)->nodeValue;
            $Rezlive_booking_data['TotalRooms'] = $res->getElementsByTagName('TotalRooms')->item(0)->nodeValue;
            $Rezlive_booking_data['room_price'] = $res->getElementsByTagName('TotalRate')->item(0)->nodeValue;
            $Rezlive_booking_data['TermsAndConditions'] = $res->getElementsByTagName('TermsAndConditions')->item(0)->nodeValue;
            $Rezlive_booking_data['cancelData'] = $cancelDataArray;
            $Rezlive_booking_data['cancelInfo'] = $cancelInfo;
            $Rezlive_booking_data['BookingKey'] = $res->getElementsByTagName('RoomDetail')->item(0)->getElementsByTagName('BookingKey')->item(0)->nodeValue;
            $Rezlive_booking_data['final_price'] = $res->getElementsByTagName('PreBookingDetails')->item(0)->getElementsByTagName('BookingAfterPrice')->item(0)->nodeValue;
        }
        
        return $Rezlive_booking_data;
    }

    function booking($masterId, $postData, $details, $room_id,$bookingPrepare,$searchData,$cur_val,$admin_markup,$agent_markup) {
        die;
        $status = '';
        $paymentStatus = 'Pending';
        $cin = explode('-',$searchData['cin']);
        $cout = explode('-',$searchData['cout']);
        $guests = '';
        for ($i = 0; $i < $searchData['room_count']; $i++) {
        $guests .= '<Guests>';
            for ($j = 0; $j < $searchData['adult'][$i]; $j++) {    
            $guests .= '<Guest>
                            <Salutation>'.$postData['adulttitle'][$i][$j].'</Salutation>
                            <FirstName>'.$postData['adultFname'][$i][$j].'</FirstName>
                            <LastName>'.$postData['adultLname'][$i][$j].'</LastName>
                        </Guest>';
            }
            if ($searchData['child_age'] != '') {
                for ($k = 0; $k < $searchData['child'][$i]; $k++) {
                    $guests .= '<Guest>
                            <Salutation>Child</Salutation>
                            <FirstName>'.$postData['childFname'][$i][$k].'</FirstName>
                            <LastName>'.$postData['childLname'][$i][$k].'</LastName>
                            <IsChild>1</IsChild>
                            <Age>'.$searchData['child_age'][$i][$k].'</Age>
                        </Guest>';
                }
            }
        $guests .= '</Guests>';
        }
        $xml = '<?xml version="1.0"?>
                <BookingRequest>
                    <Authentication>
                        '.$this->credentials.'
                    </Authentication>
                    <Booking>
                        <SearchSessionId>'.$details['SearchSessionId'].'</SearchSessionId>
                        <AgentRefNo>RDT12313</AgentRefNo>
                        <ArrivalDate>'.$cin[2].'/'.$cin[1].'/'.$cin[0].'</ArrivalDate>
                        <DepartureDate>'.$cout[2].'/'.$cout[1].'/'.$cout[0].'</DepartureDate>
                        <GuestNationality>'.$searchData['nation'].'</GuestNationality>
                        <CountryCode>'.$bookingPrepare['CountryCode'].'</CountryCode>
                        <City>'.$bookingPrepare['City'].'</City>
                        <HotelId>'.$details['hotel_id'].'</HotelId>
                        <Name>'.$details['name'].'</Name>
                        <Currency>'.$bookingPrepare['Currency'].'</Currency>
                        <RoomDetails>
                            <RoomDetail>
                                <Type>'.$bookingPrepare['Type'].'</Type>
                                <BookingKey>'.$bookingPrepare['BookingKey'].'</BookingKey>
                                <Adults>'.$bookingPrepare['Adults'].'</Adults>
                                <Children>'.$bookingPrepare['Children'].'</Children>
                                <ChildrenAges>'.$bookingPrepare['ChildrenAges'].'</ChildrenAges>
                                <TotalRooms>'.$bookingPrepare['TotalRooms'].'</TotalRooms>
                                <TotalRate>'.$bookingPrepare['room_price'].'</TotalRate>
                                '.$guests.'
                            </RoomDetail>
                        </RoomDetails>
                    </Booking>
                </BookingRequest>';
        
//        echo $xml;die;
        $myfile1 = fopen($_SERVER['DOCUMENT_ROOT']."/rezlive/xml_logs/BookingRequest.xml", "w");
        fwrite($myfile1, $xml);
        fclose($myfile1);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->Url.'bookhotel');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "XML=" . urlencode($xml));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $xmlResponse = curl_exec($ch);
        curl_close($ch);
        $myfile1 = fopen($_SERVER['DOCUMENT_ROOT']."/rezlive/xml_logs/BookingResposne.xml", "w");
        fwrite($myfile1, $xmlResponse);
        fclose($myfile1);
        //print_r($xmlResponse);//die;
        if($xmlResponse != ''){
            $res = new DOMDocument();
            $res->loadXML($xmlResponse);
            $myfile = fopen($_SERVER['DOCUMENT_ROOT']."/rezlive_xml_logs/booking1.xml", "w");
            fwrite($myfile, $xmlResponse);
            fclose($myfile);
            $Rezlive_booking_data = '';
            if ($res->getElementsByTagName('BookingResponse')->length > 0) {
                $booking = $res->getElementsByTagName('BookingResponse');
                if($booking->item(0)->getElementsByTagName('BookingDetails')->item(0)->getElementsByTagName('BookingId')->length > 0){
                    $Rezlive_booking_data['Id'] = $booking->item(0)->getElementsByTagName('BookingDetails')->item(0)->getElementsByTagName('BookingId')->item(0)->nodeValue;
                } else $Rezlive_booking_data['Id'] ='';
                if($booking->item(0)->getElementsByTagName('BookingDetails')->item(0)->getElementsByTagName('BookingCode')->length > 0){
                    $Rezlive_booking_data['VoucherRef'] = $booking->item(0)->getElementsByTagName('BookingDetails')->item(0)->getElementsByTagName('BookingCode')->item(0)->nodeValue;
                } else $Rezlive_booking_data['VoucherRef'] = '';

                if($booking->item(0)->getElementsByTagName('BookingDetails')->item(0)->getElementsByTagName('BookingStatus')->length > 0){
                    $Rezlive_booking_data['status'] = $booking->item(0)->getElementsByTagName('BookingDetails')->item(0)->getElementsByTagName('BookingStatus')->item(0)->nodeValue;
                    $status = $Rezlive_booking_data['status'];
                } else $Rezlive_booking_data['status'] = 'Failed';
                if (isset($Rezlive_booking_data['Status']) && $Rezlive_booking_data['Status'] == 'Confirmed') {
                    $paymentStatus = 'Success';
                } else {
                    $paymentStatus = 'Pending';
                }
            } else {
                $status = 'Failed';
                $paymentStatus = 'Pending';
            }
            //echo '<pre />';print_r($Rezlive_booking_data);die;
            $message = "";
            $cancel_policy = "";
            $cancelFrom = "";
            $cancelAmount = "";
            $h = 1;
            if ($Rezlive_booking_data != '') {
                $this->db->query($sql = "update hotel_booking_master set api_ref_id='" . $Rezlive_booking_data['Id'] . "',confirmation_number='" . $Rezlive_booking_data['VoucherRef'] . "',booking_status='" . $status . "',payment_status='" . $paymentStatus . "',remarks='" . $bookingPrepare['TermsAndConditions'] . "' where id='" . $masterId . "'");
                $this->db->query($sql = "update hotel_booking_room_details set cancellation_policy='" . $bookingPrepare['cancelData'] . "', cancellation_till_date='',cancellation_till_charge='' where master_id='" . $masterId . "'");
            } else {
                $this->db->query($sql = "update hotel_booking_master set api_ref_id='xxxxxxx',confirmation_number='xxxxxxxxx',booking_status='" . $status . "',payment_status='" . $paymentStatus . "' where id='" . $masterId . "'");
            }
        } else {
            $this->db->query($sql = "update hotel_booking_master set api_ref_id='xxxxxxx',confirmation_number='xxxxxxxxx',booking_status='Failed',payment_status='Pending' where id='" . $masterId . "'");
        }

        return $status;
    }

    function booking_cancel($id) {
        $id = '720098526';
        $xml = '<BookingCancel xmlns="http://www.reservwire.com/namespace/WebServices/Xml">
                        <Authority xmlns="http://www.reservwire.com/namespace/WebServices/Xml">
                            <Org>llea</Org>
                            <User>xmltest</User>
                            <Password>xmltest</Password>
                            <Currency>USD</Currency>
                            <Language>en</Language>
                            <TestDebug>false</TestDebug>
                            <Version>1.26</Version>
                        </Authority>
                        <BookingId>' . $id . '</BookingId>
                        <CommitLevel>confirm</CommitLevel>
                      </BookingCancel>';

        //echo $xml;//die;
        $CURL = curl_init();
        curl_setopt($CURL, CURLOPT_URL, 'http://roomsxmldemo.com/RXLStagingServices/ASMX/XmlService.asmx');
        curl_setopt($CURL, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($CURL, CURLOPT_POST, 1);
        curl_setopt($CURL, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($CURL, CURLOPT_HEADER, false);
        curl_setopt($CURL, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($CURL, CURLOPT_HTTPHEADER, array('Accept: text/xml', 'Content-Type: text/xml'));
        curl_setopt($CURL, CURLOPT_RETURNTRANSFER, true);
        $xmlResponse = curl_exec($CURL);
        print_r($xmlResponse);
        die;
    }


 public function pre_book_getcancellationpolicy($data) {
#echo "<pre>";print_r($data);
$room_id= $data['room_id'];
$room_data = $data['hotel_data']['rooms'][$room_id];
if($data['api_id']==3){
$cin_ = explode('-',$data['Search_data']['cin']);
$cin = array_reverse($cin_);
$cin_date = implode('/',$cin);
$cout_= explode('-',$data['Search_data']['cout']);
$cout= array_reverse($cout_);
$cout_date = implode('/',$cout);
       
      
        $xml = '<?xml version="1.0"?>
<CancellationPolicyRequest>
  <Authentication>
  '.$this->credentials.'
 </Authentication>
  <HotelId>'.$data['hotel_data']['hotel_id'].'</HotelId>
  <ArrivalDate>'.$cin_date.'</ArrivalDate>
  <DepartureDate>'.$cout_date.'</DepartureDate>
  <CountryCode>'.$data['Search_data']['rezCon_code'].'</CountryCode>
  <City>'.$data['Search_data']['rez_code'].'</City>
  <GuestNationality>'.$data['Search_data']['nation'].'</GuestNationality>
  <Currency>PHP</Currency>
  <RoomDetails>
    <RoomDetail>
      <BookingKey>'.$room_data['BookingKey'].'</BookingKey>
      <Adults>'.$room_data['Adults'].'</Adults>
      <Children>'.$room_data['Children'].'</Children>
      <ChildrenAges>'.$room_data['ChildrenAges'].'</ChildrenAges>
      <Type>'.$room_data['Type'].'</Type>
    </RoomDetail>
  </RoomDetails>
</CancellationPolicyRequest>';
        
        #echo $xml;#die;

        
       
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://test.xmlhub.com/testpanel.php/action/getcancellationpolicy');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "XML=" . urlencode($xml));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);
        curl_close($ch);
return $response;
        
}
        }


 public function post_book_getcancellationpolicy($data) {
#echo "<pre>";print_r($data);

if($data['api_id']==3){
 $xml = '<?xml version="1.0"?>
<CancellationPolicyAfterBookingRequest>
  <Authentication>
  '.$this->credentials.'
 </Authentication>
  <BookingId>'.$data['BookingId'].'</BookingId>
  <BookingCode>'.$data['BookingCode'].'</BookingCode>
</CancellationPolicyAfterBookingRequest>';
        
        #echo $xml;#die;

        
       
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://test.xmlhub.com/testpanel.php/action/getCancellationPolicyAfterBooking');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "XML=" . urlencode($xml));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);
        curl_close($ch);
return $response;
        
}
        }

 public function CancellationRequest($data) {
#echo "<pre>";print_r($data);

if($data['api_id']==3){
 $xml = '<?xml version="1.0"?>
<CancellationRequest>
  <Authentication>
  '.$this->credentials.'
 </Authentication>
 <Cancellation>
  <BookingId>'.$data['BookingId'].'</BookingId>
  <BookingCode>'.$data['BookingCode'].'</BookingCode>
 </Cancellation>
</CancellationRequest>';
        
        echo $xml;//die;

        
       
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://test.xmlhub.com/testpanel.php/action/cancelhotel');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "XML=" . urlencode($xml));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);
        curl_close($ch);
        //echo $response;die;
return $response;
        
}
        }



}
