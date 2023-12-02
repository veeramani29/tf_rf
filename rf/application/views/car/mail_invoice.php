<style>
.text-center{text-align: center;}
.width50{width: 49%;display: inline-block;}
.rfboxed-backgroundf{border:21px solid #626365; float: left; width: 100%; border-radius: 21px; position: relative; background-color: #ffffff; }
</style>
<div class="text-center" id="voucher">
  <div class="">
    <div class="rfboxed-backgroundf">
      <div class="centervoucher2">
        <div class="col-md-12">
          <div class="alliconfrmt">
            <a class="tooltipv iconsofvcr icon icon-print" title="<?php echo lang_line('PRINT_VOUCHER');?>" onclick="PrintDiv();"></a>
          </div>
        </div>
        <div class="clear"></div>
        <div class="width50">
          <?php if($Booking->user_type == '3'){?>
          <img src="<?php echo ASSETS;?>images/logo.png" alt="Reservationfactory Logo" width="150px;"/>
          <?php }?>
        </div>
        <div class="width50">
         <div class="vcradrss">
          <?php if($Booking->user_type == '3'){?>
          <?php  echo $voucher_details->flight_cl_address; ?>
          <div class="iconmania">
            <span class="icon icon-envelope"></span>
            <a><?php echo $voucher_details->flight_cl_email; ?></a>
          </div>
          <div class="iconmania">
            <span class="icon icon-phone"></span>
            <?php echo $voucher_details->flight_cl_phone; ?>
          </div>
          <?php }?>
        </div>
      </div>
      <div class="clear"></div>
      <br />
      <div>
       <table width="100%" border="0" align="center" cellpadding="8" cellspacing="0" style=" font-family:Arial, Helvetica, sans-serif; font-size:13px;" class="tables">
        <tbody>
          <tr>
            <td align="left"></td>
            <td align="right" style="font-size:13px; line-height:20px;">
            </td>
          </tr>
          <tr>
            <td colspan="2" style="border:0px; border-top:1px dashed #CCC;">
              <table width="900" border="0" align="center" cellpadding="8" cellspacing="0">
                <tbody>
                  <tr>
                    <td width="100%" style="line-height:22px;">
                     <div class="confirmtionltr"><?php echo lang_line('CONF_LETTER');?></div>
                   </td>
                 </tr>
                 <tr>
                  <td align="center">
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tbody>
                        <tr>
                          <td width="50%" align="left" valign="top">
                            <table width="100%" border="0" cellspacing="1" cellpadding="7" bgcolor="#FFFFFF">
                              <tbody>
                                <tr>
                                  <td colspan="2" align="left">
                                    <strong style="font-size:18px;">
                                     <?php echo $Booking->leadpax;?>  </strong>
                                   </td>
                                 </tr>
                                 <tr>
                                  <td width="50%" align="left"><?php echo lang_line('CONF_NO');?>  :</td>
                                  <td width="50%" align="left"><strong><?php echo ($Booking->booking_no!=null)?$Booking->booking_no:'N/A';?></strong></td>
                                </tr>
                                <tr>
                                  <td width="50%" align="left"><?php echo lang_line('RESERVATION_CODE');?>  :</td>
                                  <td width="50%" align="left"><strong><?php echo ($Booking->pnr_no!=null)?$Booking->pnr_no:'N/A';?></strong></td>
                                </tr>
                                <tr>
                                  <td width="50%" align="left"><?php echo lang_line('CAR_RESERVATION_CODE');?>  :</td>
                                  <td width="50%" align="left"><strong><?php echo ($Booking->ReservationLocatorCode!=null)?$Booking->ReservationLocatorCode:'N/A';?></strong></td>
                                </tr>
                                <tr>
                                  <td width="50%" align="left"><?php echo lang_line('BOOKING_STATUS');?>  :</td>
                                  <td width="50%" align="left"><strong><?php echo ($Booking->booking_status!=null)?$Booking->booking_status:'N/A';?></strong></td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                          <td width="50%" align="left" valign="top">
                            <table width="100%" border="0" cellspacing="1" cellpadding="7" bgcolor="#FFFFFF">
                              <tbody>
                                <tr>
                                  <td colspan="2" align="left">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td width="50%" align="left">&nbsp;</td>
                                  <td width="50%" align="left">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td align="left">&nbsp;</td>
                                  <td align="left">&nbsp;</td>
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
                 <td style="height:20px;width:100%;"></td>
               </tr>
               <?php 
               $car = json_decode(base64_decode($Booking->response));
               $request = json_decode(base64_decode($Booking->request));
               ?>
               <tr>
                <td align="center" bgcolor="#ffffff" class="padding1" style="border: 1px solid #eee;">
                  <table width="100%" border="0" cellspacing="0" cellpadding="7" bgcolor="#FFFFFF" class="paddingTableTable">
                    <tbody>
                      <tr>
                        <td colspan="4" bgcolor="#FFFFFF" style="border-bottom: 1px solid #eee;">
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
                        <td width="25%" rowspan="2" style="border-right: 1px solid #eee;">
                          <div class="padwithbord">
                            <div class="leftflitmg">
                              <img src="<?php echo $Booking->CarImage;?>" />
                            </div>
                            <div class="fligtdetss">
                              <?php echo $this->car_model->get_vendor_details($car->VendorCode);?> <br />
                              <?php echo $car->VendorCode;?>
                            </div>
                            <div class="opfligt"><?php echo lang_line('CAR_CATEGORY');?> : <strong><?php echo $car->Category;?></strong></div>

                            <div class="opfligt"> <?php echo lang_line('VEHICLE_CLASS');?>: <strong><?php echo $car->VehicleClass;?></strong></div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;">
                          <span style="font-size:16px; font-weight:bold;"><?php echo $Booking->Pickup;?></span><br><?php echo $Booking->pickupCityName;?>
                        </td>
                        <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; font-weight:bold;"><?php echo $Booking->Dropoff;?></span><br><?php echo $Booking->dropoffCityName;?></td>
                        <td width="25%" rowspan="2" bgcolor="#FFFFFF">Vendor:<br><?php echo $car->VendorCode;?> <br><br>
                          <?php echo lang_line('BOOKING_CLASS');?>: <?php echo $car->VehicleClass;?><br>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;"><?php echo lang_line('PICK_UP');?>:<br><span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($car->PickupDateTime));?></span><br></td>
                        <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">
                          <?php echo lang_line('DROP_OFF');?>:<br><span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($car->ReturnDateTime));?></span><br>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td style="height:20px;width:100%;"></td>
              </tr>
              <tr>
                <td>
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
               <td style="height:20px;width:100%;"></td>
             </tr>
             <tr>
              <td>
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
          <tr>
            <td colspan="2">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td align="left" valign="top" style="background:#eeeeee">
                      <strong><?php echo lang_line('BOOKING_AMNT');?> </strong>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" style="background:#fff"><?php echo $Booking->TotalPrice;?> </td>
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
   <td style="height:20px;width:100%;"></td>
 </tr>
 <tr>
  <td colspan="2">
   <table class="table table-bordered mart15">
    <tbody>
      <tr>
        <td bgcolor="#eeeeee">
          <div class="detailhed"><?php echo lang_line('TERMS_CON');?> </div>
        </td>
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
<tr>
  <td>

  </td>
</tr>
</tbody></table>
</div>
</div>
</div>
</div>
</div>
</body>
</html>