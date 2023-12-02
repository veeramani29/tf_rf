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
    </head>
    <body>
        <div id="wrapper">
            <?php $this->load->view('header'); ?>
            <!-- Navigation -->
            <?php $this->load->view('left_panel'); ?>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Manage Markup</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row" style="margin-bottom:10px;">
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs" style="margin-left:0px;">
                        <li class="active"><a data-toggle="tab" href="#flightMarkup">Flight</a></li>
                        <li><a data-toggle="tab" href="#hotelMarkup">Hotel</a></li>
<!--                        <li><a data-toggle="tab" href="#carMarkup">Car</a></li>
                        <li><a data-toggle="tab" href="#sightseeingMarkup">Sightseeing</a></li>-->
                        </ul>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12 tab-content">
                        <div id="flightMarkup" class="panel panel-default tab-pane fade in active">
                            
                            <div class="panel-heading">
                                Update Flight Markup
                            </div>
                            <div id="flMarkup_error" style="display:none;">
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Oops!</strong> <span id="flMarkup_error_text"></span>
                                </div>
                            </div>
                            <div id="flMarkup_success" style="display:none;">
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Success!</strong> <span id="flMarkup_success_text"></span>
                                </div>
                            </div>
                            <form name="fl_markup_add" id="fl_markup_add">
                            <div class="col-sm-5" style="margin-top: 23px;margin-left: 15px;">
                                <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                    <label>Select Markup Type</label>
                                    <select class="form-control" name="flight_markup_type" id="flight_markup_type" style="padding-top: 0;padding-bottom: 0;height: 41px;" required="">
                                        <option value="fixed" <?php echo($fl_markup_data != '' && $fl_markup_data->markup_type == 'fixed' ? 'selected="selected"':''); ?>>Fixed Amount</option>
                                        <option value="percent" <?php echo($fl_markup_data != '' && $fl_markup_data->markup_type == 'percent' ? 'selected="selected"':''); ?>>Percentage</option>
                                    </select>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                            <div class="panel-heading fl_mark_head" style="font-weight:bold;">
                                Domestic Flight Markup( Within Philippines )
                            </div>
<!--                            <div class="panel-body">
                                <div class="col-sm-5">
                                    <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                        <label>Domestic Flights ( within Saudi Arab )</label>
                                        <input type="text" class="form-control" name="gen_dom_fl_markup" id="gen_dom_fl_markup" value="<?php echo($fl_markup_data != ''?$fl_markup_data->dom_markup:'0'); ?>" onkeypress="return restrictCharacters(this, event, decimalOnly);" value="">
                                        <span style="color:red;font-size: 11px;" id="mobile_number_error"></span>
                                    </div>
                                    <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                        <label>International Flights</label>
                                        <input type="text" class="form-control" name="gen_intl_fl_markup" id="gen_intl_fl_markup" value="<?php echo($fl_markup_data != ''?$fl_markup_data->intl_markup:'0'); ?>" onkeypress="return restrictCharacters(this, event, decimalOnly);" value="">
                                        <span style="color:red;font-size: 11px;" id="mobile_number_error"></span>
                                    </div>
                                </div>
                            </div>-->
