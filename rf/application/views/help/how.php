<?php $this->load->view('common/header');?>

<link rel="stylesheet" type="text/css" href="<?php echo ASSETS;?>css/helpmenu.css" />
<!-- <link rel="stylesheet" type="text/css" href="<?php echo ASSETS;?>css/custom.css" /> -->
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS;?>css/dashboard-style.css" />
<?php $this->load->view('common/help_search_header.php'); ?>

<div class="full brdcrump">
	<div class="container">
		<ul>
			<li class="brdli active"><a><?php echo lang_line('HELP_CNTR');?></a></li>
		</ul>
	</div>
</div>	

<div class="clear"></div>		

<!-- CONTENT -->
<div class="howitworks_container">
	<div class="container">
		<div class="rfboxed-background">
			<div class="col-md-3 myfit">
				<div class="columnsc">
					<div id="dl-menu" class="dl-menuwrapper">
						<?php $count = count($combine_array);if(!empty($count)) { ?>
						<ul class="list-inline hiw_leftbarmenu">
							<?php foreach($combine_array['master'] as $master) { ?>
							<li>
								<?php if($master['submenu_exist'] == 1) { ?>
								<a href="#"><?php echo $master['menu_option']; ?></a> <!-- Name of the master option -->

								<ul class="list-inline">
									<?php foreach($combine_array['sub'] as $sub) { ?>
									<?php if($master['menu_id'] == $sub->menu_id) { ?>
									<li>
										<?php  
										$menu_id = $master['menu_id'];
										$submenu_id = $sub->sub_menu_id;
										?>
										<a class="get_content" href="<?php echo WEB_URL.'/help/article/'.$master['menu_id'].'/',$sub->sub_menu_id; ?>">
											<?php echo $sub->sub_menu_title; ?>
										</a>	
									</li>
									<?php } ?>
									<?php } ?>
								</ul>
								<?php } else { ?>
								<a class="get_content" href="<?php echo WEB_URL.'/help/article/'.$master['menu_id'].'/0'; ?>">
									<?php echo $master['menu_option']; ?>
								</a>
								<?php } ?>
							</li>
							<?php } ?>
						</ul>
						<?php } ?>
					</div><!-- /dl-menuwrapper -->
				</div>
			</div>
			<div class="col-md-9 myfit2">
				<div id="contentLoad">
					<div class="full">
						<h3 class="inpagehed" id="contentTitle"><?php echo lang_line('HOW_IT_WORKS');?></h3>                        
						<div class="contentdivi">
							<div class="col-md-8 my8n">
								<h4 class="divihed" id="contentSubHead"></h4>
								<div class="divip" id="contentBody">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>                          
							</div>
							<div class="col-md-4 my4n">
								<div class="demonsimg" id="contentImage">
									<img src="<?php echo ASSETS;?>images/how1.png" alt="" />
								</div>
							</div>
							<div class="clear"></div>
							<div class="fullmorehow">
								<h4 class="divihedsub">A Community Built on Sharing</h4>
								<p class="divip">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><br>
								<h4 class="divihedsub">A Community Built on Sharing</h4>
								<p class="divip">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><br>
								<h4 class="divihedsub">A Community Built on Sharing</h4>
								<p class="divip">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
							</div>

						</div>
					</div>
				</div>

				<div id="articleReview"></div>

				<div id="contentLink"></div>

				<div class="full martb" id="searchLoad">

					<h3 class="inpagehed"> 
						<span id="resultCounter"></span> 
						 <?php echo lang_line('RSLT_FOR');?>
						<span id="resultSearchTerm"></span>
					</h3>

					<div class="contentdivi" id="searchResultList">

					</div>
				</div>

				<div class="clear"></div>

			</div>
		</div>
	</div>
</div>

<div class="clearfix"></div>

<script type="text/javascript">
$('#searchLoad').hide();
</script>
<script type="text/javascript">

</script>

<?php // echo ASSETS.'js/help_center/help_center.js'; ?>
<script src="<?php echo ASSETS.'js/help_center/help_center.js' ?>"></script>
<?php $this->load->view('common/footer');?>
