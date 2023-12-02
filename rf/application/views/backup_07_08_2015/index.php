<?php

$this->load->view('common/header');
$language = $this->session->userdata('language');

if($language){
	$this->lang->load('Home_Page_HM', $language);
}else{
	$this->lang->load('Home_Page_HM', 'english');
}


?>




<!--First section-->
<div class="relative">
	<div id="carousel-banner" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">
				<img src="<?php echo ASSETS;?>images/banner/banner.png" alt="flight page">
			</div>
			<div class="item ">
				<img src="<?php echo ASSETS;?>images/banner/banner2.png" alt="flight page 2">
			</div>

		</div>
		<span class="shade"></span>
	</div>
	<div class="main-text">
		<div class="col-md-12 text-center">
			<div class="container">
				<h2 class="banner-title">Een <b> slimmere manier</b> om uw reis te plannen.</h2>
				<ul class="img-structure">
					<li><a href="#"><span class="banners1 bans1 active"></span></a></li>
					<li><a href="#"><span class="banners1 bans2"></span></a></li>
					<li><a href="#"><span class="banners1 bans3"></span></a></li>
					<!-- <li><a href="#"><span class="banners1 bans4"></span></a></li> -->
				</ul>
				<div id="date_hide" class="styled-select" style="margin-bottom:10px;">
					<ul class="nav nav-pills">
						<li class="dropdown active wayselection span8">
							<a class="dropdown-toggle" id="inp_impact" data-toggle="dropdown">
								<i class="icon icon-ok icon-white"></i>&nbsp;
								<span id="dropdown_title">Round trip</span>
								<span class="caret"></span>
							</a>

							<ul ID="divNewNotifications" class="dropdown-menu">
								<li><span class="city-drop-icon"></span></li>
								<li><a>Round trip</a></li>
								<li><a>One Way</a></li>
								<li><a>Multi-city</a></li>
							</ul>
						</li>
					</ul>


				</div>
				<form class="custom show-search-options position-left clearfix"  name="flight" id="flight" action="<?php echo WEB_URL;?>/flight/search" autocomplete="off">

					<input type="hidden" name="trip_type" id="trip_type" value="circle" />

					<div id="one-round">
						<div class="input-wrapper">

							<input type="text" class="flyinput fromflight form-control" required="" name="from" placeholder="From" aria-required="true" autocomplete="off" aria-invalid="false" />

							<div id="location_warn"></div>
						</div>
						<div class="input-wrapper">
							<input type="text" class="flyinput departflight form-control" placeholder="To" name="to" required="" aria-required="true" autocomplete="off">

						</div>
						<div id="checkoutWrapper" class="input-wrapper" for="dateto">
							<input type="text" name="depature" class="search_date calinput datea form-control" id="depature" placeholder="Depart"  aria-required="true" required=""  />
						</div>
						<div id="checkoutWrapper" class="input-wrapper" for="return">
							<input type="text" name="return" required="" aria-required="true" class="search_date datea calinput form-control" id="return" placeholder="Return"  />
						</div>

						<div class="input-wrapper">
							<select class="checkoutWrapper select-main form-control input-lg" id="class" name="class" required>
								<option value="Economy"><?php echo $this->lang->line('HM_S_Flights_class_e'); ?></option>
								<option value="PremiumEconomy"><?php echo $this->lang->line('HM_S_Flights_class_p'); ?></option>
								<option value="Business"><?php echo $this->lang->line('HM_S_Flights_class_b'); ?></option>
								<option value="First"><?php echo $this->lang->line('HM_S_Flights_class_f'); ?></option>
								<option value="PremiumFirst"><?php echo $this->lang->line('HM_S_Flights_class_pf'); ?></option>
							</select>
						</div>
						<div class="input-wrapper drop-eft">
							<input id="property" class="location drop1 form-control" type="text" placeholder="1" name="person_select" readonly autocomplete="off">
							<ul class="drop-spot">
								<!--<span class="pass-text">Passanger</span>-->
								<li><span class="arrow-icon"></span></li>
								<li>
									<ul>

										<li><span>Adults</span>
											<select name="adult" id="adult_count">
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
											</select>
										</li>
										<li class="divider1"></li>

										<li><span>Child (2-11 yr)   </span>
											<select name="child" id="child_count">
												<option value="0">0</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
											</select>
										</li>
										<li class="divider1"></li>

										<li><span>Infant (<2 yr)</span>
											<select name="infant" id="infant_count">
												<option value="0">0</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
											</select>
										</li>
										<li class="divider1"></li>
										<li style="color: green;">A child that turns 12 during the trip, will be billed as an adult</li>
									</ul>
								</li>
							</ul>

						</div>
						<div class="input-wrapper">
							<input id="" class="large pink btn icon-and-text position-left oneway-submit" name='flight_submit' type="submit" value="Search Flights">
						</div>

						<div class="input-wrapper">
							<label class="checkbox-inline">
								<input id="days"  name='days' type="checkbox" value="1"> Search 3 days before and after
							</label>
						</div>
					</div>


					<div id="multi_city_select" style="display: none;">
						<div id="paste_div">

							<div class="multi_city_0  multi-city" >
								<div class="input-wrapper">
									<input type="text" required="" id="from1" name="mfrom[0]" placeholder="From" class="flyinput fromflight form-control" aria-required="true" autocomplete="off" aria-invalid="false">

								</div>
								<div class="input-wrapper">
									<input type="text" required="" id="to1" name="mto[0]" placeholder="To" class="flyinput departflight form-control" aria-required="true" autocomplete="off" aria-invalid="false">

								</div>

								<div class="input-wrapper">
									<input type="text" required="" id="depature1" name="mdepature[0]" placeholder="Depart" class="flyinput multi_city_selector search_date form-control" aria-required="true">


								</div>


							</div>

							<div class="multi_city_1  multi-city" >
								<div class="input-wrapper">
									<input type="text" required="" id="from2" name="mfrom[1]" placeholder="From" class="flyinput fromflight form-control" aria-required="true" autocomplete="off" aria-invalid="false">

								</div>
								<div class="input-wrapper">
									<input type="text" required="" id="to2" name="mto[1]" placeholder="To" class="flyinput fromflight form-control" aria-required="true" autocomplete="off" aria-invalid="false">

								</div>

								<div class="input-wrapper">
									<input type="text" required="" id="depature2" name="mdepature[1]" placeholder="Depart" class="flyinput multi_city_selector search_date form-control" aria-required="true">


								</div>
								<ul>
									<li id="remove_multi_1" style="display:none" ><a class="minus-button" href="javascript:void(0)" style="margin-top:2px"></a></li>
									<li id="add_multi_1" ><a class="plus-button" href="javascript:void(0)"></a></li>
								</ul>

							</div>

							<div class="multi_city_2  multi-city" style="display:none">
								<div class="input-wrapper">
									<input type="text" required="" id="from3" name="mfrom[2]" placeholder="From" class="flyinput fromflight form-control" aria-required="true" autocomplete="off" aria-invalid="false">

								</div>
								<div class="input-wrapper">
									<input type="text" required="" id="to3" name="mto[2]" placeholder="To" class="flyinput fromflight form-control" aria-required="true" autocomplete="off" aria-invalid="false">

								</div>

								<div class="input-wrapper">
									<input type="text" required="" id="depature3" name="mdepature[2]" placeholder="Depart" class="flyinput multi_city_selector search_date form-control" aria-required="true">


								</div>
								<ul>
									<li id="remove_multi_2" style="display:none" ><a class="minus-button" href="javascript:void(0)" style="margin-top:2px"></a></li>
									<li id="add_multi_2" ><a class="plus-button" href="javascript:void(0)"></a></li>
								</ul>

							</div>

							<div class="multi_city_3  multi-city" style="display:none">
								<div class="input-wrapper">
									<input type="text" required="" id="from4" name="mfrom[3]" placeholder="From" class="flyinput fromflight form-control" aria-required="true" autocomplete="off" aria-invalid="false">

								</div>
								<div class="input-wrapper">
									<input type="text" required="" id="to4" name="mto[3]" placeholder="To" class="flyinput fromflight form-control" aria-required="true" autocomplete="off" aria-invalid="false">

								</div>

								<div class="input-wrapper">
									<input type="text" required="" id="depature4" name="mdepature[3]" placeholder="Depart" class="flyinput multi_city_selector search_date form-control" aria-required="true">


								</div>
								<ul>
									<li id="remove_multi_3" style="display:none" ><a class="minus-button" href="javascript:void(0)" style="margin-top:2px"></a></li>
									<li id="add_multi_3" ><a class="plus-button" href="javascript:void(0)"></a></li>
								</ul>

							</div>

									<!-- multicity some features -->
									<div class="multi-city">
										<div class="input-wrapper">
											<select class="checkoutWrapper select-main form-control input-lg" id="class" name="class" required>
												<option value="Economy"><?php echo $this->lang->line('HM_S_Flights_class_e'); ?></option>
												<option value="PremiumEconomy"><?php echo $this->lang->line('HM_S_Flights_class_p'); ?></option>
												<option value="Business"><?php echo $this->lang->line('HM_S_Flights_class_b'); ?></option>
												<option value="First"><?php echo $this->lang->line('HM_S_Flights_class_f'); ?></option>
												<option value="PremiumFirst"><?php echo $this->lang->line('HM_S_Flights_class_pf'); ?></option>
											</select>
										</div>
										<div class="input-wrapper drop-eft">
											<input id="property1" class="location drop1 form-control" type="text" placeholder="1" name="person_select" readonly autocomplete="off">
											<ul class="drop-spot">
												<!--<span class="pass-text">Passanger</span>-->
												<li><span class="arrow-icon"></span></li>
												<li>
													<ul>

														<li><span>Adults</span>
															<select name="adult" id="adult_count1">
																<option value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
																<option value="6">6</option>
																<option value="7">7</option>
																<option value="8">8</option>
																<option value="9">9</option>
															</select>
														</li>
														<li class="divider1"></li>
														<li><span>Child (2-11 yr)   </span>
															<select name="child" id="child_count1">
																<option value="0">0</option>
																<option value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
																<option value="6">6</option>
																<option value="7">7</option>
																<option value="8">8</option>
																<option value="9">9</option>
															</select>
														</li>
														<li class="divider1"></li>
														<li><span>Infant (<2 yr)</span>
															<select name="infant" id="infant_count1">
																<option value="0">0</option>
																<option value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
																<option value="6">6</option>
																<option value="7">7</option>
																<option value="8">8</option>
																<option value="9">9</option>
															</select>
														</li>
														<li class="divider1"></li>
														<li style="color: green;">A child that turns 12 during the trip, will be billed as an adult</li>
													</ul>
												</li>
											</ul>

										</div>

										<div class="input-wrapper">
											<input id="" class="large pink btn icon-and-text position-left oneway-submit" name='flight_submit' type="submit" value="Search Flights">
										</div>

									</div>
									<!-- end multicity some features -->


								</div>
							</form>
						</div>
					</div>
				</div>

			</div>
			<!--End of first section-->

			<div class="clear"></div>

			<!-- temp code -->
			<div class="section-top hidden-xs">
				<div class="main">
					<div class="row clearfix section1">
						<div class="col-md-12 column">
							<div class="row clearfix">
								<div class="col-md-12 column">
									<h1 class="text-center cnter-title">VLIEGTICKET AANBIEDINGEN</h1>
									<p class="sub-stutl">This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. </p>
								</div>
							</div>
							<div class="row clearfix"><div class="col-md-12 column"></div></div>
							<div class="row clearfix"><div class="col-md-6 column"><div class="row clearfix"><div class="col-md-6 column"></div><div class="col-md-6 column"></div></div><div class="row clearfix"><div class="col-md-6 column"></div><div class="col-md-6 column"></div></div></div><div class="col-md-6 column"></div></div></div></div>
							<div class="col-md-12">
								<?php  
									$discounted_flights=$discounted_flights;
								  $totdiscflight=count($discounted_flights); if($totdiscflight>0){   if($totdiscflight>1){ ?>
								<div style="margin:0; padding:0" class="col-md-6">
									<?php $totflight=$totdiscflight-1; for($df=1;$df<=$totflight;$df++){  
										$disc_origin=stripslashes($discounted_flights[$df]['origin']);
										$disc_origin_city=$this->flight_model->get_airport_cityname($disc_origin);
										$disc_destination=stripslashes($discounted_flights[$df]['destination']);
										$disc_destination_city=$this->flight_model->get_airport_cityname($disc_destination);
										$disc_destination_country=$this->flight_model->get_airport_countryname($disc_destination);
										$disc_price=stripslashes($discounted_flights[$df]['price']);
										$disc_trip=($discounted_flights[$df]['type']=="R")?"Round Trip":"One Way";
										$disc_trip_class=($discounted_flights[$df]['type']=="R")?"set3":"";
										$disc_each_url=base_url().'flight/discounted_flight/'.$discounted_flights[$df]['id'];
										$now = time(); 
										 $exp_date = strtotime($discounted_flights[$df]['exp_date']);
										 $datediff =$exp_date-$now;
										 $remain_day= floor($datediff/(60*60*24))+1;
										$discount_img=DISCOUNT_FLIGHT_SMLIMG.$discounted_flights[$df]['small_image'];
									if($df%2==1){
										echo '<div class="col-md-6">';
										}?>
										
										<div class="row">
											<div class="col-md-12 pad0">
												<div class="tour1 tours padin-botom">
													<a class="img-wd" href="<?php echo $disc_each_url;?>">  <img class="relative img1 img-responsive center-block" src="<?php echo ($discount_img!='')?$discount_img:ASSETS."images/site/img1.png";?>" /></a>
													<span class="contry-titl hid">
														<label class="place1"><?php echo $disc_destination_city;?>,</label>
														<label class="place2"> <?php echo $disc_destination_country;?></label>
													</span>
													<span class="contry-titl disp">
														<p class="city-tils">Nog dagen te boeken:</p>
														<label class="city-nums"><?php echo $remain_day;?></label>
														<a class="city-link" href="<?php echo $disc_each_url;?>">BEKIJK DE AANBIEDINGEN</a>
													</span>
													<div class="content-title">
														<div class="bottom-containers">
															<div class="bottom-container-left">
																<h3 class="place-title"><label class="ico-set set2"></label><?php echo $disc_origin_city;?> - <?php echo $disc_destination_city;?></h3>
																<a href="<?php echo $disc_each_url;?>" class="reticket"><label class="ico-set <?php echo $disc_trip_class;?>"></label><?php echo $disc_trip;?></a> <a href="<?php echo $disc_each_url;?>" class="dater"><label class="ico-set set4"></label> Aug, Sep</a>
															</div>
															<div class="bottom-container-right">
																<span class="price-amount"><?php echo CURR_ICON.$disc_price;?></span>
															</div>
														</div>
													</div>
												</div>
											</div>
											</div>
										
										<?php if($df%2==0){
										echo '</div>';
										}?>
										
										<?php } ?>
								</div>
									</div>
					<?php } ?>
					
					<div style="padding:0 " class="<?php echo ($totdiscflight==1)?"col-md-12":"col-md-6";?> right-bans">
						<div class="col-md-12">
							<div class="tour1 tours">
								<?php
										$disc_origin=stripslashes($discounted_flights[0]['origin']);
										$disc_origin_city=$this->flight_model->get_airport_cityname($disc_origin);
										$disc_destination=stripslashes($discounted_flights[0]['destination']);
										$disc_destination_city=$this->flight_model->get_airport_cityname($disc_destination);
										$disc_destination_country=$this->flight_model->get_airport_countryname($disc_destination);
										$disc_price=stripslashes($discounted_flights[0]['price']);
										$disc_trip=($discounted_flights[0]['type']=="R")?"Round Trip":"One Way";
										$disc_trip_class=($discounted_flights[0]['type']=="R")?"set3":"";
										$disc_each_url=base_url().'flight/discounted_flight/'.$discounted_flights[0]['id'];
										$now = time(); 
										$exp_date = strtotime($discounted_flights[0]['exp_date']);
										 $datediff =$exp_date-$now;
										$remain_day= floor($datediff/(60*60*24))+1;
										$discount_img=DISCOUNT_FLIGHT_SMLIMG.$discounted_flights[0]['small_image'];
										?>
								<a class="img-wd2" href="<?php echo $disc_each_url;?>"><img class="relative img1 img-responsive center-block" src="<?php echo ($discount_img!='')?$discount_img:ASSETS."images/site/img1.png";?>" /></a>
								<span class="contry-titl"><P class="city-tils">Nog dagen te boeken:</P><label class="city-nums"><?php echo $remain_day;?></label><a class="city-link" href="<?php echo $disc_each_url;?>">BEKIJK DE AANBIEDINGEN</a></span>
								<div class="content-title">
									<div class="bottom-containers">
										<div class="bottom-container-left">
											<h3 class="place-title"><label class="ico-set set2"></label><?php echo $disc_origin_city;?> - <?php echo $disc_destination_city;?></h3>
											<a href="<?php echo $disc_each_url;?>" class="reticket"><label class="ico-set <?php echo $disc_trip_class;?>"></label><?php echo $disc_trip;?></a> <a href="<?php echo $disc_each_url;?>" class="dater"><label class="ico-set set4"></label> Aug, Sep</a>
										</div>
										<div class="bottom-container-right">
											<span class="price-amount"><?php echo CURR_ICON.$disc_price;?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<?php } ?>
				</div>
			</div>
		</div>
		<!--End of second section-->
		<!--Third secttion-->
		<div class="row clearfix section2 bg-white">
			<div class="main">
				<div class="col-md-12 column">
					<h1 class="text-center cnter-title">CITY GUIDES</h1>
					<p class="sub-stutl">This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. </p>
				</div>
				<div class="row clearfix">
					<div class="col-md-12 column">
						<div class="row">
							<div class="col-md-12">
								<div id="Carousel" class="carousel slide">
									<div class="carousel-inner">
										<div class="item active">
											<div class="row">
												<div class="col-md-3 col-sm-6 col-xs-12"><a href="#" class="thumbnail"><img src="<?php echo ASSETS;?>images/city/ph1.png" alt="ITALY" class="img-responsive center-block"><div class="hover-waper"><span class="main-country">ITALY</span> <span class="main-place">ROME</span></div></a></div>
												<div class="col-md-3 col-sm-6 col-xs-12"><a href="#" class="thumbnail"><img src="<?php echo ASSETS;?>images/city/ph2.png" alt="NEUZIL" class="img-responsive center-block"><div class="hover-waper"><span class="main-country">NEUZIL</span> <span class="main-place">NEW YORK</span></div></a></div>
												<div class="col-md-3 col-sm-6 col-xs-12"><a href="#" class="thumbnail"><img src="<?php echo ASSETS;?>images/city/ph3.png" alt="NEW YORK" class="img-responsive center-block"><div class="hover-waper"><span class="main-country">NEW YORK</span> <span class="main-place">USA</span></div></a></div>
												<div class="col-md-3 col-sm-6 col-xs-12"><a href="#" class="thumbnail"><img src="<?php echo ASSETS;?>images/city/ph42.png" alt="DELHI" class="img-responsive center-block"><div class="hover-waper"><span class="main-country">DELHI</span> <span class="main-place">AGRA</span></div></a></div>
											</div>
										</div>
										<div class="item ">
											<div class="row">
												<div class="col-md-3 col-sm-6 col-xs-12"><a href="#" class="thumbnail"><img src="<?php echo ASSETS;?>images/city/ph41.png" alt="DELHI" class="img-responsive center-block"><div class="hover-waper"><span class="main-country">DELHI</span> <span class="main-place">INDIA</span></div></a></div>
												<div class="col-md-3 col-sm-6 col-xs-12"><a href="#" class="thumbnail"><img src="<?php echo ASSETS;?>images/city/ph11.png" alt="ITALY" class="img-responsive center-block"><div class="hover-waper"><span class="main-country">ITALY</span> <span class="main-place">ROME</span></div></a></div>
												<div class="col-md-3 col-sm-6 col-xs-12"><a href="#" class="thumbnail"><img src="<?php echo ASSETS;?>images/city/ph21.png" alt="NEUZIL" class="img-responsive center-block"><div class="hover-waper"><span class="main-country">NEUZIL</span> <span class="main-place">NEW YORK</span></div></a></div>
												<div class="col-md-3 col-sm-6 col-xs-12"><a href="#" class="thumbnail"><img src="<?php echo ASSETS;?>images/city/ph33.png" alt="NEW YORK" class="img-responsive center-block"><div class="hover-waper"><span class="main-country">NEW YORK</span> <span class="main-place">USA</span></div></a></div>
											</div>
										</div>
									</div>
									<a data-slide="prev" href="#Carousel" class="left carousel-control"></a>
									<a data-slide="next" href="#Carousel" class="right carousel-control"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--End of third section-->
		<!--Fourth section-->
		<div class="row clearfix section3">
			<div class="main">
				<div class="col-md-4 column hotel-last1">
					<h3 class="hotel-title">LAST MINUTE  HOTELS</h3>
					<ul class="last-hotl-area">
						<li>
							<div class="last-h1"><img src="<?php echo ASSETS;?>images/site/cmp1.png" /></div>
							<div class="last-h2">
								<h3 class="hotel-name">Hilton Hotel</h3>
								<p class="hotel-place">Athens, Greece</p>
								<span class="restarants">35 resterende minuten</span>
							</div>
							<div class="last-h3">
								<span class="price-tag"><label class="glyphicon glyphicon-euro"></label>85 <sub>p/n</sub></span>
								<a href="#" class="shop-title">KIES</a>
							</div>
						</li>
						<li>
							<div class="last-h1"><img src="<?php echo ASSETS;?>images/site/cmp1.png" /></div>
							<div class="last-h2">
								<h3 class="hotel-name">Hilton Hotel</h3>
								<p class="hotel-place">Athens, Greece</p>
								<span class="restarants">35 resterende minuten</span>
							</div>
							<div class="last-h3">
								<span class="price-tag"> <label class="glyphicon glyphicon-euro"></label>85 <sub>p/n</sub></span>
								<a href="#"  class="shop-title">KIES</a>
							</div>
						</li>
						<li>
							<div class="last-h1"><img src="<?php echo ASSETS;?>images/site/cmp1.png" /></div>
							<div class="last-h2">
								<h3 class="hotel-name">Hilton Hotel</h3>
								<p class="hotel-place">Athens, Greece</p>
								<span class="restarants">35 resterende minuten</span>
							</div>
							<div class="last-h3">
								<span class="price-tag"><label class="glyphicon glyphicon-euro"></label>85 <sub>p/n</sub></span>
								<a href="#"  class="shop-title">KIES</a>
							</div>
						</li>
					</ul>
				</div>
				<div class="col-md-4 column hotel-last1">
					<h3 class="hotel-title">WAAROM ONS?</h3>
					<ul class="last-hotl-area">
						<li>
							<div class="last-h1 pad3"><span class="ico-set2 set1"></span></div>
							<div class="last-h4">
								<h3 class="hotel-titles">Meer dan 1 miljoen reismogelijkheden</h3>
								<p class="hotel-desc">Nulla congue at lacus vitae vestibulum. Donec lorem felis, eleifend eget consequat quis.</p>
							</div>
						</li>
						<li>
							<div class="last-h1 pad3"><span class="ico-set2 set2"></span></div>
							<div class="last-h4">
								<h3 class="hotel-titles">Meer dan 1 miljoen reismogelijkheden</h3>
								<p class="hotel-desc">Nulla congue at lacus vitae vestibulum. Donec lorem felis, eleifend eget consequat quis.</p>
							</div>
						</li>
						<li>
							<div class="last-h1 pad3"><span class="ico-set2 set3"></span></div>
							<div class="last-h4">
								<h3 class="hotel-titles">Meer dan 1 miljoen reismogelijkheden</h3>
								<p class="hotel-desc">Nulla congue at lacus vitae vestibulum. Donec lorem felis, eleifend eget consequat quis.</p>
							</div>
						</li>
					</ul>
				</div>
				<div class="col-md-4 column hotel-last1">
					<h3 class="hotel-title">LAST MINUTE  HOTELS</h3>
					<ul class="last-hotl-area new-places">
						<div class="top-title">
							<span class="count-title">aanbevolen voor u!</span>
							<span class="count-title2">Auto verhuur v.a. €35.99</span>
						</div>
						<li>
							<div class="tour1 tours padin-botom"><img class="relative img1 img-responsive" src="<?php echo ASSETS;?>images/site/cr1.png">
								<span style=" padding: 0 15px;    position: absolute;    top: 12px;    width: 60%;" class="contry-titl">
									<label style="color:#fff" class="place1">Elite</label>
									<label style="float:left; width:100%; color:#FC0" class="place2"> Fiat 500,</label>
								</span>
							</div>
						</li>
						<li>
							<div class="tour1 tours padin-botom">
								<img class="relative img1 img-responsive" src="<?php echo ASSETS;?>images/site/cr2.png">
								<span style=" padding: 0 15px;    position: absolute;    top: 12px;    width: 60%;" class="contry-titl">
									<label style="color:#fff" class="place1">Mini</label>
									<label style="float:left; width:100%; color:#FC0" class="place2"> Fiat 500,</label>
								</span>
							</div>
						</li>
						<li>
							<div class="tour1 tours padin-botom">
								<img class="relative img1 img-responsive" src="<?php echo ASSETS;?>images/site/cr3.png">
								<span style=" padding: 0 15px;    position: absolute;    top: 12px;    width: 60%;"class="contry-titl">
									<label style="color:#fff" class="place1">Elite</label>
									<label style="float:left; width:100%; color:#FC0" class="place2"> Fiat 500,</label>
								</span>
							</div>
						</li>
						<li>
							<div class="tour1 tours padin-botom">
								<img class="relative img1 img-responsive" src="<?php echo ASSETS;?>images/site/cr4.png">
								<span style=" padding: 0 15px;    position: absolute;    top: 12px;    width: 60%;" class="contry-titl">
									<label style="color:#fff" class="place1">Luxury</label>
									<label style="float:left; width:100%; color:#FC0" class="place2"> Fiat 500,</label>
								</span>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!--End Fourth section-->
		<!--Fifth section-->
		<div class="row clearfix section4">
			<div class="main">
				<div class="col-md-7 col-sm-12 col-xs-12 column">
					<p class="last-content">Blijf op de hoogte met de laatste aanbiedingen van ons. Verzenden wij ook speciale promo codes van tijd tot tijd.</p>
				</div>

				<?php
				$language = $this->session->userdata('language');
				if($language){ $this->lang->load('Footer_F', $language); }else{ $this->lang->load('Footer_F', 'english');  }
				?>

				<div style="padding: 20px 0px 0px;" class="col-md-5 col-sm-12 col-xs-12 column">
					<form id="usrSub" action="<?php echo WEB_URL.'/users/subscribeUser'; ?>">


						<div class="col-md-7 col-sm-7 col-xs-7 column">
							<input type="email" class="emai-text" id="usrSubEmail" placeholder="<?php echo $this->lang->line('F_L_Email'); ?>" required>
							<span class="succNewsLetterSubsc" style="font-size: 13px; color: green; display: none;"><?php echo $this->lang->line('F_N_Thanku'); ?></span>
							<span class="failNewsLetterSubsc" style="font-size: 13px; color: blue; display: none;"><?php echo $this->lang->line('F_N_Error'); ?></span>
						</div>
						<div class="col-md-5 col-sm-5 col-xs-5 column">

							<input class="sbt-btn" id="subscribeUser" name="usrSubscId" type="submit" placeholder="Meld je aan" value="<?php echo $this->lang->line('F_Submit'); ?>" />
						</div>
					</form>
				</div>
			</div>
		</div>
		<!--End of fifth section-->


		<?php  $this->load->view('common/index_footer');?>

		<script>
			$(document).ready(function(){


				$("#onLoad").click(function(){
					$('#onLoad').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});

			});

			$(document).ready(function(){


				jQuery("#depature1").datepicker({
					minDate: 0,
					dateFormat: 'dd/mm/yy',
					maxDate: "+1y",
					numberOfMonths:2,
					onClose: function( selectedDate ) {
						$( "#depature2" ).datepicker( "option", "minDate", selectedDate );


					}
				});

				jQuery("#depature2").datepicker({
					minDate: 0,
					dateFormat: 'dd/mm/yy',
					maxDate: "+1y",
					numberOfMonths:2,
					onClose: function( selectedDate ) {
						$( "#depature1" ).datepicker( "option", "maxDate", selectedDate );
						$( "#depature3" ).datepicker( "option", "minDate", selectedDate );


					}
				});

				jQuery("#depature3").datepicker({
					minDate: 0,
					dateFormat: 'dd/mm/yy',
					maxDate: "+1y",
					numberOfMonths:2,
					onClose: function( selectedDate ) {
						$( "#depature2" ).datepicker( "option", "maxDate", selectedDate );
						$( "#depature4" ).datepicker( "option", "minDate", selectedDate );


					}
				});

				jQuery("#depature4").datepicker({
					minDate: 0,
					dateFormat: 'dd/mm/yy',
					maxDate: "+1y",
					numberOfMonths:2,
					onClose: function( selectedDate ) {
						$( "#depature3" ).datepicker( "option", "maxDate", selectedDate );


					}
				});







				$('#multi_city_select').hide();

			});


