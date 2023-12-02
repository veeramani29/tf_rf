<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>InnoGlobe - Edit Price Manager ::</title>
<meta name="description" content="">

<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap-responsive.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.fancybox.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/uniform.default.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.cleditor.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.plupload.queue.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.tagsinput.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.ui.plupload.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/chosen.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/chosen.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css">
<link rel="stylesheet" href="<?=base_url();?>css/jquery-ui.css" />
<script src="<?=base_url();?>assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>assets/javascripts/jquery/jquery-ui.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){

	    $("#datepicker").datepicker({
	        minDate: 0,
	        onSelect: function(selected) {
	          $("#datepicker1").datepicker("option","minDate", selected)
	        }
	    });
	    $("#datepicker1").datepicker({
	        numberOfMonths: 1,
	        onSelect: function(selected) {
	           $("#datepicker").datepicker("option","maxDate", selected)
	        }
	    }); 


	      $("#datepicker12").datepicker({
	        minDate: 0,
	        onSelect: function(selected) {
	          $("#datepicker13").datepicker("option","minDate", selected)
	        }
	    });
	    $("#datepicker13").datepicker({
	        numberOfMonths:1,
	        onSelect: function(selected) {
	           $("#datepicker12").datepicker("option","maxDate", selected)
	        }
	    }); 
	    


        $( "#datepicker2" ).datepicker({
        numberOfMonths: 1,
        dateFormat: 'dd-mm-yy',
        minDate: 0
        });

        $( "#datepicker3" ).datepicker({
        numberOfMonths: 1,
        dateFormat: 'dd-mm-yy',
        
        minDate: 1
        });

       
           $('#datepicker2').change(function(){
        //$t=$(this).val();
        var selectedDate = $(this).datepicker('getDate');
        var str1 = $( "#datepicker3" ).val();
        
        var predayDate  = dateADD(selectedDate);
        var str2 = zeroPad(predayDate.getDate(),2)+"-"+zeroPad((predayDate.getMonth()+1),2)+"-"+(predayDate.getFullYear());
        
        var dt1  = parseInt(str1.substring(0,2),10);
        var mon1 = parseInt(str1.substring(3,5),10);
        var yr1  = parseInt(str1.substring(6,10),10);
        var dt2  = parseInt(str2.substring(0,2),10);
        var mon2 = parseInt(str2.substring(3,5),10);
        var yr2  = parseInt(str2.substring(6,10),10);
        var date1 = new Date(yr1, mon1, dt1);
        var date2 = new Date(yr2, mon2, dt2);
        if(date2 < date1)
        {
        
        }
        else
        {
        var nextdayDate  = dateADD(selectedDate);
        var nextDateStr = zeroPad(nextdayDate.getDate(),2)+"-"+zeroPad((nextdayDate.getMonth()+1),2)+"-"+(nextdayDate.getFullYear());
        
        $t = nextDateStr;
                $( "#datepicker3" ).datepicker({
                    numberOfMonths: 3,
                    dateFormat : 'dd-mm-yy',
                    minDate: 1
                });
        $( "#datepicker3" ).val($t);
        // $('#datepicker1').datepicker('option', 'minDate', $t);s
        }
        });
        
        $('#datepicker3').change(function(){
        //$t=$(this).val();
        
        var selectedDate = $(this).datepicker('getDate');
        var str1 = $( "#datepicker2" ).val();
        
        var predayDate  = dateADD1(selectedDate);
        var str2 = zeroPad(predayDate.getDate(),2)+"-"+zeroPad((predayDate.getMonth()+1),2)+"-"+(predayDate.getFullYear());
        
        
        var dt1  = parseInt(str1.substring(0,2),10);
        var mon1 = parseInt(str1.substring(3,5),10);
        var yr1  = parseInt(str1.substring(6,10),10);
        var dt2  = parseInt(str2.substring(0,2),10);
        var mon2 = parseInt(str2.substring(3,5),10);
        var yr2  = parseInt(str2.substring(6,10),10);
        var date1 = new Date(yr1, mon1, dt1);
        var date2 = new Date(yr2, mon2, dt2);
        if(date2 < date1)
        {
        var nextdayDate  = dateADD1(selectedDate);
        var nextDateStr = zeroPad(nextdayDate.getDate(),2)+"-"+zeroPad((nextdayDate.getMonth()+1),2)+"-"+(nextdayDate.getFullYear());
        
        $t = nextDateStr;
                $( "#datepicker2" ).datepicker({
                    numberOfMonths: 3,
                    dateFormat : 'dd-mm-yy',
                    minDate: 0
                });
        $( "#datepicker2" ).val($t);
        }
        else
        {
        }
        });
	});
