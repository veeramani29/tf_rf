<?php
    $cars_data = base64_encode(json_encode($cars)); // For reference
    $request = base64_encode(json_encode($request)); // request For reference
    //$flights_data = json_decode(base64_decode($flights_data));
    //echo'<pre>'; print_r($flights_data);die; 
    $cars = json_decode(json_encode($cars));
    $i=0;
    //echo'<pre>'; print_r($flights);die; 
    foreach($cars as $car){
    $car_data = base64_encode(json_encode($car));
    $VehicleMediaRes = VehicleMediaReq($car);
    $VehicleMediaRes = $this->xml_to_array->XmlToArray($VehicleMediaRes);
    if(!isset($VehicleMediaRes['SOAP:Body']['SOAP:Fault']) && $VehicleMediaRes != ''){
        $image = $VehicleMediaRes['SOAP:Body']['vehicle:VehicleMediaLinksRsp']['vehicle:VehicleWithMediaItems']['common_v28_0:MediaItem']['@attributes']['url'];
    }else{
        $image = ASSETS.'images/car1.jpeg';
    }
    $Transmission[] = $car->TransmissionType;
    $VehicleClass[] = $car->VehicleClass;
    $VendorCode[] = $car->VendorCode;
?>
<li class="cardisli" data-price="<?php echo $this->account_model->currency_convertor($car->TotalPrice);?>" data-vendor="<?php echo $car->VendorCode;?>" data-equipment="<?php echo $car->TransmissionType;?>" data-vehicleclass="<?php echo $car->VehicleClass;?>">
    <div class="celcar">
        <div class="col-md-2 nopad carcel">
            <div class="inerpad">
                <div class="clascar"><?php echo $car->VehicleClass;?></div>
                <div class="carimagecomny">
                    <!-- <img src="<?php echo ASSETS;?>images/comp1.jpg" alt="" /> -->
                    <img src="http://demo.travelportuniversalapi.com/Content/img/car/<?php echo $car->VendorCode;?>.gif" alt="" />
                </div>
            </div>
        </div>
       
        <div class="col-md-2 nopad carcel">
            <div class="inerpad">
                <div class="carimage">
                    <img src="<?php echo $image;?>" id="CC<?php echo str_replace('.', '', $car->TotalPrice).$i;?>" alt="" />
                </div>
            </div>
        </div>
        
        <div class="col-md-4 nopad carcel">
            <div class="inerpad">
                <!-- <div id="dynamix" class="clascartwo">Tata Indica or similar</div> -->
                <div class="clascartwo"><?php echo $car->Location;?></div>
                <div class="icononlycar">
                    <!-- <a class="iconwithdes tooltipp" title="Passenger">
                        <span class="aicon psnger"></span>
                        <strong>4</strong>
                    </a>
                    <a class="iconwithdes tooltipp" title="Baggage">
                        <span class="aicon baggage"></span>
                        <strong>3</strong>
                    </a> -->
                    <a class="iconwithdes tooltipp" title="Doors">
                        <span class="aicon doors"></span>
                        <strong><?php echo $car->DoorCount;?></strong>
                    </a>
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
            </div>
        </div>
        
        <div class="col-md-2 nopad carcel">
            <div class="inerpad">
                <div class="clascarthree">Estimated Total</div>
                <div class="pricecarr"><span class="curr_icon"><?php echo $this->display_icon;?></span><span class="amount"><?php echo $this->account_model->currency_convertor($car->TotalPrice);?></span><!-- <strong>per day</strong> --></div>
                <div class="cartotalprice">Base Price <span class="curr_icon"><?php echo $this->display_icon;?></span> <span class="amount"><?php echo $this->account_model->currency_convertor($car->BasePrice);?></span></div>
                <form name="cardetail<?php echo $i;?>" id="CD<?php echo str_replace('.', '', $car->TotalPrice).$i;?>" action="<?php echo WEB_URL;?>">
                    <input type="hidden" name="temp_d" value="<?php echo $car_data;?>" required/>
                    <input type="hidden" name="temp_r" value="<?php echo $request;?>" required/>
                    <a class="onreqst" data-attr="CD<?php echo str_replace('.', '', $car->TotalPrice).$i;?>">View Details</a>
                </form>
            </div>
        </div>
        
        <div class="col-md-2 nopad carcel">
            <div class="inerpad">
             <form name="carbook<?php echo $i;?>" id="C<?php echo str_replace('.', '', $car->TotalPrice).$i;?>" action="<?php echo WEB_URL;?>">
                <input type="hidden" name="temp_d" value="<?php echo $car_data;?>" required/>
                <input type="hidden" name="temp_r" value="<?php echo $request;?>" required/>
                <input type="hidden" name="temp_i" value="<?php echo $image;?>" required/>
                <a class="carbook CarbookNow" data-attr="C<?php echo str_replace('.', '', $car->TotalPrice).$i;?>">Book Car</a>
            </form>
            </div>
        </div>
    </div>   
</li>

<?php }?>
<?php 
    echo '<div id="errorMessage" style="text-align:center;display:none;" class="no_available">
    <h1>There are no cars available. </h1>
    <br><br>
    <div class="no_available_text">Sorry, we have no prices for cars in this date range matching your criteria. One or more of your preferences may be affecting the number of exact matches found. Try searching again with a wider search criteria. <br></div>
    </div>'; // Error Message
