  <?php 
             $price = array();  $airlineList = array();  $dep = array();  $arv = array();
            // echo "<pre>";print_r($flights);
            if (isset($flights['via_data']) && !empty($flights['via_data']))
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
                 $DepartureDateTime = $dpt = strtotime($instartLeg['depDetail']['time']);

                $inendLeg = end($segments['onward']);
                 $inarvDetails = $inendLeg['arrDetail']['time'];
                $dateStructArr = explode('.', $inarvDetails);
                $dateDestArr = explode(' ', $dateStructArr[0]);
                $dateArrHM = explode(':', $dateDestArr[1]);
                $inarvTime = $dateArrHM[0].":".$dateArrHM[1];
               $ArrivalDateTime = $art = strtotime($inendLeg['arrDetail']['time']);
                   



                     $induration = explode(':', gmdate("H:i", ($flight['journeyInfo'][0]['journeyTime'] * 60)));
                $indurHour = $induration[0];
                $indurMin = $induration[1];
        $intotalDur = $flight['journeyInfo'][0]['journeyTime'];
  $fareRules = $flight['key'];
                 
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
        
        <div class="searchflight_box ">
<!-- END OF FLIGHT TICKET-->
<div id="ticketid<?php echo $i; ?>" class="offset-2 margtop20 FlightInfoBox" data-price="<?php echo number_format($totalFare,2,'.',''); ?>" data-stops="<?php echo $Stops; ?>" data-airlines="<?php echo $instartLeg['carrier']['name']; ?>" data-depart="<?php echo $DepartureDateTime; ?>" data-arrival="<?php echo $ArrivalDateTime; ?>" data-duration="<?php //echo $totalDur; ?>" data-departure="<?php //echo $depTimeFilter; ?>">

  <div class="fblueline"><b><?php echo $instartLeg['depDetail']['city']; ?></b> <?php echo $instartLeg['depDetail']['name']; ?> <span class="farrow"></span> <b><?php echo $instartLeg['arrDetail']['city']; ?></b> <?php echo $instartLeg['arrDetail']['name']; ?></div>

                       
                        
                        <!-- GOING TICKET-->
                        <div class="frow1">
                            
                            <ul class="flightstable mt20">
                                <li class="ft1">
                                   <img src="<?php echo base_url(); ?>assets/images/airline_logo/<?php echo $instartLeg['carrier']['code']; ?>.gif" style=""/>
<br>
<small><?php echo $instartLeg['carrier']['name']; ?></small>
                                </li>
                                <li class="ft2">
                                        
                                        <span class="grey"><?php echo date('D M d, Y', strtotime($instartLeg['depDetail']['time'])); ?></span><br>
                                        <span class="size16 dark bold"><?php echo $indepTime; ?></span><br>
                                         <span class="size16 dark bold"> <?php echo $instartLeg['depDetail']['code']; ?> &#8594; <?php echo $inendLeg['arrDetail']['code']; ?></span>
                                </li>
                                <li class="ft3">
                                       
                                        <span class="grey"><?php echo date('D M d, Y', strtotime($inendLeg['arrDetail']['time'])); ?></span><br>
                                        <span class="size16 dark bold"><?php echo $inarvTime; ?></span><br>

                                </li>
                                <li class="ft4">
                                        <?php echo $indurHour; ?>h <?php echo $indurMin; ?>m<br>
                                        <span class="grey"><?php echo ((count($segments['onward'])-1) == 0?'Non-stop':(count($segments['onward'])-1).' Stop'); ?></span><br>
                                         <?php echo $instartLeg['flightNo']; ?> -<?php echo $instartLeg['carrier']['code']; ?><br>
                                </li>
                               
                            </ul>
                            <div class="clearfix"></div><br><br>

                        </div>
                       
                        
                        <!-- END OF GOING TICKET-->
                        
                         <div class="fgreenline"><b><?php echo $OutstartLeg['depDetail']['city']; ?></b> <?php echo $OutstartLeg['depDetail']['name']; ?> <span class="farrow"></span> <b><?php echo $OutstartLeg['arrDetail']['city']; ?></b> <?php echo $OutstartLeg['arrDetail']['name']; ?></div>

                    
                        
                        <!-- RETURNING TICKET-->
                        <div class="frow2">
                        
                             <ul class="flightstable mt20">
                                    <li class="ft1">
                                      <img src="<?php echo base_url(); ?>assets/images/airline_logo/<?php echo $OutstartLeg['carrier']['code']; ?>.gif" style=""/>
                       <br>
