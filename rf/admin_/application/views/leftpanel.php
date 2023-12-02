<div class="navi">
<?php
$domain_id =$this->session->userdata('domain_id');
 if(! $this->session->userdata('sa_logged_in')){
	 
	 ?>
		<ul class='main-nav'>
			<li >
				<a href="<?php echo WEB_URL; ?>sdadmin/index/<?php echo $domain_id; ?>" class='light'>
					<div class="ico"><i class="icon-home icon-white"></i></div>
					Dashboard
					<!-- <span class="label label-warning">10</span> -->
				</a>
			</li>
            <li>
				<a href="#" class='light toggle-collapsed'>
					<div class="ico"><i class="icon-th-large icon-white"></i></div>
					Manage Profile 
					<img src="<?php echo WEB_DIR; ?>img/toggle-subnav-down.png" alt="">
				</a>
				<ul class='collapsed-nav'>
                <li>
						<a href="<?php echo WEB_URL; ?>sdadmin/my_profile">
							My Profile
						</a>
					</li>
                 
					<li>
						<a href="<?php echo WEB_URL; ?>sdadmin/change_password">
							Change Password
						</a>
					</li>
					
					
				</ul>
			</li>
            <?php
			$domain = $this->Admin_Model->get_domain_list(); 
			if($domain!='')
			{
			for($i=0;$i<count($domain);$i++)
			{
				if($this->session->userdata['domain_name']== $domain[$i]->domain_name)
				{?>                
		    	<li  class="active" >
				<a href="<?php echo WEB_URL; ?>sdadmin/index/<?php echo $domain[$i]->domain_id; ?>" class='light'>
					<div class="ico"><i class="icon-star icon-white"></i></div>
					<?php echo $domain[$i]->domain_name; ?>
						<!-- <span class="label label-warning">10</span> -->
				</a>
			</li>
            	<?php
				}
			}
			}
			
			?>
		</ul>
       <?php
 }
 else
 {
	 ?>
		<ul class='main-nav'>
			<li>
				<a href="<?php echo WEB_URL; ?>" class='light'>
					<div class="ico"><i class="icon-home icon-white"></i></div>
					Dashboard
					<!-- <span class="label label-warning">10</span> -->
				</a>
			</li>
            <li>
				<a href="#" class='light toggle-collapsed'>
					<div class="ico"><i class="icon-th-large icon-white"></i></div>
					Manage Profile 
					<img src="<?php echo WEB_DIR; ?>img/toggle-subnav-down.png" alt="">
				</a>
				<ul class='collapsed-nav '>
                <li>
						<a href="<?php echo WEB_URL; ?>home/my_profile">
							My Profile
						</a>
					</li>
                 
					<li>
						<a href="<?php echo WEB_URL; ?>home/change_password">
							Change Password
						</a>
					</li>
					
					
				</ul>
			</li>
			   <?php
			$domain = $this->Admin_Model->get_domain_list(); 
			if($domain!='')
			{
			for($i=0;$i<count($domain);$i++)
			{
				if(isset($this->session->userdata['domain_id']) && $this->session->userdata['domain_id'] == $domain[$i]->domain_id)
				{
					echo '<li  class="active">';
				}
				else
				{
				   echo '<li>';
				}
				
				?>
                
		    	
				<a href="<?php echo WEB_URL; ?>sdadmin/index/<?php echo $domain[$i]->domain_id; ?>" class='light'>
					<div class="ico"><i class="icon-star icon-white"></i></div>
					<?php echo $domain[$i]->domain_name; ?>
						<!-- <span class="label label-warning">10</span> -->
				</a>
			</li>
            	<?php
			}
			}
			?>
            <?php $user_type = $this->session->userdata('sa_id'); 
				if(!empty($user_type))	{
				if(empty($this->session->userdata['domain_id']))
				{
					$class = "class='active'";
				}	
				else
				{
					$class = "";
				}
				?>
				<li <?php echo $class;?>>
				<a href="<?php echo WEB_URL; ?>sdadmin/setsuper_admin/" class='light'>
					<div class="ico"><i class="icon-star icon-white"></i></div>
					All Domains
						<!-- <span class="label label-warning">10</span> -->
				</a>
				</li>
		  <?php } ?>
		</ul>
	
     <?php
 }
 ?>
	</div>
