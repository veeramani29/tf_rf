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

     <?php

#print_r($_SESSION);die;
 function show_keys($ar){ 
echo "<ul class='list-group'>"; 
foreach ($ar as $k => $v ) { 
echo "<li class='list-group-item list-group-item-success'>".$k ."</li>"; 
if (is_array($v)) { 
 show_keys ($v); 
}else{
echo "<li class='list-group-item list-group-item-info'>".(($v==1)?"Included":$v)."</li>";  
} 
} 
echo "</ul>"; 

} 


/*cndtns

$flightDetails['extraServices'];
$flightDetails['cndtns']['dobReq'];
$flightDetails['cndtns']['passport']['mandatory'];
[passport] => Array
                (
[issuanceDateReq] => 
 [applicable] => 
                )*/


                $segments_onward=array_filter($flightData['flights'], function($k) {
                if(!isset($k['isReturn'])){ return true; }else{
                return false; }
});
if (trim($searchData['fromCountry']) == 'Philippines' && trim($searchData['toCountry']) == 'Philippines') {
    $segments_return=($roundData['flights']);   
}else{
$segments_return=array_filter($flightData['flights'], function($k) {
return (isset($k['isReturn']) && $k['isReturn']== 1);
});
$segments_return=array_values($segments_return);   
}

  
?>
    <body>
        <!--########################### HEADER STARTS HERE ###############################################################-->
        <?php $this->load->view('header'); ?>
        <!--############################ HEADER ENDS HERE ##############################################################-->
        <div class="container re_pad0">
            <div class="col-md-12 re_pad0">
                <?php if(isset($lowBalance) && $lowBalance == true){ ?>
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <strong>Low Balance!</strong> Your account deposit balance is lower than the flight booking cost. Kindly add deposit then book the flight.
                    </div>
                </div>
                <?php } ?>
                <div class="col-md-9 fli_padleft0">
                    <div class="col-md-12 fil_pad2012" style="margin-top:18px;">
                        <p class="pull-left" style=" padding-top:3px !important; padding-bottom:0px;"><span><img alt="" class="pull-left" src="<?php echo base_url(); ?>assets/images/img/flights/tick.png" style=" margin: 0px 8px;"></span>Review your flight details</p>
                    </div>
                    <?php
                        $adult = $searchData['adult'];
                        $child = $searchData['child'];
                        $infant = $searchData['infant'];
                         $duration = explode(':', gmdate("H:i", ($flightData['journeyInfo'][0]['journeyTime'] * 60)));
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
                                <span><?php echo (count($segments_onward)-1); ?> stop</span>
                            </div>
                        </div>
                        <?php if(isset($flightDetails) && $flightDetails != ''){ ?>
                        <div class="col-md-12 fli_det_bor satur" style="margin-top:2px;">
                            <?php 
                                $i = 0;
                                foreach ($segments_onward as $flight) { 
                                    $codes = $this->Flight_Model->getDepArvAirportOnCode($flight['depDetail']['code'], $flight['arrDetail']['code']);

                                    $dateArr = $flight['arrDetail']['time'];
                                    $dateStructArr = explode('.', $dateArr);
                                    $dateOriArr = explode(' ', $dateStructArr[0]);
                                    $dateArrHM = explode(':', $dateOriArr[1]);
                                    $result1 = $dateArrHM[0].":".$dateArrHM[1];

                                    $dateDep = $flight['depDetail']['time'];
                                    $dateStructDep = explode('.', $dateDep);
                                    $dateOriDep = explode(' ', $dateStructDep[0]);
                                    $dateDepHM = explode(':', $dateOriDep[1]);
                                    $result = $dateDepHM[0].":".$dateDepHM[1];
                                    ###############################Duration Calculation##################################################
                                   /* $date1 = new DateTime($depDateArr[0] . 'T' . $result);
                                    $date2 = new DateTime($arvDateArr[0] . 'T' . $result1);
                                    $diff = $date2->diff($date1);
                                    $duration = $diff->format('%hH, %iM'); //die;*/
                                    ###############################Duration Calculation##################################################
                            ?>
                            <div class="col-md-3 fli_padlefto fli_bor12">
                                <h4 class="fli_clr_de">Flight</h4>
                                <div class="col-md-4 fli_padleft0">
                                    <img alt="" class="fli_fli_icon12" src="<?php echo base_url(); ?>assets/images/airlines/icons/<?php echo $flight['carrier']['code']; ?>.gif">
                                </div>
                                <div class="col-md-8">
                                    <p class="fli_pad_bot2"><?php echo $flight['carrier']['code']; ?></p> 
                                    <p class="fli_pad_bot2"><?php echo $flight['carrier']['code']; ?>-<?php echo $flight['flightNo'] ?></p>
                                    <p class="fli_pad_bot2">&nbsp;</p>
                                </div>
                            </div>
                            <div class="col-md-3 fli_padlefto fli_bor12">
                                <h4 class="fli_clr_de">Departs</h4>
                                <div class="col-md-12 fli_padleft0">
                                    <p class="fli_pad_bot2"><?php echo date('D d, M Y',strtotime($flight['depDetail']['time'])); ?></p> 
                                    <p class="fli_pad_bot2"><b><?php echo $result; ?></b> <?php echo($flight['depDetail']['name'] != '' ? ', '.$flight['depDetail']['name'] : ''); ?></p>
                                    <p class="fli_pad_bot2"><?php echo $codes[0]['airport_name'] . ', ' . $codes[0]['airport_city']; ?>(<?php echo $flight['depDetail']['code'] ?>)</p>
                                </div>
                            </div>
                            <div class="col-md-3 fli_padlefto fli_bor12">
                                <h4 class="fli_clr_de">Arrives</h4>
                                <div class="col-md-12 fli_padleft0">
                                      <p class="fli_pad_bot2"><?php echo date('D d, M Y',strtotime($flight['arrDetail']['time'])); ?></p> 
                                    <p class="fli_pad_bot2"><b><?php echo $result1; ?></b> <?php echo($flight['arrDetail']['name'] != '' ? ', '.$flight['arrDetail']['name'] : ''); ?></p>
                                    <p class="fli_pad_bot2"><?php echo $codes[1]['airport_name'] . ', ' . $codes[1]['airport_city']; ?>(<?php echo $flight['arrDetail']['code'] ?>)</p>
                                </div>
                            </div>
                            <div class="col-md-3 fli_padlefto">
                                <h4 class="fli_clr_de">Class / Baggage</h4>
                                <div class="col-md-12 fli_padleft0">
                                 <?php foreach ($flight['classDetail'] as $classDetailkey => $classDetailvalue) {
                                    echo '<p class="fli_pad_bot2">Economy <b>'.strtoupper($classDetailkey).'</b> ( '.(($classDetailvalue['class']!='')?$classDetailvalue['class']:'Not Included').')</p>';
                                }
                                  ?>
                                   <p class="fli_pad_bot2">Baggage: (ADT) <?php echo isset($flight['amenities']['baggage']['checkin']['adt']['desc'])?$flight['amenities']['baggage']['checkin']['adt']['desc']:'Not Included'; ?></p>
                                    <p class="fli_pad_bot2">Meal: <?php echo ($flight['amenities']['meal']==1)?'Included':'Not Included'; ?></p>
                                    <p class="fli_pad_bot2">Smoke: <?php echo ($flight['amenities']['smoke']==1)?'Included':'Not Included'; ?></p>
                                </div>
                            </div>
                                        <?php
                                        if (count($segments_onward) > 1 && $i < count($segments_onward) - 1) {
                                        ###############################Duration Calculation##################################################
                                        $date3 = new DateTime($dateOriArr[0] . ' ' . $result1);
            $depDateTim3 = explode(' ', $flightData['flights'][$i + 1]['depDetail']['time']);
            $chunks2 = substr($depDateTim3[1], 0,-4);
            $result2 =$chunks2;
            $date4 = new DateTime($dateOriDep[0].' '.$result2);
            $diff1 = $date4->diff($date3);
            $layover = $diff1->format('%h Hour, %i minutes');//die;
                                        ###############################Duration Calculation##################################################
                                        ?>
                                      <div class="col-md-12">
                                            <h4 class="fli_wai">Connection flight at <?php echo $codes[1]['airport_city']; ?> ( <?php echo $flight['arrDetail']['name']; ?> )&nbsp;&nbsp;Layover Time : <?php echo $layover; ?></h4>
                                        </div>
                                        <?php
                                        } 
                                        $i++;
                                    }
                            ?>
                            <div style='clear:both;'></div>
                            <div style='color: #465b83;font-weight: bold;'>
                               <?php if($flight['refundable'] == true){ ?>
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
                    $tttt=isset($flightData['journeyInfo'][1]['journeyTime'])?$flightData['journeyInfo'][1]['journeyTime']:$flightData['journeyInfo'][0]['journeyTime'];
                      $duration = explode(':', gmdate("H:i", ($tttt * 60)));
                      
                        $durHour = $duration[0];
                        $durMin = $duration[1];
                    ?>
                    <div class="col-md-12 fli_pad0">
                        <div class="col-md-12 fli_det_bor flight" style="cursor:pointer;">
                            <div class="col-md-6">
                                Return : <?php echo date('D d, M Y',strtotime($searchData['ed'])); ?> <br /> <?php echo $searchData['toCity'] ?> to <?php echo $searchData['fromCity']; ?>
                            </div>
                            <div class="col-md-1 fli_pad0">
                                <img alt="" class="fli_fli_icon" src="<?php echo base_url(); ?>assets/images/img/flights/clock.png">
                            </div>
                            <div class="col-md-3 fli_right0">
                                Total duration: <?php echo $durHour; ?>h <?php echo $durMin; ?>m 
                            </div>
                            <div class="col-md-1 fli_right0 fli_stop">
                                <span><?php echo (count($segments_return)-1); ?> stop</span>
                            </div>
                        </div>
                        <?php if(isset($flightDetails) && $flightDetails != ''){ ?>
                        <div class="col-md-12 fli_det_bor satur" style="margin-top:2px;">
                            <?php 
                                $i = 0;
                                foreach ($segments_return as $flightR) { 
                                    $codes = $this->Flight_Model->getDepArvAirportOnCode($flightR['depDetail']['code'], $flightR['arrDetail']['code']);
                                    //echo '<pre />';print_r($codes);die;
                                  $dateArr = $flightR['arrDetail']['time'];
                                    $dateStructArr = explode('.', $dateArr);
                                    $dateOriArr = explode(' ', $dateStructArr[0]);
                                    $dateArrHM = explode(':', $dateOriArr[1]);
                                    $result1 = $dateArrHM[0].":".$dateArrHM[1];
                                    
                                    $dateDep = $flightR['depDetail']['time'];
                                    $dateStructDep = explode('.', $dateDep);
                                    $dateOriDep = explode(' ', $dateStructDep[0]);
                                    $dateDepHM = explode(':', $dateOriDep[1]);
                                    $result = $dateDepHM[0].":".$dateDepHM[1];
                                    ###############################Duration Calculation##################################################
                                   /* $date1 = new DateTime($depDateArr[0] . 'T' . $result);
                                    $date2 = new DateTime($arvDateArr[0] . 'T' . $result1);
                                    $diff = $date2->diff($date1);
                                    $duration = $diff->format('%hH, %iM'); //die;*/
                                    ###############################Duration Calculation##################################################
                            ?>
                            <div class="col-md-3 fli_padlefto fli_bor12">
                                <h4 class="fli_clr_de">Flight</h4>
                                <div class="col-md-4 fli_padleft0">
                                    <img alt="" class="fli_fli_icon12" src="<?php echo base_url(); ?>assets/images/airlines/icons/<?php echo $flightR['carrier']['code']; ?>.gif">
                                </div>
                                <div class="col-md-8">
                                    <p class="fli_pad_bot2"><?php echo $flightR['carrier']['name']; ?></p> 
                                    <p class="fli_pad_bot2"><?php echo $flightR['carrier']['code']; ?>-<?php echo $flightR['flightNo'] ?></p>
                                    <p class="fli_pad_bot2">&nbsp;</p>
                                </div>
                            </div>
                            <div class="col-md-3 fli_padlefto fli_bor12">
                                <h4 class="fli_clr_de">Departs</h4>
                                 <div class="col-md-12 fli_padleft0">
                                    <p class="fli_pad_bot2"><?php echo date('D d, M Y',strtotime($flightR['depDetail']['time'])); ?></p> 
                                    <p class="fli_pad_bot2"><b><?php echo $result; ?></b> <?php echo($flightR['depDetail']['name'] != '' ? ', '.$flightR['depDetail']['name'] : ''); ?></p>
                                    <p class="fli_pad_bot2"><?php echo $codes[0]['airport_name'] . ', ' . $codes[0]['airport_city']; ?>(<?php echo $flightR['depDetail']['code'] ?>)</p>
                                </div>
                            </div>
                            <div class="col-md-3 fli_padlefto fli_bor12">
                                <h4 class="fli_clr_de">Arrives</h4>
                                <div class="col-md-12 fli_padleft0">
                                    <p class="fli_pad_bot2"><?php echo date('D d, M Y',strtotime($flightR['arrDetail']['time'])); ?></p> 
                                    <p class="fli_pad_bot2"><b><?php echo $result1; ?></b> <?php echo($flightR['arrDetail']['name'] != '' ? ', '.$flightR['arrDetail']['name'] : ''); ?></p>
                                    <p class="fli_pad_bot2"><?php echo $codes[1]['airport_name'] . ', ' . $codes[1]['airport_city']; ?>(<?php echo $flightR['arrDetail']['code'] ?>)</p>
                                </div>
                            </div>
                            <div class="col-md-3 fli_padlefto">
                                <h4 class="fli_clr_de">Class / Baggage</h4>
                                <div class="col-md-12 fli_padleft0">
                                 <?php foreach ($flightR['classDetail'] as $classDetailkey => $classDetailvalue) {
                                    echo '<p class="fli_pad_bot2">Economy <b>'.strtoupper($classDetailkey).'</b> ( '.(($classDetailvalue['class']!='')?$classDetailvalue['class']:'Not Included').')</p>';
                                }
                                  ?>


                                 
                                    <p class="fli_pad_bot2">Baggage: (ADT) <?php echo isset($flightR['amenities']['baggage']['checkin']['adt']['desc'])?$flightR['amenities']['baggage']['checkin']['adt']['desc']:'Not Included'; ?></p>
                                    <p class="fli_pad_bot2">Meal: <?php echo ($flightR['amenities']['meal']==1)?'Included':'Not Included'; ?></p>
                                    <p class="fli_pad_bot2">Smoke: <?php echo ($flightR['amenities']['smoke']==1)?'Included':'Not Included'; ?></p>
                                </div>
                            </div>
                                        <?php
                                        if (count($segments_return) > 1 && $i < count($segments_return) - 1) {
                                        ###############################Duration Calculation##################################################
                                       $date3 = new DateTime($dateOriArr[0] . ' ' . $result1);
            $depDateTim3 = explode(' ', $flightData['flights'][$i + 1]['depDetail']['time']);
            $chunks2 = substr($depDateTim3[1], 0,-4);
            $result2 =$chunks2;
            $date4 = new DateTime($dateOriDep[0].' '.$result2);
            $diff1 = $date4->diff($date3);
            $layover = $diff1->format('%h Hour, %i minutes');//die;
                                        ###############################Duration Calculation##################################################
                                        ?>
                                        <div class="col-md-12">
                                            <h4 class="fli_wai">Connection flight at <?php echo $codes[1]['airport_city']; ?> ( <?php echo $flightR['arrDetail']['name']; ?> )&nbsp;&nbsp;Layover Time : <?php echo $layover; ?></h4>
                                        </div>
                                        <?php
                                        } 
                                        $i++;
                                    }
                            ?>
                            <div style='clear:both;'></div>
                            <div style='color: #465b83;font-weight: bold;'>
                               <?php if($flight['refundable'] == true){ ?>
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
                    
                    <form method="post" id="travellerDetails" action="<?php echo site_url(); ?>/flightbeta/booking">
                    <div class="col-md-12 fli_det_bor fli_pad0" style="margin-top: 10px; padding-bottom: 10px !important;">
                        <div class="col-md-12 fil_pad2012">
                            <p class="pull-left fli_para" style=" padding-top:3px !important; padding-bottom:0px;">Traveler details<span class="pull-right" style="font-size:12px;">* Required fields</span></p>
                        </div>
                        
                        <?php for ($i = 0; $i < $searchData['adult']; $i++) { ?>
                        <div class="col-md-2">
                            <div class="col-md-12 fli_pad0">
                            <p class="fli_det_name" style="font-size:13px;">Adult <?php echo ($i+1); ?>(12+yrs)</p>
                            </div>
                        </div>
                        <div class="col-md-10 fli_pad0">
                            <div class="col-md-1 re_pad0">
                                <select class="form-control fli_padleft0 fli_padright0" name="adulttitle[]" required>
                                    <option value="1">Mr</option>
                                    <option value="2">Mrs</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="adultFname[]" placeholder="First Name*" patternnn="^[ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ A-Za-z]{2,50}$" oninvaliddd="this.setCustomValidity('Enter correct format first name')" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="adultLname[]" placeholder="Last Name*" patternnn="^[ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ A-Za-z]{2,50}$" oninvaliddd="this.setCustomValidity('Enter correct format last name')" required>
                                </div> 
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control adult_book_date" name="adult_dob[]" placeholder="Date Of Birth*" oninvaliddd="this.setCustomValidity('Select your date of birth')" style="background:#ffffff;" readonly required>
                                </div> 
                            </div>


                            <?php if (isset($flightDetails['ssr']['ssrHeap']['baggage'][0]['data']) && count($flightDetails['ssr']['ssrHeap']['baggage'][0]['data']) > 0) { ?>
                            <div class="col-md-3">
                                <select class="form-control fli_padleft0 fli_padright0" name="adultBaggageOnward[]" >
                                    <option value="">Additional Onward Baggage</option>
                                    <option value=''>Not Required</option>
                                    <?php for ($d = 0; $d < count($flightDetails['ssr']['ssrHeap']['baggage'][0]['data']); $d++) { ?>
                                    <option value="<?php echo $flightDetails['ssr']['ssrHeap']['baggage'][0]['data'][$d]['code']; ?>"><?php echo $flightDetails['ssr']['ssrHeap']['baggage'][0]['data'][$d]['desc'] . ' - &nbsp;&nbsp;&#8369;' . $flightDetails['ssr']['ssrHeap']['baggage'][0]['data'][$d]['amount']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>

                           


                           <?php if (isset($flightDetails['ssr']['ssrHeap']['baggage'][1]['data']) && count($flightDetails['ssr']['ssrHeap']['baggage'][1]['data']) > 0) { ?>
                            <div class="col-md-3">
                                <select class="form-control fli_padleft0 fli_padright0" name="adultBaggageReturn[]" >
                                    <option value="">Additional Return Baggage</option>
                                    <option value=''>Not Required</option>
                                    <?php for ($d = 0; $d < count($flightDetails['ssr']['ssrHeap']['baggage'][1]['data']); $d++) { ?>
                                    <option value="<?php echo $flightDetails['ssr']['ssrHeap']['baggage'][1]['data'][$d]['code']; ?>"><?php echo $flightDetails['ssr']['ssrHeap']['baggage'][1]['data'][$d]['desc'] . ' - &nbsp;&nbsp;&#8369;' . $flightDetails['ssr']['ssrHeap']['baggage'][1]['data'][$d]['amount']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>



                        <?php if (isset($flightDetails['ssr']['ssrHeap']['meal'][0]['data']) && count($flightDetails['ssr']['ssrHeap']['meal'][0]['data']) > 0) { ?>
                            <div class="col-md-3">
                                <select class="form-control fli_padleft0 fli_padright0" name="adultMealsOnward[]" >
                                    <option value="">Onward Meal</option>
                                    <option value=''>Not Required</option>
                                    <?php for ($d = 0; $d < count($flightDetails['ssr']['ssrHeap']['meal'][0]['data']); $d++) { ?>
                                    <option value="<?php echo $flightDetails['ssr']['ssrHeap']['meal'][0]['data'][$d]['code']; ?>"><?php echo $flightDetails['ssr']['ssrHeap']['meal'][0]['data'][$d]['desc'] . '- &nbsp;&nbsp;&#8369;' . $flightDetails['ssr']['ssrHeap']['meal'][0]['data'][$d]['amount']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>



                         <?php if (isset($flightDetails['ssr']['ssrHeap']['meal'][1]['data']) && count($flightDetails['ssr']['ssrHeap']['meal'][1]['data']) > 0) { ?>
                            <div class="col-md-3">
                                <select class="form-control fli_padleft0 fli_padright0" name="adultMealsReturn[]" >
                                    <option value="">Return Meal</option>
                                    <option value=''>Not Required</option>
                                    <?php for ($d = 0; $d < count($flightDetails['ssr']['ssrHeap']['meal'][1]['data']); $d++) { ?>
                                    <option value="<?php echo $flightDetails['ssr']['ssrHeap']['meal'][1]['data'][$d]['code']; ?>"><?php echo $flightDetails['ssr']['ssrHeap']['meal'][1]['data'][$d]['desc'] . '- &nbsp;&nbsp;&#8369;' . $flightDetails['ssr']['ssrHeap']['meal'][1]['data'][$d]['amount']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>

                        </div>
                        <?php if (trim($searchData['fromCountry']) != trim($searchData['toCountry'])){ ?>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="adult_passport_no[]" placeholder="Passport Number*" patternnn="^[0-9 A-Za-z]{5,50}$" oninvaliddd="this.setCustomValidity('Enter correct format passport no')" required>
                            </div>
                        </div>
                        <?php } ?>
                        
                        
                        <div style="clear:both;"></div>
                        <hr />
                        <?php } ?>
                        
                        <?php if ($searchData['child'] > 0){ ?>
                        <?php for ($i = 0; $i < $searchData['child']; $i++) { ?>
                        <div class="col-md-2">
                            <div class="col-md-12 fli_pad0">
                            <p class="fli_det_name" style="font-size: 13px;">Child <?php echo ($i+1); ?>(2-12yrs)</p>
                            </div>
                        </div>
                        <div class="col-md-10 fli_pad0">
                            <div class="col-md-1 re_pad0">
                                <select class="form-control fli_padleft0 fli_padright0" name="childtitle[]" required>
                                    <option value="4">Mstr</option>
                                    <option value="3">Miss</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="childFname[]" placeholder="First Name*" patternnn="^[ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ A-Za-z]{2,50}$" oninvaliddd="this.setCustomValidity('Enter correct format first name')" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="childLname[]" placeholder="Last Name*" patternnn="^[ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ A-Za-z]{2,50}$" oninvaliddd="this.setCustomValidity('Enter correct format last name')" required>
                                </div> 
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="child_book_date" name="child_dob[]" placeholder="Date Of Birth*" style="background:#ffffff;" oninvaliddd="this.setCustomValidity('Select your date of birth')" readonly required>
                                </div> 
                            </div>
                           <?php if (isset($flightDetails['ssr']['ssrHeap']['baggage'][0]['data']) && count($flightDetails['ssr']['ssrHeap']['baggage'][0]['data']) > 0) { ?>
                            <div class="col-md-3">
                                <select class="form-control fli_padleft0 fli_padright0" name="childBaggageOnward[]" >
                                    <option value="">Additional Onward Baggage</option>
                                    <option value=''>Not Required</option>
                                    <?php for ($d = 0; $d < count($flightDetails['ssr']['ssrHeap']['baggage'][0]['data']); $d++) { ?>
                                    <option value="<?php echo $flightDetails['ssr']['ssrHeap']['baggage'][0]['data'][$d]['code']; ?>"><?php echo $flightDetails['ssr']['ssrHeap']['baggage'][0]['data'][$d]['desc'] . ' - &nbsp;&nbsp;&#8369;' . $flightDetails['ssr']['ssrHeap']['baggage'][0]['data'][$d]['amount']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>


                         <?php if (isset($flightDetails['ssr']['ssrHeap']['baggage'][1]['data']) && count($flightDetails['ssr']['ssrHeap']['baggage'][1]['data']) > 0) { ?>
                            <div class="col-md-3">
                                <select class="form-control fli_padleft0 fli_padright0" name="childBaggageReturn[]" >
                                    <option value="">Additional Return Baggage</option>
                                    <option value=''>Not Required</option>
                                    <?php for ($d = 0; $d < count($flightDetails['ssr']['ssrHeap']['baggage'][1]['data']); $d++) { ?>
                                    <option value="<?php echo $flightDetails['ssr']['ssrHeap']['baggage'][1]['data'][$d]['code']; ?>"><?php echo $flightDetails['ssr']['ssrHeap']['baggage'][1]['data'][$d]['desc'] . ' - &nbsp;&nbsp;&#8369;' . $flightDetails['ssr']['ssrHeap']['baggage'][1]['data'][$d]['amount']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>



                         <?php if (isset($flightDetails['ssr']['ssrHeap']['meal'][0]['data']) && count($flightDetails['ssr']['ssrHeap']['meal'][0]['data']) > 0) { ?>
                            <div class="col-md-3">
                                <select class="form-control fli_padleft0 fli_padright0" name="childMealsOnward[]" >
                                    <option value="">Onward Meal</option>
                                    <option value=''>Not Required</option>
                                    <?php for ($d = 0; $d < count($flightDetails['ssr']['ssrHeap']['meal'][0]['data']); $d++) { ?>
                                    <option value="<?php echo $flightDetails['ssr']['ssrHeap']['meal'][0]['data'][$d]['code']; ?>"><?php echo $flightDetails['ssr']['ssrHeap']['meal'][0]['data'][$d]['desc'] . '- &nbsp;&nbsp;&#8369;' . $flightDetails['ssr']['ssrHeap']['meal'][0]['data'][$d]['amount']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>



                         <?php if (isset($flightDetails['ssr']['ssrHeap']['meal'][1]['data']) && count($flightDetails['ssr']['ssrHeap']['meal'][1]['data']) > 0) { ?>
                            <div class="col-md-3">
                                <select class="form-control fli_padleft0 fli_padright0" name="childMealsReturn[]" >
                                    <option value="">Return Meal</option>
                                    <option value=''>Not Required</option>
                                    <?php for ($d = 0; $d < count($flightDetails['ssr']['ssrHeap']['meal'][1]['data']); $d++) { ?>
                                    <option value="<?php echo $flightDetails['ssr']['ssrHeap']['meal'][1]['data'][$d]['code']; ?>"><?php echo $flightDetails['ssr']['ssrHeap']['meal'][1]['data'][$d]['desc'] . '- &nbsp;&nbsp;&#8369;' . $flightDetails['ssr']['ssrHeap']['meal'][1]['data'][$d]['amount']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>

                           
                        </div>
                        
                        <?php if (trim($searchData['fromCountry']) != trim($searchData['toCountry'])){ ?>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="child_passport_no[]" placeholder="Passport Number*" patternnn="^[0-9 A-Za-z]{5,50}$" oninvaliddd="this.setCustomValidity('Enter correct format passport no')" required>
                            </div>
                        </div>
                        <?php } ?>
                        <div style="clear:both;"></div>
                        <hr />
                        <?php } ?>
                        <?php } ?>
                        
                        <?php if ($searchData['infant'] > 0){ ?>
                        <?php for ($i = 0; $i < $searchData['infant']; $i++) { ?>
                        <div class="col-md-2">
                            <div class="col-md-12 fli_pad0">
                                <p class="fli_det_name" style="font-size: 13px;">Infant <?php echo ($i+1); ?>(below 2yrs)</p>
                            </div>
                        </div>
                        <div class="col-md-10 fli_pad0">
                            <div class="col-md-1 re_pad0">
                                <select class="form-control fli_padleft0 fli_padright0" name="infanttitle[]" required>
                                    <option value="4">Mstr</option>
                                    <option value="3">Miss</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="infantFname[]" placeholder="First Name*" patternnn="^[ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ A-Za-z]{2,50}$" oninvaliddd="this.setCustomValidity('Enter correct format first name')" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="infantLname[]" placeholder="Last Name*" patternnn="^[ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ A-Za-z]{2,50}$" oninvaliddd="this.setCustomValidity('Enter correct format last name')" required>
                                </div> 
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="infant_book_date" style="background:#ffffff;" name="infant_dob[]" placeholder="Date Of Birth*" readonly required>
                                </div> 
                            </div>


                            <?php if (isset($flightDetails['ssr']['ssrHeap']['baggage'][0]['data']) && count($flightDetails['ssr']['ssrHeap']['baggage'][0]['data']) > 0) { ?>
                            <div class="col-md-3">
                                <select class="form-control fli_padleft0 fli_padright0" name="infantBaggageOnward[]" >
                                    <option value="">Additional Onward Baggage</option>
                                    <option value=''>Not Required</option>
                                    <?php for ($d = 0; $d < count($flightDetails['ssr']['ssrHeap']['baggage'][0]['data']); $d++) { ?>
                                    <option value="<?php echo $flightDetails['ssr']['ssrHeap']['baggage'][0]['data'][$d]['code']; ?>"><?php echo $flightDetails['ssr']['ssrHeap']['baggage'][0]['data'][$d]['desc'] . ' - &nbsp;&nbsp;&#8369;' . $flightDetails['ssr']['ssrHeap']['baggage'][0]['data'][$d]['amount']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>


                          <?php if (isset($flightDetails['ssr']['ssrHeap']['baggage'][1]['data']) && count($flightDetails['ssr']['ssrHeap']['baggage'][1]['data']) > 0) { ?>
                            <div class="col-md-3">
                                <select class="form-control fli_padleft0 fli_padright0" name="infantBaggageReturn[]" >
                                    <option value="">Additional Return Baggage</option>
                                    <option value=''>Not Required</option>
                                    <?php for ($d = 0; $d < count($flightDetails['ssr']['ssrHeap']['baggage'][1]['data']); $d++) { ?>
                                    <option value="<?php echo $flightDetails['ssr']['ssrHeap']['baggage'][1]['data'][$d]['code']; ?>"><?php echo $flightDetails['ssr']['ssrHeap']['baggage'][1]['data'][$d]['desc'] . ' - &nbsp;&nbsp;&#8369;' . $flightDetails['ssr']['ssrHeap']['baggage'][1]['data'][$d]['amount']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>

                          
                            <?php if (trim($searchData['fromCountry']) != trim($searchData['toCountry'])){ ?>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="infant_passport_no[]" placeholder="Passport Number*" patternnn="^[0-9 A-Za-z]{5,50}$" oninvaliddd="this.setCustomValidity('Enter correct format passport no')" required>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div style="clear:both;"></div>
                        <hr />
                        <?php } ?>
                        <?php } ?>
                        
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
                                <input type="email" name='user_email' class="form-control" placeholder="Your e-ticket will be sent to this email" oninvaliddd="this.setCustomValidity('Enter correct format email id')" required>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="col-md-3">
                            <p class="fli_det_name">Mobile number<span style='color:#f74623'>*</span></p>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" name='mobile_code' required>
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
                                <input type="text" class="form-control" name='phone_number' placeholder="Mobile number" patternnn="[0-9]{10-12}" min="10" max="12" oninvaliddd="this.setCustomValidity('Enter correct format phone number')" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 fli_padright0" style="padding-bottom:10px;">
                        <?php if(isset($lowBalance) && $lowBalance == false){ ?>  <?php } ?>
                        <div class="custom-search pull-right">
                            <label>&nbsp;</label>
                            <input type="submit" name="" value="Continue Booking" class="btn fli_butt_book" style="color:#fff;background-color: #f74623;">
                        </div>
                       
                    </div>
                    </form>
                    
                    <?php } ?>
                </div>
                <?php if(isset($flightDetails) && $flightDetails != ''){ ?>
                <div class="col-md-3" style="margin-top:18px;">
                    <div class="col-md-12 fli_det_bor fli_pad0 pull-left" style=" padding-bottom: 10px !important; margin-bottom:10px; width:100%;">
                        <div class="col-md-12 fil_pad2012" style="padding: 11px 0px 11px 25px;">
                            <p class="pull-left fli_para" style=" padding-top:3px !important; padding-bottom:0px;">Fare details<span class="pull-right" style="font-size:12px;"><img alt="" src="<?php echo base_url(); ?>assets/images/img/flights/i.png" style="margin-right:5px;">Fare rules</span></p>
                        </div>
                        <?php  if($searchData['sr_ctzn'] == 'true'){ ?>
                        <div class="col-md-12">
                            <h4 class="fli_clr_de">Traveler(Senior Citizen)<span style="font-size:10px; padding-left:10px;"><a href="#">REQ SENIOR_CITIZEN_PROOF *</a></span></h4>
                        </div>
                       
                        <?php } else { ?>
                        <div class="col-md-12">
                            <h4 class="fli_clr_de">Traveler(Adult)<span style="font-size:10px; padding-left:10px;"><a href="#">View Breakup</a></span></h4>
                        </div>
                        <?php
                            foreach($flightDetails['fare']['paxFares']['adt'] as $key => $value){
                            
                                if($key != ''){  if($key == 'base'){  $markup=($_SESSION[session_id()]['agent_markup']+$_SESSION[session_id()]['admin_markup']);}else{ $markup=0; } ?>
                                    <div class="col-md-12">
                                        <div class="col-md-6 fli_pad_bot2 fli_padleft0"><?php echo ucfirst($key); ?></div>
                                        <div class="col-md-6 pull-right fli_pad_bot2 fli_padright0" style="text-align:right;" >&#8369; <?php echo number_format((($value['amount'] *$adult)+$markup),2,'.',','); ?></div>
                                    </div>
                                    <?php 
                                }
                                
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
                            foreach($flightDetails['fare']['paxFares']['chd'] as $keyc => $valuec){
                                
                                if($keyc != ''){
                        ?>
                                <div class="col-md-12">
                                    <div class="col-md-6 fli_pad_bot2 fli_padleft0"><?php echo ucfirst($keyc); ?></div>
                                    <div class="col-md-6 pull-right fli_pad_bot2 fli_padright0" style="text-align:right;" >&#8369; <?php echo number_format(($valuec['amount']*$child),2,'.',','); ?></div>
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
                            foreach($flightDetails['fare']['paxFares']['inf'] as $keyIn => $valueIn){
                                if($keyIn != ''){
                        ?>
                                <div class="col-md-12">
                                    <div class="col-md-6 fli_pad_bot2 fli_padleft0"><?php echo ucfirst($keyIn); ?></div>
                                    <div class="col-md-6 pull-right fli_pad_bot2 fli_padright0" style="text-align:right;" >&#8369; <?php echo number_format(($valueIn['amount']*$infant),2,'.',','); ?></div>
                                </div>
                        <?php
                                    }
                                }
                            }
                        ?>
                        <div class="col-md-12" style="padding-top:15px;">
                            <div class="col-md-6 fli_padleft0">
                                <h4 class="fli_clr_de">Extra Baggage</h4>
                            </div>
                            <div class="col-md-6 fli_padright0">
                                <h4 class="pull-right fli_clr_de">&#8369; <span id="ex_bag_cost">0.00</span></h4>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding-top:15px;">
                            <div class="col-md-6 fli_padleft0">
                                <h4 class="fli_clr_de">Fare total</h4>
                            </div>
                             <?php 
                            $markup=($_SESSION[session_id()]['agent_markup']+$_SESSION[session_id()]['admin_markup']);
                            ?>
                            <div class="col-md-6 fli_padright0">
                                <h4 class="pull-right fli_clr_de">&#8369; <span id="tot_cost"><?php echo number_format(($flightDetails['fare']['totalFare']['total']['amount']+$markup),2,'.',','); ?></span></h4>
                                
                                <input type="hidden" id="fl_tot" name="fl_tot" value="<?php echo $flightDetails['fare']['totalFare']['total']['amount']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 fli_det_bor pull-left" style="margin-top: 10px; padding:0px; width:100%;">
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
        <!--######################### FOOTER STARTS HERE #################################################################-->
        <?php $this->load->view('footer'); ?>
        <!--######################### FOOTER ENDS HERE #################################################################-->
        <!--##### FARE RULE, TERMS, BAGGAGE POPUP WINDOW STARTS HERE ###############################-->
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
                                 <?php if(isset($searchData['sr_ctznn']) && $searchData['sr_ctznn'] == 'true'){ ?>
                                <table class="table">
                                    <tr>
                                        <td style="font-weight: bold;">Single Senior Citizen Fare Breakup :</td>
                                    </tr>
                                </table>
                                <table class="table table-bordered">
                                    <tbody>
                                    <?php
                                    for ($i = 0; $i < count($flightDetails['fare']); $i++) {
                                        if ($flightDetails['fare'][$i]['type'] == 'SingleSeniorCitizen') {
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
                                <?php } else { ?>
                                <table class="table">
                                    <tr>
                                        <td style="font-weight: bold;">Single Adult Fare Breakup :</td>
                                    </tr>
                                </table>
                                <table class="table table-bordered">
                                    <tbody>
                                    <?php
                                   foreach ($flightDetails['fare']['paxFares']['adt'] as $key => $value) {?>
                                          <tr>
                                                <?php
                                                if ($key=='total') {
                                                       if($key == 'total'){  $markup=($_SESSION[session_id()]['agent_markup']+$_SESSION[session_id()]['admin_markup']);}else{ $markup=0; } 
                                                    ?>
                                                    <td style="font-weight:bold;">Total Amount</td>
                                                    <td style="font-weight:bold;">PHP <?php echo (($value['amount']*$adult)+$markup); ?></td>
                                                    <?php
                                                } else {
                                                     $showPrice = ($value['amount']);
                                                    ?>
                                                    <td><?php echo ucfirst($key); ?></td>
                                                    <td>PHP <?php echo $showPrice; ?></td>
                                                    <?php
                                                }
                                                ?>
                                            </tr>
                                            <?php
                                        }
                                    
                                    ?>
                                    </tbody>
                                </table>
                                <?php } ?>
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
                                      foreach ($flightDetails['fare']['paxFares']['chd'] as $key => $value) {
                                       
                                            ?>
                                            
                                            <tr>
                                                <?php
                                                if ($key=='total') {
                                                    ?>
                                                    <td style="font-weight:bold;">Total Amount</td>
                                                    <td style="font-weight:bold;">PHP <?php echo ($value['amount']*$adult); ?></td>
                                                    <?php
                                                } else {
                                                   
                                                        $showPrice = ($value['amount']);
                                                    ?>
                                                      <td><?php echo ucfirst($key); ?></td>
                                                    <td>PHP <?php echo $showPrice; ?></td>
                                                    <?php
                                                }
                                                ?>
                                            </tr>
                                            <?php
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
                                   
                                        foreach ($flightDetails['fare']['paxFares']['inf'] as $key => $value) {
                                            ?>
                                            
                                            <tr>
                                                <?php
                                               if ($key=='total') {
                                                    ?>
                                                    <td style="font-weight:bold;">Total Amount</td>
                                                    <td style="font-weight:bold;">PHP <?php echo ($value['amount']*$infant); ?></td>
                                                    <?php
                                                } else {
                                                   
                                                        $showPrice = ($value['amount']);
                                                    ?>
                                                      <td><?php echo ucfirst($key); ?></td>
                                                    <td>PHP <?php echo $showPrice; ?></td>
                                                    <?php
                                                }
                                                ?>
                                            </tr>
                                            <?php
                                        }
                                    
                                    ?>
                                        </tbody>
                                    </table>
                                    <?php
                                }
                                ?>
                        </div>
                    </div>
                    <div class="modal-footer" style="border:0px;"></div>
                </div>

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
                              

                             <?php foreach ($flightDetails['flights'] as $flight) { 
                                echo "<p>".$flight['depDetail']['name']." - ".$flight['arrDetail']['name']."</p>";
                             show_keys($flight['amenities']);

                             } 
                               if (isset($flightDetails['ssr']['ssrHeap']['baggage'][0]['data']) && count($flightDetails['ssr']['ssrHeap']['baggage'][0]['data']) > 0) {
                                        ?>
                                    <table class="table">
                                        <tr>
                                            <td style="font-weight: bold;"> Baggage price Breakup :</td>
                                        </tr>
                                    </table>
                                <table class="table table-bordered">
                                    <tbody>
                                   
                                  
                                        <thead>
                                        <tr>
                                            <th>Weight ( Kg )</th>
                                            <th>Cost</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        for ($i = 0; $i < count($flightDetails['ssr']['ssrHeap']['baggage'][0]['data']); $i++) {
                                            ?>
                                            <tr>
                                                <td style="padding: 5px;"><?php echo $flightDetails['ssr']['ssrHeap']['baggage'][0]['data'][$i]['desc']; ?></td>
                                                <td>PHP <?php echo $flightDetails['ssr']['ssrHeap']['baggage'][0]['data'][$i]['amount']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                      
                                    </tbody>
                                </table>
                                  <?php
                                    }

                                    if (isset($flightDetails['ssr']['ssrHeap']['baggage'][1]['data']) && count($flightDetails['ssr']['ssrHeap']['baggage'][1]['data']) > 0) {
                                        ?>
                                    <table class="table">
                                        <tr>
                                            <td style="font-weight: bold;">Return Baggage price Breakup :</td>
                                        </tr>
                                    </table>
                                <table class="table table-bordered">
                                    <tbody>
                                   
                                  
                                        <thead>
                                        <tr>
                                            <th>Weight ( Kg )</th>
                                            <th>Cost</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        for ($i = 0; $i < count($flightDetails['ssr']['ssrHeap']['baggage'][1]['data']); $i++) {
                                            ?>
                                            <tr>
                                                <td style="padding: 5px;"><?php echo $flightDetails['ssr']['ssrHeap']['baggage'][1]['data'][$i]['desc']; ?></td>
                                                <td>PHP <?php echo $flightDetails['ssr']['ssrHeap']['baggage'][1]['data'][$i]['amount']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                      
                                    </tbody>
                                </table>
                                  <?php
                                    } 




                                    if (isset($flightDetails['ssr']['ssrHeap']['meal'][0]['data']) && count($flightDetails['ssr']['ssrHeap']['meal'][0]['data']) > 0) {
                                    ?>
                                 <table class="table">
                                        <tr>
                                            <td style="font-weight: bold;">Meals price Breakup :</td>
                                        </tr>
                                    </table>
                                <table class="table table-bordered">
                                    <tbody>
                                    <?php
                                   
                                        ?>
                                        <thead>
                                        <tr>
                                            <th>Meals</th>
                                            <th>Cost</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        for ($i = 0; $i < count($flightDetails['ssr']['ssrHeap']['meal'][0]['data']); $i++) {
                                            ?>
                                            <tr>
                                                <td style="padding: 5px;"><?php echo $flightDetails['ssr']['ssrHeap']['meal'][0]['data'][$i]['desc']; ?></td>
                                                <td>PHP <?php echo $flightDetails['ssr']['ssrHeap']['meal'][0]['data'][$i]['amount']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                     
                                    </tbody>
                                </table>
                                   <?php
                                    }

                                    if (isset($flightDetails['ssr']['ssrHeap']['meal'][1]['data']) && count($flightDetails['ssr']['ssrHeap']['meal'][1]['data']) > 0) {
                                    ?>
                                 <table class="table">
                                        <tr>
                                            <td style="font-weight: bold;"> Return Meals price Breakup :</td>
                                        </tr>
                                    </table>
                                <table class="table table-bordered">
                                    <tbody>
                                    <?php
                                   
                                        ?>
                                        <thead>
                                        <tr>
                                            <th>Meals</th>
                                            <th>Cost</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        for ($i = 0; $i < count($flightDetails['ssr']['ssrHeap']['meal'][1]['data']); $i++) {
                                            ?>
                                            <tr>
                                                <td style="padding: 5px;"><?php echo $flightDetails['ssr']['ssrHeap']['meal'][1]['data'][$i]['desc']; ?></td>
                                                <td>PHP <?php echo $flightDetails['ssr']['ssrHeap']['meal'][1]['data'][$i]['amount']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                     
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
                                  <?php 

                                if(isset($flightDetails['cndtns']) && !empty($flightDetails['cndtns'])){
                                   $cndtnsarray= $flightDetails['cndtns'];
                       unset($cndtnsarray['sessionTime']);unset($cndtnsarray['name']);unset($cndtnsarray['block']);#unset($cndtnsarray['showNTA']);unset($cndtnsarray['showInc']);
show_keys($cndtnsarray);
                                }

                                if(isset($flightDetails['extraServices']) && !empty($flightDetails['extraServices'])){
show_keys($flightDetails['extraServices']);
                                }
                               /* echo '<pre>';
        print_r($flightDetails['extraServices']);
        echo  '</pre>';*/
        

      
                                ?>
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
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/common.js"></script>
    <!--################### JS FILES ENDS ################################################-->
    <script type="text/javascript">
        $(function() {
        var adultenddate = moment().subtract(12.1, "years").format("YYYY-MM-DD");
        var adultstartdate = moment().subtract(110, "years").format("YYYY-MM-DD");
        var childenddate = moment().subtract(2, "years").format("YYYY-MM-DD");
        var childstartdate = moment().subtract(12, "years").format("YYYY-MM-DD");
        var infantenddate = moment().subtract(1, 'day').format("YYYY-MM-DD");
        var infantstartdate = moment().subtract(1.9, "years").format("YYYY-MM-DD");
        $( "#child_book_date" ).datepicker({
            changeMonth: true,
            changeYear: true,
            minDate:childstartdate, //assigning startdate
            maxDate:childenddate,
            numberOfMonths: 1,
            dateFormat: 'dd-mm-yy',
            inline: true
			
        });
        $( ".adult_book_date" ).datepicker({
            changeMonth: true,
            changeYear: true,
            minDate:adultstartdate, //assigning startdate
            maxDate:adultenddate,
            numberOfMonths: 1,
            dateFormat: 'dd-mm-yy',
            inline: true
			
        });
        $( "#infant_book_date" ).datepicker({
            changeMonth: true,
            changeYear: true,
            minDate:infantstartdate, //assigning startdate
            maxDate:infantenddate,
            numberOfMonths: 1,
            dateFormat: 'dd-mm-yy',
            inline: true
			
        });
        
});
    </script>
</html>	