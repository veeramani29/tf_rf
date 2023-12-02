<?php //foreach ($images as $key => $image) {echo $image->url;}exit;?>
<?php $this->load->view('common/header'); ?>
<div class="full moditop flitgray">
    <div class="container fordetailpage">
        <div class="container">
            <div class="full"> 
                <div class="contentpad">
                    <div class="col-md-5 desklarge">
                        <div class="insidemaindets" >
                            <div id="hotel_details">
                                <h3 class="srchhotl"><?php echo $hotel_data->hotel_name; ?></h3>
                                <div class="htlstar">
                                <?php if($hotel_data->star!='') { ?>
                                    <img src="<?php echo ASSETS;?>images/smallrating-<?php echo $hotel_data->star; ?>.png" alt="" />
                                <?php }?>
                                </div>
                                <div class="htladrs">
                                     <?php echo $hotel_data->address; ?>
                                </div>
                                <div class="clear"></div>
                                <span class="smalhotldesc"> <?php echo $hotel_data->descrip; ?></span>
                                <div class="clear"></div>
                                <br><br><div class="clear"></div>
                                <form action="<?php echo WEB_URL.'/hotel/get_room_details'; ?>" id="cntctHst">
                                    <div class="advancerow">
                                        <div class="col-sm-12 nopad">
                                            <div class="col-sm-6 adpad">
                                                <label class="aptlabel">Check In</label>
                                                <input class="mySelectCalenda calinput aptadvdate" type="text" name="checkin" id="from" placeholder="dd-mm-yyyy" value="<?php if($checkin && $checkout){ echo $checkin; }?>" required readonly/>
                                            </div>
                                            <div class="col-sm-6 adpad">
                                                <label class="aptlabel">Check Out</label>
                                                <input class="mySelectCalenda calinput aptadvdate" type="text" name="checkout" id="to" placeholder="dd-mm-yyyy" value="<?php if($checkin && $checkout){ echo $checkout; }?>" required readonly/>
                                            </div> 
                                        </div>
                                        <div class="clear"></div>
                                        <div class="col-sm-12 nopad froptopmar">
                                            <div class="col-sm-12 adpad myselect">
                                                <label class="aptlabel">Traveller</label>
                                                <select class="aptselect mySelectBoxClass  flyinput text-right" name="adult" id="adult" onchange="get_rooms()">
                                                    <?php if($adult){$adult = $adult;}else{$adult = 1;}for($i=1;$i<=13;$i++){?>
                                                    <option value="<?php echo $i;?>" <?php if($adult == $i){ echo "selected";}?>><?php echo $i;?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                            <input type="hidden" name="nights" id="nights"/>
                                            <input type="hidden" name="total" id="Total"/>
                                            <input type="hidden" name="rent" id="rent"/>
                                        </div>
                                     </div>
                                </form>
                                <br><div class="clear"></div>
                                <div class="bokbtnwrap">
                                    <a class="htlbook">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 nopad">
                        <div class="sliderhtldet">
                            <div id="hotel_image">
                                 <div id="sync1" class="owl-carousel detowl">
                                  <?php foreach ($images as $key => $image) {?>
                                   <div class="item">
                                        <div class="bighotl">
                                            <img src="<?php echo $image->url;?>" alt="<?php echo $image->url;?>" />
                                        </div>
                                    </div>
                                  <?php } ?>
                                  </div>
                                  <div id="sync2" class="owl-carousel syncslide">
                                  <?php $i=1;foreach ($images as $key => $image) {?>
                                    <div class="item" >
                                        <div class="thumbimg">
                                             <img src="<?php echo $image->thumbnailUrl;?>" alt="<?php echo $image->thumbnailUrl;?>" />
                                        </div>
                                    </div>
                                  <?php $i++;}?>
                                  </div>
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
    var checkdate = '<?php echo $checkdate; ?>';
    if (checkdate == 'ok') {
        var h_checkin = '<?php echo $checkin; ?>';
        var h_checkout = '<?php echo $checkout; ?>';
        var adult = '<?php echo $adult; ?>';
    	var roomcount = '<?php echo $room_count; ?>';
        var p_url = '/' + h_checkin + '/' + h_checkout + '/' + adult+ '/' +roomcount;
    }else{
        var h_checkin = '';
        var h_checkout = '';
        var adult = '';
		var roomcount = '';
        var p_url = '';
    }
                    
    if (checkdate == 'ok'){
        $.ajax({
            type: 'GET',
            url: '<?php echo WEB_URL; ?>/hotel/get_crs_rooms/<?php echo $hotelid; ?>/<?php echo $city_code; ?>' + p_url,
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
            },
            error: function(request, status, error) {
            }
        });
    }else{
        $("#Roominformation").hide();
    }
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


                  
$(document).ready(function(){   

      
      var sync1 = $("#sync1");
      var sync2 = $("#sync2");

      sync1.owlCarousel({
        singleItem : true,
        slideSpeed : 1000,
        navigation: true,
        pagination:false,
        afterAction : syncPosition,
        responsiveRefreshRate : 200,
      });

      sync2.owlCarousel({
        items : 6,
        itemsDesktop      : [1199,6],
        itemsDesktopSmall     : [979,5],
        itemsTablet       : [768,4],
        itemsMobile       : [479,2],
        pagination:false,
        responsiveRefreshRate : 100,
        afterInit : function(el){
          el.find(".owl-item").eq(0).addClass("synced");
        }
      });

      function syncPosition(el){
        var current = this.currentItem;
        $("#sync2")
          .find(".owl-item")
          .removeClass("synced")
          .eq(current)
          .addClass("synced")
        if($("#sync2").data("owlCarousel") !== undefined){
          center(current)
        }

      }

      $("#sync2").on("click", ".owl-item", function(e){
        e.preventDefault();
        var number = $(this).data("owlItem");
        sync1.trigger("owl.goTo",number);
      });

      function center(number){
        var sync2visible = sync2.data("owlCarousel").owl.visibleItems;

        var num = number;
        var found = false;
        for(var i in sync2visible){
          if(num === sync2visible[i]){
            var found = true;
          }
        }

        if(found===false){
          if(num>sync2visible[sync2visible.length-1]){
            sync2.trigger("owl.goTo", num - sync2visible.length+2)
          }else{
            if(num - 1 === -1){
              num = 0;
            }
            sync2.trigger("owl.goTo", num);
          }
        } else if(num === sync2visible[sync2visible.length-1]){
          sync2.trigger("owl.goTo", sync2visible[1])
        } else if(num === sync2visible[0]){
          sync2.trigger("owl.goTo", num-1)
        }
      }

    

    
    });
   
