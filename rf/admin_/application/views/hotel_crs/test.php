<!DOCTYPE html>
<html>
<head>
 
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/bootstrap-responsive.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/jquery.fancybox.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/uniform.default.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/bootstrap.datepicker.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/jquery.cleditor.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/jquery.plupload.queue.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/jquery.tagsinput.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/jquery.ui.plupload.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/chosen.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/jquery.jgrowl.css">
 
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/jquery-ui.css">

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
<style>
#monthDates input
{
	width:75px;
}
#filtering input
{
	width:75px;
}
</style>
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
	    
	});
</script>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
if (restore) selObj.selectedIndex=0;
}

$(document).ready(function(){

$("input:radio[name=top_city]").click(function() {
var top_city = $(this).val();
$('#testinput').val(top_city);
});
return false;
});

function getXMLHTTP() { //fuction to return the xml http object
  var xmlhttp=false; 
  try{
   xmlhttp=new XMLHttpRequest();
  }
  catch(e) {  
   try{   
    xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
   }
   catch(e){
    try{
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e1){
     xmlhttp=false;
    }
   }
  }
    
  return xmlhttp;
    }
	
function check(){
$price = $('#price').val();
$avail = $('#avail').val();
$min_stay = $('#min_stay').val();
$max_stay = $('#max_stay').val();
$checked_val=$('#on_req').val();
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
if($min_stay!=''){
$('input[name="min_stay[]"]').each(function(){
 $('input[name="min_stay[]"]').val($min_stay);
});
}
if($max_stay!=''){
$('input[name="max_stay[]"]').each(function(){
 $('input[name="max_stay[]"]').val($max_stay);
});
}
if($checked_val=='checkall'){ 
	
	$("#tablecheckbox input").each( function() {
		$(this).attr("checked",true);
	})
}
if($checked_val=='uncheckall'){
	
	$("#tablecheckbox input").each( function() {
		$(this).attr("checked",false);
		})
	
	}
$checked_val1 = $('#block_arr').val();
if($checked_val1=='checkall'){ 
	$("#tablecheckbox1 input").each( function() {
	$(this).attr("checked",true);
	})
}
if($checked_val1=='uncheckall'){
	$("#tablecheckbox1 input").each( function() {
	$(this).attr("checked",false);
	})
	
	}
$checked_val2 = $('#block_dept').val();
if($checked_val2=='checkall'){ 
	/*$('input[name="select[]"]').each(function(){
	 $('input[name="select[]"]').attr('checked',true);
	});*/
	$("#tablecheckbox2 input").each( function() {
		$(this).attr("checked",true);
	})
}
if($checked_val2=='uncheckall'){
	/*$('input[name="select[]"]').each(function(){
	 $('input[name="select[]"]').attr('checked',false);
	});*/
	$("#tablecheckbox2 input").each( function() {
		$(this).attr("checked",false);
		})
	}
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

function facilities()
{
	var valcheck2 = [];
	var selectedVariants = $("input[name=day]:checked").serializeArray();
	jQuery.each(selectedVariants, function(i, field){
     // alert(field.value); alert("IValue=="+i);
		valcheck2[i] = field.value;
    });
	$('#apartfec_val').val('');
	$('#apartfec_val').val(valcheck2);
	/*alert(valcheck2);
	alert($('#apartfec_val').val(valcheck2));*/
	
}
function check_all()
{
	if($('#all_day').attr('checked'))
	{

		$("#day input").each( function() {
			$(this).attr("checked",true);
		});
	}
	else
	{
		$("#day input").each( function() {
			$(this).attr("checked",false);
		});
	}
}

function abc()
{
	var valcheck2 = [];
	var selectedVariants = $("input[name=day]:checked").serializeArray();
	jQuery.each(selectedVariants, function(i, field){
     // alert(field.value); alert("IValue=="+i);
		valcheck2[i] = field.value;
    });
	$('#apartfec_val').val('');
	$('#apartfec_val').val(valcheck2);
	document.getElementById("maintain_month").submit();
}
function month(month,year)
{

	$('#month').val(month);
	$('#year').val(year);
	var valcheck2 = [];
	var selectedVariants = $("input[name=day]:checked").serializeArray();
	jQuery.each(selectedVariants, function(i, field){
     // alert(field.value); alert("IValue=="+i);
		valcheck2[i] = field.value;
    });
	$('#apartfec_val').val('');
	$('#apartfec_val').val(valcheck2);
	document.getElementById("maintain_month").submit();
}
function checked()
{
	var valcheck2 = [];
	var selectedVariants = $("input[name=on_req_checked_val]:checked").serializeArray();
	jQuery.each(selectedVariants, function(i, field){
     //alert(field.value); alert("IValue=="+i);
		valcheck2[i] = field.value;
    });
	$('#on_req_checked').val('');
	$('#on_req_checked').val(valcheck2);
	var valcheck3 = [];
	var selectedVariants1 = $("input[name=on_arr_checked_val]:checked").serializeArray();
	jQuery.each(selectedVariants1, function(j, field){
     //alert(field.value); alert("IValue=="+i);
		valcheck3[j] = field.value;
    });
	$('#on_arr_checked').val('');
	$('#on_arr_checked').val(valcheck3);
	var valcheck4 = [];
	var selectedVariants2 = $("input[name=on_blk_checked_val]:checked").serializeArray();
	jQuery.each(selectedVariants2, function(k, field){
     //alert(field.value); alert("IValue=="+i);
		valcheck4[k] = field.value;
    });
	$('#on_blk_checked').val('');
	$('#on_blk_checked').val(valcheck4);
	var stdate = $('#stdate').val();
	var eddate = $('#eddate').val();
	$('#from').val(stdate);
	$('#to').val(eddate);
}
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
	$.post( "<?php print WEB_URL ?>admin/getDates", {mmsd:sd1, mmed:ed1, selectedDays:selectedDays},
      function(data) {
		if(data != ''){
			$("#filtering").show();
			//$("#room_id").val(room_plan);
			//$("#capacity").val(data.room_plan[0].capacity);
			$("#monthDates").html('');
			
			for(var i=0; i<data.dates.length; i++){
				var day = data.dates[i].toString().split(" ");
				$("#monthDates").append('<tr style="border-top:solid 1px #deab6f; border-bottom:solid 1px #deab6f; padding-bottom:2px;"><td  style="border-right:solid 1px #deab6f; text-align:left; width:10%;font-size:11.5px;" id="tdtd">'+data.dates[i]+'<input type="hidden" name="dates[]" value="'+day[0]+'"><input type="hidden" name="weekday[]" value="'+day[1]+'"></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="price[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="extra_bed_price[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="avail[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="adult[]" type="text"  id="adult[]" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="child[]" type="text"  id="child[]" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="child_price[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="infant[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td style="border-right:solid 1px #deab6f; text-align:center; width:9%;" id="tdtd3">&nbsp;</td></tr>');
			}
		} 
	  }
	);
}
</script>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
if (restore) selObj.selectedIndex=0;
}

