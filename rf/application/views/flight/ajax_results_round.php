<?php
$price = array();
  $Airlines =array();
  $Airlines =array();
  $Stops = array();
  $retStops =array();
$flights_data = base64_encode(json_encode($flights)); // For reference
$req=$request;
$request = base64_encode(json_encode($req)); // request For reference
$flights = json_decode(json_encode($flights));
 $SAdults = $req->ADT;
    $SChildren = $req->CHD;
$i=0;
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
  $totalsegments=2;
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
  
  if($onward_first_seg->Carrier!=''){
$Airlines[] = $onward_first_seg->Carrier;
  }
  if($onward_first_seg->Carrier!=''){
    $Airlines[] = $return_first_seg->Carrier;
  }
  
  
  $Stops_a[] = count($flight->onward->segments)-1;
  $Stops_a[] = count($flight->return->segments)-1;
  $Stops = count($flight->onward->segments)-1;
  $retStops = count($flight->return->segments)-1;

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
  $arrtime = date('H:i', $onward_ArrivalDateTime);
  list($hours, $min) = explode(':', $arrtime);
  $arrminutes=$hours*60;
  $arrminutes=$arrminutes+$min;


  $retdeptime = date('H:i', $return_DepartureDateTime);
  list($hours, $min) = explode(':', $retdeptime);
  $retdepminutes=$hours*60;
  $retdepminutes=$retdepminutes+$min;


  $data_stops=($Stops>$retStops)?$Stops:$retStops;




   // Added By veera
      $MCalcCarriers = array();
      $WholeMarkups = array();

      
      
          $DepartreDate = date('Y-m-d',strtotime($onward_first_seg->DepartureTime));
            
      
 
   
        $WholeMCalcCarrier = $this->flight_model->WholeMCalcCarrier($DepartreDate);
       // echo $this->db->last_query();
         //echo "<pre>";print_r($WholeMCalcCarrier);exit;
        foreach ($WholeMCalcCarrier as $WholeM) {
            $WholeMarkups[] = array($WholeM->Type,$WholeM->AmountType,($WholeM->AmountType == 'Currency') ? $WholeM->Currency : $WholeM->Percent,$WholeM->MDId,$WholeM->Per,$WholeM->MaxAmount,$WholeM->HiddenStatus);
            break;
        }
     
      
 //echo "<pre>";print_r($WholeMarkups);exit;
      $FlightPriceWithoutMarkup = $flight->TotalPrice;
      $TotalMarkupFeeAmount = 0;
      foreach ($WholeMarkups as $WholeMarkup) {
        $MrkupFeeType = $WholeMarkup[1];
        $WholeMarkupFeeAmount = $WholeMarkup[2];
        $WholeMarkupPer = $WholeMarkup[4];
        $WholeMarkupMaxAmount = $WholeMarkup[5];
$MrkupFeeHStatus = $WholeMarkup[6];
if($MrkupFeeHStatus == 'Y'){
       

        // Check FeeType Condition
       $MarkupFeeAmount =($MrkupFeeType == 'Currency')?$WholeMarkupFeeAmount :(($FlightPriceWithoutMarkup*$WholeMarkupFeeAmount)/100);      
          
      
        
        // Check Markup Type Condition
        if($WholeMarkup[0] == 'Addition') {
        $TotalMarkupFeeAmount += $MarkupFeeAmount ;
      }else{
          $TotalMarkupFeeAmount -= $MarkupFeeAmount;
        }
      }
      

      }
      

      $price[] = ($flight->TotalPrice+$TotalMarkupFeeAmount);

  ?>
  <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid0123<?php echo $i;?>" class="maderow flight" data-airline="<?php echo $this->flight_model->get_airline_name($onward_first_seg->Carrier);?>" data-arrive="<?php echo $arrminutes;?>" data-duration="<?php echo $jms;?>" data-stops="<?php echo $data_stops;?>"  data-retdepature="<?php echo $retdepminutes;?>" data-depature="<?php echo $depminutes;?>" data-airlinecode="<?php echo $onward_first_seg->Carrier;?>" data-price="<?php echo $this->account_model->currency_convertor($flight->TotalPrice+$TotalMarkupFeeAmount);?>">
    <ul class="list-inline row">
      <li class="fs_airlinecontainer">
        <img  data-original="<?php echo ASSETS;?>images/airline_logo/<?php echo $onward_first_seg->Carrier;?>.gif" id="FF<?php echo str_replace('.', '', $flight->TotalPrice+$TotalMarkupFeeAmount).$i;?>" alt="Airline Logo" class="fs_fname lazy">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img data-original="<?php echo ASSETS;?>images/DEPARTURE_RF.svg" class="fs_dep lazy">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename">
              <b><?php echo $onward_fromCityName;?></b> (<?php echo $onward_first_seg->Origin;?>)
            </span>
            <div class="fsa_departure">
              <small><?php echo date('H:i', $onward_DepartureDateTime);?> (<?php echo date('d M, D Y', $onward_DepartureDateTime);?>)</small>
            </div>
          </div>
        </div>
        <div class="spacer"></div>
        <div class="fs_airline">
          <div class="fs_image">
            <img data-original="<?php echo ASSETS;?>images/DEPARTURE_RF.svg" class="fs_dep lazy">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename">
              <b><?php echo $return_fromCityName;?></b> (<?php echo $return_first_seg->Origin;?>)
            </span>
            <div class="fsa_departure">
              <small><?php echo date('H:i', $return_DepartureDateTime);?> (<?php echo date('d M, D Y', $return_DepartureDateTime);?>)</small>
            </div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond"><?php echo lang_line('OUT_BOUND');?></span><br>
          <img data-original="<?php echo ASSETS;?>images/ARROW_RF.svg" class="fs_io lazy">
        </div>
        <div class="spacer"></div>
        <div class="fs-outbond">
          <span class="fso_outbond"><?php echo lang_line('RETURN');?></span><br>
          <img data-original="<?php echo ASSETS;?>images/ARROW_RF.svg" class="fs_io lazy">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" data-original="<?php echo ASSETS;?>images/ARRIVAL_RF.svg" class="lazy">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename">
              <b><?php echo $onward_toCityName;?></b> (<?php echo $onward_last_seg->Destination;?>)
            </span>
            <div class="fsa_departure">
              <small><?php echo date('H:i', $onward_ArrivalDateTime);?> (<?php echo date('d M, D Y', $onward_ArrivalDateTime);?>)</small>
            </div>
          </div>
        </div>
        <div class="spacer"></div>
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" data-original="<?php echo ASSETS;?>images/ARRIVAL_RF.svg" class="lazy">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename">
              <b><?php echo $return_toCityName;?></b> (<?php echo $return_last_seg->Destination;?>)
            </span>
            <div class="fsa_departure"><small><?php echo date('H:i', $return_ArrivalDateTime);?> (<?php echo date('d M, D Y', $return_ArrivalDateTime);?>)</small>
            </div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><?php echo $onward_dur;?></span><br />
            <span class="fsa_departure"><?php   echo (($Stops>1)?$Stops.lang_line('STOPS'):(($Stops==0)?lang_line('NONSTOP'):$Stops.lang_line('STOP')));?></span>
          </div>
        </div>
        <div class="spacer"></div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><?php echo $return_dur;?></span><br />
            <span class="fsa_departure"><?php echo (($retStops>1)?$retStops.lang_line('STOPS'):(($retStops==0)?lang_line('NONSTOP'):$retStops.lang_line('STOP')));?></span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black go-top flight-details-btn" type="button" data-id='collapse<?php echo $i;?>' data-toggle="modal" data-target="#Flight-Details"><?php echo lang_line('FLIGHT_DET');?></button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button"  href="javascript:void(0);" id="<?php echo $last_getfare_details;?>" onclick="show_fare_popup(this.id,this,1)"><?php echo lang_line('FARE_COND');?></button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency"><?php echo $this->display_icon;?></span>
                <span class="fsa_airlinename amount"><?php echo $this->account_model->currency_convertor($flight->TotalPrice+$TotalMarkupFeeAmount);?></span><br />
                <span class="fsa_departure"><?php echo lang_line('PPR');?></span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank"  name="flightbook<?php echo $i;?>" id="F<?php echo str_replace('.', '', $flight->TotalPrice+$TotalMarkupFeeAmount).$i;?>" method="post" action="<?php echo WEB_URL.'/flight/AddToCart';?>">
                  <input type="hidden" name="temp_d" value="<?php echo $flight_data;?>" required/>
                  <input type="hidden" name="temp_r" value="<?php echo $request;?>" required/>
                  <button type="submit" data-attr="F<?php echo str_replace('.', '', $flight->TotalPrice+$TotalMarkupFeeAmount).$i;?>" class="btn btn-primary btn_inputs"><?php echo lang_line('BOOK_NOW');?></button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <div class="clear"></div>
      <!-- modal flight -->
      <div class="modal fade bs-example-modal-lg" id="collapse<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="rf_modaltitle"><?php echo lang_line('FLIGHT_DET');?></div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li><?php echo lang_line('ONWARD');?></li>
                    <li><?php echo $onward_fromCityName;?>-<?php echo $onward_toCityName;?></li>
                    <li><?php echo date('l d F', $onward_DepartureDateTime);?></li>
                  </ul>
                  <?php 
                  foreach($flight->onward->segments as $key => $segment){
                    $ArrivalDateTime = $art = strtotime($segment->ArrivalTime);
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
                    if(count($flight->onward->segments) > 0 &&  $key+1 < count($flight->onward->segments)){
                      //Exploding T from arrival time  
                      list($date, $time) = explode('T',  $flight->onward->segments[$key]->ArrivalTime);
                      $time = preg_replace("/[.]/", " ", $time);
                      list($time, $TimeOffSet) = explode(" ", $time);
                      //Exploding T and adding space
                      $ArrivalDateTime1 = $date." ".$time;
                      $ArrivalDateTime1 = $art = strtotime($ArrivalDateTime1);
                      //Exploding T from depature time  
                      list($date, $time) = explode('T', $flight->onward->segments[$key+1]->DepartureTime);
                      $time = preg_replace("/[.]/", " ", $time);
                      list($time, $TimeOffSet) = explode(" ", $time);
                      //Exploding T and adding space
                      $DepartureDateTime1 = $date." ".$time;
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
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        <?php echo date('g:i A', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?> <br/>
                        <span><?php echo $this->flight_model->get_airport_name($segment->Origin);?> <?php echo $segment->Origin;?></span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        <?php echo date('g:i A', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?> <br/>
                        <span><?php echo $this->flight_model->get_airport_name($segment->Destination);?> <?php echo $segment->Destination;?></span>
                      </li>
                      <li class="rfms_emirates">
                        <?php echo $this->flight_model->get_airline_name($segment->Carrier);?><br/>
                        <span><?php echo $segment->Carrier;?><?php echo (isset($segment->Equipment))?"-".$segment->Equipment:"";?></span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br/>
                        <span><?php echo  $dur;?></span>
                      </li>
                      <?php if(count($flight->onward->segments) > 0 &&  $key+1 < count($flight->onward->segments)){?>
                      <li class="rfms_stopovertime">
                        <?php echo lang_line('PLANE_CHNAGE_DET');?>: <?php echo $this->flight_model->get_airport_name($segment->Destination);?>, | <strong><?php echo lang_line('LAYOVER');?>: <?php echo $Layover;?></strong> 
                      </li>
                      <li class="rfms_stopovertime">
                        <?php echo lang_line('TOTLA_JOURNEY');?>: <strong><?php echo $onward_dur;?></strong>
                      </li>
                      <?php }  ?>
                    </ul>
                    <?php }?> 
                    <div class="spacer30 full_width"></div>
                    <ul class="list-inline rfm_flightdetails">
                      <li><?php echo lang_line('RETURN');?></li>
                      <li><?php echo $return_fromCityName;?>-<?php echo $return_toCityName;?></li>
                      <li><?php echo date('l d F', $return_DepartureDateTime);?></li>
                    </ul>
                    <?php 
                    foreach($flight->return->segments as $key => $segment){
                      $ArrivalDateTime = $art = strtotime($segment->ArrivalTime);
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
                      if(count($flight->return->segments) > 0 &&  $key+1 < count($flight->return->segments)){
                        //Exploding T from arrival time  
                        list($date, $time) = explode('T',  $flight->return->segments[$key]->ArrivalTime);
                        $time = preg_replace("/[.]/", " ", $time);
                        list($time, $TimeOffSet) = explode(" ", $time);
                        //Exploding T and adding space
                        $ArrivalDateTime1 = $date." ".$time; 
                        $ArrivalDateTime1 = $art = strtotime($ArrivalDateTime1);
                        //Exploding T and adding space
                        list($date, $time) = explode('T', $flight->return->segments[$key+1]->DepartureTime);
                        $time = preg_replace("/[.]/", " ", $time);
                        list($time, $TimeOffSet) = explode(" ", $time);
                        $DepartureDateTime1 = $date." ".$time; 
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
                      <ul class="list-inline rfm_singleflightdetails">
                        <li class="rfms_departure">
                          <?php echo date('g:i A', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?> <br/>
                          <span><?php echo $this->flight_model->get_airport_name($segment->Origin);?> <?php echo $segment->Origin;?></span>
                        </li>
                        <li class="rfms_flightimg">
                          <img src="assets/images/DEPARTURE_RF.svg">
                        </li>
                        <li class="rfms_arival">
                          <?php echo date('g:i A', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?> <br/>
                          <span><?php echo $this->flight_model->get_airport_name($segment->Destination);?> <?php echo $segment->Destination;?></span>
                        </li>
                        <li class="rfms_emirates">
                          <?php echo $this->flight_model->get_airline_name($segment->Carrier);?><br/>
                          <span><?php echo $segment->Carrier;?><?php echo (isset($segment->Equipment))?"-".$segment->Equipment:"";?></span>
                        </li>
                        <li class="rfms_nonstop">
                          &nbsp;<br/>
                          <span><?php echo  $dur;?></span>
                        </li>
                        <?php if(count($flight->return->segments) > 0 &&  $key+1 < count($flight->return->segments)){?>
                        <li class="rfms_stopovertime">
                          <?php echo lang_line('PLANE_CHNAGE_DET');?>: <?php echo $this->flight_model->get_airport_name($segment->Destination);?>, | <strong><?php echo lang_line('LAYOVER');?>: <?php echo $Layover;?></strong> 
                        </li>
                        <li class="rfms_stopovertime">
                         <?php echo lang_line('TOTLA_JOURNEY');?>: <strong><?php echo $return_dur;?></strong>
                       </li>
                       <?php }  ?>
                     </ul>
                     <?php }?>
                   </div><!-- col-sm-9-->
                   <div class="col-md-3 flightdetbook_btn"><!--col-sm-3-->
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span><?php echo $this->display_icon;?></span><span><?php echo $this->account_model->currency_convertor($flight->TotalPrice+$TotalMarkupFeeAmount);?></span>
                      </li>
                      <li class="rfm_flightdet">
                        <?php echo lang_line('PPR');?>
                      </li>
                      <li class="rmf_book">
                        <form target="_blank"   name="flightbook<?php echo $i;?>" id="F<?php echo str_replace('.', '', $flight->TotalPrice+$TotalMarkupFeeAmount).$i;?>" method="post" action="<?php echo WEB_URL.'/flight/AddToCart';?>">
                          <input type="hidden" name="temp_d" value="<?php echo $flight_data;?>" required/>
                          <input type="hidden" name="temp_r" value="<?php echo $request;?>" required/>
                          <button type="submit" data-attr="F<?php echo str_replace('.', '', $flight->TotalPrice+$TotalMarkupFeeAmount).$i;?>" class="btn btn-primary"><?php echo lang_line('BOOK_NOW');?></button>
                        </form>
                      </li>
                    </ul>
                  </div><!--col-sm-3-->
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight  -->
      </ul>
    </li>
    <!-- Normal trip End-->
    <?php $i++;} //$price[] =0;
    $Airlines[] =''; }?>

    <?php $Airlines =is_array($Airlines)?array_unique(array_filter($Airlines)):''; //Creating Unique Airlines?>
    <?php $Stops_a =is_array($Stops_a)?array_unique($Stops_a):''; //Creating Unique Stops?>
    <input type="hidden" id="stops" value="<?php if(!empty($req->Stop)) echo $req->Stop; else echo ''; ?>"/>
    <input type="hidden" id="setMinPrice" value="<?php if(!empty($price)) echo min($price); else echo 0; ?>" />
    <input type="hidden" id="setMaxPrice" value="<?php if(!empty($price)) echo max($price); else echo 0; ?>" />
    <input type="hidden" id="setMinTime" value="0" />
    <input type="hidden" id="setMaxTime" value="1440" />
    <input type="hidden" id="table_count" />
    <input type="hidden" id="markup_price" value="<?php echo $TotalMarkupFeeAmount;?>" />
    <input type="hidden" id="disc_price" value="<?php echo isset($req->disc_price)?$req->disc_price:0;?>" />
   <script type="text/javascript">
    
var depMinTime='';var  depMaxTime='';var arrMinTime='';var arrMaxTime='';var MinDuration='';var MaxDuration='';var MinPrice='';var MaxPrice='';
var retdepMinTime='';var retdepMaxTime='';
 <?php if((isset($req->depMinTime) && $req->depMinTime!='') && (isset($req->depMaxTime) && $req->depMaxTime!='')){ ?>

depMinTime=<?php echo $req->depMinTime;?>; depMaxTime=<?php echo $req->depMaxTime;?>;
<?php } ?>
<?php if((isset($req->arrMinTime) && $req->arrMinTime!='') && (isset($req->arrMaxTime) && $req->arrMaxTime!='')){ ?>

arrMinTime=<?php echo $req->arrMinTime;?>; arrMaxTime=<?php echo $req->arrMaxTime;?>;

<?php } ?>
<?php if((isset($req->MinDuration) && $req->MinDuration!='') && (isset($req->MaxDuration) && $req->MaxDuration!='')){ ?>

MinDuration=<?php echo $req->MinDuration;?>; MaxDuration=<?php echo $req->MaxDuration;?>;
<?php } ?>
<?php if((isset($req->MinPrice) && $req->MinPrice!='') && (isset($req->MaxPrice) && $req->MaxPrice!='')){ ?>

MinPrice=<?php echo $req->MinPrice;?>; MaxPrice=<?php echo $req->MaxPrice;?>;
<?php } ?>

/*function showFlights(minPrice, maxPrice) {
$("ul.flights li.flight").hide().filter(function() {
var price = $(this).find("span.amount").html();
var price = parseFloat(price);
console.log(price+' >= '+minPrice+' && '+price+' <= '+maxPrice);
return price >= minPrice && price <= maxPrice;
}).show();
}
function showDepFlights(mint, maxt) {
$("ul.flights li.flight").hide().filter(function() {
var dep = $(this).data("depature");
return dep >= mint && dep <= maxt;
}).show();
}
function showArrFlights(mint, maxt) {
$("ul.flights li.flight").hide().filter(function() {
var arr = $(this).data("arrive");
return arr >= mint && arr <= maxt;
}).show();
}
function showDurFlights(mint, maxt) {
$("ul.flights li.flight").hide().filter(function() {
var dur = $(this).data("duration");
return dur >= mint && dur <= maxt;
}).show();
}*/
          $(function() {
            $( "#price-filter" ).slider({
              range: true,
              min: parseFloat($("#setMinPrice").val()),
              max: parseFloat($("#setMaxPrice").val()),
              values: [ ((MinPrice!='')?(MinPrice):parseFloat($("#setMinPrice").val())), ((MaxPrice!='')?(MaxPrice):parseFloat($("#setMaxPrice").val()))],
              //values: [ parseFloat($("#setMinPrice").val()), parseFloat($("#setMaxPrice").val()) ],
              slide: function( event, ui ) {
                $('#min_price').text(CURR_ICON+ $( "#price-filter" ).slider( "values", 0 ));
                $('#max_price').text(CURR_ICON+ $( "#price-filter" ).slider( "values", 1 ) );
              },
              change: function( event, ui ) {
                one=ui.values[0];
                two=ui.values[1];
                //showFlights(one, two);
                 flightFilteration();
              }
            });
            $('#min_price').text(CURR_ICON+ $( "#price-filter" ).slider( "values", 0 ));
            $('#max_price').text(CURR_ICON+ $( "#price-filter" ).slider( "values", 1 ) );
$( "#departure-filter" ).slider({
  range: true,
  min: 0,
  max: 1439,
  step: 1,
 // values: [ 0, 1439 ],
  values: [ ((depMinTime!='')?(depMinTime):0), ((depMaxTime!='')?(depMaxTime):1439)],
  slide: slideDep_Time,
  change: function( event, ui ) {
    one=ui.values[0];
    two=ui.values[1];
    //showDepFlights(one, two);
     flightFilteration();
  }
});
$( "#arrival-filter" ).slider({
  range: true,
  min: 0,
  max: 1439,
  step: 1,
  //values: [ 0, 1439 ],
  values: [ ((arrMinTime!='')?(arrMinTime):0), ((arrMaxTime!='')?(arrMaxTime):1439)],
  slide: slideArr_Time,
  change: function( event, ui) {
    one=ui.values[0];
    two=ui.values[1];
    //showArrFlights(one, two);
     flightFilteration();
  }
});



$( "#duration-filter" ).slider({ 
  range: true,
  min: 0,
  max: 1439,
  step: 1,
 // values: [ 0, 1439 ],
 values: [ ((MinDuration!='')?(MinDuration):0), ((MaxDuration!='')?(MaxDuration):1439)],
  slide: slideDur_Time,
  change: function( event, ui) {
    one=ui.values[0];
    two=ui.values[1];
    //showDurFlights(one, two);
     flightFilteration();
  }
});
});
function getTime(hours, minutes) {
  var time = null;
  minutes = minutes + "";
  /*if (hours < 12) {
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
  return hours + ":" + minutes + " " + time;*/

   if (minutes.length == 1) {
      minutes = "0" + minutes;
    }
    if (hours.length == 1) {
    hours = hours + "";
      hours = "0" + hours;
    }
    return hours + ":" + minutes + " Hrs";
}
var startTime;
var endTime;
function slideDep_Time(event, ui){
var val0 = $("#departure-filter").slider("values", 0);
val1 = $("#departure-filter").slider("values", 1);
minutes0 = parseInt(val0 % 60, 10);
hours0 = parseInt(val0 / 60 % 24, 10);
minutes1 = parseInt(val1 % 60, 10);
hours1 = parseInt(val1 / 60 % 24, 10);
startTime = getTime(hours0, minutes0);
endTime = getTime(hours1, minutes1);
$("#min_departure").text(startTime );
$("#max_departure").text(endTime);
}
var startTime;
var endTime;
function slideArr_Time(event, ui){
var val0 = $("#arrival-filter").slider("values", 0);
val1 = $("#arrival-filter").slider("values", 1);
minutes0 = parseInt(val0 % 60, 10);
hours0 = parseInt(val0 / 60 % 24, 10);
minutes1 = parseInt(val1 % 60, 10);
hours1 = parseInt(val1 / 60 % 24, 10);
startTime = getTime(hours0, minutes0);
endTime = getTime(hours1, minutes1);
$("#min_arrival").text(startTime );
$("#max_arrival").text(endTime);
}
var startTime;
var endTime;
function slideDur_Time(event, ui){
var val0 = $("#duration-filter").slider("values", 0);
val1 = $("#duration-filter").slider("values", 1);
minutes0 = parseInt(val0 % 60, 10);
hours0 = parseInt(val0 / 60 % 24, 10);
minutes1 = parseInt(val1 % 60, 10);
hours1 = parseInt(val1 / 60 % 24, 10);
startTime = (hours0+'H');
endTime = (hours1+'H');
$("#min_duration").text(startTime);
$("#max_duration").text(endTime);
}

$(window).load(function() {
slideDep_Time();
slideDur_Time();
slideArr_Time();
});

slideDep_Time(); 
slideDur_Time();
slideArr_Time();
$(document).ready(function(){

 $('ul#Airlines li:last').after('<?php $i=1;foreach($Airlines as $airline){?> <li class="col-sm-6 nopadd"><label for="<?php echo stripslashes($airline);?>"><input <?php if(!empty($req->Airline) && in_array($airline, $req->Airline)) echo 'checked'; else echo ''; ?> name="AirlineFilter[]" type="checkbox" id="<?php echo stripslashes($airline);?>" value="<?php echo stripslashes($airline);?>"/><?php echo $this->flight_model->get_airline_name($airline);?> </label></li><?php $i++; }?>');
 $('#StopFilter option:last').after('<?php $i=1;foreach($Stops_a as $stop){?><option value="<?php echo $stop;?>" <?php if($req->Stop!='' && $stop == $req->Stop){ echo 'selected'; } ?> ><?php if($stop == 0){ echo 'Non';}else if($stop == 1){echo 'One';}else if($stop == 2){echo 'Two';}else if($stop == 3){echo 'Three';}else{echo $stop;}?>-Stop</option><?php $i++; }?>');
var $filters = $("input:checkbox[name='AirlineFilter[]']"); // start all checked
var $categoryContent = $('ul.flights li.flight'); // Path for flights
var $errorMessage = $('#errorMessage'); //Error Message
$filters.on('click', function(){
  $categoryContent.hide(); // if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
  var $selectedFilters = $filters.filter(':checked');
   if ($selectedFilters.length > 0) { 
    $errorMessage.hide();
      $selectedFilters.each(function (i, el) {
     var $selected = el.value;
     
  if ($selected!='All' && $selected!='') {
     $errorMessage.hide();
   flightFilteration();
    //$('ul.flights li.flight[data-airlinecode="'+ $selected +'"]').show();
  }else if($selected=='All' || $selected==''){
    $errorMessage.hide();
    $('ul.flights li.flight').show();
  }
});
  }else {
    $errorMessage.show();
    flightFilteration();
  }
});
var $filters1 = $("#StopFilter"); // start all checked
var $categoryContent1 = $('ul.flights li.flight'); // Path for flights
var $errorMessage = $('#errorMessage'); //Error Message
$filters1.on('change', function(){
  $categoryContent1.hide(); // if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
  var $selectedFilters1 = $filters1.val();
  if ($selectedFilters1!='All' && $selectedFilters1!='') {
    $errorMessage.hide();

   flightFilteration();
   //$('ul.flights li.flight[data-stops="'+ $selectedFilters1 +'"]').show();
 }else if($selectedFilters1=='All' || $selectedFilters1==''){
  $errorMessage.hide();
  $('ul.flights li.flight').show();
} else {
  $errorMessage.show();
}
});
});
/*$(document).ready(function(){
  var disc_price=$("#disc_price").val();
  $("li.flight").find("span.amount").each(function() {
    if($(this).text()==disc_price){
      $(this).after('<p class="text-success">Offer</p>');
    }
  });
});*/
</script>


<script type="text/javascript">



<?php if((isset($req->depMinTime) && $req->depMinTime!='') && (isset($req->depMaxTime) && $req->depMaxTime!='')){ ?>
flightFilteration();


<?php } ?>
<?php if((isset($req->arrMinTime) && $req->arrMinTime!='') && (isset($req->arrMaxTime) && $req->arrMaxTime!='')){ ?>
flightFilteration();


<?php } ?>
<?php if((isset($req->MinDuration) && $req->MinDuration!='') && (isset($req->MaxDuration) && $req->MaxDuration!='')){ ?>
flightFilteration();

<?php } ?>
<?php if((isset($req->MinPrice) && $req->MinPrice!='') && (isset($req->MaxPrice) && $req->MaxPrice!='')){ ?>

flightFilteration();

<?php } ?>

       




  /***
  This code is for oneway, round and multicity.
  ***/
  function flightFilteration(){
   
    //code for checkall or uncheckall
   // var count_number_stops = $(".filtchk.stop").length, count_number_stops_checked = $(".filtchk.stop:checked").length;
    var count_number_airline = $("ul#Airlines li").length, count_number_airline_checked = $('input[name="AirlineFilter[]"]:checked').length;
    
    /////////////////////////////////////
    
        var hide_flight_cls_chkbox = "";
       
        // here collecting all unchecked data, which needs to be hide.
        if(count_number_airline_checked>0){
        $('input[name="AirlineFilter[]"]').each(function(){
            if($(this).prop("checked")==false){
              if(this.value!='All'){
                hide_flight_cls_chkbox += (hide_flight_cls_chkbox?",":"")+'"'+this.value+'":1';
              }
              }
            
        });

        }
          $("#StopFilter option:not(:selected)").each(function()
          {

            if($("#StopFilter option:selected").val()!='' && $("#StopFilter option:selected").val()!='All'){

          if(this.value!='' && this.value!='All'){
          hide_flight_cls_chkbox += (hide_flight_cls_chkbox?",":"")+'"'+this.value+'":1';
          }
        }

          });


        
        hide_flight_cls_chkbox = "{ "+ hide_flight_cls_chkbox +" }";
      
        hide_flight_cls_chkbox = JSON.parse(hide_flight_cls_chkbox);
        
        $(".flight").show(); // here showing all the data
        
        var hidden_rows = 0;
        


        

        
 
        // Here hiding records which are unchecked
       $("ul.flights li.flight").each(function(){
            var temp_airline = $(this).data("airlinecode");
            var temp_stops = $(this).data("stops");
            var prices = parseFloat($(this).data("price"));
       
            if(hide_flight_cls_chkbox[temp_airline]){
               hidden_rows++;
                $(this).hide();
            }else if(hide_flight_cls_chkbox[temp_stops]){
                hidden_rows++;
                $(this).hide();
            }


        });
       
        
        $("ul.flights li.flight").each(function(){
          var prices = parseFloat($(this).data("price"));
          var temp_duration = parseInt($(this).data('duration'));
          var temp_departure = parseInt($(this).data('depature'));
          
          //var temp_arrival = parseInt($(this).data('arrive'));
      
          var temp_arrival = parseInt($(this).data('retdepature'));
          
          var min_departure = parseInt($("#departure-filter").slider("values", 0));
          var  max_departure = parseInt($("#departure-filter").slider("values", 1));
          var min_arrive = parseInt($("#arrival-filter").slider("values", 0));
          var  max_arrive = parseInt($("#arrival-filter").slider("values", 1));
          var minPrice_ = parseFloat($("#price-filter").slider("values", 0));
          var maxPrice_ = parseFloat($("#price-filter").slider("values", 1));
          var min_duration = parseInt($("#duration-filter").slider("values", 0));
          var max_duration = parseInt($("#duration-filter").slider("values", 1));



             if( !((prices >= minPrice_) && (prices <= maxPrice_))   ){
             
               hidden_rows++;
                 $(this).hide();
                }else if( !( (temp_duration >= min_duration) && (temp_duration <= max_duration) ) ){
                   //alert('pv');
               hidden_rows++;
               $(this).hide();
              }else if( !( (temp_departure >= min_departure) && (temp_departure <= max_departure) ) ){
                hidden_rows++;
               $(this).hide();
              }else if( !( (temp_arrival >= min_arrive) && (temp_arrival <= max_arrive) ) ){
                hidden_rows++;
               $(this).hide();
              }
        }); 

var $errorMessage = $('#errorMessage'); //Error Message
if($('ul.flights li.flight:visible').length==0){
$errorMessage.show();
}else{
  $errorMessage.hide();
}
        
    } 
</script>