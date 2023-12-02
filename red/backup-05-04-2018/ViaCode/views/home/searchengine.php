<?php
$adult_arr = array();
$adult_arr[] = "1";
$adult_arr[] = "2";
$adult_arr[] = "3";
$adult_arr[] = "4";
$adult_arr[] = "5";
$adult_arr[] = "6";
$adult_arr[] = "7";
$adult_arr[] = "8";
$adult_arr[] = "9";

$adult_arr1[1][] = "0";
$adult_arr1[1][] = "1";
$adult_arr1[1][] = "2";
$adult_arr1[1][] = "3";
$adult_arr1[1][] = "4";
$adult_arr1[1][] = "5";
$adult_arr1[1][] = "6";
$adult_arr1[1][] = "7";
$adult_arr1[1][] = "8";

$adult_arr1[2][] = "0";
$adult_arr1[2][] = "1";
$adult_arr1[2][] = "2";
$adult_arr1[2][] = "3";
$adult_arr1[2][] = "4";
$adult_arr1[2][] = "5";
$adult_arr1[2][] = "6";
$adult_arr1[2][] = "7";

$adult_arr1[3][] = "0";
$adult_arr1[3][] = "1";
$adult_arr1[3][] = "2";
$adult_arr1[3][] = "3";
$adult_arr1[3][] = "4";
$adult_arr1[3][] = "5";
$adult_arr1[3][] = "6";

$adult_arr1[4][] = "0";
$adult_arr1[4][] = "1";
$adult_arr1[4][] = "2";
$adult_arr1[4][] = "3";
$adult_arr1[4][] = "4";
$adult_arr1[4][] = "5";


$adult_arr1[5][] = "0";
$adult_arr1[5][] = "1";
$adult_arr1[5][] = "2";
$adult_arr1[5][] = "3";
$adult_arr1[5][] = "4";

$adult_arr1[6][] = "0";
$adult_arr1[6][] = "1";
$adult_arr1[6][] = "2";
$adult_arr1[6][] = "3";

$adult_arr1[7][] = "0";
$adult_arr1[7][] = "1";
$adult_arr1[7][] = "2";

$adult_arr1[8][] = "0";
$adult_arr1[8][] = "1";

$adult_arr2[9][] = "0";
$adult_arr2[9][] = "1";
$adult_arr2[9][] = "2";
$adult_arr2[9][] = "3";
$adult_arr2[9][] = "4";
$adult_arr2[9][] = "5";
$adult_arr2[9][] = "6";
$adult_arr2[9][] = "7";
$adult_arr2[9][] = "8";
$adult_arr2[9][] = "9";

$adult_arr2[8][] = "0";
$adult_arr2[8][] = "1";
$adult_arr2[8][] = "2";
$adult_arr2[8][] = "3";
$adult_arr2[8][] = "4";
$adult_arr2[8][] = "5";
$adult_arr2[8][] = "6";
$adult_arr2[8][] = "7";
$adult_arr2[8][] = "8";

$adult_arr2[7][] = "0";
$adult_arr2[7][] = "1";
$adult_arr2[7][] = "2";
$adult_arr2[7][] = "3";
$adult_arr2[7][] = "4";
$adult_arr2[7][] = "5";
$adult_arr2[7][] = "6";
$adult_arr2[7][] = "7";

$adult_arr2[6][] = "0";
$adult_arr2[6][] = "1";
$adult_arr2[6][] = "2";
$adult_arr2[6][] = "3";
$adult_arr2[6][] = "4";
$adult_arr2[6][] = "5";
$adult_arr2[6][] = "6";

$adult_arr2[5][] = "0";
$adult_arr2[5][] = "1";
$adult_arr2[5][] = "2";
$adult_arr2[5][] = "3";
$adult_arr2[5][] = "4";
$adult_arr2[5][] = "5";

$adult_arr2[4][] = "0";
$adult_arr2[4][] = "1";
$adult_arr2[4][] = "2";
$adult_arr2[4][] = "3";
$adult_arr2[4][] = "4";

