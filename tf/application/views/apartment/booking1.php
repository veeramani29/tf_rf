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
	.margin-null {
		margin: 0 !important;
	}
	.stepwizard-step p {
		margin-top: 10px;
	}
	.stepwizard-row {
		display: table-row;
	}
	.stepwizard {
		display: table;
		width: 100%;
		position: relative;
	}
	.stepwizard-step button[disabled] {
		opacity: 1 !important;
		filter: alpha(opacity=100) !important;
	}
	.stepwizard-row:before {
		top: 14px;
		bottom: 0;
		position: absolute;
		content: " ";
		width: 100%;
		height: 1px;
		background-color: #ccc;
		z-order: 0;

	}
	.btn-current{
		color:white !important;
		background:green !important;
	}
	.stepwizard-step {
		display: table-cell;
		text-align: center;
		position: relative;
	}
	.btn-circle {
		width: 30px;
		height: 30px;
		text-align: center;
		padding: 6px 0;
		font-size: 12px;
		line-height: 1.428571429;
		border-radius: 15px;
	}
</style>


<div style="margin:5% auto !important;background-color: #ffffff !important;" class="container">
	<div class="row">
		
		<div class="col-md-8">


			<?php 
			foreach($cart_global as $key => $cid){
				list($module, $cid) = explode(',', $cid);

				if($module == 'FLIGHT'){
					$cart = $this->cart_model->getCartDataByModule($cid,$module)->row();
					$request = json_decode(base64_decode($cart->request));

					$flight_name=json_decode(base64_decode($cart->response));
					$first_seg = reset($flight_name->segments);
					$Stops = count($flight_name->segments)-1;
            //echo '<pre>';print_r($cart);
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
						<div class="col-md-10 col-xs-10 nopad fulwidmob">
							<div class="onwyrow">
								<div class="col-md-2 col-xs-2 fulat500">
									<div class="flitsecimg">
										<img src="<?php echo $cart->AirImage;?>"  alt="IMAGE">
										<span class="nortosimle textcentr"><?php echo $this->flight_model->get_airline_name($first_seg->Carrier);?></span>
									</div>
								</div>
								<div class="col-md-7 col-xs-7 nopad fulat500">
									<div class="col-md-5 col-xs-5">
										<br>
										<div class="radiobtn"><b><?php echo $originCity.' ('.$origin.')';?></div>
										<span class="norto"><small><?php echo date('d M, Y H:i', $cart->DepartureTime);?></small></span>
									</div>
									<div class="col-md-2 col-xs-2 nopad">
										<br>
										<div class="flightimgs">
											<img src="<?php echo ASSETS;?>images/departure.png" alt="">
										</div>
									</div>
									<div class="col-md-5 col-xs-5">
										<br>
										<span class="radiobtn"><?php echo $destinationCity.' ('.$destination.')';?></span>
										<span class="norto"><small><?php echo date('d M, Y H:i', $cart->ArrivalTime);?></small></span>
									</div>
								</div>
								<div class="col-md-3 col-xs-3 nopad fulat500">
									<br>
									<div class="fatfi">
										<span class="norto lbold"><img src="<?php echo ASSETS;?>images/site/clk.png"> <?php echo $cart->duration;?></span>
										<span class="norto text-primary"><?php echo (($Stops>1)?$Stops." STOPS":(($Stops==0)?"NON STOP":$Stops." STOP"));?></span>
									</div>
								</div>
							</div>
						</div> 
						<div class="col-md-2 col-xs-2 nopad litblue white">
							<div class="pricefilt">
								<span class="nortocount">
									<span class="curr_icon">€</span>
									<span class="amount"><?php echo $cart->TotalPrice;?></span>
								</span>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>

				</div><!-- booking details -->

				<?php } ?>

				<div class="stepwizard">
					<div class="stepwizard-row setup-panel">
						<div class="stepwizard-step">
							<a href="#step-1" type="button" class="btn btn-default btn-current btn-circle" <?php echo ($this->session->userdata("user_type")!='')?"disabled":"";?>>1</a>
							<p>Login</p>
						</div>
						<div class="stepwizard-step">
							<a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
							<p>Billing Address</p>
						</div>
						<div class="stepwizard-step">
							<a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
							<p>Payment</p>
						</div>
					</div>
				</div>
				<form name="checkout-apartment" role="form" id="checkout-apartment"  autocomplete="off" action="<?php echo WEB_URL;?>/booking/checkout">
					<div class="row setup-content" id="step-1">
						<div class="col-xs-12">
							<div class="col-md-12">
								<h3> Please Login</h3>

								<?php  if($this->session->userdata("user_type")==''){ $this->load->view('login1'); }?>
								<div class="clearfix">
									<button class="btn btn-primary nextBtn pull-right" type="button" >Next</button>
								</div>
								<br>
							</div>
						</div>




					</div>
					<div class="row setup-content" id="step-2">
						<div class="col-xs-12">
							<?php if($Fcount > 0){   if($this->session->userdata("user_type")!=''){?>              
							<div class="sectionbuk"> 
								<button class="collapsebtn2 collapsed bukcolsp" data-target="#collapse102" data-toggle="collapse" type="button">
									<?php echo $this->lang->line('BP_F_Bookings'); ?> (<?php echo $Fcount;?>)
									<span class="collapsearrow"></span>
									<span class="editbuk"><?php echo $this->lang->line('BP_Edit'); ?></span>
								</button>  
								<div class="collapse" id="collapse102">
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
													<div class="col-md-6 form-group">
														<div class="paylabel"><?php echo $this->lang->line('BP_Fname'); ?></div>
														<input type="text" name="first_name<?php echo $cid;?>" class="form-control" value="<?php if($userInfo->billing_firstname != NULL){echo $userInfo->billing_firstname;}?>" required/>
													</div>  
													<div class="col-md-6 form-group">
														<div class="paylabel"><?php echo $this->lang->line('BP_Lname'); ?></div>
														<input type="text" name="last_name<?php echo $cid;?>" class="form-control" value="<?php if($userInfo->billing_lastname != NULL){echo $userInfo->billing_lastname;}?>" required/>
													</div>
												</div>
												<div class="payrow">
													<div class="col-md-6 form-group">
														<div class="paylabel"><?php echo $this->lang->line('BP_Email'); ?></div>
														<input type="text" name="email<?php echo $cid;?>" class="form-control" value="<?php if($userInfo->billing_email != NULL){echo $userInfo->billing_email;}?>" required/>
													</div>
													<div class="col-md-6 form-group">
														<div class="paylabel"><?php echo $this->lang->line('BP_Contact'); ?></div>
														<input type="text" name="mobile<?php echo $cid;?>" class="form-control" value="<?php if($userInfo->billing_contact != NULL){echo $userInfo->billing_contact;}?>" required/>
													</div>
												</div>
											</div>
											<?php $i++;}}?>       
										</div>

									</div> 
									<?php } }?> 


									<div class="col-md-6">
										<h3><?php echo $this->lang->line('BP_Billing_Address'); ?></h3>
										<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_Fname'); ?></label>
											<input  maxlength="100" type="text" required="required" name="first_name" value="<?php if($userInfo->billing_firstname != NULL){echo $userInfo->billing_firstname;} else {echo $userInfo->firstname;} ?>" class="form-control" placeholder="<?php echo $this->lang->line('BP_Fname'); ?>"  />
										</div>
										<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_Address1'); ?> </label>
											<input maxlength="100" type="text" name="street_address"  value="<?php if($userInfo->billing_addressA != NULL){echo $userInfo->billing_addressA;}?>" required="required" class="form-control" placeholder="<?php echo $this->lang->line('BP_Address1'); ?>" />
										</div>

										<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_Email'); ?> </label>
											<input maxlength="100" type="email" name="email" value="<?php if($email != NULL){echo $email;}?>"  required="required" class="form-control" placeholder="<?php echo $this->lang->line('BP_Email'); ?>" />
										</div>
										<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_Country'); ?> </label>
											<select class="form-control fpayinselect mySelectBoxClass hasCustomSelect" name="country" required>
												<?php foreach($countries as $country){?>
												<option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $userInfo->billing_country) ? "selected" : ""; ?> ><?php echo $country->name;?></option>
												<?php }?>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_City'); ?> </label>
											<input maxlength="100" type="text" required="required" name="city"  value="<?php if($userInfo->billing_city != NULL){echo $userInfo->billing_city;}?>" class="form-control" placeholder="<?php echo $this->lang->line('BP_City'); ?>" />
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_Lname'); ?></label>
											<input  maxlength="100" type="text" required="required" name="last_name"  value="<?php if($userInfo->billing_lastname != NULL){echo $userInfo->billing_lastname;} else {echo $userInfo->lastname;}?>"  class="form-control" placeholder="<?php echo $this->lang->line('BP_Lname'); ?>"  />
										</div>
										<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_Address2'); ?> </label>
											<input maxlength="100" type="text" name="address2"  required="required" value="<?php if($userInfo->billing_addressB != NULL){echo $userInfo->billing_addressB;}?>" class="form-control" placeholder="<?php echo $this->lang->line('BP_Address2'); ?>" />
										</div>
										<input type="hidden" name="cid" id="cid" value="<?php echo $cart_global_id;?>"/>
										<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_Contact'); ?></label>
											<input maxlength="100" type="text" name="mobile"  value="<?php if($userInfo->billing_contact != NULL){echo $userInfo->billing_contact;}?>" required="required" class="form-control" placeholder="<?php echo $this->lang->line('BP_Contact'); ?>" />
										</div>
										<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_State'); ?> </label>
											<input maxlength="100" type="text"  name="state"  value="<?php if($userInfo->billing_state != NULL){echo $userInfo->billing_state;}?>" required="required" class="form-control" placeholder="<?php echo $this->lang->line('BP_State'); ?>" />
										</div>
										<div class="form-group">
											<label class="control-label"> <?php echo $this->lang->line('BP_Postal'); ?> </label>
											<input maxlength="100" type="text" name="zip"  value="<?php if($userInfo->billing_postal != NULL){echo $userInfo->billing_postal;}?>" required="required" class="form-control" placeholder="<?php echo $this->lang->line('BP_Postal'); ?>" />
										</div>

									</div>
								</div>



								<button class="btn btn-primary nextBtn pull-right" type="button" >Next</button>

							</div>
							<div class="row setup-content" id="step-3">
								<div class="col-xs-12">
									<div class="col-md-12">
										<h3> Confirmation</h3>

										<div class="col-xs-12">

											<div class="form-group">
												<?php echo $this->lang->line('BP_Bookit'); ?>
											</div>
										</div>

										<div class="col-xs-12">

											<div class="form-group">
												<label for="confirm" class="checkbox-inline"><input type="checkbox" id="confirm" name="confirm" class="checkleft" required="" aria-required="true"> <?php echo $this->lang->line('BP_Bookit1'); ?><a class="colorbl"><?php echo $this->lang->line('BP_Terms_Of_Service'); ?></a>, <a class="colorbl"><?php echo $this->lang->line('BP_Cancellation_Policy'); ?></a> <?php echo $this->lang->line('BP_And'); ?> <a class="colorbl"><?php echo $this->lang->line('BP_Guest_Policy'); ?></a>.</label>
											</div>
										</div>

										<input type="hidden" id="total_payable" name="total" value="<?php echo base64_encode(array_sum($Total)); ?>"/>
										<input type="hidden" id="pcode" name="code" value="<?php echo base64_encode('fool'); ?>"/>

										<button class="btn btn-success btn-lg pull-right" id="continue" type="submit" disabled><?php echo $this->lang->line('BP_Continue'); ?></button>
									</div>

								</div>

							</div>
							
						</form>




					</div>

					<div class="col-md-4">
						<br>
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h3 class="panel-title">Fare details</h3>
							</div>
							<div class="panel-body">
								<table class="table table-hover table-consdensed table-striped margin-null">
									<tbody>
										<tr>
											<td><b>Base Price</b></td>
											<td><?php echo array_sum($BasePrice);?></td>
										</tr>

										<tr>
											<td><b>Tax Price</b></td>
											<td><?php echo array_sum($TaxPrice);?></td>
										</tr>
										<tr>
											<td><b>Total Price</b></td>
											<td><?php echo array_sum($Totalprice);?></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h3 class="panel-title"><?php echo $this->lang->line('BP_Promo'); ?></h3>
							</div>

							<div class="clear"></div>
							<div class="panel-body">
								<form id="promocode" name="promocode" action="<?php echo WEB_URL;?>/booking/promo">
									<div class="col-md-8 col-xs-8">
										<div class="cartprc">
											<input type="hidden" name="total" value="<?php echo base64_encode(array_sum($Totall)); ?>">
											<input type="hidden" name="cid" id="cid" value="<?php echo $cart_global_id;?>"/>
											<div class="payblnhm singecartpricebuk ritaln">
												<input type="text" class="promocode" id="code" name="code" placeholder="<?php echo $this->lang->line('BP_Enter_Promo'); ?>" required/>
											</div>
										</div>
									</div>
									<div class="col-md-4 col-xs-4">
										<input type="submit" class="promosubmit" name="apply" value="<?php echo $this->lang->line('BP_Apply'); ?>" />
									</div>
								</form> 
							</div>
							<div class="clear"></div>
							<div class="savemessage"></div>

						</div>


	<!--<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Passenger details</h3>
		</div>
		<div class="panel-body">
			<table class="table table-hover table-consdensed table-striped margin-null">
				<tbody>
					<tr>
						<td><b>Adults</b></td>
						<td><?php echo $adults;?></td>
					</tr>
					
					<tr>
						<td><b>Childs</b></td>
						<td><?php echo $childs;?></td>
					</tr>
					<tr>
						<td><b>Infants</b></td>
						<td><?php echo $infants;?></td>
					</tr>
					
					<tr>
						<td><b>Total Passenger</b></td>
						<td><?php echo $total_passanger;?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>-->
