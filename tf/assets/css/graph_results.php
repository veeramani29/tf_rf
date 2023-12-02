<style>
  .graph-date {
    width: 100% !important;
  } 
  ul.first li{
	    width: 169px !important;
	}
  ul.first,
  ul.second,
  ul.first li,
  ul.second li{
    display: inline-block !important;
  }
  ul.second {
    width: auto !important;
    left: 0 !important;
  }
  ul.second li {
    width: 23px !important;
    height: auto !important;
  }
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
  .list-dash {
    border-right: 1px solid silver;
  }
  .list-dash > li {
    border-bottom: 1px dashed black;
  }
  .list-dash > li:last-child {
    border-bottom: none;
  }
 
</style>

<script type="text/javascript">
	(function($){
		$(function() {
			$(".slider1").jCarouselLite({
				btnNext: ".next1",
				btnPrev: ".prev1",
				circular: false
			});
			$(".slider2").jCarouselLite({
				btnNext: ".next",
				btnPrev: ".prev",
				scroll: 21,
				circular: false,
        beforeStart: function(a) {
			//alert(1);
          $('.prev-graph').removeClass('hidden');
        
           $('.slider2 ul').addClass('adds');
           //$('.slider2 ul').css('left',"-495px");
          
        },
        afterEnd:function (a) {
			//alert(2);
			if($('.next-graph').hasClass( "hidden" )){
			 $('.next-graph').removeClass('hidden');
		 }else{
			  $('.next-graph').addClass('hidden');
		 }
		 
		
		}
        
      });
			$(".graph-date").jCarouselLite({
				btnNext: ".next",
				btnPrev: ".prev",
        scroll: 3,
        circular: false
      });
		});

		$(function () {
			
			$(".prev").click(function() {
  if($('.slider2 ul').hasClass( "adds" )){
			 $('.slider2 ul').removeClass('adds');
		 }else{
			  $('.slider2 ul').addClass('adds');
		 }
});
		});
	})(jQuery);
</script>



<script>
	$(function() {

  //FLEX CHART HEIGHT AND COLOR VARIATION BY PRAKASH
  var maxprice=0;
  $(".priceflag").each(function(){
  	if(maxprice== 0)
  	{
  		maxprice=$.trim($(this).text()).substring(1,$.trim($(this).text()).length);
  	}
  	else if(maxprice < parseInt($.trim($(this).text()).substring(1,$.trim($(this).text()).length)) )
  	{
  		maxprice=parseInt($.trim($(this).text()).substring(1,$.trim($(this).text()).length));
  	}
  });
  $(".priceflag").each(function(){
  	var height = $.trim($(this).text()).substring(1,$.trim($(this).text()).length) / maxprice * 200;
  	$(this).siblings('span:first').animate({
  		height : height+'px'
  	});
  });
  var prices = $('.priceflag').map(function() {
  	return $.trim($(this).text()).match(/(\d+\.\d{2})/)[1];
  }).get();
  var min = Math.min.apply(null, prices);
  $( "span:contains('"+min+"')" ).siblings('span').addClass('lowest').css( "background-color", "#00C12B" );

  //SELECTED DATE COLOR PICKER CODE BY PRAKASH
  var selected_date = $('.mnt-clas').text().replace(/ /g,'');
  $('.colr-he').each(function(){
  	var date = this.id.split(',')[0].replace(/ /g,'');
  	if($.trim(selected_date).toLowerCase() == $.trim(date).toLowerCase()){
  		$(this).css("background-color", "#4793DE");
  	}
  });
});



</script>

<?php 

 if($request->type == 'R'){
$graph_flights = json_decode(json_encode($graph_flights));
if($graph_flights!=''){
$i=0;

foreach($graph_flights as $graph_flight){
 $onward_first_seg = reset($graph_flight->onward->segments);
 $onward_last_seg = end($graph_flight->onward->segments);
 $return_first_seg = reset($graph_flight->return->segments);
 $return_last_seg = end($graph_flight->return->segments);

 $on_first_seg[]=$onward_first_seg->Carrier;
 $on_sec_seg[]=$onward_last_seg->Carrier;
 $ret_first_seg[]=$return_first_seg->Carrier;
 $ret_last_seg[]=$return_last_seg->Carrier;
 $i++;}


 $all_flight_ico=array_unique(array_merge($on_first_seg,$on_sec_seg,$ret_first_seg,$ret_last_seg));

 $all_img_count=count($all_flight_ico);
}
}

