<?php
$this->load->view('common/header');
$language = $this->session->userdata('language');
if($language){
	$this->lang->load('Home_Page_HM', $language);
}else{
	$this->lang->load('Home_Page_HM', 'english');
}
$sliders = $this->Help_Model->getAllBackgroundimages();
//print_r(sendMail('veera','29veeramani@gmail.com','veeramani.tekhne@gmail.com','hfghgh','fdfdf'));
// Start Browser back button update all data
header("Cache-Control: no-store, must-revalidate, max-age=0");
header("Pragma: no-cache");
// Start Browser back button update all data
if($this->session->userdata('search_data')!=null){
	$search_datas=$this->session->userdata('search_data');
}else{
	$search_datas=array();
}
$search_trip_type=($search_datas['trip_type']!=null)?$search_datas['trip_type']:'';
$search_from=($search_datas['from']!=null)?$search_datas['from']:'';
$search_to=($search_datas['to']!=null)?$search_datas['to']:'';
$search_depature=($search_datas['depature']!=null)?$search_datas['depature']:'';
$search_return=($search_datas['return']!=null)?$search_datas['return']:'';
$search_adult=($search_datas['adult']!=null)?$search_datas['adult']:'';
$search_child=($search_datas['child']!=null)?$search_datas['child']:'';
$search_infant=($search_datas['infant']!=null)?$search_datas['infant']:'';
$search_person_select=($search_datas['person_select']!=null)?$search_datas['person_select']:'';
if($search_trip_type=="multicity"){
	$search_mfrom=($search_datas['mfrom']!=null)?$search_datas['mfrom']:'';
	$search_mto=($search_datas['mto']!=null)?$search_datas['mto']:'';
	$search_mdepature=($search_datas['mdepature']!=null)?$search_datas['mdepature']:'';
}
if(date("H:i")>trim($search_datas['search_data_expiry'])){
	$this->session->unset_userdata('search_data');
}
// echo date("H:i");
//echo '<pre>';print_r($this->session->userdata('search_data'));
?>
<script type="text/javascript">
/*	window.onload = function () {
//	alert(1);
if (! localStorage.justOnce) {
localStorage.setItem("justOnce", "true");
// window.location.reload();
}else
localStorage.removeItem( 'justOnce' );
}
*/
</script>
<!--First section-->
<div class="relative">
	<div id="carousel-banner" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<?php $sl=0;
			foreach ($sliders as $sliders) { ?>
			<div class="item <?php echo ($sl==0)?"active":"";?>">
				<img src="<?php echo ($sliders->background_image!='')?$sliders->background_image:ASSETS.'images/banner/banner.png';?>" alt="flight page">
			</div>
			<?php $sl++;} ?>
		</div>
		<span class="shade"></span>
	</div>
	<div class="main-text">
		<div class="col-md-12 text-center">
			<div class="container">
				<h2 class="banner-title"><?php echo $banners->banner_title; ?></h2>
<!--  <ul class="img-structure">
<li><a href="#"><span class="banners1 bans1 active"></span></a></li>
<li><a href="#"><span class="banners1 bans2"></span></a></li>
<li><a href="#"><span class="banners1 bans3"></span></a></li>
<li><a href="#"><span class="banners1 bans4"></span></a></li>
while you activating pls remove blow margin_t_120 this class
</ul> -->
<form class="custom show-search-options position-left clearfix text-left margin_t_120"  name="flight" id="flight" action="<?php echo WEB_URL;?>/flight/search" autocomplete="off">
	<input type="hidden" name="trip_type" id="trip_type" value="circle" />
	<div class="input-wrapper" style="float:left;">
		<div id="date_hide" class="styled-select" style="margin-bottom:10px;">
			<ul class="nav nav-pills">
				<li class="dropdown active wayselection span8">
					<a class="dropdown-toggle" id="inp_impact" data-toggle="dropdown">
						<i class="icon icon-ok icon-white"></i>&nbsp;
						<span id="dropdown_title"> <?php if($search_trip_type=='oneway'){ echo lang('ONEWAY'); }elseif ($search_trip_type=='multicity') { echo lang('MULTICITY'); }else{ echo lang('ROUNDTRIP'); } ?></span>
						<span class="caret"></span>
					</a>
					<ul ID="divNewNotifications" class="dropdown-menu">
						<li><span class="city-drop-icon"></span></li>
						<li><a><?=lang('ROUNDTRIP');?></a></li>
						<li><a><?=lang('ONEWAY');?></a></li>
						<li><a><?=lang('MULTICITY');?></a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<div id="one-round" class="flex-container" style="display:<?php echo ($search_trip_type=='multicity')?"none":'';?>">
		<div class="input-wrapper flex-1-1-auto">
			<input type="text" class="flyinput fromflight form-control" value="<?php echo $search_from;?>" required="" name="from" placeholder="<?=lang('FROM');?>" aria-required="true" autocomplete="off" aria-invalid="false" />
			<div id="location_warn"></div>
		</div>
		<div class="input-wrapper flex-1-1-auto">
			<input type="text" class="flyinput departflight form-control" value="<?php echo $search_to;?>"  placeholder="<?=lang('TO');?>" name="to" required="" aria-required="true" autocomplete="off">
		</div>
		<div class="input-wrapper" for="dateto">
			<input type="text" name="depature" class="search_date datea calinput form-control" value="<?php echo $search_depature;?>" id="depature" placeholder="<?=lang('DEPART');?>"  aria-required="true" required=""  />
		</div>
		<div  class="input-wrapper" for="return">
			<input type="text" name="return" class="search_date datea calinput form-control" value="<?php echo $search_return;?>" id="return" placeholder="<?=lang('I_RETURN');?>" <?php echo ($search_trip_type=='oneway')?"disabled":"";?> aria-required="true"  required=""  />
		</div>
