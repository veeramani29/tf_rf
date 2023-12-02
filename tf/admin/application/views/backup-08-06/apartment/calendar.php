<!DOCTYPE html>
<html>
<head>
    <title>Add New Listing | InnoGlobe</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta content='text/html;charset=utf-8' http-equiv='content-type'>
    
    <link href='<?=base_url();?>assets/images/meta_icons/favicon.ico' rel='shortcut icon' type='image/x-icon'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon.png' rel='apple-touch-icon-precomposed'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-57x57.png' rel='apple-touch-icon-precomposed' sizes='57x57'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-72x72.png' rel='apple-touch-icon-precomposed' sizes='72x72'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-114x114.png' rel='apple-touch-icon-precomposed' sizes='114x114'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-144x144.png' rel='apple-touch-icon-precomposed' sizes='144x144'>
    <!-- / START - page related stylesheets [optional] -->
    <link type="text/css" media="all" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" />
    <link href="<?=base_url();?>assets/stylesheets/plugins/fuelux/wizard.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/stylesheets/plugins/select2/select2.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/stylesheets/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/stylesheets/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/stylesheets/plugins/tabdrop/tabdrop.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/stylesheets/plugins/lightbox/lightbox.css" media="screen" rel="stylesheet" type="text/css" />
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
  <body class='contrast-dark fixed-header' onload="initialize()">
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
                      <i class='icon-building'></i>
                      <span>Change Listing Info</span>
                    </h1>
                    <div class='pull-right'>
                      <ul class='breadcrumb'>
                        <li>
                          <a href='index.html'>
                            <i class='icon-bar-chart'></i>
                          </a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li>
                          <a href="<?=base_url();?>/apartment">Apartment Management</a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Listing</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-header blue-background'>
                      <div class='title'>Change Listing  Info <?php echo $result5->listing; ?></div>
                      <div class='actions'> 
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    <div class='box-content'>
                      <form class='form form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>apartment/upd_calender" method="post"> 
                        		      <div class='step-pane' id='step2'>
                            <div class='form-group'>
                           
                           <input type="hidden" value="<?php echo $result5->address; ?>" name="id">
                              <label class='control-label col-sm-2' for='type'>When is your listing available?</label>
                          
                               <!-- <div class='col-sm-5 controls btn-group checkbox' data-toggle='buttons'>
                                <label class='btn btn-primary active'><i class="icon-calendar"></i> 
                                
  <input checked id='type' class='form-control' type='radio' name="listing" value="Always" <?php if('Always'==$result5->listing) {?> 'checked'; <?php } ?>>Always
                                </label>
                                <label class='btn btn-primary'><i class="icon-calendar-empty"></i> 
                                  <input id='type' class='form-control' type='radio' name="listing" value="Sometimes"  <?php if('Sometimes'==$result5->listing) {?> checked='checked' <?php } ?> >Sometimes
                                </label>
                                <label class='btn btn-primary'><i class="icon-calendar"></i> 
                                  <input id='type' class='form-control' type='radio' name="list" value="2"  <?php if(''==$result5->listing) {?> checked='checked' <?php } ?>>One Time
                                </label>
                              </div>  -->
                              
                            
                            <div class='col-sm-5 controls btn-group checkbox' data-toggle='buttons'>
                                <label class='btn btn-primary "<?php if('Always'==$result5->listing) {?> active <?php } ?>"'><i class="icon-calendar"></i> 
                                
  <input checked id='type' class='form-control' type='radio' name="listing" value="Always" <?php if('Always'==$result5->listing) {?> checked='checked' <?php } ?>>Always
                                </label>
                              <label class='btn btn-primary "<?php if('Sometimes'==$result5->listing) {?> active <?php } ?>"'><i class="icon-calendar-empty"></i> 
                                  <input id='type' class='form-control' type='radio' name="listing" value="Sometimes"  <?php if('Sometimes'==$result5->listing) {?> checked='checked' <?php } ?> >Sometimes
                                </label>
                                
                                
<!-- <label class='btn btn-primary "<?php if('2' !='Always' || '2'!='Sometimes' )  {?>active  <?php } else {?> <?php } ?>"'><i class="icon-calendar"></i>  -->
<label <?php { ?>class='btn btn-primary active' <?php } else { ?> class='btn btn-primary active' <?php } ?> ><i class="icon-calendar"></i>                              
                                  <input id='type' class='form-control' type='radio' name="listing" value="2"  <?php if('2'!='Always' && '2' !='Sometimes' ) {?> 'checked'; <?php } ?>>One Time
                                </label>
                                
                                
                              </div>
                          
                              
                            </div>
                            <div class='form-group' id="oneTime" style="">
                              <label class='control-label col-sm-2' for='daterange2'>One Time Availability  </label>
                            
                            
                              <div class='input-group col-sm-4' >
                                
                                <input name="list" type='text' id='daterange2' class='form-control daterange' <?php $val=$result5->listing; if($val=='Sometimes') {?> value="" <?php } else if($val=='Always') { ?> value="" <?php } else { ?> value="<?php echo $result5->listing; ?>" <?php } ?> >
                             
                                <span class='input-group-addon'>
                                  <i class='icon-calendar'></i>
                                </span>
                              </div>
                              
                              
                              
                            </div>
                           <div>
                          
                      </div>
                            
                          </div>
                          
                          
                        <div class='form-actions' style='margin-bottom:0'>
                          <div class='row'>
                            <div class='col-sm-9 col-sm-offset-3'>
                            <a href="<?php echo WEB_URL; ?>apartment/edit_flat/<?php echo $result5->address; ?>"><button class='btn btn-primary' type='button'>
                                <i class='icon-reply'></i>
                                Go Back  
                              </button></a>
                              
                                 <input type="submit" class='btn btn-primary' name="submit" value="Update Listing">
                              
                              
                           
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
    <script src="<?=base_url();?>assets/javascripts/plugins/fuelux/wizard.js" type="text/javascript"></script>
    
    <!-- / END - page related files and scripts [optional] -->

    <script src="<?=base_url();?>assets/javascripts/plugins/validate/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/validate/additional-methods.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/select2/select2.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/common/moment.min.js" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/lightbox/lightbox.min.js" type="text/javascript"></script>
  </body>
  
    <script type="text/javascript" >

