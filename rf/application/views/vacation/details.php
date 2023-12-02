<?php $this->load->view('common/header'); ?>
<div class="full moditop flitgray">
  <div class="container fordetailpage">
    <div class="container">
    <div class="row">
    	<div class="full"> 
        <div class="contentpad witbackpkg">
<?php 
    $aMarkup = $this->account_model->get_markup('VACATION'); //get markup
    $aMarkup = $aMarkup['markup'];
    $MyMarkup = $this->account_model->get_my_markup(); //get agent markup
    $myMarkup = $MyMarkup['markup'];

    $package_price = $this->account_model->PercentageToAmount($vacation->package_price,$aMarkup);
    $package_price = $this->account_model->PercentageToAmount($package_price,$myMarkup);
    $req= base64_decode($request);
    $req = json_decode($req);
    $request = array(
        'city' => $req->city,
        'type' => $req->type,
        'date' => $req->date,
        'guests' => '1'
    );
    $request = base64_encode(json_encode($request));
    
    //echo '<pre>';print_r($req);
?>        
        
            <div class="col-md-4 right nopad">
            <div class="LeftCol" id="LeftCol">
            	<div class="insidemaindetsxx">
                	<div class="fixedholy">
                	<h3 class="srchhotl"><?php echo $vacation->package_name;?>, <?php echo $this->flight_model->get_airport_cityname($vacation->package_cityid);?></h3>
                    <div class="htlstar"><img src="<?php echo ASSETS;?>images/smallrating-<?php echo $vacation->package_rating;?>.png" alt="" /></div>
                    <div class="htladrs">
                    	 <?php echo $this->flight_model->get_airport_cityname($vacation->package_cityid);?>
                    </div>
                    <div class="clear"></div>
                    <div class="tablepkg">
                    	<div class="celpakg">
                        	<div class="wrapboxx">
                        		<span class="holitype"><?php echo $vacation->package_type;?></span>
                            	<strong>Package type</strong>
                            </div>
                        </div>
                        <div class="celpakg">
                        	<div class="wrapboxx">
                            	<span class="holitype"><?php echo $vacation->duration;?> Days/<?php echo $vacation->duration-1;?> Nights </span>
                            	<strong>Duration</strong>
                            </div>
                        </div>
                    </div>

                    
                    <div class="clear"></div>
                    
 
                    <div class="clear"></div>
					
                    <div class="tablepkgx">
                    
                    <div class="col-md-12 nopad">
                    	<div class="col-md-6 nopad">
                        	<div class="posrel gadget">
                            <input type="text" placeholder="dd-mm-yy" id="vdate" name="vdate" class="mySelectCalenda calinput flyinput" value="<?php echo $req->date;?>" onchange="getPrice()" required/>
                            </div>
                        </div>
                        <?php if($vacation->max_passanger == 0){?>
                        <div class="col-md-6 nopad">
                        <div class="bordgust">
                          <div class="leftsrch">
                            <div class="inlabel psnico">Guest</div>
                          </div>
                          <div class="ritsrch">
                            <div class="inbar posrel myselect">
                              <select name="guest" id="guest" class="mySelectBoxClass flyinput text-right persn" onchange="getPrice()" required>
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        </div>
                       <?php }else{?>
                       <div class="col-md-6 nopad">
                            <div class="redoly"> Maximum Guests : 5</div>
                       </div>
                       <?php }?> 
                    </div>
                    
                    <div class="clear"></div>
                    <div class="rowhtl">
                    	
                        <div class="col-md-12 nopad">
                        	<div class="holiprice"><span class="curr_icon"><?php echo $this->display_icon;?></span><span data-usd="<?php echo $package_price;?>" class="amount"><?php echo $this->account_model->currency_convertor($package_price);?></span><strong>Starting Price per Adult</strong></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="bokbtnwrap">
                    <input type="hidden" name="req" class="vac_req" value="<?php echo $request;?>">
                    	<a class="htlbook VacbookNow" data-attr="<?php echo $vacation->package_id;?>">Book Now</a>
                    </div>
                    </div>
                    </div>
                    
                    
                </div>
            </div>
            </div>
            
            <div class="col-md-8 nopad pkhdetail">
            <div class="sliderhtldet paddetail">
                <div id="sync1" class="owl-carousel detowl">
                    <?php foreach($images as $image){?>
                    <div class="item">
                        <div class="bigholy">
                            <img src="<?php echo $image->other_image;?>" alt="" />
                        </div>
                    </div>
                    <?php }?>
                </div>
    
                  <div id="sync2" class="owl-carousel syncslide">
                  <?php $i=1; foreach($images as $image){?>
                    <div class="item">
                    	<div class="thumbimg">
                        <?php if($i==1){?>
                            <input type="hidden" name="img" class="vac_img" value="<?php echo $image->other_image;?>">
                        <?php }?>
                        	<img src="<?php echo $image->other_image;?>" alt="" <?php if($i==1){?>id="vac_img"<?php }?>/>
                        </div>
                    </div>
                    <?php $i++;}?>
                  </div>
            </div>
            
            
            <div class="clear"></div>
            <div class="fulldetab">
                <div class="col-md-12 nopad">
                    <div class="detailtab holytab">
                        <ul class="nav nav-tabs">
                          <li class=""><a href="#htldets" data-toggle="tab">Package Details</a></li>
                          <li class="active trooms"><a href="#rooms" data-toggle="tab">Package Itinerary</a></li>
                        </ul>
                        <div class="tab-content5">
                        
                       <!-- Hotel Detail-->
                        <div class="tab-pane" id="htldets">
                        	<div class="innertabs">
                            	<div class="comenhtlsum">
                                	<?php echo $vacation->package_description; ?>
                                </div>
                                <div class="linebrk"></div>
                                <button type="button" class="sumtab" data-toggle="collapse" data-target="#sum1">
                                      Additional Info <span class="collapsearrow"></span>
                                </button>
                                <div class="collapse in" id="sum1">
                                	<div class="parasub">
                               <?php echo $vacation->additional_info; ?>
                                </div>

                                </div>
                                <div class="linebrk"></div>
                                 <button type="button" class="sumtab" data-toggle="collapse" data-target="#sum2">
                                     Terms <span class="collapsearrow"></span>
                                </button>
                                <div class="collapse in" id="sum2">
                                <div class="parasub">
                                <?php echo $vacation->package_terms; ?>
                                </div>
                                </div>
                                <div class="linebrk"></div>
                                 <button type="button" class="sumtab" data-toggle="collapse" data-target="#sum3">
                                      Cancellation Policy <span class="collapsearrow"></span>
                                </button>
                                <div class="collapse" id="sum3">
                                	<div class="parasub">
                                <?php echo $vacation->cancel_policy; ?><br>
                                Cancellation allow: Before <?php echo $vacation->package_cancellation_days; ?>days.<br>
                                Cancellation Amount Deduction: <?php echo $vacation->package_cancellation_percentage; ?>%
                                </div>

                                </div>
                                <div class="linebrk"></div>
                                 <button type="button" class="sumtab" data-toggle="collapse" data-target="#sum4">
                                      Duration <span class="collapsearrow"></span>
                                </button>
                                <div class="collapse" id="sum4">
                                	<div class="parasub">
                                <?php echo $vacation->duration;?> Days/<?php echo $vacation->duration-1;?> Nights 
                                </div>

                                </div>
                            </div>
                        </div>
                        <!-- Hotel Detail End-->
                        
                        <!-- Rooms-->
                        <div class="tab-pane active" id="rooms">
                        	<div class="innertabs">
                            
                            <?php $i=1;foreach($days as $day){?>
                            
                            <div class="htlrumrow">
                            	<div class="hotelistrowhtl">
                                	<div class="col-md-2 nopad xcel dayholi">
                                    <div class="holitip"></div>
                                        <div class="hlidays">DAY
                                            <strong><?php echo $i;?></strong>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 nopad xcel cartimageclo">
                                        <div class="imagehotel"><img class="tocartclone" src="<?php echo $day->image;?>" alt="" /></div>
                                    </div>
                                    <div class="col-md-7 padall10 xcel">
                                        <div class="hotelhed"><?php echo $day->title;?></div>
                                        <span class="singleadrs">Complete day at <?php echo $day->area;?></span>
                                        <div class="holialls">
                                        	<p><?php echo $day->description;?></p>
                                        </div>
                                    </div>   
                                </div>                               
                            </div>
                            
                            <?php $i++;}?>   
                            
                            
                            
                            </div>
                        </div>
                        <!-- Rooms End-->

                        
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
</div>
<div class="clear"></div>
<div id="footer_start">&nbsp;</div>
<?php $this->load->view('common/footer'); ?>
<script>
function getPrice(){
    var guest = $('#guest').val();
    var vdate = $('#vdate').val();
    var request = $('.vac_req').val();
    var di = '<?php echo $vacation->package_id;?>';
    $.ajax({
        type: 'GET',
        url: WEB_URL + "/vacation/getPrice",
        async: true,
        dataType: 'json',
        data: {guest: guest, request: request, di: di, date: vdate},
        success: function(data) {
            $('.holiprice span.amount').html(data.total);
            $('.vac_req').val(data.req);
        }
    });
}
$(document).ready(function(){	
	$("#owl-demo").owlCarousel({
		items : 4, 
		itemsDesktop : [1000,4],
		itemsDesktopSmall : [900,4], 
		itemsTablet: [600,2], 
		itemsMobile : [479,1], 
        navigation : true,
		pagination : false
      });
	  
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

<script type="text/javascript">
  $(document).ready(function(){
	  //alert("s");
	  
	  var sidebarTop = 0,
    winHeight = $(window).height(),
    height = 0;

    var a = $.browser == "msie" && $.browser.version < 7;
	
    if (!a && $(".LeftCol").offset() != null && $("#footer_start").offset().top - $(".LeftCol").height() > 200) {
		
        var b = $(".LeftCol").offset().top - parseFloat($(".LeftCol").css("margin-top").replace(/auto/, 0));
        height = $(".LeftCol").height();
        var d = 7;
        var c = 0;
		
        $(window).scroll(function() {
			
            height = $(".LeftCol").height();
            var ee = $("#footer_start").offset().top - parseFloat($("#footer_start").css("margin-top").replace(/auto/, 0));
			var e = ee +  $('.footerbotm').height();
            var f = $(this).scrollTop();
			var widlef = $('.LeftCol').width();
            if (f == c) {} else {
                if (f > c && f > b && $("#footer_start").offset().top - $(".LeftCol").height() > 200) {
                    if (f + winHeight >= b + height + d && f + winHeight <= e) {
                        sidebarTop = winHeight - height - d;
                        if (winHeight > height) {
                            sidebarTop = 60
                        }
                        $(".LeftCol").addClass("leftsidebarfixed").css({"top": sidebarTop + "px", "width": widlef})
                    } else {
                        if (f + winHeight > e) {
                            $(".LeftCol").addClass("leftsidebarfixed").css("top", sidebarTop + c - f + "px");
                            sidebarTop = sidebarTop + c - f
                        } else {
                            $(".LeftCol").removeClass("leftsidebarfixed").css("top", "0px")
                        }
                    }
                } else {
                    if (f < c && f > b && $("#footer_start").offset().top - $(".LeftCol").height() > 200) {
                        if (sidebarTop + c - f < 0) {
                            $(".LeftCol").css("top", (sidebarTop + c - f) + 60 + "px");
                            sidebarTop = sidebarTop + c - f
                        }
                    } else {
                        $(".LeftCol").removeClass("leftsidebarfixed").css("top", "0px")
                    }
                }
            }
            c = f
        })
    }
	
});
</script>


</body></html>