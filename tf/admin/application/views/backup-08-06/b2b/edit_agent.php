<!DOCTYPE html>
<html>
<head>
    <title>Update B2B Agent | InnoGlobe</title>
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
                      <span>Update B2B Agent</span>
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
                         <a href="<?php echo WEB_URL; ?>b2b/b2b_view"> B2B Agent</a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Update B2B Agent</li>
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
                      <div class='title'>Update B2B Agent</div>
                      <div class='actions'>
                        <a class='btn btn-warning btn-xs has-tooltip' data-placement='top' title='Change Password' href='<?php echo WEB_URL; ?>b2b/change_password/<?php echo $id; ?>'>
                          <i class='icon-lock'></i>
                        </a>
                        <a class='btn btn-warning btn-xs has-tooltip' data-placement='top' title='View Profile' href='<?php echo WEB_URL; ?>b2b/view_profile/<?php echo $id; ?>'>
                          <i class='icon-search'></i>
                        </a>
                        <a class='btn btn-warning btn-xs has-tooltip' data-placement='top' title='View Bookings' href='<?php echo WEB_URL; ?>b2b/edit_b2c_user/<?php echo $id; ?>'>
                          <i class='icon-eye-close'></i>
                        </a>
                         <a class='btn btn-warning btn-xs has-tooltip' data-placement='top' title='Deposit Amount' href='<?php echo WEB_URL; ?>deposit/agent_deposit_view/<?php echo $id; ?>'>
                          <i class='icon-usd'></i>
                        </a>
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    <div class='box-content'>
                      <form class='form form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>b2b/update_agent/<?php echo $id;?>" method="post"  enctype="multipart/form-data"> 
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'>Name</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value="<?php echo $user->name; ?>" data-rule-required='true' id='validation_name' name='name' placeholder='Name' type='text'>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_company'>Company Name</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control'  value="<?php echo $user->company_name; ?>" data-rule-required='true' id='validation_company' name='company' placeholder='Company Name' type='text'>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_email'>E-mail</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value="<?php echo $user->email_id; ?>" data-rule-email='true' data-rule-required='true' id='validation_email' name='email3' placeholder='E-mail' type='text' disabled>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_contact'>Contact No</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value="<?php echo $user->mobile; ?>" data-rule-number='true' data-rule-required='true' id='validation_contact' name='phone' placeholder='Contact No' type='text'>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_office'>Office No</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value="<?php echo $user->office_phone; ?>" data-rule-number='true' data-rule-required='true' id='validation_office' name='office' placeholder='Office No' type='text'>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_country'>Country</label>
                          <div class='col-sm-4 controls'>
                            <select class='select2 form-control' data-rule-required='true' name='country' id="validation_country">
                              <?php foreach ($country as $countries) {  if($countries->name == $user->country){?>
                                <option value='<?=$countries->name;?>' selected><?=$countries->name;?></option>
                              <?php }else{?>
                                <option value='<?=$countries->name;?>'><?=$countries->name;?></option>
                              <?php }}?>
                           </select>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_city'>City</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value="<?php echo $user->city; ?>" data-rule-required='true' id='validation_city' name='city' placeholder='City' type='text'>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_contact'>Postal Code</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value="<?php echo $user->postal_code; ?>" data-rule-number='true' data-rule-required='true' id='validation_contact' name='postal' placeholder='Postal Code' type='text'>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_address'>Address</label>
                          <div class='col-sm-4 controls'>
                            <textarea class='form-control' data-rule-required='true' id='validation_address' placeholder='Address' name='address' rows='3'><?php echo $user->address; ?></textarea>
                          </div>
                        </div>
                        <hr class='hr-normal'>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_domain'>Domain</label>
                          <div class='col-sm-4 controls'>
                            <select class='select2 form-control' data-rule-required='true' name='domain' id="validation_domain">
                              <?php foreach ($domain_list as $domain) { if($domain->domain_name == $user->domain){?>
                                <option value='<?=$domain->domain_id;?>' selected><?=$domain->domain_name;?></option>
                                <?php }else{?>
                                <option value='<?=$domain->domain_id;?>'><?=$domain->domain_name;?></option>
                              <?php }}?>
                           </select>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_image'>Agent Logo</label>
                          <div class='col-sm-4 controls'>
                            <img src="<?php echo $user->agent_logo; ?>">
                          </div>
                        </div>
                        <div class='form-actions' style='margin-bottom:0'>
                          <div class='row'>
                            <div class='col-sm-9 col-sm-offset-3'>
                              <a href="<?php echo WEB_URL; ?>b2b/b2b_view"><button class='btn btn-primary' type='button'>
                                <i class='icon-reply'></i>
                                Go Back
                              </button></a>
                              <button class='btn btn-primary' type='submit'>
                                <i class='icon-save'></i>
                                Update Agent
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
