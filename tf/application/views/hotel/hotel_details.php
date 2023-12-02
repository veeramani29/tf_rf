<?php $this->load->view('common/header'); ?>
<div class="full moditop flitgray">
    <div class="container fordetailpage">
        <div class="container">
            <div class="full"> 
                <div class="contentpad">
                    <div class="col-md-5 desklarge">
                        <div class="insidemaindets" >
                            <div id="hotel_details"></div>
                        </div>
                    </div>
                    <div class="col-md-7 nopad">
                        <div class="sliderhtldet">
                            <div id="hotel_image">
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="fulldetab" id="Roominformation">
                        <div class="col-md-8 nopad">
                            <div class="detailtab">
                                <ul class="nav nav-tabs">
                                    <!--<li class=""><a href="#htldets" data-toggle="tab">Hotel Details</a></li>-->
                                    <li class="active trooms"><a href="#rooms" data-toggle="tab">Rooms</a></li>
                                    <!--<li class="tfacility"><a href="#facility" data-toggle="tab">Facilities</a></li>
                                    <li><a href="#maps" data-toggle="tab">Map</a></li>-->
                                </ul>
                                <div class="tab-content5">

                                    <!-- Hotel Detail-->
                                    <div class="tab-pane" id="htldets">
                                        <div class="innertabs">
                                            <div class="comenhtlsum">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor aliquam felis, sit amet tempus nibh ullamcorper nec. Maecenas suscipit dolor at blandit congue. Sed adipiscing, odio feugiat pellentesque tincidunt, est leo vestibulum erat, ac pharetra massa justo ac lorem.
                                            </div>
                                            <div class="linebrk"></div>
                                            <button type="button" class="sumtab" data-toggle="collapse" data-target="#sum1">
                                                2 restaurants, a bar/lounge <span class="collapsearrow"></span>
                                            </button>
                                            <div class="collapse in" id=sum1>
                                                <div class="parasub">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor aliquam felis, sit amet tempus nibh ullamcorper nec. Maecenas suscipit dolor at blandit congue. Sed adipiscing, odio feugiat pellentesque tincidunt, est leo vestibulum erat, ac pharetra massa justo ac lorem. 
                                                </div>

                                            </div>
                                            <div class="linebrk"></div>
                                            <button type="button" class="sumtab" data-toggle="collapse" data-target="#sum2">
                                                2 restaurants, a bar/lounge <span class="collapsearrow"></span>
                                            </button>
                                            <div class="collapse in" id=sum2>
                                                <div class="parasub">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor aliquam felis, sit amet tempus nibh ullamcorper nec. Maecenas suscipit dolor at blandit congue. Sed adipiscing, odio feugiat pellentesque tincidunt, est leo vestibulum erat, ac pharetra massa justo ac lorem. 
                                                </div>
                                            </div>
                                            <div class="linebrk"></div>
                                            <button type="button" class="sumtab" data-toggle="collapse" data-target="#sum3">
                                                2 restaurants, a bar/lounge <span class="collapsearrow"></span>
                                            </button>
                                            <div class="collapse" id=sum3>
                                                <div class="parasub">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor aliquam felis, sit amet tempus nibh ullamcorper nec. Maecenas suscipit dolor at blandit congue. Sed adipiscing, odio feugiat pellentesque tincidunt, est leo vestibulum erat, ac pharetra massa justo ac lorem. 
                                                </div>

                                            </div>
                                            <div class="linebrk"></div>
                                            <button type="button" class="sumtab" data-toggle="collapse" data-target="#sum4">
                                                2 restaurants, a bar/lounge <span class="collapsearrow"></span>
                                            </button>
                                            <div class="collapse" id=sum4>
                                                <div class="parasub">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor aliquam felis, sit amet tempus nibh ullamcorper nec. Maecenas suscipit dolor at blandit congue. Sed adipiscing, odio feugiat pellentesque tincidunt, est leo vestibulum erat, ac pharetra massa justo ac lorem. 
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hotel Detail End-->

                                    <!-- Rooms-->
                                    <div class="tab-pane active" id="rooms">
                                        <div class="innertabs">

<?php
$Hotel_room_info=json_decode($request['roomslist'], true);

