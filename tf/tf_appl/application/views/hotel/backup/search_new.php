<?php $this->load->view('common/header'); ?>
<div class="full moditop">
    <div class="container fordetailpage">
        <div class="container mt15 offset-0">
            <div class="col-md-12  advnceall">

                <div class="col-md-6 tophr nopad">
                    <div class="col-md-6 min-6 nopad">
                        <div class="padwraphotel">
                            <div class="hotlsrch"><?php echo $city_name; ?></div>
                            <span class="hotladrs"><?php echo $country_name; ?></span>
                        </div>
                    </div>
                    <div class="col-md-3 min-3 nopad">
                        <div class="padwraphotel">
                            <div class="htlboxhed"><span class="htlcal icon icon-calendar"></span>Check-in</div> 
                            <div class="dateandtimeyr"><?php echo date("D", strtotime($check_in)); ?>, <strong><?php echo date("d", strtotime($check_in)); ?></strong> <b><?php echo date("M'y", strtotime($check_in)); ?></b></div>
                        </div>
                    </div>
                    <div class="col-md-3 min-3 nopad">
                        <div class="padwraphotel">
                            <div class="htlboxhed"><span class="htlcal icon icon-calendar"></span>Check-out</div> 
                            <div class="dateandtimeyr"><?php echo date("D", strtotime($check_out)); ?>, <strong><?php echo date("d", strtotime($check_out)); ?></strong> <b><?php echo date("M'y", strtotime($check_out)); ?></b></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 nopad">
                    <div class="col-md-2 min-2 nopad">
                        <div class="padwraphotel">
                            <div class="htlboxhed">Night</div>
                            <div class="deptypew"><?php echo $days; ?></div>
                        </div>
                    </div>
                    <div class="col-md-2 min-2 nopad">
                        <div class="padwraphotel">
                            <div class="htlboxhed">Room</div>
                            <div class="deptypew"><?php echo $rooms; ?></div>
                        </div>
                    </div>
                    <div class="col-md-4 min-4 nopad">
                        <div class="padwraphotel">
                            <div class="htlboxhed">Passengers</div>
                            <div class="leftmar ladult"><?php echo $adult; ?></div>
                           <!-- <div class="leftmar lchil">1</div>
                            <div class="leftmar linfant">0</div>-->
                        </div>
                    </div>
                    <div class="col-md-4 min-4">
                        <button class="modify lesmargin" data-toggle="collapse" data-target="#modhtl">Modify Search</button>
                    </div>
                </div>

                <div class="htlmod collapse" id="modhtl">
                    <div class="htlmodin">
                        <form action="<?php echo WEB_URL.'/hotel/search'; ?>" method="get">
                        <div class="col-md-12 nopad">
                            <div class="smalsent">Modify your search</div>
                            <div class="clearfix"></div>
                            <div class="col-md-12 nopad left marbotom20 my12">
                                <div class="col-md-12 md-12 xmd-12 xm-12">
                                    <div class="ritsrch">
                                        <div class="inbar posrel">
                                            <input type="text" id="hotel_autocomplete" class="flyinput locmark hotel_autocomplete" name="city" placeholder="I want to go to" onFocus="geolocate()" value="<?php echo $city_name_full; ?>" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12 md-12 nopad left marbotom20">
                                <div class="col-md-4 md-4 xmd-6 xm-12">
                                    <div class="posrel">
                                        <input type="text" class="mySelectCalenda calinput flyinput" name="hotel_checkin" id="hotel_checkin" placeholder="Check in" value="<?php echo $check_in; ?>" />
                                    </div>
                                </div>
                                <div class="col-md-4 md-4 xmd-6 xm-12 marxm">
                                    <div class="posrel">
                                        <input type="text" class="mySelectCalenda calinput flyinput" name="hotel_checkout" id="hotel_checkout" placeholder="Check Out" value="<?php echo $check_out; ?>" />
                                    </div>
                                </div>
                                <div class="col-md-4 md-4 xmd-12 xm-12 marxmd">
                                    <div class="leftsrch">
                                        <div class="inlabel rumnoc">Rooms</div>
                                    </div>
                                    <div class="ritsrch">
                                        <div class="inbar posrel myselect">
                                            <select class="mySelectBoxClass flyinput text-right persn" name="rooms" required>
                                                <?php $room_num_array = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16'); ?>
                                                <?php foreach($room_num_array as $room_num): ?>
                                                    <option <?php echo ($rooms==$room_num) ? 'selected' : ''; ?> value="<?php echo $room_num; ?>"><?php echo $room_num; echo ($room_num == 16) ? '+' : ''; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>



                            <div class="col-md-12 md-12 nopad left marbotom20">

                                <div class="col-md-4 md-4 xmd-6 xm-12">
                                    <div class="roomnum">
                                        <span class="numroom">Passenger's</span>
                                    </div>
                                </div>

                                <div class="col-md-4 md-4 xmd-6 xm-12">
                                    <div class="leftsrch">
                                        <div class="inlabelnew psnico">Adult<strong>12+ yrs</strong></div>
                                    </div>
                                    <div class="ritsrch">
                                        <div class="inbar posrel myselect">
                                            <select class="mySelectBoxClass flyinput text-right persn" name="adult" required>
                                                <?php $adult_num_array = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16'); ?>
                                                <?php foreach($adult_num_array as $adult_num): ?>
                                                    <option <?php echo ($adult==$adult_num) ? 'selected' : ''; ?> value="<?php echo $adult_num; ?>"><?php echo $adult_num; echo ($adult_num == 16) ? '+' : ''; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <div class="col-md-12 left marbotom20">
                                <input class="indxsrch" type="submit" value="Search" name=""/>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
