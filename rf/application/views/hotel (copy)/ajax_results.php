<?php 
 //echo "<pre>";
 //print_r(json_encode($request));
$nextlink=(isset($Hotel_search_result['nextlink']))?$Hotel_search_result['nextlink']:'';
$accommodation_arr=array();$accommodation=array();$facilities=array();
if (!empty($Hotel_search_result['results'])) {
  $Hotel_search_result=$Hotel_search_result['results'];
  

  $totoal_hotel=count($Hotel_search_result);
  for ($i = 0; $i < $totoal_hotel; $i++) { 

   if($Hotel_search_result[$i]['MinimumAmount']!='Not Available'){
    $price[]=$Hotel_search_result[$i]['MinimumAmount'];
  }

  foreach($Hotel_search_result[$i]['Amenity_val'] as $accommodation_arr_val) {
    $accommodation_arr[]=$accommodation_arr_val;
  }
  ?> 

  <li class="col-sm-12 fs_singleflight  scroll HotelInfoBox" data-hotel-name="<?php echo $Hotel_search_result[$i]['Name']; ?>" data-address="<?php echo $Hotel_search_result[$i]['Address']; ?>">
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
        <div class="spacer"></div>
        <div class="fs_airline">
          <div class="fs_values">
            <span class="fsa_airlinename"> <?php echo $Hotel_search_result[$i]['ParticipationLevel']; ?>  <?php echo ($Hotel_search_result[$i]['HotelTransportation']!='')?" |".$Hotel_search_result[$i]['HotelTransportation']:""; ?></span><br />
            <span class="fsa_departure">ReserveRequirement : <?php echo $Hotel_search_result[$i]['ReserveRequirement']; ?></span>
          </div>
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure hotel_singlehdeparture">

      <?php

       $h_chain=$Hotel_search_result[$i]['HotelChain'];
     $h_code=$Hotel_search_result[$i]['HotelCode'];
     $city_code=$request['city_code'];
     $h_check_out=$request['check_out'];
     $h_check_in=$request['check_in'];
     $adult=$request['adult'];
     $child=$request['child'];

     $rooms=$request['rooms'];
     $all_hotel_results=$this->Hotel_Model->helper_get_room_details($h_chain,$h_code,$city_code,$h_check_in,$h_check_out,$adult,$child,$rooms);
    $all_hotel_details=json_decode($all_hotel_results);
    
    $each_roomdetails=$all_hotel_details->hotel_rooms_details;

      
      ?>
       <ul class="hotelpreferences allamn">
        <?php
        for($p=0;$p<count($Hotel_search_result[$i]['Amenity_val']);$p++)        {
          $name_am = $this->Hotel_Model->getam_name($Hotel_search_result[$i]['Amenity_val'][$p])->row();
          ?>
          <li  title="<?php echo $name_am->universal_api_description; ?>" class="hotel-<?php echo strtolower($Hotel_search_result[$i]['Amenity_val'][$p]); ?>"></li>
          <?php
        }
        ?>
      </ul>

      <ul class="list-inline">        
        <li class="hotel_shddetails mar0">
          <div class="col-sm-6 cursor-point">
            <b><?php echo $all_hotel_details->Hotel_room_info;?></b> Available at this price
          </div>
          <div class="col-sm-6 nopadd">
            <img src="assets/images/IMAGE.svg" class="hsd_gallerypopicon">
            <div id="<?php echo $uniquid; ?>SL"  class="animated-thumbnials moreimg">              
              <a class="more_pic" href data-src="<?php echo ASSETS."images/hotel_pg.jpg";?>">Click here for more pictures</a>
            </div>            
          </div>


          <script>
          $(document).ready(function() {
            $.ajax({
              type: 'POST',
              url: "<?php echo WEB_URL; ?>/hotel/get_hotel_images/<?php echo $Hotel_search_result[$i]['HotelChain']; ?>/<?php echo $Hotel_search_result[$i]['HotelCode']; ?>",
              data: '',
              async: true,
              dataType: 'json',
              beforeSend: function() {
                $("#<?php echo $uniquid; ?>").html('<img src="'+ASSETS+'/images/hotel_img_loading.gif">');
                $("#<?php echo $uniquid; ?>").fadeIn();
              },
              success: function(data) {

               var template='';
               var html123 = '<img src="'+data.result.hotel_single_image+'" />';
               var thumb = '<img style="display:none;" width="0" height="0" src="'+data.result.hotel_single_image+'" />';
               $("#<?php echo $uniquid; ?> img").remove();
               $("#<?php echo $uniquid; ?>").html(html123);
               $("#<?php echo $uniquid; ?>SL a.more_pic").attr("data-src",data.result.hotel_single_image);
               $("#<?php echo $uniquid; ?>SL a.more_pic").html("Click here for more pictures"+thumb);


               $("#<?php echo $uniquid; ?>POP a.more_pic").attr("data-src",data.result.hotel_single_image);
               $("#img<?php echo $uniquid;?>").attr("src",data.result.hotel_single_image);
               $("#<?php echo $uniquid; ?>POP a.more_pic").html("Click here for more pictures"+thumb);



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
      <div class="col-sm-6 nopadd">
        <span class="fsa_airlinename">  <?php 
        if($Hotel_search_result[$i]['MinimumAmount']!='Not Available')
        {
          ?>
          <span class="curr_icon"><?php echo $this->display_icon;?></span><span class="amount"><?php echo $this->account_model->currency_convertor($Hotel_search_result[$i]['MinimumAmount']);?></span>
          <?php
        }
        else
        {
          echo '<span class="amount hsb_notavailable">Not Available</span>';
        }
        ?></span><br />  
        <span class="fsa_departure"><?php echo $request['days'];?> Nights</span>
      </div>
      <div class="col-sm-6 nopadd">
        <span>
         <!-- <img src="<?php echo ASSETS;?>/images/tripadvisor.svg" class="hsb_tripadvisor">-->
          <input id="input-21e" value="1" type="number" class="rating hsb_starrating" min="0" max="5" step="1" data-size="xs" >  
        </span>
       <!-- <span class="fsa_departure">10 Reviews</span>-->
      </div>
    </div>
  </div>
  <div class="spacer"></div>
  <div class="fs_airline">
    <div class="fs_values">
     <?php
    
     $onclick="get_via_ajax('".$h_chain."','".$h_code."','".$city_code."','".$h_check_in."','".$h_check_out."','".$adult."','".$child."','".$rooms."','".$uniquid."',this)";
     ?>
     <button type="button" data-toggle="modal" data-target="#collapse<?php echo $uniquid;?>" class="btn btn-primary btn_inputs"  >Select</button>
   </div>
 </div>
</li>


<!-- Modal hotel details -->
<div class="modal fade bs-example-modal-lg"  id="collapse<?php echo $uniquid;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modalcontainer2">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <div class="rf_modaltitle">Hotel Details</div>
        </div>
        <div class="modal-body hotel_detmodal ">
          <div class="col-sm-9 nopadd collapse<?php echo $uniquid;?>"> </div>

          <div class="col-sm-3">
            <img style="width:200px" id="img<?php echo $uniquid;?>" src="assets/images/tripadvisor.svg">
            <div class="spacer20"></div>
            <div id="<?php echo $uniquid; ?>POP" class="animated-thumbnials">
              <a class="more_pic" href data-src="<?php echo ASSETS."images/hotel_pg.jpg";?>">Click here for more pictures</a>
            </div>
          </div>
          <div class="col-sm-12 nopadd detailtab">
            <div class="get_rooms<?php echo $uniquid;?>"><?php echo $each_roomdetails;?></div>
            <div class="col-xs-9 padd_l sm3paddr0 sm2paddr0 hm_facilities">
              <button class="btn btn-primary btn_transparent" type="button" data-toggle="collapse" data-target="#collapseFaci<?php echo $uniquid;?>" aria-expanded="false" aria-controls="collapseExample">
                <span class="btn_text"><i class="fa fa-plus-square"></i> Facilities</span><span>Great facilities! Review score, 8.8</span>
              </button>
              <div class="collapse" id="collapseFaci<?php echo $uniquid;?>">
                <div class="well">
                  <div class="form-group col-xs-12 sm3paddr0 padd_l">
                   <ul class="hotelpreferences allamn">
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
           <!-- <div class="col-sm-2 pull-right">
              <button type="submit" class="btn btn-secondry btn_inputs full_width">Book Now</button>
            </div>-->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal hotel details -->


</ul>
</li>
<?php
}

$firsthalf = array_slice($accommodation_arr, 0, ceil(count($accommodation_arr)) / 2);
$secondhalf = array_slice($accommodation_arr, ceil(count($accommodation_arr)) / 2);
 $Accommodations = array_unique($firsthalf);  //Creating Unique accommodation
 $Facilities = array_unique($secondhalf); //Creating Unique facilities


}
if($nextlink!=''){
  ?>

  <li class="col-sm-12 fs_singlefligh hotel_smore">
    <div class="spacer20"></div>
    <div class="showmoreoption text-center">
      <a href="javascript:void(0);" class="tshomor btn btn-primary" onClick="more_hotels();" >Show more </a>
    </div>
  </li>

  <?php 
}
echo '<div id="errorMessage" style="text-align:center;display:none;" class="no_available">
<h1>'.lang_line('LINE060').'</h1>
<br><br>
<div class="no_available_text">'.lang_line('LINE061').'<br></div>
</div>'; 
?>





<script type="text/javascript">

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

    var arr=[];

    $( "li.HotelInfoBox" ).each(function() {
      var hotel_name=$(this).attr("data-hotel-name");
        //var address=$(this).attr("data-address");
        arr.push(hotel_name);
      });
    var MapsSource = $('#google-map').attr('data-src');
    
    var MapsSource =MapsSource+'&HotelAddress='+encodeURI(JSON.stringify(arr));

    $('#google-map').attr('data-src',MapsSource);




//price filter

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
//alert(one+'-'+two);
showFlights(one, two);

}
});
$('#min_price').text(CURR_ICON+ $( "#price-filter" ).slider( "values", 0 ));
$('#max_price').text(CURR_ICON+ $( "#price-filter" ).slider( "values", 1 ) );



var $filters = $("#Accommodations,#Facilities"); // start all checked
var $categoryContent = $('ul.hotels li.HotelInfoBox'); // Path for flights

var $errorMessage = $('#errorMessage'); //Error Message

$filters.on('change', function(){
  $categoryContent.hide(); // if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
  var $get_value = $(this).val();
  var $selectedFilters = $get_value.toLowerCase();
  
  if ($selectedFilters=='All' || $selectedFilters=='') {
    $errorMessage.hide();
//$selectedFilters.each(function (i, el) {//});

$('ul.hotels li.HotelInfoBox').show();
}else if($selectedFilters!='All' && $selectedFilters!=''){
 $errorMessage.hide();
 
 $('ul.hotelpreferences li[class="hotel-'+ $selectedFilters +'"]').closest('ul.hotels li.HotelInfoBox').show();
}
});


$('#Accommodations option:last').after("<?php $i=1;foreach($Accommodations as $accom){?><option value='<?php echo $accom;?>' ><?php $name_am=$this->Hotel_Model->getam_name($accom)->row(); echo stripslashes($name_am->universal_api_description);  ?></option><?php $i++; }?>");       
$('#Facilities option:last').after("<?php $i=1;foreach($Facilities as $facilitie){?><option value='<?php echo $facilitie;?>' ><?php $name_am=$this->Hotel_Model->getam_name($facilitie)->row(); echo stripslashes($name_am->universal_api_description); ?> </option><?php $i++; }?>");
});




</script>    
