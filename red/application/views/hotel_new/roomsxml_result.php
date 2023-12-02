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


     <div class="offset-2 hotel-item HotelInfoBox searchflight" data-price="<?php echo number_format($totalPrice,2,'.',''); ?>" data-hotel-name="<?php echo $list['name']; ?>" data-star="<?php echo $star; ?>" data-facility="<?php echo($amenity != ''?$amenity:'-'); ?>" data-location="<?php echo($address != ''?$address:'-'); ?>" data-type="<?php echo($type != ''?$type:'-'); ?>" data-api="<?php echo 3; ?>" style="margin-top: 22px;">
                        <div class="col-md-4 offset-0">
                            <div class="listitem2">
                               

 <?php if(isset($photo) && $photo!=''){ ?>
     <a href="http://www.roomsxml.com<?php echo $photo; ?>" data-footer="<?php echo $list['name']; ?>" data-title="<?php echo $list['name']; ?>" data-gallery="multiimages" data-toggle="lightbox">
                    <img src="http://www.roomsxml.com<?php echo $photo; ?>" alt="<?php echo $list['name']; ?>">
                     </a>
                <?php } else { ?>
                     <a href="<?php echo $photo; ?>" data-footer="<?php echo $list['name']; ?>" data-title="<?php echo $list['name']; ?>" data-gallery="multiimages" data-toggle="lightbox">
                    <img src="<?php echo base_url(); ?>assets/images/no_image.png" alt="<?php echo $list['name']; ?>">
                     </a>
                <?php } ?>

                               
                                <div class="liover" style="width: 10%; height: 10%; background-color: rgb(255, 0, 0); position: absolute; top: 105px; left: 139.5px; opacity: 0;"></div>
                                <a class="fav-icon" href="#" style="top: 94px; left: 279px;"></a>
                                <a class="book-icon" href="<?php echo site_url(); ?>/hotel/details/3/<?php echo $i; ?>" style="top: 94px; left: -25px;"></a>
                            </div>
                        </div>
                        <diiv class="col-md-8 offset-0">
                            <div class="itemlabel3">
                                <div class="labelright">

                                    <span class="ratings size-xs">
                                     <?php for($st=0;$st<5;$st++){ if($star <= $st){ ?>
                                          <i class="fa fa-star"></i>
                                       
                                   <?php }else{ ?>
                                     <i class="fa fa-star active"></i>
                           
                                  <?php }  }  ?>
                                        
                                    </span>
                                    <br>
                                    <br>
                                    <br>
                                    <img src="<?php echo base_url(); ?>assets_/images/user-rating-5.png" width="60" alt="">
                                    <br>
                                    <span class="size11 grey">18 Reviews</span>
                                    <br>
                                    <br>
                                    <span class="green size18"><span style="font-size:27px;">&#8369;</span><?php echo number_format($totalPrice,2,'.',','); ?></span>
                                    <br>
                                    <span class="size11 grey">avg/night</span>
                                    <br><span class="to_prin">(Total Price Including Tax)</span>
                                    <br>
                                    <br>
                               
                                        <a href="<?php echo site_url(); ?>/hotel/details/3/<?php echo $i; ?>" class="bookbtn mt1" type="submit">Book</a>
                                   
                                </div>
                                <div class="labelleft2">
                                    <b><?php echo $list['name']; ?></b>
                                    <br><?php echo $address; ?>
                                    <br>
                                    <br>
                                    <!--<p class="grey">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec semper lectus. Suspendisse placerat enim mauris, eget lobortis nisi egestas et. Donec elementum metus et mi aliquam eleifend. Suspendisse volutpat egestas rhoncus.</p> -->
                                    <br>
                                    <ul class="hotelpreferences">
                                        <li class="icohp-internet"></li>
                                        <li class="icohp-air"></li>
                                        <li class="icohp-pool"></li>
                                        <li class="icohp-childcare"></li>
                                        <li class="icohp-fitness"></li>
                                        <li class="icohp-breakfast"></li>
                                        <li class="icohp-parking"></li>
                                        <li class="icohp-pets"></li>
                                        <li class="icohp-spa"></li>
                                        <!-- <i class="soap-icon-wifi circle"></i>
                <i class="soap-icon-fitnessfacility circle"></i>
                <i class="soap-icon-fork circle"></i>
                <i class="soap-icon-television circle"></i> -->
                                    </ul>

                                </div>
                            </div>
                        </div>
                         <div class="clearfix"></div>
              <div class="offset-2">
                        <hr class="featurette-divider3">
                    </div>
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