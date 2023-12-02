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
    <?php if (isset($result) && $result != '') { ?>
    <div class="resultHotels">
    <?php
        $i = 0;
        $hototalPriceAry = '';
        foreach ($result as $list) {
//            if($i<10){
            $hotelId = $list['hotel_id'];
            $totalPrice = $list['tot_price'];
            $_SESSION[session_id()]['hofilters']['type'] = '';
            $_SESSION[session_id()]['hofilters']['amenity'] = '';
            $_SESSION[session_id()]['hofilters']['location'] = '';
            
            //$hotelDetails = $this->Hotel_Model->getRezliveHotelDetails($hotelId);
            $address = ($list['Address'] != ''?$list['Address'] : '');
            $photo = $list['FrontPgImage'];
            $star = $list['StarRating'];
            $location = $list['Location'];
            $type = $list['Category'];
            

            if ($_SESSION[session_id()]['hofilters']['amenity'] == '')
                $amenity = '';
            else
                $amenity = '';
            
            //if($cur_val != 0){ $totalPrice = $totalPrice*number_format((float)$cur_val, 2, '.', ''); }
            if($admin_markup['type'] == 'fixed'){
                $mTyp = $searchData['type'];
                $totalPrice = $totalPrice+$admin_markup[$mTyp];
            } else {
                $mTyp = $searchData['type'];
                $totalPrice = ((($admin_markup[$mTyp]/100)*$totalPrice)+$totalPrice);
            }
            
            if($agent_markup['type'] == 'fixed'){
                $amTyp = $searchData['type'];
                $totalPrice = $totalPrice+$agent_markup[$amTyp];
            } else {
                $amTyp = $searchData['type'];
                $totalPrice = ((($agent_markup[$amTyp]/100)*$totalPrice)+$totalPrice);
            }
            
            $hototalPriceAry[] = number_format($totalPrice,2,'.',',');
    ?>
        <div class="hotel-item searchhotel_box HotelInfoBox searchflight" data-price="<?php echo number_format($totalPrice,2,'.',','); ?>" data-hotel-name="<?php echo $list['name']; ?>" data-star="<?php echo $star; ?>" data-facility="<?php echo $amenity; ?>" data-location="<?php echo $location; ?>" data-type="<?php echo $type; ?>" data-api="<?php echo 3; ?>" style="margin-top: 22px;">
        <div class="item-media">
            <div class="image-cover">
                <?php if(isset($photo) && $photo!=''){ ?>
                    <img src="<?php echo $photo; ?>" alt="<?php echo $list['name']; ?>">
                <?php } else { ?>
                    <img src="<?php echo base_url(); ?>assets/images/no_image.png" alt="<?php echo $list['name']; ?>">
                <?php } ?>
            </div>
        </div>
        <div class="item-body">
            <div class="item-title">
                <p style="margin-bottom:0px;"><a href="<?php echo site_url(); ?>/hotel/details/2/<?php echo $i; ?>" style="font-size: 27px;color: #616161;"><?php echo $list['name']; ?></a></p></div>
            <div class="con-location-city-name">
                <p style="font-size: 12px;"><?php echo $address; ?></p>
            </div>
            <div class="amenities" style="padding-top:32px;"> 
                <?php if($star == 1){ ?>
                <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <i class="fa fa-star-o pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <?php } else if($star == 2){ ?>
                <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                <i class="fa fa-star-o pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <?php } else if($star == 3){ ?>
                <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <?php } else if($star == 4){ ?>
                <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <?php } else if($star == 5){ ?>
                <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                <i class="fa fa-star pull-left" aria-hidden="true"></i>
                <?php } else { ?>
                <i class="fa fa-star-o pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <i class="fa fa-star-o pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <?php } ?>
            </div>
            <div style="clear:both;"></div>
            <div class="amenities" style="padding-top:25px;">
                <i class="soap-icon-wifi circle"></i>
                <i class="soap-icon-fitnessfacility circle"></i>
                <i class="soap-icon-fork circle"></i>
                <i class="soap-icon-television circle"></i>
            </div>
        </div>
        <div class="item-price-more text-center">
            <p class="st_fr">starting from</p>
            <div class="">
                <p class="amount amount-sec text_fon p_sy"><span style="font-size:27px;">&#8369;</span><?php echo number_format($totalPrice,2,'.',','); ?></p>
                <p class="to_prin">(Total Price Including Tax)</p>
            </div><a href="<?php echo site_url(); ?>/hotel/details/2/<?php echo $i; ?>" class="awe-btn">Select Room</a></div>
    </div>
    <?php 
//        }
            $i++;
        }
    ?>    
    </div>
    <input type="hidden" id="setMinPrice" value="<?php if(!empty($hototalPriceAry)) echo min($hototalPriceAry); else echo 0; ?>" />
    <input type="hidden" id="setMaxPrice" value="<?php if(!empty($hototalPriceAry)) echo max($hototalPriceAry); else echo 0; ?>" />
    <input type="hidden" id="setCurrency" value="<?php echo 'PHP';?>" />
    <?php
    } else {
?>
    <div class="alert alert-danger alert-dismissable fade in" id='error_hoSearch' style='display:none;position:fixed;top:0;width:100%;z-index:100;font-size: 17px;text-align: center;'>
        <a href="javascript:;" class="close" onclick="$('#error_hoSearch').hide();" aria-label="close">&times;</a>
        <span>Oop's No hotels found for your search or some technical problem occurred. Kindly search again. </span>
    </div>
<?php
    }
?>
    
</div>
