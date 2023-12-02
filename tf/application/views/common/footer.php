<?php $language = $this->session->userdata('language');
if($language){ $this->lang->load('Footer_F', $language); }else{ $this->lang->load('Footer_F', 'english');  }
$controller = $this->router->fetch_class(); $method = $this->router->fetch_method(); $current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : ''; $current_url = $this->config->site_url().$this->uri->uri_string(). $current_url; $current_url = base64_encode($current_url); ?>
<?php $social_links = $this->Help_Model->getsocial_links();
$footerlinks = $this->Help_Model->getAllFooterLinks();
$banners = $this->Help_Model->getHomeSettings();
?>
<div class="clear"></div>
<div class="row clearfix footer text-left">
	<div class="main">
		<div class="col-md-3 column">
			<span class="footer-title"><?=lang('ROW1_HEADING');?></span>
			<ul class="footer-list">
				<?php if(!empty($footerlinks)) foreach($footerlinks as $footer) {
					if($footer->page == 'discover'){
						$language = $this->session->userdata('language');
						if(!$language){ $language = 'english'; }
							$get_open_type=$this->Help_Model->get_open_type($footer->slug);
						if(is_array($get_open_type[0])){
								$open_type=(isset($get_open_type[0]['open']) && $get_open_type[0]['open']!=null)?$get_open_type[0]['open']:'No';
						}else{
							$open_type='No';
						}

						if($open_type=='No'){
							$static_open='target="_blank" href="'.$footer->url.'"';
						}else{
							$fun='window.open("'.$footer->url.'", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=700,left=300,width=500,height=500");';
							$static_open="onclick='".$fun."'";
						}
						?>
						<li><a <?php echo $static_open;?> ><span class="glyphicon glyphicon-play"></span><?php echo $footer->$language; ?></a></li>
						<?php 
					} 
				}?>
			</ul>
		</div>
		<div class="col-md-3 column" >
			<span class="footer-title"><?=lang('ROW2_HEADING');?></span>
			<ul class="footer-list">
				<?php if(!empty($footerlinks)) foreach($footerlinks as $footer) {
					if($footer->page == 'business'){
						$language = $this->session->userdata('language');
						if(!$language){ $language = 'english'; }

						$get_open_type=$this->Help_Model->get_open_type($footer->slug);
						if(is_array($get_open_type[0])){
								$open_type=(isset($get_open_type[0]['open']) && $get_open_type[0]['open']!=null)?$get_open_type[0]['open']:'No';
						}else{
							$open_type='No';
						}

						if($open_type=='No'){
							$static_open='target="_blank" href="'.$footer->url.'"';
						}else{
							$fun='window.open("'.$footer->url.'", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=700,left=300,width=500,height=500");';
							$static_open="onclick='".$fun."'";
						}
						
						?>
						<li><a  <?php echo $static_open;?> ><span class="glyphicon glyphicon-play"></span><?php echo $footer->$language; ?></a></li>
						<?php 
					} 
				}?>
			</ul>
		</div>
		<div class="col-md-3 column">
			<div class="row clearfix">
				<div class="col-md-12 column">
					<span class="footer-title"><?=lang('ROW3_HEADING');?></span>
					<ul class="footer-list newlisting payment_list">
						<?php if($banners->visa){ ?>
						<li>
							<a href="javascript:void(0);">
								<img src="<?php echo ASSETS;?>images/payment_logo/visa.png">
							</a>
						</li>
						<?php } if($banners->master){ ?>
						<li>
							<a href="javascript:void(0);">
								<img src="<?php echo ASSETS;?>images/payment_logo/mastercard.png">
							</a>
						</li>
						<?php } if($banners->ideal){ ?>
						<li class="pl_ideal">
							<a href="javascript:void(0);">
								<img src="<?php echo ASSETS;?>images/payment_logo/ideal_logo.png">
							</a>
						</li>
						<?php } if($banners->paypal){ ?>
						<li>
							<a href="javascript:void(0);">
								<img src="<?php echo ASSETS;?>images/payment_logo/paypal.png">
							</a>
						</li>
						<?php } if($banners->usa_exp){ ?>
						<li>
							<a href="javascript:void(0);"><span class="fb5"></span></a>
						</li>
						<?php } if($banners->other){ ?>
						<li>
							<a href="javascript:void(0);"><span class="fb6"></span></a>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-3 column">
			<div class="row clearfix">
				<div class="col-md-12 column">
					<span class="footer-title"><?=lang('ROW4_HEADING');?></span>
					<ul class="footer-list newlisting payment_list">
						<?php if($banners->cert_iata){ ?>
						<li>
							<a href="javascript:void(0);">
								<img src="<?php echo ASSETS;?>images/payment_logo/iata.png">
							</a>
						</li>
						<?php } if($banners->cert_anvr){ ?>
						<li><a href="javascript:void(0);"><span class="fb8"></span></a></li>
						<?php } if($banners->cert_nga){ ?>
						<li>
							<a href="javascript:void(0);">
								<img src="<?php echo ASSETS;?>images/payment_logo/sgr.png">
							</a>
						</li>
						<li class="full-width">
							<a href="javascript:void(0);">
								<img src="<?php echo ASSETS;?>images/payment_logo/unigarant.jpg">
							</a>
						</li>
						<?php } if($banners->cert_woonborg){ ?>
						<li><a href="javascript:void(0);"><span class="fb10"></span></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="col-sm-12">
			<div class="coprig_con">
				<p>Copyright © 2016 Ticket Finder. All rights reserved.</p>
			</div>
		</div>
	</div>
</div>
<div id="cartbox" class="ritcart">
	<div class="cartclose"></div>
	<div class="outer-nav left vertical loadcart"></div>
	<div class="cartloading fixht"></div>
	<div class="crtempty">
		<div class="nocartimg">
			<img src="<?php echo ASSETS;?>images/sorry.png" alt="" />
		</div>
		<div class="emptymsg"><?=lang('YOUR_CART_EMPTY');?></div>
	</div>
</div>
<?php if($controller != 'agent'){ ?>
<div id="fadeandscale" class="wellme" style="display:none;">
	<div id="loginLdr" class="lodrefrentrev imgLoader"><div class="centerload"></div>
</div>
<div class="popuperror" style="display:none;"></div><div class="signdiv"><div class="insigndiv"><div class="leftpul">
<?php
$atts = array('width' => '600','height' => '600','scrollbars' => 'yes','status' => 'yes','resizable'  => 'yes','screenx'   =>  '\'+((parseInt(screen.width) - 600)/2)+\'','screeny'   =>  '\'+((parseInt(screen.height) - 600)/2)+\'' );
$atts['class'] = 'logspecify facecolor';
echo anchor_popup('auth/login/Facebook/login','
	<div class="mensionsoc"><span class="fa fa-facebook fa-lg fa-fw color-white"></span>'.lang('LOG_W_FB').'</div>', $atts);
$atts['class'] = 'logspecify tweetcolor';
echo anchor_popup('auth/login/Twitter/login','
	<div class="mensionsoc"><span class="fa fa-twitter fa-lg fa-fw color-white"></span>'.lang('LOG_W_TW').'</div>', $atts);
$atts['class'] = 'logspecify gpluses';
echo anchor_popup('auth/login/Google/login','
	<div class="mensionsoc"><span class="fa fa-google-plus fa-lg fa-fw color-white"></span>'.lang('LOG_W_GP').'</div>', $atts);
	?>
</div>
<div class="centerpul"><div class="orbar"><strong><?=lang('OR'); ?></strong></div></div>
<form id="login" name="login" action="<?php echo WEB_URL;?>/account/login">
	<div class="ritpul">
		<div class="rowput"><span class="icon glyphicon-envelope"></span><input class="form-control logpadding" type="email" name="email" placeholder="<?=lang('EMAIL'); ?>" required /></div>
		<div class="rowput"><span class="icon icon-lock"></span><input class="form-control logpadding" type="password" name="password" id="pswd" placeholder="<?=lang('PSWD'); ?>" required /><div class="errMsg"></div>
	</div>
	<div class="misclog"><a class="fadeandscale_close fadeandscaleforget_open forgota" id="forgtpsw"><?=lang('FORGT_PASS'); ?></a></div>
	<div class="clear"></div><button class="submitlogin"><?php echo $this->lang->line('LOGIN'); ?></button><div class="clear"></div>
	<div class="dntacnt"><?=lang('DONT_HAVE_ACCOUNT'); ?><a class="fadeandscale_close fadeandscalereg_open"><?=lang('SIGNUP'); ?></a> </div>
</div>
</form>
</div>
</div>
</div>
<div id="fadeandscaleforget" class="wellme" style="display:none;">
	<div class="popuperror" style="display:none;"></div>
	<div  class="pophed"><?=lang('RESET_PASSWORD');?></div>
	<div class="signdiv">
		<div class="formcontnt"><?=lang('RESET_PASSWORD_TEXT');?></div>
		<form id="forgetpwd" name="forgetpwd" action="<?php echo WEB_URL;?>/account/forgetpwd">
			<div class="ritpul">
				<div class="rowput">
					<span class="icon glyphicon-envelope"></span>
					<input class="form-control logpadding" type="email" name="email" placeholder="<?=lang('FP_EMAIL');?>" required>
				</div>
				<div class="clear"></div>
				<button class="submitlogin"><?=lang('FP_SUBMIT_LINK');?></button>
				<div class="clear"></div>
				<div class="dntacnt"><?php echo $this->lang->line('SUDDEN_REMEMBER'); ?>
					<a class="fadeandscaleforget_close fadeandscale_open">
						<?=lang('LOGIN');?>
					</a>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
<div id="fadeandscalereg" class="wellme" style="display:none;">
	<div id="loginLdrReg" class="lodrefrentrev imgLoader"><div class="centerload"></div></div>
	<div class="popuperror" style="display:none;"></div>
	<div class="signdiv"><div class="insigndiv"><div class="clear"></div>
	<div class="leftpul">
		<?php
		$atts = array('width' => '600','height' => '600','scrollbars' => 'yes','status' => 'yes','resizable'  => 'yes','screenx'   =>  '\'+((parseInt(screen.width) - 600)/2)+\'','screeny'   =>  '\'+((parseInt(screen.height) - 600)/2)+\'' );
		$atts['class'] = 'logspecify facecolor';
		echo anchor_popup('auth/login/Facebook/up','
			<div class="mensionsoc"><span class="fa fa-facebook fa-lg fa-fw color-white"></span>'.lang('LOG_W_FB').'</div>', $atts);
		$atts['class'] = 'logspecify tweetcolor';
		echo anchor_popup('auth/login/Twitter/up','
			<div class="mensionsoc"><span class="fa fa-twitter fa-lg fa-fw color-white"></span>'.lang('LOG_W_TW').'</div>', $atts);
		$atts['class'] = 'logspecify gpluses';
		echo anchor_popup('auth/login/Google/up','
			<div class="mensionsoc"><span class="fa fa-google-plus fa-lg fa-fw color-white"></span>'.lang('LOG_W_GP').'</div>', $atts);
			?>
		</div>
		<div class="centerpul"><div class="orbar"><strong><?=lang('OR');?></strong></div></div>
		<a class="logspecify mymail"><div class="mensionsoc"> <span class="fa fa-envelope fa-lg fa-fw"></span> <?=lang('SIGN_W_E');?></div></a>
		<form id="registration" name="registration" action="<?php echo WEB_URL;?>/account/create">
			<input type="hidden" name="continue" value="11">
			<div class="signupul">
				<div class="rowput"><span class="icon icon-user"></span><input class="form-control logpadding" type="text" name="fname" placeholder="<?=lang('F_NAME');?>" minlength="4" required/></div>
				<div class="rowput"><span class="icon icon-user"></span><input class="form-control logpadding" type="text" name="mname" placeholder="<?=lang('M_NAME');?>" minlength="1" required /></div>
				<div class="rowput"><span class="icon icon-user"></span><input class="form-control logpadding" type="text" name="lname" placeholder="<?=lang('L_NAME');?>" minlength="4" required/></div>
				<div class="rowput"><span class="icon glyphicon-envelope"></span><input class="form-control logpadding" type="email" name="email" placeholder="<?=lang('UR_EMAIL');?>" required/></div>
				<div class="rowput"><span class="icon icon-lock"></span><input class="form-control logpadding" type="password" name="password" id="password" placeholder="<?=lang('PSWD');?>" minlength="5" maxlength="50" required/></div>
				<div class="rowput"><span class="icon icon-lock"></span><input class="form-control logpadding" type="password" name="cpassword" placeholder="<?=lang('CONFIRM');?>" required/></div>
				<div class="clear"></div>
				<div class="signupterms">
					<?=lang('F_S_agree'); ?>
					<a target="_blank" href="<?php echo WEB_URL.'/terms-of-service'; ?>">
						<?=lang('F_S_terms'); ?>
					</a>,
					<a target="_blank"  href="<?php echo WEB_URL.'/privacy-policy'; ?>">
						<?=lang('F_S_pp'); ?>
					</a>,
					<a target="_blank"  href="<?php echo WEB_URL.'/guest-refund-policy'; ?>">
						<?=lang('F_S_gp'); ?>
					</a>
					<?=lang('F_S_and'); ?>
					<a target="_blank"  href="<?php echo WEB_URL.'/host-guarantee-terms'; ?>">
						<?=lang('F_S_hg'); ?>
					</a>.
				</div>
				<div class="clear"></div>
				<input type="submit" class="submitlogin" value="<?=lang('F_S_signup'); ?>" name="Sign up"/>
			</div>
		</form>
		<div class="clear"></div>
		<div class="dntacnt">
			<?=lang('F_S_already_member'); ?>
			<a class="fadeandscalereg_close fadeandscale_open">
				<?=lang('LOGIN'); ?>
			</a>
		</div>
	</div></div>
</div>
<?php }?>
<link rel="stylesheet" href="<?php echo ASSETS;?>css/bootstrap-multiselect.css" type="text/css"/>
<link rel="stylesheet" href="<?php echo ASSETS;?>css/_all.css" type="text/css"/>
<link rel="stylesheet" href="<?php echo ASSETS;?>css/blue.css" type="text/css"/>
<script type='text/javascript' src="<?php echo ASSETS;?>js/jquery-ui.js"></script>

<script> $.widget.bridge('uitooltip', $.ui.tooltip); </script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/owl.carousel.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/bootstrap.min.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/jquery.easing.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/js-list2.js"></script>
<script type="text/javascript" src="<?php echo ASSETS;?>js/jquery.popupoverlay.js"></script>
<?php if($this->router->fetch_class()=="dashboard"){ ?>
<script type='text/javascript' src="<?php echo ASSETS;?>js/proPages.min.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/Pagination.js"></script>
<?php } ?>
<script type='text/javascript' src="<?php echo ASSETS;?>js/js-details.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/initialize-google-map.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/functions.js"></script>
<script type="text/javascript" src="<?php echo ASSETS;?>js/jquery.themepunch.revolution.min.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/jquery.nicescroll.min.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/jquery.carouFredSel-6.2.1-packed.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/helper-plugins/jquery.touchSwipe.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS;?>js/helper-plugins/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS;?>js/helper-plugins/jquery.transit.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS;?>js/helper-plugins/jquery.ba-throttle-debounce.min.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/counter.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/initialize-carousel-detailspage.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/jquery.flexslider.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/jquery.dlmenu.js"></script>
<script>
$val_required = "<?=lang('val_required');?>";
$val_remote = "<?=lang('val_remote');?>";
$val_email = "<?=lang('val_email');?>";
$val_url = "<?=lang('val_url');?>";
$val_date = "<?=lang('val_date');?>";
$val_number = "<?=lang('val_number');?>";
$val_digits = "<?=lang('val_digits');?>";
$val_equalTo = "<?=lang('val_equalTo');?>";
$val_maxlength = "<?=lang('val_maxlength');?>";
$val_minlength = "<?=lang('val_minlength');?>";
$val_rangelength = "<?=lang('val_rangelength');?>";
$val_range = "<?=lang('val_range');?>";
$val_less = "<?=lang('val_less');?>";
$val_greater = "<?=lang('val_greater');?>";
</script>
<script src="<?php echo ASSETS;?>js/jquery.yiiactiveform.js"  type="text/javascript"></script>
<script src="<?php echo ASSETS;?>js/validation.js"  type="text/javascript"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/validate/jquery.validate.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/validate/custom.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/general.js"></script>

<script type='text/javascript' src="<?php echo ASSETS;?>js/jquery.provabpopup.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/support/support.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>/js/dataTables.tableTools.js"></script>
<script src="<?php echo ASSETS;?>js/icheck.js?v=1.0.2"></script>
<script src="<?php echo ASSETS;?>js/star-rating.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo ASSETS;?>js/mustache.js" ></script>
<script src="<?php echo ASSETS;?>js/cart.js" type="text/javascript"></script>
<script src="<?php echo ASSETS;?>js/jquery.style-my-tooltips.js"></script>
<script>
$(document).ready(function() {
	$(".slider1 span[title], .slider2 span[title]").style_my_tooltips();
	if($("input[name='trip_type']").is(':checked')){
		trip_type=$("input[name='trip_type']").val();
		if(trip_type=='multicity'){
			$("div.normal :input").prop("disabled", false);
			$("div.normal select").prop("disabled", false);
		}else{
			$("div.multicity :input").prop("disabled", false);
			$("div.multicity select").prop("disabled", true);
		}
	}
});
$(document).ready(function(){
	<?php if($this->input->get("type")=="M"){ ?>
		$('div.multicity :input').prop('disabled',false);
		<?php } ?>
	});
$(document).ready(function(){
	$('.btool, .tooltipp').tooltip();
	$('input.icheckbox_flat-blue').iCheck({
		checkboxClass: 'icheckbox_flat-blue',
		radioClass: 'iradio_flat'
	});
	$('input.triprad').on('ifChecked', function(event){
		console.log($(this).val());
		if ($(this).val() == 'oneway'){
			$('.multicity').fadeOut(10, function(){
				$('.normal').fadeIn(100);
			});
			$('#return').prop('disabled',true);
			$('#return').prop('required',false);
			$('#return').parent().addClass('ifonway');
			$('#return').val('');
		}
		if ($(this).val() == 'circle'){
			$('.multicity').fadeOut(10, function(){
				$('.normal').fadeIn(100);
			});
			$('#return').prop('disabled',false);
			$('#return').prop('required',true);
			$('#returnDiv').removeClass('ifonway');
		}
		if ($(this).val() == 'multicity'){
			$('.normal').fadeOut(10, function(){
				$('.multicity').fadeIn(100);
				$('div.multicity :input').prop('disabled',false);
//$('div.multicity select').prop('required',true);
});
// jQuery('.mySelectBoxClass').customSelect();
$('#return').prop('disabled',true);
$('#return').val('');
$('#return').prop('required',false);
$('#returnDiv').removeClass('ifonway');
}
});
	var counter=1;
	var c;
	$('.addflight').click (function (event) {
		c = $( "div.multyflight" ).length;
		var co = c+1;
		if(co <= 4){
		}else{
			return false;
		}
		if(co < 4){
		}else{
			$('div.addflight').hide();
		}
		event.preventDefault();
		var city = '<div class="col-md-12 nopad multyflight modifil '+co+'"><div class="col-md-11 col-xs-11 xm-12 nopad left marbotom20"><div class="col-md-4 md-4 xm-12 marxm"><div class="ritsrch"><div class="inbar posrel"><span class="flightfrom"></span><input type="text" class="flyinput fromflight" placeholder="<?php echo $this->lang->line('F_W_From'); ?>" name="mfrom['+c+']" id="from'+co+'" required/></div></div></div><div class="col-md-4 md-4 xm-12 marxm"><div class="ritsrch"><div class="inbar posrel"> <span class="flighttoo"></span><input type="text" class="flyinput departflight" placeholder="<?php echo $this->lang->line('F_W_To'); ?>" name="mto['+c+']" id="to'+co+'" required /></div></div></div><div class="col-md-4 md-4 xm-12 marxm"><div class="posrel"><input type="text" class="mySelectCalenda calinput flyinput" placeholder="<?php echo $this->lang->line('F_W_Depart'); ?>" name="mdepature['+c+']" id="depature'+co+'" required/></div></div></div><div class="col-md-1 col-xs-1 xm-12"><span class="clss clsremove"><?php echo $this->lang->line('F_W_Remove'); ?></span></div></div>';
		if(co <= 4){
$('.addedCities').append(city); // end append
}else{
	$('div.addflight').hide();
	return false;
}
$('.clss').on('click', function (e) {
	e.preventDefault();
$(this).closest('div.multyflight').remove(); // remove the textbox
//$(this).next().remove (); // remove the <br>
//$(this).remove(); // remove the button
c = $( "div.multyflight" ).length;
co = c+1;
if(co <= 4){
	$('div.addflight').show();
}else{
	$('div.addflight').hide();
	return false;
}
});
call_dp(co);
});
$('.clss').on('click', function (e) {
	e.preventDefault();
$(this).closest('div.multyflight').remove(); // remove the textbox
c = $( "div.multyflight" ).length;
co = c+1;
if(co <= 4){
	$('div.addflight').show();
}else{
	$('div.addflight').hide();
	return false;
}
});
addCityPlacement();
function addCityPlacement() {
	count_city = $('.addedCities').children().length;
	if(count_city == 4) {
		$('.addflight').hide();
	}
}
function call_dp(oc){
	var ss = oc+1;
	$("#from"+oc).autocomplete({
		source: "<?php echo WEB_URL;?>/home/get_airports",
minLength: 2,//search after two characters
autoFocus: true, // first item will automatically be focused
select: function(event,ui){
	$("#to"+oc).focus();
//$(".flighttoo").focus();
}
});
	$("#to"+oc).autocomplete({
		source: "<?php echo WEB_URL;?>/home/get_airports",
minLength: 2,//search after two characters
autoFocus: true, // first item will automatically be focused
select: function(event,ui){
	$("#depature"+oc).focus();
//$(".flighttoo").focus();
}
});
	jQuery("#depature"+oc).datepicker({
		minDate: +1,
		dateFormat: 'dd/mm/yy',
		maxDate: "+1y",
		onClose: function( selectedDate ) {
			$( "#return" ).datepicker( "option", "minDate", selectedDate );
			var type = $("input:radio[name=trip_type]").val();
			console.log(type);
			$( '#from'+ss ).focus();
		}
	});
}
$('input.iradio_flat-blue').iCheck({
	radioClass: 'iradio_flat-blue'
});
$('input.serch-blue').iCheck({
	checkboxClass: 'icheckbox_flat-blue',
	radioClass: 'iradio_flat'
});
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	$('#fadeandscale, #fadeandscalereg, #fadeandscaleforget, #fadeandscaleLanguages, #adwishlist').popup({
		pagecontainer: '.container',
		transition: 'all 0.3s'
	});
	$('.mymail').click(function(){
		$(this).fadeOut(500,function(){
			$('.signupul').fadeIn(500);
		});
	});
	$('#btoblogin').click(function(){
		$('#forgotpasfix').fadeOut(500,function(){
			$('#signinfix').fadeIn(500);
		});
	});
	$('.signinfixed').click(function(){
		$('#signupfix').fadeOut(500,function(){
			$('#signinfix').fadeIn(500);
		});
	});
	$('.signupfixed').click(function(){
		$('#signinfix').fadeOut(500,function(){
			$('#signupfix').fadeIn(500);
		});
	});
	$('#forgtpsw').click(function(){
		$('#signinfix').fadeOut(500,function(){
			$('#forgotpasfix').fadeIn(500);
		});
	});
	$(function() {
		$( '#dl-menu' ).dlmenu({
			animationClasses : { classin : 'dl-animate-in-2', classout : 'dl-animate-out-2' }
		});
	});
});
</script>
<script>
$(document).ready(function() {
	$("input[type='text']").on("click",function(){
		if($(this).val()!=''){
			$(this).select();
		}
	});
});
$(function() {
	$(".fromflight").autocomplete({
		source: "<?php echo WEB_URL;?>/home/get_airports",
minLength: 2,//search after two characters
autoFocus: true, // first item will automatically be focused
select: function(event,ui){
	$(".departflight").focus();
}
});
	$(".departflight").autocomplete({
		source: "<?php echo WEB_URL;?>/home/get_airports",
minLength: 2,//search after two characters
autoFocus: true, // first item will automatically be focused
select: function(event,ui){
	$("#depature").focus();
}
});
	$("#from1").autocomplete({
		source: "<?php echo WEB_URL;?>/home/get_airports",
minLength: 2,//search after two characters
autoFocus: true, // first item will automatically be focused
select: function(event,ui){
	$("#to1").focus();
}
});
	$("#to1").autocomplete({
		source: "<?php echo WEB_URL;?>/home/get_airports",
minLength: 2,//search after two characters
autoFocus: true, // first item will automatically be focused
select: function(event,ui){
	$("#depature1").focus();
//$(".flighttoo").focus();
}
});
	jQuery( "#depature1" ).datepicker({
		minDate: 0,
		dateFormat: 'dd/mm/yy',
		maxDate: "+1y",
		onClose: function( selectedDate ) {
			$( "#depature2" ).datepicker( "option", "minDate", selectedDate );
			var type = $("input:radio[name=trip_type]").val();
			console.log(type);
			$( '#from2' ).focus();
		}
	});
	$("#from2").autocomplete({
		source: "<?php echo WEB_URL;?>/home/get_airports",
minLength: 2,//search after two characters
autoFocus: true, // first item will automatically be focused
select: function(event,ui){
	$("#to2").focus();
//$(".flighttoo").focus();
}
});
	$("#to2").autocomplete({
		source: "<?php echo WEB_URL;?>/home/get_airports",
minLength: 2,//search after two characters
autoFocus: true, // first item will automatically be focused
select: function(event,ui){
	$("#depature2").focus();
//$(".flighttoo").focus();
}
});
	jQuery( "#depature2" ).datepicker({
		minDate: 0,
		dateFormat: 'dd/mm/yy',
		maxDate: "+1y",
		onClose: function( selectedDate ) {
			$( "#depature1" ).datepicker( "option", "maxDate", selectedDate );
			$( "#depature3" ).datepicker( "option", "minDate", selectedDate );
			var type = $("input:radio[name=trip_type]").val();
			console.log(type);
			$( '#from3' ).focus();
		}
	});
});
</script>
<script type="text/javascript">
function doLogin(data){
	$('li.in').remove();
	var login = '<li class="dropdown navbar-right splli"><a data-toggle="dropdown" class="dropdown-toggle ritspl" href="#"><div class="usrwel"><img src="'+data.profile_photo+'" alt="" /></div>'+data.fname+'<b class="lightcaret mt-2"></b></a><ul class="dropdown-menu"><li><a href="<?php echo WEB_URL;?>/dashboard"><?php echo $this->lang->line('F_T_Dashboard'); ?></a></li><li><a href="<?php echo WEB_URL;?>/dashboard/bookings"><?php echo $this->lang->line('F_T_Bookings'); ?></a></li><li><a href="<?php echo WEB_URL;?>/dashboard/settings"><?php echo $this->lang->line('F_T_Settings'); ?></a></li><li><a href="<?php echo WEB_URL;?>/dashboard/support_conversation"><?php echo $this->lang->line('F_T_Support'); ?></a></li><li><a href="<?php echo WEB_URL;?>/auth/logout/Ticketfinder/'+data.rid+'/'+current_url+'"><?php echo $this->lang->line('F_T_Logout'); ?></a></li></ul></li>';
	$(login).appendTo('ul.simnavrit');
}
</script>
<script id="CartTpl" type="text/template">
{{#isCart}}<div class="carthed"><strong><?=lang('SHOPPING_CART');?> <b>({{count}})</b></strong><div class="cartiming"><span class="icon icon-clock-o"></span></div></div><ul>{{#cart}}<li class="cartlistingli {{RID}}"><div class="cartlisting"><div class="cartitem"><div class="bookingiconcart p_{{TYPE}}"></div><div class="col-md-3 celcart imagecart"><a href="{{URL}}" class="carthtlimg"><img src="{{IMAGE}}" alt=""/></a></div><div class="col-md-7 splcrtpad celcart"><div class="carttitle">{{NAME}}</div><div class="cartsec">{{ADDRESS}}</div></div><div class="col-md-2 cartfprice celcart"><div class="cartprc"><div class="removecart" data-rid="{{RID}}" data-cid="{{CID}}" data-refid="{{REF_ID}}"><img src="<?php echo ASSETS;?>images/delete_old.png" alt="" /></div><div class="singecartprice"><?php echo $this->display_icon;?>{{TOTAL}}</div></div></div></div></div></li>{{/cart}}</ul>
<div class="clear"></div><br /><br /><div class="clear"></div><div class="doedline"></div><div class="col-md-8"><div class="cartlabel textalrt"><?=lang('TOTAL');?></div></div><div class="col-md-4"><div class="cartcntamnt bigclrfnt"><?php echo $this->display_icon;?>{{GRAND_TOTAL}}</div></div><div class="clear"></div><div class="doedline"></div><div class="prcdtochk">  <div class="col-md-6"><a href="<?php echo WEB_URL;?>" target="_blank" class="cartlabelcon"><?=lang('CONTINUE_SHPPPING');?></a></div><div class="col-md-6"><a href="{{C_URL}}" class="procedcheckout"><strong><?=lang('PROCEED_TO_SECURE');?></strong><?=lang('C_CHECKOUT');?></a></div></div>{{/isCart}}{{^isCart}}<div class="carthed"><strong><?php echo $this->lang->line('F_C_cart'); ?><b>({{count}})</b></strong><div class="cartiming"><span class="icon icon-clock-o"></span></div></div><div class="clear"></div>{{/isCart}}</script>