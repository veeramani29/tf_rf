<?php $this->load->view('common/header');?>

<div class="full onlycontent marintopcntpage">
<div class="container martopbtm">

<?php
if($securityQuestionExist[0]->security_question != "" || $securityQuestionExist[0]->security_answer != "") { 
    $display_steps = "";
} 
else {
    $display_steps = "style = 'display: none;' ";
}
if(!empty($twoStepTypeEnabled)){
    if($twoStepTypeEnabled[0]->two_step_verification == 0 && $twoStepTypeEnabled[0]->two_step_type == 0) { //everything is off right now
        $active_email = "";
        $active_phone = "";
        $display_disable_btn = 0;
    } else if($twoStepTypeEnabled[0]->two_step_verification == 1 && $twoStepTypeEnabled[0]->two_step_type == 1) { //2-step is on for EMAIL
        $active_email = "ssactive";
        $active_phone = "";
        $display_disable_btn = 1;
    } else if($twoStepTypeEnabled[0]->two_step_verification == 1 && $twoStepTypeEnabled[0]->two_step_type == 2) { ////2-step is on for MOBILE
        $active_phone = "ssactive";
        $active_email = "";
        $display_disable_btn = 1;
    } else {
        $active_email = "";
        $active_phone = "";
        $display_disable_btn = 0;
    }
} else {
    $display_disable_btn = "";
}
?>
<div class="seconfirm" id="choose_type" <?php echo $display_steps; ?> >
	<button type="button" class="veryfybtn" data-toggle="collapse" data-target="#collapse2step">
		2-Step Verification <span class="collapsearrow"></span>
	</button>

    <div id="collapse2step" class="collapse in">
        <div class="colsppad">
        	<div class="col-md-6">
            	<div class="colcentrtbl">
                <div class="ajaxtime"></div>
                	<div class="stndrdimg">
                    	<img src="<?php echo ASSETS;?>images/phonevery.png" alt="" />
                    </div>
                    <h4 class="wichvery">Phone Verification</h4>
                    <?php  
                    if(isset($userInfo->contact_no) && $userInfo->contact_no != "") {
                        $number = $userInfo->contact_no;
                    } else if(isset($userInfo->mobile) && $userInfo->mobile != "") {
                        $number = $userInfo->mobile;
                    } else {
                        $number = "**********";
                    }

                    ?>

                    <p>A verification code to the number <b>"<?php echo $number; ?>"</b> will be sent via text message whenever you will log in.</p>
                    
                    <div data-verifyType="2" class="clickblebtn <?php echo $active_phone; ?> btnvery2 twoStepEnable"></div>
                
                </div>
            </div>
            <div class="col-md-6">
            	<div class="colcentrtbl">
                <div class="ajaxtime"></div>
                	<div class="stndrdimg">
                    	<img src="<?php echo ASSETS;?>images/eml.png" alt="" />
                    </div>
                    <h4 class="wichvery">Email Verification</h4>
                    <?php  
                    if(isset($userInfo->email) && $userInfo->email != "") {
                        $email_addr = $userInfo->email;
                    } else if(isset($userInfo->email_id) && $userInfo->email_id != "") {
                        $email_addr = $userInfo->email_id;
                    } else {
                        $email_addr = "**********@*****.***";
                    }

                    ?>
                    <p>A verification code to the email address <b>"<?php echo $email_addr; ?>"</b> will be sent whenever you will log in.</p>
                    <div data-verifyType="1" class="clickblebtn <?php echo $active_email; ?> btnvery2 twoStepEnable"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php if($display_disable_btn == 1 && $securityQuestionExist[0]->security_question != "" && $securityQuestionExist[0]->security_answer != "" ) { ?>
<div class="seconfirm">
    <button type="button" class="veryfybtn" data-toggle="collapse" data-target="#collapseDisable2Step">
        Disable 2-Step Verification <span class="collapsearrow"></span>
    </button>
                        
    <div id="collapseDisable2Step" class="collapse in">
        <div class="colsppad" style="text-align: center;">
            <p>If you do not wish to have two step verification while logging in, you can disable it from here</p>            
            <a href="<?php echo WEB_URL.'/security/disableTwoStepVerification'; ?>" class="startuostep">Disable 2-step verification</a>
        </div>
    </div>
</div>
<?php } ?>



