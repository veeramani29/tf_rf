<?php
$key = '89:83:f9:ff:41:88:aa:7b:6a:cd:81:8d:0b:a9:a9:7f:a8:41:c0:e6'; // your hashkey or secret key
$merchantID = '005057896'; //your acceptorID
$subID = '0'; //virtually always the value 0 (zero)
$purchaseID = '10'; //free field – to be used for your back office
$paymentType = 'ideal';
$validUntil = date('Y-m-d\TH:i:s.000\Z', time()+900);

$itemNumber1 = '1'; // article number
$itemDescription1 = 'omschrijving'; // the description
$itemQuantity1 = 1; // number of items
$itemPrice1 = 100; // Unit price of article in whole eurocents
$amount = $itemQuantity1 * $itemPrice1; // total amount of transaction


$baseurl = 'http://tf.tekhne.nl/';
$urlSuccess = "$baseurl/Success.html";
$urlCancel = "$baseurl/Cancel.html";
$urlError = "$baseurl/Error.html";



# Composition of the string to be hashed
$shastring = "$key$merchantID$subID$amount$purchaseID$paymentType$validUntil". "$itemNumber1$itemDescription1$itemQuantity1$itemPrice1";
# Replacement of ‘forbidden characters
$shastring = preg_replace(array("/[ \t\n]/", '/&amp;/i', '/&lt;/i', '/&gt;/i', '/&quot/i'),array('','&','<','>','"'),$shastring);

$shasign = sha1($shastring);

$language = 'nl'; # preferably '' for constant characters, quicker to process.
$currency = 'EUR';
$description = 'Example hashcode';

?>




<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>

<form method="post" action="https://idealtest.secure-ing.com/ideal/mpiPayInitIng.do" name="form1">

<input type="hidden" name="merchantID" value="<?php echo $merchantID;?>">
<input type="hidden" size="60" name="issuerId" value="INGBNL2A">
<input type="hidden" name="subID" value="<?php echo $subID;?>">
<input type="hidden" name="amount" value="<?php echo $amount;?>">
<input type="hidden" name="purchaseID" value="<?php echo $purchaseID;?>">
<input type="hidden" name="language" value="<?php echo $language;?>">
<input type="hidden" name="currency" value="<?php echo $currency;?>">
<input type="hidden" name="description" value="<?php echo $description;?>">
<input type="hidden" name="hash" value="<?php echo $shasign;?>">
<input type="hidden" name="paymentType" value="<?php echo $paymentType;?>">
<input type="hidden" name="validUntil" value="<?php echo $validUntil;?>">
<input type="hidden" name="itemNumber1" value="<?php echo $itemNumber1;?>">
<input type="hidden" name="itemDescription1" value="<?php echo $itemDescription1;?>">
<input type="hidden" name="itemQuantity1" value="<?php echo $itemQuantity1;?>">
<input type="hidden" name="itemPrice1" value="<?php echo $itemPrice1;?>">
<input type="hidden" name="urlSuccess" value="<?php echo $urlSuccess;?>">
<input type="hidden" name="urlCancel" value="<?php echo $urlCancel;?>">
<input type="hidden" name="urlError" value="<?php echo $urlError;?>">
<input type="submit" name="submit2" value="Verstuur">
</form>

</body>
</html>
