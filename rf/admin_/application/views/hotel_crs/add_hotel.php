<!DOCTYPE html>
<html>
<head>
    <title>Add New Hotel Info | <?php echo PROJECT_NAME;?></title>
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
                      <span>Add New Hotel Info</span>
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
                        <li class='active'>Add New Hotel Info</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-header blue-background'>
                      <div class='title'>Add New Hotel Info</div>
                      <div class='actions'>
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    
                    <div class='box-content'>
                      <form class='form form-horizontal validate-form'   style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>hotelcrs/add_data/admin"  name="f1" method="post"> 
                       
                       
                        
                             <div class='form-group'>
                          <label  class='control-label col-sm-3 col-sm-3' for='validation_name' >Hotel Name: </label>
                       
                     	
                                  <div class='col-sm-4 controls'>
                            
                       <input name="pro_name" id="pro_name" type="text" class='form-control'   data-rule-required='true'  placeholder="Hotel Name" style="width:300px;">	
                              
                                    </div> 
                                  
                            </div>
                        
                        
                            
                        

                        <div class='form-group'>
                          <label  class='control-label col-sm-3 col-sm-3' for='validation_name'>City</label>
                          <div class='col-sm-4 controls'>
                            <div class="controls">
                          	 <input  class='form-control' style="width:300px;" type="text"  autocomplete="off" spellcheck name="country_val" id="country_val" placeholder="Ex:- Dubai, UAE" data-rule-required='true'>
    										    </div>
                          </div>
                        </div>
                        
                        
                        
                        <div class='form-group'>
                          <label  class='control-label col-sm-3 col-sm-3' for='validation_name'>Star</label>
                         
                             
														   <div class='col-sm-4 controls'>
                                
                   <input style="width:300px;" name="hotel_star" class='form-control' id="hotel_star" type="text"  data-rule-required='true' placeholder="star" data-rule-number='true'/>
                              
                                  </div>
                                 
                        </div>
                        <hr class="hr-normal">
                         <h3>Contact Information:</h3>
                        
                       	
                        
                        
                        
                       
                        
                        
                        
                     
                        
                        
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'>Phone:
</label> 
                              <div class='col-sm-4 controls'>
														 
                                    
                           		<input name="main_phone" type="text" placeholder="Phone" class='form-control' style="width:300px;"  data-rule-number='true' data-rule-required='true'  />
                               
                                  </div>
                                   
                        </div>
                        
                        
                        
 											 <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'>Fax :</label>
                        
                             
														  
                                  <div class='col-sm-4 controls'>
                                 	<input name="main_fax" type="text" placeholder="Fax" class='form-control' style="width:300px;"   data-rule-required='true' data-rule-number='true' />	
                               </div>
                                 
                                  
                        </div>
                        
                        
                        
                          <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'>Hotel Address :</label>
                        
                             
														 
                                    <div class='col-sm-4 controls'>
                                  	<textarea   cols="50" class='form-control' placeholder="Hotel Address" name="hotel_address" style="width:300px;"  data-rule-required='true'></textarea>	
                               </div>
                                 
                               
                        </div>
                        
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'  >Hotel Description:</label>
                    
                             
														   
                                   <div class='col-sm-4 controls'>
                              		<textarea   cols="15" name="Hotel_desc"  style="width:300px;" class='form-control' placeholder="Hotel Description"  data-rule-required='true'></textarea>
                              
                                  </div>
                                 
                        </div>
                        
                        
                        <div class="control-group" style="display:none;">
										<label for="pw33" class="control-label">Nearby Airport:</label>
										<div class="controls">
											<input name="nearby_area" type="hidden" class="ma_pro_txt" value=""  style="width:250px;"/>
										</div> 	
                                       
									</div>
									<div class="control-group" style="display:none;">
										<label for="pw33" class="control-label">Near By Attraction:</label>
										<div class="controls">
											<input name="nearby_attraction" type="hidden" class="ma_pro_txt" value="" style="width:300px;" />
										</div> 	
                                       
									</div>
                        
                        
                        
  <div class='form-group'>
                          <label class='control-label col-sm-3' for=''>Latitude:
 :</label>
                            
														  <div class='col-sm-4 controls'>
                                    <div class='input-group'>
                                   <input name="latitude" id="latitude" type="text" placeholder="Latitude" class='form-control' style="width:300px;"    />	
                               </div>
                                   
                                   </div>
                        </div>
                        
                        
                        
                          <div class='form-group'>
                          <label class='control-label col-sm-3'   for='validation_password'>Longitude :</label>
                          <div class='col-sm-4 controls'>
                             
														 
                                    <div class='input-group'>
                              <input class='form-control'    name="longitude" id="longitude" style="width:300px;"  type="text" placeholder="Longitude" />	
                               </div>
                                  
                                   </div>
                        </div>
                    <hr class="hr-normal">
                   <div class='form-group'>
                      <label class='col-md-2 control-label'>Amenites :</label>
                      <div class='col-md-10'>
                      <?php $i=0; foreach ($amenites as $key => $amenity) { if($amenity->value != ''){?>
                       <div class="col-md-4">
                       <label class='checkbox-inline'>
                          <input type='checkbox' name="amenity[]" value='<?php echo $amenity->id;?>'>
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
                              <button class='btn btn-primary' type='submit' name="sub">
                                <i class='icon-save'></i>
                                Add Hotel
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
    
    <script src="<?=base_url();?>assets/javascripts/plugins/validate/custom.js"></script>
    
  

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
			var addin = '<input type="text" name="ancountry" value="" placeholder="country" class="ma_pro_txt" style="margin:2px;"/><input type="hidden" name="anstate" placeholder="state" value="" class="ma_pro_txt" style="margin:2px;"/><input type="text" name="ancity" placeholder="city" value="" class="ma_pro_txt" style="margin:2px;"/><div onclick="removeinput()" style="font-weight:bold;cursor:pointer;">Remove</div><br/>';
			$("#addmorefields").html(addin);
	});

	function removeinput(){
		$("#addmorefields").html('');
	}
</script>


<!--
<script>
function city_list(val)
{							
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("city_view").innerHTML=xmlhttp.responseText;									
		}
	}
	xmlhttp.open("GET","<?php echo WEB_URL; ?>hoteldata/get_citylist/"+val,true);
	xmlhttp.send();
}

$('select[name=\'country\']').bind('change', function() {
	$.ajax({
		url: '<?php echo site_url(); ?>/hotelcrs/get_city?country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country\']').after('<span class="wait">&nbsp;<img src="<?php echo base_url(); ?>img/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			$('select[name=\'city\']').html(json.city_list);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'city\']').bind('change', function() {
	$.ajax({
		url: '<?php echo site_url(); ?>/hotelcrs/get_hotels?city_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'city\']').after('<span class="wait">&nbsp;<img src="<?php echo base_url(); ?>img/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			$('select[name=\'hotel\']').html(json.hotel_list);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'country\']').trigger('change');

</script>

-->

    <!-- / END - page related files and scripts [optional] -->
  </body>
</html>
