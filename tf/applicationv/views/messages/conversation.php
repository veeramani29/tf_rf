<?php $this->load->view('common/header');?>
    
<div class="full marintopcnt contentvcr">
<div class="container">
<div class="container offset-0">
<div id="conversation_in" class="pconvrstn">   
<div class="col-md-8 nopad">

<?php 
//initialize variables
if(isset($convUserReceiverInfo) && !empty($convUserReceiverInfo)) {
    if(isset($convUserReceiverInfo->profile_photo) && !empty($convUserReceiverInfo->profile_photo)) {
        $senderImg = $convUserReceiverInfo->profile_photo;
    } else if(isset($convUserReceiverInfo->agent_logo) && !empty($convUserReceiverInfo->agent_logo)) {
        $senderImg = $convUserReceiverInfo->agent_logo;
    } else {
        $senderImg = ASSETS.'images/user-avatar.jpg';
    }

    if($convUserReceiverInfo->firstname != "") {
        $senderName = $convUserReceiverInfo->firstname;
    } else {
        $senderName = "InnoGlobe User";
    } 

}

if(isset($convUserSenderInfo) && !empty($convUserSenderInfo)) {
    if(isset($convUserSenderInfo->profile_photo) && !empty($convUserSenderInfo->profile_photo)) {
        $recImg = $convUserSenderInfo->profile_photo;
    } else if(isset($convUserSenderInfo->agent_logo) && !empty($convUserSenderInfo->agent_logo)) {
        $recImg = $convUserSenderInfo->agent_logo;
    } else {
        $recImg = ASSETS.'images/user-avatar.jpg';
    }


    if($convUserSenderInfo->firstname != "") {
        $recName = $convUserSenderInfo->firstname;
    } else {
        $recName = "InnoGlobe User";
    } 
}

$msgData = $conversation[0];
$init_user_id = $msgData->init_user_id;
$init_user_type = $msgData->init_user_type;

$init_receiver_id = $msgData->init_receiver_id;
$init_receiver_type = $msgData->init_receiver_type;
$message_id = $msgData->message_id; 

if($this->session->userdata('b2c_id')){
    $data['user_type']=$current_user_type = 3;
    $data['user_id']=$current_user_id = $this->session->userdata('b2c_id');
}else if($this->session->userdata('b2b_id')){
    $data['user_type']=$current_user_type = 2;
    $data['user_id']=$current_user_id = $this->session->userdata('b2b_id');
}


$conv_property_id = $msgData->property_id;
$msg_receive_time = $msgData->msg_date_time;

?>

    <div class="clear"></div> 
       
        <div class="tab-pane" id="viewticketss">
            <span class="size16 padtabnenopad bold">
                <span class="tickthed">Conversation with <?php echo $recName; ?></span>
            </span>
            
            <div class="withedrow">
                <div class="rowit chngecolr">
                <span class="inqrynote">Inquiry about<strong> <?php echo $getPropertyName->PROP_NAME; ?></strong></span>
                  <div class="addtiktble">
                  
                    <div class="chatrow">
                        <div class="chaterimage">
                        

                        <img class="usr_img" src="<?php echo $senderImg; ?>" alt="" />
                        </div>
                        <div class="chaterdetail">
                            <div class="chatip"></div>
                            <div class="insidechat">
                                <div class="chatername"><?php echo $senderName; ?></div>
                                <div class="chattime"></div>
                                <div class="chatermsg">
                                    <form id="sendMsg" action="<?php echo WEB_URL.'/messages/submitMsg'; ?>" method="POST">
                                        <textarea class="convrstnarea msgTxt" name="msgContent" required></textarea>
                                        
                                        <input type="hidden" name="init_user_id" value="<?php echo $init_user_id; ?>">
                                        <input type="hidden" name="init_user_type" value="<?php echo $init_user_type; ?>">
                                        <input type="hidden" name="init_receiver_id" value="<?php echo $init_receiver_id; ?>">
                                        <input type="hidden" name="init_receiver_type" value="<?php echo $init_receiver_type; ?>">
                                        <input type="hidden" name="message_id" value="<?php echo $message_id; ?>">
                                        <input type="hidden" name="conv_property_id" value="<?php echo $conv_property_id; ?>">
                                        <input type="hidden" name="msg_receive_time" value="<?php echo $msg_receive_time; ?>">
                                        <div class="clear"></div>

                                        <button type="submit" class="acceptcon" id="sendMsg">Send</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div id="convCntnt">
                    <?php foreach($conversation as $conv_key) { ?>
                
                    <?php if($conv_key->sender_id != $current_user_id){ ?>
                    <div class="chatrow adminchat">
                        <div class="chaterimage">
                            <img src="<?php echo $recImg; ?>" alt="" />
                        </div>
                        <div class="chaterdetail">
                            <div class="chatip"></div>
                            <div class="insidechat">
                                <div class="chatername"><?php echo $recName; ?></div>
                                
                                <?php 
                                $msgRecTime = $conv_key->msg_date_time;  
                                $msgStrTotime = strtotime($msgRecTime);
                                $formatRecTime = date("d M, H:i", $msgStrTotime);
                                ?>

                                <div class="chattime"><span class="icon icon-clock"></span><?php echo $formatRecTime; ?></div>
                                <div class="chatermsg">
                                    <?php echo $conv_key->message;  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                   <?php } ?>
                    
                    <div class="clear"></div>
                    
                    <?php if($conv_key->sender_id == $current_user_id){ ?>
                    <div class="chatrow">
                        <div class="chaterimage">
                            <img src="<?php echo $senderImg;?>" alt="" />
                        </div>
                        <div class="chaterdetail">
                            <div class="chatip"></div>
                            <div class="insidechat">
                                <div class="chatername"><?php echo $senderName; ?></div>

                                <?php 
                                $msgRecTime = $conv_key->msg_date_time;  
                                $msgStrTotime = strtotime($msgRecTime);
                                $formatRecTime = date("d M, H:i", $msgStrTotime);
                                ?>

                                <div class="chattime"><span class="icon icon-clock"></span><?php echo $formatRecTime; ?></div>
                                <div class="chatermsg">
                                    <?php echo $conv_key->message;  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php } ?>
                    </div>
                  </div>
                </div>
            </div>
        </div>
</div>


<div class="col-md-4 inboxconrit">
    <div class="conuserin">
        
        <div class="clear"></div>
        <div class="rowxde">
        <div class="conuserinrow">
            <div class="col-md-6"><span class="icon icon-calendar"></span>Check In</div>
            <div class="col-md-6"><?php echo $checkingTime->check_in; ?></div>
        </div>
        <div class="conuserinrow">
            <div class="col-md-6"><span class="icon icon-calendar"></span>Check Out</div>
            <div class="col-md-6"><?php echo $checkingTime->check_out; ?></div>
        </div>
        </div>
        
    </div>
    
    
    
</div>
</div>

</div></div></div>

<?php  
$serverTime = date('Y-m-d H:i:s');
$serverStrToTime = strtotime($serverTime);
$formatServerTime = date("d M, H:i", $serverStrToTime);
?>


<script type="text/javascript">
    senderName = "<?php echo $senderName; ?>";
    serverTime = "<?php echo $formatServerTime; ?>";
</script>
<script type="text/javascript" src="<?php echo ASSETS.'js/messages/messages.js' ?>" ></script>
<?php $this->load->view('common/footer');?>