<?php
use iDEALConnector\iDEALConnector;
use iDEALConnector\Configuration\DefaultConfiguration;
use iDEALConnector\Exceptions\SerializationException;

use iDEALConnector\Exceptions\SecurityException;
use iDEALConnector\Exceptions\ValidationException;
use iDEALConnector\Exceptions\iDEALException;

use iDEALConnector\Entities\Transaction;
use iDEALConnector\Entities\AcquirerTransactionResponse;
use iDEALConnector\Entities\DirectoryResponse;
date_default_timezone_set('UTC');

require_once("Connector/iDEALConnector.php");

$config = new DefaultConfiguration("Connector/config.conf");
$actionType = "";
$issuerList = "";
$errorCode = 0;
$errorMsg = "";
$consumerMessage = "";

$issuerId = "";
$purchaseId = "1234567890123456";
$amount = 10;
$description = "Booking";
$entranceCode = "1234567890123456789012345678901234567890";
$merchantReturnUrl = $config->getMerchantReturnURL();
$expirationPeriod = $config->getExpirationPeriod();

$acquirerID = "";
$issuerAuthenticationURL = "";
$transactionID = "";



//Get Isssur (Or) Bnak List Start
$actionType ="Get Issuers";

if ($actionType == "Get Issuers"){

	try
	{
		$iDEALConnector = iDEALConnector::getDefaultInstance("Connector/config.conf");
		$response = $iDEALConnector->getIssuers();

		/* @var $response DirectoryResponse*/
		foreach ($response->getCountries() as $country)
		{
			$issuerList .= "<optgroup label=\"" . $country->getCountryNames() . "\">";

			foreach ($country->getIssuers() as $issuer) {
				$issuerList .= "<option value=\"" . $issuer->getId() . "\">"
				. $issuer->getName() . "</option>";
			}
			$issuerList .= "</optgroup>";

			$acquirerID = $response->getAcquirerID();
			$responseDatetime = $response->getDirectoryDate();
		}
	}
	catch (SerializationException $ex)
	{
		echo '<b style="color:red">Serialization:'.$ex->getMessage().'</b>';
	}
	catch (SecurityException $ex)
	{
		echo '<b style="color:red">Security:'.$ex->getMessage().'</b>';
	}
	catch(ValidationException $ex)
	{
		echo '<b style="color:red">Validation:'.$ex->getMessage().'</b>';
	}
	catch (iDEALException $ex)
	{
		$errorCode = $ex->getErrorCode();
		$consumerMessage = $ex->getConsumerMessage();
		$errorMsg = $ex->getMessage();

		echo $ex->getErrorCode()." - ".$ex->getMessage();
	}
	catch (Exception $ex)
	{
		echo '<b style="color:red">Exception:'.$ex->getMessage().'</b>';
	}
}

//Get Isssur (Or) Bnak List End

//print_r($_GET);
//Get Transection id regarding bank and redirecting payment Start


if (isset($_POST["purchaseId"]))
	$purchaseId = $_POST["purchaseId"];
else
$purchaseId = json_decode(base64_decode($_GET['OrderId']));
if (isset($_POST["amount"]))
	$amount = floatVal($_POST["amount"]);
else
$amount = floatVal( json_decode(base64_decode($_GET['amount'])));
if (isset($_POST["entranceCode"]))
	$entranceCode = $_POST["entranceCode"];
else
$entranceCode = json_decode(base64_decode($_GET['OrderId']));

if (isset($_POST["submitted"]))
	$actionType = $_POST["submitted"];

if (isset($_POST["issuerId"]))
	$issuerId = $_POST["issuerId"];

if (isset($_POST["description"]))
	$description = $_POST["description"];


if (isset($_POST["merchantReturnURL"]))
	$merchantReturnUrl = $_POST["merchantReturnURL"];

if (isset($_POST["expirationPeriod"]))
	$expirationPeriod = intVal($_POST["expirationPeriod"]);

if ($actionType == "Continue") {
	$iDEALConnector = iDEALConnector::getDefaultInstance("Connector/config.conf");

	try
	{
		$response = $iDEALConnector->startTransaction(
			$issuerId,
			new Transaction(
				$amount,
				$description,
				$entranceCode,
				$expirationPeriod,
				$purchaseId,
				'EUR',
				'nl'
				),
			$merchantReturnUrl
			);

		/* @var $response AcquirerTransactionResponse */
		$acquirerID = $response->getAcquirerID();
		$issuerAuthenticationURL = $response->getIssuerAuthenticationURL();
		$transactionID = $response->getTransactionID();
	}
	catch (SerializationException $ex)
	{
		echo '<b style="color:red">Serialization:'.$ex->getMessage().'</b>';
	}
	catch (SecurityException $ex)
	{
		echo '<b style="color:red">Security:'.$ex->getMessage().'</b>';
	}
	catch(ValidationException $ex)
	{
		echo '<b style="color:red">Validation:'.$ex->getMessage().'</b>';
	}
	catch (iDEALException $ex)
	{
		$errorCode = $ex->getErrorCode();
		$errorMsg = $ex->getMessage();
		$consumerMessage = $ex->getConsumerMessage();

	}
	catch (Exception $ex)
	{
		echo '<b style="color:red">Exception:'.$ex->getMessage().'</b>';
	}
}



//Get Transection id regarding bank and redirecting payment End

?>

<script>
	
	
	window.onload = function(){
		var url='<?php echo $issuerAuthenticationURL ?>';
		if(url!=''){
			window.location.replace("<?php echo $issuerAuthenticationURL ?>");
		}

	}

</script>

	
	<?php if($issuerAuthenticationURL!=''){?>
	<div style="width: 100%">
		<div style="text-align: center; margin-top: 200px">
			<img style="display: block; margin: 0 auto" src="../../assets/images/Preloader.gif" alt="">
			<span style="font-size: 20px">Please wait, do not refresh or close this window. </span>
		</div>
	</div>
	<?php } else { ?>

  <div class="payment">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="media">
            <div class="media-left">
              <a href="index.php">
                <img class="media-object" src="./icons/ideal_logo.gif" alt="Logo">
              </a>
            </div>
            <div class="media-body">
              <br>
              <h4 class="media-heading">Advanced Payments</h4>
              <p>Please Select your bank and continue</p>
            </div>
          </div>

          <form method="post">
            <input type="hidden" size="60" name="amount" value="<?php echo $amount; ?>">
            <input type="hidden" maxlength="32" size="60" name="description" value="<?php echo $description; ?>">
            <input type="hidden" size="60" name="entranceCode" value="<?php echo $entranceCode; ?>">
            <input type="hidden" size="60" name="merchantReturnURL" value="<?php echo $merchantReturnUrl ?>">
            <input type="hidden" size="60" name="expirationPeriod" value="<?php echo $expirationPeriod; ?>">
            <input type="hidden" size="60" name="purchaseId" value="<?php echo $purchaseId; ?>">
            <div class="form-group">
              <label for="IssuerIDs">Please Select Bank</label>
              <select class="form-control" name="issuerId" id="IssuerIDs"><?php echo $issuerList; ?></select>
            </div>
            <input type="submit" class="btn btn-default" name="submitted" value="Continue">
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php }?>


</body>
</html>
