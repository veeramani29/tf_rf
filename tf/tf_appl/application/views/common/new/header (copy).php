<?php  $language = $this->session->userdata('language');
if($language){ $this->lang->load('Header_H', $language); }else{ $this->lang->load('Header_H', 'english');  }?>
<!DOCTYPE html>
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0' >
  <title><?php echo $this->lang->line('H_title'); ?></title>
	<!-- Bootstrap -->
    <link href="<?php echo ASSETS;?>css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?php echo ASSETS;?>css/main.css" rel="stylesheet" media="screen">
    <link href="<?php echo ASSETS;?>css/colorbox.css" rel="stylesheet" media="screen">
    <link href="<?php echo ASSETS;?>css/popup_style.css" rel="stylesheet" media="screen">
    <link href="<?php echo ASSETS;?>css/custom.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="<?php echo ASSETS;?>css/cart.css" type="text/css"/> 
    <link href="<?php echo ASSETS;?>css/font-awesome.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="<?php echo ASSETS;?>css/backslider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo ASSETS;?>css/backslider2.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo ASSETS;?>css/simplePagination.css" type="text/css" media="screen" />
	<link href="<?php echo ASSETS;?>css/carousel.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo ASSETS;?>js/html5shiv.js"></script>
      <script src="<?php echo ASSETS;?>js/respond.min.js"></script>
    <![endif]-->
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
  <!--<link rel="stylesheet" href="<?php echo ASSETS;?>css/jquery_ui.css" />	-->
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
 <!-- <script src="<?php echo ASSETS;?>js/jquery-ui-1.10.4.min.js"></script>-->
  <script src="<?php echo ASSETS;?>js/jquery.datetimepicker.js"></script>
  <script src="<?php echo ASSETS;?>js/jquery.colorbox.js"></script>
	<script type="text/javascript" src="<?php echo ASSETS;?>js/jshashtable-2.1_src.js"></script>
	<script type="text/javascript" src="<?php echo ASSETS;?>js/jquery.numberformatter-1.2.3.js"></script>
	<script type="text/javascript" src="<?php echo ASSETS;?>js/tmpl.js"></script>
	<script type="text/javascript" src="<?php echo ASSETS;?>js/jquery.dependClass-0.1.js"></script>
	<script type="text/javascript" src="<?php echo ASSETS;?>js/draggable-0.1.js"></script>
	<script type="text/javascript" src="<?php echo ASSETS;?>js/jquery.slider.js"></script>
	<script type='text/javascript' src='<?php echo ASSETS;?>js/jquery.customSelect.js'></script>
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
    
    
    
    <?php if($language == 'arabic'){?>
    <link href="<?php echo ASSETS;?>css/bootstrap-rtl.css" rel="stylesheet" media="screen">
    <link href="<?php echo ASSETS;?>css/rtl.css" rel="stylesheet" media="screen" />
    <?php }?>
    
    <link href="<?php echo ASSETS;?>css/media.css" rel="stylesheet">
    <link rel="stylesheet" href="css/validation.css" />
    
    
  
 
   
    
</head>
<body id="top" class="thebg">
<!-- Popup_signin_start -->
<script>
$(document).ready(function(){

    $(".cboxClose1").click(function(){
      $("#cboxOverlay,#colorbox").hide();
      });
      
      $(".example9").colorbox({width:"375px", height:"350px", inline:true, href:"#inline_example4"});
      $(".example10").colorbox({width:"375px", height:"430px", inline:true, href:"#inline_example14"});
      $(".example11").colorbox({width:"500px", height:"240px", inline:true, href:"#inline_example24"});
    
      $("#onLoad").click(function(){ 
        $('#onLoad').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
        return false;
      });

});
</script>

