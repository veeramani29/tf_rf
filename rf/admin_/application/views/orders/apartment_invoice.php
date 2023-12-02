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
                	<?php echo PROJECT_NAME;?> office address<br />
                    Location of office
                	<div class="iconmania"><span class="icon icon-envelope"></span><a>office@<?php echo PROJECT_NAME;?>.com</a></div>
                   <div class="iconmania"><span class="icon icon-phone"></span> +91 123 456 7890</div>
                </div>
            </div>
            <div class="clear"></div>
        
        	<div class="col-md-12">
                <div class="witmd6">
                
                <div class="splacv">
                <div class="topvmsg">
                    <h3 class="vcrhed">Tax Invoice</h3>
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
                            <div class="labliternry">Receive payment </div>
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
                                    <div class="stateamnt"><?php echo CURR_ICON?> <?php echo isset($Transaction->net_rate)?$Transaction->net_rate:'-';?> </div>
                                </div>
                            </div>
                            
                            <div class="rowstate">
                                <div class="col-md-7 nopad">
                                    <div class="lblstate"><?php echo PROJECT_NAME;?> service fee (TAX INCL)</div>
                                </div>
                                <div class="col-md-5 nopad">
                                    <div class="stateamnt"><?php echo CURR_ICON?> <?php echo isset($Transaction->host_charge)?$Transaction->host_charge:'-';?> ( - )</div>
                                </div>
                            </div>
                            
                            <div class="rowstate martopstate">
                                <div class="col-md-7 nopad">
                                    <div class="lblstate textalignrit">Grand total</div>
                                </div>
                                <div class="col-md-5 nopad">
                                    <div class="stateamnt orange"><?php echo CURR_ICON?> <?php echo isset($Transaction->payout_amount)?$Transaction->payout_amount:'-';?></div>
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