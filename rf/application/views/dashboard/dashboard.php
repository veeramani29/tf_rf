<div class="tab-pane rfboxed-background <?php if(empty($page_type)) {echo "active";} ?>" id="dashbord">
  <div class="col-md-3">
    <div class="userprowrp">
      <div class="profileusrs">
        <a href="<?php echo WEB_URL.'/dashboard/profile'; ?>">
          <img src="<?php echo $profile_photo;?>" alt="" class="profile_photo"/>
        </a>
      </div>
      <h3 class="proname"><?php echo $userInfo->firstname.' '.$userInfo->lastname;?></h3>
    </div>
  </div>         
  <div class="col-md-9 padd_l">
    <div class="marbtm20">
      <h3 class="dashed"><?php echo lang_line('WELCM')." ".lang_line('SITE_NAME');?></h3>
      <div class="indashrow">
        <span class="onlysent">
          <?php echo lang_line('DASH_DESC');?>
        </span>
        <div class="fullofdash">
          <ul class="list-inline">
           <!--  <li class="dshcol">
              <a href="<?php echo WEB_URL;?>/dashboard/profile">
                <div class="indash">
                  <div class="dashico"><img src="<?php echo ASSETS;?>images/profile-icon.svg" alt="" /></div>
                 <h3 class="dashinhed"><?php echo lang_line('UR_PRFL');?></h3>
                
                  <p><?php echo lang_line('HOW_IT_DESC');?></p>
                </div>
              </a>
            </li> -->
            <li class="dshcol">
              <a href="<?php echo WEB_URL;?>/dashboard/bookings">
                <div class="indash">
                  <div class="dashico "><img src="<?php echo ASSETS;?>images/Booking.svg" alt="" class="faqs" /></div>
                  <h3 class="dashinhed"><?php echo lang_line('BOOKINGS');?></h3>
                
                  <p><?php echo lang_line('TOTAL');?> <?php echo $ApartmentBookingsCount; ?></p>
                </div>
              </a>
            </li>
            <li class="dshcol"> 
              <a href="<?php echo WEB_URL;?>/help">
                <div class="indash">
                  <div class="dashico"><img src="<?php echo ASSETS;?>images/faq.svg" alt="" class="bookings" /></div>
                  <h3 class="dashinhed"><?php echo lang_line('HELP');?>,<?php echo lang_line('FAQ');?></h3> 
                                
                  <p><?php echo lang_line('HELP_DESC');?></p>
                </div>
              </a>
            </li>
            <li class="dshcol">
              <a href="<?php echo WEB_URL;?>/dashboard/support_conversation">
                <div class="indash">
                  <div class="dashico"><img src="<?php echo ASSETS;?>images/setting.svg" alt="" class="settings"/></div>
                  <h3 class="dashinhed"> <?php echo lang_line('SETTINGS');?></h3> 
                           
                  <p><?php echo lang_line('SUPPORT_DESC');?></p>
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
