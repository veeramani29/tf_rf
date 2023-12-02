<?php $language = $this->session->userdata('language');
if($language){ $this->lang->load('Footer_F', $language); }else{ $this->lang->load('Footer_F', 'english');  } 
$controller = $this->router->fetch_class(); $method = $this->router->fetch_method(); $current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';	$current_url = $this->config->site_url().$this->uri->uri_string(). $current_url; $current_url = base64_encode($current_url); ?>
<div class="clear"></div>

<div class="row clearfix footer text-left bg-white">
	<div class="main">
		<div class="col-md-3 column">
			<span class="footer-title">Ontdek</span>
			<ul class="footer-list">
				<li><a href="http://192.168.0.157/ticketfinder/"><span class="glyphicon glyphicon-play"></span>Vluchten</a></li>
				<li><a href="hotel"><span class="glyphicon glyphicon-play"></span>Hotels</a></li>
				<li><a href="car"><span class="glyphicon glyphicon-play"></span>Autohuur</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-play"></span>Excursies</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-play"></span>City Guides</a></li>
				<li><a href="site/landing/faq"><span class="glyphicon glyphicon-play"></span>FAQ</a></li>
				<li><a href="site/landing/services"><span class="glyphicon glyphicon-play"></span>Services</a></li>
				
				
				
			</ul>
		</div>
		<div class="col-md-3 column" >
			<span class="footer-title">Bedrijf</span>
			<ul class="footer-list">
				<li><a href="pages/privacy-policy"><span class="glyphicon glyphicon-play"></span>Privacy Policy</a></li>
				<li><a href="pages/press-releases"><span class="glyphicon glyphicon-play"></span>Press Releases</a></li>
				<li><a href="pages/over-ons"><span class="glyphicon glyphicon-play"></span>Over ons</a></li>
				<li><a href="pages/jobs"><span class="glyphicon glyphicon-play"></span>Jobs</a></li>
				<li><a href="pages/cookies"><span class="glyphicon glyphicon-play"></span>Cookies</a></li>
				<li><a href="about"><span class="glyphicon glyphicon-play"></span>Over Ons</a></li>
				<li><a href="contact-us"><span class="glyphicon glyphicon-play"></span>Contact Us</a></li>
			</ul>
		</div>
		<div class="col-md-3 column">
			<div class="row clearfix">
				<div class="col-md-12 column">
					<span class="footer-title">Betalingsmogelijkheden</span>
					<ul class="footer-list newlisting">
						<li><a href="javascript:void(0);"><span class="fb1"></span></a></li>
						<li><a href="javascript:void(0);"><span class="fb2"></span></a></li>
						<li><a href="javascript:void(0);"><span class="fb3"></span></a></li>
						<li><a href="javascript:void(0);"><span class="fb4"></span></a></li>
						<li><a href="javascript:void(0);"><span class="fb5"></span></a></li>
						<li><a href="javascript:void(0);"><span class="fb6"></span></a></li>
					</ul>
				</div>
			</div>
			<div class="row clearfix">
				<div class="col-md-12 column">
					<span class="footer-title">Certificering</span>
					<ul class="footer-list newlisting">
						<li><a href="javascript:void(0);"><span class="fb7"></span></a></li>
						<li><a href="javascript:void(0);"><span class="fb8"></span></a></li>
						<li><a href="javascript:void(0);"><span class="fb9"></span></a></li>
						<li><a href="javascript:void(0);"><span class="fb10"></span></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-3 column">
			<div class="row clearfix">
				
				
				<div class="col-md-12 column"><span class="footer-title">100% Ticket Finder Garantie</span>
					<p class="p-sector">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massaidp nequetiam lore elerisque.</p>
					<h2 class="footer-tags">06-86-1-HALLO</h2>
					<a class="footer-mail" href="mailto:hallo@ticketfinder.nl"> hallo@ticketfinder.nl</a></div>					       </div>
					<div class="row clearfix">
						<div class="col-md-12 column">
							<ul class="footer-list newlisting2">
								<li><a target="_blank" href=""><span class="fb11"></span></a></li>
								<li><a target="_blank" href=""><span class="fb12"></span></a></li>
								<li><a target="_blank" href=""><span class="fb13"></span></a></li>
								<li><a target="_blank" href=""><span class="fb14"></span></a></li>
								<li><a target="_blank" href=""><span class="fb15"></span></a></li>
								<li><a target="_blank" href=""><span class="fb16"></span></a></li>
								<li><a target="_blank" href=""><span class="fb17"></span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>   
		</div>
		<div class="row clearfix footer-bottom">
			<div class="main">
				<a href="#top" class="last-bottom-a scroll"></a>
				<span class="last-bottom"></span>
			</div>
		</div>
		<div class="clear"></div>
		<div class="maskofcart"></div>
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
		<div class="emptymsg"><?php echo $this->lang->line('F_Cart_Empty'); ?></div>
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
echo anchor_popup('auth/login/Facebook/login','<span class="icon icon-facebook"></span>
	<div class="mensionsoc">'.$this->lang->line('F_L_FB').'</div>', $atts);
$atts['class'] = 'logspecify tweetcolor';
echo anchor_popup('auth/login/Twitter/login','<span class="icon icon-twitter"></span>
	<div class="mensionsoc">'.$this->lang->line('F_L_TW').'</div>', $atts);
$atts['class'] = 'logspecify gpluses';
echo anchor_popup('auth/login/Google/login','<span class="icon icon-google-plus"></span>
	<div class="mensionsoc">'.$this->lang->line('F_L_GP').'</div>', $atts);
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
<?php $bb =  $background; ?>
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
<script>
	$val_required ="<?php echo $this->lang->line('F_VL_Required'); ?>";
	$val_remote ="<?php echo $this->lang->line('F_VL_Fix'); ?>";
	$val_email ="<?php echo $this->lang->line('F_VL_Email'); ?>";
	$val_url ="<?php echo $this->lang->line('F_VL_URL'); ?>";
	$val_date ="<?php echo $this->lang->line('F_VL_Date'); ?>";
	$val_number ="<?php echo $this->lang->line('F_VL_Number'); ?>";
	$val_digits ="<?php echo $this->lang->line('F_VL_Digit'); ?>";
	$val_equalTo ="<?php echo $this->lang->line('F_VL_Same'); ?>";
	$val_maxlength ="<?php echo $this->lang->line('F_VL_Max'); ?>";
	$val_minlength ="<?php echo $this->lang->line('F_VL_Min'); ?>";
	$val_rangelength ="<?php echo $this->lang->line('F_VL_RangeL'); ?>";
	$val_range ="<?php echo $this->lang->line('F_VL_Range'); ?>";
	$val_less ="<?php echo $this->lang->line('F_VL_L'); ?>";
	$val_greater ="<?php echo $this->lang->line('F_VL_G'); ?>";
</script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/validate/jquery.validate.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/validate/custom.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/general.js"></script>
<script type='text/javascript' src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/icheck.js?v=1.0.2"></script>
<script type="text/javascript" src="<?php echo ASSETS;?>js/mustache.js" ></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/cart.js"></script>
<script>
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
		dateFormat: 'dd-mm-yy',
		maxDate: "+1y",
		onClose: function( selectedDate ) {
			$( "#return" ).datepicker( "option", "minDate", selectedDate );
			var type = $("input:radio[name=trip_type]").val();
			console.log(type);
			$( '#from'+ss ).focus();
		}
	});
}
$(document).ready(function(){
	$('.btool').tooltip();
	$('.multicity').find('.multi_adt, .multi_chd, .multi_inf').attr('disabled', 'disabled');
	$('input.iradio_flat-blue').iCheck({
		radioClass: 'iradio_flat-blue'
	});
	$('.triprad').on('ifChecked', function(event){
		
		if ($(this).val() == 'oneway'){
			$('.multicity').fadeOut(10, function(){
				$('.normal').fadeIn(100);
			});
			$('.multicity').find('.multi_adt, .multi_chd, .multi_inf').attr('disabled', 'disabled');
			$('#return').prop('disabled',true);
			$('#return').prop('required',false);
			$('#return').parent().addClass('ifonway');
		}
		if ($(this).val() == 'circle'){
			$('.multicity').fadeOut(10, function(){
				$('.multicity').find('.multi_adt, .multi_chd, .multi_inf').attr('disabled', 'disabled');
				$('.normal').fadeIn(100);
			});
			$('#return').prop('disabled',false);
			$('#return').prop('required',true);
			$('#returnDiv').removeClass('ifonway');
		}
		if ($(this).val() == 'multicity'){ 
			$('.normal').fadeOut(10, function(){
				$('.multicity').fadeIn(100);
			});
			$('.multicity').find('.multi_adt, .multi_chd, .multi_inf').removeAttr('disabled');
			$('#return').prop('disabled',true);
			$('#return').prop('required',false);
			$('#returnDiv').removeClass('ifonway');
		}
	});
});
</script>
<script type="text/javascript">	
	$(function($){
		var val = $("#showBackgroundBanner").val();
		$.supersized({
			slide_interval          :   3000,
			transition              :   1, 
			transition_speed		:	700,						
			slide_links				:	'blank',
			slides 					:  	[	
			// Slideshow Images					
			{image:WEB_URL+'/admin/upload_files/home/portfolio/o-COUPLE-TRAVEL-facebook.jpg'},	
			{image:WEB_URL+'/admin/upload_files/home/portfolio/travel-in-europe.jpg'},	
			
			]
		});
	});
	$(document).ready(function() {
		initialize();
		$('#fadeandscale, #fadeandscalereg, #fadeandscaleforget, #fadeandscaleLanguages').popup({
			pagecontainer: '.container',
			transition: 'all 0.3s'
		});
		
		$('.mymail').click(function(){
			$(this).fadeOut(500,function(){
				$('.signupul').fadeIn(500);
			});
			
		});
		$("#owl-demo").owlCarousel({
			items : 4,
			itemsDesktop : [1199,4],
			itemsDesktopSmall : [979,3],
			lazyLoad : true,
			pagination : false,
			navigation : true
		});
	});
