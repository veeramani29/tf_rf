<?php

$this->load->view('common/header');
$language = $this->session->userdata('language');
if($language){
	$this->lang->load('Home_Page_HM', $language);
}else{
	$this->lang->load('Home_Page_HM', 'english');
}

										$disc_origin=stripslashes($flight_details[0]['origin']);
										$disc_origin_city=$this->flight_model->get_airport_cityname($disc_origin);
										$disc_destination=stripslashes($flight_details[0]['destination']);
										$disc_destination_city=$this->flight_model->get_airport_cityname($disc_destination);
										$disc_destination_country=$this->flight_model->get_airportcode_countryname($disc_destination);
										$disc_price=stripslashes($flight_details[0]['price']);
										$disc_short_desc=stripslashes($flight_details[0]['short_desc']);
										$disc_trip=($flight_details[0]['type']=="R")?"Round Trip":"One Way";
										$disc_trip_class=($flight_details[0]['type']=="R")?"set3":"";
										$disc_povider=$flight_details[0]['provider'];
										$now = time(); 
										$exp_date = strtotime($flight_details[0]['exp_date']);
										$datediff = $now - $exp_date;
										$remain_day= floor($datediff/(60*60*24));
										$discount_img=DISCOUNT_FLIGHT_SMLIMG.$flight_details[0]['small_image'];
										$total_banner=count($flight_banners);

?>

<!--First section-->
<div class="relative">
	<div id="carousel-banner" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<?php for($db=0;$db<$total_banner;$db++){ $discount_img=($flight_banners[$db]['image']!='')?DISCOUNT_FLIGHT_LRGIMG.$flight_banners[$db]['image']:ASSETS."images/banner/banner.png";?>
			<div class="item <?php echo ($db==0)?"active":"";?>">
				<img style="width:1350px;" src="<?php echo $discount_img;?>" alt="flight page">
			</div>
			<?php } ?>
		</div>
		<span class="overlay"></span>
	</div>
	<div class="main-text">
		<div class="text-center">
			<div class="container">
				<h1 class="banner-title text-uppercase"><?php echo $disc_destination_city;?></h1>
				<br>
				<div class="row">
					<div class="col-sm-8 col-sm-offset-2">
						<p class="text-center h3 text-nexa">
							<?php echo $disc_short_desc;?> 
						</p>
					</div>
				</div>
				<br>
				<div class="panel panel-default df">
					<div class="panel-heading">
						<div class="clearfix">
							<div class="pull-left">
								<h4 class="panel-title">
									<b><span class="tf-primary">OFFER:</span> <span class="text-info"><?php echo $disc_origin_city;?> - <?php echo $disc_destination_city;?></span></b>
								</h4>
							</div>
							<div class="pull-right">
								<?php  $fli_img=explode(",", $flight_img[0]['airline_code']); foreach ($fli_img as $fli_img) { ?>
			<img src="<?php echo ASSETS;?>images/airline_logo/<?php echo $fli_img. '.gif'; ?>" alt="<?php  echo $fli_img;  ?>">
						<br>
							<?php echo $this->flight_model->get_airline_name($fli_img);?>
			<?php } ?>

								
							
							</div>
						</div>
					</div>
					<div class="panel-body">
						<form action="<?php echo WEB_URL;?>/flight/search">
						<input id="trip_type" type="hidden" value="<?php echo ($flight_details[0]['type']=="R")?"circle":"oneway";?>" name="trip_type">
						<input  type="hidden" value="<?php echo $disc_origin;?>" name="from">
						<input  type="hidden" value="<?php echo $disc_destination;?>" name="to">
						
						<input  type="hidden" value="<?php echo $disc_price;?>" name="disc_price">
						
						<input  type="hidden" value="<?php echo $flight_details[0]['airline_code'];?>" name="Carriers">
						<input  type="hidden" value="<?php echo $disc_povider;?>" name="provider">
						
						<div class="row">
							<div class="col-sm-10 col-sm-offset-1">
								<div class="row text-left">
									<div class="col-md-4">
										<label for="property" class="text-info">1. Number of Persons</label>
										<div class="drop-eft">
											<input id="property" class="location form-control" type="text" placeholder="1" name="person_select" readonly autocomplete="off">
											<ul class="drop-spot">
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
														<li><span>Child (2-11 yr)</span>
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
														<li><span>Infant (< 2 yr)</span>
															<select name="infant" id="infant_count">
																<option value="0">0</option>
																<option value="1">1</option>
																
															</select>
														</li>
														<li class="divider1"></li>
														<li style="color: green;">A child that turns 12 during the trip, will be billed as an adult</li>
													</ul>
												</li>
											</ul>
										</div>
									</div>
									<div class="col-md-4">
										<label for="depature" class="text-info">2. Choose your flights dates</label>
										<div class="row">
											<div class="col-sm-6">
												<input type="text" name="depature" class="search_date calinput datea form-control" id="depature" placeholder="Depart"  aria-required="true" required />
											</div>
											<?php if($flight_details[0]['type']=="R"){ ?>
											<div class="col-sm-6">
												<input type="text" name="return" aria-required="true" class="search_date datea calinput form-control" id="return" placeholder="Return" required />
											</div>
											<?php }?>
										</div>
										
									</div>
									<div class="col-md-4 text-center">
										<label class="h4 tf-secondary"><?php echo CURR_ICON.$disc_price;?></label>
										<br>
										<button type="submit" class="btn btn-lg icon-and-text text-uppercase center-block">Book</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
