$(function() {
	$('#voucher_date').datepicker({
	  dateFormat: 'yy-mm-dd',
	 
	});

	$('#travel_date').datepicker({
	  dateFormat: 'yy-mm-dd',
	});

	$("#module").change(function(){
		var val = $('option:selected', this).attr('api');
		if(val=="Travelport")
		{
			$("#api").val(val);
		}else if(val == "CRS")
		{
			$("#api").val(val);
		}else{
			$("#api").val();
		}	
	});

});


function mail_voucher(that){
	var that = that;
	var pnr = $(that).data('pnr');
	//var sel = $(that).children('span.loadr').
  $.ajax({
      type: 'GET',
      url: WEB_URL + "/apartment/mail_voucher/"+pnr,
      dataType: 'json',
      beforeSend: function(){
        $(that).children('span.loadr').toggle();
      },
      success: function(data) {
      	$(that).children('span.loadr').toggle();
      }
  }); 
}

function mail_uinvoice(that){
  var that = that;
  var pnr = $(that).data('pnr');
  //var sel = $(that).children('span.loadr').
  $.ajax({
      type: 'GET',
      url: WEB_URL + "/apartment/umail_invoice/"+pnr,
      dataType: 'json',
      beforeSend: function(){
        $(that).children('span.loadr').toggle();
      },
      success: function(data) {
        $(that).children('span.loadr').toggle();
      }
  }); 
}

function flight_mail_voucher(that){
	var that = that;
	var pnr = $(that).data('pnr');
	//var sel = $(that).children('span.loadr').
  $.ajax({
      type: 'GET',
      url: WEB_URL + "/flight/mail_voucher/"+pnr,
      dataType: 'json',
      beforeSend: function(){
        $(that).children('span.loadr').toggle();
      },
      success: function(data) {
      	$(that).children('span.loadr').toggle();
      }
  }); 
}

function flight_mail_uinvoice(that){
  var that = that;
  var pnr = $(that).data('pnr');
  //var sel = $(that).children('span.loadr').
  $.ajax({
      type: 'GET',
      url: WEB_URL + "/flight/mail_uinvoice/"+pnr,
      dataType: 'json',
      beforeSend: function(){
        $(that).children('span.loadr').toggle();
      },
      success: function(data) {
        $(that).children('span.loadr').toggle();
      }
  }); 
}

function flight_mail_invoice(that){
  var that = that;
  var pnr = $(that).data('pnr');
  //var sel = $(that).children('span.loadr').
  $.ajax({
      type: 'GET',
      url: WEB_URL + "/flight/mail_invoice/"+pnr,
      dataType: 'json',
      beforeSend: function(){
        $(that).children('span.loadr').toggle();
      },
      success: function(data) {
        $(that).children('span.loadr').toggle();
      }
  }); 
}

function hotel_mail_invoice(that){
  var that = that;
  var pnr = $(that).data('pnr');
  //var sel = $(that).children('span.loadr').
  $.ajax({
      type: 'GET',
      url: WEB_URL + "/hotel/mail_invoice/"+pnr,
      dataType: 'json',
      beforeSend: function(){
        $(that).children('span.loadr').toggle();
      },
      success: function(data) {
        $(that).children('span.loadr').toggle();
      }
  }); 
}

function car_mail_invoice(that){
  var that = that;
  var pnr = $(that).data('pnr');
  //var sel = $(that).children('span.loadr').
  $.ajax({
      type: 'GET',
      url: WEB_URL + "/car/mail_invoice/"+pnr,
      dataType: 'json',
      beforeSend: function(){
        $(that).children('span.loadr').toggle();
      },
      success: function(data) {
        $(that).children('span.loadr').toggle();
      }
  }); 
}

function vacation_mail_invoice(that){
  var that = that;
  var pnr = $(that).data('pnr');
  //var sel = $(that).children('span.loadr').
  $.ajax({
      type: 'GET',
      url: WEB_URL + "/vacation/mail_invoice/"+pnr,
      dataType: 'json',
      beforeSend: function(){
        $(that).children('span.loadr').toggle();
      },
      success: function(data) {
        $(that).children('span.loadr').toggle();
      }
  }); 
}

function car_mail_voucher(that){
	var that = that;
	var pnr = $(that).data('pnr');
	//var sel = $(that).children('span.loadr').
  $.ajax({
      type: 'GET',
      url: WEB_URL + "/car/mail_voucher/"+pnr,
      dataType: 'json',
      beforeSend: function(){
        $(that).children('span.loadr').toggle();
      },
      success: function(data) {
      	$(that).children('span.loadr').toggle();
      }
  }); 
}

function vacation_mail_voucher(that){
	var that = that;
	var pnr = $(that).data('pnr');
	//var sel = $(that).children('span.loadr').
  $.ajax({
      type: 'GET',
      url: WEB_URL + "/vacation/mail_voucher/"+pnr,
      dataType: 'json',
      beforeSend: function(){
        $(that).children('span.loadr').toggle();
      },
      success: function(data) {
      	$(that).children('span.loadr').toggle();
      }
  }); 
}

function flight_cancel_booking(that){
	var that = that;
	var pnr = $(that).data('pnr');
	//var sel = $(that).children('span.loadr').
  $.ajax({
      type: 'GET',
      url: WEB_URL + "/flight/cancel/"+pnr,
      dataType: 'json',
      beforeSend: function(){
        $(that).children('span.loadr').toggle();
      },
      success: function(data) {
      	$(that).children('span.loadr').toggle();
      	$(that).remove();
      }
  }); 
}

function car_cancel_booking(that){
	var that = that;
	var pnr = $(that).data('pnr');
	//var sel = $(that).children('span.loadr').
  $.ajax({
      type: 'GET',
      url: WEB_URL + "/car/cancel/"+pnr,
      dataType: 'json',
      beforeSend: function(){
        $(that).children('span.loadr').toggle();
      },
      success: function(data) {
      	$(that).children('span.loadr').toggle();
      	$(that).remove();
      }
  }); 
}

function hotel_cancel_booking(that){
  var that = that;
  var pnr = $(that).data('pnr');
  //var sel = $(that).children('span.loadr').
  $.ajax({
      type: 'GET',
      url: WEB_URL + "/hotel/cancel/"+pnr,
      dataType: 'json',
      beforeSend: function(){
        $(that).children('span.loadr').toggle();
      },
      success: function(data) {
        $(that).children('span.loadr').toggle();
        $(that).remove();
      }
  }); 
}

function hotel_mail_voucher(that){
	var that = that;
	var pnr = $(that).data('pnr');
	//var sel = $(that).children('span.loadr').
  $.ajax({
      type: 'GET',
      url: WEB_URL + "/hotel/mail_voucher/"+pnr,
      dataType: 'json',
      beforeSend: function(){
        $(that).children('span.loadr').toggle();
      },
      success: function(data) {
      	console.log(data);
      	$(that).children('span.loadr').toggle();
      }
  }); 
}