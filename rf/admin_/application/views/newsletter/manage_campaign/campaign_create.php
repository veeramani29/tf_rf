<!DOCTYPE html>
<html>
<head>
<style type="text/css">
    .cke_contents {
        height: 400px !important;
    }
    #helper_div {
        padding: 5px 10px 5px 10px;
        border: 1px solid #ccc;
        box-shadow: 0px 0px 10px #dedede;
        float: left;
        display: inline;
    }
    .arrow-left {
        width: 0; 
        height: s0; 
        border-top: 8px solid transparent;
        border-bottom: 8px solid transparent; 
        border-right:8px solid #555; 
        margin-left: -18px;
        float: left;
    }
</style>
    <title>Create Campaign | <?php echo PROJECT_NAME;?></title>
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
    <link href="<?=base_url();?>assets/stylesheets/bootstrap/bootstrap-fileinput.css" media="all" rel="stylesheet" type="text/css" />
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
                      <span>Create Campaign</span>
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
                         <a href="<?php echo WEB_URL; ?>newsletter/all_campaign">Manage Campaign</a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Create Campaign</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-header blue-background'>
                      <div class='title'>Create Campaign</div>
                      <div class='actions'>
                        
                      </div>
                    </div>
                    <div class='box-content'>
                      <form role="form" method="post" class="form-horizontal campaign_create" name="campaign_create" id="campaign_creatse" action="<?php echo WEB_URL; ?>newsletter/add_campaign/<?php echo ($id==0 ? 0 : $template_data->id); ?>" enctype="multipart/form-data">                                                               
                                    <div class="form-body">                                   
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Campaign Name</label>
                                                <div class="col-md-4">
                                                    <input class="form-control placeholder-no-fix helperText" data-helper="campaign_name" type="text" autocomplete="off" placeholder="Enter Campaign name" name="campaign_name" value="My campaign" />
                                                </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Email Subject</label>
                                                <div class="col-md-4">
                                                    <input class="form-control placeholder-no-fix helperText" data-helper="email_subject" type="text" autocomplete="off" placeholder="Enter Email Subject" name="campaign_email_subject" value="this is a campaign" />
                                                </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Email From</label>
                                                <div class="col-md-4">
                                                    <input class="form-control placeholder-no-fix helperText" data-helper="email_from" type="text" autocomplete="off" placeholder="Enter From email" name="campaign_from_email" value="" />
                                                </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Email From Name</label>
                                                <div class="col-md-4">
                                                    <input class="form-control placeholder-no-fix helperText" data-helper="email_from_name" type="text" autocomplete="off" placeholder="Enter From Email Name" name="campaign_from_name" value="" />
                                                </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Email To</label>
                                                <div class="col-md-4">
                                                    <input class="form-control placeholder-no-fix helperText" data-helper="campaign_email_to" type="text" autocomplete="off" placeholder="Enter receiver's email" name="campaign_email_to" value="" />
                                                </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Edit Template</label>
                                                <div class="col-md-8">
                                                   <textarea class="ckeditor form-control" name="campaign_template_content" rows="30" cols="200">
                                                        <?php echo ($id==0 ? '' : $template_data->template_content); ?>
                                                   </textarea>
                                                </div>
                                        </div>
                                        
                                    </div>  
                            <div class="form-actions fluid">
                                <div class="col-md-offset-3 col-md-9">
                                    <div class="margiv-top-10">
                                            <input type="submit" class="btn blue" value="Save Campaign" />                              
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
   
    <script src="<?=base_url();?>assets/javascripts/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>

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
