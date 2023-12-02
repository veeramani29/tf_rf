  <?php $this->load->view('header'); ?>

            <!-- TOP AREA -->
            <div class="top-area show-onload">
                <div class="bg-holder full">
                    <div class="bg-mask"></div>
                    <div class="bg-parallax">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                              <!-- Indicators -->
                              <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                              </ol>

                              <!-- Wrapper for slides -->
                              <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                  <img src="<?php echo base_url(); ?>assets/img/santorini.jpg" alt="" style="width:100%; height:630px;">
                                  
                                </div>
                                <div class="item">
                                  <img src="<?php echo base_url(); ?>assets/img/rome.jpg" alt="" style="width:100%; height:630px;">
                                  
                                </div>
                                <div class="item">
                                  <img src="<?php echo base_url(); ?>assets/img/paris.jpg" alt="" style="width:100%; height:630px;">
                                  
                                </div>
                              </div>

                              <!-- Controls -->
                              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                              </a>
                              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                              </a>
                            </div>


                    </div>
                    <div class="bg-content">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="search-tabs search-tabs-bg mt50">
                                        
                                        <div class="tabbable">

                                            <ul class="nav nav-tabs" id="myTab">
                                            
                                                <li id="tab7"><a href="#transfers" data-toggle="tab"><i class="fa fa-car"></i><span >Transfers</span></a>
                                                </li>
                                              
                                            </ul>

                                            <div class="tab-content ta_b">
                                               
                                                <div class="tab-pane fade active" id="transfers">
                                                    <h2 class="fon_500">“Transfers”</h2>

                                                     <form name="car_frm" id="car_frm" action="<?php echo site_url(); ?>/car/search" method="GET">
                                                    
                                                        <div class="row">
                                                            <div class="col-xs-6 resp_1">
                                                                <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                                    <label>Pick Up</label>
                                                                    <input class="typeahead form-control" id="hotel_origin"  name="hotel_origin" placeholder="Please Enter City or Airport" type="text" />
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 resp_1">
                                                                <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                                    <label>Drop Off</label>
                                                                    <input id="hotel_end"  name="hotel_dest"  class="typeahead form-control" placeholder="Please Enter City or Airport" type="text" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="input-daterange" >
                                                            <div class="row">
                                                                <div class="col-md-3 col-xs-6 resp_3">
                                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                        <label>Pick Up Date</label>
                                                                        <input class="form-control" name="car_start" id="car_start" type="text" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-xs-6 resp_3">
                                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-clock-o input-icon input-icon-highlight"></i>
                                                                        <label>Pick Up Time</label>
                                                                        <input name="car_start_time" id="car_start_time" class="time-pick form-control" value="12:00 AM" type="text" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-xs-6 resp_3 trip_type">
                                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                        <label>Drop Off Date</label>
                                                                        <input name="car_end" id="car_end" class="form-control"  type="text" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-xs-6 resp_3 ">
                                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-clock-o input-icon input-icon-highlight"></i>
                                                                        <label>Drop off Time</label>
                                                                        <input name="car_end_time" id="car_end_time" class="time-pick form-control" value="12:00 AM" type="text" />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                              <div class="row">
                                                                <div class="col-md-3 col-xs-6 resp_3">
                                      
                                          <label for="onway_trip">  <input type="radio" value="1" id="onway_trip" name="trip_type">  One-way only</label>
                                                                </div>
                                                                 <div class="col-md-3 col-xs-6 resp_3">
                                      
                                          <label for="return_trip"> <input checked="" type="radio" value="2" id="return_trip" name="trip_type">  Round trip</label>
                                                                </div>
                                                                </div>

                                                             <div class="row">
                                                            <div id="">
                                                               
                                                                <div class="col-md-10 col-xs-12 pad_0">
                                                                    <div class="col-md-3 col-xs-6">
                                                                        <div class="form-group form-group-lg form-group-select-plus">
                                                                            <label>Adult<small>(18+)</small></label>
                                                                            <div class="form-group form-group-lg ">
                                                                                <select class="form-control " name="adult">
                                                                                    <option value="1">1</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="3">3</option>
                                                                                    <option value="4">4</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-xs-6">
                                                                        <div class="form-group form-group-lg form-group-select-plus">
                                                                            <label>Children<small>(2-17)</small></label>
                                                                            <div class="form-group form-group-lg ">
                                                                                <select class="form-control "  name="child" onchange="activity_show_child_age_info(this.value, '0','car')">
                                                                                    <option value="0">0</option>
                                                                                    <option value="1">1</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="3">3</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="car_child_ages"> 
 