</script>

<script>
        function zeroPad(num,count)
        {
        var numZeropad = num + '';
        while(numZeropad.length < count) {
        numZeropad = "0" + numZeropad;
        }
        return numZeropad;
        }
        function dateADD(currentDate)
        {
        var valueofcurrentDate=currentDate.valueOf()+(24*60*60*1000);
        var newDate =new Date(valueofcurrentDate);
        return newDate;
        }
        function dateADD1(currentDate)
        {
	        var valueofcurrentDate=currentDate.valueOf()-(24*60*60*1000);
	        var newDate =new Date(valueofcurrentDate);
	        return newDate;
        }
    
	function getDates() {
			var sd = $("#datepicker2").val();
			var ed = $("#datepicker3").val(); 
			if(sd == ''){
				alert("Please select from date");
				return false;
			}
			if(ed == ''){
				alert("Please select end date");
				return false;
			}
			var selectedDays = new Array();
			var j=0;
			for(var i=0; i < document.form1.day.length; i++){
				if(document.form1.day[i].checked == true){
					selectedDays[j]=document.form1.day[i].value;
					j++;			
				}
			}
			var sd1 = new Array();
			var ed1 = new Array();
			for(var p=0; p < document.form1.datepicker2.length; p++)
			{
				sd1[p]=document.form1.datepicker2[p].value;
			}
			for(var q=0; q < document.form1.datepicker3.length; q++)
			{
				ed1[q]=document.form1.datepicker3[q].value;
			}
			if(sd1 == '')
			{
				sd1 = sd;
			}
			if(ed1 == '')
			{
				ed1 = ed;
			}
			if(selectedDays == ''){ selectedDays = 'All'; }
			$.post( "<?php echo base_url(); ?>index.php/crs/getDates", {mmsd:sd1, mmed:ed1, selectedDays:selectedDays},
			  function(data) {
				if(data != ''){
					$("#filtering").show();
					$("#monthDates").html('');
						for(var i=0; i<data.dates.length; i++){
						var day1 = data.dates[i].toString().split(",");
						var day = day1.toString().split(" ");
						$("#monthDates").append('<tr style="border-top:solid 1px #deab6f; border-bottom:solid 1px #deab6f; padding-bottom:2px;"><td  style="border-right:solid 1px #deab6f; text-align:left; width:8%;font-size:11.5px;" id="tdtd">'+data.dates[i]+'<input type="hidden" name="dates[]" value="'+day[0]+'"><input type="hidden" name="weekday[]" value="'+day[1]+'"></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="price[]" type="text" class="input-field"  style="height:20px;width:80px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="extra_bed_price[]" type="text" class="input-field"  style="height:20px;width:80px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="avail[]" type="text" class="input-field"  style="height:20px;width:80px;background:#F2F2F2;"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="adult[]" type="text" id="adult[]" class="input-field" style="height:20px;width:80px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="child[]" type="text"  id="child[]" class="input-field"  style="height:20px;width:80px;background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="child_price[]" type="text" class="input-field"  style="height:20px;width:80px;background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="infant[]" type="text" class="input-field"  style="height:20px;width:80px;background:#F2F2F2;" size="5"/></td></tr>');
					}
				} 
			  }
			);
	}
	function check_new(){
		$price = $('#price').val();
		$extra_bed_price = $('#extra_bed_price').val();
		$avail = $('#avail').val();
		$adult = $('#adult').val();
		$child = $('#child').val();
		$child_price = $('#child_price').val();
		$infant = $('#infant').val();
		$sup_charge = $('#sup_charge').val();
		if($avail!=''){
			$('input[name="avail[]"]').each(function(){
			 $('input[name="avail[]"]').val($avail);
			});
		}
		if($price!=''){
			$('input[name="price[]"]').each(function(){
			 $('input[name="price[]"]').val($price);
			});
		}
		if($extra_bed_price!=''){
			$('input[name="extra_bed_price[]"]').each(function(){
			 $('input[name="extra_bed_price[]"]').val($extra_bed_price);
			});
		}
		if($adult!=''){
			$('input[name="adult[]"]').each(function(){
			 $('input[name="adult[]"]').val($adult);
			});
		}
		if($child!=''){
			$('input[name="child[]"]').each(function(){
			 $('input[name="child[]"]').val($child);
			});
		}
		if($child_price!=''){
			$('input[name="child_price[]"]').each(function(){
			 $('input[name="child_price[]"]').val($child_price);
			});
		}
		if($infant!=''){
			$('input[name="infant[]"]').each(function(){
			 $('input[name="infant[]"]').val($infant);
			});
		}
		if($sup_charge!=''){
			$('input[name="sup_charge[]"]').each(function(){
			 $('input[name="sup_charge[]"]').val($sup_charge);
			});
		}
	}
	function getRoomType()
	{
		var hotel_id = $('#hotel_name').val();
		$.get( "<?php echo base_url(); ?>index.php/crs/getRoomType/"+hotel_id, 
		function(data){
			if(data != ''){
				var roomTypelist='';
				var roomTypeCapacitylist='';
				
				roomTypelist += '<select name="room_type" id="room_type" class="ma_pro_txt">';
				for(var i=0;i<data.roomTypes.length;i++) {
				roomTypelist += '<option value="'+data.roomTypes[i].hotel_room_type+'">'+data.roomTypes[i].hotel_room_type+'</option>'
				}
				roomTypelist += '</select>'
				
				roomTypeCapacitylist += '<select name="capacity_type" id="capacity_type" class="ma_pro_txt">';
				for(var i=0;i<data.roomTypesCapacity.length;i++) {
				roomTypeCapacitylist += '<option value="'+data.roomTypesCapacity[i].capacity_title+'('+data.roomTypesCapacity[i].capacity+','+data.roomTypesCapacity[i].child_capacity+')">'+data.roomTypesCapacity[i].capacity_title+'('+data.roomTypesCapacity[i].capacity+','+data.roomTypesCapacity[i].child_capacity+')</option>'
				}
				roomTypeCapacitylist += '</select>'
				
				$('#roomTypes').html(roomTypelist);
				$('#roomTypeCapacity').html(roomTypeCapacitylist);
			}else{
				$('#roomTypes').html('Sorry No Room Category found in this hotel !');
				$('#roomTypeCapacity').html('Sorry No Room Type found in this hotel !');
			}
		});return false;
	}
	$(document).ready(function(){	
	var sd = $("#datepicker2").val();
	var ed = $("#datepicker3").val(); 
	if(sd == ''){
		alert("Please select from date");
		return false;
	}
	if(ed == ''){
		alert("Please select end date");
		return false;
	}
	var selectedDays = new Array();
	var j=0;
	for(var i=0; i < document.form1.day.length; i++){
		if(document.form1.day[i].checked == true){
			selectedDays[j]=document.form1.day[i].value;
			j++;			
		}
	}
	$.post( "<?php echo base_url(); ?>index.php/crs/getAvailDates", {mmsd:sd, mmed:ed, rate_id:<?php echo $sup_rate_tactics_id; ?>, selectedDays:selectedDays},
      function(data) {
		if(data != ''){
			$("#filtering").show();
			$("#monthDates").html('');
			for(var i=0; i<data.avail_dates.length; i++){
				$("#monthDates").append('<tr style="border-top:solid 1px #deab6f; border-bottom:solid 1px #deab6f; padding-bottom:2px;"><td  style="border-right:solid 1px #deab6f; text-align:left; width:10%; font-size:11.5px;" id="tdtd">'+data.avail_dates[i].day+'-'+data.avail_dates[i].month+'-'+data.avail_dates[i].year+' '+data.avail_dates[i].week_day+'<input type="hidden" name="dates[]" value="'+data.avail_dates[i].date+'"><input type="hidden" name="weekday[]" value="'+data.avail_dates[i].week_day+'"></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="price[]" type="text" class="input-field"  style="height:20px;width:85px;background:#F2F2F2;" value="'+data.avail_dates[i].rate+'"/></td><td style="border-right:solid 1px #deab6f; text-align:center;width:10%;" id="tdtd3"><input name="extra_bed_price[]" type="text" class="input-field"  style="height:20px;width:80px;background:#F2F2F2;" value="'+data.avail_dates[i].extra_bed_price+'"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="avail[]" type="text" class="input-field"  style="height:20px;width:80px;background:#F2F2F2;" value="'+data.avail_dates[i].available_rooms+'"/></td><td style="border-right:solid 1px #deab6f; text-align:center;width:10%;" id="tdtd3"><input name="adult[]" type="text"  id="adult[]" class="input-field"  style="height:20px;width:80px;background:#F2F2F2;"  value="'+data.avail_dates[i].adult+'"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="child[]" type="text"  id="child[]" class="input-field"  style="height:20px;width:80px;background:#F2F2F2;" value="'+data.avail_dates[i].child+'"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="child_price[]" type="text" class="input-field"  style=" height:20px;width:80px;background:#F2F2F2;" value="'+data.avail_dates[i].child_charge+'"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="infant[]" type="text" class="input-field"  style=" height:20px;width:80px;background:#F2F2F2;" value="'+data.avail_dates[i].infant+'"/></td> <td style="border-right:solid 1px #f8d1a3; text-align:center; width:9%; ">&nbsp;</td></tr>');
			}
		} 
	  }
	);
} 
);
</script>


