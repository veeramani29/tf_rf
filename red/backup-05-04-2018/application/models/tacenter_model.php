<?php

class Tacenter_Model extends CI_Model {

    private $Url = 'http://ws.asiatravel.net/HotelB2BAPI/atHotelsService.asmx';
    private $Username = 'rtttest';
    private $Password = 'rtt888#';
    

    function hotel_availability($searchData) {
        $Tacenter_data = '';
        //echo '<pre />';print_r($searchData);die;
        $roomInfo = '';
        for ($i = 0; $i < $searchData['room_count']; $i++) {
            $roomInfo .= '<RoomSearchInfo>';
            $roomInfo .= '<NoAdult>'.$searchData['adult'][$i].'</NoAdult>';
            $roomInfo .= '<NoChild>'.$searchData['child'][$i].'</NoChild>';
            if (isset($searchData['child_age'][$i]) && !empty($searchData['child_age'][$i])){
                $roomInfo .= '<ChildAge>';
                for ($k = 0; $k < $searchData['child'][$i]; $k++) {
                    $roomInfo .= '<int>'.$searchData['child_age'][$i][$k].'</int>';
                }
                $roomInfo .= '</ChildAge>';
            }
            $roomInfo .= '</RoomSearchInfo>';
        }
        
        $xml = '<?xml version="1.0" encoding="utf-8"?>
                    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                      <soap:Header>
                        <SOAPHeaderAuthentication xmlns="http://instantroom.com/">
                          <UserName>'.$this->Username.'</UserName>
                          <Password>'.$this->Password.'</Password>
                          <Culture>en-US</Culture>
                        </SOAPHeaderAuthentication>
                      </soap:Header>
                      <soap:Body>
                        <SearchHotelsByDestV2 xmlns="http://instantroom.com/">
                          <CountryCode>'.trim($searchData['taCon_code']).'</CountryCode>
                          <CityCode>'.trim($searchData['ta_code']).'</CityCode>
                          <CheckIndate>'.$searchData['cin'].'</CheckIndate>
                          <CheckoutDate>'.$searchData['cout'].'</CheckoutDate>
                          <RoomInfo>
                            '.$roomInfo.'
                          </RoomInfo>
                          <InstantConfirmationOnly>true</InstantConfirmationOnly>
                        </SearchHotelsByDestV2>
                      </soap:Body>
                    </soap:Envelope>';
        
        //echo $xml;//die;
        $httpHeader2 = array( "Content-Type: text/xml; charset=utf-8");
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $this->Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // username and password - declared at the top of the doc
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml); // the SOAP request
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader2);
        $response = curl_exec($ch);
        curl_close($ch); 
        //print_r($response);die;
        $res = new DOMDocument();
        $res->loadXML($response);
        if ($res->getElementsByTagName('AT_HotelList')->length > 0) {
            if($res->getElementsByTagName('AT_HotelList')->item(0)->getElementsByTagName('Hotel')->length > 0){
                $hotels = $res->getElementsByTagName('AT_HotelList')->item(0)->getElementsByTagName('Hotel');
                $i = 0;
                foreach ($hotels as $hotel) {
                    $Tacenter_data[$i]['id'] = $i;
                    $Tacenter_data[$i]['api'] = 'tacenter';
                    $Tacenter_data[$i]['hotel_id'] = $hotel->getElementsByTagName('HotelCode')->item(0)->nodeValue;
                    $Tacenter_data[$i]['name'] = $hotel->getElementsByTagName('HotelName')->item(0)->nodeValue;
                    $Tacenter_data[$i]['StarRating'] = $hotel->getElementsByTagName('StarRating')->item(0)->nodeValue;
                    $Tacenter_data[$i]['Category'] = $hotel->getElementsByTagName('Category')->item(0)->nodeValue;
                    $Tacenter_data[$i]['Address'] = $hotel->getElementsByTagName('Address')->item(0)->nodeValue;
                    $Tacenter_data[$i]['Location'] = $hotel->getElementsByTagName('Location')->item(0)->nodeValue;
                    $Tacenter_data[$i]['AvgPrice'] = $hotel->getElementsByTagName('AvgPrice')->item(0)->nodeValue;
                    $Tacenter_data[$i]['Availability'] = $hotel->getElementsByTagName('Availability')->item(0)->nodeValue;
                    if($hotel->getElementsByTagName('FrontPgImage')->length > 0){
                        $Tacenter_data[$i]['FrontPgImage'] = $hotel->getElementsByTagName('FrontPgImage')->item(0)->nodeValue;
                    } else {
                        $Tacenter_data[$i]['FrontPgImage'] = '';
                    }
                    $Tacenter_data[$i]['HotelReviewScore'] = $hotel->getElementsByTagName('HotelReviewScore')->item(0)->nodeValue;
                    $Tacenter_data[$i]['HotelReviewCount'] = $hotel->getElementsByTagName('HotelReviewCount')->item(0)->nodeValue;
                    $Tacenter_data[$i]['IsBestDeal'] = $hotel->getElementsByTagName('IsBestDeal')->item(0)->nodeValue;
                    if ($hotel->getElementsByTagName('Room')->length > 0) {
                        $rooms = $hotel->getElementsByTagName('Room');
                        $j = 0;
                        $totPriceArr = array();
                        foreach ($rooms as $room) {
                            $Tacenter_data[$i]['room'][$j]['price'] = 0;
                            $Tacenter_data[$i]['room'][$j]['org_price'] = 0;
                            $Tacenter_data[$i]['room'][$j]['RoomCode'] = $room->getElementsByTagName('RoomCode')->item(0)->nodeValue;
                            $Tacenter_data[$i]['room'][$j]['RoomName'] = $room->getElementsByTagName('RoomName')->item(0)->nodeValue;
                            $Tacenter_data[$i]['room'][$j]['AvgPrice'] = $room->getElementsByTagName('AvgPrice')->item(0)->nodeValue;
                            $Tacenter_data[$i]['room'][$j]['NormalOccupancy'] = $room->getElementsByTagName('NormalOccupancy')->item(0)->nodeValue;
                            $Tacenter_data[$i]['room'][$j]['MaxOccupancy'] = $room->getElementsByTagName('MaxOccupancy')->item(0)->nodeValue;
                            if($room->getElementsByTagName('RoomAvailabilityAndInclusion')->length > 0){
                                $inc = $room->getElementsByTagName('RoomAvailabilityAndInclusion');
                                $a = 0;
                                if($room->getElementsByTagName('RoomAvailabilityAndInclusion')->length > 1){
                                    foreach($inc as $include){
                                        $Tacenter_data[$i]['room'][$j]['inc'][$a]['Availability'] = $include->getElementsByTagName('Availability')->item(0)->nodeValue;
                                        $Tacenter_data[$i]['room'][$j]['inc'][$a]['Inclusion'] = $include->getElementsByTagName('Inclusion')->item(0)->nodeValue;
                                        $Tacenter_data[$i]['room'][$j]['inc'][$a]['Breakfast'] = $include->getElementsByTagName('Breakfast')->item(0)->nodeValue;
                                        $a++;
                                    } 
                                } else {
                                    $Tacenter_data[$i]['room'][$j]['inc'][$a]['Availability'] = $inc->item(0)->getElementsByTagName('Breakfast')->item(0)->nodeValue;
                                    $Tacenter_data[$i]['room'][$j]['inc'][$a]['Inclusion'] = $inc->item(0)->getElementsByTagName('Inclusion')->item(0)->nodeValue;
                                    $Tacenter_data[$i]['room'][$j]['inc'][$a]['Breakfast'] = $inc->item(0)->getElementsByTagName('Breakfast')->item(0)->nodeValue;
                                }
                            } else {
                                $Tacenter_data[$i]['room'][$j]['inc'] = '';
                            }
                            
                            if($room->getElementsByTagName('RoomOccupancySeq')->length > 0){
                                $seqnce = $room->getElementsByTagName('RoomOccupancySeq');
                                $s = 0;
                                if($room->getElementsByTagName('RoomOccupancySeq')->length > 1){
                                    foreach($seqnce as $seq){
                                        $Tacenter_data[$i]['room'][$j]['seq'][$s]['Occupancy'] = $seq->getElementsByTagName('Occupancy')->item(0)->nodeValue;
                                        $Tacenter_data[$i]['room'][$j]['seq'][$s]['RoomCode'] = $seq->getElementsByTagName('RoomCode')->item(0)->nodeValue;
                                        $Tacenter_data[$i]['room'][$j]['seq'][$s]['Seq'] = $seq->getElementsByTagName('Seq')->item(0)->nodeValue;
                                        $s++;
                                    }
                                } else {
                                    $Tacenter_data[$i]['room'][$j]['seq'][$s]['Occupancy'] = $seqnce->item(0)->getElementsByTagName('Occupancy')->item(0)->nodeValue;
                                    $Tacenter_data[$i]['room'][$j]['seq'][$s]['RoomCode'] = $seqnce->item(0)->getElementsByTagName('RoomCode')->item(0)->nodeValue;
                                    $Tacenter_data[$i]['room'][$j]['seq'][$s]['Seq'] = $seqnce->item(0)->getElementsByTagName('Seq')->item(0)->nodeValue;
                                }
                            } else {
                                $Tacenter_data[$i]['room'][$j]['seq'] = '';
                            }
                            
                            if($room->getElementsByTagName('RoomOccupancyRate')->length > 0){
                                $rates = $room->getElementsByTagName('RoomOccupancyRate');
                                $r = 0;
                                if($room->getElementsByTagName('RoomOccupancyRate')->length > 1){
                                    foreach($rates as $rate){
                                        $Tacenter_data[$i]['room'][$j]['rates'][$r]['Rate'] = $rate->getElementsByTagName('Rate')->item(0)->nodeValue;
                                        $Tacenter_data[$i]['room'][$j]['price'] = ($Tacenter_data[$i]['room'][$j]['price']+$Tacenter_data[$i]['room'][$j]['rates'][$r]['Rate']);
                                        $Tacenter_data[$i]['room'][$j]['org_price'] = ($Tacenter_data[$i]['room'][$j]['org_price']+$Tacenter_data[$i]['room'][$j]['rates'][$r]['Rate']);
                                        $r++;
                                    }
                                } else {
                                    $Tacenter_data[$i]['room'][$j]['rates'][$r]['Rate'] = $rates->item(0)->getElementsByTagName('Rate')->item(0)->nodeValue;
                                    $Tacenter_data[$i]['room'][$j]['price'] = ($Tacenter_data[$i]['room'][$j]['price']+$Tacenter_data[$i]['room'][$j]['rates'][$r]['Rate']);
                                    $Tacenter_data[$i]['room'][$j]['org_price'] = ($Tacenter_data[$i]['room'][$j]['org_price']+$Tacenter_data[$i]['room'][$j]['rates'][$r]['Rate']);
                                }
                            } else {
                                $Tacenter_data[$i]['room'][$j]['rates'] = '';
                            }
                            
                            $totPriceArr[] = $Tacenter_data[$i]['room'][$j]['price'];
                            $j++;
                        }
                    }
                    
                    
                    $Tacenter_data[$i]['tot_price'] = min($totPriceArr);
                    $i++;
                }
                return $Tacenter_data;
            }
        }
    }
    
    function getHotelInformation($hotelId){
        $xml = '<?xml version="1.0" encoding="utf-8"?>
                    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                      <soap:Header>
                        <SOAPHeaderAuthentication xmlns="http://instantroom.com/">
                          <UserName>'.$this->Username.'</UserName>
                          <Password>'.$this->Password.'</Password>
                          <Culture>en-US</Culture>
                        </SOAPHeaderAuthentication>
                      </soap:Header>
                      <soap:Body>
                        <RetrieveHotelInformationV2 xmlns="http://instantroom.com/">
                          <intHotelID>'.$hotelId.'</intHotelID>
                        </RetrieveHotelInformationV2>
                      </soap:Body>
                    </soap:Envelope>';
        $httpHeader2 = array( "Content-Type: text/xml; charset=utf-8");
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $this->Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // username and password - declared at the top of the doc
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml); // the SOAP request
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader2);
        $response = curl_exec($ch);
        curl_close($ch); 
        //print_r($response);die;
        $res = new DOMDocument();
        $res->loadXML($response);
        $details = '';
        if($res->getElementsByTagName('AT_HotelDetails')->length > 0) {
            if($res->getElementsByTagName('HotelGenInfo')->length > 0){
                $hotelInfo = $res->getElementsByTagName('HotelGenInfo');
                $details['HotelDesc'] = $hotelInfo->item(0)->getElementsByTagName('HotelDesc')->item(0)->nodeValue;
                $details['Direction'] = $hotelInfo->item(0)->getElementsByTagName('Direction')->item(0)->nodeValue;
                $details['CheckInTime'] = $hotelInfo->item(0)->getElementsByTagName('CheckInTime')->item(0)->nodeValue;
                $details['CheckOutTime'] = $hotelInfo->item(0)->getElementsByTagName('CheckOutTime')->item(0)->nodeValue;
                $details['Longitude'] = $hotelInfo->item(0)->getElementsByTagName('Longitude')->item(0)->nodeValue;
                $details['Latitude'] = $hotelInfo->item(0)->getElementsByTagName('Latitude')->item(0)->nodeValue;
                if($hotelInfo->item(0)->getElementsByTagName('HotelImages')->length > 0){
                    $images = $hotelInfo->item(0)->getElementsByTagName('HotelImages');
                    $i = 0;
                    foreach($images as $image){
                        $details['images'][$i] = $image->getElementsByTagName('ImageFileName')->item(0)->nodeValue;
                        $i++;
                    }
                } else {
                    $details['images'] = '';
                }
                
                if($hotelInfo->item(0)->getElementsByTagName('HotelFacility')->length > 0){
                    $facilitys = $hotelInfo->item(0)->getElementsByTagName('HotelFacility');
                    $i = 0;
                    foreach($facilitys as $facility){
                        $details['facility'][$i] = $facility->getElementsByTagName('FeatureDesc')->item(0)->nodeValue;
                        $i++;
                    }
                } else {
                    $details['facility'] = '';
                }
            }
        }
        
        return $details;
    }

   
    function booking($masterId, $postData, $details, $room_id,$searchData,$cur_val,$admin_markup,$agent_markup) {
        $status = '';
        $paymentStatus = 'Pending';
        $pax = '';
        $sal = ($postData['adulttitle'][0][0] == 'Mr' ? '0' : '1');
        $sal1 = ($postData['adulttitle'][0][0] == 'Mrs'? 'Ms' : $postData['adulttitle'][0][0]);
        $fname = $postData['adultFname'][0][0];
        $lname = $postData['adultLname'][0][0];
        
        for ($i = 0; $i < $searchData['room_count']; $i++) {
        $pax .= '<RoomReserveInfo>
                    <RoomId>'.$details['room'][$room_id]['seq'][$i]['RoomCode'].'</RoomId>
                    <OccupancyId>'.$details['room'][$room_id]['seq'][$i]['Occupancy'].'</OccupancyId>
                    <NoAdult>'.$searchData['adult'][$i].'</NoAdult>
                    <NoChild>'.$searchData['child'][$i].'</NoChild>';
                    if($searchData['child'][$i] > 0){
                        for ($k = 0; $k < $searchData['child'][$i]; $k++) {
               $pax .= '<ChildAge'.($k+1).'>'.$searchData['child_age'][$i][$k].'</ChildAge'.($k+1).'>';
                        }
                    }
          $pax .= '<PaxInfo>
                      <GuestTitle>'.$sal1.'</GuestTitle>
                      <FirstName>'.$fname.'</FirstName>
                      <LastName>'.$lname.'</LastName>
                    </PaxInfo>
                  </RoomReserveInfo>';
        }
        $xml = '<?xml version="1.0" encoding="utf-8"?>
                <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                  <soap:Header>
                    <SOAPHeaderAuthentication xmlns="http://instantroom.com/">
                        <UserName>'.$this->Username.'</UserName>
                        <Password>'.$this->Password.'</Password>
                        <Culture>en-US</Culture>
                    </SOAPHeaderAuthentication>
                  </soap:Header>
                  <soap:Body>
                    <BookHotel xmlns="http://instantroom.com/">
                      <HotelID>'.$details['hotel_id'].'</HotelID>
                      <RoomID>'.$details['room'][$room_id]['RoomCode'].'</RoomID>
                      <CheckInDate>'.$searchData['cin'].'</CheckInDate>
                      <CheckOutDate>'.$searchData['cout'].'</CheckOutDate>
                      <GuestContactDetails>
                        <Salutation>'.$sal.'</Salutation>
                        <ContactPersonFirstName>'.$fname.'</ContactPersonFirstName>
                        <ContactPersonLastName>'.$lname.'</ContactPersonLastName>
                        <Email>'.$postData['user_email'].'</Email>
                        <AlternateEmail></AlternateEmail>
                        <PhoneNo>'.$postData['user_mobile'].'</PhoneNo>
                        <FaxNo></FaxNo>
                        <MobileNo></MobileNo>
                        <Address></Address>
                        <PostalCode></PostalCode>
                        <City></City>
                        <Company></Company>
                        <Nationality>'.$searchData['nation'].'</Nationality>
                        <CountryOfResidence>'.$searchData['nation'].'</CountryOfResidence>
                        <SpecialRequest></SpecialRequest>
                      </GuestContactDetails>
                      <RoomInfo>
                        '.$pax.'
                      </RoomInfo>
                      <PaymentType>CreditLimit</PaymentType>
                      <TotalRoomRate>'.$details['room'][$room_id]['org_price'].'</TotalRoomRate>
                      <Availability>true</Availability>
                      <AgentRefNo>abc1234</AgentRefNo>
                    </BookHotel>
                  </soap:Body>
                </soap:Envelope>';
//        $myfile1 = fopen($_SERVER['DOCUMENT_ROOT']."/xml_logs/BookingRQ.xml", "w");
//        fwrite($myfile1, $xml);
//        fclose($myfile1);
        //echo $xml;die;
        $httpHeader2 = array( "Content-Type: text/xml; charset=utf-8");
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $this->Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // username and password - declared at the top of the doc
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml); // the SOAP request
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader2);
        $response = curl_exec($ch);
        curl_close($ch); 
