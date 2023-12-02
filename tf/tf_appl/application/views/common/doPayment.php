<html>
  <body onload="document.forms[0].submit();">

      <div style="width: 100%">
        <div style="text-align: center; margin-top: 200px">
          <img style="display: block; margin: 0 auto" src="<?php echo WEB_URL.'/assets/images/Preloader.gif' ?>" alt="">
          <span style="font-size: 20px">Please wait, do not refresh or close this window. </span>
        </div>
      </div>

  
      <form method="POST" id="payfort_form" name="payfort_form" action="https://secure.payfort.com/ncol/test/orderstandard.asp" target="_top">
          <input type="hidden" name="AMOUNT" value="<?php echo $TotalFare;?>"> 
          <input type="hidden" name="CURRENCY" value="USD">
          <input type="hidden" name="EMAIL" value="<?php echo $Email;?>">  
          <input type="hidden" name="LANGUAGE" value="en_US"> 
          <input type="hidden" name="ORDERID" value="<?php echo $OrderId;?>"> 
          <input type="hidden" name="PSPID" value="ticketfinder"> 
          <input type="hidden" name="SHASIGN" value="<?php echo $sha1;?>"> 
      </form>
  </body>
</html>
<?php //ticketfinder@123    ogoneticketfinderecho print_r($sha1);exit;
//
?>
<!--<html>
<body onload="document.forms[0].submit();">
<FORM METHOD="post" ACTION="https://secure.ogone.com/ncol/test/orderstandard.asp" id="form" name="form">
 <INPUT type="hidden" NAME="AMOUNT" value="2000">
    <INPUT type="hidden" NAME="CURRENCY" value="EUR">
    <INPUT type="hidden" NAME="LANGUAGE" value="fr_FR">
    <INPUT type="hidden" NAME="ORDERID" value="V3KOGHECOEHA">
    <INPUT type="hidden" NAME="PSPID" value="ticketfinder">
  <INPUT type="hidden" NAME="SHASIGN" value="ED7E48BEA323923B1751F15B6A2B7B016B72D5FC">
</form>
</body>
</html>-->








 
 
