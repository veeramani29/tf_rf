<script src="<?php echo ASSETS;?>js/star-rating.js"></script>
<div class="row">
  <div class="col-md-12">
    <div class="fullwidthbg_image hotelsearch_page">
      <img src="<?php echo ASSETS;?>images/FLIGHTS_SEARCH.svg" class="fs_bgimage">          
      <div class="fs_content color_white">
        <div class="float_lwidth">
          <div class="col-xs-4">
            <h5 class="fs_title"><?php echo lang_line('FILTER_RSLT');?></h5>
          </div>
          <div class="col-xs-8">
            <ul class="list-inline text-right">
              <li>
                <h5><?php echo lang_line('CHECKIN');?> : <?php echo $request['check_in']; ?></h5>
              </li>
              <li>
                <h5><?php echo lang_line('CHECKOUT');?> : <?php echo $request['check_out']; ?></h5>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-xs-12">
          <form class="form-inline flight_form search_filter">
            <ul class="list-inline fs_filterform hotel_accdsform">
              <li> 
                <div class="button-group col-sm-12 nopadd ff_facilitydp">
                  <button type="button" class="btn dropdown-toggle btn-inbox" data-toggle="dropdown"><?php echo lang_line('FACILITIES');?></button>
                  <ul class="dropdown-menu ffdp_dp Facilities" id="Facilities">
                    <li class="col-sm-6 nopadd">
                      <label for="All">
                        <input name="Facilities[]" id="All" type="checkbox" value="All"/>All
                      </label>
                    </li>
                  </ul>
                </div>
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
              <li class="hotel_area">
                <select id="Area" class="form-control full_width input_caretdown">                
                  <option value=""><?php echo lang_line('AREA');?></option>
                  <option value="All"><?php echo lang_line('ALL');?></option>
                  <?php 
                  $city_ajax=$request['city_name'];
                  $areas=$this->Hotel_Model->get_hotel_refrence_points('Amsterdam');
                  foreach ($areas as $area) { ?>
                  <option value="<?php echo $area->refrence_point_name;?>"><?php echo $area->refrence_point_name;?></option>
                  <?php } ?>
                </select>
              </li>
              <li>
                <select id="Distance" class="form-control input_caretdown">                
                  <option value=""><?php echo lang_line('DISTANCE');?></option>
                  <option value="All"><?php echo lang_line('ALL');?></option>
                </select>
              </li>            
              <li class="sort_price">
                <label><?php echo lang_line('SORT_ON');?></label>
                <select id="sortprice" onchange="SortbyPrice(this.value);" class="form-control input_caretdown">                
                  <option value=""><?php echo lang_line('PRICE');?></option>
                   <option value="LH"><?php echo lang_line('Low_To_High');?></option>
                  <option value="HL"><?php echo lang_line('High_To_Low');?> </option>
                </select>
              </li>
              <li class="fs-button">
                <button type="button" class="btn btn-secondry btn_inputs" id="change_search"><?php echo lang_line('CHNGE_SEARCH');?></button>
              </li>
            </ul>
          </form>
        </div>
        <div class="col-sm-12 hsrtarrifs_hotellist">
          <ul class="fs_flightlist">
            <li>
              <ul class="list-inline hotels">
                <?php 
                $data['Hotel_search_result']=$Hotel_search_result; 
                $data['request']  = $request;
                $nextlink=(isset($Hotel_search_result['nextlink']))?$Hotel_search_result['nextlink']:'';
                if(isset($Hotel_search_result['results']) && $Hotel_search_result!=''){
                  $this->load->view('hotel/ajax_results', $data);
                }else{
                  $this->load->view('hotel/no_result');
                }
                ?>
              </ul>
            </li>            
            <?php
            echo '<li> <div id="errorMessage" style="text-align:center;display:none;" class="no_available">
            <h1>'.lang_line('HOTEL_NOT_AVAIL').'</h1>
            <br><br>
            <div class="no_available_text">'.lang_line('HOTEL_NOT_AVAIL_MSG').'<br></div>
            </div></li>';
            if($nextlink!=''){ ?>
            <li class="col-sm-12 fs_singlefligh hotel_smore">
              <div class="spacer20"></div>
              <div class="showmoreoption text-center">
                <input type="hidden" id="nextLink" value="<?php echo isset($Hotel_search_result['nextlink'])?$Hotel_search_result['nextlink']:''; ?>" />
                <a href="javascript:void(0);" class="tshomor btn btn-primary" onClick="more_hotels();" ><?php echo lang_line('SHOW_MORE');?> </a>
              </div>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function SortbyPrice(type){
 if (type == 'LH') {
  $('li.HotelInfoBox').not('.hotels script').map(function () {
   return {val: parseFloat($(this).data('price')), el: this};
 }).sort(LH).map(function () {
   return this.el;
 }).appendTo('.hotels');
}else{
  $('li.HotelInfoBox').not('.hotels script').map(function () {
   return {val: parseFloat($(this).data('price')), el: this};
 }).sort(HL).map(function () {
   return this.el;
 }).appendTo('.hotels');
}
}
function HL(a, b) {
  return b.val - a.val;
}
function LH(a, b) {
  return a.val - b.val;
}
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
       $(".lodrefrentrev").fadeIn();
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
        var ContetntModelContent = $('#collapse'+dispId+' .modal-body').html();
        $("#Hotel-Details .modal-body").html(ContetntModelContent);
          $(".lodrefrentrev").fadeOut();
          $('#collapse'+dispId+' form#cntctHst').attr("id_ref",dispId);
         $('input[name="imageurl"]').val($('#img'+dispId).attr("src"));
         $('.cacellation').attr("data-id",'collapse'+dispId);
         $(el).find('img').empty();
         $(el).find('img').remove();
          /*$('#Hotel-Details .animated-thumbnials').lightGallery({
          download:false
          });*/
          
         $('#Hotel-Details').modal('show');
         
       },
       error: function(request, status, error) {
       }
     });
    },
    error: function(request, status, error) {
    }
  });
}
$(document).ready(function(){
 $('.allamn li').tooltip();
 $('.animated-thumbnials').lightGallery({
  download:false
}); 
 $( ".fs_title" ).on( "click", function() {
   $(".animated-thumbnials").each(function(){
    $(this).data('lightGallery').destroy(true);

    $(this).lightGallery({download:'false'});
  }); 
 }); 


$('ul.Facilities li input[name="Facilities[]"]' ).on( 'click', function( event ) {  

$( event.target ).blur();
$('.ff_facilitydp').addClass('open');  

});


});
$('#change_search').click(function(){
  $( "ul.hotels" ).empty();
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
  $(".modal").on("click", "button.cacellation", function() {
    var sid=$(this).data('sid'); 
    var hotelid=$(this).data('hotelid'); 
    var rate=$(this).data('rate');
    var rateplan=$(this).data('rateplan'); 
    var checkin=$(this).data('checkin'); 
    var checkout=$(this).data('checkout');
    get_cancellation_policy(sid,hotelid,rate,rateplan,checkin,checkout,$(this))
  });
});
$(".modal").on("click", ".modal-123", function() {
  $("#modal-123").modal('hide');     
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
  data['area'] = "<?php echo isset($request['area'])?$request['area']:''; ?>";
  data['min_price'] = "<?php echo $request['min_price']; ?>";
  data['max_price'] = "<?php echo $request['max_price']; ?>";
  data['Amenities'] = "<?php echo isset($request['area'])?base64_encode(json_encode($request['Amenities'])):''; ?>";
  data['nextlink'] = $('#nextLink').val();
  $.ajax({
    type: 'POST',
    url: WEB_URL + "/hotel/hotel_search",
    async: true,
    dataType: 'json',
    data: data,
    beforeSend: function() {
     $(".lodrefrentrev").fadeIn();
   },
   success: function(data) {
        $(data.result).insertAfter("ul.hotels li.HotelInfoBox:last");
   // $(".hotels").append(data.result);
    $(".lodrefrentrev").fadeOut();
    if(data.nextlink!=''){
      $('#nextLink').val(data.nextlink)
    }else{
      $('li.hotel_smore').hide();
    }
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
  }
});
}
function get_cancellation_policy(sid,hotelid,rate,rateplan,checkin,checkout,thisel)
{
  $.ajax({
    type: 'POST',
    url: WEB_URL+'/hotel/get_cancel_policy/'+sid+'/'+hotelid+'/'+rate+'/'+rateplan+'/'+checkin+'/'+checkout,
    data: '',
    async: true,
    dataType: 'json',
    beforeSend:function(){
      $(thisel).append('<img src="'+ASSETS+'/images/hotel_img_loading.gif">');
           //$(".lodrefrentrev").fadeIn();
    },
    success: function(data){
      $("#modal-123 .hotel_rules_con").html(data.hotel_rules_val1);
      $('#modal-123').modal('show');
           //$(".lodrefrentrev").fadeOut();
      $(thisel).find('img').remove();
    },
    error:function(request, status, error){
    }
  });
}
</script>