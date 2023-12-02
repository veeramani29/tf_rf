<?php $language = $this->session->userdata('language');
if($language){ $this->lang->load('Account_Login_AL', $language); }else{ $this->lang->load('Account_Login_AL', 'english');  } 
$this->load->view('common/header');?>
<div id="fuornotfour" class="full marintopcnt contentvcr"><div class="container"><div class="container offset-0"><div class="tablwe"><div class="col-md-6 celtb"><h2 class="ooops"><?php echo $this->lang->line('AL_Congrat'); ?></h2>
<span class="erordes"><?php echo $this->lang->line('AL_Success'); ?></span>
<div class="ercod"><?php echo $this->lang->line('AL_ACC_Verify'); ?></div>
<div class="rellinks"><?php echo $this->lang->line('AL_Soon'); ?></div>
<div class="erorredrctwrp"><a href="http://bookhotac.com" class="erorredrct"><?php echo $this->lang->line('AL_Home'); ?></a></div>
<div class="erorredrctwrp"><a href="http://bookhotac.com/help" class="erorredrct"><?php echo $this->lang->line('AL_Home'); ?></a></div>
</div><div class="col-md-6 celtb"></div></div></div></div></div>
<?php $this->load->view('common/footer');?>