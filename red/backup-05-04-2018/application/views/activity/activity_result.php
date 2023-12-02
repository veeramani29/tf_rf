<div class="col-sm-8 col-md-9">
    <div class="sort-by-section clearfix">
        <h4 class="sort-by-title block-sm so_rt">Sort results by:</h4>
        <ul class="sort-bar clearfix block-sm" style="padding-left:14px;">
            <li class="sort-by-name"><a class="sort-by-container" href="#"><span>name</span></a></li>
            <li class="sort-by-price"><a class="sort-by-container" href="#"><span>price</span></a></li>
            <li class="clearer visible-sms"></li>
            <li class="sort-by-rating active"><a class="sort-by-container" href="#"><span>rating</span></a></li>
            <li class="sort-by-popularity"><a class="sort-by-container" href="#"><span>popularity</span></a></li>
        </ul>
    </div>
    <?php if (isset($activities) && $activities != '') { ?>
    <div class="resultHotels">
    <?php
        $i = 0;
        $activityPriceAry = '';
        foreach ($activities as $list) {
            
            $activityPriceAry[] = $list->PriceAdult;
    ?>
        <div class="hotel-item searchhotel_box ActivityInfoBox searchflight" data-price="<?php echo $list->PriceAdult; ?>" data-hotel-name="<?php echo $list->ActivityName; ?>" style="margin-top: 22px;">
        <div class="item-media">
            <div class="image-cover">
                <?php if(isset($list->ImagePath) && $list->ImagePath!=''){ ?>
                    <img src="<?php echo $list->ImagePath; ?>" alt="<?php echo $list->ActivityName; ?>">
                <?php } else { ?>
                    <img src="<?php echo base_url(); ?>assets/images/no_image.png" alt="<?php echo $list->ActivityName; ?>">
                <?php } ?>
            </div>
        </div>
        <div class="item-body">
            <div class="item-title">
                <p style="margin-bottom:0px;"><a href="<?php echo site_url(); ?>/activity/details/<?php echo $list->id; ?>" style="font-size: 18px;color: #616161;"><?php echo $list->ActivityName; ?></a></p>
            </div>
            <hr style="margin: 0px;"/>
            <div class="con-location-city-name" style="margin-top: 10px;">
                <?php 
                    $advanceBooking = $list->AdvancePurchasePeriod.' days';
                ?>
                <p><span style="font-weight: bold;">Advance Booking Period : </span><span> <?php echo $advanceBooking; ?></span></p>
                
            </div>
            <hr style="margin: 0px;"/>
            <div class="con-location-city-name" >
                <?php 
                    $fromDateArr = explode('T',$list->TravelValidFrom);
                    $toDateArr = explode('T',$list->TravelValidTo);
                ?>
                <p><span style="font-weight: bold;">Travel Period : </span><span><?php echo $fromDateArr[0];  ?> to <?php echo $toDateArr[0];  ?></span></p>
            </div>
            
            <div class="con-location-city-name" >
                <p><span style="font-weight: bold;">Min Pax : </span><span><?php echo $list->MinPax;  ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="font-weight: bold;">Max Pax : </span><span><?php echo $list->MaxPax;  ?></span></p>
            </div>
            <?php if($list->OnlyForAdult == 'true'){ ?>
            <div class="con-location-city-name" >
                <p><span style="font-weight: bold;">Only For Adults</span></p>
            </div>
            <?php } ?>
            <div class="con-location-city-name" style="margin-top: 20px;">
                <p style="text-align: right;font-size: 13px;"><a href="javascript:void(0);" onclick="showActivityInclusionCancel('<?php echo $list->id; ?>');" style="color:red">View Inclusions and Cancellation</a></p>
            </div>
            
        </div>
        <div class="item-price-more text-center">
            <p class="st_fr">starting from</p>
            <div class="">
                <p class="amount amount-sec text_fon p_sy"><span style="font-size:27px;">&#8369;</span><?php echo number_format($list->PriceAdult,2,'.',','); ?></p>
                <p class="to_prin" style="text-align: center;">(Per Pax)</p>
            </div><a href="<?php echo site_url(); ?>/activity/details/<?php echo $list->id; ?>" class="awe-btn">View details</a></div>
    </div>
    <?php
            $i++;
        }
    ?>    
    </div>
    <input type="hidden" id="setMinPrice" value="<?php if(!empty($activityPriceAry)) echo min($activityPriceAry); else echo 0; ?>" />
    <input type="hidden" id="setMaxPrice" value="<?php if(!empty($activityPriceAry)) echo max($activityPriceAry); else echo 0; ?>" />
    <input type="hidden" id="setCurrency" value="<?php echo 'PHP';?>" />
    <?php
    } else {
?>
    <div class="alert alert-danger alert-dismissable fade in" id='error_hoSearch' style='display:none;position:fixed;top:0;width:100%;z-index:100;font-size: 17px;text-align: center;'>
        <a href="javascript:;" class="close" onclick="$('#error_hoSearch').hide();" aria-label="close">&times;</a>
        <span>Oop's No attractions found for your search or some technical problem occurred. Kindly search again. </span>
    </div>
<?php
    }
?>
    
</div>