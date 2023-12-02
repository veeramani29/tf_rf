<!DOCTYPE html>
<!--[if IE 8]>          <html class="ie ie8"> <![endif]-->
<!--[if IE 9]>          <html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->  <html> <!--<![endif]-->
    <head>
    <title><?php echo Site_Title; ?></title>
    <meta charset="utf-8">
    <meta name="keywords" content="Redtag Travels" />
    <meta name="description" content="Redtag Travels">
    <meta name="author" content="Redtag Travels">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Theme Styles -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
    <link href="<?php echo base_url(); ?>assets/css/styles.css" type="text/css" rel="stylesheet" media="all">
    <link id="main-style" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/search.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/responsive.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/hotel-style12.css">
    <style>
        .pad_left0{padding-left: 0px;}
        .pad_0{padding:0px;}
        .mar_bot20{margin-bottom:20px;}
        .pad_top15{ padding-top:15px;}
        .form-control{height:45px;}
        .sort-by-section li {
    float: left;
    padding: 6px 5px;
}
    </style>
    </head>
    <body>
    <!--########################### HEADER STARTS HERE ###############################################################--->
    <?php $this->load->view('header'); ?>
    <!--############################ HEADER ENDS HERE ##############################################################--->
    <section id="content">
            <div class="container">
                <form name="contact" id="contact_frm">
                <div class="col-md-9 sort-by-section mar_bot20 pad_top15" style="padding-left: 27px;">
                    <h4>CONTACT US</h4>
                    
                        <div class="alert alert-danger alert-dismissable" id="contact_error" style="display:none;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Oops!</strong> The details could not be submitted. Please try again.
                        </div>
                    
                        <div class="alert alert-success" id="contact_success" style="display:none;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> Your query has been submitted successfully.
                        </div>
                    <div class="col-md-12 pad_left0" style="padding-bottom:20px;">
                      <div class="col-md-4 pad_left0">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Name</label>
                              <input type="text" name="usr_name" id="usr_name" class="form-control" placeholder="Your Name">
                              <span id="contact_name_error" style="color: red;display:none;"></span>
                            </div>
                    </div>
                        <div class="col-md-4 pad_left0">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Email</label>
                              <input type="text" class="form-control" name="usr_email" id="usr_email" placeholder="Your Email">
                              <span id="contact_email_error" style="color: red;display:none;"></span>
                            </div>
                    </div>
                        <div class="col-md-4 pad_left0">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Phone no:</label>
                              <input type="text" class="form-control" name="usr_phone" id="usr_phone" placeholder="Phone(With Country Code)">
                              <span id="contact_phone_error" style="color: red;display:none;"></span>
                            </div>
                        </div>
                        <div class="col-md-12 pad_left0">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Subject</label>
                              <input type="text" class="form-control" name="usr_subject" id="usr_subject" placeholder="Subject">
                              <span id="contact_subject_error" style="color: red;display:none;"></span>
                            </div>
                        </div>
                        <div class="col-md-12 pad_left0">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Requirements</label>
                              <textarea class="form-control" rows="3" name="usr_msg" id="usr_msg" placeholder="Your Requirements"></textarea>
                              <span id="contact_msg_error" style="color: red;display:none;"></span>
                            </div>
                        </div>
                        <input type="submit" name="submit" value="Submit Details" id="contact_submit" class="_travelRegister btn orange" style="background: #f74623;border-color:#f74623;color:#ffffff; margin:auto;padding: 9px 50px 9px 50px;font-size: 16px;border-radius: 0px;">
                        <span id="contact_progress" style="display:none;"><img src="<?php echo base_url(); ?>assets/images/small_loader.gif"></span >
                    </div>
                </div>
                </form>
                <div class="col-md-3" style="padding-right:0px;">
                    <div class="col-sm-12 col-md-12 contact-details sort-by-section mar_bot20 pad_top15" style="    padding-bottom: 18px;">
                        <h3>CONTACT INFO</h3>
                        <div class="col-md-12 pad_0">
                            <div class="col-md-2 pad_left0">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="col-md-10 pad_left0">
                                <p>732/21 Second Street, Manchester, King Street, Kingston United Kingdom</p>
                            </div>
                        </div>
                        <div class="col-md-12 pad_0">
                            <div class="col-md-2 pad_left0">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="col-md-10 pad_left0">
                                <a href="tel:345-677-554">345-677-554</a>
                            </div>
                        </div>
                        <div class="col-md-12 pad_0">
                            <div class="col-md-2 pad_left0">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <div class="col-md-10 pad_left0">
                                <a href="mailto:info@altairtheme.com">info@altairtheme.com</a>
                            </div>
                        </div>
                        <div class="col-md-12 pad_0">
                            <div class="col-md-2 pad_left0">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="col-md-10 pad_left0">
                                <a href="#" target="_blank">www.google.com</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-sm-12 col-md-12 contact-details sort-by-section mar_bot20 pad_top15" style="    padding-bottom: 18px;">
                       <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15558.35733084734!2d77.61791319999999!3d12.86978005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1500554531512" 
                               width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                    
            </div>  
        </section>
    <!--######################### FOOTER STARTS HERE #################################################################--->
    <?php $this->load->view('footer'); ?>
    <!--######################### FOOTER ENDS HERE #################################################################--->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/common.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js"></script>
</html>