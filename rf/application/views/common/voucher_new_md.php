<div class="full marintopcnt vouchernew_container">
    <div class="tickapt">
    	<span class="iconaptcheck"><img src="<?php echo ASSETS;?>images/aptcheck.png" alt="" /></span>
        <span class="msgofapt">Thank you for order</span>
    </div>
    <div class="clear"></div>
    <div class="full contentvcr">
        <div class="container">
            <div class="container offset-0">
                <div class="rowitbk left">
                   <ul id="user_bookings">
                      <?php 
                      foreach($pnr_nos as $pnr_no){
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
                  <div class="col-md-7 nopad">
                    <div class="flikrall">
                      <a class="dark flikrdesc" href="<?php echo WEB_URL.'/apartment/rooms/'.$booking->PROP_ID;?>"><?php echo $booking->PROP_NAME;?></a> 
                      <span class="grayish size12"><?php echo $booking->PROP_CITY;?> - <?php echo $booking->COUNTRY_NAME;?></span><br>
                      <!-- <span class="green bold size20"><?php echo CURR_ICON?><?php echo $booking->amount;?></span> --> 
                  </div>
              </div>
              
              <div class="col-md-5 nopad">
                <div class="botufis">
                 <a title="Mail voucher" onclick="mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="Edit Voucher">
                  <i class="icon-envelope"></i>Mail voucher <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
              </a>
              <a href="<?php echo WEB_URL.'/apartment/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="View voucher" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Voucher">
                <i class="icon-ticket"></i>View voucher
            </a>
            <a class="left">
              <span class="green bold size20"><?php echo CURR_ICON?><?php echo $booking->amount;?></span> 
          </a>
      </div>
  </div>
</li>
<?php }} ?>
<?php foreach($pnr_nos as $pnr_no){ if($pnr_no->module == 'FLIGHT'){
    $booking = $this->booking_model->getBookingbyPnr($pnr_no->pnr_no,$pnr_no->module)->row();
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
                                            <div class="radiobtn rittextalign">Departure</div>
                                            <span class="norto rittextalign"><?php echo date('d M, D Y', $DepartureDateTime);?></span>
                                            <span class="norto lbold rittextalign"><?php echo date('H:i', $DepartureDateTime);?></span>
                                        </div>
                                        <div class="col-md-1 nopad">
                                            <div class="flightimgs">
                                                <img alt="" src="<?php echo ASSETS;?>images/departure.png">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <span class="radiobtn">Arrival</span>
                                            <span class="norto"><?php echo date('d M, D Y', $ArrivalDateTime);?></span>
                                            <span class="norto lbold"><?php echo date('H:i', $ArrivalDateTime);?></span>
                                        </div>
                                        <div class="col-md-3 nopad">
                                            <span class="radiobtn">Duration</span>
                                            <span class="norto">Economy</span>
                                            <span class="norto lbold"><?php echo $dur;?></span>
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
                                             <a title="Mail voucher" onclick="flight_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="Edit Voucher">
                                              <i class="icon-envelope"></i>Mail voucher <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                          </a>
                                          
                                          <a href="<?php echo WEB_URL.'/flight/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="View voucher" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Voucher">
                                            <i class="icon-ticket"></i>View voucher
                                        </a>
                                        <?php
                                        
                                        if($booking->user_type == '2')
                                        {
                                           ?>
                                           <a href="<?php echo WEB_URL.'/flight/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="View Invoice" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Invoice">
                                             
                                               
                                            <i class="icon-ticket"></i>View Invoice
                                        </a>
                                        <?php
                                    }
                                    ?>
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
                            <div class="radiobtn rittextalign">Departure</div>
                            <span class="norto rittextalign"><?php echo date('d M, D Y', $onward_DepartureDateTime);?></span>
                            <span class="norto lbold rittextalign"><?php echo date('H:i', $onward_DepartureDateTime);?></span>
                        </div>
                        <div class="col-md-1 nopad">
                            <div class="flightimgs">
                                <img alt="" src="<?php echo ASSETS;?>images/departure.png">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <span class="radiobtn">Arrival</span>
                            <span class="norto"><?php echo date('d M, D Y', $onward_ArrivalDateTime);?></span>
                            <span class="norto lbold"><?php echo date('H:i', $onward_ArrivalDateTime);?></span>
                        </div>
                        <div class="col-md-3 nopad">
                            <span class="radiobtn">Duration</span>
                            <span class="norto">Economy</span>
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
                        <div class="radiobtn rittextalign">Departure</div>
                        <span class="norto rittextalign"><?php echo date('d M, D Y', $return_DepartureDateTime);?></span>
                        <span class="norto lbold rittextalign"><?php echo date('H:i', $return_DepartureDateTime);?></span>
                    </div>
                    <div class="col-md-1 nopad">
                        <div class="flightimgs">
                            <img alt="" src="<?php echo ASSETS;?>images/departure.png">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <span class="radiobtn">Arrival</span>
                        <span class="norto"><?php echo date('d M, D Y', $return_ArrivalDateTime);?></span>
                        <span class="norto lbold"><?php echo date('H:i', $return_ArrivalDateTime);?></span>
                    </div>
                    <div class="col-md-3 nopad">
                        <span class="radiobtn">Duration</span>
                        <span class="norto">Economy</span>
                        <span class="norto lbold"><?php //echo $dur;?></span>
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
                         <a title="Mail voucher" onclick="flight_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="Edit Voucher">
                          <i class="icon-envelope"></i>Mail voucher <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                      </a>
                      
                      <a href="<?php echo WEB_URL.'/flight/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="View voucher" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Voucher">
                        <i class="icon-ticket"></i>View voucher
                    </a>
                    <?php
                    
                    if($booking->user_type == '2')
                    {
                       ?>
                       <a href="<?php echo WEB_URL.'/flight/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="View Invoice" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Invoice">
                         
                           
                        <i class="icon-ticket"></i>View Invoice
                    </a>
                    <?php
                }
                ?>
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
              
              <?php } else if($request->type=='M') {  
                $flight = json_decode(base64_decode($booking->response));
                      //  echo '<pre>';print_r($flight); die;
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
                                <div class="radiobtn rittextalign">Departure</div>
                                <span class="norto rittextalign"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime));?></span>
                                <span class="norto lbold rittextalign"><?php echo date('H:i', $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime));?></span>
                            </div>
                            <div class="col-md-1 nopad">
                                <div class="flightimgs">
                                    <img alt="" src="<?php echo ASSETS;?>images/departure.png">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <span class="radiobtn">Arrival</span>
                                <span class="norto"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($onward_last_seg->ArrivalTime));?></span>
                                <span class="norto lbold"><?php echo date('H:i', $this->flight_model->get_unixtimestamp($onward_last_seg->ArrivalTime));?></span>
                            </div>
                            <div class="col-md-3 nopad">
                                <span class="radiobtn">Duration</span>
                                <span class="norto">Economy</span>
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
                                 <a title="Mail voucher" onclick="flight_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="Edit Voucher">
                                  <i class="icon-envelope"></i>Mail voucher <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                              </a>
                              
                              <a href="<?php echo WEB_URL.'/flight/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="View voucher" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Voucher">
                                <i class="icon-ticket"></i>View voucher
                            </a>
                            <?php
                            
                            if($booking->user_type == '2')
                            {
                               ?>
                               <a href="<?php echo WEB_URL.'/flight/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="View Invoice" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Invoice">
                                 
                                   
                                <i class="icon-ticket"></i>View Invoice
                            </a>
                            <?php
                        }
                        ?>
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


              <?php } }} ?>
              <?php foreach($pnr_nos as $pnr_no){ if($pnr_no->module == 'HOTEL'){
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
                  
                  <div class="col-md-7 nopad">
                    <div class="flikrall">
                      <span class="grayish size12"><?php echo $booking->hotel_name;?> (<?php echo $booking->room_name;?>) -</span>
                      <span class="grayish size12"><?php echo $booking->city;?></span>
                      <!-- <br>
                      <span class="green bold size20"><?php echo CURR_ICON?><?php echo $booking->amount;?></span>  -->
                  </div>
              </div>
              
              <div class="col-md-5 nopad">
                <div class="botufis">
                 <a title="Mail voucher" onclick="hotel_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="Edit Voucher">
                  <i class="icon-envelope"></i>Mail voucher <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
              </a>
              
              <a href="<?php echo WEB_URL.'/hotel/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="View voucher" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Voucher">
                <i class="icon-ticket"></i>View voucher
            </a>
            <?php
            
            if($booking->user_type == '2')
            {
               ?>
               <a href="<?php echo WEB_URL.'/hotel/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="View Invoice" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Invoice">
                 
                   
                <i class="icon-ticket"></i>View Invoice
            </a>
            <?php
        }
        ?> 
        <a class="left">
          <span class="green bold size20"><?php echo CURR_ICON?><?php echo $booking->amount;?></span> 
      </a>
      
  </div>

</div>


</li>
<?php }} ?>


