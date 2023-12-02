<!DOCTYPE html>
<html>
    <head>
        <title>Manage Orders | <?php echo PROJECT_NAME;?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta content='text/html;charset=utf-8' http-equiv='content-type'>
        
        <link href='<?= base_url(); ?><?= base_url(); ?>assets/images/meta_icons/favicon.ico' rel='shortcut icon' type='image/x-icon'>
        <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon.png' rel='apple-touch-icon-precomposed'>
        <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon-57x57.png' rel='apple-touch-icon-precomposed' sizes='57x57'>
        <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon-72x72.png' rel='apple-touch-icon-precomposed' sizes='72x72'>
        <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon-114x114.png' rel='apple-touch-icon-precomposed' sizes='114x114'>
        <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon-144x144.png' rel='apple-touch-icon-precomposed' sizes='144x144'>
        <!-- / START - page related stylesheets [optional] -->
        <link href="<?= base_url(); ?>assets/stylesheets/plugins/lightbox/lightbox.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/stylesheets/plugins/datatables/bootstrap-datatable.css" media="all" rel="stylesheet" type="text/css" />
        <!-- / END - page related stylesheets [optional] -->
        <!-- / bootstrap [required] -->
        <link href="<?= base_url(); ?>assets/stylesheets/bootstrap/bootstrap.css" media="all" rel="stylesheet" type="text/css" />
        <!-- / theme file [required] -->
        <link href="<?= base_url(); ?>assets/stylesheets/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
        <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
        <link href="<?= base_url(); ?>assets/stylesheets/theme-colors.css" media="all" rel="stylesheet" type="text/css" />
        <!-- / demo file [not required!] -->
        <link href="<?= base_url(); ?>assets/stylesheets/demo.css" media="all" rel="stylesheet" type="text/css" />
        <link  href="<?= base_url(); ?>assets/stylesheets/dataTables.tableTools.css" rel="stylesheet" type="text/css" />
        <!--[if lt IE 9]>
          <script src="<?= base_url(); ?>assets/javascripts/ie/html5shiv.js" type="text/javascript"></script>
          <script src="<?= base_url(); ?>assets/javascripts/ie/respond.min.js" type="text/javascript"></script>
        <![endif]-->

        <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery-1.10.2.js" type="text/javascript"></script>





        <script language="javascript">
        //frm is the form element
            function checkForm(frm) {
                var destCount = frm.elements['cid[]'].length;
                var destSel = false;
                for (i = 0; i < destCount; i++) {
                    if (frm.elements['cid[]'][i].checked) {
                        destSel = true;
                        break;
                    }
                }

                if (!destSel) {
                    alert('Select one or more B2C Users');
                }
                return destSel;
            }
        </script>




        <script type="text/javascript">
            function submitform()
            {
                if (document.myform.onsubmit &&
                        !document.myform.onsubmit())
                {
                    return;
                }
                document.myform.submit();
            }
        </script>




    </head>
    <body class='contrast-dark fixed-header'>
        <?php $this->load->view('header'); ?>
        <div id='wrapper'>
            <div id='main-nav-bg'></div>
            <?php $this->load->view('side-menu'); ?>
            <section id='content'>
                <div class='container'>
                    <div class='row' id='content-wrapper'>
                        <div class='col-xs-12'>
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <div class='page-header'>
                                        <h1 class='pull-left'>
                                            <i class='icon-user'></i>
                                            <span>Manage Orders</span>
                                        </h1>
                                        <div class='pull-right'>
                                            <ul class='breadcrumb'>
                                                <li>
                                                    <a href='<?= base_url(); ?>'>
                                                        <i class='icon-bar-chart'></i>
                                                    </a>
                                                </li>
                                                <li class='separator'>
                                                    <i class='icon-angle-right'></i>
                                                </li>
                                                <li class='active'>Manage Orders</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col-sm-12'>
                                    <div class='box bordered-box orange-border' style='margin-bottom:0;'>
                                        <div class='box-header blue-background'>
                                            <div class='title'>Manage Orders</div>
                                        </div>
                                    <div class="tabbable" style="margin-top: 20px">
                                    <ul class="nav nav-responsive nav-tabs"><li class="dropdown pull-right tabdrop hide"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-align-justify"></i> <b class="caret"></b></a><ul class="dropdown-menu"></ul></li>
                                         <li id="flights" class="active"><a data-toggle="tab" href="#retab2"><i class="icon-flight"></i> Flights</a></li>
                                      <!--  <li id="apartments" class=""><a data-toggle="tab" href="#retab1"><i class="icon-build"></i> Apartments</a></li>
                                       <li id="hotels" class=""><a data-toggle="tab" href="#retab3"><i class="icon-hotel"></i> Hotels</a></li>
                                        <li id="hotelcrs" class=""><a data-toggle="tab" href="#retab6"><i class="icon-hotel"></i> Hotels CRS</a></li>
                                        <li id="cars" class=""><a data-toggle="tab" href="#retab4"><i class="icon-hotel"></i> Car</a></li>
                                        <li id="vacation" class=""><a data-toggle="tab" href="#retab5"><i class="icon-hotel"></i> Vacation</a></li>-->
                                     </ul>
                                    <div class="tab-content">
                                    <!--<div id="retab1" class="tab-pane">
                                        <div class='box-content box-no-padding'>
                                            <div class='responsive-table'>
                                                <div class='scrollable-area'>

                                                        <table class='data-table-column-filter1 table table-bordered table-striped' style='margin-bottom:0;'>
                                                            <thead>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Voucher Date</th>
                                                                    <th>Booking Status</th>
                                                                    <th>Transaction ID</th>
                                                                    <th>Cancellation Amount</th>
                                                                    <th>Leadpax</th>
                                                                    <th>IP</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Travel Date</th>
                                                                    <th>Refund</th>
                                                                    <th>Refund Amount</th>
                                                                    <th>Refund Date</th>
                                                                    <th>API Status</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php if (!empty($Bookings)) {
                                                                    $c = 1;
                                                                    foreach ($Bookings as $ab) {  if($ab->module == 'APARTMENT'){?>
                                                                        <tr>
                                                                            <td><?php echo $c; ?></td>
                                                                            <td><?php echo $ab->pnr_no; ?></td>
                                                                            <td><?php echo $ab->booking_no; ?></td>
                                                                            <td><?php echo CURR_ICON.''.$ab->amount; ?></td>
                                                                            <td><?php echo $ab->voucher_date; ?></td>
                                                                            <td><?php echo $ab->booking_status; ?></td>
                                                                            <td><?php echo $ab->transaction_id; ?></td>
                                                                            <td><?php echo $ab->cancellation_amount; ?></td>
                                                                            <td><?php echo $ab->leadpax; ?></td>
                                                                            <td><?php echo $ab->ip; ?></td>
                                                                            <td><?php echo $ab->payment_method; ?></td>
                                                                            <td><?php echo $ab->payment_status; ?></td>
                                                                            <td><?php echo $ab->travel_date; ?></td>
                                                                            <td><?php echo $ab->refund; ?></td>
                                                                            <td><?php echo $ab->refund_amount; ?></td>
                                                                            <td><?php echo $ab->refund_date; ?></td>
                                                                            <td><?php echo $ab->api_status; ?></td>
                                                                            <td><a href="<?php echo WEB_URL;?>orders/voucher/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Voucher' target="new">
                                                                                    <i class='icon-ticket'></i>
                                                                                </a>
                                                                                 <a data-toggle='modal' href='#mail-voucher<?php echo $ab->id; ?>' role="button" class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Mail Voucher' >
                                                                                    <i class='icon-envelope'></i>
                                                                                </a>
                                                                                <a href="<?php echo WEB_URL;?>orders/invoice/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Invoice' target="new">
                                                                                    <i class='icon-ticket'></i>
                                                                                </a>
                                                                                 <a data-toggle='modal' href='#mail-invoice<?php echo $ab->id; ?>' role="button" class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Mail Invoice' >
                                                                                    <i class='icon-envelope'></i>
                                                                                </a>
                                                                                <?php if($ab->refund_status=='0') { ?>
                                                                                <a href="<?php echo WEB_URL;?>orders/refund/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-warning btn-xs has-tooltip' data-placement='top' title='Refund Amount' target="new">
                                                                                    <i class='icon-money'></i>
                                                                                </a>
                                                                                <?php } ?>
                                                                                <?php if($ab->booking_status != 'CANCELED') { ?>
                                                                                <a data-toggle='modal' href="<?php echo WEB_URL;?>orders/cancel/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Cancel' target="new" >
                                                                                    <i class='icon-minus'></i>
                                                                                </a>
                                                                                 <?php } ?>
                                                                            <div class='modal fade' id='mail-voucher<?php echo $ab->id; ?>' tabindex='-1'>
                                                                                <div class='modal-dialog'>
                                                                                    <div class='modal-content'>
                                                                                        
                                                                                        <form class="form validate-form" style="margin-bottom: 0;" method="post" action="<?php echo WEB_URL;?>orders/mail_voucher/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>">
                                                                                            <div class='modal-header'>
                                                                                                <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>X</button>
                                                                                                <h4 class='modal-title'>Send Mail Voucher</h4>
                                                                                            </div>
                                                                                            <div class='modal-body'>
                                                                                                <div class='form-group'>
                                                                                                    <label class='control-label col-sm-3' for='validation_vemail'>Mail</label>
                                                                                                    <div class='col-md-9 controls'>
                                                                                                        <input class='form-control' data-rule-required='true' id="vemail" name='vemail' placeholder='Notification' type='text'>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class='modal-footer'>
                                                                                                <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                                                                <button class='btn btn-primary' type='submit'>Send</button>
                                                                                            </div>
                                                                                            <br style="clear: both;" />
                                                                                        </form>                                                                                                       
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class='modal fade' id='mail-invoice<?php echo $ab->id; ?>' tabindex='-1'>
                                                                                <div class='modal-dialog'>
                                                                                    <div class='modal-content'>
                                                                                        <div class='modal-header'>
                                                                                            <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>X</button>
                                                                                            <h4 class='modal-title'>Send Mail Invoice</h4>
                                                                                        </div>
                                                                                        <form class="form validate-form" style="margin-bottom: 0;" method="post" action="<?php echo WEB_URL;?>orders/mail_invoice/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>">
                                                                                            <div class='modal-body'>
                                                                                                <div class='form-group'>
                                                                                                    <label class='control-label col-sm-3' for='validation_emailid'>Mail</label>
                                                                                                    <div class='col-md-9 controls'>
                                                                                                        <input class='form-control' data-rule-required='true' id="iemail" name='iemail' placeholder='Notification' type='text'>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class='modal-footer'>
                                                                                                <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                                                                <button class='btn btn-primary' type='submit'>Send</button>
                                                                                            </div>
                                                                                            <br style="clear: both;" />
                                                                                        </form>                                                                                                       
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            </td>
                                                                        </tr>
                                                                <?php $c++; } } } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Voucher Date</th>
                                                                    <th>Booking Status</th>
                                                                    <th>Transaction ID</th>
                                                                    <th>Cancellation Amount</th>
                                                                    <th>Leadpax</th>
                                                                    <th>IP</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Travel Date</th>
                                                                    <th>Refund</th>
                                                                    <th>Refund Amount</th>
                                                                    <th>Refund Date</th>
                                                                    <th>API Status</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                        
                                                </div>
                                            </div>
                                        </div>
                    </div>-->
                    <div id="retab2" class="tab-pane active">
                     <div class='box-content box-no-padding'>
                                            <div class='responsive-table'>
                                                <div class='scrollable-area'>

                                                        <table class='data-table-column-filter2 table table-bordered table-striped' style='margin-bottom:0;'>
                                                            <thead>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Voucher Date</th>
                                                                    <th>Booking Status</th>
                                                                    <th>Transaction ID</th>
                                                                    <th>Cancellation Amount</th>
                                                                    <th>Leadpax</th>
                                                                    <th>IP</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Travel Date</th>
                                                                    <th>Refund</th>
                                                                    <th>Refund Amount</th>
                                                                    <th>Refund Date</th>
                                                                    <th>API Status</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php if (!empty($Bookings)) {
                                                                    $c = 1;
                                                                    foreach ($Bookings as $ab) {  if($ab->module == 'FLIGHT'){?>
                                                                        <tr>
                                                                            <td><?php echo $c; ?></td>
                                                                            <td><?php echo $ab->pnr_no; ?></td>
                                                                            <td><?php echo $ab->booking_no; ?></td>
                                                                            <td><?php echo CURR_ICON.''.$ab->amount; ?></td>
                                                                            <td><?php echo $ab->voucher_date; ?></td>
                                                                            <td><?php echo $ab->booking_status; ?></td>
                                                                            <td><?php echo $ab->transaction_id; ?></td>
                                                                            <td><?php echo $ab->cancellation_amount; ?></td>
                                                                            <td><?php echo $ab->leadpax; ?></td>
                                                                            <td><?php echo $ab->ip; ?></td>
                                                                            <td><?php echo $ab->payment_method; ?></td>
                                                                            <td><?php echo $ab->payment_status; ?></td>
                                                                            <td><?php echo $ab->travel_date; ?></td>
                                                                            <td><?php echo $ab->refund; ?></td>
                                                                            <td><?php echo $ab->refund_amount; ?></td>
                                                                            <td><?php echo $ab->refund_date; ?></td>
                                                                            <td><?php echo $ab->api_status; ?></td>
                                                                            <td><a href="<?php echo WEB_URL;?>orders/voucher/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Voucher' target="new">
                                                                                    <i class='icon-ticket'></i>
                                                                                </a>
                                                                                 <a data-toggle='modal' href='#mail-voucher<?php echo $ab->id; ?>' role="button" class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Mail Voucher' >
                                                                                    <i class='icon-envelope'></i>
                                                                                </a>
                                                                                <a href="<?php echo WEB_URL;?>orders/invoice/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Invoice' target="new">
                                                                                    <i class='icon-ticket'></i>
                                                                                </a>
                                                                                <a data-toggle='modal' href='#mail-invoice<?php echo $ab->id; ?>' role="button" class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Mail Invoice' >
                                                                                    <i class='icon-envelope'></i>
                                                                                </a>
                                                                                 <?php if($ab->refund_status=='0') { ?>
                                                                                <a href="<?php echo WEB_URL;?>orders/refund/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-warning btn-xs has-tooltip' data-placement='top' title='Refund Amount' target="new">
                                                                                    <i class='icon-money'></i>
                                                                                </a>
                                                                                <?php } ?>
                                                                                 <?php if($ab->booking_status != 'CANCELED') { ?>
                                                                                <a data-toggle='modal' href="<?php echo WEB_URL;?>orders/cancel/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Cancel' target="new" >
                                                                                    <i class='icon-minus'></i>
                                                                                </a>
                                                                                 <?php } ?>
                                                                            
                                                                         <div class='modal fade' id='mail-voucher<?php echo $ab->id; ?>' tabindex='-1'>
                                                                                <div class='modal-dialog'>
                                                                                    <div class='modal-content'>
                                                                                        <div class='modal-header'>
                                                                                            <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>X</button>
                                                                                            <h4 class='modal-title'>Send Mail Voucher</h4>
                                                                                        </div>
                                                                                        <form class="form validate-form" style="margin-bottom: 0;" method="post" action="<?php echo WEB_URL;?>orders/flight_mail_voucher/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>">
                                                                                            <div class='modal-body'>
                                                                                                <div class='form-group'>
                                                                                                    <label class='control-label col-sm-3'>Mail</label>
                                                                                                    <div class='col-md-9 controls'>
                                                                                                        <input class='form-control' data-rule-required='true' id="fvemail" name='fvemail' placeholder='Notification' type='text'>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class='modal-footer'>
                                                                                                <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                                                                <button class='btn btn-primary' type='submit'>Send</button>
                                                                                            </div>
                                                                                        </form>                                                                                                      
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class='modal fade' id='mail-invoice<?php echo $ab->id; ?>' tabindex='-1'>
                                                                                <div class='modal-dialog'>
                                                                                    <div class='modal-content'>
                                                                                        <div class='modal-header'>
                                                                                            <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>X</button>
                                                                                            <h4 class='modal-title'>Send Mail Invoice</h4>
                                                                                        </div>
                                                                                        <form class="form validate-form" style="margin-bottom: 0;" method="post" action="<?php echo WEB_URL;?>orders/flight_mail_invoice/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>">
                                                                                            <div class='modal-body'>
                                                                                                <div class='form-group'>
                                                                                                    <label class='control-label col-sm-3' for='validation_emailid'>Mail</label>
                                                                                                    <div class='col-md-9 controls'>
                                                                                                        <input class='form-control' data-rule-required='true' id="fiemail" name='fiemail' placeholder='Notification' type='text'>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class='modal-footer'>
                                                                                                <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                                                                <button class='btn btn-primary' type='submit'>Send</button>
                                                                                            </div>
                                                                                        </form>                                                                                                       
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                         </td>
                                                                        </tr>
                                                                <?php $c++; } } } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Voucher Date</th>
                                                                    <th>Booking Status</th>
                                                                    <th>Transaction ID</th>
                                                                    <th>Cancellation Amount</th>
                                                                    <th>Leadpax</th>
                                                                    <th>IP</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Travel Date</th>
                                                                    <th>Refund</th>
                                                                    <th>Refund Amount</th>
                                                                    <th>Refund Date</th>
                                                                    <th>API Status</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                        
                                                </div>
                                            </div>
                                        </div>
                    </div>
                 <!--   <div id="retab3" class="tab-pane">
                         <div class='box-content box-no-padding'>
                                            <div class='responsive-table'>
                                                <div class='scrollable-area'>

                                                        <table class='data-table-column-filter3 table table-bordered table-striped' style='margin-bottom:0;'>
                                                            <thead>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Voucher Date</th>
                                                                    <th>Booking Status</th>
                                                                    <th>Transaction ID</th>
                                                                    <th>Cancellation Amount</th>
                                                                    <th>Leadpax</th>
                                                                    <th>IP</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Travel Date</th>
                                                                    <th>Refund</th>
                                                                    <th>Refund Amount</th>
                                                                    <th>Refund Date</th>
                                                                    <th>API Status</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php if (!empty($Bookings)) {
                                                                    $c = 1;
                                                                    foreach ($Bookings as $ab) {  
                                                                        if($ab->module == 'HOTEL'){
                                                                        $booking = $this->booking_model->getBookingbyPnr($ab->pnr_no,$ab->module)->row();
                                                                        if($booking->api == 'Travelport'){?>
                                                                        <tr>
                                                                            <td><?php echo $c; ?></td>
                                                                            <td><?php echo $ab->pnr_no; ?></td>
                                                                            <td><?php echo $ab->booking_no; ?></td>
                                                                            <td><?php echo CURR_ICON.''.$ab->amount; ?></td>
                                                                            <td><?php echo $ab->voucher_date; ?></td>
                                                                            <td><?php echo $ab->booking_status; ?></td>
                                                                             <td><?php echo $ab->transaction_id; ?></td>
                                                                            <td><?php echo $ab->cancellation_amount; ?></td>
                                                                            <td><?php echo $ab->leadpax; ?></td>
                                                                            <td><?php echo $ab->ip; ?></td>
                                                                            <td><?php echo $ab->payment_method; ?></td>
                                                                            <td><?php echo $ab->payment_status; ?></td>
                                                                            <td><?php echo $ab->travel_date; ?></td>
                                                                            <td><?php echo $ab->refund; ?></td>
                                                                            <td><?php echo $ab->refund_amount; ?></td>
                                                                            <td><?php echo $ab->refund_date; ?></td>
                                                                            <td><?php echo $ab->api_status; ?></td>
                                                                            <td><a href="<?php echo WEB_URL;?>orders/voucher/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Voucher' target="new">
                                                                                    <i class='icon-ticket'></i>
                                                                                </a>
                                                                                 <a data-toggle='modal' href='#mail-voucher<?php echo $ab->id; ?>' role="button" class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Mail Voucher' >
                                                                                    <i class='icon-envelope'></i>
                                                                                </a>
                                                                                <a href="<?php echo WEB_URL;?>orders/invoice/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Invoice' target="new">
                                                                                    <i class='icon-ticket'></i>
                                                                                </a>
                                                                                <a data-toggle='modal' href='#mail-invoice<?php echo $ab->id; ?>' role="button" class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Mail Invoice' >
                                                                                    <i class='icon-envelope'></i>
                                                                                </a>
                                                                                <?php if($ab->refund_status=='0') { ?>
                                                                                <a href="<?php echo WEB_URL;?>orders/refund/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-warning btn-xs has-tooltip' data-placement='top' title='Refund Amount' target="new">
                                                                                    <i class='icon-money'></i>
                                                                                </a>
                                                                                <?php } ?>
                                                                                 <?php if($ab->booking_status != 'CANCELED') { ?>
                                                                                <a data-toggle='modal' href="<?php echo WEB_URL;?>orders/cancel/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Cancel' target="new" >
                                                                                    <i class='icon-minus'></i>
                                                                                </a>
                                                                                 <?php } ?>
                                                                            
                                                                            <div class='modal fade' id='mail-voucher<?php echo $ab->id; ?>' tabindex='-1'>
                                                                                <div class='modal-dialog'>
                                                                                    <div class='modal-content'>
                                                                                        <div class='modal-header'>
                                                                                            <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>X</button>
                                                                                            <h4 class='modal-title'>Send Mail Voucher</h4>
                                                                                        </div>
                                                                                        <form class="form validate-form" style="margin-bottom: 0;" method="post" action="<?php echo WEB_URL;?>orders/hotel_mail_voucher/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>">
                                                                                            <div class='modal-body'>
                                                                                                <div class='form-group'>
                                                                                                    <label class='control-label col-sm-3' for='validation_emailid'>Mail</label>
                                                                                                    <div class='col-md-9 controls'>
                                                                                                        <input class='form-control' data-rule-required='true' id="hvemail" name='hvemail' placeholder='Notification' type='text'>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class='modal-footer'>
                                                                                                <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                                                                <button class='btn btn-primary' type='submit'>Send</button>
                                                                                            </div>
                                                                                        </form>                                                                                                       
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class='modal fade' id='mail-invoice<?php echo $ab->id; ?>' tabindex='-1'>
                                                                                <div class='modal-dialog'>
                                                                                    <div class='modal-content'>
                                                                                        <div class='modal-header'>
                                                                                            <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>X</button>
                                                                                            <h4 class='modal-title'>Send Mail Invoice</h4>
                                                                                        </div>
                                                                                        <form class="form validate-form" style="margin-bottom: 0;" method="post" action="<?php echo WEB_URL;?>orders/hotel_mail_invoice/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>">
                                                                                            <div class='modal-body'>
                                                                                                <div class='form-group'>
                                                                                                    <label class='control-label col-sm-3' for='validation_emailid'>Mail</label>
                                                                                                    <div class='col-md-9 controls'>
                                                                                                        <input class='form-control' data-rule-required='true' id="hiemail" name='hiemail' placeholder='Notification' type='text'>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class='modal-footer'>
                                                                                                <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                                                                <button class='btn btn-primary' type='submit'>Send</button>
                                                                                            </div>
                                                                                        </form>                                                                                                       
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            </td>
                                                                        </tr>
                                                                <?php $c++; } } } }?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Voucher Date</th>
                                                                    <th>Booking Status</th>
                                                                    <th>Transaction ID</th>
                                                                    <th>Cancellation Amount</th>
                                                                    <th>Leadpax</th>
                                                                    <th>IP</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Travel Date</th>
                                                                    <th>Refund</th>
                                                                    <th>Refund Amount</th>
                                                                    <th>Refund Date</th>
                                                                    <th>API Status</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                        
                                                </div>
                                            </div>
                                        </div>
                    </div>-->

                    <!--<div id="retab6" class="tab-pane">
                         <div class='box-content box-no-padding'>
                                            <div class='responsive-table'>
                                                <div class='scrollable-area'>

                                                        <table class='data-table-column-filter4 table table-bordered table-striped' style='margin-bottom:0;'>
                                                            <thead>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Voucher Date</th>
                                                                    <th>Booking Status</th>
                                                                    <th>Transaction ID</th>
                                                                    <th>Cancellation Amount</th>
                                                                    <th>Leadpax</th>
                                                                    <th>IP</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Travel Date</th>
                                                                    <th>Refund</th>
                                                                    <th>Refund Amount</th>
                                                                    <th>Refund Date</th>
                                                                    <th>API Status</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php if (!empty($Bookings)) {
                                                                    $c = 1;
                                                                    foreach ($Bookings as $ab) {  
                                                                        if($ab->module == 'HOTEL'){
                                                                        $booking = $this->booking_model->getBookingbyPnr($ab->pnr_no,$ab->module)->row();
                                                                        if($booking->api == 'CRS'){?>
                                                                        <tr>
                                                                            <td><?php echo $c; ?></td>
                                                                            <td><?php echo $ab->pnr_no; ?></td>
                                                                            <td><?php echo $ab->booking_no; ?></td>
                                                                            <td><?php echo CURR_ICON.''.$ab->amount; ?></td>
                                                                            <td><?php echo $ab->voucher_date; ?></td>
                                                                            <td><?php echo $ab->booking_status; ?></td>
                                                                             <td><?php echo $ab->transaction_id; ?></td>
                                                                            <td><?php echo $ab->cancellation_amount; ?></td>
                                                                            <td><?php echo $ab->leadpax; ?></td>
                                                                            <td><?php echo $ab->ip; ?></td>
                                                                            <td><?php echo $ab->payment_method; ?></td>
                                                                            <td><?php echo $ab->payment_status; ?></td>
                                                                            <td><?php echo $ab->travel_date; ?></td>
                                                                            <td><?php echo $ab->refund; ?></td>
                                                                            <td><?php echo $ab->refund_amount; ?></td>
                                                                            <td><?php echo $ab->refund_date; ?></td>
                                                                            <td><?php echo $ab->api_status; ?></td>
                                                                            <a href="<?php echo WEB_URL;?>orders/voucher/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Voucher' target="new">
                                                                                    <i class='icon-ticket'></i>
                                                                                </a>
                                                                                 <a data-toggle='modal' href='#mail-voucher<?php echo $ab->id; ?>' role="button" class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Mail Voucher' >
                                                                                    <i class='icon-envelope'></i>
                                                                                </a>
                                                                                <a href="<?php echo WEB_URL;?>orders/invoice/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Invoice' target="new">
                                                                                    <i class='icon-ticket'></i>
                                                                                </a>
                                                                                <a data-toggle='modal' href='#mail-invoice<?php echo $ab->id; ?>' role="button" class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Mail Invoice' >
                                                                                    <i class='icon-envelope'></i>
                                                                                </a>
                                                                                <?php if($ab->refund_status=='0') { ?>
                                                                                <a href="<?php echo WEB_URL;?>orders/refund/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-warning btn-xs has-tooltip' data-placement='top' title='Refund Amount' target="new">
                                                                                    <i class='icon-money'></i>
                                                                                </a>
                                                                                <?php } ?>
                                                                                 <?php if($ab->booking_status != 'CANCELED') { ?>
                                                                                <a data-toggle='modal' href="<?php echo WEB_URL;?>orders/cancel/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Cancel' target="new" >
                                                                                    <i class='icon-minus'></i>
                                                                                </a>
                                                                                 <?php } ?>
                                                                            
                                                                            <div class='modal fade' id='mail-voucher<?php echo $ab->id; ?>' tabindex='-1'>
                                                                                <div class='modal-dialog'>
                                                                                    <div class='modal-content'>
                                                                                        <div class='modal-header'>
                                                                                            <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>X</button>
                                                                                            <h4 class='modal-title'>Send Mail Voucher</h4>
                                                                                        </div>
                                                                                        <form class="form validate-form" style="margin-bottom: 0;" method="post" action="<?php echo WEB_URL;?>orders/hotel_mail_voucher/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>">
                                                                                            <div class='modal-body'>
                                                                                                <div class='form-group'>
                                                                                                    <label class='control-label col-sm-3' for='validation_emailid'>Mail</label>
                                                                                                    <div class='col-md-9 controls'>
                                                                                                        <input class='form-control' data-rule-required='true' id="hvemail" name='hvemail' placeholder='Notification' type='text'>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class='modal-footer'>
                                                                                                <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                                                                <button class='btn btn-primary' type='submit'>Send</button>
                                                                                            </div>
                                                                                        </form>                                                                                                       
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class='modal fade' id='mail-invoice<?php echo $ab->id; ?>' tabindex='-1'>
                                                                                <div class='modal-dialog'>
                                                                                    <div class='modal-content'>
                                                                                        <div class='modal-header'>
                                                                                            <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>X</button>
                                                                                            <h4 class='modal-title'>Send Mail Invoice</h4>
                                                                                        </div>
                                                                                        <form class="form validate-form" style="margin-bottom: 0;" method="post" action="<?php echo WEB_URL;?>orders/hotel_mail_invoice/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>">
                                                                                            <div class='modal-body'>
                                                                                                <div class='form-group'>
                                                                                                    <label class='control-label col-sm-3' for='validation_emailid'>Mail</label>
                                                                                                    <div class='col-md-9 controls'>
                                                                                                        <input class='form-control' data-rule-required='true' id="hiemail" name='hiemail' placeholder='Notification' type='text'>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class='modal-footer'>
                                                                                                <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                                                                <button class='btn btn-primary' type='submit'>Send</button>
                                                                                            </div>
                                                                                        </form>                                                                                                       
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            </td>
                                                                        </tr>
                                                                <?php $c++; } } } }?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Voucher Date</th>
                                                                    <th>Booking Status</th>
                                                                    <th>Transaction ID</th>
                                                                    <th>Cancellation Amount</th>
                                                                    <th>Leadpax</th>
                                                                    <th>IP</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Travel Date</th>
                                                                    <th>Refund</th>
                                                                    <th>Refund Amount</th>
                                                                    <th>Refund Date</th>
                                                                    <th>API Status</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                </div>
                                            </div>
                                        </div>
                    </div>-->
                    
                   <!-- <div id="retab4" class="tab-pane">
                         <div class='box-content box-no-padding'>
                                            <div class='responsive-table'>
                                                <div class='scrollable-area'>

                                                        <table class='data-table-column-filter5 table table-bordered table-striped' style='margin-bottom:0;'>
                                                            <thead>
                                                               <tr>
                                                                    <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Voucher Date</th>
                                                                    <th>Booking Status</th>
                                                                    <th>Transaction ID</th>
                                                                    <th>Cancellation Amount</th>
                                                                    <th>Leadpax</th>
                                                                    <th>IP</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Travel Date</th>
                                                                    <th>Refund</th>
                                                                    <th>Refund Amount</th>
                                                                    <th>Refund Date</th>
                                                                    <th>API Status</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php if (!empty($Bookings)) {
                                                                    $c = 1;
                                                                    foreach ($Bookings as $ab) {  if($ab->module == 'CAR'){?>
                                                                        <tr>
                                                                            <td><?php echo $c; ?></td>
                                                                            <td><?php echo $ab->pnr_no; ?></td>
                                                                            <td><?php echo $ab->booking_no; ?></td>
                                                                            <td><?php echo CURR_ICON.''.$ab->amount; ?></td>
                                                                            <td><?php echo $ab->voucher_date; ?></td>
                                                                            <td><?php echo $ab->booking_status; ?></td>
                                                                            <td><?php echo $ab->transaction_id; ?></td>
                                                                            <td><?php echo $ab->cancellation_amount; ?></td>
                                                                            <td><?php echo $ab->leadpax; ?></td>
                                                                            <td><?php echo $ab->ip; ?></td>
                                                                            <td><?php echo $ab->payment_method; ?></td>
                                                                            <td><?php echo $ab->payment_status; ?></td>
                                                                            <td><?php echo $ab->travel_date; ?></td>
                                                                            <td><?php echo $ab->refund; ?></td>
                                                                            <td><?php echo $ab->refund_amount; ?></td>
                                                                            <td><?php echo $ab->refund_date; ?></td>
                                                                            <td><?php echo $ab->api_status; ?></td>
                                                                            <td><a href="<?php echo WEB_URL;?>orders/voucher/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Voucher' target="new">
                                                                                    <i class='icon-ticket'></i>
                                                                                </a>
                                                                                 <a data-toggle='modal' href='#mail-voucher<?php echo $ab->id; ?>' role="button" class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Mail Voucher' >
                                                                                    <i class='icon-envelope'></i>
                                                                                </a>
                                                                                <a href="<?php echo WEB_URL;?>orders/invoice/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Invoice' target="new">
                                                                                    <i class='icon-ticket'></i>
                                                                                </a>
                                                                                <a data-toggle='modal' href='#mail-invoice<?php echo $ab->id; ?>' role="button" class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Mail Invoice' >
                                                                                    <i class='icon-envelope'></i>
                                                                                </a>
                                                                                <?php if($ab->refund_status=='0') { ?>
                                                                                <a href="<?php echo WEB_URL;?>orders/refund/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-warning btn-xs has-tooltip' data-placement='top' title='Refund Amount' target="new">
                                                                                    <i class='icon-money'></i>
                                                                                </a>
                                                                                <?php } ?>
                                                                              <?php if($ab->booking_status != 'CANCELED') { ?>
                                                                                <a data-toggle='modal' href="<?php echo WEB_URL;?>orders/cancel/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Cancel' target="new" >
                                                                                    <i class='icon-minus'></i>
                                                                                </a>
                                                                                 <?php } ?>
                                                                            <div class='modal fade' id='mail-voucher<?php echo $ab->id; ?>' tabindex='-1'>
                                                                                <div class='modal-dialog'>
                                                                                    <div class='modal-content'>
                                                                                        <div class='modal-header'>
                                                                                            <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>X</button>
                                                                                            <h4 class='modal-title'>Send Mail Voucher</h4>
                                                                                        </div>
                                                                                        <form class="form validate-form" style="margin-bottom: 0;" method="post" action="<?php echo WEB_URL;?>orders/car_mail_voucher/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>">
                                                                                            <div class='modal-body'>
                                                                                                <div class='form-group'>
                                                                                                    <label class='control-label col-sm-3' for='validation_emailid'>Mail</label>
                                                                                                    <div class='col-md-9 controls'>
                                                                                                        <input class='form-control' data-rule-required='true' id="cvemail" name='cvemail' placeholder='Notification' type='text'>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class='modal-footer'>
                                                                                                <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                                                                <button class='btn btn-primary' type='submit'>Send</button>
                                                                                            </div>
                                                                                        </form>                                                                                                       
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class='modal fade' id='mail-invoice<?php echo $ab->id; ?>' tabindex='-1'>
                                                                                <div class='modal-dialog'>
                                                                                    <div class='modal-content'>
                                                                                        <div class='modal-header'>
                                                                                            <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>X</button>
                                                                                            <h4 class='modal-title'>Send Mail Invoice</h4>
                                                                                        </div>
                                                                                        <form class="form validate-form" style="margin-bottom: 0;" method="post" action="<?php echo WEB_URL;?>orders/car_mail_invoice/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>">
                                                                                            <div class='modal-body'>
                                                                                                <div class='form-group'>
                                                                                                    <label class='control-label col-sm-3' for='validation_emailid'>Mail</label>
                                                                                                    <div class='col-md-9 controls'>
                                                                                                        <input class='form-control' data-rule-required='true' id="ciemail" name='ciemail' placeholder='Notification' type='text'>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class='modal-footer'>
                                                                                                <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                                                                <button class='btn btn-primary' type='submit'>Send</button>
                                                                                            </div>
                                                                                        </form>                                                                                                       
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            </td>
                                                                        </tr>
                                                                <?php $c++; } } } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Voucher Date</th>
                                                                    <th>Booking Status</th>
                                                                    <th>Transaction ID</th>
                                                                    <th>Cancellation Amount</th>
                                                                    <th>Leadpax</th>
                                                                    <th>IP</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Travel Date</th>
                                                                    <th>Refund</th>
                                                                    <th>Refund Amount</th>
                                                                    <th>Refund Date</th>
                                                                    <th>API Status</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                        
                                                </div>
                                            </div>
                                        </div>
                    </div>-->
                   <!-- <div id="retab5" class="tab-pane">
                         <div class='box-content box-no-padding'>
                                            <div class='responsive-table'>
                                                <div class='scrollable-area'>

                                                        <table class='data-table-column-filter6 table table-bordered table-striped' style='margin-bottom:0;'>
                                                            <thead>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Voucher Date</th>
                                                                    <th>Booking Status</th>
                                                                    <th>Transaction ID</th>
                                                                    <th>Cancellation Amount</th>
                                                                    <th>Leadpax</th>
                                                                    <th>IP</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Travel Date</th>
                                                                    <th>Refund</th>
                                                                    <th>Refund Amount</th>
                                                                    <th>Refund Date</th>
                                                                    <th>API Status</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php if (!empty($Bookings)) {
                                                                    $c = 1;
                                                                    foreach ($Bookings as $ab) {  if($ab->module == 'VACATION'){?>
                                                                        <tr>
                                                                            <td><?php echo $c; ?></td>
                                                                            <td><?php echo $ab->pnr_no; ?></td>
                                                                            <td><?php echo $ab->booking_no; ?></td>
                                                                            <td><?php echo CURR_ICON.''.$ab->amount; ?></td>
                                                                            <td><?php echo $ab->voucher_date; ?></td>
                                                                            <td><?php echo $ab->booking_status; ?></td>
                                                                             <td><?php echo $ab->transaction_id; ?></td>
                                                                            <td><?php echo $ab->cancellation_amount; ?></td>
                                                                            <td><?php echo $ab->leadpax; ?></td>
                                                                            <td><?php echo $ab->ip; ?></td>
                                                                            <td><?php echo $ab->payment_method; ?></td>
                                                                            <td><?php echo $ab->payment_status; ?></td>
                                                                            <td><?php echo $ab->travel_date; ?></td>
                                                                            <td><?php echo $ab->refund; ?></td>
                                                                            <td><?php echo $ab->refund_amount; ?></td>
                                                                            <td><?php echo $ab->refund_date; ?></td>
                                                                            <td><?php echo $ab->api_status; ?></td>
                                                                            <td><a href="<?php echo WEB_URL;?>orders/voucher/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Voucher' target="new">
                                                                                    <i class='icon-ticket'></i>
                                                                                </a>
                                                                                <a data-toggle='modal' href='#mail-voucher<?php echo $ab->id; ?>' role="button" class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Mail Voucher' >
                                                                                    <i class='icon-envelope'></i>
                                                                                </a>
                                                                                <a href="<?php echo WEB_URL;?>orders/invoice/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Invoice' target="new">
                                                                                    <i class='icon-ticket'></i>
                                                                                </a>
                                                                                <a data-toggle='modal' href='#mail-invoice<?php echo $ab->id; ?>' role="button" class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Mail Invoice' >
                                                                                    <i class='icon-envelope'></i>
                                                                                </a>
                                                                                <?php if($ab->refund_status=='0') { ?>
                                                                                <a href="<?php echo WEB_URL;?>orders/refund/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-warning btn-xs has-tooltip' data-placement='top' title='Refund Amount' target="new">
                                                                                    <i class='icon-money'></i>
                                                                                </a>
                                                                                <?php } ?>
                                                                                  <?php if($ab->booking_status != 'CANCELED') { ?>
                                                                                <a data-toggle='modal' href="<?php echo WEB_URL;?>orders/cancel/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>" class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Cancel' target="new" >
                                                                                    <i class='icon-minus'></i>
                                                                                </a>
                                                                                 <?php } ?>
                                                                            <div class='modal fade' id='mail-voucher<?php echo $ab->id; ?>' tabindex='-1'>
                                                                                <div class='modal-dialog'>
                                                                                    <div class='modal-content'>
                                                                                        <div class='modal-header'>
                                                                                            <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>X</button>
                                                                                            <h4 class='modal-title'>Send Mail Voucher</h4>
                                                                                        </div>
                                                                                        <form class="form validate-form" style="margin-bottom: 0;" method="post" action="<?php echo WEB_URL;?>orders/vacation_mail_voucher/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>">
                                                                                            <div class='modal-body'>
                                                                                                <div class='form-group'>
                                                                                                    <label class='control-label col-sm-3' for='validation_emailid'>Mail</label>
                                                                                                    <div class='col-md-9 controls'>
                                                                                                        <input class='form-control' data-rule-required='true' id="vvemail" name='vvemail' placeholder='Notification' type='text'>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class='modal-footer'>
                                                                                                <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                                                                <button class='btn btn-primary' type='submit'>Send</button>
                                                                                            </div>
                                                                                        </form>                                                                                                       
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class='modal fade' id='mail-invoice<?php echo $ab->id; ?>' tabindex='-1'>
                                                                                <div class='modal-dialog'>
                                                                                    <div class='modal-content'>
                                                                                        <div class='modal-header'>
                                                                                            <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>X</button>
                                                                                            <h4 class='modal-title'>Send Mail Invoice</h4>
                                                                                        </div>
                                                                                        <form class="form validate-form" style="margin-bottom: 0;" method="post" action="<?php echo WEB_URL;?>orders/vacation_mail_invoice/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>">
                                                                                            <div class='modal-body'>
                                                                                                <div class='form-group'>
                                                                                                    <label class='control-label col-sm-3' for='validation_emailid'>Mail</label>
                                                                                                    <div class='col-md-9 controls'>
                                                                                                        <input class='form-control' data-rule-required='true' id="viemail" name='viemail' placeholder='Notification' type='text'>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class='modal-footer'>
                                                                                                <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                                                                <button class='btn btn-primary' type='submit'>Send</button>
                                                                                            </div>
                                                                                        </form>                                                                                                       
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            </td>
                                                                        </tr>
                                                                <?php $c++; } } } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Voucher Date</th>
                                                                    <th>Booking Status</th>
                                                                    <th>Transaction ID</th>
                                                                    <th>Cancellation Amount</th>
                                                                    <th>Leadpax</th>
                                                                    <th>IP</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Travel Date</th>
                                                                    <th>Refund</th>
                                                                    <th>Refund Amount</th>
                                                                    <th>Refund Date</th>
                                                                    <th>API Status</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                        
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
                                    </div>
                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php $this->load->view('footer'); ?>
                </div>
            </section>
        </div>

        <!-- / jquery [required] -->

        <!-- / jquery mobile (for touch events) -->
        <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery.mobile.custom.min.js" type="text/javascript"></script>
        <!-- / jquery migrate (for compatibility with new jquery) [required] -->
        <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery-migrate.min.js" type="text/javascript"></script>
        <!-- / jquery ui -->
        <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery-ui.min.js" type="text/javascript"></script>
        <!-- / jQuery UI Touch Punch -->
        <script src="<?= base_url(); ?>assets/javascripts/plugins/jquery_ui_touch_punch/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
        <!-- / bootstrap [required] -->
        <script src="<?= base_url(); ?>assets/javascripts/bootstrap/bootstrap.js" type="text/javascript"></script>
        <!-- / modernizr -->
        <script src="<?= base_url(); ?>assets/javascripts/plugins/modernizr/modernizr.min.js" type="text/javascript"></script>
        <!-- / retina -->
        <script src="<?= base_url(); ?>assets/javascripts/plugins/retina/retina.js" type="text/javascript"></script>
        <!-- / theme file [required] -->
        <script src="<?= base_url(); ?>assets/javascripts/theme.js" type="text/javascript"></script>
        <!-- / demo file [not required!] -->
        <script src="<?= base_url(); ?>assets/javascripts/demo.js" type="text/javascript"></script>
        <!-- / START - page related files and scripts [optional] -->
        <script src="<?= base_url(); ?>assets/javascripts/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/datatables/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/datatables/dataTables.tableTools.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/datatables/dataTables.overrides.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/lightbox/lightbox.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/validate/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/validate/additional-methods.js" type="text/javascript"></script>
        <!-- / END - page related files and scripts [optional] -->
    </body>

    <script type="text/javascript">
        function activate(that) { window.location.href = that; }
    </script>

    <script>
    setDataTable1($(".data-table-column-filter2"));
    $('#apartments').on('click', function() {
        $('.data-table-column-filter1').show();
        $('.data-table-column-filter2').hide();   
        $('.data-table-column-filter3').hide(); 
        $('.data-table-column-filter4').hide(); 
        $('.data-table-column-filter5').hide(); 
        $('.data-table-column-filter6').hide();     
        setDataTable1($(".data-table-column-filter1"));
    })

    $('#flights').on('click', function() {
        $('.data-table-column-filter1').hide();
        $('.data-table-column-filter2').show();   
        $('.data-table-column-filter3').hide(); 
        $('.data-table-column-filter4').hide(); 
        $('.data-table-column-filter5').hide(); 
        $('.data-table-column-filter6').hide();     
        setDataTable1($(".data-table-column-filter2"));
    })

    $('#hotels').on('click', function() {
        $('.data-table-column-filter1').hide();
        $('.data-table-column-filter2').hide();   
        $('.data-table-column-filter3').show(); 
        $('.data-table-column-filter4').hide(); 
        $('.data-table-column-filter5').hide(); 
        $('.data-table-column-filter6').hide();     
        setDataTable1($(".data-table-column-filter3"));
    })

    $('#hotelcrs').on('click', function() {
        $('.data-table-column-filter1').hide();
        $('.data-table-column-filter2').hide();   
        $('.data-table-column-filter3').hide(); 
        $('.data-table-column-filter4').show(); 
        $('.data-table-column-filter5').hide(); 
        $('.data-table-column-filter6').hide();     
        setDataTable1($(".data-table-column-filter4"));
    })

    $('#cars').on('click', function() {
        $('.data-table-column-filter1').hide();
        $('.data-table-column-filter2').hide();   
        $('.data-table-column-filter3').hide(); 
        $('.data-table-column-filter4').hide(); 
        $('.data-table-column-filter5').show(); 
        $('.data-table-column-filter6').hide();     
        setDataTable1($(".data-table-column-filter5"));
    })

    $('#vacation').on('click', function() {
        $('.data-table-column-filter1').hide();
        $('.data-table-column-filter2').hide();   
        $('.data-table-column-filter3').hide(); 
        $('.data-table-column-filter4').hide(); 
        $('.data-table-column-filter5').hide(); 
        $('.data-table-column-filter6').show();     
        setDataTable1($(".data-table-column-filter6"));
    })
</script>
</html>