$("#hotel_autocomplete").autocomplete({
    source: "<?php echo WEB_URL;?>/hotel/get_hotel_city_suggestions",
    minLength: 2,//search after two characters
    autoFocus: true, // first item will automatically be focused
    select: function(event,ui){
       
    }
  });
  
</script>
<div class="full flitgray">
    <div class="container forhotlpage">
        <div class="container  offset-0">           
            <!-- FILTERS -->
            <div class="col-md-3 filters nopad">
                <!-- Price range -->
                <!--<div class="rowfilter">					
                    <button type="button" class="filtedhed" data-toggle="collapse" data-target="#pricerange">
                        <span class="hedfiltr">Price range </span>
                        <span class="filterdoen"></span>
                    </button>

                    <div id="pricerange" class="collapse in merange">
                        <div class="infiltrbox">
                            <div class="layoutslider">
                                <input id="Slider1" type="slider" name="price" value="770;2500" />
                      
                            </div>

                        </div>
                    </div>                   
                </div>-->
                <!-- End of Price range -->	

                <script type="text/javascript">


                    jQuery("#Slider1, #Slider2").slider({from: 100, to: 5000, step: 5, smooth: true, round: 0, dimension: "&nbsp;$", skin: "round"});

                </script>
                

                <!-- Airlines  -->
                <div class="rowfilter">					
                    <button type="button" class="filtedhed" data-toggle="collapse" data-target="#airlines">
                        <span class="hedfiltr">Hotel Name</span>
                        <span class="filterdoen"></span>
                    </button>

                    <div id="airlines" class="collapse in merange">
                        <div class="infiltrbox htlrub">
                            <input type="text" placeholder="Hotel Name" name="hotel_name" id="hotelName" class="htlinput" />
                        </div>
                    </div>                   
                </div>
                <!-- Airlines End -->	

   <!-- Airlines  -->
                <div class="rowfilter">					
                    <button type="button" class="filtedhed" data-toggle="collapse" data-target="#hotelAddresss">
                        <span class="hedfiltr">Hotel Address</span>
                        <span class="filterdoen"></span>
                    </button>

                    <div id="hotelAddresss" class="collapse in merange">
                        <div class="infiltrbox htlrub">
                            <input placeholder="Hotel Address" type="text" name="hotelAddress" id="hotelAddress" class="htlinput">
                        </div>
                    </div>                   
                </div>
                <!-- Airlines End -->	

            </div>
            <!-- END OF FILTERS -->

            <!-- LIST CONTENT-->
            <div class="rightcontent col-md-9 padlisting">


                <div class="itemscontainer">


                 <!--   <div class="col-lg-12 nopad">
                        <ul class="sortul">
                            <li class="sorthd">Sort by</li>
                            <li class="sortsent active"><a class="sortlabl">Popularity</a></li>
                            <li class="sortsent"><a class="sortlabl">Price</a></li>
                            <li class="sortsent"><a class="sortlabl">Star Rating</a></li>
                            <li class="sortsent"><a class="sortlabl">User Rating</a>
                            </li>
                        </ul>
                    </div>-->

                    <div class="clearfix"></div>

                    <div id="sresult" style="padding-left: 10px;">
					<div id="hotel_result">
                        

                        </div>

                        


                    </div>	
                    <!-- End of offset1-->		
                </div>
                <!--<div class="hpadding20">

                    <ul class="pagination right paddingbtm20">
                        <li class="disabled"><a href="#">&laquo;</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>

                </div>-->

            </div>
            <!-- END OF LIST CONTENT-->
        </div>
    </div>
