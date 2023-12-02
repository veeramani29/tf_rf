<html>
    <head>
        <title>Manage Orders | <?php echo PROJECT_NAME;?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta content='text/html;charset=utf-8' http-equiv='content-type'>
        
        <link href='<?= base_url(); ?><?= base_url(); ?>assets/images/meta_icons/favicon.ico' rel='shortcut icon' type='image/x-icon'>
        <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon.png' rel='apple-touch-icon-precomposed'>
        <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon-57x57.png' rel='apple-touch-icon-precomposed' sizes='57x57'>
        <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon-72x72.png' rel='apple-touch-icon-precomposed' sizes='72x72'>
        <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon-114x114.png' rel='apple-touch-icon-precomposed' sizes='114x114'>
        <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon-144x144.png' rel='apple-touch-icon-precomposed' sizes='144x144'>
        <!-- / START - page related stylesheets [optional] -->
        <link href="<?= base_url(); ?>assets/stylesheets/plugins/lightbox/lightbox.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/stylesheets/plugins/datatables/bootstrap-datatable.css" media="all" rel="stylesheet" type="text/css" />
        <!-- / END - page related stylesheets [optional] -->
        <!-- / bootstrap [required] -->
        <link href="<?= base_url(); ?>assets/stylesheets/bootstrap/bootstrap.css" media="all" rel="stylesheet" type="text/css" />
        <!-- / theme file [required] -->
        <link href="<?= base_url(); ?>assets/stylesheets/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
        <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
        <link href="<?= base_url(); ?>assets/stylesheets/theme-colors.css" media="all" rel="stylesheet" type="text/css" />
        <!-- / demo file [not required!] -->
        <link href="<?= base_url(); ?>assets/stylesheets/demo.css" media="all" rel="stylesheet" type="text/css" />
        <!--[if lt IE 9]>
          <script src="<?= base_url(); ?>assets/javascripts/ie/html5shiv.js" type="text/javascript"></script>
          <script src="<?= base_url(); ?>assets/javascripts/ie/respond.min.js" type="text/javascript"></script>
        <![endif]-->

        <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery-1.10.2.js" type="text/javascript"></script>

<link href="<?php echo ASSETS;?>css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php echo ASSETS;?>css/custom.css" rel="stylesheet" media="screen">

<style type="text/css">

.centervoucher2 {
width: 90%;
}    
</style>

        <script language="javascript">
        //frm is the form element
            function checkForm(frm) {
                var destCount = frm.elements['cid[]'].length;
                var destSel = false;
                for (i = 0; i < destCount; i++) {
                    if (frm.elements['cid[]'][i].checked) {
                        destSel = true;
                        break;
                    }
                }

                if (!destSel) {
                    alert('Select one or more B2C Users');
                }
                return destSel;
            }
        </script>




        <script type="text/javascript">
            function submitform()
            {
                if (document.myform.onsubmit &&
                        !document.myform.onsubmit())
                {
                    return;
                }
                document.myform.submit();
            }
        </script>




    </head>
<body class='contrast-dark fixed-header'>
        <?php $this->load->view('header'); ?>
        <div id='wrapper'>
            
            <?php $this->load->view('side-menu'); ?>
            <section id='content'>
                <div class='container'>    
