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
                                    <h3>View Deposit Details</h3>
                                </div>
                                <div class="box-content">
<?php if (validation_errors() != '') { ?>                              
                                        <div class="alert alert-block alert-danger">
                                            <a href="#" data-dismiss="alert" class="close">×</a>
                                            <h4 class="alert-heading">Errors!</h4>
                                        <?php echo validation_errors(); ?>  
                                        </div>
                                    <?php } ?> 
                                    
                                        
                                        
                                        <legend>Transection Information</legend>
                                        <?php 
                                            if($agentDetails != ''){
                                        ?>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Agent Name : </label>
                                            <div class="controls">
                                                <span><?php echo $agentDetails->company_name; ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Agent Id : </label>
                                            <div class="controls">
                                                <span><?php echo $agentDetails->user_no; ?></span>
                                            </div>
                                        </div>
                                        <?php 
                                            }
                                        ?>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Deposit Type : </label>
                                            <div class="controls">
                                                <span><?php echo $tran_details->deposit_type; ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Deposit Amount : </label>
                                            <div class="controls">
                                                <span><?php echo $tran_details->deposit_amount; ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Mobile no. : </label>
                                            <div class="controls">
                                                <span><?php echo $tran_details->mobile_number; ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Transection Id : </label>
                                            <div class="controls">
                                                <span><?php echo $tran_details->transection_id; ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Deposit Bank : </label>
                                            <div class="controls">
                                                <span><?php echo $tran_details->deposit_bank; ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Bank Branch : </label>
                                            <div class="controls">
                                                <span><?php echo $tran_details->bank_branch; ?></span>
                                            </div>
                                        </div>
                                        <?php 
                                            if($tran_details->deposit_type == 'Cheque')
                                            {
                                        ?>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Cheque Deposit Bank : </label>
                                            <div class="controls">
                                                <span><?php echo $tran_details->cheque_drawn_bank; ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Cheque Deposit Date : </label>
                                            <div class="controls">
                                                <span><?php echo $tran_details->cheque_issue_date; ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Cheque Number : </label>
                                            <div class="controls">
                                                <span><?php echo $tran_details->cheque_no; ?></span>
                                            </div>
                                        </div>
                                        <?php 
                                            }
                                        ?>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Receipt Scan Copy : </label>
                                            <div class="controls">
                                                <?php if($tran_details->scan_copy != '') ?>
                                                <span><img src="<?php echo Agent_Deposit_view_Path.'/'.$tran_details->scan_copy; ?>"></span>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                    
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
        </script>
    </body>
</html>