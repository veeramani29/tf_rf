<script src="<?php echo ASSETS;?>js/star-rating.js"></script>
<div class="row">
  <div class="col-md-12">
    <div class="fullwidthbg_image hotelsearch_page">
      <img src="<?php echo ASSETS;?>images/FLIGHTS_SEARCH.svg" class="fs_bgimage">        
      <div class="fs_content color_white">
        <div class="float_lwidth">
          <div class="col-xs-3">
            <h5 class="fs_title"><?php echo lang_line('FILTER_RSLT');?></h5>
          </div>
          <div class="col-xs-9">
            <ul class="list-inline text-right">
              <li>
                <h5>
                  <?php echo lang_line('PICK_UP_DATE');?> : <?php echo date("d<\s\up>S</\s\up> M Y H:i",strtotime($req->depart_date." ".$req->depart_time.":".$req->depart_min));?>
                </h5>
              </li>
              <li>
                <h5>
                  <?php echo lang_line('DROP_OFF_DATE');?> : <?php echo date("d<\s\up>S</\s\up> M Y H:i",strtotime($req->return_date." ".$req->return_time.":".$req->return_min)); ?>
                </h5>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-xs-12">
          <form class="form-inline flight_form search_filter">
            <ul class="list-inline fs_filterform hotel_accdsform car_accdsform">
              <li>              
                <select id="Car_Category" data="category" class="form-control input_caretdown">
                  <option value=""><?php echo lang_line('CAR_CATEGORY');?></option>
                  <option value="All"><?php echo lang_line('ALL');?></option>
                </select>
              </li>
              <li>
                <select id="Door_Count" data="door" class="form-control input_caretdown">                
                  <option value=""><?php echo lang_line('DOOR_COUNT');?></option>
                  <option value="All"><?php echo lang_line('ALL');?></option>
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
                <select id="Transmission" data="trans" class="form-control full_width input_caretdown">
                  <option value=""><?php echo lang_line('TXMN');?></option>
                  <option value="All"><?php echo lang_line('ALL');?></option>
                </select>
              </li>
              <li>
                <select id="Vehicle_Class" data="vehicleclass" class="form-control full_width input_caretdown">                
                  <option><?php echo lang_line('VEHICLE_CLASS');?></option>
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
                <button type="button" class="btn btn-secondry btn_inputs" id="change_search">
                  <?php echo lang_line('CHNGE_SEARCH');?>
                </button>
              </li>
            </ul>
          </form>
        </div>
        <div class="col-sm-12">
          <ul class="fs_flightlist ">
           <li>
              <ul class="list-inline vehicles">
            <?php 
            $data['cars'] = $cars;
            $nextlink='';
            if(isset($cars[0]['NextResultReference'])){
              //print_r($cars[0]);
              $nextlink=$cars[0]['NextResultReference'];
            }
            $data['request']  = $request;
            $data['req']  = $req;
            if(isset($cars) && $cars!=''){
              $this->load->view('car/ajax_result', $data);
            }else{
              $this->load->view('car/no_result');
            }
            ?>
          </ul>
          </li>
          <?php if($nextlink!=''){ ?>
            <li class="col-sm-12 fs_singlefligh car_smore">
              <div class="spacer20"></div>
              <div class="showmoreoption text-center">
                <input type="hidden" id="nextLink" value="<?php echo isset($nextlink)?$nextlink:''; ?>" />
                <a href="javascript:void(0);" class="tshomor btn btn-primary" onClick="more_cars();" ><?php echo lang_line('SHOW_MORE');?> </a>
              </div>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="cardets" tabindex="-1" role="dialog" aria-labelledby="cardetsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" ><?php echo lang_line('VEHICLE_DETAILS');?></h4>
      </div>
      <div class="modal-body vehicledetail">
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<script type="text/javascript">
function SortbyPrice(type){
  alert(type)
 if (type == 'LH') {
  $('li.vehicleInfoBox').not('.vehicles script').map(function () {
   return {val: parseFloat($(this).data('price')), el: this};
 }).sort(LH).map(function () {
   return this.el;
 }).appendTo('.vehicles');
}else{
  $('li.vehicleInfoBox').not('.vehicles script').map(function () {
   return {val: parseFloat($(this).data('price')), el: this};
 }).sort(HL).map(function () {
   return this.el;
 }).appendTo('.vehicles');
}
}
function HL(a, b) {
  return b.val - a.val;
}
function LH(a, b) {
  return a.val - b.val;
}

function more_cars()
{

  var data={};
  data['next_request'] = "<?php echo $request; ?>";
  
  data['nextlink'] = $('#nextLink').val();
  $.ajax({
    type: 'POST',
    url: WEB_URL + "/car/car_search",
    async: true,
    dataType: 'json',
    data: data,
    beforeSend: function() {
     $(".lodrefrentrev").fadeIn();
   },
   success: function(data) {

    $(data.result).insertAfter("ul.vehicles li.vehicleInfoBox:last");
    $("ul.vehicles li.vehicleInfoBox").show();
    $('script.remove:first').remove();
    $('div.no_available:first').remove();
   $(".lodrefrentrev").fadeOut();
   


   if(data.nextlink!=''){
      $('#nextLink').val(data.nextlink);
    }else{
      $('#nextLink').val(data.nextlink)
      $('li.car_smore').hide();
    }

   
    
    
   
   
  }
});
}


$(document).ready(function(){
 $(document).on("click", ".onreqst", function (el) {
  var attr = $(this).data('attr');
  console.log(attr);
  $.ajax({
    type:'GET', 
    url: WEB_URL+'/car/GetDetails',
    data: $("#"+attr).serialize(),
    dataType: "json",
    beforeSend: function() {
      $('a[data-attr="'+attr+'"]').append('<img class="loading" src="'+ASSETS+'/images/ajax_loader1.gif" style="height:20px;"></img>');
    },
    success: function(response) {
      if(response.status == 1){
        $('div.vehicledetail').html(response.detail);
        $('#cardets').modal('show');
        $('a[data-attr="'+attr+'"]').find('img').empty();
        $('a[data-attr="'+attr+'"]').find('img').remove();
      }
    }
  });
});
});
$(document).ready(function(){
 $('.allamn li').tooltip();
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
});
</script>