 <?php $this->load->view('common/header');?>
    <section class="">
         
    
    <!-- Breadcrumbs -->
    <div class="container breadcrub">
        <div>
            <a class="homebtn left" href="#"></a>
            <div class="left">
                <ul class="bcrumbs">
                    <li>/</li>
                    <li><a href="javascript:;">Hotels</a></li>
                    <li>/</li>
                    <li><a href="javascript:;"><?php echo $searchData['dest_city'];?></a></li>
                    <li>/</li>                  
                    <li><a href="javascript:;" class="active"><?php echo $hotel_data['name'];?></a></li>                    
                </ul>               
            </div>
            <a class="backbtn right" href="#"></a>
        </div>
        <div class="clearfix"></div>
        <div class="brlines"></div>
    </div>  
    <!-- / Breadcrumbs -->

    <!-- CONTENT -->
    <div class="container">
        <div class="container pagecontainer offset-0">  

          <!-- SLIDER -->
            <div class="col-md-8 details-slider">
            
                <div id="c-carousel">
                <div id="wrapper">
                <div id="inner">
                    <div id="caroufredsel_wrapper2">
                        <div id="carousel">


                         <?php 
                                    if(is_array($photo_url)){
                                        $i=0;
                                        if($api_id == 1 || $api_id == 3){
                                            foreach($photo_url as $photo){
                                ?>
                               
                                    <img src="http://www.roomsxml.com<?php echo $photo; ?>" alt="" style="width:700px;height:500px;">
                              
                                <?php 
                                                $i++;
                                            }
                                        } else {
                                            foreach($photo_url as $photo){
                                ?>
                                           
                                                <img src="<?php echo $photo; ?>" alt="" style="width:700px;height:500px;">
                                          
                                <?php
                                                $i++;
                                            }
                                        }
                                    } else {
                                ?>
                               
                                    <img src="<?php echo base_url();?>assets/images/no_image.png" alt="">
                            
                                <?php
                                    } 
                                ?>

                                                   
                        </div>
                    </div>
                    <div id="pager-wrapper">
                        <div id="pager">

                         <?php 
                                    if(is_array($photo_url)){
                                        $i=0;
                                        if($api_id == 1 || $api_id == 3){
                                            foreach($photo_url as $photo){
                                ?>
                               
                                    <img  width="120" height="68" src="http://www.roomsxml.com<?php echo $photo; ?>" alt="" style="width:700px;height:500px;">
                              
                                <?php 
                                                $i++;
                                            }
                                        } else {
                                            foreach($photo_url as $photo){
                                ?>
                                           
                                                <img width="120" height="68" src="<?php echo $photo; ?>" alt="" style="width:700px;height:500px;">
                                          
                                <?php
                                                $i++;
                                            }
                                        }
                                    } else {
                                ?>
                               
                                    <img width="120" height="68" src="<?php echo base_url();?>assets/images/no_image.png" alt="">
                            
                                <?php
                                    } 
                                ?>

                                            
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <button id="prev_btn2" class="prev2"><img src="<?php echo base_url();?><?php echo base_url();?>assets_/images/spacer.png" alt=""/></button>
                <button id="next_btn2" class="next2"><img src="<?php echo base_url();?><?php echo base_url();?>assets_/images/spacer.png" alt=""/></button>     
                    
        </div>
        </div> <!-- /c-carousel -->
            
            
            
            
            
            </div>
            <!-- END OF SLIDER -->          
            
            <!-- RIGHT INFO -->
            <div class="col-md-4 detailsright offset-0">
                <div class="padding20">
                    <h4 class="lh1"><?php echo $hotel_data['name']; ?></h4>
                   <span class="ratings size-xs">
                                     <?php for($st=0;$st<5;$st++){ if($star <= $st){ ?>
                                          <i class="fa fa-star"></i>
                                       
                                   <?php }else{ ?>
                                     <i class="fa fa-star active"></i>
                           
                                  <?php }  }  ?>
                                        
                                    </span>
                </div>
                
                <div class="line3"></div>
                
                <div class="hpadding20">
                    <h2 class="opensans slim green2">Wonderful!</h2>
                </div>
                
                <div class="line3 margtop20"></div>
                
                <div class="col-md-6 bordertype1 padding20">
                    <span class="opensans size30 bold grey2">97%</span><br/>
                    of guests<br/>recommend
                </div>
                <div class="col-md-6 bordertype2 padding20">
                 <br/>
                 <?php echo(isset($address) ? $address : '' ); ?> | <?php echo(isset($tel) ? $tel : '' ); ?>
                 <br/>
                 <?php echo(isset($email) ? $email : '' ); ?>
                </div>
                
                <div class="col-md-6 bordertype3">
                    <img src="<?php echo base_url();?>assets_/images/user-rating-4.png" alt=""/><br/>
                    18 reviews
                </div>
            
                <div class="clearfix"></div><br/>
                
                
            </div>
            <!-- END OF RIGHT INFO -->

        </div>
        <!-- END OF container-->
        
        <div class="container mt25 offset-0">

            <div class="col-md-8 pagecontainer2 offset-0">
                <div class="cstyle10"></div>
        
                <ul class="nav nav-tabs" id="myTab">
                    <li onclick="mySelectUpdate()" class=""><a data-toggle="tab" href="#summary"><span class="summary"></span><span class="hidetext">Summary</span>&nbsp;</a></li>
                    <li onclick="mySelectUpdate()" class="active"><a data-toggle="tab" href="#roomrates"><span class="rates"></span><span class="hidetext">Room rates</span>&nbsp;</a></li>
                    <li onclick="mySelectUpdate()" class=""><a data-toggle="tab" href="#preferences"><span class="preferences"></span><span class="hidetext">Preferences</span>&nbsp;</a></li>
                    <li onclick="loadScript()" class=""><a data-toggle="tab" href="#maps"><span class="maps"></span><span class="hidetext">Maps</span>&nbsp;</a></li>
                    <li onclick="mySelectUpdate(); trigerJslider(); trigerJslider2(); trigerJslider3(); trigerJslider4(); trigerJslider5(); trigerJslider6();" class=""><a data-toggle="tab" href="#reviews"><span class="reviews"></span><span class="hidetext">Reviews</span>&nbsp;</a></li>
                  <!--   <li onclick="mySelectUpdate()" class=""><a data-toggle="tab" href="#thingstodo"><span class="thingstodo"></span><span class="hidetext">Things to do</span>&nbsp;</a></li> -->

                </ul>           
                <div class="tab-content4" >
                    <!-- TAB 1 -->              
                    <div id="summary" class="tab-pane fade ">
                        <p class="hpadding20">
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
                        </p>
                        <div class="line4"></div>
                        
                                                  
                
                    </div>
                    <!-- TAB 2 -->
                   

                 



                                    <div id="roomrates" class="tab-pane fade active in">
                        
                        <br>
                        
                        <p class="hpadding20 dark">Room type</p>
                        
                        <div class="line2"></div>

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
                                           
                                               
                                               

                                                 <div class="padding20">
                            <div class="col-md-4 offset-0">
                                <a href="#">

                                 <?php if($photo_url != ''){ ?>
                                                              <img style="width:200px;height:100px;" src="http://www.roomsxml.com<?php echo $photo_url[0]; ?>" alt="">
                                                            <?php } else { ?>
                                                            <img style="width:200px;height:100px;"  src="<?php echo base_url();?>assets/images/no_image.png" alt="">
                                                            <?php } ?>

                            
                                </a>
                            </div>
                            <div class="col-md-8 offset-0">
                                <div class="col-md-8 mediafix1">
                                    <h4 class="opensans dark bold margtop1 lh1"><?php echo $rooms['room_type_text']; ?>
                                        
                                    </h4>
                                 
                                    <ul class="hotelpreferences margtop10">
                                        <li class="icohp-internet"></li>
                                        <li class="icohp-air"></li>
                                        <li class="icohp-pool"></li>
                                        <li class="icohp-childcare"></li>
                                        <li class="icohp-fitness"></li>
                                        <li class="icohp-breakfast"></li>
                                        <li class="icohp-parking"></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                    <ul class="checklist2 margtop10">
                                  <li><?php echo $rooms['meal_type_text']; ?></li>
                                                            <li>Cancellation Policy</li>
                                     
                                        <li> <em>including all taxes</em></li>
                                    </ul>                                   
                                </div>
                                <div class="col-md-4 center bordertype4">
                                    <span class="opensans green size24"><span class="amount">&#8369;<?php echo number_format($totalPrice,2,'.',','); ?></span></span><br>
                                    <span class="opensans lightgrey size12">avg/night</span><br><br>
                                    <span class="lred bold">total price for rooms</span><br><br>
                                    <a href="<?php echo site_url(); ?>/hotel/pre_booking/<?php echo $api_id; ?>/<?php echo $hotel_data['id']; ?>/<?php echo $i; ?>" class="bookbtn mt1">Book</a>   
                                </div>                                      
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="line2"></div> 

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
                                               

                                                  <div class="padding20">
                            <div class="col-md-4 offset-0">
                                <a href="#">

                                 <?php if($photo_url != ''){ ?>
                                                              <img style="width:200px;height:100px;" src="<?php echo $photo_url[0]; ?>" alt="">
                                                            <?php } else { ?>
                                                            <img style="width:200px;height:100px;"  src="<?php echo base_url();?>assets/images/no_image.png" alt="">
                                                            <?php } ?>

                            
                                </a>
                            </div>
                            <div class="col-md-8 offset-0">
                                <div class="col-md-8 mediafix1">
                                    <h4 class="opensans dark bold margtop1 lh1"><?php echo $rooms['RoomName']; ?>
                                        
                                    </h4>
                                 
                                    <ul class="hotelpreferences margtop10">
                                        <li class="icohp-internet"></li>
                                        <li class="icohp-air"></li>
                                        <li class="icohp-pool"></li>
                                        <li class="icohp-childcare"></li>
                                        <li class="icohp-fitness"></li>
                                        <li class="icohp-breakfast"></li>
                                        <li class="icohp-parking"></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                    <ul class="checklist2 margtop10">
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
                                                            <li>Cancellation Policy</li>
                                     
                                        <li> <em>including all taxes</em></li>
                                    </ul>                                   
                                </div>
                                <div class="col-md-4 center bordertype4">
                                    <span class="opensans green size24"><span class="amount">&#8369;<?php echo number_format($totalPrice,2,'.',','); ?></span></span><br>
                                    <span class="opensans lightgrey size12">avg/night</span><br><br>
                                    <span class="lred bold">total price for rooms</span><br><br>
                                    <a href="<?php echo site_url(); ?>/hotel/pre_booking/<?php echo $api_id; ?>/<?php echo $hotel_data['id']; ?>/<?php echo $i; ?>" class="bookbtn mt1">Book</a>   
                                </div>                                      
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="line2"></div> 

                                              
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


                                             <div class="padding20">
                            <div class="col-md-4 offset-0">
                                <a href="#">

                                 <?php if($photo_url != ''){ ?>
                                                            <img style="width:200px;height:100px;"  src="http://www.roomsxml.com<?php echo $photo_url[0]; ?>" alt="">
                                                            <?php } else { ?>
                                                            <img style="width:200px;height:100px;"  src="<?php echo base_url();?>assets/images/no_image.png" alt="">
                                                            <?php } ?>

                            
                                </a>
                            </div>
                            <div class="col-md-8 offset-0">
                                <div class="col-md-8 mediafix1">
                                    <h4 class="opensans dark bold margtop1 lh1"><?php echo $rooms['Type']; ?>
                                        
                                    </h4>
                                 
                                    <ul class="hotelpreferences margtop10">
                                        <li class="icohp-internet"></li>
                                        <li class="icohp-air"></li>
                                        <li class="icohp-pool"></li>
                                        <li class="icohp-childcare"></li>
                                        <li class="icohp-fitness"></li>
                                        <li class="icohp-breakfast"></li>
                                        <li class="icohp-parking"></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                    <ul class="checklist2 margtop10">
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
                                     
                                        <li> <em>including all taxes</em></li>
                                    </ul>                                   
                                </div>
                                <div class="col-md-4 center bordertype4">
                                    <span class="opensans green size24"><span class="amount">&#8369;<?php echo number_format($totalPrice,2,'.',','); ?></span></span><br>
                                    <span class="opensans lightgrey size12">avg/night</span><br><br>
                                    <span class="lred bold">total price for rooms</span><br><br>
                                    <a href="<?php echo site_url(); ?>/hotel/pre_booking/<?php echo $api_id; ?>/<?php echo $hotel_data['id']; ?>/<?php echo $i; ?>" class="bookbtn mt1">Book</a>   
                                </div>                                      
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="line2"></div> 

                                             
                                            <?php
                                                    $i++;
                                                }
                                            }
                                            else '';
                                            ?>
                                     
                        
                             

               
                      
                    </div>
                    
                    <!-- TAB 3 -->                  
                    <div id="preferences" class="tab-pane fade">
                        <p class="hpadding20">
                        The hotel offers a snack bar/deli. A bar/lounge is on site where guests can unwind with a drink. Guests can enjoy a complimentary breakfast. An Internet point is located on site and high-speed wireless Internet access is complimentary.
                        </p>
                        
                        <div class="line4"></div>
                        
                        <!-- Collapse 7 --> 
                        <button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#collapse7">
                          Hotel facilities <span class="collapsearrow"></span>
                        </button>
                        
                        <div id="collapse7" class="collapse in">
                            <div class="hpadding20">
                                
                                <div class="col-md-4 offset-0">

                                 <?php 
                                        if($amenity != '' && is_array($amenity)){
                                            foreach($amenity as $amty){
                                    ?>
                                            <div class="item"><i class="awe-icon awe-icon-unlock"></i> <span><?php echo $amty; ?></span></div>
                                    <?php
                                            }
                                        }
                                    ?>


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

                        
                                                             
                                <div class="clearfix"></div>
                            </div>
                            
                        </div>
                        <!-- End of collapse 7 -->      
                        <br/>
                        <div class="line4"></div>                           
                        
                        <!-- Collapse 8 --> 
                        <button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#collapse8">
                          Room facilities <span class="collapsearrow"></span>
                        </button>
                        
                        <div id="collapse8" class="collapse in">
                           
                            <div class="clearfix"></div>
                        </div>
                        <!-- End of collapse 8 -->              
                        
                        
                    </div>
                    
                    <!-- TAB 4 -->                  
                    <div id="maps" class="tab-pane fade">
                        <div class="hpadding20">
                            <div id="map-canvas"></div>
                        </div>
                    </div>
                    
                    <!-- TAB 5 -->                  
                    <div id="reviews" class="tab-pane fade ">
                        <div class="hpadding20">
                            <div class="col-md-4 offset-0">
                                <span class="opensans dark size60 slim lh3 ">4.5/5</span><br/>
                                <img src="<?php echo base_url();?><?php echo base_url();?>assets_/images/user-rating-4.png" alt=""/>
                            </div>
                            <div class="col-md-8 offset-0">
                                <div class="progress progress-striped">
                                  <div class="progress-bar progress-bar-success wh75percent" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <span class="sr-only">4.5 out of 5</span>
                                  </div>
                                </div>      
                                <div class="progress progress-striped">
                                  <div class="progress-bar progress-bar-success wh100percent" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                    <span class="sr-only">100% of guests recommend</span>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                Ratings based on 5 Verified Reviews
                            </div>          
                            <div class="clearfix"></div>
                            <br/>
                            <span class="opensans dark size16 bold">Average ratings</span>
                        </div>
                        
                        <div class="line4"></div>
                        
                        <div class="hpadding20">
                            <div class="col-md-4 offset-0">
                                <div class="scircle left">4.4</div>
                                <div class="sctext left margtop15">Cleanliness</div>
                                <div class="clearfix"></div>
                                <div class="scircle left">4.0</div>
                                <div class="sctext left margtop15">Service & staff</div>
                                <div class="clearfix"></div>                                
                            </div>
                            <div class="col-md-4 offset-0">
                                <div class="scircle left">3.8</div>
                                <div class="sctext left margtop15">Room comfort</div>
                                <div class="clearfix"></div>
                                <div class="scircle left">4.4</div>
                                <div class="sctext left margtop15">Sleep Quality</div>          
                                <div class="clearfix"></div>                                        
                            </div>
                            <div class="col-md-4 offset-0">
                                <div class="scircle left">4.2</div>
                                <div class="sctext left margtop15">Location</div>
                                <div class="clearfix"></div>
                                <div class="scircle left">4.4</div>
                                <div class="sctext left margtop15">Value for Price</div>        
                                <div class="clearfix"></div>                                        
                            </div>      
                            <div class="clearfix"></div>
                            
                            <br/>
                            <span class="opensans dark size16 bold">Reviews</span>
                        </div>
                        
                        
                        
                        
                        
                        
                            
                        <div class="line2"></div>
                            
                        <div class="hpadding20">    
                            <div class="col-md-4 offset-0 center">
                                <div class="padding20">
                                    <div class="bordertype5">
                                        <div class="circlewrap">
                                            <img src="<?php echo base_url();?><?php echo base_url();?>assets_/images/user-avatar.jpg" class="circleimg" alt=""/>
                                            <span>4.5</span>
                                        </div>
                                        <span class="dark">by Sena</span><br/>
                                        from London, UK<br/>
                                        <img src="<?php echo base_url();?><?php echo base_url();?>assets_/images/check.png" alt=""/><br/>
                                        <span class="green">Recommended<br/>for Everyone</span>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-8 offset-0">
                                <div class="padding20">
                                    <span class="opensans size16 dark">Great experience</span><br/>
                                    <span class="opensans size13 lgrey">Posted Jun 02, 2013</span><br/>
                                    <p>It is close to everything but if you go in the lower season the pool won't be ready even though the temperature was quiet high already.</p>  
                                    <ul class="circle-list">
                                        <li>4.5</li>
                                        <li>3.8</li>
                                        <li>4.2</li>
                                        <li>5.0</li>
                                        <li>4.6</li>
                                        <li>4.8</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="clearfix"></div>                            
                        </div>  
                        
                        <div class="line2"></div>
                        <br/>
                        <br/>
                        <div class="hpadding20">
                            <span class="opensans dark size16 bold">Reviews</span>
                        </div>
                        
                        <div class="line2"></div>

                        <div class="wh33percent left center">
                            <ul class="jslidetext">
                                <li>Cleanliness</li>
                                <li>Room comfort</li>
                                <li>Location</li>
                                <li>Service & staff</li>
                                <li>Sleep quality</li>
                                <li>Value for Price</li>
                            </ul>
                            
                            <ul class="jslidetext2">
                                <li>Username</li>
                                <li>Evaluation</li>
                                <li>Title</li>
                                <li>Comment</li>
                            </ul>
                        </div>
                        <div class="wh66percent right offset-0">
                            <script>
                                //This is a fix for when the slider is used in a hidden div
                                function testTriger(){
                                    setTimeout(function (){
                                        $(".cstyle01").resize();
                                    }, 500);    
                                }
                            </script>
                            <div class="padding20 relative wh70percent">
                                <div class="layout-slider wh100percent">
                                <span class="cstyle01"><input id="Slider1" type="slider" name="price" value="0;4.2" /></span>
                                </div>
                                <script type="text/javascript" >
                                function trigerJslider(){
                                  jQuery("#Slider1").slider({ from: 0, to: 5, step: 0.1, smooth: true, round: 1, dimension: "", skin: "round" });
                                  testTriger();
                                  }
                                </script>
                                
                                
                                
                                <div class="layout-slider margtop10 wh100percent">
                                <span class="cstyle01"><input id="Slider2" type="slider" name="price" value="0;5.0" /></span>
                                </div>
                                <script type="text/javascript" >
                                function trigerJslider2(){
                                  jQuery("#Slider2").slider({ from: 0, to: 5, step: 0.1, smooth: true, round: 1, dimension: "", skin: "round" });
                                  }
                                </script>
                                
                                <div class="layout-slider margtop10 wh100percent">
                                <span class="cstyle01"><input id="Slider3" type="slider" name="price" value="0;2.5" /></span>
                                </div>
                                <script type="text/javascript" >
                                function trigerJslider3(){
                                  jQuery("#Slider3").slider({ from: 0, to: 5, step: 0.1, smooth: true, round: 1, dimension: "", skin: "round" });
                                  }
                                </script>

                                <div class="layout-slider margtop10 wh100percent">
                                <span class="cstyle01"><input id="Slider4" type="slider" name="price" value="0;3.8" /></span>
                                </div>
                                <script type="text/javascript" >
                                function trigerJslider4(){
                                  jQuery("#Slider4").slider({ from: 0, to: 5, step: 0.1, smooth: true, round: 1, dimension: "", skin: "round" });
                                  }
                                </script>
                                
                                <div class="layout-slider margtop10 wh100percent">
                                <span class="cstyle01"><input id="Slider5" type="slider" name="price" value="0;4.4" /></span>
                                </div>
                                <script type="text/javascript" >
                                function trigerJslider5(){
                                  jQuery("#Slider5").slider({ from: 0, to: 5, step: 0.1, smooth: true, round: 1, dimension: "", skin: "round" });
                                  }
                                </script>
                                
                                <div class="layout-slider margtop10 wh100percent">
                                <span class="cstyle01"><input id="Slider6" type="slider" name="price" value="0;4.0" /></span>
                                </div>
                                <script type="text/javascript" >
                                function trigerJslider6(){
                                  jQuery("#Slider6").slider({ from: 0, to: 5, step: 0.1, smooth: true, round: 1, dimension: "", skin: "round" });
                                  }
                                </script>
                                
                                <input type="text" class="form-control margtop10" placeholder="">
                                <select class="form-control mySelectBoxClass margtop10">
                                  <option selected>Wonderful!</option>
                                  <option>Nice</option>
                                  <option>Neutral</option>
                                  <option>Don't recommend</option>
                                </select>
                                <input type="text" class="form-control margtop10" placeholder="">
                                
                                <textarea class="form-control margtop10" rows="3"></textarea>
                                
                                <div class="clearfix"></div>
                                <button type="submit" class="btn-search4 margtop20">Submit</button> 

                                <br/>
                                <br/>
                                <br/>
                                <br/>
                                
                            </div>                          
                        </div>
                        <div class="clearfix"></div>

                    </div>      
                    
                    <!-- TAB 6 -->                  
                              
                </div>
            </div>
            
            <div class="col-md-4" >
                
                <div class="pagecontainer2 testimonialbox">
                    <div class="cpadding0 mt-10">
                        <span class="icon-quote"></span>
                        <p class="opensans size16 grey2">It was very comfortable to stay and staff were pleasant and welcoming.<br/>
                        <span class="lato lblue bold size13"><i>by Ellison from United Kingdom</i></span></p> 
                    </div>
                </div>
                
                <div class="pagecontainer2 mt20 needassistancebox">
                    <div class="cpadding1">
                        <span class="icon-help"></span>
                        <h3 class="opensans">Need Assistance?</h3>
                        <p class="size14 grey">Our team is 24/7 at your service to help you with your booking issues or answer any related questions</p>
                        <p class="opensans size30 lblue xslim">1-866-599-6674</p>
                    </div>
                </div><br/>
                
                            
            
            </div>
        </div>
        <!-- END OF container-->
        
    </div>
    <!-- END OF CONTENT -->
    
    </section>

     <?php $this->load->view('common/footer');?>
    
 


    
<script src="<?php echo base_url();?><?php echo base_url();?>assets_/js/common.js"></script> 
   