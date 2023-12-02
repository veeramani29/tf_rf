<div class="tab-pane <?php if(!empty($page_type) && $page_type == "profile" && $sub_type == "verifications") {echo "active";} ?>" id="trustnveri"> 
  <div class="withedrow">
  	<h3 class="dashed alertred">Your Current Verifications  </h3>
      
      <?php if($user_type == 3) { //check according to b2c user ?>
      <div class="rowit">
      	<?php 
          $user_type = (string)$user_type;
          $count = $this->verification_model->checkB2CVerfication($user_id, $user_type)->num_rows();
          if($count == 1){
            $verifications = $this->verification_model->checkB2CVerfication($user_id, $user_type)->row();
            if($verifications->email == 1){
              echo '<span class="rowsubhd">Email Address</span><p class="normalpara">You have confirmed your email: <b>'.$userInfo->email.'</b>. A confirmed email is important to allow us to securely communicate with you.</p>';
            }
           // if($verifications->mobile == 1){
            //  echo '<span class="rowsubhd">Contact Number</span><p class="normalpara">You have confirmed your Contact Number: <b>'.$userInfo->contact_no.'</b>. A confirmed Contact Number is important to allow us to securely communicate with you.</p>';
           // }
            if($verifications->email == 0){
              echo '<p>You have no verifications yet. You can add more below.</p>';
            }
          }else{
            echo '<p>You have no verifications yet. You can add more below.</p>';
          }
        ?>
      </div>
      <?php } else if($user_type == 2) { //check according to b2b users ?>
        <div class="rowit">
          <?php 
            $count = $this->verification_model->checkB2CVerfication($user_id, $user_type)->num_rows();
            if($count == 1){
              $verifications = $this->verification_model->checkB2CVerfication($user_id, $user_type)->row();
              if($verifications->email == 1){
                echo '<span class="rowsubhd">Email Address</span><p class="normalpara">You have confirmed your email: <b>'.$userInfo->email_id.'</b>. A confirmed email is important to allow us to securely communicate with you.</p>';
              }
              //if($verifications->mobile == 1){
               /// echo '<span class="rowsubhd">Contact Number</span><p class="normalpara">You have confirmed your Contact Number: <b>'.$userInfo->mobile.'</b>. A confirmed Contact Number is important to allow us to securely communicate with you.</p>';
             // }
              if($verifications->email == 0 ){
                echo '<p>You have no verifications yet. You can add more below.</p>';
              }
            }else{
              echo '<p>You have no verifications yet. You can add more below.</p>';
            }
          ?>
        </div>
      <?php } ?>

  </div>