</script>
<script>
	$('.dropdown-toggle').dropdown();

	$("div.multi-city select").prop("disabled", true);
	$('#divNewNotifications li').on('click', function() {
		$('#dropdown_title').html($(this).find('a').html());
		//$('#flight')[0].reset();
		$('label.error').html("");

		if($(this).find('a').html() == "One Way"){
			$('#trip_type').val("oneway");
			$('#multi_city_select').hide();
			$("#one-round").show();
			$("div#one-round :input").prop("disabled", false);
			$('#return').prop('disabled',true);

		}else if($(this).find('a').html() == 'Round trip'){
			$('#trip_type').val("circle");
			$('#multi_city_select').hide();
			$("#one-round").show();
			$('#return').prop('disabled',false);
			$("div#one-round :input").prop("disabled", false);

		}else{
			//$('#flight')[0].reset();
			$('#trip_type').val("multicity");
			$("div#one-round :input").prop("disabled", true);
			$("div.multi-city select").prop("disabled", false);

			var arr_hide = new Array();
			for(i = 2; i < 4; i++){
				arr_hide.push('.multi_city_'+i);
				$('.multi_city_'+i+' input[type="text"]').val('');
				if(i<3){
					$('#remove_multi_'+i).hide();
					$('#add_multi_'+i).show();
				}else{
					$('#remove_multi_'+i).show();
					$('#add_multi_'+i).hide();
				}
			}
			$('.multi_city_0 input[type="text"]').val('');
			$('#remove_multi_1').hide();
			$('#add_multi_1').show();

			$(''+arr_hide).hide();
			$("#one-round").hide();
			$('#multi_city_select').show();
		}
		//$('#return').val('');
		//$('#depature').val('');
		$('.dropdown.open').removeClass('open');
		$('.dropdown-menu').hide();
	});