<!-- <div class="input-wrapper">
<select class="checkoutWrapper select-main form-control input-lg" id="class" name="class" >
<option value="">All</option>
<option value="Economy"><?=lang('ECONOMY');?></option>
<option value="PremiumEconomy"><?=lang('P_ECONOMY');?></option>
<option value="Business"><?=lang('BUSINESS');?></option>
<option value="First"><?=lang('FIRST');?></option>
<option value="PremiumFirst"><?=lang('P_FIRST');?></option>
</select>
</div> -->
<div class="input-wrapper drop-eft">
	<input id="property" class="location drop1 form-control" type="text" placeholder="1" name="person_select" value="<?php echo $search_person_select;?>" readonly autocomplete="off">
	<ul class="drop-spot">
		<!--<span class="pass-text">Passanger</span>-->
		<li><span class="arrow-icon"></span></li>
		<li>
			<ul>
				<li><span><?=lang('ADULTS');?></span>
					<select name="adult" id="adult">
						<option <?php echo ($search_adult==1)?"selected":'';?> value="1">1</option>
						<option <?php echo ($search_adult==2)?"selected":'';?>  value="2">2</option>
						<option <?php echo ($search_adult==3)?"selected":'';?>  value="3">3</option>
						<option <?php echo ($search_adult==4)?"selected":'';?>  value="4">4</option>
						<option <?php echo ($search_adult==5)?"selected":'';?>  value="5">5</option>
						<option <?php echo ($search_adult==6)?"selected":'';?>  value="6">6</option>
						<option <?php echo ($search_adult==7)?"selected":'';?>  value="7">7</option>
						<option <?php echo ($search_adult==8)?"selected":'';?>  value="8">8</option>
						<option <?php echo ($search_adult==9)?"selected":'';?>  value="9">9</option>
					</select>
				</li>
				<li class="divider1"></li>
				<li>
					<span><?=lang('CHILD');?> </span>
					<select name="child" id="child">
						<option <?php echo ($search_child==0)?"selected":'';?>  value="0">0</option>
						<option <?php echo ($search_child==1)?"selected":'';?>  value="1">1</option>
						<option <?php echo ($search_child==2)?"selected":'';?>  value="2">2</option>
						<option <?php echo ($search_child==3)?"selected":'';?>  value="3">3</option>
						<option <?php echo ($search_child==4)?"selected":'';?>  value="4">4</option>
						<option <?php echo ($search_child==5)?"selected":'';?>  value="5">5</option>
						<option <?php echo ($search_child==6)?"selected":'';?>  value="6">6</option>
						<option <?php echo ($search_child==7)?"selected":'';?>  value="7">7</option>
						<option <?php echo ($search_child==8)?"selected":'';?>  value="8">8</option>
					</select>
				</li>
				<li class="divider1"></li>
				<li><span><?=lang('INFANT');?></span>
					<select name="infant" id="infant">
						<option <?php echo ($search_infant==0)?"selected":'';?>  value="0">0</option>
						<option <?php echo ($search_infant==1)?"selected":'';?>  value="1">1</option>
					</select>
				</li>
				<li class="divider1"></li>
				<li style="color: green;"><?=lang('CHILD_TERM');?></li>
			</ul>
		</li>
	</ul>