<?php if($user_type == 3) { ?>               
  <div class="withedrow">
  	<h3 class="dashed norgren">Add More Verifications</h3>
    <div class="rowit">
      <?php 
        $count = $this->verification_model->checkB2CVerfication($user_id, $user_type)->num_rows();
        if($count == 0){
      ?>
      	<div class="seprow">
      		<span class="rowsubhd">Email Address</span>
      		<p class="normalpara">Please verify your email address by clicking the link in the message we just sent to:<?php echo $email;?>
          </p><p class="normalpara">Can't find our message? Check your spam folder or <a href="javascript:void(0)" class="resend_v">resend the confirmation email.</a><span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span><span class="loadr-tick"><img src="<?php echo ASSETS;?>images/sstik.png"/></span></p>
        </div>
       <!-- <div class="seprow">
      		<span class="rowsubhd">Phone Number</span>
      		<p class="normalpara">Make it easier to communicate with a verified phone number. We'll send you a code by SMS or read it to you over the phone. Enter the code below to confirm that you're the person on the other end.</p>
          <br>
          <p class="normalpara">No phone number entered</p>
          <a class="addPhonePopup addPhone">Add a phone number</a>
          <br> 

          <div class="adphone sendVerification">
          	<div class="phlabl">Choose a country:</div>
            <select class="form-control hasCustomSelect cpwidth3" id="countryPhoneCodeq">
                <option value="">Select Country</option>
                <?php foreach($countryCode as $code_key) { ?> 
                  <option value="<?php echo $code_key->phonecode; ?>"><?php echo $code_key->name; ?></option>
                <?php } ?>
            </select>
            <span style="color: red; font-size:small" class="errCountry"></span>
            <br>
            <div class="phlabl">Add a phone number:</div>
            <input class="form-control" type="text" id="phoneNumber" placeholder="">
            <span style="color: red; font-size:small" class="errPhone"></span>
            <br>
            <button class="btn-search5" id="verifyPhone" type="submit">Send Verification Code</button>
            <img class="sendingLoader" src=" <?php echo ASSETS.'/images/loader.gif' ?>  ">
          </div>
              
          <div class="adphone" id="enterCodeDiv" style="display: none; margin-left: 50px">
            <div class="phlabl">Enter the verification code sent to your phone</div>
            <input class="form-control" type="text" id="enteredCode" placeholder="">
            <span style="color: red; font-size:small" class="errVerifyCode"></span>
            <br>
            <button class="btn-search5" id="processCode" type="submit">Verify</button>
            <img class="verifyingLoader" src=" <?php echo ASSETS.'/images/loader.gif' ?>  ">
          </div>
		    </div>-->
        <?php }else{
          $verifications = $this->verification_model->checkB2CVerfication($user_id, $user_type)->row();
          if($verifications->email == 0){
        ?>
        <div class="seprow">
          <span class="rowsubhd">Email Address</span>
          <p class="normalpara">Please verify your email address by clicking the link in the message we just sent to:<?php echo $userInfo->email;?>
          </p><p class="normalpara">Can't find our message? Check your spam folder or <a href="javascript:void(0)" class="resend_v">resend the confirmation email.</a><span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span><span class="loadr-tick"><img src="<?php echo ASSETS;?>images/sstik.png"/></span></p>
        </div>
        <?php } if($verifications->mobile == 0){ ?>
       <!-- <div class="seprow">
          <span class="rowsubhd">Phone Number</span>
          <p class="normalpara">Make it easier to communicate with a verified phone number. We'll send you a code by SMS or read it to you over the phone. Enter the code below to confirm that you're the person on the other end.</p>
          <br>
          <p class="normalpara">No phone number entered</p>
          <a class="addPhonePopup addPhone">Add a phone number</a>
          <br> 

          <div class="adphone sendVerification">
            <div class="phlabl">Choose a country:</div>
            <select class="form-control hasCustomSelect cpwidth3" id="countryPhoneCode111">
              <option value="">Select Country</option>
              <?php foreach($countryCode as $code_key) { ?> 
                <option value="<?php echo $code_key->phonecode; ?>"><?php echo $code_key->name; ?></option>
              <?php } ?>
            </select>
            <span style="color: red; font-size:small" class="errCountry"></span>
            <br>
            <div class="phlabl">Add a phone number:</div>
            <input class="form-control" type="text" id="phoneNumber" placeholder="">
            <span style="color: red; font-size:small" class="errPhone"></span>
            <br>
            <button class="btn-search5" id="verifyPhone" type="submit">Send Verification Code</button>
            <img class="sendingLoader" src=" <?php echo ASSETS.'/images/loader.gif' ?>  ">
          </div>
              
          <div class="adphone" id="enterCodeDiv" style="display: none; margin-left: 50px">
            <div class="phlabl">Enter the verification code sent to your phone</div>
            <input class="form-control" type="text" id="enteredCode" placeholder="">
            <span style="color: red; font-size:small" class="errVerifyCode"></span>
            <br>
            <button class="btn-search5" id="processCode" type="submit">Verify</button>
            <img class="verifyingLoader" src=" <?php echo ASSETS.'/images/loader.gif' ?>  ">
          </div>
        </div>-->
        <?php }}?>
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
  $atts['class'] = 'conctsocial';
  ?>
        <div class="clear"></div>
        <br>

        <?php if($this->session->userdata('b2c_id')){ ?>                       
          <div class="seprow">
          	<span class="rowsubhd">Facebook</span>
              <div class="col-md-8 offset-0">
              	<p class="normalpara">Sign in with Facebook and discover your trusted connections to hosts and guests all over the world.</p>
              </div>
              <?php if($userInfo->facebook_id == ''){ ?>  
                  <div class="col-md-4">
                      <?php echo anchor_popup('auth/login/Facebook/login','Connect', $atts);?>
                      <!-- <a class="conctsocial">Connect</a> -->
                  </div>
              <?php }else{?>
                  <div class="col-md-4">
                    <a href="<?php echo WEB_URL;?>/dashboard/disconnect/Facebook" class="disconct">Disconnect</a>
                    <a class="tooltip-a helptooltip icon icon-question" title="You can always reconnect later"></a>
                  </div>
              <?php }?>
          </div>
          <div class="clear"></div>
          <br>
          
          <div class="seprow">
          	<span class="rowsubhd">Google</span>
              <div class="col-md-8 offset-0">
              	<p class="normalpara">Connect your InnoGlobe account to your Google account for simplicity and ease.</p>
              </div>
              <?php if($userInfo->google_id == ''){ ?> 
                  <div class="col-md-4">
                      <?php echo anchor_popup('auth/login/Google/login','Connect', $atts);?>
                  	<!-- <a class="conctsocial">Connect</a> -->
                  </div>
              <?php }else{?>
                  <div class="col-md-4">
                    <a href="<?php echo WEB_URL;?>/dashboard/disconnect/Google" class="disconct">Disconnect</a>
                    <a class="tooltip-a helptooltip icon icon-question" title="You can always reconnect later"></a>
                  </div>
              <?php }?>
          </div>
          <div class="clear"></div>
          <br>
          <div class="seprow">
          	<span class="rowsubhd">Twitter</span>
              <div class="col-md-8 offset-0">
              	<p class="normalpara">Sign in with Twitter and discover your trusted connections to hosts and guests all over the world.</p>
              </div>
              <?php if($userInfo->twitter_id == ''){ ?> 
                  <div class="col-md-4">
                      <?php  echo anchor_popup('auth/login/Twitter/login','Connect', $atts);?>
                  	<!-- <a class="conctsocial">Connect</a> -->
                  </div>
              <?php }else{?>
                  <div class="col-md-4">
                    <a href="<?php echo WEB_URL;?>/dashboard/disconnect/Twitter" class="disconct">Disconnect</a>
                    <a class="tooltip-a helptooltip icon icon-question" title="You can always reconnect later"></a>
                  </div>
              <?php }?>
          </div>
        <?php }?>                       
      </div>
    </div>
<?php } ?>
</div>

