<?php
if($hotel_name!='')
{
	?>


                 <div class="col-sm-8 padd_l">
              <h4 class="hdm_title"><?php echo $hotel_name; ?></h4>
              <p> <?php echo $address_details; ?></p>
            </div>
            <div class="col-sm-4 nopadd">
              <ul class="list-inline hoteldet_iconslist">
                <li><img src="assets/images/WIFI.svg"></li>
                <li><img src="assets/images/FOOD.svg"></li>
                <li><img src="assets/images/FITNESS.svg"></li>
                <li><img src="assets/images/TV.svg"></li>
              </ul>
               <?php if($hotel_rating!='') { ?>
              <p><input id="input-21e" value="1" type="number" class="rating hsb_starrating" min="0" max="5" step="<?php echo $hotel_rating; ?>" data-size="xs" >  <!-- <img src="<?php echo ASSETS;?>images/smallrating-<?php echo $hotel_rating; ?>.png" alt="Star Rating" />--></p>
               <?php
                    }
                    ?>
            </div>
            <div class="col-sm-12 nopadd">
              <p> <?php
                            if($contact_details!='')
                            {
                            for($g=0;$g<count($contact_details);$g++)
                            {
                                echo $contact_details[$g][0].' - '.$contact_details[$g][1].'<br>';
                            }
                            }
                                ?></p>

                                <?php if($checkin && $checkout){ 
                                     $checkin=explode("-", $checkin);
                                     $checkin=array_reverse($checkin);
                                     $checkin=implode("/",$checkin);
                                     $checkout=explode("-", $checkout);
                                     $checkout=array_reverse($checkout);
                                     $checkout=implode("/",$checkout);
                                     }

                                ?>
                        <form action="<?php echo WEB_URL.'/hotel/get_room_details'; ?>" id="cntctHst">
                        
                        <input type="hidden" name="roomcount" id="roomcount" value="<?php echo $roomcount;?>" />
                        <input type="hidden" name="child" id="child" value="<?php echo $child;?>"/>
                        <div class="form-group col-xs-3 padd_l sm3paddr0 sm2marb0">
                        <label class="color_secondry"> Check-In</label><br>
                        <input type="text" class="form-control full_width input_calender  input_gray checkin" value="<?php if($checkin && $checkout){ echo $checkin; }?>"  readonly name='checkin'  placeholder="dd/mm/yy" required>
                        </div> 
                        <div class="form-group col-xs-3 sm2paddl0 sm2paddr0 sm2marb0">
                        <label class="color_secondry"> Check-Out</label><br>
                        <input type="text" class="form-control full_width input_calender  input_gray checkout" value="<?php if($checkin && $checkout){ echo $checkout; }?>"   readonly  name='checkout' placeholder="dd/mm/yy" required>
                        </div>
                        <div class="form-group col-xs-2 sm2paddl0 sm2paddr0 sm2marb0">
                        <label class="color_secondry"> Traveller</label><br>
                        <select class="flyinput text-right" name="adultss" id="adultss" onchange="get_rooms(this)">
                        <?php if($adult){$adult = $adult;}else{$adult = 1;}for($i=1;$i<=13;$i++){?>
                        <option value="<?php echo $i;?>" <?php if($adult == $i){ echo "selected";}?>><?php echo $i;?></option>
                        <?php }?>
                        </select>
                        </div>
                        <div class="form-group col-xs-3">
                        <label> &nbsp;</label><br>
                        <button type="button" onclick="get_rooms(this)" class="btn btn-secondry btn_inputs htlbook">Check Availability</button>
                        </div>
                        </form>

                
                    
                  
                    
                    
<?php
}else{ ?>
Not Availabble
   <?php } ?>
                <script>
				$(document).ready(function(){		
 $('input.rating').rating();
    $('.checkin').datepicker({
        numberOfMonths: 1,
        firstDay: 1,
        dateFormat: 'dd/mm/yy',
        minDate: '0',
        maxDate: '+2Y',
       
        onSelect: function(selectedDate) {
          $(this).val(selectedDate);
        $(".checkout").datepicker("option", "maxDate", selectedDate);
            get_rooms(this);
        },
        onClose: function(){
          $('.checkout').focus();
        }
    });
    $('.checkout').datepicker({
        numberOfMonths: 1,
        firstDay: 1,
        dateFormat: 'dd/mm/yy',
        minDate: '0',
        maxDate: '+2Y',
       
        onSelect: function(dateStr) {
             $(this).val(dateStr);
            get_rooms(this);
        }
    });
});
function get_rooms(el)
{
   
  
  var fromDate = $('.checkin').val();
  var toDate = $('.checkout').val();
  var roomcount = $('#roomcount').val();
  var adult = $('#adultss option:selected').val();
  var child = $('#child').val();

 var formsplite = fromDate.split("/");
var revformsplite=formsplite.reverse();
var from_Date = revformsplite.join("-");
 var toDatesplit = toDate.split("/");
var revtoDate=toDatesplit.reverse();
var to_Date = revtoDate.join("-");
 if(from_Date!='' && to_Date!='')
 {
	 
	   var tabtop = $(".detailtab").offset().top - 65;
		$('html, body').animate({scrollTop: tabtop
            }, 500);
		
            $.ajax({
			  type: 'POST',
			  url: '<?php echo WEB_URL; ?>/hotel/get_room_details/<?php echo $sid; ?>/<?php echo $hotelid; ?>/<?php echo $city_code; ?>/'+from_Date+'/'+to_Date+'/'+adult+'/'+child+'/'+roomcount,
			  data: '',
			  async: true,
			  dataType: 'json',
			  beforeSend:function(){
                 var this_id=$(el).parents("form").attr('id_ref');
				   $("div.get_rooms"+this_id).html('<img src="<?php echo ASSETS; ?>/images/hotel_img_loading.gif">');
				 
			 },
			success: function(data){
                
               
              var this_id=$(el).parents("form").attr('id_ref');

				$("div.get_rooms"+this_id).html(data.hotel_rooms_details);
				
				
		  },

		  
		 	error:function(request, status, error){


					  }
		  
			});
 }
}
</script>