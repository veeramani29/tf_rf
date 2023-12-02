<?php $this->load->view('common/header');?>
<div class="flightvoucher_view" id="voucher">
  <div class="container">
    <div class="rfboxed-backgroundf">      
      <div class="voucherheader_container">
       <div class="col-md-12">
        <div class="fv_printvoucher">
          <a class="voucher_printer" data-toggle="tooltip" data-placement="top" title="<?php echo lang_line('PRINT_VOUCHER');?>"  onclick="PrintDiv();">
            <i class="fa fa-print"></i>
          </a>
        </div>
      </div>
      <div class="clear"></div>
      <div class="col-md-6">
       <img src="<?php echo ASSETS;?>images/logo.png" alt="rfactory Logo" class="voucherlogo_width" />
     </div>

     <div class="col-md-6">
       <div class="pull-right">
         <?php  echo $voucher_details->flight_cl_address; ?>
         <div class="iconmania"><span class="icon icon-envelope"></span><a> <?php echo $voucher_details->flight_cl_email; ?></a></div>
         <div class="iconmania"><span class="icon icon-phone"></span> <?php echo $voucher_details->flight_cl_phone; ?></div>
      </div>
    </div>
    <div class="clear"></div>
    <br />
    <div class="col-md-12">
      <div class="fv_title"><?php echo lang_line('CONF_LETTER');?></div>
      <strong style="font-size:18px;"><?php echo strtoupper($Booking->leadpax);?></strong>
      <ul class="list-inline">
        <li class="col-sm-3"><?php echo lang_line('CONF_NO');?>  :</li>
        <li><?php echo $Booking->pnr_no;?></li></br/>
        <li class="col-sm-3"><?php echo lang_line('RESERVATION_CODE');?>   :</li>
        <li><?php echo ($Booking->ReservationLocatorCode!=null)?$Booking->ReservationLocatorCode:"N/A";?></li></br/>
 <?php
             $booking_response=json_decode($Booking->booking_res);
            
             ?> 
        <li class="col-sm-3">Universal <?php echo lang_line('RESERVATION_CODE');?>   :</li>
        <li><?php echo ($booking_response->LocatorCode!=null)?$booking_response->LocatorCode:"N/A";?></li></br/>

       <li class="col-sm-3"><?php echo lang_line('AIR_RESERVATION_CODE');?> :</li>
       <li><strong><?php echo ($Booking->booking_no!=null)?$Booking->booking_no:"N/A";?></strong></li></br/>

