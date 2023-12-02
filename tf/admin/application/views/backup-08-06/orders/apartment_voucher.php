<html>
    <head>
        <title>Manage Orders | InnoGlobe</title>
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
            	<div class="vocrlogo"><img src="<?php echo ASSETS;?>images/logo.png" alt="InnoGlobe Logo" /></div>
            </div>
            
            <div class="col-md-6">
            	<div class="vcradrss">
                	InnoGlobe office address<br />
                    Location of office
                	<div class="iconmania"><span class="icon icon-envelope"></span><a>office@InnoGlobe.com</a></div>
                   <div class="iconmania"><span class="icon icon-phone"></span> +91 123 456 7890</div>
                </div>
            </div>
            <div class="clear"></div>
        
        	<div class="col-md-12">
            	<div class="witmd6">
            	<div class="topvmsg">
                	<h3 class="heloma">Hello, <?php echo $Booking->RES_GUEST_FIRSTNAME;?></h3>
                    <span class="msgvcr">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod Tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo </span>
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
            
            
            <div class="col-md-12">
            	<div class="othrdetsv nopad">
                	<div class="rowhost">
                    	<h3 class="hosthed">Your host</h3>
                        <div class="colhostimg"><a href="<?php echo $host_profile_link;?>" target="new"><img src="<?php echo ($Booking->PROP_USER_TYPE == '2')?$Booking->agent_logo:$Booking->profile_photo;?>" alt="" /></a></div>
                        <div class="hostvdets">
                        	<a href="<?php echo $host_profile_link;?>" target="new" class="hostlink"><span class="namehst"><?php echo $Booking->firstname.' '.$Booking->lastname;?></span></a>
                            <span class="phonenumhst">
                                <?php 
                                echo ($Booking->PROP_USER_TYPE == '2')?$Booking->mobile:$Booking->contact_no;
                                ?>
                            </span>
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
                            	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod Tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo 
                            </span>
                        </div>
                    </div>
                    
                    <?php if($Booking->PROP_CANCELLATION_DESC != ''){?>
                     <div class="rowhost">
                        <h3 class="hosthed">Cancellation policy</h3>
                        <div class="hostvdets">
                        <h4><?php echo $Booking->PROP_CANCELLATION_TYPE;?></h4>
                            <span class="namehstdets">
                                <?php echo $Booking->PROP_CANCELLATION_DESC;?>
                            </span>
                        </div>
                    </div>
                    <?php }?>
                    <?php if($Booking->PROP_ARRIVAL_SHEET != ''){?>
                     <div class="rowhost">
                        <h3 class="hosthed">Customer service</h3>
                        <div class="hostvdets">
                            <span class="namehstdets">
                                <?php echo $Booking->PROP_ARRIVAL_SHEET;?>
                            </span>
                        </div>
                    </div>
                    <?php }?>
                    <?php $RentData = json_decode($Booking->RENT_DATA);?>
                     <div class="rowhost">
                    	<h3 class="hosthed">Statement</h3>
                        <div class="hostvdets">
                        	<div class="rowstate">
                            	<div class="col-md-7 nopad">
                                	<div class="lblstate">Accommodations</div>
                                </div>
                                <div class="col-md-5 nopad">
                                	<div class="stateamnt"><?php echo CURR_ICON?><?php echo $RentData->RentSubtotal;?> (<?php echo CURR_ICON?><?php echo $RentData->price_per;?> Avg/Night)</div>
                                </div>
                            </div>
                            
                            <div class="rowstate">
                            	<div class="col-md-7 nopad">
                                	<div class="lblstate">InnoGlobe service fee (TAX INCL)</div>
                                </div>
                                <div class="col-md-5 nopad">
                                	<div class="stateamnt">$0</div>
                                </div>
                            </div>
                            
                            <div class="rowstate martopstate">
                            	<div class="col-md-7 nopad">
                                	<div class="lblstate textalignrit">Grand total</div>
                                </div>
                                <div class="col-md-5 nopad">
                                	<div class="stateamnt orange"><?php echo CURR_ICON?><?php echo $RentData->total_price;?></div>
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