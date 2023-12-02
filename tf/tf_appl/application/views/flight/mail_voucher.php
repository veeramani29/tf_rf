  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
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
        <div class="opfligt"> Operated by : <?php echo $segment->OperatingCarrier;?></div>
        <?php
		}
		?>
    
        <div class="opfligt">Duration : <?php echo $this->flight_model->get_duration($this->flight_model->get_unixtimestamp($segment->DepartureTime),$this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></div>
    </div>
	</td>
    
    <td bgcolor="#FFFFFF" valign="top" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;">
    <span style="font-size:16px; "><?php echo $segment->Origin;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Origin);?>
    </td>
    <td bgcolor="#FFFFFF"  valign="top" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; "><?php echo $segment->Destination;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Destination);?></td>
    <td width="25%" rowspan="2" bgcolor="#FFFFFF">Aircraft : <?php echo $segment->Equipment;?> <br><br>
Booking Class : <?php echo $segment->CabinClass;?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"  valign="top" style="border-right:1px solid #EEE;">Departing At :<br><span style="font-size:13px; "><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></span><br></td>
    <td bgcolor="#FFFFFF"  valign="top" style="border-right:1px solid #EEE;">Arriving At :<br><span style="font-size:13px; "><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span><br>
</td>
    </tr>
        </tbody></table>

      </td>
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
        <div class="opfligt"> Operated by : <?php echo $segment->OperatingCarrier;?></div>
    <?php
		}
		?>
        <div class="opfligt">Duration : <?php echo $this->flight_model->get_duration($this->flight_model->get_unixtimestamp($segment->DepartureTime),$this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></div>
    </div>
  </td>
    
    <td bgcolor="#FFFFFF" valign="top"  style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;">
    <span style="font-size:16px; "><?php echo $segment->Origin;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Origin);?>
    </td>
    <td bgcolor="#FFFFFF" valign="top"  style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; "><?php echo $segment->Destination;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Destination);?></td>
    <td width="25%" rowspan="2" bgcolor="#FFFFFF">Aircraft : <?php echo $segment->Equipment;?> <br><br>
Booking Class : <?php echo $segment->CabinClass;?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" valign="top"  style="border-right:1px solid #EEE;">Departing At :<br><span style="font-size:13px; "><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></span><br></td>
    <td bgcolor="#FFFFFF" valign="top"  style="border-right:1px solid #EEE;">Arriving At :<br><span style="font-size:13px; "><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span><br>
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
        <div class="opfligt"> Operated by : <?php echo $segment->OperatingCarrier;?></div>
    <?php
		}
		?>
        <div class="opfligt">Duration : <?php echo $this->flight_model->get_duration($this->flight_model->get_unixtimestamp($segment->DepartureTime),$this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></div>
    </div>
  </td>
    
    <td bgcolor="#FFFFFF"  valign="top" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;">
    <span style="font-size:16px; "><?php echo $segment->Origin;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Origin);?>
    </td>
    <td bgcolor="#FFFFFF" valign="top"  style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; "><?php echo $segment->Destination;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Destination);?></td>
    <td width="25%" rowspan="2" bgcolor="#FFFFFF">Aircraft : <?php echo $segment->Equipment;?> <br><br>
Booking Class : <?php echo $segment->CabinClass;?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" valign="top"  style="border-right:1px solid #EEE;">Departing At :<br><span style="font-size:13px; "><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></span><br></td>
    <td bgcolor="#FFFFFF" valign="top"  style="border-right:1px solid #EEE;">Arriving At :<br><span style="font-size:13px; "><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span><br>
</td>
    </tr>
        </tbody></table>

      </td>
    </tr>
    <?php }?>
   
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
        <div class="opfligt"> Operated by : <?php echo ($segment->OperatingCarrier != "") ? $segment->OperatingCarrier : "-";?></div>
    <?php
		}
		?>
        <div class="opfligt">Duration : <?php echo $this->flight_model->get_duration($this->flight_model->get_unixtimestamp($segment->DepartureTime),$this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></div>
    </div>
  </td>
    
    <td bgcolor="#FFFFFF"  valign="top" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;">
    <span style="font-size:16px; "><?php echo $segment->Origin;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Origin);?>
    </td>
    <td bgcolor="#FFFFFF" valign="top"  style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; "><?php echo $segment->Destination;?></span><br><?php echo $this->flight_model->get_airport_name($segment->Destination);?></td>
    <td width="25%" rowspan="2" bgcolor="#FFFFFF">Aircraft : <?php echo $segment->Equipment;?> <br><br>
Booking Class : <?php echo $segment->CabinClass;?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"  valign="top" style="border-right:1px solid #EEE;">Departing At :<br><span style="font-size:13px; "><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></span><br></td>
    <td bgcolor="#FFFFFF"  valign="top" style="border-right:1px solid #EEE;">Arriving At :<br><span style="font-size:13px; "><?php echo date('d M, D Y H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span><br>
</td>
    </tr>
        </tbody></table>

      </td>
    </tr>
    
    <?php } ?>

    <?php } ?>
    
    </table>