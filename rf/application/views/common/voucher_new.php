<div class="full marintopcnt vouchernew_container">
	<div class="clear"></div>
	<div class="">
		<div class="">
			<div class="">
				<div class="rowitbk left">
					<ul id="user_bookings" class="list-inline conformationt_design">
					
                <?php foreach($pnr_nos as $pnr_no){ if($pnr_no->module == 'FLIGHT'){
                 $booking = $this->booking_model->getBookingbyPnr($pnr_no->pnr_no,$pnr_no->module)->row();
                 $request = json_decode(base64_decode($booking->request));
                 if($request->type == 'O'){
                  $flight = json_decode(base64_decode($booking->response));
                  $first_seg = reset($flight->segments);
                  $last_seg = end($flight->segments);
                  $fromCityName =  $this->flight_model->get_airport_cityname($first_seg->Origin);
                  $toCityName =  $this->flight_model->get_airport_cityname($last_seg->Destination);
                  
                  $ArrivalDateTime = $last_seg->ArrivalTime;
                  $ArrivalDateTime = $art = strtotime($ArrivalDateTime);
                      //echo $ArrivalDateTime;die;

                  
                  $DepartureDateTime =$first_seg->DepartureTime;
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

                 <div class="thk-conformation">
                
                  <p><?php echo lang_line('CONFIRMATION_STATUS_MSG'); ?> <span><?php echo $booking->pnr_no;?></span></p>
                   <p>Your tickets will be available on the following website <a target="_blank" href="https://www.viewtrip.com/">https://www.viewtrip.com</a> within 12 hours. Fill in your Reservation Code and your last name to see your ticket. </p>
                </div>
                <li class="bookingli">
                 <div class="bookingicon <?php echo 'p_'.strtolower($booking->module);?>"></div>
                 <div class="tablofcon">
                  <div class="col-xs-12 concell nopadd"> 
                   <div class="onwyrow">
                    <div class="con_flightdetails">
                      <div class="col-xs-2">
                       <div class="flitsecimg">
                        <img alt="" id="FF219160" src="<?php echo ASSETS;?>images/airline_logo/<?php echo $first_seg->Carrier;?>.gif">
                        <!-- <span><?php echo $this->flight_model->get_airline_name($first_seg->Carrier);?></span> -->
                      </div>
                    </div>
                    <div class="col-xs-3">
                      <ul class="list-inline v-top">
                        <li>
                          <div class="flightimgs">
                            <img alt="" src="<?php echo ASSETS;?>images/DEPARTURE_RF.svg">
                          </div>
                        </li>
                        <li>
                          <div><?php echo $fromCityName;?></div>
                          <div><?php echo date('d M, D Y', $DepartureDateTime);?></div>
                          <div><?php echo date('H:i', $DepartureDateTime);?></div>
                        </li>
                      </ul>
                    </div>
                    <div class="col-xs-2">
                     <div class="fs-outbond">
                      <span class="fso_outbond"><?php echo lang_line('OUT_BOUND'); ?></span><br>
                      <img class="fs_io lazy" src="<?php echo ASSETS;?>images/ARROW_RF.svg">
                    </div>
                  </div>
                  <div class="col-xs-3">
                    <ul class="list-inline v-top">
                      <li>
                        <div class="flightimgs">
                          <img alt="" src="<?php echo ASSETS;?>images/ARRIVAL_RF.svg">
                        </div>
                      </li>
                      <li>
                        <div><?php echo $toCityName;?></div>
                        <div><?php echo date('d M, D Y', $ArrivalDateTime);?></div>
                        <div><?php echo date('H:i', $ArrivalDateTime);?></div>
                      </li>
                    </ul>
                  </div>
                  <div class="col-xs-2">
                   <div class=""><?php echo lang_line('DURATION');?></div>
                   <div class=""><?php echo lang_line('CLASS_ECO');?></div>
                   <div class=""><?php echo $dur;?></div>
                 </div>
               </div>
             </div>  
           </div>
         </div>
         <div class="clearfix"></div>
       </li>
       <li class="full_width">
        <div class="col-sm-12 nopadd">
          <div class="">
            <div class="col-md-6 column_center sm4nopadd">
              <div class="con_ticketdetails">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <td><?php echo lang_line('RESERV_DATE');?></td>
                      <td colspan="2"><?php echo date('D, d M Y', strtotime($booking->voucher_date));?></td>
                    </tr>
                    <tr>
                      <td><?php echo lang_line('CONF_NO');?></td>
                      <td colspan="2"><?php echo $booking->pnr_no;?></td>
                    </tr>
                    <tr>
                      <td>Reservation Code</td>
                      <td colspan="2"><?php echo $booking->booking_no;?></td>
                    </tr>

                    <tr>
                      <td><?php echo lang_line('BOOKING_STATUS');?></td>
                      <td colspan="2"><?php echo $booking->booking_status;?></td>
                    </tr>
                    <tr>
                      <td>
                        <a title="<?php echo lang_line('MAIL_VOUCHER');?>" onclick="flight_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btns-primary has-tooltip" data-original-title="Edit Voucher">
                          <i class="fa fa-ticket"></i> <?php echo lang_line('MAIL_VOUCHER');?>
                        </a>
                      </td>
                      <td colspan="2">
                        <a href="<?php echo WEB_URL.'/flight/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="<?php echo lang_line('VIEW_VOUCHER');?>" data-placement="top" class="btn btns-primary has-tooltip" data-original-title="<?php echo lang_line('VIEW_VOUCHER');?>">
                          <i class="fa fa-envelope-o"></i> <?php echo lang_line('VIEW_VOUCHER');?>
                        </a>
                        <?php
                        if($booking->user_type == '2')
                        {
                          ?>
                          <a href="<?php echo WEB_URL.'/flight/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="<?php echo lang_line('VIEW_INVOICE');?>" data-placement="top" class="btn btn-secondry btn-xs has-tooltip" data-original-title="<?php echo lang_line('VIEW_INVOICE');?>">
                            <i class="fa fa-ticket"></i> <?php echo lang_line('VIEW_INVOICE');?>
                          </a>
                          <?php
                        }
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3">
                        <span class="fsize16 color_secondry"><?php echo CURR_ICON?><?php echo $booking->amount;?></span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
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
     $onward_dur = $this->flight_model->get_duration(strtotime($onward_first_seg->DepartureTime),strtotime($onward_first_seg->ArrivalTime));    
     $return_dur = $this->flight_model->get_duration(strtotime($return_first_seg->DepartureTime),strtotime($return_first_seg->ArrivalTime)); 
     ?>        
     <div class="thk-conformation">
      <p><?php echo lang_line('CONFIRMATION_STATUS_MSG'); ?> <span><?php echo $booking->pnr_no;?></span></p>
       <p>Your tickets will be available on the following website <a target="_blank" href="https://www.viewtrip.com/">https://www.viewtrip.com</a> within 12 hours. Fill in your Reservation Code and your last name to see your ticket. </p>
    </div>
    <li class="bookingli">
      <div class="bookingicon <?php echo 'p_'.strtolower($booking->module);?>"></div>
      <div class="tablofcon">
       <div class="col-xs-12 nopadd"> 
        <div class="onwyrow">
          <div class="con_flightdetails">
            <div class="col-xs-2">
              <div class="flitsecimg">
                <div class="spacer30"></div>
                <img alt="" id="FF219160" src="<?php echo ASSETS;?>images/airline_logo/<?php echo $onward_first_seg->Carrier;?>.gif">
                <!-- <div><?php echo $this->flight_model->get_airline_name($onward_first_seg->Carrier);?></div> -->
              </div>
            </div>
            <div class="col-xs-3 con_departure">
              <ul class="list-inline v-top">
                <li>
                  <div class="flightimgs">
                    <img alt="" src="<?php echo ASSETS;?>images/DEPARTURE_RF.svg">
                  </div>
                </li>
                <li>
                  <div><?php echo $onward_fromCityName;?></div>
                  <div><?php echo date('d M, D Y', $onward_DepartureDateTime);?></div>
                  <div><?php echo date('H:i', $onward_DepartureDateTime);?></div>
                </li>
              </ul>
              <div class="spacer10"></div>
              <ul class="list-inline v-top">
                <li>
                  <div class="flightimgs">
                    <img alt="" src="<?php echo ASSETS;?>images/DEPARTURE_RF.svg">
                  </div>
                </li>
                <li>
                  <div class="con_departure">
                    <div><?php echo $return_fromCityName;?></div>
                    <div><?php echo date('d M, D Y', $return_DepartureDateTime);?></div>
                    <div><?php echo date('H:i', $return_DepartureDateTime);?></div>
                  </div>
                </li>
              </ul>
            </div>
            <div class="col-xs-2">
              <div class="fs-outbond">
                <span class="fso_outbond"><?php echo lang_line('OUT_BOUND'); ?></span><br>
                <img class="fs_io lazy" src="<?php echo ASSETS;?>images/ARROW_RF.svg">
              </div>
              <div class="spacer30"></div>
              <div class="fs-outbond">
                <span class="fso_outbond"><?php echo lang_line('RETURN'); ?></span><br>
                <img class="fs_io lazy" src="http://192.168.0.43/rfactory/assets/images/ARROW_RF.svg">
              </div>
            </div>
            <div class="col-xs-3">
              <ul class="list-inline v-top">
                <li>
                  <div class="flightimgs">
                    <img alt="" src="<?php echo ASSETS;?>images/ARRIVAL_RF.svg">
                  </div>
                </li>
                <li>
                  <div><?php echo $onward_toCityName;?></div>
                  <div><?php echo date('d M, D Y', $onward_ArrivalDateTime);?></div>
                  <div><?php echo date('H:i', $onward_ArrivalDateTime);?></div>
                </li>
              </ul>
              <div class="spacer10"></div>
              <ul class="list-inline v-top">
                <li>
                  <div class="flightimgs">
                    <img alt="" src="<?php echo ASSETS;?>images/ARRIVAL_RF.svg">
                  </div>
                </li>
                <li>
                  <div><?php echo $return_toCityName;?></div>
                  <div><?php echo date('d M, D Y', $return_ArrivalDateTime);?></div>
                  <div><?php echo date('H:i', $return_ArrivalDateTime);?></div>
                </li>
              </ul>
            </div>
            <div class="col-xs-2">
              <div><?php echo lang_line('DURATION');?></div>
              <div><?php echo lang_line('CLASS_ECO');?></div>
              <div><?php echo $onward_dur;?></div>
              <div class="spacer10"></div>
              <div><?php echo lang_line('DURATION');?></div>
              <div><?php echo lang_line('CLASS_ECO');?></div>
              <div><?php echo $return_dur;?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </li>
  <li class="full_width">
    <div class="col-md-12 nopadd">
      <div class="">
        <div class="col-md-6 column_center">
          <div class="con_ticketdetails">
            <table class="table table-bordered">
              <tr>
                <td><?php echo lang_line('RESERV_DATE');?></td>
                <td colspan="2"><?php echo date('D, d M Y', strtotime($booking->voucher_date));?></td>
              </tr>
              <tr>
                <td><?php echo lang_line('CONF_NO');?></td>
                <td colspan="2"><?php echo $booking->pnr_no;?></td>
              </tr>
              <tr>
                      <td>Reservation Code</td>
                      <td colspan="2"><?php echo $booking->booking_no;?></td>
                    </tr>
              <tr>
                <td><?php echo lang_line('BOOKING_STATUS');?></td>
                <td colspan="2"><?php echo $booking->booking_status;?></td>
              </tr>
              <tr>
                <td>
                  <a title="<?php echo lang_line('MAIL_VOUCHER');?>" onclick="flight_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btns-primary has-tooltip" data-original-title="<?php echo lang_line('MAIL_VOUCHER');?>">
                    <i class="fa fa-ticket"></i> <?php echo lang_line('MAIL_VOUCHER');?>
                  </a>
                </td>
                <td colspan="2">
                  <a href="<?php echo WEB_URL.'/flight/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="<?php echo lang_line('VIEW_VOUCHER');?>" data-placement="top" class="btn btns-primary has-tooltip" data-original-title="<?php echo lang_line('VIEW_VOUCHER');?>">
                    <i class="fa fa-envelope-o"></i> <?php echo lang_line('VIEW_VOUCHER');?>
                  </a>
                  <?php
                  if($booking->user_type == '2')
                  {
                    ?>
                    <a href="<?php echo WEB_URL.'/flight/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="<?php echo lang_line('VIEW_INVOICE');?>" data-placement="top" class="btn btn-secondry btn-xs has-tooltip" data-original-title="<?php echo lang_line('VIEW_INVOICE');?>">
                      <i class="fa fa-envelope-o"></i> <?php echo lang_line('VIEW_INVOICE');?>
                    </a>
                    <?php
                  }
                  ?>
                </td>
              </tr>
              <tr>
                <td colspan="3"><span class="fsize16 color_secondry"><?php echo CURR_ICON?><?php echo $booking->amount;?></span></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </li>
  <?php } else if($request->type=='M') {  
    $flight = json_decode(base64_decode($booking->response));
   
    ?>
    <div class="thk-conformation">
        <p><?php echo lang_line('CONFIRMATION_STATUS_MSG'); ?> <span><?php echo $booking->pnr_no;?></span></p>
         <p>Your tickets will be available on the following website <a target="_blank" href="https://www.viewtrip.com/">https://www.viewtrip.com</a> within 12 hours. Fill in your Reservation Code and your last name to see your ticket. </p>
      </div>
    <li class="bookingli full_width">
     <div class="bookingicon <?php echo 'p_'.strtolower($booking->module);?>"></div>
     <div class="tablofcon left">
      <div class="clear"></div>
      <div class="col-xs-12 nopadd">
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
        <div class="con_flightdetails conmulti_flightdetails">
         <div class="col-xs-2">
          <div class="flitsecimg">
           <img alt="" id="FF219160" src="<?php echo ASSETS;?>images/airline_logo/<?php echo $onward_first_seg->Carrier;?>.gif">
         </div>
       </div>
       <div class="col-xs-3 con_departure">
        <div><?php echo $onward_first_seg->Origin;?></div>
        <div><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime));?></div>
        <div><?php echo date('H:i', $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime));?></div>
      </div>
      <div class="col-xs-2">
        <div class="flightimgs">
         <img alt="" src="<?php echo ASSETS;?>images/DEPARTURE_RF.svg">
       </div>
     </div>
     <div class="col-xs-3">
      <div><?php echo $onward_last_seg->Destination;?></div>
      <div><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($onward_last_seg->ArrivalTime));?></div>
      <div><?php echo date('H:i', $this->flight_model->get_unixtimestamp($onward_last_seg->ArrivalTime));?></div>
    </div>
    <div class="col-xs-2">
      <div><?php echo lang_line('DURATION');?></div>
      <div><?php echo lang_line('CLASS_ECO');?></div>
      <div><?php echo $dur;?></div>
    </div>
  </div>
