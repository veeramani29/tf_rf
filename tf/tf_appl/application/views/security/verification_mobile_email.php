<?php $this->load->view('common/header');?>
<br><br><br>

<?php  
if(isset($redirectUrl) && $redirectUrl != "") {
    $currentUrl_f = trim($redirectUrl);
} else {
    $currentUrl_f = WEB_URL.'/dashboard';
}

?>


<?php if($verify_type == 1) { ?> 
<div class="twostep withpadd">
	<div class="cenerstepbox">
    	<h4 class="twostp">2-Step Verification</h4>
        <div class="imagemsg"><img src="<?php echo ASSETS;?>images/eml.png" alt=""  /></div>

        <?php 
            //$email_id = $user_data->email; 
            $explode_email_id = explode('@',$email_id);
            $email_username = $explode_email_id[0];
            $length = strlen($email_username)-2; //reduce first and last character and then take that as length.
            $masked_email_id = substr($email_username, 0,1).str_repeat('*', $length).substr($email_username, -1).'@'.$explode_email_id[1]; 
        ?>
        <div class="stpnote">An email to <b><?php echo $masked_email_id; ?></b> has been sent</div>
        <div class="clear"></div>
        <form action="<?php echo WEB_URL;?>/security/verifyTwoStepPassword" method="POST" id="twoStepForm">
            <input type="text" style="margin-bottom: 5px" class="typecode" id="twoStep_e" name="twoStepPwd" placeholder="Enter code" />
            <span style="font-size: small; color: red;" class="errCode"></span>
            <button type="submit" class="fullverify verifyTwoStepEmail" style="width: 100%">Verify</button>
        </form>
    </div><br />
    
	<div class="cenerstepbox">
    	<a style="color: #4b8df9;" id="resendTwoStep">Resend code?</a>
        <span style="float: right;">
            <img class="resendLoader" style="float: right; display: none;" src="<?php echo ASSETS;?>images/loader.gif">
            <span style="color: green; font-size: small; display: none" class="resend_success">Email sent successfully!</span>
        </span>
    </div>
    <br />
    <div class="cenerstepbox">
    	<a class="problm" id="problemreceive" href="<?php echo WEB_URL.'/security/problemLogIn?url='.$currentUrl_f; ?>">Problem receiving your code?</a>
    </div>
</div>
<?php } else if($verify_type == 2) { ?>
    <?php 

        //$contact = $user_data->contact_no; 
        if($this->session->userdata('temp_b2c_id')){
            $contact = $user_data->contact_no; 
        }else if($this->session->userdata('temp_b2b_id')){
            $contact = $user_data->mobile; 
        }
        $length = strlen($contact)-2;
        $masked_contact_no = substr($contact, 0, 1).str_repeat('*', $length).substr($contact, -1);
    ?>
<div class="twostep withpadd">
    <div class="cenerstepbox">
        <h4 class="twostp">2-Step Verification</h4>
        <div class="imagemsg"><img src="<?php echo ASSETS;?>images/textmsg.png" alt=""  /></div>
        <div class="stpnote">A text message with your code has been sent to <b><?php echo $masked_contact_no; ?></b></div>
        <div class="clear"></div>
        
        <form action="<?php echo WEB_URL.'/security/verifyTwoStepSMSPassword' ?>" method="POST" >
            <input type="text" style="margin-bottom: 5px"  class="typecode" id="twoStep_e" name="twoStepPwd" placeholder="Enter code" />
            <span style="font-size: small; color: red;" class="errCode"></span>
            <button class="fullverify verifyTwoStepEmail" style="width: 100%">Verify</button>
        </form>

    </div><br />
    
    <div class="cenerstepbox">
        <a style="color: #4b8df9;" id="resendTwoStep">Resend code?</a>
        <span style="float: right;">
            <img class="resendLoader" style="float: right; display: none;" src="<?php echo ASSETS;?>images/loader.gif">
            <span style="color: green; font-size: small; display: none" class="resend_success">SMS sent successfully!</span>
        </span>
    </div>
    <br />
    <div class="cenerstepbox">
        <a class="problm" id="problemreceive" href="<?php echo WEB_URL.'/security/problemLogIn'; ?>">Problem receiving your code?</a>
    </div>
</div>

<?php } ?>

<?php $this->load->view('common/footer');?>

<script type="text/javascript">
    
$('.verifyTwoStepEmail').on('click', function(e) {
    e.preventDefault();
    var verifyCode = $('#twoStep_e').val(); 
    if(verifyCode) {
        verifyCode = verifyCode.trim();
    }
    if(verifyCode.length != 0 && verifyCode != "undefined") {
        $.ajax({
            url: "<?php echo WEB_URL.'/security/verifyTwoStepPassword' ?>",
            method: "POST",
            data: {twoStepPwd: verifyCode},
            dataType: 'json',
            success: function(r) {
                if(r.status == '1') {
                    window.location.href = "<?php echo $currentUrl_f; ?>";
                } else {
                    $('.errCode').html('Invalid verification code. Please try again.');
                }
            }
        });
    }else {
        $('.errCode').html('Please enter the code');
    }
});

</script>

<script type="text/javascript">
$('#resendTwoStep').on('click', function(e) {
    $('.resendLoader').fadeIn();
    e.preventDefault();
    $.ajax({
        url: "<?php echo WEB_URL.'/security/verifytwostep' ?>",
        method: "POST",
        data: {"ajaxRequest": 1},
        success: function(r) {
            $('.resendLoader').hide();
            $('.resend_success').show();
        }
    })
});
</script>