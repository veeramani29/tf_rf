<?php 
$this->load->view('common/header');
$language = $this->session->userdata('language');
error_reporting(0);
if($language){
	$this->lang->load('Booking_Page_BP', $language);
}else{
	$this->lang->load('Booking_Page_BP', 'english');
}

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
</style>
<link rel="stylesheet" href="http://bootstrapformhelpers.com/assets/css/bootstrap-formhelpers.min.css"/>
<!-- Modal -->
<div class="modal fade" id="modifyModal" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modifyModalLabel">Modify Your Search</h4>
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
									<div class="smpl-step-info text-center">Personal Details</div>
								</div>
								<div class="col-xs-4 smpl-step-step <?php echo (($this->uri->segment(3)!='') || ($this->input->get('orderId')!=''))?"complete":"";?>">
									<div class="progress hidden-xs">
										<div class="progress-bar"></div>
									</div>
									<a href="<?php echo ($this->input->get('orderId')=='')?"#payment-tab":"javascript:;";?>" class="smpl-step-icon"  data-toggle="tab">2</a>
									<div class="smpl-step-info text-center">Payment</div>
								</div>
								<div class="col-xs-4 smpl-step-step <?php echo (($this->input->get('orderId')!=''))?"complete":"";?>">
									<div class="progress hidden-xs">
										<div class="progress-bar"></div>
									</div>
									<a href="<?php echo ($this->input->get('orderId')=='')?"#confirmation-tab":"javascript:;";?>"  class="smpl-step-icon" data-toggle="tab">3</a>
									<div class="smpl-step-info text-center">Confirmation</div>
								</div>
							</div>

							<!-- Tab panes -->
							<div class="tab-content">
	<div role="tabpanel" class="tab-pane fade <?php echo ($this->uri->segment(3)=='' && $this->input->get('orderId')=='')?"active in":"";?>" id="registration-tab">

									<?php if($this->session->userdata("b2c_id")==''){?>
									<p class="text-primary">WIE ZIJN DE REIZIGERS?</p>
									<p>LOG IN OP UW MIJN VLIEGTARIEVEN.NL PROFILE EN BOEK 2X ZO SNEL</p>
									<p>Nog geen profiel? Deze wordt na de boeking automatisch aangemaakt.</p>

					<div class="popuperror" style="display:none;"></div>
					<div id="fadeandscale" style="display:none;"></div>
					<div class="form-group" id="continuelogin"><!-- Login-->

						<div class="row">
							<form id="login2" name="login" action="<?php echo WEB_URL;?>/account/login">
								<input type="hidden" name="bookertype" id="bookertype" value="<?php echo $this->session->userdata("b2c_id");?>">
								<div class="col-md-3">
									<label>GEBRUIKERSNAAM</label>
									<input type="email" name="email" id="plemail"  placeholder="Email Address"  class="form-control" required>
								</div>
								<div class="col-md-3">
									<label>WACHTWOORD</label>
									<input type="password" name="password" id="plpassword" placeholder="Password"   class="form-control" required>
								</div>
								<div class="col-md-3">
									<label class="invisible">Submit</label>
									<button type="submit" class="btn btn-primary center-block">Submit</button>
								</div>
							</form>
						</div>

					</div><!-- Login-->




								<div class="form-group">
									<div class="row">

										<div class="col-md-6">
											<div class="dntacnt">Don't have an account? <a class="fadeandscale_close fadeandscalereg_open">Sign up</a> </div>
										</div>
										<div class="col-md-6">
											<div class="dntacnt"><a class="fadeandscale_close fadeandscaleforget_open forgota pull-left" id="forgtpsw">WACHTWOORD VERGETEN?</a></div>
										</div>
										
									</div>
								</div>
								<?php }?>
								<p class="text-primary">HOE KUNNEN WE U BEREIKEN?</p>
								<p>PERSOONSGEGEUENS HOOFDBOEKER</p>
								<p>(De hoofdboeker dient minimaal 18 jaar oud te zijn)</p>
								<p>(Indien u reizigers boekt onder de 16 jaar dient u er rekening mee te houden dat begeleiding van deze persoon verplicht is.Informeer uzelf hierover.)</p>
								<form name="checkout-apartment" role="form" id="checkout-apartment"  autocomplete="off" action="<?php echo WEB_URL;?>/booking/checkout">
									<input type="hidden" name="serchagain" id="serchagain"/>
									<div class="form-group">
										<div class="row">

											<div class="col-xs-12">

												<div class="sectionbuk">

													<h3> <?php echo $this->lang->line('BP_F_Bookings'); ?> (<?php echo $Fcount;?>) Passenger Details</h3>

													<div class="" id="collapse102">
													<?php
														$i=1;
														foreach($cart_global as $key => $cid){
		
															list($module, $cid) = explode(',', $cid);
															if($module == 'FLIGHT'){
																$cart = $this->flight_model->getBookingTemp($cid)->row();

																$Total[] = $cart->total;

																$tot_pass = $this->cart_model->getCartDataByModule($cid,$module)->row();
																$request = json_decode(base64_decode($tot_pass->request));
																$from=$cart->fromCityName.","."(".$cart->Origin.")";
																$to=$cart->toCityName.","."(".$cart->Destination.")";
																// echo '<pre>';print_r($request->depart_date);
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
																	
                  

									<div class="payrow"><!--pay row-->
																	<?php $checkout_user=$this->session->userdata('checkout'); ?>
                     <div class="col-md-3">
                     	<div class="paylabel"><?php echo $this->lang->line('BP_Fname'); ?></div>
                     	<input type="text" name="first_name<?php echo $cid;?>" class="payinput" value="<?php echo($checkout_user['first_name'.$cid]!='')?$checkout_user['first_name'.$cid]:$userInfo->firstname;?>" required/>
                     </div>
                     <div class="col-md-3">
                     	<div class="paylabel">Middle Name</div>
                     	<input type="text" name="middle_name<?php echo $cid;?>" class="payinput" value="<?php echo($checkout_user['middle_name'.$cid]!='')?$checkout_user['middle_name'.$cid]:$userInfo->middlename;?>" />
                     </div>
                     <div class="col-md-3">
                     	<div class="paylabel"><?php echo $this->lang->line('BP_Lname'); ?></div>
                     	<input type="text" name="last_name<?php echo $cid;?>" class="payinput" value="<?php echo($checkout_user['last_name'.$cid]!='')?$checkout_user['last_name'.$cid]:$userInfo->lastname;?>" required/>
                     </div>
                     <?php  $usergender=($checkout_user['selGender'.$cid]!='')?$checkout_user['selGender'.$cid]:$userInfo->gender;?>
                     <div class="col-md-3">
                     	<div class="paylabel">Gender</div>
                     	<select name="selGender<?php echo $cid;?>"  class="form-control" id="selGender" required="required" >
                     		<option value="Female" <?php echo ($usergender=="Female")?"selected='selected'":"";?>>Female</option>
                     		<option value="Male" <?php echo ($usergender=="Male")?"selected='selected'":"";?>>Male</option>
                     	</select>
                     </div>
                     
                   </div><!--pay row-->
                   
                   <div class="payrow"><!--pay row-->
                   	<div class="col-md-3">
                   		<div class="paylabel">DOB</div>
									<?php
									if($checkout_user['txtdob'.$cid]!=''){
									$doba=$checkout_user['txtdob'.$cid];
									}else{

									$doba=explode("-",$userInfo->dob);
									$doba=array_reverse($doba);
									$doba=implode("/",$doba);
									}
									?>
                   		<input  type="text" name="txtdob<?php echo $cid;?>" class="payinput passenger_dob" value="<?php if($doba !='00/00/0000'){echo  $doba;}?>"  required />
                   	</div>
                   	<div class="col-md-3">
                   		<div class="paylabel"><?php echo $this->lang->line('BP_Email'); ?></div>
                   		<input type="text" name="email<?php echo $cid;?>" class="payinput" value="<?php echo($checkout_user['email'.$cid]!='')?$checkout_user['email'.$cid]:$userInfo->email;?>" required/>
                   	</div>
                   	<div class="col-md-6">
						
						
						<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_Contact'); ?></label>
											<div class="row">
												<div class="col-xs-5">
													<?php $Defaultselect=($checkout_user['country_code'.$cid]!='')?$checkout_user['country_code'.$cid]:(($userInfo->billing_country!='')?$userInfo->billing_country:"NL"); ?>
													<div class="bfh-selectbox bfh-countries" id="paasengers" tabindex="6"  data-flags="true">
										<input type="hidden" name="country_code<?php echo $cid;?>" id="country_code1" value="<?php echo $Defaultselect;?>">
										<a class="bfh-selectbox-toggle form-control" role="button" data-toggle="bfh-selectbox" href="javascript:;">
											<span class="bfh-selectbox-option" id="paasengers"><i class="glyphicon bfh-flag-<?php echo $Defaultselect;?>"></i><?php echo $this->apartment_model->get_country_phonecode($Defaultselect);?></span>
											<span class="caret selectbox-caret"></span></a>
											<div class="bfh-selectbox-options">
												<div role="listbox">
													<ul role="option">
														<?php foreach($countries as $country){?>
														<li><a style="overflow-x: visible !important;" tabindex="-1" href="javascript:;" data-option="<?php echo $country->country_code;?>"><i class="glyphicon bfh-flag-<?php echo $country->country_code;?>"></i><?php echo $country->phonecode;?></a></li>
															<?php }?>
														</ul>
												</div>
											</div>
									</div>	
								</div>
												<div class="col-xs-7 padding-left-null">
													<input maxlength="100" type="text"  name="mobile<?php echo $cid;?>"  value="<?php echo($checkout_user['mobile'.$cid]!='')?$checkout_user['mobile'.$cid]:$userInfo->billing_contact;?>" required="required" class="form-control" placeholder="<?php echo $this->lang->line('BP_Contact'); ?>" />
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
						<div class="payrow"><!--pay row-->
                   		<div class="col-md-2">
                   			<div class="paylabel" style="margin-top: 30px;"> <?php echo ucfirst($key)." ".$sno;?></div>
                   		</div>

		<?php
		 $ttt=$key.$sno;
		$multifname=($checkout_user['pfirst_name'.$cid][$ttt]!='')?$checkout_user['pfirst_name'.$cid][$ttt]:'';
		$multimname=($checkout_user['pmiddle_name'.$cid][$ttt]!='')?$checkout_user['pmiddle_name'.$cid][$ttt]:'';
		$multilname=($checkout_user['plast_name'.$cid][$ttt]!='')?$checkout_user['plast_name'.$cid][$ttt]:'';
		$multidob=($checkout_user['ptxtdob'.$cid][$ttt]!='')?$checkout_user['ptxtdob'.$cid][$ttt]:'';
		$multigender=($checkout_user['pfirst_name'.$cid][$ttt]!='')?$checkout_user['pfirst_name'.$cid][$ttt]:'';
		?>
						 <div class="col-md-2">
                     	<div class="paylabel">First Name</div>
                     	<input type="text" name="pfirst_name<?php echo $cid;?>[<?php echo $key.$sno;?>]" class="payinput" value="<?php echo $multifname;?>" required />
                     </div>
                     <div class="col-md-2">
                     	<div class="paylabel">Middle Name</div>
                     	<input type="text" name="pmiddle_name<?php echo $cid;?>[<?php echo $key.$sno;?>]" class="payinput" value="<?php echo $multimname;?>" />
                     </div>
                     <div class="col-md-2">
                     	<div class="paylabel">Last Name</div>
                     	<input type="text" name="plast_name<?php echo $cid;?>[<?php echo $key.$sno;?>]" class="payinput" value="<?php echo $multilname;?>" required />
                     </div>
                     <div class="col-md-2">
                     	<div class="paylabel">DOB</div>
                     	<input type="text"   name="ptxtdob<?php echo $cid;?>[<?php echo $key.$sno;?>]" trip_type="<?php echo $request->type;?>" adult="<?php echo $pass_result['adults'];?>" child="<?php echo $pass_result['childs'];?>" infant="<?php echo $pass_result['infants'];?>" extradays="" from="<?php echo $from;?>" to="<?php echo $to;?>" departure_date="<?php echo date("d-m-Y",strtotime($request->depart_date));?>" return_date="<?php echo (isset($request->return_date))?date("d-m-Y",strtotime($request->return_date)):'';?>" class="payinput passenger_dob <?php echo $key;?>" value="<?php echo $multidob;?>"  required />
                     </div>
                     <div class="col-md-2">
                     	<div class="paylabel">Gender</div>
                     	<select name="pselGender<?php echo $cid;?>[<?php echo $key.$sno;?>]"  class="form-control" id="selGender" required >
                     		<option value="Female" <?php echo ($multigender=="Female")?"selected":'';?>>Female</option>
                     		<option value="Male" <?php echo ($multigender=="Male")?"selected":'';?>>Male</option>
                     	</select>
                     </div>
				</div><!--pay row-->
						<?php  }} ?>


																</div><!-- onedep1-->	
																
																<?php $i++;}}?>
																</div><!-- collapse102-->
										
                   
															</div><!--sectionbuk-->




             <h3><?php echo $this->lang->line('BP_Billing_Address'); ?></h3>


             <div class="col-md-6"><!--Col 6-->

             	<div class="form-group">
             		<label class="control-label"> <?php echo $this->lang->line('BP_Fname'); ?></label>
             		<input  maxlength="100" tabindex="1" type="text" required="required" name="first_name" value="<?php echo($checkout_user['first_name']!='')?$checkout_user['first_name']:$userInfo->billing_firstname;?>" class="form-control" placeholder="<?php echo $this->lang->line('BP_Fname'); ?>"  />
             	</div>
             	<div class="form-group">
             		<label class="control-label"> <?php echo $this->lang->line('BP_Lname'); ?></label>
             		<input  maxlength="100" tabindex="3" type="text" required="required" name="last_name"  value="<?php echo($checkout_user['last_name']!='')?$checkout_user['last_name']:$userInfo->billing_lastname;?>"  class="form-control" placeholder="<?php echo $this->lang->line('BP_Lname'); ?>"  />
             	</div>

             	<div class="form-group">
             		<label class="control-label"> <?php echo $this->lang->line('BP_Address1'); ?> </label>
             		<input maxlength="100" tabindex="5" type="text" name="street_address"  value="<?php echo($checkout_user['street_address']!='')?$checkout_user['street_address']:$userInfo->billing_addressA;?>" required="required" class="form-control" placeholder="<?php echo $this->lang->line('BP_Address1'); ?>" />
             	</div>


			<!--<div class="form-group">
				<label class="control-label"> <?php echo $this->lang->line('BP_State'); ?> </label>
				<input maxlength="100" type="text" tabindex="7"  name="state"  value="<?php if($userInfo->billing_state != NULL){echo $userInfo->billing_state;}?>"  class="form-control" placeholder="<?php echo $this->lang->line('BP_State'); ?>" />
			</div>-->
			<div class="form-group">
				<label class="control-label"> <?php echo $this->lang->line('BP_City'); ?> </label>
				<input maxlength="100" tabindex="7" type="text" required="required" name="city"  value="<?php echo($checkout_user['city']!='')?$checkout_user['city']:$userInfo->billing_city;?>" class="form-control" placeholder="<?php echo $this->lang->line('BP_City'); ?>" />
			</div>
			<div class="form-group">
				<label class="control-label"> <?php echo $this->lang->line('BP_Postal'); ?> </label>
				<input maxlength="100" type="text" name="zip" tabindex="9"  value="<?php echo($checkout_user['zip']!='')?$checkout_user['zip']:$userInfo->billing_postal;?>" required="required" class="form-control" placeholder="<?php echo $this->lang->line('BP_Postal'); ?>" />
			</div>
										
										
			</div><!--Col 6-->

									<div class="col-md-6"><!--Col 6-->
										
										<div class="form-group">
											<label class="control-label"> Middle Name</label>
											<input  maxlength="100" tabindex="2" type="text"  name="middle_name"  value="<?php echo($checkout_user['middle_name']!='')?$checkout_user['middle_name']:$userInfo->billing_middlename;?>"  class="form-control" placeholder="Middle Name"  />
										</div>
										<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_Email'); ?> </label>
											<input maxlength="100" tabindex="4" type="email" name="email" value="<?php echo($checkout_user['email']!='')?$checkout_user['email']:$email;?>"  required="required" class="form-control" placeholder="<?php echo $this->lang->line('BP_Email'); ?>" />
										</div>
										<!--<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_Address2'); ?> </label>
											<input maxlength="100" tabindex="4" type="text" name="address2"  required="required" value="<?php if($userInfo->billing_addressB != NULL){echo $userInfo->billing_addressB;}?>" class="form-control" placeholder="<?php echo $this->lang->line('BP_Address2'); ?>" />
										</div>-->

										<input type="hidden" name="cid" id="cid" value="<?php echo $cart_global_id;?>"/>
										
									<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_Contact'); ?></label>
											<div class="row">
												<div class="col-xs-5">
													<?php $Defaultselect=($checkout_user['country_code'.$cid]!='')?$checkout_user['country_code'.$cid]:(($userInfo->billing_country!='')?$userInfo->billing_country:"NL"); ?>
													<div class="bfh-selectbox bfh-countries" id="billaddress" tabindex="6"  data-flags="true">
										<input type="hidden" name="country_code" id="country_code" value="<?php echo $Defaultselect;?>">
										<a class="bfh-selectbox-toggle form-control" role="button" data-toggle="bfh-selectbox" href="javascript:;">
											<span class="bfh-selectbox-option" id="billaddress"><i class="glyphicon bfh-flag-<?php echo $Defaultselect;?>"></i> <?php echo $this->apartment_model->get_country_phonecode($Defaultselect);?></span>
											<span class="caret selectbox-caret"></span></a>
											<div class="bfh-selectbox-options">
												<div role="listbox">
													<ul role="option">
														<?php foreach($countries as $country){?>
														<li><a style="overflow-x: visible !important;" tabindex="-1" href="javascript:;" data-option="<?php echo $country->country_code;?>"><i class="glyphicon bfh-flag-<?php echo $country->country_code;?>"></i><?php echo $country->phonecode;?></a></li>
															<?php }?>
														</ul>
												</div>
											</div>
									</div>	
									
													
													
												</div>
												<div class="col-xs-7 padding-left-null">
													<input maxlength="100" type="text" tabindex="6" name="mobile"  value="<?php echo($checkout_user['mobile']!='')?$checkout_user['mobile']:$userInfo->billing_contact;?>" required="required" class="form-control" placeholder="<?php echo $this->lang->line('BP_Contact'); ?>" />
												</div>
											</div>
										</div>
										
										
										<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_Country'); ?> </label>
											<?php $Defaultselect=($userInfo->billing_country!='')?$userInfo->billing_country:"NL"; ?>	
											<select tabindex="8" class="form-control fpayinselect mySelectBoxClass hasCustomSelect" name="country" required>
											<?php foreach($countries as $country){?>
											<option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $Defaultselect) ? "selected" : ""; ?> ><?php echo $country->name;?></option>
											<?php }?>
										</select>
									</div>
								
								</div><!--Col 6-->

							</div>


						</div>
					</div>

					<p><?php echo $this->lang->line('BP_Bookit'); ?></p>
					<div class="checkbox">
						<input type="hidden" id="total_payable" name="total" value="<?php echo base64_encode(array_sum($Total)); ?>"/>
						<input type="hidden" id="pcode" name="code" value="<?php echo base64_encode('fool'); ?>"/>
						<label for="confirm" class="checkbox-inline"><input tabindex="10" type="checkbox" id="confirm" name="confirm" class="checkleft" required="" aria-required="true"> <?php echo $this->lang->line('BP_Bookit1'); ?><a class="colorbl"><?php echo $this->lang->line('BP_Terms_Of_Service'); ?></a>, <a class="colorbl"><?php echo $this->lang->line('BP_Cancellation_Policy'); ?></a> <?php echo $this->lang->line('BP_And'); ?> <a class="colorbl"><?php echo $this->lang->line('BP_Guest_Policy'); ?></a>.</label>
					</div>


					<hr class="margin-top-null">

					<div class="clearfix">
						<div class="pull-right">
							<button tabindex="12" type="submit" id="continue" class="btn btn-primary" >Continue</button>
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
					 $final_paymentprice = base64_encode($global_book->amount);
				}else{
					 $final_paymentprice = base64_encode(array_sum($Totall));
				}
				$view_data = array('amount' => $final_paymentprice,'entranceCode'=>$this->uri->segment(3));
				$this->load->ext_view('third_party/ideal/pay', 'requestTransaction', $view_data);
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

			<h3 class="text-center tf-primary text-uppercase margin-top-null"><b>Flight details</b></h3>
			<?php
			$AllVisibleMarkupDiscount = array();
			$adult_total_MarkupDiscount = 0;
			foreach($cart_global as $key => $cid){
				list($module, $cid) = explode(',', $cid);

				if($module == 'FLIGHT'){
					$cart = $this->cart_model->getCartDataByModule($cid,$module)->row();
					$request = json_decode(base64_decode($cart->request));

					$passenger_details=json_decode(base64_decode($cart->passenger_details));
					
					$response_details=json_decode(base64_decode($cart->response));

					$AllVisibleMarkupDiscountDescoded = json_decode($cart->VisibleMarkupDiscount);
					$adult_total_MarkupDiscount+=$cart->HiddenMarkupDiscount;

					$AllVisibleMarkupDiscount = array_merge($AllVisibleMarkupDiscount,$AllVisibleMarkupDiscountDescoded);

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
							$v=0;
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
							<?php $vv=$v+1;
  				$range=($vv==1)?'st':(($vv==2)?'nd':(($vv==3)?'rd':(($vv>3)?'th':'')));
  				?> 
								<h5 class="text-uppercase tf-primary margin-bottom-null"><?php if($v==0) { ?><b>Multi City</b> <?php } echo ($vv)."<sup>".$range."</sup> Travel";?></h5>
							<div class="onwyrow">
								<div class="col-xs-6 col-md-2 nopad fulat500">
									<div class="flitsecimg">
										<img src="<?php echo ASSETS;?>images/airline_logo/<?php echo $onward_first_seg->Carrier;?>.gif"  alt="IMAGE" class="img-responsive">
										<span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($onward_first_seg->Carrier);?></span>
									</div>
								</div>
								<div class="col-xs-6 col-md-4">
									<br>
									<div class="radiobtn"><?php echo $this->flight_model->get_airport_cityname($onward_first_seg->Origin).' <span class="text-info">('.$onward_first_seg->Origin.')</span>';?></div>
									<span class="norto"><small><?php echo date('d M, Y H:i', $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime));?></small></span>
								</div>
								<div class="col-xs-6 col-md-4">
									<br>
									<span class="radiobtn"><?php echo $this->flight_model->get_airport_cityname($onward_last_seg->Destination).' <span class="text-info">('.$onward_last_seg->Destination.')</span>';?></span>
									<span class="norto"><small><?php echo date('d M, Y H:i', $this->flight_model->get_unixtimestamp($onward_last_seg->ArrivalTime));?></small></span>
								</div>
								<div class="col-xs-6 col-md-2 nopad fulat500 text-center">
									<br>
									<div class="fatfi">
										<span class="norto lbold"><img src="<?php echo ASSETS;?>images/site/clk.png"> <?php echo $dur;?></span>
										<span class="norto text-primary"><?php echo (($Stops>1)?$Stops." STOPS":(($Stops==0)?"NON STOP":$Stops." STOP"));?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div><!--multicity booking details end -->
							<?php $v++;} }







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
							<h5 class="text-uppercase tf-primary margin-bottom-null"><b><?php echo ($request->type=='O')?"One Way":(($request->type=='M')?"":"Round Trip (Onwards)");?></b></h5>
							
							<div class="onwyrow">
								<div class="col-xs-6 col-md-2 nopad fulat500">
									<div class="flitsecimg">
										<img src="<?php echo $cart->AirImage;?>"  alt="IMAGE" class="img-responsive">
										<span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($onward_first_seg->Carrier);?></span>
									</div>
								</div>
								<div class="col-xs-6 col-md-4">
									<br>
									<div class="radiobtn"><?php echo $onward_originCity.' <span class="text-info">('.$onward_origin.')</span>';?></div>
									<span class="norto"><small><?php echo date('d M, Y H:i', $onward_DepartureDateTime);?></small></span>
								</div>
								<div class="col-xs-6 col-md-4">
									<br>
									<span class="radiobtn"><?php echo $onward_destinationCity.' <span class="text-info">('.$onward_destination.')</span>';?></span>
									<span class="norto"><small><?php echo date('d M, Y H:i', $onward_ArrivalDateTime);?></small></span>
								</div>
								<div class="col-xs-6 col-md-2 nopad fulat500 text-center">
									<br>
									<div class="fatfi">
										<span class="norto lbold"><img src="<?php echo ASSETS;?>images/site/clk.png"> <?php echo $onward_dur;?></span>
										<span class="norto text-primary"><?php echo (($Stops>1)?$Stops." STOPS":(($Stops==0)?"NON STOP":$Stops." STOP"));?></span>
									</div>
								</div>
							</div>
							
						</div>
					</div>
					<div class="clearfix"></div>
				</div><!-- booking details -->
				<?php } if($request->type=='R'){ ?>
					<!-- round trip booking details -->
				<div class="frow1">
					<div class="col-md-12 nopad tablshow">
						<div class="nopad fulwidmob">
							<h5 class="text-uppercase tf-primary margin-bottom-null"><b>Return</b></h5>
							<div class="onwyrow">
								<div class="col-xs-6 col-md-2 nopad fulat500">
									<div class="flitsecimg">
										<img src="<?php echo $cart->AirImage;?>"  alt="IMAGE" class="img-responsive">
										<span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($return_first_seg->Carrier);?></span>
									</div>
								</div>
								<div class="col-xs-6 col-md-4">
									<br>
									<div class="radiobtn"><?php echo $return_originCity.' <span class="text-info">('.$return_origin.')</span>';?></div>
									<span class="norto"><small><?php echo date('d M, Y H:i', $return_DepartureDateTime);?></small></span>
								</div>
								<div class="col-xs-6 col-md-4">
									<br>
									<span class="radiobtn"><?php echo $return_destinationCity.' <span class="text-info">('.$return_destination.')</span>';?></span>
									<span class="norto"><small><?php echo date('d M, Y H:i', $return_ArrivalDateTime);?></small></span>
								</div>
								<div class="col-xs-6 col-md-2 nopad fulat500 text-center">
									<br>
									<div class="fatfi">
										<span class="norto lbold"><img src="<?php echo ASSETS;?>images/site/clk.png"> <?php echo $return_dur;?></span>
										<span class="norto text-primary"><?php echo (($retStops>1)?$retStops." STOPS":(($Stops==0)?"NON STOP":$retStops." STOP"));?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div><!-- round trip booking details end -->

				<?php } } ?>


				<h3 class="h4 tf-primary text-uppercase"><b>Fare details</b></h3>
				<div class="clearfix">
					<div class="pull-left">
						<p class="text-info">Adults  Price (<?php echo array_sum($adult_total);?>)</p>
					</div>
					<div class="pull-right">
						<p><?php echo CURR_ICON.' '.array_sum($adult_base_price);?></p>
					</div>
				</div>
				<div class="clearfix">
					<div class="pull-left">
						<p class="text-info">Adults Tax Price </p>
					</div>
					<div class="pull-right">
						<p><?php echo CURR_ICON.' '.(array_sum($adult_tax_price)+$adult_total_MarkupDiscount);?></p>
					</div>
				</div>
				<!-- <div class="clearfix">
					<div class="pull-left">
						<p class="text-info">Sub Total </p>
					</div>
					<div class="pull-right">
						<p><?php echo array_sum($adult_total_price);?></p>
					</div>
				</div> -->
				<?php if(array_sum($childs_total)!=0){ ?>
				<div class="clearfix">
					<div class="pull-left">
						<p class="text-info">Childs  Price (<?php echo array_sum($childs_total);?>)</p>
					</div>
					<div class="pull-right">
						<p><?php echo CURR_ICON.' '.array_sum($childs_base_price);?></p>
					</div>
				</div>
				<div class="clearfix">
					<div class="pull-left">
						<p class="text-info">Childs Tax Price </p>
					</div>
					<div class="pull-right">
						<p><?php echo CURR_ICON.' '.array_sum($childs_tax_price);?></p>
					</div>
				</div>
				<!-- <div class="clearfix">
					<div class="pull-left">
						<p class="text-info">Sub Total </p>
					</div>
					<div class="pull-right">
						<p><?php echo array_sum($child_total_price);?></p>
					</div>
				</div> -->
				<?php }  if(array_sum($infants_total)!=0){?>
				<div class="clearfix">
					<div class="pull-left">
						<p class="text-info">Infants  Price (<?php echo array_sum($infants_total);?>)</p>
					</div>
					<div class="pull-right">
						<p><?php echo CURR_ICON.' '.array_sum($infants_base_price);?></p>
					</div>
				</div>
				<div class="clearfix">
					<div class="pull-left">
						<p class="text-info">Infants Tax Price</p>
					</div>
					<div class="pull-right">
						<p><?php echo CURR_ICON.' '.array_sum($infants_tax_price);?></p>
					</div>
				</div>
				<!-- <div class="clearfix">
					<div class="pull-left">
						<p class="text-info">Sub Total </p>
					</div>
					<div class="pull-right">
						<p><?php echo array_sum($infant_total_price);?></p>
					</div>
				</div> -->
				<?php } ?>

				<?php
				foreach ($AllVisibleMarkupDiscount as $VisibleMarkupDiscount) {
				?>
					<div class="clearfix">
						<div class="pull-left">
							<p class="text-info"><?=$VisibleMarkupDiscount[0]?></p>
						</div>
						<div class="pull-right">
							<p><?php echo $VisibleMarkupDiscount[1].' '.CURR_ICON.' '.$VisibleMarkupDiscount[2];?></p>
						</div>
					</div>
				<?php
				}
				?>

				<div class="clearfix">
					<div class="pull-left">
						<p class="text-info">Sub Total</p>
					</div>
					<div class="pull-right">
						<p><?php echo CURR_ICON.' '.array_sum($BasePrice);?></p>
					</div>
				</div>
				<div class="clearfix">
					<div class="pull-left">
						<p class="text-info">Total Price </p>
					</div>
					<div class="pull-right">
						<p><?php echo CURR_ICON.' '.(array_sum($TaxPrice) + array_sum($BasePrice));?></p>
					</div>
				</div>
				<!-- <div class="clearfix">
					<div class="pull-left">
						<p class="text-info">Total Tax Price</p>
					</div>
					<div class="pull-right">
						<p><?php echo array_sum($TaxPrice);?></p>
					</div>
				</div> -->

				<div class="panel panel-primary margin-bottom-null">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo $this->lang->line('BP_Promo'); ?></h3>
					</div>

					<div class="clear"></div>
					<div class="panel-body">
						<form id="promocode" name="promocode" action="<?php echo WEB_URL;?>/booking/promo">
							<div class="col-md-8">
								<div class="cartprc">
									<input type="hidden" name="total" value="<?php echo base64_encode(array_sum($Totall)); ?>">
									<input type="hidden" name="cid" id="cid" value="<?php echo $cart_global_id;?>"/>
									<div class="payblnhm singecartpricebuk ritaln">
										<input type="text" class="promocode" id="code" name="code" placeholder="<?php echo $this->lang->line('BP_Enter_Promo'); ?>" required/>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<input type="submit" class="promosubmit" name="apply" value="<?php echo $this->lang->line('BP_Apply'); ?>" />
							</div>
						</form>
					</div>
					<div class="clear"></div>
					<div class="savemessage"></div>

				</div>
				<br>
				<div class="clearfix">
					<div class="pull-left">
						<?php $total_passanger=array_sum($infants_total)+array_sum($childs_total)+array_sum($adult_total);?>
						<p class="tf-primary h5 text-uppercase"><b>Total Payable Price (<?php echo ($total_passanger);?>)</b></p>
					</div>
					<div class="pull-right">
						<p class="h4" style="color: #f77f00;"><b><?php echo CURR_ICON.' '.array_sum($Totalprice);?></b></p>
					</div>
				</div>

			</div>
		</div>
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