<div style='display:none'>
  <div id='inline_example4' style='background:#fff;'>
    <div class="popup_page">
      <div class="popup_header">Sign in your Account. </div>
        <div class="popup_detail form">
          <div class="banner_signup ">
            <form id="userlogin" name="userlogin" action="site/user/login_user" method="post">  
				
				<div>
              <input type="text" id="lemail" name="email"  placeholder="Email Address" class="book_txt  " style="padding:8px 0px 8px 10px; font-size:13px; margin-bottom: 15px;"  />
              </div>
              <div>
              <input type="password" id="lpass" name="password"  placeholder="Password" class="book_txt " style="padding:8px 0px 8px 10px; font-size:13px; margin-bottom: 15px;" />
              </div>
              <input type="submit" value="Login" class="flight_btn" style="width:230px" />
                <span class="popup_forgot example11"><a href="#">Forgot password?</a></span>
                <span class="popup_forgot"><a class="example10" href="#">Create an Account!</a></span>
            </form>
           
          </div>
        </div>
    </div>
  </div>
</div>

<div style='display:none'>
  <div id='inline_example14' style='background:#fff;'>
    <div class="popup_page">
      <div class="popup_header">Create your Account. </div>
        <div class="popup_detail form">
          <div class="banner_signup">
            <form name="usermyaccount" id="usermyaccount" action="<?php echo WEB_URL;?>/account/create" method="post"> 
				 <input type="hidden" id="hdnolduser" name="hdnolduser" value="0" />
              <div>
              <input type="text" id="fname" name="fname"  placeholder="First Name"  class="book_txt " style="padding:8px 0px 8px 10px; font-size:13px; margin-bottom: 15px;"  />
             </div>
              <div>
              <input type="text" id="lname" name="lname"  placeholder="Last Name"   class="book_txt " style="padding:8px 0px 8px 10px; font-size:13px; margin-bottom: 15px;"  />
              </div>
              <div>
              <input type="text" id="email" name="email"   placeholder="Email Address"  class="book_txt " style="padding:8px 0px 8px 10px; font-size:13px; margin-bottom: 15px;"  />                                 
              </div>
               <div>
              <input type="password" id="password" name="password"   placeholder="Password" class="book_txt " style="padding:8px 0px 8px 10px; font-size:13px; margin-bottom: 15px;" />
               </div>
                <div>
              <input type="password" id="cpassword" name="cpassword"   placeholder="Confirm Password" class="book_txt " style="padding:8px 0px 8px 10px; font-size:13px; margin-bottom: 15px;" />
              </div>
              <input type="submit" value="Register" class="flight_btn" style="width:230px" />                              
            </form> 
        </div>
      </div>
    </div>
  </div>
</div>
<div style='display:none'>
  <div id='inline_example24' style='background:#fff;'>
    <div class="popup_page">
      <div class="popup_header">Forgot your Password?</div>
        <div class="popup_detail form	">
          <div class="banner_signup">
            <form name="signupForgot" id="signupForgot" action="site/user/forgot_password_user" method="post">    
              <p>Enter your e-mail address below to reset your password.</p>
              <div>
              <input type="text" id="femail" name="email" placeholder="Email Address" class="book_txt" style="padding:8px 0px 8px 10px; font-size:13px; margin-bottom: 15px;"  />                                 
              </div>
              <input type="submit" value="Submit" class="flight_btn" style="margin-left: 10px; margin-top: 2px; font-size:15px;  width: 100px;" />                              
            </form>
          
          </div>
        </div>
      </div>
    </div>
</div>

