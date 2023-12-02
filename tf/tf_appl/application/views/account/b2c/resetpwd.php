<?php $language = $this->session->userdata('language');
if($language){ $this->lang->load('Account_Login_AL', $language); }else{ $this->lang->load('Account_Login_AL', 'english');  } 
$this->load->view('common/header');?>
<div class="full onlycontent marintopcntpage"><div class="container martopbtm">
<?php if($status == '1'){?>
<div class="centerfix"><div class="popuperror" style="display:none;"></div>
  <div  class="pophed"><?php echo $this->lang->line('AL_Reset'); ?></div>
  <div class="signdiv">
  <form id="resetpwd" name="resetpwd" action="<?php echo WEB_URL;?>/account/resetpwd">
    <div class="ritpul"><div class="rowput"><span class="icon icon-lock"></span>
    <input type="hidden" name="email" value="<?php echo $email;?>">
    <input class="form-control logpadding" type="password" name="password" id="npassword" placeholder="<?php echo $this->lang->line('AL_NewPass'); ?>" minlength="5" maxlength="50" required/>
    </div>
    <div class="rowput"><span class="icon icon-lock"></span>
    <input class="form-control logpadding" type="password" name="cpassword" placeholder="<?php echo $this->lang->line('AL_CPass'); ?>" required/>
    </div><div class="clear"></div>
    <button class="submitlogin"><?php echo $this->lang->line('AL_SC'); ?></button>
    <div class="clear"></div>
    <div class="dntacnt"><?php echo $this->lang->line('AL_Suddenly'); ?>  <a class="fadeandscaleforget_close fadeandscale_open" id="afterlogin"><?php echo $this->lang->line('AL_SignIn'); ?></a> </div>
    </div>
  </form>
  </div>
  </div>
<?php }else{?>
<div><?php echo $msg;?></div>
<?php }?>
</div></div><div class="clearfix"></div>
<?php $this->load->view('common/footer');?>