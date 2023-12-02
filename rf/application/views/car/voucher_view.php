<?php $this->load->view('common/header');?>
<div class="flightvoucher_view" id="voucher">
  <div class="container">
    <div class="rfboxed-backgroundf">      
      <div class="voucherheader_container">
       <div class="col-md-12">
        <div class="fv_printvoucher">
          <a class="voucher_printer" title="<?php echo lang_line('PRINT_VOUCHER');?>" onclick="PrintDiv();">
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

<?php $this->load->view('common/footer');?>

<script type="text/javascript">
$(document).ready(function() {
  $(".tooltipv").tooltip();
});

function PrintDiv() {    
 var voucher = document.getElementById('voucher');
 var popupWin = window.open('', '_blank', 'width=600,height=600');
 popupWin.document.open();
 popupWin.document.write('<html><head><link href="<?php echo ASSETS;?>css/bootstrap.css" rel="stylesheet" media="print"><link href="<?php echo ASSETS;?>css/custom.css" rel="stylesheet" media="print"><link href="<?php echo ASSETS;?>css/bootstrap.css" rel="stylesheet" media="screen"><link href="<?php echo ASSETS;?>css/custom.css" rel="stylesheet" media="screen"><style>@media print {.col-md-1,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-10,.col-md-11 {float: left;}.col-md-1 {width: 8.333333333333332%;}.col-md-2 {width: 16.666666666666664%;}.col-md-3 {width: 25%;}.col-md-4 {width: 33.33333333333333%;}.col-md-5 {width: 41.66666666666667%;}.col-md-6 {width: 50%;}.col-md-7 {width: 58.333333333333336%;}.col-md-8 {width: 66.66666666666666%;}.col-md-9 {width: 75%;}.col-md-10 {width: 83.33333333333334%;}.col-md-11 {width: 91.66666666666666%;}.col-md-12 {width: 100%;}}.tooltip, .tooltipv{display: none !important;}</style></head><body onload="window.print()">' + voucher.innerHTML + '</html>');
 popupWin.document.close();
}
</script>
</body>
</html>