<!-- Popup_signin_end -->
<div id="perspective" class="perspective effect-moveleft">
 <div class="container_cart"><div class="wrapper_cart"><div class="navbar-wrappermy"><div class="container"><div class="navbar">
 <div class="onlyapart offset-0">
  <!-- Navigation-->
	<div class="navbar-header  col-xs-2  nopad">
	<a href="<?php echo WEB_URL;?>" class="navbar-brand myband"><img style="width: 200px;height:47px; " src="<?php echo ASSETS;?>images/logo.png" alt="<?php echo $this->lang->line('H_logo_title'); ?>" class="img-responsive" /></a>
	</div>
    <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
    <div class="col-xs-6 nopad mobheder"> 
      <ul class="simnavritrit">
    	<?php if($controller != 'booking'){ $session_id = $this->session->userdata('session_id');  $cart_data = $this->cart_model->getCart($session_id);  ?>        <li class="dropdown navbar-right splli nomarlii">
		  <!--<button id="showMenu">Show Menu</button>-->
		  <div class="cartico shopingcart" id="showMenu"> <span class="cartcnt"><?php echo $cart_data['count'];?></span><!-- <span class="cartimer">19:00</span> --></div>
		  </li>
		<?php }?>
      </ul>
      <div class="mobilemore navbar-toggle" data-target="#mobilemore" data-toggle="collapse"><span class="icon icon-plus"></span></div>
      <ul class="nav navbar-nav simnavrit  collapse" id="mobilemore">
       
       <!-- <li class="dropdown navbar-right splli">
		<a data-toggle="dropdown" class="dropdown-toggle litblu ritspl" href="#"><img class="lang" src="<?php echo base_url()?>assets/images/flags/<?php echo ($language)?$language:'english'?>.png" /><b class="lightcaret mt-2"></b></a>
			<ul class="dropdown-menu langugmob">
			  <li><a href="<?php echo WEB_URL;?>/home/language/english/<?php echo $current_url; ?>"><img class="lang" src="<?php echo base_url()?>assets/images/flags/english.png" /><?php echo $this->lang->line('H_English'); ?></a></li>
			  <li><a href="<?php echo WEB_URL;?>/home/language/arabic/<?php echo $current_url; ?>"><img class="lang" src="<?php echo base_url()?>assets/images/flags/arabic.png" /><?php echo $this->lang->line('H_Arabic'); ?></a></li>
			  <li><a href="<?php echo WEB_URL;?>/home/language/german/<?php echo $current_url; ?>"><img class="lang" src="<?php echo base_url()?>assets/images/flags/german.png" /><?php echo $this->lang->line('H_German'); ?></a></li>
			  <li><a href="<?php echo WEB_URL;?>/home/language/french/<?php echo $current_url; ?>"><img class="lang" src="<?php echo base_url()?>assets/images/flags/french.png" /><?php echo $this->lang->line('H_French'); ?></a></li>
			  <li><a href="<?php echo WEB_URL;?>/home/language/spanish/<?php echo $current_url; ?>"><img class="lang" src="<?php echo base_url()?>assets/images/flags/spanish.png" /><?php echo $this->lang->line('H_Spanish'); ?></a></li>
			  <li><a href="<?php echo WEB_URL;?>/home/language/farsi/<?php echo $current_url; ?>"><img class="lang" src="<?php echo base_url()?>assets/images/flags/farsi.png" /><?php echo $this->lang->line('H_Farsi'); ?></a></li>
			</ul>
		</li>-->
        <li class="dropdown navbar-right splli splcurency">
			<!--<a data-toggle="dropdown" class="dropdown-toggle litblu ritspl" href="#"><?php echo $this->display_currency;?><b class="lightcaret mt-2"></b></a>
			<ul class="dropdown-menu currencychange">
            <?php foreach($currency_info as $valcurr) {  ?>
            <li <?php if($this->display_currency == $valcurr->country){?>class="selected"<?php }?>><a href="javascript:void(0)" onClick="ChangeCurrency(this)" data-code="<?php echo $valcurr->country; ?>" data-icon="<?php echo $valcurr->country_code; ?>"><strong><?php echo $valcurr->country; ?></strong> - <?php echo $valcurr->currency_name; ?></a></li>
             <?php	} ?>
            </ul>-->
		</li>

          <li class="splli margtop10">
            <a href="#" class="login example10">Sign up</a>
          </li>
          <li class="splli margtop10">
            <a href="#" class="login example9">Login</a>
          </li>
      
    
     <?php /*?>   <li class="dropdown navbar-right splli">
  		<a data-toggle="dropdown" class="dropdown-toggle ritspl" href="#"><?php echo $this->lang->line('H_Help'); ?><b class="lightcaret mt-2"></b></a>
  			<ul class="dropdown-menu">
             <li class="qustiononly"><a href="<?php echo WEB_URL.'/help'; ?>"><?php echo $this->lang->line('H_Visit_the_Help_Center'); ?></a></li>
             <?php  foreach($this->helpMenuLink as $helpLinkArray_key) {  foreach($helpLinkArray_key as $link_key) {  ?>
             <li><a href="<?php echo WEB_URL.'/help/article/'.$link_key->menu_id.'/'.$link_key->sub_menu_id; ?>"><?php echo $link_key->sub_menu_title; ?></a></li>
             <?php  }  } ?>
			</ul>
	  	</li><?php */?>
        <?php if($controller == 'agent'){  }else{ ?>
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
		<li class="dropdown navbar-right splli"> <a data-toggle="dropdown" class="dropdown-toggle ritspl" href="#">
        <div class="usrwel"><img src="<?php echo $profile_photo;?>" alt="" class="profile_photo"/></div>
        <?php echo $b2c_data->firstname;?><b class="lightcaret mt-2"></b> </a>
         <ul class="dropdown-menu">
         <li><a href="<?php echo WEB_URL;?>/dashboard"><?php echo $this->lang->line('H_Dashboard'); ?></a></li><li><a href="<?php echo WEB_URL;?>/dashboard/bookings"><?php echo $this->lang->line('H_Bookings'); ?></a></li><li><a href="<?php echo WEB_URL;?>/dashboard/settings"><?php echo $this->lang->line('H_Settings'); ?></a></li><li><a href="<?php echo WEB_URL;?>/dashboard/support_conversation"><?php echo $this->lang->line('H_Support_Ticket'); ?></a></li><li><?php echo anchor('auth/logout/'.$provider.'/'.$b2c_data->user_id.'/'.$current_url,$this->lang->line('H_Logout'));?></li>
         </ul>
        </li>
        <?php 
        }else if($this->session->userdata('b2b_id')) {
        $b2b_id = $this->session->userdata('b2b_id');
        $b2b_data = $this->account_model->GetUserData(2, $b2b_id)->row();
        if($b2b_data->agent_logo == ''){
          $profile_photo = ASSETS.'images/user-avatar.jpg';
          }else{
          $profile_photo = $b2b_data->agent_logo;
        }
        $provider = $b2b_data->loggedin_with;
        $current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
        $current_url = $this->config->site_url().$this->uri->uri_string(). $current_url;
        $current_url = base64_encode($current_url);   ?>
        <li class="dropdown navbar-right splli">
        <a href=""   data-toggle="dropdown" class="dropdown-toggle ritspl"><?php echo $this->lang->line('H_Account'); ?><b class="lightcaret mt-2"></b></a>          <ul class="dropdown-menu">
            <li><a href="<?php echo WEB_URL;?>/dashboard/account_statement"><?php echo $this->lang->line('H_Account_s'); ?></a></li>
            <li><a href="<?php echo WEB_URL;?>/dashboard/booking_statement"><?php echo $this->lang->line('H_Booking_s'); ?></a></li>
          </ul>
		</li>
		<li class="dropdown navbar-right splli"> <a data-toggle="dropdown" class="dropdown-toggle ritspl" href="#">
        <div class="usrwel"><img src="<?php echo $profile_photo;?>" alt="" class="profile_photo"/></div>
        <?php echo $b2b_data->firstname;?><b class="lightcaret mt-2"></b> </a>
         <ul class="dropdown-menu">
          <li><a href="<?php echo WEB_URL;?>/dashboard"><?php echo $this->lang->line('H_Dashboard'); ?></a></li><li><a href="<?php echo WEB_URL;?>/dashboard/bookings"><?php echo $this->lang->line('H_Bookings'); ?></a></li><li><a href="<?php echo WEB_URL;?>/dashboard/settings"><?php echo $this->lang->line('H_Settings'); ?></a></li><li><a href="<?php echo WEB_URL;?>/dashboard/support_conversation"><?php echo $this->lang->line('H_Support_Ticket'); ?></a></li><li><?php echo anchor('auth/logout/'.$provider.'/'.$b2b_data->agent_id.'/'.$current_url,$this->lang->line('H_Logout'));?></li>
         </ul>
		</li>
        <?php }else{?>
		
        <?php }}?>		   		
      </ul>
	</div>  
	<div class="navbar-collapse collapse col-xs-4 filcols nopad margtop10">
      <ul class="nav navbar-nav navbar-left text-uppercase">
         <!-- <li title="<?php echo $this->lang->line('H_Home'); ?>"><a class="mnuic hom" href="<?php echo WEB_URL;?>"><strong><?php echo $this->lang->line('H_Home'); ?></strong></a></li> -->
		<?php if($this->session->userdata('b2b_id')) {?>
		
		<?php if (in_array('flight', $this->mod)) {?>
        <li title="<?php echo $this->lang->line('H_Flight'); ?>"><a class="mnuic flit" href="<?php echo WEB_URL;?>/Flight"><b>Flights</b> <!-- <strong><?php echo $this->lang->line('H_Flight'); ?></strong> --></a></li>
		<?php }?>
		<?php if (in_array('hotel', $this->mod)) {?>
        <li title="<?php echo $this->lang->line('H_Hotel'); ?>"><a class="mnuic htl" href="<?php echo WEB_URL;?>/Hotel"><b>Hotels</b> <!-- <strong><?php echo $this->lang->line('H_Hotel'); ?></strong> --></a></li>
		<?php }?>
		<?php if (in_array('car', $this->mod)) {?>
        <li title="<?php echo $this->lang->line('H_Car'); ?>"><a class="mnuic car" href="<?php echo WEB_URL;?>/Car"><b>Cars</b> <!-- <strong><?php echo $this->lang->line('H_Car'); ?></strong> --></a></li>
		<?php }?>
		<?php if (in_array('vacation', $this->mod)) {?>
        <!-- <li title="<?php echo $this->lang->line('H_Vacation'); ?>"><a class="mnuic vcatn" href="<?php echo WEB_URL;?>/Vacation"><strong><?php echo $this->lang->line('H_Vacation'); ?></strong></a></li> -->
		<?php }?>
		<?php }else{?>
       
        <li title="<?php echo $this->lang->line('H_Flight'); ?>"><a class="mnuic flit" href="<?php echo WEB_URL;?>/Flight"><b>Flights</b> <!-- <strong><?php echo $this->lang->line('H_Flight'); ?></strong> --></a></li>
        <li title="<?php echo $this->lang->line('H_Hotel'); ?>"><a class="mnuic htl" href="<?php echo WEB_URL;?>/Hotel"><b>Hotels</b> <!-- <strong><?php echo $this->lang->line('H_Hotel'); ?></strong> --></a></li>       
        <li title="<?php echo $this->lang->line('H_Car'); ?>"><a class="mnuic car" href="<?php echo WEB_URL;?>/Car"><b>Cars</b> <!-- <strong><?php echo $this->lang->line('H_Car'); ?></strong> --></a></li> 
        <!-- <li title="<?php echo $this->lang->line('H_Vacation'); ?>"><a class="mnuic vcatn" href="<?php echo WEB_URL;?>/Vacation"><strong><?php echo $this->lang->line('H_Vacation'); ?></strong></a></li> -->
        <?php }?>	
      </ul>
    </div>
 <!-- /Navigation-->			  
</div></div></div></div>

