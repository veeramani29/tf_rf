<?php $this->load->view('common/header');?>
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
            	<?php if($Booking->user_type == '3'){?>
                    <img src="<?php echo ASSETS;?>images/logo.png" alt="InnoGlobe Logo" />
                <?php 
                    }else if($Booking->user_type == '2'){
                    $agent_d = $this->account_model->GetUserData($global->user_type, $global->user_id)->row();
                ?>
                    <img src="<?php echo $agent_d->agent_logo;?>" alt="<?php echo $agent_d->company_name;?> Logo" width="100"/> 
                <?php }?>
            </div>
            
            <div class="col-md-6">
            	<div class="vcradrss">
                	<?php if($Booking->user_type == '3'){?>
                    InnoGlobe office address<br />
                    Location of office
                    <div class="iconmania"><span class="icon icon-envelope"></span><a>office@bookhotac.com</a></div>
                    <div class="iconmania"><span class="icon icon-phone"></span> +91 123 456 7890</div>
                <?php 
                    }else if($Booking->user_type == '2'){
                    $agent_d = $this->account_model->GetUserData($global->user_type, $global->user_id)->row();
                ?>
                    <?php echo $agent_d->company_name;?><br />
                   <?php if($agent_d->city != '' || $agent_d->city != NULL){ echo $agent_d->city;}?>
                    <div class="iconmania"><span class="icon icon-envelope"></span><a><?php echo $agent_d->email_id;?></a></div>
                    <div class="iconmania"><span class="icon icon-phone"></span> <?php echo $agent_d->mobile;?></div>
                <?php }?>
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
  <!--<tr>
    <td width="100%" style="line-height:22px;">
    <div class="firsttrip">
    	<div class="col-md-5">
            <div class="deprtbox">
                <span class="deperlabl">Departure</span>
                <span class="lablsrong">Dubai-Dubai Intl, United Arab Emirates</span>
                <span class="datelbl"><img src="<?php echo ASSETS;?>images/cals.png" /> Thu, 13 Nov 2014</span>
            </div>
        </div>
        <div class="col-md-2">
        	<div class="flightdir"><img src="<?php echo ASSETS;?>images/flightdir.png" alt="" /></div>
        </div>
        <div class="col-md-5">
            <div class="deprtbox textalignrit">
                <span class="deperlabl">Arrival</span>
                <span class="lablsrong">Istanbul-Ataturk, Turkey</span>
                <span class="datelbl"><img src="<?php echo ASSETS;?>images/cals.png" /> Thu, 13 Nov 2014</span>
            </div>
        </div>
     </div> 
    </td>
  </tr>-->
 
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
              <td width="50%" align="left">Confirmation No  :</td>
              <td width="50%" align="left"><strong><?php echo $Booking->pnr_no;?></strong></td>
            </tr>
            <tr>
              <td width="50%" align="left">Booking Status  :</td>
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
        <?php echo date('D, d M', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?>
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
        <?php echo $this->flight_model->get_airline_name($segment->Carrier);?> <br />
        <?php echo $segment->Carrier;?>  <?php echo $segment->FlightNumber;?>  
        </div>
        <div class="opfligt"> Operated by: <strong><?php echo $segment->OperatingCarrier;?></strong></div>
    
        <div class="opfligt">Duration: <strong><?php echo $this->flight_model->get_duration($this->flight_model->get_unixtimestamp($segment->DepartureTime),$this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></strong></div>
    </div>
	</td>
    
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;">
    <span style="font-size:16px; font-weight:bold;"><?php echo $segment->Origin;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Origin);?>
    </td>
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; font-weight:bold;"><?php echo $segment->Destination;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Destination);?></td>
    <td width="25%" rowspan="2" bgcolor="#FFFFFF">Aircraft:<br><?php echo $segment->Equipment;?> <br><br>
Booking Class: <?php echo $segment->CabinClass;?><br>
Stop(s): 0</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Departing At:<br><span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></span><br></td>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Arriving At:<br><span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span><br>
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
        <?php echo date('D, d M', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?>
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
        <?php echo $this->flight_model->get_airline_name($segment->Carrier);?> <br />
        <?php echo $segment->Carrier;?>  <?php echo $segment->FlightNumber;?>  
        </div>
        <div class="opfligt"> Operated by: <strong><?php echo $segment->OperatingCarrier;?></strong></div>
    
        <div class="opfligt">Duration: <strong><?php echo $this->flight_model->get_duration($this->flight_model->get_unixtimestamp($segment->DepartureTime),$this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></strong></div>
    </div>
  </td>
    
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;">
    <span style="font-size:16px; font-weight:bold;"><?php echo $segment->Origin;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Origin);?>
    </td>
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; font-weight:bold;"><?php echo $segment->Destination;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Destination);?></td>
    <td width="25%" rowspan="2" bgcolor="#FFFFFF">Aircraft:<br><?php echo $segment->Equipment;?> <br><br>
Booking Class: <?php echo $segment->CabinClass;?><br>
Stop(s): 0</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Departing At:<br><span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></span><br></td>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Arriving At:<br><span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span><br>
</td>
    </tr>
        </tbody></table>

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
      <td align="center" bgcolor="#ffffff" class="padding1" style="border: 1px solid #eee;">
        <table width="100%" border="0" cellspacing="0" cellpadding="7" bgcolor="#FFFFFF" class="paddingTableTable">
  <tbody>
  <tr>
    <td colspan="4" bgcolor="#FFFFFF" style="border-bottom: 1px solid #eee;">
    <div class="dterser">
        <div class="colsdets">
        <img src="<?php echo ASSETS;?>voucher/images/flight-icon.png" width="23" height="25">
        DEPARTURE:
        <?php echo date('D, d M', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?>
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
        <?php echo $this->flight_model->get_airline_name($segment->Carrier);?> <br />
        <?php echo $segment->Carrier;?>  <?php echo $segment->FlightNumber;?>  
        </div>
        <div class="opfligt"> Operated by: <strong><?php echo $segment->OperatingCarrier;?></strong></div>
    
        <div class="opfligt">Duration: <strong><?php echo $this->flight_model->get_duration($this->flight_model->get_unixtimestamp($segment->DepartureTime),$this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></strong></div>
    </div>
  </td>
    
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;">
    <span style="font-size:16px; font-weight:bold;"><?php echo $segment->Origin;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Origin);?>
    </td>
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; font-weight:bold;"><?php echo $segment->Destination;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Destination);?></td>
    <td width="25%" rowspan="2" bgcolor="#FFFFFF">Aircraft:<br><?php echo $segment->Equipment;?> <br><br>
Booking Class: <?php echo $segment->CabinClass;?><br>
Stop(s): 0</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Departing At:<br><span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></span><br></td>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Arriving At:<br><span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span><br>
</td>
    </tr>
        </tbody></table>

      </td>
    </tr>
    <?php }?>
    <tr>
      <td style="height:20px;width:100%;"></td>
    </tr>
    <?php } else if($request->type == 'M') { 
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
        <?php echo date('D, d M', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?>
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
        <?php echo $this->flight_model->get_airline_name($segment->Carrier);?> <br />
        <?php echo $segment->Carrier;?>  <?php echo $segment->FlightNumber;?>  
        </div>
        <div class="opfligt"> Operated by: <strong><?php echo ($segment->OperatingCarrier != "") ? $segment->OperatingCarrier : "-";?></strong></div>
    
        <div class="opfligt">Duration: <strong><?php echo $this->flight_model->get_duration($this->flight_model->get_unixtimestamp($segment->DepartureTime),$this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></strong></div>
    </div>
  </td>
    
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;">
    <span style="font-size:16px; font-weight:bold;"><?php echo $segment->Origin;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Origin);?>
    </td>
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; font-weight:bold;"><?php echo $segment->Destination;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Destination);?></td>
    <td width="25%" rowspan="2" bgcolor="#FFFFFF">Aircraft:<br><?php echo $segment->Equipment;?> <br><br>
Booking Class: <?php echo $segment->CabinClass;?><br>
Stop(s): 0</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Departing At:<br><span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></span><br></td>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;">Arriving At:<br><span style="font-size:16px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span><br>
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
         <td align="left" valign="top" style="background:#eeeeee"><strong>Booking Amount </strong></td>
          <td align="left" valign="top" style="background:#eeeeee"><strong>Actual Price</strong></td>
          <td align="left" valign="top" style="background:#eeeeee"><strong>Profit</strong></td>
        </tr>
        <tr>
         <td align="left" valign="top" style="background:#fff"><?php echo CURR_ICON.' '.$Booking->TotalPrice;?> </td>
          <td align="left" valign="top" style="background:#fff"><?php echo CURR_ICON.' '.($Booking->TotalPrice - $Booking->MyMarkup);?></td>
          <td align="left" valign="top" style="background:#fff"><?php echo CURR_ICON.' '.$Booking->MyMarkup;?></td>
          
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