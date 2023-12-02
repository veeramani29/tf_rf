<?php 


$url = "http://testph.via.com/apiv2/flight/review";
 $postData = '{
 
     "keys": ["08183748557104929567515@@O_$38_MNL_CEB_763_158_06:00__A1_0_0"],
  "isSSRReq" : "true",
   "isExReq" : "true"
}'; 





$curlConnection = curl_init();
#,"Via-Access-Token: c51b5435-cec6-4de2-b133-4t9e3s12ta02"
curl_setopt($curlConnection, CURLOPT_HTTPHEADER, array( "Content-Encoding: UTF-8","Content-Type: application/json","Via-Access-Token: c51b5435-cec6-4de2-b133-4t9e3s12ta02"));
curl_setopt($curlConnection, CURLOPT_URL, $url);
 #curl_setopt($curlConnection, CURLOPT_TIMEOUT, 180);
curl_setopt($curlConnection, CURLOPT_POST, TRUE);
 #curl_setopt($curlConnection, CURLOPT_RETURNTRANSFER, 1);
 #curl_setopt($curlConnection, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($curlConnection, CURLOPT_POSTFIELDS, $postData);
curl_setopt($curlConnection, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($curlConnection, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curlConnection, CURLOPT_SSL_VERIFYPEER, FALSE);

 $results = curl_exec($curlConnection);
echo "<pre>";
print_r(json_decode($results, true));

 echo $error = curl_getinfo($curlConnection, CURLINFO_HTTP_CODE);
    curl_close($curlConnection);

die;

?>