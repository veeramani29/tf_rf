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
                    <strong>Add or update your markup for TicketFinder account</strong>
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





       
        
        
    <div class="clear"></div>

    <span class="dark padtabne size18"><?=lang('Change Password');?></span>
    <div class="rowit marbotom20">
        <div class="inreprow">
            <div class="col-md-12 nopad">
        	<div class="col-md-3">
            	<div class="imagestep">
                	<img src="<?php echo ASSETS;?>images/key.png" alt="" />
                </div>
            </div>
            <div class="col-md-7 nopad">
                <h4 class="stepshed"><?=lang('You can change your password');?></h4>
                <div class="stepspara">
                    <strong><?=lang('Update your current').' '.lang('SITE_NAME').' '.lang('PSWD');?></strong>
                </div>
			</div>
            
            <div class="col-md-2">
                <a class="enbleink" id="changepaswrd"><?=lang('Change Password');?></a>
            </div>

            <div class="clear"></div>
            <form name="change_password" onsubmit="passwordchanges()" id="change_password" action="<?php echo WEB_URL;?>/dashboard/ChangePassword">
            <div class="fullquestionswrp3">
            <div class="fullquestions">
            	<h4 class="editquestions"><?=lang('Change Your Password');?></h4>
                 <?php if(!empty($userInfo->password)){?>
                <div class="rowshare">
                    <div class="col-xs-6">
                        <div class="lablshare"><?=lang('Current password');?></div>
                    </div>
                    <div class="col-xs-6">
                        <input type="password" id="password" name="opassword" class="typecodeans notypmar" required />
                    </div>
                </div>
                 <?php }?>
                <div class="rowshare">
                    <div class="col-xs-6">
                        <div class="lablshare"><?=lang('New password');?></div>
                    </div>
                    <div class="col-xs-6">
                        <input type="password" id="npassword"  name="password"  minlength="5" maxlength="50" required class="typecodeans notypmar" />
                    </div>
                </div>
                <div class="rowshare">
                    <div class="col-xs-6">
                        <div class="lablshare"><?=lang('CONFIRM');?></div>
                    </div>
                    <div class="col-xs-6">
                        <input type="password" required  name="cpassword"  class="typecodeans notypmar" />
                    </div>
                </div>
                <br />
                <button type="submit" class="comnbutton" ><?=lang('Update Password');?></button>
                <span  id="passwordchanges" class="passucss"><span class="icon icon-check"></span><?=lang('Password changed');?>.</span>
            </div>
            </div>
            
            </form>
           
            </div>
        </div>
    </div>
     
     
        <div class="clear"></div>

    <span class="dark padtabne size18"> <?=lang('Cancel Account');?></span>
        <div class="rowit marbotom20">
            <div class="inreprow">
        <div class="col-md-12 nopad">
        	<div class="col-md-3">
            	<div class="imagestep">
                	<img src="<?php echo ASSETS;?>images/cancel.png" alt="" />
                </div>
            </div>
            <div class="col-md-7 nopad">
                <h4 class="stepshed"> <?=lang('Cancel Account');?></h4>
                <div class="stepspara"><strong><?=lang('Cancel_Account_line1');?> :</strong>
    <?=lang('Cancel_Account_line2');?>. </div>
			</div>
            
            <div class="col-md-2">
                <a id="cancelAccount" class="enbleink redcancel"> <?=lang('Cancel Account');?></a>
            </div>

            <div class="clear"></div>
            
    		<div class="popup_wrapper fullquestionswrp4">
            <div class="wellme minwidth">
                <div class="popuperror" style="display:none;"></div>
                <div  class="pophed"> <?=lang('Cancel Account');?></div>
                <div class="signdiv">
                    <div class="rowlistwish">
                        <strong><?=lang('Final_Cancel_Msg').' '.lang('SITE_NAME');?></strong>
                    </div>
                    
                  <div class="clear"></div>
                  <div class="downselfom">
                    <a class="savewish colorcancel" id="hideCancelPopup"><?=lang('Cancel');?></a>
                    <a class="savewish colorsave" id="startCancelProc"><?=lang('Start cancelling process');?></a>
                  </div>
                </div>     
            </div>
            </div>

            <div id="cancel2stepVerify" class="wellme minwidth" style="display: none;">
                <div class="popuperror" style="display:none;"></div>
                <div  class="pophed"> <?=lang('Cancel Account');?></div>
                <div class="signdiv">
                    <div class="rowlistwish">
                        <strong><?=lang('Enter_Your_Verification_Code');?> <span id="typeString"></span> </strong>
                        <input type="text" class="fulwish" id="twoStepCode" style="border: 1px solid #777" />
                        <span id="verificationCodeErr" style="color:red; font-size: small"></span>
                    </div>
                    
                  <div class="clear"></div>
                  <div class="downselfom">
                    <a class="savewish colorsave" id="verifyPswd"><?=lang('Submit');?></a>
                  </div>
                </div>
            </div>

            <div id="cancelLoginPswd" class="wellme minwidth" style="display: none;">
                <div class="popuperror" style="display:none;"></div>
                <div  class="pophed"> <?=lang('Cancel Account');?></div>
                <div class="signdiv">
                    <div class="rowlistwish">
                        <strong><?=lang('Enter your current').' '.lang('SITE_NAME').' '.lang('PSWD');?>.</strong>
                        <input type="password" class="fulwish" id="oneStepCode" style="border: 1px solid #777" />
                    </div>
                    
                  <div class="clear"></div>
                  <div class="downselfom">
                    <a class="savewish colorsave" id="verifyOneStepPswd"><?=lang('Submit');?></a>
                  </div>
                </div>
            </div>

            <div class="wellme col-md-2" style="display: none" id="showLoader">
                <div class="rowlistwish">
                    <div style="text-align: center">
                        <img src="<?php echo ASSETS.'/images/loader.gif'; ?>">
                        <div><b><?=lang('Please Wait');?></b></div>
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

