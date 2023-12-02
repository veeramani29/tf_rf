<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Anand Ayyasamy">
    <title><?php echo Site_Title; ?></title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets_/plugins/font-awesome-4.3.0/css/font-awesome.min.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets_/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Anand Style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets_/css/anand-style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets_/css/jquery-ui.css">


     <link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen" />
<!-- bin/jquery.slider.min.css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets_/plugins/jslider/css/jslider.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets_/plugins/jslider/css/jslider.round.css" type="text/css">   

</head>

<body class="thebg">
    <header>
        <nav class="navbar navbar-default  <?php  if($this->router->fetch_method()=='login' || $this->router->fetch_method()=='searchengine'){ echo "navbar-fixed-top"; } ?>">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <!-- Collect the nav links, forms, and other content for toggling -->


                <?php if((isset($_SESSION['agent']) && $_SESSION['agent']['logged_in'] === '1') && $this->router->fetch_class()=='home'){ ?>
                <div class="collapse navbar-collapse" id="topMenu">
                    <ul class="nav navbar-nav">
                     <?php 
                if(isset($_SESSION['agent']) && $_SESSION['agent']['logged_in'] === '1'){
                    if($_SESSION['agent']['companyName'] != ''){ $showName = $_SESSION['agent']['companyName']; } else { $showName = $_SESSION['agent']['agentName']; }

            ?>
            <!-- <li style="color:#555;font-weight:bold;">Welcome, &nbsp;<?php echo $showName; ?></li>-->
            <?php } ?>
                        <li><a href="#">Promotions </a>
                        </li>
                        <li><a href="<?php echo site_url('home/dashboard'); ?>">Control Panel </a>
                        </li>
                        <li><a href="#">Manage Booking </a>
                        </li>
                        <li><a href="#">Deposit Update </a>
                        </li>
                        <li><a href="#">Email Us</a></li>
                        <li><a href="#">Booking Status</a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-comments-o"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-bell"></i></a></li>
                        <li class="agentName"><a href="javascript:void(0)"><?php echo(isset($_SESSION['agent']['userNo'])?$_SESSION['agent']['userNo']:'--------'); ?> <br>
                        PHP <?php echo number_format($_SESSION['agent']['depositBalance']); ?></a></li>
                        <li><a href="#"><i class="fa fa-eye"></i>&nbsp; My View</a></li>
                    </ul>
                </div>
                  <?php } ?>
                <!-- /.navbar-collapse -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainMenu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo site_url(); ?>"><img src="<?php echo base_url(); ?>assets_/images/Redtag-logo-uni.png" alt="">
                    </a>
                </div>


                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="mainMenu">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><i class="fa fa-plane"></i>&nbsp; Flight </a>
                        </li>
                        <li><a href="#"><i class="fa fa-bed"></i>&nbsp; Hotel </a>
                        </li>
                        <li><a href="#"><i class="fa fa-road"></i>&nbsp; Holiday </a>
                        </li>
                        <li><a href="http://redtagtravels.com/visalanding/" target="__blank"><i class="fa fa-ticket"></i>&nbsp; Visa </a>
                        </li>
                       <!--  <li class="hasSubMenu"><a href="#">Bills &nbsp;<i class="fa fa-angle-double-down"></i></a>
                            <ul>
                                <li><a href="">Accounts</a></li>
                                <li><a href="">Marketing Tab</a></li>
                                <li><a href="">User Tab</a></li>
                            </ul>
                        </li> -->
 <?php if((isset($_SESSION['agent']) && $_SESSION['agent']['logged_in'] === '1')){ ?>
                         <li><a href="<?php echo site_url('home/logout'); ?>"><i class="fa fa-sign-out"></i>&nbsp; Logout </a>
                           </li>
                           <?php } ?>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>