<?php if($securityQuestionExist[0]->security_question == "" && $securityQuestionExist[0]->security_answer == "" ){ ?>
<div class="seconfirm">
	<button type="button" class="veryfybtn" data-toggle="collapse" data-target="#collapseqstion">
		Security Question and Answers <span class="collapsearrow"></span>
	</button>
						
    <div id="collapseqstion" class="collapse in">
        <div class="colsppad">
        	<div class="col-md-12">
            	<div class="colcentrtbl">
                <div class="ajaxtime"></div>
                	<div class="stndrdimg">
                    	<img src="<?php echo ASSETS;?>images/cnfirmsec.png" alt="" />
                    </div>
                    <h4 class="wichvery">Security questions and answers</h4>
                    <p>In case of having problem while retrieving 2-Step verification code, you can access account by answering a security question.</p>
                    <div class="qstn">
                        <select onchange="check_security_question_v1(this.value);" class="typecodeans" id="security_question" name="security_question">
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
                        <input type="text" name="security_question_own" id="security_question_own" class="typecodeans" placeholder="Type here" />
                        <span style="color: red; font-size: small" id="checkQuesMsg"></span>
                        
                    </div>
                    <div class="qstn" id="check_security_question_other">
                        <span class="secqstn">Answer</span>
                        <input type="text" id="security_answer" name="security_question_own" class="typecodeans" placeholder="Type here" />
                        <span style="color: red; font-size: small" id="checkAns"></span>
                    </div>
                    
                
                    <div class="clickblebtn ssactive btnveryqstn"></div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<?php } ?>

</div>
</div>


<div class="clearfix"></div>

<?php $this->load->view('common/footer');?>

<script type="text/javascript">
    
function check_security_question_v1(sec_ques) {
    if(sec_ques=='') {
        $("#check_security_question_other").show(500);
    } else{
        $("#check_security_question_other").hide(500);
    }
}

</script>

<script type="text/javascript">
$(document).ready(function(){

$('.twoStepEnable').click(function(){
    if($(this).hasClass('ssactive')) { 
		return false;
	}
    $(this).siblings('.ajaxtime').fadeIn(200);
    var verificationType = $(this).attr('data-verifyType');
    if(verificationType) {
        verificationType = verificationType.trim();
    }
    
    if(verificationType){
        $.ajax({
            url: "<?php echo WEB_URL.'/security/enableTwoStepVerification' ?>",
            method: "POST",
            data: {'verificationType': verificationType},
            dataType: 'json',
            success: function(r) {
                $('.ajaxtime').fadeOut(200);
                window.location.href = WEB_URL+'/dashboard/settings';
            }
        });
    }
    $('.btnvery2').removeClass('ssactive');
	$(this).addClass('ssactive');
});

	
$('.btnveryqstn').click(function(){ 
    var security_question = $('#security_question').val();
    var security_question_own = $('#security_question_own').val();
    
    if(security_question) {
        security_question = security_question.trim();
        $("#checkAns").text('');
    } else if(security_question_own) {
        security_question = security_question_own.trim();
        $("#checkAns").text('');
    } else {
        $("#checkQuesMsg").text('Please select a security question or type one of your own.');
        return false;
    }

    var security_answer = $('#security_answer').val();
    if(security_answer) {
        security_answer = security_answer.trim();
        $("#checkAns").text('');
    } else {
        $("#checkAns").text('Please give an answer to the question.');
        return false;
    }


	if(security_question && security_answer) {
        $(this).siblings('.ajaxtime').fadeIn(200);
        $.ajax({
            url: "<?php echo WEB_URL.'/security/updateSecurityQuestionAnswer' ?>",
            method: "POST",
            data: {'security_question': security_question, "security_answer": security_answer},
            dataType: 'json',
            success: function(r) {
                $(this).toggleClass('ssactive');
                $('.ajaxtime').fadeOut(200);
                $('#choose_type').fadeIn();
                $('html,body').animate({scrollTop: 0}, 800);
            }
        });
    }
});
	
});
</script>

</body>
</html>