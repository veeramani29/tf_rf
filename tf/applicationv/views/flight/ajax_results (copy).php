<?php
    $flights_data = base64_encode(json_encode($flights)); // For reference
    $request = base64_encode(json_encode($request)); // request For reference
    //$flights_data = json_decode(base64_decode($flights_data));
    //echo'<pre>'; print_r($flights_data);die; 
    $flights = json_decode(json_encode($flights));
    //echo count($flights);exit;
    $i=0;
  //  echo'<pre>'; print_r($flights);die; 
    foreach($flights as $flight){
    	$flight_data = base64_encode(json_encode($flight));
    	$first_seg = reset($flight->segments);
    	$last_seg = end($flight->segments);
    	$fromCityName =  $this->flight_model->get_airport_cityname($first_seg->Origin);
    	$toCityName =  $this->flight_model->get_airport_cityname($last_seg->Destination);
    	$farekey=$flight->AirPricingSolution_Key;
    	 $Tot_ttime =$flight->TravelTime;
		$exp_Time=explode("T",$Tot_ttime);
		$exp_M=explode("M",$exp_Time[1]);
		$Tot_traveltime=str_replace("P","",$exp_Time[0]).$exp_M[0]."M";
    	$price[] = $flight->TotalPrice;
    	$Airlines[] = $first_seg->Carrier;
    	$Stops[] = count($flight->segments)-1;

    //Exploding T from arrival time  
    	list($date, $time) = explode('T', $last_seg->ArrivalTime);
    	$time = preg_replace("/[.]/", " ", $time);
    	list($time, $TimeOffSet) = explode(" ", $time);
    $ArrivalDateTime = $date." ".$time; //Exploding T and adding space
    $ArrivalDateTime = $art = strtotime($ArrivalDateTime);
    //echo $ArrivalDateTime;die;

    //Exploding T from depature time  
    list($date, $time) = explode('T', $first_seg->DepartureTime);
    $time = preg_replace("/[.]/", " ", $time);
    list($time, $TimeOffSet) = explode(" ", $time);
    $DepartureDateTime = $date." ".$time; //Exploding T and adding space
    $DepartureDateTime = $dpt = strtotime($DepartureDateTime);

    $seconds = $ArrivalDateTime - $DepartureDateTime;
    $jms = $seconds/60;
    $days = floor($seconds / 86400);
    $hours = floor(($seconds - ($days * 86400)) / 3600);
    $minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
    // $seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
    if($days==0){
    	$dur=$hours."h ".$minutes."m";  
    }else{
    	$dur=$days."d ".$hours."h ".$minutes."m";
    }

    $deptime = date('H:i', $DepartureDateTime);
    list($hours, $min) = explode(':', $deptime);
    $depminutes=$hours*60;
    $depminutes=$depminutes+$min;
    ?>




 <!-- DESIGN AND FUNCTIONALITY CHANGES BY PRAKASH -->
          <div id="wrapper" <?php if($_REQUSET['mode'] == 'one_way'){ if($flex_air_segment_date){echo "style='height: 397px;'";}else{echo "style='height: 200px;'"; } } elseif($_SESSION['mode'] == 'round_trip') { if($flex_air_segment_date){echo "style='height: 323px;'";}else{echo "style='height: 200px;'";} }?> >
            <!-- <div class="loading"></div> -->
            <?
            if($_SESSION['mode'] != 'multi_city'){
            ?>
            <div class="chart">
              <div class="date head">Vluchten voor <span style="color:#4793de"><?=$origin_name[0]['airport'].' ('.$_SESSION['origin'][0].')'?> - <?=$destination_name[0]['airport'].' ('.$_SESSION['destination'][0].')'?></span></div>
              <ul class="legend">
                <li><span class="lowest_fare"></span>Lowest Fare Per Week</li><br/>
                <li><span class="selected_date"></span>Selected Date of Journey</li><br/>
                <li><span class="normal_fare"></span>Normal Fare Per Week</li>
              </ul>
              <div id="wrap">
                <?
                if(@!$to_date){
                ?>
                    <!-- <div class="date">Vluchten voor <span style="color:#4793de"><?=$origin_name[0]['airport'].' ('.$_SESSION['origin'][0].')'?> - <?=$destination_name[0]['airport'].' ('.$_SESSION['destination'][0].')'?></span></div> -->
                    <div class="date"><span style="color:#f77f00">Heenreis:</span>
                    <?php 
                      $show_date = DateTime::createFromFormat('d/m/Y', $from_date[0])->format('Y-m-d');
                      $timestamp = strtotime($show_date);
                      echo date("d M Y", $timestamp);
                    ?>
                    </div>
                    <div class="mars-new center" id="list">
                <?
                }
                ?>
                  <?
                  if(@$to_date){
                  ?>
                    <!-- <div class="date">Vluchten voor <span style="color:#4793de"><?=$origin_name[0]['airport'].' ('.$_SESSION['origin'][0].')'?> - <?=$destination_name[0]['airport'].' ('.$_SESSION['destination'][0].')'?></span></div> -->
                    <div class="mars-new col-md-12" id="round_list">
                  <?
                  }
                  ?>
                  <!-- <div class="prev"><img src="images/prev.jpg" alt="prev" /></div> -->
                  <!-- This is for graph -->
                    <?
                    if($_SESSION['mode'] == 'one_way'){
                    ?>
                    <div class="slider1 inputsDiv" <?php if($_SESSION['mode'] == 'one_way'){ echo "style='margin-left: 50px;'"; } elseif ($_SESSION['mode'] == 'round_trip') { echo "style='margin-left: 15px;'"; }?>>
                      <ul>
                        <?
                        if($flex_air_segment_date){
                          foreach ($flex_air_segment_date as $key => $value) {
                            $timestamp = strtotime($key);
                            $dt1=date("d M Y", $timestamp);
                            if($value == '0'){
                            ?>
                              <li style="padding: 0 2px;">
                                <a href="javascript:void(0);"><span class="" jt="onward"></span>
                                <img src="images/search-icon.png" style="height:25px;width:30px;"/></a>
                                <span class="datrs"><?=explode("-", $key)[2]?></span>
                                <?
                                $timestamp = strtotime($key);
                                $day = date('D', $timestamp);
                                ?>
                                <span class="cntir"><?=$day?></span>
                              </li>
                            <?
                            }else{
                          ?>
                              <li>
                                <a href="javascript:void(0);" ><span class="priceflag" jt="onward">&euro;<?=str_replace("EUR","",$value)?></span><span class="colr-he heit-sm3" id="<?=$dt1?>, &euro;<?=str_replace("EUR","",$value)?>" title="<?=$dt1?>, &euro;<?=str_replace("EUR","",$value)?>"></span></a>
                                <span class="datrs"><?=explode("-", $key)[2]?></span>
                                <?
                                $timestamp = strtotime($key);
                                $day = date('D', $timestamp);
                                ?>
                                <span class="cntir"><?=$day?></span>
                              </li>
                          <?
                            }
                          }
                        }else{
                          for($i=0;$i<7;$i++){
                          ?>
                            <li style="padding: 0 2px;">
                              <a href="javascript:void(0);"><span class="" jt="onward"></span>
                              <img src="images/search-icon.png" style="height:25px;width:30px;"/></a>
                              <span class="datrs"></span>
                              <span class="cntir"></span>
                            </li>
                          <?
                          } 
                        }
                        ?>
                      </ul>
                      <?
                        $timestamp = DateTime::createFromFormat('d/m/Y', $_SESSION['from'][0])->format('Y-m-d');
                        $start = strtotime($timestamp);
                        $start = date('d M Y', $start);
                      ?>
                      <span class="mnt-clas"><?=$start?></span>
                    <?
                    }elseif($_SESSION['mode'] == 'round_trip'){
                    ?>
                    <div class="slider2 inputsDiv col-md-12" <?php if($_SESSION['mode'] == 'one_way'){ echo "style='margin-left: 50px;'"; } elseif ($_SESSION['mode'] == 'round_trip') { echo "style='margin-left: 15px;'"; }?>>
                    <ul>
                      <?
                      if($flex_air_segment_date){
                        foreach ($flex_air_segment_date as $key => $value) {
                          if($value['price'] == '0'){
                          ?>
                            <li style="padding: 0 2px;">
                              <a href="javascript:void(0);"><span class="" jt="onward"></span>
                              <img src="images/search-icon.png" style="height:25px;width:10px;"/></a>
                              <span class="datrs"></span>
                              <span class="cntir"></span>
                            </li>
                          <?
                          }else{
                          ?>
                            <li style="padding: 0 2px;">
                              <a href="javascript:void(0);"><span class="priceflag" jt="onward">
                              <?
                                $timestamp = strtotime($value[0]);
                                $timestamp1 = strtotime($value[1]);
                                $day = date('d M Y', $timestamp);
                                $day1 = date('d M Y', $timestamp1);
                              ?>
                              &euro;<?=str_replace("EUR","",$value['price'])?></span><span class="colr-he heit-sm3 round_colr-he" id="<?=$day?>-<?=$day1?>, &euro;<?=str_replace("EUR","",$value['price'])?>" title="<?=$day?> - <?=$day1?>, &euro;<?=str_replace("EUR","",$value['price'])?>"></span></a>
                              <span class="datrs"></span>
                              <span class="cntir"></span>
                            </li>
                        <?
                          }
                        }
                      }else{
                       for($i=0;$i<48;$i++){
                      ?>
                        <li style="padding: 0 2px;">
                          <a href="javascript:void(0);"><span class="" jt="onward"></span>
                          <img src="images/search-icon.png" style="height:25px;width:10px;"/></a>
                          <span class="datrs"></span>
                          <span class="cntir"></span>
                        </li>
                      <?
                       } 
                      }
                      ?>
                    </ul>
                    <?
                      $timestamp = DateTime::createFromFormat('d/m/Y', $_SESSION['from'][0])->format('Y-m-d');
                      $timestamp1 = DateTime::createFromFormat('d/m/Y', $_SESSION['to'])->format('Y-m-d');
                      $start = strtotime($timestamp);
                      $return = strtotime($timestamp1);
                      $start = date('d M Y', $start);
                      $return = date('d M Y', $return);
                    ?>
                    <span class="mnt-clas"><?=$start?> - <?=$return?></span>
                    <?
                    }
                    ?> 
                  </div>
                  <!-- <div class="next"><img src="images/next.jpg" alt="next" /></div> -->
                </div>
              </div>
            </div>
          </div>
          <?
          }
          ?>
          <div class="row hideDiv" id="chartSearch">
            <form class="custom show-search-options position-left" method="POST" action="site/flight/search_air_travel" accept-charset="UTF-8" novalidate>
              <div class="col-md-12" style="padding:15px;background-color:rgba(0,0,0,0.5);">
                <div id="ser_dt" style="font-size:16px;color:#FFC532;margin-top:6px;">No Date</div>
                <div id="ser_price" style="font-size:18px;margin-top:-2px;color:#FFF">No Estimated Price</div>
                <input type="hidden" id="hidden_origin" name="origin[]">
                <input type="hidden" id="hidden_destination" name="destination[]">
                <input type="hidden" name="from[]" class="search_date" id="hidden_from"/>
                <input type="hidden" name="to" class="search_date" id="hidden_toDate"/>
                <input type="hidden" name="adult_count" id="hidden_adult_count"/>
                <input type="hidden" name="child_count" id="hidden_child_count"/>
                <input type="hidden" name="infant_count" id="hidden_infant_count"/>
                <input id="homesearchSubmit" class="large pink btn icon-and-text position-left" type="submit" value="SEARCH NOW">
              </div>
            </form>
          </div>
          <br/>
          <div class="row sorting-div">           
            <div class="col-md-7">
              <label class="shoter-text" style="float:left;">Sorteer op:&nbsp;</label>
             <!--  <div class="shotby">
                  <input type="text" placeholder="Goeie deal" class="place-short"/>
                  <span class="drop-btn"></span>
              </div> -->
              <div class="shotby">
                  <input type="text" placeholder="Prijs" class="place-short price_change"/>
                  <span class="drop-btn price_sort"></span>
              </div>
              <div class="shotby">
                  <input type="text" placeholder="Duur" class="place-short duration_change"/>
                  <span class="drop-btn duration_sort"></span>
              </div>
            </div>
            <div class="col-md-5">
              <form class="show-search-options position-left" method="POST" action="/" accept-charset="UTF-8" novalidate style="height:2pc;">
                <input type="hidden" name="origin" value="<?=$origin_name[0]['airport']. '-' .$_SESSION['origin'][0]?>">
                <input type="hidden" name="destination" value="<?=$destination_name[0]['airport']. '-' .$_SESSION['destination'][0]?>"> 
                <input type="hidden" name="from" value="<?=$_SESSION['from'][0]?>">
                <input type="hidden" name="to" value="<?=$_SESSION['to']?>">
                <input type="hidden" name="mode" value="<?=$_SESSION['mode']?>">
                <!-- <a href="/" id="modify" style="float:right;font-size:1pc;color:#fff">Modify Search</a> -->
                <input id="modify" class="large pink btn icon-and-text position-left" type="submit" value="Modify Search">
              </form>
            </div>
          </div>
          <br/>
          <?php 
          if ($commission_status == 'Active') {  ?>
            <h4 class="commission_price">Prijzen per persoon excl. eenmalig per boeking &euro;<?=$commission_val;?> boekingskosten.</h4>
          <?php }else{  } ?>
          <!-- Crap code removed from here pasted in file_crappy.php -->
        </div>
        
        
        
        
        
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
    								<span class="norto"><small><?php echo date('H:i', $DepartureDateTime);?> (<?php echo date('d M, D Y', $DepartureDateTime);?>)</small></span>
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
    								<span class="norto"><small><?php echo date('H:i', $ArrivalDateTime);?> (<?php echo date('d M, D Y', $ArrivalDateTime);?>)</small></span>
    							</div>

    						</div>

    						<div class="col-md-3 col-xs-3 nopad fulat500">
    							<br>
    							<div class="fatfi">
    								<span class="norto lbold"><img src="<?php echo ASSETS;?>images/site/clk.png"> <?php echo $Tot_traveltime;//$dur;?></span>
    								<span class="norto text-primary"><?php echo (($Stops[$i]>1)?$Stops[$i]." STOPS":(($Stops[$i]==0)?"NON STOP":$Stops[$i]." STOP"));?></span>
    							</div>
    						</div>
    					</div>

    					<div class="clear"></div>
    					<div class="pricefilt foronmob">
    						<span class="nortocount"><span class="curr_icon"><?php echo $this->display_icon;?></span><span class="amount"><?php echo $this->account_model->currency_convertor($flight->TotalPrice);?></span></span>
    						<form name="flightbook<?php echo $i;?>" id="F<?php echo str_replace('.', '', $flight->TotalPrice).$i;?>" action="<?php echo WEB_URL;?>">
    							<input type="hidden" name="temp_d" value="<?php echo $flight_data;?>" required/>
    							<input type="hidden" name="temp_r" value="<?php echo $request;?>" required/>
    							<input class="booking selectbtn FlightbookNow" type="button" name="button" data-attr="F<?php echo str_replace('.', '', $flight->TotalPrice).$i;?>" value="Select" />
    						</form>
    					</div>
    					<div class="clear"></div>
    					<div class="toglerow">
    						<div class="clearfix">
    							<div class="pull-left">
    								<span class="f_color" style="font-size:12px;margin-left: 10px;"> <a class="href_<?php echo ($i+1);?>" href="javascript:void(0);" id="<?php echo $farekey;?>|@|0" onclick="show_fare_popup(this.id,this)">Detailed fare Conditions &amp; Information</a></span>
    								<br>
    								<span style="margin-left: 10px;"><small>"Prijzen per persoon excl. eenmaling per boeking € 29.50"</small></span>
    							</div>
    							<div class="pull-right text-right">
    								<button class="lightbtn" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i;?>"><img src="<?php echo ASSETS;?>images/site/arrow_open.png" class="open_close_arrow"> Flight Details</button>
    							</div>
    						</div>
    					</div>
    				</div> 

    				<div class="col-md-2 col-xs-2 nopad litblue white">
    					<!--<button class="lightbtn" type="button" data-toggle="collapse" data-target="#collapse10">More</button>-->
    					<div class="pricefilt">
    						<span class="nortocount"><span class="curr_icon"><?php echo $this->display_icon;?></span><span class="amount"><?php echo $this->account_model->currency_convertor($flight->TotalPrice);?></span></span>
    						<form name="flightbook<?php echo $i;?>" id="F<?php echo str_replace('.', '', $flight->TotalPrice).$i;?>" action="<?php echo WEB_URL;?>">
    							<input type="hidden" name="temp_d" value="<?php echo $flight_data;?>" required/>
    							<input type="hidden" name="temp_r" value="<?php echo $request;?>" required/>
    							<input class="booking selectbtn FlightbookNow" type="button" name="button" data-attr="F<?php echo str_replace('.', '', $flight->TotalPrice).$i;?>" value="Select" />
    						</form>
    					</div>
    				</div>
    			</div>
    			<div class="clearfix"></div>
    			<div  class="collapse frowexpand" id="collapse<?php echo $i;?>">
                    <!-- flight details 
                    <div class="panel">
                        <div class="panel-body">
                        <h3 class="f_color h6">PRICE STRUCTURE</h3>
                           <table style="width:100%;  margin-left: 12px;">
                            <tbody>
                              <tr>
                                <td class="table_head">Passenger Type</td>
                                <td class="table_head">No Of Passengers</td>
                                <td class="table_head">Ticket Price</td>
                                <td class="table_head">Tax</td>
                                <td class="table_head">Total Price</td>
                            </tr>
                            <tr>
                                <td>Adult</td>
                                <td>1</td>
                                <td>€ 13.00</td>
                                <td>€ 7.53</td>
                                <td width="20%">€ 20.53</td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;">
                        <tbody>
                                          <!-- <tr class="outbond-head" style="background-color:rgba(0,173,239,0.8);color:#FFF;">
                                            <td colspan="9" style="font-size:15px;">
                                              <span>Departure</span>
                                              <span style="padding-left:15px;">Fri 26th June, 2015</span>
                                            </td>
                                        </tr> 
                                        <tr style="font-size:12px;">
                                            <td>
                                              <table width="100%">
                                                 <tbody><tr>
                                                    <td colspan="3">
                                                      <h3 class="f_color h6">OUTBOUND FLIGHT DETAILS                                                   </h3>
                                                  </td>
                                              </tr>

                                              <tr>
                                                  <td colspan="3">
                                                    <h3 class="f_color h6"> FIRST FLIGHT DETAILS </h3>
                                                </td>
                                            </tr>
                                            <tr>
                                              <td class="flight_detail">Outbound</td>
                                              <td>AI-264</td>
                                              <td style="width:100px;">
                                                <div class="fight-company">
                                                  <img src="http://192.168.0.157/tf/images/flight_logo/AI.gif">
                                                  <span class="comp-name" style="text-align:left !important;">Air India(264)</span>
                                              </div>
                                          </td>                                                
                                      </tr>
                                      <tr>
                                          <td class="flight_detail">Departure</td>
                                          <td>15:30 (26/06/2015)Kempegowda Intl Arpt</td>
                                          <td></td>                                                
                                      </tr>
                                      <tr>
                                          <td class="flight_detail">Arrival</td>
                                          <td>16:30 (26/06/2015)                                          Chennai Arpt</td>
                                          <td></td>                                                
                                      </tr>
                                      <tr>
                                          <td class="flight_detail">Travel Time</td>
                                          <td>1U0M</td>                                            
                                      </tr>
                                      <tr>
                                          <td class="flight_detail">Class</td>
                                          <td>Economy</td>
                                          <td></td>                                                
                                      </tr>
                                      <tr>
                                          <td class="flight_detail">Aircraft Type</td>
                                          <td>Airbus A320-100/200</td>
                                          <td></td>                                                
                                      </tr>
                                  </tbody></table>
                              </td>
                          </tr>
                          <tr> 
                            <td>
                              <table>
                                <tbody><tr>
                                  <td class="flight_detail">Total Travel Time</td>
                                  <td class="travel_time">
                                      1U0M                                              </td> 
                                  </tr>
                              </tbody></table>
                          </td>                                                                                      
                      </tr>
                  </tbody>
              </table>

          </div>
      </div>
      <!-- end flight details -->
      <div class="col-md-12 nopad tablshow">
      	<div class="col-md-2 col-xs-2 nopad litblue white">
      		<div class="clsfare">
      			<div class="pricerow">
      				<h4 class="brkup">Total Fare Breakup</h4>
      				<div class="inrowse">
      					<span class="pricelabl">Total Base Fare</span>
      					<span class="priceamnt"><span class="curr_icon"><?php echo $this->display_icon;?></span><?php echo $this->account_model->currency_convertor($flight->BasePrice);?></span>
      				</div>
      				<div class="inrowse">
      					<span class="pricelabl">Taxes &amp; Fees</span>
      					<span class="priceamnt"><span class="curr_icon"><?php echo $this->display_icon;?></span><?php echo $this->account_model->currency_convertor($flight->Taxes);?></span>
      				</div>
      				<div class="inrowse">
      					<span class="pricelabl">Grand Total</span>
      					<span class="priceamnt totlamntcol"><span class="curr_icon"><?php echo $this->display_icon;?></span><?php echo $this->account_model->currency_convertor($flight->TotalPrice);?></span>
      				</div>  
      			</div>
      		</div>
      	</div>
      	
      	<div class="col-md-12 nopad fulwidmob">
      		<?php 
      		foreach($flight->segments as $key => $segment){
//Exploding T from arrival time  
      			list($date, $time) = explode('T', $segment->ArrivalTime);
      			$time = preg_replace("/[.]/", " ", $time);
      			list($time, $TimeOffSet) = explode(" ", $time);
$ArrivalDateTime = $date." ".$time; //Exploding T and adding space
$ArrivalDateTime = $art = strtotime($ArrivalDateTime);
//echo $ArrivalDateTime;die;

//Exploding T from depature time  
list($date, $time) = explode('T', $segment->DepartureTime);
$time = preg_replace("/[.]/", " ", $time);
list($time, $TimeOffSet) = explode(" ", $time);
$DepartureDateTime = $date." ".$time; //Exploding T and adding space
$DepartureDateTime = $dpt = strtotime($DepartureDateTime);

$seconds = $ArrivalDateTime - $DepartureDateTime;

$days = floor($seconds / 86400);
$hours = floor(($seconds - ($days * 86400)) / 3600);
$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
// $seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
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
    $ArrivalDateTime = $date." ".$time; //Exploding T and adding space
    $ArrivalDateTime = $art = strtotime($ArrivalDateTime);
    //echo $ArrivalDateTime;die;

    //Exploding T from depature time  
    list($date, $time) = explode('T', $flight->segments[$key+1]->DepartureTime);
    $time = preg_replace("/[.]/", " ", $time);
    list($time, $TimeOffSet) = explode(" ", $time);
    $DepartureDateTime = $date." ".$time; //Exploding T and adding space
    $DepartureDateTime = $dpt = strtotime($DepartureDateTime);

    $seconds = $DepartureDateTime - $ArrivalDateTime;

    $days = floor($seconds / 86400);
    $hours = floor(($seconds - ($days * 86400)) / 3600);
    $minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
    // $seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
    if($days==0){
    	$Layover=$hours."h ".$minutes."m";  
    }else{
    	$Layover=$days."d ".$hours."h ".$minutes."m";
    }
  }
  ?>                        
  <div class="repflight">
  	
  	<div class="col-md-4 col-xs-4 fulat500">
  		<div class="alldetss">
  			<div class="detflitimg">
  				<img src="<?php echo ASSETS;?>images/airline_logo/<?php echo $segment->Carrier;?>.gif"  alt=""/>
  			</div>
  			<span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($segment->Carrier);?>-<?php echo $segment->FlightNumber;?><br><?php echo $segment->Carrier;?>-<?php echo $segment->Equipment;?></span>
  		</div>
  	</div>
  	
  	<div class="col-md-8 col-xs-8 nopad fulat500">
  		<div class="col-md-5 col-xs-5">
  			<span class="radiobtnnill rittextalign"><?php echo $segment->Origin;?> <strong><?php echo date('H:i', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></strong></span>
  			<span class="norto rittextalign"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></span>
  			<span class="simle rittextalign"><?php echo $this->flight_model->get_airport_name($segment->Origin);?></span>
  		</div>
  		<div class="col-md-2 col-xs-2">
  			<span class="timeclo"></span>
  			<span class="nortocen lbold"><?php echo $Tot_traveltime;//$dur;?></span>
  		</div>
  		<div class="col-md-5 col-xs-5">
  			<span class="radiobtnnill"><?php echo $segment->Destination;?> <strong><?php echo date('H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></strong></span>
  			<span class="norto"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span>
  			<span class="simle"><?php echo $this->flight_model->get_airport_name($segment->Destination);?></span>
  		</div>
  	</div>
  	
  	
  </div>
  <div class="clear"></div>
  <?php if(count($flight->segments) > 0 &&  $key+1 < count($flight->segments)){?>
  <div class="betwenrow">Change of Plane at <strong><?php echo $this->flight_model->get_airport_name($segment->Destination);?></strong>, | <strong>Layover: <?php echo $Layover;?></strong> </div>
  <div class="clear"></div>
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

$filters.on('ifChanged', function(event){
  $categoryContent.hide(); // if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
  var $selectedFilters = $filters.filter(':checked');
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
$('#StopFilter').html('<?php $i=1;foreach($Stops as $stop){?><li class="cheklist"><label for="stop<?php echo $i;?>"><div class="left"><input class="filtchk serch-blue stop" name="stop" type="checkbox" id="stop<?php echo $i;?>" value="<?php echo $stop;?>" checked/></div><span class="cheklabl"><?php if($stop == 0){ echo 'Non';}else if($stop == 1){echo 'One';}else if($stop == 2){echo 'Two';}else if($stop == 3){echo 'Three';}else{echo $stop;}?>-Stop</span><label></li><?php $i++; }?>');
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
