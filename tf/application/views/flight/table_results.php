
<style>
	
	.padding-right-null {
		padding-right: 0 !important;
	}
	.padding-left-null {
		padding-left: 0 !important;
	}
	.border-style-graph-info {
		border-top: 1px solid silver;
		border-bottom: 1px solid silver;
	}
	.padding-tb-10 {
		padding: 10px 0 !important;
	}
	

</style>



<?php

$origin = $request->origin;
$destination = $request->destination;

function oneway_faretbl($flex_air_segment_date,$request){


	if($flex_air_segment_date){
							
$result=$flex_air_segment_date;



$fare_cal='';
$fare_cal.='<table border="1" class="table table-condensed table-bordered table-hover fnt12">';
$fare_cal.='<tr>';

foreach(array_keys($result) as $city_b) { // city_b headings
if(strtotime($request->depart_date)==strtotime($city_b)) { $fare_cal.='<td style="background-color: aqua;" >DEP '.$city_b.'</td>'; }else { $fare_cal.='<td>DEP '.$city_b.'</td>'; }
}
$fare_cal.='</tr>';
$fare_cal.='<tr>';

$rr=0;
foreach($result as $key => $city_a) { // need the city_a as row index
	 $timestamp = strtotime($key);
	$dt1=date("d M Y", $timestamp);

$fare_cal.= '<td class="price"><span class="colr-he1 heit-sm3"   id="'.$dt1.', '.str_replace(CURR, "&euro;", $city_a).'" title="'.$dt1.', '.str_replace(CURR, "&euro;", $city_a).'">'.str_replace(CURR, "&euro;", $city_a).'</span></td>';  // city_a ad
$rr++;
}
$fare_cal.='</tr>';

$fare_cal.= '</table>';
return $fare_cal;
				}
}

