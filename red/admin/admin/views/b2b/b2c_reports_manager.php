<!doctype html><html lang="en"><head><meta charset="utf-8"><title>:: <?php echo Site_Title; ?> ::</title><meta name="description" content=""><meta name="viewport" content="width=device-width"><link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.css"><link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap-responsive.css"><link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.fancybox.css"><link rel="stylesheet" href="<?php echo base_url(); ?>public/css/uniform.default.css"><link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.datepicker.css"><link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.cleditor.css"><link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.plupload.queue.css"><link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.tagsinput.css"><link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.ui.plupload.css"><link rel="stylesheet" href="<?php echo base_url(); ?>public/css/chosen.css"><link rel="stylesheet" href="<?php echo base_url(); ?>public/css/chosen.css"><link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css"></head><body><?php $this->load->view('header'); ?><div class="breadcrumbs">	<div class="container-fluid">		<ul class="bread pull-left">			<li>				<a href="<?php echo site_url();?>/home"><i class="icon-home icon-white"></i></a>			</li>			<li>				<a href="<?php echo site_url();?>/home">					Dashboard				</a>			</li>		</ul>	</div></div><div class="main">	<?php echo $this->load->view('leftpanel'); ?>	<div class="container-fluid">		<div class="content">			<?php echo $this->load->view('topmenu'); ?>           <div class="row-fluid">				<div class="span12">					<div class="box">						<div class="box-head tabs">							<h3>B2C Booking Reports Manager</h3>                                                                                     <ul class="nav  nav-pills">                           								<li class="active">									<a data-toggle="tab" href="#hotel-reports">Hotel Reports</a>								</li>								<li class="">									<a data-toggle="tab" href="#flight-reports">Flight Reports</a>								</li>                                <li class="">									<a data-toggle="tab" href="#car-reports">Car Reports</a>								</li>							</ul>													</div>						<div class="box-content box-nomargin">							<div class="tab-content">									<div class="tab-pane active" id="hotel-reports" style="overflow:auto;">										<table class='table table-striped dataTable table-bordered'>											<thead>                                              <tr>                                              	    <th>SI.No</th>                                                                                                       <th>Airliners RefNo</th>                                                    <th>Hotel RefNo</th>                                                    <th>Supplier RefNo</th>                                                    <th>Booking Date</th>                                                    <th>Status</th>                                                                                                       <th>Hotel Name</th>                                                                                                        <th>Hotel City</th>                                                    <th>Check-In</th>                                                    <th>Check-Out</th>                                                    <th>Rooms</th>                                                    <th>Adults</th>                                                    <th>Childs</th>                                                    <th>Nights</th>                                                                                                       <th>First Name</th>                                                    <th>Last Name</th>                                                    <th>Mobile No</th>                                                    <th>Email</th>                                                    <th>XML Currency</th>                                                    <th>Sys. Currency</th>                                                    <th>Actual Price</th>                                                    <th>Selling Price</th>                                                    <th>Admin Profit</th>                                                                                                        <th>Payment Charge</th>                                                    <th>Actions</th>                                              </tr>                                          </thead>											<tbody>                                            <?php if (!empty($hotel_booking_summary)) { ?>                                                    <?php for ($i = 0; $i < count($hotel_booking_summary); $i++) { ?>                                                        <tr>                                                            <td><?php echo $i + 1; ?></td>                                                            <td><?php echo $hotel_booking_summary[$i]->AL_RefNo; ?></td>                                                            <td><?php echo $hotel_booking_summary[$i]->Hotel_RefNo; ?></td>                                                            <td><?php echo $hotel_booking_summary[$i]->Booking_RefNo; ?></td>                                                            <td><?php echo $hotel_booking_summary[$i]->Booking_Date; ?></td>                                                            <td><?php echo $hotel_booking_summary[$i]->Booking_Status; ?></td>                                                            <td><?php echo $hotel_booking_summary[$i]->hotel_name; ?></td>                                                            <td><?php echo $hotel_booking_summary[$i]->hotel_city; ?></td>                                                            <td><?php echo $hotel_booking_summary[$i]->check_in; ?></td>                                                            <td><?php echo $hotel_booking_summary[$i]->check_out; ?></td>                                                            <td><?php echo $hotel_booking_summary[$i]->room_count; ?></td>                                                            <td><?php echo $hotel_booking_summary[$i]->adult; ?></td>                                                            <td><?php echo $hotel_booking_summary[$i]->child; ?></td>                                                            <td><?php echo $hotel_booking_summary[$i]->nights; ?></td>                                                                                                                        <td><?php echo $hotel_booking_summary[$i]->first_name; ?></td>                                                            <td><?php echo $hotel_booking_summary[$i]->last_name; ?></td>                                                            <td><?php echo $hotel_booking_summary[$i]->mobile; ?></td>                                                            <td><?php echo $hotel_booking_summary[$i]->email; ?></td>                                                                                                                        <td><?php echo $hotel_booking_summary[$i]->Currency; ?></td>                                                            <td><?php echo $hotel_booking_summary[$i]->Xml_Currency; ?></td>                                                            <td><?php echo $hotel_booking_summary[$i]->Booking_Amount; ?></td>                                                            <td><?php echo $hotel_booking_summary[$i]->Admin_Markup; ?></td>                                                            <td><?php echo $hotel_booking_summary[$i]->Admin_Markup; ?></td>                                                            <td><?php echo $hotel_booking_summary[$i]->Payment_Charge; ?></td>                                                            <td>                                                                <a target="_blank" href="<?php echo site_url();?>/b2b/hotel_voucher?voucherId=<?php echo $hotel_booking_summary[$i]->AL_RefNo; ?>&hotelRefId=<?php echo $hotel_booking_summary[$i]->Hotel_RefNo; ?>">Voucher</a>                                                            </td>                                                        </tr>                                                    <?php } ?>                                                <?php } else { ?>                                                <div class="alert alert-block alert-danger">                                                <a href="#" data-dismiss="alert" class="close">×</a>                                                <h4 class="alert-heading">Errors!</h4>                                                No Data Found. Please try after some time...                                                </div>                                                                                                                         <?php } ?>											</tbody>										</table>									</div>                                                                        <div class="tab-pane" id="flight-reports" style="overflow:auto;">										<table class='table table-striped dataTable table-bordered'>                                          <thead>                                              <tr>                                                   	<th>SI.No</th>                                                    <th>Airliners RefNo</th>                                                    <th>PNR #</th>                                                    <th>Ticket Number</th>                                                    <th>Status</th>                                                    <th>Booking Date</th>                                                    <th>Origin</th>                                                    <th>Destination</th>                                                    <th>Adults</th>                                                    <th>Childs</th>                                                    <th>Infants</th>                                                    <th>Airline</th>                                                      <th>Depart DateTime</th>                                                    <th>Arrive DateTime</th>                                                     <th>Currency</th>                                                                                                       <th>TotalFare</th>                                                    <th>ActualFare</th>                                                    <th>Admin Profit</th>                                                     <th>Payment Charge</th>                                                                                                   <th>Trip Type</th>                                                    <th>Action</th>                                              </tr>                                          </thead>                                             <tbody>                                            <?php if (!empty($flight_booking_summary)) { ?>                                                    <?php for ($i = 0; $i < count($flight_booking_summary); $i++) { ?>                                                        <tr>                                                            <td><?php echo $i + 1; ?></td>                                                            <td><?php echo $flight_booking_summary[$i]->AirlinersRefNo; ?></td>                                                            <td><?php echo $flight_booking_summary[$i]->BookingRefId; ?></td>                                                            <td><?php echo $flight_booking_summary[$i]->Ticket_Number; ?></td>                                                            <td><?php echo $flight_booking_summary[$i]->BookingStatus; ?></td>                                                            <td><?php echo $flight_booking_summary[$i]->Booking_Date; ?></td>                                                            <td><?php echo $flight_booking_summary[$i]->Origin; ?></td>                                                            <td><?php echo $flight_booking_summary[$i]->Destination; ?></td>                                                            <td><?php echo $flight_booking_summary[$i]->Adults; ?></td>                                                            <td><?php echo $flight_booking_summary[$i]->Childs; ?></td>                                                            <td><?php echo $flight_booking_summary[$i]->Infants; ?></td>                                                            <td>                                                                <?php                                                                $OperatingAirline_Code = explode(',', $flight_booking_summary[$i]->OperatingAirline_Code);                                                                $OperatingAirline_FlightNumber = explode(',', $flight_booking_summary[$i]->OperatingAirline_FlightNumber);                                                                echo $OperatingAirline_Code[0].' - '. $OperatingAirline_FlightNumber[0];                                                                ?>                                                            </td>                                                            <td>                                                                <?php                                                                $DepartureDateTime = explode(',', $flight_booking_summary[$i]->DepartureDateTime);                                                                echo $DepartureDateTime[0];                                                                ?>                                                            </td>                                                            <td>                                                                <?php                                                                $ArrivalDateTime = explode(',', $flight_booking_summary[$i]->ArrivalDateTime);                                                                echo $ArrivalDateTime[0];                                                                ?>                                                            </td>                                                                                                                        <td><?php echo $flight_booking_summary[$i]->CurrencyCode; ?></td>                                                            <td>                                                                <?php                                                                echo $flight_booking_summary[$i]->TotalFare + $flight_booking_summary[$i]->Admin_Markup + $flight_booking_summary[$i]->Agent_Markup + $flight_booking_summary[$i]->Payment_Charge;                                                                ?>                                                            </td>                                                            <td>                                                                <?php                                                                echo $flight_booking_summary[$i]->TotalFare;                                                                ?>                                                            </td>                                                            <td><?php                                                        echo $flight_booking_summary[$i]->Admin_Markup;                                                                ?>                                                            </td>                                                             <td><?php                                                        echo $flight_booking_summary[$i]->Payment_Charge;                                                                ?>                                                            </td>                                                                                                                        <td>                                                                <?php if ($flight_booking_summary[$i]->Trip_Type == 'S') echo 'OneWay'; else if($flight_booking_summary[$i]->Trip_Type == 'R') echo 'RoundTrip'; else echo 'MultiCity'; ?>                                                            </td>                                                            <td>                                                                 <?php if($flight_booking_summary[$i]->Trip_Type == 'M') {?>                                                                    <a target="_blank" href="<?php echo site_url();?>/b2b/flight_multi_eticket/<?php echo $flight_booking_summary[$i]->AirlinersRefNo; ?>/<?php echo $flight_booking_summary[$i]->BookingRefId; ?>">E-ticket</a>                                                               <?php } else { ?>                                                                    <a target="_blank" href="<?php echo site_url();?>/b2b/flight_eticket/<?php echo $flight_booking_summary[$i]->AirlinersRefNo; ?>/<?php echo $flight_booking_summary[$i]->BookingRefId; ?>">E-ticket</a>                                                                <?php } ?>                                                           </td>                                                        </tr>                                                    <?php } ?>                                                <?php } else { ?>                                                                         <div class="alert alert-block alert-danger">                                                <a href="#" data-dismiss="alert" class="close">×</a>                                                <h4 class="alert-heading">Errors!</h4>                                                No Data Found. Please try after some time...                                                </div>                                                                                         <?php } ?>											</tbody>										</table>									</div>                                                                        <div class="tab-pane" id="car-reports" style="overflow:auto;">										<table class='table table-striped dataTable table-bordered'>                                          <thead>                                              <tr>                                                   	<th>SI.No</th>                                                    <th>Airliners RefNo</th>                                                    <th>PNR #</th>                                                    <th>Ticket Number</th>                                                    <th>Status</th>                                                    <th>Booking Date</th>                                                    <th>Pickup Location</th>                                                    <th>Dropoff Location</th>                                                     <th>Pickup DateTime</th>                                                    <th>Dropoff DateTime</th>                                                     <th>Vendor Name</th>                                                    <th>Vehicle Type</th>                                                      <th>Currency</th>                                                                                                       <th>TotalFare</th>                                                    <th>ActualFare</th>                                                    <th>Admin Profit</th>                                                     <th>Payment Charge</th>                                                     <th>Action</th>                                              </tr>                                          </thead>                                             <tbody>                                            <?php if (!empty($car_booking_summary)) { ?>                                                    <?php for ($i = 0; $i < count($car_booking_summary); $i++) { ?>                                                        <tr>                                                            <td><?php echo $i + 1; ?></td>                                                            <td><?php echo $car_booking_summary[$i]->AirlinersRefNo; ?></td>                                                            <td><?php echo $car_booking_summary[$i]->BookingRefId; ?></td>                                                            <td><?php echo $car_booking_summary[$i]->Ticket_Number; ?></td>                                                            <td><?php echo $car_booking_summary[$i]->BookingStatus; ?></td>                                                            <td><?php echo $car_booking_summary[$i]->Booking_Date; ?></td>                                                            <td><?php echo $car_booking_summary[$i]->PickUp_LocationName; ?></td>                                                            <td><?php if($car_booking_summary[$i]->DropOff_LocationName) echo $car_booking_summary[$i]->DropOff_LocationName; else 'Same Location'; ?></td>                                                            <td><?php echo $car_booking_summary[$i]->PickUpDateTime; ?></td>                                                            <td><?php echo $car_booking_summary[$i]->ReturnDateTime; ?></td> 	                                                            <td><?php echo $car_booking_summary[$i]->Vendor_Name; ?></td>                                                            <td><?php echo $car_booking_summary[$i]->VehType; ?></td>                                                            <td><?php echo $car_booking_summary[$i]->CurrencyCode; ?></td>                                                            <td>                                                                <?php                                                                echo $car_booking_summary[$i]->Total_Amount + $car_booking_summary[$i]->Admin_Markup + $car_booking_summary[$i]->Payment_Charge;                                                                ?>                                                            </td>                                                            <td>                                                                <?php                                                                echo $car_booking_summary[$i]->Total_Amount;                                                                ?>                                                            </td>                                                            <td><?php                                                        echo $car_booking_summary[$i]->Admin_Markup;                                                                ?>                                                            </td>                                                              <td><?php                                                        echo $car_booking_summary[$i]->Payment_Charge;                                                                ?>                                                            </td>                                                            <td>                                                                <a target="_blank" href="<?php echo site_url();?>/b2b/car_eticket/<?php echo $car_booking_summary[$i]->AirlinersRefNo; ?>/<?php echo $car_booking_summary[$i]->BookingRefId; ?>">E-ticket</a>                                                            </td>                                                        </tr>                                                    <?php } ?>                                                <?php } else { ?>                                                                         <div class="alert alert-block alert-danger">                                                <a href="#" data-dismiss="alert" class="close">×</a>                                                <h4 class="alert-heading">Errors!</h4>                                                No Data Found. Please try after some time...                                                </div>                                                                                         <?php } ?>											</tbody>										</table>									</div>																</div>						</div>					</div>				</div>			</div>		</div>		</div></div>	<script src="<?php echo base_url(); ?>public/js/jquery.js"></script><script src="<?php echo base_url(); ?>public/js/less.js"></script><script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script><script src="<?php echo base_url(); ?>public/js/jquery.uniform.min.js"></script><script src="<?php echo base_url(); ?>public/js/bootstrap.timepicker.js"></script><script src="<?php echo base_url(); ?>public/js/bootstrap.datepicker.js"></script><script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script><script src="<?php echo base_url(); ?>public/js/jquery.fancybox.js"></script><script src="<?php echo base_url(); ?>public/js/plupload/plupload.full.js"></script><script src="<?php echo base_url(); ?>public/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script><script src="<?php echo base_url(); ?>public/js/jquery.cleditor.min.js"></script><script src="<?php echo base_url(); ?>public/js/jquery.inputmask.min.js"></script><script src="<?php echo base_url(); ?>public/js/jquery.tagsinput.min.js"></script><script src="<?php echo base_url(); ?>public/js/jquery.mousewheel.js"></script><script src="<?php echo base_url(); ?>public/js/jquery.dataTables.min.js"></script><script src="<?php echo base_url(); ?>public/js/jquery.dataTables.bootstrap.js"></script><script src="<?php echo base_url(); ?>public/js/jquery.textareaCounter.plugin.js"></script><script src="<?php echo base_url(); ?>public/js/ui.spinner.js"></script><script src="<?php echo base_url(); ?>public/js/custom.js"></script><!-- My Custom JS--><script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script></body></html>