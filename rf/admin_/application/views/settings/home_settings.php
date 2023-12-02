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
                      <span>Update Home page settings</span>
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
                         <a href="<?php echo WEB_URL; ?>home_settings/"> Home page settings</a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Add New B2B Agent</li>
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
                      <div class='title'>General Settings</div>
                      <div class='actions'>
                        <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                        </a>
                        
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    <div class='box-content'>
                      <form class='form form-horizontal validate-form'   style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>home_settings/addHomeSettings" method="post"  enctype="multipart/form-data"> 
			<input type="hidden" name="isExists" value="<?php echo $isExists->id;?>" >			 
			<div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_email'>Home page tag line</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control'  data-rule-required='true' id='validation' name='tag_line' placeholder='Tag line' type='text' value="<?php echo $isExists->tag_line;?>">
                          </div>
                        </div>
			<div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_image'>Main Banner</label>
                          <div class='col-sm-4 controls'>
                            <input type="file" title='Search for a image to add main banner' class='form-control' id='validation_image' name='main_banner'>
			    <input type="hidden" name="hidden_main_banner" value="<?php echo isset($isExists->main_banner)?$isExists->main_banner:'';?>" >                         
			 </div>
			  <div class='col-sm-4 controls'>
				<img src="<?php echo isset($isExists->main_banner)?$isExists->main_banner:'';?>" width="50" height="50">
			  </div>
                        </div> 
		                         
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
                          <label class='control-label col-sm-3' for='validation_office'>Footer Copyright</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control'  data-rule-required='true' id='validation_office' name='footer_copyright' value="<?php echo $isExists->footer_copyright;?>" placeholder='Footer copyright' type='text'>
                          </div>
                        </div>
                         <div class='box-header blue-background'>
                      <div class='title'>Search Image</div>
                      <div class='actions'>
                        <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                        </a>
                        
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_image'>Hotel Image</label>
                          <div class='col-sm-4 controls'>
                            <input type="file" title='Search for a image to add' class='form-control'  id='validation_image' name='hotel'>
                            <input type="hidden" name="hidden_hotel_banner" value="<?php echo isset($isExists->hotel_image)?$isExists->hotel_image:'';?>" >
                    </div>
                      <div class='col-sm-4 controls'>
                      <img src="<?php echo isset($isExists->hotel_image)?$isExists->hotel_image:'';?>" width="50" height="50">
                      </div>
                        </div>
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_image'>Car Image</label>
                          <div class='col-sm-4 controls'>
                            <input type="file" title='Search for a image to add' class='form-control'  id='validation_image' name='car'>
                             <input type="hidden" title='Search for a image to add' class='form-control'  id='validation_image' name='vacation'>
                            
 <input type="hidden" title='Search for a image to add' class='form-control'  id='validation_image' name='apartment'>
                            <input type="hidden" name="hidden_car_banner" value="<?php echo isset($isExists->car_image)?$isExists->car_image:'';?>" >
                    </div>
                      <div class='col-sm-4 controls'>
                      <img src="<?php echo isset($isExists->car_image)?$isExists->car_image:'';?>" width="50" height="50">
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