$(document).ready(function(){

$("input:radio[name=top_city]").click(function() {
var top_city = $(this).val();
$('#testinput').val(top_city);
});
return false;
});

function getMealBoard(){
	
	if(document.getElementById('meal_plan').value=='0'){
		document.getElementById('halfBoard').style.display = 'block';
		document.getElementById('meanPlanRates').style.display = 'block';
		document.getElementById('fullBoard').style.display = 'none';
		//document.getElementById('meanRates').style.display = 'none';
		document.getElementById('supRate').style.display = 'none';
	}
	if(document.getElementById('meal_plan').value=='1'){
		document.getElementById('halfBoard').style.display = 'none';
		//document.getElementById('meanRates').style.display = 'none';
		document.getElementById('fullBoard').style.display = 'block';
		document.getElementById('meanPlanRates').style.display = 'block';
		document.getElementById('supRate').style.display = 'none';
	}
	if(document.getElementById('meal_plan').value=='2'){
		document.getElementById('halfBoard').style.display = 'none';
		document.getElementById('fullBoard').style.display = 'none';
		//document.getElementById('meanRates').style.display = 'none';
		document.getElementById('meanPlanRates').style.display = 'block';
		document.getElementById('supRate').style.display = 'none';
	}
	if(document.getElementById('meal_plan').value=='3'){
		document.getElementById('halfBoard').style.display = 'none';
		document.getElementById('fullBoard').style.display = 'none';
		document.getElementById('meanPlanRates').style.display = 'block';
		document.getElementById('supRate').style.display = 'block';
	}
	if(document.getElementById('meal_plan').value=='4'){
		document.getElementById('halfBoard').style.display = 'none';
		document.getElementById('fullBoard').style.display = 'none';
		//document.getElementById('meanRates').style.display = 'none';
		document.getElementById('meanPlanRates').style.display = 'block';
		document.getElementById('supRate').style.display = 'none';
	}
}
</script>
<script language="javascript">
nights = 0;
function addNights() {
if (nights != 10) {

//$("#rows").append('<table><tr><td><div style="padding-top:2px; margin-left: -17px;">Charge &nbsp; <input type="text" name="cancel_policy_percent[]" size="8"/>% &nbsp;or&nbsp;&nbsp; <input type="text" name="cancel_policy_charge[]" size="8"/>amt &nbsp;&nbsp; Date From&nbsp; <input type="text" name="cancel_policy_from[]" size="8"/> &nbsp;To&nbsp; <input type="text" name="cancel_policy_to[]" size="8"/></div></td></tr></table>');

$("#rowsNight").append('<table><tr><td><div style="padding-top:2px; margin-left:-6px;font-size:13px;">From<input type="text" name="minimum_stay_from[]" size="7"/> &nbsp;To<input type="text" name=minimum_stay_to[]" size="7"/>&nbsp;Nights: <input type="text" name="minimum_stay_nights[]" id="minimum_stay_nights[]" style="width:50px" value="" /></div></td></tr></table>');

nights += 1;
} else {
$("#rowsNight").append('<br />Only 10 upload fields allowed.');
document.form1.addnights.disabled=true;
}
}
</script>
<script language="javascript">
fields = 0;
function addInput() {
if (fields != 10) {



$("#rows").append('<table><tr><td><div style="padding-top:2px; margin-left:-7px;font-size:13px;">Nights: <input type="text" name="cancel_policy_nights[]" id="cancel_policy_nights[]" size="3" /> Charge<input type="text" name="cancel_policy_percent[]" size="4"/>% &nbsp;or<input type="text" name="cancel_policy_charge[]" size="4"/>Per Night Charge&nbsp; From<input type="text" name="cancel_policy_from[]" size="7"/>&nbsp;To<input type="text" name="cancel_policy_to[]" size="7"/></div></td></tr></table>');

fields += 1;
} else {
$("#rows").append('<br />Only 10 upload fields allowed.');
document.form1.add.disabled=true;
}
}
</script>
<script type="text/javascript">
function getBreakfast(){
	if(document.getElementById('breakfast').checked){
		document.getElementById('breakfast_rate').style.display = 'block';
	}
	else{
		document.getElementById('breakfast_rate').style.display = 'none';
	}
}
function getBreakfast1(){
	if(document.getElementById('break_fast').checked){
		document.getElementById('full_board_breakfast').style.display = 'block';
	}
	else{
		document.getElementById('full_board_breakfast').style.display = 'none';
	}
}
</script>
<script type="text/javascript">
f = 0;
function addPeriod() 
{
	
if (f != 4) {

$("#rows1").append('<table><tr><td style="width:183px;"></td><td>&nbsp;</td><td style="width:120px;"><input name="sd[]" id="datepicker2" type="text" class="b2b-txtbox"  style="width:100px; height:18px;"/></td><td>&nbsp;</td><td style="width:120px;"><input id="datepicker3" name="ed[]" type="text" class="b2b-txtbox"  style="width:100px; height:18px;"/></td><td style="width:20px;"></td><td colspan="3"></td><td colspan="2" align="left"></td></tr></table>');

f += 1;
} else {
$("#rows1").append('<br />Only 4 upload fields allowed.');
document.form1.addperiod.disabled=true;
}
}

