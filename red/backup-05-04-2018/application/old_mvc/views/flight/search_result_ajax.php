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
                $endLeg = end($flight['Inbound']['legs']);
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
                
                $price[] = number_format($totalFare,2,'.',',');
                ?>
                <div class="searchhotel_box sort-by-section" style="margin-bottom:17px">
                    <div class="HotelInfoBox" data-price="<?php echo number_format($totalFare,2,'.',','); ?>" data-stops="<?php echo $flight['Inbound']['stops']; ?>" data-airlines="<?php echo $flight['Inbound']['legs'][0]['Carrier']; ?>" data-depart="<?php echo $depDetails[1]; ?>" data-arrival="<?php echo $arvDetails[1]; ?>" data-duration="<?php echo $totalDur; ?>" data-departure="<?php //echo $depTimeFilter; ?>">
                        <article class="box" style="margin-bottom: 0px; padding: 15px 0px 15px 0px;">
                            <figure class="col-xs-3 col-sm-2">
                                <img alt="" src="<?php echo base_url(); ?>assets/images/airlines/<?php echo $flight['Inbound']['legs'][0]['Carrier_code']; ?>_small.gif"  height="auto" style="    margin-left: 11px;">
                            </figure>

                            <div class="details col-xs-9 col-sm-10" style="padding-left:0px;" >
                                <div class="details-wrapper">
                                    <div class="first-row">
                                        <div>
                                            <h4 class="box-title"><?php echo $flight['Inbound']['legs'][0]['Carrier']; ?><small>Oneway flight</small></h4>
                                            <a class="button btn-mini stop"><?php echo $flight['Inbound']['stops']; ?> STOP</a>

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
                                                    <span class="skin-color">Take off</span><br /><span style="font-size:11px;"><?php echo date('D M d, Y', strtotime($depDetails[0])); ?> <?php echo $depTime; ?></span>
                                                </div>
                                            </div>
                                            <div class="landing col-sm-4" style="padding-left:6px;">
                                                <div class="icon"><span class="glyphicon glyphicon-plane"></span></div>
                                                <div  style="padding-left: 17px;">
                                                    <span class="skin-color">landing</span><br /><span style="font-size:11px;"><?php echo date('D M d, Y', strtotime($arvDetails[0])); ?> <?php echo $arvTime; ?></span>
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
                                            <a href="<?php echo site_url(); ?>/flight/details/<?php echo $flight['id']; ?>" class="button btn-small full-width" style="text-decoration:none;">SELECT NOW</a>
                                            <div style="clear:both;"></div>
                                            <span style="position: relative;top: 9px;"><a href="javascript:void(0);" onclick="showTfFlightDetailsOw('<?php echo $flight['id']; ?>');" style="text-align:left; background-color: #ffffff; font-size:12px; border: none; color: #827F7F;"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
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
<input type="hidden" id="setCurrency" value="<?php echo 'PHP'; ?>" />
<input type="hidden" id="setMinTime" value="0" />
<input type="hidden" id="setMaxTime" value="1440" />
<?php       
} else {
?>
<div class="alert alert-danger alert-dismissable fade in" style='width:100%;z-index:100;font-size: 17px;text-align: center;'>
    
    No Flights found for your Search. Kindly search again after some time or search again with different dates.
</div>
<input type="hidden" id="setMinPrice" value="0" />
<input type="hidden" id="setMaxPrice" value="0" />
<input type="hidden" id="setCurrency" value="<?php echo 'PHP'; ?>" />
<input type="hidden" id="setMinTime" value="0" />
<input type="hidden" id="setMaxTime" value="1440" />
<?php
}
?>
    </div>
</div>

