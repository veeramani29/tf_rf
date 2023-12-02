<?php
    $flights_data = base64_encode(json_encode($flights)); // For reference
    $request = base64_encode(json_encode($request)); // request For reference
    //$flights_data = json_decode(base64_decode($flights_data));
    //echo'<pre>'; print_r($flights_data);die; 
    $flights = json_decode(json_encode($flights));
    $i=0;
   // echo'<pre>'; print_r($flights);
    foreach($flights as $flight){
    	$flight_data = base64_encode(json_encode($flight));
    	$first_seg = reset($flight->segments);
    	$last_seg = end($flight->segments);
    	$fromCityName =  $this->flight_model->get_airport_cityname($first_seg->Origin);
    	$toCityName =  $this->flight_model->get_airport_cityname($last_seg->Destination);
		$totalsegments=count($flight->segments);
    	$fare_rule_refkey=$flight->Farerulesref_Key;
    	$Farerulesref_Provider=$flight->Farerulesref_Provider;
    	$fare_rules_content=$flight->Farerulesref_content;
    	$getfare_details=base64_encode($fare_rule_refkey."|fare|".$Farerulesref_Provider."|fare|".$fare_rules_content."|fare|".$totalsegments);
		
    	$price[] = $flight->TotalPrice;
    	$Airlines[] = $first_seg->Carrier;
    	$Stops[] = count($flight->segments)-1;
    	
    
    $ArrivalDateTime = $art = strtotime($last_seg->ArrivalTime);
    //echo $ArrivalDateTime;die;
    $DepartureDateTime = $dpt = strtotime($first_seg->DepartureTime);
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
    if($days==0){
    	$tot_dur=$hours."h ".$minutes."m";  
    }else{
    	$tot_dur=$days."d ".$hours."h ".$minutes."m";
    }
    $deptime = date('H:i', $DepartureDateTime);
    list($hours, $min) = explode(':', $deptime);
    $depminutes=$hours*60;
    $depminutes=$depminutes+$min;
    ?>


    <!-- Normal trip-->
    <div id="ticketid0123<?php echo $i;?>" class="maderow flight" data-airline="<?php echo $this->flight_model->get_airline_name($first_seg->Carrier);?>" data-arrive="<?php echo $ArrivalDateTime;?>" data-duration="<?php echo $jms;?>" data-stops="<?php echo count($flight->segments)-1;?>" data-depature="<?php echo $depminutes;?>" data-airlinecode="<?php echo $first_seg->Carrier;?>" data-price="<?php echo $this->account_model->currency_convertor($flight->TotalPrice);?>">
    	<div class="col-md-12 nopad">
    		<!-- GOING TICKET-->
    		<div class="frow1">
    			<div class="col-md-12 nopad tablshow">
    				
    				<div class="col-md-12 col-xs-12 nopad fulwidmob">
    					<div class="onwyrow">
    						<div class="col-md-2 col-xs-2 fulat500">
    							<div class="flitsecimg">
    								<img src="<?php echo ASSETS;?>images/airline_logo/<?php echo $first_seg->Carrier;?>.gif" id="FF<?php echo str_replace('.', '', $flight->TotalPrice).$i;?>" alt="">
    								<span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($first_seg->Carrier);?></span>
    							</div>
    						</div>
    						
    						<div class="col-md-7 col-xs-7 nopad fulat500">
    							<div class="col-md-5 col-xs-5">
    								<br>
    								<div class="radiobtn"><b><?php echo $fromCityName;?></b> (<?php echo $first_seg->Origin;?>)</div>
    								<span class="f_color"><small>VERTREK</small></span>
    								<span class="norto"><small><?php echo date('H:i', $this->flight_model->get_unixtimestamp($first_seg->DepartureTime));?> (<?php echo date('d M, D Y', $DepartureDateTime);?>)</small></span>
    							</div>
    							<div class="col-md-2 col-xs-2 nopad">
    								<br>
    								<div class="flightimgs">
    									<img src="<?php echo ASSETS;?>images/departure.png" alt="" />
    								</div>
    							</div>
    							<div class="col-md-5 col-xs-5">
    								<br>
    								<span class="radiobtn"><b><?php echo $toCityName;?></b> (<?php echo $last_seg->Destination;?>)</span>
    								<span class="f_color"><small>AANKOMST</small></span>
    								<span class="norto"><small><?php echo date('H:i', $this->flight_model->get_unixtimestamp($last_seg->ArrivalTime));?> (<?php echo date('d M, D Y', $ArrivalDateTime);?>)</small></span>
    							</div>
    						</div>
    						
    						<div class="col-md-3  col-xs-3 nopad fulat500">
    							<br>
    							<div class="fatfi">
    								<span class="norto"><img src="<?php echo ASSETS; ?>images/site/clk.png"> <?php echo $dur;?></span>
    								<span class="norto lbold"><?php echo (($Stops[$i]>1)?$Stops[$i]." STOPS":(($Stops[$i]==0)?"NON STOP":$Stops[$i]." STOP"));?></span>
    							</div>
    						</div>
    					</div>
    					
    					<div class="clear"></div>
    					<div class="pricefilt foronmob">
    						<span class="nortocount"><span class="curr_icon"><?php echo $this->display_icon;?></span><span class="amount"><?php echo $this->account_model->currency_convertor($flight->TotalPrice);?></span></span>
    						<form name="flightbook<?php echo $i;?>" id="F<?php echo str_replace('.', '', $flight->TotalPrice).$i;?>" action="<?php echo WEB_URL;?>">
    							<input type="hidden" name="temp_d" value="<?php echo $flight_data;?>" required/>
    							<input type="hidden" name="temp_r" value="<?php echo $request;?>" required/>
    							<input class="selectbtn FlightbookNow" type="button" name="button" data-attr="F<?php echo str_replace('.', '', $flight->TotalPrice).$i;?>" value="Select" />
    						</form>
    					</div>
    					
    					<div class="clear"></div>
    					<div class="toglerow">
    						<div class="clearfix">
    							<div class="pull-left">
    								<span class="f_color" style="font-size:12px;margin-left: 10px;"> <a class="href_<?php echo ($i+1);?>" href="javascript:void(0);" id="<?php echo $getfare_details;?>|@|0" onclick="show_fare_popup(this.id,this)">Detailed fare Conditions &amp; Information</a></span>
    								<br>
    								<span style="margin-left: 10px;"><small>"Prijzen per persoon excl. eenmaling per boeking € 29.50"</small></span>
    							</div>
    							<div class="pull-right text-right">
    								<button class="lightbtn" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i;?>"><img src="<?php echo ASSETS; ?>images/site/arrow_open.png" class="open_close_arrow"> Flight Details</button>
    							</div>
    						</div>
    					</div>
    				</div> 
    				<div class="col-md-2 nopad litblue white">
    					<!--<button class="lightbtn" type="button" data-toggle="collapse" data-target="#collapse10">More</button>-->
    					<div class="pricefilt">
    						<span class="nortocount"><span class="curr_icon"><?php echo $this->display_icon;?></span><span class="amount"><?php echo $this->account_model->currency_convertor($flight->TotalPrice);?></span></span>
    						<form name="flightbook<?php echo $i;?>" id="F<?php echo str_replace('.', '', $flight->TotalPrice).$i;?>" action="<?php echo WEB_URL;?>">
    							<input type="hidden" name="temp_d" value="<?php echo $flight_data;?>" required/>
    							<input type="hidden" name="temp_r" value="<?php echo $request;?>" required/>
    							<input class="selectbtn booking FlightbookNow" type="button" name="button" data-attr="F<?php echo str_replace('.', '', $flight->TotalPrice).$i;?>" value="Select" />
    						</form>
    					</div>
    				</div>
    			</div>
    			<div class="clearfix"></div>
    			<div  class="collapse frowexpand" id="collapse<?php echo $i;?>">
    				
                
                <!-- end flight details -->
                <div class="col-md-12 nopad tablshow">
                	
                	

                	<div class="col-md-12 nopad fulwidmob">
                		<?php 
                		$s=0;
                		foreach($flight->segments as $key => $segment){

$ArrivalDateTime = $art = strtotime($segment->ArrivalTime);
//echo $ArrivalDateTime;die;


$DepartureDateTime = $dpt = strtotime($segment->DepartureTime);

$seconds = $ArrivalDateTime - $DepartureDateTime;

$days = floor($seconds / 86400);
$hours = floor(($seconds - ($days * 86400)) / 3600);
$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
if($days==0){
	$dur=$hours."h ".$minutes."m";  
}else{
	$dur=$days."d ".$hours."h ".$minutes."m";
}
if(count($flight->segments) > 0 &&  $key+1 < count($flight->segments)){
    //Exploding T from arrival time  
	list($date, $time) = explode('T',  $flight->segments[$key]->ArrivalTime);
	$time = preg_replace("/[.]/", " ", $time);
	list($time, $TimeOffSet) = explode(" ", $time);
    $ArrivalDateTime1 = $date." ".$time; //Exploding T and adding space
    $ArrivalDateTime1 = $art = strtotime($ArrivalDateTime1);
    //echo $ArrivalDateTime;die;

    //Exploding T from depature time  
    list($date, $time) = explode('T', $flight->segments[$key+1]->DepartureTime);
    $time = preg_replace("/[.]/", " ", $time);
    list($time, $TimeOffSet) = explode(" ", $time);
    $DepartureDateTime1 = $date." ".$time; //Exploding T and adding space
    $DepartureDateTime1 = $dpt = strtotime($DepartureDateTime1);

    $seconds1 = $DepartureDateTime1 - $ArrivalDateTime1;

    $days1 = floor($seconds1 / 86400);
    $hours1 = floor(($seconds1 - ($days1 * 86400)) / 3600);
    $minutes1 = floor(($seconds1 - ($days1 * 86400) - ($hours1 * 3600))/60);
    // $seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
    if($days1==0){
    	$Layover=$hours1."h ".$minutes1."m";  
    }else{
    	$Layover=$days1."d ".$hours1."h ".$minutes1."m";
    }
  }
  ?>                        
  <div class="repflight formultity">
  	<div class="col-md-4 col-xs-4 fulat500">
  		<div class="alldetss">
  			<div class="detflitimg">
  				<img src="<?php echo ASSETS;?>images/airline_logo/<?php echo $segment->Carrier;?>.gif"  alt=""/>
  				<?php 
  				$vv=$s+1;
  				$range=($vv==1)?'st':(($vv==2)?'nd':(($vv==3)?'rd':(($vv>3)?'th':'')));
  				?>
  				<small class="text-success"><span class="flight-number"><?php echo ($vv)."<sup>".$range."</sup></span> Flight";?></small>
  			</div>
  			<span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($segment->Carrier);?><?php //echo $segment->FlightNumber;?><br><?php echo $segment->Carrier;?><?php echo (isset($segment->Equipment))?"-".$segment->Equipment:"";?></span>
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
  <?php if(count($flight->segments) > 0 &&  $key+1 < count($flight->segments)){?>
  <div class="betwenrow">Change of Plane at <strong><?php echo $this->flight_model->get_airport_name($segment->Destination);?></strong>, | <strong>Layover: <?php echo $Layover;?></strong> </div>
  <div class="clear"></div>
  <?php } ?>
  <?php $s++; }?>                            
   <div class="betwenrow" style="text-align: center;">Total Journey Time <strong><?php echo $tot_dur;?></strong></div>
</div>

</div> 
</div>
</div>
<!-- END OF GOING TICKET-->
</div>
</div>
<!-- Normal trip End-->
<?php $i++;}?>
<?php 
echo '<div id="errorMessage" style="text-align:center;display:none;" class="no_available">
<h1>There are no flights available. </h1>
<br><br>
<div class="no_available_text">Sorry, we have no prices for flights in this date range matching your criteria. One or more of your preferences may be affecting the number of exact matches found. Try searching again with a wider search criteria. <br></div>
    </div>'; // Error Message
    ?>
    <?php $Airlines = array_unique($Airlines); //Creating Unique Airlines?>
    <?php $Stops = array_unique($Stops); //Creating Unique Airlines?>
    <input type="hidden" name="temp_d" value="<?php echo $flights_data;?>"/>
    <input type="hidden" id="setMinPrice" value="<?php if(!empty($price)) echo min($price); else echo 0; ?>" />
    <input type="hidden" id="setMaxPrice" value="<?php if(!empty($price)) echo max($price); else echo 0; ?>" />
    <input type="hidden" id="setMinTime" value="0" />
    <input type="hidden" id="setMaxTime" value="1440" />
    <script>
    	function showFlights(minPrice, maxPrice) {
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
  }
  $('#pricerange').addClass('in');
  $(function() {
  	$("p#total-search").html("<?php echo count($flights);?>");
  	
  	$( "#slider-range" ).slider({
  		range: true,
  		min: <?php echo $this->account_model->currency_convertor(min($price))?>,
  		max: <?php echo $this->account_model->currency_convertor(max($price))?>,
  		values: [ <?php echo $this->account_model->currency_convertor(min($price))?>, <?php echo $this->account_model->currency_convertor(max($price))?> ],
  		slide: function( event, ui ) {
  			$( "#amount" ).val( "<?php echo $this->display_icon;?>" + ui.values[ 0 ] + " - <?php echo $this->display_icon;?>" + ui.values[ 1 ] );
  		},
  		change: function( event, ui ) {
  			one=ui.values[0];
  			two=ui.values[1];
         //alert(one+'-'+two);
         showFlights(one, two);
         
       }
     });
  	$( "#amount" ).val( "<?php echo $this->display_icon;?>" + $( "#slider-range" ).slider( "values", 0 ) +
  		" - <?php echo $this->display_icon;?>" + $( "#slider-range" ).slider( "values", 1 ) );
  });

  var startTime;
  var endTime;
  function slideTime(event, ui){
  	var val0 = $("#DepSlider").slider("values", 0),
  	val1 = $("#DepSlider").slider("values", 1),
  	minutes0 = parseInt(val0 % 60, 10),
  	hours0 = parseInt(val0 / 60 % 24, 10),
  	minutes1 = parseInt(val1 % 60, 10),
  	hours1 = parseInt(val1 / 60 % 24, 10);
  	
  	startTime = getTime(hours0, minutes0);
  	endTime = getTime(hours1, minutes1);
    // startTime = hours0+':'+minutes0;
    // endTime = hours1+':'+minutes1;
    $("#Dep").val(startTime + ' - ' + endTime);
  }
  function getTime(hours, minutes) {
  	var time = null;
  	minutes = minutes + "";
  	if (hours < 12) {
  		time = "AM";
  	}
  	else {
  		time = "PM";
  	}
  	if (hours == 0) {
  		hours = 12;
  	}
  	if (hours > 12) {
  		hours = hours - 12;
  	}
  	if (minutes.length == 1) {
  		minutes = "0" + minutes;
  	}
  	return hours + ":" + minutes + " " + time;
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
         showDepFlights(one, two);
         
       }
     });
  slideTime();
  $('#airlines').addClass('in');
  $('#AirlineFilter').html('<?php $i=1;foreach($Airlines as $airline){?><li class="cheklist"><label for="airline<?php echo $i;?>"><div class="left"><input class="filtchk serch-blue airline" name="airline" type="checkbox" id="airline<?php echo $i;?>" value="<?php echo $airline;?>" checked/></div><span class="cheklabl"><?php echo $this->flight_model->get_airline_name($airline);?></span><label></li><?php $i++; }?>');       
