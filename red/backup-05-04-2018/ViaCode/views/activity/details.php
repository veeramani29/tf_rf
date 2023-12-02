<!DOCTYPE html>
<html>
    <head>
        <title><?php echo Site_Title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
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
                    <form name="chk_price" id="act_chk_price" method="POST" action="<?php echo site_url(); ?>/activity/pre_booking">
                    <div class="col-md-12 hotel-item"  style="padding-top:15px; padding-bottom:15px;min-height: auto;margin-bottom: 30px;">
                        <div class="col-md-12" id="act_error" style="color:red;margin-bottom: 10px;">
                            
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Check out</label>
                                <input type="text" name="act_date" id="act_date" class="form-control" placeholder="Date" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Adult</label> 
                                <select class="form-control" name="act_adult" id="act_adult">
                                    <?php for($i=1;$i<=$details->MaxPax;$i++){ ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <?php if($details->OnlyForAdult == 'false'){ ?>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Child</label>
                                <select class="form-control" name="act_child" id="act_child" onchange="showActChildAge();" required>
                                    <?php for($i=0;$i<$details->MaxPax;$i++){ ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div id="act_child_age">
                                
                            </div>
                        </div>
                        <?php } else { ?>
                        <input type="hidden" name="act_child" id="act_child" value="">
                        <?php } ?>
                        <?php
                            $tourId = array();
                            if($tourList != ''){
                                //print_r($tourList);die;
                                foreach($tourList as $tid){
                                    $tourId[] = $tid->TourId;
                                }
                                $tourIds = implode(',',$tourId);
                            } else {
                                $tourIds = '';
                            }
                        ?>
                        <input type="hidden" name="tour_list" id="tour_list" value="<?php echo $tourIds; ?>">
                        <input type="hidden" name="act_id" id="act_id" value="<?php echo $details->ActivityID; ?>">
                        <div class="col-md-2" style="text-align:center;">
                            <div class="form-group">
                                <label>Gross Amount</label><br />
                                <span id="act_curr">PHP</span> <span id="gross_amount">0</span>
                            </div>
                        </div>
                        <div class="col-md-2" style="text-align:center;">
<!--                            <a href="javascript:void(0);" onclick="checkPriceOfActivity('<?php echo $details->ActivityID; ?>');" class="awe-btn" >Check Price</a>-->
                            <span id="act_loader" style="display:none;"><img src="<?php echo base_url(); ?>assets/images/small_loader.gif"></span><button name="chk_price" id="sub_act_price" onclick="return checkPriceOfActivity();" class="awe-btn">Check Price</button>
                        </div>
                    </div>
                    </form>
                    <div col-md-12>
                        <div class="product-detail__info">
                            <div class="product-title">
                                    <h2><?php echo $details->ActivityName; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product-detail__info">
                            
                            <div class="con-location-city-name" style="margin-top: 10px;">
                                <?php 
                                    $advanceBooking = $details->AdvancePurchasePeriod.' days';
                                ?>
                                <p><span style="font-weight: bold;">Advance Booking Period : </span><span> <?php echo $advanceBooking; ?></span></p>

                            </div>
                            <hr style="margin: 0px;"/>
                            <div class="con-location-city-name" >
                                <?php 
                                    $fromDateArr = explode('T',$details->TravelValidFrom);
                                    $toDateArr = explode('T',$details->TravelValidTo);
                                ?>
                                <p><span style="font-weight: bold;">Travel Period : </span><span><?php echo $fromDateArr[0];  ?> to <?php echo $toDateArr[0];  ?></span></p>
                            </div>

                            <div class="con-location-city-name" >
                                <p><span style="font-weight: bold;">Min Pax : </span><span><?php echo $details->MinPax;  ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="font-weight: bold;">Max Pax : </span><span><?php echo $details->MaxPax;  ?></span></p>
                            </div>
                            <?php if($details->OnlyForAdult == 'true'){ ?>
                            <div class="con-location-city-name" >
                                <p><span style="font-weight: bold;">Only For Adults</span></p>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div id="myCarousel" class="carousel slide" id="carousel-example-generic" data-ride="carousel">
                            <div class="carousel-inner">
                            <?php 
                                if($tourList != ''){
                                    foreach($tourList as $list){
                                        //echo $list->TourId;die;
                                        $images = $this->Activity_Model->getTourImagesOnId($list->TourId);
                                        //print_r($images);die;
                                        if($images != ''){
                                            $i = 0;
                                            foreach($images as $image){
                            ?>
                                            <div class="item <?php echo($i==0?'active':''); ?>">
                                                <img src="<?php echo $image->imageFileName; ?>" alt="">
                                            </div>
                            <?php
                                                $i++;
                                            }
                                        } else {
                            ?>
                                            <div class="item <?php echo($i==0?'active':''); ?>">
                                                <img src="<?php echo base_url(); ?>assets/images/no_image.png" alt="">
                                            </div>
                            <?php
                                        }
                                    }
                                } else {
                            ?>
                                    <div class="item <?php echo($i==0?'active':''); ?>">
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
                                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Inclusions</a></li>
                                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Important Notes</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="home" style="overflow-x:auto;">
                                    <div class="col-md-12" style="margin-top:20px;margin-bottom:50px;">
                                        <?php 
                                            if($tourList != ''){
                                                foreach($tourList as $list){
                                                    $descs = $this->Activity_Model->getTourDescOnId($list->TourId);
                                                    echo $descs->TourDescription;
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="profile">
                                    <div class="col-md-12" style="margin-top:20px;margin-bottom:50px;">
                                        <?php 
                                            if($tourList != ''){
                                                foreach($tourList as $list){
                                                    $terms = $this->Activity_Model->getTourTermsOnId($list->TourId);
                                                    echo $terms->ImportantNotes;
                                                }
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
        <div style="text-align:center;">
            <button name="act_continue" id="act_continue" onclick="proccedToBookActivity()" class="awe-btn" disabled>Book Now</button>
        </div>
        <!--######################### FOOTER STARTS HERE #################################################################--->
        <?php $this->load->view('footer'); ?>
        <!--######################### FOOTER ENDS HERE #################################################################--->
    </body>
    <!--################### JS FILES STARTS ################################################-->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/common.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
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