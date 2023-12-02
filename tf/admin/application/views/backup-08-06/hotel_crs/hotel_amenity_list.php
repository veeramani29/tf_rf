<!DOCTYPE html>
<html>
<head>
    <title>Amenitie Management | InnoGlobe</title>
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
                      <span>Amenitie Management</span>
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
                        <li class='active'>Amenitie Management</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box bordered-box orange-border' style='margin-bottom:0;'>
                    <div class='box-header blue-background'>
                      <div class='title'>Amenitie Management</div>
                      
                  <!--  <div class='actions'>
                       <a href="<?php echo WEB_URL; ?>hotelcrs/price_list"> <button class='btn' style='margin-bottom:5px'>  Price Manager</button></a>
                       <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a> 
                      </div>
                 
						 
   						 <div class='actions'>
                       <a href="<?php echo WEB_URL; ?>hotelcrs/room_type_list"> <button class='btn' style='margin-bottom:5px'> Room Manager</button></a>
                       <a  href="#"><i> &nbsp</i></a>
                      </div>
                      

                      <div class='actions'>
                       <a href="<?php echo WEB_URL; ?>hotelcrs/index"> <button class='btn' style='margin-bottom:5px'>Hotel Manager</button></a>
                       <a  href="#"><i> &nbsp</i></a>
                      </div>
                      -->
                      
                      
                     
                      
                      
                    </div>  
                    <br>
 								<div class=''>
                       <div class='title'>
                       
				<form name="f2" action="<?php echo WEB_URL;?>hotelcrs/add_hotel_amenities" method="post">
							<table width="250">
								<tr>
									<td  colspan="3"><b>Enter Hotel Amenities</b></td>
					             
								</tr>
								<tr>
									<td><input type="text" name="amenity_name" id="amenity_name" class='form-control'  	 required> </td><td>  &nbsp  &nbsp</td>
									<td> <input type="submit" class="btn btn-primary" name="add_new" id="add_new" value="Add Amenitie"></td>
								</tr>
							</table>
						</form>	                       
                       </div></div>
                     
  								   
                      
                       </div>
                    
                    
                    <div class='box-content box-no-padding'>
                      <div class='responsive-table'>
                        <div class='scrollable-area'>
                          <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                            <thead>
                              <tr>
                              
                               	    <th>SI NO</th>
													<th>Amenity Name</th>
													<th>Status</th>
                                        <th>Action</th>
                                
                                
                                 
                              </tr>
                            </thead>
                       			<tbody>
									 
												
												<?php  if(!empty($result)) {  $count = 1;
												foreach($result as $key => $value) { ?>
											<tr>
												<td><?php echo $count; ?></td>
												<td><?php echo $value->amenity_name; ?></td>
												<td width="150"><?php if($value->status==1) { ?>
												<img src="<?php echo WEB_DIR; ?>/img/online.png" width="75" align="center" style="padding-left:25px;"/>
												<?php }else { ?> <img src="<?php echo WEB_DIR; ?>/img/offline.png" width="75" align="center" style="padding-left:25px;"/><?php } ?></td>
												 
											 
												 
												
													<td width="200">
													
													
	<?php if($value->status==1) { ?> 
													<a  href="<?php echo WEB_URL;?>hotelcrs/update_amenity_list/<?php echo $value->amenity_list_id; ?>/0" style="color:#000;" data-original-title="Inactive">
														<img src="<?php echo WEB_DIR; ?>/assets/images/status_online.ico" width="15" align="center"/>
													</a> 
												<?php } else { ?> 
													<a    href="<?php echo WEB_URL;?>hotelcrs/update_amenity_list/<?php echo $value->amenity_list_id; ?>/1"  style="color:#000;" data-original-title="Active">
														<img src="<?php echo WEB_DIR; ?>/assets/images/status_busy.ico" width="15" align="center"/>
													</a> 
												<?php } ?>
												
												
													<a class="btn btn-primary btn-xs has-tooltip" data-placement="top" title="" href="<?php echo WEB_URL;?>hotelcrs/edit_amenitie/<?php echo $id=$value->amenity_list_id; ?>" data-original-title="Edit">
                                      <i class="icon-edit"></i>
                                    </a>
												<!--	<a class="btn btn-mini tip" data-original-title="Active" href="<?php echo WEB_URL;?>hotelcrs/update_amenity_list/<?php echo $value->amenity_list_id; ?>/1"><img width="17" align="middle" src="<?php echo WEB_DIR; ?>img/active.jpg" data-original-title="Active"></a> 
													<a class="btn btn-mini tip" data-original-title="Inactive" href="<?php echo WEB_URL;?>hotelcrs/update_amenity_list/<?php echo $value->amenity_list_id; ?>/0"><img width="17" align="middle" src="<?php echo WEB_DIR; ?>img/inactive.jpg" data-original-title="Inactive"></a>
													-->
													<a href="<?php echo WEB_URL;?>hotelcrs/del_amenitie/<?php echo $id=$value->amenity_list_id; ?>/" data-original-title="Delete" onclick="return confirm('Do you want delete this record');" class="btn btn-danger btn-xs has-tooltip"> 
                                  <i class="icon-remove"></i>
                                   </a>
													<!-- <span style="font-size:12px;"><?php echo anchor(WEB_URL.'hotelcrs/update_amenity_list/'.$value->amenity_list_id.'/2', '<span style="color:#2485BE;"><img alt="" src="'.WEB_DIR.'img/icons/fugue/cross.png"></span>', array('onClick' => "return confirm('Are you sure you want to delete?')")); ?>
													 -->
												</td>
												
											</tr>		
										<?php $count ++; } } ?>	
											</tbody>
                            <tfoot>
                              <tr>
                            	<th>SI NO</th>
													<th>Amenity Name</th>
												  
												  
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
