<!-- TAB 7 -->
<div class="tab-pane rfboxed-background <?php if(!empty($page_type) && $page_type == "newsletter") {echo "active";} ?>" id="newsletter">
  <div class="col-sm-12">
    <div class="newsletter_container">
      <span class="dark padtabne size18"><?php echo lang_line('NEWSLETTER');?></span>
      <div class="rowit">
        <div class="checkbox dark">
          <label>
            <?php //JavaScript related to this file is present in js/validate/custom.js ?>
            <input id="checkNewsLetter1" type="checkbox" <?php echo ($getNewsletterStatus == 1) ? 'checked' : ''; ?> >
            <?php echo lang_line('CHECK_BOX_RECEIVE');?>  </label>
            <img class="nl_subs_loader" style="display: none;" src="<?php echo ASSETS.'images/loader.gif'; ?>">
            <span class="ns_subd" style="color: green; font-size: small; display: none;"><?php echo lang_line('NEWSLETTER_THANK_MSG');?></span>
            <span class="ns_unsub" style="color: red; font-size: small; display: none;"><?php echo lang_line('NEWSLETTER_UNSBS_MSG');?></span>
          </div>
          
        </div>
      </div>
    </div> 
  </div>
<!-- END OF TAB 7 -->