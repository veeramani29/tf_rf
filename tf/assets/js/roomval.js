
$(document).ready(function(){
//$('#txt1plus').val(0);
//$('#txt1plusChild').val(0);
$('#adul').html('0 Members '+ 0 + ' Rooms');
$("#remove").hide();

$.fn.CountTotalmembers = function() {
	var totalmembs=0;
	var totalChildmembs=0;
	$.cookie('TotalRooms', $('.par_roomcon').length);
	for(var ln=1;ln<= $('.par_roomcon').length;ln++){
	var vl= $('#txt'+ln+'plus').val();
	var vlchild= $('#txt'+ln+'plusChild').val();
	if(vl==''){vl=0;}
	if(vlchild==''){vlchild=0;}
	totalmembs = parseInt(totalmembs) +parseInt(vl) ;
	totalChildmembs=parseInt(totalChildmembs) +parseInt(vlchild);
	$.cookie('Room'+ln, vl);
	$.cookie('Room'+ln+'child', vlchild);
	}
	$.cookie('Totalmembers',totalmembs);
	$.cookie('TotalChildmembers',totalChildmembs);
	//alert(totalmembs);
	$('#adul').html(totalmembs + totalChildmembs + ' Membrs '+ $.cookie('TotalRooms') + ' Rooms');
	$("#total_adults").val(totalmembs);
	$("#total_children").val(totalChildmembs);
	$("#total_rooms").val($.cookie('TotalRooms'));
}

var i=1;

//To Add a new room
$("#add").click(function(e){
e.preventDefault();
	  console.log(i);
	if(i==3){ 
	$("#remove").show();
	$("#add").hide();
	i++;
}else if(i<=4){
	i++
	}
if (i>1 && i <=4){
var dynamicrm = '<div class="par_roomcon" id="Room'+i+'">'
  +' <h5>Room '+i+'</h5>'
  +'<div class="par_aduchild">'
  +' <div class="par_textcon">Adult (+12)</div>'
  +'<div class="incdec_buttons">'
  +'<a href="#" id="rm'+i+'plus" class="btn btn-increment">+</a>'
  +'<input required type="text" class="form-control" id="txt'+i+'plus" name="txt'+i+'plus" placeholder="0">'
  +' <a href="#" id="rm'+i+'minus" class="btn btn-decrement">-</a>'
  +' </div>'
  +'</div>'
  +'<div class="par_aduchild">'
  +' <div class="par_textcon">Childrens <span>( 0-11 )</span></div>'
  +'<div class="incdec_buttons">'
  +' <a href="#" id="rm'+i+'plusChild" class="btn btn-increment">+</a>'
  +'<input type="text" class="form-control" id="txt'+i+'plusChild" name="txt'+i+'plusChild" placeholder="0">'
  +'<a href="#" id="rm'+i+'minusChild" class="btn btn-decrement">-</a>'
  +' </div>'
  +'</div>'
  +'<div class="par_aduchild childage">'
 +'</div>'
  +'</div>'

$("#cmn").append(dynamicrm);
$("#remove").show();

}

$(this).CountTotalmembers();
return false;
});

//To Remove room
$("#remove").click(function(e){
	e.preventDefault();
	  console.log(i);
if(i==1){
$('#Room1').hide();
$('#txt1plus').val(0);
$("#remove").show();
$("#add").hide();
}
else if (i==2){
	$('#Room'+ parseInt(i)+'').remove();
	$("#remove").hide();
	$("#add").show();
	i--;
}
else if(i>2 && i <= 4){
$('#Room'+ parseInt(i)+'').remove();
$("#add").show();
i--;
}
//if(i>2){i--;}
$(this).CountTotalmembers();
return false;
});

//Start - For Room 1
//Add Adult Members
$(document).on('click','#rm1plus,#rm2plus,#rm3plus,#rm4plus', function(){
var id=$(this).attr('id');
var txtid = id.replace(/\D/g, '');
var val=$.trim($('#txt'+txtid+'plus').val());
//console.log(id,txtid);
if(val=="")
val=0;
var num = parseInt(val);
if(num==3)
			$('#rm'+txtid+'plus').hide();
		else if (num<3)
			$('#rm'+txtid+'minus').show();
		if(num>3){
				num=3;
			}
$('#txt'+txtid+'plus').val(++num);
$(this).CountTotalmembers();
return false;
});

//Remove Adult Members
$(document).on('click','#rm1minus,#rm2minus,#rm3minus,#rm4minus', function(){
var id=$(this).attr('id');
var txtid = id.replace(/\D/g, '');
var val=$.trim($('#txt'+txtid+'plus').val());
if(val=="")
val=0;
var num1 = parseInt(val);
if(num1==1)
		{
			$('#rm'+txtid+'minus').hide();
			$('#rm'+txtid+'plus').show();
		}
		else if (num1>1)
			$('#rm'+txtid+'plus').show();
			
		if(num1<1){
				num1=1;
			}
$('#txt'+txtid+'plus').val(--num1);
$(this).CountTotalmembers();
return false;
});

//Add Child Members
$(document).on('click','#rm1plusChild,#rm2plusChild,#rm3plusChild,#rm4plusChild', function(){
var id=$(this).attr('id');
var txtid = id.replace(/\D/g, '');
var val=$.trim($('#txt'+txtid+'plusChild').val());

if(val=="")
val=0;
var num = parseInt(val);
if(num==1)
			$('#rm'+txtid+'plusChild').hide();
		else if (num<1)
			$('#rm'+txtid+'minusChild').show();
		
		if(num>1){
				num=1;
			}
		
$('#txt'+txtid+'plusChild').val(++num);
var textval=$('#txt'+txtid+'plusChild').val();
var childagehtml='<div class="par_aduchild age'+textval+'"><div class="par_textcon">Children age <span>( 0-11 )</span></div>'
+'<div class="incdec_buttons">'
+'<input type="number" class="form-control" name="txt'+txtid+'plusChildage'+textval+'" id="txt'+txtid+'plusChildage'+textval+'" placeholder="0" />'
+'</div></div>';
$(this).parent().parent().siblings('.childage').append(childagehtml);	
$(this).CountTotalmembers();
return false;
});

//Remove Child Members
$(document).on('click','#rm1minusChild,#rm2minusChild,#rm3minusChild,#rm4minusChild', function(){
var id=$(this).attr('id');
var txtid = id.replace(/\D/g, '');
var val=$.trim($('#txt'+txtid+'plusChild').val());
var textval=$('#txt'+txtid+'plusChild').val();

$(this).parent().parent().siblings(".childage").find(" .age"+textval).remove();
if(val=="")
val=0;

var num1 = parseInt(val);
	if(num1==1)
	{
		$('#rm'+txtid+'minusChild').hide();
		$('#rm'+txtid+'plusChild').show();
	}
	else if (num1>1)
		$('#rm'+txtid+'plusChild').show();
	
	if(num1<1){
			num1=1;
		}
$('#txt'+txtid+'plusChild').val(--num1);
$(this).CountTotalmembers();
return false;
});
//End - For Room 1

});