<div class="full marintopcnt contentvcr" id="voucher">
    <div class="container">
        <div class="container offset-0">
        
        <div class="centervoucher2">
        
            <div class="col-md-12">
                <div class="alliconfrmt">
                    <a class="tooltipv iconsofvcr icon icon-print" title="Print Voucher" onclick="PrintDiv();"></a>
                    <!-- <a class="tooltipv iconsofvcr icon icon-envelope" title="Mail Voucher"></a> -->
                </div>
            </div>
            
            <div class="clear"></div>
            
            <div class="col-md-6">
                <div class="vocrlogo"><img src="<?php echo ASSETS;?>images/logo.png" alt="<?php echo PROJECT_NAME;?> Logo" /></div>
            </div>
            
            <div class="col-md-6">
                <div class="vcradrss">
                   <?php  echo $voucher_details->flight_cl_address; ?>
         <div class="iconmania"><span class="icon icon-envelope"></span><a> <?php echo $voucher_details->flight_cl_email; ?></a></div>
         <div class="iconmania"><span class="icon icon-phone"></span> <?php echo $voucher_details->flight_cl_phone; ?></div>
                </div>
            </div>
            <div class="clear"></div>
        <br />
            <div class="col-md-12">
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
  <tbody><tr>
    <td width="100%" style="line-height:22px;">
        <div class="confirmtionltr">Confirmation Letter</div>
    </td>
  </tr>
  
    <tr>
      <td align="center">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td width="50%" align="left" valign="top">
         
        <table width="100%" border="0" cellspacing="1" cellpadding="7" bgcolor="#FFFFFF">
          <tbody>
            <tr>
              <td colspan="2" align="left">
                <strong style="font-size:18px;">
                 <?php echo $Booking->leadpax;?>                 </strong>
              </td>
            </tr>
            <tr>
              <td width="50%" align="left">Airline PNR :</td>
              <td width="50%" align="left"><strong><?php echo ($Booking->ReservationLocatorCode!='')?$Booking->ReservationLocatorCode:'N/A';;?></strong></td>
            </tr>
            <tr>
              <td width="50%" align="left">Confirmation No :</td>
              <td width="50%" align="left"><strong><?php echo $Booking->pnr_no;?></strong></td>
            </tr>
            <tr>
              <td width="50%" align="left">RESERVATION CODE  :</td>
              <td width="50%" align="left"><strong><?php echo ($Booking->booking_no!='')?$Booking->booking_no:'N/A';?></strong></td>
            </tr>
            <tr>
              <td width="50%" align="left">STATUS  :</td>
              <td width="50%" align="left"><strong><?php echo $Booking->booking_status;?></strong></td>
            </tr>
          </tbody>
        </table></td>
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
          </table></td>
      </tr>
      </tbody></table>
      </td>
    </tr>
    
    <tr>
        <td style="height:20px;width:100%;"></td>
    </tr>
    <?php 
      $flight = json_decode(base64_decode($Booking->response));
      $request = json_decode(base64_decode($Booking->request));
      
      if($request->type == 'O'){
      foreach ($flight->segments as $key => $segment) {
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
        DEPARTURE:
        <?php echo date('D, d M', $this->booking_model->get_unixtimestamp($segment->DepartureTime));?>
        </div>
        <div class="snotes">
        Please verify flight times prior to departure
        </div>
    </div>
    </td>
    </tr>
  <tr>
    <td width="25%" rowspan="2" style="border-right: 1px solid #eee;">
    <div class="padwithbord">
        <div class="leftflitmg">
            <img src="https://www.amadeus.net/static/img/static/airlines/small/<?php echo $segment->Carrier;?>.png" />
        </div>
        <div class="fligtdetss">
        <?php echo $this->booking_model->get_airline_name($segment->Carrier);?> <br />
        <?php echo $segment->Carrier;?>  <?php echo $segment->FlightNumber;?>  
        </div>
        <div class="opfligt"> Operated by: <strong><?php echo ($segment->OperatingCarrier != "") ? $segment->OperatingCarrier : "-" ;?></strong></div>
    
        <div class="opfligt">Duration: <strong><?php echo $this->booking_model->get_duration($this->booking_model->get_unixtimestamp($segment->DepartureTime),$this->booking_model->get_unixtimestamp($segment->ArrivalTime));?></strong></div>
    </div>
  </td>
    
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;">
    <span style="font-size:16px; font-weight:bold;"><?php echo $segment->Origin;?></span><br><?php echo $this->booking_model->get_airport_name($segment->Origin);?>
    </td>
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; font-weight:bold;"><?php echo $segment->Destination;?></span><br><?php echo $this->booking_model->get_airport_name($segment->Destination);?></td>
    <td width="25%" rowspan="2" bgcolor="#FFFFFF">Aircraft:<br><?php echo ($segment->Equipment!=null)?$segment->Equipment:'';?> <br><br>
Booking Class: <?php echo $segment->CabinClass;?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Departing At:<br><span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->booking_model->get_unixtimestamp($segment->DepartureTime));?></span><br></td>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Arriving At:<br><span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->booking_model->get_unixtimestamp($segment->ArrivalTime));?></span><br>
</td>
    </tr>
        </tbody></table>

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
      <td align="center" bgcolor="#ffffff" class="padding1" style="border: 1px solid #eee;">
        <table width="100%" border="0" cellspacing="0" cellpadding="7" bgcolor="#FFFFFF" class="paddingTableTable">
  <tbody>
  <tr>
    <td colspan="4" bgcolor="#FFFFFF" style="border-bottom: 1px solid #eee;">
    <div class="dterser">
        <div class="colsdets">
        <img src="<?php echo ASSETS;?>voucher/images/flight-icon.png" width="23" height="25">
        DEPARTURE:
        <?php echo date('D, d M', $this->booking_model->get_unixtimestamp($segment->DepartureTime));?>
        </div>
        <div class="snotes">
        Please verify flight times prior to departure
        </div>
    </div>
    </td>
    </tr>
  <tr>
    <td width="25%" rowspan="2" style="border-right: 1px solid #eee;">
    <div class="padwithbord">
        <div class="leftflitmg">
            <img src="https://www.amadeus.net/static/img/static/airlines/small/<?php echo $segment->Carrier;?>.png" />
        </div>
        <div class="fligtdetss">
        <?php echo $this->booking_model->get_airline_name($segment->Carrier);?> <br />
        <?php echo $segment->Carrier;?>  <?php echo $segment->FlightNumber;?>  
        </div>
        <div class="opfligt"> Operated by: <strong><?php echo ($segment->OperatingCarrier != "") ? $segment->OperatingCarrier : "-" ;?></strong></div>
    
        <div class="opfligt">Duration: <strong><?php echo $this->booking_model->get_duration($this->booking_model->get_unixtimestamp($segment->DepartureTime),$this->booking_model->get_unixtimestamp($segment->ArrivalTime));?></strong></div>
    </div>
  </td>
    
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;">
    <span style="font-size:16px; font-weight:bold;"><?php echo $segment->Origin;?></span><br><?php echo $this->booking_model->get_airport_name($segment->Origin);?>
    </td>
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; font-weight:bold;"><?php echo $segment->Destination;?></span><br><?php echo $this->booking_model->get_airport_name($segment->Destination);?></td>
    <td width="25%" rowspan="2" bgcolor="#FFFFFF">Aircraft:<br><?php echo ($segment->Equipment!=null)?$segment->Equipment:'';?> <br><br>
