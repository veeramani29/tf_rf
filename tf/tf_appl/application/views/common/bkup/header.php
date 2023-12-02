<?php
$language = $this->session->userdata('language');
  //echo "<pre>";print_r($this->session->all_userdata());
if($language){ $this->lang->load('Header_H', $language); }else{ $this->lang->load('Header_H', 'english');  }
$banners = $this->Help_Model->getHomeSettings();
$header_menu = $this->Help_Model->getHeaderMenu();
$check_in_details = $this->Help_Model->getAllcheck_In();
$header_menu = $header_menu[0];
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0' >
  <title>  <?php echo lang('SITE_NAME'); ?></title>
  <link href="<?php echo ASSETS;?>css/style-my-tooltips.css" rel="stylesheet" media="screen">
  <!-- Bootstrap -->
  <link href="<?php echo ASSETS;?>css/bootstrap.css" rel="stylesheet" media="screen">
  <link href="<?php echo ASSETS;?>css/main.css" rel="stylesheet" media="screen">
  <link href="<?php echo ASSETS;?>css/colorbox.css" rel="stylesheet" media="screen">
  <link href="<?php echo ASSETS;?>css/popup_style.css" rel="stylesheet" media="screen">
  <link href="<?php echo ASSETS;?>css/custom.css" rel="stylesheet" media="screen">
  <link href="<?php echo ASSETS;?>css/cart.css" rel="stylesheet" type="text/css"/>
  <link href="<?php echo ASSETS;?>css/font-awesome.css" rel="stylesheet" media="screen">
  <link href="<?php echo ASSETS;?>css/font.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" href="<?php echo ASSETS;?>css/backslider.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="<?php echo ASSETS;?>css/backslider2.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="<?php echo ASSETS;?>css/simplePagination.css" type="text/css" media="screen" />
  <link href="<?php echo ASSETS;?>css/carousel.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo ASSETS;?>css/bootstrapformhelpers.min.css" media="screen">
  <!-- Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:700,400,300,300italic' rel='stylesheet' type='text/css'>
  <!-- Font-Awesome -->
  <!--[if lt IE 7]><link rel="stylesheet" type="text/css" href="<?php echo ASSETS;?>css/font-awesome-ie7.css" media="screen" /><![endif]-->
  <!-- REVOLUTION BANNER CSS SETTINGS -->
  <link rel="stylesheet" type="text/css" href="<?php echo ASSETS;?>css/fullscreen.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?php echo ASSETS;?>css/settings.css" media="screen" />
  <!-- Picker UI-->
  <link rel="stylesheet" href="<?php echo ASSETS;?>css/jquery-ui.css" />
  <!-- <link rel="stylesheet" href="<?php echo ASSETS;?>css/jquery_ui.css" />-->
  <link rel="stylesheet" href="<?php echo ASSETS;?>css/jquery.datetimepicker.css" />
  <!-- bin/jquery.slider.min.css -->
  <link rel="stylesheet" href="<?php echo ASSETS;?>css/jslider.css" type="text/css">
  <link rel="stylesheet" href="<?php echo ASSETS;?>css/jslider.round.css" type="text/css">
  <link rel="stylesheet" href="<?php echo ASSETS;?>css/mycarosl.css" />
  <link rel="stylesheet" href="<?php echo ASSETS;?>css/flexslider.css" type="text/css" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?php echo ASSETS;?>css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="<?php echo ASSETS;?>css/dataTables.tableTools.css">
  <!-- jQuery-->
  <script src="<?php echo ASSETS;?>js/modernizr.custom.js"></script>
  <script src="<?php echo ASSETS;?>js/jquery.v2.0.3.js"></script>
  <!--<script src="<?php echo ASSETS;?>js/jquery-1.11.2.min.js"></script>-->
  <!--<script src="<?php echo ASSETS;?>js/jquery-ui-1.10.4.min.js"></script>-->
  <script src="<?php echo ASSETS;?>js/jquery.datetimepicker.js"></script>
  <script src="<?php echo ASSETS;?>js/jquery.colorbox.js"></script>
  <script type="text/javascript" src="<?php echo ASSETS;?>js/jshashtable-2.1_src.js"></script>
  <script type="text/javascript" src="<?php echo ASSETS;?>js/jquery.numberformatter-1.2.3.js"></script>
  <script type="text/javascript" src="<?php echo ASSETS;?>js/tmpl.js"></script>
  <script type="text/javascript" src="<?php echo ASSETS;?>js/jquery.dependClass-0.1.js"></script>
  <script type="text/javascript" src="<?php echo ASSETS;?>js/draggable-0.1.js"></script>
  <script type="text/javascript" src="<?php echo ASSETS;?>js/jquery.slider.js"></script>
  <script type='text/javascript' src="<?php echo ASSETS;?>js/jquery.customSelect.js"></script>
  <!-- Begin Cookie Consent plugin by Silktide - http://silktide.com/cookieconsent -->
  <script type="text/javascript">
  window.cookieconsent_options = {"message":"This website uses cookies to ensure you get the best experience on our website","dismiss":"Got it!","learnMore":"More info","link":"<?php echo WEB_URL; ?>","theme":"dark-floating"};
  </script>
  <script type="text/javascript" src="<?php echo ASSETS;?>js/cookieconsent.min.js"></script>
  <!-- End Cookie Consent plugin -->
  <script type="text/javascript">
  WEB_URL = "<?php echo WEB_URL; ?>";
  ASSETS = "<?php echo ASSETS; ?>";
  CURR = "<?php echo CURR; ?>";
  CURR_ICON = "<?php echo CURR_ICON; ?>";
  </script>
  <?php
  $controller = $this->router->fetch_class();
  $method = $this->router->fetch_method();
  $current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
  $current_url = $this->config->site_url().$this->uri->uri_string(). $current_url;
  $current_url = base64_encode($current_url);
  $language = $this->session->userdata('language');
  $currency_info =   $this->cart_model->get_currency_info();
  ?>
  <script type="text/javascript">var current_url = '<?php echo $current_url;?>';</script>
  <script type="text/javascript">
  //used in help_center.js file for extracting the images from admin panel upload directory.
  window.help_upload_dir = '<?php echo help_upload_dir; ?>';
  </script>
  <link href="<?php echo ASSETS;?>css/media.css" rel="stylesheet">
  <link  href="<?php echo ASSETS;?>css/validation.css" rel="stylesheet" />
  <style type="text/css">
  .htlmod .multicity input.fromflight , .htlmod .multicity input.departflight{
    font-size: 12px;
  }
  #whyweModal a{
    display: none;
  }
  </style>
