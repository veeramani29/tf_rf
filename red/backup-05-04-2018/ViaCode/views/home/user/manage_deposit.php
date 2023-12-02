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
                        <h1 class="page-header">Deposit Management</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row" style="margin-bottom:10px;">
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs" style="margin-left:0px;">
                        <li class="active"><a data-toggle="tab" href="#dipositList">Deposit List</a></li>
                        <li><a data-toggle="tab" href="#manualDeposit">Add Manual Deposit</a></li>
                        <li><a data-toggle="tab" href="#instantDeposit">Add Instant Deposit( Payment Gateway )</a></li>
                        <li><a data-toggle="tab" href="#rejectedDeposit">Rejected Deposit List</a></li>
                        <li><a data-toggle="tab" href="#pendingDeposit">Pending Deposit List</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12 tab-content">
                        <div id="dipositList" class="panel panel-default tab-pane fade in active">
                            <div class="panel-heading">
                                All Deposit List
                            </div>
                            <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dipositListData">
                                <thead>
                                    <tr>
                                        <th>Deposit Bank</th>
                                        <th>Transection Id</th>
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
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $deposit->deposit_bank; ?></td>
                                        <td><?php echo $deposit->transection_id; ?></td>
                                        <td><?php echo $deposit->deposit_type; ?></td>
                                        <td><?php echo $deposit->deposit_amount; ?></td>
                                        <td><?php echo $deposit->add_date; ?></td>
                                        <?php
                                            if($deposit->status == '0'){
                                        ?>
                                                <td style="color:red;">Pending</td>
                                        <?php
                                            } else if($deposit->status == '1'){
                                        ?>
                                                <td style="color:green;">Accepted</td>
                                        <?php
                                            } else {
                                        ?>
                                                <td style="color:red;">Rejected</td>
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
                                            <tr><td col-span="6">No Deposit request has been added</td></tr>
                                    <?php
                                        }
                                    ?>
                                     
                                </tbody>
                            </table>
                        </div>
                        </div>
                        <div id="manualDeposit" class="panel panel-default tab-pane fade in">
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
                                                                <option value="Banco De Oro">Banco De Oro</option>
                                                                <option value="Bank Of The Philippine Islands">Bank Of The Philippine Islands</option>
                                                                <option value="Metropolitan Bank And Trust Company">Metropolitan Bank And Trust Company</option>
                                                                <option value="Banco De Oro Dollar">Banco De Oro Dollar</option>
                                                                <option value="EC Pay">EC Pay</option>
                                                                <option value="PERAPAL">PERAPAL</option>
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
                                                                <option value="Banco De Oro">Banco De Oro</option>
                                                                <option value="Bank Of The Philippine Islands">Bank Of The Philippine Islands</option>
                                                                <option value="Metropolitan Bank And Trust Company">Metropolitan Bank And Trust Company</option>
                                                                <option value="Banco De Oro Dollar">Banco De Oro Dollar</option>
                                                                <option value="EC Pay">EC Pay</option>
                                                                <option value="PERAPAL">PERAPAL</option>
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
                                                                <option value="Banco De Oro">Banco De Oro</option>
                                                                <option value="Bank Of The Philippine Islands">Bank Of The Philippine Islands</option>
                                                                <option value="Metropolitan Bank And Trust Company">Metropolitan Bank And Trust Company</option>
                                                                <option value="Banco De Oro Dollar">Banco De Oro Dollar</option>
                                                                <option value="EC Pay">EC Pay</option>
                                                                <option value="PERAPAL">PERAPAL</option>
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
                        <div id="instantDeposit" class="panel panel-default tab-pane fade in"></div>
                        <div id="rejectedDeposit" class="panel panel-default tab-pane fade in">
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
                        <div id="pendingDeposit" class="panel panel-default tab-pane fade in">
                            <div class="panel-heading">
                                Pending Deposit List
                            </div>
                            <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="pendingDipositListData">
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
                                                if($deposit->status == 0){
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $deposit->transection_id; ?></td>
                                        <td><?php echo $deposit->deposit_bank; ?></td>
                                        <td><?php echo $deposit->deposit_type; ?></td>
                                        <td><?php echo $deposit->deposit_amount; ?></td>
                                        <td><?php echo $deposit->add_date; ?></td>
                                        <td style="color:blue;">Pending</td>
                                    </tr>
                                    <?php
                                                }
                                                $i++;
                                            }
                                        }
                                        else
                                        {
                                    ?>
                                            <tr><td col-span="6">No Deposit request is pending</td></tr>
                                    <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
