<style type="text/css">
    .rating .fa fa-star-half {
    color: #F90;
}
</style>


<!--######## HOTEL LIST DISPLAY STARTS ##############-->
<?php  if (isset($result) && is_array($result)) { ?>
    <?php
    $i = 0;
 
    foreach ($result as $list) {
      if($searchData['trip_type']==2){
       // if(isset($list['return']) && isset($list['oneway'])){
         $list_reurn=$list['return'];
          $list=$list['oneway'];
        /*}else{
          unset($list);
        }*/
       
      }
         if(!empty($list)){
        if($list['VehicleType']!=''){
           $VehicleType[] =$list['VehicleType'];
        }
          
        ?>

 <div class="searchhotel_box" >

 <div class="col-md-12 pad_0 strip_all_tour_list wow fadeIn HotelInfoBox searchHotel" data-wow-delay="0.1s" data-price="" data-place-name="<?php echo($list['MasterProductType'] != '' ? $list['MasterProductType'] : '-'); ?>" data-class-name="<?php echo($list['VehicleType'] != '' ? $list['VehicleType'] : '-'); ?>" >

   

                        <div class="col-md-4 pad_0">


  <?php if (isset($list['Image']) && $list['Image'] != '') { ?>
                                    <img class="lazy" src="<?php echo str_replace('small', 'large', $list['Image'][0]); ?>" alt="<?php echo $list['transferType']; ?>">
                                <?php } else { ?>
                                    <img class="lazy" data-original="<?php echo base_url(); ?>assets/img/no_image.png" alt="<?php echo $list['transferType']; ?>">
                                <?php } ?>

                           

                        </div>

                        <div class="col-md-8">

                            <h4><?php echo $list['MasterServiceType']; ?> /<?php echo isset($list['MasterProductType'])?$list['MasterProductType']:''; ?> / <?php echo trim($list['MasterVehicleType']); ?></h4>
                          
                            

                           


                            <div class="row">

                                <div class="col-md-12">

                                    <p>Maximum Waiting Time (Domestic) <span style="font-size:12px;"><?php echo $list['Domestic_waiting']['@attributes']['time']." ".$list['Domestic_waiting']['@content'];?></span></p>

                                    <p>Maximum Waiting Time (International) <span style="font-size:12px;"><?php echo $list['International_waiting']['@attributes']['time']." ".$list['International_waiting']['@content'];?></span></p>

                                </div>






                                

                            </div> 

                           
 <div class="col-md-12 pad_0">
   <p><?php echo $list['TransferPickupInformation'];?></p>
 </div>

  <div class="col-md-12 pad_0">
    <b>Onward</b>
   <p><?php echo $list['PickupLocation']['Name'];?> (<?php echo $list['PickupLocation']['Code'];?>) -> <?php echo $list['DestinationLocation']['Name'];?> (<?php echo $list['DestinationLocation']['Code'];?>)</p>
   
 <?php  if($searchData['trip_type']==2){ ?>
  <b>Return</b>
   <p><?php echo $list_reurn['PickupLocation']['Name'];?> (<?php echo $list_reurn['PickupLocation']['Code'];?>) -> <?php echo $list_reurn['DestinationLocation']['Name'];?> (<?php echo $list_reurn['DestinationLocation']['Code'];?>)</p>
    <?php } ?>
 </div>
                           

                            
                        </div>


                        <?php $CancellationPolicy=($list['CancellationPolicy']); if(!empty($CancellationPolicy)){?>  
                            <div class="col-md-12 pad_0">

                               
                 


<?php  foreach ($CancellationPolicy as $key => $CancellationPolicyval) { ?>
    <p>Cancellation : <?php echo $list['Currency'].$CancellationPolicyval['amount']." ".$CancellationPolicyval['dateFrom']." ".$CancellationPolicyval['time'];?></p>
<?php } ?>      
                             

                            </div>
                              <?php } ?>


                      
<div class="col-md-12 pad_left0">
<p class="text-center"><span ><?php echo $list['Currency'].($list['TotalAmount']+$list_reurn['TotalAmount']);?></span>
  <a class="btn btn-primary btn-lg btl" target="_blank" href="<?php echo site_url(); ?>/car/details/<?php echo $i; ?>">Select</a>
</p>

</div>

<?php $Description=($list['Description']); if(!empty($Description)){?>  
                            <div class="col-md-12 pad_0">

                                <ul class=" execut">
                 


<?php  foreach ($Description as $key => $Descriptionval) { ?>
    <li><?php echo $Descriptionval['content'];?></li>
<?php } ?>      
                                </ul>

                            </div>
                              <?php } ?>

                        

                    </div>

                    <div class="col-md-12 pad_0">

                        <hr>

                    </div>

</div>
        <?php $i++;
    } } ?>
<input type="hidden" id="setMinPrice" value="<?php if(!empty($hototalPriceAry)) echo min($hototalPriceAry); else echo 0; ?>" />
<input type="hidden" id="setMaxPrice" value="<?php if(!empty($hototalPriceAry)) echo max($hototalPriceAry); else echo 0; ?>" />
<input type="hidden" id="setCurrency" value="<?php echo '$';?>" />


<?php  $VehicleType = array_unique($VehicleType);sort($VehicleType);
 //Creating Unique VehicleType 
} else { ?>
    <div>NO HOTELS FOUND</div>
<?php } ?>


<?php
echo '<div id="errorMessage" style="text-align:center;display:none;" class="no_available removel">
<h1>There are no flights available. </h1>
<br><br>
<div class="no_available_text">Sorry, we have no prices for tickets in this date range matching your criteria. One or more of your preferences may be affecting the number of exact matches found. Try searching again with a wider search criteria. <br></div>
    </div>'; // Error Message
    ?>

<script type="text/javascript">
  $("select[name='OperationDateList']").on('change', function(){

     $(this).closest('td').next('td').find('input').val($(this).val());

    
  });
 

 $('#VehicleType p:last').after('<?php $i=1;foreach($VehicleType as $class){?><div class="checkbox"><label for="class<?php echo rand();?>"><input checked class="class" name="class" type="checkbox" id="class<?php echo rand();?>" value="<?php echo $class;?>" /><p><?php echo $class;?></p></label></div><?php $i++; }?>  <hr>');



 var $filters = $("input:checkbox[name='class']"); // start all checked
var $categoryContent = $('div#search_result div.searchhotel_box'); // Path for flights
var $errorMessage = $('#errorMessage'); //Error Message
$filters.on('click', function(event){
  $categoryContent.hide(); // if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
  var $selectedFilters = $filters.filter(':checked');
  if ($selectedFilters.length > 0) {
    $errorMessage.hide();
$selectedFilters.each(function (i, el) {
$('div#search_result div.HotelInfoBox[data-class-name="'+ el.value +'"]').parents(".searchhotel_box").show();

});
  } else {
  $errorMessage.show();
  }
});

</script>
<!--######## HOTEL LIST DISPLAY ENDS ################-->


