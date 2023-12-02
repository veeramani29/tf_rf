<html>
  <body onload="document.forms[0].submit();">

      <div style="width: 100%">
        <div style="text-align: center; margin-top: 200px">
          <img style="display: block; margin: 0 auto" src="<?php echo WEB_URL.'/assets/images/Preloader.gif' ?>" alt="">
          <span style="font-size: 20px"> <?php echo lang_line('PAYMENT_AJAX_TEXT');?> </span>
        </div>
      </div>

<?php if(isset($params['module']) && $params['module']!='FLIGHT'){ ;?>
<form method="post" action="<?php echo WEB_URL."/doPayment/success";?>" id="form1" target="_top" name="form1">
<input type="hidden" name="orderID" value="<?php echo $params['ORDERID'];?>">
<input type="hidden" name="AMOUNT" value="<?php echo $params['AMOUNT'];?>">
<input type="hidden" name="CURRENCY" value="<?php echo $params['CURRENCY'];?>">
<input type="hidden" name="LANGUAGE" value="<?php echo $params['LANGUAGE'];?>">
<input type="hidden" name="payment_type" value="<?php echo $params['payment_type'];?>">
<input type="hidden" name="Card_Num" value="<?php echo $params['Card_Num'];?>">
<input type="hidden" name="Exp_Month" value="<?php echo $params['Exp_Month'];?>">
<input type="hidden" name="Exp_Year" value="<?php echo $params['Exp_Year'];?>">
<input type="hidden" name="Card_Name" value="<?php echo $params['Card_Name'];?>">
<input type="hidden" name="Card_Cvc" value="<?php echo $params['Card_Cvc'];?>">
<input type="hidden" name="STATUS" value="5">
<input type="hidden" name="PAYID" value="1234568">
</form> 

  <?php } else{ ?>
<form method="post" action="https://secure.ogone.com/ncol/test/orderstandard.asp" id="form1" target="_top" name="form1">
<!-- general parameters: see Form parameters -->

<input type="hidden" name="ACCEPTURL" value="<?php echo $params['ACCEPTURL'];?>">
<input type="hidden" name="AMOUNT" value="<?php echo $params['AMOUNT'];?>">
<input type="hidden" name="BGCOLOR" value="<?php echo $params['BGCOLOR'];?>">
<input type="hidden" name="BUTTONBGCOLOR" value="<?php echo $params['BUTTONBGCOLOR'];?>">
<input type="hidden" name="BUTTONTXTCOLOR" value="<?php echo $params['BUTTONTXTCOLOR'];?>">
<input type="hidden" name="CANCELURL" value="<?php echo $params['CANCELURL'];?>">
<input type="hidden" name="CN" value="<?php echo $params['CN'];?>">
<input type="hidden" name="CURRENCY" value="<?php echo $params['CURRENCY'];?>">
<input type="hidden" name="DECLINEURL" value="<?php echo $params['DECLINEURL'];?>">
<input type="hidden" name="EMAIL" value="<?php echo $params['EMAIL'];?>">
<input type="hidden" name="EXCEPTIONURL" value="<?php echo $params['EXCEPTIONURL'];?>">
<input type="hidden" name="FONTTYPE" value="<?php echo $params['FONTTYPE'];?>"> 
<input type="hidden" name="LANGUAGE" value="<?php echo $params['LANGUAGE'];?>">
<input type="hidden" name="LOGO" value="<?php echo $params['LOGO'];?>">
<input type="hidden" name="ORDERID" value="<?php echo $params['ORDERID'];?>">
<input type="hidden" name="PM" value="<?php echo $params['PM'];?>">
<input type="hidden" name="PSPID" value="<?php echo $params['PSPID'];?>">
<input type="hidden" name="TBLBGCOLOR" value="<?php echo $params['TBLBGCOLOR'];?>">
<input type="hidden" name="TBLTXTCOLOR" value="<?php echo $params['TBLTXTCOLOR'];?>">
<input type="hidden" name="TITLE" value="<?php echo $params['TITLE'];?>">
<input type="hidden" name="TXTCOLOR" value="<?php echo $params['TXTCOLOR'];?>">
<input type="hidden" name="SHASIGN" value="<?php echo $params['sha1'];?>">
<!-- general parameters: see Form parameters -->

</form> 

  	<?php } ?>
  </body>
</html>









 
 