</script>
<script language="javascript1.5" type="text/javascript">
function hotel_fac_sorting()
{
	var sd =document.search.datepicker.value;
	var ed =document.search.datepicker1.value;
	var bookno =document.search.bookno.value;
	var status =document.search.status.value;
	$("#result").empty().html('<div style="padding-left:400px" align="middle"><img src=\'<?php print WEB_DIR ?>images/ajax-loader(2).gif\'></div>');
	$("#result").load("<?php print WEB_URL ?>account/booking_search/"+sd+"/"+ed+"/"+bookno+"/"+status);
	return false;
	// For first time page load default results
}

function getRoomType()
{
	var hotel_id = $('#hotel_name').val();
	$.get( "<?php print WEB_URL ?>hotelcrs/getRoomType/"+hotel_id, 
	function(data) {
		if(data != ''){
			var roomTypelist='';
			var roomTypeCapacitylist='';
			
			roomTypelist += '<select name="room_type" id="room_type" class="ma_pro_txt">';
			roomTypelist += '<option value="0">Select Room Category</option>';
			for(var i=0;i<data.roomTypes.length;i++) {
			roomTypelist += '<option value="'+data.roomTypes[i].hotel_room_type+'">'+data.roomTypes[i].hotel_room_type+'</option>'
			}
			roomTypelist += '</select>'
			
			roomTypeCapacitylist += '<select name="capacity_type" id="capacity_type" class="ma_pro_txt">';
			roomTypeCapacitylist += '<option value="0">Select Room Type</option>';
			for(var i=0;i<data.roomTypesCapacity.length;i++) {
			roomTypeCapacitylist += '<option value="'+data.roomTypesCapacity[i].capacity_title+'('+data.roomTypesCapacity[i].capacity+','+data.roomTypesCapacity[i].child_capacity+')">'+data.roomTypesCapacity[i].capacity_title+'('+data.roomTypesCapacity[i].capacity+','+data.roomTypesCapacity[i].child_capacity+')</option>'
			}
			roomTypeCapacitylist += '</select>'
			
			$('#roomTypes').html(roomTypelist);
			$('#roomTypeCapacity').html(roomTypeCapacitylist);
		} 
		else{
			$('#roomTypes').html('Sorry No Room Category found in this hotel !');
			$('#roomTypeCapacity').html('Sorry No Room Type found in this hotel !');
		}
	});return false;
}
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
        
        $(function() {
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

        $( "#datepicker12" ).datepicker({
        numberOfMonths: 1,
        dateFormat: 'dd-mm-yy',
        
        minDate: 0
        });
        $( "#datepicker13" ).datepicker({
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

$('#datepicker12').change(function(){
        //$t=$(this).val();
        var selectedDate = $(this).datepicker('getDate');
        var str1 = $( "#datepicker13" ).val();
        
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
                $( "#datepicker13" ).datepicker({
                    numberOfMonths: 3,
                    dateFormat : 'dd-mm-yy',
                    minDate: 1
                });
        $( "#datepicker13" ).val($t);
        // $('#datepicker1').datepicker('option', 'minDate', $t);s
        }
        });
        
        $('#datepicker13').change(function(){
        //$t=$(this).val();
        
        var selectedDate = $(this).datepicker('getDate');
        var str1 = $( "#datepicker12" ).val();
        
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
                $( "#datepicker12" ).datepicker({
                    numberOfMonths: 3,
                    dateFormat : 'dd-mm-yy',
                    minDate: 0
                });
        $( "#datepicker12" ).val($t);
        }
        else
        {
        }
        });
        
        });
        </script>
