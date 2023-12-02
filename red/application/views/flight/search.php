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
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo Site_Title; ?></title>
        <meta name="viewport" content="width=device-width, intial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
        <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/styles.css" type="text/css" rel="stylesheet" media="all">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awsm/css/font-awesome.min.css">
        <link id="main-style" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/search.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/responsive.css">
        

        <!-- CSS for IE -->
        <!--[if lte IE 9]>
            <link rel="stylesheet" type="text/css" href="css/ie.css" />
        <![endif]-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script type='text/javascript' src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
          <script type='text/javascript' src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
        <![endif]-->
        
        <style type="text/css">
            .ui-datepicker{left:97.5px !important;}
            .ui-menu .ui-menu-item{ padding:0px 0 4px 0;}
            .ui-menu-item-wrapper{padding-left:8px;}
            .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
                border: 1px solid #aaaaaa;
                font-weight: normal;
                color: #ffffff;
                background:none;
                background-color: #f74623 !important;
                padding: 7px;
            }
            .ui-menu{
                left: 93.5px !important;
                width: 20% !important;
            }
            input.input-text, textarea, span.custom-select{padding-left: 4px;
            padding-right: 6px;
            height: 34px;
            font-size: 13px;}
            .ui-slider .ui-slider-range{background: #f74623;border:0px;}
            .ui-widget-header{ border: 1px solid #f74623;border-radius: 0px;background: #ff6446; }
            .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{
                border: 1px solid #f7bbb0;
                background: #f7bbb0;
                color: #000000;
            }
        </style>
    </head>
    <body>
        <?php $this->load->view('header'); ?>
        <div class="full-width bgGrey">
            <div class="container sort-by-section">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                        	<div class="col-sm-6 searchData"><?php echo $searchData['from']; ?> - <?php echo $searchData['to'] ?></div>
	                        <div class="col-sm-6">
	                            <span style="font-size:16px;font-family: georgia; font-size: 15px;">Depart :</span> <?php echo date('D, d M, Y', strtotime($searchData['sd'])); ?>&nbsp;, &nbsp;&nbsp;
	                            
	                            <?php if ($searchData['journey_type'] == 'round_trip'){ ?>
	                            <span style="font-size:18px;font-family: georgia; font-size: 15px;">Return : </span> <?php echo date('D, d M, Y', strtotime($searchData['ed'])); ?>&nbsp;, &nbsp;&nbsp;
	                            <?php } ?>
	                            
	                            <span style="font-size:18px;font-family: georgia; font-size: 15px;">Journey Type : </span>
	                            
	                            <?php 
	                                if ($searchData['journey_type'] == 'one_way') {
	                                    echo 'One Way';
	                                } else {
	                                    echo 'Round Trip';
	                                } 
	                            ?>
	                            </div>
	                        </div>
                    </div>
                </div>
            </div>
            <div id="page-wrapper">
                <section id="content">
                    <div class="container">
                        <div id="main">
                            <div class="row">
                                <div class="col-sm-4 col-md-3" style="padding-left:0px;">
                                    <div class="toggle-container filters-container">
                                        
                                        <div class="panel style1 arrow-right">
                                            <h4 class="search-results-title"><span class="glyphicon glyphicon-search" style="color: #f74623;"></span>&nbsp;&nbsp;<b><span id="count_progress"></span></b><span id="flight_found" style="display:none;font-family: rome;"></span><span id='srch_txt' style='display:none;'> Flights Found.</span><img src="<?php echo base_url(); ?>assets/images/small_loader.gif" id="small_progress"></h4>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" style="font-family: georgia;" href="#modify-search-panel" class="collapsed">Modify Your Search</a>
                                            </h4>
                                            
                                            <div id="modify-search-panel" class="panel-collapse collapse">
                                                <div class="alert alert-danger alert-dismissable fade in" id='error_message' style='display:none;position:fixed;top:0;width:100%;z-index:100;font-size: 17px;text-align: center;'>
                                                    <a href="javascript:;" class="close" onclick="$('#error_message').hide();" aria-label="close">&times;</a>
                                                    <span id='show_message'></span>
                                                </div>
                                                <div class="panel-content" style="background-color: #ffffff;height:auto">
                                                    <form id="flight_frm" errorblkid="homeErrorMessage" action="<?php echo site_url(); ?>/flight/search" method="GET" >
                                                        <div class="form-group">
                                                            <label style="width:46%;float:left;"><input type="radio" name="journey_type" id="one_way" value="one_way" onclick="checkReturnModifyFlight();" <?php echo($searchData['journey_type'] == 'one_way' ? 'checked' : '') ?> ><span style='padding-left: 5px;'>Oneway</span></label>
                                                            &nbsp;&nbsp;&nbsp;
                                                            <label style="width:46%;float:left;"><input type="radio" name="journey_type" id="round_trip" value="round_trip" onclick="checkReturnModifyFlight();" <?php echo($searchData['journey_type'] == 'round_trip' ? 'checked' : '') ?> ><span style='padding-left: 5px;'>Round Trip</span></label>
                                                            &nbsp;&nbsp;&nbsp;
                                                        </div>
                                                        <div class="form-group">
                                                            <label>From</label>
                                                            <input type="text" class="input-text full-width" name="from" id="flFrom" placeholder="" value="<?php echo $searchData['from'].','.$searchData['fromCode']; ?>" required/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>To</label>
                                                            <input type="text" class="input-text full-width" name="to" id="flTo" placeholder="" value="<?php echo $searchData['to'].','.$searchData['toCode']; ?>" required/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Departure on</label>
                                                            <div>
                                                                <input type="text" class="input-text full-width" id="datepickerModFlOw" name="sd" placeholder="yyyy-mm-dd" value="<?php echo $searchData['sd']; ?>" readonly required/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group" id="ReturnDateContainer" <?php echo($searchData['journey_type'] == 'round_trip' ? 'style="display:block;"' : 'style="display:none;"'); ?>>
                                                            <label>Arriving On</label>
                                                            <div>
                                                                <input type="text" class="input-text full-width" id="datepickerModFlRt" name="ed" placeholder="yyyy-mm-dd" value="<?php echo($searchData['journey_type'] == 'round_trip' ? $searchData['ed'] : ''); ?>" readonly required/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group" style="margin-bottom: 35px;">
                                                            <div style="width:33%; float:left;">
                                                                <label>Adult</label>
                                                                <div>
                                                                    <select name="fl_adult" id="s1" style="width: 90%;">
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
                                                            <div style="width:33%; float:left;">
                                                                <label>Child</label>
                                                                <div id="child">
                                                                    <select name="fl_child" id="s2" style="width: 90%;">
                                                                        <option value="0" selected="selected">0</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div style="width:33%; float:left;">
                                                                <label>Infant</label>
                                                                <div>
                                                                    <select name="fl_infant" id="s3" style="width: 100%;">
                                                                        <option value="0" selected="selected">0</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style='clear:both;'></div>
                                                        <div id="fl_more_opt" style="cursor:pointer;padding-top: 10px;">
                                                            <span class="glyphicon glyphicon-triangle-bottom" style="color: #f74624;margin-right: 1px;"></span>
                                                            <span style="font-size: 12px;font-weight: bold;color: #f18181;">Show More Options</span><br />
                                                            <span style="font-size: 11px;">( Preferred Airline, Class, Senior Citizen ) </span>
                                                        </div>
                                                        <div style="margin-top: 10px;">
                                                            <div style="border-bottom:1px solid #EDEDED; margin-bottom:10px;"></div>
                                                        </div>
                                                        <div id="fl_more_options" style="display:none;">
                                                            <div class="form-group">
                                                                <label>Preferred Airline</label>
                                                                <input type="text" name="pref_air" value='' id="pref_air" class="input-text full-width" placeholder="Type atleast three letters" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Class</label>
                                                                <select name="fl_class" style="width: 100%;">
                                                                    <option value="A">All</option>
                                                                    <option value="E">Economy</option>
                                                                    <option value="B">Business</option>
                                                                    <option value="F">First Class</option>
                                                                </select>
                                                            </div>
                                                            <?php if(trim($searchData['fromCountry']) == 'Philippines' && trim($searchData['toCountry']) == 'Philippines'){ ?>
                                                            <div id="sr_ctzn_div">
                                                                <div class="form-group">
                                                                  <input type="checkbox" value="None" name="senior_ctzn" id="senior_ctzn" style="width: 20px;height: 20px;" />
                                                                  Senior Citizen
                                                                </div>
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="clear"></div>
                                                        <div style="margin-bottom: 35px;margin-right: 62px;">								
                                                            <input type="submit" tabindex="11" class="btn btn-default pull-right" value="Search flights" title="Search flights" onclick="return chkValidateModifyFlight();" style="background: #f74623; color:#fff;">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#price-filter" class="collapsed"><?php echo($searchData['journey_type'] != 'one_way' && $searchData['fromCountry'] == $searchData['toCountry']?'Onward ':''); ?>Price</a>
                                            </h4>
                                            <div id="price-filter" class="panel-collapse collapse">
                                                <div class="panel-content">
                                                    <span id="priceSliderOutput" style="font-weight: normal; margin:10px 0px 0px 15px; font-size: 15px;"></span>
                                                    <div style="padding:10px 0px 0px 0px; margin: 0px;">
                                                        <div id="priceSlider" style="width: 234px;">

                                                        </div>
                                                        <input type="hidden" name="minPrice" id="minPrice" class="autoSubmit"  />
                                                        <input type="hidden" name="maxPrice" id="maxPrice" class="autoSubmit"  />
                                                    </div>
                                                </div><!-- end content -->
                                            </div>
                                        </div>
                                        <?php if($searchData['journey_type'] != 'one_way' && $searchData['fromCountry'] == $searchData['toCountry']){ ?>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#Rprice-filter" class="collapsed">Return Price</a>
                                            </h4>
                                            <div id="Rprice-filter" class="panel-collapse collapse">
                                                <div class="panel-content">
                                                    <span id="RpriceSliderOutput" style="font-weight: normal; margin:10px 0px 0px 15px; font-size: 15px;"></span>
                                                    <div style="padding:10px 0px 0px 0px; margin: 0px;">
                                                        <div id="RpriceSlider" style="width: 234px;">

                                                        </div>
                                                        <input type="hidden" name="RminPrice" id="RminPrice" class="autoSubmit"  />
                                                        <input type="hidden" name="RmaxPrice" id="RmaxPrice" class="autoSubmit"  />
                                                    </div>
                                                </div><!-- end content -->
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#flight-stops-filter" class="collapsed"><?php echo($searchData['journey_type'] != 'one_way' && $searchData['fromCountry'] == $searchData['toCountry']?'Onward ':''); ?> Stops</a>
                                            </h4>
                                            <div id="flight-stops-filter" class="panel-collapse collapse">
                                                <div class="panel-content">
                                                    <ul class="check-square filters-option">
                                                        <li style="width: 100%;padding: 7px 0 5px 15px;"><input type="checkbox" class='stop_filter' name="stops" value="0" onclick="filter();" checked>Non Stop</a></li>
                                                        <li style="width: 100%;padding: 7px 0 5px 15px;"><input type="checkbox" class='stop_filter' name="stops" value="1" onclick="filter();" checked>1 Stop</a></li>
                                                        <li style="width: 100%;padding: 7px 0 5px 15px;"><input type="checkbox" class='stop_filter' name="stops" value="2" onclick="filter();" checked>2 Stops</a></li>
                                                        <li style="width: 100%;padding: 7px 0 5px 15px;"><input type="checkbox" class='stop_filter' name="stops" value="3" onclick="filter();" checked>3 Stops</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if($searchData['journey_type'] != 'one_way' && $searchData['fromCountry'] == $searchData['toCountry']){ ?>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#Rflight-stops-filter" class="collapsed">Return Stops</a>
                                            </h4>
                                            <div id="Rflight-stops-filter" class="panel-collapse collapse">
                                                <div class="panel-content">
                                                    <ul class="check-square filters-option">
                                                        <li style="width: 100%;padding: 7px 0 5px 15px;"><input type="checkbox" class='Rstop_filter' name="Rstops" value="0" onclick="filter_round();" checked>Non Stop</a></li>
                                                        <li style="width: 100%;padding: 7px 0 5px 15px;"><input type="checkbox" class='Rstop_filter' name="Rstops" value="1" onclick="filter_round();" checked>1 Stop</a></li>
                                                        <li style="width: 100%;padding: 7px 0 5px 15px;"><input type="checkbox" class='Rstop_filter' name="Rstops" value="2" onclick="filter_round();" checked>2 Stops</a></li>
                                                        <li style="width: 100%;padding: 7px 0 5px 15px;"><input type="checkbox" class='Rstop_filter' name="Rstops" value="3" onclick="filter_round();" checked>3 Stops</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#airlines-filter" class="collapsed"><?php echo($searchData['journey_type'] != 'one_way' && $searchData['fromCountry'] == $searchData['toCountry']?'Onward ':''); ?> Airlines</a>
                                            </h4>
                                            <div id="airlines-filter" class="panel-collapse collapse">
                                                <div class="panel-content">
                                                    <ul class="check-square filters-option" id="airline_list"></ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if($searchData['journey_type'] != 'one_way' && $searchData['fromCountry'] == $searchData['toCountry']){ ?>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#Rairlines-filter" class="collapsed">Return Airlines</a>
                                            </h4>
                                            <div id="Rairlines-filter" class="panel-collapse collapse">
                                                <div class="panel-content">
                                                    <ul class="check-square filters-option" id="Rairline_list"></ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <!--############################## AJAX LODER MIDDLE PART  #####################################--->
                                <div id="result">
                                    <div id="progressbar" style="margin-top:111px;">
                                        <img src="<?php echo base_url(); ?>assets/images/loader.gif" style="margin-left: 325px;"><br />
                                        <div style="margin-left: 570px;font-weight: bold;font-size: 24px;margin-top: 30px;">Searching For Flights</div>
                                    </div>
                                </div>
                                <!--############################## AJAX LODER MIDDLE PART  #####################################--->
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!--################### FLIGHT DETAILS WINDOW POPUP ##################-->
        <div id="show_flight_details_window" class="modal fade" role="dialog" style="top:36px;">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style="border-radius: 0px;border-top: 3px solid #f74623;border-bottom: 3px solid #f74623;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <span class="modal-title" style="font-size:16px;font-weight:bold">Flight Details</span>
                    </div>
                    <div class="modal-body" style="padding-left:0px;"></div>
                    <div class="modal-footer" style="border:0px;"></div>
                </div>

            </div>
        </div>
        <!--##################################################################-->
        <?php $this->load->view('footer'); ?>

         <!-- Modal -->
<div class="modal fade" id="flightFareModal" tabindex="-1" role="dialog" aria-labelledby="flightFareModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="flightFareModalLabel">Detailed Information</h4>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
<!-- Modal -->

    </body>
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/common.js"></script>
    <?php if($searchData['journey_type'] != 'one_way' && $searchData['fromCountry'] == $searchData['toCountry']){ ?>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/filters/flight/round_filter.js"></script>
    <?php } else { ?>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/filters/flight/round_filter.js"></script>
    <?php } ?>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/filters/flight/sorting.js"></script>
    <script type="text/javascript">


    //FARE RULE DIAPLAY CODE BY VEERA
    function show_fare_popup(id,el,elm){
       
      
      var formData = { fare_key: id,elm:elm };


      $.ajax({
                url : "fareRulesRetrive",
                dataType : 'json',
                type : 'POST',
                data : formData,
                beforeSend: function() { 
                    $(el).append('<img class="loading" src="http://ticketfinder.nl/assets/images/ajax_loader1.gif" style="height:20px;"></img>');
      $("#flightFareModal .modal-body").html('<img class="loading" src="http://ticketfinder.nl/assets/images/ajax_loader1.gif" style="height:30px;"></img>');
                 },
                success : function(response){
                   if(response){
  var div1 = '<div>';
  console.log(response);
 
$.each((response.fareRules),function(ky,val){
  
      div1 += '<div class="" >'+val.rules+'</div>  ';
     });
           
       
          div1 += '</div>';
       
          $("#flightFareModal .modal-body").html('');
          $("#flightFareModal .modal-body").append(div1);
         
          $('#flightFareModal').modal('show');
          $(el).find('img').empty();
          $(el).find('img').remove();
        }else{
          $("#flightFareModal .modal-body").html('');
          $("#flightFareModal .modal-body").append('<div align="center">No Results Found</div>');
        }
                }
               
            });

      
    }
//FARE RULE DIAPLAY CODE BY VEERA

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
        
        
        $(document).ready(function ()
        {
            var api_array = <?php echo json_encode($api_array); ?>;
            var successHandler = function (data) {
                $('#progressbar').hide();
                $('#small_progress').hide();
                $('#result').append(data.flight_search_result);
                $('#count_progress').html(data.flight_count);
                $('#flight_found').show();
                $('#srch_txt').show();
              
                $('#stops').html(data.stops);
                if(data.flag == 'filter'){
                  
                    setPriceSlider();
                } else {

                    setPriceSlider();
                    setPriceSlider_round();
                }

            }
            // these will basically all execute at the same time:
            for (var i = 0, l = api_array.length; i < l; i++){
                $.ajax({
                    url: Site_Url + '/flight/getSearchData/' + api_array[i],
                    data: 'searchId=1',
                    dataType: 'json',
                    type: 'get',
                    beforeSend: function (){
                        $('#progressbar').show();
                        $('#small_progress').show();
                    },
                    success: successHandler
                });
            }
        });
        
    </script>
    <script>
        $(document).ready(function () {
            $("[rel='tooltip']").tooltip();
            $('.thumbnail').hover(
                    function () {
                        $(this).find('.caption').slideDown(250); //.fadeIn(250)
                    },
                    function () {
                        $(this).find('.caption').slideUp(250); //.fadeOut(205)
                    }
            );
        });
    </script>
</html>

