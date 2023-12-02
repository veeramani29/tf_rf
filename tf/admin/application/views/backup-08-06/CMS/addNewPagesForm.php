<!DOCTYPE html>
<html>
<head>
    <title>Add New Page | InnoGlobe</title>
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
    <link href="<?=base_url();?>assets/stylesheets/bootstrap-wysihtml5.css" media="all" rel="stylesheet" type="text/css" />
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
                      <i class='icon-male'></i>
                      <span>Create New Page</span>
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
                         <a href="<?php echo WEB_URL; ?>cms/viewAllPages"> View all pages</a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Add New Page</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <?php if(isset($status)){echo $status;}?>
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
                      <div class='title'>Add New Page</div>
                      <div class='actions'>
                        <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                        </a>
                        
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    <div class='box-content'>
                      <form class='form form-horizontal validate-form'  id="new-page-form"  style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>cms/addNewPageDetails" method="post"  enctype="multipart/form-data"> 
			<input type="hidden" name="isExists" value="" >	
			<input type="hidden" name="thisController" id="thisController" value="<?php echo base_url(); ?>cms/" >			 
			<div class='form-group'>
                          <label class='control-label col-sm-3'>Page Title</label>
                          <div class='col-sm-8 controls'>
                            <input class='form-control'  data-rule-required='true' value="" id="pageTitle" name='title' placeholder='Page Title' type='text'>
                          </div>
			   
                        </div>
			
			<div class='row'>
				<label class='control-label col-sm-3'>English</label>
		         	<div class='col-sm-8'>
		         	<div class='box'>
		         	   <div class='box-header blue-background'>
		              		<div class='title'>Content</div>
		              		<div class='actions'></div>
		           	   </div>
				    <div class='box-content'>
				      <textarea name="english" id="english" class='form-control ckeditor page-content'  rows='10' data-rule-required='true'> 
				       </textarea>
				    </div>
		          	</div>
		        	</div>
             		 </div>
			<div class='row'>
				<label class='control-label col-sm-3'>Arabic</label>
		         	<div class='col-sm-8'>
		         	<div class='box'>
		         	   <div class='box-header blue-background'>
		              		<div class='title'>Content</div>
		              		<div class='actions'></div>
		           	   </div>
				    <div class='box-content'>
				      <textarea name="arabic" id="arabic" class='form-control ckeditor page-content'  rows='10' data-rule-required='true'> 
				       </textarea>
				    </div>
		          	</div>
		        	</div>
             		 </div>
			<div class='row'>
				<label class='control-label col-sm-3'>German</label>
		         	<div class='col-sm-8'>
		         	<div class='box'>
		         	   <div class='box-header blue-background'>
		              		<div class='title'>Content</div>
		              		<div class='actions'></div>
		           	   </div>
				    <div class='box-content'>
				      <textarea name="german" id="german" class='form-control ckeditor page-content'  rows='10' data-rule-required='true'> 
				       </textarea>
				    </div>
		          	</div>
		        	</div>
             		 </div>
			<div class='row'>
				<label class='control-label col-sm-3'>French</label>
		         	<div class='col-sm-8'>
		         	<div class='box'>
		         	   <div class='box-header blue-background'>
		              		<div class='title'>Content</div>
		              		<div class='actions'></div>
		           	   </div>
				    <div class='box-content'>
				      <textarea name="french" id="french" class='form-control ckeditor page-content'  rows='10' data-rule-required='true'> 
				       </textarea>
				    </div>
		          	</div>
		        	</div>
             		 </div>
			<div class='row'>
				<label class='control-label col-sm-3'>Spanish</label>
		         	<div class='col-sm-8'>
		         	<div class='box'>
		         	   <div class='box-header blue-background'>
		              		<div class='title'>Content</div>
		              		<div class='actions'></div>
		           	   </div>
				    <div class='box-content'>
				      <textarea name="spanish" id="spanish" class='form-control ckeditor page-content'  rows='10' data-rule-required='true'> 
				       </textarea>
				    </div>
		          	</div>
		        	</div>
             		 </div>
			<div class='row'>
				<label class='control-label col-sm-3'>Farsi</label>
		         	<div class='col-sm-8'>
		         	<div class='box'>
		         	   <div class='box-header blue-background'>
		              		<div class='title'>Content</div>
		              		<div class='actions'></div>
		           	   </div>
				    <div class='box-content'>
				      <textarea name="farsi" id="farsi" class='form-control ckeditor page-content'  rows='10' data-rule-required='true'> 
				       </textarea>
				    </div>
		          	</div>
		        	</div>
             		 </div>
                        <div class='form-actions' style='margin-bottom:0'>
                          <div class='row'>
                            <div class='col-sm-9 col-sm-offset-3'>
                              <a href="<?php echo WEB_URL; ?>cms/viewAllPages"><button class='btn btn-primary' type='button'>
                                <i class='icon-reply'></i>
                                Go Back
                              </button></a>
                              <button class='btn btn-primary' type='submit' id="newPageForm">
                                <i class='icon-save'></i>
                               Add new page
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
		$("#newPageForm").click(function(){
			$(".page-content").each(function(){
				var id = $(this).attr('id');
				var pc = CKEDITOR.instances[id].getData();
				if(pc == ''){
					alert("Add content to "+ id +" language" );
					ret = false;
					return false;
				}else{
					ret = true;
				}
			});
			return ret;
		});

		
	});
    </script>
    <!-- / END - page related files and scripts [optional] -->
  </body>
</html>
