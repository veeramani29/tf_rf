<!DOCTYPE html>
<html>
<head>
    <title>Manage Newsletter | <?php echo PROJECT_NAME;?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta content='text/html;charset=utf-8' http-equiv='content-type'>
    
    <link href='<?=base_url();?><?=base_url();?>assets/images/meta_icons/favicon.ico' rel='shortcut icon' type='image/x-icon'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon.png' rel='apple-touch-icon-precomposed'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-57x57.png' rel='apple-touch-icon-precomposed' sizes='57x57'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-72x72.png' rel='apple-touch-icon-precomposed' sizes='72x72'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-114x114.png' rel='apple-touch-icon-precomposed' sizes='114x114'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-144x144.png' rel='apple-touch-icon-precomposed' sizes='144x144'>
    <!-- / START - page related stylesheets [optional] -->
    <link href="<?=base_url();?>assets/stylesheets/plugins/lightbox/lightbox.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/stylesheets/plugins/datatables/bootstrap-datatable.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / END - page related stylesheets [optional] -->
    <!-- / bootstrap [required] -->
    <link href="<?=base_url();?>assets/stylesheets/bootstrap/bootstrap.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / theme file [required] -->
    <link href="<?=base_url();?>assets/stylesheets/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
    <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
    <link href="<?=base_url();?>assets/stylesheets/theme-colors.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / demo file [not required!] -->
    <link href="<?=base_url();?>assets/stylesheets/demo.css" media="all" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
      <script src="<?=base_url();?>assets/javascripts/ie/html5shiv.js" type="text/javascript"></script>
      <script src="<?=base_url();?>assets/javascripts/ie/respond.min.js" type="text/javascript"></script>
    <![endif]-->
    
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
   <script src="<?=base_url();?>assets/javascripts/jquery/jquery-1.10.2.js" type="text/javascript"></script>
    
<style type="text/css">

.image-grid-container {
    /*border: 1px solid black;*/
    width: 1000px; 
    overflow: hidden;
    margin-left: 50px;
    margin-top: 20px;

}

.image-container {
    border: 1px solid #dedede;
    width: 210px;
    overflow: hidden;
    float: left;
    margin-right: 60px;
    margin-bottom: 30px;
    margin-left: 10px;
    margin-top: 10px;
    padding: 5px;
    box-shadow: 0px 0px 10px #333;
    cursor: pointer;
}
.image-container:hover {
    box-shadow: 0px 0px 15px #333;
}

.empty_div {
   width: 210px;
   height: 260px;
   border: 1px solid #dedede;
   background-color: #555;
   float: left;
   margin-top: 10px;
   margin-left: 10px;
   cursor: pointer;
   box-shadow: 0px 0px 10px #333;

}

.create_new_template {
    margin: 0 auto;
    text-align: center;
    margin-top: 100px;
    color:#fff;
}
.empty_div:hover{
    background-color: #666;
}

.templateName {
    text-align: center;
    background-color: rgba(51, 51, 51, 0.83);
    height: 90px;
    position: relative;
    z-index: 9999;
    margin-top: -90px;
    color: #fff;
    font-weight: bold;
    display: none;
    width: 100%;
}   

</style>
</head>


  <body class='contrast-dark fixed-header'>
    <?php $this->load->view('header');?>
    
    <div id='wrapper'>
      <div id='main-nav-bg'></div>
      <?php $this->load->view('side-menu');?>
      <section id='content'>
        <div class='container'>
          <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left'>
                      <i class='icon-envelope'></i>
                      <span>Select Campaign</span>
                    </h1>
                    <div class='pull-right'>
                        
                      <ul class='breadcrumb'>
                        <li>
                          <a href='<?=base_url();?>'>
                            <i class='icon-bar-chart'></i>
                          </a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Select Campaign</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <div class="portlet-body">
                <div class="image-grid-container">
                    <?php foreach($campaign_data as $value): ?>
                    <div class="image-container">
                        <a href="<?php echo WEB_URL; ?>newsletter/create_campaign/<?php echo $value->id; ?>">
                            <img style="max-width: 100%; max-height: 100%;" src="<?php echo $value->template_images; ?>">
                            <div class="templateName"><?php echo $value->template_name; ?></div>
                        </a>
                    </div>
                    <?php endforeach; ?>

                    <a href="<?php echo WEB_URL; ?>newsletter/create_campaign/0">
                        <div class="empty_div">
                            <div class="create_new_template">
                                <h5>Create New Campaign</h5>
                            </div>
                        </div>
                    </a>

                </div>
        
            </div>
              
              

            </div>
          </div>
         <?php $this->load->view('footer');?>
        </div>
      </section>
    </div>
    
    <!-- / jquery [required] -->
     
    <!-- / jquery mobile (for touch events) -->
    
    
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery.mobile.custom.min.js" type="text/javascript"></script>
    <!-- / jquery migrate (for compatibility with new jquery) [required] -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery-migrate.min.js" type="text/javascript"></script>
    <!-- / jquery ui -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery-ui.min.js" type="text/javascript"></script>
    <!-- / jQuery UI Touch Punch -->
    <script src="<?=base_url();?>assets/javascripts/plugins/jquery_ui_touch_punch/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
    <!-- / bootstrap [required] -->
    <script src="<?=base_url();?>assets/javascripts/bootstrap/bootstrap.js" type="text/javascript"></script>
    <!-- / modernizr -->
    <script src="<?=base_url();?>assets/javascripts/plugins/modernizr/modernizr.min.js" type="text/javascript"></script>
    <!-- / retina -->
    <script src="<?=base_url();?>assets/javascripts/plugins/retina/retina.js" type="text/javascript"></script>
    <!-- / theme file [required] -->
    <script src="<?=base_url();?>assets/javascripts/theme.js" type="text/javascript"></script>
    <!-- / demo file [not required!] -->
    <script src="<?=base_url();?>assets/javascripts/demo.js" type="text/javascript"></script>
    <!-- / START - page related files and scripts [optional] -->
    <script src="<?=base_url();?>assets/javascripts/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/datatables/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/datatables/dataTables.overrides.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/lightbox/lightbox.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/validate/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/validate/additional-methods.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/jquery.popupoverlay.js" type="text/javascript"></script>
    <!-- / END - page related files and scripts [optional] -->
  </body>

<script type="text/javascript">
function activate(that){
  window.location.href=that;
}
</script>

<script>

/*jQuery hover-name show
***@author: Vikas Arora
 */
    /*The script is responsible for the hover events on the image tabs*/
    $('.image-container').on({
        'mouseover':function(){$(this).find('.templateName').fadeIn(500);},
        'mouseleave': function(){$(this).find('.templateName').slideUp('fast');}
    });

</script>
 

</html>
