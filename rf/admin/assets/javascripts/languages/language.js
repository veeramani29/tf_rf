$(document).ready(function(){
	$("#module").change(function(){
		if($(this).val() == 'othermodule'){
			$("#othermodule").parent().show();		
		}else{
			$("#othermodule").parent().hide();
		}
			
	});
	$("#page").change(function(){
		if($(this).val() == 'otherpage'){
			$("#otherpage").parent().show();		
		}else{
			$("#otherpage").parent().hide();
		}	
	});
	$("#section").change(function(){
		if($(this).val() == 'othersection'){
			$("#othersection").parent().show();		
		}else{
			$("#othersection").parent().hide();
		}	
	});
	$("#type").change(function(){
		if($(this).val() == 'othertype'){
			$("#othertype").parent().show();		
		}else{
			$("#othertype").parent().hide();
		}	
	});
	
	$(".toggle-labels").click(function(){
		var str = $(this).parent().attr('data-target');
		var res = str.replace("#","");
		$(".addModelid").attr("id",res);
		var module = $("#currentModule").val();
		var page = $("#page").val();
		var label = $(this).text();
		var data = "module="+module+"&page="+page+"&label="+escape( label.substr(0, 25)); 
		var url = $("#thisController").val();
		$.ajax({
			data: data,
			url: url+"generalViewLabels",
			type:'POST',
			dataType:'JSON'	,
			success:function(response){
				$("#popupPage").val(page);
				$("#popupModule").val(module);
				$("#popupId").val(response.id);
				$("#popupLabel").val(response.label);
				$("#english").val(response.english);
				$("#arabic").val(response.arabic);
				$("#german").val(response.german);
				$("#french").val(response.french);
				$("#spanish").val(response.spanish);
				$("#farsi").val(response.farsi);
				
			},
			error:function(){
			
			}
		});
	});
	
	$("#addNewLabel").click(function(){
		$("#newLabel").toggle();
	});
});

$("#popupForm").validate({
submitHandler: function() { 
	var action = $("#popupForm").attr('action');
	$.ajax({
		type: "POST",
		url: action,
		data: $("#popupForm").serialize(),
		dataType: "json",
		success: function(data){
			
			if(data.status == 1){
				$("#popupMessage").html("<span style='color:green;'>"+data.msg+"</span>");
				setTimeout(function(){ $("#addModelid").click();},3000);
			}else{
				$("#popupMessage").html("<span style='color:red;'>"+data.msg+"</span>");
				return false;
			}	
		}
	});
	return false; 
}
});
