<!DOCTYPE html>
<html>
<head>
    <title>Change Basics Info | InnoGlobe</title>
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
                      <span>Change Basic Info</span>
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
                        <li class='active'>Change Basics Info</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-header blue-background'>
                      <div class='title'>Change Basics Info</div>
                      <div class='actions'>
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    
                    <div class='box-content'>
               <form action="<?php echo WEB_URL; ?>hotelcrs/edit_room_capacity_details/<?php echo $capacity_id; ?>" method="post"  enctype="multipart/form-data" class='validate form-horizontal'>
									     <div class='form-group'>
                          <label class='control-label col-sm-3'  for='validation_current'>Home Name </label>
                          <div class='col-sm-4 controls'>
                     	
                                  <div class='col-sm-6'>
                           <select name="hotel_name" class='form-control'   data-rule-required='true'>	
                           		<option value="">Select Hotel</option>										
										<?php if(!empty($all_hotels)) { foreach($all_hotels as $key => $value) { ?>
											<option value="<?php echo $value->sup_hotel_id; ?>" <?php if($room_capacity->hotel_id == $value->sup_hotel_id) { echo "selected='selected'"; } ?>><?php echo $value->hotel_name; ?></option>
										<?php } } ?>		
										</select>
                                      
                                    </div>
                                  </div>
                             
                          </div>
                        
                        
                        
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password' class="required"> Room Type</label>
                          <div class='col-sm-4 controls'>
                             
														   <div class='col-sm-6'>
                                    <div class='input-group'>
                                    <input type="text" name="capacity_title" class='form-control'   data-rule-required='true' value="<?php echo $room_capacity->capacity_title; ?>"> 
										
                                    </div>
                                  </div>
                                  
                                                               
                             
                                 </div>  </div>
                                 
                                 
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password_confirmation' class="required">Adult Capacity</label>
                          <div class='col-sm-4 controls'>
                           
                              <div class='col-sm-6'>
                                    <div class='input-group'>
                              	<input type="text" name="capacity" class='form-control'   data-rule-required='true' value="<?php echo $room_capacity->capacity; ?>">
										
                                    </div>
                                  </div> 
                         </div>
                        </div>
                        
                            <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password_confirmation' class="required">Chaild Capacity</label>
                          <div class='col-sm-4 controls'>
                           
                              <div class='col-sm-6'>
                                    <div class='input-group'>
                              			<input type="text" name="child_capacity"  class='form-control'   data-rule-required='true'  value="<?php echo $room_capacity->child_capacity; ?>" >
									
                                    </div>
                                  </div> 
                         </div>
                        </div>
                        
                        
                        
                        
                        
                        
                        <div class='form-actions' style='margin-bottom:0'>
                          <div class='row'>
                            <div class='col-sm-9 col-sm-offset-3'>
                              <a href="<?php echo WEB_URL; ?>hotelcrs/capacity_list"><button class='btn btn-primary' type='button'>
                                <i class='icon-reply'></i>
                                Go Back  
                              </button></a>
                              &nbsp
                              <input class='btn btn-primary' type='submit' value="Submit" name="sub">
                                 
                           
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