if(!empty($Hotel_room_info))
{

for($k=0;$k<count($Hotel_room_info['Option']);$k++)
{
    print_r($Hotel_room_info['Option'][$k]);
    $hotel_data = base64_encode(json_encode($Hotel_room_info[$k]));
        ?>
       <!-- <form id="bookNow<?php echo $Hotel_room_info['Option'][$k]['@attributes']['Token'] ?>" name="bookNow<?php echo $Hotel_room_info['Option'][$k]['@attributes']['Token'] ?>" action="<?php echo WEB_URL;?>/hotel/book_it"> -->
        <form id="" method="post" action="<?php echo WEB_URL;?>/hotel/makebook">
            <input type="hidden" name="temp_id" value="<?php echo $hotel_data; ?>">
            <input type="hidden" name="makebook_token" value="<?php echo $Hotel_room_info['Option'][$k]['@attributes']['Token'] ; ?>">
            <input type="hidden" name="rooms" value="<?php echo $rooms; ?>">
            <input type="hidden" name="type" value="<?php echo base64_encode(base64_encode('API')); ?>">
                            <div class="htlrumrow">
                                <div class="hotelistrowhtl">
                                <div class="col-md-4 nopad xcel cartimageclo">
                                        <div class="imagehotel" id="imagehotels<?php echo $k; ?>">
                                        <div class="imagehotels">
                                        <div class="lodrefrentrev imgLoader" style="display:block !important;"><div class="centerload"></div></div><!--<img class="tocartclone" src="<?php echo ASSETS;?>images/items/item1.jpg" alt="" />--></div>
                                    </div></div>
                                    
                                    <div class="col-md-6 padall10 xcel">
                                        <div class="hotelhed"><?php echo $Hotel_room_info['Option'][$k]['Rooms']['Room']['@attributes']['Type'] ?></div>
                                        <!--<span class="singleadrs">One Queen Bed </span>-->
                                     
                                        <div class="mensionspl">
                                            <?php echo $Hotel_room_info[$k]->roomdescription ?>
                                           <!-- <span class="menlbl">sdsa</span>-->
                                        </div>
                                       
                                        <div class="clear"></div>
                                       
                                        <button type="button" class="morerum" onClick="javascript:get_cancellation_policy('<?php echo $k; ?>','<?php echo $Hotel_room_info[$k]->chain_code; ?>','<?php echo $Hotel_room_info[$k]->hotel_code; ?>','<?php echo $Hotel_room_info[$k]->org_amount; ?>','<?php echo $Hotel_room_info[$k]->room_code; ?>','<?php echo $Hotel_room_info[$k]->checkin; ?>','<?php echo $Hotel_room_info[$k]->checkout; ?>')" data-toggle="collapse" data-target="#rumaldets<?php echo $k; ?>">
                                        <div class="refundpol">
                                            <span class="icon icon-check"></span>Additional details / Room Rate Rules
                                        </div>
                                        </button>
                                        <div class="clear"></div>
                                       
                                    </div>
                                    <div class="col-md-2 nopad xcel bordrit">
                                        <div class="pricesec">
                                            <span class="pricehotel">
                                            <?php echo $this->display_icon;?> <?php echo $this->account_model->currency_convertor($Hotel_room_info['Option'][$k]['Rooms']['Room']['@attributes']['Price']);?>
                                            </span>
                                            <span class="smalper">Total</span>
                                       <input type="submit" class="" id="book-it<?php echo $k; ?>" value="Book Now"  data-attr="H<?php echo $k; ?>"  data-tempid="<?php echo $Hotel_room_info[$k]->api_hotel_detail_temp_id ?>" name="submit"/> <!-- booknowhtl HotelbookNow add-to-cart  -->
                                       
                                     
                                      
                                        </div>
                                    </div>
                                </div>  
                                <div class="allromdesc collapse" id="rumaldets<?php echo $k; ?>" style="margin-left:12px;">
                                            
                                        </div>
                            </div>
       </form>
    <?php
}
}
?>
                            
                          
                            
                            
                            
                            </div>
                            <script>
                            function get_cancellation_policy(id,sid,hotelid,rate,rateplan,checkin,checkout)
                            {
                                
                                $.ajax({
              type: 'POST',
              url: '<?php echo WEB_URL; ?>/hotel/get_cancel_policy/'+sid+'/'+hotelid+'/'+rate+'/'+rateplan+'/'+checkin+'/'+checkout,
              data: '',
              async: true,
              dataType: 'json',
              beforeSend:function(){
                  $("#rumaldets"+id).html('<div class="lodrefrentrev imgLoader"><div class="centerload"></div></div>');
                  $("#rumaldets"+id+" .lodrefrentrev").fadeIn();
             },
            success: function(data){
                
                $("#rumaldets"+id).html(data.hotel_rules_val1);
                $("#rumaldets"+id+" .lodrefrentrev").fadeOut();
          },

          
            error:function(request, status, error){


                      }
          
            });
                                
                            }
                            </script>
                                    </div>
                                    <!-- Rooms End-->

                                    <!-- Facilities--> 
                                    <div class="tab-pane" id="facility">
                                        <div class="innertabs">
                                            <div class="comenhtlsum">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor aliquam felis, sit amet tempus nibh ullamcorper nec. Maecenas suscipit dolor at blandit congue. Sed adipiscing, odio feugiat pellentesque tincidunt, est leo vestibulum erat, ac pharetra massa justo ac lorem.
                                            </div>
                                            <div class="linebrk"></div>
                                            <div class="col-md-12 nopad">
                                                <div class="col-md-4">
                                                    <ul class="checklist">
                                                        <li>Climate control</li>
                                                        <li>Air conditioning</li>
                                                        <li>Direct-dial phone</li>
                                                        <li>Minibar</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-4">
                                                    <ul class="checklist">
                                                        <li>Wake-up calls</li>
                                                        <li>Daily housekeeping</li>
                                                        <li>Private bathroom</li>
                                                        <li>Hair dryer</li>	
                                                    </ul>									
                                                </div>	
                                                <div class="col-md-4">
                                                    <ul class="checklist">								
                                                        <li>Makeup/shaving mirror</li>
                                                        <li>Shower/tub combination</li>
                                                        <li>Satellite TV service</li>
                                                        <li>Electronic/magnetic keys</li>	
                                                    </ul>									
                                                </div>	
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Facilities End-->

                                    <!-- Map--> 
                                    <div class="tab-pane" id="maps">
                                        <div class="innertabs">
                                            map
                                        </div>
                                    </div>
                                    <!-- Map End-->

                                    <!-- Reviews--> 
                                    <div class="tab-pane" id="maps">
                                        <div class="innertabs">
                                            <div class="ratingusr">
                                                <strong>4.5</strong>
                                                <span class="ratingimg"><img src="<?php echo ASSETS; ?>images/user-rating-4.png" alt="" /></span>
                                                <b>User Rating</b>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Reviews End-->

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="pagecontainer2  needassistancebox">
                                <div class="cpadding1">
                                    <span class="icon-help"></span>
                                    <h3 class="opensans">Need Assistance?</h3>
                                    <p class="size14 grey">Our team is 24/7 at your service to help you with your booking issues or answer any related questions</p>
                                    <p class="opensans size30 lblue xslim">	<?php $banners = $this->Help_Model->getHomeSettings(); ?><?php echo $banners->customer_support_phone; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('common/footer'); ?>
