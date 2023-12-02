<!DOCTYPE html>
<html>
<head>
    <title>Add New Markup | <?php echo PROJECT_NAME;?></title>
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
                      <i class='icon-plus'></i>
                      <span>Add New Markup</span>
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
                         <a href="<?php echo WEB_URL; ?>markup_b2b"> Markup Management</a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Add Agent Markup</li>
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
                      <div class='title'>Add Agent Markup</div>
                      <div class='actions'>
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a>
                      </div>
                    </div>
                    <div class='box-content'>
                      <form class='form form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>markup_b2b/save_markup_b2b_agent" method="post"  enctype="multipart/form-data" onsubmit="return validateDup()"> 
                        
								<div id="msg"></div>                        
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='agent'>Agent</label>
                          <div class='col-sm-4 controls'>
                            <select class='select2 form-control' data-rule-required='true' id='agent' name='agent'>
                            <option value="">Add Agent</option>
                              <?php foreach ($agents as $agent) { ?>
                              <option value="<?=$agent->agent_id;?>"><?=$agent->company_name.' - '.$agent->firstname;?></option>  
                              <?php }?> 
                            </select>
                          </div>
                        </div>
                        
                         <!--  <div class='form-group'>
                          <label class='control-label col-sm-3' for='agent'>Country</label>
                          <div class='col-sm-4 controls'>
                          <select class='select2 form-control' data-rule-required='true' id='country' name='country'>
                      <option value="">Select Country</option>
                          <?php foreach ($country as $cou) { ?>
                          <option value="<?php echo $cou->country_id;?>"><?php echo $cou->name;?></option>
                          <?php }?> 
                          </select>
                          </div>
                          </div> -->
                          
                          
  								  <div class='form-group'>
                          <label class='control-label col-sm-3' for='agent'>Api - Product</label>
                          <div class='col-sm-4 controls'>
                          <select class='select2 form-control' data-rule-required='true' id='api' name='api'>
                            <option value="">Select Api</option>
                            <option value="FLIGHT">Flight</option>
                            <option value="HOTEL">Hotel</option>
                            <option value="HOTELCRS">Hotel CRS</option>
                            <option value="CAR">Car</option>
                            <option value="VACATION">Vacation</option>
                          </select>
                          	<input type="hidden" id="tempStatus"/>
                          </div>
                          </div>
                          
                          
 								 
                        
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='markup'>Markup (%)</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control'  data-rule-number='true' data-rule-required='true' id='markup' name='markup' placeholder='Markup' type='text'>
                          </div>
                        </div>
                        <div class='form-actions' style='margin-bottom:0'>
                          <div class='row'>
                            <div class='col-sm-9 col-sm-offset-3'>
                              <a href="<?php echo WEB_URL; ?>markup_b2b"><button class='btn btn-primary' type='button'>
                                <i class='icon-reply'></i>
                                Go Back
                              </button></a>
                              <button class='btn btn-primary' type='submit'>
                                <i class='icon-plus'></i>
                                Add Markup
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
    
      <script src="<?=base_url();?>assets/javascripts/jquery/jquery-1.10.2.js" type="text/javascript"></script>
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
      $("#select2-tags").select2({
        tags: [],
        tokenSeparators: [",", " "],
        placeholder: "Type email id's here... separated by (,)"
      });
    </script>
    
    
    
    

<script type="text/javascript">

$(document).ready(function(){
$("#agent, #country, #api").change(function(){
   
 
	var agent=$("#agent").val();
	var country=$("#country").val()
	var api=$("#api").val();
 
 $("#msg").css({"color":"red"});
	 
		if(agent != '' && country !='' && api != ''){
	   $.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>markup_b2b/add_spe_markup_chk",
	 	data: { age :agent, con:country, api:api},
	 	dataType: 'json',
		success: function (msg){
			if(msg.status == '0'){
				$("#msg").show();
				$("#msg").html('Already markup has been added to this agent');
		   	$('#tempStatus').val('false');
			}else{
				$('#tempStatus').val('true');
				$("#msg").hide();
				$("#msg").html('');
			} 
		 	
	 	}
	
	});
	}
	
	});
	

	

});

function validateDup(){
	var status = $('#tempStatus').val();
	if(status == 'false'){
		return false;
	}else{
		return true;
	}
}
</script>




    <!-- / END - page related files and scripts [optional] -->
  </body>
</html>
