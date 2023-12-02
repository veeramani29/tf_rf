<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?php echo Site_Title; ?></title>
        <!-- Bootstrap -->
        <style>p{font-size:15px;}</style>
    </head>
    <body>
        <div style="width:80%; margin:auto;">
            <div>
                <img src="<?php echo base_url(); ?>assets/images/logo.png" width="250" height="100">
            </div>
            <div style="padding: 0px 0px 10px 0px; border:1px solid #ccc; width:100%; float:left;">
                <div style="padding:0px;width:100%; float:left;">
                    <div style="width:25%;float:left;">
                        <?php 
                            $airportCity = $this->Flight_Model->getAirportCity($flightDetails->from_code,$flightDetails->to_code);
                            
                        ?>
                        <p style="    padding-left: 50px;"><?php echo($airportCity != '' ? $airportCity[0]['airport_city'] : ''); ?></p>
                        <p style="    padding-left: 50px;">Onward</p>
                    </div>
                    <div style="width:25%;float:left;">
                        <span style="float:left; margin-top:8px; padding-right:25px;"><img src="<?php echo base_url(); ?>/assets/images/depart-icon.png" style="width:22px;"></span><p style="float:left;"> <?php echo($airportCity != '' ? $airportCity[1]['airport_city'] : ''); ?></p>
                        <div style="clear:both;"></div>
                        <p style="text-align:center; margin-top:0px;">
                            <?php
                                $depDateT = explode('<br>',$flightDetails->DepartureDateTime);
                                $depDate = explode('T',$depDateT[0]);
                                echo date('M d,D Y',strtotime($depDate[0]));
                            ?>
                        </p>
                    </div>
                    <div style="width:25%;float:left;">
                        <p><?php echo($flightDetails->journeyType == 'one_way' ? 'One Way' : 'Round Trip'); ?></p>
                        <p style="text-align:center;"><?php echo $flightDetails->adultPax ?> Adult(s)&nbsp;&nbsp;<?php echo $flightDetails->childPax ?> Child(s)&nbsp;&nbsp;<?php echo $flightDetails->infantPax ?> Infant(s)</p>
                    </div>
                    <div style="width:25%;float:left;">
                        <p style="float:left; padding-right: 3px;">Booking ID : </p>
                        <p style="float:left;"><b><?php echo $flightDetails->booking_ref; ?></b></p>
                        <p  style="text-align:center;">Booking Date : <b><?php echo date('M d,D Y',strtotime($flightDetails->booked_date)); ?></b></p>
                    </div>
                    <div style="clear:both;"></div>
                    <hr style="margin-bottom:0px;">
                    <div style="background-color: #f1f1f1; width:100%; float:left; ">
                        <div  style="     padding-left: 37px;    padding-top: 14px; width: 35%;float:left;">
                            <span style="float:left; margin-top:8px; padding-right:25px;"><img src="<?php echo base_url(); ?>/assets/images/depart-icon.png" style="width:22px;"></span><p style="float:left; margin-top:9px;"> <b>Onward - <?php echo($flightDetails->stops > 0 ? $flightDetails->stops+1 : '1'); ?> </b><span style=" font-size: 16px;">Flight(s)</span></p>
                        </div>
                        <div style=" width:58%;float:left;">
                            <p style="float: right;color: red;border: 1px solid red;padding: 6px;border-radius: 4px;"><?php echo($flightDetails->not_refundable == 'false' ? 'Not Refundable':'Refundable'); ?></p>
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <hr style="margin-top:0px;">
                    <div style="width:100%; float:left;">
                        <div style="width:25%;float:left;">
                            <p style="padding-left: 30px;font-size: 17px;color: red;">Flight</p>
                        </div>
                        <div style="width:25%;float:left;">
                            <span style="float:left; margin-top:8px; padding-right:25px;"><img src="<?php echo base_url(); ?>/assets/images/flight-sprite.png" style="width:22px;"></span><p style="float:left;"> Departing</p>
                        </div>
                        <div style="width:25%;float:left;">
                            <span style="float:left; margin-top:8px; padding-right:25px;"><img src="<?php echo base_url(); ?>/assets/images/flight-arrival.png" style="width:22px;"></span><p style="float:left;"> Arriving</p>
                        </div>
                        <div style="width:25%;float:left;"></div>
                        <div style="clear:both;"></div>
                        <hr>
                    </div>
                    
                    <div style="width:100%; float:left;">
                        <?php 
                            $OperatingAirline_Code = explode('<br>', $flightDetails->OperatingAirline_Code);
                            $airlineName = explode('<br>', $flightDetails->airline_name);
                            $FlightNumber = explode('<br>', $flightDetails->FlightNumber);
                            $Departure_LocationCode = explode('<br>', $flightDetails->Departure_LocationCode);
                            $Departure_TerminalID = explode('<br>', $flightDetails->Departure_TerminalID);
                            $Arrival_LocationCode = explode('<br>', $flightDetails->Arrival_LocationCode);
                            $Arrival_TerminalID = explode('<br>', $flightDetails->Arrival_TerminalID);
                            $DepartureDateTime = explode('<br>', $flightDetails->DepartureDateTime);
                            $ArrivalDateTime = explode('<br>', $flightDetails->ArrivalDateTime);
                            $i = 0;
                            for($i = 0;$i < count($Departure_LocationCode)-1;$i++){
                        ?>
                        <div style="width:25%;float:left;">
                            <span style="float:left; margin-top:8px; padding-right:25px;">
                                <img src="<?php echo base_url(); ?>/assets/images/airlines/icons/<?php echo $OperatingAirline_Code[$i]; ?>.gif" style="padding-left: 30px;">
                            </span>
                            <p style="float:left;"> 
                                <b><?php echo $airlineName[$i]; ?></b>
                                <br>
                                <span style="font-size: 15px;"><?php echo $airlineName[$i]; ?>-<?php echo $FlightNumber[$i]; ?></span>
                            </p>
                        </div>
                        <?php 
                            $depAirportDetails = $this->Flight_Model->getAirportCityOnCode($Departure_LocationCode[$i]);
                        ?>
                        <div style="width:25%;float:left;">
                            <p style="font-size: 17px;"><b><?php echo $Departure_LocationCode[$i]; ?></b> <?php echo $depAirportDetails->airport_city; ?></p>
                            <p style="margin-bottom: 2px;"><?php echo $depAirportDetails->airport_name; ?><br /><?php echo(is_numeric($Departure_TerminalID[$i]) ? 'Terminal : '.$Departure_TerminalID[$i] : $Departure_TerminalID[$i]); ?></p>
                            <p>
                                <b>
                                    <?php 
                                        $depDateArr = explode('T',$DepartureDateTime[$i]);
                                        echo date('D d,M Y',strtotime($depDateArr[0])).', '.$depDateArr[1];
                                    ?>
                                </b>
                            </p>
                        </div>
                        <?php 
                            $arvAirportDetails = $this->Flight_Model->getAirportCityOnCode($Arrival_LocationCode[$i]);
                        ?>
                        <div style="width:25%;float:left;">
                            <p style="font-size: 17px;"><b><?php echo $Arrival_LocationCode[$i]; ?></b> <?php echo $arvAirportDetails->airport_city; ?></p>
                            <p style="margin-bottom: 2px;"><?php echo $arvAirportDetails->airport_name; ?><br /><?php echo(is_numeric($Arrival_TerminalID[$i]) ? 'Terminal : '.$Arrival_TerminalID[$i] : $Arrival_TerminalID[$i]); ?></p>
                            <p>
                                <b>
                                    <?php 
                                        $arvDateArr = explode('T',$ArrivalDateTime[$i]);
                                        echo date('D d,M Y',strtotime($arvDateArr[0])).', '.$arvDateArr[1];
                                    ?>
                                </b>
                            </p>
                        </div>
                        <div style="width:25%;float:left;">
                            <?php 
                                ###############################Duration Calculation##################################################
                                $date1 = new DateTime($depDateArr[0] . 'T' . $depDateArr['1']);
                                $date2 = new DateTime($arvDateArr[0] . 'T' . $arvDateArr[1]);
                                $diff = $date2->diff($date1);
                                $duration = $diff->format('%hH, %iM'); //die;
                                ###############################Duration Calculation##################################################
                            ?>
                            <p style="color:#a9a9a9;text-align:right;padding-right: 40px;"><?php echo $duration; ?></p>
                        </div>
                        <div style="clear:both;"></div>
                        <?php 
                            if (count($Departure_LocationCode) > 2 && $i < count($Departure_LocationCode) - 2) {
                                $date3 = new DateTime($arvDateArr[0] . 'T' . $arvDateArr[1]);
                                $depDateTim3 = explode('T', $DepartureDateTime[$i+1]);
                                $chunks2 = str_split($depDateTim3[1], 2);
                                $result2 = implode(':', $chunks2);
                                $date4 = new DateTime($depDateTim3[0].'T'.$result2);
                                $diff1 = $date4->diff($date3);
                                $layover = $diff1->format('%hh, %im'); //die;
                        ?>
                        <div style="width:100%; float:left;">

                            <div style="padding-left: 47px;margin:auto; width:25%;">
                                <div style="border: 1px solid #ff8c8c;float:left; padding: 0px 25px 0px 25px;">
                                    <span style="float:left; margin-top:16px; padding-right:8px;"><img src="<?php echo base_url(); ?>/assets/images/tim.png" style="width:16px;"></span><p style="float:left;"> LAYOVER : <span style="color:red; font-size:16px;"><?php echo $layover; ?></span></p>
                                </div>
                            </div>

                        </div>
                        <div style="clear:both;"></div>
                        <?php 
                            }
                        }
                       ?>
                    </div>
                    
                    <?php if($flightDetails->journeyType == 'round_trip'){ ?>
                        <div style="clear:both;"></div>
                    <hr style="margin-bottom:0px;">
                    <div style="background-color: #f1f1f1; width:100%; float:left; ">
                        <div  style="     padding-left: 37px;    padding-top: 14px; width: 35%;float:left;">
                            <span style="float:left; margin-top:8px; padding-right:25px;"><img src="<?php echo base_url(); ?>/assets/images/depart-icon.png" style="width:22px;"></span><p style="float:left; margin-top:9px;"> <b>Return - <?php echo($roundDetails->stops > 0 ? $roundDetails->stops+1 : '1'); ?> </b><span style=" font-size: 16px;">Flight(s)</span></p>
                        </div>
                        <div style=" width:58%;float:left;">
                            <p style="float: right;color: red;border: 1px solid red;padding: 6px;border-radius: 4px;"><?php echo($roundDetails->not_refundable == 'false' ? 'Not Refundable':'Refundable'); ?></p>
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <hr style="margin-top:0px;">
                    <div style="width:100%; float:left;">
                        <div style="width:25%;float:left;">
                            <p style="padding-left: 30px;font-size: 17px;color: red;">Flight</p>
                        </div>
                        <div style="width:25%;float:left;">
                            <span style="float:left; margin-top:8px; padding-right:25px;"><img src="<?php echo base_url(); ?>/assets/images/flight-sprite.png" style="width:22px;"></span><p style="float:left;"> Departing</p>
                        </div>
                        <div style="width:25%;float:left;">
                            <span style="float:left; margin-top:8px; padding-right:25px;"><img src="<?php echo base_url(); ?>/assets/images/flight-arrival.png" style="width:22px;"></span><p style="float:left;"> Arriving</p>
                        </div>
                        <div style="width:25%;float:left;"></div>
                        <div style="clear:both;"></div>
                        <hr>
                    </div>
                    
                    <div style="width:100%; float:left;">
                        <?php 
                            $OperatingAirline_Code = explode('<br>', $roundDetails->OperatingAirline_Code);
                            $airlineName = explode('<br>', $roundDetails->airline_name);
                            $FlightNumber = explode('<br>', $roundDetails->FlightNumber);
                            $Departure_LocationCode = explode('<br>', $roundDetails->Departure_LocationCode);
                            $Departure_TerminalID = explode('<br>', $roundDetails->Departure_TerminalID);
                            $Arrival_LocationCode = explode('<br>', $roundDetails->Arrival_LocationCode);
                            $Arrival_TerminalID = explode('<br>', $roundDetails->Arrival_TerminalID);
                            $DepartureDateTime = explode('<br>', $roundDetails->DepartureDateTime);
                            $ArrivalDateTime = explode('<br>', $roundDetails->ArrivalDateTime);
                            $i = 0;
                            for($i = 0;$i < count($Departure_LocationCode)-1;$i++){
                        ?>
                        <div style="width:25%;float:left;">
                            <span style="float:left; margin-top:8px; padding-right:25px;">
                                <img src="<?php echo base_url(); ?>/assets/images/airlines/icons/<?php echo $OperatingAirline_Code[$i]; ?>.gif" style="padding-left: 30px;">
                            </span>
                            <p style="float:left;"> 
                                <b><?php echo $airlineName[$i]; ?></b>
                                <br>
                                <span style="font-size: 15px;"><?php echo $airlineName[$i]; ?>-<?php echo $FlightNumber[$i]; ?></span>
                            </p>
                        </div>
                        <?php 
                            $depAirportDetails = $this->Flight_Model->getAirportCityOnCode($Departure_LocationCode[$i]);
                        ?>
                        <div style="width:25%;float:left;">
                            <p style="font-size: 17px;"><b><?php echo $Departure_LocationCode[$i]; ?></b> <?php echo $depAirportDetails->airport_city; ?></p>
                            <p style="margin-bottom: 2px;"><?php echo $depAirportDetails->airport_name; ?><br /><?php echo(is_numeric($Departure_TerminalID[$i]) ? 'Terminal : '.$Departure_TerminalID[$i] : $Departure_TerminalID[$i]); ?></p>
                            <p>
                                <b>
                                    <?php 
                                        $depDateArr = explode('T',$DepartureDateTime[$i]);
                                        echo date('D d,M Y',strtotime($depDateArr[0])).', '.$depDateArr[1];
                                    ?>
                                </b>
                            </p>
                        </div>
                        <?php 
                            $arvAirportDetails = $this->Flight_Model->getAirportCityOnCode($Arrival_LocationCode[$i]);
                        ?>
                        <div style="width:25%;float:left;">
                            <p style="font-size: 17px;"><b><?php echo $Arrival_LocationCode[$i]; ?></b> <?php echo $arvAirportDetails->airport_city; ?></p>
                            <p style="margin-bottom: 2px;"><?php echo $arvAirportDetails->airport_name; ?><br /><?php echo(is_numeric($Arrival_TerminalID[$i]) ? 'Terminal : '.$Arrival_TerminalID[$i] : $Arrival_TerminalID[$i]); ?></p>
                            <p>
                                <b>
                                    <?php 
                                        $arvDateArr = explode('T',$ArrivalDateTime[$i]);
                                        echo date('D d,M Y',strtotime($arvDateArr[0])).', '.$arvDateArr[1];
                                    ?>
                                </b>
                            </p>
                        </div>
                        <div style="width:25%;float:left;">
                            <?php 
                                ###############################Duration Calculation##################################################
                                $date1 = new DateTime($depDateArr[0] . 'T' . $depDateArr['1']);
                                $date2 = new DateTime($arvDateArr[0] . 'T' . $arvDateArr[1]);
                                $diff = $date2->diff($date1);
                                $duration = $diff->format('%hH, %iM'); //die;
                                ###############################Duration Calculation##################################################
                            ?>
                            <p style="color:#a9a9a9;text-align:right;padding-right: 40px;"><?php echo $duration; ?></p>
                        </div>
                        <div style="clear:both;"></div>
                        <?php 
                            if (count($Departure_LocationCode) > 2 && $i < count($Departure_LocationCode) - 2) {
                                $date3 = new DateTime($arvDateArr[0] . 'T' . $arvDateArr[1]);
                                $depDateTim3 = explode('T', $DepartureDateTime[$i+1]);
                                $chunks2 = str_split($depDateTim3[1], 2);
                                $result2 = implode(':', $chunks2);
                                $date4 = new DateTime($depDateTim3[0].'T'.$result2);
                                $diff1 = $date4->diff($date3);
                                $layover = $diff1->format('%hh, %im'); //die;
                        ?>
                        <div style="width:100%; float:left;">

                            <div style="padding-left: 47px;margin:auto; width:25%;">
                                <div style="border: 1px solid #ff8c8c;float:left; padding: 0px 25px 0px 25px;">
                                    <span style="float:left; margin-top:16px; padding-right:8px;"><img src="<?php echo base_url(); ?>/assets/images/tim.png" style="width:16px;"></span><p style="float:left;"> LAYOVER : <span style="color:red; font-size:16px;"><?php echo $layover; ?></span></p>
                                </div>
                            </div>

                        </div>
                        <div style="clear:both;"></div>
                        <?php 
                            }
                        }
                       ?>
                    </div>
                    <?php } ?>
                    
                    <div style="clear:both;"></div>
                    <hr style="margin-bottom:0px;">
                    <div style="background-color: #f1f1f1;    padding-top: 10px;width:100%; float:left;">
                        <div style="    width: 20%;float: left;">
                            <p style=" padding-left: 35px;">Passenger(s) Details</p>
                        </div>
                        <div style="    width: 15%;float: left;">
                            <p>Passport Details</p>
                        </div>
                        <div style="width: 15%;float: left;">
                            <p>PNR</p>
                        </div>
                        <div style="width: 10%;float: left;">
                            <p>FF No</p>
                        </div>
                        <div style="width: 10%;float: left;">
                            <p>E-Ticket</p>
                        </div>
                        <div style="width: 17%;float: left;">
                            <p>Insurance No.</p>
                        </div>
                        <div style="width: 10%;float: left;">
                            <p>Status</p>
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <hr style="margin-top:0px;">
                    
                    <?php 
                        $pnrArr = explode('<br>',$flightDetails->pnr);
                        
                        $i = 1;
                        foreach($paxDetails as $pax){
                    ?>
                        <div style="width:100%; float:left;">
                        <div style="    width: 20%;float: left;">
                            <span style="float:left; margin-top:8px; padding-right:25px; padding-left:30px;"><?php echo $i; ?></span>
                            <p style="float:left; margin-top:0px;"> 
                                <?php 
                                    if ($pax->title == 1)
                                        $title = 'Mr';
                                    else if ($pax->title == 2)
                                        $title = 'Mrs';
                                    else if ($pax->title == 3)
                                        $title = 'Miss';
                                    else
                                        $title = 'Mstr';
                                ?>
                                <b><?php echo $title.' '.$pax->first_name.' '.$pax->last_name; ?></b>
                                <br>
                                <span style="font-size: 15px;">
                                    <?php 
                                        if($pax->type == 'adult'){
                                            $type = 'Adult';
                                        } else if($pax->type == 'child'){
                                            $type = 'Child';
                                        } else {
                                            $type = 'Infant';
                                        }
                                    ?>
                                    <?php echo $type; ?> (<?php echo date('M d, Y',strtotime($pax->dob)); ?>)
                                </span>
                            </p>
                        </div>
                        <div style="    width: 15%;float: left;">
                            <p style="padding-top:8px;"><?php echo($pax->pass_no != '' ? $pax->pass_no : '-'); ?></p>
                        </div>
                         
                        <div style="width: 15%;float: left;">
                            <p style="padding-top:8px; font-size:17px; color:red; margin-top:0px;"><?php echo $pnrArr[0]; ?></p>
                        </div>
                        <div  style="width: 10%;float: left;">
                            <p style="padding-top:8px; margin-top:0px;">-</p>
                        </div>
                        <div style="width: 10%;float: left;">
                            <p style="padding-top:8px; margin-top:0px;">-</p>
                        </div>
                        <div style="width: 17%;float: left;">
                            <p style="padding-top:8px; margin-top:0px;">-</p>
                        </div>
                        <div  style="width: 10%;float: left;">
                            <p style="padding-top:8px; margin-top:0px;">-</p>
                        </div>
                    </div>
                    <?php 
                            $i++;
                        }
                    ?>
                    <div style="clear:both;"></div>
                    <hr style="margin-bottom:0px;">
                    <div style="background-color: #f1f1f1; width:100%; float:left;   padding-top: 10px;">
                        <div style="width:100%; float:left;">
                            <span style="float:left; margin-top:8px; padding-right: 18px; padding-left:30px;"><img src="<?php echo base_url(); ?>/assets/images/star-a.png" style="width:16px;"></span><p style="float:left;    margin-top: 7px;"> Add - ons</p>
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <hr style="margin-top:0px;">
                    <div style="width:100%; float:left;">
                        <?php 
                            $baggageCost = 0;
                            $FlightNumber = explode('<br>', $flightDetails->FlightNumber);
                            $OperatingAirline_Code = explode('<br>', $flightDetails->OperatingAirline_Code);
                            $mealInfo = explode('<br>', $flightDetails->mealInfo);
                            for($i = 0; $i < count($FlightNumber)-1; $i++){
                        ?>
                        <div style="padding:0px; width:100%; float:left;">
                            <div style="width:25%;float:left;">
                                <p style="color:red; padding-left:30px; margin-bottom:0px;">Flight: <?php echo $OperatingAirline_Code[$i]; ?>-<?php echo $FlightNumber[$i]; ?></p>
                            </div>
                            <div style="width:25%;float:left;">
                                <p style=" margin-bottom:0px;">Meals</p>
                            </div>
                            <div style="width:25%;float:left;">
                                <p style="text-align:right; margin-bottom:0px;">Seat</p>
                            </div>
                            <div style="width:25%;float:left;">
                                <p style="text-align:right; margin-bottom:0px;    padding-right: 40px;">Purchased Baggage</p>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <hr style="width: 94%; margin: auto; margin-top: 13px;">
                        <?php
                            foreach($paxDetails as $pax){
                                if ($pax->title == 1)
                                    $title = 'Mr';
                                else if ($pax->title == 2)
                                    $title = 'Mrs';
                                else if ($pax->title == 3)
                                    $title = 'Miss';
                                else
                                    $title = 'Mstr';
                        ?>
                        <div style="padding:0px; width:100%; float:left;">
                            <div style="width:25%;float:left;">
                                <p style=" padding-left:30px;"><?php echo $title.' '.$pax->first_name.' '.$pax->last_name; ?></p>
                            </div>
                            <div style="width:25%;float:left;">
                                <p><?php echo $mealInfo[$i]; ?></p>
                            </div>
                            <div  style="width:25%;float:left;">
                                <p style="text-align:right;">-</p>
                            </div>
                            <?php $baggEx = explode(';',$pax->extra_baggage_onward); $baggageCost = ($baggageCost+$baggEx[1]); ?>
                            <div style="width:25%;float:left;">
                                <p style="text-align:right;padding-right: 40px;"><?php echo $baggEx[0]; ?> kg</p>
                            </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                        
                    </div>
                    <?php if($flightDetails->journeyType == 'round_trip'){ ?>
                    <div style="width:100%; float:left;">
                        <?php 
                            $FlightNumber = explode('<br>', $roundDetails->FlightNumber);
                            $OperatingAirline_Code = explode('<br>', $roundDetails->OperatingAirline_Code);
                            $mealInfo = explode('<br>', $roundDetails->mealInfo);
                            for($i = 0; $i < count($FlightNumber)-1; $i++){
                        ?>
                        <div style="padding:0px; width:100%; float:left;">
                            <div style="width:25%;float:left;">
                                <p style="color:red; padding-left:30px; margin-bottom:0px;">Flight: <?php echo $OperatingAirline_Code[$i]; ?>-<?php echo $FlightNumber[$i]; ?></p>
                            </div>
                            <div style="width:25%;float:left;">
                                <p style=" margin-bottom:0px;">Meals</p>
                            </div>
                            <div style="width:25%;float:left;">
                                <p style="text-align:right; margin-bottom:0px;">Seat</p>
                            </div>
                            <div style="width:25%;float:left;">
                                <p style="text-align:right; margin-bottom:0px;    padding-right: 40px;">Purchased Baggage</p>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <hr style="width: 94%; margin: auto; margin-top: 13px;">
                        <?php
                            foreach($paxDetails as $pax){
                                if ($pax->title == 1)
                                    $title = 'Mr';
                                else if ($pax->title == 2)
                                    $title = 'Mrs';
                                else if ($pax->title == 3)
                                    $title = 'Miss';
                                else
                                    $title = 'Mstr';
                        ?>
                        <div style="padding:0px; width:100%; float:left;">
                            <div style="width:25%;float:left;">
                                <p style=" padding-left:30px;"><?php echo $title.' '.$pax->first_name.' '.$pax->last_name; ?></p>
                            </div>
                            <div style="width:25%;float:left;">
                                <p><?php echo $mealInfo[$i]; ?></p>
                            </div>
                            <div  style="width:25%;float:left;">
                                <p style="text-align:right;">-</p>
                            </div>
                            <?php $baggEx = explode(';',$pax->extra_baggage_return); $baggageCost = ($baggageCost+$baggEx[1]); ?>
                            <div style="width:25%;float:left;">
                                <p style="text-align:right;padding-right: 40px;"><?php echo $baggEx[0]; ?> kg</p>
                            </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                        
                    </div>
                    <div style="clear:both;"></div>
                    <hr>
                    <?php } ?>
                    <div style="clear:both;"></div>
                    <hr>
                    <div style="width:100%; float:left;">
                        <div  style="border: 1px solid #ccc; padding:0px;padding-bottom: 15px; width:35%;float:left;margin-left: 3%;    margin-right: 23%;">
                            <div style="padding-top:10px; background-color: #f1f1f1; padding-bottom: 18px; width:100%;float:left;">
                                <span style="float:left; margin-top:8px; padding-right: 18px; padding-left:30px;"><img src="<?php echo base_url(); ?>/assets/images/doller.png" style="width:16px;"></span><p style="float:left; margin-bottom:0px; margin-top: 10px;">Payment Details</p>
                            </div>
                            <div style="clear:both;"></div>
                            <hr style="margin-top:0px;">
                            <div style="width:100%; float:left;" >
                                <div style="padding:0px; width:70%;float:left;">
                                    <p style="padding-left:30px;    margin-bottom: 2px;">Fare Type</p>
                                </div>
                                <div style="padding:0px; width:30%;float:left;">
                                    <p style="text-align:right;margin-bottom: 2px; padding-right: 16px;"><b>Amount (&#8369;)</b></p>
                                </div>
                                <div style="clear:both;"></div>
                                <hr>
                            </div>
                            <div style="padding:0px;width:100%; float:left;">
                                <div style=" width:70%;float:left;">
                                    <p style="padding-left:30px;margin-bottom: 2px;">Base Fare</p>
                                    <p style="padding-left:30px;margin-bottom: 2px;">Booking Fee & Taxes</p>
                                    <p style="padding-left:30px;margin-bottom: 2px;">Addon Fee ( Baggage, Seat & Meal)</p>
                                </div>
                                <div style=" width:30%;float:left;">
                                    <?php 
                                        if($flightDetails->user_type == 1){
                                            $baseFare = ($flightDetails->BaseFare_org+$flightDetails->admin_markup+$flightDetails->agent_markup);
                                            $bagggageTotal = $baggageCost;
                                            $tax = ($flightDetails->TotalFare)-($baseFare+$bagggageTotal);
                                        } else {
                                            $baseFare = ($flightDetails->BaseFare_org+$flightDetails->admin_markup+$flightDetails->agent_markup+$flightDetails->sub_agent_markup);
                                            $bagggageTotal = $baggageCost;
                                            $tax = ($flightDetails->TotalFare)-($baseFare+$bagggageTotal);
                                        }
                                    ?>
                                    <p style="text-align:right;margin-bottom: 2px;padding-right: 16px;"><b><?php echo number_format($baseFare,2,'.',','); ?></b></p>
                                    <p style="text-align:right;margin-bottom: 2px;padding-right: 16px;"><b><?php echo number_format($tax,2,'.',','); ?></b></p>
                                    <p style="text-align:right;margin-bottom: 2px; padding-right: 16px;"><b><?php echo number_format($bagggageTotal,2,'.',','); ?></b></p>

                                </div>
                                <div style="width:100%; float:left;">
                                    <hr>
                                </div>
                                <div style="width:100%; float:left;" >
                                    <div  style="padding:0px; width:70%;float:left;">
                                        <p style="padding-left:30px;    margin-bottom: 2px;"><b>Total Fare</b></p>
                                    </div>
                                    <div style="padding:0px; width:30%;float:left;">
                                        <p style="text-align:right;    margin-bottom: 2px;padding-right: 16px;"><b><?php echo number_format($flightDetails->TotalFare,2,'.',','); ?></b></p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div style="    border: 1px solid #ccc; padding:0px;    padding-bottom: 15px; width:35%;float:left;">
                            <div style="padding-top:10px; background-color: #f1f1f1; padding-bottom: 18px;width:100%; float:left;">
                                <span style="float:left; margin-top:8px; padding-right: 18px; padding-left:30px;"><img src="<?php echo base_url(); ?>/assets/images/star-a.png" style="width:16px;"></span><p style="float:left; margin-bottom:0px; margin-top: 9px;">Baggage Details</p>
                            </div>
                            <div style="clear:both;"></div>
                            <hr style="margin-top:0px;">
                            <div style="width:100%; float:left;">
                                <div style=" width:100%;float:left;">
                                    <p style="    padding-left: 9%;"><b>Cabin Baggage (Pre Included)</b></p>
                                    <?php 
                                        $FlightNumber = explode('<br>', $flightDetails->FlightNumber);
                                        $OperatingAirline_Code = explode('<br>', $flightDetails->OperatingAirline_Code);
                                        $baggageInfo = $flightDetails->baggageInfo;
                                        $flightNumbers = '';
                                        for($i = 0; $i<count($FlightNumber)-1;$i++){
                                            $flightNumbers .= $OperatingAirline_Code[$i].'-'.$FlightNumber[$i].',';
                                        }
                                        $flightNumbersR = '';
                                        if($flightDetails->journeyType == 'round_trip'){
                                            $FlightNumberR = explode('<br>', $roundDetails->FlightNumber);
                                            $OperatingAirline_CodeR = explode('<br>', $roundDetails->OperatingAirline_Code);
                                            $baggageInfoR = $roundDetails->baggageInfo;
                                            $flightNumbersR = '';
                                            for($i = 0; $i<count($FlightNumber)-1;$i++){
                                                $flightNumbersR .= $OperatingAirline_Code[$i].'-'.$FlightNumber[$i].',';
                                            }
                                        } else {
                                            $flightNumbersR = '';
                                            $baggageInfoR = '';
                                        }
                                    ?>
                                    <p style="padding-left: 9%;"><?php echo $flightNumbers; ?><?php echo $flightNumbersR; ?></p>
                                    <p style="padding-left: 9%;">Adult:7 Kg Included</p>
                                </div>
                                <div class="col-md-12" style="padding:0px;">
                                    <hr style="margin-top: 2px; margin-bottom: 10px;">
                                </div>
                                <div style=" width:100%;float:left;">
                                    <p style="padding-left: 9%;"><b>Check-in Baggage (Pre Included)</b></p>
                                    <p style="padding-left: 9%;"><?php echo $flightNumbers; ?><?php echo $flightNumbersR; ?></p>
                                    <p style="padding-left: 9%;"><?php echo $baggageInfo; ?><?php echo $baggageInfoR; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>