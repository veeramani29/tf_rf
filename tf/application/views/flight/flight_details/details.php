<?php $this->load->view('common/header'); 

 $banners = $this->Help_Model->getHomeSettings(); 

if($req->type == 'M'){
	$origin = reset($req->origin);
	$destination = end($req->destination);
	$depart_date = reset($req->depart_date);
}else{
	$origin = $req->origin;
	$destination = $req->destination;
	$depart_date = $req->depart_date;
	if($req->type == 'R'){
		$return_date = $req->return_date;
	}
}
?>




<!-- Modal -->
<div class="modal fade" id="flightFareModal" tabindex="-1" role="dialog" aria-labelledby="flightFareModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="flightFareModalLabel">Detailed Information</h4>
			</div>
			<div class="modal-body">
			</div>
		</div>
	</div>
</div>
<!-- Modal -->

<div class="full flitgray"><!-- flitgray -->
	<div class="container fordetailpage"><!-- container1 -->
		<div class="container mt15 offset-0"><!-- container2 -->
			
  <!-- WHY TICKETFINDER -->
			<div class="collapse col-md-3 filters nopad" id="mobilefilter">
			
				<ul class="side-fist">
					<span class="sid-head"><?=lang('WHY_TICKETFINDER');?></span>
					<li>
						<input id="demo_box_3000" class="css-checkbox" type="checkbox" checked="checked" />
						<label for="demo_box_3000" name="demo_lbl_3000" class="css-label"><?=lang('WT_LINE1');?></label>
					</li>
					<li>
						<input id="demo_box_3001" class="css-checkbox" type="checkbox" checked="checked" />
						<label for="demo_box_3001" name="demo_lbl_3001" class="css-label"><?=lang('WT_LINE2');?></label>
					</li>
					<li>
					<input id="demo_box_3002" class="css-checkbox" type="checkbox" checked="checked" />
						<label for="demo_box_3002" name="demo_lbl_3002" class="css-label"><?=lang('WT_LINE3');?></label>
					</li>
					<li>
						<input id="demo_box_3003" class="css-checkbox" type="checkbox" checked="checked" />
						<label for="demo_box_3003" name="demo_lbl_3003" class="css-label"><?=lang('WT_LINE4');?></label>
					</li>
				</ul>
        </div>
			<!-- WHY TICKETFINDER -->

<div class="rightcontent col-md-9 padlisting"><!-- rightcontent1-->
<div class="itemscontainer"><!-- rightcontent2-->

<div class="full moditop"> <!-- modify search -->
      <div class="container fordetailpage"><!-- modify search container1 -->
       <div class="container mt15 offset-0"><!-- modify search container2-->
        <div class="col-lg-12 col-xs-12  myadvance" ><!-- modify search col12-->

<div class="col-lg-4 col-xs-4 tabwid  nopad">
<div class="col-lg-6 col-xs-6 nopad">
<div class="padwrap">
<div class="deptimg"><img src="<?php echo ASSETS;?>images/departure.png" alt="" /></div>
<div class="deplabl"><?php echo $this->flight_model->get_airport_cityname($origin);?> (<?php echo $origin;?>)
</div>
</div>
</div>
<div class="col-lg-6 col-xs-6  nopad">
<div class="padwrap">
<div class="deptimg"><img src="<?php echo ASSETS;?>images/arrival.png" alt="" /></div>
<div class="deplabl"><?php echo $this->flight_model->get_airport_cityname($destination);?> (<?php echo $destination;?>)</div>
</div>
</div>
</div>

<div class="col-lg-8 col-xs-8 tabwid2  nopad">
<div class="col-lg-4 col-xs-3 full550  nopad">
<div class="padwrap">
<div class="tlbl"><?=lang('JOURNEY');?></div>
<div class="deptype"><?php if($req->type == 'O'){echo 'One Way';}?><?php if($req->type == 'R'){echo 'Round Trip';}?></div>
<div class="depdate"><?php echo date('d<\s\up>S</\s\up> M Y',strtotime($depart_date));?><?php if($req->type == 'R'){?> - <?php echo date('d<\s\up>S</\s\up> M Y',strtotime($return_date));}?></div>
</div>
</div>
<div class="col-lg-2 col-xs-2 full550  nopad">
<div class="padwrap">
<div class="tlbl"><?=lang('CLASS');?></div>
<div class="deptype"><?php echo (isset($req->class) && $req->class!='')?$req->class:"All";?></div>
</div>
</div>
<div class="col-lg-6 col-xs-4 full550  nopad">
<div class="padwrap">
<div class="tlbl"><?=lang('PASSENGERS');?></div>
<div class="deptype"><?php echo $req->ADT+$req->CHD+$req->INF;?></div>
<div class="leftmar ladult"><?php echo $req->ADT;?></div>
<div class="leftmar lchil"><?php echo $req->CHD;?></div>
<div class="leftmar linfant"><?php echo $req->INF;?></div>
</div>
</div>
</div>




</div><!-- modify search col12-->
</div><!-- modify search container2-->
</div><!-- modify search container-->
</div><!-- end modify search -->




<div class="clearfix"></div>




<!-- Normal flights-->
<div  class="flights">

  <?php 
  $data['flights']=$flights; $data['req']=$req; 
  if($req->type == 'O'){
  $this->load->view('flight/flight_details/oneway',$data);
}elseif($req->type == 'R'){
 $this->load->view('flight/flight_details/roundway',$data);
}else{
 $this->load->view('flight/flight_details/multiway',$data);
  }
  ?>


</div>
<!-- Normal flights End-->



<div class="clearfix"></div>



</div><!-- rightcontent2-->
</div><!-- rightcontent1-->

</div><!-- container2 -->
</div><!-- container1 -->
</div><!-- flitgray -->

<?php $this->load->view('common/footer'); ?>

<script type="text/javascript">





    //FARE RULE DIAPLAY CODE BY VEERA
    function show_fare_popup(id,el,elm){

    	$(el).append('<img class="loading" src="<?php echo ASSETS;?>images/ajax_loader1.gif" style="height:20px;"></img>');
    	$("#flightFareModal .modal-body").html('<img class="loading" src="<?php echo ASSETS;?>images/ajax_loader1.gif" style="height:30px;"></img>');

    	var formData = { fare_key: id,elm:elm };
    	$.post('flight/fareRule', formData, function (data){

    		if(data){
    			var div1 = '<div>';
    			for(var i=0;i<data.split("|@@|")[1];i++){
    				sum = i+1;
    				div1 += '<button class="btn btn-primary" id="'+data.split("|@@|")[2]+'" onclick="show_fare_popup(this.id,this,'+sum+');">Flight'+sum+'</button>  ';
    			}
    			div1 += '</div>';
    			var div2 = '<div>'+data.split("|@@|")[0]+'</div>';

    			$("#flightFareModal .modal-body").html('');
    			$("#flightFareModal .modal-body").append(div1);
    			$("#flightFareModal .modal-body").append(div2);
    			$('#flightFareModal').modal('show');
    			$(el).find('img').empty();
    			$(el).find('img').remove();

    		}else{
    			$("#flightFareModal .modal-body").html('');
    			$("#flightFareModal .modal-body").append('<div align="center">No Results Found</div>');

    		}
    	});
    }
//FARE RULE DIAPLAY CODE BY VEERA
</script>


</body>
</html>