?>
<?php $Transmission = array_unique($Transmission); //Creating Unique Transmission?>
<?php $VehicleClass = array_unique($VehicleClass); //Creating Unique VehicleClass?>
<?php $VendorCode = array_unique($VendorCode); //Creating Unique VendorCode?>
<script>
$('#cargroup').addClass('in');
$('#GroupFilter').html('<?php $i=1;foreach($VehicleClass as $class){?><li class="cheklist"><label for="class<?php echo $i;?>"><div class="left"><input class="filtchk serch-blue vehicleclass" name="vehicleclass" type="checkbox" id="class<?php echo $i;?>" value="<?php echo $class;?>" checked/></div><span class="cheklabl"><?php echo $class;?></span><label></li><?php $i++; }?>');       
var $filters = $("input:checkbox[name='vehicleclass']"); // start all checked
var $categoryContent = $('ul.cars li'); // Path for cars
var $errorMessage = $('#errorMessage'); //Error Message
//$filters.click(function() {
$filters.on('ifChanged', function(event){
  $categoryContent.hide(); // if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
  var $selectedFilters = $filters.filter(':checked');
  //console.log($selectedFilters);
  if ($selectedFilters.length > 0) {
    $errorMessage.hide();
    $selectedFilters.each(function (i, el) {
      $('ul.cars li[data-vehicleclass="'+ el.value +'"]').show();
    });
  } else {
      $errorMessage.show();
  }
});
$('#equipment').addClass('in');
$('#EquipmentFilter').html('<?php $i=1;foreach($Transmission as $equipment){?><li class="cheklist"><label for="equipment<?php echo $i;?>"><div class="left"><input class="filtchk serch-blue equipment" name="equipment" type="checkbox" id="equipment<?php echo $i;?>" value="<?php echo $equipment;?>" checked/></div><span class="cheklabl"><?php echo $equipment;?></span><label></li><?php $i++; }?>');
var $filters1 = $("input:checkbox[name='equipment']"); // start all checked
var $categoryContent1 = $('ul.cars li'); // Path for cars
var $errorMessage = $('#errorMessage'); //Error Message
$filters1.on('ifChanged', function(event){
  $categoryContent1.hide(); // if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
  var $selectedFilters1 = $filters1.filter(':checked');
  //console.log($selectedFilters);
  if ($selectedFilters1.length > 0) {
    $errorMessage.hide();
    $selectedFilters1.each(function (i, el) {
      $('ul.cars li[data-equipment="'+ el.value +'"]').show();
    });
  } else {
      $errorMessage.show();
  }
});
$('#vendor').addClass('in');
$('#VendorFilter').html('<?php $i=1;foreach($VendorCode as $vendor){?><li class="cheklist"><label for="vendor<?php echo $i;?>"><div class="left"><input class="filtchk serch-blue vendor" name="vendor" type="checkbox" id="vendor<?php echo $i;?>" value="<?php echo $vendor;?>" checked/></div><span class="cheklabl"><?php echo $this->car_model->get_vendor_details($vendor);?></span><label></li><?php $i++; }?>');
var $filters2 = $("input:checkbox[name='vendor']"); // start all checked
var $categoryContent2 = $('ul.cars li'); // Path for cars
var $errorMessage = $('#errorMessage'); //Error Message
$filters2.on('ifChanged', function(event){
  $categoryContent2.hide(); // if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
  var $selectedFilters2 = $filters2.filter(':checked');
  //console.log($selectedFilters);
  if ($selectedFilters2.length > 0) {
    $errorMessage.hide();
    $selectedFilters2.each(function (i, el) {
      $('ul.cars li[data-vendor="'+ el.value +'"]').show();
    });
  } else {
      $errorMessage.show();
  }
});
$('input.serch-blue').iCheck({
    checkboxClass: 'icheckbox_flat-blue',
    radioClass: 'iradio_flat'
});
</script>