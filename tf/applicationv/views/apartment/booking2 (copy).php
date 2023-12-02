<?php $this->load->view('common/header');
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
<div class="lodrefrentwhole"><div class="centerload"></div></div><div class="full marintopcnt witebackgrnd"><div class="container fordetailpage dontpad"><div class="container paymentpage">
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
						  
						<div class="form-group">
								<div class="row">
						
<div class="col-md-3">
<div class="checkbox">
<label><input type="radio" name="login" id="user-login"   checked> Already Login</label>
</div>
</div>

<div class="col-md-4">
<div class="checkbox">
<label><input type="radio" name="login"  > Continue as a guest</label>
</div>
</div>
						</div>
						</div>
						<div class="popuperror" style="display:none;"></div>
						<div id="fadeandscale" style="display:none;"></div>
							<div class="form-group" id="continuelogin">
								
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
								
							</div>
						
						
						
							<div class="form-group collapse" id="continueguest">
									<div class="row">
										<form id="login3" name="login" >
							<input type="hidden" name="bookertype" id="bookertype" value="<?php echo $this->session->userdata("b2c_id");?>">
										<div class="col-md-4">
											<label>Email</label>
											<input type="email" class="form-control"  name="email" id="guestemail"  placeholder="Email Address" required>
										</div>
										<div class="col-md-4">
											<label>Phone no</label>
											<input type="tel" name="phoneno" id="guestphoneno"    class="form-control" placeholder="Phone No" required>
										</div>
										<div class="col-md-4">
											<label class="invisible">Continue as a guest</label>
											<button type="submit" class="btn btn-primary center-block">Continue</button>
										</div>
										</form>
									</div>
							
							
						</div>
						
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
							<div class="form-group">
								<div class="row">
									
									
									
									
									
									       
       
 
									
									
								
						<div class="col-xs-12">
							
							
							
         <div class="sectionbuk"> 
         
         		<h3> <?php echo $this->lang->line('BP_F_Bookings'); ?> (<?php echo $Fcount;?>) Passenger Details</h3>
           
            
        
            
     		<div class="" id="collapse102">
