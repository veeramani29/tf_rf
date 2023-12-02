      <!-- TAB 2 -->
      <div class="tab-pane <?php if(!empty($page_type) && $page_type == "bookings") {echo "active";} ?>" id="bookings">
        <div class="padding20">
          <!-- <div class="col-md-4 offset-0"> <span class="dark size18">Places</span>
            <div class="line4"></div>
            <ul class="blogcat">
              <li><a href="#">Rome</a> <span class="badge indent0">3</span></li>
              <li><a href="#">Malaga</a> <span class="badge indent0">1</span></li>
              <li><a href="#">Marbella</a> <span class="badge indent0">1</span></li>
              <li><a href="#">Gibraltar</a> <span class="badge indent0">1</span></li>
              <li><a href="#">Zakynthos</a> <span class="badge indent0">2</span></li>
              <li><a href="#">Thasos</a> <span class="badge indent0">1</span></li>
              <li><a href="#">Santorini</a> <span class="badge indent0">1</span></li>
              <li><a href="#">Golden Sands</a> <span class="badge indent0">1</span></li>
              <li><a href="#">Sunny Beach</a> <span class="badge indent0">1</span></li>
            </ul>
          </div>
          <div class="col-md-4 offset-0"> <span class="dark size18">Trips</span>
            <div class="line4"></div>
            <ul class="blogcat">
              <li><a href="#">Italy</a> <span class="badge indent0">2</span></li>
              <li><a href="#">England</a> <span class="badge indent0">1</span></li>
              <li><a href="#">Greece</a> <span class="badge indent0">2</span></li>
              <li><a href="#">Spain</a> <span class="badge indent0">1</span></li>
              <li><a href="#">Bulgary</a> <span class="badge indent0">1</span></li>
            </ul>
          </div>
          <div class="col-md-4 offset-0"> <span class="dark size18">Countries</span>
            <div class="line4"></div>
            <ul class="blogcat">
              <li><img src="<?php // echo ASSETS;?>images/flags/IT.png" class="right" alt=""/><a href="#">Italy</a></li>
              <li><img src="<?php // echo ASSETS;?>images/flags/GB.png" class="right" alt=""/><a href="#">England</a></li>
              <li><img src="<?php // echo ASSETS;?>images/flags/GR.png" class="right" alt=""/><a href="#">Greece</a></li>
              <li><img src="<?php // echo ASSETS;?>images/flags/ES.png" class="right" alt=""/><a href="#">Spain</a></li>
              <li><img src="<?php // echo ASSETS;?>images/flags/BG.png" class="right" alt=""/><a href="#">Bulgary</a></li>
            </ul>
          </div>
          <div class="clearfix"></div> -->
         <!--  <br/>
          <br/>
          <br/> -->
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
          <div class="table table-bordered senstabl">
            <div class="grey sanscol">
              <div class="center colbt"><span class="size30 slim lh4 dark"><?php if(isset($trips_count)) { echo $trips_count; } else { echo 0; } ?></span><br/>
                <span class="size12"><?=lang('Trips');?></span></div>
              <div class="center colbt"><span class="size30 slim lh4 dark"><?php echo $confirmed_count;?></span><br/>
                <span class="size12"><?=lang('Confirmed');?></span></div>
              <div class="center colbt"><span class="size30 slim lh4 dark"><?php echo $pending_count;?></span><br/>
                <span class="size12"><?=lang('Pending');?></span></div>
              <div class="center colbt"><span class="size30 slim lh4 dark"><?php echo $cancelled_count;?></span><br/>
                <span class="size12"><?=lang('Cancelled');?></span></div>
               <div class="center colbt"><span class="size30 slim lh4 dark"><?php echo $failed_count;?></span><br/>
                <span class="size12"><?=lang('Failed');?></span></div>
            </div>
          </div>

          <div class="clear"></div>
          <div class="twohedbacbuk">
          <span class="dark size18"><?=lang('My bookings');?></span>
          
          
          
          
          
          </div>
          <div class="clear"></div>
          
          
          <div class="rowitbk left">
            <ul id="user_bookings">
