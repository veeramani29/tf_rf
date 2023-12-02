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
                                            
                                                <!--li id="tab6"><a href="#tab-6" data-toggle="tab"><i class="fa" aria-hidden="true"><img src="<?php echo base_url(); ?>assets/img/yatch.png" style="width:20px; margin-left:-10px;" /></i><span >Cruises</span></a>
                                                </li-->
                                                <li id="tab1"><a href="#tab-2" data-toggle="tab" id="Fli_2"><i class="fa fa-plane"></i> <span >Flights</span></a>
                                                </li>
                                                <li id="tab2" class="active"><a href="#tab-1" data-toggle="tab"><i class="fa fa-bed" aria-hidden="true"></i> <span >Hotels</span></a>
                                                </li>
                                               <!--  <li id="tab4"><a href="#tab-4" data-toggle="tab"><i class="fa fa-car"></i> <span >Cars</span></a>
                                                </li> -->
                                                <li id="tab7"><a href="#transfers" data-toggle="tab"><i class="fa fa-car"></i><span >Transfers</span></a>
                                                </li>
                                                <li id="tab5"><a href="#tab-5" data-toggle="tab"><i class="fa fa-bolt"></i> <span >Activities</span></a>
                                                </li>
                                                <!--li id="tab7"><a href="#tab-7" data-toggle="tab"><i class="fa fa-plane"></i>+<i class="fa fa-bed" aria-hidden="true"></i><span >Flight+Hotel</span></a>
                                                </li-->
                                            </ul>

                                            <div class="tab-content ta_b">
                                                <div class="tab-pane fade active" id="tab-1">
                                                    <h2 class="fon_500"><b class="fon_500">Find & Book Best Hotel Deals</b></h2>
                                                    <form name="hotel_frm" id="hotel_frm" action="<?php echo site_url(); ?>/hotel/search" method="GET">
                                                        <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                            <label>Destination</label>
                                                            <input class="typeahead form-control fon_500" id="hotel_dest" name="cityval"  placeholder="Destination, City, or Hotel Name.." type="text" />
                                                        </div>
                                                        <div >
                                                            <div class="row">
                                                                <div class="col-md-3 col-sm-4 col-xs-6 resp_1">
                                                                    <div class="form-group form-group-lg form-group-icon-left">
                                                                        <i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                        <label>Check-in</label>
                                                                        <input class="form-control datepicker" id="hotel_sd" name="hotel_sd" type="text" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-sm-4 col-xs-6 resp_1">
                                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                        <label>Check-out</label>
                                                                        <input class="form-control datepicker" id="hotel_ed" name="hotel_ed" type="text" />
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="nights_count" id="nights-count" value="">
                                                                <div class="col-md-3 col-sm-4 resp_27">
                                                                    <div class="form-group form-group-lg form-group-select-plus">
                                                                        <label>Rooms</label>
                                                                        <div class="btn-group btn-group-select-num" data-toggle="buttons">
                                                                            <label class="btn btn-primary active" onclick="show_room_info('1');">
                                                                                <input type="radio" name="rooms" value="1" />1</label>
                                                                            <label class="btn btn-primary" onclick="show_room_info('2');">
                                                                                <input type="radio" name="rooms" value="2" />2</label>
                                                                            <label class="btn btn-primary" onclick="show_room_info('3');">
                                                                                <input type="radio" name="rooms" value="3" />3</label>
                                                                            <label class="btn btn-primary" onclick="show_room_info('4');">
                                                                                <input type="radio" name="rooms" value="4" />4</label>
                                                                        </div>
                                                                        <input type="hidden" name="room_count" id="room_count" value="1">
                                                                    </div>
                                                                </div>
                                                                <div style="clear:both;"></div>

                                                                
                                                                <div id="room_info">
                                                                <div class="col-md-2 col-sm-2 pad_left0 ">
                                                                    <p class="room_1">Room 1 :</p> 
                                                                </div>
                                                                <div class="col-md-10 col-sm-10 pad_0" >
                                                                    <div class="col-md-3 col-xs-6">
                                                                        <div class="form-group form-group-lg form-group-select-plus">
                                                                            <label>Adult<small>(18+)</small></label>
                                                                            <div class="form-group form-group-lg ">
                                                                                <select class="form-control " name="hotel_adult[]">
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
                                                                                <select class="form-control " name="hotel_child[]" onChange="show_child_age_info(this.value, '0')">
                                                                                    <option value="0">0</option>
                                                                                    <option value="1">1</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="3">3</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix" id="child_age0">
                                                                        
                                                                    </div>
                                                                </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                        <button class="btn btn-primary btn-lg" type="submit">Search for Hotels</button>
                                                    </form>
                                                </div>
                                                <div class="tab-pane fade in " id="tab-2">
                                                    <h2 class="fon_500">Search and Book Cheap Flights</h2>
                                                    <form>
                                                        <div class="tabbable">
                                                            <ul class="nav nav-pills nav-sm nav-no-br mb10" id="flightChooseTab">
                                                                <li class="active"><a href="#flight-search-1" data-toggle="tab">Round Trip</a>
                                                                </li>
                                                                <li><a href="#flight-search-2" data-toggle="tab">One Way</a>
                                                                </li>
                                                                <li><a href="#flight-search-3" data-toggle="tab">Multiple destinations</a>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content">
                                                                <div class="tab-pane fade in active" id="flight-search-1">
                                                                    <div class="row">
                                                                        <div class="col-xs-6 resp_1">
                                                                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                                                <label>From</label>
                                                                                <input class="typeahead form-control" placeholder="Please Enter City or Airport" type="text" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-6 resp_2">
                                                                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                                                <label>To</label>
                                                                                <input class="typeahead form-control" placeholder="Please Enter City or Airport" type="text" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="input-daterange" data-date-format="M d, D">
                                                                        <div class="row">
                                                                            <div class="col-md-3 col-xs-6 resp_3">
                                                                                <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                                    <label>Departing</label>
                                                                                    <input class="form-control" name="start" type="text" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3 col-xs-6 resp_4">
                                                                                <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                                    <label>Returning</label>
                                                                                    <input class="form-control" name="end" type="text" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2 col-sm-3 col-xs-4 resp_5">
                                                                                <div class="form-group form-group-lg form-group-select-plus">
                                                                                    <label>Adult<small>(18+)</small></label>
                                                                                    <div class="form-group form-group-lg ">
                                                                                        <select class="form-control ">
                                                                                            <option>1</option>
                                                                                            <option>2</option>
                                                                                            <option>3</option>
                                                                                            <option>4</option>
                                                                                            <option>5</option>
                                                                                        </select>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2 col-sm-3 col-xs-4 resp_6">
                                                                                <div class="form-group form-group-lg form-group-select-plus">
                                                                                    <label>Children<small>(2-17)</small></label>
                                                                                    <div class="form-group form-group-lg ">
                                                                                        <select class="form-control ">
                                                                                            <option>0</option>
                                                                                            <option>1</option>
                                                                                            <option>2</option>
                                                                                            <option>3</option>
                                                                                            <option>4</option>
                                                                                            <option>5</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2 col-sm-3 col-xs-4 resp_7">
                                                                                <div class="form-group form-group-lg form-group-select-plus">
                                                                                    <label>Infants<small>(0-2)</small></label>
                                                                                    <div class="form-group form-group-lg ">
                                                                                        <select class="form-control ">
                                                                                            <option>0</option>
                                                                                            <option>1</option>
                                                                                            <option>2</option>
                                                                                            <option>3</option>
                                                                                            <option>4</option>
                                                                                            <option>5</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3 col-sm-3 col-xs-6 resp_8">
                                                                                <div class="form-group form-group-lg form-group-select-plus">
                                                                                    <label>Ticket class</label>
                                                                                    <div class="form-group form-group-lg ">
                                                                                        <select class="form-control ">
                                                                                            <option>Economy</option>
                                                                                            <option>Premium Economy</option>
                                                                                            <option>Business</option>
                                                                                            <option>First Class</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="flight-search-2">
                                                                    <div class="row">
                                                                        <div class="col-xs-6 resp_10">
                                                                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                                                <label>From</label>
                                                                                <input class="typeahead form-control" placeholder="Please Enter City or Airport" type="text" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-6 resp_11">
                                                                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                                                <label>To</label>
                                                                                <input class="typeahead form-control" placeholder="Please Enter City or Airport" type="text" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-sm-3 col-xs-12 resp_12">
                                                                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                                <label>Departing</label>
                                                                                <input class="date-pick form-control" data-date-format="M d, D" type="text" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2 col-sm-3 col-xs-4 resp_13">
                                                                            <div class="form-group form-group-lg form-group-select-plus">
                                                                                <label>Adult<small>(18+)</small></label>
                                                                                <div class="form-group form-group-lg ">
                                                                                    <select class="form-control ">
                                                                                        <option>1</option>
                                                                                        <option>2</option>
                                                                                        <option>3</option>
                                                                                        <option>4</option>
                                                                                        <option>5</option>
                                                                                    </select>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2 col-sm-3 col-xs-4 resp_14">
                                                                            <div class="form-group form-group-lg form-group-select-plus">
                                                                                <label>Children<small>(2-17)</small></label>
                                                                                <div class="form-group form-group-lg ">
                                                                                    <select class="form-control ">
                                                                                        <option>0</option>
                                                                                        <option>1</option>
                                                                                        <option>2</option>
                                                                                        <option>3</option>
                                                                                        <option>4</option>
                                                                                        <option>5</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2 col-sm-3 col-xs-4 resp_15">
                                                                            <div class="form-group form-group-lg form-group-select-plus">
                                                                                <label>Infants<small>(0-2)</small></label>
                                                                                <div class="form-group form-group-lg ">
                                                                                    <select class="form-control ">
                                                                                        <option>0</option>
                                                                                        <option>1</option>
                                                                                        <option>2</option>
                                                                                        <option>3</option>
                                                                                        <option>4</option>
                                                                                        <option>5</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2 col-sm-3 col-xs-6 resp_16">
                                                                            <div class="form-group form-group-lg form-group-select-plus">
                                                                                <label>Ticket class</label>
                                                                                <div class="form-group form-group-lg ">
                                                                                    <select class="form-control ">
                                                                                        <option>Economy</option>
                                                                                        <option>Premium Economy</option>
                                                                                        <option>Business</option>
                                                                                        <option>First Class</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>



                                                                <div class="tab-pane fade" id="flight-search-3">
                                                                    <div class="row">
                                                                        <div class="col-xs-12 resp_27">
                                                                            <button class="btn btn-primary btn-lg bt_m" type="submit">Add more</button>
                                                                        </div>
                                                                        <div class="col-sm-4  col-xs-6 resp_17">
                                                                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                                                <label>From</label>
                                                                                <input class="typeahead form-control" placeholder="Please Enter City or Airport" type="text" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4  col-xs-6 resp_18">
                                                                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                                                <label>To</label>
                                                                                <input class="typeahead form-control" placeholder="Please Enter City or Airport" type="text" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4 col-xs-12 resp_19">
                                                                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                                <label>Departing</label>
                                                                                <input class="date-pick form-control" data-date-format="M d, D" type="text" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4  col-xs-6 resp_20">
                                                                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                                                <label>From</label>
                                                                                <input class="typeahead form-control" placeholder="Please Enter City or Airport" type="text" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4  col-xs-6 resp_21">
                                                                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                                                <label>To</label>
                                                                                <input class="typeahead form-control" placeholder="Please Enter City or Airport" type="text" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4  col-xs-12 resp_22">
                                                                            <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                                <label>Departing</label>
                                                                                <input class="date-pick form-control" data-date-format="M d, D" type="text" />
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-2 col-sm-3 col-xs-4 resp_23">
                                                                            <div class="form-group form-group-lg form-group-select-plus">
                                                                                <label>Adult<small>(18+)</small></label>
                                                                                <div class="form-group form-group-lg ">
                                                                                    <select class="form-control ">
                                                                                        <option>1</option>
                                                                                        <option>2</option>
                                                                                        <option>3</option>
                                                                                        <option>4</option>
                                                                                        <option>5</option>
                                                                                    </select>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2 col-sm-3 col-xs-4 resp_24">
                                                                            <div class="form-group form-group-lg form-group-select-plus">
                                                                                <label>Children<small>(2-17)</small></label>
                                                                                <div class="form-group form-group-lg ">
                                                                                    <select class="form-control ">
                                                                                        <option>0</option>
                                                                                        <option>1</option>
                                                                                        <option>2</option>
                                                                                        <option>3</option>
                                                                                        <option>4</option>
                                                                                        <option>5</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2 col-sm-3 col-xs-4 resp_25">
                                                                            <div class="form-group form-group-lg form-group-select-plus">
                                                                                <label>Infants<small>(0-2)</small></label>
                                                                                <div class="form-group form-group-lg ">
                                                                                    <select class="form-control ">
                                                                                        <option>0</option>
                                                                                        <option>1</option>
                                                                                        <option>2</option>
                                                                                        <option>3</option>
                                                                                        <option>4</option>
                                                                                        <option>5</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2 col-sm-3 col-xs-6 resp_26">
                                                                            <div class="form-group form-group-lg form-group-select-plus">
                                                                                <label>Ticket class</label>
                                                                                <div class="form-group form-group-lg ">
                                                                                    <select class="form-control ">
                                                                                        <option>Economy</option>
                                                                                        <option>Premium Economy</option>
                                                                                        <option>Business</option>
                                                                                        <option>First Class</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-primary btn-lg" type="submit">Search for Flights</button>
                                                    </form>
                                                </div>
                                                
                                               <!--  <div class="tab-pane fade" id="tab-4">
                                                    <h2 class="fon_500">“Search, Compare and Book Car Hire”</h2>

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
                                                </div> -->
                                                <div class="tab-pane fade" id="transfers">
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
                                                <div class="tab-pane fade" id="tab-5">
                                                    <h2 class="fon_500">Search for Activities</h2>
                                                    <form name="activity_frm" id="activity_frm" action="<?php echo site_url(); ?>/activity/search" method="GET">
                                                        <div class="input-daterange" data-date-format="M d, D">
                                                            <div class="row">
                                                                <div class="col-sm-6 col-xs-12 resp_27">
                                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                                        <label>Destination</label>

                                                                        <input class="typeahead form-control fon_500 ui-autocomplete-input" id="sigthseen_dest" name="cityval" placeholder="City, Airport, Point of Interest or U.S. Zip Code" type="text" autocomplete="off">

                                                                       
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-xs-6 resp_1">
                                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                        <label>From</label>
                                                                      

                                                                        <input class="form-control datepicker" name="sigthseen_start" id="sigthseen_start" type="text" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-xs-6 resp_1">
                                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                        <label>To</label>
                                                                        <input class="form-control datepicker" name="sigthseen_end" id="sigthseen_end" type="text" />

                                                                     
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                            <div id="">
                                                               
                                                                <div class="col-md-10 pad_0">
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
                                                                            <label>Children<small>(1-17)</small></label>
                                                                            <div class="form-group form-group-lg ">
                                                                                <select class="form-control "  name="child" onchange="activity_show_child_age_info(this.value, '0','activity')">
                                                                                    <option value="0">0</option>
                                                                                    <option value="1">1</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="3">3</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="activity_child_ages"> 
 