$origin = $request->origin;
$destination = $request->destination;


 if($request->type != 'M' && $flex_air_segment_date!=''){  

?>

 <div class="chart">
	  <div class="date head">Vluchten voor <span style="color:#4793de"><?=$this->flight_model->get_airport_cityname($origin).' ('.$origin.')'?> - <?=$this->flight_model->get_airport_cityname($destination).' ('.$destination.')'?></span></div>
   
   <ul class="legend list-unstyled">
    <li><span class="lowest_fare"></span>Lowest Fare Per Week</li>
    <li><span class="selected_date"></span>Selected Date of Journey</li>
    <li><span class="normal_fare"></span>Normal Fare Per Week</li>
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
     <?php  if($request->type == 'O'){  ?>
     <div class="slider1 inputsDiv" <?php if($request->type == 'O'){ echo "style='margin-left: 50px;'"; } elseif ($request->type == 'R') { echo "style='margin-left: 15px;'"; }?>>
       <ul>
        <?php
        if($flex_air_segment_date){
         foreach ($flex_air_segment_date as $key => $value) {
          $timestamp = strtotime($key);
          $dt1=date("d M Y", $timestamp);
          if($value == '0'){
           ?>
           <li style="padding: 0 2px;">
            <a href="javascript:void(0);"><span class="" jt="onward"></span>
             <img src="<?php echo WEB_URL; ?>/images/search-icon.png" style="height:25px;width:30px;"/></a>
             <span class="datrs"><?=explode("-", $key)[2]?></span>
             <?php
             $timestamp = strtotime($key);
             $day = date('D', $timestamp);
             ?>
             <span class="cntir"><?=$day?></span>
           </li>
           <?php
         }else{
          ?>
          <li>
           <a href="javascript:void(0);" ><span class="priceflag" jt="onward">&euro;<?=str_replace("EUR","",$value)?></span><span class="colr-he heit-sm3"   id="<?=$dt1?>, &euro;<?=str_replace("EUR","",$value)?>" title="<?=$dt1?>, &euro;<?=str_replace("EUR","",$value)?>"></span></a>
           <span class="datrs"><?=explode("-", $key)[2]?></span>
           <?php
           $timestamp = strtotime($key);
           $day = date('D', $timestamp);
           ?>
           <span class="cntir"><?=$day?></span>
         </li>
         <?php
       }
     }
   }else{
    for($i=0;$i<7;$i++){
     ?>
     <li style="padding: 0 2px;">
      <a href="javascript:void(0);"><span class="" jt="onward"></span>
       <img src="<?php echo WEB_URL; ?>/images/search-icon.png" style="height:25px;width:30px;"/></a>
       <span class="datrs"></span>
       <span class="cntir"></span>
     </li>
     <?php
   } 
 }
 ?>
</ul>
<?php
$timestamp = $request->depart_date;

$start = strtotime($timestamp);
$start = date('d M Y', $start);
?>
<span class="mnt-clas"><?=$start?></span>

</div><!--slider-->

<?php }elseif($request->type == 'R'){
 ?>
 <div class="prev prev-graph hidden">
  <i class="fa fa-angle-left fa-3x"></i>
</div>
<div class="slider2 inputsDiv col-md-12" <?php if($request->type == 'O'){ echo "style='margin-left: 50px;'"; }?>>

  <ul>
   <?php
   if($flex_air_segment_date){
    foreach ($flex_air_segment_date as $key => $value) {
     if($value['price'] == '0'){
      ?>
      <li style="padding: 0 2.5px; margin: 0 2.5px;">
       <a href="javascript:void(0);"><span class="" jt="onward"></span>
        <img src="<?php echo WEB_URL; ?>/images/search-icon.png" style="height:25px;width: 25px;"/></a>
        <span class="datrs"></span>
        <span class="cntir"></span>
      </li>
      <?php
    }else{
     ?>
     <li style="padding: 0 2.5px; margin: 0 2.5px;">
      <a href="javascript:void(0);"><span class="priceflag" jt="onward">
       <?php
       $timestamp = strtotime($value[0]);
       $timestamp1 = strtotime($value[1]);
       $day = date('d M Y', $timestamp);
       $day1 = date('d M Y', $timestamp1);
       ?>
       &euro;<?=str_replace("EUR","",$value['price'])?></span><span class="colr-he heit-sm3 round_colr-he"  id="<?=$day?>-<?=$day1?>, &euro;<?=str_replace("EUR","",$value['price'])?>" title="<?=$day?> - <?=$day1?>, &euro;<?=str_replace("EUR","",$value['price'])?>"></span></a>

       <span class="datrs"></span>
       <span class="cntir"></span>
     </li>
     <?php
   }
 }
}else{
  for($i=0;$i<48;$i++){
   ?>
   <li style="padding: 0 2.5px; margin: 0 2.5px;">
    <a href="javascript:void(0);"><span class="" jt="onward"></span>
     <img src="<?php echo WEB_URL; ?>/images/search-icon.png" style="height:25px;width:25px;"/></a>
     <span class="datrs"></span>
     <span class="cntir"></span>
   </li>
   <?php
 } 
}
?>
</ul>
<?php
$timestamp = $request->depart_date;
$timestamp1 =$request->return_date;
$start = strtotime($timestamp);
$return = strtotime($timestamp1);
$start = date('d M Y', $start);
$return = date('d M Y', $return);
?>
<span class="mnt-clas"><?=$start?> - <?=$return?></span>

<?php

$from_date=$request->depart_date;
$to_date=$request->return_date;

$dep=strtotime($request->depart_date);
$ret = strtotime($request->return_date);
$datediff = $ret - $dep;
$betweendate=floor($datediff/(60*60*24));

		
$actual_depdateArr=array();
$Comp_depdateArr=array();
for($d=0;$d<=$betweendate;$d++){
 $sample_timestamp = DateTime::createFromFormat('d-m-Y', $from_date)->format('d-m-Y');
   $actual_depdate=date('d-m-Y', strtotime(''.$d.' day', strtotime($sample_timestamp)));
  $actual_depdateArr[]=$actual_depdate;
  for($a=-3;$a<4;$a++){
    $timestamp = DateTime::createFromFormat('d-m-Y', $to_date)->format('Y-m-d');

    $Comp_depdateArr[$actual_depdate][]=date('d M', strtotime(''.$a.' day', strtotime($timestamp)));
  }
}
?>
</div> <!--slider2-->
<div class="next next-graph">
  <i class="fa fa-angle-right fa-3x"></i>
</div> 

<div class="row border-style-graph-info">
	<div class="col-sm-3 col-md-2 padding-right-null">
		<ul class="list-unstyled text-uppercase text-left text-primary list-dash">
			<li class="padding-tb-10"><b><small>Departure</small></b></li>
			<li class="padding-tb-10"><b><small>Return</small></b></li>
			<li class="padding-tb-10"><b><small>Airline</small></b></li>
		</ul>
	</div>
	<div class="col-sm-9 col-md-10 padding-left-null">
		<div class="graph-date">
     <ul class="first">
       <?php foreach($actual_depdateArr as $first_date){?>
       <li style="border-right: 1px solid silver; width: 169px !important;">
         <div class="padding-tb-10" style="border-bottom: 1px dashed black;"><b><?php echo $first_date; ?></b></div>
         <?php //$second=$Comp_depdateArr[$first_date];?>
         <ul class="second">
          <?php $img=0;foreach($Comp_depdateArr[$first_date] as $second_date){?>
          <li>
           <?php echo $second_date;?>
           <?php $flight_image=$all_flight_ico[array_rand($all_flight_ico)]; ?>
           <hr style="border-top: 1px dashed black;margin:0;">
           <p style="margin-top: 10px;"><img src="<?php echo ASSETS;?>images/airline_logo/<?php echo $flight_image;?>.gif"  alt=""></p>
         </li>
         <?php $img++;} ?>
       </ul>
     </li>
     <?php } ?>
   </ul>
   <?php
 }
 ?>
</div>
</div>
</div>
<div class="clearfix"></div>
</div><!--mars-new-->
</div><!--mars-new-->
</div><!--wrap-->
</div><!--chart-->
<?php } ?>

<script>

	$(document).ready(function(){

		$('.colr-he').click(function(){

			$('.colr-he').each(function(i,ele){
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
			$('#hidden_from').val($.datepicker.formatDate('dd-mm-yy', new Date(date1.split('-')[0])));
			$('#hidden_toDate').val($.datepicker.formatDate('dd-mm-yy', new Date(date1.split('-')[1])));
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
