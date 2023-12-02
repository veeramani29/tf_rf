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

    <div class="col-sm-8 col-md-9 fli_padright0" >
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
            <div class="col-sm-6 fli_padleft0">
                <div class="panel-heading fli_padleft0">
                    <div class="row">
                        <div class="col-sm-12 " style="padding:0px;">
                            <?php echo $searchParms['from'] ?>&nbsp;<span class="glyphicon glyphicon-arrow-right">&nbsp;</span><?php echo $searchParms['to'] ?> <?php echo date('D, d M',strtotime($searchParms['sd'])); ?>
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
                            if(isset($flights['via_data']) && $flights['via_data'] != '')
                            {
                                $data = $flights['via_data']['Inbound'];
                                
                                $i = 0;
                                foreach($data as $flight)
                                {
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
                                    $adultFare = ($flight['adult_fare']*$adult);
                                    if($child > 0)
                                    {
                                        $childFare = ($flight['child_fare']*$child);
                                    }
                                    if($infant > 0)
                                    {
                                        $infantFare = ($flight['infant_fare']*$child);
                                    }
                                    $totalFare = ($adultFare+$childFare+$infantFare);
                                    if(array_key_exists($flight['legs'][0]['Carrier_code'],$admin_markup)){
                                        $airCode = $flight['legs'][0]['Carrier_code'];
                                        if($admin_markup['type'] == 'fixed'){
                                            $totalFare = ($totalFare+$admin_markup[$airCode]);
                                        } else {
                                            $totalFare = ((($admin_markup[$airCode]/100)*$totalFare)+$totalFare);
                                        }
                                    }
                            ?>
                                    <div class="col-sm-12  sort-by-section marbot_10 fli_round_ser">
                                            <table id="t02">
                                                <tr class="fli_round_ser1">
                                                    <td>
                                                        <div class="icon">&nbsp;&nbsp;<input class="rat inbound" type="radio" name="inbound" value="<?php echo $i; ?>" data_show_id="<?php echo $i; ?>"/>&nbsp;&nbsp;<img src="<?php echo base_url(); ?>assets/images/airlines/icons/<?php echo $flight['legs'][0]['Carrier_code']; ?>.gif" width="30" height="30" /><br />
                                                            <span class="flinum"> <?php echo $flight['legs'][0]['Carrier_code'].'-'.$flight['legs'][0]['FlightNumber']; ?></span>
                                                        </div>
                                                    </td>
                                                    <td style="padding-left:13px;"><?php echo $depTime; ?></td>
                                                    <td><?php echo $arvTime; ?></td>
                                                    <td><?php echo $durHour; ?>h <?php echo $durMin; ?>m<br /><span class="stp"><?php echo $flight['stops']; ?> Stops</span></td>
                                                    <td><p><b>&#8369;<?php echo number_format($totalFare,2,'.',','); ?></b></p></td>
                                                </tr>
                                                <tr class="fli_round_ser1" style="background-color: #ffffff;">
                                                    <td colspan="2" class="flidet">
                                                        <a href="javascript:void(0);" onclick="showTfFlightDetailsRtDom('<?php echo $flight['id']; ?>','outward');" class="afli">
                                                            <span class="glyphicon glyphicon-align-justify" aria-hidden="true" ></span>
                                                            Flight Details
                                                        </a>
                                                    </td>
                                                    
                                                    <td colspan="3" class="smal"><span style="font-size:x-small">
                                                        <?php 
                                                            if($flight['legs'][0]['MealInfo']=='Meal Available') { echo 'Meal Available'; }
                                                            if($flight['legs'][0]['MealInfo']=='Not Included') { echo 'Meal Not Included'; }
                                                            if($flight['legs'][0]['MealInfo']=='') { echo 'Meal Not Available'; }
                                                        ?>
                                                            |<?php echo($flight['legs'][0]['Refundable']=='true'?'Non-Refundable':'Refundable'); ?>|<?php echo $flight['legs'][0]['SeatLeft'].' Seats Left' ?></span></td>
                                                </tr>
                                            </table>
                                        </div>
                            <?php
                                    $i++;
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 fli_padright0">
                <div class="panel-heading fli_padleft0">
                    <div class="row">
                        <div class="col-sm-12" style="padding:0px;">
                            <?php echo $searchParms['to'] ?>&nbsp;<span class="glyphicon glyphicon-arrow-right">&nbsp;</span><?php echo $searchParms['from'] ?> <?php echo date('D, d M',strtotime($searchParms['ed'])); ?>
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
                            $flight = '';
                            if(isset($flights['via_data']) && $flights['via_data'] != '')
                            {
                                $data_round = $flights['via_data']['Outbound'];
                                $childFare = 0;
                                $infantFare = 0;
                                $i = 0;
                                foreach($data_round as $flight)
                                {
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
                                    $adultFare = ($flight['adult_fare']*$adult);
                                    if($child > 0)
                                    {
                                        $childFare = ($flight['child_fare']*$child);
                                    }
                                    if($infant > 0)
                                    {
                                        $infantFare = ($flight['infant_fare']*$child);
                                    }
                                    $totalFareR = ($adultFare+$childFare+$infantFare);
                                    if(array_key_exists($flight['legs'][0]['Carrier_code'],$admin_markup)){
                                        $airCode = $flight['legs'][0]['Carrier_code'];
                                        if($admin_markup['type'] == 'fixed'){
                                            $totalFareR = ($totalFareR+$admin_markup[$airCode]);
                                        } else {
                                            $totalFareR = (($admin_markup[$airCode]/100)*$totalFareR);
                                        }
                                    }
                            ?>
                                    <div class="col-sm-12  sort-by-section srtsec fli_round_ser">
                                            <table id="t02">
                                                <tr class="fli_round_ser1">
                                                    <td>
                                                        <div class="icon">&nbsp;&nbsp;<input  class="rat outbound" type="radio" name="outbound" value="<?php echo $i; ?>" />&nbsp;&nbsp;<img src="<?php echo base_url(); ?>assets/images/airlines/icons/<?php echo $flight['legs'][0]['Carrier_code']; ?>.gif" width="30" height="30" /><br />
                                                            <span class="leg"> <?php echo $flight['legs'][0]['Carrier_code'].'-'.$flight['legs'][0]['FlightNumber']; ?></span>
                                                        </div>
                                                    </td>
                                                    <td style="padding-left:13px;"><?php echo $depTime; ?></td>
                                                    <td><?php echo $arvTime; ?></td>
                                                    <td><?php echo $durHour; ?>h <?php echo $durMin; ?>m<br /><span style="font-size:x-small;font-weight:bold;"><?php echo $flight['stops']; ?> Stops</span></td>
                                                    <td><p><b>&#8369;<?php echo number_format($totalFareR,2,'.',','); ?></b></p></td>
                                                </tr>
                                                <tr  class="fli_round_ser1" style="background-color: #ffffff;">
                                                    <td colspan="2" style="padding-left: 13px;">
                                                        <a href="javascript:void(0);" onclick="showTfFlightDetailsRtDom('<?php echo $flight['id']; ?>','return');" style="width:100%; text-align:left; background-color: #ffffff; font-size:12px; border: none; color: #827F7F;">
                                                            <span class="glyphicon glyphicon-align-justify" aria-hidden="true" ></span>
                                                            Flight Details
                                                        </a>
                                                    </td>
                                                    
                                                    <td colspan="3" class="meal"><span style="font-size:x-small">
                                                        <?php 
                                                            if($flight['legs'][0]['MealInfo']=='Meal Available') { echo 'Meal Available'; }
                                                            if($flight['legs'][0]['MealInfo']=='Not Included') { echo 'Meal Not Included'; }
                                                            if($flight['legs'][0]['MealInfo']=='') { echo 'Meal Not Available'; }
                                                        ?>
                                                          |<?php echo($flight['legs'][0]['Refundable']=='true'?'Non-Refundable':'Refundable'); ?>|<?php echo $flight['legs'][0]['SeatLeft'].' Seats Left' ?></span></td>
                                                </tr>
                                            </table>
                                        </div>
                            <?php
                                    $i++;
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="setMinPrice" value="<?php if(!empty($min)) echo round($min); else echo 0; ?>" />
    <input type="hidden" id="setMaxPrice" value="<?php if(!empty($max)) echo round($max); else echo 0; ?>" />
    <input type="hidden" id="setCurrency" value="<?php echo 'PHP';?>" />
    <input type="hidden" id="setMinTime" value="0" />
    <input type="hidden" id="setMaxTime" value="1440" />
    <script type="text/javascript">
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