</div>
<div class="input-wrapper mr0">
	<input id="" class="large pink btn icon-and-text position-left oneway-submit" name='flight_submit' type="submit" value="<?=lang('SEARCH');?>">
</div>
<div class="input-wrapper">
	<label class="checkbox-inline">
		<input id="days"  name='days' type="checkbox" value="1"> <?=lang('SEARCH_3DAYS');?>
	</label>
</div>
</div>
<div id="multi_city_select" style="display:<?php echo ($search_trip_type=='multicity')?"block":'none';?>" >
	<div id="paste_div">
		<div class="multi_city_0 mt0 multi-city flex-container">
			<div class="input-wrapper flex-1-1-auto">
				<input type="text" required="" id="from1" name="mfrom[0]" value="<?php echo (isset($search_mfrom[0]) && $search_mfrom[0]!='')?$search_mfrom[0]:'';?>"  placeholder="<?=lang('FROM');?>" class="flyinput fromflight form-control" aria-required="true" autocomplete="off" aria-invalid="false">
			</div>
			<div class="input-wrapper flex-1-1-auto">
				<input type="text" required="" id="to1" name="mto[0]" value="<?php echo (isset($search_mto[0]) && $search_mto[0]!='')?$search_mto[0]:'';?>"  placeholder="<?=lang('TO');?>" class="flyinput departflight form-control" aria-required="true" autocomplete="off" aria-invalid="false">
			</div>
			<div class="input-wrapper flex-1-1-auto">
				<input type="text" required="" id="depature1" name="mdepature[0]" value="<?php echo (isset($search_mdepature[0]) && $search_mdepature[0]!='')?$search_mdepature[0]:'';?>"  placeholder="<?=lang('DEPART');?>" class="flyinput multi_city_selector search_date form-control" aria-required="true">
			</div>
<!-- <div class="input-wrapper">
<select class="checkoutWrapper select-main form-control input-lg" id="class" name="class" required>
<option value="Economy"><?php echo $this->lang->line('HM_S_Flights_class_e'); ?></option>
<option value="PremiumEconomy"><?php echo $this->lang->line('HM_S_Flights_class_p'); ?></option>
<option value="Business"><?php echo $this->lang->line('HM_S_Flights_class_b'); ?></option>
<option value="First"><?php echo $this->lang->line('HM_S_Flights_class_f'); ?></option>
<option value="PremiumFirst"><?php echo $this->lang->line('HM_S_Flights_class_pf'); ?></option>
</select>
</div> -->
<div class="input-wrapper drop-eft">
	<input id="property1" class="location drop1 form-control" type="text" placeholder="1" name="person_select" value="<?php echo $search_person_select;?>" readonly autocomplete="off">
	<ul class="drop-spot">
		<!--<span class="pass-text">Passanger</span>-->
		<li><span class="arrow-icon"></span></li>
		<li>
			<ul>
				<li><span><?=lang('ADULTS');?></span>
					<select name="adult" id="adult1">
						<option <?php echo ($search_adult==1)?"selected":'';?> value="1">1</option>
						<option <?php echo ($search_adult==2)?"selected":'';?>  value="2">2</option>
						<option <?php echo ($search_adult==3)?"selected":'';?>  value="3">3</option>
						<option <?php echo ($search_adult==4)?"selected":'';?>  value="4">4</option>
						<option <?php echo ($search_adult==5)?"selected":'';?>  value="5">5</option>
						<option <?php echo ($search_adult==6)?"selected":'';?>  value="6">6</option>
						<option <?php echo ($search_adult==7)?"selected":'';?>  value="7">7</option>
						<option <?php echo ($search_adult==8)?"selected":'';?>  value="8">8</option>
						<option <?php echo ($search_adult==9)?"selected":'';?>  value="9">9</option>
					</select>
				</li>
				<li class="divider1"></li>
				<li><span><?=lang('CHILD');?>   </span>
					<select name="child" id="child1">
						<option <?php echo ($search_child==0)?"selected":'';?>  value="0">0</option>
						<option <?php echo ($search_child==1)?"selected":'';?>  value="1">1</option>
						<option <?php echo ($search_child==2)?"selected":'';?>  value="2">2</option>
						<option <?php echo ($search_child==3)?"selected":'';?>  value="3">3</option>
						<option <?php echo ($search_child==4)?"selected":'';?>  value="4">4</option>
						<option <?php echo ($search_child==5)?"selected":'';?>  value="5">5</option>
						<option <?php echo ($search_child==6)?"selected":'';?>  value="6">6</option>
						<option <?php echo ($search_child==7)?"selected":'';?>  value="7">7</option>
						<option <?php echo ($search_child==8)?"selected":'';?>  value="8">8</option>
					</select>
				</li>
				<li class="divider1"></li>
				<li><span><?=lang('INFANT');?></span>
					<select name="infant" id="infant1">
						<option <?php echo ($search_infant==0)?"selected":'';?>  value="0">0</option>
						<option <?php echo ($search_infant==1)?"selected":'';?>  value="1">1</option>
					</select>
				</li>
				<li class="divider1"></li>
				<li style="color: green;"><?=lang('CHILD_TERM');?></li>
			</ul>
		</li>
	</ul>
