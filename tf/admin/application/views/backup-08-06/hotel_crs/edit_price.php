<?
//echo $sup_rate_tactics_id;;
//echo '<pre>';
//print_r($rat_tac_details->sup_rate_tactics_id);exit;
//room_avail_date_from
//room_avail_date_to
?>
<!DOCTYPE html>
<html>
<head>
 
 
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/jquery.fancybox.css">
 
 
 
 

<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/jquery-ui.css">
  <link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/style.css">


<script src="<?php echo WEB_DIR; ?>js/jquery.js"></script>
<script src="<?php echo WEB_DIR; ?>js/less.js"></script>
<script src="<?php echo WEB_DIR; ?>js/bootstrap.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.uniform.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/bootstrap.timepicker.js"></script>
<script src="<?php echo WEB_DIR; ?>js/bootstrap.datepicker.js"></script>
<script src="<?php echo WEB_DIR; ?>js/chosen.jquery.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.fancybox.js"></script>
<script src="<?php echo WEB_DIR; ?>js/plupload/plupload.full.js"></script>
<script src="<?php echo WEB_DIR; ?>js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
 
<script src="<?php echo WEB_DIR; ?>js/jquery.inputmask.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.tagsinput.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.mousewheel.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.textareaCounter.plugin.js"></script>
<script src="<?php echo WEB_DIR; ?>js/ui.spinner.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.jgrowl_minimized.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.form.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.validate.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/bbq.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery-ui-1.8.22.custom.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.form.wizard-min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/custom.js"></script>





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
			var array1 = sd1.split("-");
			var array2 = ed1.split("-");
			var sd11=array1[2]+"-"+array1[1]+"-"+array1[0];
			var cd11=array2[2]+"-"+array2[1]+"-"+array2[0];
			
			if(selectedDays == ''){ selectedDays = 'All'; }
			$.post( "<?php echo base_url(); ?>index.php/hotelcrs/getDates", {mmsd:sd11, mmed:ed11, selectedDays:selectedDays},
			  function(data) {
				if(data != ''){ 
					$("#filtering").show();
					$("#monthDates").html('');
						for(var i=0; i<data.dates.length; i++){
						var day1 = data.dates[i].toString().split(",");
						var day = day1.toString().split(" ");
						$("#monthDates").append('<tr style="border-top:solid 1px #deab6f; border-bottom:solid 1px #deab6f; padding-bottom:2px;"><td  style="border-right:solid 1px #deab6f; text-align:left; width:8%;font-size:11.5px;" id="tdtd">'+data.dates[i]+'<input type="hidden" name="dates[]" value="'+day[0]+'"><input type="hidden" name="weekday[]" value="'+day[1]+'"></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="price[]" type="text" class="form-control"  style="height:20px;width:80px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="avail[]" type="text" class="form-control"  style="height:20px;width:80px;background:#F2F2F2;"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="adult[]" type="text" id="adult[]" class="form-control" style="height:20px;width:80px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="child[]" type="text"  id="child[]" class="form-control"  style="height:20px;width:80px;background:#F2F2F2;" size="5"/></td></tr>');
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
		$.get( "<?php echo base_url(); ?>index.php/hotelcrs/getRoomType/"+hotel_id, 
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
	$.post( "<?php echo base_url(); ?>index.php/hotelcrs/getAvailDates", {mmsd:sd, mmed:ed, rate_id:<?php echo $rat_tac_details->sup_rate_tactics_id; ?>, selectedDays:selectedDays},
      function(data) {
		if(data != ''){
			$("#filtering").show();
			$("#monthDates").html('');
			for(var i=0; i<data.avail_dates.length; i++){
				$("#monthDates").append('<tr style="border-top:solid 1px #deab6f; border-bottom:solid 1px #deab6f; padding-bottom:2px;"><td  style="border-right:solid 1px #deab6f; text-align:left; width:10%; font-size:11.5px;" id="tdtd">'+data.avail_dates[i].day+'-'+data.avail_dates[i].month+'-'+data.avail_dates[i].year+' '+data.avail_dates[i].week_day+'<input type="hidden" name="dates[]" value="'+data.avail_dates[i].date+'"><input type="hidden" name="weekday[]" value="'+data.avail_dates[i].week_day+'"></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="price[]" type="text" class="input-field"  style="height:20px;width:85px;background:#F2F2F2;" value="'+data.avail_dates[i].rate+'"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="avail[]" type="text" class="input-field"  style="height:20px;width:80px;background:#F2F2F2;" value="'+data.avail_dates[i].available_rooms+'"/></td><td style="border-right:solid 1px #deab6f; text-align:center;width:10%;" id="tdtd3"><input name="adult[]" type="text"  id="adult[]" class="input-field"  style="height:20px;width:80px;background:#F2F2F2;"  value="'+data.avail_dates[i].adult+'"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="child[]" type="text"  id="child[]" class="input-field"  style="height:20px;width:80px;background:#F2F2F2;" value="'+data.avail_dates[i].child+'"/></td></tr>');
			}
		} 
	  }
	);
} 
);
</script>

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
			$.post( "<?php echo base_url(); ?>index.php/hotelcrs/getDates", {mmsd:sd1, mmed:ed1, selectedDays:selectedDays},
			  function(data) {
				if(data != ''){
					$("#filtering").show();
					$("#monthDates").html('');
						for(var i=0; i<data.dates.length; i++){
						var day1 = data.dates[i].toString().split(",");
						var day = day1.toString().split(" ");
						$("#monthDates").append('<tr style="border-top:solid 1px #deab6f; border-bottom:solid 1px #deab6f; padding-bottom:2px;"><td  style="border-right:solid 1px #deab6f; text-align:left; width:8%;font-size:11.5px;" id="tdtd">'+data.dates[i]+'<input type="hidden" name="dates[]" value="'+day[0]+'"><input type="hidden" name="weekday[]" value="'+day[1]+'"></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="price[]" type="text" class="input-field"  style="height:20px;width:80px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="avail[]" type="text" class="input-field"  style="height:20px;width:80px;background:#F2F2F2;"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="adult[]" type="text" id="adult[]" class="input-field" style="height:20px;width:80px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="child[]" type="text"  id="child[]" class="input-field"  style="height:20px;width:80px;background:#F2F2F2;" size="5"/></td></tr>');
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
		$.get( "<?php echo base_url(); ?>index.php/hotelcrs/getRoomType/"+hotel_id, 
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
	$.post( "<?php echo base_url(); ?>index.php/hotelcrs/getAvailDates", {mmsd:sd, mmed:ed, rate_id:<?php echo $rat_tac_details->sup_rate_tactics_id; ?>, selectedDays:selectedDays},
      function(data) {
		if(data != ''){
			$("#filtering").show();
			$("#monthDates").html('');
			for(var i=0; i<data.avail_dates.length; i++){
			   $("#monthDates").append('<tr style="border-top:solid 1px #deab6f; border-bottom:solid 1px #deab6f; padding-bottom:2px;"><td  style="border-right:solid 1px #deab6f; text-align:left; width:10%; font-size:11.5px;" id="tdtd">'+data.avail_dates[i].day+'-'+data.avail_dates[i].month+'-'+data.avail_dates[i].year+' '+data.avail_dates[i].week_day+'<input type="hidden" name="dates[]" value="'+data.avail_dates[i].date+'"><input type="hidden" name="weekday[]" value="'+data.avail_dates[i].week_day+'"></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="price[]" type="text" class="input-field"  style="height:20px;width:85px;background:#F2F2F2;" value="'+data.avail_dates[i].rate+'"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="avail[]" type="text" class="input-field"  style="height:20px;width:80px;background:#F2F2F2;" value="'+data.avail_dates[i].available_rooms+'"/></td><td style="border-right:solid 1px #deab6f; text-align:center;width:10%;" id="tdtd3"><input name="adult[]" type="text"  id="adult[]" class="input-field"  style="height:20px;width:80px;background:#F2F2F2;"  value="'+data.avail_dates[i].adult+'"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="child[]" type="text"  id="child[]" class="input-field"  style="height:20px;width:80px;background:#F2F2F2;" value="'+data.avail_dates[i].child+'"/></td></tr>');
			}
		} 
	  }
	);
} 
);
</script>
</head>
	<title>Change Price | InnoGlobe</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta content='text/html;charset=utf-8' http-equiv='content-type'>
    
    <link href='<?=base_url();?>assets/images/meta_icons/favicon.ico' rel='shortcut icon' type='image/x-icon'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon.png' rel='apple-touch-icon-precomposed'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-57x57.png' rel='apple-touch-icon-precomposed' sizes='57x57'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-72x72.png' rel='apple-touch-icon-precomposed' sizes='72x72'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-114x114.png' rel='apple-touch-icon-precomposed' sizes='114x114'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-144x144.png' rel='apple-touch-icon-precomposed' sizes='144x144'>
    <!-- / START - page related stylesheets [optional] -->
    <link href="<?=base_url();?>assets/stylesheets/plugins/select2/select2.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / END - page related stylesheets [optional] -->
    <!-- / bootstrap [required] -->
    <link href="<?=base_url();?>assets/stylesheets/bootstrap/bootstrap.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / theme file [required] -->
    <link href="<?=base_url();?>assets/stylesheets/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
    <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
    <link href="<?=base_url();?>assets/stylesheets/theme-colors.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / demo file [not required!] -->
    <link href="<?=base_url();?>assets/stylesheets/demo.css" media="all" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
      <script src="<?=base_url();?>assets/javascripts/ie/html5shiv.js" type="text/javascript"></script>
      <script src="<?=base_url();?>assets/javascripts/ie/respond.min.js" type="text/javascript"></script>
    <![endif]-->
  </head>
  <body class='contrast-dark fixed-header'>
    <?php $this->load->view('header');?>
    <div id='wrapper'>
      <div id='main-nav-bg'></div>
      <?php $this->load->view('side-menu');?>
      <section id='content'>
        <div class='container'>
          <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left'>
                      <i class='icon-ok'></i>
                      <span>Change Price</span>
                    </h1>
                    <div class='pull-right'>
                      <ul class='breadcrumb'>
                        <li>
                          <a href='<?=base_url();?>'>
                            <i class='icon-bar-chart'></i>
                          </a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Change Price</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-header blue-background'>
                      <div class='title'>Change Price</div>
                      <div class='actions'>
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    
                    
                    <div class='box-content'>
                    
                   <form name="form1" class="form-horizontal" enctype="multipart/form-data" action="<?php echo WEB_URL; ?>hotelcrs/edit_rate_plan" method="post">	
						<div class='form-group'>
                          	<label class='control-label col-sm-3'  for='validation_current'>Hotel Chain Name: </label>
                          	<div class='col-sm-4 controls'>
								<input type="hidden" name="hid" value="<?php echo $rat_tac_details->sup_rate_tactics_id; ?>">
                             	<select name="hotel_name" id="hotel_name"  class='form-control'  data-rule-required='true'  onchange="getRoomType();">
							        <?php
									$all_hotels = $this->Hotelcrs_model->view_all_hotels();
									for($iii=0;$iii<count($all_hotels);$iii++)
									{
									?>
									<option  value="<?php  echo $all_hotels[$iii]->sup_hotel_id; ?>" <?php if(isset($rat_tac_details->hotel_id) && $rat_tac_details->hotel_id == $all_hotels[$iii]->sup_hotel_id) { echo "selected='selected'"; } ?>><?php echo $all_hotels[$iii]->hotel_name.' - '.$all_hotels[$iii]->city;  ?></option>
									<?php	
									}
									?>
								</select> 
							    <span style="color:#FF0000;"> <?php echo form_error('hotel_name');?></span>	
                              </div>
                       	 </div>
                         <div class='form-group'>
                          	<label class='control-label col-sm-3'  for='validation_current'>Room Category:</label>
                          	<div class='col-sm-4 controls'>
								<div class="controls" id="roomTypes">
									<select name="room_type" id="room_type"  class='form-control'>
									<?php $room_categories = $this->Hotelcrs_model->hotel_room_categories($rat_tac_details->hotel_id); 
										  if(!empty($room_categories))	
										  {
											  foreach($room_categories as $key => $value)
											  { 
												  if($value->hotel_room_type == $rat_tac_details->category_type)
												  {
													  $selected = "selected=selected";
												  }
												  else
												  {
													  $selected = "";
												  }
												  ?>
											<option value="<?php echo $value->hotel_room_type;?>" <?php echo $selected;?>><?php echo $value->hotel_room_type;?></option>
									<?php } } ?>  
									</select>      
								 </div> 
                               </div>
                       	</div>
                       	<div class='form-group'>
                          	<label class='control-label col-sm-3'  for='validation_current'>Room Type:</label>
                          	<div class='col-sm-4 controls'>
								<div class="controls" id="roomTypeCapacity">
									<select name="capacity_type" id="capacity_type"  class='form-control'>
									<?php $room_types = $this->Hotelcrs_model->hotel_room_types($rat_tac_details->hotel_id);
											if(!empty($room_types))	
											{
											  foreach($room_types as $key => $value)
											  { 
												  if($value->capacity_title.'('.$value->capacity.','.$value->child_capacity.')' == $rat_tac_details->room_type)
												  {
													  $selected = "selected=selected";
												  }
												  else
												  {
													  $selected = "";
												  }
												  ?>
											<option value="<?php echo $value->capacity_title.'('.$value->capacity.','.$value->child_capacity.')'?>" <?php echo $selected;?>><?php echo $value->capacity_title.'('.$value->capacity.','.$value->child_capacity.')';?></option>
									<?php } } ?>  
									</select>											
								 </div> 
                               </div>
                       		</div>
                       		<div class='form-group'>
								<label class='control-label col-sm-3'  for='validation_current'>Room Image: </label>
									<div class='col-sm-4 controls'>
										<input type="file" name="main_image" id="filepath"  title='Search for a image to add' class='form-control'> &nbsp  <img src="<?php echo base_url(); ?>upload_files/room_image/<?php echo $rat_tac_details->main_image; ?>" width="50" height="50">
											<input type="hidden" value="<?php echo $rat_tac_details->main_image; ?>" name="MI">
                                    </div>
                       		</div>
                       		<div class='form-group'>
								<label class='control-label col-sm-3'  for='validation_current'>Image 1: </label>
									<div class='col-sm-4 controls'>
										<input type="file" name="image1" id="filepath1" title='Search for a image to add' class='form-control'>
                             	     	<input type="hidden" value="<?php echo $rat_tac_details->image1; ?>" name="im1"> &nbsp <img src="<?php echo base_url(); ?>upload_files/room_image/<?php echo $rat_tac_details->image1; ?>" width="50" height="50">
                                    </div>
                       		</div>
                       		<div class='form-group'>
								<label class='control-label col-sm-3'  for='validation_current'>Image 2 : </label>
									<div class='col-sm-4 controls'>
											<input type="file" name="image2" id="filepath2"  title='Search for a image to add' class='form-control'>
											<input type="hidden" value="<?php echo $rat_tac_details->image2; ?>" name="im2"> &nbsp 
											<img src="<?php echo base_url(); ?>upload_files/room_image/<?php echo $rat_tac_details->image2; ?>" width="50" height="50">
									</div>
                       		 </div>
                       		<div class='form-group'>
								<label class='control-label col-sm-3'  for='validation_current'>Image 3 : </label>
								<div class='col-sm-4 controls'>
										<input type="file" name="image3" id="filepath3" title='Search for a image to add' class='form-control' >
										<input type="hidden" value="<?php echo $rat_tac_details->image3; ?>" name="im3"> &nbsp <img src="<?php echo base_url(); ?>upload_files/room_image/<?php echo $rat_tac_details->image3; ?>" width="50" height="50">
								</div>
                       		</div>
                       		<?php
								$current_dte = date("d-m-Y",strtotime("+7 days"));
								$next_dte = date("d-m-Y",strtotime("+8 days"));
								
								$sd = $rat_tac_details->allocation_validity_from;
								$sds = explode("-",$sd);
								$strd = $sds[2].'-'.$sds[1].'-'.$sds[0];
								$ed = $rat_tac_details->allocation_validity_to;
								$eds = explode("-",$ed);
								$endd = $eds[2].'-'.$eds[1].'-'.$eds[0];
						       ?>
						    <div class='form-group'>
								<label class='control-label col-sm-3'  for='validation_current'>Child Policy: </label>
									<div class='col-sm-4 controls'>
										<textarea name="child_policy" class='form-control' id="child_policy" cols="70"  data-rule-required='true'  rows="4"><?php echo $rat_tac_details->child_policy; ?></textarea>											
									</div>
                       		</div>
                       		<div class='form-group'>
								<label class='control-label col-sm-3'  for='validation_current'>Cancellation Policy: </label>
								<div class='col-sm-4 controls'>
									<textarea name="cancel_policy_desc" id="cancel_policy_desc" cols="50"  data-rule-required='true'  class='form-control' rows="4"><?php if(isset($rat_tac_details->cancel_policy_desc)) echo $rat_tac_details->cancel_policy_desc; ?></textarea>
								 </div>
                       		</div>
                       		<div class='form-group'>
								<label class='control-label col-sm-3'  for='validation_current'>Room Rates </label>
								<div class='col-sm-4 controls'>
									<div class='col-sm-6'>
										<div class='input-group'>
											<input type="hidden" id="apartfec_val" name="apartfec_val" value=""/>
										    <input type="hidden" name="month" id="month" value=""/>
										    <input type="hidden" name="year" id="year" value=""/>  
										</div>
                                    </div> 
                                 </div>
                       		</div>
                       		<div class="control-group">
                       			<div class='form-group'>
									<label class='control-label col-sm-3'  for='validation_current'>Room Available Dates: </label>
										<div class='col-sm-4 controls'>
										 
												<div class='input-group'>
													<?php
														$current_dte = date("d-m-Y",strtotime("+7 days"));
														$next_dte = date("d-m-Y",strtotime("+8 days"));
													 ?>
													<table summary="" width="800" > 
														<tr>
														<td> 
														From :<input name="sd[]" id="datepicker2" type="text" class="b2b-txtbox" value="<?php if(isset($rat_tac_details->room_avail_date_from)){ $aFrom = explode("-", $rat_tac_details->room_avail_date_from);$aFDate=$aFrom[0].'-'.$aFrom[1].'-'.$aFrom[2]; echo $aFDate; }?>" 	 />
														To:<span id="out"><input name="ed[]" id="datepicker3" type="text" class="b2b-txtbox"  value="<?php if(isset($rat_tac_details->room_avail_date_to)){ $aTo = explode("-", $rat_tac_details->room_avail_date_to);$aTDate=$aTo[0].'-'.$aTo[1].'-'.$aTo[2]; echo $aTDate; }?>"/></span>
														<!-- <input class="btn btn-primary" type="button" style="margin-left:107px;" onclick="getDates();" value="Check"> --> </td>
														</tr>
													 </table>   
												</div>
											 
									   </div>
                       				 </div>
                       			<div class='form-group'>
									<label class='control-label col-sm-3'  for='validation_current'>Day </label>
									<div class='col-sm-4 controls'>
										<div class='col-sm-6'>
										   <div class='input-group'>
										   <?php    //if(in_array('Fri', $sdays)) { echo "in"; } else { echo "out"; } // echo "<pre>"; print_r($sdays); ?>
									  <?php //echo "<pre>"; print_r($sdays); ?>
									    
									    <?php $dayss = array();
											foreach($sdays as $sds){
															$dayss[]=$sds->week_day;												
													}									    
									    ?>
									    <?php foreach($days as $d) { ?> 
										   <input name="day" id="dayy" type="checkbox" value="<?php echo $d->days; ?>" style="margin-right:5px;"  <?php if(in_array($d->days, $dayss)) { echo 'checked'; } ?>  /> <?php echo $d->days; ?> <br>
										   <?php } ?>
										 
										  	<!--   
										   <?php //if(in_array("Mon", $sdays)) { echo 'checked'; } else {echo "sorryyyy"; } ?> 
										   <?php echo "<pre>"; print_r($sdays); ?>
											 	<input name="day" id="dayy" type="checkbox" value="Mon" style="margin-right:5px;"  <?php if(in_array("Mon", $sdays)) { echo 'checked'; } ?> /> Mon <br><?php //if(in_array($r->amenitie_id, $res)) { echo 'checked'; } ?>
												<input name="day" id="dayy" type="checkbox" value="Tue" style="margin-right:5px;"  <?php if(in_array("Tue", $sdays)) { echo 'checked'; } ?> />Tue <br>
												<input name="day" id="dayy" type="checkbox" value="Wed" style="margin-right:5px;"  <?php if(in_array("Wed", $sdays)) { echo 'checked'; } ?>/>Wed  <br>
												<input name="day" id="dayy" type="checkbox" value="Thu" style="margin-right:5px;"  <?php if(in_array("Thu", $sdays)) { echo 'checked'; } ?>/>Thu <br>
												<input name="day" id="dayy" type="checkbox" value="Fri" style="margin-right:5px;"  <?php if(in_array("Fri", $sdays)) { echo 'checked'; } ?>/>Fri <br>
												<input name="day" id="dayy" type="checkbox" value="Sat" style="margin-right:5px;"  <?php if(in_array("Sat", $sdays)) { echo 'checked'; } ?>/>Sat<br>
												<input name="day" id="dayy" type="checkbox" value="Sun" style="margin-right:5px;"  <?php if(in_array("Sun", $sdays)) { echo 'checked'; } ?>/>Sun <br>  -->
												<input type="button" value="Check"  class="btn btn-primary" onClick="getDates();" style="margin-left:107px;"/>
 									 

 
										  </div>
										 </div> 
									 </div>
                       			</div>
                       	</div> 
						<div id="filtering" style="coloir:#fff; width:100%; background:#f8f8f8; display:none;">
								<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="display tableStatic">
									<tr style="background:#00acec"  height="45">
										<td style="border-right:solid 1px #deab6f; text-align:center; padding-top:3px; color:#fff;padding:10px;">Smart Update</td>
										<td style="border-right:solid 1px #deab6f; text-align:center; padding:5px;">
											<input name="price" id="price" type="text" class="form-control"    /></td>
										<td style="border-right:solid 1px #deab6f; text-align:center; padding:5px;">
											<input name="avail" id="avail" type="text" class="form-control"     onblur="checkavailcount(this.value)"/></td>
										<td style="border-right:solid 1px #deab6f; text-align:center; padding:5px;">
											<input name="adult" id="adult" type="text" class="form-control"   /></td>
										<td style="border-right:solid 1px #deab6f; text-align:center; padding:5px;">
											<input name="child" id="child" type="text" class="form-control"   /></td>
										<td style="border-right:solid 1px #deab6f; text-align:center; padding:5px;">
											<input type="button" value="Update" style="margin-top:3px;" onclick="check_new();"/>
										</td>
									</tr>
									<tr height="30" style="font-size:12px;">
										<td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;">Dates</td>
										<td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;">Per Night Charge</td>
										<td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;">Available Rooms</td>
										<td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;">Adults</td>
										<td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;">Childs</td>
									</tr>
								</table>
								<input type="hidden" name="sup_rate_tactics_id" id="sup_rate_tactics_id" value="<?=@$rat_tac_details->sup_rate_tactics_id;?>">
								<table  width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="display tableStatic" style="background:#fff; margin-top:0px;">
									<tr><td>&nbsp;</td></tr>
									<span id="monthDates">
									</span>
									<tr><td height="30" style="color:red;"><div id="rmsg"><div></td></tr>
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
								<table border="0" cellpadding="0" cellspacing="0" width="70%">
									<tr>
										<td align="center">	<input type="submit" value="  Submit  "  class="btn btn-primary"  style="margin-left:107px;"/>
											<!--<input type="image" height="38" width="38" src="<?php echo base_url(); ?>public/img/sub_mint_btn_admin.png"  />-->
										</td> 
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
          <?php $this->load->view('footer');?>
        </div>
      </section>
    </div>
    <!-- / jquery [required] -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
    <!-- / jquery mobile (for touch events) -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery.mobile.custom.min.js" type="text/javascript"></script>
    <!-- / jquery migrate (for compatibility with new jquery) [required] -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery-migrate.min.js" type="text/javascript"></script>
    <!-- / jquery ui -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery-ui.min.js" type="text/javascript"></script>
    <!-- / jQuery UI Touch Punch -->
    <script src="<?=base_url();?>assets/javascripts/plugins/jquery_ui_touch_punch/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
    <!-- / bootstrap [required] -->
    <script src="<?=base_url();?>assets/javascripts/bootstrap/bootstrap.js" type="text/javascript"></script>
    <!-- / modernizr -->
    <script src="<?=base_url();?>assets/javascripts/plugins/modernizr/modernizr.min.js" type="text/javascript"></script>
    <!-- / retina -->
    <script src="<?=base_url();?>assets/javascripts/plugins/retina/retina.js" type="text/javascript"></script>
    <!-- / theme file [required] -->
    <script src="<?=base_url();?>assets/javascripts/theme.js" type="text/javascript"></script>
    <!-- / demo file [not required!] -->
    <script src="<?=base_url();?>assets/javascripts/demo.js" type="text/javascript"></script>
    <!-- / START - page related files and scripts [optional] -->
    <script src="<?=base_url();?>assets/javascripts/plugins/validate/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/validate/additional-methods.js" type="text/javascript"></script>
     <script src="<?=base_url();?>assets/javascripts/plugins/fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/select2/select2.js" type="text/javascript"></script>
    
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery.cleditor.min.js"></script>
    
  <script src="<?=base_url();?>assets/javascripts/jquery/jquery.cleditor.js"></script>
    <script>
      $.validator.addMethod("pwdmatch", (function(value) {
        return value === "<?php echo $admin->password; ?>";
      }), "Please enter valid current password!");

      $.validator.addMethod("buga", (function(value) {
        return value === "buga";
      }), "Please enter \"buga\"!");

      $.validator.methods.equal = function(value, element, param) {
        return value === param;
      };
    </script>
    
   
<script>
function getDates(){
	var sd = $("#datepicker2").val();
	var ed = $("#datepicker3").val(); 
	//var room_plan = $("#room_plan").val();
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
	$.post( "<?php print WEB_URL ?>hotelcrs/getDates", {mmsd:sd1, mmed:ed1, selectedDays:selectedDays},
      function(data) {
		if(data != ''){
			$("#filtering").show();
			$("#monthDates").html('');
			for(var i=0; i<data.dates.length; i++){
				day = data.dates[i].toString().split(" ");
				$("#monthDates").append('<tr style="padding-bottom:2px;"><td width="15%" style=" text-align:left; font-size:11.5px;" id="tdtd">'+data.dates[i]+'<input type="hidden" name="dates[]" value="'+day[0]+'"><input type="hidden" name="weekday[]" value="'+day[1]+'"></td><td style="" id="tdtd3" width="15%"><input name="price[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td width="15%" style="" id="tdtd3"><input name="avail[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td width="15%" style="" id="tdtd3"><input name="adult[]" type="text"  id="adult[]" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td width="15%" style="" id="tdtd3"><input name="child[]" type="text"  id="child[]" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td></tr>');
			}
		} 		
	  }
	);

$("#filtering").show();
<?php foreach ($smart2 as $sm) { ?>
	$("#monthDates").append('<table><tbody>');
	//$("#monthDates").append('<tr style="border-top:solid 1px #deab6f; border-bottom:solid 1px #deab6f; padding-bottom:2px;"><td>1</td><td  style="border-right:solid 1px #deab6f; text-align:left; width:10%;font-size:11.5px;" id="tdtd"><?=$sm->date;?><input type="hidden" name="dates[]" value="<?php echo $sm->rate; ?>"><input type="hidden" name="weekday[]" value="<?=$sm->week_day;?>"></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="price[]" value="<?php echo $sm->day; ?>" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="extra_bed_price[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="avail[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="adult[]" type="text"  id="adult[]" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="child[]" type="text"  id="child[]" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="child_price[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="infant[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:9%;" id="tdtd3">&nbsp;</td></tr>');
	$("#monthDates").append('<tr style="border-top:solid 1px #deab6f; border-bottom:solid 1px #deab6f; padding-bottom:2px;"><td>1</td>');
 	$("#monthDates").append('</table></tbody>');
<?php }?>
}
</script>
<script>
	function checkMaxRoom(val){		
		var ctype=document.getElementById("capacity_type").value;
		var rtype=document.getElementById("room_type").value;
		$.post( "<?php print WEB_URL ?>admin/getmaxroomcount", {rt:rtype, ct:ctype,aval:val},
      			function(data) {
				if(data != ''){
					if(data>val){
						alert("valid room count");
					}else{
						alert("invalid room avail count Please room avail count must be less than "+data);
						$("#avail").val('');
						$("#avail").focus();
					}
				}
	  		}
		);
	}
</script>
<script>
 $( "#smt_bt" ).click(function() {
  $( ".monthDates" ).show( "slow" );
});
</script>
    <!-- / END - page related files and scripts [optional] -->
  </body>
</html>
