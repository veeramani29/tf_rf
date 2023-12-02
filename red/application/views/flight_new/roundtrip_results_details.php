<?php 


$segments_onward=array_filter($flight['flights'], function($k) {
                if(!isset($k['isReturn'])){ return true; }else{
                return false; }
});
$segments_return=array_filter($flight['flights'], function($k) {
                return (isset($k['isReturn']) && $k['isReturn']== 1);
            });
$segments_return=array_values($segments_return);
#echo "<pre>";print_r(array_values($segments_return));die;
$instartLeg = reset($segments_onward);
$indepDetails = $instartLeg['depDetail']['time'];
$datedepStrucspanep = explode('.', $indepDetails);
$dateOriDep = explode(' ', $datedepStrucspanep[0]);
$dateOriDepHM = explode(':', $dateOriDep[1]);
$indepTime = $dateOriDepHM[0].":".$dateOriDepHM[1];

$inendLeg = end($segments_onward);
$inarvDetails = $inendLeg['arrDetail']['time'];
$dateStructArr = explode('.', $inarvDetails);
$dateDestArr = explode(' ', $dateStructArr[0]);
$dateArrHM = explode(':', $dateDestArr[1]);
$inarvTime = $dateArrHM[0].":".$dateArrHM[1];

    $induration = explode(':', gmdate("H:i", ($flight['journeyInfo'][0]['journeyTime']* 60)));
    $indurHour = $induration[0];
    $indurMin = $induration[1];
    $intotalDur = $flight['journeyInfo'][0]['journeyTime'];

    ############################ Return Flight #################################

                $OutstartLeg = reset($segments_return);
                $OuspanepDetails = $OutstartLeg['depDetail']['time'];
                $Ouspanepdate = explode('.', $OuspanepDetails);
                $OuspanepdateArr = explode(' ', $Ouspanepdate[0]);
                $OuspanepdateHM = explode(':', $OuspanepdateArr[1]);
                $OuspanepTime = $OuspanepdateHM[0].":".$OuspanepdateHM[1];


                $OutendLeg = end($segments_return);
                $outArvDetails = $OutendLeg['arrDetail']['time'];
                $outArvdate = explode('.', $outArvDetails);
                $outArvStructArr = explode(' ', $outArvdate[0]);
                $OutArrHM = explode(':', $outArvStructArr[1]);
                $OutarvTime = $OutArrHM[0].":".$OutArrHM[1];

   

    $ouspanuration = explode(':', gmdate("H:i", ($flight['journeyInfo'][1]['journeyTime']* 60)));
    $ouspanurHour = $ouspanuration[0];
    $ouspanurMin = $ouspanuration[1];
    $outtotalDur = $flight['journeyInfo'][0]['journeyTime'];

   
