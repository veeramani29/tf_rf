<!-- TAB 4 -->
<div class="tab-pane <?php if(!empty($page_type) && $page_type == "settings") {echo "active";} ?>" id="settings">
    <div class="padding20 dark"> 


<?php if($this->session->userdata('b2b_id') && $user_type == 2 ):  ?>
    <span class="dark padtabne size18">My Mark Up</span>
    <div class="rowit marbotom20">
    <div id="addMarkUpLoader" class="lodrefrentrev imgLoader">
        <div class="centerload"></div>
    </div>
        <div class="inreprow">
            <div class="col-md-12 nopad">
            <div class="col-md-3">
                <div class="imagestep">
                    <img src="<?php echo ASSETS;?>images/key.png" alt="" />
                </div>
            </div>
            <div class="col-md-7 nopad">
                <h4 class="stepshed">Add Mark up to your account</h4>
                <div class="stepspara">
                    <strong>Add or update your markup for InnoGlobe account</strong>
                </div>
            </div>
            
            <div class="col-md-2">
                <a class="enbleink" id="addMarkUp">Click to add mark up</a>
            </div>

            <div class="clear"></div>
            <form name="add_markup" id="add_markup" action="<?php echo WEB_URL.'/agent/addMarkup' ?>">
            <div class="fullquestionswrp5" style="display: none">
            <div class="fullquestions">
                <h4 class="editquestions">Enter your mark up</h4>
                 
                <div class="rowshare">
                    <div class="col-md-6">
                        <div class="lablshare">Current mark up</div>
                    </div>
                    <div class="col-md-8">
                        <input style="width: 80px" value="<?php echo $current_agent_markup; ?>" type="number" min="0" max="100"  required id="agrntMarkUp" name="agent_mark_up" class="typecodeans notypmar" />
                    </div>
                </div>
                <br />
                <button type="submit" class="comnbutton">Add</button>
                <span  id="passwordchanges" class="passucss"><span class="icon icon-check"></span>Mark up added.</span>
            </div>
            </div>
            
            </form>
           
            </div>
        </div>
    </div>