<script>
    $(document).ready(function() {
       /* $.ajax({
            type: 'POST',
            url: '<?php echo WEB_URL; ?>/hotel/get_hotel_images/<?php echo $sid; ?>/<?php echo $hotelid; ?>',
                        data: '',
                        async: true,
                        dataType: 'json',
                        beforeSend: function() {

                            $("#hotel_image").html('<div class="lodrefrentrev imgLoader"><div class="centerload"></div></div>');
                            $("#hotel_image .lodrefrentrev").fadeIn();
                        },
                        success: function(data) {

                            $("#hotel_image").html(data.hotel_images_val1);
                            $("#hotel_image .lodrefrentrev").fadeOut();
                        },
                        error: function(request, status, error) {


                        }

                    });*/
                    var checkdate = '<?php echo $checkdate; ?>';
                    if (checkdate == 'ok')
                    {
                        var h_checkin = '<?php echo $checkin; ?>';
                        var h_checkout = '<?php echo $checkout; ?>';
                        var adult = '<?php echo $adult; ?>';
						 var roomcount = '<?php echo $room_count; ?>';
                        var p_url = '/' + h_checkin + '/' + h_checkout + '/' + adult+ '/' +roomcount;
                    }
                    else
                    {
                        var h_checkin = '';
                        var h_checkout = '';
                        var adult = '';
						 var roomcount = '';
                        var p_url = '';
                    }
                    var data = <?php echo json_encode($request); ?>;
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo WEB_URL; ?>/hotel/get_hotel_details/',
                        data: data,
                        async: true,
                        dataType: 'json',
                        beforeSend: function() {

                            $("#hotel_details").html('<div class="lodrefrentrev imgLoader"><div class="centerload"></div></div>');
                            $("#hotel_details .lodrefrentrev").fadeIn();
                        },
                        success: function(data) {

                            $("#hotel_details").html(data.hotel_details_val1);
                            $("#hotel_image").html(data.hotel_images_val1);
                            
                            $("#hotel_details .lodrefrentrev").fadeOut();
                        },
                        error: function(request, status, error) {
                        }
                    });
                    /*if (checkdate == 'ok')
                    {
                        $.ajax({
                            type: 'POST',
                            url: '<?php echo WEB_URL; ?>/hotel/get_room_details/<?php echo $sid; ?>/<?php echo $hotelid; ?>/<?php echo $city_code; ?>/' + p_url,
                            data: '',
                            async: true,
                            dataType: 'json',
                            beforeSend: function() {

                                $("#rooms").html('<div class="lodrefrentrev imgLoader"><div class="centerload"></div></div>');
                                $("#rooms .lodrefrentrev").fadeIn();
                            },
                            success: function(data) {

                                $("#rooms").html(data.hotel_rooms_val1);
                                $("#rooms .lodrefrentrev").fadeOut();
                                //alert(data.Hotel_room_info);

                                $.ajax({
                                    type: 'POST',
                                    url: '<?php echo WEB_URL; ?>/hotel/get_random_hotel_images/<?php echo $sid; ?>/<?php echo $hotelid; ?>',
                                    data: '',
                                    async: true,
                                    dataType: 'json',
                                    beforeSend: function() {
                                    },
                                    success: function(data4) {
									var hotel_images_sdde = data4;
                                    for (i = 0; i < data.Hotel_room_info; i++)
                                    {
										if(hotel_images_sdde.hotel_images_val1[i])
										{
										if (hotel_images_sdde.hotel_images_val1[i] != '' )							        {
												
                                                $("#imagehotels" + i).html('<img class="tocartclone" id="HH'+i+'" src="' + hotel_images_sdde.hotel_images_val1[i] + '" alt="" /> <input type="hidden" name="imageurl"  value="' + hotel_images_sdde.hotel_images_val1[i] + '">');
												
                                                $("#imagehotels" + i + " .lodrefrentrev").fadeOut();
                                            }
                                            else
                                            {
											
                                                $("#imagehotels" + i).html('<img class="tocartclone" src="' + hotel_images_sdde.hotel_images_val1[0] + '" id="HH0"  alt="" /><input type="hidden" name="imageurl"  value="' + hotel_images_sdde.hotel_images_val1[0] + '">');
                                                $("#imagehotels" + i + " .lodrefrentrev").fadeOut();
                                            }
										}
										else
										{
											$("#imagehotels" + i).html('<img class="tocartclone" src="' + hotel_images_sdde.hotel_images_val1[0] + '" id="HH0"  alt="" /><input type="hidden" name="imageurl"  value="' + hotel_images_sdde.hotel_images_val1[0] + '">');
                                                $("#imagehotels" + i + " .lodrefrentrev").fadeOut();
										}
                                        }
                                 },
                                    error: function(request, status, error) {
                                    }
                                });
                                
                            },
                            error: function(request, status, error) {
                            }

                        });
                    }
                    else
                    {
                        $("#Roominformation").hide();
                    }*/

                });
</script>

<script type="text/javascript">
$(document).ready(function() {
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
});
</script>

</body></html>
