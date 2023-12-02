<!DOCTYPE html>
<!--[if IE 8]>          <html class="ie ie8"> <![endif]-->
<!--[if IE 9]>          <html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->  <html> <!--<![endif]-->
    <head>
    <title><?php echo Site_Title; ?></title>
    <meta charset="utf-8">
    <meta name="keywords" content="Redtag Travels" />
    <meta name="description" content="Redtag Travels">
    <meta name="author" content="Redtag Travels">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Theme Styles -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
    <link href="<?php echo base_url(); ?>assets/css/styles.css" type="text/css" rel="stylesheet" media="all">
    <link id="main-style" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/search.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/responsive.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/hotel-style12.css">
    </head>
    <body>
        <!--########################### HEADER STARTS HERE ###############################################################--->
        <?php $this->load->view('header'); ?>
        <!--############################ HEADER ENDS HERE ##############################################################--->
<div class="container" >
            <div class="col-md-12">
                <div class="col-md-12 sort-by-section" style="padding:15px 15px 15px 15px; margin-top:10px;margin-bottom:15px; float:left;">
                    <h4 style="font-size: 15px;color: rgb(119, 118, 118);"><span style="font-size:18px;font-family: georgia; font-weight: 700px;color:#545454;"><?php echo $searchData['dest_city']; ?></span>&nbsp;, &nbsp;&nbsp;
                        <span style="font-size:18px;font-family: georgia; font-size: 17px;">&nbsp;&nbsp;&nbsp;&nbsp;Adults : <?php echo $searchData['adult_count']; ?>&nbsp;&nbsp;&nbsp;&nbsp;Child : <?php echo $searchData['child_count']; ?>&nbsp;&nbsp;&nbsp;&nbsp;Nights : <?php echo $searchData['nights']; ?>
                        
                        <span style="float:right;font-size:18px;font-family: georgia; font-size: 17px;"><?php echo date('D d, M, Y', strtotime($searchData['cin'])) . ' &nbsp;&nbsp;To&nbsp;&nbsp; ' . date('D d, M, Y', strtotime($searchData['cout'])); ?></span>
                        
                    </h4>
                </div>
            </div>
        </div>

        <section id="content" style="padding-top:0px;">
            <div class="container">
                <div id="main">
                    <div class="row">
                        <div class="col-sm-4 col-md-3">
                            <h4 class="search-results-title"><i class="soap-icon-search"></i><b><span id="count_progress"></span></b><span id="flight_found" style="display:none;"> Hotels Found.</span><img src="<?php echo base_url(); ?>assets/images/small_loader.gif" id="small_progress"></h4>
                            <div class="toggle-container filters-container">

                                <div class="panel style1 arrow-right ">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#modify-search-panel" class="collapsed">Modify Search</a>
                                    </h4>
                                    <div id="modify-search-panel" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <form method="post">
                                                <div class="form-group">
                                                    <label>destination</label>
                                                    <input type="text" class="input-text full-width" placeholder="" value="Paris" />
                                                </div>
                                                <div class="form-group">
                                                    <label>check in</label>
                                                    <div class="datepicker-wrap">
                                                        <input type="text" class="input-text full-width" placeholder="mm/dd/yy" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>check out</label>
                                                    <div class="datepicker-wrap">
                                                        <input type="text" class="input-text full-width" placeholder="mm/dd/yy" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Rooms</label>
                                                    <select class="form-control">
							  <option>1</option>
							  <option>2</option>
							  <option>3</option>
							  <option>4</option>
							  <option>5</option>
						    </select>
                                                </div>
                                                <div class="col-md-12" style="padding: 4px;border: 1px solid #f5f5f5;margin-bottom: 10px;">
                                                	<p style="text-align:center;">Room1</p>
                                                	<div class="col-md-6" style="padding-left:0px;" >
                                                		<div class="form-group">
		                                                    <label>Adults</label>
		                                                    <select class="form-control">
									  <option>1</option>
									  <option>2</option>
									  <option>3</option>
									  <option>4</option>
									  <option>5</option>
								    </select>
		                                                </div>
                                                	</div>
                                                	<div class="col-md-6" style="padding-left:0px;" >
                                                		<div class="form-group">
		                                                    <label>Child</label>
		                                                    <select class="form-control">
									  <option>1</option>
									  <option>2</option>
									  <option>3</option>
									  <option>4</option>
									  <option>5</option>
								    </select>
		                                                </div>
                                                	</div>
                                                	<div class="col-md-4" style="padding-left:0px">
                                                		<div class="form-group">
		                                                    <label>Age1</label>
		                                                    <select class="form-control">
									  <option>1</option>
									  <option>2</option>
									  <option>3</option>
									  <option>4</option>
									  <option>5</option>
								    </select>
		                                                </div>
                                                	</div>
                                                	<div class="col-md-4" style="padding-left:0px">
                                                		<div class="form-group">
		                                                    <label>Age2</label>
		                                                    <select class="form-control">
									  <option>1</option>
									  <option>2</option>
									  <option>3</option>
									  <option>4</option>
									  <option>5</option>
								    </select>
		                                                </div>
                                                	</div>
                                                	<div class="col-md-4" style="padding-left:0px">
                                                		<div class="form-group">
		                                                    <label>Age3</label>
		                                                    <select class="form-control">
									  <option>1</option>
									  <option>2</option>
									  <option>3</option>
									  <option>4</option>
									  <option>5</option>
								    </select>
		                                                </div>
                                                	</div>
                                                	
                                                </div>
                                                <br />
                                                <a href="http://www.redtagtravels.com/agent/index.php/hotel/details/1/2" class="awe-btn" style="margin-left: 48px;">Search again</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#price-filter" class="collapsed">Price</a>
                                    </h4>
                                    <div id="price-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <span id="priceSliderOutput" class="pric"></span>
                                            <div class="pr_sl">
                                                <div id="priceSlider" style="width:175px">

                                                </div>
                                                <input type="hidden" name="minPrice" id="minPrice" class="autoSubmit"  />
                                                <input type="hidden" name="maxPrice" id="maxPrice" class="autoSubmit"  />
                                            </div>
                                            <div class="clearer"></div>
                                        </div><!-- end content -->
                                    </div>
                                </div>

                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#name-filter" class="collapsed">Hotel Name</a>
                                    </h4>
                                    <div id="name-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <input type="text" id="hotelName" name="hotel_name" class="form-control" placeholder="Hotel Name">
                                            <div class="clearer"></div>
                                        </div><!-- end content -->
                                    </div>
                                </div>

                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#rating-filter" class="collapsed">Star Rating</a>
                                    </h4>
                                    <div id="rating-filter" class="panel-collapse collapse filters-container">
                                        <div class="panel-content">
                                            <div style="margin-left:30px;">
                                                <input type="checkbox"  class="star" checked="checked" id="1" value="1" name="starr"><div class="five-stars-container" style="font-size: 23px;"><span class="five-stars" style="width: 20%"></span></div><br />
                                                <input type="checkbox"  class="star" checked="checked" id="2" value="2" name="starr"><div class="five-stars-container" style="font-size: 23px;"><span class="five-stars" style="width: 40%"></span></div><br />
                                                <input type="checkbox"  class="star" checked="checked" id="3" value="3" name="starr"><div class="five-stars-container" style="font-size: 23px;"><span class="five-stars" style="width: 60%"></span></div><br />
                                                <input type="checkbox"  class="star" checked="checked" id="4" value="4" name="starr"><div class="five-stars-container" style="font-size: 23px;"><span class="five-stars" style="width: 80%"></span></div><br />
                                                <input type="checkbox"  class="star" checked="checked" id="5" value="5" name="starr"><div class="five-stars-container" style="font-size: 23px;"><span class="five-stars" style="width: 100%"></span></div><br />

                                            </div>
                                            <br />

                                        </div>
                                    </div>
                                </div>

                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#accomodation-type-filter" class="collapsed">Hotel Location</a>
                                    </h4>
                                    <div id="accomodation-type-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <ul class="check-square filters-option" id="location">

                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#amenities-filter" class="collapsed">Amenities</a>
                                    </h4>
                                    <div id="amenities-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <ul class="check-square filters-option" id="facilities">

                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#language-filter" class="collapsed">Accommodation Type</a>
                                    </h4>
                                    <div id="language-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <ul class="check-square filters-option" id="accomodation_type">

                                            </ul>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!--############################## AJAX LODER MIDDLE PART  #####################################--->
                        <div id="result">
                            <div id="progressbar" style="margin-top:111px;">
                                <img src="<?php echo base_url(); ?>assets/images/loader.gif" style="margin-left: 325px;"><br />
                                <div style="margin-left: 548px;font-weight: bold;font-size: 24px;margin-top: 30px;">Searching For Best Hotels...</div>
                            </div>
                        </div>
                        <!--############################## AJAX LODER MIDDLE PART  #####################################--->
                    </div>
                </div>
        </section>
        <!--######################### FOOTER STARTS HERE #################################################################--->
        <?php $this->load->view('footer'); ?>
        <!--######################### FOOTER ENDS HERE #################################################################--->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/common.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js"></script>
    <script type="text/javascript">
        $(document).ready(function (){
            var api_array = <?php echo json_encode($api); ?>;
            var successHandler = function (data) {
                $('#progressbar').hide();
                $('#small_progress').hide();
                $('#result').append(data.hotel_search_result);
                var hotelCount = 0;
                $(".HotelInfoBox").each(function (){
                    hotelCount++;
                });

                $("#count_progress").text(hotelCount);
                $('#flight_found').show();
                $('#facilities').html(data.amenities);
                $('#accomodation_type').html(data.type);
                $('#location').html(data.locations);
                setPriceSlider();
                $order = 'asc';
                $sortBy = 'data-price';
                sortHotels($order, $sortBy, $('.HotelSorting'));
            }

            // these will basically all execute at the same time:
            for (var i = 0, l = api_array.length; i < l; i++){
                $.ajax({
                    url: Site_Url + '/hotel/getHotelSearchData/' + api_array[i],
                    data: 'searchId=1',
                    dataType: 'json',
                    type: 'get',
                    beforeSend: function ()
                    {
                        $('#progressbar').show();
                        $('#small_progress').show();
                    },
                    success: successHandler

                });
            }



        });

        $(document).ready(function ()
        {
            $("#hotelName").keyup(function ()
            {
                var filter = $(this).val(), count = 0;

                var regex = new RegExp(filter, "i");

                $(".HotelInfoBox").each(function ()
                {
                    if ($(this).attr('data-hotel-name').search(regex) < 0)
                    {
                        $(this).parents(".searchhotel_box").hide();
                    } else
                    {
                        count++;
                        $(this).parents(".searchhotel_box").show();

                    }

                });

                // Update the count
                $("#hotel_count").text(count + ' Hotels Found');

            });

        });

        $(document).ready(function ()
        {
            $(".HotelSorting").click(function ()
            {
                //alert('dfdffdsf');
                $order = $(this).attr("data-order");
                $sortBy = $(this).attr("rel");
                sortHotels($order, $sortBy, $(this));

            });

        });
    </script>
</html>