</div>
<div class="input-wrapper mr0">
	<input id="" class="large pink btn icon-and-text position-left oneway-submit" name='flight_submit' type="submit" value="<?=lang('SEARCH');?>">
</div>
</div>
<div class="multi_city_1  multi-city flex-container">
	<div class="input-wrapper flex-1-1-auto">
		<input type="text" required="" id="from2" name="mfrom[1]" value="<?php echo (isset($search_mfrom[1]) && $search_mfrom[1]!='')?$search_mfrom[1]:'';?>"  placeholder="<?=lang('FROM');?>" class="flyinput fromflight form-control" aria-required="true" autocomplete="off" aria-invalid="false">
	</div>
	<div class="input-wrapper flex-1-1-auto">
		<input type="text" required="" id="to2" name="mto[1]" value="<?php echo (isset($search_mto[1]) && $search_mto[1]!='')?$search_mto[1]:'';?>" placeholder="<?=lang('TO');?>" class="flyinput fromflight form-control" aria-required="true" autocomplete="off" aria-invalid="false">
	</div>
	<div class="input-wrapper flex-1-1-auto">
		<input type="text" required="" id="depature2" name="mdepature[1]" value="<?php echo (isset($search_mdepature[1]) && $search_mdepature[1]!='')?$search_mdepature[1]:'';?>"  placeholder="<?=lang('DEPART');?>" class="flyinput multi_city_selector search_date form-control" aria-required="true">
	</div>
	<ul class="flex-2-1-auto">
		<li id="remove_multi_1" style="display:none" ><a class="minus-button" href="javascript:void(0)" style="margin-top:2px"></a></li>
		<li id="add_multi_1" ><a class="plus-button" href="javascript:void(0)"></a></li>
	</ul>
</div>
<div class="multi_city_2  multi-city flex-container" style="display:none">
	<div class="input-wrapper flex-1-1-auto">
		<input type="text" required="" id="from3" name="mfrom[2]" placeholder="<?=lang('FROM');?>" class="flyinput fromflight form-control" aria-required="true" autocomplete="off" aria-invalid="false">
	</div>
	<div class="input-wrapper flex-1-1-auto">
		<input type="text" required="" id="to3" name="mto[2]" placeholder="<?=lang('TO');?>" class="flyinput fromflight form-control" aria-required="true" autocomplete="off" aria-invalid="false">
	</div>
	<div class="input-wrapper flex-1-1-auto">
		<input type="text" required="" id="depature3" name="mdepature[2]" placeholder="<?=lang('DEPART');?>" class="flyinput multi_city_selector search_date form-control" aria-required="true">
	</div>
	<ul class="flex-2-1-auto">
		<li id="remove_multi_2" style="display:none" ><a class="minus-button" href="javascript:void(0)" style="margin-top:2px"></a></li>
		<li id="add_multi_2" ><a class="plus-button" href="javascript:void(0)"></a></li>
	</ul>