<?php 
    if(!empty($pnr_nos)){
      foreach($pnr_nos as $pnr_no){
?>
        <?php 
          if($pnr_no->module == 'APARTMENT'){
            $booking = $this->booking_model->getBookingbyPnr($pnr_no->pnr_no,$pnr_no->module)->row();
            $Images = $this->apartment_model->getApartmentImages($booking->PROP_ID)->result();
        ?>
                  <li class="bookingli">
                    <div class="bookingicon <?php echo 'p_'.strtolower($booking->module);?>"></div>
                    <div class="col-md-2 offset-0"> 
                      <a class="fullpikr" href="<?php echo WEB_URL.'/apartment/rooms/'.$booking->PROP_ID;?>">
                        <?php if(count($Images) > 0){ foreach($Images as $image){ if($image->PHOTO_CONTENT != ''){ $img = $this->apartment_model->view_property_file($image->PHOTO_CONTENT); ?> 
                        <img src="<?php echo $img;?>" alt="" />
                        <?php }break;}}?>
                      </a> 
                    </div>
                    <div class="col-md-10 nopad">
                            <div class="topfis">
                            <div class="col-md-3">

                                <div class="fiscal">
                                    <div class="lablofuxhed">Check In</div>
                                    <div class="answrfuxdes">
                                        <span class="dvasam"><?php echo date('d', strtotime($booking->RES_CHECK_IN));?></span>
                                        <span class="varsham"><?php echo date('D M Y', strtotime($booking->RES_CHECK_IN));?></span>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="col-md-3">

                                <div class="fiscal">
                                    <div class="lablofuxhed">Check Out</div>
                                    <div class="answrfuxdes">
                                        <span class="dvasam"><?php echo date('d', strtotime($booking->RES_CHECK_OUT));?></span>
                                        <span class="varsham"><?php echo date('D M Y', strtotime($booking->RES_CHECK_OUT));?></span>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="col-md-6 nopad">
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux">Reservation Date</div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux"> <?php echo date('D, d M Y', strtotime($booking->voucher_date));?></div>
                                    </div>
                                </div>
                                
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux">Confirmation No</div>
                                     </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux"> <?php echo $booking->pnr_no;?></div>
                                    </div>
                                </div>
                                
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux nomarb">Booking Status</div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux nomarb"> <?php echo $booking->booking_status;?></div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            </div>
                      <!--<span class="grey">Reservation Date: <?php echo date('D, d M, Y', strtotime($booking->voucher_date));?></span> -->
                    </div>
                    <!--<div class="col-md-1 offset-0">
                      <button type="submit" class="btn-search5 right">More</button>
                    </div>-->
                    <div class="clearfix"></div>
                    
                    
                    <div class="col-md-6 nopad">
                        <div class="flikrall">
                      <a class="dark flikrdesc" href="<?php echo WEB_URL.'/apartment/rooms/'.$booking->PROP_ID;?>"><?php echo $booking->PROP_NAME;?></a> 
                      <span class="grayish size12"><?php echo $booking->PROP_CITY;?> - <?php echo $booking->COUNTRY_NAME;?></span><br>
                      <span class="green bold size20"><?php echo CURR_ICON?><?php echo $booking->amount;?></span> 
                      </div>
                    </div>
                    
                    <div class="col-md-6 nopad">
                        <div class="botufis">
                              <a title="Mail invoice" onclick="mail_uinvoice(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip tooltiph" data-original-title="Mail Invoice">
                                  <i class="icon-envelope"></i>Mail invoice <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                </a>
                              <a href="<?php echo WEB_URL.'/apartment/uinvoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="View Invoice" data-placement="top" class="btn btn-primary btn-xs tooltiph" >
                                <i class="icon-tags"></i>View invoice
                              </a>
                                    
                               <a title="Mail voucher" onclick="mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip tooltiph" data-original-title="Mail Voucher">
                                  <i class="icon-envelope"></i>Mail voucher <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                </a>
                                
                                <a href="<?php echo WEB_URL.'/apartment/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="View voucher" data-placement="top" class="btn btn-primary btn-xs has-tooltip tooltiph" data-original-title="View Voucher">
                                    <i class="icon-ticket"></i>View voucher
                                </a>
                             
                            </div>
                    </div>

                  </li>
        <?php }?>
        <?php 
          if($pnr_no->module == 'FLIGHT'){
            $booking = $this->booking_model->getBookingbyPnr($pnr_no->pnr_no,$pnr_no->module)->row();
            if(is_object($booking)){
            $request = json_decode(base64_decode($booking->request));
              if($request->type == 'O'){  
                $flight = json_decode(base64_decode($booking->response));
                $first_seg = reset($flight->segments);
                $last_seg = end($flight->segments);
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
                  <li class="bookingli">
                    <div class="bookingicon <?php echo 'p_'.strtolower($booking->module);?>"></div>
                    
                    <div class="tablofcon">
                    <div class="col-md-7 concell"> 
                        <div class="onwyrow">
                            <div class="fblueline22 linegreen">
                                <b><?php echo $fromCityName;?></b> (<?php echo $first_seg->Origin;?>) 
                                <span class="farrow"></span> 
                                <b><?php echo $toCityName;?></b> (<?php echo $first_seg->Destination;?>)
                            </div>
                            <div class="col-md-2">
                                <div class="flitsecimg">
                                    <img alt="" id="FF219160" src="<?php echo ASSETS;?>images/airline_logo/<?php echo $first_seg->Carrier;?>.gif">
                                    <span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($first_seg->Carrier);?></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="radiobtn rittextalign"><?=lang('DEPARTURE');?></div>
                                <span class="norto rittextalign"><?php echo date('d M, D Y', $DepartureDateTime);?></span>
                                <span class="norto lbold rittextalign"><?php echo date('H:i', $DepartureDateTime);?></span>
                            </div>
                            <div class="col-md-1 nopad">
                                <div class="flightimgs">
                                    <img alt="" src="<?php echo ASSETS;?>images/departure.png">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <span class="radiobtn"><?=lang('ARRIVAL');?></span>
                                <span class="norto"><?php echo date('d M, D Y', $ArrivalDateTime);?></span>
                                <span class="norto lbold"><?php echo date('H:i', $ArrivalDateTime);?></span>
                            </div>
                            <div class="col-md-3 nopad">
                                <span class="radiobtn"><?=lang('DURATION');?></span>
                                <span class="norto"><?=lang('ECONOMY');?></span>
                                <span class="norto lbold"><?php echo $dur;?></span>
                            </div>
                        </div>  
                    </div>
                    
                    <div class="col-md-5 offset-0 concell litgrycell">
                            <div class="topfisconf">
                            
                            <div class="col-md-12 nopad">
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux"><?=lang('Reservation Date');?></div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux"> <?php echo date('D, d M Y', strtotime($booking->voucher_date));?></div>
                                    </div>
                                </div>
                                
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux"><?=lang('Confirmation No');?></div>
                                     </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux"> <?php echo $booking->pnr_no;?></div>
                                    </div>
                                </div>
                                
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux nomarb"><?=lang('Booking Status');?></div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux nomarb"> <?php echo $booking->booking_status;?></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 nopad">
                        <div class="botufis">

                              <?php if($booking->booking_status == 'CONFIRMED'){?>
                                <a title="<?=lang('Cancel Booking');?>" onclick="flight_cancel_request(this)" data-pnr="<?php echo base64_encode(base64_encode($booking->pnr_no));?>" data-placement="top" class="btn btn-danger btn-xs has-tooltip" data-original-title="<?=lang('Cancel Booking');?>">
                                  <i class="icon-off"></i><?=lang('Cancel');?> Or Change <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                </a>
                              <?php }?>

                               <a title="<?=lang('Mail voucher');?>" onclick="flight_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="<?=lang('Mail voucher');?>">
                                  <i class="icon-envelope"></i><?=lang('Mail voucher');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                </a>
                               <a href="<?php echo WEB_URL.'/flight/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="<?=lang('View voucher');?>" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="<?=lang('View voucher');?>">
                                    <i class="icon-ticket"></i><?=lang('View voucher');?>
                                </a>
                              <?php if($booking->user_type == '2'){ ?>
                                  <a title="<?=lang('Mail invoice');?>" onclick="flight_mail_invoice(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="<?=lang('Mail invoice');?>">
                                      <i class="icon-envelope"></i><?=lang('Mail invoice');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                  </a>
                              <?php } else if($booking->user_type == '3'){ ?>
                                  <a title="<?=lang('Mail invoice');?>" onclick="flight_mail_uinvoice(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="<?=lang('Mail invoice');?>">
                                      <i class="icon-envelope"></i><?=lang('Mail invoice');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                  </a>
                              <?php }?>
                              <?php if($booking->user_type == '2'){ ?>
                                   <a href="<?php echo WEB_URL.'/flight/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="<?=lang('View Invoice');?>" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="<?=lang('View Invoice');?>">
                                    <i class="icon-ticket"></i><?=lang('View Invoice');?>
                                  </a>
                                <?php } else if($booking->user_type == '3'){ ?>
                                  <a href="<?php echo WEB_URL.'/flight/uinvoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="<?=lang('View Invoice');?>" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="<?=lang('View Invoice');?>">
                                    <i class="icon-ticket"></i><?=lang('View Invoice');?>
                                  </a>
                              <?php }?>
                              

                                <a class="left">
                                  <span class="green bold size20"><?php echo CURR_ICON?><?php echo $booking->amount;?></span> 
                                  </a>
                                
                         </div>

                    </div>
                            </div>
                     
                    </div>
                    
                    </div>
                    <!--<div class="col-md-1 offset-0">
                      <button type="submit" class="btn-search5 right">More</button>
                    </div>-->
                    <div class="clearfix"></div>
                  </li>
            <?php 
              }else if ($request->type == 'R') {
                $flight = json_decode(base64_decode($booking->response));
                $onward_first_seg = reset($flight->onward->segments);
                $onward_last_seg = end($flight->onward->segments);
                $return_first_seg = reset($flight->return->segments);
                $return_last_seg = end($flight->return->segments);
                $onward_fromCityName =  $this->flight_model->get_airport_cityname($onward_first_seg->Origin);
                $onward_toCityName =  $this->flight_model->get_airport_cityname($onward_last_seg->Destination);

                $return_fromCityName =  $this->flight_model->get_airport_cityname($return_first_seg->Origin);
                $return_toCityName =  $this->flight_model->get_airport_cityname($return_last_seg->Destination);

                $onward_DepartureDateTime = $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime);
                $onward_ArrivalDateTime = $this->flight_model->get_unixtimestamp($onward_first_seg->ArrivalTime);

                $return_DepartureDateTime = $this->flight_model->get_unixtimestamp($return_first_seg->DepartureTime);
                $return_ArrivalDateTime = $this->flight_model->get_unixtimestamp($return_first_seg->ArrivalTime);
            ?>
                  <li class="bookingli">
                    <div class="bookingicon <?php echo 'p_'.strtolower($booking->module);?>"></div>
                    
                    <div class="tablofcon">
                    <div class="col-md-7 concell"> 
                        <div class="onwyrow">
                        <div class="fblueline22 linegreen">
                             <b><?php echo $onward_fromCityName;?></b> (<?php echo $onward_first_seg->Origin;?>) 
                             <span class="farrow"></span> 
                             <b><?php echo $onward_toCityName;?></b> (<?php echo $onward_last_seg->Destination;?>)
                        </div>
                        <div class="col-md-2">
                            <div class="flitsecimg">
                                <img alt="" id="FF219160" src="<?php echo ASSETS;?>images/airline_logo/<?php echo $onward_first_seg->Carrier;?>.gif">
                                <span class="nortosimle textcentr">Air India</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="radiobtn rittextalign"><?=lang('DEPARTURE');?></div>
                            <span class="norto rittextalign"><?php echo date('d M, D Y', $onward_DepartureDateTime);?></span>
                            <span class="norto lbold rittextalign"><?php echo date('H:i', $onward_DepartureDateTime);?></span>
                        </div>
                        <div class="col-md-1 nopad">
                            <div class="flightimgs">
                                <img alt="" src="<?php echo ASSETS;?>images/departure.png">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <span class="radiobtn"><?=lang('ARRIVAL');?></span>
                            <span class="norto"><?php echo date('d M, D Y', $onward_ArrivalDateTime);?></span>
                            <span class="norto lbold"><?php echo date('H:i', $onward_ArrivalDateTime);?></span>
                        </div>
                        <div class="col-md-3 nopad">
                            <span class="radiobtn"><?=lang('DURATION');?></span>
                            <span class="norto"><?=lang('ECONOMY');?></span>
                            <span class="norto lbold"><?php //echo $dur;?></span>
                        </div>
                    </div>  
                        
                        <div class="onwyrow">
                        <div class="fblueline22 linegreen">
                             <b><?php echo $return_fromCityName;?></b> (<?php echo $return_first_seg->Origin;?>) 
                             <span class="farrow"></span> 
                             <b><?php echo $return_toCityName;?></b> (<?php echo $return_last_seg->Destination;?>)
                        </div>
                        <div class="col-md-2">
                            <div class="flitsecimg">
                                <img alt="" id="FF219160" src="<?php echo ASSETS;?>images/airline_logo/<?php echo $return_first_seg->Carrier;?>.gif">
                                <span class="nortosimle textcentr">Air India</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="radiobtn rittextalign"><?=lang('DEPARTURE');?></div>
                            <span class="norto rittextalign"><?php echo date('d M, D Y', $return_DepartureDateTime);?></span>
                            <span class="norto lbold rittextalign"><?php echo date('H:i', $return_DepartureDateTime);?></span>
                        </div>
                        <div class="col-md-1 nopad">
                            <div class="flightimgs">
                                <img alt="" src="<?php echo ASSETS;?>images/departure.png">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <span class="radiobtn"><?=lang('ARRIVAL');?></span>
                            <span class="norto"><?php echo date('d M, D Y', $return_ArrivalDateTime);?></span>
                            <span class="norto lbold"><?php echo date('H:i', $return_ArrivalDateTime);?></span>
                        </div>
                        <div class="col-md-3 nopad">
                            <span class="radiobtn"><?=lang('DURATION')?></span>
                            <span class="norto"><?=lang('ECONOMY');?></span>
                            <span class="norto lbold"><?php //echo $dur;?></span>
                        </div>
                    </div>
                                                   
                    </div>
                    
                    <div class="col-md-5 offset-0 concell litgrycell">
                            <div class="topfisconf">
                            
                            <div class="col-md-12 nopad">
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux"><?=lang('Reservation Date');?></div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux"> <?php echo date('D, d M Y', strtotime($booking->voucher_date));?></div>
                                    </div>
                                </div>
                                
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux"><?=lang('Confirmation No');?></div>
                                     </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux"> <?php echo $booking->pnr_no;?></div>
                                    </div>
                                </div>
                                
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux nomarb"><?=lang('Booking Status');?></div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux nomarb"> <?php echo $booking->booking_status;?></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 nopad">
                        <div class="botufis">
                              <?php if($booking->booking_status == 'CONFIRMED'){?>
                                <a title="<?=lang('Cancel Booking');?>" onclick="flight_cancel_request(this)" data-pnr="<?php echo base64_encode(base64_encode($booking->pnr_no));?>" data-placement="top" class="btn btn-danger btn-xs has-tooltip" data-original-title="<?=lang('Cancel Booking');?>">
                                  <i class="icon-off"></i><?=lang('Cancel');?> Or Change <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                </a>
                              <?php }?>
                               <a title="<?=lang('Mail voucher');?>" onclick="flight_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="<?=lang('Mail voucher');?>">
                                          <i class="icon-envelope"></i><?=lang('Mail voucher');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                        </a>
                                
                                <a href="<?php echo WEB_URL.'/flight/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="<?=lang('View voucher');?>" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="<?=lang('View voucher');?>">
                                    <i class="icon-ticket"></i><?=lang('View voucher');?>
                                </a>
                                <?php if($booking->user_type == '2'){ ?>
                                  <a title="<?=lang('Mail invoice');?>" onclick="flight_mail_invoice(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="<?=lang('Mail invoice');?>">
                                      <i class="icon-envelope"></i><?=lang('Mail invoice');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                  </a>
                              <?php } else if($booking->user_type == '3'){ ?>
                                  <a title="<?=lang('Mail invoice');?>" onclick="flight_mail_uinvoice(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="<?=lang('Mail invoice');?>">
                                      <i class="icon-envelope"></i><?=lang('Mail invoice');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                  </a>
                              <?php }?>
                              <?php if($booking->user_type == '2'){ ?>
                                   <a href="<?php echo WEB_URL.'/flight/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="<?=lang('View Invoice');?>" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="<?=lang('View Invoice');?>">
                                    <i class="icon-ticket"></i><?=lang('View Invoice');?>
                                  </a>
                                <?php } else if($booking->user_type == '3'){ ?>
                                  <a href="<?php echo WEB_URL.'/flight/uinvoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="<?=lang('View Invoice');?>" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="<?=lang('View Invoice');?>">
                                    <i class="icon-ticket"></i><?=lang('View Invoice');?>
                                  </a>
                              <?php }?>
                                <a class="left">
                                  <span class="green bold size20"><?php echo CURR_ICON?><?php echo $booking->amount;?></span> 
                                  </a>
                                
                         </div>
                    </div>
                            </div>
                     
                    </div>
                    
                    </div>
                    <!--<div class="col-md-1 offset-0">
                      <button type="submit" class="btn-search5 right">More</button>
                    </div>-->
                    <div class="clearfix"></div>
                  </li>
                  
            <?php 
              }else if($request->type=='M') { 
              $flight = json_decode(base64_decode($booking->response));
            ?>
                  <li class="bookingli">
                    <div class="bookingicon <?php echo 'p_'.strtolower($booking->module);?>"></div>
                    
                    <div class="tablofcon">
                    
                    <div class="clear"></div>
                    <div class="col-md-7 concell"> 

                    <?php foreach($flight->segments as $k) { 
                        if(is_array($k)){
							$onward_first_seg = reset($k);
							$onward_last_seg = end($k);
							$Stops = count($k)-1;
						$dur = $this->flight_model->get_duration(strtotime($onward_first_seg->DepartureTime),strtotime($onward_last_seg->ArrivalTime));
								}else{
									
						$onward_first_seg = $k;
						$onward_last_seg = $k;
						$Stops = count($k)-1;
						$dur = $this->flight_model->get_duration(strtotime($onward_first_seg->DepartureTime),strtotime($onward_last_seg->ArrivalTime));
						
								}
                    ?>

                         <div class="onwyrow">
                            <div class="fblueline22 linegreen">
								
                                <b><?php echo $this->flight_model->get_airport_cityname($onward_first_seg->Origin).' </b>('.$onward_first_seg->Origin.')';?> 
                                <span class="farrow"></span> 
                                 <b><?php echo $this->flight_model->get_airport_cityname($onward_last_seg->Destination).' </b>('.$onward_last_seg->Destination.')';?> 
                            </div>
                            <div class="col-md-2">
                                <div class="flitsecimg">
                                    <img alt="" id="FF219160" src="<?php echo ASSETS;?>images/airline_logo/<?php echo $onward_first_seg->Carrier;?>.gif">
                                    <span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($onward_first_seg->Carrier);?></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="radiobtn rittextalign"><?=lang('DEPARTURE');?></div>
                                <span class="norto rittextalign"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime));?></span>
                                <span class="norto lbold rittextalign"><?php echo date('H:i', $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime));?></span>
                            </div>
                            <div class="col-md-1 nopad">
                                <div class="flightimgs">
                                    <img alt="" src="<?php echo ASSETS;?>images/departure.png">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <span class="radiobtn"><?=lang('ARRIVAL');?></span>
                                <span class="norto"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($onward_last_seg->ArrivalTime));?></span>
                                <span class="norto lbold"><?php echo date('H:i', $this->flight_model->get_unixtimestamp($onward_last_seg->ArrivalTime));?></span>
                            </div>
                            <div class="col-md-3 nopad">
                                <span class="radiobtn"><?=lang('DURATION');?></span>
                                <span class="norto"><?=lang('ECONOMY');?></span>
                                <span class="norto lbold"><?php echo $dur;?></span>
                            </div>
                        </div>  
                    <?php } ?>

                    </div>

                    
                    
                    <div class="col-md-5 offset-0 concell litgrycell">
                            <div class="topfisconf">
                            
                            <div class="col-md-12 nopad">
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux"><?=lang('Reservation Date');?></div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux"> <?php echo date('D, d M Y', strtotime($booking->voucher_date));?></div>
                                    </div>
                                </div>
                                
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux"><?=lang('Confirmation No');?></div>
                                     </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux"> <?php echo $booking->pnr_no;?></div>
                                    </div>
                                </div>
                                
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux nomarb"><?=lang('Booking Status');?></div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux nomarb"> <?php echo $booking->booking_status;?></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 nopad">
                        <div class="botufis">
                              <?php if($booking->booking_status == 'CONFIRMED'){?>
                                <a title="<?=lang('Cancel Booking');?>" onclick="flight_cancel_request(this)" data-pnr="<?php echo base64_encode(base64_encode($booking->pnr_no));?>" data-placement="top" class="btn btn-danger btn-xs has-tooltip" data-original-title="<?=lang('Cancel Booking');?>">
                                  <i class="icon-off"></i><?=lang('Cancel');?> Or Change <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                </a>
                              <?php }?>
                               <a title="<?=lang('Mail voucher');?>" onclick="flight_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="<?=lang('Mail voucher');?>">
                                  <i class="icon-envelope"></i><?=lang('Mail voucher');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                </a>
                                
                                <a href="<?php echo WEB_URL.'/flight/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="<?=lang('View voucher');?>" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="<?=lang('View voucher');?>">
                                    <i class="icon-ticket"></i><?=lang('View voucher');?>
                                </a>
                                <?php if($booking->user_type == '2'){ ?>
                                  <a title="<?=lang('Mail invoice');?>" onclick="flight_mail_invoice(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="<?=lang('Mail invoice');?>">
                                      <i class="icon-envelope"></i><?=lang('Mail invoice');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                  </a>
                              <?php } else if($booking->user_type == '3'){ ?>
                                  <a title="<?=lang('Mail invoice');?>" onclick="flight_mail_uinvoice(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="<?=lang('Mail invoice');?>">
                                      <i class="icon-envelope"></i><?=lang('Mail invoice');?> <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                  </a>
                              <?php }?>
                              <?php if($booking->user_type == '2'){ ?>
                                   <a href="<?php echo WEB_URL.'/flight/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="<?=lang('View Invoice');?>" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="<?=lang('View Invoice');?>">
                                    <i class="icon-ticket"></i><?=lang('View Invoice');?>
                                  </a>
                                <?php } else if($booking->user_type == '3'){ ?>
                                  <a href="<?php echo WEB_URL.'/flight/uinvoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="<?=lang('View Invoice');?>" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="<?=lang('View Invoice');?>">
                                    <i class="icon-ticket"></i><?=lang('View Invoice');?>
                                  </a>
                              <?php }?>
                                <a class="left">
                                  <span class="green bold size20"><?php echo CURR_ICON?><?php echo $booking->amount;?></span> 
                                  </a>
                                
                         </div>

                    </div>
                            </div>
                     
                    </div>
                    
                    </div>
                    <!--<div class="col-md-1 offset-0">
                      <button type="submit" class="btn-search5 right">More</button>
                    </div>-->
                    <div class="clearfix"></div>
                  </li>



            <?php }?>
       		<?php }?>
        <?php }?>
        <?php 
          if($pnr_no->module == 'HOTEL'){
            $booking = $this->booking_model->getBookingbyPnr($pnr_no->pnr_no,$pnr_no->module)->row();
        ?>
                  <li class="bookingli">
                    <div class="bookingicon <?php echo 'p_'.strtolower($booking->module);?>"></div>
                    <div class="col-md-2 offset-0"> 
                      <a class="fullpikr" href="#"><img src="<?php echo $booking->imageurl;?>" alt="" /></a> 
                    </div>
                    <div class="col-md-10 nopad">
                            <div class="topfis">
                            <div class="col-md-3">

                                <div class="fiscal">
                                    <div class="lablofuxhed">Check In</div>
                                    <div class="answrfuxdes">
                                        <span class="dvasam"><?php echo date('d', strtotime($booking->checkin));?></span>
                                        <span class="varsham"><?php echo date('D M Y', strtotime($booking->checkin));?></span>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="col-md-3">

                                <div class="fiscal">
                                    <div class="lablofuxhed">Check Out</div>
                                    <div class="answrfuxdes">
                                        <span class="dvasam"><?php echo date('d', strtotime($booking->checkout));?></span>
                                        <span class="varsham"><?php echo date('D M Y', strtotime($booking->checkout));?></span>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="col-md-6 nopad">
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux">Reservation Date</div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux"> <?php echo date('D, d M Y', strtotime($booking->voucher_date));?></div>
                                    </div>
                                </div>
                                
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux">Confirmation No</div>
                                     </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux"> <?php echo $booking->pnr_no;?></div>
                                    </div>
                                </div>
                                
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux nomarb">Booking Status</div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux nomarb"> <?php echo $booking->booking_status;?></div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            </div>
                     
                    </div>
                    <!--<div class="col-md-1 offset-0">
                      <button type="submit" class="btn-search5 right">More</button>
                    </div>-->
                    <div class="clearfix"></div>
                    
                    <div class="col-md-6 nopad">
                        <div class="flikrall">
                      <span class="grayish size12"><?php echo $booking->hotel_name;?> (<?php echo $booking->room_name;?>) -</span>
                      <span class="grayish size12"><?php echo $booking->city;?></span>
                      <br>
                      <span class="green bold size20"><?php echo CURR_ICON?><?php echo $booking->amount;?></span> 
                      </div>
                    </div>
                    
                    <div class="col-md-6 nopad">
                        <div class="botufis">
                              <?php if($booking->booking_status == 'CONFIRMED'){?>
                                <a title="Cancel Booking" onclick="hotel_cancel_booking(this)" data-pnr="<?php echo base64_encode(base64_encode($booking->pnr_no));?>" data-placement="top" class="btn btn-danger btn-xs has-tooltip" data-original-title="Cancel Booking">
                                  <i class="icon-off"></i>Cancel <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                </a>
                              <?php }?>
                              <?php if($booking->user_type == '2'){ ?>
                                  <a title="Mail invoice" onclick="hotel_mail_invoice(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="Mail invoice">
                                      <i class="icon-envelope"></i>Mail invoice <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                  </a>
                              <?php } else if($booking->user_type == '3'){ ?>
                                  <a title="Mail invoice" onclick="hotel_mail_invoice(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="Mail invoice">
                                      <i class="icon-envelope"></i>Mail invoice <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                  </a>
                              <?php }?>
                              <?php if($booking->user_type == '2'){ ?>
                                   <a href="<?php echo WEB_URL.'/hotel/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="View Invoice" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Invoice">
                                    <i class="icon-ticket"></i>View Invoice
                                  </a>
                                <?php } else if($booking->user_type == '3'){ ?>
                                  <a href="<?php echo WEB_URL.'/hotel/uinvoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="View Invoice" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Invoice">
                                    <i class="icon-ticket"></i>View Invoice
                                  </a>
                              <?php }?>
                               <a title="Mail voucher" onclick="hotel_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="Mail Voucher">
                                          <i class="icon-envelope"></i>Mail voucher <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                        </a>
                                
                                <a href="<?php echo WEB_URL.'/hotel/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="View voucher" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Voucher">
                                
                                    <i class="icon-ticket"></i>View voucher
                                </a>
                                 

                            </div>
                    </div>
                    

                  </li>
        <?php } ?>
        <?php  if($pnr_no->module == 'CAR'){
          $booking = $this->booking_model->getBookingbyPnr($pnr_no->pnr_no,$pnr_no->module)->row();
          $car = json_decode(base64_decode($booking->response));
        ?>
                  <li class="bookingli">
                    <div class="bookingicon <?php echo 'p_'.strtolower($booking->module);?>"></div>
                    
                    <div class="tablofcon">
                    <div class="col-md-7 concell"> 
                        <div class="onwyrow">
                            <div class="fblueline22 linegreen">
                                <b><?php echo $booking->pickupCityName;?></b> (<?php echo $car->PickupLocation;?>) 
                                <span class="farrow"></span> 
                                <b><?php echo $booking->dropoffCityName;?></b> (<?php echo $car->ReturnLocation;?>)
                            </div>
                            <div class="col-md-2">
                                <div class="flitsecimg">
                                    <img alt="" src="<?php echo $booking->CarImage;?>" style=""/>
                                    <span class="nortosimle textcentr"><?php echo $this->car_model->get_vendor_details($car->VendorCode);?></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="radiobtn rittextalign">Pickup</div>
                                <span class="norto rittextalign"><?php echo date('d M, D Y', $this->flight_model->get_unixtimestamp($car->PickupDateTime));?></span>
                                <span class="norto lbold rittextalign"><?php echo date('H:i', $this->flight_model->get_unixtimestamp($car->PickupDateTime));?></span>
                            </div>
                            <div class="col-md-1 nopad">
                                <div class="flightimgs">
                                    <img alt="" src="<?php echo ASSETS;?>images/departure.png">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <span class="radiobtn">Return</span>
                                <span class="norto"><?php echo date('d M, D Y', $this->flight_model->get_unixtimestamp($car->ReturnDateTime));?></span>
                                <span class="norto lbold"><?php echo date('H:i', $this->flight_model->get_unixtimestamp($car->ReturnDateTime));?></span>
                            </div>
                            <div class="col-md-3 nopad">
                                <span class="radiobtn">Category</span>
                                <span class="norto"><?php echo $car->VehicleClass;?></span>
                                <span class="norto lbold"><?php echo $car->Category;?></span>
                            </div>
                        </div>  
                    </div>
                    
                    <div class="col-md-5 offset-0 concell litgrycell">
                            <div class="topfisconf">
                            
                            <div class="col-md-12 nopad">
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux">Reservation Date</div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux"> <?php echo date('D, d M Y', strtotime($booking->voucher_date));?></div>
                                    </div>
                                </div>
                                
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux">Confirmation No</div>
                                     </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux"> <?php echo $booking->pnr_no;?></div>
                                    </div>
                                </div>
                                
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux nomarb">Booking Status</div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux nomarb"> <?php echo $booking->booking_status;?></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 nopad">
                        <div class="botufis">
                         <?php if($booking->booking_status == 'CONFIRMED'){?>
                                <a title="Cancel Booking" onclick="car_cancel_booking(this)" data-pnr="<?php echo base64_encode(base64_encode($booking->pnr_no));?>" data-placement="top" class="btn btn-danger btn-xs has-tooltip" data-original-title="Cancel Booking">
                                  <i class="icon-off"></i>Cancel <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                </a>
                              <?php }?>
                              
                              <a title="Mail voucher" onclick="car_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="Edit Voucher">
                                          <i class="icon-envelope"></i>Mail voucher <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                        </a>
                                
                                <a href="<?php echo WEB_URL.'/car/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="View voucher" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Voucher">
                                    <i class="icon-ticket"></i>View voucher
                                </a>
                                <a title="Mail invoice" onclick="car_mail_invoice(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="Mail invoice">
                                  <i class="icon-envelope"></i>Mail invoice <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                              </a>
                              
                               <a href="<?php echo WEB_URL.'/car/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="View Invoice" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Invoice">
                                    <i class="icon-ticket"></i>View Invoice
                                </a>
                                   
                                <a class="left">
                                  <span class="green bold size20"><?php echo CURR_ICON?><?php echo $booking->amount;?></span> 
                                  </a>
                                
                         </div>

                    </div>
                            </div>
                     
                    </div>
                    
                    </div>
                    <!--<div class="col-md-1 offset-0">
                      <button type="submit" class="btn-search5 right">More</button>
                    </div>-->
                    <div class="clearfix"></div>
                  </li>
        <?php }?>
        <?php if($pnr_no->module == 'VACATION'){
              $booking = $this->booking_model->getBookingbyPnr($pnr_no->pnr_no,$pnr_no->module)->row();
              $vacation = json_decode(base64_decode($booking->response));
        ?>
                  <li class="bookingli">
                    <div class="bookingicon <?php echo 'p_'.strtolower($booking->module);?>"></div>
                    
                    <div class="tablofcon">
                    <div class="col-md-7 concell"> 
                        <div class="onwyrow">
                            <div class="fblueline22 linegreen">
                                <b><?php echo $booking->vacCityName;?></b> (<?php echo $booking->city;?>) 
                            </div>
                            <div class="col-md-2">
                                <div class="flitsecimg">
                                    <img alt="" src="<?php echo $booking->VacationImage;?>" style=""/>
                                    <span class="nortosimle textcentr"><?php echo $vacation->package_type;?></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="radiobtn rittextalign">Date</div>
                                <span class="norto rittextalign"><?php echo date('d M, D Y', strtotime($booking->vacDate));?></span>
                                <span class="norto lbold rittextalign"><?php echo date('H:i', strtotime($booking->vacDate));?></span>
                            </div>
                            <div class="col-md-1 nopad">
                                <div class="flightimgs">
                                    <img alt="" src="<?php echo ASSETS;?>images/departure.png">
                                </div>
                            </div>
                            <div class="col-md-3 nopad">
                                <span class="radiobtn">Category</span>
                                <span class="norto"><?php echo $vacation->package_name;?></b></span>
                                <span class="norto lbold"><?php echo $vacation->package_type;?></span>
                            </div>
                        </div>  
                    </div>
                    
                    <div class="col-md-5 offset-0 concell litgrycell">
                            <div class="topfisconf">
                            
                            <div class="col-md-12 nopad">
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux">Reservation Date</div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux"> <?php echo date('D, d M Y', strtotime($booking->voucher_date));?></div>
                                    </div>
                                </div>
                                
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux">Confirmation No</div>
                                     </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux"> <?php echo $booking->pnr_no;?></div>
                                    </div>
                                </div>
                                
                                <div class="rowfux">
                                    <div class="col-md-6 nopad">
                                        <div class="lablofux nomarb">Booking Status</div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                        <div class="answrfux nomarb"> <?php echo $booking->booking_status;?></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 nopad">
                        <div class="botufis">
                               <a title="Mail voucher" onclick="vacation_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="Edit Voucher">
                                          <i class="icon-envelope"></i>Mail voucher <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                        </a>
                                
                                <a href="<?php echo WEB_URL.'/vacation/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="View voucher" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Voucher">
                                    <i class="icon-ticket"></i>View voucher
                                </a>
                                
                                 <a title="Mail invoice" onclick="vacation_mail_invoice(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="Mail invoice">
                                  <i class="icon-envelope"></i>Mail invoice <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                  </a>
                              
                                <a href="<?php echo WEB_URL.'/vacation/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="View Invoice" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Invoice">
                                    <i class="icon-ticket"></i>View Invoice
                                </a>
                                <a class="left">
                                  <span class="green bold size20"><?php echo CURR_ICON?><?php echo $booking->amount;?></span> 
                                  </a>
                                
                         </div>

                    </div>
                            </div>
                     
                    </div>
                    
                    </div>
                    <!--<div class="col-md-1 offset-0">
                      <button type="submit" class="btn-search5 right">More</button>
                    </div>-->
                    <div class="clearfix"></div>
                  </li>
        <?php }?>
  <?php }?>        
