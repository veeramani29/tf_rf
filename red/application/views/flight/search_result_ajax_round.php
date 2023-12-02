<style>
        .fli_round_ser table {
            border: 0px solid black;
            width: 100%;
        }
         .fli_round_ser table, th, td {
            border: 0px solid black;
            border-collapse: collapse;
        }
       .fli_round_ser1 td {
           width:20%;
            padding: 5px;
            text-align: left;
        }
       .fli_round_ser1 th{
             width:20%;
            padding: 5px;
            text-align: left;
        }
        .fli_round_ser  table#t01 tr {
            background-color: #fff;
        }
        .fli_round_ser table#t02 tr {
            border: 0px solid black;
        }
        /*table#t01 tr:nth-child(even) {
                background-color: #fff;
            }*/
        .fli_round_ser table#t01 th {
             width:20%;
             padding: 5px;
            background-color: #f74623;
            color: white;
            font-size: small;
        }
       
    </style>

    <div class="col-sm-8 col-md-9 fli_padright0 pa_res" >
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
            <div class="col-sm-6 fli_padleft0 pa_respo">
                <div class="panel-heading fli_padleft0">
                    <div class="row">
                        <div class="col-sm-12 " style="padding:0px;">
                            <?php echo $searchParms['from'] ?>&nbsp;<span class="glyphicon glyphicon-arrow-right">&nbsp;</span><?php echo $searchParms['to'] ?> ,<?php echo date('D, d M',strtotime($searchParms['sd'])); ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12 airbrg fli_round_ser" >
                            <table id="t01">
                                <tr class="fli_round_ser1">
                                    <th>AIRLINE</th>
                                    <th>DEPART</th>
                                    <th>ARRIVE</th>
                                    <th>DURATION</th>
                                    <th style="padding-left:14px;">PRICE</th>
                                </tr>
                            </table>

                        </div>
                        
                        <?php 
                            $adult = $searchParms['adult'];
                            $child = $searchParms['child'];
                            $infant = $searchParms['infant'];
                            $infantFare = 0;
                            $childFare = 0;
                            $totalFare_arr = array();
                            $RtotalFare_arr = array();  $airlineList = array();
                            if(isset($flights['via_data']) && $flights['via_data'] != '')
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
                                    <div class='searchflight_box'>
                                        <div class="col-sm-12 sort-by-section marbot_10 fli_round_ser FlightInfoBox" data-price="<?php echo number_format($totalFare,2,'.',''); ?>" data-stops="<?php echo (count($flight['flights'])-1); ?>" data-airlines="<?php echo $startLeg['carrier']['name']; ?>" data-depart="<?php echo $datedepArr[0]; ?>" data-arrival="<?php echo $dateOriArr[0]; ?>" data-duration="<?php echo $totalDur; ?>" data-departure="<?php //echo $depTimeFilter; ?>">
                                            <table id="t02">
                                                <tr class="fli_round_ser1">
                                                    <td>
                                                        <div class="icon">&nbsp;&nbsp;<input class="rat inbound" type="radio" name="inbound" value="<?php echo $i; ?>" data_show_id="<?php echo $i; ?>"/>&nbsp;&nbsp;<img src="<?php echo base_url(); ?>assets/images/airlines/icons/<?php echo $startLeg['carrier']['code']; ?>.gif" width="30" height="30" /><br />
                                                            <span class="flinum"> <?php echo $startLeg['carrier']['name'].'-'.$startLeg['flightNo']; ?></span>
                                                        </div>
                                                    </td>
                                                    <td style="padding-left:13px;"><?php echo $depTime; ?></td>
                                                    <td><?php echo $arvTime; ?></td>
                                                    <td><?php echo $durHour; ?>h <?php echo $durMin; ?>m<br /><span class="stp"><?php echo (count($flight['flights'])-1); ?> Stops</span></td>
                                                    <td><p><b>&#8369;<?php echo number_format($totalFare,2,'.',','); ?></b></p></td>
                                                </tr>
                                                <tr class="fli_round_ser1" style="background-color: #ffffff;">
                                                    <td colspan="2" class="flidet">
                                                        <a href="javascript:void(0);" onclick="showTfFlightDetailsRtDom('<?php echo $i; ?>','outward');" class="afli">
                                                            <span class="glyphicon glyphicon-align-justify" aria-hidden="true" ></span>
                                                            Flight Details
                                                        </a>
                                                        | 

                                            <span class="f_color" style="font-size: 9px;"> <a class="href_<?php echo ($i+1);?>" href="javascript:void(0);" id="<?php echo $fareRules;?>" onclick="show_fare_popup(this.id,this,1)">Fare Rules</a></span>
                                                    </td>
                                                    
                                                    <td colspan="3" class="smal"><span style="font-size:x-small">
                                                     <?php if($startLeg['layover']!=0){ ?>
                                            <a class="button btn-mini "><?php echo gmdate("H:i", ($startLeg['layover'] * 60)); ?> Layover</a>
<?php } ?>

                                                        <?php 
                                                            if($startLeg['amenities']['meal']==1) { echo 'Meal Available'; }
                                                            if($startLeg['amenities']['meal']!=1) { echo 'Meal Not Included'; }
                                                           
                                                        ?>
                                                            |<?php echo $flight['seatsLeft'].' Seats Left' ?></span></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
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
                </div>
            </div>

            <div class="col-sm-6 fli_padright0 pa_respo pa_res">
                <div class="panel-heading fli_padleft0">
                    <div class="row">
                        <div class="col-sm-12" style="padding:0px;">
                            <?php echo $searchParms['to'] ?>&nbsp;<span class="glyphicon glyphicon-arrow-right">&nbsp;</span><?php echo $searchParms['from'] ?> ,<?php echo date('D, d M',strtotime($searchParms['ed'])); ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12 fli_round_ser" style="background-color: #f74623;" >
                            <table id="t01">
                                <tr class="fli_round_ser1">
                                    <th>AIRLINE</th>
                                    <th>DEPART</th>
                                    <th>ARRIVE</th>
                                    <th>DURATION</th>
                                    <th style="padding-left:14px;">PRICE</th>
                                </tr>
                            </table>
                        </div>
                        
                        <?php 
                            //echo '<pre />';print_r($_SESSION['via']);die;
                            $flight = ''; $RetairlineList = array();
                                  
                            if(isset($flights['via_data']) && $flights['via_data'] != '')
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

                                    $arvDetails = $startLeg['arrDetail']['time'];
                                    $dateStructArr = explode('.', $arvDetails);
                                    $dateOriArr = explode(' ', $dateStructArr[0]);
                                    $dateArrHM = explode(':', $dateOriArr[1]);
                                    $arvTime = $dateArrHM[0].":".$dateArrHM[1];


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
                                    <div class='Rsearchflight_box'>
                                        <div class="col-sm-12 sort-by-section srtsec fli_round_ser RFlightInfoBox" data-Rprice='<?php echo number_format($totalFareR,2,'.',''); ?>' data-Rstops="<?php echo (count($flight['flights'])-1); ?>" data-Rairlines="<?php echo $startLeg['carrier']['name']; ?>" data-Rdepart="<?php echo $datedepArr[0]; ?>" data-Rarrival="<?php echo $dateOriArr[0]; ?>" data-Rduration="<?php echo $totalDur; ?>" data-Rdeparture="<?php //echo $depTimeFilter; ?>">
                                            <table id="t02">
                                                <tr class="fli_round_ser1">
                                                    <td>
                                                        <div class="icon">&nbsp;&nbsp;<input  class="rat outbound" type="radio" name="outbound" value="<?php echo $i; ?>" />&nbsp;&nbsp;<img src="<?php echo base_url(); ?>assets/images/airlines/icons/<?php echo $startLeg['carrier']['code']; ?>.gif" width="30" height="30" /><br />
                                                            <span class="leg"> <?php echo $startLeg['carrier']['name'].'-'.$startLeg['flightNo']; ?></span>
                                                        </div>
                                                    </td>
                                                    <td style="padding-left:13px;"><?php echo $depTime; ?></td>
                                                    <td><?php echo $arvTime; ?></td>
                                                    <td><?php echo $durHour; ?>h <?php echo $durMin; ?>m<br /><span style="font-size:x-small;font-weight:bold;"><?php echo (count($flight['flights'])-1); ?> Stops</span></td>
                                                    <td><p><b>&#8369;<?php echo number_format($totalFareR,2,'.',','); ?></b></p></td>
                                                </tr>
                                                <tr  class="fli_round_ser1" style="background-color: #ffffff;">
                                                    <td colspan="2" style="padding-left: 13px;">
                                                        <a href="javascript:void(0);" onclick="showTfFlightDetailsRtDom('<?php echo $i; ?>','return');" style="width:100%; text-align:left; background-color: #ffffff; font-size:12px; border: none; color: #827F7F;">
                                                            <span class="glyphicon glyphicon-align-justify" aria-hidden="true" ></span>
                                                            Flight Details
                                                        </a>
                                                        | 

                                            <span class="f_color" style="font-size: 9px;"> <a class="href_<?php echo ($i+1);?>" href="javascript:void(0);" id="<?php echo $fareRules;?>" onclick="show_fare_popup(this.id,this,1)">Fare Rules</a></span>
                                                    </td>
                                                    
                                                    <td colspan="3" class="meal"><span style="font-size:x-small">
                                                     <?php if($startLeg['layover']!=0){ ?>
                                            <a class="button btn-mini "><?php echo gmdate("H:i", ($startLeg['layover'] * 60)); ?> Layover</a>
<?php } ?>

                                                         <?php 
                                                            if($startLeg['amenities']['meal']==1) { echo 'Meal Available'; }
                                                            if($startLeg['amenities']['meal']!=1) { echo 'Meal Not Included'; }
                                                           
                                                        ?>
                                                            |<?php echo $flight['seatsLeft'].' Seats Left' ?></span></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
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
            </div>
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

     $('#airline_list').append('<?php $i=1;foreach($Airlines as $airline){?><li style="width: 100%;padding: 7px 0 5px 15px;" ><label style="font-weight:normal;width: 84%" for="airline<?php echo rand();?>" onclick="filter();"><span style="margin-top:3px;"><input id="airline<?php echo rand();?>" type="checkbox" name="airlines" class="air_filter" value="<?php echo $airline;?>" style="width:15px;height:15px;margin-right:10px;" checked="checked" onclick="filter();"></span><?php echo $airline;?></label></li><?php $i++; }?>');

      $('#airlines-filter').append('<?php $i=1;foreach($RetAirlines as $airline){?><li style="width: 100%;padding: 7px 0 5px 15px;" ><label style="font-weight:normal;width: 84%" for="airline<?php echo rand();?>" onclick="filter_round();"><span style="margin-top:3px;"><input id="airline<?php echo rand();?>" type="checkbox" name="airlines" class="Rair_filter" value="<?php echo $airline;?>" style="width:15px;height:15px;margin-right:10px;" checked="checked" onclick="filter_round();"></span><?php echo $airline;?></label></li><?php $i++; }?>');
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