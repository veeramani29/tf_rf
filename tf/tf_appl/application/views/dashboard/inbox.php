 <!-- Inbox -->


     <div class="tab-pane padding20me <?php if(!empty($page_type) && $page_type == "inbox") {echo "active";} ?>" id="inbox">

        <span class="size16 padtabne bold">
        	<select class="verifysel msgListType">
                <option value="1">Inbox</option>
            	<option value="2">All Messages</option>
                <option value="3">Starred</option>
                <option value="5">Archived</option>
            </select>
        </span>

        <div class="withedrow">
            <div class="rowit">
            <?php if(!empty($getInboxMessages)) { ?>
            <ul id="msgContainer" class="list clearfix" >
            
            <?php foreach($getInboxMessages as $getMsg) { ?>
            <li class="mesginbox">
                <?php // echo $getMsg->message_id; ?>
                <div class="lodrefrent"><div class="centerload"></div></div>
                <div class="item">
                <div class="col-md-2">
                    <div class="wishimg">
                        <?php 
                        if($getMsg->profile_photo != "") { 
                            $profileImage = $getMsg->profile_photo;
                        } else {
                            $profileImage = WEB_URL.'/assets/images/user-avatar.jpg';
                        }
                        ?>
                        <img src=" <?php echo $profileImage; ?> ">
                    </div>
                </div>
                <div class="col-md-2">
                    <a class="inboxlabl">
                        <strong><?php echo ($getMsg->firstname != "") ? $getMsg->firstname : $getMsg->b2b_name; ?></strong>
                        <?php 
                            $msgRecTime = $getMsg->msg_date_time;  
                            $msgStrTotime = strtotime($msgRecTime);
                            $formatRecTime = date("d M, H:i", $msgStrTotime);
                        ?>
                        <strong><?php echo $formatRecTime; ?></strong>
                    </a>
                </div>
                <div class="col-md-4"> 
                    <div class="inboxlabl">
                    <?php if($getMsg->msg_type == '2'){?>
                        <b><?php echo $getMsg->message; ?></b>
                    <?php }else{?>
                    <a href="<?php echo WEB_URL.'/messages/conversation/'.$getMsg->sender_id.'/'.$getMsg->receiver_id.'/'.$getMsg->message_id; ?>">
                        <b><?php echo substr($getMsg->message, 0, 50).'...'; ?></b>
                    </a>
                    <?php }?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="inboxlabl">
                        <?php if($getMsg->msg_type == '2'){?><strong>Booking Request</strong> <?php }else{?>Inquiry<?php }?>
                        <strong><?php echo $getMsg->PROP_RATE_NIGHTLY_FROM; ?> </strong>    
                    </div>
                    <?php if($getMsg->msg_type == '2' && $getMsg->booking_status == 'PENDING'){?>
                        <a class="optioninboxstr inqbk" data-booking-status="1" data-booking-id="<?php echo $getMsg->booking_id; ?>">Confirm</a>
                        <a class="optioninboxstr inqbk" data-booking-status="0" data-booking-id="<?php echo $getMsg->booking_id; ?>">Cancel</a>
                    <?php }else{ echo $getMsg->booking_status;}?>
                </div>
                <div class="col-md-2">

                    <a class="optioninbox star" data-msg_id="<?php echo $getMsg->message_id; ?>">
                        <?php
                        $starVal = $getMsg->starred; //check if starred or not.
                        if($starVal == 0) {
                            $starClass = 'starun';
                        } else if($starVal == 1) {
                            $starClass = '';
                        }
                        ?>
                        <span class="iconstar <?php echo $starClass; ?>">Starred</span>
                    </a>

                    <a class="optioninbox arch" data-msg_id = "<?php echo $getMsg->message_id; ?>" >
                        <?php
                        $archVal = $getMsg->archive; //check if starred or not.
                        
                        if($archVal == 0) {
                            $archClass = '';
                        } else if($archVal == 1) {
                            $archClass = 'archiveun';
                        }
                        ?>
                        <span class="icon icon-archive <?php echo $archClass; ?> "></span>Archived
                    </a>

                </div>
                </div>
            </li>
            <?php } ?>
            </ul>
            <?php } else {  ?>
                <div class="col-md-12" style="margin: 0 auto; text-align: center;">
                    <div class="srywrap"><span class="sorrydiv"><img src="<?php echo WEB_URL; ?>/assets/images/sorry.png" alt="" /></span><b>Nothing here</b></div>
                </div>


            <?php } ?>
            <br /><br />
            
            <div class="holdereInbox"></div>

            </div>
           
           
            
        </div>
 </div> 

<script type="text/javascript">
$(document).on('ready', function(){
    createPagination();
});
</script>


<script type="text/javascript" src="<?php echo ASSETS.'/js/messages/messages.js'; ?>"></script>
     <!-- Inbox End-->