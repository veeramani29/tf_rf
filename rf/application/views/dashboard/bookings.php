    <script src="<?php echo ASSETS;?>js/star-rating.js"></script>
    <!-- TAB 2 -->
    <div class="tab-pane rfboxed-background <?php if(!empty($page_type) && $page_type == "bookings") {echo "active";} ?>" id="bookings">
      <div class="col-sm-12">

        <?php 

        if(!empty($ApartmentBookings)){ 
         $failed=array();$confirmed=array();$pending=array();$cancelled=array();
         foreach($ApartmentBookings as $booking){
          if($booking->booking_status == 'FAILED')
          {
            $failed[] = $booking->api_status;
          }
          if($booking->booking_status == 'CONFIRMED')
          {
            $confirmed[] = $booking->booking_status;
          }
          if($booking->booking_status == 'PENDING')
          {
            $pending[] = $booking->booking_status;
          }
          if($booking->booking_status == 'CANCELED')
          {
            $cancelled[] = $booking->booking_status;
          }
          $days[] = $booking->amount;
        } 
             // $countries = array_unique($countries);
        $failed_count = count($failed);
        $confirmed_count = count($confirmed);
        $pending_count = count($pending);
        $cancelled_count = count($cancelled);

             // $places = array_unique($places);

        $days_count = array_sum($days);

        $trips_count = count($ApartmentBookings);
      }else{
        $failed_count = 0;
        $confirmed_count = 0;
        $pending_count = 0;
        $cancelled_count = 0;
        $days_count = 0;
      }
      ?>
      <div class="senstabl">
        <ul class="grey bookingdetails_list">
          <li class="center colbt">
            <span class="size30 slim lh4 dark"><?php if(isset($trips_count)) { echo $trips_count; } else { echo 0; } ?></span><br/>
            <span class="size12"><?php echo lang_line('TRIPS');?></span>
          </li>
          <li class="center colbt">
            <span class="size30 slim lh4 dark"><?php echo $confirmed_count;?></span><br/>
            <span class="size12"><?php echo lang_line('CNFRMD');?></span>
          </li>
          <li class="center colbt">
            <span class="size30 slim lh4 dark"><?php echo $pending_count;?></span><br/>
            <span class="size12"><?php echo lang_line('PENDING');?></span>
          </li>
          <li class="center colbt">
            <span class="size30 slim lh4 dark"><?php echo $cancelled_count;?></span><br/>
            <span class="size12"><?php echo lang_line('CANCELLED');?></span>
          </li>
          <li class="center colbt">
            <span class="size30 slim lh4 dark"><?php echo $failed_count;?></span><br/>
            <span class="size12"><?php echo lang_line('FAILED');?></span>
          </li>
        </ul>
      </div>

      <div class="clear"></div>
      <div class="twohedbacbuk">

        <!-- <span class="dark size16"><?php echo lang_line('MY_BOOKINGS');?></span> -->
      </div>
      <div class="clear"></div>



      


      <div class="rowitbk left">
        <ul id="user_bookings">
          <?php 
          if(!empty($pnr_nos)){
            foreach($pnr_nos as $pnr_no){
              ?>

              <?php 
              if($pnr_no->module == 'FLIGHT'){
                $booking = $this->booking_model->getBookingbyPnr($pnr_no->pnr_no,$pnr_no->module)->row();
                $request = json_decode(base64_decode($booking->request));
                if($request->type == 'O'){  
                  $flight = json_decode(base64_decode($booking->response));
                  $first_seg = reset($flight->segments);
                  $last_seg = end($flight->segments);
                  $Stops = count($flight->segments)-1;
                  $fromCityName =  $this->flight_model->get_airport_cityname($first_seg->Origin);
                  $toCityName =  $this->flight_model->get_airport_cityname($last_seg->Destination);
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
                ?>
                <li class="">
                  <!--<div class="bookingicon <?php echo 'p_'.strtolower($booking->module);?>"></div>-->



                  <!-- flight search result single Start -->
                  <ul class="bookings_retrnflight fs_flightlist flights">
                    <li class="fs_singleflight flight" id="">
                      <ul class="list-inline">
                        <li>
                          <img  alt="Airline Logo" class="fs_fname lazy" src="<?php echo ASSETS;?>images/airline_logo/<?php echo $first_seg->Carrier;?>.gif">
                        </li>
                        <li class="fs_airlinecontainer">
                          <div class="fs_airline">
                            <div class="fs_image">
                              <img alt="Departure Logo" class="fs_dep lazy" src="<?php echo ASSETS;?>images/DEPARTURE_RF.svg">
                            </div>
                            <div class="fs_values">
                              <span class="fsa_airlinename">  <b><?php echo $fromCityName;?></b> (<?php echo $first_seg->Origin;?>) </span><br>
                              <span class="fsa_departure"><small><?php echo date('H:i', $DepartureDateTime);?> (<?php echo date('d M, D Y', $DepartureDateTime);?>)</small></span>
                            </div>
                          </div>
                          <div class="spacer"></div>
                        </li>
                        <li class="fs_inout">
                          <div class="fs-outbond">
                            <span class="fso_outbond"><?php echo lang_line('OUT_BOUND');?></span><br>
                            <img class="fs_io lazy" src="<?php echo ASSETS;?>images/ARROW_RF.svg">
                          </div>
                          <div class="spacer"></div>
                        </li>
                        <li class="fs_airlinecontainer fsa_departure">
                         <div class="fs_airline">
                          <div class="fs_values">
                            <span class="fsa_airlinename"><b><?php echo $toCityName;?></b> (<?php echo $first_seg->Destination;?>)</span><br>
                            <span class="fsa_departure"><small><?php echo date('H:i', $ArrivalDateTime);?> (<?php echo date('d M, D Y', $ArrivalDateTime);?>)</small></span>
                          </div>
                        </div>
                        <div class="spacer"></div>
                      </li>
                      <li class="fs_airlinecontainer">
                        <div class="fs_airline">
                          <div class="fs_values">
                            <span class="fsa_airlinename"><?php echo $dur;?></span><br>
                            <span class="fsa_departure"><?php echo (($Stops>1)?$Stops.lang_line('STOPS'):(($Stops==0)?lang_line('NONSTOP'):$Stops.lang_line('STOP')));?></span>
                          </div>
                        </div>
                        <div class="spacer"></div>
                      </li>
                      <li class="fs_airlinecontainer fs_book">
                        <div class="nopadd">
                          <div class="fs_airline">
                            <div class="fs_values">
                              <span class="fsa_airlinename currency"><?php echo CURR_ICON?></span>
                              <span class="fsa_airlinename amount"><?php echo $booking->amount;?></span><br>
                              <span class="fsa_departure"><?php echo lang_line('PPS');?></span>
                            </div>
                          </div>
                          <div class="spacer"></div>
                          <div class="fs_airline">
                            <div class="fs_values">
                              <button type="button"  class="btn btn-primary btn_inputs"><?php echo $booking->booking_status;?></button>
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
                <!-- flight search result single End -->


                <div class="tablofcon">


                  <div class="col-sm-12 nopadd oconcell">
                    <div class="topfisconf">

                      <div class="col-md-12 nopad">
                        <div class="rowfux">
                          <div class="col-md-2 nopad">
                            <div class="labloux"><?php echo lang_line('RESERV_DATE');?></div>
                          </div>
                          <div class="col-md-2 nopad">
                            <div class="answrux"> <?php echo date('D, d M Y', strtotime($booking->voucher_date));?></div>
                          </div>
                          <div class="col-md-2 nopad">
                            <div class="labloux"><?php echo lang_line('CONF_NO');?></div>
                          </div>
                          <div class="col-md-2 nopad">
                            <div class="answrux"> <?php echo $booking->pnr_no;?></div>
                          </div>
                          <div class="col-md-2 nopad">
                            <div class="labloux nomarb"><?php echo lang_line('BOOKING_STATUS');?></div>
                          </div>
                          <div class="col-md-2 nopad">
                            <div class="answrux nomarb"> <?php echo $booking->booking_status;?></div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12 nopad">
                        <div class="botufis">

                          <?php if($booking->booking_status == 'CONFIRMED'){?>
                          <a title="<?php echo lang_line('CANCEL');?>" onclick="flight_cancel_booking(this)" data-pnr="<?php echo base64_encode(base64_encode($booking->pnr_no));?>" data-placement="top" class="btn btn-gray has-tooltip" data-original-title="<?php echo lang_line('CANCEL');?>">
                            <i class="icon-off"></i><?php echo lang_line('CANCEL');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                          </a>
                          <?php }?>

                          <a title="<?php echo lang_line('MAIL_VOUCHER');?>" onclick="flight_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-secondry has-tooltip" data-original-title="<?php echo lang_line('MAIL_VOUCHER');?>">
                            <i class="icon-envelope"></i><?php echo lang_line('MAIL_VOUCHER');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                          </a>
                          <a href="<?php echo WEB_URL.'/flight/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="<?php echo lang_line('VIEW_VOUCHER');?>" data-placement="top" class="btn btn-secondry has-tooltip" data-original-title="<?php echo lang_line('VIEW_VOUCHER');?>">
                            <i class="icon-ticket"></i><?php echo lang_line('VIEW_VOUCHER');?>
                          </a>

                          <?php   if($booking->user_type == '3'){ ?>
                          <a title="<?php echo lang_line('MAIL_INVOICE');?>" onclick="flight_mail_uinvoice(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-secondry has-tooltip" data-original-title="<?php echo lang_line('MAIL_INVOICE');?>">
                            <i class="icon-envelope"></i><?php echo lang_line('MAIL_INVOICE');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                          </a>


                          <?php } if($booking->user_type == '3'){ ?>
                          <a href="<?php echo WEB_URL.'/flight/uinvoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="<?php echo lang_line('VIEW_INVOICE');?>" data-placement="top" class="btn btn-secondry has-tooltip" data-original-title="<?php echo lang_line('VIEW_INVOICE');?>">
                            <i class="icon-ticket"></i><?php echo lang_line('VIEW_INVOICE');?>
                          </a>
                          <?php }?>
                        </div>

                      </div>
                    </div>
                  </div>                    
                </div>
                <div class="clearfix"></div>
              </li>
              <?php 
            }else if ($request->type == 'R') {
              $flight = json_decode(base64_decode($booking->response));
              $onward_first_seg = reset($flight->onward->segments);
              $onward_last_seg = end($flight->onward->segments);
              $return_first_seg = reset($flight->return->segments);
              $return_last_seg = end($flight->return->segments);
              $Stops = count($flight->onward->segments)-1;
              $retStops = count($flight->return->segments)-1;
              $onward_fromCityName =  $this->flight_model->get_airport_cityname($onward_first_seg->Origin);
              $onward_toCityName =  $this->flight_model->get_airport_cityname($onward_last_seg->Destination);

              $return_fromCityName =  $this->flight_model->get_airport_cityname($return_first_seg->Origin);
              $return_toCityName =  $this->flight_model->get_airport_cityname($return_last_seg->Destination);

              $onward_DepartureDateTime = $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime);
              $onward_ArrivalDateTime = $this->flight_model->get_unixtimestamp($onward_first_seg->ArrivalTime);
              $onward_dur = $this->flight_model->get_duration(strtotime($onward_first_seg->DepartureTime),strtotime($onward_last_seg->ArrivalTime));
              $return_DepartureDateTime = $this->flight_model->get_unixtimestamp($return_first_seg->DepartureTime);
              $return_ArrivalDateTime = $this->flight_model->get_unixtimestamp($return_first_seg->ArrivalTime);
              $return_dur =  $this->flight_model->get_duration(strtotime($return_first_seg->DepartureTime),strtotime($return_last_seg->ArrivalTime));
              ?>
              <li class="">
                <!-- flight result return new rfactory start -->
                <ul class="fs_flightlist flights bookings_retrnflight">
                  <li class="fs_singleflight flight" id="" style="display: list-item;">
                    <ul class="list-inline">
                      <li>
                        <img id="FF165610" alt="Airline Logo" class="fs_fname lazy" src="<?php echo ASSETS;?>images/airline_logo/<?php echo $onward_first_seg->Carrier;?>.gif">
                      </li>
                      <li class="fs_airlinecontainer">
                        <div class="fs_airline">
                          <div class="fs_image">
                            <img class="fs_dep lazy" src="<?php echo ASSETS;?>images/DEPARTURE_RF.svg">
                          </div>
                          <div class="fs_values">
                            <span class="fsa_airlinename">  <b><?php echo $onward_fromCityName;?></b> (<?php echo $onward_first_seg->Origin;?>) </span><br>
                            <span class="fsa_departure"><?php echo date('H:i', $onward_DepartureDateTime);?> (<?php echo date('d M, D Y', $onward_DepartureDateTime);?>)</span>

                          </div>
                        </div>
                        <div class="spacer"></div>
                        <div class="fs_airline">
                          <div class="fs_image">
                            <img class="fs_dep lazy" src="<?php echo ASSETS;?>images/DEPARTURE_RF.svg">
                          </div>
                          <div class="fs_values">
                            <span class="fsa_airlinename"><b><?php echo $onward_toCityName;?></b> (<?php echo $onward_last_seg->Destination;?>) </span><br>
                            <span class="fsa_departure"><small><?php echo date('H:i', $onward_ArrivalDateTime);?> (<?php echo date('d M, D Y', $onward_ArrivalDateTime);?>)</small></span>
                          </div>

                        </div>
                      </li>
                      <li class="fs_inout">
                        <div class="fs-outbond">
                          <span class="fso_outbond"><?php echo lang_line('OUT_BOUND');?></span><br>
                          <img class="fs_io lazy" src="<?php echo ASSETS;?>images/ARROW_RF.svg">
                        </div>
                        <div class="spacer"></div>
                        <div class="fs-outbond">
                          <span class="fso_outbond"><?php echo lang_line('RETURN');?></span><br>
                          <img class="fs_io lazy" src="<?php echo ASSETS;?>images/ARROW_RF.svg">
                        </div>
                      </li>
                      <li class="fs_airlinecontainer fsa_departure">
                        <div class="fs_airline">
                          <div class="fs_values">
                            <span class="fsa_airlinename"><b><?php echo $return_fromCityName;?></b> (<?php echo $return_first_seg->Origin;?>) </span><br>
                            <span class="fsa_departure"><?php echo date('H:i', $return_DepartureDateTime);?> (<?php echo date('d M, D Y', $return_DepartureDateTime);?>)</span>
                          </div>
                        </div>
                        <div class="spacer"></div>
                        <div class="fs_airline">
                          <div class="fs_values">
                            <span class="fsa_airlinename">  <b><?php echo $return_toCityName;?></b> (<?php echo $return_last_seg->Destination;?>)</span><br>
                            <span class="fsa_departure"><?php echo date('H:i', $return_ArrivalDateTime);?> (<?php echo date('d M, D Y', $return_ArrivalDateTime);?>)</span>
                          </div>
                        </div>
                      </li>
                      <li class="fs_airlinecontainer">
                        <div class="fs_airline">
                          <div class="fs_values">
                            <span class="fsa_airlinename"> <?php echo $onward_dur;?></span><br>
                            <span class="fsa_departure"> <?php echo (($Stops>1)?$Stops.lang_line('STOPS'):(($Stops==0)?lang_line('NONSTOP'):$Stops.lang_line('STOP')));?><br/></span>
                          </div>
                        </div>
                        <div class="spacer"></div>
                        <div class="fs_airline">
                          <div class="fs_values">
                            <span class="fsa_airlinename"> <?php echo $return_dur;?></span><br>
                            <span class="fsa_departure"> <?php echo (($retStops>1)?$retStops.lang_line('STOPS'):(($retStops==0)?lang_line('NONSTOP'):$retStops.lang_line('STOP')));?><br/></span>
                          </div>
                        </div>
                      </li>
                      <li class="fs_airlinecontainer fs_book">
                        <div class="nopadd">
                          <div class="fs_airline">
                            <div class="fs_values">
                              <span class="fsa_airlinename currency"><?php echo CURR_ICON?></span>
                              <span class="fsa_airlinename amount"><?php echo $booking->amount;?></span><br>
                              <span class="fsa_departure"><?php echo lang_line('PPR');?></span>
                            </div>
                          </div>
                          <div class="spacer"></div>
                          <div class="fs_airline">
                            <div class="fs_values">
                              <button type="button"  class="btn btn-primary btn_inputs"><?php echo $booking->booking_status;?></button>
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
                <!-- flight result new rfactory end -->
                <div class="tablofcon">                      
                  <div class="col-sm-12 nopadd oconcell">
                    <div class="topfisconf">

                      <div class="col-md-12 nopad">
                        <div class="rowfux">
                          <div class="col-md-2 nopad">
                            <div class="lablofux"><?php echo lang_line('RESERV_DATE');?></div>
                          </div>
                          <div class="col-md-2 nopad">
                            <div class="answrfux"> <?php echo date('D, d M Y', strtotime($booking->voucher_date));?></div>
                          </div>
                          <div class="col-md-2 nopad">
                            <div class="lablofux"><?php echo lang_line('CONF_NO');?></div>
                          </div>
                          <div class="col-md-2 nopad">
                            <div class="answrfux"> <?php echo $booking->pnr_no;?></div>
                          </div>

                          <div class="col-md-2 nopad">
                            <div class="lablofux nomarb"><?php echo lang_line('BOOKING_STATUS');?></div>
                          </div>
                          <div class="col-md-2 nopad">
                            <div class="answrfux nomarb"> <?php echo $booking->booking_status;?></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 nopad">
                        <div class="botufis">
                          <?php if($booking->booking_status == 'CONFIRMED'){?>
                          <a title="<?php echo lang_line('CANCEL');?>" onclick="flight_cancel_booking(this)" data-pnr="<?php echo base64_encode(base64_encode($booking->pnr_no));?>" data-placement="top" class="btn btn-gray has-tooltip" data-original-title="<?php echo lang_line('CANCEL');?>">
                            <i class="icon-off"></i><?php echo lang_line('CANCEL');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                          </a>
                          <?php }?>
                          <a title="<?php echo lang_line('MAIL_VOUCHER');?>" onclick="flight_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-secondry has-tooltip" data-original-title="<?php echo lang_line('MAIL_VOUCHER');?>">
                            <i class="icon-envelope"></i><?php echo lang_line('MAIL_VOUCHER');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                          </a>

                          <a href="<?php echo WEB_URL.'/flight/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="<?php echo lang_line('VIEW_VOUCHER');?>" data-placement="top" class="btn btn-secondry has-tooltip" data-original-title="<?php echo lang_line('VIEW_VOUCHER');?>">
                            <i class="icon-ticket"></i><?php echo lang_line('VIEW_VOUCHER');?>
                          </a>

                          <?php  if($booking->user_type == '3'){ ?>
                          <a title="<?php echo lang_line('MAIL_INVOICE');?>" onclick="flight_mail_uinvoice(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-secondry has-tooltip" data-original-title="<?php echo lang_line('MAIL_INVOICE');?>">
                            <i class="icon-envelope"></i><?php echo lang_line('MAIL_INVOICE');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                          </a>                         
                          <?php }  if($booking->user_type == '3'){ ?>
                          <a href="<?php echo WEB_URL.'/flight/uinvoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="<?php echo lang_line('VIEW_INVOICE');?>" data-placement="top" class="btn btn-secondry has-tooltip" data-original-title="<?php echo lang_line('VIEW_INVOICE');?>">
                            <i class="icon-ticket"></i><?php echo lang_line('VIEW_INVOICE');?>
                          </a>
                          <?php }?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </li>

              <?php 
            }else if($request->type=='M') { 
              $flight = json_decode(base64_decode($booking->response));
              ?>
              <li class="">
                <ul class="bookings_retrnflight fs_flightlist flights">
                  <li class="fs_singleflight flight multibooklist_con" id="">
                    <div class="clear"></div>
                    <?php foreach($flight->segments as $k) { 
                      if(is_array($k)){
                       $onward_first_seg = reset($k);
                       $onward_last_seg = end($k);
                       $Stops = count($k)-1;
                       $dur = $this->flight_model->get_duration(strtotime($onward_first_seg->DepartureTime),strtotime($onward_last_seg->ArrivalTime));
                       $fromCityName =  $this->flight_model->get_airport_cityname($onward_first_seg->Origin);
                       $toCityName =  $this->flight_model->get_airport_cityname($onward_last_seg->Destination);
                       $DepartureDateTime = $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime);
                       $ArrivalDateTime = $this->flight_model->get_unixtimestamp($onward_first_seg->ArrivalTime);
                     }else{
                      $onward_first_seg = $k;
                      $onward_last_seg = $k;
                      $Stops = count($k)-1;
                      $dur = $this->flight_model->get_duration(strtotime($onward_first_seg->DepartureTime),strtotime($onward_last_seg->ArrivalTime));
                      $fromCityName =  $this->flight_model->get_airport_cityname($onward_first_seg->Origin);
                      $toCityName =  $this->flight_model->get_airport_cityname($onward_last_seg->Destination);

                      $DepartureDateTime = $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime);
                      $ArrivalDateTime = $this->flight_model->get_unixtimestamp($onward_first_seg->ArrivalTime);
                    }
                    ?>
                    <!-- flight search result single Start -->
                    <ul class="list-inline">
                      <li>
                        <img  alt="Airline Logo" class="fs_fname lazy" src="<?php echo ASSETS;?>images/airline_logo/<?php echo $onward_first_seg->Carrier;?>.gif">
                      </li>
                      <li class="fs_airlinecontainer">
                        <div class="fs_airline">
                          <div class="fs_image">
                            <img alt="Departure Logo" class="fs_dep lazy" src="<?php echo ASSETS;?>images/DEPARTURE_RF.svg">
                          </div>
                          <div class="fs_values">
                            <span class="fsa_airlinename">  <b><?php echo $fromCityName;?></b> (<?php echo $onward_first_seg->Origin;?>) </span><br>
                            <span class="fsa_departure"><small><?php echo date('H:i', $DepartureDateTime);?> (<?php echo date('d M, D Y', $DepartureDateTime);?>)</small></span>
                          </div>
                        </div>
                        <div class="spacer"></div>
                      </li>
                      <li class="fs_inout">
                        <div class="fs-outbond">
                          <span class="fso_outbond"><?php echo lang_line('OUT_BOUND');?></span><br>
                          <img class="fs_io lazy" src="<?php echo ASSETS;?>images/ARROW_RF.svg">
                        </div>
                        <div class="spacer"></div>
                      </li>
                      <li class="fs_airlinecontainer fsa_departure">
                       <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename"><b><?php echo $toCityName;?></b> (<?php echo $onward_last_seg->Destination;?>)</span><br>
                          <span class="fsa_departure"><small><?php echo date('H:i', $ArrivalDateTime);?> (<?php echo date('d M, D Y', $ArrivalDateTime);?>)</small></span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                    </li>
                    <li class="fs_airlinecontainer">
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename"><?php echo $dur;?></span><br>
                          <span class="fsa_departure"><?php echo (($Stops>1)?$Stops.lang_line('STOPS'):(($Stops==0)?lang_line('NONSTOP'):$Stops.lang_line('STOP')));?></span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                    </li>
                    <li class="fs_airlinecontainer fs_book">
                      <div class="nopadd">
                        <div class="fs_airline">
                          <div class="fs_values">
                            <span class="fsa_airlinename currency"><?php echo CURR_ICON?></span>
                            <span class="fsa_airlinename amount"><?php echo $booking->amount;?></span><br>
                            <span class="fsa_departure"><?php echo lang_line('PPM');?></span>
                          </div>
                        </div>
                        <div class="spacer"></div>
                        <div class="fs_airline">
                          <div class="fs_values">
                            <button type="button"  class="btn btn-primary btn_inputs"><?php echo $booking->booking_status;?></button>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>                  
                  <!-- flight search result single End -->
                  <?php } ?>
                </li> 
              </ul>
              <div class="col-sm-12 nopadd oconcell">
                <div class="topfisconf">
                  <div class="col-md-12 nopad">
                    <div class="botufis">
                      <?php if($booking->booking_status == 'CONFIRMED'){?>
                      <a title="<?php echo lang_line('CANCEL');?>" onclick="flight_cancel_booking(this)" data-pnr="<?php echo base64_encode(base64_encode($booking->pnr_no));?>" data-placement="top" class="btn btn-gray has-tooltip" data-original-title="<?php echo lang_line('CANCEL');?>">
                        <i class="icon-off"></i><?php echo lang_line('CANCEL');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                      </a>
                      <?php }?>
                      <a title="<?php echo lang_line('MAIL_VOUCHER');?>" onclick="flight_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-secondry has-tooltip" data-original-title="<?php echo lang_line('MAIL_VOUCHER');?>">
                        <i class="icon-envelope"></i><?php echo lang_line('MAIL_VOUCHER');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                      </a>
                      <a href="<?php echo WEB_URL.'/flight/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="<?php echo lang_line('VIEW_VOUCHER');?>" data-placement="top" class="btn btn-secondry has-tooltip" data-original-title="<?php echo lang_line('VIEW_VOUCHER');?>">
                        <i class="icon-ticket"></i><?php echo lang_line('VIEW_VOUCHER');?>
                      </a>                            
                      <?php  if($booking->user_type == '3'){ ?>
                      <a title="<?php echo lang_line('MAIL_INVOICE');?>" onclick="flight_mail_uinvoice(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-secondry has-tooltip" data-original-title="<?php echo lang_line('MAIL_INVOICE');?>">
                        <i class="icon-envelope"></i><?php echo lang_line('MAIL_INVOICE');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                      </a>                             
                      <?php }  if($booking->user_type == '3'){ ?>
                      <a href="<?php echo WEB_URL.'/flight/uinvoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="<?php echo lang_line('VIEW_INVOICE');?>" data-placement="top" class="btn btn-secondry has-tooltip" data-original-title="<?php echo lang_line('VIEW_INVOICE');?>">
                        <i class="icon-ticket"></i><?php echo lang_line('VIEW_INVOICE');?>
                      </a>
                      <?php }?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </li>
            <?php }?>
            <?php }?>
            <?php 
            if($pnr_no->module == 'HOTEL'){
              $booking = $this->booking_model->getBookingbyPnr($pnr_no->pnr_no,$pnr_no->module)->row();
              ?>
              <li class="">
                <!-- hotel result rfactory start -->
                <ul class="fs_flightlist hotels bookings_hotel">
                  <li class="fs_singleflight  scroll HotelInfoBox">
                    <ul class="list-inline hotel_singlehdetails">
                      <li id="" class="hs_image">
                        <img src="<?php echo $booking->imageurl;?>" alt="Hotel Image">
                      </li>
                      <li class="fs_airlinecontainer hotel_singlehname">
                        <div class="fs_airline">

                          <div class="fs_values">
                            <span class="fsa_airlinename"><?php echo $booking->hotel_name;?></span><br>
                            <span class="fsa_departure"><?php echo $booking->city;?></span>
                          </div>
                        </div>
                        <div class="spacer"></div>
                        <div class="fs_airline">
                          <div class="fs_values">
                            <span class="fsa_airlinename"> (<?php echo $booking->room_name;?>)</span><br>
                          </div>
                        </div>
                      </li>
                      <li class="csr_incluprice">
                        <ul class="list-inline">
                          <li class="full_width"><h5><b><?php echo $booking->city;?></b> (<?php echo $booking->city_code;?>) </h5></li>
                          <li class="col-sm-6 nopadd"><?php echo lang_line('CHECKIN');?></li>
                          <li class="col-sm-6 nopadd"><?php echo date('d', strtotime($booking->checkin));?> <?php echo date('D M Y', strtotime($booking->checkin));?></li>
                          <li class="col-sm-6 nopadd"><?php echo lang_line('CHECKOUT');?></li>
                          <li class="col-sm-6 nopadd"><?php echo date('d', strtotime($booking->checkout));?> <?php echo date('D M Y', strtotime($booking->checkout));?></li>

                        </ul>
                      </li>
                      <li class="fs_airlinecontainer fs_book hotel_singlehbook">
                        <div class="fs_airline">
                          <div class="fs_values">
                            <div class="col-sm-6 nopadd">
                              <span class="fsa_airlinename">            
                                <span class="curr_icon"><?php echo CURR_ICON?></span>
                                <span class="amount"><?php echo $booking->amount;?></span>
                              </span><br>  
                              <span class="fsa_departure">2 <?php echo lang_line('NIGHTS');?></span>
                            </div>
                            <div class="col-sm-6 nopadd">
                              <span>                    
                               <input id="input-21e" value="1" type="number" class="rating hsb_starrating" min="0" max="5" step="1" data-size="xs" >  
                             </span>
                           </div>
                         </div>
                       </div>
                       <div class="spacer"></div>
                       <div class="fs_airline">
                        <div class="fs_values">
                          <button type="button" class="btn btn-primary btn_inputs" ><?php echo $booking->booking_status;?></button>
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
              <!-- hotel result rfactory end -->
              <div class="tablofcon">
                <div class="col-sm-12 nopadd oconcell">
                  <div class="topfisconf">
                   <div class="col-md-12 nopad">
                    <div class="rowfux">
                      <div class="col-md-2 nopad">
                        <div class="lablofux"><?php echo lang_line('RESERV_DATE');?></div>
                      </div>
                      <div class="col-md-2 nopad">
                        <div class="answrfux"> <?php echo date('D, d M Y', strtotime($booking->voucher_date));?></div>
                      </div>                       
                      <div class="col-md-2 nopad">
                        <div class="lablofux"><?php echo lang_line('CONF_NO');?></div>
                      </div>
                      <div class="col-md-2 nopad">
                        <div class="answrfux"> <?php echo $booking->pnr_no;?></div>
                      </div>

                      <div class="col-md-2 nopad">
                        <div class="lablofux nomarb"><?php echo lang_line('BOOKING_STATUS');?></div>
                      </div>
                      <div class="col-md-2 nopad">
                        <div class="answrfux nomarb"> <?php echo $booking->booking_status;?></div>
                      </div>
                    </div>
                  </div> 
                  <div class="col-md-12 nopad">
                   <div class="botufis">
                    <?php if($booking->booking_status == 'CONFIRMED'){?>
                    <a title="<?php echo lang_line('CANCEL');?> " onclick="hotel_cancel_booking(this)" data-pnr="<?php echo base64_encode(base64_encode($booking->pnr_no));?>" data-placement="top" class="btn btn-gray has-tooltip" data-original-title="<?php echo lang_line('CANCEL');?>">
                      <i class="icon-off"></i><?php echo lang_line('CANCEL');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                    </a>
                    <?php }?>                      
                    <?php   if($booking->user_type == '3'){ ?>
                    <a title="<?php echo lang_line('MAIL_INVOICE');?>" onclick="hotel_mail_invoice(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-secondry has-tooltip" data-original-title="<?php echo lang_line('MAIL_INVOICE');?>">
                      <i class="icon-envelope"></i><?php echo lang_line('MAIL_INVOICE');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                    </a>                       
                    <?php }  if($booking->user_type == '3'){ ?>
                    <a href="<?php echo WEB_URL.'/hotel/uinvoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="<?php echo lang_line('VIEW_INVOICE');?>" data-placement="top" class="btn btn-secondry has-tooltip" data-original-title="<?php echo lang_line('VIEW_INVOICE');?>">
                      <i class="icon-ticket"></i><?php echo lang_line('VIEW_INVOICE');?>
                    </a>
                    <?php }?>
                    <a title="<?php echo lang_line('MAIL_VOUCHER');?>" onclick="hotel_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-secondry has-tooltip" data-original-title="<?php echo lang_line('MAIL_VOUCHER');?>">
                      <i class="icon-envelope"></i><?php echo lang_line('MAIL_VOUCHER');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                    </a>
                    <a href="<?php echo WEB_URL.'/hotel/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="<?php echo lang_line('VIEW_VOUCHER');?>" data-placement="top" class="btn btn-secondry has-tooltip" data-original-title="<?php echo lang_line('VIEW_VOUCHER');?>">

                      <i class="icon-ticket"></i><?php echo lang_line('VIEW_VOUCHER');?>
                    </a>                        
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </li>
        <?php } ?>
        <?php  if($pnr_no->module == 'CAR'){
          $booking = $this->booking_model->getBookingbyPnr($pnr_no->pnr_no,$pnr_no->module)->row();
          $car = json_decode(base64_decode($booking->response));
          ?>
          <li class="">
            <ul class="fs_flightlist hotels bookings_hotel">  
              <li class="fs_singleflight  scroll HotelInfoBox" >
                <ul class="list-inline hotel_singlehdetails hotel_searchdetails">
                  <li class="hs_image">
                    <?php echo $this->car_model->get_vendor_details($car->VendorCode);?> <?php echo $car->Category;?>           <img src="<?php echo $booking->CarImage;?>" id="CC543540" alt="Car Image">
                  </li>
                  <li class="csr_incluprice">
                    <ul class="list-inline">
                      <li class="full_width"><h5><b><?php echo $booking->pickupCityName;?></b> (<?php echo $car->PickupLocation;?>) - <b><?php echo $booking->dropoffCityName;?></b> (<?php echo $car->ReturnLocation;?>)</h5></li>
                      <li class="col-sm-6 nopadd"><?php echo lang_line('PICK_UP');?></li>
                      <li class="col-sm-6 nopadd"><?php echo date('d M, D Y', $this->flight_model->get_unixtimestamp($car->PickupDateTime));?> (<?php echo date('H:i', $this->flight_model->get_unixtimestamp($car->PickupDateTime));?>)</li>
                      <li class="col-sm-6 nopadd"><?php echo lang_line('DROP_OFF');?></li>
                      <li class="col-sm-6 nopadd"><?php echo date('d M, D Y', $this->flight_model->get_unixtimestamp($car->ReturnDateTime));?> (<?php echo date('H:i', $this->flight_model->get_unixtimestamp($car->ReturnDateTime));?>)</li>
                      <li class="col-sm-6 nopadd"><?php echo lang_line('VEHICLE_CLASS');?></li>
                      <li class="col-sm-6 nopadd"><?php echo $car->VehicleClass;?></li>                  
                    </ul>
                  </li>
                  <li class="fs_airlinecontainer fs_book hotel_singlehbook car_singlehbook">
                    <div class="fs_airline">
                      <div class="fs_values">
                        <div class="col-sm-12 nopadd">
                          <span class="fsa_airlinename ">  
                            <span class="curr_icon"><?php echo CURR_ICON?></span>
                            <span class="amount"><?php echo $booking->amount;?></span> 
                            <div class="fsaa_wamount"><?php echo lang_line('WHOLE_AMOUNT');?></div>
                          </span> 
                          <button type="button" class="btn btn-primary btn_inputs" ><?php echo $booking->booking_status;?></button>
                        </div>           
                      </div>
                    </div>        
                  </li>     
                </ul>
              </li>
            </ul>
            <div class="tablofcon">
              <div class="col-sm-12 nopadd oconcell">
                <div class="topfisconf">
                  <div class="col-md-12 nopad">
                    <div class="rowfux">
                      <div class="col-md-2 nopad">
                        <div class="lablofux"><?php echo lang_line('RESERV_DATE');?></div>
                      </div>
                      <div class="col-md-2 nopad">
                        <div class="answrfux"> <?php echo date('D, d M Y', strtotime($booking->voucher_date));?></div>
                      </div>
                      <div class="col-md-2 nopad">
                        <div class="lablofux"><?php echo lang_line('CONF_NO');?></div>
                      </div>
                      <div class="col-md-2 nopad">
                        <div class="answrfux"> <?php echo $booking->pnr_no;?></div>
                      </div>

                      <div class="col-md-2 nopad">
                        <div class="lablofux nomarb"><?php echo lang_line('BOOKING_STATUS');?></div>
                      </div>
                      <div class="col-md-2 nopad">
                        <div class="answrfux nomarb"> <?php echo $booking->booking_status;?></div>
                      </div>
                    </div> 
                  </div> 
                  <div class="col-md-12 nopad">
                    <div class="botufis">
                     <?php if($booking->booking_status == 'CONFIRMED'){?>
                     <a title="<?php echo lang_line('CANCEL');?>" onclick="car_cancel_booking(this)" data-pnr="<?php echo base64_encode(base64_encode($booking->pnr_no));?>" data-placement="top" class="btn btn-gray has-tooltip" data-original-title="<?php echo lang_line('CANCEL');?>">
                      <i class="icon-off"></i><?php echo lang_line('CANCEL');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                    </a>
                    <?php }?>
                    <a title="<?php echo lang_line('MAIL_VOUCHER');?>" onclick="car_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-secondry has-tooltip" data-original-title="<?php echo lang_line('MAIL_VOUCHER');?>">
                      <i class="icon-envelope"></i><?php echo lang_line('MAIL_VOUCHER');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                    </a>
                    <a href="<?php echo WEB_URL.'/car/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="<?php echo lang_line('VIEW_VOUCHER');?>" data-placement="top" class="btn btn-secondry has-tooltip" data-original-title="<?php echo lang_line('VIEW_VOUCHER');?>">
                      <i class="icon-ticket"></i><?php echo lang_line('VIEW_VOUCHER');?>
                    </a>
                    <a title="<?php echo lang_line('MAIL_INVOICE');?>" onclick="car_mail_invoice(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-secondry has-tooltip" data-original-title="<?php echo lang_line('MAIL_INVOICE');?>">
                      <i class="icon-envelope"></i><?php echo lang_line('MAIL_INVOICE');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                    </a>                              
                    <a href="<?php echo WEB_URL.'/car/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="<?php echo lang_line('VIEW_INVOICE');?>" data-placement="top" class="btn btn-secondry has-tooltip" data-original-title="<?php echo lang_line('VIEW_INVOICE');?>">
                      <i class="icon-ticket"></i><?php echo lang_line('VIEW_INVOICE');?>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </li>
        <?php }?>
        <?php }?>        
        <?php } else { ?>
        <div class="col-md-12" style="margin: 0 auto; text-align: center;">
          <div class="srywrap"><span class="sorrydiv"><img src="<?php echo WEB_URL; ?>/assets/images/sorry.png" alt="" /></span><b><?php echo lang_line('NOTHING_HERE');?></b></div>
        </div>
        <?php } ?>                  
      </ul>
    </div>
    <div class="holdereBookings"></div>
  </div>
</div>
<!-- END OF TAB 2 --> 
<script type="text/javascript">
/*$(document).ready(function() {
  if($(window).width() < 450){
   $("div.holdereBookings").proPages({
    containerID: 'user_bookings',
    perPage: 3,
    keyBrowse: true,
    scrollBrowse: false,
    midRange    : 2,
    callback: function (pages,items) {
      if(items.count > 3) {
        $("#legend1").html("Page " + pages.current + " of " + pages.count);
        $("#legend2").html("Elements "+items.range.start + " - " + items.range.end + " of " + items.count);
      } else {
        $("div.holdereBookings").html('');
      }
    }
  });
 }
 else{ BookingPagination();}
});

function BookingPagination(){ 
  $("div.holdereBookings").proPages({
    containerID: 'user_bookings',
    perPage: 3,
    keyBrowse: true,
    scrollBrowse: false,
    callback: function (pages,items) {
      if(items.count > 3) {
        $("#legend1").html("Page " + pages.current + " of " + pages.count);
        $("#legend2").html("Elements "+items.range.start + " - " + items.range.end + " of " + items.count);
      } else {
        $("div.holdereBookings").html('');
      }
    }
  });
}*/
</script>