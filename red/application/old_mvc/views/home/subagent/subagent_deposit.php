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
                        <h1 class="page-header">Sub Agent List</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12 tab-content">
                        <?php if($status != '' && $status == 'error'){ ?>
                        <div id="subflMarkup_error" style="display:none;">
                            <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Oops!</strong> Deposit could not be added. Please try again with valid input.
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($status != '' && $status == 'success'){ ?>
                        <div id="subflMarkup_success" style="display:none;">
                            <div class="alert alert-success alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success!</strong> Deposit added to sub agent successfully.
                            </div>
                        </div>
                        <?php } ?>
                        <div id="dipositList" class="panel panel-default">
                            <div class="panel-heading">
                                Manage All Subagent Deposits
                            </div>
                            <div class="panel-body">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="subAgentListData">
                                    <thead>
                                        <tr>
                                            <th>Agent Name</th>
                                            <th>Company Name</th>
                                            <th>Last Deposit Amount</th>
                                            <th>Deposit Balance</th>
                                            <th>Last Deposit Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if($sub_agent_list != '')
                                            {
                                                $i=0;
                                                foreach($sub_agent_list as $list)
                                                {
                                                    $depositData = $this->Home_Model->getSubAgentDepositBalance($list->user_id);
                                                    if($depositData != ''){
                                                        $depositBalnce = $depositData->total_balance_amount;
                                                        $lastDepositDate = $depositData->last_deposit_date;
                                                        $lastDeposit = $depositData->total_deposit_amount;
                                                    } else {
                                                        $depositBalnce = 'Nil';
                                                        $lastDepositDate = '------';
                                                        $lastDeposit = '-------';
                                                    }
                                                    $agentId = $_SESSION['agent']['user_id'];
                                                    $subAgentId = $list->user_id;
                                                    
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $list->first_name; ?></td>
                                            <td><?php echo $list->company_name; ?></td>
                                            <td><?php echo $lastDeposit ?></td>
                                            <?php
                                                if($depositBalnce == 'Nil'){
                                            ?>
                                            <td style="color:red;"><?php echo $depositBalnce; ?></td>
                                            <?php
                                                } else {
                                            ?>
                                            <td><?php echo $depositBalnce; ?></td>
                                            <?php
                                                }
                                            ?>
                                            <td><?php echo $lastDepositDate; ?></td>
                                            <td><a onclick="showSubAgentDepositPopup('<?php echo $agentId; ?>','<?php echo $subAgentId; ?>');" class="btn btn-default" >Add Deposit</a></td>
                                        </tr>
                                       
                                        <?php
                                                    $i++;
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="show_subagent_deposit_window" class="modal fade" role="dialog" style="top:36px;">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <span class="modal-title" style="font-size:16px;font-weight:bold">Add Deposit</span>
                        </div>
                        <div class="modal-body" style="padding-left:140px;"></div>
                        <div class="modal-footer" style="border:0px;">

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
