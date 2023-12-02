<!DOCTYPE html>
<html>
    <head>
        <title>B2C User Bookings | <?php echo PROJECT_NAME;?></title>
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
                                            <span>B2B User Bookings</span>
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
                                                <li class='active'>B2B User Bookings</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col-sm-12'>
                                    <div class='box bordered-box orange-border' style='margin-bottom:0;'>
                                        <div class='box-header blue-background'>
                                            <div class='title'>B2B User Bookings</div>
                                        </div>
					<div class="tabbable" style="margin-top: 20px">
					<ul class="nav nav-responsive nav-tabs"><li class="dropdown pull-right tabdrop hide"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-align-justify"></i> <b class="caret"></b></a><ul class="dropdown-menu"></ul></li>
						<li class="active"><a data-toggle="tab" href="#retab1"><i class="icon-build"></i> Apartments</a></li>
						<li class=""><a data-toggle="tab" href="#retab2"><i class="icon-flight"></i> Flights</a></li>
						<li class=""><a data-toggle="tab" href="#retab3"><i class="icon-hotel"></i> Hotels</a></li>
                        <li class=""><a data-toggle="tab" href="#retab4"><i class="icon-build"></i> Hotels CRS</a></li>
                        <li class=""><a data-toggle="tab" href="#retab5"><i class="icon-flight"></i> Car</a></li>
                        <li class=""><a data-toggle="tab" href="#retab6"><i class="icon-hotel"></i> Vacation</a></li>
					 </ul>
					<div class="tab-content">
					<div id="retab1" class="tab-pane active">
                                        <div class='box-content box-no-padding'>
                                            <div class='responsive-table'>
                                                <div class='scrollable-area'>

                                                    <form method="post" id="myform" action="<?php echo base_url(); ?>b2c/export_b2c_users"  onsubmit="return checkForm(this);">
                                                        <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                                                            <thead>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Date</th>
                                                                    <th>Booking Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php if (!empty($ApartmentBookings)) {
                                                                    $c = 1;
                                                                    foreach ($ApartmentBookings as $ab) { ?>
                                                                        <tr>
                                                                            <td><?= $c; ?></td>
                                                                            <td><?= $ab->pnr_no; ?></td>
                                                                            <td><?= $ab->booking_no; ?></td>
                                                                            <td><?= $ab->amount; ?></td>
                                                                            <td><?= $ab->api_status; ?></td>
                                                                            <td><?= $ab->booking_status; ?></td>
                                                                        </tr>
									                           <?php $c++; } } ?>

                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                   <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Date</th>
                                                                    <th>Booking Status</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                        
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
					</div>
					<div id="retab2" class="tab-pane">
					 <div class='box-content box-no-padding'>
                                            <div class='responsive-table'>
                                                <div class='scrollable-area'>

                                                    <form method="post" id="myform" action="<?php echo base_url(); ?>b2c/export_b2c_users"  onsubmit="return checkForm(this);">
                                                        <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                                                            <thead>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Date</th>
                                                                    <th>Booking Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                              <?php if (!empty($FlightBookings)) {
                                                                    $c = 1;
                                                                    foreach ($FlightBookings as $ab) { ?>
                                                                        <tr>
                                                                            <td><?= $c; ?></td>
                                                                            <td><?= $ab->pnr_no; ?></td>
                                                                            <td><?= $ab->booking_no; ?></td>
                                                                            <td><?= $ab->amount; ?></td>
                                                                            <td><?= $ab->api_status; ?></td>
                                                                            <td><?= $ab->booking_status; ?></td>
                                                                        </tr>
                                                               <?php $c++; } } ?>   

                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                   <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Date</th>
                                                                    <th>Booking Status</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                        
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
					</div>
					<div id="retab3" class="tab-pane">
						 <div class='box-content box-no-padding'>
                                            <div class='responsive-table'>
                                                <div class='scrollable-area'>

                                                    <form method="post" id="myform" action="<?php echo base_url(); ?>b2c/export_b2c_users"  onsubmit="return checkForm(this);">
                                                        <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                                                            <thead>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Date</th>
                                                                    <th>Booking Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                   <?php if (!empty($HotelBookings)) {
                                                                    $c = 1;
                                                                    foreach ($HotelBookings as $ab) { ?>
                                                                        <tr>
                                                                            <td><?= $c; ?></td>
                                                                            <td><?= $ab->pnr_no; ?></td>
                                                                            <td><?= $ab->booking_no; ?></td>
                                                                            <td><?= $ab->amount; ?></td>
                                                                            <td><?= $ab->api_status; ?></td>
                                                                            <td><?= $ab->booking_status; ?></td>
                                                                        </tr>
                                                               <?php $c++; } } ?>  
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                   <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Date</th>
                                                                    <th>Booking Status</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                        
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
					</div>
                    <div id="retab4" class="tab-pane">
                                        <div class='box-content box-no-padding'>
                                            <div class='responsive-table'>
                                                <div class='scrollable-area'>

                                                    <form method="post" id="myform" action="<?php echo base_url(); ?>b2c/export_b2c_users"  onsubmit="return checkForm(this);">
                                                        <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                                                            <thead>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Date</th>
                                                                    <th>Booking Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php if (!empty($HotelCRSBookings)) {
                                                                    $c = 1;
                                                                    foreach ($HotelCRSBookings as $ab) { ?>
                                                                        <tr>
                                                                            <td><?= $c; ?></td>
                                                                            <td><?= $ab->pnr_no; ?></td>
                                                                            <td><?= $ab->booking_no; ?></td>
                                                                            <td><?= $ab->amount; ?></td>
                                                                            <td><?= $ab->api_status; ?></td>
                                                                            <td><?= $ab->booking_status; ?></td>
                                                                        </tr>
                                                               <?php $c++; } } ?>   

                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                   <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Date</th>
                                                                    <th>Booking Status</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                        
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                    </div>
                    <div id="retab5" class="tab-pane">
                         <div class='box-content box-no-padding'>
                                            <div class='responsive-table'>
                                                <div class='scrollable-area'>

                                                    <form method="post" id="myform" action="<?php echo base_url(); ?>b2c/export_b2c_users"  onsubmit="return checkForm(this);">
                                                        <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                                                            <thead>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Date</th>
                                                                    <th>Booking Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                   <?php if (!empty($CarBookings)) {
                                                                    $c = 1;
                                                                    foreach ($CarBookings as $ab) { ?>
                                                                        <tr>
                                                                            <td><?= $c; ?></td>
                                                                            <td><?= $ab->pnr_no; ?></td>
                                                                            <td><?= $ab->booking_no; ?></td>
                                                                            <td><?= $ab->amount; ?></td>
                                                                            <td><?= $ab->api_status; ?></td>
                                                                            <td><?= $ab->booking_status; ?></td>
                                                                        </tr>
                                                               <?php $c++; } } ?>  
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                   <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Date</th>
                                                                    <th>Booking Status</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                        
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                    </div>
                    <div id="retab6" class="tab-pane">
                         <div class='box-content box-no-padding'>
                                            <div class='responsive-table'>
                                                <div class='scrollable-area'>

                                                    <form method="post" id="myform" action="<?php echo base_url(); ?>b2c/export_b2c_users"  onsubmit="return checkForm(this);">
                                                        <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                                                            <thead>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Date</th>
                                                                    <th>Booking Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                   <?php if (!empty($VacationBookings)) {
                                                                    $c = 1;
                                                                    foreach ($VacationBookings as $ab) { ?>
                                                                        <tr>
                                                                            <td><?= $c; ?></td>
                                                                            <td><?= $ab->pnr_no; ?></td>
                                                                            <td><?= $ab->booking_no; ?></td>
                                                                            <td><?= $ab->amount; ?></td>
                                                                            <td><?= $ab->api_status; ?></td>
                                                                            <td><?= $ab->booking_status; ?></td>
                                                                        </tr>
                                                               <?php $c++; } } ?>  
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                   <th>S.No</th>
                                                                    <th>PNR NO</th>
                                                                    <th>Booking No</th>
                                                                    <th>Amount</th>
                                                                    <th>Date</th>
                                                                    <th>Booking Status</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                        
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
        <script src="<?= base_url(); ?>assets/javascripts/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/datatables/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/datatables/dataTables.overrides.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/lightbox/lightbox.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/validate/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/validate/additional-methods.js" type="text/javascript"></script>
        <!-- / END - page related files and scripts [optional] -->
    </body>

    <script type="text/javascript">
        function activate(that) { window.location.href = that; }
    </script>
</html>