<!--End of first section-->

<!-- second section -->
<div class="df-section">
	<div class="container">
		<h2 class="text-center tf-primary text-nexabold margin-top-null"><?php echo $disc_destination_city;?>, het Parijs van het Oosten</h2>
		<?php echo $flight_details[0]['aboutcity'];?>
			<div class="row">
				<?php for($db=0;$db<$total_banner;$db++){ $discount_img=($flight_banners[$db]['image']!='')?DISCOUNT_FLIGHT_LRGIMG.$flight_banners[$db]['image']:ASSETS."images/discount-flights/df-01.jpg";?>
			
			
				<div class="col-sm-4">
					<figure>
						<img src="<?php echo $discount_img;?>" alt="df" class="img-responsive center-block">
					</figure>
				</div>
				<?php } ?>
			</div>
			<!--<p class="text-nexa">
				De beste manier om de schoonheid van Shanghai te bewonderen is te voet. Wandel door het hart van de stad, gevormd door De Bund en Nanjing Lu. Deze promenade ligt langs de oever van
				de Huangpu rivier en hier vind je prachtige gebouwen in neoklassieke stijl. Wanneer je verder wandelt, kom je uit bij de bekendste tempel van Shanghai, de Jaden Boeddha Tempel. Deze unieke
				tempel is gebouwd in 1882 en wordt gekenmerkt door twee bijzondere witte jaden boeddhabeelden.
			</p>
			<p class="text-nexa">
				Niet op wandelafstand maar zeker een bezoek waard zijn de Yu-tuinen. Deze tuinen zijn opgezet in de klassieke Chinese tuinarchitectuur. Bewonder hier de prachtige paviljoenen, unieke
				bloemen, water en weelderige rotsen. Verder is een echte ‘must-do’ als je in Shanghai bent, een bezoek brengen aan het  Hu Xing Ting Theehuis. Dit traditionele, vijfhoekige paviljoen is zeer
				geschikt voor de perfecte Chinese ervaring. Hier kun je namelijk in stijl genieten van een kopje thee, lekkere hapjes en de echte Chinese sfeer.
			</p>-->
			<p class="text-nexa"></p>
		</div>
		<figure>
			<?php $discount_img_=($flight_banners[0]['image']!='')?DISCOUNT_FLIGHT_LRGIMG.$flight_banners[0]['image']:ASSETS."images/discount-flights/bg-df.jpg"; ?>
			<img src="<?php echo $discount_img_;?>" alt="df" class="img-responsive center-block">
		</figure>
		<!--<div class="container">
			<div class="row">
				<div class="col-md-5">
					<h3 class="text-center tf-primary text-nexabold">Shanghai, Top 3 activities</h3>
					<div class="info-section-df">
						<h4 class="text-nexabold text-gray">1. Jade Buddah Tempel</h4>
						<p class="text-nexa">
							Met een fiets vertrek je door een tocht langs  de highlights van Shanghai waaro
							nder deze  tempel.
						</p>
						<a href="#" class="text-info text-nexabold">Reserveer activiteit</a>
					</div>
					<div class="info-section-df">
						<h4 class="text-nexabold text-gray">2. Shanghai Circus</h4>
						<p class="text-nexa">
							Met een fiets vertrek je door een tocht langs  de highlights van Shanghai waaro
							nder deze  tempel.Beleef het Shanghai Circus. Deze prachtige acrobatische show combineert tradit
							ionele Chinese vechtkunst met moderne licht  en muziekeffecten.
						</p>
						<a href="#" class="text-info text-nexabold">Reserveer activiteit</a>
					</div>
				</div>
				<div class="col-md-5 col-md-offset-1">
					<h3 class="text-center tf-primary text-nexabold">Why Shanghai ?</h3>
					<div class="info-section-df">
						<h4 class="text-nexabold text-gray">1. Jade Buddah Tempel</h4>
						<p class="text-nexa">
							Met een fiets vertrek je door een tocht langs  de highlights van Shanghai waaro
							nder deze  tempel.
						</p>
						<a href="#" class="text-info text-nexabold">Reserveer activiteit</a>
					</div>
					<div class="info-section-df">
						<h4 class="text-nexabold text-gray">2. Shanghai Circus</h4>
						<p class="text-nexa">
							Met een fiets vertrek je door een tocht langs  de highlights van Shanghai waaro
							nder deze  tempel.Beleef het Shanghai Circus. Deze prachtige acrobatische show combineert tradit
							ionele Chinese vechtkunst met moderne licht  en muziekeffecten.
						</p>
						<a href="#" class="text-info text-nexabold">Reserveer activiteit</a>
					</div>
				</div>
			</div>
		</div>
	</div>-->
	<!-- / second section -->

	<?php $this->load->view('common/footer');?>
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
	</script>