function roundtrip_faretbl($flex_air_segment_date,$request){

	if($flex_air_segment_date){

$result=array();
foreach($flex_air_segment_date as $key => $values)
{
if($values[0]!=0 && $values[1]!=1){
$result[$values[1]][$values[0]]=$values["price"];
}
}
//echo "<pre>";
//print_r($flex_air_segment_date);die;
$fare_cal='';
$fare_cal.='<table border="1" class="table table-condensed table-bordered table-hover fnt12">';
$fare_cal.='<tr>';
$fare_cal.='<td>Outbound &rarr; <br> &darr; Inbound </td>';
foreach(array_keys(current($result)) as $city_b) { // city_b headings
if(strtotime($request->depart_date)==strtotime($city_b)) { $fare_cal.= '<td class="bg-primary"> DEPART '.$city_b.'</td>'; } else { $fare_cal.= '<td class="bg-info"> DEPART '.$city_b.'</td>'; } // city_a ad
}
$fare_cal.='</tr>';

foreach(array_keys($result) as $city_a) { // need the city_a as row index
$fare_cal.='<tr>';
if(strtotime($request->return_date)==strtotime($city_a)) { $fare_cal.= '<td class="bg-primary"> RETURN '.$city_a.'</td>'; } else { $fare_cal.= '<td clas="bg-warning" > RETURN '.$city_a.'</td>'; } // city_a ad

foreach(array_keys($result[$city_a]) as $city_b) { // need the city_b as column index

	$timestamp = strtotime($city_a);
	$dt=date("d M Y", $timestamp);

	$timestamp1 = strtotime($city_b);
	$dt1=date("d M Y", $timestamp1);
$price=str_replace(CURR, "&euro;", $result[$city_a][$city_b]);
	$fare_cal.= '<td class="price"><span class="colr-he1 heit-sm3"   id="'.$dt.'-'.$dt1.', '.$price.'" title="'.$dt.'-'.$dt1.', '.$price.'">'.$price.'</span></td>';  // city_a ad

	//if(strtotime($request->return_date)==strtotime($city_a) || strtotime($request->depart_date)==strtotime($city_b)) { $fare_cal.= '<td class="bg-success"> '.$result[$city_a][$city_b].'</td>'; } else { $fare_cal.= '<td>  '.$result[$city_a][$city_b].'</td>'; } // city_a ad

}
$fare_cal.='</tr>';
}
$fare_cal.= '</table>';


return $fare_cal;

 } 

}

	


	if($request->type != 'M' && $flex_air_segment_date!=''){

		?>

		<div class="chart">
			<div class="date head">Vluchten voor <span style="color:#4793de"><?=$this->flight_model->get_airport_cityname($origin).' ('.$origin.')'?> - <?=$this->flight_model->get_airport_cityname($destination).' ('.$destination.')'?></span></div>

			<ul class="legend list-unstyled">
				<li><span class="lowest_fare"></span>Lowest Fare Per Week</li>
				<li><span class="selected_date"></span>Selected Date of Journey</li>
				<li><span class="normal_fare"></span>Normal Fare Per Week</li>
				<li>DEP-Departure</li>
				
			</ul>

			<div id="wrap">
				<?php
				if(@!$request->return_date){
					?>
					<div class="date">
						<span style="color:#f77f00">Heenreis:</span>
						<?php
						$show_date =$request->depart_date;
						$timestamp = strtotime($show_date);
						echo date("d M Y", $timestamp);
						?>
					</div>
					<div class="mars-new clearfix text-center" id="list">
						<?php
					}
					?>
					<?php
					if(@$request->return_date){
						?>
						<div class="mars-new col-md-12 clearfix text-center" id="round_list">
							<?php
						}
						?>


						<!-- This is for graph -->
						<?php  if($request->type == 'O'){ 

//echo "<pre>";print_r($flex_air_segment_date);
							echo oneway_faretbl($flex_air_segment_date,$request);
									
									$timestamp = $request->depart_date;

									$start = strtotime($timestamp);
									$start = date('d M Y', $start);
									?>
									<span class="mnt-clas hide"><?=$start?></span>
				

								<!--slider-->

								<?php }elseif($request->type == 'R'){
									?>
									
									<div class="inputsDiv col-md-12" <?php if($request->type == 'O'){ echo "style='margin-left: 50px;'"; }?>>


												<?php echo roundtrip_faretbl($flex_air_segment_date,$request);?>
										
													<?php
													$timestamp = $request->depart_date;
													$timestamp1 =$request->return_date;
													$start = strtotime($timestamp);
													$return = strtotime($timestamp1);
													$start = date('d M Y', $start);
													$return = date('d M Y', $return);
													?>
													<span class="mnt-clas1 hide"><?=$start?> - <?=$return?></span>

													
												</div> <!--slider2-->
										
<?php } ?>
												
											<div class="clearfix"></div>
										</div><!--mars-new-->
									</div><!--mars-new-->
								</div><!--wrap-->
							</div><!--chart-->
							<?php } ?>

							<script>

								$(document).ready(function(){

									$('.colr-he1').click(function(){

										$('.colr-he1').each(function(i,ele){
											if($(ele).hasClass('lowest')){
												$(ele).css('background','none repeat scroll 0 0 #00C12B');
											}else{
												$(ele).css('background','none repeat scroll 0 0 #f77f00');
											}
										});
										var date = this.id;

										$(this).css('background','none repeat scroll 0 0 #4793DE');
										$("#ser_dt").text('');
										$('#ser_price').text('');
										$("#ser_dt").text(date.split(",")[0]);
										$("#ser_price").text("Estimated price for the selected date is: "+date.split(",")[1]);
										$('#hidden_origin').val("<?php echo $request->origin;?>");
										$('#hidden_destination').val("<?php echo $request->destination;?>");
										var date1 = date.split(",")[0];
										$('#hidden_from').val($.datepicker.formatDate('dd-mm-yy', new Date(date1.split('-')[1])));
										$('#hidden_toDate').val($.datepicker.formatDate('dd-mm-yy', new Date(date1.split('-')[0])));
										if($.datepicker.formatDate('dd-mm-yy', new Date(date1.split('-')[1])) == 'NaN-NaN-NaN'){
											$('#hidden_toDate').val('');
										}
										$('#hidden_adult_count').val("<?php echo $request->ADT;?>");
										$('#hidden_child_count').val("<?php echo $request->CHD;?>");
										$('#hidden_infant_count').val("<?php echo $request->INF;?>");
										$("#chartSearch").show();
									});

});




</script>
<!-- DONT REMOVE ---->
<?php echo "GRAPH-SECTION-FLEX-!!!!!!!!!!!!!!!!!!!!!!!!!";?>
<!-- DONT REMOVE ---->
