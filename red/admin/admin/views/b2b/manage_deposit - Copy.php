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
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/chosen.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css">
    </head>
    <body>
        <?php $this->load->view('header'); ?>
        <div class="breadcrumbs">
            <div class="container-fluid">
                <ul class="bread pull-left">
                    <li>
                        <a href="<?php echo site_url(); ?>/home"><i class="icon-home icon-white"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo site_url(); ?>/home">
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
                    <?php echo $this->load->view('topmenu'); ?>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="box">
                                <div class="box-head tabs">
                                    <h3>B2B Deposit Management</h3>
                                    <!--<ul class='nav nav-tabs'>
                                            <a href="<?php echo site_url(); ?>/b2b/create_agent" ><button class="btn btn-primary">Create New Agent</button></a>							

                                         </ul>-->
                                    <ul class="nav  nav-pills">
                                        <li class="active">
                                            <a data-toggle="tab" href="#user-list">Deposit List</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="box-content box-nomargin">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="user-list">
                                            <table class='table table-striped dataTable table-bordered'>
                                                <thead>
                                                    <tr>
                                                        <th>Agent Company</th>
                                                        <th>Email</th>
                                                        <th>Last Deposit Amount</th>
                                                        <th>Total Balance Available</th>
                                                        <th>Last Deposited</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($deposit_history)) { ?>
                                                        <?php for ($i = 0; $i < count($deposit_history); $i++) 
                                                              { 
                                                                    $agentDetail = $this->B2b_Model->getCompanyNameOnId($deposit_history[$i]->agent_id);
                                                        ?>
                                                            <tr>
                                                                <td>
                                                                    <?php
                                                                            echo $agentDetail->company_name;
                                                                    ?>
                                                                </td>
                                                                <td class="center"><?php echo $agentDetail->user_email; ?></td>
                                                                <td class="center"><?php echo $deposit_history[$i]->total_deposit_amount; ?></td>
                                                                <td class="center"><?php echo $deposit_history[$i]->total_balance_amount; ?></td>
                                                                <td class="center"><?php echo $deposit_history[$i]->last_deposit_date; ?></td>
                                                                
                                                                <td class="center">
                                                                    <a class="btn btn-danger" href="<?php echo site_url(); ?>/b2b/add_deposit/<?php echo $deposit_history[$i]->agent_id; ?>" title="Manual Deposit" data-rel="tooltip" >
                                                                        Manual Deposit
                                                                    </a>
                                                                    <a class="btn btn-danger" href="<?php echo site_url(); ?>/b2b/view_deposit_history/<?php echo $deposit_history[$i]->agent_id; ?>" title="Manual Deposit" data-rel="tooltip" >
                                                                        View All Deposits
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                    <div class="alert alert-error">
                                                        <button class="close" data-dismiss="alert" type="button">×</button>
                                                        <strong>Error!</strong>
                                                        No Data Found. Please try after some time...
                                                    </div>
                                                <?php } ?>
                                                </tbody>
                                            </table>
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
        <script src="<?php echo base_url(); ?>public/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.dataTables.bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.textareaCounter.plugin.js"></script>
        <script src="<?php echo base_url(); ?>public/js/ui.spinner.js"></script>
        <script src="<?php echo base_url(); ?>public/js/custom.js"></script>
        <!-- My Custom JS-->
        <script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script>
    </body>
</html>