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
$purchaseId = $entranceCode;
$amount = $amount;
$description = "Booking";
$entranceCode = $entranceCode;
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
	$purchaseId = json_decode(base64_decode($entranceCode));
if (isset($_POST["amount"]))
	$amount = floatVal($_POST["amount"]);
else
{
	$amount = floatVal(json_decode(base64_decode($amount)));
}
if (isset($_POST["entranceCode"]))
	$entranceCode = $_POST["entranceCode"];
else
	{		
		$entranceCode = json_decode(base64_decode($entranceCode));
	}

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
//echo $issuerAuthenticationURL; die();
?>


<script>
	
	
	window.onload = function(){
		var url='<?php echo $issuerAuthenticationURL ?>';
		if(url!=''){
			window.location.replace("<?php echo $issuerAuthenticationURL ?>");
		}

	}

</script>
	<?php if($issuerAuthenticationURL!=''){ ?>
	<div style="width: 100%">
		<div style="text-align: center; margin-top: 200px">
			<img style="display: block; margin: 0 auto" src="../../assets/images/Preloader.gif" alt="">
			<span style="font-size: 20px"><?=lang('WAIT_DONOT_REFRESH');?> </span>
		</div>  
	</div>
	<?php } else { ?>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="media">
				<div class="media-left">
					
						<img class="media-object" src="<?php echo ASSETS; ?>/images/ideal_logo.gif" alt="Logo">
					
				</div>
				<div class="media-body">
					<br>
					<h4 class="media-heading"><?=lang('ADVANCED_PAYMENTS');?></h4>
					<p><?=lang('SELECT_YOUR_BANK');?></p>
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
					<div class="row">
						<div class="col-md-6">
							<label for="IssuerIDs"><?=lang('PLEASE_SELECT_BANK');?></label>
							<select class="form-control" name="issuerId" id="IssuerIDs"><?php echo $issuerList; ?></select>
						</div>
						<div class="col-md-6">
							<label class="invisible">Submit</label>
							<?php if($entranceCode!=''){?>
								<button type="submit" class="btn btn-default center-block" value="Continue" name="submitted"> Pay With iDEAL free / gratis | (Total : <?php echo CURR." ".$amount;?>)</button>
							
							<?php } ?>
						</div>

						
					</div>
				</div>
			</form>
		</div>
	</div>
	
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="media">
				<div class="media-left">(OR)</div>				
			</div>
			<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_xclick">

				<input type="hidden" name="business" value="'veeramani.tekhne@gmail.com">
				<input type="hidden" name="currency_code" value="<?php echo CURR;?>">

				<input type="hidden" name="image_url" width="150px" height="50px" value="<?php echo ASSETS; ?>images/logo.png">
				 <input type="hidden" name="cpp_cart_border_color"  value="d14836">
				 <input type="hidden" name="cpp_headerborder_color"  value="d14836">
				  <input type="hidden" name="cpp_headerback_color"  value="d14836">
				 <input type="hidden" name="cpp_header_image" width="150px" height="50px" value="<?php echo ASSETS; ?>images/logo.png">
				 <input type="hidden" name="cpp_logo_image" width="150px" height="50px" value="<?php echo ASSETS; ?>logo.png">
	 
				 <?php  $amount=(($amount/100)*3)+$amount;$amount=number_format($amount, 2, '.', ''); ?>
							
				<input type="hidden" name="item_name" value="<?php echo $description; ?>">
				<input type="hidden" name="amount" value="<?php echo $amount; ?>">
				<input type="hidden" name="shipping" value="0">

				<input type="hidden" name="handling" value="0">
				<!-- Specify URLs -->
		        <input type="hidden" name="notify_url" value="http://ticketfinder.nl/">
		        <input type='hidden' name='cancel_return' value="<?php echo WEB_FRONT_DIR.'dopayment/cancel';?>">
		        <input type='hidden' name='return' value='<?php echo $merchantReturnUrl ?>'>
					
				<input type="hidden" size="60" name="item_number" value="<?php echo $entranceCode; ?>">
				<input type="hidden" size="60" name="invoice" value="<?php echo $entranceCode; ?>">
				
				<div class="form-group">
					<div class="row">					
						<?php if($entranceCode!=''){?>
							<div  class="col-md-6">
								<label class="invisible">Submit</label>
								<img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/pp-acceptance-medium.png" alt="Buy now with PayPal" />
							</div>
							<div  class="col-md-6">
								<label class="invisible">Submit</label>
								<input type="submit" class="btn btn-default center-block" value="Pay With Paypal ( 3% Extra ) | (Total : <?php echo CURR." ".$amount;?>)" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
							</div>
						<?php } ?>						
					</div>
				</div>
			</form>
		</div>
	</div>

	<?php
		$sha1_pwd = 'TicketFinder123@';
        $params = array(
                'ACCEPTURL' => WEB_URL."/doPayment/success",
                'AMOUNT' => ($amount*100),
                'BACKURL' => current_url(),
                'BGCOLOR' => '#333',
                'BUTTONBGCOLOR' => '#FFD627',
                'BUTTONTXTCOLOR' => '#FFF',
                'CANCELURL' => WEB_URL."/doPayment/cancel",
               // 'CN' => 'veera',
                'CURRENCY' => 'EUR',
                'DECLINEURL' => WEB_URL."/doPayment/decline",
                'EMAIL' => 'veera@gmail.com',
                'EXCEPTIONURL' => WEB_URL."/doPayment/exception",
                 'FONTTYPE' => 'sans-serif',
                'LANGUAGE' => 'nl_NL',
                'LOGO' => 'https://secure.ogone.com/images/merchant/ReservationFactory/LOGO.png',
                'ORDERID' => $entranceCode,
                'PM' =>  'CreditCard',
                'PSPID' => 'tekhne',
                'TBLBGCOLOR' => '#FFF',
                'TBLTXTCOLOR' => '#66AFE9',
                'TITLE' => 'To Pay Ticketfinder',
                'TXTCOLOR' => '#FFF'
                
                );
            

        $sha1='';
		foreach ($params as $key => $value) 
		{	  
		    $sha1.=$key."=".$value.$sha1_pwd;  
		}
		$params['sha1']=sha1($sha1);	
	?>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="media">
				<div class="media-left">(OR)</div>				
			</div>
			<form method="post" action="https://secure.ogone.com/ncol/test/orderstandard.asp" id="form1" target="_top" name="form1">
				<!-- general parameters: see Form parameters -->

				<input type="hidden" name="ACCEPTURL" value="<?php echo $params['ACCEPTURL'];?>">
				<input type="hidden" name="AMOUNT" value="<?php echo $params['AMOUNT'];?>">
				 <input type="hidden" name="BACKURL" value="<?php echo $params['BACKURL'];?>">
				<input type="hidden" name="BGCOLOR" value="<?php echo $params['BGCOLOR'];?>">
				<input type="hidden" name="BUTTONBGCOLOR" value="<?php echo $params['BUTTONBGCOLOR'];?>">
				<input type="hidden" name="BUTTONTXTCOLOR" value="<?php echo $params['BUTTONTXTCOLOR'];?>">
				<input type="hidden" name="CANCELURL" value="<?php echo $params['CANCELURL'];?>">
				<!--<input type="hidden" name="CN" value="<?php echo $params['CN'];?>">-->
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

				<div class="form-group">
					<div class="row">							
						<?php if($entranceCode!=''){?>
							<div  class="col-md-6">
								<label class="invisible">Submit</label>
								<img src="../../assets/images/logo_ogone.png" alt="Buy now with ogone" />
							</div>
							<div  class="col-md-6">
								<label class="invisible">Submit</label>
								<input type="submit" id=submit1 name=submit1  class="btn btn-default center-block" value="Pay With Credit Card ( 3% Extra ) | (Total : <?php echo CURR." ".$amount;?>)" name="submit" alt="Make payments with Credit Card - free and secure!">
							</div>
						<?php } ?>					
					</div>
				</div>
			</form>
		</div>
	</div>	
	<?php } echo "at the end"; ?>


</body>
</html>