</div>
<div class="spacer20 col-xs-12"></div>  
<?php } ?>
</div>
</div>
<div class="clearfix"></div>
</li>
<li class="full_width">
  <div class="col-md-12 nopadd">
    <div class="">
      <div class="col-md-6 column_center sm4nopadd">
        <div class="con_ticketdetails">
          <table class="table table-bordered">
            <tr>
              <td><?php echo lang_line('RESERV_DATE');?></td>
              <td colspan="2"><?php echo date('D, d M Y', strtotime($booking->voucher_date));?></td>
            </tr>
            <tr>
              <td><?php echo lang_line('CONF_NO');?></td>
              <td colspan="2"><?php echo $booking->pnr_no;?></td>
            </tr>
            <tr>
                      <td>Reservation Code</td>
                      <td colspan="2"><?php echo $booking->booking_no;?></td>
                    </tr>
            <tr>
              <td><?php echo lang_line('BOOKING_STATUS');?></td>
              <td colspan="2"><?php echo $booking->booking_status;?></td>
            </tr>
            <tr>
              <td>
                <a title="<?php echo lang_line('MAIL_VOUCHER');?>" onclick="flight_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btns-primary has-tooltip" data-original-title="Edit Voucher">
                  <i class="fa fa-ticket"></i> <?php echo lang_line('MAIL_VOUCHER');?>
                </a>
              </td>
              <td colspan="2">
                <a href="<?php echo WEB_URL.'/flight/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="<?php echo lang_line('VIEW_VOUCHER');?>" data-placement="top" class="btn btns-primary has-tooltip" data-original-title="<?php echo lang_line('VIEW_VOUCHER');?>">
                  <i class="fa fa-envelope-o"></i> <?php echo lang_line('VIEW_VOUCHER');?>
                </a>
                <?php
                if($booking->user_type == '2')
                {
                  ?>
                  <a href="<?php echo WEB_URL.'/flight/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="<?php echo lang_line('VIEW_INVOICE');?>" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="<?php echo lang_line('VIEW_INVOICE');?>">
                    <i class="fa fa-ticket"></i> <?php echo lang_line('VIEW_INVOICE');?>
                  </a>
                  <?php
                }
                ?>
              </td>
            </tr>
            <tr>
              <td colspan="3">
                <span class="fsize16 color_secondry"><?php echo CURR_ICON?><?php echo $booking->amount;?></span>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</li>
