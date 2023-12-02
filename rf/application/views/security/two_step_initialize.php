<?php $this->load->view('common/header');?>

<div class="full onlycontent marintopcntpage">
<div class="container martopbtm">

<div class="twostep"> <!-- Removed stepone id from here, It was affecting back button functionality ..Vikas Arora. -->
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
            <a href="<?php echo WEB_URL.'/security/setUpTwoStep'; ?>" class="startuostep" id="startstep">Start setup</a>
            <div class="clear"></div>
            <a class="forgotsomthig">Learn more</a>
        </div>
    </div>
</div>



<div class="clear"></div>

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
