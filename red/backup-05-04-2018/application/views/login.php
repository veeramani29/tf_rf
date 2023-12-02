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
        <style>
            .back_grd{ background-image: url("<?php echo base_url(); ?>assets/images/header1.jpg");}
            .nav>li>a:focus, .nav>li>a:hover{background:none;}
            #nav{border-top: 3px solid #f74624;border-bottom: 0px;}

            .u_l ul li{color:#fff; padding-bottom: 12px;}
            .u_l ul li a{color:#fff;text-decoration:none;}
            .u_l ul li a:hover{color:#f74623;}
            .polic_hover:hover{color:#f74623;    text-decoration: none;}
            .polic_hover{color:#fff;text-decoration:none;}

        </style>
    </head>
    <body class="homePage">
        <div id="wrapper">
            <!--########################### HEADER STARTS HERE ###############################################################--->
            <!--########################### HEADER STARTS HERE ###############################################################--->

            <!--############################ HEADER ENDS HERE ##############################################################--->
            <?php $this->load->view('header'); ?>
            <!--############################ HEADER ENDS HERE ##############################################################--->
            <div class="container-fluid pad0">
                <div class="col-md-12 pad0 back_grd">
                    <div class="container">
                        <div class="travelContent">
                            <div class="row travelRegister">
                                <div class="col-md-12">   
                                    <div class="col-md-5 pull-right" style="    margin-top: 10px;margin-bottom: 10px;">
                                        <aside style="border: 1px solid #d2d1d1; float:left;">
                                            <h2>Agent Sign In</h2>
                                            <?php if(isset($status) && $status == 'failed'){ ?>
                                            <div class="alert alert-danger">
                                                <strong>Oop's!</strong> Login failed. Check credentials.
                                            </div>
                                            <?php } ?>
                                            <form name='agent_reg' action='<?php echo base_url(); ?>index.php/home/login' method='POST'>
                                                <ul class="loginForm">
                                                    <li class="row">
                                                        <div class="col-md-12" style="padding-bottom:20px;">

                                                            <input type="text" name="agent_email" id="agent_login_email" class="form-control" placeholder="Email">
                                                            <span id="agent_login_email_error" style="color: red;display:none;"></span>
                                                        </div>
                                                        <div class="col-md-12">

                                                            <input type="password" class="form-control" name="agent_pass" id="agent_login_pass" placeholder="Password">
                                                            <span id="agent_login_pass_error" style="color: red;display:none;"></span>
                                                        </div>
                                                    </li>
                                                    <li class="row">
                                                        <div class="col-md-6">
                                                            <div class="text-left">
                                                                <input type="checkbox" name="remember_me" id="remember_me" value="remember_me" onclick="check_return();" class="customCheckbox agreement check_bo_log">
                                                                <label  for="remember_me" style="color:#505050; float:left; font-size:14px;">Keep me signed in </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">

                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="col-md-12" >
                                                    <div class="col-md-6 pad0" style="padding-top: 11px;"><p style=" font-size:14px;">Forgot Password? <br /><a data-toggle="modal" data-target="#forgot_pass" data-backdrop="static" data-keyboard="false" style="cursor:pointer;" id="forgot" style="font-size: 13px;">Click Here</a></p></div>
                                                    <div class="col-md-6" style="padding: 11px 0px 0px 23px;">
                                                        <input type="submit" name="submit" value="Login" id="agent_login_submit" class="_travelRegister btn orange" onclick="return validateAgentLogin();" style="background: #f74623;border-color:#f74623;color:#ffffff; margin:auto;padding: 9px 50px 9px 50px;font-size: 16px;border-radius: 0px;">
                                                    </div>
                                                </div>

                                            </form>
                                        </aside>
                                        <div class="startToday">
                                            <div class="col-md-12 bor_das">
                                                <div class="col-md-6" style="padding-top: 10px;">
                                                    <p style=" font-size:14px;">Not yet registered?</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <a href="<?php echo site_url(); ?>/home/register" class="_travelRegister btn orange reg_but12" style="padding: 9px 34px 9px 34px;border-radius: 0px;text-decoration:none;">Register Now</a>
                                                </div>
                                            </div>
                                            <div class="col-md-12" style="padding-top:17px;">
                                                <div class="col-md-4 pad0">
                                                    <div class="list-item" style="text-align: left;padding-left: 20px; font-size:15px;">
                                                        <i class="fa fa-phone"></i>
                                                        <a href="tel:345-677-554">345-677-554</a>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 pad0">
                                                    <div class="list-item" style="padding-left: 18px; font-size:15px;">
                                                        <i class="fa fa-envelope-o"></i>
                                                        <a href="contact@redtagtravels.com">contact@redtagtravels.com</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  

                            </div>
                        </div>

                    </div>



                </div>       
            </div>  

            <!--######################### FOOTER STARTS HERE #################################################################--->
            <?php $this->load->view('footer'); ?>
            <!--######################### FOOTER STARTS HERE #################################################################--->
            <div id="forgot_pass" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content" style="border-radius: 0px;border-top: 3px solid #f74623;border-bottom: 3px solid #f74623;">
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
                                    <input type="submit" tabindex="11" class="btn btn-primary pull-right" id="agent_forgot_pass_submit" value="Submit" title="Generate new account password" style="background: #f74623;border-color:#f74623;color:#ffffff; margin:auto;padding: 9px 50px 9px 50px;font-size: 16px;border-radius: 0px;">
                                </div>
                                <div style="float:right;padding-top: 9px;">
                                    <span id="agent_forgot_pass_progress" style="padding-left: 5px;display:none;"><img src="<?php echo base_url(); ?>assets/images/login_loder.gif"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="border-top: 0px;"></div>
                    </div>
                </div>
            </div>   
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