$adult_arr2[3][] = "0";
$adult_arr2[3][] = "1";
$adult_arr2[3][] = "2";
$adult_arr2[3][] = "3";

$adult_arr2[2][] = "0";
$adult_arr2[2][] = "1";

$adult_arr2[2][] = "2";

$adult_arr2[1][] = "0";
$adult_arr2[1][] = "1";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo Site_Title; ?></title>
        <!--################### CSS FILES STARTS ################################################-->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
        <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/dist/css/sb-admin-2.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/styles.css" type="text/css" rel="stylesheet" media="all">
        <link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!--################### CSS FILES ENDS ################################################-->
        <style type="text/css">
            .ui-menu .ui-menu-item{ padding:0px 0 4px 0;}
            .ui-menu-item-wrapper{padding-left:8px;}
            .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
                border: 1px solid #aaaaaa;font-weight: normal;color: #ffffff;background:none;background-color: #f74623 !important;padding:7px;
            }
            .pad0{padding:0px;}
            .bod_bac{ background-image: url("http://www.redtagtravels.com/agent/assets/images/tokyo.jpg");
                	    background-repeat:repeat;
			    min-height: auto;
			    background-size: 100% 710px;
            }
            #page-wrapper{min-height: 489px;}
            @media (min-width: 768px){
            #page-wrapper {border:0px;margin:0px;}}
            #page-wrapper{background:none;}
            #search1{background:none;}
                    #search{background:none;}
                    .nav-tabs{border:0px;}
                    .tab-content{background-color:#fff;}
                    .nav-tabs>li{    background-color: #fff;
                margin-left: 4px;}
                .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{    width: 100%;
                border: 0;
                border-radius: 0;    background-color: #f74624;color:#fff;}
                .form-control{border-radius:0px; height:40px;}
                .rad_po{
                position: relative;
                top: 7px;
                left: 13px;
            }
            @media only screen 
            and (min-device-width : 768px) 
            and (max-device-width : 1024px) {
            body{ background-color: #000;}
            }
            .ui-widget-header{ border: 1px solid #f74623;border-radius: 0px;background: #ff6446; }
            .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{
                border: 1px solid #f7bbb0;
                background: #f7bbb0;
                color: #000000;
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
            <!--########################### HEADER STARTS HERE ###############################################################--->
            <?php $this->load->view('header'); ?>
            <!--############################ HEADER ENDS HERE ##############################################################--->
            <div class="container-fluid bod_bac pad0">
            <div id="page-wrapper">
                <!--#########################  MIDDLE PART STARTS ######################################-->
                <!--############################## Error Messages Div ################################################-->
                <div class="alert alert-danger alert-dismissable fade in" id='error_message' style='display:none;position:fixed;top:0;width:95%;z-index:100;font-size: 17px;text-align: center;'>
                    <a href="javascript:;" class="close" onclick="$('#error_message').hide();" aria-label="close">&times;</a>
                    <span id='show_message'></span>
                </div>
                <!--##############################################################################-->
                <div class="full-width" id="search1">
                    <div class="container">
                        <!-- Tab panes --><div class="full-width" id="search">
                            <ul class="col-md-8 nav nav-tabs">
                                <li class="active" style="padding-left:0px;"><a data-toggle="tab" href="#flights"><i class="fa fa-fighter-jet" aria-hidden="true" style="    padding-right: 7px;"></i>Flights</a></li>
                                <li><a data-toggle="tab" href="#hotels"><i class="fa fa-bed" aria-hidden="true"style="padding-right: 7px;"></i>Hotels</a></li>
                                <li><a data-toggle="tab" href="#activity"><i class="fa fa-camera" aria-hidden="true"style="padding-right: 7px;"></i>Attractions</a></li>     
                                <li><a data-toggle="tab" href="#packages"><i class="fa fa-suitcase" aria-hidden="true"style="padding-right: 7px;"></i>Packages</a></li>
                            </ul>
                            <div class="col-md-8 tab-content" style="padding-bottom:55px; padding-top:10px;">
                                <div role="tabpanel" class="tab-pane active" id="flights">
                                    <form id="flight_frm" action="<?php echo site_url(); ?>/flightbeta/search" method="GET">
                                        <div class="col-md-12">
                                            <h2 class="mar_10">Search for Flight</h2>
                                        </div><div class="col-md-12">
                                            <h4 style=" color:#FFF;"></h4>
                                        </div>
                                        <div class="col-sms-6 col-sm-6 col-md-3 pad_right0" style="width: 180px;">
                                            <div class="radio" style=" padding: 0px 0px 13px 0px;">
                                                <label><input type="radio" name="journey_type" id="one_way" value="one_way" checked="checked" tabindex="1" onclick="hideShowRoundTrip();" style="    width: 16%;height: 2em;"> <span class="rad_po"> One way<span> </label>
                                            </div>
                                        </div>
                                        <div class="col-sms-6 col-sm-6 col-md-3 pad_right0 pad_left0" style="width: 180px;">
                                            <div class="radio" style=" padding: 0px 0px 13px 0px;">
                                                <label><input type="radio" name="journey_type" id="round_trip" value="round_trip" tabindex="2" onclick="hideShowRoundTrip();" style="    width: 16%;height: 2em;"> <span class="rad_po">Round trip</span> </label>
                                            </div>
                                        </div>

                                        <div style="clear:both;"></div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>From</label> 
                                                <input type="text" name="from" id="flFrom" class="form-control " placeholder="Type atleast 3 letters" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>To</label>
                                                <input type="text" name="to" id="flTo" class="form-control " placeholder="Type atleast 3 letters" >
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Depart on</label>
                                                <input type="text" class="form-control " id="flSd" name="sd" placeholder="Departure date" style="background: #ffffff;" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="ReturnDateContainer" style="display:none;">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Return on</label>
                                                <input type="text" class="form-control " id="flEd" name="ed" placeholder="Return date" style="background: #ffffff;" readonly>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Adults</label> 
                                                <select class="form-control" name="fl_adult" id="s1" >
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Children</label>
                                                <div class="span2" style="visibility: visible;" id="child">
                                                    <select class="form-control" name="fl_child" id="s2" style="visibility: visible;">
                                                        <option value="0" selected="selected">0</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Infants</label>
                                                <select class="form-control" name="fl_infant" id="s3">
                                                    <option value="0" selected="selected">0</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div style=" clear:both;"></div>

                                        <div class="col-md-12">
                                            <div style="border-bottom:1px solid #EDEDED; margin-bottom:10px;"></div>
                                        </div>
                                        <div class="col-md-12" id="fl_more_opt" style="cursor:pointer;">
                                            <span class="glyphicon glyphicon-triangle-bottom" style="color: #f74624;margin-right: 1px;"></span>
                                            <span style="font-size: 12px;font-weight: bold;color: #f18181;">Show More Options</span>
                                            <span style="font-size: 11px;">( Preferred Airline, Class, Senior Citizen ) </span>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px;">
                                            <div style="border-bottom:1px solid #EDEDED; margin-bottom:10px;"></div>
                                        </div>
                                        <div id="fl_more_options" style="display:none;">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Preferred Airline</label>
                                                    <input type="text" name="pref_air" value='' id="pref_air" class="form-control " placeholder="Type atleast three letters" >
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Class</label>
                                                    <select class="form-control" name="fl_class">
                                                        <option value="A">All</option>
                                                        <option value="E">Economy</option>
                                                        <option value="B">Business</option>
                                                        <option value="F">First Class</option>
							<option value="ECONOMY_FULL">Economy Full</option>
							<option value="ECONOMY_PREMIUM">Economy Premium</option>
							<option value="REFUNDABLE">Refundable</option>
							<option value="OTHERS">Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                              <div class="form-group">
                                                                <label>Route</label>
                                                                <select name="route" class="form-control">
                                                                    <option value="ALL">All</option>
  <option value="DIRECT">Direct</option>
   <option value="DIRECT_NONSTOP">Direct non-stop</option>
    <option value="SINGLE_CONNECTING">Single Connecting</option>
                                                                     </select>
                                                            </div>
                                                                </div>
                                            <div class="col-md-3" id="sr_ctzn_div" style="display:none">
                                                <label>&nbsp;</label>
                                                <div class="form-group">
                                                    <input type="checkbox" value="None" name="senior_ctzn" id="senior_ctzn" style="width: 20px;height: 20px;" />
                                                    <label>Senior Citizen</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="submit" class="btn btn-primary pull-right" value="Search flights" title="Search flights" onclick="return chkValidateFlight();">
                                        </div>
                                        <div style=" clear:both;"></div>
                                    </form>
                                </div>


                                <div role="tabpanel" class="tab-pane" id="hotels">
                                    <form name="hotel_frm" method="GET" action="<?php echo site_url(); ?>/hotel/search">
                                        <div class="col-md-12">
                                            <h2 class="mar_10">Search for Hotels</h2>
                                        </div>
                                        <div class="col-md-12">
                                            <h4 style=" color:#A0A0A0;"></h4>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label>Destination</label> 
                                                <input type="text" name="cityval" id="hotel_dest" class="form-control"  placeholder="Enter the city,area, landmark,or hotel" required>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label >Check in</label> 
                                                <input type="text" name="hotel_sd" id="hotel_sd" class="form-control" placeholder="Date" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Check out</label>
                                                <input type="text" name="hotel_ed" id="hotel_ed" class="form-control" placeholder="Date" required>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="col-sms-6 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label >Rooms</label> 
                                                <select class="form-control" name="room_count" onchange="show_room_info(this.value)" required>
                                                    <option value="1">1 room</option>
                                                    <option value="2">2 room</option>
                                                    <option value="3">3 room</option>
                                                    <option value="4">4 room</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="room_info">
                                            <div class="col-sms-6 col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    <label>Adult</label> 
                                                    <select class="form-control" name="adult[]">
                                                        <option value="1" selected="selected">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sms-6 col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    <label>Child</label>
                                                    <select class="form-control" name="child[]" onChange="show_child_age_info(this.value, '0')"  required>
                                                        <option value="0" selected="selected">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="child_age0">

                                            </div> 
                                            <div style="clear:both;"></div>
                                        </div>      
                                        <input type="hidden" name="num_nights" id="num_nights" class="form-control nights-count " placeholder="" readonly="true">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label >Nationality</label> 
                                                <select class="form-control" name="nationality"  required>
                                                    <?php if($nationality != ''){ ?>
                                                    <?php foreach($nationality as $nation){ ?>
                                                    <option value="<?php echo $nation->code; ?>" <?php echo($nation->code == 'PH' ? 'selected="selected"':''); ?>><?php echo $nation->name; ?></option>
                                                    <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <!--                                        <button type="button" class="btn btn-primary pull-right">Search</button>-->

                                            <input type="submit" name="submit" value="Search" class="btn btn-primary pull-right" onclick="return chkValidateHotel();">
                                        </div>
                                    </form>   
                                </div>
                                
                                <div role="tabpanel" class="tab-pane" id="packages">
                                    <form name="hotel_frm" method="GET" action="<?php echo site_url(); ?>/activity/search">
                                        <div class="col-md-12">
                                            <h2 class="mar_10">Search best Packages</h2>
                                        </div>
                                        <div class="col-md-12">
                                            <h4 style=" color:#A0A0A0;"></h4>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label>Destination</label> 
                                                <input type="text" name="act_city" id="act_city" class="form-control"  placeholder="Enter the city, destination" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3" style="margin-top: 3.5%;">
                                            <input type="submit" name="submit" value="Search" class="btn btn-primary pull-right">
                                        </div>
                                    </form>   
                                </div>
                                <div role="tabpanel" class="tab-pane active" id="activity">
                                    <form name="hotel_frm" method="GET" action="http://redtagtravels.com/agent/index.php/activity/search">
                                        <div class="col-md-12">
                                            <h2 class="mar_10">Search best Attractions</h2>
                                        </div>
                                        <div class="col-md-12">
                                            <h4 style=" color:#A0A0A0;"></h4>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label>Destination</label> 
                                                <input type="text" name="act_city" id="act_city" class="form-control ui-autocomplete-input" placeholder="Enter the city, destination" required="" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-3" style="margin-top: 3.5%;">
                                            <input type="submit" name="submit" value="Search" class="btn btn-primary pull-right">
                                        </div>
                                    </form>   
                                </div>



                            </div>                           
                        </div>
                    </div>  
                </div>
                <!--#########################  MIDDLE PART STARTS ######################################-->
            </div>
            </div>
            <!-- /#page-wrapper -->
            <!--######################### FOOTER STARTS HERE #################################################################--->
            <?php $this->load->view('footer'); ?>
            <!--######################### FOOTER ENDS HERE #################################################################--->
        </div>
        <!--######################### Senior Citizen Popup Text #################################################################--->
        <div id="srCitizen" class="modal fade" role="dialog" style="top:36px;">
            <div class="modal-dialog" style="width: 65%;">
                <!-- Modal content-->
                <div class="modal-content" style="border-radius: 0px;border-top: 3px solid #f74623;border-bottom: 3px solid #f74623;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <span class="modal-title" style="font-size:16px;font-weight:bold">Senior Citizen Important Message</span>
                    </div>
                    <div class="modal-body" style="padding-left:0px;">
                        <p style="padding-left: 30px;font-size: 17px;font-weight:bold;">All senior citizen booking should be individually made.</p>
                        <br />
                        <p style="padding-left: 30px;font-size: 17px;">
                            In the availment of the 20% discount privilege, Senior Citizen passenger(s) must present the valid OSCA (Philippines) ID to the issuing Travel agency to be examined for authenticity prior issuance. Transactions identified as FRAUD shall not be honoured by Airport Services. Passenger(s) and/or Travel agent(s) involved shall be required to purchase new ticket, and may be subject to administrative query and/or Airline Debit memo (ADM) to recover the discount erroneously applied upon booking confirmation. VIA Philippines will not be held liable for any issues concerning the authenticity/validity of the document, which may occur after ticket issuance.
                        </p>
                    </div>
                    <div class="modal-footer" style="border:0px;"></div>
                </div>

            </div>
        </div>
        <!--######################### Senior Citizen Popup Text #################################################################--->
    </body>
    <!--################### JS FILES STARTS ################################################-->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/common.js"></script>
    <!--################### JS FILES ENDS ################################################-->
<script type="text/javascript">
var s1 = document.getElementById("s1");
var s2 = document.getElementById("s2");
var s3 = document.getElementById("s3");
onchange_comb(); //Change options after page load
s1.onchange = onchange_comb; // change options when s1 is changed
function onchange_comb()
{
    if (s1.value == '9') {
        s2.style.visibility = 'hidden';
        child.style.visibility = 'hidden';
    } else {
        s2.style.visibility = 'visible';
        child.style.visibility = 'visible';
    }

    <?php foreach ($adult_arr as $sa) { ?>
        if (s1.value == '<?php echo $sa; ?>') {
            option_html = "";
    <?php if (isset($adult_arr1[$sa])) { ?> // Make sure position is exist
        <?php foreach ($adult_arr1[$sa] as $value) { ?>
                            option_html += "<option><?php echo $value; ?></option>";
        <?php } ?>
    <?php } ?>
            s2.innerHTML = option_html;
        }
    <?php } ?>

    <?php foreach ($adult_arr as $sa) { ?>
        if (s1.value == '<?php echo $sa; ?>') {
            option_html = "";
            // Make sure position is exist
    <?php foreach ($adult_arr2[$sa] as $value) { ?>
                        option_html += "<option><?php echo $value; ?></option>";
    <?php } ?>

            s3.innerHTML = option_html;
        }
    <?php } ?>
}


</script>
</html>
