
<html>

<body>
<div class="full marintopcnt contentvcr" id="voucher">
    <div class="container">
        <div class="container offset-0">
        
        <div class="centervoucher2">
        
         
          <div class="col-md-6">
              <?php if($Booking->user_type == '3'){?>
                    <img src="<?php echo ASSETS;?>images/logo.png" alt="Reservationfactory Logo" />
              
                     
                <?php }?>
            </div>
            
            <div class="col-md-6">
              <div class="vcradrss">
                  <?php if($Booking->user_type == '3'){?>
         <?php  echo $voucher_details->flight_cl_address; ?>
         <div class="iconmania"><span class="icon icon-envelope"></span><a> <?php echo $voucher_details->flight_cl_email; ?></a></div>
         <div class="iconmania"><span class="icon icon-phone"></span> <?php echo $voucher_details->flight_cl_phone; ?></div>
         <?php }?>
                </div>
            </div>
            <div class="clear"></div>
        <br />
          <div class="col-md-12">
           <div class="fv_title"><?php echo lang_line('CONF_LETTER');?></div>
      <ul class="list-inline">
        <li class="full_width"><strong style="font-size:18px;">
          <?php echo $Booking->leadpax;?></strong>
        </li>
        <li class="col-sm-3"><?php echo lang_line('CONF_NO');?>  :</li>
        <li><strong><?php echo $Booking->pnr_no;?></strong></li>
        <br>
        <li class="col-sm-3"><?php echo lang_line('RESERVATION_CODE');?>  :</li>
        <li><strong><?php echo ($Booking->booking_no!=null)?$Booking->booking_no:"N/A";?></strong></li>
        <br>
        <li class="col-sm-3"><?php echo lang_line('CAR_RESERVATION_CODE');?>  :</li>
        <li><strong><?php echo ($Booking->ReservationLocatorCode!=null)?$Booking->ReservationLocatorCode:"N/A";?></strong></li>
        <br>
        <li class="col-sm-3"><?php echo lang_line('BOOKING_STATUS');?>  :</li>
        <li><strong><?php echo $Booking->booking_status;?></strong></li>
      </ul>
      <table width="100%" class="mart15">
        <tbody>
          <tr>
            <td colspan="2">
              <table class="table">
                <tbody>
                 <?php 
                 $car = json_decode(base64_decode($Booking->response));
                 $request = json_decode(base64_decode($Booking->request));
                 ?>
                 <tr>
                  <td class="tdbp0">
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <td colspan="4">
                            <div class="dterser">
                              <div class="colsdets">
                                <img src="<?php echo ASSETS;?>voucher/images/ccar.png" width="23" height="25">
                                <?php echo lang_line('PICK_UP');?>:
                                <?php echo date('D, d M', $this->flight_model->get_unixtimestamp($car->PickupDateTime));?>
                              </div>
                              <div class="snotes">
                                <?php echo lang_line('PICKUP_MSG');?>

                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td width="25%" rowspan="2">
                            <div class="padwithbord">
                              <div class="leftflitmg">
                                <img src="<?php echo $Booking->CarImage;?>" />
                              </div>
                              <div class="fligtdetss">
                                <?php echo $this->car_model->get_vendor_details($car->VendorCode);?> <br />
                                <?php echo $car->VendorCode;?>
                              </div>
                              <div class="opfligt"> <?php echo lang_line('VEHICLE_CLASS');?> : <strong><?php echo $car->Category;?></strong></div>

                              <div class="opfligt"> <?php echo lang_line('CAR_CATEGORY');?> : <strong><?php echo $car->VehicleClass;?></strong></div>
                            </div>
                          </td>
                          <td>
                            <span class="fsize16b"><?php echo $Booking->Pickup;?></span><br><?php echo $Booking->pickupCityName;?>
                          </td>
                          <td>
                            <span class="fsize16b"><?php echo $Booking->Dropoff;?></span><br><?php echo $Booking->dropoffCityName;?>
                          </td>
                          <td width="25%" rowspan="2">Vendor:<br><?php echo $car->VendorCode;?> <br><br>
                            <?php echo lang_line('BOOKING_CLASS');?>: <?php echo $car->VehicleClass;?><br>
                          </td>
                        </tr>
                        <tr>
                          <td ><?php echo lang_line('PICK_UP');?>:<br>
                            <span class="fsize16b"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($car->PickupDateTime));?></span><br>
                          </td>
                          <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;"><?php echo lang_line('DROP_OFF');?>:<br>
                            <span class="fsize16b"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($car->ReturnDateTime));?></span><br>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>

                <tr>
                  <td class="tdbp0">
                    <table class="table table-bordered mart15">
                      <tbody>
                        <tr>
                          <td colspan="4">
                            <div class="detailhed"><?php echo lang_line('TRAVELLER')." ".lang_line('DETAILS');?> (<?php echo lang_line('LEAD_PX');?>)</div>
                          </td>
                        </tr>
                        <tr style="background:#eeeeee">
                          <th valign="top"><strong><?php echo lang_line('SNO');?></strong></th>
                          <th valign="top"><strong><?php echo lang_line('F_NAME');?> </strong></th>
                          <th valign="top"><strong><?php echo lang_line('L_NAME');?></strong></th>
                          <th valign="top"><strong><?php echo lang_line('DOB');?></strong></th>
                        </tr>
                        <tr>
                          <td>1</td>
                          <td><?php echo $Booking->GUEST_FIRSTNAME;?></td>
                          <td><?php echo $Booking->GUEST_LASTNAME;?></td>
                          <td><?php echo $Booking->GUEST_DOB; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>

                <tr>
                  <td class="tdbp0">
                    <table  class="table table-bordered mart15">
                      <tbody>
                        <tr>
                          <td colspan="2">
                            <div class="detailhed"><?php echo lang_line('CUST')." ".lang_line('DETAILS');?></div>
                          </td>
                        </tr>
                        <tr>
                          <td width="20%" style="background:#eeeeee"><strong><?php echo lang_line('EMAIL_ADD');?></strong></td>
                          <td width="80%" style="background:#ffffff"><?php echo $Booking->BILLING_EMAIL;?></td>
                        </tr>
                        <tr>
                          <td style="background:#eeeeee">
                            <strong><?php echo lang_line('MOBILE_NO');?></strong>
                          </td>
                          <td><?php echo $Booking->BILLING_PHONE;?></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>

              </tbody>
            </table>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <table class="table table-bordered mart15">
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


</body>
</html>