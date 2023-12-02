 <!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width" />
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Index</title>
   
    <!-- CSS -->
     <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/base.css" rel="stylesheet">
    
    <!-- SPECIFIC CSS -->
    <link href="<?php echo base_url(); ?>assets/css/skins/square/grey.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/date_time_picker.css" rel="stylesheet">
        
  
        
</head>
<body>



    <div id="preloader">
        <div class="sk-spinner sk-spinner-wave">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>
    </div>
    <!-- End Preload -->

    <div class="layer"></div>
    <!-- Mobile menu overlay mask -->

     <!-- Header================================================== -->
    <header>
        <div id="top_line">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6"><i class="icon-phone"></i><strong>0023 445551</strong></div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <ul id="top_links">
                            <li>
                                <div class="dropdown dropdown-access">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="access_link">Sign in</a>
                                    <div class="dropdown-menu">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <a href="#" class="bt_facebook">
                                                    <i class="icon-facebook"></i>Facebook </a>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <a href="#" class="bt_paypal">
                                                    <i class="icon-paypal"></i>Paypal </a>
                                            </div>
                                        </div>
                                        <div class="login-or">
                                            <hr class="hr-or">
                                            <span class="span-or">or</span>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="inputUsernameEmail" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                                        </div>
                                        <a id="forgot_pw" href="#">Forgot password?</a>
                                        <input type="submit" name="Sign_in" value="Sign in" id="Sign_in" class="button_drop">
                                        <input type="button" onclick="window.location.href='<?php echo site_url('/home/register');?>'" name="Sign_up" value="Sign up" id="Sign_up" class="button_drop outline">
                                    </div>
                                </div><!-- End Dropdown access -->
                            </li>
                            <li><a href="wishlist.html" id="wishlist_link">Wishlist</a></li>
                        </ul>
                    </div>
                </div><!-- End row -->
            </div><!-- End container-->
        </div><!-- End top line-->
        
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <div id="logo_home">
                        <p><a href="<?php echo base_url(); ?>" > Sign Up</a></p>
                    </div>
                </div>
                <nav class="col-md-9 col-sm-9 col-xs-9">
                    <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                    <div class="main-menu">
                        <div id="header_menu">
                            <img src="<?php echo base_url(); ?>assets/img/logo_sticky.png" width="160" height="34" alt="City tours" data-retina="true">
                        </div>
                        <a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
                        <ul>
                            <li class="submenu">
                                <a href="<?php echo base_url(); ?>" class="show-submenu">Home </a>
                                
                            </li>
                            <li class="submenu">
                                <a href="<?php echo base_url(); ?>" class="show-submenu">Flights </a>
                                
                            </li>
                            
                             <li class="submenu">
                                <a href="<?php echo base_url(); ?>" class="show-submenu">Hotels</a>
                                   
                            </li>
                           <li class="submenu">
                                <a href="javascript:void(0);" class="show-submenu">Packages</a>
                                
                            </li>
                            
                        </ul>
                    </div><!-- End main-menu -->
                    <ul id="top_tools">
                        <li>
                            <div class="dropdown dropdown-search">
                                <a href="#" class="search-overlay-menu-btn" data-toggle="dropdown"><i class="icon-search"></i></a>
                            </div>
                        </li>
                        
                    </ul>
                </nav>
            </div>
        </div><!-- container -->
    </header><!-- End Header -->
    
    <section id="search_container">
        <div id="search">
            <ul class="nav nav-tabs">
             <li class="active"><a href="#signup" data-toggle="tab">Agent Signup</a></li>
                </ul>

            <div class="tab-content">
                               
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
                <div class="tab-pane active" id="signup">
                <form name="hotel_frm" method="POST" >
                    
                   
            
                    <h3>Agent Sign Up</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" name="agent_name" required="" id="agent_name" class="form-control">
                              
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="agent_email" id="agent_email">
                            </div>
                        </div>
                    </div>
                    <!-- End row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Travel Agency Name</label>
                               <input type="text" class="form-control" name="company_name" id="company_name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>City</label>
                               <input type="text" class="form-control" name="agent_city" id="agent_city">
                            </div>
                        </div>
                       

                    </div>
                    <!-- End row -->

                     <!-- End row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Locations</label>
                                <input class="form-control" name="agent_country" id="agent_country"  type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone Number <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="phone_no" id="phone_no" maxlength="10" >
                            </div>
                        </div>
                       

                    </div>
                    <!-- End row -->


                      <!-- End row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Comments</label>
                                <textarea rows="4" class="form-control" name="agent_comments" id="agent_comments"></textarea>
                                
                            </div>
                        </div>
                       
                       

                    </div>
                    <!-- End row -->
