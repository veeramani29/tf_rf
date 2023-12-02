
<?php
//echo "<pre>";
//print_r($_REQUEST['HotelAddress']);?>
<!DOCTYPE html>
<html>
  <head>
    <title>Place  Hotel Search</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>

    <style>
      table {
        font-size: 12px;
      }
      #map {
        width: 800px;
      }
      #listing {
        position: absolute;
        width: 200px;
       
        overflow: auto;
        right: 5px;
        top: 0px;
        cursor: pointer;
        overflow-x: hidden;
background-color: aliceblue;
      }
     
     
     
      
      .placeIcon {
        width: 20px;
        height: 34px;
        margin: 4px;
      }
      .hotelIcon {
        width: 24px;
        height: 24px;
      }
      
      #rating {
        font-size: 13px;
        font-family: Arial Unicode MS;
      }
      .iw_table_row {
        height: 18px;
      }
      .iw_attribute_name {
        font-weight: bold;
        text-align: right;
      }
      .iw_table_icon {
        text-align: right;
      }
    </style>
  </head>

  <body>


    <div id="map"></div>

    <div id="listing">
      <table id="resultsTable">
        <tbody id="results"></tbody>
      </table>
    </div>

    <div style="display: none">
      <div id="info-content">
        <table>
          <tr id="iw-url-row" class="iw_table_row">
            <td id="iw-icon" class="iw_table_icon"></td>
            <td id="iw-url"></td>
          </tr>
          <tr id="iw-address-row" class="iw_table_row">
            <td class="iw_attribute_name">Address:</td>
            <td id="iw-address"></td>
          </tr>
          <tr id="iw-phone-row" class="iw_table_row">
            <td class="iw_attribute_name">Telephone:</td>
            <td id="iw-phone"></td>
          </tr>
          <tr id="iw-rating-row" class="iw_table_row">
            <td class="iw_attribute_name">Rating:</td>
            <td id="iw-rating"></td>
          </tr>
          <tr id="iw-website-row" class="iw_table_row">
            <td class="iw_attribute_name">Website:</td>
            <td id="iw-website"></td>
          </tr>
        </table>
      </div>
    </div>

    <script>

  
var map, places, infoWindow;
var markers = [];
var MARKER_PATH = 'https://maps.gstatic.com/intl/en_us/mapfiles/marker_green';
var hostnameRegexp = new RegExp('^https?://.+?/');
var map_country = "<?php echo $_REQUEST['con'];?>"
var map_city = "<?php echo $_REQUEST['city'];?>";
var hotels=<?php echo urldecode($_REQUEST['HotelAddress']);?>;
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 4,
    //center: countries['in'].center,
    mapTypeControl: false,
    panControl: false,
    zoomControl: false,
    streetViewControl: false
  });

var geocoder = new google.maps.Geocoder();
geocoder.geocode( { 'address': map_country }, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {
	map.setCenter(results[0].geometry.location);
} else {
	alert("Could not find location: " + location);
}
});

  infoWindow = new google.maps.InfoWindow({
    content: document.getElementById('info-content')
  });

 
  places = new google.maps.places.PlacesService(map);


var geocoder;
geocoder = new google.maps.Geocoder();


intializeHotelCity(map_city)


 
function intializeHotelCity(map_city){

geocoder.geocode({'address': map_city}, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {
 		var address = results[0].formatted_address;
                var latitude = results[0].geometry.location.lat().toFixed(6);
                var longitude = results[0].geometry.location.lng().toFixed(6);
		if (results[0].geometry) {
		    map.panTo(results[0].geometry.location);
		    map.setZoom(10);
		   
		  }

}
});

}






 	
   for (var i = 0; i < hotels.length; i++) {
var each_hotel=hotels[i]+' '+map_city+' '+map_country;
 var replace_hotel=each_hotel.replace(","," ");

geocoder.geocode( {'address': replace_hotel}, setmarkupallhotels(i));

}

