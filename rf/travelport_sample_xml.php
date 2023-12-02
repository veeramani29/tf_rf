<?php 
$api['target_branch'] = 'P7003720';	//target_branch
$api['username'] = 'Universal API/uAPI9148913608-5226b928';	//username
$api['password'] = '5Li_Y{8z&6';	//password
$api['provider_code'] = '1G';	//provider_code
$api['pseudo_city_code'] = '';	//pseudo_city_code
$api['schema_version'] = '_v29_0';	//pseudo_city_code
$api['credentials'] = $api['username'].":".$api['password'];	//frame the credentials   
$api['end_url'] = 'https://apac.universal-api.pp.travelport.com/B2BGateway/connect/uAPI/VehicleService';

$AirCreatReservation = '<?xml version="1.0"?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
  <soapenv:Header/>
  <soapenv:Body>
    <hot:HotelSearchAvailabilityReq xmlns:hot="http://www.travelport.com/schema/hotel_v33_0" AuthorizedBy="user" TraceId="trace" TargetBranch="P7003720">
      <com:BillingPointOfSaleInfo xmlns:com="http://www.travelport.com/schema/common_v33_0" OriginApplication="UAPI"/>
      <com:OverridePCC xmlns:com="http://www.travelport.com/schema/common_v33_0" ProviderCode="1G" PseudoCityCode="6I90"/>
      <hot:HotelSearchLocation>
        <hot:HotelLocation Location="AMS"/>
        <!--<com:Distance Direction="N" Units="MI" Value="5"/>-->
      </hot:HotelSearchLocation>
      <hot:HotelSearchModifiers AvailableHotelsOnly="true" ReturnPropertyDescription="true" NumberOfAdults="3" NumberOfRooms="1" PreferredCurrency="EUR">
        <com:PermittedProviders xmlns:com="http://www.travelport.com/schema/common_v33_0">
          <com:Provider Code="1G"/>
        </com:PermittedProviders>
        <hot:HotelRating RatingProvider="NTM">
          <hot:RatingRange MinimumRating="1" MaximumRating="5"/>
        </hot:HotelRating>
        <hot:HotelRating RatingProvider="AAA">
          <hot:RatingRange MaximumRating="5" MinimumRating="1"/>
        </hot:HotelRating>
        <!--<hot:HotelPaymentType>PostPay</hot:HotelPaymentType>-->
        <hot:NumberOfChildren Count="3">
          <hot:Age>10</hot:Age>
          <hot:Age>10</hot:Age>
          <hot:Age>10</hot:Age>
        </hot:NumberOfChildren>
      </hot:HotelSearchModifiers>
      <hot:HotelStay>
        <hot:CheckinDate>2016-11-11</hot:CheckinDate>
        <hot:CheckoutDate>2016-11-11</hot:CheckoutDate>
      </hot:HotelStay>
    </hot:HotelSearchAvailabilityReq>
  </soapenv:Body>
</soapenv:Envelope>';

	 $request = $AirCreatReservation;
	$CREDENTIALS = $api['credentials'];
	$auth = base64_encode("$CREDENTIALS"); 
	$soapAction = "";
	$UApi_URL='https://twsprofiler.travelport.com/Service/Default.ashx/HotelService';
	$header = array( 
	"Connection:close",
	"Content-length: ".strlen($request),
	"Content-Type: text/xml;charset=UTF-8", 
	"Accept-Encoding: gzip,deflate",
	"Authorization: Basic $auth",
	"SOAPAction: {$soapAction}"
	); 
	$soap_do = curl_init();
	curl_setopt($soap_do, CURLOPT_URL, $UApi_URL);
	curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);
	curl_setopt($soap_do, CURLOPT_TIMEOUT, 180);
	curl_setopt($soap_do, CURLOPT_HEADER,true);
	curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($soap_do, CURLOPT_POST, 1);
	curl_setopt($soap_do, CURLOPT_POSTFIELDS, $request);
	curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($soap_do, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($soap_do, CURLOPT_ENCODING, "gzip,deflate");
	$response = curl_exec($soap_do);
	$error = curl_getinfo($soap_do, CURLINFO_HEADER_OUT);
	echo $error;
	curl_close($soap_do);
	echo "<pre>Request: "; print_r($request);
	echo "<pre> Response: "; print_r($response);exit;

?>