<?php } }} ?>
<?php foreach($pnr_nos as $pnr_no){ if($pnr_no->module == 'HOTEL'){
  $booking = $this->booking_model->getBookingbyPnr($pnr_no->pnr_no,$pnr_no->module)->row();
  ?>  
  <div class="thk-conformation">
    <p><?php echo lang_line('CONFIRMATION_STATUS_MSG'); ?> <span><?php echo $booking->pnr_no;?></span></p>
  </div>
  <li class="bookingli hotelconformation_con">
   <div class="bookingicon <?php echo 'p_'.strtolower($booking->module);?>"></div>
   <div class="col-xs-2"> 
    <a class="fullpikr" href="#"><img src="<?php echo $booking->imageurl;?>" alt="" /></a> 
  </div>
  <div class="col-xs-10 nopad">
    <div class="topfis">
     <div class="col-xs-3">
      <div class="fiscal">
       <div class="lablofuxhed"><?php echo lang_line('CHECKIN');?></div>
       <div class="answrfuxdes">
        <span class="dvasam"><?php echo date('d', strtotime($booking->checkin));?></span>
        <span class="varsham"><?php echo date('D M Y', strtotime($booking->checkin));?></span>
      </div>
    </div>
  </div>
  <div class="col-xs-3">
    <div class="fiscal">
     <div class="lablofuxhed"><?php echo lang_line('CHECKOUT');?></div>
     <div class="answrfuxdes">
      <span class="dvasam"><?php echo date('d', strtotime($booking->checkout));?></span>
      <span class="varsham"><?php echo date('D M Y', strtotime($booking->checkout));?></span>
    </div>
  </div>
</div>
<div class="col-xs-6 nopad">
  <div class="rowfux">
   <div class="col-xs-6 nopad">
    <div class="lablofux"><?php echo lang_line('RESERV_DATE');?></div>
  </div>
  <div class="col-xs-6 nopad">
    <div class="answrfux"> <?php echo date('D, d M Y', strtotime($booking->voucher_date));?></div>
  </div>
</div>
<div class="rowfux">
 <div class="col-xs-6 nopad">
  <div class="lablofux"><?php echo lang_line('CONF_NO');?></div>
</div>
<div class="col-xs-6 nopad">
  <div class="answrfux"> <?php echo $booking->pnr_no;?></div>
</div>
</div>
<div class="rowfux">
 <div class="col-xs-6 nopad">
  <div class="lablofux nomarb"><?php echo lang_line('BOOKING_STATUS');?></div>
</div>
<div class="col-xs-6 nopad">
  <div class="answrfux nomarb"> <?php echo $booking->booking_status;?></div>
</div>
</div>
</div>
</div>
</div>
<div class="clearfix"></div>
<div class="spacer20"></div>
</li>
<li class="hotelconformation_btndetails">
  <div class="col-xs-7 nopad">
    <div class="flikrall">
      <span class="grayish size12"><?php echo $booking->hotel_name;?> (<?php echo $booking->room_name;?>) -</span>
      <span class="grayish size12"><?php echo $booking->city;?></span>
    </div>
  </div>
  <div class="col-xs-5 nopad">
    <div class="botufis">
      <a title="<?php echo lang_line('MAIL_VOUCHER');?>" onclick="hotel_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btns-primary has-tooltip" data-original-title="Edit Voucher">
        <i class="icon-envelope"></i><?php echo lang_line('MAIL_VOUCHER');?>
      </a>
      <a href="<?php echo WEB_URL.'/hotel/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="<?php echo lang_line('VIEW_VOUCHER');?>" data-placement="top" class="btn btns-primary has-tooltip" data-original-title="<?php echo lang_line('VIEW_VOUCHER');?>">
        <i class="icon-ticket"></i><?php echo lang_line('VIEW_VOUCHER');?>
      </a>
      <?php
      if($booking->user_type == '2')
      {
        ?>
        <a href="<?php echo WEB_URL.'/hotel/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="<?php echo lang_line('VIEW_INVOICE');?>" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="<?php echo lang_line('VIEW_INVOICE');?>">
          <i class="icon-ticket"></i><?php echo lang_line('VIEW_INVOICE');?>
        </a>
        <?php
      }
      ?> 
      <a class="conformation_amountdisplay">
        <span class="cad_amount"><?php echo CURR_ICON?><?php echo $booking->amount;?></span> 
      </a>
    </div>
  </div>
</li>
<?php }} ?>


