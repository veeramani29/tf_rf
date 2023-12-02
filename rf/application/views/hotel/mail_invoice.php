<div class="full marintopcnt contentvcr" id="voucher">
    <div class="container">
    <div class="rfboxed-backgroundf">      
      <div class="voucherheader_container">
        <div class="">
        
        <div class="centervoucher2">
        
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
 <?php echo $voucher_details->flight_cl_address; ?>
         <div class="iconmania"><span class="icon icon-envelope"></span><a> <?php echo $voucher_details->flight_cl_email; ?></a></div>
         <div class="iconmania"><span class="icon icon-phone"></span> <?php echo $voucher_details->flight_cl_phone; ?></div>
        
                               </div>
            </div>
            <div class="clear"></div>
        
          <div class="col-md-12">
              <div class="witmd6">
              <div class="topvmsg">
                  <h3 class="heloma"><?php echo lang_line('Hello');?>, <?php echo $Booking->GUEST_FIRSTNAME;?></h3>
                    <span class="msgvcr"><?php echo lang_line('Booking_Voucher_Msg');?></span>
                </div>
                <div class="clear"></div>
                
                <div class="topvmsg">
                  <h3 class="detailhedv2"><?php echo lang_line('ITINERY');?></h3>

                <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry"><?php echo lang_line('BOOKING_STATUS');?>:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $Booking->booking_status;?></strong></div>
                        </div>
                    </div>
                    <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry"><?php echo lang_line('CONF_NO');?>:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $Booking->pnr_no;?></strong></div>
                        </div>
                    </div>                     <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry"><?php echo lang_line('RESERVATION_CODE');?>:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $Booking->booking_no;?></strong></div>
                        </div>
                    </div> 


                      <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry"><?php echo lang_line('HOTEL_RESERVATION_CODE');?>:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo ($Booking->ReservationLocatorCode!=null)?$Booking->ReservationLocatorCode:"N/A";?></strong></div>
                        </div>
                    </div> 
                </div>
                
                
                
                <div class="topvmsg">
                  <a href="#" target="new"><h5><?php echo $Booking->hotel_name;?>, <?php echo $Booking->city;?></h5></a>
                     <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry"><?php echo lang_line('ROOM_TYPE');?>:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $Booking->room_name;?></strong></div>
                        </div>
                    </div>
                    
                     <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry"><?php echo lang_line('NO_OF_NIGHTS');?>:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $number_of_nights; ?></strong></div>
                        </div>
                    </div>
                    <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry"><?php echo lang_line('GUESTS');?>:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $Booking->adult;?></strong></div>
                        </div>
                    </div>

                </div>
                
                <div class="topvmsg">
                  <div class="col-md-5">
                      <div class="wrpdte">
                          <span class="incty"><?php echo lang_line('CHECKIN');?></span>
                            <div class="alldatecty">
                              <?php echo date('D, M', strtotime($Booking->checkin));?><strong> <?php echo date('d', strtotime($Booking->checkin));?></strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                      <div class="aropng">&nbsp;</div>
                    </div>
                    <div class="col-md-5">
                      <div class="wrpdte">
                          <span class="incty"><?php echo lang_line('CHECKOUT');?></span>
                            <div class="alldatecty">
                              <?php echo date('D, M', strtotime($Booking->checkout));?><strong> <?php echo date('d', strtotime($Booking->checkout));?></strong>
                            </div>
                        </div>
                    </div>
                </div>
               </div> 
            </div>
            <div class="col-md-12">
              <div class="othrdetsv nopad">
                  
                    <div class="rowhost">
                      
                        <div class="hostvdets">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
        <tbody>
        <tr>
         <td align="left" valign="top" style="background:#eeeeee"><strong><?php echo lang_line('BOOKING_AMNT');?> </strong></td>

          <td align="left" valign="top" style="background:#eeeeee"><strong><?php echo lang_line('ACTUAL_PRICE');?></strong></td>
          <td align="left" valign="top" style="background:#eeeeee"><strong><?php echo lang_line('PROFITE');?></strong></td>
        
        </tr>
        <tr>
         <td align="left" valign="top" style="background:#fff"><?php echo CURR_ICON.' '.$Booking->total_cost;?> </td>

          <td align="left" valign="top" style="background:#fff"><?php echo CURR_ICON.' '.($Booking->total_cost - $Booking->MyMarkup);?></td>
          <td align="left" valign="top" style="background:#fff"><?php echo CURR_ICON.' '.$Booking->MyMarkup;?></td>
        
          </tr>
      </tbody></table>
                        </div>
                    </div>
                    

                    
                     
                    
                    
                </div>
            </div>

            
            <div class="col-md-12">
              <div class="othrdetsv nopad">
                  
                    <div class="rowhost">
                      <h3 class="hosthed"><?php echo lang_line('NAME');?>: <strong><?php echo $Booking->leadpax;?></strong></h3>
                        <div class="hostvdets">
                          <span class="namehstdets">
                               <p><?php echo lang_line('HOTEL_INVOICE_MSG');?></p> 
                <p><?php echo lang_line('Booking_Voucher_Msg');?></p>
                <br />
                <br />
                <p><?php echo lang_line('HOTEL_INVOICE_REGARDS');?><br />
                 <?php echo WEB_NAME;?></p>
                            </span>
                        </div>
                    </div>
                    

                    
                     
                    
                    
                </div>
            </div>
            
        </div>
    </div>
</div>
</div>
</div>
</div>