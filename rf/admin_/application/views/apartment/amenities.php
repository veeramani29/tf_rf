<!DOCTYPE html>
<html>
<head>
    <title>Change Amenities Info | <?php echo PROJECT_NAME;?></title>
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
                      <span>Change Amenities Info</span>
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
                        <li class='active'>Change Amenities Info</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-header blue-background'>
                      <div class='title'>Change Amenities Info</div>
                      <div class='actions'>
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    
                    <div class='box-content'>
                      <form class='form form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>apartment/upd_amenities" method="post"> 
                         
                                  <div class='step-pane' id='step4'>
                            <fieldset>
                          <div class='col-sm-3'>
                            <div class='box'>
                              <div class='lead'> </div>
                               
                            </div>
                            </div>

                              <div class='step-pane' id='step5'>
                              <h3>Amenities</h3>  
                              <fieldset>
                              <div class='col-sm-3'>
                              
                              
                                <div class='box'>
                                  <div class='lead'>Most Common <?php //foreach($result as $r) { echo $r->amenitie_id; } ?> </div>
                                  <small class='text-muted'>Common amenities at most Airbnb listings.</small>
                                </div>
                               </div>
                              <div class='col-sm-7 col-sm-offset-1'>
                                <div class='form-group'>
                                <div class='col-md-10'>
                               
								 <input type="hidden" value="<?php echo $result5->address; ?>" name="id">
                                  <?php 
                                  
                                    for($m=0;$m<count($result);$m++){
                                    	$res[]=$result[$m]->amenitie_id;
                                    	}
                                    	//echo '<pre>';print_r($res);
                                   ?>
                                    <?php foreach($result1 as $key=>$r) { ?>
                                 
                                  <div class='checkbox'>
                                    <label><input type='checkbox' name="amenities[]" value='<?php echo $r->amenitie_id;  ?>' <?php if(in_array($r->amenitie_id, $res)) { echo 'checked'; } ?>><?php echo $r->amenitie_type;  ?></label>
                                  </div>
                                  <?php } ?>
                              </div>
                            </fieldset>
                            <hr class='hr-normal'>
                            <fieldset>
                              <div class='col-sm-3'>
                                <div class='box'>
                                  <div class='lead'>Extras</div>
                                  <small class='text-muted'>Additional amenities your listing may offer.</small>
                                </div>
                              </div>
                              <div class='col-sm-7 col-sm-offset-1'>
                                <div class='form-group'>
                                <div class='col-md-10'>
                                 
                   
                   
                   
                   
                                  <?php 
                                  
                                    for($n=0;$n<count($result);$n++){
                                    	$res2[]=$result[$n]->amenitie_id;
                                    	}
                                    	//echo '<pre>';print_r($res);
                                   ?>
                                    <?php foreach($result2 as $key=>$r2) { ?>
                                 
                                  <div class='checkbox'>
                                    <label><input type='checkbox' name="amenities[]" value='<?php echo $r2->amenitie_id;  ?>' <?php if(in_array($r2->amenitie_id, $res2)) { echo 'checked'; } ?>><?php echo $r2->amenitie_type;  ?></label>
                                  </div>
                                  <?php } ?>
                                  
                                 
                                  
                                  
                                </div>
                            </fieldset>
                            <hr class='hr-normal'>
                            <fieldset>
                              <div class='col-sm-3'>
                                <div class='box'>
                                  <div class='lead'>Special Features</div>
                                  <small class='text-muted'>Features of your listing for guests with specific needs.</small>
                                </div>
                              </div>
                              <div class='col-sm-7 col-sm-offset-1'>
                                <div class='form-group'>
                                <div class='col-md-10'>
                                 
                                 
                              <?php 
                                  
                                    for($o=0;$o<count($result);$o++){
                                    	$res3[]=$result[$o]->amenitie_id;
                                    	}
                                    	//echo '<pre>';print_r($res);
                                   ?>
                                    <?php foreach($result3 as $key=>$r3) { ?>
                                 
                                  <div class='checkbox'>
                                    <label><input type='checkbox' name="amenities[]" value='<?php echo $r3->amenitie_id;  ?>' <?php if(in_array($r3->amenitie_id, $res3)) { echo 'checked'; } ?>><?php echo $r3->amenitie_type;  ?></label>
                                  </div>
                                  <?php } ?>
                                  
                                  
                                </div>
                            </fieldset>
                            <hr class='hr-normal'>
                            <fieldset>
                              <div class='col-sm-3'>
                                <div class='box'>
                                  <div class='lead'>Home Safety</div>
                                  <small class='text-muted'>Safety equipment for your home.</small>
                                </div>
                              </div>
                              <div class='col-sm-7 col-sm-offset-1'>
                                <div class='form-group'>
                                <div class='col-md-10'>
     
     
     
     											 <?php  
                                  
                                    for($p=0;$p<count($result);$p++){
                                    	$res4[]=$result[$p]->amenitie_id;
                                    	}
                                    	//echo '<pre>';print_r($res);
                                   ?>
                                    <?php foreach($result4 as $key=>$r4) { ?>
                                 
                                  <div class='checkbox'>
                                    <label><input type='checkbox' name="amenities[]" value='<?php echo $r4->amenitie_id;  ?>' <?php if(in_array($r4->amenitie_id, $res4)) { echo 'checked'; } ?>><?php echo $r4->amenitie_type;  ?></label>
                                  </div>
                                  <?php } ?>
                                  
                                  
                                </div>
                            </fieldset>
                            
                            
                          </div>
                        </fieldset>
                         
                 
                          </div>
                          
                           
                         
                      
                      
                        <div class='form-actions' style='margin-bottom:0'>
                          <div class='row'>
                            <div class='col-sm-9 col-sm-offset-3'>
                            <a href="<?php echo WEB_URL; ?>apartment/edit_flat/<?php echo $result5->address; ?>"><button class='btn btn-primary' type='button'>
                                <i class='icon-reply'></i>
                                Go Back  
                              </button></a>
                            <input type="submit" class='btn btn-primary' name="submit" value="Update Amenities">
                              
                              
                           
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
