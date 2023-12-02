<?php $this->load->view('common/header'); ?>
<?php  
/*
* Vikas Arora
* Shows the wishes inside the particular list
*/
?>
<div class="full onlycontent">
    <div class="container martopbtm">
<br><br><br><br><br><br>

<div class="col-md-8">
<?php  
if(isset($userInfo->profile_photo)) {
    $profile_photo = $userInfo->profile_photo;
} else if(isset($userInfo->agent_logo)) {
    $profile_photo = $userInfo->agent_logo;
}
?>


    <?php if($profile_photo == "") { ?>
        <div class="wishimg"><img src="<?php echo ASSETS.'images/user-avatar.jpg'; ?>" alt="" /></div>
    <?php } else { ?>
        <div class="wishimg"><img src="<?php echo $profile_photo; ?>" alt="" /></div>
    <?php } ?>
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
           
            <div class="clear"></div>
            <?php if($profile_photo == "") { ?>
                <div class="smaltipimg">
                    <img src="<?php echo ASSETS.'images/user-avatar.jpg'; ?>" alt="" />
                </div>
            <?php } else { ?>
                <div class="smaltipimg">
                    <img src="<?php echo $profile_photo; ?>" alt="" />
                </div>
            <?php } ?>
            
            <div class="reviewtype">
            	<textarea class="reviewtext" style="resize: none" disabled="disabled"><?php echo $wish_key->add_note; ?></textarea>
            </div>
        </div>
        <div class="col-md-3 btnhover" style="margin-bottom: 100px">
        	<div class="wishprice">$<?php echo ($wish_key->PROP_RATE_NIGHTLY_FROM != "" ? $wish_key->PROP_RATE_NIGHTLY_FROM : "-" ); ?></div>
            <span class="smalwish">per night</span>
            <div class="clear"></div>
            
            <div class="navbuttons">
                <a class="navchange removeWish"><span class="icon icon-remove"></span>Remove</a>
            </div>
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

<script type="text/javascript">
    $('.removeWish').on('click', function() {
        var currentSlab = $(this).closest('.wishSlab');
        currentSlab.fadeOut();
        var currentSlab_tid = currentSlab.find('.wish_tid').val();
        var currentSlab_pid = currentSlab.find('.wish_pid').val();
        
        $.ajax({
            url: "<?php echo WEB_URL.'/wishlist/removeWish' ?>",
            data: {'tid': currentSlab_tid, 'pid': currentSlab_pid},
            method: "POST",
            dataType: "json",
            success: function(r) {
                if(r.status == 1) {
                    console.log(r.updatedCount);
                    $('.wishlistCounter > span').text(r.updatedCount);
                }
            }
        })

    });
</script>


<?php $this->load->view('common/footer'); ?>

