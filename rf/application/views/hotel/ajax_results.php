<?php
$ReferencePoint=(isset($Hotel_search_result['ReferencePoint']))?$Hotel_search_result['ReferencePoint']:'';
$accommodation_arr=array();$accommodation=array();$facilities=array();
if (!empty($Hotel_search_result['results'])) {
  $Hotel_search_result=$Hotel_search_result['results'];
  $totoal_hotel=count($Hotel_search_result);
  for ($i = 0; $i < $totoal_hotel; $i++) { 
   if($Hotel_search_result[$i]['MinimumAmount']!='Not Available'){
    $price[]=$Hotel_search_result[$i]['MinimumAmount'];
  }elseif($Hotel_search_result[$i]['MaximumAmount']!='Not Available'){
    $price[]=$Hotel_search_result[$i]['MaximumAmount'];
  }
  $hotel_distance[]=$Hotel_search_result[$i]['hotel_distance'];
  foreach($Hotel_search_result[$i]['Amenity_val'] as $accommodation_arr_val) {
    $accommodation_arr[]=$accommodation_arr_val;
  }
  ?> 
  <li class="col-sm-12 fs_singleflight  scroll HotelInfoBox" data-price="<?php echo ($Hotel_search_result[$i]['MinimumAmount']!='')?$this->account_model->currency_convertor($Hotel_search_result[$i]['MinimumAmount']):$this->account_model->currency_convertor($Hotel_search_result[$i]['MaximumAmount']);?>" data-hotel-name="<?php echo $Hotel_search_result[$i]['Name']; ?>" data-distance="<?php echo substr($Hotel_search_result[$i]['hotel_distance'],0,1);?>" data-address="<?php echo $Hotel_search_result[$i]['Address']; ?>">
    <ul class="list-inline hotel_singlehdetails">
      <?php $uniquid =  uniqid().$Hotel_search_result[$i]['HotelCode']; ?>
      <li id="<?php echo $uniquid; ?>" class="hs_image">
      </li>
      <li class="fs_airlinecontainer hotel_singlehname">
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><?php echo $Hotel_search_result[$i]['Name']; ?></span><br />
            <span class="fsa_departure"><?php echo $Hotel_search_result[$i]['Address']; ?></span>
          </div>
        </div>
        <?php
        $h_chain=$Hotel_search_result[$i]['HotelChain'];
        $h_code=$Hotel_search_result[$i]['HotelCode'];
        $city_code=$request['city_code'];
        $h_check_out=$request['check_out'];
        $h_check_in=$request['check_in'];
        $adult=$request['adult'];
        $child=$request['child'];
        $rooms=$request['rooms'];
        $all_hotel_results=helper_get_room_details($h_chain,$h_code,$city_code,$h_check_in,$h_check_out,$adult,$child,$rooms);
        $all_hotel_details=json_decode($all_hotel_results);
        $onclick="get_via_ajax('".$h_chain."','".$h_code."','".$city_code."','".$h_check_in."','".$h_check_out."','".$adult."','".$child."','".$rooms."','".$uniquid."',this)";
        ?>
        <div class="spacer"></div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"><?php echo ($Hotel_search_result[$i]['hotel_distance']!='')?$Hotel_search_result[$i]['hotel_distance']." from Airport (".ucfirst(strtolower($ReferencePoint)).")":""; ?></span><br />
            <span class="fsa_departure spanover" onclick="<?php echo $onclick;?>"><?php echo $all_hotel_details->Hotel_room_count;?> <?php echo lang_line('Extra_room_types');?></span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure hotel_singlehdeparture">
        <ul class="hotelpreferences allamn hotel_preferances">
          <?php 
          for($p=0;$p<count($Hotel_search_result[$i]['Amenity_val']);$p++)        {
            $name_am = $this->Hotel_Model->getam_name($Hotel_search_result[$i]['Amenity_val'][$p])->row();
            ?>
            <li  title="<?php echo $name_am->universal_api_description; ?>" data-toggle="tooltip" data-placement="bottom"  class="hotel-<?php echo strtolower($Hotel_search_result[$i]['Amenity_val'][$p]); ?>"></li>
            <?php 
          } ?>
        </ul>
        <ul class="list-inline">        
          <li class="hotel_shddetails mar0">
            <div class="col-sm-6 cursor-point">
              <?php echo $Hotel_search_result[$i]['ParticipationLevel']; ?>  
            </div>
            <div class="col-sm-6 nopadd">
              <img src="<?php echo ASSETS."images/IMAGE.svg";?>" class="hsd_gallerypopicon">
              <div id="<?php echo $uniquid; ?>SL"  class="animated-thumbnials moreimg">              
                <a class="more_pic" href="javascript:;" data-src="<?php echo ASSETS."images/hotel_pg.jpg";?>"><?php echo lang_line('MORE_PICTURES');?></a>
              </div>            
            </div>
            <script>
            $(document).ready(function() {
              $.ajax({
                type: 'POST',
                url: WEB_URL+'/hotel/get_hotel_images/<?php echo $h_chain; ?>/<?php echo $h_code; ?>',
                data: '',
                async: true,
                dataType: 'json',
                beforeSend: function() {
                  $("#<?php echo $uniquid; ?>").html('<img  src="'+ASSETS+'/images/hotel_img_loading.gif">');
                  $("#<?php echo $uniquid; ?>").fadeIn();
                },
                success: function(data) {
                  var template='';
                  var html123 = '<img alt="hotel Imge" src="'+data.result.hotel_single_image+'" />';
                  var thumb = '<img style="display:none;" width="0" height="0" src="'+data.result.hotel_single_image+'" />';
                  $("#<?php echo $uniquid; ?> img").remove();
                  $("#<?php echo $uniquid; ?>").html(html123);
                  $("#<?php echo $uniquid; ?>SL a.more_pic").attr("data-src",data.result.hotel_single_image);
                  $("#<?php echo $uniquid; ?>SL a.more_pic").html("<?php echo lang_line('MORE_PICTURES');?>"+thumb);
                  $("#<?php echo $uniquid; ?>POP a.more_pic").attr("data-src",data.result.hotel_single_image);
                  $("#img<?php echo $uniquid;?>").attr("src",data.result.hotel_single_image);
                  $("#<?php echo $uniquid; ?>POP a.more_pic").html("<?php echo lang_line('MORE_PICTURES');?>"+thumb);
                  $.each(data.result.hotel_all_images, function( key, value ) {
                    var thumb1 = '<img style="display:none;" width="0" height="0" src="'+value[1]+'" />';
                    template+='<a data-src="'+value[1]+'" title="'+value[0]+'" >'+thumb1+'</a>';
                  });
                  $(template).insertAfter("#<?php echo $uniquid; ?>SL a.more_pic");
                  $(template).insertAfter("#<?php echo $uniquid; ?>POP a.more_pic");
                  $( ".fs_title" ).trigger('click'); 
                }, 
              }); 
});
</script>
</li>
</ul>
</li> 
<li class="fs_airlinecontainer fs_book hotel_singlehbook">
  <div class="fs_airline">
    <div class="fs_values">
      <div class="col-xs-6 nopadd">
        <span class="fsa_airlinename"> 
          <?php 
          if($Hotel_search_result[$i]['MinimumAmount']!='Not Available')
          {
            ?>
            <span class="curr_icon"><?php echo $this->display_icon;?></span><span class="amount"><?php echo $this->account_model->currency_convertor($Hotel_search_result[$i]['MinimumAmount']);?></span>
            <?php
          }elseif($Hotel_search_result[$i]['MaximumAmount']!='Not Available'){ ?>
          <span class="curr_icon"><?php echo $this->display_icon;?></span><span class="amount"><?php echo $this->account_model->currency_convertor($Hotel_search_result[$i]['MaximumAmount']);?></span>
          <?php }else
          {
            echo '<span class="amount hsb_notavailable">Not Available</span>';
          }
          ?>
        </span><br />  
        <span class="fsa_departure">
          <?php echo $request['days'];?> <?php echo lang_line('NIGHTS');?>
        </span>
      </div>
      <div class="col-xs-6 nopadd">
        <span>
          <?php if($all_hotel_details->hotel_rating!=''){?>
          <input id="input-21e" value="<?php echo ($all_hotel_details->hotel_rating!='')?$all_hotel_details->hotel_rating:1;?>" type="number" class="rating hsb_starrating" min="0" max="5" step="5" data-size="xs" >  
          <?php }else{
            echo "<a>N/A</a>";
          } ?>
        </span>
      </div>
    </div>
  </div>
  <div class="spacer"></div>
  <div class="fs_airline">
    <div class="fs_values">
     <button type="button" data-id="collapse<?php echo $uniquid;?>" data-toggle="modal"  onclick="<?php echo $onclick;?>"  class="go-top btn btn-primary btn_inputs"><?php echo lang_line('SELECT');?></button>
   </div>
 </div>
</li>
<!-- Modal hotel details -->
<div class="modal fade bs-example-modal-lg hotelmodal_design"  id="collapse<?php echo $uniquid;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modalcontainer2">
        <div class="">
          <button type="button" class="close stick_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body hotel_detmodal ">          
          <div class="col-xs-12 col-md-3 hmd_modalright">
            <div class="hdm_container">
              <img style="width:100%" id="img<?php echo $uniquid;?>" src="assets/images/tripadvisor.svg">
              <div class="spacer20"></div>
              <img src="<?php echo ASSETS."images/IMAGE.svg";?>" class="hsd_gallerypopicon">
              <div id="<?php echo $uniquid; ?>POP" class="animated-thumbnials">
                <a class="more_pic" href="javascript:;" data-src="<?php echo ASSETS."images/hotel_pg.jpg";?>">
                  <?php echo lang_line('MORE_PICTURES');?>
                </a>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-md-9 nopadd hmd_modalleft collapse<?php echo $uniquid;?> ">
          </div>
          <div class="col-xs-12 nopadd detailtab">
            <div class="get_rooms<?php echo $uniquid;?>"></div>
            <div class="col-xs-12 padd_l sm3paddr0 hm_facilities">
              <button class="btn btn-primary btn_transparent" type="button" data-toggle="collapse" data-target="#collapseFaci<?php echo $uniquid;?>" aria-expanded="false" aria-controls="collapseExample">
                <span class="btn_text">
                  <i class="fa fa-plus-square"></i>
                  <i class="fa fa-minus-square"></i> <?php echo lang_line('FACILITIES');?>
                </span>
                <span><?php echo lang_line('GREAT_FACILITIES');?>  Review score, 8.8</span>
              </button>
              <div class="collapse" id="collapseFaci<?php echo $uniquid;?>">
                <div class="well">
                  <div class="form-group col-xs-12 sm3paddr0 padd_l">
                   <ul class="hotelpreferences allamn hotel_preferances">
                    <?php
                    for($p=0;$p<count($Hotel_search_result[$i]['Amenity_val']);$p++)        {
                      $name_am = $this->Hotel_Model->getam_name($Hotel_search_result[$i]['Amenity_val'][$p])->row();
                      ?>
                      <li  title="<?php echo $name_am->universal_api_description; ?>" class="hotel-<?php echo strtolower($Hotel_search_result[$i]['Amenity_val'][$p]); ?>"></li>
                      <?php
                    }
                    ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Modal hotel details -->
</ul>
</li>
<?php }
 $Facilities = array_unique($accommodation_arr); //Creating Unique facilities
  $hotel_distances = array_unique($hotel_distance); //Creating Unique facilities
}?>
<script type="text/javascript">
  $(function() {

  $( 'ul.hotel_accdsform .Facilities li label' ).on( 'click', function( event ) {   
  $( event.target ).blur();
 $('ul.hotel_accdsform div.ff_facilitydp').addClass('open');  

});
});

