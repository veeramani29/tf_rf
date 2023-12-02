<style type="text/css">
    .imgLoader{
        display: :none;
    }
</style>
<?php
//print_r($data);die;
if($nextlink_set == '')
{





<?php 
if (!empty($Hotel_search_result)) {
    for ($i = 0; $i < count($Hotel_search_result); $i++) {
        ?>   
        <div class="searchhotel_box">      
        <div class="offset-0 scroll HotelInfoBox" id="scroll1" data-hotel-name="<?php echo $Hotel_search_result[$i]['Name']; ?>" data-address="<?php //echo $Hotel_search_result[$i]['Address']; ?>">
        <div class="col-md-4 min-4 offset-0">
            <div class="listitem2">
				<?php $uniquid =  uniqid().$Hotel_search_result[$i]['HotelCode']; ?>
                <div id="<?php echo $uniquid; ?>">
					
                </div>				
            </div>
        </div>

        <script>
            $.ajax({
                type: 'POST',
                url: '<?php echo WEB_URL; ?>/hotel/get_single_hotel_images/<?php echo $Hotel_search_result[$i]['HotelChain']; ?>/<?php echo $Hotel_search_result[$i]['HotelCode']; ?>',
                        data: '',
                        async: true,
                        dataType: 'json',
                        beforeSend: function() {
                            //$("#<?php echo $uniquid; ?>").html('<div class="lodrefrentrev imgLoader"><div class="centerload"></div></div>');
                           // $("#<?php echo $uniquid; ?> .lodrefrentrev").fadeIn();
                        },
                        success: function(data) {
							var html123 = '<img src="'+data.result+'" />';
                            $("#<?php echo $uniquid; ?>").html(html123);
                        },
                    });
        </script>

        <div class="col-md-8 min-8 offset-0">
            <div class="itemlabel3">
                <div class="labelright col-md-3  textaligncntr">
                   <!-- <img src="<?php echo ASSETS; ?>images/filter-rating-5.png" width="60" alt=""/><br/><br/><br/>
                    <img src="<?php echo ASSETS; ?>images/user-rating-5.png" width="60" alt=""/><br/>
                    <span class="size11 grey">18 Reviews</span><br/><br/>--><br/><br/>
                    <span class="green size18">
                    <?php 
					if($Hotel_search_result[$i]['MinimumAmount']!='Not Available')
					{
						?>
                    <span class="curr_icon"><?php echo $this->display_icon;?></span><span class="amount"><?php echo $this->account_model->currency_convertor( $Hotel_search_result[$i]['MinimumAmount']);?></span>
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
                    <span class="htlplace"><?php //echo $Hotel_search_result[$i]['Address']; ?> </span>
                    <p class="grey">
                        <?php echo $Hotel_search_result[$i]['ParticipationLevel']; ?> | <?php echo $Hotel_search_result[$i]['HotelTransportation']; ?></p>
                    <br/>
                    <ul class="hotelpreferences allamn">
                    <?php
					for($p=0;$p<count($Hotel_search_result[$i]['Amenity_val']);$p++)				{
						  $name_am = $this->Hotel_Model->getam_name($Hotel_search_result[$i]['Amenity_val'][$p])->row();
					?>
                    <li  title="<?php //echo $name_am->universal_api_description; ?>" class="hotel-<?php echo strtolower($Hotel_search_result[$i]['Amenity_val'][$p]); ?>"></li>
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




