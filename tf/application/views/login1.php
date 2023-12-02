
<style>
	.lg_popuperror{
		background: none repeat scroll 0 0 red;
		color: #FFFFFF;
		display: block;
		font-size: 13px;
		margin: 0px 208px 10px;
		overflow: hidden;
		padding: 10px;
		text-align: center;
	}
	.signdiv .orbit {
		background: whitesmoke;
		border-radius: 100%;
		padding: 7.5px;
		margin-top: 5rem;
	}
</style>
<script>
	(function($){
		$(function(){
			$('input[type="radio"][name="login"]').on('click', function() {
				if($('#user-login').prop('checked')) {
					$('#plpassword').prop("disabled",false);
					$('#plphoneno').prop("disabled",true);
					$('#plphoneno').removeAttr("required");
					$('#plphoneno').removeAttr("aria-required");
					$("#plpassword").val("");
					$('.plpassword').show();
					$('.plphoneno').hide();
				} else {
					$('#plphoneno').prop("disabled",false);
					$('#plpassword').prop("disabled",true);
					$('#plpassword').removeAttr("required");
					$('#plpassword').removeAttr("aria-required");
					$("#plpassword").val("");
					$('.plpassword').hide();
					$('.plphoneno').show();
				}
			});
		});
	})(jQuery);
</script>
<div class="lg_popuperror" style="display:none;"></div>
<div class="signdiv">
	<div class="row">
		<div class="col-md-5">
			<div class="ritpul">
				<div class="form-group">
					<label class="radio-inline">
						<input type="radio" name="login" id="user-login" checked> Already a user
					</label>
					<label class="radio-inline">
						<input type="radio" name="login"> Continue as a guest
					</label>
				</div>
				<div class="rowput form-group">
					<span class="icon glyphicon-envelope"></span>
					<input class="form-control logpadding" type="email" name="email" id="plemail" placeholder="Email Address" required>
				</div>
				<div class="rowput form-group plpassword">
					<span class="icon icon-lock"></span>
					<input class="form-control logpadding" type="password" name="password" id="plpassword" placeholder="Password" required >
				</div>
				<div class="rowput form-group plphoneno" style="display:none;">
					<span class="icon icon-phone"></span>
					<input class="form-control logpadding" type="tel" name="phoneno" id="plphoneno" placeholder="Phone Number" required disabled>
				</div>
				<div class="misclog">
					<a class="rember"><input type="checkbox" />Remember me</a>
					<a class="fadeandscale_close fadeandscaleforget_open forgota" id="forgtpsw">Forgot password?</a>
				</div>
				<div class="clear"></div>
				<div class="clear"></div>
				<div class="dntacnt">Don't have an account? <a class="fadeandscale_close fadeandscalereg_open">Sign up</a> </div>
			</div>
		</div>
		<div class="col-md-1 hidden-xs hidden-sm hidden-md">
			<div class="orbit">
				<b>Or</b>
			</div>
		</div>
		<div class="col-md-5">
			<div class="leftpul">
				<?php
				$atts = array(
					'width'      => '600',
					'height'     => '600',
					'scrollbars' => 'yes',
					'status'     => 'yes',
					'resizable'  => 'yes',
					'screenx'   =>  '\'+((parseInt(screen.width) - 600)/2)+\'',
					'screeny'   =>  '\'+((parseInt(screen.height) - 600)/2)+\'',
					);
				$atts['class'] = 'logspecify facecolor';
				echo anchor_popup('auth/login/Facebook/login','<span class="icon icon-facebook"></span>
					<div class="mensionsoc">Login with Facebook</div>', $atts);
				$atts['class'] = 'logspecify tweetcolor';
				echo anchor_popup('auth/login/Twitter/login','<span class="icon icon-twitter"></span>
					<div class="mensionsoc">Login with Twitter</div>', $atts);
				$atts['class'] = 'logspecify gpluses';
				echo anchor_popup('auth/login/Google/login','<span class="icon icon-google-plus"></span>
					<div class="mensionsoc">Login with Google Plus</div>', $atts);
					?>
				</div>
			</div>
		</div>
	</div>
