<?php $support_pending_header = $this->Support_Model->get_support_list_pending(); 

if($support_pending_header=='')
{
	$support_pending_header_count=0;
}
else
{
	$support_pending_header_count=count($support_pending_header);
}
									
$b2c_useronline =  $this->Home_Model->fetch_b2c_useronline(); 			
						
if($b2c_useronline=='0')
{										
	$b2c_useronline_count = 0;
}
else
{
	$b2c_useronline_count=count($b2c_useronline);
}
$b2b_useronline =  $this->Home_Model->fetch_b2b_useronline(); 			

if($b2b_useronline=='0')
{
										
	$b2b_useronline_count = 0;
}
else
{
	$b2b_useronline_count=count($b2b_useronline);
}

$total_booking = $this->Home_Model->get_booking_detail_count();

$booking_details = $this->Home_Model->get_booking_details();

?>
<div class="topbar">
	<div class="container-fluid">&nbsp;
<img src="<?php echo WEB_DIR; ?>img/logo.png" width="100" />
        <?php
        if(!$this->session->userdata('sa_logged_in')){
			$domain_id =$this->session->userdata('domain_id');
			echo '<a href="'.WEB_URL.'/sdadmin/index/'.$domain_id.'" class="company">'.$this->session->userdata('domain_name').' ';
		}
		else
		{
			echo '<a href="'.WEB_URL.'" class="company">Super Admin Panel';
		}
		?>
	 
        
        </a>
		
		<ul class='mini'>
			<li class='dropdown dropdown-noclose supportContainer'>
				<a href="#" class='dropdown-toggle' data-toggle="dropdown">
					<img src="<?php echo WEB_DIR; ?>img/icons/fugue/book-question.png" alt="">
					Support tickets
					<span class="label label-warning"><?php echo $support_pending_header_count; ?></span>
				</a>
				<ul class="dropdown-menu pull-right custom custom-dark">
				<?php
				if($support_pending_header!='')
									{
										for($i=0;$i<count($support_pending_header);$i++)
											{
												$user_details = $this->Support_Model->get_user_details($support_pending_header[$i]->user_type,$support_pending_header[$i]->user_id);
												$user_type = $this->Support_Model->get_usertype_details($support_pending_header[$i]->user_type);
    											$domain = $this->Support_Model->get_domain_details($support_pending_header[$i]->domain);
											
					?>
                    <li class='custom'>
						<div class="title">	<img src="<?php echo $user_details->image; ?>" width="70">
						<?php echo $support_pending_header[$i]->subject; ?>
							<span><?php echo date('M j,Y',strtotime($support_pending_header[$i]->created_time)); ?> by <a  href="#" class='pover' data-title="<?php echo $user_details->name; ?>" data-content="<?php echo 'Email :'.' '.$user_details->email ;echo '</br>'; echo 'City :'.' '.$user_details->city; echo '</br>'; echo 'Country :'.' '.$user_details->country ;echo '</br>'; echo 'Contact No :'.' '.$user_details->mobile ; ?>">
											<?php echo $user_details->name; ?>
                                                </a></span>
						</div>
						<div class="action">
							<div class="btn-group">
								<a href="<?php echo WEB_URL; ?>support/view_ticket/<?php echo $support_pending_header[$i]->id; ?>" class='tip btn btn-mini' title="Show ticket"><img src="<?php echo WEB_DIR; ?>img/icons/fugue/magnifier.png" alt=""></a>
								
							</div>
						</div>
					</li>
                    <?php
											}
									}
											?>
				<a href="<?php echo WEB_URL?>support/support_view">Show all support tickets</a>
				</ul>
			</li>
			<li class='dropdown pendingContainer'>
				<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
					<img src="<?php echo WEB_DIR; ?>img/icons/fugue/user.png" alt="">
					Online B2C Users
					<span class="label label-success"><?php echo $b2c_useronline_count;?> </span>
				</a>
				<ul class="dropdown-menu pull-right custom custom-dark">
				<?php
			if($b2c_useronline!='0')
									{
										for($i=0;$i<count($b2c_useronline);$i++)
											{		?>
					<li class="custom">
						<div class="title">
						<!-- <img src="<?php echo $b2c_useronline[$i]->profile_photo; ?>" width="70"> -->
						<?php echo $b2c_useronline[$i]->firstname;  ?>
							<span>  <a  href="#" class='pover' data-title="User Information" data-content="<?php echo 'Email :'.' '.$b2c_useronline[$i]->email ;echo '</br>'; echo 'City :'.' '.$b2c_useronline[$i]->city; echo '</br>'; echo 'Country :'.' '.$b2c_useronline[$i]->country ; ?>"> <?php echo $b2c_useronline[$i]->firstname; ?></a></span>
						</div>
						<div class="action">
							<div class="btn-group">
								<a href="<?php echo WEB_URL; ?>notification/b2c_single_notification/<?php echo $b2c_useronline[$i]->user_id; ?>" class='tip btn btn-mini'  title="Send Notification" ><img src="<?php echo WEB_DIR; ?>img/icons/fugue/mail-reply.png" alt=""></a>
								
								
								
							<!-- 		<div class="modal hide" id="myhNotification<?php print $i; ?>">
							  <div class="modal-header">
							    <button type="button" class="close" data-dismiss="modal">×</button>
							    <h3>Send Notification</h3>
							  </div>
            <form action="<?php echo WEB_URL; ?>b2c/send_notification/<?php echo $b2c_useronline[$i]->user_id; ?>" method="post" >
							  <div class="modal-body">
							   	<input type="text" name="notification" id="notification" required="required">
							  </div>
                           
							  <div class="modal-footer">
							    <a href="#" class="btn" data-dismiss="modal">Close</a>
              <input type="submit" class='btn btn-primary'>
							   
							  </div>
                                 </form>
							</div>	 -->
								<!-- <a href="#" class='tip btn btn-mini' title="Delete"><img src="<?php echo WEB_DIR; ?>img/icons/fugue/cross.png" alt=""></a> -->
							</div>
						</div>
					</li>
					<?php
  }
  }					
					
					?>
                 <!--    <li class='custom'>
						<div class="title">
							Pending Users #1 
							<span>Jul 22, 2012 by <a href="#" class='pover' data-title="Hover me" data-content="User information comes here">Hover me</a></span>
						</div>
						<div class="action">
							<div class="btn-group">
								<a href="#" class='tip btn btn-mini' title="Send Message"><img src="<?php echo WEB_DIR; ?>img/icons/fugue/mail-reply.png" alt=""></a>
								<a href="#" class='tip btn btn-mini' title="Delete"><img src="<?php echo WEB_DIR; ?>img/icons/fugue/cross.png" alt=""></a>
							</div>
						</div>
					</li>
                   	<li class='custom custom-hidden'>
						<div class="title">
							Pending Users #1 
							<span>Jul 22, 2012 by <a href="#" class='pover' data-title="Hover me" data-content="User information comes here">Hover me</a></span>
						</div>
						<div class="action">
							<div class="btn-group">
								<a href="#" class='tip btn btn-mini' title="Send Message"><img src="<?php echo WEB_DIR; ?>img/icons/fugue/mail-reply.png" alt=""></a>
								<a href="#" class='tip btn btn-mini' title="Delete"><img src="<?php echo WEB_DIR; ?>img/icons/fugue/cross.png" alt=""></a>
							</div>
						</div>
					</li>
                    <li class='custom custom-hidden'>
						<div class="title">
							Pending Users #1 
							<span>Jul 22, 2012 by <a href="#" class='pover' data-title="Hover me" data-content="User information comes here">Hover me</a></span>
						</div>
						<div class="action">
							<div class="btn-group">
								<a href="#" class='tip btn btn-mini' title="Send Message"><img src="<?php echo WEB_DIR; ?>img/icons/fugue/mail-reply.png" alt=""></a>
								<a href="#" class='tip btn btn-mini' title="Delete"><img src="<?php echo WEB_DIR; ?>img/icons/fugue/cross.png" alt=""></a>
							</div>
						</div>
					</li> -->
                  <!--   <li class="custom">
						<div class="expand_custom">
							<a href="#">Show all B2C Users</a>
						</div>
					</li> -->
				</ul>
			</li>
            <li class='dropdown pendingContainer'>
				<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
					<img src="<?php echo WEB_DIR; ?>img/icons/fugue/user.png" alt="">
					Online B2B Users
					<span class="label label-success"><?php echo $b2b_useronline_count;?></span>
				</a>
				<ul class="dropdown-menu pull-right custom custom-dark">
				<?php
			if($b2b_useronline!='0')
				{
				for($i=0;$i<count($b2b_useronline);$i++)
						{		?>
				
					<li class='custom'>
						<div class="title">
								<?php echo $b2b_useronline[$i]->company_name;  ?>
							<span><a  href="#" class='pover' data-title="Agent Information" data-content="<?php echo 'Email :'.' '.$b2b_useronline[$i]->email_id ;echo '</br>'; echo 'City :'.' '.$b2b_useronline[$i]->city; echo '</br>'; echo 'Country :'.' '.$b2b_useronline[$i]->country ; ?>"> <?php echo $b2b_useronline[$i]->company_name; ?></a></span>
						</div>
						<div class="action">
							<div class="btn-group">
								<a href="<?php echo WEB_URL; ?>notification/b2b_single_notification/<?php echo $b2b_useronline[$i]->agent_id; ?>" class='tip btn btn-mini' title="Send Notification"><img src="<?php echo WEB_DIR; ?>img/icons/fugue/mail-reply.png" alt=""></a>
								<!-- <a href="#" class='tip btn btn-mini' title="Delete"><img src="<?php echo WEB_DIR; ?>img/icons/fugue/cross.png" alt=""></a> -->
							</div>
						</div>
					</li>
						<?php
        }
        }					
					
					?>
					
				</ul>
			</li>
            <li class='dropdown pendingContainer'>
				<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
					<img src="<?php echo WEB_DIR; ?>img/icons/fugue/color.png" alt="">
					Bookings
					<span class="label label-warning"><?php echo $total_booking[0]->count; ?></span>
				</a>
				
				<ul class="dropdown-menu pull-right custom custom-dark">
				<?php if(!empty($booking_details)) {  
					foreach($booking_details as $key => $value) 
				{ ?>
				<li class='custom'>
						<div class="title">
							PNR no : <?php echo $value->pnr_no;?>
							<span><?php echo date('M d,Y',strtotime($value->voucher_date)); ?>
							<!-- <a href="#" class='pover' data-title="Hover me" data-content="User information comes here">Hover me</a></span> -->
						</div>
						
						<!-- <div class="action">
							<div class="btn-group">
								<a href="#" class='tip btn btn-mini' title="Send Message"><img src="<?php echo WEB_DIR; ?>img/icons/fugue/mail-reply.png" alt=""></a>
								<a href="#" class='tip btn btn-mini' title="Delete"><img src="<?php echo WEB_DIR; ?>img/icons/fugue/cross.png" alt=""></a>
							</div>
						</div> -->
					</li>
					<a href="<?php echo WEB_URL?>manageorders/view_orders">Show all bookings</a>
				
				<?php } } ?>
				</ul>
					
				
			</li>
			<li class='dropdown messageContainer'>
				<!-- <a href="#" class='dropdown-toggle' data-toggle='dropdown'>
					<img src="<?php echo WEB_DIR; ?>img/icons/fugue/balloons-white.png" alt="">
					Messages
					<span class="label label-info">3</span>
				</a> -->
				<ul class="dropdown-menu pull-right custom custom-dark">
					<li class='custom'>
						<div class="title">
							Hello, whats your name?
							<span>Jul 22, 2012 by <a href="#" class='pover' data-title="Hover me" data-content="User information comes here">Hover me</a></span>
						</div>
						<div class="action">
							<div class="btn-group">
								<a href="#" class='tip btn btn-mini' title="Show message"><img src="<?php echo WEB_DIR; ?>img/icons/fugue/magnifier.png" alt=""></a>
								<a href="#" class='tip btn btn-mini' title="Reply message"><img src="<?php echo WEB_DIR; ?>img/icons/fugue/mail-reply.png" alt=""></a>
							</div>
						</div>
					</li>
				</ul>
			</li>
			<li>
				<a href="<?php echo WEB_URL; ?>home/settings">
					<img src="<?php echo WEB_DIR; ?>img/icons/fugue/gear.png" alt="">
					Settings
				</a>
			</li>
			<li>
				<a href="<?php echo WEB_URL; ?>login/logout">
					<img src="<?php echo WEB_DIR; ?>img/icons/fugue/control-power.png" alt="">
					Logout
				</a>
			</li>
		</ul>
	</div>
</div>