$('.wayselection').mouseover(function(){
	$('.dropdown-menu').show();
});
</script>





<script>
	$( document ).ready(function() {
		var passenger_count = parseInt($('#infant_count').val()) + parseInt($('#child_count').val()) + parseInt($('#adult_count').val());
		$('#property').val(passenger_count);
	});
	$('#adult_count').on('change',function(){

		var adult_count = parseInt($('#infant_count').val()) + parseInt($('#child_count').val()) + parseInt($('#adult_count').val());

		$('#property').val(adult_count);
	});
	$('#child_count').on('change',function(){
		var child_count = parseInt($('#infant_count').val()) + parseInt($('#child_count').val()) + parseInt($('#adult_count').val());
		$('#property').val(child_count);
	});
	$('#infant_count').on('change',function(){
		var infant_count = parseInt($('#infant_count').val()) + parseInt($('#child_count').val()) + parseInt($('#adult_count').val());
		$('#property').val(infant_count);
	});

	$( document ).ready(function() {
		var passenger_count = parseInt($('#infant_count1').val()) + parseInt($('#child_count1').val()) + parseInt($('#adult_count1').val());
		$('#property1').val(passenger_count);
	});
	$('#adult_count1').on('change',function(){

		var adult_count = parseInt($('#infant_count1').val()) + parseInt($('#child_count1').val()) + parseInt($('#adult_count1').val());

		$('#property1').val(adult_count);
	});
	$('#child_count1').on('change',function(){
		var child_count = parseInt($('#infant_count1').val()) + parseInt($('#child_count1').val()) + parseInt($('#adult_count1').val());
		$('#property1').val(child_count);
	});
	$('#infant_count1').on('change',function(){
		var infant_count = parseInt($('#infant_count1').val()) + parseInt($('#child_count1').val()) + parseInt($('#adult_count1').val());
		$('#property1').val(infant_count);
	});
