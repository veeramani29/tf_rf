
<script src="<?php echo ASSETS;?>js/star-rating.js"></script>

<div class="row">


  <div class="col-md-12">
    <div class="fullwidthbg_image">
      <img src="<?php echo ASSETS;?>images/FLIGHTS_SEARCH.svg" class="fs_bgimage">          
      <div class="fs_content color_white">
        <div class="col-sm-10">
          <h5 class="fs_title"><?php echo lang_line('FILTER_RSLT');?></h5>
        </div>
        <div class="col-sm-2">
			<!-- data-toggle="modal" data-target="#map"-->
          <span class="hotel_mapfiltericon cursor-point" data-iframe="true" id="google-map" data-src="http://rf.tekhne.nl/map.php?con=<?php echo trim($request['country_name']);?>&city=<?php echo trim($request['city_name']);?>">
            <i class="fa fa-map-marker"></i>Map
          </span>
        </div>
        <div class="col-xs-12">
          <form class="form-inline flight_form search_filter">
            <ul class="list-inline fs_filterform hotel_accdsform">
              <li>              
                <select id="Accommodations" class="form-control input_caretdown">                
                  <option value="">Accommodation</option>
                   <option value="All">All</option>
                </select>
              </li>
              <li>
                <select id="Facilities" class="form-control input_caretdown">                
                  <option value="">Facilities</option>
                  <option value="All">All</option>
                </select>
              </li>
              <li>
                <div class="form-group col-xs-12 nopadd">
                 <button type="button" class="btn dropdown-toggle btn-inbox" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo lang_line('PRICE');?></button>
                  <ul class="dropdown-menu well_bgwhite" id="price">
                    <div class="well">
                      <div class="departure_time">
                        <p><?php echo lang_line('PRICE');?></p>
                        <div id="price-filter" class="float_lwidth"></div>
                        <span class="time_left" id="min_price"></span>
                        <span class="time_right" id="max_price"></span>
                      </div>
                    </div>
                  </ul>
                </div>
              </li>
              <li>
                <select id="Area" class="form-control full_width input_caretdown">                
                  <option value="">Area</option>
                  <option value="All">All</option>
                  <?php 
                  $city_ajax=$request['city_name'];
                  $areas=$this->Hotel_Model->get_hotel_refrence_points('Amsterdam');
                 
                  foreach ($areas as $area) { ?>
                   <option value="<?php echo $area->refrence_point_name;?>"><?php echo $area->refrence_point_name;?></option>
                  <?php }
                  ?>
                </select>
              </li>
              <li>
                <select id="room_type" class="form-control full_width input_caretdown">                
                  <option value="">Room Type</option>
                   <option value="All">All</option>
                   <option value="RollawayAdult"> RollawayAdult</option>
                    <option value="Crib"> Crib</option>
                    <option value="Crib"> Queen</option>
                    <option value="Crib"> King</option>
                    <option value="Crib"> Double</option>                  
                    <?php foreach ($room_types as $room_type) { ?>
                    <option value="<?php echo stripslashes($room_type->room_type);?>"> <?php echo stripslashes($room_type->room_type);?></option>
                    <?php } ?>
                </select>
              </li>
             
             <!-- <li>
                <label>Sort on</label>
                <select id="sort_hotel" class="form-control input_caretdown">                
                  <option>Price</option>
                </select>
              </li>-->
              <li class="fs-button">
                <button type="button" class="btn btn-secondry btn_inputs" id="change_search"><?php echo lang_line('CHNGE_SEARCH');?></button>
              </li>
            </ul>
          </form>
          </div>
          <div class="col-sm-12">
            <ul class="fs_flightlist hotels">
              <?php 

              $data['Hotel_search_result']=$Hotel_search_result; 
              $data['request']  = $request;
              if(isset($Hotel_search_result['results']) && $Hotel_search_result!=''){
                $this->load->view('hotel/ajax_results', $data);
              }else{
                $this->load->view('hotel/no_result');
              }
              ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">

  
