<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo Site_Title; ?></title>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:700,600,400italic,400,300" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Oswald:400" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/lib/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/lib/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/lib/awe-booking-font.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/lib/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/lib/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/revslider-demo/css/settings.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/demo.css">
    <link id="colorreplace" rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/colors/light-blue.css">
    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->    
    <style type='text/css'>
        
        body{
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        }
    </style>
</head>
<!--[if IE 7]><body class="ie7 lt-ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 8]><body class="ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 9]><body class="ie9 lt-ie10"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->

<body>
    <!--<![endif]-->
	<section class="top-section" style="padding: 8px 0 8px 0;">			
    <div class="container">
        <div class="row">
                                <div class="col-md-6" id="top-divsection">					   
                                   <span>Welcome To RKL Travel. Your Travel Expert Provider</span>		
            </div>
            <div class="col-md-6">                        
                                        <ul id="top-text">						 
                                            <li><span><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;(+63 ) 2  917-8182</span></li>
                                                <li><span>&#124;</span></li>
                                                <li><span><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;support@rkltravel.com</span></li>							
                                        </ul>						
            </div>                    
        </div>
    </div>
</section>	
<div id="page-wrap">		
        <div class="preloader"></div>
		
    
        <header id="header-page">
            <div class="header-page__inner">				
                <div class="container">
                    <div class="logo">
                        <a href="<?php echo site_url(); ?>/home">
                            <?php 
                                if(isset($_SESSION['agent']['user_logo']) && $_SESSION['agent']['user_logo'] != ''){
                            ?>
                                <img src="<?php echo base_url(); ?>upload/<?php echo $_SESSION['agent']['user_logo']; ?>" style="width:130px;height:80px;" alt="RKL Travel"> 
                            <?php
                                }else{
                            ?>
                                <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="RKL Travel"> 
                            <?php
                                }
                            ?>
                            
                        </a>
                    </div>
                    
                    <?php 
                        if(!isset($_SESSION['user']))
                        {
                    ?>
                    <div class="agent-login">  
                        <div>Agent</div>                     			
                        <ul class="top-menus">
                           <?php
                                if(isset($_SESSION['agent']['logged_in']) && $_SESSION['agent']['logged_in'] == '1')
                                {
                                    $emailid = explode('@',$_SESSION['agent']['email']);
                            ?>
                                    <li><a>Hello , <?php echo $emailid[0]; ?></a></li>
                                    <li><a>|</a></li>
                                    <li><a href="<?php echo site_url(); ?>/agent/logout" style="cursor:pointer;">Log Out</a></li>
                            <?php 
                                }
                                else
                                {
                            ?>
                                    <li><a href="<?php echo site_url(); ?>/agent/login" style="cursor:pointer;">Login</a></li>
                                    <li><a href="#">|</a></li>
                                    <li><a href="<?php echo site_url(); ?>/agent/registration" style="cursor:pointer;">Register</a></li> 
                            <?php 
                                }
                            ?>   
                        </ul>
                    </div>
                    <?php 
                        if(isset($_SESSION['agent']['logged_in']) && $_SESSION['agent']['logged_in'] == '1'){
                    ?>
                    <div id="login-divsection">
                    <div>Deposit Balance</div>
                   	<ul class="top-menus">	
                            <?php 
                                $agentDeposit = $this->Agent_Model->getAgentDepositBalance($_SESSION['agent']['user_id']);
                            ?>
                            <li><a>PHP <?php echo number_format($agentDeposit); ?></a></li>
                        </ul>
                    </div>	
                    <?php
                        }
                    }
                    ?>
                   				
					 
                    <nav class="navigation awe-navigation" data-responsive="1200">
                        <ul class="menu-list">
                            <li><a href="<?php echo site_url(); ?>/agent/myaccount">My Account</a> </li> 
                            <li><a href="#">My Scratchpad</a></li>                            
                            <li><a href="#">My Trips</a></li> 
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Free Apps</a></li>
                        </ul>
                    </nav>
                    
                    <a class="toggle-menu-responsive" href="#">
                        <div class="hamburger"><span class="item item-1"></span> <span class="item item-2"></span> <span class="item item-3"></span></div>
                    </a>
                </div>
            </div>			
        </header>
		<section id="page-ctop-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-ctop-menu">
                            <ul class="page-chtop-list">
                                <li class="current"><a href="<?php echo site_url(); ?>/agent/home">Home</a></li>
                                <li><a href="<?php echo site_url(); ?>/agent/home">Hotel</a></li>
                                <li><a href="<?php echo site_url(); ?>/agent/home">Flight</a></li>
								
								<li><a href="<?php echo site_url(); ?>/agent/home">Cars</a></li>
                                                                <li><a href="#">Holidays</a></li>
								<li><a href="#">Cruises</a></li>
								<li><a href="#">Deals</a></li>
								<li><a href="#">Luxury Packages</a></li>
								<li><a href="#">Tours</a></li>
								<li><a href="#">Transfers</a></li>
								<li><a href="#">Visa</a></li>
								<li><a href="#">Insurance</a></li>
								<li><a href="#">Other Services</a></li>
                            </ul>                           
                        </div>
                    </div>
				</div>
            </div>
        </section>
        
        <section class="blog-page">
    <div class="container" style="margin-bottom: 60px;">
      <div class="row">
        <div class="col-lg-3">
            <div class="checkout-page__sidebar">
                <ul>
                    <li><a href="#">Booking Details</a></li>
                    <li><a href="#">Customer Information</a></li>
                    <li class="current"><a href="#">Order Confirmation</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="alert alert-success">
                <strong>Confirmed!</strong> The booking is confirmed and the hotel fare is deducted from your deposit. 
            </div>
            <div style='text-align:center;font-weight: bold;color: #111111;margin-bottom: 73px;'>
                <p>Dear Agent, Thank you for booking with us. The voucher has been send in your registered email id. You can also download the voucher from your My Account's booking history section.</p>
            </div>
        </div>
        
      </div>
    </div>
  </section>
        <?php $this->load->view('footer'); ?>
    </div>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/masonry.pkgd.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/jquery.parallax-1.1.3.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/jquery.owl.carousel.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/theia-sticky-sidebar.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/scripts.js"></script>    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/revslider-demo/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/revslider-demo/js/jquery.themepunch.tools.min.js"></script>
    
</body>
</html>