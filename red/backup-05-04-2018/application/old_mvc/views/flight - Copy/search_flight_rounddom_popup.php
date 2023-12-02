<?php 
    if(isset($flight) && $flight != ''){
        $endLeg = end($flight['legs']);
        $depDetails = explode('T',$flight['legs'][0]['DepartureTimeStamp']);
        $arvDetails = explode('T',$endLeg['ArrivalTimeStamp']);
        $chunks = str_split($depDetails[1], 2);
        $depTime = implode(':', $chunks);
        $chunks1 = str_split($arvDetails[1], 2);
        $arvTime = implode(':', $chunks1);
        $duration = explode(':',gmdate("H:i", ($flight['duration']*60)));
        $durHour = $duration[0];
        $durMin = $duration[1];
        $totalDur = $flight['duration'];
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
        foreach ($flight['legs'] as $stops) {
            $codes = $this->Flight_Model->getDepArvAirportOnCode($stops['Source'], $stops['Destination']);
            $depCity = $codes[0]['airport_name'] . ', ' . $codes[0]['airport_city'];
            $arvCity = $codes[1]['airport_name'] . ', ' . $codes[1]['airport_city'];
            $depDateTim = explode('T', $stops['DepartureTimeStamp']);
            $arvDateTim = explode('T', $stops['ArrivalTimeStamp']);
            $depDate = $depDateTim[0];
            $chunks = str_split($depDateTim[1], 2);
            $result = implode(':', $chunks);
            $depTime = explode(':', $result[1]);
            $arvDate = $arvDateTim[0];
            $chunks1 = str_split($arvDateTim[1], 2);
            $result1 = implode(':', $chunks1);
            $arvTime = explode(':', $result1);
            $time_in_12_hour_format_dep = date("g:i a", strtotime($result));
            $time_in_12_hour_format_arv = date("g:i a", strtotime($result1));

            $airlieName = $stops['Carrier'];
            ###############################Duration Calculation##################################################
            $date1 = new DateTime($depDateTim[0] . 'T' . $result);
            $date2 = new DateTime($arvDateTim[0] . 'T' . $result1);
            $diff = $date2->diff($date1);
            $duration = $diff->format('%hH, %iM'); //die;
            ###############################Duration Calculation##################################################
            ?>
            <div class="rs_flight_details__leg">
            <div class="rs_flight_details__time" >
                <div class="glyphicon glyphicon-time" aria-hidden="true" style="padding-top: 2px;padding-right:2px;"></div>
                <div class="rs_vertical_middle" style="float:right;"><?php echo $duration; ?></div>
            </div>
            <div class="rs_flight_details__leg__left"><img src="<?php echo base_url(); ?>assets/images/airlines/<?php echo $stops['Carrier_code']; ?>_small.gif"></div>
            <div class="rs_flight_details__leg__right">
                <table class="rs_air_leg_table">
                    <tbody>
                        <tr>
                            <td>Departs :</td><td><?php echo $time_in_12_hour_format_dep; ?></td>
                            <td><?php echo date('M d', strtotime($depDate)); ?></td>
                            <td><?php echo $depCity; ?></td>
                            <td><?php echo $stops['Source']; ?></td>
                        </tr>
                        <tr>
                            <td>Arrives :</td>
                            <td><?php echo $time_in_12_hour_format_arv; ?></td>
                            <td><?php echo date('M d', strtotime($arvDate)); ?></td>
                            <td><?php echo $arvCity; ?></td>
                            <td><?php echo $stops['Destination']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="rs_text_lighter"><?php echo $airlieName; ?> - Flight  <?php echo $stops['Carrier_code']; ?>-<?php echo $stops['FlightNumber']; ?>, <?php echo 'Economy'; //$stops['Class'];   ?></div>

            </div></div>
            <?php
            if (count($flight['legs']) > 1 && $j < count($flight['legs']) - 1) {
                ###############################Duration Calculation##################################################
                $date3 = new DateTime($depDateTim[0] . 'T' . $result);
                $depDateTim3 = explode('T', $flight['legs'][$j + 1]['DepartureTimeStamp']);
                $chunks2 = str_split($depDateTim3[1], 2);
                $result2 = implode(':', $chunks2);
                $date4 = new DateTime($result2);
                $diff1 = $date4->diff($date3);
                $layover = $diff1->format('%h Hour, %i minutes'); //die;
                ###############################Duration Calculation##################################################
                ?>
                <div class="rs_flight_details__highlightBar rs_highlight--red" style="margin-bottom:20px;">
                    <span class="rs_vertical_middle" style="font-size:14px;">Connection flight at <?php echo $arvCity; ?> ( <?php echo $stops['Destination']; ?> )&nbsp;&nbsp;Layover Time : <?php echo $layover; ?></span>
                </div>
                <?php
            }
            $j++;
        }
        ?>
    </div>
<?php
    }