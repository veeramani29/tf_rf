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
                        <h1 class="page-header">Create Sub Agent</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                
                <div class="row">
                    <div class="col-lg-12 tab-content">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Add New Sub Agent
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <form name="subagent_add" id="subagent_add" enctype="multipart/form-data">
                                        <div id="subagent_error" style="display:none;">
                                            <div class="alert alert-danger alert-dismissable">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>Oops!</strong> <span id="subagent_error_text"></span>
                                            </div>
                                        </div>
                                        <div id="subagent_success" style="display:none;">
                                            <div class="alert alert-success alert-dismissable">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>Success!</strong> <span id="subagent_success_text"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-10" style='margin-top: 22px;'>
                                            <label style='font-size: 20px;'>Personal Information</label>
                                            <hr style='margin-top: 0px;' />
                                        </div>
                                        <div class="col-md-5">
                                            
                                                <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
                                                    <label>Agent Name<span class="req_star">*</span></label>
                                                    <input class="form-control" id="sub_agent_name" name="sub_agent_name" value="" type="text" />
                                                    <span style="color:red;font-size: 11px;" id="sub_agent_name_error"></span>
                                                </div>
                                                <div class="form-group form-group-icon-left"><i class="fa fa-map-marker input-icon" aria-hidden="true"></i>
                                                    <label>Address</label>
                                                    <input class="form-control" id="sub_agent_address" name="sub_agent_address" value="" type="text" />
                                                </div>
                                                <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                    <label>City</label>
                                                    <input class="form-control" id="sub_agent_city" name="sub_agent_city" value="" type="text" />
                                                </div>

                                                <div class="form-group form-group-icon-left flo_left"><i class="fa fa-phone input-icon"></i>
                                                    <label>Phone Number<span class="req_star">*</span> ( with country code )</label>
                                                    <div style=" clear:both;"></div>
                                                    <input class="form-control inp_20" id="sub_agent_phone_code" name="sub_agent_phone_code" value="966" type="text" onkeypress="return restrictCharacters(this, event, digitsOnly);" />
                                                    <input class="form-control inp_75" id="sub_agent_phone_no" name="sub_agent_phone_no" style="padding-left:9px;" value="" type="text" onkeypress="return restrictCharacters(this, event, digitsOnly);" />
                                                    <span style="color:red;font-size: 11px;" id="sub_agent_phone_no_error"></span>
                                                </div>

                                                <div class="gap gap-small"></div>
                                        </div>
                                        <div class="col-md-5">

                                                <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
                                                    <label>Sub Agent Company Name<span class="req_star">*</span></label>
                                                    <input class="form-control" id="sub_agent_company_name" name="sub_agent_company_name" value="" type="text" />
                                                    <span style="color:red;font-size: 11px;" id="sub_agent_company_name_error"></span>
                                                </div>
                                                <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                    <label>Zip Code</label>
                                                    <input class="form-control" id="sub_agent_zip_code" name="sub_agent_zip_code" value="" type="text" />
                                                </div>
                                                <div class="form-group form-group-icon-left"><i class="fa fa-globe input-icon" aria-hidden="true"></i>
                                                    <label>Country<span class="req_star">*</span></label>
                                                    <select id="sub_agent_country" name="sub_agent_country" class="form-control" style="padding-top: 0;padding-bottom: 0;height: 41px;">
                                                        <option value="">select country</option>
                                                        <?php 
                                                            if($country_list != ''){
                                                                foreach($country_list as $list){
                                                        ?>
                                                                <option value="<?php echo $list->name; ?>" <?php echo($list->name == 'Saudi Arabia'?'selected="selected"':''); ?>><?php echo $list->name; ?></option>
                                                        <?php
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                    <span style="color:red;font-size: 11px;" id="sub_agent_country_error"></span>
                                                </div>
                                                <div class="form-group form-group-icon-left"><i class="fa fa-upload input-icon" aria-hidden="true"></i>

                                                    <label>sub Agent Logo</label>
                                                    <input class="form-control pad_0" id="new_image" name="new_image"  type="file" />
                                                 </div>
                                                <div class="gap gap-small"></div>

                                        </div>
                                        <div class="col-md-10" style='margin-top: 22px;'>
                                            <label style='font-size: 20px;'>Login Information</label>
                                            <hr style='margin-top: 0px;' />
                                        </div>
                                        <div class="col-md-5">
                                            
                                                <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
                                                    <label>Email address<span class="req_star">*</span></label>
                                                    <input class="form-control" id="sub_email_id" name="sub_email_id" value="" type="text" />
                                                    <span style="color:red;font-size: 11px;" id="sub_email_id_error"></span>
                                                </div>
                                                <div class="form-group form-group-icon-left"><i class="fa fa-map-marker input-icon" aria-hidden="true"></i>
                                                    <label>Password<span class="req_star">*</span></label>
                                                    <input class="form-control" id="sub_pass" name="sub_pass" value="" type="password" />
                                                    <span style="color:red;font-size: 11px;" id="sub_pass_error"></span>
                                                </div>
                                                <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                    <label>Confirm Password<span class="req_star">*</span></label>
                                                    <input class="form-control" id="sub_conf_pass" name="sub_conf_pass" value="" type="password" />
                                                    <span style="color:red;font-size: 11px;" id="sub_conf_error"></span>
                                                </div>
                                                <div class="gap gap-small"></div>
                                        </div>
                                        <div class="col-md-10">
                                            <hr>
                                            <div class="custom-search" style="margin-bottom: 35px;text-align:center;">
                                                <input type="button" name="" value="Add Sub Agent" id="submit_subagent_profile" onclick="return addNewSubAgentData();" class="btn" style="color:#ffffff;">
                                                <span id="loding_subagent_submit" style="display:none;">
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
