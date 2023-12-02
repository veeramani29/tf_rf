<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Activity_Model extends CI_Model {

    function getCityCountryCode($cityName,$countryName)
    {
        $sql = "select city_code,country_code from tacenter_tour_city_list where city_name='".mysql_real_escape_string($cityName)."' and country_name='".mysql_real_escape_string($countryName)."'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0)
        {
            return $query->row();
        }
        else return '';
    }
    
    function getAllActivityOnSearch($searchData){
        $query = $this->db->query($sql = "select id,ActivityName,ImagePath,MinPax,MaxPax,AdvancePurchasePeriod,TravelValidFrom,TravelValidTo,PriceAdult,OnlyForAdult from tacenter_activity_list where City='".$searchData['city_code']."' and Country='".$searchData['country_code']."' order by PriceAdult asc");
        if($query->num_rows() > 0){
            $data = $query->result();
        } else {
            $data = '';
        }
        
        return $data;
    }
    
    function getInclusionAndCancel($id){
        $query = $this->db->query($sql = "select ActivityInclusive,CancellationPolicy from tacenter_activity_list where id='".$id."'");
        if($query->num_rows() > 0){
            $data = $query->row();
        } else {
            $data = '';
        }
        
        return $data;
    }
    
    function getActivityDetailsOnId($id){
        $query = $this->db->query($sql = "select * from tacenter_activity_list where id='".$id."'");
        if($query->num_rows() > 0){
            $data = $query->row();
        } else {
            $data = '';
        }
        
        return $data;
    }
    
    function getActivityDetailsOnActId($id){
        $query = $this->db->query($sql = "select * from tacenter_activity_list where ActivityID='".$id."'");
        if($query->num_rows() > 0){
            $data = $query->row();
        } else {
            $data = '';
        }
        
        return $data;
    }
    
    function getTourDetailsOnActivityId($activityId){
        $query = $this->db->query($sql = "select * from tacenter_activity_tour_list where ActivityID='".$activityId."'");
        if($query->num_rows() > 0){
            $data = $query->result();
        } else {
            $data = '';
        }
        
        return $data;
    }
    
    function getTourImagesOnId($id){
        $query = $this->db->query($sql = "select * from tacenter_tour_images where TourId='".$id."'");
        if($query->num_rows() > 0){
            $data = $query->result();
        } else {
            $data = '';
        }
        
        return $data;
    }
    
    function getTourDescOnId($id){
        $query = $this->db->query($sql = "select TourDescription from tacenter_activity_tour_desc where TourId='".$id."'");
        if($query->num_rows() > 0){
            $data = $query->row();
        } else {
            $data = '';
        }
        
        return $data;
    }
    
    function getTourTermsOnId($id){
        $query = $this->db->query($sql = "select ImportantNotes from tacenter_activity_tour_desc where TourId='".$id."'");
        if($query->num_rows() > 0){
            $data = $query->row();
        } else {
            $data = '';
        }
        
        return $data;
    }
    
    function getTourIdOnActivityId($id){
        $query = $this->db->query($sql = "select * from tacenter_activity_tour_list where ActivityID='".$id."'");
        if($query->num_rows() > 0){
            $data = $query->result();
        } else {
            $data = '';
        }
        
        return $data;
    }
    
    function getTourTypeOnId($tid){
        $query = $this->db->query($sql = "select TourType from tacenter_activity_tour_desc where TourId='".$tid."'");
        if($query->num_rows() > 0){
            $data = $query->row();
        } else {
            $data = '';
        }
        
        return $data;
    }
    
    function getTourOptionOnId($tid){
        $query = $this->db->query($sql = "select OptionCode from tacenter_tour_options where TourId='".$tid."'");
        if($query->num_rows() > 0){
            $data = $query->row();
        } else {
            $data = '';
        }
        
        return $data;
        
    }
    
    ################## ACTIVITY API CALLS STARTS HERE #############################
    
    function getActivityPrice($id,$data,$date,$adult,$child,$childAge){
        $childTag = '';
        $tours = '';
        if($child != '' && $child > 0){
            $childTag .= '<Child>';
            for($i = 0;$i < $child; $i++){
                $childTag .= '<Age>'.$childAge[$i].'</Age>';
            }
            $childTag .= '</Child>';
        }
        
        
        
        foreach($data['tourIds'] as $tour){
            $tid = $tour->TourId;
            $tourType = $this->Activity_Model->getTourTypeOnId($tid);
            $optionCode = $this->Activity_Model->getTourOptionOnId($tid);
            
            if($tourType != ''){
                $type = $tourType->TourType;
            } else {
                $type = '';
            }
            
            if($optionCode != ''){
                $option = $optionCode->OptionCode;
            } else {
                $option = '';
            }
            
            $tours .= '<Tours>
                            <TourID>'.$tid.'</TourID>
                            <TravelDate>'.$date.'</TravelDate>
                            <TourType>'.$type.'</TourType>
                            <OptionCode>'.$option.'</OptionCode>
                        </Tours>';
        }
        
        $xml = '<?xml version="1.0" encoding="utf-8"?>
                <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                  <soap:Header>
                    <SOAPHeaderAuth xmlns="http://tempuri.org/">
                        <AgentCode>rtttest</AgentCode>
                        <PartnerID>string</PartnerID>
                        <Culture>en-US</Culture>
                        <Password>rtt888</Password>
                    </SOAPHeaderAuth>
                  </soap:Header>
                  <soap:Body>
                    <SearchActivityPrice xmlns="http://tempuri.org/">
                      <RequestParam>
                        <ActivityID>'.$id.'</ActivityID>
                        <Adult>'.$adult.'</Adult>
                        '.$childTag.'
                        <Currency>'.$data['details']->Currency.'</Currency>
                        <TourDetails>
                          '.$tours.'
                        </TourDetails>
                      </RequestParam>
                    </SearchActivityPrice>
                  </soap:Body>
                </soap:Envelope>';
        $url="http://tempuri.org/SearchActivityPrice";
        $httpHeader = array("SOAPAction: {$url}", "Content-Type: text/xml; charset=utf-8");
        $url = 'http://ws.asiatravel.net/PartnerPackageWSv2.5/ActivityWS.asmx';
        
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // username and password - declared at the top of the doc
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml); // the SOAP request
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
        $response = curl_exec($ch);
        curl_close($ch); 
        //print_r($response);die;
        
        $price = '';
        $error = '';
        $curency = '';
        if($response != ''){
            $res = new DOMDocument();
            $res->loadXML($response);
            
            if($res->getElementsByTagName('Errors')->length > 0){
                $error = $res->getElementsByTagName('Errors')->item(0)->getElementsByTagName('ErrorMessage')->item(0)->nodeValue;
            } else {
                if($res->getElementsByTagName('TotalAmount')->length > 0){
                    $price = $res->getElementsByTagName('TotalAmount')->item(0)->nodeValue;
                    $curency = $res->getElementsByTagName('Currency')->item(0)->nodeValue;
                } else {
                    $error = 'Price could not be updated. Please try again';
                }
            }
        } else {
            $error = 'Price could not be updated. Please try again';
        }
        
        return array('error'=>$error,'price'=>$price,'currency'=>$curency);
    }
    
    function getPickUpDropOffPoints($id){
        $xml = '<?xml version="1.0" encoding="utf-8"?>
                    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                      <soap:Header>
                        <SOAPHeaderAuth xmlns="http://tempuri.org/">
                            <AgentCode>rtttest</AgentCode>
                            <PartnerID>string</PartnerID>
                            <Culture>en-US</Culture>
                            <Password>rtt888</Password>
                        </SOAPHeaderAuth>
                      </soap:Header>
                      <soap:Body>
                        <GetPickupPointList xmlns="http://tempuri.org/">
                          <ActivityID>'.$id.'</ActivityID>
                        </GetPickupPointList>
                      </soap:Body>
                    </soap:Envelope>';
        
        $url="http://tempuri.org/GetPickupPointList";
        $httpHeader = array("SOAPAction: {$url}", "Content-Type: text/xml; charset=utf-8");
        $url = 'http://ws.asiatravel.net/PartnerPackageWSv2.5/ActivityWS.asmx';
        
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // username and password - declared at the top of the doc
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml); // the SOAP request
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
        $response = curl_exec($ch);
        curl_close($ch); 
        //$_SESSION['res'] = $response;
        $hotelCode = '';
        $HotelName = '';
        $error = '';
        if($response != ''){
            $res = new DOMDocument();
            $res->loadXML($response);
            if($res->getElementsByTagName('Errors')->length > 0){
                $error = $res->getElementsByTagName('Errors')->item(0)->getElementsByTagName('ErrorMessage')->item(0)->nodeValue;
            } else {
                if($res->getElementsByTagName('PickUpPointList')->length > 0){
                    $points = $res->getElementsByTagName('PickUpPointList')->item(0)->getElementsByTagName('PickUpPoint');
                    foreach($points as $point){
                        $hotelCode[] = $point->getElementsByTagName('HotelCode')->item(0)->nodeValue;
                        $HotelName[] = $point->getElementsByTagName('HotelName')->item(0)->nodeValue;
                    }
                } else {
                    $error = 'Price could not be updated. Please try again';
                }
            }
        }
        
        return array('error'=>$error,'hotelCode'=>$hotelCode,'HotelName'=>$HotelName);
    }
    
    function getFinalBooking($data){
            $childTag = '';
            $tours = '';
            
            if($data['child'] != '' && $data['child'] > 0){
            $childTag .= '<Child>';
            for($i = 0;$i < $child; $i++){
                $childTag .= '<Age>'.$childAge[$i].'</Age>';
            }
            $childTag .= '</Child>';
        }
            
            foreach($data['tourIds'] as $tour){
                $tid = $tour->TourId;
                $tourType = $this->Activity_Model->getTourTypeOnId($tid);
                $optionCode = $this->Activity_Model->getTourOptionOnId($tid);

                if($tourType != ''){
                    $type = $tourType->TourType;
                } else {
                    $type = '';
                }

                if($optionCode != ''){
                    $option = $optionCode->OptionCode;
                } else {
                    $option = '';
                }

                $tours .= '<Tours>
                                <TourID>'.$tid.'</TourID>
                                <TravelDate>'.$data['date'].'</TravelDate>
                                <TourType>'.$type.'</TourType>
                                <OptionCode>'.$option.'</OptionCode>
                            </Tours>';
            }
            
            $pickPoint = '';
            
            if($data['post_data']['pick_point'] != ''){
                $pickPoint .= '<PickUpDropOffHotel>
                                <PickupPointID>'.$data['post_data']['pick_point'].'</PickupPointID>
                                <PickupDropOffPoint>'.$data['post_data']['pick_point'].'</PickupDropOffPoint>
                              </PickUpDropOffHotel>';
            }
            
            $guests = '';
            
            if($data['adult'] > 1){
                for($i = 1; $i < $data['adult'];$i++){
                    $guests .= '<Guest>
                                    <Title>'.$data['post_data']['adulttitle'][$i].'</Title>
                                    <FirstName>'.$data['post_data']['adultFname'][$i].'</FirstName>
                                    <LastName>'.$data['post_data']['adultLname'][$i].'</LastName>
                                    <PassengerType>32</PassengerType>
                                  </Guest>';
                }
            }
            
            if($data['child'] != '' && $data['child'] > 0){
                for($k = 0;$k < $data['child']; $k++){
                    $guests .= '<Guest>
                                <Title>'.$data['post_data']['childtitle'][$k].'</Title>
                                <FirstName>'.$data['post_data']['childFname'][$k].'</FirstName>
                                <LastName>'.$data['post_data']['childLname'][$k].'</LastName>
                                <PassengerType>33</PassengerType>
                                <Age>'.$data['post_data']['act_child_age'][$k].'</Age>
                                <DOB>'.$data['post_data']['child_dob'][$k].'</DOB>
                              </Guest>';
                }
            }
            //echo '<pre />';print_r($data['post_data']);die;
            $uid = date('ymdHis').$_SESSION['agent']['user_id'];
            $xml = '<?xml version="1.0" encoding="utf-8"?>
                    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                      <soap:Header>
                        <SOAPHeaderAuth xmlns="http://tempuri.org/">
                           <AgentCode>rtttest</AgentCode>
                            <PartnerID>string</PartnerID>
                            <Culture>en-US</Culture>
                            <Password>rtt888</Password>
                        </SOAPHeaderAuth>
                      </soap:Header>
                      <soap:Body>
                        <BookActivity xmlns="http://tempuri.org/">
                          <RequestParam>
                            <USID>'.$uid.'</USID>
                            <ActivityID>'.$data['id'].'</ActivityID>
                            <Adult>'.$data['adult'].'</Adult>
                            '.$childTag.'
                            <TourDetails>
                              '.$tours.'
                            </TourDetails>
                            <Currency>'.$data['price_data']['currency'].'</Currency>
                            <TotalPrice>'.$data['price_data']['price'].'</TotalPrice>
                            '.$pickPoint.'
                            <LeadTravelerInfo>
                              <Title>'.$data['post_data']['adulttitle'][0].'</Title>
                              <FirstName>'.$data['post_data']['adultFname'][0].'</FirstName>
                              <LastName>'.$data['post_data']['adultLname'][0].'</LastName>
                              <PassengerType>32</PassengerType>
                              <NationalityID>161</NationalityID>
                            </LeadTravelerInfo>
                            <GuestDetails>
                              '.$guests.'
                            </GuestDetails>
                            
                            <ContactInfo>
                              <Salutation>'.$data['post_data']['adulttitle'][0].'</Salutation>
                              <FirstName>'.$data['post_data']['adultFname'][0].'</FirstName>
                              <LastName>'.$data['post_data']['adultLname'][0].'</LastName>
                              <Email>'.$data['post_data']['user_email'].'</Email>
                              <ContactNumber>'.$data['post_data']['user_mobile'].'</ContactNumber>
                            </ContactInfo>
                            
                            <AgentReferenceNumber>rtttest</AgentReferenceNumber>
                          </RequestParam>
                        </BookActivity>
                      </soap:Body>
                    </soap:Envelope>';
            
            $url="http://tempuri.org/BookActivity";
            $httpHeader = array("SOAPAction: {$url}", "Content-Type: text/xml; charset=utf-8");
            $url = 'http://ws.asiatravel.net/PartnerPackageWSv2.5/ActivityWS.asmx';
//echo $xml;die;
            $_SESSION['res'] = $xml;
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // username and password - declared at the top of the doc
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_TIMEOUT, 300);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml); // the SOAP request
            curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
            $response = curl_exec($ch);
            curl_close($ch); 
            $_SESSION['res'] = $response;
            print_r($response);die;
            
        }
    
    
    
    
}