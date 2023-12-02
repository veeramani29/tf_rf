<?php
    $request = base64_encode(json_encode($req)); // request For reference
    $flight =$flights;
    $flight_data = base64_encode(json_encode($flight));

    $SAdults = $req->ADT;
    $SChildren = $req->CHD;

    //echo count($flights);exit;
    //$i=0;
    //echo'<pre>'; print_r($flights);die; 
    //foreach($flights as $flight){
        if($flight->CompleteItinerary!='false'){
    	
        
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


		
		
        
        $Airlines = $onward_first_seg->Carrier;
        $Airlines = $return_first_seg->Carrier;
        $Stops = count($flight->onward->segments)-1;
        $retStops = count($flight->return->segments)-1;
        $totalStops=count($flight->onward->segments)-1+count($flight->return->segments)-1;
        
if($flight->CabinClass!=null){
   $CabinClass = $flight->CabinClass;
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
    	<div id="ticketid0123" class="maderow flight" data-class="<?php echo ($flight->CabinClass!=null)?$flight->CabinClass:'';?>" data-airline="<?php echo $this->flight_model->get_airline_name($onward_first_seg->Carrier);?>" data-arrive="<?php echo $onward_ArrivalDateTime;?>" data-duration="<?php echo $jms;?>" data-stops="<?php echo $totalStops;?>" data-depature="<?php echo $depminutes;?>" data-airlinecode="<?php echo $onward_first_seg->Carrier;?>" data-price="<?php echo $this->account_model->currency_convertor($flight->TotalPrice+$TotalMarkupFeeAmount);?>">
    		<div class="col-md-12 nopad">
    			<!-- GOING TICKET-->
    			<div class="frow1">
    				<div class="col-md-12 nopad tablshow">
    					
    					<div class="col-md-12 nopad fulwidmob">
    						<div class="onwyrow">
    							<div class="col-md-2 col-xs-2 fulat500">
    								<div class="flitsecimg">
    									<img src="<?php echo ASSETS;?>images/airline_logo/<?php echo $onward_first_seg->Carrier;?>.gif" id="FF<?php echo str_replace('.', '', ($flight->TotalPrice+$TotalMarkupFeeAmount));?>" alt="">
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
    									<span class="norto lbold"><?php echo (($Stops>1)?$Stops." ".lang('STOP'):(($Stops==0)?lang('NONSTOP'):$Stops." ".lang('STOP')));?></span>
    								</div>
    							</div>
    						</div>
    						<div class="clear"></div>
    						<div class="onwyrow return">
    							<div class="col-md-2 col-xs-2 fulat500">
    								<div class="flitsecimg">
    									<img src="<?php echo ASSETS;?>images/airline_logo/<?php echo $onward_first_seg->Carrier;?>.gif" id="FF<?php echo str_replace('.', '', ($flight->TotalPrice+$TotalMarkupFeeAmount));?>" alt="">
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
    									<span class="norto lbold"><?php echo (($retStops>1)?$retStops." STOPS":(($retStops==0)?"NON STOP":$retStops." STOP"));?></span>
    								</div>
    							</div>
    						</div>
    						
    						<div class="clear"></div>
    						
    						<div class="pricefilt foronmob">
    							<span class="nortocount"><span class="curr_icon"><?php echo $this->display_icon;?></span><span class="amount"><?php echo $this->account_model->currency_convertor($flight->TotalPrice+$TotalMarkupFeeAmount);?></span></span>
    							<form name="flightbook" id="F<?php echo str_replace('.', '', ($flight->TotalPrice+$TotalMarkupFeeAmount));?>" action="<?php echo WEB_URL;?>">
    								<input type="hidden" name="temp_d" value="<?php echo $flight_data;?>" required />
    								<input type="hidden" name="temp_r" value="<?php echo $request;?>" required />
    								<input class="selectbtn FlightbookNow" type="button" name="button" data-attr="F<?php echo str_replace('.', '', ($flight->TotalPrice+$TotalMarkupFeeAmount));?>" value="<?=lang('SELECT');?>" />
    							</form>
    						</div>
    						
    						<div class="clear"></div>
    						<div class="toglerow">
    							<div class="clearfix">
    								<div class="pull-left">
    									<span class="f_color" style="font-size:12px;margin-left: 10px;"> <a class="href_<?php echo (1);?>" href="javascript:void(0);" id="<?php echo $last_getfare_details;?>" onclick="show_fare_popup(this.id,this,1)"><?=lang('DETAILED_FARE_CONDITIONS');?></a></span>
    									<!-- <br>
    									<span style="margin-left: 10px;"><small>"<?=lang('SR_FEE_NOTE');?> € 29.50"</small></span> -->
    								</div>
    								<div class="pull-right text-right">
    									<button class="lightbtn" type="button" data-toggle="collapse" data-target="#collapse"><img src="<?php echo ASSETS; ?>images/site/arrow_open.png" class="open_close_arrow"> <?=lang('FLIGHT_DETAILS');?></button>
    								</div>
    							</div>
    						</div>
    					</div>
    					
    					<div class="col-md-2 col-xs-2 nopad litblue white">
    						<!--<button class="lightbtn" type="button" data-toggle="collapse" data-target="#collapse10">More</button>-->
    						<div class="pricefilt">
    							<span class="nortocount"><span class="curr_icon"><?php echo $this->display_icon;?></span><span class="amount"><?php echo $this->account_model->currency_convertor($flight->TotalPrice+$TotalMarkupFeeAmount)/*.'-'.$TotalMarkupFeeAmount*/;?></span></span>
    							<form name="flightbook" id="F<?php echo str_replace('.', '', ($flight->TotalPrice+$TotalMarkupFeeAmount));?>" action="<?php echo WEB_URL;?>">
    								<input type="hidden" name="temp_d" value="<?php echo $flight_data;?>" required/>
    								<input type="hidden" name="temp_r" value="<?php echo $request;?>" required/>
    								<input class="selectbtn booking FlightbookNow" type="button" name="button" data-attr="F<?php echo str_replace('.', '', ($flight->TotalPrice+$TotalMarkupFeeAmount));?>" value="<?=lang('SELECT');?>" />
    							</form>
    						</div>
    					</div>
    					
    					
    				</div>
    				<div class="clearfix"></div>
    				<div  class="collapse frowexpand" id="collapse">
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
  			</div>
  		</div>
  		
  		<div class="col-md-8 col-xs-8 nopad fulat500">
  			<div class="col-md-5 col-xs-5">
  				<span class="radiobtnnill rittextalign"><?php echo $segment->Origin;?> <strong><?php echo date('H:i', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></strong></span>
  				<span class="norto rittextalign"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></span>
  				<span class="simle rittextalign"><?php echo $this->flight_model->get_airport_name($segment->Origin);?>,(<?php echo $this->flight_model->get_airport_cityname($segment->Origin);?>), (<?php echo ($this->flight_model->get_airport_citycode($segment->Origin));?>)</span>
  			</div>
  			<div class="col-md-2 col-xs-2">
  				<span class="timeclo"></span>
  				<span class="nortocen lbold"><?php echo  $dur;?></span>
  			</div>
  			<div class="col-md-5 col-xs-5">
  				<span class="radiobtnnill"><?php echo $segment->Destination;?> <strong><?php echo date('H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></strong></span>
  				<span class="norto"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span>
  				<span class="simle"><?php echo $this->flight_model->get_airport_name($segment->Destination);?>,(<?php echo $this->flight_model->get_airport_cityname($segment->Destination);?>), (<?php echo ($this->flight_model->get_airport_citycode($segment->Destination));?>)</span>
  			</div>
  		</div>
  		
  	</div>
  </div>
  
  
  <?php if(count($flight->onward->segments) > 0 &&  $key+1 < count($flight->onward->segments)){?>
  <div class="betwenrow">Change of Plane at <strong><?php echo $this->flight_model->get_airport_name($segment->Destination);?></strong>, | <strong>Layover: <?php echo $Layover;?></strong> </div>
  <div class="betwenrow" style="text-align: center;"><?=lang('TOTAL_JOURNEY_TIME');?> <strong><?php echo $onward_dur;?></strong></div>
  <?php } ?>
   
  <?php }?>
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
  			</div>
  		</div>
  		
  		<div class="col-md-8 col-xs-8 nopad fulat500">
  			<div class="col-md-5 col-xs-5">
  				<span class="radiobtnnill rittextalign"><?php echo $segment->Origin;?> <strong><?php echo date('H:i', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></strong></span>
  				<span class="norto rittextalign"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></span>
  				<span class="simle rittextalign"><?php echo $this->flight_model->get_airport_name($segment->Origin);?> ,(<?php echo $this->flight_model->get_airport_cityname($segment->Origin);?>), (<?php echo ($this->flight_model->get_airport_citycode($segment->Origin));?>)</span>
  			</div>
  			<div class="col-md-2 col-xs-2">
  				<span class="timeclo"></span>
  				<span class="nortocen lbold"><?php echo  $dur;?></span>
  			</div>
  			<div class="col-md-5 col-xs-5">
  				<span class="radiobtnnill"><?php echo $segment->Destination;?> <strong><?php echo date('H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></strong></span>
  				<span class="norto"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span>
  				<span class="simle"><?php echo $this->flight_model->get_airport_name($segment->Destination);?> ,(<?php echo $this->flight_model->get_airport_cityname($segment->Destination);?>), (<?php echo ($this->flight_model->get_airport_citycode($segment->Destination));?>)</span>
  			</div>
  		</div>
  	</div>
  </div>
  
  
  <div class="clear"></div>
  <?php if(count($flight->return->segments) > 0 &&  $key+1 < count($flight->return->segments)){?>
  <div class="betwenrow"><?=lang('CHANGE_OF_PLANE');?> <strong><?php echo $this->flight_model->get_airport_name($segment->Destination);?></strong>, | <strong>Layover: <?php echo $Layover;?></strong> </div>
  <div class="clear"></div>
   <div class="betwenrow" style="text-align: center;"><?=lang('TOTAL_JOURNEY_TIME');?> <strong><?php echo $return_dur;?></strong></div>
  <?php } ?>
  <?php }?>                            
  
</div>

</div> 
</div>
</div>
<!-- END OF GOING TICKET-->
</div>
</div>
<!-- Normal trip End-->
<?php } //$i++;}?>


   
