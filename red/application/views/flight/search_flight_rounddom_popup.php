<?php 
    if(isset($flight) && $flight != ''){
         $StartLeg = reset($flight['flights']);
    $endLeg = end($flight['flights']);
     $depDetails = explode(' ', $StartLeg['depDetail']['time']);

    $arvDetails = explode(' ', $endLeg['arrDetail']['time']);
        
        $duration = explode(':', gmdate("H:i", ($flight['journeyInfo'][0]['journeyTime']* 60)));
    $durHour = $duration[0];
    $durMin = $duration[1];
    $totalDur = $flight['journeyInfo'][0]['journeyTime'];
?>

        <div class="rs_flight_details" style="display: block;">
    <div class="rs_flight_details__header">
        <div class="rs_flight_details__time rs_text_bold">Flight Time : <?php echo $durHour . ' Hrs ' . $durMin . ' Mins'; ?></div>
        <span class="rs_text_bold">Departing Flight : <?php echo date('D, M d, Y', strtotime($depDetails[0])); ?></span> (Arrive - <?php echo date('D, M d, Y', strtotime($arvDetails[0])); ?>)
        <div class="rs_flight_details__highlightBar rs_highlight--red">
            <span class="rs_vertical_middle" style="font-size:14px;">Flight arrives on the <?php echo($depDetails[0] != $arvDetails[0] ? 'next' : 'same'); ?> day.</span>
        </div>
    </div>
        <?php
        $j = 0;
        foreach ($flight['flights'] as $stops) {
             $depCity = $stops['depDetail']['name'] . ', ' . $stops['depDetail']['city'];
        $arvCity = $stops['arrDetail']['name'] . ', ' . $stops['arrDetail']['city'];
      

        $depDateTim = explode(' ', $stops['depDetail']['time']);
        $arvDateTim = explode(' ', $stops['arrDetail']['time']);
        $depDate = $depDateTim[0];
        $chunks = substr($depDateTim[1], 0,-4);
        $result =$chunks;
       # $depTime = explode(':', $result);
        $arvDate = $arvDateTim[0];
        $chunks1 = substr($arvDateTim[1], 0,-4);
       $result1 = $chunks1;
       # $arvTime = explode(':', $result1);
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
            <div class="rs_flight_details__leg__left"><img src="<?php echo base_url(); ?>assets/images/airlines/<?php echo $stops['carrier']['code']; ?>_small.gif"></div>
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
                <div class="rs_text_lighter"><?php echo $airlieName; ?> - Flight  <?php echo $stops['carrier']['code']; ?>-<?php echo $stops['flightNo']; ?>, <?php echo 'Economy'; //$stops['Class'];   ?></div>
            </div></div>
            <?php
            if (count($flight['flights']) > 1 && $j < count($flight['flights']) - 1) {
                ###############################Duration Calculation##################################################
                $date3 = new DateTime($arvDateTim[0] . ' ' . $result1);
            $depDateTim3 = explode(' ', $flight['flights'][$j + 1]['depDetail']['time']);
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
<?php
    }