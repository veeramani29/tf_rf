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



            <div id="page-wrapper" style="padding:0px;">

                <div class="row">

                    <div class="col-lg-12">

                        <h1 class="page-header">Manage My Bookings</h1>

                    </div>

                    <!-- /.col-lg-12 -->

                </div>

                <div class="row" style="margin-bottom:10px;">

                    <div class="col-lg-12">

                        <ul class="nav nav-tabs" style="margin-left:0px;">

                        <li class="active"><a data-toggle="tab" href="#flightBooking">Flight</a></li>

                        <li><a data-toggle="tab" href="#hotelBooking">Hotel</a></li>

<!--                        <li><a data-toggle="tab" href="#carMarkup">Car</a></li>

                        <li><a data-toggle="tab" href="#sightseeingMarkup">Sightseeing</a></li>-->

                        </ul>

                    </div>

                </div>

                <!-- /.row -->

                <div class="row">

                    <div class="col-lg-12 tab-content">

                        <div id="flightBooking" class="panel panel-default tab-pane fade in active">

                            

                            <div class="panel-heading">

                                Manage Flight Bookings

                            </div>

                                <div class="panel-body" style="padding: 10px 0px 10px 0px;">

                                    <table width="100%" class="table table-striped table-bordered table-hover" id="FlightBookingData">

                                        <thead>

                                            <tr>

                                                <th>Pnr No.</th>

                                                <th>Reference Id</th>

                                                <th>Booking Status</th>

                                                <th>Journey Type</th>

                                                <th>Journey Date</th>

                                                <th style="width:91px !important;">Location</th>

                                                <th style="width:87px !important;">Org Price</th>

                                                <th>Booked Price</th>

                                                <th>Markup</th>

                                                <th>Booking Date</th>

                                                <th style="width:85px !important;">Action</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php

                                            if ($fl_booking_data != '') {

                                                $i = 0;

                                                foreach ($fl_booking_data as $flight) {

                                                    $depDate = explode('<br>',$flight->DepartureDateTime);

                                                    $depLoc = explode('<br>',$flight->Departure_LocationCode);

                                                    $arvLoc = explode('<br>',$flight->Arrival_LocationCode);

                                                    $cnt = count($arvLoc);

                                                    $arvLocCode = $arvLoc[$cnt-2];

                                                    $orgPrice = ($flight->price - $flight->agent_markup)

                                            ?>

                                                    <tr class="odd gradeX">

                                                        <td><?php echo $flight->pnr; ?></td>

                                                        <td><?php echo $flight->booking_ref; ?></td>

                                                        <td><?php echo $flight->booking_status; ?></td>

                                                        <td><?php echo $flight->journeyType; ?></td>

                                                        <td><?php echo $depDate[0]; ?></td>

                                                        <td style="width: 91px;"><?php echo $depLoc[0]; ?> &#8594; <?php echo $arvLocCode; ?></td>

                                                        <td style="width: 87px;"><?php echo number_format($orgPrice,2,'.',','); ?></td>

                                                        <td><?php echo number_format($flight->price,2,'.',','); ?></td>

                                                        <td><?php echo number_format($flight->agent_markup,2,'.',','); ?></td>

                                                        <td><?php echo $flight->booked_date; ?></td>

                                                        <td style="width:85px !important;" ><a href="" target="_blank">Print Ticket</a><br><a href="" target="_blank">Cancel</a></td>

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

                        <div id="hotelBooking" class="panel panel-default tab-pane fade in">

                            <div class="panel-heading">

                                Manage Hotel Bookings

                            </div>

                            <div class="panel-body" style="padding: 10px 0px 10px 0px;">

                                    <table width="100%" class="table table-striped table-bordered table-hover" id="HotelBookingData">

                                        <thead>

                                            <tr>

                                                <th>Confirmation No.</th>

                                                <th>Reference Id</th>

                                                <th>Booking Status</th>

                                                <th>Location</th>

                                                <th>Hotel Name</th>

                                                <th>Checkin-Checkout</th>

                                                <th>Org Price</th>

                                                <th>Booked Price</th>

                                                <th>Markup</th>

                                                <th>Booking Date</th>

                                                <th>Action</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php

                                            if ($ho_booking_data != '') {

                                                $i = 0;

                                                foreach ($ho_booking_data as $hotel) {

                                                    $orgPrice = ($hotel->price - $hotel->agent_markup)

                                            ?>

                                                    <tr class="odd gradeX">

                                                        <td><?php echo $hotel->confirmation_number; ?></td>

                                                        <td><?php echo $hotel->api_ref_id; ?></td>

                                                        <td><?php echo $hotel->booking_status; ?></td>

                                                        <td><?php echo $hotel->location; ?></td>

                                                        <td><?php echo ''; ?></td>

                                                        <td><?php echo $hotel->cin; ?> &#8594; <?php echo $hotel->cout; ?></td>

                                                        <td><?php echo number_format($orgPrice,2,'.',','); ?></td>

                                                        <td><?php echo number_format($hotel->price,2,'.',','); ?></td>

                                                        <td><?php echo number_format($hotel->agent_markup,2,'.',','); ?></td>

                                                        <td><?php echo $hotel->timestamp; ?></td>

                                                        <td><a href="" target="_blank">Print Voucher</a><br /><a href="" target="_blank">Print Invoice</a><br /><a href="" target="_blank">Cancel</a></td>

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

<!--                        <div id="carMarkup" class="panel panel-default tab-pane fade in">

                            <div class="panel-heading">

                                Update Car Markup

                            </div>

                            <div class="panel-body">

                            

                            </div>

                        </div>-->

<!--                        <div id="sightseeingMarkup" class="panel panel-default tab-pane fade in"></div>-->

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

