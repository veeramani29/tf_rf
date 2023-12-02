<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>...::Reservation Factory</title>
  <!-- Bootstrap -->
  <link href="http://rf.tekhne.nl/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- fontawesome css -->
  <link rel="stylesheet" href="http://rf.tekhne.nl/assets/font-awesome/css/font-awesome.min.css">
  <!-- ui css -->
  <link rel="stylesheet" href="http://rf.tekhne.nl/assets/css/jquery-ui.css">
  <!-- common css files-->
  <link href="http://rf.tekhne.nl/assets/css/star-rating.css" rel="stylesheet">  
  <link rel="stylesheet" href="http://rf.tekhne.nl/assets/css/bootstrapformhelpers.min.css" media="screen">  
  <!-- lightbox hotel css start -->
  <link rel="stylesheet" type="text/css" href="http://rf.tekhne.nl/assets/css/lightbox/lightgallery.css">
  <link rel="stylesheet" type="text/css" href="http://rf.tekhne.nl/assets/css/lightbox/justifiedGallery.min.css" >
  <!-- custom css files -->
  <link rel="stylesheet" href="http://rf.tekhne.nl/assets/css/developer.css" media="screen">
  <link href="http://rf.tekhne.nl/assets/css/custom-styles.css" rel="stylesheet">
  <link href="http://rf.tekhne.nl/assets/css/media.css" rel="stylesheet">
  
  <script src="http://rf.tekhne.nl/assets/js/jquery.v2.0.3.js"></script>
  <script type='text/javascript' src="http://rf.tekhne.nl/assets/js/jquery.lazyload.js"></script>
 
  <!-- Jquiry ui js-->  
  <script src="http://rf.tekhne.nl/assets/js/jquery-ui.js"></script>
  <script src="http://rf.tekhne.nl/assets/js/jquery.ui.touch-punch.min.js"></script>
 <script src="http://rf.tekhne.nl/assets/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript">

  WEB_URL = "http://rf.tekhne.nl";
  ASSETS = "http://rf.tekhne.nl/assets/";
  CURR = "EUR";
  CURR_ICON = "€";

    var current_url = 'aHR0cDovL3JmLnRla2huZS5ubC8='; 
  var login_url = '';
  window.help_upload_dir = 'http://rf.tekhne.nl';
  
  </script>

 <style type="text/css">
.site_txt{
	color: #337ab7;
}
@-ms-viewport{
  width: device-width;
}

div, a, ul, li, nav, input, select, button {
    outline-color: -moz-use-text-color !important;
    outline-style: none !important;
    outline-width: medium !important;
}
ul,li{
   list-style-image: none;
    list-style-position: outside;
    list-style-type: none;
    margin-bottom: 0;
    margin-left: 0;
    margin-right: 0;
    margin-top: 0;
    padding-bottom: 0;
    padding-left: 0;
    padding-right: 0;
    padding-top: 0;
}
 </style>

</head>
<body>
  <div class="lodrefrentrev imgLoader" style="display:none;">
    <div class="centerload">
    </div>
  </div>
  <img src="http://rf.tekhne.nl/assets/images/bg_main.jpg" class="bg">
  <nav class="navbar navbar-default">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand logo" href="http://rf.tekhne.nl">
          <img src="http://rf.tekhne.nl/assets/images/LOGO_RF.svg">
        </a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
         <!--  <li>
            <a href="http://rf.tekhne.nl/Hotel" class="hotel_menuitem ">Hotels</a>
          </li> -->
         <!--  <li>
            <a href="http://rf.tekhne.nl/Car" class="car_menuitem ">Cars</a>
          </li> -->
          <li>
            <a href="http://rf.tekhne.nl" class="active flight_menuitem">Flights</a>
          </li>
          <li>
            <a href="http://rf.tekhne.nl/about-us" class=" about_navigation" style="min-width: 73px;text-align: center;">About</a>
          </li>
                    <li class="login">
            <a href="Javascript:;" class="login_navigation fadeandscale_close fadeandscalereg_open">Login/Register</a>
          </li>
                    <li class="dropdown en_navigation">
                        <a href="http://rf.tekhne.nl/home/language/english/aHR0cDovL3JmLnRla2huZS5ubC8=" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">EN</a>
            <ul class="dropdown-menu">
              <li><div class="arrow-up"></div></li>
              <li>
                <a href="http://rf.tekhne.nl/home/language/dutch/aHR0cDovL3JmLnRla2huZS5ubC8=">NL</a>
              </li>
            </ul>
          </li>
                    </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>


<div id="SearchCarousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner" role="listbox">
    <!-- Search result Start -->
   <div class="container nopadd container_flightsearch item active"><script type="text/javascript">
$('#change_search').click(function(){
  $( "ul.flights" ).empty();
  $('.search_filter')[0].reset();
  $('form.search_filter :input').val('');
  $('form.search_filter select').find('option').remove();

  $('#SearchCarousel').carousel('next');
  $( "div.item" ).addClass('active');
});

$(function() {

 $("img.lazy").lazyload({
  threshold : 200,
  effect : "fadeIn",
  skip_invisible : false
});
 $("img.lazy").each(function() {

  $(this).attr("src", $(this).attr("data-original"));
  $(this).removeAttr("data-original");
});
});
</script>
<style type="text/css">
  ul.fs_filterform li{

        min-width: 85px !important;
    vertical-align: top;
  }
</style>
<div class="row">
  <div class="col-md-12">
    <div class="fullwidthbg_image">
      <img src="http://rf.tekhne.nl/assets/images/FLIGHTS_SEARCH.svg" class="fs_bgimage visible-lg visible-md">         
      <img src="http://rf.tekhne.nl/assets/images/FLIGHTS_SEARCH_sm.svg" class="fs_bgimage visible-sm">         
      <div class="fs_content color_white">
        <div class="float_lwidth">
          <div class="col-xs-4">
            <h5 class="fs_title">Filter your result by</h5>
          </div>
                    <div class="col-xs-8">

            <ul class="list-inline text-right">
              <li>
                <h5>Departing : 30-04-2016</h5>
              </li>
                          </ul>
          </div>
        </div>
                 <div class="col-xs-12">
          <form class="form-inline flight_form search_filter">
            <ul class="list-inline fs_filterform">
                           <li>
                <select id="StopFilter" class="form-control full_width input_caretdown">                
                  <option value=""> STOP</option>
                  <option value="All">All</option><option value="0">Non-Stop</option><option value="1">One-Stop</option><option value="2">Two-Stop</option>
                </select>
              </li>
                                          <li>
               <div class="form-group col-xs-12 nopadd">
                <button type="button" class="btn dropdown-toggle btn-inbox" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Times               </button>
               <ul class="dropdown-menu well_bgwhite" id="time">
                <div class="well">
                  <div class="departure_time">
                    <p>Departure Time</p>
                    <div id="departure-filter" class="float_lwidth ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 0%;"></span><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 100%;"></span></div>
                    <span class="time_left" id="min_departure">0:00 Hrs</span>
                    <span class="time_right" id="max_departure">23:59 Hrs</span>
                  </div>
                  <div class="arrival_time">
                    <p>Arrival Time</p>
                    <div id="arrival-filter" class="float_lwidth ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 0%;"></span><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 100%;"></span></div>
                    <span class="time_left" id="min_arrival">0:00 Hrs</span>
                    <span class="time_right" id="max_arrival">23:59 Hrs</span>
                  </div>
                </div>
              </ul>
            </div>
          </li>
                              <li>
           <div class="form-group col-xs-12 nopadd">
            <button type="button" class="btn dropdown-toggle btn-inbox" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Duration            </button>
            <ul class="dropdown-menu well_bgwhite" id="duration">
              <div class="well">
                <div class="departure_time">
                  <p>Duration</p>
                  <div id="duration-filter" class="float_lwidth ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 0%;"></span><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 100%;"></span></div>
                  <span class="time_left" id="min_duration">0H</span>
                  <span class="time_right" id="max_duration">23H</span>
                </div>

              </div>
            </ul>
          </div>
        </li>
                <li>
          <div class="form-group col-xs-12 nopadd">
           <button type="button" class="btn dropdown-toggle btn-inbox" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Price          </button>
          <ul class="dropdown-menu well_bgwhite" id="price">
            <div class="well">
              <div class="departure_time">
                <p>Price</p>
                <div id="price-filter" class="float_lwidth ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 0%;"></span><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 100%;"></span></div>
                <span class="time_left" id="min_price">€100.03</span>
                <span class="time_right" id="max_price">€1719.03</span>
              </div>
            </div>
          </ul>
        </div>
      </li>
            <li>

      <div class="button-group col-sm-12 nopadd ff_facilitydp">
                  <button type="button" class="btn dropdown-toggle btn-inbox" data-toggle="dropdown">Airlines</button>
                  <ul class="dropdown-menu ffdp_dp Airlines" id="Airlines">
                    <li class="col-sm-6 nopadd">
                      <label for="All">
                        <input name="AirlineFilter[]" id="All" type="checkbox" value="All">All                      </label>
                    </li> <li class="col-sm-6 nopadd"><label for="KL"><input name="AirlineFilter[]" type="checkbox" id="KL" value="KL">KLM Airlines </label></li> <li class="col-sm-6 nopadd"><label for="KK"><input name="AirlineFilter[]" type="checkbox" id="KK" value="KK">Atlasjet Airlines </label></li> <li class="col-sm-6 nopadd"><label for="TK"><input name="AirlineFilter[]" type="checkbox" id="TK" value="TK">Turkish Airlines </label></li> <li class="col-sm-6 nopadd"><label for="BA"><input name="AirlineFilter[]" type="checkbox" id="BA" value="BA">British Airways </label></li> <li class="col-sm-6 nopadd"><label for="SU"><input name="AirlineFilter[]" type="checkbox" id="SU" value="SU">Aeroflot Airlines </label></li> <li class="col-sm-6 nopadd"><label for="AF"><input name="AirlineFilter[]" type="checkbox" id="AF" value="AF">Air France </label></li> <li class="col-sm-6 nopadd"><label for="RO"><input name="AirlineFilter[]" type="checkbox" id="RO" value="RO">TAROM </label></li> <li class="col-sm-6 nopadd"><label for="PS"><input name="AirlineFilter[]" type="checkbox" id="PS" value="PS">Air Ukraine International </label></li> <li class="col-sm-6 nopadd"><label for="JU"><input name="AirlineFilter[]" type="checkbox" id="JU" value="JU">JAT Jugoslovenski Aerotransport </label></li> <li class="col-sm-6 nopadd"><label for="LX"><input name="AirlineFilter[]" type="checkbox" id="LX" value="LX">SWISS </label></li> <li class="col-sm-6 nopadd"><label for="LH"><input name="AirlineFilter[]" type="checkbox" id="LH" value="LH">Lufthansa Airlines </label></li> <li class="col-sm-6 nopadd"><label for="KM"><input name="AirlineFilter[]" type="checkbox" id="KM" value="KM">Air Malta </label></li> <li class="col-sm-6 nopadd"><label for="TP"><input name="AirlineFilter[]" type="checkbox" id="TP" value="TP">TAP - Air Portugal </label></li> <li class="col-sm-6 nopadd"><label for="RJ"><input name="AirlineFilter[]" type="checkbox" id="RJ" value="RJ">Royal Jordanian </label></li> <li class="col-sm-6 nopadd"><label for="LO"><input name="AirlineFilter[]" type="checkbox" id="LO" value="LO">LOT Polish Airlines </label></li> <li class="col-sm-6 nopadd"><label for="AZ"><input name="AirlineFilter[]" type="checkbox" id="AZ" value="AZ">Alitalia </label></li> <li class="col-sm-6 nopadd"><label for="OU"><input name="AirlineFilter[]" type="checkbox" id="OU" value="OU">Croatia Airlines </label></li> <li class="col-sm-6 nopadd"><label for="SK"><input name="AirlineFilter[]" type="checkbox" id="SK" value="SK">Scandinavian Airlines </label></li>
                  </ul>
                </div>


       
     </li>
                                 <li class="sort_price">
                 <label>Sort on</label>
                <select id="sortprice" onchange="SortbyPrice(this.value);" class="form-control input_caretdown">                
                  <option value="">Price</option>

                  <option value="LH">Low To High</option>
                  <option value="HL">High To Low</option>

                </select>
              </li>
                   <li class="fs-button">
      <button type="button" class="btn btn-secondry btn_inputs" id="change_search">Change Search</button>
    </li>
  </ul>
</form>
</div>
<div class="col-xs-12"><!-- adding col-xs-12 here is effecting in the result page of flight -->
  <ul class="fs_flightlist">
    <li>
      <ul class="list-inline flights">
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid01230" data-airline="KLM Airlines" data-arrive="1305" data-duration="195" data-stops="0" data-depature="1110" data-airlinecode="KL" data-price="100.03" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF100030" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/KL.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>20:30 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>00:45 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">3h 15m</span><br>
            <span class="fsa_departure">NON STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse0" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="Im5YbU1hUGExVDBtTTc3TVV5U1ZHR1E9PXxLS3wxR3xLS3xnd3MtZUp4TlRrRUt3ekFNZTB6UlhVN2Fic2QwUzJDam1TXC9KS0wzc1wvOCtZa3pDWXdCSkdRbllJd1ZGV3pzTHdod21mYWNcL1E5eDFRT0p0bnFiaDZKeEJiVHBDeVFJXC85MEl4UjRHbUdkbk9vOUZoY29nZVJYUExEYWNEWmVYdVZYMmM3Q011aFVYcVk2QmFyNWxMSjJYbHl2Wmx4Z1QzMUJSbFZKNnc9fEtLfHxWVnx8QHwxIg==" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">100.03</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook0" id="F100030" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiVlhQYU9DYXRRWHU1emRRRG9JaDhiQT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IiIsIlRvdGFsUHJpY2UiOiIxMDAuMDMiLCJCYXNlUHJpY2UiOiI3Ni4wMCIsIlRheGVzIjoiMjQuMDMiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjEwMC4wMyIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6Ijc2LjAwIiwiVGF4UHJpY2VfQnJlYWtkb3duIjoiMjQuMDMiLCJSZWZ1bmRhYmxlIjpmYWxzZSwiUGxhdGluZ0NhcnJpZXIiOiJLTCIsIkZhcmVUeXBlIjoiTm9uIFJlZnVuZGFibGUiLCJBbGxfUGFzc2VuZ2VyIjoiQURUIiwiQWR1bHRzIjoxLCJBZHVsdHNfQmFzZV9QcmljZSI6Ijc2LjAwIiwiQWR1bHRzX1RheF9QcmljZSI6IjI0LjAzIiwiVHJhdmVsVGltZSI6IlAwRFQzSDE1TTBTIiwiQWlyU2VnbWVudF9LZXkiOiI3NkxmT09pQlJyS0xxaE9rNDBhakVRPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiI3NkxmT09pQlJyS0xxaE9rNDBhakVRPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiS0wiLCJGbGlnaHROdW1iZXIiOiIxNjE3IiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQyMDozMDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDUtMDFUMDA6NDU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjE5NSIsIkRpc3RhbmNlIjoiMTM4NCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiNzM3IiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjh8Qzh8RDh8STh8Wjh8WTl8Qjl8TTl8VTl8Szl8Vzl8SDl8Uzl8TDl8QTl8UTl8VDl8RTl8Tjl8UjB8VjB8WDB8RzAiLCJGbGlnaHREZXRhaWxfS2V5IjoiOWVKeUZvZm5SS3VMTUZQZE5WalhtZz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiTiIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJuWG1NYVBhMVQwbU03N01VeVNWR0dRPT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiblhtTWFQYTFUMG1NNzdNVXlTVkdHUT09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVGtFS3d6QU1lMHpSWFU3YWJzZDBTMkNqbVNcL0pLTDNzXC84K1lrekNZd0JKR1FuWUl3VkZXenNMd2h3bWZhY1wvUTl4MVFPSnRucWJoNkp4QmJUcEN5UUlcLzkwSXhSNEdtR2RuT285Rmhjb2dlUlhQTERhY0RaZVh1VlgyYzdDTXVoVVhxWTZCYXI1bExKMlhseXZabHhnVDMxQlJsVko2dz0iLCJGYXJlQmFzaXMiOiJOV0tXTkwifV0sIkZhcmVydWxlc3JlZl9LZXkiOltbIm5YbU1hUGExVDBtTTc3TVV5U1ZHR1E9PSJdXSwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjpbWyIxRyJdXSwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOltbImd3cy1lSnhOVGtFS3d6QU1lMHpSWFU3YWJzZDBTMkNqbVNcL0pLTDNzXC84K1lrekNZd0JKR1FuWUl3VkZXenNMd2h3bWZhY1wvUTl4MVFPSnRucWJoNkp4QmJUcEN5UUlcLzkwSXhSNEdtR2RuT285Rmhjb2dlUlhQTERhY0RaZVh1VlgyYzdDTXVoVVhxWTZCYXI1bExKMlhseXZabHhnVDMxQlJsVko2dz0iXV19" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F100030" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse0" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        8:30 PM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        12:45 AM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        KLM Airlines<br>
                        <span>KL-737</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>3h 15m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 3h 15m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">100.03</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook0" id="F100030" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiVlhQYU9DYXRRWHU1emRRRG9JaDhiQT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IiIsIlRvdGFsUHJpY2UiOiIxMDAuMDMiLCJCYXNlUHJpY2UiOiI3Ni4wMCIsIlRheGVzIjoiMjQuMDMiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjEwMC4wMyIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6Ijc2LjAwIiwiVGF4UHJpY2VfQnJlYWtkb3duIjoiMjQuMDMiLCJSZWZ1bmRhYmxlIjpmYWxzZSwiUGxhdGluZ0NhcnJpZXIiOiJLTCIsIkZhcmVUeXBlIjoiTm9uIFJlZnVuZGFibGUiLCJBbGxfUGFzc2VuZ2VyIjoiQURUIiwiQWR1bHRzIjoxLCJBZHVsdHNfQmFzZV9QcmljZSI6Ijc2LjAwIiwiQWR1bHRzX1RheF9QcmljZSI6IjI0LjAzIiwiVHJhdmVsVGltZSI6IlAwRFQzSDE1TTBTIiwiQWlyU2VnbWVudF9LZXkiOiI3NkxmT09pQlJyS0xxaE9rNDBhakVRPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiI3NkxmT09pQlJyS0xxaE9rNDBhakVRPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiS0wiLCJGbGlnaHROdW1iZXIiOiIxNjE3IiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQyMDozMDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDUtMDFUMDA6NDU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjE5NSIsIkRpc3RhbmNlIjoiMTM4NCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiNzM3IiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjh8Qzh8RDh8STh8Wjh8WTl8Qjl8TTl8VTl8Szl8Vzl8SDl8Uzl8TDl8QTl8UTl8VDl8RTl8Tjl8UjB8VjB8WDB8RzAiLCJGbGlnaHREZXRhaWxfS2V5IjoiOWVKeUZvZm5SS3VMTUZQZE5WalhtZz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiTiIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJuWG1NYVBhMVQwbU03N01VeVNWR0dRPT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiblhtTWFQYTFUMG1NNzdNVXlTVkdHUT09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVGtFS3d6QU1lMHpSWFU3YWJzZDBTMkNqbVNcL0pLTDNzXC84K1lrekNZd0JKR1FuWUl3VkZXenNMd2h3bWZhY1wvUTl4MVFPSnRucWJoNkp4QmJUcEN5UUlcLzkwSXhSNEdtR2RuT285Rmhjb2dlUlhQTERhY0RaZVh1VlgyYzdDTXVoVVhxWTZCYXI1bExKMlhseXZabHhnVDMxQlJsVko2dz0iLCJGYXJlQmFzaXMiOiJOV0tXTkwifV0sIkZhcmVydWxlc3JlZl9LZXkiOltbIm5YbU1hUGExVDBtTTc3TVV5U1ZHR1E9PSJdXSwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjpbWyIxRyJdXSwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOltbImd3cy1lSnhOVGtFS3d6QU1lMHpSWFU3YWJzZDBTMkNqbVNcL0pLTDNzXC84K1lrekNZd0JKR1FuWUl3VkZXenNMd2h3bWZhY1wvUTl4MVFPSnRucWJoNkp4QmJUcEN5UUlcLzkwSXhSNEdtR2RuT285Rmhjb2dlUlhQTERhY0RaZVh1VlgyYzdDTXVoVVhxWTZCYXI1bExKMlhseXZabHhnVDMxQlJsVko2dz0iXV19" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F100030" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid01231" data-airline="Atlasjet Airlines" data-arrive="965" data-duration="210" data-stops="0" data-depature="755" data-airlinecode="KK" data-price="167.03" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF167031" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/KK.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>14:35 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>19:05 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">3h 30m</span><br>
            <span class="fsa_departure">NON STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse1" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="InBCXC94a3lmXC9RbHVyajRVSFVvZ3pEZz09fEtLfDFHfEtLfGd3cy1lSnhOVGtFS3d6QU1lMHpSWGM2YXJNZVVaYVVsblhkb3h1aGxcLzNcL0duQVRHREphd0pXVEhHQjBsY0JUR3Z4cndHWEtHdm02QXdsbHZSNEg0NENlSVRTZEk4U2o3ODYwN2VzS0ZKbWdUTzB1ekpaY2NpRVdXMEpWYU9Cdk9qK01YV2tcL0NqS2h3WDQxMFRpVm5pK1pJY3JMMUZmYlVGeFc5SjJZPXxLS3x8VlZ8fEB8MSI=" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">167.03</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook1" id="F167031" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5Ijoid3lla3NKTWpTdUtrVVhVV2hEalVVZz09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IiIsIlRvdGFsUHJpY2UiOiIxNjcuMDMiLCJCYXNlUHJpY2UiOiIxNDMuMDAiLCJUYXhlcyI6IjI0LjAzIiwiVG90YWxQcmljZV9BUEkiOiJFVVIxNjcuMDMiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIxNDMuMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiIyNC4wMyIsIlJlZnVuZGFibGUiOiJ0cnVlIiwiUGxhdGluZ0NhcnJpZXIiOiJIUiIsIkZhcmVUeXBlIjoiUmVmdW5kYWJsZSIsIkFsbF9QYXNzZW5nZXIiOiJBRFQiLCJBZHVsdHMiOjEsIkFkdWx0c19CYXNlX1ByaWNlIjoiMTQzLjAwIiwiQWR1bHRzX1RheF9QcmljZSI6IjI0LjAzIiwiVHJhdmVsVGltZSI6IlAwRFQzSDMwTTBTIiwiQWlyU2VnbWVudF9LZXkiOiJhQ1hEcFphRlFnTys0NjZmS3p3Nm93PT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiJhQ1hEcFphRlFnTys0NjZmS3p3Nm93PT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiS0siLCJGbGlnaHROdW1iZXIiOiI2MDQwIiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxNDozNTowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTk6MDU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjIxMCIsIkRpc3RhbmNlIjoiMTM4NCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIwIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJDYWNoZSBzdGF0dXMgdXNlZC4gTm8gcG9sbGVkIGF2YWlsIGV4aXN0cy4iLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJIIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6Iko4fEM2fEQ0fFcyfFk5fEI5fEg5fEs5fEw5fE05fFQ1fFYwfFgwfFUwfEUwfE4wIiwiRmxpZ2h0RGV0YWlsX0tleSI6IkR6V2x1V1JNUUJDUmdrMWlTUHhUalE9PSIsIk9yaWdpblRlcm1pbmFsIjoiMyIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiIiLCJCb29raW5nQ29kZSI6IlQiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoicEJcL3hreWZcL1FsdXJqNFVIVW9nekRnPT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoicEJcL3hreWZcL1FsdXJqNFVIVW9nekRnPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Ua0VLd3pBTWUwelJYYzZhck1lVVphVWxuWGRveHVobFwvM1wvR25BVEdESmF3SldUSEdCMGxjQlRHdnhyd0dYS0d2bTZBd2xsdlI0SDQ0Q2VJVFNkSThTajc4NjA3ZXNLRkptZ1RPMHV6SlpjY2lFV1cwSlZhT0J2T2orTVhXa1wvQ2pLaHdYNDEwVGlWbmkrWkljckwxRmZiVUZ4VzlKMlk9IiwiRmFyZUJhc2lzIjoiVExPV05MIn1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJwQlwveGt5ZlwvUWx1cmo0VUhVb2d6RGc9PSJdXSwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjpbWyIxRyJdXSwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOltbImd3cy1lSnhOVGtFS3d6QU1lMHpSWGM2YXJNZVVaYVVsblhkb3h1aGxcLzNcL0duQVRHREphd0pXVEhHQjBsY0JUR3Z4cndHWEtHdm02QXdsbHZSNEg0NENlSVRTZEk4U2o3ODYwN2VzS0ZKbWdUTzB1ekpaY2NpRVdXMEpWYU9Cdk9qK01YV2tcL0NqS2h3WDQxMFRpVm5pK1pJY3JMMUZmYlVGeFc5SjJZPSJdXX0=" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F167031" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        2:35 PM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        7:05 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        Atlasjet Airlines<br>
                        <span>KK-320</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>3h 30m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 3h 30m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">167.03</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook1" id="F167031" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5Ijoid3lla3NKTWpTdUtrVVhVV2hEalVVZz09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IiIsIlRvdGFsUHJpY2UiOiIxNjcuMDMiLCJCYXNlUHJpY2UiOiIxNDMuMDAiLCJUYXhlcyI6IjI0LjAzIiwiVG90YWxQcmljZV9BUEkiOiJFVVIxNjcuMDMiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIxNDMuMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiIyNC4wMyIsIlJlZnVuZGFibGUiOiJ0cnVlIiwiUGxhdGluZ0NhcnJpZXIiOiJIUiIsIkZhcmVUeXBlIjoiUmVmdW5kYWJsZSIsIkFsbF9QYXNzZW5nZXIiOiJBRFQiLCJBZHVsdHMiOjEsIkFkdWx0c19CYXNlX1ByaWNlIjoiMTQzLjAwIiwiQWR1bHRzX1RheF9QcmljZSI6IjI0LjAzIiwiVHJhdmVsVGltZSI6IlAwRFQzSDMwTTBTIiwiQWlyU2VnbWVudF9LZXkiOiJhQ1hEcFphRlFnTys0NjZmS3p3Nm93PT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiJhQ1hEcFphRlFnTys0NjZmS3p3Nm93PT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiS0siLCJGbGlnaHROdW1iZXIiOiI2MDQwIiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxNDozNTowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTk6MDU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjIxMCIsIkRpc3RhbmNlIjoiMTM4NCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIwIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJDYWNoZSBzdGF0dXMgdXNlZC4gTm8gcG9sbGVkIGF2YWlsIGV4aXN0cy4iLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJIIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6Iko4fEM2fEQ0fFcyfFk5fEI5fEg5fEs5fEw5fE05fFQ1fFYwfFgwfFUwfEUwfE4wIiwiRmxpZ2h0RGV0YWlsX0tleSI6IkR6V2x1V1JNUUJDUmdrMWlTUHhUalE9PSIsIk9yaWdpblRlcm1pbmFsIjoiMyIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiIiLCJCb29raW5nQ29kZSI6IlQiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoicEJcL3hreWZcL1FsdXJqNFVIVW9nekRnPT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoicEJcL3hreWZcL1FsdXJqNFVIVW9nekRnPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Ua0VLd3pBTWUwelJYYzZhck1lVVphVWxuWGRveHVobFwvM1wvR25BVEdESmF3SldUSEdCMGxjQlRHdnhyd0dYS0d2bTZBd2xsdlI0SDQ0Q2VJVFNkSThTajc4NjA3ZXNLRkptZ1RPMHV6SlpjY2lFV1cwSlZhT0J2T2orTVhXa1wvQ2pLaHdYNDEwVGlWbmkrWkljckwxRmZiVUZ4VzlKMlk9IiwiRmFyZUJhc2lzIjoiVExPV05MIn1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJwQlwveGt5ZlwvUWx1cmo0VUhVb2d6RGc9PSJdXSwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjpbWyIxRyJdXSwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOltbImd3cy1lSnhOVGtFS3d6QU1lMHpSWGM2YXJNZVVaYVVsblhkb3h1aGxcLzNcL0duQVRHREphd0pXVEhHQjBsY0JUR3Z4cndHWEtHdm02QXdsbHZSNEg0NENlSVRTZEk4U2o3ODYwN2VzS0ZKbWdUTzB1ekpaY2NpRVdXMEpWYU9Cdk9qK01YV2tcL0NqS2h3WDQxMFRpVm5pK1pJY3JMMUZmYlVGeFc5SjJZPSJdXX0=" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F167031" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid01232" data-airline="Turkish Airlines" data-arrive="760" data-duration="210" data-stops="0" data-depature="550" data-airlinecode="TK" data-price="195.03" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF195032" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/TK.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>11:10 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>15:40 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">3h 30m</span><br>
            <span class="fsa_departure">NON STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse2" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="ImU1OFl3U1RKUW9XOWNBcnczcWloRWc9PXxLS3wxR3xLS3xnd3MtZUp4TlR0RUt3akFRKzVpUjk5eTEydGRPVjZtSWRiQUs2NHZcL1wveGxlT3hBRGwzQWs1QzdHcUpRenZURCtZY0pucWcrVTl4VW9VSnY3VmlGZW5ZZlkxa0RLQ1RVMzNkZkxDMGVIbzFsbDJJZktDQzRoQlJESjNlUndPdEFHejhcL3RWOXVQd29Mb2xMSkptWmU2N2xWSXI2U0diRWFBUGZZRndjRW9sQT09fEtLfHxWVnx8QHwxIg==" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">195.03</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook2" id="F195032" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiMklFczlBblFRWUc3NGpQcEJpbFNSUT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IiIsIlRvdGFsUHJpY2UiOiIxOTUuMDMiLCJCYXNlUHJpY2UiOiIxMzAuMDAiLCJUYXhlcyI6IjY1LjAzIiwiVG90YWxQcmljZV9BUEkiOiJFVVIxOTUuMDMiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIxMzAuMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiI2NS4wMyIsIlJlZnVuZGFibGUiOmZhbHNlLCJQbGF0aW5nQ2FycmllciI6IlRLIiwiRmFyZVR5cGUiOiJOb24gUmVmdW5kYWJsZSIsIkFsbF9QYXNzZW5nZXIiOiJBRFQiLCJBZHVsdHMiOjEsIkFkdWx0c19CYXNlX1ByaWNlIjoiMTMwLjAwIiwiQWR1bHRzX1RheF9QcmljZSI6IjY1LjAzIiwiVHJhdmVsVGltZSI6IlAwRFQzSDMwTTBTIiwiQWlyU2VnbWVudF9LZXkiOiJnN0VxSnRvTVRyNnFYMVpzd0hpSVZBPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiJnN0VxSnRvTVRyNnFYMVpzd0hpSVZBPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiVEsiLCJGbGlnaHROdW1iZXIiOiIxOTUyIiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxMToxMDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTU6NDA6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjIxMCIsIkRpc3RhbmNlIjoiMTM4NCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzQzIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJDYWNoZWQgc3RhdHVzIHVzZWQuIFBvbGxlZCBhdmFpbCBleGlzdHMiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiQzR8RDR8SzR8SjR8STR8UjB8WTl8Qjl8TTl8SDl8Uzl8RTl8UTl8VDl8TDB8VjB8UDB8VzB8WDB8TjB8RzAiLCJGbGlnaHREZXRhaWxfS2V5IjoieG9SWlI5Q01SZUt1b2FXTDRDTXNTQT09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiVCIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJlNThZd1NUSlFvVzljQXJ3M3FpaEVnPT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiZTU4WXdTVEpRb1c5Y0FydzNxaWhFZz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHRFS3dqQVErNWlSOTl5MTJ0ZE9WNm1JZGJBSzY0dlwvXC94bGVPeEFEbDNBazVDN0dxSlF6dlREK1ljSm5xZytVOXhVb1VKdjdWaUZlbllmWTFrREtDVFUzM2RmTEMwZUhvMWxsMklmS0NDNGhCUkRKM2VSd090QUd6OFwvdFY5dVB3b0xvbExKSm1aZTY3bFZJcjZTR2JFYUFQZllGd2NFb2xBPT0iLCJGYXJlQmFzaXMiOiJUSFkyWFBCTyJ9XSwiRmFyZXJ1bGVzcmVmX0tleSI6W1siZTU4WXdTVEpRb1c5Y0FydzNxaWhFZz09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5UdEVLd2pBUSs1aVI5OXkxMnRkT1Y2bUlkYkFLNjR2XC9cL3hsZU94QURsM0FrNUM3R3FKUXp2VEQrWWNKbnFnK1U5eFVvVUp2N1ZpRmVuWWZZMWtES0NUVTMzZGZMQzBlSG8xbGwySWZLQ0M0aEJSREozZVJ3T3RBR3o4XC90Vjl1UHdvTG9sTEpKbVplNjdsVklyNlNHYkVhQVBmWUZ3Y0VvbEE9PSJdXX0=" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F195032" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        11:10 AM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        3:40 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        Turkish Airlines<br>
                        <span>TK-343</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>3h 30m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 3h 30m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">195.03</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook2" id="F195032" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiMklFczlBblFRWUc3NGpQcEJpbFNSUT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IiIsIlRvdGFsUHJpY2UiOiIxOTUuMDMiLCJCYXNlUHJpY2UiOiIxMzAuMDAiLCJUYXhlcyI6IjY1LjAzIiwiVG90YWxQcmljZV9BUEkiOiJFVVIxOTUuMDMiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIxMzAuMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiI2NS4wMyIsIlJlZnVuZGFibGUiOmZhbHNlLCJQbGF0aW5nQ2FycmllciI6IlRLIiwiRmFyZVR5cGUiOiJOb24gUmVmdW5kYWJsZSIsIkFsbF9QYXNzZW5nZXIiOiJBRFQiLCJBZHVsdHMiOjEsIkFkdWx0c19CYXNlX1ByaWNlIjoiMTMwLjAwIiwiQWR1bHRzX1RheF9QcmljZSI6IjY1LjAzIiwiVHJhdmVsVGltZSI6IlAwRFQzSDMwTTBTIiwiQWlyU2VnbWVudF9LZXkiOiJnN0VxSnRvTVRyNnFYMVpzd0hpSVZBPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiJnN0VxSnRvTVRyNnFYMVpzd0hpSVZBPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiVEsiLCJGbGlnaHROdW1iZXIiOiIxOTUyIiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxMToxMDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTU6NDA6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjIxMCIsIkRpc3RhbmNlIjoiMTM4NCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzQzIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJDYWNoZWQgc3RhdHVzIHVzZWQuIFBvbGxlZCBhdmFpbCBleGlzdHMiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiQzR8RDR8SzR8SjR8STR8UjB8WTl8Qjl8TTl8SDl8Uzl8RTl8UTl8VDl8TDB8VjB8UDB8VzB8WDB8TjB8RzAiLCJGbGlnaHREZXRhaWxfS2V5IjoieG9SWlI5Q01SZUt1b2FXTDRDTXNTQT09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiVCIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJlNThZd1NUSlFvVzljQXJ3M3FpaEVnPT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiZTU4WXdTVEpRb1c5Y0FydzNxaWhFZz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHRFS3dqQVErNWlSOTl5MTJ0ZE9WNm1JZGJBSzY0dlwvXC94bGVPeEFEbDNBazVDN0dxSlF6dlREK1ljSm5xZytVOXhVb1VKdjdWaUZlbllmWTFrREtDVFUzM2RmTEMwZUhvMWxsMklmS0NDNGhCUkRKM2VSd090QUd6OFwvdFY5dVB3b0xvbExKSm1aZTY3bFZJcjZTR2JFYUFQZllGd2NFb2xBPT0iLCJGYXJlQmFzaXMiOiJUSFkyWFBCTyJ9XSwiRmFyZXJ1bGVzcmVmX0tleSI6W1siZTU4WXdTVEpRb1c5Y0FydzNxaWhFZz09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5UdEVLd2pBUSs1aVI5OXkxMnRkT1Y2bUlkYkFLNjR2XC9cL3hsZU94QURsM0FrNUM3R3FKUXp2VEQrWWNKbnFnK1U5eFVvVUp2N1ZpRmVuWWZZMWtES0NUVTMzZGZMQzBlSG8xbGwySWZLQ0M0aEJSREozZVJ3T3RBR3o4XC90Vjl1UHdvTG9sTEpKbVplNjdsVklyNlNHYkVhQVBmWUZ3Y0VvbEE9PSJdXX0=" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F195032" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid01233" data-airline="British Airways" data-arrive="595" data-duration="830" data-stops="1" data-depature="1205" data-airlinecode="BA" data-price="212.84" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF212843" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/BA.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>22:05 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>12:55 (01 May, Sun 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">13h 50m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse3" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="IkQwVGlxMXVnVDVHblwvcEU0WFRybDBRPT18S0t8MUd8S0t8Z3dzLWVKeE5Ua0VPZ3pBTWV3enkzU250dW1QTG9Pb0JlbUFiRWhmK1wvNHlsclpCbUtZNFNXMDVDQ0lieW9CV0dQd3k0aGltaWZGOUFnZEZhODQ2bnM0VG9jSUlVaDJQallUSjZ3RWdWU2hON2wyWkxQZ21JeEdTN1VvR3pjZHplZDJZOUNQV2gwcEsxbFRoXC92TkJTZnpPajA3V0h2dlFEbVFZbVlBPT18S0t8fFZWfEQwVGlxMXVnVDVHblwvcEU0WFRybDBRPT18S0t8MUd8S0t8Z3dzLWVKeE5Ua0VPZ3pBTWV3enkzU250dW1QTG9Pb0JlbUFiRWhmK1wvNHlsclpCbUtZNFNXMDVDQ0lieW9CV0dQd3k0aGltaWZGOUFnZEZhODQ2bnM0VG9jSUlVaDJQallUSjZ3RWdWU2hON2wyWkxQZ21JeEdTN1VvR3pjZHplZDJZOUNQV2gwcEsxbFRoXC92TkJTZnpPajA3V0h2dlFEbVFZbVlBPT18S0t8ODdaMGp3YzJUZjZDcm1heCtwQXBodz09fEtLfDFHfEtLfGd3cy1lSnhOVGtFS3cwQUlmRXlZdTJPYlNHK2JObDBTQ0J0STAwSXVcL2Y4ejZycVhEdWlnampvcEpSVU9jcVdrUDNUNGR2Y1I1ZjBBQ3RSamVSMHd1dzFSbkJCaGoyMzk2STdZNzRYZUx6RnJ6RkJseTRRZ1MyYWJWT0NNdk01N08wblVmM0FkYW5yT1RtV2NEcU5RM0pycXhkc0dkXC9RRGc4VW1VQT09fEtLfHxWVnx8QHwyIg==" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">212.84</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook3" id="F212843" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiTkZEemsyZ3FSNk96RGd4blZRcEJtQT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjIxMi44NCIsIkJhc2VQcmljZSI6IjE1MC4wMCIsIlRheGVzIjoiNjIuODQiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjIxMi44NCIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjE1MC4wMCIsIlRheFByaWNlX0JyZWFrZG93biI6IjYyLjg0IiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiQkEiLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIxNTAuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiNjIuODQiLCJUcmF2ZWxUaW1lIjoiUDBEVDEzSDUwTTBTIiwiQWlyU2VnbWVudF9LZXkiOiJ2KzM1Qzc0K1JENnpQZU5CRFwvK2ZuQT09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoiNVJYZHF6Tm5SQXFLdEVGM1pSZG1jUT09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IkJBIiwiRmxpZ2h0TnVtYmVyIjoiNDMzIiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJMSFIiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQyMjowNTowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMjI6MjA6MDAuMDAwKzAxOjAwIiwiRmxpZ2h0VGltZSI6Ijc1IiwiRGlzdGFuY2UiOiIyMTEiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjMxOSIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6Iko5fEM5fEQ3fFI5fEkwfFk5fEI5fEg5fEs5fE05fEw5fFY5fE4wfFEwfE8wfFMwfEcwIiwiRmxpZ2h0RGV0YWlsX0tleSI6IlFvRGEwRHg5UkVDZk5LT0w2RWpsaWc9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IjUiLCJCb29raW5nQ29kZSI6IlYiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiRDBUaXExdWdUNUduXC9wRTRYVHJsMFE9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJEMFRpcTF1Z1Q1R25cL3BFNFhUcmwwUT09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVGtFT2d6QU1ld3p5M1NudHVtUExvT29CZW1BYkVoZitcLzR5bHJaQm1LWTRTVzA1Q0NJYnlvQldHUHd5NGhpbWlmRjlBZ2RGYTg0Nm5zNFRvY0lJVWgyUGpZVEo2d0VnVlNoTjdsMlpMUGdtSXhHUzdVb0d6Y2R6ZWQyWTlDUFdoMHBLMWxUaFwvdk5CU2Z6T2owN1dIdnZRRG1RWW1ZQT09IiwiRmFyZUJhc2lzIjoiVk0wVjJIIn0seyJBaXJTZWdtZW50X0tleSI6InYrMzVDNzQrUkQ2elBlTkJEXC8rZm5BPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiQkEiLCJGbGlnaHROdW1iZXIiOiI2NzgiLCJPcmlnaW4iOiJMSFIiLCJEZXN0aW5hdGlvbiI6IklTVCIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA1LTAxVDA3OjA1OjAwLjAwMCswMTowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNS0wMVQxMjo1NTowMC4wMDArMDM6MDAiLCJGbGlnaHRUaW1lIjoiMjMwIiwiRGlzdGFuY2UiOiIxNTU3IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMjAiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUyIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJKOXxDN3xENHxSOXxJOHxZOXxCOXxIOXxLOXxNOXxMOXxWOXxOOXxROXxPOXxTOXxHOSIsIkZsaWdodERldGFpbF9LZXkiOiJcL0dCNFZncXNSVG1Ocno1TzVKZk9pUT09IiwiT3JpZ2luVGVybWluYWwiOiI1IiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkkiLCJCb29raW5nQ29kZSI6Ik8iLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiODdaMGp3YzJUZjZDcm1heCtwQXBodz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6Ijg3WjBqd2MyVGY2Q3JtYXgrcEFwaHc9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRrRUt3MEFJZkV5WXUyT2JTRytiTmwwU0NCdEkwMEl1XC9mOHo2cnFYRHVpZ2pqb3BKUlVPY3FXa1AzVDRkdmNSNWYwQUN0UmplUjB3dXcxUm5CQmhqMjM5Nkk3WTc0WGVMekZyekZCbHk0UWdTMmFiVk9DTXZNNTdPMG5VZjNBZGFuck9UbVdjRHFOUTNKcnF4ZHNHZFwvUURnOFVtVUE9PSIsIkZhcmVCYXNpcyI6Ik9MVjJSIn1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJEMFRpcTF1Z1Q1R25cL3BFNFhUcmwwUT09Il0sWyI4N1owandjMlRmNkNybWF4K3BBcGh3PT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXSxbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5Ua0VPZ3pBTWV3enkzU250dW1QTG9Pb0JlbUFiRWhmK1wvNHlsclpCbUtZNFNXMDVDQ0lieW9CV0dQd3k0aGltaWZGOUFnZEZhODQ2bnM0VG9jSUlVaDJQallUSjZ3RWdWU2hON2wyWkxQZ21JeEdTN1VvR3pjZHplZDJZOUNQV2gwcEsxbFRoXC92TkJTZnpPajA3V0h2dlFEbVFZbVlBPT0iXSxbImd3cy1lSnhOVGtFS3cwQUlmRXlZdTJPYlNHK2JObDBTQ0J0STAwSXVcL2Y4ejZycVhEdWlnampvcEpSVU9jcVdrUDNUNGR2Y1I1ZjBBQ3RSamVSMHd1dzFSbkJCaGoyMzk2STdZNzRYZUx6RnJ6RkJseTRRZ1MyYWJWT0NNdk01N08wblVmM0FkYW5yT1RtV2NEcU5RM0pycXhkc0dkXC9RRGc4VW1VQT09Il1dfQ==" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F212843" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        10:05 PM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        10:20 PM <br>
                        <span> Heathrow LHR</span>
                      </li>
                      <li class="rfms_emirates">
                        British Airways<br>
                        <span>BA-319</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>1h 15m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Heathrow, | <strong>Layover:: 8h 45m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        7:05 AM <br>
                        <span>Heathrow LHR</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        12:55 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        British Airways<br>
                        <span>BA-320</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>3h 50m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 13h 50m</span><br>
                        Arrival:<span class="color_secondry"> Sunday 01 May</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">212.84</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook3" id="F212843" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiTkZEemsyZ3FSNk96RGd4blZRcEJtQT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjIxMi44NCIsIkJhc2VQcmljZSI6IjE1MC4wMCIsIlRheGVzIjoiNjIuODQiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjIxMi44NCIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjE1MC4wMCIsIlRheFByaWNlX0JyZWFrZG93biI6IjYyLjg0IiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiQkEiLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIxNTAuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiNjIuODQiLCJUcmF2ZWxUaW1lIjoiUDBEVDEzSDUwTTBTIiwiQWlyU2VnbWVudF9LZXkiOiJ2KzM1Qzc0K1JENnpQZU5CRFwvK2ZuQT09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoiNVJYZHF6Tm5SQXFLdEVGM1pSZG1jUT09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IkJBIiwiRmxpZ2h0TnVtYmVyIjoiNDMzIiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJMSFIiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQyMjowNTowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMjI6MjA6MDAuMDAwKzAxOjAwIiwiRmxpZ2h0VGltZSI6Ijc1IiwiRGlzdGFuY2UiOiIyMTEiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjMxOSIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6Iko5fEM5fEQ3fFI5fEkwfFk5fEI5fEg5fEs5fE05fEw5fFY5fE4wfFEwfE8wfFMwfEcwIiwiRmxpZ2h0RGV0YWlsX0tleSI6IlFvRGEwRHg5UkVDZk5LT0w2RWpsaWc9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IjUiLCJCb29raW5nQ29kZSI6IlYiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiRDBUaXExdWdUNUduXC9wRTRYVHJsMFE9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJEMFRpcTF1Z1Q1R25cL3BFNFhUcmwwUT09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVGtFT2d6QU1ld3p5M1NudHVtUExvT29CZW1BYkVoZitcLzR5bHJaQm1LWTRTVzA1Q0NJYnlvQldHUHd5NGhpbWlmRjlBZ2RGYTg0Nm5zNFRvY0lJVWgyUGpZVEo2d0VnVlNoTjdsMlpMUGdtSXhHUzdVb0d6Y2R6ZWQyWTlDUFdoMHBLMWxUaFwvdk5CU2Z6T2owN1dIdnZRRG1RWW1ZQT09IiwiRmFyZUJhc2lzIjoiVk0wVjJIIn0seyJBaXJTZWdtZW50X0tleSI6InYrMzVDNzQrUkQ2elBlTkJEXC8rZm5BPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiQkEiLCJGbGlnaHROdW1iZXIiOiI2NzgiLCJPcmlnaW4iOiJMSFIiLCJEZXN0aW5hdGlvbiI6IklTVCIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA1LTAxVDA3OjA1OjAwLjAwMCswMTowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNS0wMVQxMjo1NTowMC4wMDArMDM6MDAiLCJGbGlnaHRUaW1lIjoiMjMwIiwiRGlzdGFuY2UiOiIxNTU3IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMjAiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUyIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJKOXxDN3xENHxSOXxJOHxZOXxCOXxIOXxLOXxNOXxMOXxWOXxOOXxROXxPOXxTOXxHOSIsIkZsaWdodERldGFpbF9LZXkiOiJcL0dCNFZncXNSVG1Ocno1TzVKZk9pUT09IiwiT3JpZ2luVGVybWluYWwiOiI1IiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkkiLCJCb29raW5nQ29kZSI6Ik8iLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiODdaMGp3YzJUZjZDcm1heCtwQXBodz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6Ijg3WjBqd2MyVGY2Q3JtYXgrcEFwaHc9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRrRUt3MEFJZkV5WXUyT2JTRytiTmwwU0NCdEkwMEl1XC9mOHo2cnFYRHVpZ2pqb3BKUlVPY3FXa1AzVDRkdmNSNWYwQUN0UmplUjB3dXcxUm5CQmhqMjM5Nkk3WTc0WGVMekZyekZCbHk0UWdTMmFiVk9DTXZNNTdPMG5VZjNBZGFuck9UbVdjRHFOUTNKcnF4ZHNHZFwvUURnOFVtVUE9PSIsIkZhcmVCYXNpcyI6Ik9MVjJSIn1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJEMFRpcTF1Z1Q1R25cL3BFNFhUcmwwUT09Il0sWyI4N1owandjMlRmNkNybWF4K3BBcGh3PT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXSxbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5Ua0VPZ3pBTWV3enkzU250dW1QTG9Pb0JlbUFiRWhmK1wvNHlsclpCbUtZNFNXMDVDQ0lieW9CV0dQd3k0aGltaWZGOUFnZEZhODQ2bnM0VG9jSUlVaDJQallUSjZ3RWdWU2hON2wyWkxQZ21JeEdTN1VvR3pjZHplZDJZOUNQV2gwcEsxbFRoXC92TkJTZnpPajA3V0h2dlFEbVFZbVlBPT0iXSxbImd3cy1lSnhOVGtFS3cwQUlmRXlZdTJPYlNHK2JObDBTQ0J0STAwSXVcL2Y4ejZycVhEdWlnampvcEpSVU9jcVdrUDNUNGR2Y1I1ZjBBQ3RSamVSMHd1dzFSbkJCaGoyMzk2STdZNzRYZUx6RnJ6RkJseTRRZ1MyYWJWT0NNdk01N08wblVmM0FkYW5yT1RtV2NEcU5RM0pycXhkc0dkXC9RRGc4VW1VQT09Il1dfQ==" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F212843" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid01234" data-airline="British Airways" data-arrive="800" data-duration="1035" data-stops="1" data-depature="1205" data-airlinecode="BA" data-price="212.84" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF212844" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/BA.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>22:05 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>16:20 (01 May, Sun 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">17h 15m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse4" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="IkQwVGlxMXVnVDVHblwvcEU0WFRybDBRPT18S0t8MUd8S0t8Z3dzLWVKeE5Ua0VPZ3pBTWV3enkzU250dW1QTG9Pb0JlbUFiRWhmK1wvNHlsclpCbUtZNFNXMDVDQ0lieW9CV0dQd3k0aGltaWZGOUFnZEZhODQ2bnM0VG9jSUlVaDJQallUSjZ3RWdWU2hON2wyWkxQZ21JeEdTN1VvR3pjZHplZDJZOUNQV2gwcEsxbFRoXC92TkJTZnpPajA3V0h2dlFEbVFZbVlBPT18S0t8fFZWfEQwVGlxMXVnVDVHblwvcEU0WFRybDBRPT18S0t8MUd8S0t8Z3dzLWVKeE5Ua0VPZ3pBTWV3enkzU250dW1QTG9Pb0JlbUFiRWhmK1wvNHlsclpCbUtZNFNXMDVDQ0lieW9CV0dQd3k0aGltaWZGOUFnZEZhODQ2bnM0VG9jSUlVaDJQallUSjZ3RWdWU2hON2wyWkxQZ21JeEdTN1VvR3pjZHplZDJZOUNQV2gwcEsxbFRoXC92TkJTZnpPajA3V0h2dlFEbVFZbVlBPT18S0t8ODdaMGp3YzJUZjZDcm1heCtwQXBodz09fEtLfDFHfEtLfGd3cy1lSnhOVGtFS3cwQUlmRXlZdTJPYlNHK2JObDBTQ0J0STAwSXVcL2Y4ejZycVhEdWlnampvcEpSVU9jcVdrUDNUNGR2Y1I1ZjBBQ3RSamVSMHd1dzFSbkJCaGoyMzk2STdZNzRYZUx6RnJ6RkJseTRRZ1MyYWJWT0NNdk01N08wblVmM0FkYW5yT1RtV2NEcU5RM0pycXhkc0dkXC9RRGc4VW1VQT09fEtLfHxWVnx8QHwyIg==" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">212.84</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook4" id="F212844" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiaFlhbGEyU0lTWktmVVZ3QWYwSXBTdz09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjIxMi44NCIsIkJhc2VQcmljZSI6IjE1MC4wMCIsIlRheGVzIjoiNjIuODQiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjIxMi44NCIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjE1MC4wMCIsIlRheFByaWNlX0JyZWFrZG93biI6IjYyLjg0IiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiQkEiLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIxNTAuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiNjIuODQiLCJUcmF2ZWxUaW1lIjoiUDBEVDE3SDE1TTBTIiwiQWlyU2VnbWVudF9LZXkiOiJsWWRLTXVJVVJwT2NLeXNnTnJBZXdnPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiI1UlhkcXpOblJBcUt0RUYzWlJkbWNRPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiQkEiLCJGbGlnaHROdW1iZXIiOiI0MzMiLCJPcmlnaW4iOiJBTVMiLCJEZXN0aW5hdGlvbiI6IkxIUiIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDIyOjA1OjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQyMjoyMDowMC4wMDArMDE6MDAiLCJGbGlnaHRUaW1lIjoiNzUiLCJEaXN0YW5jZSI6IjIxMSIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzE5IiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjl8Qzl8RDd8Ujl8STB8WTl8Qjl8SDl8Szl8TTl8TDl8Vjl8TjB8UTB8TzB8UzB8RzAiLCJGbGlnaHREZXRhaWxfS2V5IjoiUW9EYTBEeDlSRUNmTktPTDZFamxpZz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiNSIsIkJvb2tpbmdDb2RlIjoiViIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJEMFRpcTF1Z1Q1R25cL3BFNFhUcmwwUT09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IkQwVGlxMXVnVDVHblwvcEU0WFRybDBRPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Ua0VPZ3pBTWV3enkzU250dW1QTG9Pb0JlbUFiRWhmK1wvNHlsclpCbUtZNFNXMDVDQ0lieW9CV0dQd3k0aGltaWZGOUFnZEZhODQ2bnM0VG9jSUlVaDJQallUSjZ3RWdWU2hON2wyWkxQZ21JeEdTN1VvR3pjZHplZDJZOUNQV2gwcEsxbFRoXC92TkJTZnpPajA3V0h2dlFEbVFZbVlBPT0iLCJGYXJlQmFzaXMiOiJWTTBWMkgifSx7IkFpclNlZ21lbnRfS2V5IjoibFlkS011SVVScE9jS3lzZ05yQWV3Zz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IkJBIiwiRmxpZ2h0TnVtYmVyIjoiNjc2IiwiT3JpZ2luIjoiTEhSIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNS0wMVQxMDoyMDowMC4wMDArMDE6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDUtMDFUMTY6MjA6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjI0MCIsIkRpc3RhbmNlIjoiMTU1NyIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiNzY3IiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjl8Qzh8RDJ8Ujl8STV8WTl8Qjl8SDl8Szl8TTl8TDl8Vjl8Tjl8UTd8TzJ8UzZ8RzkiLCJGbGlnaHREZXRhaWxfS2V5IjoiekhPaFwvdTNQUndhYlwvTHFFcEMwdXlnPT0iLCJPcmlnaW5UZXJtaW5hbCI6IjUiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiTyIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiI4N1owandjMlRmNkNybWF4K3BBcGh3PT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiODdaMGp3YzJUZjZDcm1heCtwQXBodz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVGtFS3cwQUlmRXlZdTJPYlNHK2JObDBTQ0J0STAwSXVcL2Y4ejZycVhEdWlnampvcEpSVU9jcVdrUDNUNGR2Y1I1ZjBBQ3RSamVSMHd1dzFSbkJCaGoyMzk2STdZNzRYZUx6RnJ6RkJseTRRZ1MyYWJWT0NNdk01N08wblVmM0FkYW5yT1RtV2NEcU5RM0pycXhkc0dkXC9RRGc4VW1VQT09IiwiRmFyZUJhc2lzIjoiT0xWMlIifV0sIkZhcmVydWxlc3JlZl9LZXkiOltbIkQwVGlxMXVnVDVHblwvcEU0WFRybDBRPT0iXSxbIjg3WjBqd2MyVGY2Q3JtYXgrcEFwaHc9PSJdXSwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjpbWyIxRyJdLFsiMUciXV0sIkZhcmVydWxlc3JlZl9jb250ZW50IjpbWyJnd3MtZUp4TlRrRU9nekFNZXd6eTNTbnR1bVBMb09vQmVtQWJFaGYrXC80eWxyWkJtS1k0U1cwNUNDSWJ5b0JXR1B3eTRoaW1pZkY5QWdkRmE4NDZuczRUb2NJSVVoMlBqWVRKNndFZ1ZTaE43bDJaTFBnbUl4R1M3VW9HemNkemVkMlk5Q1BXaDBwSzFsVGhcL3ZOQlNmek9qMDdXSHZ2UURtUVltWUE9PSJdLFsiZ3dzLWVKeE5Ua0VLdzBBSWZFeVl1Mk9iU0crYk5sMFNDQnRJMDBJdVwvZjh6NnJxWER1aWdqam9wSlJVT2NxV2tQM1Q0ZHZjUjVmMEFDdFJqZVIwd3V3MVJuQkJoajIzOTZJN1k3NFhlTHpGcnpGQmx5NFFnUzJhYlZPQ012TTU3TzBuVWYzQWRhbnJPVG1XY0RxTlEzSnJxeGRzR2RcL1FEZzhVbVVBPT0iXV19" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F212844" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        10:05 PM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        10:20 PM <br>
                        <span> Heathrow LHR</span>
                      </li>
                      <li class="rfms_emirates">
                        British Airways<br>
                        <span>BA-319</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>1h 15m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Heathrow, | <strong>Layover:: 12h 0m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        10:20 AM <br>
                        <span>Heathrow LHR</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        4:20 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        British Airways<br>
                        <span>BA-767</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>4h 0m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 17h 15m</span><br>
                        Arrival:<span class="color_secondry"> Sunday 01 May</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">212.84</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook4" id="F212844" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiaFlhbGEyU0lTWktmVVZ3QWYwSXBTdz09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjIxMi44NCIsIkJhc2VQcmljZSI6IjE1MC4wMCIsIlRheGVzIjoiNjIuODQiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjIxMi44NCIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjE1MC4wMCIsIlRheFByaWNlX0JyZWFrZG93biI6IjYyLjg0IiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiQkEiLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIxNTAuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiNjIuODQiLCJUcmF2ZWxUaW1lIjoiUDBEVDE3SDE1TTBTIiwiQWlyU2VnbWVudF9LZXkiOiJsWWRLTXVJVVJwT2NLeXNnTnJBZXdnPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiI1UlhkcXpOblJBcUt0RUYzWlJkbWNRPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiQkEiLCJGbGlnaHROdW1iZXIiOiI0MzMiLCJPcmlnaW4iOiJBTVMiLCJEZXN0aW5hdGlvbiI6IkxIUiIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDIyOjA1OjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQyMjoyMDowMC4wMDArMDE6MDAiLCJGbGlnaHRUaW1lIjoiNzUiLCJEaXN0YW5jZSI6IjIxMSIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzE5IiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjl8Qzl8RDd8Ujl8STB8WTl8Qjl8SDl8Szl8TTl8TDl8Vjl8TjB8UTB8TzB8UzB8RzAiLCJGbGlnaHREZXRhaWxfS2V5IjoiUW9EYTBEeDlSRUNmTktPTDZFamxpZz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiNSIsIkJvb2tpbmdDb2RlIjoiViIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJEMFRpcTF1Z1Q1R25cL3BFNFhUcmwwUT09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IkQwVGlxMXVnVDVHblwvcEU0WFRybDBRPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Ua0VPZ3pBTWV3enkzU250dW1QTG9Pb0JlbUFiRWhmK1wvNHlsclpCbUtZNFNXMDVDQ0lieW9CV0dQd3k0aGltaWZGOUFnZEZhODQ2bnM0VG9jSUlVaDJQallUSjZ3RWdWU2hON2wyWkxQZ21JeEdTN1VvR3pjZHplZDJZOUNQV2gwcEsxbFRoXC92TkJTZnpPajA3V0h2dlFEbVFZbVlBPT0iLCJGYXJlQmFzaXMiOiJWTTBWMkgifSx7IkFpclNlZ21lbnRfS2V5IjoibFlkS011SVVScE9jS3lzZ05yQWV3Zz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IkJBIiwiRmxpZ2h0TnVtYmVyIjoiNjc2IiwiT3JpZ2luIjoiTEhSIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNS0wMVQxMDoyMDowMC4wMDArMDE6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDUtMDFUMTY6MjA6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjI0MCIsIkRpc3RhbmNlIjoiMTU1NyIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiNzY3IiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjl8Qzh8RDJ8Ujl8STV8WTl8Qjl8SDl8Szl8TTl8TDl8Vjl8Tjl8UTd8TzJ8UzZ8RzkiLCJGbGlnaHREZXRhaWxfS2V5IjoiekhPaFwvdTNQUndhYlwvTHFFcEMwdXlnPT0iLCJPcmlnaW5UZXJtaW5hbCI6IjUiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiTyIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiI4N1owandjMlRmNkNybWF4K3BBcGh3PT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiODdaMGp3YzJUZjZDcm1heCtwQXBodz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVGtFS3cwQUlmRXlZdTJPYlNHK2JObDBTQ0J0STAwSXVcL2Y4ejZycVhEdWlnampvcEpSVU9jcVdrUDNUNGR2Y1I1ZjBBQ3RSamVSMHd1dzFSbkJCaGoyMzk2STdZNzRYZUx6RnJ6RkJseTRRZ1MyYWJWT0NNdk01N08wblVmM0FkYW5yT1RtV2NEcU5RM0pycXhkc0dkXC9RRGc4VW1VQT09IiwiRmFyZUJhc2lzIjoiT0xWMlIifV0sIkZhcmVydWxlc3JlZl9LZXkiOltbIkQwVGlxMXVnVDVHblwvcEU0WFRybDBRPT0iXSxbIjg3WjBqd2MyVGY2Q3JtYXgrcEFwaHc9PSJdXSwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjpbWyIxRyJdLFsiMUciXV0sIkZhcmVydWxlc3JlZl9jb250ZW50IjpbWyJnd3MtZUp4TlRrRU9nekFNZXd6eTNTbnR1bVBMb09vQmVtQWJFaGYrXC80eWxyWkJtS1k0U1cwNUNDSWJ5b0JXR1B3eTRoaW1pZkY5QWdkRmE4NDZuczRUb2NJSVVoMlBqWVRKNndFZ1ZTaE43bDJaTFBnbUl4R1M3VW9HemNkemVkMlk5Q1BXaDBwSzFsVGhcL3ZOQlNmek9qMDdXSHZ2UURtUVltWUE9PSJdLFsiZ3dzLWVKeE5Ua0VLdzBBSWZFeVl1Mk9iU0crYk5sMFNDQnRJMDBJdVwvZjh6NnJxWER1aWdqam9wSlJVT2NxV2tQM1Q0ZHZjUjVmMEFDdFJqZVIwd3V3MVJuQkJoajIzOTZJN1k3NFhlTHpGcnpGQmx5NFFnUzJhYlZPQ012TTU3TzBuVWYzQWRhbnJPVG1XY0RxTlEzSnJxeGRzR2RcL1FEZzhVbVVBPT0iXV19" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F212844" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid01235" data-airline="Aeroflot Airlines" data-arrive="640" data-duration="925" data-stops="1" data-depature="1155" data-airlinecode="SU" data-price="216.03" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF216035" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/SU.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>21:15 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>13:40 (01 May, Sun 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">15h 25m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse5" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="InhIY2t1bUN2UmIyS0RPWENnY0VLUVE9PXxLS3wxR3xLS3xnd3MtZUp4TlRzc093akFNKzVqSmQ3dXNQRzZkOWhBY0tJaDJnbDMyXC81OUIya3FJU0xHVjJJb1RRbkRVa2IwWVwvcXJEM3FVVmNSMkJDR2Q5U3huUzJYbklwZzJrUFBMejgzaWpIVGpROXJGcWpWVmQwMlgwSUJZdWFrb3BiQldIZVwvcmRMSWt3SXdyTVY2TTRUUGsxVTJSZnc0Z1Q3S2N2OFZzbk9BPT18S0t8fFZWfHxAfDEi" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">216.03</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook5" id="F216035" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiSVFjclRmMmJSWktzcVNJdGxnYkw5QT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjIxNi4wMyIsIkJhc2VQcmljZSI6IjEwOC4wMCIsIlRheGVzIjoiMTA4LjAzIiwiVG90YWxQcmljZV9BUEkiOiJFVVIyMTYuMDMiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIxMDguMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiIxMDguMDMiLCJSZWZ1bmRhYmxlIjpmYWxzZSwiUGxhdGluZ0NhcnJpZXIiOiJTVSIsIkZhcmVUeXBlIjoiTm9uIFJlZnVuZGFibGUiLCJBbGxfUGFzc2VuZ2VyIjoiQURUIiwiQWR1bHRzIjoxLCJBZHVsdHNfQmFzZV9QcmljZSI6IjEwOC4wMCIsIkFkdWx0c19UYXhfUHJpY2UiOiIxMDguMDMiLCJUcmF2ZWxUaW1lIjoiUDBEVDE1SDI1TTBTIiwiQWlyU2VnbWVudF9LZXkiOiJcL0RneFgxNzFScldmOWxUcERSUXEzdz09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoicUlXa0s1Y1NRSU9OUHE0TnkrZFA0Zz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlNVIiwiRmxpZ2h0TnVtYmVyIjoiMzEyMyIsIk9yaWdpbiI6IkFNUyIsIkRlc3RpbmF0aW9uIjoiU1ZPIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMjE6MTU6MDAuMDAwKzAyOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA1LTAxVDAxOjMwOjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIxOTUiLCJEaXN0YW5jZSI6IjEzNDMiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjczNyIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6Iko3fEM3fEQ3fEk3fFo3fFk3fEI3fE03fFU3fEs3fEg3fEw3fFE3fFQ3fEU3fE4wIiwiRmxpZ2h0RGV0YWlsX0tleSI6IjJ5RkExVjZoUW9DbG0zdnludHhNUVE9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkUiLCJCb29raW5nQ29kZSI6IlQiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoieEhja3VtQ3ZSYjJLRE9YQ2djRUtRUT09IiwiRmFyZXJ1bGVzcmVmX0tleSI6InhIY2t1bUN2UmIyS0RPWENnY0VLUVE9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRzc093akFNKzVqSmQ3dXNQRzZkOWhBY0tJaDJnbDMyXC81OUIya3FJU0xHVjJJb1RRbkRVa2IwWVwvcXJEM3FVVmNSMkJDR2Q5U3huUzJYbklwZzJrUFBMejgzaWpIVGpROXJGcWpWVmQwMlgwSUJZdWFrb3BiQldIZVwvcmRMSWt3SXdyTVY2TTRUUGsxVTJSZnc0Z1Q3S2N2OFZzbk9BPT0iLCJGYXJlQmFzaXMiOiJUUFhPVyJ9LHsiQWlyU2VnbWVudF9LZXkiOiJcL0RneFgxNzFScldmOWxUcERSUXEzdz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlNVIiwiRmxpZ2h0TnVtYmVyIjoiMjEzNiIsIk9yaWdpbiI6IlNWTyIsIkRlc3RpbmF0aW9uIjoiSVNUIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDUtMDFUMTA6MDU6MDAuMDAwKzAzOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA1LTAxVDEzOjQwOjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIyMTUiLCJEaXN0YW5jZSI6IjEwODkiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjMyMCIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6Iko3fEM1fEQzfEkzfFozfFk3fEI3fE03fFU3fEs3fEg3fEw3fFE3fFQ3fEUwfE4wfFIwfEcwfFYwIiwiRmxpZ2h0RGV0YWlsX0tleSI6IitxcWwxZEQ4U3BhRmRrUGZQVWRIQUE9PSIsIk9yaWdpblRlcm1pbmFsIjoiRCIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiJJIiwiQm9va2luZ0NvZGUiOiJUIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6InhIY2t1bUN2UmIyS0RPWENnY0VLUVE9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJ4SGNrdW1DdlJiMktET1hDZ2NFS1FRPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Uc3NPd2pBTSs1akpkN3VzUEc2ZDloQWNLSWgyZ2wzMlwvNTlCMmtxSVNMR1YySW9UUW5EVWtiMFlcL3FyRDNxVVZjUjJCQ0dkOVN4blMyWG5JcGcya1BQTHo4M2lqSFRqUTlyRnFqVlZkMDJYMElCWXVha29wYkJXSGVcL3JkTElrd0l3ck1WNk00VFBrMVUyUmZ3NGdUN0tjdjhWc25PQT09IiwiRmFyZUJhc2lzIjoiVFBYT1cifV0sIkZhcmVydWxlc3JlZl9LZXkiOltbInhIY2t1bUN2UmIyS0RPWENnY0VLUVE9PSJdLFsieEhja3VtQ3ZSYjJLRE9YQ2djRUtRUT09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl0sWyIxRyJdXSwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOltbImd3cy1lSnhOVHNzT3dqQU0rNWpKZDd1c1BHNmQ5aEFjS0loMmdsMzJcLzU5QjJrcUlTTEdWMklvVFFuRFVrYjBZXC9xckQzcVVWY1IyQkNHZDlTeG5TMlhuSXBnMmtQUEx6ODNpakhUalE5ckZxalZWZDAyWDBJQll1YWtvcGJCV0hlXC9yZExJa3dJd3JNVjZNNFRQazFVMlJmdzRnVDdLY3Y4VnNuT0E9PSJdLFsiZ3dzLWVKeE5Uc3NPd2pBTSs1akpkN3VzUEc2ZDloQWNLSWgyZ2wzMlwvNTlCMmtxSVNMR1YySW9UUW5EVWtiMFlcL3FyRDNxVVZjUjJCQ0dkOVN4blMyWG5JcGcya1BQTHo4M2lqSFRqUTlyRnFqVlZkMDJYMElCWXVha29wYkJXSGVcL3JkTElrd0l3ck1WNk00VFBrMVUyUmZ3NGdUN0tjdjhWc25PQT09Il1dfQ==" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F216035" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        9:15 PM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        1:30 AM <br>
                        <span> Sheremetyevo Arpt SVO</span>
                      </li>
                      <li class="rfms_emirates">
                        Aeroflot Airlines<br>
                        <span>SU-737</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>3h 15m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Sheremetyevo Arpt, | <strong>Layover:: 8h 35m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        10:05 AM <br>
                        <span>Sheremetyevo Arpt SVO</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        1:40 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        Aeroflot Airlines<br>
                        <span>SU-320</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>3h 35m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 15h 25m</span><br>
                        Arrival:<span class="color_secondry"> Sunday 01 May</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">216.03</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook5" id="F216035" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiSVFjclRmMmJSWktzcVNJdGxnYkw5QT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjIxNi4wMyIsIkJhc2VQcmljZSI6IjEwOC4wMCIsIlRheGVzIjoiMTA4LjAzIiwiVG90YWxQcmljZV9BUEkiOiJFVVIyMTYuMDMiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIxMDguMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiIxMDguMDMiLCJSZWZ1bmRhYmxlIjpmYWxzZSwiUGxhdGluZ0NhcnJpZXIiOiJTVSIsIkZhcmVUeXBlIjoiTm9uIFJlZnVuZGFibGUiLCJBbGxfUGFzc2VuZ2VyIjoiQURUIiwiQWR1bHRzIjoxLCJBZHVsdHNfQmFzZV9QcmljZSI6IjEwOC4wMCIsIkFkdWx0c19UYXhfUHJpY2UiOiIxMDguMDMiLCJUcmF2ZWxUaW1lIjoiUDBEVDE1SDI1TTBTIiwiQWlyU2VnbWVudF9LZXkiOiJcL0RneFgxNzFScldmOWxUcERSUXEzdz09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoicUlXa0s1Y1NRSU9OUHE0TnkrZFA0Zz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlNVIiwiRmxpZ2h0TnVtYmVyIjoiMzEyMyIsIk9yaWdpbiI6IkFNUyIsIkRlc3RpbmF0aW9uIjoiU1ZPIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMjE6MTU6MDAuMDAwKzAyOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA1LTAxVDAxOjMwOjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIxOTUiLCJEaXN0YW5jZSI6IjEzNDMiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjczNyIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6Iko3fEM3fEQ3fEk3fFo3fFk3fEI3fE03fFU3fEs3fEg3fEw3fFE3fFQ3fEU3fE4wIiwiRmxpZ2h0RGV0YWlsX0tleSI6IjJ5RkExVjZoUW9DbG0zdnludHhNUVE9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkUiLCJCb29raW5nQ29kZSI6IlQiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoieEhja3VtQ3ZSYjJLRE9YQ2djRUtRUT09IiwiRmFyZXJ1bGVzcmVmX0tleSI6InhIY2t1bUN2UmIyS0RPWENnY0VLUVE9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRzc093akFNKzVqSmQ3dXNQRzZkOWhBY0tJaDJnbDMyXC81OUIya3FJU0xHVjJJb1RRbkRVa2IwWVwvcXJEM3FVVmNSMkJDR2Q5U3huUzJYbklwZzJrUFBMejgzaWpIVGpROXJGcWpWVmQwMlgwSUJZdWFrb3BiQldIZVwvcmRMSWt3SXdyTVY2TTRUUGsxVTJSZnc0Z1Q3S2N2OFZzbk9BPT0iLCJGYXJlQmFzaXMiOiJUUFhPVyJ9LHsiQWlyU2VnbWVudF9LZXkiOiJcL0RneFgxNzFScldmOWxUcERSUXEzdz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlNVIiwiRmxpZ2h0TnVtYmVyIjoiMjEzNiIsIk9yaWdpbiI6IlNWTyIsIkRlc3RpbmF0aW9uIjoiSVNUIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDUtMDFUMTA6MDU6MDAuMDAwKzAzOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA1LTAxVDEzOjQwOjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIyMTUiLCJEaXN0YW5jZSI6IjEwODkiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjMyMCIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6Iko3fEM1fEQzfEkzfFozfFk3fEI3fE03fFU3fEs3fEg3fEw3fFE3fFQ3fEUwfE4wfFIwfEcwfFYwIiwiRmxpZ2h0RGV0YWlsX0tleSI6IitxcWwxZEQ4U3BhRmRrUGZQVWRIQUE9PSIsIk9yaWdpblRlcm1pbmFsIjoiRCIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiJJIiwiQm9va2luZ0NvZGUiOiJUIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6InhIY2t1bUN2UmIyS0RPWENnY0VLUVE9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJ4SGNrdW1DdlJiMktET1hDZ2NFS1FRPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Uc3NPd2pBTSs1akpkN3VzUEc2ZDloQWNLSWgyZ2wzMlwvNTlCMmtxSVNMR1YySW9UUW5EVWtiMFlcL3FyRDNxVVZjUjJCQ0dkOVN4blMyWG5JcGcya1BQTHo4M2lqSFRqUTlyRnFqVlZkMDJYMElCWXVha29wYkJXSGVcL3JkTElrd0l3ck1WNk00VFBrMVUyUmZ3NGdUN0tjdjhWc25PQT09IiwiRmFyZUJhc2lzIjoiVFBYT1cifV0sIkZhcmVydWxlc3JlZl9LZXkiOltbInhIY2t1bUN2UmIyS0RPWENnY0VLUVE9PSJdLFsieEhja3VtQ3ZSYjJLRE9YQ2djRUtRUT09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl0sWyIxRyJdXSwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOltbImd3cy1lSnhOVHNzT3dqQU0rNWpKZDd1c1BHNmQ5aEFjS0loMmdsMzJcLzU5QjJrcUlTTEdWMklvVFFuRFVrYjBZXC9xckQzcVVWY1IyQkNHZDlTeG5TMlhuSXBnMmtQUEx6ODNpakhUalE5ckZxalZWZDAyWDBJQll1YWtvcGJCV0hlXC9yZExJa3dJd3JNVjZNNFRQazFVMlJmdzRnVDdLY3Y4VnNuT0E9PSJdLFsiZ3dzLWVKeE5Uc3NPd2pBTSs1akpkN3VzUEc2ZDloQWNLSWgyZ2wzMlwvNTlCMmtxSVNMR1YySW9UUW5EVWtiMFlcL3FyRDNxVVZjUjJCQ0dkOVN4blMyWG5JcGcya1BQTHo4M2lqSFRqUTlyRnFqVlZkMDJYMElCWXVha29wYkJXSGVcL3JkTElrd0l3ck1WNk00VFBrMVUyUmZ3NGdUN0tjdjhWc25PQT09Il1dfQ==" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F216035" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid01236" data-airline="Aeroflot Airlines" data-arrive="1325" data-duration="1430" data-stops="1" data-depature="1335" data-airlinecode="SU" data-price="216.03" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF216036" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/SU.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>00:15 (29 Apr, Fri 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>01:05 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">23h 50m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse6" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="InhIY2t1bUN2UmIyS0RPWENnY0VLUVE9PXxLS3wxR3xLS3xnd3MtZUp4TlRzc093akFNKzVqSmQ3dXNQRzZkOWhBY0tJaDJnbDMyXC81OUIya3FJU0xHVjJJb1RRbkRVa2IwWVwvcXJEM3FVVmNSMkJDR2Q5U3huUzJYbklwZzJrUFBMejgzaWpIVGpROXJGcWpWVmQwMlgwSUJZdWFrb3BiQldIZVwvcmRMSWt3SXdyTVY2TTRUUGsxVTJSZnc0Z1Q3S2N2OFZzbk9BPT18S0t8fFZWfHxAfDEi" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">216.03</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook6" id="F216036" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiVWg1MU40cU1SY0NCbkU4M21xTTFhUT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjIxNi4wMyIsIkJhc2VQcmljZSI6IjEwOC4wMCIsIlRheGVzIjoiMTA4LjAzIiwiVG90YWxQcmljZV9BUEkiOiJFVVIyMTYuMDMiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIxMDguMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiIxMDguMDMiLCJSZWZ1bmRhYmxlIjpmYWxzZSwiUGxhdGluZ0NhcnJpZXIiOiJTVSIsIkZhcmVUeXBlIjoiTm9uIFJlZnVuZGFibGUiLCJBbGxfUGFzc2VuZ2VyIjoiQURUIiwiQWR1bHRzIjoxLCJBZHVsdHNfQmFzZV9QcmljZSI6IjEwOC4wMCIsIkFkdWx0c19UYXhfUHJpY2UiOiIxMDguMDMiLCJUcmF2ZWxUaW1lIjoiUDBEVDIzSDUwTTBTIiwiQWlyU2VnbWVudF9LZXkiOiJGNmlOcHZJd1NIT0h0VHJHOThoQjdRPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiJyYkx5TGJoTFQ0YWsweTZjelRoNWxRPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiU1UiLCJGbGlnaHROdW1iZXIiOiIyMTkzIiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJTVk8iLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQwMDoxNTowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMDQ6MjU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjE5MCIsIkRpc3RhbmNlIjoiMTM0MyIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIxIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjd8Qzd8RDd8STd8Wjd8WTd8Qjd8TTd8VTd8Szd8SDd8TDd8UTd8VDd8RTd8TjB8UjB8RzB8VjAiLCJGbGlnaHREZXRhaWxfS2V5IjoiTzBWUnl5aWxTWVdcL0E5cmJMSUpRNXc9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkQiLCJCb29raW5nQ29kZSI6IlQiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoieEhja3VtQ3ZSYjJLRE9YQ2djRUtRUT09IiwiRmFyZXJ1bGVzcmVmX0tleSI6InhIY2t1bUN2UmIyS0RPWENnY0VLUVE9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRzc093akFNKzVqSmQ3dXNQRzZkOWhBY0tJaDJnbDMyXC81OUIya3FJU0xHVjJJb1RRbkRVa2IwWVwvcXJEM3FVVmNSMkJDR2Q5U3huUzJYbklwZzJrUFBMejgzaWpIVGpROXJGcWpWVmQwMlgwSUJZdWFrb3BiQldIZVwvcmRMSWt3SXdyTVY2TTRUUGsxVTJSZnc0Z1Q3S2N2OFZzbk9BPT0iLCJGYXJlQmFzaXMiOiJUUFhPVyJ9LHsiQWlyU2VnbWVudF9LZXkiOiJGNmlOcHZJd1NIT0h0VHJHOThoQjdRPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiU1UiLCJGbGlnaHROdW1iZXIiOiIyMTM0IiwiT3JpZ2luIjoiU1ZPIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQyMToyNTowMC4wMDArMDM6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDUtMDFUMDE6MDU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjIyMCIsIkRpc3RhbmNlIjoiMTA4OSIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIwIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjR8QzJ8RDB8STB8WjB8WTd8Qjd8TTd8VTd8Szd8SDd8TDd8UTd8VDd8RTd8TjB8UjB8RzB8VjAiLCJGbGlnaHREZXRhaWxfS2V5IjoiNjdrUkdjR05RWkNJMEJpRUJodE9aQT09IiwiT3JpZ2luVGVybWluYWwiOiJEIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkkiLCJCb29raW5nQ29kZSI6IlQiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoieEhja3VtQ3ZSYjJLRE9YQ2djRUtRUT09IiwiRmFyZXJ1bGVzcmVmX0tleSI6InhIY2t1bUN2UmIyS0RPWENnY0VLUVE9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRzc093akFNKzVqSmQ3dXNQRzZkOWhBY0tJaDJnbDMyXC81OUIya3FJU0xHVjJJb1RRbkRVa2IwWVwvcXJEM3FVVmNSMkJDR2Q5U3huUzJYbklwZzJrUFBMejgzaWpIVGpROXJGcWpWVmQwMlgwSUJZdWFrb3BiQldIZVwvcmRMSWt3SXdyTVY2TTRUUGsxVTJSZnc0Z1Q3S2N2OFZzbk9BPT0iLCJGYXJlQmFzaXMiOiJUUFhPVyJ9XSwiRmFyZXJ1bGVzcmVmX0tleSI6W1sieEhja3VtQ3ZSYjJLRE9YQ2djRUtRUT09Il0sWyJ4SGNrdW1DdlJiMktET1hDZ2NFS1FRPT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXSxbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5Uc3NPd2pBTSs1akpkN3VzUEc2ZDloQWNLSWgyZ2wzMlwvNTlCMmtxSVNMR1YySW9UUW5EVWtiMFlcL3FyRDNxVVZjUjJCQ0dkOVN4blMyWG5JcGcya1BQTHo4M2lqSFRqUTlyRnFqVlZkMDJYMElCWXVha29wYkJXSGVcL3JkTElrd0l3ck1WNk00VFBrMVUyUmZ3NGdUN0tjdjhWc25PQT09Il0sWyJnd3MtZUp4TlRzc093akFNKzVqSmQ3dXNQRzZkOWhBY0tJaDJnbDMyXC81OUIya3FJU0xHVjJJb1RRbkRVa2IwWVwvcXJEM3FVVmNSMkJDR2Q5U3huUzJYbklwZzJrUFBMejgzaWpIVGpROXJGcWpWVmQwMlgwSUJZdWFrb3BiQldIZVwvcmRMSWt3SXdyTVY2TTRUUGsxVTJSZnc0Z1Q3S2N2OFZzbk9BPT0iXV19" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F216036" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Friday 29 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        12:15 AM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        4:25 AM <br>
                        <span> Sheremetyevo Arpt SVO</span>
                      </li>
                      <li class="rfms_emirates">
                        Aeroflot Airlines<br>
                        <span>SU-321</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>3h 10m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Sheremetyevo Arpt, | <strong>Layover:: 17h 0m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        9:25 PM <br>
                        <span>Sheremetyevo Arpt SVO</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        1:05 AM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        Aeroflot Airlines<br>
                        <span>SU-320</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>3h 40m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 23h 50m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">216.03</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook6" id="F216036" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiVWg1MU40cU1SY0NCbkU4M21xTTFhUT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjIxNi4wMyIsIkJhc2VQcmljZSI6IjEwOC4wMCIsIlRheGVzIjoiMTA4LjAzIiwiVG90YWxQcmljZV9BUEkiOiJFVVIyMTYuMDMiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIxMDguMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiIxMDguMDMiLCJSZWZ1bmRhYmxlIjpmYWxzZSwiUGxhdGluZ0NhcnJpZXIiOiJTVSIsIkZhcmVUeXBlIjoiTm9uIFJlZnVuZGFibGUiLCJBbGxfUGFzc2VuZ2VyIjoiQURUIiwiQWR1bHRzIjoxLCJBZHVsdHNfQmFzZV9QcmljZSI6IjEwOC4wMCIsIkFkdWx0c19UYXhfUHJpY2UiOiIxMDguMDMiLCJUcmF2ZWxUaW1lIjoiUDBEVDIzSDUwTTBTIiwiQWlyU2VnbWVudF9LZXkiOiJGNmlOcHZJd1NIT0h0VHJHOThoQjdRPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiJyYkx5TGJoTFQ0YWsweTZjelRoNWxRPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiU1UiLCJGbGlnaHROdW1iZXIiOiIyMTkzIiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJTVk8iLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQwMDoxNTowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMDQ6MjU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjE5MCIsIkRpc3RhbmNlIjoiMTM0MyIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIxIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjd8Qzd8RDd8STd8Wjd8WTd8Qjd8TTd8VTd8Szd8SDd8TDd8UTd8VDd8RTd8TjB8UjB8RzB8VjAiLCJGbGlnaHREZXRhaWxfS2V5IjoiTzBWUnl5aWxTWVdcL0E5cmJMSUpRNXc9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkQiLCJCb29raW5nQ29kZSI6IlQiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoieEhja3VtQ3ZSYjJLRE9YQ2djRUtRUT09IiwiRmFyZXJ1bGVzcmVmX0tleSI6InhIY2t1bUN2UmIyS0RPWENnY0VLUVE9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRzc093akFNKzVqSmQ3dXNQRzZkOWhBY0tJaDJnbDMyXC81OUIya3FJU0xHVjJJb1RRbkRVa2IwWVwvcXJEM3FVVmNSMkJDR2Q5U3huUzJYbklwZzJrUFBMejgzaWpIVGpROXJGcWpWVmQwMlgwSUJZdWFrb3BiQldIZVwvcmRMSWt3SXdyTVY2TTRUUGsxVTJSZnc0Z1Q3S2N2OFZzbk9BPT0iLCJGYXJlQmFzaXMiOiJUUFhPVyJ9LHsiQWlyU2VnbWVudF9LZXkiOiJGNmlOcHZJd1NIT0h0VHJHOThoQjdRPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiU1UiLCJGbGlnaHROdW1iZXIiOiIyMTM0IiwiT3JpZ2luIjoiU1ZPIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQyMToyNTowMC4wMDArMDM6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDUtMDFUMDE6MDU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjIyMCIsIkRpc3RhbmNlIjoiMTA4OSIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIwIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjR8QzJ8RDB8STB8WjB8WTd8Qjd8TTd8VTd8Szd8SDd8TDd8UTd8VDd8RTd8TjB8UjB8RzB8VjAiLCJGbGlnaHREZXRhaWxfS2V5IjoiNjdrUkdjR05RWkNJMEJpRUJodE9aQT09IiwiT3JpZ2luVGVybWluYWwiOiJEIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkkiLCJCb29raW5nQ29kZSI6IlQiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoieEhja3VtQ3ZSYjJLRE9YQ2djRUtRUT09IiwiRmFyZXJ1bGVzcmVmX0tleSI6InhIY2t1bUN2UmIyS0RPWENnY0VLUVE9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRzc093akFNKzVqSmQ3dXNQRzZkOWhBY0tJaDJnbDMyXC81OUIya3FJU0xHVjJJb1RRbkRVa2IwWVwvcXJEM3FVVmNSMkJDR2Q5U3huUzJYbklwZzJrUFBMejgzaWpIVGpROXJGcWpWVmQwMlgwSUJZdWFrb3BiQldIZVwvcmRMSWt3SXdyTVY2TTRUUGsxVTJSZnc0Z1Q3S2N2OFZzbk9BPT0iLCJGYXJlQmFzaXMiOiJUUFhPVyJ9XSwiRmFyZXJ1bGVzcmVmX0tleSI6W1sieEhja3VtQ3ZSYjJLRE9YQ2djRUtRUT09Il0sWyJ4SGNrdW1DdlJiMktET1hDZ2NFS1FRPT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXSxbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5Uc3NPd2pBTSs1akpkN3VzUEc2ZDloQWNLSWgyZ2wzMlwvNTlCMmtxSVNMR1YySW9UUW5EVWtiMFlcL3FyRDNxVVZjUjJCQ0dkOVN4blMyWG5JcGcya1BQTHo4M2lqSFRqUTlyRnFqVlZkMDJYMElCWXVha29wYkJXSGVcL3JkTElrd0l3ck1WNk00VFBrMVUyUmZ3NGdUN0tjdjhWc25PQT09Il0sWyJnd3MtZUp4TlRzc093akFNKzVqSmQ3dXNQRzZkOWhBY0tJaDJnbDMyXC81OUIya3FJU0xHVjJJb1RRbkRVa2IwWVwvcXJEM3FVVmNSMkJDR2Q5U3huUzJYbklwZzJrUFBMejgzaWpIVGpROXJGcWpWVmQwMlgwSUJZdWFrb3BiQldIZVwvcmRMSWt3SXdyTVY2TTRUUGsxVTJSZnc0Z1Q3S2N2OFZzbk9BPT0iXV19" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F216036" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid01237" data-airline="Air France" data-arrive="1215" data-duration="350" data-stops="1" data-depature="865" data-airlinecode="AF" data-price="232.85" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF232857" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/AF.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>16:25 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>23:15 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">5h 50m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse7" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="IitXTlpnQTVqU2xDcjZTSnpuMVBnK3c9PXxLS3wxR3xLS3xnd3MtZUp4TlR0RUtnekFNXC9CaTU5NlE2WGQ5YVdtV0RHVVE3aWlcLzdcLzg5WTJvSjRrQXZoanNzNTV3enhTQU9UdTZIRHJcL01MNUJzQWdkRjVId2xzclhtQzlUcEJ4QThrem43TDhrSEw2RWtscVhMYlhJM3pHQ2NRNGhENnBoVGdyT3pYNDRvdFQ2RkdGSnBmdXNUSGxMYzFrUGF6U3JzS0U3VFlINzBlS0pVPXxLS3x8VlZ8fEB8MSI=" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">232.85</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook7" id="F232857" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiUWMwK1l0bFFUS0M5ZWd0Z3E0WmRtZz09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjIzMi44NSIsIkJhc2VQcmljZSI6IjE4Mi4wMCIsIlRheGVzIjoiNTAuODUiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjIzMi44NSIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjE4Mi4wMCIsIlRheFByaWNlX0JyZWFrZG93biI6IjUwLjg1IiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiS0wiLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIxODIuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiNTAuODUiLCJUcmF2ZWxUaW1lIjoiUDBEVDVINTBNMFMiLCJBaXJTZWdtZW50X0tleSI6InpOdXI3TVZ0VFcrciszcjJiZ25seEE9PSIsInNlZ21lbnRzIjpbeyJBaXJTZWdtZW50X0tleSI6ImwxN2ZBa29oU0thZjhLUEkzb2lzR1E9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJBRiIsIkZsaWdodE51bWJlciI6IjgyMzkiLCJPcmlnaW4iOiJBTVMiLCJEZXN0aW5hdGlvbiI6IkNERyIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDE2OjI1OjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQxNzo0MDowMC4wMDArMDI6MDAiLCJGbGlnaHRUaW1lIjoiNzUiLCJEaXN0YW5jZSI6IjI0NyIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiNzM3IiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjZ8QzZ8RDZ8STZ8WjZ8Vzl8WTl8Qjl8TTl8VTl8Szl8SDl8TDl8UTB8VDl8RTB8TjB8UjB8VjB8WDAiLCJGbGlnaHREZXRhaWxfS2V5IjoieW5LeWhvbGxSdk8rdDN2S1Z2eG1GUT09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiMkYiLCJCb29raW5nQ29kZSI6IlQiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiK1dOWmdBNWpTbENyNlNKem4xUGcrdz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IitXTlpnQTVqU2xDcjZTSnpuMVBnK3c9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlR0RUtnekFNXC9CaTU5NlE2WGQ5YVdtV0RHVVE3aWlcLzdcLzg5WTJvSjRrQXZoanNzNTV3enhTQU9UdTZIRHJcL01MNUJzQWdkRjVId2xzclhtQzlUcEJ4QThrem43TDhrSEw2RWtscVhMYlhJM3pHQ2NRNGhENnBoVGdyT3pYNDRvdFQ2RkdGSnBmdXNUSGxMYzFrUGF6U3JzS0U3VFlINzBlS0pVPSIsIkZhcmVCYXNpcyI6IlQxV0FQV05MIn0seyJBaXJTZWdtZW50X0tleSI6InpOdXI3TVZ0VFcrciszcjJiZ25seEE9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJBRiIsIkZsaWdodE51bWJlciI6IjEzOTAiLCJPcmlnaW4iOiJDREciLCJEZXN0aW5hdGlvbiI6IklTVCIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDE4OjUwOjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQyMzoxNTowMC4wMDArMDM6MDAiLCJGbGlnaHRUaW1lIjoiMjA1IiwiRGlzdGFuY2UiOiIxMzk3IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMTkiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUyIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJKOXxDOXxEOXxJOXxaOXxPOXxXOXxTOXxBOXxZOXxCOXxNOXxVOXxLOXxIOXxMOXxROXxUOXxFOXxOMHxSMHxWMHxYMHxHMCIsIkZsaWdodERldGFpbF9LZXkiOiJJUGE1R1UxXC9SYzJxXC91dElXdzEra2c9PSIsIk9yaWdpblRlcm1pbmFsIjoiMkUiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiVCIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiIrV05aZ0E1alNsQ3I2U0p6bjFQZyt3PT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiK1dOWmdBNWpTbENyNlNKem4xUGcrdz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHRFS2d6QU1cL0JpNTk2UTZYZDlhV21XREdVUTdpaVwvN1wvODlZMm9KNGtBdmhqc3M1NXd6eFNBT1R1NkhEclwvTUw1QnNBZ2RGNUh3bHNyWG1DOVRwQnhBOGt6bjdMOGtITDZFa2xxWExiWEkzekdDY1E0aEQ2cGhUZ3JPelg0NG90VDZGR0ZKcGZ1c1RIbExjMWtQYXpTcnNLRTdUWUg3MGVLSlU9IiwiRmFyZUJhc2lzIjoiVDFXQVBXTkwifV0sIkZhcmVydWxlc3JlZl9LZXkiOltbIitXTlpnQTVqU2xDcjZTSnpuMVBnK3c9PSJdLFsiK1dOWmdBNWpTbENyNlNKem4xUGcrdz09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl0sWyIxRyJdXSwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOltbImd3cy1lSnhOVHRFS2d6QU1cL0JpNTk2UTZYZDlhV21XREdVUTdpaVwvN1wvODlZMm9KNGtBdmhqc3M1NXd6eFNBT1R1NkhEclwvTUw1QnNBZ2RGNUh3bHNyWG1DOVRwQnhBOGt6bjdMOGtITDZFa2xxWExiWEkzekdDY1E0aEQ2cGhUZ3JPelg0NG90VDZGR0ZKcGZ1c1RIbExjMWtQYXpTcnNLRTdUWUg3MGVLSlU9Il0sWyJnd3MtZUp4TlR0RUtnekFNXC9CaTU5NlE2WGQ5YVdtV0RHVVE3aWlcLzdcLzg5WTJvSjRrQXZoanNzNTV3enhTQU9UdTZIRHJcL01MNUJzQWdkRjVId2xzclhtQzlUcEJ4QThrem43TDhrSEw2RWtscVhMYlhJM3pHQ2NRNGhENnBoVGdyT3pYNDRvdFQ2RkdGSnBmdXNUSGxMYzFrUGF6U3JzS0U3VFlINzBlS0pVPSJdXX0=" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F232857" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        4:25 PM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        5:40 PM <br>
                        <span> Charles De Gaulle Intl Arpt CDG</span>
                      </li>
                      <li class="rfms_emirates">
                        Air France<br>
                        <span>AF-737</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>1h 15m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Charles De Gaulle Intl Arpt, | <strong>Layover:: 1h 10m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        6:50 PM <br>
                        <span>Charles De Gaulle Intl Arpt CDG</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        11:15 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        Air France<br>
                        <span>AF-319</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>3h 25m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 5h 50m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">232.85</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook7" id="F232857" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiUWMwK1l0bFFUS0M5ZWd0Z3E0WmRtZz09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjIzMi44NSIsIkJhc2VQcmljZSI6IjE4Mi4wMCIsIlRheGVzIjoiNTAuODUiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjIzMi44NSIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjE4Mi4wMCIsIlRheFByaWNlX0JyZWFrZG93biI6IjUwLjg1IiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiS0wiLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIxODIuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiNTAuODUiLCJUcmF2ZWxUaW1lIjoiUDBEVDVINTBNMFMiLCJBaXJTZWdtZW50X0tleSI6InpOdXI3TVZ0VFcrciszcjJiZ25seEE9PSIsInNlZ21lbnRzIjpbeyJBaXJTZWdtZW50X0tleSI6ImwxN2ZBa29oU0thZjhLUEkzb2lzR1E9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJBRiIsIkZsaWdodE51bWJlciI6IjgyMzkiLCJPcmlnaW4iOiJBTVMiLCJEZXN0aW5hdGlvbiI6IkNERyIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDE2OjI1OjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQxNzo0MDowMC4wMDArMDI6MDAiLCJGbGlnaHRUaW1lIjoiNzUiLCJEaXN0YW5jZSI6IjI0NyIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiNzM3IiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjZ8QzZ8RDZ8STZ8WjZ8Vzl8WTl8Qjl8TTl8VTl8Szl8SDl8TDl8UTB8VDl8RTB8TjB8UjB8VjB8WDAiLCJGbGlnaHREZXRhaWxfS2V5IjoieW5LeWhvbGxSdk8rdDN2S1Z2eG1GUT09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiMkYiLCJCb29raW5nQ29kZSI6IlQiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiK1dOWmdBNWpTbENyNlNKem4xUGcrdz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IitXTlpnQTVqU2xDcjZTSnpuMVBnK3c9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlR0RUtnekFNXC9CaTU5NlE2WGQ5YVdtV0RHVVE3aWlcLzdcLzg5WTJvSjRrQXZoanNzNTV3enhTQU9UdTZIRHJcL01MNUJzQWdkRjVId2xzclhtQzlUcEJ4QThrem43TDhrSEw2RWtscVhMYlhJM3pHQ2NRNGhENnBoVGdyT3pYNDRvdFQ2RkdGSnBmdXNUSGxMYzFrUGF6U3JzS0U3VFlINzBlS0pVPSIsIkZhcmVCYXNpcyI6IlQxV0FQV05MIn0seyJBaXJTZWdtZW50X0tleSI6InpOdXI3TVZ0VFcrciszcjJiZ25seEE9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJBRiIsIkZsaWdodE51bWJlciI6IjEzOTAiLCJPcmlnaW4iOiJDREciLCJEZXN0aW5hdGlvbiI6IklTVCIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDE4OjUwOjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQyMzoxNTowMC4wMDArMDM6MDAiLCJGbGlnaHRUaW1lIjoiMjA1IiwiRGlzdGFuY2UiOiIxMzk3IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMTkiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUyIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJKOXxDOXxEOXxJOXxaOXxPOXxXOXxTOXxBOXxZOXxCOXxNOXxVOXxLOXxIOXxMOXxROXxUOXxFOXxOMHxSMHxWMHxYMHxHMCIsIkZsaWdodERldGFpbF9LZXkiOiJJUGE1R1UxXC9SYzJxXC91dElXdzEra2c9PSIsIk9yaWdpblRlcm1pbmFsIjoiMkUiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiVCIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiIrV05aZ0E1alNsQ3I2U0p6bjFQZyt3PT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiK1dOWmdBNWpTbENyNlNKem4xUGcrdz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHRFS2d6QU1cL0JpNTk2UTZYZDlhV21XREdVUTdpaVwvN1wvODlZMm9KNGtBdmhqc3M1NXd6eFNBT1R1NkhEclwvTUw1QnNBZ2RGNUh3bHNyWG1DOVRwQnhBOGt6bjdMOGtITDZFa2xxWExiWEkzekdDY1E0aEQ2cGhUZ3JPelg0NG90VDZGR0ZKcGZ1c1RIbExjMWtQYXpTcnNLRTdUWUg3MGVLSlU9IiwiRmFyZUJhc2lzIjoiVDFXQVBXTkwifV0sIkZhcmVydWxlc3JlZl9LZXkiOltbIitXTlpnQTVqU2xDcjZTSnpuMVBnK3c9PSJdLFsiK1dOWmdBNWpTbENyNlNKem4xUGcrdz09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl0sWyIxRyJdXSwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOltbImd3cy1lSnhOVHRFS2d6QU1cL0JpNTk2UTZYZDlhV21XREdVUTdpaVwvN1wvODlZMm9KNGtBdmhqc3M1NXd6eFNBT1R1NkhEclwvTUw1QnNBZ2RGNUh3bHNyWG1DOVRwQnhBOGt6bjdMOGtITDZFa2xxWExiWEkzekdDY1E0aEQ2cGhUZ3JPelg0NG90VDZGR0ZKcGZ1c1RIbExjMWtQYXpTcnNLRTdUWUg3MGVLSlU9Il0sWyJnd3MtZUp4TlR0RUtnekFNXC9CaTU5NlE2WGQ5YVdtV0RHVVE3aWlcLzdcLzg5WTJvSjRrQXZoanNzNTV3enhTQU9UdTZIRHJcL01MNUJzQWdkRjVId2xzclhtQzlUcEJ4QThrem43TDhrSEw2RWtscVhMYlhJM3pHQ2NRNGhENnBoVGdyT3pYNDRvdFQ2RkdGSnBmdXNUSGxMYzFrUGF6U3JzS0U3VFlINzBlS0pVPSJdXX0=" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F232857" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid01238" data-airline="Air France" data-arrive="680" data-duration="365" data-stops="1" data-depature="315" data-airlinecode="AF" data-price="232.85" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF232858" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/AF.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>07:15 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>14:20 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">6h 5m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse8" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="IitXTlpnQTVqU2xDcjZTSnpuMVBnK3c9PXxLS3wxR3xLS3xnd3MtZUp4TlR0RUtnekFNXC9CaTU5NlE2WGQ5YVdtV0RHVVE3aWlcLzdcLzg5WTJvSjRrQXZoanNzNTV3enhTQU9UdTZIRHJcL01MNUJzQWdkRjVId2xzclhtQzlUcEJ4QThrem43TDhrSEw2RWtscVhMYlhJM3pHQ2NRNGhENnBoVGdyT3pYNDRvdFQ2RkdGSnBmdXNUSGxMYzFrUGF6U3JzS0U3VFlINzBlS0pVPXxLS3x8VlZ8fEB8MSI=" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">232.85</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook8" id="F232858" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiMzZXUUsxTUlRQUtvdkE5TDcrcDBVUT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjIzMi44NSIsIkJhc2VQcmljZSI6IjE4Mi4wMCIsIlRheGVzIjoiNTAuODUiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjIzMi44NSIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjE4Mi4wMCIsIlRheFByaWNlX0JyZWFrZG93biI6IjUwLjg1IiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiS0wiLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIxODIuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiNTAuODUiLCJUcmF2ZWxUaW1lIjoiUDBEVDZINU0wUyIsIkFpclNlZ21lbnRfS2V5IjoiUDluQTlzMzBUdVN1VTloU0hZVnZYQT09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoiUWZhczB4ZlNUbU9IaHNkVFZqS1Bjdz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IkFGIiwiRmxpZ2h0TnVtYmVyIjoiODIyNyIsIk9yaWdpbiI6IkFNUyIsIkRlc3RpbmF0aW9uIjoiQ0RHIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMDc6MTU6MDAuMDAwKzAyOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA0LTMwVDA4OjQwOjAwLjAwMCswMjowMCIsIkZsaWdodFRpbWUiOiI4NSIsIkRpc3RhbmNlIjoiMjQ3IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiI3M1ciLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUyIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJKNXxDNXxENXxJNXxaMHxXOXxZOXxCOXxNOXxVOXxLOXxIOXxMOXxRMHxUOHxFMHxOMHxSMHxWMHxYMCIsIkZsaWdodERldGFpbF9LZXkiOiIzXC9lUk1vOXRUVE8wbnNWVVpJVTFMdz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiMkYiLCJCb29raW5nQ29kZSI6IlQiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiK1dOWmdBNWpTbENyNlNKem4xUGcrdz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IitXTlpnQTVqU2xDcjZTSnpuMVBnK3c9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlR0RUtnekFNXC9CaTU5NlE2WGQ5YVdtV0RHVVE3aWlcLzdcLzg5WTJvSjRrQXZoanNzNTV3enhTQU9UdTZIRHJcL01MNUJzQWdkRjVId2xzclhtQzlUcEJ4QThrem43TDhrSEw2RWtscVhMYlhJM3pHQ2NRNGhENnBoVGdyT3pYNDRvdFQ2RkdGSnBmdXNUSGxMYzFrUGF6U3JzS0U3VFlINzBlS0pVPSIsIkZhcmVCYXNpcyI6IlQxV0FQV05MIn0seyJBaXJTZWdtZW50X0tleSI6IlA5bkE5czMwVHVTdVU5aFNIWVZ2WEE9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJBRiIsIkZsaWdodE51bWJlciI6IjE1OTAiLCJPcmlnaW4iOiJDREciLCJEZXN0aW5hdGlvbiI6IklTVCIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDEwOjAwOjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQxNDoyMDowMC4wMDArMDM6MDAiLCJGbGlnaHRUaW1lIjoiMjAwIiwiRGlzdGFuY2UiOiIxMzk3IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMTkiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUyIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJKOXxDOXxEOXxJOXxaMHxPMHxXOXxTOXxBOXxZOXxCOXxNOXxVOXxLOXxIOXxMOXxROXxUOXxFNXxOMHxSMHxWMHxYMHxHMCIsIkZsaWdodERldGFpbF9LZXkiOiJHQkthaFpNN1FmMkp6RG1OZjYxMG1BPT0iLCJPcmlnaW5UZXJtaW5hbCI6IjJFIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkkiLCJCb29raW5nQ29kZSI6IlQiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiK1dOWmdBNWpTbENyNlNKem4xUGcrdz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IitXTlpnQTVqU2xDcjZTSnpuMVBnK3c9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlR0RUtnekFNXC9CaTU5NlE2WGQ5YVdtV0RHVVE3aWlcLzdcLzg5WTJvSjRrQXZoanNzNTV3enhTQU9UdTZIRHJcL01MNUJzQWdkRjVId2xzclhtQzlUcEJ4QThrem43TDhrSEw2RWtscVhMYlhJM3pHQ2NRNGhENnBoVGdyT3pYNDRvdFQ2RkdGSnBmdXNUSGxMYzFrUGF6U3JzS0U3VFlINzBlS0pVPSIsIkZhcmVCYXNpcyI6IlQxV0FQV05MIn1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyIrV05aZ0E1alNsQ3I2U0p6bjFQZyt3PT0iXSxbIitXTlpnQTVqU2xDcjZTSnpuMVBnK3c9PSJdXSwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjpbWyIxRyJdLFsiMUciXV0sIkZhcmVydWxlc3JlZl9jb250ZW50IjpbWyJnd3MtZUp4TlR0RUtnekFNXC9CaTU5NlE2WGQ5YVdtV0RHVVE3aWlcLzdcLzg5WTJvSjRrQXZoanNzNTV3enhTQU9UdTZIRHJcL01MNUJzQWdkRjVId2xzclhtQzlUcEJ4QThrem43TDhrSEw2RWtscVhMYlhJM3pHQ2NRNGhENnBoVGdyT3pYNDRvdFQ2RkdGSnBmdXNUSGxMYzFrUGF6U3JzS0U3VFlINzBlS0pVPSJdLFsiZ3dzLWVKeE5UdEVLZ3pBTVwvQmk1OTZRNlhkOWFXbVdER1VRN2lpXC83XC84OVkyb0o0a0F2aGpzczU1d3p4U0FPVHU2SERyXC9NTDVCc0FnZEY1SHdsc3JYbUM5VHBCeEE4a3puN0w4a0hMNkVrbHFYTGJYSTN6R0NjUTRoRDZwaFRnck96WDQ0b3RUNkZHRkpwZnVzVEhsTGMxa1BhelNyc0tFN1RZSDcwZUtKVT0iXV19" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F232858" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse8" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        7:15 AM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        8:40 AM <br>
                        <span> Charles De Gaulle Intl Arpt CDG</span>
                      </li>
                      <li class="rfms_emirates">
                        Air France<br>
                        <span>AF-73W</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>1h 25m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Charles De Gaulle Intl Arpt, | <strong>Layover:: 1h 20m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        10:00 AM <br>
                        <span>Charles De Gaulle Intl Arpt CDG</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        2:20 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        Air France<br>
                        <span>AF-319</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>3h 20m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 6h 5m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">232.85</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook8" id="F232858" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiMzZXUUsxTUlRQUtvdkE5TDcrcDBVUT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjIzMi44NSIsIkJhc2VQcmljZSI6IjE4Mi4wMCIsIlRheGVzIjoiNTAuODUiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjIzMi44NSIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjE4Mi4wMCIsIlRheFByaWNlX0JyZWFrZG93biI6IjUwLjg1IiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiS0wiLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIxODIuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiNTAuODUiLCJUcmF2ZWxUaW1lIjoiUDBEVDZINU0wUyIsIkFpclNlZ21lbnRfS2V5IjoiUDluQTlzMzBUdVN1VTloU0hZVnZYQT09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoiUWZhczB4ZlNUbU9IaHNkVFZqS1Bjdz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IkFGIiwiRmxpZ2h0TnVtYmVyIjoiODIyNyIsIk9yaWdpbiI6IkFNUyIsIkRlc3RpbmF0aW9uIjoiQ0RHIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMDc6MTU6MDAuMDAwKzAyOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA0LTMwVDA4OjQwOjAwLjAwMCswMjowMCIsIkZsaWdodFRpbWUiOiI4NSIsIkRpc3RhbmNlIjoiMjQ3IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiI3M1ciLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUyIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJKNXxDNXxENXxJNXxaMHxXOXxZOXxCOXxNOXxVOXxLOXxIOXxMOXxRMHxUOHxFMHxOMHxSMHxWMHxYMCIsIkZsaWdodERldGFpbF9LZXkiOiIzXC9lUk1vOXRUVE8wbnNWVVpJVTFMdz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiMkYiLCJCb29raW5nQ29kZSI6IlQiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiK1dOWmdBNWpTbENyNlNKem4xUGcrdz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IitXTlpnQTVqU2xDcjZTSnpuMVBnK3c9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlR0RUtnekFNXC9CaTU5NlE2WGQ5YVdtV0RHVVE3aWlcLzdcLzg5WTJvSjRrQXZoanNzNTV3enhTQU9UdTZIRHJcL01MNUJzQWdkRjVId2xzclhtQzlUcEJ4QThrem43TDhrSEw2RWtscVhMYlhJM3pHQ2NRNGhENnBoVGdyT3pYNDRvdFQ2RkdGSnBmdXNUSGxMYzFrUGF6U3JzS0U3VFlINzBlS0pVPSIsIkZhcmVCYXNpcyI6IlQxV0FQV05MIn0seyJBaXJTZWdtZW50X0tleSI6IlA5bkE5czMwVHVTdVU5aFNIWVZ2WEE9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJBRiIsIkZsaWdodE51bWJlciI6IjE1OTAiLCJPcmlnaW4iOiJDREciLCJEZXN0aW5hdGlvbiI6IklTVCIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDEwOjAwOjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQxNDoyMDowMC4wMDArMDM6MDAiLCJGbGlnaHRUaW1lIjoiMjAwIiwiRGlzdGFuY2UiOiIxMzk3IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMTkiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUyIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJKOXxDOXxEOXxJOXxaMHxPMHxXOXxTOXxBOXxZOXxCOXxNOXxVOXxLOXxIOXxMOXxROXxUOXxFNXxOMHxSMHxWMHxYMHxHMCIsIkZsaWdodERldGFpbF9LZXkiOiJHQkthaFpNN1FmMkp6RG1OZjYxMG1BPT0iLCJPcmlnaW5UZXJtaW5hbCI6IjJFIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkkiLCJCb29raW5nQ29kZSI6IlQiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiK1dOWmdBNWpTbENyNlNKem4xUGcrdz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IitXTlpnQTVqU2xDcjZTSnpuMVBnK3c9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlR0RUtnekFNXC9CaTU5NlE2WGQ5YVdtV0RHVVE3aWlcLzdcLzg5WTJvSjRrQXZoanNzNTV3enhTQU9UdTZIRHJcL01MNUJzQWdkRjVId2xzclhtQzlUcEJ4QThrem43TDhrSEw2RWtscVhMYlhJM3pHQ2NRNGhENnBoVGdyT3pYNDRvdFQ2RkdGSnBmdXNUSGxMYzFrUGF6U3JzS0U3VFlINzBlS0pVPSIsIkZhcmVCYXNpcyI6IlQxV0FQV05MIn1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyIrV05aZ0E1alNsQ3I2U0p6bjFQZyt3PT0iXSxbIitXTlpnQTVqU2xDcjZTSnpuMVBnK3c9PSJdXSwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjpbWyIxRyJdLFsiMUciXV0sIkZhcmVydWxlc3JlZl9jb250ZW50IjpbWyJnd3MtZUp4TlR0RUtnekFNXC9CaTU5NlE2WGQ5YVdtV0RHVVE3aWlcLzdcLzg5WTJvSjRrQXZoanNzNTV3enhTQU9UdTZIRHJcL01MNUJzQWdkRjVId2xzclhtQzlUcEJ4QThrem43TDhrSEw2RWtscVhMYlhJM3pHQ2NRNGhENnBoVGdyT3pYNDRvdFQ2RkdGSnBmdXNUSGxMYzFrUGF6U3JzS0U3VFlINzBlS0pVPSJdLFsiZ3dzLWVKeE5UdEVLZ3pBTVwvQmk1OTZRNlhkOWFXbVdER1VRN2lpXC83XC84OVkyb0o0a0F2aGpzczU1d3p4U0FPVHU2SERyXC9NTDVCc0FnZEY1SHdsc3JYbUM5VHBCeEE4a3puN0w4a0hMNkVrbHFYTGJYSTN6R0NjUTRoRDZwaFRnck96WDQ0b3RUNkZHRkpwZnVzVEhsTGMxa1BhelNyc0tFN1RZSDcwZUtKVT0iXV19" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F232858" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid01239" data-airline="Turkish Airlines" data-arrive="825" data-duration="215" data-stops="0" data-depature="610" data-airlinecode="TK" data-price="247.03" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF247039" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/TK.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>12:10 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (SAW)</span><br>
            <div class="fsa_departure"><small>16:45 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">3h 35m</span><br>
            <span class="fsa_departure">NON STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse9" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="InRtQTZnSW10VFc2WDJIN05SblZ4SlE9PXxLS3wxR3xLS3xnd3MtZUp4TlRrRUt3ekFNZTB6UjNmYTZacmtsTElGQ2FWYVdqaXlYXC9mOFpjeElZRTFqQ1NNaDJ6Z254UWpPVCs4T0V6M1J1U0s4N2tDQTYyUmV3dFhJRDYxWkJ4RmZFS3VcL2prUXRHeDRYVVN0MGV5ajBZVExBZ1JJbkxjQnBRT1wvczlcLzJyYlVXZ1FqZUtxa253NGoyY3VSTE1RaVZuVk1OREh2dFI5S09FPXxLS3x8VlZ8fEB8MSI=" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">247.03</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook9" id="F247039" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoibjlSRmEzVDBUVG1BKzNTQ1hjMWI5QT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IiIsIlRvdGFsUHJpY2UiOiIyNDcuMDMiLCJCYXNlUHJpY2UiOiIxODIuMDAiLCJUYXhlcyI6IjY1LjAzIiwiVG90YWxQcmljZV9BUEkiOiJFVVIyNDcuMDMiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIxODIuMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiI2NS4wMyIsIlJlZnVuZGFibGUiOmZhbHNlLCJQbGF0aW5nQ2FycmllciI6IlRLIiwiRmFyZVR5cGUiOiJOb24gUmVmdW5kYWJsZSIsIkFsbF9QYXNzZW5nZXIiOiJBRFQiLCJBZHVsdHMiOjEsIkFkdWx0c19CYXNlX1ByaWNlIjoiMTgyLjAwIiwiQWR1bHRzX1RheF9QcmljZSI6IjY1LjAzIiwiVHJhdmVsVGltZSI6IlAwRFQzSDM1TTBTIiwiQWlyU2VnbWVudF9LZXkiOiJTK3Y1dkZkWVJuaWk0NXZ4bWRaZmhBPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiJTK3Y1dkZkWVJuaWk0NXZ4bWRaZmhBPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiVEsiLCJGbGlnaHROdW1iZXIiOiIxOTYyIiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJTQVciLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxMjoxMDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTY6NDU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjIxNSIsIkRpc3RhbmNlIjoiMTM4NCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiNzM4IiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJDYWNoZWQgc3RhdHVzIHVzZWQuIFBvbGxlZCBhdmFpbCBleGlzdHMiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiQzR8RDR8SzR8SjR8STR8UjB8WTl8Qjl8TTl8SDl8Uzl8RTl8UTB8VDB8TDB8VjB8UDB8VzB8WDB8TjB8RzAiLCJGbGlnaHREZXRhaWxfS2V5Ijoick1HajVSU0pURWFIV25Dd0gzSkhKUT09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiIiwiQm9va2luZ0NvZGUiOiJFIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6InRtQTZnSW10VFc2WDJIN05SblZ4SlE9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJ0bUE2Z0ltdFRXNlgySDdOUm5WeEpRPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Ua0VLd3pBTWUwelIzZmE2WnJrbExJRkNhVmFXaml5WFwvZjhaY3hJWUUxakNTTWgyemdueFFqT1QrOE9FejNSdVNLODdrQ0E2MlJld3RYSUQ2MVpCeEZmRUt1XC9qa1F0R3g0WFVTdDBleWowWVRMQWdSSW5MY0JwUU9cL3M5XC8ycmJVV2dRamVLcWtudzRqMmN1UkxNUWlWblZNTkRIdnRSOUtPRT0iLCJGYXJlQmFzaXMiOiJFWTJYUE9TVyJ9XSwiRmFyZXJ1bGVzcmVmX0tleSI6W1sidG1BNmdJbXRUVzZYMkg3TlJuVnhKUT09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5Ua0VLd3pBTWUwelIzZmE2WnJrbExJRkNhVmFXaml5WFwvZjhaY3hJWUUxakNTTWgyemdueFFqT1QrOE9FejNSdVNLODdrQ0E2MlJld3RYSUQ2MVpCeEZmRUt1XC9qa1F0R3g0WFVTdDBleWowWVRMQWdSSW5MY0JwUU9cL3M5XC8ycmJVV2dRamVLcWtudzRqMmN1UkxNUWlWblZNTkRIdnRSOUtPRT0iXV19" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F247039" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse9" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        12:10 PM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        4:45 PM <br>
                        <span> Sabiha Gokcen Arpt SAW</span>
                      </li>
                      <li class="rfms_emirates">
                        Turkish Airlines<br>
                        <span>TK-738</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>3h 35m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 3h 35m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">247.03</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook9" id="F247039" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoibjlSRmEzVDBUVG1BKzNTQ1hjMWI5QT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IiIsIlRvdGFsUHJpY2UiOiIyNDcuMDMiLCJCYXNlUHJpY2UiOiIxODIuMDAiLCJUYXhlcyI6IjY1LjAzIiwiVG90YWxQcmljZV9BUEkiOiJFVVIyNDcuMDMiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIxODIuMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiI2NS4wMyIsIlJlZnVuZGFibGUiOmZhbHNlLCJQbGF0aW5nQ2FycmllciI6IlRLIiwiRmFyZVR5cGUiOiJOb24gUmVmdW5kYWJsZSIsIkFsbF9QYXNzZW5nZXIiOiJBRFQiLCJBZHVsdHMiOjEsIkFkdWx0c19CYXNlX1ByaWNlIjoiMTgyLjAwIiwiQWR1bHRzX1RheF9QcmljZSI6IjY1LjAzIiwiVHJhdmVsVGltZSI6IlAwRFQzSDM1TTBTIiwiQWlyU2VnbWVudF9LZXkiOiJTK3Y1dkZkWVJuaWk0NXZ4bWRaZmhBPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiJTK3Y1dkZkWVJuaWk0NXZ4bWRaZmhBPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiVEsiLCJGbGlnaHROdW1iZXIiOiIxOTYyIiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJTQVciLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxMjoxMDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTY6NDU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjIxNSIsIkRpc3RhbmNlIjoiMTM4NCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiNzM4IiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJDYWNoZWQgc3RhdHVzIHVzZWQuIFBvbGxlZCBhdmFpbCBleGlzdHMiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiQzR8RDR8SzR8SjR8STR8UjB8WTl8Qjl8TTl8SDl8Uzl8RTl8UTB8VDB8TDB8VjB8UDB8VzB8WDB8TjB8RzAiLCJGbGlnaHREZXRhaWxfS2V5Ijoick1HajVSU0pURWFIV25Dd0gzSkhKUT09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiIiwiQm9va2luZ0NvZGUiOiJFIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6InRtQTZnSW10VFc2WDJIN05SblZ4SlE9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJ0bUE2Z0ltdFRXNlgySDdOUm5WeEpRPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Ua0VLd3pBTWUwelIzZmE2WnJrbExJRkNhVmFXaml5WFwvZjhaY3hJWUUxakNTTWgyemdueFFqT1QrOE9FejNSdVNLODdrQ0E2MlJld3RYSUQ2MVpCeEZmRUt1XC9qa1F0R3g0WFVTdDBleWowWVRMQWdSSW5MY0JwUU9cL3M5XC8ycmJVV2dRamVLcWtudzRqMmN1UkxNUWlWblZNTkRIdnRSOUtPRT0iLCJGYXJlQmFzaXMiOiJFWTJYUE9TVyJ9XSwiRmFyZXJ1bGVzcmVmX0tleSI6W1sidG1BNmdJbXRUVzZYMkg3TlJuVnhKUT09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5Ua0VLd3pBTWUwelIzZmE2WnJrbExJRkNhVmFXaml5WFwvZjhaY3hJWUUxakNTTWgyemdueFFqT1QrOE9FejNSdVNLODdrQ0E2MlJld3RYSUQ2MVpCeEZmRUt1XC9qa1F0R3g0WFVTdDBleWowWVRMQWdSSW5MY0JwUU9cL3M5XC8ycmJVV2dRamVLcWtudzRqMmN1UkxNUWlWblZNTkRIdnRSOUtPRT0iXV19" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F247039" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012310" data-airline="Turkish Airlines" data-arrive="35" data-duration="205" data-stops="0" data-depature="1270" data-airlinecode="TK" data-price="260.03" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF2600310" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/TK.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>23:10 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>03:35 (01 May, Sun 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">3h 25m</span><br>
            <span class="fsa_departure">NON STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse10" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="Im9Oc2JEeUpBUTBtemozXC81WnNoQnVnPT18S0t8MUd8S0t8Z3dzLWVKeE5Ua0VLd3pBTWUwelJYWGJhNVpxeXBuU01aWVZtckxuc1wvOCtZazhDWXdCSkdRbllJUVNrWGpzTHdod0dmSWQrUlhsY2dRVzF1UjRhS214UmlXd0VwRTJMUlwvWHkrMFNzY3pVbk43U290dFwvam9RVVMzU25jcVVCclBqK1BYV21cL0NncWdVTjVNMEwza1wvczVDamt1bzNNenpzcnkrVG15aFF8S0t8fFZWfHxAfDEi" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">260.03</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook10" id="F2600310" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiVHpBZWhaYUNUTEM0TTVzRGJkZFpqUT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IiIsIlRvdGFsUHJpY2UiOiIyNjAuMDMiLCJCYXNlUHJpY2UiOiIxOTUuMDAiLCJUYXhlcyI6IjY1LjAzIiwiVG90YWxQcmljZV9BUEkiOiJFVVIyNjAuMDMiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIxOTUuMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiI2NS4wMyIsIlJlZnVuZGFibGUiOmZhbHNlLCJQbGF0aW5nQ2FycmllciI6IlRLIiwiRmFyZVR5cGUiOiJOb24gUmVmdW5kYWJsZSIsIkFsbF9QYXNzZW5nZXIiOiJBRFQiLCJBZHVsdHMiOjEsIkFkdWx0c19CYXNlX1ByaWNlIjoiMTk1LjAwIiwiQWR1bHRzX1RheF9QcmljZSI6IjY1LjAzIiwiVHJhdmVsVGltZSI6IlAwRFQzSDI1TTBTIiwiQWlyU2VnbWVudF9LZXkiOiJ3dVpneU9KZFFleStHRGsxTmJRSzRBPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiJ3dVpneU9KZFFleStHRGsxTmJRSzRBPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiVEsiLCJGbGlnaHROdW1iZXIiOiIxOTU2IiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQyMzoxMDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDUtMDFUMDM6MzU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjIwNSIsIkRpc3RhbmNlIjoiMTM4NCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIxIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiQzR8RDR8SzR8SjR8STR8UjB8WTl8Qjl8TTl8SDl8Uzl8RTl8UTB8VDB8TDB8VjB8UDB8VzB8WDB8TjB8RzAiLCJGbGlnaHREZXRhaWxfS2V5IjoiYTl5OEFLWm5UbUc3dDZRRlpHdEtzUT09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiRSIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJvTnNiRHlKQVEwbXpqM1wvNVpzaEJ1Zz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6Im9Oc2JEeUpBUTBtemozXC81WnNoQnVnPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Ua0VLd3pBTWUwelJYWGJhNVpxeXBuU01aWVZtckxuc1wvOCtZazhDWXdCSkdRbllJUVNrWGpzTHdod0dmSWQrUlhsY2dRVzF1UjRhS214UmlXd0VwRTJMUlwvWHkrMFNzY3pVbk43U290dFwvam9RVVMzU25jcVVCclBqK1BYV21cL0NncWdVTjVNMEwza1wvczVDamt1bzNNenpzcnkrVG15aFEiLCJGYXJlQmFzaXMiOiJFWTJQWE9XIn1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJvTnNiRHlKQVEwbXpqM1wvNVpzaEJ1Zz09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5Ua0VLd3pBTWUwelJYWGJhNVpxeXBuU01aWVZtckxuc1wvOCtZazhDWXdCSkdRbllJUVNrWGpzTHdod0dmSWQrUlhsY2dRVzF1UjRhS214UmlXd0VwRTJMUlwvWHkrMFNzY3pVbk43U290dFwvam9RVVMzU25jcVVCclBqK1BYV21cL0NncWdVTjVNMEwza1wvczVDamt1bzNNenpzcnkrVG15aFEiXV19" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F2600310" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        11:10 PM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        3:35 AM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        Turkish Airlines<br>
                        <span>TK-321</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>3h 25m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 3h 25m</span><br>
                        Arrival:<span class="color_secondry"> Sunday 01 May</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">260.03</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook10" id="F2600310" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiVHpBZWhaYUNUTEM0TTVzRGJkZFpqUT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IiIsIlRvdGFsUHJpY2UiOiIyNjAuMDMiLCJCYXNlUHJpY2UiOiIxOTUuMDAiLCJUYXhlcyI6IjY1LjAzIiwiVG90YWxQcmljZV9BUEkiOiJFVVIyNjAuMDMiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIxOTUuMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiI2NS4wMyIsIlJlZnVuZGFibGUiOmZhbHNlLCJQbGF0aW5nQ2FycmllciI6IlRLIiwiRmFyZVR5cGUiOiJOb24gUmVmdW5kYWJsZSIsIkFsbF9QYXNzZW5nZXIiOiJBRFQiLCJBZHVsdHMiOjEsIkFkdWx0c19CYXNlX1ByaWNlIjoiMTk1LjAwIiwiQWR1bHRzX1RheF9QcmljZSI6IjY1LjAzIiwiVHJhdmVsVGltZSI6IlAwRFQzSDI1TTBTIiwiQWlyU2VnbWVudF9LZXkiOiJ3dVpneU9KZFFleStHRGsxTmJRSzRBPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiJ3dVpneU9KZFFleStHRGsxTmJRSzRBPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiVEsiLCJGbGlnaHROdW1iZXIiOiIxOTU2IiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQyMzoxMDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDUtMDFUMDM6MzU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjIwNSIsIkRpc3RhbmNlIjoiMTM4NCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIxIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiQzR8RDR8SzR8SjR8STR8UjB8WTl8Qjl8TTl8SDl8Uzl8RTl8UTB8VDB8TDB8VjB8UDB8VzB8WDB8TjB8RzAiLCJGbGlnaHREZXRhaWxfS2V5IjoiYTl5OEFLWm5UbUc3dDZRRlpHdEtzUT09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiRSIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJvTnNiRHlKQVEwbXpqM1wvNVpzaEJ1Zz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6Im9Oc2JEeUpBUTBtemozXC81WnNoQnVnPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Ua0VLd3pBTWUwelJYWGJhNVpxeXBuU01aWVZtckxuc1wvOCtZazhDWXdCSkdRbllJUVNrWGpzTHdod0dmSWQrUlhsY2dRVzF1UjRhS214UmlXd0VwRTJMUlwvWHkrMFNzY3pVbk43U290dFwvam9RVVMzU25jcVVCclBqK1BYV21cL0NncWdVTjVNMEwza1wvczVDamt1bzNNenpzcnkrVG15aFEiLCJGYXJlQmFzaXMiOiJFWTJQWE9XIn1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJvTnNiRHlKQVEwbXpqM1wvNVpzaEJ1Zz09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5Ua0VLd3pBTWUwelJYWGJhNVpxeXBuU01aWVZtckxuc1wvOCtZazhDWXdCSkdRbllJUVNrWGpzTHdod0dmSWQrUlhsY2dRVzF1UjRhS214UmlXd0VwRTJMUlwvWHkrMFNzY3pVbk43U290dFwvam9RVVMzU25jcVVCclBqK1BYV21cL0NncWdVTjVNMEwza1wvczVDamt1bzNNenpzcnkrVG15aFEiXV19" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F2600310" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012311" data-airline="Turkish Airlines" data-arrive="1265" data-duration="215" data-stops="0" data-depature="1050" data-airlinecode="TK" data-price="260.03" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF2600311" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/TK.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>19:30 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>00:05 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">3h 35m</span><br>
            <span class="fsa_departure">NON STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse11" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="Im9Oc2JEeUpBUTBtemozXC81WnNoQnVnPT18S0t8MUd8S0t8Z3dzLWVKeE5Ua0VLd3pBTWUwelJYWGJhNVpxeXBuU01aWVZtckxuc1wvOCtZazhDWXdCSkdRbllJUVNrWGpzTHdod0dmSWQrUlhsY2dRVzF1UjRhS214UmlXd0VwRTJMUlwvWHkrMFNzY3pVbk43U290dFwvam9RVVMzU25jcVVCclBqK1BYV21cL0NncWdVTjVNMEwza1wvczVDamt1bzNNenpzcnkrVG15aFF8S0t8fFZWfHxAfDEi" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">260.03</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook11" id="F2600311" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiTzhNT0N2WUNTc1NVbEtZdWxXdkRCUT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IiIsIlRvdGFsUHJpY2UiOiIyNjAuMDMiLCJCYXNlUHJpY2UiOiIxOTUuMDAiLCJUYXhlcyI6IjY1LjAzIiwiVG90YWxQcmljZV9BUEkiOiJFVVIyNjAuMDMiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIxOTUuMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiI2NS4wMyIsIlJlZnVuZGFibGUiOmZhbHNlLCJQbGF0aW5nQ2FycmllciI6IlRLIiwiRmFyZVR5cGUiOiJOb24gUmVmdW5kYWJsZSIsIkFsbF9QYXNzZW5nZXIiOiJBRFQiLCJBZHVsdHMiOjEsIkFkdWx0c19CYXNlX1ByaWNlIjoiMTk1LjAwIiwiQWR1bHRzX1RheF9QcmljZSI6IjY1LjAzIiwiVHJhdmVsVGltZSI6IlAwRFQzSDM1TTBTIiwiQWlyU2VnbWVudF9LZXkiOiJ0T2RwRVhKZFJkdWNHaHJyck8wT1NBPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiJ0T2RwRVhKZFJkdWNHaHJyck8wT1NBPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiVEsiLCJGbGlnaHROdW1iZXIiOiIxOTU0IiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxOTozMDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDUtMDFUMDA6MDU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjIxNSIsIkRpc3RhbmNlIjoiMTM4NCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzJCIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiQzR8RDR8SzR8SjN8STB8UjB8WTl8Qjl8TTl8SDl8Uzl8RTN8UTB8VDB8TDB8VjB8UDB8VzB8WDB8TjB8RzAiLCJGbGlnaHREZXRhaWxfS2V5IjoiQzhKMlBtWkxRRktVK0JhaVYwS1V3dz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiRSIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJvTnNiRHlKQVEwbXpqM1wvNVpzaEJ1Zz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6Im9Oc2JEeUpBUTBtemozXC81WnNoQnVnPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Ua0VLd3pBTWUwelJYWGJhNVpxeXBuU01aWVZtckxuc1wvOCtZazhDWXdCSkdRbllJUVNrWGpzTHdod0dmSWQrUlhsY2dRVzF1UjRhS214UmlXd0VwRTJMUlwvWHkrMFNzY3pVbk43U290dFwvam9RVVMzU25jcVVCclBqK1BYV21cL0NncWdVTjVNMEwza1wvczVDamt1bzNNenpzcnkrVG15aFEiLCJGYXJlQmFzaXMiOiJFWTJQWE9XIn1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJvTnNiRHlKQVEwbXpqM1wvNVpzaEJ1Zz09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5Ua0VLd3pBTWUwelJYWGJhNVpxeXBuU01aWVZtckxuc1wvOCtZazhDWXdCSkdRbllJUVNrWGpzTHdod0dmSWQrUlhsY2dRVzF1UjRhS214UmlXd0VwRTJMUlwvWHkrMFNzY3pVbk43U290dFwvam9RVVMzU25jcVVCclBqK1BYV21cL0NncWdVTjVNMEwza1wvczVDamt1bzNNenpzcnkrVG15aFEiXV19" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F2600311" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse11" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        7:30 PM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        12:05 AM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        Turkish Airlines<br>
                        <span>TK-32B</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>3h 35m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 3h 35m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">260.03</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook11" id="F2600311" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiTzhNT0N2WUNTc1NVbEtZdWxXdkRCUT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IiIsIlRvdGFsUHJpY2UiOiIyNjAuMDMiLCJCYXNlUHJpY2UiOiIxOTUuMDAiLCJUYXhlcyI6IjY1LjAzIiwiVG90YWxQcmljZV9BUEkiOiJFVVIyNjAuMDMiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIxOTUuMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiI2NS4wMyIsIlJlZnVuZGFibGUiOmZhbHNlLCJQbGF0aW5nQ2FycmllciI6IlRLIiwiRmFyZVR5cGUiOiJOb24gUmVmdW5kYWJsZSIsIkFsbF9QYXNzZW5nZXIiOiJBRFQiLCJBZHVsdHMiOjEsIkFkdWx0c19CYXNlX1ByaWNlIjoiMTk1LjAwIiwiQWR1bHRzX1RheF9QcmljZSI6IjY1LjAzIiwiVHJhdmVsVGltZSI6IlAwRFQzSDM1TTBTIiwiQWlyU2VnbWVudF9LZXkiOiJ0T2RwRVhKZFJkdWNHaHJyck8wT1NBPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiJ0T2RwRVhKZFJkdWNHaHJyck8wT1NBPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiVEsiLCJGbGlnaHROdW1iZXIiOiIxOTU0IiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxOTozMDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDUtMDFUMDA6MDU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjIxNSIsIkRpc3RhbmNlIjoiMTM4NCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzJCIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiQzR8RDR8SzR8SjN8STB8UjB8WTl8Qjl8TTl8SDl8Uzl8RTN8UTB8VDB8TDB8VjB8UDB8VzB8WDB8TjB8RzAiLCJGbGlnaHREZXRhaWxfS2V5IjoiQzhKMlBtWkxRRktVK0JhaVYwS1V3dz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiRSIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJvTnNiRHlKQVEwbXpqM1wvNVpzaEJ1Zz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6Im9Oc2JEeUpBUTBtemozXC81WnNoQnVnPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Ua0VLd3pBTWUwelJYWGJhNVpxeXBuU01aWVZtckxuc1wvOCtZazhDWXdCSkdRbllJUVNrWGpzTHdod0dmSWQrUlhsY2dRVzF1UjRhS214UmlXd0VwRTJMUlwvWHkrMFNzY3pVbk43U290dFwvam9RVVMzU25jcVVCclBqK1BYV21cL0NncWdVTjVNMEwza1wvczVDamt1bzNNenpzcnkrVG15aFEiLCJGYXJlQmFzaXMiOiJFWTJQWE9XIn1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJvTnNiRHlKQVEwbXpqM1wvNVpzaEJ1Zz09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5Ua0VLd3pBTWUwelJYWGJhNVpxeXBuU01aWVZtckxuc1wvOCtZazhDWXdCSkdRbllJUVNrWGpzTHdod0dmSWQrUlhsY2dRVzF1UjRhS214UmlXd0VwRTJMUlwvWHkrMFNzY3pVbk43U290dFwvam9RVVMzU25jcVVCclBqK1BYV21cL0NncWdVTjVNMEwza1wvczVDamt1bzNNenpzcnkrVG15aFEiXV19" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F2600311" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012312" data-airline="TAROM" data-arrive="880" data-duration="1285" data-stops="1" data-depature="1035" data-airlinecode="RO" data-price="267.35" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF2673512" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/RO.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>19:15 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>17:40 (01 May, Sun 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">21h 25m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse12" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="IlJZZjRaRHdnU0J5d25wekFWSlZJcWc9PXxLS3wxR3xLS3xnd3MtZUp4TlRzc0t3ekFNKzVpaXU1MFg2eTJsQ1d6UWViQzJoMTcyXC81OHhKYmxVNEpja2JPZWNuV2lTb0pKdm1QQ2J2aFwvWXVRSUd4M2p0QjV3KzVobks2WUtJUm15MjFSTmpnUmZ5MXJWUnRidEtMQjZDTmRZd2xBWmNQU1wvdkhjNDdWWHJiUmRCSWFCQkJmYkt6cFJ6dGhBZ3BrcG9TRVwvalpIOU1DS0cwPXxLS3x8VlZ8fEB8MSI=" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">267.35</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook12" id="F2673512" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoibXBPbUd2SmNSRisrOFR1QmRXSlwvVkE9PSIsIkNvbXBsZXRlSXRpbmVyYXJ5IjoiIiwiQ29ubmVjdGlvbnMiOiIwLCIsIlRvdGFsUHJpY2UiOiIyNjcuMzUiLCJCYXNlUHJpY2UiOiIyMTIuMDAiLCJUYXhlcyI6IjU1LjM1IiwiVG90YWxQcmljZV9BUEkiOiJFVVIyNjcuMzUiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIyMTIuMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiI1NS4zNSIsIlJlZnVuZGFibGUiOiJ0cnVlIiwiUGxhdGluZ0NhcnJpZXIiOiJSTyIsIkZhcmVUeXBlIjoiUmVmdW5kYWJsZSIsIkFsbF9QYXNzZW5nZXIiOiJBRFQiLCJBZHVsdHMiOjEsIkFkdWx0c19CYXNlX1ByaWNlIjoiMjEyLjAwIiwiQWR1bHRzX1RheF9QcmljZSI6IjU1LjM1IiwiVHJhdmVsVGltZSI6IlAwRFQyMUgyNU0wUyIsIkFpclNlZ21lbnRfS2V5IjoiMVFXMlZxeGRRdmFuQnRhREdoYStFQT09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoibzZGdGI2NG1TSGU4cTV4dnVkMDdLUT09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlJPIiwiRmxpZ2h0TnVtYmVyIjoiMzY0IiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJPVFAiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxOToxNTowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMjM6MDA6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjE2NSIsIkRpc3RhbmNlIjoiMTExMCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiNzMzIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjB8Qzd8RDV8STF8WTZ8QjF8TTF8VTF8SzB8UjB8SDB8RzB8TDF8UTB8TjB8VDB8VjB8UzB8RTB8VzAiLCJGbGlnaHREZXRhaWxfS2V5IjoiM3V0a3ptMlZUN21EK3ArZVV3V3lKZz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiIiwiQm9va2luZ0NvZGUiOiJMIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6IlJZZjRaRHdnU0J5d25wekFWSlZJcWc9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJSWWY0WkR3Z1NCeXducHpBVkpWSXFnPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Uc3NLd3pBTSs1aWl1NTBYNnkybENXelFlYkMyaDE3MlwvNTh4SmJsVTRKY2tiT2VjbldpU29KSnZtUENidmhcL1l1UUlHeDNqdEI1dys1aG5LNllLSVJteTIxUk5qZ1JmeTFyVlJ0YnRLTEI2Q05kWXdsQVpjUFNcL3ZIYzQ3VlhyYlJkQklhQkJCZmJLenBSenRoQWdwa3BvU0VcL2paSDlNQ0tHMD0iLCJGYXJlQmFzaXMiOiJMTkxFVSJ9LHsiQWlyU2VnbWVudF9LZXkiOiIxUVcyVnF4ZFF2YW5CdGFER2hhK0VBPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiUk8iLCJGbGlnaHROdW1iZXIiOiIyNjMiLCJPcmlnaW4iOiJPVFAiLCJEZXN0aW5hdGlvbiI6IklTVCIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA1LTAxVDE2OjI1OjAwLjAwMCswMzowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNS0wMVQxNzo0MDowMC4wMDArMDM6MDAiLCJGbGlnaHRUaW1lIjoiNzUiLCJEaXN0YW5jZSI6IjI5MCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIwIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjl8Qzh8RDZ8STF8WTl8Qjl8TTl8VTl8Szl8Ujl8SDl8RzB8TDV8UTR8TjJ8VDl8Vjl8UzB8RTB8VzEiLCJGbGlnaHREZXRhaWxfS2V5IjoiSlhCVFRhdzRTT21iTkJvVlFUVW85dz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiTCIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJSWWY0WkR3Z1NCeXducHpBVkpWSXFnPT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiUllmNFpEd2dTQnl3bnB6QVZKVklxZz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHNzS3d6QU0rNWlpdTUwWDZ5MmxDV3pRZWJDMmgxNzJcLzU4eEpibFU0SmNrYk9lY25XaVNvSkp2bVBDYnZoXC9ZdVFJR3gzanRCNXcrNWhuSzZZS0lSbXkyMVJOamdSZnkxclZSdGJ0S0xCNkNOZFl3bEFaY1BTXC92SGM0N1ZYcmJSZEJJYUJCQmZiS3pwUnp0aEFncGtwb1NFXC9qWkg5TUNLRzA9IiwiRmFyZUJhc2lzIjoiTE5MRVUifV0sIkZhcmVydWxlc3JlZl9LZXkiOltbIlJZZjRaRHdnU0J5d25wekFWSlZJcWc9PSJdLFsiUllmNFpEd2dTQnl3bnB6QVZKVklxZz09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl0sWyIxRyJdXSwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOltbImd3cy1lSnhOVHNzS3d6QU0rNWlpdTUwWDZ5MmxDV3pRZWJDMmgxNzJcLzU4eEpibFU0SmNrYk9lY25XaVNvSkp2bVBDYnZoXC9ZdVFJR3gzanRCNXcrNWhuSzZZS0lSbXkyMVJOamdSZnkxclZSdGJ0S0xCNkNOZFl3bEFaY1BTXC92SGM0N1ZYcmJSZEJJYUJCQmZiS3pwUnp0aEFncGtwb1NFXC9qWkg5TUNLRzA9Il0sWyJnd3MtZUp4TlRzc0t3ekFNKzVpaXU1MFg2eTJsQ1d6UWViQzJoMTcyXC81OHhKYmxVNEpja2JPZWNuV2lTb0pKdm1QQ2J2aFwvWXVRSUd4M2p0QjV3KzVobks2WUtJUm15MjFSTmpnUmZ5MXJWUnRidEtMQjZDTmRZd2xBWmNQU1wvdkhjNDdWWHJiUmRCSWFCQkJmYkt6cFJ6dGhBZ3BrcG9TRVwvalpIOU1DS0cwPSJdXX0=" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F2673512" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse12" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        7:15 PM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        11:00 PM <br>
                        <span> Henri Coanda Arpt OTP</span>
                      </li>
                      <li class="rfms_emirates">
                        TAROM<br>
                        <span>RO-733</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>2h 45m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Henri Coanda Arpt, | <strong>Layover:: 17h 25m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        4:25 PM <br>
                        <span>Henri Coanda Arpt OTP</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        5:40 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        TAROM<br>
                        <span>RO-320</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>1h 15m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 21h 25m</span><br>
                        Arrival:<span class="color_secondry"> Sunday 01 May</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">267.35</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook12" id="F2673512" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoibXBPbUd2SmNSRisrOFR1QmRXSlwvVkE9PSIsIkNvbXBsZXRlSXRpbmVyYXJ5IjoiIiwiQ29ubmVjdGlvbnMiOiIwLCIsIlRvdGFsUHJpY2UiOiIyNjcuMzUiLCJCYXNlUHJpY2UiOiIyMTIuMDAiLCJUYXhlcyI6IjU1LjM1IiwiVG90YWxQcmljZV9BUEkiOiJFVVIyNjcuMzUiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIyMTIuMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiI1NS4zNSIsIlJlZnVuZGFibGUiOiJ0cnVlIiwiUGxhdGluZ0NhcnJpZXIiOiJSTyIsIkZhcmVUeXBlIjoiUmVmdW5kYWJsZSIsIkFsbF9QYXNzZW5nZXIiOiJBRFQiLCJBZHVsdHMiOjEsIkFkdWx0c19CYXNlX1ByaWNlIjoiMjEyLjAwIiwiQWR1bHRzX1RheF9QcmljZSI6IjU1LjM1IiwiVHJhdmVsVGltZSI6IlAwRFQyMUgyNU0wUyIsIkFpclNlZ21lbnRfS2V5IjoiMVFXMlZxeGRRdmFuQnRhREdoYStFQT09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoibzZGdGI2NG1TSGU4cTV4dnVkMDdLUT09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlJPIiwiRmxpZ2h0TnVtYmVyIjoiMzY0IiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJPVFAiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxOToxNTowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMjM6MDA6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjE2NSIsIkRpc3RhbmNlIjoiMTExMCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiNzMzIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjB8Qzd8RDV8STF8WTZ8QjF8TTF8VTF8SzB8UjB8SDB8RzB8TDF8UTB8TjB8VDB8VjB8UzB8RTB8VzAiLCJGbGlnaHREZXRhaWxfS2V5IjoiM3V0a3ptMlZUN21EK3ArZVV3V3lKZz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiIiwiQm9va2luZ0NvZGUiOiJMIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6IlJZZjRaRHdnU0J5d25wekFWSlZJcWc9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJSWWY0WkR3Z1NCeXducHpBVkpWSXFnPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Uc3NLd3pBTSs1aWl1NTBYNnkybENXelFlYkMyaDE3MlwvNTh4SmJsVTRKY2tiT2VjbldpU29KSnZtUENidmhcL1l1UUlHeDNqdEI1dys1aG5LNllLSVJteTIxUk5qZ1JmeTFyVlJ0YnRLTEI2Q05kWXdsQVpjUFNcL3ZIYzQ3VlhyYlJkQklhQkJCZmJLenBSenRoQWdwa3BvU0VcL2paSDlNQ0tHMD0iLCJGYXJlQmFzaXMiOiJMTkxFVSJ9LHsiQWlyU2VnbWVudF9LZXkiOiIxUVcyVnF4ZFF2YW5CdGFER2hhK0VBPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiUk8iLCJGbGlnaHROdW1iZXIiOiIyNjMiLCJPcmlnaW4iOiJPVFAiLCJEZXN0aW5hdGlvbiI6IklTVCIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA1LTAxVDE2OjI1OjAwLjAwMCswMzowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNS0wMVQxNzo0MDowMC4wMDArMDM6MDAiLCJGbGlnaHRUaW1lIjoiNzUiLCJEaXN0YW5jZSI6IjI5MCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIwIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjl8Qzh8RDZ8STF8WTl8Qjl8TTl8VTl8Szl8Ujl8SDl8RzB8TDV8UTR8TjJ8VDl8Vjl8UzB8RTB8VzEiLCJGbGlnaHREZXRhaWxfS2V5IjoiSlhCVFRhdzRTT21iTkJvVlFUVW85dz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiTCIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJSWWY0WkR3Z1NCeXducHpBVkpWSXFnPT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiUllmNFpEd2dTQnl3bnB6QVZKVklxZz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHNzS3d6QU0rNWlpdTUwWDZ5MmxDV3pRZWJDMmgxNzJcLzU4eEpibFU0SmNrYk9lY25XaVNvSkp2bVBDYnZoXC9ZdVFJR3gzanRCNXcrNWhuSzZZS0lSbXkyMVJOamdSZnkxclZSdGJ0S0xCNkNOZFl3bEFaY1BTXC92SGM0N1ZYcmJSZEJJYUJCQmZiS3pwUnp0aEFncGtwb1NFXC9qWkg5TUNLRzA9IiwiRmFyZUJhc2lzIjoiTE5MRVUifV0sIkZhcmVydWxlc3JlZl9LZXkiOltbIlJZZjRaRHdnU0J5d25wekFWSlZJcWc9PSJdLFsiUllmNFpEd2dTQnl3bnB6QVZKVklxZz09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl0sWyIxRyJdXSwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOltbImd3cy1lSnhOVHNzS3d6QU0rNWlpdTUwWDZ5MmxDV3pRZWJDMmgxNzJcLzU4eEpibFU0SmNrYk9lY25XaVNvSkp2bVBDYnZoXC9ZdVFJR3gzanRCNXcrNWhuSzZZS0lSbXkyMVJOamdSZnkxclZSdGJ0S0xCNkNOZFl3bEFaY1BTXC92SGM0N1ZYcmJSZEJJYUJCQmZiS3pwUnp0aEFncGtwb1NFXC9qWkg5TUNLRzA9Il0sWyJnd3MtZUp4TlRzc0t3ekFNKzVpaXU1MFg2eTJsQ1d6UWViQzJoMTcyXC81OHhKYmxVNEpja2JPZWNuV2lTb0pKdm1QQ2J2aFwvWXVRSUd4M2p0QjV3KzVobks2WUtJUm15MjFSTmpnUmZ5MXJWUnRidEtMQjZDTmRZd2xBWmNQU1wvdkhjNDdWWHJiUmRCSWFCQkJmYkt6cFJ6dGhBZ3BrcG9TRVwvalpIOU1DS0cwPSJdXX0=" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F2673512" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012313" data-airline="Aeroflot Airlines" data-arrive="640" data-duration="1110" data-stops="1" data-depature="970" data-airlinecode="SU" data-price="270.03" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF2700313" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/SU.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>18:10 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>13:40 (01 May, Sun 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">18h 30m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse13" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="IkhoZDdrQzNYU3QrMk1IK3JCRFZaTmc9PXxLS3wxR3xLS3xnd3MtZUp4TlRzc09nekFNK3hqa3U4TmpIYmNpQ3RvT2xFRkJqQXZcL1wveG1rclRRdFVtd2x0dUpZYTB2S2c3WFFcL2xXQnF3ZzdcL040REhxWDJPMndRWTZvblJLY1RwRFJZUHRcLzVRRDVRVWZjK2Faa2x1VnpiTnlCR2pwS1ZXRGdUZGxQNDNZeUpVQ01pREM4bDM3bHRIU2hrbmNJSUFcLzNwQnZZXC9KMGM9fEtLfHxWVnx8QHwxIg==" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">270.03</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook13" id="F2700313" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiZnBaTzdiejdRV0dNWXNoaGJqM2ZUUT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjI3MC4wMyIsIkJhc2VQcmljZSI6IjE2Mi4wMCIsIlRheGVzIjoiMTA4LjAzIiwiVG90YWxQcmljZV9BUEkiOiJFVVIyNzAuMDMiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIxNjIuMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiIxMDguMDMiLCJSZWZ1bmRhYmxlIjpmYWxzZSwiUGxhdGluZ0NhcnJpZXIiOiJTVSIsIkZhcmVUeXBlIjoiTm9uIFJlZnVuZGFibGUiLCJBbGxfUGFzc2VuZ2VyIjoiQURUIiwiQWR1bHRzIjoxLCJBZHVsdHNfQmFzZV9QcmljZSI6IjE2Mi4wMCIsIkFkdWx0c19UYXhfUHJpY2UiOiIxMDguMDMiLCJUcmF2ZWxUaW1lIjoiUDBEVDE4SDMwTTBTIiwiQWlyU2VnbWVudF9LZXkiOiJcL0RneFgxNzFScldmOWxUcERSUXEzdz09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoiMjd3Q1l1RENSajJMZkJFWlpMZEpGdz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlNVIiwiRmxpZ2h0TnVtYmVyIjoiMjY5NSIsIk9yaWdpbiI6IkFNUyIsIkRlc3RpbmF0aW9uIjoiU1ZPIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMTg6MTA6MDAuMDAwKzAyOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA0LTMwVDIyOjIwOjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIxOTAiLCJEaXN0YW5jZSI6IjEzNDMiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjMyMCIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6Iko3fEM2fEQyfEkyfFoyfFk3fEI3fE03fFU3fEs3fEg3fEw3fFE3fFQwfEUwfE4wfFIwfEcwfFYwIiwiRmxpZ2h0RGV0YWlsX0tleSI6IlNqRitVajdLUVRXR29KeGV4U0NITnc9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkUiLCJCb29raW5nQ29kZSI6IlEiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiSGhkN2tDM1hTdCsyTUgrckJEVlpOZz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IkhoZDdrQzNYU3QrMk1IK3JCRFZaTmc9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRzc09nekFNK3hqa3U4TmpIYmNpQ3RvT2xFRkJqQXZcL1wveG1rclRRdFVtd2x0dUpZYTB2S2c3WFFcL2xXQnF3ZzdcL040REhxWDJPMndRWTZvblJLY1RwRFJZUHRcLzVRRDVRVWZjK2Faa2x1VnpiTnlCR2pwS1ZXRGdUZGxQNDNZeUpVQ01pREM4bDM3bHRIU2hrbmNJSUFcLzNwQnZZXC9KMGM9IiwiRmFyZUJhc2lzIjoiUVBYT1cifSx7IkFpclNlZ21lbnRfS2V5IjoiXC9EZ3hYMTcxUnJXZjlsVHBEUlFxM3c9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJTVSIsIkZsaWdodE51bWJlciI6IjIxMzYiLCJPcmlnaW4iOiJTVk8iLCJEZXN0aW5hdGlvbiI6IklTVCIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA1LTAxVDEwOjA1OjAwLjAwMCswMzowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNS0wMVQxMzo0MDowMC4wMDArMDM6MDAiLCJGbGlnaHRUaW1lIjoiMjE1IiwiRGlzdGFuY2UiOiIxMDg5IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMjAiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUyIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJKN3xDNXxEM3xJM3xaM3xZN3xCN3xNN3xVN3xLN3xIN3xMN3xRN3xUN3xFMHxOMHxSMHxHMHxWMCIsIkZsaWdodERldGFpbF9LZXkiOiIrcXFsMWREOFNwYUZka1BmUFVkSEFBPT0iLCJPcmlnaW5UZXJtaW5hbCI6IkQiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiUSIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJIaGQ3a0MzWFN0KzJNSCtyQkRWWk5nPT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiSGhkN2tDM1hTdCsyTUgrckJEVlpOZz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHNzT2d6QU0reGprdThOakhiY2lDdG9PbEVGQmpBdlwvXC94bWtyVFF0VW13bHR1SllhMHZLZzdYUVwvbFdCcXdnN1wvTjRESHFYMk8yd1FZNm9uUktjVHBEUllQdFwvNVFENVFVZmMrYVprbHVWemJOeUJHanBLVldEZ1RkbFA0M1l5SlVDTWlEQzhsMzdsdEhTaGtuY0lJQVwvM3BCdllcL0owYz0iLCJGYXJlQmFzaXMiOiJRUFhPVyJ9XSwiRmFyZXJ1bGVzcmVmX0tleSI6W1siSGhkN2tDM1hTdCsyTUgrckJEVlpOZz09Il0sWyJIaGQ3a0MzWFN0KzJNSCtyQkRWWk5nPT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXSxbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5Uc3NPZ3pBTSt4amt1OE5qSGJjaUN0b09sRUZCakF2XC9cL3hta3JUUXRVbXdsdHVKWWEwdktnN1hRXC9sV0Jxd2c3XC9ONERIcVgyTzJ3UVk2b25SS2NUcERSWVB0XC81UUQ1UVVmYythWmtsdVZ6Yk55QkdqcEtWV0RnVGRsUDQzWXlKVUNNaURDOGwzN2x0SFNoa25jSUlBXC8zcEJ2WVwvSjBjPSJdLFsiZ3dzLWVKeE5Uc3NPZ3pBTSt4amt1OE5qSGJjaUN0b09sRUZCakF2XC9cL3hta3JUUXRVbXdsdHVKWWEwdktnN1hRXC9sV0Jxd2c3XC9ONERIcVgyTzJ3UVk2b25SS2NUcERSWVB0XC81UUQ1UVVmYythWmtsdVZ6Yk55QkdqcEtWV0RnVGRsUDQzWXlKVUNNaURDOGwzN2x0SFNoa25jSUlBXC8zcEJ2WVwvSjBjPSJdXX0=" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F2700313" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse13" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        6:10 PM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        10:20 PM <br>
                        <span> Sheremetyevo Arpt SVO</span>
                      </li>
                      <li class="rfms_emirates">
                        Aeroflot Airlines<br>
                        <span>SU-320</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>3h 10m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Sheremetyevo Arpt, | <strong>Layover:: 11h 45m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        10:05 AM <br>
                        <span>Sheremetyevo Arpt SVO</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        1:40 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        Aeroflot Airlines<br>
                        <span>SU-320</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>3h 35m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 18h 30m</span><br>
                        Arrival:<span class="color_secondry"> Sunday 01 May</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">270.03</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook13" id="F2700313" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiZnBaTzdiejdRV0dNWXNoaGJqM2ZUUT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjI3MC4wMyIsIkJhc2VQcmljZSI6IjE2Mi4wMCIsIlRheGVzIjoiMTA4LjAzIiwiVG90YWxQcmljZV9BUEkiOiJFVVIyNzAuMDMiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIxNjIuMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiIxMDguMDMiLCJSZWZ1bmRhYmxlIjpmYWxzZSwiUGxhdGluZ0NhcnJpZXIiOiJTVSIsIkZhcmVUeXBlIjoiTm9uIFJlZnVuZGFibGUiLCJBbGxfUGFzc2VuZ2VyIjoiQURUIiwiQWR1bHRzIjoxLCJBZHVsdHNfQmFzZV9QcmljZSI6IjE2Mi4wMCIsIkFkdWx0c19UYXhfUHJpY2UiOiIxMDguMDMiLCJUcmF2ZWxUaW1lIjoiUDBEVDE4SDMwTTBTIiwiQWlyU2VnbWVudF9LZXkiOiJcL0RneFgxNzFScldmOWxUcERSUXEzdz09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoiMjd3Q1l1RENSajJMZkJFWlpMZEpGdz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlNVIiwiRmxpZ2h0TnVtYmVyIjoiMjY5NSIsIk9yaWdpbiI6IkFNUyIsIkRlc3RpbmF0aW9uIjoiU1ZPIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMTg6MTA6MDAuMDAwKzAyOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA0LTMwVDIyOjIwOjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIxOTAiLCJEaXN0YW5jZSI6IjEzNDMiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjMyMCIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6Iko3fEM2fEQyfEkyfFoyfFk3fEI3fE03fFU3fEs3fEg3fEw3fFE3fFQwfEUwfE4wfFIwfEcwfFYwIiwiRmxpZ2h0RGV0YWlsX0tleSI6IlNqRitVajdLUVRXR29KeGV4U0NITnc9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkUiLCJCb29raW5nQ29kZSI6IlEiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiSGhkN2tDM1hTdCsyTUgrckJEVlpOZz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IkhoZDdrQzNYU3QrMk1IK3JCRFZaTmc9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRzc09nekFNK3hqa3U4TmpIYmNpQ3RvT2xFRkJqQXZcL1wveG1rclRRdFVtd2x0dUpZYTB2S2c3WFFcL2xXQnF3ZzdcL040REhxWDJPMndRWTZvblJLY1RwRFJZUHRcLzVRRDVRVWZjK2Faa2x1VnpiTnlCR2pwS1ZXRGdUZGxQNDNZeUpVQ01pREM4bDM3bHRIU2hrbmNJSUFcLzNwQnZZXC9KMGM9IiwiRmFyZUJhc2lzIjoiUVBYT1cifSx7IkFpclNlZ21lbnRfS2V5IjoiXC9EZ3hYMTcxUnJXZjlsVHBEUlFxM3c9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJTVSIsIkZsaWdodE51bWJlciI6IjIxMzYiLCJPcmlnaW4iOiJTVk8iLCJEZXN0aW5hdGlvbiI6IklTVCIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA1LTAxVDEwOjA1OjAwLjAwMCswMzowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNS0wMVQxMzo0MDowMC4wMDArMDM6MDAiLCJGbGlnaHRUaW1lIjoiMjE1IiwiRGlzdGFuY2UiOiIxMDg5IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMjAiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUyIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJKN3xDNXxEM3xJM3xaM3xZN3xCN3xNN3xVN3xLN3xIN3xMN3xRN3xUN3xFMHxOMHxSMHxHMHxWMCIsIkZsaWdodERldGFpbF9LZXkiOiIrcXFsMWREOFNwYUZka1BmUFVkSEFBPT0iLCJPcmlnaW5UZXJtaW5hbCI6IkQiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiUSIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJIaGQ3a0MzWFN0KzJNSCtyQkRWWk5nPT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiSGhkN2tDM1hTdCsyTUgrckJEVlpOZz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHNzT2d6QU0reGprdThOakhiY2lDdG9PbEVGQmpBdlwvXC94bWtyVFF0VW13bHR1SllhMHZLZzdYUVwvbFdCcXdnN1wvTjRESHFYMk8yd1FZNm9uUktjVHBEUllQdFwvNVFENVFVZmMrYVprbHVWemJOeUJHanBLVldEZ1RkbFA0M1l5SlVDTWlEQzhsMzdsdEhTaGtuY0lJQVwvM3BCdllcL0owYz0iLCJGYXJlQmFzaXMiOiJRUFhPVyJ9XSwiRmFyZXJ1bGVzcmVmX0tleSI6W1siSGhkN2tDM1hTdCsyTUgrckJEVlpOZz09Il0sWyJIaGQ3a0MzWFN0KzJNSCtyQkRWWk5nPT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXSxbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5Uc3NPZ3pBTSt4amt1OE5qSGJjaUN0b09sRUZCakF2XC9cL3hta3JUUXRVbXdsdHVKWWEwdktnN1hRXC9sV0Jxd2c3XC9ONERIcVgyTzJ3UVk2b25SS2NUcERSWVB0XC81UUQ1UVVmYythWmtsdVZ6Yk55QkdqcEtWV0RnVGRsUDQzWXlKVUNNaURDOGwzN2x0SFNoa25jSUlBXC8zcEJ2WVwvSjBjPSJdLFsiZ3dzLWVKeE5Uc3NPZ3pBTSt4amt1OE5qSGJjaUN0b09sRUZCakF2XC9cL3hta3JUUXRVbXdsdHVKWWEwdktnN1hRXC9sV0Jxd2c3XC9ONERIcVgyTzJ3UVk2b25SS2NUcERSWVB0XC81UUQ1UVVmYythWmtsdVZ6Yk55QkdqcEtWV0RnVGRsUDQzWXlKVUNNaURDOGwzN2x0SFNoa25jSUlBXC8zcEJ2WVwvSjBjPSJdXX0=" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F2700313" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012314" data-airline="Air Ukraine International" data-arrive="1110" data-duration="435" data-stops="1" data-depature="675" data-airlinecode="PS" data-price="282.02" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF2820214" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/PS.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>13:15 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>21:30 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">7h 15m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse14" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="IkFXXC9tWTRlbVRmRzR1RVhFXC92UGZxdz09fEtLfDFHfEtLfGd3cy1lSnhOVHNzS3d6QU0rNWlpdTV6WDJDMGxhOWlnRFlWMGgxejJcLzU4eEo0RXhnU1dNaE93WW82RUVPbUg4dzRMUGNsYVVkd0lLak02clhqRCs3Z1dpV3dNcEhtMlh2SjBPczhKU25UTGNxVEp5S2FRQUlqUGI2WFNnRFY2UCttdnRONkZCZE5xZUttVjlYRG5Ua283RzlwSWI5S3N2TEtrbmRnPT18S0t8fFZWfHxAfDEi" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">282.02</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook14" id="F2820214" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiSW00cmhNRnVTS3FHRHY5enNxS1B4UT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjI4Mi4wMiIsIkJhc2VQcmljZSI6IjIzNy4wMCIsIlRheGVzIjoiNDUuMDIiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjI4Mi4wMiIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjIzNy4wMCIsIlRheFByaWNlX0JyZWFrZG93biI6IjQ1LjAyIiwiUmVmdW5kYWJsZSI6InRydWUiLCJQbGF0aW5nQ2FycmllciI6IlBTIiwiRmFyZVR5cGUiOiJSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIyMzcuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiNDUuMDIiLCJUcmF2ZWxUaW1lIjoiUDBEVDdIMTVNMFMiLCJBaXJTZWdtZW50X0tleSI6InJhd3M2djRNUzVlbzNTSjhzMEJJN0E9PSIsInNlZ21lbnRzIjpbeyJBaXJTZWdtZW50X0tleSI6ImtrNXU0R1pRU2lhSXcrQVVFWWt0bmc9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJQUyIsIkZsaWdodE51bWJlciI6IjEwMiIsIk9yaWdpbiI6IkFNUyIsIkRlc3RpbmF0aW9uIjoiS0JQIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMTM6MTU6MDAuMDAwKzAyOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA0LTMwVDE3OjA1OjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIxNzAiLCJEaXN0YW5jZSI6IjExMTkiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjczNyIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiQ2FjaGUgc3RhdHVzIHVzZWQuIE5vIHBvbGxlZCBhdmFpbCBleGlzdHMuIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUCIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJDNHxENHxaNHxTM3xZM3xQMHxXMHxFMHxLMHxMMHxNMHxPMHxSMHxHMHxIMHxWMHxRMHxOMHxKMHxCMHxUMCIsIkZsaWdodERldGFpbF9LZXkiOiIwXC9RRE1yaWtUSHVzMndFY0JRNjhoUT09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiIiwiQm9va2luZ0NvZGUiOiJZIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6IkFXXC9tWTRlbVRmRzR1RVhFXC92UGZxdz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IkFXXC9tWTRlbVRmRzR1RVhFXC92UGZxdz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHNzS3d6QU0rNWlpdTV6WDJDMGxhOWlnRFlWMGgxejJcLzU4eEo0RXhnU1dNaE93WW82RUVPbUg4dzRMUGNsYVVkd0lLak02clhqRCs3Z1dpV3dNcEhtMlh2SjBPczhKU25UTGNxVEp5S2FRQUlqUGI2WFNnRFY2UCttdnRONkZCZE5xZUttVjlYRG5Ua283RzlwSWI5S3N2TEtrbmRnPT0iLCJGYXJlQmFzaXMiOiJZTDFGRVA0In0seyJBaXJTZWdtZW50X0tleSI6InJhd3M2djRNUzVlbzNTSjhzMEJJN0E9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJQUyIsIkZsaWdodE51bWJlciI6IjcxNSIsIk9yaWdpbiI6IktCUCIsIkRlc3RpbmF0aW9uIjoiSVNUIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMTk6MzA6MDAuMDAwKzAzOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA0LTMwVDIxOjMwOjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIxMjAiLCJEaXN0YW5jZSI6IjY1NiIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiNzM3IiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJDYWNoZSBzdGF0dXMgdXNlZC4gTm8gcG9sbGVkIGF2YWlsIGV4aXN0cy4iLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJQIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6IkM0fEQ0fFo0fFM0fFk0fFA0fFc0fEUyfEswfEwwfE0wfE8wfFIwfEcwfEgwfFYwfFEwfE4wfEowfEIwfFQwIiwiRmxpZ2h0RGV0YWlsX0tleSI6IkNmejMyOWRnUnRLczNPMFc1R2I0Y1E9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkkiLCJCb29raW5nQ29kZSI6IlkiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiQVdcL21ZNGVtVGZHNHVFWEVcL3ZQZnF3PT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiQVdcL21ZNGVtVGZHNHVFWEVcL3ZQZnF3PT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Uc3NLd3pBTSs1aWl1NXpYMkMwbGE5aWdEWVYwaDF6MlwvNTh4SjRFeGdTV01oT3dZbzZFRU9tSDh3NExQY2xhVWR3SUtqTTZyWGpEKzdnV2lXd01wSG0yWHZKME9zOEpTblRMY3FUSnlLYVFBSWpQYjZYU2dEVjZQK212dE42RkJkTnFlS21WOVhEblRrbzdHOXBJYjlLc3ZMS2tuZGc9PSIsIkZhcmVCYXNpcyI6IllMMUZFUDQifV0sIkZhcmVydWxlc3JlZl9LZXkiOltbIkFXXC9tWTRlbVRmRzR1RVhFXC92UGZxdz09Il0sWyJBV1wvbVk0ZW1UZkc0dUVYRVwvdlBmcXc9PSJdXSwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjpbWyIxRyJdLFsiMUciXV0sIkZhcmVydWxlc3JlZl9jb250ZW50IjpbWyJnd3MtZUp4TlRzc0t3ekFNKzVpaXU1elgyQzBsYTlpZ0RZVjBoMXoyXC81OHhKNEV4Z1NXTWhPd1lvNkVFT21IOHc0TFBjbGFVZHdJS2pNNnJYakQrN2dXaVd3TXBIbTJYdkowT3M4SlNuVExjcVRKeUthUUFJalBiNlhTZ0RWNlArbXZ0TjZGQmROcWVLbVY5WERuVGtvN0c5cEliOUtzdkxLa25kZz09Il0sWyJnd3MtZUp4TlRzc0t3ekFNKzVpaXU1elgyQzBsYTlpZ0RZVjBoMXoyXC81OHhKNEV4Z1NXTWhPd1lvNkVFT21IOHc0TFBjbGFVZHdJS2pNNnJYakQrN2dXaVd3TXBIbTJYdkowT3M4SlNuVExjcVRKeUthUUFJalBiNlhTZ0RWNlArbXZ0TjZGQmROcWVLbVY5WERuVGtvN0c5cEliOUtzdkxLa25kZz09Il1dfQ==" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F2820214" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse14" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        1:15 PM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        5:05 PM <br>
                        <span> Boryspil Arpt KBP</span>
                      </li>
                      <li class="rfms_emirates">
                        Air Ukraine International<br>
                        <span>PS-737</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>2h 50m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Boryspil Arpt, | <strong>Layover:: 2h 25m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        7:30 PM <br>
                        <span>Boryspil Arpt KBP</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        9:30 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        Air Ukraine International<br>
                        <span>PS-737</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>2h 0m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 7h 15m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">282.02</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook14" id="F2820214" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiSW00cmhNRnVTS3FHRHY5enNxS1B4UT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjI4Mi4wMiIsIkJhc2VQcmljZSI6IjIzNy4wMCIsIlRheGVzIjoiNDUuMDIiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjI4Mi4wMiIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjIzNy4wMCIsIlRheFByaWNlX0JyZWFrZG93biI6IjQ1LjAyIiwiUmVmdW5kYWJsZSI6InRydWUiLCJQbGF0aW5nQ2FycmllciI6IlBTIiwiRmFyZVR5cGUiOiJSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIyMzcuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiNDUuMDIiLCJUcmF2ZWxUaW1lIjoiUDBEVDdIMTVNMFMiLCJBaXJTZWdtZW50X0tleSI6InJhd3M2djRNUzVlbzNTSjhzMEJJN0E9PSIsInNlZ21lbnRzIjpbeyJBaXJTZWdtZW50X0tleSI6ImtrNXU0R1pRU2lhSXcrQVVFWWt0bmc9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJQUyIsIkZsaWdodE51bWJlciI6IjEwMiIsIk9yaWdpbiI6IkFNUyIsIkRlc3RpbmF0aW9uIjoiS0JQIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMTM6MTU6MDAuMDAwKzAyOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA0LTMwVDE3OjA1OjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIxNzAiLCJEaXN0YW5jZSI6IjExMTkiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjczNyIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiQ2FjaGUgc3RhdHVzIHVzZWQuIE5vIHBvbGxlZCBhdmFpbCBleGlzdHMuIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUCIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJDNHxENHxaNHxTM3xZM3xQMHxXMHxFMHxLMHxMMHxNMHxPMHxSMHxHMHxIMHxWMHxRMHxOMHxKMHxCMHxUMCIsIkZsaWdodERldGFpbF9LZXkiOiIwXC9RRE1yaWtUSHVzMndFY0JRNjhoUT09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiIiwiQm9va2luZ0NvZGUiOiJZIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6IkFXXC9tWTRlbVRmRzR1RVhFXC92UGZxdz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IkFXXC9tWTRlbVRmRzR1RVhFXC92UGZxdz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHNzS3d6QU0rNWlpdTV6WDJDMGxhOWlnRFlWMGgxejJcLzU4eEo0RXhnU1dNaE93WW82RUVPbUg4dzRMUGNsYVVkd0lLak02clhqRCs3Z1dpV3dNcEhtMlh2SjBPczhKU25UTGNxVEp5S2FRQUlqUGI2WFNnRFY2UCttdnRONkZCZE5xZUttVjlYRG5Ua283RzlwSWI5S3N2TEtrbmRnPT0iLCJGYXJlQmFzaXMiOiJZTDFGRVA0In0seyJBaXJTZWdtZW50X0tleSI6InJhd3M2djRNUzVlbzNTSjhzMEJJN0E9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJQUyIsIkZsaWdodE51bWJlciI6IjcxNSIsIk9yaWdpbiI6IktCUCIsIkRlc3RpbmF0aW9uIjoiSVNUIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMTk6MzA6MDAuMDAwKzAzOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA0LTMwVDIxOjMwOjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIxMjAiLCJEaXN0YW5jZSI6IjY1NiIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiNzM3IiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJDYWNoZSBzdGF0dXMgdXNlZC4gTm8gcG9sbGVkIGF2YWlsIGV4aXN0cy4iLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJQIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6IkM0fEQ0fFo0fFM0fFk0fFA0fFc0fEUyfEswfEwwfE0wfE8wfFIwfEcwfEgwfFYwfFEwfE4wfEowfEIwfFQwIiwiRmxpZ2h0RGV0YWlsX0tleSI6IkNmejMyOWRnUnRLczNPMFc1R2I0Y1E9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkkiLCJCb29raW5nQ29kZSI6IlkiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiQVdcL21ZNGVtVGZHNHVFWEVcL3ZQZnF3PT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiQVdcL21ZNGVtVGZHNHVFWEVcL3ZQZnF3PT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Uc3NLd3pBTSs1aWl1NXpYMkMwbGE5aWdEWVYwaDF6MlwvNTh4SjRFeGdTV01oT3dZbzZFRU9tSDh3NExQY2xhVWR3SUtqTTZyWGpEKzdnV2lXd01wSG0yWHZKME9zOEpTblRMY3FUSnlLYVFBSWpQYjZYU2dEVjZQK212dE42RkJkTnFlS21WOVhEblRrbzdHOXBJYjlLc3ZMS2tuZGc9PSIsIkZhcmVCYXNpcyI6IllMMUZFUDQifV0sIkZhcmVydWxlc3JlZl9LZXkiOltbIkFXXC9tWTRlbVRmRzR1RVhFXC92UGZxdz09Il0sWyJBV1wvbVk0ZW1UZkc0dUVYRVwvdlBmcXc9PSJdXSwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjpbWyIxRyJdLFsiMUciXV0sIkZhcmVydWxlc3JlZl9jb250ZW50IjpbWyJnd3MtZUp4TlRzc0t3ekFNKzVpaXU1elgyQzBsYTlpZ0RZVjBoMXoyXC81OHhKNEV4Z1NXTWhPd1lvNkVFT21IOHc0TFBjbGFVZHdJS2pNNnJYakQrN2dXaVd3TXBIbTJYdkowT3M4SlNuVExjcVRKeUthUUFJalBiNlhTZ0RWNlArbXZ0TjZGQmROcWVLbVY5WERuVGtvN0c5cEliOUtzdkxLa25kZz09Il0sWyJnd3MtZUp4TlRzc0t3ekFNKzVpaXU1elgyQzBsYTlpZ0RZVjBoMXoyXC81OHhKNEV4Z1NXTWhPd1lvNkVFT21IOHc0TFBjbGFVZHdJS2pNNnJYakQrN2dXaVd3TXBIbTJYdkowT3M4SlNuVExjcVRKeUthUUFJalBiNlhTZ0RWNlArbXZ0TjZGQmROcWVLbVY5WERuVGtvN0c5cEliOUtzdkxLa25kZz09Il1dfQ==" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F2820214" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012315" data-airline="Air Ukraine International" data-arrive="700" data-duration="1465" data-stops="1" data-depature="675" data-airlinecode="PS" data-price="282.02" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF2820215" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/PS.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>13:15 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>14:40 (01 May, Sun 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">1d 0h 25m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse15" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="IkFXXC9tWTRlbVRmRzR1RVhFXC92UGZxdz09fEtLfDFHfEtLfGd3cy1lSnhOVHNzS3d6QU0rNWlpdTV6WDJDMGxhOWlnRFlWMGgxejJcLzU4eEo0RXhnU1dNaE93WW82RUVPbUg4dzRMUGNsYVVkd0lLak02clhqRCs3Z1dpV3dNcEhtMlh2SjBPczhKU25UTGNxVEp5S2FRQUlqUGI2WFNnRFY2UCttdnRONkZCZE5xZUttVjlYRG5Ua283RzlwSWI5S3N2TEtrbmRnPT18S0t8fFZWfHxAfDEi" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">282.02</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook15" id="F2820215" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiUlp5bXZkbjdSWjZnU1dwdFY1WWVSQT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjI4Mi4wMiIsIkJhc2VQcmljZSI6IjIzNy4wMCIsIlRheGVzIjoiNDUuMDIiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjI4Mi4wMiIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjIzNy4wMCIsIlRheFByaWNlX0JyZWFrZG93biI6IjQ1LjAyIiwiUmVmdW5kYWJsZSI6InRydWUiLCJQbGF0aW5nQ2FycmllciI6IlBTIiwiRmFyZVR5cGUiOiJSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIyMzcuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiNDUuMDIiLCJUcmF2ZWxUaW1lIjoiUDFEVDBIMjVNMFMiLCJBaXJTZWdtZW50X0tleSI6IjY3Z3drUVwvVFQzNkJncmYrdEtya0JRPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiJrazV1NEdaUVNpYUl3K0FVRVlrdG5nPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiUFMiLCJGbGlnaHROdW1iZXIiOiIxMDIiLCJPcmlnaW4iOiJBTVMiLCJEZXN0aW5hdGlvbiI6IktCUCIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDEzOjE1OjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQxNzowNTowMC4wMDArMDM6MDAiLCJGbGlnaHRUaW1lIjoiMTcwIiwiRGlzdGFuY2UiOiIxMTE5IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiI3MzciLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IkNhY2hlIHN0YXR1cyB1c2VkLiBObyBwb2xsZWQgYXZhaWwgZXhpc3RzLiIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlAiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiQzR8RDR8WjR8UzN8WTN8UDB8VzB8RTB8SzB8TDB8TTB8TzB8UjB8RzB8SDB8VjB8UTB8TjB8SjB8QjB8VDAiLCJGbGlnaHREZXRhaWxfS2V5IjoiMFwvUURNcmlrVEh1czJ3RWNCUTY4aFE9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IiIsIkJvb2tpbmdDb2RlIjoiWSIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJBV1wvbVk0ZW1UZkc0dUVYRVwvdlBmcXc9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJBV1wvbVk0ZW1UZkc0dUVYRVwvdlBmcXc9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRzc0t3ekFNKzVpaXU1elgyQzBsYTlpZ0RZVjBoMXoyXC81OHhKNEV4Z1NXTWhPd1lvNkVFT21IOHc0TFBjbGFVZHdJS2pNNnJYakQrN2dXaVd3TXBIbTJYdkowT3M4SlNuVExjcVRKeUthUUFJalBiNlhTZ0RWNlArbXZ0TjZGQmROcWVLbVY5WERuVGtvN0c5cEliOUtzdkxLa25kZz09IiwiRmFyZUJhc2lzIjoiWUwxRkVQNCJ9LHsiQWlyU2VnbWVudF9LZXkiOiI2N2d3a1FcL1RUMzZCZ3JmK3RLcmtCUT09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlBTIiwiRmxpZ2h0TnVtYmVyIjoiNzEzIiwiT3JpZ2luIjoiS0JQIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNS0wMVQxMjo0MDowMC4wMDArMDM6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDUtMDFUMTQ6NDA6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjEyMCIsIkRpc3RhbmNlIjoiNjU2IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiI3MzUiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6Ik5vIHBvbGxlZCBhdmFpbCBleGlzdHMiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJBIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6IkM0fEQ0fFo0fFM0fFk0fFA0fFc0fEU0fEswfEwwfE0wfE8wfFIwfEcwfEgwfFYwfFEwfE4wfEowfEIwfFQwIiwiRmxpZ2h0RGV0YWlsX0tleSI6IjJ5UXhpU1wvS1FFVzREUHJiWWpGU2dBPT0iLCJPcmlnaW5UZXJtaW5hbCI6IiIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiJJIiwiQm9va2luZ0NvZGUiOiJZIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6IkFXXC9tWTRlbVRmRzR1RVhFXC92UGZxdz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IkFXXC9tWTRlbVRmRzR1RVhFXC92UGZxdz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHNzS3d6QU0rNWlpdTV6WDJDMGxhOWlnRFlWMGgxejJcLzU4eEo0RXhnU1dNaE93WW82RUVPbUg4dzRMUGNsYVVkd0lLak02clhqRCs3Z1dpV3dNcEhtMlh2SjBPczhKU25UTGNxVEp5S2FRQUlqUGI2WFNnRFY2UCttdnRONkZCZE5xZUttVjlYRG5Ua283RzlwSWI5S3N2TEtrbmRnPT0iLCJGYXJlQmFzaXMiOiJZTDFGRVA0In1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJBV1wvbVk0ZW1UZkc0dUVYRVwvdlBmcXc9PSJdLFsiQVdcL21ZNGVtVGZHNHVFWEVcL3ZQZnF3PT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXSxbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5Uc3NLd3pBTSs1aWl1NXpYMkMwbGE5aWdEWVYwaDF6MlwvNTh4SjRFeGdTV01oT3dZbzZFRU9tSDh3NExQY2xhVWR3SUtqTTZyWGpEKzdnV2lXd01wSG0yWHZKME9zOEpTblRMY3FUSnlLYVFBSWpQYjZYU2dEVjZQK212dE42RkJkTnFlS21WOVhEblRrbzdHOXBJYjlLc3ZMS2tuZGc9PSJdLFsiZ3dzLWVKeE5Uc3NLd3pBTSs1aWl1NXpYMkMwbGE5aWdEWVYwaDF6MlwvNTh4SjRFeGdTV01oT3dZbzZFRU9tSDh3NExQY2xhVWR3SUtqTTZyWGpEKzdnV2lXd01wSG0yWHZKME9zOEpTblRMY3FUSnlLYVFBSWpQYjZYU2dEVjZQK212dE42RkJkTnFlS21WOVhEblRrbzdHOXBJYjlLc3ZMS2tuZGc9PSJdXX0=" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F2820215" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse15" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        1:15 PM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        5:05 PM <br>
                        <span> Boryspil Arpt KBP</span>
                      </li>
                      <li class="rfms_emirates">
                        Air Ukraine International<br>
                        <span>PS-737</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>2h 50m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Boryspil Arpt, | <strong>Layover:: 19h 35m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        12:40 PM <br>
                        <span>Boryspil Arpt KBP</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        2:40 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        Air Ukraine International<br>
                        <span>PS-735</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>2h 0m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 1d 0h 25m</span><br>
                        Arrival:<span class="color_secondry"> Sunday 01 May</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">282.02</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook15" id="F2820215" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiUlp5bXZkbjdSWjZnU1dwdFY1WWVSQT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjI4Mi4wMiIsIkJhc2VQcmljZSI6IjIzNy4wMCIsIlRheGVzIjoiNDUuMDIiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjI4Mi4wMiIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjIzNy4wMCIsIlRheFByaWNlX0JyZWFrZG93biI6IjQ1LjAyIiwiUmVmdW5kYWJsZSI6InRydWUiLCJQbGF0aW5nQ2FycmllciI6IlBTIiwiRmFyZVR5cGUiOiJSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIyMzcuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiNDUuMDIiLCJUcmF2ZWxUaW1lIjoiUDFEVDBIMjVNMFMiLCJBaXJTZWdtZW50X0tleSI6IjY3Z3drUVwvVFQzNkJncmYrdEtya0JRPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiJrazV1NEdaUVNpYUl3K0FVRVlrdG5nPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiUFMiLCJGbGlnaHROdW1iZXIiOiIxMDIiLCJPcmlnaW4iOiJBTVMiLCJEZXN0aW5hdGlvbiI6IktCUCIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDEzOjE1OjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQxNzowNTowMC4wMDArMDM6MDAiLCJGbGlnaHRUaW1lIjoiMTcwIiwiRGlzdGFuY2UiOiIxMTE5IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiI3MzciLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IkNhY2hlIHN0YXR1cyB1c2VkLiBObyBwb2xsZWQgYXZhaWwgZXhpc3RzLiIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlAiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiQzR8RDR8WjR8UzN8WTN8UDB8VzB8RTB8SzB8TDB8TTB8TzB8UjB8RzB8SDB8VjB8UTB8TjB8SjB8QjB8VDAiLCJGbGlnaHREZXRhaWxfS2V5IjoiMFwvUURNcmlrVEh1czJ3RWNCUTY4aFE9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IiIsIkJvb2tpbmdDb2RlIjoiWSIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJBV1wvbVk0ZW1UZkc0dUVYRVwvdlBmcXc9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJBV1wvbVk0ZW1UZkc0dUVYRVwvdlBmcXc9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRzc0t3ekFNKzVpaXU1elgyQzBsYTlpZ0RZVjBoMXoyXC81OHhKNEV4Z1NXTWhPd1lvNkVFT21IOHc0TFBjbGFVZHdJS2pNNnJYakQrN2dXaVd3TXBIbTJYdkowT3M4SlNuVExjcVRKeUthUUFJalBiNlhTZ0RWNlArbXZ0TjZGQmROcWVLbVY5WERuVGtvN0c5cEliOUtzdkxLa25kZz09IiwiRmFyZUJhc2lzIjoiWUwxRkVQNCJ9LHsiQWlyU2VnbWVudF9LZXkiOiI2N2d3a1FcL1RUMzZCZ3JmK3RLcmtCUT09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlBTIiwiRmxpZ2h0TnVtYmVyIjoiNzEzIiwiT3JpZ2luIjoiS0JQIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNS0wMVQxMjo0MDowMC4wMDArMDM6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDUtMDFUMTQ6NDA6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjEyMCIsIkRpc3RhbmNlIjoiNjU2IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiI3MzUiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6Ik5vIHBvbGxlZCBhdmFpbCBleGlzdHMiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJBIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6IkM0fEQ0fFo0fFM0fFk0fFA0fFc0fEU0fEswfEwwfE0wfE8wfFIwfEcwfEgwfFYwfFEwfE4wfEowfEIwfFQwIiwiRmxpZ2h0RGV0YWlsX0tleSI6IjJ5UXhpU1wvS1FFVzREUHJiWWpGU2dBPT0iLCJPcmlnaW5UZXJtaW5hbCI6IiIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiJJIiwiQm9va2luZ0NvZGUiOiJZIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6IkFXXC9tWTRlbVRmRzR1RVhFXC92UGZxdz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IkFXXC9tWTRlbVRmRzR1RVhFXC92UGZxdz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHNzS3d6QU0rNWlpdTV6WDJDMGxhOWlnRFlWMGgxejJcLzU4eEo0RXhnU1dNaE93WW82RUVPbUg4dzRMUGNsYVVkd0lLak02clhqRCs3Z1dpV3dNcEhtMlh2SjBPczhKU25UTGNxVEp5S2FRQUlqUGI2WFNnRFY2UCttdnRONkZCZE5xZUttVjlYRG5Ua283RzlwSWI5S3N2TEtrbmRnPT0iLCJGYXJlQmFzaXMiOiJZTDFGRVA0In1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJBV1wvbVk0ZW1UZkc0dUVYRVwvdlBmcXc9PSJdLFsiQVdcL21ZNGVtVGZHNHVFWEVcL3ZQZnF3PT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXSxbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5Uc3NLd3pBTSs1aWl1NXpYMkMwbGE5aWdEWVYwaDF6MlwvNTh4SjRFeGdTV01oT3dZbzZFRU9tSDh3NExQY2xhVWR3SUtqTTZyWGpEKzdnV2lXd01wSG0yWHZKME9zOEpTblRMY3FUSnlLYVFBSWpQYjZYU2dEVjZQK212dE42RkJkTnFlS21WOVhEblRrbzdHOXBJYjlLc3ZMS2tuZGc9PSJdLFsiZ3dzLWVKeE5Uc3NLd3pBTSs1aWl1NXpYMkMwbGE5aWdEWVYwaDF6MlwvNTh4SjRFeGdTV01oT3dZbzZFRU9tSDh3NExQY2xhVWR3SUtqTTZyWGpEKzdnV2lXd01wSG0yWHZKME9zOEpTblRMY3FUSnlLYVFBSWpQYjZYU2dEVjZQK212dE42RkJkTnFlS21WOVhEblRrbzdHOXBJYjlLc3ZMS2tuZGc9PSJdXX0=" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F2820215" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012316" data-airline="British Airways" data-arrive="1240" data-duration="940" data-stops="1" data-depature="300" data-airlinecode="BA" data-price="331.59" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF3315916" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/BA.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>07:00 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>23:40 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">15h 40m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse16" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="IlM5cWdhemViUWpTZERcL2FqNmF5MktRPT18S0t8MUd8S0t8Z3dzLWVKeE5UakVPQWpFTWU4ekp1eFBDbGJHbFI4VUFaUUJPNnNMXC9uMEhhU29oSXNaWEVzaE5qVk1wS0U4YVwvV3ZCWnpnbjFuWUVLOWI3bEJqbXRZaENmR2tnNVl0ODFQekFORHZSOUhiZkpNbFFsRkFOUldIUmVlcUVOVFBmbno3TW53b1hvY0xrNjFiUzlnbEZKODRSdUV1QVwvZlFIQTN5YVR8S0t8fFZWfFM5cWdhemViUWpTZERcL2FqNmF5MktRPT18S0t8MUd8S0t8Z3dzLWVKeE5UakVPQWpFTWU4ekp1eFBDbGJHbFI4VUFaUUJPNnNMXC9uMEhhU29oSXNaWEVzaE5qVk1wS0U4YVwvV3ZCWnpnbjFuWUVLOWI3bEJqbXRZaENmR2tnNVl0ODFQekFORHZSOUhiZkpNbFFsRkFOUldIUmVlcUVOVFBmbno3TW53b1hvY0xrNjFiUzlnbEZKODRSdUV1QVwvZlFIQTN5YVR8S0t8anIzRmorV0lRTHFXalVTXC84VW9pVVE9PXxLS3wxR3xLS3xnd3MtZUp4TlRzc0toREFNXC9CaVoreVJkTGQ3cXJoWUZxZUJqd2N2K1wvMmRzMmw0Y3lJUmtoa2xDQ0VycCtCS0dCeHI4bXZlQWRIMkFCTFZhamhPOWE3c3kzQ0NseGJaK2RkOVFBeHhOU0VXc1hZb3QraWdnSXFOVUpRTjM0WFhlYTZZZ0g0VDVrR21hcmFWaFBMMVFhTCtwT2x0NzJFdFwvc1RrbWxBPT18S0t8fFZWfHxAfDIi" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">331.59</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook16" id="F3315916" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiVmJKQ25lQjRUZUt4SkN5SHJVc0hIZz09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjMzMS41OSIsIkJhc2VQcmljZSI6IjI1Ni4wMCIsIlRheGVzIjoiNzUuNTkiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjMzMS41OSIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjI1Ni4wMCIsIlRheFByaWNlX0JyZWFrZG93biI6Ijc1LjU5IiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiQkEiLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIyNTYuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiNzUuNTkiLCJUcmF2ZWxUaW1lIjoiUDBEVDE1SDQwTTBTIiwiQWlyU2VnbWVudF9LZXkiOiIrSXh0ZnRhZlRWQ3MySHRIV3VLSUpnPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiIwYXB5NjcyYlIxMmhrMVwvalU0ZWc1Zz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IkJBIiwiRmxpZ2h0TnVtYmVyIjoiODQ1MCIsIk9yaWdpbiI6IkFNUyIsIkRlc3RpbmF0aW9uIjoiTENZIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMDc6MDA6MDAuMDAwKzAyOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA0LTMwVDA3OjA1OjAwLjAwMCswMTowMCIsIkZsaWdodFRpbWUiOiI2NSIsIkRpc3RhbmNlIjoiMjExIiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiJFOTAiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUyIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJKNHxDNHxENHxSM3xJMHxZOXxCOXxIOXxLOXxNOXxMOXxWOHxOMHxRMHxPMHxTMHxHMCIsIkZsaWdodERldGFpbF9LZXkiOiJENE5MdFpMOFN2MkZpc3pUc09XWldnPT0iLCJPcmlnaW5UZXJtaW5hbCI6IiIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiIiLCJCb29raW5nQ29kZSI6IlYiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiUzlxZ2F6ZWJRalNkRFwvYWo2YXkyS1E9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJTOXFnYXplYlFqU2REXC9hajZheTJLUT09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVGpFT0FqRU1lOHpKdXhQQ2xiR2xSOFVBWlFCTzZzTFwvbjBIYVNvaElzWlhFc2hOalZNcEtFOGFcL1d2Qlp6Z24xbllFSzliN2xCam10WWhDZkdrZzVZdDgxUHpBTkR2UjlIYmZKTWxRbEZBTlJXSFJlZXFFTlRQZm56N01ud29Yb2NMazYxYlM5Z2xGSjg0UnVFdUFcL2ZRSEEzeWFUIiwiRmFyZUJhc2lzIjoiVlYyQ08ifSx7IkFpclNlZ21lbnRfS2V5IjoiK0l4dGZ0YWZUVkNzMkh0SFd1S0lKZz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IkJBIiwiRmxpZ2h0TnVtYmVyIjoiNjgwIiwiT3JpZ2luIjoiTEhSIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxNzo0NTowMC4wMDArMDE6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMjM6NDA6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjIzNSIsIkRpc3RhbmNlIjoiMTU1NyIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIwIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjl8Qzd8RDR8Ujl8STd8WTl8Qjl8SDl8Szl8TTl8TDl8Vjl8Tjl8UTl8TzF8Uzl8RzkiLCJGbGlnaHREZXRhaWxfS2V5IjoiS1BMWktXSkpSdW1XSnpMZ3NHNHdoQT09IiwiT3JpZ2luVGVybWluYWwiOiI1IiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkkiLCJCb29raW5nQ29kZSI6Ik8iLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoianIzRmorV0lRTHFXalVTXC84VW9pVVE9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJqcjNGaitXSVFMcVdqVVNcLzhVb2lVUT09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHNzS2hEQU1cL0JpWit5UmRMZDdxcmhZRnFlQmp3Y3YrXC8yZHMybDRjeUlSa2hrbENDRXJwK0JLR0J4cjhtdmVBZEgyQUJMVmFqaE85YTdzeTNDQ2x4YlorZGQ5UUF4eE5TRVdzWFlvdCtpZ2dJcU5VSlFOMzRYWGVhNllnSDRUNWtHbWFyYVZoUEwxUWFMK3BPbHQ3MkV0XC9zVGttbEE9PSIsIkZhcmVCYXNpcyI6Ik9MVjJSTyJ9XSwiRmFyZXJ1bGVzcmVmX0tleSI6W1siUzlxZ2F6ZWJRalNkRFwvYWo2YXkyS1E9PSJdLFsianIzRmorV0lRTHFXalVTXC84VW9pVVE9PSJdXSwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjpbWyIxRyJdLFsiMUciXV0sIkZhcmVydWxlc3JlZl9jb250ZW50IjpbWyJnd3MtZUp4TlRqRU9BakVNZTh6SnV4UENsYkdsUjhVQVpRQk82c0xcL24wSGFTb2hJc1pYRXNoTmpWTXBLRThhXC9XdkJaemduMW5ZRUs5YjdsQmptdFloQ2ZHa2c1WXQ4MVB6QU5EdlI5SGJmSk1sUWxGQU5SV0hSZWVxRU5UUGZuejdNbndvWG9jTGs2MWJTOWdsRko4NFJ1RXVBXC9mUUhBM3lhVCJdLFsiZ3dzLWVKeE5Uc3NLaERBTVwvQmlaK3lSZExkN3FyaFlGcWVCandjditcLzJkczJsNGN5SVJraGtsQ0NFcnArQktHQnhyOG12ZUFkSDJBQkxWYWpoTzlhN3N5M0NDbHhiWitkZDlRQXh4TlNFV3NYWW90K2lnZ0lxTlVKUU4zNFhYZWE2WWdINFQ1a0dtYXJhVmhQTDFRYUwrcE9sdDcyRXRcL3NUa21sQT09Il1dfQ==" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F3315916" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse16" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        7:00 AM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        7:05 AM <br>
                        <span> London City Arpt LCY</span>
                      </li>
                      <li class="rfms_emirates">
                        British Airways<br>
                        <span>BA-E90</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>1h 5m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: London City Arpt, | <strong>Layover:: 10h 40m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        5:45 PM <br>
                        <span>Heathrow LHR</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        11:40 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        British Airways<br>
                        <span>BA-320</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>3h 55m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 15h 40m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">331.59</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook16" id="F3315916" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiVmJKQ25lQjRUZUt4SkN5SHJVc0hIZz09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjMzMS41OSIsIkJhc2VQcmljZSI6IjI1Ni4wMCIsIlRheGVzIjoiNzUuNTkiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjMzMS41OSIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjI1Ni4wMCIsIlRheFByaWNlX0JyZWFrZG93biI6Ijc1LjU5IiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiQkEiLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIyNTYuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiNzUuNTkiLCJUcmF2ZWxUaW1lIjoiUDBEVDE1SDQwTTBTIiwiQWlyU2VnbWVudF9LZXkiOiIrSXh0ZnRhZlRWQ3MySHRIV3VLSUpnPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiIwYXB5NjcyYlIxMmhrMVwvalU0ZWc1Zz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IkJBIiwiRmxpZ2h0TnVtYmVyIjoiODQ1MCIsIk9yaWdpbiI6IkFNUyIsIkRlc3RpbmF0aW9uIjoiTENZIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMDc6MDA6MDAuMDAwKzAyOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA0LTMwVDA3OjA1OjAwLjAwMCswMTowMCIsIkZsaWdodFRpbWUiOiI2NSIsIkRpc3RhbmNlIjoiMjExIiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiJFOTAiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUyIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJKNHxDNHxENHxSM3xJMHxZOXxCOXxIOXxLOXxNOXxMOXxWOHxOMHxRMHxPMHxTMHxHMCIsIkZsaWdodERldGFpbF9LZXkiOiJENE5MdFpMOFN2MkZpc3pUc09XWldnPT0iLCJPcmlnaW5UZXJtaW5hbCI6IiIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiIiLCJCb29raW5nQ29kZSI6IlYiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiUzlxZ2F6ZWJRalNkRFwvYWo2YXkyS1E9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJTOXFnYXplYlFqU2REXC9hajZheTJLUT09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVGpFT0FqRU1lOHpKdXhQQ2xiR2xSOFVBWlFCTzZzTFwvbjBIYVNvaElzWlhFc2hOalZNcEtFOGFcL1d2Qlp6Z24xbllFSzliN2xCam10WWhDZkdrZzVZdDgxUHpBTkR2UjlIYmZKTWxRbEZBTlJXSFJlZXFFTlRQZm56N01ud29Yb2NMazYxYlM5Z2xGSjg0UnVFdUFcL2ZRSEEzeWFUIiwiRmFyZUJhc2lzIjoiVlYyQ08ifSx7IkFpclNlZ21lbnRfS2V5IjoiK0l4dGZ0YWZUVkNzMkh0SFd1S0lKZz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IkJBIiwiRmxpZ2h0TnVtYmVyIjoiNjgwIiwiT3JpZ2luIjoiTEhSIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxNzo0NTowMC4wMDArMDE6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMjM6NDA6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjIzNSIsIkRpc3RhbmNlIjoiMTU1NyIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIwIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjl8Qzd8RDR8Ujl8STd8WTl8Qjl8SDl8Szl8TTl8TDl8Vjl8Tjl8UTl8TzF8Uzl8RzkiLCJGbGlnaHREZXRhaWxfS2V5IjoiS1BMWktXSkpSdW1XSnpMZ3NHNHdoQT09IiwiT3JpZ2luVGVybWluYWwiOiI1IiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkkiLCJCb29raW5nQ29kZSI6Ik8iLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoianIzRmorV0lRTHFXalVTXC84VW9pVVE9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJqcjNGaitXSVFMcVdqVVNcLzhVb2lVUT09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHNzS2hEQU1cL0JpWit5UmRMZDdxcmhZRnFlQmp3Y3YrXC8yZHMybDRjeUlSa2hrbENDRXJwK0JLR0J4cjhtdmVBZEgyQUJMVmFqaE85YTdzeTNDQ2x4YlorZGQ5UUF4eE5TRVdzWFlvdCtpZ2dJcU5VSlFOMzRYWGVhNllnSDRUNWtHbWFyYVZoUEwxUWFMK3BPbHQ3MkV0XC9zVGttbEE9PSIsIkZhcmVCYXNpcyI6Ik9MVjJSTyJ9XSwiRmFyZXJ1bGVzcmVmX0tleSI6W1siUzlxZ2F6ZWJRalNkRFwvYWo2YXkyS1E9PSJdLFsianIzRmorV0lRTHFXalVTXC84VW9pVVE9PSJdXSwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjpbWyIxRyJdLFsiMUciXV0sIkZhcmVydWxlc3JlZl9jb250ZW50IjpbWyJnd3MtZUp4TlRqRU9BakVNZTh6SnV4UENsYkdsUjhVQVpRQk82c0xcL24wSGFTb2hJc1pYRXNoTmpWTXBLRThhXC9XdkJaemduMW5ZRUs5YjdsQmptdFloQ2ZHa2c1WXQ4MVB6QU5EdlI5SGJmSk1sUWxGQU5SV0hSZWVxRU5UUGZuejdNbndvWG9jTGs2MWJTOWdsRko4NFJ1RXVBXC9mUUhBM3lhVCJdLFsiZ3dzLWVKeE5Uc3NLaERBTVwvQmlaK3lSZExkN3FyaFlGcWVCandjditcLzJkczJsNGN5SVJraGtsQ0NFcnArQktHQnhyOG12ZUFkSDJBQkxWYWpoTzlhN3N5M0NDbHhiWitkZDlRQXh4TlNFV3NYWW90K2lnZ0lxTlVKUU4zNFhYZWE2WWdINFQ1a0dtYXJhVmhQTDFRYUwrcE9sdDcyRXRcL3NUa21sQT09Il1dfQ==" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F3315916" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012317" data-airline="JAT Jugoslovenski Aerotransport" data-arrive="765" data-duration="285" data-stops="1" data-depature="480" data-airlinecode="JU" data-price="334.53" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF3345317" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/JU.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>10:00 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>15:45 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">4h 45m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse17" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="InNRNzdXWkMrUk0yeUppYUdZQ25TZWc9PXxLS3wxR3xLS3xnd3MtZUp4TlRzc093akFNKzVqSmQ2ZHJnV01IM1VBOGNnQjIySVhcL1wvd3pjVmtKWWNxd2tscE9jYzZEdEdJMzVEd00rdzNXRnJ5ZkFFY1RqZkVaSWRvZ3dkUnRJUzdnOTMzNUhEeGlwdWJkZFYydXVrc29JWXJHRmZWT0JyZFhwOGZwbDFvdVFFYlhNRjRsUFJlbEdNb3BKNHozMDB4ZlFhQ2J3fEtLfHxWVnxzUTc3V1pDK1JNMnlKaWFHWUNuU2VnPT18S0t8MUd8S0t8Z3dzLWVKeE5Uc3NPd2pBTSs1akpkNmRyZ1dNSDNVQThjZ0IyMklYXC9cL3d6Y1ZrSlljcXdrbHBPY2M2RHRHSTM1RHdNK3czV0ZyeWZBRWNUamZFWklkb2d3ZFJ0SVM3ZzkzMzVIRHhpcHViZGRWMnV1a3NvSVlyR0ZmVk9CcmRYcDhmcGwxb3VRRWJYTUY0bFBSZWxHTW9wSjR6MzAweGZRYUNid3xLS3x3Z0hMRG92RlRUMmJLWnNZMWpUTnNRPT18S0t8MUd8S0t8Z3dzLWVKeE5UanNPaFRBTU93enk3cFFXeEZaNGxOXC9RZ1pcL0V3djJQOGRKMklWSnN4YzdQZTI4b0RhM1FmNkxDVzIwWDR2VURJb3ptZXB4dzFqQVhEMGh4dVBkelAxRG1hNm9lczFkWWN0ZllCUU5pa29uRlNZRW40eERtc2xLUTdrSDdrQ0FzU3JFZmRibVF0SnBPNVJiNjBSK2JMQ2F6fEtLfHxWVnx8QHwyIg==" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">334.53</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook17" id="F3345317" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiMDVjeDN4a1VTM0dEbFNLTitlckh4dz09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjMzNC41MyIsIkJhc2VQcmljZSI6IjI4MC4wMCIsIlRheGVzIjoiNTQuNTMiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjMzNC41MyIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjI4MC4wMCIsIlRheFByaWNlX0JyZWFrZG93biI6IjU0LjUzIiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiSlUiLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIyODAuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiNTQuNTMiLCJUcmF2ZWxUaW1lIjoiUDBEVDRINDVNMFMiLCJBaXJTZWdtZW50X0tleSI6ImxyRkdnRmZ0VExtckpDaFdLR1RUXC9nPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiJEV3A5RWkyZVFMMjFSRlwvdWlmUkhLdz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IkpVIiwiRmxpZ2h0TnVtYmVyIjoiMzYxIiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJCRUciLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxMDowMDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTI6MTU6MDAuMDAwKzAyOjAwIiwiRmxpZ2h0VGltZSI6IjEzNSIsIkRpc3RhbmNlIjoiODc1IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMTkiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IkNhY2hlZCBzdGF0dXMgdXNlZC4gUG9sbGVkIGF2YWlsIGV4aXN0cyIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlAiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjd8QzV8RDV8VzR8STJ8WTd8QjR8SDN8SzN8TTB8UTB8TDB8VjB8VTB8RTB8VDB8RzB8TjB8UzAiLCJGbGlnaHREZXRhaWxfS2V5Ijoib09VS2hMTHJUdXU4MmsxUUtPZEdzdz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiMiIsIkJvb2tpbmdDb2RlIjoiSyIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJzUTc3V1pDK1JNMnlKaWFHWUNuU2VnPT0iLCJGYXJlcnVsZXNyZWZfS2V5Ijoic1E3N1daQytSTTJ5SmlhR1lDblNlZz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHNzT3dqQU0rNWpKZDZkcmdXTUgzVUE4Y2dCMjJJWFwvXC93emNWa0pZY3F3a2xwT2NjNkR0R0kzNUR3TSt3M1dGcnlmQUVjVGpmRVpJZG9nd2RSdElTN2c5MzM1SER4aXB1YmRkVjJ1dWtzb0lZckdGZlZPQnJkWHA4ZnBsMW91UUViWE1GNGxQUmVsR01vcEo0ejMwMHhmUWFDYnciLCJGYXJlQmFzaXMiOiJLUlROTCJ9LHsiQWlyU2VnbWVudF9LZXkiOiJsckZHZ0ZmdFRMbXJKQ2hXS0dUVFwvZz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IkpVIiwiRmxpZ2h0TnVtYmVyIjoiNTUyIiwiT3JpZ2luIjoiQkVHIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxMzoxMDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTU6NDU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6Ijk1IiwiRGlzdGFuY2UiOiI1MTgiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjMxOSIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiQ2FjaGVkIHN0YXR1cyB1c2VkLiBQb2xsZWQgYXZhaWwgZXhpc3RzIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUCIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJKOHxDNnxENnxXNXxJMnxZOXxCOXxIOXxLOXxNOXxROXxMOXxWOXxVOXxFOXxUOXxHMHxONXxTNSIsIkZsaWdodERldGFpbF9LZXkiOiJHb3M3M1FMU1FlU2M5dWZwMHEraG9BPT0iLCJPcmlnaW5UZXJtaW5hbCI6IjIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiViIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJ3Z0hMRG92RlRUMmJLWnNZMWpUTnNRPT0iLCJGYXJlcnVsZXNyZWZfS2V5Ijoid2dITERvdkZUVDJiS1pzWTFqVE5zUT09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVGpzT2hUQU1Pd3p5N3BRV3hGWjRsTlwvUWdaXC9Fd3YyUDhkSjJJVkpzeGM3UGUyOG9EYTNRZjZMQ1cyMFg0dlVESW96bWVweHcxakFYRDBoeHVQZHpQMURtYTZvZXMxZFljdGZZQlFOaWtvbkZTWUVuNHhEbXNsS1E3a0g3a0NBc1NyRWZkYm1RdEpwTzVSYjYwUitiTENheiIsIkZhcmVCYXNpcyI6IlZSVFJTIn1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJzUTc3V1pDK1JNMnlKaWFHWUNuU2VnPT0iXSxbIndnSExEb3ZGVFQyYktac1kxalROc1E9PSJdXSwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjpbWyIxRyJdLFsiMUciXV0sIkZhcmVydWxlc3JlZl9jb250ZW50IjpbWyJnd3MtZUp4TlRzc093akFNKzVqSmQ2ZHJnV01IM1VBOGNnQjIySVhcL1wvd3pjVmtKWWNxd2tscE9jYzZEdEdJMzVEd00rdzNXRnJ5ZkFFY1RqZkVaSWRvZ3dkUnRJUzdnOTMzNUhEeGlwdWJkZFYydXVrc29JWXJHRmZWT0JyZFhwOGZwbDFvdVFFYlhNRjRsUFJlbEdNb3BKNHozMDB4ZlFhQ2J3Il0sWyJnd3MtZUp4TlRqc09oVEFNT3d6eTdwUVd4Rlo0bE5cL1FnWlwvRXd2MlA4ZEoySVZKc3hjN1BlMjhvRGEzUWY2TENXMjBYNHZVRElvem1lcHh3MWpBWEQwaHh1UGR6UDFEbWE2b2VzMWRZY3RmWUJRTmlrb25GU1lFbjR4RG1zbEtRN2tIN2tDQXNTckVmZGJtUXRKcE81UmI2MFIrYkxDYXoiXV19" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F3345317" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse17" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        10:00 AM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        12:15 PM <br>
                        <span> Belgrade Beograd Arpt BEG</span>
                      </li>
                      <li class="rfms_emirates">
                        JAT Jugoslovenski Aerotransport<br>
                        <span>JU-319</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>2h 15m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Belgrade Beograd Arpt, | <strong>Layover:: 0h 55m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        1:10 PM <br>
                        <span>Belgrade Beograd Arpt BEG</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        3:45 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        JAT Jugoslovenski Aerotransport<br>
                        <span>JU-319</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>1h 35m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 4h 45m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">334.53</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook17" id="F3345317" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiMDVjeDN4a1VTM0dEbFNLTitlckh4dz09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjMzNC41MyIsIkJhc2VQcmljZSI6IjI4MC4wMCIsIlRheGVzIjoiNTQuNTMiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjMzNC41MyIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjI4MC4wMCIsIlRheFByaWNlX0JyZWFrZG93biI6IjU0LjUzIiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiSlUiLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIyODAuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiNTQuNTMiLCJUcmF2ZWxUaW1lIjoiUDBEVDRINDVNMFMiLCJBaXJTZWdtZW50X0tleSI6ImxyRkdnRmZ0VExtckpDaFdLR1RUXC9nPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiJEV3A5RWkyZVFMMjFSRlwvdWlmUkhLdz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IkpVIiwiRmxpZ2h0TnVtYmVyIjoiMzYxIiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJCRUciLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxMDowMDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTI6MTU6MDAuMDAwKzAyOjAwIiwiRmxpZ2h0VGltZSI6IjEzNSIsIkRpc3RhbmNlIjoiODc1IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMTkiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IkNhY2hlZCBzdGF0dXMgdXNlZC4gUG9sbGVkIGF2YWlsIGV4aXN0cyIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlAiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjd8QzV8RDV8VzR8STJ8WTd8QjR8SDN8SzN8TTB8UTB8TDB8VjB8VTB8RTB8VDB8RzB8TjB8UzAiLCJGbGlnaHREZXRhaWxfS2V5Ijoib09VS2hMTHJUdXU4MmsxUUtPZEdzdz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiMiIsIkJvb2tpbmdDb2RlIjoiSyIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJzUTc3V1pDK1JNMnlKaWFHWUNuU2VnPT0iLCJGYXJlcnVsZXNyZWZfS2V5Ijoic1E3N1daQytSTTJ5SmlhR1lDblNlZz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHNzT3dqQU0rNWpKZDZkcmdXTUgzVUE4Y2dCMjJJWFwvXC93emNWa0pZY3F3a2xwT2NjNkR0R0kzNUR3TSt3M1dGcnlmQUVjVGpmRVpJZG9nd2RSdElTN2c5MzM1SER4aXB1YmRkVjJ1dWtzb0lZckdGZlZPQnJkWHA4ZnBsMW91UUViWE1GNGxQUmVsR01vcEo0ejMwMHhmUWFDYnciLCJGYXJlQmFzaXMiOiJLUlROTCJ9LHsiQWlyU2VnbWVudF9LZXkiOiJsckZHZ0ZmdFRMbXJKQ2hXS0dUVFwvZz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IkpVIiwiRmxpZ2h0TnVtYmVyIjoiNTUyIiwiT3JpZ2luIjoiQkVHIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxMzoxMDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTU6NDU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6Ijk1IiwiRGlzdGFuY2UiOiI1MTgiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjMxOSIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiQ2FjaGVkIHN0YXR1cyB1c2VkLiBQb2xsZWQgYXZhaWwgZXhpc3RzIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUCIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJKOHxDNnxENnxXNXxJMnxZOXxCOXxIOXxLOXxNOXxROXxMOXxWOXxVOXxFOXxUOXxHMHxONXxTNSIsIkZsaWdodERldGFpbF9LZXkiOiJHb3M3M1FMU1FlU2M5dWZwMHEraG9BPT0iLCJPcmlnaW5UZXJtaW5hbCI6IjIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiViIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJ3Z0hMRG92RlRUMmJLWnNZMWpUTnNRPT0iLCJGYXJlcnVsZXNyZWZfS2V5Ijoid2dITERvdkZUVDJiS1pzWTFqVE5zUT09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVGpzT2hUQU1Pd3p5N3BRV3hGWjRsTlwvUWdaXC9Fd3YyUDhkSjJJVkpzeGM3UGUyOG9EYTNRZjZMQ1cyMFg0dlVESW96bWVweHcxakFYRDBoeHVQZHpQMURtYTZvZXMxZFljdGZZQlFOaWtvbkZTWUVuNHhEbXNsS1E3a0g3a0NBc1NyRWZkYm1RdEpwTzVSYjYwUitiTENheiIsIkZhcmVCYXNpcyI6IlZSVFJTIn1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJzUTc3V1pDK1JNMnlKaWFHWUNuU2VnPT0iXSxbIndnSExEb3ZGVFQyYktac1kxalROc1E9PSJdXSwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjpbWyIxRyJdLFsiMUciXV0sIkZhcmVydWxlc3JlZl9jb250ZW50IjpbWyJnd3MtZUp4TlRzc093akFNKzVqSmQ2ZHJnV01IM1VBOGNnQjIySVhcL1wvd3pjVmtKWWNxd2tscE9jYzZEdEdJMzVEd00rdzNXRnJ5ZkFFY1RqZkVaSWRvZ3dkUnRJUzdnOTMzNUhEeGlwdWJkZFYydXVrc29JWXJHRmZWT0JyZFhwOGZwbDFvdVFFYlhNRjRsUFJlbEdNb3BKNHozMDB4ZlFhQ2J3Il0sWyJnd3MtZUp4TlRqc09oVEFNT3d6eTdwUVd4Rlo0bE5cL1FnWlwvRXd2MlA4ZEoySVZKc3hjN1BlMjhvRGEzUWY2TENXMjBYNHZVRElvem1lcHh3MWpBWEQwaHh1UGR6UDFEbWE2b2VzMWRZY3RmWUJRTmlrb25GU1lFbjR4RG1zbEtRN2tIN2tDQXNTckVmZGJtUXRKcE81UmI2MFIrYkxDYXoiXV19" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F3345317" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012318" data-airline="SWISS" data-arrive="825" data-duration="350" data-stops="1" data-depature="475" data-airlinecode="LX" data-price="360.40" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF3604018" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/LX.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>09:55 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>16:45 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">5h 50m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse18" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="ImoyaENHamloVFJpR05pOEN0QTRzVXc9PXxLS3wxR3xLS3xnd3MtZUp4TlRzc09nekFNK3hqa3U5TUhHN2NpNkdBVDlFSW5qY3YrXC96TklXMmxhcE5oS2JEa0pJUmhLVHljTWY5WGgyMjBmcFBjRUpCanQ1NUZobkpNN1JLY1RwSGpzZnRpV1BLQkZXS3FTcXRwWXFtXC95czRDSTlpRk5LWVd6NHJnZnY5UnlFMnBFZ2JncXBYSE84WldGZEwwbGRYMkRmblVCSnh3bmhnPT18S0t8fFZWfHxAfDEi" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">360.40</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook18" id="F3604018" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiRXFadVBcLzVzU3VlTHZERnFvNmt0bmc9PSIsIkNvbXBsZXRlSXRpbmVyYXJ5IjoiIiwiQ29ubmVjdGlvbnMiOiIwLCIsIlRvdGFsUHJpY2UiOiIzNjAuNDAiLCJCYXNlUHJpY2UiOiIyMjMuMDAiLCJUYXhlcyI6IjEzNy40MCIsIlRvdGFsUHJpY2VfQVBJIjoiRVVSMzYwLjQwIiwiQVBJQ3VycmVuY3lUeXBlIjoiRVVSIiwiU0lURUN1cnJlbmN5VHlwZSI6IkVVUiIsIk15TWFya3VwIjowLCJhTWFya3VwIjowLCJCYXNlUHJpY2VfQnJlYWtkb3duIjoiMjIzLjAwIiwiVGF4UHJpY2VfQnJlYWtkb3duIjoiMTM3LjQwIiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiTFgiLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIyMjMuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiMTM3LjQwIiwiVHJhdmVsVGltZSI6IlAwRFQ1SDUwTTBTIiwiQWlyU2VnbWVudF9LZXkiOiJOT1JBeStEMVJqdVpSRlRcL3d1UXh5Zz09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoibUNTV2xjK25UWG1NOFMzaUx3VVhrUT09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IkxYIiwiRmxpZ2h0TnVtYmVyIjoiNzI1IiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJaUkgiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQwOTo1NTowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTE6MjA6MDAuMDAwKzAyOjAwIiwiRmxpZ2h0VGltZSI6Ijg1IiwiRGlzdGFuY2UiOiIzNzUiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjMyMCIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6Iko5fEM5fEQ4fFo2fFA2fFk5fEI5fE05fFU5fEg5fFE5fFY5fFc5fFMwfFQwfEUwfEwwfEswIiwiRmxpZ2h0RGV0YWlsX0tleSI6InlUR3k4U29MU0xPSkVSN1A4SVRaS3c9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IiIsIkJvb2tpbmdDb2RlIjoiTSIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJqMmhDR2ppaFRSaUdOaThDdEE0c1V3PT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiajJoQ0dqaWhUUmlHTmk4Q3RBNHNVdz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHNzT2d6QU0reGprdTlNSEc3Y2k2R0FUOUVJbmpjditcL3pOSVcybGFwTmhLYkRrSklSaEtUeWNNZjlYaDIyMGZwUGNFSkJqdDU1RmhuSk03UktjVHBIanNmdGlXUEtCRldLcVNxdHBZcW1cL3lzNENJOWlGTktZV3o0cmdmdjlSeUUycEVnYmdxcFhITzhaV0ZkTDBsZFgyRGZuVUJKeHduaGc9PSIsIkZhcmVCYXNpcyI6Ik01OUxHVDkifSx7IkFpclNlZ21lbnRfS2V5IjoiTk9SQXkrRDFSanVaUkZUXC93dVF4eWc9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJMWCIsIkZsaWdodE51bWJlciI6IjE4MDQiLCJPcmlnaW4iOiJaUkgiLCJEZXN0aW5hdGlvbiI6IklTVCIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDEzOjAwOjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQxNjo0NTowMC4wMDArMDM6MDAiLCJGbGlnaHRUaW1lIjoiMTY1IiwiRGlzdGFuY2UiOiIxMTA3IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMTkiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUyIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJKOXxDOXxEOHxaNnxQNnxZOXxCOXxNOXxVOXxIOXxROXxWOXxXOXxTMHxUMHxFMHxMMHxLMCIsIkZsaWdodERldGFpbF9LZXkiOiI5TCt6b0dOcFExYUJJVWtXbG1XXC9Ddz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiTSIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJqMmhDR2ppaFRSaUdOaThDdEE0c1V3PT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiajJoQ0dqaWhUUmlHTmk4Q3RBNHNVdz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHNzT2d6QU0reGprdTlNSEc3Y2k2R0FUOUVJbmpjditcL3pOSVcybGFwTmhLYkRrSklSaEtUeWNNZjlYaDIyMGZwUGNFSkJqdDU1RmhuSk03UktjVHBIanNmdGlXUEtCRldLcVNxdHBZcW1cL3lzNENJOWlGTktZV3o0cmdmdjlSeUUycEVnYmdxcFhITzhaV0ZkTDBsZFgyRGZuVUJKeHduaGc9PSIsIkZhcmVCYXNpcyI6Ik01OUxHVDkifV0sIkZhcmVydWxlc3JlZl9LZXkiOltbImoyaENHamloVFJpR05pOEN0QTRzVXc9PSJdLFsiajJoQ0dqaWhUUmlHTmk4Q3RBNHNVdz09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl0sWyIxRyJdXSwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOltbImd3cy1lSnhOVHNzT2d6QU0reGprdTlNSEc3Y2k2R0FUOUVJbmpjditcL3pOSVcybGFwTmhLYkRrSklSaEtUeWNNZjlYaDIyMGZwUGNFSkJqdDU1RmhuSk03UktjVHBIanNmdGlXUEtCRldLcVNxdHBZcW1cL3lzNENJOWlGTktZV3o0cmdmdjlSeUUycEVnYmdxcFhITzhaV0ZkTDBsZFgyRGZuVUJKeHduaGc9PSJdLFsiZ3dzLWVKeE5Uc3NPZ3pBTSt4amt1OU1IRzdjaTZHQVQ5RUluamN2K1wvek5JVzJsYXBOaEtiRGtKSVJoS1R5Y01mOVhoMjIwZnBQY0VKQmp0NTVGaG5KTTdSS2NUcEhqc2Z0aVdQS0JGV0txU3F0cFlxbVwveXM0Q0k5aUZOS1lXejRyZ2Z2OVJ5RTJwRWdiZ3FwWEhPOFpXRmRMMGxkWDJEZm5VQkp4d25oZz09Il1dfQ==" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F3604018" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse18" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        9:55 AM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        11:20 AM <br>
                        <span> Zurich Airport ZRH</span>
                      </li>
                      <li class="rfms_emirates">
                        SWISS<br>
                        <span>LX-320</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>1h 25m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Zurich Airport, | <strong>Layover:: 1h 40m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        1:00 PM <br>
                        <span>Zurich Airport ZRH</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        4:45 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        SWISS<br>
                        <span>LX-319</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>2h 45m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 5h 50m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">360.40</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook18" id="F3604018" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiRXFadVBcLzVzU3VlTHZERnFvNmt0bmc9PSIsIkNvbXBsZXRlSXRpbmVyYXJ5IjoiIiwiQ29ubmVjdGlvbnMiOiIwLCIsIlRvdGFsUHJpY2UiOiIzNjAuNDAiLCJCYXNlUHJpY2UiOiIyMjMuMDAiLCJUYXhlcyI6IjEzNy40MCIsIlRvdGFsUHJpY2VfQVBJIjoiRVVSMzYwLjQwIiwiQVBJQ3VycmVuY3lUeXBlIjoiRVVSIiwiU0lURUN1cnJlbmN5VHlwZSI6IkVVUiIsIk15TWFya3VwIjowLCJhTWFya3VwIjowLCJCYXNlUHJpY2VfQnJlYWtkb3duIjoiMjIzLjAwIiwiVGF4UHJpY2VfQnJlYWtkb3duIjoiMTM3LjQwIiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiTFgiLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIyMjMuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiMTM3LjQwIiwiVHJhdmVsVGltZSI6IlAwRFQ1SDUwTTBTIiwiQWlyU2VnbWVudF9LZXkiOiJOT1JBeStEMVJqdVpSRlRcL3d1UXh5Zz09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoibUNTV2xjK25UWG1NOFMzaUx3VVhrUT09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IkxYIiwiRmxpZ2h0TnVtYmVyIjoiNzI1IiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJaUkgiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQwOTo1NTowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTE6MjA6MDAuMDAwKzAyOjAwIiwiRmxpZ2h0VGltZSI6Ijg1IiwiRGlzdGFuY2UiOiIzNzUiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjMyMCIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6Iko5fEM5fEQ4fFo2fFA2fFk5fEI5fE05fFU5fEg5fFE5fFY5fFc5fFMwfFQwfEUwfEwwfEswIiwiRmxpZ2h0RGV0YWlsX0tleSI6InlUR3k4U29MU0xPSkVSN1A4SVRaS3c9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IiIsIkJvb2tpbmdDb2RlIjoiTSIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJqMmhDR2ppaFRSaUdOaThDdEE0c1V3PT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiajJoQ0dqaWhUUmlHTmk4Q3RBNHNVdz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHNzT2d6QU0reGprdTlNSEc3Y2k2R0FUOUVJbmpjditcL3pOSVcybGFwTmhLYkRrSklSaEtUeWNNZjlYaDIyMGZwUGNFSkJqdDU1RmhuSk03UktjVHBIanNmdGlXUEtCRldLcVNxdHBZcW1cL3lzNENJOWlGTktZV3o0cmdmdjlSeUUycEVnYmdxcFhITzhaV0ZkTDBsZFgyRGZuVUJKeHduaGc9PSIsIkZhcmVCYXNpcyI6Ik01OUxHVDkifSx7IkFpclNlZ21lbnRfS2V5IjoiTk9SQXkrRDFSanVaUkZUXC93dVF4eWc9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJMWCIsIkZsaWdodE51bWJlciI6IjE4MDQiLCJPcmlnaW4iOiJaUkgiLCJEZXN0aW5hdGlvbiI6IklTVCIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDEzOjAwOjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQxNjo0NTowMC4wMDArMDM6MDAiLCJGbGlnaHRUaW1lIjoiMTY1IiwiRGlzdGFuY2UiOiIxMTA3IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMTkiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUyIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJKOXxDOXxEOHxaNnxQNnxZOXxCOXxNOXxVOXxIOXxROXxWOXxXOXxTMHxUMHxFMHxMMHxLMCIsIkZsaWdodERldGFpbF9LZXkiOiI5TCt6b0dOcFExYUJJVWtXbG1XXC9Ddz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiTSIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJqMmhDR2ppaFRSaUdOaThDdEE0c1V3PT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiajJoQ0dqaWhUUmlHTmk4Q3RBNHNVdz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHNzT2d6QU0reGprdTlNSEc3Y2k2R0FUOUVJbmpjditcL3pOSVcybGFwTmhLYkRrSklSaEtUeWNNZjlYaDIyMGZwUGNFSkJqdDU1RmhuSk03UktjVHBIanNmdGlXUEtCRldLcVNxdHBZcW1cL3lzNENJOWlGTktZV3o0cmdmdjlSeUUycEVnYmdxcFhITzhaV0ZkTDBsZFgyRGZuVUJKeHduaGc9PSIsIkZhcmVCYXNpcyI6Ik01OUxHVDkifV0sIkZhcmVydWxlc3JlZl9LZXkiOltbImoyaENHamloVFJpR05pOEN0QTRzVXc9PSJdLFsiajJoQ0dqaWhUUmlHTmk4Q3RBNHNVdz09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl0sWyIxRyJdXSwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOltbImd3cy1lSnhOVHNzT2d6QU0reGprdTlNSEc3Y2k2R0FUOUVJbmpjditcL3pOSVcybGFwTmhLYkRrSklSaEtUeWNNZjlYaDIyMGZwUGNFSkJqdDU1RmhuSk03UktjVHBIanNmdGlXUEtCRldLcVNxdHBZcW1cL3lzNENJOWlGTktZV3o0cmdmdjlSeUUycEVnYmdxcFhITzhaV0ZkTDBsZFgyRGZuVUJKeHduaGc9PSJdLFsiZ3dzLWVKeE5Uc3NPZ3pBTSt4amt1OU1IRzdjaTZHQVQ5RUluamN2K1wvek5JVzJsYXBOaEtiRGtKSVJoS1R5Y01mOVhoMjIwZnBQY0VKQmp0NTVGaG5KTTdSS2NUcEhqc2Z0aVdQS0JGV0txU3F0cFlxbVwveXM0Q0k5aUZOS1lXejRyZ2Z2OVJ5RTJwRWdiZ3FwWEhPOFpXRmRMMGxkWDJEZm5VQkp4d25oZz09Il1dfQ==" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F3604018" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012319" data-airline="Lufthansa Airlines" data-arrive="830" data-duration="335" data-stops="1" data-depature="495" data-airlinecode="LH" data-price="361.30" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF3613019" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/LH.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>10:15 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>16:50 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">5h 35m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse19" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="ImtPSytHRFFTVDNXZzZJbFdzanp0dEE9PXxLS3wxR3xLS3xnd3MtZUp4TlRrRU93ekFJZTB6bE85Q3dMcmRVVGRkdVNuTnBkdWhsXC8zXC9HU0NKTlE4SVcyREtFRUlUNFJvNHBcL05XQXo1QjI1UGNDWklqMTh5d1FSM2NQdHVrQ0VTc085V2tySGoxaUpGTnlVenR6ODhWeG1VQ0lcL0pDdTFNTFZjRDdPWDJxOUNUT2l3cm9iNVRtV3RMMkV5SW1xMm5xQ2ZmVUZJTlVuY3c9PXxLS3x8VlZ8fEB8MSI=" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">361.30</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook19" id="F3613019" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiY2R6ZTJrZEZUaGVqVThQaVwvVGRLSHc9PSIsIkNvbXBsZXRlSXRpbmVyYXJ5IjoiIiwiQ29ubmVjdGlvbnMiOiIwLCIsIlRvdGFsUHJpY2UiOiIzNjEuMzAiLCJCYXNlUHJpY2UiOiIyMjAuMDAiLCJUYXhlcyI6IjE0MS4zMCIsIlRvdGFsUHJpY2VfQVBJIjoiRVVSMzYxLjMwIiwiQVBJQ3VycmVuY3lUeXBlIjoiRVVSIiwiU0lURUN1cnJlbmN5VHlwZSI6IkVVUiIsIk15TWFya3VwIjowLCJhTWFya3VwIjowLCJCYXNlUHJpY2VfQnJlYWtkb3duIjoiMjIwLjAwIiwiVGF4UHJpY2VfQnJlYWtkb3duIjoiMTQxLjMwIiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiTEgiLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIyMjAuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiMTQxLjMwIiwiVHJhdmVsVGltZSI6IlAwRFQ1SDM1TTBTIiwiQWlyU2VnbWVudF9LZXkiOiJJdE1BdGlpY1JUZXBkazIzXC9sYUVTZz09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoiSkdScnJ5SElRaHlcL1NXY2twaUs2Q3c9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJMSCIsIkZsaWdodE51bWJlciI6Ijk4NyIsIk9yaWdpbiI6IkFNUyIsIkRlc3RpbmF0aW9uIjoiRlJBIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMTA6MTU6MDAuMDAwKzAyOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA0LTMwVDExOjI1OjAwLjAwMCswMjowMCIsIkZsaWdodFRpbWUiOiI3MCIsIkRpc3RhbmNlIjoiMjI4IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMjAiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUyIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJKN3xDN3xENnxaNXxQNXxZOXxCOXxNOXxVOXxIOXxROXxWOXxXNnxTMHxUMHxMMHxLMCIsIkZsaWdodERldGFpbF9LZXkiOiI5MjdKMlJxd1JzYWZjS005TmNzMWF3PT0iLCJPcmlnaW5UZXJtaW5hbCI6IiIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiIxIiwiQm9va2luZ0NvZGUiOiJNIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6ImtPSytHRFFTVDNXZzZJbFdzanp0dEE9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJrT0srR0RRU1QzV2c2SWxXc2p6dHRBPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Ua0VPd3pBSWUwemxPOUN3THJkVVRkZHVTbk5wZHVobFwvM1wvR1NDSk5ROElXMkRLRUVJVDRSbzRwXC9OV0F6NUIyNVBjQ1pJajE4eXdRUjNjUHR1a0NFU3NPOVdrckhqMWlKRk55VXp0ejg4VnhtVUNJXC9KQ3UxTUxWY0Q3T1gycTlDVE9pd3JvYjVUbVd0TDJFeUltcTJucUNmZlVGSU5VbmN3PT0iLCJGYXJlQmFzaXMiOiJNNTlMR1Q5In0seyJBaXJTZWdtZW50X0tleSI6Ikl0TUF0aWljUlRlcGRrMjNcL2xhRVNnPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiTEgiLCJGbGlnaHROdW1iZXIiOiIxMzAwIiwiT3JpZ2luIjoiRlJBIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxMjo1NTowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTY6NTA6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjE3NSIsIkRpc3RhbmNlIjoiMTE2OSIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIwIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjd8Qzd8RDZ8WjV8UDV8WTl8Qjl8TTl8VTl8SDl8UTl8Vjl8VzZ8UzB8VDB8TDB8SzAiLCJGbGlnaHREZXRhaWxfS2V5IjoiZitYc1JYWkpUZEtsWjFYd0lXU2o0Zz09IiwiT3JpZ2luVGVybWluYWwiOiIxIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkkiLCJCb29raW5nQ29kZSI6Ik0iLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoia09LK0dEUVNUM1dnNklsV3NqenR0QT09IiwiRmFyZXJ1bGVzcmVmX0tleSI6ImtPSytHRFFTVDNXZzZJbFdzanp0dEE9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRrRU93ekFJZTB6bE85Q3dMcmRVVGRkdVNuTnBkdWhsXC8zXC9HU0NKTlE4SVcyREtFRUlUNFJvNHBcL05XQXo1QjI1UGNDWklqMTh5d1FSM2NQdHVrQ0VTc085V2tySGoxaUpGTnlVenR6ODhWeG1VQ0lcL0pDdTFNTFZjRDdPWDJxOUNUT2l3cm9iNVRtV3RMMkV5SW1xMm5xQ2ZmVUZJTlVuY3c9PSIsIkZhcmVCYXNpcyI6Ik01OUxHVDkifV0sIkZhcmVydWxlc3JlZl9LZXkiOltbImtPSytHRFFTVDNXZzZJbFdzanp0dEE9PSJdLFsia09LK0dEUVNUM1dnNklsV3NqenR0QT09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl0sWyIxRyJdXSwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOltbImd3cy1lSnhOVGtFT3d6QUllMHpsTzlDd0xyZFVUZGR1U25OcGR1aGxcLzNcL0dTQ0pOUThJVzJES0VFSVQ0Um80cFwvTldBejVCMjVQY0NaSWoxOHl3UVIzY1B0dWtDRVNzTzlXa3JIajFpSkZOeVV6dHo4OFZ4bVVDSVwvSkN1MU1MVmNEN09YMnE5Q1RPaXdyb2I1VG1XdEwyRXlJbXEybnFDZmZVRklOVW5jdz09Il0sWyJnd3MtZUp4TlRrRU93ekFJZTB6bE85Q3dMcmRVVGRkdVNuTnBkdWhsXC8zXC9HU0NKTlE4SVcyREtFRUlUNFJvNHBcL05XQXo1QjI1UGNDWklqMTh5d1FSM2NQdHVrQ0VTc085V2tySGoxaUpGTnlVenR6ODhWeG1VQ0lcL0pDdTFNTFZjRDdPWDJxOUNUT2l3cm9iNVRtV3RMMkV5SW1xMm5xQ2ZmVUZJTlVuY3c9PSJdXX0=" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F3613019" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse19" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        10:15 AM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        11:25 AM <br>
                        <span> Frankfurt Intl FRA</span>
                      </li>
                      <li class="rfms_emirates">
                        Lufthansa Airlines<br>
                        <span>LH-320</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>1h 10m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Frankfurt Intl, | <strong>Layover:: 1h 30m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        12:55 PM <br>
                        <span>Frankfurt Intl FRA</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        4:50 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        Lufthansa Airlines<br>
                        <span>LH-320</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>2h 55m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 5h 35m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">361.30</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook19" id="F3613019" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiY2R6ZTJrZEZUaGVqVThQaVwvVGRLSHc9PSIsIkNvbXBsZXRlSXRpbmVyYXJ5IjoiIiwiQ29ubmVjdGlvbnMiOiIwLCIsIlRvdGFsUHJpY2UiOiIzNjEuMzAiLCJCYXNlUHJpY2UiOiIyMjAuMDAiLCJUYXhlcyI6IjE0MS4zMCIsIlRvdGFsUHJpY2VfQVBJIjoiRVVSMzYxLjMwIiwiQVBJQ3VycmVuY3lUeXBlIjoiRVVSIiwiU0lURUN1cnJlbmN5VHlwZSI6IkVVUiIsIk15TWFya3VwIjowLCJhTWFya3VwIjowLCJCYXNlUHJpY2VfQnJlYWtkb3duIjoiMjIwLjAwIiwiVGF4UHJpY2VfQnJlYWtkb3duIjoiMTQxLjMwIiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiTEgiLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIyMjAuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiMTQxLjMwIiwiVHJhdmVsVGltZSI6IlAwRFQ1SDM1TTBTIiwiQWlyU2VnbWVudF9LZXkiOiJJdE1BdGlpY1JUZXBkazIzXC9sYUVTZz09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoiSkdScnJ5SElRaHlcL1NXY2twaUs2Q3c9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJMSCIsIkZsaWdodE51bWJlciI6Ijk4NyIsIk9yaWdpbiI6IkFNUyIsIkRlc3RpbmF0aW9uIjoiRlJBIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMTA6MTU6MDAuMDAwKzAyOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA0LTMwVDExOjI1OjAwLjAwMCswMjowMCIsIkZsaWdodFRpbWUiOiI3MCIsIkRpc3RhbmNlIjoiMjI4IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMjAiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUyIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJKN3xDN3xENnxaNXxQNXxZOXxCOXxNOXxVOXxIOXxROXxWOXxXNnxTMHxUMHxMMHxLMCIsIkZsaWdodERldGFpbF9LZXkiOiI5MjdKMlJxd1JzYWZjS005TmNzMWF3PT0iLCJPcmlnaW5UZXJtaW5hbCI6IiIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiIxIiwiQm9va2luZ0NvZGUiOiJNIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6ImtPSytHRFFTVDNXZzZJbFdzanp0dEE9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJrT0srR0RRU1QzV2c2SWxXc2p6dHRBPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Ua0VPd3pBSWUwemxPOUN3THJkVVRkZHVTbk5wZHVobFwvM1wvR1NDSk5ROElXMkRLRUVJVDRSbzRwXC9OV0F6NUIyNVBjQ1pJajE4eXdRUjNjUHR1a0NFU3NPOVdrckhqMWlKRk55VXp0ejg4VnhtVUNJXC9KQ3UxTUxWY0Q3T1gycTlDVE9pd3JvYjVUbVd0TDJFeUltcTJucUNmZlVGSU5VbmN3PT0iLCJGYXJlQmFzaXMiOiJNNTlMR1Q5In0seyJBaXJTZWdtZW50X0tleSI6Ikl0TUF0aWljUlRlcGRrMjNcL2xhRVNnPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiTEgiLCJGbGlnaHROdW1iZXIiOiIxMzAwIiwiT3JpZ2luIjoiRlJBIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxMjo1NTowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTY6NTA6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjE3NSIsIkRpc3RhbmNlIjoiMTE2OSIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIwIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjd8Qzd8RDZ8WjV8UDV8WTl8Qjl8TTl8VTl8SDl8UTl8Vjl8VzZ8UzB8VDB8TDB8SzAiLCJGbGlnaHREZXRhaWxfS2V5IjoiZitYc1JYWkpUZEtsWjFYd0lXU2o0Zz09IiwiT3JpZ2luVGVybWluYWwiOiIxIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkkiLCJCb29raW5nQ29kZSI6Ik0iLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoia09LK0dEUVNUM1dnNklsV3NqenR0QT09IiwiRmFyZXJ1bGVzcmVmX0tleSI6ImtPSytHRFFTVDNXZzZJbFdzanp0dEE9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRrRU93ekFJZTB6bE85Q3dMcmRVVGRkdVNuTnBkdWhsXC8zXC9HU0NKTlE4SVcyREtFRUlUNFJvNHBcL05XQXo1QjI1UGNDWklqMTh5d1FSM2NQdHVrQ0VTc085V2tySGoxaUpGTnlVenR6ODhWeG1VQ0lcL0pDdTFNTFZjRDdPWDJxOUNUT2l3cm9iNVRtV3RMMkV5SW1xMm5xQ2ZmVUZJTlVuY3c9PSIsIkZhcmVCYXNpcyI6Ik01OUxHVDkifV0sIkZhcmVydWxlc3JlZl9LZXkiOltbImtPSytHRFFTVDNXZzZJbFdzanp0dEE9PSJdLFsia09LK0dEUVNUM1dnNklsV3NqenR0QT09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl0sWyIxRyJdXSwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOltbImd3cy1lSnhOVGtFT3d6QUllMHpsTzlDd0xyZFVUZGR1U25OcGR1aGxcLzNcL0dTQ0pOUThJVzJES0VFSVQ0Um80cFwvTldBejVCMjVQY0NaSWoxOHl3UVIzY1B0dWtDRVNzTzlXa3JIajFpSkZOeVV6dHo4OFZ4bVVDSVwvSkN1MU1MVmNEN09YMnE5Q1RPaXdyb2I1VG1XdEwyRXlJbXEybnFDZmZVRklOVW5jdz09Il0sWyJnd3MtZUp4TlRrRU93ekFJZTB6bE85Q3dMcmRVVGRkdVNuTnBkdWhsXC8zXC9HU0NKTlE4SVcyREtFRUlUNFJvNHBcL05XQXo1QjI1UGNDWklqMTh5d1FSM2NQdHVrQ0VTc085V2tySGoxaUpGTnlVenR6ODhWeG1VQ0lcL0pDdTFNTFZjRDdPWDJxOUNUT2l3cm9iNVRtV3RMMkV5SW1xMm5xQ2ZmVUZJTlVuY3c9PSJdXX0=" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F3613019" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012320" data-airline="JAT Jugoslovenski Aerotransport" data-arrive="635" data-duration="1595" data-stops="2" data-depature="480" data-airlinecode="JU" data-price="375.72" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF3757220" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/JU.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>10:00 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>13:35 (01 May, Sun 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">1d 2h 35m</span><br>
            <span class="fsa_departure">2 STOPS</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse20" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="InNRNzdXWkMrUk0yeUppYUdZQ25TZWc9PXxLS3wxR3xLS3xnd3MtZUp4TlRzc093akFNKzVqSmQ2ZHJnV01IM1VBOGNnQjIySVhcL1wvd3pjVmtKWWNxd2tscE9jYzZEdEdJMzVEd00rdzNXRnJ5ZkFFY1RqZkVaSWRvZ3dkUnRJUzdnOTMzNUhEeGlwdWJkZFYydXVrc29JWXJHRmZWT0JyZFhwOGZwbDFvdVFFYlhNRjRsUFJlbEdNb3BKNHozMDB4ZlFhQ2J3fEtLfHxWVnxzUTc3V1pDK1JNMnlKaWFHWUNuU2VnPT18S0t8MUd8S0t8Z3dzLWVKeE5Uc3NPd2pBTSs1akpkNmRyZ1dNSDNVQThjZ0IyMklYXC9cL3d6Y1ZrSlljcXdrbHBPY2M2RHRHSTM1RHdNK3czV0ZyeWZBRWNUamZFWklkb2d3ZFJ0SVM3ZzkzMzVIRHhpcHViZGRWMnV1a3NvSVlyR0ZmVk9CcmRYcDhmcGwxb3VRRWJYTUY0bFBSZWxHTW9wSjR6MzAweGZRYUNid3xLS3xENFUrQ2hXSFNnMmVUM3NpVXh1QTVnPT18S0t8MUd8S0t8Z3dzLWVKeE5UamtPZ0RBTWV3enk3cFFDWWl0SHVZUTZjQXdzXC9QOFpwTzFDcE5pS25jczVaeWcxcmREOW9zQmJiRGZDUFFBQlJuTTlMOVRHU2lvZWtGSmhQNjdqUko0dnFYcElYbVpKWFdQckRZaEpKbVluQnA2RXZaXC96U2tHOEIrMURCTDhvaFc3VTVVTFNhbFlxTjlDUFBwZ0tKcTA9fEtLfHxWVnx8QHwyIg==" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">375.72</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook20" id="F3757220" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiUnoxQjAza1lUbFdsTkJRQm85QmFqZz09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsMSwiLCJUb3RhbFByaWNlIjoiMzc1LjcyIiwiQmFzZVByaWNlIjoiMjg3LjAwIiwiVGF4ZXMiOiI4OC43MiIsIlRvdGFsUHJpY2VfQVBJIjoiRVVSMzc1LjcyIiwiQVBJQ3VycmVuY3lUeXBlIjoiRVVSIiwiU0lURUN1cnJlbmN5VHlwZSI6IkVVUiIsIk15TWFya3VwIjowLCJhTWFya3VwIjowLCJCYXNlUHJpY2VfQnJlYWtkb3duIjoiMjg3LjAwIiwiVGF4UHJpY2VfQnJlYWtkb3duIjoiODguNzIiLCJSZWZ1bmRhYmxlIjpmYWxzZSwiUGxhdGluZ0NhcnJpZXIiOiJKVSIsIkZhcmVUeXBlIjoiTm9uIFJlZnVuZGFibGUiLCJBbGxfUGFzc2VuZ2VyIjoiQURUIiwiQWR1bHRzIjoxLCJBZHVsdHNfQmFzZV9QcmljZSI6IjI4Ny4wMCIsIkFkdWx0c19UYXhfUHJpY2UiOiI4OC43MiIsIlRyYXZlbFRpbWUiOiJQMURUMkgzNU0wUyIsIkFpclNlZ21lbnRfS2V5IjoiQ3FjNUl4V25UTGFFTWNnNlRuWFwvclE9PSIsInNlZ21lbnRzIjpbeyJBaXJTZWdtZW50X0tleSI6IkRXcDlFaTJlUUwyMVJGXC91aWZSSEt3PT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiSlUiLCJGbGlnaHROdW1iZXIiOiIzNjEiLCJPcmlnaW4iOiJBTVMiLCJEZXN0aW5hdGlvbiI6IkJFRyIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDEwOjAwOjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQxMjoxNTowMC4wMDArMDI6MDAiLCJGbGlnaHRUaW1lIjoiMTM1IiwiRGlzdGFuY2UiOiI4NzUiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjMxOSIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiQ2FjaGVkIHN0YXR1cyB1c2VkLiBQb2xsZWQgYXZhaWwgZXhpc3RzIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUCIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJKN3xDNXxENXxXNHxJMnxZN3xCNHxIM3xLM3xNMHxRMHxMMHxWMHxVMHxFMHxUMHxHMHxOMHxTMCIsIkZsaWdodERldGFpbF9LZXkiOiJvT1VLaExMclR1dTgyazFRS09kR3N3PT0iLCJPcmlnaW5UZXJtaW5hbCI6IiIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiIyIiwiQm9va2luZ0NvZGUiOiJLIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6InNRNzdXWkMrUk0yeUppYUdZQ25TZWc9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJzUTc3V1pDK1JNMnlKaWFHWUNuU2VnPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Uc3NPd2pBTSs1akpkNmRyZ1dNSDNVQThjZ0IyMklYXC9cL3d6Y1ZrSlljcXdrbHBPY2M2RHRHSTM1RHdNK3czV0ZyeWZBRWNUamZFWklkb2d3ZFJ0SVM3ZzkzMzVIRHhpcHViZGRWMnV1a3NvSVlyR0ZmVk9CcmRYcDhmcGwxb3VRRWJYTUY0bFBSZWxHTW9wSjR6MzAweGZRYUNidyIsIkZhcmVCYXNpcyI6IktSVE5MIn0seyJBaXJTZWdtZW50X0tleSI6Ing3UGhPUDlyUnBDa3Z2XC9odkZkWW5BPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiSlUiLCJGbGlnaHROdW1iZXIiOiI1MzQiLCJPcmlnaW4iOiJCRUciLCJEZXN0aW5hdGlvbiI6IkZDTyIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDE4OjA1OjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQxOTozNTowMC4wMDArMDI6MDAiLCJGbGlnaHRUaW1lIjoiOTAiLCJEaXN0YW5jZSI6IjQ0OCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzE5IiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjd8QzR8RDR8VzR8STJ8WTl8Qjl8SDl8Szl8TTl8UTl8TDl8VjB8VTB8RTB8VDB8RzB8TjB8UzAiLCJGbGlnaHREZXRhaWxfS2V5IjoieFRyT0o3Z1wvUlB5MThtZGhFbytRUUE9PSIsIk9yaWdpblRlcm1pbmFsIjoiMiIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiIxIiwiQm9va2luZ0NvZGUiOiJMIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6IkQ0VStDaFdIU2cyZVQzc2lVeHVBNWc9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJENFUrQ2hXSFNnMmVUM3NpVXh1QTVnPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5UamtPZ0RBTWV3enk3cFFDWWl0SHVZUTZjQXdzXC9QOFpwTzFDcE5pS25jczVaeWcxcmREOW9zQmJiRGZDUFFBQlJuTTlMOVRHU2lvZWtGSmhQNjdqUko0dnFYcElYbVpKWFdQckRZaEpKbVluQnA2RXZaXC96U2tHOEIrMURCTDhvaFc3VTVVTFNhbFlxTjlDUFBwZ0tKcTA9IiwiRmFyZUJhc2lzIjoiTFJUUlMifSx7IkFpclNlZ21lbnRfS2V5IjoiQ3FjNUl4V25UTGFFTWNnNlRuWFwvclE9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJKVSIsIkZsaWdodE51bWJlciI6Ijg3ODgiLCJPcmlnaW4iOiJGQ08iLCJEZXN0aW5hdGlvbiI6IklTVCIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA1LTAxVDEwOjEwOjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNS0wMVQxMzozNTowMC4wMDArMDM6MDAiLCJGbGlnaHRUaW1lIjoiMTQ1IiwiRGlzdGFuY2UiOiI4NjQiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjMxOSIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6Iko5fEM5fEQ5fFc5fFk5fEI5fEg5fEs5fE05fFE5fEw5fFY5fFU5fEUwIiwiRmxpZ2h0RGV0YWlsX0tleSI6IitLVDNwVEhZU2N1MEpTTjRrQ0F6Nmc9PSIsIk9yaWdpblRlcm1pbmFsIjoiMSIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiJJIiwiQm9va2luZ0NvZGUiOiJMIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6IkQ0VStDaFdIU2cyZVQzc2lVeHVBNWc9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJENFUrQ2hXSFNnMmVUM3NpVXh1QTVnPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5UamtPZ0RBTWV3enk3cFFDWWl0SHVZUTZjQXdzXC9QOFpwTzFDcE5pS25jczVaeWcxcmREOW9zQmJiRGZDUFFBQlJuTTlMOVRHU2lvZWtGSmhQNjdqUko0dnFYcElYbVpKWFdQckRZaEpKbVluQnA2RXZaXC96U2tHOEIrMURCTDhvaFc3VTVVTFNhbFlxTjlDUFBwZ0tKcTA9IiwiRmFyZUJhc2lzIjoiTFJUUlMifV0sIkZhcmVydWxlc3JlZl9LZXkiOltbInNRNzdXWkMrUk0yeUppYUdZQ25TZWc9PSJdLFsiRDRVK0NoV0hTZzJlVDNzaVV4dUE1Zz09Il0sWyJENFUrQ2hXSFNnMmVUM3NpVXh1QTVnPT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXSxbIjFHIl0sWyIxRyJdXSwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOltbImd3cy1lSnhOVHNzT3dqQU0rNWpKZDZkcmdXTUgzVUE4Y2dCMjJJWFwvXC93emNWa0pZY3F3a2xwT2NjNkR0R0kzNUR3TSt3M1dGcnlmQUVjVGpmRVpJZG9nd2RSdElTN2c5MzM1SER4aXB1YmRkVjJ1dWtzb0lZckdGZlZPQnJkWHA4ZnBsMW91UUViWE1GNGxQUmVsR01vcEo0ejMwMHhmUWFDYnciXSxbImd3cy1lSnhOVGprT2dEQU1ld3p5N3BRQ1lpdEh1WVE2Y0F3c1wvUDhacE8xQ3BOaUtuY3M1WnlnMXJkRDlvc0JiYkRmQ1BRQUJSbk05TDlUR1Npb2VrRkpoUDY3alJKNHZxWHBJWG1aSlhXUHJEWWhKSm1ZbkJwNkV2WlwvelNrRzhCKzFEQkw4b2hXN1U1VUxTYWxZcU45Q1BQcGdLSnEwPSJdLFsiZ3dzLWVKeE5UamtPZ0RBTWV3enk3cFFDWWl0SHVZUTZjQXdzXC9QOFpwTzFDcE5pS25jczVaeWcxcmREOW9zQmJiRGZDUFFBQlJuTTlMOVRHU2lvZWtGSmhQNjdqUko0dnFYcElYbVpKWFdQckRZaEpKbVluQnA2RXZaXC96U2tHOEIrMURCTDhvaFc3VTVVTFNhbFlxTjlDUFBwZ0tKcTA9Il1dfQ==" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F3757220" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse20" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        10:00 AM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        12:15 PM <br>
                        <span> Belgrade Beograd Arpt BEG</span>
                      </li>
                      <li class="rfms_emirates">
                        JAT Jugoslovenski Aerotransport<br>
                        <span>JU-319</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>2h 15m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Belgrade Beograd Arpt, | <strong>Layover:: 5h 50m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        6:05 PM <br>
                        <span>Belgrade Beograd Arpt BEG</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        7:35 PM <br>
                        <span> Fiumicino Arpt FCO</span>
                      </li>
                      <li class="rfms_emirates">
                        JAT Jugoslovenski Aerotransport<br>
                        <span>JU-319</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>1h 30m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Fiumicino Arpt, | <strong>Layover:: 14h 35m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        10:10 AM <br>
                        <span>Fiumicino Arpt FCO</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        1:35 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        JAT Jugoslovenski Aerotransport<br>
                        <span>JU-319</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>2h 25m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 1d 2h 35m</span><br>
                        Arrival:<span class="color_secondry"> Sunday 01 May</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">375.72</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook20" id="F3757220" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiUnoxQjAza1lUbFdsTkJRQm85QmFqZz09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsMSwiLCJUb3RhbFByaWNlIjoiMzc1LjcyIiwiQmFzZVByaWNlIjoiMjg3LjAwIiwiVGF4ZXMiOiI4OC43MiIsIlRvdGFsUHJpY2VfQVBJIjoiRVVSMzc1LjcyIiwiQVBJQ3VycmVuY3lUeXBlIjoiRVVSIiwiU0lURUN1cnJlbmN5VHlwZSI6IkVVUiIsIk15TWFya3VwIjowLCJhTWFya3VwIjowLCJCYXNlUHJpY2VfQnJlYWtkb3duIjoiMjg3LjAwIiwiVGF4UHJpY2VfQnJlYWtkb3duIjoiODguNzIiLCJSZWZ1bmRhYmxlIjpmYWxzZSwiUGxhdGluZ0NhcnJpZXIiOiJKVSIsIkZhcmVUeXBlIjoiTm9uIFJlZnVuZGFibGUiLCJBbGxfUGFzc2VuZ2VyIjoiQURUIiwiQWR1bHRzIjoxLCJBZHVsdHNfQmFzZV9QcmljZSI6IjI4Ny4wMCIsIkFkdWx0c19UYXhfUHJpY2UiOiI4OC43MiIsIlRyYXZlbFRpbWUiOiJQMURUMkgzNU0wUyIsIkFpclNlZ21lbnRfS2V5IjoiQ3FjNUl4V25UTGFFTWNnNlRuWFwvclE9PSIsInNlZ21lbnRzIjpbeyJBaXJTZWdtZW50X0tleSI6IkRXcDlFaTJlUUwyMVJGXC91aWZSSEt3PT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiSlUiLCJGbGlnaHROdW1iZXIiOiIzNjEiLCJPcmlnaW4iOiJBTVMiLCJEZXN0aW5hdGlvbiI6IkJFRyIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDEwOjAwOjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQxMjoxNTowMC4wMDArMDI6MDAiLCJGbGlnaHRUaW1lIjoiMTM1IiwiRGlzdGFuY2UiOiI4NzUiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjMxOSIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiQ2FjaGVkIHN0YXR1cyB1c2VkLiBQb2xsZWQgYXZhaWwgZXhpc3RzIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUCIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJKN3xDNXxENXxXNHxJMnxZN3xCNHxIM3xLM3xNMHxRMHxMMHxWMHxVMHxFMHxUMHxHMHxOMHxTMCIsIkZsaWdodERldGFpbF9LZXkiOiJvT1VLaExMclR1dTgyazFRS09kR3N3PT0iLCJPcmlnaW5UZXJtaW5hbCI6IiIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiIyIiwiQm9va2luZ0NvZGUiOiJLIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6InNRNzdXWkMrUk0yeUppYUdZQ25TZWc9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJzUTc3V1pDK1JNMnlKaWFHWUNuU2VnPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Uc3NPd2pBTSs1akpkNmRyZ1dNSDNVQThjZ0IyMklYXC9cL3d6Y1ZrSlljcXdrbHBPY2M2RHRHSTM1RHdNK3czV0ZyeWZBRWNUamZFWklkb2d3ZFJ0SVM3ZzkzMzVIRHhpcHViZGRWMnV1a3NvSVlyR0ZmVk9CcmRYcDhmcGwxb3VRRWJYTUY0bFBSZWxHTW9wSjR6MzAweGZRYUNidyIsIkZhcmVCYXNpcyI6IktSVE5MIn0seyJBaXJTZWdtZW50X0tleSI6Ing3UGhPUDlyUnBDa3Z2XC9odkZkWW5BPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiSlUiLCJGbGlnaHROdW1iZXIiOiI1MzQiLCJPcmlnaW4iOiJCRUciLCJEZXN0aW5hdGlvbiI6IkZDTyIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDE4OjA1OjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQxOTozNTowMC4wMDArMDI6MDAiLCJGbGlnaHRUaW1lIjoiOTAiLCJEaXN0YW5jZSI6IjQ0OCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzE5IiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjd8QzR8RDR8VzR8STJ8WTl8Qjl8SDl8Szl8TTl8UTl8TDl8VjB8VTB8RTB8VDB8RzB8TjB8UzAiLCJGbGlnaHREZXRhaWxfS2V5IjoieFRyT0o3Z1wvUlB5MThtZGhFbytRUUE9PSIsIk9yaWdpblRlcm1pbmFsIjoiMiIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiIxIiwiQm9va2luZ0NvZGUiOiJMIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6IkQ0VStDaFdIU2cyZVQzc2lVeHVBNWc9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJENFUrQ2hXSFNnMmVUM3NpVXh1QTVnPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5UamtPZ0RBTWV3enk3cFFDWWl0SHVZUTZjQXdzXC9QOFpwTzFDcE5pS25jczVaeWcxcmREOW9zQmJiRGZDUFFBQlJuTTlMOVRHU2lvZWtGSmhQNjdqUko0dnFYcElYbVpKWFdQckRZaEpKbVluQnA2RXZaXC96U2tHOEIrMURCTDhvaFc3VTVVTFNhbFlxTjlDUFBwZ0tKcTA9IiwiRmFyZUJhc2lzIjoiTFJUUlMifSx7IkFpclNlZ21lbnRfS2V5IjoiQ3FjNUl4V25UTGFFTWNnNlRuWFwvclE9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJKVSIsIkZsaWdodE51bWJlciI6Ijg3ODgiLCJPcmlnaW4iOiJGQ08iLCJEZXN0aW5hdGlvbiI6IklTVCIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA1LTAxVDEwOjEwOjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNS0wMVQxMzozNTowMC4wMDArMDM6MDAiLCJGbGlnaHRUaW1lIjoiMTQ1IiwiRGlzdGFuY2UiOiI4NjQiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjMxOSIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6Iko5fEM5fEQ5fFc5fFk5fEI5fEg5fEs5fE05fFE5fEw5fFY5fFU5fEUwIiwiRmxpZ2h0RGV0YWlsX0tleSI6IitLVDNwVEhZU2N1MEpTTjRrQ0F6Nmc9PSIsIk9yaWdpblRlcm1pbmFsIjoiMSIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiJJIiwiQm9va2luZ0NvZGUiOiJMIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6IkQ0VStDaFdIU2cyZVQzc2lVeHVBNWc9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJENFUrQ2hXSFNnMmVUM3NpVXh1QTVnPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5UamtPZ0RBTWV3enk3cFFDWWl0SHVZUTZjQXdzXC9QOFpwTzFDcE5pS25jczVaeWcxcmREOW9zQmJiRGZDUFFBQlJuTTlMOVRHU2lvZWtGSmhQNjdqUko0dnFYcElYbVpKWFdQckRZaEpKbVluQnA2RXZaXC96U2tHOEIrMURCTDhvaFc3VTVVTFNhbFlxTjlDUFBwZ0tKcTA9IiwiRmFyZUJhc2lzIjoiTFJUUlMifV0sIkZhcmVydWxlc3JlZl9LZXkiOltbInNRNzdXWkMrUk0yeUppYUdZQ25TZWc9PSJdLFsiRDRVK0NoV0hTZzJlVDNzaVV4dUE1Zz09Il0sWyJENFUrQ2hXSFNnMmVUM3NpVXh1QTVnPT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXSxbIjFHIl0sWyIxRyJdXSwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOltbImd3cy1lSnhOVHNzT3dqQU0rNWpKZDZkcmdXTUgzVUE4Y2dCMjJJWFwvXC93emNWa0pZY3F3a2xwT2NjNkR0R0kzNUR3TSt3M1dGcnlmQUVjVGpmRVpJZG9nd2RSdElTN2c5MzM1SER4aXB1YmRkVjJ1dWtzb0lZckdGZlZPQnJkWHA4ZnBsMW91UUViWE1GNGxQUmVsR01vcEo0ejMwMHhmUWFDYnciXSxbImd3cy1lSnhOVGprT2dEQU1ld3p5N3BRQ1lpdEh1WVE2Y0F3c1wvUDhacE8xQ3BOaUtuY3M1WnlnMXJkRDlvc0JiYkRmQ1BRQUJSbk05TDlUR1Npb2VrRkpoUDY3alJKNHZxWHBJWG1aSlhXUHJEWWhKSm1ZbkJwNkV2WlwvelNrRzhCKzFEQkw4b2hXN1U1VUxTYWxZcU45Q1BQcGdLSnEwPSJdLFsiZ3dzLWVKeE5UamtPZ0RBTWV3enk3cFFDWWl0SHVZUTZjQXdzXC9QOFpwTzFDcE5pS25jczVaeWcxcmREOW9zQmJiRGZDUFFBQlJuTTlMOVRHU2lvZWtGSmhQNjdqUko0dnFYcElYbVpKWFdQckRZaEpKbVluQnA2RXZaXC96U2tHOEIrMURCTDhvaFc3VTVVTFNhbFlxTjlDUFBwZ0tKcTA9Il1dfQ==" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F3757220" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012321" data-airline="SWISS" data-arrive="825" data-duration="1180" data-stops="1" data-depature="1085" data-airlinecode="LX" data-price="376.48" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF3764821" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/LX.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>20:05 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>16:45 (01 May, Sun 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">19h 40m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse21" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="ImoyaENHamloVFJpR05pOEN0QTRzVXc9PXxLS3wxR3xLS3xnd3MtZUp4TlRzc09nekFNK3hqa3U5TUhHN2NpNkdBVDlFSW5qY3YrXC96TklXMmxhcE5oS2JEa0pJUmhLVHljTWY5WGgyMjBmcFBjRUpCanQ1NUZobkpNN1JLY1RwSGpzZnRpV1BLQkZXS3FTcXRwWXFtXC95czRDSTlpRk5LWVd6NHJnZnY5UnlFMnBFZ2JncXBYSE84WldGZEwwbGRYMkRmblVCSnh3bmhnPT18S0t8fFZWfHxAfDEi" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">376.48</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook21" id="F3764821" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiMkFDUkRZTHBRSFNtYWhkZ3lNc3pSQT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjM3Ni40OCIsIkJhc2VQcmljZSI6IjIyMy4wMCIsIlRheGVzIjoiMTUzLjQ4IiwiVG90YWxQcmljZV9BUEkiOiJFVVIzNzYuNDgiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIyMjMuMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiIxNTMuNDgiLCJSZWZ1bmRhYmxlIjpmYWxzZSwiUGxhdGluZ0NhcnJpZXIiOiJMWCIsIkZhcmVUeXBlIjoiTm9uIFJlZnVuZGFibGUiLCJBbGxfUGFzc2VuZ2VyIjoiQURUIiwiQWR1bHRzIjoxLCJBZHVsdHNfQmFzZV9QcmljZSI6IjIyMy4wMCIsIkFkdWx0c19UYXhfUHJpY2UiOiIxNTMuNDgiLCJUcmF2ZWxUaW1lIjoiUDBEVDE5SDQwTTBTIiwiQWlyU2VnbWVudF9LZXkiOiJtZkZmeHNhWlE1cXltNnhkYlZJRWl3PT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiI2OXpJdWdlUFRyR05yQzcwbTg0ZWJRPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiTFgiLCJGbGlnaHROdW1iZXIiOiI3MzUiLCJPcmlnaW4iOiJBTVMiLCJEZXN0aW5hdGlvbiI6IlpSSCIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDIwOjA1OjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQyMTozMDowMC4wMDArMDI6MDAiLCJGbGlnaHRUaW1lIjoiODUiLCJEaXN0YW5jZSI6IjM3NSIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMTAwIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjh8Qzh8RDd8WjZ8UDV8WTl8Qjl8TTl8VTl8SDl8UTl8Vjd8VzJ8UzB8VDB8RTB8TDB8SzAiLCJGbGlnaHREZXRhaWxfS2V5IjoiSUJZaFRmelJTSW14cERNbnJQNHBBdz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiIiwiQm9va2luZ0NvZGUiOiJNIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6ImoyaENHamloVFJpR05pOEN0QTRzVXc9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJqMmhDR2ppaFRSaUdOaThDdEE0c1V3PT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Uc3NPZ3pBTSt4amt1OU1IRzdjaTZHQVQ5RUluamN2K1wvek5JVzJsYXBOaEtiRGtKSVJoS1R5Y01mOVhoMjIwZnBQY0VKQmp0NTVGaG5KTTdSS2NUcEhqc2Z0aVdQS0JGV0txU3F0cFlxbVwveXM0Q0k5aUZOS1lXejRyZ2Z2OVJ5RTJwRWdiZ3FwWEhPOFpXRmRMMGxkWDJEZm5VQkp4d25oZz09IiwiRmFyZUJhc2lzIjoiTTU5TEdUOSJ9LHsiQWlyU2VnbWVudF9LZXkiOiJtZkZmeHNhWlE1cXltNnhkYlZJRWl3PT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiTFgiLCJGbGlnaHROdW1iZXIiOiIxODA0IiwiT3JpZ2luIjoiWlJIIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNS0wMVQxMzowMDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDUtMDFUMTY6NDU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjE2NSIsIkRpc3RhbmNlIjoiMTEwNyIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIwIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjh8Qzh8RDd8WjZ8UDV8WTl8Qjl8TTl8VTl8SDl8UTl8Vjd8VzJ8UzB8VDB8RTB8TDB8SzAiLCJGbGlnaHREZXRhaWxfS2V5IjoiMHdlM0F3SnVSRjJUcm45Tm8xXC9mRnc9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkkiLCJCb29raW5nQ29kZSI6Ik0iLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiajJoQ0dqaWhUUmlHTmk4Q3RBNHNVdz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6ImoyaENHamloVFJpR05pOEN0QTRzVXc9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRzc09nekFNK3hqa3U5TUhHN2NpNkdBVDlFSW5qY3YrXC96TklXMmxhcE5oS2JEa0pJUmhLVHljTWY5WGgyMjBmcFBjRUpCanQ1NUZobkpNN1JLY1RwSGpzZnRpV1BLQkZXS3FTcXRwWXFtXC95czRDSTlpRk5LWVd6NHJnZnY5UnlFMnBFZ2JncXBYSE84WldGZEwwbGRYMkRmblVCSnh3bmhnPT0iLCJGYXJlQmFzaXMiOiJNNTlMR1Q5In1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJqMmhDR2ppaFRSaUdOaThDdEE0c1V3PT0iXSxbImoyaENHamloVFJpR05pOEN0QTRzVXc9PSJdXSwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjpbWyIxRyJdLFsiMUciXV0sIkZhcmVydWxlc3JlZl9jb250ZW50IjpbWyJnd3MtZUp4TlRzc09nekFNK3hqa3U5TUhHN2NpNkdBVDlFSW5qY3YrXC96TklXMmxhcE5oS2JEa0pJUmhLVHljTWY5WGgyMjBmcFBjRUpCanQ1NUZobkpNN1JLY1RwSGpzZnRpV1BLQkZXS3FTcXRwWXFtXC95czRDSTlpRk5LWVd6NHJnZnY5UnlFMnBFZ2JncXBYSE84WldGZEwwbGRYMkRmblVCSnh3bmhnPT0iXSxbImd3cy1lSnhOVHNzT2d6QU0reGprdTlNSEc3Y2k2R0FUOUVJbmpjditcL3pOSVcybGFwTmhLYkRrSklSaEtUeWNNZjlYaDIyMGZwUGNFSkJqdDU1RmhuSk03UktjVHBIanNmdGlXUEtCRldLcVNxdHBZcW1cL3lzNENJOWlGTktZV3o0cmdmdjlSeUUycEVnYmdxcFhITzhaV0ZkTDBsZFgyRGZuVUJKeHduaGc9PSJdXX0=" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F3764821" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse21" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        8:05 PM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        9:30 PM <br>
                        <span> Zurich Airport ZRH</span>
                      </li>
                      <li class="rfms_emirates">
                        SWISS<br>
                        <span>LX-100</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>1h 25m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Zurich Airport, | <strong>Layover:: 15h 30m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        1:00 PM <br>
                        <span>Zurich Airport ZRH</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        4:45 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        SWISS<br>
                        <span>LX-320</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>2h 45m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 19h 40m</span><br>
                        Arrival:<span class="color_secondry"> Sunday 01 May</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">376.48</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook21" id="F3764821" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiMkFDUkRZTHBRSFNtYWhkZ3lNc3pSQT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjM3Ni40OCIsIkJhc2VQcmljZSI6IjIyMy4wMCIsIlRheGVzIjoiMTUzLjQ4IiwiVG90YWxQcmljZV9BUEkiOiJFVVIzNzYuNDgiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIyMjMuMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiIxNTMuNDgiLCJSZWZ1bmRhYmxlIjpmYWxzZSwiUGxhdGluZ0NhcnJpZXIiOiJMWCIsIkZhcmVUeXBlIjoiTm9uIFJlZnVuZGFibGUiLCJBbGxfUGFzc2VuZ2VyIjoiQURUIiwiQWR1bHRzIjoxLCJBZHVsdHNfQmFzZV9QcmljZSI6IjIyMy4wMCIsIkFkdWx0c19UYXhfUHJpY2UiOiIxNTMuNDgiLCJUcmF2ZWxUaW1lIjoiUDBEVDE5SDQwTTBTIiwiQWlyU2VnbWVudF9LZXkiOiJtZkZmeHNhWlE1cXltNnhkYlZJRWl3PT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiI2OXpJdWdlUFRyR05yQzcwbTg0ZWJRPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiTFgiLCJGbGlnaHROdW1iZXIiOiI3MzUiLCJPcmlnaW4iOiJBTVMiLCJEZXN0aW5hdGlvbiI6IlpSSCIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDIwOjA1OjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQyMTozMDowMC4wMDArMDI6MDAiLCJGbGlnaHRUaW1lIjoiODUiLCJEaXN0YW5jZSI6IjM3NSIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMTAwIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjh8Qzh8RDd8WjZ8UDV8WTl8Qjl8TTl8VTl8SDl8UTl8Vjd8VzJ8UzB8VDB8RTB8TDB8SzAiLCJGbGlnaHREZXRhaWxfS2V5IjoiSUJZaFRmelJTSW14cERNbnJQNHBBdz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiIiwiQm9va2luZ0NvZGUiOiJNIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6ImoyaENHamloVFJpR05pOEN0QTRzVXc9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJqMmhDR2ppaFRSaUdOaThDdEE0c1V3PT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Uc3NPZ3pBTSt4amt1OU1IRzdjaTZHQVQ5RUluamN2K1wvek5JVzJsYXBOaEtiRGtKSVJoS1R5Y01mOVhoMjIwZnBQY0VKQmp0NTVGaG5KTTdSS2NUcEhqc2Z0aVdQS0JGV0txU3F0cFlxbVwveXM0Q0k5aUZOS1lXejRyZ2Z2OVJ5RTJwRWdiZ3FwWEhPOFpXRmRMMGxkWDJEZm5VQkp4d25oZz09IiwiRmFyZUJhc2lzIjoiTTU5TEdUOSJ9LHsiQWlyU2VnbWVudF9LZXkiOiJtZkZmeHNhWlE1cXltNnhkYlZJRWl3PT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiTFgiLCJGbGlnaHROdW1iZXIiOiIxODA0IiwiT3JpZ2luIjoiWlJIIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNS0wMVQxMzowMDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDUtMDFUMTY6NDU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjE2NSIsIkRpc3RhbmNlIjoiMTEwNyIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIwIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjh8Qzh8RDd8WjZ8UDV8WTl8Qjl8TTl8VTl8SDl8UTl8Vjd8VzJ8UzB8VDB8RTB8TDB8SzAiLCJGbGlnaHREZXRhaWxfS2V5IjoiMHdlM0F3SnVSRjJUcm45Tm8xXC9mRnc9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkkiLCJCb29raW5nQ29kZSI6Ik0iLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiajJoQ0dqaWhUUmlHTmk4Q3RBNHNVdz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6ImoyaENHamloVFJpR05pOEN0QTRzVXc9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRzc09nekFNK3hqa3U5TUhHN2NpNkdBVDlFSW5qY3YrXC96TklXMmxhcE5oS2JEa0pJUmhLVHljTWY5WGgyMjBmcFBjRUpCanQ1NUZobkpNN1JLY1RwSGpzZnRpV1BLQkZXS3FTcXRwWXFtXC95czRDSTlpRk5LWVd6NHJnZnY5UnlFMnBFZ2JncXBYSE84WldGZEwwbGRYMkRmblVCSnh3bmhnPT0iLCJGYXJlQmFzaXMiOiJNNTlMR1Q5In1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJqMmhDR2ppaFRSaUdOaThDdEE0c1V3PT0iXSxbImoyaENHamloVFJpR05pOEN0QTRzVXc9PSJdXSwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjpbWyIxRyJdLFsiMUciXV0sIkZhcmVydWxlc3JlZl9jb250ZW50IjpbWyJnd3MtZUp4TlRzc09nekFNK3hqa3U5TUhHN2NpNkdBVDlFSW5qY3YrXC96TklXMmxhcE5oS2JEa0pJUmhLVHljTWY5WGgyMjBmcFBjRUpCanQ1NUZobkpNN1JLY1RwSGpzZnRpV1BLQkZXS3FTcXRwWXFtXC95czRDSTlpRk5LWVd6NHJnZnY5UnlFMnBFZ2JncXBYSE84WldGZEwwbGRYMkRmblVCSnh3bmhnPT0iXSxbImd3cy1lSnhOVHNzT2d6QU0reGprdTlNSEc3Y2k2R0FUOUVJbmpjditcL3pOSVcybGFwTmhLYkRrSklSaEtUeWNNZjlYaDIyMGZwUGNFSkJqdDU1RmhuSk03UktjVHBIanNmdGlXUEtCRldLcVNxdHBZcW1cL3lzNENJOWlGTktZV3o0cmdmdjlSeUUycEVnYmdxcFhITzhaV0ZkTDBsZFgyRGZuVUJKeHduaGc9PSJdXX0=" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F3764821" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012322" data-airline="KLM Airlines" data-arrive="775" data-duration="205" data-stops="0" data-depature="570" data-airlinecode="KL" data-price="387.03" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF3870322" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/KL.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>11:30 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>15:55 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">3h 25m</span><br>
            <span class="fsa_departure">NON STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse22" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="IlVDcWhHT2RLUjBDZGY2OW96MHhidmc9PXxLS3wxR3xLS3xnd3MtZUp4TlRrRUt3ekFNZTB6UlhVbmFodDdTTFMwYnkzeFlNMFl1K1wvOHo2aVF3SnJDRWtaQWRRckEwTTBmRDhJY0IzK0dSSU84cklMQTY5eVBETFg3ME1Mb1ZrR1pDOGZ2K2tZUmU0YWlPTkxlcmFiazRSUWNpTHB2clRnVks0XC9WNVwvRnJyVFdnUWxiYWJpcXd4UzNwbGNyU09uQzlxZU9oZko1UGVLRjA9fEtLfHxWVnx8QHwxIg==" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">387.03</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook22" id="F3870322" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5Ijoia0hORmkzN1wvU1VtdXAyTm9leWFhVGc9PSIsIkNvbXBsZXRlSXRpbmVyYXJ5IjoiIiwiQ29ubmVjdGlvbnMiOiIiLCJUb3RhbFByaWNlIjoiMzg3LjAzIiwiQmFzZVByaWNlIjoiMzYzLjAwIiwiVGF4ZXMiOiIyNC4wMyIsIlRvdGFsUHJpY2VfQVBJIjoiRVVSMzg3LjAzIiwiQVBJQ3VycmVuY3lUeXBlIjoiRVVSIiwiU0lURUN1cnJlbmN5VHlwZSI6IkVVUiIsIk15TWFya3VwIjowLCJhTWFya3VwIjowLCJCYXNlUHJpY2VfQnJlYWtkb3duIjoiMzYzLjAwIiwiVGF4UHJpY2VfQnJlYWtkb3duIjoiMjQuMDMiLCJSZWZ1bmRhYmxlIjoidHJ1ZSIsIlBsYXRpbmdDYXJyaWVyIjoiS0wiLCJGYXJlVHlwZSI6IlJlZnVuZGFibGUiLCJBbGxfUGFzc2VuZ2VyIjoiQURUIiwiQWR1bHRzIjoxLCJBZHVsdHNfQmFzZV9QcmljZSI6IjM2My4wMCIsIkFkdWx0c19UYXhfUHJpY2UiOiIyNC4wMyIsIlRyYXZlbFRpbWUiOiJQMERUM0gyNU0wUyIsIkFpclNlZ21lbnRfS2V5IjoibDY1V2VlWVNUcWlUenYyZGhcL2I0RkE9PSIsInNlZ21lbnRzIjpbeyJBaXJTZWdtZW50X0tleSI6Imw2NVdlZVlTVHFpVHp2MmRoXC9iNEZBPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiS0wiLCJGbGlnaHROdW1iZXIiOiIxNjEzIiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxMTozMDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTU6NTU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjIwNSIsIkRpc3RhbmNlIjoiMTM4NCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiNzNXIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjZ8QzZ8RDZ8STZ8WjZ8WTZ8QjB8TTB8VTB8SzB8VzB8SDB8UzB8TDB8QTB8UTB8VDB8RTB8TjB8UjB8VjB8WDB8RzAiLCJGbGlnaHREZXRhaWxfS2V5IjoiTURXMXhIenFTRTJsTnpFRE8wTkJZQT09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiWSIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJVQ3FoR09kS1IwQ2RmNjlvejB4YnZnPT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiVUNxaEdPZEtSMENkZjY5b3oweGJ2Zz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVGtFS3d6QU1lMHpSWFVuYWh0N1NMUzBieTN4WU0wWXUrXC84ejZpUXdKckNFa1pBZFFyQTBNMGZEOEljQjMrR1JJTzhySUxBNjl5UERMWDcwTUxvVmtHWkM4ZnYra1lSZTRhaU9OTGVyYWJrNFJRY2lMcHZyVGdWSzRcL1Y1XC9GcnJUV2dRbGJhYmlxd3hTM3BsY3JTT25DOXFlT2hmSjVQZUtGMD0iLCJGYXJlQmFzaXMiOiJZN0ZGV05MIn1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJVQ3FoR09kS1IwQ2RmNjlvejB4YnZnPT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXV0sIkZhcmVydWxlc3JlZl9jb250ZW50IjpbWyJnd3MtZUp4TlRrRUt3ekFNZTB6UlhVbmFodDdTTFMwYnkzeFlNMFl1K1wvOHo2aVF3SnJDRWtaQWRRckEwTTBmRDhJY0IzK0dSSU84cklMQTY5eVBETFg3ME1Mb1ZrR1pDOGZ2K2tZUmU0YWlPTkxlcmFiazRSUWNpTHB2clRnVks0XC9WNVwvRnJyVFdnUWxiYWJpcXd4UzNwbGNyU09uQzlxZU9oZko1UGVLRjA9Il1dfQ==" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F3870322" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse22" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        11:30 AM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        3:55 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        KLM Airlines<br>
                        <span>KL-73W</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>3h 25m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 3h 25m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">387.03</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook22" id="F3870322" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5Ijoia0hORmkzN1wvU1VtdXAyTm9leWFhVGc9PSIsIkNvbXBsZXRlSXRpbmVyYXJ5IjoiIiwiQ29ubmVjdGlvbnMiOiIiLCJUb3RhbFByaWNlIjoiMzg3LjAzIiwiQmFzZVByaWNlIjoiMzYzLjAwIiwiVGF4ZXMiOiIyNC4wMyIsIlRvdGFsUHJpY2VfQVBJIjoiRVVSMzg3LjAzIiwiQVBJQ3VycmVuY3lUeXBlIjoiRVVSIiwiU0lURUN1cnJlbmN5VHlwZSI6IkVVUiIsIk15TWFya3VwIjowLCJhTWFya3VwIjowLCJCYXNlUHJpY2VfQnJlYWtkb3duIjoiMzYzLjAwIiwiVGF4UHJpY2VfQnJlYWtkb3duIjoiMjQuMDMiLCJSZWZ1bmRhYmxlIjoidHJ1ZSIsIlBsYXRpbmdDYXJyaWVyIjoiS0wiLCJGYXJlVHlwZSI6IlJlZnVuZGFibGUiLCJBbGxfUGFzc2VuZ2VyIjoiQURUIiwiQWR1bHRzIjoxLCJBZHVsdHNfQmFzZV9QcmljZSI6IjM2My4wMCIsIkFkdWx0c19UYXhfUHJpY2UiOiIyNC4wMyIsIlRyYXZlbFRpbWUiOiJQMERUM0gyNU0wUyIsIkFpclNlZ21lbnRfS2V5IjoibDY1V2VlWVNUcWlUenYyZGhcL2I0RkE9PSIsInNlZ21lbnRzIjpbeyJBaXJTZWdtZW50X0tleSI6Imw2NVdlZVlTVHFpVHp2MmRoXC9iNEZBPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiS0wiLCJGbGlnaHROdW1iZXIiOiIxNjEzIiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxMTozMDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTU6NTU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjIwNSIsIkRpc3RhbmNlIjoiMTM4NCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiNzNXIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjZ8QzZ8RDZ8STZ8WjZ8WTZ8QjB8TTB8VTB8SzB8VzB8SDB8UzB8TDB8QTB8UTB8VDB8RTB8TjB8UjB8VjB8WDB8RzAiLCJGbGlnaHREZXRhaWxfS2V5IjoiTURXMXhIenFTRTJsTnpFRE8wTkJZQT09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiWSIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJVQ3FoR09kS1IwQ2RmNjlvejB4YnZnPT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiVUNxaEdPZEtSMENkZjY5b3oweGJ2Zz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVGtFS3d6QU1lMHpSWFVuYWh0N1NMUzBieTN4WU0wWXUrXC84ejZpUXdKckNFa1pBZFFyQTBNMGZEOEljQjMrR1JJTzhySUxBNjl5UERMWDcwTUxvVmtHWkM4ZnYra1lSZTRhaU9OTGVyYWJrNFJRY2lMcHZyVGdWSzRcL1Y1XC9GcnJUV2dRbGJhYmlxd3hTM3BsY3JTT25DOXFlT2hmSjVQZUtGMD0iLCJGYXJlQmFzaXMiOiJZN0ZGV05MIn1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJVQ3FoR09kS1IwQ2RmNjlvejB4YnZnPT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXV0sIkZhcmVydWxlc3JlZl9jb250ZW50IjpbWyJnd3MtZUp4TlRrRUt3ekFNZTB6UlhVbmFodDdTTFMwYnkzeFlNMFl1K1wvOHo2aVF3SnJDRWtaQWRRckEwTTBmRDhJY0IzK0dSSU84cklMQTY5eVBETFg3ME1Mb1ZrR1pDOGZ2K2tZUmU0YWlPTkxlcmFiazRSUWNpTHB2clRnVks0XC9WNVwvRnJyVFdnUWxiYWJpcXd4UzNwbGNyU09uQzlxZU9oZko1UGVLRjA9Il1dfQ==" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F3870322" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012323" data-airline="Turkish Airlines" data-arrive="1125" data-duration="205" data-stops="0" data-depature="920" data-airlinecode="TK" data-price="416.03" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF4160323" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/TK.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>17:20 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (SAW)</span><br>
            <div class="fsa_departure"><small>21:45 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">3h 25m</span><br>
            <span class="fsa_departure">NON STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse23" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="InpnZzhRNVdXU2tpbGNzZThMXC9xUUZBPT18S0t8MUd8S0t8Z3dzLWVKeE5UdEVLd3lBUSs1aVM5XC9OMGRYdFRwbEFvZFdOMldGXC8yXC81XC9SVTJFMGNBbEhRdTZjYzB4cUpxUElYVERoTiswcjB2Y0pKTEJNOWdYNmJyU0drcTJDU04yd1ZUNWVSeTRZSFpyRVN0MGVxbm93MlBBQUlYS2NoOU9BMnRsditWXC9iamtLQ2FCUVhrZVREXC92N2tRbVNZaU8waWhvVThkZ0xXTkNqaHxLS3x8VlZ8fEB8MSI=" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">416.03</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook23" id="F4160323" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiRG5MXC9qaU1LUmJLM3hxNnI5cUVneEE9PSIsIkNvbXBsZXRlSXRpbmVyYXJ5IjoiIiwiQ29ubmVjdGlvbnMiOiIiLCJUb3RhbFByaWNlIjoiNDE2LjAzIiwiQmFzZVByaWNlIjoiMzUxLjAwIiwiVGF4ZXMiOiI2NS4wMyIsIlRvdGFsUHJpY2VfQVBJIjoiRVVSNDE2LjAzIiwiQVBJQ3VycmVuY3lUeXBlIjoiRVVSIiwiU0lURUN1cnJlbmN5VHlwZSI6IkVVUiIsIk15TWFya3VwIjowLCJhTWFya3VwIjowLCJCYXNlUHJpY2VfQnJlYWtkb3duIjoiMzUxLjAwIiwiVGF4UHJpY2VfQnJlYWtkb3duIjoiNjUuMDMiLCJSZWZ1bmRhYmxlIjpmYWxzZSwiUGxhdGluZ0NhcnJpZXIiOiJUSyIsIkZhcmVUeXBlIjoiTm9uIFJlZnVuZGFibGUiLCJBbGxfUGFzc2VuZ2VyIjoiQURUIiwiQWR1bHRzIjoxLCJBZHVsdHNfQmFzZV9QcmljZSI6IjM1MS4wMCIsIkFkdWx0c19UYXhfUHJpY2UiOiI2NS4wMyIsIlRyYXZlbFRpbWUiOiJQMERUM0gyNU0wUyIsIkFpclNlZ21lbnRfS2V5IjoiTWZkZGlibVZSUmlUWWdhYnp1UlFTUT09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoiTWZkZGlibVZSUmlUWWdhYnp1UlFTUT09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlRLIiwiRmxpZ2h0TnVtYmVyIjoiMTk2MCIsIk9yaWdpbiI6IkFNUyIsIkRlc3RpbmF0aW9uIjoiU0FXIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMTc6MjA6MDAuMDAwKzAyOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA0LTMwVDIxOjQ1OjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIyMDUiLCJEaXN0YW5jZSI6IjEzODQiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjczOCIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6IkM0fEQ0fEs0fEo0fEk0fFIwfFk5fEI5fE05fEgwfFMwfEUwfFEwfFQwfEwwfFYwfFAwfFcwfFgwfE4wfEcwIiwiRmxpZ2h0RGV0YWlsX0tleSI6IlRaWFJXMUM5UmlxTnl0ZmVKc0trNWc9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IiIsIkJvb2tpbmdDb2RlIjoiTSIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJ6Z2c4UTVXV1NraWxjc2U4TFwvcVFGQT09IiwiRmFyZXJ1bGVzcmVmX0tleSI6InpnZzhRNVdXU2tpbGNzZThMXC9xUUZBPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5UdEVLd3lBUSs1aVM5XC9OMGRYdFRwbEFvZFdOMldGXC8yXC81XC9SVTJFMGNBbEhRdTZjYzB4cUpxUElYVERoTiswcjB2Y0pKTEJNOWdYNmJyU0drcTJDU04yd1ZUNWVSeTRZSFpyRVN0MGVxbm93MlBBQUlYS2NoOU9BMnRsditWXC9iamtLQ2FCUVhrZVREXC92N2tRbVNZaU8waWhvVThkZ0xXTkNqaCIsIkZhcmVCYXNpcyI6Ik1ZMlhPWFNXIn1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJ6Z2c4UTVXV1NraWxjc2U4TFwvcVFGQT09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5UdEVLd3lBUSs1aVM5XC9OMGRYdFRwbEFvZFdOMldGXC8yXC81XC9SVTJFMGNBbEhRdTZjYzB4cUpxUElYVERoTiswcjB2Y0pKTEJNOWdYNmJyU0drcTJDU04yd1ZUNWVSeTRZSFpyRVN0MGVxbm93MlBBQUlYS2NoOU9BMnRsditWXC9iamtLQ2FCUVhrZVREXC92N2tRbVNZaU8waWhvVThkZ0xXTkNqaCJdXX0=" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F4160323" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse23" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        5:20 PM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        9:45 PM <br>
                        <span> Sabiha Gokcen Arpt SAW</span>
                      </li>
                      <li class="rfms_emirates">
                        Turkish Airlines<br>
                        <span>TK-738</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>3h 25m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 3h 25m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">416.03</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook23" id="F4160323" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiRG5MXC9qaU1LUmJLM3hxNnI5cUVneEE9PSIsIkNvbXBsZXRlSXRpbmVyYXJ5IjoiIiwiQ29ubmVjdGlvbnMiOiIiLCJUb3RhbFByaWNlIjoiNDE2LjAzIiwiQmFzZVByaWNlIjoiMzUxLjAwIiwiVGF4ZXMiOiI2NS4wMyIsIlRvdGFsUHJpY2VfQVBJIjoiRVVSNDE2LjAzIiwiQVBJQ3VycmVuY3lUeXBlIjoiRVVSIiwiU0lURUN1cnJlbmN5VHlwZSI6IkVVUiIsIk15TWFya3VwIjowLCJhTWFya3VwIjowLCJCYXNlUHJpY2VfQnJlYWtkb3duIjoiMzUxLjAwIiwiVGF4UHJpY2VfQnJlYWtkb3duIjoiNjUuMDMiLCJSZWZ1bmRhYmxlIjpmYWxzZSwiUGxhdGluZ0NhcnJpZXIiOiJUSyIsIkZhcmVUeXBlIjoiTm9uIFJlZnVuZGFibGUiLCJBbGxfUGFzc2VuZ2VyIjoiQURUIiwiQWR1bHRzIjoxLCJBZHVsdHNfQmFzZV9QcmljZSI6IjM1MS4wMCIsIkFkdWx0c19UYXhfUHJpY2UiOiI2NS4wMyIsIlRyYXZlbFRpbWUiOiJQMERUM0gyNU0wUyIsIkFpclNlZ21lbnRfS2V5IjoiTWZkZGlibVZSUmlUWWdhYnp1UlFTUT09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoiTWZkZGlibVZSUmlUWWdhYnp1UlFTUT09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlRLIiwiRmxpZ2h0TnVtYmVyIjoiMTk2MCIsIk9yaWdpbiI6IkFNUyIsIkRlc3RpbmF0aW9uIjoiU0FXIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMTc6MjA6MDAuMDAwKzAyOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA0LTMwVDIxOjQ1OjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIyMDUiLCJEaXN0YW5jZSI6IjEzODQiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjczOCIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6IkM0fEQ0fEs0fEo0fEk0fFIwfFk5fEI5fE05fEgwfFMwfEUwfFEwfFQwfEwwfFYwfFAwfFcwfFgwfE4wfEcwIiwiRmxpZ2h0RGV0YWlsX0tleSI6IlRaWFJXMUM5UmlxTnl0ZmVKc0trNWc9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IiIsIkJvb2tpbmdDb2RlIjoiTSIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJ6Z2c4UTVXV1NraWxjc2U4TFwvcVFGQT09IiwiRmFyZXJ1bGVzcmVmX0tleSI6InpnZzhRNVdXU2tpbGNzZThMXC9xUUZBPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5UdEVLd3lBUSs1aVM5XC9OMGRYdFRwbEFvZFdOMldGXC8yXC81XC9SVTJFMGNBbEhRdTZjYzB4cUpxUElYVERoTiswcjB2Y0pKTEJNOWdYNmJyU0drcTJDU04yd1ZUNWVSeTRZSFpyRVN0MGVxbm93MlBBQUlYS2NoOU9BMnRsditWXC9iamtLQ2FCUVhrZVREXC92N2tRbVNZaU8waWhvVThkZ0xXTkNqaCIsIkZhcmVCYXNpcyI6Ik1ZMlhPWFNXIn1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJ6Z2c4UTVXV1NraWxjc2U4TFwvcVFGQT09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5UdEVLd3lBUSs1aVM5XC9OMGRYdFRwbEFvZFdOMldGXC8yXC81XC9SVTJFMGNBbEhRdTZjYzB4cUpxUElYVERoTiswcjB2Y0pKTEJNOWdYNmJyU0drcTJDU04yd1ZUNWVSeTRZSFpyRVN0MGVxbm93MlBBQUlYS2NoOU9BMnRsditWXC9iamtLQ2FCUVhrZVREXC92N2tRbVNZaU8waWhvVThkZ0xXTkNqaCJdXX0=" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F4160323" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012324" data-airline="Air Malta" data-arrive="1155" data-duration="565" data-stops="1" data-depature="590" data-airlinecode="KM" data-price="439.76" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF4397624" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/KM.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>11:50 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>22:15 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">9h 25m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse24" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="IlwvR2FYSDFuOFQzK3oyeGk1aXBqb2FRPT18S0t8MUd8S0t8Z3dzLWVKeE5Ua0VLd3pBTWUwelJYVTdhbE40UzFwWkNHXC9ld2phMlhcL2Y4WmN4SVlFMWpHbHBBZFkzU1V3RjRZXC85RGgwKzBaK3J3QkNtZVZqd1F2MCtnaE5sMGdaY0N4NTFNZFdvS25DVnJGMXFYYTVyQUVFQ3RYYVVvQnJzb3AzMytoNVNUTWlFTExaazNUXC9EaGZGTEtublh2YmZvUjk5UVVnUlNlQnxLS3x8VlZ8XC9HYVhIMW44VDMrejJ4aTVpcGpvYVE9PXxLS3wxR3xLS3xnd3MtZUp4TlRrRUt3ekFNZTB6UlhVN2FsTjRTMXBaQ0dcL2V3amEyWFwvZjhaY3hJWUUxakdscEFkWTNTVXdGNFlcLzlEaDArMForcndCQ21lVmp3UXYwK2doTmwwZ1pjQ3g1MU1kV29LbkNWckYxcVhhNXJBRUVDdFhhVW9CcnNvcDMzK2g1U1RNaUVMTFprM1RcL0RoZkZMS25uWHZiZm9SOTlRVWdSU2VCfEtLfEU0d0VQSllXUVJhTFEzRWQ5Z1VPckE9PXxLS3wxR3xLS3xnd3MtZUp4TlRrRU93akFNZTh6a3V6MUdlKzFFTjRGR3N3TkRhQmYrXC93elM5b0tsT0Vwc09Va3BqVlRnSktZXC9EUGdPVzRHOWI0Qmg5SHE4RGtRcHR1RUVxU3RzSzdzSlBlQkNGNnlKdmF2WmNsZ0NpSldydWxLQnMzRjV6ajFUcUFmaFBsUmE3dDVzenNmK29jaUpmaTM3UHNKXC8rZ0hiclNjUXxLS3x8VlZ8fEB8MiI=" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">439.76</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook24" id="F4397624" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiRGtydFFqbGlTZHl0aGowVG5QZzlQZz09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjQzOS43NiIsIkJhc2VQcmljZSI6IjM1Ny4wMCIsIlRheGVzIjoiODIuNzYiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjQzOS43NiIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjM1Ny4wMCIsIlRheFByaWNlX0JyZWFrZG93biI6IjgyLjc2IiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiS00iLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIzNTcuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiODIuNzYiLCJUcmF2ZWxUaW1lIjoiUDBEVDlIMjVNMFMiLCJBaXJTZWdtZW50X0tleSI6ImVWZjZrdU9TUTZXQmtHbnFpMXFCTFE9PSIsInNlZ21lbnRzIjpbeyJBaXJTZWdtZW50X0tleSI6Im9LNlFcL1BIRVJHQzJWbmRERTFZXC9lQT09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IktNIiwiRmxpZ2h0TnVtYmVyIjoiMzk1IiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJNTEEiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxMTo1MDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTQ6NTA6MDAuMDAwKzAyOjAwIiwiRmxpZ2h0VGltZSI6IjE4MCIsIkRpc3RhbmNlIjoiMTIzMiIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIwIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IkwiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiQzR8RDB8STB8TTd8WTd8TDd8VjB8VDB8SzB8QjB8UTB8SDB8RzB8VzB8UzB8TjB8VTB8UjAiLCJGbGlnaHREZXRhaWxfS2V5IjoicTVLMmJPT0tRQ09FK1BJVFpWTExCUT09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiIiwiQm9va2luZ0NvZGUiOiJMIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6IlwvR2FYSDFuOFQzK3oyeGk1aXBqb2FRPT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiXC9HYVhIMW44VDMrejJ4aTVpcGpvYVE9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRrRUt3ekFNZTB6UlhVN2FsTjRTMXBaQ0dcL2V3amEyWFwvZjhaY3hJWUUxakdscEFkWTNTVXdGNFlcLzlEaDArMForcndCQ21lVmp3UXYwK2doTmwwZ1pjQ3g1MU1kV29LbkNWckYxcVhhNXJBRUVDdFhhVW9CcnNvcDMzK2g1U1RNaUVMTFprM1RcL0RoZkZMS25uWHZiZm9SOTlRVWdSU2VCIiwiRmFyZUJhc2lzIjoiTEtNT04yIn0seyJBaXJTZWdtZW50X0tleSI6ImVWZjZrdU9TUTZXQmtHbnFpMXFCTFE9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJLTSIsIkZsaWdodE51bWJlciI6IjI3MDIiLCJPcmlnaW4iOiJNTEEiLCJEZXN0aW5hdGlvbiI6IklTVCIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDE4OjU1OjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQyMjoxNTowMC4wMDArMDM6MDAiLCJGbGlnaHRUaW1lIjoiMTQwIiwiRGlzdGFuY2UiOiI4NjMiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjMxOSIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJMIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6IkM3fEQ3fE03fFY3fEs3fFE3fEg3fFc3fFM3fE43IiwiRmxpZ2h0RGV0YWlsX0tleSI6IjF2bmhheFFQU0NHenVQcHo1WTg5SGc9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkkiLCJCb29raW5nQ29kZSI6Ik4iLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiRTR3RVBKWVdRUmFMUTNFZDlnVU9yQT09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IkU0d0VQSllXUVJhTFEzRWQ5Z1VPckE9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRrRU93akFNZTh6a3V6MUdlKzFFTjRGR3N3TkRhQmYrXC93elM5b0tsT0Vwc09Va3BqVlRnSktZXC9EUGdPVzRHOWI0Qmg5SHE4RGtRcHR1RUVxU3RzSzdzSlBlQkNGNnlKdmF2WmNsZ0NpSldydWxLQnMzRjV6ajFUcUFmaFBsUmE3dDVzenNmK29jaUpmaTM3UHNKXC8rZ0hiclNjUSIsIkZhcmVCYXNpcyI6Ik5LTU9OMSJ9XSwiRmFyZXJ1bGVzcmVmX0tleSI6W1siXC9HYVhIMW44VDMrejJ4aTVpcGpvYVE9PSJdLFsiRTR3RVBKWVdRUmFMUTNFZDlnVU9yQT09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl0sWyIxRyJdXSwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOltbImd3cy1lSnhOVGtFS3d6QU1lMHpSWFU3YWxONFMxcFpDR1wvZXdqYTJYXC9mOFpjeElZRTFqR2xwQWRZM1NVd0Y0WVwvOURoMCswWityd0JDbWVWandRdjArZ2hObDBnWmNDeDUxTWRXb0tuQ1ZyRjFxWGE1ckFFRUN0WGFVb0Jyc29wMzMraDVTVE1pRUxMWmszVFwvRGhmRkxLbm5YdmJmb1I5OVFVZ1JTZUIiXSxbImd3cy1lSnhOVGtFT3dqQU1lOHprdXoxR2UrMUVONEZHc3dORGFCZitcL3d6UzlvS2xPRXBzT1VrcGpWVGdKS1lcL0RQZ09XNEc5YjRCaDlIcThEa1FwdHVFRXFTdHNLN3NKUGVCQ0Y2eUp2YXZaY2xnQ2lKV3J1bEtCczNGNXpqMVRxQWZoUGxSYTd0NXN6c2Yrb2NpSmZpMzdQc0pcLytnSGJyU2NRIl1dfQ==" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F4397624" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse24" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        11:50 AM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        2:50 PM <br>
                        <span> Luqa Airport MLA</span>
                      </li>
                      <li class="rfms_emirates">
                        Air Malta<br>
                        <span>KM-320</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>3h 0m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Luqa Airport, | <strong>Layover:: 4h 5m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        6:55 PM <br>
                        <span>Luqa Airport MLA</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        10:15 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        Air Malta<br>
                        <span>KM-319</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>2h 20m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 9h 25m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">439.76</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook24" id="F4397624" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiRGtydFFqbGlTZHl0aGowVG5QZzlQZz09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjQzOS43NiIsIkJhc2VQcmljZSI6IjM1Ny4wMCIsIlRheGVzIjoiODIuNzYiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjQzOS43NiIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjM1Ny4wMCIsIlRheFByaWNlX0JyZWFrZG93biI6IjgyLjc2IiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiS00iLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIzNTcuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiODIuNzYiLCJUcmF2ZWxUaW1lIjoiUDBEVDlIMjVNMFMiLCJBaXJTZWdtZW50X0tleSI6ImVWZjZrdU9TUTZXQmtHbnFpMXFCTFE9PSIsInNlZ21lbnRzIjpbeyJBaXJTZWdtZW50X0tleSI6Im9LNlFcL1BIRVJHQzJWbmRERTFZXC9lQT09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IktNIiwiRmxpZ2h0TnVtYmVyIjoiMzk1IiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJNTEEiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxMTo1MDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTQ6NTA6MDAuMDAwKzAyOjAwIiwiRmxpZ2h0VGltZSI6IjE4MCIsIkRpc3RhbmNlIjoiMTIzMiIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIwIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IkwiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiQzR8RDB8STB8TTd8WTd8TDd8VjB8VDB8SzB8QjB8UTB8SDB8RzB8VzB8UzB8TjB8VTB8UjAiLCJGbGlnaHREZXRhaWxfS2V5IjoicTVLMmJPT0tRQ09FK1BJVFpWTExCUT09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiIiwiQm9va2luZ0NvZGUiOiJMIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6IlwvR2FYSDFuOFQzK3oyeGk1aXBqb2FRPT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiXC9HYVhIMW44VDMrejJ4aTVpcGpvYVE9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRrRUt3ekFNZTB6UlhVN2FsTjRTMXBaQ0dcL2V3amEyWFwvZjhaY3hJWUUxakdscEFkWTNTVXdGNFlcLzlEaDArMForcndCQ21lVmp3UXYwK2doTmwwZ1pjQ3g1MU1kV29LbkNWckYxcVhhNXJBRUVDdFhhVW9CcnNvcDMzK2g1U1RNaUVMTFprM1RcL0RoZkZMS25uWHZiZm9SOTlRVWdSU2VCIiwiRmFyZUJhc2lzIjoiTEtNT04yIn0seyJBaXJTZWdtZW50X0tleSI6ImVWZjZrdU9TUTZXQmtHbnFpMXFCTFE9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJLTSIsIkZsaWdodE51bWJlciI6IjI3MDIiLCJPcmlnaW4iOiJNTEEiLCJEZXN0aW5hdGlvbiI6IklTVCIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDE4OjU1OjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQyMjoxNTowMC4wMDArMDM6MDAiLCJGbGlnaHRUaW1lIjoiMTQwIiwiRGlzdGFuY2UiOiI4NjMiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjMxOSIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJMIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6IkM3fEQ3fE03fFY3fEs3fFE3fEg3fFc3fFM3fE43IiwiRmxpZ2h0RGV0YWlsX0tleSI6IjF2bmhheFFQU0NHenVQcHo1WTg5SGc9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkkiLCJCb29raW5nQ29kZSI6Ik4iLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiRTR3RVBKWVdRUmFMUTNFZDlnVU9yQT09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IkU0d0VQSllXUVJhTFEzRWQ5Z1VPckE9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRrRU93akFNZTh6a3V6MUdlKzFFTjRGR3N3TkRhQmYrXC93elM5b0tsT0Vwc09Va3BqVlRnSktZXC9EUGdPVzRHOWI0Qmg5SHE4RGtRcHR1RUVxU3RzSzdzSlBlQkNGNnlKdmF2WmNsZ0NpSldydWxLQnMzRjV6ajFUcUFmaFBsUmE3dDVzenNmK29jaUpmaTM3UHNKXC8rZ0hiclNjUSIsIkZhcmVCYXNpcyI6Ik5LTU9OMSJ9XSwiRmFyZXJ1bGVzcmVmX0tleSI6W1siXC9HYVhIMW44VDMrejJ4aTVpcGpvYVE9PSJdLFsiRTR3RVBKWVdRUmFMUTNFZDlnVU9yQT09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl0sWyIxRyJdXSwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOltbImd3cy1lSnhOVGtFS3d6QU1lMHpSWFU3YWxONFMxcFpDR1wvZXdqYTJYXC9mOFpjeElZRTFqR2xwQWRZM1NVd0Y0WVwvOURoMCswWityd0JDbWVWandRdjArZ2hObDBnWmNDeDUxTWRXb0tuQ1ZyRjFxWGE1ckFFRUN0WGFVb0Jyc29wMzMraDVTVE1pRUxMWmszVFwvRGhmRkxLbm5YdmJmb1I5OVFVZ1JTZUIiXSxbImd3cy1lSnhOVGtFT3dqQU1lOHprdXoxR2UrMUVONEZHc3dORGFCZitcL3d6UzlvS2xPRXBzT1VrcGpWVGdKS1lcL0RQZ09XNEc5YjRCaDlIcThEa1FwdHVFRXFTdHNLN3NKUGVCQ0Y2eUp2YXZaY2xnQ2lKV3J1bEtCczNGNXpqMVRxQWZoUGxSYTd0NXN6c2Yrb2NpSmZpMzdQc0pcLytnSGJyU2NRIl1dfQ==" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F4397624" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012325" data-airline="TAP - Air Portugal" data-arrive="910" data-duration="610" data-stops="1" data-depature="300" data-airlinecode="TP" data-price="499.17" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF4991725" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/TP.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>07:00 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>18:10 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">10h 10m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse25" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="IjQ3MDZySFRSUUtHQWhRdWdjV0xsWnc9PXxLS3wxR3xLS3xnd3MtZUp4TlRzc09nekFNK3hqa3U5TUM0MWkwZ2phcHl4Q1BBeGYrXC96TkkyOE1XS2JZU1cwNUNDSTdTc3hXR3YycHdOZnNDUFo2QXdsbW45d1luXC9VQ0lUU2RJNmJCTnhcL3BkTktGbWVKcWtSYTRzeFJpNzZFSE1uS1VxdVhBV0hEK1wvMkh3VVprU0c2V1drWTl3MVVjaVc5R0xyQit5dEczV2FKXC9vPXxLS3x8VlZ8NDcwNnJIVFJRS0dBaFF1Z2NXTGxadz09fEtLfDFHfEtLfGd3cy1lSnhOVHNzT2d6QU0reGprdTlNQzQxaTBnamFweXhDUEF4ZitcL3pOSTI4TVdLYllTVzA1Q0NJN1NzeFdHdjJwd05mc0NQWjZBd2xtbjl3WW5cL1VDSVRTZEk2YkJOeFwvcGROS0ZtZUpxa1JhNHN4Umk3NkVITW5LVXF1WEFXSEQrXC8ySHdVWmtTRzZXV2tZOXcxVWNpVzlHTHJCK3l0RzNXYUpcL289fEtLfHd6UW54NVhNU2hxMWRTam9GK0VBNnc9PXxLS3wxR3xLS3xnd3MtZUp4TlRrRU93eUFNZTB6bHV3T3M2MjVNcGRVcVRSUVZldWhsXC8zXC9HQXV5d1NMR1YySExpdlRlVWtVN29cLzJyQVp5Z0o4WnlCQ0tPOTVRS1pKbXZiZElHVUc5SnlIbnVhTTNxR3BVcXh5WjJsR1ZldUJrUjRoTEVydFhBMWZHXC81Rnl1b1I2RkdWRmhlU3ZFWkNzMnhrNDQwVHRkMzZGdGZmMVFvSVE9PXxLS3x8VlZ8fEB8MiI=" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">499.17</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook25" id="F4991725" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiZDZtXC91MkY2U0x1UFQzOVZscGIwVnc9PSIsIkNvbXBsZXRlSXRpbmVyYXJ5IjoiIiwiQ29ubmVjdGlvbnMiOiIwLCIsIlRvdGFsUHJpY2UiOiI0OTkuMTciLCJCYXNlUHJpY2UiOiIzNzAuMDAiLCJUYXhlcyI6IjEyOS4xNyIsIlRvdGFsUHJpY2VfQVBJIjoiRVVSNDk5LjE3IiwiQVBJQ3VycmVuY3lUeXBlIjoiRVVSIiwiU0lURUN1cnJlbmN5VHlwZSI6IkVVUiIsIk15TWFya3VwIjowLCJhTWFya3VwIjowLCJCYXNlUHJpY2VfQnJlYWtkb3duIjoiMzcwLjAwIiwiVGF4UHJpY2VfQnJlYWtkb3duIjoiMTI5LjE3IiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiVFAiLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIzNzAuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiMTI5LjE3IiwiVHJhdmVsVGltZSI6IlAwRFQxMEgxME0wUyIsIkFpclNlZ21lbnRfS2V5IjoiMW45bitIK0tRRnFhYStQekt1eWhGdz09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoiSVNmcnh0ZG1UUHFmOThxaHJFUzBRUT09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlRQIiwiRmxpZ2h0TnVtYmVyIjoiNjY5IiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJMSVMiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQwNzowMDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMDk6MDA6MDAuMDAwKzAxOjAwIiwiRmxpZ2h0VGltZSI6IjE4MCIsIkRpc3RhbmNlIjoiMTE0OSIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIwIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiQzZ8RDV8WjV8SjR8UjB8WTd8Qjd8TTZ8UzV8SDR8UTF8UDB8VjB8VzB8QTB8SzB8TDB8VTB8RTB8VDB8TzB8RzB8TjAiLCJGbGlnaHREZXRhaWxfS2V5IjoiU084NXNzT1BSaUdEblFadGdsend6Zz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiMSIsIkJvb2tpbmdDb2RlIjoiUyIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiI0NzA2ckhUUlFLR0FoUXVnY1dMbFp3PT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiNDcwNnJIVFJRS0dBaFF1Z2NXTGxadz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHNzT2d6QU0reGprdTlNQzQxaTBnamFweXhDUEF4ZitcL3pOSTI4TVdLYllTVzA1Q0NJN1NzeFdHdjJwd05mc0NQWjZBd2xtbjl3WW5cL1VDSVRTZEk2YkJOeFwvcGROS0ZtZUpxa1JhNHN4Umk3NkVITW5LVXF1WEFXSEQrXC8ySHdVWmtTRzZXV2tZOXcxVWNpVzlHTHJCK3l0RzNXYUpcL289IiwiRmFyZUJhc2lzIjoiU0VVUk9QTkwifSx7IkFpclNlZ21lbnRfS2V5IjoiMW45bitIK0tRRnFhYStQekt1eWhGdz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlRQIiwiRmxpZ2h0TnVtYmVyIjoiNjQ1NCIsIk9yaWdpbiI6IkxJUyIsIkRlc3RpbmF0aW9uIjoiSVNUIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMTE6MzA6MDAuMDAwKzAxOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA0LTMwVDE4OjEwOjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIyODAiLCJEaXN0YW5jZSI6IjIwMTYiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjczSiIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6IkM0fEQ0fFo0fEo0fFk0fEI0fE00fFM0fEg0fFE0fFA0fFYwfFcwfEEwfEswfEwwfFUwfEUwIiwiRmxpZ2h0RGV0YWlsX0tleSI6IkxLTVhYUHJ4U3ZtallZclJaZjUzM0E9PSIsIk9yaWdpblRlcm1pbmFsIjoiMSIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiJJIiwiQm9va2luZ0NvZGUiOiJQIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6Ind6UW54NVhNU2hxMWRTam9GK0VBNnc9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJ3elFueDVYTVNocTFkU2pvRitFQTZ3PT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Ua0VPd3lBTWUwemx1d09zNjI1TXBkVXFUUlFWZXVobFwvM1wvR0F1eXdTTEdWMkhMaXZUZVVrVTdvXC8yckFaeWdKOFp5QkNLTzk1UUtaSm12YmRJR1VHOUp5SG51YU0zcUdwVXF4eVoybEdWZXVCa1I0aExFcnRYQTFmR1wvNUZ5dW9SNkZHVkZoZVN2RVpDczJ4azQ0MFR0ZDM2RnRmZjFRb0lRPT0iLCJGYXJlQmFzaXMiOiJQRVVST1BDUyJ9XSwiRmFyZXJ1bGVzcmVmX0tleSI6W1siNDcwNnJIVFJRS0dBaFF1Z2NXTGxadz09Il0sWyJ3elFueDVYTVNocTFkU2pvRitFQTZ3PT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXSxbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5Uc3NPZ3pBTSt4amt1OU1DNDFpMGdqYXB5eENQQXhmK1wvek5JMjhNV0tiWVNXMDVDQ0k3U3N4V0d2MnB3TmZzQ1BaNkF3bG1uOXdZblwvVUNJVFNkSTZiQk54XC9wZE5LRm1lSnFrUmE0c3hSaTc2RUhNbktVcXVYQVdIRCtcLzJId1Vaa1NHNldXa1k5dzFVY2lXOUdMckIreXRHM1dhSlwvbz0iXSxbImd3cy1lSnhOVGtFT3d5QU1lMHpsdXdPczYyNU1wZFVxVFJRVmV1aGxcLzNcL0dBdXl3U0xHVjJITGl2VGVVa1U3b1wvMnJBWnlnSjhaeUJDS085NVFLWkptdmJkSUdVRzlKeUhudWFNM3FHcFVxeHlaMmxHVmV1QmtSNGhMRXJ0WEExZkdcLzVGeXVvUjZGR1ZGaGVTdkVaQ3MyeGs0NDBUdGQzNkZ0ZmYxUW9JUT09Il1dfQ==" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F4991725" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse25" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        7:00 AM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        9:00 AM <br>
                        <span> Lisboa LIS</span>
                      </li>
                      <li class="rfms_emirates">
                        TAP - Air Portugal<br>
                        <span>TP-320</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>3h 0m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Lisboa, | <strong>Layover:: 2h 30m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        11:30 AM <br>
                        <span>Lisboa LIS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        6:10 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        TAP - Air Portugal<br>
                        <span>TP-73J</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>4h 40m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 10h 10m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">499.17</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook25" id="F4991725" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiZDZtXC91MkY2U0x1UFQzOVZscGIwVnc9PSIsIkNvbXBsZXRlSXRpbmVyYXJ5IjoiIiwiQ29ubmVjdGlvbnMiOiIwLCIsIlRvdGFsUHJpY2UiOiI0OTkuMTciLCJCYXNlUHJpY2UiOiIzNzAuMDAiLCJUYXhlcyI6IjEyOS4xNyIsIlRvdGFsUHJpY2VfQVBJIjoiRVVSNDk5LjE3IiwiQVBJQ3VycmVuY3lUeXBlIjoiRVVSIiwiU0lURUN1cnJlbmN5VHlwZSI6IkVVUiIsIk15TWFya3VwIjowLCJhTWFya3VwIjowLCJCYXNlUHJpY2VfQnJlYWtkb3duIjoiMzcwLjAwIiwiVGF4UHJpY2VfQnJlYWtkb3duIjoiMTI5LjE3IiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiVFAiLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIzNzAuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiMTI5LjE3IiwiVHJhdmVsVGltZSI6IlAwRFQxMEgxME0wUyIsIkFpclNlZ21lbnRfS2V5IjoiMW45bitIK0tRRnFhYStQekt1eWhGdz09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoiSVNmcnh0ZG1UUHFmOThxaHJFUzBRUT09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlRQIiwiRmxpZ2h0TnVtYmVyIjoiNjY5IiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJMSVMiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQwNzowMDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMDk6MDA6MDAuMDAwKzAxOjAwIiwiRmxpZ2h0VGltZSI6IjE4MCIsIkRpc3RhbmNlIjoiMTE0OSIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIwIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiQzZ8RDV8WjV8SjR8UjB8WTd8Qjd8TTZ8UzV8SDR8UTF8UDB8VjB8VzB8QTB8SzB8TDB8VTB8RTB8VDB8TzB8RzB8TjAiLCJGbGlnaHREZXRhaWxfS2V5IjoiU084NXNzT1BSaUdEblFadGdsend6Zz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiMSIsIkJvb2tpbmdDb2RlIjoiUyIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiI0NzA2ckhUUlFLR0FoUXVnY1dMbFp3PT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiNDcwNnJIVFJRS0dBaFF1Z2NXTGxadz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHNzT2d6QU0reGprdTlNQzQxaTBnamFweXhDUEF4ZitcL3pOSTI4TVdLYllTVzA1Q0NJN1NzeFdHdjJwd05mc0NQWjZBd2xtbjl3WW5cL1VDSVRTZEk2YkJOeFwvcGROS0ZtZUpxa1JhNHN4Umk3NkVITW5LVXF1WEFXSEQrXC8ySHdVWmtTRzZXV2tZOXcxVWNpVzlHTHJCK3l0RzNXYUpcL289IiwiRmFyZUJhc2lzIjoiU0VVUk9QTkwifSx7IkFpclNlZ21lbnRfS2V5IjoiMW45bitIK0tRRnFhYStQekt1eWhGdz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlRQIiwiRmxpZ2h0TnVtYmVyIjoiNjQ1NCIsIk9yaWdpbiI6IkxJUyIsIkRlc3RpbmF0aW9uIjoiSVNUIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMTE6MzA6MDAuMDAwKzAxOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA0LTMwVDE4OjEwOjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIyODAiLCJEaXN0YW5jZSI6IjIwMTYiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjczSiIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6IkM0fEQ0fFo0fEo0fFk0fEI0fE00fFM0fEg0fFE0fFA0fFYwfFcwfEEwfEswfEwwfFUwfEUwIiwiRmxpZ2h0RGV0YWlsX0tleSI6IkxLTVhYUHJ4U3ZtallZclJaZjUzM0E9PSIsIk9yaWdpblRlcm1pbmFsIjoiMSIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiJJIiwiQm9va2luZ0NvZGUiOiJQIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6Ind6UW54NVhNU2hxMWRTam9GK0VBNnc9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJ3elFueDVYTVNocTFkU2pvRitFQTZ3PT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Ua0VPd3lBTWUwemx1d09zNjI1TXBkVXFUUlFWZXVobFwvM1wvR0F1eXdTTEdWMkhMaXZUZVVrVTdvXC8yckFaeWdKOFp5QkNLTzk1UUtaSm12YmRJR1VHOUp5SG51YU0zcUdwVXF4eVoybEdWZXVCa1I0aExFcnRYQTFmR1wvNUZ5dW9SNkZHVkZoZVN2RVpDczJ4azQ0MFR0ZDM2RnRmZjFRb0lRPT0iLCJGYXJlQmFzaXMiOiJQRVVST1BDUyJ9XSwiRmFyZXJ1bGVzcmVmX0tleSI6W1siNDcwNnJIVFJRS0dBaFF1Z2NXTGxadz09Il0sWyJ3elFueDVYTVNocTFkU2pvRitFQTZ3PT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXSxbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5Uc3NPZ3pBTSt4amt1OU1DNDFpMGdqYXB5eENQQXhmK1wvek5JMjhNV0tiWVNXMDVDQ0k3U3N4V0d2MnB3TmZzQ1BaNkF3bG1uOXdZblwvVUNJVFNkSTZiQk54XC9wZE5LRm1lSnFrUmE0c3hSaTc2RUhNbktVcXVYQVdIRCtcLzJId1Vaa1NHNldXa1k5dzFVY2lXOUdMckIreXRHM1dhSlwvbz0iXSxbImd3cy1lSnhOVGtFT3d5QU1lMHpsdXdPczYyNU1wZFVxVFJRVmV1aGxcLzNcL0dBdXl3U0xHVjJITGl2VGVVa1U3b1wvMnJBWnlnSjhaeUJDS085NVFLWkptdmJkSUdVRzlKeUhudWFNM3FHcFVxeHlaMmxHVmV1QmtSNGhMRXJ0WEExZkdcLzVGeXVvUjZGR1ZGaGVTdkVaQ3MyeGs0NDBUdGQzNkZ0ZmYxUW9JUT09Il1dfQ==" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F4991725" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012326" data-airline="Royal Jordanian" data-arrive="5" data-duration="570" data-stops="1" data-depature="875" data-airlinecode="RJ" data-price="527.72" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF5277226" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/RJ.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>16:35 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>03:05 (01 May, Sun 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">9h 30m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse26" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="InBYbzFkNnVHVFA2YTZsU1hhMFlROXc9PXxLS3wxR3xLS3xnd3MtZUp4TmpzMEtoREFNaEI5RzVwN1VxbnRzVVJkWmJBNnJnbDU4XC84ZHcyc0t5Z1V3STMrUW5oT0JFZVwvRXE0UzhhM00zM0F6dEd3T0NZTVNVNDliMUMyVjBRVGlHdDIya3I2b1pXQ0t6QVdyWFlwbTV1SVJoZmI2MGtCNjZpTVcyXC9wZmtrYUVTV2VXR3hPTzIyTHlyaWhlZUdqbUFBMzNvQVdMOG56UT09fEtLfHxWVnxwWG8xZDZ1R1RQNmE2bFNYYTBZUTl3PT18S0t8MUd8S0t8Z3dzLWVKeE5qczBLaERBTWhCOUc1cDdVcW50c1VSZFpiQTZyZ2w1OFwvOGR3MnNLeWdVd0kzK1FuaE9CRWVcL0VxNFM4YTNNMzNBenRHd09DWU1TVTQ5YjFDMlYwUVRpR3QyMmtyNm9aV0NLekFXclhZcG01dUlSaGZiNjBrQjY2aU1XMlwvcGZra2FFU1dlV0d4T08yMkx5cmloZWVHam1BQTMzb0FXTDhuelE9PXxLS3xVbFUrVTdhS1RyZVZjY0lXb1FjODFRPT18S0t8MUd8S0t8Z3dzLWVKeE5Ua0VPd3pBSWUwemx1OG15VnJ1bFdsT3QwOEloVGFYMXN2OFwvWTVUMU1FdUF3QWFUVWdxVW5sR1lcL3REaDA5VW5kTHNEaW1DeHJBMHlCTks3SGJRdGxOZjZiaFYrNFVveFFwMzhWWEZadnVRSVlyck40c3l1aGpPUHBaeEhCWWNsVElnajVZY1ZIYWZXdGlwa3BOblplSUE5OVFVYWFTZVN8S0t8fFZWfHxAfDIi" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">527.72</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook26" id="F5277226" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiUVpLSmxTVnZUZzI3STN0ZVwvOXRxWmc9PSIsIkNvbXBsZXRlSXRpbmVyYXJ5IjoiIiwiQ29ubmVjdGlvbnMiOiIwLCIsIlRvdGFsUHJpY2UiOiI1MjcuNzIiLCJCYXNlUHJpY2UiOiIzNTMuMDAiLCJUYXhlcyI6IjE3NC43MiIsIlRvdGFsUHJpY2VfQVBJIjoiRVVSNTI3LjcyIiwiQVBJQ3VycmVuY3lUeXBlIjoiRVVSIiwiU0lURUN1cnJlbmN5VHlwZSI6IkVVUiIsIk15TWFya3VwIjowLCJhTWFya3VwIjowLCJCYXNlUHJpY2VfQnJlYWtkb3duIjoiMzUzLjAwIiwiVGF4UHJpY2VfQnJlYWtkb3duIjoiMTc0LjcyIiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiUkoiLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIzNTMuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiMTc0LjcyIiwiVHJhdmVsVGltZSI6IlAwRFQ5SDMwTTBTIiwiQWlyU2VnbWVudF9LZXkiOiI1cCtYcE1KcVNIKzJnVnNCOXBndHVRPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiIzMnNjenFPS1E4aTdZMFVDS3RHSXF3PT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiUkoiLCJGbGlnaHROdW1iZXIiOiIxNTIiLCJPcmlnaW4iOiJBTVMiLCJEZXN0aW5hdGlvbiI6IkFNTSIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDE2OjM1OjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQyMjoyMDowMC4wMDArMDM6MDAiLCJGbGlnaHRUaW1lIjoiMjg1IiwiRGlzdGFuY2UiOiIyMTE0IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMjEiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUyIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJKOXxaMHxDOXxEN3xJMHxZOXxCOXxQMHxIOXxXMHxLOXxSMHxNOXxMOHxWNnxTMXxOMHxRMHxPMCIsIkZsaWdodERldGFpbF9LZXkiOiJVRGxKTjkrZ1FESzdHNUxGdkFOZnN3PT0iLCJPcmlnaW5UZXJtaW5hbCI6IiIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiIiLCJCb29raW5nQ29kZSI6Ik0iLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoicFhvMWQ2dUdUUDZhNmxTWGEwWVE5dz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6InBYbzFkNnVHVFA2YTZsU1hhMFlROXc9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TmpzMEtoREFNaEI5RzVwN1VxbnRzVVJkWmJBNnJnbDU4XC84ZHcyc0t5Z1V3STMrUW5oT0JFZVwvRXE0UzhhM00zM0F6dEd3T0NZTVNVNDliMUMyVjBRVGlHdDIya3I2b1pXQ0t6QVdyWFlwbTV1SVJoZmI2MGtCNjZpTVcyXC9wZmtrYUVTV2VXR3hPTzIyTHlyaWhlZUdqbUFBMzNvQVdMOG56UT09IiwiRmFyZUJhc2lzIjoiTUxTWE5MIn0seyJBaXJTZWdtZW50X0tleSI6IjVwK1hwTUpxU0grMmdWc0I5cGd0dVE9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJSSiIsIkZsaWdodE51bWJlciI6IjE2MyIsIk9yaWdpbiI6IkFNTSIsIkRlc3RpbmF0aW9uIjoiSVNUIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDUtMDFUMDA6NDU6MDAuMDAwKzAzOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA1LTAxVDAzOjA1OjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIxNDAiLCJEaXN0YW5jZSI6Ijc0NSIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIwIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjl8WjV8Qzl8RDd8STN8WTl8Qjl8UDl8SDl8Vzl8Szl8Ujl8TTl8TDl8Vjl8Uzl8TjV8UTJ8TzUiLCJGbGlnaHREZXRhaWxfS2V5IjoiaHpQNjFcL1psUmN1cEFrNVpjdlRBMXc9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkkiLCJCb29raW5nQ29kZSI6Ik0iLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiVWxVK1U3YUtUcmVWY2NJV29RYzgxUT09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IlVsVStVN2FLVHJlVmNjSVdvUWM4MVE9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRrRU93ekFJZTB6bHU4bXlWcnVsV2xPdDA4SWhUYVgxc3Y4XC9ZNVQxTUV1QXdBYVRVZ3FVbmxHWVwvdERoMDlVbmRMc0RpbUN4ckEweUJOSzdIYlF0bE5mNmJoVis0VW94UXAzOFZYRlp2dVFJWXJyTjRzeXVoak9QcFp4SEJZY2xUSWdqNVljVkhhZld0aXBrcE5uWmVJQTk5UVVhYVNlUyIsIkZhcmVCYXNpcyI6Ik1MU1hUUiJ9XSwiRmFyZXJ1bGVzcmVmX0tleSI6W1sicFhvMWQ2dUdUUDZhNmxTWGEwWVE5dz09Il0sWyJVbFUrVTdhS1RyZVZjY0lXb1FjODFRPT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXSxbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5qczBLaERBTWhCOUc1cDdVcW50c1VSZFpiQTZyZ2w1OFwvOGR3MnNLeWdVd0kzK1FuaE9CRWVcL0VxNFM4YTNNMzNBenRHd09DWU1TVTQ5YjFDMlYwUVRpR3QyMmtyNm9aV0NLekFXclhZcG01dUlSaGZiNjBrQjY2aU1XMlwvcGZra2FFU1dlV0d4T08yMkx5cmloZWVHam1BQTMzb0FXTDhuelE9PSJdLFsiZ3dzLWVKeE5Ua0VPd3pBSWUwemx1OG15VnJ1bFdsT3QwOEloVGFYMXN2OFwvWTVUMU1FdUF3QWFUVWdxVW5sR1lcL3REaDA5VW5kTHNEaW1DeHJBMHlCTks3SGJRdGxOZjZiaFYrNFVveFFwMzhWWEZadnVRSVlyck40c3l1aGpPUHBaeEhCWWNsVElnajVZY1ZIYWZXdGlwa3BOblplSUE5OVFVYWFTZVMiXV19" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F5277226" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse26" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        4:35 PM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        10:20 PM <br>
                        <span> Queen Alia Intl Arpt AMM</span>
                      </li>
                      <li class="rfms_emirates">
                        Royal Jordanian<br>
                        <span>RJ-321</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>4h 45m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Queen Alia Intl Arpt, | <strong>Layover:: 2h 25m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        12:45 AM <br>
                        <span>Queen Alia Intl Arpt AMM</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        3:05 AM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        Royal Jordanian<br>
                        <span>RJ-320</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>2h 20m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 9h 30m</span><br>
                        Arrival:<span class="color_secondry"> Sunday 01 May</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">527.72</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook26" id="F5277226" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiUVpLSmxTVnZUZzI3STN0ZVwvOXRxWmc9PSIsIkNvbXBsZXRlSXRpbmVyYXJ5IjoiIiwiQ29ubmVjdGlvbnMiOiIwLCIsIlRvdGFsUHJpY2UiOiI1MjcuNzIiLCJCYXNlUHJpY2UiOiIzNTMuMDAiLCJUYXhlcyI6IjE3NC43MiIsIlRvdGFsUHJpY2VfQVBJIjoiRVVSNTI3LjcyIiwiQVBJQ3VycmVuY3lUeXBlIjoiRVVSIiwiU0lURUN1cnJlbmN5VHlwZSI6IkVVUiIsIk15TWFya3VwIjowLCJhTWFya3VwIjowLCJCYXNlUHJpY2VfQnJlYWtkb3duIjoiMzUzLjAwIiwiVGF4UHJpY2VfQnJlYWtkb3duIjoiMTc0LjcyIiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiUkoiLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIzNTMuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiMTc0LjcyIiwiVHJhdmVsVGltZSI6IlAwRFQ5SDMwTTBTIiwiQWlyU2VnbWVudF9LZXkiOiI1cCtYcE1KcVNIKzJnVnNCOXBndHVRPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiIzMnNjenFPS1E4aTdZMFVDS3RHSXF3PT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiUkoiLCJGbGlnaHROdW1iZXIiOiIxNTIiLCJPcmlnaW4iOiJBTVMiLCJEZXN0aW5hdGlvbiI6IkFNTSIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDE2OjM1OjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQyMjoyMDowMC4wMDArMDM6MDAiLCJGbGlnaHRUaW1lIjoiMjg1IiwiRGlzdGFuY2UiOiIyMTE0IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMjEiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUyIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJKOXxaMHxDOXxEN3xJMHxZOXxCOXxQMHxIOXxXMHxLOXxSMHxNOXxMOHxWNnxTMXxOMHxRMHxPMCIsIkZsaWdodERldGFpbF9LZXkiOiJVRGxKTjkrZ1FESzdHNUxGdkFOZnN3PT0iLCJPcmlnaW5UZXJtaW5hbCI6IiIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiIiLCJCb29raW5nQ29kZSI6Ik0iLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoicFhvMWQ2dUdUUDZhNmxTWGEwWVE5dz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6InBYbzFkNnVHVFA2YTZsU1hhMFlROXc9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TmpzMEtoREFNaEI5RzVwN1VxbnRzVVJkWmJBNnJnbDU4XC84ZHcyc0t5Z1V3STMrUW5oT0JFZVwvRXE0UzhhM00zM0F6dEd3T0NZTVNVNDliMUMyVjBRVGlHdDIya3I2b1pXQ0t6QVdyWFlwbTV1SVJoZmI2MGtCNjZpTVcyXC9wZmtrYUVTV2VXR3hPTzIyTHlyaWhlZUdqbUFBMzNvQVdMOG56UT09IiwiRmFyZUJhc2lzIjoiTUxTWE5MIn0seyJBaXJTZWdtZW50X0tleSI6IjVwK1hwTUpxU0grMmdWc0I5cGd0dVE9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJSSiIsIkZsaWdodE51bWJlciI6IjE2MyIsIk9yaWdpbiI6IkFNTSIsIkRlc3RpbmF0aW9uIjoiSVNUIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDUtMDFUMDA6NDU6MDAuMDAwKzAzOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA1LTAxVDAzOjA1OjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIxNDAiLCJEaXN0YW5jZSI6Ijc0NSIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIwIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjl8WjV8Qzl8RDd8STN8WTl8Qjl8UDl8SDl8Vzl8Szl8Ujl8TTl8TDl8Vjl8Uzl8TjV8UTJ8TzUiLCJGbGlnaHREZXRhaWxfS2V5IjoiaHpQNjFcL1psUmN1cEFrNVpjdlRBMXc9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IkkiLCJCb29raW5nQ29kZSI6Ik0iLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiVWxVK1U3YUtUcmVWY2NJV29RYzgxUT09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IlVsVStVN2FLVHJlVmNjSVdvUWM4MVE9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRrRU93ekFJZTB6bHU4bXlWcnVsV2xPdDA4SWhUYVgxc3Y4XC9ZNVQxTUV1QXdBYVRVZ3FVbmxHWVwvdERoMDlVbmRMc0RpbUN4ckEweUJOSzdIYlF0bE5mNmJoVis0VW94UXAzOFZYRlp2dVFJWXJyTjRzeXVoak9QcFp4SEJZY2xUSWdqNVljVkhhZld0aXBrcE5uWmVJQTk5UVVhYVNlUyIsIkZhcmVCYXNpcyI6Ik1MU1hUUiJ9XSwiRmFyZXJ1bGVzcmVmX0tleSI6W1sicFhvMWQ2dUdUUDZhNmxTWGEwWVE5dz09Il0sWyJVbFUrVTdhS1RyZVZjY0lXb1FjODFRPT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXSxbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5qczBLaERBTWhCOUc1cDdVcW50c1VSZFpiQTZyZ2w1OFwvOGR3MnNLeWdVd0kzK1FuaE9CRWVcL0VxNFM4YTNNMzNBenRHd09DWU1TVTQ5YjFDMlYwUVRpR3QyMmtyNm9aV0NLekFXclhZcG01dUlSaGZiNjBrQjY2aU1XMlwvcGZra2FFU1dlV0d4T08yMkx5cmloZWVHam1BQTMzb0FXTDhuelE9PSJdLFsiZ3dzLWVKeE5Ua0VPd3pBSWUwemx1OG15VnJ1bFdsT3QwOEloVGFYMXN2OFwvWTVUMU1FdUF3QWFUVWdxVW5sR1lcL3REaDA5VW5kTHNEaW1DeHJBMHlCTks3SGJRdGxOZjZiaFYrNFVveFFwMzhWWEZadnVRSVlyck40c3l1aGpPUHBaeEhCWWNsVElnajVZY1ZIYWZXdGlwa3BOblplSUE5OVFVYWFTZVMiXV19" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F5277226" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012327" data-airline="LOT Polish Airlines" data-arrive="815" data-duration="315" data-stops="1" data-depature="500" data-airlinecode="LO" data-price="540.06" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF5400627" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/LO.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>10:20 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>16:35 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">5h 15m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse27" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="Ik5EM1VOQzVDUUNpK29qeVBnbmk2VlE9PXxLS3wxR3xLS3xnd3MtZUp4TlRrRU9nekFNZXd6eTNjbmFqdDNLR0JWSXJEc0FCeTc3XC96T1d0dEtFcGNTS2JEbU9NU29sMEFuakJSMiszZnBCUGtZZ1EyMldiWWVuNzN1SVhTZEk4WmpsdVI0VFdzS05KdVFxTnBacVN5NHBpS1FwTktVQVo5M0RlXC91SGxwY3dJOHFhWnFNOHZIYW5HbWp0RFA1aHdoMVc2d2RLbXlkMXxLS3x8VlZ8fEB8MSI=" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">540.06</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook27" id="F5400627" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiQ244Q2UrdldSVkNIT25OUlZ5TzFrUT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjU0MC4wNiIsIkJhc2VQcmljZSI6IjQ2Mi4wMCIsIlRheGVzIjoiNzguMDYiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjU0MC4wNiIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjQ2Mi4wMCIsIlRheFByaWNlX0JyZWFrZG93biI6Ijc4LjA2IiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiTE8iLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiI0NjIuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiNzguMDYiLCJUcmF2ZWxUaW1lIjoiUDBEVDVIMTVNMFMiLCJBaXJTZWdtZW50X0tleSI6ImFqZUF4amd4VE5TZzVhRE8wZk5sZGc9PSIsInNlZ21lbnRzIjpbeyJBaXJTZWdtZW50X0tleSI6IjdKOHR0VFVuVEs2STl2SU5tWWtwT1E9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJMTyIsIkZsaWdodE51bWJlciI6IjI2NiIsIk9yaWdpbiI6IkFNUyIsIkRlc3RpbmF0aW9uIjoiV0FXIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMTA6MjA6MDAuMDAwKzAyOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA0LTMwVDEyOjE1OjAwLjAwMCswMjowMCIsIkZsaWdodFRpbWUiOiIxMTUiLCJEaXN0YW5jZSI6IjY4NCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiRU1KIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiQzh8RDV8WjN8STB8UDN8QTN8UjF8SjB8WTl8Qjl8TTl8RTl8SDl8Szl8UTl8Rzl8VDB8UzB8VjB8VzB8TDB8VTB8TzAiLCJGbGlnaHREZXRhaWxfS2V5IjoieFNrem45YkpSRW03NGpEMWlVMXJndz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiIiwiQm9va2luZ0NvZGUiOiJIIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6Ik5EM1VOQzVDUUNpK29qeVBnbmk2VlE9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJORDNVTkM1Q1FDaStvanlQZ25pNlZRPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Ua0VPZ3pBTWV3enkzY25hanQzS0dCVklyRHNBQnk3N1wvek9XdHRLRXBjU0tiRG1PTVNvbDBBbmpCUjIrM2ZwQlBrWWdRMjJXYlllbjczdUlYU2RJOFpqbHVSNFRXc0tOSnVRcU5wWnFTeTRwaUtRcE5LVUFaOTNEZVwvdUhscGN3SThxYVpxTTh2SGFuR21qdERQNWh3aDFXNndkS215ZDEiLCJGYXJlQmFzaXMiOiJIMUJMVUUifSx7IkFpclNlZ21lbnRfS2V5IjoiYWplQXhqZ3hUTlNnNWFETzBmTmxkZz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IkxPIiwiRmxpZ2h0TnVtYmVyIjoiMTM1IiwiT3JpZ2luIjoiV0FXIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxMjo1NTowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTY6MzU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjE2MCIsIkRpc3RhbmNlIjoiODY1IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiJFTUoiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUyIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJDOHxENXxaM3xJMHxQM3xBM3xSMXxKMHxZOXxCOXxNOXxFOXxIOXxLOXxROXxHOXxUMHxTMHxWMHxXMHxMMHxVMHxPMCIsIkZsaWdodERldGFpbF9LZXkiOiJBeHdMRWllUVR3YXJ4ZEhoaERTM2xRPT0iLCJPcmlnaW5UZXJtaW5hbCI6IiIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiJJIiwiQm9va2luZ0NvZGUiOiJIIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6Ik5EM1VOQzVDUUNpK29qeVBnbmk2VlE9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJORDNVTkM1Q1FDaStvanlQZ25pNlZRPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Ua0VPZ3pBTWV3enkzY25hanQzS0dCVklyRHNBQnk3N1wvek9XdHRLRXBjU0tiRG1PTVNvbDBBbmpCUjIrM2ZwQlBrWWdRMjJXYlllbjczdUlYU2RJOFpqbHVSNFRXc0tOSnVRcU5wWnFTeTRwaUtRcE5LVUFaOTNEZVwvdUhscGN3SThxYVpxTTh2SGFuR21qdERQNWh3aDFXNndkS215ZDEiLCJGYXJlQmFzaXMiOiJIMUJMVUUifV0sIkZhcmVydWxlc3JlZl9LZXkiOltbIk5EM1VOQzVDUUNpK29qeVBnbmk2VlE9PSJdLFsiTkQzVU5DNUNRQ2krb2p5UGduaTZWUT09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl0sWyIxRyJdXSwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOltbImd3cy1lSnhOVGtFT2d6QU1ld3p5M2NuYWp0M0tHQlZJckRzQUJ5NzdcL3pPV3R0S0VwY1NLYkRtT01Tb2wwQW5qQlIyKzNmcEJQa1lnUTIyV2JZZW43M3VJWFNkSThaamx1UjRUV3NLTkp1UXFOcFpxU3k0cGlLUXBOS1VBWjkzRGVcL3VIbHBjd0k4cWFacU04dkhhbkdtanREUDVod2gxVzZ3ZEtteWQxIl0sWyJnd3MtZUp4TlRrRU9nekFNZXd6eTNjbmFqdDNLR0JWSXJEc0FCeTc3XC96T1d0dEtFcGNTS2JEbU9NU29sMEFuakJSMiszZnBCUGtZZ1EyMldiWWVuNzN1SVhTZEk4WmpsdVI0VFdzS05KdVFxTnBacVN5NHBpS1FwTktVQVo5M0RlXC91SGxwY3dJOHFhWnFNOHZIYW5HbWp0RFA1aHdoMVc2d2RLbXlkMSJdXX0=" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F5400627" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse27" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        10:20 AM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        12:15 PM <br>
                        <span> Warsaw Frederic Chopin Arpt WAW</span>
                      </li>
                      <li class="rfms_emirates">
                        LOT Polish Airlines<br>
                        <span>LO-EMJ</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>1h 55m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Warsaw Frederic Chopin Arpt, | <strong>Layover:: 0h 40m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        12:55 PM <br>
                        <span>Warsaw Frederic Chopin Arpt WAW</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        4:35 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        LOT Polish Airlines<br>
                        <span>LO-EMJ</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>2h 40m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 5h 15m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">540.06</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook27" id="F5400627" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiQ244Q2UrdldSVkNIT25OUlZ5TzFrUT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjU0MC4wNiIsIkJhc2VQcmljZSI6IjQ2Mi4wMCIsIlRheGVzIjoiNzguMDYiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjU0MC4wNiIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjQ2Mi4wMCIsIlRheFByaWNlX0JyZWFrZG93biI6Ijc4LjA2IiwiUmVmdW5kYWJsZSI6ZmFsc2UsIlBsYXRpbmdDYXJyaWVyIjoiTE8iLCJGYXJlVHlwZSI6Ik5vbiBSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiI0NjIuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiNzguMDYiLCJUcmF2ZWxUaW1lIjoiUDBEVDVIMTVNMFMiLCJBaXJTZWdtZW50X0tleSI6ImFqZUF4amd4VE5TZzVhRE8wZk5sZGc9PSIsInNlZ21lbnRzIjpbeyJBaXJTZWdtZW50X0tleSI6IjdKOHR0VFVuVEs2STl2SU5tWWtwT1E9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJMTyIsIkZsaWdodE51bWJlciI6IjI2NiIsIk9yaWdpbiI6IkFNUyIsIkRlc3RpbmF0aW9uIjoiV0FXIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMTA6MjA6MDAuMDAwKzAyOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA0LTMwVDEyOjE1OjAwLjAwMCswMjowMCIsIkZsaWdodFRpbWUiOiIxMTUiLCJEaXN0YW5jZSI6IjY4NCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiRU1KIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiQzh8RDV8WjN8STB8UDN8QTN8UjF8SjB8WTl8Qjl8TTl8RTl8SDl8Szl8UTl8Rzl8VDB8UzB8VjB8VzB8TDB8VTB8TzAiLCJGbGlnaHREZXRhaWxfS2V5IjoieFNrem45YkpSRW03NGpEMWlVMXJndz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiIiwiQm9va2luZ0NvZGUiOiJIIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6Ik5EM1VOQzVDUUNpK29qeVBnbmk2VlE9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJORDNVTkM1Q1FDaStvanlQZ25pNlZRPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Ua0VPZ3pBTWV3enkzY25hanQzS0dCVklyRHNBQnk3N1wvek9XdHRLRXBjU0tiRG1PTVNvbDBBbmpCUjIrM2ZwQlBrWWdRMjJXYlllbjczdUlYU2RJOFpqbHVSNFRXc0tOSnVRcU5wWnFTeTRwaUtRcE5LVUFaOTNEZVwvdUhscGN3SThxYVpxTTh2SGFuR21qdERQNWh3aDFXNndkS215ZDEiLCJGYXJlQmFzaXMiOiJIMUJMVUUifSx7IkFpclNlZ21lbnRfS2V5IjoiYWplQXhqZ3hUTlNnNWFETzBmTmxkZz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IkxPIiwiRmxpZ2h0TnVtYmVyIjoiMTM1IiwiT3JpZ2luIjoiV0FXIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxMjo1NTowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTY6MzU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjE2MCIsIkRpc3RhbmNlIjoiODY1IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiJFTUoiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUyIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJDOHxENXxaM3xJMHxQM3xBM3xSMXxKMHxZOXxCOXxNOXxFOXxIOXxLOXxROXxHOXxUMHxTMHxWMHxXMHxMMHxVMHxPMCIsIkZsaWdodERldGFpbF9LZXkiOiJBeHdMRWllUVR3YXJ4ZEhoaERTM2xRPT0iLCJPcmlnaW5UZXJtaW5hbCI6IiIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiJJIiwiQm9va2luZ0NvZGUiOiJIIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6Ik5EM1VOQzVDUUNpK29qeVBnbmk2VlE9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJORDNVTkM1Q1FDaStvanlQZ25pNlZRPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Ua0VPZ3pBTWV3enkzY25hanQzS0dCVklyRHNBQnk3N1wvek9XdHRLRXBjU0tiRG1PTVNvbDBBbmpCUjIrM2ZwQlBrWWdRMjJXYlllbjczdUlYU2RJOFpqbHVSNFRXc0tOSnVRcU5wWnFTeTRwaUtRcE5LVUFaOTNEZVwvdUhscGN3SThxYVpxTTh2SGFuR21qdERQNWh3aDFXNndkS215ZDEiLCJGYXJlQmFzaXMiOiJIMUJMVUUifV0sIkZhcmVydWxlc3JlZl9LZXkiOltbIk5EM1VOQzVDUUNpK29qeVBnbmk2VlE9PSJdLFsiTkQzVU5DNUNRQ2krb2p5UGduaTZWUT09Il1dLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOltbIjFHIl0sWyIxRyJdXSwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOltbImd3cy1lSnhOVGtFT2d6QU1ld3p5M2NuYWp0M0tHQlZJckRzQUJ5NzdcL3pPV3R0S0VwY1NLYkRtT01Tb2wwQW5qQlIyKzNmcEJQa1lnUTIyV2JZZW43M3VJWFNkSThaamx1UjRUV3NLTkp1UXFOcFpxU3k0cGlLUXBOS1VBWjkzRGVcL3VIbHBjd0k4cWFacU04dkhhbkdtanREUDVod2gxVzZ3ZEtteWQxIl0sWyJnd3MtZUp4TlRrRU9nekFNZXd6eTNjbmFqdDNLR0JWSXJEc0FCeTc3XC96T1d0dEtFcGNTS2JEbU9NU29sMEFuakJSMiszZnBCUGtZZ1EyMldiWWVuNzN1SVhTZEk4WmpsdVI0VFdzS05KdVFxTnBacVN5NHBpS1FwTktVQVo5M0RlXC91SGxwY3dJOHFhWnFNOHZIYW5HbWp0RFA1aHdoMVc2d2RLbXlkMSJdXX0=" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F5400627" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012328" data-airline="Alitalia" data-arrive="890" data-duration="420" data-stops="1" data-depature="470" data-airlinecode="AZ" data-price="594.31" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF5943128" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/AZ.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>09:50 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>17:50 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">7h 0m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse28" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="IkJqNVZUVEZZVGlTc1VzSHJvZzlQVXc9PXxLS3wxR3xLS3xnd3MtZUp4TlRzc0t3ekFNKzVpaXU1eEh0Mk5DbDdBZW1oM2FNckxEXC92OHo1aVJRSnJDRkxTRTdoR0FvTTUwd1wvR0hDZDRvZmxITUJDb3pXdWhcL3dZcHlINkZSQmlrZDl2ZE01WXlSWXFsQzZPRmk2YmZIWmdzak1IRW9EYXU5eDI2XC9RZGhKcVJHdnBxVlRpNDBpV0NuZFg2UG9HZmVvSENlRW5RQT09fEtLfHxWVnx8QHwxIg==" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">594.31</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook28" id="F5943128" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiR09zSmJLTFRRNDZXK01UaE5Zd1BNZz09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjU5NC4zMSIsIkJhc2VQcmljZSI6IjQ2OC4wMCIsIlRheGVzIjoiMTI2LjMxIiwiVG90YWxQcmljZV9BUEkiOiJFVVI1OTQuMzEiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiI0NjguMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiIxMjYuMzEiLCJSZWZ1bmRhYmxlIjoidHJ1ZSIsIlBsYXRpbmdDYXJyaWVyIjoiQVoiLCJGYXJlVHlwZSI6IlJlZnVuZGFibGUiLCJBbGxfUGFzc2VuZ2VyIjoiQURUIiwiQWR1bHRzIjoxLCJBZHVsdHNfQmFzZV9QcmljZSI6IjQ2OC4wMCIsIkFkdWx0c19UYXhfUHJpY2UiOiIxMjYuMzEiLCJUcmF2ZWxUaW1lIjoiUDBEVDdIME0wUyIsIkFpclNlZ21lbnRfS2V5IjoiS0lUMG1abW9RVHFyYW5ud2ZucjRIUT09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoibldcL0tkQmNkU05LbHZFbTdmZUhNVnc9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJBWiIsIkZsaWdodE51bWJlciI6Ijc3MTMiLCJPcmlnaW4iOiJBTVMiLCJEZXN0aW5hdGlvbiI6IkZDTyIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDA5OjUwOjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQxMjowNTowMC4wMDArMDI6MDAiLCJGbGlnaHRUaW1lIjoiMTM1IiwiRGlzdGFuY2UiOiI4MDkiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjczNyIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiQ2FjaGVkIHN0YXR1cyB1c2VkLiBQb2xsZWQgYXZhaWwgZXhpc3RzIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUCIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJDOHxFOHxEOHxJOHxZMXxCMHxNMHxIMHxLMHxWMHxUMHxOMHxTMHxRMHxYMHxXMHxMMHxPMHxGMHxSMCIsIkZsaWdodERldGFpbF9LZXkiOiJlXC9qS2E2bjFUeG0wTCtsVmdKMTFyZz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiMSIsIkJvb2tpbmdDb2RlIjoiWSIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJCajVWVFRGWVRpU3NVc0hyb2c5UFV3PT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiQmo1VlRURllUaVNzVXNIcm9nOVBVdz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHNzS3d6QU0rNWlpdTV4SHQyTkNsN0FlbWgzYU1yTERcL3Y4ejVpUlFKckNGTFNFN2hHQW9NNTB3XC9HSENkNG9mbEhNQkNveld1aFwvd1lweUg2RlJCaWtkOXZkTTVZeVJZcWxDNk9GaTZiZkhaZ3NqTUhFb0RhdTl4MjZcL1FkaEpxUkd2cHFWVGk0MGlXQ25kWDZQb0dmZW9IQ2VFblFBPT0iLCJGYXJlQmFzaXMiOiJZT1dFVTYifSx7IkFpclNlZ21lbnRfS2V5IjoiS0lUMG1abW9RVHFyYW5ud2ZucjRIUT09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IkFaIiwiRmxpZ2h0TnVtYmVyIjoiNzA2IiwiT3JpZ2luIjoiRkNPIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxNDoyNTowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTc6NTA6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjE0NSIsIkRpc3RhbmNlIjoiODY0IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMlMiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IkNhY2hlZCBzdGF0dXMgdXNlZC4gUG9sbGVkIGF2YWlsIGV4aXN0cyIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlAiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiQzd8RTd8RDd8STd8WTd8Qjd8TTd8SDd8Szd8Vjd8VDd8Tjd8Uzd8UTd8WDd8Vzd8TDd8Tzd8RjB8UjR8RzAiLCJGbGlnaHREZXRhaWxfS2V5IjoiU3pUNERcL0lTUWxlRndhZjM4STRSeGc9PSIsIk9yaWdpblRlcm1pbmFsIjoiMSIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiJJIiwiQm9va2luZ0NvZGUiOiJZIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6IkJqNVZUVEZZVGlTc1VzSHJvZzlQVXc9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJCajVWVFRGWVRpU3NVc0hyb2c5UFV3PT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Uc3NLd3pBTSs1aWl1NXhIdDJOQ2w3QWVtaDNhTXJMRFwvdjh6NWlSUUpyQ0ZMU0U3aEdBb001MHdcL0dIQ2Q0b2ZsSE1CQ296V3VoXC93WXB5SDZGUkJpa2Q5dmRNNVl5UllxbEM2T0ZpNmJmSFpnc2pNSEVvRGF1OXgyNlwvUWRoSnFSR3ZwcVZUaTQwaVdDbmRYNlBvR2Zlb0hDZUVuUUE9PSIsIkZhcmVCYXNpcyI6IllPV0VVNiJ9XSwiRmFyZXJ1bGVzcmVmX0tleSI6W1siQmo1VlRURllUaVNzVXNIcm9nOVBVdz09Il0sWyJCajVWVFRGWVRpU3NVc0hyb2c5UFV3PT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXSxbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5Uc3NLd3pBTSs1aWl1NXhIdDJOQ2w3QWVtaDNhTXJMRFwvdjh6NWlSUUpyQ0ZMU0U3aEdBb001MHdcL0dIQ2Q0b2ZsSE1CQ296V3VoXC93WXB5SDZGUkJpa2Q5dmRNNVl5UllxbEM2T0ZpNmJmSFpnc2pNSEVvRGF1OXgyNlwvUWRoSnFSR3ZwcVZUaTQwaVdDbmRYNlBvR2Zlb0hDZUVuUUE9PSJdLFsiZ3dzLWVKeE5Uc3NLd3pBTSs1aWl1NXhIdDJOQ2w3QWVtaDNhTXJMRFwvdjh6NWlSUUpyQ0ZMU0U3aEdBb001MHdcL0dIQ2Q0b2ZsSE1CQ296V3VoXC93WXB5SDZGUkJpa2Q5dmRNNVl5UllxbEM2T0ZpNmJmSFpnc2pNSEVvRGF1OXgyNlwvUWRoSnFSR3ZwcVZUaTQwaVdDbmRYNlBvR2Zlb0hDZUVuUUE9PSJdXX0=" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F5943128" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse28" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        9:50 AM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        12:05 PM <br>
                        <span> Fiumicino Arpt FCO</span>
                      </li>
                      <li class="rfms_emirates">
                        Alitalia<br>
                        <span>AZ-737</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>2h 15m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Fiumicino Arpt, | <strong>Layover:: 2h 20m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        2:25 PM <br>
                        <span>Fiumicino Arpt FCO</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        5:50 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        Alitalia<br>
                        <span>AZ-32S</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>2h 25m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 7h 0m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">594.31</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook28" id="F5943128" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiR09zSmJLTFRRNDZXK01UaE5Zd1BNZz09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjU5NC4zMSIsIkJhc2VQcmljZSI6IjQ2OC4wMCIsIlRheGVzIjoiMTI2LjMxIiwiVG90YWxQcmljZV9BUEkiOiJFVVI1OTQuMzEiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiI0NjguMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiIxMjYuMzEiLCJSZWZ1bmRhYmxlIjoidHJ1ZSIsIlBsYXRpbmdDYXJyaWVyIjoiQVoiLCJGYXJlVHlwZSI6IlJlZnVuZGFibGUiLCJBbGxfUGFzc2VuZ2VyIjoiQURUIiwiQWR1bHRzIjoxLCJBZHVsdHNfQmFzZV9QcmljZSI6IjQ2OC4wMCIsIkFkdWx0c19UYXhfUHJpY2UiOiIxMjYuMzEiLCJUcmF2ZWxUaW1lIjoiUDBEVDdIME0wUyIsIkFpclNlZ21lbnRfS2V5IjoiS0lUMG1abW9RVHFyYW5ud2ZucjRIUT09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoibldcL0tkQmNkU05LbHZFbTdmZUhNVnc9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJBWiIsIkZsaWdodE51bWJlciI6Ijc3MTMiLCJPcmlnaW4iOiJBTVMiLCJEZXN0aW5hdGlvbiI6IkZDTyIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDA5OjUwOjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQxMjowNTowMC4wMDArMDI6MDAiLCJGbGlnaHRUaW1lIjoiMTM1IiwiRGlzdGFuY2UiOiI4MDkiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjczNyIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiQ2FjaGVkIHN0YXR1cyB1c2VkLiBQb2xsZWQgYXZhaWwgZXhpc3RzIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUCIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJDOHxFOHxEOHxJOHxZMXxCMHxNMHxIMHxLMHxWMHxUMHxOMHxTMHxRMHxYMHxXMHxMMHxPMHxGMHxSMCIsIkZsaWdodERldGFpbF9LZXkiOiJlXC9qS2E2bjFUeG0wTCtsVmdKMTFyZz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiMSIsIkJvb2tpbmdDb2RlIjoiWSIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJCajVWVFRGWVRpU3NVc0hyb2c5UFV3PT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiQmo1VlRURllUaVNzVXNIcm9nOVBVdz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHNzS3d6QU0rNWlpdTV4SHQyTkNsN0FlbWgzYU1yTERcL3Y4ejVpUlFKckNGTFNFN2hHQW9NNTB3XC9HSENkNG9mbEhNQkNveld1aFwvd1lweUg2RlJCaWtkOXZkTTVZeVJZcWxDNk9GaTZiZkhaZ3NqTUhFb0RhdTl4MjZcL1FkaEpxUkd2cHFWVGk0MGlXQ25kWDZQb0dmZW9IQ2VFblFBPT0iLCJGYXJlQmFzaXMiOiJZT1dFVTYifSx7IkFpclNlZ21lbnRfS2V5IjoiS0lUMG1abW9RVHFyYW5ud2ZucjRIUT09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IkFaIiwiRmxpZ2h0TnVtYmVyIjoiNzA2IiwiT3JpZ2luIjoiRkNPIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxNDoyNTowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTc6NTA6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjE0NSIsIkRpc3RhbmNlIjoiODY0IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMlMiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IkNhY2hlZCBzdGF0dXMgdXNlZC4gUG9sbGVkIGF2YWlsIGV4aXN0cyIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlAiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiQzd8RTd8RDd8STd8WTd8Qjd8TTd8SDd8Szd8Vjd8VDd8Tjd8Uzd8UTd8WDd8Vzd8TDd8Tzd8RjB8UjR8RzAiLCJGbGlnaHREZXRhaWxfS2V5IjoiU3pUNERcL0lTUWxlRndhZjM4STRSeGc9PSIsIk9yaWdpblRlcm1pbmFsIjoiMSIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiJJIiwiQm9va2luZ0NvZGUiOiJZIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6IkJqNVZUVEZZVGlTc1VzSHJvZzlQVXc9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJCajVWVFRGWVRpU3NVc0hyb2c5UFV3PT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Uc3NLd3pBTSs1aWl1NXhIdDJOQ2w3QWVtaDNhTXJMRFwvdjh6NWlSUUpyQ0ZMU0U3aEdBb001MHdcL0dIQ2Q0b2ZsSE1CQ296V3VoXC93WXB5SDZGUkJpa2Q5dmRNNVl5UllxbEM2T0ZpNmJmSFpnc2pNSEVvRGF1OXgyNlwvUWRoSnFSR3ZwcVZUaTQwaVdDbmRYNlBvR2Zlb0hDZUVuUUE9PSIsIkZhcmVCYXNpcyI6IllPV0VVNiJ9XSwiRmFyZXJ1bGVzcmVmX0tleSI6W1siQmo1VlRURllUaVNzVXNIcm9nOVBVdz09Il0sWyJCajVWVFRGWVRpU3NVc0hyb2c5UFV3PT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXSxbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5Uc3NLd3pBTSs1aWl1NXhIdDJOQ2w3QWVtaDNhTXJMRFwvdjh6NWlSUUpyQ0ZMU0U3aEdBb001MHdcL0dIQ2Q0b2ZsSE1CQ296V3VoXC93WXB5SDZGUkJpa2Q5dmRNNVl5UllxbEM2T0ZpNmJmSFpnc2pNSEVvRGF1OXgyNlwvUWRoSnFSR3ZwcVZUaTQwaVdDbmRYNlBvR2Zlb0hDZUVuUUE9PSJdLFsiZ3dzLWVKeE5Uc3NLd3pBTSs1aWl1NXhIdDJOQ2w3QWVtaDNhTXJMRFwvdjh6NWlSUUpyQ0ZMU0U3aEdBb001MHdcL0dIQ2Q0b2ZsSE1CQ296V3VoXC93WXB5SDZGUkJpa2Q5dmRNNVl5UllxbEM2T0ZpNmJmSFpnc2pNSEVvRGF1OXgyNlwvUWRoSnFSR3ZwcVZUaTQwaVdDbmRYNlBvR2Zlb0hDZUVuUUE9PSJdXX0=" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F5943128" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012329" data-airline="KLM Airlines" data-arrive="960" data-duration="435" data-stops="1" data-depature="525" data-airlinecode="KL" data-price="683.07" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF6830729" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/KL.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>10:45 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (SAW)</span><br>
            <div class="fsa_departure"><small>19:00 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">7h 15m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse29" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="IklPUGFncHg3UjVTcXFnQW10S0dOUFE9PXxLS3wxR3xLS3xnd3MtZUp4TlRic093eUFRKzVqSXV3MUoxQkZFaTFJbHNMUWRXUHJcL245RUxTRkV0M2RPK2N3akJVU3RuTWZ4aHduZHFEZldUZ0FwbnNjV0NaZllTWkZNRHFRWHBtVEhPUFcxYk96T3F1aVlwRTBSbTFtQk9vUFVjeSt2NmVQckJoQWJuVnp3MmExcTh2NlBaMEltR0lyaWJOKzErNEFkVE9TZGt8S0t8fFZWfElPUGFncHg3UjVTcXFnQW10S0dOUFE9PXxLS3wxR3xLS3xnd3MtZUp4TlRic093eUFRKzVqSXV3MUoxQkZFaTFJbHNMUWRXUHJcL245RUxTRkV0M2RPK2N3akJVU3RuTWZ4aHduZHFEZldUZ0FwbnNjV0NaZllTWkZNRHFRWHBtVEhPUFcxYk96T3F1aVlwRTBSbTFtQk9vUFVjeSt2NmVQckJoQWJuVnp3MmExcTh2NlBaMEltR0lyaWJOKzErNEFkVE9TZGt8S0t8dFNkQjVJandSOHFMbWJGdFJxZVVhUT09fEtLfDFHfEtLfGd3cy1lSnhOanJFT3d5QU1SRDhtdXYwY1FrSTNxSnVJcFhSSXE0aWxcL1wvOFpOYkQwSlB0a3ZaUHRHT05NV2JrSTQ1OG1mS2QwUlwva29VREJibmVtQ2lBdGJueXBJOFRoejBkZUZzY0hSUU9sd3VQVFlIblFGb2U2UVFacFFlOFwvcENmRzM0QzNiVHNLQ2FHM1BaaVU5M3ZWUUlSZFAwaVVERyt5dEgxQTlKNnc9fEtLfHxWVnx8QHwyIg==" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">683.07</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook29" id="F6830729" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiTm51XC8wRENBUStPbEJ0RjNhQ2dTM2c9PSIsIkNvbXBsZXRlSXRpbmVyYXJ5IjoiIiwiQ29ubmVjdGlvbnMiOiIwLCIsIlRvdGFsUHJpY2UiOiI2ODMuMDciLCJCYXNlUHJpY2UiOiI2NDIuMDAiLCJUYXhlcyI6IjQxLjA3IiwiVG90YWxQcmljZV9BUEkiOiJFVVI2ODMuMDciLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiI2NDIuMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiI0MS4wNyIsIlJlZnVuZGFibGUiOmZhbHNlLCJQbGF0aW5nQ2FycmllciI6IktMIiwiRmFyZVR5cGUiOiJOb24gUmVmdW5kYWJsZSIsIkFsbF9QYXNzZW5nZXIiOiJBRFQiLCJBZHVsdHMiOjEsIkFkdWx0c19CYXNlX1ByaWNlIjoiNjQyLjAwIiwiQWR1bHRzX1RheF9QcmljZSI6IjQxLjA3IiwiVHJhdmVsVGltZSI6IlAwRFQ3SDE1TTBTIiwiQWlyU2VnbWVudF9LZXkiOiJ6OUR0angrOVJPQzdqNVl5TzN3ZXhRPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiJxenpTdEp2a1NvYWl3R2l3ZkR0MENBPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiS0wiLCJGbGlnaHROdW1iZXIiOiIxNzc5IiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJIQU0iLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxMDo0NTowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTE6NTA6MDAuMDAwKzAyOjAwIiwiRmxpZ2h0VGltZSI6IjY1IiwiRGlzdGFuY2UiOiIyMzYiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjczVyIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6Iko2fEM2fEQ2fEk2fFo2fFk5fEI5fE05fFU5fEs5fFc5fEg5fFM5fEw5fEE5fFE5fFQ5fEU5fE45fFI5fFYwfFgwfEcwIiwiRmxpZ2h0RGV0YWlsX0tleSI6IkljVk9NTFBQVGoyNWQrd0thZnBGenc9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IjEiLCJCb29raW5nQ29kZSI6IloiLCJDYWJpbkNsYXNzIjoiQnVzaW5lc3MiLCJGYXJlSW5mb1JlZiI6IklPUGFncHg3UjVTcXFnQW10S0dOUFE9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJJT1BhZ3B4N1I1U3FxZ0FtdEtHTlBRPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5UYnNPd3lBUSs1akl1dzFKMUJGRWkxSWxzTFFkV1ByXC9uOUVMU0ZFdDNkTytjd2pCVVN0bk1meGh3bmRxRGZXVGdBcG5zY1dDWmZZU1pGTURxUVhwbVRIT1BXMWJPek9xdWlZcEUwUm0xbUJPb1BVY3krdjZlUHJCaEFiblZ6dzJhMXE4djZQWjBJbUdJcmliTisxKzRBZFRPU2RrIiwiRmFyZUJhc2lzIjoiQ0lGIn0seyJBaXJTZWdtZW50X0tleSI6Ino5RHRqeCs5Uk9DN2o1WXlPM3dleFE9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJBQiIsIkZsaWdodE51bWJlciI6IjQ3NjgiLCJPcmlnaW4iOiJIQU0iLCJEZXN0aW5hdGlvbiI6IlNBVyIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDE0OjQwOjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQxOTowMDowMC4wMDArMDM6MDAiLCJGbGlnaHRUaW1lIjoiMjAwIiwiRGlzdGFuY2UiOiIxMjQ1IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMjAiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUyIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJZOXxCOXxIOXxLOXxNOXxMOXxWOXxTOXxOMHxRMHxPMCIsIkZsaWdodERldGFpbF9LZXkiOiJzK2NkaGFZUFFIQzhwS0lJZDFBT1wvUT09IiwiT3JpZ2luVGVybWluYWwiOiIxIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IiIsIkJvb2tpbmdDb2RlIjoiUyIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJ0U2RCNUlqd1I4cUxtYkZ0UnFlVWFRPT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoidFNkQjVJandSOHFMbWJGdFJxZVVhUT09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOanJFT3d5QU1SRDhtdXYwY1FrSTNxSnVJcFhSSXE0aWxcL1wvOFpOYkQwSlB0a3ZaUHRHT05NV2JrSTQ1OG1mS2QwUlwva29VREJibmVtQ2lBdGJueXBJOFRoejBkZUZzY0hSUU9sd3VQVFlIblFGb2U2UVFacFFlOFwvcENmRzM0QzNiVHNLQ2FHM1BaaVU5M3ZWUUlSZFAwaVVERyt5dEgxQTlKNnc9IiwiRmFyZUJhc2lzIjoiU0hOQ09XIn1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJJT1BhZ3B4N1I1U3FxZ0FtdEtHTlBRPT0iXSxbInRTZEI1SWp3UjhxTG1iRnRScWVVYVE9PSJdXSwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjpbWyIxRyJdLFsiMUciXV0sIkZhcmVydWxlc3JlZl9jb250ZW50IjpbWyJnd3MtZUp4TlRic093eUFRKzVqSXV3MUoxQkZFaTFJbHNMUWRXUHJcL245RUxTRkV0M2RPK2N3akJVU3RuTWZ4aHduZHFEZldUZ0FwbnNjV0NaZllTWkZNRHFRWHBtVEhPUFcxYk96T3F1aVlwRTBSbTFtQk9vUFVjeSt2NmVQckJoQWJuVnp3MmExcTh2NlBaMEltR0lyaWJOKzErNEFkVE9TZGsiXSxbImd3cy1lSnhOanJFT3d5QU1SRDhtdXYwY1FrSTNxSnVJcFhSSXE0aWxcL1wvOFpOYkQwSlB0a3ZaUHRHT05NV2JrSTQ1OG1mS2QwUlwva29VREJibmVtQ2lBdGJueXBJOFRoejBkZUZzY0hSUU9sd3VQVFlIblFGb2U2UVFacFFlOFwvcENmRzM0QzNiVHNLQ2FHM1BaaVU5M3ZWUUlSZFAwaVVERyt5dEgxQTlKNnc9Il1dfQ==" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F6830729" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse29" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        10:45 AM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        11:50 AM <br>
                        <span> Fuhlsbuettel Arpt HAM</span>
                      </li>
                      <li class="rfms_emirates">
                        KLM Airlines<br>
                        <span>KL-73W</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>1h 5m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Fuhlsbuettel Arpt, | <strong>Layover:: 2h 50m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        2:40 PM <br>
                        <span>Fuhlsbuettel Arpt HAM</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        7:00 PM <br>
                        <span> Sabiha Gokcen Arpt SAW</span>
                      </li>
                      <li class="rfms_emirates">
                        Air Berlin<br>
                        <span>AB-320</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>3h 20m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 7h 15m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">683.07</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook29" id="F6830729" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiTm51XC8wRENBUStPbEJ0RjNhQ2dTM2c9PSIsIkNvbXBsZXRlSXRpbmVyYXJ5IjoiIiwiQ29ubmVjdGlvbnMiOiIwLCIsIlRvdGFsUHJpY2UiOiI2ODMuMDciLCJCYXNlUHJpY2UiOiI2NDIuMDAiLCJUYXhlcyI6IjQxLjA3IiwiVG90YWxQcmljZV9BUEkiOiJFVVI2ODMuMDciLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiI2NDIuMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiI0MS4wNyIsIlJlZnVuZGFibGUiOmZhbHNlLCJQbGF0aW5nQ2FycmllciI6IktMIiwiRmFyZVR5cGUiOiJOb24gUmVmdW5kYWJsZSIsIkFsbF9QYXNzZW5nZXIiOiJBRFQiLCJBZHVsdHMiOjEsIkFkdWx0c19CYXNlX1ByaWNlIjoiNjQyLjAwIiwiQWR1bHRzX1RheF9QcmljZSI6IjQxLjA3IiwiVHJhdmVsVGltZSI6IlAwRFQ3SDE1TTBTIiwiQWlyU2VnbWVudF9LZXkiOiJ6OUR0angrOVJPQzdqNVl5TzN3ZXhRPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiJxenpTdEp2a1NvYWl3R2l3ZkR0MENBPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiS0wiLCJGbGlnaHROdW1iZXIiOiIxNzc5IiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJIQU0iLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxMDo0NTowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTE6NTA6MDAuMDAwKzAyOjAwIiwiRmxpZ2h0VGltZSI6IjY1IiwiRGlzdGFuY2UiOiIyMzYiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjczVyIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6Iko2fEM2fEQ2fEk2fFo2fFk5fEI5fE05fFU5fEs5fFc5fEg5fFM5fEw5fEE5fFE5fFQ5fEU5fE45fFI5fFYwfFgwfEcwIiwiRmxpZ2h0RGV0YWlsX0tleSI6IkljVk9NTFBQVGoyNWQrd0thZnBGenc9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IjEiLCJCb29raW5nQ29kZSI6IloiLCJDYWJpbkNsYXNzIjoiQnVzaW5lc3MiLCJGYXJlSW5mb1JlZiI6IklPUGFncHg3UjVTcXFnQW10S0dOUFE9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJJT1BhZ3B4N1I1U3FxZ0FtdEtHTlBRPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5UYnNPd3lBUSs1akl1dzFKMUJGRWkxSWxzTFFkV1ByXC9uOUVMU0ZFdDNkTytjd2pCVVN0bk1meGh3bmRxRGZXVGdBcG5zY1dDWmZZU1pGTURxUVhwbVRIT1BXMWJPek9xdWlZcEUwUm0xbUJPb1BVY3krdjZlUHJCaEFiblZ6dzJhMXE4djZQWjBJbUdJcmliTisxKzRBZFRPU2RrIiwiRmFyZUJhc2lzIjoiQ0lGIn0seyJBaXJTZWdtZW50X0tleSI6Ino5RHRqeCs5Uk9DN2o1WXlPM3dleFE9PSIsIkdyb3VwIjoiMCIsIkNhcnJpZXIiOiJBQiIsIkZsaWdodE51bWJlciI6IjQ3NjgiLCJPcmlnaW4iOiJIQU0iLCJEZXN0aW5hdGlvbiI6IlNBVyIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDE0OjQwOjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQxOTowMDowMC4wMDArMDM6MDAiLCJGbGlnaHRUaW1lIjoiMjAwIiwiRGlzdGFuY2UiOiIxMjQ1IiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMjAiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiUyIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJZOXxCOXxIOXxLOXxNOXxMOXxWOXxTOXxOMHxRMHxPMCIsIkZsaWdodERldGFpbF9LZXkiOiJzK2NkaGFZUFFIQzhwS0lJZDFBT1wvUT09IiwiT3JpZ2luVGVybWluYWwiOiIxIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IiIsIkJvb2tpbmdDb2RlIjoiUyIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJ0U2RCNUlqd1I4cUxtYkZ0UnFlVWFRPT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoidFNkQjVJandSOHFMbWJGdFJxZVVhUT09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOanJFT3d5QU1SRDhtdXYwY1FrSTNxSnVJcFhSSXE0aWxcL1wvOFpOYkQwSlB0a3ZaUHRHT05NV2JrSTQ1OG1mS2QwUlwva29VREJibmVtQ2lBdGJueXBJOFRoejBkZUZzY0hSUU9sd3VQVFlIblFGb2U2UVFacFFlOFwvcENmRzM0QzNiVHNLQ2FHM1BaaVU5M3ZWUUlSZFAwaVVERyt5dEgxQTlKNnc9IiwiRmFyZUJhc2lzIjoiU0hOQ09XIn1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJJT1BhZ3B4N1I1U3FxZ0FtdEtHTlBRPT0iXSxbInRTZEI1SWp3UjhxTG1iRnRScWVVYVE9PSJdXSwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjpbWyIxRyJdLFsiMUciXV0sIkZhcmVydWxlc3JlZl9jb250ZW50IjpbWyJnd3MtZUp4TlRic093eUFRKzVqSXV3MUoxQkZFaTFJbHNMUWRXUHJcL245RUxTRkV0M2RPK2N3akJVU3RuTWZ4aHduZHFEZldUZ0FwbnNjV0NaZllTWkZNRHFRWHBtVEhPUFcxYk96T3F1aVlwRTBSbTFtQk9vUFVjeSt2NmVQckJoQWJuVnp3MmExcTh2NlBaMEltR0lyaWJOKzErNEFkVE9TZGsiXSxbImd3cy1lSnhOanJFT3d5QU1SRDhtdXYwY1FrSTNxSnVJcFhSSXE0aWxcL1wvOFpOYkQwSlB0a3ZaUHRHT05NV2JrSTQ1OG1mS2QwUlwva29VREJibmVtQ2lBdGJueXBJOFRoejBkZUZzY0hSUU9sd3VQVFlIblFGb2U2UVFacFFlOFwvcENmRzM0QzNiVHNLQ2FHM1BaaVU5M3ZWUUlSZFAwaVVERyt5dEgxQTlKNnc9Il1dfQ==" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F6830729" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012330" data-airline="Croatia Airlines" data-arrive="1220" data-duration="660" data-stops="1" data-depature="560" data-airlinecode="OU" data-price="757.46" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF7574630" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/OU.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>11:20 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>23:20 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">11h 0m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse30" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="ImkyK0hZdVdcL1JkV3ZQcDhiTXpTcDRBPT18S0t8MUd8S0t8Z3dzLWVKeE5Ua0VPd3lBTWUwemxld0lGdWh1b1pkdGxjR2pSVkE3N1wvek1hUUpwcUtZNGlXNDY5OTRyWTBzemtiNWp3bTNKQktpdVFvR1JxZUVFdnppcXdYQ2VJMktER1lpaFwvTVNJMGlaSzZPalozMzlOc0ZvUTRSejJVQnB5ZHcyZlwvcDdhZkVDTWF4YmVzRkxiRDVIS1ExRk1QNjZvSUR0THJBb3VLS0djPXxLS3x8VlZ8aTIrSFl1V1wvUmRXdlBwOGJNelNwNEE9PXxLS3wxR3xLS3xnd3MtZUp4TlRrRU93eUFNZTB6bGV3SUZ1aHVvWmR0bGNHalJWQTc3XC96TWFRSnBxS1k0aVc0Njk5NHJZMHN6a2I1andtM0pCS2l1UW9HUnFlRUV2emlxd1hDZUkyS0RHWWloXC9NU0kwaVpLNk9qWjMzOU5zRm9RNFJ6MlVCcHlkdzJmXC9wN2FmRUNNYXhiZXNGTGJENUhLUTFGTVA2Nm9JRHRMckFvdUtLR2M9fEtLfHBjVnVETHE5U3IyaHB6cU5LVDN4UHc9PXxLS3wxR3xLS3xnd3MtZUp4TlRrRU93eUFNZTB6bHUxTUtWVzlVZzIyOXBJZkJvVHZzXC84OVlnQjFtS1k0U1cwNWlqRE1sY0JIR1AwejRUR2VGMWh1Z21LMk9WNEZqOEZ1ZkxwRGlrWEwxeEFod3RMMTJiWFRwcnJ0UEFVUmVzaHRLQTY3TzdcLzN4eXhTMGl6QWpHdVduTmQxVDhXY3RiTTl4QzJyQ0N2dnFDeDR3SjZBPXxLS3x8VlZ8fEB8MiI=" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">757.46</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook30" id="F7574630" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiNUdRVk9jNVJUa3l5YVwvbTd1TmlwZFE9PSIsIkNvbXBsZXRlSXRpbmVyYXJ5IjoiIiwiQ29ubmVjdGlvbnMiOiIwLCIsIlRvdGFsUHJpY2UiOiI3NTcuNDYiLCJCYXNlUHJpY2UiOiI2MzQuMDAiLCJUYXhlcyI6IjEyMy40NiIsIlRvdGFsUHJpY2VfQVBJIjoiRVVSNzU3LjQ2IiwiQVBJQ3VycmVuY3lUeXBlIjoiRVVSIiwiU0lURUN1cnJlbmN5VHlwZSI6IkVVUiIsIk15TWFya3VwIjowLCJhTWFya3VwIjowLCJCYXNlUHJpY2VfQnJlYWtkb3duIjoiNjM0LjAwIiwiVGF4UHJpY2VfQnJlYWtkb3duIjoiMTIzLjQ2IiwiUmVmdW5kYWJsZSI6InRydWUiLCJQbGF0aW5nQ2FycmllciI6Ik9VIiwiRmFyZVR5cGUiOiJSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiI2MzQuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiMTIzLjQ2IiwiVHJhdmVsVGltZSI6IlAwRFQxMUgwTTBTIiwiQWlyU2VnbWVudF9LZXkiOiJYNXBCSXNcL1lSYWVkYWRlT0I2ajI0dz09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoiNVM4cTIrMk1TM2loQnFLNXd0bWlCZz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6Ik9VIiwiRmxpZ2h0TnVtYmVyIjoiNDUxIiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJaQUciLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxMToyMDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTM6MTU6MDAuMDAwKzAyOjAwIiwiRmxpZ2h0VGltZSI6IjExNSIsIkRpc3RhbmNlIjoiNjgzIiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMTkiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiTCIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJDOXxEN3xaNHxZNHxCMXxNMHxIMHxRMHxWMHxXMHxTMHxUMHxFMHxMMHxHMCIsIkZsaWdodERldGFpbF9LZXkiOiI2ejdwU1FqY1NJcU1oS1VsMWtVVXlRPT0iLCJPcmlnaW5UZXJtaW5hbCI6IiIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiIiLCJCb29raW5nQ29kZSI6IloiLCJDYWJpbkNsYXNzIjoiQnVzaW5lc3MiLCJGYXJlSW5mb1JlZiI6ImkyK0hZdVdcL1JkV3ZQcDhiTXpTcDRBPT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiaTIrSFl1V1wvUmRXdlBwOGJNelNwNEE9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRrRU93eUFNZTB6bGV3SUZ1aHVvWmR0bGNHalJWQTc3XC96TWFRSnBxS1k0aVc0Njk5NHJZMHN6a2I1andtM0pCS2l1UW9HUnFlRUV2emlxd1hDZUkyS0RHWWloXC9NU0kwaVpLNk9qWjMzOU5zRm9RNFJ6MlVCcHlkdzJmXC9wN2FmRUNNYXhiZXNGTGJENUhLUTFGTVA2Nm9JRHRMckFvdUtLR2M9IiwiRmFyZUJhc2lzIjoiWkVVNTBPVyJ9LHsiQWlyU2VnbWVudF9LZXkiOiJYNXBCSXNcL1lSYWVkYWRlT0I2ajI0dz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6Ik9VIiwiRmxpZ2h0TnVtYmVyIjoiNTM1MiIsIk9yaWdpbiI6IlpBRyIsIkRlc3RpbmF0aW9uIjoiSVNUIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMjA6MTA6MDAuMDAwKzAyOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA0LTMwVDIzOjIwOjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIxMzAiLCJEaXN0YW5jZSI6IjczMSIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzE5IiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IkwiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiQzR8RDR8WTR8QjR8TTR8SDR8UTR8VjR8VzR8UzR8VDQiLCJGbGlnaHREZXRhaWxfS2V5IjoiRlliT20xdHdRREdRdEJzSlBNWHMrZz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiRCIsIkNhYmluQ2xhc3MiOiJCdXNpbmVzcyIsIkZhcmVJbmZvUmVmIjoicGNWdURMcTlTcjJocHpxTktUM3hQdz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6InBjVnVETHE5U3IyaHB6cU5LVDN4UHc9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRrRU93eUFNZTB6bHUxTUtWVzlVZzIyOXBJZkJvVHZzXC84OVlnQjFtS1k0U1cwNWlqRE1sY0JIR1AwejRUR2VGMWh1Z21LMk9WNEZqOEZ1ZkxwRGlrWEwxeEFod3RMMTJiWFRwcnJ0UEFVUmVzaHRLQTY3TzdcLzN4eXhTMGl6QWpHdVduTmQxVDhXY3RiTTl4QzJyQ0N2dnFDeDR3SjZBPSIsIkZhcmVCYXNpcyI6IkRFVTUwIn1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJpMitIWXVXXC9SZFd2UHA4Yk16U3A0QT09Il0sWyJwY1Z1RExxOVNyMmhwenFOS1QzeFB3PT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXSxbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5Ua0VPd3lBTWUwemxld0lGdWh1b1pkdGxjR2pSVkE3N1wvek1hUUpwcUtZNGlXNDY5OTRyWTBzemtiNWp3bTNKQktpdVFvR1JxZUVFdnppcXdYQ2VJMktER1lpaFwvTVNJMGlaSzZPalozMzlOc0ZvUTRSejJVQnB5ZHcyZlwvcDdhZkVDTWF4YmVzRkxiRDVIS1ExRk1QNjZvSUR0THJBb3VLS0djPSJdLFsiZ3dzLWVKeE5Ua0VPd3lBTWUwemx1MU1LVlc5VWcyMjlwSWZCb1R2c1wvODlZZ0IxbUtZNFNXMDVpakRNbGNCSEdQMHo0VEdlRjFodWdtSzJPVjRGajhGdWZMcERpa1hMMXhBaHd0TDEyYlhUcHJydFBBVVJlc2h0S0E2N083XC8zeHl4UzBpekFqR3VXbk5kMVQ4V2N0Yk05eEMyckNDdnZxQ3g0d0o2QT0iXV19" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F7574630" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse30" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        11:20 AM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        1:15 PM <br>
                        <span> Zagreb Arpt ZAG</span>
                      </li>
                      <li class="rfms_emirates">
                        Croatia Airlines<br>
                        <span>OU-319</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>1h 55m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Zagreb Arpt, | <strong>Layover:: 6h 55m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        8:10 PM <br>
                        <span>Zagreb Arpt ZAG</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        11:20 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        Croatia Airlines<br>
                        <span>OU-319</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>2h 10m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 11h 0m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">757.46</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook30" id="F7574630" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiNUdRVk9jNVJUa3l5YVwvbTd1TmlwZFE9PSIsIkNvbXBsZXRlSXRpbmVyYXJ5IjoiIiwiQ29ubmVjdGlvbnMiOiIwLCIsIlRvdGFsUHJpY2UiOiI3NTcuNDYiLCJCYXNlUHJpY2UiOiI2MzQuMDAiLCJUYXhlcyI6IjEyMy40NiIsIlRvdGFsUHJpY2VfQVBJIjoiRVVSNzU3LjQ2IiwiQVBJQ3VycmVuY3lUeXBlIjoiRVVSIiwiU0lURUN1cnJlbmN5VHlwZSI6IkVVUiIsIk15TWFya3VwIjowLCJhTWFya3VwIjowLCJCYXNlUHJpY2VfQnJlYWtkb3duIjoiNjM0LjAwIiwiVGF4UHJpY2VfQnJlYWtkb3duIjoiMTIzLjQ2IiwiUmVmdW5kYWJsZSI6InRydWUiLCJQbGF0aW5nQ2FycmllciI6Ik9VIiwiRmFyZVR5cGUiOiJSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiI2MzQuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiMTIzLjQ2IiwiVHJhdmVsVGltZSI6IlAwRFQxMUgwTTBTIiwiQWlyU2VnbWVudF9LZXkiOiJYNXBCSXNcL1lSYWVkYWRlT0I2ajI0dz09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoiNVM4cTIrMk1TM2loQnFLNXd0bWlCZz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6Ik9VIiwiRmxpZ2h0TnVtYmVyIjoiNDUxIiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJaQUciLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxMToyMDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTM6MTU6MDAuMDAwKzAyOjAwIiwiRmxpZ2h0VGltZSI6IjExNSIsIkRpc3RhbmNlIjoiNjgzIiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMTkiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IlBvbGxlZCBhdmFpbCB1c2VkIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiTCIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJDOXxEN3xaNHxZNHxCMXxNMHxIMHxRMHxWMHxXMHxTMHxUMHxFMHxMMHxHMCIsIkZsaWdodERldGFpbF9LZXkiOiI2ejdwU1FqY1NJcU1oS1VsMWtVVXlRPT0iLCJPcmlnaW5UZXJtaW5hbCI6IiIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiIiLCJCb29raW5nQ29kZSI6IloiLCJDYWJpbkNsYXNzIjoiQnVzaW5lc3MiLCJGYXJlSW5mb1JlZiI6ImkyK0hZdVdcL1JkV3ZQcDhiTXpTcDRBPT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiaTIrSFl1V1wvUmRXdlBwOGJNelNwNEE9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRrRU93eUFNZTB6bGV3SUZ1aHVvWmR0bGNHalJWQTc3XC96TWFRSnBxS1k0aVc0Njk5NHJZMHN6a2I1andtM0pCS2l1UW9HUnFlRUV2emlxd1hDZUkyS0RHWWloXC9NU0kwaVpLNk9qWjMzOU5zRm9RNFJ6MlVCcHlkdzJmXC9wN2FmRUNNYXhiZXNGTGJENUhLUTFGTVA2Nm9JRHRMckFvdUtLR2M9IiwiRmFyZUJhc2lzIjoiWkVVNTBPVyJ9LHsiQWlyU2VnbWVudF9LZXkiOiJYNXBCSXNcL1lSYWVkYWRlT0I2ajI0dz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6Ik9VIiwiRmxpZ2h0TnVtYmVyIjoiNTM1MiIsIk9yaWdpbiI6IlpBRyIsIkRlc3RpbmF0aW9uIjoiSVNUIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMjA6MTA6MDAuMDAwKzAyOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA0LTMwVDIzOjIwOjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIxMzAiLCJEaXN0YW5jZSI6IjczMSIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzE5IiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IkwiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiQzR8RDR8WTR8QjR8TTR8SDR8UTR8VjR8VzR8UzR8VDQiLCJGbGlnaHREZXRhaWxfS2V5IjoiRlliT20xdHdRREdRdEJzSlBNWHMrZz09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiRCIsIkNhYmluQ2xhc3MiOiJCdXNpbmVzcyIsIkZhcmVJbmZvUmVmIjoicGNWdURMcTlTcjJocHpxTktUM3hQdz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6InBjVnVETHE5U3IyaHB6cU5LVDN4UHc9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRrRU93eUFNZTB6bHUxTUtWVzlVZzIyOXBJZkJvVHZzXC84OVlnQjFtS1k0U1cwNWlqRE1sY0JIR1AwejRUR2VGMWh1Z21LMk9WNEZqOEZ1ZkxwRGlrWEwxeEFod3RMMTJiWFRwcnJ0UEFVUmVzaHRLQTY3TzdcLzN4eXhTMGl6QWpHdVduTmQxVDhXY3RiTTl4QzJyQ0N2dnFDeDR3SjZBPSIsIkZhcmVCYXNpcyI6IkRFVTUwIn1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJpMitIWXVXXC9SZFd2UHA4Yk16U3A0QT09Il0sWyJwY1Z1RExxOVNyMmhwenFOS1QzeFB3PT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXSxbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5Ua0VPd3lBTWUwemxld0lGdWh1b1pkdGxjR2pSVkE3N1wvek1hUUpwcUtZNGlXNDY5OTRyWTBzemtiNWp3bTNKQktpdVFvR1JxZUVFdnppcXdYQ2VJMktER1lpaFwvTVNJMGlaSzZPalozMzlOc0ZvUTRSejJVQnB5ZHcyZlwvcDdhZkVDTWF4YmVzRkxiRDVIS1ExRk1QNjZvSUR0THJBb3VLS0djPSJdLFsiZ3dzLWVKeE5Ua0VPd3lBTWUwemx1MU1LVlc5VWcyMjlwSWZCb1R2c1wvODlZZ0IxbUtZNFNXMDVpakRNbGNCSEdQMHo0VEdlRjFodWdtSzJPVjRGajhGdWZMcERpa1hMMXhBaHd0TDEyYlhUcHJydFBBVVJlc2h0S0E2N083XC8zeHl4UzBpekFqR3VXbk5kMVQ4V2N0Yk05eEMyckNDdnZxQ3g0d0o2QT0iXV19" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F7574630" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012331" data-airline="Scandinavian Airlines" data-arrive="1185" data-duration="645" data-stops="1" data-depature="540" data-airlinecode="SK" data-price="1159.12" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF11591231" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/SK.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>11:00 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>22:45 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">10h 45m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse31" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="IkswQ0hzZ2NKVFIycFFzU0ErOURzeXc9PXxLS3wxR3xLS3xnd3MtZUp4TlRVRU93akFNZTh6a3U1TzFnOTFhU2lVa1JBNFVEcnZ3XC8yZVF0aExDVWh6RmRwS1VrbEkyQm1INnc0TFAwdTZ3ZHdFTTZwV2Zocmp1WjRYNGRJQ1VpT3FadWI3U1ZSdk83REl5Ull1QXFGcmlkRHB3RE02UDlydllcLzhHRDZGUnYzaXhmWDVmY0toa1k5czNsRVwvemJGM2lhSnBBPXxLS3x8VlZ8SzBDSHNnY0pUUjJwUXNTQSs5RHN5dz09fEtLfDFHfEtLfGd3cy1lSnhOVFVFT3dqQU1lOHprdTVPMWc5MWFTaVVrUkE0VURydndcLzJlUXRoTENVaHpGZHBLVWtsSTJCbUg2dzRMUDB1Nndkd0VNNnBXZmhyanVaNFg0ZElDVWlPcVp1YjdTVlJ2TzdESXlSWXVBcUZyaWREcHdETTZQOXJ2WVwvOEdENkZSdjNpeGZYNWZjS2hrWTlzM2xFXC96YkYzaWFKcEE9fEtLfHRkZmM5a1VWUnRXVjdJTnJkZEZrMUE9PXxLS3wxR3xLS3xnd3MtZUp4TlRVRU9nekFNZXd6eTNXbUJ3YTJscTdScFVnNFVEbHoyXC8yZVF0anZNVWh6RmRwSVFncVBNSElYaER3TytRXC9sQXp3UW9uTlc3SEppNStMVk5GMGlaa0MzVDF6MU4xZWIwTGkyVFhCSVEyYVdwT3hXNEdzZGRmeGNGOVI4c2lFcjVaVTNqODloaXllVEkxUzhtUDJEZmJvQkJKcDg9fEtLfHxWVnx8QHwyIg==" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">1159.12</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook31" id="F11591231" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiOTVERXArR2hTR2loY3hhS3NONVc2QT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjExNTkuMTIiLCJCYXNlUHJpY2UiOiIxMDQ5LjAwIiwiVGF4ZXMiOiIxMTAuMTIiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjExNTkuMTIiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIxMDQ5LjAwIiwiVGF4UHJpY2VfQnJlYWtkb3duIjoiMTEwLjEyIiwiUmVmdW5kYWJsZSI6InRydWUiLCJQbGF0aW5nQ2FycmllciI6IlNLIiwiRmFyZVR5cGUiOiJSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIxMDQ5LjAwIiwiQWR1bHRzX1RheF9QcmljZSI6IjExMC4xMiIsIlRyYXZlbFRpbWUiOiJQMERUMTBINDVNMFMiLCJBaXJTZWdtZW50X0tleSI6ImhjYU9HRzBaUTI2M0NqT3cwUDFXXC9BPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiJsWGNuOTVqNlRvZThlam5DVXRiNmVBPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiU0siLCJGbGlnaHROdW1iZXIiOiI1NTYiLCJPcmlnaW4iOiJBTVMiLCJEZXN0aW5hdGlvbiI6IkFSTiIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDExOjAwOjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQxMjo1NTowMC4wMDArMDI6MDAiLCJGbGlnaHRUaW1lIjoiMTE1IiwiRGlzdGFuY2UiOiI2ODciLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjczSCIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6IkM5fEQ5fFo5fFI5fEo5fFk5fFM5fEIwfFAwfEEwfEU5fE05fEg5fFE5fFYwfFc5fFU5fEswfEwwfFQwfE8wfEc5fE45IiwiRmxpZ2h0RGV0YWlsX0tleSI6IkdTeHpCbHdCUlQ2WlRhTTVrenc1aHc9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IjUiLCJCb29raW5nQ29kZSI6IkUiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiSzBDSHNnY0pUUjJwUXNTQSs5RHN5dz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IkswQ0hzZ2NKVFIycFFzU0ErOURzeXc9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRVRU93akFNZTh6a3U1TzFnOTFhU2lVa1JBNFVEcnZ3XC8yZVF0aExDVWh6RmRwS1VrbEkyQm1INnc0TFAwdTZ3ZHdFTTZwV2Zocmp1WjRYNGRJQ1VpT3FadWI3U1ZSdk83REl5Ull1QXFGcmlkRHB3RE02UDlydllcLzhHRDZGUnYzaXhmWDVmY0toa1k5czNsRVwvemJGM2lhSnBBPSIsIkZhcmVCYXNpcyI6IkVTSyJ9LHsiQWlyU2VnbWVudF9LZXkiOiJoY2FPR0cwWlEyNjNDak93MFAxV1wvQT09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlNLIiwiRmxpZ2h0TnVtYmVyIjoiMzQyMCIsIk9yaWdpbiI6IkFSTiIsIkRlc3RpbmF0aW9uIjoiSVNUIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMTg6MTU6MDAuMDAwKzAyOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA0LTMwVDIyOjQ1OjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIyMTAiLCJEaXN0YW5jZSI6IjEzNjkiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjMyMSIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6IkM0fEo0fFk0fEU0fE00fEg0fFE0fFc0fFU0fEswfEwwfFQwIiwiRmxpZ2h0RGV0YWlsX0tleSI6IjdxVjYwbnJ2UzRtWnQ1MVBuUWFFenc9PSIsIk9yaWdpblRlcm1pbmFsIjoiNSIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiJJIiwiQm9va2luZ0NvZGUiOiJFIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6InRkZmM5a1VWUnRXVjdJTnJkZEZrMUE9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJ0ZGZjOWtVVlJ0V1Y3SU5yZGRGazFBPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5UVUVPZ3pBTWV3enkzV21Cd2EybHE3UnBVZzRVRGx6MlwvMmVRdGp2TVVoekZkcElRZ3FQTUhJWGhEd08rUVwvbEF6d1Fvbk5XN0hKaTUrTFZORjBpWmtDM1QxejFOMWViMExpMlRYQklRMmFXcE94VzRHc2RkZnhjRjlSOHNpRXI1WlUzajg5aGl5ZVRJMVM4bVAyRGZib0JCSnA4PSIsIkZhcmVCYXNpcyI6IkVTSyJ9XSwiRmFyZXJ1bGVzcmVmX0tleSI6W1siSzBDSHNnY0pUUjJwUXNTQSs5RHN5dz09Il0sWyJ0ZGZjOWtVVlJ0V1Y3SU5yZGRGazFBPT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXSxbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5UVUVPd2pBTWU4emt1NU8xZzkxYVNpVWtSQTRVRHJ2d1wvMmVRdGhMQ1VoekZkcEtVa2xJMkJtSDZ3NExQMHU2d2R3RU02cFdmaHJqdVo0WDRkSUNVaU9xWnViN1NWUnZPN0RJeVJZdUFxRnJpZERwd0RNNlA5cnZZXC84R0Q2RlJ2M2l4Zlg1ZmNLaGtZOXMzbEVcL3piRjNpYUpwQT0iXSxbImd3cy1lSnhOVFVFT2d6QU1ld3p5M1dtQndhMmxxN1JwVWc0VURsejJcLzJlUXRqdk1VaHpGZHBJUWdxUE1ISVhoRHdPK1FcL2xBendRb25OVzdISmk1K0xWTkYwaVprQzNUMXoxTjFlYjBMaTJUWEJJUTJhV3BPeFc0R3NkZGZ4Y0Y5UjhzaUVyNVpVM2o4OWhpeWVUSTFTOG1QMkRmYm9CQkpwOD0iXV19" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F11591231" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse31" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        11:00 AM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        12:55 PM <br>
                        <span> Arlanda Arpt ARN</span>
                      </li>
                      <li class="rfms_emirates">
                        Scandinavian Airlines<br>
                        <span>SK-73H</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>1h 55m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Arlanda Arpt, | <strong>Layover:: 5h 20m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        6:15 PM <br>
                        <span>Arlanda Arpt ARN</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        10:45 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        Scandinavian Airlines<br>
                        <span>SK-321</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>3h 30m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 10h 45m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">1159.12</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook31" id="F11591231" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiOTVERXArR2hTR2loY3hhS3NONVc2QT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjExNTkuMTIiLCJCYXNlUHJpY2UiOiIxMDQ5LjAwIiwiVGF4ZXMiOiIxMTAuMTIiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjExNTkuMTIiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIxMDQ5LjAwIiwiVGF4UHJpY2VfQnJlYWtkb3duIjoiMTEwLjEyIiwiUmVmdW5kYWJsZSI6InRydWUiLCJQbGF0aW5nQ2FycmllciI6IlNLIiwiRmFyZVR5cGUiOiJSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIxMDQ5LjAwIiwiQWR1bHRzX1RheF9QcmljZSI6IjExMC4xMiIsIlRyYXZlbFRpbWUiOiJQMERUMTBINDVNMFMiLCJBaXJTZWdtZW50X0tleSI6ImhjYU9HRzBaUTI2M0NqT3cwUDFXXC9BPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiJsWGNuOTVqNlRvZThlam5DVXRiNmVBPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiU0siLCJGbGlnaHROdW1iZXIiOiI1NTYiLCJPcmlnaW4iOiJBTVMiLCJEZXN0aW5hdGlvbiI6IkFSTiIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDExOjAwOjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQxMjo1NTowMC4wMDArMDI6MDAiLCJGbGlnaHRUaW1lIjoiMTE1IiwiRGlzdGFuY2UiOiI2ODciLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjczSCIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6IkM5fEQ5fFo5fFI5fEo5fFk5fFM5fEIwfFAwfEEwfEU5fE05fEg5fFE5fFYwfFc5fFU5fEswfEwwfFQwfE8wfEc5fE45IiwiRmxpZ2h0RGV0YWlsX0tleSI6IkdTeHpCbHdCUlQ2WlRhTTVrenc1aHc9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IjUiLCJCb29raW5nQ29kZSI6IkUiLCJDYWJpbkNsYXNzIjoiRWNvbm9teSIsIkZhcmVJbmZvUmVmIjoiSzBDSHNnY0pUUjJwUXNTQSs5RHN5dz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IkswQ0hzZ2NKVFIycFFzU0ErOURzeXc9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRVRU93akFNZTh6a3U1TzFnOTFhU2lVa1JBNFVEcnZ3XC8yZVF0aExDVWh6RmRwS1VrbEkyQm1INnc0TFAwdTZ3ZHdFTTZwV2Zocmp1WjRYNGRJQ1VpT3FadWI3U1ZSdk83REl5Ull1QXFGcmlkRHB3RE02UDlydllcLzhHRDZGUnYzaXhmWDVmY0toa1k5czNsRVwvemJGM2lhSnBBPSIsIkZhcmVCYXNpcyI6IkVTSyJ9LHsiQWlyU2VnbWVudF9LZXkiOiJoY2FPR0cwWlEyNjNDak93MFAxV1wvQT09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlNLIiwiRmxpZ2h0TnVtYmVyIjoiMzQyMCIsIk9yaWdpbiI6IkFSTiIsIkRlc3RpbmF0aW9uIjoiSVNUIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMTg6MTU6MDAuMDAwKzAyOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA0LTMwVDIyOjQ1OjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIyMTAiLCJEaXN0YW5jZSI6IjEzNjkiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjMyMSIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6IkM0fEo0fFk0fEU0fE00fEg0fFE0fFc0fFU0fEswfEwwfFQwIiwiRmxpZ2h0RGV0YWlsX0tleSI6IjdxVjYwbnJ2UzRtWnQ1MVBuUWFFenc9PSIsIk9yaWdpblRlcm1pbmFsIjoiNSIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiJJIiwiQm9va2luZ0NvZGUiOiJFIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6InRkZmM5a1VWUnRXVjdJTnJkZEZrMUE9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJ0ZGZjOWtVVlJ0V1Y3SU5yZGRGazFBPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5UVUVPZ3pBTWV3enkzV21Cd2EybHE3UnBVZzRVRGx6MlwvMmVRdGp2TVVoekZkcElRZ3FQTUhJWGhEd08rUVwvbEF6d1Fvbk5XN0hKaTUrTFZORjBpWmtDM1QxejFOMWViMExpMlRYQklRMmFXcE94VzRHc2RkZnhjRjlSOHNpRXI1WlUzajg5aGl5ZVRJMVM4bVAyRGZib0JCSnA4PSIsIkZhcmVCYXNpcyI6IkVTSyJ9XSwiRmFyZXJ1bGVzcmVmX0tleSI6W1siSzBDSHNnY0pUUjJwUXNTQSs5RHN5dz09Il0sWyJ0ZGZjOWtVVlJ0V1Y3SU5yZGRGazFBPT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXSxbIjFHIl1dLCJGYXJlcnVsZXNyZWZfY29udGVudCI6W1siZ3dzLWVKeE5UVUVPd2pBTWU4emt1NU8xZzkxYVNpVWtSQTRVRHJ2d1wvMmVRdGhMQ1VoekZkcEtVa2xJMkJtSDZ3NExQMHU2d2R3RU02cFdmaHJqdVo0WDRkSUNVaU9xWnViN1NWUnZPN0RJeVJZdUFxRnJpZERwd0RNNlA5cnZZXC84R0Q2RlJ2M2l4Zlg1ZmNLaGtZOXMzbEVcL3piRjNpYUpwQT0iXSxbImd3cy1lSnhOVFVFT2d6QU1ld3p5M1dtQndhMmxxN1JwVWc0VURsejJcLzJlUXRqdk1VaHpGZHBJUWdxUE1ISVhoRHdPK1FcL2xBendRb25OVzdISmk1K0xWTkYwaVprQzNUMXoxTjFlYjBMaTJUWEJJUTJhV3BPeFc0R3NkZGZ4Y0Y5UjhzaUVyNVpVM2o4OWhpeWVUSTFTOG1QMkRmYm9CQkpwOD0iXV19" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F11591231" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012332" data-airline="Scandinavian Airlines" data-arrive="1195" data-duration="435" data-stops="1" data-depature="760" data-airlinecode="SK" data-price="1161.08" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF11610832" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/SK.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>14:40 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>22:55 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">7h 15m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse32" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="IlRjbHNqUndaUVhXUG1Ea3VGakFmR2c9PXxLS3wxR3xLS3xnd3MtZUp4TlRVRU9nekFNZXd6eTNTN1FjNnR1MWRCRUw0VkRMXC96XC9HUXZ0WVZoSzRzUk9Fa0p3bE9jaWhnY21YRk5yS0djQ0NwekZWZzlJeTZ3VnNyYUJOSnEyakxFXC8wNmFsSzZPcWU1SXlRV1JtRGVVR1dzOXhyXC8rVDkwZVkweUNcL0V1K1BzUlpmUjdSSGRLSmhsMm1lNXE1ZlwvQUQ5WkNoSXxLS3x8VlZ8fEB8MSI=" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">1161.08</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook32" id="F11610832" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiQ0Q2bWNUTnJUUEdldVZwaGdycnFDZz09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjExNjEuMDgiLCJCYXNlUHJpY2UiOiIxMDQ0LjAwIiwiVGF4ZXMiOiIxMTcuMDgiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjExNjEuMDgiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIxMDQ0LjAwIiwiVGF4UHJpY2VfQnJlYWtkb3duIjoiMTE3LjA4IiwiUmVmdW5kYWJsZSI6InRydWUiLCJQbGF0aW5nQ2FycmllciI6IlNLIiwiRmFyZVR5cGUiOiJSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIxMDQ0LjAwIiwiQWR1bHRzX1RheF9QcmljZSI6IjExNy4wOCIsIlRyYXZlbFRpbWUiOiJQMERUN0gxNU0wUyIsIkFpclNlZ21lbnRfS2V5IjoiWW1BcHlsNFNTSktvWmdwQlRwalpqZz09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoiekNBb3ZDR29SYU9pZkNZYzFWdXMxQT09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlNLIiwiRmxpZ2h0TnVtYmVyIjoiNTQ4IiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJDUEgiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxNDo0MDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTY6MDA6MDAuMDAwKzAyOjAwIiwiRmxpZ2h0VGltZSI6IjgwIiwiRGlzdGFuY2UiOiIzOTMiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjczVyIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6IkM4fEQ4fFo4fFI1fEo4fFk3fFM2fEI1fFAzfEEyfEU5fE05fEg5fFE5fFYwfFc5fFU5fEs2fEwxfFQxfE8wfEc5fE4zIiwiRmxpZ2h0RGV0YWlsX0tleSI6ImVFXC9aMDlzcVFpTzlTZ2hXTXNkbVwvQT09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiMyIsIkJvb2tpbmdDb2RlIjoiQyIsIkNhYmluQ2xhc3MiOiJCdXNpbmVzcyIsIkZhcmVJbmZvUmVmIjoiVGNsc2pSd1pRWFdQbURrdUZqQWZHZz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IlRjbHNqUndaUVhXUG1Ea3VGakFmR2c9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRVRU9nekFNZXd6eTNTN1FjNnR1MWRCRUw0VkRMXC96XC9HUXZ0WVZoSzRzUk9Fa0p3bE9jaWhnY21YRk5yS0djQ0NwekZWZzlJeTZ3VnNyYUJOSnEyakxFXC8wNmFsSzZPcWU1SXlRV1JtRGVVR1dzOXhyXC8rVDkwZVkweUNcL0V1K1BzUlpmUjdSSGRLSmhsMm1lNXE1ZlwvQUQ5WkNoSSIsIkZhcmVCYXNpcyI6IkNJRiJ9LHsiQWlyU2VnbWVudF9LZXkiOiJZbUFweWw0U1NKS29aZ3BCVHBqWmpnPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiU0siLCJGbGlnaHROdW1iZXIiOiIzNDA0IiwiT3JpZ2luIjoiQ1BIIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxODozNTowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMjI6NTU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjIwMCIsIkRpc3RhbmNlIjoiMTI1NyIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzJCIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiQzR8SjR8WTR8RTR8TTR8SDR8UTR8VzB8VTB8SzB8TDB8VDAiLCJGbGlnaHREZXRhaWxfS2V5IjoicmJ2M1wvUUlGUnhhZWtRWXNwQzJONGc9PSIsIk9yaWdpblRlcm1pbmFsIjoiMiIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiJJIiwiQm9va2luZ0NvZGUiOiJDIiwiQ2FiaW5DbGFzcyI6IkJ1c2luZXNzIiwiRmFyZUluZm9SZWYiOiJUY2xzalJ3WlFYV1BtRGt1RmpBZkdnPT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiVGNsc2pSd1pRWFdQbURrdUZqQWZHZz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVFVFT2d6QU1ld3p5M1M3UWM2dHUxZEJFTDRWRExcL3pcL0dRdnRZVmhLNHNST0VrSndsT2NpaGdjbVhGTnJLR2NDQ3B6RlZnOUl5NndWc3JhQk5KcTJqTEVcLzA2YWxLNk9xZTVJeVFXUm1EZVVHV3M5eHJcLytUOTBlWTB5Q1wvRXUrUHNSWmZSN1JIZEtKaGwybWU1cTVmXC9BRDlaQ2hJIiwiRmFyZUJhc2lzIjoiQ0lGIn1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJUY2xzalJ3WlFYV1BtRGt1RmpBZkdnPT0iXSxbIlRjbHNqUndaUVhXUG1Ea3VGakFmR2c9PSJdXSwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjpbWyIxRyJdLFsiMUciXV0sIkZhcmVydWxlc3JlZl9jb250ZW50IjpbWyJnd3MtZUp4TlRVRU9nekFNZXd6eTNTN1FjNnR1MWRCRUw0VkRMXC96XC9HUXZ0WVZoSzRzUk9Fa0p3bE9jaWhnY21YRk5yS0djQ0NwekZWZzlJeTZ3VnNyYUJOSnEyakxFXC8wNmFsSzZPcWU1SXlRV1JtRGVVR1dzOXhyXC8rVDkwZVkweUNcL0V1K1BzUlpmUjdSSGRLSmhsMm1lNXE1ZlwvQUQ5WkNoSSJdLFsiZ3dzLWVKeE5UVUVPZ3pBTWV3enkzUzdRYzZ0dTFkQkVMNFZETFwvelwvR1F2dFlWaEs0c1JPRWtKd2xPY2loZ2NtWEZOcktHY0NDcHpGVmc5SXk2d1ZzcmFCTkpxMmpMRVwvMDZhbEs2T3FlNUl5UVdSbURlVUdXczl4clwvK1Q5MGVZMHlDXC9FdStQc1JaZlI3UkhkS0pobDJtZTVxNWZcL0FEOVpDaEkiXV19" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F11610832" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse32" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        2:40 PM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        4:00 PM <br>
                        <span> Copenhagen Arpt CPH</span>
                      </li>
                      <li class="rfms_emirates">
                        Scandinavian Airlines<br>
                        <span>SK-73W</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>1h 20m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Copenhagen Arpt, | <strong>Layover:: 2h 35m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        6:35 PM <br>
                        <span>Copenhagen Arpt CPH</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        10:55 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        Scandinavian Airlines<br>
                        <span>SK-32B</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>3h 20m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 7h 15m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">1161.08</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook32" id="F11610832" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiQ0Q2bWNUTnJUUEdldVZwaGdycnFDZz09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjExNjEuMDgiLCJCYXNlUHJpY2UiOiIxMDQ0LjAwIiwiVGF4ZXMiOiIxMTcuMDgiLCJUb3RhbFByaWNlX0FQSSI6IkVVUjExNjEuMDgiLCJBUElDdXJyZW5jeVR5cGUiOiJFVVIiLCJTSVRFQ3VycmVuY3lUeXBlIjoiRVVSIiwiTXlNYXJrdXAiOjAsImFNYXJrdXAiOjAsIkJhc2VQcmljZV9CcmVha2Rvd24iOiIxMDQ0LjAwIiwiVGF4UHJpY2VfQnJlYWtkb3duIjoiMTE3LjA4IiwiUmVmdW5kYWJsZSI6InRydWUiLCJQbGF0aW5nQ2FycmllciI6IlNLIiwiRmFyZVR5cGUiOiJSZWZ1bmRhYmxlIiwiQWxsX1Bhc3NlbmdlciI6IkFEVCIsIkFkdWx0cyI6MSwiQWR1bHRzX0Jhc2VfUHJpY2UiOiIxMDQ0LjAwIiwiQWR1bHRzX1RheF9QcmljZSI6IjExNy4wOCIsIlRyYXZlbFRpbWUiOiJQMERUN0gxNU0wUyIsIkFpclNlZ21lbnRfS2V5IjoiWW1BcHlsNFNTSktvWmdwQlRwalpqZz09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoiekNBb3ZDR29SYU9pZkNZYzFWdXMxQT09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlNLIiwiRmxpZ2h0TnVtYmVyIjoiNTQ4IiwiT3JpZ2luIjoiQU1TIiwiRGVzdGluYXRpb24iOiJDUEgiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxNDo0MDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTY6MDA6MDAuMDAwKzAyOjAwIiwiRmxpZ2h0VGltZSI6IjgwIiwiRGlzdGFuY2UiOiIzOTMiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjczVyIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6IkM4fEQ4fFo4fFI1fEo4fFk3fFM2fEI1fFAzfEEyfEU5fE05fEg5fFE5fFYwfFc5fFU5fEs2fEwxfFQxfE8wfEc5fE4zIiwiRmxpZ2h0RGV0YWlsX0tleSI6ImVFXC9aMDlzcVFpTzlTZ2hXTXNkbVwvQT09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiMyIsIkJvb2tpbmdDb2RlIjoiQyIsIkNhYmluQ2xhc3MiOiJCdXNpbmVzcyIsIkZhcmVJbmZvUmVmIjoiVGNsc2pSd1pRWFdQbURrdUZqQWZHZz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IlRjbHNqUndaUVhXUG1Ea3VGakFmR2c9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRVRU9nekFNZXd6eTNTN1FjNnR1MWRCRUw0VkRMXC96XC9HUXZ0WVZoSzRzUk9Fa0p3bE9jaWhnY21YRk5yS0djQ0NwekZWZzlJeTZ3VnNyYUJOSnEyakxFXC8wNmFsSzZPcWU1SXlRV1JtRGVVR1dzOXhyXC8rVDkwZVkweUNcL0V1K1BzUlpmUjdSSGRLSmhsMm1lNXE1ZlwvQUQ5WkNoSSIsIkZhcmVCYXNpcyI6IkNJRiJ9LHsiQWlyU2VnbWVudF9LZXkiOiJZbUFweWw0U1NKS29aZ3BCVHBqWmpnPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiU0siLCJGbGlnaHROdW1iZXIiOiIzNDA0IiwiT3JpZ2luIjoiQ1BIIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxODozNTowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMjI6NTU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjIwMCIsIkRpc3RhbmNlIjoiMTI1NyIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzJCIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiQzR8SjR8WTR8RTR8TTR8SDR8UTR8VzB8VTB8SzB8TDB8VDAiLCJGbGlnaHREZXRhaWxfS2V5IjoicmJ2M1wvUUlGUnhhZWtRWXNwQzJONGc9PSIsIk9yaWdpblRlcm1pbmFsIjoiMiIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiJJIiwiQm9va2luZ0NvZGUiOiJDIiwiQ2FiaW5DbGFzcyI6IkJ1c2luZXNzIiwiRmFyZUluZm9SZWYiOiJUY2xzalJ3WlFYV1BtRGt1RmpBZkdnPT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiVGNsc2pSd1pRWFdQbURrdUZqQWZHZz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVFVFT2d6QU1ld3p5M1M3UWM2dHUxZEJFTDRWRExcL3pcL0dRdnRZVmhLNHNST0VrSndsT2NpaGdjbVhGTnJLR2NDQ3B6RlZnOUl5NndWc3JhQk5KcTJqTEVcLzA2YWxLNk9xZTVJeVFXUm1EZVVHV3M5eHJcLytUOTBlWTB5Q1wvRXUrUHNSWmZSN1JIZEtKaGwybWU1cTVmXC9BRDlaQ2hJIiwiRmFyZUJhc2lzIjoiQ0lGIn1dLCJGYXJlcnVsZXNyZWZfS2V5IjpbWyJUY2xzalJ3WlFYV1BtRGt1RmpBZkdnPT0iXSxbIlRjbHNqUndaUVhXUG1Ea3VGakFmR2c9PSJdXSwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjpbWyIxRyJdLFsiMUciXV0sIkZhcmVydWxlc3JlZl9jb250ZW50IjpbWyJnd3MtZUp4TlRVRU9nekFNZXd6eTNTN1FjNnR1MWRCRUw0VkRMXC96XC9HUXZ0WVZoSzRzUk9Fa0p3bE9jaWhnY21YRk5yS0djQ0NwekZWZzlJeTZ3VnNyYUJOSnEyakxFXC8wNmFsSzZPcWU1SXlRV1JtRGVVR1dzOXhyXC8rVDkwZVkweUNcL0V1K1BzUlpmUjdSSGRLSmhsMm1lNXE1ZlwvQUQ5WkNoSSJdLFsiZ3dzLWVKeE5UVUVPZ3pBTWV3enkzUzdRYzZ0dTFkQkVMNFZETFwvelwvR1F2dFlWaEs0c1JPRWtKd2xPY2loZ2NtWEZOcktHY0NDcHpGVmc5SXk2d1ZzcmFCTkpxMmpMRVwvMDZhbEs2T3FlNUl5UVdSbURlVUdXczl4clwvK1Q5MGVZMHlDXC9FdStQc1JaZlI3UkhkS0pobDJtZTVxNWZcL0FEOVpDaEkiXV19" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F11610832" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012333" data-airline="Air Ukraine International" data-arrive="695" data-duration="1020" data-stops="1" data-depature="1115" data-airlinecode="PS" data-price="1194.02" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF11940233" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/PS.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>20:35 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (SAW)</span><br>
            <div class="fsa_departure"><small>14:35 (01 May, Sun 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">17h 0m</span><br>
            <span class="fsa_departure">1 STOP</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse33" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="IkV4T1RUNzBOU1dPREZnaGFQVlwvVUZnPT18S0t8MUd8S0t8Z3dzLWVKeE5UY3NPQWlFUSs1aE43eTI3d0JXQ0VqMHNNVUZqdVBqXC9uK0VzZTlBbTgreE1tMUp5Vk9BbXBqOHMrQ3hqb0wwSzBPQXNlbjVEenNjdFFEWU9rUElvOTRyemY2VnQyMlRPcW5sVFZBbWlzdXBrRG1ETW5QZitrendjQVptbVFURjZYR1wvV2pYeDVack9pRXcyN29CQ0lGWStPTDFSXC9LTTA9fEtLfHxWVnx8QHwxIg==" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">1194.02</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook33" id="F11940233" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5Ijoid3dpbUZsdVlTem01Zm1keDRVNXVFdz09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjExOTQuMDIiLCJCYXNlUHJpY2UiOiIxMTQ5LjAwIiwiVGF4ZXMiOiI0NS4wMiIsIlRvdGFsUHJpY2VfQVBJIjoiRVVSMTE5NC4wMiIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjExNDkuMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiI0NS4wMiIsIlJlZnVuZGFibGUiOiJ0cnVlIiwiUGxhdGluZ0NhcnJpZXIiOiJQUyIsIkZhcmVUeXBlIjoiUmVmdW5kYWJsZSIsIkFsbF9QYXNzZW5nZXIiOiJBRFQiLCJBZHVsdHMiOjEsIkFkdWx0c19CYXNlX1ByaWNlIjoiMTE0OS4wMCIsIkFkdWx0c19UYXhfUHJpY2UiOiI0NS4wMiIsIlRyYXZlbFRpbWUiOiJQMERUMTdIME0wUyIsIkFpclNlZ21lbnRfS2V5IjoieXpMdWE4SklTMzZkRXlvc2xZZmEwZz09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoiY0UxOU95RUdTdWU2bTlPTEx0QTk1QT09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlBTIiwiRmxpZ2h0TnVtYmVyIjoiOTM4MyIsIk9yaWdpbiI6IkFNUyIsIkRlc3RpbmF0aW9uIjoiS0JQIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMjA6MzU6MDAuMDAwKzAyOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA1LTAxVDAwOjIwOjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIxNjUiLCJEaXN0YW5jZSI6IjExMTkiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjczNyIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiQ2FjaGUgc3RhdHVzIHVzZWQuIE5vIHBvbGxlZCBhdmFpbCBleGlzdHMuIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiRSIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJDNHxENHxaNHxTNHxZNHxCNHxLMHxMMHxNMHxFNHxPMHxSMHxXNHxINHxWMHxRMHxOMHxUMHxHMCIsIkZsaWdodERldGFpbF9LZXkiOiJvNTNxdVRxTlJhdXNPMmR4dGlhVmFRPT0iLCJPcmlnaW5UZXJtaW5hbCI6IiIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiIiLCJCb29raW5nQ29kZSI6IloiLCJDYWJpbkNsYXNzIjoiQnVzaW5lc3MiLCJGYXJlSW5mb1JlZiI6IkV4T1RUNzBOU1dPREZnaGFQVlwvVUZnPT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiRXhPVFQ3ME5TV09ERmdoYVBWXC9VRmc9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRjc09BaUVRKzVoTjd5Mjd3QldDRWowc01VRmp1UGpcL24rRXNlOUFtOCt4TW0xSnlWT0FtcGo4cytDeGpvTDBLME9Bc2VuNUR6c2N0UURZT2tQSW85NHJ6ZjZWdDIyVE9xbmxUVkFtaXN1cGtEbURNblBmK2t6d2NBWm1tUVRGNlhHXC9Xalh4NVpyT2lFdzI3b0JDSUZZK09MMVJcL0tNMD0iLCJGYXJlQmFzaXMiOiJDSUYifSx7IkFpclNlZ21lbnRfS2V5IjoieXpMdWE4SklTMzZkRXlvc2xZZmEwZz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlBTIiwiRmxpZ2h0TnVtYmVyIjoiOTU1NiIsIk9yaWdpbiI6IktCUCIsIkRlc3RpbmF0aW9uIjoiU0FXIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDUtMDFUMTI6MzU6MDAuMDAwKzAzOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA1LTAxVDE0OjM1OjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIxMjAiLCJEaXN0YW5jZSI6IjY1NiIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiNzM4IiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJDYWNoZSBzdGF0dXMgdXNlZC4gTm8gcG9sbGVkIGF2YWlsIGV4aXN0cy4iLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJFIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6IkM0fEQ0fFo0fFM0fFk0fFAwfFcwfEUwfEswfEwwfE0wfE8wfFIwfEcwfEgwfFYwfFEwfE4wfEowfEIwIiwiRmxpZ2h0RGV0YWlsX0tleSI6ImI0ckd3MDFoUmplOWNmQVgzN2pZbkE9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IiIsIkJvb2tpbmdDb2RlIjoiWiIsIkNhYmluQ2xhc3MiOiJCdXNpbmVzcyIsIkZhcmVJbmZvUmVmIjoiRXhPVFQ3ME5TV09ERmdoYVBWXC9VRmc9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJFeE9UVDcwTlNXT0RGZ2hhUFZcL1VGZz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVGNzT0FpRVErNWhON3kyN3dCV0NFajBzTVVGanVQalwvbitFc2U5QW04K3hNbTFKeVZPQW1wajhzK0N4am9MMEswT0FzZW41RHpzY3RRRFlPa1BJbzk0cnpmNlZ0MjJUT3FubFRWQW1pc3Vwa0RtRE1uUGYra3p3Y0FabW1RVEY2WEdcL1dqWHg1WnJPaUV3MjdvQkNJRlkrT0wxUlwvS00wPSIsIkZhcmVCYXNpcyI6IkNJRiJ9XSwiRmFyZXJ1bGVzcmVmX0tleSI6W1siRXhPVFQ3ME5TV09ERmdoYVBWXC9VRmc9PSJdLFsiRXhPVFQ3ME5TV09ERmdoYVBWXC9VRmc9PSJdXSwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjpbWyIxRyJdLFsiMUciXV0sIkZhcmVydWxlc3JlZl9jb250ZW50IjpbWyJnd3MtZUp4TlRjc09BaUVRKzVoTjd5Mjd3QldDRWowc01VRmp1UGpcL24rRXNlOUFtOCt4TW0xSnlWT0FtcGo4cytDeGpvTDBLME9Bc2VuNUR6c2N0UURZT2tQSW85NHJ6ZjZWdDIyVE9xbmxUVkFtaXN1cGtEbURNblBmK2t6d2NBWm1tUVRGNlhHXC9Xalh4NVpyT2lFdzI3b0JDSUZZK09MMVJcL0tNMD0iXSxbImd3cy1lSnhOVGNzT0FpRVErNWhON3kyN3dCV0NFajBzTVVGanVQalwvbitFc2U5QW04K3hNbTFKeVZPQW1wajhzK0N4am9MMEswT0FzZW41RHpzY3RRRFlPa1BJbzk0cnpmNlZ0MjJUT3FubFRWQW1pc3Vwa0RtRE1uUGYra3p3Y0FabW1RVEY2WEdcL1dqWHg1WnJPaUV3MjdvQkNJRlkrT0wxUlwvS00wPSJdXX0=" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F11940233" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse33" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        8:35 PM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        12:20 AM <br>
                        <span> Boryspil Arpt KBP</span>
                      </li>
                      <li class="rfms_emirates">
                        Air Ukraine International<br>
                        <span>PS-737</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>2h 45m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Boryspil Arpt, | <strong>Layover:: 12h 15m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        12:35 PM <br>
                        <span>Boryspil Arpt KBP</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        2:35 PM <br>
                        <span> Sabiha Gokcen Arpt SAW</span>
                      </li>
                      <li class="rfms_emirates">
                        Air Ukraine International<br>
                        <span>PS-738</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>2h 0m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 17h 0m</span><br>
                        Arrival:<span class="color_secondry"> Sunday 01 May</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">1194.02</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook33" id="F11940233" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5Ijoid3dpbUZsdVlTem01Zm1keDRVNXVFdz09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsIiwiVG90YWxQcmljZSI6IjExOTQuMDIiLCJCYXNlUHJpY2UiOiIxMTQ5LjAwIiwiVGF4ZXMiOiI0NS4wMiIsIlRvdGFsUHJpY2VfQVBJIjoiRVVSMTE5NC4wMiIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjExNDkuMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiI0NS4wMiIsIlJlZnVuZGFibGUiOiJ0cnVlIiwiUGxhdGluZ0NhcnJpZXIiOiJQUyIsIkZhcmVUeXBlIjoiUmVmdW5kYWJsZSIsIkFsbF9QYXNzZW5nZXIiOiJBRFQiLCJBZHVsdHMiOjEsIkFkdWx0c19CYXNlX1ByaWNlIjoiMTE0OS4wMCIsIkFkdWx0c19UYXhfUHJpY2UiOiI0NS4wMiIsIlRyYXZlbFRpbWUiOiJQMERUMTdIME0wUyIsIkFpclNlZ21lbnRfS2V5IjoieXpMdWE4SklTMzZkRXlvc2xZZmEwZz09Iiwic2VnbWVudHMiOlt7IkFpclNlZ21lbnRfS2V5IjoiY0UxOU95RUdTdWU2bTlPTEx0QTk1QT09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlBTIiwiRmxpZ2h0TnVtYmVyIjoiOTM4MyIsIk9yaWdpbiI6IkFNUyIsIkRlc3RpbmF0aW9uIjoiS0JQIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDQtMzBUMjA6MzU6MDAuMDAwKzAyOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA1LTAxVDAwOjIwOjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIxNjUiLCJEaXN0YW5jZSI6IjExMTkiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjczNyIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiQ2FjaGUgc3RhdHVzIHVzZWQuIE5vIHBvbGxlZCBhdmFpbCBleGlzdHMuIiwiT3B0aW9uYWxTZXJ2aWNlc0luZGljYXRvciI6ImZhbHNlIiwiQXZhaWxhYmlsaXR5U291cmNlIjoiRSIsIk9wZXJhdGluZ0NhcnJpZXIiOiIiLCJPcGVyYXRpbmdGbGlnaHROdW1iZXIiOiIiLCJQcm92aWRlckNvZGUiOiIxRyIsIkJvb2tpbmdDb3VudHMiOiJDNHxENHxaNHxTNHxZNHxCNHxLMHxMMHxNMHxFNHxPMHxSMHxXNHxINHxWMHxRMHxOMHxUMHxHMCIsIkZsaWdodERldGFpbF9LZXkiOiJvNTNxdVRxTlJhdXNPMmR4dGlhVmFRPT0iLCJPcmlnaW5UZXJtaW5hbCI6IiIsIkRlc3RpbmF0aW9uVGVybWluYWwiOiIiLCJCb29raW5nQ29kZSI6IloiLCJDYWJpbkNsYXNzIjoiQnVzaW5lc3MiLCJGYXJlSW5mb1JlZiI6IkV4T1RUNzBOU1dPREZnaGFQVlwvVUZnPT0iLCJGYXJlcnVsZXNyZWZfS2V5IjoiRXhPVFQ3ME5TV09ERmdoYVBWXC9VRmc9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRjc09BaUVRKzVoTjd5Mjd3QldDRWowc01VRmp1UGpcL24rRXNlOUFtOCt4TW0xSnlWT0FtcGo4cytDeGpvTDBLME9Bc2VuNUR6c2N0UURZT2tQSW85NHJ6ZjZWdDIyVE9xbmxUVkFtaXN1cGtEbURNblBmK2t6d2NBWm1tUVRGNlhHXC9Xalh4NVpyT2lFdzI3b0JDSUZZK09MMVJcL0tNMD0iLCJGYXJlQmFzaXMiOiJDSUYifSx7IkFpclNlZ21lbnRfS2V5IjoieXpMdWE4SklTMzZkRXlvc2xZZmEwZz09IiwiR3JvdXAiOiIwIiwiQ2FycmllciI6IlBTIiwiRmxpZ2h0TnVtYmVyIjoiOTU1NiIsIk9yaWdpbiI6IktCUCIsIkRlc3RpbmF0aW9uIjoiU0FXIiwiRGVwYXJ0dXJlVGltZSI6IjIwMTYtMDUtMDFUMTI6MzU6MDAuMDAwKzAzOjAwIiwiQXJyaXZhbFRpbWUiOiIyMDE2LTA1LTAxVDE0OjM1OjAwLjAwMCswMzowMCIsIkZsaWdodFRpbWUiOiIxMjAiLCJEaXN0YW5jZSI6IjY1NiIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiNzM4IiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJDYWNoZSBzdGF0dXMgdXNlZC4gTm8gcG9sbGVkIGF2YWlsIGV4aXN0cy4iLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJFIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6IkM0fEQ0fFo0fFM0fFk0fFAwfFcwfEUwfEswfEwwfE0wfE8wfFIwfEcwfEgwfFYwfFEwfE4wfEowfEIwIiwiRmxpZ2h0RGV0YWlsX0tleSI6ImI0ckd3MDFoUmplOWNmQVgzN2pZbkE9PSIsIk9yaWdpblRlcm1pbmFsIjoiIiwiRGVzdGluYXRpb25UZXJtaW5hbCI6IiIsIkJvb2tpbmdDb2RlIjoiWiIsIkNhYmluQ2xhc3MiOiJCdXNpbmVzcyIsIkZhcmVJbmZvUmVmIjoiRXhPVFQ3ME5TV09ERmdoYVBWXC9VRmc9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJFeE9UVDcwTlNXT0RGZ2hhUFZcL1VGZz09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVGNzT0FpRVErNWhON3kyN3dCV0NFajBzTVVGanVQalwvbitFc2U5QW04K3hNbTFKeVZPQW1wajhzK0N4am9MMEswT0FzZW41RHpzY3RRRFlPa1BJbzk0cnpmNlZ0MjJUT3FubFRWQW1pc3Vwa0RtRE1uUGYra3p3Y0FabW1RVEY2WEdcL1dqWHg1WnJPaUV3MjdvQkNJRlkrT0wxUlwvS00wPSIsIkZhcmVCYXNpcyI6IkNJRiJ9XSwiRmFyZXJ1bGVzcmVmX0tleSI6W1siRXhPVFQ3ME5TV09ERmdoYVBWXC9VRmc9PSJdLFsiRXhPVFQ3ME5TV09ERmdoYVBWXC9VRmc9PSJdXSwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjpbWyIxRyJdLFsiMUciXV0sIkZhcmVydWxlc3JlZl9jb250ZW50IjpbWyJnd3MtZUp4TlRjc09BaUVRKzVoTjd5Mjd3QldDRWowc01VRmp1UGpcL24rRXNlOUFtOCt4TW0xSnlWT0FtcGo4cytDeGpvTDBLME9Bc2VuNUR6c2N0UURZT2tQSW85NHJ6ZjZWdDIyVE9xbmxUVkFtaXN1cGtEbURNblBmK2t6d2NBWm1tUVRGNlhHXC9Xalh4NVpyT2lFdzI3b0JDSUZZK09MMVJcL0tNMD0iXSxbImd3cy1lSnhOVGNzT0FpRVErNWhON3kyN3dCV0NFajBzTVVGanVQalwvbitFc2U5QW04K3hNbTFKeVZPQW1wajhzK0N4am9MMEswT0FzZW41RHpzY3RRRFlPa1BJbzk0cnpmNlZ0MjJUT3FubFRWQW1pc3Vwa0RtRE1uUGYra3p3Y0FabW1RVEY2WEdcL1dqWHg1WnJPaUV3MjdvQkNJRlkrT0wxUlwvS00wPSJdXX0=" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F11940233" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
      <!-- Normal trip-->
  <li class="col-sm-12 fs_singleflight flight" id="ticketid012334" data-airline="Lufthansa Airlines" data-arrive="1235" data-duration="485" data-stops="2" data-depature="750" data-airlinecode="LH" data-price="1719.10" style="display: block;">
    <ul class="list-inline">
      <li class="fs_airlinecontainer">
        <img id="FF17191034" alt="Airline Logo" class="fs_fname lazy" src="http://rf.tekhne.nl/assets/images/airline_logo/LH.gif">
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_image">
            <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/DEPARTURE_RF.svg">
          </div>
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Amsterdam</b> (AMS)</span><br>
            <div class="fsa_departure"><small>14:30 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_inout">
        <div class="fs-outbond">
          <span class="fso_outbond">Outbound</span><br>
          <img class="fs_io lazy" src="http://rf.tekhne.nl/assets/images/ARROW_RF.svg">
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure">
        <div class="fs_image">
          <img alt="Departure Logo" class="fs_dep lazy" src="http://rf.tekhne.nl/assets/images/ARRIVAL_RF.svg">
        </div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><b>Istanbul</b> (IST)</span><br>
            <div class="fsa_departure"><small>23:35 (30 Apr, Sat 2016)</small></div>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename">8h 5m</span><br>
            <span class="fsa_departure">2 STOPS</span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fs_book">
        <div class="fsaf_container">
          <div class="col-sm-5 nopadd">
            <button class="btn btn_transparent color_black flight-details-btn go-top" type="button" data-id="collapse34" data-toggle="modal" data-target="#Flight-Details">Flight Details</button>
            <button class="btn btn_transparent site_txt farecondition_button go-top" type="button" href="javascript:void(0);" id="InY5dkQ4WHNWVDllalNSTDMwWFJqd1E9PXxLS3wxR3xLS3xnd3MtZUp4TlRzc0tnekFRXC9CaVorNnlKaWQ0aUdsQm85Nkl0NU9MXC9mNFpyQXFVRCs1elpSMHFwcHdSNllmcERoNnQ3YmREUEFpaDZzKytlRWR6a0E4U3FBbElHbEJqUnhoMnRxNVZwVWFvbWo4c0VZaDJ5YTh3RGxPcm45XC9IYitOeURDUTFCSFBKbWljN3JXWFk5U1U4RG9uaFQybGMzREFRblhRPT18S0t8fFZWfHY5dkQ4WHNWVDllalNSTDMwWFJqd1E9PXxLS3wxR3xLS3xnd3MtZUp4TlRzc0tnekFRXC9CaVorNnlKaWQ0aUdsQm85Nkl0NU9MXC9mNFpyQXFVRCs1elpSMHFwcHdSNllmcERoNnQ3YmREUEFpaDZzKytlRWR6a0E4U3FBbElHbEJqUnhoMnRxNVZwVWFvbWo4c0VZaDJ5YTh3RGxPcm45XC9IYitOeURDUTFCSFBKbWljN3JXWFk5U1U4RG9uaFQybGMzREFRblhRPT18S0t8Uml0THduTllRdkdSYVdicklGTytRZz09fEtLfDFHfEtLfGd3cy1lSnhOVGJzT3dqQVErNWpLdTUyMGxHNnAwa1prSUFNVXBDejhcLzJkd1RZU0VwWHZhZHc0aE9PckNVUXhcL0dQQVpha1Y1UmFEQVdlVG5BWEh5Zm01akJha0pNU2YwZTBcL2Jsc2IwcXFhSlNnU1JtTlNaRTZndHZcL1ArZXltY2pqQ2xZVjZJXC9XWk5YYmRqTlI4NjBYQVhsdkZxMnZ6QUY3THpKXC8wPXxLS3x8VlZ8fEB8MiI=" onclick="show_fare_popup(this.id,this,1)">Fare Conditions</button>
          </div>
          <div class="col-sm-7 nopadd">
            <div class="fs_airline">
              <div class="fs_values">
                <span class="fsa_airlinename currency">€</span>
                <span class="fsa_airlinename amount">1719.10</span><br>
                <span class="fsa_departure">single</span>
              </div>
            </div>
            <div class="spacer"></div>
            <div class="fs_airline">
              <div class="fs_values">
                <form target="_blank" method="post" name="flightbook34" id="F17191034" action="http://rf.tekhne.nl/flight/AddToCart">
                  <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiUXBRM3JWRDBSZGFCSG9FeFBacFhnUT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsMSwiLCJUb3RhbFByaWNlIjoiMTcxOS4xMCIsIkJhc2VQcmljZSI6IjE1NDYuMDAiLCJUYXhlcyI6IjE3My4xMCIsIlRvdGFsUHJpY2VfQVBJIjoiRVVSMTcxOS4xMCIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjE1NDYuMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiIxNzMuMTAiLCJSZWZ1bmRhYmxlIjoidHJ1ZSIsIlBsYXRpbmdDYXJyaWVyIjoiTEgiLCJGYXJlVHlwZSI6IlJlZnVuZGFibGUiLCJBbGxfUGFzc2VuZ2VyIjoiQURUIiwiQWR1bHRzIjoxLCJBZHVsdHNfQmFzZV9QcmljZSI6IjE1NDYuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiMTczLjEwIiwiVHJhdmVsVGltZSI6IlAwRFQ4SDVNMFMiLCJBaXJTZWdtZW50X0tleSI6ImRPRFBQMlFWUXVPdWZqaFFcLzZxTzVRPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiI5aU80cnBIM1JKV2Y4NEVva1l4dHl3PT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiTEgiLCJGbGlnaHROdW1iZXIiOiI5OTMiLCJPcmlnaW4iOiJBTVMiLCJEZXN0aW5hdGlvbiI6IkZSQSIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDE0OjMwOjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQxNTo0MDowMC4wMDArMDI6MDAiLCJGbGlnaHRUaW1lIjoiNzAiLCJEaXN0YW5jZSI6IjIyOCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIxIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjN8QzN8RDJ8WjJ8UDF8WTl8QjR8TTB8VTB8SDB8UTB8VjB8VzB8UzB8VDB8TDB8SzAiLCJGbGlnaHREZXRhaWxfS2V5IjoiSlBOOEdGYkFRbmlEN3huMnBvaW1wQT09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiMSIsIkJvb2tpbmdDb2RlIjoiWSIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJ2OXZEOFhzVlQ5ZWpTUkwzMFhSandRPT0iLCJGYXJlcnVsZXNyZWZfS2V5Ijoidjl2RDhYc1ZUOWVqU1JMMzBYUmp3UT09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHNzS2d6QVFcL0JpWis2eUppZDRpR2xCbzk2SXQ1T0xcL2Y0WnJBcVVEKzV6WlIwcXBwd1I2WWZwRGg2dDdiZERQQWloNnMrK2VFZHprQThTcUFsSUdsQmpSeGgydHE1VnBVYW9tajhzRVloMnlhOHdEbE9ybjlcL0hiK055RENRMUJIUEptaWM3cldYWTlTVThEb25oVDJsYzNEQVFuWFE9PSIsIkZhcmVCYXNpcyI6Ilk3NyJ9LHsiQWlyU2VnbWVudF9LZXkiOiJzWUFoVHYyZ1RFS3dNSStSNjc4OU1BPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiTEgiLCJGbGlnaHROdW1iZXIiOiIxMjQyIiwiT3JpZ2luIjoiRlJBIiwiRGVzdGluYXRpb24iOiJWSUUiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxNjo1MDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTg6MTA6MDAuMDAwKzAyOjAwIiwiRmxpZ2h0VGltZSI6IjgwIiwiRGlzdGFuY2UiOiIzODUiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjMxOSIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6IkozfEMzfEQyfFoyfFAxfFk5fEI0fE0wfFUwfEgwfFEwfFYwfFcwfFMwfFQwfEwwfEswIiwiRmxpZ2h0RGV0YWlsX0tleSI6ImI4NGpoaUxcL1RSMnNXMzB4OXpHN2NBPT0iLCJPcmlnaW5UZXJtaW5hbCI6IjEiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiIiwiQm9va2luZ0NvZGUiOiJZIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6InY5dkQ4WHNWVDllalNSTDMwWFJqd1E9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJ2OXZEOFhzVlQ5ZWpTUkwzMFhSandRPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Uc3NLZ3pBUVwvQmlaKzZ5SmlkNGlHbEJvOTZJdDVPTFwvZjRackFxVUQrNXpaUjBxcHB3UjZZZnBEaDZ0N2JkRFBBaWg2cysrZUVkemtBOFNxQWxJR2xCalJ4aDJ0cTVWcFVhb21qOHNFWWgyeWE4d0RsT3JuOVwvSGIrTnlEQ1ExQkhQSm1pYzdyV1hZOVNVOERvbmhUMmxjM0RBUW5YUT09IiwiRmFyZUJhc2lzIjoiWTc3In0seyJBaXJTZWdtZW50X0tleSI6ImRPRFBQMlFWUXVPdWZqaFFcLzZxTzVRPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiSVIiLCJGbGlnaHROdW1iZXIiOiIyODg4IiwiT3JpZ2luIjoiVklFIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQyMDoxNTowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMjM6MzU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjE0MCIsIkRpc3RhbmNlIjoiNzkwIiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMzIiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IkNhY2hlIHN0YXR1cyB1c2VkLiBObyBwb2xsZWQgYXZhaWwgZXhpc3RzLiIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IkgiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjl8Qzl8STl8WTl8Vjl8UTl8TTl8TjkiLCJGbGlnaHREZXRhaWxfS2V5IjoiWFVZbkdQSUJUaENVTDBFVDgzMmhOQT09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiQyIsIkNhYmluQ2xhc3MiOiJCdXNpbmVzcyIsIkZhcmVJbmZvUmVmIjoiUml0THduTllRdkdSYVdicklGTytRZz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IlJpdEx3bk5ZUXZHUmFXYnJJRk8rUWc9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRic093akFRKzVqS3U1MjBsRzZwMGtaa0lBTVVwQ3o4XC8yZHdUWVNFcFh2YWR3NGhPT3JDVVF4XC9HUEFaYWtWNVJhREFXZVRuQVhIeWZtNWpCYWtKTVNmMGUwXC9ibHNiMHFxYUpTZ1NSbU5TWkU2Z3R2XC9QK2V5bWNqakNsWVY2SVwvV1pOWGJkak5SODYwWEFYbHZGcTJ2ekFGN0x6SlwvMD0iLCJGYXJlQmFzaXMiOiJDSUYifV0sIkZhcmVydWxlc3JlZl9LZXkiOltbInY5dkQ4WHNWVDllalNSTDMwWFJqd1E9PSJdLFsidjl2RDhYc1ZUOWVqU1JMMzBYUmp3UT09Il0sWyJSaXRMd25OWVF2R1JhV2JySUZPK1FnPT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXSxbIjFHIl0sWyIxRyJdXSwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOltbImd3cy1lSnhOVHNzS2d6QVFcL0JpWis2eUppZDRpR2xCbzk2SXQ1T0xcL2Y0WnJBcVVEKzV6WlIwcXBwd1I2WWZwRGg2dDdiZERQQWloNnMrK2VFZHprQThTcUFsSUdsQmpSeGgydHE1VnBVYW9tajhzRVloMnlhOHdEbE9ybjlcL0hiK055RENRMUJIUEptaWM3cldYWTlTVThEb25oVDJsYzNEQVFuWFE9PSJdLFsiZ3dzLWVKeE5Uc3NLZ3pBUVwvQmlaKzZ5SmlkNGlHbEJvOTZJdDVPTFwvZjRackFxVUQrNXpaUjBxcHB3UjZZZnBEaDZ0N2JkRFBBaWg2cysrZUVkemtBOFNxQWxJR2xCalJ4aDJ0cTVWcFVhb21qOHNFWWgyeWE4d0RsT3JuOVwvSGIrTnlEQ1ExQkhQSm1pYzdyV1hZOVNVOERvbmhUMmxjM0RBUW5YUT09Il0sWyJnd3MtZUp4TlRic093akFRKzVqS3U1MjBsRzZwMGtaa0lBTVVwQ3o4XC8yZHdUWVNFcFh2YWR3NGhPT3JDVVF4XC9HUEFaYWtWNVJhREFXZVRuQVhIeWZtNWpCYWtKTVNmMGUwXC9ibHNiMHFxYUpTZ1NSbU5TWkU2Z3R2XC9QK2V5bWNqakNsWVY2SVwvV1pOWGJkak5SODYwWEFYbHZGcTJ2ekFGN0x6SlwvMD0iXV19" required="">
                  <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                  <button type="submit" data-attr="F17191034" class="btn btn-primary btn_inputs">Book Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </li>
      <!-- modal flight Start  -->
      <div class="modal fade bs-example-modal-lg" id="collapse34" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modalcontainer2">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="rf_modaltitle">Flight Details</div>
              </div>
              <div class="modal-body">
                <div class="col-md-9 rmf_flight">
                  <ul class="list-inline rfm_flightdetails">
                    <li>Departure</li>
                    <li>Amsterdam -Istanbul</li>
                    <li>Saturday 30 April</li>
                  </ul>
                    
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        2:30 PM <br>
                        <span>Schiphol Arpt AMS</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        3:40 PM <br>
                        <span> Frankfurt Intl FRA</span>
                      </li>
                      <li class="rfms_emirates">
                        Lufthansa Airlines<br>
                        <span>LH-321</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>1h 10m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Frankfurt Intl, | <strong>Layover:: 1h 10m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        4:50 PM <br>
                        <span>Frankfurt Intl FRA</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        6:10 PM <br>
                        <span> Vienna Intl Arpt VIE</span>
                      </li>
                      <li class="rfms_emirates">
                        Lufthansa Airlines<br>
                        <span>LH-319</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>1h 20m</span>
                      </li>
                                            <li class="rfms_stopovertime">
                        Change of Plane at: Vienna Intl Arpt, | <strong>Layover:: 2h 5m</strong> 
                      </li>
                                          </ul>
                      
                    <ul class="list-inline rfm_singleflightdetails">
                      <li class="rfms_departure">
                        8:15 PM <br>
                        <span>Vienna Intl Arpt VIE</span>
                      </li>
                      <li class="rfms_flightimg">
                        <img src="assets/images/DEPARTURE_RF.svg">
                      </li>
                      <li class="rfms_arival">
                        11:35 PM <br>
                        <span> Ataturk Arpt IST</span>
                      </li>
                      <li class="rfms_emirates">
                        Iran Air<br>
                        <span>IR-332</span>
                      </li>
                      <li class="rfms_nonstop">
                        &nbsp;<br>
                        <span>2h 20m</span>
                      </li>
                                          </ul>
                     
                    <ul class="list-inline">
                      <li class="rfms_ttduration">
                        Total Journey Time:<span class="color_secondry"> 8h 5m</span><br>
                        Arrival:<span class="color_secondry"> Saturday 30 April</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3 flightdetbook_btn">
                    <ul class="normal-list">
                      <li class="rmf_price">
                        <span>€</span>
                        <span class="color_secondry">1719.10</span>
                      </li>
                      <li class="rfm_flightdet">
                        single                      </li>
                      <li class="rmf_book">
                        <form method="post" target="_blank" name="flightbook34" id="F17191034" action="http://rf.tekhne.nl/flight/AddToCart">
                          <input type="hidden" name="temp_d" value="eyJBaXJQcmljaW5nU29sdXRpb25fS2V5IjoiUXBRM3JWRDBSZGFCSG9FeFBacFhnUT09IiwiQ29tcGxldGVJdGluZXJhcnkiOiIiLCJDb25uZWN0aW9ucyI6IjAsMSwiLCJUb3RhbFByaWNlIjoiMTcxOS4xMCIsIkJhc2VQcmljZSI6IjE1NDYuMDAiLCJUYXhlcyI6IjE3My4xMCIsIlRvdGFsUHJpY2VfQVBJIjoiRVVSMTcxOS4xMCIsIkFQSUN1cnJlbmN5VHlwZSI6IkVVUiIsIlNJVEVDdXJyZW5jeVR5cGUiOiJFVVIiLCJNeU1hcmt1cCI6MCwiYU1hcmt1cCI6MCwiQmFzZVByaWNlX0JyZWFrZG93biI6IjE1NDYuMDAiLCJUYXhQcmljZV9CcmVha2Rvd24iOiIxNzMuMTAiLCJSZWZ1bmRhYmxlIjoidHJ1ZSIsIlBsYXRpbmdDYXJyaWVyIjoiTEgiLCJGYXJlVHlwZSI6IlJlZnVuZGFibGUiLCJBbGxfUGFzc2VuZ2VyIjoiQURUIiwiQWR1bHRzIjoxLCJBZHVsdHNfQmFzZV9QcmljZSI6IjE1NDYuMDAiLCJBZHVsdHNfVGF4X1ByaWNlIjoiMTczLjEwIiwiVHJhdmVsVGltZSI6IlAwRFQ4SDVNMFMiLCJBaXJTZWdtZW50X0tleSI6ImRPRFBQMlFWUXVPdWZqaFFcLzZxTzVRPT0iLCJzZWdtZW50cyI6W3siQWlyU2VnbWVudF9LZXkiOiI5aU80cnBIM1JKV2Y4NEVva1l4dHl3PT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiTEgiLCJGbGlnaHROdW1iZXIiOiI5OTMiLCJPcmlnaW4iOiJBTVMiLCJEZXN0aW5hdGlvbiI6IkZSQSIsIkRlcGFydHVyZVRpbWUiOiIyMDE2LTA0LTMwVDE0OjMwOjAwLjAwMCswMjowMCIsIkFycml2YWxUaW1lIjoiMjAxNi0wNC0zMFQxNTo0MDowMC4wMDArMDI6MDAiLCJGbGlnaHRUaW1lIjoiNzAiLCJEaXN0YW5jZSI6IjIyOCIsIkVUaWNrZXRhYmlsaXR5IjoiWWVzIiwiRXF1aXBtZW50IjoiMzIxIiwiQ2hhbmdlT2ZQbGFuZSI6ImZhbHNlIiwiUGFydGljaXBhbnRMZXZlbCI6IlNlY3VyZSBTZWxsIiwiTGlua0F2YWlsYWJpbGl0eSI6InRydWUiLCJQb2xsZWRBdmFpbGFiaWxpdHlPcHRpb24iOiJQb2xsZWQgYXZhaWwgdXNlZCIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IlMiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjN8QzN8RDJ8WjJ8UDF8WTl8QjR8TTB8VTB8SDB8UTB8VjB8VzB8UzB8VDB8TDB8SzAiLCJGbGlnaHREZXRhaWxfS2V5IjoiSlBOOEdGYkFRbmlEN3huMnBvaW1wQT09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiMSIsIkJvb2tpbmdDb2RlIjoiWSIsIkNhYmluQ2xhc3MiOiJFY29ub215IiwiRmFyZUluZm9SZWYiOiJ2OXZEOFhzVlQ5ZWpTUkwzMFhSandRPT0iLCJGYXJlcnVsZXNyZWZfS2V5Ijoidjl2RDhYc1ZUOWVqU1JMMzBYUmp3UT09IiwiRmFyZXJ1bGVzcmVmX1Byb3ZpZGVyIjoiMUciLCJGYXJlcnVsZXNyZWZfY29udGVudCI6Imd3cy1lSnhOVHNzS2d6QVFcL0JpWis2eUppZDRpR2xCbzk2SXQ1T0xcL2Y0WnJBcVVEKzV6WlIwcXBwd1I2WWZwRGg2dDdiZERQQWloNnMrK2VFZHprQThTcUFsSUdsQmpSeGgydHE1VnBVYW9tajhzRVloMnlhOHdEbE9ybjlcL0hiK055RENRMUJIUEptaWM3cldYWTlTVThEb25oVDJsYzNEQVFuWFE9PSIsIkZhcmVCYXNpcyI6Ilk3NyJ9LHsiQWlyU2VnbWVudF9LZXkiOiJzWUFoVHYyZ1RFS3dNSStSNjc4OU1BPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiTEgiLCJGbGlnaHROdW1iZXIiOiIxMjQyIiwiT3JpZ2luIjoiRlJBIiwiRGVzdGluYXRpb24iOiJWSUUiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQxNjo1MDowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMTg6MTA6MDAuMDAwKzAyOjAwIiwiRmxpZ2h0VGltZSI6IjgwIiwiRGlzdGFuY2UiOiIzODUiLCJFVGlja2V0YWJpbGl0eSI6IlllcyIsIkVxdWlwbWVudCI6IjMxOSIsIkNoYW5nZU9mUGxhbmUiOiJmYWxzZSIsIlBhcnRpY2lwYW50TGV2ZWwiOiJTZWN1cmUgU2VsbCIsIkxpbmtBdmFpbGFiaWxpdHkiOiJ0cnVlIiwiUG9sbGVkQXZhaWxhYmlsaXR5T3B0aW9uIjoiUG9sbGVkIGF2YWlsIHVzZWQiLCJPcHRpb25hbFNlcnZpY2VzSW5kaWNhdG9yIjoiZmFsc2UiLCJBdmFpbGFiaWxpdHlTb3VyY2UiOiJTIiwiT3BlcmF0aW5nQ2FycmllciI6IiIsIk9wZXJhdGluZ0ZsaWdodE51bWJlciI6IiIsIlByb3ZpZGVyQ29kZSI6IjFHIiwiQm9va2luZ0NvdW50cyI6IkozfEMzfEQyfFoyfFAxfFk5fEI0fE0wfFUwfEgwfFEwfFYwfFcwfFMwfFQwfEwwfEswIiwiRmxpZ2h0RGV0YWlsX0tleSI6ImI4NGpoaUxcL1RSMnNXMzB4OXpHN2NBPT0iLCJPcmlnaW5UZXJtaW5hbCI6IjEiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiIiwiQm9va2luZ0NvZGUiOiJZIiwiQ2FiaW5DbGFzcyI6IkVjb25vbXkiLCJGYXJlSW5mb1JlZiI6InY5dkQ4WHNWVDllalNSTDMwWFJqd1E9PSIsIkZhcmVydWxlc3JlZl9LZXkiOiJ2OXZEOFhzVlQ5ZWpTUkwzMFhSandRPT0iLCJGYXJlcnVsZXNyZWZfUHJvdmlkZXIiOiIxRyIsIkZhcmVydWxlc3JlZl9jb250ZW50IjoiZ3dzLWVKeE5Uc3NLZ3pBUVwvQmlaKzZ5SmlkNGlHbEJvOTZJdDVPTFwvZjRackFxVUQrNXpaUjBxcHB3UjZZZnBEaDZ0N2JkRFBBaWg2cysrZUVkemtBOFNxQWxJR2xCalJ4aDJ0cTVWcFVhb21qOHNFWWgyeWE4d0RsT3JuOVwvSGIrTnlEQ1ExQkhQSm1pYzdyV1hZOVNVOERvbmhUMmxjM0RBUW5YUT09IiwiRmFyZUJhc2lzIjoiWTc3In0seyJBaXJTZWdtZW50X0tleSI6ImRPRFBQMlFWUXVPdWZqaFFcLzZxTzVRPT0iLCJHcm91cCI6IjAiLCJDYXJyaWVyIjoiSVIiLCJGbGlnaHROdW1iZXIiOiIyODg4IiwiT3JpZ2luIjoiVklFIiwiRGVzdGluYXRpb24iOiJJU1QiLCJEZXBhcnR1cmVUaW1lIjoiMjAxNi0wNC0zMFQyMDoxNTowMC4wMDArMDI6MDAiLCJBcnJpdmFsVGltZSI6IjIwMTYtMDQtMzBUMjM6MzU6MDAuMDAwKzAzOjAwIiwiRmxpZ2h0VGltZSI6IjE0MCIsIkRpc3RhbmNlIjoiNzkwIiwiRVRpY2tldGFiaWxpdHkiOiJZZXMiLCJFcXVpcG1lbnQiOiIzMzIiLCJDaGFuZ2VPZlBsYW5lIjoiZmFsc2UiLCJQYXJ0aWNpcGFudExldmVsIjoiU2VjdXJlIFNlbGwiLCJMaW5rQXZhaWxhYmlsaXR5IjoidHJ1ZSIsIlBvbGxlZEF2YWlsYWJpbGl0eU9wdGlvbiI6IkNhY2hlIHN0YXR1cyB1c2VkLiBObyBwb2xsZWQgYXZhaWwgZXhpc3RzLiIsIk9wdGlvbmFsU2VydmljZXNJbmRpY2F0b3IiOiJmYWxzZSIsIkF2YWlsYWJpbGl0eVNvdXJjZSI6IkgiLCJPcGVyYXRpbmdDYXJyaWVyIjoiIiwiT3BlcmF0aW5nRmxpZ2h0TnVtYmVyIjoiIiwiUHJvdmlkZXJDb2RlIjoiMUciLCJCb29raW5nQ291bnRzIjoiSjl8Qzl8STl8WTl8Vjl8UTl8TTl8TjkiLCJGbGlnaHREZXRhaWxfS2V5IjoiWFVZbkdQSUJUaENVTDBFVDgzMmhOQT09IiwiT3JpZ2luVGVybWluYWwiOiIiLCJEZXN0aW5hdGlvblRlcm1pbmFsIjoiSSIsIkJvb2tpbmdDb2RlIjoiQyIsIkNhYmluQ2xhc3MiOiJCdXNpbmVzcyIsIkZhcmVJbmZvUmVmIjoiUml0THduTllRdkdSYVdicklGTytRZz09IiwiRmFyZXJ1bGVzcmVmX0tleSI6IlJpdEx3bk5ZUXZHUmFXYnJJRk8rUWc9PSIsIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6IjFHIiwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOiJnd3MtZUp4TlRic093akFRKzVqS3U1MjBsRzZwMGtaa0lBTVVwQ3o4XC8yZHdUWVNFcFh2YWR3NGhPT3JDVVF4XC9HUEFaYWtWNVJhREFXZVRuQVhIeWZtNWpCYWtKTVNmMGUwXC9ibHNiMHFxYUpTZ1NSbU5TWkU2Z3R2XC9QK2V5bWNqakNsWVY2SVwvV1pOWGJkak5SODYwWEFYbHZGcTJ2ekFGN0x6SlwvMD0iLCJGYXJlQmFzaXMiOiJDSUYifV0sIkZhcmVydWxlc3JlZl9LZXkiOltbInY5dkQ4WHNWVDllalNSTDMwWFJqd1E9PSJdLFsidjl2RDhYc1ZUOWVqU1JMMzBYUmp3UT09Il0sWyJSaXRMd25OWVF2R1JhV2JySUZPK1FnPT0iXV0sIkZhcmVydWxlc3JlZl9Qcm92aWRlciI6W1siMUciXSxbIjFHIl0sWyIxRyJdXSwiRmFyZXJ1bGVzcmVmX2NvbnRlbnQiOltbImd3cy1lSnhOVHNzS2d6QVFcL0JpWis2eUppZDRpR2xCbzk2SXQ1T0xcL2Y0WnJBcVVEKzV6WlIwcXBwd1I2WWZwRGg2dDdiZERQQWloNnMrK2VFZHprQThTcUFsSUdsQmpSeGgydHE1VnBVYW9tajhzRVloMnlhOHdEbE9ybjlcL0hiK055RENRMUJIUEptaWM3cldYWTlTVThEb25oVDJsYzNEQVFuWFE9PSJdLFsiZ3dzLWVKeE5Uc3NLZ3pBUVwvQmlaKzZ5SmlkNGlHbEJvOTZJdDVPTFwvZjRackFxVUQrNXpaUjBxcHB3UjZZZnBEaDZ0N2JkRFBBaWg2cysrZUVkemtBOFNxQWxJR2xCalJ4aDJ0cTVWcFVhb21qOHNFWWgyeWE4d0RsT3JuOVwvSGIrTnlEQ1ExQkhQSm1pYzdyV1hZOVNVOERvbmhUMmxjM0RBUW5YUT09Il0sWyJnd3MtZUp4TlRic093akFRKzVqS3U1MjBsRzZwMGtaa0lBTVVwQ3o4XC8yZHdUWVNFcFh2YWR3NGhPT3JDVVF4XC9HUEFaYWtWNVJhREFXZVRuQVhIeWZtNWpCYWtKTVNmMGUwXC9ibHNiMHFxYUpTZ1NSbU5TWkU2Z3R2XC9QK2V5bWNqakNsWVY2SVwvV1pOWGJkak5SODYwWEFYbHZGcTJ2ekFGN0x6SlwvMD0iXV19" required="">
                          <input type="hidden" name="temp_r" value="eyJvcmlnaW4iOiJBTVMiLCJkZXN0aW5hdGlvbiI6IklTVCIsImRlcGFydF9kYXRlIjoiMzAtMDQtMjAxNiIsImRheXMiOiIiLCJkaXNjX3ByaWNlIjoiIiwiQ2FycmllcnMiOiIiLCJwcm92aWRlciI6IiIsIlN0b3AiOiIiLCJkZXBNaW5UaW1lIjoiMCIsImRlcE1heFRpbWUiOiIxNDQwIiwiYXJyTWluVGltZSI6IjAiLCJhcnJNYXhUaW1lIjoiMTQ0MCIsIk1pbkR1cmF0aW9uIjoiIiwiTWF4RHVyYXRpb24iOiIiLCJNaW5QcmljZSI6IiIsIk1heFByaWNlIjoiIiwiQWlybGluZSI6IiIsIkFEVCI6IjEiLCJDSEQiOiIwIiwiSU5GIjoiMCIsImNsYXNzIjoiIiwidHlwZSI6Ik8iLCJtZXRob2QiOiJBc3luY2gifQ==" required="">
                          <button type="submit" data-attr="F17191034" class="btn btn-primary">Book Now</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  <!-- modal flight End  -->
      </ul>
    </li>
    <!-- Normal trip End-->
        <div class="flight_smore"></div>            <input type="hidden" id="stops" value="">
    <input type="hidden" id="setMinPrice" value="100.03">
    <input type="hidden" id="setMaxPrice" value="1719.10">
    <input type="hidden" id="setMinTime" value="0">
    <input type="hidden" id="setMaxTime" value="1440">
    <input type="hidden" id="table_count">
    <input type="hidden" id="disc_price" value="">
    <script>
         showDepFlights(0, 1440)
                 showArrFlights(0, 1440)
                                function showFlights(minPrice, maxPrice) {
            $("ul.flights li.flight").hide().filter(function() {
              var price = $(this).find("span.amount").html();
              var price = parseFloat(price);
              console.log(price+' >= '+minPrice+' && '+price+' <= '+maxPrice);
              return price >= minPrice && price <= maxPrice;
            }).show();
          }
          function showDepFlights(mint, maxt) {
            $("ul.flights li.flight").hide().filter(function() {
              var dep = $(this).data("depature");
              return dep >= mint && dep <= maxt;
            }).show();
          }
          function showArrFlights(mint, maxt) {
            $("ul.flights li.flight").hide().filter(function() {
              var arr = $(this).data("arrive");
              return arr >= mint && arr <= maxt;
            }).show();
          }
          function showDurFlights(mint, maxt) {
            $("ul.flights li.flight").hide().filter(function() {
              var dur = $(this).data("duration");
              return dur >= mint && dur <= maxt;
            }).show();
          }
          $(function() {
            $( "#price-filter" ).slider({
              range: true,
              min: parseFloat($("#setMinPrice").val()),
              max: parseFloat($("#setMaxPrice").val()),
              values: [ parseFloat($("#setMinPrice").val()), parseFloat($("#setMaxPrice").val()) ],
              slide: function( event, ui ) {
                $('#min_price').text(CURR_ICON+ $( "#price-filter" ).slider( "values", 0 ));
                $('#max_price').text(CURR_ICON+ $( "#price-filter" ).slider( "values", 1 ) );
              },
              change: function( event, ui ) {
                one=ui.values[0];
                two=ui.values[1];
                showFlights(one, two);
              }
            });
            $('#min_price').text(CURR_ICON+ $( "#price-filter" ).slider( "values", 0 ));
            $('#max_price').text(CURR_ICON+ $( "#price-filter" ).slider( "values", 1 ) );
            $( "#departure-filter" ).slider({
              range: true,
              min: 0,
              max: 1439,
              step: 1,
              values: [ 0, 1439 ],
              slide: slideDep_Time,
              change: function( event, ui ) {
                one=ui.values[0];
                two=ui.values[1];
                showDepFlights(one, two);
              }
            });
            $( "#arrival-filter" ).slider({
              range: true,
              min: 0,
              max: 1439,
              step: 1,
              values: [ 0, 1439 ],
              slide: slideArr_Time,
              change: function( event, ui) {
                one=ui.values[0];
                two=ui.values[1];
                showArrFlights(one, two);
              }
            });
            $( "#duration-filter" ).slider({ 
              range: true,
              min: 0,
              max: 1439,
              step: 1,
              values: [ 0, 1439 ],
              slide: slideDur_Time,
              change: function( event, ui) {
                one=ui.values[0];
                two=ui.values[1];
                showDurFlights(one, two);
                flightFilteration();
              }
              
            });
          });
function getTime_(hours, minutes) {
  var time = null;
  minutes = minutes + "";
  


    /*if (hours < 12) {
      time = "AM";
    }
    else {
      time = "PM";
    }*/
    /*if (hours == 0) {
      hours = 12;
    }
    if (hours > 12) {
      hours = hours - 12;
    }*/
    if (minutes.length == 1) {
      minutes = "0" + minutes;
    }
    if (hours.length == 1) {
    hours = hours + "";
      hours = "0" + hours;
    }
    return hours + ":" + minutes + " Hrs";
  //return hours + ":" + minutes + " " + time;
}
var startTime;
var endTime;
function slideDep_Time(event, ui){
  var val0 = $("#departure-filter").slider("values", 0);
  val1 = $("#departure-filter").slider("values", 1);
  minutes0 = parseInt(val0 % 60, 10);
  hours0 = parseInt(val0 / 60 % 24, 10);
  minutes1 = parseInt(val1 % 60, 10);
  hours1 = parseInt(val1 / 60 % 24, 10);

  startTime = getTime_(hours0, minutes0);
  endTime = getTime_(hours1, minutes1);
  $("#min_departure").text(startTime );
  $("#max_departure").text(endTime);
}
var startTime;
var endTime;
function slideArr_Time(event, ui){
  var val0 = $("#arrival-filter").slider("values", 0);
  val1 = $("#arrival-filter").slider("values", 1);
  minutes0 = parseInt(val0 % 60, 10);
  hours0 = parseInt(val0 / 60 % 24, 10);
  minutes1 = parseInt(val1 % 60, 10);
  hours1 = parseInt(val1 / 60 % 24, 10);
  startTime = getTime_(hours0, minutes0);
  endTime = getTime_(hours1, minutes1);

  $("#min_arrival").text(startTime );
  $("#max_arrival").text(endTime);
}
var startTime;
var endTime;
function slideDur_Time(event, ui){
  var val0 = $("#duration-filter").slider("values", 0);
  val1 = $("#duration-filter").slider("values", 1);
  minutes0 = parseInt(val0 % 60, 10);
  hours0 = parseInt(val0 / 60 % 24, 10);
  minutes1 = parseInt(val1 % 60, 10);
  hours1 = parseInt(val1 / 60 % 24, 10);
  startTime = (hours0+'H');
  endTime = (hours1+'H');
  $("#min_duration").text(startTime);
  $("#max_duration").text(endTime);
}
slideDep_Time(); 
slideDur_Time();
slideArr_Time();
$(document).ready(function(){
 if($("#stops").val()!=''){
   var bb=$("#stops").val();
   $('ul.flights li.flight').hide();
   $('ul.flights li.flight[data-stops="'+ bb +'"]').show();
    flightFilteration();
 } 

 $('ul#Airlines li:last').after(' <li class="col-sm-6 nopadd"><label for="KL"><input name="AirlineFilter[]" type="checkbox" id="KL" value="KL"/>KLM Airlines </label></li> <li class="col-sm-6 nopadd"><label for="KK"><input name="AirlineFilter[]" type="checkbox" id="KK" value="KK"/>Atlasjet Airlines </label></li> <li class="col-sm-6 nopadd"><label for="TK"><input name="AirlineFilter[]" type="checkbox" id="TK" value="TK"/>Turkish Airlines </label></li> <li class="col-sm-6 nopadd"><label for="BA"><input name="AirlineFilter[]" type="checkbox" id="BA" value="BA"/>British Airways </label></li> <li class="col-sm-6 nopadd"><label for="SU"><input name="AirlineFilter[]" type="checkbox" id="SU" value="SU"/>Aeroflot Airlines </label></li> <li class="col-sm-6 nopadd"><label for="AF"><input name="AirlineFilter[]" type="checkbox" id="AF" value="AF"/>Air France </label></li> <li class="col-sm-6 nopadd"><label for="RO"><input name="AirlineFilter[]" type="checkbox" id="RO" value="RO"/>TAROM </label></li> <li class="col-sm-6 nopadd"><label for="PS"><input name="AirlineFilter[]" type="checkbox" id="PS" value="PS"/>Air Ukraine International </label></li> <li class="col-sm-6 nopadd"><label for="JU"><input name="AirlineFilter[]" type="checkbox" id="JU" value="JU"/>JAT Jugoslovenski Aerotransport </label></li> <li class="col-sm-6 nopadd"><label for="LX"><input name="AirlineFilter[]" type="checkbox" id="LX" value="LX"/>SWISS </label></li> <li class="col-sm-6 nopadd"><label for="LH"><input name="AirlineFilter[]" type="checkbox" id="LH" value="LH"/>Lufthansa Airlines </label></li> <li class="col-sm-6 nopadd"><label for="KM"><input name="AirlineFilter[]" type="checkbox" id="KM" value="KM"/>Air Malta </label></li> <li class="col-sm-6 nopadd"><label for="TP"><input name="AirlineFilter[]" type="checkbox" id="TP" value="TP"/>TAP - Air Portugal </label></li> <li class="col-sm-6 nopadd"><label for="RJ"><input name="AirlineFilter[]" type="checkbox" id="RJ" value="RJ"/>Royal Jordanian </label></li> <li class="col-sm-6 nopadd"><label for="LO"><input name="AirlineFilter[]" type="checkbox" id="LO" value="LO"/>LOT Polish Airlines </label></li> <li class="col-sm-6 nopadd"><label for="AZ"><input name="AirlineFilter[]" type="checkbox" id="AZ" value="AZ"/>Alitalia </label></li> <li class="col-sm-6 nopadd"><label for="OU"><input name="AirlineFilter[]" type="checkbox" id="OU" value="OU"/>Croatia Airlines </label></li> <li class="col-sm-6 nopadd"><label for="SK"><input name="AirlineFilter[]" type="checkbox" id="SK" value="SK"/>Scandinavian Airlines </label></li>');       
 $('#StopFilter option:last').after('<option value="0" >Non-Stop</option><option value="1" >One-Stop</option><option value="2" >Two-Stop</option>');
var $filters = $("input:checkbox[name='AirlineFilter[]']"); // start all checked
var $categoryContent = $('ul.flights li.flight'); // Path for flights
var $errorMessage = $('#errorMessage'); //Error Message
$filters.on('click', function(){
  $categoryContent.hide(); // if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
  var $selectedFilters = $filters.filter(':checked');
   if ($selectedFilters.length > 0) { 
    $errorMessage.hide();
      $selectedFilters.each(function (i, el) {
     var $selected = el.value;
     
  if ($selected!='All' && $selected!='') {
    
    $('ul.flights li.flight[data-airlinecode="'+ $selected +'"]').show();
     flightFilteration();
  }else if($selected=='All' || $selected==''){
    $errorMessage.hide();
    $('ul.flights li.flight').show();
  }
});
  }else {
    $errorMessage.show();
  }
});
var $filters1 = $("#StopFilter"); // start all checked
var $categoryContent1 = $('ul.flights li.flight'); // Path for flights
var $errorMessage = $('#errorMessage'); //Error Message
$filters1.on('change', function(){
  alert(1);
  $categoryContent1.hide(); // if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
  var $selectedFilters1 = $filters1.val();
  if ($selectedFilters1!='All' && $selectedFilters1!='') {
    $errorMessage.hide();
    $('ul.flights li.flight[data-stops="'+ $selectedFilters1 +'"]').show();
    flightFilteration();
  }else if($selectedFilters1=='All' || $selectedFilters1==''){
    $errorMessage.hide();
    $('ul.flights li.flight').show();
  } else {
    $errorMessage.show();
  }
});
});
$(document).ready(function(){
  var disc_price=$("#disc_price").val();
  $("li.flight").find("span.amount").each(function() {
    if($(this).text()==disc_price){
      $(this).after('<p class="text-success">Offer</p>');
    }
  });
});
var count = 0;
function limit_flight_table(){
  $('ul.flights li.flight').css('display','none');
  var click_count = ++count;
  var table_count = 15 * click_count;
  $('#table_count').val(table_count);
  var total_count = $('ul.flights li.flight').length;
  for(var i=0;i<table_count;i++){
    $('ul.flights li#ticketid0123'+i).css("display","block");
  }
  if(i > total_count){
    $('#load_more').css('display','none');
  }else{
    $('#load_more').css('display','block');
  }
}
$(document).ready(function(){
 $('#load_more').trigger('click');
});
</script>


<script type="text/javascript">


$(function() {
  

  });




  /***
  This code is for oneway, round and multicity.
  ***/
  function flightFilteration(){
   
    //code for checkall or uncheckall
   // var count_number_stops = $(".filtchk.stop").length, count_number_stops_checked = $(".filtchk.stop:checked").length;
    var count_number_airline = $("ul#Airlines li").length, count_number_airline_checked = $('input[name="AirlineFilter[]"]:checked').length;
    
    /////////////////////////////////////
    
        var hide_flight_cls_chkbox = "";
        
        // here collecting all unchecked data, which needs to be hide.
        $('input[name="AirlineFilter[]"]').each(function(){
            if($(this).prop("checked")==false){
                hide_flight_cls_chkbox += (hide_flight_cls_chkbox?",":"")+'"'+this.value+'":1';
            }
        });
        hide_flight_cls_chkbox = "{ "+ hide_flight_cls_chkbox +" }";
        //alert(hide_flight_cls_chkbox);
        hide_flight_cls_chkbox = JSON.parse(hide_flight_cls_chkbox);
        
        $(".flight").show(); // here showing all the data
        
        var hidden_rows = 0;
        

        

        // Here hiding records which are unchecked
        $("ul.flights li.flight").each(function(){
            var temp_airline = $(this).data("airlinecode");
            var temp_stops = $(this).data("stop");
      
            if(hide_flight_cls_chkbox[temp_airline]){
        hidden_rows++;
                $(this).hide();
            }else if(hide_flight_cls_chkbox[temp_stops]){
        hidden_rows++;
                $(this).hide();
            }
        });
        
        var minPrice = parseFloat($("#setMinPrice").val());
        var maxPrice = parseFloat($("#setMaxPrice").val());
        var minDepartTime = parseInt($("#setMinTime").val());
        var maxDepartTime = parseInt($("#setMaxTime").val());
        
        $("ul.flights li.flight").each(function(){
            var prices = parseFloat($(this).data("price"));
            var temp_departure = parseInt($(this).data('departure'));
            if( !( (minPrice <= prices) && (prices <= maxPrice) ) ){
        hidden_rows++;
                $(this).hide();
            }else if( !( (minDepartTime <= temp_departure) && (temp_departure <= maxDepartTime) ) ){
        hidden_rows++;
        $(this).hide();
            }
        });
       
    }
</script>
      </ul>
    </li>
 
    
   
    <li class="col-sm-12 fs_singlefligh flight_smore">
              <div class="spacer20"></div>
              <div class="showmoreoption text-center">
                          
              </div>
           
 <div id="errorMessage" style="text-align:center;display:none;" class="no_available">
    <h1>There are no flights available.</h1>
    <br><br>
    <div class="no_available_text">Sorry, we have no prices for flights in this date range matching your criteria. One or more of your preferences may be affecting the number of exact matches found. Try searching again with a wider search criteria.<br></div>
    </div>    </li>
</ul>
</div>
</div>
</div>
</div>
</div>





<script type="text/javascript">
  
$(function() {

  $(".dropdown-menu").click(function(event){

//event.preventDefault();
 event.stopPropagation();

});

$(".dropdown-menu").mouseleave(function(event){
$('div.padd_l').removeClass('open');

});


  $("li.flight_smore").on("click", "a.loadings", function() {

 
      var data={};
     data['type']=$(this).data('type'); 
     data['SearchId']=$(this).data('searchid'); 
     data['ProviderCode']=$(this).data('providercode');
     data['request']=$(this).data('request');
   
   $.ajax({
    type: 'POST',
    url: WEB_URL + "/flight/RetrieveLowFareSearchReq",
     data: data,
    async: true,
     cache: false,
    dataType: 'json',
   beforeSend: function() {

     $(".lodrefrentrev").fadeIn();
   },
   success: function(data) {
 
    $(data.result).insertAfter("ul.flights li.flight:last");
    $(".lodrefrentrev").fadeOut();
  
if(data.more_results.MoreResults==undefined){
$('.loadings').hide();
}
    $(window).scroll(function() {
      var winTop = $(this).scrollTop();
      var minusht = $(window).height() / 2;
      var $loaddiv = $('.scroll');

      var top = $.grep($loaddiv, function(item) {

        return $(item).position().top <= winTop + minusht;
      });
     
    });
    
    $("img.lazy").lazyload({
  threshold : 200,
  effect : "fadeIn",
  skip_invisible : false
});

 $("img.lazy").each(function() {

  $(this).attr("src", $(this).attr("data-original"));
  $(this).removeAttr("data-original");
});


  }
});

  });
  });

  function SortbyPrice(type){
 if (type == 'LH') {
  $('li.flight').not('.flights script').map(function () {
   return {val: parseFloat($(this).data('price')), el: this};
 }).sort(LH).map(function () {
   return this.el;
 }).appendTo('.flights');
}else{
  $('li.flight').not('.flights script').map(function () {
   return {val: parseFloat($(this).data('price')), el: this};
 }).sort(HL).map(function () {
   return this.el;
 }).appendTo('.flights');
}
}

function HL(a, b) {
  //alert('descending');
  return b.val - a.val;
}

function LH(a, b) {
  //alert('ascending');
  return a.val - b.val;
}

$(document).on('click','.flight-details-btn',function() {
  var ContetntModelId = $(this).attr('data-id');
  var ContetntModelContent = $('#'+ContetntModelId+' .modal-body').html();
  $('#Flight-Details .modal-body').html(ContetntModelContent);
});
</script></div>
    <!-- Search result End -->
    <!-- Search Engine Start -->
    <div class="container nopadd container_indexpage item">
      <div class="col-md-9">
        <div class="fullwidthbg_image">
          <img src="http://rf.tekhne.nl/assets/images/FACTORY_RF-02.png" class="factory_imageindexpng visible-md visible-lg">
          <img src="http://rf.tekhne.nl/assets/images/FACTORY_RF-02.svg" class="factory_imageindex2 visible-md visible-lg">
          <img src="http://rf.tekhne.nl/assets/images/FACTORY_MD.svg" class="factory_imageindex2 visible-sm">
          <img src="http://rf.tekhne.nl/assets/images/FACTORY_SM.svg" class="factory_imageindex2 visible-xs invisible_md">
          <div class="tab_contents color_white">
            <div class="col-sm-2">
              <h2 class="tc_title">Flight</h2>
            </div>
            <div class="col-xs-12">
              <form class="form-inline flight_form" name="flight" method="post" id="flight" action="http://rf.tekhne.nl/flight/search_flight" autocomplete="off">
                <div class="ff_radio">
                  <div class="radio-inline col-sm-2 padd_l">
                    <input type="radio" name="trip_type" id="radio1" class="triprad iradio_flat-blue" value="oneway"  />        
                    <label for="radio1">
                      <span class="fa-stack">
                        <i class="fa fa-circle fa-stack-1x circle"></i>
                        <i class="fa fa-circle fa-stack-1x circle-yellow"></i>
                      </span>
                      One - Way                    </label>
                  </div>
                  <div class="radio-inline  col-sm-2 padd_l">
                    <input type="radio" name="trip_type" id="radio2" class="triprad iradio_flat-blue" checked value="circle"/>     
                    <label for="radio2">
                      <span class="fa-stack">
                        <i class="fa fa-circle fa-stack-1x circle"></i>
                        <i class="fa fa-circle fa-stack-1x circle-yellow"></i>
                      </span>
                      Round - Trip                    </label>
                  </div>
                  <div class="radio-inline  col-sm-4 padd_l">
                    <input type="radio" name="trip_type" class="triprad iradio_flat-blue" id="radio3" value="multicity"/>        
                    <label for="radio3">
                      <span class="fa-stack">
                        <i class="fa fa-circle fa-stack-1x circle"></i>
                        <i class="fa fa-circle fa-stack-1x circle-yellow"></i>
                      </span>
                      Multi - City                    </label>
                  </div>
                </div>
                <div class="normal">
                  <div class="form-group col-xs-6 padd_l sm4paddr0">
                    <label> Flying From</label><br>
                    <input type="text" class="form-control fromflight full_width input_marker" name='from' placeholder="City Or Airport" value="" required>
                  </div>
                  <div class="form-group col-xs-6 padd_l smpaddr0">
                    <label> Flying To</label><br>
                    <input type="text" class="form-control departflight full_width input_marker" name='to' placeholder="City Or Airport" value="" required>
                  </div>
                  <div class="form-group col-xs-3 padd_l">
                    <label> Departing</label><br>
                    <input type="text" class="form-control full_width input_calender first" name='depature' id="depature" placeholder="dd/mm/yyyy" value="" required readonly>
                  </div>
                  <div class="form-group col-xs-3 sm2paddl0 sm3paddr0">
                    <label> Returning</label><br>
                    <input type="text" class="form-control full_width input_calender second" id="return" name='return' placeholder="dd/mm/yyyy" value="" required readonly>
                  </div>
                  <div class="form-group col-xs-3 col-sm-2 padd_l ffdp_passenger">
                    <label class="">Passengers</label>
                    <div class="input-wrapper drop-eft">
                      <input id="property" class="form-control input_caretdown" type="text" placeholder="1" name="person_select" readonly autocomplete="off">
                      <ul class="drop-spot" >
                        <li>
                          <ul>
                            <li><span> Adults</span>
                              <select name="adult" id="adult" class="input_caretdown">
                                <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option> 
                              </select>
                            </li>
                            <li class="divider1"></li>
                            <li><span> Child (2-11 yr)  </span>
                              <select name="child" id="child" class="input_caretdown">
                                <option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option> 
                              </select>
                            </li>
                            <li class="divider1"></li>
                            <li><span> Infant (<2 yr)</span>
                              <select name="infant" id="infant" class="input_caretdown">
                                <option value="0">0</option><option value="1">1</option> 
                              </select>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </div> 
                  </div>
                  <div class="form-group col-xs-3 col-sm-2 padd_l smpaddr0">
                    <label >Class of Travel</label><br>
                    <select name='class' class="form-control full_width input_caretdown">
                      <option value=""> All</option>                
                      <option value="Economy"> Economy</option>
                      <option value="PremiumEconomy"> Premium Economy</option>
                      <option value="Business"> Business</option>
                      <option value="First"> First</option>
                      <option value="PremiumFirst"> Premium first</option>
                    </select>
                  </div>
                  <div class="checkbox col-xs-12 padd_l">
                    <!-- <label id="flexible">
                      <input type="checkbox" value="1" id="days" name="days" >  Flexible                      
                    </label>-->
                     <label id="more_person">
                      <a style="color: #FFF;" href="home/more_passangers">More than 9 persons?</a>
                    </label>
                  </div>
                </div>
                <div class="multicity" style="display:none;">
                  <div class="form-group col-xs-6 padd_l sm4paddr0">
                    <label>Flying From</label><br>
                    <input type="text" class="form-control fromflight full_width input_marker" name='mfrom[0]' placeholder="City Or Airport"  required>
                  </div>
                  <div class="form-group col-xs-6 padd_l smpaddr0">
                    <label>Flying To</label><br>
                    <input type="text" class="form-control departflight full_width input_marker" name='mto[0]' placeholder="City Or Airport"  required>
                  </div>
                  <div class="form-group col-xs-3 padd_l">
                    <label>Departing</label><br>
                    <input type="text" class="form-control full_width input_calender" name='mdepature[0]' id="multi-departure" placeholder="dd/mm/yyyy"   required>
                  </div>
                  <!-- <div class="form-group col-xs-3 padd_l multicity_flexible">
                    <div class="checkbox">
                      <label class="invisible">&nbsp;</label><br>
                      <div class="spacer10"></div>
                      <label>
                        <input type="checkbox" checked> Flexible                      </label>
                       <label id="more_person">
                      <a style="color: #FFF;" href="home/more_passangers">More than 9 persons?</a>
                    </label>
                    </div>
                  </div> -->
                  <div class="form-group col-xs-3 col-sm-2 padd_l">
                    <label class="">Passengers</label><br>
                    <div class="input-wrapper drop-eft">
                      <input id="property1" class="form-control input_caretdown" type="text" placeholder="1" name="person_select" readonly autocomplete="off">
                      <ul class="drop-spot" >
                        <li>
                          <ul>
                            <li>
                              <span> Adults</span>
                              <select name="adult" id="adult1" class="input_caretdown">
                                <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option> 
                              </select>
                            </li>
                            <li class="divider1"></li>
                            <li>
                              <span> Child (2-11 yr)  </span>
                              <select name="child" id="child1" class="input_caretdown">
                                <option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option> 
                              </select>
                            </li>
                            <li class="divider1"></li>
                            <li>
                              <span> Infant (<2 yr)</span>
                              <select name="infant" id="infant1" class="input_caretdown">
                                <option value="0">0</option><option value="1">1</option> 
                              </select>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="form-group col-xs-3 col-sm-2 padd_l smpaddr0">
                    <label class="">Class of Travel</label><br>
                    <select name='class' class="form-control full_width input_caretdown">
                      <option value=""> All</option>     
                      <option value="Economy"> Economy</option>
                      <option value="PremiumEconomy"> Premium Economy</option>
                      <option value="Business"> Business</option>
                      <option value="First"> First</option>
                      <option value="PremiumFirst"> Premium first</option>
                    </select>
                  </div>
                  <div class="form-group col-xs-6 col-sm-10 padd_l  smpaddr0" id=''>
                    <ul class="list-inline miltiflight_list">
                      <li class="col-xs-5">
                        <label> Flying2:  Flying From</label>
                      </li>
                      <li class="col-xs-5">
                        <label> Flying To</label>
                      </li>
                      <li class="col-xs-2">
                        <label>&nbsp;</label>
                      </li>
                      <li class="col-xs-4">
                        <input type="text" class="form-control fromflight full_width input_marker" name='mfrom[1]' placeholder="City Or Airport" required>
                      </li>
                      <li class="col-xs-4">
                        <input type="text" class="form-control departflight full_width input_marker" name='mto[1]' placeholder="City Or Airport" required>
                      </li>
                      <li class="col-xs-4">
                        <input class="form-control input_calender full_width" id="multi-flight2" required name="mdepature[1]" placeholder="dd/mm/yyyy" type="text" />
                      </li>
                    </ul>
                  </div>                  
                  <div class="form-group col-xs-6 col-sm-10 padd_l miltif_listcon smpaddr0 " id='multiflight3'>
                    <ul class="list-inline miltiflight_list">
                      <li class="col-xs-5">
                        <label> Flying3:  Flying From</label>
                      </li>
                      <li class="col-xs-5">
                        <label> Flying To</label>
                      </li>
                      <li class="col-xs-2">
                        <label>&nbsp;</label>
                      </li>
                      <li class="col-xs-4">
                        <input type="text" class="form-control fromflight full_width input_marker" name='mfrom[2]' placeholder="City Or Airport" required>
                      </li>
                      <li class="col-xs-4">
                        <input type="text" class="form-control departflight full_width input_marker" name='mto[2]' placeholder="City Or Airport" required>
                      </li>
                      <li class="col-xs-4">
                        <input class="form-control input_calender full_width" id="multi-flight3" name="mdepature[2]" placeholder="dd/mm/yyyy" type="text" required />
                      </li>
                    </ul>
                  </div>
                  <div class="form-group col-xs-6 col-sm-10 padd_l miltif_listcon smpaddr0" id='multiflight4'>
                    <ul class="list-inline miltiflight_list">
                      <li class="col-xs-5">
                        <label> Flying4:  Flying From</label>
                      </li>
                      <li class="col-xs-5">
                        <label> Flying To</label>
                      </li>
                      <li class="col-xs-2">
                        <label>&nbsp;</label>
                      </li>
                      <li class="col-xs-4">
                        <input type="text" class="form-control fromflight full_width input_marker" name='mfrom[3]' placeholder="City Or Airport" required>
                      </li>
                      <li class="col-xs-4">
                        <input type="text" class="form-control departflight full_width input_marker" name='mto[3]' placeholder="City Or Airport" required>
                      </li>
                      <li class="col-xs-4">
                        <input class="form-control input_calender full_width" id="multi-flight4" name="mdepature[3]" placeholder="dd/mm/yyyy" type="text" required />
                      </li>
                    </ul>
                  </div>
                  <div class="col-xs-12 addflight_button">
                    <div class="btn btn_transparent" id='add-multiflight'>
                      <i class="fa fa-plus"></i> Add Flight                    </div>
                    <div class="btn btn_transparent hidden" id='remove-multiflight'>
                      <i class="fa fa-minus"></i> Remove Flight                    </div>
                    <span class='hidden' id='mlti-flight-count'>2</span>
                  </div>
                </div>
                <div class="col-xs-12 padd_l smpaddr0 ff_dropdown">
                  <button class="btn btn-primary ffd_caret" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <span class="caret"></span> <span class="btn_text"> Advanced options</span>
                  </button>
                  <div class="collapse stopclass" id="collapseExample">
                    <div class="well">
                      <div class="form-group col-xs-2 padd_l stopshide">
                        <select name="Stop" class="form-control full_width input_caretdown">
                          <option value=""> Any Stop</option>
                          <option value="0"> Non-Stop</option>
                          <option value="1"> One Stop</option>
                          <option value="2"> Two Stop</option>
                          <option value="3"> Three Stop</option>
                        </select>
                      </div>
                      <div class="form-group col-xs-2 padd_l multicitytime">
                        <button type="button" class="btn dropdown-toggle btn-inbox" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Times                        </button>
                        <ul class="dropdown-menu well_bgwhite" id="time">
                          <div class="well">
                            <div class="departure_time">
                              <p> Departure Time</p>
                              <div id="departure-range" class="float_lwidth"></div>
                              <input type="hidden" name="depMinTime" id="depMinTime" value="0" />
                              <input type="hidden" name="depMaxTime" id="depMaxTime" value="1440" />
                              <span class="time_left" id="left_label"></span>
                              <span class="time_right" id="right_label"></span>
                            </div>
                            <div class="arival_time">
                              <p> Arrival Time</p>
                              <div id="arrival-range" class="float_lwidth"></div>
                              <input type="hidden" name="arrMinTime" id="arrMinTime" value="0" />
                              <input type="hidden" name="arrMaxTime" id="arrMaxTime" value="1440" />
                              <span class="time_left" id="left_label2"></span>
                              <span class="time_right" id="right_label2"></span>
                            </div>
                          </div>
                        </ul>
                      </div>
                      <div class="form-group ffd_duration col-xs-2 padd_l">
                        <button type="button" class="btn dropdown-toggle btn-inbox" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Duration                        </button>
                        <ul class="dropdown-menu well_bgwhite" id="duration">
                          <div class="well">
                            <div class="departure_time">
                              <p> Duration</p>
                              <div id="duration-range" class="float_lwidth"></div>
                              <input type="hidden" name="MinDuration" id="MinDuration"/>
                              <input type="hidden" name="MaxDuration" id="MaxDuration" />    
                              <span class="time_left" id="left_duration"></span>
                              <span class="time_right" id="right_duration"></span>
                            </div>                             
                          </div>
                        </ul>
                      </div>
                      <div class="form-group col-xs-3 col-sm-2 padd_l">
                        <button type="button" class="btn dropdown-toggle btn-inbox" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Price                        </button>
                        <ul class="dropdown-menu well_bgwhite" id="price">
                          <div class="well">
                            <div class="departure_time">
                              <p> Price</p>
                              <div id="price-range" class="float_lwidth"></div>
                              <input type="hidden" name="MinPrice" id="MinPrice"/>
                              <input type="hidden" name="MaxPrice" id="MaxPrice" />    
                              <span class="time_left" id="left_price"></span>
                              <span class="time_right" id="right_price"></span>
                            </div>                             
                          </div>
                        </ul>
                      </div>
                      <div class="button-group col-xs-4 smpaddr0 padd_l ff_facilitydp">
                        <button type="button" class="btn dropdown-toggle btn-inbox" data-toggle="dropdown">Any Airline</button>
                        <ul class="dropdown-menu ffdp_dp">
                                                    <li class="col-xs-6 nopadd">
                            <label for="T6">
                              <input name="Airline[]" id="T6" type="checkbox" value="T6"/>1Time Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="I8">
                              <input name="Airline[]" id="I8" type="checkbox" value="I8"/>Aboriginal Air Services                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="9B">
                              <input name="Airline[]" id="9B" type="checkbox" value="9B"/>AccesRail                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="JP">
                              <input name="Airline[]" id="JP" type="checkbox" value="JP"/>Adria Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="DF">
                              <input name="Airline[]" id="DF" type="checkbox" value="DF"/>Aebal                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="A3">
                              <input name="Airline[]" id="A3" type="checkbox" value="A3"/>Aegean Airline S.A                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="RE">
                              <input name="Airline[]" id="RE" type="checkbox" value="RE"/>Aer Arann Express                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="EI">
                              <input name="Airline[]" id="EI" type="checkbox" value="EI"/>Aer Lingus                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="E4">
                              <input name="Airline[]" id="E4" type="checkbox" value="E4"/>Aero Asia International                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="JR">
                              <input name="Airline[]" id="JR" type="checkbox" value="JR"/>Aero California                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="NG">
                              <input name="Airline[]" id="NG" type="checkbox" value="NG"/>Aero Contractors Company Nigeria Lt                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="7T">
                              <input name="Airline[]" id="7T" type="checkbox" value="7T"/>Aero Express del Ecuador Trans AM                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="P4">
                              <input name="Airline[]" id="P4" type="checkbox" value="P4"/>Aero Lineas Sosa                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="M0">
                              <input name="Airline[]" id="M0" type="checkbox" value="M0"/>Aero Mongolia                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="P5">
                              <input name="Airline[]" id="P5" type="checkbox" value="P5"/>Aero Republica S.A                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="S9">
                              <input name="Airline[]" id="S9" type="checkbox" value="S9"/>Aero Surveys Ltd t/a Starbow                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="WV">
                              <input name="Airline[]" id="WV" type="checkbox" value="WV"/>Aero VIP Companhia Transportes Serv                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="H4">
                              <input name="Airline[]" id="H4" type="checkbox" value="H4"/>Aero4M d.o.o                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="A4">
                              <input name="Airline[]" id="A4" type="checkbox" value="A4"/>Aerocomercial Oriente Norte Ltda                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AJ">
                              <input name="Airline[]" id="AJ" type="checkbox" value="AJ"/>Aerocontractors                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SU">
                              <input name="Airline[]" id="SU" type="checkbox" value="SU"/>Aeroflot Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="KG">
                              <input name="Airline[]" id="KG" type="checkbox" value="KG"/>Aerogaviota                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AR">
                              <input name="Airline[]" id="AR" type="checkbox" value="AR"/>Aerolineas Argentinas                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="31">
                              <input name="Airline[]" id="31" type="checkbox" value="31"/>Aerolineas Del Sur                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="2K">
                              <input name="Airline[]" id="2K" type="checkbox" value="2K"/>Aerolineas Galapagos S.A. Aerogal                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="N3">
                              <input name="Airline[]" id="N3" type="checkbox" value="N3"/>Aerolineas MAS S.A.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="BQ">
                              <input name="Airline[]" id="BQ" type="checkbox" value="BQ"/>Aeromar Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AM">
                              <input name="Airline[]" id="AM" type="checkbox" value="AM"/>Aeromexico                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="5D">
                              <input name="Airline[]" id="5D" type="checkbox" value="5D"/>Aeromexico Connect                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="VH">
                              <input name="Airline[]" id="VH" type="checkbox" value="VH"/>Aeropostal                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="V5">
                              <input name="Airline[]" id="V5" type="checkbox" value="V5"/>Aerovias DAP S.A                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="HN">
                              <input name="Airline[]" id="HN" type="checkbox" value="HN"/>Afghan Jet International Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AW">
                              <input name="Airline[]" id="AW" type="checkbox" value="AW"/>Africa World Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="XU">
                              <input name="Airline[]" id="XU" type="checkbox" value="XU"/>African Express Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="8U">
                              <input name="Airline[]" id="8U" type="checkbox" value="8U"/>Afriqiyah Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="X5">
                              <input name="Airline[]" id="X5" type="checkbox" value="X5"/>Afrique Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ZI">
                              <input name="Airline[]" id="ZI" type="checkbox" value="ZI"/>Aigle Azur                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AH">
                              <input name="Airline[]" id="AH" type="checkbox" value="AH"/>Air Algerie                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="6I">
                              <input name="Airline[]" id="6I" type="checkbox" value="6I"/>Air Alsie                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="2Y">
                              <input name="Airline[]" id="2Y" type="checkbox" value="2Y"/>Air Andaman                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="3S">
                              <input name="Airline[]" id="3S" type="checkbox" value="3S"/>Air Antilles Express                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="G9">
                              <input name="Airline[]" id="G9" type="checkbox" value="G9"/>Air Arabia                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="3O">
                              <input name="Airline[]" id="3O" type="checkbox" value="3O"/>Air Arabia Maroc                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="KC">
                              <input name="Airline[]" id="KC" type="checkbox" value="KC"/>Air Astana                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UU">
                              <input name="Airline[]" id="UU" type="checkbox" value="UU"/>Air Austral                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="BT">
                              <input name="Airline[]" id="BT" type="checkbox" value="BT"/>Air Baltic Corporation AS                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AB">
                              <input name="Airline[]" id="AB" type="checkbox" value="AB"/>Air Berlin                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="KR">
                              <input name="Airline[]" id="KR" type="checkbox" value="KR"/>Air Bishkek                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="YL">
                              <input name="Airline[]" id="YL" type="checkbox" value="YL"/>Air Bissau International                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ED">
                              <input name="Airline[]" id="ED" type="checkbox" value="ED"/>Air Blue                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="BP">
                              <input name="Airline[]" id="BP" type="checkbox" value="BP"/>Air Botswana Pty.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="2J">
                              <input name="Airline[]" id="2J" type="checkbox" value="2J"/>Air Burkina                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SM">
                              <input name="Airline[]" id="SM" type="checkbox" value="SM"/>Air Cairo                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TY">
                              <input name="Airline[]" id="TY" type="checkbox" value="TY"/>Air Caledonie                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SB">
                              <input name="Airline[]" id="SB" type="checkbox" value="SB"/>Air Caledonie International                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AC">
                              <input name="Airline[]" id="AC" type="checkbox" value="AC"/>Air Canada                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="RV">
                              <input name="Airline[]" id="RV" type="checkbox" value="RV"/>Air Canada Rouge                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TX">
                              <input name="Airline[]" id="TX" type="checkbox" value="TX"/>Air Caraibes                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="NV">
                              <input name="Airline[]" id="NV" type="checkbox" value="NV"/>Air Central                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UP">
                              <input name="Airline[]" id="UP" type="checkbox" value="UP"/>Air Charter Bahamas                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="CA">
                              <input name="Airline[]" id="CA" type="checkbox" value="CA"/>Air China                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="3E">
                              <input name="Airline[]" id="3E" type="checkbox" value="3E"/>Air Choice One                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="4F">
                              <input name="Airline[]" id="4F" type="checkbox" value="4F"/>Air City                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SZ">
                              <input name="Airline[]" id="SZ" type="checkbox" value="SZ"/>Air Company Somon Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="YN">
                              <input name="Airline[]" id="YN" type="checkbox" value="YN"/>Air Creebec (1994) Inc                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="DQ">
                              <input name="Airline[]" id="DQ" type="checkbox" value="DQ"/>Air Direct Connect Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="EN">
                              <input name="Airline[]" id="EN" type="checkbox" value="EN"/>Air Dolomiti                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="RQ">
                              <input name="Airline[]" id="RQ" type="checkbox" value="RQ"/>Air Engiadina                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UX">
                              <input name="Airline[]" id="UX" type="checkbox" value="UX"/>Air Europa                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="X4">
                              <input name="Airline[]" id="X4" type="checkbox" value="X4"/>Air Excursions LLC                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PC">
                              <input name="Airline[]" id="PC" type="checkbox" value="PC"/>Air Fiji                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="OF">
                              <input name="Airline[]" id="OF" type="checkbox" value="OF"/>Air Finland Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AF">
                              <input name="Airline[]" id="AF" type="checkbox" value="AF"/>Air France                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UY">
                              <input name="Airline[]" id="UY" type="checkbox" value="UY"/>Air Georgia                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ZX">
                              <input name="Airline[]" id="ZX" type="checkbox" value="ZX"/>Air Georgia dba Air Alliance                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="EO">
                              <input name="Airline[]" id="EO" type="checkbox" value="EO"/>Air Go                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="GL">
                              <input name="Airline[]" id="GL" type="checkbox" value="GL"/>Air Greenland                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LQ">
                              <input name="Airline[]" id="LQ" type="checkbox" value="LQ"/>Air Guinea Cargo                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="NY">
                              <input name="Airline[]" id="NY" type="checkbox" value="NY"/>Air Iceland                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="KJ">
                              <input name="Airline[]" id="KJ" type="checkbox" value="KJ"/>Air Incheon                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AI">
                              <input name="Airline[]" id="AI" type="checkbox" value="AI"/>Air India                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="IX">
                              <input name="Airline[]" id="IX" type="checkbox" value="IX"/>Air India Charters Limited                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="3H">
                              <input name="Airline[]" id="3H" type="checkbox" value="3H"/>Air Inuit Ltd.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="VU">
                              <input name="Airline[]" id="VU" type="checkbox" value="VU"/>Air Ivoire                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="JM">
                              <input name="Airline[]" id="JM" type="checkbox" value="JM"/>Air Jamaica                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="NQ">
                              <input name="Airline[]" id="NQ" type="checkbox" value="NQ"/>Air Japan Company Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="JS">
                              <input name="Airline[]" id="JS" type="checkbox" value="JS"/>Air Koryo                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="QH">
                              <input name="Airline[]" id="QH" type="checkbox" value="QH"/>Air Kyrgystan                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UL">
                              <input name="Airline[]" id="UL" type="checkbox" value="UL"/>Air Lanka                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="L4">
                              <input name="Airline[]" id="L4" type="checkbox" value="L4"/>Air Liaison                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="NX">
                              <input name="Airline[]" id="NX" type="checkbox" value="NX"/>Air Macau Company Limited                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="MD">
                              <input name="Airline[]" id="MD" type="checkbox" value="MD"/>Air Madagascar                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="QM">
                              <input name="Airline[]" id="QM" type="checkbox" value="QM"/>Air Malawi                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="KM">
                              <input name="Airline[]" id="KM" type="checkbox" value="KM"/>Air Malta                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ZM">
                              <input name="Airline[]" id="ZM" type="checkbox" value="ZM"/>Air Manas                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="6T">
                              <input name="Airline[]" id="6T" type="checkbox" value="6T"/>Air Mandalay Ltd.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="MK">
                              <input name="Airline[]" id="MK" type="checkbox" value="MK"/>Air Mauritius                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ML">
                              <input name="Airline[]" id="ML" type="checkbox" value="ML"/>Air Mediterranee                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ZV">
                              <input name="Airline[]" id="ZV" type="checkbox" value="ZV"/>Air Midwest Inc.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="9U">
                              <input name="Airline[]" id="9U" type="checkbox" value="9U"/>Air Moldova                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SW">
                              <input name="Airline[]" id="SW" type="checkbox" value="SW"/>Air Namibia                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="NZ">
                              <input name="Airline[]" id="NZ" type="checkbox" value="NZ"/>Air New Zealand                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="7A">
                              <input name="Airline[]" id="7A" type="checkbox" value="7A"/>Air Next                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="EL">
                              <input name="Airline[]" id="EL" type="checkbox" value="EL"/>Air Nippon                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PX">
                              <input name="Airline[]" id="PX" type="checkbox" value="PX"/>Air Niugi                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TL">
                              <input name="Airline[]" id="TL" type="checkbox" value="TL"/>Air North Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="4N">
                              <input name="Airline[]" id="4N" type="checkbox" value="4N"/>Air North Charter and Training Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="YW">
                              <input name="Airline[]" id="YW" type="checkbox" value="YW"/>Air Nostrum L.A.M.S.A                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="FJ">
                              <input name="Airline[]" id="FJ" type="checkbox" value="FJ"/>Air Pacific                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="7P">
                              <input name="Airline[]" id="7P" type="checkbox" value="7P"/>Air Panama                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="A7">
                              <input name="Airline[]" id="A7" type="checkbox" value="A7"/>Air Plus Comet Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="GZ">
                              <input name="Airline[]" id="GZ" type="checkbox" value="GZ"/>Air Rarotonga                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="WB">
                              <input name="Airline[]" id="WB" type="checkbox" value="WB"/>Air Rwanda                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PJ">
                              <input name="Airline[]" id="PJ" type="checkbox" value="PJ"/>Air Saint-Pierre                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="EX">
                              <input name="Airline[]" id="EX" type="checkbox" value="EX"/>Air Santo Domingo                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="6O">
                              <input name="Airline[]" id="6O" type="checkbox" value="6O"/>Air Satellite                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="V7">
                              <input name="Airline[]" id="V7" type="checkbox" value="V7"/>Air Senegal                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="HM">
                              <input name="Airline[]" id="HM" type="checkbox" value="HM"/>Air Seychelles                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="4D">
                              <input name="Airline[]" id="4D" type="checkbox" value="4D"/>Air Sinai                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="YI">
                              <input name="Airline[]" id="YI" type="checkbox" value="YI"/>Air Sunshine                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="VT">
                              <input name="Airline[]" id="VT" type="checkbox" value="VT"/>Air Tahiti                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TN">
                              <input name="Airline[]" id="TN" type="checkbox" value="TN"/>Air Tahiti Nui                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TC">
                              <input name="Airline[]" id="TC" type="checkbox" value="TC"/>Air Tanzania                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="8T">
                              <input name="Airline[]" id="8T" type="checkbox" value="8T"/>Air tendi                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="6C">
                              <input name="Airline[]" id="6C" type="checkbox" value="6C"/>Air Timor S.A.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TS">
                              <input name="Airline[]" id="TS" type="checkbox" value="TS"/>Air Transat                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PS">
                              <input name="Airline[]" id="PS" type="checkbox" value="PS"/>Air Ukraine International                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="3N">
                              <input name="Airline[]" id="3N" type="checkbox" value="3N"/>Air Urga                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="NF">
                              <input name="Airline[]" id="NF" type="checkbox" value="NF"/>Air Vanuatu                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="6V">
                              <input name="Airline[]" id="6V" type="checkbox" value="6V"/>Air Vegas                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ZW">
                              <input name="Airline[]" id="ZW" type="checkbox" value="ZW"/>Air Wisconsin                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UM">
                              <input name="Airline[]" id="UM" type="checkbox" value="UM"/>Air Zimbabwe                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AK">
                              <input name="Airline[]" id="AK" type="checkbox" value="AK"/>AirAsia                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="I5">
                              <input name="Airline[]" id="I5" type="checkbox" value="I5"/>AirAsia (India)                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PQ">
                              <input name="Airline[]" id="PQ" type="checkbox" value="PQ"/>AirAsia Inc                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="D7">
                              <input name="Airline[]" id="D7" type="checkbox" value="D7"/>AirAsia X Sdn. Bhd.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="KV">
                              <input name="Airline[]" id="KV" type="checkbox" value="KV"/>Aircompany Asian Air Express                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UH">
                              <input name="Airline[]" id="UH" type="checkbox" value="UH"/>Aircompany Atlasjet Ukraine LLC                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="YQ">
                              <input name="Airline[]" id="YQ" type="checkbox" value="YQ"/>Aircompany Polet                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="HD">
                              <input name="Airline[]" id="HD" type="checkbox" value="HD"/>AirDo                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="P2">
                              <input name="Airline[]" id="P2" type="checkbox" value="P2"/>AirKenya Express                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AN">
                              <input name="Airline[]" id="AN" type="checkbox" value="AN"/>Airlinair                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="CG">
                              <input name="Airline[]" id="CG" type="checkbox" value="CG"/>Airlines of Papua New Guinea                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="FO">
                              <input name="Airline[]" id="FO" type="checkbox" value="FO"/>Airlines of Tasmania                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="4Z">
                              <input name="Airline[]" id="4Z" type="checkbox" value="4Z"/>Airlink Pty.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AP">
                              <input name="Airline[]" id="AP" type="checkbox" value="AP"/>AirOne S.P.A                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="FL">
                              <input name="Airline[]" id="FL" type="checkbox" value="FL"/>AirTran Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="2B">
                              <input name="Airline[]" id="2B" type="checkbox" value="2B"/>AK Bars Aero                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="6L">
                              <input name="Airline[]" id="6L" type="checkbox" value="6L"/>Aklak Inc                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AS">
                              <input name="Airline[]" id="AS" type="checkbox" value="AS"/>Alaska Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="KO">
                              <input name="Airline[]" id="KO" type="checkbox" value="KO"/>Alaska Central Express                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="J5">
                              <input name="Airline[]" id="J5" type="checkbox" value="J5"/>Alaska Seaplane Service LLC                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LV">
                              <input name="Airline[]" id="LV" type="checkbox" value="LV"/>Albanian Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ZR">
                              <input name="Airline[]" id="ZR" type="checkbox" value="ZR"/>Alexandria Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="D4">
                              <input name="Airline[]" id="D4" type="checkbox" value="D4"/>Alidaunia S.R.L                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AZ">
                              <input name="Airline[]" id="AZ" type="checkbox" value="AZ"/>Alitalia                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="CT">
                              <input name="Airline[]" id="CT" type="checkbox" value="CT"/>Alitalia City Liner SPA                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="YY">
                              <input name="Airline[]" id="YY" type="checkbox" value="YY"/>All Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="NH">
                              <input name="Airline[]" id="NH" type="checkbox" value="NH"/>All Nippon Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="G4">
                              <input name="Airline[]" id="G4" type="checkbox" value="G4"/>Allegiant Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="9I">
                              <input name="Airline[]" id="9I" type="checkbox" value="9I"/>Alliance Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="CD">
                              <input name="Airline[]" id="CD" type="checkbox" value="CD"/>Alliance Air (India)                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="3A">
                              <input name="Airline[]" id="3A" type="checkbox" value="3A"/>Alliance Airlines Inc                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="QQ">
                              <input name="Airline[]" id="QQ" type="checkbox" value="QQ"/>Alliance Airlines Pty Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UJ">
                              <input name="Airline[]" id="UJ" type="checkbox" value="UJ"/>Almasria Universal Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AQ">
                              <input name="Airline[]" id="AQ" type="checkbox" value="AQ"/>Aloha Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PE">
                              <input name="Airline[]" id="PE" type="checkbox" value="PE"/>Altenrhein Luftfahrt                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="YJ">
                              <input name="Airline[]" id="YJ" type="checkbox" value="YJ"/>AMC Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="HP">
                              <input name="Airline[]" id="HP" type="checkbox" value="HP"/>America West Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AA">
                              <input name="Airline[]" id="AA" type="checkbox" value="AA"/>American Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TZ">
                              <input name="Airline[]" id="TZ" type="checkbox" value="TZ"/>American Trans Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="JH">
                              <input name="Airline[]" id="JH" type="checkbox" value="JH"/>Amerijet International                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="2V">
                              <input name="Airline[]" id="2V" type="checkbox" value="2V"/>Amtrak                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="EH">
                              <input name="Airline[]" id="EH" type="checkbox" value="EH"/>ANA Wings Co Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="OY">
                              <input name="Airline[]" id="OY" type="checkbox" value="OY"/>Andes Lineas Aeras SA                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="2G">
                              <input name="Airline[]" id="2G" type="checkbox" value="2G"/>Angara Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="G6">
                              <input name="Airline[]" id="G6" type="checkbox" value="G6"/>Angkor Airways Corporation                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="5F">
                              <input name="Airline[]" id="5F" type="checkbox" value="5F"/>Arctic Circle Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ZE">
                              <input name="Airline[]" id="ZE" type="checkbox" value="ZE"/>Arcus Air Logistic                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="FG">
                              <input name="Airline[]" id="FG" type="checkbox" value="FG"/>Ariana-Afghan-Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="W3">
                              <input name="Airline[]" id="W3" type="checkbox" value="W3"/>Arik Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="IZ">
                              <input name="Airline[]" id="IZ" type="checkbox" value="IZ"/>Arkia Israeli Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="MV">
                              <input name="Airline[]" id="MV" type="checkbox" value="MV"/>Armenian International Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="7S">
                              <input name="Airline[]" id="7S" type="checkbox" value="7S"/>Artic Transportation Services                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AG">
                              <input name="Airline[]" id="AG" type="checkbox" value="AG"/>Aruba Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="R7">
                              <input name="Airline[]" id="R7" type="checkbox" value="R7"/>Aserca Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="HB">
                              <input name="Airline[]" id="HB" type="checkbox" value="HB"/>Asia Atlantic Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="OZ">
                              <input name="Airline[]" id="OZ" type="checkbox" value="OZ"/>Asiana Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="KP">
                              <input name="Airline[]" id="KP" type="checkbox" value="KP"/>ASKY                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="I3">
                              <input name="Airline[]" id="I3" type="checkbox" value="I3"/>ATA Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="RC">
                              <input name="Airline[]" id="RC" type="checkbox" value="RC"/>Atlantic Air Transport                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="2N">
                              <input name="Airline[]" id="2N" type="checkbox" value="2N"/>Atlantic Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="EV">
                              <input name="Airline[]" id="EV" type="checkbox" value="EV"/>Atlantic Southeast Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TD">
                              <input name="Airline[]" id="TD" type="checkbox" value="TD"/>Atlantis European Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="5Y">
                              <input name="Airline[]" id="5Y" type="checkbox" value="5Y"/>Atlas Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="8A">
                              <input name="Airline[]" id="8A" type="checkbox" value="8A"/>Atlas Blue                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="KK">
                              <input name="Airline[]" id="KK" type="checkbox" value="KK"/>Atlasjet Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="GR">
                              <input name="Airline[]" id="GR" type="checkbox" value="GR"/>Aurigny Air Services Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AU">
                              <input name="Airline[]" id="AU" type="checkbox" value="AU"/>Austral Lineas Aerea S.A                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="OS">
                              <input name="Airline[]" id="OS" type="checkbox" value="OS"/>Austrian Air Services                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AV">
                              <input name="Airline[]" id="AV" type="checkbox" value="AV"/>Avianca                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="O6">
                              <input name="Airline[]" id="O6" type="checkbox" value="O6"/>Avianca Brazil                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="WR">
                              <input name="Airline[]" id="WR" type="checkbox" value="WR"/>Aviaprad                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="GU">
                              <input name="Airline[]" id="GU" type="checkbox" value="GU"/>Aviateca S.A                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="U3">
                              <input name="Airline[]" id="U3" type="checkbox" value="U3"/>Avies LTD                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="M4">
                              <input name="Airline[]" id="M4" type="checkbox" value="M4"/>Aviompex                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="X9">
                              <input name="Airline[]" id="X9" type="checkbox" value="X9"/>Avion Express                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="9V">
                              <input name="Airline[]" id="9V" type="checkbox" value="9V"/>Avior Airlines C.A                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="J2">
                              <input name="Airline[]" id="J2" type="checkbox" value="J2"/>Azerbaijan Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AD">
                              <input name="Airline[]" id="AD" type="checkbox" value="AD"/>Azul Linhas Aereas                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="JA">
                              <input name="Airline[]" id="JA" type="checkbox" value="JA"/>B and H Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="CJ">
                              <input name="Airline[]" id="CJ" type="checkbox" value="CJ"/>BA City Flyer                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UP">
                              <input name="Airline[]" id="UP" type="checkbox" value="UP"/>Bahamas Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PG">
                              <input name="Airline[]" id="PG" type="checkbox" value="PG"/>Bangkok Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="5B">
                              <input name="Airline[]" id="5B" type="checkbox" value="5B"/>Bassaka Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ID">
                              <input name="Airline[]" id="ID" type="checkbox" value="ID"/>Batik Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="JV">
                              <input name="Airline[]" id="JV" type="checkbox" value="JV"/>Bearskin Lake Air Service                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="JD">
                              <input name="Airline[]" id="JD" type="checkbox" value="JD"/>Beijing Capital Airlines Co Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="4T">
                              <input name="Airline[]" id="4T" type="checkbox" value="4T"/>Belair Airlines Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="B2">
                              <input name="Airline[]" id="B2" type="checkbox" value="B2"/>Belavia                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="CH">
                              <input name="Airline[]" id="CH" type="checkbox" value="CH"/>Bemidji Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="A8">
                              <input name="Airline[]" id="A8" type="checkbox" value="A8"/>Benin Golf Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="8E">
                              <input name="Airline[]" id="8E" type="checkbox" value="8E"/>Bering Air Inc.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="BG">
                              <input name="Airline[]" id="BG" type="checkbox" value="BG"/>Biman Bangladesh Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="NT">
                              <input name="Airline[]" id="NT" type="checkbox" value="NT"/>Binter Canarias                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="0B">
                              <input name="Airline[]" id="0B" type="checkbox" value="0B"/>Blue Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="BZ">
                              <input name="Airline[]" id="BZ" type="checkbox" value="BZ"/>Blue Bird Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SI">
                              <input name="Airline[]" id="SI" type="checkbox" value="SI"/>Blue Islands Limited                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="BV">
                              <input name="Airline[]" id="BV" type="checkbox" value="BV"/>Blue Panorama Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="OB">
                              <input name="Airline[]" id="OB" type="checkbox" value="OB"/>Boliviana De Aviacion BOA                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="4B">
                              <input name="Airline[]" id="4B" type="checkbox" value="4B"/>Boutique Air Inc                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="5Q">
                              <input name="Airline[]" id="5Q" type="checkbox" value="5Q"/>BQB Lineas Aereas                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="DC">
                              <input name="Airline[]" id="DC" type="checkbox" value="DC"/>Braathens Regional AB                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="1X">
                              <input name="Airline[]" id="1X" type="checkbox" value="1X"/>Branson Air Express                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="DB">
                              <input name="Airline[]" id="DB" type="checkbox" value="DB"/>Brit Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="BY">
                              <input name="Airline[]" id="BY" type="checkbox" value="BY"/>Britannia Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="BA">
                              <input name="Airline[]" id="BA" type="checkbox" value="BA"/>British Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TH">
                              <input name="Airline[]" id="TH" type="checkbox" value="TH"/>British Airways Citiexpress                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="BS">
                              <input name="Airline[]" id="BS" type="checkbox" value="BS"/>British International Helicopters                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="BM">
                              <input name="Airline[]" id="BM" type="checkbox" value="BM"/>British Midland Regional Limited                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="BD">
                              <input name="Airline[]" id="BD" type="checkbox" value="BD"/>British MidlandÂ                            
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SN">
                              <input name="Airline[]" id="SN" type="checkbox" value="SN"/>Brussels Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="U4">
                              <input name="Airline[]" id="U4" type="checkbox" value="U4"/>Buddha Air Pvt Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="FB">
                              <input name="Airline[]" id="FB" type="checkbox" value="FB"/>Bulgaria Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UZ">
                              <input name="Airline[]" id="UZ" type="checkbox" value="UZ"/>Buraq Air transport                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="XD">
                              <input name="Airline[]" id="XD" type="checkbox" value="XD"/>Bus                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="VE">
                              <input name="Airline[]" id="VE" type="checkbox" value="VE"/>C.A.I Second S.P.A                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="XM">
                              <input name="Airline[]" id="XM" type="checkbox" value="XM"/>CAI First SPA                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="9Q">
                              <input name="Airline[]" id="9Q" type="checkbox" value="9Q"/>Caicos Express Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="OE">
                              <input name="Airline[]" id="OE" type="checkbox" value="OE"/>Cairo Aviation                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="3C">
                              <input name="Airline[]" id="3C" type="checkbox" value="3C"/>Calima Aviacion                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="MO">
                              <input name="Airline[]" id="MO" type="checkbox" value="MO"/>Calm Air International                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="R9">
                              <input name="Airline[]" id="R9" type="checkbox" value="R9"/>Camai Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="K6">
                              <input name="Airline[]" id="K6" type="checkbox" value="K6"/>Cambodia Angkor Air Co Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="QC">
                              <input name="Airline[]" id="QC" type="checkbox" value="QC"/>Cameroon Airlines Corporation                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="5T">
                              <input name="Airline[]" id="5T" type="checkbox" value="5T"/>Canadian North                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="C6">
                              <input name="Airline[]" id="C6" type="checkbox" value="C6"/>Canjet Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="9K">
                              <input name="Airline[]" id="9K" type="checkbox" value="9K"/>Cape Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="CV">
                              <input name="Airline[]" id="CV" type="checkbox" value="CV"/>Cargolux Airlines International                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="3Q">
                              <input name="Airline[]" id="3Q" type="checkbox" value="3Q"/>Carib Aviation                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="BW">
                              <input name="Airline[]" id="BW" type="checkbox" value="BW"/>Caribbean Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="V3">
                              <input name="Airline[]" id="V3" type="checkbox" value="V3"/>CarpatAir                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="IV">
                              <input name="Airline[]" id="IV" type="checkbox" value="IV"/>Caspian Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="CX">
                              <input name="Airline[]" id="CX" type="checkbox" value="CX"/>Cathay Pacific Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="KX">
                              <input name="Airline[]" id="KX" type="checkbox" value="KX"/>Cayman Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="XK">
                              <input name="Airline[]" id="XK" type="checkbox" value="XK"/>CCM Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="C2">
                              <input name="Airline[]" id="C2" type="checkbox" value="C2"/>CEIBA Intercontinental                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="5Z">
                              <input name="Airline[]" id="5Z" type="checkbox" value="5Z"/>Cemair                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="9M">
                              <input name="Airline[]" id="9M" type="checkbox" value="9M"/>Central Mountain Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="C0">
                              <input name="Airline[]" id="C0" type="checkbox" value="C0"/>Centralwings                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="J7">
                              <input name="Airline[]" id="J7" type="checkbox" value="J7"/>Centre-Avia Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="CE">
                              <input name="Airline[]" id="CE" type="checkbox" value="CE"/>Chalair Aviation                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="OP">
                              <input name="Airline[]" id="OP" type="checkbox" value="OP"/>Chalks International Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="6Q">
                              <input name="Airline[]" id="6Q" type="checkbox" value="6Q"/>Cham Wings Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="XI">
                              <input name="Airline[]" id="XI" type="checkbox" value="XI"/>Charter                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="RP">
                              <input name="Airline[]" id="RP" type="checkbox" value="RP"/>Chautauqua Airlines Inc                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="EU">
                              <input name="Airline[]" id="EU" type="checkbox" value="EU"/>Chengdu Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="CI">
                              <input name="Airline[]" id="CI" type="checkbox" value="CI"/>China Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="MU">
                              <input name="Airline[]" id="MU" type="checkbox" value="MU"/>China Eastern Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="G5">
                              <input name="Airline[]" id="G5" type="checkbox" value="G5"/>China Express Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="CZ">
                              <input name="Airline[]" id="CZ" type="checkbox" value="CZ"/>China Southern Airline                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PN">
                              <input name="Airline[]" id="PN" type="checkbox" value="PN"/>China West Air Co Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="OQ">
                              <input name="Airline[]" id="OQ" type="checkbox" value="OQ"/>Chongqing Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="QA">
                              <input name="Airline[]" id="QA" type="checkbox" value="QA"/>Cimber A/S                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="QI">
                              <input name="Airline[]" id="QI" type="checkbox" value="QI"/>Cimber Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="C7">
                              <input name="Airline[]" id="C7" type="checkbox" value="C7"/>Cinnamon Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="C9">
                              <input name="Airline[]" id="C9" type="checkbox" value="C9"/>Cirrus Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="CF">
                              <input name="Airline[]" id="CF" type="checkbox" value="CF"/>City Airline AB                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="E8">
                              <input name="Airline[]" id="E8" type="checkbox" value="E8"/>City Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="WX">
                              <input name="Airline[]" id="WX" type="checkbox" value="WX"/>City Jet                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="V9">
                              <input name="Airline[]" id="V9" type="checkbox" value="V9"/>Citywing                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="9L">
                              <input name="Airline[]" id="9L" type="checkbox" value="9L"/>Colgan Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="OH">
                              <input name="Airline[]" id="OH" type="checkbox" value="OH"/>Comair Inc.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="MN">
                              <input name="Airline[]" id="MN" type="checkbox" value="MN"/>Comair Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="C5">
                              <input name="Airline[]" id="C5" type="checkbox" value="C5"/>CommutAir                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="O5">
                              <input name="Airline[]" id="O5" type="checkbox" value="O5"/>Comores Aviation                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="CP">
                              <input name="Airline[]" id="CP" type="checkbox" value="CP"/>Compass Airlines Inc                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="Y4">
                              <input name="Airline[]" id="Y4" type="checkbox" value="Y4"/>Concesionaria Vuela Compania De Avi                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="DE">
                              <input name="Airline[]" id="DE" type="checkbox" value="DE"/>Condor Flugdienst                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="CO">
                              <input name="Airline[]" id="CO" type="checkbox" value="CO"/>Continental Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="CS">
                              <input name="Airline[]" id="CS" type="checkbox" value="CS"/>Continental Micronesia Inc                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="V0">
                              <input name="Airline[]" id="V0" type="checkbox" value="V0"/>Conviasa                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="CM">
                              <input name="Airline[]" id="CM" type="checkbox" value="CM"/>Copa Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SS">
                              <input name="Airline[]" id="SS" type="checkbox" value="SS"/>Corsair                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="8C">
                              <input name="Airline[]" id="8C" type="checkbox" value="8C"/>Cotai Ferry Company                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="OU">
                              <input name="Airline[]" id="OU" type="checkbox" value="OU"/>Croatia Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="C8">
                              <input name="Airline[]" id="C8" type="checkbox" value="C8"/>Cronus Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="CU">
                              <input name="Airline[]" id="CU" type="checkbox" value="CU"/>Cubana Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="CY">
                              <input name="Airline[]" id="CY" type="checkbox" value="CY"/>Cyprus Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="YK">
                              <input name="Airline[]" id="YK" type="checkbox" value="YK"/>Cyprus Turkish Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="OK">
                              <input name="Airline[]" id="OK" type="checkbox" value="OK"/>Czech Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="CQ">
                              <input name="Airline[]" id="CQ" type="checkbox" value="CQ"/>Czech Connect                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="N2">
                              <input name="Airline[]" id="N2" type="checkbox" value="N2"/>Dagestan Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="9J">
                              <input name="Airline[]" id="9J" type="checkbox" value="9J"/>Dana Airlines Limited                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="DX">
                              <input name="Airline[]" id="DX" type="checkbox" value="DX"/>Danish Air Transport                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="D5">
                              <input name="Airline[]" id="D5" type="checkbox" value="D5"/>Dauair                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="DL">
                              <input name="Airline[]" id="DL" type="checkbox" value="DL"/>Delta Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="2A">
                              <input name="Airline[]" id="2A" type="checkbox" value="2A"/>Deutsche Bahn                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ES">
                              <input name="Airline[]" id="ES" type="checkbox" value="ES"/>DHL International B.S.C.(C) Aviatio                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="DO">
                              <input name="Airline[]" id="DO" type="checkbox" value="DO"/>Discovery Airways Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="Z6">
                              <input name="Airline[]" id="Z6" type="checkbox" value="Z6"/>Dniproavia Joint Stock Aviation Co                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="7D">
                              <input name="Airline[]" id="7D" type="checkbox" value="7D"/>DonbassAero                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="R6">
                              <input name="Airline[]" id="R6" type="checkbox" value="R6"/>DOT LT                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="KA">
                              <input name="Airline[]" id="KA" type="checkbox" value="KA"/>Dragonair (Hong Kong Dragon Airlines)                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="Y3">
                              <input name="Airline[]" id="Y3" type="checkbox" value="Y3"/>Driessen Services Inc                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="KB">
                              <input name="Airline[]" id="KB" type="checkbox" value="KB"/>Druk Air Corporation Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="9H">
                              <input name="Airline[]" id="9H" type="checkbox" value="9H"/>Dutch Antilles Express                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="2D">
                              <input name="Airline[]" id="2D" type="checkbox" value="2D"/>Dynamic Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="H7">
                              <input name="Airline[]" id="H7" type="checkbox" value="H7"/>Eagle Air Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="E2">
                              <input name="Airline[]" id="E2" type="checkbox" value="E2"/>Eagle Atlantic Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="T3">
                              <input name="Airline[]" id="T3" type="checkbox" value="T3"/>Eastern Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="EE">
                              <input name="Airline[]" id="EE" type="checkbox" value="EE"/>Eastern SkyJets                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="U2">
                              <input name="Airline[]" id="U2" type="checkbox" value="U2"/>Easyjet Airline Company Limited                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="WK">
                              <input name="Airline[]" id="WK" type="checkbox" value="WK"/>Edelweiss Air AG                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="MS">
                              <input name="Airline[]" id="MS" type="checkbox" value="MS"/>Egyptair                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LY">
                              <input name="Airline[]" id="LY" type="checkbox" value="LY"/>El Al Israel Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="EK">
                              <input name="Airline[]" id="EK" type="checkbox" value="EK"/>Emirates Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="EM">
                              <input name="Airline[]" id="EM" type="checkbox" value="EM"/>Empire Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="9E">
                              <input name="Airline[]" id="9E" type="checkbox" value="9E"/>Endeavor Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="MQ">
                              <input name="Airline[]" id="MQ" type="checkbox" value="MQ"/>Envoy Air Inc                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="E7">
                              <input name="Airline[]" id="E7" type="checkbox" value="E7"/>Equaflight Service                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LC">
                              <input name="Airline[]" id="LC" type="checkbox" value="LC"/>Equatorial Congo Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="7H">
                              <input name="Airline[]" id="7H" type="checkbox" value="7H"/>ERA Aviation                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="B8">
                              <input name="Airline[]" id="B8" type="checkbox" value="B8"/>Eritrean Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="K9">
                              <input name="Airline[]" id="K9" type="checkbox" value="K9"/>Esen Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="OV">
                              <input name="Airline[]" id="OV" type="checkbox" value="OV"/>Estonian Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ET">
                              <input name="Airline[]" id="ET" type="checkbox" value="ET"/>Ethiopian Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="EY">
                              <input name="Airline[]" id="EY" type="checkbox" value="EY"/>Etihad Airways                            
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="F7">
                              <input name="Airline[]" id="F7" type="checkbox" value="F7"/>Etihad Regional                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="YU">
                              <input name="Airline[]" id="YU" type="checkbox" value="YU"/>Euroatlantic Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UI">
                              <input name="Airline[]" id="UI" type="checkbox" value="UI"/>Eurocypria Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="K2">
                              <input name="Airline[]" id="K2" type="checkbox" value="K2"/>Eurolot S. A.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="5O">
                              <input name="Airline[]" id="5O" type="checkbox" value="5O"/>Europe Airpost                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="EA">
                              <input name="Airline[]" id="EA" type="checkbox" value="EA"/>European Air Express                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="QY">
                              <input name="Airline[]" id="QY" type="checkbox" value="QY"/>European Air Transport                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="9F">
                              <input name="Airline[]" id="9F" type="checkbox" value="9F"/>Eurostar                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="EW">
                              <input name="Airline[]" id="EW" type="checkbox" value="EW"/>Eurowings GmbH                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="BR">
                              <input name="Airline[]" id="BR" type="checkbox" value="BR"/>EVA Airways Corporation                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="E9">
                              <input name="Airline[]" id="E9" type="checkbox" value="E9"/>Evelop Airlines S.L.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ZD">
                              <input name="Airline[]" id="ZD" type="checkbox" value="ZD"/>EWA Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="X7">
                              <input name="Airline[]" id="X7" type="checkbox" value="X7"/>Exec Air Inc of Naples                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="XE">
                              <input name="Airline[]" id="XE" type="checkbox" value="XE"/>Express Jet Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="FE">
                              <input name="Airline[]" id="FE" type="checkbox" value="FE"/>Far Eastern Air Transport Corp                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="EF">
                              <input name="Airline[]" id="EF" type="checkbox" value="EF"/>Far Eastern Air Transport Corporation                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="7V">
                              <input name="Airline[]" id="7V" type="checkbox" value="7V"/>Federal Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AY">
                              <input name="Airline[]" id="AY" type="checkbox" value="AY"/>Finnair                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="FY">
                              <input name="Airline[]" id="FY" type="checkbox" value="FY"/>Firefly                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="7F">
                              <input name="Airline[]" id="7F" type="checkbox" value="7F"/>FirstAir                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="5H">
                              <input name="Airline[]" id="5H" type="checkbox" value="5H"/>Five Fourty Aviation Limited                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="W2">
                              <input name="Airline[]" id="W2" type="checkbox" value="W2"/>FlexFlight ApS                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="RF">
                              <input name="Airline[]" id="RF" type="checkbox" value="RF"/>Florida West International Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="F3">
                              <input name="Airline[]" id="F3" type="checkbox" value="F3"/>Fly Excellent                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="OJ">
                              <input name="Airline[]" id="OJ" type="checkbox" value="OJ"/>Fly Jamaica Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="Z7">
                              <input name="Airline[]" id="Z7" type="checkbox" value="Z7"/>Flyafrica Zimbabwe                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="BE">
                              <input name="Airline[]" id="BE" type="checkbox" value="BE"/>Flybe                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="FC">
                              <input name="Airline[]" id="FC" type="checkbox" value="FC"/>FlyBe Finland OY                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="FZ">
                              <input name="Airline[]" id="FZ" type="checkbox" value="FZ"/>flydubai                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="XY">
                              <input name="Airline[]" id="XY" type="checkbox" value="XY"/>Flynas National Air Service                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LF">
                              <input name="Airline[]" id="LF" type="checkbox" value="LF"/>FlyNordic                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="0Y">
                              <input name="Airline[]" id="0Y" type="checkbox" value="0Y"/>FlyYeti                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="Q5">
                              <input name="Airline[]" id="Q5" type="checkbox" value="Q5"/>Forty Mile Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="FH">
                              <input name="Airline[]" id="FH" type="checkbox" value="FH"/>Freebird Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="FP">
                              <input name="Airline[]" id="FP" type="checkbox" value="FP"/>Freedom Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="F8">
                              <input name="Airline[]" id="F8" type="checkbox" value="F8"/>Freedom Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="F9">
                              <input name="Airline[]" id="F9" type="checkbox" value="F9"/>Frontier Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="2F">
                              <input name="Airline[]" id="2F" type="checkbox" value="2F"/>Frontier Flying Service                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="FU">
                              <input name="Airline[]" id="FU" type="checkbox" value="FU"/>Fuzhou Airlines Co Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="GC">
                              <input name="Airline[]" id="GC" type="checkbox" value="GC"/>Gambia International Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="GA">
                              <input name="Airline[]" id="GA" type="checkbox" value="GA"/>Garuda Indonesia                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="4G">
                              <input name="Airline[]" id="4G" type="checkbox" value="4G"/>Gazpromavia Aviation Company Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="A9">
                              <input name="Airline[]" id="A9" type="checkbox" value="A9"/>Georgian Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="GM">
                              <input name="Airline[]" id="GM" type="checkbox" value="GM"/>Germania Flug AG                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ST">
                              <input name="Airline[]" id="ST" type="checkbox" value="ST"/>Germania Fluggesellschaft MBH                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="4U">
                              <input name="Airline[]" id="4U" type="checkbox" value="4U"/>Germanwings                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="GH">
                              <input name="Airline[]" id="GH" type="checkbox" value="GH"/>Globus LLC                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="G8">
                              <input name="Airline[]" id="G8" type="checkbox" value="G8"/>Go Airlines (India) Pvt Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="Y5">
                              <input name="Airline[]" id="Y5" type="checkbox" value="Y5"/>Golden Myanmar Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="CN">
                              <input name="Airline[]" id="CN" type="checkbox" value="CN"/>Grand China Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="GV">
                              <input name="Airline[]" id="GV" type="checkbox" value="GV"/>Grant Aviation Inc                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="GB">
                              <input name="Airline[]" id="GB" type="checkbox" value="GB"/>Great Barrier Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ZK">
                              <input name="Airline[]" id="ZK" type="checkbox" value="ZK"/>Great Lakes Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ZG">
                              <input name="Airline[]" id="ZG" type="checkbox" value="ZG"/>Grozny Avia                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="GX">
                              <input name="Airline[]" id="GX" type="checkbox" value="GX"/>Guangxi Beibu Gulf Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="GF">
                              <input name="Airline[]" id="GF" type="checkbox" value="GF"/>Gulf Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="3M">
                              <input name="Airline[]" id="3M" type="checkbox" value="3M"/>Gulfstream Intl Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="H6">
                              <input name="Airline[]" id="H6" type="checkbox" value="H6"/>Hageland Aviation Services                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="HR">
                              <input name="Airline[]" id="HR" type="checkbox" value="HR"/>Hahn Air Lines GmbH                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="H1">
                              <input name="Airline[]" id="H1" type="checkbox" value="H1"/>Hahn Air Systems                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="HU">
                              <input name="Airline[]" id="HU" type="checkbox" value="HU"/>Hainan Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="HA">
                              <input name="Airline[]" id="HA" type="checkbox" value="HA"/>Hawaiian Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="BH">
                              <input name="Airline[]" id="BH" type="checkbox" value="BH"/>Hawkair Aviation Services Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="YO">
                              <input name="Airline[]" id="YO" type="checkbox" value="YO"/>Heli Air Monaco                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="JB">
                              <input name="Airline[]" id="JB" type="checkbox" value="JB"/>Helijet International Inc                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="H9">
                              <input name="Airline[]" id="H9" type="checkbox" value="H9"/>Helitt Lineas Aereas                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="2L">
                              <input name="Airline[]" id="2L" type="checkbox" value="2L"/>Helvetic Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="DU">
                              <input name="Airline[]" id="DU" type="checkbox" value="DU"/>Hemus Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="H3">
                              <input name="Airline[]" id="H3" type="checkbox" value="H3"/>Hermes Airlines S.A.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UD">
                              <input name="Airline[]" id="UD" type="checkbox" value="UD"/>Hex Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="HK">
                              <input name="Airline[]" id="HK" type="checkbox" value="HK"/>HHA Hamburg Airways Luftfverkehrsge                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="5K">
                              <input name="Airline[]" id="5K" type="checkbox" value="5K"/>Hi Fly Transportes Aereos S.A                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="HX">
                              <input name="Airline[]" id="HX" type="checkbox" value="HX"/>Hong Kong Airlines Limited                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UO">
                              <input name="Airline[]" id="UO" type="checkbox" value="UO"/>Hong Kong Express Airways Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="A5">
                              <input name="Airline[]" id="A5" type="checkbox" value="A5"/>HOP                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="YS">
                              <input name="Airline[]" id="YS" type="checkbox" value="YS"/>HOP Regional                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="QX">
                              <input name="Airline[]" id="QX" type="checkbox" value="QX"/>Horizon Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="XB">
                              <input name="Airline[]" id="XB" type="checkbox" value="XB"/>IATA BSP                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="IB">
                              <input name="Airline[]" id="IB" type="checkbox" value="IB"/>Iberia Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="FW">
                              <input name="Airline[]" id="FW" type="checkbox" value="FW"/>IBEX Airlines Co Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="X8">
                              <input name="Airline[]" id="X8" type="checkbox" value="X8"/>Icaro                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="FI">
                              <input name="Airline[]" id="FI" type="checkbox" value="FI"/>Icelandair                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="6U">
                              <input name="Airline[]" id="6U" type="checkbox" value="6U"/>ICL Express                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="4I">
                              <input name="Airline[]" id="4I" type="checkbox" value="4I"/>IHY Izmir Havayollari                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="V8">
                              <input name="Airline[]" id="V8" type="checkbox" value="V8"/>Iliamna Air Taxi Inc                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="DH">
                              <input name="Airline[]" id="DH" type="checkbox" value="DH"/>Independence Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="IC">
                              <input name="Airline[]" id="IC" type="checkbox" value="IC"/>Indian Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="I9">
                              <input name="Airline[]" id="I9" type="checkbox" value="I9"/>Indigo                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="6E">
                              <input name="Airline[]" id="6E" type="checkbox" value="6E"/>Indigo Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="XT">
                              <input name="Airline[]" id="XT" type="checkbox" value="XT"/>Indonesia AirAsia X                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="7N">
                              <input name="Airline[]" id="7N" type="checkbox" value="7N"/>Inland Aviation Services                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="7I">
                              <input name="Airline[]" id="7I" type="checkbox" value="7I"/>Insel Air International                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="8I">
                              <input name="Airline[]" id="8I" type="checkbox" value="8I"/>InselAir Aruba                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="D6">
                              <input name="Airline[]" id="D6" type="checkbox" value="D6"/>Interair South Africa                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="JY">
                              <input name="Airline[]" id="JY" type="checkbox" value="JY"/>Intercaribbean Airways Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="IO">
                              <input name="Airline[]" id="IO" type="checkbox" value="IO"/>Intercontinental Pacific Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="4O">
                              <input name="Airline[]" id="4O" type="checkbox" value="4O"/>Interjet                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="3L">
                              <input name="Airline[]" id="3L" type="checkbox" value="3L"/>InterSky Luftfahrt GmbH                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="IR">
                              <input name="Airline[]" id="IR" type="checkbox" value="IR"/>Iran Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="B9">
                              <input name="Airline[]" id="B9" type="checkbox" value="B9"/>Iran Air Tours                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="EP">
                              <input name="Airline[]" id="EP" type="checkbox" value="EP"/>Iran Assemam Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="IA">
                              <input name="Airline[]" id="IA" type="checkbox" value="IA"/>Iraqi Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="IH">
                              <input name="Airline[]" id="IH" type="checkbox" value="IH"/>Irtysh Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="WP">
                              <input name="Airline[]" id="WP" type="checkbox" value="WP"/>Island Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="2O">
                              <input name="Airline[]" id="2O" type="checkbox" value="2O"/>Island Air Service                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="IS">
                              <input name="Airline[]" id="IS" type="checkbox" value="IS"/>Island Airlines of Nantucket                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="WC">
                              <input name="Airline[]" id="WC" type="checkbox" value="WC"/>Islena de Inversiones S.A. de C.V.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="6H">
                              <input name="Airline[]" id="6H" type="checkbox" value="6H"/>Israir Airlines and Tourism Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="GI">
                              <input name="Airline[]" id="GI" type="checkbox" value="GI"/>Itek Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="J6">
                              <input name="Airline[]" id="J6" type="checkbox" value="J6"/>Jamaica Air Shuttle                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="JC">
                              <input name="Airline[]" id="JC" type="checkbox" value="JC"/>Japan Air Commuter                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="3X">
                              <input name="Airline[]" id="3X" type="checkbox" value="3X"/>Japan Air Commuter                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="JL">
                              <input name="Airline[]" id="JL" type="checkbox" value="JL"/>Japan Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="EG">
                              <input name="Airline[]" id="EG" type="checkbox" value="EG"/>Japan Asia Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="NU">
                              <input name="Airline[]" id="NU" type="checkbox" value="NU"/>Japan Transocean Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="JU">
                              <input name="Airline[]" id="JU" type="checkbox" value="JU"/>JAT Jugoslovenski Aerotransport                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="VJ">
                              <input name="Airline[]" id="VJ" type="checkbox" value="VJ"/>Jatayu Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="J9">
                              <input name="Airline[]" id="J9" type="checkbox" value="J9"/>Jazeera Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="QK">
                              <input name="Airline[]" id="QK" type="checkbox" value="QK"/>Jazz Aviation LP                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="7C">
                              <input name="Airline[]" id="7C" type="checkbox" value="7C"/>JeJu Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TB">
                              <input name="Airline[]" id="TB" type="checkbox" value="TB"/>Jet Airfly NV                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="9W">
                              <input name="Airline[]" id="9W" type="checkbox" value="9W"/>Jet Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PP">
                              <input name="Airline[]" id="PP" type="checkbox" value="PP"/>Jet Aviation Business Jets AG                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="S2">
                              <input name="Airline[]" id="S2" type="checkbox" value="S2"/>Jet Konnect                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LS">
                              <input name="Airline[]" id="LS" type="checkbox" value="LS"/>Jet2.com Limited                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="8J">
                              <input name="Airline[]" id="8J" type="checkbox" value="8J"/>Jet4You                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="B6">
                              <input name="Airline[]" id="B6" type="checkbox" value="B6"/>JetBlue Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="JQ">
                              <input name="Airline[]" id="JQ" type="checkbox" value="JQ"/>Jetstar Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="3K">
                              <input name="Airline[]" id="3K" type="checkbox" value="3K"/>Jetstar Asia Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="GK">
                              <input name="Airline[]" id="GK" type="checkbox" value="GK"/>Jetstar Japan                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="JO">
                              <input name="Airline[]" id="JO" type="checkbox" value="JO"/>JetTime                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LJ">
                              <input name="Airline[]" id="LJ" type="checkbox" value="LJ"/>Jin Air Co Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="3B">
                              <input name="Airline[]" id="3B" type="checkbox" value="3B"/>Job Air Central Connect Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="R5">
                              <input name="Airline[]" id="R5" type="checkbox" value="R5"/>Jordan Aviation                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="DW">
                              <input name="Airline[]" id="DW" type="checkbox" value="DW"/>JSC Air Company Aero Charter                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="DV">
                              <input name="Airline[]" id="DV" type="checkbox" value="DV"/>JSC Air Company SCAT                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="Y7">
                              <input name="Airline[]" id="Y7" type="checkbox" value="Y7"/>JSC Airline Taimyr                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="HZ">
                              <input name="Airline[]" id="HZ" type="checkbox" value="HZ"/>JSC Aurora Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="D9">
                              <input name="Airline[]" id="D9" type="checkbox" value="D9"/>JSC Donavia                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="5N">
                              <input name="Airline[]" id="5N" type="checkbox" value="5N"/>JSC Nordavia Regional Airline                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="7R">
                              <input name="Airline[]" id="7R" type="checkbox" value="7R"/>JSC RusLine                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="1M">
                              <input name="Airline[]" id="1M" type="checkbox" value="1M"/>JSC Transport Auto Info Systems                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="U6">
                              <input name="Airline[]" id="U6" type="checkbox" value="U6"/>JSC Ural Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="HO">
                              <input name="Airline[]" id="HO" type="checkbox" value="HO"/>Juneyao Airlines CO Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="N9">
                              <input name="Airline[]" id="N9" type="checkbox" value="N9"/>Kabo Air Limited                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="KD">
                              <input name="Airline[]" id="KD" type="checkbox" value="KD"/>KD AviaÂ                            
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="FK">
                              <input name="Airline[]" id="FK" type="checkbox" value="FK"/>Keewatin Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="M5">
                              <input name="Airline[]" id="M5" type="checkbox" value="M5"/>Kenmore Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="4K">
                              <input name="Airline[]" id="4K" type="checkbox" value="4K"/>Kenn Borek Air Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="KQ">
                              <input name="Airline[]" id="KQ" type="checkbox" value="KQ"/>Kenya Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="KT">
                              <input name="Airline[]" id="KT" type="checkbox" value="KT"/>Kharkiv Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="IT">
                              <input name="Airline[]" id="IT" type="checkbox" value="IT"/>Kingfisher Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="KL">
                              <input name="Airline[]" id="KL" type="checkbox" value="KL"/>KLM Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="WA">
                              <input name="Airline[]" id="WA" type="checkbox" value="WA"/>KLM City Hopper B.V.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="KE">
                              <input name="Airline[]" id="KE" type="checkbox" value="KE"/>Korean Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ZC">
                              <input name="Airline[]" id="ZC" type="checkbox" value="ZC"/>Korongo Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="KU">
                              <input name="Airline[]" id="KU" type="checkbox" value="KU"/>Kuwait Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="6K">
                              <input name="Airline[]" id="6K" type="checkbox" value="6K"/>Kyrgyz Trans Avia Ltd Airline                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="JF">
                              <input name="Airline[]" id="JF" type="checkbox" value="JF"/>L.A.B. Flying Service                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LT">
                              <input name="Airline[]" id="LT" type="checkbox" value="LT"/>L.T.U. International Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="B0">
                              <input name="Airline[]" id="B0" type="checkbox" value="B0"/>La Compagnie                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LB">
                              <input name="Airline[]" id="LB" type="checkbox" value="LB"/>LAB - Lloyd Aereo Boliviano                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="WJ">
                              <input name="Airline[]" id="WJ" type="checkbox" value="WJ"/>Labrador Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="L5">
                              <input name="Airline[]" id="L5" type="checkbox" value="L5"/>LAC Linea Aerea Cuencana                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TE">
                              <input name="Airline[]" id="TE" type="checkbox" value="TE"/>LAL                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TM">
                              <input name="Airline[]" id="TM" type="checkbox" value="TM"/>LAM - Linhas Aereas de Mocanbique                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="4M">
                              <input name="Airline[]" id="4M" type="checkbox" value="4M"/>Lan Argentina                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UC">
                              <input name="Airline[]" id="UC" type="checkbox" value="UC"/>Lan Chile Cargo                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="4C">
                              <input name="Airline[]" id="4C" type="checkbox" value="4C"/>LAN Colombia                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="XL">
                              <input name="Airline[]" id="XL" type="checkbox" value="XL"/>Lan Ecuador                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LP">
                              <input name="Airline[]" id="LP" type="checkbox" value="LP"/>Lan Peru                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="QV">
                              <input name="Airline[]" id="QV" type="checkbox" value="QV"/>Lao Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="QL">
                              <input name="Airline[]" id="QL" type="checkbox" value="QL"/>Laser Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LA">
                              <input name="Airline[]" id="LA" type="checkbox" value="LA"/>LATAM Airlines Group S.A                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="QJ">
                              <input name="Airline[]" id="QJ" type="checkbox" value="QJ"/>Latpass Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LI">
                              <input name="Airline[]" id="LI" type="checkbox" value="LI"/>LIAT                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LN">
                              <input name="Airline[]" id="LN" type="checkbox" value="LN"/>Libyan Arab Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="4V">
                              <input name="Airline[]" id="4V" type="checkbox" value="4V"/>Lignes Aeriennes Congolaises                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LR">
                              <input name="Airline[]" id="LR" type="checkbox" value="LR"/>Lineas Aereas Costarricenses S.A                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="P8">
                              <input name="Airline[]" id="P8" type="checkbox" value="P8"/>Linhas Aereas                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LM">
                              <input name="Airline[]" id="LM" type="checkbox" value="LM"/>Loganair                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LO">
                              <input name="Airline[]" id="LO" type="checkbox" value="LO"/>LOT Polish Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="XO">
                              <input name="Airline[]" id="XO" type="checkbox" value="XO"/>LTE International Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LT">
                              <input name="Airline[]" id="LT" type="checkbox" value="LT"/>LTU International Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="8L">
                              <input name="Airline[]" id="8L" type="checkbox" value="8L"/>Lucky Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="HE">
                              <input name="Airline[]" id="HE" type="checkbox" value="HE"/>Luftfahrt Gesellschaft                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LH">
                              <input name="Airline[]" id="LH" type="checkbox" value="LH"/>Lufthansa Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="CL">
                              <input name="Airline[]" id="CL" type="checkbox" value="CL"/>Lufthansa CityLine GmbH                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LE">
                              <input name="Airline[]" id="LE" type="checkbox" value="LE"/>Lugansk Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LG">
                              <input name="Airline[]" id="LG" type="checkbox" value="LG"/>Luxair                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="5V">
                              <input name="Airline[]" id="5V" type="checkbox" value="5V"/>Lviv Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="M8">
                              <input name="Airline[]" id="M8" type="checkbox" value="M8"/>Magnum Air Inc                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="W5">
                              <input name="Airline[]" id="W5" type="checkbox" value="W5"/>Mahan Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="M2">
                              <input name="Airline[]" id="M2" type="checkbox" value="M2"/>Mahfooz Aviation (Gambia) Ltd.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="3W">
                              <input name="Airline[]" id="3W" type="checkbox" value="3W"/>Malawian Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="MH">
                              <input name="Airline[]" id="MH" type="checkbox" value="MH"/>Malaysia Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="MA">
                              <input name="Airline[]" id="MA" type="checkbox" value="MA"/>Malev Hungarian Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="OD">
                              <input name="Airline[]" id="OD" type="checkbox" value="OD"/>Malindo Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TF">
                              <input name="Airline[]" id="TF" type="checkbox" value="TF"/>Malmo Aviation                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="RI">
                              <input name="Airline[]" id="RI" type="checkbox" value="RI"/>Mandala Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AE">
                              <input name="Airline[]" id="AE" type="checkbox" value="AE"/>Mandarin Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="JE">
                              <input name="Airline[]" id="JE" type="checkbox" value="JE"/>Mango                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="7Y">
                              <input name="Airline[]" id="7Y" type="checkbox" value="7Y"/>Mann Yadanarpon Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="MP">
                              <input name="Airline[]" id="MP" type="checkbox" value="MP"/>Martinair Holland                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="L6">
                              <input name="Airline[]" id="L6" type="checkbox" value="L6"/>Mauritania Airlines International                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="YD">
                              <input name="Airline[]" id="YD" type="checkbox" value="YD"/>Mauritania Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="MW">
                              <input name="Airline[]" id="MW" type="checkbox" value="MW"/>Maya Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="MY">
                              <input name="Airline[]" id="MY" type="checkbox" value="MY"/>Maya Island Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="7M">
                              <input name="Airline[]" id="7M" type="checkbox" value="7M"/>Mayair SA DE CV                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ME">
                              <input name="Airline[]" id="ME" type="checkbox" value="ME"/>MEA - Middle East Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="VL">
                              <input name="Airline[]" id="VL" type="checkbox" value="VL"/>Med View Airlines (NIG) Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="IG">
                              <input name="Airline[]" id="IG" type="checkbox" value="IG"/>Meridiana                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="YV">
                              <input name="Airline[]" id="YV" type="checkbox" value="YV"/>Mesa Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="XJ">
                              <input name="Airline[]" id="XJ" type="checkbox" value="XJ"/>Mesaba Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="MX">
                              <input name="Airline[]" id="MX" type="checkbox" value="MX"/>Mexicana                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="OM">
                              <input name="Airline[]" id="OM" type="checkbox" value="OM"/>MIAT - Mongolian Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ME">
                              <input name="Airline[]" id="ME" type="checkbox" value="ME"/>Middle East                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="YX">
                              <input name="Airline[]" id="YX" type="checkbox" value="YX"/>Midwest Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="MJ">
                              <input name="Airline[]" id="MJ" type="checkbox" value="MJ"/>Mihin Lanka (PVT) Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="2M">
                              <input name="Airline[]" id="2M" type="checkbox" value="2M"/>Moldavian Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ZB">
                              <input name="Airline[]" id="ZB" type="checkbox" value="ZB"/>Monarch Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="YM">
                              <input name="Airline[]" id="YM" type="checkbox" value="YM"/>Montenegro Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="M9">
                              <input name="Airline[]" id="M9" type="checkbox" value="M9"/>Motor Sich JSC                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="XV">
                              <input name="Airline[]" id="XV" type="checkbox" value="XV"/>MR Lines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="VZ">
                              <input name="Airline[]" id="VZ" type="checkbox" value="VZ"/>My TravelLite                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="8M">
                              <input name="Airline[]" id="8M" type="checkbox" value="8M"/>Myanmar Airways Intl Co Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UB">
                              <input name="Airline[]" id="UB" type="checkbox" value="UB"/>Myanmar National Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="9K">
                              <input name="Airline[]" id="9K" type="checkbox" value="9K"/>Nantucket Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UE">
                              <input name="Airline[]" id="UE" type="checkbox" value="UE"/>Nasair                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="N8">
                              <input name="Airline[]" id="N8" type="checkbox" value="N8"/>National Air Cargo Group Inc                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="XZ">
                              <input name="Airline[]" id="XZ" type="checkbox" value="XZ"/>National Air Services                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="9Y">
                              <input name="Airline[]" id="9Y" type="checkbox" value="9Y"/>National Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="5C">
                              <input name="Airline[]" id="5C" type="checkbox" value="5C"/>Nature Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ZN">
                              <input name="Airline[]" id="ZN" type="checkbox" value="ZN"/>Naysa                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="NO">
                              <input name="Airline[]" id="NO" type="checkbox" value="NO"/>Neos                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="RA">
                              <input name="Airline[]" id="RA" type="checkbox" value="RA"/>Nepal Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="EJ">
                              <input name="Airline[]" id="EJ" type="checkbox" value="EJ"/>New England Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="N7">
                              <input name="Airline[]" id="N7" type="checkbox" value="N7"/>NHT Linhas Aereas Ltda                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="6N">
                              <input name="Airline[]" id="6N" type="checkbox" value="6N"/>Niger Airlines S A                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="HG">
                              <input name="Airline[]" id="HG" type="checkbox" value="HG"/>Niki                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="NP">
                              <input name="Airline[]" id="NP" type="checkbox" value="NP"/>Nile Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="DD">
                              <input name="Airline[]" id="DD" type="checkbox" value="DD"/>Nok Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="XW">
                              <input name="Airline[]" id="XW" type="checkbox" value="XW"/>NokScoot Airlines Co Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="NA">
                              <input name="Airline[]" id="NA" type="checkbox" value="NA"/>North American Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="M3">
                              <input name="Airline[]" id="M3" type="checkbox" value="M3"/>North Flying                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="HW">
                              <input name="Airline[]" id="HW" type="checkbox" value="HW"/>North Wright Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="NS">
                              <input name="Airline[]" id="NS" type="checkbox" value="NS"/>Northeastern Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="NW">
                              <input name="Airline[]" id="NW" type="checkbox" value="NW"/>Northwest Airlines Inc.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="J3">
                              <input name="Airline[]" id="J3" type="checkbox" value="J3"/>Northwestern Air Lease Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="D8">
                              <input name="Airline[]" id="D8" type="checkbox" value="D8"/>Norwegian Air International LTD                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="DY">
                              <input name="Airline[]" id="DY" type="checkbox" value="DY"/>Norwegian Air Shuttle A.S                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="BJ">
                              <input name="Airline[]" id="BJ" type="checkbox" value="BJ"/>Nouvelair Tunisie                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="VQ">
                              <input name="Airline[]" id="VQ" type="checkbox" value="VQ"/>Novo Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="N6">
                              <input name="Airline[]" id="N6" type="checkbox" value="N6"/>Nuevo Continente S.A.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="6R">
                              <input name="Airline[]" id="6R" type="checkbox" value="6R"/>OJSC Mirny Enterprise                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="OA">
                              <input name="Airline[]" id="OA" type="checkbox" value="OA"/>Olympic Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="WY">
                              <input name="Airline[]" id="WY" type="checkbox" value="WY"/>Oman Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="J1">
                              <input name="Airline[]" id="J1" type="checkbox" value="J1"/>One Jet Inc                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="/*O">
                              <input name="Airline[]" id="/*O" type="checkbox" value="/*O"/>Oneworld                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="R2">
                              <input name="Airline[]" id="R2" type="checkbox" value="R2"/>Orenair                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="OX">
                              <input name="Airline[]" id="OX" type="checkbox" value="OX"/>Orient Thai Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="OC">
                              <input name="Airline[]" id="OC" type="checkbox" value="OC"/>Oriental Air Bridge Co Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="QO">
                              <input name="Airline[]" id="QO" type="checkbox" value="QO"/>Origin Pacific Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="XH">
                              <input name="Airline[]" id="XH" type="checkbox" value="XH"/>Other Travel                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ON">
                              <input name="Airline[]" id="ON" type="checkbox" value="ON"/>Our Airline                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="O7">
                              <input name="Airline[]" id="O7" type="checkbox" value="O7"/>OzJet Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="BL">
                              <input name="Airline[]" id="BL" type="checkbox" value="BL"/>Pacific Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="3F">
                              <input name="Airline[]" id="3F" type="checkbox" value="3F"/>Pacific Airways Inc.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="8P">
                              <input name="Airline[]" id="8P" type="checkbox" value="8P"/>Pacific Coast Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LW">
                              <input name="Airline[]" id="LW" type="checkbox" value="LW"/>Pacific Wings                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PK">
                              <input name="Airline[]" id="PK" type="checkbox" value="PK"/>Pakistan International Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="2P">
                              <input name="Airline[]" id="2P" type="checkbox" value="2P"/>PAL Express                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="4L">
                              <input name="Airline[]" id="4L" type="checkbox" value="4L"/>Palau National Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="7Q">
                              <input name="Airline[]" id="7Q" type="checkbox" value="7Q"/>Pan Am World Airways Dominicana                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PA">
                              <input name="Airline[]" id="PA" type="checkbox" value="PA"/>Pan America                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="HI">
                              <input name="Airline[]" id="HI" type="checkbox" value="HI"/>Papillon Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="I7">
                              <input name="Airline[]" id="I7" type="checkbox" value="I7"/>Paramount Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="P6">
                              <input name="Airline[]" id="P6" type="checkbox" value="P6"/>Pascan Aviation Inc                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="2Z">
                              <input name="Airline[]" id="2Z" type="checkbox" value="2Z"/>Passaredo Transportes Aeros S A                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="MM">
                              <input name="Airline[]" id="MM" type="checkbox" value="MM"/>Peach Aviation Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="KS">
                              <input name="Airline[]" id="KS" type="checkbox" value="KS"/>Penair                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UW">
                              <input name="Airline[]" id="UW" type="checkbox" value="UW"/>Perimeter Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="P9">
                              <input name="Airline[]" id="P9" type="checkbox" value="P9"/>Peruvian Airline S.A                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="9P">
                              <input name="Airline[]" id="9P" type="checkbox" value="9P"/>Petra Airline                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PR">
                              <input name="Airline[]" id="PR" type="checkbox" value="PR"/>Philippine Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="3I">
                              <input name="Airline[]" id="3I" type="checkbox" value="3I"/>Pison Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PU">
                              <input name="Airline[]" id="PU" type="checkbox" value="PU"/>Pluna                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="DP">
                              <input name="Airline[]" id="DP" type="checkbox" value="DP"/>Pobeda                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PO">
                              <input name="Airline[]" id="PO" type="checkbox" value="PO"/>Polar Air Cargo Worldwide Inc                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LO">
                              <input name="Airline[]" id="LO" type="checkbox" value="LO"/>Polish Air-Lot                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PH">
                              <input name="Airline[]" id="PH" type="checkbox" value="PH"/>Polynesian Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PD">
                              <input name="Airline[]" id="PD" type="checkbox" value="PD"/>Porter Airlines Inc                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="NI">
                              <input name="Airline[]" id="NI" type="checkbox" value="NI"/>Portugalia                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PW">
                              <input name="Airline[]" id="PW" type="checkbox" value="PW"/>Precision Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="6F">
                              <input name="Airline[]" id="6F" type="checkbox" value="6F"/>Primera Air Nordic                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PF">
                              <input name="Airline[]" id="PF" type="checkbox" value="PF"/>Primera Air Scandinavia A.S                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="8W">
                              <input name="Airline[]" id="8W" type="checkbox" value="8W"/>Private Wings Flugcharter GmbH                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="P0">
                              <input name="Airline[]" id="P0" type="checkbox" value="P0"/>Proflight Commuter Services Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PB">
                              <input name="Airline[]" id="PB" type="checkbox" value="PB"/>Provincial Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="FB">
                              <input name="Airline[]" id="FB" type="checkbox" value="FB"/>Provincial Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="QZ">
                              <input name="Airline[]" id="QZ" type="checkbox" value="QZ"/>PT Indonesia AirAsia                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SJ">
                              <input name="Airline[]" id="SJ" type="checkbox" value="SJ"/>PT Sriwijaya Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="P1">
                              <input name="Airline[]" id="P1" type="checkbox" value="P1"/>Public Charters                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="EB">
                              <input name="Airline[]" id="EB" type="checkbox" value="EB"/>Pullmantur Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="QF">
                              <input name="Airline[]" id="QF" type="checkbox" value="QF"/>Qantas Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="QR">
                              <input name="Airline[]" id="QR" type="checkbox" value="QR"/>Qatar Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="QW">
                              <input name="Airline[]" id="QW" type="checkbox" value="QW"/>Qingdao Airline Co LTd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="QG">
                              <input name="Airline[]" id="QG" type="checkbox" value="QG"/>Qualiflyer Group                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="Q0">
                              <input name="Airline[]" id="Q0" type="checkbox" value="Q0"/>Quebecair Express                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="XA">
                              <input name="Airline[]" id="XA" type="checkbox" value="XA"/>Railroad                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="RW">
                              <input name="Airline[]" id="RW" type="checkbox" value="RW"/>RAS Fluggesellschaft                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="RM">
                              <input name="Airline[]" id="RM" type="checkbox" value="RM"/>Regional Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="FN">
                              <input name="Airline[]" id="FN" type="checkbox" value="FN"/>Regional Air Lines (Morocco)                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="8N">
                              <input name="Airline[]" id="8N" type="checkbox" value="8N"/>Regional Air Services                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ZL">
                              <input name="Airline[]" id="ZL" type="checkbox" value="ZL"/>Regional Express Pty Limited                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="FV">
                              <input name="Airline[]" id="FV" type="checkbox" value="FV"/>Rossiya Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="RR">
                              <input name="Airline[]" id="RR" type="checkbox" value="RR"/>Royal Air Force                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AT">
                              <input name="Airline[]" id="AT" type="checkbox" value="AT"/>Royal Air Maroc                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="QN">
                              <input name="Airline[]" id="QN" type="checkbox" value="QN"/>Royal Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="4A">
                              <input name="Airline[]" id="4A" type="checkbox" value="4A"/>Royal Bengal Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="BI">
                              <input name="Airline[]" id="BI" type="checkbox" value="BI"/>Royal Brunei Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="RL">
                              <input name="Airline[]" id="RL" type="checkbox" value="RL"/>Royal Falcon                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="RJ">
                              <input name="Airline[]" id="RJ" type="checkbox" value="RJ"/>Royal Jordanian                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="RY">
                              <input name="Airline[]" id="RY" type="checkbox" value="RY"/>Royal Wings                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="DR">
                              <input name="Airline[]" id="DR" type="checkbox" value="DR"/>Ruili Airlines Co Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="5R">
                              <input name="Airline[]" id="5R" type="checkbox" value="5R"/>Rutaca                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="RD">
                              <input name="Airline[]" id="RD" type="checkbox" value="RD"/>Ryan International Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="FR">
                              <input name="Airline[]" id="FR" type="checkbox" value="FR"/>Ryanair                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="S7">
                              <input name="Airline[]" id="S7" type="checkbox" value="S7"/>S7                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="E3">
                              <input name="Airline[]" id="E3" type="checkbox" value="E3"/>Sabaidee Airways Co Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SN">
                              <input name="Airline[]" id="SN" type="checkbox" value="SN"/>Sabena Belgian World Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="4Q">
                              <input name="Airline[]" id="4Q" type="checkbox" value="4Q"/>Safi Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PV">
                              <input name="Airline[]" id="PV" type="checkbox" value="PV"/>Saint Barth Commuter                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="JI">
                              <input name="Airline[]" id="JI" type="checkbox" value="JI"/>San Juan Aviation                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="RZ">
                              <input name="Airline[]" id="RZ" type="checkbox" value="RZ"/>Sansa Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="S3">
                              <input name="Airline[]" id="S3" type="checkbox" value="S3"/>Santa Barbara Airlines C.A.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SP">
                              <input name="Airline[]" id="SP" type="checkbox" value="SP"/>SATA Air Acores                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="S4">
                              <input name="Airline[]" id="S4" type="checkbox" value="S4"/>SATA International                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="9N">
                              <input name="Airline[]" id="9N" type="checkbox" value="9N"/>Satena                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SV">
                              <input name="Airline[]" id="SV" type="checkbox" value="SV"/>Saudi Arabian Airline                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SK">
                              <input name="Airline[]" id="SK" type="checkbox" value="SK"/>Scandinavian Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="YR">
                              <input name="Airline[]" id="YR" type="checkbox" value="YR"/>Scenic Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="CB">
                              <input name="Airline[]" id="CB" type="checkbox" value="CB"/>ScotAirways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="I4">
                              <input name="Airline[]" id="I4" type="checkbox" value="I4"/>Scott Air LLC                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="BB">
                              <input name="Airline[]" id="BB" type="checkbox" value="BB"/>Seaborne Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="DN">
                              <input name="Airline[]" id="DN" type="checkbox" value="DN"/>Senegal Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="8D">
                              <input name="Airline[]" id="8D" type="checkbox" value="8D"/>Servant Air Inc                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="5S">
                              <input name="Airline[]" id="5S" type="checkbox" value="5S"/>Servicios Aereos Profesionales                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="D2">
                              <input name="Airline[]" id="D2" type="checkbox" value="D2"/>Severstal Aircompany Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="NL">
                              <input name="Airline[]" id="NL" type="checkbox" value="NL"/>Shaheen Air International                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SC">
                              <input name="Airline[]" id="SC" type="checkbox" value="SC"/>Shandong Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="FM">
                              <input name="Airline[]" id="FM" type="checkbox" value="FM"/>Shanghai Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SH">
                              <input name="Airline[]" id="SH" type="checkbox" value="SH"/>Sharp Aviation Pty. Ltd. t/a Sharp                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ZH">
                              <input name="Airline[]" id="ZH" type="checkbox" value="ZH"/>Shenzhen Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="S5">
                              <input name="Airline[]" id="S5" type="checkbox" value="S5"/>Shuttle America                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="O8">
                              <input name="Airline[]" id="O8" type="checkbox" value="O8"/>Siam Air Transport Company Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="3U">
                              <input name="Airline[]" id="3U" type="checkbox" value="3U"/>Sichuan Airlines Co Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="FT">
                              <input name="Airline[]" id="FT" type="checkbox" value="FT"/>Siem Reap Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="MI">
                              <input name="Airline[]" id="MI" type="checkbox" value="MI"/>Silk Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ZP">
                              <input name="Airline[]" id="ZP" type="checkbox" value="ZP"/>Silk Way Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="7L">
                              <input name="Airline[]" id="7L" type="checkbox" value="7L"/>Silk Way West Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SQ">
                              <input name="Airline[]" id="SQ" type="checkbox" value="SQ"/>Singapore Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="H2">
                              <input name="Airline[]" id="H2" type="checkbox" value="H2"/>Sky Airline S.A.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ZY">
                              <input name="Airline[]" id="ZY" type="checkbox" value="ZY"/>Sky Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="GY">
                              <input name="Airline[]" id="GY" type="checkbox" value="GY"/>Sky Bishek                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="GW">
                              <input name="Airline[]" id="GW" type="checkbox" value="GW"/>SkyGreece Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="RU">
                              <input name="Airline[]" id="RU" type="checkbox" value="RU"/>SkyKing Turks and Caicos Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="GG">
                              <input name="Airline[]" id="GG" type="checkbox" value="GG"/>Skylease                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="/*S">
                              <input name="Airline[]" id="/*S" type="checkbox" value="/*S"/>SkyTeam Alliance                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AL">
                              <input name="Airline[]" id="AL" type="checkbox" value="AL"/>Skyway Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="JZ">
                              <input name="Airline[]" id="JZ" type="checkbox" value="JZ"/>Skyways AB                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="OO">
                              <input name="Airline[]" id="OO" type="checkbox" value="OO"/>Skywest Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ZA">
                              <input name="Airline[]" id="ZA" type="checkbox" value="ZA"/>Skywings Asia Airlines Co                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SX">
                              <input name="Airline[]" id="SX" type="checkbox" value="SX"/>Skywork Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="S0">
                              <input name="Airline[]" id="S0" type="checkbox" value="S0"/>Slok Air International                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="6Y">
                              <input name="Airline[]" id="6Y" type="checkbox" value="6Y"/>SmartLynx Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="QS">
                              <input name="Airline[]" id="QS" type="checkbox" value="QS"/>Smartwings Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="2E">
                              <input name="Airline[]" id="2E" type="checkbox" value="2E"/>Smokey Bay Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="2C">
                              <input name="Airline[]" id="2C" type="checkbox" value="2C"/>SNCF                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="6J">
                              <input name="Airline[]" id="6J" type="checkbox" value="6J"/>Solaseed                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="IE">
                              <input name="Airline[]" id="IE" type="checkbox" value="IE"/>Solomon Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="S8">
                              <input name="Airline[]" id="S8" type="checkbox" value="S8"/>Sounds Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SA">
                              <input name="Airline[]" id="SA" type="checkbox" value="SA"/>South African Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="YB">
                              <input name="Airline[]" id="YB" type="checkbox" value="YB"/>South African Express                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="YG">
                              <input name="Airline[]" id="YG" type="checkbox" value="YG"/>South Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="DG">
                              <input name="Airline[]" id="DG" type="checkbox" value="DG"/>South East Asian Airlines (SEAIR)                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PL">
                              <input name="Airline[]" id="PL" type="checkbox" value="PL"/>Southern Air Charter                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="9X">
                              <input name="Airline[]" id="9X" type="checkbox" value="9X"/>Southern Airways Express                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="WN">
                              <input name="Airline[]" id="WN" type="checkbox" value="WN"/>Southwest Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="JK">
                              <input name="Airline[]" id="JK" type="checkbox" value="JK"/>Spanair                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="5W">
                              <input name="Airline[]" id="5W" type="checkbox" value="5W"/>Speed Alliance                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SG">
                              <input name="Airline[]" id="SG" type="checkbox" value="SG"/>SpiceJet Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="NK">
                              <input name="Airline[]" id="NK" type="checkbox" value="NK"/>Spirit Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="IJ">
                              <input name="Airline[]" id="IJ" type="checkbox" value="IJ"/>Spring Airlines Japan                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="9C">
                              <input name="Airline[]" id="9C" type="checkbox" value="9C"/>Spring Airlines Limited Corportion                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UL">
                              <input name="Airline[]" id="UL" type="checkbox" value="UL"/>SriLankan                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="T8">
                              <input name="Airline[]" id="T8" type="checkbox" value="T8"/>STA Trans African Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="/*A">
                              <input name="Airline[]" id="/*A" type="checkbox" value="/*A"/>Star Alliance                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="2S">
                              <input name="Airline[]" id="2S" type="checkbox" value="2S"/>Star Equatorial Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="2I">
                              <input name="Airline[]" id="2I" type="checkbox" value="2I"/>Star Peru                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="Q4">
                              <input name="Airline[]" id="Q4" type="checkbox" value="Q4"/>Starlink Aviation                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="NB">
                              <input name="Airline[]" id="NB" type="checkbox" value="NB"/>Sterling Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="DM">
                              <input name="Airline[]" id="DM" type="checkbox" value="DM"/>Sterling Blue                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="8F">
                              <input name="Airline[]" id="8F" type="checkbox" value="8F"/>STP Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SD">
                              <input name="Airline[]" id="SD" type="checkbox" value="SD"/>Sudan Airways Co Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="EZ">
                              <input name="Airline[]" id="EZ" type="checkbox" value="EZ"/>Sun - Air of Scandinavia                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="6G">
                              <input name="Airline[]" id="6G" type="checkbox" value="6G"/>Sun Air Express                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SY">
                              <input name="Airline[]" id="SY" type="checkbox" value="SY"/>Sun Country Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="XQ">
                              <input name="Airline[]" id="XQ" type="checkbox" value="XQ"/>Sun Express                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="XG">
                              <input name="Airline[]" id="XG" type="checkbox" value="XG"/>SunExpress Deutschland                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="S6">
                              <input name="Airline[]" id="S6" type="checkbox" value="S6"/>Sunrise Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="YH">
                              <input name="Airline[]" id="YH" type="checkbox" value="YH"/>Sunsplash Aviation LLC                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="WG">
                              <input name="Airline[]" id="WG" type="checkbox" value="WG"/>Sunwing Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PY">
                              <input name="Airline[]" id="PY" type="checkbox" value="PY"/>Surinam Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="HS">
                              <input name="Airline[]" id="HS" type="checkbox" value="HS"/>Svenska Direktflyg AB                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LX">
                              <input name="Airline[]" id="LX" type="checkbox" value="LX"/>SWISS                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SR">
                              <input name="Airline[]" id="SR" type="checkbox" value="SR"/>Swissair                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="7E">
                              <input name="Airline[]" id="7E" type="checkbox" value="7E"/>Sylt Air GmbH                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="FS">
                              <input name="Airline[]" id="FS" type="checkbox" value="FS"/>Syphax Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="RB">
                              <input name="Airline[]" id="RB" type="checkbox" value="RB"/>Syrian Arab Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TW">
                              <input name="Airline[]" id="TW" type="checkbox" value="TW"/>T Way Air Co                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="DT">
                              <input name="Airline[]" id="DT" type="checkbox" value="DT"/>TAAG Linhas Aereas de Angola                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="HH">
                              <input name="Airline[]" id="HH" type="checkbox" value="HH"/>Taban Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TA">
                              <input name="Airline[]" id="TA" type="checkbox" value="TA"/>Taca International Airlines S.A                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="7J">
                              <input name="Airline[]" id="7J" type="checkbox" value="7J"/>Tajik Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PZ">
                              <input name="Airline[]" id="PZ" type="checkbox" value="PZ"/>TAM                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="JJ">
                              <input name="Airline[]" id="JJ" type="checkbox" value="JJ"/>TAM Linhas Aereas                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="EQ">
                              <input name="Airline[]" id="EQ" type="checkbox" value="EQ"/>TAME                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="4E">
                              <input name="Airline[]" id="4E" type="checkbox" value="4E"/>Tanana Air Service                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TQ">
                              <input name="Airline[]" id="TQ" type="checkbox" value="TQ"/>Tandem Aero Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TP">
                              <input name="Airline[]" id="TP" type="checkbox" value="TP"/>TAP - Air Portugal                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="K3">
                              <input name="Airline[]" id="K3" type="checkbox" value="K3"/>Taquan Air Service                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="RO">
                              <input name="Airline[]" id="RO" type="checkbox" value="RO"/>TAROM                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SF">
                              <input name="Airline[]" id="SF" type="checkbox" value="SF"/>Tassili Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UK">
                              <input name="Airline[]" id="UK" type="checkbox" value="UK"/>Tata Sia Airlines Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ZZ">
                              <input name="Airline[]" id="ZZ" type="checkbox" value="ZZ"/>TEST                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="T2">
                              <input name="Airline[]" id="T2" type="checkbox" value="T2"/>Thai Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="FD">
                              <input name="Airline[]" id="FD" type="checkbox" value="FD"/>Thai AirAsia CO Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TG">
                              <input name="Airline[]" id="TG" type="checkbox" value="TG"/>Thai Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SL">
                              <input name="Airline[]" id="SL" type="checkbox" value="SL"/>Thai Lion Mentari                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="WE">
                              <input name="Airline[]" id="WE" type="checkbox" value="WE"/>Thai Smile Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="HQ">
                              <input name="Airline[]" id="HQ" type="checkbox" value="HQ"/>Thomas Cook Airlines Belgium                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="MT">
                              <input name="Airline[]" id="MT" type="checkbox" value="MT"/>Thomas Cook Airlines Limited                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="GS">
                              <input name="Airline[]" id="GS" type="checkbox" value="GS"/>Tianjin Airlines Co Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="3P">
                              <input name="Airline[]" id="3P" type="checkbox" value="3P"/>Tiara Air N.V. dba Tiara Air Aruba                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TT">
                              <input name="Airline[]" id="TT" type="checkbox" value="TT"/>Tigerair Australia                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TR">
                              <input name="Airline[]" id="TR" type="checkbox" value="TR"/>Tigerair Singapore                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TL">
                              <input name="Airline[]" id="TL" type="checkbox" value="TL"/>TMA cargo                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="9D">
                              <input name="Airline[]" id="9D" type="checkbox" value="9D"/>Toumai Air Tchad                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="C3">
                              <input name="Airline[]" id="C3" type="checkbox" value="C3"/>Trade Air Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TJ">
                              <input name="Airline[]" id="TJ" type="checkbox" value="TJ"/>Tradewind Aviation                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="N4">
                              <input name="Airline[]" id="N4" type="checkbox" value="N4"/>Trans Air Benin                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="Q8">
                              <input name="Airline[]" id="Q8" type="checkbox" value="Q8"/>Trans Air Congo (TAC)                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="GE">
                              <input name="Airline[]" id="GE" type="checkbox" value="GE"/>Trans Asian Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="T9">
                              <input name="Airline[]" id="T9" type="checkbox" value="T9"/>Trans Meridian Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="AX">
                              <input name="Airline[]" id="AX" type="checkbox" value="AX"/>Trans States Airlines Inc                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UN">
                              <input name="Airline[]" id="UN" type="checkbox" value="UN"/>Transaero Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="HV">
                              <input name="Airline[]" id="HV" type="checkbox" value="HV"/>Transavia Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="LU">
                              <input name="Airline[]" id="LU" type="checkbox" value="LU"/>Transporte Aereo S.A                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="5U">
                              <input name="Airline[]" id="5U" type="checkbox" value="5U"/>Transportes Aereo Guatemaltecos                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="VW">
                              <input name="Airline[]" id="VW" type="checkbox" value="VW"/>Transportes Aeromar S.A. de C.V.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="6D">
                              <input name="Airline[]" id="6D" type="checkbox" value="6D"/>Travel Service Slovakia                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="9T">
                              <input name="Airline[]" id="9T" type="checkbox" value="9T"/>Travelspan                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TO">
                              <input name="Airline[]" id="TO" type="checkbox" value="TO"/>Travsavia France                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PM">
                              <input name="Airline[]" id="PM" type="checkbox" value="PM"/>Tropic Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="OR">
                              <input name="Airline[]" id="OR" type="checkbox" value="OR"/>Tui Airlines Nederland                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="X3">
                              <input name="Airline[]" id="X3" type="checkbox" value="X3"/>TUIfly GmbH                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="R4">
                              <input name="Airline[]" id="R4" type="checkbox" value="R4"/>Tulpar Avia Service                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TU">
                              <input name="Airline[]" id="TU" type="checkbox" value="TU"/>Tunis Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UG">
                              <input name="Airline[]" id="UG" type="checkbox" value="UG"/>Tunisair Express                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="TK">
                              <input name="Airline[]" id="TK" type="checkbox" value="TK"/>Turkish Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="T5">
                              <input name="Airline[]" id="T5" type="checkbox" value="T5"/>Turkmenistan Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="T7">
                              <input name="Airline[]" id="T7" type="checkbox" value="T7"/>Twin Jet                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="OS">
                              <input name="Airline[]" id="OS" type="checkbox" value="OS"/>Tyrolean Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PS">
                              <input name="Airline[]" id="PS" type="checkbox" value="PS"/>Ukraine Intl Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UF">
                              <input name="Airline[]" id="UF" type="checkbox" value="UF"/>Ukrainian Mediterranean Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="B7">
                              <input name="Airline[]" id="B7" type="checkbox" value="B7"/>Uni Airways Corporation                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="8X">
                              <input name="Airline[]" id="8X" type="checkbox" value="8X"/>United (Passive)                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UA">
                              <input name="Airline[]" id="UA" type="checkbox" value="UA"/>United Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="4H">
                              <input name="Airline[]" id="4H" type="checkbox" value="4H"/>United Airways Bangladesh                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="3Y">
                              <input name="Airline[]" id="3Y" type="checkbox" value="3Y"/>Uniways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UQ">
                              <input name="Airline[]" id="UQ" type="checkbox" value="UQ"/>Urumqi Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="US">
                              <input name="Airline[]" id="US" type="checkbox" value="US"/>US Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="U7">
                              <input name="Airline[]" id="U7" type="checkbox" value="U7"/>USA Jet Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UT">
                              <input name="Airline[]" id="UT" type="checkbox" value="UT"/>UTAir Aviation JSC                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="UR">
                              <input name="Airline[]" id="UR" type="checkbox" value="UR"/>Utair Express                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="QU">
                              <input name="Airline[]" id="QU" type="checkbox" value="QU"/>Utair Ukraine Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="HY">
                              <input name="Airline[]" id="HY" type="checkbox" value="HY"/>Uzbekistan Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="VF">
                              <input name="Airline[]" id="VF" type="checkbox" value="VF"/>Valuair LTD                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="JW">
                              <input name="Airline[]" id="JW" type="checkbox" value="JW"/>Vanilla Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="RG">
                              <input name="Airline[]" id="RG" type="checkbox" value="RG"/>Varig                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="VR">
                              <input name="Airline[]" id="VR" type="checkbox" value="VR"/>Verde Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="2R">
                              <input name="Airline[]" id="2R" type="checkbox" value="2R"/>Via Rail Canada                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="VC">
                              <input name="Airline[]" id="VC" type="checkbox" value="VC"/>ViaAir                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="VN">
                              <input name="Airline[]" id="VN" type="checkbox" value="VN"/>Vietnam Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="4P">
                              <input name="Airline[]" id="4P" type="checkbox" value="4P"/>Viking Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="NN">
                              <input name="Airline[]" id="NN" type="checkbox" value="NN"/>VIM Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="V6">
                              <input name="Airline[]" id="V6" type="checkbox" value="V6"/>VIP S.A                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="VX">
                              <input name="Airline[]" id="VX" type="checkbox" value="VX"/>Virgin Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="VS">
                              <input name="Airline[]" id="VS" type="checkbox" value="VS"/>Virgin Atlantic Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="VA">
                              <input name="Airline[]" id="VA" type="checkbox" value="VA"/>Virgin Australia International                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="V2">
                              <input name="Airline[]" id="V2" type="checkbox" value="V2"/>Vision Airlines INC                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="VG">
                              <input name="Airline[]" id="VG" type="checkbox" value="VG"/>VLM Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="VI">
                              <input name="Airline[]" id="VI" type="checkbox" value="VI"/>Volga-Dnepr Airline Joint Stock                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="G3">
                              <input name="Airline[]" id="G3" type="checkbox" value="G3"/>VRG Linhas Aereas S.A.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="VY">
                              <input name="Airline[]" id="VY" type="checkbox" value="VY"/>Vueling Airlines S.A.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="4W">
                              <input name="Airline[]" id="4W" type="checkbox" value="4W"/>Warbelows Air Ventures                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="WT">
                              <input name="Airline[]" id="WT" type="checkbox" value="WT"/>Wasaya Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="PT">
                              <input name="Airline[]" id="PT" type="checkbox" value="PT"/>West Air Sweden                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="WH">
                              <input name="Airline[]" id="WH" type="checkbox" value="WH"/>Westair Benin                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="WS">
                              <input name="Airline[]" id="WS" type="checkbox" value="WS"/>WestJet Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="WI">
                              <input name="Airline[]" id="WI" type="checkbox" value="WI"/>White Airways S.A.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="WF">
                              <input name="Airline[]" id="WF" type="checkbox" value="WF"/>Wideroes Flyveselskap A.S                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="7W">
                              <input name="Airline[]" id="7W" type="checkbox" value="7W"/>Wind Rose Aviation Company                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="WM">
                              <input name="Airline[]" id="WM" type="checkbox" value="WM"/>Windward Island Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="IW">
                              <input name="Airline[]" id="IW" type="checkbox" value="IW"/>Wings Air                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="K5">
                              <input name="Airline[]" id="K5" type="checkbox" value="K5"/>Wings of Alaska                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="8Z">
                              <input name="Airline[]" id="8Z" type="checkbox" value="8Z"/>Wizz Air Bulgaria                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="W6">
                              <input name="Airline[]" id="W6" type="checkbox" value="W6"/>Wizz Air Hungary                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="WU">
                              <input name="Airline[]" id="WU" type="checkbox" value="WU"/>Wizz Air Ukraine                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="WO">
                              <input name="Airline[]" id="WO" type="checkbox" value="WO"/>World Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="WW">
                              <input name="Airline[]" id="WW" type="checkbox" value="WW"/>Wow Air EHF                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="8V">
                              <input name="Airline[]" id="8V" type="checkbox" value="8V"/>Wright Air Service Inc.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="2X">
                              <input name="Airline[]" id="2X" type="checkbox" value="2X"/>Xerox                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="MF">
                              <input name="Airline[]" id="MF" type="checkbox" value="MF"/>Xiamen Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="SE">
                              <input name="Airline[]" id="SE" type="checkbox" value="SE"/>XL Airways France                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="XP">
                              <input name="Airline[]" id="XP" type="checkbox" value="XP"/>Xtra Airways                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="R3">
                              <input name="Airline[]" id="R3" type="checkbox" value="R3"/>Yakutia JSC Aircompany                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="YC">
                              <input name="Airline[]" id="YC" type="checkbox" value="YC"/>Yamal Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="YE">
                              <input name="Airline[]" id="YE" type="checkbox" value="YE"/>YanAir                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="Y8">
                              <input name="Airline[]" id="Y8" type="checkbox" value="Y8"/>Yangtze River Express Airlines Co                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="Y0">
                              <input name="Airline[]" id="Y0" type="checkbox" value="Y0"/>Yellow Air Taxi                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="IY">
                              <input name="Airline[]" id="IY" type="checkbox" value="IY"/>Yemenia                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="YT">
                              <input name="Airline[]" id="YT" type="checkbox" value="YT"/>Yeti Airlines Domestic Pvt Ltd                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="4Y">
                              <input name="Airline[]" id="4Y" type="checkbox" value="4Y"/>Yute Air Alaska Inc.                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="Z4">
                              <input name="Airline[]" id="Z4" type="checkbox" value="Z4"/>ZagrosJet                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="ZJ">
                              <input name="Airline[]" id="ZJ" type="checkbox" value="ZJ"/>Zambezi Airlines                           
                            </li>
                                                      <li class="col-xs-6 nopadd">
                            <label for="Z2">
                              <input name="Airline[]" id="Z2" type="checkbox" value="Z2"/>Zest Airways Inc                           
                            </li>
                                                      </ul>
                        </div>
                      </div>
                    </div>
                  </div>                
                  <div class="button_search">
                    <button id='flight_submit_button' name='flight_submit' type="submit" class="btn btn-primary" > Search</button>                    
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
         <div class="col-md-3">
  <div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#topflightdeals" aria-controls="home" role="tab" data-toggle="tab">Top Flight Deals</a></li>
      <li role="presentation"><a href="#hoteloffers" aria-controls="profile" role="tab" data-toggle="tab">Hotel Offers</a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="topflightdeals">
        <div class="row tabcarousel_container">
          <div class="carousel_rightindex">           
            <div id="myCarousel" class="carousel slide Promo-Slider">
              <div class="carousel-inner carouselleft_images">
                <div class="nopost-tabcontent">Not Posted</div>                    </div>
                  </div><!-- End Carousel --> 
                </div><!-- End Well -->
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="hoteloffers">
              <div class="row tabcarousel_container">
                <div class="carousel_rightindex">           
                  <div id="myCarousel2" class="carousel slide Promo-Slider">
                    <div class="carousel-inner carouselleft_images">
                      <div class="nopost-tabcontent">Not Posted</div>               
                            </div><!-- End Carousel --> 
                          </div><!-- End Well -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>      </div>
    </div>
  </div>
  
  <style type="text/css">
  #DealsModal .modal-content{height: auto;}
  </style>
  <ul class="normal-list socialicons_stickey">
    <li>
    <a title="Twitter" href="https://twitter.com">
      <i class="fa fa-twitter"></i>
    </a>
  </li>
    <li>
    <a title="Facebook" href="https://www.facebook.com/">
      <i class="fa fa-facebook"></i>
    </a>
  </li>
    <li>
    <a title="Pinintrest" href="https://twitter.com/p">
      <i class="fa fa-pinterest-p"></i>
    </a>
  </li>
    <li>
    <a title="Thumpler" href="https://twitter.com/t">
      <i class="fa fa-tumblr"></i>
    </a>
  </li>
  </ul>
<div id="fadeandscale" class="wellme modal-lg" style="display:none;">
  <div id="loginLdr" class="lodrefrentrev imgLoader"  style="display:none;">
    <div class="centerload"></div>
  </div>
  <div class="popuperror" style="display:none;"></div>
  <div class="signdiv">
    <div class="insigndiv">
      <div class="leftpul">
        <a href='javascript:void(0);' onclick="window.open('http://rf.tekhne.nl/auth/login/Facebook/login', '_blank', 'width=600,height=600,scrollbars=yes,status=yes,resizable=yes,screenx='+((parseInt(screen.width) - 600)/2)+',screeny='+((parseInt(screen.height) - 600)/2)+'');" class="logspecify facecolor col-sm-4">
          <div class="mensionsoc"><span class="fa fa-facebook fa-lg fa-fw color-white"></span>Login With Facebook</div></a><a href='javascript:void(0);' onclick="window.open('http://rf.tekhne.nl/auth/login/Twitter/login', '_blank', 'width=600,height=600,scrollbars=yes,status=yes,resizable=yes,screenx='+((parseInt(screen.width) - 600)/2)+',screeny='+((parseInt(screen.height) - 600)/2)+'');" class="logspecify tweetcolor col-sm-4">
          <div class="mensionsoc"><span class="fa fa-twitter fa-lg fa-fw color-white"></span>Login With Twitter</div></a><a href='javascript:void(0);' onclick="window.open('http://rf.tekhne.nl/auth/login/Google/login', '_blank', 'width=600,height=600,scrollbars=yes,status=yes,resizable=yes,screenx='+((parseInt(screen.width) - 600)/2)+',screeny='+((parseInt(screen.height) - 600)/2)+'');" class="logspecify gpluses col-sm-4"> <div class="mensionsoc"><span class="fa fa-google-plus fa-lg fa-fw color-white"></span>Login With Google</div></a>      </div>
      <div class="centerpul">
        <div class="orbar">
          <strong>Or</strong>
        </div>
      </div>
      <form id="login" name="login" action="http://rf.tekhne.nl/account/login">
        <div class="ritpul"> 
          <div class="rowput col-sm-4">
            <input class="form-control logpadding" type="email" name="email" placeholder="Your Email" required />
          </div>
          <div class="rowput col-sm-4">
            <input class="form-control logpadding" type="password" name="password" id="pswd" placeholder="Password" required />
            <div class="errMsg"></div>
          </div>
          <div class="misclog">
            <a class="fadeandscale_close fadeandscaleforget_open forgota" id="forgtpsw">Forgot Password ?</a>
          </div>
          <div class="clear"></div>
          <div class="col-sm-12">
            <button class="submitlogin">LogIn</button>
          </div>
          <div class="clear"></div>
          <div class="dntacnt col-sm-12">Don't have an account?            <a class="fadeandscale_close fadeandscalereg_open">Sign Up</a> 
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div id="fadeandscaleforget" class="wellme modal-lg" style="display:none;">
  <div class="popuperror" style="display:none;"></div>
  <div  class="pophed">
    Reset Password  </div>
  <div class="signdiv">
    <div class="formcontnt">Enter the email address associated with your account, and we'll email you a link to reset your password.</div>
    <form id="forgetpwd" name="forgetpwd" action="http://rf.tekhne.nl/account/forgetpwd">
      <div class="ritpul"> 
        <div class="rowput col-sm-6 nopadd">
          <input class="form-control logpadding" type="email" name="email" placeholder="Your Email" required>
        </div>
        <div class="clear"></div>
        <div class="col-sm-4">
          <button class="submitlogin">Send Reset Link</button>
        </div>
        <div class="col-xs-12">
          <div class="dntacnt">
            <!-- Suddenly remeber password ? -->
            <a class="fadeandscaleforget_close fadeandscale_open">Sign In</a>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<div id="fadeandscalereg" class="wellme modal-lg" style="display:none;">
  <div id="loginLdrReg" class="lodrefrentrev imgLoader"  style="display:none;">
    <div class="centerload"></div>
  </div>     
  <div class="popuperror" style="display:none;"></div>
  <div class="signdiv">
    <div class="insigndiv">
      <div class="clear">
      </div>
      <div class="leftpul">
        <a href='javascript:void(0);' onclick="window.open('http://rf.tekhne.nl/auth/login/Facebook/up', '_blank', 'width=600,height=600,scrollbars=yes,status=yes,resizable=yes,screenx='+((parseInt(screen.width) - 600)/2)+',screeny='+((parseInt(screen.height) - 600)/2)+'');" class="logspecify facecolor col-xs-4"><span class="icon icon-facebook"></span>
          <div class="mensionsoc">Sign Up With Facebook</div></a><a href='javascript:void(0);' onclick="window.open('http://rf.tekhne.nl/auth/login/Twitter/up', '_blank', 'width=600,height=600,scrollbars=yes,status=yes,resizable=yes,screenx='+((parseInt(screen.width) - 600)/2)+',screeny='+((parseInt(screen.height) - 600)/2)+'');" class="logspecify tweetcolor col-xs-4"><span class="icon icon-twitter"></span>
          <div class="mensionsoc">Sign Up With Twitter</div></a><a href='javascript:void(0);' onclick="window.open('http://rf.tekhne.nl/auth/login/Google/up', '_blank', 'width=600,height=600,scrollbars=yes,status=yes,resizable=yes,screenx='+((parseInt(screen.width) - 600)/2)+',screeny='+((parseInt(screen.height) - 600)/2)+'');" class="logspecify gpluses col-xs-4"><span class="icon icon-google-plus"></span> <div class="mensionsoc">Sign Up With Google</div></a>      </div>
      <div class="centerpul">
        <div class="orbar">
          <strong>Or</strong>
        </div>
      </div>
      <a class="logspecify mymail">
        <span class="icon icon-envelope"></span>
        <div class="mensionsoc">Sign Up With Email</div>
      </a>
      <form id="registration" name="registration" action="http://rf.tekhne.nl/account/create">
        <div class="signupul"> 
          <div class="rowput col-sm-4">
            <input class="form-control logpadding" type="text" name="fname" placeholder="First Name" minlength="4" required/>
          </div>
          <div class="rowput col-sm-4">
            <input class="form-control logpadding" type="text" name="lname" placeholder="Last Name" minlength="1" required/>
          </div>
          <div class="rowput col-sm-4">
            <input class="form-control logpadding" type="email" name="email" placeholder="Your Email" required/>
          </div>
          <div class="rowput col-sm-4">
            <input class="form-control logpadding" type="password" name="password" id="password" placeholder="Password" minlength="5" maxlength="50" required/>
          </div>
          <div class="rowput col-sm-4">
            <input class="form-control logpadding" type="password" name="cpassword" placeholder="Confirm Password" required/>
          </div>
          <div class="clear"></div>
          <div class="signupterms col-sm-12">By signing up, I agree to Reservation Factory's             <a target="_blank" href="http://rf.tekhne.nl/terms-of-service">
              Terms of Service            </a> 
            And 
            <a target="_blank"  href="http://rf.tekhne.nl/privacy-policy">Privacy Policy</a>
          </div>
          <div class="clear"></div>
          <input type="submit" class="submitlogin" value="Sign Up" name="Sign up"/>
        </div>
      </form>
      <div class="clear"></div>
      <div class="dntacnt float_lwidth">Already an Reservation Factory member?<a class="fadeandscalereg_close fadeandscale_open">Sign In</a> </div>
    </div>
  </div>
</div>
<!-- Modal flight deals start -->
<div class="modal fade" id="DealsModal" tabindex="-1" role="dialog" aria-labelledby="DealsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
<!-- Modal flight deals end-->
<!-- Modal hotel deals start -->
<div class="modal fade" id="DealsModalH" tabindex="-1" role="dialog" aria-labelledby="DealsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
<!-- Modal hotel deals end-->
<!-- Modal Flight-Details -->
<div class="modal fade" id="Flight-Details" tabindex="-1" role="dialog" aria-labelledby="FlightDetailsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="rf_modaltitle">Flight Details</div>
      </div>
      <div class="modal-body">        
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<!-- Flight Fare Modal -->
<div class="modal fade" id="flightFareModal" tabindex="-1" role="dialog" aria-labelledby="flightFareModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="flightFareModalLabel">Detailed Information</h4>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
<!-- Flight Fare Modal -->
<!-- Modal Hotel-Details -->
<div class="modal fade hotelmodal_design" id="Hotel-Details" tabindex="-1" role="dialog" aria-labelledby="HotelDetailsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="rf_modaltitle">Detailed Information</div>
      </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<!-- Modal Hotel-Details -->
<div class="modal fade" id="modal-123" tabindex="-1" role="dialog" aria-labelledby="modal-123" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="rf_modaltitle"> Additional details / Room Rate Rules</div>
      </div>
      <div class="modal-body hotel_rules_con">
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<!-- script to stop dropdown going bacj=k without add text in input -->
<script type='text/javascript'>
function show_offer_popup(offerdetails){
  $("#DealsModal .modal-body").html('<div class="lodrefrentrev imgLoader"><div class="centerload"></div></div>');
  $.ajax({
    url:offerdetails,
    cache:false,
    complete:function(result,status){
      $("#DealsModal .modal-body").html(result.responseText);
    }
  });
}
function show__hoffer_popup(offerdetails){
  $("#DealsModalH .modal-body").html('<div class="lodrefrentrev imgLoader"><div class="centerload"></div></div>');
  $.ajax({
    url:offerdetails,
    cache:false,
    complete:function(result,status){
      $("#DealsModalH .modal-body").html(result.responseText);
    }
  });
}

  
 


$(document).ready(function() {



  

  $(".dropdown-menu").on("click",  function(event) {


//event.preventDefault();
 event.stopPropagation();

});
  $(".dropdown-menu").on("mouseleave",  function(event) {

$('div.padd_l').removeClass('open');

});



  $('#SearchCarousel').carousel({
    interval: false
  })
  $('a[data-toggle="tab"]').on('click', function (e) {
    switch(e.currentTarget.hash){
      case '#hoteloffers':
      $('#myCarousel').carousel('pause')
      $('#myCarousel2').carousel('cycle')
      break;
      case '#topflightdeals':
      $('#myCarousel2').carousel('pause')
      $('#myCarousel').carousel('cycle')
      break;
    }
  }) 
$('.dropdown-menu li input[name="Airline[]"]' ).on( 'click', function( event ) {   
$( event.target ).blur();
$('.ff_facilitydp').addClass('open');  
});



  

   $('.dropdown-menu li input[name="Facil[]"]' ).on( 'click', function( event ) {   
  $( event.target ).blur();
 $('.facilitydp_right').addClass('open'); 

});
// addclass to advance option in click
// add just .ffd_caret to the button to toggle right and down caret
$("button.ffd_caret").click(function(){
  $(".caret").toggleClass("caretdown");
});
$("input[type='text']").on("click",function(){
  if($(this).val()!=''){
    $(this).select();
  }
}); 
});
$(function() {
 $( "#price-range" ).slider({
  range: true,
  min: 0,
  max: 3000,
  values: [ 75, 3000 ],
  step: 1,
  slide: function( event,ui){
    $('#left_price').text(CURR_ICON+ $( "#price-range" ).slider( "values", 0 ));
    $('#right_price').text(CURR_ICON+ $( "#price-range" ).slider( "values", 1 ) );
  },
  change: function( event, ui ) {
    $('#MinPrice').val(ui.values[ 0 ] );
    $('#MaxPrice').val(ui.values[ 1 ] );    
  }
});
 $('#left_price').text(CURR_ICON+ $( "#price-range" ).slider( "values", 0 ));
 $('#right_price').text(CURR_ICON+ $( "#price-range" ).slider( "values", 1 ) );
 $( "#departure-range" ).slider({
  range: true,
  min: 0,
  max: 1439,
  step: 1,
  values: [ 0, 1439 ],
  slide: slideDepTime,
  change: function( event, ui) {
    $('#depMinTime').val(ui.values[ 0 ] );
    $('#depMaxTime').val(ui.values[ 1 ] );
  }
}); 
 $( "#arrival-range" ).slider({
  range: true,
  min: 0,
  max: 1439,
  step: 1,
  values: [ 0, 1439 ],
  slide: slideArrTime,
  change: function( event, ui) {
    $('#arrMinTime').val( ui.values[ 0 ] );
    $('#arrMaxTime').val(ui.values[ 1 ] );
  }
}); 
 $( "#duration-range" ).slider({
  range: true,
  min: 0,
  max: 1439,
  step: 1,
  values: [ 0, 1439 ],
  slide: slideDurTime,  
  change: function( event, ui) {
    $('#MinDuration').val( ui.values[ 0 ] );
    $('#MaxDuration').val(ui.values[ 1 ] );
  }
});
 var startTime;
 var endTime;
 function slideDepTime(event, ui){
   var val0 = $("#departure-range").slider("values", 0);
   val1 = $("#departure-range").slider("values", 1);
   minutes0 = parseInt(val0 % 60, 10);
   hours0 = parseInt(val0 / 60 % 24, 10);
   minutes1 = parseInt(val1 % 60, 10);
   hours1 = parseInt(val1 / 60 % 24, 10);
   startTime = getTime(hours0, minutes0);
   endTime = getTime(hours1, minutes1);   
   $("#left_label").text(startTime );
   $("#right_label").text(endTime);
 }
 var startTime;
 var endTime;
 function slideArrTime(event, ui){
   var val0 = $("#arrival-range").slider("values", 0);
   val1 = $("#arrival-range").slider("values", 1);
   minutes0 = parseInt(val0 % 60, 10);
   hours0 = parseInt(val0 / 60 % 24, 10);
   minutes1 = parseInt(val1 % 60, 10);
   hours1 = parseInt(val1 / 60 % 24, 10);
   startTime = getTime(hours0, minutes0);
   endTime = getTime(hours1, minutes1);   
   $("#left_label2").text(startTime );
   $("#right_label2").text(endTime);
 }
 var startTime;
 var endTime;
 function slideDurTime(event, ui){
   var val0 = $("#duration-range").slider("values", 0);
   val1 = $("#duration-range").slider("values", 1);
   minutes0 = parseInt(val0 % 60, 10);
   hours0 = parseInt(val0 / 60 % 24, 10);
   minutes1 = parseInt(val1 % 60, 10);
   hours1 = parseInt(val1 / 60 % 24, 10);
   startTime = (hours0+'H');
   endTime = (hours1+'H');   
   $("#left_duration").text(startTime);
   $("#right_duration").text(endTime);
 }
 function getTime(hours, minutes) {
  var time = null;
  minutes = minutes + "";
  if (hours < 12) {
    time = "AM";
  }
  else {
    time = "PM";
  }
  if (hours == 0) {
    hours = 12;
  }
  if (hours > 12) {
    hours = hours - 12;
  }
  if (minutes.length == 1) {
    minutes = "0" + minutes;
  }
  return hours + ":" + minutes + " " + time;
}
slideDepTime();
slideArrTime();
slideDurTime();
$("#hotel_autocomplete").autocomplete({
  source: WEB_URL+"/hotel/get_hotel_city_suggestions",
      minLength: 2,//search after two characters
      autoFocus: true, // first item will automatically be focused
      select: function(event,ui){
       $(this).val( ui.item.value );
       var city_name=($(this).val()).split(",");
       $.ajax({
        type: 'POST',
        url: WEB_URL+"/hotel/get_hotel_refrence_points/"+$.trim(city_name[0]),
        data: '',
        async: true,
        cache: false,
        dataType: 'json',
        success: function(data) {
          $("select[name='Area'] option:last").after(data);
        }
      });
       $("#hotel_checkin").focus();
       return false;
     }
   }).autocomplete( "instance" )._renderItem = function( ul, item ) {
  return $( "<li></li>" )
  .append( '<a class="flex"><span class="flex-item flex-item-9 flex-align-items-center text-overflow-ellipsis">' + item.label + '<br><span class="lbl1">' + item.label_name + '</span></span><span class="flex-item flex-item-9 lbl">' + item.label_code +'</span></a>' )
  .appendTo( ul );
};
$('.fromflight').each(function(){
  $(this).autocomplete({
    source: WEB_URL+"/home/get_airports",
      minLength: 2,//search after two characters
      autoFocus: true, // first item will automatically be focused
      select: function(event,ui){
       $(this).val( ui.item.value );
       var elment=$( this ).parent().get( 0 ).tagName;

       if(elment=='LI'){
        
          $(this).closest('li').next().find('input').focus();
       }else{
      
        $(this).closest('div').next().find('input').focus();
      }
      return false;
    }
  }).autocomplete( "instance" )._renderItem = function( ul, item ) {
    return $( "<li></li>" )
    .append( '<a class="flex"><span class="flex-item flex-item-9 flex-align-items-center text-overflow-ellipsis">' + item.label + '<br><span class="lbl1">' + item.label_name + '</span></span><span class="flex-item flex-item-9 lbl">' + item.label_code +'</span></a>' )
    .appendTo( ul );
  };
});
$(".departflight").each(function(){
  $(this).autocomplete({
    source: WEB_URL+"/home/get_airports",
      minLength: 2,//search after two characters
      autoFocus: true, // first item will automatically be focused
      select: function(event,ui){
       $(this).val( ui.item.value );
        var elment=$( this ).parent().get( 0 ).tagName;

       if(elment=='LI'){
        
          $(this).closest('li').next().find('input').focus();
       }else{
        $(this).closest('div').next().find('input').focus();
      }
      return false;
    }
  }).autocomplete( "instance" )._renderItem = function( ul, item ) {
    return $( "<li></li>" )
    .append( '<a  class="flex"><span class="flex-item flex-item-9 flex-align-items-center text-overflow-ellipsis">' + item.label + '<br><span class="lbl1">' + item.label_name + '</span></span><span class="flex-item flex-item-9 lbl">' + item.label_code +'</span></a>' )
    .appendTo( ul );
  };
});
});
</script>
<script>
$('#myCarousel').carousel({
  interval:   4000
});
</script>
<script>
$(document).ready(function(){
  $('div.multicity :input').prop('disabled',true);
  $('div.multicity li select').prop('disabled',true);
  $('input.triprad').on('click', function(event){
    console.log($(this).val());
    if ($(this).val() == 'oneway'){
     $('.multicity').fadeOut(10, function(){
      $('.normal').fadeIn(100);
      $('div.multicity :input').prop('disabled',true);
      $('div.multicity li select').prop('disabled',true);
      $('#return').val('');
    });
     $('#return').prop('disabled',true);
     $('#return').prop('required',false);
     
   }else if ($(this).val() == 'circle'){
     $('.multicity').fadeOut(10, function(){
      $('.normal').fadeIn(100);
      $('div.multicity :input').prop('disabled',true);
      $('div.multicity li select').prop('disabled',true);
    });
     $('#return').prop('disabled',false);
     $('#return').prop('required',true);     
   }else if ($(this).val() == 'multicity'){
     $('.normal').fadeOut(10, function(){
      $('.multicity').fadeIn(100);
      $('div.normal button').prop('disabled',true);
      $('div.multicity :input').prop('disabled',false);
      $('div.multicity li select').prop('required',true);
      $('div.multicity li select').prop('disabled',false);
    });     
     $('#return').prop('disabled',true);
     $('#return').prop('required',false);     
   }
 });
}); 
</script>
<!-- datepicker adding to the image -->
<script type="text/javascript">
$(document).ready(function() {
  $("#multi-flight2, #multi-flight3, #multi-flight4, #multi-flight5").datepicker({
    minDate: +1,
    dateFormat: 'dd/mm/yy',
    maxDate: "+1y"
  });
  $("#multi-departure").datepicker({
    minDate: +1,
    dateFormat: 'dd/mm/yy',
    maxDate: "+1y"    
  });  
});
</script>
<script>
$val_required ="This field is required.";
$val_remote ="Please fix this field. ";
$val_email ="Please enter a valid email address.";
$val_url ="Please enter a valid URL. ";
$val_date ="Please enter a valid date.";
$val_number ="Please enter a valid number. ";
$val_digits ="Please enter only digits. ";
$val_equalTo ="Please enter the same value again. ";
$val_maxlength ="Please enter no more than {0} characters.";
$val_minlength ="Please enter at least {0} characters.";
$val_rangelength ="Please enter a value between {0} and {1} characters long.";
$val_range ="Please enter a value between {0} and {1}.";
$val_less ="Please enter a value less than or equal to {0}.";
$val_greater ="Please enter a value greater than or equal to {0}.";
$pass_not_match ="Password does not match";
</script>
<script src="http://rf.tekhne.nl/assets/js/jquery.ui.datepicker-nl.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type='text/javascript' src="http://rf.tekhne.nl/assets/js/validate/jquery.validate.js"></script>
<script type='text/javascript' src="http://rf.tekhne.nl/assets/js/validate/custom.js"></script>
<script type='text/javascript' src="http://rf.tekhne.nl/assets/js/general.js"></script>
<!-- after Login  Need-->
<script type="text/javascript" language="javascript" src="http://rf.tekhne.nl/assets/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="http://rf.tekhne.nl/assets/js/dataTables.tableTools.js"></script>
<script type='text/javascript' src="http://rf.tekhne.nl/assets/js/jquery.provabpopup.js"></script>
<script type='text/javascript' src="http://rf.tekhne.nl/assets/js/support/support.js"></script>
<script type='text/javascript' src="http://rf.tekhne.nl/assets/js/owl.carousel.js"></script>
<script type='text/javascript' src="http://rf.tekhne.nl/assets/js/proPages.min.js"></script>
<script type='text/javascript' src="http://rf.tekhne.nl/assets/js/Pagination.js"></script>
<script type='text/javascript' src="http://rf.tekhne.nl/assets/js/js-list2.js"></script>
<!--Light Box-->
<script  src="http://rf.tekhne.nl/assets/js/lightbox/lightgallery.js"></script>
<script src="http://rf.tekhne.nl/assets/js/lightbox/jquery.justifiedGallery.min.js"></script>
<script src="http://rf.tekhne.nl/assets/js/lightbox/transition.js"></script>
<script src="http://rf.tekhne.nl/assets/js/lightbox/collapse.js"></script>
<script src="http://rf.tekhne.nl/assets/js/lightbox/lg-fullscreen.js"></script>
<script src="http://rf.tekhne.nl/assets/js/lightbox/lg-thumbnail.js"></script>
<script src="http://rf.tekhne.nl/assets/js/lightbox/lg-autoplay.js"></script>
<script src="http://rf.tekhne.nl/assets/js/lightbox/lg-zoom.js"></script>
<script src="http://rf.tekhne.nl/assets/js/lightbox/jquery.mousewheel.min.js"></script>
<!--Light Box-->
<!-- after Login  Need-->
<script type="text/javascript">
function doLogin(data){
  $('li.login').remove();
  var login = '<li class="dropdown navbar-right splli"><a data-toggle="dropdown" class="dropdown-toggle ritspl" href="#"><div class="usrwel"><img src="'+data.profile_photo+'" alt="" /></div>'+data.fname+'<b class="lightcaret mt-2"></b></a><ul class="dropdown-menu"><li><a href="http://rf.tekhne.nl/dashboard">Dashboard</a></li><li><a href="http://rf.tekhne.nl/dashboard/bookings">Bookings</a></li><li><a href="http://rf.tekhne.nl/dashboard/settings">Settings</a></li><li><a href="http://rf.tekhne.nl/dashboard/support_conversation">Support Ticket</a></li><li><a href="http://rf.tekhne.nl/auth/logout/rfactory/'+data.rid+'/'+current_url+'">Logout</a></li></ul></li>';
  $(login).appendTo('ul.navbar-right');
}
</script>
<script type="text/javascript" src="http://rf.tekhne.nl/assets/js/jquery.popupoverlay.js"></script>
<script type="text/javascript"> 
$(document).ready(function() {
  $('#fadeandscale, #fadeandscalereg, #fadeandscaleforget, #fadeandscaleLanguages, #adwishlist').popup({
    pagecontainer: '.container',
    transition: 'all 0.3s'
  });
  $('.mymail').click(function(){
    $(this).fadeOut(500,function(){
      $('.signupul').fadeIn(500);
    });
  });
  $('.signinfixed').click(function(){
    $('#signupfix').fadeOut(500,function(){
      $('#signinfix').fadeIn(500);
    });
  });
  $('.signupfixed').click(function(){
    $('#signinfix').fadeOut(500,function(){
      $('#signupfix').fadeIn(500);
    });
  });
  $('#forgtpsw').click(function(){
    $('#signinfix').fadeOut(500,function(){
      $('#forgotpasfix').fadeIn(500);
    });
  });
});
$('.first').click(function(){

  
  $("#ui-datepicker-div").removeClass('returnDate_ui');
  if($('.second').val()!=""){
    $("#ui-datepicker-div").find("[data-handler='selectDay']:last").addClass('uidatepickerSelect-left');
  }
});
$('.second').click(function(){
  $("#ui-datepicker-div").addClass('returnDate_ui');
  if($('.first').val()!=""){
    $("#ui-datepicker-div").find("[data-handler='selectDay']:first").addClass('uidatepickerSelect-right');
  }
});
</script>

</body>
</html>  
  
  
 


  <script type="text/javascript">
    //FARE RULE DIAPLAY CODE BY VEERA
    function show_fare_popup(id,el,elm){
      $('.imgLoader').fadeIn();    
      $("#flightFareModal .modal-body").html('<img class="loading" src="http://rf.tekhne.nl/assets/images/ajax_loader1.gif" style="height:30px;"></img>');
      var formData = { fare_key: id,elm:elm };
      $.post('flight/fareRule', formData, function (data){
        if(data){
          var div1 = '<div>';
          for(var i=0;i<data.split("|@@|")[1];i++){
            sum = i+1;
            div1 += '<button class="btn btn-primary" id="'+data.split("|@@|")[2]+'" onclick="show_fare_popup(this.id,this,'+sum+');">Flight'+sum+'</button>  ';
          }
          div1 += '</div>';
          var div2 = '<div>'+data.split("|@@|")[0]+'</div>';
          $("#flightFareModal .modal-body").html('');
          $("#flightFareModal .modal-body").append(div1);
          $("#flightFareModal .modal-body").append(div2);
          $('#flightFareModal').modal('show');         
          $('.imgLoader').fadeOut();
        }else{
          $("#flightFareModal .modal-body").html('');
          $("#flightFareModal .modal-body").append('<div align="center">No Results Found</div>');
        }
      });
    }
//FARE RULE DIAPLAY CODE BY VEERA
// to add the background image for the second selected date
$('#multi-departure').click(function(){
  $("#ui-datepicker-div").removeClass('returnDate_ui');
});
</script>
<script type="text/javascript">
$(document).ready(function(){
$('input[name="trip_type"').change(function() {
 var tripname=($('input[name="trip_type"]:checked').val());
 //alert(tripname);
 if(tripname=='multicity'){
 
$('.multicitytime').hide();
$('.stopshide').hide(); 
$('.ffd_duration').hide();
$('.ff_facilitydp').hide();
 }
 else{
 
$('.multicitytime').show();
$('.stopshide').show(); 
$('.ffd_duration').show();
$('.ff_facilitydp').show();
 
 }





});

})  

</script>
 