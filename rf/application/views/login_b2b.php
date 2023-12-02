<?php $this->load->view('common/header');?>

<div class="full onlycontent marintopcntpage">
<div class="container martopbtm">

<div class="centerfix">
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

    <div class="wrapdivs" id="signinfix">

    <?php  
    if(isset($secret_user_type) && $secret_user_type != "") {
      $display_prop = "display: block";
      $display_msg = $msg;  
    } else {
      $display_prop = "display: none";
      $display_msg = "";
    }
    ?>

    <div class="popuperror" style="<?php echo $display_prop; ?>"><?php echo $display_msg; ?></div>
    <div  class="pophed">Sign In</div>
        <div class="signdiv">
            <div class="insigndiv">
             <form id="AgentloginReference" name="AgentloginReference" action="<?php echo WEB_URL;?>/agent/loginn">
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
                  <input type="hidden" name="refferer" value="<?php echo base64_encode('reference'); ?>">
              </div>
              </form>
            </div>
        </div>
      </div>
  </div>

</div>
</div>

<script type="text/javascript">
$('#cntctAgentPopup').on('click', function() {
  $('#messageAdminPopup').provabPopup({
      modalClose: true, 
      zIndex: 100005
  }); 
})
  
</script>

<div class="clearfix"></div>
<?php $this->load->view('common/footer');?>