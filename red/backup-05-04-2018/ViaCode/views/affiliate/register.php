<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Redtag Affiliate</title>
        <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/styles.css" type="text/css" rel="stylesheet" media="all">
        <link href="<?php echo base_url(); ?>assets/css/registration.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/css/af_register.css" rel="stylesheet">
    </head>
    <body>
        <!---------------header-----------------------------start---------------------->
        <?php $this->load->view('header'); ?>
        <!---------------header-----------------------------end---------------------->
        <div class="container-fluid back_clr pad_0">
            <div class="container ">
                <section>
                    <div class="col-md-12">
                        <h3 class="text_center">Join now for free!</h3>
                        <p class="text_center">Signing up is easy and your account is confirmed instantly</p>
                    </div>
                    <div class="col-md-12 aff-form__signup">
                        <div id="error_div" style="display:none;">
                            <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Oops!</strong> Please add correct details and complete the registration.
                            </div>
                        </div>
                        <div id="success_div" style="display:none;">
                            <div class="alert alert-success alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success!</strong> Your request has been successfully done. It will be reviewed by Admin and notified by an email.
                            </div>
                        </div>
                        <form name="af_frm" id="af_frm" method="POST">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Company or website name </label>
                                    <input type="text" name="comp_name" class="form-control" id="comp_name" placeholder="Company or website name ">
                                    <span class="error_span" id="comp_name_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">First name </label>
                                    <input type="text" name="fname" class="form-control" id="fname" placeholder="First name ">
                                    <span class="error_span" id="fname_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Last name </label>
                                    <input type="text" name="lname" class="form-control" id="lname" placeholder="Last name ">
                                    <span class="error_span" id="lname_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Type of business </label>
                                    <select class="form-control" name="business_type">
                                        <option value="Travel & Tourism">Travel & Tourism</option>
                                    </select>
                                </div>  
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Phone No.</label>
                                    <input type="text" name="promo_code" class="form-control" id="promo_code" maxlength="15" onkeypress="return restrictCharacters(this, event, digitsOnly);" placeholder="Phone no">
                                    <span class="error_span" id="promo_code_error"></span>
                                </div>  


                                <div class="col-md-7 pad_left0 bor_1">
                                    <div class="col-md-8">
                                        <div class="checkbox pad_20">
                                            <label>
                                                <input type="checkbox" name="captcha" id="captcha" value="captcha"> I'm not a robot
                                            </label>
                                            <span class="error_span" id="captcha_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 pad_left0">
                                        <img class="wid30" src="<?php echo base_url(); ?>assets/img/logo_48.png">
                                        <p class="reca">reCAPTCHA</p>
                                        <p  class="reca"><a href="#">Privacy-Terms</a></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address </label>
                                    <input type="email" name="email_id" id="email_id" class="form-control" placeholder="Email address">
                                    <span class="error_span" id="email_id_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Confirm email address </label>
                                    <input type="email" name="conf_email" class="form-control" id="conf_email" placeholder="Confirm email address">
                                    <span class="error_span" id="conf_email_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Country </label>
                                    <select name="country" id="country" class="form-control">
                                        <option>-- Select Country --</option>
                                       <?php if($country_list != ''){ ?>
                                       <?php foreach($country_list as $list){ ?>
                                        <option value="<?php echo $list->name; ?>" <?php echo($list->name=='Philippines'?'selected="selected"':''); ?>><?php echo $list->name; ?></option>
                                       <?php } ?>
                                       <?php } ?>
                                    </select>
                                    <span class="error_span" id="country_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Website URL  </label>
                                    <input type="text" name="site_url" class="form-control" id="site_url" placeholder="Website URL">
                                    <span class="error_span" id="site_url_error"></span>
                                    <p><a href="#">Please type the full url including the protocol (http:// or https://)</a></p>
                                </div>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="af_terms" id="af_terms" value="yes"><a href="#"> I have read and understood the <b>affiliate partner agreement</b></a>
                                </label>
                                <span class="error_span" id="af_terms_error"></span>
                                <div class="col-md-12 pad_0" style="padding-top: 45px;">
                                    <button type="button" class="btn btn-success" id="af_reg_submit" style="width: 100%;padding: 10px;border-radius:5px;">Become an affiliate</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <h3 class="text_center">What happens after I sign up?</h3>
                        <p class="text_center">After signing up for the Redtagtravels.com Affiliate Partner Programme, you’ll receive a welcome email that
                            contains your login details, unique affiliate ID and some general information on how to get set up for success. Following this, you’ll receive 
                            a further email with instructions on how to verify your website. Once you’re verified, you can start earning commission.
                        </p>
                    </div>
                </section>
            </div>
        </div>
        <!---------------footer-----------------------------start---------------------->
        <?php $this->load->view('footer'); ?>
        <!---------------footer-----------------------------end---------------------->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script type='text/javascript' src='<?php echo base_url(); ?>assets/js/jquery.min.js'></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>  
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/common.js"></script>   
    </body>
    <style>
        .error_span{
            color: #ff4141;
            font-size: 13px;
            display:none;
        }

        .btn-success {
            color: #fff;
            background-color: #f74623 !important;
            border-color: #f74623 !important;
        }
        .btn-success:hover {
            color: #fff;
            background-color: #dc2400  !important;
            border-color: #dc2400  !important;
        }
        .btn-success:active{boder:none;}
        .prog_meter {
            position: relative;
            display: block;
            -webkit-border-top-right-radius: 8px;
            -webkit-border-bottom-right-radius: 8px;
            -moz-border-radius-topright: 8px;
            -moz-border-radius-bottomright: 8px;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
            -webkit-border-top-left-radius: 20px;
            -webkit-border-bottom-left-radius: 20px;
            -moz-border-radius-topleft: 20px;
            -moz-border-radius-bottomleft: 20px;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px; 
        }
        .prog_meter, .animate{
            content: "";

            top: 0; left: 0; bottom: 0; right: 0;
            background-image: 
                -webkit-gradient(linear, 0 0, 100% 100%, 
                color-stop(.25, rgba(255, 255, 255, .2)), 
                color-stop(.25, transparent), color-stop(.5, transparent), 
                color-stop(.5, rgba(255, 255, 255, .2)), 
                color-stop(.75, rgba(255, 255, 255, .2)), 
                color-stop(.75, transparent), to(transparent)
                );
            background-image: 
                -moz-linear-gradient(
                -45deg, 
                rgba(255, 255, 255, .2) 25%, 
                transparent 25%, 
                transparent 50%, 
                rgba(255, 255, 255, .2) 50%, 
                rgba(255, 255, 255, .2) 75%, 
                transparent 75%, 
                transparent
                );

            -webkit-background-size: 50px 50px;
            -moz-background-size: 50px 50px;
            -webkit-animation: move 2s linear infinite;
            -webkit-border-top-right-radius: 8px;
            -webkit-border-bottom-right-radius: 8px;
            -moz-border-radius-topright: 8px;
            -moz-border-radius-bottomright: 8px;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
            -webkit-border-top-left-radius: 20px;
            -webkit-border-bottom-left-radius: 20px;
            -moz-border-radius-topleft: 20px;
            -moz-border-radius-bottomleft: 20px;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            overflow: hidden;
        }



        @-webkit-keyframes move {
            0% {
                background-position: 0 0;
            }
            100% {
                background-position: 50px 50px;
            }
        }
    </style>

</html>