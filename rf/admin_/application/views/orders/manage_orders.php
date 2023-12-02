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
         <link href="<?= base_url(); ?>assets/stylesheets/demo.css" media="all" rel="stylesheet" type="text/css" />
        <link  href="<?= base_url(); ?>assets/stylesheets/dataTables.tableTools.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>assets/stylesheets/jquery-ui.css" media="all" rel="stylesheet" type="text/css" />
    
        <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery-1.10.2.js" type="text/javascript"></script>

        <!-- / demo file [not required!] -->
        <!--[if lt IE 9]>
          <script src="<?= base_url(); ?>assets/javascripts/ie/html5shiv.js" type="text/javascript"></script>
          <script src="<?= base_url(); ?>assets/javascripts/ie/respond.min.js" type="text/javascript"></script>
        <![endif]-->
       




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
                                         <div class='box-content'>
                                           <form class='form form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>manage_orders" method="post"  enctype="multipart/form-data"> 
                                                <div class='form-group'>
                                                  <label class='control-label col-sm-3' for='validation_country'>User Type</label>
                                                  <div class='col-sm-4 controls'>
                                                    <select class='select2 form-control' name='user_type'>
                                                        <option value="">All Orders</option>
                                                        <option value="2">B2B Orders</option>
                                                        <option value="3">B2C Orders</option>
                                                   </select>
                                                  </div>
                                                </div>
                                                <div class='form-group'>
                                                  <label class='control-label col-sm-3' for='validation_country'>Module</label>
                                                  <div class='col-sm-4 controls'>
                                                    <select class='select2 form-control' name='module' id='module'>
                                                        <option value="">All Orders</option>
                                                        <option value="APARTMENT" api="APARTMENT">Apartment</option>
                                                        <option value="FLIGHT" api="FLIGHT">Flights</option>
                                                        <option value="HOTEL" api="Travelport">Hotels</option>
<!--                                                         <option value="HOTEL" api="CRS">Hotel CRS</option>
 -->                                                        <option value="CAR" api="CAR">Car</option>
                                                        <option value="VACATION" api="VACATION">Vacation</option>
                                                    </select>