</head>

    <title>Add New Room Category| <?php echo PROJECT_NAME;?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta content='text/html;charset=utf-8' http-equiv='content-type'>
    
   
		<link rel="stylesheet" href="<?=base_url();?>assets/stylesheets/jquery.cleditor.css">   
   
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
                      <span>Add New Room Category</span>
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
                        <li class='active'>Add New Room Category</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-header blue-background'>
                      <div class='title'>Add New Room Category</div>
                      <div class='actions'>
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    
                    
                    <div class='box-content'>
                    
                    
 <form class="validate form-horizontal" action="<?php echo WEB_URL;?>hotelcrs/edit_rate_plan/<?php echo $sup_id; ?>/<?php echo $prop_id; ?>/<?php echo $id; ?>" name="form1" method="post" enctype="multipart/form-data">
													
 
                        
                             <div class='form-group'>
                          	<label class='control-label col-sm-3'  for='validation_current'>Hotel Chain Name: </label>
                          	<div class='col-sm-4 controls'>
                     		<div class='col-sm-6'>
                           <div class='input-group'>
                           <input type="hidden" name="hid" value="<?php echo $rat_tac_details->sup_rate_tactics_id; ?>">
                             	<select name="hotel_name" id="hotel_name" class="ma_pro_txt" onchange="getRoomType();">
							                    <option value="">Select Hotel</option>
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
                                   </div>
                       				 </div>
                        
                        
                        <div class='form-group'>
                          	<label class='control-label col-sm-3'  for='validation_current'>Room Category:
 </label>
                          	<div class='col-sm-4 controls'>
                     		<div class='col-sm-6'>
                           <div class='input-group'>
                          		<div class="controls" id="roomTypes">
											<select name="room_type" id="room_type" class="ma_pro_txt">
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
                                   </div>
                       				 </div>
                       				 
                       				 
                       				 <div class='form-group'>
                          	<label class='control-label col-sm-3'  for='validation_current'>Room Type:
 </label>
                          	<div class='col-sm-4 controls'>
                     		<div class='col-sm-6'>
                           <div class='input-group'>
                           
                           
                            <div class="controls" id="roomTypeCapacity">
											<select name="capacity_type" id="capacity_type" class="ma_pro_txt">
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
                                   </div>
                       				 </div>
                       				 
                       				 
                       				 <div class='form-group'>
                          	<label class='control-label col-sm-3'  for='validation_current'>Room Image: </label>
                          	<div class='col-sm-4 controls'>
                     		<div class='col-sm-6'>
                           <div class='input-group'>
                       	<input type="file" name="main_image" id="filepath" >
                       	
                       	<input type="hidden" value="<?php echo $rat_tac_details->main_image; ?>" name="MI">
                                     </div>
                                    </div> 
                                   </div>
                       				 </div>
                       				 
                       				 	 <div class='form-group'>
                          	<label class='control-label col-sm-3'  for='validation_current'> Room Image: </label>
                          	<div class='col-sm-4 controls'>
                     		<div class='col-sm-6'>
                           <div class='input-group'>
                      	<div class="control-group">
									 
										<div class="controls">
										
										   <img src="<?php echo base_url(); ?>upload_files/room_image/<?php echo $rat_tac_details->main_image; ?>" width="50" height="50">
                          
										
										</div> 	
													</div>
                                     </div>
                                    </div> 
                                   </div>
                       				 </div>
                       				 
                       				 
                       				 
                       				 
 
                       				 
                       				 
                       				 <div class='form-group'>
                          	<label class='control-label col-sm-3'  for='validation_current'>Image 1: </label>
                          	<div class='col-sm-4 controls'>
                     		<div class='col-sm-6'>
                           <div class='input-group'>
                             	<input type="file" name="image1" id="filepath1" >
                             	     	<input type="hidden" value="<?php echo $rat_tac_details->image1; ?>" name="im1">
                                     </div>
                                    </div> 
                                   </div>
                       				 </div>
                       				 
                       				 
                       				  <div class='form-group'>
                          	<label class='control-label col-sm-3'  for='validation_current'> Image 1: </label>
                          	<div class='col-sm-4 controls'>
                     		<div class='col-sm-6'>
                           <div class='input-group'>
                      	<div class="control-group">
									 
									                
									<div class="control-group">
										 
										<div class="controls">
										 