<?php } else { ?>
                <div class="col-md-12" style="margin: 0 auto; text-align: center;">
                    <div class="srywrap"><span class="sorrydiv"><img src="<?php echo WEB_URL; ?>/assets/images/sorry.png" alt="" /></span><b>Nothing here</b></div>
                </div>
<?php } ?>
               
                  
                </ul>
            
          </div>

          <div class="holdereBookings"></div>
         
          
          
        </div>
      </div>
      <!-- END OF TAB 2 --> 
      
   

<!-- Modal -->

<div class="modal fade " id="cancel_request" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cancel Or Change Request</h4>
      </div>
      <div class="modal-body">
       <!-- The form which is used to populate the item data -->





        <form id="cancel_request_form" name="cancel_request_form" method="post" class="form-horizontal">
        <input type="hidden" name="pnr" id="pnr">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Full Name <small class="text-danger">*</small></label>
                        <div class="col-xs-5">
                            <input type="text" required=""  class="form-control" name="username" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-3 control-label">Email <small class="text-danger">*</small></label>
                        <div class="col-xs-5">
                            <input type="email" required=""  class="form-control" name="email" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-3 control-label">Request Type <small class="text-danger">*</small></label>
                        <div class="col-xs-5">
                            <select  required=""  class="form-control" name="request_type" >
                            <option value="Cancel">Cancel</option>
                            <option value="Change">Change</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-3 control-label">Message <small class="text-danger">*</small></label>
                        <div class="col-xs-5">
                            <textarea  required="" class="form-control" name="message" ></textarea> 
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 text-center">
                            <button type="submit" name="request" class="btn btn-primary">Request</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>



      </div>
   
    </div>
  </div>
</div>
  <!-- Modal -->
<script type="text/javascript">
$(document).ready(function() {
	
 
  
  
  if($(window).width() < 450){
	//$("div.holdereBookings").proPages({midRange    : 2});
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
}









</script> 
