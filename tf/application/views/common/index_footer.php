<?php $language = $this->session->userdata('language');
if($language){ $this->lang->load('Footer_F', $language); }else{ $this->lang->load('Footer_F', 'english');  }
$controller = $this->router->fetch_class(); $method = $this->router->fetch_method(); $current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';	$current_url = $this->config->site_url().$this->uri->uri_string(). $current_url; $current_url = base64_encode($current_url); ?>
<?php $social_links = $this->Help_Model->getsocial_links();
$footerlinks = $this->Help_Model->getAllFooterLinks();
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
						<li>
							<a <?php echo $static_open;?> >
								<span class="glyphicon glyphicon-play"></span><?php echo $footer->$language; ?>
							</a>
						</li>
						<?php
					}
				} ?>
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
						<li>
							<a <?php echo $static_open;?> >
								<span class="glyphicon glyphicon-play"></span>
								<?php echo $footer->$language; ?>
							</a>
						</li>
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
			<div class="row clearfix">
				<div class="col-md-12 column">
					<span class="footer-title"><?=lang('ROW5_HEADING');?></span>
				</div>					       
			</div>
			<div class="row clearfix">
				<div class="col-md-12 column">
					<ul class="footer-list newlisting2">
						<?php if($social_links->twitter){ ?>
						<li><a target="_blank" href="<?php echo $social_links->twitter;?>"><span class="fb11"></span></a></li>
						<?php } if($social_links->google){ ?>
						<li><a target="_blank" href="<?php echo $social_links->google;?>"><span class="fb12"></span></a></li>
						<?php } if($social_links->facebook){ ?>
						<li><a target="_blank" href="<?php echo $social_links->facebook;?>"><span class="fb13"></span></a></li>
						<?php  } if($social_links->linkedin){  ?>
						<li><a target="_blank" href="<?php echo $social_links->linkedin;?>"><span class="fb14"></span></a></li>
						<?php  } if($social_links->vimeo){  ?>
						<li><a target="_blank" href="<?php echo $social_links->vimeo;?>"><span class="fb15"></span></a></li>
						<?php  } if($social_links->dribbble){  ?>
						<li><a target="_blank" href="<?php echo $social_links->dribbble;?>"><span class="fb16"></span></a></li>
						<?php  } if($social_links->flickr){  ?>
						<li><a target="_blank" href="<?php echo $social_links->flickr;?>"><span class="fb17"></span></a></li>
						<?php  }  ?>
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
	<div class="mensionsoc"><span class="fa fa-facebook fa-lg fa-fw color-white"></span>'.$this->lang->line('F_L_FB').'</div>', $atts);
