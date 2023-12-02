<?php $this->load->view('common/header');?>
<link rel="stylesheet" href="<?php echo ASSETS;?>css/uploadfile.min.css" type="text/css" media="screen" />
<link type="text/css" media="all" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" />
<link rel="stylesheet" href="<?php echo ASSETS;?>css/bootstrap-multiselect.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS;?>css/custom.css" />
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS;?>css/dashboard-style.css" />
<style type="text/css">.pac-container:after{content: initial !important;}</style>
<div class="clear"></div>
<!-- CONTENT -->

<div class="full brdcrump marintopcnt dashnav_container">
    <div class="container">
        <ul class="nav nav-pills">
            <li class=""> 
                <a href="<?php echo base_url().'dashboard' ?>" class="dshbrdLnk"><?php echo lang_line('DASHBOARD');?></a> 
            </li>
            <li class="active"> 
                <a href="<?php echo base_url().'dashboard/profile' ?>" class="dshbrdLnk"><?php echo lang_line('UR_PRFL');?></a> 
            </li>
            <li class=""> 
                <a  href="<?php echo base_url().'dashboard/bookings'; ?>" class="dshbrdLnk"> <?php echo lang_line('BOOKINGS');?> </a> 
            </li>
            <li class=""> 
                <a href="<?php echo base_url().'dashboard/settings'; ?>" class="dshbrdLnk"><?php echo lang_line('SETTINGS');?> </a> 
            </li>
          
            <!-- <li class="<?php if (!empty($page_type) && $page_type == "newsletter") {echo "active";} ?>"> 
                <a href="#newsletter" data-toggle="tab" onclick="mySelectUpdate()" data-link="<?php echo base_url().'dashboard/newsletter'; ?>" class="dshbrdLnk"> <?php echo lang_line('NEWS_LTR');?> </a> 
            </li> -->
        </ul>
    </div>
</div>
<div class="clear"></div>


