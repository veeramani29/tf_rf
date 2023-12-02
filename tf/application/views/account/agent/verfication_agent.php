<?php $language = $this->session->userdata('language');
if($language){ $this->lang->load('Account_Login_AL', $language); }else{ $this->lang->load('Account_Login_AL', 'english');  } 
$this->load->view('common/header');?>
<div class="full onlycontent marintopcntpage"><div class="container martopbtm">
<div class="centerfix">
<div class="wrapdivs" id="forgotpasfix"><div class="popuperror" style="display:none;"></div>
<div  class="pophed"><?php echo $this->lang->line('AL_Reset'); ?></div>
<div class="signdiv">
 <form id="resetpwd" name="resetpwd" action="<?php echo WEB_URL;?>/account/resetpwd">
 <div class="ritpul"><div class="rowput"><span class="icon icon-lock"></span>
 <input type="hidden" name="email" value=""><input class="form-control logpadding" type="password" name="password" id="npassword" placeholder="<?php echo $this->lang->line('AL_NewPass'); ?>" minlength="5" maxlength="50" required/>
 </div>
 <div class="rowput"><span class="icon icon-lock"></span>
 <input class="form-control logpadding" type="password" name="cpassword" placeholder="<?php echo $this->lang->line('AL_CPass'); ?>" required/>
 </div><div class="clear"></div>
 <button class="submitlogin"><?php echo $this->lang->line('AL_SC'); ?></button>
 <div class="clear"></div><div class="dntacnt"><?php echo $this->lang->line('AL_Suddenly'); ?> 
 <a class="fadeandscaleforget_close fadeandscale_open" id="btoblogin"><?php echo $this->lang->line('AL_SignIn'); ?></a> </div>
 </div>
 </form>
