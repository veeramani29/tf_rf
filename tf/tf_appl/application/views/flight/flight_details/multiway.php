<?php
    $request = base64_encode(json_encode($req)); // request For reference
    $flight =$flights;
    $flight_data = base64_encode(json_encode($flight));
    
    $SAdults = $req->ADT;
    $SChildren = $req->CHD;


  //  $i=0;
   
   $price=array();$Stops=array();$Airlines=array();
   //echo "<pre/>";print_r($flights);die;
   // foreach($flights as $flight){
    
			
    	$totalsegments=count($flight->segments);
    	$fare_rules_key=array();$fare_rules_pro=array();$fare_rules_content=array();
    $fare_rules_key=array_unique($flight->Farerulesref_Key, SORT_REGULAR);
    $fare_rules_pro=array_unique($flight->Farerulesref_Provider, SORT_REGULAR);
    $fare_rules_content=array_unique($flight->Farerulesref_content, SORT_REGULAR);
    
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
		
    	$price = $flight->TotalPrice;
    	 $tot_city= count($flight->segments);
		 $total_seg= array_map("count", $flight->segments);
		$aaa= array_sum($total_seg);
		 $total_Stops=$aaa-$tot_city;
		$Stops=$total_Stops;
    	$Airlines = $flight->Carrier;

            if($flight->CabinClass!=null){
            $CabinClass = $flight->CabinClass;
            }
    	?>
    	
    <div id="ticketid0123" class="maderow flight frow1" data-class="<?php echo ($flight->CabinClass!=null)?$flight->CabinClass:'';?>" data-stops='<?php echo $total_Stops;?>' data-airlinecode="<?php echo $flight->Carrier;?>" data-airline="<?php echo $this->flight_model->get_airline_name($flight->Carrier);?>" data-price="<?php echo $this->account_model->currency_convertor($flight->TotalPrice);?>"><!--each row-->
    
    <div class="col-md-10 nopad"><!--flight details-->
		<?php 
    	
    		$all_seg = $flight->segments;
      // Added By Mukesh
    $MCalcCarriers = array();
    $WholeMarkups = array();

    $AllSegmentsArrays = $flight->segments;
    foreach ($AllSegmentsArrays as $AllSegmentsArray) {
      if(is_array($AllSegmentsArray)){
        foreach ($AllSegmentsArray as $ArraySegment) {
          $AllSegments[] = $ArraySegment;
        }   
      }
      else{
        $AllSegments[] = $AllSegmentsArray;
      }
    }
    
    foreach ($AllSegments as $Segment) {
        $DepartreDate = date('Y-m-d',strtotime($Segment->DepartureTime));
        $MCalcCarriers[] = array($Segment->Carrier,$DepartreDate);      
    }

    foreach ($MCalcCarriers as $MCalcCarrier) {
      $WholeMCalcCarrier = $this->flight_model->WholeMCalcCarrier($MCalcCarrier[0],$MCalcCarrier[1]);
      foreach ($WholeMCalcCarrier as $WholeM) {
        $WholeMarkups[] = array($WholeM->Type,$WholeM->AmountType,($WholeM->AmountType == 'Currency') ? $WholeM->Currency : $WholeM->Percent,$WholeM->MDId,$WholeM->Per,$WholeM->MaxAmount,$WholeM->HiddenStatus);
       // break;
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

    
    	foreach($all_seg as $all_segments){ 
			

			if(is_array($all_segments)){
				
				$Stop = count($all_segments)-1;
				$first_seg = reset($all_segments);
				$last_seg = end($all_segments);
			$fromCityName =  $this->flight_model->get_airport_cityname($first_seg->Origin);
			$toCityName =  $this->flight_model->get_airport_cityname($last_seg->Destination);
			 $ArrivalDateTime  = strtotime($last_seg->ArrivalTime);
    //echo $ArrivalDateTime;die;
    $DepartureDateTime  = strtotime($first_seg->DepartureTime);
    $seconds = $ArrivalDateTime - $DepartureDateTime;
    $jms = $seconds/60;
    $days = floor($seconds / 86400);
    $hours = floor(($seconds - ($days * 86400)) / 3600);
    $minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
    if($days==0){
    	$dur=$hours."h ".$minutes."m";  
    }else{
    	$dur=$days."d ".$hours."h ".$minutes."m";
    }

    ?>
    		<div class="frow1"><!--frow1-->
    			<div class="col-md-12 nopad tablshow">
    				<div class="col-md-12 col-xs-12 nopad fulwidmob">
    					<div class="onwyrow">
<div class="col-xs-2 nopad margtops"><!--air icon row-->

<div class="flitsecimg ">
<img src="<?php echo ASSETS;?>images/airline_logo/<?php echo ($first_seg->Carrier);?>.gif" id="FF<?php echo str_replace('.', '', ($flight->TotalPrice+$TotalMarkupFeeAmount));?>" alt="">
<span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($first_seg->Carrier);?></span>
</div>

</div><!--air icon row-->
    						<div class="col-xs-7 nopad fulat500">
    							<div class="col-md-5 col-xs-5">
									<br>
    								<div class="radiobtn"><b><?php echo $fromCityName;?></b> (<?php echo $first_seg->Origin;?>)</div>
    								<span class="f_color"><small><?=lang('DEPARTURE');?></small></span>
    								<span class="norto"><small><?php echo date('H:i', $this->flight_model->get_unixtimestamp($first_seg->DepartureTime));?> (<?php echo date('d M, D Y', $DepartureDateTime);?>)</small></span>
    							</div>
    							<div class="col-md-2 col-xs-2 nopad">
    								<div class="flightimgs">
    									<img src="<?php echo ASSETS;?>images/departure.png" alt="" />
    								</div>
    							</div>
    							<div class="col-md-5 col-xs-5">
									<br>
    								<span class="radiobtn"><b><?php echo $toCityName;?></b> (<?php echo $last_seg->Destination;?>)</span>
    								<span class="f_color"><small><?=lang('ARRIVAL');?></small></span>
    								<span class="norto"><small><?php echo date('H:i', $this->flight_model->get_unixtimestamp($last_seg->ArrivalTime));?> (<?php echo date('d M, D Y', $ArrivalDateTime);?>)</small></span>
    							</div>
    						</div>
    						
    						<div class="col-md-3  col-xs-3 nopad fulat500">
								<br>
    							<div class="fatfi">
    								<span class="norto"><img src="<?php echo ASSETS; ?>images/site/clk.png"> <?php echo $dur;?></span>
    								<span class="norto lbold"><?php echo (($Stop>1)?$Stop." STOPS":(($Stop==0)?"NON STOP":$Stop." STOP"));?></span>
    							</div>
    						</div>
    						
    						
    					</div>
    					
    					</div>
    					</div>
    					<hr style="margin:1px 0;"/>
    				</div> <!--frow1-->
    				
    				<?php		}else{
				
				$Stop = count($all_segments)-1;
				
				$fromCityName =  $this->flight_model->get_airport_cityname($all_segments->Origin);
				$toCityName =  $this->flight_model->get_airport_cityname($all_segments->Destination);
				 $ArrivalDateTime  = strtotime($all_segments->ArrivalTime);
    //echo $ArrivalDateTime;die;
    $DepartureDateTime  = strtotime($all_segments->DepartureTime);
    $seconds = $ArrivalDateTime - $DepartureDateTime;
    $jms = $seconds/60;
    $days = floor($seconds / 86400);
    $hours = floor(($seconds - ($days * 86400)) / 3600);
    $minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
    if($days==0){
    	$dur=$hours."h ".$minutes."m";  
    }else{
    	$dur=$days."d ".$hours."h ".$minutes."m";
    }

    ?>
    <div class="frow1"><!--frow1-->
    			<div class="col-md-12 nopad tablshow">
    				<div class="col-md-12 col-xs-12 nopad fulwidmob">
    					<div class="onwyrow">
    						<div class="col-xs-2 nopad margtops"><!--air icon row-->

<div class="flitsecimg ">
<img src="<?php echo ASSETS;?>images/airline_logo/<?php echo ($all_segments->Carrier);?>.gif" id="FF<?php echo str_replace('.', '', ($flight->TotalPrice+$TotalMarkupFeeAmount));?>" alt="">
<span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($all_segments->Carrier);?></span>
</div>

</div><!--air icon row-->
                            <div class="col-xs-7 nopad fulat500">
    							<div class="col-md-5 col-xs-5">
									<br>
    								<div class="radiobtn"><b><?php echo $fromCityName;?></b> (<?php echo $all_segments->Origin;?>)</div>
    								<span class="f_color"><small><?=lang('DEPARTURE');?></small></span>
    								<span class="norto"><small><?php echo date('H:i', $this->flight_model->get_unixtimestamp($all_segments->DepartureTime));?> (<?php echo date('d M, D Y', $DepartureDateTime);?>)</small></span>
    							</div>
    							<div class="col-md-2 col-xs-2 nopad">
    								<div class="flightimgs">
    									<img src="<?php echo ASSETS;?>images/departure.png" alt="" />
    								</div>
    							</div>
    							<div class="col-md-5 col-xs-5">
									<br>
    								<span class="radiobtn"><b><?php echo $toCityName;?></b> (<?php echo $all_segments->Destination;?>)</span>
    								<span class="f_color"><small><?=lang('ARRIVAL');?></small></span>
    								<span class="norto"><small><?php echo date('H:i', $this->flight_model->get_unixtimestamp($all_segments->ArrivalTime));?> (<?php echo date('d M, D Y', $ArrivalDateTime);?>)</small></span>
    							</div>
    						</div>
    						
    						<div class="col-md-3  col-xs-3 nopad fulat500">
								<br>
    							<div class="fatfi">
    								<span class="norto"><img src="<?php echo ASSETS; ?>images/site/clk.png"> <?php echo $dur;?></span>
    								<span class="norto lbold"><?php echo (($Stop>1)?$Stop." STOPS":(($Stop==0)?"NON STOP":$Stop." STOP"));?></span>
    							</div>
    						</div>
    						
    						
    					</div>
    					
    					</div>
    					</div>
    					<hr style="margin:1px 0;"/>
    				</div> <!--frow1-->
    <?php	} ?>
		
		<?php } ?>
    
  
				
    				
    			</div><!--flight details-->
    			<div class="col-md-2 nopad margtops"><!--price-->
    			<div class="pricefilt foronmob">
    						<span class="nortocount"><span class="curr_icon"><?php echo $this->display_icon;?></span><span class="amount"><?php echo $this->account_model->currency_convertor($flight->TotalPrice+$TotalMarkupFeeAmount);?></span></span>
    						<form name="flightbook" id="F<?php echo str_replace('.', '', ($flight->TotalPrice+$TotalMarkupFeeAmount));?>" action="<?php echo WEB_URL;?>">
    							<input type="hidden" name="temp_d" value="<?php echo $flight_data;?>" required/>
    							<input type="hidden" name="temp_r" value="<?php echo $request;?>" required/>
    							<input class="selectbtn FlightbookNow" type="button" name="button" data-attr="F<?php echo str_replace('.', '', ($flight->TotalPrice+$TotalMarkupFeeAmount));?>" value="<?=lang('SELECT');?>" />
    						</form>
    					</div>
    					<div class="col-md-2 nopad litblue white">
    					<div class="pricefilt">
    						<span class="nortocount"><span class="curr_icon"><?php echo $this->display_icon;?></span><span class="amount"><?php echo $this->account_model->currency_convertor($flight->TotalPrice+$TotalMarkupFeeAmount);?></span></span>
    						<form name="flightbook" id="F<?php echo str_replace('.', '', ($flight->TotalPrice+$TotalMarkupFeeAmount));?>" action="<?php echo WEB_URL;?>">
    							<input type="hidden" name="temp_d" value="<?php echo $flight_data;?>" required/>
    							<input type="hidden" name="temp_r" value="<?php echo $request;?>" required/>
    							<input class="selectbtn booking FlightbookNow" type="button" name="button" data-attr="F<?php echo str_replace('.', '', ($flight->TotalPrice+$TotalMarkupFeeAmount));?>" value="<?=lang('SELECT');?>" />
    						</form>
    					</div>
    				</div>
    			</div><!--price-->
    			<div class="clear"></div>
    			<div class="row">
					<div class="col-md-12">
    			<div class="toglerow"><!--toglerow-->
    						
    							<div class="pull-left">
    								<span class="f_color" style="font-size:12px;margin-left: 10px;"> <a class="href_<?php echo (1);?>" href="javascript:void(0);" id="<?php echo $last_getfare_details;?>" onclick="show_fare_popup(this.id,this,1)"><?=lang('DETAILED_FARE_CONDITIONS');?></a></span>
    								<!-- <br>
    								<span style="margin-left: 10px;"><small>"<?=lang('SR_FEE_NOTE');?>"</small></span> -->
    							</div>
    							<div class="pull-right text-right">
    								<button class="lightbtn" type="button" data-toggle="collapse" data-target="#collapse"><img src="<?php echo ASSETS; ?>images/site/arrow_open.png" class="open_close_arrow"> <?=lang('FLIGHT_DETAILS');?></button>
    							</div>
    						
    					</div><!--toglerow-->
    			</div>
    			</div>
    		<div class="clearfix"></div>
    		<!-- Toogle Div-->	
    			<div  class="collapse frowexpand" id="collapse">
                <div class="col-md-12 nopad tablshow">
                	<div class="col-md-12 nopad fulwidmob">
							<?php 
                		$s=0; $ssss=0;
                		foreach($flight->segments as $key => $segment){
						
if(!is_array($segment)){
$ArrivalDateTime  = strtotime($segment->ArrivalTime);
//echo $ArrivalDateTime;die;
$DepartureDateTime  = strtotime($segment->DepartureTime);
$seconds = $ArrivalDateTime - $DepartureDateTime;
$days = floor($seconds / 86400);
$hours = floor(($seconds - ($days * 86400)) / 3600);
$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
if($days==0){
	$dur=$hours."h ".$minutes."m";  
}else{
	$dur=$days."d ".$hours."h ".$minutes."m";
}

?>

 <div class="repflight formultity">
	<?php 		
	
				$vv=$ssss+1;
  				$class_arr=array('','pikeronwds','pikerret','pikermulti','pikeronwds','pikerret','pikermulti');
  				$range=($vv==1)?'st':(($vv==2)?'nd':(($vv==3)?'rd':(($vv>3)?'th':'')));
  				?> 
	 <div class="<?php echo ($vv<7)?$class_arr[$vv]:$class_arr[2];?>"><?php echo ($vv)."<sup>".$range."</sup> Flight";?></div>
  	<div class="col-md-4 col-xs-4 fulat500">
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
  			<span class="nortocen lbold"><?php echo $dur;?></span>
  		</div>
  		<div class="col-md-5 col-xs-5">
  			<span class="radiobtnnill"><?php echo $segment->Destination;?> <strong><?php echo date('H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></strong></span>
  			<span class="norto"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span>
  			<span class="simle"><?php echo $this->flight_model->get_airport_name($segment->Destination);?>,(<?php echo $this->flight_model->get_airport_cityname($segment->Destination);?>), (<?php echo ($this->flight_model->get_airport_citycode($segment->Destination));?>)</span>
  		</div>
  	</div>
  	
  </div>
  <div class="clear"></div>
  <?php $ssss++;} else{ 
	 
	  $numberof_seg=count($segment);
	$extra_segment=$segment;
	//echo '<pre>';
	//print_r($extra_segment[0]);
			$v=0; 
	   foreach($extra_segment as $keys => $segment){
		 
$ArrivalDateTime  = strtotime($segment->ArrivalTime);

$DepartureDateTime  = strtotime($segment->DepartureTime);

$seconds = $ArrivalDateTime - $DepartureDateTime;

$days = floor($seconds / 86400);
$hours = floor(($seconds - ($days * 86400)) / 3600);
$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
if($days==0){
	$dur=$hours."h ".$minutes."m";  
}else{
	$dur=$days."d ".$hours."h ".$minutes."m";
}

if($numberof_seg > 0 &&  $keys+1 < $numberof_seg){
	
    //Exploding T from arrival time  
	list($date, $time) = explode('T',  $extra_segment[$keys]->ArrivalTime);
	$time = preg_replace("/[.]/", " ", $time);
	list($time, $TimeOffSet) = explode(" ", $time);
    $ArrivalDateTime1 = $date." ".$time; //Exploding T and adding space
    $ArrivalDateTime1 = $art = strtotime($ArrivalDateTime1);
    //echo $ArrivalDateTime;die;

    //Exploding T from depature time  
    list($date, $time) = explode('T', $extra_segment[$keys+1]->DepartureTime);
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

    $tot_dur = $this->flight_model->get_duration(strtotime($extra_segment[$keys]->DepartureTime),strtotime($extra_segment[$keys+1]->ArrivalTime));
  }
	  ?>
	  
 <div class="repflight formultity">
	 <?php 
	 
		  $vv=$ssss+1;
	
  				
  				
  				$class_arr=array('','pikeronwds','pikerret','pikermulti','pikeronwds','pikerret','pikermulti');
  				$range=($vv==1)?'st':(($vv==2)?'nd':(($vv==3)?'rd':(($vv>3)?'th':'')));
  				?> 
	 <div class="<?php echo ($vv<7)?$class_arr[$vv]:$class_arr[2];?>"><?php echo ($vv)."<sup>".$range."</sup> Flight";?></div>
	
  	<div class="col-md-4 col-xs-4 fulat500">
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
  			<span class="nortocen lbold"><?php echo $dur;?></span>
  		</div>
  		<div class="col-md-5 col-xs-5">
  			<span class="radiobtnnill"><?php echo $segment->Destination;?> <strong><?php echo date('H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></strong></span>
  			<span class="norto"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span>
  			<span class="simle"><?php echo $this->flight_model->get_airport_name($segment->Destination);?>,(<?php echo $this->flight_model->get_airport_cityname($segment->Destination);?>), (<?php echo ($this->flight_model->get_airport_citycode($segment->Destination));?>)</span>
  		</div>
  	</div>
  	 <div class="clear"></div>
  <?php  if($numberof_seg > 0 &&  $keys+1 < $numberof_seg){ ?>
  <div class="betwenrow"><?=lang('CHANGE_OF_PLANE');?> <strong><?php echo $this->flight_model->get_airport_name($segment->Destination);?></strong>, | <strong>Layover: <?php echo $Layover;?></strong> </div>
  <div class="clear"></div>
   <div class="betwenrow" style="text-align: center;"><?=lang('TOTAL_JOURNEY_TIME');?> <strong><?php echo $tot_dur;?></strong></div>
  <?php } ?>
  </div>
 
<?php   $v++; $ssss++;} ?>
	  
	  
	  
	<?php   } ?>
  <?php  $s++;} ?>
						</div>
						</div>
						</div><!-- Toogle Div-->	
   
					

    			</div><!--each row-->
    
						
    	<?php //$i++;}?>
   