<small><?php echo $OutstartLeg['carrier']['name']; ?></small>
                                    </li>
                                    <li class="ft2">
                                        <?php echo date('D M d, Y', strtotime($OutstartLeg['depDetail']['time'])); ?> <br>
                                        <span class="grey"><?php echo $OutdepTime; ?></span><br>
                                        <b><?php echo $OutstartLeg['depDetail']['code']; ?> &#8594; <?php  echo $OutendLeg['arrDetail']['code']; ?></b><br>
                                    </li>
                                    <li class="ft3">
                                      
                                        <span class="grey"> <?php echo date('D M d, Y', strtotime($OutendLeg['arrDetail']['time'])); ?> </span><br>
                                        <b><?php echo $OutarvTime; ?></b><br>
                                    </li>
                                    <li class="ft4">
                                        <?php echo $outdurHour; ?>h <?php echo $outdurMin; ?>m<br>
                                        <span class="grey"><?php echo((count($segments['return'])-1) == 0?'Non-stop':(count($segments['return'])-1).' Stop'); ?></span><br>
                                         <?php echo $OutstartLeg['flightNo']; ?> -<?php echo $OutstartLeg['carrier']['code']; ?><br>
                                </li>
                                     <li class="ft5">
                                    <button class="lightbtn mt1 collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="false">More</button>
                                </li>
                                </ul>
                            <div class="clearfix"></div><br><br>
                        
                        </div>  
                    
                         <div class="frowexpand collapse" id="collapse<?php echo $i; ?>" aria-expanded="false" style="height: 1px;">
                            
                                 <?php $data['flight']=$flight; $this->load->view('flight_new/roundtrip_results_details',$data); ?>
                            <div class="clearfix"></div>
                        </div>
                        
                        <div class="fselect">
                      
                           
                       <b>Seats <?php echo $flight['seatsLeft'];?></b>
                       <a class="selectbtn mt1" class="href_<?php echo ($i+1);?>" href="javascript:void(0);" id="<?php echo $fareRules;?>" onclick="show_fare_popup(this.id,this,1)">Fare Rules</a>
                            <span class="size12 lightgrey">Roundtrip / per person</span> <span style="color:#333333;font-size: 31px;font-weight: 100;">&#8369;</span><span class="size18 green bold"> <?php echo number_format($totalFare,2,'.',','); ?></span>&nbsp;
                             <a onclick="window.location.href='<?php echo site_url(); ?>/flight/details/<?php echo $i; ?>';" class="selectbtn mt1" >SELECT NOW</a>
                        </div>
                    </div>

                    <!-- END OF FLIGHT TICKET-->

                     <?php 
                    $i++;
                }
                $Airlines = array_unique($airlineList);sort($airlineList);
            }else {
?>
<div class="alert alert-danger alert-dismissable fade in" style='width:100%;z-index:100;font-size: 17px;text-align: center;background-color: #eaabab;'>
    
    No Flights found for your Search. Kindly search again after some time or search again with different dates.
</div>

<?php
}
?>

             
       
    </div>
</div>
<input type="hidden" id="setMinPrice" value="<?php if(!empty($price)) echo min($price); else echo 0; ?>" />
<input type="hidden" id="setMaxPrice" value="<?php if(!empty($price)) echo max($price); else echo 0; ?>" />
<input type="hidden" id="setCurrency" value="<?php echo 'PHP';?>" />
<input type="hidden" id="setMinTime" value="0" />
<input type="hidden" id="setMaxTime" value="1440" />
<script type="text/javascript">
    



    $('#airline_list').append('<?php $i=1;foreach($Airlines as $airline){?><div  class="checkbox"  ><label style="font-weight:normal;width: 84%" for="airline<?php echo rand();?>" onclick="filter();"><span style="margin-top:3px;"><input id="airline<?php echo rand();?>" type="checkbox" name="airlines" class="air_filter" value="<?php echo $airline;?>" style="width:15px;height:15px;margin-right:10px;" checked="checked" onclick="filter();"></span><?php echo $airline;?></label></div><?php $i++; }?>');
</script>