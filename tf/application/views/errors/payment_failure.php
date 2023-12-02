<?php $this->load->view('common/header');?>

<div id="fuornotfour" class="full marintopcnt contentvcr">
    <div class="container">
        <div class="container offset-0">
        	
            <div class="tablwe">
            <div class="col-md-2 celtb">
            	<div class="fornot">
            <img src="<?php echo ASSETS; ?>images/cancel.png" alt="" />
            </div>
            </div>
            <div class="col-md-10 celtb">
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
                <div class="rellinks">we apologize for the inconvenience faced by you. We will get in touch with you for further details of your concern as the need arises. </div>
              
            </div>
            
           
            </div>
            
        </div>
    </div>
</div>

<?php $this->load->view('common/footer');?>
<script type="text/javascript">
/*	$(document).ready(function(){
		var windowht = $(window).height();
		$('#fuornotfour').css({'min-height':windowht})
	});*/
</script>
</body>
</html>