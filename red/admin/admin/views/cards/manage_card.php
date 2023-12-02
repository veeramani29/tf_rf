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
                                    <h3>Manage Card Types</h3>
                                    <ul class="nav  nav-pills">
                                        <li style='margin-right: 111px;'>
                                            <a class="tip btn btn-mini" href="<?php echo site_url();?>/cards/export_cards" data-original-title="Export Cards List" style='font-weight:bold;'>
                                               Export List
                                            </a>
                                        </li>
                                        <li class="active">
                                            <a data-toggle="tab" href="#user-list">Not Printed Card List</a>
                                        </li>
                                        <li class="">
                                            <a data-toggle="tab" href="#active-users">Printed Card List</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="box-content box-nomargin">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="user-list">
                                            <table class='table table-striped dataTable table-bordered'>
                                                <thead>
                                                    <tr>
                                                        <th>Card Type</th> 
                                                        <th>Card Number</th>
                                                        <th>Print Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        if (!empty($not_printed))
                                                        { 
                                                            for($i = 0; $i<count($not_printed); $i++){
                                                                $typeName = $this->Cards_Model->getTypeNameOnId($not_printed[$i]->card_type);
                                                    ?>
                                                        
                                                            <tr>
                                                                <td align='center' style='text-align: center;'><?php echo $typeName->name; ?></td>
                                                                <td align='center' style='text-align: center;'><?php echo $not_printed[$i]->card_number; ?></td>
                                                                <td align='center' style='text-align: center;'><?php echo $not_printed[$i]->print_status; ?></td>
                                                                <td class="center">
                                                                    <a class="btn btn-danger" href="<?php echo site_url(); ?>/cards/delete_card/<?php echo $not_printed[$i]->id; ?>" title="Delete Card" data-rel="tooltip"  data-value="2" data-user-id="<?php echo $not_printed[$i]->id; ?>" >
                                                                        Delete
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php 
                                                            }
                                                        }
                                                        else
                                                            { 
                                                        ?>
                                                    
                                                    <div class="alert alert-error">
                                                        <button class="close" data-dismiss="alert" type="button">×</button>
                                                        <strong>Error!</strong>
                                                        No Data Found. Please try after some time...
                                                    </div>
                                                        <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        <div class="tab-pane" id="active-users">
                                            <table class='table table-striped dataTable table-bordered'>
                                                <thead>
                                                    <tr>
                                                        <th>Card Type</th> 
                                                        <th>Card Number</th>
                                                        <th>Print Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        if (!empty($printed))
                                                        { 
                                                            for($i = 0; $i<count($printed); $i++){
                                                                $typeName = $this->Cards_Model->getTypeNameOnId($printed[$i]->card_type);
                                                    ?>
                                                        
                                                            <tr>
                                                                <td align='center' style='text-align: center;'><?php echo $typeName->name; ?></td>
                                                                <td align='center' style='text-align: center;'><?php echo $printed[$i]->card_number; ?></td>
                                                                <td align='center' style='text-align: center;'><?php echo $printed[$i]->print_status; ?></td>
                                                                <td class="center">
                                                                    <a class="btn btn-danger" href="<?php echo site_url(); ?>/cards/delete_card/<?php echo $printed[$i]->id; ?>" title="Delete Card" data-rel="tooltip"  data-value="2" data-user-id="<?php echo $printed[$i]->id; ?>" >
                                                                        Delete
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php 
                                                            }
                                                        }
                                                        else
                                                            { 
                                                        ?>
                                                    
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