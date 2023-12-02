
<?php 
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
    <div class="fblueline fselect">
      <b class="rs_text_bold">Departing Flight :</b> 
      <span><?php echo date('D, M d, Y', strtotime($depDetails[0])); ?> (Arrive - <?php echo date('D, M d, Y', strtotime($arvDetails[0])); ?>)</span>
      <span class="rs_vertical_middle text-right" >Flight arrives on the <?php echo($depDetails[0] != $arvDetails[0] ? 'next' : 'same'); ?> day. &nbsp;
      <i class="glyphicon glyphicon-time"></i> &nbsp;<?php echo $duration; ?></span>
    </div>
    <?php
    $j = 0;
    foreach ($flight['flights'] as $stops) {
     //  print_r($stops);
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
       
            
             <ul class="flightstable mt20">
            <li class="ft1"><img src="<?php echo base_url(); ?>assets/images/airlines/<?php echo $stops['carrier']['code']; ?>_small.gif"></li>
           
              
                       <li class="ft2">
                                    
                            <span><?php echo $time_in_12_hour_format_dep; ?></span>
                            <span><?php echo date('M d', strtotime($depDate)); ?></span>
                            <span><?php echo $depCity; ?></span>
                            <span><?php echo $stops['depDetail']['code']; ?></span>
                            </li>
                        <li class="ft3">
                                    
                          
                            <span><?php echo $time_in_12_hour_format_arv; ?></span>
                            <span><?php echo date('M d', strtotime($arvDate)); ?></span>
                            <span><?php echo $arvCity; ?></span>
                            <span><?php echo $stops['arrDetail']['code']; ?></span>
                        </li>
                  
                <li class="ft4"><?php echo $airlieName; ?> - Flight  <?php echo $stops['carrier']['code']; ?>-<?php echo $stops['flightNo']; ?>, <?php echo 'Economy'; //$stops['Class'];   ?></li>

          </ul>


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