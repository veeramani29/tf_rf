<!DOCTYPE html>
<html>
<head>
    <title>Submenu Content | <?php echo PROJECT_NAME;?></title>
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
                      
                      <span>Submenu Content</span>
                    </h1>
                    <div class='pull-right'>
                      <ul class='breadcrumb'>
                        <li>
                          <a href="<?php echo WEB_URL; ?>help_center/index">
                            <i class='icon-bar-chart'></i>
                          </a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li>
                         <a href="<?php echo WEB_URL; ?>apartment/index"> Back to Apartments</a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                       <!-- <li class='active'>Agent profile</li> -->
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class='row'>
         
                <div class='col-sm-12'>
		<div class='box'>
                    <div class='box-header blue-background'>
                	<div class='title' id="tab3">Links</div>
               		<div class='actions'></div>
            	   </div>
                    <div class='box-content'>
                       <form class='form form-horizontal validate-form' id='linkForm' style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>help_center/update_content_links/<?php echo $result->cont_id; ?>" method="post" name="frm3" enctype="multipart/form-data"> 
                    <div class='form-group'>
                        <label class='control-label col-sm-3 col-sm-3' for='validation_name'>Title</label>
                        <div class='col-sm-4 controls'>
                            <input type="hidden" name="menu_id" id="menu_id" value="<?php echo $result->menu_id; ?>">
                            <input type="hidden" name="sub_id" id="sub_id" value="<?php echo $result->sub_menu_id; ?>">
                            <input type="hidden" name="content_type" class="content_type" value="3">
                            <input class='form-control linkTitle' data-rule-minlength='2' data-rule-required='true' value="<?php echo $result->con_title; ?>" id='linkTitle' name='title' placeholder='Title' type='text'>
                        </div>
                    </div>

                    <div class='form-group' col-sm-4 controls>
                        <label class='control-label col-sm-3 col-sm-3' for='validation_name'>Heading</label>
                        <div class='col-sm-4 controls'>
                            <input class='form-control heading' data-rule-minlength='2' data-rule-required='true' value="<?php echo $result->hedding; ?>" id="heading" name='Hedding' placeholder='Heading' type='text'>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label class='control-label col-sm-3' for='validation_email'>Content</label>
                        <div class='row'>
                            <div class='col-sm-8'>
                                <div class='box'>
                                    <div class='box-header blue-background'>
                                        <div class='title'>Content</div>
                                        <div class='actions'></div>
                                    </div>
                                    <div class='box-content'>
                                      <textarea name="con_link" class='form-control ckeditor link_content' rows='10' data-rule-required='true'><?php echo $result->content; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='form-actions' style='margin-bottom:0'>
                        <div class='row'>
                            <div class='col-sm-9 col-sm-offset-3'>
                              <a href="<?php echo WEB_URL; ?>help_center/content_view/<?php echo $result->menu_id; ?>/<?php echo $result->sub_menu_id; ?>">
                                <button class='btn btn-primary' type='button'>
                                    <i class='icon-reply'></i>
                                    Back
                                </button>
                              </a>
                              <input type="submit" name="update" value="Update Links" class='btn btn-primary' >
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
    <script src="<?=base_url();?>assets/javascripts/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <!-- / theme file [required] -->
    <script src="<?=base_url();?>assets/javascripts/theme.js" type="text/javascript"></script>
    <!-- / demo file [not required!] -->
    <script src="<?=base_url();?>assets/javascripts/demo.js" type="text/javascript"></script>
    <!-- / START - page related files and scripts [optional] -->
    
    <!-- / END - page related files and scripts [optional] -->
  </body>
</html>
