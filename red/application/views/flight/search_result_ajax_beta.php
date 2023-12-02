<div class="col-sm-8 col-md-9 respo" style="padding-right:0px;padding-left:0px;">
    <div class="flight-list listing-style3 flight">
        <?php
        $price = array();  $airlineList = array();  $dep = array();  $arv = array();
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
                $FlightArrivalDetails=end($flight['flights']);
				$dateArr = $FlightArrivalDetails['arrDetail']['time'];
				$dateStructArr = explode('.', $dateArr);
				$dateOriArr = explode(' ', $dateStructArr[0]);
				$dateArrHM = explode(':', $dateOriArr[1]);
				$arvTime = $dateArrHM[0].":".$dateArrHM[1];
				$FlightDepDetails=reset($flight['flights']);
				$dateDep = $FlightDepDetails['depDetail']['time'];
				$dateStructDep = explode('.', $dateDep);
				$dateOriDep = explode(' ', $dateStructDep[0]);
				$dateDepHM = explode(':', $dateOriDep[1]);
				$depTime = $dateDepHM[0].":".$dateDepHM[1];
				
			$duration = explode(':', gmdate("H:i", ($flight['journeyInfo'][0]['journeyTime'] * 60)));
                $durHour = $duration[0];
                $durMin = $duration[1];
				$totalDur = $flight['journeyInfo'][0]['journeyTime'];
				  $fareRules = $flight['key'];
				$adultFare = ($flight['fares']['paxFares']['adt']['total']['amount'] * $adult);
                if ($child > 0) {
                    $childFare = ($flight['fares']['paxFares']['chd']['total']['amount'] * $child);
                }
                if ($infant > 0) {
                    $infantFare = ($flight['fares']['paxFares']['inf']['total']['amount'] * $child);
                }
				
				$totalFare = ($adultFare + $childFare + $infantFare);
				
				$price[] = number_format($totalFare,2,'.','');
                $Stops=(count($flight['flights'])-1);

				
                
              //print_r($admin_markup);
                //echo $totalFare;//die; 
                if(array_key_exists($FlightDepDetails['carrier']['code'],$admin_markup) && $fltype == 'dom'){
                   $airCode = $FlightDepDetails['carrier']['code'];
                    if($admin_markup['type'] == 'fixed'){
                        $totalFare = ($totalFare+$admin_markup[$airCode]);
                    } else {
                        $totalFare = (($admin_markup[$airCode]/100)*$totalFare)+$totalFare;
                    }
                } else {
                    if($admin_markup['type'] == 'fixed'){
                        $totalFare = ($totalFare+$admin_markup['international']);
                    } else {
                        $totalFare = ((($admin_markup['international']/100)*$totalFare)+$totalFare);
                    }
                }
                
                if(array_key_exists($FlightDepDetails['carrier']['code'],$agent_markup) && $fltype == 'dom'){
                    $airCode = $FlightDepDetails['carrier']['code'];
                    if($agent_markup['type'] == 'fixed'){
                       $totalFare = ($totalFare+$agent_markup[$airCode]);
                    } else {
                      $totalFare = (($agent_markup[$airCode]/100)*$totalFare)+$totalFare;
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
                $airlineList[]=$FlightDepDetails['carrier']['name'];
                $price[] = number_format($totalFare,2,'.','');
                $dep[] = substr(str_replace(":", "", $dateOriDep[1]),0, 4);
                $arv[] = substr(str_replace(":", "", $dateOriArr[1]),0, 4); 
                ?>

                <div class="searchflight_box sort-by-section" style="margin-bottom:17px">
                    <div class="FlightInfoBox" data-price="<?php echo number_format($totalFare,2,'.',''); ?>" data-stops="<?php echo $Stops; ?>" data-airlines="<?php echo $FlightDepDetails['carrier']['name']; ?>" data-depart="<?php echo substr(str_replace(":", "", $dateOriDep[1]),0, 4); ?>" data-arrival="<?php echo substr(str_replace(":", "", $dateOriArr[1]),0, 4); ?>" data-duration="<?php echo $totalDur; ?>" data-departure="<?php //echo $depTimeFilter; ?>">
                        <article class="box" style="margin-bottom: 0px; padding: 15px 0px 15px 0px;">
                            <figure class="col-xs-3 col-sm-2">
                                <img alt="" src="<?php echo base_url(); ?>assets/images/airlines/<?php echo $FlightDepDetails['carrier']['code']; ?>_small.gif"  height="auto" style="    margin-left: 11px;">
                            </figure>

                            <div class="details col-xs-9 col-sm-10" style="padding-left:0px;" >
                                <div class="details-wrapper">
                                    <div class="first-row">
                                        <div>
                                            <h4 class="box-title"><?php echo $FlightDepDetails['carrier']['name']; ?><small>Oneway flight</small></h4>
                                            <a class="button btn-mini stop"><?php echo $Stops; ?> STOP</a>
                                            <?php if($FlightDepDetails['layover']!=0){ ?>
                                            <a class="button btn-mini "><?php echo gmdate("H:i", ($FlightDepDetails['layover'] * 60)); ?> Layover</a>
<?php } ?>
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
                                                    <span class="skin-color">Take off</span><br /><span style="font-size:11px;"><?php echo date('D M d, Y', strtotime($FlightDepDetails['depDetail']['time'])); ?> <?php echo $depTime; ?></span>
                                                </div>
                                            </div>
                                            <div class="landing col-sm-4" style="padding-left:6px;">
                                                <div class="icon"><span class="glyphicon glyphicon-plane"></span></div>
                                                <div  style="padding-left: 17px;">
                                                    <span class="skin-color">landing</span><br /><span style="font-size:11px;"><?php echo date('D M d, Y', strtotime($FlightArrivalDetails['arrDetail']['time'])); ?> <?php echo $arvTime; ?></span>
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
                                            <a href="<?php echo site_url(); ?>/flight/details/<?php echo $i; ?>" class="button btn-small full-width" style="text-decoration:none;">SELECT NOW</a>
                                            <b>Seats <?php echo $flight['seatsLeft'];?></b>
                                            <div style="clear:both;"></div>
                                            <span style="position: relative;top: 9px;"><a href="javascript:void(0);" onclick="showTfFlightDetailsOw('<?php echo $i; ?>');" style="text-align:left; background-color: #ffffff; font-size:12px; border: none; color: #827F7F;"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
                                            Flight Details</a></span>| 

                                            <span class="f_color" style="color: #000;position: relative;top: 9px;font-size: 11px;"> <a class="href_<?php echo ($i+1);?>" href="javascript:void(0);" id="<?php echo $fareRules;?>" onclick="show_fare_popup(this.id,this,1)">Fare Rules</a></span>
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

       $Airlines = array_unique($airlineList);sort($airlineList);
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

<script type="text/javascript">
    



    $('#airline_list').append('<?php $i=1;foreach($Airlines as $airline){?><li style="width: 100%;padding: 7px 0 5px 15px;" ><label style="font-weight:normal;width: 84%" for="airline<?php echo rand();?>" onclick="filter();"><span style="margin-top:3px;"><input id="airline<?php echo rand();?>" type="checkbox" name="airlines" class="air_filter" value="<?php echo $airline;?>" style="width:15px;height:15px;margin-right:10px;" checked="checked" onclick="filter();"></span><?php echo $airline;?></label></li><?php $i++; }?>');
</script>

