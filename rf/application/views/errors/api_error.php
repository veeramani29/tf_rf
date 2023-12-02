<?php $this->load->view('common/header');?>
<div id="fuornotfour" class="apierror_container">
    <div class="container">       
        <div class="rfboxed-background">
            <div class="col-xs-12 rfboxed_img ercolumn_center">
                <img src="<?php echo ASSETS; ?>images/icons/api_error.svg" alt="" />
            </div>
            <div class="col-xs-12">
                <h2 class="ooops"><?php echo lang_line('API_Error');?></h2>              
                <div class="ercod"><?php echo $xml_error;?></div>             
                 <div class="erorredrctwrp"> <a href="<?php echo WEB_URL; ?>" class="erorredrct"><?php echo lang_line('HOME');?></a></div>              
                   <div class="erorredrctwrp"><a href="<?php echo WEB_URL; ?>/help" class="erorredrct"><?php echo lang_line('HELP');?></div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('common/footer');?>
</body>
</html>