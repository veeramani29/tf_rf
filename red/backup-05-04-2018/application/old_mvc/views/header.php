<!--########################### HEADER STARTS HERE ###############################################################--->
<style>
	.pad_top{padding:30px 0px 0px 0px;}
</style>

<div class="full-width top-header" id="redtop" style="padding-top:0px;">
   
    <div class="container">
    <div class="col-md-3">
    <div class="navbar-header">
        <a href="<?php echo base_url(); ?>/home"><img src="<?php echo base_url(); ?>assets/images/logo.png" height="150px;" width="250px;"  style="padding-bottom: 10px; margin-top: 0px;" class="img-responsive"></img></a>
    </div>
    </div>
    <div class="col-md-9 pad_top">
    	 <ul class="pull-right">
            <li>
                <span class="glyphicon glyphicon-envelope"></span>&nbsp;
                ask@redtagtravels.com
            </li>
            <li style="padding-right: 14px;">
                <span class="glyphicon glyphicon-earphone"></span>&nbsp;
                <a href="tel:(63) (02) 8012620, +639253115987">(63) (02) 8012620 / +639253115987</a>
            </li>
            <?php 
                if(isset($_SESSION['agent']) && $_SESSION['agent']['logged_in'] === '1'){
                    if($_SESSION['agent']['companyName'] != ''){ $showName = $_SESSION['agent']['companyName']; } else { $showName = $_SESSION['agent']['agentName']; }

            ?>
            <li style="padding-right:5px;color:#555;font-weight:bold;">Welcome, &nbsp;<?php echo $showName; ?></li>
            <li>|</li>
            <li style="padding-right: 14px;"><a href="<?php echo site_url(); ?>/home/logout" style="cursor:pointer;text-decoration:none;padding-left:5px;padding-right:5px;font-weight:bold;">Log Out</a></li>
            <?php
                } else {
            ?>
                <li><a href="<?php echo site_url(); ?>/home/login" style="cursor:pointer;text-decoration:none;padding-left:5px;font-weight:bold;">Sign In</a></li>
                <li>|</li>
                <li style="padding-right: 14px;"><a href="<?php echo site_url(); ?>/home/register" style="cursor:pointer;text-decoration:none;padding-left:5px;padding-right:5px;font-weight:bold;">Register</a></li>
            <?php 
                }
            ?>
        </ul>
        </div>
    </div>
</div>
<nav class="navbar navbar-default" id="nav">
    <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span> 
        </button>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="<?php echo site_url(); ?>/home/login">Home</a></li>
                <?php if(isset($_SESSION['agent']) && $_SESSION['agent']['logged_in'] === '1'){ ?>
                <li><a href="<?php echo site_url(); ?>/home/searchengine">Flights</a></li>
                <li><a href="<?php echo site_url(); ?>/home/searchengine">Hotels</a></li>
                <li><a href="<?php echo site_url(); ?>/home/dashboard">Control Panel</a></li>
                <?php } ?>
                <?php if(!isset($_SESSION['agent'])){ ?>
                <li><a href="<?php echo site_url(); ?>/home/login">Packages</a></li>
                <li><a href="<?php echo site_url(); ?>/home/services">Services</a></li>
                <li><a href="<?php echo site_url(); ?>/home/aboutus">About Us</a></li>
                <?php } ?>
                <li><a href="<?php echo site_url(); ?>/home/contactus">Contact Us</a></li>
                <?php if(!isset($_SESSION['agent'])){ ?>
                <li><a href="<?php echo site_url(); ?>/home/register">JOIN NOW!</a></li>
                <?php } ?>
            </ul>
            <?php
                if(isset($_SESSION['agent']) && $_SESSION['agent']['logged_in'] === '1'){
            ?>
            <ul class="nav navbar-nav" style="float:right;margin-top: 15px;">
                <li style="color:#ffffff;padding-right:20px;">Account Id : <?php echo(isset($_SESSION['agent']['userNo'])?$_SESSION['agent']['userNo']:'--------'); ?></li>
                <li style="color:#ffffff;">Deposit Balance : PHP <?php echo number_format($_SESSION['agent']['depositBalance']); ?></li>
            </ul>
            <?php 
                }
            ?>
        </div>
    </div>
</nav>
<!--############################ HEADER ENDS HERE ##############################################################--->
