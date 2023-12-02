<div class="full marintopcnt contentvcr" id="voucher">
    <div class="container">
        <div class="container offset-0">
        
        <div class="centervoucher2">
        
        	<div class="col-md-12">
                <div class="alliconfrmt">
                    <a class="tooltipv iconsofvcr icon icon-print" title="<?php echo lang_line('PRINT_VOUCHER');?>" onclick="PrintDiv();"></a>
                  
                </div>
            </div>
        	
            <div class="clear"></div>
            
        	<div class="col-md-6">
            
                    <img src="<?php echo ASSETS;?>images/logo.png" alt="ReservationFactory Logo" />
               
            </div>
            
            <div class="col-md-6">
             <div class="pull-right">
             
              <?php echo $voucher_details->in_address; ?>
              <div class="iconmania"><span class="icon icon-envelope"></span><a> <?php echo $voucher_details->in_email; ?></a></div>
              <div class="iconmania"><span class="icon icon-phone"></span> <?php echo $voucher_details->in_phone; ?></div>
             
            </div>
            </div>
            <div class="clear"></div>
        <br />
        	<div class="col-md-12">
            	 <table width="100%" class="tables">
            <tbody>
              <tr>
                <td align="left"></td>
                <td align="right" style="font-size:13px; line-height:20px;">
                </td>
              </tr>
              <tr>
                <td colspan="2" style="border:0; border-top:1px dashed #CCC;">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td width="100%" style="line-height:22px;border: 0;text-align:center">
                          <div class="confirmtionltr"><?php echo lang_line('INVOICE');?></div>
                        </td>
                      </tr>
                      <tr>
                        <td align="center" style="border: 0;">
                          <table class="table">
                            <tbody>
                              <tr>
                                <td width="50%" align="left" valign="top">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="7" bgcolor="#FFFFFF">
                                    <tbody>
                                      <tr>
                                        <td colspan="2" align="left">
                                          <strong style="font-size:18px;"><?php echo strtoupper($Booking->leadpax);?></strong>
                                        </td>
                                      </tr>
                                      



                                      <tr>
              <td width="50%" align="left"><?=lang_line('RESERVATION_CODE');?>  :</td>
              <td width="50%" align="left"><strong><?php echo ($Booking->AirReservationLocatorCode!='')?$Booking->AirReservationLocatorCode:"N/A";?></strong></td>
            </tr> 
             <?php
             $booking_response=json_decode($Booking->booking_res);
            
             ?>                                             
             <tr>
              <td width="50%" align="left">Universal <?=lang_line('RESERVATION_CODE');?>  :</td>
              <td width="50%" align="left"><strong><?php echo ($booking_response->LocatorCode!='')?$booking_response->LocatorCode:"N/A";?></strong></td>
            </tr>
            <tr>
              <td width="50%" align="left"><?=lang_line('AIR_RESERVATION_CODE');?>  :</td>
              <td width="50%" align="left"><strong><?php echo ($Booking->booking_no!='')?$Booking->booking_no:"N/A";?></strong></td>
            </tr> 
             <tr>
              <td width="50%" align="left">Universal  <?=lang_line('AIR_RESERVATION_CODE');?>  :</td>
              <td width="50%" align="left"><strong><?php echo ($booking_response->AirReservationLocatorCode!='')?$booking_response->AirReservationLocatorCode:"N/A";?></strong></td>
            </tr>
           
                                      <tr>
                                        <td width="50%" align="left"><?php echo lang_line('CONF_NO');?>  :</td>
                                        <td width="50%" align="left"><strong><?php echo $Booking->pnr_no;?></strong></td>
                                      </tr>
                                      <tr>
                                        <td width="50%" align="left"><?php echo lang_line('BOOKING_STATUS');?>  :</td>
                                        <td width="50%" align="left"><strong><?php echo $Booking->booking_status;?></strong></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                                <td width="50%" align="right" valign="top">
                                  <?php echo lang_line('Receive_Payment');?> : <?php echo date('D, M d, Y', strtotime($Booking->voucher_date));?>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                      <?php $flight = json_decode(base64_decode($Booking->response)); $request = json_decode(base64_decode($Booking->request)); ?>
                      <tr>
                        <td style="border: 0;">
                          <table class="table table-bordered">
                            <tbody>
                              <tr>
                                <td colspan="4"><div class="detailhed"><?php echo lang_line('Payment_Details');?></div></td>
                              </tr>
                              <tr style="background:#eeeeee">
                                <th align="left" valign="top"><strong><?php echo lang_line('Flight_Info');?>  </strong></th>
                                <th align="left" valign="top"><strong><?php echo lang_line('Base_Fare');?>  </strong></th>
                                <th align="left" valign="top"><strong><?php echo lang_line('Tax');?>  </strong></th>
                                <th align="left" valign="top"><strong><?php echo lang_line('Total_Amount');?></strong></th>
                              </tr>
                              <tr style="background:#ffffff">
                              <?php
if($request->type!='M'){
$origin=$request->origin;
$destination=$request->destination;

}else{
  $origin=reset($request->origin);
  $destination=end($request->destination);
}
                              ?>
                                <td><?php echo $this->flight_model->get_airport_cityname($origin);?> To <?php echo $this->flight_model->get_airport_cityname($destination);?> <?php echo ($request->type=='M')?'(Multicity)':'';?></td>
                                <td><?php echo $flight->BasePrice;?> $</td>
                                <td><?php echo $flight->Taxes;?> $</td>
                                <td><?php echo $flight->TotalPrice;?> $</td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td style="border: 0;">
                          <table class="table table-bordered">
                            <tbody>
                              <tr>
                                <td colspan="2"><div class="detailhed"><?php echo lang_line('TRAVELLER')." ".lang_line('DETAILS');?> (<?php echo lang_line('LEAD_PX');?>)</div></td>
                              </tr>
                              <tr>
                                <td width="20%" align="left" style="background:#eeeeee"><strong><?php echo lang_line('EMAIL');?></strong></td>
                                <td width="80%" align="left" style="background:#ffffff"><?php echo $Booking->BILLING_EMAIL;?></td>
                              </tr>
                              <tr>
                                <td align="left" style="background:#eeeeee"><strong><?php echo lang_line('MOBILE_NO');?></strong></td>
                                <td align="left" style="background:#ffffff"><?php echo $Booking->BILLING_PHONE;?></td>
                              </tr>
                            </tbody>
                          </table>
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