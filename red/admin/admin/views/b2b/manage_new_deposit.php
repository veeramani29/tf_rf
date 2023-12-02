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
                                    <h3>Manage New Deposits</h3>
                                    <!--<ul class='nav nav-tabs'>
                                                                                 <a href="<?php echo site_url(); ?>/b2b/create_agent" ><button class="btn btn-primary">Create New Agent</button></a>							
         
                                         </ul>-->
                                    <ul class="nav  nav-pills">
                                        
                                        <li class="active">
                                            <a data-toggle="tab" href="#new-deposit-list">New Deposit List</a>
                                        </li>
                                        <li class="">
                                            <a data-toggle="tab" href="#blocked-deposit-list">Blocked Deposit List</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="box-content box-nomargin">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="new-deposit-list">
                                            <table class='table dataTable table-bordered'>
                                                <thead>
                                                    <tr>
                                                        <th>Company Name</th>
                                                        <th>Agent Ref.</th>
                                                        <th>Transection Id</th>
                                                        <th>Deposited By</th>
                                                        <th>Deposit Amount</th> 
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($new_deposit)) { ?>
                                                        <?php
                                                            for ($i = 0; $i < count($new_deposit); $i++) 
                                                            { 
                                                                if($new_deposit[$i]->status == '0'){
                                                                    $agentDetails = $this->B2b_Model->getAgentDetailsOnId($new_deposit[$i]->agent_id);
                                                        ?>
                                                            <tr>
                                                                <td><?php echo($agentDetails != ''?$agentDetails->company_name:''); ?></td>
                                                                <td><?php echo($agentDetails != ''?$agentDetails->user_no:''); ?></td>
                                                                <td><?php echo $new_deposit[$i]->transection_id; ?></td>
                                                                <td class="center"><?php echo $new_deposit[$i]->added_by; ?></td>
                                                                <td class="center"><?php echo $new_deposit[$i]->deposit_amount; ?></td> 
                                                                <td class="center"><?php echo $new_deposit[$i]->add_date; ?></td>
                                                                <td class="center">
                                                                    <span class="label label-warning">Pending</span>
                                                                </td>
                                                                <td class="center">
                                                                    <a class="btn btn-danger" href="<?php echo site_url(); ?>/b2b/activate_new_deposit/<?php echo $new_deposit[$i]->id; ?>" title="Activate New Deposit" data-rel="tooltip" >
                                                                        View Details and Activate
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                                }
                                                                
                                                            }
                                                        ?>
                                                        
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
                                        <div class="tab-pane" id="blocked-deposit-list">
                                            <table class='table table-striped dataTable table-bordered'>
                                                <thead>
                                                    <tr>
                                                        <th>Transection Id</th>
                                                        <th>Deposited By</th>
                                                        <th>Deposit Amount</th> 
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead> 
                                                <tbody>
                                                    <?php if (!empty($new_deposit)) { ?>
                                                        <?php
                                                        $j = 0;
                                                        for ($i = 0; $i < count($new_deposit); $i++) {
                                                            ?>
                                                                <?php if ($new_deposit[$i]->status == '2') { ?>
                                                                <tr>
                                                                    <td><?php echo $new_deposit[$i]->transection_id; ?></td>
                                                                <td class="center"><?php echo $new_deposit[$i]->added_by; ?></td>
                                                                <td class="center"><?php echo $new_deposit[$i]->deposit_amount; ?></td> 
                                                                <td class="center"><?php echo $new_deposit[$i]->add_date; ?></td>
                                                                
                                                                <td class="center">
                                                                    <span class="label label-warning">Blocked</span>
                                                                </td>
                                                                <td class="center">
                                                                    <a class="btn btn-danger" href="<?php echo site_url(); ?>/b2b/activate_new_deposit/<?php echo $new_deposit[$i]->id; ?>" title="Activate New Deposit" data-rel="tooltip" >
                                                                        View Details and Activate
                                                                    </a>
                                                                </td>
                                                                </tr>
                                                                <?php $j++;
                                                            }
                                                            ?>
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