<?php
if($hotel_name!='')
{
	?>
                	<h3 class="srchhotl"><?php echo $hotel_name; ?></h3>
                    <div class="htlstar">
                    <?php if($hotel_rating!='') { ?>
                    <img src="<?php echo ASSETS;?>images/smallrating-<?php echo $hotel_rating; ?>.png" alt="" />
                    <?php
					}
					?>
                    </div>
                    <div class="htladrs1">
                    	 <?php echo $hotel_location; ?>
                    </div>
                    <div class="clear"></div>
                    <span class="smalhotldesc">
                         	
                            <h1>Hotel Description:</h1>
                            <?php echo html_entity_decode($hotel_description); ?>
                            <!--<h1>Hotel Area:</h1>
                            <?php echo html_entity_decode($hotel_area); ?>
                            <h1>Hotel Room:</h1>
                           <?php echo html_entity_decode($hotel_room); ?>-->
                         </span>
                    <!--<div class="clear"></div>
                    <div class="majorfaci">
                    	 <ul>
                            <li class="facility wifi"><strong>Free Wifi</strong></li>
                            <li class="facility aircondition"><strong>A/c</strong></li>
                            <li class="facility swimpol"><strong>Swimming Pool</strong></li>
                            <li class="facility wifi"><strong>Free Wifi</strong></li>
                            <li class="facility aircondition"><strong>A/c</strong></li>
                            <li class="facility swimpol"><strong>Swimming Pool</strong></li>
                            <li class="morefac"><a>More</a></li>
                        </ul>
                    </div>
                     <div class="clear">	</div>
                    <div class="rowhtl">
                    	<div class="col-md-6 nopad">
                        	<div class="inpadcol">
                            	<div class="ratingful">87%
                                	<span class="rateofsmly"><img src="<?php echo ASSETS;?>images/user-rating-4.png" alt="" /></span>
                                </div>
                                <p>of guests recommend</p>
                            </div>
                        </div>
                        <div class="col-md-6 nopad">
                        	<div class="inpadcol">
                            	<div class="ratingful">4.2<strong>out of 5</strong></div>
                                <p>Guest rating</p>
                            </div>
                        </div>
                    </div>-->
                    <div class="clear"></div>
                    <br><br><div class="clear"></div><form action="<?php echo WEB_URL.'/hotel/get_room_details'; ?>" id="cntctHst">
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
      
            
       
       
        </form><br><div class="clear"></div>
                    <div class="bokbtnwrap">
                    	<a class="htlbook">Book Now</a>
                    </div>
                    
                <?php
}
else
{
	?>
    
    <?php
	
}
?>
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
function get_rooms()
{
  var url = '<?php echo $DetailUrl;?>';
  var fromDate = $('#from').val();
  var toDate = $('#to').val();
  var roomc = 1;
  var adult3 = $('#adult option:selected').val();
  var checkin='';
  var checkout='';
  var adults='';
   
		if(fromDate!='')
		{
 		var checkin = '&checkin='+fromDate;
		}
		if(toDate!='')
		{
        var checkout = '&checkout='+toDate;
		}
 	
		if(adult3!='')
		{
    	if(<?php echo $adult; ?> > 0){
    		var adults = '&adult='+adult3;
        	
    	}
		}
		url = url+checkin+checkout+adults;
 history.pushState(null,'title',url);
 if(fromDate!='' && toDate!='')
 {
	   $("#Roominformation").show();
	   var tabtop = $(".detailtab").offset().top - 65;
		$('html, body').animate({scrollTop: tabtop
            }, 500);
		$('.tab-pane, .fulldetab .nav-tabs > li').removeClass('active');
		$('#rooms, .trooms').addClass('active');
 $.ajax({
			  type: 'POST',
			  url: '<?php echo WEB_URL; ?>/hotel/get_room_details/<?php echo $sid; ?>/<?php echo $hotelid; ?>/<?php echo $city_code; ?>/'+fromDate+'/'+toDate+'/'+adult3+'/<?php echo $roomcount; ?>',
			  data: '',
			  async: true,
			  dataType: 'json',
			  beforeSend:function(){
				  
				 $("#rooms").html('<div class="lodrefrentrev imgLoader"><div class="centerload"></div></div>');
				   $("#rooms .lodrefrentrev").fadeIn();
			 },
			success: function(data){
				
				$("#rooms").html(data.hotel_rooms_val1);
				$("#rooms .lodrefrentrev").fadeOut();
		  },

		  
		 	error:function(request, status, error){


					  }
		  
			});
 }
}
</script>