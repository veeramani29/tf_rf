//Apartment Maps
var gmarkers;
var map;
var loc, map, marker, infoWindow, data;
function loadMapMarkers(markers,geometry){

  gmarkers = new Array();

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

    // Create a new StyledMapType object, passing it the array of styles,
    // as well as the name to be displayed on the map type control.
    var styledMap = new google.maps.StyledMapType(styles,
    {name: "InnoGlobe Map"});
if(markers != '' && markers != '{}'){
  var mapOptions = {
    zoom: 14,
    //center: new google.maps.LatLng(geometry.latitude, geometry.longitude),
    center: new google.maps.LatLng(markers[markers.length-1].lat, markers[markers.length-1].lng),
    mapTypeControlOptions: {
      mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
    }
  };
}else{
  var mapOptions = {
    zoom: 14,
    //center: new google.maps.LatLng(geometry.latitude, geometry.longitude),
    center: new google.maps.LatLng(geometry.latitude, geometry.longitude),
    mapTypeControlOptions: {
      mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
    }
  };
}  
  var icon1 = ASSETS+"images/marker_out.png";
  var icon2 = ASSETS+"images/marker_over.png";


  infoWindow = new google.maps.InfoWindow();
  map = new google.maps.Map(document.getElementById("map"), mapOptions);

  var weatherLayer = new google.maps.weather.WeatherLayer({
      temperatureUnits: google.maps.weather.TemperatureUnit.CELCIUS
  });
  weatherLayer.setMap(map);

  var cloudLayer = new google.maps.weather.CloudLayer();
  cloudLayer.setMap(map);

  google.maps.event.addDomListener(window, "resize", function() {
      var center = map.getCenter();
      google.maps.event.trigger(map, "resize");
      map.setCenter(center);
  });
  if(markers != '' || !empty(markers)){
  var i = 0;
  var interval = setInterval(function () {
   // alert(i);
      data = markers[i]
      //console.log(data.inWishlist);
      var myLatlng = new google.maps.LatLng(data.lat, data.lng);
      var marker = new google.maps.Marker({
          position: myLatlng,
          map: map,
          icon: icon1,
          title: data.title,
          animation: google.maps.Animation.DROP
      });

      (function (marker, data) {
        //var info = data.description;
        var Aptimage;
        //if(data.images.PHOTO_CONTENT == null || data.images == null){
        // if(typeof(data.images) == "undefined" && data.images == null) {
        //   Aptimage = ASSETS+'images/items/item1.jpg';
        // }else{
        //   if(typeof(data.images.PHOTO_CONTENT) == "undefined" && data.images.PHOTO_CONTENT == null) {
        //     Aptimage = ASSETS+'images/items/item1.jpg';
        //   }else{
        //     Aptimage = 'data:image/jpeg;base64,'+data.images.PHOTO_CONTENT;
        //   }
        // }
        if (data.hasOwnProperty('images')) {
          if (data.images.hasOwnProperty('PHOTO_CONTENT')) {
            if(data.images.PHOTO_CONTENT !== null){
              Aptimage = 'data:image/jpeg;base64,'+data.images.PHOTO_CONTENT;
            }else{
              Aptimage = ASSETS+'images/items/item1.jpg';
            }
          }else{
            Aptimage = ASSETS+'images/items/item1.jpg';
          }
        }else{
            Aptimage = ASSETS+'images/items/item1.jpg';
        }

        if(data.inWishlist == 1) {
          var wishlistStyle = "style='color: red' ";
        } else {
          var wishlistStyle = "";
        }
        
        var info = '<div class="infowin">'+
                      '<div class="ininfo">'+
                        '<div class="infoaptimg">'+
                          '<a href="'+data.Apturl+'">'+
                            '<img src="'+Aptimage+'" alt="" />'+
                          '</a>'+
                          '<div class="flotaptprice"><span class="currency">'+data.CURR_ICON+'</span> <span class="amount">'+data.perNight+'</span></div>'+
                          '<span data-title="'+data.title+'" '+wishlistStyle+' data-image="'+Aptimage+'" data-id="'+data.PROPERTY_ID+'" class="hrticon addWish icon icon-heart"></span>'+
                        '</div>'+
                        '<div class="descinfo">'+
                          '<div class="aptownerimg">'+
                            '<a href="'+WEB_URL+'/users/show/'+data.ApartmentUsertype+'/'+data.ApartmentUserId+'">'+
                              '<img src="'+data.ApartmentUserPic+'" alt="" />'+
                            '</a>'+
                          '</div>'+
                          '<div class="aptinfoall">'+
                            '<a href="'+data.Apturl+'" class="linkinfo">'+data.title+'</a>'+
                            '<b>'+data.type+' . '+data.addr+'</b>'+
                          '</div>'+
                        '</div>'+
                      '</div>'+
                    '</div>';
     
        google.maps.event.addListener(marker, "click", function (e) {
          //infoWindow.setOptions(myOptions);
          infoWindow.setContent(info);
          infoWindow.open(map, marker);
        });


          // google.maps.event.addListener(marker, 'mouseover', function (e) {
          //     marker.setIcon(icon1);
          // });
          // google.maps.event.addListener(marker, 'mouseout', function (e) {
          //     marker.setIcon(icon2);
          // });
      })(marker, data);
      gmarkers.push(marker);
      i++;
      if (i == markers.length) {
          clearInterval(interval);
      }
  }, 50);
}
  //Associate the styled map with the MapTypeId and set it to display.
    map.mapTypes.set('map_style', styledMap);
    map.setMapTypeId('map_style');          
}

