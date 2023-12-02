    <?php if (isset($result) && $result != '') { ?>
    <?php
        $i = 0;
        //$hototalPriceAry = '';
        foreach ($result as $list) {
            $hotelId = $list['hotel_id'];
            $path = ROOMSXML_DATA_PATH . $hotelId . '.xml';
            $totalPrice = min($list['price']);
            $_SESSION[session_id()]['hofilters']['type'] = '';
            $_SESSION[session_id()]['hofilters']['amenity'] = '';
            $_SESSION[session_id()]['hofilters']['location'] = '';
            if (file_exists($path)) {
                $doc = new DOMDocument();
                $doc->load($path);
                $address = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Address')->item(0)->getElementsByTagName('Address1')->item(0)->nodeValue;
                $address .= $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Address')->item(0)->getElementsByTagName('Address2')->item(0)->nodeValue;
                $address .= $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Address')->item(0)->getElementsByTagName('Address3')->item(0)->nodeValue;
                if ($doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Photo')->length > 0) {
                    $photos = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Photo');
                    foreach ($photos as $p) {
                        if ($p->getElementsByTagName('PhotoType')->item(0)->nodeValue == 'ExternalViewOfTheHotel') {
                            $photo = $p->getElementsByTagName('Url')->item(0)->nodeValue;
                            break;
                        } else {
                            $photo = $p->getElementsByTagName('Url')->item(0)->nodeValue;
                            break;
                        }
                    }
                }
                $location = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Region')->item(0)->getElementsByTagName('Name')->item(0)->nodeValue;
                $_SESSION[session_id()]['hofilters']['location'][] = $location;
                $amenities = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Amenity');
                foreach ($amenities as $amenity) {
                    $_SESSION[session_id()]['hofilters']['amenity'][] = $amenity->getElementsByTagName('Text')->item(0)->nodeValue;
                }
                $type = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Type')->item(0)->nodeValue;
                $_SESSION[session_id()]['hofilters']['type'][] = $type;
                if ($doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Stars')->length > 0)
                    $star = $doc->getElementsByTagName('HotelElement')->item(0)->getElementsByTagName('Stars')->item(0)->nodeValue;
            }
            else {
                $address = '';
                $photo = '';
                $star = '0';
                $location = '';
                $type = '';
            }

            if ($_SESSION[session_id()]['hofilters']['amenity'] = '')
                $amenity = implode(';', array_unique($_SESSION[session_id()]['hofilters']['amenity']));
            else
                $amenity = '';
            
            if($cur_val != 0){ $totalPrice = $totalPrice*number_format((float)$cur_val, 2, '.', ''); }
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
            
            $_SESSION[session_id()]['hofilters']['hototalPriceAry'][] = number_format($totalPrice,2,'.','');
    ?>
    <div class="searchhotel_box">
        <div class="hotel-item HotelInfoBox searchflight" data-price="<?php echo number_format($totalPrice,2,'.',''); ?>" data-hotel-name="<?php echo $list['name']; ?>" data-star="<?php echo $star; ?>" data-facility="<?php echo($amenity!=''?$amenity:'-'); ?>" data-location="<?php echo($location!=''?$location:'-'); ?>" data-type="<?php echo($type!=''?$type:'-'); ?>" data-api="<?php echo 1; ?>" style="margin-top: 22px;">
        <div class="item-media">
            <div class="image-cover">
                <?php if(isset($photo) && $photo!=''){ ?>
                    <img src="http://www.roomsxml.com<?php echo $photo; ?>" alt="<?php echo $list['name']; ?>">
                <?php } else { ?>
                    <img src="<?php echo base_url(); ?>assets/images/no_image.png" alt="<?php echo $list['name']; ?>">
                <?php } ?>
            </div>
        </div>
        <div class="item-body">
            <div class="item-title">
                <h2><a href="<?php echo site_url(); ?>/hotel/details/1/<?php echo $i; ?>" ><?php echo $list['name']; ?></a></h2></div>
            <div class="con-location-city-name">
                <p style="font-size: 12px;"><?php echo $address; ?></p>
            </div>
            <div class="amenities"> 
                <?php if($star == 1){ ?>
                <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <i class="fa fa-star-o pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <?php } else if($star == 1.5){ ?>
                <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star-half-o pull-left" aria-hidden="true"></i>
                <i class="fa fa-star-o pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <?php } else if($star == 2){ ?>
                <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                <i class="fa fa-star-o pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <?php } else if($star == 2.5){ ?>
                <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                <i class="fa fa-star-half-o pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <?php } else if($star == 3){ ?>
                <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <?php } else if($star == 3.5){ ?>
                <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star-half-o pull-left" aria-hidden="true"></i>
                <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <?php } else if($star == 4){ ?>
                <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                <?php } else if($star == 4.5){ ?>
                <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                <i class="fa fa-star-half-o pull-left" aria-hidden="true"></i>
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
            <div class="amenities">
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
            </div><a href="<?php echo site_url(); ?>/hotel/details/1/<?php echo $i; ?>" class="awe-btn">Select Room</a></div>
    </div>
    </div>
    <?php 
        
            $i++;
        }
    ?>    
    
    <input type="hidden" id="setMinPrice" value="<?php if(!empty($_SESSION[session_id()]['hofilters']['hototalPriceAry'])) echo min($_SESSION[session_id()]['hofilters']['hototalPriceAry']); else echo 0; ?>" />
    <input type="hidden" id="setMaxPrice" value="<?php if(!empty($_SESSION[session_id()]['hofilters']['hototalPriceAry'])) echo max($_SESSION[session_id()]['hofilters']['hototalPriceAry']); else echo 0; ?>" />
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