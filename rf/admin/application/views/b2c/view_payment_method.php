<!DOCTYPE html>
<html>
<head>
    <title>B2C Payment Method | <?php echo PROJECT_NAME;?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta content='text/html;charset=utf-8' http-equiv='content-type'>
    
    <link href='<?=base_url();?>assets/images/meta_icons/favicon.ico' rel='shortcut icon' type='image/x-icon'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon.png' rel='apple-touch-icon-precomposed'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-57x57.png' rel='apple-touch-icon-precomposed' sizes='57x57'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-72x72.png' rel='apple-touch-icon-precomposed' sizes='72x72'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-114x114.png' rel='apple-touch-icon-precomposed' sizes='114x114'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-144x144.png' rel='apple-touch-icon-precomposed' sizes='144x144'>
    <!-- / START - page related stylesheets [optional] -->
    
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
                      <i class='icon-male'></i>
                      <span>B2C User Payment Method</span>
                    </h1>
                    <div class='pull-right'>
                      <ul class='breadcrumb'>
                        <li>
                          <a href='<?=base_url();?>'>
                            <i class='icon-bar-chart'></i>
                          </a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li>
                         <a href="<?php echo WEB_URL; ?>b2c/view_profile/<?php echo $id; ?>/3"><?php echo $user->firstname; ?> Profile</a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'><?php echo $user->firstname; ?> Payment Method</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class='row'>
                <div class='col-sm-3 col-lg-2'>
                  <div class='box'>
                    <div class='box-content'>
                      <img class="img-responsive" src="<?php echo $user->profile_photo; ?>" />
                    </div>
                  </div>
                </div>
                <div class='col-sm-9 col-lg-10'>
                  <div class='box'>
                    <div class='box-content box-double-padding'>
                      <form class='form' style='margin-bottom: 0;'>
                        <hr class='hr-normal'>
                        <fieldset>
                          <div class='col-sm-4'>
                            <div class='lead'>
                              <i class='icon-male text-contrast'></i>
                              Personal info
                            </div>
                          </div>
                          <div class='col-sm-7 col-sm-offset-1'>
                            <div class='form-group'>
                              <label>Name: </label>
                              <?php echo $user->firstname; ?>
                            </div>
                            <div class='form-group'>
                              <label>E-mail: </label>
                              <?php echo $user->email; ?>
                            </div>
                          <?php 
						  if($pay!='')
						  {
							  ?>
                        <fieldset>
                          <div class='col-sm-4'>
                            <div class='lead'>
                              <i class='icon-male text-contrast'></i>
                              Bank Transaction
                            </div>
                          </div>
                          <div class='col-sm-7 col-sm-offset-1'>
                            <div class='form-group'>
                              <label>Bank Account Name: </label>
                              <?php echo $pay->bank_account_name; ?>
                            </div>
                            <div class='form-group'>
                              <label>Bank Name: </label>
                              <?php echo $pay->bank_name; ?>
                            </div>
                           
                              <div class='form-group'>
                              <label>Bank Account Number: </label>
                              <?php echo $user->bank_account_number; ?>
                            </div>
                            <div class='form-group'>
                              <label>Card Number: </label>
                              <?php echo $pay->bank_card_number; ?>
                            </div>
                          
                            <div class='form-group'>
                              <label>Card CVV Number: </label>
                              <?php echo $user->bank_account_cvv; ?>
                            </div>
                           
                        </fieldset>
                        <fieldset>
                          <div class='col-sm-4'>
                            <div class='lead'>
                              <i class='icon-male text-contrast'></i>
                              Paypal Transaction
                            </div>
                          </div>
                          <div class='col-sm-7 col-sm-offset-1'>
                            <div class='form-group'>
                              <label>Paypal Account Name: </label>
                              <?php echo $pay->paypal_account_name; ?>
                            </div>
                            <div class='form-group'>
                              <label>Paypal Account Email-ID: </label>
                              <?php echo $pay->paypal_email_id; ?>
                            </div>
                           
                           
                        </fieldset>
                        <?php
						  }
						  ?>
                        <div class='form-actions form-actions-padding' style='margin-bottom: 0;'>
                          <div class='text-right'>
                            <a href="<?php echo WEB_URL; ?>b2c/b2c_view"><button class='btn btn-primary' type='button'>
                                <i class='icon-reply'></i>
                                Go Back
                              </button></a>
                          </div>
                        </div>
                      </form>
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
    
    <!-- / END - page related files and scripts [optional] -->
  </body>
</html>
