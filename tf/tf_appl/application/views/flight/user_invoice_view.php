<?php $this->load->view('common/header');

?>
<div class="full marintopcnt contentvcr" id="voucher">
    <div class="container">
        <div class="container offset-0">
        
        <div class="centervoucher2">
        
        	<div class="col-md-12">
                <div class="alliconfrmt">
                    <a class="tooltipv iconsofvcr icon icon-print" title="<?=lang('Print Voucher');?>" onclick="PrintDiv();"></a>
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
                    <img src="<?php echo $agent_d->agent_logo;?>" alt="<?php echo $agent_d->company_name;?> Logo" width="50"/> 
                <?php }?>
            </div>
            
            <div class="col-md-6">
            	<div class="vcradrss">
                	<?php if($Booking->user_type == '3'){?>
                    <?php echo $voucher_details->in_address; ?>
                
                    <div class="iconmania"><span class="icon icon-envelope"></span><a> <?php echo $voucher_details->in_email; ?></a></div>
                    <div class="iconmania"><span class="icon icon-phone"></span> <?php echo $voucher_details->in_phone; ?></div>
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
    <td width="100%" style="line-height:22px; text-align:center">
    	<div class="confirmtionltr"><?=lang('Invoice');?></div>
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
                 <?php echo strtoupper($Booking->leadpax);?>  </strong>
              </td>
            </tr>
              <tr>
              <td width="50%" align="left"><?=lang('RESERVATION_CODE');?>  :</td>
              <td width="50%" align="left"><strong><?php echo ($Booking->AirReservationLocatorCode!='')?$Booking->AirReservationLocatorCode:"N/A";?></strong></td>
            </tr> 
             <?php
             $booking_response=json_decode($Booking->booking_res);
            
             ?>                                             
             <tr>
              <td width="50%" align="left">Universal <?=lang('RESERVATION_CODE');?>  :</td>
              <td width="50%" align="left"><strong><?php echo ($booking_response->LocatorCode!='')?$booking_response->LocatorCode:"N/A";?></strong></td>
            </tr>
            <tr>
              <td width="50%" align="left"><?=lang('Airline PNR');?>  :</td>
              <td width="50%" align="left"><strong><?php echo ($Booking->booking_no!='')?$Booking->booking_no:"N/A";?></strong></td>
            </tr> 
             <tr>
              <td width="50%" align="left">Universal  <?=lang('Airline PNR');?>  :</td>
              <td width="50%" align="left"><strong><?php echo ($booking_response->AirReservationLocatorCode!='')?$booking_response->AirReservationLocatorCode:"N/A";?></strong></td>
            </tr>
            <tr>
              <td width="50%" align="left"><?=lang('Confirmation No');?>  :</td>
              <td width="50%" align="left"><strong><?php echo $Booking->pnr_no;?></strong></td>
            </tr>
            <tr>
              <td width="50%" align="left"><?=lang('Booking Status');?>  :</td>
              <td width="50%" align="left"><strong><?php echo $Booking->booking_status;?></strong></td>
            </tr>
            
          </tbody>
        </table></td>
        <td width="50%" align="right" valign="top">
         <?=lang('Receive Payment');?> : <?php echo date('D, M d, Y', strtotime($Booking->voucher_date));?></td>
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
 ?>
    
    

  
  <tr>
    <td>
      
     <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
       
        <tbody>
        <tr>
        	<td colspan="4"><div class="detailhed"><?=lang('Payment Details');?></div></td>
            
        </tr>
        <tr style="background:#eeeeee">
          <th align="left" valign="top"><strong><?=lang('Flight Info');?> </strong></th>
          <th align="left" valign="top"><strong><?=lang('Base Fare');?> </strong></th>
          <th align="left" valign="top"><strong><?=lang('Tax');?> </strong></th>
          <th align="left" valign="top"><strong><?=lang('Total Amount');?> </strong></th>
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
                                <td><?php echo $this->flight_model->get_airport_cityname($origin);?> To <?php echo $this->flight_model->get_airport_cityname($destination);?> <?php echo ($request->type=='M')?'('.lang('MULTICITY').')':'';?></td>
          <td><?php echo $flight->BasePrice;?> $</td>
          <td><?php echo $flight->Taxes;?> $</td>
          <td><?php echo $flight->TotalPrice;?> $</td>
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
        	<td colspan="2"><div class="detailhed"><?=lang('Customer Details');?></div></td>
        </tr>
        <tr>
          <td width="20%" align="left" style="background:#eeeeee"><strong><?=lang('Email ID');?></strong></td>
          <td width="80%" align="left" style="background:#ffffff"><?php echo $Booking->BILLING_EMAIL;?></td>
        </tr>
        <tr>
          <td align="left" style="background:#eeeeee"><strong><?=lang('Mobile Number');?></strong></td>
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
<style>
.leftflitmg { max-width:70px !important } </style>
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