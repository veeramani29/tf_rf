<?php $this->load->view('common/header');?>
<br><br><br>
<?php  
    $currentUrl = $_SERVER['QUERY_STRING'] ? $_SERVER['QUERY_STRING'] : '';
    
    $getUrl = $this->input->get('url');

    if(isset($getUrl) && $getUrl != "") {
        if($currentUrl != '') {
            $redirectUrlArray = explode('url=', $currentUrl);
            $redirectUrl = $redirectUrlArray[1]; //get variable's url value
        } else {
            $redirectUrl = '';
        }
    } else {
        $redirectUrl = '';
    }
    
?>
<div class="twostep withpadd">
    <div class="cenerstepbox">
        <h4 class="twostp">2-Step Verification</h4>
        <div class="imagemsg"><img src="<?php echo ASSETS;?>images/secqus.png" alt="" /></div>
        <div class="stpnote">Answer the security question below.</div>
        <div class="clear"></div>
        <div class="qstn">
            <span class="secqstn"><?php echo $security_question->security_question; ?></span>
            <input type="text" id="ans" class="typecodeans" placeholder="Type here" />
            <span style="font-size: small; color: red;" class="errAns"></span>
        </div>
        
        <button type="submit" style="width: 100%" class="fullverify" id="submitAns">Submit</button>
    </div>
</div>
<input type="hidden" value="<?php echo $security_question->security_question; ?>" id="qus" >


<?php $this->load->view('common/footer');?>

<script type="text/javascript">
    $('#submitAns').on('click', function() {
        var qus = $('#qus').val();
        var ansec = $('#ans').val();
        if(ansec && qus) {
            ansec = ansec.trim();
            qus = qus.trim();
            if(ansec.length > 0 && qus.length > 0) {
                $.ajax({
                    url: "<?php echo WEB_URL.'/security/checkSecurityAnswer' ?>",
                    method: "POST",
                    data: {'qus': qus, 'ansec': ansec},
                    dataType: "JSON",
                    success: function(r){ 
                        console.log(r.status);
                        if(r.status == 1) {
                            $('.errAns').html('');
                            window.location.href = "<?php echo WEB_URL.'/security/loginBySecurityAnswer?url='.$redirectUrl; ?>"
                        } else {
                           $('.errAns').html('The answer did not matched.');
                        }
                    }
                })
            }
        } else {
            $('.errAns').html('Please enter the security answer.');
        }
    })
</script>

