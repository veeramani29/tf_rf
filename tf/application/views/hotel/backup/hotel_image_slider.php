 <div id="sync1" class="owl-carousel detowl">
                  <?php
				  
				 for($i=0;$i<count($hotel_images_val);$i++)
				 {
					 
					 ?>
                   <div class="item">
                        <div class="bighotl">
                            <img src="<?php echo $hotel_images_val[$i][1];?>" alt="<?php echo $hotel_images_val[$i][0];?>" />
                        </div>
                    </div>
                   
                   <?php
				 }
				 ?>
                  </div>
    
                 <div id="sync2" class="owl-carousel syncslide">
                   <?php
				  
				 for($i=0;$i<count($hotel_images_val);$i++)
				 {
					 
					 ?>
                    <div class="item" >
                    	<div class="thumbimg">
                        	 <img src="<?php echo $hotel_images_val[$i][1];?>" alt="<?php echo $hotel_images_val[$i][0];?>" />
                        </div>
                    </div>
                   <?php
				 }
				 ?>
                  </div>
                  <script>
				  
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