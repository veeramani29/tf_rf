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
$datedepStructDep = explode('.', $indepDetails);
$dateOriDep = explode(' ', $datedepStructDep[0]);
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
                $OutdepDetails = $OutstartLeg['depDetail']['time'];
                $Outdepdate = explode('.', $OutdepDetails);
                $OutdepdateArr = explode(' ', $Outdepdate[0]);
                $OutdepdateHM = explode(':', $OutdepdateArr[1]);
                $OutdepTime = $OutdepdateHM[0].":".$OutdepdateHM[1];


                $OutendLeg = end($segments_return);
                $outArvDetails = $OutendLeg['arrDetail']['time'];
                $outArvdate = explode('.', $outArvDetails);
                $outArvStructArr = explode(' ', $outArvdate[0]);
                $OutArrHM = explode(':', $outArvStructArr[1]);
                $OutarvTime = $OutArrHM[0].":".$OutArrHM[1];

   

    $outduration = explode(':', gmdate("H:i", ($flight['journeyInfo'][1]['journeyTime']* 60)));
    $outdurHour = $outduration[0];
    $outdurMin = $outduration[1];
    $outtotalDur = $flight['journeyInfo'][0]['journeyTime'];

   
?>
<div class="rs_flight_details" style="display: block;">
    <div class="rs_flight_details__header">
        <div style="float:left;font-weight:bold">Onward Flight</div>
        <div style="clear:both"></div><hr />
        <div class="rs_flight_details__time rs_text_bold">Flight Time : <?php echo $indurHour . ' Hrs ' . $indurMin . ' Mins'; ?></div>
        <span class="rs_text_bold">Departing Flight : <?php echo date('D, M d, Y', strtotime($dateOriDep[0])); ?></span> (Arrive - <?php echo date('D, M d, Y', strtotime($dateDestArr[0])); ?>)
        <div class="rs_flight_details__highlightBar rs_highlight--red">
            <span class="rs_vertical_middle" style="font-size:14px;">Flight arrives on the <?php echo($dateOriDep[0] != $dateDestArr[0] ? 'next' : 'same'); ?> day.</span>
        </div></div>

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
        <div class="rs_flight_details__leg">
            <div class="rs_flight_details__time" >
                <div class="glyphicon glyphicon-time" aria-hidden="true" style="padding-top: 2px;padding-right:2px;"></div>
                <div class="rs_vertical_middle" style="float:right;"><?php echo $duration; ?></div>
            </div>
            <div class="rs_flight_details__leg__left"><img src="<?php echo base_url(); ?>assets/images/airline_logo/<?php echo $stops['carrier']['code']; ?>.gif"></div>
            <div class="rs_flight_details__leg__right">
                <table class="rs_air_leg_table">
                    <tbody>
                        <tr>
                            <td>Departs :</td><td><?php echo $time_in_12_hour_format_dep; ?></td>
                            <td><?php echo date('M d', strtotime($depDate)); ?></td>
                            <td><?php echo $depCity; ?></td>
                            <td><?php echo $stops['depDetail']['code']; ?></td>
                        </tr>
                        <tr>
                            <td>Arrives :</td>
                            <td><?php echo $time_in_12_hour_format_arv; ?></td>
                            <td><?php echo date('M d', strtotime($arvDate)); ?></td>
                            <td><?php echo $arvCity; ?></td>
                            <td><?php echo $stops['arrDetail']['code']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="rs_text_lighter"><?php echo $airlieName; ?> - Flight  <?php echo $stops['carrier']['code']; ?>-<?php echo $stops['flightNo']; ?>, <?php echo 'Economy'; //$stops['Class'];  ?></div>

            </div></div>


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
            <div class="rs_flight_details__highlightBar rs_highlight--red" style="margin-bottom:20px;">
                <span class="rs_vertical_middle" style="font-size:14px;">Connection flight at <?php echo $arvCity; ?> ( <?php echo $stops['arrDetail']['name']; ?> )&nbsp;&nbsp;Layover Time : <?php echo $layover; ?></span>
            </div>
        <?php
    }
    $j++;
}
?>
</div>

<div class="rs_flight_details" style="display: block;">
    <div class="rs_flight_details__header">
        <div style="float:left;font-weight:bold">Return Flight</div>
        <div style="clear:both"></div><hr />
        <div class="rs_flight_details__time rs_text_bold">Flight Time : <?php echo $outdurHour . ' Hrs ' . $outdurMin . ' Mins'; ?></div>
        <span class="rs_text_bold">Departing Flight : <?php echo date('D, M d, Y', strtotime($OutdepdateArr[0])); ?></span> (Arrive - <?php echo date('D, M d, Y', strtotime($outArvStructArr[0])); ?>)
        <div class="rs_flight_details__highlightBar rs_highlight--red">
            <span class="rs_vertical_middle" style="font-size:14px;">Flight arrives on the <?php echo($OutdepdateArr[0] != $outArvStructArr[0] ? 'next' : 'same'); ?> day.</span>
        </div></div>

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
        <div class="rs_flight_details__leg">
            <div class="rs_flight_details__time" >
                <div class="glyphicon glyphicon-time" aria-hidden="true" style="padding-top: 2px;padding-right:2px;"></div>
                <div class="rs_vertical_middle" style="float:right;"><?php echo $duration; ?></div>
            </div>
            <div class="rs_flight_details__leg__left"><img src="<?php echo base_url(); ?>assets/images/airline_logo/<?php echo $stops['carrier']['code']; ?>.gif"></div>
            <div class="rs_flight_details__leg__right">
                <table class="rs_air_leg_table">
                    <tbody>
                        <tr>
                            <td>Departs :</td><td><?php echo $time_in_12_hour_format_dep; ?></td>
                            <td><?php echo date('M d', strtotime($depDate)); ?></td>
                            <td><?php echo $depCity; ?></td>
                            <td><?php echo $stops['depDetail']['code']; ?></td>
                        </tr>
                        <tr>
                            <td>Arrives :</td>
                            <td><?php echo $time_in_12_hour_format_arv; ?></td>
                            <td><?php echo date('M d', strtotime($arvDate)); ?></td>
                            <td><?php echo $arvCity; ?></td>
                            <td><?php echo $stops['arrDetail']['code']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="rs_text_lighter"><?php echo $airlieName; ?> - Flight  <?php echo $stops['carrier']['code']; ?>-<?php echo $stops['flightNo']; ?>, <?php echo 'Economy'; //$stops['Class'];  ?></div>

            </div></div>


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
            <div class="rs_flight_details__highlightBar rs_highlight--red" style="margin-bottom:20px;">
                <span class="rs_vertical_middle" style="font-size:14px;">Connection flight at <?php echo $arvCity; ?> ( <?php echo $stops['arrDetail']['name']; ?> )&nbsp;&nbsp;Layover Time : <?php echo $layover; ?></span>
            </div>
        <?php
    }
    $j++;
}
?>
</div>