<!--                            <div class="panel-heading fl_mark_head" >
                                Add Airline Specific Markup  <span style="font-weight:normal;">(Note : If airline markup will be added then the generic markup will not add in the fare of that specific flight.)</span>
                            </div>-->
                            <div class="panel-body">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="flMarkupArlineList">
                                    <thead>
                                        <tr>
                                            <th>Airline Logo</th>
                                            <th>Airline Name</th>
                                            <th>Add Markup Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX">
                                            <td><img src="<?php echo base_url(); ?>assets/images/airlines/2P_small.gif" alt="AirPhilExpress"></td>
                                            <td>AirPhilExpress</td>
                                            <td><input type="text" name="AirPhilExpress" id="AirPhilExpress" value="<?php echo($fl_markup_data!=''?$fl_markup_data->AirPhilExpress:'0'); ?>" class="form-control" style="height: 27px;"></td>
                                        </tr>
                                        <tr class="odd gradeX">
                                            <td><img src="<?php echo base_url(); ?>assets/images/airlines/DG_small.gif" alt="Sea Air"></td>
                                            <td>Sea Air</td>
                                            <td><input type="text" name="SeaAir" id="SeaAir" value="<?php echo($fl_markup_data!=''?$fl_markup_data->SeaAir:'0'); ?>" class="form-control" style="height: 27px;"></td>
                                        </tr>
                                        <tr class="odd gradeX">
                                            <td><img src="<?php echo base_url(); ?>assets/images/airlines/5J_small.gif" alt="CebuPacific"></td>
                                            <td>Cebu Pacific</td>
                                            <td><input type="text" name="CebuPacific" id="CebuPacific" value="<?php echo($fl_markup_data!=''?$fl_markup_data->CebuPacific:'0'); ?>" class="form-control" style="height: 27px;"></td>
                                        </tr>
                                        <tr class="odd gradeX">
                                            <td><img src="<?php echo base_url(); ?>assets/images/airlines/Z2_small.gif" alt="ZestAir"></td>
                                            <td>ZestAir</td>
                                            <td><input type="text" name="ZestAir" id="ZestAir" value="<?php echo($fl_markup_data!=''?$fl_markup_data->ZestAir:'0'); ?>" class="form-control" style="height: 27px;"></td>
                                        </tr>
                                        <tr class="odd gradeX">
                                            <td><img src="<?php echo base_url(); ?>assets/images/airlines/2P_small.gif" alt="Philpines Airline"></td>
                                            <td>Philpines Airline</td>
                                            <td><input type="text" name="PhilpinesAirline" id="PhilpinesAirline" value="<?php echo($fl_markup_data!=''?$fl_markup_data->PhilpinesAirline:'0'); ?>" class="form-control" style="height: 27px;"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div style="clear:both;"></div>
                                <div class="panel-heading fl_mark_head" style="font-weight:bold;">
                                    International Flight Markup
                                </div>
                                <div class="col-sm-5" style="margin-top: 23px;margin-left: 15px;">
                                    <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                        <label>International Flight Markup</label>
                                        <input type="text" name="intel_flight_amount" id="intel_flight_amount" value="<?php echo($fl_markup_data!=''?$fl_markup_data->international:'0'); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top:10px;">
                                <div class="custom-search" style="margin-bottom: 35px;text-align:center;">
                                    <input type="button" name="" value="Update Flight Markup" id="update_fl_markup_submit" onclick="return updateAgentFlMarkupDetails();" class="btn btn-primary" style="color:#ffffff;">
                                    <span id="loding_flMarkup_submit" style="display:none;">
                                        <img src="<?php echo base_url(); ?>assets/images/login_loder.gif" style="width: 30px;">
                                    </span>
                                </div>
                            </div>
                            
                            </form>
                        </div>
                        <div id="hotelMarkup" class="panel panel-default tab-pane fade in">
                            <div class="panel-heading">
                                Update Hotel Markup
                            </div>
                            <div class="panel-body">
                                <div id="hoMarkup_error" style="display:none;">
                                    <div class="alert alert-danger alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Oops!</strong> <span id="hoMarkup_error_text"></span>
                                    </div>
                                </div>
                                <div id="hoMarkup_success" style="display:none;">
                                    <div class="alert alert-success alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Success!</strong> <span id="hoMarkup_success_text"></span>
                                    </div>
                                </div>
                                <form name="ho_markup_add" id="ho_markup_add">
                                <div class="col-sm-5">
                                    <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                        <label>Select Markup Type</label>
                                        <select class="form-control" name="hotel_markup_type" id="hotel_markup_type" style="padding-top: 0;padding-bottom: 0;height: 41px;" onchange="showDepositType(this.value);" required="">
                                            <option value="flat" <?php echo($ho_markup_data != '' && $ho_markup_data->hotel_markup_type == 'fixed' ? 'selected="selected"':''); ?>>Flat Amount</option>
                                            <option value="percent" <?php echo($ho_markup_data != '' && $ho_markup_data->hotel_markup_type == 'percent' ? 'selected="selected"':''); ?>>Percentage</option>
                                        </select>
                                    </div>
                                    <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                        <label>Domestic Hotel Markup Amount</label>
                                        <input type="text" class="form-control" name="domHo_markup_amount" id="domHo_markup_amount" value="<?php echo($ho_markup_data != ''?$ho_markup_data->dom_hotel_markup:'0'); ?>" onkeypress="return restrictCharacters(this, event, decimalOnly);" value="">
                                        <span style="color:red;font-size: 11px;display:none;" id="domhoMarkup_error">Please add domestic markup amount.</span>
                                    </div>
                                    <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                        <label>International Hotel Markup Amount</label>
                                        <input type="text" class="form-control" name="intlHo_markup_amount" id="intlHo_markup_amount" value="<?php echo($ho_markup_data != ''?$ho_markup_data->intl_hotel_markup:'0'); ?>" onkeypress="return restrictCharacters(this, event, decimalOnly);" value="">
                                        <span style="color:red;font-size: 11px;display:none" id="intlhoMarkup_error" >Please add international markup amount.</span>
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-top:10px;">
                                    <div class="custom-search" style="margin-bottom: 35px;text-align:center;">
                                        <input type="button" name="" value="Update Hotel Markup" id="update_ho_markup_submit" onclick="return updateAgentHoMarkupDetails();" class="btn btn-primary" style="color:#ffffff;">
                                        <span id="loding_hoMarkup_submit" style="display:none;">
                                            <img src="<?php echo base_url(); ?>assets/images/login_loder.gif" style="width: 30px;">
                                        </span>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
<!--                        <div id="carMarkup" class="panel panel-default tab-pane fade in">
                            <div class="panel-heading">
                                Update Car Markup
                            </div>
                            <div class="panel-body">
                            
                            </div>
                        </div>-->
<!--                        <div id="sightseeingMarkup" class="panel panel-default tab-pane fade in"></div>-->
                    </div>
                </div>
            </div>
            <!-- /#page-wrapper -->
            <?php echo $this->load->view('footer'); ?>
        </div>
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
</html>