var $filters = $("input:checkbox[name='airline']"); // start all checked
var $categoryContent = $('div.flights div.flight'); // Path for flights
var $errorMessage = $('#errorMessage'); //Error Message
//$filters.click(function() {
	$filters.on('ifChanged', function(event){
  $categoryContent.hide(); // if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
  var $selectedFilters = $filters.filter(':checked');
  //console.log($selectedFilters);
  if ($selectedFilters.length > 0) {
  	$errorMessage.hide();
  	$selectedFilters.each(function (i, el) {
  		$('div.flights div.flight[data-airlinecode="'+ el.value +'"]').show();
  	});
  } else {
  	$errorMessage.show();
  }
});
	$('#stops').addClass('in');
	$('#StopFilter').html('<?php $i=1;foreach($Stops as $stop){?><li class="cheklist"><label for="stop<?php echo $i;?>"><div class="left"><input class="filtchk serch-blue stop" name="stop" type="checkbox" id="stop<?php echo $i;?>" value="<?php echo $stop;?>" checked/></div><span class="cheklabl"><?php if($stop == 0){ echo 'Non';}else if($stop == 1){echo 'One';}else if($stop == 2){echo 'Two';}else if($stop == 3){echo 'Three';}else if($stop == 4){echo 'Four';}else if($stop == 5){echo 'Five';}else{echo $stop;}?>-Stop</span><label></li><?php $i++; }?>');
var $filters1 = $("input:checkbox[name='stop']"); // start all checked
var $categoryContent1 = $('div.flights div.flight'); // Path for flights
var $errorMessage = $('#errorMessage'); //Error Message
$filters1.on('ifChanged', function(event){
  $categoryContent1.hide(); // if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
  var $selectedFilters1 = $filters1.filter(':checked');
  //console.log($selectedFilters);
  if ($selectedFilters1.length > 0) {
  	$errorMessage.hide();
  	$selectedFilters1.each(function (i, el) {
  		$('div.flights div.flight[data-stops="'+ el.value +'"]').show();
  	});
  } else {
  	$errorMessage.show();
  }
});
$('input.serch-blue').iCheck({
	checkboxClass: 'icheckbox_flat-blue',
	radioClass: 'iradio_flat'
});
</script>