</div>

</div>

</div>







<script>
	$(document).ready(function () {
		var session='<?php echo $this->session->userdata("b2c_id");?>';

		var navListItems = $('div.setup-panel div a'),
		allWells = $('.setup-content'),
		allNextBtn = $('.nextBtn');

		allWells.hide();

		navListItems.click(function (e) {

			e.preventDefault();
			var $target = $($(this).attr('href')),
			$item = $(this);
			var $click=$(this).attr('href');

			if (!$item.hasClass('disabled')) {
				navListItems.removeClass('btn-current').addClass('btn-default');
				$item.addClass('btn-current');
				allWells.hide();
				$target.show();
				$target.find('input:eq(0)').focus();
			}
		});

		allNextBtn.click(function(){
			$('div.lg_popuperror').html("");
			$('div.lg_popuperror').hide();
			var curStep = $(this).closest(".setup-content"),
			curStepBtn = curStep.attr("id"),
			nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
			curInputs = curStep.find("input[type='text'],select,input[type='password'],input[type='email'],input[type='tel'],input[type='url']"),
			isValid = true;

			$(".form-group").removeClass("has-error");
			for(var i=0; i<curInputs.length; i++){
				if (!curInputs[i].validity.valid){
					isValid = false;
					$(curInputs[i]).closest(".form-group").addClass("has-error");
				}
			}
									//alert(isValid);
									if(isValid==true && curStepBtn=="step-1"){

										var email=$("#plemail").val();
										if($("#plpassword").prop("disabled",false) && $("#plpassword").val()!=''){
											var pss=$("#plpassword").val();
										}else if($("#plpassword").val()=='undefined'){
											var pas='';
										}else{
											var pas='';
										}
										
										if($("#plphoneno").val()!=''){
											var phoneno=$("#plphoneno").val();
										}else{
											var phoneno='';
										}

										

										if(pss!='' && email!='' && phoneno=='') {
											if(pas!='undefined' && pss!=''){
												var action ='<?php echo WEB_URL."/account/login";?>';
												$.ajax({
													type: "POST",
													url: action,
													data: {email:email,password:pss},
													dataType: "json",
													success: function(data){
													//alert(data);
													if(data.status == 1){

														doLogin(data);
														if (isValid){
															
															nextStepWizard.removeAttr('disabled').trigger('click');
															$('#plphoneno').prop("disabled",true);	
															var url = window.location.href; 
															window.location.replace(url);

														}
													} else if(data.status == 2) {
					var curUrl = document.URL; //encode to base64
					window.location.href = WEB_URL+'/security/verifytwostep?url='+curUrl;
				} else{
					
					$('div.lg_popuperror').html(data.msg);
					$('div.lg_popuperror').show();
					
				}
			}
		});


											}


										}else if(phoneno!='' && email!='' && isValid) {
											alert(0);
											nextStepWizard.removeAttr('disabled').trigger('click');
											$('#plpassword').prop("disabled",true);	
										}

									}else if(isValid)
									nextStepWizard.removeAttr('disabled').trigger('click');	

								});




if(session!=''){
	$("a[href=#step-1]").removeClass('btn-current').addClass('btn-default');
	$("a[href=#step-2]").removeClass('btn-default').addClass('btn-current');
	$("a[href=#step-2]").removeAttr("disabled");
	$("#step-1").hide();
	$("#step-2").show();
}

$('div.setup-panel div a.btn-current').trigger('click');
});







</script>

<script type="text/javascript">
	


	function inform(){
		$('#balancealert').provabPopup({
			modalClose: true, 
			zIndex: 10000005
		});
	}
	$(document).ready(function(){

		$('.houserules').click(function(){
			$('#houserules').provabPopup({
				modalClose: true, 
				zIndex: 10000005
			});
		});



		$(".infoside, .smalinfo").tooltip();
		$('#confirm').change(function() {
			if($(this).prop('checked') == true){
				$('#continue').removeAttr('disabled');
			}else{
				$('#continue').attr('disabled','disabled');
			}
		});
	});
</script>
<?php $this->load->view('common/footer');?>
</body>
</html>
