<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo Site_Title; ?></title>
        <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/styles.css" type="text/css" rel="stylesheet" media="all">
        <link href="<?php echo base_url(); ?>assets/css/registration.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
       
    </head>
    <body class="homePage">
        <div id="wrapper">
            <!--########################### HEADER STARTS HERE ###############################################################--->
            <?php $this->load->view('header'); ?>
            <!--############################ HEADER ENDS HERE ##############################################################--->
            <div class="container-fluid log_bac">
                <div class="container travelContent">
                    <div class="row travelRegister">
                        <?php
                        if ($status == 'success') {
                            ?>
                            <div class="alert alert-success alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Welcome,</strong> Your registration is successful. A mail has been sent with your account details. It will take 24hrs to activate your account. 
                            </div>
                            <?php
                        }
                        if ($status == 'failed') {
                            ?>
                            <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Oops!</strong> Something went wrong and your registration could not be completed. Please try again after some time.
                            </div>
                            <?php
                        }
                        ?>
                        <?php if (validation_errors() != "") { ?>
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php echo validation_errors(); ?>
                            </div>
                        <?php } ?>
                        <div class="col-md-12">                                                
                            <div class="col-sm-6 col-md-7 pull-right" style="padding: 15px 0px 15px 0px;">
                                <aside>
                                    <h2>Agent Sign Up</h2>
                                    <form name='agent_reg' action='<?php echo site_url(); ?>/home/register' method='POST'>
                                        <ul class="loginForm">
                                            <li class="row">
                                                <div class="col-md-6">
                                                    <label>Name<span class="mandatField">*</span></label>
                                                    <input type="text" name="agent_name" id="agent_name" class="form-control">
                                                    <span id='agent_name_error' style='color: red;display:none;'></span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Email<span class="mandatField">*</span></label>
                                                    <input type="text" class="form-control" name="agent_email" id="agent_email">
                                                    <span id='agent_email_error' style='color: red;display:none;'></span>
                                                </div>
                                            </li>
                                            <li class="row">
                                                <div class="col-md-6">
                                                    <label>Travel Agency Name</label>
                                                    <input type="text" class="form-control" name='company_name' id='company_name'>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Location<span class="mandatField">*</span></label>
                                                    <input type="hidden" value="" id="countyListSel" > 	

                                                    <select class="form-control" name="agent_country" id="agent_country">
                                                        <?php
                                                        if ($country_list != '') {
                                                            foreach ($country_list as $list) {
                                                                ?>
                                                                <option value="<?php echo $list->name; ?>" <?php echo($list->name == 'Philippines' ? 'selected="selected"' : '') ?>><?php echo $list->name; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </li>
                                            <li class="row">
                                                <div class="col-md-6">
                                                    <label>City</label>
                                                    <input type="text" class="form-control" name='agent_city' id='agent_city'>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="row" style="margin-left:0px;padding-left:0px;">
                                                        <div class="col-md-12" style="padding-left: 3px;">
                                                            <label>Mobile Number <span class="mandatField">*</span></label>
                                                        </div>
                                                        <div class="col-md-5 form-group" style="padding-left: 1px;">
                                                            <div class="fFileds">
                                                                <select name='phone_code' id='phone_code' class="form-control">
                                                                <?php
                                                                if ($phone_codes != '') {
                                                                    foreach ($phone_codes as $codes) {
                                                                        ?>
                                                                        <option value="<?php echo $codes->countries_isd_code; ?>" <?php echo($codes->countries_name == 'Philippines' ? 'selected="selected"' : '') ?>><?php echo $codes->countries_isd_code.' - '.$codes->countries_name; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                                </select>
                                                                
                                                                <span id='agent_code_error' style='color: red;display:none;font-size: 13px;' ></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-7" style="padding:0px;"> 
                                                            <input type="text" class="form-control" name="phone_no" id="phone_no" maxlength="10" onkeypress="return restrictCharacters(this, event, digitsOnly);"> 
                                                            <span id='agent_phone_error' style='color: red;display:none;font-size: 13px;'></span>
                                                        </div> 
                                                    </div>
                                                </div>


                                            </li>
                                            <li class="row">
                                                <div class="col-md-12">
                                                    <label>Comments</label>
                                                    <textarea rows="4" class="form-control" name='agent_comments' id="agent_comments"></textarea> 
                                                </div>
                                            </li>
                                        </ul>
					<div class="checkbox" style="padding-left: 24%; padding-top:5px;">
					    <label>
					      <input type="checkbox"> I Accept Redtag Travels <a href="#">terms and Conditions</a>
					    </label>
					  </div>
                                    </form>
                                </aside>
                                <div class="startToday">
                                    <input type='submit' name='submit' value='Register Now' id='agent_register_submit' class='_travelRegister btn orange' onclick='return validateAgentReg();' style="background: #f74623;border-color:#f74623;color:#ffffff; margin:auto;padding: 9px 50px 9px 50px;font-size: 16px;border-radius: 0px;">
                                    <div style='margin-top:8px;font-size:18px;color: #505050;'>
                                        Already an Agent? <a href='<?php echo base_url(); ?>index.php/home/login' style='color: #f74623;font-size: 20px;'>Sign In.</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--######################### FOOTER STARTS HERE #################################################################--->
            <?php $this->load->view('footer'); ?>
            <!--######################### FOOTER ENDS HERE #################################################################--->
        </div>
    </body>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/js/jquery.min.js'></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>  
    <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/common.js"></script>        
</html>