</div>
<div class="multi_city_3  multi-city flex-container" style="display:none">
	<div class="input-wrapper flex-1-1-auto">
		<input type="text" required="" id="from4" name="mfrom[3]" placeholder="<?=lang('FROM');?>" class="flyinput fromflight form-control" aria-required="true" autocomplete="off" aria-invalid="false">
	</div>
	<div class="input-wrapper flex-1-1-auto">
		<input type="text" required="" id="to4" name="mto[3]" placeholder="<?=lang('TO');?>" class="flyinput fromflight form-control" aria-required="true" autocomplete="off" aria-invalid="false">
	</div>
	<div class="input-wrapper flex-1-1-auto">
		<input type="text" required="" id="depature4" name="mdepature[3]" placeholder="<?=lang('DEPART');?>" class="flyinput multi_city_selector search_date form-control" aria-required="true">
	</div>
	<ul class="flex-2-1-auto">
		<li id="remove_multi_3"  ><a class="minus-button" href="javascript:void(0)" style="margin-top:2px"></a></li>
		<!-- <li id="add_multi_3" ><a class="plus-button" href="javascript:void(0)"></a></li> -->
	</ul>
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
						<h1 class="text-center cnter-title"><?php echo $banners->flight_offer_title; ?></h1>
						<p class="sub-stutl"><?php echo $banners->flight_offer_desc; ?> </p>
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
							$disc_destination_country=$this->flight_model->get_airportcode_countryname($disc_destination);
							$disc_price=stripslashes($discounted_flights[$df]['price']);
							$disc_trip=($discounted_flights[$df]['type']=="R")?"Round Trip":"One Way";
							$disc_trip_class=($discounted_flights[$df]['type']=="R")?"set3":"set2 one";
							$disc_each_url=base_url().'flight/discounted_flight/'.$discounted_flights[$df]['id'].'/'.$disc_origin_city.'/'.$disc_destination_city;
							$now = time();
							$exp_date = strtotime($discounted_flights[$df]['exp_date']);
							$datediff =$exp_date-$now;
							$remain_day= floor($datediff/(60*60*24))+1;
							$discount_img=DISCOUNT_FLIGHT_SMLIMG.$discounted_flights[$df]['small_image'];
							if($df%2==1){
								echo '<div class="col-md-6">';
							}
							if($df%2==0){
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
							<?php if($df%2==1){
								echo '</div>';
							}?>
							<?php } ?>
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
									$disc_destination_country=$this->flight_model->get_airportcode_countryname($disc_destination);
									$disc_price=stripslashes($discounted_flights[0]['price']);
									$disc_trip=($discounted_flights[0]['type']=="R")?"Round Trip":"One Way";
									$disc_trip_class=($discounted_flights[0]['type']=="R")?"set3":"set2 one";
									$disc_each_url=base_url().'flight/discounted_flight/'.$discounted_flights[0]['id'].'/'.$disc_origin_city.'/'.$disc_destination_city;
									$now = time();
									$exp_date = strtotime($discounted_flights[0]['exp_date']);
									$datediff =$exp_date-$now;
									$remain_day= floor($datediff/(60*60*24))+1;
									$discount_img=DISCOUNT_FLIGHT_SMLIMG.$discounted_flights[0]['small_image'];
									?>
									<a class="img-wd2" href="<?php echo $disc_each_url;?>"><img class="relative img1 img-responsive center-block" style="height: 420px;" src="<?php echo ($discount_img!='')?$discount_img:ASSETS."images/site/img1.png";?>" /></a>
									<span  class="contry-titl hid">
										<label class="place1"><?php echo $disc_destination_city;?>,</label>
										<label class="place2"> <?php echo $disc_destination_country;?></label>
									</span>
									<span <?php  if($totdiscflight==1){ ?> style="top: -66px ! important;" <?php } ?> class="contry-titl disp"><P class="city-tils">Nog dagen te boeken:</P><label class="city-nums"><?php echo $remain_day;?></label><a class="city-link" href="<?php echo $disc_each_url;?>">BEKIJK DE AANBIEDINGEN</a></span>
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
<!--<div class="row clearfix section2 bg-white">
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
</div>-->
<!--End of third section-->
<!-- New Section Veera-->
<div class="row clearfix section2 bg-white">
	<div class="main">
		<div class="col-md-12 column">
			<h1 class="text-center cnter-title"><?=lang('WHY_WE');?></h1>
			<div class="row clearfix">
				<div class="col-md-12 column">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<?php $total_w_w=count($why_we_details);
								if($total_w_w>0){
									for ($w=0; $w <$total_w_w; $w++) {
										$why_we_title=stripslashes($why_we_details[$w]['title']);
										$why_we_url=stripslashes($why_we_details[$w]['url']);
										$why_we_descriptions=stripslashes($why_we_details[$w]['short_desc']);
										$why_we_icon=WHY_WE_IMG.$why_we_details[$w]['icon'];?>
										<div class="col-sm-4 col-xs-12">
											<div class="thumbnail text-center">
												<a target="_blank" class="whywe" href="<?php echo ($why_we_url!='')?$why_we_url:"javascript:;";?>">
													<div class="inline-block">
														<?php if($why_we_details[$w]['icon']!=''){ ?>
														<img src="<?php echo $why_we_icon;?>" alt="Why We Logo">
														<?php } else { ?>
														<span class="ico-set2 set1"></span>
														<?php } ?>
													</div>
													<div class="fleft text-center">
														<h3 class="hotel-titles"><?php echo ($why_we_title!='')?$why_we_title:"N/A";?></h3>
														<!-- <p class="hotel-desc"><?php echo ($why_we_descriptions!='')?$why_we_descriptions:"N/A";?></p> -->
													</div>
													<div class="thiscontainer hide">
														<?php  $get_slug=end(explode('/', $why_we_url));
														if($get_slug!=null){
															$content=$this->Home_Model->get_app_routes($get_slug);
															echo $content->english;
//print_r($content);
														}else{
															echo "Not yet Posted";
														}
														?>
													</div>
												</a>
											</div>
										</div>
										<?php
									}
								} else {
									echo "<h3 class='text-center cnter-title'>Wait & See</h3>";
								} ?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- <div class="col-sm-4 col-xs-12 column">
			<div class="social-title">
				<h5>Share on Social Media</h5>
			</div>
			<ul class="footer-list newlisting2">
				<li>
					<a target="_blank" href="<?php echo $social_links->twitter;?>">
						<span class="fb11"></span>
					</a>
				</li>
				<li>
					<a target="_blank" href="<?php echo $social_links->google;?>">
						<span class="fb12"></span>
					</a>
				</li>
				<li>
					<a target="_blank" href="<?php echo $social_links->facebook;?>">
						<span class="fb13"></span>
					</a>
				</li>
				<li>
					<a target="_blank" href="<?php echo $social_links->linkedin;?>">
						<span class="fb14"></span>
					</a>
				</li>
				<li>
					<a target="_blank" href="<?php echo $social_links->vimeo;?>">
						<span class="fb15"></span>
					</a>
				</li>		
				<li>
					<a target="_blank" href="<?php echo $social_links->dribbble;?>">
						<span class="fb16"></span>
					</a>
				</li>
				<li>
					<a target="_blank" href="<?php echo $social_links->flickr;?>">
						<span class="fb17"></span>
					</a>
				</li>
			</ul>
		</div> -->
	</div>
