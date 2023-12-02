<?php $extra=$this->uri->segment(3, 0); $offer_details=$offer_details[0]; //print_r($offer_details);exit;?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo ($extra!='')?"Update":"Add New";?> Offer | <?php echo PROJECT_NAME;?></title>
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
    <link href="<?=base_url();?>assets/stylesheets/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/stylesheets/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/stylesheets/plugins/tabdrop/tabdrop.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / bootstrap [required] -->
    <link href="<?=base_url();?>assets/stylesheets/bootstrap/bootstrap.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / theme file [required] -->
    <link href="<?=base_url();?>assets/stylesheets/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
    <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
    <link href="<?=base_url();?>assets/stylesheets/theme-colors.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / demo file [not required!] -->
    <link href="<?=base_url();?>assets/stylesheets/demo.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/stylesheets/bootstrap-wysihtml5.css" media="all" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
      <script src="<?=base_url();?>assets/javascripts/ie/html5shiv.js" type="text/javascript"></script>
      <script src="<?=base_url();?>assets/javascripts/ie/respond.min.js" type="text/javascript"></script>
    <![endif]-->
    <style>
		small.has-error{
			color:red;
		}
    </style>
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
                      <span><?php echo ($extra!='')?"Update":"Add New";?> Offer</span>
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
                         <a href="<?php echo WEB_URL; ?>discount"> View all offers</a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'><?php echo ($extra!='')?"Update":"Add New";?> Offer</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
             
		<div class='row'>
			<div class='col-sm-3'></div>
			<div class='col-sm-8'>
				<div class='control-label' id="isExists"></div>
			</div>	
		</div>
		<div class='row'>
			<div class='col-sm-3'></div>
			<div class='col-sm-8'>
				<div class='control-label' style="color:red;" id="errorMessage"><?php if(isset($notvalid)){echo $notvalid;}?></div>
			</div>	
		</div>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-header blue-background'>
                      <div class='title'><?php echo ($extra!='')?"Update":"Add New";?> Offer</div>
                      <div class='actions'>
                        <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                        </a>
                        
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    <div class='box-content'>
					
                      <form class='form form-horizontal validate-form'  id="new-page-form"  style='margin-bottom: 0;' method="post"  enctype="multipart/form-data"> 
			<input type="hidden" name="hdnoldfile" value="<?php echo $offer_details->small_image;?>" >	
			<input type="hidden" name="thisController" id="thisController" value="<?php echo base_url(); ?>discount/" >	
			<p style="color:red;text-align: center;"><?php echo (isset($err_msg) && $err_msg!='')?$err_msg:"";?></p>
			<div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'>Origin <small class="has-error">*</small></label>
                          <div class='col-sm-3 controls'>
                            <select class='select2 form-control' data-rule-required='true' name='origin' id="validation_origin">
                              <?php 	foreach ($airports as $airportsdata) {?>
                                <option value='<?=$airportsdata->airport_city_code;?>' <?php echo ($offer_details->origin==$airportsdata->airport_city_code)?'selected="selected"':'';?>><?=$airportsdata->airport_city;?>(<?=$airportsdata->airport_city_code;?>)</option>
                              <?php }?>
                           </select>
                          </div>
                          <label class='control-label col-sm-2 col-sm-2' for='validation_name'>Destination <small class="has-error">*</small></label>
                          <div class='col-sm-3 controls'>
                           <select class='select2 form-control' data-rule-required='true' name='destination' id="validation_destination">
                               <?php 	foreach ($airports as $airportsdata) {?>
                                <option value='<?=$airportsdata->airport_city_code;?>' <?php echo ($offer_details->destination==$airportsdata->airport_city_code)?'selected="selected"':'';?>><?=$airportsdata->airport_city;?>(<?=$airportsdata->airport_city_code;?>)</option>
                              <?php }?>
                           </select>
                          </div>
                        </div>
                        
                        
                        <div class='form-group'>
                        <label class='control-label col-sm-3 col-sm-3' for='airline_list'>Airliste List <small class="has-error">*</small></label>
                          <div class='col-sm-3 controls'>
							  <select multiple='multiple' class='select2 form-control' data-rule-required='true' name='airline_list[]' id="airline_list">
                              
                              <?php  $air_code=explode(",", $offer_details->airline_code);
                             
                               	foreach ($airline_list as $airline_data) {?>
								 
                                <option value='<?=$airline_data->airline_code;?>' <?php  if(in_array($airline_data->airline_code,$air_code)) { echo 'selected="selected"'; }?>><?=$airline_data->airline_name;?></option>
                              <?php  } ?>
                           </select>
                          </div>
						</div>	  
                        
                        		 
						<div class='form-group'>
                          <label class='control-label col-sm-3'>Price <i class='icon-eur'></i><small class="has-error">*</small></label>
                          <div class='col-sm-3 controls'>
                            <input class='form-control'  data-rule-required='true'  data-rule-number='true' value="<?php echo $offer_details->price;?>"  id="txtPrice" name='txtPrice' placeholder='Price' type='text'>
                          </div>
                        </div>
                        
                         <div class='form-group'>
                                <label class='control-label col-sm-3' for='datepicker'>Offer End Date <small class="has-error">*</small></label>
                                <div class='input-group date col-sm-4' id='datetimepicker2'>
                                  <input class='form-control' placeholder='YYYY-MM-DD' name="exp_date" type='text' value="<?php echo $offer_details->exp_date;?>" data-rule-required='true' readonly>
                                  <span class='input-group-addon'>
                                    <span data-date-icon='icon-calendar' data-time-icon='icon-time'></span>
                                  </span>
                                </div>
                              </div>
                              
                       
                       <div class='form-group'>
                          <label class='control-label col-sm-3'>Provider <small class="has-error">*</small></label>
                          <div class='col-sm-2 controls'>
							  <label class='control-label'>1G</label>
                            <input  data-rule-required='true'  id="txtprovider1" <?php echo ($offer_details->provider=='1G')?'checked="checked"':'checked="checked"';?>  name='txtprovider' value="1G" type='radio'>
                          </div>
                          <div class='col-sm-3 controls'>
							  <label class='control-label'>ACH</label>
                            <input data-rule-required='true'  id="txtprovider" name='txtprovider' value="ACH" <?php echo ($offer_details->provider=='ACH')?'checked="checked"':'';?> type='radio'>
                          </div>
                        </div>
                        
                        
                         <div class='form-group'>
                          <label class='control-label col-sm-3'>Offer Type <small class="has-error">*</small></label>
                          <div class='col-sm-2 controls'>
							  <label class='control-label'>Rount Trip</label>
                            <input  data-rule-required='true'  id="txtoffertype1" <?php echo ($offer_details->type=='R')?'checked="checked"':'checked="checked"';?>  name='txtoffertype' value="R" type='radio'>
                          </div>
                          <div class='col-sm-3 controls'>
							  <label class='control-label'>One Way</label>
                            <input data-rule-required='true'  id="txtoffertype" name='txtoffertype' value="O" <?php echo ($offer_details->type=='O')?'checked="checked"':'';?> type='radio'>
                          </div>
                        </div>
                        
                        <div class='form-group'>
                          <label class='control-label col-sm-3'>Short Description <small class="has-error">*</small></label>
                          <div class='col-sm-6 controls'>
                            <textarea class='form-control' data-rule-required='true'  id="txtshort" name="txtshort" placeholder='Short Descrtiptions' ><?php echo $offer_details->short_desc;?></textarea>
                          </div>
                        </div>
                        
			<div class='row'>
				<label class='control-label col-sm-3'>About City <small class="has-error">*</small></label>
		         	<div class='col-sm-8'>
		         	<div class='box'>
		         	   <div class='box-header blue-background'>
		              		<div class='title'>Content</div>
		              		<div class='actions'></div>
		           	   </div>
				    <div class='box-content'>
				      <textarea name="aboutcity" id="aboutcity" class='form-control ckeditor page-content'  rows='10' data-rule-required='true'> 
				       <?php echo $offer_details->aboutcity;?>
				       </textarea>
				    </div>
		          	</div>
		        	</div>
             		 </div>
		
					<div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_image'>Samll Image <small class="has-error">*</small></label>
                          <div class='col-sm-4 controls'>
                            <input type="file" title='Search for a image to add' <?php if($extra==''){  ?> data-rule-required='true' <?php }?> id='validation_image' name='file'>
                          </div>
                        </div>
                        <?php if($extra!=''){ ?>
							<div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_image'>Samll Image </label>
                          <div class='col-sm-4 controls'>
                           <img width="100px" height="100px" src="<?php echo DISCOUNT_FLIGHT_SMLIMG.$offer_details->small_image;?>"/>
                          </div>
                        </div>
							
							<?php } ?>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_image'>Banner Images <small class="has-error">*</small></label>
                          <div class='col-sm-4 controls'>
                            <input type="file" title='Search for a banner image to add'  <?php if($extra==''){  ?> data-rule-required='true' <?php }?> id='validation_image1' name='bannerfile[]' multiple="multiple">
                          <small>Please Press Ctrl to select multiple images</small>
                          <br>
                          <small class="text-green">Please upload (1600x450 px)greter than or equal images</small>
                          </div>
                         
                        </div>
                        
                        
                          <?php if($extra!=''){  ?>
							<div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_image'>Banner Images </label>
                         
                        </div>
							
								<div class='row'>
									 <?php  foreach($offer_images as $offerimg){ ?>
                          <div class='col-sm-2'>
                           <img width="100px" height="100px" src="<?php echo DISCOUNT_FLIGHT_LRGIMG.$offerimg->image;?>"/>
                           <a style="color:#FFF;background:red;" href="<?php echo WEB_URL; ?>discount/delete_discount_img/<?=$offerimg->id."/".$extra;?>">Delete</a>
                          </div>
                          <?php } ?>
                        </div> 
							<?php }  ?>
							
							
                        <div class='form-actions' style='margin-bottom:0'>
                          <div class='row'>
                            <div class='col-sm-9 col-sm-offset-3'>
                              <a href="<?php echo WEB_URL; ?>discount"><button class='btn btn-primary' type='button'>
                                <i class='icon-reply'></i>
                                Go Back
                              </button></a>
                              <button class='btn btn-primary' value="submit" type='submit' name="offersub" id="newPageForm">
                                <i class='icon-save'></i>
                               <?php echo ($extra!='')?"Update":"Add New";?> offer
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
 <script src="<?=base_url();?>assets/javascripts/plugins/common/moment.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.js" type="text/javascript"></script>
  <script src="<?=base_url();?>assets/javascripts/plugins/tabdrop/bootstrap-tabdrop.js" type="text/javascript"></script>
       <!---- CKEDITOR -->
      <script src="<?=base_url();?>assets/javascripts/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <!----<script src="<?=base_url();?>assets/javascripts/jquery/wysihtml5.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/jquery/bootstrap-wysihtml5.js"></script>
    <script src="<?=base_url();?>assets/javascripts/help_center.js"></script>-->
    <script>
      $.validator.addMethod("buga", (function(value) {
        return value === "buga";
      }), "Please enter \"buga\"!");
      
      $.validator.methods.equal = function(value, element, param) {
        return value === param;
      };
	$(document).ready(function(){
		$("#errorMessage").text('');
		$("#pageTitle").change(function(){
			var url = $("#thisController").val();
			var val = $(this).val();
			var data = "data="+val;
			$.ajax({
			type:"POST",
			data:data,
			url:url+"isTitleExists",
			dataType:"JSON",
			success:function(res){
				if(res.status=='1'){
					$("#isExists").html("<span style='color:green;'>"+res.s+"</span>");
					
				}else{
					$("#isExists").html("<span style='color:red;'>"+res.s+"</span>");
				}
			}		
			});		
		});
		
$(function () {
  $('#datetimepicker2').datetimepicker({
      startDate: new Date(),
       pickTime:false,
      format: "YYYY-MM-DD",
  });


});
		
	});
    </script>
    <!-- / END - page related files and scripts [optional] -->
  </body>
</html>
