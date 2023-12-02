<?php $this->load->view('common/header'); ?>
<?php  
/*
* Vikas Arora
* Shows the wishes inside the particular list with publicly shown items only.
*/
?>
<div class="full onlycontent">
    <div class="container martopbtm">
<br><br><br><br><br><br>

<div class="col-md-8">
    <?php  
    if(isset($userInfo->profile_photo) && $userInfo->profile_photo != "" ) {
        $profile_photo = $userInfo->profile_photo;
    } else if(isset($userInfo->agent_logo) && $userInfo->agent_logo != "") {
        $profile_photo = $userInfo->agent_logo;
    } else {
        $profile_photo = ASSETS.'images/user-avatar.jpg';
    }
    ?>
    <div class="wishimg"><img src="<?php echo $profile_photo; ?>" alt="" /></div>
    
    <div class="wishdet"><?php echo $userInfo->firstname."'s"; ?> Wish List</div>
    <div class="wishall">
        Wishlist:
        <strong>
          <span class="wishlistCounter"><span><?php echo $getWishes_num_rows; ?></span> Items</span>
        </strong>
    </div>
</div>

<br><br><br>

<div class="colfuls">
	
    <?php foreach($getWishes as $wish_key) { ?>
    <div class="wishSlab">   
        <div class="col-md-3">
        	<div class="userprowrp forprof">
              <div class="profileusrs wishpro">
                <div id="owl-demouserwish" class="owl-carousel owlindex owluser owl-demouserwish">    
                    <input type="hidden" class="wish_pid" value="<?php echo $wish_key->product_id ?>">
                    <input type="hidden" class="wish_tid" value="<?php echo $wish_key->wishlist_type_id ?>">
                    <?php 
                    foreach($wishImgPack as $imgObjArray) {
                        foreach($imgObjArray as $imgKey) {
                            if($wish_key->PROPERTY_ID == $imgKey->PROP_ID) {
                                if($imgKey->PHOTO_CONTENT != "") {
                                    $slideImage = $this->apartment_model->view_property_file($imgKey->PHOTO_CONTENT);   
                    ?>
                                <div class="item">
                                    <img src="<?php echo $slideImage; ?>" class="profile_photo"/>
                                </div>
                    <?php
                                } else {
                    ?>
                                <div class="item">
                                    <img src="<?php echo ASSETS;?>images/items/item1.jpg" class="profile_photo"/>
                                </div>
                    <?php
                                }
                            }
                        }
                    } 
                    ?>
                </div>
              </div>
          </div>
        </div>
        
        <div class="col-md-6">
        	<a href="<?php echo WEB_URL.'/apartment/rooms/'.$wish_key->product_id; ?>">
                <div class="hedwishrum"><?php echo $wish_key->product_name; ?></div>
            </a>
            <span class="wishadrs"><?php echo $wish_key->PROP_CITY.', '.$wish_key->PROP_REGION.', '.$wish_key->PROP_COUNTRY; ?></span>
           <!-- <ul class="typewish">
            	<li class="wsihli">Private room</li>
                <li class="wsihli">Real bed</li>
                <li class="wsihli">Sleeps 2</li>
            </ul>-->
            <div class="clear"></div>
            <div class="smaltipimg"><img src="<?php echo $profile_photo; ?>" alt="" /></div>
            <div class="reviewtype">
            	<textarea style="resize: none;" class="reviewtext" disabled="disabled"><?php echo $wish_key->add_note; ?></textarea>
            </div>
        </div>
        <div class="col-md-3 btnhover" style="margin-bottom: 100px">
        	<div class="wishprice">$<?php echo ($wish_key->PROP_RATE_NIGHTLY_FROM != "" ? $wish_key->PROP_RATE_NIGHTLY_FROM : "-" ); ?></div>
            <span class="smalwish">per night</span>
            <div class="clear"></div>
            
        </div>
    </div>
    <div class="clear"></div>
    <div class="stepline"></div>
    <div class="clear"></div>
    <?php } ?>


</div>     

</div>  
</div>  

<script type="text/javascript">
    $(document).ready(function(){
        
        $(".owl-demouserwish").owlCarousel({
            items : 1,
            lazyLoad : true,
            pagination : false,
            navigation : true
         });
    });
</script>  



<?php $this->load->view('common/footer'); ?>