<!--                                                     <input type="hidden" value="" id="api" name="api">
 -->                                                  </div>
                                                </div>
                                                <div class='form-group'>
                                                  <label class='control-label col-sm-3' for='validation_name'>PNR Number</label>
                                                  <div class='col-sm-3 controls'>
                                                    <input class='form-control'  name='pnr_no' placeholder='PNR Number' type='text'>
                                                  </div>
                                                  <label class='control-label col-sm-3' for='validation_name'>Booking Number</label>
                                                  <div class='col-sm-3 controls'>
                                                    <input class='form-control'  name='booking_no' placeholder='Booking Number' type='text'>
                                                  </div>
                                                </div>
                                                <div class='form-group'>
                                                  <label class='control-label col-sm-3' for='validation_name'>Transaction Number</label>
                                                  <div class='col-sm-3 controls'>
                                                    <input class='form-control'  name='transaction_id' placeholder='Transaction Number' type='text'>
                                                  </div>
                                                  <label class='control-label col-sm-3' for='validation_name'>Lead Pax</label>
                                                  <div class='col-sm-3 controls'>
                                                    <input class='form-control'  name='leadpax' placeholder='Lead Pax' type='text'>
                                                  </div>
                                                </div>
                                                <div class='form-group'>
                                                  <label class='control-label col-sm-3' for='validation_name'>Transaction Status</label>
                                                  <div class='col-sm-3 controls'>
                                                    <input class='form-control'  name='transaction_status' placeholder='Transaction Status' type='text'>
                                                  </div>
                                                  <label class='control-label col-sm-3' for='validation_name'>Payment Status</label>
                                                  <div class='col-sm-3 controls'>
                                                    <input class='form-control'  name='payment_status' placeholder='Payment Status' type='text'>
                                                  </div>
                                                </div>
                                                <div class='form-group'>
                                                  <label class='control-label col-sm-3' for='validation_name'>Voucher Date</label>
                                                  <div class='col-sm-3 controls'>
                                                    <input class='form-control'  name='voucher_date' id="voucher_date" placeholder='Voucher Date' type='text'>
                                                  </div>
                                                  <label class='control-label col-sm-3' for='validation_name'>Travel Date</label>
                                                  <div class='col-sm-3 controls'>
                                                    <input class='form-control'  name='travel_date' id="travel_date" placeholder='Travel Date' type='text'>
                                                  </div>
                                                </div>
                                                <div class='form-group'>
                                                  <label class='control-label col-sm-3' for='validation_name'>API Status</label>
                                                  <div class='col-sm-3 controls'>
                                                    <input class='form-control'  name='api_status' placeholder='API Status' type='text'>
                                                  </div>
                                                  <label class='control-label col-sm-3' for='validation_name'>Booking Status</label>
                                                  <div class='col-sm-3 controls'>
                                                    <input class='form-control'  name='booking_status' placeholder='Booking Status' type='text'>
                                                  </div>
                                                </div>
                                                 <div class='form-group' style='margin-bottom:10px;'>
                                                  <div class='row'>
                                                    <div class='col-sm-9 col-sm-offset-3'>
                                                      <button class='btn btn-primary' type='submit'>
                                                        <i class='icon-search'></i>
                                                        Get Order
                                                      </button>
                                                    </div>
                                                  </div>
                                                </div>
                                            </form>
                                            <div class='responsive-table'>
                                                <div class='scrollable-area'>
                                                    <div class='box-header blue-background'>
                                                        <div class='title'>Orders</div>

                                                    </div>
                                                    <table class='data-table-column-filter12 table table-bordered table-striped' style='margin-bottom:0;'>
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
                                                                     if ($ab->module == 'HOTEL') {
                                                                        $module = 'hotel_';
                                                                        $emaild = 'h';
                                                                      }elseif ($ab->module == 'FLIGHT') {
                                                                        $module = 'flight_';
                                                                        $emaild = 'f';
                                                                      }elseif ($ab->module == 'CAR') {
                                                                        $module = 'car_';
                                                                        $emaild = 'c';
                                                                      }

                                                                      ?>
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
                                                                                        <form class="form validate-form" style="margin-bottom: 0;" method="post" action="<?php echo WEB_URL;?>orders/<?php echo $module; ?>mail_voucher/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>">
                                                                                            <div class='modal-body'>
                                                                                                <div class='form-group'>
                                                                                                    <label class='control-label col-sm-3' for='validation_emailid'>Mail</label>
                                                                                                    <div class='col-md-9 controls'>
                                                                                                        <input class='form-control' data-rule-required='true' id="<?php echo $emaild; ?>vemail" name='<?php echo $emaild; ?>vemail' placeholder='Notification' type='text'>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class='modal-footer'>
                                                                                                <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                                                                <button class='btn btn-primary' type='submit'>Send</button>
                                                                                            </div>
                                                                                        </form>                                                                                                       <label class="control-label" for="validation_promo31"></label><br>
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
                                                                                        <form class="form validate-form" style="margin-bottom: 0;" method="post" action="<?php echo WEB_URL;?>orders/<?php echo $module; ?>mail_invoice/<?php echo $ab->module;?>/<?php echo base64_encode(base64_encode($ab->pnr_no)); ?>">
                                                                                            <div class='modal-body'>
                                                                                                <div class='form-group'>
                                                                                                    <label class='control-label col-sm-3' for='validation_emailid'>Mail</label>
                                                                                                    <div class='col-md-9 controls'>
                                                                                                        <input class='form-control' data-rule-required='true' id="<?php echo $emaild; ?>iemail" name='<?php echo $emaild; ?>iemail' placeholder='Notification' type='text'>
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
                                                                <?php $c++;  } } ?>
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
        <script src="<?= base_url(); ?>assets/javascripts/orders.js" type="text/javascript"></script>
        
    </body>

    <script type="text/javascript">
        function activate(that) { window.location.href = that; }

          setDataTable1($(".data-table-column-filter12"));
    </script>
</html>
