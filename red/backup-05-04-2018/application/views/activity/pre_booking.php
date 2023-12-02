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
        <div class="container re_pad0">
            <div class="col-md-12 re_pad0">
                <?php //if(isset($depositBalance) && ($totalPrice  > $depositBalance)){ ?>
<!--                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <strong>Low Balance!</strong> Your account deposit balance is lower than the hotel booking cost. Kindly add deposit then book the hotel.
                    </div>
                </div>-->
                <?php //} ?>
                <div class="col-md-6 re_padleft0">
                    <h4>Traveler Details</h4>
                </div>
<!--                <div class="col-md-6 re_padright0">
                    <p class="pull-right re_padtop20"><span><a href="#" style="color: #fe0000;">Hotel</a></span> / <span><a href="#" style="color: #fe0000;">Hotel booking</a></span></p>
                </div>-->
            </div>
            <div class="col-md-12 re_pad0">
                <div class="col-md-9 re_padleft0 re_padbottom20">
                    <div class="col-md-12 re_padleft0">
                        
                        <div class="col-md-12 re_pad0">
                            <h5>Passenger Details</h5>
                        </div>
                        <form name="booking" method="POST" action="<?php echo site_url(); ?>/activity/booking_process">  
                            <?php for ($i = 0; $i < $adult; $i++){ ?>
                            <div class="col-md-12 hotel-item">
                                
                                <div class="col-md-12 re_pad0">
                                    <div class="col-md-2 re_padleft0">
                                        <p class="re_padtop31">Adult <?php echo ($i+1); ?> :</p>
                                    </div>
                                    <div class="col-md-2 re_padleft0">
                                        <label for="exampleInputEmail1">Title:</label>
                                        <select class="form-control" name="adulttitle[]" required>
                                            <option value="Mr">Mr</option>
                                            <option value="Mrs">Mrs</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 re_padleft0">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">First Name</label>
                                                <input type="text" class="form-control" name="adultFname[]" required placeholder="First Name">
                                            </div>
                                    </div>
                                    <div class="col-md-4 re_padleft0">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Last Name</label>
                                                <input type="text" class="form-control" name="adultLname[]" required placeholder="Last Name">
                                            </div>
                                    </div>
                                </div>
                                
                            <?php } ?>
                                <?php if($child != '' && $child > 0){ ?>
                            <?php for ($i = 0; $i < $child; $i++){ ?>
                            <div class="col-md-12 hotel-item">
                                
                                <div class="col-md-12 re_pad0">
                                    <div class="col-md-2 re_padleft0">
                                        <p class="re_padtop31">Adult <?php echo ($j+1); ?> :</p>
                                    </div>
                                    <div class="col-md-2 re_padleft0">
                                        <label for="exampleInputEmail1">Title:</label>
                                        <select class="form-control" name="childtitle[]" required>
                                            <option value="Mr">Mr</option>
                                            <option value="Mrs">Mrs</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 re_padleft0">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">First Name</label>
                                                <input type="text" class="form-control" name="childFname[]" required placeholder="First Name">
                                            </div>
                                    </div>
                                    <div class="col-md-4 re_padleft0">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Last Name</label>
                                                <input type="text" class="form-control" name="childLname[]" required placeholder="Last Name">
                                            </div>
                                    </div>
                                    <div class="col-md-4 re_padleft0">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">DOB</label>
                                                <input type="text" class="form-control" name="child_dob[]" required placeholder="YYYY-MM-DD">
                                            </div>
                                    </div>
                                </div>
                                <input type="hidden" name="act_child_age[]" value="<?php echo $childAge; ?>" >
                            <?php } ?>
                            <?php } ?>
                            <?php
                                if($pickupPoints['error'] == ''){
                            ?>
                                    <div class="col-md-4 re_padleft0">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Pickup/DropOff Point</label>
                                                <select class="form-control" name="pick_point" required>
                            <?php
                                    for($i = 0;$i< count($pickupPoints['hotelCode']);$i++){
                            ?>
                                      <option value="<?php echo $pickupPoints['hotelCode']; ?>"><?php echo $pickupPoints['hotelCode']; ?></option>
                            <?php
                                    }
                            ?>
                                            </select>
                                        </div>
                                  </div>
                            <?php
                                } else {
                            ?>
                                <input type="hidden" name="pick_point" value="">
                            <?php
                                }
                            ?>    
                                
                            <div class="col-md-12 re_pad0">
                                <h5>Enter Your Personal Information(Note : voucher will be sent to the below email id.)</h5>
                            </div>
                            <div class="col-md-12 hotel-item" style="padding-top:15px; padding-bottom:15px;">
                                
                                <div class="col-md-12 re_pad0">

                                    <div class="col-md-4 re_padleft0">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email id</label>
                                                <input type="email" class="form-control" name="user_email" required placeholder="Email id">
                                            </div>
                                    </div>
                                    <div class="col-md-4 re_padleft0">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Phone Number</label>
                                                <input type="text" class="form-control" name="user_mobile" required placeholder="Phone Number">
                                            </div>
                                    </div>
                                    <div style="clear:both;"></div>
                                    <div class="col-md-12 re_pad0"><hr></div>
                                </div>
                                <input type="hidden" name="act_id" value="<?php echo $id; ?>">
                                <input type="hidden" name="act_date" value="<?php echo $date; ?>">
                                <input type="hidden" name="act_adult" value="<?php echo $adult; ?>">
                                <input type="hidden" name="act_child" value="<?php echo $child; ?>">
                                <input type="hidden" name="tour_list" value="<?php echo $tourList; ?>">
                                <div class="col-md-12 re_pad0">

<!--                                    <div class="col-md-4 re_padleft0">
                                        <form>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email id</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email id">
                                            </div>
                                        </form>
                                    </div>-->
<!--                                    <div class="col-md-3 re_padleft0">
                                        <input type="submit" name="submit" value="Redeem" id="agent_login_submit" class="_travelRegister btn orange" onclick="return validateAgentLogin();" style="background: #f74623;border-color:#f74623;color:#ffffff; margin-top: 24px;">
                                    </div>-->
                                    <div style="clear:both;"></div>
                                    <?php //if(isset($depositBalance) && ($totalPrice  > $depositBalance)){ ?>
                                    <div class="col-md-3 re_padleft0">
                                        <input type="submit" name="submit" value="Continue to Payment" id="agent_login_submit" class="_travelRegister btn orange" onclick="return validateAgentLogin();" style="background: #f74623;border-color:#f74623;color:#ffffff;">
                                    </div>
                                    <?php //} ?>
                                </div>
                            </div>
                        </form>
                    </div>
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