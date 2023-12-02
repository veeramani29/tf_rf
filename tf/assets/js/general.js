// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'long_name',
  country: 'long_name',
  postal_code: 'short_name'
};




//flight_cancel_booking
function flight_cancel_request(that){ 

  $('#cancel_request').modal('show');
  $('#cancel_request').find('input#pnr').val($(that).data('pnr'));
 $('#cancel_request_form').find('p').remove();
   

  }

$("#cancel_request_form").validate({
  submitHandler: function() { 

          $('#cancel_request_form').find('p').remove();
      $.ajax({
            type: 'POST',
            url: WEB_URL + "/flight/cancel_request",
            async: true,
            dataType: 'json',
            data: $("#cancel_request_form").serializeArray(),
            success: function(data) {
              if(data.msg!=1){
               
        $('#cancel_request_form').find('input#pnr').after('<h3 class="text-center text-danger">'+ data.msg +'</h3>');
              }else{
               
                $('#cancel_request_form').find('input#pnr').after('<h3 class="text-center text-success">Successfully sent your request</h3>'); 
              }
             
            }
          });

       return false;
  }
});




 








function initialize(country_status) {
	return;
  country_status = (typeof country_status === "undefined") ? "0" : country_status;

  // Create the autocomplete object, restricting the search
  // to geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
  /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
  { types: ['geocode'] });
  // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    fillInAddress(country_status);
  });
  $("#autocomplete").focusin(function () {
        $(document).keypress(function (e) {
            if (e.which == 13) {
                infowindow.close();
                var firstResult = $(".pac-container .pac-item:first").text();
                
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({"address":firstResult }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var lat = results[0].geometry.location.lat(),
                            lng = results[0].geometry.location.lng(),
                            placeName = results[0].address_components[0].long_name,
                            latlng = new google.maps.LatLng(lat, lng);
                        
                        moveMarker(placeName, latlng);
                        $("#autocomplete").val(firstResult);
                    }
                });
            }
        });
    });
}

// [START region_fillform]
function fillInAddress(country_status) {
  return;
// Get the place details from the autocomplete object.
var place = autocomplete.getPlace();
var latt = place.geometry.location.lat();
var longg = place.geometry.location.lng();
//alert(latt+'  -  '+longg);
for (var component in componentForm) {
document.getElementById(component).value = '';
document.getElementById('latitude').value = '';
document.getElementById('longitude').value = '';
document.getElementById(component).disabled = false;
}
document.getElementById('latitude').value = latt;
document.getElementById('longitude').value = longg;
if(country_status == 1){
		for (var i = 0; i < place.address_components.length; i++) {
			var addressType = place.address_components[i].types[0];
			if(addressType == "country")
			{
				if (componentForm[addressType]) {
					var country = place.address_components[i][componentForm[addressType]];
					var data ={};
					data['country'] = country;
					
					$.ajax({
						type: 'POST',
						url: WEB_URL + "/listings/get_country_code",
						async: true,
						dataType: 'json',
						data: data,
						success: function(data) {
							$('#country').val(data.country_code);
						}
					});
				}	
		}		
}
}
// Get each component of the address from the place details
// and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  return;
  //if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = new google.maps.LatLng(
      position.coords.latitude, position.coords.longitude);
      autocomplete.setBounds(new google.maps.LatLngBounds(geolocation,
      geolocation));
    });
  //}
}
// [END region_geolocation]

$(".addcontact").click(function(){
  $(".emergency").toggle();
});

$("#sendReference").click(function(){
	var emails = $("#referenceEmails").val();
	if(emails == ''){
		$('div.errstatus').html('You did not provide any email addresses. Please try again so you can build up your reputation!');
		$('div.errstatus').show();
		setTimeout(function(){ $('div.errstatus').hide()}, 9000);
	}else{
		if(validateEmail(emails)){
			$.ajax({
			type: 'POST',
			url: WEB_URL + "/dashboard/sendReference",
			async: true,
			dataType: 'json',
			data: {'emails': emails},
			beforeSend: function(){
				$('.lodref').toggle();
			},
			success: function(data) {
				$('#referenceEmails').val('');
				$('.lodref').toggle();
				$('div.errstatus').html(data.msg);
				$('div.errstatus').show();
				setTimeout(function(){ $('div.errstatus').hide();}, 5000);
				}
			});
		}else {
			$('div.errstatus').html("Sorry, we couldn't recognize any of the emails you entered.");
			$('div.errstatus').show();
			setTimeout(function(){ $('div.errstatus').hide();}, 9000);
		}
	}
});


