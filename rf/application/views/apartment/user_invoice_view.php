<?php $this->load->view('common/header');?>
<div class="full marintopcnt contentvcr" id="invoice">
    <div class="container">
        <div class="container offset-0">
        
        <div class="centervoucher2">
        
        	<div class="col-md-12">
                <div class="alliconfrmt">
                    <a class="tooltipv iconsofvcr icon icon-print" title="Print Invoice" onclick="PrintDiv();"></a>
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
                    <img src="<?php echo $agent_d->agent_logo;?>" alt="<?php echo $agent_d->company_name;?> Logo"  style="max-width:150px"/> 
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
                   <?php if($agent_d->address != '' || $agent_d->address != NULL){ echo $agent_d->address;}?>
                    <div class="iconmania"><span class="icon icon-envelope"></span><a><?php echo $agent_d->email_id;?></a></div>
                    <div class="iconmania"><span class="icon icon-phone"></span> <?php echo $agent_d->mobile;?></div>
                <?php }?>
                </div>
            </div>
            <div class="clear"></div>
        
        	<div class="col-md-12">
            	<div class="witmd6">
                
                <div class="splacv">
                <div class="topvmsg">
                	<h3 class="vcrhed">Invoice</h3>
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
                </div>
                
                
                <div class="rowing">
                	<div class="col-md-6">
                    	<div class="rowhost">
                            <h3 class="hosthed">
                                <span class="imageinvc"><img src="<?php echo ASSETS;?>images/useri.png" alt="" /></span> Name
                            </h3>
                            <div class="hostvdets">
                                <span class="namehstdets">
                                    <?php echo $Booking->RES_GUEST_FIRSTNAME.' '.$Booking->RES_GUEST_LASTNAME;?>
                                </span>
                            </div>
                        </div>
                        </div>
                    <div class="col-md-6">
                    	<div class="rowhost">
                            <h3 class="hosthed">
                                <span class="imageinvc"><img src="<?php echo ASSETS;?>images/marker.png" alt="" /></span> Destination
                            </h3>
                            <div class="hostvdets">
                                <span class="namehstdets">
                                    <?php echo $Booking->PROP_CITY.', '.$Booking->PROP_REGION;?><br />
                                    <?php echo $Booking->PROP_COUNTRY_NAME;?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="rowing">
                	<div class="col-md-6">
                    	<div class="rowhost">
                            <h3 class="hosthed">
                                <span class="imageinvc"><img src="<?php echo ASSETS;?>images/nav.png" alt="" /></span> Address of the accommodation
                            </h3>
                            <div class="hostvdets">
                                <span class="namehstdets">
                                    <?php echo $Booking->PROP_ADDR1.', '.$Booking->PROP_ADDR2;?><br />
                                    <?php echo $Booking->PROP_CITY.', '.$Booking->PROP_REGION.', '.$Booking->PROP_COUNTRY_NAME;?>
                                </span>
                            </div>
                        </div>
                        </div>
                    <div class="col-md-6">
                    	<div class="rowhost">
                            <h3 class="hosthed">
                                <span class="imageinvc"><img src="<?php echo ASSETS;?>images/pro.png" alt="" /></span> Property
                            </h3>
                            <div class="hostvdets">
                                <span class="namehstdets">
                                    <?php echo $Booking->PROP_NAME;?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="rowing">
                	<div class="col-md-6">
                    	<div class="rowhost">
                            <h3 class="hosthed">
                                <span class="imageinvc"><img src="<?php echo ASSETS;?>images/allapt.png" alt="" /></span> Type of apartment
                            </h3>
                            <div class="hostvdets">
                                <span class="namehstdets">
                                    <?php echo $Booking->PROP_TYPE_LABEL;?>
                                </span>
                            </div>
                        </div>
                        </div>
                    <div class="col-md-6">
                    	<div class="rowhost">
                            <h3 class="hosthed">
                                <span class="imageinvc"><img src="<?php echo ASSETS;?>images/night.png" alt="" /></span> Nights
                            </h3>
                            <div class="hostvdets">
                                <span class="namehstdets">
                                    <?php echo $Booking->NIGHTS;?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="rowing">
                	<div class="col-md-6">
                    	<div class="rowhost">
                            <h3 class="hosthed">
                                <span class="imageinvc"><img src="<?php echo ASSETS;?>images/in.png" alt="" /></span> Check In
                            </h3>
                            <div class="hostvdets">
                                <span class="namehstdets">
                                    <?php echo date('D, d M Y', strtotime($Booking->RES_CHECK_IN));?> <br /> <?php echo $Booking->PROP_CIN_TIME;?> 
                                </span>
                            </div>
                        </div>
                        </div>
                    <div class="col-md-6">
                    	<div class="rowhost">
                            <h3 class="hosthed">
                                <span class="imageinvc"><img src="<?php echo ASSETS;?>images/out.png" alt="" /></span> Check Out
                            </h3>
                            <div class="hostvdets">
                                <span class="namehstdets">
                                    <?php echo date('D, d M Y', strtotime($Booking->RES_CHECK_OUT));?> <br /> <?php echo $Booking->PROP_COUT_TIME;?> 
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                
                <div class="clear"></div>
                
                <div class="topvmsg">
                	<h3 class="vcrhed">Payment Details </h3>
                    
                    <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry">Receive Payment </div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong> <?php echo date('D, M d, Y', strtotime($Booking->voucher_date));?></strong></div>
                        </div>
                    </div>
                </div>
                
                
                <div class="clear"></div>
                <?php $RentData = json_decode($Booking->RENT_DATA);?>
                <div class="hostvdets">
                        	<div class="rowstate">
                            	<div class="col-md-7 nopad">
                                	<div class="lblstate">Accommodations</div>
                                </div>
                                <div class="col-md-5 nopad">
                                	<div class="stateamnt"><?php echo CURR_ICON?> <?php echo $Transaction->net_rate;?> </div>
                                </div>
                            </div>
                            
                            <div class="rowstate">
                            	<div class="col-md-7 nopad">
                                	<div class="lblstate">InnoGlobe service fee (TAX INCL)</div>
                                </div>
                                <div class="col-md-5 nopad">
                                	<div class="stateamnt"><?php echo CURR_ICON?> <?php echo $Transaction->apt_charge;?></div>
                                </div>
                            </div>
                            
                            <div class="rowstate martopstate">
                            	<div class="col-md-7 nopad">
                                	<div class="lblstate textalignrit">Grand total</div>
                                </div>
                                <div class="col-md-5 nopad">
                                	<div class="stateamnt orange"><?php echo CURR_ICON?> <?php echo $Transaction->booking_amount;?></div>
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
   var voucher = document.getElementById('invoice');
   var popupWin = window.open('', '_blank', 'width=600,height=600');
   popupWin.document.open();
   popupWin.document.write('<html><head><link href="<?php echo ASSETS;?>css/bootstrap.css" rel="stylesheet" media="print"><link href="<?php echo ASSETS;?>css/custom.css" rel="stylesheet" media="print"><link href="<?php echo ASSETS;?>css/bootstrap.css" rel="stylesheet" media="screen"><link href="<?php echo ASSETS;?>css/custom.css" rel="stylesheet" media="screen"><style>@media print {.col-md-1,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-10,.col-md-11 {float: left;}.col-md-1 {width: 8.333333333333332%;}.col-md-2 {width: 16.666666666666664%;}.col-md-3 {width: 25%;}.col-md-4 {width: 33.33333333333333%;}.col-md-5 {width: 41.66666666666667%;}.col-md-6 {width: 50%;}.col-md-7 {width: 58.333333333333336%;}.col-md-8 {width: 66.66666666666666%;}.col-md-9 {width: 75%;}.col-md-10 {width: 83.33333333333334%;}.col-md-11 {width: 91.66666666666666%;}.col-md-12 {width: 100%;}}.tooltip, .tooltipv{display: none !important;}</style></head><body onload="window.print()">' + voucher.innerHTML + '</html>');
   popupWin.document.close();
}
</script>
</body>
</html>