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
                                    <h3>Manage Hotel Bookings</h3>
                                    
                                    							
                                </div>
                                <div class="box-content box-nomargin">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="user-list">
                                            <table class='table table-striped dataTable table-bordered'>


                                                <thead>
                                                    <tr>
                                                        <th>SI.No</th> 
                                                        <th>API</th> 
                                                        <th>Agent Code</th>
                                                        <th>Ref No</th>
                                                        <th>Booking Code</th>
                                                        <th>Booking Status</th>
                                                        <th>API Price(USD)</th>
                                                        <th>RKL Price(PHP)</th>
                                                        <th>Admin Markup</th>
                                                        <th>Agent Markup</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>


                                                <tbody>
                                                    <?php
                                                    if (!empty($bookings)) {
                                                        $i = 1;
                                                        ?>

                                                        <?php foreach ($bookings as $booking) {
                                                            $agentCode = $this->B2b_Model->getAgentCodeOnId($booking->user_id);
                                                            ?>
                                                            <tr>
                                                                <td align="center" style="text-align: center;"><?php echo $i++; ?></td>
                                                                <td class="center"><?php echo $booking->api; ?></td>
                                                                <td class="center"><?php echo($agentCode!=''?$agentCode->user_no:''); ?></td>
                                                                <td class="center"><?php echo $booking->api_ref_id; ?></td>
                                                                <td class="center"><?php echo $booking->confirmation_number; ?></td>
                                                                <td class="center" style="color:<?php echo($booking->booking_status=='Confirmed'?'green':'red'); ?>;"><?php echo($booking->booking_status); ?></td>
                                                                <td class="center"><?php echo ''; ?></td>
                                                                <td class="center"><?php echo $booking->price; ?></td>
                                                                <td class="center"><?php echo $booking->admin_markup; ?></td>
                                                                <td class="center"><?php echo $booking->agent_markup; ?></td>
                                                                <td class="center">
                                                                    <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/index.php/agent_hotel/voucher/<?php echo $booking->id; ?>" target="_blank">Voucher</a>&nbsp;&nbsp;&nbsp;
                                                                    <a href="#">Cancel</a>
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

                                        <div class="tab-pane" id="active-users">

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
