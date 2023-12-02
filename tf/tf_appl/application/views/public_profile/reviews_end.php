<?php $this->load->view('common/header');?>
 <link rel="stylesheet" href="<?php echo ASSETS;?>css/uploadfile.min.css" type="text/css" media="screen" />
 <link type="text/css" media="all" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" />
 <link rel="stylesheet" href="<?php echo ASSETS;?>css/bootstrap-multiselect.css" type="text/css"/>
 <link rel="stylesheet" href="<?php echo ASSETS;?>css/_all.css" type="text/css"/>
  <link rel="stylesheet" href="<?php echo ASSETS;?>css/blue.css" type="text/css"/>
 <style type="text/css">.pac-container:after{content: initial !important;}</style>



<div class="clear"></div>

<!-- CONTENT -->
<div class="full marintopcnt onlycontent">
<div class="full" style="padding-top: 50px;">
    <div class="container">
        <div class="container offset-0">
        	<div class="tickapt">
            	<span class="iconaptcheck"><img src="<?php echo ASSETS;?>images/aptcheck.png" alt="" /></span>
                <span class="msgofapt">Thank you for your review.</span>
            </div>
            
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

<script src="<?php echo ASSETS;?>js/icheck.js?v=1.0.2"></script>
<script src="<?php echo ASSETS;?>js/star-rating.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
  $('input').iCheck({
    checkboxClass: 'icheckbox_flat-blue',
    radioClass: 'iradio_flat'
  });
});
</script>
<?php $this->load->view('common/footer');?>