$(document).ready(function(){

$("#add_sub").click(function(){

	var coun=$("#add_country").val();
	var add1=$("#add1").val();
	var add2=$("#add2").val();
	var ctd=$("#ctd").val();
	var spc=$("#spc").val();
	var zip=$("#zip").val();

         $.ajax({
           	url:"<?php echo WEB_URL; ?>apartment/save_address",
           	data: { coun :coun, add1:add1, add2:add2, ctd:ctd, spc:spc, zip:zip },
          	type:"post",
           	beforeSend:function(){},
           	success:function(msg){ 
            console.log(msg);
            }
         });

	
	
	
	});
});
	
         
</script>


<script>

function description(){
  $('.description').show(50);
  $('#detail_desc').hide(50);
}

function longTerm(){
  $('#longTerm').show(50);
  $('#long').hide(50);
}   

$("input[name='listing']").change(function (){
  if ($(this).val() == '2'){
    //alert('hi');
    $('#oneTime').show(100);
  }else{
    $('#oneTime').hide(100);
  }
});

$("input[name='home_type']").change(function (){
  if ($(this).val() == '4'){
    //alert('hi');
    $('#other').show(100);
  }else{
    $('#other').hide(100);
  }
});

//$('#myWizard').wizard();
$('.wizard').on('finished', function(e, data) {
  //$('#apartment_form').submit();
  //document.getElementById("apartment_form").submit();
  //document.forms["apartment"].submit();
  alert('submit');
  
});

$('#price_night, #price_month, #price_week').keyup(function() {
    var $th = $(this);
    $th.val( $th.val().replace(/[^0-9]/g, function(str) {  return ''; } ) );
});
$('#currency').keyup(function() {
    var $th = $(this);
    $th.val( $th.val().replace(/[^a-zA-Z]/g, function(str) {  return ''; } ) );
});


$('.wizard').on('change', function(e, data) {

  //Step-1 Validation
  var city = $('#autocomplete').val();
  if(city == '' && data.direction==='next') {
    $('#autocomplete').closest('.form-group').addClass('has-error');
    $('#autocomplete').focus();
    $('span.help-block').show();
     return e.preventDefault();
  }else{
    $('#autocomplete').closest('.form-group').removeClass('has-error');
    $('span.help-block').hide();
  }
  var home_type = $("input[name='home_type']:checked").val();
  if(home_type == '4'){
    var city = $('#other').val();
    if(city == '00' && data.direction==='next') {
      $('#other').closest('.form-group').addClass('has-error');
      $('#other').focus();
      return e.preventDefault();
    }else{
      $('#other').closest('.form-group').removeClass('has-error');
    }
  }
  //Step-2 Validation
  //var a = $("input[name='listing']").val();
  //alert(a);
  if ($("input[name='listing'][value='2']").prop("checked")){
    var a = $("input[name='listing']:checked").val();
    if(a == '2'){
      var date = $('#daterange2').val();
      if(date == ''){
        $("#daterange2").closest('.form-group').addClass('has-error');
        $("#daterange2").focus();
        return e.preventDefault();
      }else{
        $("#daterange2").closest('.form-group').removeClass('has-error');
      }
    }
  }else{
    $("#daterange2").closest('.form-group').removeClass('has-error');
    $("#daterange2").focus();
  }
  
  //Step-3 Validation
  var price_night = $('#price_night').val();
  if(data.step===3 && data.direction==='next' && price_night==='') {
    $("#price_night").closest('.form-group').addClass('has-error');
    return e.preventDefault();
  }else{
    $("#price_night").closest('.form-group').removeClass('has-error');
  }
  var currency = $('#currency').val();
  if(data.step===3 && data.direction==='next' && currency==='') {
    $("#currency").closest('.form-group').addClass('has-error');
    return e.preventDefault();
  }else{
    $("#currency").closest('.form-group').removeClass('has-error');
  }

  //Step-4 Validation
  var title = $('#title').val();
  if(data.step===4 && data.direction==='next' && title==='') {
    $("#title").closest('.form-group').addClass('has-error');
    return e.preventDefault();
  }else{
    $("#title").closest('.form-group').removeClass('has-error');
  }
  // if(data.step===3 && data.direction==='next') {
  //    return e.preventDefault();
  // }
});

// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

var placeSearch, autocomplete;
var componentForm = {
  //street_number: 'short_name',
  //route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  hi: 'long_name'
  //postal_code: 'short_name'
};

function initialize() {
  // Create the autocomplete object, restricting the search
  // to geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
      { types: ['geocode'] });
  // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    fillInAddress();
    //alert('swd');
  });
}

// [START region_fillform]
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
      //alert(val);
    }
  }
}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = new google.maps.LatLng(
          position.coords.latitude, position.coords.longitude);
      autocomplete.setBounds(new google.maps.LatLngBounds(geolocation,
          geolocation));
    });
  }
  }
// [END region_geolocation]

$(".daterange").daterangepicker({
  format: "MM/DD/YYYY"
}, function(start, end) {
  return $(".daterange").parent().find("input").first().val(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
});
</script>

</html>


