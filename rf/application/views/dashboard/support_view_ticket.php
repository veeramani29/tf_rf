<div id="appendReply">
<?php 
for($i=0;$i<count($ticket);$i++){
if($ticket[$i]->last_updated_by == 'Admin'){

?>
	<div class="chatrow adminchat">
	<div class="chaterimage">
	<img src="<?php echo ASSETS;?>images/user.jpg" alt="" style='width:10%;'/>
	</div>
	<div class="chaterdetail">
	<div class="chatip"></div>
	<div class="insidechat">
		<div class="chatername"><?php echo lang_line('Admin');?></div>
	    <div class="chattime"><span class="icon icon-clock"></span><?php echo $this->Support_Model->calculate_time_ago($ticket[$i]->last_update_time); ?></div>
	    <div class="chatermsg">
	    	<?php echo $ticket[$i]->message; ?>
		<?php
		if($ticket[$i]->file_path!=''){
		$file = strtr(base64_encode('admin/'.$ticket[$i]->file_path),array('+' => '.','=' => '-','/' => '~'));
		$a = explode('support_ticket', $ticket[$i]->file_path);
		$name1 = substr($a[1],3);
		?>
		    <p><a  href="<?php echo base_url(); ?>dashboard/download_file/<?php echo $file; ?>"><i class="icon-paper-clip"></i> <?php echo lang_line('Download_The_Attchment');?> : <?php echo $name1; ?></a>  </p>
		<?php } ?>
	    </div>
	</div>
	</div>
	</div>
    
    
	
	<?php } else{ 
	$user_details = $this->Support_Model->get_user_details($ticketrow->user_type,$ticketrow->user_id);
	?>

	<div class="chatrow">
	<div class="chaterimage">
	<img src="<?php echo $user_details->image; ?>" alt="" style='width:10%;' />
	</div>
	<div class="chaterdetail">
	<div class="chatip"></div>
	<div class="insidechat">
		<div class="chatername"><?php echo $user_details->name; ?></div>
	    <div class="chattime"><span class="icon icon-clock"></span><?php echo $this->Support_Model->calculate_time_ago($ticket[$i]->last_update_time); ?></div>
	    <div class="chatermsg">
		<?php echo $ticket[$i]->message; ?>
		<?php
		if($ticket[$i]->file_path!=''){
		$file = strtr(base64_encode('admin/'.$ticket[$i]->file_path),array('+' => '.','=' => '-','/' => '~'));
		$a = explode('support_ticket', $ticket[$i]->file_path);
		$name1 = substr($a[1],3);
		?>
		    <p><a  href="<?php echo base_url(); ?>dashboard/download_file/<?php echo $file; ?>"><i class="icon-paper-clip"></i> <?php echo lang_line('Download_The_Attchment');?> : <?php echo $name1; ?></a>  </p>
		<?php } ?>
	    </div>
	</div>
	</div>
	</div>
	<?php } }
	$user_details = $this->Support_Model->get_user_details($ticketrow->user_type,$ticketrow->user_id);
	?>
	</div>
    <div class="clear"></div>
    
	<div class="tab-pane" id="addticket">
    <span class="size16 padtabnenopad bold">
    	<span class="tickthed"><?php echo lang_line('Replay_Tickets');?></span>
    </span>
	<div class="chaterimage">
		<img src="<?php echo $user_details->image;?>" alt="" style='width:10%;' />
	</div>
    <div class="withedrow">
        <div class="rowit chngecolr">
          <div class="addtiktble">
         <form action="<?php echo base_url(); ?>dashboard/reply_ticket/<?php echo $id; ?>" method="post"  enctype="multipart/form-data" class='validate form-horizontal' id="addComment">   
         <input type="hidden" name="subject" value="<?php echo $ticketrow->subject; ?>">
        <input type="hidden" name="domain" value="<?php echo $ticketrow->domain; ?>">
        <input type="hidden" name="user_type" value="<?php echo $ticketrow->user_type; ?>">
        <input type="hidden" name="user_id" value="<?php echo $ticketrow->user_id; ?>">
        <input type="hidden" name="support_ticket_id" value="<?php echo $ticketrow->support_ticket_id; ?>">
            <div class="likrticktsec">
                <div class="cobldo"><?php echo lang_line('Attachment');?></div>
                <div class="coltcnt">
                	<input type="file" name="rfile_name" class="payinput" id="files"> 
                </div>
            </div>
            
            <div class="likrticktsec">
                <div class="cobldo"><?php echo lang_line('Message');?></div>
                <div class="coltcnt">
                	<textarea class="tikttext" name="message" id="replaymess" required ></textarea>
                </div>
            </div>
            
            <div class="likrticktsec">
            	<div class="cobldo">&nbsp;</div>
                <div class="coltcnt">
            	<input type="submit" class="adddtickt" value="<?php echo lang_line('Add_Tickets');?>">
                </div>
            </div>
            </form>
          </div>
        </div>
    </div>
</div>


<script type="text/javascript">
$(document).ready(function (e) {	
$("#addComment").on('submit',function(e) {
	e.preventDefault();
	$("#viewticktLdr").show();
	var message = $("#replaymess").val();
	if(message){
	var action = $("#addComment").attr('action');
	var data = new FormData(this);
	var files =  document.getElementById('files').files[0];
	$.ajax({
			type: "POST",
			url: action,
			data: new FormData(this),
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false, 
			dataType: "json",
			success: function(data){
				setTimeout(function() { $("#viewticktLdr").hide() }, 3000);
				$("#appendReply").append(data.tickets);		
				$("#replaymess").val('');
			}
		});
		return false;
	}else{
		return false;
	}
	});
});
</script>