<script type="text/javascript" src="<?php echo ASSETS;?>js/jquery.provabpopup.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS ?>css/cs-select.css" />
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>

<script type="text/javascript">
$(document).ready(function(){
            var pop_close;
            $('#js-add-address').bind('click', function(e) {
                e.preventDefault();
                $('body,html').css({overflow: 'hidden'});
                
                    pop_close =  $('#element_to_pop_up').provabPopup({
                    modalClose: false, 
                    zIndex: 10000005,
                     positionStyle: 'fixed'
                    });         
                    });         
            $('.overflowclose').click(function(){
                $('body,html').css({overflow: 'visible'});
            });     
            
            
            $("#nextloc_1").click(function(){
                var data = {};
                
                data['latitude']  = $('#latitude').val();
                data['longitude'] = $('#longitude').val();
                data['edit_listings_pinmap'] = $('#edit_listings_pinmap').val();
                

                $.ajax({
                        type: "POST",
                        url: WEB_URL+'/listings/update_listing_property_step8',
                        data: data,                     
                        success: function(data){
							//var clpm = getelemenetByID("element_to_pop_up");
                            pop_close.close();
                            $( "#pinmap_tab_section" ).addClass( "activetik" );                         	$('body,html').css({overflow: 'visible'});
                        }
                    });
                
                updateCompletedStatus(data['edit_listings_pinmap']);

                var data = {};
                data['latitude']  = $('#latitude').val();
                data['longitude'] = $('#longitude').val();
                data['edit_listings_pinmap'] = $('#edit_listings_pinmap').val();
                
                $.ajax({ 
                         type: "POST",
                         url: WEB_URL+'/listings/get_map_static_image',
                         data: data,        
                         dataType: 'json',              
                         success: function(data){
                            if(data.previous_completed_status == 0 && data.count_result == 3){
                                inform();
                            }                            
                             var shtml = '';
                             shtml = '<img src="'+data.map_lat_long+'" />';
                             $('#media-photo').html(shtml);
                        }
                     });    
                });
});
</script>

<div class="col-md-8 minht offset-0 grybackgr">
    <div class="editbleside">
        <div class="sidehed">Location</div>
        <div class="siderowwrap">
        <div class="col-md-4">
            <h3>Address</h3>
            <p class="text-muted">
            </p><p class="text-muted">
                Your exact address is private and only shared with guests after a reservation is confirmed.
            </p>
            <p></p>
        </div>

        <div class="col-md-8">
            <div class="media-photo" id="media-photo">
                <img src="<?php echo $map_lat_long; ?>" />
            </div>
            <div class="panel">
                <div class="panel-body">
                    <div class="text-center">
                        <h4 class="text-muted"></h4>
                        <button class="btn btn-primary" id="js-add-address">Edit Address</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>      

