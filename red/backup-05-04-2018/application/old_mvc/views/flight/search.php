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
        </style>
    </head>
    <body>
        <?php $this->load->view('header'); ?>
        <div class="full-width" style="padding: 10px;">
            <div class="container sort-by-section" style="padding-top:15px;">
                <div class="row">
                    <div class="col-md-12">
                        <div style="font-size: 15px;color: rgb(119, 118, 118); width:100%; float:left; padding-bottom:14px;"><div style="font-size:16px;font-family: georgia; font-weight: 700px;color:#545454; width:50%; float:left;padding-right:7px;"><?php echo $searchData['from']; ?> - <?php echo $searchData['to'] ?></div>
                        <div style=" width:50%; float:left;">
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
                                            <h4 class="search-results-title"><span class="glyphicon glyphicon-search" style="color: #f74623;"></span>&nbsp;&nbsp;<b><span id="count_progress"></span></b><span id="flight_found" style="display:none;font-family: rome;"> Flights Found.</span><img src="<?php echo base_url(); ?>assets/images/small_loader.gif" id="small_progress"></h4>
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
                                                <div class="panel-content" style="background-color: #ffffff;">
                                                    <form id="flight_frm" errorblkid="homeErrorMessage" action="<?php echo site_url(); ?>/flight/search" method="GET" >
                                                        <div class="form-group">
                                                            <label style="width:46%;float:left;"><input type="radio" name="journey_type" id="one_way" value="one_way" onclick="checkReturnModifyFlight();" <?php echo($searchData['journey_type'] == 'one_way' ? 'checked' : '') ?> style="width: 16%;height: 2em;"><span class="span_text">Oneway</span></label>
                                                            &nbsp;&nbsp;&nbsp;
                                                            <label style="width:46%;float:left;"><input type="radio" name="journey_type" id="round_trip" value="round_trip" onclick="checkReturnModifyFlight();" <?php echo($searchData['journey_type'] == 'round_trip' ? 'checked' : '') ?> style="width: 16%;height: 2em;"><span class="span_text">Round Trip</span></label>
                                                            &nbsp;&nbsp;&nbsp;
                                                        </div>
                                                        <div class="form-group">
                                                            <label>From</label>
                                                            <input type="text" class="input-text full-width" name="from" id="flFrom" placeholder="" value="<?php echo $searchData['from']; ?>" required/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>To</label>
                                                            <input type="text" class="input-text full-width" name="to" id="flTo" placeholder="" value="<?php echo $searchData['to']; ?>" required/>
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
                                                        <br />
                                                        <br/>
                                                        <br/>
                                                        <div class="clear"></div>
                                                        <div style="margin-bottom: 25px;margin-right: 62px;">								
                                                            <input type="submit" tabindex="11" class="btn btn-default pull-right" value="Search flights" title="Search flights" onclick="return chkValidateModifyFlight();" style="background: #f74623; color:#fff;">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#price-filter" class="collapsed">Price</a>
                                            </h4>
                                            <div id="price-filter" class="panel-collapse collapse">
                                                <div class="panel-content">
                                                    <span id="priceSliderOutput" style="font-weight: normal; margin:10px 0px 0px 25px; font-size: 13px;"></span>
                                                    <div style="padding:10px 0px 0px 5px; margin: 0px;">
                                                        <div id="priceSlider" style="width:175px">

                                                        </div>
                                                        <input type="hidden" name="minPrice" id="minPrice" class="autoSubmit"  />
                                                        <input type="hidden" name="maxPrice" id="maxPrice" class="autoSubmit"  />
                                                    </div>
                                                </div><!-- end content -->
                                            </div>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#flight-stops-filter" class="collapsed">Flight Stops</a>
                                            </h4>
                                            <div id="flight-stops-filter" class="panel-collapse collapse">
                                                <div class="panel-content">
                                                    <ul class="check-square filters-option">
                                                        <li style="width: 100%;padding: 7px 0 5px 15px;"><input type="checkbox" name="stops" value="1">1 Stop</a></li>
                                                        <li style="width: 100%;padding: 7px 0 5px 15px;"><input type="checkbox" name="stops" value="2">2 Stop</a></li>
                                                        <li style="width: 100%;padding: 7px 0 5px 15px;"><input type="checkbox" name="stops" value="3">3 Stop</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#airlines-filter" class="collapsed">Airlines</a>
                                            </h4>
                                            <div id="airlines-filter" class="panel-collapse collapse">
                                                <div class="panel-content">
                                                    <ul class="check-square filters-option" id="airline_list"></ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#flight-times-filter" class="collapsed">Flight Times</a>
                                            </h4>
                                            <div id="flight-times-filter" class="panel-collapse collapse">
                                                <div class="panel-content">
                                                    <div id="flight-times" class="slider-color-yellow"></div>
                                                    <br />
                                                    <span class="start-time-label pull-left"></span>
                                                    <span class="end-time-label pull-right"></span>
                                                    <div class="clearer"></div>
                                                </div><!-- end content -->
                                            </div>
                                        </div>
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
            <div class="modal-dialog" style="width: 65%;">
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
    </body>
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/common.js"></script>
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
        
        
        $(document).ready(function ()
        {
            var api_array = <?php echo json_encode($api_array); ?>;
            var successHandler = function (data) {
                $('#progressbar').hide();
                $('#small_progress').hide();
                $('#result').append(data.flight_search_result);
                $('#count_progress').html(data.flight_count);
                $('#flight_found').show();
                $('#airline_list').html(data.airlines);
                $('#stops').html(data.stops);

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

