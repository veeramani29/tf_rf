 <div class="col-md-3">
  <div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#topflightdeals" aria-controls="home" role="tab" data-toggle="tab"><?php echo lang_line('FLIGHT_DEALS');?></a></li>
      <li role="presentation"><a href="#hoteloffers" aria-controls="profile" role="tab" data-toggle="tab"><?php echo lang_line('HOTELOFFERS');?></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="topflightdeals">
        <div class="row tabcarousel_container">
          <div class="carousel_rightindex">           
            <div id="myCarousel" class="carousel slide Promo-Slider">
              <div class="carousel-inner carouselleft_images">
                <?php
                $discounted_flights=$discounted_flights;
                $totdiscflight=count($discounted_flights); if($totdiscflight>0){ 
                  for($df=0;$df<$totdiscflight;$df++){
                    $disc_origin=stripslashes($discounted_flights[$df]['origin']);
                    $disc_origin_city=$this->flight_model->get_airport_cityname($disc_origin);
                    $disc_destination=stripslashes($discounted_flights[$df]['destination']);
                    $disc_destination_city=$this->flight_model->get_airport_cityname($disc_destination);
                    $disc_destination_country=$this->flight_model->get_airportcode_countryname($disc_destination);
                    $disc_price=stripslashes($discounted_flights[$df]['price']);
                    $disc_trip=($discounted_flights[$df]['type']=="R")?"Round Trip":"One Way";
                    $disc_trip_class=($discounted_flights[$df]['type']=="R")?"set3":"set2 one";
                    $disc_each_url=base_url().'flight/discounted_flight/'.$discounted_flights[$df]['id'].'/'.$disc_origin_city.'/'.$disc_destination_city;
                    $now = time(); 
                    $exp_date = strtotime($discounted_flights[$df]['exp_date']);
                    $datediff =$exp_date-$now;
                    $remain_day= floor($datediff/(60*60*24))+1;
                    $discount_img=DISCOUNT_FLIGHT_SMLIMG.$discounted_flights[$df]['small_image'];
                    if($df%2==0){ ?>
                    <div class="item <?php echo ($df==0)?'active':'';?>">
                      <div class="row"> 
                       <?php  } ?>
                       <div class="col-xs-6 col-sm-6 col-md-12">
                        <a href="#" class="thumbnail go-top" data-toggle="modal" data-target="#DealsModal" onclick="show_offer_popup('<?php echo $disc_each_url;?>')">
                          <img class="img-responsive" src="<?=ASSETS?>images/top_flightbg.jpg" alt="Thumb11">
                          <div class="carousel_text">
                            <h3>
                              <?php echo $disc_origin_city." (".$disc_origin.")";?><br />
                              -<br />
                              <?php echo $disc_destination_city." (".$disc_destination.")";?><br />
                              <div class="text-yellow">
                                Starting<br />
                                <?php echo CURR_ICON.$disc_price;?>,-
                              </div>
                            </h3>
                          </div>
                        </a>
                      </div>
                      <?php if($df%2==1){ echo '</div></div>'; } if($totdiscflight%2==1 && $df==($totdiscflight-1)){ echo '</div></div>'; }   } /* if closed*/ ?>
                      <ol class="carousel-indicators">
                        <?php  for($dc=0;$dc<ceil($totdiscflight/2);$dc++){ 
                          $cls=($dc==0)?'active':'';
                          echo '<li data-target="#myCarousel" data-slide-to="'.$dc.'" class="'.$cls.'"></li>';
                        } ?>
                      </ol>     
                      <?php } /* if closed*/ else{
                        echo '<div class="nopost-tabcontent">Not Posted</div>';
                      } ?>
                    </div>
                  </div><!-- End Carousel --> 
                </div><!-- End Well -->
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="hoteloffers">
              <div class="row tabcarousel_container">
                <div class="carousel_rightindex">           
                  <div id="myCarousel2" class="carousel slide Promo-Slider">
                    <div class="carousel-inner carouselleft_images">
                      <?php
                      $discounted_hotels=$discounted_hotels;
                      $totdischotel=count($discounted_hotels); if($totdischotel>0){ 
                        for($df=0;$df<$totdischotel;$df++){
                          $disc_origin=stripslashes($discounted_hotels[$df]['origin']);
                          $disc_origin_city=$this->flight_model->get_airport_cityname($disc_origin);
                          $disc_origin_country=$this->flight_model->get_airportcode_countryname($disc_origin);
                          $disc_price=stripslashes($discounted_hotels[$df]['price']);
                          $disc_each_url=base_url().'flight/discounted_hotels/'.$discounted_hotels[$df]['id'].'/'.$disc_origin_city.'/'.$disc_destination_city;
                          $now = time(); 
                          $exp_date = strtotime($discounted_hotels[$df]['exp_date']);
                          $datediff =$exp_date-$now;
                          $remain_day= floor($datediff/(60*60*24))+1;
                          $discount_img=DISCOUNT_FLIGHT_SMLIMG.$discounted_hotels[$df]['small_image'];
                          if($df%2==0)
                            { ?>
                          <div class="item <?php echo ($df==0)?'active':'';?>">
                            <div class="row"> 
                              <?php  } ?>
                              <div class="col-xs-6 col-sm-6 col-md-12">
                                <a href="#" class="thumbnail go-top" data-toggle="modal" data-target="#DealsModalH" onclick="show__hoffer_popup('<?php echo $disc_each_url;?>')">
                                  <img class="img-responsive" src="<?=ASSETS?>images/top_flightbg.jpg" alt="Thumb11">
                                  <div class="carousel_text">
                                    <h3>
                                      <?php echo $disc_origin_city." (".$disc_origin.")";?><br />
                                      -<br />
                                      <?php echo "Hotel (".$disc_origin_country.")";?><br />
                                      <div class="text-yellow">
                                        Starting<br />
                                        <?php echo CURR_ICON.$disc_price;?>,-
                                      </div>
                                    </h3>
                                  </div>
                                </a>
                              </div>
                              <?php if($df%2==1){ echo '</div></div>'; } if($totdischotel%2==1 && $df==($totdischotel-1)){ echo '</div></div>'; }   } /* if closed*/ ?>
                              <ol class="carousel-indicators">
                                <?php  for($dc=0;$dc<ceil($totdischotel/2);$dc++){ 
                                  $cls=($dc==0)?'active':'';
                                  echo '<li data-target="#myCarousel" data-slide-to="'.$dc.'" class="'.$cls.'"></li>';
                                } ?>
                              </ol>     
                              <?php } /* if closed*/ else{
                                echo '<div class="nopost-tabcontent">Not Posted</div>';
                              } ?>               
                            </div><!-- End Carousel --> 
                          </div><!-- End Well -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>