<!DOCTYPE html>
<html>
<head>
    <title>Support Management | InnoGlobe</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta content='text/html;charset=utf-8' http-equiv='content-type'>
    
    <link href='<?=base_url();?>assets/images/meta_icons/favicon.ico' rel='shortcut icon' type='image/x-icon'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon.png' rel='apple-touch-icon-precomposed'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-57x57.png' rel='apple-touch-icon-precomposed' sizes='57x57'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-72x72.png' rel='apple-touch-icon-precomposed' sizes='72x72'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-114x114.png' rel='apple-touch-icon-precomposed' sizes='114x114'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-144x144.png' rel='apple-touch-icon-precomposed' sizes='144x144'>
    <style type="text/css">
    .chat form a.file-input-wrapper{position: absolute;top: 0;right: 40px;height: 45px;width: 37px;}
    </style>
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
                      <i class='icon-ticket'></i>
                      <span>Support Ticket</span>
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
                        <li><a href="<?php echo WEB_URL; ?>support/support_view"> Support Ticket</a></li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>View Ticket - <?php echo $ticketrow->support_ticket_id; ?></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class='row timeline'>
                <div class='col-sm-12'>
                  <ol class='list-unstyled'>
                    <?php foreach ($ticket as $tickets) { if($tickets->last_updated_by == 'Admin'){?>
                     <li>
                      <div class='icon orange-background'>
                        <i class='icon-user'></i>
                      </div>
                      <div class='title'>
                        Admin <font class='text-muted'>says</font>
                        <small class='text-muted'><?php echo $this->Support_Model->calculate_time_ago($tickets->last_update_time);?> <i class="icon-time"></i></small>
                      </div>
                      <div class='content'>
                        <?php echo $tickets->message; ?>

                         <?php if($tickets->file_path!=''){
                        $file =   strtr(base64_encode($tickets->file_path),array('+' => '.','=' => '-','/' => '~'));
                        $a = explode('support_ticket', $tickets->file_path);
                        $name1 = substr($a[1],3);
                        ?>
                        <hr class='hr-normal'>
                        <a  href="<?php echo WEB_URL; ?>support/download_file/<?php echo $file; ?>"> <i class='icon-download-alt'></i> : <?php echo $name1; ?></a> 
                        <?php }?>
                      </div>
                    </li>
                    <?php }else{ $user_details = $this->Support_Model->get_user_details($ticketrow->user_type,$ticketrow->user_id);?>
                    <li>
                      <div class='icon primary-background'>
                        <i class='icon-users'>
                        <?php if($ticketrow->user_type == '3'){ ?>
                            <a href="<?php echo WEB_URL; ?>b2c/view_profile/<?= $ticketrow->user_id; ?>/3" class='has-popover' data-title="<?php echo $user_details->name; ?>" data-content="<?php echo 'Email :'.' '.$user_details->email ;echo ', '; echo 'City :'.' '.$user_details->city; echo ', '; echo 'Country :'.' '.$user_details->country ;echo ', '; echo 'Contact No :'.' '.$user_details->mobile;?>">
                               <img src="<?php echo $user_details->image; ?>" width="35" height="35" >
                           </a>
                         <?php }elseif ($ticketrow->user_type == '2') { ?>
                            <a href="<?php echo WEB_URL; ?>b2b/view_profile/<?= $ticketrow->user_id; ?>/2" class='has-popover' data-title="<?php echo $user_details->name; ?>" data-content="<?php echo 'Email :'.' '.$user_details->email ;echo ', '; echo 'City :'.' '.$user_details->city; echo ', '; echo 'Country :'.' '.$user_details->country ;echo ', '; echo 'Contact No :'.' '.$user_details->mobile;?>">
                               <img src="<?php echo $user_details->image; ?>" width="35" height="35" >
                            </a>
                         <?php } else{?>
                            <a href="#" class='has-popover' data-title="<?php echo $user_details->name; ?>" data-content="<?php echo 'Email :'.' '.$user_details->email ;echo ', '; echo 'City :'.' '.$user_details->city; echo ', '; echo 'Country :'.' '.$user_details->country ;echo ', '; echo 'Contact No :'.' '.$user_details->mobile;?>">
                              <img src="<?php echo $user_details->image; ?>" width="35" height="35" >
                           </a>
                         <?php }?>
                       </i>
                      </div>
                      <div class='title'>
                        <?php echo $user_details->name; ?> <font class='text-muted'>says</font>
                        <small class='text-muted'><?php echo $this->Support_Model->calculate_time_ago($tickets->last_update_time);?> <i class="icon-time"></i></small>
                      </div>
                      <div class='content'>
                        <?php echo $tickets->message; ?>
                         <?php if($tickets->file_path!=''){
                        $file =   strtr(base64_encode($tickets->file_path),array('+' => '.','=' => '-','/' => '~'));
                        $a = explode('support_ticket', $tickets->file_path);
                        $name1 = substr($a[1],3);
                        ?>
                        <hr class='hr-normal'>
                        <a  href="<?php echo WEB_URL; ?>support/download_file/<?php echo $file; ?>"> <i class='icon-download-alt'></i> : <?php echo $name1; ?></a> 
                        <?php }?>
                      </div>
                    </li>
                    <?php }}?>
                    <li>
                      <div class='icon green-background'>
                        <i class='icon-comments'></i>
                      </div>
                      <div class='title'>
                       Message
                        <small class='text-muted'>Maximum 150 Chars allowed</small>
                      </div>
                      <div class='content chat' style="padding: 0px;">
                        <form class="form new-message validate-form" method="post" action="<?php echo WEB_URL; ?>support/reply_ticket/<?php echo $id; ?>" enctype="multipart/form-data" autocomplete="off">
                          <input type="hidden" name="subject" value="<?php echo $ticketrow->subject; ?>">
                          <input type="hidden" name="domain" value="<?php echo $ticketrow->domain; ?>">
                          <input type="hidden" name="user_type" value="<?php echo $ticketrow->user_type; ?>">
                          <input type="hidden" name="user_id" value="<?php echo $ticketrow->user_id; ?>">
                          <input type="hidden" name="support_ticket_id" value="<?php echo $ticketrow->support_ticket_id; ?>">
                          <input style="padding-right: 79px;" maxlength='150' class='char-max-length form-control' id='message_body' data-rule-required='true' name='textcounter' placeholder='Type your message here...' type='text' autofocus>
                          <input type="file" title='' class='btn btn-primary' name='file_name'>
                          <i class="icon-paper-clip" style="position: absolute;top: 15px;right: 53px;z-index: 1;"></i>
                          <button class='btn btn-success' type='submit'>
                            <i class='icon-plus'></i>
                          </button>
                        </form>
                      </div>
                    </li>
                  </ol>
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
    <script src="<?=base_url();?>assets/javascripts/plugins/charCount/charCount.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/bootstrap_maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
    <!-- / END - page related files and scripts [optional] -->
    <script>
      $.validator.addMethod("buga", (function(value) {
        return value === "buga";
      }), "Please enter \"buga\"!");
      
      $.validator.methods.equal = function(value, element, param) {
        return value === param;
      };
    </script>
  </body>
</html>
