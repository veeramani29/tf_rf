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
              <span class="msgvcr"><?php echo lang_line('Booking_Voucher_Msg');?></span>
            </div>
            <div class="clear"></div>
            <div class="topvmsg">
              <h3 class="detailhedv2"><?php echo lang_line('ITINERY');?></h3>
              <table class="table table-bordered table-50">
                <tbody>
                  <tr>
                    <td><?php echo lang_line('BOOKING_STATUS');?>:</td>
                    <td><strong><?php echo $Booking->booking_status;?></strong></td>
                  </tr>
                  <tr>
                    <td><?php echo lang_line('CONF_NO');?>:</td>
                    <td><strong><?php echo $Booking->pnr_no;?></strong></td>
                  </tr>
                  <tr>
                    <td><?php echo lang_line('RESERVATION_CODE');?>:</td>
                    <td><strong><?php echo $Booking->booking_no;?></strong></td>
                  </tr>
                  <tr>
                    <td><?php echo lang_line('HOTEL_RESERVATION_CODE');?>:</td>
                    <td><strong><?php echo ($Booking->ReservationLocatorCode!=null)?$Booking->ReservationLocatorCode:"N/A";?></strong></td>
                  </tr>
                </tbody>
              </table>
          </div>

          <div class="topvmsg">
            <a href="#" target="new">
              <h5><?php echo $Booking->hotel_name;?>, <?php echo $Booking->city;?></h5>
            </a>
            <table class="table table-bordered">
              <tr>
                <td width="25%"><div class="labliternry"><?php echo lang_line('ROOM_TYPE');?>:</div></td>
                <td><strong><?php echo $Booking->room_name;?></strong></td>
              </tr>
              <tr>
                <td><?php echo lang_line('NO_OF_NIGHTS');?>:</td>
                <td><strong><?php echo $number_of_nights; ?></strong></td>
              </tr>
              <tr>
                <td><?php echo lang_line('GUESTS');?>:</td>
                <td><strong><?php echo $Booking->adult;?></strong></td>
              </tr>
            </table>
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
              <table class="table table-bordered mart15">
                <tbody>
                  <tr>
                    <td valign="top" style="background:#eeeeee">
                      <strong><?php echo lang_line('BOOKING_AMNT');?> </strong>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top"><?php echo CURR_ICON.' '.$Booking->total_cost;?> </td>
                  </tr>
                </tbody>
              </table>
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






