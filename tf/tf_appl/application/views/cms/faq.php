<?php $this->load->view('common/header');?>
<?php   $language = $this->session->userdata('language'); ?>
<div class="clear"></div>
<!-- CONTENT -->
<div class="full onlycontent marintopcnt">
  <div class="container">
    <div class="container">
      <div class="smspage">
        <h3 id="contentTitle" class="inpagehed"><?php echo ($language=='english')?'FAQ':'FAQ'; ?></h3>
        <div class="cmscontent"> work here </div>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<?php $this->load->view('common/footer');?>