<?php foreach($pnr_nos as $pnr_no){ if($pnr_no->module == 'CAR'){
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
                            <img alt="" src="<?php echo $booking->CarImage;?>" style="width: 100px;"/>
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
                            <img alt="" src="<?php echo ASSETS;?>images/ccar.png">
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
                         <a title="Mail voucher" onclick="car_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="Edit Voucher">
                          <i class="icon-envelope"></i>Mail voucher <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                      </a>
                      
                      <a href="<?php echo WEB_URL.'/car/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="View voucher" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Voucher">
                        <i class="icon-ticket"></i>View voucher
                    </a>
                    <?php
                    
                    if($booking->user_type == '2')
                    {
                       ?>
                       <a href="<?php echo WEB_URL.'/car/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="View Invoice" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Invoice">
                         
                           
                        <i class="icon-ticket"></i>View Invoice
                    </a>
                    <?php
                }
                ?>
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
              <?php }} ?>

              <?php foreach($pnr_nos as $pnr_no){ if($pnr_no->module == 'VACATION'){
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
                                        <img alt="" src="<?php echo $booking->VacationImage;?>" style="width: 100px;"/>
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
                                        <img alt="" src="<?php echo ASSETS;?>images/vvactn.png">
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
                                  
                                  <a href="<?php echo WEB_URL.'/vacation/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="View voucher" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Voucher">
                                    <i class="icon-ticket"></i>View voucher
                                </a>
                                <?php
                                
                                if($booking->user_type == '2')
                                {
                                   ?>
                                   <a href="<?php echo WEB_URL.'/vacation/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="View Invoice" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Invoice">
                                     
                                       
                                    <i class="icon-ticket"></i>View Invoice
                                </a>
                                <?php
                            }
                            ?>
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
              <?php }} ?>
              
          </ul>
          
      </div>
  </div>
</div>
</div>
</div>

