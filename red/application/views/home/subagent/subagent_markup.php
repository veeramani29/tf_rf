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
                        <div id="dipositList" class="panel panel-default">
                            <div class="panel-heading">
                                Manage Subagent Markup
                            </div>
                            <div class="panel-body">
                                <div id="subflMarkup_error" style="display:none;">
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Oops!</strong> <span id="subflMarkup_error_text"></span>
                                </div>
                            </div>
                            <div id="subflMarkup_success" style="display:none;">
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Success!</strong> <span id="subflMarkup_success_text"></span>
                                </div>
                            </div>
                                <table width="100%" class="table table-striped table-bordered table-hover" id="subAgentListData">
                                    <thead>
                                        <tr>
                                            <th>Email Id</th>
                                            <th>Agent Name</th>
                                            <th>Company Name</th>
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
                                        ?>
                                        <tr class="odd gradeX">
                                            <td style="padding-top: 16px;"><?php echo $list->user_email; ?></td>
                                            <td style="padding-top: 16px;"><?php echo $list->first_name; ?></td>
                                            <td style="padding-top: 16px;"><?php echo $list->company_name; ?></td>
                                            <td><input type="button" name="subagent_update_markup" value="view/update" id="subagent_update_markup" onclick="openSubagentMarkupWindow('<?php echo $list->user_id; ?>')" class="btn btn-primary" style="color:#ffffff;"></td>
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
