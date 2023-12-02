<?php $this->load->view('common/header');?>

<div class="full onlycontent marintopcntpage">
<div class="container martopbtm">

<div class="centerfix" style="display:none;">
  <div class="wrapdivs" id="forgotpasfix">
  <div class="popuperror" style="display:none;"></div>
  <div  class="pophed">Reset Your Password</div>
    <div class="signdiv">
        
        <form id="resetpwd" name="resetpwd" action="<?php echo WEB_URL;?>/account/resetpwd">
           <div class="ritpul"> 
              <div class="rowput">
                <span class="icon icon-lock"></span>
                <input type="hidden" name="email" value="">
                <input class="form-control logpadding" type="password" name="password" id="npassword" placeholder="New Password" minlength="5" maxlength="50" required/>
              </div>
              <div class="rowput">
                <span class="icon icon-lock"></span>
                <input class="form-control logpadding" type="password" name="cpassword" placeholder="Confirm Password" required/>
              </div>
              <div class="clear"></div>
              <button class="submitlogin">Save & Continue</button>
              <div class="clear"></div>
              <div class="dntacnt">Suddenly remeber password?  
                <a class="fadeandscaleforget_close fadeandscale_open" id="btoblogin">Sign in</a> </div>
          </div>
          </form>
        </div>
    </div>

    <div class="wrapdivs" id="signupfix">
      <div class="popuperror" style="display:none;"></div>
      <div  class="pophed">Signup</div>
        <div class="signdiv">
            <div class="insigndiv">
            <form id="registration" name="registration" action="<?php echo WEB_URL;?>/account/create">
             <div class="signupul22"> 
                <div class="rowput">
                  <span class="icon icon-user"></span>
                  <input class="form-control logpadding" type="text" name="fname" placeholder="First name" minlength="5" required/>
                </div>
                <div class="rowput">
                  <span class="icon icon-user"></span>
                  <input class="form-control logpadding" type="text" name="lname" placeholder="Last name" minlength="1" required/>
                </div>
                <div class="rowput">
                  <span class="icon glyphicon-envelope"></span>
                  <input class="form-control logpadding" type="email" name="email" placeholder="Your email" required/>
                </div>
                <div class="rowput">
                  <span class="icon icon-lock"></span>
                    <input class="form-control logpadding" type="password" name="password" id="password" placeholder="Password" minlength="5" maxlength="50" required/>
                </div>
                <div class="rowput">
                  <span class="icon icon-lock"></span>
                  <input class="form-control logpadding" type="password" name="cpassword" placeholder="Confirm password" required/>
                </div>
                <div class="misclog">
                  <a class="rember"><input type="checkbox" id="receive_promotional_email" value="1"/><label for="us+er_profile_info_receive_promotional_email">Tell me about InnoGlobe news</label></a>
                </div>
                <div class="clear"></div>
                <div class="signupterms">
                  By signing up, I agree to InnoGlobe's <a>Terms of Service</a>,<a> Privacy Policy</a>, <a>Guest Refund Policy</a>, and <a>Host Guarantee Terms</a>. 
                </div>
                <div class="clear"></div>
                <input type="submit" class="submitlogin" value="Sign up" name="Sign up"/>
            </div>
            </form>
                <div class="clear"></div>
                <div class="dntacnt">Already an InnoGlobe member?  <a class="signinfixed">Sign in</a> </div>
            
            </div>
        </div>
    </div>




    <div class="wrapdivs" id="signinfix">
    <div class="popuperror" style="display:none;"></div>
    <div  class="pophed">Sign In</div>
        <div class="signdiv">
            <div class="insigndiv">
             <form id="login" name="login" action="<?php echo WEB_URL;?>/account/login">
               <div class="ritpul"> 
                  <div class="rowput">
                    <span class="icon glyphicon-envelope"></span>
                    <input class="form-control logpadding" type="email" name="email" placeholder="Email Address" required>
                  </div>
                  <div class="rowput">
                    <span class="icon icon-lock"></span>
                      <input class="form-control logpadding" type="password" name="password" placeholder="Password" required>
                  </div>
                  <div class="misclog">
                    <a class="rember"><input type="checkbox" />Remember me</a>
                      <a class="fadeandscale_close fadeandscaleforget_open forgota" id="forgtpsw">Forgot password?</a>
                  </div>
                  <div class="clear"></div>
                  <button class="submitlogin">Login</button>
                  <div class="clear"></div>
                  <div class="dntacnt">Don't have an account? <a class="signupfixed">Sign up</a> </div>

              </div>
              </form>
            </div>
        </div>
      </div>

  </div>
  
  