function changeMarker(type,that) {
    var id = $(that).data('id');
    marker = gmarkers[id];
    var icon1 = ASSETS+"images/marker_out.png";
    var icon2 = ASSETS+"images/marker_over.png";
    var varLat = $(that).data('lat');
    var varLong = $(that).data('lng');
    var latLng = new google.maps.LatLng(varLat, varLong); //Makes a latlng
    map.panTo(latLng);//Make map global
    //map.panTo(new google.maps.LatLng(varLong, varLat));
    // if (data.hasOwnProperty('images')) {
    //   if (data.images.hasOwnProperty('PHOTO_CONTENT')) {
    //     if(data.images.PHOTO_CONTENT !== null){
    //       Aptimage = 'data:image/jpeg;base64,'+data.images.PHOTO_CONTENT;
    //     }else{
    //       Aptimage = ASSETS+'images/items/item1.jpg';
    //     }
    //   }else{
    //     Aptimage = ASSETS+'images/items/item1.jpg';
    //   }
    // }else{
    //     Aptimage = ASSETS+'images/items/item1.jpg';
    // }
    // var info = '<div class="infowin"><div class="ininfo"><div class="infoaptimg"><a><img src="'+Aptimage+'" alt="" /></a><div class="flotaptprice">$ '+data.perNight+'</div><span class="hrticon icon icon-heart"></span></div><div clas="descinfo"><div class="aptownerimg"><a href="'+WEB_URL+'/users/show/'+data.ApartmentUserId+'"><img src="'+data.ApartmentUserPic+'" alt="" /></a></div><div class="aptinfoall"><a class="linkinfo">'+data.title+'</a><b>'+data.type+' . '+data.addr+'</b></div></div></div></div>';
    if(type == 'over'){
      marker.setIcon(icon2);
      //infoWindow.setContent(info);
      //infoWindow.open(map,marker);
    }else if(type == 'out'){
      //infoWindow.close();
      marker.setIcon(icon1);
    }
    
        
    //marker.setIcon(icon);
}

$(window).load(function(){
  flexslider();
});

function flexslider(){
  $('.flexslider').flexslider({
      animation: "fade",
    slideshow: false,
      start: function(slider){
        $('body').removeClass('loading');
      }
  });
}

