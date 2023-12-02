<!doctype html><html lang="en">
    <head>
        <meta charset="utf-8">
        <title>:: <?php echo Site_Title; ?> ::</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.css"> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.fancybox.css"> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css"> 
    </head>    <body class='login_body'>        <div class="wrap" style="height: 390px;"> 
            <div style="margin: 20px 0 30px 0;    text-align: center;"> 
                <img src="<?php echo base_url(); ?>public/img/logo.png" style="width: 236px;" class="img-responsive"> 
            </div> 
            <form action="<?php echo site_url(); ?>/login/admin_login"  autocomplete="off" method="post"> 
                <div class="login"> 
       	                    <?php if (validation_errors() != '' || !empty($status)) { ?> 
                    <div class="alert alert-block alert-danger"> 
                        <a href="#" data-dismiss="alert" class="close">×</a>  
                                          <?php echo validation_errors(); ?> 
                   	<?php if (!empty($status)) echo $status; ?>
                    </div>
                                      <?php } ?> 
                    <div class="email">
                        <label for="user">Email</label>  
                        <div class="email-input"> 
                            <div class="input-prepend"> 
                                <span class="add-on">
                                    <i class="icon-envelope"></i>
                                </span> 
                                <input type="email" id="loginEmailId"  name="loginEmailId" required> 
                            </div>
                        </div>
                    </div>
                    <div class="pw">  
                        <label for="pw">Password</label> 
                        <div class="pw-input"> 
                            <div class="input-prepend"> 
                                <span class="add-on"> 
                                    <i class="icon-lock"></i>
                                </span>
                                <input type="password" id="loginPassword" name="loginPassword" required> 
                            </div> 
                        </div> 
                    </div> 
                </div>  
                <div class="submit">
                    <button class="btn btn-primary" style="background-color: #f74623;
    font-weight: bold;
    padding-left: 30px;
    padding-right: 30px;
    padding-top: 10px;
    padding-bottom: 10px;
    font-size: 17px;
    margin-right: 140px;">Login</button> 
                </div>	
            </form>
        </div>
        <script src="<?php echo base_url(); ?>public/js/jquery.js"> 
        </script>
    </body>
</html>