</div>
</div>
<div class="wrapdivs" id="signupfix" style="display: none">
<div class="popuperror" style="display:none;"></div>
<div  class="pophed"><?php echo $this->lang->line('AL_SignUp'); ?></div>
<div class="signdiv"><div id="AgntloginLdrReg" class="lodrefrentrev imgLoader"><div class="centerload"></div></div> 
<div class="insigndiv">
 <form id="Agentregistration" name="Agentregistration" action="<?php echo WEB_URL;?>/agent/create" enctype="multipart/form-data">
 <div class="signupul22"> 
 <div class="rowput"><span class="icon icon-user"></span>
 <input class="form-control logpadding" type="text" name="fname" placeholder="<?php echo $this->lang->line('AL_FName'); ?>" minlength="5" required/>
 </div>
 <div class="rowput"><span class="icon icon-user"></span>
 <input class="form-control logpadding" type="text" name="lname" placeholder="<?php echo $this->lang->line('AL_LName'); ?>" minlength="1" required/>
 </div>
 <div class="rowput"><span class="icon icon-lock"></span>
 <input class="form-control logpadding" type="text" name="company" placeholder="<?php echo $this->lang->line('AL_CName'); ?>" required/>
 </div>
 <div class="rowput"><span class="icon glyphicon-envelope"></span>
 <input class="form-control logpadding" type="email" name="email" placeholder="<?php echo $this->lang->line('AL_EEmail'); ?>" required/>
 </div>
 <div class="rowput"><span class="icon glyphicon-envelope"></span>
 <input class="form-control logpadding" type="password" name="pswd" placeholder="<?php echo $this->lang->line('AL_EPass'); ?>" required/>
 </div>
 <div class="rowput">
 <select class="form-control logpadding" name="country_code" id="countryCode" required>
 <option value=""><?php echo $this->lang->line('AL_SelectCountry'); ?></option>                      
                    <?php foreach($country_code as $k): ?>
                      <option value="<?php echo $k->phonecode; ?>"><?php echo $k->name.'  ('.$k->phonecode.')' ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="rowput">
                  <span class="icon icon-lock"></span>
                    <input class="form-control logpadding" type="text" name="contact_no" id="contact_no" placeholder="<?php echo $this->lang->line('AL_Modile'); ?>" minlength="6" maxlength="15" required/>
                </div>
                <div class="rowput">
                  <span class="icon icon-picture"></span>
                    <input class="form-control logpadding" type="file" name="agent_logo" id="agent_logo" required/>
                </div>
               
                <div class="clear"></div>
                <div class="signupterms">
                 <?php echo $this->lang->line('AL_Agree'); ?> <a  target="_blank" href="<?php echo WEB_URL.'/terms-of-service'; ?>"><?php echo $this->lang->line('AL_Terms'); ?></a>, <a target="_blank"  href="<?php echo WEB_URL.'/privacy-policy'; ?>"><?php echo $this->lang->line('AL_Privacy'); ?></a>, <a target="_blank"  href="<?php echo WEB_URL.'/guest-refund-policy'; ?>"><?php echo $this->lang->line('AL_Refund'); ?></a>, <?php echo $this->lang->line('AL_And'); ?> <a target="_blank"  href="<?php echo WEB_URL.'/host-guarantee-terms'; ?>"><?php echo $this->lang->line('AL_Host'); ?></a>. 
                </div>
                <div class="clear"></div>
                <input type="submit" class="submitlogin" value="<?php echo $this->lang->line('AL_SignUp'); ?>" name="Sign up"/>
            </div>
            </form>
                <div class="clear"></div>
                <div class="dntacnt"><?php echo $this->lang->line('AL_Already'); ?>  <a class="signinfixed"><?php echo $this->lang->line('AL_SignIn'); ?></a> </div>
            </div>
        </div>
    </div>
    <div class="wrapdivs" id="signinfix" style="display:none;">
    <div class="popuperror" style="display:none;"></div>
    <div  class="pophed"><?php echo $this->lang->line('AL_SignIn'); ?></div>
        <div class="signdiv">
            <div class="insigndiv">
             <form id="Agentlogin" name="Agentlogin" action="<?php echo WEB_URL;?>/agent/loginn">
               <div class="ritpul"> 
                  <div class="rowput">
                    <span class="icon glyphicon-envelope"></span>
                    <input class="form-control logpadding" type="email" name="email" placeholder="<?php echo $this->lang->line('AL_EEmail'); ?>" required>
                  </div>
                  <div class="rowput">
                    <span class="icon icon-lock"></span>
                      <input class="form-control logpadding" type="password" name="<?php echo $this->lang->line('AL_EPass'); ?>" placeholder="Password" required>
                  </div>
                  <div class="misclog">
                    <a class="rember"><input type="checkbox" /><?php echo $this->lang->line('AL_Remember'); ?></a>
                      <a class="fadeandscale_close fadeandscaleforget_open forgota" id="forgtpsw"><?php echo $this->lang->line('AL_Forget'); ?></a>
                  </div>
                  <div class="clear"></div>
                  <button class="submitlogin"><?php echo $this->lang->line('AL_Login'); ?></button>
                  <div class="clear"></div>
                  <div class="dntacnt"><?php echo $this->lang->line('AL_Dont'); ?> <a class="signupfixed"><?php echo $this->lang->line('AL_SignUp'); ?></a> </div>
              </div>
              </form>
            </div>
        </div>
      </div>
      <div class="wrapdivs" id="agentVerification" > 
        <div class="popuperror" style="display:none;"></div>
        <div  class="pophed"><?php echo $this->lang->line('AL_Verify'); ?></div>
        <div class="signdiv" style="position: relative">
          <div id="AgntVeriContact" class="lodrefrentrev imgLoader">
            <div class="centerload"></div>
          </div> 
            <div class="insigndiv">
              <form id="AgentVerify" name="AgentVerify" action="<?php echo WEB_URL;?>/agent/verifyContactDetails_v1" method="post">
                 <div class="ritpul"> 
                    <span>
                      <?php echo $this->lang->line('AL_Verify_send'); ?>
                    </span>
                    <div class="rowput">
                      <span class="icon glyphicon-envelope"></span>
                      <input class="form-control logpadding" type="text" name="veri_email" id="veri_email" placeholder="<?php echo $this->lang->line('AL_Email_Verify'); ?>" required>
                        <input class="form-control logpadding" value="<?php echo $vid; ?>" type="hidden" name="SKsdjaernHJHD" id="veri_email" required>
                    </div>
                    <div class="rowput">
                        <span class="icon icon-phone"></span>
                        <input class="form-control logpadding" type="type" name="veri_mobile" id="veri_mobile" placeholder="<?php echo $this->lang->line('AL_Mobile_Verify'); ?>" required>
                    </div>
                    <div class="clear"></div>
                    <button class="submitlogin"><?php echo $this->lang->line('AL_Submit'); ?></button>
                    <div class="clear"></div>
                    <div id="cntctAgentPopup" class="dntacnt"><a class="problemReceCode"><?php echo $this->lang->line('AL_Problem'); ?></a> </div>
                </div>
              </form>
            </div>
            <div id="messageSentPopup" style="border: 1px solid black; background: #fff; display: none">
              <div class="thankudiv">
                <div class="thnkutik"><img src="<?php echo ASSETS ?>/images/aptcheck.png" alt="Thank you"></div>
                <h3><?php echo $this->lang->line('AL_Thanku'); ?></h3>
                <p><?php echo $this->lang->line('AL_Shortly'); ?></p>
              </div>
            </div>
        </div>
      </div>
      <div id="messageAdminPopup" style="display: none" class="thnkupopup">
        <div class="popuphed">
          <span class="popbighed"><?php echo $this->lang->line('AL_Contact'); ?></span>
        </div>
        <div class="popconyent">
          <form method="POST" action="<?php echo WEB_URL.'/auth/contactAdmin'; ?>" id="cntctAdmin">
            <div class="poprow">
              <div class="col-md-12">
                <span class="poplabel"><?php echo $this->lang->line('AL_EMessage'); ?></span>
                <textarea name="agentMsg" class="simtextre" id="msgId" placeholder="<?php echo $this->lang->line('AL_Problem_Verify'); ?>" required></textarea>
              </div>
            </div>
            <div class="clear"></div>
            <div class="col-md-12">
              <button class="popbutton blubutton" type="submit"><?php echo $this->lang->line('AL_SMessage'); ?></button>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>
</div>
<script type="text/javascript">
$('#cntctAgentPopup').on('click', function() {
  $('#messageAdminPopup').provabPopup({
      modalClose: true, 
      zIndex: 10000005
  }); 
})
</script>
<div class="clearfix"></div><?php $this->load->view('common/footer');?>