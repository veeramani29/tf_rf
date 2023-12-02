<!DOCTYPE html>
<html>
    <head>
        <title><?php echo Site_Title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/styles.css" type="text/css" rel="stylesheet" media="all">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
        <link href="<?php echo base_url(); ?>assets/css/awe-booking-font.css" type="text/css" rel="stylesheet" media="all">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/hotel-style12.css">
        <link href="<?php echo base_url(); ?>assets/css/hotel_details.css" type="text/css" rel="stylesheet" media="all">
        <style>
            .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{ border-top:0px; border-left:0px; border-right: 0px; border-bottom: 2px solid #f74623; }
            h4,h5,h6{color: #515151;}
            p{color: #515151;}
            label{color: #515151;font-weight: 100;}
        </style>
    </head>
    <body>
    <!--########################### HEADER STARTS HERE ###############################################################--->
    <?php $this->load->view('header'); ?>
    <!--############################ HEADER ENDS HERE ##############################################################--->
    <div class="container">
        <div class="col-md-12" style="margin-top:20px;margin-bottom:20px;">
            <div class="alert alert-danger">
                <strong>Booking Failed!</strong> Due to some reason the booking failed or the flight is no longer available. Please search again and book the flight.<br />No amount has been deducted from your account.
            </div>
        </div>
    </div>
        <div style="clear:both;"></div>
    <!--######################### FOOTER STARTS HERE #################################################################--->
    <?php $this->load->view('footer'); ?>
    <!--######################### FOOTER ENDS HERE #################################################################--->
    </body>
    <!--################### JS FILES STARTS ################################################-->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
    <!--################### JS FILES ENDS ################################################-->
</html>	