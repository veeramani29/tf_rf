<!-- TAB 7 -->
<div class="tab-pane <?php if(!empty($page_type) && $page_type == "newsletter") {echo "active";} ?>" id="newsletter">
  <div class="padding20"> <span class="dark padtabne size18"><?=lang('Newsletter');?></span>
    <div class="rowit">
    <div class="checkbox dark">
      <label>
        <?php //JavaScript related to this file is present in js/validate/custom.js ?>
        <input id="checkNewsLetter" type="checkbox" <?php echo ($getNewsletterStatus == 1) ? 'checked' : ''; ?> >
      <?=lang('Check this box to receive');?>  </label>
      <img class="nl_subs_loader" style="display: none;" src="<?php echo ASSETS.'images/loader.gif'; ?>">
      <span class="ns_subd" style="color: green; font-size: small; display: none;"><?=lang('NEWSLETTER_SUBSCRIBED_MSG');?>.</span>
      <span class="ns_unsub" style="color: red; font-size: small; display: none;"><?=lang('NEWSLETTER_UNSUBSCRIBED_MSG');?>.</span>
    </div>
    <br/>
    
  </div>
  </div>
</div>
<!-- END OF TAB 7 -->