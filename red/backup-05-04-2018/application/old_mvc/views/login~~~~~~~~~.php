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
                        if ($status == 'failed') {
                            ?>
                            <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Oops!</strong> Username and password not matched. Or your account may be inactive. Please contact support.
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
                        <div class="col-sm-6 col-md-5 leftSec">
                            <div style='font-size: 30px;color: #ffffff;margin-top: 82px;margin-left: 41px;'>
                                Redtag Travels - Agents
                            </div>
                            <div class='agent-text' style='color: #ffffff;font-size: 20px;font-weight: bold;margin-top: 42px;'>
                                <ul>
                                    <li style='margin-bottom: 15px;'>Register Now, it only takes minutes</li>
                                    <li style='margin-bottom: 15px;'>24/7 contacted by Redtag support team</li>
                                    <li style='margin-bottom: 15px;'>Create your own sub agents.</li>
                                    <li style='margin-bottom: 15px;'>Your account will be verified, and you are on you way to earn money.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-7 rightSec">
                            <aside>
                                <h2>Agent Sign In</h2>
                                <form name='agent_reg' action='<?php echo site_url(); ?>/home/login' method='POST'>
                                    <ul class="loginForm">
                                        <li class="row">
                                            <div class="col-md-6">
                                                <label>Email<span class="mandatField">*</span></label>
                                                <input type="text" name="agent_email" id="agent_login_email" class="form-control">
                                                <span id='agent_login_email_error' style='color: red;display:none;'></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Password<span class="mandatField">*</span></label>
                                                <input type="password" class="form-control" name="agent_pass" id="agent_login_pass">
                                                <span id='agent_login_pass_error' style='color: red;display:none;'></span>
                                            </div>
                                        </li>
                                        <li class="row">
                                            <div class="col-md-6">
                                                <div class="text-left">
                                                    <input type="checkbox" name="remember_me" id="remember_me" value="remember_me" onclick="check_return();" class="customCheckbox agreement check_bo" style="width: 22px !important;">
                                                    <label name="checkbox3_lbl" for="remember_me" style='color:#ffffff; float:left;'>Keep me signed in </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div style='float:right;'>
                                                    <a data-toggle="modal" data-target="#forgot_pass" data-backdrop="static" data-keyboard="false" style="cursor:pointer;color:#ffffff;;" id="forgot"> Forgot Password? </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="startToday">
                                        <input type='submit' name='submit' value='Sign In' id='agent_login_submit' class='_travelRegister btn orange' onclick='return validateAgentLogin();' style='background: #f74623;border-color:#f74623;color:#ffffff;'>
                                        <div style='margin-top:30px;font-size:18px;color:#ffffff;'>
                                            Don't Have Redtag Travels - Agent Account? <a href='<?php echo site_url(); ?>/home/register' style='color:#f74623;font-size: 20px;'>Click here.</a>
                                        </div>
                                    </div>
                                </form>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
            <div id="forgot_pass" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <span class="modal-title" style="font-size:16px;font-weight:bold">Generate a new password</span>
                        </div>
                        <div class="modal-body" style="text-align: center;">

                            <div id="agent_forgot_error" style="display:none;">
                                <p style="font-size: 15px;padding-bottom: 13px;color: red;">Email not associated to any account. </p>
                            </div>
                            <div id="agent_forgot_success" style="display:none;">
                                <p style="font-size: 15px;padding-bottom: 13px;color: green;">Password successfully Sent to your email. </p>
                            </div> 
                            <div class="form-group" style="margin-bottom: 0px;">
                                <input type="email" class="form-control" id="agent_forgot_email_id" name="agent_forgot_email_id" placeholder="Enter your email" style="height: 39px;width: 57%;border-radius: 0px;padding: 19px 0 19px 5px;border:1px solid #d0d7e1;margin-bottom: 0px;" required>
                                <div id="agent_new_email_id_error" style="margin-top: 4px;font-size: 12px;color: red;margin-left: 5px;display:none;"></div>

                            </div>

                            <div style="float: left;margin: 22px 0 11px 44%;">
                                <div style="float:left;">
                                    <input type="submit" tabindex="11" class="btn btn-primary pull-right" id="agent_forgot_pass_submit" value="Submit" title="Generate new account password" style="color: #ffffff;">
                                </div>
                                <div style="float:right;padding-top: 9px;">
                                    <span id="agent_forgot_pass_progress" style="padding-left: 5px;display:none;"><img src="<?php echo base_url(); ?>assets/images/login_loder.gif"></span>
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
<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/common.js"></script>
</html>
