<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        <title><?php echo Site_Title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/styles.css" type="text/css" rel="stylesheet" media="all">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
        <link href="<?php echo base_url(); ?>assets/css/awe-booking-font.css" type="text/css" rel="stylesheet" media="all">
        <link href="<?php echo base_url(); ?>assets/css/hotel_details.css" type="text/css" rel="stylesheet" media="all">
        <style>
            .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{ border-top:0px; border-left:0px; border-right: 0px; border-bottom: 2px solid #f74623; }
            h4,h5,h6{color: #515151;}
            p{color: #515151;}
            label{color: #515151;font-weight: 100;}
        </style>
    </head>
    <body>
        <!--########################### HEADER STARTS HERE ###############################################################--->
        <?php $this->load->view('header'); ?>
        <!--############################ HEADER ENDS HERE ##############################################################--->
        <div class="container re_pad0">
            <div class="col-md-12 re_pad0">
                <div class="col-md-9 fli_padleft0">
                    <div class="col-md-12 fil_pad2012" style="margin-top:18px;">
                        <p class="pull-left" style=" padding-top:3px !important; padding-bottom:0px;"><span><img alt="" class="pull-left" src="<?php echo base_url(); ?>assets/images/img/flights/tick.png" style=" margin: 0px 8px;"></span>Review your flight details</p>
                    </div>
                    <?php
                        $adult = $searchData['adult'];
                        $child = $searchData['child'];
                        $infant = $searchData['infant'];
                        $duration = explode(':', gmdate("H:i", ($flightData['duration'] * 60)));
                        $durHour = $duration[0];
                        $durMin = $duration[1];
                    ?>
                    <!--###################### ONWARD DETAILS STARTS #############################-->
                    <div class="col-md-12 fli_pad0">
                        <div class="col-md-12 fli_det_bor flight" style="cursor:pointer;">
                            <div class="col-md-6">
                                Onward : <?php echo date('D d, M Y',strtotime($searchData['sd'])); ?> <br /> <?php echo $searchData['fromCity'] ?> to <?php echo $searchData['toCity']; ?>
                            </div>
                            <div class="col-md-1 fli_pad0">
                                <img alt="" class="fli_fli_icon" src="<?php echo base_url(); ?>assets/images/img/flights/clock.png">
                            </div>
                            <div class="col-md-3 fli_right0">
                                Total duration: <?php echo $durHour; ?>h <?php echo $durMin; ?>m 
                            </div>
                            <div class="col-md-1 fli_right0 fli_stop">
                                <span><?php echo $flightData['stops']; ?> stop</span>
                            </div>
                        </div>
                        <?php if(isset($flightDetails) && $flightDetails != ''){ ?>
                        <div class="col-md-12 fli_det_bor satur" style="margin-top:2px;">
                            <?php 
                                $i = 0;
                                foreach ($flightData['legs'] as $flight) { 
                                    $codes = $this->Flight_Model->getDepArvAirportOnCode($flight['Source'], $flight['Destination']);
                                    $depDateArr = explode('T', $flight['DepartureTimeStamp']);
                                    $chunks = str_split($depDateArr[1], 2);
                                    $result = implode(':', $chunks);
                                    $arvDateArr = explode('T', $flight['ArrivalTimeStamp']);
                                    $chunks1 = str_split($arvDateArr[1], 2);
                                    $result1 = implode(':', $chunks1);
                                    ###############################Duration Calculation##################################################
                                    $date1 = new DateTime($depDateArr[0] . 'T' . $result);
                                    $date2 = new DateTime($arvDateArr[0] . 'T' . $result1);
                                    $diff = $date2->diff($date1);
                                    $duration = $diff->format('%hH, %iM'); //die;
                                    ###############################Duration Calculation##################################################
                            ?>
                            <div class="col-md-3 fli_padlefto fli_bor12">
                                <h4 class="fli_clr_de">Flight</h4>
                                <div class="col-md-4 fli_padleft0">
                                    <img alt="" class="fli_fli_icon12" src="<?php echo base_url(); ?>assets/images/airlines/icons/<?php echo $flight['Carrier_code']; ?>.gif">
                                </div>
                                <div class="col-md-8">
                                    <p class="fli_pad_bot2"><?php echo $flight['Carrier'] ?></p> 
                                    <p class="fli_pad_bot2"><?php echo $flight['Carrier_code']; ?>-<?php echo $flight['FlightNumber'] ?></p>
                                    <p class="fli_pad_bot2">&nbsp;</p>
                                </div>
                            </div>
                            <div class="col-md-3 fli_padlefto fli_bor12">
                                <h4 class="fli_clr_de">Departs</h4>
                                <div class="col-md-12 fli_padleft0">
                                    <p class="fli_pad_bot2"><?php echo date('D d, M Y',strtotime($depDateArr[0])); ?></p> 
                                    <p class="fli_pad_bot2"><b><?php echo $result; ?></b> <?php echo($flight['DepartureTerminal'] != '' ? ', '.$flight['DepartureTerminal'] : ''); ?></p>
                                    <p class="fli_pad_bot2"><?php echo $codes[0]['airport_name'] . ', ' . $codes[0]['airport_city']; ?>(<?php echo $flight['Source'] ?>)</p>
                                </div>
                            </div>
                            <div class="col-md-3 fli_padlefto fli_bor12">
                                <h4 class="fli_clr_de">Arrives</h4>
                                <div class="col-md-12 fli_padleft0">
                                    <p class="fli_pad_bot2"><?php echo date('D d, M Y',strtotime($arvDateArr[0])); ?></p> 
                                    <p class="fli_pad_bot2"><b><?php echo $result1; ?></b> <?php echo($flight['ArrivalTerminal'] != '' ? ', '.$flight['ArrivalTerminal'] : ''); ?></p>
                                    <p class="fli_pad_bot2"><?php echo $codes[1]['airport_name'] . ', ' . $codes[1]['airport_city']; ?>(<?php echo $flight['Destination'] ?>)</p>
                                </div>
                            </div>
                            <div class="col-md-3 fli_padlefto">
                                <h4 class="fli_clr_de">Class / Baggage</h4>
                                <div class="col-md-12 fli_padleft0">
                                    <p class="fli_pad_bot2">Economy (<?php echo $flight['Class']; ?>)</p>
                                    <p class="fli_pad_bot2">Baggage: <?php echo $flight['BaggageInfo']; ?></p>
                                    <p class="fli_pad_bot2">Meal: <?php echo $flight['MealInfo']; ?></p>
                                </div>
                            </div>
                                        <?php
                                        if (count($flightData['legs']) > 1 && $i < count($flightData['legs']) - 1) {
                                        ###############################Duration Calculation##################################################
                                        $date3 = new DateTime($depDateTim[0] . 'T' . $result);
                                        $depDateTim3 = explode('T', $flightData['legs'][$i + 1]['DepartureTimeStamp']);
                                        $chunks2 = str_split($depDateTim3[1], 2);
                                        $result2 = implode(':', $chunks2);
                                        $date4 = new DateTime($result2);
                                        $diff1 = $date4->diff($date3);
                                        $layover = $diff1->format('%hh, %im'); //die;
                                        ###############################Duration Calculation##################################################
                                        ?>
                                        <div class="col-md-12">
                                            <h4 class="fli_wai">Connection flight at <?php echo $codes[1]['airport_city']; ?> ( <?php echo $flight['Destination']; ?> )&nbsp;&nbsp;Layover Time : <?php echo $layover; ?></h4>
                                        </div>
                                        <?php
                                        } 
                                        $i++;
                                    }
                            ?>
                            <div style='clear:both;'></div>
                            <div style='color: #465b83;font-weight: bold;'>
                                <?php if($flightData['legs'][0]['Refundable'] == 'true'){ ?>
                                    Fare is Refundable
                                <?php } else { ?>
                                    Fare is Non-Refundable
                                <?php } ?>
                            </div>
                        </div>
                        <?php } else { ?>
                        <div class="col-md-12 fli_det_bor" style="margin-top: 10px;">
                            <div class="col-md-12 flight fli_padleft0">
                                <p class="fli_acc"><span style="padding-right:10px;"><img alt="" src="<?php echo base_url(); ?>assets/images/img/flights/i.png"></span>
                                    <b style="font-size: 14px;color: #f74623;">The flight is not available any more. Please search again and book another flight.</b>
                                </p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <!--###################### ONWARD DETAILS ENDS #############################-->
                    <!--###################### ROUND DETAILS STARTS #############################-->
                    <?php 
                        $duration = explode(':', gmdate("H:i", ($roundData['duration'] * 60)));
                        $durHour = $duration[0];
                        $durMin = $duration[1];
                    ?>
                    <div class="col-md-12 fli_pad0">
                        <div class="col-md-12 fli_det_bor flight" style="cursor:pointer;">
                            <div class="col-md-6">
                                Return : <?php echo date('D d, M Y',strtotime($searchData['sd'])); ?> <br /> <?php echo $searchData['fromCity'] ?> to <?php echo $searchData['toCity']; ?>
                            </div>
                            <div class="col-md-1 fli_pad0">
                                <img alt="" class="fli_fli_icon" src="<?php echo base_url(); ?>assets/images/img/flights/clock.png">
                            </div>
                            <div class="col-md-3 fli_right0">
                                Total duration: <?php echo $durHour; ?>h <?php echo $durMin; ?>m 
                            </div>
                            <div class="col-md-1 fli_right0 fli_stop">
                                <span><?php echo $roundData['stops']; ?> stop</span>
                            </div>
                        </div>
                        <?php if(isset($flightDetails) && $flightDetails != ''){ ?>
                        <div class="col-md-12 fli_det_bor satur" style="margin-top:2px;">
                            <?php 
                                $i = 0;
                                foreach ($roundData['legs'] as $flightR) { 
                                    $codes = $this->Flight_Model->getDepArvAirportOnCode($flightR['Source'], $flightR['Destination']);
                                    //echo '<pre />';print_r($codes);die;
                                    $depDateArr = explode('T', $flightR['DepartureTimeStamp']);
                                    $chunks = str_split($depDateArr[1], 2);
                                    $result = implode(':', $chunks);
                                    $arvDateArr = explode('T', $flightR['ArrivalTimeStamp']);
                                    $chunks1 = str_split($arvDateArr[1], 2);
                                    $result1 = implode(':', $chunks1);
                                    ###############################Duration Calculation##################################################
                                    $date1 = new DateTime($depDateArr[0] . 'T' . $result);
                                    $date2 = new DateTime($arvDateArr[0] . 'T' . $result1);
                                    $diff = $date2->diff($date1);
                                    $duration = $diff->format('%hH, %iM'); //die;
                                    ###############################Duration Calculation##################################################
                            ?>
                            <div class="col-md-3 fli_padlefto fli_bor12">
                                <h4 class="fli_clr_de">Flight</h4>
                                <div class="col-md-4 fli_padleft0">
                                    <img alt="" class="fli_fli_icon12" src="<?php echo base_url(); ?>assets/images/airlines/icons/<?php echo $flightR['Carrier_code']; ?>.gif">
                                </div>
                                <div class="col-md-8">
                                    <p class="fli_pad_bot2"><?php echo $flightR['Carrier'] ?></p> 
                                    <p class="fli_pad_bot2"><?php echo $flightR['Carrier_code']; ?>-<?php echo $flightR['FlightNumber'] ?></p>
                                    <p class="fli_pad_bot2">&nbsp;</p>
                                </div>
                            </div>
                            <div class="col-md-3 fli_padlefto fli_bor12">
                                <h4 class="fli_clr_de">Departs</h4>
                                <div class="col-md-12 fli_padleft0">
                                    <p class="fli_pad_bot2"><?php echo date('D d, M Y',strtotime($depDateArr[0])); ?></p> 
                                    <p class="fli_pad_bot2"><b><?php echo $result; ?></b> <?php echo($flightR['DepartureTerminal'] != '' ? ', '.$flightR['DepartureTerminal'] : ''); ?></p>
                                    <p class="fli_pad_bot2"><?php echo $codes[0]['airport_name'] . ', ' . $codes[0]['airport_city']; ?>(<?php echo $flightR['Source'] ?>)</p>
                                </div>
                            </div>
                            <div class="col-md-3 fli_padlefto fli_bor12">
                                <h4 class="fli_clr_de">Arrives</h4>
                                <div class="col-md-12 fli_padleft0">
                                    <p class="fli_pad_bot2"><?php echo date('D d, M Y',strtotime($arvDateArr[0])); ?></p> 
                                    <p class="fli_pad_bot2"><b><?php echo $result1; ?></b> <?php echo($flightR['ArrivalTerminal'] != '' ? ', '.$flightR['ArrivalTerminal'] : ''); ?></p>
                                    <p class="fli_pad_bot2"><?php echo $codes[1]['airport_name'] . ', ' . $codes[1]['airport_city']; ?>(<?php echo $flightR['Destination'] ?>)</p>
                                </div>
                            </div>
                            <div class="col-md-3 fli_padlefto">
                                <h4 class="fli_clr_de">Class / Baggage</h4>
                                <div class="col-md-12 fli_padleft0">
                                    <p class="fli_pad_bot2">Economy (<?php echo $flightR['Class']; ?>)</p>
                                    <p class="fli_pad_bot2">Baggage: <?php echo $flightR['BaggageInfo']; ?></p>
                                    <p class="fli_pad_bot2">Meal: <?php echo $flightR['MealInfo']; ?></p>
                                </div>
                            </div>
                                        <?php
                                        if (count($roundData['legs']) > 1 && $i < count($roundData['legs']) - 1) {
                                        ###############################Duration Calculation##################################################
                                        $date3 = new DateTime($depDateTim[0] . 'T' . $result);
                                        $depDateTim3 = explode('T', $roundData['legs'][$i + 1]['DepartureTimeStamp']);
                                        $chunks2 = str_split($depDateTim3[1], 2);
                                        $result2 = implode(':', $chunks2);
                                        $date4 = new DateTime($result2);
                                        $diff1 = $date4->diff($date3);
                                        $layover = $diff1->format('%hh, %im'); //die;
                                        ###############################Duration Calculation##################################################
                                        ?>
                                        <div class="col-md-12">
                                            <h4 class="fli_wai">Connection flight at <?php echo $codes[1]['airport_city']; ?> ( <?php echo $flightR['Destination']; ?> )&nbsp;&nbsp;Layover Time : <?php echo $layover; ?></h4>
                                        </div>
                                        <?php
                                        } 
                                        $i++;
                                    }
                            ?>
                            <div style='clear:both;'></div>
                            <div style='color: #465b83;font-weight: bold;'>
                                <?php if($roundData['legs'][0]['Refundable'] == 'true'){ ?>
                                    Fare is Refundable
                                <?php } else { ?>
                                    Fare is Non-Refundable
                                <?php } ?>
                            </div>
                        </div>
                        <?php } else { ?>
                        <div class="col-md-12 fli_det_bor" style="margin-top: 10px;">
                            <div class="col-md-12 flight fli_padleft0">
                                <p class="fli_acc"><span style="padding-right:10px;"><img alt="" src="<?php echo base_url(); ?>assets/images/img/flights/i.png"></span>
                                    <b style="font-size: 14px;color: #f74623;">The flight is not available any more. Please search again and book another flight.</b>
                                </p>
                            </div>
                        </div>
                        <?php } ?>
                        
                    </div>
                    <!--###################### ROUND DETAILS ENDS #############################-->
                    <?php if(isset($flightDetails) && $flightDetails != ''){ ?>
                    <div class="col-md-12 fli_det_bor" style="margin-top: 10px;">
                        <div class="col-md-12 flight fli_padleft0">
                            <p class="fli_acc"><span style="padding-right:10px;"><img alt="" src="<?php echo base_url(); ?>assets/images/img/flights/i.png"></span>
                                <a data-toggle="modal" data-target="#fare_rule" style="color: #e67e22;cursor:pointer;text-decoration:none;">Fare Information</a>&nbsp;&nbsp;&nbsp;
                                <a data-toggle="modal" data-target="#baggage_policy" style="color: #e67e22;cursor:pointer;text-decoration:none;">Baggage Policy</a>&nbsp;&nbsp;&nbsp;
                                <a data-toggle="modal" data-target="#terms_condition" style="color: #e67e22;cursor:pointer;text-decoration:none;">Terms & Conditions</a></p>
                        </div>
                    </div>
                    

                    <div class="col-md-12 fli_det_bor" style="margin-top: 10px;">
                        <div class="col-md-12 flight fli_padleft0">
                            <p class="fli_acc"><span style="padding-right:10px;"><img alt="" src="<?php echo base_url(); ?>assets/images/img/flights/i.png"></span>Please make sure your details match your passport or government-issued identification. Use English characters only.</p>
                        </div>
                    </div>
                    
                    <form method="post" id="travellerDetails" action="<?php echo site_url(); ?>/flight/booking">
                    <div class="col-md-12 fli_det_bor fli_pad0" style="margin-top: 10px; padding-bottom: 10px !important;">
                        <div class="col-md-12 fil_pad2012">
                            <p class="pull-left fli_para" style=" padding-top:3px !important; padding-bottom:0px;">Traveler details<span class="pull-right" style="font-size:12px;">* Required fields</span></p>
                        </div>
                        
                        <?php for ($i = 0; $i < $searchData['adult']; $i++) { ?>
                        <div class="col-md-2">
                            <p class="fli_det_name" style="font-size:13px;">Adult <?php echo ($i+1); ?>(12+yrs)</p>
                        </div>
                        <div class="col-md-1 re_pad0">
                            <select class="form-control" name="adulttitle[]" required>
                                <option value="1">Mr</option>
                                <option value="2">Mrs</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="adultFname[]" placeholder="First Name" pattern="^[ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ A-Za-z]{2,50}$" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="adultLname[]" placeholder="last Name" pattern="^[ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ A-Za-z]{2,50}$" required>
                            </div> 
                        </div>
                        <?php 
                            $countryList = $this->Flight_Model->getDepArvCountryOnCode($searchData['fromCode'], $searchData['toCode']);
                            if ($countryList != '') {
                                if($countryList[0]['airport_country'] != $countryList[0]['airport_country']){
                        ?>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="adult_passport_no[]" placeholder="Passport Number">
                            </div>
                        </div>
                        <?php
                                }
                            }
                        ?>
                        <?php } ?>
                        
                        <?php if ($searchData['child'] > 0){ ?>
                        <?php for ($i = 0; $i < $searchData['child']; $i++) { ?>
                        <div class="col-md-2">
                            <p class="fli_det_name">Child <?php echo ($i+1); ?>(2-12yrs)</p>
                        </div>
                        <div class="col-md-1 re_pad0">
                            <select class="form-control" name="childtitle[]" required>
                                <option value="4">Mstr</option>
                                <option value="3">Miss</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="childFname[]" placeholder="First Name" pattern="^[ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ A-Za-z]{2,50}$" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="childLname[]" placeholder="last Name" pattern="^[ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ A-Za-z]{2,50}$" required>
                            </div> 
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="child_dob[]" placeholder="Date Of Birth" required>
                            </div> 
                        </div>
                        <?php 
                            $countryList = $this->Flight_Model->getDepArvCountryOnCode($searchData['fromCode'], $searchData['toCode']);
                            if ($countryList != '') {
                                if($countryList[0]['airport_country'] != $countryList[0]['airport_country']){
                        ?>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="child_passport_no[]" placeholder="Passport Number">
                            </div>
                        </div>
                        <?php
                                }
                            }
                        ?>
                        <?php } ?>
                        <?php } ?>
                        
                        <?php if ($searchData['infant'] > 0){ ?>
                        <?php for ($i = 0; $i < $searchData['infant']; $i++) { ?>
                        <div class="col-md-2">
                            <p class="fli_det_name">Infant <?php echo ($i+1); ?>(below 2yrs)</p>
                        </div>
                        <div class="col-md-1 re_pad0">
                            <select class="form-control" name="infanttitle[]" required>
                                <option value="4">Mstr</option>
                                <option value="3">Miss</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="infantFname[]" placeholder="First Name" pattern="^[ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ A-Za-z]{2,50}$" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="infantLname[]" placeholder="last Name" pattern="^[ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ A-Za-z]{2,50}$" required>
                            </div> 
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="infant_dob[]" placeholder="Date Of Birth" required>
                            </div> 
                        </div>
                        <?php 
                            $countryList = $this->Flight_Model->getDepArvCountryOnCode($searchData['fromCode'], $searchData['toCode']);
                            if ($countryList != '') {
                                if($countryList[0]['airport_country'] != $countryList[0]['airport_country']){
                        ?>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="infant_passport_no[]" placeholder="Passport Number">
                            </div>
                        </div>
                        <?php
                                }
                            }
                        ?>
                        <?php } ?>
                        <?php } ?>
                        <hr />
                        <div class="col-md-12">
                            <h4 class="fli_det_name fli_clr_de">Additional Baggage information</h4>(Note: The charge will be added to total fare.)  
                        </div>
                        <div class="col-md-12" style="padding-left:17px;margin-bottom:10px;">
                            <?php if (isset($flightDetails['Inbound']['baggage']) && count($flightDetails['Inbound']['baggage']) > 0) { ?>
                            <div class="col-md-4">
                                <select class="form-control" name="adultBaggageOnward[]">
                                    <option value="">Onward Additional Baggage</option>
                                    <option value=''>Not Required</option>
                                    <?php for ($d = 0; $d < count($flightDetails['Inbound']['baggage']); $d++) { ?>
                                    <option value="<?php echo $flightDetails['Inbound']['baggage'][$d]['size'] . ';' . $flightDetails['Inbound']['baggage'][$d]['price']; ?>"><?php echo $flightDetails['Inbound']['baggage'][$d]['size'] . 'KG - &nbsp;&nbsp;PHP' . $flightDetails['Inbound']['baggage'][$d]['price']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php } else { ?>
                            <div class="col-md-12">
                                Onward Flight : Additional baggage information not there for this flight.
                            </div>
                            <?php } ?>
                            <?php if ($searchData['journey_type'] == 'round_trip') { ?>
                            <?php if (isset($flightDetails['Outbound']['baggage']) && count($flightDetails['Outbound']['baggage']) > 0) { ?>
                            <div class="col-md-4">
                                <select class="form-control" name="adultBaggageReturn[]">
                                    <option value="">Return Additional Baggage</option>
                                    <option value=''>Not Required</option>
                                    <?php for ($d = 0; $d < count($flightDetails['Outbound']['baggage']); $d++) { ?>
                                    <option value="<?php echo $flightDetails['Outbound']['baggage'][$d]['size'] . ';' . $flightDetails['Outbound']['baggage'][$d]['price']; ?>"><?php echo $flightDetails['Outbound']['baggage'][$d]['size'] . 'KG - &nbsp;&nbsp;PHP' . $flightDetails['Outbound']['baggage'][$d]['price']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php } else { ?>
                            <div class="col-md-12">
                                Return Flight : Additional baggage information not there for this flight.
                            </div>
                            <?php } ?>
                            <?php } ?>
                        </div>
                        
                    </div>
                    <input type="hidden" name="flight_id" value="<?php echo $flight_id; ?>">
                    <input type="hidden" name="return_id" value="<?php echo $return_id; ?>">
                    <div class="col-md-12 fli_det_bor fli_pad0" style="margin-top: 10px; padding-bottom: 10px !important; margin-bottom:10px;">
                        <div class="col-md-12 fil_pad2012">
                            <p class="pull-left fli_para" style=" padding-top:3px !important; padding-bottom:0px;">Contact details<span class="pull-right" style="font-size:12px;">* Required fields</span></p>
                        </div>
                        <div class="col-md-3">
                            <p class="fli_det_name">Email Id<span style='color:#f74623'>*</span></p>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" name='user_email' class="form-control" placeholder="Your e-ticket will be sent to this email" required>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="col-md-3">
                            <p class="fli_det_name">Mobile number<span style='color:#f74623'>*</span></p>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" name='mobile_code'>
                                    <?php if($phone_codes != ''){ ?>
                                    <?php foreach($phone_codes as $codes){ ?>
                                    <option value='<?php echo $codes->countries_isd_code; ?>' <?php echo($codes->countries_isd_code == 63 ? 'selected="selected"' : ''); ?>><?php echo $codes->countries_name.'('.$codes->countries_isd_code.')'; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name='phone_number' placeholder="Mobile number">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 fli_padright0" style="padding-bottom:10px;">
                        <div class="custom-search pull-right">
                            <label>&nbsp;</label>
                            <input type="button" name="" value="Continue to Payment" class="btn fli_butt_book" style="color:#fff;background-color: #f74623;">
                        </div>
                    </div>
                    </form>
                    
                    <?php } ?>
                </div>
                <?php if(isset($flightDetails) && $flightDetails != ''){ ?>
                <div class="col-md-3" style="margin-top:18px;">
                    <div class="col-md-12 fli_det_bor fli_pad0" style=" padding-bottom: 10px !important; margin-bottom:10px;">
                        <div class="col-md-12 fil_pad2012" style="padding: 11px 0px 11px 25px;">
                            <p class="pull-left fli_para" style=" padding-top:3px !important; padding-bottom:0px;">Fare details<span class="pull-right" style="font-size:12px;"><img alt="" src="<?php echo base_url(); ?>assets/images/img/flights/i.png" style="margin-right:5px;">Fare rules</span></p>
                        </div>
                        <div class="col-md-12">
                            <h4 class="fli_clr_de">Traveler(Adult)<span style="font-size:10px; padding-left:10px;"><a href="#">View Breakup</a></span></h4>
                        </div>
                        <?php 
                            foreach($flightDetails['fare'] as $fare){
                                if($fare['type'] == 'SingleAdult'){
                        ?>
                        <div class="col-md-12">
                            <div class="col-md-6 fli_pad_bot2 fli_padleft0"><?php echo ($fare['ChargeType'] == 'totalAmount' ? 'TotalAmount':$fare['ChargeType']); ?></div>
                            <div class="col-md-6 pull-right fli_pad_bot2 fli_padright0" style="text-align:right;" >&#8369; <?php echo number_format(($fare['price']*$adult),2,'.',','); ?></div>
                        </div>
                        <?php 
                                }
                            }
                        ?>
                        <?php 
                            if($child > 0){
                        ?>
                            <div class="col-md-12">
                                <h4 class="fli_clr_de">Traveler(Child)<span style="font-size:10px; padding-left:10px;"><a href="#">View Breakup</a></span></h4>
                            </div>
                        <?php 
                            foreach($flightDetails['fare'] as $fareC){
                                if($fareC['type'] == 'SingleChild'){
                        ?>
                                <div class="col-md-12">
                            <div class="col-md-6 fli_pad_bot2 fli_padleft0"><?php echo ($fare['ChargeType'] == 'totalAmount' ? 'TotalAmount':$fare['ChargeType']); ?></div>
                            <div class="col-md-6 pull-right fli_pad_bot2 fli_padright0" style="text-align:right;" >&#8369; <?php echo number_format(($fare['price']*$child),2,'.',','); ?></div>
                        </div>
                        <?php
                                    }
                                }
                            }
                        ?>
                        <?php 
                            if($infant > 0){
                        ?>
                            <div class="col-md-12">
                                <h4 class="fli_clr_de">Traveler(Infant)<span style="font-size:10px; padding-left:10px;"><a href="#">View Breakup</a></span></h4>
                            </div>
                        <?php 
                            foreach($flightDetails['fare'] as $fareI){
                                if($fareI['type'] == 'SingleInfant'){
                        ?>
                                <div class="col-md-12">
                            <div class="col-md-6 fli_pad_bot2 fli_padleft0"><?php echo ($fare['ChargeType'] == 'totalAmount' ? 'TotalAmount':$fare['ChargeType']); ?></div>
                            <div class="col-md-6 pull-right fli_pad_bot2 fli_padright0" style="text-align:right;" >&#8369; <?php echo number_format(($fare['price']*$infant),2,'.',','); ?></div>
                        </div>
                        <?php
                                    }
                                }
                            }
                        ?>
                        
                        <div class="col-md-12" style="padding-top:15px;">
                            <div class="col-md-6 fli_padleft0">
                                <h4 class="fli_clr_de">Fare total</h4>
                            </div>
                            <div class="col-md-6 fli_padright0">
                                <h4 class="pull-right fli_clr_de">&#8369; <?php echo number_format($flightDetails['TotalAmount'],2,'.',','); ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 fli_det_bor" style="margin-top: 10px; padding:0px;">
                        <div class="col-md-12" style="    border-bottom: 1px solid #ccc;">
                            <h4 class="fli_clr_de">Need help?</h4>
                        </div>  
                        <div class="col-md-12">
                            <h4 class="fli_clr_de">Our team is available 24/7.</h4>
                        </div>
                        <div class="col-md-12">
                            <p class="pull-left" style=" padding-top:3px !important; padding-bottom:5px;    color: #7d7c7c;"><span><img alt="" class="pull-left" src="<?php echo base_url(); ?>assets/images/img/flights/phone.png" style=" margin: 0px 8px;"></span>8524069113</p>
                        </div> 
                        <div class="col-md-12">
                            <p class="pull-left" style=" padding-top:3px !important; padding-bottom:15px;    color: #7d7c7c;"><span><img alt="" class="pull-left" src="<?php echo base_url(); ?>assets/images/img/flights/mail.png" style=" margin: 5px 8px;"></span>support@redtagtravels.com</p>
                        </div> 
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div style="clear:both;"></div>
        <!--######################### FOOTER STARTS HERE #################################################################--->
        <?php $this->load->view('footer'); ?>
        <!--######################### FOOTER ENDS HERE #################################################################--->
        <!--##### FARE RULE, TERMS, BAGGAGE POPUP WINDOW STARTS HERE ###############################--->
        <div id="fare_rule" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style="border-radius: 0px;border-top: 3px solid #f74623;border-bottom: 3px solid #f74623;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <span class="modal-title" style="font-size:16px;font-weight:bold">Fare Details</span>
                    </div>
                    <div class="modal-body" style="padding-left:20px;">
                        <div class="col-sm-12">
                            <div style="width:100%;">
                                <table class="table">
                                    <tr>
                                        <td style="font-weight: bold;">Single Adult Fare Breakup :</td>
                                    </tr>
                                </table>
                                <table class="table table-bordered">
                                    <tbody>
                                    <?php
                                    for ($i = 0; $i < count($flightDetails['fare']); $i++) {
                                        if ($flightDetails['fare'][$i]['type'] == 'SingleAdult') {
                                            ?>
                                            
                                            <tr>
                                                <?php
                                                if ($flightDetails['fare'][$i]['ChargeType'] == 'totalAmount') {
                                                    ?>
                                                    <td style="font-weight:bold;">Total Amount</td>
                                                    <td style="font-weight:bold;">PHP <?php echo ($flightDetails['fare'][$i]['price']); ?></td>
                                                    <?php
                                                } else {
                                                    if ($flightDetails['fare'][$i]['ChargeType'] == 'BaseFare')
                                                        $showPrice = ($flightDetails['fare'][$i]['price']);
                                                    else
                                                        $showPrice = $flightDetails['fare'][$i]['price'];
                                                    ?>
                                                    <td><?php echo $flightDetails['fare'][$i]['ChargeType']; ?></td>
                                                    <td>PHP <?php echo $showPrice; ?></td>
                                                    <?php
                                                }
                                                ?>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <?php
                                if ($searchData['child'] > 0) {
                                    ?>
                                    <table class="table">
                                        <tr>
                                            <td style="font-weight: bold;">Single Child Fare Breakup :</td>
                                        </tr>
                                    </table>
                                    <table class="table table-bordered">
                                        <tbody>
                                        <?php
                                        for ($i = 0; $i < count($flightDetails['fare']); $i++) {
                                            if ($flightDetails['fare'][$i]['type'] == 'SingleChild') {
                                                ?>
                                                <tr>
                                                    <?php
                                                    if ($flightDetails['fare'][$i]['ChargeType'] == 'totalAmount') {
                                                        ?>
                                                        <td style="font-weight:bold;">Total Amount</td>
                                                        <td style="font-weight:bold;">PHP <?php echo $flightDetails['fare'][$i]['price']; ?></td>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td><?php echo $flightDetails['fare'][$i]['ChargeType']; ?></td>
                                                        <td>PHP <?php echo $flightDetails['fare'][$i]['price']; ?></td>
                                                        <?php
                                                    }
                                                    ?>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($searchData['infant'] > 0) {
                                    ?>
                                    <table class="table">
                                        <tr>
                                            <td style="font-weight: bold;">Single Infant Fare Breakup :</td>
                                        </tr>
                                    </table>
                                    <table class="table table-bordered">
                                        <tbody>
                                        <?php
                                        for ($i = 0; $i < count($flightDetails['fare']); $i++) {
                                            if ($flightDetails['fare'][$i]['type'] == 'SingleInfant') {
                                                ?>
                                                <tr>
                                                    <?php
                                                    if ($flightDetails['fare'][$i]['ChargeType'] == 'totalAmount') {
                                                        ?>
                                                        <td style="font-weight:bold;">Total Amount</td>
                                                        <td style="font-weight:bold;">PHP <?php echo $flightDetails['fare'][$i]['price']; ?></td>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td><?php echo $flightDetails['fare'][$i]['ChargeType']; ?></td>
                                                        <td>PHP <?php echo $flightDetails['fare'][$i]['price']; ?></td>
                                                        <?php
                                                    }
                                                    ?>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="border:0px;"></div>
                </div>

            </div>
        </div>
        <div id="baggage_policy" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" style="border-radius: 0px;border-top: 3px solid #f74623;border-bottom: 3px solid #f74623;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <span class="modal-title" style="font-size:16px;font-weight:bold">Baggage Policy</span>
                    </div>
                    <div class="modal-body" style="padding-left:20px;">
                        <div class="col-sm-12">
                            <div style="width:100%;">
                                <table class="table">
                                    <tr>
                                        <td style="font-weight: bold;border-top:0px;">Baggage price Breakup ( Onward Flight ) :</td>
                                    </tr>
                                </table>
                                <table class="table table-bordered">
                                    <tbody>
                                    <?php
                                    if (isset($flightDetails['Inbound']['baggage']) && count($flightDetails['Inbound']['baggage']) > 0) {
                                        ?>
                                        <thead>
                                        <tr>
                                            <th>Weight ( Kg )</th>
                                            <th>Cost</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        for ($i = 0; $i < count($flightDetails['Inbound']['baggage']); $i++) {
                                            ?>
                                            <tr>
                                                <td style="padding: 5px;"><?php echo $flightDetails['Inbound']['baggage'][$i]['size']; ?></td>
                                                <td>PHP <?php echo $flightDetails['Inbound']['baggage'][$i]['price']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <table class="table">
                                    <tr>
                                        <td style="font-weight: bold;border-top:0px;">Baggage price Breakup ( Return Flight ) :</td>
                                    </tr>
                                </table>
                                <table class="table table-bordered">
                                    <?php
                                    if (isset($flightDetails['Outbound']['baggage']) && count($flightDetails['Outbound']['baggage']) > 0) {
                                        ?>
                                        <thead>
                                        <tr>
                                            <th>Weight ( Kg )</th>
                                            <th>Cost</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        for ($i = 0; $i < count($flightDetails['Outbound']['baggage']); $i++) {
                                            ?>
                                            <tr>
                                                <td><?php echo $flightDetails['Outbound']['baggage'][$i]['size']; ?></td>
                                                <td>PHP <?php echo $flightDetails['Outbound']['baggage'][$i]['price']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                        <?php
                                    }
                                    ?>
                                </table>
                                    
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="border:0px;"></div>
                </div>

            </div>
        </div>
        <div id="terms_condition" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" style="border-radius: 0px;border-top: 3px solid #f74623;border-bottom: 3px solid #f74623;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <span class="modal-title" style="font-size:16px;font-weight:bold">Terms and Conditions</span>
                    </div>
                    <div class="modal-body" style="padding-left:20px;">
                        <div class="col-sm-12">
                            <div style="width:100%;">
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="border:0px;"></div>
                </div>

            </div>
        </div>
        <!--################################ENDS######################################################-->
    </body>
    <!--################### JS FILES STARTS ################################################-->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
    <!--################### JS FILES ENDS ################################################-->
</html>	