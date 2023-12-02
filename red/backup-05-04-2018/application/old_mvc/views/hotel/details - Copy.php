<!DOCTYPE html>
<html>
    <head>
        <title><?php echo Site_Title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
        <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/styles.css" type="text/css" rel="stylesheet" media="all">
        <link href="<?php echo base_url(); ?>assets/css/details_new.css" type="text/css" rel="stylesheet" media="all">
        <link href="<?php echo base_url(); ?>assets/css/review_hotel.css" rel=" stylesheet" />
    </head>
    <body>
        <?php $this->load->view('header'); ?>
        <div class="container">
        <div id="page-wrapper">

            <div class="col-md-12" style="background-color:#fe0000;margin-top: 15px;;">
                <div class="main1">
                    <div class="col-md-2 border1">
                        <div class="pad8" style="color:#fff;"><a href="#">Back to search result</a></div>
                    </div>
                    <div class="col-md-4">
                        <div class="pad8" style="color:#fff;"><?php echo date('D d, M, Y', strtotime($searchData['cin'])); ?> - <?php echo date('D d, M, Y', strtotime($searchData['cout'])); ?></div>

                    </div>
                    <div class="col-md-4" style="color:#fff;">
                        <div class="pad8">
                            Rooms : <?php echo $searchData['room_count']; ?> , Adults : <?php echo $searchData['adult_count']; ?><?php if ($searchData['child_count'] > 0) { echo ' , Child : ' . $searchData['child_count']; } ?>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-md-12" style="padding:0px;">
                <div class="main1">
                    <div class="wht" style="background-color: #FBFBFB;">
                        <div style="padding:10px 5px 10px 5px;">
                            <div class="col-md-12" style="padding-bottom:10px;">
                                <h3 style="padding:10px 10px 10px 0px;">
                                    <?php 
                                        if($api_id == '1'){
                                            echo $hotel_data['name'];
                                        }
                                        if($api_id == '2'){
                                            echo $details['hotel_name'];
                                        }
                                    ?>
                                    <?php
                                    if ($star == '1') {
                                        ?>
                                        <div class="five-stars-container" style="font-size: 16px;"><span class="five-stars" style="width: 20%"></span></div>
                                        <?php
                                    }
                                    if ($star == '2') {
                                        ?>
                                        <div class="five-stars-container" style="font-size: 16px;"><span class="five-stars" style="width: 40%"></span></div>
                                        <?php
                                    }
                                    if ($star == '3') {
                                        ?>
                                        <div class="five-stars-container" style="font-size: 16px;"><span class="five-stars" style="width: 60%"></span></div>
                                        <?php
                                    }
                                    if ($star == '4') {
                                        ?>
                                        <div class="five-stars-container" style="font-size: 16px;"><span class="five-stars" style="width: 80%"></span></div>
                                        <?php
                                    }
                                    if ($star == '5') {
                                        ?>
                                        <div class="five-stars-container" style="font-size: 16px;"><span class="five-stars" style="width: 100%"></span></div>
                                <?php } ?>
                                </h3>
                                <p style="color:#e74c3c;">
                                    <?php
                                        if($api_id =='1'){
                                            echo(isset($address)?$address:''); 
                                        }
                                        if($api_id =='2'){
                                            echo(isset($hotelDetails->HotelAddress)?$hotelDetails->HotelAddress:'');
                                        }
                                    ?>
                                </p>
                                <p style="color:#e74c3c;"><?php echo(isset($email)?$email:'');  //$email;  ?></p>
                                <p style="color:#e74c3c;"><?php echo ''; //$tel;  ?></p>
                                <div class="col-md-3 border12" style="padding-right:0px; width:14%;">
                                    <p style="padding:0px 0px 0px 0px; margin:0px;">Jump to: <a href="#">Overview</a></p>
                                </div>
                                <div class="col-md-2 border12" style="width: 12%;">
                                    <p style="padding-top:0px;  margin:0px;"><a href="#">Room Choices</a></p>
                                </div>
                                <div class="col-md-3 border12" style="border:0px;">
                                    <p style="padding-top:0px; margin:0px;"><a href="#">Hotel Informations</a></p>
                                </div>
                                <div style="clear:both;"></div>
                                <div class="col-md-6 col-xs-12" style="padding:10px 20px 10px 0px;">

                                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                        <!-- Indicators -->


                                        <div class="carousel-inner" role="listbox">
                                            <?php 
                                                if(is_array($photo_url)){
                                                    $i=0;
                                                    foreach($photo_url as $photo){
                                            ?>
                                            <div class="item <?php if($i == 0){ echo 'active'; } ?>">
                                                <img src="http://www.roomsxml.com<?php echo $photo; ?>" class="img-responsive" style="height:280px; width:530px;">
                                            </div>
                                            <?php 
                                                        $i++;
                                                    }
                                                } else {
                                            ?>
                                                    <div class="item active">
                                                        <img src="<?php echo base_url(); ?>assets/images/no_image.png" class="img-responsive" style="height:280px; width:530px;">
                                                    </div>
                                            <?php
                                                } 
                                            ?>
                                        </div>

                                        <!-- Left and right controls -->
                                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div></div>

                                <p>
                                    <?php 
                                        if($api_id == '1'){
                                            if(isset($desc) && $desc!='')
                                            {     
                                                foreach($desc as $dec){ 
                                        ?>
                                                    <p>
                                                        <b><?php echo $dec['type']; ?> : </b><?php echo $dec['text']; ?>
                                                    </p>  
                                        <?php
                                                }   
                                            }
                                            else
                                            {
                                                echo '<p>No description available for this hotel.</p>';
                                            }
                                        }
                                    ?>
                                </p>
                            </div>
                            <div class="col-md-12">
                                <?php
                                $lat = $latitude;
                                $lon = $longitude;
                                ?>    
                                <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
                                <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>

                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        // Define the latitude and longitude positions
                                        var latitude = parseFloat("<?php echo $lat; ?>"); // Latitude get from above variable
                                        var longitude = parseFloat("<?php echo $lon; ?>"); // Longitude from same
                                        var latlngPos = new google.maps.LatLng(latitude, longitude);
                                        // Set up options for the Google map
                                        var myOptions = {
                                            zoom: 10,
                                            center: latlngPos,
                                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                                            zoomControlOptions: true,
                                            zoomControlOptions: {
                                                style: google.maps.ZoomControlStyle.LARGE
                                            }
                                        };
                                        // Define the map
                                        map = new google.maps.Map(document.getElementById("map"), myOptions);
                                        // Add the marker
                                        var marker = new google.maps.Marker({
                                            position: latlngPos,
                                            map: map,
                                            title: "<?php echo $details['hotel_name']; ?>"
                                        });
                                    });
                                </script>
                                <div class="col-md-12">
                                    <div id="hotel-map">
                                        <div id="map" style="width:100%;height:160px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wht" style=" margin:10px 0px 10px 0px; border-radius:3px;    background-color: #fe0000; color:#fff;">
                        <div style="padding:15px 10px 35px 10px;">
                            <div class="col-md-6">
                                <p><b>Choose your room</b></p>
                            </div>
                            <div class="col-md-6">
                                <p class="pull-right">
                                    <?php echo date('D d, M, Y', strtotime($searchData['cin'])); ?> - <?php echo date('D d, M, Y', strtotime($searchData['cout'])); ?> <?php echo $searchData['room_count']; ?> , Adults : <?php echo $searchData['adult_count']; ?><?php if ($searchData['child_count'] > 0) { echo ' , Child : ' . $searchData['child_count']; } ?>
                                </p>
                            </div> 
                        </div>
                    </div>
                    <div class="wht1" style=" margin:10px 0px 0px 0px;">
                        <div class="box3"  style="border:2px solid #E0DDDD; padding:0px;">
                            <div class=" col-md-12" >
                                <div class="col-md-12">
                                    <h3 style="color:#FFF; margin-top:5px;">Book now to get this fantastic price.</h3>
                                    <p>If you book later, there’s a chance the price will go up or the hotel will be sold out.</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="wht1" style="">
                        <div class="box4"  style="border:2px solid #E0DDDD; border-top:0px;">
                            <div class="col-md-2 room_type" style="text-align: center;">
                                <p>Room Type</p>
                            </div>
                            <div class="col-md-2 room_type" style="text-align: center;">
                                <p>Inclusions</p>
                            </div>
                            <div class="col-md-3 room_type1" style="text-align: center;">
                                <p>Price</p>
                            </div>


                        </div>
                    </div>

                    <?php
                        $i = 0;
                        $price = array();
                        $user_ids = array_keys($hotel_data['room']);
                        $usernames = array_column($hotel_data['room'], 'price');
                        array_multisort($usernames, SORT_ASC, $user_ids, $hotel_data['room']);
                        $roomArray = array_combine($user_ids, $hotel_data['room']);
                        foreach($roomArray as $key=>$rooms){
                    ?>
                        <div class="wht1" style="">
                            <div class="box4"  style="border:2px solid #E0DDDD; border-top:0px;">
                                <div class="col-md-2 room_type">
                                    
                                    <?php 
                                        if($photo_url != ''){
                                    ?>
                                    <img src="http://www.roomsxml.com<?php echo $photo_url[0]; ?>" style="width:150px;height:100px;">
                                    <?php 
                                        } else {
                                    ?>
                                    <img src="<?php echo base_url(); ?>assets/images/no_image.png" style="width:150px;height:100px;">
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div class="col-md-3 room_type">
                                    <h4 style="padding-bottom:2px; padding-top:10px;"><?php echo $rooms['room_type_text']; ?></h4>
                                </div>
                                <div class="col-md-3 room_type6" style="text-align: center; padding-bottom:0px; padding-top:30px;">
                                    <p style="padding-left:0px;color:#9c0c1e;"><b><?php echo $rooms['meal_type_text']; ?></b></p>
                                </div>
                                <div class="col-md-2 room_type7" style="text-align: center; padding-bottom:0px;">
                                    <h3 style="padding-left:0px"><?php echo $_SESSION['system_currency']; ?> <?php echo $rooms['price']; ?></h3>
                                    <p style="padding-left:0px;">total price</p>
                                </div>
                                <div class="col-md-1 room_type8" style=" padding-bottom:0px;">
                                    <button type="button" class="btn btn-danger" onclick="window.location.href = '<?php echo site_url(); ?>/hotel/pre_booking/<?php echo $api_id; ?>/<?php echo $hotel_data['id']; ?>/<?php echo $key; ?>'">Book Now</button>
                                </div>


                            </div>
                        </div>
                        <?php
                        $i++;
                    }
                    ?>
                    <div style="clear:both;"></div>
                    <div class="col-md-6" style="margin:10px 0px 10px 0px;">
                        <div class="col-md-2" style=" ">
                            <p style=" margin:0px; text-align:center;">Jump to:</p>
                        </div>
                        <div class="col-md-3" style=" border-left:1px solid #000;">
                            <p style=" margin:0px; text-align:center;"><a href="#">Over View</a></p>
                        </div>
                        <div class="col-md-3" style=" border-left:1px solid #000;border-left: 1px solid #000;padding-right: 0;padding-left: 4px;">
                            <p style=" margin:0px; text-align:center;"><a href="#">Room Choices</a></p>
                        </div>
                        <div class="col-md-4" style=" border-left:1px solid #000;">
                            <p style=" margin:0px; text-align:center;"><a href="#">Hotel Information</a></p>
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="wht1" style=" margin-top:10px; border:2px solid #E0DDDD;background-color: #EFECEC;padding: 49px 10px 20px 35px;">
                        <div class="box4"  style="">
                            <div class="hot">
                                <p>In the hotel</p>
                            </div>
                            <div style="clear:both;"></div>
                            <div class="hot1">
                                <div class="buildingf">
                                    <p>Building Facilities</p>
                                </div>
                                <div class="buildingf12">
                                    <p>Number of floors(main building)-3 / Total number of rooms-17 / Connecting Rooms</p>
                                </div>
                                <div class="buildingf">
                                    <p>Credcards Facilities</p>
                                </div>
                                <div class="buildingf12">
                                    <p>Mastercard / Visa / Maestro / Visa Electron</p>
                                </div>
                                <div class="buildingf">
                                    <p>Room Facilities</p>
                                </div>
                                <div class="buildingf12">
                                    <p>Wheelchair-accessible / Disability-friendly bathroom / Smoking rooms / Queen-size bed / King-size bed 150-183 width / Double Bed / Extra beds on demand / Hairdyer / 220v power supply / Tolletries / make up mirror / Safe / Tv / Satellite Tv / Cable Tv / Ironing set / Smoke detector</p>
                                </div>
                                <div class="buildingf">
                                    <p>Service Facilities</p>
                                </div>
                                <div class="buildingf12">
                                    <p>Small pets allowed (under 5kg) / large pets allowed (under 5kg) / Wheelchair-accessible / Car parking / Garage / Mobile Phone Coverage / Transfer service / Secure Parking / Room service</p>
                                </div>
                                <div class="buildingf">
                                    <p>Catering Facilities</p>
                                </div>
                                <div class="buildingf12">
                                    <p>Air conditioning in Restaurant</p>
                                </div>
                                <div class="buildingf">
                                    <p>Business Facilities</p>
                                </div>
                                <div class="buildingf12">
                                    <p>Conference room / Meeting room / Business Center</p>
                                </div>
                                <div class="buildingf">
                                    <p>Meals Facilities</p>
                                </div>
                                <div class="buildingf12">
                                    <p>Breakfast / Ala carte lunch / Ala carte dinner</p>
                                </div>
                                <div class="buildingf">
                                    <p>Distance Facilities</p>
                                </div>
                                <div class="buildingf12">
                                    <p>Airport-27000 mts away</p>
                                </div>
                                <div class="buildingf">
                                    <p>Airport distance Facilities</p>
                                </div>
                                <div class="buildingf12">
                                    <p>Mumbai railway station-38 km away</p>
                                </div>


                            </div>
                            <div class="hot" style="margin-top:10px;">
                                <p>In the Room</p>
                            </div>
                            <div style="clear:both;"></div>
                            <div class="hot1">
                                <div class="buildingf">
                                    <p> Facilities</p>
                                </div>




                            </div>

                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="col-md-12" style="margin-top:10px; margin-bottom:10px;padding:10px 0px 10px 0px; background-color:#ecf0f1;">
                        <div class="col-md-3 border12" style="padding-left:10px;">
                            <p>Jump to: <a href="#">Overview</a></p>
                        </div>
                        <div class="col-md-3 border12">
                            <p><a href="#">Room Choices</a></p>
                        </div>
                        <div class="col-md-3 border12" style="border:0px;">
                            <p><a href="#">Hotel Informations</a></p>
                        </div>

                        <div class="col-md-3" >
                            <p><a href="#"><b>Back to Top</b></a></p>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <p><a href="#"><b>Is the description of this hotel not correct? Tell us</b></a></p>
                    </div>
                </div>
            </div>



        </div>
        </div>
        <div style="clear:both;"></div>
        <?php $this->load->view('footer'); ?>
    </body>
    <script type="text/javascript">
        var Site_Url = '<?php echo site_url(); ?>';
        var Base_Url = '<?php echo base_url(); ?>';
    </script>
    <!--################### JS FILES STARTS ################################################-->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/common.js"></script>
    <!--################### JS FILES ENDS ################################################-->
</html>	