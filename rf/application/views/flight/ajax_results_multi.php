<?php
$price = array();
$Airlines =array();
$Airlines =array();
$Stops = array();
$retStops =array();
$flights_data = base64_encode(json_encode($flights)); // For reference
$request = base64_encode(json_encode($request)); // request For reference
$flights = json_decode(json_encode($flights));
$SAdults = $req->ADT;
    $SChildren = $req->CHD;
$i=0;
$price=array();$Stops=array();$Airlines=array();
foreach($flights as $flight){
  $flight_data = base64_encode(json_encode($flight));
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
 
  $tot_city= count($flight->segments);
  $total_seg= array_map("count", $flight->segments);
  $aaa= array_sum($total_seg);
  $total_Stops=$aaa-$tot_city;
  $Stops[]=$total_Stops;
  $Airlines[] = $flight->Carrier;
  //$time[]=

//print_r($flight);


       // Added By veera
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
    //echo "<pre>";print_r($AllSegments);die;
   
        $DepartreDate = date('Y-m-d',strtotime($AllSegments[0]->DepartureTime));
           
    

 
      $WholeMCalcCarrier = $this->flight_model->WholeMCalcCarrier($DepartreDate);
      foreach ($WholeMCalcCarrier as $WholeM) {
        $WholeMarkups[] = array($WholeM->Type,$WholeM->AmountType,($WholeM->AmountType == 'Currency') ? $WholeM->Currency : $WholeM->Percent,$WholeM->MDId,$WholeM->Per,$WholeM->MaxAmount,$WholeM->HiddenStatus);
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

$price[] = $flight->TotalPrice+$TotalMarkupFeeAmount;

  ?>
  <li class="col-xs-12 fs_singleflight flight" id="ticketid0123<?php echo $i;?>"   data-stops='<?php echo $total_Stops;?>' data-airlinecode="<?php echo $flight->Carrier;?>" data-airline="<?php echo $this->flight_model->get_airline_name($flight->Carrier);?>" data-price="<?php echo $this->account_model->currency_convertor($flight->TotalPrice+$TotalMarkupFeeAmount);?>">
    <!--each row-->
    <ul class="list-inline row fs_multiflights">
     <li class="fsmultiflight_flightcontainer fs_airlinecontainer">
      <ul class="list-inline full_width">
        <?php
        $all_seg = $flight->segments;
        foreach($all_seg as $all_segments){ 
         if(is_array($all_segments)){
          $Stop = count($all_segments)-1;
          $first_seg = reset($all_segments);
          $last_seg = end($all_segments);
          $fromCityName =  $this->flight_model->get_airport_cityname($first_seg->Origin);
          $toCityName =  $this->flight_model->get_airport_cityname($last_seg->Destination);
          $ArrivalDateTime  = strtotime($last_seg->ArrivalTime);
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
         <li class="full_width">
          <ul class="list-inline fsmultiflight_flightdata">
            <li class="fs_airlinecontainer"><!--air icon row-->
           <img data-original="<?php echo ASSETS;?>images/airline_logo/<?php echo $first_seg->Carrier;?>.gif" id="FF<?php echo str_replace('.', '', $flight->TotalPrice+$TotalMarkupFeeAmount).$i;?>" alt="Airline Logo" class="fs_fname lazy">
         </li><!--air icon row-->
            <li class="fs_airlinecontainer"> <!--frow1-->
              <div class="fs_airline">
                <div class="fs_image">
                 <img alt="Departure Logo" data-original="<?php echo ASSETS;?>images/DEPARTURE_RF.svg" class="fs_dep lazy">
               </div>
               <div class="fs_values">
                <span class="fsa_airlinename"><b><?php echo $fromCityName;?></b> (<?php echo $first_seg->Origin;?>)</span><br />
                <span class="fsa_departure"><small><?php echo date('H:i', $this->flight_model->get_unixtimestamp($first_seg->DepartureTime));?> (<?php echo date('d M, D Y', $DepartureDateTime);?>)</small></span>
              </div>
            </div>
            <div class="spacer"></div>
          </li>
          <li class="fs_inout">
            <div class="fs-outbond">
              <span class="fso_outbond"><?php echo lang_line('OUT_BOUND');?></span><br>
              <img data-original="<?php echo ASSETS;?>images/ARROW_RF.svg" class="fs_io lazy">
            </div>
            <div class="spacer"></div>
          </li>
          <li class="fs_airlinecontainer fsa_departure">
           <div class="fs_airline">
            <div class="fs_image">
              <img alt="Departure Logo" data-original="<?php echo ASSETS;?>images/ARRIVAL_RF.svg" class="lazy">
            </div>
            <div class="fs_values">
              <span class="fsa_airlinename"><b><?php echo $toCityName;?></b> (<?php echo $last_seg->Destination;?>)</span>
              <div class="fsa_departure"><small><?php echo date('H:i', $this->flight_model->get_unixtimestamp($last_seg->ArrivalTime));?> (<?php echo date('d M, D Y', $ArrivalDateTime);?>)</small></div>
            </div>
          </div>
          <div class="spacer"></div>
        </li>
        <li class="fs_airlinecontainer">
          <div class="fs_airline">
            <div class="fs_values">
              <span class="fsa_airlinename"><?php echo $dur;?></span><br />
              <span class="fsa_departure"><?php echo (($Stops>1)?$Stop.lang_line('STOPS'):(($Stop==0)?lang_line('NONSTOP'):$Stop.lang_line('STOP')));?></span>
            </div>
          </div>
          <div class="spacer"></div>
        </li> <!--frow1-->
      </ul>
    </li>
    <?php		}else{
      $Stop = count($all_segments)-1;
      $fromCityName =  $this->flight_model->get_airport_cityname($all_segments->Origin);
      $toCityName =  $this->flight_model->get_airport_cityname($all_segments->Destination);
      $ArrivalDateTime  = strtotime($all_segments->ArrivalTime);
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
     <li class="full_width">
      <ul class="list-inline fsmultiflight_flightdata">
         <li class="fs_airlinecontainer"><!--air icon row-->
           <img data-original="<?php echo ASSETS;?>images/airline_logo/<?php echo $all_segments->Carrier;?>.gif" id="FF<?php echo str_replace('.', '', $flight->TotalPrice+$TotalMarkupFeeAmount).$i;?>" alt="Airline Logo" class="fs_fname lazy">
         </li><!--air icon row-->
        <li class="fs_airlinecontainer"> <!--frow1-->
          <div class="fs_airline">
            <div class="fs_image">
             <img alt="Departure Logo" data-original="<?php echo ASSETS;?>images/DEPARTURE_RF.svg" class="fs_dep lazy">
           </div>
           <div class="fs_values">
            <span class="fsa_airlinename"><b><?php echo $fromCityName;?></b> (<?php echo $all_segments->Origin;?>)</span><br />
            <span class="fsa_departure"><small><?php echo date('H:i', $this->flight_model->get_unixtimestamp($all_segments->DepartureTime));?> (<?php echo date('d M, D Y', $DepartureDateTime);?>)</small></span>
          </div>
        </div>
        <div class="spacer"></div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond"><?php echo lang_line('OUT_BOUND');?></span><br>
          <img data-original="<?php echo ASSETS;?>images/ARROW_RF.svg" class="fs_io lazy">
        </div>
        <div class="spacer"></div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
       <div class="fs_airline">
        <div class="fs_image">
          <img alt="Departure Logo" data-original="<?php echo ASSETS;?>images/ARRIVAL_RF.svg" class="lazy">
        </div>
        <div class="fs_values">
          <span class="fsa_airlinename"><b><?php echo $toCityName;?></b> (<?php echo $all_segments->Destination;?>)</span><br />
          <span class="fsa_departure"><small><?php echo date('H:i', $this->flight_model->get_unixtimestamp($all_segments->ArrivalTime));?> (<?php echo date('d M, D Y', $ArrivalDateTime);?>)</small></span>
        </div>
      </div>
      <div class="spacer"></div>
    </li>
    <li class="fs_airlinecontainer">
      <div class="fs_airline">
        <div class="fs_values">
          <span class="fsa_airlinename"><?php echo $dur;?></span><br />
          <span class="fsa_departure"><?php echo (($Stop>1)?$Stop.lang_line('STOPS'):(($Stop==0)?lang_line('NONSTOP'):$Stop.lang_line('STOP')));?></span>
        </div>
      </div>
      <div class="spacer"></div>
    </li> <!--frow1-->
  </ul>
</li>   
<?php	} ?>
<?php } ?>
</ul>
</li>
<li class="fs_airlinecontainer fs_book">
  <div class="fsaf_container">
    <div class="col-sm-5">
      <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-toggle="modal" data-id='collapse<?php echo $i;?>' data-target="#Flight-Details"><?php echo lang_line('FLIGHT_DET');?></button>
      <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="<?php echo $last_getfare_details;?>" onclick="show_fare_popup(this.id,this,1)"><?php echo lang_line('FARE_COND');?></button>
    </div>
    <div class="col-sm-7">
      <div class="fs_airline">
        <div class="fs_values">
         <span class="fsa_airlinename currency"><?php echo $this->display_icon;?></span>
         <span class="fsa_airlinename amount"><?php echo $this->account_model->currency_convertor($flight->TotalPrice+$TotalMarkupFeeAmount);?></span><br />
         <span class="fsa_departure"><?php echo lang_line('PPM');?></span>
       </div>
     </div>
     <div class="spacer"></div>
     <div class="fs_airline">
      <div class="fs_values">
        <form target="_blank" name="flightbook<?php echo $i;?>" id="F<?php echo str_replace('.', '', $flight->TotalPrice+$TotalMarkupFeeAmount).$i;?>" method="post" action="<?php echo WEB_URL.'/flight/AddToCart';?>">
          <input type="hidden" name="temp_d" value="<?php echo $flight_data;?>" required/>
          <input type="hidden" name="temp_r" value="<?php echo $request;?>" required/>
          <button type="submit" data-attr="F<?php echo str_replace('.', '', $flight->TotalPrice+$TotalMarkupFeeAmount).$i;?>" class="btn btn-primary btn_inputs"><?php echo lang_line('BOOK_NOW');?></button><br/>
        </form>
      </div>
    </div>
  </div>
</div>
</li>
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
          <div class="col-sm-9 rmf_flight">
            <?php 
            $s=0; $ssss=0;
            foreach($flight->segments as $key => $segment){
              if(!is_array($segment)){
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
                ?>
                <ul class="list-inline rfm_flightdetails" <?php if($s!=0){?> style="margin-top:15px;" <?php } ?>>
                 <?php $vv=$s+1;
                 $class_arr=array('','pikeronwds','pikerret','pikermulti','pikeronwds','pikerret','pikermulti');
                 if($this->session->userdata('language')!='dutch'){
                 $range=($vv==1)?'st':(($vv==2)?'nd':(($vv==3)?'rd':(($vv>3)?'th':'')));
                 $range="<sup>".$range."</sup> ";
                  }else{
                    $range=($vv==1)?'e':(($vv==2)?'e':(($vv==3)?'e':(($vv>3)?'e':''))); 

                  }
                  if($s==0){
                 ?> 
                 <li><?php echo ($vv).$range."&nbsp;".lang_line('FLIGHT');?></li>
                <?php }else{?>
                 <li>&nbsp;</li>
                 <?php } ?>
                 <li><?php echo $this->flight_model->get_airport_name($segment->Origin);?> -<?php echo $this->flight_model->get_airport_name($segment->Destination);?></li>
                 <li><?php echo date('l d F', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></li>
               </ul>
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
          </ul>
          <?php $ssss++;} else{ 
            $numberof_seg=count($segment);
            $extra_segment=$segment;
            $v=0; 
            foreach($extra_segment as $keys => $segment){
             // while
              //print_r($extra_segment[$keys]);
              //print_r($extra_segment);
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
              <ul class="list-inline rfm_flightdetails"  style="margin-top:15px;" >
               <?php
               $vv=$s+1;
               $class_arr=array('','pikeronwds','pikerret','pikermulti','pikeronwds','pikerret','pikermulti');
              // $range=($vv==1)?'st':(($vv==2)?'nd':(($vv==3)?'rd':(($vv>3)?'th':'')));
               if($this->session->userdata('language')!='dutch'){
                 $range=($vv==1)?'st':(($vv==2)?'nd':(($vv==3)?'rd':(($vv>3)?'th':'')));
                 $range="<sup>".$range."</sup> ";
                  }else{
                    $range=($vv==1)?'e':(($vv==2)?'e':(($vv==3)?'e':(($vv>3)?'e':''))); 

                  }
                  if($v==0){
                 ?> 
                 <li><?php echo ($vv).$range."&nbsp;".lang_line('FLIGHT');?></li>
                 <?php }else{?>
                 <li>&nbsp;</li>
                 <?php } ?>
               <li><?php echo $this->flight_model->get_airport_name($segment->Origin);?> -<?php echo $this->flight_model->get_airport_name($segment->Destination);?></li>
               <li><?php echo date('l d F', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></li>
             </ul>
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
            <?php  if($numberof_seg > 0 &&  $keys+1 < $numberof_seg){ ?>
            <li class="rfms_stopovertime">
              <?php echo lang_line('PLANE_CHNAGE_DET');?>: <?php echo $this->flight_model->get_airport_name($segment->Destination);?>, | <strong><?php echo lang_line('LAYOVER');?>:: <?php echo $Layover;?></strong> 
            </li>
            <li class="rfms_stopovertime">
             <?php echo lang_line('TOTLA_JOURNEY');?>: <strong><?php echo $tot_dur;?></strong>
           </li>
           <?php }  ?>
         </ul>
         <?php   $v++; $ssss++;} ?>
         <?php   } ?>
         <?php  $s++;} ?>
       </div><!-- col-sm-9-->
       <div class="col-sm-3"><!--col-sm-3-->
        <ul class="normal-list">
          <li class="rmf_price">
           <span><?php echo $this->display_icon;?></span><span><?php echo $this->account_model->currency_convertor($flight->TotalPrice+$TotalMarkupFeeAmount);?></span>
         </li>
         <li class="rfm_flightdet">
          <?php echo lang_line('PPM');?>
        </li>
        <li class="rmf_book">
          <form target="_blank" method="post" name="flightbook<?php echo $i;?>" id="F<?php echo str_replace('.', '', $flight->TotalPrice+$TotalMarkupFeeAmount).$i;?>" action="<?php echo WEB_URL.'/flight/AddToCart';?>">
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
</li><!--each row-->
<?php $i++;}?>

<?php $Airlines = array_unique($Airlines); //Creating Unique Airlines?>
<?php $Stops =is_array($Stops)?array_unique($Stops):''; //Creating Unique Stops?>
<input type="hidden" name="temp_d" value=""/>
<input type="hidden" id="setMinPrice" value="<?php if(!empty($price)) echo min($price); else echo 0; ?>" />
<input type="hidden" id="setMaxPrice" value="<?php if(!empty($price)) echo max($price); else echo 0; ?>" />
<input type="hidden" id="setMinTime" value="0" />
<input type="hidden" id="setMaxTime" value="1440" />
<input type="hidden" id="markup_price" value="<?php echo $TotalMarkupFeeAmount;?>" />
<input type="hidden" id="table_count" />
<input type="hidden" id="disc_price" value="<?php echo isset($req->disc_price)?$req->disc_price:0;?>" />
<script>
<?php if($req->depMinTime!='' && $req->depMaxTime!=''){ ?>
   // showDepFlights(<?php echo $req->depMinTime;?>, <?php echo $req->depMaxTime;?>)
   <?php } ?>
   <?php if($req->arrMinTime!='' && $req->arrMaxTime!=''){ ?>
     // showArrFlights(<?php echo $req->arrMinTime;?>, <?php echo $req->arrMaxTime;?>)
     <?php } ?>
     <?php if($req->MinDuration!='' && $req->MaxDuration!=''){ ?>
     // showDurFlights(<?php echo $req->MinDuration;?>, <?php echo $req->MaxDuration;?>)
     <?php } ?>
     <?php if($req->MinPrice!='' && $req->MaxPrice!=''){ ?>
      showFlights(<?php echo $req->MinPrice;?>, <?php echo $req->MaxPrice;?>);
      <?php } ?>
      function showFlights(minPrice, maxPrice) {
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
          var dep = $(this).data("arrive");
          return dep >= mint && dep <= maxt;
        }).show();
      }
      function showDurFlights(mint, maxt) {
        $("ul.flights li.flight").hide().filter(function() {
          var dep = $(this).data("duration");
          return dep >= mint && dep <= maxt;
        }).show();
      }
      $(function() {
      //price filter
      $( "#price-filter" ).slider({
        range: true,
        min: <?php echo $this->account_model->currency_convertor(min($price))?>,
        max: <?php echo $this->account_model->currency_convertor(max($price))?>,
        values: [ <?php echo $this->account_model->currency_convertor(min($price))?>, <?php echo $this->account_model->currency_convertor(max($price))?> ],
        slide: function( event, ui ) {
          $('#min_price').text(CURR_ICON+ $( "#price-filter" ).slider( "values", 0 ));
          $('#max_price').text(CURR_ICON+ $( "#price-filter" ).slider( "values", 1 ) );
        },
        change: function( event, ui ) {
          one=ui.values[0];
          two=ui.values[1];
          showFlights(one, two);
        }
      });
      $('#min_price').text(CURR_ICON+ $( "#price-filter" ).slider( "values", 0 ));
      $('#max_price').text(CURR_ICON+ $( "#price-filter" ).slider( "values", 1 ) );
      //price filter
      //departure filter
      $( "#departure-filter" ).slider({
        range: true,
        min: 0,
        max: 1439,
        step: 1,
        values: [ 0, 1439 ],
        slide: slideDep_Time,
        change: function( event, ui ) {
          one=ui.values[0];
          two=ui.values[1];
          showDepFlights(one, two);
        }
      });
      //departure filter
      //arrival filter
      $( "#arrival-filter" ).slider({
        range: true,
        min: 0,
        max: 1439,
        step: 1,
        values: [ 0, 1439 ],
        slide: slideArr_Time,
        change: function( event, ui) {
          one=ui.values[0];
          two=ui.values[1];
          showArrFlights(one, two);
        }
      });
      //arrival filter
      //duration filter
      $( "#duration-filter" ).slider({ 
        range: true,
        min: 0,
        max: 1439,
        step: 1,
        values: [ 0, 1439 ],
        slide: slideDur_Time,
        change: function( event, ui) {
          one=ui.values[0];
          two=ui.values[1];
          showDurFlights(one, two);
        }
      });
      //duration filter
    });
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
slideDep_Time(); 
slideDur_Time();
slideArr_Time();
$(document).ready(function(){
  <?php if($req->Stop!=''){ ?>
    var bb=<?php echo $req->Stop;?>;
    $('ul.flights li.flight').hide();
    $('ul.flights li.flight[data-stops="'+ bb +'"]').show();
    <?php } ?>
    $('ul#Airlines li:last').after('<?php $i=1;foreach($Airlines as $airline){?> <li class="col-sm-6 nopadd"><label for="<?php echo stripslashes($airline);?>"><input name="AirlineFilter[]" type="checkbox" id="<?php echo stripslashes($airline);?>" value="<?php echo stripslashes($airline);?>"/><?php echo $this->flight_model->get_airline_name($airline);?> </label></li><?php $i++; }?>');       
    $('#StopFilter option:last').after('<?php $i=1;foreach($Stops as $stop){?><option value="<?php echo $stop;?>" ><?php if($stop == 0){ echo 'Non';}else if($stop == 1){echo 'One';}else if($stop == 2){echo 'Two';}else if($stop == 3){echo 'Three';}else{echo $stop;}?>-Stop</option><?php $i++; }?>');
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
    
    $('ul.flights li.flight[data-airlinecode="'+ $selected +'"]').show();
  }else if($selected=='All' || $selected==''){
    $errorMessage.hide();
    $('ul.flights li.flight').show();
  }
});
  }else {
    $errorMessage.show();
  }
});
var $filters1 = $("#StopFilter"); // start all checked
var $categoryContent1 = $('ul.flights li.flight'); // Path for flights
var $errorMessage = $('#errorMessage'); //Error Message

$filters1.on('change', function(){
  $categoryContent1.hide(); // if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
  var $selectedFilters1 = $filters1.val();
  if (selectedFilters1!='All' && $selectedFilters1!='') {
    $errorMessage.hide();
    $('ul.flights li.flight[data-stops="'+ $selectedFilters1 +'"]').show();
  }else if($selectedFilters1=='All' || $selectedFilters1==''){
    $errorMessage.hide();
    $('ul.flights li.flight').show();
  } else {
    $errorMessage.show();
  }
});
});
$(document).ready(function(){
  var disc_price=$("#disc_price").val();
  $("li.flight").find("span.amount").each(function() {
    if($(this).text()==disc_price){
      $(this).after('<p class="text-success">Offer</p>');
    }
  });
});
var count = 0;
function limit_flight_table(){
  $('ul.flights li.flight').css('display','none');
  var click_count = ++count;
  var table_count = 15 * click_count;
  $('#table_count').val(table_count);
  var total_count = $('ul.flights li.flight').length;
  for(var i=0;i<table_count;i++){
    $('ul.flights li#ticketid0123'+i).css("display","block");
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
</script>