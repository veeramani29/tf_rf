jQuery(document).ready(function(){
	
$(".cboxElement").click(function(){

			$('#regerrmsg').html("");
			$('#regerrmsg').hide();
       $('#logerrmsg').html("");
       $('#logerrmsg').hide();
       $("#forgot_email_msg").html("");
       $("#forgot_email_msg").hide();
       $('#userlogin')[0].reset();
       $('#signupForgot')[0].reset();
       $('#usermyaccount')[0].reset();
     });
      });


jQuery(function($) {
  jQuery('#userlogin').yiiactiveform({
       'validateOnSubmit':true,
       'attributes':[
       {'id':'lemail','inputID':'lemail',
       'clientValidation':function(value, messages, attribute) {

        if(jQuery.trim(value)=='') {
         messages.push("Username cannot be blank.");
       }
     if(jQuery.trim(value)!='' && !value.match(/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/)) {
        messages.push("Email is not a valid email address.");
      }


    }
  },
  {'id':'lpass','inputID':'lpass',
  'clientValidation':function(value, messages, attribute) {

    if(jQuery.trim(value)=='') {
     messages.push("Password cannot be blank.");
   }

   var email=$("#lemail").val();
   var pss=$("#lpass").val();
	
   if(pss!='' && email!='') {
   
   var action = $("#userlogin").attr('action');
		$.ajax({
			type: "POST",
			url: action,
			data: $("#userlogin").serialize(),
			dataType: "json",
			success: function(data){
				if(data.status == 1){
					$('#cboxOverlay').hide();
					$('#colorbox').hide();
					$('.cboxElement').hide();
					doLogin(data);
				} else if(data.status == 2) {
					var curUrl = document.URL; //encode to base64
					window.location.href = WEB_URL+'/security/verifytwostep?url='+curUrl;
				} else{
					
					$('div#logerrmsg').html(data.msg);
					$('div#logerrmsg').show();
					
				}
			}
		});
  
   

  }

}
},document.userlogin.onsubmit = function(){

  return false;
}


],'errorCss':'error'});
    });



jQuery(function($) {

		jQuery('#usermyaccount').yiiactiveform({
			'validateOnSubmit':true,
			'attributes':[
{'id':'fname','inputID':'fname',
			'clientValidation':function(value, messages, attribute) {

				if(jQuery.trim(value)=='') {
					messages.push("First Name cannot be blank.");
				}
				if(jQuery.trim(value)!='' && !value.match(/^[A-Za-z ]{3,50}$/)) {
					messages.push("Dont use special characters.");
				}

			}
		},
{'id':'mname','inputID':'mname',
			'clientValidation':function(value, messages, attribute) {

				if(jQuery.trim(value)=='') {
					messages.push("Middle Name cannot be blank.");
				}
				if(jQuery.trim(value)!='' && !value.match(/^[A-Za-z ]{3,50}$/)) {
					messages.push("Dont use special characters.");
				}

			}
		},
		
	{'id':'lname','inputID':'lname',
	'clientValidation':function(value, messages, attribute) {

		if(jQuery.trim(value)=='') {
			messages.push("Last Name cannot be blank.");
		}
		if(jQuery.trim(value)!='' && !value.match(/^[A-Za-z ]{3,50}$/)) {
			messages.push("Dont use special characters.");
		}

	}
},




{'id':'email','inputID':'email', /*'errorID':'erroremail',*/
'clientValidation':function(value, messages, attribute) {

	if(jQuery.trim(value)=='') {
		messages.push("");
	}
	if(jQuery.trim(value)!='' && !value.match(/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/)) {
		messages.push("Email is not a valid email address.");
	}

	

}
},


{'id':'password','inputID':'password',
'clientValidation':function(value, messages, attribute) {

	if(jQuery.trim(value)=='') {
		messages.push("Password cannot be blank.");
	}

}
},

{'id':'cpassword','inputID':'cpassword',
'clientValidation':function(value, messages, attribute) {
	if(jQuery.trim(value)=='') {
		messages.push("Confirm Password cannot be blank.");
	}
	var newp=document.getElementById("cpassword").value;
	if(jQuery.trim(value)!='' && (jQuery.trim(value)!=jQuery.trim(newp))) {
		messages.push("Confirm Password does not match");
	}
	
	var first_name=$("#fname").val();
   var last_name=$("#lname").val();
	var reg_email=$("#email").val();
   var reg_pss=$("#cpassword").val();
	
   if(first_name!='' && last_name!='' && reg_email!='' && reg_pss!='') {
	
		var action = $("#usermyaccount").attr('action');
		$.ajax({
			type: "POST",
			url: action,
			data: $("#usermyaccount").serialize(),
			dataType: "json",
			success: function(data){
				if(data.status == 1){
					$('#cboxOverlay').hide();
					$('#colorbox').hide();
					$('.cboxElement').hide();
					doLogin(data);
				}else{
					
					
					$('div#regerrmsg').html(data.msg);
					$('div#regerrmsg').show();
				}
			}
		});
	}
}
},document.usermyaccount.onsubmit = function(){

  return false;
}

		
		






],'errorCss':'error'}); 

});




jQuery(function($) {
  jQuery('#signupForgot').yiiactiveform({
       'validateOnSubmit':true,
       'attributes':[
       {'id':'femail','inputID':'femail',
       'clientValidation':function(value, messages, attribute) {

        if(jQuery.trim(value)=='') {
         messages.push("Email id cannot be blank.");
       }
     if(jQuery.trim(value)!='' && !value.match(/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/)) {
        messages.push("Email is not a valid email address.");
      }
      if($('#femail').val()!=''){
var action = $("#signupForgot").attr('action');
		$.ajax({
			type: "POST",
			url: action,
			data: $("#signupForgot").serialize(),
			dataType: "json",
			success: function(data){
				if(data.status == 1){
				$("#forgot_email_msg").css( "color", "green" );
				$('#forgot_email_msg').html(data.msg);
				$('#forgot_email_msg').show();
					setTimeout(function(){$('#cboxOverlay').hide();$('#colorbox').hide();}, 8000);
				}else{
				$("#forgot_email_msg").css( "color", "red" );
				$('#forgot_email_msg').html(data.msg);
				$('#forgot_email_msg').show();
				}
			}
		});
}
    }
  



},document.signupForgot.onsubmit = function(){

  return false;
}


],'errorCss':'error'});
    });
    



