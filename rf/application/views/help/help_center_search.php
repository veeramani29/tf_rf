<?php $this->load->view('common/header');?>
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS;?>css/helpmenu.css" />
<?php $this->load->view('common/help_search_header.php'); ?>

<div class="full brdcrump">
	<div class="container">
    	<ul>
        	<li class="brdli"><a><?php echo lang_line('HELP_CNTR');?></a></li>
            <li class="brdli active"><a><?php echo lang_line('ACCNT');?></a></li>
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
						<?php $count = count($combine_array); if(!empty($count)) { ?>
							<ul class="dl-menu dl-menuopen">
								<?php foreach($combine_array['master'] as $master) { ?>
									<li>
                                    <?php if($master['submenu_exist'] == 1) { ?>
										<a href="#"><?php echo $master['menu_option']; ?></a> <!-- Name of the master option -->
											
											 <ul class="dl-submenu">
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
            	
                <div class="full martb" id="contentLoad">
                    <h3 class="inpagehed" id="contentTitle"></h3>
                    <div class="contentdivi" style="border-bottom: 4px solid #dedede">
                        <div class="col-md-8 my8n">
                            <h4 class="divihed" id="contentSubHead"></h4>
                            <div class="divip" id="contentBody"></div>
                        </div>
                        <div class="col-md-4 my4n">
                            <div class="demonsimg" id="contentImage"></div>
                        </div>

                        <div class="clear"></div>
                    </div>
                </div>
                
                <div class="clear"></div>

                <div class="full martb" id="searchLoad">
                	
                    <h3 class="inpagehed"> 
                        <span id="resultCounter"><?php echo $searchCount; ?></span> 
                           <?php echo lang_line('RSLT_FOR');?>
                        <span id="resultSearchTerm">'<?php echo $this->input->get('q'); ?>'</span>
                    </h3>

                    <div class="contentdivi" id="searchResultList">
                    <?php foreach($searchResult as $result) { ?>
                        
                        <div class="col-md-10 my8n" style="padding-top: 10px">
                            <h4 class="divihed searchArticleTitle">
                                <i class="icon-file-text"></i>
                                    <a class="get_search_content" href="<?php echo WEB_URL.'/help/article/'.$result->menu_id.'/'.$result->sub_menu_id; ?>"><?php echo $result->con_title; ?> </a>
                            </h4>
                            <div class="divip searchArticleBody">
                                <?php 
                                    $articleContent = strip_tags($result->content); 

                                    if(strlen($articleContent) > 200) {
                                        $articleContentSlice = substr($articleContent, 0, 200);
                                    } else {
                                        $articleContentSlice = $articleContent;
                                    }
                                    echo $articleContentSlice.'...';
                                ?>
                            </div>
                        </div>
                         <div class="clear"></div>
                         <div style="border-bottom: 1px solid #dedede; margin: 20px 0px 0px 0px"></div>

                    <?php } ?>
                    
                    </div>
                </div>
                
                <div class="clear"></div>
            </div>
		</div>
	</div>
</div>

<div class="clearfix"></div>

<script type="text/javascript">
    $('#contentLoad').hide();
</script>


<?php // echo ASSETS.'js/help_center/help_center.js';?>
<script src="<?php echo ASSETS.'js/help_center/help_center.js' ?>"></script>
<?php $this->load->view('common/footer');?>
