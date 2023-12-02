<div class="chatrow">
<div class="chaterimage">
<img src="<?php echo $user_details->image; ?>" alt="" style='width:10%;'/>
</div>
<div class="chaterdetail">
<div class="chatip"></div>
<div class="insidechat">
	<div class="chatername"><?php echo $user_details->name; ?></div>
    <div class="chattime"><span class="icon icon-clock"></span><?php echo $this->Support_Model->calculate_time_ago($ticket->last_update_time); ?></div>
    <div class="chatermsg">
	<?php echo $ticket->message; ?>
	<?php
	if($ticket->file_path!=''){
	$file = strtr(base64_encode('admin/'.$ticket->file_path),array('+' => '.','=' => '-','/' => '~'));
	$a = explode('support_ticket', $ticket->file_path);
	$name1 = substr($a[1],3);
	?>
	    <p><a  href="<?php echo base_url(); ?>dashboard/download_file/<?php echo $file; ?>"><i class="icon-paper-clip"></i> <?php echo lang_line('Download_The_Attchment');?> : <?php echo $name1; ?></a>  </p>
	<?php } ?>
    </div>
</div>
</div>
</div>