<img src="<?php echo base_url(); ?>upload_files/room_image/<?php echo $rat_tac_details->image1; ?>" width="50" height="50">
                          										 
										 	</div> 	
                                       
									</div>	
													</div>
                                     </div>
                                    </div> 
                                   </div>
                       				 </div>
                       				 
                       				 
                       				 
                       				 
                       				 <div class='form-group'>
                          	<label class='control-label col-sm-3'  for='validation_current'>Image 2 : </label>
                          	<div class='col-sm-4 controls'>
                     		<div class='col-sm-6'>
                           <div class='input-group'>
                       	<input type="file" name="image2" id="filepath2" >
                       	     	<input type="hidden" value="<?php echo $rat_tac_details->image2; ?>" name="im2">
                                     </div>
                                    </div> 
                                   </div>
                       				 </div>
                       				 
                       				 		  <div class='form-group'>
                          	<label class='control-label col-sm-3'  for='validation_current'> Image 2: </label>
                          	<div class='col-sm-4 controls'>
                     		<div class='col-sm-6'>
                           <div class='input-group'>
                      	<div class="control-group">
									 
									<div class="control-group">
										<label for="pw33" class="control-label"></label>
										<div class="controls">
											<img src="<?php echo base_url(); ?>upload_files/room_image/<?php echo $rat_tac_details->image2; ?>" width="50" height="50">
										</div> 	
                                       
									</div>
													</div>
                                     </div>
                                    </div> 
                                   </div>
                       				 </div>
                       				 
                       				 
                       				 
                       				 
                       				 
                       				 
                       				 <div class='form-group'>
                          	<label class='control-label col-sm-3'  for='validation_current'>Image 3 : </label>
                          	<div class='col-sm-4 controls'>
                     		<div class='col-sm-6'>
                           <div class='input-group'>
             <input type="file" name="image3" id="filepath3" >
                  	<input type="hidden" value="<?php echo $rat_tac_details->image3; ?>" name="im3">
                                     </div>
                                    </div> 
                                   </div>
                       				 </div>
                       				 
                       				 
                       				 
                       				 		  <div class='form-group'>
                          	<label class='control-label col-sm-3'  for='validation_current'> Image 3: </label>
                          	<div class='col-sm-4 controls'>
                     		<div class='col-sm-6'>
                           <div class='input-group'>
                      	<div class="control-group">
									 
									<div class="control-group">
									 
										<label for="pw33" class="control-label">Image 3:</label>
										<div class="controls">
											 <img src="<?php echo base_url(); ?>upload_files/room_image/<?php echo $rat_tac_details->image3; ?>" width="50" height="50">
											 
											 
											 	</div> 	
                                       
									</div>
                                       
									</div>
													</div>
                                     </div>
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
                     		<div class='col-sm-6'>
                           <div class='input-group'>
                          <textarea name="child_policy" id="child_policy" cols="50" rows="4"><?php echo $rat_tac_details->child_policy; ?></textarea>											
									 
                                     </div>
                                    </div> 
                                   </div>
                       				 </div>
                       				 
                       				 
                       				 	 <div class='form-group'>
                          	<label class='control-label col-sm-3'  for='validation_current'>Cancellation Policy: </label>
                          	<div class='col-sm-4 controls'>
                     		<div class='col-sm-6'>
                           <div class='input-group'>
                          <textarea name="cancel_policy_desc" id="cancel_policy_desc" cols="50" rows="4"><?php if(isset($rat_tac_details->cancel_policy_desc)) echo $rat_tac_details->cancel_policy_desc; ?></textarea>
									 
                                     </div>
                                    </div> 
                                   </div>
                       				 </div>
                       				 
                       				 
                       				 
                       				  	 <div class='form-group'>
                          	<label class='control-label col-sm-3'  for='validation_current'>Room Available Dates:  </label>
										<div class="controls">
											<?php
									            $current_dte = date("d-m-Y",strtotime("+7 days"));
									            $next_dte = date("d-m-Y",strtotime("+8 days"));
									        ?>
									        From : <input name="sd[]" id="datepicker2" type="text" class="b2b-txtbox" value="<?php echo $rat_tac_details->room_avail_date_from; ?>" />
									        To: <span id="out"><input name="ed[]" id="datepicker3" type="text" class="b2b-txtbox" value="<?php echo $rat_tac_details->room_avail_date_to; ?>" /></span>
									        Day:    
										</div> 
                          	<div class='col-sm-4 controls'>
                     		<div class='col-sm-6'>
                           <div class='input-group'>
                          
                         
											<input name="day" id="dayy" type="checkbox" value="Mon" style="margin-right:5px;"/>Mon &nbsp; 
								            <input name="day" id="dayy" type="checkbox" value="Tue" style="margin-right:5px;"/>Tue &nbsp;
								            <input name="day" id="dayy" type="checkbox" value="Wed" style="margin-right:5px;"/>Wed &nbsp;
								            <input name="day" id="dayy" type="checkbox" value="Thu" style="margin-right:5px;"/>Thu<br />
								            <input name="day" id="dayy" type="checkbox" value="Fri" style="margin-right:5px;"/>Fri &nbsp;
								            <input name="day" id="dayy" type="checkbox" value="Sat" style="margin:5px 6px;"/>Sat &nbsp;
								            <input name="day" id="dayy" type="checkbox" value="Sun" style="margin-right:5px;"/>Sun
								            <input type="button" value="Submit" class="btn btn-primary" onClick="getDates();" style="margin-left:107px;"/>
									 
										
										
                                     </div>
                                    </div> 
                                   </div>
                       				 </div>
                       				 
                       				 

                       				 
                       				 
                       				  
									
									
 	 <div class='form-group'>
                          	<label class='control-label col-sm-3'  for='validation_current'>Room Available Dates </label>
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
									
                       				 <!--
                       				 
                       				 <div class='form-group'>
                          	<label class='control-label col-sm-3'  for='validation_current'>Cancellation Policy: </label>
                          	<div class='col-sm-4 controls'>
                     		<div class='col-sm-6'>
                           <div class='input-group'>
                              <div class="controls">
                              <table summary="" width="600" >
										<tr>
										<td width="">Nights:</td>
										 <td width="" align="left"> <input size="15" type="text" name="cancel_policy_nights[]" id="cancel_policy_nights[]" size="3" /></td>
										 <td>Charge</td> 
										 <td><input size="15" type="text" id="cancel_policy_percent[]" name="cancel_policy_percent[]" size="4"/>%&nbsp;</td> 
										 <td>or</td><td><input type="text" size="15" id="cancel_policy_charge[]" name="cancel_policy_charge[]" size="4"/></td> 
										</tr> 
										
										<tr>
										 <td colspan="3"> 
										Per Night Charge&nbsp;	Cancellation allowed before days: </td> 
										<td><input type="text" name="cancellation_before_days" value="" /></td>
										  </tr>
										</table>      		 
										</div> 
                                     </div>
                                    </div> 
                                   </div>
                       				 </div>
                       				 -->
                       				 
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
                       				 
                       			 
                       				 
                         
                        
   					 
 
                        <div id="filtering" style="coloir:#fff; width:100%; background:#f8f8f8; display:none;">
    <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="display tableStatic">
    
    <tr style="background:#243419"  height="45">
    <td style="border-right:solid 1px #deab6f; text-align:center; padding-top:3px; color:#fff; padding-left:0px;">Smart Update</td>
    
    <td width="12%" style="border-right:solid 1px #deab6f; text-align:center; padding-left:0px;">
    	<input name="price" id="price" type="text" class="input-field"  style="height:20px; margin-top:3px; background:#F2F2F2;" size="5"/></td>
    <!-- <td style="border-right:solid 1px #deab6f; text-align:center; padding-left:0px;">
    	<input name="extra_bed_price" id="extra_bed_price" type="text" class="input-field"  style="height:20px; margin-top:3px; background:#F2F2F2;" size="5"/></td> -->
    <td width="11%" style="border-right:solid 1px #deab6f; text-align:center; padding-left:0px;">
    	<input name="avail" id="avail" type="text" class="input-field"  style="height:20px; margin-top:3px; background:#F2F2F2;" size="5" onBlur="checkMaxRoom(this.value)"/></td>
    <td width="12%" style="border-right:solid 1px #deab6f; text-align:center; padding-left:0px;">
    	<input name="adult" id="adult" type="text" class="input-field"  style="height:20px; margin-top:3px; background:#F2F2F2;" size="5"/></td>
    <td width="10%" style="border-right:solid 1px #deab6f; text-align:center; padding-left:0px;">
    	<input name="child" id="child" type="text" class="input-field"  style="height:20px; margin-top:3px; background:#F2F2F2;" size="5"/></td>
    <!-- <td style="border-right:solid 1px #deab6f; text-align:center; padding-left:0px;">
    	<input name="child_price" id="child_price" type="text" class="input-field"  style="height:20px; margin-top:3px; background:#F2F2F2;" size="5"/></td> 
    <td style="border-right:solid 1px #deab6f; text-align:center; padding-left:0px;">
    	<input name="infant" id="infant" type="text" class="input-field"  style="height:20px; margin-top:3px; background:#F2F2F2;" size="5"/></td>-->
    <!--<td style="border-right:solid 1px #deab6f; text-align:center; padding-left:0px;">
    	<input name="sup_charge" id="sup_charge" type="text" class="input-field"  style="height:20px; margin-top:3px; background:#F2F2F2;" size="5"/></td>-->
    <td style="border-right:solid 1px #deab6f; text-align:center; padding-left:0px;">
    	<input type="button" value="Update" style="margin-top:3px;" onClick="check_new();"/></td>
    </tr>
    
    <tr height="30" style="font-size:12px;">
    <td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;">Dates</td>
    <td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;">Per Night Charge</td>
    <!-- <td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;">Extra Bed Charge</td> -->
    <td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;">Available Rooms</td>
    <td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;">Adults</td>
    <td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;">Childs</td>
    <!-- <td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;">2nd Child Charge</td> 
    <td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; padding-left:0px;">Infants</td> -->
    <!--<td style="border-right:solid 1px #f8d1a3; text-align:center; width:11%; padding-left:0px;">Supplementary charge</td>-->
    <!--<td style="border-right:solid 1px #f8d1a3; text-align:center; width:9%; ">&nbsp;</td>-->
    </tr>
    </table>

