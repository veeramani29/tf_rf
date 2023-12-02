<!DOCTYPE html>
<html>
<head>
    <title>Packages | <?php echo PROJECT_NAME;?></title>
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
    <link href="<?=base_url();?>assets/stylesheets/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/stylesheets/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/stylesheets/plugins/tabdrop/tabdrop.css" media="all" rel="stylesheet" type="text/css" />
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
                                      <i class='icon-gears'></i>
                                      <span>Package Management</span>
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
                                            <li class=''>Package Management</li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class='row'>
                        <div class='col-sm-12'>
                          <div class='box bordered-box orange-border' style='margin-bottom:0;'>
                            <div class='box-header blue-background'>
                              <div class='title'>Package Management</div>

                              <div class='actions'>
                               <a href="<?php echo WEB_URL; ?>packages/add_package"> <button class='btn' style='margin-bottom:5px'><i class='icon-male'></i> Add New Package</button></a>
                               <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a>
                              </div>
                            </div>
                            <div class='box-content box-no-padding'>
                              <div class='responsive-table'>
                                <div class='scrollable-area'>
                                  <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>image</th>
                                        <th>Package Name</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Rating</th>
                                        <th width="100">Status</th>
                                        <th width="100">Actions</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php if(!empty($package_view_data)){ $c=1;foreach($package_view_data as $k){
                                           $country_code = $k->package_cityid;
                      
                                            $country_name = $this->package_model->get_cities_country_v4($country_code);
                                            if(!empty($country_name)){
                                        ?>
                                      <tr>
                                        <td><?=$c;?></td>
                                        <td width="90px"> <img width="50" height="50" src="<?php echo $k->image; ?>"> </td>
                                        <td><?=$k->package_name;?></td>
                                        <td><?=$country_name->COUNTRY_NAME;?></td>
                                        <td><?=$country_name->CITY;?></td>
                                        <td><?=$k->package_rating;?></td>
                                       
                                        <td>
                                            <?php if($k->status == '1'){?>
                                            <a href="<?php echo WEB_URL.'packages/package_change_status/'.$k->package_id.'/0'; ?>" class="btn btn-success btn-xs has-tooltip"> <i class="icon-ok"></i></a>
                                            <?php }else{ ?>  
                                            <a href="<?php echo WEB_URL.'packages/package_change_status/'.$k->package_id.'/1'; ?>" class="btn btn-danger btn-xs has-tooltip"> <i class="icon-minus"></i></a>  
                                            <?php }?>
                                        </td>
                                        
                                        <td>
                                          <div class='text-right'>
                                            <a class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='Change Images' href='<?php echo WEB_URL; ?>packages/edit_package_images/<?=$k->package_id;?>'>
                                              <i class='icon-picture'></i>
                                            </a>
                                            <a class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='Edit' href='<?php echo WEB_URL; ?>packages/edit_package/<?=$k->package_id;?>'>
                                              <i class='icon-edit'></i>
                                            </a>
                                            <a class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Delete' onclick="return confirm('Are you sure, do you want to delete this record?');" href='<?php echo WEB_URL; ?>packages/delete_package/<?=$k->package_id;?>'>
                                              <i class='icon-remove'></i>
                                            </a>
                                          
                                          </div>
                                        </td>
                                      </tr>
                                      <?php $c++;}}}?>
                                      </tbody>
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
    <script>
      $.validator.addMethod("buga", (function(value) {
        return value === "buga";
      }), "Please enter \"buga\"!");
      
      $.validator.methods.equal = function(value, element, param) {
        return value === param;
      };


$(function () {
  $('#datetimepicker2').datetimepicker({
      startDate: new Date()
  });

  $('#datetimepicker1').datetimepicker({
      startDate: new Date()
  });
});


    </script>




    <!-- / END - page related files and scripts [optional] -->
  </body>
</html>
