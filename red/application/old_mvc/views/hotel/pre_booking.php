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
                <div class="col-md-6 re_padleft0">
                    <h4>Traveler Details</h4>
                </div>
                <div class="col-md-6 re_padright0">
                    <p class="pull-right re_padtop20"><span><a href="#" style="color: #fe0000;">Hotel</a></span> / <span><a href="#" style="color: #fe0000;">Hotel booking</a></span></p>
                </div>
            </div>
            <div class="col-md-12 re_pad0">
                <div class="col-md-9 re_padleft0 re_padbottom20">
                    <div class="col-md-12 re_padleft0">
                        <div class="col-md-12 hotel-item"  style="padding-top:15px; padding-bottom:15px;">
                            <div class="col-md-4 re_padleft0">
                                <img src="<?php echo base_url(); ?>assets/images/img/11.jpg" alt="">
                            </div>
                            <div class="col-md-8 re_padleft0">
                                <h4><?php echo $hotel_data['name']; ?></h4>
                                <div class="col-md-12 re_padleft0" style="padding-bottom: 10px;">
                                    <?php if($star == 1){ ?>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <?php } else if($star == 1.5){ ?>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star-half-o pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <?php } else if($star == 2){ ?>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <?php } else if($star == 2.5){ ?>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-half-o pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <?php } else if($star == 3){ ?>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <?php } else if($star == 3.5){ ?>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star-half-o pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <?php } else if($star == 4){ ?>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <?php } else if($star == 4.5){ ?>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-half-o pull-left" aria-hidden="true"></i>
                                    <?php } else if($star == 5){ ?>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i>
                                    <?php } else { ?>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <?php } ?>
                                </div>
                                
                                <p class="re_marbottom0"><?php echo $address; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php if(isset($bookingPrepare) && $bookingPrepare != ''){ ?>
                    <div class="col-md-12 re_padleft0">
                        <div class="col-md-12 re_pad0">
                            <h5>Cancellation and Notes</h5>
                        </div>
                        <?php $i = 0; ?>
                        <?php if($bookingPrepare != ''){ ?>
                        <div class="col-md-12 hotel-item">
                        <?php foreach($bookingPrepare['rooms'] as $room){ ?>
                            <div class="col-md-12 re_pad0"><h6>Room <?php echo ($i+1); ?></h6></div>
                            <div class="col-md-12 re_pad0">
                                <?php 
                                    if(isset($room['message']) && !empty($room['message'])){
                                        echo '<p>'.$room['message'][0]['Text'].'</p>';
                                    }

                                    $cancel_policy = '';
                                    
                                    foreach ($room['cancelData'] as $key => $value) {
                                        $roomPrice = $value['Amount'];
                                        if($cur_val != 0){ $roomPrice = $roomPrice*number_format((float)$cur_val, 2, '.', ''); }
                                        
                                        if($admin_markup['type'] == 'fixed'){
                                            $mTyp = $searchData['type'];
                                            $roomPrice = $roomPrice+$admin_markup[$mTyp];
                                        } else {
                                            $mTyp = $searchData['type'];
                                            $roomPrice = ((($admin_markup[$mTyp]/100)*$roomPrice)+$roomPrice);
                                        }

                                        if($agent_markup['type'] == 'fixed'){
                                            $amTyp = $searchData['type'];
                                            $roomPrice = $roomPrice+$agent_markup[$amTyp];
                                        } else {
                                            $amTyp = $searchData['type'];
                                            $roomPrice = ((($agent_markup[$amTyp]/100)*$roomPrice)+$roomPrice);
                                        }
                                       
                                        $cancel_policy .= "Cancellation penalty for cancellation done on or after <b>" . ($value['from']) . "</b> before the check in date <b>" . $searchData['cin'] . "</b> , <b>&#8369; ".number_format($roomPrice,2,'.',',') . "</b> will be charged.<br />";
                                    }
                                    echo '<p>'.$cancel_policy.'</p>';
                                ?>
                            </div>
                        <?php $i++; ?>
                        <?php } ?>
                        </div>
                        <?php } ?>
                        <div class="col-md-12 re_pad0">
                            <h5>Passenger Details</h5>
                        </div>
                        <form name="booking" method="POST" action="<?php echo site_url(); ?>/hotel/booking_process">  
                            <?php for ($i = 0; $i < $searchData['room_count']; $i++){ ?>
                            <div class="col-md-12 hotel-item">
                                <div class="col-md-12 re_pad0"><h6>Room <?php echo ($i+1); ?></h6></div>
                                <?php for ($j = 0; $j < $searchData['adult'][$i]; $j++){ ?>
                                <div class="col-md-12 re_pad0">
                                    <div class="col-md-2 re_padleft0">
                                        <p class="re_padtop31">Adult <?php echo ($j+1); ?> :</p>
                                    </div>
                                    <div class="col-md-2 re_padleft0">
                                        <label for="exampleInputEmail1">Title:</label>
                                        <select class="form-control" name="adulttitle[<?php echo $i; ?>][]" required>
                                            <option value="Mr">Mr</option>
                                            <option value="Mrs">Mrs</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 re_padleft0">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">First Name</label>
                                                <input type="text" class="form-control" name="adultFname[<?php echo $i; ?>][]" required placeholder="First Name">
                                            </div>
                                    </div>
                                    <div class="col-md-4 re_padleft0">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Last Name</label>
                                                <input type="text" class="form-control" name="adultLname[<?php echo $i; ?>][]" required placeholder="Last Name">
                                            </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php 
                                    if(isset($searchData['child'][$i]) && $searchData['child'][$i] > 0){
                                        for ($k = 0; $k < $searchData['child'][$i]; $k++){
                                ?>
                                        <div class="col-md-12 re_pad0">
                                            <div class="col-md-2 re_padleft0">
                                                <p class="re_padtop31">Child <?php echo ($k+1); ?> :</p>
                                            </div>
                                            <div class="col-md-2 re_padleft0">
                                                <label for="exampleInputEmail1">Title:</label>
                                                <select class="form-control" name="childtitle[<?php echo $i; ?>][]" required>
                                                    <option value="Mr">Mr</option>
                                                    <option value="Mrs">Mrs</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 re_padleft0">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">First Name</label>
                                                        <input type="text" class="form-control" name="childFname[<?php echo $i; ?>][]" required placeholder="First Name">
                                                    </div>
                                            </div>
                                            <div class="col-md-4 re_padleft0">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Last Name</label>
                                                        <input type="text" class="form-control" name="childLname[<?php echo $i; ?>][]" placeholder="Last Name">
                                                    </div>
                                            </div>
                                        </div>
                                <?php
                                        }
                                    }
                                ?>
                            </div>
                            <?php } ?>

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
                                <input type="hidden" name="aid" value="<?php echo $api_id; ?>">
                                <input type="hidden" name="mid" value="<?php echo $id; ?>">
                                <input type="hidden" name="rid" value="<?php echo $room_id; ?>">
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
                                    <div class="col-md-3 re_padleft0">
                                        <input type="submit" name="submit" value="Continue to Payment" id="agent_login_submit" class="_travelRegister btn orange" onclick="return validateAgentLogin();" style="background: #f74623;border-color:#f74623;color:#ffffff;">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php } else { ?>
                    <div class="col-md-12 re_pad0">
                        <h5>Oop's! This room is no longer available. Try searching again and book the hotel. </h5>
                    </div>
                   <?php } ?>
                    
                </div>
                <?php if(isset($bookingPrepare) && $bookingPrepare != ''){ ?>
                <div class="col-md-3 re_padright0">
                    <div class="col-md-12 hotel-item">
                        <div class="col-md-12 re_padleft0">
                            <h5>Your Booking Details</h5>
                        </div>
                        <div class="col-md-12 re_pad0">
                            <hr class="re_martop0">
                        </div>
                        <div class="col-md-12 re_pad0">
                            <div class="col-md-4 re_pad0">
                                <p class="re_font13">Check In :</p>
                            </div>
                            <div class="col-md-8 re_pad0">
                                <p class="re_font12"><?php echo date('D d, M, Y',strtotime($searchData['cin'])); ?></p>
                            </div>
                        </div>
                        <div class="col-md-12 re_pad0">
                            <hr class="re_martop0">
                        </div>
                        <div class="col-md-12 re_pad0">
                            <div class="col-md-4 re_pad0">
                                <p class="re_font13">Check Out :</p>
                            </div>
                            <div class="col-md-8 re_pad0">
                                <p class="re_font12"><?php echo date('D d, M, Y',strtotime($searchData['cout'])); ?></p>
                            </div>
                        </div>
                        <div class="col-md-12 re_pad0">
                            <hr class="re_martop0">
                        </div>
                        <div class="col-md-12 re_pad0">
                            <div class="col-md-5 re_pad0">
                                <p class="re_font13">Total stay:</p>
                            </div>
                            <div class="col-md-7 re_pad0">
                                <p class="re_font12"><?php echo $searchData['nights']; ?> night(s)</p>
                            </div>
                        </div>
                        <div class="col-md-12 re_pad0">
                            <hr class="re_martop0">
                        </div>
                        <div class="col-md-12 re_pad0">
                            <div class="col-md-4 re_pad0">
                                <p class="re_font13">You selected :</p>
                            </div>
                            <div class="col-md-8 re_pad0">
                                <p class="re_font12"><?php echo $bookingPrepare['rooms'][0]['room_type_text']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 hotel-item">
                        <div class="col-md-12 re_padleft0">
                            <h5>Price Details</h5>
                        </div>
                        <div class="col-md-12 re_pad0">
                            <hr class="re_martop0">
                        </div>
                        <?php 
                        $i = 0;
                        $totalPrice = 0;
                        if($bookingPrepare != ''){
                            foreach($bookingPrepare['rooms'] as $room){
                            $roomPrice = $room['TotalSellingPrice'];
                            if($cur_val != 0){ $roomPrice = $roomPrice*number_format((float)$cur_val, 2, '.', ''); }
                            if($i == 0){
                                if($admin_markup['type'] == 'fixed'){
                                    $mTyp = $searchData['type'];
                                    $roomPrice = $roomPrice+$admin_markup[$mTyp];
                                } else {
                                    $mTyp = $searchData['type'];
                                    $roomPrice = ((($admin_markup[$mTyp]/100)*$roomPrice)+$roomPrice);
                                }

                                if($agent_markup['type'] == 'fixed'){
                                    $amTyp = $searchData['type'];
                                    $roomPrice = $roomPrice+$agent_markup[$amTyp];
                                } else {
                                    $amTyp = $searchData['type'];
                                    $roomPrice = ((($agent_markup[$amTyp]/100)*$roomPrice)+$roomPrice);
                                }
                            }
                        ?>
                        Room <?php echo ($i+1); ?>
                        <div class="col-md-12 re_pad0">
                            <div class="col-md-6 re_pad0">
                                <p class="re_font13">Base Price :</p>
                            </div>
                            <div class="col-md-6 re_pad0">
                                <p class="re_font12">&#8369; <?php echo number_format($roomPrice,2,'.',','); ?></p>
                            </div>
                        </div>
                        <div class="col-md-12 re_pad0">
                            <hr class="re_martop0">
                        </div>
                        <div class="col-md-12 re_pad0">
                            <div class="col-md-6 re_pad0">
                                <p class="re_font13">Taxes and Fees:</p>
                            </div>
                            <div class="col-md-6 re_pad0">
                                <p class="re_font12">&#8369; 0.00</p>
                            </div>
                        </div>
                        
                        <?php 
                                $totalPrice = $totalPrice+$roomPrice;
                                $i++;
                            }
                        } 
                        ?>
                        
                        <div class="col-md-12 re_pad0">
                            <hr class="re_martop0">
                        </div>
                        <div class="col-md-12 re_pad0">
                            <div class="col-md-6 re_pad0">
                                <h5 class="re_martop0">Total Price</h5>
                            </div>
                            <div class="col-md-6 re_pad0">
                                <p class="re_font12" style="font-weight: bold;padding-top: 4px;font-size: 14px;">&#8369; <?php echo number_format($totalPrice,2,'.',','); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 hotel-item" style="padding-top:20px; padding-bottom:25px;">
                        <div class="col-md-12 re_pad0">
                            <h5 class="re_mar0">Need Redtag Help?</h5>
                        </div>
                        <div class="col-md-12 re_pad0">
                            <p class="re_font13" style="color:#515151;">We would be happy to help you!</p>
                        </div>
                        <div class="col-md-12 re_pad0">
                            <span class="glyphicon glyphicon-earphone"></span>
                            <a href="tel:(63) (02) 8012620, +639253115987">(63) (02) 8012620 / +639253115987</a>
                        </div>
                    </div>

                </div>
                <?php } ?>
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