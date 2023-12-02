<!DOCTYPE html>
<html>
<head>
    <title>Edit Package Images | InnoGlobe</title>
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
                      <span>Edit Package Images</span>
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
                        <li class='active'>Edit Package Images</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-header blue-background'>
                      <div class='title'>Edit Package Images</div>
                      <div class='actions'>
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    
                    <div class='box-content'>
                      <form class='form form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>packages/update_all_images" method="post" enctype="multipart/form-data"> 
			<input type="hidden" value="<?php echo $main_image->package_id; ?>" name="package_id" >                        
			<div class='form-group'>
                           <label class='col-sm-2' for='validation_company'>Main Image</label>
                                <div class='col-sm-3 controls'>
                                    <input type="file" title='Search for a image to add'   id='package_main_image' name='main_image'>
				    <img src="<?php echo $main_image->image; ?>" alt=""  width="100" height="100">                                    
					<span id="pacmimg" style="color:#F00; display:none">Please Upload Package Image</span>
                                </div>
                        </div>
			<hr>
			<div class='form-group'>
				<label class='col-sm-2' for='validation_company'>Update Other Images</label>
                           	<input type="hidden" value="<?php echo count($other_images) ?>" name="noofother">
				<?php if(!empty($other_images)){?>
				<?php for($oi=0;$oi<count($other_images); $oi++) {?>
					<input type="hidden" name="other_id[]" value="<?php echo $other_images[$oi]->img_id; ?>">
					
		                        <div class='col-sm-3 controls'>
		                            <input type="file" title='Search for a image to add'  id='package_other_images' name='other_images<?php echo $oi ?>'>
		                           <img src="<?php echo $other_images[$oi]->other_image; ?>" alt=""  width="100" height="100">      
					    <span id="pacmimg" style="color:#F00; display:none">Upload Package other Image</span>
						<a class="btn btn-danger btn-xs has-tooltip" data-placement="top" title="" onclick="return confirm('Are you sure, do you want to delete this record?');" href="<?php echo WEB_URL ?>packages/delete_other_image/<?php echo $other_images[$oi]->img_id; ?>/<?php echo $main_image->package_id; ?>" data-original-title="Delete">
                                              <i class="icon-remove"></i>
                                            </a>
					 </div>
				<?php }?>
				<?php } else{?>
					 <div class='col-sm-3 controls'> No other images found </div>
				<?php } ?>
                        </div>
			<hr>
			<div class='form-group'>
				<label class='col-sm-2'>Add New Other Images</label>
	                        <div class='col-sm-3 controls'>
	                            <input type="file" title='Search for a image to add' class='form-control' multiple name='new_other_images[]'>
	                        </div>
			</div>
			<hr>
			<div class='form-group'>
				<input type="hidden" value="<?php echo count($day_images) ?>" name="noofdays">
			     	<?php for($oi=0;$oi<count($day_images); $oi++) {?>
					<input type="hidden" name="day_id[]" value="<?php echo $day_images[$oi]->day_id; ?>">
		                   	<label class='col-sm-2' for='validation_company'>days <?php echo $oi+1; ?> Image</label>
		                        <div class='col-sm-3 controls'>
		                            <input type="file" title='Search for a image to add' id='package_day_images' name='day_images<?php echo $oi ?>'>
		                             <img src="<?php echo $day_images[$oi]->image; ?>" alt=""  width="100" height="100">   
					    <span id="pacmimg" style="color:#F00; display:none">Please Upload day Image</span>
		                        </div>
				<?php }?>
                        </div>
                  
               
                        <div class='form-actions' style='margin-bottom:0'>
                          <div class='row'>
                            <div class='col-sm-9 col-sm-offset-3'>
                              <a href="<?php echo WEB_URL; ?>packages/<?php //echo $result5->address; ?>"><button class='btn btn-primary' type='button'>
                                <i class='icon-reply'></i>
                                Go Back  
                              </button></a>
                              
                              <input type="submit" name="submit" value="Update Images" class='btn btn-primary'>
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
      $.validator.addMethod("pwdmatch", (function(value) {
        return value === "<?php echo $admin->password; ?>";
      }), "Please enter valid current password!");

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
