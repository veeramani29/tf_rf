
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
   
    <?php $this->load->view('common/header'); ?>
   
    <div class="container breadcrub">
        <div>
            <a class="homebtn left" href="#"></a>
            <div class="left">
                <ul class="bcrumbs">
                    <li>/</li>
                    <li><a href="#" class="active">Contact</a></li>                    
                </ul>               
            </div>
            <a class="backbtn right" href="#"></a>
        </div>
        <div class="clearfix"></div>
        <div class="brlines"></div>
    </div>
  <div class="container">
        <div class="container mt25 offset-0">
            <!-- CONTENT -->
            <div class="col-md-12 pagecontainer2 offset-0">
                <div class="hpadding50c">
                    <p class="lato size30 slim">Contact Us</p>
                    <p class="aboutarrow"></p>
                </div>
                <div class="line3"></div>
                
                <div class="hpadding50c">
                <form name="contact" id="contact_frm">
                <div class="col-md-9 sort-by-section mar_bot20 pad_top15" style="padding-left: 27px;">
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
            <div class="clearfix"></div><br><br>
            </div>
            <!-- END CONTENT -->             
        </div>       
    </div>
      <?php $this->load->view('common/footer'); ?>

         <script src="<?php echo base_url(); ?>assets_/js/common.js"></script> 