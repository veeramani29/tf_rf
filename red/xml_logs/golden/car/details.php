<?php
$this->load->view('header');


if($searchData['trip_type']!=1){ 
    $car_data_reurn=$car_data['return'];
$car_data=$car_data['oneway'];
    }
    $hotel_images=$car_data['Image'];
?>
<style type="text/css">
    .rating .fa fa-star-half {
    color: #F90;
}

/*--.flex li {
    width: unset !important;
}---*/
</style>
    <style>
        .btn-group-select-num>.btn.active,
        .btn-group-select-num>.btn.active:hover {
            border-color: 0px!important;
            -webkit-box-shadow: none;
            box-shadow: none;
            color: #fff;
        }
        .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus{ border-left: 0px!important; border-right: 0px!important; border-top:0px!important;    color: #f8ab3c;border-bottom-color: #f8ab3c !important;}
        .carousel-control.right{ background-image: none;}
        .carousel-control.left{ background-image: none;}
        .iron{padding-left:18px; padding-top:35px;}
    </style>

        <!-- main start -->
        <div class="container ht_cont_padd">
            <div class="col-md-12">
                <p><a href="#">Back to Search Results</a></p>
                <div class="col-md-8 pad_left0">



       
    
 <?php  if($searchData['trip_type']==2){ ?>

 <h4><?php echo $car_data['MasterServiceType']; ?> /<?php echo isset($car_data['MasterProductType'])?$car_data['MasterProductType']:''; ?> / <?php echo trim($car_data['MasterVehicleType']); ?> (<?php echo $car_data['transferType']; ?>)</h4> 

<h4><?php echo $car_data['MasterServiceType']; ?> /<?php echo isset($car_data['MasterProductType'])?$car_data['MasterProductType']:''; ?> / <?php echo trim($car_data['MasterVehicleType']); ?> (<?php echo $car_data_reurn['transferType']; ?>)</h4> 
   <?php }else{ ?>
<h4><?php echo $car_data['MasterServiceType']; ?> /<?php echo isset($car_data['MasterProductType'])?$car_data['MasterProductType']:''; ?> / <?php echo trim($car_data['MasterVehicleType']); ?></h4>
   <?php } ?>


   <b>Onward</b>
   <p><?php echo $car_data['PickupLocation']['Name'];?> (<?php echo $car_data['PickupLocation']['Code'];?>) -> <?php echo $car_data['DestinationLocation']['Name'];?> (<?php echo $car_data['DestinationLocation']['Code'];?>)</p>
 
 <?php  if($searchData['trip_type']==2){ ?>
    <b>Return</b>
   <p><?php echo $car_data_reurn['PickupLocation']['Name'];?> (<?php echo $car_data_reurn['PickupLocation']['Code'];?>) -> <?php echo $car_data_reurn['DestinationLocation']['Name'];?> (<?php echo $car_data_reurn['DestinationLocation']['Code'];?>)</p>
    <?php } ?>

                   
                </div>

                
                
            </div>
            
            
            
            <div style="clear:both;"></div>
            
            <div class="col-md-7">
              
                <div id="main_area">
                    <!-- Slider -->

                  
                    <div class="row">
                        <div class="col-xs-12" id="slider">
                            <!-- Top part of the slider -->
                            <div class="row">
                                <div class="col-sm-12" id="carousel-bounding-box">
                                    <div class="carousel slide" id="myCarousel">
                                        <!-- Carousel items -->
                                        <div class="carousel-inner">
                                            
                                             <?php 
                                        if(is_array($hotel_images) && !empty($hotel_images)){
                                            $i=0;
                                            foreach($hotel_images as $photo){
                                            ?>
                                                <div class="<?php echo($i == 0?'active':''); ?> item" data-slide-number="<?php echo $i; ?>">
                                               
 <img class="hd_slider1" src="<?php echo str_replace('small', 'large', $photo); ?>">
                                                 
                                                </div>
                                            <?php
                                                        $i++;
                                                    }
                                                } else {
                                            ?>
                                                <div class="active item" data-slide-number="0">
                                                    <img class="hd_slider1" src="<?php echo base_url(); ?>assets/img/no_images.jpg" alt="">
                                                </div>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <!-- Carousel nav -->
                                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                        </a>
                                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--/Slider-->

                    <div class="row hidden-xs" id="slider-thumbs">
                        <!-- Bottom switcher of slider -->
                        <ul class="hide-bullets">
                            <?php 
                                if(is_array($hotel_images) && !empty($hotel_images)){
                                                $i=0;
                                                foreach($hotel_images as $photo){
                            ?>
                                <li class="col-sm-2">
                                  

                                  
                                                          <a class="thumbnail" id="carousel-selector-<?php echo $i; ?>"><img class="hd_slider2" src="<?php echo $photo; ?>"></a>

                                                 
                                </li>
                            <?php
                                        $i++;
                                    }
                                } else {
                            ?>
                                <li class="col-sm-2">
                                    <a class="thumbnail" id="carousel-selector-0"><img class="hd_slider2" src="<?php echo base_url(); ?>assets/img/no_images.jpg"></a>
                                </li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                </div>



  

                        
 

</div>




                           
           
            <div class="col-md-5">

            <?php  $features=($car_data['Description']); if(!empty($features)){ ?> 
                <div class=" col-md-12 pad_0">
                    <h4>What’s Included</h4>
                </div>
                <div class=" col-md-12 pad_0">
                  
                   <ul class="list_ok" style="padding-left:0px;">


<?php 
    foreach ($features as $key => $feature) { ?>
    <li class="list-group-item"><img src="<?php echo base_url(); ?>/assets/img/hotel_inner/d7.png" style="width:19px; margin-right:5px;"><b><?php echo $feature['content'];?></b></li>
<?php } ?>      
         
         
                                           
                                        </ul>
                   
                </div>
                <?php  } ?>
                <div class="col-md-12 pad_0">
<h4>TransferPickupInformation</h4>
<p>
                <?php 

                   
                        if($car_data['TransferPickupInformation'] != ''){
                      echo isset($car_data['TransferPickupInformation'])?"<b>(".$car_data['transferType'].") </b> ".$car_data['TransferPickupInformation']:$car_data['Description'];
                         
                        } else {
                            echo 'No Description available for this hotel.';
                        }

echo "<br>";
                         if($searchData['trip_type']==2 && $car_data_reurn['TransferPickupInformation'] != ''){
                      echo isset($car_data_reurn['TransferPickupInformation'])?"<b>(".$car_data_reurn['transferType'].")</b> ".$car_data_reurn['TransferPickupInformation']:$car_data_reurn['Description'];
                         
                        }
                    
                    ?>
                       </p> 
                    
                </div>
            </div>


 <div class="col-md-12 pad_0">
<?php $CancellationPolicy=$car_data['CancellationPolicy'];   if(!empty($CancellationPolicy)){  ?>
  
<?php  foreach ($CancellationPolicy as $key => $CancellationPolicyval) { ?>
    <p><b>Cancellation</b> : <?php echo $car_data['Currency'].$CancellationPolicyval['amount']." ".$CancellationPolicyval['dateFrom']." ".$CancellationPolicyval['time'];?></p>
<?php } } ?> 
<p>No waiting time for the customer</p>
 <p>Maximum supplier waiting time (Domestic) <span style="font-size:12px;"><?php echo $car_data['Domestic_waiting']['@attributes']['time']." ".$car_data['Domestic_waiting']['@content'];?></span></p>

                                    <p>Maximum supplier waiting time (International) <span style="font-size:12px;"><?php echo $car_data['International_waiting']['@attributes']['time']." ".$car_data['International_waiting']['@content'];?></span></p>

                                    <p class="text-center"><span ><?php echo $car_data['Currency'].($car_data['TotalAmount']+$car_data_reurn['TotalAmount']);?></span>

  <a class="btn btn-primary btn-lg btl" data-toggle="modal" data-target="#myModal" href="#myModal">BOOK NOW</a>



           
</div>
            <div class="col-md-12 pad_0">
                <ul class="six">
                    <li>Check-In:<span><?php echo date('M, d D, Y',strtotime($searchData['cin'])) ?> </span>Check-Out: <span><?php echo date('M, d D, Y',strtotime($searchData['cout'])); ?></span></li>
                    <li><?php echo $searchData['nights']; ?> Nights,<span> Adult : <?php echo $searchData['adult']; ?>, <?php echo($searchData['child'] > 0 ? 'Child : '.$searchData['child']:''); ?></span></li>
                </ul>
            </div>


           

            <div class="container">
            
            <div class="col-md-12 pad_0" id="review">
                
                    <div class="col-md-12 pad_0">
                        <ul class="Seanne">

<?php if(isset($car_data['TransferBulletPoint'][0])) { 
    $TransferBulletPointRes=$car_data['TransferBulletPoint']; ?>
                        <li>
                               
                                <div class="col-md-10 pad_left0">
                  <h4>TransferGeneralInfoList (<?php echo $car_data['transferType']; ?>)</h4>
                                   
                       <?php  foreach ($TransferBulletPointRes as $key => $TransferBulletPointResvalue) {
                     echo "<p>".$TransferBulletPointResvalue['description'];
                      
                            echo " (".$TransferBulletPointResvalue['type'].")</p>";
                        
                    
                  } ?>
</div>
                            </li>
<?php } ?>


<?php if(isset($car_data_reurn['TransferBulletPoint'][0])) { 
    $TransferBulletPointRes=$car_data_reurn['TransferBulletPoint']; ?>
                        <li>
                               
                                <div class="col-md-10 pad_left0">
                  <h4>TransferGeneralInfoList (<?php echo $car_data_reurn['transferType']; ?>)</h4>
                                   
                       <?php  foreach ($TransferBulletPointRes as $key => $TransferBulletPointResvalue) {
                     echo "<p>".$TransferBulletPointResvalue['description'];
                      
                            echo " (".$TransferBulletPointResvalue['type'].")</p>";
                        
                    
                  } ?>
</div>
                            </li>
<?php } ?>
                           
                           
                        </ul>
                        
                        
                    </div>
            </div>




             <div class="col-md-12 pad_0" >
                
                    <div class="col-md-12 pad_0">
                        <ul class="Seanne">

<?php if(isset($car_data['GenericTransferBulletPoint'][0])) { 
    $GenericTransferBulletPoint=$car_data['GenericTransferBulletPoint']; ?>
                        <li>
                               
                                <div class="col-md-10 pad_left0">
                  <h4>GenericTransferGuidelinesList (<?php echo $car_data['transferType']; ?>)</h4>
                                   
                       <?php  foreach ($GenericTransferBulletPoint as $key => $GenericTransferBulletPointvalue) {
                     echo "<p><b>".$GenericTransferBulletPointvalue['description']."</b><br>";
                      
                            echo $GenericTransferBulletPointvalue['detail_description']."</p>";
                        
                    
                  } ?>
</div>
                            </li>
<?php } ?>




<?php if(isset($car_data_reurn['GenericTransferBulletPoint'][0])) { 
    $GenericTransferBulletPoint=$car_data_reurn['GenericTransferBulletPoint']; ?>
                        <li>
                               
                                <div class="col-md-10 pad_left0">
                  <h4>GenericTransferGuidelinesList (<?php echo $car_data_reurn['transferType']; ?>)</h4>
                                   
                       <?php  foreach ($GenericTransferBulletPoint as $key => $GenericTransferBulletPointvalue) {
                     echo "<p><b>".$GenericTransferBulletPointvalue['description']."</b><br>";
                      
                            echo $GenericTransferBulletPointvalue['detail_description']."</p>";
                        
                    
                  } ?>
</div>
                            </li>
<?php } ?>

                           
                           
                        </ul>
                        
                        
                    </div>
            </div>



            <div class="col-md-12 pad_0" >
                
                    <div class="col-md-12 pad_0">
                        <ul class="Seanne">

<?php if(isset($car_data['SpecificTransferInfoList'][0])) { 
    $SpecificTransferInfoList=$car_data['SpecificTransferInfoList']; ?>
                        <li>
                               
                                <div class="col-md-10 pad_left0">
                  <h4>SpecificTransferInfo (<?php echo $car_data['transferType']; ?>)</h4>
                                   
                       <?php  foreach ($SpecificTransferInfoList as $key => $SpecificTransferInfoListvalue) {
                     echo "<p>".$SpecificTransferInfoListvalue['description']."</p>";
                        
                    
                  } ?>
</div>
                            </li>
<?php } ?>


<?php if(isset($car_data_reurn['SpecificTransferInfoList'][0])) { 
    $SpecificTransferInfoList=$car_data_reurn['SpecificTransferInfoList']; ?>
                        <li>
                               
                                <div class="col-md-10 pad_left0">
                  <h4>SpecificTransferInfo (<?php echo $car_data_reurn['transferType']; ?>)</h4>
                                   
                       <?php  foreach ($SpecificTransferInfoList as $key => $SpecificTransferInfoListvalue) {
                     echo "<p>".$SpecificTransferInfoListvalue['description']."</p>";
                        
                    
                  } ?>
</div>
                            </li>
<?php } ?>
                           
                           
                        </ul>
                        
                        
                    </div>
            </div>



            <div class=" col-md-12 pad_0" id="map">
                <h4 class="ht_fot18_1" style="padding-top:25px;">What's Nearby*</h4>
                <div class="col-md-12 pad_0">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d497699.99740305037!2d77.3507368942719!3d12.953847717752192!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae1670c9b44e6d%3A0xf8dfc3e8517e4fe0!2sBengaluru%2C+Karnataka!5e0!3m2!1sen!2sin!4v1497610140433" width="100%" height="450" frameborder="0" style="border:0 ; padding:10px; border:1px solid #ccc;" allowfullscreen></iframe>
                </div>
            </div>
            <div class=" col-md-12 pad_0">
                <h4 class="ht_fot18_1" style="padding-top:25px;">Policies & Fees</h4>
                <div class="col-md-12 pad_0 policy">
                    <div class="col-md-2 pad_left0">
                        <p><b>Payment</b></p>
                    </div>
                    <div class="col-md-10 pad_left0">
                        <p>Major credit cards accepted</p>
                    </div>
                </div>
            </div>
            
            
            <div class="col-md-12 pad_0 social" style="padding-left:21%; border-bottom:1px solid #ccc;">
                <img src="<?php echo base_url(); ?>/assets/img/hotel_inner/ia.png">
                <img src="<?php echo base_url(); ?>/assets/img/hotel_inner/arc.png">
                <img src="<?php echo base_url(); ?>/assets/img/hotel_inner/s.png">
                <img src="<?php echo base_url(); ?>/assets/img/hotel_inner/north.png">
                <img src="<?php echo base_url(); ?>/assets/img/hotel_inner/master.png">
                <img src="<?php echo base_url(); ?>/assets/img/hotel_inner/visa.png">
                <img src="<?php echo base_url(); ?>/assets/img/hotel_inner/discover.png">
                <img src="<?php echo base_url(); ?>/assets/img/hotel_inner/amer.png">
            </div>
            
            </div>
            <div style="clear:both;"></div>
            

             <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Please fill the details</h4>
        </div>
        <div class="modal-body">
      <form id="form-case" name= "car_service_dels" action="<?php echo site_url(); ?>/car/pre_booking/<?php echo $id; ?><?php echo (isset($outid) && $outid!='')?'/'.$outid:'';?>" data-ga-paramtab="1" data-qa="transfer-extra-info-dialog" class="form dialog form_loading_dialog gildir" style="width:auto;" method="post" onsubmit="return callCartCarModal();" >
       
        <p class="dialog__form--text">
        Please provide the following information. It is vital in order to confirm your transfer reservation.<br>
        Please note: If the incorrect details are provided, the provider will not be held responsible for correct service provision and you may be subject to cancellation/no-show fees.
        </p>
    <h2 class="">Arrival Transfer</h2>
    <fieldset>
       
        <div class="col-md-3">
            <label>Flight code</label>
            <input type="text" class="required form-control" required maxlength="7" placeholder="BA2760" name="s-from-arrival-travelnumber" value="" id="s-from-arrival-travelnumber"  >
            
        </div>
        <div class=" col-md-6">
            <label for="form-control" required>Flight arrival time</label><!--
         --><div class="col-md-3"><select id="s-from-hour-arrival" name="s-from-hour-arrival" class=" form-control required" >
                <option value="-1">hh</option>
               <?php 
               for ($h=0;$h<24;$h++){
  echo "<option value=".(($h<9)?"0".$h:$h).">".(($h<9)?"0".$h:$h)."</option>";
}
?>
            </select></div><!--
         --><div class="col-md-3"><select id="s-from-minute-arrival" name="s-from-minute-arrival" class=" form-control required" >
            <option value="-1">mm</option>
                  <?php 
               for ($m=0;$m<12;$m++){
                $mm=$m*5;
  echo "<option value=".(($mm<9)?"0".$mm:$mm).">".(($mm<9)?"0".$mm:$mm)."</option>";
}
?>
            </select></div>
          
        </div>
    </fieldset>     
    <?php if($car_data['transferType']=='TER'){ ?>
    <fieldset class="">
        <div class="col-md-3">
            <label>Train Company Name</label>
            <input type="text" name="s-from-departure-company" class="form-control" required placeholder="Virgin Trains, SNCF,…" value="" id="s-from-departure-company">           
        </div><!--
        --><div class="col-md-3">
            <label>Train Number</label>
            <input type="text" maxlength="7" class="form-control" required name="s-from-departure-travelnumber" placeholder="AVE 040" value="" id="s-from-departure-travelnumber" >
        </div><!--
        -->
        <div class=" col-md-6">
            <label for="form-control" required>Train departure time</label>
            <div class=" col-md-3"><select id="s-from-hour-departure" name="s-from-hour-departure" class=" form-control required" >
                <option value="-1">hh</option>
                <?php 
               for ($h=0;$h<24;$h++){
  echo "<option value=".(($h<9)?"0".$h:$h).">".(($h<9)?"0".$h:$h)."</option>";
}
?>
            </select></div><!--
            --><div class="col-md-3"><select id="s-from-minute-departure" name="s-from-minute-departure" class=" form-control required" >
            <option selected="selected" value="-1">mm</option>
                  <?php 
               for ($m=0;$m<12;$m++){
                $mm=$m*5;
  echo "<option value=".(($mm<9)?"0".$mm:$mm).">".(($mm<9)?"0".$mm:$mm)."</option>";
}
?>
            </select></div>
           
        </div>
    </fieldset>
      <?php  } if($searchData['trip_type']!=1){  ?>
    <h2 class="">Departure Transfer</h2>
    <?php if($car_data['transferType']=='TER'){ ?>
    <fieldset class="">
        <div class="col-md-3">
            <label>Train Company Name</label>
            <input type="text" name="s-to-arrival-company" class="form-control" required placeholder="Virgin Trains, SNCF,…" value="" id="s-to-arrival-company">           
        </div><!--
        --><div class="col-md-3">
            <label>Train Number</label>
            <input type="text" maxlength="7" class="form-control" required name="s-to-arrival-travelnumber" placeholder="AVE 040" value="" id="s-to-arrival-travelnumber">             
            
        </div><!--
        -->
        <div class=" col-md-6">
            <label for="form-control" required>Train arrival time</label>
            <div class="col-md-3"><select id="s-to-hour-arrival" name="s-to-hour-arrival" class=" form-control required"  >
                <option value="-1">hh</option>
                 <?php 
               for ($h=0;$h<24;$h++){
  echo "<option value=".(($h<9)?"0".$h:$h).">".(($h<9)?"0".$h:$h)."</option>";
}
?>
            </select></div>
            <div class="col-md-3"><select id="s-to-minute-arrival" name="s-to-minute-arrival" class=" form-control required" >
            <option selected="selected" value="-1">mm</option>
                 <?php 
               for ($m=0;$m<12;$m++){
                $mm=$m*5;
  echo "<option value=".(($mm<9)?"0".$mm:$mm).">".(($mm<9)?"0".$mm:$mm)."</option>";
}
?>
            </select></div>
          
        </div>
  </fieldset>
  <?php } ?>
    <fieldset>
       <div class="col-md-3">
            <label>Flight code</label>
            <input type="text" class="required form-control" required maxlength="7" placeholder="BA2760" name="s-to-departure-travelnumber" value="" id="s-to-departure-travelnumber" >           
        </div>
        <div class="col-md-6">
            <label for="form-control" required>Flight departure time</label>
            <div class="col-md-3"><select id="s-to-hour-departure" name="s-to-hour-departure" class=" form-control required" >
                <option value="-1">hh</option>
               <?php 
               for ($h=0;$h<24;$h++){
  echo "<option value=".(($h<9)?"0".$h:$h).">".(($h<9)?"0".$h:$h)."</option>";
}
?>
            </select></div><!--
         --><div class="col-md-3"><select id="s-to-minute-departure" name="s-to-minute-departure" class=" form-control required">
            <option selected="selected" value="-1">mm</option>
                  
                   <?php 
               for ($m=0;$m<12;$m++){
                $mm=$m*5;
  echo "<option value=".(($mm<9)?"0".$mm:$mm).">".(($mm<9)?"0".$mm:$mm)."</option>";
}
?>
            </select></div>
          
        </div>
  
       
      
    
</fieldset>
<?php } ?>
<fieldset>
 <div class="col-md-12">
            <br>
              <!--<button data-toggle="modal" href="#Addcard" type="button" class="btn btn-success pull-right" data-api-id="<?php echo $id; ?>">Continue</button>-->
              <button type="submit" class="btn btn-success pull-right" >Continue</button>

        </div>
        </fieldset>
</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
    <!-- Modal -->
        </div>
		
		<div class="modal fade user" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="Addcard">
		  <div class="modal-dialog modal-sm car_cart">
			<div class="modal-content">
			  <!--<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  </div>-->
			  <div class="modal-body">
				<p> Do you want to Search For Hotels Or Activities ?</p>
			  </div>
			   <div id ="show_loading" style="margin-left:270px;padding: 0px 0px 25px;display:none;"><img src="<?php echo base_url(); ?>assets/img/loader.gif" style="width:45px;"></div>
			  <div class="modal-footer modal-footer-align">
				<button type="button" class="btn btn-default" id="modal-btn-si"  data-appid = "<?php echo $id; ?>">Okay</button>
				<button type="button"   class="btn btn-primary cancel_request" id="modal-btn-no"  data-appid = "<?php echo $id; ?>">No Thanks</button>
			  </div>
			</div>
		  </div>
		</div>


    <?php $this->load->view('footer'); ?>
      
        <!--slider -->
		<style>
		    .car_cart
			{
				padding-top:200px;
			}				
		</style>
        <script>
             jQuery(document).ready(function($) {

                    $('#myCarousel').carousel({
                            interval: 5000
                    });

                    $('#carousel-text').html($('#slide-content-0').html());

                    //Handles the carousel thumbnails
                   $('[id^=carousel-selector-]').click( function(){
                        var id = this.id.substr(this.id.lastIndexOf("-") + 1);
                        var id = parseInt(id);
                        $('#myCarousel').carousel(id);
                    });


                    // When the carousel slides, auto update the text
                    $('#myCarousel').on('slid.bs.carousel', function (e) {
                             var id = $('.item.active').data('slide-number');
                            $('#carousel-text').html($('#slide-content-'+id).html());
                    });
            });
            
            $('#myTabs a').click(function (e) {
              e.preventDefault()
              $(this).tab('show')
            })
                $('#myTabs a[href="#profile"]').tab('show') // Select tab by name
                $('#myTabs a:first').tab('show') // Select first tab
                $('#myTabs a:last').tab('show') // Select last tab
                $('#myTabs li:eq(2) a').tab('show') // Select third tab (0-indexed)
				
				function callCartCarModal()
				{
					$('#Addcard').modal('show');
					return false;
				}
				
				var modalConfirm = function(callback){
					var apiId = "";
					   
					  $("#modal-btn-si").on("click", function(){
						 $(".modal-footer-align").hide();
						 $("#show_loading").show();      
						apiId = $(this).attr("data-appid");
						callback(true,apiId);
						$("#mi-modal").modal('hide');
					  });
					  
					  $("#modal-btn-no").on("click", function(){
						 $(".modal-footer-align").hide();
						 $("#show_loading").show();  
						apiId = $(this).attr("data-appid");
						callback(false,apiId);
						$("#mi-modal").modal('hide');
					  });
					};
				
				modalConfirm(function(confirm , apiId="" , activityId="" , activityDels =""){
					  if(confirm){
						  
						 var data = new window.FormData($('#form-case')[0]);
						 
						  $.ajax({
								url: '<?php echo site_url(); ?>/car/addCarddetails/'+apiId,
								type: "POST",
								data: data,
								cache: false,
								contentType: false,
								processData: false,
								dataType: 'json',
								success: function (data) {
								  $('#Addcard').modal('hide');	
								  console.log(data);
								  window.location.href = "<?php echo site_url(); ?>";
								}
							}).done(function(response) {
								console.log(data);
							    window.location.href = "<?php echo site_url(); ?>";
							});
					  }
					  else
					  {
						document.car_service_dels.submit();  
						//window.location.href = "<?php echo site_url(); ?>"+"/car/pre_booking/"+apiId;
					  }
					});	
				
        </script>
 
