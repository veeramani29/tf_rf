<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="<?php echo ASSETS;?>img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="<?php echo ASSETS;?>img/favicon-32x32.png" sizes="32x32">

    <title><?php echo PROJECT_NAME;?></title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    <!-- uikit -->
    <link rel="stylesheet" href="assets/bower_components/uikit/css/uikit.almost-flat.min.css"/>

    <!-- altair admin login page -->
    <link rel="stylesheet" href="<?php echo ASSETS;?>css/login_page.min.css" />

</head>
<body class="login_page">

    <div class="login_page_wrapper">
        <div class="md-card" id="login_card">




              
          
            <div class="md-card-content large-padding" id="login_password_reset" >
              <!--   <button type="button" class="uk-position-top-right uk-close uk-margin-right uk-margin-top back_to_login"></button> -->
   <?php echo validation_errors('<div class="uk-alert uk-alert-warning text-center" data-uk-alert=""> <a href="#" class="uk-alert-close uk-close" ></a>', '</div>'); ?>
              <?php echo ($error_msg!='')?'<div class="uk-alert uk-alert-danger text-center" data-uk-alert=""><a href="#" class="uk-alert-close uk-close" ></a>'.$error_msg.'</div>':''; ?>
                 <?php echo ($success_msg!='')?'<div class="uk-alert uk-alert-success text-center" data-uk-alert=""><a href="#" class="uk-alert-close uk-close" ></a>'.$success_msg.'</div>':''; ?>

 

                <h2 class="heading_a uk-margin-large-bottom">Get password</h2>
               <form id="login" name="login" method="post">
                    <div class="uk-form-row">
                        <label for="login_email_reset">Your email address</label>
                      
                           <input type="text" name="user_email" class="md-input" value="<?php echo set_value('user_email'); ?>"  id="username" />
                    </div>
                    <div class="uk-margin-medium-top">
                        <button class="md-btn md-btn-primary md-btn-block">Submit</button>
                    </div>
                     <div class="uk-margin-top">
                      <a class="uk-float-right" href="<?php echo base_url('/');?>">Login ?</a>

                    </div>
                </form>
            </div>
          
        </div>
       
    </div>

    <!-- common functions -->
    <script src="<?php echo ASSETS;?>js/common.min.js"></script>
    <!-- altair core functions -->
    <script src="<?php echo ASSETS;?>js/altair_admin_common.min.js"></script>

    <!-- altair login page functions -->
    <script src="<?php echo ASSETS;?>js/pages/login.min.js"></script>

    <!-- uikit functions -->
    <script src="<?php echo ASSETS;?>js/uikit_custom.min.js"></script>
  
</body>
</html>


                
                


            
       

            
            
               