<?php if($request['min_price']!='' && $request['max_price']!=''){ ?>
  showFlights(<?php echo $request['min_price'];?>, <?php echo $request['max_price'];?>);
  <?php } ?>
  function showFlights(minPrice, maxPrice) {
    $("ul.hotels li.HotelInfoBox").hide().filter(function() {
      var price = $(this).find("span.amount").html();
      var price = parseFloat(price);
      console.log(price+' >= '+minPrice+' && '+price+' <= '+maxPrice);
      return price >= minPrice && price <= maxPrice;
    }).show();
  }
  $(function() {
    $( "#price-filter" ).slider({
      range: true,
      min: <?php echo $this->account_model->currency_convertor(min($price))?>,
      max: <?php echo $this->account_model->currency_convertor(max($price))?>,
      values: [ <?php echo $this->account_model->currency_convertor(min($price))?>, <?php echo $this->account_model->currency_convertor(max($price))?> ],
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
    var $filters = $("input:checkbox[name='Facilities[]']");
    var $categoryContent = $('ul.hotels li.HotelInfoBox'); // Path for flights
    var $errorMessage = $('#errorMessage'); //Error Message
    $filters.on('click', function(){
    $categoryContent.hide(); // if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
    var $selectedFilters = $filters.filter(':checked');
    if ($selectedFilters.length > 0) {
      $errorMessage.hide();
      $selectedFilters.each(function (i, el) {
        var $selected = el.value.toLowerCase();
       
        if($selected=='all'){
          $('ul.hotels li.HotelInfoBox').show();
        }else if($selected!='all'){
         $('ul.hotelpreferences li[class="hotel-'+ $selected +'"]').closest('ul.hotels li.HotelInfoBox').show();
       } else {

      $errorMessage.show();
    }
     });
    } else {

       $('ul.hotels li.HotelInfoBox').show();
    }
  });
    $("#Distance").on('change', function(){
    $categoryContent.hide(); // if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
    var $get_value = $(this).val();
    var $selectedFilters1 = $get_value;  
    if ($selectedFilters1=='All' || $selectedFilters1=='') {
      $errorMessage.hide();
      $('ul.hotels li.HotelInfoBox').show();
    }else if($selectedFilters1!='All' && $selectedFilters1!=''){
     $errorMessage.hide();
     $('ul.hotels li.HotelInfoBox[data-distance="'+ $selectedFilters1 +'"]').show();
   }
 });
    $('ul#Facilities li:last').after('<?php $i=1;foreach($Facilities as $facilitie){?> <li class="col-sm-6 nopadd"><label for="<?php echo stripslashes($facilitie);?>"><input name="Facilities[]" type="checkbox" id="<?php echo stripslashes($facilitie);?>" value="<?php echo stripslashes($facilitie);?>"/><?php $name_am=$this->Hotel_Model->getam_name($facilitie)->row(); echo ($name_am->universal_api_description!='')?stripslashes($name_am->universal_api_description):''; ?> </label></li><?php $i++; }?>');
    $('#Distance option:last').after('<?php $i=1;foreach($hotel_distances as $hotel_distance){?><option value="<?php echo substr($hotel_distance,0,1);?>" ><?php  echo $hotel_distance; ?> </option><?php $i++; }?>');
  });
</script>