$(function(){
  $( document ).on( "click", ".pagination li a.loadAjaxPage", function() {
   //$(".pagination li a").live( "click", function() {
  //$("#links aaa").click(function(){
    $.ajax({
       type: "GET",
       url: $(this).attr("href"),
       dataType: 'json',
       beforeSend: function(){
          $('.loadingload, .fadebackgrnd').toggle();
       },
       success: function(res){
          // $('#apartments').html(res);
          // flexslider();
          loadtemp(res.apartments, res);
          flexslider();
          var percentageToScroll = 100;
          var percentage = percentageToScroll/100;
          var height = $(document).scrollTop();
          var scrollAmount = height * (1 - percentage);
          $('html,body').animate({ scrollTop: scrollAmount }, 'fast', function () {});
          $('#links').html(res.pagination);
          //alert(res.pagination);
          $('.loadingload, .fadebackgrnd').toggle();
          loadMapMarkers(res.markers,loadMapMarkers);
       }
     });
       return false;
   });
});

function Filter(Apturl){
  $.ajax({
   type: "GET",
   url: Apturl,
   dataType: 'json',
   beforeSend: function(){
      $('.loadingload, .fadebackgrnd').toggle();
   },
   success: function(res){
      // $('#apartments').html(res);
      // flexslider();
      if(res.rows > 0){
        loadtemp(res.apartments, res);
        flexslider();
        var percentageToScroll = 100;
        var percentage = percentageToScroll/100;
        var height = $(document).scrollTop();
        var scrollAmount = height * (1 - percentage);
        $('html,body').animate({ scrollTop: scrollAmount }, 'fast', function () {});
        $('#links').html(res.pagination);
        //alert(res.pagination);
        $('.loadingload, .fadebackgrnd').toggle();
        $('.topfilhedresult span').html(res.rows);
        loadMapMarkers(res.markers,loadMapMarkers);
      }else{
        $('#apartments').html("<div class='noresultsec'><div class='norestimg'><img src='"+ASSETS+"images/sorry.png' alt='' /></div><div class='resonforerror'>We couldn't find any results that matched your criteria, but tweaking your search may help. Here are some ideas:</div><ul class='resonlist'><li>Remove some filters.</li><li>Expand the area of your search.</li><li>Search for a city, address, or landmark.</li></ul></div>");
        $('#links').html('');
        $('.loadingload, .fadebackgrnd').toggle();
        $('.topfilhedresult span').html(res.rows);
        loadMapMarkers(res.markers,geometry);
      }
   }
 });
}

