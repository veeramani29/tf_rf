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
            	
                    <img src="<?php echo ASSETS;?>images/logo.png" alt="<?=lang('SITE_NAME').' '.lang('Logo');?>" />
                
            </div>
            
            <div class="col-md-6">
            	<div class="vcradrss">
                
                    <?php echo $voucher_details->flight_cl_address; ?>
                
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
    <td width="100%" style="line-height:22px; text-align:center">
    	<div class="confirmtionltr"><?=lang('CONFIRMATION LETTER');?></div>
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
              <td width="50%" align="left"><?=lang('RESERVATION_CODE');?>  (PNR):</td>
              <td width="50%" align="left"><strong><?php echo ($Booking->AirReservationLocatorCode!='')?$Booking->AirReservationLocatorCode:"N/A";?></strong></td>
            </tr> 
             <?php
             $booking_response=json_decode($Booking->booking_res);
            
             ?>                                             
            <!--  <tr>
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
            </tr> -->
            <tr>
              <td width="50%" align="left"><?=lang('Confirmation No');?>  :</td>
              <td width="50%" align="left"><strong><?php echo ($Booking->pnr_no!='')?$Booking->pnr_no:"N/A";?></strong></td>
            </tr>
            
            <tr>
              <td width="50%" align="left"><?=lang('Booking Status');?>  :</td>
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
        <?=lang('DEPARTURE');?>:
        <?php echo date('D, d M', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?>
        </div>
        <div class="snotes">
        <?=lang('TIMING_MSG');?>
        </div>
    </div>
    </td>
    </tr>
  <tr>
    <td width="25%" rowspan="2" style="border-right: 1px solid #eee;">
    <div class="padwithbord">
        <div class="leftflitmg">
            <img src="<?php echo ASSETS;?>images/airline_logo/<?php echo $segment->Carrier;?>.gif" />
        </div>
        <div class="fligtdetss">
        <?php echo $this->flight_model->get_airline_name($segment->Carrier);?> <br />
        <?php echo $segment->Carrier;?>  <?php echo $segment->FlightNumber;?>  
        </div>
        <?php 
		if($segment->OperatingCarrier!='')
		{
			?>
        <div class="opfligt"> <?=lang('Operated by');?> : <strong><?php echo $segment->OperatingCarrier;?></strong></div>
        <?php
		}
		?>
    
        <div class="opfligt"><?=lang('DURATION');?> : <strong><?php echo $this->flight_model->get_duration(strtotime($segment->DepartureTime),strtotime($segment->ArrivalTime));?></strong></div>
    </div>
	</td>
    
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;">
    <span style="font-size:16px; font-weight:bold;"><?php echo $segment->Origin;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Origin);?>
    </td>
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; font-weight:bold;"><?php echo $segment->Destination;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Destination);?></td>
    <td width="25%" rowspan="2" bgcolor="#FFFFFF"><?=lang('Aircraft');?> : <?php echo (isset($segment->Equipment) && $segment->Equipment!=null)?$segment->Equipment:"-";?> <br><br>
<?=lang('Booking Class');?> : <?php echo $segment->CabinClass;?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;"><?=lang('Departing At');?> :<br><span style="font-size:13px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></span><br></td>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;"><?=lang('Arriving At');?> :<br><span style="font-size:13px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span><br>
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
        <?=lang('DEPARTURE');?>:
        <?php echo date('D, d M', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?>
        </div>
        <div class="snotes">
        <?=lang('TIMING_MSG');?>
        </div>
    </div>
    </td>
    </tr>
  <tr>
    <td width="25%" rowspan="2" style="border-right: 1px solid #eee;">
    <div class="padwithbord">
        <div class="leftflitmg">
            <img src="<?php echo ASSETS;?>images/airline_logo/<?php echo $segment->Carrier;?>.gif" />
        </div>
        <div class="fligtdetss">
        <?php echo $this->flight_model->get_airline_name($segment->Carrier);?> <br />
        <?php echo $segment->Carrier;?>  <?php echo $segment->FlightNumber;?>  
        </div>
         <?php 
		if($segment->OperatingCarrier!='')
		{
			?>
        <div class="opfligt"> <?=lang('Operated by');?> : <strong><?php echo $segment->OperatingCarrier;?></strong></div>
    <?php
		}
		?>
        <div class="opfligt"><?=lang('Duration');?> : <strong><?php echo $this->flight_model->get_duration(strtotime($segment->DepartureTime),strtotime($segment->ArrivalTime));?></strong></div>
    </div>
  </td>
    
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;">
    <span style="font-size:16px; font-weight:bold;"><?php echo $segment->Origin;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Origin);?>
    </td>
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; font-weight:bold;"><?php echo $segment->Destination;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Destination);?></td>
    <td width="25%" rowspan="2" bgcolor="#FFFFFF"><?=lang('Aircraft');?> : <?php echo isset($segment->Equipment)?$segment->Equipment:"N/A";?> <br><br>
