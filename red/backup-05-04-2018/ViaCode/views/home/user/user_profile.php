<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo Site_Title; ?></title>
        <!--################### CSS FILES STARTS ################################################-->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
        <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/dist/css/sb-admin-2.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/styles.css" type="text/css" rel="stylesheet" media="all">
        <link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!--################### CSS FILES ENDS ################################################-->
    </head>
    <body>
        <div id="wrapper">
            <?php $this->load->view('header'); ?>
            <!-- Navigation -->
            <?php $this->load->view('left_panel'); ?>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Profile Management</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row" style="margin-bottom:10px;">
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs" style="margin-left:0px;">
                        <li class="active"><a data-toggle="tab" href="#userProfile">Update Profile</a></li>
                        <li><a data-toggle="tab" href="#userPassword">Change Password</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12 tab-content">
                        <div id="userProfile" class="panel panel-default tab-pane fade in active">
                            <div class="panel-heading">
                                Update Your Profile
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <form name="user_profile" id="user_profile" enctype="multipart/form-data">
                                        <div id="user_error" style="display:none;">
                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>Oops!</strong> Please add correct profile details.
                                            </div>
                                        </div>
                                        <div id="user_success" style="display:none;">
                                            <div class="alert alert-success alert-dismissable">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>Success!</strong> Your profile has been successfully updated.
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                                <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
                                                    <label>Agent Name<span class="req_star">*</span></label>
                                                    <input class="form-control" id="agent_name" name="agent_name" value="<?php echo(isset($user_data) && $user_data != ''?$user_data->first_name:''); ?>" type="text" />
                                                    <span style="color:red;font-size: 11px;" id="agent_name_error"></span>
                                                </div>
                                                <div class="form-group form-group-icon-left"><i class="fa fa-map-marker input-icon" aria-hidden="true"></i>
                                                    <label>Address</label>
                                                    <input class="form-control" id="address" name="address" value="<?php echo(isset($user_data) && $user_data != ''?$user_data->address:''); ?>" type="text" />
                                                </div>
                                                <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                    <label>City</label>
                                                    <input class="form-control" id="city" name="city" value="<?php echo(isset($user_data) && $user_data != ''?$user_data->city:''); ?>" type="text" />
                                                </div>

                                                <div class="form-group form-group-icon-left flo_left"><i class="fa fa-phone input-icon"></i>
                                                    <label>Phone Number( with country code )<span class="req_star">*</span></label>
                                                    <div style=" clear:both;"></div>
                                                    <input class="form-control inp_20" id="phone_code" name="phone_code" value="<?php echo(isset($user_data) && $user_data != ''?$user_data->phone_code:''); ?>" type="text" onkeypress="return restrictCharacters(this, event, digitsOnly);" />
                                                    <input class="form-control inp_75" id="phone_no" name="phone_no" style="padding-left:9px;" value="<?php echo(isset($user_data) && $user_data != ''?$user_data->mobile_no:''); ?>" type="text" onkeypress="return restrictCharacters(this, event, digitsOnly);" />
                                                    <span style="color:red;font-size: 11px;" id="phone_no_error"></span>
                                                </div>

                                                <div class="gap gap-small"></div>
                                        </div>
                                        <div class="col-md-5">

                                                <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
                                                    <label>Agent Company Name<span class="req_star">*</span></label>
                                                    <input class="form-control" id="company_name" name="company_name" value="<?php echo(isset($user_data) && $user_data != ''?$user_data->company_name:''); ?>" type="text" />
                                                </div>
                                                <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                    <label>Zip Code</label>
                                                    <input class="form-control" id="zip_code" name="zip_code" value="<?php echo(isset($user_data) && $user_data != ''?$user_data->pin_code:''); ?>" type="text" />
                                                </div>
                                                <div class="form-group form-group-icon-left"><i class="fa fa-globe input-icon" aria-hidden="true"></i>
                                                    <label>Country<span class="req_star">*</span></label>
                                                    <select name="country" id="country" name="country" class="form-control" style="padding-top: 0;padding-bottom: 0;height: 41px;">
                                                        <option value="">select country</option>
                                                        <?php 
                                                            if($country_list != ''){
                                                                foreach($country_list as $list){
                                                        ?>
                                                                <option value="<?php echo $list->name; ?>" <?php echo($user_data != '' && $user_data->country == $list->name?'selected="selected"':''); ?>><?php echo $list->name; ?></option>
                                                        <?php
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                    <span style="color:red;font-size: 11px;" id="country_error"></span>
                                                </div>
                                                <div class="form-group form-group-icon-left"><i class="fa fa-upload input-icon" aria-hidden="true"></i>

                                                    <label>Agent Logo</label>
                                                    <input class="form-control pad_0" id="new_image" name="new_image"  type="file" />
                                                    <input type="hidden" name="old_image" id="old_image" value="<?php echo(isset($user_data) && $user_data != ''?$user_data->user_logo:''); ?>">
                                                 </div>
                                                <div class="gap gap-small"></div>

                                        </div>
                                        <div class="col-md-10">
                                            <hr>
                                            <div class="custom-search" style="margin-bottom: 35px;text-align:center;">
                                                <input type="button" name="" value="Update Profile" id="submit_user_profile" onclick="return checkUpdateUserData();" class="btn" style="color:#ffffff;">
                                                <span id="loding_user_submit" style="display:none;">
                                                    <img src="<?php echo base_url(); ?>assets/images/login_loder.gif" style="width: 30px;">
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="userPassword" class="panel panel-default tab-pane fade in">
                            <div class="panel-heading">
                                Change Your Account Password
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <form name="change_pass" id="change_pass">
                                        <div id="pass_error" style="display:none;">
                                           <div class="alert alert-danger alert-dismissable">
                                               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                               <strong>Oops!</strong> Please check your password details. Or your old password does not match.
                                           </div>
                                        </div>
                                        <div id="pass_success" style="display:none;">
                                            <div class="alert alert-success alert-dismissable">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>Success!</strong> Your password has been changed successfully.
                                            </div>
                                        </div>
                                        <div class="col-md-5">

                                                <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                                                    <label>Current Password<span class="req_star">*</span></label>
                                                    <input class="form-control" type="password" name="old_pass" id="old_pass">
                                                    <span style="color:red;font-size: 11px;" id="old_pass_error"></span>
                                                </div>
                                                <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                                                    <label>New Password<span class="req_star">*</span></label>
                                                    <input class="form-control" type="password" name="new_pass" id="new_pass">
                                                    <span style="color:red;font-size: 11px;" id="new_pass_error"></span>
                                                </div>
                                                <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                                                    <label>New Password Again<span class="req_star">*</span></label>
                                                    <input class="form-control" type="password" name="conf_pass" id="conf_pass">
                                                    <span style="color:red;font-size: 11px;" id="conf_pass_error"></span>
                                                </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="col-md-5">
                                            <hr>
                                            <div class="custom-search" style="margin-bottom: 35px;text-align:center;">
                                                <input type="button" name="update_pass" value="Update Password" id="update_pass" onclick="return checkUpdateUserPass();" class="btn" style="color:#ffffff;">
                                                <span id="loding_update_pass_submit" style="display:none;">
                                                    <img src="<?php echo base_url(); ?>assets/images/login_loder.gif" style="width: 30px;">
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#page-wrapper -->
            <?php echo $this->load->view('footer'); ?>
        </div>
    </body>
    <!--################### JS FILES STARTS ################################################-->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/common.js"></script>
    <!--################### JS FILES ENDS ################################################-->
</html>
