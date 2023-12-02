<?php $this->load->view('common/header');?>
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
                  <h3 class="heloma">Hello, <?php echo $Booking->GUEST_FIRSTNAME;?></h3>
                    <span class="msgvcr">Thank You for hotel booking with Reservation Factory. Please note down all reservation codes</span>
                </div>
                <div class="clear"></div>
                
                <div class="topvmsg">
                  <h3 class="detailhedv2">Itinerary</h3>

                <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry">Booking Status:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $Booking->booking_status;?></strong></div>
                        </div>
                    </div>
                    <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry">Confirmation No:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $Booking->pnr_no;?></strong></div>
                        </div>
                    </div>                     <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry">Reservation code:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $Booking->booking_no;?></strong></div>
                        </div>
                    </div> 


                      <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry">Hotel Reservation Code:</div>
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
                            <div class="labliternry">Room Type:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $Booking->room_name;?></strong></div>
                        </div>
                    </div>
                    
                     <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry">Number of nights:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $number_of_nights; ?></strong></div>
                        </div>
                    </div>
                    <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry">Guests:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $Booking->adult;?></strong></div>
                        </div>
                    </div>

                </div>
                
                <div class="topvmsg">
                  <div class="col-md-5">
                      <div class="wrpdte">
                          <span class="incty">Check In</span>
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
                          <span class="incty">Check Out</span>
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
         <td align="left" valign="top" style="background:#eeeeee"><strong>Booking Amount </strong></td>

          <td align="left" valign="top" style="background:#eeeeee"><strong>Actual Price</strong></td>
          <td align="left" valign="top" style="background:#eeeeee"><strong>Profit</strong></td>
        
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
                      <h3 class="hosthed">Guest Name: <strong><?php echo $Booking->leadpax;?></strong></h3>
                        <div class="hostvdets">
                          <span class="namehstdets">
                              <p>You're advised to print the Voucher in the attachment above for your convenience. You're requested to present this voucher upon your arrival at hotel front desk. </p> 
                              <p>Thank you for using Reservation Factory online booking system. </p>
                              <br />
                              <br />
                              <p>With Compliments and Regards,<br />
                               Reservation Factory Management</p>
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






