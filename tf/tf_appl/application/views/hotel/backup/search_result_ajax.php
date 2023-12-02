<?php
//CRS Starts Here
if($nextlink_set == '')
{
 $hotel_crs = $this->Hotel_Model->getCRSHotels($_POST['city_code']);

if (empty($Hotel_search_result) && empty($hotel_crs)) {?>
    <div class="srywrap"><span class="sorrydiv"><img src="<?php echo ASSETS; ?>images/sorry.png" alt=""></span><b>Nothing here! No Hotel Found!..</b></div>
<?php } ?>

<?php if (!empty($hotel_crs)) { foreach ($hotel_crs as $key => $hotel) {?>

<?php 
    $roomss = $this->Hotel_Model->getCRSRooms($hotel->sup_hotel_id)->result();
	 $hotel_amentites = $this->Hotel_Model->gethotel_amentities($hotel->sup_hotel_id)->result();
    foreach ($roomss as $key => $room) { 
        $NightlyRent =  $this->Hotel_Model->getPeriods($room->room_id)->result();
        //echo '<pre>';print_r($periods);exit;
        foreach ($NightlyRent as $key => $value) {
           $aprice[] = $value->per_adult;
        }
        $price[] = min($aprice);
    }
    $min_price = min($price);
    $aMarkup = $this->account_model->get_markup('HOTEL CRS'); //get markup
    $aMarkup = $aMarkup['markup'];
    $MyMarkup = $this->account_model->get_my_markup(); //get agent markup
    $myMarkup = $MyMarkup['markup'];
    $min_price = $this->account_model->PercentageToAmount($min_price,$aMarkup);
    $data['MyMarkup'] = $this->account_model->PercentageAmount($min_price,$myMarkup);
    $min_price = $this->account_model->PercentageToAmount($min_price,$myMarkup);
?>
    <div class="searchhotel_box">      
        <div class="offset-0 scroll HotelInfoBox" id="scroll1" data-hotel-name="<?php echo $hotel->hotel_name; ?>" data-address="<?php echo $hotel->address; ?>">
            <div class="col-md-4 min-4 offset-0">
                <div class="listitem2">
                    <?php $uniquid =  uniqid().$hotel->crs_id; ?>
                    <div id="<?php echo $uniquid; ?>">
                    <?php $images = $this->Hotel_Model->getCRSImages($hotel->sup_hotel_id)->result();?>
                    <?php foreach ($images as $key => $image) {?>
                        <img src="<?php echo $image->url;?>" />
                    <?php break;}?>                        
                    </div>              
                </div>
            </div>
            <div class="col-md-8 min-8 offset-0">
                <div class="itemlabel3">
                    <div class="labelright col-md-3  textaligncntr">
                       <!-- <img src="<?php echo ASSETS; ?>images/filter-rating-5.png" width="60" alt=""/><br/><br/><br/>
                        <img src="<?php echo ASSETS; ?>images/user-rating-5.png" width="60" alt=""/><br/>
                        <span class="size11 grey">18 Reviews</span><br/><br/>--><br/><br/>
                        <span class="green size18">
                        <span class="amount">
                            <span class="curr_icon"><?php echo $this->display_icon;?></span>
                            <span class="amount"><?php echo $this->account_model->currency_convertor($min_price);?></span>
                        </span>
                        
                       <!-- <b> </b>--></span><br/>
                        <span class="size11 grey">Min Price</span><br/><br/><br/>
                        <a  href="<?php echo WEB_URL; ?>/hotel/hotel_details?sid=<?php echo $hotel->hotel_chain_name; ?>&hotelid=<?php echo $hotel->sup_hotel_id; ?>&checkin=<?php echo $check_in; ?>&checkout=<?php echo $check_out; ?>&city_code=<?php echo $city_code; ?>&adult=<?php echo $adult; ?>&room_count=<?php echo $rooms; ?>&type=<?php echo base64_encode(base64_encode('CRS')); ?>">
                            <button class="booknowhtl">Check Availabilty</button>   
                        </a>        
                    </div>
                    <div class="labelleft2 col-md-9 offset-0">          
                        <b><?php echo $hotel->hotel_name; ?></b>
                        <span class="htlplace"><?php echo $hotel->address; ?> </span>
                        <p class="grey"></p>
                        <br/>
                        <ul class="hotelpreferences allamn">
                             <?php
					for($p=0;$p<count($hotel_amentites);$p++)				{
						
					?>
                    <li  title="<?php echo $hotel_amentites[$p]->universal_api_description; ?>" class="hotel-<?php echo strtolower($hotel_amentites[$p]->universal_api_code); ?>"></li>
                    <?php
					}
					?>
                            
                            
                            
                            
                            
         

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } }

}
?>

<?php 

