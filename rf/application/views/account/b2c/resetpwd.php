  <?php $this->load->view('common/header');?>
  <div class="container">
   <div class="rfboxed-background">

  <?php if($status == '1'){?>
  <div class="centerfix"><div class="popuperror" style="display:none;"></div>
    <div  class="pophed"><?php echo lang_line('REST_PSWD'); ?></div>
    <div class="signdiv">
    <form id="resetpwd" name="resetpwd" action="<?php echo WEB_URL;?>/account/resetpwd">
      <div class="ritpul">
      <div class="">
      <span class="icon icon-lock"></span>
      <input type="hidden" name="email" value="<?php echo $email;?>">
      <div class="col-sm-4">
      <input class="form-control logpadding" type="password" name="password" id="npassword" placeholder="<?php echo lang_line('NEW_PSWD'); ?>" minlength="5" maxlength="50" required/>
      </div>
      </div>
      <div class="">
      <span class="icon icon-lock"></span>
      <div class="col-sm-4">
      <input class="form-control logpadding" type="password" name="cpassword" placeholder="<?php echo lang_line('CONF_PSWD'); ?>" required/>
      </div>
      </div>
      <div class="clear"></div>
      <div class="col-sm-4 text-center">
      <button class="btn btns-primary"><?php echo lang_line('Save_Con'); ?></button>
      </div>
      <div class="clear"></div>
      <div class="dntacnt col-sm-12">
      <?php echo lang_line('REMEBER_STR'); ?>  
      <a class="fadeandscaleforget_close fadeandscale_open" id="afterlogin"><?php echo lang_line('SIGNIN'); ?></a> 
      </div>
      </div>
    </form>
    </div>
    </div>
  <?php }else{?>
  <div><?php echo $msg;?></div>
  <?php }?>

  <div class="clearfix"></div>
  </div>
  </div>
  <?php $this->load->view('common/footer');?>