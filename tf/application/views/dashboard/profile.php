 <!-- TAB 1 -->
      <div class="tab-pane padding20me <?php if(!empty($page_type) && $page_type == "profile") {echo "active";} ?>" id="profile">
        <div class="col-md-3">
          <div class="userprowrp">
              <div class="profileusrs" style="position: relative">
                <div class="lodrefrentrev imgLoader">
                  <div class="centerload"></div>
                </div>
                <img src="<?php echo $profile_photo;?>" alt="" class="profile_photo"/>
                <div class="overlaychange">
                	<span class="chngers"><?=lang('Change_Image');?></span>
                  <form id="myForm" action="<?php echo WEB_URL.'/dashboard/update_user_profile_image'; ?>" method="POST" enctype="multipart/form-data" >
                    <input class="rschange" type="file" name="profilePhoto" id="profilePhoto" value="upload photo">  
                  </form>
                </div>
              </div>
              <h3 class="proname"><?php echo $userInfo->firstname.' '.$userInfo->middlename.' '.$userInfo->lastname;?></h3>
          </div>
          <div class="clear"></div>
          <ul class="sideul">
            <li class="sidepro <?php if(!empty($page_type) && $page_type == "profile" && $sub_type == "") {echo "active";} else if(empty($page_type)){ echo "active";}else if(!empty($page_type) && $page_type != "profile") {echo "active";}?>">
              <a href="#viewpro" class="dshbrdLnk" data-link="<?php echo base_url().'dashboard/profile' ?>" data-toggle="tab"><?=lang('View Profile');?></a>
            </li>
            <li class="sidepro <?php if(!empty($page_type) && $page_type == "profile" && $sub_type == "update") {echo "active";} ?>"><a href="#editpro" class="dshbrdLnk" data-link="<?php echo base_url().'dashboard/profile/update'; ?>" data-toggle="tab"><?=lang('Edit Profile');?></a></li>
               <li class="sidepro <?php if(!empty($page_type) && $page_type == "profile" && $sub_type == "verifications") {echo "active";} ?>"><a href="#trustnveri" class="dshbrdLnk" data-link="<?php echo base_url().'dashboard/profile/verifications'; ?>" data-toggle="tab"><?=lang('Trust and Verification');?></a></li>
                <?php /*?>
        <li class="sidepro <?php if(!empty($page_type) && $page_type == "profile" && $sub_type == "reviews") {echo "active";} ?>"><a href="#reviews" class="dshbrdLnk" data-link="<?php echo base_url().'dashboard/profile/reviews' ?>" data-toggle="tab">Reviews</a></li>
            <li class="sidepro <?php if(!empty($page_type) && $page_type == "profile" && $sub_type == "references") {echo "active";} ?>"><a href="#reference" class="dshbrdLnk" data-link="<?php echo base_url().'dashboard/profile/references' ?>" data-toggle="tab">References</a></li><?php */?>
          </ul>
        </div>
        <div class="col-md-9">
          <div class="tab-content5">
          
          <div class="tab-pane <?php if(!empty($page_type) && $page_type == "profile" && $sub_type == "") {echo "active";} else if(empty($page_type)){ echo "active";}else if(!empty($page_type) && $page_type != "profile") {echo "active";}?>" id="viewpro"> 
              <!-- Admin top -->
              <div class="col-md-6 offset-0">
                <div class="fstusrp" style="position: relative"> 
                  <div class="lodrefrentrev imgLoader">
                    <div class="centerload"></div>
                  </div>
                  <img src="<?php echo $profile_photo;?>" alt="" class="profile_photo"/> 
                </div>
                <p class="size12 grey margtop10"> <?=lang(welcome());?> <span class="lred"><?php echo $userInfo->firstname;?></span></p>
                 
                <a href="<?php echo WEB_URL;?>/users/show/<?php echo $user_type; ?>/<?php echo $user_id;?>" class="viewfulof"><?=lang('View My Profile');?></a>
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
             // $countries = array_unique($countries);
              $failed_count = count($failed);
			   $confirmed_count = count($confirmed);
			    $pending_count = count($pending);
				 $cancelled_count = count($cancelled);
              
             // $places = array_unique($places);
         
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


              <div class="col-md-6 offset-0">
                <div class="mytbl table-bordered">
                  <div class="grey opensans sanscol">
                    <div class="center colbt"><span class="size30 slim lh4"><?php if(isset($trips_count)){ echo $trips_count; } ?></span><br/>
                      <span class="size12"><?=lang('Trips');?></span></div>
                    <div class="center colbt"><span class="size30 slim lh4"><?php echo $confirmed_count;?></span><br/>
                      <span class="size12"><?=lang('Confirmed');?></span></div>
                    <div class="center colbt"><span class="size30 slim lh4"><?php echo $pending_count;?></span><br/>
                      <span class="size12"><?=lang('Pending');?></span></div>
                    <div class="center colbt"><span class="size30 slim lh4"><?php echo $cancelled_count;?></span><br/>
                      <span class="size12"><?=lang('Cancelled');?></span></div>
                       <div class="center colbt"><span class="size30 slim lh4"><?php echo $failed_count;?></span><br/>
                      <span class="size12"><?=lang('Failed');?></span></div>
                  </div>
                </div>
              </div>
              <!-- End of Admin top -->
              
              <div class="clear"></div>
              <div class="row margtop15">
              <div class="col-md-4 offset-0"> 
                	<div class="inrowit">
                    <span class="size16 bold dark"><?=lang('Account Summary');?>
                   </span>
                   <div class="line2"></div>
