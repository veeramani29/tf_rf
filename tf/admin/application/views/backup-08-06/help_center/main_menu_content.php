<!DOCTYPE html>
<html>
<head>
    <title>Add Content| InnoGlobe</title>
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
  
    
    
    <!---- CKEDITOR -->
    
    	
    <!-- Ckeditor CSS -->
    
      <link href="<?=base_url();?>assets/stylesheets/bootstrap-wysihtml5.css" media="all" rel="stylesheet" type="text/css" />
 
 	<style>

		#editable
		{
			padding: 10px;
			float: left;
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
                      <i class='icon-ok'></i>
                      <span>Add Content</span>
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
                        <li>Submenus</a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Add Submenu </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <?php if(isset($status)){echo $status;}?>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-header blue-background' >
                      <div class='title' id="tab1">Content & Image</div>
                      <div class='actions'>
                      <!--  <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                        </a>
                        -->	
                        
                        </a>
                      </div>
                    </div>
                    <div class='box-content' id="cont1" style="display:none">
                      <form class='form form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>help_center/add_content_image" method="post" name="frm1" enctype="multipart/form-data"> 
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'>Title</label>
                          <div class='col-sm-4 controls'>
                          <input type="hidden" name="menu_id" value="<?php echo $main_menu_id; ?>">
                            <input class='form-control' data-rule-minlength='2' data-rule-required='true' id='validation_saluation' name='title' placeholder='Title' type='text'>
                          </div>
                         </div>
                      
                        
                           <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_email'>Content</label>
                           
                         
                         	 <div class='row'>
                 	<div class='col-sm-8'>
                 		<div class='box'>
                 	   <div class='box-header purple-background'>
                      <div class='title'>Content</div>
                      <div class='actions'>
                    </div>
                    </div>
                    <div class='box-content'>
                      <textarea name="con_img" class='form-control wysihtml5' id='wysiwyg2' rows='10' data-rule-required='true'> 
                       </textarea>
                    </div>
                  </div>
                </div>
              </div>
	            </div>
                <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_image'>Menu Image</label>
                          <div class='col-sm-4 controls'>
                            <input type="file" title='Search for a image to add' class='form-control' data-rule-required='true' id='validation_image' name='photo' multiple>
                          </div>
                        </div>
                        <div class='form-actions' style='margin-bottom:0'>
                          <div class='row'>
                            <div class='col-sm-9 col-sm-offset-3'>
                              <a href="<?php echo WEB_URL; ?>help_center/sub_menus/<?php echo $main_menu_id; ?>"><button class='btn btn-primary' type='button'>
                                <i class='icon-reply'></i>
                                Go Back
                              </button></a>
                              <input type="submit" name="sub1" value="Submit"  class='btn btn-primary' >
                              
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                 </div>
                </div>
              </div>
              
              <!-- TAB-2 star here -->
              
                <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-header blue-background'>
                      <div class='title' id="tab2" >Only Content</div>
                      <div class='actions'>
                      <!--  <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                        </a>
                         	
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>-->
                      </div>
                    </div>
                    <div class='box-content' id="cont2" style="display:none">
                         <form class='form form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>help_center/add_content" method="post" name="frm2" enctype="multipart/form-data"> 
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'>Title</label>
                          <div class='col-sm-4 controls'>
                           <input type="hidden" name="menu_id" value="<?php echo $main_menu_id; ?>">
                            <input class='form-control' data-rule-minlength='2' data-rule-required='true' id='validation_saluation' name='title' placeholder='Title' type='text'>
                          </div>
                         </div>
                      
                        
                           <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_email'>Content</label>
                           
                         
                         	 <div class='row'>
                 	<div class='col-sm-8'>
                 		<div class='box'>
                 	   <div class='box-header purple-background'>
                      <div class='title'>Content</div>
                      <div class='actions'>
                    </div>
                    </div>
                    <div class='box-content'>
                      <textarea name="con" class='form-control wysihtml5' id='wysiwyg2' rows='10' data-rule-required='true'> 
                       </textarea>
                    </div>
                  </div>
                </div>
              </div>
	            </div>
               
                        <div class='form-actions' style='margin-bottom:0'>
                          <div class='row'>
                            <div class='col-sm-9 col-sm-offset-3'>
                              <a href="<?php echo WEB_URL; ?>help_center/sub_menus/<?php echo $main_menu_id; ?>"><button class='btn btn-primary' type='button'>
                                <i class='icon-reply'></i>
                                Go Back
                              </button></a>
                              <input type="submit" name="sub2" value="Add Content"  class='btn btn-primary' >
                              
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                 </div>
                </div>
              </div>
              
              
              
              
               <!-- TAB-3 star here -->
              
<div class='row'>
    <div class='col-sm-12'>
        <div class='box'>
            <div class='box-header blue-background'>
                <div class='title' id="tab3">Links</div>
                <div class='actions'></div>
            </div>
            
            
        <div class='box-content' id="cont3" style="display: none;">
            <div class='box-header green-background confirm_add'>
                <div class='title'>Link content added successfully | Add another</div>
                <div class='actions'></div>
            </div><br>
            <div class="cloneSection">
                <form class='form form-horizontal validate-form' id='linkForm' style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>help_center/add_content_link" method="post" name="frm3" enctype="multipart/form-data"> 
                    <div class='form-group'>
                        <label class='control-label col-sm-3 col-sm-3' for='validation_name'>Title</label>
                        <div class='col-sm-4 controls'>
                            <input type="hidden" name="menu_id" id="menu_id" value="<?php echo $main_menu_id; ?>">
                            <input type="hidden" name="content_type" class="content_type" value="3">
                            <input class='form-control linkTitle' data-rule-minlength='2' data-rule-required='true' id='linkTitle' name='title' placeholder='Title' type='text'>
                        </div>
                    </div>

                    <div class='form-group' col-sm-4 controls>
                        <label class='control-label col-sm-3 col-sm-3' for='validation_name'>Heading</label>
                        <div class='col-sm-4 controls'>
                            <input class='form-control heading' data-rule-minlength='2' data-rule-required='true' id="heading" name='Hedding' placeholder='Heading' type='text'>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label class='control-label col-sm-3' for='validation_email'>Content</label>
                        <div class='row'>
                            <div class='col-sm-8'>
                                <div class='box'>
                                    <div class='box-header purple-background'>
                                        <div class='title'>Content</div>
                                        <div class='actions'></div>
                                    </div>
                                    <div class='box-content'>
                                      <textarea name="con_link" class='form-control ckeditor link_content' rows='10' data-rule-required='true'></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='form-actions' style='margin-bottom:0'>
                        <div class='row'>
                            <div class='col-sm-9 col-sm-offset-3'>
                              <a href="<?php echo WEB_URL; ?>help_center/">
                                <button class='btn btn-primary' type='button'>
                                    <i class='icon-reply'></i>
                                    Back
                                </button>
                              </a>
                              <input type="submit" name="sub3" value="Submit/Add Another" class='btn btn-primary' >
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
          </div>
          <?php $this->load->view('footer');?>
        </div>
      </section>
    </div>
 
 
 
    
    <!-- / jquery [required] -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
 
    <!-- / jquery ui -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery-ui.min.js" type="text/javascript"></script>
    <!-- / jQuery UI Touch Punch -->
      <!-- / bootstrap [required] -->
    <script src="<?=base_url();?>assets/javascripts/bootstrap/bootstrap.js" type="text/javascript"></script>
  
    <!-- / theme file [required] -->
    <script src="<?=base_url();?>assets/javascripts/theme.js" type="text/javascript"></script>
 
    <!-- / START - page related files and scripts [optional] -->
    <script src="<?=base_url();?>assets/javascripts/plugins/validate/jquery.validate.min.js" type="text/javascript"></script>
    
     <script src="<?=base_url();?>assets/javascripts/plugins/fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
 
    <script>
      $.validator.addMethod("buga", (function(value) {
        return value === "buga";
      }), "Please enter \"buga\"!");
      
      $.validator.methods.equal = function(value, element, param) {
        return value === param;
      };
    </script>
    <!-- / END - page related files and scripts [optional] -->
    <script src="<?=base_url();?>assets/javascripts/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
       <!---- CKEDITOR -->
    <script src="<?=base_url();?>assets/javascripts/jquery/ckeditor.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/jquery/wysihtml5.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/jquery/bootstrap-wysihtml5.js"></script>
    <script src="<?=base_url();?>assets/javascripts/help_center.js"></script> 	
     	 
 
<script> 
$(document).ready(function(){
  $("#tab1").click(function(){
    $("#cont1").slideToggle("slow");
     $("#cont2").slideUp("slow");
      $("#cont3").slideUp("slow");
    
  });
  
   $("#tab2").click(function(){
    $("#cont2").slideToggle("slow");
     $("#cont1").slideUp("slow");
      $("#cont3").slideUp("slow");
  });
  
  
  $("#tab3").click(function(){
    $("#cont3").slideToggle("slow");
     $("#cont1").slideUp("slow");
      $("#cont2").slideUp("slow");
  });
  
});
</script>

 
	


  </body>
</html>
