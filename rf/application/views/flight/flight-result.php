<script type="text/javascript">
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
  threshold : 20,
  effect : "fadeIn",
  skip_invisible : false
});
 $("img.lazy").each(function() {

  $(this).attr("src", $(this).attr("data-original"));
  $(this).removeAttr("data-original");
});
});
//$('img.lazy').lazyload();
//$(window).scroll();
</script>
<style type="text/css">
  ul.fs_filterform li{

        min-width: 80px !important;
    vertical-align: top;
  }
</style>
<div class="row">
  <div class="col-md-12">
    <div class="fullwidthbg_image">
      <img src="<?php echo ASSETS;?>images/FLIGHTS_SEARCH.svg" class="fs_bgimage visible-lg visible-md">         
      <img src="<?php echo ASSETS;?>images/FLIGHTS_SEARCH_sm.svg" class="fs_bgimage visible-sm">         
      <div class="fs_content color_white">
        <div class="float_lwidth">
          <div class="col-xs-4">
            <h5 class="fs_title"><?php echo lang_line('FILTER_RSLT');?></h5>
          </div>
          <?php if($request->type!='M'){ ?>
          <div class="col-xs-8">

            <ul class="list-inline text-right">
              <li>
                <h5><?php echo lang_line('DEPARTING');?> : <?php echo $request->depart_date; ?></h5>
              </li>
              <?php if($request->type=='R'){ ?>
              <li>
                <h5><?php echo lang_line('RETURNING');?> : <?php echo $request->return_date; ?></h5>
              </li>
              <?php } ?>
            </ul>
          </div>
        </div>
         <?php } ?>
        <div class="col-xs-12">
          <form class="form-inline flight_form search_filter">
            <ul class="list-inline fs_filterform">
             <?php if($request->type!='M'){ ?>
              <li>
                <select id="StopFilter" class="form-control full_width input_caretdown">                
                  <option value=""><?php echo lang_line('STOP');?></option>
                  <option value="All"><?php echo lang_line('ALL');?></option>
                </select>
              </li>
              <?php } ?>
              <?php if($request->type!='M'){ ?>
              <li>
               <div class="form-group col-xs-12 nopadd">
                <button type="button" class="btn dropdown-toggle btn-inbox" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <?php echo lang_line('TIMES');?>
               </button>
               <ul class="dropdown-menu well_bgwhite" id="time">
                <div class="well">
                  <div class="departure_time">
                    <p>  <?php if($request->type=='R'){ ?> <i class="fa fa-mail-forward"></i>    <?php } ?> <?php echo lang_line('DEP_TIME');?></p>
                    <div id="departure-filter" class="float_lwidth"></div>
                    <span class="time_left" id="min_departure"></span>
                    <span class="time_right" id="max_departure"></span>
                  </div>
                  <div class="arrival_time">
                 <?php if($request->type!='R'){ ?>
                    <p><?php echo lang_line('ARR_TIME');?></p>
                    <?php }else{ ?>
              <p> <i class="fa fa-mail-reply"></i> <?php echo lang_line('DEP_TIME');?></p>
                      <?php } ?>
                    <div id="arrival-filter" class="float_lwidth"></div>
                    <span class="time_left" id="min_arrival"></span>
                    <span class="time_right" id="max_arrival"></span>
                  </div>
                </div>
              </ul>
            </div>
          </li>
          <?php } ?>
          <?php if($request->type!='M'){ ?>
          <li>
           <div class="form-group col-xs-12 nopadd">
            <button type="button" class="btn dropdown-toggle btn-inbox" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo lang_line('DURATION');?>
            </button>
            <ul class="dropdown-menu well_bgwhite" id="duration">
              <div class="well">
                <div class="departure_time">
                  <p><?php echo lang_line('DURATION');?></p>
                  <div id="duration-filter" class="float_lwidth"></div>
                  <span class="time_left" id="min_duration"></span>
                  <span class="time_right" id="max_duration"></span>
                </div>

              </div>
            </ul>
          </div>
        </li>
        <?php } ?>
        <li>
          <div class="form-group col-xs-12 nopadd">
           <button type="button" class="btn dropdown-toggle btn-inbox" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo lang_line('PRICE');?>
          </button>
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
      <?php if($request->type!='M'){ ?>
      <li>

      <div class="button-group col-sm-12 nopadd ff_facilitydp">
                  <button type="button" class="btn dropdown-toggle btn-inbox" data-toggle="dropdown"><?php echo lang_line('AIRLINES');?></button>
                  <ul class="dropdown-menu ffdp_dp Airlines" id="Airlines">
                    <li class="col-sm-6 nopadd">
                      <label for="All">
                        <input name="AirlineFilter[]" id="All" type="checkbox" value="All"/><?php echo lang_line('ALL');?>
                      </label>
                    </li>
                  </ul>
                </div>


       
     </li>
     <?php } ?>
              <?php //if($request->type!='M'){ ?>
              <li class="sort_price">
                 <label><?php echo lang_line('SORT_ON');?></label>
                <select id="sortprice" onchange="SortbyPrice(this.value);" class="form-control input_caretdown">                
                  <option value=""><?php echo lang_line('PRICE');?></option>

                  <option value="LH"><?php echo lang_line('Low_To_High');?></option>
                  <option value="HL"><?php echo lang_line('High_To_Low');?></option>

                </select>
              </li>
              <?php //} ?>
     <li class="fs-button">
      <button type="button" class="btn btn-secondry btn_inputs" id="change_search"><?php echo lang_line('CHNGE_SEARCH');?></button>
    </li>
  </ul>
</form>
</div>
<div class="col-xs-12"><!-- adding col-xs-12 here is effecting in the result page of flight -->
  <ul class="fs_flightlist">
    <li>
      <ul class="list-inline flights">
    <?php 
  
     $disp_more_load_butt='';
    $data['flights']=$flights; 
    $data['request']  = $request;
    if($flights!=''){
       $disp_more_load=$more_results;
        if(isset($disp_more_load['MoreResults']) && $disp_more_load['MoreResults']=='true'){
      $disp_more_load_butt.=' <a href="javascript:void(0);" class="tshomor btn btn-primary loadings onclick"   data-request="'.base64_encode(json_encode($request)).'" data-type="'.$request->type.'" data-SearchId="'.$disp_more_load['SearchId'].'" data-ProviderCode="'.$disp_more_load['ProviderCode'].'">'.lang_line('SHOW_MORE').'</a>';
        }

			if(count($flights)>0){
			if($request->type=='O'){
			$this->load->view('flight/ajax_results', $data);
			}else if($request->type=='R'){
			$this->load->view('flight/ajax_results_round', $data);
			} else if($request->type=='M'){
			$this->load->view('flight/ajax_results_multi', $data);
			}
			}else{
   
    $this->load->view('flight/no_result');
    
  }

   }else{
   
    $this->load->view('flight/no_result');
    
  }
  ?>

      </ul>
    </li>
 
    
   
    <li class="col-sm-12 fs_singlefligh flight_smore">
              <div class="spacer20"></div>
              <div class="showmoreoption text-center">
            <?php   echo $disp_more_load_butt;?>
              
              </div>
           
 <?php 
    echo '<div id="errorMessage" style="text-align:center;display:none;" class="no_available">
    <h1>'.lang_line('FLIGHT_NOT_AVAIL').'</h1>
    <br><br>
    <div class="no_available_text">'.lang_line('FLIGHT_NOT_AVAIL_MSG').'<br></div>
    </div>'; // Error Message
  // print_r($Duration);
    ?>
    </li>
</ul>
</div>
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
  threshold : 20,
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
</script>