<?php
 if ($this->session->userdata('b2b_id')!='') {
 $b2b_type = $this->session->userdata('user_type');
            $b2b_id = $this->session->userdata('b2b_id');
            
          
            $deposit_amount = $this->account_model->get_deposit_amount($b2b_id)->row();


?>

                   Balance : <?php echo $deposit_amount->balance_credit; ?> $<br />
                   Last Deposit : <?php echo $deposit_amount->last_credit; ?> $
                   <?php
 }
 ?>
                  </div>
                </div>
                <div class="col-md-4 grey offset-0"> 
                    <div class="inrowit">
                      <span class="size16 bold dark"><?=lang('Personal details')?></span>
                      <div class="line2"></div>

                      <?php if($userInfo->address != "") { ?>
                        <a href="#" class="clblue"><?php echo $userInfo->address; ?></a><br/>
                      <?php } ?> 
                        
                      <?php if($contact_no != "") { ?>                      
                        <a href="#" class="clblue"><?php echo $contact_no; ?></a><br/>
                      <?php } ?>

                      <?php if($userInfo->address == "" && $contact_no == "") { ?>
                        <a class="clblue" ><?=lang('Edit Profile');?></a>
                      <?php } ?>

                      <a href="<?php echo WEB_URL.'/dashboard/profile/update'; ?>" class="proa"><?=lang('Update Profile');?></a> 
                  </div>
              </div>
                


                <div class="col-md-4 offset-0"> 
                	<div class="inrowit">
                    <span class="size16 bold dark"><?=lang('Your upcoming bookings');?></span>
                  	<div class="line2"></div>
                    <?php // print_r($ApartmentBookings); ?>
                    <?php  
                    $count = 0;
                    if(!empty($ApartmentBookings)) {
                      foreach($ApartmentBookings as $ApartmentBookings_key) {
                        if($count < 2) {
                          echo '<a href="'.WEB_URL.'/dashboard/bookings" class="clblue">'.$ApartmentBookings_key->module.' - '.$ApartmentBookings_key->pnr_no.'</a> '.lang('from').' <span class="bold green">'.CURR_ICON.$ApartmentBookings_key->amount.'</span><br/>';
                          $count++;
                        } else {
                          break;
                        }
                      }
                    } else {
                      echo "You have no bookings yet.";
                    }
                    ?>
                  	<a href="<?php echo WEB_URL.'/dashboard/bookings'; ?>" class="proa"><?=lang('See all');?></a> 
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
