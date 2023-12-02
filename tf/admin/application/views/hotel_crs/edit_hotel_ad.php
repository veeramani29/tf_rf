<!DOCTYPE html>
<html>
<head>
    <title>Edit Hotel Info | <?php echo PROJECT_NAME;?></title>
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
    <link href="<?=base_url();?>assets/stylesheets/jquery/jquery_ui.css" media="all" rel="stylesheet" type="text/css" />    <!-- / theme file [required] -->
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
  <body class='contrast-dark fixed-header thebg'>
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
                      <span>Edit Hotel Info</span>
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
                        <li class='active'>Edit Hotel Info</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-header blue-background'>
                      <div class='title'>Edit Hotel Info</div>
                      <div class='actions'>
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    
                    
                    <div class='box-content'>
                    
                    
                    
     <form class='form form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo WEB_URL;?>hotelcrs/update_hotel/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4);?>" name="f1" method="post"> 
   
    <div class='form-group'>
                          <label class='control-label col-sm-3'  for='validation_current'>Hotel Name: </label>
                          <div class='col-sm-4 controls'>
                     	
                            
                      <input size="10" name="pro_name" id="pro_name" type="text" class='form-control'  data-rule-required='true' value="<?php if(isset($contact_inf->hotel_name)) echo $contact_inf->hotel_name; ?>"/><?php echo form_error('pro_name');?>	
                                   
                                   </div>
                        </div>
                        
                        
                             <!-- <div class='form-group'>
                          <label class='control-label col-sm-3'  for='validation_current'>Hotel Chain Name: </label>
                          <div class='col-sm-4 controls'>
                     	
                                 
            <input name="hotel_chain_name" id="hotel_chain_name" type="text" class='form-control'  data-rule-required='true' value="<?php if(isset($contact_inf->hotel_chain_name)){ echo $contact_inf->hotel_chain_name; } ?>"/><?php echo form_error('hotel_chain_name');?>
								
                                     </div>
                                    </div>  -->
                        <div class='form-group'>
                          <label  class='control-label col-sm-3 col-sm-3' for='validation_name'>City</label>
                          <div class='col-sm-4 controls'>
                            <div class="controls">
                             <input  class='form-control' style="width:300px;" type="text"  autocomplete="off" spellcheck name="country_val" id="country_val" placeholder="Ex:- Dubai, UAE" data-rule-required='true' value="<?php echo $contact_inf->city;?>">
                            </div>
                          </div>
                        </div>
                        
                        
                        
                        
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'>Star:</label>
                          <div class='col-sm-4 controls'>
                             
													 
               											<input name="hotel_star" id="hotel_star" type="text"   class='form-control' data-rule-required='true' value="<?php echo $contact_inf->star; ?>" data-rule-number='true'/>
                               </div>
                                  </div>
                               
                         <h3>Contact Information:</h3>
                         <hr class="hr-normal">
                       	
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'>Phone:
</label>
                          <div class='col-sm-4 controls'>
                             
													 
                           			<input name="main_phone" type="text" class='form-control' data-rule-number='true' data-rule-required='true' value="<?php if(isset($contact_inf->res_phone )){ echo $contact_inf->res_phone ; } ?>" />
								   </div>
                                  </div>
                          
                        
                        
 											 <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'>Fax :</label>
                          <div class='col-sm-4 controls'>
                              
                                 	<input name="main_fax" type="text" class='form-control' data-rule-required='true'  value="<?php if(isset($contact_inf->res_fax )){ echo $contact_inf->res_fax ; } ?>" data-rule-number='true'/>												
								  </div>
                                  </div>
                      
                        
                        
                          <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'>Hotel Address :</label>
                          <div class='col-sm-4 controls'>
                             
														 
                                  <textarea  cols="50" class='form-control' data-rule-required='true' name="hotel_address"><?php if(isset($contact_inf->address )){ echo $contact_inf->address; } ?></textarea>
								   </div>
                                  </div>
                   
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'>Hotel Description:</label>
                          <div class='col-sm-4 controls'>
                             
														    
                              		<textarea style="" class='form-control' data-rule-required='true' cols="50" name="hotel_desc"><?php if(isset($contact_inf->descrip )){ echo $contact_inf->descrip; } ?></textarea>
							  </div>
                                  </div>
                            
                        
                        <div class="control-group" style="display:none;">
										<label for="pw33" class="control-label">Nearby Airport:</label>
										<div class="controls">
											<input name="nearby_area" type="hidden" class="ma_pro_txt" value="" />
										</div> 	
                                       
									</div>
									<div class="control-group" style="display:none;">
										<label for="pw33" class="control-label">Near By Attraction:</label>
										<div class="controls">
											<input name="nearby_attraction" type="hidden" class="ma_pro_txt" value="" />
										</div> 	
                                       
									</div>
                        
                        
                        
                               <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'>Latitude
 :</label>
                          <div class='col-sm-4 controls'>
                             
													 
                              <input type="text" name ="latitude"    class='form-control' value="<?php if(isset($contact_inf->latitude )){ echo $contact_inf->latitude; } ?>" id="lat" >
                               </div>
                                  </div>
                         
                        
                        
                          <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'>Longitude :</label>
                          <div class='col-sm-4 controls'>
                             
												 
  <input type="text" name ="longitude" value="<?php if(isset($contact_inf->longitude )){ echo $contact_inf->longitude; } ?>" id="lng" class='form-control' >	
                               </div>
                                  </div>
                   <hr class="hr-normal">
                   <div class='form-group'>
                      <label class='col-md-2 control-label'>Amenites :</label>
                      <div class='col-md-10'>
                      <?php $i=0; foreach ($amenites as $key => $amenity) { if($amenity->value != ''){?>
                       <div class="col-md-4">
                       <label class='checkbox-inline'>
                          <input type='checkbox' name="amenity[]" value='<?php echo $amenity->id;?>' <?php if(in_array($amenity->id, $ame)){echo 'checked';}?>>
                          <?php echo $amenity->value;?>
                        </label>
                        </div>
                      <?php }}?>
                      </div>
                    </div>
                        
                  
                        <div class='form-actions' style='margin-bottom:0'>
                          <div class='row'>
                            <div class='col-sm-9 col-sm-offset-3'>
                              <a href="<?php echo WEB_URL; ?>hotelcrs"><button class='btn btn-primary' type='button'>
                                <i class='icon-reply'></i>
                                Go Back  
                              </button></a>
                              
                              
							         			<input type="submit" class='btn btn-primary' value="Update" />
							         			
                              
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
    

<script type="text/javascript">
$(function() {
  $("#country_val").autocomplete({
    source: "<?php echo WEB_URL;?>hotelcrs/get_hotel_city_suggestions",
    minLength: 2,//search after two characters
    autoFocus: true, // first item will automatically be focused
    select: function(event,ui){
        
    }
  });
});    
</script>
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