if (!empty($Hotel_search_result)) {
    for ($i = 0; $i < count($Hotel_search_result); $i++) {
        ?>   
        <div class="searchhotel_box">      
        <div class="offset-0 scroll HotelInfoBox" id="scroll1" data-hotel-name="<?php echo $Hotel_search_result[$i]['Name']; ?>" data-address="<?php echo $Hotel_search_result[$i]['Address']; ?>">
        <div class="col-md-4 min-4 offset-0">
            <div class="listitem2">
				<?php $uniquid =  uniqid().$Hotel_search_result[$i]['Code']; ?>
                <div id="<?php echo $uniquid; ?>">
					
                </div>				
            </div>
        </div>

        <script>
            /*$.ajax({
                type: 'POST',
                url: '<?php echo WEB_URL; ?>/hotel/get_single_hotel_images/<?php echo $Hotel_search_result[$i]['HotelChain']; ?>/<?php echo $Hotel_search_result[$i]['Code']; ?>',
                        data: '',
                        async: true,
                        dataType: 'json',
                        beforeSend: function() {
                            $("#<?php echo $uniquid; ?>").html('<div class="lodrefrentrev imgLoader"><div class="centerload"></div></div>');
                            $("#<?php echo $uniquid; ?> .lodrefrentrev").fadeIn();
                        },
                        success: function(data) {
							var html123 = '<img src="'+data.result+'" />';
                            $("#<?php echo $uniquid; ?>").html(html123);
                        },
                    });*/
        </script>

        <div class="col-md-8 min-8 offset-0">
            <div class="itemlabel3">
                <div class="labelright col-md-3  textaligncntr">
                   <!-- <img src="<?php echo ASSETS; ?>images/filter-rating-5.png" width="60" alt=""/><br/><br/><br/>
                    <img src="<?php echo ASSETS; ?>images/user-rating-5.png" width="60" alt=""/><br/>
                    <span class="size11 grey">18 Reviews</span><br/><br/>--><br/><br/>
                    <span class="green size18">
                    <?php 
					if($Hotel_search_result[$i]['MinPrice']!='Not Available')
					{
						?>
                    <span class="curr_icon"><?php echo $this->display_icon;?></span><span class="amount"><?php echo $this->account_model->currency_convertor( $Hotel_search_result[$i]['MinPrice']);?></span>
                    <?php
					}
					else
					{
					echo '<span class="amount">Not Available</span>';
					}
					?>
                    
                   <!-- <b> </b>--></span><br/>
                    <span class="size11 grey">Min Price</span><br/><br/><br/>
                    <a  href="<?php echo WEB_URL; ?>/hotel/hotel_details?sid=<?php echo $Hotel_search_result[$i]['HotelChain']; ?>&hotelid=<?php echo $Hotel_search_result[$i]['HotelCode']; ?>&checkin=<?php echo $Hotel_search_result[$i]['check_in']; ?>&checkout=<?php echo $Hotel_search_result[$i]['check_out']; ?>&city_code=<?php echo $Hotel_search_result[$i]['city_code']; ?>&adult=<?php echo $Hotel_search_result[$i]['adult']; ?>&room_count=<?php echo $Hotel_search_result[$i]['rooms']; ?>&type=<?php echo base64_encode(base64_encode('API')); ?>">
                        <button class="booknowhtl">Check Availabilty</button>	
                    </a>		
                </div>
                <div class="labelleft2 col-md-9 offset-0">			
                    <b><?php echo $Hotel_search_result[$i]['Name']; ?></b>
                    <span class="htlplace"><?php echo $Hotel_search_result[$i]['Address']; ?> </span>
                    <p class="grey">
                        <?php echo $Hotel_search_result[$i]['ParticipationLevel']; ?> | <?php echo $Hotel_search_result[$i]['HotelTransportation']; ?></p>
                    <br/>
                    <ul class="hotelpreferences allamn">
                    <?php
					for($p=0;$p<count($Hotel_search_result[$i]['Amenity_val']);$p++)				{
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
        
        </div> </div>   

        <?php
    }
	
	?>
    <div class="showmoreoption">
    <a href="javascript:void(0);" class="tshomor" onClick="more_hotels();" >SHOW MORE </a>
    </div>
    
<script type="text/javascript">



function more_hotels()
{
    var data = {};

    data['city_code'] = '<?php echo $city_code; ?>';
    data['check_in'] = '<?php echo $check_in; ?>';
    data['check_out'] = '<?php echo $check_out; ?>';
    data['rooms'] = '<?php echo $rooms; ?>';
    data['adult'] = '<?php echo $adult; ?>';
      data['nextlink'] = '<?php echo $nextlink; ?>';

    $.ajax({
        type: 'POST',
        url: WEB_URL + "/hotel/hotel_search",
        async: true,
        dataType: 'json',
        data: data,
        beforeSend: function() {
           $(".showmoreoption").html('<div class="lodrefrentrev"><div class="centerload" style="top:95% !important;"></div></div>');
            $(".showmoreoption .lodrefrentrev").fadeIn();
        },
        success: function(data) {

            $("#hotel_result").append(data.result);
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
        }
    });
}
</script>    
    <?php }?>