<!--<form action="<?php echo WEB_URL; ?>index/add_maintain_month/<?php echo $this->uri->segment(3); ?>" method="post">-->

<table  width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="display tableStatic" style="background:#fff; margin-top:0px;">

<tr><td>&nbsp;</td></tr>
<span id="monthDates"></span>
<tr>
    <td height="30" style="color:red;">Once you finish all settings please click the "Save" button to save.</td>
</tr>
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
    <td align="center">
	<input type="submit" value="submit" class="btn btn-primary">  &nbsp  <a href="<?php echo WEB_URL; ?>hotelcrs/price_list"><button class='btn btn-primary' type='button'>
                                <i class='icon-reply'></i>
                                Go Back  
                              </button></a>
                              
</tr>
<tr>
	<td height="20" colspan="2">&nbsp;</td>
</tr>
</table>
</div>


   <div class='form-actions' style='margin-bottom:0'>
                          <div class='row'>
                            <div class='col-sm-9 col-sm-offset-3'>
                              
                              
							         		 
							         			
                              
                            </div>
                          </div>
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
	$("#addanother").click(function(){
			var addin = '<input type="text" name="ancountry" value="" placeholder="country" class="ma_pro_txt" style="margin:2px;"/><input type="text" name="anstate" placeholder="state" value="" class="ma_pro_txt" style="margin:2px;"/><input type="text" name="ancity" placeholder="city" value="" class="ma_pro_txt" style="margin:2px;"/><div onclick="removeinput()" style="font-weight:bold;cursor:pointer;">Remove</div><br/>';
			$("#addmorefields").html(addin);
	});

	function removeinput(){
		$("#addmorefields").html('');
	}
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
			//$("#room_id").val(room_plan);
			//$("#capacity").val(data.room_plan[0].capacity);
			$("#monthDates").html('');
			
			$("#monthDates").append('<table><tbody>');
			for(var i=0; i<data.dates.length; i++){
				day = data.dates[i].toString().split(" ");
				$("#monthDates").append('<tr style="padding-bottom:2px;"><td width="15%" style=" text-align:left; font-size:11.5px;" id="tdtd">'+data.dates[i]+'<input type="hidden" name="dates[]" value="'+day[0]+'"><input type="hidden" name="weekday[]" value="'+day[1]+'"></td><td style="" id="tdtd3" width="15%"><input name="price[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td width="15%" style="" id="tdtd3"><input name="avail[]" type="text" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td width="15%" style="" id="tdtd3"><input name="adult[]" type="text"  id="adult[]" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td><td width="15%" style="" id="tdtd3"><input name="child[]" type="text"  id="child[]" class="input-field"  style="height:20px;  background:#F2F2F2;" size="5"/></td></tr>');
			}
		 $("#monthDates").append('</table></tbody>');
		} 		
	  }
	);
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

 

    <!-- / END - page related files and scripts [optional] -->
  </body>
</html>
