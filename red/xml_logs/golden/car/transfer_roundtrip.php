<!--######## HOTEL LIST DISPLAY STARTS ##############-->
<?php  if (isset($result) && is_array($result)) { ?>
    <?php
   
 

      
      
          $list_return=$result['return'];
          $list_onward=$result['oneway'];
       #echo "<pre>";print_r($list_oneway);
       
    
        
      
          
        ?>

                <div class="rightcontent col-md-12">

                    
                  


                    <div class="row" >
                        <div class="col-sm-6" id="onward_results">
                        <?php 
                             if(!empty($list_onward)){
                                 $i = 0;
                            foreach ($list_onward as $list) {
                            if($list['VehicleType']!=''){
                            $VehicleType[] =$list['VehicleType'];
                            } 
        ?>
                        <div id="ticketid<?php echo $i;?>" class="offset-2 col-sm-12 pad-null">
                    
                                <div class="fblueline"><b><?php echo $list['MasterServiceType']; ?> /<?php echo isset($list['MasterProductType'])?$list['MasterProductType']:''; ?> / <?php echo trim($list['MasterVehicleType']); ?></b> </div>
                                
                                <!-- GOING TICKET-->
                                <div class="frow1">
                                    <div class="col-sm-4">
<?php if (isset($list['Image']) && $list['Image'] != '') { ?>
                                    <img class="lazy" src="<?php echo str_replace('small', 'large', $list['Image'][0]); ?>" alt="<?php echo $list['transferType']; ?>">
                                <?php } else { ?>
                                    <img class="lazy" data-original="<?php echo base_url(); ?>assets/img/no_image.png" alt="<?php echo $list['transferType']; ?>">
                                <?php } ?>

                                 <div class="radio radiomargin0">
                                              <label>
<input class="rat inbound" type="radio" name="inbound" value="<?php echo $i; ?>" data_show_id="<?php echo $i; ?>"/>Onward
                                              </label>
                                            </div>
                                    </div>
                                     <div class="col-sm-4">
                                          <?php echo $list['PickupLocation']['Name'];?><br>  
                                            <span class="grey"><?php echo $list['PickupLocation']['Code'];?> </span>
                                    </div>
                                     <div class="col-sm-4">
                                          <?php echo $list['DestinationLocation']['Name'];?><br>
                                            <span class="grey"><?php echo $list['DestinationLocation']['Code'];?></span>
                                    </div>
                                  
                                    
                                </div>
<div class="clearfix"></div>
                                 <div class="col-sm-12">
 <p>Maximum Waiting Time (Domestic) <span style="font-size:12px;"><?php echo $list['Domestic_waiting']['@attributes']['time']." ".$list['Domestic_waiting']['@content'];?></span></p>

                                    <p>Maximum Waiting Time (International) <span style="font-size:12px;"><?php echo $list['International_waiting']['@attributes']['time']." ".$list['International_waiting']['@content'];?></span></p>
                                 </div>
                                <div class="col-sm-12">
                                   <p><?php echo $list['TransferPickupInformation'];?></p>
                               </div>

                                 <?php $CancellationPolicy=($list['CancellationPolicy']); if(!empty($CancellationPolicy)){?>  
                            <div class="col-sm-12">

                               
                 


<?php  foreach ($CancellationPolicy as $key => $CancellationPolicyval) { ?>
    <p>Cancellation : <?php echo $list['Currency'].$CancellationPolicyval['amount']." ".$CancellationPolicyval['dateFrom']." ".$CancellationPolicyval['time'];?></p>
<?php } ?>      
                             

                            </div>
                              <?php } ?>
<?php $Description=($list['Description']); if(!empty($Description)){?>  
                            <div class="col-md-12 ">

                                <ul class=" execut">
                 


<?php  foreach ($Description as $key => $Descriptionval) { ?>
    <li><?php echo $Descriptionval['content'];?></li>
<?php } ?>      
                                </ul>

                            </div>

                              <?php } ?>
                                <div class="fselect">
                                    <span class="size12 lightgrey"><?php echo $list['Currency'].($list['TotalAmount']);?></span>&nbsp; <button class="inbound selectbtn mt1" type="button">Select</button>  
                                </div>
                           
                        </div>
<div class="clearfix"></div><br>
                        <?php $i++;} } ?>
                    </div>
                          <div class="col-sm-6" id="return_results">
                         <?php 
                             if(!empty($list_return)){
                                 $i = 0;
                            foreach ($list_return as $list) {
                            if($list['VehicleType']!=''){
                            $VehicleType[] =$list['VehicleType'];
                            } 
        ?>
                        <div id="ticketid<?php $i;?>" class="offset-2 col-sm-12 pad-null offset-2">
                          
                                <div class="fblueline"><b><?php echo $list['MasterServiceType']; ?> /<?php echo isset($list['MasterProductType'])?$list['MasterProductType']:''; ?> / <?php echo trim($list['MasterVehicleType']); ?></b> </div>
                                
                                <!-- GOING TICKET-->
                                <div class="frow1">
                                    <div class="col-sm-4">
<?php if (isset($list['Image']) && $list['Image'] != '') { ?>
                                    <img class="lazy" src="<?php echo str_replace('small', 'large', $list['Image'][0]); ?>" alt="<?php echo $list['transferType']; ?>">
                                <?php } else { ?>
                                    <img class="lazy" data-original="<?php echo base_url(); ?>assets/img/no_image.png" alt="<?php echo $list['transferType']; ?>">
                                <?php } ?>

                                 <div class="radio radiomargin0">
                                              <label>
<input class="rat outbound" type="radio" name="outbound" value="<?php echo $i; ?>" data_show_id="<?php echo $i; ?>"/>Return
                                              </label>
                                            </div>
                                    </div>
                                     <div class="col-sm-4">
                                          <?php echo $list['PickupLocation']['Name'];?><br>  
                                            <span class="grey"><?php echo $list['PickupLocation']['Code'];?> </span>
                                    </div>
                                     <div class="col-sm-4">
                                          <?php echo $list['DestinationLocation']['Name'];?><br>
                                            <span class="grey"><?php echo $list['DestinationLocation']['Code'];?></span>
                                    </div>
                                  
                                    
                                </div>
<div class="clearfix"></div>
                                 <div class="col-sm-12">
 <p>Maximum Waiting Time (Domestic) <span style="font-size:12px;"><?php echo $list['Domestic_waiting']['@attributes']['time']." ".$list['Domestic_waiting']['@content'];?></span></p>

                                    <p>Maximum Waiting Time (International) <span style="font-size:12px;"><?php echo $list['International_waiting']['@attributes']['time']." ".$list['International_waiting']['@content'];?></span></p>
                                 </div>
                                <div class="col-sm-12">
                                   <p><?php echo $list['TransferPickupInformation'];?></p>
                               </div>

                                 <?php $CancellationPolicy=($list['CancellationPolicy']); if(!empty($CancellationPolicy)){?>  
                            <div class="col-sm-12">

                               
                 


<?php  foreach ($CancellationPolicy as $key => $CancellationPolicyval) { ?>
    <p>Cancellation : <?php echo $list['Currency'].$CancellationPolicyval['amount']." ".$CancellationPolicyval['dateFrom']." ".$CancellationPolicyval['time'];?></p>
<?php } ?>      
                             

                            </div>
                              <?php } ?>
<?php $Description=($list['Description']); if(!empty($Description)){?>  
                            <div class="col-md-12 ">

                                <ul class=" execut">
                 


<?php  foreach ($Description as $key => $Descriptionval) { ?>
    <li><?php echo $Descriptionval['content'];?></li>
<?php } ?>      
                                </ul>

                            </div>
                            
                              <?php } ?>
                                <div class="fselect">
                                    <span class="size12 lightgrey"><?php echo $list['Currency'].($list['TotalAmount']);?></span>&nbsp; <button class="selectbtn mt1 outbound" type="button">Select</button>  
                                </div>
                           
                        </div>
<div class="clearfix"></div><br>
                        <?php $i++;} } ?>
                        </div>
                    </div>
                    <!-- End of row-->

                </div>

                <?php }else{ 

echo '<div id="errorMessage" style="text-align:center;display:none;" class="no_available removel">
<h1>There are no flights available. </h1>
<br><br>
<div class="no_available_text">Sorry, we have no prices for tickets in this date range matching your criteria. One or more of your preferences may be affecting the number of exact matches found. Try searching again with a wider search criteria. <br></div>
    </div>'; // Error Message
  
          }  ?>



           <script type="text/javascript">

             $(document).on("click",".selectbtn",function(e){

                if($(this).hasClass('inbound')){
                   $(this).parents('.col-sm-12').find('.inbound:radio').prop('checked', true);
                    $(this).parents('.col-sm-12').find('.inbound:radio').attr('checked', 'checked');
                  }else{
                    $(this).parents('.col-sm-12').find('.outbound:radio').prop('checked', true);
                    $(this).parents('.col-sm-12').find('.outbound:radio').attr('checked', 'checked');
                    }
                if ($('input[name=inbound]:checked').length > 0) 
                {
                var id = $('input[name=inbound]:checked').val();
                }else{
                    alert('Please check atleast one onward transfer');
                    return false;
                }

                if($('input[name=outbound]:checked').length > 0)
                {
                var outId = $('input[name=outbound]:checked').val();
                }else{
                    alert('Please check atleast one return transfer');
                    return false;
                }

                // alert(id+'--'+outId);
                 window.open(Site_Url+'/car/details/'+id+'/'+outId, '_blank');
             });
        
        
        

    </script>