<?php
	$i=1; 
	foreach($cart_global as $key => $cid){
		//echo '<pre>';print_r($cid);
		list($module, $cid) = explode(',', $cid);
		if($module == 'FLIGHT'){
			$cart = $this->flight_model->getBookingTemp($cid)->row();
			//echo '<pre>';print_r($book_temp_data);
            $Total[] = $cart->total;
?>          
            <div class="onedept">
                <h3 class="inpagehedbuk">
                    <span class="bookingcnt"><?php echo $i;?>.</span>
                    <span class="aptbokname"><?php echo $cart->fromCityName;?> (<?php echo $cart->Origin;?>) - <?php echo $cart->toCityName;?> (<?php echo $cart->Destination;?>)</span>            
                </h3>
                <div class="payrow">
                    <div class="col-md-6">
                        <div class="paylabel"><?php echo $this->lang->line('BP_Fname'); ?></div>
                        <input type="text" name="first_name<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_firstname != NULL){echo $userInfo->billing_firstname;}?>" required/>
                    </div>  
                    <div class="col-md-6">
                        <div class="paylabel"><?php echo $this->lang->line('BP_Lname'); ?></div>
                        <input type="text" name="last_name<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_lastname != NULL){echo $userInfo->billing_lastname;}?>" required/>
                    </div>
                </div>
                <div class="payrow">
                    <div class="col-md-6">
                        <div class="paylabel"><?php echo $this->lang->line('BP_Email'); ?></div>
                        <input type="text" name="email<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_email != NULL){echo $userInfo->billing_email;}?>" required/>
                    </div>
                    <div class="col-md-6">
                        <div class="paylabel"><?php echo $this->lang->line('BP_Contact'); ?></div>
                        <input type="text" name="mobile<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_contact != NULL){echo $userInfo->billing_contact;}?>" required/>
                    </div>
                </div>
			</div>
<?php $i++;}}?>       
            </div>
            
          </div> 

 
 
 
							<h3><?php echo $this->lang->line('BP_Billing_Address'); ?></h3>


									<div class="col-md-6">
										
										<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_Fname'); ?></label>
											<input  maxlength="100" tabindex="1" type="text" required="required" name="first_name" value="<?php if($userInfo->billing_firstname != NULL){echo $userInfo->billing_firstname;} else {echo $userInfo->firstname;} ?>" class="form-control" placeholder="<?php echo $this->lang->line('BP_Fname'); ?>"  />
										</div>
										<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_Address1'); ?> </label>
											<input maxlength="100" tabindex="3" type="text" name="street_address"  value="<?php if($userInfo->billing_addressA != NULL){echo $userInfo->billing_addressA;}?>" required="required" class="form-control" placeholder="<?php echo $this->lang->line('BP_Address1'); ?>" />
										</div>

										<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_Email'); ?> </label>
											<input maxlength="100" tabindex="5" type="email" name="email" value="<?php if($email != NULL){echo $email;}?>"  required="required" class="form-control" placeholder="<?php echo $this->lang->line('BP_Email'); ?>" />
										</div>
										<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_State'); ?> </label>
											<input maxlength="100" type="text" tabindex="7"  name="state"  value="<?php if($userInfo->billing_state != NULL){echo $userInfo->billing_state;}?>" required="required" class="form-control" placeholder="<?php echo $this->lang->line('BP_State'); ?>" />
										</div>
										<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_Postal'); ?> </label>
											<input maxlength="100" type="text" name="zip" tabindex="9"  value="<?php if($userInfo->billing_postal != NULL){echo $userInfo->billing_postal;}?>" required="required" class="form-control" placeholder="<?php echo $this->lang->line('BP_Postal'); ?>" />
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_Lname'); ?></label>
											<input  maxlength="100" tabindex="2" type="text" required="required" name="last_name"  value="<?php if($userInfo->billing_lastname != NULL){echo $userInfo->billing_lastname;} else {echo $userInfo->lastname;}?>"  class="form-control" placeholder="<?php echo $this->lang->line('BP_Lname'); ?>"  />
										</div>
										<!--<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_Address2'); ?> </label>
											<input maxlength="100" tabindex="4" type="text" name="address2"  required="required" value="<?php if($userInfo->billing_addressB != NULL){echo $userInfo->billing_addressB;}?>" class="form-control" placeholder="<?php echo $this->lang->line('BP_Address2'); ?>" />
										</div>-->
										<input type="hidden" name="cid" id="cid" value="<?php echo $cart_global_id;?>"/>
										<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_Contact'); ?></label>
											<input maxlength="100" type="text" tabindex="4" name="mobile"  value="<?php if($userInfo->billing_contact != NULL){echo $userInfo->billing_contact;}?>" required="required" class="form-control" placeholder="<?php echo $this->lang->line('BP_Contact'); ?>" />
										</div>
										<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_Country'); ?> </label>
			<?php $Defaultselect=($userInfo->billing_country!='')?$userInfo->billing_country:"NL"; ?>								<select tabindex="6" class="form-control fpayinselect mySelectBoxClass hasCustomSelect" name="country" required>
												<?php foreach($countries as $country){?>
												<option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $Defaultselect) ? "selected" : ""; ?> ><?php echo $country->name;?></option>
												<?php }?>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_City'); ?> </label>
											<input maxlength="100" tabindex="8" type="text" required="required" name="city"  value="<?php if($userInfo->billing_city != NULL){echo $userInfo->billing_city;}?>" class="form-control" placeholder="<?php echo $this->lang->line('BP_City'); ?>" />
										</div>
										

									</div>
							
								</div>
								
									<!--<div class="col-md-3">
										<select class="form-control">
											<option>Geen</option>
										</select>
									</div>
									<div class="col-md-3">
										<div class="checkbox">
											<label>
												<input type="checkbox"> IK BOEK ZAKELIJK
											</label>
										</div>
									</div>-->
								</div>
							</div>
							<!--<div class="form-group">
								<div class="row">
									<div class="col-md-3">
										<label>Address</label>
										<input type="text" class="form-control" placeholder="Address">
									</div>
									<div class="col-md-3">
										<label>HUISNUMMER</label>
										<input type="num" class="form-control" placeholder="House No" min="0">
									</div>
									<div class="col-md-3">
										<label>Post Code</label>
										<input type="text" class="form-control" placeholder="post code">
									</div>
									<div class="col-md-3">
										<label>WOONPLAATS</label>
										<input type="text" class="form-control" placeholer="WOONPLAATS">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
										<label>Country</label>
										<select class="form-control">
											<option>NETHERLAND</option>
										</select>
									</div>
									<div class="col-md-3">
										<label>Email</label>
										<input type="email" class="form-control" placeholder="Email">
									</div>
									<div class="col-md-3">
										<label>Mobile No</label>
										<input type="tel" class="form-control" placeholer="Mobile No">
									</div>
								</div>
							</div>-->
						<p><?php echo $this->lang->line('BP_Bookit'); ?></p>
						<div class="checkbox">
							<input type="hidden" id="total_payable" name="total" value="<?php echo base64_encode(array_sum($Total)); ?>"/>
										<input type="hidden" id="pcode" name="code" value="<?php echo base64_encode('fool'); ?>"/>
							<label for="confirm" class="checkbox-inline"><input tabindex="10" type="checkbox" id="confirm" name="confirm" class="checkleft" required="" aria-required="true"> <?php echo $this->lang->line('BP_Bookit1'); ?><a class="colorbl"><?php echo $this->lang->line('BP_Terms_Of_Service'); ?></a>, <a class="colorbl"><?php echo $this->lang->line('BP_Cancellation_Policy'); ?></a> <?php echo $this->lang->line('BP_And'); ?> <a class="colorbl"><?php echo $this->lang->line('BP_Guest_Policy'); ?></a>.</label>
						</div>
						
						<!--<form>
							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
										<label>Gender*</label>
										<div>
											<label class="radio-inline">
												<input type="radio" name="gender"> Male
											</label>
											<label class="radio-inline">
												<input type="radio" name="gender"> Female
											</label>
										</div>
									</div>
									<div class="col-md-2">
										<label>VOORNAAM</label>
										<input type="text" class="form-control">
									</div>
									<div class="col-md-2">
										<label>TUSSENVOEGSEL</label>
										<select class="form-control">
											<option>Geen</option>
										</select>
									</div>
									<div class="col-md-5">
										<label>Date of Birth</label>
										<div class="row">
											<div class="col-md-4">
												<select class="form-control">
													<option>01</option>
												</select>
											</div>
											<div class="col-md-4">
												<select class="form-control">
													<option>Jan</option>
												</select>
											</div>
											<div class="col-md-4">
												<select class="form-control">
													<option>2000</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>				       
						<p class="text-primary"><img src="<?php echo ASSETS; ?>images/down_arrow.png" alt="Arrow Down"> More Options</p>-->	
						<hr class="margin-top-null">
						
						<div class="clearfix">
							<div class="pull-right">
								<button tabindex="12" type="<?php echo ($this->session->userdata("b2c_id")!='')?"submit":"button";?>" id="continue" class="btn btn-primary" >Continue</button>
							</div>
						</div>
						</form>
						<br>
					</div>
					<div role="tabpanel" class="tab-pane fade <?php echo ($this->uri->segment(3)!='' && $this->input->get('orderId')=='')?"active in":"";?>" id="payment-tab">
					<?php
					
					$view_data = array('amount' => base64_encode(array_sum($Totall)),'entranceCode'=>$this->uri->segment(3));
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

						<h3 class="h4 text-primary">Flight details</h3>
						<?php 
						foreach($cart_global as $key => $cid){
							list($module, $cid) = explode(',', $cid);

							if($module == 'FLIGHT'){
								$cart = $this->cart_model->getCartDataByModule($cid,$module)->row();
								$request = json_decode(base64_decode($cart->request));

								$flight_name=json_decode(base64_decode($cart->response));
								$first_seg = reset($flight_name->segments);
								
								if($request->type == 'R'){
								$onward_seg =count($flight_name->onward->segments)-1;
								$return_seg =count($flight_name->return->segments)-1;
									$Stops = $onward_seg;
							}else{
								$Stops = count($flight_name->segments)-1;
							}
							//echo '<pre>';print_r($onward_seg);
								if($request->type == 'O' || $request->type == 'R'){
									$originCity = $this->flight_model->get_airport_cityname($request->origin);
									$destinationCity = $this->flight_model->get_airport_cityname($request->destination);
									$origin = $request->origin;
									$destination = $request->destination;
									$adults=$request->ADT;
									$childs=$request->CHD;
									$infants=$request->INF;
									$total_passanger=$adults+$childs+$infants;
									$BasePrice[]= $cart->BasePrice;
									$TaxPrice[]= $cart->TaxPrice;
									$Totalprice[]= $cart->TotalPrice;
								}else if ($request->type == 'M') {
                //echo '<pre>';print_r($request);die;
									$origin = reset($request->origin);
									$destination = end($request->destination);
									$originCity = $this->flight_model->get_airport_cityname($origin);
									$destinationCity = $this->flight_model->get_airport_cityname($destination);
								}

							}

							?>


							<!-- booking details -->
							<div class="frow1">
								<div class="col-md-12 nopad tablshow">
									<div class="nopad fulwidmob">
										<div class="onwyrow">
											<div class="col-xs-6 col-md-2 nopad fulat500">
												<div class="flitsecimg">
													<img src="<?php echo $cart->AirImage;?>"  alt="IMAGE" class="img-responsive">
													<span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($first_seg->Carrier);?></span>
												</div>
											</div>
											<div class="col-xs-6 col-md-4">
												<br>
												<div class="radiobtn"><b><?php echo $originCity.' ('.$origin.')';?></div>
												<span class="norto"><small><?php echo date('d M, Y H:i', $cart->DepartureTime);?></small></span>
											</div>
											<div class="col-xs-6 col-md-4">
												<br>
												<span class="radiobtn"><?php echo $destinationCity.' ('.$destination.')';?></span>
												<span class="norto"><small><?php echo date('d M, Y H:i', $cart->ArrivalTime);?></small></span>
											</div>
											<div class="col-xs-6 col-md-2 nopad fulat500 text-center">
												<br>
												<div class="fatfi">
													<span class="norto lbold"><img src="<?php echo ASSETS;?>images/site/clk.png"> <?php echo $cart->duration;?></span>
													<span class="norto text-primary"><?php echo (($Stops>1)?$Stops." STOPS":(($Stops==0)?"NON STOP":$Stops." STOP"));?></span>
												</div>
											</div>
										</div>
									</div> 
								</div>
								<div class="clearfix"></div>
							</div><!-- booking details -->

							<?php } ?>


							<h3 class="h4 text-primary">Fare details</h3>
							<div class="clearfix">
								<div class="pull-left">
									<p class="text-primary">Base Price</p>
								</div>
								<div class="pull-right">
									<p><?php echo array_sum($BasePrice);?></p>
								</div>
							</div>
							<div class="clearfix">
								<div class="pull-left">
									<p class="text-primary">Tax Price</p>
								</div>
								<div class="pull-right">
									<p><?php echo array_sum($TaxPrice);?></p>
								</div>
							</div>
							<div class="clearfix">
								<div class="pull-left">
									<p class="text-primary h4"><b>Total Price</b></p>
								</div>
								<div class="pull-right">
									<p class="h4" style="color: #f77f00;"><b><?php echo array_sum($Totalprice);?></b></p>
								</div>
							</div>


<div class="panel panel-primary">
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
						
						</div>
					</div>
				</div>
			</div>
			
			<?php } ?>
		</div>
	</div>
<script>
	
	
$(document).ready(function(){
	
	


	$('input[type="radio"][name="login"]').on('click', function() {
		  $('#login2')[0].reset();
		    $('#login3')[0].reset();
		if($('#user-login').prop('checked')) {
			
			
					
					$('#continueguest :input').prop("disabled",true);
					$('#continuelogin :input').prop("disabled",false);
					
					
	$("#continuelogin").show();
	$("#continueguest").hide();
	}else{
					$(".popuperror").hide();
					$('#continueguest :input').prop("disabled",false);
					$('#continuelogin :input').prop("disabled",true);
					
					
					
	$("#continuelogin").hide();
	
	$("#continueguest").show();
	}
});
});
</script>

	<?php $this->load->view('common/footer');?>







