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
        
          <div class="col-md-12">
              <div class="witmd6">
              <div class="topvmsg">
                  <h3 class="heloma">Hello, <?php echo $Booking->GUEST_FIRSTNAME;?></h3>
                    <span class="msgvcr">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod Tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo </span>
                </div>
                <div class="clear"></div>
                
                <div class="topvmsg">
                  <h3 class="detailhedv2">Itinerary</h3>
                    <!-- <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry">Confirmation code:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $Booking->booking_no;?></strong></div>
                        </div>
                    </div> -->
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
                    </div>
                    
                   <!--  <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry">Reference Number: </div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong>ITMBWWN15J</strong></div>
                        </div>
                    </div> -->
                </div>
                
                
                
                <div class="topvmsg">
                  <a href="#" target="new"><h3 class="detailhedv2"><?php echo $Booking->hotel_name;?>, <?php echo $Booking->city;?></h3></a>
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
                    <!-- <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry">Inclusion:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong>Room and Breakfast (Continental Breakfast)</strong></div>
                        </div>
                    </div> -->
                </div>
                
                <div class="topvmsg">
                  <div class="col-md-5">
                      <div class="wrpdte">
                          <span class="incty">Check In</span>
                            <div class="alldatecty">
                              <?php echo date('D, M', strtotime($Booking->checkin));?><strong><?php echo date('d', strtotime($Booking->checkin));?></strong>
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
                              <?php echo date('D, M', strtotime($Booking->checkout));?><strong><?php echo date('d', strtotime($Booking->checkout));?></strong>
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
           <?php if($Booking->user_type == '2'){?>
          <td align="left" valign="top" style="background:#eeeeee"><strong>Actual Price</strong></td>
          <td align="left" valign="top" style="background:#eeeeee"><strong>Profit</strong></td>
          <?php }?>
        </tr>
        <tr>
         <td align="left" valign="top" style="background:#fff"><?php echo CURR_ICON.' '.$Booking->total_cost;?> </td>
          <?php if($Booking->user_type == '2'){?>
          <td align="left" valign="top" style="background:#fff"><?php echo CURR_ICON.' '.($Booking->total_cost - $Booking->MyMarkup);?></td>
          <td align="left" valign="top" style="background:#fff"><?php echo CURR_ICON.' '.$Booking->MyMarkup;?></td>
          <?php }?>
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
                              <p></p> 
                            
                              
                            </span>
                        </div>
                    </div>
                    

                    
                     
                    
                    
                </div>
            </div>
            
        </div>
    </div>
</div>
</div>

</body>
</html>