function mail_voucher(that){
	
	var that = that;
	var pnr = $(that).data('pnr');
	//var sel = $(that).children('span.loadr').
  $.ajax({
      type: 'GET',
      url: WEB_URL + "/apartment/mail_voucher_only/"+pnr,
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

function validateEmail(email){
var emailReg = new RegExp(/^(\s*,?\s*[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})+\s*$/);
var valid = emailReg.test(email);
if(!valid) {
return false;
} else {
return true;
}
}

$("#writeref").click(function(){
  var relationship_type = $("#relationship_type").val();
  var recommendation = $("#recommendation").val();
  var refid = $("#refid").val();
  var refid_firstname = $('#refid_firstname').val();

  if(recommendation == ''){
    $('div.msg').html('Please write a reference first!');
    $('div.msg').show();
    setTimeout(function(){ $('div.msg').hide();}, 5000);
  }else {
    $.ajax({
      type: 'POST',
      url: WEB_URL + "/users/addRefMsg",
      dataType: 'json',
      data: {'relationship_type': relationship_type, 'recommendation': recommendation, 'refid': refid, 'refid_firstname': refid_firstname},
      success: function(data) {
        $('div.msg').html(data.msg);
        $('div.msg').show();
        setTimeout(function(){ $('div.msg').hide();}, 5000);
      }
    });
  }
});

//Datepicker Customization Starts
//jQuery("#checkin").datepicker();
//jQuery("#checkout").datepicker();

jQuery( "#checkin" ).datepicker({
  minDate: 0,
  firstDay: 1,
  dateFormat: 'dd-mm-yy',
  maxDate: "+1y",
  onSelect: function(dateStr) {
      var d1 = $(this).datepicker("getDate");
      d1.setDate(d1.getDate() + 1); // change to + 1 if necessary
      var d2 = $(this).datepicker("getDate");
      d2.setDate(d2.getDate() + 30); // change to + 29 if necessary
      $("#checkout").datepicker("setDate", d1);
      $("#checkout").datepicker("option", "minDate", d1);
      //$("#to").datepicker("option", "maxDate", d2);
  },
  onClose: function( selectedDate ) {
    //$( "#checkout" ).datepicker( "option", "minDate", selectedDate );
    $( '#checkout' ).focus();
    }
  });
jQuery( "#checkout" ).datepicker({
  minDate: 0,
  dateFormat: 'dd-mm-yy',
  maxDate: "+1y",
  onClose: function( selectedDate ) {
    $ ( "#checkin" ).datepicker( "option", "maxDate", selectedDate );
  }
});
//Datepicker Customization Ends

//  Sanjay  Apartments 

jQuery( "#hotel_checkin" ).datepicker({
minDate: 0,
dateFormat: 'dd-mm-yy',
maxDate: "+1y",
onSelect: function(dateStr) {
      var d1 = $(this).datepicker("getDate");
      d1.setDate(d1.getDate() + 1); // change to + 1 if necessary
      var d2 = $(this).datepicker("getDate");
      d2.setDate(d2.getDate() + 30); // change to + 29 if necessary
      $("#hotel_checkout").datepicker("setDate", d1);
      $("#hotel_checkout").datepicker("option", "minDate", d1);
      //$("#to").datepicker("option", "maxDate", d2);
  },
onClose: function( selectedDate ) {
//$( "#hotel_checkout" ).datepicker( "option", "minDate", selectedDate );
$( '#hotel_checkout' ).focus();
}
});

jQuery( "#hotel_checkout" ).datepicker({
minDate: 0,
dateFormat: 'dd-mm-yy',
maxDate: "+1y",
onClose: function( selectedDate ) {
$( "#hotel_checkin" ).datepicker( "option", "maxDate", selectedDate );
}
});

function add_lmd()
{
var value = $('#lmd_no').val();
value++;

if (value > 0)
{
$('#lastminute_discounts').prop('checked', true);
}

var data = {};
data['value'] = value;

$.ajax({
type: 'POST',
url: WEB_URL + "/listings/get_lmd",
async: true,
dataType: 'json',
data: data,
success: function(data) {
$(data.result).insertAfter(".lmd");
$('#lmd_no').val(value);
}
});
}

function delete_lmd(value)
{
$('#lmd_' + value).remove();
var value = $('#lmd_no').val();
value--;

$('#lmd_no').val(value);
if (value == 0)
{
$('#lastminute_discounts').prop('checked', false);
}
}

function add_spd()
{
var value = $('#spd_no').val();
value++;

if (value > 0)
{
$('#special_discounts').prop('checked', true);
}

var data = {};
data['value'] = value;

$.ajax({
type: 'POST',
url: WEB_URL + "/listings/get_spd",
async: true,
dataType: 'json',
data: data,
success: function(data) {
$(data.result).insertAfter(".spd");
$('#spd_no').val(value);
jQuery( ".datepicker" ).datepicker();
}
});
}

function delete_spd(value)
{
$('#spd_' + value).remove();
var value = $('#spd_no').val();
value--;

$('#spd_no').val(value);
if (value == 0)
{
$('#special_discounts').prop('checked', false);
}
}

$("#form_basicinfo").validate({
  submitHandler: function() { 
    
    var data = {};
    var data_bed_types = [];

    $('.property_bed_types').each(function(i){  
      data_bed_types.push($(this).val());
    })

    if(data_bed_types.length <= 0){   
        alert("Please select atleast 1 bed type");
        return false;
    }


    data['property_name'] = $('#property_name').val();
    data['property_type'] = $("#property_type option:selected").val();
    data['property_size_value'] = $('#property_size_value').val();
    data['property_size_unit'] = $('#property_size_unit option:selected').val();
    data['bedrooms'] = $('#bedrooms option:selected').val();
    data['beds'] = $('#beds option:selected').val();
    data['checkout'] = $('#checkout option:selected').val();
    data['checkin'] = $('#checkin option:selected').val();
    data['floor'] = $('#floor').val();
    data['elevator'] = $('#elevator').val();
    data['bathrooms'] = $('#bathrooms option:selected').val();
    data['toilets'] = $('#toilets option:selected').val();
    data['avg_cleaning_time'] = $('#avg_cleaning_time option:selected').val();
    data['currency'] = $('#currency option:selected').val();
    data['nightly_rate_from'] = $('#nightly_rate_from').val();
    data['nightly_rate_to'] = $('#nightly_rate_to').val();
    data['weekly_rate_from'] = $('#weekly_rate_from').val();
    data['weekly_rate_to'] = $('#weekly_rate_to').val();
    data['monthly_rate_from'] = $('#monthly_rate_from').val();
    data['monthly_rate_to'] = $('#monthly_rate_to').val();
    data['max_guests'] = $('#max_guests option:selected').val();
    data['max_adults'] = $('#max_adults option:selected').val();
    data['max_child'] = $('#max_child option:selected').val();
    data['max_babies'] = $('#max_babies option:selected').val();
    data['min_stay'] = $('#min_stay option:selected').val();
    data['min_stay_unit'] = $('#min_stay_unit option:selected').val();
    data['max_stay'] = $('#max_stay option:selected').val();
    data['max_stay_unit'] = $('#max_stay_unit option:selected').val();    
    data['street_no'] = $('#street_no').val();
    data['postal_code'] = $('#postal_code').val();
    data['apartment_no'] = $('#apartment_no').val();
    data['address1'] = $('#address1').val();
    data['address2'] = $('#address2').val();
    data['address3'] = $('#address3').val();
    data['city'] = $('#city').val();
    data['phone_no'] = $('#phone_no').val();
    data['region'] = $('#region').val();
    data['access_code'] = $('#access_code').val();
    data['countries'] = $('#countries option:selected').val();
    data['latitude'] = $('#latitude').val();
    data['longitude'] = $('#longitude').val();

    data['short_property_description'] = $('#short_property_description').val();
    data['full_property_description'] = $('#full_property_description').val();
    data['area_property_description'] = $('#area_property_description').val();
    data['rental_details'] = $('#rental_details').val();
    data['inventory'] = $('#inventory').val();
    data['arrival_sheet'] = $('#arrival_sheet').val();
    data['list_id'] = $('#edit_listings_general').val();
    data['prop_instant_book'] = $('#prop_instant_book').val();
    data['prop_instant_book'] = $('#prop_instant_book').val();
    data['property_bed_types'] = data_bed_types.join();

    data['cancellation_type'] = $('#cancellation_type').val();
    data['cancellation_details'] = $('#cancellation_details').val();
    data['additional_note'] = $('#additional_note').val();
    data['cancellation_before_days'] = $('#cancellation_before_days').val();

    var udpa_name = [];
    var udpa_value = [];

    $( ".udpa_input" ).each(function() {      
    udpa_name.push($(this).attr('name'));
    udpa_value.push($(this).val());
    });   

    data['udpa_name'] = udpa_name;
    data['udpa_value'] = udpa_value;

    var amentites = [];
    $(".amentites:checked").each(function() {
    amentites.push(this.value);
    });

    data['amentites'] = amentites;

    var activities = [];
    $(".activities:checked").each(function() {
    activities.push(this.value);
    });

    data['activities'] = activities;    

    $.ajax({
    type: 'POST',
    url: WEB_URL + "/listings/update_listing_property_step1",
    async: true,
    dataType: 'json',
    data: data,
    beforeSend: function(){
          $(".savingpopup").fadeIn();
          
    },  
    success: function(data) { 
          updateCompletedStatus(data.property_list_id);
            setTimeout(function() {
                    $(".savingpopup").fadeOut();
                    //$("#general_loading_saving_wrapper").hide();
                    $("#general_tab_section" ).addClass( "activetik" );
                    //$('#general_loading_saving_background').css('display','none');   
                    setTimeout(function() {   
                      if(data.previous_completed_status == 0 && data.count_result == 3){
                        inform();
                      }    
                  }, 1000);
              }, 5000);       
          } 
    });
    return false;
  }
});

function inform(){
    $('#balancealert').provabPopup({
        modalClose: true, 
        zIndex: 10000005
    });
}

function updateCompletedStatus(prop_id){
    var data = {};
    data['prop_id'] = prop_id;
    $.ajax({
    type: 'POST',
    url: WEB_URL + "/listings/updateCompletedStatus",
    async: true,
    dataType: 'json',
    data: data,
    success: function(data) {
        if(data.result == 0){
          $('.bigstep').html("Property ready for listing");
        }else{
          $('#completed_status_number').html(data.result);  
        }        
      }
    });
  }

$("#property_rent").validate({
  submitHandler: function() { 

    var data_lmd = {}; 
    lmd_days = [];
    lmd_discount = [];

    var data = {};

    if($('#early_birds').prop('checked')) {
    data['early_bird_days'] = $('#early_bird_days').val();
    data['early_bird_discount'] = $('#early_bird_discount').val();
    }

    if($('#lastminute_discounts').prop('checked')) {  
    $(".lmd_disc").each(function() {        
    var id = $(this).data("id");        
    lmd_days.push($('.lastminute_discounts_days_'+id).val());
    lmd_discount.push($('.lastminute_discounts_'+id).val());
    });   
    }

    data['lmd_days'] = lmd_days;
    data['lmd_discount'] = lmd_discount;

    spd_checkin = [];
    spd_checkout = [];
    spd_validfrom = [];
    spd_validto = [];
    spd_valid_disountname = [];
    spd_valid_disountper = [];

    if($('#special_discounts').prop('checked')) { 
    $(".spd_prop").each(function() {
    var id = $(this).data("id");  
    spd_checkin.push($('#check_in_'+id).val());
    spd_checkout.push($('#check_out_'+id).val());
    spd_validfrom.push($('#valid_from_'+id).val());
    spd_validto.push($('#valid_to_'+id).val());
    spd_valid_disountname.push($('#discount_name_'+id).val());
    spd_valid_disountper.push($('#discount_per_'+id).val());
    });   
    }

    data['spd_checkin'] = spd_checkin;
    data['spd_checkout'] = spd_checkout;
    data['spd_validfrom'] = spd_validfrom;
    data['spd_validto'] = spd_validto;
    data['spd_valid_disountname'] = spd_valid_disountname;
    data['spd_valid_disountper'] = spd_valid_disountper;  

    data['edit_listings_discounts'] = $('#edit_listings_discounts').val();  
    
    data['all_items']  = $("#property_rent").serialize();
    $.ajax({
      type: 'POST',
      url: WEB_URL + "/listings/update_listing_property_step6",
      async: true,
      dataType: 'json',
      data: data,
      beforeSend: function(){
        $(".savingpopup").fadeIn();
      },  
      success: function(data) {
       updateCompletedStatus(data.property_list_id);
          setTimeout(function() {
                  $(".savingpopup").fadeOut();
                  $( "#rent_tab_section" ).addClass( "activetik" );
                  setTimeout(function() {
                    if(data.previous_completed_status == 0 && data.count_result == 3){
                       inform();
                    }    
                  }, 1000);                           
              }, 5000);
        }
  });
  return false;
  }
});   

$( "#property_udpa" ).submit(function() {
var name = [];
var value = [];

$( ".udpa_input" ).each(function() {			
name.push($(this).attr('name'));
value.push($(this).val());
});		
var data = {};
data['name'] = name;
data['value'] = value;
data['edit_listings_udpa'] = $('#edit_listings_udpa').val();

$.ajax({
type: 'POST',
url: WEB_URL + "/listings/update_listing_property_step2",
async: true,
dataType: 'json',
data: data,
beforeSend: function(){
$("#udpa_loading_saving").show();
$('.udpa_loading_saving_open').click();
},	
success: function(data) {
setTimeout(function() {
$("#udpa_loading_saving").hide();
$( "#udpa_tab_section" ).addClass( "activetik" );
}, 5000);				

}
});

return false;
});

function delete_photo(id){
$('#'+id).remove();
}

$( "#property_photo_submit" ).click(function() {	

var image = [];
var image_name = [];
var image_comment = [];
var image_panaromic = [];

$(".property_photos_search").each(function() {
var id = $(this).attr("id")
image.push($('#image_'+id).val());
image_name.push($('#image_name_'+id).val());
image_comment.push($('#image_comment_'+id).val());

if($('#panaromic_'+id).is(':checked'))
{
image_panaromic.push(1);
}
else
{
image_panaromic.push(0);	
}

});


if(image.length <= 0){
alert("Please upload atleast 1 image");
return false;
}

var data = {};
data['image'] = image;
data['image_name'] = image_name;
data['image_comment'] = image_comment;
data['image_panaromic'] = image_panaromic;		
data['property_id'] = $('#edit_listings_photos').val();		

$.ajax({
type: 'POST',
url: WEB_URL + "/listings/update_listing_property_step3",
async: true,
dataType: 'json',
data: data,
beforeSend: function(){
  $(".savingpopup").fadeIn();
},	
success: function(data) {
    updateCompletedStatus(data.property_list_id); 
    setTimeout(function() {
        $(".savingpopup").fadeOut();
        $( "#photo_tab_section" ).addClass( "activetik" );
       setTimeout(function() {
          if(data.previous_completed_status == 0 && data.count_result == 3){
            inform();
          }    
        }, 1000);                           
     }, 5000);
  }
});
});

/*$( "#property_rent_submit123" ).click(function() {

		var data_lmd = {}; 
		lmd_days = [];
		lmd_discount = [];

		var data = {};

		if($('#early_birds').prop('checked')) {
		data['early_bird_days'] = $('#early_bird_days').val();
		data['early_bird_discount'] = $('#early_bird_discount').val();
		}

		if($('#lastminute_discounts').prop('checked')) {	
		$(".lmd_disc").each(function() {				
		var id = $(this).data("id");				
		lmd_days.push($('.lastminute_discounts_days_'+id).val());
		lmd_discount.push($('.lastminute_discounts_'+id).val());
		});		
		}

		data['lmd_days'] = lmd_days;
		data['lmd_discount'] = lmd_discount;

		spd_checkin = [];
		spd_checkout = [];
		spd_validfrom = [];
		spd_validto = [];
		spd_valid_disountname = [];
		spd_valid_disountper = [];

		if($('#special_discounts').prop('checked')) {	
		$(".spd_prop").each(function() {
		var id = $(this).data("id");	
		spd_checkin.push($('#check_in_'+id).val());
		spd_checkout.push($('#check_out_'+id).val());
		spd_validfrom.push($('#valid_from_'+id).val());
		spd_validto.push($('#valid_to_'+id).val());
		spd_valid_disountname.push($('#discount_name_'+id).val());
		spd_valid_disountper.push($('#discount_per_'+id).val());
		});		
		}

		data['spd_checkin'] = spd_checkin;
		data['spd_checkout'] = spd_checkout;
		data['spd_validfrom'] = spd_validfrom;
		data['spd_validto'] = spd_validto;
		data['spd_valid_disountname'] = spd_valid_disountname;
		data['spd_valid_disountper'] = spd_valid_disountper;	

		data['edit_listings_discounts'] = $('#edit_listings_discounts').val();	
		
		data['all_items']  = $("#property_rent").serialize();
		$.ajax({
			type: 'POST',
			url: WEB_URL + "/listings/update_listing_property_step6",
			async: true,
			dataType: 'json',
			data: data,
			beforeSend: function(){
			$("#rent_loading_saving").show();
      $('#rent_loading_saving_background').css('display','block');
			$('.rent_loading_saving_open').click();
			},	
			success: function(data) {
			setTimeout(function() {
			$("#rent_loading_saving").hide();
			$( "#rent_tab_section" ).addClass( "activetik" );
      $('#rent_loading_saving_background').css('display','none');
			}, 5000);				
			}
	});
});*/

$( "#property_otherfees_submit" ).click(function() {	
		$.ajax({
			type: 'POST',
			url: WEB_URL + "/listings/update_listing_property_step5",
			async: true,
			dataType: 'json',
			data: $("#otherfees").serialize(),
			beforeSend: function(){
			$("#otherfess_loading_saving").show();
			$('.otherfess_loading_saving_open').click();
			},	
			success: function(data) {
			setTimeout(function() {
			$("#otherfess_loading_saving").hide();
			$( "#otherfees_tab_section" ).addClass( "activetik" );
			}, 5000);				
			}
	});
});


$( "#property_discounts_submit" ).click(function() {
var data_lmd = {}; 
lmd_days = [];
lmd_discount = [];

var data = {};

if($('#early_birds').prop('checked')) {
data['early_bird_days'] = $('#early_bird_days').val();
data['early_bird_discount'] = $('#early_bird_discount').val();
}

if($('#lastminute_discounts').prop('checked')) {	
$(".lmd_disc").each(function() {				
var id = $(this).data("id");				
lmd_days.push($('.lastminute_discounts_days_'+id).val());
lmd_discount.push($('.lastminute_discounts_'+id).val());
});		
}

data['lmd_days'] = lmd_days;
data['lmd_discount'] = lmd_discount;

spd_checkin = [];
spd_checkout = [];
spd_validfrom = [];
spd_validto = [];
spd_valid_disountname = [];
spd_valid_disountper = [];

if($('#special_discounts').prop('checked')) {	
$(".spd_prop").each(function() {
var id = $(this).data("id");	
spd_checkin.push($('#check_in_'+id).val());
spd_checkout.push($('#check_out_'+id).val());
spd_validfrom.push($('#valid_from_'+id).val());
spd_validto.push($('#valid_to_'+id).val());
spd_valid_disountname.push($('#discount_name_'+id).val());
spd_valid_disountper.push($('#discount_per_'+id).val());
});		
}

data['spd_checkin'] = spd_checkin;
data['spd_checkout'] = spd_checkout;
data['spd_validfrom'] = spd_validfrom;
data['spd_validto'] = spd_validto;
data['spd_valid_disountname'] = spd_valid_disountname;
data['spd_valid_disountper'] = spd_valid_disountper;	

data['edit_listings_discounts'] = $('#edit_listings_discounts').val();	

$.ajax({
type: 'POST',
url: WEB_URL + "/listings/update_listing_property_step4",
async: true,
dataType: 'json',
data: data,
beforeSend: function(){
$("#discounts_loading_saving").show();
$('.discounts_loading_saving_open').click();
},	
success: function(data) {
setTimeout(function() {
$("#discounts_loading_saving").hide();
$("#discounts_tab_section" ).addClass( "activetik" );
}, 5000);				
}
});
});

function get_fess_value(value, id, fees_id) {
var res = id.split("_");
if (value == 'AMOUNT')
{
var shtml = '<input type="text" style="width: 50%;" required="required" name="fees_value_' + fees_id + '" class="form-control" >';
$('#fees_value_' + res[1]).html(shtml);
}
if (value == 'AMOUNT_PER_NIGHT')
{
var shtml = '<input type="text" style="width: 50%;" required="required" name="fees_value_' + fees_id + '" class="form-control" >';
$('#fees_value_' + res[1]).html(shtml);
}
if (value == 'AMOUNT_PER_GUEST')
{
var shtml = '<label style="padding-left: 10px;">Per Adult :</label> <input type="text" required="required" style="width: 50%;" class="form-control" name="fees_value_adult_' + fees_id + '"><label style="padding-left: 10px;">Per Child :</label> <input type="text" required="required" style="width: 50%;" class="form-control" name="fees_value_child_' + fees_id + '"><label style="padding-left: 10px;">Per Baby :</label> <input style="width: 50%;" type="text" required="required" class="form-control" name="fees_value_baby_' + fees_id + '">';
$('#fees_value_' + res[1]).html(shtml);
}
if (value == 'PERCENT_RENT')
{
var shtml = '<input type="text" style="width: 50%;" required="required" class="form-control" name="fees_value_' + fees_id + '">%';
$('#fees_value_' + res[1]).html(shtml);
}
if (value == 'AMOUNT_PER_NIGHT_PER_GUEST')
{
var shtml = '<label style="padding-left:10px;">Per Adult :</label> <input required="required" type="text" style="width: 50%;" class="form-control" name="fees_value_adult_' + fees_id + '"><label style="padding-left: 10px;">Per Child :</label> <input type="text"  required="required" style="width: 50%;" class="form-control" name="fees_value_child_' + fees_id + '"><label style="padding-left: 10px;">Per Baby :</label> <input type="text" style="width: 50%;" required="required" class="form-control" name="fees_value_baby_' + fees_id + '">';
$('#fees_value_' + res[1]).html(shtml);
}

if (value == 'STAYLENGTH')
{
var a = uniquid();
var b = uniquid();

var shtml 	= 	'<div class="responsive-table"><div class="scrollable-area"><table class="table table-bordered table-striped" style="margin-bottom:0;"><thead><tr><th>1 night - 6 night</th><th>7 night - < 1 month</th></tr>';
                shtml += '<tr><th><select onchange="get_staylength_value(this.value, \'' + a + '\',\'' + fees_id + '\',1,\'NIGHT\')" name="fees_value_staylength_unit_' + fees_id + '[]" required="required"><option value="AMOUNT">Amount</option><option value="PERCENT_RENT">% of rent</option><option  value="AMOUNT_PER_NIGHT_PER_GUEST">Amount per night, per guest</option> <option value="AMOUNT_PER_GUEST">Amount per guest</option></select></th>';
                shtml += '<th><select onchange="get_staylength_value(this.value, \'' + b + '\',\'' + fees_id + '\',7,\'NIGHT\')" name="fees_value_staylength_unit_' + fees_id + '[]"><option value="AMOUNT">Amount</option><option value="PERCENT_RENT">% of rent</option><option value="AMOUNT_PER_NIGHT_PER_GUEST">Amount per night, per guest</option> <option value="AMOUNT_PER_GUEST">Amount per guest</option></select></th></tr></thead>';
				shtml += '<tbody><tr><td class="staylength_value_' + a + '" ><input type="text" required="required" class="form-control" name="fees_value_staylength_value_amt_' + fees_id + '[1][NIGHT]"></td><td class="staylength_value_' + b + '"><input type="text" required="required" class="form-control" name="fees_value_staylength_value_amt_' + fees_id + '[7][NIGHT]"></td></tr></tbody></table></div></div>';
				$('#fees_value_' + res[1]).html(shtml);
}
}


function enable_fees(id, thisref, fees_type_id) {
var res = id.split("_");
if ($(thisref).prop('checked') == true)
{
$('#include_' + res[1]).prop('disabled', false);
$('#unit_' + res[1]).prop('disabled', false);
$('#fees_value_' + res[1]).html("<input type='text' required='required' class='form-control' name='fees_value_" + fees_type_id + "' /> ");
}
else
{
$('#include_' + res[1]).prop('disabled', true);
$('#unit_' + res[1]).prop('disabled', true);
$('#fees_value_' + res[1]).html("");
}
}

function uniquid() {
var n = Math.floor(Math.random() * 11);
var k = Math.floor(Math.random() * 1000000);
var m = n + k;
return m;
}

function get_staylength_value(value, id, fees_id, nights, unit) {

if (value == 'AMOUNT') {
var shtml = '<input type="text" required="required" style="width: 100%;" name="fees_value_staylength_value_amt_' + fees_id + '[' + nights + '][' + unit + ']" class="form-control" ></td>';

$('.staylength_value_' + id).html(shtml);
}
if (value == 'PERCENT_RENT') {
var shtml = '<input type="text" required="required" style="width: 100%;" name="fees_value_staylength_value_pct_' + fees_id + '[' + nights + '][' + unit + ']" class="form-control" ></td>';
$('.staylength_value_' + id).html(shtml);
}
if (value == 'AMOUNT_PER_NIGHT_PER_GUEST') {
var shtml = '<input name="fees_value_staylength_value_adult_' + fees_id + '[' + nights + '][' + unit + ']" class="form-control" type="text" required="required"><input name="fees_value_staylength_value_child_' + fees_id + '[' + nights + '][' + unit + ']" class="form-control" type="text" required="required"><input name="fees_value_staylength_value_baby_' + fees_id + '[' + nights + '][' + unit + ']" class="form-control" type="text" required="required">';
$('.staylength_value_' + id).html(shtml);
}
if (value == 'AMOUNT_PER_GUEST') {
var shtml = '<input name="fees_value_staylength_value_adult_apg' + fees_id + '[' + nights + '][' + unit + ']" class="form-control" type="text" required="required"><input name="fees_value_staylength_value_child_apg' + fees_id + '[' + nights + '][' + unit + ']" class="form-control" type="text" required="required"><input name="fees_value_staylength_value_baby_apg' + fees_id + '[' + nights + '][' + unit + ']" class="form-control" type="text" required="required">';
$('.staylength_value_' + id).html(shtml);
}
}


function get_property_pgc()
{
    var data = {};
    data['perguest_type'] = $('#perguest_type').val();
    data['perguest_standard_occupancy'] = $('#perguest_standard_occupancy').val();
    data['perguest_max_occupancy'] = $('#perguest_max_occupancy').val();

    $.ajax({
        type: 'POST',
        url: WEB_URL + "/listings/get_property_perguest",
        async: true,
        dataType: 'json',
        data: data,
        success: function(data) {
            $('#modal-content2').html(data.result);
        }
    });

}

function change_property_pgc() {
    
    $(".weekly_rental").each(function() {
        $(this).prop("checked", false);
    });
    
    var perguest_type = $('#perguest_sel_type').val();
    var perguest_standard_occupancy = $('#perguest_sel_standard_occupancy').val();
    var perguest_max_occupancy = $('#perguest_sel_max_occupancy').val();

    $('#perguest_type').val(perguest_type);
    $('#perguest_standard_occupancy').val(perguest_standard_occupancy);
    $('#perguest_max_occupancy').val(perguest_max_occupancy);

    var period_range_count = $('.period_range_count').val();

    var data = {};
    data['perguest_standard_occupancy'] = perguest_standard_occupancy;
    data['perguest_max_occupancy'] = perguest_max_occupancy;
    data['period_range_count'] = period_range_count;
    data['period_range_json_value'] = JSON.parse(atob($('.period_range_json_value').val()));
    data['period_total_count'] = parseInt($('#period_total_count').val());

    if ($('#enable_now').prop("checked"))
    {
        data['enable_now'] = 1;
    }
    else
    {
        data['enable_now'] = 0;
    }
    if ($('#enable_pgc').prop("checked"))
    {
        data['enable_pgc'] = 1;
    }
    else
    {
        data['enable_pgc'] = 0;
    }

    $.ajax({
        type: 'POST',
        url: WEB_URL + "/listings/get_changed_property_now_epc",
        async: true,
        dataType: 'json',
        data: data,
        success: function(data) {

            for (var i = 0; i <= data.result.length; i++)
            {
                $("#property_pricing_display_" + i + " > tbody").html("");
                $("#property_pricing_display_" + i + " > tbody").html(data.result[i]);
            }
            var i = 0;
            $(".add_new_now_class").each(function() {
                $(this).attr('onclick', 'add_new_now("1","add_new_now_' + i + '")');
                i++;
            });
        }
    });

    $('#modal-example2').modal('hide');
}

function ed_property_pgc() {
    
    $(".weekly_rental").each(function() {
        $(this).prop("checked", false);
    });
    
    if ($('#enable_pgc').prop("checked"))
    {
        if ($('#settings_pgc').lenght > 0)
        {
            $('#settings_pgc').css('display', 'block');
        }
        else
        {
            var settings_pgc_content = '<a  id="settings_pgc" style="padding-top: 4px; float: left;font-size: 10px;font-weight: bold;padding-left: 10px;text-decoration: underline;"  title="Change Settings" data-placement="top" href="#modal-example2" data-toggle="modal" onclick="get_property_pgc();">Change Settings</a>';
            $('#settings_pgc_content').html(settings_pgc_content);
        }

        $('#perguest_type').val('ADULT');
        $('#perguest_standard_occupancy').val('1');
        $('#perguest_max_occupancy').val('2');

        var data = {};
        data['perguest_standard_occupancy'] = $('#perguest_standard_occupancy').val();
        data['perguest_max_occupancy'] = $('#perguest_max_occupancy').val();
        data['period_range_count'] = $('.period_range_count').val();
        if ($('#enable_now').prop("checked"))
        {
            data['enable_now'] = 1;
        }
        else
        {
            data['enable_now'] = 0;
        }
        data['enable_pgc'] = 1;
        data['period_range_json_value'] = JSON.parse(atob($('.period_range_json_value').val()));
        data['period_total_count'] = parseInt($('#period_total_count').val());

        $.ajax({
            type: 'POST',
            url: WEB_URL + "/listings/get_changed_property_now_epc",
            async: true,
            dataType: 'json',
            data: data,
            success: function(data) {
                for (var i = 0; i <= data.result.length; i++)
                {
                    $("#property_pricing_display_" + i + " > tbody").html("");
                    $("#property_pricing_display_" + i + " > tbody").html(data.result[i]);
                }

                var i = 0;
                $(".add_new_now_class").each(function() {
                    $(this).attr('onclick', 'add_new_now("1","add_new_now_' + i + '")');
                    i++;
                });

            }
        });
    }
    else
    {
        $('#settings_pgc').css('display', 'none');
        var data = {};
        data['perguest_standard_occupancy'] = 0;
        data['perguest_max_occupancy'] = 0;

        $('#perguest_standard_occupancy').val(data['perguest_standard_occupancy']);
        $('#perguest_max_occupancy').val(data['perguest_max_occupancy']);

        var period_range_count = $('.period_range_count').val();
        data['period_range_count'] = period_range_count;

        if ($('#enable_now').prop("checked"))
        {
            data['enable_now'] = 1;
        }
        else
        {
            data['enable_now'] = 0;
        }
        data['enable_pgc'] = 0;
        data['period_range_json_value'] = JSON.parse(atob($('.period_range_json_value').val()));
        data['period_total_count'] = parseInt($('#period_total_count').val());

        $.ajax({
            type: 'POST',
            url: WEB_URL + "/listings/get_changed_property_now_epc",
            async: true,
            dataType: 'json',
            data: data,
            success: function(data) {
                for (var i = 0; i <= data.result.length; i++)
                {
                    $("#property_pricing_display_" + i + " > tbody").html("");
                    $("#property_pricing_display_" + i + " > tbody").html(data.result[i]);
                }
                var i = 0;
                $(".add_new_now_class").each(function() {
                    $(this).attr('onclick', 'add_new_now("1","add_new_now_' + i + '")');
                    i++;
                });
            }
        });
    }
}

function ed_property_now()
{
    $(".weekly_rental").each(function() {
        $(this).prop("checked",false);
    });
    
    if ($('#enable_now').prop("checked"))
    {
        var data = {};
        data['perguest_standard_occupancy'] = $('#perguest_standard_occupancy').val();
        data['perguest_max_occupancy'] = $('#perguest_max_occupancy').val();
        data['period_range_count'] = $('.period_range_count').val();
        data['enable_now'] = 1;
        if ($('#enable_pgc').prop("checked"))
        {
            data['enable_pgc'] = 1;
        }
        else
        {
            data['enable_pgc'] = 0;
        }
        data['period_range_json_value'] = JSON.parse(atob($('.period_range_json_value').val()));
        data['period_total_count'] = parseInt($('#period_total_count').val());

        $.ajax({
            type: 'POST',
            url: WEB_URL + "/listings/get_changed_property_now_epc",
            async: true,
            dataType: 'json',
            data: data,
            success: function(data) {
                for (var i = 0; i <= data.result.length; i++)
                {
                    $("#property_pricing_display_" + i + " > tbody").html("");
                    $("#property_pricing_display_" + i + " > tbody").html(data.result[i]);
                }

                var sHtml = '<tr><td><a onclick="add_new_now("1", this.id);" id="add_new_now_1" class="add_new_now_class" href="javascript:void(0);">Add a new night-of-week group</a></td></tr>';
                $(".add_new_now > tbody").html(sHtml);
                
                var i = 0;
                $(".add_new_now_class").each(function() {
                    $(this).attr('id', 'add_new_now_' + i);
                    $(this).attr('onclick', 'add_new_now("1","add_new_now_' + i + '")');
                    i++;
                });
            }
        });
    }
    else
    {
        var data = {};
        data['perguest_standard_occupancy'] = $('#perguest_standard_occupancy').val();
        data['perguest_max_occupancy'] = $('#perguest_max_occupancy').val();
        data['period_range_count'] = $('.period_range_count').val();
        data['enable_now'] = 0;
        if ($('#enable_pgc').prop("checked"))
        {
            data['enable_pgc'] = 1;
        }
        else
        {
            data['enable_pgc'] = 0;
        }
        data['period_range_json_value'] = JSON.parse(atob($('.period_range_json_value').val()));
        data['period_total_count'] = parseInt($('#period_total_count').val());

        $.ajax({
            type: 'POST',
            url: WEB_URL + "/listings/get_changed_property_now_epc",
            async: true,
            dataType: 'json',
            data: data,
            success: function(data) {

                for (var i = 0; i <= data.result.length; i++)
                {
                    $("#property_pricing_display_" + i + " > tbody").html("");
                    $("#property_pricing_display_" + i + " > tbody").html(data.result[i]);
                }
                $(".add_new_now > tbody").html("");

                var i = 0;
                $(".add_new_now_class").each(function() {
                    $(this).attr('onclick', 'add_new_now("1","add_new_now_' + i + '")');
                    i++;
                });
            }
        });
    }
}

function add_new_now(now_count, id) {
    var data = {};

    data['period_range_count'] = $('.period_range_count').val();
    data['enable_now'] = 1;
    if ($('#enable_pgc').prop("checked"))
    {
        data['perguest_standard_occupancy'] = $('#perguest_standard_occupancy').val();
        data['perguest_max_occupancy'] = $('#perguest_max_occupancy').val();
        data['enable_pgc'] = 1;
    }
    else
    {
        data['perguest_standard_occupancy'] = 0;
        data['perguest_max_occupancy'] = 0;
        data['enable_pgc'] = 0;
    }
    data['period_range_json_value'] = JSON.parse(atob($('.period_range_json_value').val()));
    var lastItem = id.split("_").pop(-1);
    data['period_total_count'] = lastItem;
    data['now_count'] = now_count;
    data['id'] = id;

    if (now_count < 7)
    {
        now_count++;
        $('#' + id).attr('onclick', 'add_new_now("' + now_count + '","' + id + '")');
        $.ajax({
            type: 'POST',
            url: WEB_URL + "/listings/add_new_now",
            async: true,
            dataType: 'json',
            data: data,
            success: function(data) {
                $("#property_pricing_display_" + lastItem + " tbody").append(data.result);
            }
        });
    }
    else
    {
        alert("You can not add more than 7 nights");
    }
}

function delete_period(id)
{
    $('#' + id).remove();
    var period_total_count = parseInt($('#period_total_count').val());
    period_total_count--;
    $('#period_total_count').val(period_total_count);
}

function add_new_period(returntype)
{
    var data = {};

    data['period_range_count'] = $('.period_range_count').val();
    data['period_total_count'] = parseInt($('#period_total_count').val());

    var period_total_count = data['period_total_count'];
    var temp = period_total_count + 1;
    $('#period_total_count').val(temp);

    data['period_range_value'] = $('.period_range_value').val();

    if ($('#enable_now').prop("checked"))
    {
        data['enable_now'] = 1;
    }
    else
    {
        data['enable_now'] = 0;
    }

    if ($('#enable_pgc').prop("checked"))
    {
        data['perguest_standard_occupancy'] = $('#perguest_standard_occupancy').val();
        data['perguest_max_occupancy'] = $('#perguest_max_occupancy').val();
        data['enable_pgc'] = 1;
    }
    else
    {
        data['perguest_standard_occupancy'] = 0;
        data['perguest_max_occupancy'] = 0;
        data['enable_pgc'] = 0;
    }
    data['period_range_json_value'] = JSON.parse(atob($('.period_range_json_value').val()));

    $.ajax({
        type: 'POST',
            url: WEB_URL + "/listings/add_new_period",
        async: true,
        dataType: 'json',
        data: data,
        success: function(data) {
            $('.main_container_content').last().after(data.result);
            jQuery( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });


            jQuery('.datepickerin').datepicker({
            numberOfMonths: 1,
            firstDay: 1,
            dateFormat: 'yy-mm-dd',
            minDate: '0',
            onSelect: function(dateStr) {
                var d1 = $(this).datepicker("getDate");
                d1.setDate(d1.getDate() + 1); // change to + 1 if necessary
                var d2 = $(this).datepicker("getDate");
                d2.setDate(d2.getDate() + 30); // change to + 29 if necessary
                $(".datepickerout").datepicker("setDate", d1);
                $(".datepickerout").datepicker("option", "minDate", d1);
                //$("#to").datepicker("option", "maxDate", d2);
            },
            onClose: function(){
              $('.datepickerout').focus();
            }
        });
        //jQuery( ".checkin_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
        jQuery( ".datepickerout" ).datepicker({ 
            dateFormat: 'yy-mm-dd',
            onClose: function( selectedDate ) {
                $ ( ".datepickerin" ).datepicker( "option", "maxDate", selectedDate );
            }

        });

        }
    });

}

function add_new_night_period() {
    var period_range_json_value = JSON.parse(atob($('.period_range_json_value').val()));

    var period_range_length = $('#period_range_length').val();
    var period_range_unit = $('#period_range_unit').val();

    if (period_range_unit == 'NIGHT')
    {
        if (!(period_range_length in period_range_json_value.NIGHT))
        {
            period_range_json_value.NIGHT[period_range_length] = "";
        }
        else
        {
            alert("Please dont select the same night");
            return false;
        }
    }

    if (period_range_unit == 'MONTH')
    {
        if (!(period_range_length in period_range_json_value.MONTH))
        {
            period_range_json_value.MONTH[period_range_length] = "";
        }
        else
        {
            alert("Please dont select the same month");
            return false;
        }
    }

    if (period_range_unit == 'YEAR')
    {
        if ('YEAR' in period_range_json_value)
        {
            if (!(period_range_length in period_range_json_value.YEAR))
            {
                period_range_json_value.YEAR[period_range_length] = "";
            }
            else
            {
                alert("Please dont select the same year");
                return false;
            }
        }
        else
        {
            var temp = {};
            temp[period_range_length] = "";
            period_range_json_value.YEAR = temp;
        }
    }

    var night_keys = Object.keys(period_range_json_value.NIGHT);
    var month_keys = Object.keys(period_range_json_value.MONTH);

    var main_array = new Array();

    for (var i = 0; i < night_keys.length; i++)
    {
        if (typeof night_keys[i + 1] !== 'undefined')
        {
            main_array.push(night_keys[i] + ' night - ' + (night_keys[i + 1] - 1) + ' night');
        }
        else
        {
            main_array.push(night_keys[i] + ' night - < 1 month');
        }
    }

    for (var i = 0; i < month_keys.length; i++)
    {
        if (typeof month_keys[i + 1] !== 'undefined')
        {
            main_array.push(month_keys[i] + ' month - < ' + (month_keys[i + 1] - 1) + ' month');
        }
        else
        {
            main_array.push(month_keys[i] + ' month or longer');
        }
    }

    if ('YEAR' in period_range_json_value)
    {
        var year_keys = Object.keys(period_range_json_value.YEAR);
        for (var i = 0; i < year_keys.length; i++)
        {
            if (typeof year_keys[i + 1] !== 'undefined')
            {
                main_array.push(year_keys[i] + ' year - < ' + (year_keys[i + 1] - 1) + ' year');
            }
            else
            {
                main_array.push(year_keys[i] + ' year or longer');
            }
        }
    }

    var all_concat = JSON.stringify(period_range_json_value);
    var base64_data = btoa(all_concat);
    var period_range_count = parseInt($('.period_range_count').val());
    period_range_count++;
    $('.period_range_count').val(period_range_count);
    $('.period_range_json_value').val(base64_data);
    $('.period_range_value').val(main_array.join());

    var data = {};

    data['period_range_count'] = $('.period_range_count').val();
    data['period_total_count'] = parseInt($('#period_total_count').val());
    var period_total_count = data['period_total_count'];


    data['period_range_value'] = $('.period_range_value').val();

    if ($('#enable_now').prop("checked"))
    {
        data['enable_now'] = 1;
    }
    else
    {
        data['enable_now'] = 0;
    }

    if ($('#enable_pgc').prop("checked"))
    {
        data['perguest_standard_occupancy'] = $('#perguest_standard_occupancy').val();
        data['perguest_max_occupancy'] = $('#perguest_max_occupancy').val();
        data['enable_pgc'] = 1;
    }
    else
    {
        data['perguest_standard_occupancy'] = 0;
        data['perguest_max_occupancy'] = 0;
        data['enable_pgc'] = 0;
    }
    data['period_range_json_value'] = JSON.parse(atob($('.period_range_json_value').val()));

    $.ajax({
        type: 'POST',
        url: WEB_URL + "/listings/add_new_night_period",
        async: true,
        dataType: 'json',
        data: data,
        success: function(data) {
            for (var i = 0; i <= data.result.length; i++)
            {
                $("#property_pricing_display_" + i).html("");
                $("#property_pricing_display_" + i).html(data.result[i]);
            }
            $('#modal-example3').modal('hide');
        }
    });
}

function delete_now(id, now_count, now_id) {
    $('.' + id).remove();
    now_count--;
    $('#' + now_id).attr('onclick', 'add_new_now("' + now_count + '","' + now_id + '")');
}

function change_now_selction(period_id, now_count, week_id, this_ref)
{

    $('#property_pricing_display_' + period_id + ' input:checkbox').each(function() {
        var class_name = $(this).attr('class');
        if (class_name != "kon_" + period_id + "_" + now_count)
        {
            if ($(this).is(':checked'))
            {
                var value = $(this).val();
                if (value == week_id)
                {
                    $(this).prop('checked', false);
                }
            }
        }
    });

    var class_names_array = [];
    var internal_id = [];

    $('#property_pricing_display_' + period_id + ' input:checkbox').each(function() {
        class_names_array.push($(this).attr('class'));
        internal_id.push($(this).attr("data-id"));
    });

    $.unique(class_names_array);
    $.unique(internal_id);

    for (var i = 0; i < class_names_array.length; i++)
    {
        var checked_values = [];
        $('.' + class_names_array[i]).each(function() {
            if ($(this).is(':checked')) {
                checked_values.push($(this).val());
            }
        });
        var final_value = checked_values.toString();
        var res = class_names_array[i].split("_");
        $('.nightly_amount_' + res[1] + '_' + res[2]).each(function() {
            var name = $(this).attr('name');
            var temp = name.split("[");
            var temp1 = temp[2].replace(temp[2], final_value);
            temp[1] = "[" + temp[1];
            temp[2] = "[" + temp1 + "]";
            temp[3] = "[" + temp[3];
            temp[4] = "[" + temp[4];
            temp[5] = "[" + temp[5];

            var temp2 = temp.join('');
            $(this).attr('name', temp2);
        });

        if (final_value.length === 0)
        {
            var Html = '<tr class="' + internal_id[i] + '"><td><a onclick="delete_now(\'' + internal_id[i] + '\',\'' + res[1] + '\',\'add_new_now_' + res[2] + '\')" href="javascript:void(0);">Delete Week Group</a></td><td></td></tr>';
            $('.' + internal_id[i] + ':last').html(Html);
        }

    }
}

function get_min_price_stay_value(value, id, select_id)
{
		var data = {};
		data['value'] = value;
		data['select_id'] = select_id;

		$.ajax({
			type: 'POST',
			url: WEB_URL + "/listings/get_price_min_stay_value",
			async: true,
			dataType: 'json',
			data: data,
			success: function(data) {
				$('#price_min_stay_' + id).html(data.result);
			}
		});
}

function toggle_weekly_rental(c_period_count) {

    if ($('#toggle_weekly_rental_' + c_period_count).prop("checked"))
    {
        var data = {};
        data['c_period_count'] = c_period_count;

        data['perguest_standard_occupancy'] = $('#perguest_standard_occupancy').val();
        data['perguest_max_occupancy'] = $('#perguest_max_occupancy').val();
        data['enable_pgc'] = 1;

        $.ajax({
            type: 'POST',
            url: WEB_URL + "/listings/ed_week_rental",
            async: true,
            dataType: 'json',
            data: data,
            success: function(data) {
                $('#property_pricing_display_' + c_period_count+' > tbody' ).html("");
                $('#property_pricing_display_' + c_period_count+' > tbody' ).html(data.result);
            }
        });
    }
    else
    {
        ed_property_pgc();
    }
}

function change_max_occupancy(value) {
    value++;
    var Html = '<select style="width: 50%;" name="perguest_sel_max_occupancy" id="perguest_sel_max_occupancy" class="select2 form-control">';
    for (i = value; i <= 30; i++)
    {
        Html += '<option value="' + i + '">' + i + '</option>';
    }
    Html += '</select>';
    $('#max_occu_dyn').html(Html);
}

function get_unit_stay_value(value, select_id)
{
    var data = {};
    data['value'] = value;
    data['select_id'] = select_id;

    $.ajax({
        type: 'POST',
        url: WEB_URL + "/listings/get_min_stay_value",
        async: true,
        dataType: 'json',
        data: data,
        success: function(data) {
            $('#stay_unit_value').html(data.result);
        }
    });
}

function change_listings_status(prop_id,status){
	var data = {};
	data['prop_id'] = prop_id;
	data['status'] = status;
	
	$.ajax({
        type: 'POST',
        url: WEB_URL + "/listings/change_listings_status",
        async: true,
        dataType: 'json',
        data: data,
        success: function(data) {
        }
    });	
}

$('.edit_listings_statusa').on('click', function() {
  var prop_id = $(this).data('propid');
  if ($(this).is(":checked")) {
      status = "1";
      change_listings_status(prop_id,status)
  } else {
      status = "0";
      change_listings_status(prop_id,status)
  }
})


//  Sanjay  Apartments 

//Home Page Starts

//Adult Child Combination Validation Starts
$("#adult").change("click",function(){
  persons();
  var adult = +$(this).val();
  var max = 9;
  var child = max-adult;

  var $childs = '';
  for (i=0; i<=child; i++) {
    $childs += '<option>'+i+'</option>';
  }
  $('#child').html($childs);

  var $infants = '';
  for (i=0; i<=adult; i++) {
    $infants += '<option>'+i+'</option>';
  }
  $('#infant').html($infants);
  persons();
});
$("#child").change("click",function(){
  persons();
});
$("#infant").change("click",function(){
  persons();
});
function persons(){
  var adult = $("#adult").val();
  var chid = $("#child").val();
  var infant = $("#infant").val();
  var persons = +adult + +chid + +infant;
  //$('#persons').val(persons);
}

//Adult Child Combination Validation For Multicity Starts
$("#adult1").change("click",function(){
  persons();
  var adult = +$(this).val();
  var max = 9;
  var child = max-adult;

  var $childs = '';
  for (i=0; i<=child; i++) {
    $childs += '<option>'+i+'</option>';
  }
  $('#child1').html($childs);

  var $infants = '';
  for (i=0; i<=adult; i++) {
    $infants += '<option>'+i+'</option>';
  }
  $('#infant1').html($infants);
  persons();
});
$("#child1").change("click",function(){
  persons();
});
$("#infant1").change("click",function(){
  persons();
});
function persons(){
  var adult = $("#adult1").val();
  var chid = $("#child1").val();
  var infant = $("#infant1").val();
  var persons = +adult + +chid + +infant;
  //$('#persons').val(persons);
}

function swap(){
  var from = $('#from').val();
  var destination = $('#destination').val();
  $('#from').val(destination);
  $('#destination').val(from);
}

    
 $( "#depature" ).datepicker({
	minDate: 0,
	numberOfMonths: 2,
	dateFormat: 'dd/mm/yy',
	maxDate: "+1y",
	onClose: function( selectedDate ) {
		
        $( "#return" ).datepicker( "option", "minDate", selectedDate );
		console.log(1);
		$( '#return' ).focus();
	}
});

$( "#return" ).datepicker({
	minDate: 0,	
	numberOfMonths: 2,
	dateFormat: 'dd/mm/yy',
	maxDate: "+1y",
	onClose: function( selectedDate ) {		
		$( "#depature" ).datepicker( "option", "maxDate", selectedDate );
	}
}); 

//Adult Child Combination Validation Ends


//Currency Convertor
function ChangeCurrency(that){
  var code = $(that).data('code');
  var icon = $(that).data('icon');
  //$('.currencychange').hide();
  var data = {};
  data['code'] = code;
  data['icon'] = icon;
  
  $.ajax({
      type: 'POST',
      url: WEB_URL + "/home/change_currency",
      async: true,
      dataType: 'json',
      data: data,
      success: function(data) {
        location.reload();
      }
  });
}

function dontSubmit (event){
   if (event.keyCode == 13) {
      return false;
   }
}

$(document).on('click','.dshbrdLnk',function() {
  var curUrl = $(this).data('link');
  history.pushState("", "", curUrl);
})
$('.drop-eft').on('mouseenter',function(e){
 e.preventDefault();
 $('ul.drop-spot').addClass("show");
});

$('.drop-spot').on('mouseenter',function(e){
 e.preventDefault();
 $('ul.drop-spot').addClass("show");
});

$('.drop-eft').on('mouseleave',function(e){

setTimeout(function(){ $('ul.drop-spot').removeClass("show"); }, 3000);
  
  return false;
})



//$(window).on('popstate', function(e) {
//  var url = window.location.href;
//  window.location.href = url;
//}); 
