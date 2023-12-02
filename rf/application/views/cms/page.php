<?php $this->load->view('common/header');?>
<?php  $language = $this->session->userdata('language'); ?>
<div class="clear"></div>
<!-- CONTENT -->

  <div class="container">
    <div class="rfboxed-background">
      <div class="smspage">
        <h3 id="contentTitle" class="inpagehed"><?php echo ($page->title)?$page->title:''; ?></h3>
        <div class="cmscontent"> <?php echo !empty($page->$language)?$page->$language:$page->english; ?> </div>
      </div>
    </div>
  </div>

<div class="clearfix"></div>
<?php $this->load->view('common/footer');?>
