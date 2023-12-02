<?php
$this->load->view('common/header');

$language = $this->session->userdata('language');
//error_reporting(0);
if($language){
	$this->lang->load('Booking_Page_BP', $language);
}else{
	$this->lang->load('Booking_Page_BP', 'english');
}

$Carrier_array=array();$HiddenMarkupArr=array();

$insurance_total=0;$discount_price=0;$RedeemPoints=0;$RedeemPointsprice=0;

$Acount = 0;$Fcount = 0;$Hcount = 0;$Ccount = 0;
$Vcount = 0;
$Total = array();
foreach($cart_global as $key => $cid){
	list($module, $cid) = explode(',', $cid);
	if($module == 'APARTMENT'){
		$Acount = $Acount+1;
	}
	if($module == 'FLIGHT'){
		$Fcount = $Fcount+1;
	}
	if($module == 'HOTEL'){
		$Hcount = $Hcount+1;
	}
	if($module == 'CAR'){
		$Ccount = $Ccount+1;
	}
	if($module == 'VACATION'){
		$Vcount = $Vcount+1;
	}
}
foreach($cart_global as $key => $cid){
	list($module, $cid) = explode(',', $cid);
	if($module == 'APARTMENT'){
		$book_temp_data = $this->apartment_model->getBookingTemp($cid)->row();
		$Totall[] = $book_temp_data->total;
	}
	if($module == 'FLIGHT'){
		$cart = $this->flight_model->getBookingTemp($cid)->row();
//echo '<pre>';print_r($book_temp_data);
		$Totall[] = $cart->total;
	}
	if($module == 'HOTEL'){
		$cart = $this->hotel_model->getBookingTemp($cid)->row();
		$Totall[] = $cart->total;
	}
	if($module == 'CAR'){
		$cart = $this->car_model->getBookingTemp($cid)->row();
		$Totall[] = $cart->total;
	}
	if($module == 'VACATION'){
		$cart = $this->vacation_model->getBookingTemp($cid)->row();
		$Totall[] = $cart->total;
	}
}
?>
<style>
.smpl-step {
	border-bottom: solid 1px #e0e0e0;
	padding: 0 0 10px 0;
}
.smpl-step > .smpl-step-step {
	padding: 0;
	position: relative;
}
.smpl-step > .smpl-step-step .smpl-step-num {
	font-size: 17px;
	margin-top: -20px;
	margin-left: 47px;
}
.smpl-step > .smpl-step-step .smpl-step-info {
	font-size: 14px;
	padding-top: 27px;
}
.smpl-step > .smpl-step-step > .smpl-step-icon {
	position: absolute;
	width: 35px;
	height: 35px;
	display: block;
	background: #f77f00;
	top: 22.5px;
	left: 50%;
	margin-left: -15px;
	border-radius: 50%;
	padding: 1.5px 0 0 8px;
	color: white;
	border: 5px solid whitesmoke;
}
.smpl-step > .smpl-step-step > .progress {
	position: relative;
	border-radius: 0px;
	height: 8px;
	box-shadow: none;
	margin-top: 37px;
}
.show > .dropdown-menu{
	display: block;;
}
.smpl-step > .smpl-step-step > .progress > .progress-bar {
	width: 0px;
	box-shadow: none;
	background: #f77f00;
}
.smpl-step > .smpl-step-step.complete > .progress > .progress-bar {
	width: 100%;
}
.smpl-step > .smpl-step-step.active > .progress > .progress-bar {
	width: 50%;
}
.smpl-step > .smpl-step-step:first-child.active > .progress > .progress-bar {
	width: 0%;
}
.smpl-step > .smpl-step-step:last-child.active > .progress > .progress-bar {
	width: 100%;
}
.smpl-step > .smpl-step-step.disabled > .smpl-step-icon {
	background-color: #f5f5f5;
}
.smpl-step > .smpl-step-step.disabled > .smpl-step-icon:after {
	opacity: 0;
}
.smpl-step > .smpl-step-step:first-child > .progress {
	left: 50%;
	width: 50%;
}
.smpl-step > .smpl-step-step:last-child > .progress {
	width: 50%;
}
.smpl-step > .smpl-step-step.disabled a.smpl-step-icon {
	pointer-events: none;
}
.steps .tab-content {
	padding: 0;
	box-shadow: none;
	height: auto;
}
.bg-whitesmoke {
	background: whitesmoke;
}
@media screen and (max-width: 767px) {
	.smpl-step-step {
		width: 100%;
	}
	.smpl-step > .smpl-step-step > .smpl-step-icon {
		position: static;
		margin-left: 0;
		display: inline-block;
	}
	.smpl-step > .smpl-step-step .smpl-step-info {
		display: inline-block;
	}
	.visible-xs-block {
		display: block;
	}
}
@media screen and (min-width: 768px) {
	.visible-xs-block {
		display: none;
	}
}
.flight_passengerdetails>div select,
.flight_passengerdetails>div input{padding-right: 5px !important;}
.flight_passengerdetails>div{padding: 0 11px 0 0;}
.flight_passengerdetails>div:first-child{width: 14%;}
.flight_passengerdetails .passenger_dob{background: url('../assets/images/newch.png');background-repeat: no-repeat;background-position: 91% center;background-size: 29px;}
.flight_passengerdetails>div:nth-child(2),
.flight_passengerdetails>div:nth-child(3),
.flight_passengerdetails>div:nth-child(4){width: 20%;}
.flight_passengerdetails>div:nth-child(5),
.flight_passengerdetails>div:nth-child(6){width: 13%;}
.primary-bg{
	color: #ffffff;
	background-color: #428bca;
	padding: 10px 15px;
}
.success-bg{
	color: #ffffff;
	background-color: #73AD21;
	padding: 10px 15px;
}
</style>
<!-- Modal -->
<div class="modal fade" id="modifyModal" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modifyModalLabel"><?=lang('MODIFY_YOUR_SEARCH');?></h4>
			</div>
			<div class="modal-body bg-whitesmoke">
				<div class="alert alert-danger"></div>
				<div class="clearfix"></div>
				<div class="htlmodin widthmn">
					<div class="col-md-12 nopad">
						<div class="clearfix"></div>
						<form name="flight" id="flight" action="<?php echo WEB_URL;?>/flight/search" autocomplete="off">
							<div class="col-md-12 left marbotom20 my12">
								<label class="tripmen grycolor">
									<input type="radio" class="triprad iradio_flat-blue" name="trip_type" value="oneway" />
									<strong>One way<?php echo $this->lang->line('ony-way'); ?></strong> </label>
									<label class="tripmen grycolor">
										<input type="radio" class="triprad iradio_flat-blue" name="trip_type" value="circle" />
										<strong>Round trip<?php echo $this->lang->line('round'); ?></strong> </label>
										<label class="tripmen grycolor">
											<input type="radio" class="triprad iradio_flat-blue" name="trip_type" value="multicity" />
											<strong>Multi city<?php echo $this->lang->line('multi-destination'); ?></strong> </label>
										</div>
										<div class="clearfix"></div>
										<div class="full normal" >
											<div class="col-md-12 nopad left marbotom20 my12">
												<div class="col-md-6 md-6 xm-12">
													<div class="ritsrch">
														<div class="inbar posrel">
															<span class="flightfrom"></span>
															<input type="text" aria-invalid="false" class="flyinput fromflight" aria-required="true" placeholder="<?php echo $this->lang->line('from'); ?>" name="from" value="" required/>
														</div>
													</div>
												</div>
												<div class="col-md-6 md-6 xm-12 marxm">
													<div class="ritsrch">
														<div class="inbar posrel">
															<span class="flighttoo"></span>
															<input type="text" class="flyinput departflight" placeholder="<?php echo $this->lang->line('to'); ?>" name="to" value="" required />
														</div>
													</div>
												</div>
											</div>
											<div class="clearfix"></div>
											<div class="col-md-12 nopad left marbotom20 my12">
												<div class="col-md-4 md-4 xm-12">
													<div class="posrel">
														<input type="text" class="mySelectCalenda calinput flyinput" name="depature" id="depature" placeholder="<?php echo $this->lang->line('depart'); ?>"  value="" required/>
													</div>
												</div>
												<div class="col-md-4 md-4 xm-12 marxm">
													<div class="posrel" id="returnDiv">
														<div class="onwayonly"></div>
														<input type="text" class="mySelectCalenda calinput flyinput" name="return" id="return" placeholder="<?php echo $this->lang->line('return'); ?>" value=""/>
													</div>
												</div>
												<div class="col-md-4 md-4 xm-12 marxm">
													<div class="leftcsrch">
														<div class="inlabel psnico"><?php echo 'Class'; ?></div>
													</div>
													<div class="ritsrch">
														<div class="inbar posrel myselect">
															<select class="mySelectBoxClass flyinput text-right persn" id="class" name="class" required>
																<option value="Economy">Economy</option>
																<option value="PremiumEconomy">Premium economy</option>
																<option value="Business">Business</option>
																<option value="First">First</option>
																<option value="PremiumFirst">Premium first</option>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="clearfix"></div>
											<div class="col-md-12 md-12 nopad left marbotom20">
												<div class="col-md-3 md-3 xm-12 marxm">
													<div class="leftsrch">
														<div class="inlabel psnico"><?php echo 'Adult'; ?></div>
													</div>
													<div class="ritsrch">
														<div class="inbar posrel myselect">
															<select class="mySelectBoxClass flyinput text-right persn" id="adult" name="adult" required>
																<option>1</option>
																<option>2</option>
																<option>3</option>
																<option>4</option>
																<option>5</option>
																<option>6</option>
																<option>7</option>
																<option>8</option>
																<option>9</option>
															</select>
														</div>
													</div>
												</div>
												<div class="col-md-3 md-3 xm-12 marxm">
													<div class="leftsrch">
														<div class="inlabel psnico"><?php echo 'Children'; ?></div>
													</div>
													<div class="ritsrch">
														<div class="inbar posrel myselect">
															<select class="mySelectBoxClass flyinput text-right persn" id="child" name="child" required>
																<option>0</option>
																<option>1</option>
																<option>2</option>
																<option>3</option>
																<option>4</option>
																<option>5</option>
																<option>6</option>
																<option>7</option>
																<option>8</option>
															</select>
														</div>
													</div>
												</div>
												<div class="col-md-3 md-3 xm-12 marxm">
													<div class="leftsrch">
														<div class="inlabel chi"><?php echo 'Infant'; ?></div>
													</div>
													<div class="ritsrch">
														<div class="inbar posrel myselect">
															<select class="mySelectBoxClass flyinput text-right persn" id="infant" name="infant" required>
																<option>0</option>
																<option>1</option>
															</select>
														</div>
													</div>
												</div>
												<div class="col-md-3 md-3 xm-12 marxm">
													<label class="checkbox-inline">
														<input id="days" name="days" type="checkbox"  value="1"> Search 3 days before and after
													</label>
												</div>
											</div>
											<div class="clearfix"></div>
											<div class="col-md-8 left marbotom20">
												<input class="indxsrch shadows" name="flight_submit" type="submit" value="Search Now"/>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="full multicity" style="display:none;">
											<div class="addedCities">
												<div class="col-md-12 nopad multyflight">
													<div class="col-md-11 col-xs-11 xm-12 nopad left marbotom20">
														<div class="col-md-4 md-4 xm-12 marxm">
															<div class="ritsrch">
																<div class="inbar posrel">
																	<span class="flightfrom"></span>
																	<input type="text" class="flyinput fromflight" placeholder="<?php echo $this->lang->line('from'); ?>" name="mfrom[0]" id="from1" required/>
																</div>
															</div>
														</div>
														<div class="col-md-4 md-4 xm-12 marxm">
															<div class="ritsrch">
																<div class="inbar posrel">
																	<span class="flighttoo"></span>
																	<input type="text" class="flyinput departflight" placeholder="<?php echo $this->lang->line('to'); ?>" name="mto[0]" id="to1" required />
																</div>
															</div>
														</div>
														<div class="col-md-4 md-4 xm-12 marxm">
															<div class="posrel">
																<input type="text" class="mySelectCalenda calinput flyinput" placeholder="<?php echo $this->lang->line('depart'); ?>" name="mdepature[0]" id="depature1" required/>
															</div>
														</div>
													</div>
													<div class="col-md-1 xm-12"></div>
												</div>
												<div class="col-md-12 nopad multyflight">
													<div class="col-md-11 col-xs-11 xm-12 nopad left marbotom20">
														<div class="col-md-4 md-4 xm-12 marxm">
															<div class="ritsrch">
																<div class="inbar posrel">
																	<span class="flightfrom"></span>
																	<input type="text" class="flyinput fromflight" placeholder="<?php echo $this->lang->line('from'); ?>" name="mfrom[1]" id="from2" required/>
																</div>
															</div>
														</div>
														<div class="col-md-4 md-4 xm-12 marxm">
															<div class="ritsrch">
																<div class="inbar posrel">
																	<span class="flighttoo"></span>
																	<input type="text" class="flyinput departflight" placeholder="<?php echo $this->lang->line('to'); ?>" name="mto[1]" id="to2" required />
																</div>
															</div>
														</div>
														<div class="col-md-4 md-4 xm-12 marxm">
															<div class="posrel">
																<input type="text" class="mySelectCalenda calinput flyinput" placeholder="<?php echo $this->lang->line('depart'); ?>" name="mdepature[1]" id="depature2" required/>
															</div>
														</div>
													</div>
													<div class="col-md-1 xm-12"></div>
												</div>
											</div>
											<div class="clearfix"></div>
											<!-- add button-->
											<div class="col-md-11 col-xs-11 xm-12">
												<div class="addflight"><span class="icon icon-plus"></span>Add City</div>
											</div>
											<div class="col-md-1 col-xs-1">
												&nbsp;
											</div>
											<!-- add button end-->
											<div class="clearfix"></div>
											<div class="clearfix"></div>
											<div class="col-md-11 col-xs-11 xm-12 nopad left marbotom20">
												<div class="col-md-3 col-xs-3 fifmb xm-12 marxm">
													<div class="leftcsrch classonly">
														<div class="inlabel noiconc"><?php echo 'Class'; ?></div>
													</div>
													<div class="ritsrch">
														<div class="inbar posrel myselect">
															<select class="mySelectBoxClass flyinput text-right persn musthunded" id="class" name="class" required>
																<option value="Economy">Economy</option>
																<option value="PremiumEconomy">Premium economy</option>
																<option value="Business">Business</option>
																<option value="First">First</option>
																<option value="PremiumFirst">Premium first</option>
															</select>
														</div>
													</div>
												</div>
												<div class="col-md-3 col-xs-3 fifmb xm-12 marxm">
													<div class="leftsrch">
														<div class="inlabel psnico"><?php echo 'Adult'; ?></div>
													</div>
													<div class="ritsrch">
														<div class="inbar posrel myselect">
															<select class="mySelectBoxClass flyinput text-right persn musthunded" id="adult" name="adult" required>
																<option>1</option>
																<option>2</option>
																<option>3</option>
																<option>4</option>
																<option>5</option>
																<option>6</option>
																<option>7</option>
																<option>8</option>
																<option>9</option>
															</select>
														</div>
													</div>
												</div>
												<div class="col-md-3 col-xs-3 fifmb xm-12 marxm">
													<div class="leftsrch">
														<div class="inlabel chilic"><?php echo 'Children'; ?></div>
													</div>
													<div class="ritsrch">
														<div class="inbar posrel myselect">
															<select class="mySelectBoxClass flyinput text-right persn musthunded" id="child" name="child" required>
																<option>0</option>
																<option>1</option>
																<option>2</option>
																<option>3</option>
																<option>4</option>
																<option>5</option>
																<option>6</option>
																<option>7</option>
																<option>8</option>
															</select>
														</div>
													</div>
												</div>
												<div class="col-md-3 col-xs-3 fifmb xm-12 marxm">
													<div class="leftsrch">
														<div class="inlabel chi"><?php echo 'Infant'; ?></div>
													</div>
													<div class="ritsrch">
														<div class="inbar posrel myselect">
															<select class="mySelectBoxClass flyinput text-right persn musthunded" id="infant" name="infant" required>
																<option>0</option>
																<option>1</option>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-1"></div>
											<div class="clearfix"></div>
											<div class="col-md-8 left marbotom20">
												<input class="indxsrch shadows" name="flight_submit" type="submit" value="Search Now"/>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal -->
			<div class="lodrefrentwhole"><div class="centerload"></div></div>
			<div class="full marintopcnt witebackgrnd">
				<div class="container fordetailpage dontpad">
					<div class="container paymentpage">
						<div class="well margin-null steps">
							<div class="container">
								<div class="row">
									<div class="<?php echo ($this->input->get('orderId')!='')?"col-md-10":"col-md-8";?> bg-white">
										<div class="row smpl-step" style="border-bottom: 0;">
											<div class="col-xs-4 smpl-step-step complete">
												<div class="progress hidden-xs">
													<div class="progress-bar"></div>
												</div>
												<a href="<?php echo ($this->input->get('orderId')=='')?"#registration-tab":"javascript:;";?>" class="smpl-step-icon" data-toggle="tab">1</a>
												<div class="smpl-step-info text-center"><?=lang('PERSONAL_DETAILS');?></div>
											</div>
											<div class="col-xs-4 smpl-step-step <?php echo (($this->uri->segment(3)!='') || ($this->input->get('orderId')!=''))?"complete":"";?>">
												<div class="progress hidden-xs">
													<div class="progress-bar"></div>
												</div>
												<a href="<?php echo ($this->input->get('orderId')=='')?"#payment-tab":"javascript:;";?>" class="smpl-step-icon"  data-toggle="tab">2</a>
												<div class="smpl-step-info text-center"><?=lang('PAYMENT');?></div>
											</div>
											<div class="col-xs-4 smpl-step-step <?php echo (($this->input->get('orderId')!=''))?"complete":"";?>">
												<div class="progress hidden-xs">
													<div class="progress-bar"></div>
												</div>
												<a href="<?php echo ($this->input->get('orderId')=='')?"#confirmation-tab":"javascript:;";?>"  class="smpl-step-icon" data-toggle="tab">3</a>
												<div class="smpl-step-info text-center"><?=lang('CONFIRMATION');?></div>
											</div>
										</div>
										<!-- Tab panes -->
										<div class="tab-content">
											<div role="tabpanel" class="tab-pane fade <?php echo ($this->uri->segment(3)=='' && $this->input->get('orderId')=='')?"active in":"";?>" id="registration-tab">
												<?php if($this->input->get('orderId')==''){?>
												<div class="row">
													<div class="col-md-12">
														<br class="visible-xs-block">
														<div class="panel">
															<div class="panel-body">
													<h3 class="text-center tf-primary text-uppercase margin-top-null"><b><?=lang('FLIGHT_DETAILS');?></b></h3>
																<?php
																$AllHiddenMarkupDiscount = array();
																$adult_total_MarkupDiscount = 0;
																foreach($cart_global as $key => $cid){
																	list($module, $cid) = explode(',', $cid);
																	if($module == 'FLIGHT'){
																		$cart = $this->cart_model->getCartDataByModule($cid,$module)->row();
																		$request = json_decode(base64_decode($cart->request));
																		$passenger_details=json_decode(base64_decode($cart->passenger_details));
																		$response_details=json_decode(base64_decode($cart->response));
																		$AllHiddenMarkupDiscountDescoded = json_decode($cart->HiddenMarkupDiscountArr);
																		$adult_total_MarkupDiscount+=$cart->HiddenMarkupDiscount;
																		$AllHiddenMarkupDiscount = array_merge($AllHiddenMarkupDiscount,$AllHiddenMarkupDiscountDescoded);
																		$adult_total[]=count($passenger_details->ADT);
																		foreach($passenger_details->ADT as $adultdetails){
																			$adult_base_price[]=$adultdetails->BasePrice;
																			$adult_tax_price[]=$adultdetails->Taxes;
																			$adult_total_price[]=$adultdetails->TotalPrice;
																		}
																		if(isset($passenger_details->CNN)){
																			$childs_total[]=count($passenger_details->CNN);
																			foreach($passenger_details->CNN as $childdetails){
																				$childs_base_price[]=$childdetails->BasePrice;
																				$childs_tax_price[]=$childdetails->Taxes;
																				$child_total_price[]=$childdetails->TotalPrice;
																			}
																		}
																		if(isset($passenger_details->INF)){
																			$infants_total[]=count($passenger_details->INF);
																			foreach($passenger_details->INF as $infantdetails){
																				$infants_base_price[]=$infantdetails->BasePrice;
																				$infants_tax_price[]=$infantdetails->Taxes;
																				$infant_total_price[]=$infantdetails->TotalPrice;
																			}
																		}
// echo "<pre>";
//print_r($adult_base_price);
																		if($request->type!=''){
																			if($request->type=='R'){
																				$onward_first_seg = reset($response_details->onward->segments);
																				$onward_last_seg = end($response_details->onward->segments);
																				$Stops = count($response_details->onward->segments)-1;
																				$onward_DepartureDateTime = $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime);
																				$onward_ArrivalDateTime = $this->flight_model->get_unixtimestamp($onward_last_seg->ArrivalTime);
																				$onward_dur = $this->flight_model->get_duration(strtotime($onward_first_seg->DepartureTime),strtotime($onward_last_seg->ArrivalTime));
																				$onward_originCity = $this->flight_model->get_airport_cityname($onward_first_seg->Origin);
																				$onward_destinationCity = $this->flight_model->get_airport_cityname($onward_last_seg->Destination);
																				$onward_origin = $onward_first_seg->Origin;
																				$onward_destination = $onward_last_seg->Destination;
																				$return_first_seg = reset($response_details->return->segments);
																				$return_last_seg = end($response_details->return->segments);
																				$retStops = count($response_details->return->segments)-1;
																				$return_DepartureDateTime = $this->flight_model->get_unixtimestamp($return_first_seg->DepartureTime);
																				$return_ArrivalDateTime = $this->flight_model->get_unixtimestamp($return_last_seg->ArrivalTime);
																				$return_dur =  $this->flight_model->get_duration(strtotime($return_first_seg->DepartureTime),strtotime($return_last_seg->ArrivalTime));
																				$return_originCity = $this->flight_model->get_airport_cityname($return_first_seg->Origin);
																				$return_destinationCity = $this->flight_model->get_airport_cityname($return_last_seg->Destination);
																				$return_origin = $return_first_seg->Origin;
																				$return_destination = $return_last_seg->Destination;
																			}else if($request->type=='O'){
																				$onward_first_seg = reset($response_details->segments);
																				$onward_last_seg = end($response_details->segments);
																				$Stops = count($response_details->segments)-1;
																				$onward_DepartureDateTime = $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime);
																				$onward_ArrivalDateTime = $this->flight_model->get_unixtimestamp($onward_last_seg->ArrivalTime);
																				$onward_dur = $this->flight_model->get_duration(strtotime($onward_first_seg->DepartureTime),strtotime($onward_last_seg->ArrivalTime));
																				$onward_originCity = $this->flight_model->get_airport_cityname($onward_first_seg->Origin);
																				$onward_destinationCity = $this->flight_model->get_airport_cityname($onward_last_seg->Destination);
																				$onward_origin = $onward_first_seg->Origin;
																				$onward_destination = $onward_last_seg->Destination;
																			}else if($request->type=='M'){
																				$travel=0;$s=0; $ssss=0;
																				foreach($response_details->segments as $multisegments){
																					if(is_array($multisegments)){
																						$onward_first_seg = reset($multisegments);
																						$onward_last_seg = end($multisegments);
																						$Stops = count($multisegments)-1;
																						$dur = $this->flight_model->get_duration(strtotime($onward_first_seg->DepartureTime),strtotime($onward_last_seg->ArrivalTime));
																					}else{
																						$onward_first_seg = $multisegments;
																						$onward_last_seg = $multisegments;
																						$Stops = count($multisegments)-1;
																						$dur = $this->flight_model->get_duration(strtotime($onward_first_seg->DepartureTime),strtotime($onward_last_seg->ArrivalTime));
																					}
																					?>
																					<!-- multicity booking details -->
																					<div class="frow1">
																						<div class="col-md-12 nopad tablshow">
																							<div class="nopad fulwidmob">
																								<?php $no_of_travel=$travel+1;
																								$range=($no_of_travel==1)?'st':(($no_of_travel==2)?'nd':(($no_of_travel==3)?'rd':(($no_of_travel>3)?'th':'')));
																								?>
																								<h5  class="text-uppercase  margin-bottom-null <?php echo ($no_of_travel % 2 == 0)?'primary-bg':'success-bg';?>"><?php if($travel==0) { ?><b><?=lang('MULTICITY');?></b> <?php } echo ($no_of_travel)."<sup>".$range."</sup> ".lang('TRAVEL');?></h5>
																								<?php
																								if(!is_array($multisegments)){
																									$Carrier_array[]=$multisegments->Carrier;
																									$ArrivalDateTime  = strtotime($multisegments->ArrivalTime);
//echo $ArrivalDateTime;die;
																									$DepartureDateTime  = strtotime($multisegments->DepartureTime);
																									$seconds = $ArrivalDateTime - $DepartureDateTime;
																									$days = floor($seconds / 86400);
																									$hours = floor(($seconds - ($days * 86400)) / 3600);
																									$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
																									if($days==0){
																										$dur=$hours."h ".$minutes."m";
																									}else{
																										$dur=$days."d ".$hours."h ".$minutes."m";
																									}
																									?>
																									<div class="repflight formultity">
																										<?php
																										$vv=$ssss+1;
																										$class_arr=array('','pikeronwds','pikerret','pikermulti','pikeronwds','pikerret','pikermulti');
																										$range=($vv==1)?'st':(($vv==2)?'nd':(($vv==3)?'rd':(($vv>3)?'th':'')));
																										?>
																										<!--  <div class="<?php echo ($vv<7)?$class_arr[$vv]:$class_arr[2];?>"><?php echo ($vv)."<sup>".$range."</sup> Flight";?></div> -->
																										<div class="col-md-3 col-xs-3 fulat500">
																											<div class="alldetss">
																												<div class="detflitimg">
																													<img data-toggle="tooltip" title="Airline logo all once" data-placement="right" src="<?php echo ASSETS;?>images/airline_logo/<?php echo $multisegments->Carrier;?>.gif"  alt=""/>
																												</div>
																												<span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($multisegments->Carrier);?><?php //echo $segment->FlightNumber;?><br><?php echo $multisegments->Carrier;?><?php echo (isset($multisegments->Equipment))?"-".$multisegments->Equipment:"";?></span>
																											</div>
																										</div>
																										<div class="col-md-9 col-xs-9 nopad fulat500">
																											<div class="col-md-5 col-xs-5">
																												<span class="radiobtnnill rittextalign"><?php echo $multisegments->Origin;?> <strong><?php echo date('H:i', $this->flight_model->get_unixtimestamp($multisegments->DepartureTime));?></strong></span>
																												<span class="norto rittextalign"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($multisegments->DepartureTime));?></span>
																												<span class="simle rittextalign"><?php echo $this->flight_model->get_airport_cityname($multisegments->Origin);?> ,(<?php echo $this->flight_model->get_airport_name($multisegments->Origin);?>)(<?php echo ($this->flight_model->get_airport_citycode($multisegments->Origin));?>)</span>
																											</div>
																											<div class="col-md-2 col-xs-2">
																												<span class="timeclo"></span>
																												<span class="nortocen lbold"><?php echo $dur;?></span>
																											</div>
																											<div class="col-md-5 col-xs-5">
																												<span class="radiobtnnill"><?php echo $segment->Destination;?> <strong><?php echo date('H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></strong></span>
																												<span class="norto"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span>
																												<span class="simle"><?php echo $this->flight_model->get_airport_cityname($segment->Destination);?>,(<?php echo $this->flight_model->get_airport_name($segment->Destination);?>)(<?php echo ($this->flight_model->get_airport_citycode($segment->Destination));?>)</span>
																											</div>
																										</div>
																									</div>
																									<div class="clear"></div>
																									<?php $ssss++;} else{
																										$numberof_seg=count($multisegments);
																										$extra_segment=$multisegments;
//echo '<pre>';
//print_r($extra_segment[0]);
																										$v=0;
																										foreach($extra_segment as $keys => $segment){
																											$Carrier_array[]=$segment->Carrier;
																											$ArrivalDateTime  = strtotime($segment->ArrivalTime);
																											$DepartureDateTime  = strtotime($segment->DepartureTime);
																											$seconds = $ArrivalDateTime - $DepartureDateTime;
																											$days = floor($seconds / 86400);
																											$hours = floor(($seconds - ($days * 86400)) / 3600);
																											$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
																											if($days==0){
																												$dur=$hours."h ".$minutes."m";
																											}else{
																												$dur=$days."d ".$hours."h ".$minutes."m";
																											}
																											if($numberof_seg > 0 &&  $keys+1 < $numberof_seg){
//Exploding T from arrival time
																												list($date, $time) = explode('T',  $extra_segment[$keys]->ArrivalTime);
																												$time = preg_replace("/[.]/", " ", $time);
																												list($time, $TimeOffSet) = explode(" ", $time);
$ArrivalDateTime1 = $date." ".$time; //Exploding T and adding space
$ArrivalDateTime1 = $art = strtotime($ArrivalDateTime1);
//echo $ArrivalDateTime;die;
//Exploding T from depature time
list($date, $time) = explode('T', $extra_segment[$keys+1]->DepartureTime);
$time = preg_replace("/[.]/", " ", $time);
list($time, $TimeOffSet) = explode(" ", $time);
$DepartureDateTime1 = $date." ".$time; //Exploding T and adding space
$DepartureDateTime1 = $dpt = strtotime($DepartureDateTime1);
$seconds1 = $DepartureDateTime1 - $ArrivalDateTime1;
$days1 = floor($seconds1 / 86400);
$hours1 = floor(($seconds1 - ($days1 * 86400)) / 3600);
$minutes1 = floor(($seconds1 - ($days1 * 86400) - ($hours1 * 3600))/60);
if($days1==0){
	$Layover=$hours1."h ".$minutes1."m";
}else{
	$Layover=$days1."d ".$hours1."h ".$minutes1."m";
}
$tot_dur = $this->flight_model->get_duration(strtotime($extra_segment[$keys]->DepartureTime),strtotime($extra_segment[$keys+1]->ArrivalTime));
}
?>
<div class="repflight formultity">
	<?php
	$vv=$ssss+1;
	$class_arr=array('','pikeronwds','pikerret','pikermulti','pikeronwds','pikerret','pikermulti');
	$range=($vv==1)?'st':(($vv==2)?'nd':(($vv==3)?'rd':(($vv>3)?'th':'')));
	?>
	<!--  <div class="<?php echo ($vv<7)?$class_arr[$vv]:$class_arr[2];?>"><?php echo ($vv)."<sup>".$range."</sup> Flight";?></div> -->
	<div class="col-md-3 col-xs-3 fulat500">
		<div class="alldetss">
			<div class="detflitimg">
				<img data-toggle="tooltip" title="Airline logo all once" data-placement="right" src="<?php echo ASSETS;?>images/airline_logo/<?php echo $segment->Carrier;?>.gif"  alt=""/>
			</div>
			<span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($segment->Carrier);?><?php //echo $segment->FlightNumber;?><br><?php echo $segment->Carrier;?><?php echo (isset($segment->Equipment))?"-".$segment->Equipment:"";?></span>
		</div>
	</div>
	<div class="col-md-9 col-xs-9 nopad fulat500">
		<div class="col-md-5 col-xs-5">
			<span class="radiobtnnill rittextalign"><?php echo $segment->Origin;?> <strong><?php echo date('H:i', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></strong></span>
			<span class="norto rittextalign"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></span>
			<span class="simle rittextalign"><?php echo $this->flight_model->get_airport_cityname($segment->Origin);?> (<?php echo $this->flight_model->get_airport_name($segment->Origin);?>) (<?php echo ($this->flight_model->get_airport_citycode($segment->Origin));?>)</span>
		</div>
		<div class="col-md-2 col-xs-2">
			<span class="timeclo"></span>
			<span class="nortocen lbold"><?php echo $dur;?></span>
		</div>
		<div class="col-md-5 col-xs-5">
			<span class="radiobtnnill"><?php echo $segment->Destination;?> <strong><?php echo date('H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></strong></span>
			<span class="norto"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span>
			<span class="simle"><?php echo $this->flight_model->get_airport_cityname($segment->Destination);?>(<?php echo $this->flight_model->get_airport_name($segment->Destination);?>) (<?php echo ($this->flight_model->get_airport_citycode($segment->Destination));?>)</span>
		</div>
	</div>
	<div class="clear"></div>
	<?php  if($numberof_seg > 0 &&  $keys+1 < $numberof_seg){ ?>
	<div class="betwenrow"><?=lang('CHANGE_OF_PLANE');?> <strong><?php echo $this->flight_model->get_airport_name($segment->Destination);?></strong>, | <strong>Layover: <?php echo $Layover;?></strong> </div>
	<div class="clear"></div>
	<?php } if($numberof_seg > 0 &&  $keys+1 == $numberof_seg){ ?>
	<div class="betwenrow" style="text-align: center;"><?=lang('TOTAL_JOURNEY_TIME');?> <strong><?php echo $tot_dur;?></strong></div>
	<?php } ?>
</div>
<?php   $v++; $ssss++;} ?>
<?php   } ?>
</div>
</div>
<div class="clearfix"></div>
</div>
<!--multicity booking details end -->
<?php $s++; $travel++;} }
$BasePrice[]= $cart->BasePrice;
$TaxPrice[]= $cart->TaxPrice;
$Totalprice[]= $cart->TotalPrice;
}
}
?>
<?php if($request->type!='M'){ ?>
<!-- booking details -->
<div class="frow1">
	<div class="col-md-12 nopad tablshow">
		<div class="nopad fulwidmob">
			<h5  class="text-uppercase success-bg margin-bottom-null"><b><?php echo ($request->type=='O')? lang('ONEWAY') :(($request->type=='M')?"":"".lang('ROUNDTRIP')." (".lang('ONWARDS').")");?></b></h5>
			<!--oneway con start-->
			<?php if($request->type=='O'){
				foreach($response_details->segments as $key => $segment){
					$Carrier_array[]=$segment->Carrier;
//echo $ArrivalDateTime;
					$seg_ArrivalDateTime = $art = strtotime($segment->ArrivalTime);
//echo $ArrivalDateTime;
					$seg_DepartureDateTime = $dpt = strtotime($segment->DepartureTime);
					$seconds = $seg_ArrivalDateTime - $seg_DepartureDateTime;
					$days = floor($seconds / 86400);
					$hours = floor(($seconds - ($days * 86400)) / 3600);
					$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
// $seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
					if($days==0){
						$dur=$hours."h ".$minutes."m";
					}else{
						$dur=$days."d ".$hours."h ".$minutes."m";
					}
//To find Only Layover
					if(count($response_details->segments) > 0 &&  $key+1 < count($response_details->segments)){
//Exploding T from arrival time
						list($date, $time) = explode('T',  $response_details->segments[$key]->ArrivalTime);
						$time = preg_replace("/[.]/", " ", $time);
						list($time, $TimeOffSet) = explode(" ", $time);
$ArrivalDateTime1 = $date." ".$time; //Exploding T and adding space
$ArrivalDateTime1 = $art = strtotime($ArrivalDateTime1);
//echo $ArrivalDateTime;die;
//Exploding T from depature time
list($date, $time) = explode('T', $response_details->segments[$key+1]->DepartureTime);
$time = preg_replace("/[.]/", " ", $time);
list($time, $TimeOffSet) = explode(" ", $time);
$DepartureDateTime1 = $date." ".$time; //Exploding T and adding space
$DepartureDateTime1 = $dpt = strtotime($DepartureDateTime1);
$ArrivalDateTime1 = $art = strtotime($response_details->segments[$key]->ArrivalTime);
$DepartureDateTime1 = $dpt = strtotime($response_details->segments[$key]->DepartureTime);
$seconds1 = $DepartureDateTime1 - $ArrivalDateTime1;
$days1 = floor($seconds1 / 86400);
$hours1 = floor(($seconds1 - ($days1 * 86400)) / 3600);
$minutes1 = floor(($seconds1 - ($days1 * 86400) - ($hours1 * 3600))/60);
if($days1==0){
	$Layover=$hours1."h ".$minutes1."m";
}else{
	$Layover=$days1."d ".$hours1."h ".$minutes1."m";
}
}
?>
<!--oneway div Start end-->
<div class="repflight">
	<div class="col-md-3 col-xs-3 fulat500">
		<div class="alldetss">
			<div class="detflitimg">
				<img data-toggle="tooltip" title="Airline logo all once" data-placement="right" src="<?php echo ASSETS;?>images/airline_logo/<?php echo $segment->Carrier;?>.gif"  alt=""/>
			</div>
			<span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($segment->Carrier);?><?php //echo $segment->FlightNumber;?><br><?php echo $segment->Carrier;?><?php echo (isset($segment->Equipment))?"-".$segment->Equipment:"";?></span>
		</div>
	</div>
	<div class="col-md-9 col-xs-9 nopad fulat500">
		<div class="col-md-5 col-xs-5">
			<span class="radiobtnnill rittextalign"><?php echo $segment->Origin;?> <strong><?php echo date('H:i', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?> </strong></span>
			<span class="norto rittextalign"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></span>
			<span class="simle rittextalign"><?php echo $this->flight_model->get_airport_cityname($segment->Origin);?>(<?php echo $this->flight_model->get_airport_name($segment->Origin);?>)(<?php echo ($this->flight_model->get_airport_citycode($segment->Origin));?>)</span>
		</div>
		<div class="col-md-2 col-xs-2">
			<span class="timeclo"></span>
			<span class="nortocen lbold"><?php echo /*$Tot_traveltime;*/ $dur;?></span>
		</div>
		<div class="col-md-5 col-xs-5">
			<span class="radiobtnnill"><?php echo $segment->Destination;?> <strong><?php echo date('H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?> </strong></span>
			<span class="norto"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span>
			<span class="simle"><?php echo $this->flight_model->get_airport_cityname($segment->Destination);?>(<?php echo $this->flight_model->get_airport_name($segment->Destination);?>)(<?php echo ($this->flight_model->get_airport_citycode($segment->Destination));?>)</span>
		</div>
	</div>
</div>
<div class="clear"></div>
<?php if(count($response_details->segments) > 0 &&  $key+1 < count($response_details->segments)){?>
<div class="betwenrow"><?=lang('CHANGE_OF_PLANE');?> <strong><?php echo $this->flight_model->get_airport_name($segment->Destination);?></strong>, | <strong>Layover: <?php echo $Layover;?></strong> </div>
<div class="clear"></div>
<?php }  ?>
<?php }?>
<div class="betwenrow" style="text-align: center;"><?=lang('TOTAL_JOURNEY_TIME');?> <strong><?php echo $onward_dur;?></strong></div>
<!--oneway div elms end-->
<?php }?>  <!--oneway con end-->
<!--roundtrip onward con start-->
<?php
if($request->type=='R'){
	foreach($response_details->onward->segments as $key => $segment){
		$Carrier_array[]=$segment->Carrier;
		$seg_ArrivalDateTime = $art =strtotime($segment->ArrivalTime);
//echo $ArrivalDateTime;die;
		$seg_DepartureDateTime = $dpt =strtotime($segment->DepartureTime);
		$seconds = $seg_ArrivalDateTime - $seg_DepartureDateTime;
		$days = floor($seconds / 86400);
		$hours = floor(($seconds - ($days * 86400)) / 3600);
		$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
		if($days==0){
			$dur=$hours."h ".$minutes."m";
		}else{
			$dur=$days."d ".$hours."h ".$minutes."m";
		}
		if(count($response_details->onward->segments) > 0 &&  $key+1 < count($response_details->onward->segments)){
//Exploding T from arrival time
			list($date, $time) = explode('T',  $response_details->onward->segments[$key]->ArrivalTime);
			$time = preg_replace("/[.]/", " ", $time);
			list($time, $TimeOffSet) = explode(" ", $time);
$ArrivalDateTime1 = $date." ".$time; //Exploding T and adding space
$ArrivalDateTime1 = $art = strtotime($ArrivalDateTime1);
//echo $ArrivalDateTime;die;
//Exploding T from depature time
list($date, $time) = explode('T', $response_details->onward->segments[$key+1]->DepartureTime);
$time = preg_replace("/[.]/", " ", $time);
list($time, $TimeOffSet) = explode(" ", $time);
$DepartureDateTime1 = $date." ".$time; //Exploding T and adding space
$DepartureDateTime1 = $dpt = strtotime($DepartureDateTime1);
$seconds1 = $DepartureDateTime1 - $ArrivalDateTime1;
$days1 = floor($seconds1 / 86400);
$hours1 = floor(($seconds1 - ($days1 * 86400)) / 3600);
$minutes1 = floor(($seconds1 - ($days1 * 86400) - ($hours1 * 3600))/60);
if($days1==0){
	$Layover=$hours1."h ".$minutes1."m";
}else{
	$Layover=$days1."d ".$hours1."h ".$minutes1."m";
}
}
?>
<!--roundtrip onward elemns start-->
<div class="repflight roundts">
	<div class="tablpik">
		<!-- 	<div class="pikeronwds"><?=lang('ONWARD');?></div> -->
		<div class="col-md-3 col-xs-3 fulat500">
			<div class="alldetss">
				<div class="detflitimg">
					<img data-toggle="tooltip" title="Airline logo all once" data-placement="right" src="<?php echo ASSETS;?>images/airline_logo/<?php echo $segment->Carrier;?>.gif"  alt=""/>
				</div>
				<span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($segment->Carrier);?><?php //echo $segment->FlightNumber;?><br><?php echo $segment->Carrier;?><?php echo (isset($segment->Equipment))?"-".$segment->Equipment:"";?></span>
			</div>
		</div>
		<div class="col-md-9 col-xs-9 nopad fulat500">
			<div class="col-md-5 col-xs-5">
				<span class="radiobtnnill rittextalign"><?php echo $segment->Origin;?> <strong><?php echo date('H:i', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></strong></span>
				<span class="norto rittextalign"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></span>
				<span class="simle rittextalign"><?php echo $this->flight_model->get_airport_cityname($segment->Origin);?>(<?php echo $this->flight_model->get_airport_name($segment->Origin);?>)(<?php echo ($this->flight_model->get_airport_citycode($segment->Origin));?>)</span>
			</div>
			<div class="col-md-2 col-xs-2">
				<span class="timeclo"></span>
				<span class="nortocen lbold"><?php echo  $dur;?></span>
			</div>
			<div class="col-md-5 col-xs-5">
				<span class="radiobtnnill"><?php echo $segment->Destination;?> <strong><?php echo date('H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></strong></span>
				<span class="norto"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span>
				<span class="simle"><?php echo $this->flight_model->get_airport_cityname($segment->Destination);?>(<?php echo $this->flight_model->get_airport_name($segment->Destination);?>)(<?php echo ($this->flight_model->get_airport_citycode($segment->Destination));?>)</span>
			</div>
		</div>
	</div>
</div>
<?php if(count($response_details->onward->segments) > 0 &&  $key+1 < count($response_details->onward->segments)){?>
<div class="betwenrow">Change of Plane at <strong><?php echo $this->flight_model->get_airport_name($segment->Destination);?></strong>, | <strong>Layover: <?php echo $Layover;?></strong> </div>
<?php } if(count($response_details->onward->segments) > 0 &&  $key+1 == count($response_details->onward->segments)){ ?>
<div class="betwenrow" style="text-align: center;"><?=lang('TOTAL_JOURNEY_TIME');?> <strong><?php echo $onward_dur;?></strong></div>
<?php } ?>
<!--roundtrip onward elemets end-->
<?php } }?>
<!--roundtrip onward con end-->
</div>
</div>
<div class="clearfix"></div>
</div><!-- booking details -->
<?php }  if($request->type=='R'){ ?> <!--roundtrip return  con and element start-->
<!-- round trip booking details -->
<div class="frow1">
	<div class="col-md-12 nopad tablshow">
		<div class="nopad fulwidmob">
			<h5  class="text-uppercase primary-bg  margin-bottom-null"><b><?=lang('RETURN');?></b></h5>
			<?php
			foreach($response_details->return->segments as $key => $segment){

				$Carrier_array[]=$segment->Carrier;
				$seg1_ArrivalDateTime = $art =strtotime($segment->ArrivalTime);
//echo $ArrivalDateTime;die;
				$seg1_DepartureDateTime = $dpt =strtotime($segment->DepartureTime);
				$seconds = $seg1_ArrivalDateTime - $seg1_DepartureDateTime;
				$days = floor($seconds / 86400);
				$hours = floor(($seconds - ($days * 86400)) / 3600);
				$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
				if($days==0){
					$dur=$hours."h ".$minutes."m";
				}else{
					$dur=$days."d ".$hours."h ".$minutes."m";
				}
				if(count($response_details->return->segments) > 0 &&  $key+1 < count($response_details->return->segments)){
//Exploding T from arrival time
					list($date, $time) = explode('T',  $response_details->return->segments[$key]->ArrivalTime);
					$time = preg_replace("/[.]/", " ", $time);
					list($time, $TimeOffSet) = explode(" ", $time);
$ArrivalDateTime1 = $date." ".$time; //Exploding T and adding space
$ArrivalDateTime1 = $art = strtotime($ArrivalDateTime1);
//echo $ArrivalDateTime;die;
//Exploding T from depature time
list($date, $time) = explode('T', $response_details->return->segments[$key+1]->DepartureTime);
$time = preg_replace("/[.]/", " ", $time);
list($time, $TimeOffSet) = explode(" ", $time);
$DepartureDateTime1 = $date." ".$time; //Exploding T and adding space
$DepartureDateTime1 = $dpt = strtotime($DepartureDateTime1);
$seconds1 = $DepartureDateTime1 - $ArrivalDateTime1;
$days1 = floor($seconds1 / 86400);
$hours1 = floor(($seconds1 - ($days1 * 86400)) / 3600);
$minutes1 = floor(($seconds1 - ($days1 * 86400) - ($hours1 * 3600))/60);
if($days1==0){
	$Layover=$hours1."h ".$minutes1."m";
}else{
	$Layover=$days1."d ".$hours1."h ".$minutes1."m";
}
}
?>
<div class="repflight roundts">
	<div class="tablpik">
		<!-- 	<div class="pikerret"><?=lang('RETURN');?></div> -->
		<div class="col-md-3 col-xs-3 fulat500">
			<div class="alldetss">
				<div class="detflitimg">
					<img data-toggle="tooltip" title="Airline logo all once" data-placement="right" src="<?php echo ASSETS;?>images/airline_logo/<?php echo $segment->Carrier;?>.gif"  alt=""/>
				</div>
				<span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($segment->Carrier);?><?php //echo $segment->FlightNumber;?><br><?php echo $segment->Carrier;?><?php echo (isset($segment->Equipment))?"-".$segment->Equipment:"";?></span>
			</div>
		</div>
		<div class="col-md-9 col-xs-9 nopad fulat500">
			<div class="col-md-5 col-xs-5">
				<span class="radiobtnnill rittextalign"><?php echo $segment->Origin;?> <strong><?php echo date('H:i', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></strong></span>
				<span class="norto rittextalign"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($segment->DepartureTime));?></span>
				<span class="simle rittextalign"><?php echo $this->flight_model->get_airport_cityname($segment->Origin);?>(<?php echo $this->flight_model->get_airport_name($segment->Origin);?>)(<?php echo ($this->flight_model->get_airport_citycode($segment->Origin));?>)</span>
			</div>
			<div class="col-md-2 col-xs-2">
				<span class="timeclo"></span>
				<span class="nortocen lbold"><?php echo  $dur;?></span>
			</div>
			<div class="col-md-5 col-xs-5">
				<span class="radiobtnnill"><?php echo $segment->Destination;?> <strong><?php echo date('H:i', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></strong></span>
				<span class="norto"><?php echo date('d M, Y', $this->flight_model->get_unixtimestamp($segment->ArrivalTime));?></span>
				<span class="simle"><?php echo $this->flight_model->get_airport_cityname($segment->Destination);?> (<?php echo $this->flight_model->get_airport_name($segment->Destination);?>)(<?php echo ($this->flight_model->get_airport_citycode($segment->Destination));?>)</span>
			</div>
		</div>
	</div>
</div>
<div class="clear"></div>
<?php if(count($response_details->return->segments) > 0 &&  $key+1 < count($response_details->return->segments)){?>
<div class="betwenrow"><?=lang('CHANGE_OF_PLANE');?> <strong><?php echo $this->flight_model->get_airport_name($segment->Destination);?></strong>, | <strong>Layover: <?php echo $Layover;?></strong> </div>
<div class="clear"></div>
<?php } if(count($response_details->return->segments) > 0 &&  $key+1 == count($response_details->return->segments)){ ?>
<div class="betwenrow" style="text-align: center;"><?=lang('TOTAL_JOURNEY_TIME');?> <strong><?php echo $return_dur;?></strong></div>
<?php } }?>
</div>
</div>
<div class="clearfix"></div>
</div><!-- round trip booking details end -->
<!--roundtrip return  elemns end-->
<?php } } ?> <!--roundtrip return   and !multicity con end-->
</div>
</div>
</div>
</div>
<?php } ?> <!--order id null con end-->
<?php if($this->session->userdata("b2c_id")==''){?>
<p class="text-primary"><?=lang('WHO_ARE_THE_PASSENGERS');?></p>
<p><?=lang('LOGIN_TO_PROFILE');?></p>
<p><?=lang('NO_PROFILE');?>.</p>
<div class="popuperror" style="display:none;"></div>
<div id="fadeandscale" style="display:none;"></div>
<div class="form-group" id="continuelogin"><!-- Login-->
	<div class="row">
		<form id="login2" name="login" action="<?php echo WEB_URL;?>/account/login">
			<input type="hidden" name="bookertype" id="bookertype" value="<?php echo $this->session->userdata("b2c_id");?>">
			<div class="col-md-5">
				<label><?=lang('C_USERNAME');?></label>
				<input type="email" name="email" id="plemail"  placeholder="<?=lang('LOGIN_EMAIL');?>"  class="form-control" required>
			</div>
			<div class="col-md-4">
				<label><?=lang('C_PSWD');?></label>
				<input type="password" name="password" id="plpassword" placeholder="<?=lang('PSWD');?>"   class="form-control" required>
			</div>
			<div class="col-md-3">
				<label class="invisible"><?=lang('LOGIN');?></label>
				<button type="submit" class="btn btn-primary center-block"><?=lang('LOGIN');?></button>
			</div>
		</form>
	</div>
</div><!-- Login-->
<div class="form-group">
	<div class="row">
		<div class="col-md-6">
			<div class="dntacnt"><?=lang('DONT_HAVE_ACCOUNT');?> <a class="fadeandscale_close fadeandscalereg_open"><?=lang('SIGNUP');?></a> </div>
		</div>
		<div class="col-md-6">
			<div class="dntacnt"><a class="fadeandscale_close fadeandscaleforget_open forgota pull-left" id="forgtpsw"><?=lang('FORGT_PASS');?></a></div>
		</div>
	</div>
</div>
<?php }?>
<p class="text-primary"><?=lang('HOW_CAN_WE_GET_THERE');?></p>
<p><?=lang('HOME_BOEKER');?></p>
<p>(<?=lang('PARTY_LEADER_AGE');?>)</p>
<p>(<?=lang('UNDER_16_MESSAGE');?>.)</p>
<form name="checkout-apartment" role="form" id="checkout-apartment"  autocomplete="off" action="<?php echo WEB_URL;?>/booking/checkout">
	<input type="hidden" name="serchagain" id="serchagain"/>
	<div class="form-group">
		<div class="row">
			<div class="col-xs-12">
				<div class="sectionbuk">
					<h3> <?=lang('FLIGHT_BOOKING');?> (<?php echo $Fcount;?>) <?=lang('PASSENGER_DETAILS');?></h3>
					<div class="" id="collapse102">
						<?php
						$i=1;
						foreach($cart_global as $key => $cid){
							list($module, $cid) = explode(',', $cid);
							if($module == 'FLIGHT'){
								$JCModule = 'Flight';
								$cart = $this->flight_model->getBookingTemp($cid)->row();
								$Total[] = $cart->total;
								$tot_pass = $this->cart_model->getCartDataByModule($cid,$module)->row();
								$request = json_decode(base64_decode($tot_pass->request));
								$from=$cart->fromCityName.","."(".$cart->Origin.")";
								$to=$cart->toCityName.","."(".$cart->Destination.")";
// echo '<pre>';print_r($request);
								if($request->type == 'R'){
									$JCConsiderDate = $request->return_date;
								}
								elseif($request->type == 'M'){
									$JCConsiderDate = end($request->depart_date);
								}
								else{
									$JCConsiderDate = $request->depart_date;
								}
								$JCConsiderDate;
								$adults=$request->ADT;
								$childs=$request->CHD;
								$infants=$request->INF;
								$pass_result = compact("adults","childs","infants");
								$total_passanger=$adults+$childs+$infants;
								?>
								<input type="hidden" name="passengers" value="<?php echo base64_encode(json_encode($pass_result));?>"/>
								<div class="onedept1">
									<h3 class="inpagehedbuk">
										<span class="bookingcnt"><?php echo $i;?>.</span>
										<span class="aptbokname"><?php echo $cart->fromCityName;?> (<?php echo $cart->Origin;?>) - <?php echo $cart->toCityName;?> (<?php echo $cart->Destination;?>)</span>
									</h3>
									<div class="payrow flight_passengerdetails"><!--pay row-->
										<?php $checkout_user=$this->session->userdata('checkout'); ?>
										<?php  $usergender=($checkout_user['selGender'.$cid]!='')?$checkout_user['selGender'.$cid]:$userInfo->gender;?>
										<div class="col-md-2">
											<div class="paylabel"><?=lang('GENDER');?></div>
											<select data-toggle="tooltip" title="if existing client, take over information from profile, if logged in." data-placement="right" name="selGender<?php echo $cid;?>"  class="form-control" id="selGender" required="required" >
												<option value="Female" <?php echo ($usergender=="Female")?"selected='selected'":"";?>><?=lang('FEMALE');?></option>
												<option value="Male" <?php echo ($usergender=="Male")?"selected='selected'":"";?>><?=lang('MALE');?></option>
											</select>
										</div>
										<div class="col-md-2 ">
											<div class="paylabel"><?=lang('F_NAME');?></div>
											<input type="text"  data-toggle="tooltip" title="if existing client, take over information from profile, if logged in. and please enter your first name as per  passport" data-placement="right" name="first_name<?php echo $cid;?>" class="payinput" value="<?php echo($checkout_user['first_name'.$cid]!='')?$checkout_user['first_name'.$cid]:$userInfo->firstname;?>" required/>
										</div>
										<div class="col-md-2">
											<div class="paylabel"><?=lang('L_NAME');?></div>
											<input type="text" name="last_name<?php echo $cid;?>" data-toggle="tooltip" title="Please enter your last name as per  passport" data-placement="right" class="payinput" value="<?php echo($checkout_user['last_name'.$cid]!='')?$checkout_user['last_name'.$cid]:$userInfo->lastname;?>" required/>
										</div>
										<div class="col-md-2">
											<div class="paylabel"><?=lang('DOB');?></div>
											<?php
											if($checkout_user['txtdob'.$cid]!=''){
												$doba=$checkout_user['txtdob'.$cid];
											}else{
												$doba=explode("-",$userInfo->dob);
												$doba=array_reverse($doba);
												$doba=implode("/",$doba);
											}
											?>
											<input  type="text" data-toggle="tooltip" title="Please enter DOB as per  passport" data-placement="right" name="txtdob<?php echo $cid;?>" class="payinput adults passenger_dob" value="<?php if($doba !='00/00/0000'){echo  $doba;}?>"  required />
										</div>
										<div class="col-md-2">
											<div class="paylabel">&nbsp;</div>
											<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
												FFN &nbsp; <span class="caret"></span>
											</button>
											<!-- <input type="text" name="ffn<?php echo $cid;?>" data-toggle="tooltip" title="Take over information from profile, if logged in." data-placement="right" class="payinput"  /> -->
										</div>
										<div class="col-md-2">
											<div class="paylabel">&nbsp;</div>
											<input type="hidden" name="selSsr<?php echo $cid;?>"    id="selSsr" />
											<div data-toggle="tooltip" title="Special meal request code as drop down take over information from profile if signed/ logged in" data-placement="right"  class="btn-group">
												<button type="button"  class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SSR <span class="caret"></span></button>
												<ul style="max-width:500px;" id="ulselSsr" class="dropdown-menu">
													<li><a href="javascript:;"><b>Wheelchair</b></a></li>
													<li><a href="javascript:;"><input type="radio" value="WCHC" name="wheelchair<?php echo $cid;?>" id="WCHC"> <label for="WCHC">Wheelchair is needed - traveler is completely immobile.</label></a></li>
													<li><a href="javascript:;"><input type="radio" value="WCHR" name="wheelchair<?php echo $cid;?>" id="WCHR"> <label for="WCHR">Wheelchair is needed - traveler can use stairs.</label></a></li>
													<li><a href="javascript:;"><b>Meal SSRs</b></a></li>
													<li><a href="javascript:;"><input type="radio" name="meals<?php echo $cid;?>" value="AVML" id="AVML"> <label for="AVML">Asian Vegetarian Meal.</label></a></li>
													<li><a href="javascript:;"><input type="radio" name="meals<?php echo $cid;?>" value="DBML" id="DBML"> <label for="DBML">Diabetic Meal.</label></a></li>
													<li><a href="javascript:;"><input type="radio" name="meals<?php echo $cid;?>" value="GFML" id="GFML"> <label for="GFML">Gluten Free Meal.</label></a></li>
													<li><a href="javascript:;"><input type="radio" name="meals<?php echo $cid;?>" value="HNML" id="HNML"> <label for="HNML">Hindu Meal.</label></a></li>
													<li><a href="javascript:;"><input type="radio" name="meals<?php echo $cid;?>" value="KSML" id="KSML"> <label for="KSML">Kosher Meal.</label></a></li>
													<li><a href="javascript:;"><input type="radio" name="meals<?php echo $cid;?>" value="LPML" id="LPML"> <label for="LPML">Low protein Meal.</label></a></li>
													<li><a href="javascript:;"><input type="radio" name="meals<?php echo $cid;?>" value="LSML" id="LSML"> <label for="LSML">Low Sodium No Salt Added Meal</label></a></li>
													<li><a href="javascript:;"><input type="radio" name="meals<?php echo $cid;?>" value="MOML" id="MOML"> <label for="MOML">Muslim Meal.</label></a></li>
													
													<li><a href="javascript:;"><input type="radio" name="meals<?php echo $cid;?>" value="VGML" id="VGML"> <label for="VGML">Vegetarian Meal (Non Dairy)</label></a></li>
													<li><a href="javascript:;"><input type="radio" name="meals<?php echo $cid;?>" value="VLML" id="VLML"> <label for="VLML">Vegetarian Meal Lacto Ovo</label></a></li>
												</ul>
											</div>

</select>
</div>
<div class="col-md-12 frefly_collapse">
	<div class="collapse" id="collapseExample">
		<div class="well">
			
				<div class="form-group col-sm-6">
					<div class="dropdown">
						<label for="">Frequent Flyer</label>
						<select class="form-control" name="ffnCarr<?php echo $cid;?>">
						<option>Select</option>
						<?php //$all_Carrier=array_unique($Carrier_array); 
						$all_Carrier=$this->flight_model->get_airline_list();
						
						foreach ($all_Carrier as $carrier_) { ?>
						<option value="<?php echo $carrier_->airline_code;?>"><?php echo $this->flight_model->get_airline_name($carrier_->airline_code);?></option>
						<?php } ?>
						
						</select>
					</div>
				</div>
				<div class="form-group col-sm-5">
					<label for="">Frequent Flyer-nummer</label>
					<input type="" class="form-control" name="ffn<?php echo $cid;?>" placeholder="">
				</div>
			
		</div>
	</div>
</div>
</div><!--pay row-->
<?php
foreach($pass_result as $key=>$value){
	if($key=="adults"){
		$start=1;
	}else{
		$start=0;
	}
	for($pa=$start;$pa<$value;$pa++){ $sno=$pa+1; ?>
	<div class="row">
		<div class="col-md-2">
			<div class="paylabel" style="margin-top: 30px;"> <?php echo ucfirst($key)." ".$sno;?></div>
		</div>
	</div>
	<div class="payrow flight_passengerdetails"><!--pay row-->
		<?php
		$ttt=$key.$sno;
		$multifname=($checkout_user['pfirst_name'.$cid][$ttt]!='')?$checkout_user['pfirst_name'.$cid][$ttt]:'';
		$multimname=($checkout_user['pmiddle_name'.$cid][$ttt]!='')?$checkout_user['pmiddle_name'.$cid][$ttt]:'';
		$multilname=($checkout_user['plast_name'.$cid][$ttt]!='')?$checkout_user['plast_name'.$cid][$ttt]:'';
		$multidob=($checkout_user['ptxtdob'.$cid][$ttt]!='')?$checkout_user['ptxtdob'.$cid][$ttt]:'';
		$multigender=($checkout_user['pfirst_name'.$cid][$ttt]!='')?$checkout_user['pfirst_name'.$cid][$ttt]:'';
		?>
		<div class="col-md-2">
			<div class="paylabel"><?=lang('GENDER');?></div>
			<select name="pselGender<?php echo $cid;?>[<?php echo $key.$sno;?>]"  class="form-control" id="selGender" required >
				<option value="Female" <?php echo ($multigender=="Female")?"selected":'';?>><?=lang('FEMALE');?></option>
				<option value="Male" <?php echo ($multigender=="Male")?"selected":'';?>><?=lang('MALE');?></option>
			</select>
		</div>
		<div class="col-md-2">
			<div class="paylabel"><?=lang('F_NAME');?></div>
			<input type="text" maxlength="20" data-toggle="tooltip" title="Please enter your first name as per passport" data-placement="right" name="pfirst_name<?php echo $cid;?>[<?php echo $key.$sno;?>]" class="payinput" value="<?php echo $multifname;?>" required />
		</div>
		<div class="col-md-2">
			<div class="paylabel"><?=lang('L_NAME');?></div>
			<input type="text" name="plast_name<?php echo $cid;?>[<?php echo $key.$sno;?>]" class="payinput" data-toggle="tooltip" title="Please enter your first name as per  passport" data-placement="right" value="<?php echo $multilname;?>" required />
		</div>
		<div class="col-md-2">
			<div class="paylabel"><?=lang('DOB');?></div>
			<input type="text" <?php if($key!='adults'){?>  data-toggle="tooltip" title="Check on date of birth" data-placement="right" <?php } ?>  name="ptxtdob<?php echo $cid;?>[<?php echo $key.$sno;?>]" trip_type="<?php echo $request->type;?>" adult="<?php echo $pass_result['adults'];?>" child="<?php echo $pass_result['childs'];?>" infant="<?php echo $pass_result['infants'];?>" extradays="" from="<?php echo $from;?>" to="<?php echo $to;?>" departure_date="<?php echo date("d-m-Y",strtotime($request->depart_date));?>" return_date="<?php echo (isset($request->return_date))?date("d-m-Y",strtotime($request->return_date)):'';?>" class="payinput passenger_dob <?php echo $key;?>" value="<?php echo $multidob;?>"  required />
		</div>
		<div class="col-md-2">
			<div class="paylabel">FFN</div>

			<button class="btn btn-primary" type="button"  data-toggle="collapse" data-target="#collapseExample<?php echo $key.$sno;?>" aria-expanded="false" aria-controls="collapseExample">
												FFN &nbsp; <span class="caret"></span>
											</button>

		</div>
		<div class="col-md-2">
			<div class="paylabel">&nbsp;</div>

										
			 <input type="hidden" name="ptxtssr<?php echo $cid;?>[<?php echo $key.$sno;?>]"    id="selSsr<?php echo $key;?>" />
			<div data-toggle="tooltip" title="Special meal request code as drop down take over information from profile if signed/ logged in" data-placement="right"  class="btn-group">
				<button type="button"  class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SSR <span class="caret"></span></button>
				<ul style="max-width:500px;" id="ulselSsr<?php echo $key;?>" class="dropdown-menu">
					<li><a href="javascript:;"><b>Wheelchair</b></a></li>
					<li><a href="javascript:;"><input type="radio" value="WCHC" name="pwheelchair<?php echo $cid;?>[<?php echo $key.$sno;?>]" id="WCHC<?php echo $cid;?>[<?php echo $key.$sno;?>]"> <label for="WCHC<?php echo $cid;?>[<?php echo $key.$sno;?>]">Wheelchair is needed - traveler is completely immobile.</label></a></li>
					<li><a href="javascript:;"><input type="radio" value="WCHR" name="pwheelchair<?php echo $cid;?>[<?php echo $key.$sno;?>]" id="WCHR<?php echo $cid;?>[<?php echo $key.$sno;?>]"> <label for="WCHR<?php echo $cid;?>[<?php echo $key.$sno;?>]">Wheelchair is needed - traveler can use stairs.</label></a></li>
					<li><a href="javascript:;"><b>Meal SSRs</b></a></li>
					<li><a href="javascript:;"><input type="radio" value="AVML" name="pmeals<?php echo $cid;?>[<?php echo $key.$sno;?>]" id="AVML<?php echo $cid;?>[<?php echo $key.$sno;?>]"> <label for="AVML<?php echo $cid;?>[<?php echo $key.$sno;?>]">Asian Vegetarian Meal.</label></a></li>
					<li><a href="javascript:;"><input type="radio" value="DBML" name="pmeals<?php echo $cid;?>[<?php echo $key.$sno;?>]" id="DBML<?php echo $cid;?>[<?php echo $key.$sno;?>]"> <label for="DBML<?php echo $cid;?>[<?php echo $key.$sno;?>]">Diabetic Meal.</label></a></li>
					<li><a href="javascript:;"><input type="radio" value="GFML" name="pmeals<?php echo $cid;?>[<?php echo $key.$sno;?>]" id="GFML<?php echo $cid;?>[<?php echo $key.$sno;?>]"> <label for="GFML<?php echo $cid;?>[<?php echo $key.$sno;?>]">Gluten Free Meal.</label></a></li>
					<li><a href="javascript:;"><input type="radio" value="HNML" name="pmeals<?php echo $cid;?>[<?php echo $key.$sno;?>]" id="HNML<?php echo $cid;?>[<?php echo $key.$sno;?>]"> <label for="HNML<?php echo $cid;?>[<?php echo $key.$sno;?>]">Hindu Meal.</label></a></li>
					<li><a href="javascript:;"><input type="radio" value="KSML" name="pmeals<?php echo $cid;?>[<?php echo $key.$sno;?>]" id="KSML<?php echo $cid;?>[<?php echo $key.$sno;?>]"> <label for="KSML<?php echo $cid;?>[<?php echo $key.$sno;?>]">Kosher Meal.</label></a></li>
					<li><a href="javascript:;"><input type="radio" value="LPML" name="pmeals<?php echo $cid;?>[<?php echo $key.$sno;?>]" id="LPML<?php echo $cid;?>[<?php echo $key.$sno;?>]"> <label for="LPML<?php echo $cid;?>[<?php echo $key.$sno;?>]">Low protein Meal.</label></a></li>
					<li><a href="javascript:;"><input type="radio" value="LSML" name="pmeals<?php echo $cid;?>[<?php echo $key.$sno;?>]" id="LSML<?php echo $cid;?>[<?php echo $key.$sno;?>]"> <label for="LSML<?php echo $cid;?>[<?php echo $key.$sno;?>]">Low Sodium No Salt Added Meal</label></a></li>
					<li><a href="javascript:;"><input type="radio" value="MOML" name="pmeals<?php echo $cid;?>[<?php echo $key.$sno;?>]" id="MOML<?php echo $cid;?>[<?php echo $key.$sno;?>]"> <label for="MOML<?php echo $cid;?>[<?php echo $key.$sno;?>]">Muslim Meal.</label></a></li>
					<li><a href="javascript:;"><input type="radio" value="VGML" name="pmeals<?php echo $cid;?>[<?php echo $key.$sno;?>]" id="VGML<?php echo $cid;?>[<?php echo $key.$sno;?>]"> <label for="VGML<?php echo $cid;?>[<?php echo $key.$sno;?>]">Vegetarian Meal (Non Dairy)</label></a></li>
					<li><a href="javascript:;"><input type="radio" value="VLML" name="pmeals<?php echo $cid;?>[<?php echo $key.$sno;?>]" id="VLML<?php echo $cid;?>[<?php echo $key.$sno;?>]"> <label for="VLML<?php echo $cid;?>[<?php echo $key.$sno;?>]">Vegetarian Meal Lacto Ovo</label></a></li>
				</ul>
			</div>

</div>

<div class="col-md-12 frefly_collapse">
	<div class="collapse" id="collapseExample<?php echo $key.$sno;?>">
		<div class="well">
		
				<div class="form-group col-sm-6">
					<div class="dropdown">
						<label for="">Frequent Flyer</label>
						<select class="form-control" name="pffnCarr<?php echo $cid;?>[<?php echo $key.$sno;?>]">
						<option>Select</option>
						<?php //$all_Carrier=array_unique($Carrier_array);  
						$all_Carrier=$this->flight_model->get_airline_list();
						
						foreach ($all_Carrier as $carrier_) { ?>
						<option value="<?php echo $carrier_->airline_code;?>"><?php echo $this->flight_model->get_airline_name($carrier_->airline_code);?></option>
						<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group col-sm-5">
					<label for="">Frequent Flyer-nummer</label>
					<input type="" class="form-control" name="pffn<?php echo $cid;?>[<?php echo $key.$sno;?>]" placeholder="">
				</div>
			
		</div>
	</div>
</div>
</div><!--pay row-->
<?php  }} ?>
</div><!-- onedep1-->
<?php $i++;}}?>
</div><!-- collapse102-->
</div><!--sectionbuk-->

<h3><?=lang('BILLING_ADDRESS');?></h3>
<div class="row">
	<div class="col-md-12">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"> <?=lang('BUSINESS');?> </label>
				<div class="input-group">
					<span class="input-group-addon">
						<input type="checkbox" id='BookForBussiness' name='BookForBussiness' value='Y' aria-label="...">
					</span>
					<input type="text" readonly="readonly" value='<?=lang('BOOK_FOR_BUSINESS');?>' class="form-control" aria-label="...">
				</div><!-- /input-group -->
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<div id='BussinessDetails' style="display:none;">
	<h3><?=lang('BUSSINESS_DETAILS');?></h3>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-6"><!--Col 6-->
				<div class="form-group">
					<label class="control-label"> <?=lang('COMPANY_NAME');?></label>
					<input  maxlength="100" tabindex="1" type="text" required="required" data-toggle="tooltip" title="If your business address is different than listed here, please adjust." data-placement="right"  name="company_name" value='<?php echo $userInfo->BusinessName;?>' class="form-control" placeholder="<?=lang('COMPANY_NAME');?>"  />
				</div>
			</div><!--Col 6-->
			<div class="col-md-6"><!--Col 6-->
				<div class="form-group">
					<label class="control-label"> <?=lang('COMPANY_VAT');?></label>
					<input  maxlength="100" tabindex="2" type="text"  required="required" name="company_vat" value='<?php echo $userInfo->BusinessVat;?>' class="form-control" placeholder="<?=lang('COMPANY_VAT');?>"  />
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-md-6"><!--Col 6-->
	<div class="form-group">
		<label class="control-label"> <?=lang('F_NAME');?></label>
		<input  maxlength="100" tabindex="1" type="text" required="required" name="first_name" value="<?php echo (($checkout_user['first_name']!='')?$checkout_user['first_name']:(($userInfo->billing_firstname)?$userInfo->billing_firstname:$userInfo->firstname));?>" class="form-control" placeholder="<?=lang('F_NAME');?>"  />
	</div>
	<div class="form-group">
		<label class="control-label"> <?=lang('L_NAME');?></label>
		<input  maxlength="100" tabindex="3" type="text" required="required" name="last_name"  value="<?php echo (($checkout_user['last_name']!='')?$checkout_user['last_name']:(($userInfo->billing_lastname)?$userInfo->billing_lastname:$userInfo->lastname));?>"  class="form-control" placeholder="<?=lang('L_NAME');?>"  />
	</div>
	<div class="form-group">
		<label class="control-label"> <?=lang('STREET_ADDRESS');?> </label>
		<input maxlength="100" tabindex="5" type="text" name="street_address" data-toggle="tooltip" title="The confirmation and travel documents will be sent to this address, adjust them if you wish otherwise." data-placement="right" value="<?php echo($checkout_user['street_address']!='')?$checkout_user['street_address']:$userInfo->billing_addressA;?>" required="required" class="form-control" placeholder="<?=lang('STREET_ADDRESS');?>" />
	</div>
<!--<div class="form-group">
<label class="control-label"> <?php echo $this->lang->line('BP_State'); ?> </label>
<input maxlength="100" type="text" tabindex="7"  name="state"  value="<?php if($userInfo->billing_state != NULL){echo $userInfo->billing_state;}?>"  class="form-control" placeholder="<?php echo $this->lang->line('BP_State'); ?>" />
</div>-->
<div class="form-group">
	<label class="control-label"> <?=lang('CITY');?> </label>
	<input maxlength="100" tabindex="7" type="text" required="required" name="city"  value="<?php echo($checkout_user['city']!='')?$checkout_user['city']:$userInfo->billing_city;?>" class="form-control" placeholder="<?=lang('CITY');?>" />
</div>
<div class="form-group">
	<label class="control-label"> <?=lang('POSTAL_CODE');?> </label>
	<input maxlength="100" type="text" name="zip" tabindex="9"  value="<?php echo($checkout_user['zip']!='')?$checkout_user['zip']:$userInfo->billing_postal;?>" required="required" class="form-control" placeholder="<?=lang('POSTAL_CODE');?>" />
</div>
</div><!--Col 6-->
<div class="col-md-6"><!--Col 6-->
	<div class="form-group">
		<label class="control-label"> <?=lang('M_NAME');?></label>
		<input  maxlength="100" tabindex="2" type="text"  name="middle_name"  value="<?php echo (($checkout_user['middle_name']!='')?$checkout_user['middle_name']:(($userInfo->billing_middlename)?$userInfo->billing_middlename:$userInfo->middlename));?>"  class="form-control" placeholder="<?=lang('M_NAME');?>"  />
	</div>
	<?php $email1=(($checkout_user['email']!='')?$checkout_user['email']:(($userInfo->billing_email)?$userInfo->billing_email:$userInfo->email));?>
	<div class="form-group">
		<label class="control-label"> <?=lang('EMAIL');?> </label>
		<input maxlength="100" tabindex="4" type="email" name="email" value="<?php echo $email1;?>" data-toggle="tooltip" title="This e-mail address will be used to send your confirmation and travel documents" data-placement="right" required="required" class="form-control" placeholder="<?=lang('EMAIL');?>" />
	</div>
	<input type="hidden" name="cid" id="cid" value="<?php echo $cart_global_id;?>"/>
	<div class="form-group">
		<div class="row">
			<div class="col-xs-6">
				<label class="control-label"> <?=lang('COUNTRY_CODE');?></label>
				<?php  $Defaultselect1=($checkout_user['country_code'.$cid]!='')?$checkout_user['country_code'.$cid]:(($userInfo->billing_country_code!='')?$userInfo->billing_country_code:"NL"); ?>
				<div class="bfh-selectbox bfh-countries" id="billaddress" tabindex="6"  data-flags="true">
					<input type="hidden" name="country_code" id="country_code" value="<?php echo $Defaultselect1;?>">
					<a class="bfh-selectbox-toggle form-control" role="button" data-toggle="bfh-selectbox" href="javascript:;">
						<span class="bfh-selectbox-option" id="billaddress"><i class="glyphicon bfh-flag-<?php echo $Defaultselect1;?>"></i> <?php echo $this->apartment_model->get_country_phonecode($Defaultselect1,1);?></span>
						<span class="caret selectbox-caret"></span></a>
						<div class="bfh-selectbox-options">
							<div role="listbox">
								<ul role="option">
									<?php foreach($countries as $country){?>
									<li><a style="overflow-x: visible !important;" tabindex="-1" href="javascript:;" data-option="<?php echo $country->country_code;?>"><i class="glyphicon bfh-flag-<?php echo $country->country_code;?>"></i><?php echo $country->name." (".$country->phonecode." )";?></a></li>
									<?php }?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 padding-left-null">
					<label class="control-label"> <?=lang('CONTACT_NO');?></label>
					<input maxlength="100" type="text" tabindex="6" name="mobile"  value="<?php echo($checkout_user['mobile']!='')?$checkout_user['mobile']:$userInfo->billing_contact;?>" required="required" class="form-control" placeholder="<?=lang('CONTACT_NO');?>" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label"> <?=lang('COUNTRY');?> </label>
			<?php $Defaultselect2=(isset($userInfo->billing_country) && $userInfo->billing_country!='')?$userInfo->billing_country:"NL"; ?>
			<select tabindex="8" class="form-control fpayinselect mySelectBoxClass hasCustomSelect" name="country" required>
				<?php foreach($countries as $country){?>
				<option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $Defaultselect2) ? "selected" : ""; ?> ><?php echo $country->name;?></option>
				<?php }?>
			</select>
		</div>
	</div><!--Col 6-->
</div>
</div>
</div>

		<?php
		$insurance_results=$this->booking_model->getinsurance_settings();
		if(count($insurance_results)>0){
			$local_travel_insurance=$insurance_results->local_travel_insurance;
			$local_travel_insurance_tax=$insurance_results->local_travel_insurance_tax;
			$travel_insurance=$insurance_results->travel_insurance;
			$travel_insurance_tax=$insurance_results->travel_insurance_tax;
			$cancel_insurance=$insurance_results->cancel_insurance;
			$cancel_insurance_perc=($insurance_results->cancel_insurance_perc+$insurance_results->other_insurance_perc);
		}else{
			$local_travel_insurance=0;
			$local_travel_insurance_tax=0;
			$travel_insurance=0;
			$travel_insurance_tax=0;
			$cancel_insurance=0;
			$cancel_insurance_perc=0;
		}
		$total_days=($cart->DepartureTime)-($cart->ArrivalTime);
		$total_days = abs(floor($total_days/(60*60*24)));
		$total_person=$total_passanger;
		$local_total_travel_insurance=($total_days*$local_travel_insurance)+($total_person*$local_travel_insurance_tax);
		$other_total_travel_insurance=($total_days*$travel_insurance)+($total_person*$travel_insurance_tax);
		$cal_cancel_insurance=((array_sum($Totalprice)/100)*($cancel_insurance_perc));
		$total_cancel_insurance=($cal_cancel_insurance)+($cancel_insurance);
		$total_combed_insurance=($total_cancel_insurance)+($other_total_travel_insurance);
		if(isset($checkout_user['insurance_type']) && $checkout_user['insurance_type']=='No Insurance'){
			$test_hide='';
		}else if(isset($checkout_user['insurance_type']) && $checkout_user['insurance_type']!='No Insurance'){
			$test_hide='hide';
		}else{
			$test_hide='';
		}
		?>

<div class="insurance_container">
	<div>
		<h3>Insurance</h3>
	</div>
	<div class="col-sm-6">
		<label for="no_travel">
			<input type="radio" name="insurance_type" id="no_travel" selval="no_travel" checked=""  value="No Insurance">No Insurance (<?php echo CURR_ICON ;?> 0)
		</label>
	</div>
	<div class="col-sm-3">
		<label for="travel">
			<input type="radio" name="insurance_type" id="travel" selval="travel" value="Travel Insurance">Travel Insurance (<?php echo CURR_ICON." ".round($other_total_travel_insurance, 1, PHP_ROUND_HALF_UP);?>)
		</label>
	</div>

		<?php  $total_passanger=(isset($infants_total)?array_sum($infants_total):0)+(isset($childs_total)?array_sum($childs_total):0)+array_sum($adult_total);?>
	<div class="col-sm-3">
	X Passenger
		<select name="insurance_applied_t_person" class="form-control">
		<?php for ($ps=1; $ps <= $total_passanger; $ps++) { 
			echo '<option value="'.$ps.'">'.$ps.'</option>';
		} ?>
		
		</select>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-6">
		<label for="cancel">
			<input type="radio" name="insurance_type" id="cancel" selval="cancel" value="Cancellation Insurance">Cancellation Insurance (<?php echo CURR_ICON." ".round($total_cancel_insurance,1,PHP_ROUND_HALF_UP);?>)
		</label>
			</div>
		
	<div class="col-sm-3">
		<label for="combed">
			<input type="radio" name="insurance_type" id="combed" selval="combed" value="Combined Travel Cancellation Insurance">Combined Travel Cancellation Insurance (<?php echo CURR_ICON." ".round($total_combed_insurance,1,PHP_ROUND_HALF_UP);?>)
		</label>
		</div>
		<div class="col-sm-3">
		X Passenger
		<select name="insurance_applied_tc_person" class="form-control">
	<?php for ($ps=1; $ps <=$total_passanger; $ps++) { 
			echo '<option value="'.$ps.'">'.$ps.'</option>';
		} ?>
		</select>
	</div>
</div>
<div class="clearfix"></div>


		<div class="row">
	<div class="col-md-12">
		<input type="hidden" name="insurance_amount" value="0" id="insurance_amount">
		<input type="hidden" name="insurance_tax" value="0" id="insurance_tax">
		<p id="no_travel_info" tax="0" price="0" class="text-success <?php echo $test_hide; ?>  insurance"> Total no travel insurance : <?php echo CURR_ICON;?> 0</p>
		<p id="travel_info" tax="<?php echo $travel_insurance_tax;?>" price="<?php echo round($other_total_travel_insurance, 1, PHP_ROUND_HALF_UP);?>" class="text-success <?php echo ($checkout_user['insurance_type']!='Travel Insurance')?'hide':'';?> insurance"> Total travel insurance : <?php echo CURR_ICON." ".round($other_total_travel_insurance, 1, PHP_ROUND_HALF_UP);?></p>
		<p id="cancel_info" tax="0"  price="<?php echo round($total_cancel_insurance, 1, PHP_ROUND_HALF_UP);?>" class="text-success <?php echo ($checkout_user['insurance_type']!='Cancellation Insurance')?'hide':'';?> insurance"> Total cancellation insurance : <?php echo CURR_ICON." ".round($total_cancel_insurance,1,PHP_ROUND_HALF_UP);?></p>
		<p id="combed_info" tax="<?php echo $travel_insurance_tax;?>"  price="<?php echo round($total_combed_insurance, 1, PHP_ROUND_HALF_UP);?>" class="text-success <?php echo ($checkout_user['insurance_type']!='Combined Travel Cancellation Insurance')?'hide':'';?> insurance"> Total combed insurance : <?php echo CURR_ICON." ".round($total_combed_insurance,1,PHP_ROUND_HALF_UP);?></p>
	</div>
</div>
<div class="clearfix"></div>
<p><?=lang('MSG_BOOK_IT');?></p>
<div class="col-sm-12 bkt_msgcheclbox">
<div class="checkbox">
	<input type="hidden" id="total_payable" name="total" value="<?php echo base64_encode(array_sum($Total)+array_sum($HiddenMarkupArr)); ?>"/>
	<input type="hidden" id="pcode" name="code" value="<?php echo base64_encode('fool'); ?>"/>
	<label for="confirm" class="checkbox-inline">
		<input tabindex="10" data-toggle="tooltip" title="Must be checked before one can continue with booking" data-placement="right"  type="checkbox" id="confirm" name="confirm" class="checkleft" required="" aria-required="true">
		<?=lang('BP_Bookit1');?>
		<a data-toggle="tooltip"  title="Must be checked before one can continue with booking" data-placement="right"  class="colorbl"><?=lang('BP_TERMS_OF_SERVICE');?></a>,
		<a class="colorbl"><?=lang('BP_Cancellation_Policy');?></a>
		<?lang('AND');?>
		<a class="colorbl"><?=lang('BP_Guest_Policy');?></a>.
	</label>
</div>
</div>
<hr class="margin-top-null">
<div class="clearfix">
	<div class="pull-right">
		<button tabindex="12" type="submit" id="continue" class="btn btn-primary" ><?=lang('BOOK_IT');?></button>
	</div>
</div>
</form>
<br>
</div>
<div role="tabpanel" class="tab-pane fade <?php echo ($this->uri->segment(3)!='' && $this->input->get('orderId')=='')?"active in":"";?>" id="payment-tab">
	<?php
	$pnr=json_decode(base64_decode($this->uri->segment(3)));
	$global_book_count=$this->flight_model->get_globalbooking_FlightData($pnr)->num_rows();
	if($global_book_count>0){
		$global_book=$this->flight_model->get_globalbooking_FlightData($pnr)->row();
		 $pnr_no=$global_book->pnr_no;
		$insurance=$this->flight_model->get_insurance($pnr_no)->row();
		$insurance_total=($insurance->insurance_amount!=null)?$insurance->insurance_amount:0;
		$insurance_type=($insurance->insurance_type!=null)?$insurance->insurance_type:'';
		 $final_paymentprice = base64_encode($global_book->PayedAsAmount+$insurance_total);
	}else{
		 $final_paymentprice = base64_encode(array_sum($Totall));
	}
	if(isset($_SESSION['RedeemStatus']) && isset($_SESSION['RedeemPoints']) && $_SESSION['RedeemStatus'] == 'Yes' && $_SESSION['RedeemPoints'] > 0 && base64_decode($final_paymentprice) == 0)
		{?>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="media">
				<div class="media-left">
				</div>
				<div class="media-body">
					<br>
					<h4 class="media-heading"><?=lang('Complete_Booking');?></h4>
					<p><?=lang('Enough_NWER_POINTS_MSG');?></p>
					<form method="post" action="<?php echo WEB_URL.'/doPayment/success';?>">
						<input type="hidden"  name="ec" value="<?php echo $pnr;?>">
						<input type="hidden"  name="trxid" value="<?php echo 'TF'.date('m').'A'.date('dHi');?>">
						<input type="submit" class="btn btn-default center-block" name="Complete" value="Complete Booking"><br/>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php
}else{
	$view_data = array('amount' => $final_paymentprice,'entranceCode'=>$this->uri->segment(3));
	$this->load->ext_view('third_party/ideal/pay', 'requestTransaction', $view_data);
}
?>
</div>
<div role="tabpanel" class="tab-pane fade <?php echo ($this->input->get('orderId')!='' && $this->uri->segment(3)=='')?"active in":"";?>" id="confirmation-tab">
	<?php   if(isset($pnr_nos) && $pnr_nos!='') {
		$voucher_data=$pnr_nos; $this->load->view('common/voucher_new', $voucher_data);
	}else{ echo "<p class='text-center' style='color:red;'>Please complete previous  step</p>";
} ?>
</div>
</div>
</div>
<?php if($this->input->get('orderId')==''){?>
<div class="col-md-4">
	<br class="visible-xs-block">
	<div class="panel">
		<div class="panel-body">
			<h3 class="h4 tf-primary text-uppercase"><b><?=lang('FARE_DETAILS');?></b></h3>
<!-- <div class="clearfix">
<div class="pull-left">
<p class="text-info"><?=lang('ADULT_PRICE');?></p>
</div>
<div class="pull-right">
<p><?php echo array_sum($adult_total);?> X <?php echo array_sum($adult_base_price)/array_sum($adult_total);?> = <?=CURR_ICON.' '.array_sum($adult_base_price);?></p>
</div>
</div>
<div class="clearfix">
<div class="pull-left">
<p class="text-info">Sub Total </p>
</div>
<div class="pull-right">
<p><?php echo array_sum($adult_total_price);?></p>
</div>
</div>
<?php if(array_sum($childs_total)!=0){ ?>
<div class="clearfix">
<div class="pull-left">
<p class="text-info"><?=lang('CHILD_PRICE');?></p>
</div>
<div class="pull-right">
<p><?php echo array_sum($childs_total);?> X <?php echo array_sum($childs_base_price)/array_sum($childs_total);?> = <?=CURR_ICON.' '.array_sum($childs_base_price);?></p>
</div>
</div>
<div class="clearfix">
<div class="pull-left">
<p class="text-info">Sub Total </p>
</div>
<div class="pull-right">
<p><?php echo array_sum($child_total_price);?></p>
</div>
</div>
<?php }
if(array_sum($infants_total)!=0){?>
<div class="clearfix">
<div class="pull-left">
<p class="text-info"><?=lang('INFANT_PRICE');?></p>
</div>
<div class="pull-right">
<p><?php echo array_sum($infants_total);?> X <?php echo array_sum($infants_base_price)/array_sum($infants_total);?> = <?=CURR_ICON.' '.array_sum($infants_base_price);?></p>
</div>
</div>
<?php } ?>
<div class="clearfix">
<div class="pull-left">
<p class="text-info"><?=lang('ADULT_TAX_PRICE');?> </p>
</div>
<div class="pull-right">
<p><?php echo CURR_ICON.' '.(array_sum($adult_tax_price)+$adult_total_MarkupDiscount);?></p>
</div>
</div>
<div class="clearfix">
<div class="pull-left">
<p class="text-info"><?=lang('CHILD_TAX_PRICE');?> </p>
</div>
<div class="pull-right">
<p><?php echo CURR_ICON.' '.array_sum($childs_tax_price);?></p>
</div>
</div>
<div class="clearfix">
<div class="pull-left">
<p class="text-info"><?=lang('TAXES');?> </p>
</div>
<div class="pull-right">
<?php
$TotalAdultTaxes = array_sum($adult_tax_price);
$TotalChildTaxes = array_sum($childs_tax_price);
$TotalChildAdultTaxesPerHead = ($TotalAdultTaxes + $TotalChildTaxes)/(array_sum($childs_total)+array_sum($adult_total));
?>
<p><?php echo array_sum($childs_total)+array_sum($adult_total).' X '.$TotalChildAdultTaxesPerHead;?> = <?=CURR_ICON.' '.($TotalAdultTaxes + $TotalChildTaxes);?></p>
</div>
</div>
<?php
if(array_sum($infants_total) != 0 && array_sum($infants_tax_price) > 0){?>
<div class="clearfix">
<div class="pull-left">
<p class="text-info"><?=lang('INFANT_TAX_PRICE');?></p>
</div>
<div class="pull-right">
<p><?php echo array_sum($infants_total).' X '.CURR_ICON.' '.array_sum($infants_tax_price);?></p>
</div>
</div>
<?php
}
?>
<!-- <div class="clearfix">
<div class="pull-left">
<p class="text-info">Sub Total </p>
</div>
<div class="pull-right">
<p><?php echo array_sum($infant_total_price);?></p>
</div>
</div>
<div class="clearfix">
<div class="pull-left">
<p class="text-info"><b><?=lang('SUB_TOTAL');?></b></p>
</div>
<div class="pull-right">
<p><?php echo CURR_ICON.' '.array_sum($BasePrice);?></p>
</div>
</div>-->
<div class="clearfix">
	<div class="pull-left">
		<p class="text-info"><b>Fare + Taxes</b></p>
	</div>
	<div class="pull-right">
		<p><?php echo CURR_ICON.' '.array_sum($Totalprice);?></p>
	</div>
</div>
<?php
foreach ($AllHiddenMarkupDiscount as $HiddenMarkupDiscount) {
//echo "<pre>";print_r($HiddenMarkupDiscount);
	$WholeMarkupPer = $HiddenMarkupDiscount[3];
	if($WholeMarkupPer == 'Person'){
		?>
		<div class="clearfix">
			<div class="pull-left">
				<p data-toggle="tooltip" data-placement="right" title="Reservation costs or other costs." class="text-info"><?=$HiddenMarkupDiscount[0]?></p>
			</div>
			<div class="pull-right">
				<p data-toggle="tooltip" data-placement="right" title="Reservation costs or other costs."><?=lang('PASSENGERS');?> : <?=array_sum($adult_total) + array_sum($childs_total);?> <!--x <?php echo ($HiddenMarkupDiscount[1] == "-") ? '-': '';echo ' '.$HiddenMarkupDiscount[2];?>--> = <?=CURR_ICON.' '.($HiddenMarkupDiscount[2]);?></p>
				<?php
/*if(array_sum($adult_total)>0){
?>
<p>Adult : <?=array_sum($adult_total);?> x <?php echo ($HiddenMarkupDiscount[1] == "-") ? '-': '';echo ' '.CURR_ICON.' '.$HiddenMarkupDiscount[2];?></p>
<?
}
if(array_sum($childs_total)>0){
?>
<p>Child : <?=array_sum($childs_total);?>X <?php echo ($HiddenMarkupDiscount[1] == "-") ? '-': '';echo ' '.CURR_ICON.' '.$HiddenMarkupDiscount[2];?></p>
<?
}*/
?>
</div>
</div>
<?php
}
else{
	?>
	<div class="clearfix">
		<div class="pull-left">
			<p data-toggle="tooltip" data-placement="right" title="Reservation costs or other costs." class="text-info"><?=$HiddenMarkupDiscount[0]?></p>
		</div>
		<div class="pull-right">
			<p data-toggle="tooltip" data-placement="right" title="Reservation costs or other costs."><?php echo ($HiddenMarkupDiscount[1] == "-") ? '-': '';echo ' '.CURR_ICON.' '.$HiddenMarkupDiscount[2];?></p>
		</div>
	</div>
	<?php
}
$HiddenMarkupArr[]=$HiddenMarkupDiscount[2];
}
?>
<div class="clearfix">
	<div class="pull-left">
		<p class="text-info"><b><?=lang('SUB_TOTAL');?></b></p>
	</div>
	<div class="pull-right">
		<p><?php echo CURR_ICON.' '.array_sum($Totalprice);?></p>
	</div>
</div>
<!--<div class="clearfix">
<div class="pull-left">
<p class="text-info"><b><?=lang('TOTAL_PRICE');?></b></p>
</div>
<div class="pull-right">
<p><?php echo CURR_ICON.' '.(array_sum($TaxPrice) + array_sum($BasePrice));?></p>
</div>
</div>-->
<?php if((isset($insurance_type) && $insurance_type!=null) && (isset($insurance_total) && $insurance_total!=null)){?>
<div class="clearfix">
	<div class="pull-left">
		<p class="text-info"><b><?php echo $insurance_type;?></b></p>
	</div>
	<div class="pull-right">
		<p><?php echo CURR_ICON.' '.($insurance_total);?></p>
	</div>
</div>
<?php } ?>
<?php

if($this->session->userdata('b2c_id') && !isset($_SESSION['RedeemStatus'])){
	?>
	<div class="clearfix" id='NWERPointsDiv'>
		<div class="pull-left">
			<p class="text-info"><?=lang('TOTAL_LOYALTY_POINTS');?> <?php echo CURR_ICON;?></p>
		</div>
		<div class="pull-right">
			<p class="h4" style="color: #f77f00;">
				<b><span><?=round((array_sum($BasePrice)*0.0075),2);?></span></b>
			</p>
		</div>
	</div>
	<?php
}
?>
<?php
if($this->session->userdata('promos')!=null){
	$get_promo=$this->session->userdata('promos');
	$discount_price=$get_promo['discount'][0];
//print_r($get_promo);
	?>
	<div class="clearfix">
		<div class="pull-left">
			<p class="text-info"><?=lang('PROMO_DISCOUNT_TITLE');?></p>
		</div>
		<div class="pull-right">
			<p> <?=CURR_ICON?> <span><?php echo $discount_price;?></span></p>
		</div>
	</div>
	<?php }else{ $discount_price=0; } ?>
	<div class="clearfix" id='total_discount_con' style='display:none;'>
		<div class="pull-left">
			<p class="text-info"><?=lang('TOTAL_DISCOUNT');?></p>
		</div>
		<div class="pull-right">
			<p> <?=CURR_ICON?> <span id='total_discount'></span></p>
		</div>
	</div>

	<div class="clearfix" id='insurance_con' style='display:none;'>
		<div class="pull-left">
			<p class="insurance_text text-info"></p>
		</div>
		<div class="pull-right">
			<p class=""> <?=CURR_ICON?> <span id='insurance_price'></span></p>
		</div>
	</div>

	<div class="clearfix">
		<div class="pull-left">
			<?php $total_passanger=(isset($infants_total)?array_sum($infants_total):0)+(isset($childs_total)?array_sum($childs_total):0)+array_sum($adult_total);?>
			<p class="tf-primary h5 text-uppercase"><b><?=lang('TOTAL_PAYABLE_PRICE');?> (<?php echo ($total_passanger);?>)</b></p>
		</div>
		<?php $RedeemPointsprice=($_SESSION['RedeemStatus']=='Yes') ? round(($_SESSION['RedeemPoints']*0.0075),2) : 0; ?>
		<div class="pull-right">
			<p class="h4" style="color: #f77f00;"><b><?php echo CURR_ICON;?> <span price="<?=((array_sum($Totalprice)+array_sum($HiddenMarkupArr)+$insurance_total)-($discount_price)-($RedeemPointsprice));?>" id='total_amount'><?=((array_sum($Totalprice)+array_sum($HiddenMarkupArr)+$insurance_total)-($discount_price)-($RedeemPointsprice));?></span></b></p>
		</div>
	</div>
</div>
</div>
<!-- Discount Panel -->
<?php
if($this->session->userdata('promos')==null && (isset($_SESSION['RedeemStatus']) &&  $_SESSION['RedeemStatus']!= 'Yes')){?>
<div class='panel' id='PROMODIV'>
	<div class='panel-body'>
		<div class="panel panel-primary margin-bottom-null">
			<div class="panel-heading">
				<h3 class="panel-title"><?=lang('PROMO_TITLE');?></h3>
			</div>
			<div class="clear"></div>
			<div class="panel-body">
				<form id="promocode" name="promocode" action="<?php echo WEB_URL;?>/booking/promo">
					<div class="col-md-8">
						<div class="cartprc form-">
							<input type="hidden" name="total" value="<?php echo base64_encode(array_sum($Totall)+array_sum($HiddenMarkupArr)); ?>">
							<input type="hidden" name="cid" id="cid" value="<?php echo $cart_global_id;?>"/>
							<div class="payblnhm singecartpricebuk ritaln">
								<input type="text" class="promocode" id="code" name="code" placeholder="<?=lang('ENTER_PROMO');?>" required/>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<input type="submit" class="promosubmit" name="apply" value="<?=lang('APPLY');?>" />
					</div>
				</form>
			</div>
			<div class="clear"></div>
			<div class="savemessage"></div>
			<div class="totalamt"></div>
		</div>
		<br>
	</div>
</div>
<?php } ?>
<!-- Discount Panel -->
<!-- Redeem NWER Points Panel -->
<?php
$BalanceNWERPoints = $this->account_model->get_loyalty_points_balance($this->session->userdata('b2c_id'),$this->session->userdata('user_type'));
if($this->session->userdata('b2c_id') && $BalanceNWERPoints > 0){?>
<div class='panel'>
	<div class='panel-body'>
		<div class="panel panel-primary margin-bottom-null">
			<div class="panel-heading">
				<h3 class="panel-title"><?=lang('NWER_POINTS_BALANCE');?></h3>
			</div>
			<div class="clear"></div>
			<div class="panel-body">
				<p class="h4" style="color: #f77f00;">
					<b>
						<div class="col-md-12 text-center">
							<span style='font-size:20px;color:#f77f00;'>
								<?php echo $BalanceNWERPoints;?>
							</span>
						</div>
					</b>
					<?php
					if($_SESSION['RedeemStatus']!='Yes'){
						?>
						<div class='col-md-12 text-center'>
							<button id='RedeemNEWERPoints' class="btn btn-xs btn-info">
								<?=lang('REDEEM');?>
							</button>
						</div>
						<?php } ?>
					</p>
					<div class="clearfix" id='RPointsCon' <?php echo ($_SESSION['RedeemStatus']=='Yes') ? 'style="display:block"' : 'style="display:none"'; ?>>
						<div class="pull-left">
							<p class="text-info"><b><?=lang('POINTS_REDEEMED');?></b></p>
						</div>

						
						<div class="pull-right">
							<p>
								<span id='PointsRedeemed'><?php echo ($_SESSION['RedeemStatus']=='Yes') ? $RedeemPoints = round($_SESSION['RedeemPoints'],2) : $RedeemPoints = 0;?></span>
							</p>
						</div>
					</div>
				</div>
			</div>
			<br>
		</div>
	</div>
	<?php } ?>
	<!-- Redeem NWER Points Panel -->
</div>
<?php } ?>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
$(document).ready(function(){
	$(".dropdown-menu").on("mouseleave",  function(event) {
		$('div.btn-group').removeClass('show');
	});
	$("ul#ulselSsr input:radio").on('click',function(event){
		var selected = new Array();
		$( event.target ).blur();
		$(this).parents('div.btn-group').addClass('show');
		$("ul#ulselSsr input:radio:checked").each(function() {
			selected.push($(this).val());
		});
		$('#selSsr').val(selected);
	});
	$("ul#ulselSsradults input:radio").on('click',function(e){
		var selected_adult = new Array();
		$( event.target ).blur();
		$(this).parents('div.btn-group').addClass('show');
		$("ul#ulselSsradults input:radio:checked").each(function() {
			selected_adult.push($(this).val());
		});
		$('#selSsradults').val(selected_adult);
	});
	$("ul#ulselSsrchilds input:radio").on('click',function(e){
		var selected_child= new Array();
		$( event.target ).blur();
		$(this).parents('div.btn-group').addClass('show');
		$("ul#ulselSsrchilds input:radio:checked").each(function() {
			selected_child.push($(this).val());
		});
		$('#selSsrchilds').val(selected_child);
	});
	$("ul#ulselSsrinfants input:radio").on('click',function(e){
		var selected_infant = new Array();
		$( event.target ).blur();
		$(this).parents('div.btn-group').addClass('show');
		$("ul#ulselSsrinfants input:radio:checked").each(function() {
			selected_infant.push($(this).val());
		});
		$('#selSsrinfants').val(selected_infant);
	});
	$('[data-toggle="tooltip"]').tooltip();
	$("input[name='BookForBussiness']").click(function(){
		var BFB = $(this).is(':checked');
		if(BFB){
			$('#BussinessDetails').slideDown();
		}else{
			$('#BussinessDetails').slideUp();
		}
	});
	$('#RedeemNEWERPoints').click(function(){
		var TotAmt = $('#total_amount').html();
		$.ajax({
			type: "GET",
			url: WEB_URL+'/account/RedeemPoints',
			dataType: "json",
			success: function(data){
				if(data == '0'){
					$('#PROMODIV').remove();
				}
				var Tamt =parseFloat(TotAmt) - parseFloat(data*0.0075);
				$('#total_amount').html(Tamt.toFixed(2));
				$("#RedeemNEWERPoints").hide();
				$("#NWERPointsDiv").hide();
				
				$('#PointsRedeemed').html(data);
				$("#RPointsCon").show();
			}
		});
	});
	$('#continue').on('click', function() {
		if($("#serchagain").val()==1){
			alert("Something error hapenning passengers date birth please search again");
			return false;
		}
	});
	var modifyModal = $("#modifyModal");
	var modifyModalBody = $("#modifyModal").find(".modal-body");
	var modifyModal1 = $("#modifyModal");
	var modifyModalBody1 = $("#modifyModal").find(".modal-body");
	var alertmsg='';
	var alertmsg_r='';
	var calculateAge = function(on_date,checkdate) {
		var checkdate_e = checkdate.split("-");
		var checkdate=checkdate_e[2]+"-"+checkdate_e[1]+"-"+checkdate_e[0];
		var now = new Date(checkdate);
		var bdate_e = on_date.split("/");
		var on_date=bdate_e[2]+"-"+bdate_e[1]+"-"+bdate_e[0];
		var past = new Date(on_date);
		var nowYear = now.getFullYear();
		var pastYear = past.getFullYear();
		var age = nowYear - pastYear;
		return age;
	};
	sudo=[];
	$('.passenger_dob').on('change', function() {
		if($(this).hasClass("childs")){
			$(".childs").each(function() {
				if($(this).val()!=''){
					modifyModal.on('show.bs.modal', function () {
						var modal = $(this);
						if(j_type == "O") {
							modal.find('.modal-body input[value="oneway"]').attr("checked", true).parent().addClass("checked");
						} else if (j_type == "R") {
							modal.find('.modal-body input[value="circle"]').attr("checked", true).parent().addClass("checked");
						} else {
							modal.find('.modal-body input[value="multicity"]').attr("checked", true).parent().addClass("checked");
						}
						modal.find('.modal-body input[name="depature"]').val(departure_date);
						modal.find('.modal-body input[name="return"]').val(return_date);
						modal.find('.modal-body input[name="from"]').val(from);
						modal.find('.modal-body input[name="to"]').val(to);
						modal.find('.modal-body select[name="adult"]').children('option').each(function() {
							if($(this).text() == adult) {
								$(this).attr("selected", "selected");
								$(this).attr("disabled", false);
							}
						});
						modal.find('.modal-body select[name="child"]').children('option').each(function() {
							if($(this).text() == child) {
								$(this).attr("selected", "selected");
								$(this).attr("disabled", false);
							}
						});
						modal.find('.modal-body select[name="infant"]').children('option').each(function() {
							if($(this).text() == infant) {
								$(this).attr("selected", "selected");
								$(this).attr("disabled", false);
							}
						});
						modal.find('.modal-body .alert').text(alertmsg+" "+alertmsg_r);
					});
var departure_date=$(this).attr("departure_date");
var returndate=$(this).attr("return_date");
if(returndate!=''){
	var return_date=returndate;
}else{
	var return_date='';
}
var j_type = $(this).attr("trip_type");
var on_date=$(this).val();
var from=$(this).attr("from");
var to=$(this).attr("to");
var adult = $(this).attr("adult");
var child=$(this).attr("child");
var infant=$(this).attr("infant");
if(on_date!=''){
	if(j_type!='R'){
		if(calculateAge(on_date,departure_date)>12){
			alertmsg="Check All childs date of birth On This departure date this child is completed 11 years old please consider adult and Search Again";
			sudo.push(0);
			modifyModal.modal('show');
			modifyModal.trigger('show.bs.modal');
			$('#continue').attr("type","button");
			$("#serchagain").val(1);
		}else{
			sudo.pop(0);
		}
	}
	if(j_type=='R'){
		if(return_date!='' && calculateAge(on_date,return_date)>12){
			alertmsg_r="Check All childs date of birth On This return date this child is completed 11 years old please consider adult and Search Again";
			modifyModal.modal('show');
			modifyModal.trigger('show.bs.modal');
			$('#continue').attr("type","button");
			$("#serchagain").val(1);
			sudo.push(1);
		}else{
			sudo.pop(1);
		}
	}
}
}
});
}
if($(this).hasClass("infants")){
	$(".infants").each(function() {
		if($(this).val()!=''){
			modifyModal1.on('show.bs.modal', function () {
				var modal = $(this);
				if(j_type == "O") {
					modal.find('.modal-body input[value="oneway"]').attr("checked", true).parent().addClass("checked");
				} else if (j_type == "R") {
					modal.find('.modal-body input[value="circle"]').attr("checked", true).parent().addClass("checked");
				} else {
					modal.find('.modal-body input[value="multicity"]').attr("checked", true).parent().addClass("checked");
				}
				modal.find('.modal-body input[name="depature"]').val(departure_date);
				modal.find('.modal-body input[name="return"]').val(return_date);
				modal.find('.modal-body input[name="from"]').val(from);
				modal.find('.modal-body input[name="to"]').val(to);
				modal.find('.modal-body select[name="adult"]').children('option').each(function() {
					if($(this).text() == adult) {
						$(this).attr("selected", "selected");
						$(this).attr("disabled", false);
					}
				});
				modal.find('.modal-body select[name="child"]').children('option').each(function() {
					if($(this).text() == child) {
						$(this).attr("selected", "selected");
						$(this).attr("disabled", false);
					}
				});
				modal.find('.modal-body select[name="infant"]').children('option').each(function() {
					if($(this).text() == infant) {
						$(this).attr("selected", "selected");
						$(this).attr("disabled", false);
					}
				});
				modal.find('.modal-body .alert').text(alertmsg+" "+alertmsg_r);
			});
var departure_date=$(this).attr("departure_date");
var returndate=$(this).attr("return_date");
if(returndate!=''){
	var return_date=returndate;
}else{
	var return_date='';
}
var j_type = $(this).attr("trip_type");
var on_date=$(this).val();
var from=$(this).attr("from");
var to=$(this).attr("to");
var adult = $(this).attr("adult");
var child=$(this).attr("child");
var infant=$(this).attr("infant");
if(on_date!=''){
	if(j_type!='R'){
		if(calculateAge(on_date,departure_date)>2){
			alertmsg="Check All infant date of birth On this departure date this infant is completed 2 years old please consider child and Search Again";
			modifyModal1.modal('show');
//modifyModal.trigger('show.bs.modal');
$('#continue').attr("type","button");
$("#serchagain").val(1);
sudo.push(2);
}else{
	sudo.pop(2);
}
}
if(j_type=='R'){
	if(return_date!='' && calculateAge(on_date,return_date)>2){
		alertmsg_r="Check All infant date of birth On this return date this infant is completed 2 years old please consider child and Search Again";
		modifyModal1.modal('show');
//modifyModal.trigger('show.bs.modal');
$('#continue').attr("type","button");
$("#serchagain").val(1);
sudo.push(3);
}else{
	sudo.pop(3);
}
}
}
}
});
}
if(sudo==''){
	$("#serchagain").val('');
}
if($("#serchagain").val()==''){
	$('#continue').attr("type","submit");
}else{
	$('#continue').attr("type","button");
}
});
<?php
$JCConsiderDateVar = dateDiff($JCConsiderDate,date('d-m-Y'));
$MaxAdultDate = 4380+$JCConsiderDateVar;
$MinChildDate = 4380+$JCConsiderDateVar;
$MaxChildDate = 730+$JCConsiderDateVar;
$MinInfantDate = 730+$JCConsiderDateVar;
$MaxInfantDate = 0+$JCConsiderDateVar;
?>
$('.adults').datepicker({
	maxDate: "<?echo '-'.$MaxAdultDate;?>",
	yearRange: "-100:+0",
	dateFormat: 'dd/mm/yy',
//maxDate: "+1y",
numberOfMonths:1,
changeMonth: true,
//maxDate: '+12m',
changeYear: true
});
$('.childs').datepicker({
	minDate: "<?echo '-'.$MinChildDate;?>",
	maxDate: "<?echo '-'.$MaxChildDate;?>",
	yearRange: "-100:+0",
	dateFormat: 'dd/mm/yy',
//maxDate: "+1y",
numberOfMonths:1,
changeMonth: true,
//maxDate: '+12m',
changeYear: true
});
$('.infants').datepicker({
	minDate: "<?echo '-'.$MinInfantDate;?>",
	maxDate: "<?echo '-'.$MaxInfantDate;?>",
	yearRange: "-100:+0",
	dateFormat: 'dd/mm/yy',
//maxDate: "+1y",
numberOfMonths:1,
changeMonth: true,
//maxDate: '+12m',
changeYear: true
});
$('#billaddress').on('click', function() {
	$( this ).toggleClass( "open" );
	$( this ).parent().find('ul li a').on('click', function() {
		$('#country_code').val($( this ).attr("data-option"));
		$('span#billaddress').html($( this ).html());
	});
});
$('#paasengers').on('click', function() {
	$( this ).toggleClass( "open" );
	$( this ).parent().find('ul li a').on('click', function() {
		$('#country_code1').val($( this ).attr("data-option"));
		$('span#paasengers').html($( this ).html());
	});
});
$('input[name="insurance_type"]').on('change', function() {
	var instype=$(this).attr('selval');
// alert(instype);



//if(instype!='no_travel'){
	$('#insurance_con').show();
$('#insurance_con').find('p.insurance_text').html($('p#'+instype+'_info').text().split(':')[0]);
$('#insurance_con').find('#insurance_price').html($('p#'+instype+'_info').attr('price'));
	$('#total_amount').html((parseFloat($('p#'+instype+'_info').attr('price'))+parseFloat($('#total_amount').attr('price'))).toFixed(2)); 




$('p.insurance').addClass('hide');
$('p#'+instype+'_info').removeClass('hide');
$('#insurance_amount').val($('p#'+instype+'_info').attr('price'));
$('#insurance_tax').val($('p#'+instype+'_info').attr('tax'));
});
});
$('input[type="text"]').after('<div class="FInputValid"><img src="<?= ASSETS.'images/bg-tick.png';?>"></div>');
$('select').after('<div class="FInputValid"><img src="<?= ASSETS.'images/bg-tick.png';?>"></div>');
$('select,input[type="text"]').css('padding-right','25px');
$('.form-group').css('position','relative');
$('.input-group').css('position','static');
$('.cartprc .FInputValid').css('top','7px');
</script>
<?php
$this->load->view('common/footer');
function dateDiff ($d1, $d2) {
// Return the number of days between the two dates:
	return round(abs(strtotime($d1)-strtotime($d2))/86400);
}  // end function dateDiff
?>