</script>

<script>

	var num_inc = 1;

	var add = new Array();
	var remove = new Array();
	for(i = 1; i <4; i++){
		var k=i+1;
		add.push('#add_multi_'+i);
		if(k<4)
			remove.push('#remove_multi_'+k);
	}

	$(""+add).on('click',function(){

		var cur_id = (this.id).slice(-1);

		next_id = parseInt(cur_id) + 1;

		if(next_id < 4){
			$('.multi_city_'+next_id).show();
			$('#remove_multi_'+cur_id).show();
			$(this).hide();
		}else{
			for(i=cur_id;i>=0;i--){
				if(!$('.multi_city_'+i).is(':visible')){
					$('.multi_city_'+i).show();
					$('.multi_city_'+i+' input[type="text"]').val('');
					break;
				}
			}
		}
	});
	$(""+remove).on('click',function(){
		var cur_id = (this.id).slice(-1);
		if(cur_id==2){
			$('#remove_multi_1').hide();
			$('#add_multi_1').show();
		}
		if(cur_id != 0){
			next_id = parseInt(cur_id) + 1;
		}
		if(next_id >= 0){
			$('.multi_city_'+cur_id).hide();
		}
	});



</script>
<!-- end temp js code -->
</body>
</html>
<script type="text/javascript">
	function createPagination() {}
	function createListingPagination() {}
	function createReservationHistoryPagination() {}
	function BookingPagination() {}
	function createRvwPagination() {}
	function createRefByYouPagination() {}
</script>

