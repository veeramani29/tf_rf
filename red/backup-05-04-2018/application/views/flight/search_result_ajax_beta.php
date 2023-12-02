<div class="col-sm-8 col-md-9 respo" style="padding-right:0px;padding-left:0px;">
    <div class="flight-list listing-style3 flight">
        <?php
        $price = array();
        if (isset($flights['via_data']) && $flights['via_data'] != '') {
            $data = $flights['via_data'];
            $adult = $searchParms['adult'];
            $child = $searchParms['child'];
            $infant = $searchParms['infant'];
            if (trim($searchParms['fromCountry']) == 'Philippines' && trim($searchParms['toCountry']) == 'Philippines') {
                $fltype = 'dom';
            } else {
                $fltype = 'intl';
            }
            $infantFare = 0;
            $childFare = 0;
            $i = 0;
            foreach ($data as $flight) {
				//echo '<pre />';print_r($flight); exit;  die;
				$dateArr = $flight['flights'][0]['arrDetail']['time'];
				$dateStructArr = explode('.', $dateArr);
				$dateOriArr = explode(' ', $dateStructArr[0]);
				$dateArrHM = explode(':', $dateOriArr[1]);
				$arvTime = $dateArrHM[0].":".$dateArrHM[1];
				
				$dateDep = $flight['flights'][0]['depDetail']['time'];
				$dateStructDep = explode('.', $dateDep);
				$dateOriDep = explode(' ', $dateStructDep[0]);
				$dateDepHM = explode(':', $dateOriDep[1]);
				$depTime = $dateDepHM[0].":".$dateDepHM[1];
				
				$duration = explode(':', gmdate("H:i", ($flight['flights'][0]['flyTime'] * 60)));
                $durHour = $duration[0];
                $durMin = $duration[1];
				$totalDur = $flight['flights'][0]['flyTime'];
				
				$adultFare = ($flight['fares']['paxFares']['adt']['total']['amount'] * $adult);
                if ($child > 0) {
                    $childFare = ($flight['fares']['paxFares']['chd']['total']['amount'] * $child);
                }
                if ($infant > 0) {
                    $infantFare = ($flight['fares']['paxFares']['inf']['total']['amount'] * $child);
                }
				
				$totalFare = ($adultFare + $childFare + $infantFare);
				
				$price[] = number_format($totalFare,2,'.','');
				
                
                /* $endLeg = end($flight['Inbound']['legs']);
                $depDetails = explode('T', $flight['Inbound']['legs'][0]['DepartureTimeStamp']);
                $arvDetails = explode('T', $endLeg['ArrivalTimeStamp']);
                $chunks = str_split($depDetails[1], 2);
                $result = implode(':', $chunks);
                $chunks1 = str_split($arvDetails[1], 2);
                $result1 = implode(':', $chunks1);
                $depTime = $result;
                $arvTime = $result1;
                $duration = explode(':', gmdate("H:i", ($flight['Inbound']['duration'] * 60)));
                $durHour = $duration[0];
                $durMin = $duration[1];
                $totalDur = $flight['Inbound']['duration'];

                $adultFare = ($flight['Inbound']['adult_fare'] * $adult);
                if ($child > 0) {
                    $childFare = ($flight['Inbound']['child_fare'] * $child);
                }
                if ($infant > 0) {
                    $infantFare = ($flight['Inbound']['infant_fare'] * $child);
                }
                $totalFare = ($adultFare + $childFare + $infantFare);
                //echo $totalFare;die;
                if(array_key_exists($flight['Inbound']['legs'][0]['Carrier_code'],$admin_markup) && $fltype == 'dom'){
                    $airCode = $flight['Inbound']['legs'][0]['Carrier_code'];
                    if($admin_markup['type'] == 'fixed'){
                        $totalFare = ($totalFare+$admin_markup[$airCode]);
                    } else {
                        $totalFare = (($admin_markup[$airCode]/100)*$totalFare);
                    }
                } else {
                    if($admin_markup['type'] == 'fixed'){
                        $totalFare = ($totalFare+$admin_markup['international']);
                    } else {
                        $totalFare = ((($admin_markup['international']/100)*$totalFare)+$totalFare);
                    }
                }
                
                if(array_key_exists($flight['Inbound']['legs'][0]['Carrier_code'],$agent_markup) && $fltype == 'dom'){
                    $airCode = $flight['Inbound']['legs'][0]['Carrier_code'];
                    if($agent_markup['type'] == 'fixed'){
                        $totalFare = ($totalFare+$agent_markup[$airCode]);
                    } else {
                        $totalFare = (($agent_markup[$airCode]/100)*$totalFare);
                    }
                } else {
                    if($agent_markup['type'] == 'fixed'){
                        $totalFare = ($totalFare+$agent_markup['international']);
                    } else {
                        $totalFare = ((($agent_markup['international']/100)*$totalFare)+$totalFare);
                    }
                }
                
                //die;
                
                //echo $totalFare;die;
                
                $price[] = number_format($totalFare,2,'.','');
                $dep[] = $depDetails[1];
                $arv[] = $arvDetails[1]; */
                ?>
                <div class="searchflight_box sort-by-section" style="margin-bottom:17px">
                    <div class="FlightInfoBox" data-price="<?php echo number_format($totalFare,2,'.',''); ?>" data-stops="<?php echo $flight['flights'][0]['stops']; ?>" data-airlines="<?php //echo $flight['Inbound']['legs'][0]['Carrier']; ?>" data-depart="<?php echo $flight['flights'][0]['depDetail']; ?>" data-arrival="<?php echo $flight['flights'][0]['arrDetail']; ?>" data-duration="<?php echo $totalDur; ?>" data-departure="<?php //echo $depTimeFilter; ?>">
                        <article class="box" style="margin-bottom: 0px; padding: 15px 0px 15px 0px;">
                            <figure class="col-xs-3 col-sm-2">
                                <img alt="" src="<?php echo base_url(); ?>assets/images/airlines/<?php echo $flight['flights'][0]['carrier']['code']; ?>_small.gif"  height="auto" style="    margin-left: 11px;">
                            </figure>

                            <div class="details col-xs-9 col-sm-10" style="padding-left:0px;" >
                                <div class="details-wrapper">
                                    <div class="first-row">
                                        <div>
                                            <h4 class="box-title"><?php echo $flight['flights'][0]['carrier']['name']; ?><small>Oneway flight</small></h4>
                                            <a class="button btn-mini stop"><?php echo $flight['flights'][0]['stops']; ?> STOP</a>

                                        </div>
                                        <div>
                                            <span class="price"><small>Total</small><span style="font-size:31px;">&#8369;</span> <?php echo number_format($totalFare,2,'.',','); ?></span>
                                        </div>
                                    </div>
                                    <div class="second-row">
                                        <div class="time" style=" padding-right:0px;">
                                            <div class="take-off col-sm-4">
                                                <div class="icon"><span class="glyphicon glyphicon-plane"></span></div>
                                                <div style="padding-left: 17px;">
                                                    <span class="skin-color">Take off</span><br /><span style="font-size:11px;"><?php echo date('D M d, Y', strtotime($flight['flights'][0]['depDetail']['time'])); ?> <?php echo $depTime; ?></span>
                                                </div>
                                            </div>
                                            <div class="landing col-sm-4" style="padding-left:6px;">
                                                <div class="icon"><span class="glyphicon glyphicon-plane"></span></div>
                                                <div  style="padding-left: 17px;">
                                                    <span class="skin-color">landing</span><br /><span style="font-size:11px;"><?php echo date('D M d, Y', strtotime($flight['flights'][0]['arrDetail']['time'])); ?> <?php echo $arvTime; ?></span>
                                                </div>
                                            </div>
                                            <div class="total-time col-sm-4" style="padding-left:6px;">
                                                <div class="icon"><span class="glyphicon glyphicon-time"></span></div>
                                                <div  style="padding-left: 17px;">
                                                    <span class="skin-color">total time</span><br /><span style="font-size:11px;"><?php echo $durHour; ?> Hour, <?php echo $durMin; ?> minutes</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="action">
                                            <a href="<?php echo site_url(); ?>/flightbeta/details/<?php echo $i; ?>" class="button btn-small full-width" style="text-decoration:none;">SELECT NOW</a>
                                            <div style="clear:both;"></div>
                                            <span style="position: relative;top: 9px;"><a href="javascript:void(0);" onclick="showTfFlightDetailsOw('<?php echo $i; ?>');" style="text-align:left; background-color: #ffffff; font-size:12px; border: none; color: #827F7F;"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
                                            Flight Details</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
        <?php
        $i++;
    }
?>
<input type="hidden" id="setMinPrice" value="<?php if (!empty($price)) echo min($price); else echo 0; ?>" />
<input type="hidden" id="setMaxPrice" value="<?php if (!empty($price)) echo max($price); else echo 0; ?>" />
<input type="hidden" id="setCurrency" value="<?php echo '&#8369;'; ?>" />
<input type="hidden" id="setMinTime" value="0" />
<input type="hidden" id="setMaxTime" value="2400" />
<?php       
} else {
?>
<div class="alert alert-danger alert-dismissable fade in" style='width:100%;z-index:100;font-size: 17px;text-align: center;background-color: #eaabab;'>
    
    No Flights found for your Search. Kindly search again after some time or search again with different dates.
</div>
<input type="hidden" id="setMinPrice" value="0" />
<input type="hidden" id="setMaxPrice" value="0" />
<input type="hidden" id="setCurrency" value="<?php echo '&#8369;'; ?>" />
<input type="hidden" id="setMinDep" value="<?php if (!empty($dep)) echo min($price); else echo 0; ?>" />
<input type="hidden" id="setMaxDep" value="<?php if (!empty($dep)) echo max($dep); else echo 0; ?>" />
<?php
}
?>
    </div>
</div>

