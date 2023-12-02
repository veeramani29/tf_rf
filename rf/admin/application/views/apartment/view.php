<!DOCTYPE html>
<html>
<head>
    <title>Apartment Management | <?php echo PROJECT_NAME;?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta content='text/html;charset=utf-8' http-equiv='content-type'>
    
    <link href='<?=base_url();?><?=base_url();?>assets/images/meta_icons/favicon.ico' rel='shortcut icon' type='image/x-icon'>
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
                        <li class='active'>Apartment Management</li>
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
                      
                    <div class='actions'>
                       <a href="<?php echo WEB_URL; ?>apartment/add"> <button class='btn' style='margin-bottom:5px'><i class='icon-plus'></i> Add New Listing</button></a>
                       <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a> 
                      </div>
                      
                      


								  <div class='actions'>
                       <a href="<?php echo WEB_URL; ?>apartment/add_amenities"> <button class='btn' style='margin-bottom:5px'><i class='icon-plus'></i> Add Amenities </button></a>
                       <a  href="#"><i> &nbsp</i></a>
                      </div>
                      
                      
   						 <div class='actions'>
                       <a href="<?php echo WEB_URL; ?>apartment/add_room"> <button class='btn' style='margin-bottom:5px'><i class='icon-plus'></i> Add Room Type</button></a>
                       <a  href="#"><i> &nbsp</i></a>
                      </div>
                      

                      <div class='actions'>
                       <a href="<?php echo WEB_URL; ?>apartment/add_apartment"> <button class='btn' style='margin-bottom:5px'><i class='icon-plus'></i> Add Apartment Type </button></a>
                       <a  href="#"><i> &nbsp</i></a>
                      </div>
                      
                     
                      
                      
                    </div>
                    <div class='box-content box-no-padding'>
                      <div class='responsive-table'>
                        <div class='scrollable-area'>
                          <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                            <thead>
                              <tr>
                              
                                <th width="100">Home Type</th>
                                <th width="100">Room Type</th>
                                <th width="100">City</th>
                                <th width="100">Title</th>
                               
                                <th width="100"></th>
                                
                                 
                              </tr>
                            </thead>
                            <tbody>
                             
                             
                             <?php foreach($result5 as $row) { ?>
                              <tr>
                                <td><?php echo $row->apartment_type; ?></td>
                                <td> <?php echo $row->room_type; ?></td>
                                <td> <?php echo $row->city_id; ?></td>
                                 <td> <?php echo $row->title; ?></td>
                                 
                                <td>
                                  <div class='text-right'>
                                    <a class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='' href='<?php echo WEB_URL; ?>apartment/edit_flat/<?php echo $pid=$row->address; ?>'>
                                      <i class='icon-edit'></i>
                                    </a>
                                   
                   <a class="btn btn-primary btn-xs has-tooltip" data-placement="top" title="" href='<?php echo WEB_URL; ?>apartment/apartment_profile/<?php echo $pid=$row->address; ?>'>
                                      <i class="icon-search"></i>&nbsp;
                                    </a>                     
          <a href='<?php echo WEB_URL ?>apartment/delete_apartment/<?php echo $id=$row->address; ?>' 
                   title='Delete'  onclick="return confirm('Do you want delete this record');" class='btn btn-danger btn-xs has-tooltip'> <i class='icon-remove'></i> </a>
                     
                     
                                  </div>
                                </td>
                              </tr>
                              <?php } ?>
                              
                              
                              
                              
                              
                              </tbody>
                            <tfoot>
                              <tr>
                                <th>Apartment Type</th>
                                <th>Room Type</th>
                                <th>City</th>
                                 <th>Title</th>
												  
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
    <script src="<?=base_url();?>assets/javascripts/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/datatables/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/datatables/dataTables.overrides.js" type="text/javascript"></script>
    <!-- / END - page related files and scripts [optional] -->
  </body>


</html>