?>
<div class="clearfix row">
<div class="col-md-6">
    <div class="fblueline fselect">
        <div>Onward Flight <span class="pull-right"><i class="glyphicon glyphicon-time" aria-hidden="true"></i> <?php echo $indurHour . ' Hrs ' . $indurMin . ' Mins'; ?></span></div>
        <div style="clear:both"></div><hr />

        <b>Flight Time : </b>
        <span class="rs_text_bold">Departing Flight : <?php echo date('D, M d, Y', strtotime($dateOriDep[0])); ?></span> (Arrive - <?php echo date('D, M d, Y', strtotime($dateDestArr[0])); ?>)
        <b>
            <span class="rs_vertical_middle" style="font-size:14px;">Flight arrives on the <?php echo($dateOriDep[0] != $dateDestArr[0] ? 'next' : 'same'); ?> day.</span>
        </b>
    </div>
    <div class="clearfix flightRdDetails">

    <?php
    $j = 0;
    foreach ($segments_onward as $stops) {
         $depCity = $stops['depDetail']['name'] . ', ' . $stops['depDetail']['city'];
        $arvCity = $stops['arrDetail']['name'] . ', ' . $stops['arrDetail']['city'];
        //print_r($depArvAirport);die;


        $depDateTim = explode(' ', $stops['depDetail']['time']);
        $arvDateTim = explode(' ', $stops['arrDetail']['time']);
         $depDate = $depDateTim[0];
         $chunks = substr($depDateTim[1], 0,-4);
        $result =$chunks;

        #$depTime = explode(':', $result[1]);
        $arvDate = $arvDateTim[0];
        $chunks1 = substr($arvDateTim[1], 0,-4);
        $result1 = $chunks1;
        #$arvTime = explode(':', $result1);
        $time_in_12_hour_format_dep = date("g:i a", strtotime($result));
        $time_in_12_hour_format_arv = date("g:i a", strtotime($result1));

        $airlieName = $stops['carrier']['name'];
        ###############################Duration Calculation##################################################
      
        $date1 = new DateTime($depDate.' '.$result);
        $date2 = new DateTime($arvDate.' '.$result1);
        $diff = $date2->diff($date1);
        $duration = $diff->format('%hH, %iM'); //die;
        ###############################Duration Calculation##################################################
        ?>
            <ul class="list-group">
              <li class="list-group-item">
                <img src="<?php echo base_url(); ?>assets/images/airline_logo/<?php echo $stops['carrier']['code']; ?>.gif">
              </li>
              <li class="list-group-item">
                <div class="clearfix">
                    <span><?php echo $time_in_12_hour_format_dep; ?></span>
                    <span><?php echo date('M d', strtotime($depDate)); ?></span>                        
                </div>
                <div class="clearfix">
                    <span><?php echo $depCity; ?></span>
                    <span><?php echo $stops['depDetail']['code']; ?></span>                       
                </div>
              </li>
              <li class="list-group-item">
                <div class="clearfix">
                    <span><?php echo $time_in_12_hour_format_arv; ?></span>
                    <span><?php echo date('M d', strtotime($arvDate)); ?></span>                            
                </div> 
                <div class="clearfix">
                    <span><?php echo $arvCity; ?></span>
                    <span><?php echo $stops['arrDetail']['code']; ?></span>                            
                </div>
              </li>
              <li class="list-group-item">
                <?php echo $airlieName; ?> - Flight  <?php echo $stops['carrier']['code']; ?>-<?php echo $stops['flightNo']; ?>, <?php echo 'Economy'; //$stops['Class'];   ?>
              </li>
            
        
        <?php
        if (count($segments_onward) > 1 && $j < (count($segments_onward) - 1)) {
            ###############################Duration Calculation##################################################

           $date3 = new DateTime($arvDate . ' ' . $result1);
            $depDateTim3 = explode(' ', $segments_onward[$j + 1]['depDetail']['time']);
            $chunks2 = substr($depDateTim3[1], 0,-4);
            $result2 =$chunks2;
            $date4 = new DateTime($depDateTim3[0].' '.$result2);
            $diff1 = $date4->diff($date3);
            $layover = $diff1->format('%h Hour, %i minutes'); //die;
            ###############################Duration Calculation##################################################
            ?>
            <li class="list-group-item">
                <span class="rs_vertical_middle">
                    <label for="">Connection flight at</label><br>
                    <?php echo $arvCity; ?> ( <?php echo $stops['arrDetail']['name']; ?> )
                    &nbsp;&nbsp;<br>Layover Time : <?php echo $layover; ?>
                </span>
            </li>
            </ul>
        <?php
    }
    $j++;
}
?>
</div>
</div>
<div class="col-md-6">
    <div class="fblueline fselect">
        <div>Return Flight <span class="pull-right"><i class="glyphicon glyphicon-time" aria-hidden="true"></i> <?php echo $ouspanurHour . ' Hrs ' . $ouspanurMin . ' Mins'; ?></span></div>
        <div style="clear:both"></div><hr />
        <b>Flight Time : </b>
        <span class="rs_text_bold">Departing Flight : <?php echo date('D, M d, Y', strtotime($OuspanepdateArr[0])); ?></span> (Arrive - <?php echo date('D, M d, Y', strtotime($outArvStructArr[0])); ?>)
        <b>
            <span class="rs_vertical_middle" style="font-size:14px;">Flight arrives on the <?php echo($OuspanepdateArr[0] != $outArvStructArr[0] ? 'next' : 'same'); ?> day.</span>
        </b>
    </div>
    <div class="clearfix flightRdDetails">
    <?php
    $j = 0;
    foreach ($segments_return as $stops) {
        $depCity = $stops['depDetail']['name'] . ', ' . $stops['depDetail']['city'];
        $arvCity = $stops['arrDetail']['name'] . ', ' . $stops['arrDetail']['city'];
        //print_r($depArvAirport);die;

        $depDateTim = explode(' ', $stops['depDetail']['time']);
        $arvDateTim = explode(' ', $stops['arrDetail']['time']);
        $depDate = $depDateTim[0];
        $chunks = substr($depDateTim[1], 0,-4);
        $result =$chunks;

        #$depTime = explode(':', $result[1]);
        $arvDate = $arvDateTim[0];
        $chunks1 = substr($arvDateTim[1], 0,-4);
       $result1 = $chunks1;
        #$arvTime = explode(':', $result1);
        $time_in_12_hour_format_dep = date("g:i a", strtotime($result));
        $time_in_12_hour_format_arv = date("g:i a", strtotime($result1));

        $airlieName = $stops['carrier']['name'];
        ###############################Duration Calculation##################################################
        $date1 = new DateTime($stops['depDetail']['time']);
        $date2 = new DateTime($stops['arrDetail']['time']);
        $diff = $date2->diff($date1);
        $duration = $diff->format('%hH, %iM'); //die;
        ###############################Duration Calculation##################################################
        ?>
        <!--div class="rs_flight_details__time" >
            <div class="glyphicon glyphicon-time" aria-hidden="true" style="padding-top: 2px;padding-right:2px;"></div>
            <div class="rs_vertical_middle" style="float:right;"><?php echo $duration; ?></div>
        </div-->
        <ul class="list-group">
            <li class="list-group-item">
                  <img src="<?php echo base_url(); ?>assets/images/airline_logo/<?php echo $stops['carrier']['code']; ?>.gif">
            </li>
            <li class="list-group-item">
                <span><?php echo $time_in_12_hour_format_dep; ?></span>
                <span><?php echo date('M d', strtotime($depDate)); ?></span>
                <span><?php echo $depCity; ?></span>
                <span><?php echo $stops['depDetail']['code']; ?></span>
            </li>
            <li class="list-group-item">
                <span><?php echo $time_in_12_hour_format_arv; ?></span>
                <span><?php echo date('M d', strtotime($arvDate)); ?></span>
                <span><?php echo $arvCity; ?></span>
                <span><?php echo $stops['arrDetail']['code']; ?></span>
            </li>
            <li class="list-group-item">
                <?php echo $airlieName; ?> - Flight  <?php echo $stops['carrier']['code']; ?>-<?php echo $stops['flightNo']; ?>, <?php echo 'Economy'; //$stops['Class'];  ?>
            </li>
        


        <?php
        if (count($segments_return) > 1 && $j < (count($segments_return) - 1)) {
            ###############################Duration Calculation##################################################
          
            $date3 = new DateTime($arvDate . ' ' . $result1);
            $depDateTim3 = explode(' ', $segments_return[$j+1]['depDetail']['time']);
            $chunks2 = substr($depDateTim3[1], 0,-4);
            $result2 =$chunks2;
            $date4 = new DateTime($depDateTim3[0].' '.$result2);
            $diff1 = $date4->diff($date3);
            $layover = $diff1->format('%h Hour, %i minutes'); //die;
            ###############################Duration Calculation##################################################
            ?>
            <li class="list-group-item">
                <label for="">Connection flight at </label><br>
                <?php echo $arvCity; ?> ( <?php echo $stops['arrDetail']['name']; ?> )
                <br>Layover Time : <?php echo $layover; ?>
            </li>
            </ul>
        <?php
    }
    $j++;
}
?>
</div>
</div>
</div>