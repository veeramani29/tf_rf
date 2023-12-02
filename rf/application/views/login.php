<?php $this->load->view('common/header');?>


<div class="full onlycontent marintopcntpage">
<div class="container martopbtm">
<div class="errstatus" <?php if(!isset($msg)){?>style="display:none;<?php }?>"><?php if(isset($msg)){ echo $msg;}?></div>
<div class="centerfix">
  <div class="wrapdivs">
  <div class="popuperror" style="display:none;"></div>
  <div class="wellme">
      <div class="popuperror" style="display:none;"></div>
        <div class="signdiv">
            <div class="insigndiv">
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
                   echo anchor_popup('auth/login/Facebook/login','
                    <div class="mensionsoc"><span class="fa fa-facebook fa-lg fa-fw color-white"></span> Login with Facebook</div>', $atts);
                $atts['class'] = 'logspecify tweetcolor';
                   echo anchor_popup('auth/login/Twitter/login','
                    <div class="mensionsoc"><span class="fa fa-twitter fa-lg fa-fw color-white"></span> Login with Twitter</div>', $atts);
                $atts['class'] = 'logspecify gpluses';
                   echo anchor_popup('auth/login/Google/login','
                    <div class="mensionsoc"><span class="fa fa-google-plus fa-lg fa-fw color-white"></span> Login with Google Plus</div>', $atts);
                ?>
           </div>
             <div class="centerpul"><div class="orbar"><strong>Or</strong></div></div>
             <form id="login2" name="login" action="<?php echo WEB_URL;?>/account/login">
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
                  <div class="dntacnt">Don't have an account? <a class="fadeandscale_close fadeandscalereg_open">Sign up</a> </div>

              </div>
              </form>
            </div>
        </div>
    </div>

  </div>

</div>
</div>


<div class="clearfix"></div>
<?php $this->load->view('common/footer');?>