<div class="dashboard_profilecontainer">
	<div class="container martopbtm">
		<div class="tab-content5">
			<div class="msg" style="display: none;"></div>
			<div class="tab-pane padding20me active" id="dashbord">
				<?php if(isset($key) && $key != ''){$this->load->view('public_profile/references');}?>
			</div>
			<div class="clear"></div>
			<div class="rfboxed-background">
			<div class="col-md-3">
				<div class="userprowrp forprof">
					<div class="profileusrs">
						<div class="item">
							<img src="<?php  echo isset($userInfo->profile_photo) ? $userInfo->profile_photo : $userInfo->agent_logo; ?>" alt="<?php echo $userInfo->firstname.' '.$userInfo->lastname;?>" class="profile_photo " title="<?php echo $userInfo->firstname.' '.$userInfo->lastname;?>"/>
						</div>
					</div>
				</div>
				<div class="sidewiserow">
					<h3 class="sidewisehed"><?php echo lang_line('ABOUT_ME');?></h3>
					<ul class="qlinkul">
						<?php if($userInfo->work != '' || $userInfo->work != NULL){?>
						<li class="abtmes"><span class="bolddesig">Work</span><?php echo $userInfo->work;?></li>
						<?php }?>
						<?php 
						if($userInfo->languages != '' || $userInfo->languages != NULL){
							$languages = explode(',', $userInfo->languages);
							foreach ($languages as $language) {
								$lang = $this->account_model->getLanguageById($language)->row();
								$langs[] = $lang->language;
							}
							$languages = implode(', ', $langs);
							?>
							<li class="abtmes"><span class="bolddesig">Languages</span><?php echo $languages;?></li>
							<?php }?>
							
						</ul>

					</div>
					<div class="clear"></div>
					<?php if(!empty($listings)){?>
					<h4 class="listingcunt">Listings (<?php echo count($listings);?>)</h4>
					<ul>
						<?php $i=1;foreach($listings as $k) { ?>
						<a href="<?php echo WEB_URL.'/apartment/rooms/'.$k->PROPERTY_ID; ?>">
							<li class="imagelisting">
								<div class="absimagesent"><?php echo $k->PROP_TYPE_LABEL; ?> in <?php echo $k->PROP_CITY; ?></div>

								<?php foreach($listing_photo as $photo_obj_k) { ?>
								<?php if(!empty($photo_obj_k)) { ?>
								<?php foreach($photo_obj_k as $photo_k) { ?>
								<?php if($k->PROPERTY_ID == $photo_k->PROP_ID) { ?>
								<?php if($photo_k->PHOTO_CONTENT != ''){ $image = $this->apartment_model->view_property_file($photo_k->PHOTO_CONTENT); ?>
								<img src="<?php echo $image;?>" alt="" />
								<?php } ?>
								<?php } ?>
								<?php } ?>
								<?php } ?>
								<?php } ?>

							</li>
						</a>
						<?php if($i == 4){break;}$i++;} ?>           

					</ul>
					<?php }?>
				</div>

				<div class="col-md-9">
					<div class="marbtm20">
						<h3 class="haimsg">Hey, I'm <?php echo $userInfo->firstname.' '.$userInfo->lastname;?>! </h3>
						<div class="placemebr">
							<strong> <?php echo $userInfo->city.' '.$userInfo->country;?></strong> 
							Member since <?php echo date('M Y',strtotime($userInfo->register_date));?>
							<br>
							<?php 
							if($this->session->userdata('b2c_id')) {
								$id = $this->session->userdata('b2c_id'); 
							} else if($this->session->userdata('b2b_id')) {
								$id = $this->session->userdata('b2b_id'); 
							} else {
								$id = "";
							}
							if($id == $b2c_id){ 
								?>
								<a href="<?php echo WEB_URL;?>/dashboard/profile/update" class="editproos"><?php echo lang_line('LINE112');?></a>
								<?php }?>
							</div>

							<div class="memberdes">
								<?php echo $userInfo->about;?>
								<p>Cheers, </p>
								<div class="cldashsmal"><?php echo $userInfo->firstname.' '.$userInfo->lastname;?></div>
								<ul class="listingal">

									<?php if($reviewsCountAbtYou > 0){ ?>
									<li class="listof">
										<div class="inlistof">
											<strong><?php echo $reviewsCountAbtYou;?></strong>
											<b>Review<?php if($reviewsCountAbtYou > 1){?>s<?php }?></b>
										</div>
									</li>
									<?php }?>

									<?php if($referencesCount > 0){?>
									<li class="listof">
										<div class="inlistof">
											<strong><?php echo $referencesCount;?></strong>
											<b class="coorylo">Reference<?php if($referencesCount > 1){?></strong><?php }?></b>
										</div>
									</li>
									<?php }?>
								</ul>

								<div class="clear"></div>
								<?php if(!empty($publicWishlist)){?>
								<div class="mediumhed">Wish Lists<strong>(<?php echo $publicWishlist_count; ?>)</strong></div>

								<?php foreach($publicWishlist as $wishlist_key){ ?>

								<div class="col-md-12 nopad">
									<div class="col-md-4">
										<div class="listmg">
											<div class="hoverimglist" style="background:url(<?php echo ASSETS;?>images/d2.jpg) no-repeat center center"></div>
											<div class="fadelst"></div>
											<div class="intblcel">
												<h4 class="listcovername"><?php echo $wishlist_key->wishlist_type_name; ?></h4>
												<a href="<?php echo WEB_URL.'/users/wishlist/'.$user_type.'/'.$user_id.'/'.$wishlist_key->wishlist_type_id; ?>" class="listlink"><?php echo ($wishlist_key->counter == 0) ? "0" : $wishlist_key->counter; ?> Listing</a>
											</div>
										</div>
									</div>
								</div>

								<?php }} ?>

								<div class="clear"></div>

								<?php if($reviewsCountAbtYou > 0) { ?>
								<div class="mediumhed">Review<?php if($reviewsCountAbtYou > 1){?>s<?php }?><strong>| About <?php echo $userInfo->firstname; ?> (<?php echo $reviewsCountAbtYou; ?>)</strong></div>

								<?php 
								if($reviewsCountAbtYou>0) {
									?>
									<div id="rvuAbtU_container">
										<?php foreach($reviewsCount_prop_d as $k) { ?>
										<div class="col-md-12 nopad marbtm20flot">
											<div class="col-md-3">
												<a href="<?php echo WEB_URL;?>/users/show/<?php echo $k->user_id;?>">
													<div class="reviwuser"><img src="<?php echo $k->profile_photo ?>" alt="" /></div>
													<div class="revusrname"><?php echo $k->firstname; ?></div>
												</a>
											</div>
											<div class="col-md-9">
												<div class="reviewpara">
													<span class="reviewparalines"><?php echo $k->review_comments; ?></span>
													<!-- <span class="pmore"><span class="icon icon-plus"></span>More</span> -->

													<div class="revdate"><?php echo date('M d, Y',strtotime($k->posted_time)); ?></div>
												</div>
											</div>
										</div>
										<?php } ?>

									</div>
									<?php } ?>
									<div class="clear"></div>

									<div class="col-md-12 nopad marbtm20flot">
										<div class="col-md-3">&nbsp;</div>
										<div class="col-md-9 lormoreno">
											<?php if($reviewsCountAbtYou > 3){ ?>
											<?php //javascript resides in the user_profile.js ?>
											<a class="rlodmr" href="#" id="rvuAbtu" data-ppu = '<?php echo $b2c_id; ?>' data-ppt = '<?php echo $user_type; ?>' data-abtu_lf = '3' data-abtu_tr = '3' >
												Load More<span class="caretdown"></span>
											</a> <!-- About you from host -->
											<span style="display: none;" class="norvwmsg nomorrev">No More Reviews</span>
											<?php } ?>
											<img class="rvuAbtu_loader" style="display: none" src="<?php echo ASSETS.'/images/loader.gif'; ?>">

										</div>
									</div>

									<?php } ?>



									<div class="clear"></div>

									<!-- Reviews about property by guest -->

									<?php  if($reviewsCountAbtProperty > 0) { ?>
									<div class="mediumhed">Review<?php if($reviewsCountAbtProperty > 1){?>s<?php }?><strong>| About <?php echo $userInfo->firstname.'\'s hospitality'; ?> (<?php echo $reviewsCountAbtProperty; ?>)</strong></div>
									<?php if($reviewsCountAbtProperty > 0) { ?>

									<div id="rvuAbtProp_container">

										<?php foreach($reviewsAbtProperty as $k) { ?>
										<div class="col-md-12 nopad marbtm20flot">

											<div class="col-md-3">
												<a href="<?php echo WEB_URL;?>/users/show/<?php echo $k->user_id;?>">
													<div class="reviwuser"><img src="<?php echo $k->profile_photo ?>" alt="" /></div>
													<div class="revusrname"><?php echo $k->firstname; ?></div>
												</a>
											</div>

											<div class="col-md-9">
												<div class="reviewpara">
													<span class="reviewparalines"><?php echo $k->review_comments; ?></span>
													<div class="revdate"><?php echo date('M d, Y',strtotime($k->posted_time)); ?></div>
												</div>
											</div>
										</div>


										<?php  } ?>

									</div>

									<?php  } ?>

									<?php if($reviewsCountAbtProperty > 3){ ?>
									<a href="#" class="rlodmr" id="rvuAbtProp" data-ppu = '<?php echo $b2c_id; ?>' data-abtprop_lf = '3' data-abtprop_tr = '3' >
										Load More<span class="caretdown"></span>
									</a> <!-- About you from host -->
									<span style="display: none;" class="norvwpropmsg nomorrev">No More Reviews</span>
									<?php } ?>
									<img class="rvuAbtProp_loader" style="display: none" src="<?php echo ASSETS.'/images/loader.gif'; ?>">

									<?php } ?>





									<?php if($referencesCount > 0){ ?>
									<div class="mediumhed">References<strong>(<?php echo $referencesCount;?>)</strong></div>
									<div id="referenceContainer">
										<?php foreach($referencesAboutYou as $reference){ ?>
										<div class="col-md-12 nopad marbtm20flot">
											<div class="col-md-3">
												<a href="<?php echo WEB_URL;?>/users/show/<?php echo $reference->user_id;?>">
													<div class="reviwuser"><img src="<?php echo $reference->profile_photo; ?>" alt="" title="<?php echo $reference->firstname;?>"/></div>
													<div class="revusrname"><?php echo $reference->firstname;?></div>
												</a>
											</div>
											<div class="col-md-9">
												<div class="reviewpara">
													<span class="reviewparalines">
														<?php echo $reference->msg;?>
														<span class="expand"></span>
													</span>
													<?php if (strlen($reference->msg)>700) {?>
													<span class="pmore"><span class="icon icon-plus"></span>More</span>
													<?php }?>
													<div class="nameauthr"><?php echo $reference->firstname;?> is a <?php echo $reference->relation;?></div>
													<div class="revdate"> <?php  echo date('M d, Y',strtotime($reference->timestamp));?></div>

												</div>
											</div>
										</div>


										<?php } ?>
									</div>
									<?php if($referencesCount > 3){ ?>
									<a href="#"  class="rlodmr" id="rfrnce" data-ppu = '<?php echo $b2c_id; ?>' data-abtref_lf = '3' data-abtref_tr = '3' >
										Load More<span class="caretdown"></span>
									</a> <!-- About you from host -->
									<span style="display: none;" class="norefmsg nomorrev">No More References</span>
									<?php } ?>
									<img class="rfrnce_loader" style="display: none" src="<?php echo ASSETS.'/images/loader.gif'; ?>">
									<?php } ?>


								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
			<div class="clearfix"></div>
			<script type="text/javascript" src="<?php echo ASSETS.'/js/user_profile/user_profile.js' ?>"></script>
			<?php $this->load->view('common/footer');?>