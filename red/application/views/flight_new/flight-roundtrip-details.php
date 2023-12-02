  <div class="line3"></div>
                    <div class="padding20">
                        <span class="opensans size18 dark bold">Return Trip Summary</span>
                    </div>
                    <div class="line3"></div>
                    
                    <div class=" margtop30">
                    
                     <?php
                        $adult = $searchData['adult'];
                        $child = $searchData['child'];
                        $infant = $searchData['infant'];
                      
                    ?>
                  
                       <?php if(isset($flightDetails) && $flightDetails != ''){ ?>
                         <?php 

                         if (trim($searchData['fromCountry']) == 'Philippines' && trim($searchData['toCountry']) == 'Philippines') {
    $segments_return=($roundData['flights']);   
}else{
$segments_return=array_filter($flightData['flights'], function($k) {
return (isset($k['isReturn']) && $k['isReturn']== 1);
});
$segments_return=array_values($segments_return);   
}

                          
                            

                                $i = 0;
                                foreach ($segments_return as $flight) { 
                                //echo "<pre>"; print_r($flight); exit;
                                    $codes = $this->Flightbeta_Model->getDepArvAirportOnCode($flight['depDetail']['code'], $flight['arrDetail']['code']);
                                    
                                   
                                
                                   
                            ?>
                    <!-- GOING TO -->
                    <div>
                        <div class="wh33percent left size12 bold dark">
                        <?php echo $flight['depDetail']['code'] ?>
                        </div>
                        <div class="wh33percent left center size12 bold dark">
                        <?php echo $flight['stops'] ?> stop
                        </div>
                        <div class="wh33percent right textright size12 bold dark">
                        <?php echo $flight['arrDetail']['code'] ?>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="wh33percent left">
                            <div class="fcircle">
                                <span class="fdeparture"></span>
                            </div>
                        </div>
                        <div class="wh33percent left">
                            <div class="fcircle center">
                                <span class="fstop"></span>
                            </div>
                        </div>
                        <div class="wh33percent right">
                            <div class="fcircle right">
                                <span class="farrival"></span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="fline2px"></div>
                        
                        <div class="wh33percent left size12">
                         <?php echo date('D d, M Y',strtotime($flight['depDetail']['time'])); ?>
                        </div>
                        <div class="wh33percent left center size12">
                          <?php  echo  $this->Home_Model->convertToHoursMins($flight['flyTime'], '%02d h %02d m');  ?> 
                        </div>
                        <div class="wh33percent right textright size12">
                          <?php echo date('D d, M Y',strtotime($flight['arrDetail']['time'])); ?>
                        </div>
                        <div class="clearfix"></div>
                            
                                        <?php
                                        
                                    if (count($segments_return) > 1 && $i < count($segments_return) - 1) {
                                       
            $layover = $this->Home_Model->convertToHoursMins($flightData['flights'][$i]['layover'], '%02d h %02d m');
                                        ?>
                                        <div class="col-md-12">
                                            <h6>Connection flight at <?php echo $codes[1]['airport_city']; ?> ( <?php echo $flight['arrDetail']['name']; ?> )
                                            <br>
                                            &nbsp;&nbsp;Layover Time : <?php echo $layover; ?></h6>
                                        </div>
                                        <?php
                                        }  ?>
                                        
                                      </div>
                    <!-- END OF GOING TO -->    
                                  
                        
     <?php  $i++;
                                    }
                            ?>

                        <div class="row">


                       
                                <div class="col-md-12 ">
                                  <h6>   <span><?php echo (count($segments_return)-1); ?> stop</span></h6>
                        <h6>Duration <?php echo $this->Home_Model->convertToHoursMins($flightData['journeyInfo'][1]['journeyTime'], '%02d h %02d m'); ?></h6>
                         
                                <h6>Class / Baggage</h6>
                                <?php foreach ($flight['classDetail'] as $classDetailkey => $classDetailvalue) {
                                    echo '<p>Economy <b>'.strtoupper($classDetailkey).'</b> ( '.(($classDetailvalue['class']!='')?$classDetailvalue['class']:'Not Included').')</p>';
                                }
                                  ?>


                                 
                                    <p>Baggage: (ADT) <?php echo isset($flight['amenities']['baggage']['checkin']['adt']['desc'])?$flight['amenities']['baggage']['checkin']['adt']['desc']:'Not Included'; ?></p>
                                    <p>Meal: <?php echo ($flight['amenities']['meal']==1)?'Included':'Not Included'; ?></p>
                                    <p>Smoke: <?php echo ($flight['amenities']['smoke']==1)?'Included':'Not Included'; ?></p>
                                    <?php if($flight['refundable'] == true){ ?>
                                   <p> Fare is Refundable</p>
                                <?php } else { ?>
                                   <p> Fare is Non-Refundable</p>
                                <?php } ?>
                                </div>
                            </div>


                  
                    
                   
                    
                   <?php } else { ?>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-12  ">
                                <p class="fli_acc"><span style="padding-right:10px;"><img alt="" src="<?php echo base_url(); ?>assets/images/img/flights/i.png"></span>
                                    <b style="font-size: 14px;color: #f74623;">The flight is not available any more. Please search again and book another flight.</b>
                                </p>
                            </div>
                        </div>
                        <?php } ?>

    
                   

                    <br>
           
</div>
       



               