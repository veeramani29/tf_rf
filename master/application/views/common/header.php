
            
              
              <?php
if($this->session->userdata('admin_data')!=null){
$admin_data=$this->session->userdata('admin_data');
//print_r($this->session->userdata('admin_data'));
$session_user_status=$admin_data['user_status'];
if($session_user_status!='Active'){
 $this->session->unset_userdata('admin_data');
    redirect(base_url());
}
$session_access_level=$admin_data['access_level'];
$privilage_array=array('admin','dashboard','discount');
if($session_access_level=='ACC-3' && !in_array($this->router->fetch_class(), $privilage_array)){
 redirect(base_url('admin/unauthorized'));
}
$session_name=($admin_data['username']!=null)?$admin_data['username']:'N/A';
$session_email=($admin_data['user_email']!=null)?$admin_data['user_email']:'N/A';
$session_user_status=($admin_data['user_status']!=null)?$admin_data['user_status']:'N/A';
$session_access_level=($admin_data['access_level']!=null)?$admin_data['access_level']:'N/A';
}
?>
<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="<?php echo IMAGES;?>favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="<?php echo IMAGES;?>favicon-32x32.png" sizes="32x32">

  <title><?php echo PROJECT_NAME;?> ..:: <?php echo ucfirst($this->router->fetch_class());?></title>

    <!-- additional styles for plugins -->
        <!-- weather icons -->
        <link rel="stylesheet" href="<?php echo ASSETS;?>bower_components/weather-icons/css/weather-icons.min.css" media="all">
        <!-- metrics graphics (charts) -->
        <link rel="stylesheet" href="<?php echo ASSETS;?>bower_components/metrics-graphics/dist/metricsgraphics.css">
        <!-- chartist -->
        <link rel="stylesheet" href="<?php echo ASSETS;?>bower_components/chartist/dist/chartist.min.css">
    
    <!-- uikit -->
    <link rel="stylesheet" href="<?php echo ASSETS;?>bower_components/uikit/css/uikit.almost-flat.min.css" media="all">

    <!-- flag icons -->
    <link rel="stylesheet" href="<?php echo ASSETS;?>icons/flags/flags.min.css" media="all">

    <!-- altair admin -->
    <link rel="stylesheet" href="<?php echo CSS;?>main.min.css" media="all">
<script type="text/javascript">
  WEB_URL="<?php  echo HOST_ADMIN;?>";
  HOST="<?php  echo HOST;?>";
  get_csrf_token_name="<?php  echo $this->security->get_csrf_token_name();?>"; 
get_csrf_hash="<?php  echo $this->security->get_csrf_hash();?>";
  </script>