</div>
<?php $this->load->view('common/footer'); ?>


<script type="text/javascript">
    $(document).ready(function() {
       /* $(window).scroll(function() {
            var winTop = $(this).scrollTop();
            var minusht = $(window).height() / 2;
            var $loaddiv = $('.scroll');

            var top = $.grep($loaddiv, function(item) {
                return $(item).position().top <= winTop + minusht;
            });

            $loaddiv.removeClass('active');
            $(top).addClass('active');
        });*/
    });
</script>

<script>
    var data = {};

    data['city_code'] = '<?php echo $city_code; ?>';
    data['check_in'] = '<?php echo $check_in; ?>';
    data['check_out'] = '<?php echo $check_out; ?>';
    data['rooms'] = '<?php echo $rooms; ?>';
    data['adult'] = '<?php echo $adult; ?>';

    $.ajax({
        type: 'POST',
        url: WEB_URL + "/hotel/hotel_search",
        async: true,
        dataType: 'json',
        data: data,
        beforeSend: function() {
            $("#hotel_result").html('<div class="lodrefrentrev imgLoader"><div class="centerload"></div></div>');
            $("#hotel_result .lodrefrentrev").fadeIn();
        },
        success: function(data) {

            $("#hotel_result").html(data.result);
            $("#hotel_result .lodrefrentrev").fadeOut();

            $(window).scroll(function() {
                var winTop = $(this).scrollTop();
                var minusht = $(window).height() / 2;
                var $loaddiv = $('.scroll');

                var top = $.grep($loaddiv, function(item) {
					
                    return $(item).position().top <= winTop + minusht;
                });
	                $loaddiv.removeClass('active');
                $(top).addClass('active');
            });
        }
    });
	
$(document).ready(function()
{
    $("#hotelName").keyup(function()
    {       
        var filter = $(this).val(), count = 0;
        
        var regex = new RegExp(filter, "i"); 
       
        $(".HotelInfoBox").each(function()
        {           
            if ($(this).attr('data-hotel-name').search(regex) < 0) 
            { 
                 $(this).parents(".searchhotel_box").hide();         
            } 
            else 
            {
				count++;
                $(this).parents(".searchhotel_box").show();
               
            }
            
        });

        // Update the count
      // $("#hotelCount").text(count);	
        
    });   
    
	$("#hotelAddress").keyup(function()
    {       
        var filter = $(this).val(), count = 0;
        
        var regex = new RegExp(filter, "i"); 
       
        $(".HotelInfoBox").each(function()
        {           
            if ($(this).attr('data-address').search(regex) < 0) 
            { 
                 $(this).parents(".searchhotel_box").hide();         
            } 
            else 
            {
				count++;
                $(this).parents(".searchhotel_box").show();
               
            }
            
        });

        // Update the count
      // $("#hotelCount").text(count);	
        
    });   
    
});


</script>
</body></html>
