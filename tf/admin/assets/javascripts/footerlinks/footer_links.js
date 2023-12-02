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
		var page = $("#page").val();
		var labelid = $(this).attr('id');
		var data = "page="+page+"&id="+labelid; 
		var url = $("#thisController").val();
		$.ajax({
			data: data,
			url: url+"generalViewLabels",
			type:'POST',
			dataType:'JSON'	,
			success:function(response){
				$("#popupPage").val(page);
				$("#popupId").val(response.id);
				$("#popupLabel").val(response.label);
				$("#url").val(response.url);
				$("#english").val(response.english);
				$("#dutch").val(response.dutch);
				
				
				
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
