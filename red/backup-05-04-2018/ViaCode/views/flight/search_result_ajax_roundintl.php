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
             $price = array();  $airlineList = array();  $dep = array();  $arv = array();
            // echo "<pre>";print_r($flights);
            if (isset($flights['via_data']) && $flights['via_data'] != '')
            {
                $data = $flights['via_data'];
                $adult = $searchParms['adult'];
                $child = $searchParms['child'];
                $infant = $searchParms['infant'];
                $infantFare = 0;
                $childFare = 0;
                $i=0;  $segments=array();
                foreach($data as $flight)
                {

                	 #echo "<pre>";print_r($flight['flights']);

				$segments['onward']=array_filter($flight['flights'], function($k) {
				if(!isset($k['isReturn'])){
				return true;
				}else{
				return false;
				}

				});


				$segments['return']=array_filter($flight['flights'], function($k) {
				return (isset($k['isReturn']) && $k['isReturn']== 1);
			});

				  $segments['return']=array_values($segments['return']);

				//Get onward details 

               	$instartLeg = reset($segments['onward']);
                $indepDetails = $instartLeg['depDetail']['time'];
				$datedepStructDep = explode('.', $indepDetails);
				$dateOriDep = explode(' ', $datedepStructDep[0]);
				$dateOriDepHM = explode(':', $dateOriDep[1]);
				$indepTime = $dateOriDepHM[0].":".$dateOriDepHM[1];


				$inendLeg = end($segments['onward']);
				 $inarvDetails = $inendLeg['arrDetail']['time'];
				$dateStructArr = explode('.', $inarvDetails);
				$dateDestArr = explode(' ', $dateStructArr[0]);
				$dateArrHM = explode(':', $dateDestArr[1]);
				$inarvTime = $dateArrHM[0].":".$dateArrHM[1];

                   



                     $induration = explode(':', gmdate("H:i", ($flight['journeyInfo'][0]['journeyTime'] * 60)));
                $indurHour = $induration[0];
                $indurMin = $induration[1];
        $intotalDur = $flight['journeyInfo'][0]['journeyTime'];

                 
                    ############################ Return Flight #################################


        		$OutstartLeg = reset($segments['return']);
                $OutdepDetails = $OutstartLeg['depDetail']['time'];
				$Outdepdate = explode('.', $OutdepDetails);
				$OutdepdateArr = explode(' ', $Outdepdate[0]);
				$OutdepdateHM = explode(':', $OutdepdateArr[1]);
				$OutdepTime = $OutdepdateHM[0].":".$OutdepdateHM[1];


				$OutendLeg = end($segments['return']);
				$outArvDetails = $OutendLeg['arrDetail']['time'];
				$outArvdate = explode('.', $outArvDetails);
				$outArvStructArr = explode(' ', $outArvdate[0]);
				$OutArrHM = explode(':', $outArvStructArr[1]);
				$OutarvTime = $OutArrHM[0].":".$OutArrHM[1];

                   
                 
$airlineList[]=$instartLeg['carrier']['name'];
$airlineList[]=$OutstartLeg['carrier']['name'];

                     $outduration = explode(':', gmdate("H:i", ($flight['journeyInfo'][0]['journeyTime'] * 60)));
                $outdurHour = $outduration[0];
                $outdurMin = $outduration[1];
        $outtotalDur = $flight['journeyInfo'][0]['journeyTime'];
                     

                    
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
                    
                   // print_r($agent_markup);
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
                     $airlineList[]=$inendLeg['carrier']['name'];
                   
        ?>
        <div class="col-md-12 searchhotel_box sort-by-section pull-left" style="margin-bottom:15px;">
            <div class="HotelInfoBox" data-price="<?php echo number_format($totalFare,2,'.',','); ?>" data-stops="<?php echo $Stops; ?>" data-airlines="<?php echo $instartLeg['carrier']['name']; ?>" data-depart="<?php echo $indepDetails[1]; ?>" data-arrival="<?php echo $inarvDetails[1]; ?>" data-duration="<?php //echo $totalDur; ?>" data-departure="<?php //echo $depTimeFilter; ?>">
            
            
                <div class="col-md-9" style="padding: 10px 0 0 0; margin-bottom:0px;background-color: #ffffff;font-weight: bold; border-right:1px solid #f2f2f2;">
                   <!--########################## ONWARD FLIGHT DETAILS #############################-->
                   <div class="col-md-3">
                       <p style="text-align:center;"><img src="<?php echo base_url(); ?>assets/images/airline_logo/<?php echo $instartLeg['carrier']['code']; ?>.gif" style=""/>
<br>
<small><?php echo $instartLeg['carrier']['name']; ?></small>

                       </p>
                   </div>
                   <div class="col-md-3">

                       <div id="togg<?php echo $i; ?>"><a onclick="toggle(<?php echo $i; ?>);" style="text-decoration:none;color:#ccc;">
                           <p class="fnt_weight" style="color:#111111;"><?php echo date('D M d, Y', strtotime($instartLeg['depDetail']['time'])); ?> <?php echo $indepTime; ?></p>
                           <p class="par_details" style="color:#8a8787;"><?php echo $instartLeg['depDetail']['code']; ?> &#8594; <?php echo $inendLeg['arrDetail']['code']; ?></p>
                       </a></div>

                   </div>
                   <div class="col-md-3"><p class="fnt_weight"><?php echo date('D M d, Y', strtotime($inendLeg['arrDetail']['time'])); ?> <?php echo $inarvTime; ?></p></div>
                   <div class="col-md-3"><p class="fnt_weight"><?php echo $indurHour; ?>h <?php echo $indurMin; ?>m</p><p class="par_details" style="color:#8a8787;"><?php echo ((count($segments['onward'])-1) == 0?'Non-stop':(count($segments['onward'])-1).' Stop'); ?></p></div>
                    
                   <div style="clear:both;"></div>
                   
                   <!--######################### ONWARD FLIGHT DETAILS #############################-->
                   <div class="col-md-12"><hr style="margin:0px 0px 16px 0px;"></div>
                   <!--######################### RETURN FLIGHT DETAILS #########################-->
                   <div class="col-md-3">
                       <p style="text-align:center;"><img src="<?php echo base_url(); ?>assets/images/airline_logo/<?php echo $OutstartLeg['carrier']['code']; ?>.gif" style=""/>
                       <br>
<small><?php echo $OutstartLeg['carrier']['name']; ?></small>
                       </p>
                   </div>
                   
                   <div class="col-md-3">

                       <div id="togg<?php echo $i; ?>"><a onclick="toggle(<?php echo $i; ?>);" style="text-decoration:none;color:#ccc;">
                           <p class="fnt_weight" style="color:#111111;"> <?php echo date('D M d, Y', strtotime($OutstartLeg['depDetail']['time'])); ?> <?php echo $OutdepTime; ?></p>
                           <p class="par_details" style="color:#8a8787;"><?php echo $OutstartLeg['depDetail']['code']; ?> &#8594; <?php  echo $OutendLeg['arrDetail']['code']; ?></p>
                       </a></div>

                   </div>


                   <div class="col-md-3"><p class="fnt_weight"><?php echo date('D M d, Y', strtotime($OutendLeg['arrDetail']['time'])); ?> <?php echo $OutarvTime; ?></p></div>
                   <div class="col-md-3"><p class="fnt_weight"><?php echo $outdurHour; ?>h <?php echo $outdurMin; ?>m</p><p class="par_details" style="color:#8a8787;"><?php echo((count($segments['return'])-1) == 0?'Non-stop':(count($segments['return'])-1).' Stop'); ?></p></div>
                   
                   <!--######################### RETURN FLIGHT DETAILS #########################-->
                </div>
                
                <div class="col-md-3" style="padding-left:0px;padding-top: 25px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                       <p class="pull-right fon_p" style="margin-bottom:3px;"><span style="color:#333333;font-size: 31px;font-weight: 100;">&#8369;</span><span style="font-size: 19px;font-weight: 100;"> <?php echo number_format($totalFare,2,'.',','); ?></span></p>
                       <div style="clear:both;"></div>
                       <a onclick="window.location.href='<?php echo site_url(); ?>/flightbeta/details/<?php echo $i; ?>';" class="button btn-small full-width" style="text-decoration:none;">SELECT NOW</a>
                       <b>Seats <?php echo $flight['seatsLeft'];?></b>
                       
                       <div style="clear:both;"></div>
                        <span style="position: relative;top: 9px;"><a href="javascript:void(0);" onclick="showTfFlightDetailsRtIntl('<?php echo $i; ?>');" style="text-align:left; background-color: #ffffff; font-size:12px; border: none; color: #827F7F;font-weight: 100;"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
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

             $Airlines = array_unique($airlineList);sort($airlineList);
        ?>
    </div>
</div>
<input type="hidden" id="setMinPrice" value="<?php if(!empty($price)) echo min($price); else echo 0; ?>" />
<input type="hidden" id="setMaxPrice" value="<?php if(!empty($price)) echo max($price); else echo 0; ?>" />
<input type="hidden" id="setCurrency" value="<?php echo 'PHP';?>" />
<input type="hidden" id="setMinTime" value="0" />
<input type="hidden" id="setMaxTime" value="1440" />
<script type="text/javascript">
    



    $('#airline_list').append('<?php $i=1;foreach($Airlines as $airline){?><li style="width: 100%;padding: 7px 0 5px 15px;" ><label style="font-weight:normal;width: 84%" for="airline<?php echo rand();?>" onclick="filter();"><span style="margin-top:3px;"><input id="airline<?php echo rand();?>" type="checkbox" name="airlines" class="air_filter" value="<?php echo $airline;?>" style="width:15px;height:15px;margin-right:10px;" checked="checked" onclick="filter();"></span><?php echo $airline;?></label></li><?php $i++; }?>');
</script>












