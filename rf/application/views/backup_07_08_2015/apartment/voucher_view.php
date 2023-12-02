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
            	<div class="vocrlogo">
                <?php if($Booking->user_type == '3'){ ?>
                    <img src="<?php echo ASSETS;?>images/logo.png" alt="InnoGlobe Logo" />
                <?php 
                    }else if($Booking->user_type == '2'){ 
                    $agent_d = $this->account_model->GetUserData($global->user_type, $global->user_id)->row();
                ?>
                    <img src="<?php echo $agent_d->agent_logo;?>" alt="<?php echo $agent_d->company_name;?> Logo"  style="max-width:150px" /> 
                <?php }?>
                </div>
            </div>
            
            <div class="col-md-6">
            	<div class="vcradrss">
                <?php if($Booking->user_type == '3'){?>
                    <?php echo $voucher_details->cl_address; ?>
                    <div class="iconmania"><span class="icon icon-envelope"></span><a><?php echo $voucher_details->cl_email; ?></a></div>
                    <div class="iconmania"><span class="icon icon-phone"></span><?php echo $voucher_details->cl_phone; ?></div>
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
            	<div class="topvmsg">
                	<h3 class="heloma">Hello, <?php echo $Booking->RES_GUEST_FIRSTNAME;?></h3>
                    <span class="msgvcr"><?php echo $voucher_details->cl_heading_line; ?></span>
                </div>
                <div class="clear"></div>
                
                <div class="topvmsg">
                	<h3 class="vcrhed">Itinerary</h3>
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
                
                <div class="topvmsg">
                	<div class="mapmensn">
                    	<img src="<?php echo $Map; ?>" alt=""/>
                    </div>
                </div>
                
                <div class="topvmsg">
                	<a href="<?php echo $apt_link;?>" target="new"><h3 class="vcrhed"><?php echo $Booking->PROP_NAME;?>, <?php echo $Booking->PROP_CITY;?> and <?php echo $Booking->PROP_COUNTRY_NAME;?></h3></a>
                     <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry">Apartment</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $Booking->PROP_TYPE_LABEL;?></strong></div>
                        </div>
                    </div>
                    <?php $guests = $Booking->RES_N_ADULTS+$Booking->RES_N_CHILDREN+$Booking->RES_N_BABIES;?>
                     <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry">Guest</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $guests;?></strong></div>
                        </div>
                    </div>
                </div>
                
                <div class="topvmsg">
                	<div class="col-md-5">
                    	<div class="wrpdte">
                        	<span class="incty">Check In</span>
                            <div class="alldatecty">
                            	<?php echo date('D, M', strtotime($Booking->RES_CHECK_IN));?><strong><?php echo date('d', strtotime($Booking->RES_CHECK_IN));?></strong>
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
                            	<?php echo date('D, M', strtotime($Booking->RES_CHECK_OUT));?><strong><?php echo date('d', strtotime($Booking->RES_CHECK_OUT));?></strong>
                            </div>
                        </div>
                    </div>
                </div>
               </div> 
            </div>
            <?php 
                if($Booking->PROP_USER_TYPE == '3'){
                    $contact_no = $user_data->contact_no;$firstname = $user_data->firstname;$lastname = $user_data->lastname; $profile_photo = $user_data->profile_photo;
                }else if($Booking->PROP_USER_TYPE == '2'){
                    $contact_no = $user_data->mobile; $firstname = $user_data->firstname;$lastname = $user_data->lastname; $profile_photo = $user_data->agent_logo;
                }
            ?>
            
            <div class="col-md-12">
            	<div class="othrdetsv nopad">
                	<div class="rowhost">
                    	<h3 class="hosthed">Your host</h3>
                        <div class="colhostimg"><a href="<?php echo $host_profile_link;?>" target="new"><img src="<?php echo $profile_photo;?>" alt="" /></a></div>
                        <div class="hostvdets">
                        	<a href="<?php echo $host_profile_link;?>" target="new" class="hostlink"><span class="namehst"><?php echo $firstname.' '.$lastname;?></span></a>
                            <span class="phonenumhst"><?php echo $contact_no;?></span>
                            <!-- <a class="hostlink">Message the host a message</a> -->
                        </div>
                    </div>
                    <?php if($Booking->PROP_AREADESCRIPTION != ''){?>
                    <div class="rowhost">
                    	<h3 class="hosthed">Directions</h3>
                        <div class="hostvdets">
                        	<span class="namehstdets">
                            	<?php echo $Booking->PROP_AREADESCRIPTION;?>
                            </span>
                        </div>
                    </div>
                    <?php }?>
                     <div class="rowhost">
                    	<h3 class="hosthed">Payment</h3>
                        <div class="hostvdets">
                        	<span class="namehstdets">
                            	<?php echo $voucher_details->cl_payment; ?>
                            </span>
                        </div>
                    </div>
                    <?php if($Booking->PROP_CANCELLATION_DESC != ''){?>
                     <div class="rowhost">
                    	<h3 class="hosthed">Cancellation policy</h3>
                        <div class="hostvdets">
                        
                        	<span class="namehstdets">
                            <?php echo $Booking->PROP_CANCELLATION_TYPE;?> : <?php echo $Booking->PROP_CANCELLATION_DESC;?>
                            </span>
                        </div>
                    </div>
                    <?php }?>
                   
                     <div class="rowhost">
                    	<h3 class="hosthed">Customer service</h3>
                        <div class="hostvdets">
                        	<span class="namehstdets"><?php echo $voucher_details->cl_service; ?><br/><?php if($Booking->PROP_ARRIVAL_SHEET != ''){?>
                            	<?php echo $Booking->PROP_ARRIVAL_SHEET;?> <?php }?>
                            </span>
                        </div>
                    </div>
                   
                    <?php $RentData = json_decode($Booking->RENT_DATA);?>
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
</body>
</html>