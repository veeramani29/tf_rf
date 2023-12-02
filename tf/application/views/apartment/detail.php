<?php $this->load->view('common/header');
$language = $this->session->userdata('language');

  if($language){
	 $this->lang->load('Apartment_Details_AD', $language);
	  }else{
	 $this->lang->load('Apartment_Details_AD', 'english');
	  }
	  ?>
<link href="<?php echo ASSETS;?>css/jquery.provabslideshow.css" rel="stylesheet" type="text/css" media="all" />
<div class="full marintop">
    <div id="owl-demo2" class="owl-carousel detailcorosl">
<?php if(count($Images) > 0){ foreach($Images as $image){ if($image->PHOTO_CONTENT != ''){ $img = $this->apartment_model->view_property_file($image->PHOTO_CONTENT); ?>    	
       <div class="item">
       		<a href="<?php echo $img;?>" class="provabslideshow boxer_image" data-gallery="gallery" title="<?php echo $Apartment->PROP_NAME;?>">
            <img src="<?php echo $img;?>" alt="" />
            </a>
       </div>
<?php }}}?>       
    </div>
</div>   
<div class="clear"></div>		
	<div class="container fordetailpage">
		<div class="container offset-0">
            <div class="col-md-4 usraprtmnt">
                <form id="bookNow" name="bookNow" action="<?php echo WEB_URL;?>/apartment/book_it">
            	<div class="pagecontainer2 testimonialbox myaptadvence">
                	<div class="priceapt green2">
                		<div class="left">
                			<?php $PROP_RATE_NIGHTLY_FROM = $this->apartment_model->currency_convertor($Apartment->PROP_RATE_NIGHTLY_FROM,$Apartment->PROP_RATE_CURRENCY,CURR);?>
                    	<span class="currency curr_icon"><?php echo $this->display_icon;?></span><span class="amount pernight"><?php echo $this->account_model->currency_convertor($PROP_RATE_NIGHTLY_FROM);?></span>
                		</div>
                		<div class="right">
                			<strong class="rentType"><?php echo $this->lang->line('AD_Per_Night'); ?></strong>
                		</div>
                        </div>
                    <div class="advancerow">
                        <div class="col-sm-12 nopad">
                            <div class="col-xs-6 adpad">
                                <label class="aptlabel"><?php echo $this->lang->line('AD_Checkin'); ?></label>
                                <input class="mySelectCalenda calinput aptadvdate" type="text" name="checkin" id="from" placeholder="dd-mm-yyyy" value="<?php if($this->input->get('checkin') && $this->input->get('checkout')){ echo $this->input->get('checkin');}?>" required readonly/>
                            </div>
                            <div class="col-xs-6 adpad">
                                <label class="aptlabel"><?php echo $this->lang->line('AD_Checkout'); ?></label>
                                <input class="mySelectCalenda calinput aptadvdate" type="text" name="checkout" id="to" placeholder="dd-mm-yyyy" value="<?php if($this->input->get('checkin') && $this->input->get('checkout')){ echo $this->input->get('checkout');}?>" required readonly/>
                            </div> 
                        </div>
                        <div class="clear"></div>
                        
                        <div class="col-sm-12 nopad froptopmar">
                        
                        	<div class="col-xs-4 adpad myselect">
                                <label class="aptlabel"><?php echo $this->lang->line('AD_Adult'); ?></label>
                                <select class="aptselect mySelectBoxClass  flyinput text-right" name="adult" id="adult" onchange="CalculateRent()">
                                	<?php if($this->input->get('adult')){$adult = $this->input->get('adult');}else{$adult = 1;}for($i=1;$i<=$Apartment->PROP_MAXGUESTS_ADULTS;$i++){?>
                                	<option value="<?php echo $i;?>" <?php if($adult == $i){ echo "selected";}?>><?php echo $i;?></option>
                                	<?php }?>
                                </select>
                            </div>
                            
                            <div class="col-xs-4 adpad myselect">
                                <label class="aptlabel"><?php echo $this->lang->line('AD_Child'); ?></label>
                                <select class="aptselect mySelectBoxClass  flyinput text-right" name="child" id="child" onchange="CalculateRent()">
                                	<?php if($this->input->get('child')){$child = $this->input->get('child');}else{$child = 0;}for($i=0;$i<=$Apartment->PROP_MAXGUESTS_CHILDREN;$i++){?>
                                	<option value="<?php echo $i;?>" <?php if($child == $i){ echo "selected";}?>><?php echo $i;?></option>
                                	<?php }?>
                                </select>
                            </div>
                            
                            
                            <div class="col-xs-4 adpad myselect">
                                <label class="aptlabel"><?php echo $this->lang->line('AD_Infant'); ?></label>
                                <select class="aptselect mySelectBoxClass  flyinput text-right" name="infant" id="infant" onchange="CalculateRent()">
                                	<?php if($this->input->get('infant')){$infant = $this->input->get('infant');}else{$infant = 0;}for($i=0;$i<=$Apartment->PROP_MAXGUESTS_BABIES;$i++){?>
                                	<option value="<?php echo $i;?>" <?php if($infant == $i){ echo "selected";}?>><?php echo $i;?></option>
                                	<?php }?>
                                </select>
                            </div>
                            <input type="hidden" name="nights" id="nights"/>
                            <input type="hidden" name="total" id="Total"/>
                            <input type="hidden" name="rent" id="rent"/>
                            <input type="hidden" name="instatnt" id="instatnt" value="<?php echo $Apartment->PROP_INSTANT_BOOK;?>"/>
                        	<input type="hidden" name="pid" id="pid" value="<?php echo $PROPERTY_ID;?>"/>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="forloadtwo">
                    	<div class="lodrefrent"><div class="centerload"></div></div>
                        <div class="pricetable"></div>
                        <div class="clear"></div>
                        <div class="advserchbtn" style="display:none;">
                            <?php if($Apartment->PROP_INSTANT_BOOK == '1'){?>
                                <input type="submit" class="booknow btnmarg" id="book-it" value="<?php echo $this->lang->line('AD_Instant_Book'); ?>" name="submit"/>
                                <?php }else{?>
                                <input type="submit" class="booknow btnmarg nillbook" id="book-it" value="<?php echo $this->lang->line('AD_Request_Book'); ?>" name="submit"/>
                                <?php }?>
                        </div>
                    </div>
                    
                </div>
                </form>
                <div class="clear"></div>
                
                <div class="col-md-12 nopad mobispace">  
                <div class="clear"></div>
                
				<div class="pagecontainer2 testimonialbox">
				<div class="padding20">
					<div class="detssmal">
						<strong><?php echo $Apartment->PROP_NAME;?> - <?php echo $Apartment->PROP_TYPE_LABEL;?></strong> <?php echo $Apartment->PROP_CITY;?>, <?php echo $Apartment->PROP_REGION;?>, <?php echo $Apartment->COUNTRY_NAME;?> 
                    </div>
				</div>
				
				<div class="line3"></div>
				
                <?php if(!empty($user_ratings['rating']) && $user_ratings['rating']['ratingRemark'] != "" ) { ?>
				<div class="hpadding20">
					<h2 class="opensans slim green2" id="revRemrk">
                        <?php echo $user_ratings['rating']['ratingRemark']; ?>
                    </h2>
				</div>
				<?php }?>
				<?php if(!empty($user_ratings['rating']) && $user_ratings['rating']['recommended'] != "" ) { ?>
                    <div class="line3 margtop20"></div>
                    <div class="col-md-6 bordertype1 padding20">
                        <span class="opensans size30 bold grey2">
                            <?php echo $user_ratings['rating']['recommended']; ?>%
                        </span><br/>
                        <?php echo $this->lang->line('AD_Of_Guests'); ?><br/><?php echo $this->lang->line('AD_Recommend'); ?>
                    </div>

                <?php } ?>
                    <?php if(!empty($user_ratings['rating']) && $user_ratings['rating']['overAllAvg'] != "" ) { ?>
				    <div class="col-md-6 bordertype2 padding20">
                	    <span class="opensans size30 bold grey2">
                            <?php echo $user_ratings['rating']['overAllAvg']; ?>
                        </span>/5<br/>
                        <?php echo $this->lang->line('AD_Guest_Ratings'); ?>
                    </div>
                    <?php } ?>
				<div class="clearfix"></div>
				<div class="padding20">
				<?php if($isInWish > 0) { ?>
        			<a href="#" id="addWishDetail" style="background: url('<?php echo ASSETS; ?>/images/btn-hrt.png') #fff no-repeat 20px 0  " data-title="<?php echo $Apartment->PROP_NAME;?>" data-image="<?php echo $img; ?>" data-id="<?php echo $Apartment->PROPERTY_ID ?>" class="add2fav margtop5">
						<?php echo $this->lang->line('AD_W_Added'); ?>
					</a>
        		<?php } else { ?> 
        			<a href="#" id="addWishDetail" data-title="<?php echo $Apartment->PROP_NAME;?>" data-image="<?php echo $img; ?>" data-id="<?php echo $Apartment->PROPERTY_ID ?>" class="add2fav margtop5">
						<?php echo $this->lang->line('AD_W_Add'); ?>
					</a>
    			<?php } ?>
					<!-- <a href="#" class="booknow margtop20 btnmarg">Book now</a> -->
				</div>
			</div>
            <br />
				<div class="pagecontainer2  needassistancebox">
					<div class="cpadding1">
						<span class="icon-help"></span>
						<h3 class="opensans"><?php echo $this->lang->line('AD_Need_Assistance'); ?></h3>
						<p class="size14 grey"><?php echo $this->lang->line('AD_Need_Assistance_Content'); ?></p>
						<p class="opensans size30 lblue xslim">	<?php $banners = $this->Help_Model->getHomeSettings(); ?><?php echo $banners->customer_support_phone; ?></p>
					</div>
				</div><br/>
				<?php /*?><div class="pagecontainer2  alsolikebox" >
					<div class="cpadding1">
						<span class="icon-location"></span>
						<h3 class="opensans">You May Also Like</h3>
						<div class="clearfix"></div>
					</div>
					<div class="cpadding1 ">
						<a href="#"><img src="<?php echo ASSETS;?>images/smallthumb-1.jpg" class="left mr20" alt=""/></a>
						<a href="#" class="dark"><b>Hotel Amaragua</b></a><br/>
						<span class="opensans green bold size14">$36-$160</span> <span class="grey">avg/night</span><br/>
						<img src="<?php echo ASSETS;?>images/filter-rating-5.png" alt=""/>
					</div>
					<div class="line5"></div>
					<div class="cpadding1 ">
						<a href="#"><img src="<?php echo ASSETS;?>images/smallthumb-2.jpg" class="left mr20" alt=""/></a>
						<a href="#" class="dark"><b>Hotel Amaragua</b></a><br/>
						<span class="opensans green bold size14">$36-$160</span> <span class="grey">avg/night</span><br/>
						<img src="<?php echo ASSETS;?>images/filter-rating-5.png" alt=""/>
					</div>
					<div class="line5"></div>			
					<div class="cpadding1 ">
						<a href="#"><img src="<?php echo ASSETS;?>images/smallthumb-3.jpg" class="left mr20" alt=""/></a>
						<a href="#" class="dark"><b>Hotel Amaragua</b></a><br/>
						<span class="opensans green bold size14">$36-$160</span> <span class="grey">avg/night</span><br/>
						<img src="<?php echo ASSETS;?>images/filter-rating-5.png" alt=""/>
					</div>
					<br/>
				</div><?php */?>				
			</div>
            </div>
            <div class="col-md-8 offset-0 aprmntdets">
            	<div class="pagedethed">
                    <div class="aprtimg"><img src="<?php echo $profile_photo;?>" alt="" title="<?php echo $Apartment->firstname;?>"/></div>
                    <div class="leftsuplr">
                        <div class="aptgust"><?php echo $Apartment->firstname;?></div>
                        
                        <div class="letrrate" style="display: none"> 
                        <?php if(!empty($user_ratings['rating']) && $user_ratings['rating']['overAllAvg'] != "" ) { ?>
                            <span class="opensans size30 bold grey2">
                                <?php echo $user_ratings['rating']['overAllAvg']; ?>
                            </span>/5<br/>
                        <strong><?php echo $this->lang->line('AD_Guest_Ratings'); ?></strong>
                        <?php } ?>
                        </div>
                    </div>

                </div>
        		<div class="toprub">
                	<h3 class="aptname"><?php echo $Apartment->PROP_NAME;?></h3>
                    <div class="aptloc"><?php echo $Apartment->PROP_CITY;?>, <?php echo $Apartment->PROP_REGION;?>, <?php echo $Apartment->COUNTRY_NAME;?> </div>
                  
                    <div class="full">
                    	<div class="fulrowhaf">
                            <span class="privaterum fagren"><img src="<?php echo ASSETS;?>images/apartment_types/<?php if($Apartment->PROP_TYPE_LABEL == 'Country house / villa'){echo 'villa';}else{echo $Apartment->PROP_TYPE_LABEL;}?>.png" alt="<?php echo $Apartment->PROP_TYPE_LABEL;?>"></span>
                            <span class="bigcot"><?php echo $Apartment->PROP_TYPE_LABEL;?></span>
                        </div>
                        <div class="fulrowhaf">
                            <span class="privaterum fared"><img src="<?php echo ASSETS;?>images/grp.png" alt=""></span>
                            <span class="bigcot"><?php echo $Apartment->PROP_MAXGUESTS;?> <?php echo $this->lang->line('AD_Guest'); ?><?php if($Apartment->PROP_MAXGUESTS > 1){?>s<?php }?></span>
                        </div>
                        <div class="fulrowhaf">
                            <span class="privaterum fayello"><img src="<?php echo ASSETS;?>images/bedroom.png" alt=""></span>
                            <span class="bigcot"><?php echo $Apartment->PROP_BEDROOMS;?> <?php echo $this->lang->line('AD_Bedroom'); ?><?php if($Apartment->PROP_BEDROOMS > 1){?>s<?php }?></span>
                        </div>
                        <div class="fulrowhaf">
                            <span class="privaterum fablu"><img src="<?php echo ASSETS;?>images/bed.png" alt=""></span>
                            <span class="bigcot"><?php echo $Apartment->PROP_BEDS;?> <?php echo $this->lang->line('AD_Bed'); ?><?php if($Apartment->PROP_BEDS > 1){?>s<?php }?></span>
                        </div>
                    </div>
                </div>
                <div class="clear"></div><div class="mobiclear">
                <div class="pagecontainer2">
                <div class="cstyle10"></div>
				<ul class="nav nav-tabs detab" id="myTab">
					<li onclick="mySelectUpdate()" class="active"><a data-toggle="tab" href="#summary"><span class="summary"></span><span class="hidetext"><?php echo $this->lang->line('AD_Summary'); ?></span>&nbsp;</a></li>
					<!-- <li onclick="mySelectUpdate()" class="active"><a data-toggle="tab" href="#roomrates"><span class="rates"></span><span class="hidetext">Room rates</span>&nbsp;</a></li> -->
					<li onclick="mySelectUpdate()" class=""><a data-toggle="tab" href="#preferences"><span class="preferences"></span><span class="hidetext"><?php echo $this->lang->line('AD_Preferences'); ?></span>&nbsp;</a></li>
					<li onclick="loadScript(<?php echo $Apartment->PROP_LATITUDE;?>, <?php echo $Apartment->PROP_LONGITUDE;?>)" class=""><a data-toggle="tab" href="#maps"><span class="maps"></span><span class="hidetext"><?php echo $this->lang->line('AD_Maps'); ?></span>&nbsp;</a></li>
					<li onclick=" mySelectUpdate(); getReviews(<?php echo $Apartment->PROPERTY_ID; ?>, <?php  echo $Apartment->USER_ID;  ?>, <?php  echo $Apartment->USER_TYPE;  ?>);" class=""><a data-toggle="tab" href="#reviews"><span class="reviews"></span><span class="hidetext"><?php echo $this->lang->line('AD_Reviews'); ?></span>&nbsp;</a></li>
				</ul>
				<div class="tab-content4" >
					<!-- TAB 1 -->				
					<div id="summary" class="tab-pane fade active in">
						<button type="button" class="collapsebtn2"><?php echo $this->lang->line('AD_About_Listing'); ?></button>
						<p class="hpadding20"><?php echo $Apartment->PROP_SHORTDESCRIPTION;?></p>
                        <div class="hpadding20">
                        <div class="popcontact" id="contacthost"><?php echo $this->lang->line('AD_Contact_Host'); ?></div>
                        <div class="clear"></div>
						<?php if(count($Images) > 0){ foreach($Images as $image){ if($image->PHOTO_CONTENT != ''){ $img = $this->apartment_model->view_property_file($image->PHOTO_CONTENT); ?>    
						<a href="<?php echo $img;?>" class="provabslideshow boxer_image tabbimg" data-gallery="gallery" title="<?php echo $Apartment->PROP_NAME;?>"><img src="<?php echo $img;?>" alt="" /></a>
						<?php }break;}}?>
                        </div>
						<div class="line4"></div>
						<!-- Collapse 1 -->	
						<button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#collapse1">
						 <?php echo $this->lang->line('AD_About'); ?> <?php echo $Apartment->PROP_CITY;?> <span class="collapsearrow"></span>
						</button>
						<div id="collapse1" class="collapse in">
							<div class="hpadding20"><?php echo $Apartment->PROP_AREADESCRIPTION;?></div>
							<div class="clearfix"></div>
						</div>
						<!-- End of collapse 1 -->	
						<div class="line4"></div>						
                        <!-- Collapse 4.1 -->	
						<button type="button" class="collapsebtn2 collapsed" data-toggle="collapse" data-target="#collapse4_1">
						  <?php echo $this->lang->line('AD_Standard_Timing'); ?> <span class="collapsearrow"></span>
						</button>
						<div id="collapse4_1" class="collapse">
							<div class="hpadding20">
								<div class="toglerowrep">
                                	<div class="col-sm-3 nopad"><div class="slabl"><?php echo $this->lang->line('AD_Checkin'); ?> </div></div>
                                    <div class="col-sm-9"><div class="mlabl"><?php echo $Apartment->PROP_CIN_TIME ;?></div></div>
                                </div>
                                <div class="toglerowrep">
                                	<div class="col-sm-3 nopad"><div class="slabl"><?php echo $this->lang->line('AD_Checkout'); ?> </div></div>
                                    <div class="col-sm-9"><div class="mlabl"><?php echo $Apartment->PROP_COUT_TIME ;?></div></div>
                                </div>
							</div>
							<div class="clearfix"></div>
						</div>
						<!-- End of collapse 4.1 -->
                        <div class="line4"></div>
                        <!-- Collapse 4.2 -->	
						<button type="button" class="collapsebtn2 collapsed" data-toggle="collapse" data-target="#collapse4_2">
						  <?php echo $this->lang->line('AD_Guest_Capacity'); ?>  <span class="collapsearrow"></span>
						</button>
						<div id="collapse4_2" class="collapse">
							<div class="hpadding20">
								<div class="toglerowrep">
                                	<div class="col-sm-3 nopad">
                                    	<div class="persimg"><img src="<?php echo ASSETS;?>images/adult.png" /></div>
                                        <div class="slabl"><?php echo $this->lang->line('AD_Adult'); ?></div>
                                    </div>
                                    <div class="col-sm-9"><div class="mlabl"><?php echo $Apartment->PROP_MAXGUESTS_ADULTS  ;?></div></div>
                                </div>
                                <div class="toglerowrep">
                                	<div class="col-sm-3 nopad">
                                    	<div class="persimg"><img src="<?php echo ASSETS;?>images/children.png" /></div>
                                        <div class="slabl"><?php echo $this->lang->line('AD_Child'); ?></div>
                                    </div>
                                    <div class="col-sm-9"><div class="mlabl"><?php echo $Apartment->PROP_MAXGUESTS_CHILDREN ;?></div></div>
                                </div>
                                <div class="toglerowrep">
                                	<div class="col-sm-3 nopad">
                                    	<div class="persimg"><img src="<?php echo ASSETS;?>images/infant.png" /></div> 
                                        <div class="slabl"><?php echo $this->lang->line('AD_Infant'); ?></div>
                                    </div>
                                    <div class="col-sm-9"><div class="mlabl"><?php echo $Apartment->PROP_MAXGUESTS_BABIES ;?></div></div>
                                </div>
							</div>
							<div class="clearfix"></div>
						</div>
						<!-- End of collapse 4.2 -->
                        <div class="line4"></div>
                        <!-- Collapse 4.3 -->	
						<button type="button" class="collapsebtn2 collapsed" data-toggle="collapse" data-target="#collapse4_3">
						 <?php echo $this->lang->line('AD_Availability'); ?> <span class="collapsearrow"></span>
						</button>
						<div id="collapse4_3" class="collapse">
							<div class="hpadding20">
								<div class="toglerowrep">
                                	<div class="col-sm-3 nopad">
                                 		<div class="slabl"><?php echo $this->lang->line('AD_Min_Stay'); ?></div>
                                    </div>
                                    <div class="col-sm-9"><div class="mlabl"><?php echo $Apartment->PROP_STAYTIME_MIN_VALUE ;?> <?php echo $Apartment->PROP_STAYTIME_MIN_UNIT ;?></div></div>
                                </div>
                                <div class="toglerowrep">
                                	<div class="col-sm-3 nopad">
                                         <div class="slabl"><?php echo $this->lang->line('AD_Max_Stay'); ?></div>
                                    </div>
                                    <div class="col-sm-9"><div class="mlabl"><?php echo $Apartment->PROP_STAYTIME_MAX_VALUE ;?> <?php echo $Apartment->PROP_STAYTIME_MAX_UNIT ;?></div></div>
                                </div>
                                <div style="display: none" class="popcontact">View Calendar</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<!-- End of collapse 4.3 -->
                        <div class="line4"></div>								
						<!-- Collapse 5 -->	
						<button type="button" class="collapsebtn2 collapsed" data-toggle="collapse" data-target="#collapse5">
						  <?php echo $this->lang->line('AD_Elevator'); ?> <span class="collapsearrow"></span>
						</button>
						<div id="collapse5" class="collapse">
							<div class="hpadding20">
								<?php if($Apartment->PROP_ELEVATOR == '1'){echo $this->lang->line('AD_Yes');}else{echo $this->lang->line('AD_No');}?>
							</div>
							<div class="clearfix"></div>
						</div>
						<!-- End of collapse 5 -->	
                        <div class="line4"></div>
                        <!-- Collapse 4.4 -->	
						<button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#collapse4_4">
						  <?php echo $this->lang->line('AD_Space'); ?> <span class="collapsearrow"></span>
						</button>
						<div id="collapse4_4" class="collapse in">
							<div class="hpadding20">
								<div class="toglerowrep">
                                	<div class="col-sm-3 nopad">
                                 		<div class="slabl"><?php echo $this->lang->line('AD_Bed_Type'); ?></div>
                                    </div>
                                    <div class="col-sm-9"><div class="mlabl">
                                    	<?php 
                                            if(isset($Apartment->PROP_BED_TYPES) && $Apartment->PROP_BED_TYPES != "" ) {
                                        		$PROP_BED_TYPES = explode(',',$Apartment->PROP_BED_TYPES);
                                        		$PROP_BED_TYPES = array_unique($PROP_BED_TYPES, SORT_REGULAR);
                                        		// print_r($PROP_BED_TYPES);
                                        		foreach ($PROP_BED_TYPES as $BED_TYPE) {
                                        			$Type = $this->apartment_model->getApartmentBetTypes($BED_TYPE)->row();
                                                    if(isset($Type->BED_TYPE_LABEL) && $Type->BED_TYPE_LABEL != "" ) {
                                                        $Types[] = $Type->BED_TYPE_LABEL;    
                                                        echo $Bed_Types = implode(', ', $Types);
                                                    }
                                        		}
                                    		} else {
                                                echo $this->lang->line('AD_Not_Available');
                                            }
                                    	?>
                                    	</div>
                                    </div>
                                </div>
                                <div class="toglerowrep">
                                	<div class="col-sm-3 nopad">
                                         <div class="slabl"><?php echo $this->lang->line('AD_Property_Type'); ?></div>
                                    </div>
                                    <div class="col-sm-9"><div class="mlabl"><?php echo $Apartment->PROP_TYPE_LABEL;?></div></div>
                                </div>
                                <div class="toglerowrep">
                                	<div class="col-sm-3 nopad">
                                         <div class="slabl"><?php echo $this->lang->line('AD_Accommodates'); ?></div>
                                    </div>
                                    <div class="col-sm-9"><div class="mlabl"><?php echo $Apartment->PROP_MAXGUESTS;?></div></div>
                                </div>
                                <div class="toglerowrep">
                                	<div class="col-sm-3 nopad">
                                         <div class="slabl"><?php echo $this->lang->line('AD_Bedrooms'); ?></div>
                                    </div>
                                    <div class="col-sm-9"><div class="mlabl"><?php echo $Apartment->PROP_BEDROOMS;?></div></div>
                                </div>
                                <div class="toglerowrep">
                                	<div class="col-sm-3 nopad">
                                         <div class="slabl"><?php echo $this->lang->line('AD_Beds'); ?></div>
                                    </div>
                                    <div class="col-sm-9"><div class="mlabl"><?php echo $Apartment->PROP_BEDS;?></div></div>
                                </div>
                                <div class="toglerowrep">
                                	<div class="col-sm-3 nopad">
                                         <div class="slabl"><?php echo $this->lang->line('AD_Bathrooms'); ?></div>
                                    </div>
                                    <div class="col-sm-9"><div class="mlabl"><?php echo $Apartment->PROP_BATHROOMS;?></div></div>
                                </div>
                                <div class="toglerowrep">
                                	<div class="col-sm-3 nopad">
                                         <div class="slabl"><?php echo $this->lang->line('AD_Toilets'); ?></div>
                                    </div>
                                    <div class="col-sm-9"><div class="mlabl"><?php echo $Apartment->PROP_TOILETS;?></div></div>
                                </div>
                                <div class="toglerowrep">
                                	<div class="col-sm-3 nopad">
                                         <div class="slabl"><?php echo $this->lang->line('AD_Cleaning_Time'); ?></div>
                                    </div>
                                    <div class="col-sm-9"><div class="mlabl"><?php echo $Apartment->PROP_CLEAN_TIME;?></div></div>
                                </div>
                            </div>
							<div class="clearfix"></div>
						</div>
						<!-- End of collapse 4.4 -->		

                        <div class="line4"></div>
                        
                        <button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#collapse4_5">
                          <?php echo $this->lang->line('AD_Cancellation_Details'); ?> <span class="collapsearrow"></span>
                        </button>
									
                         <div id="collapse4_5" class="collapse in">
                           
                            <div class="hpadding20"> 
                             <p><?php echo $this->lang->line('AD_Cancellation_Type'); ?> <?php if($Apartment->PROP_CANCELLATION_TYPE == '1') { ?>                                           
                                   <?php echo $this->lang->line('AD_C_Stressfree'); ?>
                                <?php } elseif($Apartment->PROP_CANCELLATION_TYPE == '2') { ?>
                                    <?php echo $this->lang->line('AD_C_Moderate'); ?> 
                                <?php } elseif($Apartment->PROP_CANCELLATION_TYPE == '3') { ?>
                                    <?php echo $this->lang->line('AD_C_Strict'); ?>
                                <?php } ?> </p>                                                                
                                 <?php echo $Apartment->PROP_CANCELLATION_DETAILS;?>           

                                 <br>
                                 <br>
                                    <?php echo $this->lang->line('AD_More_Details'); ?> <a href="<?php echo WEB_URL; ?>/home/cancellation_policies"><?php echo $this->lang->line('AD_Kindly_Check'); ?></a>
                                 <br>

                            </div>
                            <div class="clearfix"></div>
                        </div> 

					</div>
					
					<div id="preferences" class="tab-pane fade">
						<p class="hpadding20"><?php echo $Apartment->PROP_RENTAL_DETAILS;?></p>
						
						<div class="line4"></div>
						
						<!-- Collapse 7 -->	
						<button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#collapse7">
						  <?php echo $this->lang->line('AD_Amenities'); ?> <span class="collapsearrow"></span>
						</button>
						
						<div id="collapse7" class="collapse in">
							<div class="hpadding20">
								<?php 
									$amenity_ids = explode(',',$Apartment->PROP_AMENITIES);
									$j = count($amenity_ids);
									if($j < 10){$limit = 3;}else{ $limit = 8;}
									$count = ceil(count($amenity_ids)/$limit);
									$k;
									for($i=1;$i<=$count;$i++){
								?>
								<div class="col-md-4 offset-0">
									<ul class="hpref-text left">
										<?php 
											if($i == 1){$k=0;}foreach ($amenity_ids as $key => $amenity_id) {
											$c = $i*$limit;
											if($k+1 <= $j){
												$amenities = $this->apartment_model->getApartmentAmenities($amenity_ids[$k])->row();
											}
										?>
										<?php if($k+1 <= $j){?>
                                            <li>
                                                <span class="spriteicon icohp-<?php if(!isset($amenities->AMENITY_ICON)){echo 'safe';}else{echo $amenities->AMENITY_ICON;}?>"></span>
                                                <?php 
                                                if(isset($amenities->AMENITY_LABEL) && !empty($amenities->AMENITY_LABEL)) {
                                                    echo $amenities->AMENITY_LABEL;
                                                } else {
                                                     echo $this->lang->line('AD_Not_Available');
                                                }
                                                ?>
                                            </li>
                                        <?php }?>
										<?php $k++;if($k == $c){break;}}?>
									</ul>
								</div>
								<?php }?>
																
								<div class="clearfix"></div>
							</div>
							
						</div>
						<!-- End of collapse 7 -->		
						<br/>
						<div class="line4"></div>							
						
						<!-- Collapse 8 -->	
						<button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#collapse8">
						  <?php echo $this->lang->line('AD_Amenities'); ?>  <span class="collapsearrow"></span>
						</button>
						<div id="collapse8" class="collapse in">
							<div class="hpadding20">
								<?php 
									$activity_ids = explode(',',$Apartment->PROP_ACTIVITIES);
									$j = count($activity_ids);
									if($j < 10){$limit = 3;}else{ $limit = 7;}
									$count = ceil(count($activity_ids)/$limit);
									$k;
									for($i=1;$i<=$count;$i++){
								?>
								<div class="col-md-4">
									<ul class="checklist">
										<?php 
											if($i == 1){$k=0;}foreach ($activity_ids as $key => $activity_id) {
											$c = $i*$limit;
											if($k+1 <= $j){
												$activities = $this->apartment_model->getApartmentActivities($activity_ids[$k])->row();
											}
										?>
										<?php if($k+1 <= $j){?>
                                            <li>
                                                <?php 
                                                    if(isset($activities->ACTIVITY_LABEL) && $activities->ACTIVITY_LABEL != "") {
                                                        echo $activities->ACTIVITY_LABEL;
                                                    } else {
                                                        echo $this->lang->line('AD_Not_Available');
                                                    }
                                                ?>
                                            </li>
                                        <?php }?>
										<?php $k++;if($k == $c){break;}}?>
									</ul>
								</div>
								<?php }?>
																
							</div>
							<div class="clearfix"></div>
						</div>
						<!-- End of collapse 8 -->				
					</div>
					<!-- TAB 4 -->					
					<div id="maps" class="tab-pane fade">
						<div class="hpadding20">
							<div id="map-canvas"></div>
						</div>
					</div>
					<!-- TAB 5 -->					
					<div id="reviews" class="tab-pane fade ">
                    	<div class="lodrefrentrev"><div class="centerload"></div></div>
						<div class="hpadding20">
							<div class="col-md-4 offset-0">
								<span class="opensans dark size60 slim lh3" id="rtingBig"></span><br/>
								<img id="rtngLgnd" src="" alt=""/>
							</div>
							<div class="col-md-8 offset-0">
								<div class="progress progress-striped" id="rtngPrcnt"></div>		
								<div class="progress progress-striped" id="rcmndPrcnt"></div>
								<div class="clearfix"></div>
								Ratings based on <span id="vrfiedUsrCnt"></span> Verified Reviews
							</div>			
							<div class="clearfix"></div>
							<br/>
							<span class="opensans dark size16 bold">Average ratings</span>
						</div>
						
						<div class="line4"></div>
						
						<div class="hpadding20">
							<div class="col-md-4 offset-0">
								<div class="scircle left" id="clnId"></div>
								<div class="sctext left margtop15">Cleanliness</div>
								<div class="clearfix"></div>
								<div class="scircle left" id="cmnctnId"></div>
								<div class="sctext left margtop15">Communication</div>
								<div class="clearfix"></div>								
							</div>
							<div class="col-md-4 offset-0">
								<div class="scircle left" id="accuracyId">3.8</div>
								<div class="sctext left margtop15">Accuracy</div>
								<div class="clearfix"></div>
								<div class="scircle left" id="chkinId">4.4</div>
								<div class="sctext left margtop15">Check In</div>			
								<div class="clearfix"></div>										
							</div>
							<div class="col-md-4 offset-0">
								<div class="scircle left" id="lctinId">4.2</div>
								<div class="sctext left margtop15">Location</div>
								<div class="clearfix"></div>
								<div class="scircle left" id="cstValId">4.4</div>
								<div class="sctext left margtop15">Value for Money</div>		
								<div class="clearfix"></div>										
							</div>		
							<div class="clearfix"></div>
							
							<br/>
						</div>
						
						
                        <div id="usrRevs"></div>
                        

						<br/>
						<br/>
						
						<div class="wh66percent right offset-0">
							<script>
								//This is a fix for when the slider is used in a hidden div
								function testTriger(){
									setTimeout(function (){
										$(".cstyle01").resize();
									}, 500);	
								}
							</script>
													
						</div>
						<div class="clearfix"></div>

					</div>		
					
					<!-- TAB 6 -->					
											
				</div>
                
                
                <div class="abthost">
                	<h3 class="abtcnhost"><?php echo $this->lang->line('AD_R_About_Host'); ?> <?php echo $Apartment->firstname; ?></h3>
                    <div class="col-md-3">
                        <?php
                        if(isset($Apartment->profile_photo) && $Apartment->profile_photo != "" ) {
                            $aptOwnerImg = $Apartment->profile_photo;
                        } else if(isset($Apartment->agent_logo) && $Apartment->agent_logo != "") {
                            $aptOwnerImg = $Apartment->agent_logo;
                        } else {
                            $aptOwnerImg = ASSETS."/images/user-avatar.jpg";                    
                        }
                        ?>
                    	<div class="abthostimg"><img src="<?php echo $aptOwnerImg; ?>" alt="" /></div>
                    </div>

                    <?php  
                    if($responseTime <= 1) {
                        $responseTimeMsg = $this->lang->line('AD_Hour');
                    } else if($responseTime > 1 && $responseTime <= 4) {
                        $responseTimeMsg = $this->lang->line('AD_FewHour');
                    } else if($responseTime >= 5 ) {
                        $responseTimeMsg = $this->lang->line('AD_Day');
                    } else if($responseTime > 24) {
                        $responseTimeMsg = $this->lang->line('AD_FewDay');
                    } else if($responseTimeMsg == "") {
                        $responseTimeMsg = "";
                    } else {
                        $responseTimeMsg = "";
                    }
                    ?>
                    
                    <div class="col-md-9">
                    	<span class="abtabt">
                        	<?php echo $Apartment->about; ?>
                        </span>
                        <a class="viewfulprof" target="_blank" href="<?php  echo WEB_URL.'/users/show/'.$apartmentUserType.'/'.$apartmentUserId; ?>"><?php echo $this->lang->line('AD_View_Profile'); ?></a>
                        <ul class="somelistg">
                        	<li class="listingsome">
                        	<?php  
                        	$propOwnerName = $Apartment->address;
                        	if($propOwnerName != "") {
                        		echo $propOwnerName;
                        	} else {
                        		echo "";
                        	}
                        	?>
                        	</li>
                            <?php if($responseRate != "") { ?>
                                <li class="listingsome"><?php echo $this->lang->line('AD_Response_Rate'); ?> <strong><?php echo $responseRate; ?>%</strong></li>
                            <?php } ?>

                            <li class="listingsome"><?php echo $this->lang->line('AD_Member_Since'); ?> <?php echo date('M Y',strtotime($Apartment->register_date));?></li>
                            
                            <?php if($responseTime != "") { ?>
                                <li class="listingsome"><?php echo $this->lang->line('AD_Response_Time'); ?> <strong><?php echo $responseTimeMsg; ?></strong></li>
                            <?php } ?>
                        </ul>
                        <button class="cnthostabt popcontact" id="contacthost2"><?php echo $this->lang->line('AD_Contact_Host'); ?></button>
                    </div>
                    
                    <div class="clear"></div>
                    
                    <div class="rowabt">
                        <div class="col-md-3">
                            <span class="abthostlabl"><?php echo $this->lang->line('AD_Trust'); ?></span>
                        </div>
                        <div class="col-md-9">
                            <div class="full">
                                <div class="fulrowhaf">
                                    <span class="privaterum fagren">
                                        <span class="iconent"><img src="<?php echo ASSETS;?>images/vreview.png" alt=""  /></span>
                                    </span>
                                    <?php
								
									 ?>
                                    <span class="bigcot"><?php echo $host_review_count; ?> <?php echo $this->lang->line('AD_Reviews'); ?></span>
                                </div>

                                <?php if($verified_id->email == 1){ ?>
                                <div class="fulrowhaf">
                                    <span class="privaterum fayello">
                                        <span class="iconent"><img src="<?php echo ASSETS;?>images/vmail.png" alt=""  /></span>
                                    </span>
                                    <span class="bigcot"><?php echo $this->lang->line('AD_Email_Verified'); ?></span>
                                </div>
                                <?php } ?>

                                <?php if($verified_id->email == 1){ ?>
                                <div class="fulrowhaf">
                                    <span class="privaterum fablu">
                                        <span class="iconent"><img src="<?php echo ASSETS;?>images/vphone.png" alt=""  /></span>
                                    </span>
                                    <span class="bigcot"><?php echo $this->lang->line('AD_Phone_Verified'); ?></span>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
			</div>
        	</div>
		</div>
	</div>
<div id="add_wish_popup" style="width: 50%; display: none;">
<span class="buttonclose pop-close"><span>X</span></span>
    <div class="listingpopup">
     	<div class="popuphed">
        	<span class="popbighed"><?php echo $this->lang->line('AD_Save_To_Wishlist'); ?></span>
      	</div>
        <div class="popconyent">
        	<div class="poprow">
             	<img style="float: left" class="wish_pop_img" src="" width="100">
             	<b><p style="float: left; padding-left: 20px" class="wish_pop_label"></p></b>
            </div>

         	<div class="poprow">
             	<span class="poplabel"><?php echo $this->lang->line('AD_Select_Wishlist'); ?></span>
                	<select class="popupselect wishlist_type">
                		
                	<?php if(!empty($wishlist)) { ?>
                		<?php foreach($wishlist as $wishlist_key) { ?>
                			<option value="<?php echo $wishlist_key->wishlist_type_id; ?>"> <?php echo $wishlist_key->wishlist_type_name; ?> </option>
                		<?php } ?>
                	<?php } ?>

                	</select>
            </div>
            <div class="poprow">
             	<span class="poplabel"><?php echo $this->lang->line('AD_Addnote'); ?></span>
                <textarea rows="4" class="wish_note" style="width: 100%"></textarea>
            </div>
            
        </div>
        
        <div class="popfooter">
        	<button id="addWishListDetail" class="popbutton blubutton"><?php echo $this->lang->line('AD_Add_Wishlist'); ?></button>
        	<button class="popbutton" onclick="$('#add_wish_popup').provabPopup().close()"><?php echo $this->lang->line('AD_Cancel'); ?></button>	
        </div>
    </div>
</div>

    
<div class="hostpopup" id="msgSntPopUp" style="height: 50%">
	<span class="buttonclose pop-close"><span>X</span></span>
    <div class="listingpopup">
    	<div class="popuphed">
        	<span class="popbighed"><?php echo $this->lang->line('AD_Message'); ?></span>
      	</div>
        <div class="poprow" style="text-align: center">
			<h3><?php echo $this->lang->line('AD_Sent_Message'); ?></h3>            
        </div>
    </div>
</div>

    
    
<div id="contact_to_pop_up" class="hostpopup">
	<div class="listingpopup">
        <div class="popuphed">
            <span class="popbighed"><?php echo $this->lang->line('AD_Send_Message'); ?> <?php echo $Apartment->firstname; ?></span>
        </div>
        <form action="<?php echo WEB_URL.'/messages/contactHost'; ?>" id="cntctHst">
        <div class="popconyent">
        
            <div class="poprow">
            	<div class="col-md-4">
                	<span class="poplabel"><?php echo $this->lang->line('AD_Checkin'); ?></span>
                    <input id="checkin" name="check_in" required class="mySelectCalenda calinput flyinput popdatepkr" type="text" placeholder="" readonly>
                </div>
                <div class="col-md-4">
                	<span class="poplabel"><?php echo $this->lang->line('AD_Checkout'); ?></span>
                	<input id="checkout" name="check_out" required class="mySelectCalenda calinput flyinput popdatepkr" type="text" placeholder="" readonly>
                </div>
                <div class="clear"></div>
                <br>
                <div class="col-md-4">
                	<span class="poplabel"><?php echo $this->lang->line('AD_Adult'); ?></span>
                    <input type="number" name="adltCnt" id="adltCnt" class="popinpts" number="true" min="1" />
                </div>
                <div class="col-md-4">
                	<span class="poplabel"><?php echo $this->lang->line('AD_Child'); ?></span>
                     <input type="number" name="childCount" id="childCount" class="popinpts" number="true" min="0" />
                </div>
                <div class="col-md-4">
                	<span class="poplabel"><?php echo $this->lang->line('AD_Infant'); ?></span>
                    <input type="number" name="infantCount" id="infantCount" class="popinpts" number="true" min="0" />
                </div>
            </div>
            <div class="poprow">
            	<div class="col-md-12">
                	<span class="poplabel"><?php echo $this->lang->line('AD_Some_Tips'); ?></span>
                    <ul class="tipul">
                    	<li class="tipli"><?php echo $this->lang->line('AD_Tell'); ?> <?php echo $Apartment->firstname; ?> <?php echo $this->lang->line('AD_Yourself'); ?></li>
                        <li class="tipli"><?php echo $this->lang->line('AD_I_Content1'); ?> </li>
                        <li class="tipli"><?php echo $this->lang->line('AD_I_Content2'); ?> </li>
                    </ul>
                    <input type="hidden" name="cntctrId" value="<?php echo $Apartment->USER_ID; ?>">
                   	<input type="hidden" name="cntctrType" value="<?php echo $Apartment->USER_TYPE; ?>">
                   	<input type="hidden" name="prop_id" value="<?php echo $Apartment->PROPERTY_ID; ?>">
                </div>
            </div>
            <div class="poprow">
            	<div class="col-md-12">
                	<textarea class="telltextarea" id="cntctHstMsg" name="msgCntnt" required></textarea>
                </div>
            </div>
        </div>
        <div class="popfooter">
        	<div class="col-md-7">
            	<?php echo $this->lang->line('AD_I_Content3'); ?>
            </div>
            <div class="col-md-5">
            	<button id="" class="popbutton blubutton" type="submit" name="nextloc"><?php echo $this->lang->line('AD_Send'); ?></button>
            </div>
        
        </div>
        </form>
	</div>
</div>
    
    
	<!-- END OF CONTENT -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript">window.onload = function () {dinitialize(<?php echo $Apartment->PROP_LATITUDE;?>, <?php echo $Apartment->PROP_LONGITUDE;?>);CalculateRent();}</script>
<?php $this->load->view('common/footer');?>

<script type="text/javascript" src="<?php echo ASSETS; ?>js/messages/messages.js " ></script>
<script type="text/javascript" src="<?php echo ASSETS;?>js/apartment.js"></script>
<script src="<?php echo ASSETS;?>js/jquery.provabslideshow.js"></script>

<script>
//setTimeout(function(){CalculateRent();}, 3000);

function CalculateRent() {
	var fromDate = $('#from').datepicker('getDate');
    var toDate = $('#to').datepicker('getDate');
    var gs = $('#guests option:selected').val();
    if (fromDate && toDate) {
        var difference_msec = toDate.getTime() - fromDate.getTime();
        var difference_days = difference_msec / 86400000;
        //$("#nights").val(Math.ceil(difference_days));
        var nights = Math.ceil(difference_days);
        	
        //console.log(Math.ceil(nights));
        var fromDate = $('#from').val();
        var toDate = $('#to').val();
        var checkin = 'checkin='+fromDate;
        var checkout = '&checkout='+toDate;
        var adult = $('#adult option:selected').val();
        var child = $('#child option:selected').val();
        var infant = $('#infant option:selected').val();
        var guests = "<?php if($this->input->get('guests')){ echo $this->input->get('guests');}else{ echo '0';}?>"
        var url = '<?php echo $DetailUrl;?>';
        if(guests == 0){
        	url = url+checkin+checkout;
    	}else{
    		guests = '&guests='+guests;
    		url = url+checkin+checkout+guests;
    	}
    	if(adult > 0){
    		adult = '&adult='+adult;
        	url = url+adult;
    	}
    	if(child > 0){
    		child = '&child='+child;
        	url = url+child;
    	}
    	if(infant > 0){
    		infant = '&infant='+infant;
        	url = url+infant;
    	}

    	if(gs >= 1){
    		guests = '&guests='+gs;
    		var url = '<?php echo $DetailUrl;?>';
        	url = url+checkin+checkout+guests;
    	}
    	var pid = '<?php echo $Apartment->PROPERTY_ID;?>';
        //console.log(url);
        history.pushState(null,'title',url);
        $('#nights').val(nights);
        var adult = $('#adult option:selected').val();
        var child = $('#child option:selected').val();
        var infant = $('#infant option:selected').val();
        RentCalculation(fromDate, toDate, gs, nights, pid, adult, child, infant);
    }
}
function RentCalculation(fromDate, toDate, gs, nights, pid, adult, child, infant){
	$.ajax({
       type: "GET",
       url: WEB_URL+'/apartment/CalculateRent',
       data: {checkin: fromDate, checkout: toDate, guests: gs, nights: nights, pid: pid, adult: adult, child: child, infant: infant},
       dataType: 'json',
       beforeSend: function(){
          $('.lodrefrent').show();
       },
       success: function(res){
         $('.pernight').html(res.price_per);
         $('#Total').val(res.total_price_nor);
         var str = JSON.stringify(res);
         $('#rent').val(str);
         $('strong.rentType').text(res.rentType);
         if(!res.status){
         	var template = $('#RentTemplateErr').html();
         }else{
         	var template = $('#RentTemplate').html();
         }
         var output = Mustache.render(template, res);
		 $('.pricetable').html(output);
         $('.advserchbtn').show();
		 setTimeout(function(){ $('.lodrefrent').hide();}, 1000);
	   }
    });
}

$(document).ready(function() {

 $(".tooltipa").tooltip();

    //$('#from').datepicker({dateFormat: 'dd-mm-yyyy'}).datepicker('setDate', new Date(2014, 10, 26));
	$('#contacthost, #contacthost2').bind('click', function(e) {
    	e.preventDefault();
        from = $('#from').val();
        to = $('#to').val();
        a = $('#adult').val();
        c = $('#child').val();
        i = $('#infant').val();
        $('#adltCnt').val(a);
        $('#childCount').val(c);
        $('#infantCount').val(i);
        $('#checkin').val(from);
        $('#checkout').val(to);
       
        $.ajax({
            url: "<?php echo WEB_URL.'/wishlist/userAccessCheck' ?>",
            dataType: "json",
            success: function(r) {
                if(r.status == 1) {
                    $('#contact_to_pop_up').provabPopup({
                        modalClose: true, 
                        zIndex: 10000005
                    }); 
                } else {
                    $('#fadeandscale').popup("show");
                }
            },
            error: function(r) {
                $('#fadeandscale').popup("show");
            }
        })
    });	
		

      $("#owl-demo2").owlCarousel({
        items : 1,
		itemsDesktop : [1199,1],
		itemsDesktopSmall : [979,1],
        lazyLoad : true,
		pagination : false,
        navigation : true
      });
	  $(".provabslideshow").provabslideshow({
            mobile: true
        });

    });
</script>
<script type="text/template" id="RentTemplate">
<ul>
	<li class="pricetableli">
    	<div class="labldesc"><span class="currency curr_icon"><?php echo $this->display_icon;?></span><span class="amount">{{price_per}}</span> * {{nights}}</div>
        <div class="lablprice"><span class="currency curr_icon"><?php echo $this->display_icon;?></span>{{RentSubtotal}}</div>
    </li>
    <li class="pricetableli">
    	<div class="labldesc"><div class="left"><?php echo $this->lang->line('AD_Service_Fee'); ?> </div>
    	    		<a class="tooltipa icon icon-info" title="<?php echo $this->lang->line('AD_Fee_Charge'); ?>"></a>
    	</div>
        <div class="lablprice"><span class="currency curr_icon"><?php echo $this->display_icon;?></span><span class="amount">{{service_charge}}</span></div>
    </li>
    <li class="pricetableli">
    	<div class="labldesc"><?php echo $this->lang->line('AD_Total'); ?></div>
        <input type="hidden" value="{{total_price_nor}}" name="apcartp" id="apcartp" required/>
        <div class="lablprice"><span class="currency curr_icon"><?php echo $this->display_icon;?></span><span class="amount">{{RentFulltotal}}</span></div>
    </li>
</ul>
</script>
<script type="text/template" id="RentTemplateErr">
<ul>
	<li class="pricetableli">
        <input type="hidden" value="0" name="apcartp" id="apcartp" required/>
    	<div class="rentErr">{{reason_message}}</div>
    </li>
</ul>
</script>
<script type="text/javascript" src="<?php echo ASSETS;?>js/wishlist/wishlist.js"></script>
<script type="text/javascript" src="<?php echo ASSETS;?>js/datepicker_availability.js"></script>
<script type="text/javascript">
$(function() {
    
    $('#from').datepicker({
        numberOfMonths: 1,
        firstDay: 1,
        dateFormat: 'dd-mm-yy',
        minDate: '0',
        maxDate: '+2Y',
        beforeShowDay: setCustomDate,
        onSelect: function(dateStr) {
            var d1 = $(this).datepicker("getDate");
            d1.setDate(d1.getDate() + 1); // change to + 1 if necessary
            var d2 = $(this).datepicker("getDate");
            d2.setDate(d2.getDate() + 30); // change to + 29 if necessary
            $("#to").datepicker("setDate", d1);
            $("#to").datepicker("option", "minDate", d1);
            //$("#to").datepicker("option", "maxDate", d2);
            CalculateRent();
        },
        onClose: function(){
          $('#to').focus();
        }
    });
    $('#to').datepicker({
        numberOfMonths: 1,
        firstDay: 1,
        dateFormat: 'dd-mm-yy',
        minDate: '0',
        maxDate: '+2Y',
        beforeShowDay: setCustomDate,
        onSelect: function(dateStr) {
            CalculateRent();
        }
    });
});
	$(function(){
			$('#f_date1').datepicker({
				inline: true,
				showOtherMonths: true,
				dateFormat: 'dd/mm/yy',
				minDate: '01/11/2013',
				maxDate: '31/01/2014',
				dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
				beforeShowDay: setCustomDate
			});
		});
	
	var natDays = [[1, 26, 'au'], [2, 6, 'nz'], [3, 17, 'ie'], [4, 27, 'za'], 
    [5, 25, 'ar'], [6, 6, 'se'], [7, 4, 'us'], [8, 17, 'id'], 
    [9, 7, 'br'], [10, 1, 'cn'], [11, 22, 'lb'], [12, 12, 'ke']];
	
	//var highlight = ['11/25/2013', '11/30/2013'];   // Hightlight a specific of dates
	var enableDaysRange = [<?php foreach ($available_all_dates as $dates) {?>["<?php echo date('m-d-Y',strtotime($dates->CHECK_IN));?> to <?php echo date('m-d-Y',strtotime($dates->CHECK_OUT));?>"],<?php }?>];       // Enable a range of dates
	var weekdays = [1,2,3,4,5,6,7];				// Enable a array of weekdays
    //var enableDaysRange = [["11-01-2014 to 11-30-2014"]];       // Enable a range of dates
	//var disabledDays = ["2-13-2015"];   // Disable an array of booked days
	var disabledDays = [<?php foreach ($booked_all_dates as $date) {?>"<?php echo date('n-j-Y',strtotime($date));?>", <?php }?>];  // Disable a array of booked days
	//var disabledDays = ["11-18-2014", "11-23-2014", "09-13-2015"];   // Disable a array of booked days
    function setCustomDate(date) {
		//var clazz = "";
		//var arr1 = highlightDays(date);
		//if (arr1[1] != "") clazz = arr1[1];
		
		// var  d = date.getDate(),
  //       m = date.getMonth()+1,
  //       y = date.getFullYear();
				
		// if (specialDays[y] && specialDays[y][m] && specialDays[y][m][d]) {
		// 	var s = specialDays[y][m][d];
		// 	return [true, s.className, s.tooltip]; // selectable
		// }
			var arr2 = enableRangeOfDays(date);
			//var arr3 = enableWeekday(date);
			var arr4 = disableAllTheseDays(date);
			return [(!arr2[0] || !arr4[0]) ? false : true];
	}
	
	
	//$.datepicker.noWeekends
    
    function createListingPagination() {}
    function createReservationHistoryPagination() {}
    function BookingPagination() {}
    function createRvwPagination() {}
    function createRefByYouPagination() {}
</script>
</body>
</html>
