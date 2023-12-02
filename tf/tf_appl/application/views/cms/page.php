<?php $this->load->view('common/header');?>
<?php   $language = $this->session->userdata('language'); ?>
<div class="clear"></div>
<!-- CONTENT -->
<div class="full onlycontent marintopcnt">
  <div class="container">
    <div class="container">
      <div class="smspage">
        <h3 id="contentTitle" class="inpagehed"><?php echo ($language=='english')?$page->title:$page->title_dutch; ?></h3>
        <div class="cmscontent"> <?php echo !empty($page->$language)?$page->$language:$page->english; ?> </div>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<?php $this->load->view('common/footer');?>