Booking Class: <?php echo $segment->CabinClass;?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Departing At:<br><span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->booking_model->get_unixtimestamp($segment->DepartureTime));?></span><br></td>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Arriving At:<br><span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->booking_model->get_unixtimestamp($segment->ArrivalTime));?></span><br>
</td>
    </tr>
        </tbody></table>

      </td>
    </tr>
    <?php }?>
    <?php 
      foreach ($flight->return->segments as $key => $segment) {
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
        DEPARTURE:
        <?php echo date('D, d M', $this->booking_model->get_unixtimestamp($segment->DepartureTime));?>
        </div>
        <div class="snotes">
        Please verify flight times prior to departure
        </div>
    </div>
    </td>
    </tr>
  <tr>
    <td width="25%" rowspan="2" style="border-right: 1px solid #eee;">
    <div class="padwithbord">
        <div class="leftflitmg">
            <img src="https://www.amadeus.net/static/img/static/airlines/small/<?php echo $segment->Carrier;?>.png" />
        </div>
        <div class="fligtdetss">
        <?php echo $this->booking_model->get_airline_name($segment->Carrier);?> <br />
        <?php echo $segment->Carrier;?>  <?php echo $segment->FlightNumber;?>  
        </div>
        <div class="opfligt"> Operated by: <strong><?php echo ($segment->OperatingCarrier != "") ? $segment->OperatingCarrier : "-" ;?></strong></div>
    
        <div class="opfligt">Duration: <strong><?php echo $this->booking_model->get_duration($this->booking_model->get_unixtimestamp($segment->DepartureTime),$this->booking_model->get_unixtimestamp($segment->ArrivalTime));?></strong></div>
    </div>
  </td>
    
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;">
    <span style="font-size:16px; font-weight:bold;"><?php echo $segment->Origin;?></span><br><?php echo $this->booking_model->get_airport_name($segment->Origin);?>
    </td>
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; font-weight:bold;"><?php echo $segment->Destination;?></span><br><?php echo $this->booking_model->get_airport_name($segment->Destination);?></td>
    <td width="25%" rowspan="2" bgcolor="#FFFFFF">Aircraft:<br><?php echo ($segment->Equipment!=null)?$segment->Equipment:'';?> <br><br>
Booking Class: <?php echo $segment->CabinClass;?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Departing At:<br><span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->booking_model->get_unixtimestamp($segment->DepartureTime));?></span><br></td>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Arriving At:<br><span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->booking_model->get_unixtimestamp($segment->ArrivalTime));?></span><br>
</td>
    </tr>
        </tbody></table>

      </td>
    </tr>
    <tr>
      <td style="height:20px;width:100%;"></td>
    </tr>
    <?php }} else if($request->type == 'M') { 
    foreach ($flight->segments as $key => $segment) { ?>
    <tr>
      <td align="center" bgcolor="#ffffff" class="padding1" style="border: 1px solid #eee;">
        <table width="100%" border="0" cellspacing="0" cellpadding="7" bgcolor="#FFFFFF" class="paddingTableTable">
  <tbody>
  <tr>
    <td colspan="4" bgcolor="#FFFFFF" style="border-bottom: 1px solid #eee;">
    <div class="dterser">
        <div class="colsdets">
        <img src="<?php echo ASSETS;?>voucher/images/flight-icon.png" width="23" height="25">
        DEPARTURE:
        <?php echo date('D, d M', $this->booking_model->get_unixtimestamp($segment->DepartureTime));?>
        </div>
        <div class="snotes">
        Please verify flight times prior to departure
        </div>
    </div>
    </td>
    </tr>
  <tr>
    <td width="25%" rowspan="2" style="border-right: 1px solid #eee;">
    <div class="padwithbord">
        <div class="leftflitmg">
            <img src="https://www.amadeus.net/static/img/static/airlines/small/<?php echo $segment->Carrier;?>.png" />
        </div>
        <div class="fligtdetss">
        <?php echo $this->booking_model->get_airline_name($segment->Carrier);?> <br />
        <?php echo $segment->Carrier;?>  <?php echo $segment->FlightNumber;?>  
        </div>
        <div class="opfligt"> Operated by: <strong><?php echo ($segment->OperatingCarrier != "") ? $segment->OperatingCarrier : "-" ;?></strong></div>
    
        <div class="opfligt">Duration: <strong><?php echo $this->booking_model->get_duration($this->booking_model->get_unixtimestamp($segment->DepartureTime),$this->booking_model->get_unixtimestamp($segment->ArrivalTime));?></strong></div>
    </div>
  </td>
    
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;">
    <span style="font-size:16px; font-weight:bold;"><?php echo $segment->Origin;?></span><br><?php echo $this->booking_model->get_airport_name($segment->Origin);?>
    </td>
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; font-weight:bold;"><?php echo $segment->Destination;?></span><br><?php echo $this->booking_model->get_airport_name($segment->Destination);?></td>
    <td width="25%" rowspan="2" bgcolor="#FFFFFF">Aircraft:<br><?php echo ($segment->Equipment!=null)?$segment->Equipment:'';?> <br><br>
Booking Class: <?php echo $segment->CabinClass;?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Departing At:<br><span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->booking_model->get_unixtimestamp($segment->DepartureTime));?></span><br></td>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Arriving At:<br><span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->booking_model->get_unixtimestamp($segment->ArrivalTime));?></span><br>
</td>
    </tr>
        </tbody></table>

      </td>
    </tr>
    <tr>
      <td style="height:20px;width:100%;"></td>
    </tr>    
    
    <?php }} ?>
    
    

  
  <tr>
    <td>
      
     <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
       
        <tbody>
        <tr>
            <td colspan="4"><div class="detailhed">Traveller Details (Lead Passenger)</div></td>
        </tr>
        <tr style="background:#eeeeee">
          <th align="left" valign="top"><strong>S No </strong></th>
          <th align="left" valign="top"><strong>Given Name </strong></th>
          <th align="left" valign="top"><strong>Surname </strong></th>
          <th align="left" valign="top"><strong>D.O.B </strong></th>
        </tr>
        
        <tr style="background:#ffffff">
          <td>1</td>
          <td><?php echo $Booking->GUEST_FIRSTNAME;?></td>
          <td><?php echo $Booking->GUEST_LASTNAME;?></td>
          <td>-</td>
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
    

      <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">


        <tbody>
        <tr>
            <td colspan="2"><div class="detailhed">Customer Details</div></td>
        </tr>
        <tr>
          <td width="20%" align="left" style="background:#eeeeee"><strong>Email ID</strong></td>
          <td width="80%" align="left" style="background:#ffffff"><?php echo $Booking->BILLING_EMAIL;?></td>
        </tr>
        <tr>
          <td align="left" style="background:#eeeeee"><strong>Mobile Number</strong></td>
          <td align="left" style="background:#ffffff"><?php echo $Booking->BILLING_PHONE;?></td>
        </tr>
      </tbody></table>
  </td>
  </tr>
  

                
