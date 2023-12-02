<!-- TAB 1 -->
<div class="tab-pane rfboxed-background <?php if(!empty($page_type) && $page_type == "profile") {echo "active";} ?>" id="profile">
  <div class="col-md-3">
    <div class="userprowrp">
      <div class="profileusrs" style="position: relative">
        <div class="lodrefrentrev imgLoader">
          <div class="centerload"></div>
        </div>
        <img src="<?php echo $profile_photo;?>" alt="" class="profile_photo"/>
        <div class="overlaychange">
          <span class="chngers"><?php echo lang_line('CHNAGE_IMG');?></span>
          <form id="myForm" action="<?php echo WEB_URL.'/dashboard/update_user_profile_image'; ?>" method="POST" enctype="multipart/form-data" >
            <input class="rschange" type="file" name="profilePhoto" id="profilePhoto" value="upload photo">
          </form>
        </div>
      </div>
      <h3 class="proname"><?php echo $userInfo->firstname.' '.$userInfo->lastname;?></h3>
    </div>
    <div class="spacer20"></div>
    <ul class="sideul normal-list">
      <li class="sidepro <?php if(!empty($page_type) && $page_type == "profile" && $sub_type == "") {echo "active";} else if(empty($page_type)){ echo "active";}else if(!empty($page_type) && $page_type != "profile") {echo "active";}?>">
        <a href="#viewpro" class="dshbrdLnk" data-link="<?php echo base_url().'dashboard/profile' ?>" data-toggle="tab"><?php echo lang_line('VIEW_PROFILE');?></a>
      </li>
      <li class="sidepro <?php if(!empty($page_type) && $page_type == "profile" && $sub_type == "update") {echo "active";} ?>">
        <a href="#editpro" class="dshbrdLnk" data-link="<?php echo base_url().'dashboard/profile/update'; ?>" data-toggle="tab"><?php echo lang_line('EDIT_PROFILE');?></a>
      </li>
    </ul>
  </div>
  <div class="col-md-9">
    <div class="tab-content5">
      <div class="tab-pane <?php if(!empty($page_type) && $page_type == "profile" && $sub_type == "") {echo "active";} else if(empty($page_type)){ echo "active";}else if(!empty($page_type) && $page_type != "profile") {echo "active";}?>" id="viewpro"> 
        <!-- Admin top -->
        <div class="col-md-5 nopadd offset-0">
          <div class="fstusrp" style="position: relative"> 
            <div class="lodrefrentrev imgLoader">
              <div class="centerload"></div>
            </div>
            <img src="<?php echo $profile_photo;?>" alt="" class="profile_photo"/> 
          </div>
          <p class="size12 grey"> <?php echo welcome();?> <span class="lred"><?php echo $userInfo->firstname;?></span></p>
          <a href="<?php echo WEB_URL;?>/users/show/<?php echo $user_type; ?>/<?php echo $user_id;?>" class="btn btns-primary">
            <?php echo lang_line('VIEW_PROFILE');?>
          </a>
          <div class="clearfix"></div>
        </div>
        <?php 
        if(!empty($ApartmentBookings)){ 
          $failed=array();$confirmed=array();$pending=array();$cancelled=array();
          foreach($ApartmentBookings as $booking){
            if($booking->booking_status == 'FAILED')
            {
              $failed[] = $booking->api_status;
            }
            if($booking->booking_status == 'CONFIRMED')
            {
              $confirmed[] = $booking->booking_status;
            }
            if($booking->booking_status == 'PENDING')
            {
              $pending[] = $booking->booking_status;
            }
            if($booking->booking_status == 'CANCELED')
            {
              $cancelled[] = $booking->booking_status;
            }
            $days[] = $booking->amount;
          } 
          $failed_count = count($failed);
          $confirmed_count = count($confirmed);
          $pending_count = count($pending);
          $cancelled_count = count($cancelled);
          $days_count = array_sum($days);
          $trips_count = count($ApartmentBookings);
        }else{
          $failed_count = 0;
          $confirmed_count = 0;
          $pending_count = 0;
          $cancelled_count = 0;
          $days_count = 0;
        }
        ?>
        <div class="col-md-7 offset-0">
          <div class="mytbl">
            <ul class="grey list-inline">
              <li class="text-center">
                <span class="size30 slim lh4"><?php if(isset($trips_count)){ echo $trips_count; } ?></span><br/>
                <span class="size12"><?php echo lang_line('TRIPS');?> </span>
              </li>
              <li class="text-center">
                <span class="size30 slim lh4"><?php echo $confirmed_count;?></span><br/>
                <span class="size12"><?php echo lang_line('CNFRMD');?> </span>
              </li>
              <li class="text-center">
                <span class="size30 slim lh4"><?php echo $pending_count;?></span><br/>
                <span class="size12"><?php echo lang_line('PENDING');?> </span>
              </li>
              <li class="text-center">
                <span class="size30 slim lh4"><?php echo $cancelled_count;?></span><br/>
                <span class="size12"><?php echo lang_line('CANCELLED');?> </span>
              </li>
              <li class="text-center">
                <span class="size30 slim lh4"><?php echo $failed_count;?></span><br/>
                <span class="size12"><?php echo lang_line('FAILED');?> </span>
              </li>
            </ul>
            <div class=" sanscol">
            </div>
          </div>
        </div>
        <!-- End of Admin top -->
        <div class="clear"></div>
        <div class="row pro_userdatails">

          <div class="col-md-6 grey nopadd"> 
            <div class="inrowit">
              <span class="pro_title dark"><?php echo lang_line('PERSONAL_DETAILS');?></span>
              <div class="line2"></div>
              <div class="pro_contant">
                <?php if($userInfo->address != "") { ?>
                <a href="#" class="clblue"><?php echo $userInfo->address; ?></a><br/>
                <?php } ?> 

                <?php if($contact_no != "") { ?>                      
                <a href="#" class="clblue"><?php echo $contact_no; ?></a><br/>
                <?php } ?>

                <div class="full_width text-center">
                  <a href="<?php echo WEB_URL.'/dashboard/profile/update'; ?>" class="btn btns-primary"><?php echo lang_line('UPDATE_PROFILE');?></a>
                </div> 
              </div>
            </div>
          </div>
          <div class="col-md-6 nopadd"> 
            <div class="inrowit marr0">
              <span class="pro_title dark"><?php echo lang_line('UPCOMING_BOKKINGS');?></span>
              <div class="line2"></div>
              <div class="pro_contant">
                <?php  
                $count = 0;
                if(!empty($ApartmentBookings)) {
                  foreach($ApartmentBookings as $ApartmentBookings_key) {
                    if($count < 2) {
                      echo '<a href="'.WEB_URL.'/dashboard/bookings" class="clblue">'.$ApartmentBookings_key->module.' - '.$ApartmentBookings_key->pnr_no.'</a> from <span class="bold green">'.CURR_ICON.$ApartmentBookings_key->amount.'</span><br/>';
                      $count++;
                    } else {
                      break;
                    }
                  }
                } else {
                  echo "<p>".lang_line('NO_BOOKINGS_YET')."</p>";
                }
                ?>
                <div class="full_width text-center">
                  <a href="<?php echo WEB_URL.'/dashboard/bookings'; ?>" class="btn btns-primary"><?php echo lang_line('SEE_ALL');?></a> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view('dashboard/profile/edit_profile');?>
      <?php $this->load->view('dashboard/profile/verifications');?>  
      <?php $this->load->view('dashboard/profile/reviews');?>            
      <?php $this->load->view('dashboard/profile/references');?> 
    </div>
    <div class="clearfix"></div>
  </div>
</div>
<!-- END OF TAB 1 --> 
