<?php 
$VehicleMediaRes = VehicleMediaReq($car);
$VehicleMediaRes = $this->xml_to_array->XmlToArray($VehicleMediaRes);
if(!isset($VehicleMediaRes['SOAP:Body']['SOAP:Fault'])){
    $image = $VehicleMediaRes['SOAP:Body']['vehicle:VehicleMediaLinksRsp']['vehicle:VehicleWithMediaItems']['common_v28_0:MediaItem']['@attributes']['url'];
}else{
    $image = ASSETS.'images/car1.jpeg';
}

$VehicleKeywordRes = VehicleKeywordReq($car,$request,'list');
//echo $VehicleKeywordRes;
$VehicleKeywordRes = str_replace('SOAP:','',$VehicleKeywordRes);
$VehicleKeywordRes = str_replace('vehicle:','',$VehicleKeywordRes);
$VehicleKeywordRes = str_replace('common_v28_0:Keyword','Keyword',$VehicleKeywordRes);
$VehicleKeywordRes = new SimpleXMLElement($VehicleKeywordRes);
if(isset($VehicleKeywordRes->Body->VehicleKeywordRsp)){
    $KeywordList = $VehicleKeywordRes->Body->VehicleKeywordRsp->Keyword;
    $KeywordLists = '';
    $i=1;
    foreach ($KeywordList as $key => $Keyword) {
      if($i<=2){
        $KeywordLists .= str_replace('Keyword','com:Keyword',$Keyword->asXML());
      }
      $i++;
    }
    //unset($KeywordList->VehicleKeywordRsp);
    $KeywordList_xml =  $KeywordLists;
    $VehicleKeywordRes = VehicleKeywordReq($car,$request,'inf',$KeywordList_xml);
    // header("Content-type: text/xml");
    // print_r($VehicleKeywordRes);die;
    $VehicleKeywordRes  = $this->xml_to_array->XmlToArray($VehicleKeywordRes);
    if(!isset($VehicleKeywordRes['SOAP:Body']['SOAP:Fault']) && $VehicleKeywordRes != ''){
        $keywords = $VehicleKeywordRes['SOAP:Body']['vehicle:VehicleKeywordRsp']['common_v28_0:Keyword'];
    }
}else{
  $keywords = '';
}

?>
<div class="col-md-6 nopad">
	<div class="wrappopimg">
      <div class="popcarhed"><?php echo $car->Location;?></div>
      <div class="popcarimg"><img src="<?php echo $image;?>" alt="" /></div>
      <div class="popcarprice"><span class="curr_icon"><?php echo $this->display_icon;?></span><span class="amount"><?php echo $this->account_model->currency_convertor($car->TotalPrice);?></span><strong></strong></div>
  </div>
</div>
      
<div class="col-md-6 nopad">
	<div class="icononlycar">
      <!-- <a class="iconwithdes tooltipp" title="Passenger">
          <span class="aicon psnger"></span>
          <strong>4</strong>
      </a>
      <a class="iconwithdes tooltipp" title="Baggage">
          <span class="aicon baggage"></span>
          <strong>3</strong>
      </a> -->
       <?php if($car->DoorCount){?>
      <a class="iconwithdes tooltipp" title="Doors">
          <span class="aicon doors"></span>
        
      </a>
       <?php }?>
      <?php if($car->AirConditioning){?>
      <a class="iconwithdes tooltipp" title="Air Conditioned">
          <span class="aicon aircond"></span>
      </a>
      <?php }?>
      <a class="iconwithdes tooltipp" title="<?php echo $car->TransmissionType;?>">
          <span class="aicon manualtrans"></span>
      </a>
      <?php if(isset($car->UnlimitedMileage)){?>
      <a class="iconwithdes tooltipp" title="Fuel: UnlimitedMileage">
          <span class="aicon fuel"></span>
      </a>
      <?php }?>
  </div>

  <div class="clear"></div>
        
  <div class="detailspsn">
  	<?php if($car->DoorCount != ''){echo $car->DoorCount.',';}?> <?php if($car->AirConditioning){?>Air Conditioning<?php }?>, <?php echo $car->VehicleClass;?>, <?php if($car->VehicleRateDescription != ''){echo $car->VehicleRateDescription;}?>
  </div>
</div>
<div class="clear"></div>
<div class="linebrkpop"></div>
<div class="clear"></div>
      
<div class="carscroll">
<?php 
if(!empty($keywords)){foreach ($keywords as $key => $keyword) {
$Name = $keyword['@attributes']['Name'];
$Description = $keyword['@attributes']['Description'];
$Number = $keyword['@attributes']['Number'];
?>
  <div class="parapop">
  <?php if(isset($keyword['common_v28_0:Text'])){?>
  	<h4 class="smlpopl"><?php echo $Name;?> (<?php echo $Description;?>)</h4>
    <p>
    <?php 
      foreach ($keyword['common_v28_0:Text'] as $key => $Text) {
        echo $Text.' ';
      }
    ?>
    </p>
    <?php }?>
  </div>
<?php }}?> 
  <div class="clear"></div>
  <div class="popupnotes">
  	The car displayed and models listed are the most common car used by our car rental partners. We cannot guarantee the make or model of the rental car. The purpose of the image and list is to provide a sample only. Please note the luggage capacity varies from make and model and may be reduced once the vehicle is at its full seating capacity. 
  </div>
</div>