</tbody></table>

 
    
    
    </td>
  </tr>
  <tr>
        <td style="height:20px;width:100%;"></td>
    </tr>
  <tr>
    <td colspan="2">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
        <tbody>
        <tr>
            <td><div class="detailhed">Terma & Conditions </div></td>
        </tr>
        <tr>
          <td align="left" valign="top" style="padding:0 10px;">
          <div class="paratems">
 <?php echo $voucher_details->flight_cl_terms; ?>
</div>
</td>
          </tr>
      </tbody></table></td>
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
                <?php $this->load->view('footer'); ?>
                </div>
            </section>
        </div>
       <!-- / jquery [required] -->

        <!-- / jquery mobile (for touch events) -->
        <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery.mobile.custom.min.js" type="text/javascript"></script>
        <!-- / jquery migrate (for compatibility with new jquery) [required] -->
        <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery-migrate.min.js" type="text/javascript"></script>
        <!-- / jquery ui -->
        <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery-ui.min.js" type="text/javascript"></script>
        <!-- / jQuery UI Touch Punch -->
        <script src="<?= base_url(); ?>assets/javascripts/plugins/jquery_ui_touch_punch/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
        <!-- / bootstrap [required] -->
        <script src="<?= base_url(); ?>assets/javascripts/bootstrap/bootstrap.js" type="text/javascript"></script>
        <!-- / modernizr -->
        <script src="<?= base_url(); ?>assets/javascripts/plugins/modernizr/modernizr.min.js" type="text/javascript"></script>
        <!-- / retina -->
        <script src="<?= base_url(); ?>assets/javascripts/plugins/retina/retina.js" type="text/javascript"></script>
        <!-- / theme file [required] -->
        <script src="<?= base_url(); ?>assets/javascripts/theme.js" type="text/javascript"></script>
        <!-- / demo file [not required!] -->
        <script src="<?= base_url(); ?>assets/javascripts/demo.js" type="text/javascript"></script>
        <!-- / START - page related files and scripts [optional] -->
        <script src="<?= base_url(); ?>assets/javascripts/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/datatables/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/datatables/dataTables.overrides.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/lightbox/lightbox.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/validate/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/validate/additional-methods.js" type="text/javascript"></script>
        <!-- / END - page related files and scripts [optional] -->
    </body>

    <script type="text/javascript">
        function activate(that) { window.location.href = that; }
    </script>
</html>