<div class="col-md-3 minht witebackgrnd">
        <div class="padhelp">
            <div class="helpico icon icon-lightbulb"></div>
            <div class="helppara">
                <h4 class="helphed"> Your Address is Private </h4>
                <p>
					It will only be shared with guests after a reservation is confirmed.
                </p>
            </div>
        </div>
    </div>      

	<div id="element_to_pop_up" class="fullwidthpopup">
        <span class="buttonclose pop-close overflowclose">X</span>
        <div class="listingpopup forcustom">
        <div class="lodingpop"></div>
        <div id="enteradrs" class="">
        	<div class="popuphed">
            	<span class="popbighed">Enter Address</span>
                <span class="popsmalhed">What is your listing's address?</span>
            </div>
            <form id="form_pinmap" name="form_pinmap" method="post" action="<?php echo WEB_URL;?>/listings/update_listing_property_step7">
            <input type="hidden" name="edit_listings_pinmap" id="edit_listings_pinmap" value="<?php echo $listings->PROPERTY_ID; ?>" />
            <div class="popconyent">
            	<div class="poprow">
                	<span class="poplabel">Country</span>
                    <select class="popupselect" name="country" id="country">
                    	<?php foreach($countries as $key => $value) { if($listings->PROP_COUNTRY == $value->alpha2) { $selected = "selected=selected"; } else { $selected = ""; } ?>
							<option value="<?php echo $value->alpha2; ?>" <?php echo $selected; ?> ><?php echo $value->langEN; ?></option>
                        <?php } ?>
                    </select>
                </div>
                
                <div class="poprow">
                	<span class="poplabel">Street Address</span>
                    <input type="text" value="<?php echo $listings->AUTOCOMPLETE_ADDRESS; ?>" name="listings_city"  onkeypress="return dontSubmit(event);" id="autocomplete" class="biginput withico" placeholder="Eg : City, state, country"/>
                </div>
                
                <div class="poprow">
                	<span class="poplabel">Address Line 1 (optional) </span>
                    <input type="text" class="popinput" placeholder="Address Line 1" id="address_line_1" name="address_line_1" value="<?php echo $listings->PROP_ADDR1; ?>"/>
                </div>
                
                <div class="poprow">
                	<span class="poplabel">Address Line 2 (optional) </span>
                    <input type="text" class="popinput" placeholder="Address Line 2" id="address_line_2" name="address_line_2" value="<?php echo $listings->PROP_ADDR2; ?>" />
                </div>
                
                <div class="poprow">
                	<span class="poplabel">Address Line 3 (optional) </span>
                    <input type="text" class="popinput" placeholder="Address Line 3" id="address_line_3" name="address_line_3" value="<?php echo $listings->PROP_ADDR3; ?>" />
                </div>
                
                
                <div class="poprow">
                	<span class="poplabel">City / Town / District</span>
                    <input type="text" class="popinput" placeholder="City" id="locality" name="city" value="<?php echo $listings->PROP_CITY; ?>"/>
                </div>
                
                <div class="poprow">
                	<span class="poplabel">ZIP / Postal Code</span>
                    <input type="text" class="popinput" placeholder="Postal Code" id="postal_code" name="postal_code" value="<?php echo $listings->PROP_POSTCODE; ?>" />
                    <input type="hidden" id="street_number" name="street_number"></input>
                    <input type="hidden" id="route" name="route"></input>                    
                    <input type="hidden" id="latitude" name="latitude" value="<?php echo $listings->PROP_LATITUDE; ?>" ></input>
                    <input type="hidden" id="longitude" name="longitude" value="<?php echo $listings->PROP_LONGITUDE; ?>" ></input>
                    <input type="hidden" id="administrative_area_level_1" name="administrative_area_level_1" ></input>
                </div>
                
            </div>
            
            <div class="popfooter">
            	<button id="nextloc" class="popbutton blubutton" type="submit" name="nextloc">Next</button>
            </form>
			
			<button class="popbutton pop-close overflowclose">Cancel</button>
            </div>
        </div>
        
        
     <!--   <form name="form_verifyloc" id="form_verifyloc" method="post" action="">-->
        <div id="verifyloc" class="" style="display:none;">
        	<div class="popuphed">
            	<span class="popbighed">Verify Location</span>
                <span class="popsmalhed">Is the location on the map correct?</span>
            </div>
            
            <div id="googleMap" style="width:500px;height:380px;"></div>
            
            
            <div class="popfooter">
            	<button id="nextloc_1" class="popbutton blubutton" type="submit">Finish</button>
                <button class="popbutton pop-close overflowclose">Cancel</button>
            </div>
        </div>
     <!--   </form>-->
        
        </div>
</div>
<?php 
    
    if(empty($listings->PROP_LATITUDE)){
        $latitude = '40.7143528';    
    }
    else{
        $latitude = $listings->PROP_LATITUDE;
    }

    if(empty($listings->PROP_LONGITUDE)){
        $longitude = '-74.0059731';    
    }
    else{
        $longitude = $listings->PROP_LONGITUDE;
    }
?>


<script>
    $(document).ready(function() {
       initialize(1);
    });
</script>


<script type="text/javascript">
var map;
var myCenter=new google.maps.LatLng(<?php echo $latitude; ?>,<?php echo $longitude; ?>);

var markers = [];

function initialize()
{
      var mapProp = {
      center:myCenter,
      zoom:15,
      mapTypeId:google.maps.MapTypeId.ROADMAP
      };

      map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
    
      var icon1 = ASSETS+"images/marker_out.png";
    
      var marker = new google.maps.Marker({
              position: myCenter,
              map: map,
              icon: icon1,
              animation: google.maps.Animation.DROP
        });
        
      markers.push(marker);
        
      google.maps.event.addListener(map, 'click', function(event) {
        setAllMap(null);
        placeMarker(event.latLng);
            $('#latitude').val(event.latLng.lat());
            $('#longitude').val(event.latLng.lng());
      });   
}

function setAllMap(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

function placeMarker(location) {
    var icon1 = ASSETS+"images/marker_out.png";
    var marker = new google.maps.Marker({
    position: location,
    map: map,
    icon: icon1
  });  
  markers.push(marker);
}


    google.maps.event.addDomListener(window, 'load', initialize);


</script>

<style>.pac-container { z-index:999999999999999999; }</style>

