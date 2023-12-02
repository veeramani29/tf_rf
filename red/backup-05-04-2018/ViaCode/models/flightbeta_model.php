<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Flightbeta_Model extends CI_Model {

    function getFlightsCityData($term)
    {
        $sql = "select * from airport_list where airport_country='India' and (airport_name like '%$term%' or airport_code like '%$term%')";
        $query=$this->db->query($sql);
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else return '';
    }
    
    function addFlightBookingDetails($postData,$onwardDetails,$requestData,$priceFinalData,$agentInfo,$adminMarkup,$agentMarkup)
    {
        $DepartureDateTime = '';$ArrivalDateTime = '';$FlightNumber = '';$Departure_LocationCode = '';
        $Departure_TerminalID = '';$Arrival_LocationCode = '';$Arrival_TerminalID = '';
        $OperatingAirline_Code = '';$OperatingAirline_FlightNumber = '';$airlineName = '';
        $class = '';$refundable = '';$ticketType = '';$baggageInfo = '';$mealInfo = '';
        $flyingTime = '';$journeyTime = '';$fareBasis = '';$adult_pass_no = '';$child_pass_no = '';
        $infant_pass_no = '';

        foreach($onwardDetails['flights'] as $legs){
          $amenities=isset($legs['amenities']['baggage']['checkin']['adt']['desc'])?$legs['amenities']['baggage']['checkin']['adt']['desc']:'N/A';
            $DepartureDateTime .= $legs['depDetail']['time'].'<br>';
            $ArrivalDateTime .= $legs['arrDetail']['time'].'<br>';
            $FlightNumber .= $legs['flightNo'].'<br>';
            $Departure_LocationCode .= $legs['depDetail']['code'].'<br>';
            $Arrival_LocationCode .= $legs['arrDetail']['code'].'<br>';
            $OperatingAirline_Code .= $legs['aircraftType'].'<br>';
            $Departure_TerminalID .= $legs['depDetail']['terminal'].'<br>';
            $Arrival_TerminalID .= $legs['arrDetail']['terminal'].'<br>';
            $OperatingAirline_FlightNumber .= $legs['flightNo'].'<br>';
            $airlineName .= $legs['carrier']['name'].'<br>';
            $class .= $legs['classDetail']['adt']['class'].'<br>';
            $refundable .= $legs['refundable'].'<br>';
           # $ticketType .= $legs['TicketType'].'<br>';
            $baggageInfo .= $amenities.'<br>';
            $mealInfo .= $legs['amenities']['meal'].'<br>';
            $flyingTime .= $legs['flyTime'].'<br>';
            $journeyTime .= $onwardDetails['journeyInfo'][0]['journeyTime'].'<br>';
            $fareBasis .= $legs['classDetail']['adt']['basis'].'<br>';
        }
        $totalBaseFare = ($priceFinalData['fare']['totalFare']['base']['amount']);
        $totalamount = ($priceFinalData['fare']['totalFare']['total']['amount']);
        $query = $this->db->query($sql="insert into flight_booking_beta set user_type='".$agentInfo['user_type']."', user_id='".$agentInfo['user_id']."', journeyType = '".trim($requestData['journey_type'])."', 
                                                              stops = '".(count($onwardDetails['flights'])-1)."',
                                                              DepartureDateTime = '".$DepartureDateTime."',
                                                              ArrivalDateTime = '".$ArrivalDateTime."',
                                                              FlightNumber = '".$FlightNumber."',
                                                              Departure_LocationCode = '".$Departure_LocationCode."',
                                                              Departure_TerminalID = '".$Departure_TerminalID."',
                                                              Arrival_LocationCode = '".$Arrival_LocationCode."',
                                                              Arrival_TerminalID = '".$Arrival_TerminalID."',
                                                              OperatingAirline_Code = '".$OperatingAirline_Code."',
                                                              OperatingAirline_FlightNumber = '".$OperatingAirline_FlightNumber."',
                                                              airline_name = '".$airlineName."',
                                                              class = '".$class."',
                                                              not_refundable = '".$refundable."',
                                                             
                                                              baggageInfo = '".$baggageInfo."',
                                                              mealInfo = '".$mealInfo."',
                                                              flyingTime = '".$flyingTime."',
                                                              journeyTime = '".$journeyTime."',
                                                              fareBasis = '".$fareBasis."',
                                                              admin_markup = '".$adminMarkup."',
                                                              agent_markup = '".$agentMarkup."',
                                                              TotalFare = '".trim($totalamount)."',
                                                              TotalFare_org = '".trim($priceFinalData['TotalAmount_org'])."',
                                                              BaseFare_org = '".$totalBaseFare."',
                                                              TotalFare_curr = '".trim($priceFinalData['webDta']['envDta']['currencyCode'])."',
                                                              from_code = '".trim($requestData['fromCode'])."',
                                                              to_code = '".trim($requestData['toCode'])."',
                                                              from_city = '".trim($requestData['fromCity'])."',
                                                              to_city = '".trim($requestData['toCity'])."',
                                                              departDate = '".trim($requestData['sd'])."',
                                                              rturnDate = '".(isset($requestData['sd']) ? trim($requestData['sd']) : '')."',
                                                              adultPax = '".trim($requestData['adult'])."',
                                                              childPax = '".trim($requestData['child'])."',
                                                              infantPax = '".trim($requestData['infant'])."',
                                                              user_email = '".mysql_real_escape_string(trim($postData['user_email']))."',
                                                              user_mobile = '".trim($postData['mobile_code']).'-'.trim($postData['phone_number'])."',
                                                              booked_date= '".date('Y-m-d')."'");

        $id = $this->db->insert_id();
        
        $query = $this->db->query($sql = "insert into flight_booking_contact_details_beta set master_id='".$id."',user_id='".$agentInfo['user_id']."',
                                                                                         user_type='".$agentInfo['user_type']."',
                                                                                         user_email='".mysql_real_escape_string(trim($postData['user_email']))."',
                                                                                         user_mobile='".trim($postData['mobile_code']).'-'.trim($postData['phone_number'])."'");
        
        if(isset($postData['adult_passport_no']))
            $adult_pass_no = $postData['adult_passport_no'];
        if(isset($postData['child_passport_no']))
            $child_pass_no = $postData['child_passport_no'];
        if(isset($postData['infant_passport_no']))
            $infant_pass_no = $postData['infant_passport_no'];
        
        $baggageTotal = 0;
        for($i=0;$i<$requestData['adult'];$i++){
            
            $this->db->query($sql="insert into flight_booking_pax_details_beta set master_id='".$id."', 
                                                                          type='adult',
                                                                          title='".$postData['adulttitle'][$i]."',
                                                                          first_name='".mysql_real_escape_string(trim($postData['adultFname'][$i]))."',
                                                                          last_name='".mysql_real_escape_string(trim($postData['adultLname'][$i]))."',
                                                                          dob='".$postData['adult_dob'][$i]."',
                                                                          pass_no='".(is_array($adult_pass_no)?$adult_pass_no[$i]:'')."',
                                                                          extra_baggage_onward='".$postData['adultBaggageOnward'][$i]."'
                                                                        ");
            if($postData['adultBaggageOnward'][$i] != ''){
                $ex = explode(';',$postData['adultBaggageOnward'][$i]);
                $baggageTotal = ($baggageTotal+$ex[1]);
            }
        }
        
        if($requestData['child'] > 0)
        {
            for($i=0;$i<$requestData['child'];$i++)
            {
                $this->db->query($sql="insert into flight_booking_pax_details_beta set master_id='".$id."', 
                                                                                    type='child',
                                                                                    title='".$postData['childtitle'][$i]."',
                                                                                    first_name='".mysql_real_escape_string(trim($postData['childFname'][$i]))."',
                                                                                    last_name='".mysql_real_escape_string(trim($postData['childLname'][$i]))."',
                                                                                    dob='".$postData['child_dob'][$i]."',
                                                                                    pass_no='".(is_array($child_pass_no)?$child_pass_no[$i]:'')."',
                                                                                    extra_baggage_onward='".$postData['childBaggageOnward'][$i]."'
                                                                                ");
                if($postData['adultBaggageOnward'][$i] != ''){
                    $ex = explode(';',$postData['childBaggageOnward'][$i]);
                    $baggageTotal = ($baggageTotal+$ex[1]);
                }
            }
        }
        
        if($requestData['infant'] > 0)
        {
            for($i=0;$i<$requestData['infant'];$i++)
            {
                $this->db->query($sql="insert into flight_booking_pax_details_beta set master_id='".$id."', 
                                                                                    type='child',
                                                                                    title='".$postData['infanttitle'][$i]."',
                                                                                    first_name='".mysql_real_escape_string(trim($postData['infantFname'][$i]))."',
                                                                                    last_name='".mysql_real_escape_string(trim($postData['infantLname'][$i]))."',
                                                                                    dob='".$postData['infant_dob'][$i]."',
                                                                                    pass_no='".(is_array($infant_pass_no) ? $infant_pass_no[$i] : '')."',
                                                                                    extra_baggage_onward='".$postData['infantBaggageOnward'][$i]."'
                                                                                ");
                if($postData['adultBaggageOnward'][$i] != ''){
                    $ex = explode(';',$postData['infantBaggageOnward'][$i]);
                    $baggageTotal = ($baggageTotal+$ex[1]);
                }
            }
        }
        
        $tot = ($priceFinalData['fare']['totalFare']['total']['amount']+$baggageTotal);
        $totOrg = ($priceFinalData['fare']['totalFare']['total']['amount']+$baggageTotal);
        $this->db->query($sql = "update flight_booking_beta set TotalFare='".$tot."',TotalFare_org='".$totOrg."' where id='".$id."'");
        
        return $id;
    }
    
    function addFlightBookingDetailsRound($Details,$onwardDetails,$returnDetails,$postData,$requestData,$priceFinalData,$agentData,$adminMarkup,$agentMarkup)
    {
        $DepartureDateTime = '';$ArrivalDateTime = '';$FlightNumber = '';
        $Departure_LocationCode = '';$Departure_TerminalID = '';$Arrival_LocationCode = '';
        $Arrival_TerminalID = '';$OperatingAirline_Code = '';$OperatingAirline_FlightNumber = '';
        $airlineName = '';$class = '';$refundable = '';$ticketType = '';$baggageInfo = '';
        $mealInfo = '';$flyingTime = '';$journeyTime = '';$fareBasis = '';
        $adult_pass_no = '';$child_pass_no = '';$infant_pass_no = '';
        if(!empty($returnDetails)){
          $onwardDetails=$onwardDetails['flights'];
        }else{
           $onwardDetails=$onwardDetails;
        }
        foreach($onwardDetails as $legs)
        {

           $amenities=isset($legs['amenities']['baggage']['checkin']['adt']['desc'])?$legs['amenities']['baggage']['checkin']['adt']['desc']:'N/A';
            $DepartureDateTime .= $legs['depDetail']['time'].'<br>';
            $ArrivalDateTime .= $legs['arrDetail']['time'].'<br>';
            $FlightNumber .= $legs['flightNo'].'<br>';
            $Departure_LocationCode .= $legs['depDetail']['code'].'<br>';
            $Arrival_LocationCode .= $legs['arrDetail']['code'].'<br>';
            $OperatingAirline_Code .= $legs['aircraftType'].'<br>';
            $Departure_TerminalID .= $legs['depDetail']['terminal'].'<br>';
            $Arrival_TerminalID .= $legs['arrDetail']['terminal'].'<br>';
            $OperatingAirline_FlightNumber .= $legs['flightNo'].'<br>';
            $airlineName .= $legs['carrier']['name'].'<br>';
            $class .= $legs['classDetail']['adt']['class'].'<br>';
            $refundable .= $legs['refundable'].'<br>';
           # $ticketType .= $legs['TicketType'].'<br>';
            $baggageInfo .= $amenities.'<br>';
            $mealInfo .= $legs['amenities']['meal'].'<br>';
            $flyingTime .= $legs['flyTime'].'<br>';
            $journeyTime .= $Details['journeyInfo'][0]['journeyTime'].'<br>';
            $fareBasis .= $legs['classDetail']['adt']['basis'].'<br>';
        }
        
         $totalBaseFare = ($priceFinalData['fare']['totalFare']['base']['amount']);
        $totalamount = ($priceFinalData['fare']['totalFare']['total']['amount']);
        
        $query = $this->db->query($sql="insert into flight_booking_beta set user_type='".$agentData['user_type']."',user_id='".$agentData['user_id']."', journeyType = '".trim($requestData['journey_type'])."', 
                                                            stops = '".(count($onwardDetails)-1)."',
                                                              DepartureDateTime = '".$DepartureDateTime."',
                                                              ArrivalDateTime = '".$ArrivalDateTime."',
                                                              FlightNumber = '".$FlightNumber."',
                                                              Departure_LocationCode = '".$Departure_LocationCode."',
                                                              Departure_TerminalID = '".$Departure_TerminalID."',
                                                              Arrival_LocationCode = '".$Arrival_LocationCode."',
                                                              Arrival_TerminalID = '".$Arrival_TerminalID."',
                                                              OperatingAirline_Code = '".$OperatingAirline_Code."',
                                                              OperatingAirline_FlightNumber = '".$OperatingAirline_FlightNumber."',
                                                              airline_name = '".$airlineName."',
                                                              class = '".$class."',
                                                              not_refundable = '".$refundable."',
                                                             
                                                              baggageInfo = '".$baggageInfo."',
                                                              mealInfo = '".$mealInfo."',
                                                              flyingTime = '".$flyingTime."',
                                                              journeyTime = '".$journeyTime."',
                                                              fareBasis = '".$fareBasis."',
                                                              admin_markup = '".$adminMarkup."',
                                                              agent_markup = '".$agentMarkup."',
                                                              TotalFare = '".$totalamount."',
                                                              TotalFare_org = '".$totalamount."',
                                                              BaseFare_org = '".$totalBaseFare."',
                                                              TotalFare_curr = '".trim($priceFinalData['webDta']['envDta']['currencyCode'])."',
                                                              from_code = '".trim($requestData['fromCode'])."',
                                                              to_code = '".trim($requestData['toCode'])."',
                                                              from_city = '".trim($requestData['fromCity'])."',
                                                              to_city = '".trim($requestData['toCity'])."',
                                                              departDate = '".$requestData['sd']."',
                                                              rturnDate = '".$requestData['ed']."',
                                                              adultPax = '".$requestData['adult']."',
                                                              childPax = '".$requestData['child']."',
                                                              infantPax = '".$requestData['infant']."',
                                                              user_email = '".mysql_real_escape_string(trim($postData['user_email']))."',
                                                              user_mobile = '".trim($postData['mobile_code']).'-'.trim($postData['phone_number'])."',
                                                              booked_date= '".date('Y-m-d')."'");
        $id = $this->db->insert_id();
        
        
        $DepartureDateTime = '';$ArrivalDateTime = '';$FlightNumber = '';
        $Departure_LocationCode = '';$Departure_TerminalID = '';$Arrival_LocationCode = '';
        $Arrival_TerminalID = '';$OperatingAirline_Code = '';$OperatingAirline_FlightNumber = '';
        $airlineName = '';$class = '';$refundable = '';$ticketType = '';$baggageInfo = '';
        $mealInfo = '';$flyingTime = '';$journeyTime = '';$fareBasis = '';
         if(!empty($returnDetails)){
          $returnDetails=$returnDetails['flights'];
        }else{
           $returnDetails=$returnDetails;
        }
        foreach($returnDetails as $legs)
        {
            $amenities=isset($legs['amenities']['baggage']['checkin']['adt']['desc'])?$legs['amenities']['baggage']['checkin']['adt']['desc']:'N/A';
            $DepartureDateTime .= $legs['depDetail']['time'].'<br>';
            $ArrivalDateTime .= $legs['arrDetail']['time'].'<br>';
            $FlightNumber .= $legs['flightNo'].'<br>';
            $Departure_LocationCode .= $legs['depDetail']['code'].'<br>';
            $Arrival_LocationCode .= $legs['arrDetail']['code'].'<br>';
            $OperatingAirline_Code .= $legs['aircraftType'].'<br>';
            $Departure_TerminalID .= $legs['depDetail']['terminal'].'<br>';
            $Arrival_TerminalID .= $legs['arrDetail']['terminal'].'<br>';
            $OperatingAirline_FlightNumber .= $legs['flightNo'].'<br>';
            $airlineName .= $legs['carrier']['name'].'<br>';
            $class .= $legs['classDetail']['adt']['class'].'<br>';
            $refundable .= $legs['refundable'].'<br>';
           # $ticketType .= $legs['TicketType'].'<br>';
            $baggageInfo .= $amenities.'<br>';
            $mealInfo .= $legs['amenities']['meal'].'<br>';
            $flyingTime .= $legs['flyTime'].'<br>';
            $journeyTime .= $Details['journeyInfo'][0]['journeyTime'].'<br>';
            $fareBasis .= $legs['classDetail']['adt']['basis'].'<br>';
        }
        
        $query = $this->db->query($sql="insert into flight_booking_round_beta set user_id='".$agentData['user_id']."',master_id='".$id."',stops = '".(count($returnDetails)-1)."',
                                                              DepartureDateTime = '".$DepartureDateTime."',
                                                              ArrivalDateTime = '".$ArrivalDateTime."',
                                                              FlightNumber = '".$FlightNumber."',
                                                              Departure_LocationCode = '".$Departure_LocationCode."',
                                                              Departure_TerminalID = '".$Departure_TerminalID."',
                                                              Arrival_LocationCode = '".$Arrival_LocationCode."',
                                                              Arrival_TerminalID = '".$Arrival_TerminalID."',
                                                              OperatingAirline_Code = '".$OperatingAirline_Code."',
                                                              OperatingAirline_FlightNumber = '".$OperatingAirline_FlightNumber."',
                                                              airline_name = '".$airlineName."',
                                                              class = '".$class."',
                                                              not_refundable = '".$refundable."',
                                                            
                                                              baggageInfo = '".$baggageInfo."',
                                                              mealInfo = '".$mealInfo."',
                                                              flyingTime = '".$flyingTime."',
                                                              journeyTime = '".$journeyTime."',
                                                              fareBasis = '".$fareBasis."'");
        
        $query = $this->db->query($sql = "insert into flight_booking_contact_details_beta set master_id='".$id."',user_id='".$agentData['user_id']."',
                                                                                         user_email='".mysql_real_escape_string(trim($postData['user_email']))."',
                                                                                         user_mobile='".trim($postData['mobile_code']).'-'.trim($postData['phone_number'])."'");
        
        if(isset($postData['adult_passport_no']))
            $adult_pass_no = $postData['adult_passport_no'];
        if(isset($postData['child_passport_no']))
            $child_pass_no = $postData['child_passport_no'];
        if(isset($postData['infant_passport_no']))
            $infant_pass_no = $postData['infant_passport_no'];
        
        $baggageTotal = 0;
        for($i=0;$i<$requestData['adult'];$i++)
        {
            $this->db->query($sql="insert into flight_booking_pax_details_beta set master_id='".$id."', 
                                                                          type='adult',
                                                                          title='".$postData['adulttitle'][$i]."',
                                                                          first_name='".mysql_real_escape_string(trim($postData['adultFname'][$i]))."',
                                                                          last_name='".mysql_real_escape_string(trim($postData['adultLname'][$i]))."',
                                                                          dob='".$postData['adult_dob'][$i]."',
                                                                          pass_no='".(is_array($adult_pass_no)?$adult_pass_no[$i]:'')."',
                                                                          extra_baggage_onward='".$postData['adultBaggageOnward'][$i]."',
                                                                          extra_baggage_return='".$postData['adultBaggageReturn'][$i]."'
                                                                        ");
            if($postData['adultBaggageOnward'][$i] != ''){
                $ex = explode(';',$postData['adultBaggageOnward'][$i]);
                $baggageTotal = ($baggageTotal+$ex[1]);
            }
            if($postData['adultBaggageReturn'][$i] != ''){
                $ex = explode(';',$postData['adultBaggageReturn'][$i]);
                $baggageTotal = ($baggageTotal+$ex[1]);
            }
        }
        
        if($requestData['child'] > 0)
        {
            for($i=0;$i<$requestData['child'];$i++)
            {
                $this->db->query($sql="insert into flight_booking_pax_details_beta set master_id='".$id."', 
                                                                                    type='child',
                                                                                    title='".$postData['childtitle'][$i]."',
                                                                                    first_name='".mysql_real_escape_string(trim($postData['childFname'][$i]))."',
                                                                                    last_name='".mysql_real_escape_string(trim($postData['childLname'][$i]))."',
                                                                                    dob='".$postData['child_dob'][$i]."',
                                                                                    pass_no='".(is_array($child_pass_no)?$child_pass_no[$i]:'')."',
                                                                                    extra_baggage_onward='".$postData['childBaggageOnward'][$i]."',
                                                                                    extra_baggage_return='".$postData['childBaggageReturn'][$i]."'
                                                                                ");
                if($postData['childBaggageOnward'][$i] != ''){
                    $ex = explode(';',$postData['childBaggageOnward'][$i]);
                    $baggageTotal = ($baggageTotal+$ex[1]);
                }
                if($postData['childBaggageReturn'][$i] != ''){
                    $ex = explode(';',$postData['childBaggageReturn'][$i]);
                    $baggageTotal = ($baggageTotal+$ex[1]);
                }
               
            }
        }
        
        if($requestData['infant'] > 0)
        {
            for($i=0;$i<$requestData['infant'];$i++)
            {
                $this->db->query($sql="insert into flight_booking_pax_details_beta set master_id='".$id."', 
                                                                                    type='child',
                                                                                    title='".$postData['infanttitle'][$i]."',
                                                                                    first_name='".mysql_real_escape_string(trim($postData['infantFname'][$i]))."',
                                                                                    last_name='".mysql_real_escape_string(trim($postData['infantLname'][$i]))."',
                                                                                    dob='".$postData['infant_dob'][$i]."',
                                                                                    pass_no='".(is_array($infant_pass_no)?$infant_pass_no[$i]:'')."',
                                                                                    extra_baggage_onward='".$postData['infantBaggageOnward'][$i]."',
                                                                                    extra_baggage_return='".$postData['infantBaggageReturn'][$i]."'
                                                                                ");
                
                if($postData['infantBaggageOnward'][$i] != ''){
                    $ex = explode(';',$postData['infantBaggageOnward'][$i]);
                    $baggageTotal = ($baggageTotal+$ex[1]);
                }
                if($postData['infantBaggageReturn'][$i] != ''){
                    $ex = explode(';',$postData['infantBaggageReturn'][$i]);
                    $baggageTotal = ($baggageTotal+$ex[1]);
                }
            }
        }
        
        $tot = ($priceFinalData['fare']['totalFare']['total']['amount']+$baggageTotal);
        $totOrg = ($priceFinalData['fare']['totalFare']['total']['amount']+$baggageTotal);
        $this->db->query($sql = "update flight_booking_beta set TotalFare='".$tot."',TotalFare_org='".$totOrg."' where id='".$id."'");

        
        return $id;
    }
    
    
    function getBookingData($id)
    {
        $sql = "select * from flight_booking_beta where id = '".$id."'";
        $query=$this->db->query($sql);
        if($query->num_rows() > 0)
        {
            $data = $query->row();
            return $data;
        }
        else return '';
    }
    
    function getBookingPaxData($id)
    {
        $sql = "select * from flight_booking_pax_details_beta where master_id = '".$id."'";
        $query=$this->db->query($sql);
        if($query->num_rows() > 0)
        {
            $data = $query->result();
            return $data;
        }
        else return '';
    }
    
    function getAirlineNameOnCode($code)
    {
        $sql = "select airline_name from airlines_list where airline_code = '".$code."'";
        $query=$this->db->query($sql);
        if($query->num_rows() > 0)
        {
            $data = $query->row();
            return $data->airline_name;
        }
        else return '';
    }
    
    function getDepArvAirportOnCode($dep,$arv)
    {
        $sql = "select `airport_name`,`airport_city` from airport_list where `airport_code`='".$dep."' UNION select `airport_name`,`airport_city` from airport_list where `airport_code`='".$arv."'";
        $query=$this->db->query($sql);
        if($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else return '';
    }
    
    function getDepArvCountryOnCode($dep,$arv)
    {
        $sql = "select `airport_country` from airport_list where `airport_code`='".$dep."' UNION select `airport_country` from airport_list where `airport_code`='".$arv."'";
        //echo $sql;die;
        $query=$this->db->query($sql);
        if($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else return '';
    }
    
    function deleteFailedFlightData($masterId){
        $this->db->query($sql = "delete from flight_booking where id='".$masterId."'");
        $this->db->query($sql = "delete from flight_booking where id='".$masterId."'");
        $this->db->query($sql = "delete from flight_booking where id='".$masterId."'");
        $this->db->query($sql = "delete from flight_booking where id='".$masterId."'");
    }
    
    function getBookingRoundData($id){
        $sql = "select * from flight_booking_round_beta where master_id = '".$id."'";
        $query=$this->db->query($sql);
        if($query->num_rows() > 0)
        {
            $data = $query->row();
            return $data;
        }
        else return '';
    }
    
    function getAirportCity($from,$to){
        $query = $this->db->query($sql = "select airport_city from airport_list where airport_code='".$from."' UNION select airport_city from airport_list where airport_code='".$to."'");
        if($query->num_rows() > 0){
            $data = $query->result_array();
        } else {
            $data = '';
        }
        
        return $data;
    }
    
    function getAirportCityOnCode($from){
        $query = $this->db->query($sql = "select airport_city,airport_name from airport_list where airport_code='".$from."'");
        if($query->num_rows() > 0){
            $data = $query->row();
        } else {
            $data = '';
        }
        
        return $data;
    }
    
    
}
