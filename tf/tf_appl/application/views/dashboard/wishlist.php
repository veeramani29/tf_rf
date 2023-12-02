<!-- TAB 3 -->
      <div class="tab-pane <?php if(!empty($page_type) && $page_type == "wishlist") {echo "active";} ?>" id="wishlist">
      <div class="padding20 full">
      	<div class="col-md-8">
          <?php if($profile_photo == "") { ?>
            <div class="wishimg"><img src="<?php echo ASSETS.'images/user-avatar.jpg'; ?>" alt="" /></div>
          <?php } else { ?>
            <div class="wishimg"><img src="<?php echo $profile_photo; ?>" alt="" /></div>
            <?php } ?>
            <div class="wishdet"><?php echo $userInfo->firstname."'s"; ?> Wish List</div>
            <div class="wishall">
                Wishlist:
                <strong>
                  <span class="wishlistCounter"><?php echo $getWishlistCount; ?></span>
                </strong>
            </div>
        </div>
        
        <div class="col-md-4">
        	<button type="submit" class="enbleinkadd adwishlist_open"><span class="glyphicon glyphicon-plus"></span>Add new</button>
          <?php //The lightbox that opens after clicking add new is present in the footer.php file.. ?>
        </div>

        <div class="clear"></div>
       
        
        <div class="colfuls" id="wishlistContainer">

        <?php if(!empty($getAllWishlist)) { ?>
          <?php foreach($getAllWishlist as $wishlist_key) { ?>
              <div class="col-xs-4 listwish">
                  <div class="listwishin">
                  
                    <div class="fadelst"></div>
                    <div class="absimagesentback">
                      <?php if($wishlist_key->PHOTO_CONTENT != "") { ?>
                        <?php $img = $this->apartment_model->view_property_file($wishlist_key->PHOTO_CONTENT); ?>
                        <img style="height: 100%" src="<?php echo $img; ?>">
                      <?php }else {  ?>  <img style="height: 100%" src="<?php echo ASSETS.'images/d2.jpg'; ?>">
                      <?php
					  }
					  ?>
                    </div>
                      <div class="relanothr">
                          
                          <?php if($wishlist_key->privacy  == 0){ ?>
                            <span class="icon icon-lock"></span>
                          <?php } ?>

                          <span class="wishname"><?php echo $wishlist_key->wishlist_type_name; ?></span>
                            <a class="howlistg" href="<?php echo WEB_URL.'/wishlist/openWishlist/'.$wishlist_key->wishlist_type_id; ?>">
                              <?php echo ($wishlist_key->counter == "" ? '0' : $wishlist_key->counter) ?> 
                                Listing
                            </a>
                            <div style="margin-top: 20px; text-align: center">
                            <?php if($wishlist_key->user_delete_access == 0){ ?>                              
                              <a style="color: #fff;" 
                                  data-wishlistid = "<?php echo $wishlist_key->wishlist_type_id; ?>"
                                  data-wishlistName="<?php echo $wishlist_key->wishlist_type_name; ?>" 
                                  data-privacy="<?php echo $wishlist_key->privacy; ?>"
                                  class="editWishlist" href="#" >
                                    Edit
                              </a>
                            <?php } ?>

                              <?php if($wishlist_key->user_delete_access == 0){ ?>
                                <a style="color: #fff; padding-left: 20px" 
                                    data-wishlistid = "<?php echo $wishlist_key->wishlist_type_id; ?>"
                                    class="deleteWishlist" href="#" >
                                      Delete
                                </a>
                              <?php } ?>

                            </div>
                      </div>
                  </div>
              </div>
            
          <?php  } ?>
        <?php } ?>
        </div>

        <div id="wishlistCreateLoader" style="background: #fff; text-align: center; width: 150px; padding: 10px; display: none;">
          <img style="display: block; margin: 0 auto" src=" <?php echo ASSETS.'/images/loader.gif' ?> ">
          <h5 style="display: block; text-align: center">Creating Wishlist</h5>
        </div>
        
        
        <div class="clear"></div>
        
        <br /><br /><br />
 
      </div>
      </div>
<script type="text/javascript" src="<?php echo ASSETS.'/js/wishlist/wishlist.js' ?>" ></script>  
      
<?php  
//open add sub popup if the get url exist.
$src = $this->input->get('src');
if(isset($src) && $src != "" && $src=="profile") {
?>
  <script type="text/javascript"> 
    $(document).ready(function() {
      openAddNodeBX(1);   
    })
  </script>
<?php } ?>  


<!-- END OF TAB 3 --> 