<style type="text/css">
.blue-text{color: #2980CD;}
.btn-sm{padding: 5px 10px !important;font-size: 12px !important;}
h5.blue-text{margin: 5px 0px;}
</style>

<?php
$disc_origin=stripslashes($flight_details[0]['origin']);
$disc_origin_city=$this->flight_model->get_airport_cityname($disc_origin);
$disc_destination=stripslashes($flight_details[0]['destination']);
$disc_destination_city=$this->flight_model->get_airport_cityname($disc_destination);
$disc_destination_country=$this->flight_model->get_airport_countryname($disc_destination);
$disc_price=stripslashes($flight_details[0]['price']);
$disc_short_desc=stripslashes($flight_details[0]['short_desc']);
$disc_trip=($flight_details[0]['type']=="R")?"Round Trip":"One Way";
$disc_trip_class=($flight_details[0]['type']=="R")?"set3":"";
$disc_povider=$flight_details[0]['provider'];
$now = time(); 
$exp_date = strtotime($flight_details[0]['exp_date']);
$datediff = $now - $exp_date;
$remain_day= floor($datediff/(60*60*24));
$discount_img=DISCOUNT_FLIGHT_SMLIMG.$flight_details[0]['small_image'];
$total_banner=count($flight_banners);
?>

<div class='row dealsmodal_header'>
	<!-- Header Starts -->
	<div class='col-xs-11 col-sm-6'>
		<strong><?php echo lang_line('OFFER'); ?> : <span class='blue-text'><?php echo $disc_origin_city;?> </span> </strong>
	</div>	
</div>
<!-- Header Ends -->
<hr>
<!-- Form Starts -->
<form method='POST' id='hoteldeals' action="<?php echo WEB_URL;?>/hotel/search">
	
	<input  type="hidden" value="<?php echo $disc_origin;?>" name="hotel_city">
	
	<input  type="hidden" value="<?php echo $disc_price;?>" name="disc_price">
	<?php $expcar=explode(",",$flight_details[0]['airline_code']); ?>
	<input  type="hidden" value="<?php echo $expcar[0];?>" name="Carriers">
	
	<div class='row'>
		<div class="col-xs-12">
			<div class="normal">
				<div class="choosefh_content">
				<div class="col-xs-6 col-md-5 padd_l">
					<div class="full-widthd">
							<p>1.<?php echo lang_line('CHOOSE_UR_FLIGHTS'); ?></p>
					</div>
					<div class="form-group col-xs-6 padd_l">
						<label> <?php echo lang_line('DEPARTING');?></label><br>
						<input type="text" class="form-control full_width input_calender first " name='hotel_checkin' id="of_depature1" placeholder="dd/mm/yy"  required>
					</div>
				
					<div class="form-group col-xs-6 sm1padr0">
						<label> <?php echo lang_line('RETURNING');?></label><br>
						<input type="text" class="form-control full_width input_calender second" id="of_return1" name='hotel_checkout' placeholder="dd/mm/yy"  required>
					</div>
					
				</div>
				<div class="form-group col-xs-6 col-md-4">
					<div class='full-widthd'>
						<p>2.<?php echo lang_line('NO_OF_PERSONS'); ?></p>
					</div>
					<div class="col-xs-6 col-sm-5 padd_l">
						<label><?php echo lang_line('PERSONS'); ?></label>
						<div class="input-wrapper drop-eft">
							<input id="off_persons" class="form-control input_caretdown" type="text" placeholder="1" name="person_select" readonly autocomplete="off">
							<ul class="drop-spot">
								<li>
									<ul>
										<li>
											<span> <?php echo lang_line('ADULTS');?></span>
											<select name="adult" id="of_adult" class="input_caretdown">
												<?php for ($i=1; $i <10 ; $i++) { ?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?> 
											</select>
										</li>
										<li class="divider1"></li>
										<li><span> <?php echo lang_line('CHILD_DET');?>   </span>
											<select name="child" id="of_child" class="input_caretdown">
												<?php for ($i=0; $i <9 ; $i++) { ?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?> 
											</select>
										</li>
										
									</ul>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-xs-6 col-sm-5 padd_l">
						<label> <?php echo lang_line('ROOMS');?></label><br>
						<select name="rooms" class="form-control full_width input_caretdown">
							<?php for ($r=1; $r <=6 ; $r++) { ?><option value="<?php echo $r;?>"><?php echo $r;?></option><?php } ?> 
						</select>
					</div>
				</div>
				</div>
				<div class="form-group col-xs-12 col-md-3 padd_l">
					<ul class="normal-list dealsbook_button">
						<li>
							<h5 class="pricedeals"><strong><?php echo CURR_ICON;?> <?php echo $disc_price;?></strong></h5>
						</li>
						
						<li>
							<button type="submit" class="btn btns-primary"><?php echo lang_line('BOOK_NOW');?></button>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- Form Ends -->
<!-- Deal Text Starts -->
<div class='col-xs-12 nopadd'>
	<div class="dealsmodal-text">
		<p><?php echo $disc_short_desc;?></p>
	</div>
	<hr>
</div>
<!-- Deal Text Ends -->


<script type="text/javascript">
$(document).ready(function() {


// two calender date picker media query javascript start
	var mq = window.matchMedia( "(min-width: 501px)" );
	if (mq.matches) {
		var noofmonth = 2;
	}
	else {
		var noofmonth = 1;
	}
	// two calender date picker media query javascript end

$( "#of_depature1" ).datepicker({
  minDate: 0,
  numberOfMonths: noofmonth,
  dateFormat: 'dd/mm/yy',
  maxDate: "+1y",
  onClose: function( selectedDate ) {
    
        $( "#of_return1" ).datepicker( "option", "minDate", selectedDate );
    $( '#of_return1' ).focus();
  },
  
  beforeShowDay: function (date) {
    var myDate=$("#of_depature1" ).val();
    myDate=myDate.split("/");
    var date1 =  new Date(myDate[2], myDate[1]-1, myDate[0]);
    var myDate=$("#of_return1" ).val();

    
      myDate=myDate.split("/");
    
    
    var date2 = new Date(myDate[2], myDate[1]-1, myDate[0]);
    
    if (date1!="" && date2!="" && date >= date1 && date <= date2) {
      return [true, 'highlightedDates-ui', ''];
    }
    return [true, '', ''];
  }
});

$( "#of_return1" ).datepicker({
  minDate: 0, 
  numberOfMonths: noofmonth,
  dateFormat: 'dd/mm/yy',
  maxDate: "+1y",
  onClose: function( selectedDate ) {   
    $( "#of_depature1" ).datepicker( "option", "maxDate", selectedDate );
  },
  
beforeShowDay: function (date) {
    var myDate=$("#of_depature1" ).val();
    myDate=myDate.split("/");
    var date1 =  new Date(myDate[2], myDate[1]-1, myDate[0]);
    var myDate=$("#of_return1" ).val();

  
      myDate=myDate.split("/");
  
    
    var date2 = new Date(myDate[2], myDate[1]-1, myDate[0]);
    
    if (date1!="" && date2!="" && date >= date1 && date <= date2) {
      return [true, 'highlightedDates-ui', ''];
    }
    return [true, '', ''];
  }
});

/*var enforceModalFocusFn = $.fn.modal.Constructor.prototype.enforceFocus;

$.fn.modal.Constructor.prototype.enforceFocus = function() {};

$('#DealsModalH').on('hidden', function() {
    $.fn.modal.Constructor.prototype.enforceFocus = enforceModalFocusFn;
});*/





	//Adult Child Combination Validation Starts
$("ul.drop-spot").on("change","#of_adult",function(){
	
  off_persons();
  var adult = +$(this).val();
  var max = 9;
  var child = max-adult;

  off_persons();
});
$("ul.drop-spot").on("change","#of_child",function(){
  off_persons();
});

function off_persons(){
  var adult = $("#of_adult").val();
  var chid = $("#of_child").val();

  var persons = +adult + +chid;

  $('#off_persons').val(persons);
}
	
	$('#hoteldeals').validate({ // initialize plugin within DOM ready
	 // other options,
	 rules: {
	 	'from[]': {
	 		required: true
	 	}
	 },

	 submitHandler: function() { 
	 	var action = $("#hoteldeals").attr('action');
	 	$.ajax({
	 		type: "POST",
	 		url: action,
	 		data: $("#hoteldeals").serialize(),
				//dataType: "json",
				beforeSend: function(XMLHttpRequest){
					$('.imgLoader').fadeIn();
					$('#DealsModalH').modal('hide');
				},
				success: function(response){
					if(response!=''){
						$('#SearchCarousel').carousel('prev');
						$('.container_flightsearch').html(response);
						$('.imgLoader').fadeOut();
					}
				}
			});
	 	return false; 	
	 }
	});
	
 
});
</script>