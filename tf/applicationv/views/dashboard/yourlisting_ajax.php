	   <?php if(!empty($get_user_listings)) { foreach($get_user_listings as $key => $value) { 
	          $completed_status = $this->Listings_Model->get_property_listings_completed_modules($value->PROPERTY_ID);	
	          $completed_status_count = 4;
	          if(!empty($completed_status))
	          {
	          foreach($completed_status as $skey => $svalue){
				  if($svalue->completed_status == 1){
					 $completed_status_count--; 
				  }
			  }
			}
	   ?>
			<li class="mesginbox celbig">
			<div class="col-md-2 celtbl">
				<div class="inboximg">
					<?php if($value->PROPERTY_STATUS == 1) { ?>
						<a href="<?php echo WEB_URL; ?>/apartment/rooms/<?php echo $value->PROPERTY_ID; ?>">
					<?php } ?>
						<?php $image = $this->Listings_Model->get_property_photos($value->PROPERTY_ID,1);
							if(!empty($image)){?>
								<img width="96" height="61" style="clear: both;float: left;" src="data:image/png;base64,<?php echo $image[0]->PHOTO_CONTENT; ?>">  
							<?php }else{?>
							<img src="<?php echo ASSETS; ?>images/smallthumb-1.jpg" alt=""  />  	
						<?php } ?>											
					<?php if($value->PROPERTY_STATUS == 1) { ?>
						</a>
					<?php } ?>	
				</div>
			</div>
			<div class="col-md-6 celtbl">
				<div class="inboxlabl">
					<a class="listaptname" href="<?php echo WEB_URL; ?>/listings/edit_listings/<?php echo $value->PROPERTY_ID; ?>"><?php echo $value->PROP_TYPE_LABEL; ?> in <?php echo $value->PROP_CITY; ?></a>
				</div>
			</div>
			<?php if($completed_status_count != 0) { ?>
			<div class="col-md-4 celtbl vertymid">
				<a class="tomorelist" href="<?php echo WEB_URL; ?>/listings/edit_listings/<?php echo $value->PROPERTY_ID; ?>"><?php echo $completed_status_count; ?> Steps to list</a>
			</div>
			<?php } elseif($value->PROP_COUNTRY == 'AE' && $value->ADMIN_APPROVAL_STATUS == 0) { ?>
					<div class="col-md-4 celtbl vertymid">
						<p style="color:red;">Require approval from admin</p>
					</div>	
			<?php } elseif($completed_status_count == 0) { ?>
				  <select style="float:right;width:40%;" name="edit_listings_status" id="edit_listings_status" class="form-control" required onchange="change_listings_status('<?php echo $value->PROPERTY_ID; ?>',this.value);">
						<option value="1" <?php if($value->PROPERTY_STATUS == 1) {echo "selected=selected"; } ?> >List</option>
						<option value="0" <?php if($value->PROPERTY_STATUS == 0) {echo "selected=selected"; } ?> >Unlist</option>
				  </select>
			<?php } ?>
			</li>
        <?php } } else { ?>
            <div class="col-md-12" style="margin: 0 auto; text-align: center;">
                <div class="srywrap"><span class="sorrydiv"><img src="<?php echo WEB_URL; ?>/assets/images/sorry.png" alt="" /></span><b>Nothing here</b></div>
            </div>
        <?php } ?>
