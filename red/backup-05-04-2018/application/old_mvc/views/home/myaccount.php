<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo Site_Title; ?></title>
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta name="keywords" content="Account Details" />
        <meta name="description" content="Account Details">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- GOOGLE FONTS -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600' rel='stylesheet' type='text/css'>
        <!-- /GOOGLE FONTS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/flaticon.css" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-linearicons.css" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/swipebox.min.css" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/travel-setting.css" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bundle-style.css" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/landing-style.css" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style1.css" type="text/css" media="all">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/icomoon.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/my-acc-styles.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/mystyles.css">

        <style type="text/css">
            input[type=email], input[type=password], input[type=text] , input[type=file]{
                margin-bottom:0px;
            }
            
            button, input[type="button"], input[type="reset"], input[type="submit"] {
                background: rgb(38, 106, 165) none repeat scroll 0 0;
                color: #ffffff;
            }
        </style>
    </head>

    <body class="transparent_home_page">

        <div class="global-wrap wrapper-container">
            <header class="header-bg-color">
                <div class="container">
                    <div class="headLeft">
                        <div class="clearfix">

                            <div class="logo">
                                <a class="home" href="index.html" data-tracker="HEADER_LOGO">
                                </a>
                            </div>

                            <!-- top nav starts here -->
                            <ul class="topMenu">
                                <li class="dp-opt tDeals"><a href="javascript:void(0)">Deals<span class="dCount">2</span></a>
                                    <div class="dropdown dDropdown">
                                        <div class="dInfo">Youve received <span>2</span> new deals</div>
                                        <ul class="tDealsList">
                                            <li><a href="#">10% off on using Coupon code ALH10</a></li>
                                            <li><a href="#">Attend Saudi super cup & get Free tickets</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="myTrip"> <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal"><span class="flaticon-male80"></span> Sign-in / Register</a> </li>

                                <li class="myTrip"> <a href="javascript:void(0);"><span class="flaticon-list50"></span> My Bookings</a> </li>

                                <li class="dp-opt country" style="display:">

                                    <a href="javascript:void(0)"><i class="flaticon-earth38"></i> <span>Global
                                        </span></a>
                                </li>
                                <li class="currency dp-opt" style="display:">
                                    <a href="#"> <span class="currency-icon"></span> <span class="curChange">SAR - Saudi Riyal</span> </a>
                                </li>
                                <li class="nav-outer">
                                    <div class="supportCont"><a href="tel:8903158391" class="selText">8903158391</a></div>
                                </li>
                            </ul>

                            <!-- top nav ends here -->
                        </div>

                        <!-- main nav starts here -->
                        <div class="nav-outer clearfix">
                            <ul class="navLinks">
                                <li class="tnlHome"> <a href="index.html" data-tracker="HOME">Home </a></li>
                                <li class="tnlFlight"><a href="#" data-tracker="FLIGHTS_HOME">Flights </a></li>
                                <li class="tnlHotel"><a href="#" data-tracker="HOTELS_HOME">Hotels</a></li>
                                <li class="tnlFPH"><a href="#" data-tracker="PACKAGES_HOME">Packages</a></li>
                                <!--<li class="tnlCars"><a href="/en/cars" data-tracker="CARS_HOME">Cars</a></li> -->
                            </ul>

                        </div>
                        <!-- main nav ends here -->
                    </div>

                </div>
            </header>


            <div class="container" style="width:100%">
                <div class="row">
                    <h1 class="page-title" style="font-size: 23px;">Account Settings</h1>
                </div>
            </div>


            <div class="container" style="width:100%">
                <div class="row">    
                    <div class="col-md-3" style="width:23%">
                        <aside class="user-profile-sidebar" style="margin-right: 22px;">
                            <div class="user-profile-avatar text-center">
                                <?php
                                    if($user_data != '' && $user_data->user_logo != ''){
                                ?>
                                    <img src="<?php echo base_url(); ?>assets/agent_uploads/<?php echo $user_data->user_logo; ?>" alt="<?php echo $user_data->first_name; ?>" title="Profile Picture" />
                                <?php
                                    } else {
                                ?>
                                    <img src="<?php echo base_url(); ?>assets/images/profile_default.png" alt="<?php echo $user_data->first_name; ?>" title="Profile Picture" />
                                <?php
                                    }
                                ?>
                            </div>


                            <ul class=" nav nav-tabs tabs-left list user-profile-nav">
                                <li class="active" style='width: 100%;'><a href="#profile" data-toggle="tab"><i class="fa fa-user"></i>Manage Profile</a></li>
                                <li style='width: 100%;'><a href="#bookings" data-toggle="tab"><i class="fa fa-book" aria-hidden="true"></i>Manage Bookings</a></li>
                                <li style='width: 100%;'><a href="#deposits" data-toggle="tab"><i class="fa fa-camera"></i>Manage Deposits</a></li>
                                <li style='width: 100%;'><a href="#sub-agents" data-toggle="tab"><i class="fa fa-users" aria-hidden="true"></i>Manage Sub Agents</a></li>
                                <li style='width: 100%;'><a href="#markups" data-toggle="tab"><i class="fa fa-credit-card"></i>Manage Markups</a></li>
                            </ul>
                        </aside>
                    </div>
                    <div class="col-md-9">
                        <div class="">
                            <div class="tab-content">
                                <div class="tab-pane active" id="profile">
                                    <div class="">
                                        <div class="user-profile-sidebar" style="padding:0px;">
                                            <ul class=" nav nav-tabs list user-profile-nav">
                                                <li class="active" style="border-top: 0px solid #404040;"><a href="#Contact_info" data-toggle="tab"><i class="fa fa-user"></i>Contact Info</a>
                                                </li>
                                                <li><a href="#change_password" data-toggle="tab"><i class="fa fa-cog"></i>Change Password</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="Contact_info">
                                                <form name="usr_profile" id="user_profile" enctype="multipart/form-data">
                                                    <div id="user_error" style="display:none;">
                                                        <div class="alert alert-danger alert-dismissable">
                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                            <strong>Oops!</strong> Please add correct profile details.
                                                        </div>
                                                    </div>
                                                    <div id="user_success" style="display:none;">
                                                        <div class="alert alert-success alert-dismissable">
                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                            <strong>Success!</strong> Your profile has been successfully done. It will be reviewed by admin and added to your account balance within 24hrs.
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5" style="color: #111111;">

                                                            <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
                                                                <label>Agent Name:</label>
                                                                <input class="form-control" id="agent_name" name="agent_name" value="<?php echo(isset($user_data) && $user_data != ''?$user_data->first_name:''); ?>" type="text" />
                                                                <span style="color:red;font-size: 11px;" id="agent_name_error"></span>
                                                            </div>
                                                            <div class="form-group form-group-icon-left"><i class="fa fa-map-marker input-icon" aria-hidden="true"></i>
                                                                <label>Address:</label>
                                                                <input class="form-control" id="address" name="address" value="<?php echo(isset($user_data) && $user_data != ''?$user_data->address:''); ?>" type="text" />
                                                            </div>
                                                            <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                                <label>City:</label>
                                                                <input class="form-control" id="city" name="city" value="<?php echo(isset($user_data) && $user_data != ''?$user_data->city:''); ?>" type="text" />
                                                            </div>

                                                            <div class="form-group form-group-icon-left flo_left"><i class="fa fa-phone input-icon"></i>
                                                                <label>Phone Number</label>
                                                                <input class="form-control tap_inp1 flo_left" id="phone_code" name="phone_code" value="<?php echo(isset($user_data) && $user_data != ''?$user_data->phone_code:''); ?>" type="text" onkeypress="return restrictCharacters(this, event, digitsOnly);" />
                                                                <input class="form-control tap_inp2 flo_left" id="phone_no" name="phone_no" style="padding-left:9px;" value="<?php echo(isset($user_data) && $user_data != ''?$user_data->mobile_no:''); ?>" type="text" onkeypress="return restrictCharacters(this, event, digitsOnly);" />
                                                                <span style="color:red;font-size: 11px;" id="phone_no_error"></span>
                                                            </div>

                                                            <div class="gap gap-small"></div>
                                                    </div>
                                                    <div class="col-md-5" style="color: #111111;">

                                                            <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
                                                                <label>Agent Company Name:</label>
                                                                <input class="form-control" id="company_name" name="company_name" value="<?php echo(isset($user_data) && $user_data != ''?$user_data->company_name:''); ?>" type="text" />
                                                            </div>
                                                            <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                                <label>Zip Code:</label>
                                                                <input class="form-control" id="zip_code" name="zip_code" value="<?php echo(isset($user_data) && $user_data != ''?$user_data->pin_code:''); ?>" type="text" />
                                                            </div>
                                                            <div class="form-group form-group-icon-left"><i class="fa fa-globe input-icon" aria-hidden="true"></i>
                                                                <label>Country:</label>
                                                                <select name="country" id="country" name="country" class="form-control" style="padding-top: 0;padding-bottom: 0;height: 41px;">
                                                                    <option value="">select country</option>
                                                                    <?php 
                                                                        if($country_list != ''){
                                                                            foreach($country_list as $list){
                                                                    ?>
                                                                            <option value="<?php echo $list->name; ?> <?php echo(isset($user_data) && $user_data != '' && $user_data->country == $list->name?'selected="selected"':''); ?>"><?php echo $list->name; ?></option>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                                <span style="color:red;font-size: 11px;" id="country_error"></span>
                                                            </div>
                                                            <div class="form-group form-group-icon-left"><i class="fa fa-upload input-icon" aria-hidden="true"></i>

                                                                <label>Agent Logo:</label>
                                                                <input class="form-control pad_0" id="new_image" name="new_image"  type="file" />
                                                                <input type="hidden" name="old_image" id="old_image" value="<?php echo(isset($user_data) && $user_data != ''?$user_data->user_logo:''); ?>">
                                                             </div>
                                                            <div class="gap gap-small"></div>

                                                    </div>
                                                    <div class="col-md-10">
                                                        <hr>
                                                        <div class="custom-search" style="margin-bottom: 35px;text-align:center;">
                                                            <input type="button" name="" value="Update Profile" id="submit_user_profile" onclick="return checkUpdateUserData();" class="btn" style="color:#ffffff;">
                                                            <span id="loding_user_submit" style="display:none;">
                                                                <img src="<?php echo base_url(); ?>assets/images/login_loder.gif" style="width: 30px;">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="change_password">
                                                <form name="change_pass" id="change_pass">
                                                 <div id="user_error" style="display:none;">
                                                    <div class="alert alert-danger alert-dismissable">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Oops!</strong> Please check your password details.
                                                    </div>
                                                </div>
                                                <div id="user_success" style="display:none;">
                                                    <div class="alert alert-success alert-dismissable">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Success!</strong> Your password has been changed successfully.
                                                    </div>
                                                </div>
                                                <div class="col-md-5" style="color: #111111;">
                                                    
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                                                            <label>Current Password</label>
                                                            <input class="form-control" type="password" name="old_pass" id="old_pass">
                                                            <span style="color:red;font-size: 11px;" id="phone_no_error"></span>
                                                        </div>
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                                                            <label>New Password</label>
                                                            <input class="form-control" type="password" name="new_pass" id="new_pass">
                                                            <span style="color:red;font-size: 11px;" id="phone_no_error"></span>
                                                        </div>
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                                                            <label>New Password Again</label>
                                                            <input class="form-control" type="password" name="conf_pass" id="conf_pass">
                                                            <span style="color:red;font-size: 11px;" id="phone_no_error"></span>
                                                        </div>
                                                </div>
                                                <div style="clear:both;"></div>
                                                <div class="col-md-5">
                                                    <hr>
                                                    <div class="custom-search" style="margin-bottom: 35px;text-align:center;">
                                                        <input type="button" name="update_pass" value="Update Password" id="update_pass" onclick="return checkUpdateUserPass();" class="btn" style="color:#ffffff;">
                                                        <span id="loding_update_pass_submit" style="display:none;">
                                                            <img src="<?php echo base_url(); ?>assets/images/login_loder.gif" style="width: 30px;">
                                                        </span>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="bookings">
                                    <div class="">
                                        <div class="user-profile-sidebar" style="padding:0px; margin-right:0px;">
                                            <ul class=" nav nav-tabs list user-profile-nav">
                                                <li class="active" style="border-top: 0px solid #404040;"><a href="#hotel" data-toggle="tab"><i class="fa fa-bed" aria-hidden="true"></i>Hotel</a>
                                                </li>
                                                <li><a href="#flight" data-toggle="tab"><i class="fa fa-plane" aria-hidden="true"></i>Flight</a>
                                                </li>
                                                <li><a href="#car" data-toggle="tab"><i class="fa fa-car" aria-hidden="true"></i>Car</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="hotel">
                                                <div class="col-sm-12">
                                                    <div class="table_responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>Reference No
                                                                    </th>
                                                                    <th>Hotel
                                                                    </th>
                                                                    <th>Original Price
                                                                    </th>
                                                                    <th>Booked Price
                                                                    </th>
                                                                    <th>Markup
                                                                    </th>
                                                                    <th>Status
                                                                    </th>
                                                                    <th>Booked Date
                                                                    </th>
                                                                    <th>Action
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>20170311004354
                                                                    </td>
                                                                    <td>Queens
                                                                    </td>
                                                                    <td>1964.79
                                                                    </td>
                                                                    <td>1976.79
                                                                    </td>
                                                                    <td>12
                                                                    </td>
                                                                    <td style="color:green;">Confirmed
                                                                    </td>
                                                                    <td>2017-03-10 18:43:54
                                                                    </td>
                                                                    <td>
                                                                        <a href="#" target="_blank" style="color:green;">Voucher
                                                                        </a>
                                                                        <br>
                                                                        <a href="#" target="_blank" style="color:green;">Invoice
                                                                        </a>
                                                                        <br>
                                                                        <a href="" style="color:red;">Cancel
                                                                        </a>
                                                                        <br>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="flight">
                                                <div class="col-sm-12">
                                                    <div class="table_responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>Reference No
                                                                    </th>
                                                                    <th>Hotel
                                                                    </th>
                                                                    <th>Original Price
                                                                    </th>
                                                                    <th>Booked Price
                                                                    </th>
                                                                    <th>Markup
                                                                    </th>
                                                                    <th>Status
                                                                    </th>
                                                                    <th>Booked Date
                                                                    </th>
                                                                    <th>Action
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>20170311004354
                                                                    </td>
                                                                    <td>Queens
                                                                    </td>
                                                                    <td>1964.79
                                                                    </td>
                                                                    <td>1976.79
                                                                    </td>
                                                                    <td>12
                                                                    </td>
                                                                    <td style="color:green;">Confirmed
                                                                    </td>
                                                                    <td>2017-03-10 18:43:54
                                                                    </td>
                                                                    <td>
                                                                        <a href="" target="_blank" style="color:green;">Voucher
                                                                        </a>
                                                                        <br>
                                                                        <a href="" target="_blank" style="color:green;">Invoice
                                                                        </a>
                                                                        <br>
                                                                        <a href="" style="color:red;">Cancel
                                                                        </a>
                                                                        <br>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="car">
                                                <div class="col-sm-12">
                                                    <div class="table_responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>Reference No
                                                                    </th>
                                                                    <th>Hotel
                                                                    </th>
                                                                    <th>Original Price
                                                                    </th>
                                                                    <th>Booked Price
                                                                    </th>
                                                                    <th>Markup
                                                                    </th>
                                                                    <th>Status
                                                                    </th>
                                                                    <th>Booked Date
                                                                    </th>
                                                                    <th>Action
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>20170311004354
                                                                    </td>
                                                                    <td>Queens
                                                                    </td>
                                                                    <td>1964.79
                                                                    </td>
                                                                    <td>1976.79
                                                                    </td>
                                                                    <td>12
                                                                    </td>
                                                                    <td style="color:green;">Confirmed
                                                                    </td>
                                                                    <td>2017-03-10 18:43:54
                                                                    </td>
                                                                    <td>
                                                                        <a href="" target="_blank" style="color:green;">Voucher
                                                                        </a>
                                                                        <br>
                                                                        <a href="" target="_blank" style="color:green;">Invoice
                                                                        </a>
                                                                        <br>
                                                                        <a href="" style="color:red;">Cancel
                                                                        </a>
                                                                        <br>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane" id="deposits">
                                    <div class="">
                                        <div class="user-profile-sidebar" style="padding:0px; margin-right:0px;">
                                            <ul class=" nav nav-tabs list user-profile-nav">
                                                <li class="active" style="border-top: 0px solid #404040;"><a href="#deposit_list" data-toggle="tab"><i class="fa fa-list" aria-hidden="true"></i>Deposit List</a></li>
                                                <li><a href="#add_deposit" data-toggle="tab"><i class="fa fa-plus" aria-hidden="true"></i>Add Manual Deposit</a></li>
                                                <li><a href="#deposit_payment_gateway" data-toggle="tab"><i class="fa fa-plus" aria-hidden="true"></i>Add Deposit( Payment Gateway )</a></li>
                                            </ul>
                                        </div>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="deposit_list">
                                                <div class="col-sm-12">
                                                    <div class="table_responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Transection Id</th>
                                                                    <th>Deposit Bank</th>
                                                                    <th>Deposit Type</th>
                                                                    <th>Deposit Amount</th>
                                                                    <th>Date Added</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row">1</th>
                                                                    <td>Towards Sub-Agent</td>
                                                                    <td></td>
                                                                    <td>Sub Agent</td>
                                                                    <td>5000</td>
                                                                    <td>2017-03-10 09:43:17</td>
                                                                    <td style="color:green;">Accepted</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">2</th>
                                                                    <td>Towards Sub-Agent</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td>0</td>
                                                                    <td>2017-03-10 09:25:03</td>
                                                                    <td style="color:green;">Accepted</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">3</th>
                                                                    <td>523431</td>
                                                                    <td>Bank Of The Dubai</td>
                                                                    <td>Cheque</td>
                                                                    <td>10000</td>
                                                                    <td>2017-03-10 07:42:21</td>
                                                                    <td style="color:green;">Accepted</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">4</th>
                                                                    <td>324324</td>
                                                                    <td>Bank Of Dubai</td>
                                                                    <td>Cash</td>
                                                                    <td>50000</td>
                                                                    <td>2017-03-10 04:00:29</td>
                                                                    <td style="color:green;">Accepted</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>

                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="add_deposit">
                                                <form name="deposit_add" id="deposit_add" enctype="multipart/form-data" >
                                                    <div id="error_div" style="display:none;">
                                                        <div class="alert alert-danger alert-dismissable">
                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                            <strong>Oops!</strong> Please add correct deposit details.
                                                        </div>
                                                    </div>
                                                    <div id="success_div" style="display:none;">
                                                        <div class="alert alert-success alert-dismissable">
                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                            <strong>Success!</strong> Your deposit has been successfully done. It will be reviewed by admin and added to your account balance within 24hrs.
                                                        </div>
                                                    </div>
                                                <div class="col-sm-5">
                                                    <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                        <label>Payment Type:</label>
                                                        <select class="form-control" name="deposit_type" id="deposit_type" style="padding-top: 0;padding-bottom: 0;height: 41px;" onchange="showDepositType(this.value);" required="">
                                                            <option value="Cash">Cash</option>
                                                            <option value="Cheque">Cheque</option>
                                                            <option value="Bank Transfer">Bank Transfer</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                        <label>Phone Number:</label>
                                                        <input type="text" class="form-control" name="mobile_number" id="mobile_number" onkeypress="return restrictCharacters(this, event, digitsOnly);" value="">
                                                        <span style="color:red;font-size: 11px;" id="mobile_number_error"></span>
                                                    </div>
                                                    <div id="cash_div_block1" style="display:block;">
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Deposited In Bank:</label>
                                                            <select class="form-control" name="cash_deposit_bank" id="cash_deposit_bank" style="padding-top: 0;padding-bottom: 0;height: 41px;margin-bottom: 0px;">
                                                                <option value="">Select</option>
                                                                <option value="United Emirates Bank">United Emirates Bank</option>
                                                                <option value="Abu Dhabi Commercial Bank">Abu Dhabi Commercial Bank</option>
                                                                <option value="Abu Dhabi Islamic Bank">Abu Dhabi Islamic Bank</option>
                                                                <option value="Arab Bank plc">Arab Bank plc</option>
                                                                <option value="Bank of Baroda">Bank of Baroda</option>
                                                                <option value="Arab Emirates Investment Bank">Arab Emirates Investment Bank</option>
                                                                <option value="Bank of Sharjah">Bank of Sharjah</option>
                                                                <option value="Citibank UAE">Citibank UAE</option>
                                                                <option value="Commercial Bank International">Commercial Bank International</option>
                                                                <option value="Commercial Bank of Dubai">Commercial Bank of Dubai</option>
                                                                <option value="Dubai Islamic Bank">Dubai Islamic Bank</option>
                                                                <option value="Emirates Islamic Bank">Emirates Islamic Bank</option>
                                                                <option value="First Gulf Bank">First Gulf Bank</option>
                                                                <option value="Habib Bank AG Zurich">Habib Bank AG Zurich</option>
                                                                <option value="HSBC Bank Middle East Limited">HSBC Bank Middle East Limited</option>
                                                                <option value="Invest Bank">Invest Bank</option>
                                                                <option value="Emirates NBD">Emirates NBD</option>
                                                                <option value="Others">Others</option>
                                                            </select>
                                                            <span style="color:red;font-size: 11px;" id="cash_deposit_bank_error"></span>
                                                        </div>
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Receipt Scan Copy:</label>
                                                           <input type="file" class="form-control pad_0" name="cash_scan_copy" id="cash_scan_copy">
                                                            <span style="color:red;font-size: 11px;" id="cash_scan_copy_error"></span>
                                                            ( gif , png, jpeg, jpg format allowed )
                                                        </div>
                                                    </div>
                                                    <div id="cheque_div_block1" style="display:none;">
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Cheque Drawn on Bank:</label>
                                                            <input type="text" class="form-control" name="cheque_drawn_bank" id="cheque_drawn_bank" value="">
                                                            <span style="color:red;font-size: 11px;" id="cheque_drawn_bank_error"></span>
                                                        </div>
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Cheque / DD No.:</label>
                                                            <input type="text" class="form-control" name="cheque_no" id="cheque_no" value="">
                                                            <span style="color:red;font-size: 11px;" id="cheque_no_error"></span>
                                                        </div>
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Branch Deposited In:</label>
                                                            <input type="text" class="form-control" name="cheque_bank_branch" id="cheque_bank_branch" value="">
                                                            <span style="color:red;font-size: 11px;" id="cheque_bank_branch_error"></span>
                                                        </div>
                                                    </div>
                                                    <div id="bank_transfer_div_block1" style="display:none;">
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Deposited In Bank:</label>
                                                            <select class="form-control" name="bank_transfer_deposit_bank" id="bank_transfer_deposit_bank" style="margin-bottom: 0px;">
                                                                <option value="">Select</option>
                                                                <option value="United Emirates Bank">United Emirates Bank</option>
                                                                <option value="Abu Dhabi Commercial Bank">Abu Dhabi Commercial Bank</option>
                                                                <option value="Abu Dhabi Islamic Bank">Abu Dhabi Islamic Bank</option>
                                                                <option value="Arab Bank plc">Arab Bank plc</option>
                                                                <option value="Bank of Baroda">Bank of Baroda</option>
                                                                <option value="Arab Emirates Investment Bank">Arab Emirates Investment Bank</option>
                                                                <option value="Bank of Sharjah">Bank of Sharjah</option>
                                                                <option value="Citibank UAE">Citibank UAE</option>
                                                                <option value="Commercial Bank International">Commercial Bank International</option>
                                                                <option value="Commercial Bank of Dubai">Commercial Bank of Dubai</option>
                                                                <option value="Dubai Islamic Bank">Dubai Islamic Bank</option>
                                                                <option value="Emirates Islamic Bank">Emirates Islamic Bank</option>
                                                                <option value="First Gulf Bank">First Gulf Bank</option>
                                                                <option value="Habib Bank AG Zurich">Habib Bank AG Zurich</option>
                                                                <option value="HSBC Bank Middle East Limited">HSBC Bank Middle East Limited</option>
                                                                <option value="Invest Bank">Invest Bank</option>
                                                                <option value="Emirates NBD">Emirates NBD</option>
                                                                <option value="Others">Others</option>
                                                            </select>
                                                            <span style="color:red;font-size: 11px;" id="bank_transfer_deposit_bank_error"></span>
                                                        </div>
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Receipt Scan Copy :</label>
                                                            <input type="file" class="form-control pad_0" name="bank_transfer_scan_copy" id="bank_transfer_scan_copy">
                                                            <span style="color:red;font-size: 11px;" id="bank_transfer_scan_copy_error"></span>
                                                            ( gif , png, jpeg, jpg format allowed )
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                        <label>Deposit Amount:</label>
                                                        <input type="text" class="form-control" name="deposit_amount" id="deposit_amount" onkeypress="return restrictCharacters(this, event, digitsOnly);" value="">
                                                        <span style="color:red;font-size: 11px;" id="deposit_amount_error"></span>
                                                    </div>
                                                    <div id="cash_div_block2" style="display:block;">
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Transection Id:</label>
                                                            <input type="text" class="form-control" name="cash_transection_id" id="cash_transection_id" value="">
                                                            <span style="color:red;font-size: 11px;" id="cash_transection_id_error"></span>
                                                        </div>
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Branch Deposited In:</label>
                                                            <input type="text" class="form-control" name="cash_bank_branch" id="cash_bank_branch" value="">
                                                            <span style="color:red;font-size: 11px;" id="cash_bank_branch_error"></span>
                                                        </div>
                                                    </div>
                                                    <div id="cheque_div_block2" style="display:none;">
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Transection Id:</label>
                                                            <input type="text" class="form-control" name="cheque_transection_id" id="cheque_transection_id" value="">
                                                            <span style="color:red;font-size: 11px;" id="cheque_transection_id_error"></span>
                                                        </div>
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Cheque Issue Date: ( Date format -  yyyy-mm-dd )</label>
                                                            <input type="text" class="form-control hasDatepicker" name="cheque_issue_date" id="cheque_issue_date" value="">
                                                            <span style="color:red;font-size: 11px;" id="cheque_issue_date_error"></span>
                                                        </div>
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Deposited In Bank:</label>
                                                            <select class="form-control" name="cheque_deposit_bank" id="cheque_deposit_bank" style="margin-bottom: 0px;">
                                                                <option value="">Select</option>
                                                                <option value="United Emirates Bank">United Emirates Bank</option>
                                                                <option value="Abu Dhabi Commercial Bank">Abu Dhabi Commercial Bank</option>
                                                                <option value="Abu Dhabi Islamic Bank">Abu Dhabi Islamic Bank</option>
                                                                <option value="Arab Bank plc">Arab Bank plc</option>
                                                                <option value="Bank of Baroda">Bank of Baroda</option>
                                                                <option value="Arab Emirates Investment Bank">Arab Emirates Investment Bank</option>
                                                                <option value="Bank of Sharjah">Bank of Sharjah</option>
                                                                <option value="Citibank UAE">Citibank UAE</option>
                                                                <option value="Commercial Bank International">Commercial Bank International</option>
                                                                <option value="Commercial Bank of Dubai">Commercial Bank of Dubai</option>
                                                                <option value="Dubai Islamic Bank">Dubai Islamic Bank</option>
                                                                <option value="Emirates Islamic Bank">Emirates Islamic Bank</option>
                                                                <option value="First Gulf Bank">First Gulf Bank</option>
                                                                <option value="Habib Bank AG Zurich">Habib Bank AG Zurich</option>
                                                                <option value="HSBC Bank Middle East Limited">HSBC Bank Middle East Limited</option>
                                                                <option value="Invest Bank">Invest Bank</option>
                                                                <option value="Emirates NBD">Emirates NBD</option>
                                                                <option value="Others">Others</option>
                                                            </select>
                                                            <span style="color:red;font-size: 11px;" id="cheque_deposit_bank_error"></span>
                                                        </div>
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Receipt Scan Copy:</label>
                                                            <input type="file" class="form-control pad_0" name="cheque_scan_copy" id="cheque_scan_copy">
                                                            <span style="color:red;font-size: 11px;" id="cheque_scan_copy_error"></span>
                                                            ( gif , png, jpeg, jpg format allowed )
                                                        </div>
                                                    </div>
                                                    <div id="bank_transfer_div_block2" style="display:none;">
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Transection Id:</label>
                                                            <input type="text" class="form-control" name="bank_transfer_transection_id" id="bank_transfer_transection_id" value="">
                                                            <span style="color:red;font-size: 11px;" id="bank_transfer_transection_id_error"></span>
                                                        </div>
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Branch Deposited In:</label>
                                                            <input type="text" class="form-control" name="bank_transfer_bank_branch" id="bank_transfer_bank_branch" value="">
                                                            <span style="color:red;font-size: 11px;" id="bank_transfer_bank_branch_error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-10">
                                                    <hr>
                                                    <div class="custom-search" style="margin-bottom: 35px;text-align:center">
                                                        <input type="submit" id="submit_add_deposit" name="" value="Submit Deposit Details" onclick="return addDepositCheckSubmit();" class="btn" style="color:#ffffff;">
                                              
                                                        <span id="loding_deposit_submit" style="display:none;">
                                                            <img src="<?php echo base_url(); ?>assets/images/login_loder.gif" style="width: 30px;">
                                                        </span>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                            <div role="tabpanel" class="tab-pane active" id="deposit_payment_gateway">
                                                <div class="col-sm-12">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="sub-agents">
                                    <div class="">
                                        <div class="user-profile-sidebar" style="padding:0px;">
                                            <ul class=" nav nav-tabs list user-profile-nav">
                                                <li class="active" style="border-top: 0px solid #404040;"><a href="#subagent1" data-toggle="tab"><i class="fa fa-user"></i>Sub-Agent List</a></li>
                                                <li><a href="#subagent2" data-toggle="tab"><i class="fa fa-cog"></i>Add New Sub-Agent</a></li>
                                                <li><a href="#subagent3" data-toggle="tab"><i class="fa fa-cog"></i>Manage Sub-Agent's Deposit</a></li>
                                                <li><a href="#subagent4" data-toggle="tab"><i class="fa fa-cog"></i>Markup On Sub-Agent</a></li>
                                                <li><a href="#subagent5" data-toggle="tab"><i class="fa fa-cog"></i>Sub-Agent Booking History</a></li>
                                            </ul>
                                        </div>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="subagent1">
                                                <table class="table table-hover">
                                                    <thead>
                                                      <tr>
                                                        <th>#</th>
                                                        <th>Email Id</th>
                                                        <th>Agent Name</th>
                                                        <th>Contact No.</th>
                                                        <th>Date Added</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                                        if($sub_agent_list != '')
                                                        {
                                                            $i=1;
                                                            foreach($sub_agent_list as $list)
                                                            {
                                                    ?>
                                                                <tr>
                                                                    <th scope="row"><?php echo $i; ?></th>
                                                                    <td><?php echo $list->user_email; ?></td>
                                                                    <td><?php echo $list->company_name; ?></td>
                                                                    <td><?php echo $list->mobile_no; ?></td>
                                                                    <td><?php echo $list->register_date; ?></td>
                                                                    <?php
                                                                        if($list->status == '0') 
                                                                        {
                                                                    ?>
                                                                            <td style="color:red;">Pending</td>
                                                                    <?php
                                                                        }
                                                                        else if($list->status == '1')
                                                                        {
                                                                    ?>
                                                                            <td style="color:green;">Active</td>
                                                                    <?php
                                                                        }
                                                                        else
                                                                        {
                                                                    ?>
                                                                            <td style="color:red;">Blocked</td>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                    <?php 
                                                                        if($list->status == 1)
                                                                        {
                                                                    ?>
                                                                            <td><a href="<?php echo site_url(); ?>/agent/changeSubAgentStatus/<?php echo $list->user_id; ?>/2" id="block_sub_agent" class="btn btn-default" >Block Sub-Agent</a></td>
                                                                    <?php
                                                                        }
                                                                        else
                                                                        {
                                                                    ?>
                                                                            <td><a href="<?php echo site_url(); ?>/agent/changeSubAgentStatus/<?php echo $list->user_id; ?>/1" id="unblock_sub_agent" class="btn btn-default">Unblock Sub-Agent</a></td>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </tr>
                                                    <?php
                                                                $i++;
                                                            }
                                                        }
                                                        else
                                                        {
                                                    ?>
                                                            <td colspan="7" style="font-weight: bold;" align="center">No Sub-Agent is added yet.</td>
                                                    <?php
                                                        }
                                                    ?>
                                                    </tbody>
                                                    </table>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="subagent2">
                                                <form role="form" method="POST" action="<?php echo site_url(); ?>/agent/add_sub_agent"> 
                                                    <label style="margin-left: 233px;">Login Information</label>
                                                    <hr />
                                                    <div class="form-group">
                                                        <label for="email">Email address:</label>
                                                        <input type="email" class="form-control" id="email_id" name="email_id" value="<?php echo(isset($email) && $email != ''?$email:''); ?>" style="width: 35%" required>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pwd">Password:</label>
                                                        <input type="password" class="form-control" id="password" name="password" value="<?php echo(isset($password) && $password != ''?$password:''); ?>" style="width: 35%" required>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pwd">Confirm Password:</label>
                                                        <input type="password" class="form-control" id="conf_password" name="conf_password" value="<?php echo(isset($con_password) && $con_password != ''?$con_password:''); ?>" style="width: 35%" required>

                                                    </div>

                                                    <hr />
                                                    <label style="margin-left: 233px;">Personal Information</label>
                                                    <hr />

                                                    <div class="form-group">
                                                        <label for="email">Company Name / Agent Name:</label>
                                                        <input type="text" class="form-control" id="comp_name" name="comp_name" value="<?php echo(isset($compName) && $compName != ''?$compName:''); ?>" style="width: 35%" required>

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email">Mobile Number:</label>
                                                        <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="<?php echo(isset($contactNo) && $contactNo != ''?$contactNo:''); ?>" style="width: 35%" onkeypress="return restrictCharacters(this, event, digitsOnly);" required>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Address:</label><br />
                                                        <textarea id="address" name="address" rows="2" style="background-color: #ffffff;border: 1px solid #d4d4d4;border-radius: 4px;width:35%;"><?php echo(isset($address) && $address != ''?$address:''); ?></textarea>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Pin Code:</label>
                                                        <input type="number" class="form-control" id="pin_code" name="pin_code" value="<?php echo(isset($pinCode) && $pinCode != ''?$pinCode:''); ?>" style="width: 35%" onkeypress="return restrictCharacters(this, event, digitsOnly);" required>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">city:</label>
                                                        <input type="text" class="form-control" id="city" name="city" value="<?php echo(isset($city) && $city != ''?$city:''); ?>" style="width: 35%" required>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">State:</label>
                                                        <input type="text" class="form-control" id="mobile_no" name="state" value="<?php echo(isset($state) && $state != ''?$state:''); ?>" style="width: 35%" required>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Country:</label>
                                                        <select class="form-control" name="country" style="width: 35%">
                                                            <option value="">Select Country</option>
                                                            <?php
                                                                if($country_list != '')
                                                                {
                                                                    foreach($country_list as $country)
                                                                    {
                                                            ?>
                                                                        <option value="<?php echo $country->name; ?>" <?php if(isset($country) && $country ==$country->name) echo 'selected="selected"'; else if($country->name == 'Philippines') echo 'selected="selected"'; else echo ''; ?>><?php echo $country->name; ?></option>
                                                            <?php
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <input type="submit" value="Add new sub-agent" class="btn btn-default" style="border-width: 5px;margin-bottom:20px;padding-bottom: 5px;padding-right: 49px;padding-left: 44px;background-color: #a2b417;border-color: #a2b417;color: #ffffff;">
                                                </form>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="subagent3">
                                                <table class="table table-hover">
                                                    <thead>
                                                      <tr>
                                                        <th>#</th>
                                                        <th>Email Id</th>
                                                        <th>Agent Name</th>
                                                        <th>Last Deposit Amount</th>
                                                        <th>Deposit Balance Left</th>
                                                        <th>Date Added</th>
                                                        <th>Action</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                                        if($sub_agent_list != '')
                                                        {
                                                            $i=1;
                                                            foreach($sub_agent_list as $list)
                                                            {
                                                                $query = $this->db->query($sql = "select * from b2b_deposit_payment_history where agent_id='".$list->user_id."'");
                                                                if($query->num_rows > 0)
                                                                {
                                                                    $depData = $query->row();
                                                                    $lastDeposit = $depData->total_deposit_amount;
                                                                    $balanceLeft = $depData->total_balance_amount;
                                                                    $lastDepositDate = $depData->last_deposit_date;
                                                                    $status = $depData->status;
                                                                }
                                                                else
                                                                {
                                                                    $lastDeposit = 0;
                                                                    $balanceLeft = 0;
                                                                    $lastDepositDate = '';
                                                                    $status = '';
                                                                }
                                                    ?>
                                                                <tr>
                                                                    <th scope="row"><?php echo $i; ?></th>
                                                                    <td><?php echo $list->user_email; ?></td>
                                                                    <td><?php echo $list->company_name; ?></td>
                                                                    <td><?php echo $lastDeposit; ?></td>
                                                                    <td><?php echo $balanceLeft; ?></td>
                                                                    <td><?php echo $lastDepositDate; ?></td>
                                                                    <td><a data-toggle="modal" data-target="#add_sub_deposit_<?php echo $list->user_id; ?>" class="btn btn-default" >Add Deposit</a></td>
                                                                </tr>
                                                                <?php 
                                                                    $qry = $this->db->query($sql = "select total_balance_amount from b2b_deposit_payment_history where agent_id = '".$_SESSION['agent']['user_id']."'");
                                                                    if($qry->num_rows() > 0)
                                                                    {
                                                                        $agentDep = $qry->row();
                                                                        $agentDepBal = $agentDep->total_balance_amount;
                                                                    }
                                                                    else
                                                                    {
                                                                        $agentDepBal = 0;
                                                                    }
                                                                ?>
                                                                <div id="add_sub_deposit_<?php echo $list->user_id; ?>" class="modal fade" role="dialog" style="top:120px;">
                                                                    <div class="modal-dialog">

                                                                      <!-- Modal content-->
                                                                      <div class="modal-content">
                                                                        <div class="modal-header">
                                                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                          <span class="modal-title" style="font-size:16px;font-weight:bold">Add Deposit</span>
                                                                        </div>
                                                                        <div class="modal-body" style="padding-left:140px;">
                                                                            <form name="frm" method="POST" action="<?php echo site_url(); ?>/agent/add_sub_agent_deposit/<?php echo $list->user_id; ?>">
                                                                          <p style="margin-left: 57px;margin-bottom: 15px;">Add Deposit for this sub-agent</p>

                                                                            <div class="form-group">
                                                                                <label>Your Account Balance</label>
                                                                                <input type="text" class="form-control" id="agent_balance" name="agent_balance" value="<?php echo $agentDepBal; ?>" style="height: 34px;width:68%" readonly="readonly">
                                                                                <div id="forgot_email_id_error" style="margin-top: 4px;font-size: 12px;color: red;margin-left: 5px;display:none;"></div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Deposit Amount</label>
                                                                                <input type="text" class="form-control" id="agent_balance" name="deposit_amount" value="" style="height: 34px;width:68%" onkeypress="return restrictCharacters(this, event, digitsOnly);" required>
                                                                                <div id="forgot_email_id_error" style="margin-top: 4px;font-size: 12px;color: red;margin-left: 5px;">should be less than your balance.</div>
                                                                            </div>
                                                                          <input type="hidden" name="sub_id" value="<?php echo $list->user_id; ?>">
                                                                              <div class="form-group" style="float: left;margin: 0 0 11px 117px;">
                                                                                  <input type="submit" tabindex="11" class="btn btn-primary pull-right" value="Add Deposit" title="Add Deposit.">
                                                                              </div>
                                                                            </form>
                                                                        </div>
                                                                        <div class="modal-footer" style="border:0px;">

                                                                        </div>
                                                                      </div>

                                                                    </div>
                                                                </div>
                                                    <?php
                                                                $i++;
                                                            }
                                                        }
                                                        else
                                                        {
                                                    ?>
                                                            <td col-span="7">No Sub-Agent is added yet.</td>
                                                    <?php
                                                        }
                                                    ?>
                                                    </tbody>
                                                </table>
                                                
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="subagent4">
                                                <div style='font-weight:normal;font-size:24px;color: #a2b417;margin-bottom:30px;'>Sub-agent Markup's</div>
                                                        <div style='float:right'><button data-toggle="modal" data-target="#add_all_sub_markup" class="btn btn-primary pull-right" title="Add All Sub-agent Markup">Add Markup For All Sub-Agents</button></div>
                                                        <div id="add_all_sub_markup" class="modal fade" role="dialog" style="top:120px;">
                                                            <div class="modal-dialog">

                                                              <!-- Modal content-->
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                  <span class="modal-title" style="font-size:16px;font-weight:bold">Update Sub-Agent Markup</span>
                                                                </div>
                                                                <div class="modal-body" style="padding-left:140px;">
                                                                    <form name="frm" method="POST" action="<?php echo site_url(); ?>/agent/add_all_sub_agent_markup">
                                                                  <p style="margin-left: 57px;margin-bottom: 15px;">Add Markup for all sub-agent</p>

                                                                    <div class="form-group">
                                                                        <label>Domestic Flights</label>
                                                                        <input type="text" class="form-control" name="domestic_flight" value="0" style="height: 34px;width:68%" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>International Flights</label>
                                                                        <input type="text" class="form-control" name="international_flight" value="0" style="height: 34px;width:68%" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Hotels</label>
                                                                        <input type="text" class="form-control" name="hotels" value="0" style="height: 34px;width:68%" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Cars</label>
                                                                        <input type="text" class="form-control" name="cars" value="0" style="height: 34px;width:68%" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Packages</label>
                                                                        <input type="text" class="form-control" name="packages" value="0" style="height: 34px;width:68%" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Sightseen</label>
                                                                        <input type="text" class="form-control" name="sightseen" value="0" style="height: 34px;width:68%" required>
                                                                    </div>

                                                                      <div class="form-group" style="float: left;margin: 0 0 11px 117px;">
                                                                          <input type="submit" tabindex="11" class="btn btn-primary pull-right" value="Add Markup" title="Add Markup.">
                                                                      </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer" style="border:0px;">

                                                                </div>
                                                              </div>

                                                            </div>
                                                        </div>

                                                        <table class="table table-hover">
                                                            <thead>
                                                              <tr>
                                                                <th>#</th>
                                                                <th>Email Id</th>
                                                                <th>Sub Agent Name</th>
                                                                <th>Domestic FLights</th>
                                                                <th>International FLights</th>
                                                                <th>Hotels</th>
                                                                <th>Cars</th>
                                                                <th>Packages</th>
                                                                <th>Sightseen</th>
                                                                <th>Action</th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php 
                                                                if($markup_data != '')
                                                                {
                                                                    $i=1;
                                                                    foreach($markup_data as $list)
                                                                    {
                                                                        if($list->sub_agent_id !='')
                                                                        {
                                                                            $compNameQuery = $this->db->query($sql = "select company_name,user_email,status from agent_info where user_id='".$list->sub_agent_id."'");
                                                                            if($compNameQuery->num_rows() > 0)
                                                                            {
                                                                                $compName = $compNameQuery->row();
                                                                                if($compName->status == 1)
                                                                                {
                                                                ?>
                                                                                    <tr>
                                                                                        <th scope="row"><?php echo $i; ?></th>
                                                                                        <td><?php echo $compName->user_email; ?></td>
                                                                                        <td><?php echo $compName->company_name; ?></td>
                                                                                        <td><?php echo $list->DomesticFlights; ?></td>
                                                                                        <td><?php echo $list->InternationalFlights; ?></td>
                                                                                        <td><?php echo $list->Hotels; ?></td>
                                                                                        <td><?php echo $list->Cars; ?></td>
                                                                                        <td><?php echo $list->Packages; ?></td>
                                                                                        <td><?php echo $list->Sightseen; ?></td>
                                                                                        <td><a data-toggle="modal" data-target="#add_sub_markup_<?php echo $list->sub_agent_id; ?>" class="btn btn-default" >Update Markup</a></td>
                                                                                    </tr>

                                                                                    <div id="add_sub_markup_<?php echo $list->sub_agent_id; ?>" class="modal fade" role="dialog" style="top:120px;">
                                                                                        <div class="modal-dialog">

                                                                                          <!-- Modal content-->
                                                                                          <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                              <span class="modal-title" style="font-size:16px;font-weight:bold">Update Sub-Agent Markup</span>
                                                                                            </div>
                                                                                            <div class="modal-body" style="padding-left:140px;">
                                                                                                <form name="frm" method="POST" action="<?php echo site_url(); ?>/agent/update_sub_agent_markup/<?php echo $list->sub_agent_id; ?>">
                                                                                              <p style="margin-left: 57px;margin-bottom: 15px;">Add Deposit for this sub-agent</p>

                                                                                                <div class="form-group">
                                                                                                    <label>Domestic Flights</label>
                                                                                                    <input type="text" class="form-control" name="domestic_flight" value="<?php echo($list->DomesticFlights==''?'0':$list->DomesticFlights) ?>" onkeypress="return restrictCharacters(this, event, digitsOnly);" style="height: 34px;width:68%" required>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label>International Flights</label>
                                                                                                    <input type="text" class="form-control" name="international_flight" value="<?php echo($list->InternationalFlights==''?'0':$list->InternationalFlights) ?>" onkeypress="return restrictCharacters(this, event, digitsOnly);" style="height: 34px;width:68%" required>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label>Hotels</label>
                                                                                                    <input type="text" class="form-control" name="hotels" value="<?php echo($list->Hotels==''?'0':$list->Hotels) ?>" style="height: 34px;width:68%" onkeypress="return restrictCharacters(this, event, digitsOnly);" required>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label>Cars</label>
                                                                                                    <input type="text" class="form-control" name="cars" value="<?php echo($list->Cars==''?'0':$list->Cars) ?>" style="height: 34px;width:68%" onkeypress="return restrictCharacters(this, event, digitsOnly);" required>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label>Packages</label>
                                                                                                    <input type="text" class="form-control" name="packages" value="<?php echo($list->Packages==''?'0':$list->Packages) ?>" style="height: 34px;width:68%" onkeypress="return restrictCharacters(this, event, digitsOnly);" required>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label>Sightseen</label>
                                                                                                    <input type="text" class="form-control" name="sightseen" value="<?php echo($list->Sightseen==''?'0':$list->Sightseen) ?>" style="height: 34px;width:68%" onkeypress="return restrictCharacters(this, event, digitsOnly);" required>
                                                                                                </div>
                                                                                                <input type="hidden" name="sub_id" value="<?php echo $list->sub_agent_id; ?>">
                                                                                                  <div class="form-group" style="float: left;margin: 0 0 11px 117px;">
                                                                                                      <input type="submit" tabindex="11" class="btn btn-primary pull-right" value="Update Markup" title="Update Markup.">
                                                                                                  </div>
                                                                                                </form>
                                                                                            </div>
                                                                                            <div class="modal-footer" style="border:0px;">

                                                                                            </div>
                                                                                          </div>

                                                                                        </div>
                                                                                    </div>
                                                            <?php
                                                                                    $i++;
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                else
                                                                {
                                                            ?>
                                                                    <td col-span="7">No Markup is added to any sub-agent yet.</td>
                                                            <?php
                                                                }
                                                            ?>
                                                            </tbody>
                                                        </table>
                        
                                                
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="subagent5">
                                                
                                                
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane" id="markups">
                                    <div class="">
                                        <div class="user-profile-sidebar" style="padding:0px; margin-right:0px;">
                                            <ul class=" nav nav-tabs list user-profile-nav">
                                                <li class="active" style="border-top: 0px solid #404040;"><a href="#markup_list" data-toggle="tab"><i class="fa fa-list" aria-hidden="true"></i>Markup List</a>
                                                </li>
                                                <li><a href="#markup_add" data-toggle="tab"><i class="fa fa-plus" aria-hidden="true"></i>Add Markup</a>
                                                </li>

                                            </ul>
                                        </div>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="markup_list">
                                                <div class="col-sm-12">
                                                    <div class="table_responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>#
                                                                    </th>
                                                                    <th>Domestic FLights
                                                                    </th>
                                                                    <th>International FLights
                                                                    </th>
                                                                    <th>Hotels
                                                                    </th>
                                                                    <th>Cars
                                                                    </th>
                                                                    <th>Packages
                                                                    </th>
                                                                    <th>Sightseen
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row">2
                                                                    </th>
                                                                    <td>10
                                                                    </td>
                                                                    <td>11
                                                                    </td>
                                                                    <td>12
                                                                    </td>
                                                                    <td>13
                                                                    </td>
                                                                    <td>14
                                                                    </td>
                                                                    <td>15
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>

                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="markup_add">
                                                <div class="col-sm-12">
                                                    <div class="">
                                                        <form class="form-horizontal" name="pass" action="#" method="POST" role="form" id="form1">
                                                            <div class="form-group">
                                                                <label class="control-label col-sm-2" for="pwd">Domestic Flight:
                                                                </label>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="domestic_flight" value="10" id="domestic_flight" onkeypress="return restrictCharacters(this, event, digitsOnly);" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-sm-2" for="pwd">International Flight:
                                                                </label>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="international_flight" value="11" id="domestic_flight" onkeypress="return restrictCharacters(this, event, digitsOnly);" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-sm-2" for="pwd">Hotels:
                                                                </label>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="hotels" value="12" onkeypress="return restrictCharacters(this, event, digitsOnly);" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-sm-2" for="pwd">Cars:
                                                                </label>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="cars" value="13" onkeypress="return restrictCharacters(this, event, digitsOnly);" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-sm-2" for="pwd">Packages:
                                                                </label>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="packages" value="14" onkeypress="return restrictCharacters(this, event, digitsOnly);" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-sm-2" for="pwd">Sightseen:
                                                                </label>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="sightseen" value="15" onkeypress="return restrictCharacters(this, event, digitsOnly);" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-sm-offset-2 col-sm-10">
                                                                    <input type="submit" name="submit" value="Add Markup" class="btn btn-primary">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>			
            </div>
        
            <div style="clear:both;"></div>
            <footer>
                <div class="container">
                    <div class="row">
                        <!-- Address -->
                        <div class="col-sm-4 col-md-3">
                            <div class="footer-box address-inner">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                                    been the.  
                                </p>
                                <div class="address">
                                    <i class="fa fa-map-marker fa-fw"></i>
                                    <p>PO Box 16122 Collins Street
                                        <br>
                                        West Victoria 8007 India
                                    </p>
                                </div>
                                <div class="address">
                                    <i class="fa fa-phone fa-fw"></i>
                                    <p> +91 8903158391
                                    </p>
                                </div>
                                <div class="address">
                                    <i class="fa fa-envelope fa-fw"></i>
                                    <p> admin@gmail.com
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-6">
                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <div class="footer-box">
                                        <h4 class="footer-title">Information
                                        </h4>
                                        <ul class="categoty">
                                            <li>
                                                <a href="#">About us
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">Online Enquiry
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">Call us
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">Terms and Conditions
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">Privacy &amp; Cookies Policy
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">Become a partner
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="footer-box">
                                        <h4 class="footer-title">Experiences
                                        </h4>
                                        <ul class="categoty">
                                            <li>
                                                <a href="#">Epic journeys
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">Hidden tribes
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">Eco lodges &amp; tours
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">Endangered Wildlife
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="footer-box">
                                        <h4 class="footer-title">Destinations
                                        </h4>
                                        <ul class="categoty">
                                            <li>
                                                <a href="#">Europe
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">Africa
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">Asia
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">Oceania
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">North America
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">South America
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 hidden-sm">
                            <div class="footer-box">
                                <h4 class="footer-title">Flickr Gallery
                                </h4>
                                <ul class="gallery-list">
                                    <li> 
                                        <a href="#">
                                            <img src="assets/images/flickr-1.jpg" alt="">
                                        </a>
                                    </li>
                                    <li> 
                                        <a href="#">
                                            <img src="assets/images/flickr-2.jpg" alt="">
                                        </a>
                                    </li>
                                    <li> 
                                        <a href="#">
                                            <img src="assets/images/flickr-3.jpg" alt="">
                                        </a>
                                    </li>
                                    <li> 
                                        <a href="#">
                                            <img src="assets/images/flickr-4.jpg" alt="">
                                        </a>
                                    </li>
                                    <li> 
                                        <a href="#">
                                            <img src="assets/images/flickr-5.jpg" alt="">
                                        </a>
                                    </li>
                                    <li> 
                                        <a href="#">
                                            <img src="assets/images/flickr-6.jpg" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-5">
                                <p>Copyright © 2017. All rights reserved
                                </p>
                            </div>
                            <div class="col-sm-7">
                                <div class="footer-menu">
                                    <ul>
                                        <li>
                                            <a href="">Home
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">About
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">Login
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">Register
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">Blog
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <div class="gap"></div>
            <script type='text/javascript'>
                var Site_Url = '<?php echo site_url(); ?>';
                var Base_Url = '<?php echo base_url(); ?>';
            </script>
            <script type='text/javascript' src='<?php echo base_url(); ?>assets/js/jquery.min.js'></script>
            <script type='text/javascript' src='<?php echo base_url(); ?>assets/js/custom.js'></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>  
            <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
            <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/slimmenu.js"></script>
            <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
            <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/bootstrap-timepicker.js"></script>
            <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/nicescroll.js"></script>
            <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/typeahead.js"></script>
            <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/owl-carousel.js"></script>
            <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/common.js"></script>  
            <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/custom.js"></script>      
        </div>
    </body>
</html>



