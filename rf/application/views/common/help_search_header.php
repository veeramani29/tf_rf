<div class="full marintop toplitileimg">
<div class="shadeback"></div>
    <div class="container">
        <div class="helpsearch">
            <form id="helpCenterSearchForm" action="<?php echo WEB_URL.'/help/search' ?>" method="GET"> 
            	<input type="text" class="form-control serchhlp" id="helpSearchInput" name="q" placeholder="Serch the help center" autocomplete="off"/>
                <input type="submit" class="helpgo" value="" />
            </form>
            <div class="suggestion_box">
                <ul> </ul>
            </div>
        </div>
        <div class="popsrch">
        	<ul class="list-inline">
                <li class="poli"><strong><?php echo lang_line('Popular_Searches');?></strong></li>
                <?php foreach($this->popularKeyword as $keyword) { ?>
                    <li class="poli">
                        <a class="get_popular_article" href="<?php echo WEB_URL.'/help/article/'.$keyword->menu_id.'/'.$keyword->sub_menu_id; ?>" >
                            <?php echo $keyword->sub_menu_title; ?>
                        </a>
                        
                    </li>    
                <?php } ?>
            </ul>
        </div>
    </div>
</div>   

<div class="clear"></div>	