</div>


<!--End New Section Veera-->
<!--Fourth section-->
<!--<div class="row clearfix section3">
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
</div>-->
<!--End Fourth section-->
<!--Fifth section-->
<div class="row clearfix section4">
	<div class="main">
		<div class="col-md-7 col-sm-12 col-xs-12 column">
			<p class="last-content">
				<?php echo $banners->news_letter_title; ?>
			</p>
		</div>
		<?php
		$language = $this->session->userdata('language');
		if($language){ $this->lang->load('Footer_F', $language); }else{ $this->lang->load('Footer_F', 'english');  }
		?>
		<div class="col-md-5 col-sm-12 col-xs-12 column sec4_emailsubs">
			<form id="usrSub" action="<?php echo WEB_URL.'/users/subscribeUser'; ?>">
				<div class="col-md-7 col-sm-7 col-xs-7 column">
					<input type="email" class="emai-text" id="usrSubEmail" placeholder="<?=lang('LOGIN_EMAIL'); ?>" required>
				</div>
				<div class="col-md-5 col-sm-5 col-xs-5 column">
					<input class="sbt-btn" id="subscribeUser" name="usrSubscId" type="submit" value="<?=lang('SUBSCRIBE');?>" />
				</div>
			</form>
			<span class="succNewsLetterSubsc" style="font-size: 13px; color: green; display: none;">Thank you, You are subscribed to newsletter feed.<?php echo $this->lang->line('F_N_Thanku'); ?></span>
			<span class="failNewsLetterSubsc" style="font-size: 13px; color: red; display: none;"><?php echo $this->lang->line('F_N_Error'); ?></span>
		</div>
	</div>
</div>
<!--End of fifth section-->
<?php  $this->load->view('common/index_footer');?>
</body>
</html>
