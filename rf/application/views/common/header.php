<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>...::<?=lang_line('SITE_NAME')?></title>
  <!-- Bootstrap -->
  <link href="<?php echo ASSETS;?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- fontawesome css -->
  <link rel="stylesheet" href="<?php echo ASSETS;?>font-awesome/css/font-awesome.min.css">
  <!-- ui css -->
  <link rel="stylesheet" href="<?php echo ASSETS;?>css/jquery-ui.css">
  <!-- common css files-->
  <link href="<?php echo ASSETS;?>css/star-rating.css" rel="stylesheet">  
  <link rel="stylesheet" href="<?php echo ASSETS;?>css/bootstrapformhelpers.min.css" media="screen">  
  <!-- lightbox hotel css start -->
  <link rel="stylesheet" type="text/css" href="<?php echo ASSETS."css/lightbox/lightgallery.css";?>">
  <link rel="stylesheet" type="text/css" href="<?php echo ASSETS."css/lightbox/justifiedGallery.min.css";?>" >
  <!-- custom css files -->
  <link rel="stylesheet" href="<?php echo ASSETS;?>css/developer.css" media="screen">
  <link href="<?php echo ASSETS;?>css/custom-styles.css" rel="stylesheet">
  <link href="<?php echo ASSETS;?>css/media.css" rel="stylesheet">
  
  <script src="<?php echo ASSETS;?>js/jquery.v2.0.3.js"></script>
  <script type='text/javascript' src="<?php echo ASSETS;?>js/jquery.lazyload.js"></script>
 
  <!-- Jquiry ui js-->  
  <script src="<?php echo ASSETS;?>js/jquery-ui.js"></script>
  <script src="<?php echo ASSETS;?>js/jquery.ui.touch-punch.min.js"></script>
 <script src="<?php echo ASSETS;?>bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript">

  WEB_URL = "<?php echo WEB_URL; ?>";
  ASSETS = "<?php echo ASSETS; ?>";
  CURR = "<?php echo CURR; ?>";
  CURR_ICON = "<?php echo CURR_ICON; ?>";

  <?php
 $controller = $this->router->fetch_class();
    $method = $this->router->fetch_method();
   
  $current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
  $current_url = $this->config->site_url().$this->uri->uri_string(). $current_url;
  $current_url = base64_encode($current_url);
  $language = $this->session->userdata('language');
  $currency_info =   $this->cart_model->get_currency_info();
  if($controller=='booking'){$login_url=$this->config->site_url().$this->uri->uri_string();}else{ $login_url='';}
	?>
  var current_url = '<?php echo $current_url;?>'; 
  var login_url = '<?php echo $login_url;?>';
  window.help_upload_dir = '<?php echo help_upload_dir; ?>';
  
  </script>

 <style type="text/css">
.site_txt{
	color: #337ab7;
}

div, a, ul, li, nav, input, select, button {
    outline-color: -moz-use-text-color !important;
    outline-style: none !important;
    outline-width: medium !important;
}
ul,li{
   list-style-image: none;
    list-style-position: outside;
    list-style-type: none;
    margin-bottom: 0;
    margin-left: 0;
    margin-right: 0;
    margin-top: 0;
    padding-bottom: 0;
    padding-left: 0;
    padding-right: 0;
    padding-top: 0;
}
 </style>

</head>
<body>
  <div class="lodrefrentrev imgLoader" style="display:none;">
    <div class="centerload">
    </div>
  </div>
  <img src="<?php echo ($controller=='hotel')?ASSETS."images/hotel_pg.jpg":ASSETS."images/bg_main.jpg";?>" class="bg">
  <nav class="navbar navbar-default">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand logo" href="<?php echo WEB_URL;?>">
          <img src="<?php echo ASSETS;?>images/LOGO_RF.svg">
        </a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="<?php echo WEB_URL.'/Hotel';?>" class="hotel_menuitem <?php echo ($controller=='hotel')?"active":"";?>"><?=lang_line('HOTELS')?></a>
          </li>
          <li>
            <a href="<?php echo WEB_URL.'/Car';?>" class="car_menuitem <?php echo ($controller=='car')?"active":"";?>"><?=lang_line('CARS')?></a>
          </li>
          <li>
            <a href="<?php echo WEB_URL;?>" class="<?php echo ($controller!='hotel' && $controller!='car' && $controller!='cms')?"active":"";?> flight_menuitem"><?=lang_line('FLIGHTS')?></a>
          </li>
          <li>
            <a href="<?php echo WEB_URL."/about-us";?>" class="<?php echo ($method='pageById' && $this->uri->segment(1)=='about-us')?"active":"";?> about_navigation"><?=lang_line('ABOUT')?></a>
          </li>
          <?php if($this->session->userdata("user_type")=='') { ?>
          <li class="login">
            <a href="Javascript:;" class="login_navigation fadeandscale_close fadeandscalereg_open"><?=lang_line('LOGIN_REG')?></a>
          </li>
          <?php }  ?>
          <li class="dropdown en_navigation">
            <?php 
            $disp_lang=($this->session->userdata("language")=='english')?'EN':'NL';
            $disp_option_lang=($this->session->userdata("language")!='english')?'EN':'NL';
            $disp_option_lang_full=($this->session->userdata("language")!='english')?'english':'dutch';
            ?>
            <a href="<?php echo WEB_URL."/home/language/".$this->session->userdata("language")."/".$current_url; ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$disp_lang?></a>
            <ul class="dropdown-menu">
              <li><div class="arrow-up"></div></li>
              <li>
                <a href="<?php echo WEB_URL."/home/language/".$disp_option_lang_full."/".$current_url; ?>"><?=$disp_option_lang?></a>
              </li>
            </ul>
          </li>
          <?php
          if ($this->session->userdata('b2c_id')) {
            $b2c_id = $this->session->userdata('b2c_id');
            $b2c_data = $this->Auth_Model->getUserData($b2c_id);
            if($b2c_data->profile_photo == ''){
              $profile_photo = ASSETS.'images/user-avatar.jpg';
            }else{
             $profile_photo = $b2c_data->profile_photo;
           }
           $provider = $b2c_data->loggedin_with;
           $current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
           $current_url = $this->config->site_url().$this->uri->uri_string(). $current_url;
           $current_url = base64_encode($current_url);
           ?>
           <li class="dropdown navbar-right splli"> 
            <a data-toggle="dropdown" class="dropdown-toggle ritspl" href="#">
              <div class="usrwel"><img src="<?php echo $profile_photo;?>" alt="" class="profile_photo"/></div>
              <?php echo $b2c_data->firstname;?><b class="lightcaret mt-2"></b> </a>
              <ul class="dropdown-menu">
                <li><div class="arrow-up"></div></li>
                <li><a href="<?php echo WEB_URL;?>/dashboard"><?=lang_line('DASHBOARD')?></a></li>
                <li><a href="<?php echo WEB_URL;?>/dashboard/bookings"><?=lang_line('BOOKINGS')?></a></li>
                <li><a href="<?php echo WEB_URL;?>/dashboard/settings"><?=lang_line('SETTINGS')?></a></li>
                <li>
                  <a href="<?php echo WEB_URL;?>/dashboard/support_conversation"><?=lang_line('SUPPORT_TICK')?></a>
                </li>
                <li>
                  <?php echo anchor('auth/logout/'.$provider.'/'.$b2c_data->user_id.'/'.$current_url,lang_line('LOGOUT'));?>
                </li>
              </ul>
            </li>
            <?php }?>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>