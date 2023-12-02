<!DOCTYPE html>
<html>
    <head>
        <title>LIST PROPERTIES | InnoGlobe</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta content='text/html;charset=utf-8' http-equiv='content-type'>
        
        <link href='<?= base_url(); ?><?= base_url(); ?>assets/images/meta_icons/favicon.ico' rel='shortcut icon' type='image/x-icon'>
        <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon.png' rel='apple-touch-icon-precomposed'>
        <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon-57x57.png' rel='apple-touch-icon-precomposed' sizes='57x57'>
        <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon-72x72.png' rel='apple-touch-icon-precomposed' sizes='72x72'>
        <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon-114x114.png' rel='apple-touch-icon-precomposed' sizes='114x114'>
        <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon-144x144.png' rel='apple-touch-icon-precomposed' sizes='144x144'>
        <!-- / START - page related stylesheets [optional] -->
        <link href="<?= base_url(); ?>assets/stylesheets/plugins/lightbox/lightbox.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/stylesheets/plugins/datatables/bootstrap-datatable.css" media="all" rel="stylesheet" type="text/css" />
        <!-- / END - page related stylesheets [optional] -->
        <!-- / bootstrap [required] -->
        <link href="<?= base_url(); ?>assets/stylesheets/bootstrap/bootstrap.css" media="all" rel="stylesheet" type="text/css" />
        <!-- / theme file [required] -->
        <link href="<?= base_url(); ?>assets/stylesheets/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
        <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
        <link href="<?= base_url(); ?>assets/stylesheets/theme-colors.css" media="all" rel="stylesheet" type="text/css" />
        <!-- / demo file [not required!] -->
        <link href="<?= base_url(); ?>assets/stylesheets/demo.css" media="all" rel="stylesheet" type="text/css" />
        
        <!--[if lt IE 9]>
          <script src="<?= base_url(); ?>assets/javascripts/ie/html5shiv.js" type="text/javascript"></script>
          <script src="<?= base_url(); ?>assets/javascripts/ie/respond.min.js" type="text/javascript"></script>
        <![endif]-->
        <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery-1.10.2.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/custom.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
    </head>
    <body class='contrast-dark fixed-header'>
        <?php $this->load->view('header'); ?>
        <div id='wrapper'>
            <div id='main-nav-bg'></div>
            <?php $this->load->view('side-menu'); ?>
            <section id='content'>
                <div class='container'>
                    <div class='row' id='content-wrapper'>
                        <div class='col-xs-12'>
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <div class='page-header'>
                                        <h1 class='pull-left'>
                                            <i class='icon-building'></i>
                                            <span>List Properties</span>
                                        </h1>
                                        <div class='pull-right'>
                                            <ul class='breadcrumb'>
                                                <li>
                                                    <a href='<?= base_url(); ?>'>
                                                        <i class='icon-bar-chart'></i>
                                                    </a>
                                                </li>
                                                <li class='separator'>
                                                    <i class='icon-angle-right'></i>
                                                </li>
                                                <li class='active'>List Properties</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col-sm-12'>
                                    <div class='box bordered-box orange-border' style='margin-bottom:0;'>
                                        <div class='box-header blue-background'>
                                            <div class='title'>List Properties</div>
                                        </div>
                                        <div class='box-content box-no-padding' id="result_properties"><img src="<?php echo WEB_DIR; ?>assets/images/ajax-loader.gif" id="loading_layer" style="display: none;"/>
                                            <img src="<?php echo WEB_DIR; ?>assets/images/ajax-loader.gif" id="loading_layer" style="display: none;"/>
                                            <div class='responsive-table'>
                                                <div class='scrollable-area'>
                                                    <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                                                        <thead>
                                                            <tr>
                                                                <th>S.No</th>
                                                                <th>Push Status</th>
                                                                <th>Host Name</th>
                                                                <th>Property Name</th>
                                                                <th>City</th>
                                                                <th>Country</th>
                                                                <th>Phone</th>
                                                                <th>Approval</th>
                                                                <th>Status</th>
                                                                <th width="250">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if (!empty($properties)) {
                                                                $i = 1;
                                                                foreach ($properties as $key => $property) {
                                                                $hostInfo = $this->apartment_model->GetUserData($property->USER_TYPE, $property->USER_ID)->row(); 
                                                                if($property->USER_TYPE == '3'){
                                                                    $profile_photo = $hostInfo->profile_photo;
                                                                    $email = $hostInfo->email;
                                                                    $contact_no = $hostInfo->contact_no;
                                                                    $type = 'B2C';
                                                                }else if($property->USER_TYPE == '2'){
                                                                    $profile_photo = $hostInfo->agent_logo;
                                                                    $email = $hostInfo->email_id;
                                                                    $contact_no = $hostInfo->mobile;
                                                                    $type = 'B2B';
                                                                }
                                                            ?>
                                                                    <tr>
                                                                        <td><?php echo $i; ?></td>
                                                                        <td>
                                                                            <a class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Owner Not Pushed'>  
                                                                                <i class='icon-user'></i> <i class='icon-cloud-upload'></i>
                                                                            </a>
                                                                            <a class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Owner Pushed'>  
                                                                                <i class='icon-user'></i> <i class='icon-cloud-upload'></i>
                                                                            </a>
                                                                            <a class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Property Not Pushed'>  
                                                                                <i class='icon-building'></i> <i class='icon-cloud-upload'></i>
                                                                            </a>
                                                                            <a class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Property Pushed'>  
                                                                                <i class='icon-building'></i> <i class='icon-cloud-upload'></i>
                                                                            </a>
                                                                        </td>
                                                                        <td>
                                                                            <a data-lightbox='flatty' href='<?php echo $profile_photo; ?>'>
                                                                                <img width="50" title="<?php echo $hostInfo->firstname; ?>" alt="<?php echo $hostInfo->firstname; ?>" src="<?php echo $profile_photo; ?>">
                                                                            </a>
                                                                            <a class='btn btn-link has-tooltip' target="_blank" data-placement='bottom' title='<?php echo $email; ?>' href="<?php echo WEB_URL; ?><?php echo strtolower($type);?>/view_profile/<?php echo $property->USER_ID;?>"><?php echo $hostInfo->firstname.' '.$hostInfo->lastname; ?> (<?php echo $type; ?>)</a>
                                                                        </td>
                                                                        <td><a class='btn btn-link has-tooltip' target="_blank" data-placement='bottom' title='<?php echo $property->AUTOCOMPLETE_ADDRESS; ?>' href="<?php echo WEB_FRONT_URL; ?>apartment/rooms/<?php echo $property->PROPERTY_ID;?>"><?php echo $property->PROP_NAME; ?></a></td>
                                                                        <td><?php echo $property->PROP_CITY; ?></td>
                                                                        <td><?php echo $property->PROP_COUNTRY; ?></td>
                                                                        <td><?php echo $property->PROP_PHONE; ?></td>
                                                                        <td>
																			<?php if($property->PROP_COUNTRY != 'AE') { ?>
																				<p style="color:red;">Not required</p>
																			<?php } elseif($property->PROP_COUNTRY == 'AE') { ?>
																					<?php if($property->ADMIN_APPROVAL_STATUS == 1) { ?>
																						<p style="color:green;">Admin has approved</p>
																					<?php } else { ?>
																						<a class="btn btn-success btn-xs has-tooltip" data-placement="top" title="Update Admin Property Status" href="<?php echo WEB_URL; ?>apartment_kigo/updateAdminPropertyStatus/<?php echo $info->PROPERTY_ID; ?>/">
																							<i class="icon-plus"></i>
																						</a>
																					<?php } ?>
																			<?php } ?>
                                                                        </td>
                                                                        <td>
                                                                           <select name="property_instat_book" id="<?php echo $property->PROPERTY_ID; ?>" onChange="updatePropertyStatus(this.value)">
                                                                            <option value="<?php echo WEB_URL; ?>apartment/updatePropertyStatus/<?php echo $property->PROPERTY_ID; ?>/1" <?php  if($property->PROPERTY_STATUS=='1') echo "selected"; ?>>List</option>
                                                                            <option value="<?php echo WEB_URL; ?>apartment/updatePropertyStatus/<?php echo $property->PROPERTY_ID; ?>/0" <?php  if($property->PROPERTY_STATUS=='0') echo "selected"; ?>>Unlist</option>
                                                                           </select>
                                                                        </td>
                                                                        <td>
                                                                            <?php if($property->PROPERTY_PHOTO_IMPORT_STATUS == 1 && $property->PROPERTY_PRICING_IMPORT_STATUS == 1)  { ?>
                                                                            <a target="_blank" href="<?php echo WEB_URL; ?>apartment_kigo/edit_property/<?php echo $property->PROPERTY_ID; ?>" title="Edit Property" data-placement="top" class="btn btn-info btn-xs has-tooltip">
                                                                                <i class="icon-edit"></i>
                                                                            </a>
                                                                            <?php } ?>
                                                                            <a target="_blank" href="<?php echo WEB_URL; ?>apartment/bookings/<?php echo $property->PROPERTY_ID; ?>" title="View Bookings" data-placement="top" class="btn btn-inverse btn-xs has-tooltip">
                                                                                <i class="icon-eye-open"></i>
                                                                            </a>
                                                                            <a class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Owner Not Pushed'>  
                                                                                <i class='icon-user'></i> <i class='icon-upload-alt'></i>
                                                                            </a>
                                                                            <a class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Owner Pushed'>  
                                                                                <i class='icon-user'></i> <i class='icon-upload-alt'></i>
                                                                            </a>
                                                                            <a class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Property Not Pushed'>  
                                                                                <i class='icon-building'></i> <i class='icon-upload-alt'></i>
                                                                            </a>
                                                                            <a class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Property Pushed'>  
                                                                                <i class='icon-building'></i> <i class='icon-upload-alt'></i>
                                                                            </a>   
                                                                            <?php if($property->PROPERTY_PHOTO_IMPORT_STATUS == 1) { ?>
                                                                                <?php $images = $this->Kigo_Model->get_property_images($property->PROPERTY_ID); if(!empty($images)) { ?>
                                                                                      <div class='gallery'>
                                                                                        <ul class='list-unstyled list-inline'>
                                                                                          <li>    
                                                                                              <div class='picture'>
                                                                                                <a data-lightbox='flatty<?php echo $images[0]->PROP_ID; ?>' href="<?php echo WEB_URL; ?>apartment_kigo/view_property_file/<?php echo $images[0]->PHOTO_ID; ?>" title="View Images" data-placement="top" class="btn btn-warning btn-xs has-tooltip">
                                                                                                    <i class="icon-picture"></i>
                                                                                                </a>
                                                                                               <?php for($i=1;$i<count($images);$i++) { ?>   
                                                                                                  <a data-lightbox='flatty<?php echo $images[$i]->PROP_ID; ?>' href="<?php echo WEB_URL; ?>apartment_kigo/view_property_file/<?php echo $images[$i]->PHOTO_ID; ?>" style="display: none;"></a>
                                                                                               <?php } ?>   
                                                                                              </div>
                                                                                          </li>                         
                                                                                        </ul>
                                                                                       </div>
                                                                                <?php } ?>
                                                                           <?php } ?>
                                                                        </td>
                                                                    </tr>
                                                            <?php
                                                                $i++;
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>S.No</th>
                                                                <th>Push Status</th>
                                                                <th>Host Name</th>
                                                                <th>Property Name</th>
                                                                <!-- <th>Property No</th> -->
                                                                <th>City</th>
                                                                <th>Country</th>
                                                                <th>Phone</th>
                                                                <th>Approval</th>
                                                                <th>Status</th>
                                                                <!-- <th>Street no</th>
                                                                <th>Address</th> -->
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
                    <?php $this->load->view('footer'); ?>
                </div>
            </section>
        </div>

        <!-- / jquery [required] -->

        <!-- / jquery mobile (for touch events) -->
        <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery.mobile.custom.min.js" type="text/javascript"></script>
        <!-- / jquery migrate (for compatibility with new jquery) [required] -->
        <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery-migrate.min.js" type="text/javascript"></script>
        <!-- / jquery ui -->
        <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery-ui.min.js" type="text/javascript"></script>
        <!-- / jQuery UI Touch Punch -->
        <script src="<?= base_url(); ?>assets/javascripts/plugins/jquery_ui_touch_punch/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
        <!-- / bootstrap [required] -->
        <script src="<?= base_url(); ?>assets/javascripts/bootstrap/bootstrap.js" type="text/javascript"></script>
        <!-- / modernizr -->
        <script src="<?= base_url(); ?>assets/javascripts/plugins/modernizr/modernizr.min.js" type="text/javascript"></script>
        <!-- / retina -->
        <script src="<?= base_url(); ?>assets/javascripts/plugins/retina/retina.js" type="text/javascript"></script>
        <!-- / theme file [required] -->
        <script src="<?= base_url(); ?>assets/javascripts/theme.js" type="text/javascript"></script>
        <!-- / demo file [not required!] -->
        <script src="<?= base_url(); ?>assets/javascripts/demo.js" type="text/javascript"></script>
        <!-- / START - page related files and scripts [optional] -->
        <script src="<?= base_url(); ?>assets/javascripts/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/datatables/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/datatables/dataTables.overrides.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/lightbox/lightbox.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/validate/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/validate/additional-methods.js" type="text/javascript"></script>
        <!-- / END - page related files and scripts [optional] -->
    </body>
</html>
<script>
function updatePropertyStatus(that) { window.location.href = that; }
$(function(){
$(".selectall").click(function () {
    $('.case').attr('checked', this.checked);
});

$(".case").click(function(){
 
        if($(".case").length == $(".case:checked").length) {
            $(".selectall").attr("checked", "checked");
        } else {
            $(".selectall").removeAttr("checked");
        }
 
    });
    $(".case").click(function(){
 
        if($(".case").length == $(".case:checked").length) {
            $(".selectall").attr("checked", "checked");
        } else {
            $(".selectall").removeAttr("checked");
        }
 
 });
 
$(".selectall_new").click(function () {
    $('.case_new').attr('checked', this.checked);
});

$(".case_new").click(function(){
 
        if($(".case_new").length == $(".case:checked").length) {
            $(".selectall_new").attr("checked", "checked");
        } else {
            $(".selectall_new").removeAttr("checked");
        }
 
    });
    $(".case_new").click(function(){
 
        if($(".case_new").length == $(".case:checked").length) {
            $(".selectall_new").attr("checked", "checked");
        } else {
            $(".selectall_new").removeAttr("checked");
        }
 
 });
 
});
</script>