function get_via_ajax(hotel_chain,hotelcode,city_code,h_checkin,h_checkout,adult,child,room,dispId,el){

$(el).append('<img  src="'+ASSETS+'images/ajax_loader1.gif" style="height:20px;"></img>');

var checkdate = "ok";

var h_checkin = h_checkin;
var h_checkout = h_checkout;
var adult = adult;
var roomcount = room;

var detail_url = '/'+hotel_chain+'/'+hotelcode+'/'+city_code+'/'+h_checkin + '/' + h_checkout + '/' + adult+ '/'+child+'/' +roomcount;

$.ajax({
  type: 'POST',
  url: WEB_URL+"/hotel/get_hotel_details"+detail_url,
  data: '',
  async: true,
  cache: false,
  dataType: 'json',
  beforeSend: function() {

  },
  success: function(data) {

                         
                          $("div.collapse"+dispId).html(data.hotel_details_val1);
                           $.ajax({
    type: 'POST',
    url: WEB_URL+"/hotel/get_room_details"+detail_url,
    data: '',
    async: true,
    cache: false,
    dataType: 'json',
    beforeSend: function() {

    },
    success: function(data) {



 $("div.get_rooms"+dispId).html(data.hotel_rooms_details);
 $('#collapse'+dispId).modal('show');
 $('#collapse'+dispId+' form#cntctHst').attr("id_ref",dispId);
 $('input[name="imageurl"]').val($('#img'+dispId).attr("src"));
 $(el).find('img').empty();
  $(el).find('img').remove();

                               
                             },
                             error: function(request, status, error) {
                             }

                           });
                          

                        },
                        error: function(request, status, error) {
                        }
                      });


 


}


  $(document).ready(function()
{
    $("#hotelName").keyup(function()
    {       
        var filter = $(this).val(), count = 0;
        
        var regex = new RegExp(filter, "i"); 
       
        $(".HotelInfoBox").each(function()
        {           
            if ($(this).attr('data-hotel-name').search(regex) < 0) 
            { 
                 $(this).hide();         
            } 
            else 
            {
        count++;
                $(this).show();
               
            }
            
        });

    }); 

    $(".btn_transparent").click(function(){

    if($(this).find("i").hasClass("fa-plus-square")){
      $(this).find("i").removeClass("fa-plus-square");
      $(this).find("i").addClass("fa-minus-square");
    }else{
      $(this).find("i").removeClass("fa-minus-square");
      $(this).find("i").addClass("fa-plus-square");
    }
  });
    }); 




$(document).ready(function(){
 $('.allamn li').tooltip();
 
$('#google-map').lightGallery({
    selector: 'this',
    iframeMaxWidth: '80%'
});

$('.animated-thumbnials').lightGallery({
  download:false
}); 
 
$( ".fs_title" ).on( "click", function() {
 $(".animated-thumbnials").each(function(){
  $(this).data('lightGallery').destroy(true);
  
   $(this).lightGallery({download:'false'});
    }); 
    }); 


});

$('#change_search').click(function(){
  $( "ul.hotels" ).empty();
  $('.search_filter')[0].reset();
  $('form.search_filter :input').val('');
  $('form.search_filter select').find('option').remove();
  
  $('#SearchCarousel').carousel('next');

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


function more_hotels()
{


  var data={};

  data['city_code'] = "<?php echo $request['city_code']; ?>";
  data['check_in'] = "<?php echo $request['check_in']; ?>";
  data['check_out'] = "<?php echo $request['check_out']; ?>";
  data['rooms'] = "<?php echo $request['rooms']; ?>";
  data['adult'] = "<?php echo $request['adult']; ?>";
  data['child'] = "<?php echo $request['child']; ?>";
  data['days'] = "<?php echo $request['days']; ?>";
  data['area'] = "<?php echo $request['area']; ?>";
  data['min_price'] = "<?php echo $request['min_price']; ?>";
  data['max_price'] = "<?php echo $request['max_price']; ?>";
  data['room_type'] = "<?php echo $request['room_type']; ?>";
  data['Amenities'] = "<?php echo json_encode($request['Amenities']); ?>";
  data['nextlink'] = "<?php echo $Hotel_search_result['nextlink']; ?>";


  $.ajax({
    type: 'POST',
    url: WEB_URL + "/hotel/hotel_search",
    async: true,
    dataType: 'json',
    data: data,
    beforeSend: function() {

     $(".showmoreoption").html('<div class="lodrefrentrev"><div class="centerload"></div></div>');
     $(".showmoreoption .lodrefrentrev").fadeIn();
   },
   success: function(data) {

    $(".hotels").append(data.result);
    $(".showmoreoption .lodrefrentrev").fadeOut();
    $('.allamn li').tooltip();
    $(window).scroll(function() {
      var winTop = $(this).scrollTop();
      var minusht = $(window).height() / 2;
      var $loaddiv = $('.scroll');

      var top = $.grep($loaddiv, function(item) {

        return $(item).position().top <= winTop + minusht;
      });
      $loaddiv.removeClass('active');
      $(top).addClass('active');
    });
    
    $('.animated-thumbnials').lightGallery({download:false}); 
     $('input.rating').rating();

     $('#google-map').lightGallery({
          selector: 'this',
          download:false,
          iframeMaxWidth: '80%'
      });

  }
});
}
</script>
