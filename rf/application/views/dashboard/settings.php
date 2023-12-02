<!-- TAB 4 -->
<div class="tab-pane rfboxed-background <?php if(!empty($page_type) && $page_type == "settings") {echo "active";} ?>" id="settings">
    <div class="col-sm-12"> 
        <div class="clear"></div>
        <div class="settingtab_container">
            <span class="padtabne size16"><?php echo lang_line('CHNAGE_PSWD');?></span>
            <div class="rowit marbotom20">
                <div class="inreprow">
                    <div class="col-md-12 nopad">
                        <div class="col-md-3">
                            <div class="imagestep">
                                <img src="<?php echo ASSETS;?>images/passwd-change.svg" alt="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="stepshed"><?php echo lang_line('U_CAN_CHNAGE_PSWD');?></h4>
                            <div class="stepspara">
                                <strong><?php echo lang_line('UPDATE_UR_PSWD');?></strong>
                            </div>
                        </div>                
                        <div class="col-md-3 stepsbtn">
                            <a class="btn btns-primary" id="changepaswrd"><?php echo lang_line('CHNAGE_PSWD');?></a>
                        </div>
                        <div class="clear"></div>
                        <form name="change_password" onsubmit="passwordchanges()" id="change_password" action="<?php echo WEB_URL;?>/dashboard/ChangePassword">
                            <div class="fullquestionswrp3">
                                <div class="fullquestions">
                                    <h4 class="editquestions"><?php echo lang_line('change_PSWD');?></h4>
                                    <?php if(!empty($userInfo->password)){?>
                                    <div class="rowshare">
                                        <div class="col-xs-6">
                                            <div class="lablshare"><?php echo lang_line('CURRENT_PSWD');?></div>
                                        </div>
                                        <div class="col-xs-6">
                                            <input type="password" id="password" name="opassword" class="typecodeans form-control notypmar" required />
                                        </div>
                                    </div>
                                    <?php }?>
                                    <div class="rowshare">
                                        <div class="col-xs-6">
                                            <div class="lablshare"><?php echo lang_line('NEW_PSWD');?></div>
                                        </div>
                                        <div class="col-xs-6">
                                            <input type="password" id="npassword"  name="password"  minlength="5" maxlength="50" required class="typecodeans form-control notypmar" />
                                        </div>
                                    </div>
                                    <div class="rowshare">
                                        <div class="col-xs-6">
                                            <div class="lablshare"><?php echo lang_line('CONF_PSWD');?></div>
                                        </div>
                                        <div class="col-xs-6">
                                            <input type="password" required  name="cpassword"  class="typecodeans form-control notypmar" />
                                        </div>
                                    </div>
                                    <div class="full_width text-center">
                                        <button type="submit" class="comnbutton btn btn-primary" ><?php echo lang_line('UPDATE_PSWD');?></button>
                                    </div>

                                    <span  id="passwordchanges" class="passucss"><span class="icon icon-check"></span><?php echo lang_line('PSWD_CHNAGED');?></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="settingtab_container">
            <div class="newsletter_container">
                <div  class="padtabne size16"><?php echo lang_line('NEWSLETTER');?></div>
                <div class="rowit marbotom20">
                    <div class="inreprow">
                        <div class="col-md-12 nopad">
                            <div class="col-md-3">
                                <div class="imagestep">
                                    <img src="<?php echo ASSETS;?>images/newsletters.svg" alt="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="stepshed"><?php echo lang_line('NEWSLETTER_TITLE');?></h4>
                                <div class="stepspara">
                                    <strong><?php echo lang_line('GET_DAILY_UPDATE');?></strong>
                                    <br>
                                    <img class="nl_subs_loader" style="display: none;" src="<?php echo ASSETS.'images/loader.gif'; ?>">
                                    <span class="ns_subd" style="color: green; font-size: small; display: none;"><?php echo lang_line('NEWSLETTER_THANK_MSG');?></span>
                                    <span class="ns_unsub" style="color: red; font-size: small; display: none;"><?php echo lang_line('NEWSLETTER_UNSBS_MSG');?></span>
                                </div>
                            </div>
                            <div class="col-md-3 stepsbtn">
                                <a class="btn btns-primary" check="<?php echo $getNewsletterStatus;?>" id="checkNewsLetter"><?php echo ($getNewsletterStatus == 1) ? 'UnSubscribe' : 'Subscribe'; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="settingtab_container">
            <span class="padtabne size16"> <?php echo lang_line('CANCEL_ACCOUNT');?></span>
            <div class="rowit marbotom20">
                <div class="inreprow">
                    <div class="col-md-12 nopad">
                        <div class="col-md-3">
                            <div class="imagestep">
                                <img src="<?php echo ASSETS;?>images/icons/cancel.svg" alt="" />
                            </div>
                        </div>
                        <div class="col-md-6 nopad">
                            <h4 class="stepshed"> <?php echo lang_line('CANCEL_ACCOUNT');?></h4>
                            <div class="stepspara"><strong><?php echo lang_line('VERIFICATION_CODE');?></strong>
                                <?php echo lang_line('CANCEL_ACCOUNT_MSG1');?></div>
                            </div>
                            <div class="col-md-3 stepsbtn">
                                <a id="cancelAccount" class="btn btns-primary"> <?php echo lang_line('CANCEL_ACCOUNT');?></a>
                            </div>
                            <div class="clear"></div>
                            <div class="popup_wrapper fullquestionswrp4 modal-lg">
                                <div class="cancelaccount_settings rfboxed-backgroundf">
                                    <div class="popuperror" style="display:none;"></div>
                                    <div  class="pophed"> <?php echo lang_line('CANCEL_ACCOUNT');?></div>
                                    <div class="signdiv">
                                        <div class="rowlistwish">
                                            <strong><?php echo lang_line('CANCEL_ACCOUNT_MSG2');?></strong>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="downselfom">
                                            <a class="btn btns-primary" id="hideCancelPopup"><?php echo lang_line('CANCEL');?></a>
                                            <a class="btn btns-primary pull-right" id="startCancelProc"><?php echo lang_line('START_CANCELLING');?></a>
                                        </div>
                                    </div>     
                                </div>
                            </div>
                            <div id="cancel2stepVerify" class="wellme modal-lg set_cancelmodal" style="display: none;">
                                <div class="popuperror" style="display:none;"></div>
                                <div  class="pophed"><?php echo lang_line('CANCEL_ACCOUNT');?></div>
                                <div class="signdiv">
                                    <div class="rowlistwish">
                                        <strong><?php echo lang_line('ENTER_VERIFICATION_CODE');?> <span id="typeString"></span> </strong>
                                        <div class="form-inline dis-inlineb">
                                            <input type="text" class="fulwish form-control" id="twoStepCode" style="border: 1px solid #ccc" />
                                        </div>
                                        <span id="verificationCodeErr" style="color:red; font-size: small"></span>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="downselfom">
                                        <a class="savewish colorsave" id="verifyPswd"><?php echo lang_line('SUBMIT');?></a>
                                    </div>
                                </div>
                            </div>
                            <div id="cancelLoginPswd" class="wellme modal-lg set_cancelmodal" style="display: none;">
                                <div class="popuperror" style="display:none;"></div>
                                <div  class="pophed"> <?php echo lang_line('CANCEL_ACCOUNT');?></div>
                                <div class="signdiv">
                                    <div class="rowlistwish">
                                        <strong><?php echo lang_line('UPDATE_UR_PSWD');?></strong>
                                        <div class="form-inline dis-inlineb">
                                            <input type="text" class="fulwish form-control" id="oneStepCode" style="border: 1px solid #ccc" />
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="downselfom">
                                        <a class="btn btns-primary" id="verifyOneStepPswd"><?php echo lang_line('SUBMIT');?></a>
                                    </div>
                                </div>
                            </div>
                            <div class="wellme col-md-2" style="display: none" id="showLoader">
                                <div class="rowlistwish">
                                    <div style="text-align: center">
                                        <img src="<?php echo ASSETS.'/images/loader.gif'; ?>">
                                        <div><b><?php echo lang_line('PLS_WAIT');?>.</b></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF TAB 4 --> 
    <link href="<?php echo ASSETS; ?>css/toggle-switch.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/settings/settings.js"></script>
    <?php 
    $flashData_twoStp = $this->session->flashdata('twoStepEnabled');
    $flashData_twoStepEnableType = $this->session->flashdata('twoStepEnableType');
    if(isset($flashData_twoStp) && $flashData_twoStp != "" && isset($flashData_twoStepEnableType) && $flashData_twoStepEnableType != "" ) {
        if($flashData_twoStp == 'enabled' && $flashData_twoStepEnableType == 'two_step_email') {
            ?>
            <script type="text/javascript">
            $('.msg').text('<?php echo lang_line("TWO_STEP_VERIFICATION");?>');
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