<?php endif; ?>





        <span class="dark padtabne size18">Security</span>
        <div class="rowit marbotom20">
        
        <div class="inreprow">
        <div class="col-md-12 nopad">
        	<div class="col-md-3">
            	<div class="imagestep">
                	<img src="<?php echo ASSETS;?>images/step1.png" alt="" />
                </div>
            </div>
            <div class="col-md-7 nopad">
                <h4 class="stepshed">2 step verification </h4>
                <div class="stepspara"><strong>You'll need verification:</strong>
                 After entering your password, you'll enter a code that you'll get via text, voice call, or our mobile app.	
                </div>
			</div>
          <!-- 2-step verification -->
            <div class="col-md-2">
            	<div class="wraponof">
                    <div class="darktogle">
                        <?php if(!empty($twoStepVerified)){ ?>
                        <?php if($twoStepVerified[0]->two_step_verification  == 0 ) { ?>
                            <span class="onon">OFF</span>
                            <span class="roundtogle noo"></span>
                        <?php } else if($twoStepVerified[0]->two_step_verification  == 1) { ?>
                            <span class="onon">ON</span>
                            <span class="roundtogle"></span>
                        <?php } else { ?>
                            <span class="onon">OFF</span>
                            <span class="roundtogle noo"></span>
                        <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="clear"></div>
                <a href="<?php echo WEB_URL.'/security/twostep'; ?>" class="enbleink">Settings</a>
            </div>
            <!-- end of 2-step verificationsw -->
            
        </div>
        </div>
        <div class="clear"></div>
    <?php if(!empty($twoStepVerified)) { ?>
    
        <div class="stepline"></div>
        <div class="clear"></div>
        <div class="inreprow">
            <div class="col-md-12 nopad">
            <?php
			$security_question_chl='OFF';
			if($userInfo->security_question!='') {
				$security_question_chl='ON';
			}
			?>
        	<div class="col-md-3">
            	<div class="imagestep">
                	<img src="<?php echo ASSETS;?>images/secr.png" alt="" />
                </div>
            </div>
            <div class="col-md-7 nopad">
                <h4 class="stepshed">Security questions and answers</h4>
                <div class="stepspara">In case you cant access your account means you can retrive you account via using this one. <br />
                    <?php
                    if($security_question_chl=='ON') {
                        echo '<b>Current Security question:</b> <i>'.$userInfo->security_question.'</i><br>';
                        $answer = $userInfo->security_answer;
                        $answer_length = strlen($answer);

                        if($answer_length > 4) {
                            $answer_length = $answer_length - 4;
                            $masked_answer = substr($answer, 0, 3).str_repeat('*', $answer_length).substr($answer, -1);
                        } else {
                            $masked_answer = $answer;
                        }
                        


                        echo '<b>Current Security Answer:</b>  <i>'.$masked_answer.'</i>';
                    }
                    ?>
                </div>
			</div>
           
            <div class="col-md-2">
            	<div class="wraponof">
                    <div class="darktogle">
                        <span class="onon "><?php echo $security_question_chl; ?></span>
                        <span class="roundtogle <?php echo ($security_question_chl == 'ON') ? '' : 'noo' ?>"></span>
                    </div>
                </div>
                <div class="clear"></div>
                <a class="enbleink" id="editquestion">Edit Settings</a>
            </div>
            <div class="clear"></div>
            <form name="Update_security_question"  id="Update_security_question" action="<?php echo WEB_URL;?>/dashboard/Update_security_question" method="POST">
                <div class="fullquestionswrp">
                    <div class="fullquestions">
                    	<h4 class="editquestions">Edit Questions and answers</h4>
                        <div class="qstn">
                            <span class="secqstn">Select a Security Question</span>
                            <select onchange="check_security_question_v1(this.value);"  class="typecodeans" name="security_question">
                                <option value="In what city did you meet your spouse/significant other?">In what city did you meet your spouse/significant other?</option>
                                <option value="What was your childhood nickname?">What was your childhood nickname?</option>
                                <option value="What is the name of your favorite childhood friend?">What is the name of your favorite childhood friend?</option>
                                <option value="What street did you live on in third grade?">What street did you live on in third grade?</option>
                                <option value="What is your oldest sibling’s birthday month and year?">What is your oldest sibling’s birthday month and year? (e.g., January 1900)</option>
                                <option value="What is the middle name of your oldest child?">What is the middle name of your oldest child?</option>
                                <option value="What is your oldest sibling’s middle name?">What is your oldest sibling’s middle name?</option>
                                <option value="What school did you attend for sixth grade?">What school did you attend for sixth grade?</option>
                                <option value="What was your childhood phone number including area code?">What was your childhood phone number including area code? (e.g., 000-000-0000)</option>
                                <option value="What was the name of your first stuffed animal?">What was the name of your first stuffed animal?</option>
                                <option value="In what city or town did your mother and father meet?">In what city or town did your mother and father meet?</option>
                                <option value="What was the last name of your third grade teacher?">What was the last name of your third grade teacher?</option>
                                <option value="What is the first name of the boy or girl that you first kissed?">What is the first name of the boy or girl that you first kissed?</option>
                                <option value="What is your maternal grandmother’s maiden name?">What is your maternal grandmother’s maiden name?</option>
                                <option value="In what town was your first job?">In what town was your first job?</option>
                                <option value="">Write your own question.</option>
                            </select>
                        </div>
                        <div class="qstn" id="check_security_question_other" style="display:none;">
                            <span class="secqstn">Your Own Question</span>
                            <input type="text" name="security_question_own" class="typecodeans" placeholder="Type here" />
                        </div>
                        <div class="qstn">
                            <span class="secqstn">Answer</span>
                            <input type="text" required="required" name="security_answer" class="typecodeans" placeholder="Type here" />
                        </div>
                        <br />
                        <button type="submit" class="comnbutton">Save changes</button>
                    </div>
                </div>
            </form>

        </div>
        </div>
    
    <?php } ?>
        
        <div class="clear"></div>
        
       <!-- <div class="inreprow">
        <div class="col-md-12 nopad">
       
            <div class="fullquestionswrpshare">
             <form name="Update_public_private" id="Update_public_private" action="<?php echo WEB_URL;?>/dashboard/Update_public_private" method="post">
            <div class="fullquestions">
            	<h4 class="editquestions">Manage private / public settings</h4>
                <div class="rowshare">
                    <div class="col-md-6">
                        <div class="lablshare"><span class="icon icon-envelope"></span>Email Address</div>
                    </div>
                    <div class="col-md-6">
                        <label class="switch-light switch-ios" style="width: 100px" onclick="">
                          <input name="emailaddress" <?php if($userInfo->security_email_address==1) { echo ' checked="checked"'; } ?>  type="checkbox" />
                          <span class="htspan">
                            <span>Only me</span>
                            <span>Public</span>
                          </span>
                          <a></a>
                        </label>
                    </div>
                    </div>
                    <div class="rowshare">
                    <div class="col-md-6">
                        <div class="lablshare"><span class="icon icon-phone"></span>Phone Number</div>
                    </div>
                    <div class="col-md-6">
                        <label class="switch-light switch-ios" style="width: 100px" onclick="">
                          <input name="phone" type="checkbox" <?php if($userInfo->security_phone==1) { echo ' checked="checked"'; } ?>/>
                          <span class="htspan">
                            <span>Only me</span>
                            <span>Public</span>
                          </span>
                          <a></a>
                        </label>
                    </div>
                    </div>
                    <div class="rowshare">
                    <div class="col-md-6">
                        <div class="lablshare"><span class="icon icon-group"></span>Contact Address</div>
                    </div>
                    <div class="col-md-6">
                        <label class="switch-light switch-ios" style="width: 100px" onclick="">
                          <input name="address" type="checkbox" <?php if($userInfo->security_address==1) { echo ' checked="checked"'; } ?> />
                          <span class="htspan">
                            <span>Only me</span>
                            <span>Public</span>
                          </span>
                          <a></a>
                        </label>
                    </div>
                    </div>
                <?php if($this->session->userdata('b2c_id')){?>
                <div class="rowshare">
                    <div class="col-md-6">
                        <div class="lablshare"><span class="icon icon-facebook"></span>Facebook</div>
                    </div>
                    <div class="col-md-6">
                        <label class="switch-light switch-ios" style="width: 100px" onclick="">
                          <input name="facebook" type="checkbox" <?php if($userInfo->security_facebook==1) { echo ' checked="checked"'; } ?> />
                          <span class="htspan">
                            <span>Only me</span>
                            <span>Public</span>
                          </span>
                          <a></a>
                        </label>
                    </div>
                    </div>
                
                <div class="rowshare">
                    <div class="col-md-6">
                        <div class="lablshare"><span class="icon icon-twitter"></span>Twitter</div>
                    </div>
                    <div class="col-md-6">
                        <label class="switch-light switch-ios" style="width: 100px" onclick="">
                          <input name="twitter" type="checkbox" <?php if($userInfo->security_twitter==1) { echo ' checked="checked"'; } ?> />
                          <span class="htspan">
                            <span>Only me</span>
                            <span>Public</span>
                          </span>
                          <a></a>
                        </label>
                    </div>
                    </div>
                    
                <div class="rowshare">
                    <div class="col-md-6">
                        <div class="lablshare"><span class="icon icon-google-plus"></span>Google Plus</div>
                    </div>
                    <div class="col-md-6">
                        <label class="switch-light switch-ios" style="width: 100px" onclick="">
                          <input name="google" type="checkbox" <?php if($userInfo->security_google==1) { echo ' checked="checked"'; } ?>/>
                          <span class="htspan">
                            <span>Only me</span>
                            <span>Public</span>
                          </span>
                          <a></a>
                        </label>
                    </div>
                    </div>
                <?php }?>
                
                <br />
                <button type="submit" class="comnbutton">Save changes</button>
            </div>
             </form>
            </div>
            
            
        </div>
        </div>
        
        
        <div style="display:none;">
            <span class="dark size14 bold">2-Step Verification</span><br/>
            Disabled. <a href="<?php echo WEB_URL.'/verification/twostep'; ?>">Setup</a>
            <br><br>

            <span class="dark size14 bold">Notifications</span><br/>
            Change the way you recieve notifications.
            <div class="checkbox dark">
                <label>
                  <input type="checkbox" checked>
                  Make my profile private 
                </label>
            </div>
            <div class="checkbox dark">
                <label>
                    <input type="checkbox">
                    Send an email when someone replyes to one of your comments. 
                </label>
            </div>
            <br/>
            <br/>
            <span class="dark size14 bold">Who can contact me?</span><br/>
            <select class="form-control mySelectBoxClass hasCustomSelect cpwidth">
                <option value="">Everyone</option>
                <option value="">No one</option>
                <option value="">Friends</option>
            </select>
            <br/>
            <br/>
            <br/>
            <span class="dark size14 bold">Payments</span><br/>
            <div class="checkbox dark">
                <label>
                    <input type="checkbox" checked>
                    Auto Payment 
                </label>
            </div>
            
            
            </div>-->
            
        </div>

        <div class="clear"></div>

    <span class="dark padtabne size18">SMS Alert</span>
        <div class="rowit marbotom20">
            <div class="inreprow">
        <div class="col-md-12 nopad">
        	<div class="col-md-3">
            	<div class="imagestep">
                	<img src="<?php echo ASSETS;?>images/sms.png" alt="" />
                </div>
            </div>
            <div class="col-md-7 nopad">
                <h4 class="stepshed">SMS Alert Options</h4>
                <div class="stepspara">
                    <strong>Recieve SMS alert when the selected event occurs</strong>
                </div>
			</div>
            
            <div class="col-md-2">
                <a class="enbleink" id="smsalert">Edit Settings</a>
            </div>
            <div class="clear"></div>
            
            <div class="fullquestionswrp2">
            <div class="fullquestions">
            	<h4 class="editquestions">Turn SMS alerts Off or On</h4>
                
                
                    <?php foreach($getSMSalertList as $k) { ?>
                        <div class="rowshare">
                            <div class="col-xs-6">
                                <div class="lablshare"><?php echo $k->sms_alert_action; ?></div>
                            </div>
                            <div class="col-xs-6">
                                <img class="smsAlrtLdr" style="display: none;" src="<?php echo ASSETS.'images/loader.gif'; ?>">
                                <label class="switch-light switch-ios" style="width: 100px" onclick="">
                                    <?php  
                                    if(!empty($getSMSalertData)) {
                                        foreach($getSMSalertData as $check_key) {
                                            if($k->sms_alert_id == $check_key->alert_action_id && $check_key->alert_status == 1) {
                                                $check_box = "checked";
                                                break;
                                            } else {
                                                $check_box = "";
                                            }
                                        }
                                    } else {
                                        $check_box = "";
                                    }
                                    ?>
                                    <input class="sms_alert" data-alert_id="<?php echo $k->sms_alert_id; ?>" type="checkbox" <?php echo $check_box; ?> />
                                    
                                    <span class="htspan">
                                        <span>Off</span>
                                        <span>On</span>
                                    </span>
                                    <a></a>
                                </label>
                            </div>
                        </div>
                    <?php } ?>
                
            </div>
            </div>
        </div>
        </div>
        </div>
        
        
    <div class="clear"></div>

    <span class="dark padtabne size18">Change Password</span>
    <div class="rowit marbotom20">
        <div class="inreprow">
            <div class="col-md-12 nopad">
        	<div class="col-md-3">
            	<div class="imagestep">
                	<img src="<?php echo ASSETS;?>images/key.png" alt="" />
                </div>
            </div>
            <div class="col-md-7 nopad">
                <h4 class="stepshed">You can change your password</h4>
                <div class="stepspara">
                    <strong>Update your current InnoGlobe Password</strong>
                </div>
			</div>
            
            <div class="col-md-2">
                <a class="enbleink" id="changepaswrd">Change Password</a>
            </div>

            <div class="clear"></div>
            <form name="change_password" onsubmit="passwordchanges()" id="change_password" action="<?php echo WEB_URL;?>/dashboard/ChangePassword">
            <div class="fullquestionswrp3">
            <div class="fullquestions">
            	<h4 class="editquestions">change your password</h4>
                 <?php if(!empty($userInfo->password)){?>
                <div class="rowshare">
                    <div class="col-xs-6">
                        <div class="lablshare">Current password</div>
                    </div>
                    <div class="col-xs-6">
                        <input type="password" id="password" name="opassword" class="typecodeans notypmar" required />
                    </div>
                </div>
                 <?php }?>
                <div class="rowshare">
                    <div class="col-xs-6">
                        <div class="lablshare">New password</div>
                    </div>
                    <div class="col-xs-6">
                        <input type="password" id="npassword"  name="password"  minlength="5" maxlength="50" required class="typecodeans notypmar" />
                    </div>
                </div>
                <div class="rowshare">
                    <div class="col-xs-6">
                        <div class="lablshare">Confirm password</div>
                    </div>
                    <div class="col-xs-6">
                        <input type="password" required  name="cpassword"  class="typecodeans notypmar" />
                    </div>
                </div>
                <br />
                <button type="submit" class="comnbutton" >Update Password</button>
                <span  id="passwordchanges" class="passucss"><span class="icon icon-check"></span>Password changed.</span>
            </div>
            </div>
            
            </form>
           
            </div>
        </div>
    </div>
     
     
        <div class="clear"></div>

    <span class="dark padtabne size18"> Cancel Account</span>
        <div class="rowit marbotom20">
            <div class="inreprow">
        <div class="col-md-12 nopad">
        	<div class="col-md-3">
            	<div class="imagestep">
                	<img src="<?php echo ASSETS;?>images/cancel.png" alt="" />
                </div>
            </div>
            <div class="col-md-7 nopad">
                <h4 class="stepshed"> Cancel Account</h4>
                <div class="stepspara"><strong>You'll need verification codes :</strong>
    After entering your password, you'll enter a code that you'll get via text, voice call, or our mobile app. </div>
			</div>
            
            <div class="col-md-2">
                <a id="cancelAccount" class="enbleink redcancel"> Cancel Account</a>
            </div>

            <div class="clear"></div>
            
    		<div class="popup_wrapper fullquestionswrp4">
            <div class="wellme minwidth">
                <div class="popuperror" style="display:none;"></div>
                <div  class="pophed"> Cancel Account</div>
                <div class="signdiv">
                    <div class="rowlistwish">
                        <strong>Cancelling your account will delete all your information from InnoGlobe</strong>
                    </div>
                    
                  <div class="clear"></div>
                  <div class="downselfom">
                    <a class="savewish colorcancel" id="hideCancelPopup">Cancel</a>
                    <a class="savewish colorsave" id="startCancelProc">Start cancelling process</a>
                  </div>
                </div>     
            </div>
            </div>

            <div id="cancel2stepVerify" class="wellme minwidth" style="display: none;">
                <div class="popuperror" style="display:none;"></div>
                <div  class="pophed"> Cancel Account</div>
                <div class="signdiv">
                    <div class="rowlistwish">
                        <strong>Enter below the verification code we just sent on your <span id="typeString"></span> </strong>
                        <input type="text" class="fulwish" id="twoStepCode" style="border: 1px solid #777" />
                        <span id="verificationCodeErr" style="color:red; font-size: small"></span>
                    </div>
                    
                  <div class="clear"></div>
                  <div class="downselfom">
                    <a class="savewish colorsave" id="verifyPswd">Submit</a>
                  </div>
                </div>
            </div>

            <div id="cancelLoginPswd" class="wellme minwidth" style="display: none;">
                <div class="popuperror" style="display:none;"></div>
                <div  class="pophed"> Cancel Account</div>
                <div class="signdiv">
                    <div class="rowlistwish">
                        <strong>Enter your current InnoGlobe Password.</strong>
                        <input type="text" class="fulwish" id="oneStepCode" style="border: 1px solid #777" />
                    </div>
                    
                  <div class="clear"></div>
                  <div class="downselfom">
                    <a class="savewish colorsave" id="verifyOneStepPswd">Submit</a>
                  </div>
                </div>
            </div>

            <div class="wellme col-md-2" style="display: none" id="showLoader">
                <div class="rowlistwish">
                    <div style="text-align: center">
                        <img src="<?php echo ASSETS.'/images/loader.gif'; ?>">
                        <div><b>Please Wait...</b></div>
                    </div>
                </div>
            </div>

            
        </div>
        </div>
        </div>
      
        
    </div>
</div>
<!-- END OF TAB 4 --> 

<link href="<?php echo ASSETS;?>css/toggle-switch.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="<?php echo ASSETS; ?>js/settings/settings.js"></script>

<?php 
$flashData_twoStp = $this->session->flashdata('twoStepEnabled');
$flashData_twoStepEnableType = $this->session->flashdata('twoStepEnableType');

if(isset($flashData_twoStp) && $flashData_twoStp != "" && isset($flashData_twoStepEnableType) && $flashData_twoStepEnableType != "" ) {
    if($flashData_twoStp == 'enabled' && $flashData_twoStepEnableType == 'two_step_email') {
?>
    <script type="text/javascript">
    $('.msg').text('Two step verification is now enabled for your email id.');
    $('.msg').show();
    </script>
<?php
    } else if($flashData_twoStp == 'enabled' && $flashData_twoStepEnableType == 'two_step_phone') {
?>
    <script type="text/javascript">
    $('.msg').text('Two step verification is now enabled for your mobile number.');
    $('.msg').show();
    </script>
<?php
    }
}


?>
<script type="text/javascript">

function passwordchanges(){
	var pp = $("#password-error").html();
	var cpp = $("#cpassword-error").html();
	var npp = $("#npassword-error").html();
	
	if(pp=='' && cpp=='' && npp==''){
	   $("#passwordchanges").show(500);
	}
}

function check_security_question_v1(sec_ques){
	if(sec_ques==''){
		$("#check_security_question_other").show(500);
	}
	else {
		$("#check_security_question_other").hide(500);
	}
}
		
	$(document).ready(function(){
		
		$('#editquestion').click(function(){
			$('.fullquestionswrp').slideToggle(500);
		});
		
		$('#editprivatepub').click(function(){
			$('.fullquestionswrpshare').slideToggle(500);
		});
		
		$('#smsalert').click(function(){
			$('.fullquestionswrp2').slideToggle(500);
		});
		
		$('#changepaswrd').click(function(){
			$('.fullquestionswrp3').slideToggle(500);
		});

        $('#addMarkUp').click(function() {
            $('.fullquestionswrp5').slideToggle(500);
        })
			
	});
	
</script>