function getReviews(apt_id, prop_user_id, prop_user_type) { 
  $('.lodrefrentrev').css('display', 'block');
  $.ajax({
    url: WEB_URL+'/reviews/getReviews/'+apt_id+'/'+prop_user_id+'/'+prop_user_type,
    dataType: "json",
    success: function(r) {
      console.log(r);
      if(!r.reviews) {
        $('#reviews').empty();
        $('#reviews').append('<div class="col-md-12" style="margin: 0 auto; text-align: center;"><div class="srywrap"><span class="sorrydiv"><img src="'+WEB_URL+'/assets/images/sorry.png" alt="" /></span><b>Nothing here</b></div></div>');
        $('.lodrefrentrev').css('display', 'none');
        
        return false;
      }


      if(r.reviews.length == 0) {
        $('#reviews').empty();
        $('#reviews').append('<div class="col-md-12" style="margin: 0 auto; text-align: center;"><div class="srywrap"><span class="sorrydiv"><img src="'+WEB_URL+'/assets/images/sorry.png" alt="" /></span><b>Nothing here</b></div></div>');
        $('.lodrefrentrev').css('display', 'none');
        
        return false;
      }
      $('#usrRevs').empty();
      $('#rtingBig').text(r.rating.overAllAvg+'/5');
      $('#clnId').text(r.rating.clean);
      $('#cmnctnId').text(r.rating.communication);
      $('#accuracyId').text(r.rating.accuracy);
      $('#chkinId').text(r.rating.checkin);
      $('#lctinId').text(r.rating.location);
      $('#cstValId').text(r.rating.costvalue);
      $('#vrfiedUsrCnt').text(r.rating.verifiedUserCount);
      $('#rtngPrcnt').html('<div class="progress-bar progress-bar-success progressRating" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="sr-only"style="color: #333">'+r.rating.overAllAvg+' out of 5</span></div>');
      $('#rcmndPrcnt').html('<div class="progress-bar progress-bar-success progressRecommend" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="sr-only" style="color: #333">'+r.rating.recommended+'% of guests recommend</span></div>');
      
      $('.progressRating').css('width', r.rating.overAllAvg_prcntge+'%');
      $('.progressRecommend').css('width', r.rating.recommended+'%');

      var rtngLgnd;
      var c = r.rating.overAllAvg;
  
      if(c > 0 && c <= 1) {
        rtngLgnd = "user-rating-1.png";
      } else if(c > 1 && c <= 2) {
        rtngLgnd = "user-rating-2.png";
      } else if(c > 2 && c <= 3) {
        rtngLgnd = "user-rating-3.png";
      } else if(c > 3 && c <= 4) {  
        rtngLgnd = "user-rating-4.png";
      } else if(c > 4 && c <= 5) {
        rtngLgnd = "user-rating-5.png";
      } 
      $('#rtngLgnd').attr('src', ASSETS+'/images/'+rtngLgnd);
      $('.lodrefrentrev').css('display', 'none');
      
      for(var k in r.reviews) {

        if(r.reviews[k].recommended == 1) {
          rec = '<img src="'+ASSETS+'images/check.png" alt=""/><br/><span class="green">Recommended<br/>for Everyone</span>';
        } else {
          rec ='';
        }

      var postTime = getFormatedDate(r.reviews[k].posted_time);

      if(typeof r.reviews[k].profile_photo != "undefined") {
        image = r.reviews[k].profile_photo;
      } else {
        image = r.reviews[k].agent_logo;
      }

      var usrRev = '<div class="line2"></div>'+
                    '<div class="hpadding20 nopad">'+                         
                            '<div class="col-md-4 center">'+
                                '<div class="padding20">'+
                                    '<div class="colorsix">'+
                                        '<div class="circlewraprev">'+
                                            '<img src="'+image+'" alt=""/>'+
                                        '</div>'+
                                        '<span class="dark">by '+r.reviews[k].firstname+'</span><br/>'+
                                        'from '+r.reviews[k].address+'<br/>'+
                                          rec+
                                    '</div>'+
                                    
                                '</div>'+
                            '</div>'+
                           ' <div class="col-md-8 offset-0">'+
                                '<div class="padding20">'+
                                    '<span class="opensans size16 dark">'+r.reviews[k].review_title+'</span><br/>'+
                                    '<span class="opensans size13 lgrey">'+postTime+'</span><br/>'+
                                   ' <p>'+r.reviews[k].review_comment+'</p> '+
                                    '<ul class="circle-listnew">'+
                                        '<li><a title="Cleanliness" class="scircle left">'+r.reviews[k].cleanliness+'</a></li>'+
                                        '<li><a title="Details Accuracy" class="scircle left">'+r.reviews[k].accuracy+'</a></li>'+
                                        '<li><a title="Location" class="scircle left">'+r.reviews[k].localtion+'</a></li>'+
                                        '<li><a title="Communication" class="scircle left">'+r.reviews[k].communication+'</a></li>'+
                                        '<li><a title="Check In" class="scircle left">'+r.reviews[k].checkin+'</a></li>'+
                                        '<li><a title="Value for Price" class="scircle left">'+r.reviews[k].costvalue+'</a></li>'+
                                   ' </ul>'+
                                '</div>'+
                            '</div>'+
                            '<div class="clearfix"></div>'+
                        '</div>';
      $('#usrRevs').append(usrRev);
      }
      $(".scircle").tooltip();    
    }
  })
}

function getFormatedDate(msgRecTime) {
  d = msgRecTime;
  d = d.replace(/-/g, '/');
  var dateTime = new Date(d);
  
  var fetchDate = dateTime.getDate();
  
  var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec" ];
  var fetchMonth = monthNames[dateTime.getMonth()];

  var fetchHours = dateTime.getHours();
  var fetchMin = dateTime.getMinutes();

  var fullDate = fetchDate+' '+fetchMonth+', '+fetchHours+':'+fetchMin;
  if(fullDate) {
    return fullDate;  
  } else {
    return msgRecTime;
  } 
}
