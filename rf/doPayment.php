<?php
$sha1_pwd = 'ReservationFactory123@';

$params = array(
                'AMOUNT' => 10,
                'CURRENCY' => 'EUR',
                'EMAIL' => 'veera@gmail.com',
                'LANGUAGE' => 'nl_NL',
                'ORDERID' => time(),
                'PSPID' => 'ReservationFactory',
                'PM' => 'CreditCard'
                //'sha1' => sha1($sha1_pwd)
                );

$sha1='';
foreach ($params as $key => $value) {
  $sha1.=$key."=".$value.$sha1_pwd;
}

$params['sha1']=sha1($sha1);

//echo $sha1;die;

define('WEB_URL', 'http://localhost/rf/');
?>



<html>
  <body onload="document.forms[0].submit();">

      <div style="width: 100%">
        <div style="text-align: center; margin-top: 200px">
          <img style="display: block; margin: 0 auto" src="<?php echo WEB_URL.'/assets/images/Preloader.gif' ?>" alt="">
          <span style="font-size: 20px"> <?php echo ('PAYMENT_AJAX_TEXT');?> </span>
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
<form method="post" action="https://secure.ogone.com/ncol/prod/orderstandard.asp" id="form1" target="_top" name="form1">
<!-- general parameters: see Form parameters -->
<input type="hidden" name="PSPID" value="<?php echo $params['PSPID'];?>">
<input type="hidden" name="ORDERID" value="<?php echo $params['ORDERID'];?>">
<input type="hidden" name="AMOUNT" value="<?php echo ($params['AMOUNT']);?>">
<input type="hidden" name="CURRENCY" value="<?php echo $params['CURRENCY'];?>">
<input type="hidden" name="LANGUAGE" value="<?php echo $params['LANGUAGE'];?>">
<input type="hidden" name="PM" value="<?php echo $params['PM'];?>">
<input type="hidden" name="EMAIL" value="<?php echo $params['EMAIL'];?>">
<!-- <input type="hidden" name="OWNERZIP" value="606203">
<input type="hidden" name="OWNERADDRESS" value="Test">
<input type="hidden" name="OWNERCTY" value="Bangalore">
<input type="hidden" name="OWNERTOWN" value="Bangalore">
<input type="hidden" name="OWNERTELNO" value="9943097782">-->-->
<input type="hidden" name="SHASIGN" value="<?php echo $params['sha1'];?>"> 

<!-- check before the payment: see Security: Check before the payment -->

<!-- layout information: see Look and feel of the payment page-->
<input type="hidden" name="TITLE" value="To Pay ReservationFactory">
<input type="hidden" name="BGCOLOR" value="#333">
<input type="hidden" name="TXTCOLOR" value="#FFF">
<input type="hidden" name="TBLBGCOLOR" value="#FFF">
<input type="hidden" name="TBLTXTCOLOR" value="#66AFE9">
<input type="hidden" name="BUTTONBGCOLOR" value="#FFD627">
<input type="hidden" name="BUTTONTXTCOLOR" value="#FFF">
<input type="hidden" name="LOGO" value="https://secure.ogone.com/images/merchant/ReservationFactory/LOGO.png">
<input type="hidden" name="FONTTYPE" value="sans-serif"> 
<!-- layout information: see Look and feel of the payment page-->

<input type="hidden" name="ACCEPTURL" value="<?php echo WEB_URL."/doPayment/success";?>">
<input type="hidden" name="DECLINEURL" value="<?php echo WEB_URL."/doPayment/decline";?>">
<input type="hidden" name="EXCEPTIONURL" value="<?php echo WEB_URL."/doPayment/exception";?>">
<input type="hidden" name="CANCELURL" value="<?php echo WEB_URL."/doPayment/cancel";?>">

</form> 

  	<?php } ?>
  </body>
</html>









 
 