<?php foreach($pnr_nos as $pnr_no){ if($pnr_no->module == 'CAR'){
 $booking = $this->booking_model->getBookingbyPnr($pnr_no->pnr_no,$pnr_no->module)->row();
 $car = json_decode(base64_decode($booking->response));
 ?>
 <div class="thk-conformation">
  <p><?php echo lang_line('CONFIRMATION_STATUS_MSG'); ?> <span><?php echo $booking->pnr_no;?></span></p>
</div>
<li class="bookingli">
  <div class="bookingicon <?php echo 'p_'.strtolower($booking->module);?>"></div>
  <div class="tablofcon">
   <div class="col-xs-12"> 
    <div class="onwyrow">
     <div class="col-md-2">
      <div class="flitsecimg">
        <span class="nortosimle textcentr"><?php echo $this->car_model->get_vendor_details($car->VendorCode);?></span>
        <img alt="" src="<?php echo $booking->CarImage;?>"/>
      </div>
    </div>
    <div class="col-md-3">
      <div class="radiobtn rittextalign"><?php echo lang_line('PICK_UP'); ?></div>
      <span class="norto rittextalign"><?php echo date('d M, D Y', $this->flight_model->get_unixtimestamp($car->PickupDateTime));?></span>
      <span class="norto lbold rittextalign"><?php echo date('H:i', $this->flight_model->get_unixtimestamp($car->PickupDateTime));?></span>
    </div>
    <div class="col-md-1 nopad">
      <div class="flightimgs">
       <img alt="" src="<?php echo ASSETS;?>images/ccar.png">
     </div>
   </div>
   <div class="col-md-3">
    <span class="radiobtn"><?php echo lang_line('DROP_OFF'); ?></span>
    <span class="norto"><?php echo date('d M, D Y', $this->flight_model->get_unixtimestamp($car->ReturnDateTime));?></span>
    <span class="norto lbold"><?php echo date('H:i', $this->flight_model->get_unixtimestamp($car->ReturnDateTime));?></span>
  </div>
  <div class="col-md-3 nopad">
    <span class="radiobtn"><?php echo lang_line('CAR_CATEGORY'); ?></span>
    <span class="norto"><?php echo $car->VehicleClass;?></span>
    <span class="norto lbold"><?php echo $car->Category;?></span>
  </div>
</div>  
</div>
</div>
<div class="clearfix"></div>
</li>
<li class="full_width">
  <div class="col-sm-12">
    <div class="">
      <div class="col-md-6 column_center sm4nopadd">
        <div class="con_ticketdetails">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <td><?php echo lang_line('RESERV_DATE');?></td>
                <td colspan="2"><?php echo date('D, d M Y', strtotime($booking->voucher_date));?></td>
              </tr>
              <tr>
                <td><?php echo lang_line('CONF_NO');?></td>
                <td colspan="2"><?php echo $booking->pnr_no;?></td>
              </tr>
              <tr>
                <td><?php echo lang_line('BOOKING_STATUS');?></td>
                <td colspan="2"><?php echo $booking->booking_status;?></td>
              </tr>
              <tr>
                <td>
                  <a title="<?php echo lang_line('MAIL_VOUCHER');?>" onclick="car_mail_voucher(this)" data-pnr="<?php echo $booking->pnr_no;?>" data-placement="top" class="btn btns-primary has-tooltip" data-original-title="Edit Voucher">
                    <i class="fa fa-ticket"></i> <?php echo lang_line('MAIL_VOUCHER');?>
                  </a>
                </td>
                <td colspan="2">
                  <a href="<?php echo WEB_URL.'/car/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="<?php echo lang_line('VIEW_VOUCHER');?>" data-placement="top" class="btn btns-primary has-tooltip" data-original-title="<?php echo lang_line('VIEW_VOUCHER');?>">
                    <i class="fa fa-envelope-o"></i> <?php echo lang_line('VIEW_VOUCHER');?>
                  </a>
                  <?php
                  if($booking->user_type == '2')
                  {
                    ?>
                    <a href="<?php echo WEB_URL.'/car/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="<?php echo lang_line('VIEW_INVOICE');?>" data-placement="top" class="btn btn-secondry btn-xs has-tooltip" data-original-title="<?php echo lang_line('VIEW_INVOICE');?>">
                      <i class="fa fa-ticket"></i> <?php echo lang_line('VIEW_INVOICE');?>
                    </a>
                    <?php
                  }
                  ?>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <span class="fsize16 color_secondry"><?php echo CURR_ICON?><?php echo $booking->amount;?></span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</li>
<?php }} ?>

</ul>
</div>
</div>
</div>
</div>
</div>