</div>
                                                                </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <button class="btn btn-primary btn-lg" type="submit">Search for Rental Cars</button>
                                                    </form>
                                                </div>
                                              
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END TOP AREA  -->
            <div class="container">


                <div class="col-md-12">
                    <div class="gap"></div>
                    


                
                    <div class="gap active show" id="tab4show">
                        <h2 class="text-left">Top Cars Deals</h2>

                        <div class="row row-wrap">
                            <div class="col-sm-4 resp_28">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/the_journey_home_400x300.jpg" alt="Image Alternative text" title="the journey home" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h4 class="thumb-title">Africa</h4>
                                        <p class="thumb-desc">20% off</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 resp_29">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/upper_lake_in_new_york_central_park_800x600.jpg" alt="Image Alternative text" title="Upper Lake in New York Central Park" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h4 class="thumb-title">USA</h4>
                                        <p class="thumb-desc">10% off</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 resp_30">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/people_on_the_beach_800x600.jpg" alt="Image Alternative text" title="people on the beach" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h4 class="thumb-title">Australia</h4>
                                        <p class="thumb-desc">15% off</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-wrap">
                            <div class="col-sm-4 resp_31">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/the_journey_home_400x300.jpg" alt="Image Alternative text" title="the journey home" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h4 class="thumb-title">Africa</h4>
                                        <p class="thumb-desc">20% off</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 resp_32">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/upper_lake_in_new_york_central_park_800x600.jpg" alt="Image Alternative text" title="Upper Lake in New York Central Park" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h4 class="thumb-title">USA</h4>
                                        <p class="thumb-desc">10% off</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 resp_33">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/people_on_the_beach_800x600.jpg" alt="Image Alternative text" title="people on the beach" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h4 class="thumb-title">Australia</h4>
                                        <p class="thumb-desc">15% off</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    
                   



 


                    </div>

                </div>



                <!----<div class="col-md-3 pad_37">
                    <img src="img/flig1.jpg" height="500">
                </div>---->
            </div>



            <div class="container pad_con">
                <div class="row">
                    <div class="col-sm-3 resp_3">
                        <img class="pri_com" src="<?php echo base_url(); ?>assets/img/price.png">
                        <div>
                            <h4 class="tex_alin fon_500"><a href="#">Best Price Guarantee</a></h4>
                            <p class="tex_alin">Find our lowest price to destinations </p>
                            <p class="tex_alin">worldwide, guaranteed</p>

                        </div>
                    </div>
                    <div class="col-sm-3 resp_3">
                        <img class="pri_com" src="<?php echo base_url(); ?>assets/img/book.png">
                        <div>
                            <h4 class="tex_alin fon_500"><a href="#">Easy Booking</a></h4>
                            <p class="tex_alin">Find our lowest price to destinations </p>
                            <p class="tex_alin">worldwide, guaranteed</p>

                        </div>
                    </div>
                    <div class="col-sm-3 resp_3">
                        <img class="pri_com" src="<?php echo base_url(); ?>assets/img/cust.png">
                        <div>
                            <h4 class="tex_alin fon_500"><a href="#">24/7 Customer Care</a></h4>
                            <p class="tex_alin">Get award-winning service and </p>
                            <p class="tex_alin">special deals by calling +1 361 228 0965</p>

                        </div>
                    </div>
                    <div class="col-sm-3 resp_3">
                        <img class="pri_com" src="<?php echo base_url(); ?>assets/img/like.png">
                        <div>
                            <button type="button" class="btn btn-warning like_but">Like<span style="padding-left: 15px;">100k</span></button>
                            <p class="tex_alin pad_8">People love our offers, you will too!</p>

                        </div>
                    </div>
                </div>
            </div>
      <iframe id='travelstartIframe-6e7b4cfa-c212-4bfd-b3f8-c8a5864352a6' 
    frameBorder='0' 
    scrolling='no' 
    style='margin: 0px; padding: 0px; border: 0px; height: 0px; background-color: #fafafa;'>
</iframe> 
<script type='text/javascript' src='https://www.travelstart.com.ng/resources/js/vendor/jquery.browser-0.0.8.min.js'></script> 
<script type='text/javascript' src='https://www.travelstart.com.ng/resources/js/jquery.ba-postmessage.min.js'></script> 


    <?php $this->load->view('footer'); ?>

<script type="text/javascript">
    $('input[name="trip_type"]:radio').change(function () {
               // var selectedVal = $("#trip_type input:radio:checked").val();
               if($(this).val()==1){
                $('div.trip_type').hide();
               }else{
                 $('div.trip_type').show();
               }
                
                  
            });
</script>