</head>
<body>
<?php $this->load->view('header'); ?>
<div class="breadcrumbs">
	<div class="container-fluid">
		<ul class="bread pull-left">
			<li>
				<a href="<?php echo site_url();?>/home"><i class="icon-home icon-white"></i></a>
			</li>
			<li>
				<a href="<?php echo site_url();?>/home">
					Dashboard
				</a>
			</li>
		</ul>

	</div>
</div>
<div class="main">
	<?php echo $this->load->view('leftpanel'); ?>
	<div class="container-fluid">
		<div class="content">
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-content box-nomargin">
							<div class="tab-content">
								<div class="tab-pane active" id="promotion-list">
								  <div class="box-head tabs">
											<h3>&nbsp;Edit Hotel Price</h3>
											<h3 style="float:right;"><a href="<?php echo site_url();?>/crs/price_list" style="color:#999999;text-decoration: none;"> Back </a>&nbsp;&nbsp;</h3>                           
									</div><br/>
									<form name="form1" class="form-horizontal" enctype="multipart/form-data" action="<?php echo site_url(); ?>/crs/edit_rate_plan" method="post">
										<fieldset>
										 <div class="control-group">
											<label class="control-label" for="disabledInput">Hotel Name </label>
											<div class="controls"> 
												<select name="hotel_name" id="hotel_name" class="ma_pro_txt" onChange="getRoomType();">
													<option value="">Select Hotel</option>
													<?php
														$all_hotels = $this->Crs_Model->view_all_hotels();
														for($i=0;$i<count($all_hotels);$i++){
															if($all_hotels[$i]->status==1){
													?>
													<option  value="<?php  echo $all_hotels[$i]->sup_hotel_id; ?>" <?php if(isset($rat_tac_details->hotel_id) && $rat_tac_details->hotel_id == $all_hotels[$i]->sup_hotel_id) { echo "selected='selected'"; } ?>><?php echo $all_hotels[$i]->hotel_name.' - '.$all_hotels[$i]->city_country_name; ?></option>
													<?php } } ?>
												</select>				  
											</div>
										  </div> 
										  
										  <div class="control-group">
											<label class="control-label" for="disabledInput">Room Category </label>
											<div class="controls" id="roomTypes">
												<input class="input-xlarge focused" id="room_type" type="text" name="room_type" value="<?=@$rat_tac_details->category_type; ?>" required>             
											</div>
										  </div>
										  
										   <div class="control-group">
											<label class="control-label" for="disabledInput">Room Type </label>
											<div class="controls" id="roomTypeCapacity" >
											  <input class="input-xlarge focused" id="capacity_type" type="text" name="capacity_type" value="<?=@$rat_tac_details->room_type; ?>" required>             
											</div>
										  </div>
										  
										  <div class="control-group">
											<label class="control-label" for="disabledInput">Room Image </label>
											<div class="controls">
											  <input class="input-xlarge focused" id="filepath" type="file" name="filepath" value="">             
												<?php if(isset($rat_tac_details->main_image) && $rat_tac_details->main_image!= '') 
														{ ?>
													<br/><br/><img src="<?php echo $img_path.$rat_tac_details->main_image; ?>" height=150 width=250/> 
												<?php } ?>
											</div>
										  </div>
										  
										  <div class="control-group">
											<label class="control-label" for="disabledInput">Image1 </label>
											<div class="controls">
											  <input class="input-xlarge focused" id="filepath1" type="file" name="filepath1" value="">             
												<?php if(isset($rat_tac_details->image1) && $rat_tac_details->image1!= '') 
														{ ?>
													<br/><br/><img src="<?php echo $img_path.$rat_tac_details->image1; ?>" height=150 width=250/> 
												<?php } ?>
											</div>
										  </div>
										  
										  <div class="control-group">
											<label class="control-label" for="disabledInput">Image2 </label>
											<div class="controls">
											  <input class="input-xlarge focused" id="filepath2" type="file" name="filepath2" value="">             
												<?php if(isset($rat_tac_details->image2) && $rat_tac_details->image2!= '') 
														{ ?>
													<br/><br/><img src="<?php echo $img_path.$rat_tac_details->image2; ?>" height=150 width=250/> 
												<?php } ?>
											</div>
										  </div>
										  
										   <div class="control-group">
											<label class="control-label" for="disabledInput">Image3 </label>
											<div class="controls">
											  <input class="input-xlarge focused" id="filepath3" type="file" name="filepath3" value="">             
												<?php if(isset($rat_tac_details->image3) && $rat_tac_details->image3!= '') 
														{ ?>
													<br/><br/><img src="<?php echo $img_path.$rat_tac_details->image3; ?>" height=150 width=250/> 
												<?php } ?>
											</div>
										  </div>
										  
										  <div class="control-group">
											<label class="control-label" for="disabledInput">Child Policy </label>
											<div class="controls">
											   <textarea class="input-xlarge focused" id="child_policy" name="child_policy"><?=@$rat_tac_details->child_policy; ?></textarea>				  
											</div>
										  </div> 
										   <div class="control-group">
											<label class="control-label" for="disabledInput">Cancellation Description </label>
											<div class="controls">
											   <textarea class="input-xlarge focused" id="cancel_policy_desc" name="cancel_policy_desc"><?=@$rat_tac_details->cancel_policy_desc; ?></textarea>				  
											</div>
										  </div> 
										   <div class="control-group">
											<label class="control-label" for="disabledInput">Cancellation Policy </label>
											<div class="controls">
												Nights: <input type="text" style="width:80px;" name="cancel_policy_nights" id="cancel_policy_nights" size="3" value="<?=@$rat_tac_details->cancel_policy_nights;?>" />
												Charge<input type="text" style="width:80px;" id="cancel_policy_percent" name="cancel_policy_percent" size="4" value="<?=@$rat_tac_details->cancel_policy_percent;?>"/>%&nbsp;
												or<input type="text" style="width:80px;" id="cancel_policy_charge" name="cancel_policy_charge" size="4" value="<?=@$rat_tac_details->cancel_policy_charge;?>"/>Per Night Charge&nbsp;
												From<input type="text" style="width:80px;" id="datepicker12" name="cancel_policy_from" size="7" value="<?=@$rat_tac_details->cancel_policy_from;?>"/>
												To<input type="text" style="width:80px;" id="datepicker13" name="cancel_policy_to" size="7" value="<?=@$rat_tac_details->cancel_policy_to;?>"/>
											</div>
										  </div>  
										 <div class="control-group">
											<label class="control-label" for="disabledInput">Room Available Dates</label>
											<div class="controls">
												From<input style="width:80px;" name="sd[]" id="datepicker2"  value="<?php if(isset($rat_tac_details->room_avail_date_from)){ $aFrom = explode("-", $rat_tac_details->room_avail_date_from);$aFDate=$aFrom[2].'-'.$aFrom[1].'-'.$aFrom[0]; echo $aFDate; }?>" type="text" class="b2b-txtbox"/>
												To<input style="width:80px;" name="ed[]" id="datepicker3" value="<?php if(isset($rat_tac_details->room_avail_date_to)){ $aTo = explode("-", $rat_tac_details->room_avail_date_to);$aTDate=$aTo[2].'-'.$aTo[1].'-'.$aTo[0]; echo $aTDate; }?>" type="text" class="b2b-txtbox"/><br/>
												Day&nbsp; &nbsp; &nbsp;
												<input name="day" id="dayy" type="checkbox" value="Mon" style="margin-right:5px;"/>Mon &nbsp; 
												<input name="day" id="dayy" type="checkbox" value="Tue" style="margin-right:5px;"/>Tue &nbsp;
												<input name="day" id="dayy" type="checkbox" value="Wed" style="margin-right:5px;"/>Wed &nbsp;
												<input name="day" id="dayy" type="checkbox" value="Thu" style="margin-right:5px;"/>Thu &nbsp;
												<input name="day" id="dayy" type="checkbox" value="Fri" style="margin-right:5px;"/>Fri &nbsp;
												<input name="day" id="dayy" type="checkbox" value="Sat" style="margin:5px 6px;"/>Sat &nbsp;
												<input name="day" id="dayy" type="checkbox" value="Sun" style="margin-right:5px;"/>Sun
											</div>
										  </div>  
										 <div class="form-actions">
											<button type="button" class="btn btn-primary" onClick="getDates();">Submit</button>
										</div>
										</fieldset>
									<div id="filtering" style="coloir:#fff; width:100%; background:#f8f8f8; display:none;">
										<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="display tableStatic">
											<tr style="background:#243419"  height="45">
												<td style="border-right:solid 1px #deab6f; text-align:center; padding-top:3px; color:#fff;padding:10px;">Smart Update</td>
												<td style="border-right:solid 1px #deab6f; text-align:center; padding:5px;">
													<input name="price" id="price" type="text" class="input-field"  style="height:20px; width:80px; margin-top:3px; background:#F2F2F2;" /></td>
												<td style="border-right:solid 1px #deab6f; text-align:center; padding:5px;">
													<input name="extra_bed_price" id="extra_bed_price" type="text" class="input-field"  style="height:20px;width:80px; margin-top:3px; background:#F2F2F2;" /></td>
												<td style="border-right:solid 1px #deab6f; text-align:center; padding:5px;">
													<input name="avail" id="avail" type="text" class="input-field"  style="height:20px;width:80px; margin-top:3px; background:#F2F2F2;"  onblur="checkavailcount(this.value)"/></td>
												<td style="border-right:solid 1px #deab6f; text-align:center; padding:5px;">
													<input name="adult" id="adult" type="text" class="input-field"  style="height:20px;width:80px; margin-top:3px; background:#F2F2F2;" /></td>
												<td style="border-right:solid 1px #deab6f; text-align:center; padding:5px;">
													<input name="child" id="child" type="text" class="input-field"  style="height:20px;width:80px; margin-top:3px; background:#F2F2F2;" /></td>
												<td style="border-right:solid 1px #deab6f; text-align:center; padding:5px;">
													<input name="child_price" id="child_price" type="text" class="input-field"  style="height:20px;width:80px; margin-top:3px; background:#F2F2F2;" /></td>
												<td style="border-right:solid 1px #deab6f; text-align:center; padding:5px;">
													<input name="infant" id="infant" type="text" class="input-field"  style="height:20px;width:80px; margin-top:3px; background:#F2F2F2;" /></td>
												<td style="border-right:solid 1px #deab6f; text-align:center; padding:5px;">
													<input type="button" value="Update" style="margin-top:3px;" onClick="check_new();"/></td>
											</tr>
											<tr height="30" style="font-size:12px;">
												<td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;">Dates</td>
												<td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;">Per Night Charge</td>
												<td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;">Extra Bed Charge</td>
												<td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;">Available Rooms</td>
												<td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;">Adults</td>
												<td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;">Childs</td>
												<td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;">2nd Child Charge</td>
												<td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;">Infants</td>
												<td style="border-right:solid 1px #f8d1a3; text-align:center; width:9%; ">&nbsp;</td>
											</tr>
										</table>
										<input type="hidden" name="sup_rate_tactics_id" id="sup_rate_tactics_id" value="<?=@$sup_rate_tactics_id;?>">
										<table  width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="display tableStatic" style="background:#fff; margin-top:0px;">
											<tr><td>&nbsp;</td></tr>
											<span id="monthDates">
											</span>
											<tr><td height="30" style="color:red;"><div id="rmsg"></div></td></tr>
											<input type="hidden" name="cnt" value=""/>
											<input type="hidden" name="from" id="from" value=""/>
											<input type="hidden" name="to" id="to" value=""/>
											<input type="hidden" name="room_id" id="room_id" value=""/>
											<input type="hidden" name="capacity" id="capacity" value=""/>
											<input type="hidden" name="on_req_checked" id="on_req_checked"/>
											<input type="hidden" name="on_arr_checked" id="on_arr_checked"/>
											<input type="hidden" name="on_blk_checked" id="on_blk_checked"/>
										</table>
										<div style="clear:both; height:1px;"></div>
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td align="center"><input type="image" height="38" width="38" src="<?php echo base_url(); ?>public/img/sub_mint_btn_admin.png"  /></td>
											</tr>
											<tr>
												<td height="20" colspan="2">&nbsp;</td>
											</tr>
										</table>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>	

</body>
</html>
