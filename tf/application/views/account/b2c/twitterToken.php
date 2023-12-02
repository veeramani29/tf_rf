<?php $language = $this->session->userdata('language');
if($language){ $this->lang->load('Account_Login_AL', $language); }else{ $this->lang->load('Account_Login_AL', 'english');  } 
// $this->load->view('common/header');
?>
<link href="<?php echo ASSETS;?>css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php echo ASSETS;?>css/custom.css" rel="stylesheet" media="screen">
<style type="text/css">
	.centerfix{
    max-width: 421px;
    text-align: center;
    display: block;
    margin: auto;
    background-color: #f5f5f5;
    border: 1px solid #ccc;
	}
	.pophed{
		margin: 0;
    margin: 0 0 23px;
	}
	.onlycontent{
		background: transparent;
	}
	.signdiv{
    padding: 0 10px 10px;
	}

</style>
<div class="full onlycontent marintopcntpage"><div class="container martopbtm">
<div class="centerfix"><div class="popuperror" style="display:none;"></div>
<div  class="pophed"><?php echo $this->lang->line('AL_EmailAuth'); ?></div><div class="signdiv">
<form id="twitterToken" name="twitterToken" method="post">
<div class="ritpul"><div class="rowput"><span class="icon icon-lock"></span>
<input type="hidden" name="email">
<input class="form-control logpadding" type="email" name="email" placeholder="<?php echo $this->lang->line('AL_EEmail'); ?>" required/></div><div class="clear"></div>
<button class="submitlogin"><?php echo $this->lang->line('AL_SC'); ?></button>
<div class="clear"></div></div>
</form></div></div></div></div><div class="clearfix"></div>
<?php 
// $this->load->view('common/footer');
?>