<!DOCTYPE html>
<html>
<head>
    <title>Apartment Management | InnoGlobe</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta content='text/html;charset=utf-8' http-equiv='content-type'>
    
    <link href='<?=base_url();?><?=base_url();?>assets/images/meta_icons/favicon.ico' rel='shortcut icon' type='image/x-icon'>
    
        <!-- / bootstrap [validation] -->
    <link href="<?=base_url();?>assets/stylesheets/bootstrap/bootstrap-combined.no-icons.min.css" media="all" rel="stylesheet" type="text/css" />
    
    
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon.png' rel='apple-touch-icon-precomposed'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-57x57.png' rel='apple-touch-icon-precomposed' sizes='57x57'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-72x72.png' rel='apple-touch-icon-precomposed' sizes='72x72'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-114x114.png' rel='apple-touch-icon-precomposed' sizes='114x114'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-144x144.png' rel='apple-touch-icon-precomposed' sizes='144x144'>
    <!-- / START - page related stylesheets [optional] -->
    <link href="<?=base_url();?>assets/stylesheets/plugins/datatables/bootstrap-datatable.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / END - page related stylesheets [optional] -->
    <!-- / bootstrap [required] -->
    <link href="<?=base_url();?>assets/stylesheets/bootstrap/bootstrap.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / theme file [required] -->
    <link href="<?=base_url();?>assets/stylesheets/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
    <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
    <link href="<?=base_url();?>assets/stylesheets/theme-colors.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / demo file [not required!] -->
    <link href="<?=base_url();?>assets/stylesheets/demo.css" media="all" rel="stylesheet" type="text/css" />
     <script src="<?=base_url();?>assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
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
                      <i class='icon-building'></i>
                      <span>Apartment Management</span>
                    </h1>
                    <div class='pull-right'>
                      <ul class='breadcrumb'>
                        <li>
                          <a href='index.html'>
                            <i class='icon-bar-chart'></i>
                          </a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'><a href="<?php echo WEB_URL; ?>apartment/index">Apartment Management</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box bordered-box orange-border' style='margin-bottom:0;'>
                    <div class='box-header blue-background'>
                      <div class='title'>Apartment Management</div>
                      
                      <!--
                    <div class='actions'>
                       <a href="<?php echo WEB_URL; ?>apartment/add"> <button class='btn' style='margin-bottom:5px'><i class='icon-plus'></i> Add New Listing</button></a>
                       <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a> 
                      </div>


   						 <div class='actions'>
                       <a href="<?php echo WEB_URL; ?>apartment/add_room"> <button class='btn' style='margin-bottom:5px'><i class='icon-plus'></i> Add Room Type</button></a>
                       <a  href="#"><i> &nbsp</i></a>
                      </div>
                      

                      <div class='actions'>
                       <a href="<?php echo WEB_URL; ?>apartment/add_apartment"> <button class='btn' style='margin-bottom:5px'><i class='icon-plus'></i> Add Apartment Type </button></a>
                       <a  href="#"><i> &nbsp</i></a>
                      </div>
                      -->
                      
                      
                      
                    </div>
                    <dir>  </dir>
                       <form id="regg"  novalidate="novalidate" class='form form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>apartment/save_amenitie" method="post"> 
                       
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'>Amenitie &nbsp :</label> <input type="text" name="amenitie" id="amenitie"> &nbsp &nbsp &nbsp  
                        
                           
                        
                           <select name="amenitie_cat">
							<option value="">Amenitie Category</option>
							<?php   foreach($result2 as $r) { ?>
							<option value="<?php echo $r->amenite_cat_id; ?>"><?php echo $r->amenities; ?></option>                           
                          <?php } ?> 
                           </select>
                           
                           
                            &nbsp &nbsp &nbsp  
                              
                          <input type="submit" class='btn btn-primary' name="submit" value="Save Amenitie"> 
                          
                          
                        </div>
                        
                      </form>
                         
                    <div class='box-content box-no-padding'>
                      <div class='responsive-table'>
                        <div class='scrollable-area'>
                          <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                            <thead>
                              <tr>
                                <th>S.No</th>
                                <th >Amenitie</th>
                                <th >Amenitie Category</th>
                               
                                <th width="200">Action</th>
                                
                                   
                              </tr>
                            </thead>
                            <tbody>
                             
                             
                             <?php if(!empty($result)){ $c=1; foreach($result as $row) { ?>
                              <tr>
                                    <td width="200"><?=$c;?></td>
                                <td><?php  echo $row->amenitie_type; ?></td>
                       
                                 <td><?php  echo $row->amenities; ?></td>
                                <td colspan="3" width="300" align="left">
                                  <div class='text-right'>
                                    <a class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='' href='<?php echo WEB_URL; ?>apartment/edit_amenitie/<?php  echo $id=$row->amenitie_id; ?>'>
                                      <i class='icon-edit'></i>
                                    </a>
                                   
                <!--   <a class="btn btn-primary btn-xs has-tooltip" data-placement="top" title="" href='<?php echo WEB_URL; ?>apartment/apartment_profile/<?php echo $pid=$row->address; ?>'>
                                      <i class="icon-search"></i>&nbsp;
                                    </a>      -->                
         									 <a href='<?php echo WEB_URL ?>apartment/delete_amenitie/<?php  echo $id=$row->amenitie_id; ?>' 
                  										 title='Delete'  onclick="return confirm('Do you want delete this record');" class='btn btn-danger btn-xs has-tooltip'> <i class='icon-remove'></i> </a>
                     
                     
                                  </div>
                                </td>
                                
                              </tr>
                              <?php  $c++; } } ?>
                              
                              
                              
                              
                              
                              </tbody>
                            <tfoot>
                              <tr>
                                <th>S.No</th>
                                <th>Amenitie</th>
                                  <th>Amenitie Category</th>
												  
                              </tr>
                            </tfoot>
                          </table>
                        </div>
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
    
  <script>
  
  // When the browser is ready...
 $(document).ready(function(){
 	  $("#regg").validate({
    
        // Specify the validation rules
        rules: {
            apartmant: "required",
           
            agree: "required"
        },
        
        // Specify the validation error messages
        messages: {
            apartmant: "Please enter your first name",
           
            agree: "Please accept our policy"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
 
  
   

  });
  
  </script>
    <!-- / jquery [required] -->
    
    
      <script src="<?=base_url();?>assets/javascripts/jquery/jquery.validate.min.js" type="text/javascript"></script>
  
       
       
       
       
   
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
    <script src="<?=base_url();?>assets/javascripts/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/datatables/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/datatables/dataTables.overrides.js" type="text/javascript"></script>
    
    
          
  <!-- jQuery Form Validation code -->
 
    <!-- / END - page related files and scripts [optional] -->
  </body>


</html>
