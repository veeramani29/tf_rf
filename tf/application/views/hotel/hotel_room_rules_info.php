
                        <div class="hotelhed">RoomRate Description</div>
                        <!--<span class="singleadrs">One Queen Bed </span>-->
                        <?php
						for($p=0;$p<count($RoomRateDescription_v1);$p++)
						{
						?>
                        <div class="mensionspl">
                            <strong><?php echo $RoomRateDescription_v1[$p][0]; ?> :</strong>
                            <span class="menlbl"><?php echo $RoomRateDescription_v1[$p][1]; ?></span>
                        </div>
                        <?php
						}
						?>
                         <div class="clear"></div>
                       
                        <div class="clear"></div>
                       
                        <div class="hotelhed">Hotel Rules</div>
                        <!--<span class="singleadrs">One Queen Bed </span>-->
                      <?php
						for($p=0;$p<count($HotelRuleItem_v1);$p++)
						{
						?>
                        <div class="mensionspl">
                            <strong><?php echo $HotelRuleItem_v1[$p][0]; ?> :</strong>
                            <span class="menlbl"><?php echo $HotelRuleItem_v1[$p][1]; ?></span>
                        </div>
                        <?php
						}
						?>
                  
                    
                                    
                                    <div class="clear"></div> 
                                    
                                    
                                