<?php //Flash data is used here to show the message about unverified account ?>
<?php 
  $verify_attributes = $this->session->flashdata('verify_attributes');
  if($verify_attributes == 1 && !empty($verify_attributes)) { 
?>
  <script type="text/javascript">
    $('.msg').show();
    $('.msg').text('Please verify your Email id and Mobile number before setting up two step verification.')
  </script>
<?php } ?>
<script type="text/javascript">
    $('.sendingLoader').hide();
    $('.verifyingLoader').hide();
    $('#verifyPhone').on('click', function() {
      $('.sendingLoader').show();
      var cc = $('#countryPhoneCode111').val();
      var m_n = $('#phoneNumber').val();
      console.log(cc);
      if(cc) {
        _cc = cc.trim();
      } else {
        $('.errCountry').text("Select your country");
        $('.sendingLoader').hide();
        return false;
      }

      if(m_n) {
        _m_n = m_n.trim();
      } else {
        $('.errPhone').text("Enter mobile number");
        $('.sendingLoader').hide();
        return false;
      }

      var full_m_n = _cc+_m_n;
      var m_n_int = full_m_n.substring(1);

      if(isNaN(m_n_int)) {
        $('.errPhone').text("Incorrect number");
        $('.sendingLoader').hide();
        return false;
      }
      $('.errPhone').text("");

      $.ajax({
        url: "<?php echo WEB_URL.'/security/sendVerifyMobileNumber' ?>",
        method: "POST",
        data: {"m_n": m_n_int},
        dataType: "JSON",
        success: function(r) {
          $('.sendingLoader').hide();
          if(r.status == 1) {
            $('#enterCodeDiv').fadeIn();
          }
        }
      })
    });

    $('#processCode').on('click', function() {
      $('.verifyingLoader').show();
      var m_n = $('#phoneNumber').val();
    
      var e_c = $('#enteredCode').val();
      if(e_c) {
        _e_c = e_c.trim();
      } else {
        $('.errVerifyCode').text("Enter verification code");
        $('.verifyingLoader').hide();
        return false;
      }
      if(_e_c) {
          $.ajax({
            url: "<?php echo WEB_URL.'/security/verifyMobileNumber' ?>",
            method: "POST",
            data: {'e_c': _e_c},
            dataType: "JSON",
            success: function(r) {
              $('.verifyingLoader').hide();
              if(r.status == 1) {
                window.location.href = "<?php echo WEB_URL.'/dashboard/profile/verifications'; ?>"
              } else {
                $('.errVerifyCode').text("Invalid verification code");
                return false;
              }
            }
          })  
      }
    })
</script>