</div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-primary btn-lg" type="submit">Search for Activities</button>
                                                    </form>
                                                </div>
                                                <div class="tab-pane fade" id="tab-6">
                                                    <h2 class="fon_500">Search for Cruises</h2>
                                                    <form>
                                                        <div class="input-daterange" data-date-format="M d, D">
                                                            <div class="row">
                                                                <div class="col-xs-6 resp_1">
                                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                        <label>Departure Date</label>
                                                                        <input class="form-control" name="start" type="text" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 resp_1">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Number Of Nights</label>
                                                                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Number Of Nights" style="height:46px;">
                                                                    </div>
                                                                </div>
                                                                <div style="clear:both;"></div>
                                                                <div class="col-xs-6 resp_1">
                                                                    <div class="form-group form-group-lg form-group-select-plus">
                                                                        <label>Cruise Line</label>
                                                                        <div class="form-group form-group-lg ">
                                                                            <select class="form-control ">
                                                                                <option>Select Cruise Line</option>
                                                                                <option>2</option>
                                                                                <option>3</option>
                                                                                <option>4</option>
                                                                                <option>5</option>
                                                                            </select>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 resp_1">
                                                                    <div class="form-group form-group-lg form-group-select-plus">
                                                                        <label>Cruise Ship</label>
                                                                        <div class="form-group form-group-lg ">
                                                                            <select class="form-control ">
                                                                                <option>Select Cruise Line</option>
                                                                                <option>2</option>
                                                                                <option>3</option>
                                                                                <option>4</option>
                                                                                <option>5</option>
                                                                            </select>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="col-xs-6 resp_1">
                                                                    <div class="form-group form-group-lg form-group-select-plus">
                                                                        <label>City Nearest To Passenger Residence</label>
                                                                        <div class="form-group form-group-lg ">
                                                                            <select class="form-control ">
                                                                                <option>Please select Cruise</option>
                                                                                <option>2</option>
                                                                                <option>3</option>
                                                                                <option>4</option>
                                                                                <option>5</option>
                                                                            </select>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="col-xs-6 resp_1">
                                                                    <div class="form-group form-group-lg form-group-select-plus">
                                                                        <label>Mode Of Transportation</label>
                                                                        <div class="form-group form-group-lg ">
                                                                            <select class="form-control ">
                                                                                <option>Cruise</option>
                                                                                <option>2</option>
                                                                                <option>3</option>
                                                                                <option>4</option>
                                                                                <option>5</option>
                                                                            </select>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="clearfix">&nbsp;</div>
                                                                <div class="col-xs-12 resp_27">
                                                                    <p style="font-size:17px;"><b>Number Of Passengers</b></p>
                                                                </div>

                                                                <div class="col-md-3 col-xs-4 resp_30">
                                                                    <div class="form-group form-group-lg form-group-select-plus">
                                                                        <label>Adults</label>
                                                                        <div class="form-group form-group-lg ">
                                                                            <select class="form-control ">
                                                                                <option>1</option>
                                                                                <option>2</option>
                                                                                <option>3</option>
                                                                                <option>4</option>
                                                                                <option>5</option>
                                                                            </select>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-xs-4 resp_30">
                                                                    <div class="form-group form-group-lg form-group-select-plus">
                                                                        <label>Children</label>
                                                                        <div class="form-group form-group-lg ">
                                                                            <select class="form-control ">
                                                                                <option>1</option>
                                                                                <option>2</option>
                                                                                <option>3</option>
                                                                                <option>4</option>
                                                                                <option>5</option>
                                                                            </select>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-xs-4 resp_30">
                                                                    <div class="form-group form-group-lg form-group-select-plus">
                                                                        <label>Seniors</label>
                                                                        <div class="form-group form-group-lg ">
                                                                            <select class="form-control ">
                                                                                <option>1</option>
                                                                                <option>2</option>
                                                                                <option>3</option>
                                                                                <option>4</option>
                                                                                <option>5</option>
                                                                            </select>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div style="clear:both;"></div>







                                                            </div>
                                                        </div>
                                                        <button class="btn btn-primary btn-lg" type="submit">Search for Activities</button>
                                                    </form>
                                                </div>
                                
                                                
                                                <div class="tab-pane fade" id="tab-7">
                                                    <h2 class="fon_500">Search for Flight+Hotel</h2>
                                                    <form name="hotel_frm_" id="hotel_frm_" action="http://www.ajtravellabs.com/dev/goldenedge/index.php/activity/search" method="GET">
                                                        <div class="input-daterange" data-date-format="M d, D">
                                                            <div class="row">
                                                                <div class="col-md-6 col-xs-6 resp_27">
                                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                                        <label>Origin</label>

                                                                        <input class="typeahead form-control fon_500 ui-autocomplete-input" id="sigthseen_dest_" name="cityval" placeholder="City, Airport, Point of Interest or U.S. Zip Code" type="text" autocomplete="off">

                                                                       
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-xs-6 resp_27">
                                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                                        <label>Destination</label>

                                                                        <input class="typeahead form-control fon_500 ui-autocomplete-input" id="sigthseen_dest__" name="cityval" placeholder="City, Airport, Point of Interest or U.S. Zip Code" type="text" autocomplete="off">

                                                                       
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-xs-6 resp_1">
                                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                        <label>From</label>
                                                                      

                                                                        <input class="form-control datepicker" name="sigthseen_start" id="sigthseen_start_" type="text">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-xs-6 resp_1">
                                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                        <label>To</label>
                                                                        <input class="form-control datepicker" name="sigthseen_end" id="sigthseen_end_" type="text">

                                                                     
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-xs-12 pad_0">
                                                                    <div class="col-md-2 col-xs-4" style="padding-right:0px;">
                                                                        <div class="form-group form-group-lg form-group-select-plus">
                                                                            <label>Rooms</label>
                                                                            <div class="form-group form-group-lg ">
                                                                                <select class="form-control " name="child" onchange="activity_show_child_age_info(this.value, '0')" style="padding-right:0px;">
                                                                                    <option value="0">0</option>
                                                                                    <option value="1">1</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="3">3</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-5 col-xs-4">
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
                                                                    <div class="col-md-5 col-xs-4">
                                                                        <div class="form-group form-group-lg form-group-select-plus">
                                                                            <label>Children<small>(2-17)</small></label>
                                                                            <div class="form-group form-group-lg ">
                                                                                <select class="form-control " name="child" onchange="activity_show_child_age_info(this.value, '0')">
                                                                                    <option value="0">0</option>
                                                                                    <option value="1">1</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="3">3</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div style="clear:both;"></div>
                                                                <div class="col-md-3 col-xs-4 checkbox" style="padding-left: 38px;">
                                                                   <label>
                                                                      <input type="checkbox"> Direct flights only
                                                                   </label>
                                                                </div>
                                                                 <div class="col-md-5 col-xs-8 checkbox" style="padding-left: 38px;">
                                                                   <label>
                                                                      <input type="checkbox"> I only need a hotel for part of my stay
                                                                   </label>
                                                                </div>
                                                                <div style="clear:both;"></div>
                                                                <div class="col-md-3 col-xs-8">
                                                                        <div class="form-group form-group-lg form-group-select-plus">
                                                                            <div class="form-group form-group-lg ">
                                                                                <select class="form-control ">
                                                                                    <option>First Class</option>
                                                                                    <option>Business</option>
                                                                                    <option>Economy</option>
                                                                                    <option>4</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            </div>

                                                            
                                                                
                                                            
                                                        <button class="btn btn-primary btn-lg" type="submit">Search for Flight+Hotel</button>
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
                    <div class="gap" id="tab2show">
                        <h2 class="text-left">Top Flight Deals</h2>

                        <div class="row row-wrap">
                            <div class="col-md-4 resp_28">
                                <div class="thumb">
                                    <header class="thumb-header"><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
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
                            <div class="col-md-4 resp_29">
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
                            <div class="col-md-4 resp_30">
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
                            <div class="col-md-4 resp_31">
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
                            <div class="col-md-4 resp_32">
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
                            <div class="col-md-4 resp_33">
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


                    <div class="gap" id="tab1show" class="active">
                        <h2 class="text-left">Top Hotel Deals</h2>
                        <div class="row row-wrap">
                            <div class="col-sm-4 resp_28">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/hotel1.jpg" alt="Image Alternative text" title="the journey home" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h4 class="thumb-title">Africa</h4>
                                        <p class="thumb-desc">Ut blandit pharetra suspendisse montes libero eleifend bibendum</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 resp_29">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/hotel2.jpg" alt="Image Alternative text" title="Upper Lake in New York Central Park" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h4 class="thumb-title">USA</h4>
                                        <p class="thumb-desc">Cursus faucibus egestas rutrum mauris vulputate consequat ante</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 resp_30">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/hotel3.jpg" alt="Image Alternative text" title="people on the beach" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h4 class="thumb-title">Australia</h4>
                                        <p class="thumb-desc">Senectus hendrerit torquent lorem scelerisque quam a curae</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row row-wrap">
                            <div class="col-sm-4 resp_31">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/hotel1.jpg" alt="Image Alternative text" title="the journey home" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h4 class="thumb-title">Africa</h4>
                                        <p class="thumb-desc">Ut blandit pharetra suspendisse montes libero eleifend bibendum</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 resp_32">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/hotel2.jpg" alt="Image Alternative text" title="Upper Lake in New York Central Park" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h4 class="thumb-title">USA</h4>
                                        <p class="thumb-desc">Cursus faucibus egestas rutrum mauris vulputate consequat ante</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 resp_33">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/hotel3.jpg" alt="Image Alternative text" title="people on the beach" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h4 class="thumb-title">Australia</h4>
                                        <p class="thumb-desc">Senectus hendrerit torquent lorem scelerisque quam a curae</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="gap" id="tab3show">
                        <h2 class="text-left">Top Rentals Deals</h2>

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
                    <div class="gap" id="tab4show">
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
                    <div class="gap" id="tab5show">
                        <h2 class="text-left">Top Activities Deals</h2>

                        <div class="row row-wrap">
                            <div class="col-sm-4 resp_28">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/sight1.jpg" alt="Image Alternative text" title="the journey home" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
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
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/sight2.jpg" alt="Image Alternative text" title="Upper Lake in New York Central Park" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
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
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/sight3.jpg" alt="Image Alternative text" title="people on the beach" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
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
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/sight4.jpg" alt="Image Alternative text" title="the journey home" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
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
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/sight5.jpg" alt="Image Alternative text" title="Upper Lake in New York Central Park" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
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
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/sight6.jpg" alt="Image Alternative text" title="people on the beach" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
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
                    <div class="gap" id="tab6show">
                        <h2 class="text-left">Top Cruises Deals</h2>
                        <div class="row row-wrap">
                            <div class="col-sm-4 resp_28">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/11.jpg" alt="Image Alternative text" title="the journey home" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
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
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/22.jpg" alt="Image Alternative text" title="Upper Lake in New York Central Park" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
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
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/33.jpg" alt="Image Alternative text" title="people on the beach" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h4 class="thumb-title">Australia</h4>
                                        <p class="thumb-desc">15% off</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h2 class="text-left">Top Packages Deals</h2>
                        <div class="row row-wrap">
                            <div class="col-sm-4 resp_28">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/11.jpg" alt="Image Alternative text" title="the journey home" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
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
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/22.jpg" alt="Image Alternative text" title="Upper Lake in New York Central Park" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
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
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/33.jpg" alt="Image Alternative text" title="people on the beach" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
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
                    <div class="gap" id="tab7show">
                        <h2 class="text-left">Top Packages Deals</h2>
                        <div class="row row-wrap">
                            <div class="col-sm-4 resp_31">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/3861.jpg" alt="Image Alternative text" title="the journey home" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h4 class="thumb-title">Australia</h4>
                                        <p class="thumb-desc">20% off</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 resp_32">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/3876.jpg" alt="Image Alternative text" title="Upper Lake in New York Central Park" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h4 class="thumb-title">Hawaii</h4>
                                        <p class="thumb-desc">10% off</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 resp_33">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/7357.jpg" alt="Image Alternative text" title="people on the beach" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h4 class="thumb-title">Mexico</h4>
                                        <p class="thumb-desc">15% off</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-wrap">
                            <div class="col-sm-4 resp_28">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/3861.jpg" alt="Image Alternative text" title="the journey home" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h4 class="thumb-title">Caribbean</h4>
                                        <p class="thumb-desc">20% off</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 resp_29">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/3876.jpg" alt="Image Alternative text" title="Upper Lake in New York Central Park" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h4 class="thumb-title">Africa</h4>
                                        <p class="thumb-desc">10% off</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 resp_30">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/7357.jpg" alt="Image Alternative text" title="people on the beach" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h4 class="thumb-title">Asia</h4>
                                        <p class="thumb-desc">15% off</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-wrap">
                            <div class="col-sm-4 resp_28">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/3861.jpg" alt="Image Alternative text" title="the journey home" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h4 class="thumb-title">Europe</h4>
                                        <p class="thumb-desc">20% off</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 resp_29">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/3876.jpg" alt="Image Alternative text" title="Upper Lake in New York Central Park" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h4 class="thumb-title">United Arab Emirates</h4>
                                        <p class="thumb-desc">10% off</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 resp_30">
                                <div class="thumb">
                                    <header class="thumb-header">
                                        <a class="hover-img curved" href="#">
                                            <img class="wid_100" src="<?php echo base_url(); ?>assets/img/7357.jpg" alt="Image Alternative text" title="people on the beach" /><i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                                        </a>
                                    </header>
                                    <div class="thumb-caption">
                                        <h4 class="thumb-title">Australia</h4>
                                        <p class="thumb-desc">15% off</p>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!---<div class="col-md-12 loc_pad">
                           <i class="fa fa-map-marker input-icon loc_img"></i>
                           <p class="pull-left pad_left10">Location: <span> Sydney | Gold Coast | Melbourne</span></p>
                        </div>
                        <div class="col-md-12 pad_0">
                            <p class="pac_1day">Day 1 Arrive Sydney (B)</p>
                        </div>
                        <div class="col-md-12 pad_bor">
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>Arrive Sydney and transfer to your hotel. Freshen up and spend the evening exploring the area around your hotel.</p>
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>Overnight in Sydney.</p>
                        </div>
                        <div class="col-md-12 pad_0">
                            <p class="pac_1day">Day 2 Sydney (B, D)</p>
                        </div>
                        <div class="col-md-12 pad_bor">
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>After a buffet breakfast at your hotel, we take you on a city tour of Sydney.</p>
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>See Opera House from the Harbour Bridge, the Rocks, Darling Harbour and the Sydney Tower (No return transfer).</p>
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>In the evening, enjoy Sydney Showboat cruise. This showboat is an authentic replica of the paddle wheelers that cruised the Sydney Harbour in the 1800s.</p>
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>Savor a delicious Indian dinner on board with an entertaining Cabaret Show by the Sydney Show Boat Follies. (No transfers)</p>
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>Overnight in Sydney.</p>
                        </div>


                        <div class="col-md-12 pad_0">
                            <p class="pac_1day">Day 3 Sydney (B)</p>
                        </div>
                        <div class="col-md-12 pad_bor">
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>After breakfast, we take you to full day Blue Mountain Tour with Wildlife Park.</p>
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>Visit the Three Sisters, the famous Rock Formation and one of the Blue Mountains’ most famous sights. Later, return to your hotel in Sydney.</p>
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>Overnight in Sydney.</p>
                            
                        </div>


                        <div class="col-md-12 pad_0">
                            <p class="pac_1day">Day 4 Gold Coast (B)</p>
                        </div>
                        <div class="col-md-12 pad_bor">
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>Today you will be transferred to the Airport for flight to Gold Coast.</p>
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>Upon arrival, you will be transferred to your hotel.</p>
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>The evening is free to enjoy the beautiful beaches of Gold Coast.</p>
                           <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>Overnight in Gold Coast.</p>
                            
                        </div>

                        <div class="col-md-12 pad_0">
                            <p class="pac_1day">Day 5 Gold Coast (B)</p>
                        </div>
                        <div class="col-md-12 pad_bor">
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>Today Morning after breakfast, proceed for a full day tour to visit Movie World also called ‘Hollywood on the Gold Coast’.</p>
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>It is a fabulous extension of a fully operational movie studio.</p>
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>Overnight in Gold Coast.</p>
                            
                        </div>

                        <div class="col-md-12 pad_0">
                            <p class="pac_1day">Day 6 Gold Coast (B)</p>
                        </div>
                        <div class="col-md-12 pad_bor">
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>Today, visit Sea World and admire the Marine Life, Roller Coaster and much more.</p>
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>Overnight in Gold Coast.</p>
                            
                        </div>

                        <div class="col-md-12 pad_0">
                            <p class="pac_1day">Day 7 Gold Coast – Melbourne (B)</p>
                        </div>
                        <div class="col-md-12 pad_bor">
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>You will be transferred to the Airport for flight to Melbourne. Arrive at Melbourne International Airport and transfer to your hotel. Evening is at Leisure.</p>
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>Overnight in Melbourne.</p>
                            
                        </div>

                        <div class="col-md-12 pad_0">
                            <p class="pac_1day">Day 8 Melbourne (B)</p>
                        </div>
                        <div class="col-md-12 pad_bor">
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>After breakfast, we set off on a tour of the city, see the Town Hall, Bourke Street Mall, St Paul’s Cathedral, Chinatown, Parliament House and the Princess Theater.</p>
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>Visit Fitzroy Gardens and see the Legendary Captain Cook’s Cottage. (No transfers)</p>
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>Overnight in Melbourne.</p>
                            
                        </div>

                        <div class="col-md-12 pad_0">
                            <p class="pac_1day">Day 9 Melbourne (B)</p>
                        </div>
                        <div class="col-md-12 pad_bor">
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>After a delicious buffet breakfast, we set off to great Ocean Road.</p>
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>Discover the breath-taking coastline of south-west Victoria, Australia.</p>
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>See the worldfamous Twelve Apostles, the Otways Rainforest, Bells Beach on the Surf Coast, and the Great Ocean Road itself.</p>
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>Overnight in Melbourne.</p>
                            
                        </div>

                        <div class="col-md-12 pad_0">
                            <p class="pac_1day">Day 10 Depart Melbourne (B)</p>
                        </div>
                        <div class="col-md-12 pad_bor">
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>This Morning, proceed to the Airport for your flight back home.</p>
                            
                        </div>

                        <div class="col-md-12 pad_0">
                            <p class="pac_1day pac_2day">Inclusions</p>
                        </div>
                        <div class="col-md-12 pad_bor12 ">
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>11 night’s accommodation with daily breakfast (except for day on arrival)</p>
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>Sightseeing as mentioned above.</p>
                            <p class="pad_le24"><i class="fa fa-check tick" aria-hidden="true"></i>Transfers as mentioned above.</p>
                            
                        </div>
                         <div class="col-md-12 pad_0">
                            <p class="pac_1day pac_3day">Exclusions</p>
                        </div>
                        <div class="col-md-12 pad_bor13 ">
                            <ul>
                                <li><i class="fa fa-times-circle star_pac" aria-hidden="true"></i>Airfare, Airline & Airport Taxes</li>
                                <li><i class="fa fa-times-circle star_pac" aria-hidden="true"></i>Visa Charges.</li>
                                <li><i class="fa fa-times-circle star_pac" aria-hidden="true"></i>Expenses of Personal nature.</li>
                                <li><i class="fa fa-times-circle star_pac" aria-hidden="true"></i>Meals not mentioned above.</li>
                            </ul>
                            <ul>
                                <li><i class="fa fa-times-circle star_pac" aria-hidden="true"></i>Airfare, Airline & Airport Taxes</li>
                                <li><i class="fa fa-times-circle star_pac" aria-hidden="true"></i>Visa Charges.</li>
                                <li><i class="fa fa-times-circle star_pac" aria-hidden="true"></i>Expenses of Personal nature.</li>
                                <li><i class="fa fa-times-circle star_pac" aria-hidden="true"></i>Meals not mentioned above.</li>
                            </ul>
                        </div>--->



 


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

