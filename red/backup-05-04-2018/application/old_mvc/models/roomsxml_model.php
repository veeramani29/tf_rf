<?php

class Roomsxml_Model extends CI_Model {

    private $testUrl = 'http://api.roomsxml.com/RXLServices/ASMX/XmlService.asmx';
    private $testLogin = '<Org>redtag</Org>
            <User>XML</User>
            <Password>rtag20</Password>';
//    private $testUrl = 'http://roomsxmldemo.com/RXLStagingServices/ASMX/XmlService.asmx';
//    private $testLogin = '<Org>llea</Org>
//            <User>xmltest</User>
//            <Password>xmltest</Password>';
//    private $liveUrl = 'http://api.roomsxml.com/RXLServices/ASMX/XmlService.asmx';
//    private $liveLogin = '<Org></Org>
//            <User></User>
//            <Password></Password>';

    function hotel_availability($searchData) {
        $Roomsxml_data = '';
        $xml = '<AvailabilitySearch xmlns="http://www.reservwire.com/namespace/WebServices/Xml">
                <Authority xmlns="http://www.reservwire.com/namespace/WebServices/Xml">' . $this->testLogin . '
                  <Currency>USD</Currency>
                  <Language>en</Language>
                  <TestDebug>false</TestDebug>
                  <Version>1.26</Version>
                </Authority>
                <RegionId>' . $searchData['rmxml_code'] . '</RegionId>
                <HotelStayDetails>
                  <ArrivalDate>' . $searchData['cin'] . '</ArrivalDate>
                  <Nights>' . $searchData['nights'] . '</Nights>
                  <Nationality>PH</Nationality>';
        for ($i = 0; $i < $searchData['room_count']; $i++) {
            $xml.= '<Room>
                          <Guests>';
            for ($j = 0; $j < $searchData['adult'][$i]; $j++) {
                $xml.= '<Adult />';
            }
            if (!empty($searchData['child_age'][$i])) {
                for ($k = 0; $k < $searchData['child'][$i]; $k++) {
                    $xml.= '<Child age="' . $searchData['child_age'][$i][$k] . '" />';
                }
            }
            $xml.= '</Guests>
                                </Room>';
        }
        $xml.= '</HotelStayDetails>
                <HotelSearchCriteria>
                  <AvailabilityStatus>allocation</AvailabilityStatus>
                  <DetailLevel>basic</DetailLevel>
                </HotelSearchCriteria>
              </AvailabilitySearch>';
        //echo $xml;die;
        $CURL = curl_init();
        curl_setopt($CURL, CURLOPT_URL, $this->testUrl);
        curl_setopt($CURL, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($CURL, CURLOPT_POST, 1);
        curl_setopt($CURL, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($CURL, CURLOPT_HEADER, false);
        curl_setopt($CURL, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($CURL, CURLOPT_HTTPHEADER, array('Accept: text/xml', 'Content-Type: text/xml'));
        curl_setopt($CURL, CURLOPT_RETURNTRANSFER, true);
        $xmlResponse = curl_exec($CURL);
//        print_r($xmlResponse);die;
        $res = new DOMDocument();
        $res->loadXML($xmlResponse);
        if ($res->getElementsByTagName('HotelAvailability')->length > 0) {
            $hotels = $res->getElementsByTagName('HotelAvailability');
            $i = 0;
            foreach ($hotels as $hotel) {
                $Roomsxml_data[$i]['id'] = $i;
                $Roomsxml_data[$i]['api'] = 'roomsxml';
                $Roomsxml_data[$i]['hotel_id'] = $hotel->getElementsByTagName('Hotel')->item(0)->getAttribute('id');
                $Roomsxml_data[$i]['name'] = $hotel->getElementsByTagName('Hotel')->item(0)->getAttribute('name');
                if ($hotel->getElementsByTagName('Result')->length > 0) {
                    $rooms = $hotel->getElementsByTagName('Result');
                    $j = 0;

                    foreach ($rooms as $room) {
                        $Roomsxml_data[$i]['room'][$j]['room_id'] = $room->getAttribute('id');
                        $mulRoom = $room->getElementsByTagName('Room');
                        $Roomsxml_data[$i]['room'][$j]['price'] = 0;
                        $Roomsxml_data[$i]['room'][$j]['org_price'] = 0;
                        foreach ($mulRoom as $rm) {
                            $Roomsxml_data[$i]['room'][$j]['room_type_code'] = $rm->getElementsByTagName('RoomType')->item(0)->getAttribute('code');
                            $Roomsxml_data[$i]['room'][$j]['room_type_text'] = $rm->getElementsByTagName('RoomType')->item(0)->getAttribute('text');

                            if ($rm->getElementsByTagName('MealType')->length > 0) {
                                $Roomsxml_data[$i]['room'][$j]['meal_type_code'] = $rm->getElementsByTagName('MealType')->item(0)->getAttribute('code');
                                $Roomsxml_data[$i]['room'][$j]['meal_type_text'] = $rm->getElementsByTagName('MealType')->item(0)->getAttribute('text');
                            } else {
                                $Roomsxml_data[$i]['room'][$j]['meal_type_code'] = '';
                                $Roomsxml_data[$i]['room'][$j]['meal_type_text'] = '';
                            }

                            if ($rm->getElementsByTagName('Price')->length > 0) {
                                $Roomsxml_data[$i]['room'][$j]['org_price'] += $rm->getElementsByTagName('Price')->item(0)->getAttribute('amt');
                                $Roomsxml_data[$i]['room'][$j]['price'] += $rm->getElementsByTagName('Price')->item(0)->getAttribute('amt');
                            } else {
                                $Roomsxml_data[$i]['room'][$j]['price'] += 0;
                                $Roomsxml_data[$i]['room'][$j]['org_price'] += 0;
                            }
                        }
                        $Roomsxml_data[$i]['price'][] = $Roomsxml_data[$i]['room'][$j]['price'];
                        $j++;
                    }
                }
                $i++;
            }
            return $Roomsxml_data;
        }
    }

    function booking_prepare($hotel_data, $room_id, $searchData) {
        $Roomsxml_booking_data = '';
        $char = 'a';
        $xml = '<BookingCreate xmlns="http://www.reservwire.com/namespace/WebServices/Xml">
                    <Authority xmlns="http://www.reservwire.com/namespace/WebServices/Xml">
                     ' . $this->testLogin . '
                      <Currency>USD</Currency>
                      <Language>en</Language>
                      <TestDebug>false</TestDebug>
                      <Version>1.26</Version>
                    </Authority>
                    <QuoteId>' . $hotel_data['room'][$room_id]['room_id'] . '</QuoteId>
                    <HotelStayDetails>';
        for ($i = 0; $i < $searchData['room_count']; $i++) {
            $xml.= '<Room>
                              <Guests>';
            for ($j = 0; $j < $searchData['adult'][$i]; $j++) {
                $xml.= '<Adult title="MR" first="Test' . $char . '" last="Test"></Adult>';
                $char++;
            }
            if (!empty($searchData['child_age'])) {
                for ($k = 0; $k < $searchData['child'][$i]; $k++) {
                    $xml.= '<Child age="' . $searchData['child_age'][$i][$k] . '" title="Mr." first="Test" last="Test" />';
                    $char++;
                }
            }
            $xml.= '</Guests>
                                    </Room>';
        }
        $xml.= '</HotelStayDetails>
                    <HotelSearchCriteria>
                      <AvailabilityStatus>allocation</AvailabilityStatus>
                      <DetailLevel>basic</DetailLevel>
                    </HotelSearchCriteria>
                    <CommitLevel>prepare</CommitLevel>
                  </BookingCreate>';
        //echo $xml;die;
        $CURL = curl_init();
        curl_setopt($CURL, CURLOPT_URL, $this->testUrl);
        curl_setopt($CURL, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($CURL, CURLOPT_POST, 1);
        curl_setopt($CURL, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($CURL, CURLOPT_HEADER, false);
        curl_setopt($CURL, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($CURL, CURLOPT_HTTPHEADER, array('Accept: text/xml', 'Content-Type: text/xml'));
        curl_setopt($CURL, CURLOPT_RETURNTRANSFER, true);
        $xmlResponse = curl_exec($CURL);
        //print_r($xmlResponse);die;
        $res = new DOMDocument();
        $res->loadXML($xmlResponse);
        if ($res->getElementsByTagName('Booking')->length > 0) {
            $booking = $res->getElementsByTagName('Booking');
            $Roomsxml_booking_data['CreationDate'] = $booking->item(0)->getElementsByTagName('CreationDate')->item(0)->nodeValue;
            $Roomsxml_booking_data['Id'] = $booking->item(0)->getElementsByTagName('HotelBooking')->item(0)->getElementsByTagName('Id')->item(0)->nodeValue;
            $Roomsxml_booking_data['HotelId'] = $booking->item(0)->getElementsByTagName('HotelBooking')->item(0)->getElementsByTagName('HotelId')->item(0)->nodeValue;
            $Roomsxml_booking_data['HotelName'] = $booking->item(0)->getElementsByTagName('HotelBooking')->item(0)->getElementsByTagName('HotelName')->item(0)->nodeValue;
            $Roomsxml_booking_data['ArrivalDate'] = $booking->item(0)->getElementsByTagName('HotelBooking')->item(0)->getElementsByTagName('ArrivalDate')->item(0)->nodeValue;
            $Roomsxml_booking_data['Nights'] = $booking->item(0)->getElementsByTagName('HotelBooking')->item(0)->getElementsByTagName('Nights')->item(0)->nodeValue;

            $HotelBooking = $booking->item(0)->getElementsByTagName('HotelBooking');
            $x = 0;
            foreach ($HotelBooking as $book) {
                $Roomsxml_booking_data['rooms'][$x]['org_TotalSellingPrice'] = $book->getElementsByTagName('TotalSellingPrice')->item(0)->getAttribute('amt');
                $Roomsxml_booking_data['rooms'][$x]['TotalSellingPrice'] = $book->getElementsByTagName('TotalSellingPrice')->item(0)->getAttribute('amt');
                $Roomsxml_booking_data['rooms'][$x]['NightSellingPrice'] = $book->getElementsByTagName('Room')->item(0)->getElementsByTagName('NightCost')->item(0)->getElementsByTagName('SellingPrice')->item(0)->getAttribute('amt');

                //print_r($_SESSION['agent_Roomsxml_booking_data']);die;
                $Roomsxml_booking_data['rooms'][$x]['Status'] = $book->getElementsByTagName('Status')->item(0)->nodeValue;
                $Roomsxml_booking_data['rooms'][$x]['room_type_code'] = $book->getElementsByTagName('Room')->item(0)->getElementsByTagName('RoomType')->item(0)->getAttribute('code');
                $Roomsxml_booking_data['rooms'][$x]['room_type_text'] = $book->getElementsByTagName('Room')->item(0)->getElementsByTagName('RoomType')->item(0)->getAttribute('text');

                if ($book->getElementsByTagName('Room')->item(0)->getElementsByTagName('MealType')->length > 0) {
                    $Roomsxml_booking_data['rooms'][$x]['meal_type_code'] = $book->getElementsByTagName('Room')->item(0)->getElementsByTagName('MealType')->item(0)->getAttribute('code');
                    $Roomsxml_booking_data['rooms'][$x]['meal_type_text'] = $book->getElementsByTagName('Room')->item(0)->getElementsByTagName('MealType')->item(0)->getAttribute('text');
                } else {
                    $Roomsxml_booking_data['rooms'][$x]['meal_type_code'] = '';
                    $Roomsxml_booking_data['rooms'][$x]['meal_type_text'] = '';
                }

                $adults = $book->getElementsByTagName('Room')->item(0)->getElementsByTagName('Guests')->item(0)->getElementsByTagName('Adult');
                $a = 0;
                foreach ($adults as $adult) {
                    $Roomsxml_booking_data['rooms'][$x]['adults'][$a]['id'] = $adult->getAttribute('id');
                    $Roomsxml_booking_data['rooms'][$x]['adults'][$a]['title'] = $adult->getAttribute('title');
                    $Roomsxml_booking_data['rooms'][$x]['adults'][$a]['first'] = $adult->getAttribute('first');
                    $Roomsxml_booking_data['rooms'][$x]['adults'][$a]['last'] = $adult->getAttribute('last');
                    $a++;
                }

                if ($book->getElementsByTagName('Room')->item(0)->getElementsByTagName('Guests')->item(0)->getElementsByTagName('Child')->length > 0) {
                    $childs = $book->getElementsByTagName('Room')->item(0)->getElementsByTagName('Guests')->item(0)->getElementsByTagName('Child');
                    $a = 0;
                    foreach ($childs as $child) {
                        $Roomsxml_booking_data['rooms'][$x]['adults'][$a]['id'] = $child->getAttribute('id');
                        $Roomsxml_booking_data['rooms'][$x]['adults'][$a]['title'] = $child->getAttribute('title');
                        $Roomsxml_booking_data['rooms'][$x]['adults'][$a]['first'] = $child->getAttribute('first');
                        $Roomsxml_booking_data['rooms'][$x]['adults'][$a]['last'] = $child->getAttribute('last');
                        $a++;
                    }
                }

                $messages = $book->getElementsByTagName('Room')->item(0)->getElementsByTagName('Messages')->item(0)->getElementsByTagName('Message');
                $a = 0;
                foreach ($messages as $message) {
                    $Roomsxml_booking_data['rooms'][$x]['message'][$a]['Type'] = $message->getElementsByTagName('Type')->item(0)->nodeValue;
                    $Roomsxml_booking_data['rooms'][$x]['message'][$a]['Text'] = $message->getElementsByTagName('Text')->item(0)->nodeValue;
                    $a++;
                }


                $cancelDatas = $book->getElementsByTagName('Room')->item(0)->getElementsByTagName('CanxFees')->item(0)->getElementsByTagName('Fee');
                $a = 0;
                foreach ($cancelDatas as $cancelData) {
                    $Roomsxml_booking_data['rooms'][$x]['cancelData'][$a]['from'] = $cancelData->getAttribute('from');
                    $Roomsxml_booking_data['rooms'][$x]['cancelData'][$a]['Amount'] = $cancelData->getElementsByTagName('Amount')->item(0)->getAttribute('amt') ;
                    $a++;
                }
                $x++;
            }
        }
        
        return $Roomsxml_booking_data;
    }

    function booking($masterId, $postData, $details, $room_id,$searchData,$cur_val,$admin_markup,$agent_markup) {
        die;
        $status = '';
        $paymentStatus = 'Pending';
        $xml = '<BookingCreate xmlns="http://www.reservwire.com/namespace/WebServices/Xml">
                    <Authority xmlns="http://www.reservwire.com/namespace/WebServices/Xml">
                      ' . $this->testLogin . '
                      <Currency>USD</Currency>
                      <Language>en</Language>
                      <TestDebug>false</TestDebug>
                      <Version>1.26</Version>
                    </Authority>
                    <QuoteId>' . $details['room'][$room_id]['room_id'] . '</QuoteId>
                    <HotelStayDetails>';
        for ($i = 0; $i < $searchData['room_count']; $i++) {
            $xml.= '<Room>
                              <Guests>';
            for ($j = 0; $j < $searchData['adult'][$i]; $j++) {
                $xml.= '<Adult title="' . $postData['adulttitle'][$i][$j] . '" first="' . $postData['adultFname'][$i][$j] . '" last="' . $postData['adultLname'][$i][$j] . '"></Adult>';
            }
            if ($searchData['child_age'] != '') {
                for ($k = 0; $k < $searchData['child'][$i]; $k++) {
                    $xml.= '<Child age="' . $searchData['child_age'][$i][$k] . '" title="' . $postData['childtitle'][$i][$k] . '" first="' . $postData['childFname'][$i][$k] . '" last="' . $postData['childLname'][$i][$k] . '" />';
                }
            }
            $xml.= '</Guests>
                                    </Room>';
        }
        $xml.= '</HotelStayDetails>
                    <HotelSearchCriteria>
                      <AvailabilityStatus>allocation</AvailabilityStatus>
                      <DetailLevel>basic</DetailLevel>
                    </HotelSearchCriteria>
                    <CommitLevel>confirm</CommitLevel>
                  </BookingCreate>';

//        echo $xml;die;
        $CURL = curl_init();
        curl_setopt($CURL, CURLOPT_URL, $this->testUrl);
        curl_setopt($CURL, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($CURL, CURLOPT_POST, 1);
        curl_setopt($CURL, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($CURL, CURLOPT_HEADER, false);
        curl_setopt($CURL, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($CURL, CURLOPT_HTTPHEADER, array('Accept: text/xml', 'Content-Type: text/xml'));
        curl_setopt($CURL, CURLOPT_RETURNTRANSFER, true);
        $xmlResponse = curl_exec($CURL);
        //print_r($xmlResponse);//die;
        if($xmlResponse != ''){
            $res = new DOMDocument();
            $res->loadXML($xmlResponse);

            $Roomsxml_booking_data = '';
            if ($res->getElementsByTagName('Booking')->length > 0) {
                $booking = $res->getElementsByTagName('Booking');
                $Roomsxml_booking_data['CreationDate'] = $booking->item(0)->getElementsByTagName('CreationDate')->item(0)->nodeValue;
                $Roomsxml_booking_data['Id'] = $booking->item(0)->getElementsByTagName('Id')->item(0)->nodeValue;
                $Roomsxml_booking_data['HotelId'] = $booking->item(0)->getElementsByTagName('HotelBooking')->item(0)->getElementsByTagName('HotelId')->item(0)->nodeValue;
                $Roomsxml_booking_data['HotelName'] = $booking->item(0)->getElementsByTagName('HotelBooking')->item(0)->getElementsByTagName('HotelName')->item(0)->nodeValue;
                $Roomsxml_booking_data['ArrivalDate'] = $booking->item(0)->getElementsByTagName('HotelBooking')->item(0)->getElementsByTagName('ArrivalDate')->item(0)->nodeValue;
                $Roomsxml_booking_data['Nights'] = $booking->item(0)->getElementsByTagName('HotelBooking')->item(0)->getElementsByTagName('Nights')->item(0)->nodeValue;
                $Roomsxml_booking_data['TotalSellingPrice'] = ($booking->item(0)->getElementsByTagName('HotelBooking')->item(0)->getElementsByTagName('TotalSellingPrice')->item(0)->getAttribute('amt') * $_SESSION['agent_currency_value']);
                $Roomsxml_booking_data['NightSellingPrice'] = ($booking->item(0)->getElementsByTagName('HotelBooking')->item(0)->getElementsByTagName('Room')->item(0)->getElementsByTagName('NightCost')->item(0)->getElementsByTagName('SellingPrice')->item(0)->getAttribute('amt') * $_SESSION['agent_currency_value']);
                $Roomsxml_booking_data['Status'] = $booking->item(0)->getElementsByTagName('HotelBooking')->item(0)->getElementsByTagName('Status')->item(0)->nodeValue;

                $HotelBooking = $booking->item(0)->getElementsByTagName('HotelBooking');
                $x = 0;
                foreach ($HotelBooking as $book) {
                    //print_r($_SESSION['agent_Roomsxml_booking_data']);die;

                    $Roomsxml_booking_data['details'][$x]['room_type_code'] = $book->getElementsByTagName('Room')->item(0)->getElementsByTagName('RoomType')->item(0)->getAttribute('code');
                    $Roomsxml_booking_data['details'][$x]['room_type_text'] = $book->getElementsByTagName('Room')->item(0)->getElementsByTagName('RoomType')->item(0)->getAttribute('text');

                    if ($book->getElementsByTagName('Room')->item(0)->getElementsByTagName('MealType')->length > 0) {
                        $Roomsxml_booking_data['details'][$x]['meal_type_code'] = $book->getElementsByTagName('Room')->item(0)->getElementsByTagName('MealType')->item(0)->getAttribute('code');
                        $Roomsxml_booking_data['details'][$x]['meal_type_text'] = $book->getElementsByTagName('Room')->item(0)->getElementsByTagName('MealType')->item(0)->getAttribute('text');
                    } else {
                        $Roomsxml_booking_data['details'][$x]['meal_type_code'] = '';
                        $Roomsxml_booking_data['details'][$x]['meal_type_text'] = '';
                    }

                    $adults = $book->getElementsByTagName('Room')->item(0)->getElementsByTagName('Guests')->item(0)->getElementsByTagName('Adult');
                    $a = 0;
                    foreach ($adults as $adult) {
                        $Roomsxml_booking_data['details'][$x]['adults'][$a]['id'] = $adult->getAttribute('id');
                        $Roomsxml_booking_data['details'][$x]['adults'][$a]['title'] = $adult->getAttribute('title');
                        $Roomsxml_booking_data['details'][$x]['adults'][$a]['first'] = $adult->getAttribute('first');
                        $Roomsxml_booking_data['details'][$x]['adults'][$a]['last'] = $adult->getAttribute('last');
                        $a++;
                    }

                    if ($book->getElementsByTagName('Room')->item(0)->getElementsByTagName('Guests')->item(0)->getElementsByTagName('Child')->length > 0) {
                        $childs = $book->getElementsByTagName('Room')->item(0)->getElementsByTagName('Guests')->item(0)->getElementsByTagName('Child');
                        $a = 0;
                        foreach ($childs as $child) {
                            $Roomsxml_booking_data['details'][$x]['adults'][$a]['id'] = $child->getAttribute('id');
                            $Roomsxml_booking_data['details'][$x]['adults'][$a]['title'] = $child->getAttribute('title');
                            $Roomsxml_booking_data['details'][$x]['adults'][$a]['first'] = $child->getAttribute('first');
                            $Roomsxml_booking_data['details'][$x]['adults'][$a]['last'] = $child->getAttribute('last');
                            $a++;
                        }
                    }

                    $messages = $book->getElementsByTagName('Room')->item(0)->getElementsByTagName('Messages')->item(0)->getElementsByTagName('Message');
                    $a = 0;
                    foreach ($messages as $message) {
                        $Roomsxml_booking_data['details'][$x]['message'][$a]['Type'] = $message->getElementsByTagName('Type')->item(0)->nodeValue;
                        $Roomsxml_booking_data['details'][$x]['message'][$a]['Text'] = $message->getElementsByTagName('Text')->item(0)->nodeValue;
                        $a++;
                    }


                    $cancelDatas = $book->getElementsByTagName('Room')->item(0)->getElementsByTagName('CanxFees')->item(0)->getElementsByTagName('Fee');
                    $a = 0;
                    foreach ($cancelDatas as $cancelData) {
                        $Roomsxml_booking_data['details'][$x]['cancelData']['from'][$a] = $cancelData->getAttribute('from');
                        $Roomsxml_booking_data['details'][$x]['cancelData']['Amount'][$a] = $cancelData->getElementsByTagName('Amount')->item(0)->getAttribute('amt');
                        $a++;
                    }

                    $x++;
                }

                $Roomsxml_booking_data['PayableBy'] = $booking->item(0)->getElementsByTagName('HotelBooking')->item(0)->getElementsByTagName('VoucherInfo')->item(0)->getElementsByTagName('PayableBy')->item(0)->nodeValue;
                $Roomsxml_booking_data['VoucherRef'] = $booking->item(0)->getElementsByTagName('HotelBooking')->item(0)->getElementsByTagName('VoucherInfo')->item(0)->getElementsByTagName('VoucherRef')->item(0)->nodeValue;


                $status = $Roomsxml_booking_data['Status'];
                if (isset($Roomsxml_booking_data['Status']) && $Roomsxml_booking_data['Status'] == 'confirmed') {
                    $paymentStatus = 'Success';
                } else {
                    $paymentStatus = 'Pending';
                }
            } else {
                $status = 'Failed';
                $paymentStatus = 'Pending';
            }
            //echo '<pre />';print_r($Roomsxml_booking_data);die;
            $message = "";
            $cancel_policy = "";
            $cancelFrom = "";
            $cancelAmount = "";
            $h = 1;
            if ($Roomsxml_booking_data != '') {
                foreach ($Roomsxml_booking_data['details'] as $detail) {
                    $message .=$detail['message'][0]['Text'] . '<br />';
                    $cancel_policy .="FOR ROOM " . $h . " ";
                    for ($c = 0; $c < count($detail['cancelData']['from']); $c++) {
                        $totalP = $detail['cancelData']['Amount'][$c];
                        if($cur_val != 0){ $totalP = $totalP*number_format((float)$cur_val, 2, '.', ''); }
                        if($admin_markup['type'] == 'fixed'){
                            $mTyp = $searchData['type'];
                            $totalP = $totalP+$admin_markup[$mTyp];
                        } else {
                            $mTyp = $searchData['type'];
                            $totalP = ((($admin_markup[$mTyp]/100)*$totalP)+$totalP);
                        }

                        if($agent_markup['type'] == 'fixed'){
                            $amTyp = $searchData['type'];
                            $totalP = $totalP+$agent_markup[$amTyp];
                        } else {
                            $amTyp = $searchData['type'];
                            $totalP = ((($agent_markup[$amTyp]/100)*$totalP)+$totalP);
                        }
                        $cancel_policy .= "Cancellation penalty for cancellation made on or after " . ($detail['cancelData']['from'][$c]) . " and the check in date " . $_SESSION['agent_cin'] . " then " . $totalP . " , Charges Will Apply";
                        $cancelFrom .= $detail['cancelData']['from'][$c] . '<br />';
                        $cancelAmount .= $totalP . '<br />';
                    }

                    $cancel_policy .='<br />';


                    $h++;
                }

                $this->db->query($sql = "update hotel_booking_master set api_ref_id='" . $Roomsxml_booking_data['Id'] . "',confirmation_number='" . $Roomsxml_booking_data['VoucherRef'] . "',booking_status='" . $status . "',payment_status='" . $paymentStatus . "',remarks='" . $message . "' where id='" . $masterId . "'");
                $this->db->query($sql = "update hotel_booking_room_details set cancellation_policy='" . $cancel_policy . "', cancellation_till_date='" . $cancelFrom . "',cancellation_till_charge='" . $cancelAmount . "' where master_id='" . $masterId . "'");
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

}
