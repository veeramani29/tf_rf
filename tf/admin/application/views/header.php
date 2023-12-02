<?php 
  if($this->session->userdata("admin_logged_in")){
    $user_sess = $this->session->userdata("admin_email");
  }else if($this->session->userdata("sa_logged_in")){
    $user_sess = $this->session->userdata("sa_email");
  }
  else if($this->session->userdata("supplier_logged_in")){
    $user_sess = $this->session->userdata("supplier_email");
  }
?>
<link href="<?=base_url();?>assets/stylesheets/plugins/flags/flags.css" media="all" rel="stylesheet" type="text/css" />
<header>
      <nav class='navbar navbar-default navbar-fixed-top'>
        <a class='navbar-brand' href='<?=base_url();?><?php if($this->session->userdata("admin_logged_in")){echo"sdadmin";}?>'>
          <img width="100" height="40" class="logo" alt="Flatty" src="<?=base_url();?>assets/images/logo.png" />
          <img width="21" height="21" class="logo-xs" alt="Flatty" src="<?=base_url();?>assets/images/logo_xs.png" />
        </a>
        <a class='toggle-nav btn pull-left' href='#'>
          <i class='icon-reorder'></i>
        </a>
        
        <ul class='nav'>
        <?php
		 if($this->session->userdata("sa_logged_in")){
			 
			 $this->Transaction_Model->update_transaction_details_status();
			 $d_r = $this->Home_Model->get_deposit_request();
			 $b_a = $this->Home_Model->get_b2b_agent();
			 $bs_t = $this->Home_Model->get_b2b_support_ticket();
			 $bcs_t = $this->Home_Model->get_b2c_support_ticket();
			 $bt_t = $this->Home_Model->get_b2b_transaction_details();
			 $bct_t = $this->Home_Model->get_b2c_transaction_details();
			 ?>
<!--        <li class='dropdown medium only-icon widget'>
            <a class='dropdown-toggle has-tooltip' data-placement='bottom' data-toggle='dropdown' href='#'  title="Deposit Request">
              <i class='icon-credit-card '></i>
              <div class='label'><?php echo $d_r['cnt']; ?></div>
            </a>
            <ul class='dropdown-menu'>
            <?php 
			if($d_r['result']!='') { foreach($d_r['result'] as $res) { ?>
              <li>
                <a href='<?php echo WEB_URL; ?>deposit/agent_deposit_view/<?php echo $res->agent_id; ?>'>
                  <div class='widget-body'>
                    <div class='pull-left icon'>
                      <img width="23" src="<?php echo $res->userimage; ?>">
                    </div>
                    <div class='pull-left text'><?php echo $res->username; ?>&nbsp;<small class='text-muted'><?php echo $res->transaction_id; ?></small>
                    </div>
                  </div>
                </a>
              </li>
              <li class='divider'></li>
         <?php  }  } ?>
              <li class='widget-footer'>
               <?php if($d_r	['cnt']!=0) { ?>
                <a href='<?php echo WEB_URL; ?>deposit/agent_deposit_overall_view'>View All</a>
                  <?php } else { ?> <a href=''>No Record Found!</a><?php } ?>
              </li>
            </ul>
          </li>-->
          <!-- <li class='dropdown medium only-icon widget'>
            <a class='dropdown-toggle  has-tooltip' data-toggle='dropdown' data-placement='bottom' title="Inactive Agents"  href='#'>
              <i class='icon-group'></i>
              <div class='label'><?php echo $b_a['cnt']; ?></div>
            </a>
            <ul class='dropdown-menu'>
            <?php 
			if($b_a['result']!='') { foreach($b_a['result'] as $res) { ?>
              <li>
                <a href='<?php echo WEB_URL; ?>b2b/view_profile/<?php echo $res->agent_id; ?>'>
                  <div class='widget-body'>
                    <div class='pull-left icon'>
                      <img width="23" src="<?php echo $res->userimage; ?>">
                    </div>
                    <div class='pull-left text'><?php echo $res->username; ?>&nbsp;<small class='text-muted'>On <?php echo $res->register_date; ?></small>
                    </div>
                  </div>
                </a>
              </li>
              <li class='divider'></li>
         <?php  }  } ?>
              <li class='widget-footer'>
              <?php if($b_a['cnt']!=0) { ?>
                <a href='<?php echo WEB_URL; ?>b2b/b2b_view'>View All</a>
                <?php } else { ?><a href=''>No Record Found!</a><?php } ?>
              </li>
            </ul>
          </li>-->
        
          
         <li class='dropdown medium only-icon widget'>
            <a class='dropdown-toggle has-tooltip' data-toggle='dropdown' title="B2C Support Ticket Inbox" data-placement='bottom' href='#'>
              <i class='icon-group'></i><i class='icon-ticket'></i>
              <div class='label'><?php echo $bcs_t['cnt']; ?></div>
            </a>
            <ul class='dropdown-menu'>
            <?php 
			if($bcs_t['result']!='') { foreach($bcs_t['result'] as $res) { ?>
              <li>
                <a href='<?php echo WEB_URL; ?>support/view_ticket/<?php echo $res->sid;?>'>
                  <div class='widget-body'>
                    <div class='pull-left icon'>
                      <img width="23" src="<?php echo $res->userimage; ?>">
                    </div>
                    <div class='pull-left text'><?php echo $res->username; ?>&nbsp;<small class='text-muted'><?php echo $res->support_ticket_id; ?></small>
                    </div>
                  </div>
                </a>
              </li>
              <li class='divider'></li>
         <?php  }  } ?>
              <li class='widget-footer'>
              <?php if($b_a['cnt']!=0) { ?>
                <a href='<?php echo WEB_URL; ?>support/support_view'>View All</a>
                <?php } else { ?><a href=''>No Record Found!</a><?php } ?>
              </li>
            </ul>
          </li>
          
          <?php
		 }
		 ?>
          <li class='dropdown dark user-menu'>
            <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
               <i class='icon-user'></i>
              <span class='user-name'><?=$user_sess;?></span>
              <b class='caret'></b>
            </a>
            <?php if($this->session->userdata("admin_logged_in")){?>
             <ul class='dropdown-menu'>
              <li>
                <a href='<?php echo WEB_URL; ?>sdadmin/my_profile'>
                  <i class='icon-user'></i>
                  Profile
                </a>
              </li>
              <li>
                <a href='<?php echo WEB_URL; ?>sdadmin/change_password'>
                  <i class='icon-lock'></i>
                  Change Password
                </a>
              </li>
              <li class='divider'></li>
              <li>
                <a href='<?php echo WEB_URL; ?>login/logout'>
                  <i class='icon-signout'></i>
                  Sign out
                </a>
              </li>
            </ul>
            <?php } else if($this->session->userdata("sa_logged_in")){?>
            <ul class='dropdown-menu'>
              <li>
                <a href='<?php echo WEB_URL; ?>home/my_profile'>
                  <i class='icon-user'></i>
                  Profile
                </a>
              </li>
              <li>
                <a href='<?php echo WEB_URL; ?>home/change_password'>
                  <i class='icon-lock'></i>
                  Change Password
                </a>
              </li>
              <li>
                <a href='<?php echo WEB_URL; ?>home/settings'>
                  <i class='icon-cog'></i>
                  Settings
                </a>
              </li>
              <li class='divider'></li>
              <li>
                <a href='<?php echo WEB_URL; ?>login/logout'>
                  <i class='icon-signout'></i>
                  Sign out
                </a>
              </li>
            </ul>
            <?php }
			else if($this->session->userdata("supplier_logged_in")){?>
            <ul class='dropdown-menu'>
            
              <li>
                <a href='<?php echo WEB_URL; ?>login/supplier_logout'>
                  <i class='icon-signout'></i>
                  Sign out
                </a>
              </li>
            </ul>
            <?php }?>
			
            
          </li>
        </ul>

      </nav>
    </header>
    
<script type="text/javascript">
  api_url = '<?php echo WEB_URL; ?>';

</script>
