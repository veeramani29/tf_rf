<?php $this->load->view('common/header');?>

<div id="fuornotfour" class="container_404">
    <div class="container">       	
        <div class="rfboxed-background">
            <div class="col-xs-12 rfboxed_img ercolumn_center">
                <img src="<?php echo ASSETS; ?>images/icons/error_404.svg" alt="" />
            </div>
            <div class="col-xs-12">
                <h2 class="ooops"><?php echo lang_line('OOPs');?></h2>
                <span class="erordes"><?php echo lang_line('ERROR_PG_MSG');?></span>
                <div class="rellinks"><?php echo lang_line('HELPFUL_LINKS');?></div>
                <div class="erorredrctwrp">
                    <a href="<?php echo WEB_URL; ?>" class="erorredrct"><?php echo lang_line('HOME');?></a>
                </div>
                <div class="erorredrctwrp">
                    <a href="<?php echo WEB_URL; ?>/help" class="erorredrct"><?php echo lang_line('HELP');?></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('common/footer');?>
</body>
</html>