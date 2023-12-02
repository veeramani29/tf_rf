<div class="pagecontainer2 paymentbox grey">
                    <div class="padding20">
                        <span class="opensans size18 dark bold">  <?php echo ($searchData['journey_type']!='one_way')?"Onward":"";?> Trip Summary</span>
                    </div>
                    <div class="line3"></div>
                    
                    <div class="hpadding30 margtop30">
                    
                     <?php
                        $adult = $searchData['adult'];
                        $child = $searchData['child'];
                        $infant = $searchData['infant'];
                      
                    ?>
                  
                       <?php if(isset($flightDetails) && $flightDetails != ''){ ?>
                         <?php 
                            if($searchData['journey_type']=='one_way'){
                                $flightData_onward=$flightData['flights'];
                            }else{
                              $flightData_onward=array_filter($flightData['flights'], function($k) {
                            if(!isset($k['isReturn'])){ return true; }else{
                            return false; }
                            });  
                            }
                            

                                $i = 0;
                                foreach ($flightData_onward as $flight) { 
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
                                        
                                    if (count($flightData_onward) > 1 && $i < count($flightData_onward) - 1) {
                                       
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
                                  <h6>   <span><?php echo (count($flightData_onward)-1); ?> stop</span></h6>
                        <h6>Duration <?php echo $this->Home_Model->convertToHoursMins($flightData['journeyInfo'][0]['journeyTime'], '%02d h %02d m'); ?></h6>
                         
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


                   
                    
                    <br>
                    
                   <?php } else { ?>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-12  ">
                                <p class="fli_acc"><span style="padding-right:10px;"><img alt="" src="<?php echo base_url(); ?>assets/images/img/flights/i.png"></span>
                                    <b style="font-size: 14px;color: #f74623;">The flight is not available any more. Please search again and book another flight.</b>
                                </p>
                            </div>
                        </div>
                        <?php } ?>



                          <?php 
//ROUNDTRIP SEGMENT DETAILS
                    if($searchData['journey_type']!='one_way'){
                        $data['searchData']=$searchData;
                        $data['flightData']=$flightData;
                        $data['flightDetails']=$flightDetails; 
                        $data['roundData']=$roundData; 

                      $this->load->view('flight_new/flight-roundtrip-details', $data);
                  }
                  //ROUNDTRIP SEGMENT DETAILS
                       ?>


    
                    <span class="dark">Fare Details: <?php echo ucfirst(str_replace("_", " ", $searchData['journey_type']));?></span>
                    <div class="fdash mt10"></div><br>


                     <?php 
                      $infant=$searchData['infant']; if(isset($flightDetails) && $flightDetails != ''){
                    $adult=$searchData['adult'];
                    $child=$searchData['child'];
                    $markup_=($_SESSION[session_id()]['agent_markup']+$_SESSION[session_id()]['admin_markup']);

                               ?>
                            
                       
                        <?php  if($searchData['sr_ctzn'] == 'true'){ ?>
                        <div class="col-md-12">
                            <h6 >Traveler(Senior Citizen)<span style="font-size:10px; padding-left:10px;"><a href="#">REQ SENIOR_CITIZEN_PROOF *</a></span></h6>
                        </div>
                       
                        <?php } else { ?>
                            <div class="col-md-12">
                            <h6>Traveler (Adult) <span class="right bold green">&#8369; <?php echo ($flightDetails['fare']['paxFares']['adt']['total']['amount']+$markup_);?></span></h6>
                        </div>
                            <a href="#adultprice"  class="collapsebtn3 collapsed mt-5" data-toggle="collapse" data-target="#adultprice">View Breakup</a>
                    <div id="adultprice" class="collapse ">
                        <?php

                            foreach($flightDetails['fare']['paxFares']['adt'] as $key => $value){
                           
                            
                                if($key != ''){ if($key == 'base'){  $markup=$markup_;}else{ $markup=0; } ?>
                                    <div class="col-md-12">
                                        <div class="col-md-6  "><?php echo ucfirst($key); ?></div>
                                        <div class="col-md-6 pull-right  " style="text-align:right;" >&#8369; <?php echo number_format((($value['amount'] *$adult)+$markup),2,'.',','); ?></div>
                                    </div>
                                    <?php 
                                }
                                
                            } ?>
                        <div class="clearfix"></div>  
                    </div>
  <div class="fdash mt10"></div><br>
                        
                       
                            <?php  }
                        ?>
                        <?php 
                            if($child > 0){
                        ?>
                            <div class="col-md-12">
                                <h6 >Traveler (Child) <span class="right bold green">&#8369; <?php echo $flightDetails['fare']['paxFares']['chd']['total']['amount'];?></span></h6>
                            </div>
                            
                             <a data-target="#childprice" class="collapsebtn3 collapsed mt-5" data-toggle="collapse" data-target="#childprice">View Breakup</a>
                    <div id="childprice" class="collapse ">
                        <?php 
                            foreach($flightDetails['fare']['paxFares']['chd'] as $keyc => $valuec){
                                
                                if($keyc != ''){
                        ?>
                                <div class="col-md-12">
                                    <div class="col-md-6  "><?php echo ucfirst($keyc); ?></div>
                                    <div class="col-md-6 pull-right  " >&#8369; <?php echo number_format(($valuec['amount']*$child),2,'.',','); ?></div>
                                </div>
                        <?php
                                    }
                                } ?>
                               <div class="clearfix"></div>  
                    </div>
  <div class="fdash mt10"></div><br>


                          <?php  } ?>
                        <?php 
                            if($infant > 0){
                        ?>
                            <div class="col-md-12">
                                <h6 >Traveler (Infant) <span class="right bold green">&#8369; <?php echo $flightDetails['fare']['paxFares']['inf']['total']['amount'];?></span></h6>
                            </div>
                             <a href="#infprice" class="collapsebtn3 collapsed mt-5" data-toggle="collapse" data-target="#infprice">View Breakup</a>
                    <div id="infprice" class="collapse ">
                        <?php 
                            foreach($flightDetails['fare']['paxFares']['inf'] as $keyIn => $valueIn){
                                if($keyIn != ''){
                        ?>
                                <div class="col-md-12">
                                    <div class="col-md-6  "><?php echo ucfirst($keyIn); ?></div>
                                    <div class="col-md-6 pull-right  " style="text-align:right;" >&#8369; <?php echo number_format(($valueIn['amount']*$infant),2,'.',','); ?></div>
                                </div>
                        <?php
                                    }
                                } ?>
                                <div class="clearfix"></div>  
                    </div>
  <div class="fdash mt10"></div><br>
                         <?php    }
                        ?>
                        <div class="col-md-12" >
                            <div class="col-md-6">
                                <h6 >Extra Baggage</h6>
                            </div>
                            <div class="col-md-6 ">
                                <h6 class="pull-right ">&#8369; <span id="ex_bag_cost">0.00</span></h6>
                            </div>
                        </div>
                       
                    <?php } ?>
                  
                   
                    
                    

                    <br>
                    <br>

                    
                    
                    </div>  
                    <div class="line3"></div>
                    <div class="padding30">                 
                        <span class="left size14 dark">Trip Total:</span>

                         <?php 
                            $markup=($_SESSION[session_id()]['agent_markup']+$_SESSION[session_id()]['admin_markup']);
                            ?>
                              
                                
                                <input type="hidden" id="fl_tot" name="fl_tot" value="<?php echo ($flightDetails['fare']['totalFare']['total']['amount']+$markup); ?>">

                        <span class="right lred2 bold size18">&#8369; <span id="tot_cost"><?php echo number_format(($flightDetails['fare']['totalFare']['total']['amount']+$markup),2,'.',','); ?></span></span>
                        <div class="clearfix"></div>
                    </div>
                  
                </div><br>