<li class="col-sm-3">Universal <?php echo lang_line('AIR_RESERVATION_CODE');?> :</li>
       <li><strong><?php echo ($booking_response->AirReservationLocatorCode!=null)?$booking_response->AirReservationLocatorCode:"N/A";?></strong></li></br/>
               <li class="col-sm-3"><?php echo lang_line('BOOKING_STATUS');?>  :</li>
        <li><strong><?php echo $Booking->booking_status;?></strong></li>
      </ul>
      <table width="100%" class="mart15">
        <tbody>
          <tr>
            <td>
              <table class="table">
                <tbody>
                 <?php 
                 $flight = json_decode(base64_decode($Booking->response));
                 $request = json_decode(base64_decode($Booking->request));

                 if($request->type == 'O'){
                  foreach ($flight->segments as $key => $segment) {
                    ?>
                    <tr>
                      <td align="center" bgcolor="#ffffff">
                        <table class="table table-bordered mar0">
                          <tbody>
                            <tr>
                              <td colspan="4">
                                <div class="dterser">
                                  <div class="colsdets">
                                    <img src="<?php echo ASSETS;?>images/DEPARTURE_RF.svg" width="23" height="25">
                                    <?php echo lang_line('DEPARTURE');?>:
                                    <?php echo date('D, d M', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?>
                                  </div>
                                  <div class="snotes">
                                  <?php echo lang_line('VERIFY_MSG');?>
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td rowspan="2">
                                <div class="padwithbord">
                                  <div class="leftflitmg">
                                    <img src="<?php echo ASSETS;?>images/airline_logo/<?php echo $segment->Carrier;?>.gif" />
                                  </div>
                                  <div class="fligtdetss">
                                    <?php echo $this->flight_model->get_airline_name($segment->Carrier);?> <br />
                                    <?php echo $segment->Carrier;?>  <?php echo $segment->FlightNumber;?>  
                                  </div>
                                  <?php 
                                  if($segment->OperatingCarrier!='')
                                  {
                                   ?>
                                   <div class="opfligt"> <?php echo lang_line('OPERATED_BY');?>: : <strong><?php echo $segment->OperatingCarrier;?></strong></div>
                                   <?php
                                 }
                                 ?>

                                 <div class="opfligt"><?php echo lang_line('DURATION');?>: <strong><?php echo $this->flight_model->get_duration(strtotime($segment->DepartureTime),strtotime($segment->ArrivalTime));?></strong></div>
                               </div>
                             </td>

                             <td>
                              <span style="font-size:16px; font-weight:bold;"><?php echo $segment->Origin;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Origin);?>
                            </td>
                            <td>
                              <span style="font-size:16px; font-weight:bold;"><?php echo $segment->Destination;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Destination);?>
                            </td>
                            <td rowspan="2"><?php echo lang_line('AIRCRAFT');?> : <?php echo (isset($segment->Equipment) && $segment->Equipment!=null)?$segment->Equipment:"-";?> <br><br>
                              <?php echo lang_line('BOOK_CLASS');?> : <?php echo $segment->CabinClass;?></td>
                            </tr>
                            <tr>
                              <td ><?php echo lang_line('DEPART_AT');?>:<br><span style="font-size:13px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></span><br></td>
                              <td><?php echo lang_line('ARRIVAL_AT');?>:<br><span style="font-size:13px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span><br>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td style="height:20px;width:100%;"></td>
                    </tr>
                    <?php } ?>
                    <?php
                  }else if ($request->type == 'R') {
                    foreach ($flight->onward->segments as $key => $segment) {
                      ?>
                      <tr>
                        <td align="center" bgcolor="#ffffff">
                          <table class="table table-bordered">
                            <tbody>
                              <tr>
                                <td colspan="4">
                                  <div class="dterser">
                                    <div class="colsdets">
                                      <img src="<?php echo ASSETS;?>images/DEPARTURE_RF.svg" width="23" height="25">
                                      <?php echo lang_line('DEPARTURE');?>:
                                      <?php echo date('D, d M', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?>
                                    </div>
                                    <div class="snotes">
                                      <?php echo lang_line('VERIFY_MSG');?>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td rowspan="2">
                                  <div class="padwithbord">
                                    <div class="leftflitmg">
                                      <img src="<?php echo ASSETS;?>images/airline_logo/<?php echo $segment->Carrier;?>.gif" />
                                    </div>
                                    <div class="fligtdetss">
                                      <?php echo $this->flight_model->get_airline_name($segment->Carrier);?> <br />
                                      <?php echo $segment->Carrier;?>  <?php echo $segment->FlightNumber;?>  
                                    </div>
                                    <?php 
                                    if($segment->OperatingCarrier!='')
                                    {
                                     ?>
                                     <div class="opfligt"> <?php echo lang_line('OPERATED_BY');?>: : <strong><?php echo $segment->OperatingCarrier;?></strong></div>
                                     <?php
                                   }
                                   ?>
                                   <div class="opfligt"><?php echo lang_line('DURATION');?>: <strong><?php echo $this->flight_model->get_duration(strtotime($segment->DepartureTime),strtotime($segment->ArrivalTime));?></strong></div>
                                 </div>
                               </td>

                               <td>
                                <span style="font-size:16px; font-weight:bold;"><?php echo $segment->Origin;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Origin);?>
                              </td>
                              <td><span style="font-size:16px; font-weight:bold;"><?php echo $segment->Destination;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Destination);?></td>
                              <td rowspan="2"><?php echo lang_line('AIRCRAFT');?> : <?php echo (isset($segment->Equipment) && $segment->Equipment!=='') ? $segment->Equipment : '-';?> <br><br>
                                <?php echo lang_line('BOOK_CLASS');?> : <?php echo $segment->CabinClass;?></td>
                              </tr>
                              <tr>
                                <td><?php echo lang_line('DEPART_AT');?>:<br><span style="font-size:13px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></span><br></td>
                                <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;"><?php echo lang_line('ARRIVAL_AT');?>:<br><span style="font-size:13px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span><br>
                                </td>
                              </tr>
                            </tbody>
                          </table>

                        </td>
                      </tr>
                      <?php }?>
                      <tr>
                        <td style="height:20px;width:100%;"></td>
                      </tr>
                      <?php 
                      foreach ($flight->return->segments as $key => $segment) {
                        ?>
                        <tr>
                          <td align="center" bgcolor="#ffffff">
                            <table class="table table-bordered mar0">
                              <tbody>
                                <tr>
                                  <td colspan="4">
                                    <div class="dterser">
                                      <div class="colsdets">
                                        <img src="<?php echo ASSETS;?>images/DEPARTURE_RF.svg" width="23" height="25">
                                        <?php echo lang_line('DEPARTURE');?>:
                                        <?php echo date('D, d M', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?>
                                      </div>
                                      <div class="snotes">
                                        <?php echo lang_line('VERIFY_MSG');?>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td rowspan="2">
                                    <div class="padwithbord">
                                      <div class="leftflitmg">
                                        <img src="<?php echo ASSETS;?>images/airline_logo/<?php echo $segment->Carrier;?>.gif" />
                                      </div>
                                      <div class="fligtdetss">
                                        <?php echo $this->flight_model->get_airline_name($segment->Carrier);?> <br />
                                        <?php echo $segment->Carrier;?>  <?php echo $segment->FlightNumber;?>  
                                      </div>
                                      <?php 
                                      if($segment->OperatingCarrier!='')
                                      {
                                       ?>
                                       <div class="opfligt"> <?php echo lang_line('OPERATED_BY');?>: : <strong><?php echo $segment->OperatingCarrier;?></strong></div>
                                       <?php
                                     }
                                     ?>
                                     <div class="opfligt"><?php echo lang_line('DURATION');?>: <strong><?php echo $this->flight_model->get_duration(strtotime($segment->DepartureTime),strtotime($segment->ArrivalTime));?></strong></div>
                                   </div>
                                 </td>

                                 <td>
                                  <span style="font-size:16px; font-weight:bold;"><?php echo $segment->Origin;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Origin);?>
                                </td>
                                <td><span style="font-size:16px; font-weight:bold;"><?php echo $segment->Destination;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Destination);?></td>
                                <td width="25%" rowspan="2" bgcolor="#FFFFFF"><?php echo lang_line('AIRCRAFT');?> : <?php echo (isset($segment->Equipment) && $segment->Equipment!=='') ? $segment->Equipment : '-';?> <br><br>
                                  <?php echo lang_line('BOOK_CLASS');?> : <?php echo $segment->CabinClass;?></td>
                                </tr>
                                <tr>
                                  <td ><?php echo lang_line('DEPART_AT');?>:<br><span style="font-size:13px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></span><br></td>
                                  <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;"><?php echo lang_line('ARRIVAL_AT');?>:<br><span style="font-size:13px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span><br>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                        <?php }?>
                        <tr>
                          <td style="height:20px;width:100%;"></td>
                        </tr>
                        <?php } else if($request->type == 'M')  { 
                           foreach($flight->segments as $k) { 
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

    <tr>
      <td align="center" bgcolor="#ffffff" class="padding1" style="border: 1px solid #eee;">
        <table width="100%" border="0" cellspacing="0" cellpadding="7" bgcolor="#FFFFFF" class="paddingTableTable">
  <tbody>
  <tr>
    <td colspan="4" bgcolor="#FFFFFF" style="border-bottom: 1px solid #eee;">
    <div class="dterser">
        <div class="colsdets">
        <img src="<?php echo ASSETS;?>voucher/images/flight-icon.png" width="23" height="25">
        <?php echo lang_line('DEPARTURE');?>:
        <?php echo date('D, d M', $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime));?>
        </div>
        <div class="snotes">
        <?php echo lang_line('VERIFY_MSG');?>
        </div>
    </div>
    </td>
    </tr>
  <tr>
    <td width="25%" rowspan="2" style="border-right: 1px solid #eee;">
    <div class="padwithbord">
        <div class="leftflitmg">
            <img src="<?php echo ASSETS;?>images/airline_logo/<?php echo $onward_first_seg->Carrier;?>.gif" />
        </div>
        <div class="fligtdetss">
        <?php echo $this->flight_model->get_airline_name($onward_first_seg->Carrier);?> <br />
        <?php echo $onward_first_seg->Carrier;?>  <?php echo $onward_first_seg->FlightNumber;?>  
        </div>
          <?php 
    if($onward_first_seg->OperatingCarrier!='')
    {
      ?>
        <div class="opfligt"> <?php echo lang_line('OPERATED_BY');?>: : <strong><?php echo ($onward_first_seg->OperatingCarrier != "") ? $onward_first_seg->OperatingCarrier : "-";?></strong></div>
    <?php
    }
    ?>
        <div class="opfligt"><?php echo lang_line('DURATION');?>: <strong><?php echo $dur;?></strong></div>
    </div>
  </td>
    
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;">
    <span style="font-size:16px; font-weight:bold;"><?php echo $onward_first_seg->Origin;?></span><br><?php echo $this->flight_model->get_airport_name($onward_first_seg->Origin);?>
    </td>
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; font-weight:bold;"><?php echo $onward_last_seg->Destination;?></span><br><?php echo $this->flight_model->get_airport_name($onward_last_seg->Destination);?></td>
    <td width="25%" rowspan="2" bgcolor="#FFFFFF"><?php echo lang_line('AIRCRAFT');?> : <?php echo $onward_first_seg->Equipment;?> <br><br>
<?php echo lang_line('BOOK_CLASS');?> : <?php echo $onward_first_seg->CabinClass;?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;"><?php echo lang_line('DEPART_AT');?>:<br><span style="font-size:13px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime));?></span><br></td>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;"><?php echo lang_line('ARRIVAL_AT');?>:<br><span style="font-size:13px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($onward_last_seg->ArrivalTime));?></span><br>
</td>
    </tr>
        </tbody></table>

      </td>
    </tr>
    <tr>
      <td style="height:20px;width:100%;"></td>
    </tr>
    <?php } ?>

    <?php } ?>
                         
                          <tr>
                            <td bgcolor="#ffffff">
                             <table class="table table-bordered mar0">
                              <tbody>
                                <tr>
                                  <td colspan="5"><div class="detailhed"><?php echo lang_line('TRAVELLER')." ".lang_line('DETAILS');?> (<?php echo lang_line('LEAD_PX');?>)</div></td>
                                </tr>
                                <tr style="background:#eeeeee">
                                  <th align="left" valign="top"><strong><?php echo lang_line('SNO');?></strong></th>
                                  <th align="left" valign="top"><strong><?php echo lang_line('F_NAME');?> </strong></th>
                                  <!--<th align="left" valign="top"><strong>Middle Name </strong></th>-->
                                  <th align="left" valign="top"><strong><?php echo lang_line('L_NAME');?></strong></th>
                                  <th align="left" valign="top"><strong><?php echo lang_line('DOB');?></strong></th>
                                </tr>
                                <tr>
                                  <td>1</td>
                                  <td><?php echo $Booking->GUEST_FIRSTNAME;?></td>
                                  <!-- <td><?php echo $Booking->GUEST_MIDDLENAME;?></td> -->
                                  <td><?php echo $Booking->GUEST_LASTNAME;?></td>
                                  <td><?php echo $Booking->GUEST_DOB; ?></td>
                                </tr>
                                <?php
                                $a=json_decode(base64_decode($Booking->passenger_details));
                                $b=json_decode(base64_decode($Booking->passenger_full_details));
                                if($request->ADT >1){
                                  for ($i=1; $i < $request->ADT; $i++) {
                                    $s=$i-1;
                                    $ss=$i+1;
                                    $audlt="adults"."$ss";
                                    $doba=explode("/",$b->dob[$s]->$audlt);
                                    $doba=array_reverse($doba);
                                    $doba=implode("-",$doba);
                                    ?>
                                    
                                    <tr>
                                      <td><?php echo $ss;?></td>
                                      <td><?php echo $b->first[$s]->$audlt;?></td>
                                   <!--    <td><?php echo $b->middle[$s]->$audlt;?></td> -->
                                      <td><?php echo $b->last[$s]->$audlt;?></td>
                                      <td><?php echo $doba; ?></td>
                                    </tr>
                                    <?php  }
                                  } ?>

                                  <?php     if($a->childs>0) { ?>

                                  <tr>
                                   <td colspan="5"><div class="detailhed"><?php echo lang_line('CHILD');?></div></td>
                                 </tr>
                                 <?php
                                 for ($i=0; $i < $request->CHD; $i++) { 
                                  $aa=($request->ADT)-1; 
                                  $s=$aa+$i;
                                  $ss=$i+1;
                                  $child="childs"."$ss";
                                  $dobc=explode("/",$b->dob[$s]->$child);
                                  $dobc=array_reverse($dobc);
                                  $dobc=implode("-",$dobc);
                                  ?>
                                  <tr>
                                    <td><?php echo $i+1;?></td>
                                    <td><?php echo $b->first[$s]->$child;?></td>
                                    <!--<td><?php //echo $b->middle[$s]->$child;?></td>-->
                                    <td><?php echo $b->last[$s]->$child;?></td>
                                    <td><?php echo $dobc; ?></td>
                                  </tr>
                                  <?php } } 

                                  if($a->infants>0) { ?>
                                  <tr>
                                   <td colspan="5"><div class="detailhed"><?php echo lang_line('INFANTS');?></div></td>
                                 </tr>
                                 <?php
                                 for ($i=0; $i < $request->INF; $i++) { 
                                   $aa=($request->CHD+$request->ADT)-1; 

                                   $s=$aa+$i;
                                   $ss=$i+1;
                                   $infant="infants"."$ss";
                                   $dobi=explode("/",$b->dob[$s]->$infant);
                                   $dobi=array_reverse($dobi);
                                   $dobi=implode("-",$dobi);
                                   ?>
                                   <tr>
                                    <td><?php echo $i+1;?></td>
                                    <td><?php echo $b->first[$s]->$infant;?></td>
                                    <!-- <td><?php //echo $b->middle[$s]->$infant;?></td> -->
                                    <td><?php echo $b->last[$s]->$infant;?></td>
                                    <td><?php echo $dobc; ?></td>
                                  </tr>
                                  <?php } } ?>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td style="height:20px;width:100%;"></td>
                          </tr>
                          <tr>
                            <td bgcolor="#ffffff">
                              <table  class="table table-bordered mar0">
                                <tbody>
                                  <tr>
                                   <td colspan="2"><div class="detailhed"><?php echo lang_line('CUST')." ".lang_line('DETAILS');?></div></td>
                                 </tr>
                                 <tr>
                                  <td width="20%" align="left" style="background:#eeeeee"><strong><?php echo lang_line('EMAIL_ADD');?></strong></td>
                                  <td width="80%" align="left" style="background:#ffffff"><?php echo $Booking->BILLING_EMAIL;?></td>
                                </tr>
                                <tr>
                                  <td align="left" style="background:#eeeeee"><strong><?php echo lang_line('MOBILE_NO');?></strong></td>
                                  <td align="left" style="background:#ffffff"><?php echo $Booking->BILLING_PHONE;?></td>
                                </tr>
                              </tbody></table>
                            </td>
                          </tr>
                        </tbody></table>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <table class="table table-bordered">
                          <tbody>
                            <tr>
                             <td bgcolor="#eeeeee"><div class="detailhed"><?php echo lang_line('TERMS_CON');?> </div></td>
                           </tr>
                           <tr>
                            <td align="center">
                              <div class="paratems">
                                <?php echo $voucher_details->flight_cl_terms; ?>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php $this->load->view('common/footer');?>
    <style>
      .leftflitmg { max-width:70px !important } 
    </style>
    <script type="text/javascript">
    $(document).ready(function() {
      $(".tooltipv").tooltip();
    });

    function PrintDiv() {    
     var voucher = document.getElementById('voucher');
     var popupWin = window.open('', '_blank', 'width=600,height=600');
     popupWin.document.open();
     popupWin.document.write('<html><head><link href="<?php echo ASSETS;?>css/bootstrap.css" rel="stylesheet" media="print"><link href="<?php echo ASSETS;?>css/custom.css" rel="stylesheet" media="print"><link href="<?php echo ASSETS;?>css/bootstrap.css" rel="stylesheet" media="screen"><link href="<?php echo ASSETS;?>css/custom.css" rel="stylesheet" media="screen"><style>@media print {.col-md-1,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-10,.col-md-11 {float: left;}.col-md-1 {width: 8.333333333333332%;}.col-md-2 {width: 16.666666666666664%;}.col-md-3 {width: 25%;}.col-md-4 {width: 33.33333333333333%;}.col-md-5 {width: 41.66666666666667%;}.col-md-6 {width: 50%;}.col-md-7 {width: 58.333333333333336%;}.col-md-8 {width: 66.66666666666666%;}.col-md-9 {width: 75%;}.col-md-10 {width: 83.33333333333334%;}.col-md-11 {width: 91.66666666666666%;}.col-md-12 {width: 100%;}}.tooltip, .tooltipv{display: none !important;}</style></head><body onload="window.print()">' + voucher.innerHTML + '</html>');
      popupWin.document.close(); }

      /*popupWin.document.open();
          popupWin.document.write('<html><body onload="window.print()">' + voucher.innerHTML + '</body></html>');
          popupWin.document.close();
      }*/
    </script>
  </body>
</html>
