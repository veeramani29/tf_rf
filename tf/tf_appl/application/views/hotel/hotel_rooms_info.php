<div class="innertabs">

<?php
if(!empty($Hotel_room_info))
{
 
for($k=0;$k<count($Hotel_room_info);$k++)
{
	
		?>
       <form id="bookNow<?php echo $Hotel_room_info[$k]->api_hotel_detail_temp_id ?>" name="bookNow<?php echo $Hotel_room_info[$k]->api_hotel_detail_temp_id ?>" action="<?php echo WEB_URL;?>/hotel/book_it">
            <input type="hidden" name="temp_id" value="<?php echo $Hotel_room_info[$k]->api_hotel_detail_temp_id ?>">
            <input type="hidden" name="type" value="<?php echo base64_encode(base64_encode('API')); ?>">
                            <div class="htlrumrow">
                            	<div class="hotelistrowhtl">
                                <div class="col-md-4 nopad xcel cartimageclo">
                                        <div class="imagehotel" id="imagehotels<?php echo $k; ?>">
                                        <div class="imagehotels">
                                        <div class="lodrefrentrev imgLoader" style="display:block !important;"><div class="centerload"></div></div><!--<img class="tocartclone" src="<?php echo ASSETS;?>images/items/item1.jpg" alt="" />--></div>
                                    </div></div>
                                    
                                    <div class="col-md-6 padall10 xcel">
                                        <div class="hotelhed"><?php echo $Hotel_room_info[$k]->room_name ?></div>
                                        <!--<span class="singleadrs">One Queen Bed </span>-->
                                     
                                        <div class="mensionspl">
                                        	<?php echo $Hotel_room_info[$k]->roomdescription ?>
                                           <!-- <span class="menlbl">sdsa</span>-->
                                        </div>
                                       
                                        <div class="clear"></div>
                                       
                                        <button type="button" class="morerum" onClick="javascript:get_cancellation_policy('<?php echo $k; ?>','<?php echo $Hotel_room_info[$k]->chain_code; ?>','<?php echo $Hotel_room_info[$k]->hotel_code; ?>','<?php echo $Hotel_room_info[$k]->org_amount; ?>','<?php echo $Hotel_room_info[$k]->room_code; ?>','<?php echo $Hotel_room_info[$k]->checkin; ?>','<?php echo $Hotel_room_info[$k]->checkout; ?>')" data-toggle="collapse" data-target="#rumaldets<?php echo $k; ?>">
                                        <div class="refundpol">
                                        	<span class="icon icon-check"></span>Additional details / Room Rate Rules
                                        </div>
                                        </button>
                                        <div class="clear"></div>
                                       
                                    </div>
                                    <div class="col-md-2 nopad xcel bordrit">
                                        <div class="pricesec">
                                            <span class="pricehotel">
											<?php echo $this->display_icon;?> <?php echo $this->account_model->currency_convertor($Hotel_room_info[$k]->total_cost);?>
											</span>
                                            <span class="smalper">Total</span>
                                       <input type="submit" class="booknowhtl add-to-cart HotelbookNow" id="book-it<?php echo $k; ?>" value="Book Now"  data-attr="H<?php echo $k; ?>"  data-tempid="<?php echo $Hotel_room_info[$k]->api_hotel_detail_temp_id ?>" name="submit"/>
                                       
                                     
                                      
                                        </div>
                                    </div>
                                </div>  
                                <div class="allromdesc collapse" id="rumaldets<?php echo $k; ?>" style="margin-left:12px;">
                                        	
                                        </div>
                            </div>
       </form>
    <?php
}
}
?>
                            
                          
                            
                            
                            
                            </div>
                            <script>
							function get_cancellation_policy(id,sid,hotelid,rate,rateplan,checkin,checkout)
							{
								
								$.ajax({
			  type: 'POST',
			  url: '<?php echo WEB_URL; ?>/hotel/get_cancel_policy/'+sid+'/'+hotelid+'/'+rate+'/'+rateplan+'/'+checkin+'/'+checkout,
			  data: '',
			  async: true,
			  dataType: 'json',
			  beforeSend:function(){
				  $("#rumaldets"+id).html('<div class="lodrefrentrev imgLoader"><div class="centerload"></div></div>');
				  $("#rumaldets"+id+" .lodrefrentrev").fadeIn();
			 },
			success: function(data){
				
				$("#rumaldets"+id).html(data.hotel_rules_val1);
				$("#rumaldets"+id+" .lodrefrentrev").fadeOut();
		  },

		  
		 	error:function(request, status, error){


					  }
		  
			});
								
							}
							</script>