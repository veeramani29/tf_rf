<?php

$cars_data = base64_encode(json_encode($cars)); // For reference
$request = $request; // request For reference
$cars = json_decode(json_encode($cars));
$i=0;
foreach($cars as $car){
  $car_data = base64_encode(json_encode($car));
  $VehicleMediaRes = VehicleMediaReq($car);
  $VehicleMediaRes = $this->xml_to_array->XmlToArray($VehicleMediaRes);
  if(!isset($VehicleMediaRes['SOAP:Body']['SOAP:Fault']) && $VehicleMediaRes != ''){
    if(isset($VehicleMediaRes['SOAP:Body']['vehicle:VehicleMediaLinksRsp'])){
      $image = $VehicleMediaRes['SOAP:Body']['vehicle:VehicleMediaLinksRsp']['vehicle:VehicleWithMediaItems']['common_v31_0:MediaItem']['@attributes']['url'];
    }
  }else{
    $image = ASSETS.'images/car1.jpeg';
  }
  if($car->TotalPrice!=''){
    $Transmission[] = $car->TransmissionType;
  }
  if($car->TotalPrice!=''){
    $VehicleClass[] = $car->VehicleClass;
  }
  if($car->TotalPrice!=''){
    $Category[] = $car->Category;
  }
  if($car->TotalPrice!=''){
    $DoorCount[] = $car->DoorCount;
  }
  if($car->TotalPrice!=''){
    $VendorCode[] = $car->VendorCode;
  }
  if($car->TotalPrice!=''){
    $price[]=$this->account_model->currency_convertor($car->TotalPrice);
  }
  ?>
  <li class="col-sm-12 fs_singleflight  scroll vehicleInfoBox" data-price="<?php echo $this->account_model->currency_convertor($car->TotalPrice);?>" data-category="<?php echo $car->Category;?>" data-door="<?php echo $car->DoorCount;?>" data-vendor="<?php echo $car->VendorCode;?>" data-trans="<?php echo $car->TransmissionType;?>" data-vehicleclass="<?php echo $car->VehicleClass;?>">
    <ul class="list-inline hotel_singlehdetails hotel_searchdetails car_searchdetails">
      <li  class="hs_image car_image">
        <div class="carimage_container">
          <?php echo $this->car_model->get_vendor_details($car->VendorCode);?> <?php echo $car->Category;?>
          <img src="<?php echo $image;?>" id="CC<?php echo str_replace('.', '', $car->TotalPrice).$i;?>" alt="Car Image" />
        </div>
      </li>
      <li class="fs_airlinecontainer fsa_departure hotel_singlehdeparture car_performance">
        <ul class="hotelpreferences carpreferences allamn list-unstyled">
          <?php  if($car->DoorCount){?>
          <li class="iconwithdes tooltipp" title="<?php echo $car->DoorCount;?>">
            <div class="doors">
              <div class="hideshown_svg">
                <img src="<?php echo ASSETS."images/svg/DOORS.svg";?>" alt="">
                <img src="<?php echo ASSETS."images/svg/DOORS-b.svg";?>" alt="">
              </div>
            </div>
            <div class="carp_count"><?php echo isset($car->Policy->NumberOfDoors)?$car->Policy->NumberOfDoors:'N/A';?></div>
          </li>
          <?php } if($car->AirConditioning){ ?>
          <li class="iconwithdes tooltipp" title="Air Conditioned">
            <div class="aircond">
              <div class="hideshown_svg">
                <img src="<?php echo ASSETS."images/svg/SNOW.svg";?>" alt="">
                <img src="<?php echo ASSETS."images/svg/SNOW-b.svg";?>" alt="">
              </div>
            </div>
            <div class="carp_count">AC</div>
          </li>
          <?php }?>
          <li class="iconwithdes tooltipp" title="<?php echo $car->TransmissionType;?>">
            <div class="manualtrans">
              <div class="hideshown_svg">
                <img src="<?php echo ASSETS."images/svg/MANUAL.svg";?>" alt="">
                <img src="<?php echo ASSETS."images/svg/MANUAL-b.svg";?>" alt="">
              </div>
            </div>
            <div class="carp_count"><?php echo substr($car->TransmissionType,0,4);?></div>
          </li>
          <?php if(isset($car->Policy->PassengerCount)){?>
          <li class="iconwithdes tooltipp" title="Passengers">
            <div class="fuel">
              <div class="hideshown_svg">
                <img src="<?php echo ASSETS."images/svg/PERSON.svg";?>" alt="">
                <img src="<?php echo ASSETS."images/svg/PERSON-b.svg";?>" alt="">
              </div>
            </div>
            <div class="carp_count"><?php echo isset($car->Policy->PassengerCount)?$car->Policy->PassengerCount:'N/A';?></div>
          </li>
          <?php }?>
          <li class="iconwithdes tooltipp" title="Luggage">
            <div class="fuel">
              <div class="hideshown_svg">
                <img src="<?php echo ASSETS."images/svg/CASE.svg";?>" alt="">
                <img src="<?php echo ASSETS."images/svg/CASE-b.svg";?>" alt="">
              </div>
            </div>
            <div class="carp_count">
              <?php echo isset($car->Policy->BagCount)?$car->Policy->BagCount:'N/A';?>
            </div>
          </li>
        </ul>
      </li>
      <li class="csr_incluprice">
        <ul class="list-inline">
          <li class="full_width"><h5><?php echo lang_line('Included_in_the_price'); ?></h5></li>
          <?php if(isset($car->UnlimitedMileage)){?>
          <li class="col-sm-6 nopadd"><i class="fa fa-check-circle"></i> <?php echo lang_line('Unlimited_Mileage'); ?></li>
          <?php }?>
          <?php if(is_array($car->rules)){  foreach ($car->IncludedItems as $items) { ?>
          <li class="col-sm-6 nopadd"><i class="fa fa-check-circle"></i> <?php echo $items;?></li>
          <?php } } ?>
          <?php if(is_array($car->rules)){ foreach ($car->rules as $rules) {  ?>
          <li class="col-sm-6 nopadd"><i class="fa fa-check-circle"></i> <?php echo $rules->Category;?> (<?php echo $rules->Name;?>)</li>
          <?php } } ?>
        </ul>
      </li>
      <li class="fs_airlinecontainer fs_book hotel_singlehbook car_singlehbook">
        <div class="fs_airline">
          <div class="fs_values">
            <div class="col-sm-12 nopadd">
              <span class="fsa_airlinename ">  
                <span class="curr_icon"><?php echo $this->display_icon;?></span>
                <span class="amount"><?php echo $this->account_model->currency_convertor($car->TotalPrice);?></span> 
                <div class="fsaa_wamount"><?php echo lang_line('Estimated_Total'); ?></div>
              </span> 
              <form target="_blank" name="carbook" id="C<?php echo str_replace('.', '', $car->TotalPrice).$i;?>" method="post" action="<?php echo WEB_URL."/car/AddToCart";?>">
                <input type="hidden" name="temp_d" value="<?php echo $car_data;?>" required/>
                <input type="hidden" name="temp_r" value="<?php echo $request;?>" required/>
                <input type="hidden" name="temp_i" value="<?php echo $image;?>" required/>
                <button type="submit" class="btn btn-primary btn_inputs">
                  <?php echo lang_line('PAY_NOW');?>
                </button>
              </form>
            </div>
            <div class="spacer20"></div>
          </div>
        </div>
      </li>
    </ul>
  </li>
  <?php }
  $Transmission = array_unique($Transmission); //Creating Unique Transmission
  $VehicleClass = array_unique($VehicleClass); //Creating Unique VehicleClass
  $VendorCode = array_unique($VendorCode); //Creating Unique VendorCode
  $Category = array_unique($Category); //Creating Unique Category
  $DoorCount = array_unique($DoorCount); //Creating Unique DoorCount
  ?>
  <?php
  echo '<div id="errorMessage" style="text-align:center;display:none;" class="no_available">
  <h1>'.lang_line('CAR_NOT_AVAIL').'</h1>
  <br><br>
  <div class="no_available_text">'.lang_line('CAR_NOT_AVAIL_MSG').'<br></div>
  </div>'; 
  ?>
  <script class="remove" type="text/javascript">
  <?php if($req->MinPrice!='' && $req->MaxPrice!=''){ ?>
    showFlights(<?php echo $req->MinPrice;?>, <?php echo $req->MaxPrice;?>);
    <?php } ?>
    function showFlights(minPrice, maxPrice) {
      $("ul.vehicles li.vehicleInfoBox").hide().filter(function() {
        var price = $(this).find("span.amount").html();
        var price = parseFloat(price);
        console.log(price+' >= '+minPrice+' && '+price+' <= '+maxPrice);
        return price >= minPrice && price <= maxPrice;
      }).show();
    }
    $(function() {
    //price filter
    $( "#price-filter" ).slider({
      range: true,
      min: <?php echo $this->account_model->currency_convertor(min($price))?>,
      max: <?php echo $this->account_model->currency_convertor(max($price))?>,
      values: [ <?php echo $this->account_model->currency_convertor(min($price))?>, <?php echo $this->account_model->currency_convertor(max($price))?> ],
      slide: function( event, ui ) {
        $('#min_price').text(CURR_ICON+ $( "#price-filter" ).slider( "values", 0 ));
        $('#max_price').text(CURR_ICON+ $( "#price-filter" ).slider( "values", 1 ) );
      },
      change: function( event, ui ) {
        one=ui.values[0];
        two=ui.values[1];
        showFlights(one, two);
      }
    });
    $('#min_price').text(CURR_ICON+ $( "#price-filter" ).slider( "values", 0 ));
    $('#max_price').text(CURR_ICON+ $( "#price-filter" ).slider( "values", 1 ) );
    var $filters = $("#Car_Category,#Transmission,#Door_Count,#Vehicle_Class"); // start all checked
    var $categoryContent = $('ul.vehicles li.vehicleInfoBox'); // Path for flights
    var $errorMessage = $('#errorMessage'); //Error Message
    $filters.on('change', function(){
    $categoryContent.hide(); // if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
    var $get_value = $(this).val();
    var $get_attr = $(this).attr("data");
    var $selectedFilters = $get_value;
    if ($selectedFilters=='All' || $selectedFilters=='') {
      $errorMessage.hide();
      $('ul.vehicles li.vehicleInfoBox').show();
    }else if($selectedFilters!='All' && $selectedFilters!=''){
      $errorMessage.hide();
      $('ul.vehicles li.vehicleInfoBox[data-'+$get_attr+'="'+ $selectedFilters +'"]').show();
    }
  });
    $('#Vehicle_Class option:last').after("<?php $i=1;foreach($VehicleClass as $class){?><option value='<?php echo $class;?>' ><?php  echo stripslashes($class);  ?></option><?php $i++; }?>");       
    $('#Transmission option:last').after("<?php $i=1;foreach($Transmission as $txn){?><option value='<?php echo $txn;?>' ><?php  echo stripslashes($txn); ?> </option><?php $i++; }?>");

    $('#Door_Count option:last').after("<?php $i=1;foreach($DoorCount as $DoorCount){ if($DoorCount!=''){?><option value='<?php echo $DoorCount;?>' ><?php  echo stripslashes($DoorCount); ?> </option><?php $i++; } }?>");
    $('#Car_Category option:last').after("<?php $i=1;foreach($Category as $cat){?><option value='<?php echo $cat;?>' ><?php  echo stripslashes($cat); ?> </option><?php $i++; }?>");
  });
</script>