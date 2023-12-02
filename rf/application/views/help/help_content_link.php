<?php $this->load->view('common/header');?>
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS;?>css/helpmenu.css" />

<?php $this->load->view('common/help_search_header.php'); ?>

<div class="full brdcrump">
	<div class="container">
    	<ul>
        	<li class="brdli active"><?php echo lang_line('HELP_CNTR');?></li>
        </ul>
    </div>
</div>	
<div class="clear"></div>		
<!-- CONTENT -->
<div class="full onlycontent">
	<div class="container">
		<div class="container offset-0">
			<div class="col-md-3 myfit">
            	<div class="columnsc">
					<div id="dl-menu" class="dl-menuwrapper">
                        <?php $combine_array_count = count($combine_array); ?>
						<?php if(!empty($combine_array_count)) { ?>
							<ul class="dl-menu dl-menuopen">
								<?php foreach($combine_array['master'] as $master) { ?>
									<li>
                                    <?php if($master['submenu_exist'] == 1) { ?>
										<a href="#"><?php echo $master['menu_option']; ?></a> <!-- Name of the master option -->
											 <ul class="dl-submenu">
												<?php foreach($combine_array['sub'] as $sub) { ?>
													<?php if($master['menu_id'] == $sub->menu_id) { ?>
														<li>
															<a class="get_content" href="<?php echo WEB_URL.'/help/article/'.$master['menu_id'].'/',$sub->sub_menu_id; ?>">
                                                                <?php echo $sub->sub_menu_title; ?>
                                                            </a>	
														</li>
													<?php } ?>
												<?php } ?>
											</ul>
										<?php } else {  ?>
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
            	
                <div id="articleLoad">
                    
                    <?php if(!empty($contentObject)) { ?>
                    
                    <div class="full martb">
                    	<h3 class="inpagehed" id="contentTitle">
                            <?php echo $contentObject->con_title; ?>
                        </h3>
                        <div class="contentdivi">
                        	<div class="col-md-8 my8n">
                        		<h4 class="divihed" id="contentSubHead"></h4>
                                <div class="divip" id="contentBody"> <?php echo $contentObject->content; ?> </div>
                            </div>
                            <div class="col-md-4 my4n">
                                <div class="demonsimg" id="contentImage">
                                    <?php if(isset($contentObject->sub_image) && !empty($contentObject->sub_image) && $contentObject->sub_image != "no image" ) { ?>
                                        <img src=" <?php echo help_upload_dir.'/admin/upload_files/help_desk/'.$contentObject->sub_image; ?> ">
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div id="articleReview">
                        
                    </div>

                    <?php } else { ?>

                    <div class="full martb">
                        <h3 class="inpagehed" id="contentTitle">
                            <i><?php echo lang_line('NO_CONTENT');?></i>
                        </h3>
                        <div class="contentdivi">
                            <div class="col-md-8 my8n">
                                <h4 class="divihed" id="contentSubHead"><?php echo lang_line('NO_CONTENT_MSG');?></h4>
                                <div class="divip" id="contentBody"></div>
                            </div>

                            
                            <div class="clear"></div>
                        </div>
                    </div>
                    <?php } ?>
                </div>


              
                <div id="contentLink">

                    <div class="full martb" id="articleDynamicLoad">
                        <h3 class="inpagehed" id="contentTitle"></h3>
                        <div class="contentdivi">
                            <div class="col-md-8 my8n">
                                <h4 class="divihed" id="contentSubHead"></h4>
                                <div class="divip" id="contentBody"></div>
                            </div>
                            <div class="col-md-4 my4n">
                                <div class="demonsimg" id="contentImage">
                                    <?php if(isset($contentObject->sub_image) && !empty($contentObject->sub_image) && $contentObject->sub_image != "no image" ) { ?>
                                        <img src=" <?php echo help_upload_dir.'/admin/upload_files/help_desk/'.$contentObject->sub_image; ?> ">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>

                <div class="full martb" id="searchLoad">
                    <h3 class="inpagehed"> 
                        <span id="resultCounter"></span> 
                           <?php echo lang_line('RSLT_FOR');?>
                        <span id="resultSearchTerm"></span>
                    </h3>
                    <div class="contentdivi" id="searchResultList"></div>
                </div>

                <div class="clear"></div>
                
                
                
                
                
            </div>
		</div>
	</div>
</div>

<div class="clearfix"></div>

<script type="text/javascript">
    $('#searchLoad').hide();
    $('#articleDynamicLoad').hide();
</script>

<?php // echo ASSETS.'js/help_center/help_center.js';?>
<script src="<?php echo ASSETS.'js/help_center/help_center.js'; ?>"></script>
<?php $this->load->view('common/footer');?>

