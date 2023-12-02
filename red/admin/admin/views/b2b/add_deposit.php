<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>:: <?php echo Site_Title; ?> ::</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap-responsive.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.fancybox.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/uniform.default.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.datepicker.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.cleditor.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.plupload.queue.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.tagsinput.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.ui.plupload.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/chosen.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.jgrowl.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css">
    </head>
    <body>
        <?php $this->load->view('header'); ?>
        <div class="breadcrumbs">
            <div class="container-fluid">
                <ul class="bread pull-left">
                    <li>
                        <a href="dashboard.html"><i class="icon-home icon-white"></i></a>
                    </li>
                    <li>
                        <a href="dashboard.html">
                            Dashboard
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main">
            <?php echo $this->load->view('leftpanel'); ?>
            <div class="container-fluid">
                <div class="content">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="box">
                                <div class="box-head">
                                    <h3>Manual Deposit To Agent - <?php echo $comp_info->company_name; ?></h3>
                                </div>
                                <div class="box-content">
<?php if (validation_errors() != '') { ?>                              
                                        <div class="alert alert-block alert-danger">
                                            <a href="#" data-dismiss="alert" class="close">×</a>
                                            <h4 class="alert-heading">Errors!</h4>
                                        <?php echo validation_errors(); ?>  
                                        </div>
                                    <?php } ?> 
                                    <?php
                                        if(isset($error) && $error != ''){
                                    ?>
                                        <div class="alert alert-block alert-danger">
                                            <a href="#" data-dismiss="alert" class="close">×</a>
                                            <h4 class="alert-heading">Errors!</h4>
                                            <?php echo $error; ?>  
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    <form action="<?php echo site_url(); ?>/b2b/add_deposit" method="post" class='validate form-horizontal' enctype="multipart/form-data">
                                        <div style="color:red;font-weight:bold;margin-top:5px;margin-bottom:10px;">Note : All fields are mandatory to fill.</div>
                                        <legend>Deposit Type</legend>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Payment Type</label>
                                            <div class="controls">
                                                <select name="deposit_type" onchange="showDepositType(this.value);" required>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Cheque">Cheque</option>
                                                    <option value="Bank Transfer">Bank Transfer</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <legend>Deposit Details</legend>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Deposit Amount</label>
                                            <div class="controls">
                                                <input type="text" value="" name="deposit_amount" required />
                                                <span class="help-inline">(Enter without any commas and spaces e.g. 2300)</span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Mobile Number</label>
                                            <div class="controls">
                                                <input type="text" value="<?php echo $comp_info->mobile_no; ?>" name="mobile_number" required />
                                            </div>
                                        </div>
                                        <div id="cash_div" style="display:block;">
                                            <div class="control-group">
                                                <label for="req" class="control-label">Transaction Id</label>
                                                <div class="controls">
                                                    <input type="text" value="" name="cash_transection_id" /> 
                                                    <span class="help-inline">(Optional for admin in cash transection)</span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label for="req" class="control-label">Deposited In Bank</label>
                                                <div class="controls">
                                                    <select name="cash_deposit_bank">
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
                                                    <span class="help-inline">(Optional for admin in cash transection)</span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label for="req" class="control-label">Branch Deposited In</label>
                                                <div class="controls">
                                                    <input type="text" value="" name="cash_bank_branch" /> 
                                                    <span class="help-inline">(Optional for admin in cash transection)</span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label for="req" class="control-label">Upload Scan Copy</label>
                                                <div class="controls">
                                                    <input type="file" value="" name="cash_scan_copy" required/> 
                                                    <span class="help-inline">(Optional for admin in cash transection - gif , png, jpeg, jpg format allowed)</span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div id="cheque_div" style="display:none;">
                                            <div class="control-group">
                                                <label for="req" class="control-label">Transaction Id</label>
                                                <div class="controls">
                                                    <input type="text" value="" name="cheque_transection_id" />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label for="req" class="control-label">Cheque Drawn on Bank</label>
                                                <div class="controls">
                                                    <input type="text" value="" name="cheque_drawn_bank" />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label for="req" class="control-label">Cheque Issue Date</label>
                                                <div class="controls">
                                                    <input type="text" value="" name="cheque_issue_date" />
                                                    <span class="help-inline">( Date format -  yyyy-mm-dd )</span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label for="req" class="control-label">Cheque/DD No.</label>
                                                <div class="controls">
                                                    <input type="text" value="" name="cheque_no" />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label for="req" class="control-label">Deposited In Bank</label>
                                                <div class="controls">
                                                    <select name="cheque_deposit_bank">
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
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label for="req" class="control-label">Branch Deposited In</label>
                                                <div class="controls">
                                                    <input type="text" value="" name="cheque_bank_branch" />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label for="req" class="control-label">Upload Scan Copy</label>
                                                <div class="controls">
                                                    <input type="file" value="" name="cheque_scan_copy" required/> 
                                                    <span class="help-inline">(gif , png, jpeg, jpg format allowed)</span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div id="bank_transfer_div" style="display:none;">
                                            <div class="control-group">
                                                <label for="req" class="control-label">Transaction Id</label>
                                                <div class="controls">
                                                    <input type="text" value="" name="bank_transfer_transection_id" />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label for="req" class="control-label">Deposited In Bank</label>
                                                <div class="controls">
                                                    <select name="bank_transfer_deposit_bank">
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
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label for="req" class="control-label">Branch Deposited In</label>
                                                <div class="controls">
                                                    <input type="text" value="" name="bank_transfer_bank_branch" />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label for="req" class="control-label">Upload Scan Copy</label>
                                                <div class="controls">
                                                    <input type="file" value="" name="bank_transfer_scan_copy" required/> 
                                                    <span class="help-inline">(gif , png, jpeg, jpg format allowed)</span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                        <input type="hidden" name="add_val" value="<?php echo $id; ?>">
                                        <div class="form-actions">
                                            <input type="submit" class="btn btn-primary" value="Add Deposit Details">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>	
            </div>
        </div>	
        <script src="<?php echo base_url(); ?>public/js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>public/js/less.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.uniform.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bootstrap.timepicker.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bootstrap.datepicker.js"></script>
        <script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.fancybox.js"></script>
        <script src="<?php echo base_url(); ?>public/js/plupload/plupload.full.js"></script>
        <script src="<?php echo base_url(); ?>public/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.cleditor.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.inputmask.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.tagsinput.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.mousewheel.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.textareaCounter.plugin.js"></script>
        <script src="<?php echo base_url(); ?>public/js/ui.spinner.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.jgrowl_minimized.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.form.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bbq.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery-ui-1.8.22.custom.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.form.wizard-min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/custom.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/ckeditor/ckeditor.js"></script>
        <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                $('#to_date').datepicker({
                    format: "yyyy-mm-dd"
                });  
            $('#from_date').datepicker({
                    format: "yyyy-mm-dd"
                });
            });
            
            
            function showDepositType(val)
            {
                if(val == 'Cash')
                {
                    $('#cash_div').show();
                    $('#cheque_div').hide();
                    $('#bank_transfer_div').hide();
                }
                if(val == 'Cheque')
                {
                    $('#cash_div').hide();
                    $('#cheque_div').show();
                    $('#bank_transfer_div').hide();
                }
                if(val == 'Bank Transfer')
                {
                    $('#cash_div').hide();
                    $('#cheque_div').hide();
                    $('#bank_transfer_div').show();
                }
            }
        </script>
    </body>
</html>