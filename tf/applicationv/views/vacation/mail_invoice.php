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
      <div class="confirmtionltr">Invoice</div>
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
              <td width="50%" align="left">RESERVATION CODE  :</td>
              <td width="50%" align="left"><strong><?php echo $Booking->pnr_no;?></strong></td>
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
      $vacation = json_decode(base64_decode($Booking->response));
      $request = json_decode(base64_decode($Booking->request));
    ?>
    <tr>
      <td align="center" bgcolor="#ffffff" class="padding1" style="border: 1px solid #eee;">
        <table width="100%" border="0" cellspacing="0" cellpadding="7" bgcolor="#FFFFFF" class="paddingTableTable">
  <tbody>
  <tr>
    <td colspan="4" bgcolor="#FFFFFF" style="border-bottom: 1px solid #eee;">
    <div class="dterser">
        <div class="colsdets">
        <img src="<?php echo ASSETS;?>voucher/images/vvactn.png" width="23" height="25">
        Date:
        <?php echo date('D, d M', strtotime($Booking->vacDate));?>
        </div>
        <div class="snotes">
        Please verify vacation times prior to date
        </div>
    </div>
    </td>
    </tr>
  <tr>
    <td width="25%" rowspan="2" style="border-right: 1px solid #eee;">
    <div class="padwithbord">
        <div class="leftflitmg">
            <img src="<?php echo $Booking->VacationImage;?>" style="width: 120px;height:40px;"/>
        </div>
        
        <div class="opfligt">Type: <strong><?php echo $vacation->package_type;?></strong></div>
    </div>
  </td>
    
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;">
    <span style="font-size:16px; font-weight:bold;"><?php echo $Booking->city;?></span><br><?php echo $Booking->vacCityName;?>
    </td>
    <td bgcolor="#FFFFFF" style="border-bottom:1px solid #EEE; border-right:1px solid #EEE;"><span style="font-size:16px; font-weight:bold;"><?php echo $vacation->package_name;?></span></td>
    <td width="25%" rowspan="2" bgcolor="#FFFFFF">Type:<br><?php echo $vacation->package_type;?>
</td>
  </tr>
  
        </tbody></table>

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
        <?php if($Booking->user_type == '2'){?>
          <td align="left" valign="top" style="background:#eeeeee"><strong>Actual Price</strong></td>
          <td align="left" valign="top" style="background:#eeeeee"><strong>Profit</strong></td>
        <?php }?>
        </tr>
        <tr>
         <td align="left" valign="top" style="background:#fff"><?php echo $Booking->TotalPrice;?> </td>
          <?php if($Booking->user_type == '2'){?>
          <td align="left" valign="top" style="background:#fff"><?php echo ($Booking->TotalPrice - $Booking->MyMarkup);?></td>
          <td align="left" valign="top" style="background:#fff"><?php echo $Booking->MyMarkup;?></td>
        <?php }?>
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


</body>
</html>