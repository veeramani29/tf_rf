<?php $this->load->view('common/header');?>
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS;?>css/helpmenu.css" />
<script type="text/javascript" src="<?php echo ASSETS;?>js/history"></script>
<div class="full marintop toplitileimg">
<div class="shadeback"></div>
    <div class="container">
    	<div class="helpsearch">
        	<input type="text" class="serchhlp" placeholder="Serch the help center" />
            <input type="submit" class="helpgo" value="" />
        </div>
        <div class="popsrch">
        	<ul>
            	<li class="poli"><strong><?php echo lang_line('Popular_Searches');?></strong></li>
                <li class="poli"><a>paying</a></li>
                <li class="poli"><a>working</a></li>
                <li class="poli"><a>taxes</a></li>
                <li class="poli"><a>policies</a></li>
            </ul>
        </div>
    </div>
</div>   
<div class="clear"></div>	

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
						<?php if(!empty(count($combine_array))) { ?>
							<ul class="dl-menu dl-menuopen">
								<?php foreach($combine_array['master'] as $master) { ?>
									<li>
										<a href="#"><?php echo $master['menu_option']; ?></a> 
											<?php if($master['submenu_exist'] == 1) { ?>
											<ul class="dl-submenu">
												<?php foreach($combine_array['sub'] as $sub) { ?>
													<?php if($master['menu_id'] == $sub->menu_id) { ?>
														<li>
															<a href="#"><?php echo $sub->sub_menu_title; ?></a>	
														</li>
													<?php } ?>
												<?php } ?>
											</ul>
										<?php } ?>
									</li>
								<?php } ?>
							</ul>
						<?php } ?>
					</div><!-- /dl-menuwrapper -->
				</div>
            </div>
            <div class="col-md-9 myfit2 ">
            	
            </div>
		</div>
	</div>
</div>

<div class="clearfix"></div>
<?php $this->load->view('common/footer');?>