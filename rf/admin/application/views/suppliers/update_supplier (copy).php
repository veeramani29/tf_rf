<!DOCTYPE html>
<html>
<head>
    <title>Edit Suppliers Info | <?php echo PROJECT_NAME;?></title>
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
    
       <link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/style.css">
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
                      <span>Edit Suppliers Info</span>
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
                        <li class='active'>Edit Suppliers Info</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-header blue-background'>
                      <div class='title'>Edit Suppliers Info</div>
                      <div class='actions'>
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    
                    
                    <div class='box-content'>
                    
                    
                    
 <form action="<?php echo WEB_URL; ?>supplier/update_supplierbyId/<?php echo $this->uri->segment(3);?>" method="post"  enctype="multipart/form-data" class='validate form-horizontal'>								
												 <div class='form-group'>
                         	 <label class='control-label col-sm-3'  for='validation_current'>Hotel  </label>
                          	 <div class='col-sm-4 controls'>
                     	    <div class='col-sm-6'>
                            <div class='input-group'> 
                            <select name="hotel" id="hotel" class='required' >
                               <option value="">Slect Hotel</option>
                            <?php foreach($hotel as $r) {?>
									<option><?php echo $r->hotel_name; ?></option>  
									<?php } ?>                                  
                            </select>
                          </div>
                          </div> 
                          </div>
                          </div>
                          
                          <div class='form-group'>
                         	 <label class='control-label col-sm-3'  for='validation_current'>Email ID
  </label>
                          	 <div class='col-sm-4 controls'>
                     	    <div class='col-sm-6'>
                            <div class='input-group'> 
                       <input type="text" name="emailid" id="email" class="required email" value="<?php echo $result[0]->email;?>">
										<div id="email_error" style="color:#B94A48;"></div>
                          </div>
                          </div> 
                          </div>
                          </div>
                          
                          <div class='form-group'>
                         	 <label class='control-label col-sm-3'  for='validation_current'>Password  </label>
                          	 <div class='col-sm-4 controls'>
                     	    <div class='col-sm-6'>
                            <div class='input-group'> 
                       	<input type="password" name="password" id="password" class='required' value="<?php echo $result[0]->password;?>">
                          </div>
                          </div> 
                          </div>
                          </div>
                          
                          <div class='form-group'>
                         	 <label class='control-label col-sm-3'  for='validation_current'>Confirm Password
  </label>
                          	 <div class='col-sm-4 controls'>
                     	    <div class='col-sm-6'>
                            <div class='input-group'> 
                    <input type="password" name="confirm_password" id="confirm_password" class='required' equalto="#password" value="<?php echo $result[0]->password;?>">
									
                          </div>
                          </div> 
                          </div>
                          </div>
                          
                          <div class='form-group'>
                         	 <label class='control-label col-sm-3'  for='validation_current'>First Name
 </label>
                          	 <div class='col-sm-4 controls'>
                     	    <div class='col-sm-6'>
                            <div class='input-group'> 
                            <div class="controls">
              	<input type="text" name="fname" id="fname" class='required' value="<?php echo $result[0]->firstname;?>">
                        	</div>
                          </div>
                          </div> 
                          </div>
                          </div>
                      
                          
                          <div class='form-group'>
                         	 <label class='control-label col-sm-3'  for='validation_current'>Last Name
  </label>
                          	 <div class='col-sm-4 controls'>
                     	    <div class='col-sm-6'>
                            <div class='input-group'> 
                   <input type="text" name="lname" id="lname" class='required' value="<?php echo $result[0]->lastname;?>">
                          </div>
                          </div> 
                          </div>
                          </div>
                          
                          <div class='form-group'>
                         	 <label class='control-label col-sm-3'  for='validation_current'>Mobile Phone Number
  </label>
                          	 <div class='col-sm-4 controls'>
                     	    <div class='col-sm-6'>
                            <div class='input-group'> 
                   		<input type="text" name="mobile" id="mobile" class='required' value="<?php echo $result[0]->contact_no;?>">
                          </div>
                          </div> 
                          </div>
                          </div>
                          
                          <div class='form-group'>
                         	 <label class='control-label col-sm-3'  for='validation_current'>Phone Number
  </label>
                          	 <div class='col-sm-4 controls'>
                     	    <div class='col-sm-6'>
                            <div class='input-group'> 
                	<input type="text" name="ph_no" id="ph_no" class='required' value="<?php echo $result[0]->contact_no;?>">
                          </div>
                          </div> 
                          </div>
                          </div>
                          
                          
                              
                          <div class='form-group'>
                         	 <label class='control-label col-sm-3'  for='validation_current'>Adddress  </label>
                          	 <div class='col-sm-4 controls'>
                     	    <div class='col-sm-6'>
                            <div class='input-group'> 
                      		<input type="text" name="address" id="address" class='required' value="<?php echo $result[0]->address;?>">
                          </div>
                          </div> 
                          </div>
                          </div>
                          
                          
      
                          <div class='form-group'>
                         	 <label class='control-label col-sm-3'  for='validation_current'>Postal Code
  </label>
                          	 <div class='col-sm-4 controls'>
                     	    <div class='col-sm-6'>
                            <div class='input-group'> 
                          	<input type="text" name="post_code" id="post_code" class='required' value="<?php echo $result[0]->postal_code;?>">
                          </div>
                          </div> 
                          </div>
                          </div>
                        
                     
                        
                  
                        <div class='form-actions' style='margin-bottom:0'>
                          <div class='row'>
                            <div class='col-sm-9 col-sm-offset-3'>
                              <a href="<?php echo WEB_URL; ?>supplier/suppliers_list"><button class='btn btn-primary' type='button'>
                                <i class='icon-reply'></i>
                                Go Back  
                              </button></a> <input type="submit" class='btn btn-primary'>
                             	                                                                         
								<div class="form-actions">
									 
								</div>
                              
							         			 
							         			
                              
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
    
    
			<script src="<?=base_url();?>assets/javascripts/jquery/jquery.form.js"></script>
 
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
     <script src="<?=base_url();?>assets/javascripts/plugins/validate/custom.js"></script>
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
    
    <script>
	$("#addanother").click(function(){
			var addin = '<input type="text" name="ancountry" value="" placeholder="country" class="ma_pro_txt" style="margin:2px;"/><input type="text" name="anstate" placeholder="state" value="" class="ma_pro_txt" style="margin:2px;"/><input type="text" name="ancity" placeholder="city" value="" class="ma_pro_txt" style="margin:2px;"/><div onclick="removeinput()" style="font-weight:bold;cursor:pointer;">Remove</div><br/>';
			$("#addmorefields").html(addin);
	});

	function removeinput(){
		$("#addmorefields").html('');
	}
</script>

    <!-- / END - page related files and scripts [optional] -->
  </body>
</html>