function setmarkupallhotels(rownum) {

clearResults();
clearMarkers();
var geocodeCallBack = function(results, status) {

         if (status == google.maps.GeocoderStatus.OK) {

var markerLetter = String.fromCharCode('A'.charCodeAt(0) + rownum);
var markerIcon = MARKER_PATH + markerLetter + '.png';
			//alert(results[0].geometry.location);
		markers[rownum] = new google.maps.Marker({
		position: results[0].geometry.location,
		animation: google.maps.Animation.DROP,
		icon: markerIcon
		});  

		// If the user clicks a hotel marker, show the details of that hotel
		// in an info window.
		markers[rownum].placeResult = results[0];
		google.maps.event.addListener(markers[rownum], 'click', showInfoWindow);
		setTimeout(dropMarker(rownum), rownum * 100);
		addResult(results[0], rownum);   
	}
    }

 return geocodeCallBack;
}

  




  
}
 
 



function clearMarkers() {
  for (var i = 0; i < markers.length; i++) {
    if (markers[i]) {
      markers[i].setMap(null);
    }
  }
  markers = [];
}


function dropMarker(i) {

  return function() {
    markers[i].setMap(map);
  };
}

function addResult(result, i) {

//alert(result);
//alert(i);
  var results = document.getElementById('results');
  var markerLetter = String.fromCharCode('A'.charCodeAt(0) + i);
  var markerIcon = MARKER_PATH + markerLetter + '.png';

  var tr = document.createElement('tr');
  tr.style.backgroundColor = (i % 2 === 0 ? '#F0F0F0' : '#FFFFFF');
  tr.onclick = function() {
    google.maps.event.trigger(markers[i], 'click');
  };

  var iconTd = document.createElement('td');
  var nameTd = document.createElement('td');
  var icon = document.createElement('img');
  icon.src = markerIcon;
  icon.setAttribute('class', 'placeIcon');
  icon.setAttribute('className', 'placeIcon');
  var name = document.createTextNode(hotels[i]+','+result.formatted_address);
  iconTd.appendChild(icon);
  nameTd.appendChild(name);
  tr.appendChild(iconTd);
  tr.appendChild(nameTd);
  results.appendChild(tr);
}

function clearResults() {
  var results = document.getElementById('results');
  while (results.childNodes[0]) {
    results.removeChild(results.childNodes[0]);
  }
}

// Get the place details for a hotel. Show the information in an info window,
// anchored on the marker for the hotel that the user selected.
function showInfoWindow() {
  var marker = this;
  places.getDetails({placeId: marker.placeResult.place_id},
      function(place, status) {
        if (status !== google.maps.places.PlacesServiceStatus.OK) {
          return;
        }
        infoWindow.open(map, marker);
        buildIWContent(place);
      });
}

// Load the place information into the HTML elements used by the info window.
function buildIWContent(place) {
  document.getElementById('iw-icon').innerHTML = '<img class="hotelIcon" ' +
      'src="' + place.icon + '"/>';
  document.getElementById('iw-url').innerHTML = '<b><a href="' + place.url +
      '">' + place.name + '</a></b>';
  document.getElementById('iw-address').textContent = place.vicinity;

  if (place.formatted_phone_number) {
    document.getElementById('iw-phone-row').style.display = '';
    document.getElementById('iw-phone').textContent =
        place.formatted_phone_number;
  } else {
    document.getElementById('iw-phone-row').style.display = 'none';
  }


  if (place.rating) {
    var ratingHtml = '';
    for (var i = 0; i < 5; i++) {
      if (place.rating < (i + 0.5)) {
        ratingHtml += '&#10025;';
      } else {
        ratingHtml += '&#10029;';
      }
    document.getElementById('iw-rating-row').style.display = '';
    document.getElementById('iw-rating').innerHTML = ratingHtml;
    }
  } else {
    document.getElementById('iw-rating-row').style.display = 'none';
  }

  
  if (place.website) {
    var fullUrl = place.website;
    var website = hostnameRegexp.exec(place.website);
    if (website === null) {
      website = 'http://' + place.website + '/';
      fullUrl = website;
    }
    document.getElementById('iw-website-row').style.display = '';
    document.getElementById('iw-website').textContent = website;
  } else {
    document.getElementById('iw-website-row').style.display = 'none';
  }
}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBi4BWvb8KOH-7Z_LY1lnf6Mw2XwC-MX04&signed_in=true&libraries=places&callback=initMap"
        async defer></script>


  </body>
</html>


