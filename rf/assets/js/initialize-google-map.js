	function dinitialize(lat, lng) {
	// var mylat = 12.9667;
	// var mylng = 77.5667;
	var mylat = lat;
	var mylng = lng;
	"use strict";
		  // Create an array of styles.
		var styles = [
			{
				featureType: 'road.highway',
				elementType: 'all',
				stylers: [
					{ hue: '#e5e5e5' },
					{ saturation: -100 },
					{ lightness: 72 },
					{ visibility: 'simplified' }
				]
			},{
				featureType: 'water',
				elementType: 'all',
				stylers: [
					{ hue: '#30a5dc' },
					{ saturation: 47 },
					{ lightness: -31 },
					{ visibility: 'simplified' }
				]
			},{
				featureType: 'road',
				elementType: 'all',
				stylers: [
					{ hue: '#cccccc' },
					{ saturation: -100 },
					{ lightness: 44 },
					{ visibility: 'on' }
				]
			},{
				featureType: 'landscape',
				elementType: 'all',
				stylers: [
					{ hue: '#ffffff' },
					{ saturation: -100 },
					{ lightness: 100 },
					{ visibility: 'on' }
				]
			},{
				featureType: 'poi.park',
				elementType: 'all',
				stylers: [
					{ hue: '#d2df9f' },
					{ saturation: 12 },
					{ lightness: -4 },
					{ visibility: 'on' }
				]
			},{
				featureType: 'road.arterial',
				elementType: 'all',
				stylers: [
					{ hue: '#e5e5e5' },
					{ saturation: -100 },
					{ lightness: 56 },
					{ visibility: 'on' }
				]
			},{
				featureType: 'administrative.locality',
				elementType: 'all',
				stylers: [
					{ hue: '#000000' },
					{ saturation: 0 },
					{ lightness: 0 },
					{ visibility: 'on' }
				]
			}
		];

		
		var myLatlng = new google.maps.LatLng(mylat, mylng);


	  // Create a new StyledMapType object, passing it the array of styles,
	  // as well as the name to be displayed on the map type control.
	  var styledMap = new google.maps.StyledMapType(styles,
		{name: "InnoGlobe Map"});


	  // Create a map object, and include the MapTypeId to add
	  // to the map type control.
	  var mapOptions = {
		zoom: 15,
		center: myLatlng,
		mapTypeControlOptions: {
		  mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
		}
	  };

	  var map = new google.maps.Map(document.getElementById('map-canvas'),
		mapOptions);
	  var icon1 = ASSETS+"images/marker_out.png";
	  var marker = new google.maps.Marker({
		  position: myLatlng,
		  map: map,
		  icon: icon1,
		  title: 'Hello World!',
		  animation: google.maps.Animation.DROP
	  });

	  var populationOptions = {
	      strokeColor: '#48d5ea',
	      strokeOpacity: 0.8,
	      strokeWeight: 2,
	      fillColor: '#30a5dc',
	      fillOpacity: 0.35,
	      map: map,
	      center: myLatlng,
	      radius: 300,
	      title: "The Listing is located in this area. When you book, you'll receive the exact address."
	  };
	  cityCircle = new google.maps.Circle(populationOptions);
	  //Associate the styled map with the MapTypeId and set it to display.
	  map.mapTypes.set('map_style', styledMap);
	  map.setMapTypeId('map_style');
	}

	
	function loadScript(lat, lng) {
	"use strict";
	    setTimeout(function (){
		  $('#map-canvas').css({'display':'block'});
		  // var script = document.createElement('script');
		  // script.type = 'text/javascript';
		  // script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' +
			 //  'callback=dinitialize';
		  // document.body.appendChild(script);
		  dinitialize(lat, lng);
		  
		  //google.maps.event.trigger(map, 'resize');
	    }, 500);	
	}
	