//        $myfile1 = fopen($_SERVER['DOCUMENT_ROOT']."/xml_logs/BookingRS.xml", "w");
//        fwrite($myfile1, $response);
//        fclose($myfile1);
        //print_r($response);die;
        
        $bookingId = '';
        $bookingStatus = '';
        $checkinDate = '';
        $checkoutDate = '';
        $totalFare = '';
        $currency = '';
        $remarks = '';
        $cancelPolicy = '';
        if($response != ''){
            $res = new DOMDocument();
            $res->loadXML($response);
            if ($res->getElementsByTagName('AT_BookingDetails')->length > 0) {
                if($res->getElementsByTagName('Booking')->length > 0){
                    $booking = $res->getElementsByTagName('Booking');
                    if($booking->item(0)->getElementsByTagName('BookingConfirmationNo')->length > 0){
                        $bookingId = $booking->item(0)->getElementsByTagName('BookingConfirmationNo')->item(0)->nodeValue;
                    }
                    if($booking->item(0)->getElementsByTagName('Status')->length > 0){
                        $bookingStatus = $booking->item(0)->getElementsByTagName('Status')->item(0)->nodeValue;
                    }
                    if($booking->item(0)->getElementsByTagName('CheckInDate')->length > 0){
                        $checkinDate = $booking->item(0)->getElementsByTagName('CheckInDate')->item(0)->nodeValue;
                    }
                    if($booking->item(0)->getElementsByTagName('CheckOutDate')->length > 0){
                        $checkoutDate = $booking->item(0)->getElementsByTagName('CheckOutDate')->item(0)->nodeValue;
                    }
                    if($booking->item(0)->getElementsByTagName('TotalPrice')->length > 0){
                        $totalFare = $booking->item(0)->getElementsByTagName('TotalPrice')->item(0)->nodeValue;
                    }
                    if($booking->item(0)->getElementsByTagName('Currency')->length > 0){
                        $currency = $booking->item(0)->getElementsByTagName('Currency')->item(0)->nodeValue;
                    }
                    if($booking->item(0)->getElementsByTagName('BookedAndPaid')->length > 0){
                        $remarks = $booking->item(0)->getElementsByTagName('BookedAndPaid')->item(0)->nodeValue;
                    }
                    
                }
                
                if($res->getElementsByTagName('CancellationPolicy')->length > 0){
                    $cancel = $res->getElementsByTagName('CancellationPolicy');
                    if($cancel->item(0)->getElementsByTagName('CancellationPeriod')->length > 0){
                        $period = $cancel->item(0)->getElementsByTagName('CancellationPeriod')->item(0)->nodeValue;
                    } else $period = '';
                    if($cancel->item(0)->getElementsByTagName('CancellationPeriodRule')->length > 0){
                        $rule = $cancel->item(0)->getElementsByTagName('CancellationPeriodRule')->item(0)->nodeValue;
                    } else $rule = '';
                    if($cancel->item(0)->getElementsByTagName('CancellationFee')->length > 0){
                        $fee = $cancel->item(0)->getElementsByTagName('CancellationFee')->item(0)->nodeValue;
                    } else $fee = '';
                    if($cancel->item(0)->getElementsByTagName('CancellationPenaltyRule')->length > 0){
                        $penalty = $cancel->item(0)->getElementsByTagName('CancellationPenaltyRule')->item(0)->nodeValue;
                    } else $penalty = '';
                    if($cancel->item(0)->getElementsByTagName('NoShowFee')->length > 0){
                        $noShowFee = $cancel->item(0)->getElementsByTagName('NoShowFee')->item(0)->nodeValue;
                    } else $noShowFee = '';
                    if($cancel->item(0)->getElementsByTagName('NoShowPenaltyRule')->length > 0){
                        $noShowPenalty = $cancel->item(0)->getElementsByTagName('NoShowPenaltyRule')->item(0)->nodeValue;
                    } else $noShowPenalty = '';
                    
                    if($rule == 'NoCancellation'){
                        $cancelPolicy = 'No cancellation allowed Full penalty will be imposed when booking is canceled';
                    } else if($rule == 'BeforeCheckIn' && $penalty == 'RoomNight'){
                        $cancelPolicy = 'Booking cancellation '.$period.' day prior of check in will be free of charge, however when cancellation within the '.$period.' day prior check in, cancellation penalty of '.$fee.' '.$penalty.' will be imposed.';
                    } else if($rule == 'BeforeCheckIn' && $penalty == 'Percentage'){
                        $cancelPolicy = 'Booking cancellation '.$period.' day prior of check in will be free of charge, however when cancellation within the '.$period.' day prior check in, cancellation penalty of '.$fee.' '.$penalty.' will be imposed.';
                    } else '';
                }
            } else {
                $bookingStatus = 'Failed';
                $paymentStatus = 'Pending';
            }
                $this->db->query($sql = "update hotel_booking_master set confirmation_number='" . $bookingId . "',booking_status='" . $bookingStatus . "',payment_status='" . $paymentStatus . "',remarks='" . $remarks . "', cin='".$checkinDate."',cout='".$checkoutDate."' where id='" . $masterId . "'");
                $this->db->query($sql = "update hotel_booking_room_details set cancellation_policy='" . $cancelPolicy . "', cancellation_till_date='',cancellation_till_charge='' where master_id='" . $masterId . "'");  
            } else {
                $bookingStatus = 'Failed';
                $paymentStatus = 'Pending';
                $this->db->query($sql = "update hotel_booking_master set api_ref_id='xxxxxxx',confirmation_number='xxxxxxxxx',booking_status='" . $bookingStatus . "',payment_status='" . $paymentStatus . "' where id='" . $masterId . "'");
            }
        

        return $bookingStatus;
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

}
