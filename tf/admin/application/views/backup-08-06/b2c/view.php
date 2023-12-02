<!DOCTYPE html>
<html>
    <head>
        <title>B2C User Management | InnoGlobe</title>
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





        <script language="javascript">
        //frm is the form element
            function checkForm() {
                var len = $('#myform [name="cid[]"]:checked').length;
                if(len > 0){
                    return true;
                }else{
                    alert('Select one or more B2C Users');
                    return false;
                }
                // var destCount = $('#myform').elements['cid[]'].length;
                // alert(destCount);
                // var destSel = false;
                // for (i = 0; i < destCount; i++) {
                //     if ($('#myform')    .elements['cid[]'][i].checked) {
                //         destSel = true;
                //         break;
                //     }
                // }

                // if (!destSel) {
                //     alert('Select one or more B2C Users');
                // }
                // return destSel;
            }
        </script>




        <script type="text/javascript">
            function submitform()
            {
                if (document.myform.onsubmit &&
                        !document.myform.onsubmit())
                {
                    return;
                }
                document.myform.submit();
            }
        </script>




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
                                            <i class='icon-user'></i>
                                            <span>B2C User Management</span>
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
                                                <li class='active'>B2C User Management</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col-sm-12'>
                                    <div class='box bordered-box orange-border' style='margin-bottom:0;'>
                                      <div class='box-header'>
                                       <div class='actions'>
                                     <a href="<?php echo WEB_URL; ?>b2c/add_user"> <button class='btn'><i class='icon-user'></i> Add New User</button></a></div>
                                     </div>
                                     
                                    <form method="post" id="myform" action="<?php echo base_url(); ?>b2c/export_b2c_users" >
                                        <div class='box-header blue-background'>
                                            <div class='title'>B2C User Management</div>

                                            <div class='actions'>
                                             <a href="<?php echo WEB_URL; ?>b2c/export_b2c_users" > <button class='btn' id="target" onclick="return checkTheBox();" >   Export B2C users</button></a>
                                               
                                                <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a>
                                                      <?php if (!empty($user)) {
                                                                    $c = 1;
                                                                    foreach ($user as $users) { ?>
                                                                    <input type="hidden" class="case" id="case[]" name="cid[]" value="<?php echo $users->user_id; ?>"/>
                                                                    <?php
																	}
													  }
													  ?>
                                            </div>
                                        </div>
                                        </form>
                                        <div class='box-content box-no-padding'>
                                            <div class='responsive-table'>
                                                <div class='scrollable-area'>

                                                        <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;' id="b2c_users">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>Photo</th>
                                                                    <th>Name</th>
                                                                    <th>Email</th>
                                                                    <th>Contact</th>
                                                                    <th>City</th>
                                                                    <th>Owner</th>
                                                                    <th width="100">Status</th>
                                                                    <th width="100">Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php if (!empty($user)) {
                                                                    $c = 1;
                                                                    foreach ($user as $users) { ?>
                                                                        <tr>
                                                                        <td><?= $c; ?></td>
                                                                    
                                                                            <td>
                                                                                <a data-lightbox='flatty' href='<?php echo $users->profile_photo; ?>'>
                                                                                    <img width="50" title="<?= $users->firstname; ?>" alt="<?= $users->firstname; ?>" src="<?php echo $users->profile_photo; ?>">
                                                                                </a>
                                                                            </td>
                                                                            <td>
                                                                            <?php if ($users->v_email == '1') { ?>
                                                                            <a class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Email Verified'>  
                                                                                <i class='icon-envelope'></i>
                                                                            </a>
                                                                            <?php  } else { ?>
                                                                            <a class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Email Not Verified'>
                                                                                <i class='icon-envelope'></i>
                                                                            </a>
                                                                            <?php }	if ($users->v_mobile == '1') { ?> 
                                                                            <a class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Phone Verified'>  
                                                                                <i class='icon-phone'></i>
                                                                            </a>
                                                                            <?php  } else { ?>   
                                                                            <a class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Phone Not Verified'>  
                                                                                <i class='icon-phone'></i>
                                                                            </a>    
                                                                            <?php } if ($users->bank_details == '1' || $users->paypal_details == '1' ) { ?>
                                                                            <a class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Bank/Paypal Details Provided'>  
                                                                                <i class='icon-money'></i>
                                                                            </a>
                                                                            <?php  } else { ?>   
                                                                            <a class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Bank Details Not Provided'>  
                                                                                <i class='icon-money'></i>
                                                                            </a>    
                                                                            <?php }

					if ($users->property_owner_id !='' ) { ?>
                                                                            <a class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Property Owner Created'>  
                                                                                <i class='icon-hospital'></i>
                                                                            </a>
                                                                            <?php  } else { ?>   
                                                                            <a class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Property Owner Not Created'>  
                                                                                <i class='icon-hospital'></i>
                                                                            </a>    
                                                                            <?php } ?>

                                                                            &nbsp;<?= $users->firstname; ?>
                                                                            </td>
                                                                            
                                                                            <td><?= $users->email; ?></td>
                                                                           <!--  <td><?= $users->domain_name; ?></td> -->
                                                                            <td><?= $users->contact_no; ?></td>
                                                                            <td><?= $users->city; ?></td>
                                                                            <td>
																				<?php if($users->property_owner_created == 1) { ?>
																					<p style="color:green;">Exists</p>
																				<?php } elseif($users->property_owner_request == 1) { ?>
																					<p style="color:red;">Requested</p>
																				<?php } else { ?>
																					<p style="color:red;">Not requested</p>
																				<?php } ?>
                                                                            </td>
                                                                            <td>
																			<?php if ($users->status == '1') { ?>
                                                                                    <a class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Active'>
                                                                                        <i class='icon-ok'></i>
                                                                                    </a>
																			<?php } else { ?>
                                                                                    <a class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='De-active'>
                                                                                        <i class='icon-minus'></i>
                                                                                    </a>
                                                                                    <?php } ?>
                                                                                <select onchange="activate(this.value);">
                                                                                    <?php if ($users->status == '1') { ?>
                                                                                        <option value="<?php echo WEB_URL; ?>b2c/update_user_status/<?php echo $users->user_id; ?>/1" selected>Activate</option>
                                                                                        <option value="<?php echo WEB_URL; ?>b2c/update_user_status/<?php echo $users->user_id; ?>/0">De-activate</option>
																			<?php } else { ?>
                                                                                        <option value="<?php echo WEB_URL; ?>b2c/update_user_status/<?php echo $users->user_id; ?>/1">Activate</option>
                                                                                        <option value="<?php echo WEB_URL; ?>b2c/update_user_status/<?php echo $users->user_id; ?>/0" selected>De-activate</option>
                                                                                    </select>
																			<?php } ?>
                                                                            </td>
                                                                            <td>
                                                                                <div class='modal fade' id='modal-example2<?= $c; ?>' tabindex='-1'>
                                                                                    <div class='modal-dialog'>
                                                                                        <div class='modal-content'>
                                                                                            <div class='modal-header'>
                                                                                                <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>X</button>
                                                                                                <h4 class='modal-title' id='myModalLabel'>Send Promo Code</h4>
                                                                                            </div>
                                                                                            <div class='modal-body'>
                                                                                                <form class="form validate-form" style="margin-bottom: 0;" method="post" action="<?php echo WEB_URL; ?>b2c/send_user_promo/<?php echo $users->user_id; ?>">
                                                                                                    <div class='form-group'><strong>Choose Any One Promo</strong>
																								<?php $i = 1; foreach ($promo as $promos) { ?>
                                                                                                            <label class="control-label" for="validation_promo<?= $c . $i; ?>"></label><br>
                                                                                                            <div class='radio'>
                                                                                                                <label><input type='radio' data-rule-required='true' id="validation_promo<?= $c . $i; ?>" name="promoid" value='<?php echo $promos->promo_id; ?>'>
                                                                                                            <?php echo $promos->promo_code; ?> - <em> <font color="#FF00FD"><?php echo $promos->discount; ?>%</font> discount, valid upto <?php echo date('M j,Y', strtotime($promos->exp_date)); ?></em>
                                                                                                                </label>
                                                                                                            </div>
																								<?php $i++; } ?>
                                                                                                    </div>
                                                                                          
                                                                                            <div class='modal-footer'>
                                                                                                <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                                                                <button class='btn btn-primary' type='submit'>Send</button>
                                                                                            </div>
                                                                                            </form>
                 </div>                                                                         </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class='modal fade' id='modal-example1<?= $c; ?>' tabindex='-1'>
                                                                                    <div class='modal-dialog'>
                                                                                        <div class='modal-content'>
                                                                                            <div class='modal-header'>
                                                                                                <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>X</button>
                                                                                                <h4 class='modal-title' id='myModalLabel'>Send Notification</h4>
                                                                                            </div>
                                                                                            <div class='modal-body'>
                                                                                                <form class="form validate-form" style="margin-bottom: 0;" method="post" action="<?php echo WEB_URL; ?>b2c/send_notification/<?php echo $users->user_id; ?>">
                                                                                                    <div class='form-group'>
                                                                                                        <label class='control-label col-sm-3' for='validation_notification'>Message</label>
                                                                                                        <div class='col-md-9 controls'>
                                                                                                            <input class='form-control' data-rule-required='true' id='validation_notification' name='notification' placeholder='Notification' type='text'>
                                                                                                        </div>
                                                                                                    </div>
                                                                                            </div>
                                                                                            <div class='modal-footer'>
                                                                                                <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                                                                <button class='btn btn-primary' type='submit'>Send</button>
                                                                                            </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                               <div class='text-right'>
                                                                               
                                                                                
                    <a class='btn btn-inverse btn-xs has-tooltip' data-placement='top' title='Send Promo Code' data-toggle='modal' href='#modal-example2<?= $c; ?>' role='button'>
                                                                                        <i class='icon-barcode'></i>
                                                                                    </a>
                                                                                     <a class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Bookings' href='<?php echo WEB_URL; ?>b2c/view_bookings/<?= $users->user_id; ?>/3'>
                                                                                        <i class='icon-eye-open'></i>
                                                                                    </a>
                                                                                    <a class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Profile' href='<?php echo WEB_URL; ?>b2c/view_profile/<?= $users->user_id; ?>/3'>
                                                                                        <i class='icon-user'></i>
                                                                                    </a>
                                                                                    <a class='btn btn-warning btn-xs has-tooltip' data-placement='top' title='Send Mail' href='<?php echo WEB_URL; ?>b2c/send_user_mail/<?= $users->user_id; ?>'>
                                                                                        <i class='icon-envelope'></i>
                                                                                    </a>
                                                                                    <a class='btn btn-info btn-xs has-tooltip' data-placement='top' title='Edit User' href='<?php echo WEB_URL; ?>b2c/edit_b2c_user/<?= $users->user_id; ?>'>
                                                                                        <i class='icon-edit'></i>
                                                                                    </a>
                                                                                    <a class='btn btn-danger btn-xs has-tooltip'  data-placement='top' title='You Cant Delete User Accout. If You want this user stop the access. Kindly change the de-activae status' ><?php /*?>href='<?php echo WEB_URL; ?>b2c/update_user_status/<?= $users->user_id; ?>/2'<?php */?>
                                                                                        <i class='icon-remove'></i>
                                                                                    </a>
                                                                      <?php 
																	  if($users->property_owner_created != 1) {
																	  if ($users->v_email == '1' && $users->v_mobile == '1' && ($users->bank_details == 1 || $users->paypal_details == 1) ) { ?>              
                                                                            <a class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Create property owner account' href='<?php echo WEB_URL; ?>b2c/create_property_account/<?= $users->user_id; ?>'>
                                                                                <i class='icon-copy'></i>
                                                                            </a>
                                                                        <?php
																	  } else { ?> 
                                                                        <a class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Details pending, Cannot create property' >
                                                                              <i class='icon-copy'></i>
                                                                        </a>
                                                                    <?php } } ?>
                                                                                </div>
                                                                            </td>
                                                                        </tr>

																<?php $c++; } } ?>

                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    
                                                                    <th>S.No</th>
                                                                   
                                                                    <th></th>
                                                                    <th>Name</th>
                                                                    <th>E-mail</th>
                                                                    <!-- <th>Domain</th> -->
                                                                    <!-- <th>Address</th> -->
                                                                    <th>Contact</th>
                                                                    <th>City</th>
                                                                    <th>Owner</th>
                                                                    <th>Status</th>
                                                                    <!-- <th></th> -->
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

    <script type="text/javascript">
        function activate(that) { window.location.href = that; }
        $(document).ready(function() {
            var oTable = $('#b2c_users').dataTable();
            oTable.fnDestroy();
            $('#b2c_users').dataTable( {
                "info":     true,
                "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 1 ] }]
            } );

        } );
    </script>

    <SCRIPT language="javascript">
     // Script For Check All Checkboxs
$(function(){
 
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.case').attr('checked', this.checked);
    });
 
 
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
 
    });
});
</SCRIPT>
</html>
