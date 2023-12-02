<!DOCTYPE html>
<html>
<head>
    <title>Update Settings | <?php echo PROJECT_NAME;?></title>
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
                      <i class='icon-male'></i>
                      <span>Update settings</span>
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
                         <a href="<?php echo WEB_URL; ?>home_settings/"> General  Settings</a>
                        </li>
                      
                       
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <?php if(isset($status)){echo $status;}?>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-header blue-background'>
                      <div class='title'>Home  Settings</div>
                      <div class='actions'>
                        <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                        </a>
                        
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    <div class='box-content'>
                      <form class='form form-horizontal validate-form'   style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>home_settings/addHomeSettings" method="post"  enctype="multipart/form-data"> 
			               		 
			                   <div class='form-group'>
                          <label class='control-label col-sm-3' for='tag_line'>Home page tag line</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control'  data-rule-required='true' id='tag_line' name='tag_line' placeholder='Tag line' type='text' value="<?php echo $isExists->tag_line;?>">
                          </div>
                        </div>

                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='banner_title'>Home page Banner Title</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control'  data-rule-required='true' id='banner_title' name='banner_title' placeholder='Banner Title' type='text' value="<?php echo $isExists->banner_title;?>">
                          </div>
                        </div>
                      <div class='form-group'>
                          <label class='control-label col-sm-3' for='offer_title'>Home page Flight Offer Title</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control'  data-rule-required='true' id='offer_title' name='offer_title' placeholder='Offer Title' type='text' value="<?php echo $isExists->flight_offer_title;?>">
                          </div>
                        </div>
                <div class='form-group'>
                          <label class='control-label col-sm-3' for='offer_desc'>Home page Flight Offer descriptions</label>
                          <div class='col-sm-4 controls'>
                            <textarea class='form-control'  data-rule-required='true' id='offer_desc' name='offer_desc' placeholder='Offer descriptions' type='text'><?php echo $isExists->flight_offer_desc;?></textarea> 
                          </div>
                        </div>

                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='newsletter_title'>News Letter Title</label>
                          <div class='col-sm-4 controls'>
                            <textarea class='form-control'  data-rule-required='true' id='newsletter_title' name='newsletter_title' placeholder='News Letter Title' type='text'><?php echo $isExists->news_letter_title;?></textarea> 
                          </div>
                        </div>

 <div class='form-group'>
                          <label class='control-label col-sm-3' for='loading_text'>AJAX Loading Text</label>
                          <div class='col-sm-4 controls'>
                            <textarea class='form-control'  data-rule-required='true' id='loading_text' name='loading_text' placeholder='AJAX Loading Text' type='text'><?php echo $isExists->loading_text;?></textarea> 
                          </div>
                        </div>


                        <div class='box-header blue-background'>
                      <div class='title'>Footer Settings</div></div>
                      <br>
                    <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_email'>Customer Support E-mail</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-email='true' data-rule-required='true' value="<?php echo $isExists->customer_support_email;?>" id='validation_email' name='customer_support_email' placeholder='E-mail' type='text'>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_contact'>Customer Support Contact No</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control'   data-rule-required='true' value="<?php echo $isExists->customer_support_phone;?>" id='validation_contact' name='customer_support_phone' placeholder='Contact No' type='text'>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='offer_text'>100% Ticket Finder Garantie</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control'  data-rule-required='true' id='offer_text' name='offer_text' value="<?php echo $isExists->tf_offer;?>" placeholder='Footer copyright' type='text'>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_office'>Footer Copyright</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control'  data-rule-required='true' id='validation_office' name='footer_copyright' value="<?php echo $isExists->footer_copyright;?>" placeholder='Footer copyright' type='text'>
                          </div>
                        </div>


                         <div class='box-header blue-background'>
                      <div class='title'>Payment Mehtod</div></div>
                      <br>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='payment_visa'>VISA</label>
                          <div class='col-sm-4 controls'>
                            <input class='checkbox' value="1" <?php echo ($isExists->visa=='1')?'checked':'';?> id='payment_visa' name='payment_visa'  type='checkbox'>
                          </div>
                        </div>
                       <div class='form-group'>
                          <label class='control-label col-sm-3' for='payment_master'>Master Card</label>
                          <div class='col-sm-4 controls'>
                            <input class='checkbox' value="1" <?php echo ($isExists->master=='1')?'checked':'';?> id='payment_master' name='payment_master'  type='checkbox'>
                          </div>
                        </div>

                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='payment_ideal'>Ideal</label>
                          <div class='col-sm-4 controls'>
                            <input class='checkbox' value="1" <?php echo ($isExists->ideal=='1')?'checked':'';?> id='payment_ideal' name='payment_ideal'  type='checkbox'>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='payment_paypal'>Paypal</label>
                          <div class='col-sm-4 controls'>
                            <input class='checkbox' value="1" <?php echo ($isExists->paypal=='1')?'checked':'';?> id='payment_paypal' name='payment_paypal'  type='checkbox'>
                          </div>
                        </div>
                    <div class='form-group'>
                          <label class='control-label col-sm-3' for='payment_visa'>American Express</label>
                          <div class='col-sm-4 controls'>
                            <input class='checkbox' value="1" <?php echo ($isExists->usa_exp=='1')?'checked':'';?> id='payment_usa_exp' name='payment_usa_exp'  type='checkbox'>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='payment_other'>Other</label>
                          <div class='col-sm-4 controls'>
                            <input class='checkbox' value="1" <?php echo ($isExists->other=='1')?'checked':'';?> id='payment_other' name='payment_other'  type='checkbox'>
                          </div>
                        </div>

                          <div class='box-header blue-background'>
                      <div class='title'>Certifications</div></div>
                      <br>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='cert_iata'>IATA</label>
                          <div class='col-sm-4 controls'>
                            <input class='checkbox' value="1" <?php echo ($isExists->cert_iata=='1')?'checked':'';?> id='cert_iata' name='cert_iata'  type='checkbox'>
                          </div>
                        </div>
                       <div class='form-group'>
                          <label class='control-label col-sm-3' for='cert_anvr'>ANVR</label>
                          <div class='col-sm-4 controls'>
                            <input class='checkbox' value="1" <?php echo ($isExists->cert_anvr=='1')?'checked':'';?> id='cert_anvr' name='cert_anvr'  type='checkbox'>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='cert_ngr'>NGR</label>
                          <div class='col-sm-4 controls'>
                            <input class='checkbox' value="1" <?php echo ($isExists->cert_nga=='1')?'checked':'';?> id='cert_nga' name='cert_nga'  type='checkbox'>
                          </div>
                        </div>
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='cert_woonborg'>Woonborg</label>
                          <div class='col-sm-4 controls'>
                            <input class='checkbox' value="1" <?php echo ($isExists->cert_woonborg=='1')?'checked':'';?> id='cert_woonborg' name='cert_woonborg'  type='checkbox'>
                          </div>
                        </div>
                        <div class='form-actions' style='margin-bottom:0'>
                          <div class='row'>
                            <div class='col-sm-9 col-sm-offset-3'>
                              <a href="<?php echo WEB_URL; ?>home_settings/"><button class='btn btn-primary' type='button'>
                                <i class='icon-reply'></i>
                                Go Back
                              </button></a>
                              <button class='btn btn-primary' type='submit'>
                                <i class='icon-save'></i>
                               Update Settings
                              </button>
                            </div>
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
