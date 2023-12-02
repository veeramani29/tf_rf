 <div class="tab-pane padding20me <?php if(empty($page_type)) {echo "active";} ?>" id="dashbord">
     	 <div class="col-md-3">
          <div class="userprowrp">
              <div class="profileusrs">
                <a href="<?php echo WEB_URL.'/dashboard/profile'; ?>">
                  <img src="<?php echo $profile_photo;?>" alt="" class="profile_photo"/>
                </a>
              </div>

              <h3 class="proname"><?php echo $userInfo->firstname.' '.$userInfo->middlename.' '.$userInfo->lastname;?></h3>
          </div>
          <div class="clear"></div>
          
        <div class="sidewiserow">
          	<h3 class="sidewisehed"><?=lang('NWER_POINTS_EARNED');?></h3>          
            <h3 class="h5 text-success" style="width:100%;text-align:center;font-size:17px;"><?=lang('POINTS_EARNED');?> <span class='text-info'><?=$loyalty_points_balance;?></span></h3>
            <?php 
              /*
              $count = $this->verification_model->checkB2CVerfication($user_id, $user_type)->num_rows();
              if($count == 1){
                $verifications = $this->verification_model->checkB2CVerfication($user_id, $user_type)->row();
                if($verifications->email == 1){
                  echo '<p class="sideop"><span class="icontik icon icon-check"></span><span class="strogtiv">'.lang('LOGIN_EMAIL').'</span><span class="littiv">Verified</span> </p>';
                }
               // if($verifications->mobile == 1){
                  //echo '<p class="sideop"><span class="icontik icon icon-check"></span><span class="strogtiv">Mobile Number</span><span class="littiv">Verified</span> </p>';
               // }
              }else { ?>
                <p class="sideop"><?=lang('No Verification Yet');?></p>
              <?php } */
              ?>
            
          </div>
          <div class="clear"></div>
          
         <!-- <div class="sidewiserow">
          	<h3 class="sidewisehed">Quick Links</h3>
            <ul class="qlinkul">
                <li class="qlink"><a href="<?php echo WEB_URL;?>/dashboard/profile/references">Request References</a></li>
                <li class="qlink"><a href="<?php echo WEB_URL;?>/dashboard/listing"> Your Space</a></li>
               
			      </ul>
          </div>-->
      </div>
         
         <div class="col-md-9">
         	<div class="dashrow marbtm20">
            	<h3 class="dashed"><?=lang('Welcome To');?> <?lang('SITE_NAME');?></h3>
                <div class="indashrow">
                	  <span class="onlysent">
                    	<?=lang('SITE_NAME');?> <?=lang('Welcome_Msg');?>.
                    </span>
                    <div class="fullofdash">
                    	<ul>
                        	<!--<li class="dshcol">
                             <a href="<?php echo WEB_URL;?>/dashboard/listing">
                            	<div class="indash">
                                	<div class="dashico"><img src="<?php echo ASSETS;?>images/dash1.png" alt="" /></div>
                                    <h3 class="dashinhed">	Edit your properties</h3>
                                    <p>Update availability and pricing for all of your properties.</p>
                                </div>
                               </a>
                            </li>-->
                            
                            <li class="dshcol">
                             <a href="<?php echo WEB_URL;?>/help">
                            	<div class="indash">
                                	<div class="dashico"><img src="<?php echo ASSETS;?>images/dash3.png" alt="" /></div>
                                    <h3 class="dashinhed"><?=lang('D_M1');?></h3>
                                    <p><?=lang('D_M1_TEXT');?>.</p>
                                </div>
                               </a>
                            </li>
                           
                            <li class="dshcol"> 
                            <a href="<?php echo WEB_URL;?>/help">
                            	<div class="indash">
                                	<div class="dashico"><img src="<?php echo ASSETS;?>images/dash4.png" alt="" /></div>
                                    <h3 class="dashinhed"><?=lang('D_M2');?></h3>
                                    <p><?=lang('D_M2_TEXT');?>.</p>
                                </div>
                             </a>
                            </li>
                           
                             <li class="dshcol">
                             <a href="<?php echo WEB_URL;?>/dashboard/support_conversation">
                            	<div class="indash">
                                	<div class="dashico"><img src="<?php echo ASSETS;?>images/dash2.png" alt="" /></div>
                                    <h3 class="dashinhed"><?=lang('D_M3');?></h3>
                                    <p><?=lang('D_M3_TEXT');?>.</p>
                                </div>
                                 </a>
                            </li>
                            
                             <li class="dshcol">
                             <a href="<?php echo WEB_URL;?>/dashboard/bookings">
                            	<div class="indash">
                                	<div class="dashico "><img src="<?php echo ASSETS;?>images/booking.jpg" alt="" /></div>
                                    <h3 class="dashinhed"><?=lang('D_M4')?></h3>
                                    <p><?=lang('TOTAL');?> <?php echo $ApartmentBookingsCount; ?></p>
                                </div>
                                 </a>
                            </li>
                            
                          
                
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="clear"></div>
           
            
         </div>
     </div>
