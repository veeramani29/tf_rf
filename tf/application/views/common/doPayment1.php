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
          <input type="hidden" name="PSPID" value="InnoGlobe"> 
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
 <INPUT type="hidden" NAME="AMOUNT" value="<?php echo $TotalFare;?>">
    <INPUT type="hidden" NAME="CURRENCY" value="EUR">
    <INPUT type="hidden" NAME="LANGUAGE" value="fr_FR">
    <INPUT type="hidden" NAME="ORDERID" value="<?php echo $OrderId;?>">
    <INPUT type="hidden" NAME="PSPID" value="ticketfinder">
  <INPUT type="hidden" NAME="SHASIGN" value="ED7E48BEA323923B1751F15B6A2B7B016B72D5FC">
</form>
</body>
</html>-->




<!-- CODE_START --> 
<script type="text/javascript"> 
<!-- Begin 
 
var Amount = 123; 
var PSPID = "TESTiDEALEASY"; 
var AM; 
 
if (isNaN(Amount)) 
    { 
        alert("Amount not a number: " + Amount + " !"); 
        AM = "" 
    } 
else 
    { 
        AM = Math.round(parseFloat(Amount)*100); 
    } 
 
var orderID = "1"; 
mydate = new Date(); 
tv = mydate.getYear() % 10; 
orderID = orderID + tv; 
tv = (mydate.getMonth() * 31) + mydate.getDate(); 
orderID = orderID + ((tv < 10) ? '0' : '') + ((tv < 100) ? '0' : '') + tv; 
tv = (mydate.getHours() * 3600) + (mydate.getMinutes() * 60) + mydate.getSeconds(); 
orderID = orderID + ((tv < 10) ? '0' : '') + ((tv < 100) ? '0' : '') + ((tv < 1000) ? '0' : '') + ((tv < 10000) ? '0' : '') + tv; 
tvplus = Math.round(Math.random() * 9); 
// End --> 
</script> 
 
 
 
<form method="post" action="https://internetkassa.abnamro.nl/ncol/prod/orderstandard.asp" id="form1" name="form1"> 
 
 
<script type="text/javascript"> 
document.write("<input type=\"hidden\" NAME=\"PSPID\" value=\"" + PSPID + "\" />"); 
document.write("<input type=\"hidden\" NAME=\"orderID\" value=\"" + (orderID + ((tvplus + 1) % 10)) + "\" />"); 
document.write("<input type=\"hidden\" NAME=\"amount\" value=\"" + AM + "\" />"); 
</script> 
 
 
<input type="hidden" name="currency" value="EUR" /> 
<input type="hidden" name="language" value="NL_NL" /> 
<input type="hidden" name="PM" value="iDEAL" /> 
 
<input type="hidden" name="accepturl" value="http://www.justwebdevelopment.com/blog" />
<input type="hidden" name="declineurl" value="http://www.justwebdevelopment.com/" />
<input type="hidden" name="exceptionurl" value="http://www.justwebdevelopment.com/" />
<input type="hidden" name="cancelurl" value="http://www.justwebdevelopment.com/" />
<input type="hidden" name="homeurl" value="http://www.justwebdevelopment.com/blog">
 
<button class="iDEALeasy" type="submit" name="submit1" value="submit"> 
Betalen met<br /> 
<img src="https://internetkassa.abnamro.nl/images/iDEAL_easy.gif" alt="iDEAL"  /> 
</button> 
</form> 
<!-- CODE_END --> 


<script type=”text/javascript”>

var Amount =150;
var PSPID = “yourPSPID”;
var AM;

if (isNaN(Amount))
{
alert(“Amount not a number: ” + Amount + ” !”);
AM = “”
}
else
{
AM = Math.round(parseFloat(Amount)*100);
}

var orderID = “1”;
mydate = new Date();
tv = mydate.getYear() % 10;
orderID = orderID + tv;
tv = (mydate.getMonth() * 31) + mydate.getDate();
orderID = orderID + ((tv < 10) ? ‘0’ : ”) + ((tv < 100) ? ‘0’ : ”) + tv;
tv = (mydate.getHours() * 3600) + (mydate.getMinutes() * 60) + mydate.getSeconds();
orderID = orderID + ((tv < 10) ? ‘0’ : ”) + ((tv < 100) ? ‘0’ : ”) + ((tv < 1000) ? ‘0’ : ”) + ((tv < 10000) ? ‘0’ : ”) + tv;
tvplus = Math.round(Math.random() * 9);
// End –>
</script>

<form method=”post” action=”https://internetkassa.abnamro.nl/ncol/test/orderstandard.asp&#8221; id=”form1″ name=”form1″>
<!–https://internetkassa.abnamro.nl/ncol/test/orderstandard.asp–&gt;
<!- https://secure.ogone.com/ncol/test/orderstandard.asp–&gt;

<script type=”text/javascript”>
document.write(“<inputpe=\”hidden\” NAME=\”PSPID\” value=\”” + PSPID + “\” />”);
document.write(“<inputpe=\”hidden\” NAME=\”orderID\” value=\”” + (orderID + ((tvplus + 1) % 10)) + “\” />”);
document.write(“<inputpe=\”hidden\” NAME=\”amount\” value=\”” + AM + “\” />”);
</script>

<input type=”hidden” name=”PSPID” value=”yourPSPID”>

<input type=”hidden” name=”ORDERID” value=”13008541605″>
<input type=”hidden” name=”AMOUNT” value=”150″>
<input type=”hidden” name=”CURRENCY” value=”EUR”>
<input type=”hidden” name=”LANGUAGE” value=”en_US”>
<input type=”hidden” name=”SHASIGN” value=”15EF500D5B1993947A728CCE22D25C4A4AADA44C”>
<button class=”iDEALeasy” type=”submit” name=”submit1″ value=”submit”>
Betalen met<br />
<img src=”https://internetkassa.abnamro.nl/images/iDEAL_easy.gif&#8221; alt=”iDEAL” />
</button>
</form>







 
 
