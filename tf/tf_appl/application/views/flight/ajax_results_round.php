<?php
    $flights_data = base64_encode(json_encode($flights)); // For reference
    $req=$request;
    $request = base64_encode(json_encode($req)); // request For reference
    //$flights_data = json_decode(base64_decode($flights_data));
   // echo'<pre>'; print_r($flights_data);die;
    $SAdults = $req->ADT;
    $SChildren = $req->CHD;
    $flights = json_decode(json_encode($flights));
    //echo'<pre>'; print_r($flights);die;
    //echo count($flights);exit;
    $i=0;
    //echo'<pre>'; print_r($flights);die;
    foreach($flights as $flight){
        if($flight->CompleteItinerary!='false'){
            $flight_data = base64_encode(json_encode($flight));
            $onward_first_seg = reset($flight->onward->segments);
            $onward_last_seg = end($flight->onward->segments);
            $return_first_seg = reset($flight->return->segments);
            $return_last_seg = end($flight->return->segments);
            $onward_fromCityName =  $this->flight_model->get_airport_cityname($onward_first_seg->Origin);
            $onward_toCityName =  $this->flight_model->get_airport_cityname($onward_last_seg->Destination);
            $return_fromCityName =  $this->flight_model->get_airport_cityname($return_first_seg->Origin);
            $return_toCityName =  $this->flight_model->get_airport_cityname($return_last_seg->Destination);
    // Fare Details
            $fare_rules_key=array();$fare_rules_pro=array();$fare_rules_content=array();
            $fare_rules_key=array_unique($flight->Farerulesref_Key, SORT_REGULAR);
            $fare_rules_pro=array_unique($flight->Farerulesref_Provider, SORT_REGULAR);
            $fare_rules_content=array_unique($flight->Farerulesref_content, SORT_REGULAR);
            $tot_fare=count($fare_rules_key);
            $array_fare_key_values = array_values($fare_rules_key);
            $array_fare_pro_values = array_values($fare_rules_pro);
            $array_fare_content_values = array_values($fare_rules_content);
            $cnt=count($array_fare_key_values); $getfare_details='';$getfare_each_details='';
            for ($ff=0; $ff <$cnt; $ff++) {
                $tot_fares=count($array_fare_key_values[$ff]);
                for ($fff=0; $fff <$tot_fares; $fff++) {
                    $fare_key=$array_fare_key_values[$ff][$fff]."|KK|";
                    $Fare_Provider=$array_fare_pro_values[0][$fff]."|KK|";
                    $fare_content=$array_fare_content_values[$ff][$fff]."|KK|";
                    $getfare_each_details.=$fare_key.$Fare_Provider.$fare_content;
                }
                $getfare_details.=$getfare_each_details.'|VV|';
            }
            $last_getfare_details=base64_encode(json_encode($getfare_details.'|@|'.$tot_fare));
            $Airlines[] = $onward_first_seg->Carrier;
            $Airlines[] = $return_first_seg->Carrier;
            $Stops[] = count($flight->onward->segments)-1;
            $retStops[] = count($flight->return->segments)-1;
            $totalStops=count($flight->onward->segments)-1+count($flight->return->segments)-1;
            $totalStopsArr[]=$totalStops;
            if($flight->CabinClass!=null){
             $CabinClass[] = $flight->CabinClass;
         }
         $onward_DepartureDateTime = $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime);
         $onward_ArrivalDateTime = $this->flight_model->get_unixtimestamp($onward_last_seg->ArrivalTime);
         $return_DepartureDateTime = $this->flight_model->get_unixtimestamp($return_first_seg->DepartureTime);
         $return_ArrivalDateTime = $this->flight_model->get_unixtimestamp($return_last_seg->ArrivalTime);
         $onward_dur = $this->flight_model->get_duration(strtotime($onward_first_seg->DepartureTime),strtotime($onward_last_seg->ArrivalTime));
         $return_dur = $this->flight_model->get_duration(strtotime($return_first_seg->DepartureTime),strtotime($return_last_seg->ArrivalTime));
         $deptime = date('H:i', $onward_DepartureDateTime);
         list($hours, $min) = explode(':', $deptime);
         $depminutes=$hours*60;
         $depminutes=$depminutes+$min;
         $seconds = $onward_ArrivalDateTime - $onward_DepartureDateTime;
         $jms = $seconds/60;
      // Added By Mukesh
         $MCalcCarriers = array();
         $WholeMarkups = array();
         $AllOnWardSegments = $flight->onward->segments;
         $AllReturnSegments = $flight->return->segments;
         $AllSegments = array_merge($AllOnWardSegments,$AllReturnSegments);
         foreach ($AllSegments as $Segment) {
          $DepartreDate = date('Y-m-d',strtotime($Segment->DepartureTime));
          $MCalcCarriers[] = array($Segment->Carrier,$DepartreDate);
      }
      foreach ($MCalcCarriers as $MCalcCarrier) {
        $WholeMCalcCarrier = $this->flight_model->WholeMCalcCarrier($MCalcCarrier[0],$MCalcCarrier[1]);
       // echo $this->db->last_query();
         //echo "<pre>";print_r($WholeMCalcCarrier);exit;
        foreach ($WholeMCalcCarrier as $WholeM) {
            $WholeMarkups[] = array($WholeM->Type,$WholeM->AmountType,($WholeM->AmountType == 'Currency') ? $WholeM->Currency : $WholeM->Percent,$WholeM->MDId,$WholeM->Per,$WholeM->MaxAmount,$WholeM->HiddenStatus);
            //break;
        }
        break;
    }
    $FlightPriceWithoutMarkup = $flight->TotalPrice;
    $TotalMarkupFeeAmount = 0;
    foreach ($WholeMarkups as $WholeMarkup) {
        $MrkupFeeType = $WholeMarkup[1];
        $WholeMarkupFeeAmount = $WholeMarkup[2];
        $WholeMarkupPer = $WholeMarkup[4];
        $WholeMarkupMaxAmount = $WholeMarkup[5];
        $MrkupFeeHStatus = $WholeMarkup[6];
        if($MrkupFeeHStatus == 'Y'){
        // Check Per Booking or Per Person comdition
            if($WholeMarkupPer == 'Person'){
                $tot_person=$SAdults+$SChildren;
                $WholeMarkupFeeAmount= $WholeMarkupFeeAmount*$tot_person;
            }
        // Check FeeType Condition
            ($MrkupFeeType == 'Currency') ? $MarkupFeeAmount = $WholeMarkupFeeAmount : $MarkupFeeAmount = (($FlightPriceWithoutMarkup*$WholeMarkupFeeAmount)/100);
        // Check Markup Maxamount
            if($MarkupFeeAmount > $WholeMarkupMaxAmount){
                $MarkupFeeAmount = $WholeMarkupMaxAmount;
            }
        // Check Markup Type Condition
            ($WholeMarkup[0] == 'Addition') ? $TotalMarkupFeeAmount += $MarkupFeeAmount : $TotalMarkupFeeAmount -= $MarkupFeeAmount;
        }
    }
    $price[] = $flight->TotalPrice+$TotalMarkupFeeAmount;
    ?>
    <!-- Normal trip-->
    <div id="ticketid0123<?php echo $i;?>" class="maderow flight" data-class="<?php echo ($flight->CabinClass!=null)?$flight->CabinClass:'';?>" data-airline="<?php echo $this->flight_model->get_airline_name($onward_first_seg->Carrier);?>" data-arrive="<?php echo $onward_ArrivalDateTime;?>" data-duration="<?php echo $jms;?>" data-stops="<?php echo $totalStops;?>" data-depature="<?php echo $depminutes;?>" data-airlinecode="<?php echo $onward_first_seg->Carrier;?>" data-price="<?php echo $this->account_model->currency_convertor($flight->TotalPrice+$TotalMarkupFeeAmount);?>">
        <div class="col-md-12 nopad">
            <!-- GOING TICKET-->
            <div class="frow1">
                <div class="col-md-12 nopad tablshow">
                    <div class="col-md-12 nopad fulwidmob">
                        <div class="onwyrow">
                            <div class="col-md-2 col-xs-2 fulat500">
                                <div class="flitsecimg">
                                    <img src="<?php echo ASSETS;?>images/airline_logo/<?php echo $onward_first_seg->Carrier;?>.gif" id="FF<?php echo str_replace('.', '', ($flight->TotalPrice+$TotalMarkupFeeAmount)).$i;?>" alt="">
                                    <span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($onward_first_seg->Carrier);?></span>
                                </div>
                            </div>
                            <div class="col-md-7 col-xs-7 nopad fulat500">
                                <div class="col-md-5 col-xs-5">
                                    <br>
                                    <div class="radiobtn"><?php echo $onward_fromCityName;?></b> (<?php echo $onward_first_seg->Origin;?>)</div>
                                    <span class="f_color"><small><?=lang('DEPARTURE');?></small></span>
                                    <span class="norto"><small><?php echo date('H:i', $onward_DepartureDateTime);?> (<?php echo date('d M, D Y', $onward_DepartureDateTime);?>)</small></span>
                                </div>
                                <div class="col-md-2 col-xs-2 nopad">
                                    <br>
                                    <div class="flightimgs">
                                        <img src="<?php echo ASSETS;?>images/departure.png" alt="" />
                                    </div>
                                </div>
                                <div class="col-md-5 col-xs-5">
                                    <br>
                                    <span class="radiobtn"><?php echo $onward_toCityName;?></b> (<?php echo $onward_last_seg->Destination;?>)</span>
                                    <span class="f_color"><small><?=lang('ARRIVAL');?></small></span>
                                    <span class="norto"><small><?php echo date('H:i', $onward_ArrivalDateTime);?> (<?php echo date('d M, D Y', $onward_ArrivalDateTime);?>)</small></span>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-3 nopad fulat500">
                                <br>
                                <div class="fatfi">
                                    <span class="norto"><img src="<?php echo ASSETS; ?>images/site/clk.png"> <?php echo $onward_dur;?></span>
                                    <span class="norto lbold"><?php echo (($Stops[$i]>1)?$Stops[$i]." ".lang('STOP'):(($Stops[$i]==0)?lang('NONSTOP'):$Stops[$i]." ".lang('STOP')));?></span>
                                    <span class="norto text-primary"><?php echo $onward_first_seg->CabinClass;?></span>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="onwyrow return">
                            <div class="col-md-2 col-xs-2 fulat500">
                                <div class="flitsecimg">
                                    <img src="<?php echo ASSETS;?>images/airline_logo/<?php echo $onward_first_seg->Carrier;?>.gif" id="FF<?php echo str_replace('.', '', ($flight->TotalPrice+$TotalMarkupFeeAmount)).$i;?>" alt="">
                                    <span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($return_first_seg->Carrier);?></span>
                                </div>
                            </div>
                            <div class="col-md-7 col-xs-7 nopad fulat500">
                                <div class="col-md-5 col-xs-5">
                                    <br>
                                    <div class="radiobtn"><?php echo $return_fromCityName;?></b> (<?php echo $return_first_seg->Origin;?>)</div>
                                    <span class="f_color"><small><?=lang('DEPARTURE');?></small></span>
                                    <span class="norto"><small><?php echo date('H:i', $return_DepartureDateTime);?> (<?php echo date('d M, D Y', $return_DepartureDateTime);?>)</small></span>
                                </div>
                                <div class="col-md-2 col-xs-2 nopad">
                                    <br>
                                    <div class="flightimgs">
                                        <img src="<?php echo ASSETS;?>images/arrival.png" alt="" />
                                    </div>
                                </div>
                                <div class="col-md-5 col-xs-5">
                                    <br>
                                    <span class="radiobtn"><?php echo $return_toCityName;?></b> (<?php echo $return_last_seg->Destination;?>)</span>
                                    <span class="f_color"><small><?=lang('ARRIVAL');?></small></span>
                                    <span class="norto"><small><?php echo date('H:i', $return_ArrivalDateTime);?> (<?php echo date('d M, D Y', $return_ArrivalDateTime);?>)</small></span>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-3 nopad fulat500">
                                <br>
                                <div class="fatfi">
                                    <span class="norto"><img src="<?php echo ASSETS; ?>images/site/clk.png"><?php echo $return_dur;//$Tot_Rtraveltime;//?></span>
                                    <span class="norto lbold"><?php echo (($retStops[$i]>1)?$retStops[$i]." STOPS":(($retStops[$i]==0)?"NON STOP":$retStops[$i]." STOP"));?></span>
                                      <span class="norto text-primary"><?php echo $return_first_seg->CabinClass;?></span>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="pricefilt foronmob">
                        <?php $bookingCounts = $flight->onward->segments[0]->BookingCounts;
                              $bookingCounts_arr = explode('|', $bookingCounts);
                                                                $bookingCounts_arr = array_reverse($bookingCounts_arr);
                                                                $tickets = 0;
                                                                foreach($bookingCounts_arr as $bcak=>$bcav){
                                                                    if(strrev($bcav) > 0){
                                                                        $tickets = (int)(strrev($bcav));
                                                                        break;
                                                                    }
                                                                }
                                                                echo "<font color='red'>".(($tickets > 9)?'9':$tickets)." Seats available </font>";
                                                                ?>
                            <span class="nortocount"><span class="curr_icon"><?php echo $this->display_icon;?></span><span class="amount"><?php echo $this->account_model->currency_convertor($flight->TotalPrice+$TotalMarkupFeeAmount);?></span></span>
                              
                            <form  name="flightbook<?php echo $i;?>" id="F<?php echo str_replace('.', '', ($flight->TotalPrice+$TotalMarkupFeeAmount)).$i;?>" action="<?php echo WEB_URL;?>">
                                <input type="hidden" name="temp_d" value="<?php echo $flight_data;?>" required />
                                <input type="hidden" name="temp_r" value="<?php echo $request;?>" required />
                                <input class="selectbtn FlightbookNow" type="button" name="button" data-attr="F<?php echo str_replace('.', '', ($flight->TotalPrice+$TotalMarkupFeeAmount)).$i;?>" value="<?=lang('SELECT');?>" />
                            </form>
                        </div>
                        <div class="clear"></div>
                        <div class="toglerow">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <span class="f_color" style="font-size:12px;margin-left: 10px;"> <a class="href_<?php echo ($i+1);?>" href="javascript:void(0);" id="<?php echo $last_getfare_details;?>" onclick="show_fare_popup(this.id,this,1)"><?=lang('DETAILED_FARE_CONDITIONS');?></a></span>
                                        <!-- <br>
                                        <span style="margin-left: 10px;"><small>"<?=lang('SR_FEE_NOTE');?> € 29.50"</small></span> -->
                                    </div>
                                    <div class="pull-right text-right">
                                         <?php if($flight->FareType=='Refundable'){ ?>
        <button class="btn btn-success lightbtn" type="button" data-toggle="collapse" data-target="#collapse_ref<?php echo $i;?>"><img src="<?php echo ASSETS;?>images/site/arrow_open.png" class="open_close_arrow"><?php echo $flight->FareType;?>  
      
        <?php }else{?>
        <button class="btn btn-danger"><?php echo $flight->FareType;?></button>
        <?php }?> 

                  <button class="lightbtn" type="button" data-toggle="collapse" data-target="#collapse_bag<?php echo $i;?>"><img src="<?php echo ASSETS;?>images/site/arrow_open.png" class="open_close_arrow"> <i class="fa fa-suitcase" aria-hidden="true"></i> Baggage Information</button>
                                        <button class="lightbtn" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i;?>"><img src="<?php echo ASSETS; ?>images/site/arrow_open.png" class="open_close_arrow"> <?=lang('FLIGHT_DETAILS');?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2 nopad litblue white">
                            <!--<button class="lightbtn" type="button" data-toggle="collapse" data-target="#collapse10">More</button>-->
                            <div class="pricefilt">
                            <?php $bookingCounts = $flight->onward->segments[0]->BookingCounts;
                                                                $bookingCounts_arr = explode('|', $bookingCounts);
                                                                $bookingCounts_arr = array_reverse($bookingCounts_arr);
                                                                $tickets = 0;
                                                                foreach($bookingCounts_arr as $bcak=>$bcav){
                                                                    if(strrev($bcav) > 0){
                                                                        $tickets = (int)(strrev($bcav));
                                                                        break;
                                                                    }
                                                                }
                                                                echo "<font color='red'>".(($tickets > 9)?'9':$tickets)." Seats available </font>";
                                                                ?>
                                <span class="nortocount"><span class="curr_icon"><?php echo $this->display_icon;?></span><span class="amount"><?php echo $this->account_model->currency_convertor($flight->TotalPrice+$TotalMarkupFeeAmount)/*.'-'.$TotalMarkupFeeAmount*/;?></span></span>
                                
                                <form  name="flightbook<?php echo $i;?>" id="F<?php echo str_replace('.', '', ($flight->TotalPrice+$TotalMarkupFeeAmount)).$i;?>" action="<?php echo WEB_URL;?>">
                                    <input type="hidden" name="temp_d" value="<?php echo $flight_data;?>" required/>
                                    <input type="hidden" name="temp_r" value="<?php echo $request;?>" required/>
                                    <input class="selectbtn booking FlightbookNow" type="button" name="button" data-attr="F<?php echo str_replace('.', '', ($flight->TotalPrice+$TotalMarkupFeeAmount)).$i;?>" value="<?=lang('SELECT');?>" />
                                </form>
                            </div>
                        </div>
                    </div>



                     <?php if($flight->FareType=='Refundable'){ ?>
 <!-- Toogle refund Div Start-->

  <div class="clearfix"></div>
          <div  class="collapse frowexpand" id="collapse_ref<?php echo $i;?>">
          <div class="col-md-12 nopad tablshow">
           <div class="onwFltTitle"><i class="fa fa-arrow-right" aria-hidden="true"></i> Refundable Information</span></div>
<p> <b>CancelPenalty </b><?php if($flight->CancelPenalty!='') { ?>(<?php echo $flight->CancelPenalty?>) <?php }else{ echo "Please click Detailed fare Conditions and Information under ChangePenalty or CancelPenalty";}  ?></p> <br>


<p> <b>ChangePenalty </b><?php if($flight->ChangePenalty!='') { ?> (<?php echo $flight->ChangePenalty?>) <?php }else{ echo "Please click Detailed fare Conditions and Information under ChangePenalty or CancelPenalty";}  ?></p>
           </div>
           </div>

  <!-- Toogle refund Div End-->
<?php } ?>


 <!-- Toogle Baggage Div Start-->
                     <div class="clearfix"></div>


          <div  class="collapse frowexpand" id="collapse_bag<?php echo $i;?>">
          <div class="col-md-12 nopad tablshow">
          <div class="onwFltTitle"><i class="fa fa-arrow-right" aria-hidden="true"></i> Baggage Information</span></div>
         <?php 
        
        
  foreach($flight->onward->segments as $key => $segment){
    if($key==0)echo "<h5 style='font-size: 16px;font-weight: 600;margin-left: 20%;'>Onward</h5>";

echo "<table style='width: 40%;margin-bottom: 25px;margin-left: 10px 30px;'><tr><td><img src='".ASSETS."images/airline_logo/".$segment->Carrier.".gif'  alt='Carrier'></td>";
echo "<td style='border-bottom: 1px dotted #666666;width: 60%;'><h5 class='f_color' style='font-weight: 600;'>Cabin : 7 Kilograms/Person</h5></td></tr>";
echo "<tr><th><h5 class=''>".$segment->Origin." → ".$segment->Destination."</h5></th>";
if($segment->BaggageAllowance > 0)
    echo "<td style='border-bottom: 1px dotted #666666;width: 60%;'><h5 class='f_color' style='font-weight: 600;'>Check-in : ".$segment->BaggageAllowance."/Person</h5></td></tr></table>";
elseif(strrev($segment->BaggageAllowance) > 0)
    echo "<td style='border-bottom: 1px dotted #666666;width: 60%;'><h5 class='f_color' style='font-weight: 600;'>Check-in : ".(strrev($segment->BaggageAllowance)*23)."KG /Person</h5></td></tr></table>";
else
    echo "<td style='border-bottom: 1px dotted #666666;width: 60%;'><h5 class='f_color' style='font-weight: 600;'>No check-in baggage allowance</h5></td></tr></table>";

}

 foreach($flight->return->segments as $key => $segment){
     if($key==0)echo "<h5 style='font-size: 16px;font-weight: 600;margin-left: 20%;'>Return</h5>";  
echo "<table style='width: 40%;margin-bottom: 25px;margin-left: 10px 30px;'><tr><td><img src='".ASSETS."images/airline_logo/".$segment->Carrier.".gif'  alt='Carrier'></td>";
echo "<td style='border-bottom: 1px dotted #666666;width: 60%;'><h5 class='f_color' style='font-weight: 600;'>Cabin : 7 Kilograms/Person</h5></td></tr>";
echo "<tr><th><h5 class=''>".$segment->Origin." → ".$segment->Destination."</h5></th>";
if(strpos('NumberOfPieces', $segment->BaggageAllowance)!=FALSE){
    $segment->BaggageAllowance = (trim(str_replace('NumberOfPieces', '', $segment->BaggageAllowance)) * 23).'KG';
}
if($segment->BaggageAllowance > 0)
    echo "<td style='border-bottom: 1px dotted #666666;width: 60%;'><h5 class='f_color' style='font-weight: 600;'>Check-in : ".$segment->BaggageAllowance."/Person</h5></td></tr></table>";
elseif(strrev($segment->BaggageAllowance) > 0)
    echo "<td style='border-bottom: 1px dotted #666666;width: 60%;'><h5 class='f_color' style='font-weight: 600;'>Check-in : ".(strrev($segment->BaggageAllowance)*23)."KG /Person</h5></td></tr></table>";
else
    echo "<td style='border-bottom: 1px dotted #666666;width: 60%;'><h5 class='f_color' style='font-weight: 600;'>No check-in baggage allowance</h5></td></tr></table>";

}
          ?>
          </div>
          </div>
 <!-- Toogle Baggage Div End-->
                    <div class="clearfix"></div>
                    <div  class="collapse frowexpand" id="collapse<?php echo $i;?>">
                        <!-- flight details -->
                        <!-- end flight details -->
                        <div class="col-md-12 nopad tablshow">
                            <div class="col-md-12 nopad fulwidmob">
                                <?php
                                foreach($flight->onward->segments as $key => $segment){
                                    $seg_ArrivalDateTime = $art =strtotime($segment->ArrivalTime);
//echo $ArrivalDateTime;die;
                                    $seg_DepartureDateTime = $dpt =strtotime($segment->DepartureTime);
                                    $seconds = $seg_ArrivalDateTime - $seg_DepartureDateTime;
                                    $days = floor($seconds / 86400);
                                    $hours = floor(($seconds - ($days * 86400)) / 3600);
                                    $minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
                                    if($days==0){
                                        $dur=$hours."h ".$minutes."m";
                                    }else{
                                        $dur=$days."d ".$hours."h ".$minutes."m";
                                    }
                                    if(count($flight->onward->segments) > 0 &&  $key+1 < count($flight->onward->segments)){
//Exploding T from arrival time
                                        list($date, $time) = explode('T',  $flight->onward->segments[$key]->ArrivalTime);
                                        $time = preg_replace("/[.]/", " ", $time);
                                        list($time, $TimeOffSet) = explode(" ", $time);
$ArrivalDateTime1 = $date." ".$time; //Exploding T and adding space
$ArrivalDateTime1 = $art = strtotime($ArrivalDateTime1);
//echo $ArrivalDateTime;die;
//Exploding T from depature time
list($date, $time) = explode('T', $flight->onward->segments[$key+1]->DepartureTime);
$time = preg_replace("/[.]/", " ", $time);
list($time, $TimeOffSet) = explode(" ", $time);
$DepartureDateTime1 = $date." ".$time; //Exploding T and adding space
$DepartureDateTime1 = $dpt = strtotime($DepartureDateTime1);
$seconds1 = $DepartureDateTime1 - $ArrivalDateTime1;
$days1 = floor($seconds1 / 86400);
$hours1 = floor(($seconds1 - ($days1 * 86400)) / 3600);
$minutes1 = floor(($seconds1 - ($days1 * 86400) - ($hours1 * 3600))/60);
if($days1==0){
    $Layover=$hours1."h ".$minutes1."m";
}else{
    $Layover=$days1."d ".$hours1."h ".$minutes1."m";
}
}
?>
<div class="repflight roundts">
    <div class="tablpik">
        <div class="pikeronwds"><?=lang('ONWARD');?></div>
        <div class="col-md-3 col-xs-3 fulat500">
            <div class="alldetss">
                <div class="detflitimg">
                    <img src="<?php echo ASSETS;?>images/airline_logo/<?php echo $segment->Carrier;?>.gif"  alt=""/>
                </div>
                <span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($segment->Carrier);?><?php //echo $segment->FlightNumber;?><br><?php echo $segment->Carrier;?><?php echo (isset($segment->FlightNumber))?"-".$segment->FlightNumber:"";?></span>
                 <span class="nortosimle textcentr"><?php echo $segment->CabinClass;?></span>
            </div>
        </div>
        <div class="col-md-8 col-xs-8 nopad fulat500">
            <div class="col-md-5 col-xs-5">
                <span class="radiobtnnill rittextalign"><?php echo $segment->Origin;?> <strong><?php echo date('H:i', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></strong></span>
                <span class="norto rittextalign"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></span>
                <span class="simle rittextalign"><?php echo $this->flight_model->get_airport_cityname($segment->Origin);?>(<?php echo $this->flight_model->get_airport_name($segment->Origin);?>)(<?php echo ($this->flight_model->get_airport_citycode($segment->Origin));?>)</span>
            </div>
            <div class="col-md-2 col-xs-2 nopad">
                <span class="timeclo"></span>
                <span class="nortocen lbold"><?php echo  $dur;?></span>
            </div>
            <div class="col-md-5 col-xs-5">
                <span class="radiobtnnill"><?php echo $segment->Destination;?> <strong><?php echo date('H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></strong></span>
                <span class="norto"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span>
                <span class="simle"><?php echo $this->flight_model->get_airport_cityname($segment->Destination);?>(<?php echo $this->flight_model->get_airport_name($segment->Destination);?>)(<?php echo ($this->flight_model->get_airport_citycode($segment->Destination));?>)</span>
            </div>
        </div>
    </div>
</div>
<?php if(count($flight->onward->segments) > 0 &&  $key+1 < count($flight->onward->segments)){?>
<div class="betwenrow">Change of Plane at <strong><?php echo $this->flight_model->get_airport_name($segment->Destination);?></strong>, | <strong>Layover: <?php echo $Layover;?></strong> </div>
<?php } if(count($flight->onward->segments) > 0 &&  $key+1==count($flight->onward->segments)){ ?>
<div class="betwenrow" style="text-align: center;"><?=lang('TOTAL_JOURNEY_TIME');?> <strong><?php echo $onward_dur;?></strong></div>
<?php } }?>
<?php
foreach($flight->return->segments as $key => $segment){
    $seg1_ArrivalDateTime = $art =strtotime($segment->ArrivalTime);
//echo $ArrivalDateTime;die;
    $seg1_DepartureDateTime = $dpt =strtotime($segment->DepartureTime);
    $seconds = $seg1_ArrivalDateTime - $seg1_DepartureDateTime;
    $days = floor($seconds / 86400);
    $hours = floor(($seconds - ($days * 86400)) / 3600);
    $minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
    if($days==0){
        $dur=$hours."h ".$minutes."m";
    }else{
        $dur=$days."d ".$hours."h ".$minutes."m";
    }
    if(count($flight->return->segments) > 0 &&  $key+1 < count($flight->return->segments)){
     //Exploding T from arrival time
        list($date, $time) = explode('T',  $flight->return->segments[$key]->ArrivalTime);
        $time = preg_replace("/[.]/", " ", $time);
        list($time, $TimeOffSet) = explode(" ", $time);
     $ArrivalDateTime1 = $date." ".$time; //Exploding T and adding space
     $ArrivalDateTime1 = $art = strtotime($ArrivalDateTime1);
    //echo $ArrivalDateTime;die;
    //Exploding T from depature time
     list($date, $time) = explode('T', $flight->return->segments[$key+1]->DepartureTime);
     $time = preg_replace("/[.]/", " ", $time);
     list($time, $TimeOffSet) = explode(" ", $time);
     $DepartureDateTime1 = $date." ".$time; //Exploding T and adding space
     $DepartureDateTime1 = $dpt = strtotime($DepartureDateTime1);
     $seconds1 = $DepartureDateTime1 - $ArrivalDateTime1;
     $days1 = floor($seconds1 / 86400);
     $hours1 = floor(($seconds1 - ($days1 * 86400)) / 3600);
     $minutes1 = floor(($seconds1 - ($days1 * 86400) - ($hours1 * 3600))/60);
     if($days1==0){
        $Layover=$hours1."h ".$minutes1."m";
    }else{
        $Layover=$days1."d ".$hours1."h ".$minutes1."m";
    }
}
?>
<div class="repflight roundts">
    <div class="tablpik">
        <div class="pikerret"><?=lang('RETURN');?></div>
        <div class="col-md-3 col-xs-3 fulat500">
            <div class="alldetss">
                <div class="detflitimg">
                    <img src="<?php echo ASSETS;?>images/airline_logo/<?php echo $segment->Carrier;?>.gif"  alt=""/>
                </div>
                <span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($segment->Carrier);?><?php //echo $segment->FlightNumber;?><br><?php echo $segment->Carrier;?><?php echo (isset($segment->FlightNumber))?"-".$segment->FlightNumber:"";?></span>
                 <span class="nortosimle textcentr"><?php echo $segment->CabinClass;?></span>
            </div>
        </div>
        <div class="col-md-8 col-xs-8 nopad fulat500">
            <div class="col-md-5 col-xs-5">
                <span class="radiobtnnill rittextalign"><?php echo $segment->Origin;?> <strong><?php echo date('H:i', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></strong></span>
                <span class="norto rittextalign"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></span>
                <span class="simle rittextalign"><?php echo $this->flight_model->get_airport_cityname($segment->Origin);?> (<?php echo $this->flight_model->get_airport_name($segment->Origin);?>)(<?php echo ($this->flight_model->get_airport_citycode($segment->Origin));?>)</span>
            </div>
            <div class="col-md-2 col-xs-2 nopad">
                <span class="timeclo"></span>
                <span class="nortocen lbold"><?php echo  $dur;?></span>
            </div>
            <div class="col-md-5 col-xs-5">
                <span class="radiobtnnill"><?php echo $segment->Destination;?> <strong><?php echo date('H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></strong></span>
                <span class="norto"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span>
                <span class="simle"><?php echo $this->flight_model->get_airport_cityname($segment->Destination);?> (<?php echo $this->flight_model->get_airport_name($segment->Destination);?>) (<?php echo ($this->flight_model->get_airport_citycode($segment->Destination));?>)</span>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<?php if(count($flight->return->segments) > 0 &&  $key+1 < count($flight->return->segments)){?>
<div class="betwenrow"><?=lang('CHANGE_OF_PLANE');?> <strong><?php echo $this->flight_model->get_airport_name($segment->Destination);?></strong>, | <strong>Layover: <?php echo $Layover;?></strong> </div>
<div class="clear"></div>
<?php } if(count($flight->return->segments) > 0 &&  $key+1==count($flight->return->segments)){ ?>
<div class="betwenrow" style="text-align: center;"><?=lang('TOTAL_JOURNEY_TIME');?> <strong><?php echo $return_dur;?></strong></div>
<?php } } ?>
</div>
</div>
</div>
</div>
<!-- END OF GOING TICKET-->
</div>
</div>
<!-- Normal trip End-->
<?php $i++;}}?>
<?php $disp_more_load_butt='';
$disp_more_load=$more_results;
if(isset($disp_more_load['MoreResults']) && $disp_more_load['MoreResults']=='true'){
  $disp_more_load_butt.=' <button  class="removel loadings loadings_next onclick"   data-request="'.$request.'" data-type="'.$req->type.'" data-SearchId="'.$disp_more_load['SearchId'].'" data-ProviderCode="'.$disp_more_load['ProviderCode'].'">'.lang('LOAD_MORE').'</button>';
}
echo $disp_more_load_butt;
?>
<?php
echo '<div id="errorMessage" style="text-align:center;display:none;" class="no_available removel">
<h1>There are no flights available. </h1>
<br><br>
<div class="no_available_text">Sorry, we have no prices for flights in this date range matching your criteria. One or more of your preferences may be affecting the number of exact matches found. Try searching again with a wider search criteria. <br></div>
    </div>'; // Error Message
    ?>
    <?php $Airlines = array_unique($Airlines);sort($Airlines); //Creating Unique Airlines
    $Stops = array_unique($Stops); sort($Stops); //Creating Unique Stops
    $CabinClass = array_unique($CabinClass);sort($CabinClass); //Creating Unique CabinClass?>
    <div class="removel">
        <input type="hidden" name="temp_d" value="<?php echo $flights_data;?>"/>
        <input type="hidden" id="setMinPrice" value="<?php if(!empty($price)) echo $this->account_model->currency_convertor(min($price)); else echo 0; ?>" />
        <input type="hidden" id="setMaxPrice" value="<?php if(!empty($price)) echo $this->account_model->currency_convertor(max($price)); else echo 0; ?>" />
        <input type="hidden" id="setMinTime" value="0" />
        <input type="hidden" id="setMaxTime" value="1440" />
        <input type="hidden" id="table_count" />
        <input type="hidden" id="markup_price" value="<?php echo $TotalMarkupFeeAmount;?>" />
        <input type="hidden" id="total_count" value="<?php echo count($flights);?>" />
        <input type="hidden" id="disc_price" value="<?php echo isset($req->disc_price)?$req->disc_price:0;?>" />
    </div>
    <script>
    <?php   if($req->days!= ''){  ?>
     //Price Tbale Section By Veera
     var max_price;
     $(".price").each(function(){
      max_price=$.trim($(this).text()).substring(1,$.trim($(this).text()).length);
      var symbol=$.trim($(this).text()).substring(0, 1);
      if(max_price!=0){
        $(this).find('span').text(symbol+(parseFloat(max_price)+parseFloat($('#markup_price').val())));
    }
});
     var prices = $('.price').map(function() {
        return $.trim($(this).text()).match(/(\d+\.\d{2})/);
    }).get();
     var min = Math.min.apply(null, prices);
     $( "td.price span:contains('"+min+"')" ).addClass('lowest').css( "background-color", "#00C12B" );
     var departure_date = $('.mnt-clas1').text().split('-')[0].replace(/ /g,'');
     var return_date = $('.mnt-clas1').text().split('-')[1].replace(/ /g,'');
     $('.colr-he1').each(function(){
        var split = this.id.split('-');
        var redate = split[0].replace(/ /g,'');
        var depdate = split[1].split(',')[0].replace(/ /g,'');
        if($.trim(departure_date).toLowerCase() == $.trim(depdate).toLowerCase()){
            $(this).css("background-color", "#4793DE");
        }
        if($.trim(return_date).toLowerCase() == $.trim(redate).toLowerCase()){
            $(this).css("background-color", "#4793DE");
        }
    });
//Price Tbale Section By Veera
<?php } ?>
/*function showFlights(minPrice, maxPrice) {
    $("div.flights div.flight").removeClass('Fcount').hide().filter(function() {
        //var price = parseFloat($(this).data("price"));
        var price = $(this).find("span.amount").html();
        //var price = price.replace(/,/g , '');
        var price = parseFloat(price);
        console.log(price+' >= '+minPrice+' && '+price+' <= '+maxPrice);
        return price >= minPrice && price <= maxPrice;
    }).addClass('Fcount').show();
    //checkCount();
}
function showDepFlights(mint, maxt) {
    $("div.flights div.flight").hide().filter(function() {
        var dep = $(this).data("depature");
        return dep >= mint && dep <= maxt;
    }).show();
}*/
$('#pricerange').addClass('in');
$(function() {
    $("p#total-search").html(parseInt($("#total_count").val())+parseInt($("p#total-search").text()));
    if($( "#amount" ).val()==''){
      var slidermin=parseFloat($("#setMinPrice").val());
      var slidermax=parseFloat($("#setMaxPrice").val());
  }else{
    var slideramount=$("#amount").val();
    var slideramountsplit=slideramount.split('-');
    var minamount=slideramountsplit[0].replace(CURR_ICON, "");
    var maxamount=slideramountsplit[1].replace(CURR_ICON, "");
    if(parseFloat($("#setMinPrice").val())<minamount){
      var slidermin=parseFloat($("#setMinPrice").val());
  }else{
    var slidermin=parseFloat(minamount);
}
if(parseFloat($("#setMaxPrice").val())<maxamount){
  var slidermax=parseFloat(maxamount);
}else{
  var slidermax=parseFloat($("#setMaxPrice").val());
}
}
$( "#slider-range" ).slider({
    range: true,
    min: slidermin,
    max:  slidermax,
    values: [  slidermin,  slidermax ],
    slide: function( event, ui ) {
        $( "#amount" ).val( CURR_ICON + ui.values[ 0 ] + " -" +CURR_ICON+ ui.values[ 1 ] );
    },
    change: function( event, ui ) {
        one=ui.values[0];
        two=ui.values[1];
         //alert(one+'-'+two);
         //showFlights(one, two);
         flightFilteration();
     }
 });
$( "#amount" ).val( CURR_ICON + $( "#slider-range" ).slider( "values", 0 ) +
    " - "+CURR_ICON+ $( "#slider-range" ).slider( "values", 1 ) );
});
var startTime;
var endTime;
function slideTime(event, ui){
       //alert(event+'-'+ui);
       var val0 = $("#DepSlider").slider("values", 0);
       val1 = $("#DepSlider").slider("values", 1);
       minutes0 = parseInt(val0 % 60, 10);
       hours0 = parseInt(val0 / 60 % 24, 10);
       minutes1 = parseInt(val1 % 60, 10);
       hours1 = parseInt(val1 / 60 % 24, 10);
       startTime = getTime(hours0, minutes0);
       endTime = getTime(hours1, minutes1);
    // startTime = hours0+':'+minutes0;
    // endTime = hours1+':'+minutes1;
    $("#Dep").val(startTime + ' - ' + endTime);
    $("#setMinTime").val(val0);
    $("#setMaxTime").val(val1);
}
function getTime(hours, minutes) {
    var time = null;
    minutes = minutes + "";
    /*if (hours < 12) {
        time = "AM";
    }
    else {
        time = "PM";
    }*/
    /*if (hours == 0) {
        hours = 12;
    }
    if (hours > 12) {
        hours = hours - 12;
    }*/
    if (minutes.length == 1) {
      minutes = "0" + minutes;
  }
  if (hours.length == 1) {
    hours = hours + "";
    hours = "0" + hours;
}
return hours + ":" + minutes + " Hrs";
}
$('#departtime').addClass('in');
$( "#DepSlider" ).slider({
    range: true,
    min: 0,
    max: 1439,
    step: 1,
    values: [ 0, 1439 ],
    slide: slideTime,
    change: function( event, ui ) {
        one=ui.values[0];
        two=ui.values[1];
         //alert(one+'-'+two);
         //showDepFlights(one, two);
         flightFilteration();
     }
 });
slideTime();
$('#airlines').addClass('in');
$('#AirlineFilter li:last').after('<?php $i=1;foreach($Airlines as $airline){?><li class="cheklist"><label for="airline<?php echo rand();?>"><div class="left"><input class="filtchk serch-blue airline" name="airline" type="checkbox" id="airline<?php echo rand();?>" value="<?php echo $airline;?>" /></div><span class="cheklabl"><?php echo $this->flight_model->get_airline_name($airline);?></span></label></li><?php $i++; }?>');
var $filters = $("input:checkbox[name='airline']"); // start all checked
var $categoryContent = $('div.flights div.flight'); // Path for flights
var $errorMessage = $('#errorMessage'); //Error Message
//$filters.click(function() {
    $filters.on('ifChanged', function(event){
  $categoryContent.hide(); // if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
  var $selectedFilters = $filters.filter(':checked');
  //console.log($selectedFilters);
  if ($selectedFilters.length > 0) {
   // $errorMessage.hide();
    flightFilteration();
    /*$selectedFilters.each(function (i, el) {
        $('div.flights div.flight[data-airlinecode="'+ el.value +'"]').show();
    });*/
} else {
   $("input:checkbox[name='Airline_checkall']").iCheck("uncheck");
   //$errorMessage.show();
   flightFilteration();
}
});
    $('#stops').addClass('in');
    $('#StopFilter li:last').after('<?php $i=1;foreach($Stops as $stop){?><li class="cheklist"><label for="stop<?php echo rand();?>"><div class="left"><input class="filtchk serch-blue stop" name="stop" type="checkbox" id="stop<?php echo rand();?>" value="<?php echo $stop;?>" /></div><span class="cheklabl"><?php if($stop == 0){ echo 'Non';}else if($stop == 1){echo 'One';}else if($stop == 2){echo 'Two';}else if($stop == 3){echo 'Three';}else{echo $stop;}?>-Stop</span></label></li><?php $i++; }?>');
var $filters1 = $("input:checkbox[name='stop']"); // start all checked
var $categoryContent1 = $('div.flights div.flight'); // Path for flights
var $errorMessage = $('#errorMessage'); //Error Message
$filters1.on('ifChanged', function(event){ console.log("Stops Clicked");
  $categoryContent1.hide(); // if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
  var $selectedFilters1 = $filters1.filter(':checked');
  if ($selectedFilters1.length > 0) {
    //$errorMessage.hide();
    flightFilteration();
   /* $selectedFilters1.each(function (i, el) {
        console.log($('div.flights div.flight[data-stops="'+ el.value +'"]'));
        $('div.flights div.flight[data-stops="'+ el.value +'"]').show();
    });*/
} else {
    $("input:checkbox[name='stop_checkall']").iCheck("uncheck");    //$errorMessage.show();
    flightFilteration();
}
});
$('#classes').addClass('in');
$('#ClassFilter li:last').after('<?php $i=1;foreach($CabinClass as $class){?><li class="cheklist"><label for="class<?php echo rand();?>"><div class="left"><input class="filtchk serch-blue class" name="class" type="checkbox" id="class<?php echo rand();?>" value="<?php echo $class;?>" /></div><span class="cheklabl"><?php echo $class;?></span></label></li><?php $i++; }?>');
var $class_filtr = $("input:checkbox[name='class']"); // start all checked
var $categoryContent1 = $('div.flights div.flight'); // Path for flights
var $errorMessage = $('#errorMessage'); //Error Message
$class_filtr.on('ifChanged', function(event){
  $categoryContent1.hide(); // if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
  var $selectedFilters_class = $class_filtr.filter(':checked');
  //console.log($selectedFilters);
  if ($selectedFilters_class.length > 0) {
    //$errorMessage.hide();
    flightFilteration();
    /*$selectedFilters_class.each(function (i, el) {
        var totaldiv=$('#table_count').val();
        for(var i=0;i<totaldiv;i++){
          $('div.flights div.flight[data-class="'+ el.value +'"]').filter('div#flights div#ticketid0123'+i).show();
      }
  });*/
} else {
    $("input:checkbox[name='class_checkall']").iCheck("uncheck");
    //$errorMessage.show();
    flightFilteration();
}
});
$('input.serch-blue').iCheck({
    checkboxClass: 'icheckbox_flat-blue',
    radioClass: 'iradio_flat',
    uncheckedClass: '',
});
$(document).ready(function(){
    $('input.serch-blue').iCheck('uncheck');
    var unquie_class = {};
    $('#ClassFilter li span').each(function() {
        var txt = $(this).text();
        if (unquie_class[txt])
            $(this).parent().parent().remove();
        else
            unquie_class[txt] = true;
    });
    var unquie_stop = {};
    $('#StopFilter li span').each(function() {
        var txt = $(this).text();
        if (unquie_stop[txt])
            $(this).parent().parent().remove();
        else
            unquie_stop[txt] = true;
    });
  var $airline_filtr = $("input:checkbox[name='Airline_checkall']"); // start all checked
  $airline_filtr.on('ifChanged', function(event){
        if(this.checked) { // check select status
          $(this,".input.serch-blue").iCheck("check");
            $('.airline').each(function() { //loop through each checkbox
              $(this, ".input.serch-blue").iCheck("check");
                this.checked = true;  //select all checkboxes with class "checkbox1"
            });
        }else{
         $(this,".input.serch-blue").iCheck("uncheck");
            $('.airline').each(function() { //loop through each checkbox
              $(this, ".input.serch-blue").iCheck("uncheck");
                this.checked = false; //deselect all checkboxes with class "checkbox1"
            });
        }
    });
     var $class_filtr = $("input:checkbox[name='class_checkall']"); // start all checked
     $class_filtr.on('ifChanged', function(event){
        if(this.checked) { // check select status
          $(this,".input.serch-blue").iCheck("check");
            $('.class').each(function() { //loop through each checkbox
              $(this, ".input.serch-blue").iCheck("check");
                this.checked = true;  //select all checkboxes with class "checkbox1"
            });
        }else{
         $(this,".input.serch-blue").iCheck("uncheck");
            $('.class').each(function() { //loop through each checkbox
              $(this, ".input.serch-blue").iCheck("uncheck");
                this.checked = false; //deselect all checkboxes with class "checkbox1"
            });
        }
    });
     var $stop_filtr = $("input:checkbox[name='stop_checkall']"); // start all checked
     $stop_filtr.on('ifChanged', function(event){
        if(this.checked) { // check select status
          $(this,".input.serch-blue").iCheck("check");
            $('.stop').each(function() { //loop through each checkbox
              $(this, ".input.serch-blue").iCheck("check");
                this.checked = true;  //select all checkboxes with class "checkbox1"
            });
        }else{
         $(this,".input.serch-blue").iCheck("uncheck");
            $('.stop').each(function() { //loop through each checkbox
              $(this, ".input.serch-blue").iCheck("uncheck");
                this.checked = false; //deselect all checkboxes with class "checkbox1"
            });
        }
    });
    $('button.lightbtn').click(function(){
            var url = $(this).find("img").attr("src");
            var spliturl=url.split("/");
            var imgSrc=spliturl[spliturl.length-1];
            var openimg = url.replace("arrow_close.png","arrow_open.png");
            var closeimg = url.replace("arrow_open.png", "arrow_close.png");
          if (imgSrc == "arrow_open.png") {
               $(this).find("img").attr("src",closeimg);
              }else{
                $(this).find("img").attr("src",openimg);
              }
        });
var disc_price=$("#disc_price").val();
$("div.flight").find("span.amount").each(function() {
    if($(this).text()==disc_price){
        $(this).after('<p class="text-success">Offer</p>');
    }
});
});
var count = 0;
function limit_flight_table(from){
  $('div#flights div.flight').css('display','none');
  if(from!='Click'){
    var totaldiv=($('#table_count').val()/15);
    totaldiv=Math.ceil(totaldiv)-1;
    count=($('#table_count').val()==15)?0:totaldiv;
  }
  var click_count = ++count;
  var table_count = 15 * click_count;
    $('#table_count').val(table_count);
  var total_count = $('div#flights div.flight').length;
  for(var i=0;i<table_count;i++){
   $('div#flights div.flight:eq('+i+')').css("display","block");
  }
  if(i > total_count){
    $('#load_more').css('display','none');
  }else{
    $('#load_more').css('display','block');
  }
}
    $(document).ready(function(){
   $('#load_more').trigger('click');
});




  /***
  This code is for oneway, round and multicity.
  ***/
  function flightFilteration(){
   alert();
   
    var count_number_stops = $(".filtchk.stop").length, count_number_stops_checked = $(".filtchk.stop:checked").length;
    var count_number_airline = $("ul#AirlineFilter li").length, count_number_airline_checked = $('input[name="airline"]:checked').length;
    var count_number_class = $("ul#ClassFilter li").length, count_number_class_checked = $('input[name="class"]:checked').length;


    /////////////////////////////////////
    
        var hide_flight_cls_chkbox = "";
       
        // here collecting all unchecked data, which needs to be hide.
        if(count_number_airline_checked>0){
        $('input[name="airline"]').each(function(){
            if($(this).prop("checked")==false){
              if(this.value!=''){
                hide_flight_cls_chkbox += (hide_flight_cls_chkbox?",":"")+'"'+this.value+'":1';
              }
              }
            
        });

        }


        if(count_number_stops_checked>0){
        $('input[name="stop"]').each(function(){
            if($(this).prop("checked")==false){
              if(this.value!=''){
                hide_flight_cls_chkbox += (hide_flight_cls_chkbox?",":"")+'"'+this.value+'":1';
              }
              }
            
        });

        }

        if(count_number_class_checked>0){
        $('input[name="class"]').each(function(){
            if($(this).prop("checked")==false){
              if(this.value!=''){
                hide_flight_cls_chkbox += (hide_flight_cls_chkbox?",":"")+'"'+this.value+'":1';
              }
              }
            
        });

        }

      
          


        
        hide_flight_cls_chkbox = "{ "+ hide_flight_cls_chkbox +" }";
      
        hide_flight_cls_chkbox = JSON.parse(hide_flight_cls_chkbox);
        
        $("div#flights div.flight").show(); // here showing all the data
        
        var hidden_rows = 0;
        


        

        
 
        // Here hiding records which are unchecked
       $("div#flights div.flight").each(function(){
            var temp_airline = $(this).data("airlinecode");
            var temp_stops = $(this).data("stops");
           
            var temp_class = $(this).data("class");
       
            if(hide_flight_cls_chkbox[temp_airline]){
               hidden_rows++;
                $(this).hide();
            }else if(hide_flight_cls_chkbox[temp_stops]){
                hidden_rows++;
                $(this).hide();
            }else if(hide_flight_cls_chkbox[temp_class]){
                hidden_rows++;
                $(this).hide();
            }


        });
       
        
        $("div#flights div.flight").each(function(){
         
          /*var temp_duration = parseInt($(this).data('duration'));
          var temp_arrival = parseInt($(this).data('arrive'));
          var min_duration = parseInt($("#duration-filter").slider("values", 0));
          var max_duration = parseInt($("#duration-filter").slider("values", 1));
          var min_arrive = parseInt($("#arrival-filter").slider("values", 0));
          var  max_arrive = parseInt($("#arrival-filter").slider("values", 1));*/
           var prices = parseFloat($(this).data("price"));
           var temp_departure = parseInt($(this).data('depature'));
          var min_departure = parseInt($("#DepSlider").slider("values", 0));
          var  max_departure = parseInt($("#DepSlider").slider("values", 1));
          var minPrice_ = parseFloat($("#slider-range").slider("values", 0));
          var maxPrice_ = parseFloat($("#slider-range").slider("values", 1));
       



             if( !((prices >= minPrice_) && (prices <= maxPrice_))   ){
             
               hidden_rows++;
                 $(this).hide();
                }else if( !( (temp_departure >= min_departure) && (temp_departure <= max_departure) ) ){
                hidden_rows++;
               $(this).hide();
              }/*else if( !( (temp_duration >= min_duration) && (temp_duration <= max_duration) ) ){
                   //alert('pv');
               hidden_rows++;
               $(this).hide();
              }else if( !( (temp_arrival >= min_arrive) && (temp_arrival <= max_arrive) ) ){
                hidden_rows++;
               $(this).hide();
              }*/
        }); 

var $errorMessage = $('#errorMessage'); //Error Message
if($("div#flights div.flight:visible").length==0){
$errorMessage.show(); $('#load_more').css('display','none');
}else{
  $errorMessage.hide(); 
   if($("div#flights div.flight:visible").length>15){ 
    $('#load_more').css('display','block');
}else{
  $('#load_more').css('display','none');
}
}
        
    } 
</script>
