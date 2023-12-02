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
	<div class='col-xs-7 col-sm-6'>
		<strong><?php echo lang_line('OFFER'); ?> : <span class='blue-text'><?php echo $disc_origin_city;?> - <?php echo $disc_destination_city;?></span> </strong>
	</div>
	<div class="col-xs-5 col-sm-6">
		<div class='col-xs-11 text-right'>		
			<?php  $fli_img=explode(",", $flight_img[0]['airline_code']); foreach ($fli_img as $fli_img) { ?>
			<img src="<?php echo ASSETS;?>images/airline_logo/<?php echo $fli_img. '.gif'; ?>" alt="<?php  echo $fli_img;  ?>">
			<?php } ?>
			
		</div>
	</div>
</div>
<!-- Header Ends -->
<hr>
<!-- Form Starts -->
<form method='POST' id='flightdeals' action="<?php echo WEB_URL;?>/flight/search_flight">
	<input id="trip_type" type="hidden" value="<?php echo ($flight_details[0]['type']=="R")?"circle":"oneway";?>" name="trip_type">
	<input  type="hidden" value="<?php echo $disc_origin;?>" name="from">
	<input  type="hidden" value="<?php echo $disc_destination;?>" name="to">

	<input  type="hidden" value="<?php echo $disc_price;?>" name="disc_price">
	
	<input  type="hidden" value="<?php echo $flight_details[0]['airline_code'];?>" name="Carriers">
	<input  type="hidden" value="<?php echo $disc_povider;?>" name="provider">
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
						<input type="text" class="form-control full_width input_calender first" name='depature' id="of_depature" placeholder="dd/mm/yy" value="" required>
					</div>
					<?php if($flight_details[0]['type']=="R"){ ?>
					<div class="form-group col-xs-6 sm1padr0">
						<label> <?php echo lang_line('RETURNING');?></label><br>
						<input type="text" class="form-control full_width input_calender second" id="of_return" name='return' placeholder="dd/mm/yy" value="" required>
					</div>
					<?php } ?>
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
										<li class="divider1"></li>
										<li><span> <?php echo lang_line('INF_DET');?></span>
											<select name="infant" id="of_infant" class="input_caretdown">
												<?php for ($i=0; $i <2; $i++) { ?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?> 
											</select>
										</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
				</div>
				<div class="form-group col-xs-12 col-md-3 padd_l">
					<ul class="normal-list dealsbook_button">
						<li>
							<h5 class="pricedeals"><strong><?php echo CURR_ICON;?> <?php echo $disc_price;?></strong></h5>
						</li>
						<li>
						<?php  if($flight_details[0]['type']=="R"){ ?>
							<h6><?php echo lang_line('PPR');?></h6>
						<?php }else{ ?>
<h6><?php echo lang_line('PPS');?></h6>
							<?php } ?>
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


	//Adult Child Combination Validation Starts
$("ul.drop-spot").on("change","#of_adult",function(){
	
  off_persons();
  var adult = +$(this).val();
  var max = 9;
  var child = max-adult;

  var $childs = '';
  for (i=0; i<=child; i++) {
    $childs += '<option>'+i+'</option>';
  }
  $('#of_child').html($childs);

  var $infants = '';
  for (i=0; i<=adult; i++) {
    $infants += '<option>'+i+'</option>';
  }
   
  $('#of_infant').html($infants);
  off_persons();
});
$("ul.drop-spot").on("change","#of_child",function(){
  off_persons();
});
$("ul.drop-spot").on("change","#of_infant",function(){
  off_persons();
});
function off_persons(){
  var adult = $("#of_adult").val();
  var chid = $("#of_child").val();
  var infant = $("#of_infant").val();
 
var persons = +adult + +chid + +infant;
 
  $('#off_persons').val(persons);
}
	
	$('#flightdeals').validate({ // initialize plugin within DOM ready
	 // other options,
	 rules: {
	 	'from[]': {
	 		required: true
	 	}
	 },

	 submitHandler: function() { 
	 	var action = $("#flightdeals").attr('action');
	 	$.ajax({
	 		type: "POST",
	 		url: action,
	 		data: $("#flightdeals").serialize(),
				//dataType: "json",
				beforeSend: function(XMLHttpRequest){
					$('.imgLoader').fadeIn();
					$('#DealsModal').modal('hide');
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
	// two calender date picker media query javascript start
	var mq = window.matchMedia( "(min-width: 501px)" );
	if (mq.matches) {
		var noofmonth = 2;
	}
	else {
		var noofmonth = 1;
	}
	// two calender date picker media query javascript end

	$( "#of_depature" ).datepicker({
	minDate: 0,
	numberOfMonths: noofmonth,
	dateFormat: 'dd/mm/yy',
	maxDate: "+1y",
	onClose: function( selectedDate ) {
		
        $( "#of_return" ).datepicker( "option", "minDate", selectedDate );
		$( '#of_return' ).focus();
	},
	
	beforeShowDay: function (date) {
		var myDate=$("#of_depature" ).val();
		myDate=myDate.split("/");
		var date1 =  new Date(myDate[2], myDate[1]-1, myDate[0]);
		var myDate=$("#of_return" ).val();

		
			myDate=myDate.split("/");
		
		
		var date2 = new Date(myDate[2], myDate[1]-1, myDate[0]);
		
		if (date1!="" && date2!="" && date >= date1 && date <= date2) {
			return [true, 'highlightedDates-ui', ''];
		}
		return [true, '', ''];
	}
});

$( "#of_return" ).datepicker({
	minDate: 0,	
	numberOfMonths: noofmonth,
	dateFormat: 'dd/mm/yy',
	maxDate: "+1y",
	onClose: function( selectedDate ) {		
		$( "#of_depature" ).datepicker( "option", "maxDate", selectedDate );
	},
	
beforeShowDay: function (date) {
		var myDate=$("#of_depature" ).val();
		myDate=myDate.split("/");
		var date1 =  new Date(myDate[2], myDate[1]-1, myDate[0]);
		var myDate=$("#of_return" ).val();
	
	
			myDate=myDate.split("/");
	
		
		var date2 = new Date(myDate[2], myDate[1]-1, myDate[0]);
		
		if (date1!="" && date2!="" && date >= date1 && date <= date2) {
			return [true, 'highlightedDates-ui', ''];
		}
		return [true, '', ''];
	}
}); 
});
</script>