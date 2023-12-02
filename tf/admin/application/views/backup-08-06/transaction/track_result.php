<!DOCTYPE html>
<html>
<head>
    <title>Transaction Management | InnoGlobe</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta content='text/html;charset=utf-8' http-equiv='content-type'>
    
    <link href='<?=base_url();?>assets/images/meta_icons/favicon.ico' rel='shortcut icon' type='image/x-icon'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon.png' rel='apple-touch-icon-precomposed'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-57x57.png' rel='apple-touch-icon-precomposed' sizes='57x57'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-72x72.png' rel='apple-touch-icon-precomposed' sizes='72x72'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-114x114.png' rel='apple-touch-icon-precomposed' sizes='114x114'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-144x144.png' rel='apple-touch-icon-precomposed' sizes='144x144'>
    <!-- / START - page related stylesheets [optional] -->
    <link href="<?=base_url();?>assets/stylesheets/plugins/select2/select2.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / END - page related stylesheets [optional] -->
    <!-- / bootstrap [required] -->
    <link href="<?=base_url();?>assets/stylesheets/bootstrap/bootstrap.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / theme file [required] -->
    <link href="<?=base_url();?>assets/stylesheets/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
    <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
    <link href="<?=base_url();?>assets/stylesheets/theme-colors.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / demo file [not required!] -->
    <link href="<?=base_url();?>assets/stylesheets/demo.css" media="all" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
      <script src="<?=base_url();?>assets/javascripts/ie/html5shiv.js" type="text/javascript"></script>
      <script src="<?=base_url();?>assets/javascripts/ie/respond.min.js" type="text/javascript"></script>
    <![endif]-->
  </head>
  <body class='contrast-dark fixed-header'>
    <?php $this->load->view('header');?>
    <div id='wrapper'>
      <div id='main-nav-bg'></div>
      <?php $this->load->view('side-menu');?>
      <section id='content'>
        <div class='container'>
          <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left'>
                      <i class='icon-ok'></i>
                      <span>Transacation Tracking</span>
                    </h1>
                    
                  </div>
                </div>
              </div>
              <?php if(isset($status)){echo $status;}?>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-header blue-background'>
                      <div class='title'>Transacation Tracking</div>
                      <div class='actions'>
                        <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                        </a>
                        
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                      <div class='box-content'>
                    <div class='group-header group-header-first'>
                <div class='row'>
                  <div class='col-sm-12'>
                    <div class='text-center'>
                      <h2>Transaction Status</h2>
                      <small class='text-muted'></small>
                    </div>
                  </div>
                  <div class='col-sm-12'>
                    <div class='text-center'>
                    <div class='row box box-transparent'>
                    <?php 
					
					
					?>
					<!--text-warning icon-check align-right-->
                <div class='col-xs-4 col-sm-2'>
                  <div class='box-quick-link <?php if($Transaction->failed == 1 && $Transaction->failed_stage=='Hold') { echo 'red'; } else { if($Transaction->hold==1) { echo 'green'; } else { echo 'muted'; } } ?>-background'>
                    <a href='#'>
                      <div style="color:#FFFFFF !important"  class='header text-muted <?php  if($Transaction->failed == 1) { if($Transaction->failed_stage=='Analyze') { echo 'icon-warning-sign'; }  } if($Transaction->hold==1) { echo ' icon-check'; }   ?> align-right'>
                        <div class='icon-h-sign'></div>
                      </div><div class="content">Hold</div>
                    </a>
                  </div>
                </div>
                <div class='col-xs-4 col-sm-2'>
                  <div class='box-quick-link <?php if($Transaction->failed == 1 && $Transaction->failed_stage=='Analyze') { echo 'red'; } else {  if($Transaction->analyze==1) { echo 'green'; } else { echo 'muted'; }  } ?>-background'>
                    <a href='#'>
                      <div  style="color:#FFFFFF !important" class='header text-muted align-right <?php  if($Transaction->failed == 1) { if($Transaction->failed_stage=='Analyze') { echo 'icon-warning-sign'; }  } if($Transaction->analyze==1) { echo ' icon-check'; }   ?>'>
                        <div class='icon-search '></div>
                      </div><div class="content">Analyze</div>
                    </a>
                  </div>
                </div>
                <div class='col-xs-4 col-sm-2'>
                  <div class='box-quick-link <?php  if($Transaction->failed == 1 && $Transaction->failed_stage=='Process') { echo 'red'; } else { if($Transaction->process==1) { echo 'green'; } else { echo 'muted'; } }  ?>-background'>
                    <a href='#'>
                      <div style="color:#FFFFFF !important"  class='header text-muted align-right <?php if($Transaction->failed == 1) {  if($Transaction->failed_stage=='Process') { echo 'icon-warning-sign'; }  } if($Transaction->process==1) { echo ' icon-check'; }   ?>'>
                        <div class='icon-refresh'></div>
                      </div><div class="content">Process</div>
                    </a>
                  </div>
                </div>
                <div class='col-xs-4 col-sm-2'>
                  <div class='box-quick-link <?php if($Transaction->failed == 1 && $Transaction->failed_stage=='Deposit') { echo 'red'; } else {  if($Transaction->deposit==1) { echo 'green'; } else { echo 'muted'; } }  ?>-background'>
                    <a href='#'>
                      <div style="color:#FFFFFF !important" class='header text-muted align-right <?php  if($Transaction->failed == 1) { if($Transaction->failed_stage=='Deposit') { echo 'icon-warning-sign'; }  } if($Transaction->deposit==1) { echo ' icon-check'; }   ?>'>
                        <div class='icon-money'></div>
                      </div><div class="content">Deposit</div>
                    </a>
                  </div>
                </div>
                <div class='col-xs-4 col-sm-2'>
                  <div class='box-quick-link <?php if($Transaction->failed == 1 && $Transaction->failed_stage=='Recived') { echo 'red'; } else {  if($Transaction->recived==1) { echo 'green'; } else { echo 'muted'; } } ?>-background'>
                    <a href='orders.html'>
                      <div style="color:#FFFFFF !important"  class='header text-muted align-right <?php if($Transaction->failed == 1) { if($Transaction->failed_stage=='Recived') { echo 'icon-warning-sign'; } } if($Transaction->recived==1) { echo ' icon-check'; }  ?>'>
                        <div class='icon-thumbs-up '></div>
                      </div><div class="content">Recived</div>
                    </a>
                  </div>
                </div>
                
              </div>
                    </div>
                    <div class='row timeline'>
                <div class='col-sm-12'>
                  <ol class='list-unstyled'>
                  <?php 
				  for($i=0;$i<count($History);$i++)
				  {
            if(isset($History[$i]->status)){
					  ?>
                    <li>
                    <?php 
					
          if($History[$i]->status == 'Hold') { ?>
					
                      <div class='icon muted-background'>
                        <i class='icon-h-sign'></i>
                      </div>
          <?php } ?>
                      <?php 
					if($History[$i]->status == 'Analyze') { ?>
					
                      <div class='icon blue-background'>
                        <i class='icon-search'></i>
                      </div>
                      <?php } ?>
                      <?php 
					if($History[$i]->status == 'Process') { ?>
					
                      <div class='icon purple-background'>
                        <i class='icon-refresh'></i>
                      </div>
                      <?php } ?>
                      <?php 
					if($History[$i]->status == 'Deposit') { ?>
					
                      <div class='icon orange-background'>
                        <i class='icon-money'></i>
                      </div>
                      <?php } ?>
                      <?php 
					if($History[$i]->status == 'Failed') { ?>
					
                      <div class='icon red-background'>
                        <i class='icon-warning-sign '></i>
                      </div>
                      <?php } ?>
                      <?php 
					if($History[$i]->status == 'Recived') { ?>
					
                      <div class='icon green-background'>
                        <i class='icon-thumbs-up-alt '></i>
                      </div>
                      <?php } ?>
                      <?php 
					if($History[$i]->status == 'NotRecived') { ?>
					
                      <div class='icon red-background'>
                        <i class='icon-thumbs-down-alt '></i>
                      </div>
                      <?php } ?>
                      <div class='title'>
                        <?php echo $History[$i]->status; ?>
                        <small class='text-muted'><?php echo date('F j, Y, g:i a',strtotime($History[$i]->m_datetime)); ?></small>
                      </div>
                      <div class='content'>
                       <?php echo $History[$i]->message; ?>
                      </div>
                    </li>
                  <?php
          }
				  }
				  ?>
                  </ol>
                </div>
              </div>
              </div>
                </div>
              </div></div>
              
              
                    <div class='box-content'>
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
                	<div class="iconmania"><span class="icon icon-envelope"></span><a>office@bookhotac.com</a></div>
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
                        <div class="colhostimg"><a href="<?php echo $host_profile_link;?>" target="new"><img src="<?php echo $Booking->profile_photo;?>" alt="" /></a></div>
                        <div class="hostvdets">
                        	<a href="<?php echo $host_profile_link;?>" target="new" class="hostlink"><span class="namehst"><?php echo $Booking->firstname.' '.$Booking->lastname;?></span></a>
                            <span class="phonenumhst"><?php echo $Booking->contact_no;?></span>
                            <!-- <a class="hostlink">Message the host a message</a> -->
                        </div>
                    </div>
                    <div class="rowhost">
                    	<h3 class="hosthed">Directions</h3>
                        <div class="hostvdets">
                        	<span class="namehstdets">
                            	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod Tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo 
                            </span>
                        </div>
                    </div>
                    
                     <div class="rowhost">
                    	<h3 class="hosthed">Payment</h3>
                        <div class="hostvdets">
                        	<span class="namehstdets">
                            	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod Tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo 
                            </span>
                        </div>
                    </div>
                    
                     <div class="rowhost">
                    	<h3 class="hosthed">Cancellation policy</h3>
                        <div class="hostvdets">
                        	<span class="namehstdets">
                            	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod Tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo 
                            </span>
                        </div>
                    </div>
                    
                     <div class="rowhost">
                    	<h3 class="hosthed">Customer service</h3>
                        <div class="hostvdets">
                        	<span class="namehstdets">
                            	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod Tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo 
                            </span>
                        </div>
                    </div>
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
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          <?php $this->load->view('footer');?>
        </div>
      </section>
    </div>
    <!-- / jquery [required] -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
    <!-- / jquery mobile (for touch events) -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery.mobile.custom.min.js" type="text/javascript"></script>
    <!-- / jquery migrate (for compatibility with new jquery) [required] -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery-migrate.min.js" type="text/javascript"></script>
    <!-- / jquery ui -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery-ui.min.js" type="text/javascript"></script>
    <!-- / jQuery UI Touch Punch -->
    <script src="<?=base_url();?>assets/javascripts/plugins/jquery_ui_touch_punch/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
    <!-- / bootstrap [required] -->
    <script src="<?=base_url();?>assets/javascripts/bootstrap/bootstrap.js" type="text/javascript"></script>
    <!-- / modernizr -->
    <script src="<?=base_url();?>assets/javascripts/plugins/modernizr/modernizr.min.js" type="text/javascript"></script>
    <!-- / retina -->
    <script src="<?=base_url();?>assets/javascripts/plugins/retina/retina.js" type="text/javascript"></script>
    <!-- / theme file [required] -->
    <script src="<?=base_url();?>assets/javascripts/theme.js" type="text/javascript"></script>
    <!-- / demo file [not required!] -->
    <script src="<?=base_url();?>assets/javascripts/demo.js" type="text/javascript"></script>
    <!-- / START - page related files and scripts [optional] -->
    <script src="<?=base_url();?>assets/javascripts/plugins/validate/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/validate/additional-methods.js" type="text/javascript"></script>
     <script src="<?=base_url();?>assets/javascripts/plugins/fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/select2/select2.js" type="text/javascript"></script>
    <script>
      $.validator.addMethod("buga", (function(value) {
        return value === "buga";
      }), "Please enter \"buga\"!");
      
      $.validator.methods.equal = function(value, element, param) {
        return value === param;
      };
    </script>
    <!-- / END - page related files and scripts [optional] -->
  </body>
</html>
