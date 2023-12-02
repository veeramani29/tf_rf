<style>
    .parg{    margin-top: 10px;
    margin-bottom: 10px;
    font-weight: 500;
    font-size: 17px;}
    .par_details{font-weight: normal; font-size:13px;}
    .fnt_weight{font-weight:100;}

</style>
<div class="col-sm-8 col-md-9" style="padding-right:0px;">
    <div class="col-md-12 sort-by-section pull-left" style="padding:0px; margin-bottom:10px;">
        <div class="secondaryBar">
            <div class="col-md-9" style="padding:0px;">
            <div class="col-md-3"><p class="parg" style="text-align:center;">Airline</p></div>
            
            <div class="col-md-3" style="font-weight:bold;"><p class="parg">Depart</p></div>
            <div class="col-md-3" style="font-weight:bold;"><p class="parg">Arrival</p></div>
            <div class="col-md-3" style="font-weight:bold;"><p class="parg">Duration</p></div>
            </div>
            <div class="col-md-3" style="font-weight:bold;"><p class="parg" style="text-align:center;">Price</p></div>
        </div>
    </div>
    <div class="flight-list listing-style3 flight">
        <?php 
            $price = array();
            if (isset($flights['via_data']) && $flights['via_data'] != '')
            {
                $data = $flights['via_data'];
                $adult = $searchParms['adult'];
                $child = $searchParms['child'];
                $infant = $searchParms['infant'];
                $infantFare = 0;
                $childFare = 0;
                $i=0;
                foreach($data as $flight)
                {
                    $inendLeg = end($flight['Inbound']['legs']);
                    $indepDetails = explode('T',$flight['Inbound']['legs'][0]['DepartureTimeStamp']);
                    $inarvDetails = explode('T',$inendLeg['ArrivalTimeStamp']);
                    $inchunks = str_split($indepDetails[1], 2);
                    $inresult = implode(':', $inchunks);
                    $inchunks1 = str_split($inarvDetails[1], 2);
                    $inresult1 = implode(':', $inchunks1);
                    $indepTime = $inresult;
                    $inarvTime = $inresult1;
                    $induration = explode(':',gmdate("H:i", ($flight['Inbound']['duration']*60)));
                    $indurHour = $induration[0];
                    $indurMin = $induration[1];
                    $intotalDur = $flight['Inbound']['duration'];
                    ############################ Return Flight #################################
                    $outendLeg = end($flight['Inbound']['legs']);
                    $outdepDetails = explode('T',$flight['Inbound']['legs'][0]['DepartureTimeStamp']);
                    $outarvDetails = explode('T',$outendLeg['ArrivalTimeStamp']);
                    $outchunks = str_split($outdepDetails[1], 2);
                    $outresult = implode(':', $outchunks);
                    $outchunks1 = str_split($outarvDetails[1], 2);
                    $outresult1 = implode(':', $outchunks1);
                    $outdepTime = $outresult;
                    $outarvTime = $outresult1;
                    $outduration = explode(':',gmdate("H:i", ($flight['Inbound']['duration']*60)));
                    $outdurHour = $outduration[0];
                    $outdurMin = $outduration[1];
                    $outtotalDur = $flight['Inbound']['duration'];
                    
                    $adultFare = ($flight['Inbound']['adult_fare']*$adult);
                    if($child > 0)
                    {
                        $childFare = ($flight['Inbound']['child_fare']*$child);
                    }
                    if($infant > 0)
                    {
                        $infantFare = ($flight['Inbound']['infant_fare']*$child);
                    }
                    $totalFare = ($adultFare+$childFare+$infantFare);
                    
                    
                    if($admin_markup['type'] == 'fixed'){
                        $totalFare = ($totalFare+$admin_markup['international']);
                    } else {
                        $totalFare = ((($admin_markup['international']/100)*$totalFare)+$totalFare);
                    }
                    
                    if($agent_markup['type'] == 'fixed'){
                        $totalFare = ($totalFare+$agent_markup['international']);
                    } else {
                        $totalFare = ((($agent_markup['international']/100)*$totalFare)+$totalFare);
                    }
                    
                    $price[] = $totalFare;
        ?>
        <div class="col-md-12 searchhotel_box sort-by-section pull-left" style="margin-bottom:15px;">
            <div class="HotelInfoBox" data-price="<?php echo number_format($totalFare,2,'.',','); ?>" data-stops="<?php echo $flight['Inbound']['stops']; ?>" data-airlines="<?php echo $flight['Inbound']['legs'][0]['Carrier']; ?>" data-depart="<?php echo $indepDetails[1]; ?>" data-arrival="<?php echo $inarvDetails[1]; ?>" data-duration="<?php //echo $totalDur; ?>" data-departure="<?php //echo $depTimeFilter; ?>">
            
            
                <div class="col-md-9" style="padding: 10px 0 0 0; margin-bottom:0px;background-color: #ffffff;font-weight: bold; border-right:1px solid #f2f2f2;">
                   <!--########################## ONWARD FLIGHT DETAILS #############################-->
                   <div class="col-md-3">
                       <p style="text-align:center;"><img src="<?php echo base_url(); ?>assets/images/airline_logo/<?php echo $flight['Inbound']['legs'][0]['Carrier_code']; ?>.gif" style=""/></p>
                   </div>
                   <div class="col-md-3">

                       <div id="togg<?php echo $i; ?>"><a onclick="toggle(<?php echo $i; ?>);" style="text-decoration:none;color:#ccc;">
                           <p class="fnt_weight" style="color:#111111;"><?php echo $inresult; ?></p>
                           <p class="par_details" style="color:#8a8787;"><?php echo $flight['Inbound']['legs'][0]['Source']; ?> &#8594; <?php $leg = end($flight['Inbound']['legs']); echo $leg['Destination']; ?></p>
                       </a></div>

                   </div>
                   <div class="col-md-3"><p class="fnt_weight"><?php echo $inresult1; ?></p></div>
                   <div class="col-md-3"><p class="fnt_weight"><?php echo $indurHour; ?>h <?php echo $indurMin; ?>m</p><p class="par_details" style="color:#8a8787;"><?php echo($flight['Inbound']['stops'] == 0?'Non-stop':$flight['Inbound']['stops'].' Stop'); ?></p></div>
                    
                   <div style="clear:both;"></div>
                   
                   <!--######################### ONWARD FLIGHT DETAILS #############################-->
                   <div class="col-md-12"><hr style="margin:0px 0px 16px 0px;"></div>
                   <!--######################### RETURN FLIGHT DETAILS #########################-->
                   <div class="col-md-3">
                       <p style="text-align:center;"><img src="<?php echo base_url(); ?>assets/images/airline_logo/<?php echo $flight['Outbound']['legs'][0]['Carrier_code']; ?>.gif" style=""/></p>
                   </div>
                   
                   <div class="col-md-3">

                       <div id="togg<?php echo $i; ?>"><a onclick="toggle(<?php echo $i; ?>);" style="text-decoration:none;color:#ccc;">
                           <p class="fnt_weight" style="color:#111111;"><?php echo $outresult; ?></p>
                           <p class="par_details" style="color:#8a8787;"><?php echo $flight['Outbound']['legs'][0]['Source']; ?> &#8594; <?php $leg = end($flight['Outbound']['legs']); echo $leg['Destination']; ?></p>
                       </a></div>

                   </div>
                   <div class="col-md-3"><p class="fnt_weight"><?php echo $outresult1; ?></p></div>
                   <div class="col-md-3"><p class="fnt_weight"><?php echo $outdurHour; ?>h <?php echo $outdurMin; ?>m</p><p class="par_details" style="color:#8a8787;"><?php echo($flight['Outbound']['stops'] == 0?'Non-stop':$flight['Outbound']['stops'].' Stop'); ?></p></div>
                   
                   <!--######################### RETURN FLIGHT DETAILS #########################-->
                </div>
                
                <div class="col-md-3" style="padding-left:0px;padding-top: 25px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                       <p class="pull-right fon_p" style="margin-bottom:3px;"><span style="color:#333333;font-size: 31px;font-weight: 100;">&#8369;</span><span style="font-size: 19px;font-weight: 100;"> <?php echo number_format($totalFare,2,'.',','); ?></span></p>
                       <div style="clear:both;"></div>
                       <a onclick="window.location.href='<?php echo site_url(); ?>/flight/details/<?php echo $flight['id']; ?>';" class="button btn-small full-width" style="text-decoration:none;">SELECT NOW</a>
                       
                       
                       <div style="clear:both;"></div>
                        <span style="position: relative;top: 9px;"><a href="javascript:void(0);" onclick="showTfFlightDetailsRtIntl('<?php echo $flight['id']; ?>');" style="text-align:left; background-color: #ffffff; font-size:12px; border: none; color: #827F7F;font-weight: 100;"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
                        Flight Details</a></span>
                    </div>
                   </div>
                
            </div>
        </div>
        <div style="clear:both;"></div>
        <?php 
                    $i++;
                }
            }
        ?>
    </div>
</div>
<input type="hidden" id="setMinPrice" value="<?php if(!empty($price)) echo min($price); else echo 0; ?>" />
<input type="hidden" id="setMaxPrice" value="<?php if(!empty($price)) echo max($price); else echo 0; ?>" />
<input type="hidden" id="setCurrency" value="<?php echo 'PHP';?>" />
<input type="hidden" id="setMinTime" value="0" />
<input type="hidden" id="setMaxTime" value="1440" />













