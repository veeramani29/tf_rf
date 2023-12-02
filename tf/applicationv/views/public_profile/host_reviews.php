<?php $this->load->view('common/header');?>
 <link rel="stylesheet" href="<?php echo ASSETS;?>css/uploadfile.min.css" type="text/css" media="screen" />
 <link type="text/css" media="all" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" />
 <link rel="stylesheet" href="<?php echo ASSETS;?>css/bootstrap-multiselect.css" type="text/css"/>
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
            <span class="size16 padtabne ">Write your reviews about <?php echo $user_data->firstname; ?></span>
             <form action="<?php echo WEB_URL;  ?>/reviews/update_host_reviewdata" method="post">
               <input  type="hidden" name="vid" value="<?php echo $vid; ?>"  />
             
            <div class="rowit">
                <div class="col-md-5 nopad">
                   
                     <div class="normalparasecnd">
                  <div class="abthost">
                	<h3 class="abtcnhost">About the guest, <?php echo $user_data->firstname; ?></h3>
                    <div class="col-md-3">
                    <?php  
                    if(isset($user_data->profile_photo) && $user_data->profile_photo != "") {
                        $profile_photo = $user_data->profile_photo;
                    } else if(isset($user_data->agent_logo) && $user_data->agent_logo != "") {
                        $profile_photo = $user_data->agent_logo;
                    } else {
                        $profile_photo = ASSETS.'/images.user-avatar.jpg';
                    }
                    ?>
                    	<div class="abthostimg"><img src="<?php echo $profile_photo; ?>" alt="" /></div>
                    </div>
                    <div class="col-md-9">
                    	<span class="abtabt">
                        	<?php echo $user_data->about; ?>
                        </span>
                        <?php  
                        if(isset($user_data->user_id)  && $user_data->user_id != "") {
                            $user_id = $user_data->user_id;
                            $user_type = 3;
                        } else if(isset($user_data->agent_id)  && $user_data->agent_id != "") {
                            $user_id = $user_data->agent_id;
                            $user_type = 2;
                        }
                        ?>
                        <a class="viewfulprof" target="_blank" href="<?php echo WEB_URL.'/users/show/'.$user_type.'/'.$user_id ?>">View full profile</a>
                        <ul class="somelistg">
                        	<li class="listingsome" style="width:100%">
                        	<?php  
                        	$propOwnerName = $user_data->address;
                        	if($propOwnerName != "") {
                        		echo $propOwnerName;
                        	} else {
                        		echo "";
                        	}
                        	?>
                        	</li>
                            <div class="clear"></div>
                            <li class="listingsome" style="width:100%">Member since <?php echo date('M Y',strtotime($user_data->register_date));?></li>
                           
                        </ul>
                       
                    </div>
                    
                    <div class="clear"></div>
                    
                    <div class="rowabt">
                        <div class="col-md-3">
                            <span class="abthostlabl"></span>
                        </div>
                        <div class="col-md-9">
                            <div class="full">
                            <?php
						$this->load->model('reviews_model');
							$hostReviewCount = $this->reviews_model->get_reviews_about_you($user_id, $user_type)->num_rows();
                            $guestReviewCount = $this->reviews_model->get_reviews_about_you_guest($user_id, $user_type)->num_rows(); 
                            $hostReviewsCount = $hostReviewCount+$guestReviewCount;
                    		$verifi = $this->reviews_model->get_verfication_data($user_id, $user_type); 
							
							 if($hostReviewsCount>0)
							 {
							 ?>
                                <div class="fulrowhaf">
                                    <span class="privaterum fagren">
                                        <span class="iconent"><img src="<?php echo ASSETS;?>images/vreview.png" alt=""  /></span>
                                    </span>
                                    <span class="bigcot"><?php echo $hostReviewsCount; ?> Reviews</span>
                                </div>
                                <?php
								}
								?>

                                <?php
								if($verifi!='')
								{
								 if($verifi->email == 1){ ?>
                                 
                                <div class="fulrowhaf">
                                    <span class="privaterum fayello">
                                        <span class="iconent"><img src="<?php echo ASSETS;?>images/vmail.png" alt=""  /></span>
                                    </span>
                                    <span class="bigcot">Email Verified</span>
                                </div>
                                <?php } ?>

                                <?php if($verifi->mobile == 1){ ?>
                                <div class="fulrowhaf">
                                    <span class="privaterum fablu">
                                        <span class="iconent"><img src="<?php echo ASSETS;?>images/vphone.png" alt=""  /></span>
                                    </span>
                                    <span class="bigcot">Mobile Verified</span>
                                </div>
                                <?php } } ?>


                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                 </div>
                </div>
                <div class="col-md-7 nopad">
                    <div class="col-md-2 nopad">
                        <a class="userimgnm">
                        <?php  
                        if(isset($host_data->profile_photo) && $host_data->profile_photo != "") {
                            $host_profile_photo = $host_data->profile_photo;
                        } else if(isset($host_data->agent_logo) && $host_data->agent_logo != "") {
                            $host_profile_photo = $host_data->agent_logo;
                        } else {
                            $host_profile_photo = ASSETS.'/images.user-avatar.jpg';
                        }
                        ?>
                            <div class="twouserimg"><img src="<?php echo $host_profile_photo; ?>" alt="" /></div>
                            <span class="twousrname"><?php echo $host_data->firstname; ?></span>
                        </a>
                    </div>
                    <div class="col-md-10 nopad">    
                        <div class="inercoment">
                            <div class="colrcnt">
                                <div class="tipface">&#9666;</div>
                                <div class="col-md-12 nopad">
                                    <div class="col-md-12">
                                        <div class="persnsent">
                      
                        Write your review here.
                        
                        
                      
                    </div>
                                    </div>
                                   
                                   
                                    <div class="clear"></div>
                                    <textarea class="fulpers" placeholder="Write your review..." id="recommendation" name="recommendation"></textarea>
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






