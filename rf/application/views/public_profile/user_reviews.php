<?php $this->load->view('common/header');?>
 <link rel="stylesheet" href="<?php echo ASSETS;?>css/uploadfile.min.css" type="text/css" media="screen" />
 <link type="text/css" media="all" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" />
 
 <style type="text/css">.pac-container:after{content: initial !important;}</style>



<div class="clear"></div>

<!-- CONTENT -->
<div class="full onlycontent marintopcnt">
  <div class="container martopbtm">
    <div class="tab-content5">

    

<div class="msg" style="display: none;"></div>
    <div class="tab-pane padding20me active" id="dashbord">
    
       <div class="col-md-12 martopbtm30">
       <div class="withedrow fulbord">
            <span class="size16 padtabne ">Write your reviews about below property</span>
             <form action="<?php echo WEB_URL; ?>/reviews/update_user_reviewdata" method="post">
               <input  type="hidden" name="vid" value="<?php echo $vid; ?>"  />
                <input  type="hidden" name="booking_apartment_id" value="<?php echo $booking_apartment_id; ?>"  />
            <div class="rowit">
                <div class="col-md-4 nopad">
                    <div class="normalparasecnd">
                        InnoGlobe is built on trust and reputation. By writing this review, you are recommending Nag to other members of the InnoGlobe community .
                      
                    </div>
                      <div class="clear"></div>
                    <div class="normalparasecnd">
                     <?php
					 $image=$this->apartment_model->view_property_file($apartment_data->PROP_PHOTO);
					 ?>
                       <img src="<?php echo $image; ?>" alt="" />
                        
                    </div>
                     <div class="normalparasecnd">
					<?php
					
					echo $apartment_data->PROP_NAME.'<br>';
					echo $apartment_data->PROP_ADDR1.'<br>';
					echo $apartment_data->PROP_ADDR2.'-'.$apartment_data->PROP_POSTCODE.'<br>';
					echo $apartment_data->PROP_CITY.', '.$apartment_data->PROP_COUNTRY_NAME.'<br>';
					
					?>
                        
                    </div>
                    <div class="clear"></div>
                  
                    
                </div>
                <div class="col-md-7 nopad pull-right">
                    <div class="col-md-2 nopad">
                        <a class="userimgnm">
                            <div class="twouserimg">
                            <?php  
                            if(isset($user_data->profile_photo) && $user_data->profile_photo != "") {
                                $profile_photo = $user_data->profile_photo;
                            } else if(isset($user_data->agent_logo) && $user_data->agent_logo != "") {
                                $profile_photo = $user_data->agent_logo;
                            } else {
                                $profile_photo = ASSETS.'/images.user-avatar.jpg';
                            }
                            ?>
                            <img src="<?php echo $profile_photo; ?>" alt="" /></div>
                            <span class="twousrname"><?php echo $user_data->firstname; ?>  </span>
                        </a>
                    </div>
                    <div class="col-md-10 nopad">    
                        <div class="inercoment">
                            <div class="colrcnt">
                                <div class="tipfacen"></div>
                               
                                <div class="col-md-12 nopad">
                                    <div class="col-md-12 nopad">
                                        <div class="persnsentrev">Your review to this property, click the star</div>
                                    </div>
                                    <div class="witrev">
                                    
                                    <div class="col-md-6 nopad">
                                    	<div class="inrating">
                                        	<span class="ratinghed">Cleanliness</span>
                                            <input id="input-2a" type="number" name="Cleanliness" class="rating" min="0" max="5" step="0.5" data-size="starsize"  />
                                        </div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                    	<div class="inrating">
                                        	<span class="ratinghed">Communication</span>
                                            <input id="input-2b" type="number"  name="Communication" class="rating" min="0" max="5" step="0.5" data-size="starsize"  />
                                        </div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                    	<div class="inrating">
                                        	<span class="ratinghed">Check In</span>
                                            <input id="input-2a" type="number" name="checkin"  class="rating" min="0" max="5" step="0.5" data-size="starsize"  />
                                        </div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                    	<div class="inrating">
                                        	<span class="ratinghed">Location</span>
                                            <input id="input-2b" type="number" name="Locations"  class="rating" min="0" max="5" step="0.5" data-size="starsize"  />
                                        </div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                    	<div class="inrating">
                                        	<span class="ratinghed">Value of cost</span>
                                            <input id="input-2a" type="number" name="costvalue"  class="rating" min="0" max="5" step="0.5" data-size="starsize"  />
                                        </div>
                                    </div>
                                    <div class="col-md-6 nopad">
                                    	<div class="inrating">
                                        	<span class="ratinghed">Accuracy</span>
                                            <input id="input-2b" type="number" name="Accuracy"  class="rating" min="0" max="5" step="0.5" data-size="starsize"  />
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 nopad">
                                    	<div class="recomenation rectype">
                                        	<input type="checkbox" class="icheckbox_flat-blue"  name="r_recom"  />Recomended for everyone
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 nopad">
                                    	<div class="recomenation">
                                        	<select  name="r_title"  class="form-control mySelectBoxClass cpwidth2">
                                            <option value="Wonderful">Wonderful</option>
                                            <option value="Nice">Nice</option>
                                            <option value="Neutral">Neutral</option>
                                            <option value="Dislike">Dislike</option>
                                            
                                            
                                            
                                            </select>
                                        </div>
                                    </div>

                                    <input type="hidden" id="refid" value=""/>
                                    <div class="clear"></div>
                                    <textarea class="fulpers" placeholder="Write your review..." id="recommendation" name="comments"></textarea>
                                    </div>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div class="rowit topbord">
                <input type="submit" value="Submit" class="creteref">
            </div>
            </form>
        </div>
    </div></div>
    
    
    <div class="clear"></div>
    
     </div>
     </div>
   

      
    </div>
  </div>
</div>

<div class="clearfix"></div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.pmore').click(function(){
            $(this).fadeOut(500, function(){
                $(this).siblings('.reviewparalines').addClass('expandmore');
            });
            
        });
        
        $("#owl-demouser").owlCarousel({
            items : 1,
            lazyLoad : true,
            pagination : true,
            navigation : true
         });
        
        
    });
</script>


<?php $this->load->view('common/footer');?>






