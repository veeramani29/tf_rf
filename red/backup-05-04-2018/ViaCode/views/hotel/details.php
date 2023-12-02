<!DOCTYPE html>
<html>
    <head>
        <title><?php echo Site_Title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/styles.css" type="text/css" rel="stylesheet" media="all">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
        <link href="<?php echo base_url(); ?>assets/css/awe-booking-font.css" type="text/css" rel="stylesheet" media="all">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/hotel-style12.css">
        <link href="<?php echo base_url(); ?>assets/css/hotel_details.css" type="text/css" rel="stylesheet" media="all">
        <style>
            .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{ border-top:0px; border-left:0px; border-right: 0px; border-bottom: 2px solid #f74623; }
        </style>
    </head>
    <body>
        <!--########################### HEADER STARTS HERE ###############################################################--->
        <?php $this->load->view('header'); ?>
        <!--############################ HEADER ENDS HERE ##############################################################--->
        <section class="product-detail lgrayBg1">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-detail__info">
                            <div class="product-title">
                                <h2><?php echo $hotel_data['name']; ?></h2>
                                <div class="hotel-star">
                                    <?php if($star == 1){ ?>
                                    <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <?php } else if($star == 1.5){ ?>
                                    <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <?php } else if($star == 2){ ?>
                                    <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <?php } else if($star == 2.5){ ?>
                                    <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-half-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <?php } else if($star == 3){ ?>
                                    <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <?php } else if($star == 3.5){ ?>
                                    <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <?php } else if($star == 4){ ?>
                                    <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <?php } else if($star == 4.5){ ?>
                                    <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                    <?php } else if($star == 5){ ?>
                                    <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <?php } else { ?>
                                    <i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="product-address"><span><?php echo(isset($address) ? $address : '' ); ?> | <?php echo(isset($tel) ? $tel : '' ); ?></span></div>
                            <div class="product-email"><i class="fa fa-envelope"></i> <a href="#"><?php echo(isset($email) ? $email : '' ); ?></a></div>
                            <div class="rating-trip-reviews">
                                <div class="item good"><span class="count">7.5</span>
                                    <h6>Average rating</h6>
                                    <p>Good</p>
                                </div>
                                <div class="item">
                                    <h6>Trip Advisor &gt;</h6><img src="<?php echo base_url(); ?>assets/images/img/trips.png" alt=""></div>
                                <div class="item">
                                    <h6>Reviews</h6>
                                    <p>No review yet</p>
                                </div>
                            </div>
                            <div class="product-descriptions">
                                 <?php
                                if($api_id == 1){
                                    if(isset($desc) && $desc!=''){
                                        foreach($desc as $dec){ 
                                ?>
                                        <p>
                                            <b><?php echo $dec['type']; ?> : </b><?php echo $dec['text']; ?>
                                        </p> 
                                <?php
                                        }
                                    }
                                } else if($api_id == 3){
                                ?>
                                    <?php echo $desc; ?>
                                <?php
                                } else if($api_id == 2){
                                     echo $desc;
                                } else {
                                    echo 'NO Description available for this hotel.';
                                }
                                ?>
                            </div>
                            <div class="property-highlights">
                                <h3>Property highlights</h3>
                                <div class="property-highlights__content">
                                    <?php 
                                        if($amenity != '' && is_array($amenity)){
                                            foreach($amenity as $amty){
                                    ?>
                                            <div class="item"><i class="awe-icon awe-icon-unlock"></i> <span><?php echo $amty; ?></span></div>
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="myCarousel" class="carousel slide" id="carousel-example-generic" data-ride="carousel">

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <?php 
                                    if(is_array($photo_url)){
                                        $i=0;
                                        if($api_id == 1 || $api_id == 3){
                                            foreach($photo_url as $photo){
                                ?>
                                <div class="item <?php if($i == 0){ echo 'active'; } ?>">
                                    <img src="http://www.roomsxml.com<?php echo $photo; ?>" alt="" style="width:700px;height:500px;">
                                </div>
                                <?php 
                                                $i++;
                                            }
                                        } else {
                                            foreach($photo_url as $photo){
                                ?>
                                            <div class="item <?php if($i == 0){ echo 'active'; } ?>">
                                                <img src="<?php echo $photo; ?>" alt="" style="width:700px;height:500px;">
                                            </div>
                                <?php
                                                $i++;
                                            }
                                        }
                                    } else {
                                ?>
                                <div class="item active">
                                    <img src="<?php echo base_url(); ?>assets/images/no_image.png" alt="">
                                </div>
                                <?php
                                    } 
                                ?>
                            </div>
                           <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a>
                        </div><!-- End Carousel -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mar_top15">

                        <div>

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Room detail</a></li>
                                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Facilities</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="home" style="overflow-x:auto;">

                                    <table class="room-type-table mar_top15" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th class="room-type">Room type</th>
                                                <th class="room-condition">Condition</th>
                                                <th class="room-price">Today price</th>
                                                <th class="room-price">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if($api_id == 1){
                                                $i = 0;
                                                $price = array();
                                                $user_ids = array_keys($hotel_data['room']);
                                                $usernames = array_column($hotel_data['room'], 'price');
                                                array_multisort($usernames, SORT_ASC, $user_ids, $hotel_data['room']);
                                                $roomArray = array_combine($user_ids, $hotel_data['room']);
                                                foreach($roomArray as $key=>$rooms){
                                                    $totalPrice = $rooms['price'];
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
                                                
                                            ?>
                                            <tr>
                                                <td class="room-type">
                                                    <div class="room-thumb">
                                                        <?php if($photo_url != ''){ ?>
                                                        <img src="http://www.roomsxml.com<?php echo $photo_url[0]; ?>" alt="">
                                                        <?php } else { ?>
                                                        <img src="<?php echo base_url(); ?>assets/images/no_image.png" alt="">
                                                        <?php } ?>
                                                    </div>
                                                    <div class="room-title">
                                                        <h4><?php echo $rooms['room_type_text']; ?></h4></div>
                                                    <div class="room-descriptions">
                                                        <p>total price for rooms</p>
                                                    </div>
                                                    <div class="room-type-footer"><i class="awe-icon awe-icon-gym"></i> <i class="awe-icon awe-icon-car"></i> <i class="awe-icon awe-icon-food"></i> <i class="awe-icon awe-icon-level"></i> <i class="awe-icon awe-icon-wifi"></i></div>
                                                </td>
                                                <td class="room-condition">
                                                    <ul class="list-condition">
                                                        <li><?php echo $rooms['meal_type_text']; ?></li>
                                                        <li>Cancellation Policy</li>
                                                    </ul>
                                                </td>
                                                <td class="room-price">
                                                    <div class="price"><span class="amount">&#8369;<?php echo number_format($totalPrice,2,'.',','); ?></span> <em>including all taxes</em> <a href="" class="">Full price</a></div>
                                                </td>
                                                <td class="room-price"><a href="<?php echo site_url(); ?>/hotel/pre_booking/<?php echo $api_id; ?>/<?php echo $hotel_data['id']; ?>/<?php echo $key; ?>" class="awe-btn">Book Now</a></td>
                                            </tr>
                                            <?php
                                                    $i++;
                                                }
                                            } 
                                            else if($api_id == 2){
                                                    $i = 0;
                                                    //echo '<pre />';print_r($hotel_data['room']);die;
                                                foreach($hotel_data['room'] as $rooms){
                                                    //echo '<pre />';print_r($rooms);die;
                                                    $totalPrice = $rooms['price'];
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
                                            ?>
                                                <tr>
                                                    <td class="room-type">
                                                        <div class="room-thumb">
                                                            <?php if($photo_url != ''){ ?>
                                                            <img src="<?php echo $photo_url[0]; ?>" alt="">
                                                            <?php } else { ?>
                                                            <img src="<?php echo base_url(); ?>assets/images/no_image.png" alt="">
                                                            <?php } ?>
                                                        </div>
                                                        <div class="room-title">
                                                            <h4><?php echo $rooms['RoomName']; ?></h4></div>
                                                        <div class="room-descriptions">
                                                            <p>total price for rooms</p>
                                                        </div>
                                                        <div class="room-type-footer"><i class="awe-icon awe-icon-gym"></i> <i class="awe-icon awe-icon-car"></i> <i class="awe-icon awe-icon-food"></i> <i class="awe-icon awe-icon-level"></i> <i class="awe-icon awe-icon-wifi"></i></div>
                                                    </td>
                                                    <td class="room-condition">
                                                        <ul class="list-condition">
                                                            <li>
                                                                <?php
                                                                    echo(isset($rooms['inc'][0]['Inclusion']) ? $rooms['inc'][0]['Inclusion'] : '');
                                                                ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                    if(isset($rooms['inc'][0]['Breakfast'])){
                                                                        if($rooms['inc'][0]['Breakfast'] == 'false'){
                                                                            echo 'Breakfast Not Available';
                                                                        } else {
                                                                            echo 'Breakfast Available';
                                                                        }
                                                                    } else {
                                                                        echo '';
                                                                    }
                                                                ?>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td class="room-price">
                                                        <div class="price"><span class="amount">&#8369;<?php echo number_format($totalPrice,2,'.',','); ?></span> <em>including all taxes</em> <a href="" class="">Full price</a></div>
                                                    </td>
                                                    <td class="room-price"><a href="<?php echo site_url(); ?>/hotel/pre_booking/<?php echo $api_id; ?>/<?php echo $hotel_data['id']; ?>/<?php echo $i; ?>" class="awe-btn">Book Now</a></td>
                                                </tr>
                                            <?php
                                                    $i++;
                                                }
                                            } 
                                            else if($api_id == 3){
                                                $i = 0;
                                                foreach($hotel_data['rooms'] as $rooms){
                                                    $totalPrice = $rooms['TotalRate'];
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
                                            ?>
                                                <tr>
                                                    <td class="room-type">
                                                        <div class="room-thumb">
                                                            <?php if($photo_url != ''){ ?>
                                                            <img src="http://www.roomsxml.com<?php echo $photo_url[0]; ?>" alt="">
                                                            <?php } else { ?>
                                                            <img src="<?php echo base_url(); ?>assets/images/no_image.png" alt="">
                                                            <?php } ?>
                                                        </div>
                                                        <div class="room-title">
                                                            <h4><?php echo $rooms['Type']; ?></h4></div>
                                                        <div class="room-descriptions">
                                                            <p>total price for rooms</p>
                                                        </div>
                                                        <div class="room-type-footer"><i class="awe-icon awe-icon-gym"></i> <i class="awe-icon awe-icon-car"></i> <i class="awe-icon awe-icon-food"></i> <i class="awe-icon awe-icon-level"></i> <i class="awe-icon awe-icon-wifi"></i></div>
                                                    </td>
                                                    <td class="room-condition">
                                                        <ul class="list-condition">
                                                            <li>
                                                                <?php
                                                                    if( strpos( $rooms['BoardBasis'], '|' ) !== false ){
                                                                        $roomBesisArr = explode('|',$rooms['BoardBasis']);
                                                                        $roomBesis = $roomBesisArr[0];
                                                                    } else {
                                                                        $roomBesis = $rooms['BoardBasis'];
                                                                    }
                                                                    echo $roomBesis; 
                                                                ?>
                                                            </li>
                                                            <li>Cancellation Policy</li>
                                                        </ul>
                                                    </td>
                                                    <td class="room-price">
                                                        <div class="price"><span class="amount">&#8369;<?php echo number_format($totalPrice,2,'.',','); ?></span> <em>including all taxes</em> <a href="" class="">Full price</a></div>
                                                    </td>
                                                    <td class="room-price"><a href="<?php echo site_url(); ?>/hotel/pre_booking/<?php echo $api_id; ?>/<?php echo $hotel_data['id']; ?>/<?php echo $i; ?>" class="awe-btn">Book Now</a></td>
                                                </tr>
                                            <?php
                                                    $i++;
                                                }
                                            }
                                            else '';
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="profile">
                                    <div class="col-md-12" style="padding: 15px 0px;">
                                    <?php 
                                        if($amenity != ''){
                                            foreach($amenity as $amty){
                                    ?>
                                            <div class="col-md-3" style="padding-bottom: 7px;"><?php echo $amty; ?></div>
                                    <?php
                                            }
                                        } else {
                                    ?>
                                        <div style="width:100%">No Facilities available to display for this hotel.</div>
                                    <?php
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div style="clear:both;"></div>
        <!--######################### FOOTER STARTS HERE #################################################################--->
        <?php $this->load->view('footer'); ?>
        <!--######################### FOOTER ENDS HERE #################################################################--->
    </body>
    <!--################### JS FILES STARTS ################################################-->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
    <!--################### JS FILES ENDS ################################################-->
    <script>
        $(document).ready(function () {
            $('#myCarousel').carousel({
                interval: 4000
            });

            var clickEvent = false;
            $('#myCarousel').on('click', '.nav a', function () {
                clickEvent = true;
                $('.nav li').removeClass('active');
                $(this).parent().addClass('active');
            }).on('slid.bs.carousel', function (e) {
                if (!clickEvent) {
                    var count = $('.nav').children().length - 1;
                    var current = $('.nav li.active');
                    current.removeClass('active').next().addClass('active');
                    var id = parseInt(current.data('slide-to'));
                    if (count == id) {
                        $('.nav li').first().addClass('active');
                    }
                }
                clickEvent = false;
            });
        });
        
        $('#myTabs a').click(function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
        $('#myTabs a[href="#profile"]').tab('show') // Select tab by name
        $('#myTabs a:first').tab('show') // Select first tab
        $('#myTabs a:last').tab('show') // Select last tab
        $('#myTabs li:eq(2) a').tab('show') // Select third tab (0-indexed)
    </script>
</html>	