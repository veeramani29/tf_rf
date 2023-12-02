<!DOCTYPE html>
<html>
<head>
    <title>Update Settings | InnoGlobe</title>
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
                      <div class='title'>Update Settings</div>
                      <div class='actions'>
                        <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                        </a>
                        
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    <div class='box-content'>
                      <form class='form form-horizontal validate-form'   style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>home_settings/updatePortfolio" method="post"  enctype="multipart/form-data"> 
			<?php  foreach($edit as $e){?>
			<?php if($e->language=='english'){ ?>
			<div class='form-group'>
			   <input type="hidden" name="languages[]" value="<?php echo $e->language; ?>" >	
			   <input type="hidden" name="language_id[]" value="<?php echo $e->id; ?>" >
                          <label class='control-label col-sm-3' for='validation_email'>English</label>
			  <div class='col-sm-4 controls'>
                            <input class='form-control'  data-rule-required='true' id='' name='title[]' placeholder='Title' type='text' value="<?php echo ($e->language=='english') ?  $e->title: '';?>">
                          </div>
			 <div class='col-sm-4 controls'>
                            <input class='form-control'  data-rule-required='true' id='' name='description[]' placeholder='Description' type='text' value="<?php echo ($e->language=='english') ?  $e->description: '';?>">
                          </div>
                        </div>
			<?php } else if($e->language=='arabic'){?>
			<div class='form-group'>
			    <input type="hidden" name="languages[]" value="<?php echo $e->language; ?>" >
			   <input type="hidden" name="language_id[]" value="<?php echo $e->id; ?>" >
                          <label class='control-label col-sm-3' for='validation_email'>Arabic</label>
			  <div class='col-sm-4 controls'>
                            <input class='form-control'   id='' name='title[]' placeholder='Title' type='text' value="<?php echo ($e->language=='arabic') ?  $e->title: '';?>" >
                          </div>
			 <div class='col-sm-4 controls'>
                            <input class='form-control'   id='' name='description[]' placeholder='Description' type='text' value="<?php echo ($e->language=='arabic') ?  $e->description: '';?>">
                          </div>
                        </div>
			<?php } else if($e->language=='french'){?>
			<div class='form-group'>
            		    <input type="hidden" name="languages[]" value="<?php echo $e->language; ?>" >
			   <input type="hidden" name="language_id[]" value="<?php echo $e->id; ?>" >
                          <label class='control-label col-sm-3' for='validation_email'>French</label>
			  <div class='col-sm-4 controls'>
                            <input class='form-control'   id='' name='title[]' placeholder='Title' type='text' value="<?php echo ($e->language=='french') ?  $e->title: '';?>">
                          </div>
			 <div class='col-sm-4 controls'>
                            <input class='form-control'   id='' name='description[]' placeholder='Description' type='text' value="<?php echo ($e->language=='french') ?  $e->description: '';?>">
                          </div>
                        </div>	
			<?php } else if($e->language=='german'){?>
			<div class='form-group'>
			   <input type="hidden" name="languages[]" value="<?php echo $e->language; ?>" >
			   <input type="hidden" name="language_id[]" value="<?php echo $e->id; ?>" >
                          <label class='control-label col-sm-3' for='validation_email'>German</label>
			  <div class='col-sm-4 controls'>
                            <input class='form-control'   id='' name='title[]' placeholder='Title' type='text' value="<?php echo ($e->language=='german') ?  $e->title: '';?>">
                          </div>
			 <div class='col-sm-4 controls'>
                            <input class='form-control'   id='' name='description[]' placeholder='Description' type='text' value="<?php echo ($e->language=='german') ?  $e->description: '';?>">
                          </div>
                        </div>
			<?php } else if($e->language=='spanish'){?>
			<div class='form-group'>
			  <input type="hidden" name="languages[]" value="<?php echo $e->language; ?>" >
			   <input type="hidden" name="language_id[]" value="<?php echo $e->id; ?>" >
                          <label class='control-label col-sm-3' for='validation_email'>Spanish</label>
			  <div class='col-sm-4 controls'>
                            <input class='form-control'   id='' name='title[]' placeholder='Title' type='text' value="<?php echo ($e->language=='spanish') ?  $e->title: '';?>">
                          </div>
			 <div class='col-sm-4 controls'>
                            <input class='form-control'   id='' name='description[]' placeholder='Description' type='text' value="<?php echo ($e->language=='spanish') ?  $e->description: '';?>">
                          </div>
                        </div>
			<?php } else if($e->language=='farsi'){?>
			<div class='form-group'>
			   <input type="hidden" name="languages[]" value="<?php echo $e->language; ?>" >
			  <input type="hidden" name="language_id[]" value="<?php echo $e->id; ?>" >
                          <label class='control-label col-sm-3' for='validation_email'>Farsi</label>
			  <div class='col-sm-4 controls'>
                            <input class='form-control'   name='title[]' placeholder='Title' type='text' value="<?php echo ($e->language=='farsi') ?  $e->title: '';?>">
                          </div>
			 <div class='col-sm-4 controls'>
                            <input class='form-control'   id='' name='description[]' placeholder='Description' type='text' value="<?php  echo ($e->language=='farsi') ?  $e->description: '';?>">
                          </div>
                        </div>
			<?php } }?>
			<div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_image'>Portfolio image</label>
                          <div class='col-sm-4 controls'>
                            <input type="file" title='Search for a image to add' class='form-control'  id='validation_image' name='image' value="<?php echo $edit[0]->image;?>">
			    <input type="hidden" name="hidden_image" value="<?php echo $edit[0]->image;?>">
                            <input type="hidden" name="image_id" value="<?php echo $edit[0]->home_portfolio_id; ?>" >
			 </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_email'>Link</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-url='true' data-rule-required='true' id='validation_url' name='link' placeholder='Url' type='text' value="<?php echo $edit[0]->link;?>">
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