<div class="twostep" id="stepone">
	<div class="col-md-8 nopad">
    	<h3 class="stepsbighed">Signing in with 2-step verification </h3>
    	<div class="col-md-12 nopad">
        	<div class="col-md-3">
            	<div class="imagestep">
                	<img src="<?php echo ASSETS;?>images/step1.png" alt="" />
                </div>
            </div>
            <div class="col-md-9">
                <h4 class="stepshed">Signing in will be different </h4>
                <div class="stepspara"><strong>You'll need verification codes:</strong>
    After entering your password, you'll enter a code that you'll get via text, voice call, or our mobile app. </div>
			</div>
        </div>
        <div class="clear"></div>
        <div class="stepline"></div>
        
        <div class="col-md-12 nopad">
        	<div class="col-md-3">
            	<div class="imagestep">
                	<img src="<?php echo ASSETS;?>images/step2.png" alt="" />
                </div>
            </div>
            <div class="col-md-9">
                <h4 class="stepshed">Signing in will be different </h4>
                <div class="stepspara"><strong>You'll need verification codes:</strong>
    After entering your password, you'll enter a code that you'll get via text, voice call, or our mobile app. </div>
			</div>
        </div>
        
        <div class="clear"></div>
        <div class="stepline"></div>
        
        <div class="col-md-12 nopad">
        	<div class="col-md-3">
            	<div class="imagestep">
                	<img src="<?php echo ASSETS;?>images/step3.png" alt="" />
                </div>
            </div>
            <div class="col-md-9">
                <h4 class="stepshed">Signing in will be different </h4>
                <div class="stepspara"><strong>You'll need verification codes:</strong>
    After entering your password, you'll enter a code that you'll get via text, voice call, or our mobile app. </div>
			</div>
        </div>
    </div>
    
    <div class="col-md-4 nopad">
    	<div class="stepfolow">
        	<h4 class="instructn">2-step verification</h4>
            <span class="paraveri">After entering your password, you'll enter a code that you'll get via text, voice call, or our mobile app.</span>
            <div class="clear"></div>
            <a class="startuostep" id="startstep">Start setup</a>
            <div class="clear"></div>
            <a class="forgotsomthig">Learn more</a>
        </div>
    </div>
</div>



<div class="clear"></div>

<div class="twostep withpadd" id="steptwo">
	<div class="cenerstepbox">
    	<h4 class="twostp">2-Step Verification</h4>
        <div class="imagemsg"><img src="<?php echo ASSETS;?>images/textmsg.png" alt=""  /></div>
        <div class="stpnote">A text message with your code has been sent to *** ** ***92</div>
        <div class="clear"></div>
        <input type="text" class="typecode" placeholder="Enter code" />
        <a class="fullverify">Verify</a>
    </div><br />
    
	<div class="cenerstepbox">
    	<a class="problm undoo">Resend code?</a>
    </div>
    <br />
    <div class="cenerstepbox">
    	<a class="problm" id="problemreceive">Problem receiving your code?</a>
    </div>
</div>


<div class="clear"></div>

<div class="twostep withpadd" id="stepthree">

	<div class="cenerstepbox">
    	<h4 class="twostp">2-Step Verification</h4>
        <div class="imagemsg"><img src="<?php echo ASSETS;?>images/secqus.png" alt="" /></div>
        <div class="stpnote">Security questions lorum ipsum ipsum lorum setnbhg dfrtsfed</div>
        <div class="clear"></div>
        <div class="qstn">
        	<span class="secqstn">When you complete the graduation?</span>
        	<input type="text" class="typecodeans" placeholder="Type here" />
        </div>
        <div class="qstn">
        	<span class="secqstn">When you complete the graduation?</span>
        	<input type="text" class="typecodeans" placeholder="Type here" />
        </div>
        <a class="fullverify">Submit</a>
    </div>
    
    <br />    
    <div class="cenerstepbox">
    	<a class="problm">Problem receiving your code?</a>
    </div>
</div>



</div>
</div>


<div class="clearfix"></div>

<?php $this->load->view('common/footer');?>

<script type="text/javascript">
	$(document).ready(function(){
		$('#startstep').click(function(){
			$('#stepone').fadeOut(500,function(){
				$('#steptwo').fadeIn(500);
			})
		});
		
		$('#problemreceive').click(function(){
			$('#steptwo').fadeOut(500,function(){
				$('#stepthree').fadeIn(500);
			})
		});
		
	});
</script>

</body>
</html>