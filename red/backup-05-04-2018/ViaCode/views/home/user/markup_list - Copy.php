<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo Site_Title; ?></title>
        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/dist/css/sb-admin-2.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/dist/css/bundal.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/dist/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/dist/css/travel-setting.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/dist/css/landing-style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/dist/css/flaticon.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/dist/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/dist/css/font-linearicons.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/vendor/morrisjs/morris.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/css/general_style.css" rel="stylesheet">
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
                        <li><a data-toggle="tab" href="#carMarkup">Car</a></li>
                        <li><a data-toggle="tab" href="#sightseeingMarkup">Sightseeing</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12 tab-content">
                        <div id="flightMarkup" class="panel panel-default tab-pane fade in active">
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
                                    <select class="form-control" name="flight_markup_type" id="flight_markup_type" style="padding-top: 0;padding-bottom: 0;height: 41px;" onchange="showDepositType(this.value);" required="">
                                        <option value="flat" <?php echo($fl_markup_data != '' && $fl_markup_data->markup_type == 'flat' ? 'selected="selected"':''); ?>>Flat Amount</option>
                                        <option value="percent" <?php echo($fl_markup_data != '' && $fl_markup_data->markup_type == 'percent' ? 'selected="selected"':''); ?>>Percentage</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div style="clear:both;"></div>
                            <div class="panel-heading" style="font-weight: bold;">
                                Add Generic Markup
                            </div>
                            <div class="panel-body">
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
                            </div>
                            
                            <div class="panel-heading" style="font-weight: bold;">
                                Add Airline Based Markup
                            </div>
                            <div class="panel-body">
                                <?php 
                                    $flArr = array();
                                    if($fl_markup_data != '' && $fl_markup_data->flight_markup != ''){
                                        $exFl = explode('|',$fl_markup_data->flight_markup);
                                        foreach($exFl as $fl){
                                            if($fl != ''){
                                                $flSingle = explode('-',$fl);
                                                $flArr['airline'][] =  $flSingle[0];
                                                $flArr['amount'][] =  $flSingle[1];
                                            }
                                        }
                                    } else {
                                        $exFl = '';
                                    }
                                ?>
                                <table width="100%" class="table table-striped table-bordered table-hover" id="flMarkupArlineList">
                                    <thead>
                                        <tr>
                                            <th>Airline Logo</th>
                                            <th>Airline Name</th>
                                            <th>Add Markup Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if($airline_list != '')
                                            {
                                                $i=0;
                                                foreach($airline_list as $list)
                                                {
                                                    if($exFl != '' && !empty($flArr['airline'])){
                                                        for($a = 0;$a < count($flArr['airline']);$a++){
                                                            if($flArr['airline'][$i] == $list->airline_code){
                                                                $amount = $flArr['amount'][$i];
                                                            } else {
                                                                $amount = 0;
                                                            }
                                                        }
                                                    } else {
                                                        $amount = 0;
                                                    }
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><img src="<?php echo base_url(); ?>assets/images/airline_logo/<?php echo $list->airline_code; ?>.gif" alt="<?php echo $list->airline_name; ?>"></td>
                                            <td><?php echo $list->airline_name; ?></td>
                                            <td><input type="text" name="fl_airline_markup[]" value="<?php echo $amount; ?>" class="form-control" style="height: 27px;"></td>
                                        </tr>
                                        <?php
                                                    $i++;
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="col-md-10">
                                <hr>
                                <div class="custom-search" style="margin-bottom: 35px;text-align:center;">
                                    <input type="button" name="" value="Update Flight Markup" id="update_fl_markup_submit" onclick="return updateAgentFlMarkupDetails();" class="btn" style="color:#ffffff;">
                                    <span id="loding_flMarkup_submit" style="display:none;">
                                        <img src="<?php echo base_url(); ?>assets/images/login_loder.gif" style="width: 30px;">
                                    </span>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div id="hotelMarkup" class="panel panel-default tab-pane fade in">
                            <div class="panel-heading">
                                Manual Deposit Request
                            </div>
                            <div class="panel-body">
                                <div class="row">
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
                                                        <label>Payment Type</label>
                                                        <select class="form-control" name="deposit_type" id="deposit_type" style="padding-top: 0;padding-bottom: 0;height: 41px;" onchange="showDepositType(this.value);" required="">
                                                            <option value="Cash">Cash</option>
                                                            <option value="Cheque">Cheque</option>
                                                            <option value="Bank Transfer">Bank Transfer</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                        <label>Phone Number<span class="req_star">*</span> ( with country code )</label>
                                                        <input type="text" class="form-control" name="mobile_number" id="mobile_number" onkeypress="return restrictCharacters(this, event, digitsOnly);" value="">
                                                        <span style="color:red;font-size: 11px;" id="mobile_number_error"></span>
                                                    </div>
                                                    <div id="cash_div_block1" style="display:block;">
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Deposited In Bank<span class="req_star">*</span></label>
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
                                                            <label>Receipt Scan Copy<span class="req_star">*</span></label>
                                                           <input type="file" class="form-control pad_0" name="cash_scan_copy" id="cash_scan_copy">
                                                            <span style="color:red;font-size: 11px;" id="cash_scan_copy_error"></span>
                                                            ( gif , png, jpeg, jpg format allowed )
                                                        </div>
                                                    </div>
                                                    <div id="cheque_div_block1" style="display:none;">
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Cheque Drawn on Bank<span class="req_star">*</span></label>
                                                            <input type="text" class="form-control" name="cheque_drawn_bank" id="cheque_drawn_bank" value="">
                                                            <span style="color:red;font-size: 11px;" id="cheque_drawn_bank_error"></span>
                                                        </div>
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Cheque / DD No.<span class="req_star">*</span></label>
                                                            <input type="text" class="form-control" name="cheque_no" id="cheque_no" value="">
                                                            <span style="color:red;font-size: 11px;" id="cheque_no_error"></span>
                                                        </div>
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Branch Deposited In<span class="req_star">*</span></label>
                                                            <input type="text" class="form-control" name="cheque_bank_branch" id="cheque_bank_branch" value="">
                                                            <span style="color:red;font-size: 11px;" id="cheque_bank_branch_error"></span>
                                                        </div>
                                                    </div>
                                                    <div id="bank_transfer_div_block1" style="display:none;">
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Deposited In Bank<span class="req_star">*</span></label>
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
                                                            <label>Receipt Scan Copy<span class="req_star">*</span></label>
                                                            <input type="file" class="form-control pad_0" name="bank_transfer_scan_copy" id="bank_transfer_scan_copy">
                                                            <span style="color:red;font-size: 11px;" id="bank_transfer_scan_copy_error"></span>
                                                            ( gif , png, jpeg, jpg format allowed )
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                        <label>Deposit Amount<span class="req_star">*</span></label>
                                                        <input type="text" class="form-control" name="deposit_amount" id="deposit_amount" onkeypress="return restrictCharacters(this, event, digitsOnly);" value="">
                                                        <span style="color:red;font-size: 11px;" id="deposit_amount_error"></span>
                                                    </div>
                                                    <div id="cash_div_block2" style="display:block;">
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Transection Id<span class="req_star">*</span></label>
                                                            <input type="text" class="form-control" name="cash_transection_id" id="cash_transection_id" value="">
                                                            <span style="color:red;font-size: 11px;" id="cash_transection_id_error"></span>
                                                        </div>
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Branch Deposited In<span class="req_star">*</span></label>
                                                            <input type="text" class="form-control" name="cash_bank_branch" id="cash_bank_branch" value="">
                                                            <span style="color:red;font-size: 11px;" id="cash_bank_branch_error"></span>
                                                        </div>
                                                    </div>
                                                    <div id="cheque_div_block2" style="display:none;">
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Transection Id<span class="req_star">*</span></label>
                                                            <input type="text" class="form-control" name="cheque_transection_id" id="cheque_transection_id" value="">
                                                            <span style="color:red;font-size: 11px;" id="cheque_transection_id_error"></span>
                                                        </div>
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Cheque Issue Date<span class="req_star">*</span> ( Date format -  yyyy-mm-dd )</label>
                                                            <input type="text" class="form-control hasDatepicker" name="cheque_issue_date" id="cheque_issue_date" value="">
                                                            <span style="color:red;font-size: 11px;" id="cheque_issue_date_error"></span>
                                                        </div>
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Deposited In Bank<span class="req_star">*</span></label>
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
                                                            <label>Receipt Scan Copy<span class="req_star">*</span></label>
                                                            <input type="file" class="form-control pad_0" name="cheque_scan_copy" id="cheque_scan_copy">
                                                            <span style="color:red;font-size: 11px;" id="cheque_scan_copy_error"></span>
                                                            ( gif , png, jpeg, jpg format allowed )
                                                        </div>
                                                    </div>
                                                    <div id="bank_transfer_div_block2" style="display:none;">
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Transection Id<span class="req_star">*</span></label>
                                                            <input type="text" class="form-control" name="bank_transfer_transection_id" id="bank_transfer_transection_id" value="">
                                                            <span style="color:red;font-size: 11px;" id="bank_transfer_transection_id_error"></span>
                                                        </div>
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
                                                            <label>Branch Deposited In<span class="req_star">*</span></label>
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
                            </div>
                        </div>
                        <div id="carMarkup" class="panel panel-default tab-pane fade in">
                            <div class="panel-heading">
                                Rejected Deposit List
                            </div>
                            <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="rejectDipositListData">
                                <thead>
                                    <tr>
                                        <th>Transection Id</th>
                                        <th>Deposit Bank</th>
                                        <th>Deposit Type</th>
                                        <th>Deposit Amount</th>
                                        <th>Date Added</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if($deposit_list != '')
                                        {
                                            $i=0;
                                            foreach($deposit_list as $deposit)
                                            {
                                                if($deposit->status == 2){
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $deposit->transection_id; ?></td>
                                        <td><?php echo $deposit->deposit_bank; ?></td>
                                        <td><?php echo $deposit->deposit_type; ?></td>
                                        <td><?php echo $deposit->deposit_amount; ?></td>
                                        <td><?php echo $deposit->add_date; ?></td>
                                        <td style="color:red;">Rejected</td>
                                    </tr>
                                    <?php
                                                }
                                                $i++;
                                            }
                                        }
                                        else
                                        {
                                    ?>
                                            <tr><td col-span="6">No Deposit request has been rejected</td></tr>
                                    <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="sightseeingMarkup" class="panel panel-default tab-pane fade in"></div>
                    </div>
                </div>
            </div>
            <!-- /#page-wrapper -->
            <?php echo $this->load->view('footer'); ?>
        </div>
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
    </body>
</html>