</script>
<script>
	$(function() {
		$(".fromflight").autocomplete({
			//alert(1);
			source: "<?php echo WEB_URL;?>/home/get_airports",
			minLength: 2,//search after two characters
			autoFocus: true, // first item will automatically be focused
			select: function(event,ui){
				$(".departflight").focus();
				$(".flighttoo").focus();
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
				//$(".flighttoo").focus();
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
		
		

		jQuery( "#cdepature" ).datepicker({
			minDate: +1,
			dateFormat: 'dd-mm-yy',
			maxDate: "+1y",
			onClose: function( selectedDate ) {
				$( "#creturn" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		jQuery( "#creturn" ).datepicker({
			minDate: +1,
			dateFormat: 'dd-mm-yy',
			maxDate: "+1y",
			onClose: function( selectedDate ) {
			//$( "#cdepature" ).datepicker( "option", "minDate", selectedDate );
		}
	});
		$(".vac_city").autocomplete({
			source: "<?php echo WEB_URL;?>/home/get_hotel_city_suggestions",
		minLength: 2,//search after two characters
		autoFocus: true, // first item will automatically be focused
		select: function(event,ui){
			$("#vac_type").focus();
				//$(".flighttoo").focus();
			}
		});
		$("#vac_type").change(function () {
			$("#vac_date").focus();
		});
		jQuery( "#vac_date" ).datepicker({
			minDate: +1,
			dateFormat: 'dd-mm-yy',
			maxDate: "+1y",
			onClose: function( selectedDate ) {
				$('#vacations').submit();
			}
		});
	});
</script>
<script type="text/javascript">
	function doLogin(data){
		$('li.in').remove();
		var login = '<li class="dropdown navbar-right splli"><a data-toggle="dropdown" class="dropdown-toggle ritspl" href="#"><div class="usrwel"><img src="'+data.profile_photo+'" alt="" /></div>'+data.fname+'<b class="lightcaret mt-2"></b></a><ul class="dropdown-menu"><li><a href="<?php echo WEB_URL;?>/dashboard"><?php echo $this->lang->line('F_T_Dashboard'); ?></a></li><li><a href="<?php echo WEB_URL;?>/dashboard/bookings"><?php echo $this->lang->line('F_T_Bookings'); ?></a></li><li><a href="<?php echo WEB_URL;?>/dashboard/wishlist"><?php echo $this->lang->line('F_T_Wishlist'); ?></a></li><li><a href="<?php echo WEB_URL;?>/dashboard/settings"><?php echo $this->lang->line('F_T_Settings'); ?></a></li><li><a href="<?php echo WEB_URL;?>/dashboard/inbox"><?php echo $this->lang->line('F_T_Inbox'); ?></a></li><li><a href="<?php echo WEB_URL;?>/dashboard/support_conversation"><?php echo $this->lang->line('F_T_Support'); ?></a></li><li><a href="<?php echo WEB_URL;?>/auth/logout/InnoGlobe/'+data.rid+'/'+current_url+'"><?php echo $this->lang->line('F_T_Logout'); ?></a></li></ul></li>';
		$(login).appendTo('ul.simnavrit');
	}
	$("#hotel_autocomplete").autocomplete({
		source: "<?php echo WEB_URL;?>/hotel/get_hotel_city_suggestions",
		minLength: 2,//search after two characters
		autoFocus: true, // first item will automatically be focused
		select: function(event,ui){
			
		}
	});
</script>
<script id="CartTpl" type="text/template">
	{{#isCart}}<div class="carthed"><strong><?php echo $this->lang->line('F_C_cart'); ?> <b>({{count}})</b></strong><div class="cartiming"><span class="icon icon-clock-o"></span></div></div><ul>{{#cart}}<li class="cartlistingli {{RID}}"><div class="cartlisting"><div class="cartitem"><div class="bookingiconcart p_{{TYPE}}"></div><div class="col-md-3 celcart imagecart"><a href="{{URL}}" class="carthtlimg"><img src="{{IMAGE}}" alt=""/></a></div><div class="col-md-7 splcrtpad celcart"><div class="carttitle">{{NAME}}</div><div class="cartsec">{{ADDRESS}}</div></div><div class="col-md-2 cartfprice celcart"><div class="cartprc"><div class="removecart" data-rid="{{RID}}" data-cid="{{CID}}" data-refid="{{REF_ID}}"><img src="<?php echo ASSETS;?>images/delete_old.png" alt="" /></div><div class="singecartprice"><?php echo $this->display_icon;?>{{TOTAL}}</div></div></div></div></div></li>{{/cart}}</ul>
	<div class="clear"></div><br /><br /><div class="clear"></div><div class="doedline"></div><div class="col-md-8"><div class="cartlabel textalrt"><?php echo $this->lang->line('F_C_total'); ?></div></div><div class="col-md-4"><div class="cartcntamnt bigclrfnt"><?php echo $this->display_icon;?>{{GRAND_TOTAL}}</div></div><div class="clear"></div><div class="doedline"></div><div class="prcdtochk">  <div class="col-md-6"><a class="cartlabelcon"><?php echo $this->lang->line('F_C_continue_shopping'); ?></a></div><div class="col-md-6"><a href="{{C_URL}}" class="procedcheckout"><strong><?php echo $this->lang->line('F_C_process'); ?></strong><?php echo $this->lang->line('F_C_checkout'); ?></a></div></div>{{/isCart}}{{^isCart}}<div class="carthed"><strong><?php echo $this->lang->line('F_C_cart'); ?><b>({{count}})</b></strong><div class="cartiming"><span class="icon icon-clock-o"></span></div></div><div class="clear"></div>{{/isCart}}</script>
