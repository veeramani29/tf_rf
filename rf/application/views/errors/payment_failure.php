<?php $this->load->view('common/header');?>

<div id="fuornotfour" class="payfalure_container">
  <div class="container">
    <div class="container">        	
      <div class="rfboxed-background">
        <div class="col-xs-12 rfboxed_img ercolumn_center">
          <img src="<?php echo ASSETS; ?>images/icons/sad_emoji.svg" alt="" />
        </div>
        <div class="col-xs-12 rfboxed_img">
         <h2 class="ooops">Failure!</h2>
         <span class="erordes"><?php echo $msg; ?></span>
         <?php
         if($order_id!='')
         {
           ?>
           <span class="erordes">Your Order Number is <?php echo $order_id; ?></span>
           <?php
         }
         ?><?php
         if($pay_id!='')
         {
           ?>
           <span class="erordes">Your Transaction Number is <?php echo $pay_id; ?></span>
           <?php
         }
         ?>
         <div class="rellinks">
          we apologize for the inconvenience faced by you. We will get in touch with you for further details of your concern as the need arises. 
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php $this->load->view('common/footer');?>
</body>
</html>