<?=lang('Booking Class');?> : <?php echo $segment->CabinClass;?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;"><?=lang('Departing At');?> :<br><span style="font-size:13px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></span><br></td>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;"><?=lang('Arriving At');?> :<br><span style="font-size:13px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span><br>
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
        <?=lang('DEPARTURE');?>:
        <?php echo date('D, d M', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?>
        </div>
        <div class="snotes">
        <?=lang('TIMING_MSG');?>
        </div>
    </div>
    </td>
    </tr>
  <tr>
    <td width="25%" rowspan="2" style="border-right: 1px solid #eee;">
    <div class="padwithbord">
        <div class="leftflitmg">
            <img src="<?php echo ASSETS;?>images/airline_logo/<?php echo $segment->Carrier;?>.gif" />
        </div>
        <div class="fligtdetss">
        <?php echo $this->flight_model->get_airline_name($segment->Carrier);?> <br />
        <?php echo $segment->Carrier;?>  <?php echo $segment->FlightNumber;?>  
        </div>
         <?php 
		if($segment->OperatingCarrier!='')
		{
			?>
        <div class="opfligt"> <?=lang('Operated by');?> : <strong><?php echo $segment->OperatingCarrier;?></strong></div>
    <?php
		}
		?>
       <div class="opfligt"><?=lang('DURATION');?> : <strong><?php echo $this->flight_model->get_duration(strtotime($segment->DepartureTime),strtotime($segment->ArrivalTime));?></strong></div>
    </div>
  </td>
    
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;">
    <span style="font-size:16px; font-weight:bold;"><?php echo $segment->Origin;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Origin);?>
    </td>
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; font-weight:bold;"><?php echo $segment->Destination;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Destination);?></td>
    <td width="25%" rowspan="2" bgcolor="#FFFFFF"><?=lang('Aircraft');?> : <?php echo isset($segment->Equipment)?$segment->Equipment:"N/A";?> <br><br>
<?=lang('Booking Class');?> : <?php echo $segment->CabinClass;?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;"><?=lang('Departing At');?> :<br><span style="font-size:13px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></span><br></td>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;"><?=lang('Arriving At');?> :<br><span style="font-size:13px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span><br>
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
     foreach($flight->segments as $k) { 
                                if(is_array($k)){
                                  $onward_first_seg = reset($k);
                                  $onward_last_seg = end($k);
                                  $Stops = count($k)-1;
                                  $dur = $this->flight_model->get_duration(strtotime($onward_first_seg->DepartureTime),strtotime($onward_last_seg->ArrivalTime));
                                }else{
                                  $onward_first_seg = $k;
                                  $onward_last_seg = $k;
                                  $Stops = count($k)-1;
                                  $dur = $this->flight_model->get_duration(strtotime($onward_first_seg->DepartureTime),strtotime($onward_last_seg->ArrivalTime));
                                }
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
        <?=lang('DEPARTURE');?>:
        <?php echo date('D, d M', $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime));?>
        </div>
        <div class="snotes">
        <?=lang('TIMING_MSG)');?>
        </div>
    </div>
    </td>
    </tr>
  <tr>
    <td width="25%" rowspan="2" style="border-right: 1px solid #eee;">
    <div class="padwithbord">
        <div class="leftflitmg">
            <img src="<?php echo ASSETS;?>images/airline_logo/<?php echo $onward_first_seg->Carrier;?>.gif" />
        </div>
        <div class="fligtdetss">
        <?php echo $this->flight_model->get_airline_name($onward_first_seg->Carrier);?> <br />
        <?php echo $onward_first_seg->Carrier;?>  <?php echo $onward_first_seg->FlightNumber;?>  
        </div>
          <?php 
		if($onward_first_seg->OperatingCarrier!='')
		{
			?>
        <div class="opfligt"> <?=lang('Operated by');?> : <strong><?php echo ($onward_first_seg->OperatingCarrier != "") ? $onward_first_seg->OperatingCarrier : "-";?></strong></div>
    <?php
		}
		?>
        <div class="opfligt"><?lang('Duration');?> : <strong><?php echo $dur;?></strong></div>
    </div>
  </td>
    
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;">
    <span style="font-size:16px; font-weight:bold;"><?php echo $onward_first_seg->Origin;?></span><br><?php echo $this->flight_model->get_airport_name($onward_first_seg->Origin);?>
    </td>
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; font-weight:bold;"><?php echo $onward_last_seg->Destination;?></span><br><?php echo $this->flight_model->get_airport_name($onward_last_seg->Destination);?></td>
    <td width="25%" rowspan="2" bgcolor="#FFFFFF"><?=lang('Aircraft');?> : <?php echo $onward_first_seg->Equipment;?> <br><br>