<div class="checkbox" style="padding-left: 24%; padding-top:5px;">
                        <label>
                          <input type="checkbox"> I Accept Redtag Travels <a href="#">terms and Conditions</a>
                        </label>
                      </div>
                    <hr>
                    <button class="btn_1 green"><i class="icon-user"></i>Register</button>
                        </form>
                </div>
                <!-- End rab -->
            </div>
        </div>
    </section>
    <!-- End hero -->

    <main>
        <div class="container margin_60">

            <div class="main_title">
                <h2>bangladesh <span>Top</span> Tours</h2>
                <p>Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.</p>
            </div>

            <div class="row">

                <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.1s">
                    <div class="ribbon_3 popular"><span>Popular</span></div>
                    <div class="tour_container">
                        <div class="img_container">
                            <a href="single_tour.html">
                                <img src="<?php echo base_url(); ?>assets/img/tour_box_1.jpg" class="img-responsive" alt="Image">
                                <div class="short_info">
                                    <i class="icon_set_1_icon-44"></i>Historic Buildings<span class="price"><sup>$</sup>39</span>
                                </div>
                            </a>
                        </div>
                        <div class="tour_title">
                            <h3><strong>Arc Triomphe</strong> tour</h3>
                            <div class="rating">
                                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(75)</small>
                            </div>
                            <!-- end rating -->
                            <div class="wishlist">
                                <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                            </div>
                            <!-- End wish list-->
                        </div>
                    </div>
                    <!-- End box tour -->
                </div>
                <!-- End col-md-4 -->

                <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                    <div class="tour_container">
                        <div class="ribbon_3 popular"><span>Popular</span></div>
                        <div class="img_container">
                            <a href="single_tour.html">
                                <img src="<?php echo base_url(); ?>assets/img/tour_box_2.jpg" width="800" height="533" class="img-responsive" alt="Image">
                                <div class="badge_save">Save<strong>30%</strong></div>
                                <div class="short_info">
                                    <i class="icon_set_1_icon-43"></i>Churches<span class="price"><sup>$</sup>45</span>
                                </div>
                            </a>
                        </div>
                        <div class="tour_title">
                            <h3><strong>Notredame</strong> tour</h3>
                            <div class="rating">
                                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(75)</small>
                            </div>
                            <!-- end rating -->
                            <div class="wishlist">
                                <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                            </div>
                            <!-- End wish list-->
                        </div>
                    </div>
                    <!-- End box tour -->
                </div>
                <!-- End col-md-4 -->

                <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.3s">
                    <div class="tour_container">
                        <div class="ribbon_3 popular"><span>Popular</span></div>
                        <div class="img_container">
                            <a href="single_tour.html">
                                <img src="<?php echo base_url(); ?>assets/img/tour_box_3.jpg" width="800" height="533" class="img-responsive" alt="Image">
                                <div class="badge_save">Save<strong>30%</strong></div>
                                <div class="short_info">
                                    <i class="icon_set_1_icon-44"></i>Historic Buildings<span class="price"><sup>$</sup>48</span>
                                </div>
                            </a>
                        </div>
                        <div class="tour_title">
                            <h3><strong>Versailles</strong> tour</h3>
                            <div class="rating">
                                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(75)</small>
                            </div>
                            <!-- end rating -->
                            <div class="wishlist">
                                <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                            </div>
                            <!-- End wish list-->
                        </div>
                    </div>
                    <!-- End box tour -->
                </div>
                <!-- End col-md-4 -->

                <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.4s">
                    <div class="tour_container">
                        <div class="ribbon_3 popular"><span>Popular</span></div>
                        <div class="img_container">
                            <a href="single_tour.html">
                                <img src="<?php echo base_url(); ?>assets/img/tour_box_4.jpg" width="800" height="533" class="img-responsive" alt="Image">
                                <div class="short_info">
                                    <i class="icon_set_1_icon-30"></i>Walking tour<span class="price"><sup>$</sup>36</span>
                                </div>
                            </a>
                        </div>
                        <div class="tour_title">
                            <h3><strong>Pompidue</strong> tour</h3>
                            <div class="rating">
                                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(75)</small>
                            </div>
                            <!-- end rating -->
                            <div class="wishlist">
                                <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                            </div>
                            <!-- End wish list-->
                        </div>
                    </div>
                    <!-- End box tour -->
                </div>
                <!-- End col-md-4 -->

                <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.5s">
                    <div class="tour_container">
                        <div class="ribbon_3"><span>Top rated</span></div>
                        <div class="img_container">
                            <a href="single_tour.html">
                                <img src="<?php echo base_url(); ?>assets/img/tour_box_14.jpg" width="800" height="533" class="img-responsive" alt="Image">
                                <div class="short_info">
                                    <i class="icon_set_1_icon-28"></i>Skyline tours<span class="price"><sup>$</sup>42</span>
                                </div>
                            </a>
                        </div>
                        <div class="tour_title">
                            <h3><strong>Tour Eiffel</strong> tour</h3>
                            <div class="rating">
                                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(75)</small>
                            </div>
                            <!-- end rating -->
                            <div class="wishlist">
                                <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                            </div>
                            <!-- End wish list-->
                        </div>
                    </div>
                    <!-- End box tour -->
                </div>
                <!-- End col-md-4 -->

                <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.6s">
                    <div class="tour_container">
                        <div class="ribbon_3"><span>Top rated</span></div>
                        <div class="img_container">
                            <a href="single_tour.html">
                                <img src="<?php echo base_url(); ?>assets/img/tour_box_5.jpg" width="800" height="533" class="img-responsive" alt="Image">
                                <div class="short_info">
                                    <i class="icon_set_1_icon-44"></i>Historic Buildings<span class="price"><sup>$</sup>40</span>
                                </div>
                            </a>
                        </div>
                        <div class="tour_title">
                            <h3><strong>Pantheon</strong> tour</h3>
                            <div class="rating">
                                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(75)</small>
                            </div>
                            <!-- end rating -->
                            <div class="wishlist">
                                <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                            </div>
                            <!-- End wish list-->
                        </div>
                    </div>
                    <!-- End box tour -->
                </div>
                <!-- End col-md-4 -->

                <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.7s">
                    <div class="tour_container">
                        <div class="ribbon_3"><span>Top rated</span></div>
                        <div class="img_container">
                            <a href="single_tour.html">
                                <img src="<?php echo base_url(); ?>assets/img/tour_box_8.jpg" width="800" height="533" class="img-responsive" alt="Image">
                                <div class="short_info">
                                    <i class="icon_set_1_icon-3"></i>City sightseeing<span class="price"><sup>$</sup>35</span>
                                </div>
                            </a>
                        </div>
                        <div class="tour_title">
                            <h3><strong>Open Bus</strong> tour</h3>
                            <div class="rating">
                                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(75)</small>
                            </div>
                            <!-- end rating -->
                            <div class="wishlist">
                                <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                            </div>
                            <!-- End wish list-->
                        </div>
                    </div>
                    <!-- End box tour -->
                </div>
                <!-- End col-md-4 -->

                <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.8s">
                    <div class="tour_container">
                        <div class="ribbon_3"><span>Top rated</span></div>
                        <div class="img_container">
                            <a href="single_tour.html">
                                <img src="<?php echo base_url(); ?>assets/img/tour_box_9.jpg" width="800" height="533" class="img-responsive" alt="Image">
                                <div class="short_info">
                                    <i class="icon_set_1_icon-4"></i>Museums<span class="price"><sup>$</sup>38</span>
                                </div>
                            </a>
                        </div>
                        <div class="tour_title">
                            <h3><strong>Louvre museum</strong> tour</h3>
                            <div class="rating">
                                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(75)</small>
                            </div>
                            <!-- end rating -->
                            <div class="wishlist">
                                <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                            </div>
                            <!-- End wish list-->
                        </div>
                    </div>
                    <!-- End box tour -->
                </div>
                <!-- End col-md-4 -->

                <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.9s">
                    <div class="tour_container">
                        <div class="ribbon_3"><span>Top rated</span></div>
                        <div class="img_container">
                            <a href="single_tour.html">
                                <img src="<?php echo base_url(); ?>assets/img/tour_box_12.jpg" width="800" height="533" class="img-responsive" alt="Image">
                                <div class="short_info">
                                    <i class="icon_set_1_icon-14"></i>Eat &amp; drink<span class="price"><sup>$</sup>25</span>
                                </div>
                            </a>
                        </div>
                        <div class="tour_title">
                            <h3><strong>Boulangerie</strong> tour</h3>
                            <div class="rating">
                                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(75)</small>
                            </div>
                            <!-- end rating -->
                            <div class="wishlist">
                                <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                            </div>
                            <!-- End wish list-->
                        </div>
                    </div>
                    <!-- End box tour -->
                </div>
                <!-- End col-md-4 -->

            </div>
            <!-- End row -->
            <p class="text-center nopadding">
                <a href="#" class="btn_1 medium"><i class="icon-eye-7"></i>View all tours (144) </a>
            </p>
        </div>
        <!-- End container -->

        <div class="white_bg">
            <div class="container margin_60">
                <div class="main_title">
                    <h2>Other <span>Popular</span> tours</h2>
                    <p>
                        Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.
                    </p>
                </div>
                <div class="row add_bottom_45">
                    <div class="col-md-4 other_tours">
                        <ul>
                            <li><a href="#"><i class="icon_set_1_icon-3"></i>Tour Eiffel<span class="other_tours_price">$42</span></a>
                            </li>
                            <li><a href="#"><i class="icon_set_1_icon-30"></i>Shopping tour<span class="other_tours_price">$35</span></a>
                            </li>
                            <li><a href="#"><i class="icon_set_1_icon-44"></i>Versailles tour<span class="other_tours_price">$20</span></a>
                            </li>
                            <li><a href="#"><i class="icon_set_1_icon-3"></i>Montparnasse skyline<span class="other_tours_price">$26</span></a>
                            </li>
                            <li><a href="#"><i class="icon_set_1_icon-44"></i>Pompidue<span class="other_tours_price">$26</span></a>
                            </li>
                            <li><a href="#"><i class="icon_set_1_icon-3"></i>Senna River tour<span class="other_tours_price">$32</span></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 other_tours">
                        <ul>
                            <li><a href="#"><i class="icon_set_1_icon-1"></i>Notredame<span class="other_tours_price">$48</span></a>
                            </li>
                            <li><a href="#"><i class="icon_set_1_icon-4"></i>Lafaiette<span class="other_tours_price">$55</span></a>
                            </li>
                            <li><a href="#"><i class="icon_set_1_icon-30"></i>Trocadero<span class="other_tours_price">$76</span></a>
                            </li>
                            <li><a href="#"><i class="icon_set_1_icon-3"></i>Open Bus tour<span class="other_tours_price">$55</span></a>
                            </li>
                            <li><a href="#"><i class="icon_set_1_icon-30"></i>Louvre museum<span class="other_tours_price">$24</span></a>
                            </li>
                            <li><a href="#"><i class="icon_set_1_icon-3"></i>Madlene Cathedral<span class="other_tours_price">$24</span></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 other_tours">
                        <ul>
                            <li><a href="#"><i class="icon_set_1_icon-37"></i>Montparnasse<span class="other_tours_price">$36</span></a>
                            </li>
                            <li><a href="#"><i class="icon_set_1_icon-1"></i>D'Orsey museum<span class="other_tours_price">$28</span></a>
                            </li>
                            <li><a href="#"><i class="icon_set_1_icon-50"></i>Gioconda Louvre musuem<span class="other_tours_price">$44</span></a>
                            </li>
                            <li><a href="#"><i class="icon_set_1_icon-44"></i>Tour Eiffel<span class="other_tours_price">$56</span></a>
                            </li>
                            <li><a href="#"><i class="icon_set_1_icon-50"></i>Ladefanse<span class="other_tours_price">$16</span></a>
                            </li>
                            <li><a href="#"><i class="icon_set_1_icon-44"></i>Notredame<span class="other_tours_price">$26</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- End row -->

                <div class="banner colored add_bottom_30">
                    <h4>Discover our Top tours <span>from $34</span></h4>
                    <p>
                        Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in.
                    </p>
                    <a href="single_tour.html" class="btn_1 white">Read more</a>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 text-center">
                        <p>
                            <a href="#"><img src="<?php echo base_url(); ?>assets/img/bus.jpg" alt="Pic" class="img-responsive im_gu"></a>
                        </p>
                        <h4><span>Flight</span> booking</h4>
                        <p>
                            Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex.
                        </p>
                    </div>
                    <div class="col-md-4 col-sm-6 text-center">
                        <p>
                            <a href="#"><img src="<?php echo base_url(); ?>assets/img/transfer.jpg" alt="Pic" class="img-responsive im_gu"></a>
                        </p>
                        <h4><span>Hotel</span> booking</h4>
                        <p>
                            Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex.
                        </p>
                    </div>
                    <div class="col-md-4 col-sm-6 text-center">
                        <p>
                            <a href="#"><img src="<?php echo base_url(); ?>assets/img/guide.jpg" alt="Pic" class="img-responsive im_gu"></a>
                        </p>
                        <h4><span>Packages</span> booking</h4>
                        <p>
                            Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex.
                        </p>
                    </div>
                    
                </div>
                <!-- End row -->
            </div>
            <!-- End container -->
        </div>
        <!-- End white_bg -->


        <div class="container margin_60">

            <div class="main_title">
                <h2>Some <span>good</span> reasons</h2>
                <p>
                    Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.
                </p>
            </div>

            <div class="row">

                <div class="col-md-4 wow zoomIn" data-wow-delay="0.2s">
                    <div class="feature_home">
                        <i class="icon_set_1_icon-41"></i>
                        <h3><span>+120</span> Premium tours</h3>
                        <p>
                            Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset.
                        </p>
                        <a href="about.html" class="btn_1 outline">Read more</a>
                    </div>
                </div>

                <div class="col-md-4 wow zoomIn" data-wow-delay="0.4s">
                    <div class="feature_home">
                        <i class="icon_set_1_icon-30"></i>
                        <h3><span>+1000</span> Customers</h3>
                        <p>
                            Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset.
                        </p>
                        <a href="about.html" class="btn_1 outline">Read more</a>
                    </div>
                </div>

                <div class="col-md-4 wow zoomIn" data-wow-delay="0.6s">
                    <div class="feature_home">
                        <i class="icon_set_1_icon-57"></i>
                        <h3><span>H24 </span> Support</h3>
                        <p>
                            Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset.
                        </p>
                        <a href="about.html" class="btn_1 outline">Read more</a>
                    </div>
                </div>

            </div>
            <!--End row -->

            

        </div>
        <!-- End container -->
    </main>
    <!-- End main -->
    
    <footer class="revealed">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-3">
                    <h3>Need help?</h3>
                    <a href="#" id="phone">+0023 445551</a>
                    <a href="#" id="email_footer">Piano@gmail.com</a>
                </div>
                <div class="col-md-3 col-sm-3">
                    <h3>About</h3>
                    <ul>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Login</a></li>
                        <li><a href="#">Register</a></li>
                         <li><a href="#">Terms and condition</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-3">
                    <h3>Discover</h3>
                    <ul>
                        <li><a href="#">Community blog</a></li>
                        <li><a href="#">Tour guide</a></li>
                        <li><a href="#">Wishlist</a></li>
                         <li><a href="#">Gallery</a></li>
                    </ul>
                </div>
                <div class="col-md-2 col-sm-3">
                    <h3>Settings</h3>
                    <div class="styled-select">
                        <select class="form-control" name="lang" id="lang">
                            <option value="English" selected>English</option>
                            <option value="French">French</option>
                            <option value="Spanish">Spanish</option>
                            <option value="Russian">Russian</option>
                        </select>
                    </div>
                    <div class="styled-select">
                        <select class="form-control" name="currency" id="currency">
                            <option value="USD" selected>USD</option>
                            <option value="EUR">EUR</option>
                            <option value="GBP">GBP</option>
                            <option value="RUB">RUB</option>
                        </select>
                    </div>
                </div>
            </div><!-- End row -->
            <div class="row">
                <div class="col-md-12">
                    <div id="social_footer">
                        <ul>
                            <li><a href="#"><i class="icon-facebook"></i></a></li>
                            <li><a href="#"><i class="icon-twitter"></i></a></li>
                            <li><a href="#"><i class="icon-google"></i></a></li>
                            <li><a href="#"><i class="icon-instagram"></i></a></li>
                            <li><a href="#"><i class="icon-pinterest"></i></a></li>
                            <li><a href="#"><i class="icon-vimeo"></i></a></li>
                            <li><a href="#"><i class="icon-youtube-play"></i></a></li>
                            <li><a href="#"><i class="icon-linkedin"></i></a></li>
                        </ul>
                        <p>© AJT Software labs</p>
                    </div>
                </div>
            </div><!-- End row -->
        </div><!-- End container -->
    </footer><!-- End footer -->

    <div id="toTop"></div><!-- Back to top button -->
    
    <!-- Search Menu -->
    <div class="search-overlay-menu">
        <span class="search-overlay-close"><i class="icon_set_1_icon-77"></i></span>
        <form role="search" id="searchform" method="get">
            <input value="" name="q" type="search" placeholder="Search..." />
            <button type="submit"><i class="icon_set_1_icon-78"></i>
            </button>
        </form>
    </div><!-- End Search Menu -->

 <!-- Common scripts -->
<script src="<?php echo base_url(); ?>assets/js/jquery-2.2.4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/common_scripts_min.js"></script>
 <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
<script src="<?php echo base_url(); ?>assets/js/functions.js"></script>

 <!-- Specific scripts -->
<script src="<?php echo base_url(); ?>assets/js/icheck.js"></script>
<script>
$('input').iCheck({
   checkboxClass: 'icheckbox_square-grey',
   radioClass: 'iradio_square-grey'
 });
 </script>
 <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/bootstrap-timepicker.js"></script>
 <script>
  $('input.date-pick').datepicker('setDate', 'today');
  $('input.time-pick').timepicker({
    minuteStep: 15,
    showInpunts: false
})
  </script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.ddslick.js"></script>
   <script>
   $("select.ddslick").each(function(){
            $(this).ddslick({
                showSelectedHTML: true 
            });
        });
        </script>
  </body>
</html>