</script>
<script>
                $(document).ready(function(){       

    $('.htlbook').click(function(){
        var tabtop = $(".detailtab").offset().top - 65;
        $('html, body').animate({scrollTop: tabtop
            }, 500);
        $('.tab-pane, .fulldetab .nav-tabs > li').removeClass('active');
        $('#rooms, .trooms').addClass('active');
    });
    
    
    $('.morefac').click(function(){
        var tabtop = $(".detailtab").offset().top - 65;
        $('html, body').animate({scrollTop: tabtop
            }, 500);
        $('.tab-pane, .fulldetab .nav-tabs > li').removeClass('active');
        $('#facility, .tfacility').addClass('active');
    });
});

$(function() {
    
    $('#from').datepicker({
        numberOfMonths: 1,
        firstDay: 1,
        dateFormat: 'dd-mm-yy',
        minDate: '0',
        maxDate: '+2Y',
       
        onSelect: function(dateStr) {
          
        //$("#to").datepicker("option", "maxDate", d2);
            get_rooms();
        },
        onClose: function(){
        //  $('#to').focus();
        }
    });
    $('#to').datepicker({
        numberOfMonths: 1,
        firstDay: 1,
        dateFormat: 'dd-mm-yy',
        minDate: '0',
        maxDate: '+2Y',
       
        onSelect: function(dateStr) {
            get_rooms();
        }
    });
});
function get_rooms(){
    var checkdate = '<?php echo $checkdate; ?>';
    if (checkdate == 'ok') {
        var h_checkin =  $('#from').val();
        var h_checkout = $('#to').val();
        var adult = '<?php echo $adult; ?>';
        var roomcount = '<?php echo $room_count; ?>';
        var adult = $('#adult option:selected').val();
        var p_url = '/' + h_checkin + '/' + h_checkout + '/' + adult+ '/' +roomcount;
    }else{
        var h_checkin = '';
        var h_checkout = '';
        var adult = '';
        var roomcount = '';
        var p_url = '';
    }


                    
    if (checkdate == 'ok'){
        $.ajax({
            type: 'GET',
            url: '<?php echo WEB_URL; ?>/hotel/get_crs_rooms/<?php echo $hotelid; ?>/<?php echo $city_code; ?>' + p_url,
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
            },
            error: function(request, status, error) {
            }
        });
    }else{
        $("#Roominformation").hide();
    }
}
</script>
</body></html>
