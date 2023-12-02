 <div class="row">
            <div class="sort-by-section srtby">
                <div class="col-md-12" id="show_select_flight">
                <div id="select_text" class="pad20">
                        Select Your Onward Flight And Return Flight By Selecting The Check Boxes.
                </div>
                <div class="col-sm-5" id="small_progress" style="display:none;">
                    <img src="<?php echo base_url(); ?>assets/images/small_loader.gif" style="margin:20px;">
                </div>
                <div class="col-sm-5" id="show_inbound" style="display:none;">
                    
                </div>
                <div class="col-sm-5" id="small_progress1" style="display:none;">
                    <img src="<?php echo base_url(); ?>assets/images/small_loader.gif" style="margin:20px;">
                </div>
                <div class="col-sm-5" id="show_outbound" style="display:none;">
                    
                </div>
                <div class="col-sm-2 pull-right" id="show_price" style="display:none;">
                    
                </div>
                    </div>
            </div>
            </div>


 <div class="row">
<div class="col-sm-6" id="onward_results">


 <?php 
                            $adult = $searchParms['adult'];
                            $child = $searchParms['child'];
                            $infant = $searchParms['infant'];
                            $infantFare = 0;
                            $childFare = 0;
                            $totalFare_arr = array();
                            $RtotalFare_arr = array();  $airlineList = array();
                            if(isset($flights['via_data']) && !empty($flights['via_data']))
                            {
                                $data = $flights['via_data']['Inbound'];
                                
                                $i = 0;
                                foreach($data as $flight)
                                {

                                   // print_r($flight);

                                     $startLeg = reset($flight['flights']);
                                    $endLeg = end($flight['flights']);

                                    $depDetails = $startLeg['depDetail']['time'];
                                    $depDetailsArr = explode('.', $depDetails);
                                    $datedepArr = explode(' ', $depDetailsArr[0]);
                                    $datedepHM = explode(':', $datedepArr[1]);
                                    $depTime = $datedepHM[0].":".$datedepHM[1];

                                    $arvDetails = $endLeg['arrDetail']['time'];
                                    $dateStructArr = explode('.', $arvDetails);
                                    $dateOriArr = explode(' ', $dateStructArr[0]);
                                    $dateArrHM = explode(':', $dateOriArr[1]);
                                    $arvTime = $dateArrHM[0].":".$dateArrHM[1];

                 $DepartureDateTime = $dpt = strtotime($startLeg['depDetail']['time']);
 $ArrivalDateTime = $art = strtotime($endLeg['arrDetail']['time']);

                                    $duration = explode(':',gmdate("H:i", ($flight['journeyInfo'][0]['journeyTime']*60)));
                                    $durHour = $duration[0];
                                    $durMin = $duration[1];
                                    $totalDur = $flight['journeyInfo'][0]['journeyTime'];
                                      $fareRules = $flight['key'];
                                    $adultFare = ($flight['fares']['paxFares']['adt']['total']['amount']*$adult);
                                    if($child > 0)
                                    {
                                        $childFare = ($flight['fares']['paxFares']['chd']['total']['amount']*$child);
                                    }
                                    if($infant > 0)
                                    {
                                        $infantFare = ($flight['fares']['paxFares']['inf']['total']['amount']*$infant);
                                    }
                                    $totalFare = ($adultFare+$childFare+$infantFare);
                                    if(array_key_exists($startLeg['carrier']['code'],$admin_markup)){
                                        $airCode = $startLeg['carrier']['code'];
                                        if($admin_markup['type'] == 'fixed'){
                                            $adminMark = ($admin_markup[$airCode]);
                                            $totalFare = ($totalFare+$adminMark);
                                        } else {
                                            $adminMark = (($admin_markup[$airCode]/100)*$totalFare);
                                            $totalFare = ($adminMark+$totalFare);
                                        }
                                    }
                                    
                                    if(array_key_exists($startLeg['carrier']['code'],$agent_markup)){
                                        $airCode = $startLeg['carrier']['code'];
                                        if($agent_markup['type'] == 'fixed'){
                                            $agentMark = ($agent_markup[$airCode]);
                                            $totalFare = ($totalFare+$agentMark);
                                        } else {
                                            $agentMark = (($agent_markup[$airCode]/100)*$totalFare);
                                            $totalFare = ($agentMark+$totalFare);
                                        }
                                    }
                                    
                                    $airlineList[]=$startLeg['carrier']['name'];
                                    $airlineList[]=$endLeg['carrier']['name'];
                                    $totalFare_arr[] = number_format($totalFare,2,'.','');
                            ?>

<!-- FLIGHT TICKET-->
<div class='searchflight_box'>
<div id="onward<?php echo $i; ?>" class="offset-2 col-sm-12 FlightInfoBox" data-price="<?php echo number_format($totalFare,2,'.',''); ?>" data-stops="<?php echo (count($flight['flights'])-1); ?>" data-airlines="<?php echo $startLeg['carrier']['name']; ?>" data-depart="<?php echo $DepartureDateTime; ?>" data-arrival="<?php echo $ArrivalDateTime; ?>" data-duration="<?php echo $totalDur; ?>" data-departure="<?php //echo $depTimeFilter; ?>">
                        
                        
                        <div class="clearfix margtop40">
                            <div class="col-sm-12 paddingg">

                            <div class="fblueline"><b><?php echo $startLeg['depDetail']['city']; ?></b> <?php echo $startLeg['depDetail']['name']; ?> <span class="farrow"></span> <b><?php echo $endLeg['arrDetail']['city']; ?></b> <?php echo $endLeg['arrDetail']['name']; ?></div>

                                <!-- GOING TICKET-->
                                <div class="frow2">
                                    
                                    <ul class="flightstable mt20">
                                        <li class="ft1">
                                          <img src="<?php echo base_url(); ?>assets/images/airlines/icons/<?php echo $startLeg['carrier']['code']; ?>.gif" width="30" height="30" /><br />
                                                            <span class="leg"> <?php echo $startLeg['carrier']['name']; ?></span>
                                        </li>
                                        <li class="ft2">
                                                <div class="radio radiomargin0">
                                                  <label>
                                                   <input class="rat inbound" type="radio" name="inbound" value="<?php echo $i; ?>" data_show_id="<?php echo $i; ?>"/>
                                                    Departure
                                                  </label>
                                                </div>
                                                <span class="grey"><?php echo $dateOriArr[0] ;?> </span><br>
                                                <span class="size16 dark bold"><?php echo $depTime; ?></span><br>
                                        </li>
                                        <li class="ft3">
                                                Arrival<br>
                                                <span class="grey"><?php echo $datedepArr[0];?></span><br>
                                                <span class="size16 dark bold"><?php echo $arvTime; ?></span><br>
                                        </li>
                                        <li class="ft4">
                                                <?php echo $durHour; ?>h <?php echo $durMin; ?>m<br>
                                                <span class="grey"><?php echo (count($flight['flights'])-1); ?> Stops</span><br>
                                                <?php echo $startLeg['carrier']['code'].'-'.$startLeg['flightNo']; ?><br>
                                        </li>
                                        <li class="ft5">

                                         <?php if($startLeg['layover']!=0){ ?>
                                            <a class="button btn-mini "><?php echo gmdate("H:i", ($startLeg['layover'] * 60)); ?> Layover</a>
<?php } ?>

                                                         <?php 
                                                            if($startLeg['amenities']['meal']==1) { echo 'Meal Available'; }
                                                            if($startLeg['amenities']['meal']!=1) { echo 'Meal Not Included'; }
                                                           
                                                        ?>
                                                            |<?php echo $flight['seatsLeft'].' Seats Left' ?></span>
                                            <button class="lightbtn mt1" type="button" data-toggle="collapse" data-target="#onward_collapse<?php echo $i; ?>">More</button>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div><br><br>

                                </div>
                                <div class="collapse frowexpand" id="onward_collapse<?php echo $i; ?>">
                                           <?php $data['flight']=$flight; $this->load->view('flight_new/roundtrip_dom_results_details',$data); ?>     
                                                <button class="hidebtn mt1" type="button" data-toggle="collapse" data-target="#onward_collapse<?php echo $i; ?>">Hide</button>
                                       
                                      
                                        

                                    <div class="clearfix"></div>
                                </div>
                                <div class="fselect">

                                    <a class="selectbtn mt1 href_<?php echo ($i+1);?>" href="javascript:void(0);" id="<?php echo $fareRules;?>" onclick="show_fare_popup(this.id,this,1)">Fare Rules</a>
                                    <span class="size12 lightgrey">Onward / per person</span> <span class="size18 green bold"><b>&#8369;<?php echo number_format($totalFare,2,'.',','); ?></b></span>&nbsp; <button class="selectbtn mt1" type="button">

                                    Select</button>  

                                </div>
                                <!-- END OF GOING TICKET-->
                            </div>
                          
                        </div>
                        </div>
                    </div>
                    <!-- END OF FLIGHT TICKET-->

                      <?php
                                    $i++;
                                }
                            } else {
                        ?>
                                <div class="alert alert-danger alert-dismissable fade in" style='width:100%;z-index:100;font-size: 15px;text-align: center;background-color: #eaabab;'>
                                     Oop's! Onward flight not found.Search Again.
                                </div>
                        <?php
                            }
                        ?>

                    </div>


                    <div class="col-sm-6" id="return_results">

                      <?php 
                            //echo '<pre />';print_r($_SESSION['via']);die;
                            $flight = ''; $RetairlineList = array();
                                  
                            if(isset($flights['via_data']) && !empty($flights['via_data']))
                            {
                                $data_round = $flights['via_data']['Outbound'];
                                $childFare = 0;
                                $infantFare = 0;
                                $i = 0;
                                foreach($data_round as $flight)
                                {
                                   $startLeg = reset($flight['flights']);
                                    $endLeg = end($flight['flights']);

                                    $depDetails = $startLeg['depDetail']['time'];
                                    $depDetailsArr = explode('.', $depDetails);
                                    $datedepArr = explode(' ', $depDetailsArr[0]);
                                    $datedepHM = explode(':', $datedepArr[1]);
                                    $depTime = $datedepHM[0].":".$datedepHM[1];

                                    $arvDetails = $endLeg['arrDetail']['time'];
                                    $dateStructArr = explode('.', $arvDetails);
                                    $dateOriArr = explode(' ', $dateStructArr[0]);
                                    $dateArrHM = explode(':', $dateOriArr[1]);
                                    $arvTime = $dateArrHM[0].":".$dateArrHM[1];
  $DepartureDateTime = $dpt = strtotime($startLeg['depDetail']['time']);
 $ArrivalDateTime = $art = strtotime($endLeg['arrDetail']['time']);
                                    $duration = explode(':',gmdate("H:i", ($flight['journeyInfo'][0]['journeyTime']*60)));
                                    $durHour = $duration[0];
                                    $durMin = $duration[1];
                                    $totalDur = $flight['journeyInfo'][0]['journeyTime'];
                                      $fareRules = $flight['key'];
                                    $adultFare = ($flight['fares']['paxFares']['adt']['total']['amount']*$adult);
                                    if($child > 0)
                                    {
                                        $childFare = ($flight['fares']['paxFares']['chd']['total']['amount']*$child);
                                    }
                                    if($infant > 0)
                                    {
                                        $infantFare = ($flight['fares']['paxFares']['inf']['total']['amount']*$infant);
                                    }
                                    $totalFareR = ($adultFare+$childFare+$infantFare);
                                    if(array_key_exists($startLeg['carrier']['code'],$admin_markup)){
                                        $airCode = $startLeg['carrier']['code'];
                                        if($admin_markup['type'] == 'fixed'){
                                            $adminMark = ($admin_markup[$airCode]);
                                           $totalFareR = ($totalFareR+$adminMark);
                                        } else {
                                            $adminMark = (($admin_markup[$airCode]/100)*$totalFareR);
                                            $totalFareR = ($adminMark+$totalFareR);
                                        }
                                    }
                                    
                                    if(array_key_exists($startLeg['carrier']['code'],$agent_markup)){
                                        $airCode = $startLeg['carrier']['code'];
                                        if($agent_markup['type'] == 'fixed'){
                                            $agentMark = ($agent_markup[$airCode]);
                                            $totalFareR = ($totalFareR+$agentMark);
                                        } else {
                                            $agentMark = (($agent_markup[$airCode]/100)*$totalFareR);
                                            $totalFareR = ($agentMark+$totalFareR);
                                        }
                                    }
                                    
                                  
                                 
                                     $RetairlineList[]=$startLeg['carrier']['name'];
                                    $RetairlineList[]=$endLeg['carrier']['name'];
                                    
                                   
                                    $RtotalFare_arr[] = number_format($totalFareR,2,'.','');
                            ?>
                                    
<!-- FLIGHT TICKET-->
<div class='Rsearchflight_box'>
<div id="return<?php echo $i; ?>" class="offset-2 col-sm-12 RFlightInfoBox" data-Rprice='<?php echo number_format($totalFareR,2,'.',''); ?>' data-Rstops="<?php echo (count($flight['flights'])-1); ?>" data-Rairlines="<?php echo $startLeg['carrier']['name']; ?>" data-Rdepart="<?php echo $DepartureDateTime; ?>" data-Rarrival="<?php echo $ArrivalDateTime; ?>" data-Rduration="<?php echo $totalDur; ?>" data-Rdeparture="<?php //echo $depTimeFilter; ?>">
                        
                        
                        <div class="clearfix margtop40">
                         
                            <div class="col-sm-12 paddingg">
                              
                           <div class="fgreenline"><b><?php echo $startLeg['depDetail']['city']; ?></b> <?php echo $startLeg['depDetail']['name']; ?> <span class="farrow"></span> <b><?php echo $endLeg['arrDetail']['city']; ?></b> <?php echo $endLeg['arrDetail']['name']; ?></div>
                                <!-- RETURNING TICKET-->
                                <div class="frow2">
                                
                                    <ul class="flightstable mt20">
                                     <li class="ft1">
                                          <img src="<?php echo base_url(); ?>assets/images/airlines/icons/<?php echo $startLeg['carrier']['code']; ?>.gif" width="30" height="30" /><br />
                                                            <span class="leg"> <?php echo $startLeg['carrier']['name']; ?></span>
                                        </li>
                                        <li class="ft2">
                                                <div class="radio radiomargin0">
                                                  <label>
                                                   <input class="rat outbound" type="radio" name="outbound" value="<?php echo $i; ?>" data_show_id="<?php echo $i; ?>"/>
                                                    Departure
                                                  </label>
                                                </div>
                                                <span class="grey"><?php echo $dateOriArr[0] ;?> </span><br>
                                                <span class="size16 dark bold"><?php echo $depTime; ?></span><br>
                                        </li>
                                        <li class="ft3">
                                                Arrival<br>
                                                <span class="grey"><?php echo $datedepArr[0];?></span><br>
                                                <span class="size16 dark bold"><?php echo $arvTime; ?></span><br>
                                        </li>
                                        <li class="ft4">
                                                <?php echo $durHour; ?>h <?php echo $durMin; ?>m<br>
                                                <span class="grey"><?php echo (count($flight['flights'])-1); ?> Stops</span><br>
                                                <?php echo $startLeg['carrier']['code'].'-'.$startLeg['flightNo']; ?><br>
                                        </li>
                                        <li class="ft5">

                                         <?php if($startLeg['layover']!=0){ ?>
                                            <a class="button btn-mini "><?php echo gmdate("H:i", ($startLeg['layover'] * 60)); ?> Layover</a>
<?php } ?>

                                                         <?php 
                                                            if($startLeg['amenities']['meal']==1) { echo 'Meal Available'; }
                                                            if($startLeg['amenities']['meal']!=1) { echo 'Meal Not Included'; }
                                                           
                                                        ?>
                                                            |<?php echo $flight['seatsLeft'].' Seats Left' ?></span>
                                            <button class="lightbtn mt1" type="button" data-toggle="collapse" data-target="#return_collapse<?php echo $i; ?>">More</button>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div><br><br>
                                
                                </div>  
                                <div class="collapse frowexpand" id="return_collapse<?php echo $i; ?>">                    

                                <?php $data['flight']=$flight; $this->load->view('flight_new/roundtrip_dom_results_details',$data); ?>                    
                                      
                                                <button class="hidebtn mt1" type="button" data-toggle="collapse" data-target="#return_collapse<?php echo $i; ?>">Hide</button>
                                                                                

                                    <div class="clearfix"></div>
                                </div>
                                <!-- END OF RETURNING TICKET -->
                                <div class="fselect">
                                    <a class="selectbtn mt1 href_<?php echo ($i+1);?>" href="javascript:void(0);" id="<?php echo $fareRules;?>" onclick="show_fare_popup(this.id,this,1)">Fare Rules</a>
                                    <span class="size12 lightgrey">Return / per person</span> <span class="size18 green bold"><b>&#8369;<?php echo number_format($totalFareR,2,'.',','); ?></b></span>&nbsp; <button class="selectbtn mt1" type="button">

                                    Select</button>  
                                </div>                                
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- END OF FLIGHT TICKET-->
 <?php
                                    $i++;
                                }
                            } else {
                        ?>
                                <div class="alert alert-danger alert-dismissable fade in" style='width:100%;z-index:100;font-size: 15px;text-align: center;background-color: #eaabab;'>
                                     Oop's! Return flight not found.Search Again.
                                </div>
                        <?php
                            }
                        ?>
                    </div>

                    </div>



                    <?php  $Airlines = array_unique($airlineList);sort($airlineList);
     $RetAirlines = array_unique($RetairlineList);sort($RetairlineList);
     if(isset($flights['via_data']) && $flights['via_data'] != ''){ ?>
    <input type="hidden" id="setMinPrice" value="<?php if(!empty($totalFare_arr)) echo min($totalFare_arr); else echo 0; ?>" />
    <input type="hidden" id="setMaxPrice" value="<?php if(!empty($totalFare_arr)) echo max($totalFare_arr); else echo 0; ?>" />
    <input type="hidden" id="RsetMinPrice" value="<?php if(!empty($RtotalFare_arr)) echo min($RtotalFare_arr); else echo 0; ?>" />
    <input type="hidden" id="RsetMaxPrice" value="<?php if(!empty($RtotalFare_arr)) echo max($RtotalFare_arr); else echo 0; ?>" />
    <input type="hidden" id="RsetCurrency" value="<?php echo '&#8369;';?>" />
    <input type="hidden" id="setCurrency" value="<?php echo '&#8369;';?>" />
    <?php } else { ?>
    <input type="hidden" id="setMinPrice" value="0" />
    <input type="hidden" id="setMaxPrice" value="0" />
    <input type="hidden" id="RsetMinPrice" value="0" />
    <input type="hidden" id="RsetMaxPrice" value="0" />
    <input type="hidden" id="RsetCurrency" value="<?php echo '&#8369;';?>" />
    <input type="hidden" id="setCurrency" value="<?php echo '&#8369;';?>" />
    <?php } ?>
    <script type="text/javascript">

     $('#airline_list').append('<?php $i=1;foreach($Airlines as $airline){?><div class="checkbox" ><label style="font-weight:normal;width: 84%" for="airline<?php echo rand();?>" onclick="filter();"><span style="margin-top:3px;"><input id="airline<?php echo rand();?>" type="checkbox" name="airlines" class="air_filter" value="<?php echo $airline;?>" style="width:15px;height:15px;margin-right:10px;" checked="checked" onclick="filter();"></span><?php echo $airline;?></label></div><?php $i++; }?>');

      $('#Rairlines-filter').append('<?php $i=1;foreach($RetAirlines as $airline){?><div class="checkbox"  ><label style="font-weight:normal;width: 84%" for="airline<?php echo rand();?>" onclick="filter_round();"><span style="margin-top:3px;"><input id="airline<?php echo rand();?>" type="checkbox" name="airlines" class="Rair_filter" value="<?php echo $airline;?>" style="width:15px;height:15px;margin-right:10px;" checked="checked" onclick="filter_round();"></span><?php echo $airline;?></label></div><?php $i++; }?>');
        function toggle(id) {
            var e = document.getElementById('tog' + id);

            if (e.style.display == 'block')
                e.style.display = 'none';
            else
                e.style.display = 'block';
        }
        
        function toggleR(id) {
            var e = document.getElementById('togR' + id);

            if (e.style.display == 'block')
                e.style.display = 'none';
            else
                e.style.display = 'block';
        }
        
        
        
        $(document).on("click",".inbound",function(e){
           // alert( "Handler for .click() called." );
            if ($('input[name=inbound]:checked').length > 0) 
            {
                if($('input[name=outbound]:checked').length > 0)
                {
                    var outId = $('input[name=outbound]:checked').val();
                }
                else
                {
                    var outId = '';
                }
                
                var id = $('input[name=inbound]:checked').val();
                $.ajax({
                            url: Site_Url+'/flight/showInboundFlight/',             
                            data: 'flightId='+id+'&outId='+outId,
                            dataType: 'json',               
                            type: 'post',
                            beforeSend: function()
                            {
                                $('#small_progress').show();
                            },
                            success: function (data) {
                                $('#small_progress').hide();
                                $('#select_text').hide();
                                $('#show_inbound').html(data.show_inbound);
                                $('#show_price').html(data.show_price);
                                $('#show_inbound').show();
                                $('#show_price').show();
                            }

                    });
            }
        });
        
       $( ".outbound" ).click(function() {
           // alert( "Handler for .click() called." );
            if ($('input[name=outbound]:checked').length > 0) 
            {
                if($('input[name=inbound]:checked').length > 0)
                {
                    var outId = $('input[name=inbound]:checked').val();
                }
                else
                {
                    var outId = '';
                }
                
                var id = $('input[name=outbound]:checked').val();
                $.ajax({
                            url: Site_Url+'/flight/showOutboundFlight/',                
                            data: 'flightId='+id+'&outId='+outId,
                            dataType: 'json',               
                            type: 'post',
                            beforeSend: function()
                            {
                                $('#small_progress1').show();
                            },
                            success: function (data) {
                                $('#small_progress1').hide();
                                $('#select_text').hide();
                                $('#show_outbound').html(data.show_outbound);
                                $('#show_price').html(data.show_price);
                                $('#show_outbound').show();
                                $('#show_price').show();
                            }

                    });
            }
        });
      
        function checkBothFlight()
        {
            var id = $('input[name=inbound]:checked').val();
            var outId = $('input[name=outbound]:checked').val();
            
            //alert(id+'----'+outId);
            if(id === '' || id === undefined)
            {
                alert('Select Your Onward Flight');
                return false;
            }
            else if(outId === '' || outId === undefined)
            {
                alert('Select Your Return Flight');
                return false;
            }
            else
            {
                window.location.href = Site_Url+'/flight/details/'+id+'/'+outId;
            }
        }
   
    </script>