</head>
<body id="top" class="thebg">
  <!-- Popup_signin_start -->
  <script>
  $(document).ready(function(){
    $(".cboxClose1").click(function(){
      $("#cboxOverlay,#colorbox").hide();
    });
    $(".example9").colorbox({width:"375px", height:"auto", inline:true, href:"#inline_example4"});
    $(".example10").colorbox({width:"375px", height:"640px", inline:true, href:"#inline_example14"});
    $(".example11").colorbox({width:"500px", height:"auto", inline:true, href:"#inline_example24"});
    $("#onLoad").click(function(){
      $('#onLoad').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
      return false;
    });
  });
  </script>
  <div style='display:none'>
    <div id='inline_example4' style='background:#fff;'>
      <div class="popup_page">
        <div class="popup_header"><?echo lang('SIGNIN');?>. </div>
        <div id="logerrmsg"  style="display:none;color:red;font-size:11px;text-align:center;" ></div>
        <div class="popup_detail form">
          <div class="banner_signup ">
           <div class="leftpul">
            <?php
            $atts = array(
              'width'      => '600',
              'height'     => '600',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'   =>  '\'+((parseInt(screen.width) - 600)/2)+\'',
              'screeny'   =>  '\'+((parseInt(screen.height) - 600)/2)+\'',
              );
            $atts['class'] = 'logspecify facecolor';
            echo anchor_popup('auth/login/Facebook/login','
              <div class="mensionsoc"><span class="fa fa-facebook fa-lg fa-fw color-white"></span> '.lang('LOG_W_FB').'</div>', $atts);
            $atts['class'] = 'logspecify tweetcolor';
            echo anchor_popup('auth/login/Twitter/login','
              <div class="mensionsoc"><span class="fa fa-twitter fa-lg fa-fw color-white"></span> '.lang('LOG_W_TW').'</div>', $atts);
            $atts['class'] = 'logspecify gpluses';
            echo anchor_popup('auth/login/Google/login','
              <div class="mensionsoc"><span class="fa fa-google-plus fa-lg fa-fw color-white"></span> '.lang('LOG_W_GP').'</div>', $atts);
              ?>
            </div>
            <div class="centerpul"><div class="orbar"><strong><?=lang('OR');?></strong></div></div>
            <form id="userlogin" name="userlogin" action="<?php echo WEB_URL;?>/account/login" method="post">
              <div>
                <input type="text" id="lemail" name="email"  placeholder="<?=lang('LOGIN_EMAIL');?>" class="book_txt  " style="padding:8px 0px 8px 10px; font-size:13px; margin-bottom: 15px;"  />
              </div>
              <div>
                <input type="password" id="lpass" name="password"  placeholder="<?=lang('PSWD');?>" class="book_txt " style="padding:8px 0px 8px 10px; font-size:13px; margin-bottom: 15px;" />
              </div>
              <input type="submit" value="<?=lang('LOGIN');?>" class="flight_btn" style="width:230px" />
              <span class="popup_forgot example11"><a href="#"><?=lang('FORGT_PASS');?></a></span>
              <span class="popup_forgot"><a class="example10" href="#"><?=lang('DONT_HAV_ACC')?></a></span>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div style='display:none'>
    <div id='inline_example14' style='background:#fff;'>
      <div class="popup_page">
        <div class="popup_header"><?=lang('SIGNUP_HEADING')?>. </div>
        <div id="regerrmsg"  style="display:none;color:red;font-size:11px;text-align:center;" ></div>
        <div class="popup_detail form">
          <div class="banner_signup">
           <div class="leftpul">
            <?php
            $atts = array(
              'width'      => '600',
              'height'     => '600',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'   =>  '\'+((parseInt(screen.width) - 600)/2)+\'',
              'screeny'   =>  '\'+((parseInt(screen.height) - 600)/2)+\'',
              );
            $atts['class'] = 'logspecify facecolor';
            echo anchor_popup('auth/login/Facebook/up','
              <div class="mensionsoc"><span class="fa fa-facebook fa-lg fa-fw color-white"></span> Sign up with Facebook</div>', $atts);
            $atts['class'] = 'logspecify tweetcolor';
            echo anchor_popup('auth/login/Twitter/up','
              <div class="mensionsoc"><span class="fa fa-twitter fa-lg fa-fw color-white"></span> Sign up with Twitter</div>', $atts);
            $atts['class'] = 'logspecify gpluses';
            echo anchor_popup('auth/login/Google/up','
              <div class="mensionsoc"><span class="fa fa-google-plus fa-lg fa-fw color-white"></span> Sign up with Google Plus</div>', $atts);
              ?>
            </div>
            <div class="centerpul"><div class="orbar"><strong><?=lang('OR');?></strong></div></div>
            <form name="usermyaccount" id="usermyaccount" action="<?php echo WEB_URL;?>/account/create" method="post">
              <input type="hidden" id="hdnolduser" name="hdnolduser" value="0" />
              <div>
                <input type="text" id="fname" name="fname"  placeholder="<?=lang('F_NAME');?>"  class="book_txt " style="padding:8px 0px 8px 10px; font-size:13px; margin-bottom: 15px;"  />
              </div>
              <div>
                <input type="text" id="mname" name="mname"  placeholder="<?=lang('M_NAME');?>"   class="book_txt " style="padding:8px 0px 8px 10px; font-size:13px; margin-bottom: 15px;"  />
              </div>
              <div>
                <input type="text" id="lname" name="lname"  placeholder="<?=lang('L_NAME');?>"   class="book_txt " style="padding:8px 0px 8px 10px; font-size:13px; margin-bottom: 15px;"  />
              </div>
              <div>
                <input type="text" id="email" name="email"   placeholder="<?=lang('UR_EMAIL');?>"  class="book_txt " style="padding:8px 0px 8px 10px; font-size:13px; margin-bottom: 15px;"  />
              </div>
              <div>
                <input type="password" id="password" name="password"   placeholder="<?=lang('PSWD');?>" class="book_txt " style="padding:8px 0px 8px 10px; font-size:13px; margin-bottom: 15px;" />
              </div>
              <div>
                <input type="password" id="cpassword" name="cpassword"  placeholder="<?=lang('CONFIRM');?>" class="book_txt " style="padding:8px 0px 8px 10px; font-size:13px; margin-bottom: 15px;" />
              </div>
              <div>
               <input type="submit" value="<?=lang('REGISTER');?>" class="flight_btn" style="width:230px" />
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>
 </div>
 <div style='display:none'>
  <div id='inline_example24' style='background:#fff;'>
    <div class="popup_page">
      <div class="popup_header"><?=lang('FORGT_PASS');?></div>
      <div class="popup_detail form ">
        <div class="banner_signup">
          <form name="signupForgot" id="signupForgot" action="<?php echo WEB_URL;?>/account/forgetpwd" method="post">
            <p><?=lang('FORGOT_STR');?></p>
            <p id="forgot_email_msg" style="display:none;text-align:center;"></p>
            <div>
              <input type="text" id="femail" name="email" placeholder="<?=lang('FP_EMAIL')?>" class="book_txt" style="padding:8px 0px 8px 10px; font-size:13px; margin-bottom: 15px;"  />
            </div>
            <input type="submit" value="<?=lang('FP_SUBMIT');?>" class="flight_btn" style="margin-left: 10px; margin-top: 2px; font-size:15px;  width: 100px;" />
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Popup_signin_end -->
<!-- About check in Modal -->
<div id="abtcheckinModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-success">Online Inchecken</h4>
      </div>
      <div class="modal-body">
        <p>Heeft u een vliegticket geboekt? Dan kunt u In de meeste gevallen op de sites van de luchtvaartmaatschappijen online inchecken en uw eigen stoel reserveren, online inchecken is helaas niet op alle luchtvaartmaatschappijen van toepassing.</p>
        <p>U bespaart tijd bij het inchecken op de luchthaven en u kunt op voorhand uw favoriete stoel reserveren. In de meeste gevallen kunt u vanaf 30- of 24 uur voor vertrek bij de desbetreffende luchtvaartmaatschappij online inchecken (dit is afhankelijk van de luchtvaartmaatschappij waarmee u vliegt).</p>
        <p>Voor uw gemak hebben wij onderstaand een lijst opgesteld van de meest voorkomende luchtvaartmaatschappijen. Zodra u klikt op de betreffende maatschappij verlaat u onze website en opent u automatisch de check-in pagina van de luchtvaartmaatschappij.</p>
        <p>U dient wel de bij de vraag om uw boekingsnummer (PNR) wel dia van de betreffende luchtvaartmaatschappij (VL) invoeren.</p>
        <?php $tot_check_in=count($check_in_details); if($tot_check_in>0){ ?>
        <ul class="list-inline list_flights">
          <?php foreach($check_in_details as $global_check_in){ ?>
          <li><a style="width: 250px;" target="_blank" href="<?php echo $global_check_in['url'];?>"><img class="lang" src="https://www.amadeus.net/static/img/static/airlines/small/<?php echo $global_check_in['icon'];?>"> <?php echo $this->flight_model->get_airline_name($global_check_in['airline_code']);?> (<?php echo $global_check_in['airline_code'];?>)</a></li>
          <?php } ?>
        </ul>
        <?php } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- About check in Modal -->
<!-- About check in Modal -->
<div id="whyweModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-success">Why We</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- About check in Modal -->
<div id="perspective" class="perspective effect-moveleft">
 <div class="container_cart"><div class="wrapper_cart"><div class="navbar-wrappermy"><div class="container"><div class="navbar">
   <div class="onlyapart offset-0">
    <!-- Navigation-->
    <div class="navbar-header col-xs-12 col-sm-3 nopad">
      <a href="<?php echo WEB_URL;?>" class="navbar-brand myband clearfix">
        <img src="<?php echo ASSETS;?>images/logo.png" alt="<?php echo $this->lang->line('H_logo_title'); ?>" class="img-responsive" />
      </a>
    </div>
    <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
    <div class="col-xs-12 col-sm-9 col-lg-5 nopad mobheder">
      <ul class="simnavritrit">
        <?php if($controller != 'booking'){  $session_id = $this->session->userdata('session_id');  $cart_data = $this->cart_model->getCart($session_id);  ?>
        <li class="dropdown navbar-right splli nomarlii">
          <!--<button id="showMenu">Show Menu</button>-->
          <div class="cartico shopingcart" id="showMenu"> <span class="cartcnt"><?php echo $cart_data['count'];?></span><!-- <span class="cartimer">19:00</span> --></div>
        </li>
        <?php }?>
      </ul>
      <div class="mobilemore navbar-toggle" data-target="#mobilemore" data-toggle="collapse"><!--<span class="icon icon-plus"></span>--></div>
      <ul class="nav navbar-nav simnavrit  collapse" id="mobilemore">
        <li class="dropdown navbar-right splli">
          <a data-toggle="dropdown" class="dropdown-toggle litblu ritspl" href="#">
            <img class="lang" src="<?php echo base_url()?>assets/images/flags/<?php echo ($language)?$language:'english'?>.png" />
            <b class="lightcaret mt-2"></b>
          </a>
          <ul class="dropdown-menu langugmob">
            <li>
              <a  href="<?php echo WEB_URL."/home/language/english/".$current_url; ?>">
                <img class="lang" src="<?php echo base_url()?>assets/images/flags/english.png" /><?php echo $this->lang->line('H_English'); ?>
              </a>
            </li>
            <li>
              <a  href="<?php echo WEB_URL."/home/language/dutch/".$current_url; ?>">
                <img class="lang" src="<?php echo base_url()?>assets/images/flags/dutch.png" />Dutch
              </a>
            </li>
          </ul>
        </li>
        <?php  if($header_menu->check_in=='1') { ?>
        <li class="margtop10">
          <a href="#" class="login" data-toggle="modal" data-target="#abtcheckinModal"><?=lang('CHECK_IN');?></a>
        </li>
        <?php  } ?>
        <?php  if($this->router->fetch_method()!="set_password" && $this->session->userdata("user_type")=='' && $this->router->fetch_class()!="booking"){
          if($this->session->userdata("user_type")=='') { ?>
          <li class="splli margtop10">
            <a href="#" class="login example10"><?=lang('SIGNUP');?></a>
          </li>
          <li class="splli margtop10">
            <a href="#" class="login example9"><?=lang('LOGIN');?></a>
          </li>
          <?php } 
        } ?>
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
              <div class="usrwel">
                <img src="<?php echo $profile_photo;?>" alt="" class="profile_photo"/>
              </div>
              <?php echo $b2c_data->firstname;?>
              <b class="lightcaret mt-2"></b>
            </a>
            <ul class="dropdown-menu dpm_usdash">
              <li>
                <a target="_blank" href="<?php echo WEB_URL;?>/dashboard"><?php echo lang('LOGIN_ACTION_DASHBOARD'); ?></a>
              </li>
              <li>
                <a target="_blank" href="<?php echo WEB_URL;?>/dashboard/bookings"><?php echo lang('LOGIN_ACTION_BOOKINGS'); ?></a>
              </li>
              <li>
                <a target="_blank" href="<?php echo WEB_URL;?>/dashboard/settings"><?php echo lang('LOGIN_ACTION_SETTINGS'); ?></a>
              </li>
              <li>
                <a target="_blank" href="<?php echo WEB_URL;?>/dashboard/support_conversation"><?php echo lang('LOGIN_ACTION_SUPPORT_CONVERSATION'); ?></a>
              </li>
              <li>
                <?php echo anchor('auth/logout/'.$provider.'/'.$b2c_data->user_id.'/'.$current_url,lang('LOGOUT'));?>
              </li>
            </ul>
          </li>
          <?php 
        } ?>
      </ul>
    </div>
    <div class="navbar-collapse collapse col-xs-12 col-lg-offset-3 col-lg-4 filcols nopad margtop5">
      <ul class="nav navbar-nav navbar-left text-uppercase ma0">
        <?php if($header_menu->apartment=='1'){ ?>
        <li title="<?=lang('APARTMENTS');?>"><a class="mnuic flit" href="<?php echo WEB_URL;?>/Apartment"><strong><?=lang('APARTMENTS');?></strong></a></li>
        <?php } if($header_menu->flight=='1'){?>
        <li title="<?=lang('FLIGHTS');?>"><span class="flitimg"></span><a class="mnuic flit" href="<?php echo WEB_URL;?>"><strong><?=lang('FLIGHTS');?></strong></a></li>
        <?php } if($header_menu->hotel=='1'){?>
        <li title="<?=lang('HOTELS');?>"><span class="htlimg"></span><a class="mnuic htl" href="<?php echo WEB_URL;?>/Hotel"><strong><?=lang('HOTELS');?></strong> </a></li>
        <?php } if($header_menu->car=='1'){?>
        <li title="<?=lang('CARS');?>"><span class="carimg"></span><a class="mnuic car" href="<?php echo WEB_URL;?>/Car"><strong><?=lang('CARS');?></strong></a></li>
        <?php } if($header_menu->vacation=='1'){?>
        <li title="<?=lang('VACATION');?>"><a class="mnuic vcatn" href="<?php echo WEB_URL;?>/Vacation"><strong><?=lang('VACATION');?></strong></a></li>
        <?php } if($header_menu->discover=='1'){?>
        <li title="<?=lang('DISCOVER');?>"><a class="mnuic flit" href="<?php echo WEB_URL;?>"><strong><?=lang('DISCOVER');?></strong></a></li>
        <?php } ?>
      </ul>
    </div>
    <!-- /Navigation-->
  </div></div></div>
</div>