<?=lang('Booking Class');?> : <?php echo $onward_first_seg->CabinClass;?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;"><?=lang('Departing At');?> :<br><span style="font-size:13px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime));?></span><br></td>
    <td bgcolor="#FFFFFF" style="border-right:1px solid #EEE;"><?=lang('Arriving At');?> :<br><span style="font-size:13px; font-weight:bold;"><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($onward_last_seg->ArrivalTime));?></span><br>
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
        	<td colspan="4"><div class="detailhed"><?lang('TDETAILS_LPASSENGER');?></div></td>
        </tr>
        <tr style="background:#eeeeee">
          <th align="left" valign="top"><strong><?=lang('S No');?> </strong></th>
          <th align="left" valign="top"><strong><?=lang('F_NAME');?> </strong></th>
          <th align="left" valign="top"><strong><?=lang('M_NAME');?> </strong></th>
           <th align="left" valign="top"><strong><?=lang('L_NAME');?> </strong></th>
          <th align="left" valign="top"><strong><?=lang('DOB');?> </strong></th>
        </tr>
        
        <tr style="background:#ffffff">
          <td>1</td>
          <td><?php echo $Booking->GUEST_FIRSTNAME;?></td>
          <td><?php echo $Booking->GUEST_MIDDLENAME;?></td>
          <td><?php echo $Booking->GUEST_LASTNAME;?></td>
          <td><?php echo $Booking->GUEST_DOB; ?></td>
        </tr>
        
        <?php
        
          $a=json_decode(base64_decode($Booking->passenger_details));
          $b=json_decode(base64_decode($Booking->passenger_full_details));
         // echo "<pre>";
       // print_r($b);
       
        if($request->ADT >1){
        for ($i=1; $i < $request->ADT; $i++) {
                $s=$i-1;
                $ss=$i+1;
                $audlt="adults"."$ss";
                 $doba=explode("/",$passengers->dob[$s]->$audlt);
                $doba=array_reverse($doba);
                $doba=implode("-",$doba);
                ?>
                <tr style="background:#ffffff">
          <td><?php echo $s++;?></td>
          <td><?php echo $b->first[$s]->$audlt;?></td>
          <td><?php echo ($b->middle[$s]->$audlt!='')?$b->middle[$s]->$audlt:"N/A";?></td>
          <td><?php echo $b->last[$s]->$audlt;?></td>
          <td><?php echo $doba; ?></td>
        </tr>
              <?php  }
                } ?>
       
       <?php     if($a->childs>0) { ?>
          <tr>
        	<td colspan="4"><div class="detailhed">Childs</div></td>
        </tr>
        <?php
         for ($i=0; $i < $request->CHD; $i++) { 
			 $aa=($request->ADT)-1; 
                 $s=$aa+$i;
                  $ss=$i+1;
             $child="childs"."$ss";
         $dobc=explode("/",$b->dob[$s]->$child);
        $dobc=array_reverse($dobc);
         $dobc=implode("-",$dobc);
         ?>
        <tr style="background:#ffffff">
          <td><?php echo $i+1;?></td>
          <td><?php echo $b->first[$s]->$child;?></td>
          <td><?php echo ($b->middle[$s]->$child!='')?$b->middle[$s]->$child:"N/A";?></td>
          <td><?php echo $b->last[$s]->$child;?></td>
          <td><?php echo $dobc; ?></td>
        </tr>
        <?php } } 
        
          if($a->infants>0) { ?>
          <tr>
        	<td colspan="4"><div class="detailhed">Infants</div></td>
        </tr>
        <?php
         for ($i=0; $i < $request->INF; $i++) { 
             $aa=($request->CHD+$request->ADT)-1; 
           
				$s=$aa+$i;
             $ss=$i+1;
             $infant="infants"."$ss";
         $dobi=explode("/",$b->dob[$s]->$infant);
        $dobi=array_reverse($dobi);
         $dobi=implode("-",$dobi);
         ?>
        <tr style="background:#ffffff">
          <td><?php echo $i+1;?></td>
          <td><?php echo $b->first[$s]->$infant;?></td>
          <td><?php echo ($b->middle[$s]->$infant!='')?$b->middle[$s]->$infant:"N/A";?></td>
          <td><?php echo $b->last[$s]->$infant;?></td>
          <td><?php echo $dobc; ?></td>
        </tr>
        <?php } } ?>
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
    <td colspan="2">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="detailtbl">
        <tbody>
        <tr>
        	<td><div class="detailhed"><?=lang('T_AND_S');?> </div></td>
        </tr>
        <tr>
          <td align="left" valign="top" style="padding:0 10px;"><div class="paratems">
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