$atts['class'] = 'logspecify tweetcolor';
echo anchor_popup('auth/login/Twitter/login','
	<div class="mensionsoc"><span class="fa fa-twitter fa-lg fa-fw color-white"></span>'.$this->lang->line('F_L_TW').'</div>', $atts);
$atts['class'] = 'logspecify gpluses';
echo anchor_popup('auth/login/Google/login','
	<div class="mensionsoc"><span class="fa fa-google-plus fa-lg fa-fw color-white"></span>'.$this->lang->line('F_L_GP').'</div>', $atts);
	?>
</div>
<div class="centerpul"><div class="orbar"><strong><?php echo $this->lang->line('F_L_Or'); ?></strong></div></div>
<form id="login" name="login" action="<?php echo WEB_URL;?>/account/login">
	<div class="ritpul">
		<div class="rowput"><span class="icon glyphicon-envelope"></span><input class="form-control logpadding" type="email" name="email" placeholder="<?php echo $this->lang->line('F_L_Email'); ?>" required /></div>
		<div class="rowput"><span class="icon icon-lock"></span><input class="form-control logpadding" type="password" name="password" id="pswd" placeholder="<?php echo $this->lang->line('F_L_Password'); ?>" required /><div class="errMsg"></div>
	</div>
	<div class="misclog"><a class="fadeandscale_close fadeandscaleforget_open forgota" id="forgtpsw"><?php echo $this->lang->line('F_L_Forgot'); ?></a></div>
	<div class="clear"></div><button class="submitlogin"><?php echo $this->lang->line('F_L_Login'); ?></button><div class="clear"></div>
	<div class="dntacnt"><?php echo $this->lang->line('F_L_dont'); ?><a class="fadeandscale_close fadeandscalereg_open"><?php echo $this->lang->line('F_L_Sign_Up'); ?></a> </div>
</div>
</form>
</div>
</div>
</div>
<div id="fadeandscaleforget" class="wellme" style="display:none;">
	<div class="popuperror" style="display:none;"></div>
	<div  class="pophed"><?php echo $this->lang->line('F_L_Reset'); ?></div>
	<div class="signdiv">
		<div class="formcontnt"><?php echo $this->lang->line('F_L_Reset_S'); ?></div>
		<form id="forgetpwd" name="forgetpwd" action="<?php echo WEB_URL;?>/account/forgetpwd">
			<div class="ritpul">
				<div class="rowput">
					<span class="icon glyphicon-envelope"></span>
					<input class="form-control logpadding" type="email" name="email" placeholder="Email Address" required>
				</div>
				<div class="clear"></div>
				<button class="submitlogin"><?php echo $this->lang->line('F_L_Reset_link'); ?></button>
				<div class="clear"></div>
				<div class="dntacnt"><?php echo $this->lang->line('F_L_Remember'); ?><a class="fadeandscaleforget_close fadeandscale_open"><?php echo $this->lang->line('F_L_SignIn'); ?></a> </div>
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
		$atts['class'] = 'logspecify facecolor';
		echo anchor_popup('auth/login/Facebook/up','<span class="icon icon-facebook"></span>
			<div class="mensionsoc">'.$this->lang->line('F_S_FB').'</div>', $atts);
		$atts['class'] = 'logspecify tweetcolor';
		echo anchor_popup('auth/login/Twitter/up','<span class="icon icon-twitter"></span>
			<div class="mensionsoc">'.$this->lang->line('F_S_TW').'</div>', $atts);
		$atts['class'] = 'logspecify gpluses';
		echo anchor_popup('auth/login/Google/up','<span class="icon icon-google-plus"></span>
			<div class="mensionsoc">'.$this->lang->line('F_S_GP').'</div>', $atts);
			?>
		</div>
		<div class="centerpul"><div class="orbar"><strong><?php echo $this->lang->line('F_L_Or'); ?></strong></div></div>
		<a class="logspecify mymail"><span class="icon icon-envelope"></span><div class="mensionsoc"><?php echo $this->lang->line('F_S_SE'); ?></div></a>
		<form id="registration" name="registration" action="<?php echo WEB_URL;?>/account/create">
			<div class="signupul">
				<div class="rowput"><span class="icon icon-user"></span><input class="form-control logpadding" type="text" name="fname" placeholder="<?php echo $this->lang->line('F_S_fname'); ?>" minlength="4" required/></div>
				<div class="rowput"><span class="icon icon-user"></span><input class="form-control logpadding" type="text" name="mname" placeholder="Middle Name" minlength="4" required /></div>
				<div class="rowput"><span class="icon icon-user"></span><input class="form-control logpadding" type="text" name="lname" placeholder="<?php echo $this->lang->line('F_S_lname'); ?>" minlength="1" required/></div>
				<div class="rowput"><span class="icon glyphicon-envelope"></span><input class="form-control logpadding" type="email" name="email" placeholder="<?php echo $this->lang->line('F_S_email'); ?>" required/></div>
				<div class="rowput"><span class="icon icon-lock"></span><input class="form-control logpadding" type="password" name="password" id="password" placeholder="<?php echo $this->lang->line('F_S_pass'); ?>" minlength="5" maxlength="50" required/></div>
				<div class="rowput"><span class="icon icon-lock"></span><input class="form-control logpadding" type="password" name="cpassword" placeholder="<?php echo $this->lang->line('F_S_cpass'); ?>" required/></div>
				<div class="clear"></div>
				<div class="signupterms"><?php echo $this->lang->line('F_S_agree'); ?><a target="_blank" href="<?php echo WEB_URL.'/terms-of-service'; ?>"><?php echo $this->lang->line('F_S_terms'); ?></a>,<a target="_blank"  href="<?php echo WEB_URL.'/privacy-policy'; ?>"><?php echo $this->lang->line('F_S_pp'); ?></a>, <a target="_blank"  href="<?php echo WEB_URL.'/guest-refund-policy'; ?>"><?php echo $this->lang->line('F_S_gp'); ?></a>, <?php echo $this->lang->line('F_S_and'); ?> <a target="_blank"  href="<?php echo WEB_URL.'/host-guarantee-terms'; ?>"><?php echo $this->lang->line('F_S_hg'); ?></a>.</div><div class="clear"></div>
				<input type="submit" class="submitlogin" value="<?php echo $this->lang->line('F_S_signup'); ?>" name="Sign up"/>
			</div>
		</form>
		<div class="clear"></div>
		<div class="dntacnt"><?php echo $this->lang->line('F_S_already_member'); ?><a class="fadeandscalereg_close fadeandscale_open"><?php echo $this->lang->line('F_L_SignIn'); ?></a> </div>
	</div></div>
</div>
<?php }?>
<link rel="stylesheet" href="<?php echo ASSETS;?>css/_all.css" type="text/css"/>
<link rel="stylesheet" href="<?php echo ASSETS;?>css/blue.css" type="text/css"/>
<script type='text/javascript' src="<?php echo ASSETS;?>js/jquery-ui.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/jquery.easing.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/js-index3.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/functions.js"></script>
<script type="text/javascript" src="<?php echo ASSETS;?>js/jquery.themepunch.revolution.min.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/jquery.nicescroll.min.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/jquery.carouFredSel-6.2.1-packed.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/helper-plugins/jquery.touchSwipe.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS;?>js/helper-plugins/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS;?>js/helper-plugins/jquery.transit.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS;?>js/helper-plugins/jquery.ba-throttle-debounce.min.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/bootstrap.min.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/owl.carousel.js"></script>
<script type="text/javascript" src="<?php echo ASSETS;?>js/backslider.js"></script>
<script type="text/javascript" src="<?php echo ASSETS;?>js/backslider2.js"></script>
<script type="text/javascript" src="<?php echo ASSETS;?>js/jquery.popupoverlay.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/jquery.cookie.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/roomval.js"></script>

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

<script type='text/javascript' src="<?php echo ASSETS;?>js/jquery.yiiactiveform.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/validation.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/validate/jquery.validate.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/validate/custom.js"></script>

<script type='text/javascript' src="<?php echo ASSETS;?>js/general.js"></script>
<!--<script type='text/javascript' src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>-->
<script type='text/javascript' src="<?php echo ASSETS;?>js/icheck.js?v=1.0.2"></script>
<script type="text/javascript" src="<?php echo ASSETS;?>js/mustache.js" ></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/cart.js"></script>
<script>
$(document).ready(function() {
	$("input[type='text']").on("click",function(){
		if($(this).val()!=''){
			$(this).select();
		}
	});
	$('.whywe').on('click', function(e){
		e.preventDefault();
		var title=$(this).find('h3.hotel-titles').text();
		$('#whyweModal').find('.modal-body a').hide();
		$('#whyweModal').find('.modal-title').text(title);
		var thiscontent=$(this).find( "div.thiscontainer" ).html();
		$('#whyweModal').find('.modal-body').html(thiscontent);
		$('#whyweModal').modal('show');
	});
});
$(function() {
	$(".fromflight").autocomplete({
//alert(1);
source: "<?php echo WEB_URL;?>/home/get_airports",
minLength: 2,//search after two characters
autoFocus: true, // first item will automatically be focused
select: function(event,ui){
	$(this).closest('div').next().find('input').focus();
}
});
	$(".departflight").autocomplete({
		source: "<?php echo WEB_URL;?>/home/get_airports",
minLength: 2,//search after two characters
autoFocus: true, // first item will automatically be focused
select: function(event,ui){
	$(this).closest('div').next().find('input').focus();
}
});
});
</script>
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
			$("#from2").focus();
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
			$("#from3").focus();
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
			$("#from4").focus();
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
//$('#multi_city_select').hide();
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
	$('#return').val('');
}else if($(this).find('a').html() == 'Round Trip'){
	$('#trip_type').val("circle");
	$('#multi_city_select').hide();
	$("#one-round").show();
	$('#return').prop('disabled',false);
	$("div#one-round :input").prop("disabled", false);
}else{
//$('#flight')[0].reset();
$('#multi_city_select').find('input[name^=m]').val('');
$('#trip_type').val("multicity");
$("div#one-round :input").prop("disabled", true);
$("div.multi-city select").prop("disabled", false);
$('#return').val('');
var arr_hide = new Array();
for(i = 2; i < 4; i++){
	arr_hide.push('.multi_city_'+i);
	$('.multi_city_'+i+' input[type="text"]').val('');
}
$('.multi_city_0 input[type="text"]').val('');
$('#remove_multi_1').hide();
$('#add_multi_1').show();
$(''+arr_hide).hide();
$("#one-round").hide();
$('#multi_city_select').show();
}
$('.dropdown.open').removeClass('open');
$('.dropdown-menu').hide();
});
$('.wayselection').mouseover(function(){
	$('.dropdown-menu').show();
});
</script>
<script>
$( document ).ready(function() {
	var passenger_count = parseInt($('#infant').val()) + parseInt($('#child').val()) + parseInt($('#adult').val());
	$('#property').val(passenger_count);
});
$('#adult').on('change',function(){
	var adult_count = parseInt($('#infant').val()) + parseInt($('#child').val()) + parseInt($('#adult').val());
	$('#property').val(adult_count);
});
$('#child').on('change',function(){
	var child_count = parseInt($('#infant').val()) + parseInt($('#child').val()) + parseInt($('#adult').val());
	$('#property').val(child_count);
});
$('#infant').on('change',function(){
	var infant_count = parseInt($('#infant').val()) + parseInt($('#child').val()) + parseInt($('#adult').val());
	$('#property').val(infant_count);
});
$( document ).ready(function() {
	var passenger_count = parseInt($('#infant1').val()) + parseInt($('#child1').val()) + parseInt($('#adult1').val());
	$('#property1').val(passenger_count);
});
$('#adult1').on('change',function(){
	var adult_count = parseInt($('#infant1').val()) + parseInt($('#child1').val()) + parseInt($('#adult1').val());
	$('#property1').val(adult_count);
});
$('#child1').on('change',function(){
	var child_count = parseInt($('#infant1').val()) + parseInt($('#child1').val()) + parseInt($('#adult1').val());
	$('#property1').val(child_count);
});
$('#infant1').on('change',function(){
	var infant_count = parseInt($('#infant1').val()) + parseInt($('#child1').val()) + parseInt($('#adult1').val());
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
	$('.multi_city_'+next_id).show();
	if(next_id < 4){
		if(cur_id==1){
			$('#add_multi_'+next_id).show();
			$('#remove_multi_'+cur_id).show();
			$('#remove_multi_'+next_id).hide();
			$('#add_multi_'+cur_id).hide();
//$(this).hide();
}else{
	$('#add_multi_'+cur_id).hide();
	$('#remove_multi_'+cur_id).show();
//$(this).hide();
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWRj7iijpG2w3xNlYk-FDuYln1MgtIurs"
  type="text/javascript"></script>
<script type="text/javascript">
function createPagination() {}
function createListingPagination() {}
function createReservationHistoryPagination() {}
function BookingPagination() {}
function createRvwPagination() {}
function createRefByYouPagination() {}
</script>