</head>
<body class=" sidebar_main_open sidebar_main_swipe">
    <!-- main header -->
    <header id="header_main">
        <div class="header_main_content">
            <nav class="uk-navbar">
                                
                <!-- main sidebar switch -->
                <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                    <span class="sSwitchIcon"></span>
                </a>
                
                <!-- secondary sidebar switch -->
                <a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check">
                    <span class="sSwitchIcon"></span>
                </a>
                
                    <div id="menu_top_dropdown" class="uk-float-left uk-hidden-small">
                        <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}">
                            <a href="#" class="top_menu_toggle"><i class="material-icons md-24">&#xE8F0;</i></a>
                            <div class="uk-dropdown uk-dropdown-width-3">
                                <div class="uk-grid uk-dropdown-grid" data-uk-grid-margin>
                                    <div class="uk-width-2-3">
                                        <div class="uk-grid uk-grid-width-medium-1-3 uk-margin-top uk-margin-bottom uk-text-center" data-uk-grid-margin>
                                            <a href="page_mailbox.html">
                                                <i class="material-icons md-36">&#xE158;</i>
                                                <span class="uk-text-muted uk-display-block">Mailbox</span>
                                            </a>
                                            <a href="page_invoices.html">
                                                <i class="material-icons md-36">&#xE53E;</i>
                                                <span class="uk-text-muted uk-display-block">Invoices</span>
                                            </a>
                                            <a href="page_chat.html">
                                                <i class="material-icons md-36 md-color-red-600">&#xE0B9;</i>
                                                <span class="uk-text-muted uk-display-block">Chat</span>
                                            </a>
                                            <a href="page_scrum_board.html">
                                                <i class="material-icons md-36">&#xE85C;</i>
                                                <span class="uk-text-muted uk-display-block">Scrum Board</span>
                                            </a>
                                            <a href="page_snippets.html">
                                                <i class="material-icons md-36">&#xE86F;</i>
                                                <span class="uk-text-muted uk-display-block">Snippets</span>
                                            </a>
                                            <a href="page_user_profile.html">
                                                <i class="material-icons md-36">&#xE87C;</i>
                                                <span class="uk-text-muted uk-display-block">User profile</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-3">
                                        <ul class="uk-nav uk-nav-dropdown uk-panel">
                                            <li class="uk-nav-header">Components</li>
                                            <li><a href="components_accordion.html">Accordions</a></li>
                                            <li><a href="components_buttons.html">Buttons</a></li>
                                            <li><a href="components_notifications.html">Notifications</a></li>
                                            <li><a href="components_sortable.html">Sortable</a></li>
                                            <li><a href="components_tabs.html">Tabs</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav user_actions">
                        <li><a href="#" id="full_screen_toggle" class="user_action_icon uk-visible-large"><i class="material-icons md-24 md-light">&#xE5D0;</i></a></li>
                        <li><a href="#" id="main_search_btn" class="user_action_icon"><i class="material-icons md-24 md-light">&#xE8B6;</i></a></li>
                        <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                            <a href="#" class="user_action_icon"><i class="material-icons md-24 md-light">&#xE7F4;</i><span class="uk-badge">16</span></a>
                            <div class="uk-dropdown uk-dropdown-xlarge">
                                <div class="md-card-content">
                                    <ul class="uk-tab uk-tab-grid" data-uk-tab="{connect:'#header_alerts',animation:'slide-horizontal'}">
                                        <li class="uk-width-1-2 uk-active"><a href="#" class="js-uk-prevent uk-text-small">Messages (12)</a></li>
                                        <li class="uk-width-1-2"><a href="#" class="js-uk-prevent uk-text-small">Alerts (4)</a></li>
                                    </ul>
                                    <ul id="header_alerts" class="uk-switcher uk-margin">
                                        <li>
                                            <ul class="md-list md-list-addon">
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <span class="md-user-letters md-bg-cyan">di</span>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Voluptate neque tempore.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Est velit culpa consequatur possimus delectus ratione ex rerum sint quo.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <img class="md-user-image md-list-addon-avatar" src="<?php echo IMAGES;?>avatars/avatar_07_tn.png" alt=""/>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Praesentium quidem voluptas.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Ab enim quia voluptas illo vel commodi.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <span class="md-user-letters md-bg-light-green">vj</span>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Maiores quae.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Dolores sequi cumque repellat itaque at itaque exercitationem hic dolorem eligendi enim.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <img class="md-user-image md-list-addon-avatar" src="<?php echo IMAGES;?>avatars/avatar_02_tn.png" alt=""/>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Autem recusandae in.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Odio magni possimus iure velit deleniti eos qui laborum aut.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <img class="md-user-image md-list-addon-avatar" src="<?php echo IMAGES;?>avatars/avatar_09_tn.png" alt=""/>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="pages_mailbox.html">Architecto ut.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Assumenda unde necessitatibus veniam est enim aut aut ullam accusamus eligendi.</span>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="uk-text-center uk-margin-top uk-margin-small-bottom">
                                                <a href="page_mailbox.html" class="md-btn md-btn-flat md-btn-flat-primary js-uk-prevent">Show All</a>
                                            </div>
                                        </li>
                                        <li>
                                            <ul class="md-list md-list-addon">
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons uk-text-warning">&#xE8B2;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">Rerum maxime.</span>
                                                        <span class="uk-text-small uk-text-muted uk-text-truncate">Saepe facere beatae debitis atque.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons uk-text-success">&#xE88F;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">Aut sequi dolorum.</span>
                                                        <span class="uk-text-small uk-text-muted uk-text-truncate">Sit dolor error sunt odit deleniti.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons uk-text-danger">&#xE001;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">Est nihil.</span>
                                                        <span class="uk-text-small uk-text-muted uk-text-truncate">Quam et alias harum autem quisquam dolores officiis.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons uk-text-primary">&#xE8FD;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">Unde voluptatibus quisquam.</span>
                                                        <span class="uk-text-small uk-text-muted uk-text-truncate">Ut rerum corporis nostrum animi sed ad ut.</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                            <a href="<?php echo base_url('dashboard');?>" class="user_action_image">
                            <?php if($this->session->userdata('admin_data')!=null){ ?>
<img class="md-user-image" src="<?php echo LOGO;?>" alt="Logo">
<?php }else{ ?>
<img class="md-user-image" src="<?php echo LOGO;?>" alt="Logo">
<?php } ?>

<!-- <div class="md-list-addon-element">
<span class="md-user-letters md-bg-cyan">su</span>
</div> -->
                            <div class="uk-dropdown uk-dropdown-small">
                                <ul class="uk-nav js-uk-prevent">
                                    <li><a href="<?php echo base_url('admin/myprofile');?>">My profile</a></li>
                                    <li><a href="<?php echo base_url('admin/changepssword');?>">Settings</a></li>
                                    <li><a href="<?php echo base_url('login/signout');?>">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="header_main_search_form">
            <i class="md-icon header_main_search_close material-icons">&#xE5CD;</i>
            <form class="uk-form">
                <input type="text" class="header_main_search_input" />
                <button class="header_main_search_btn uk-button-link"><i class="md-icon material-icons">&#xE8B6;</i></button>
            </form>
        </div>
    </header><!-- main header end -->



