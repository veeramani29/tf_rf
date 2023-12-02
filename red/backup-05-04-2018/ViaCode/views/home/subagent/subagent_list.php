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
                <div class="row" style="margin-bottom:10px;">
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs" style="margin-left:0px;">
                            <li class="active"><a data-toggle="tab" href="#activeSubList">Active List</a></li>
                            <li><a data-toggle="tab" href="#inactiveSubList">Inactive List</a></li>
                            <li><a data-toggle="tab" href="#blockedSubList">Blocked List</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12 tab-content">
                        <div id="activeSubList" class="panel panel-default tab-pane fade in active">
                            <div class="panel-heading">
                                Active Sub-Agent List
                            </div>
                            <div class="panel-body">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="subAgentListDataActive">
                                    <thead style="font-size: 13px;">
                                        <tr>
                                            <th>Account Id</th>
                                            <th>Email Id</th>
                                            <th>Agent Name</th>
                                            <th>Company Name</th>
                                            <th>Contact</th>
                                            <th>Date Added</th>
                                            <th>Status</th>
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
                                                    $row = ($i+1);
                                                    if($list->status == '1'){
                                        ?>
                                        <tr class="odd gradeX" id="subAgentRowActive<?php echo $i;?>">
                                            <td><?php echo $list->user_no; ?></td>
                                            <td><?php echo $list->user_email; ?></td>
                                            <td><?php echo $list->first_name; ?></td>
                                            <td><?php echo $list->company_name; ?></td>
                                            <td><?php echo $list->phone_code.'-'.$list->mobile_no; ?></td>
                                            <td><?php echo $list->register_date; ?></td>
                                            <td style="color:green;" class="subAgentChangeStatusActive">Active</td>
                                            <td>
                                                <a class="" href="javascript:void(0);" onclick="changeSubagentStatusActive('<?php echo $list->user_id; ?>','<?php echo $i; ?>','1');" title="Activate Sub Agent" data-rel="tooltip" data-base-url="http://www.salman.tld/beta/admin/index.php/" data-value="1" data-user-id="24">
                                                    <i class="fa fa-check fa-lg" aria-hidden="true"></i>
                                                </a>&nbsp;
                                                <a class="" href="javascript:void(0);" onclick="changeSubagentStatusActive('<?php echo $list->user_id; ?>','<?php echo $i; ?>','0');" title="Deactivate Sub Agent" data-rel="tooltip" data-base-url="http://www.salman.tld/beta/admin/index.php/" data-value="1" data-user-id="24">
                                                    <i class="fa fa-ban fa-lg" aria-hidden="true"></i>
                                                </a>&nbsp;
                                                <a class="" href="javascript:void(0);" onclick="changeSubagentStatusActive('<?php echo $list->user_id; ?>','<?php echo $i; ?>','2');" title="Block Sub Agent" data-rel="tooltip" data-base-url="http://www.salman.tld/beta/admin/index.php/" data-value="1" data-user-id="24">
                                                    <i class="fa fa-times fa-lg" aria-hidden="true"></i>
                                                </a>&nbsp;
                                                <a class="" href="javascript:void(0);" onclick="showSubAgentEditPopup('<?php echo $list->master_agent_id; ?>','<?php echo $list->user_id; ?>');" title="Block Sub Agent" data-rel="tooltip" data-base-url="http://www.salman.tld/beta/admin/index.php/" data-value="1" data-user-id="24">
                                                    <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>
                                                </a>
                                                
                                            </td>
                                        </tr>
                                        <?php
                                                    }
                                                    $i++;
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="inactiveSubList" class="panel panel-default tab-pane fade in">
                            <div class="panel-heading">
                                Inactive Sub-Agent List
                            </div>
                            <div class="panel-body">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="subAgentListDataInactive">
                                    <thead style="font-size: 13px;">
                                        <tr>
                                            <th>Email Id</th>
                                            <th>Agent Name</th>
                                            <th>Company Name</th>
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
                                                $i=0;
                                                foreach($sub_agent_list as $list)
                                                {
                                                    $row = ($i+1);
                                                    if($list->status == '0'){
                                        ?>
                                        <tr class="odd gradeX" id="subAgentRowInactive<?php echo $i;?>">
                                            <td><?php echo $list->user_email; ?></td>
                                            <td><?php echo $list->first_name; ?></td>
                                            <td><?php echo $list->company_name; ?></td>
                                            <td><?php echo $list->phone_code.'-'.$list->mobile_no; ?></td>
                                            <td><?php echo $list->register_date; ?></td>
                                            <td style="color:red;" class="subAgentChangeStatusInactive">Inactive</td>
                                            <td>
                                                <a class="" href="javascript:void(0);" onclick="changeSubagentStatusInactive('<?php echo $list->user_id; ?>','<?php echo $i; ?>','1');" title="Activate Sub Agent" data-rel="tooltip" data-base-url="http://www.salman.tld/beta/admin/index.php/" data-value="1" data-user-id="24">
                                                    <i class="fa fa-check fa-lg" aria-hidden="true"></i>
                                                </a>&nbsp;
                                                <a class="" href="javascript:void(0);" onclick="changeSubagentStatusInactive('<?php echo $list->user_id; ?>','<?php echo $i; ?>','0');" title="Deactivate Sub Agent" data-rel="tooltip" data-base-url="http://www.salman.tld/beta/admin/index.php/" data-value="1" data-user-id="24">
                                                    <i class="fa fa-ban fa-lg" aria-hidden="true"></i>
                                                </a>&nbsp;
                                                <a class="" href="javascript:void(0);" onclick="changeSubagentStatusInactive('<?php echo $list->user_id; ?>','<?php echo $i; ?>','2');" title="Block Sub Agent" data-rel="tooltip" data-base-url="http://www.salman.tld/beta/admin/index.php/" data-value="1" data-user-id="24">
                                                    <i class="fa fa-times fa-lg" aria-hidden="true"></i>
                                                </a>&nbsp;
                                                <a class="" href="javascript:void(0);" onclick="showSubAgentEditPopup('<?php echo $list->master_agent_id; ?>','<?php echo $list->user_id; ?>');" title="Block Sub Agent" data-rel="tooltip" data-base-url="http://www.salman.tld/beta/admin/index.php/" data-value="1" data-user-id="24">
                                                    <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                                    }
                                                    $i++;
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="blockedSubList" class="panel panel-default tab-pane fade in">
                            <div class="panel-heading">
                                Blocked Sub-Agent List
                            </div>
                            <div class="panel-body">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="subAgentListDataBlocked">
                                    <thead style="font-size: 13px;">
                                        <tr>
                                            <th>Email Id</th>
                                            <th>Agent Name</th>
                                            <th>Company Name</th>
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
                                                $i=0;
                                                foreach($sub_agent_list as $list)
                                                {
                                                    $row = ($i+1);
                                                    if($list->status == '2'){
                                        ?>
                                        <tr class="odd gradeX" id="subAgentRowBlocked<?php echo $i;?>">
                                            <td><?php echo $list->user_email; ?></td>
                                            <td><?php echo $list->first_name; ?></td>
                                            <td><?php echo $list->company_name; ?></td>
                                            <td><?php echo $list->phone_code.'-'.$list->mobile_no; ?></td>
                                            <td><?php echo $list->register_date; ?></td>
                                            <td style="color:red;" class="subAgentChangeStatusBlocked">Blocked</td>
                                            <td>
                                                <a class="" href="javascript:void(0);" onclick="changeSubagentStatusBlocked('<?php echo $list->user_id; ?>','<?php echo $i; ?>','1');" title="Activate Sub Agent" data-rel="tooltip" data-base-url="http://www.salman.tld/beta/admin/index.php/" data-value="1" data-user-id="24">
                                                    <i class="fa fa-check fa-lg" aria-hidden="true"></i>
                                                </a>&nbsp;
                                                <a class="" href="javascript:void(0);" onclick="changeSubagentStatusBlocked('<?php echo $list->user_id; ?>','<?php echo $i; ?>','0');" title="Deactivate Sub Agent" data-rel="tooltip" data-base-url="http://www.salman.tld/beta/admin/index.php/" data-value="1" data-user-id="24">
                                                    <i class="fa fa-ban fa-lg" aria-hidden="true"></i>
                                                </a>&nbsp;
                                                <a class="" href="javascript:void(0);" onclick="changeSubagentStatusBlocked('<?php echo $list->user_id; ?>','<?php echo $i; ?>','2');" title="Block Sub Agent" data-rel="tooltip" data-base-url="http://www.salman.tld/beta/admin/index.php/" data-value="1" data-user-id="24">
                                                    <i class="fa fa-times fa-lg" aria-hidden="true"></i>
                                                </a>&nbsp;
                                                <a class="" href="javascript:void(0);" onclick="showSubAgentEditPopup('<?php echo $list->master_agent_id; ?>','<?php echo $list->user_id; ?>');" title="Block Sub Agent" data-rel="tooltip" data-base-url="http://www.salman.tld/beta/admin/index.php/" data-value="1" data-user-id="24">
                                                    <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                                    }
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
            <!-- /#page-wrapper -->
            <div id="show_subagent_edit_window" class="modal fade" role="dialog" style="top:36px;">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <span class="modal-title" style="font-size:16px;font-weight:bold">Edit Sub-Agent Profile</span>
                        </div>
                        <div class="modal-body" style="padding-left:0px;"></div>
                        <div class="modal-footer" style="border:0px;"></div>
                    </div>

                </div>
            </div>
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
