  
        <!--##### FARE RULE, TERMS, BAGGAGE POPUP WINDOW STARTS HERE ###############################-->
        <div id="fare_rulebeta" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style="border-radius: 0px;border-top: 3px solid #f74623;border-bottom: 3px solid #f74623;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <span class="modal-title" style="font-size:16px;font-weight:bold">Fare Details</span>
                    </div>
                    <div class="modal-body" style="padding-left:20px;">
                        <div class="col-sm-12">
                            <div style="width:100%;">
                                <?php if(isset($searchData['sr_ctznn']) && $searchData['sr_ctznn'] == 'true'){ ?>
                                <table class="table">
                                    <tr>
                                        <td style="font-weight: bold;">Single Senior Citizen Fare Breakup :</td>
                                    </tr>
                                </table>
                                <table class="table table-bordered">
                                    <tbody>
                                    <?php
                                    for ($i = 0; $i < count($flightDetails['fare']); $i++) {
                                        if ($flightDetails['fare'][$i]['type'] == 'SingleSeniorCitizen') {
                                            ?>
                                            
                                            <tr>
                                                <?php
                                                if ($flightDetails['fare'][$i]['ChargeType'] == 'totalAmount') {
                                                    ?>
                                                    <td style="font-weight:bold;">Total Amount</td>
                                                    <td style="font-weight:bold;">PHP <?php echo ($flightDetails['fare'][$i]['price']); ?></td>
                                                    <?php
                                                } else {
                                                    if ($flightDetails['fare'][$i]['ChargeType'] == 'BaseFare')
                                                        $showPrice = ($flightDetails['fare'][$i]['price']);
                                                    else
                                                        $showPrice = $flightDetails['fare'][$i]['price'];
                                                    ?>
                                                    <td><?php echo $flightDetails['fare'][$i]['ChargeType']; ?></td>
                                                    <td>PHP <?php echo $showPrice; ?></td>
                                                    <?php
                                                }
                                                ?>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <?php } else { ?>
                                <table class="table">
                                    <tr>
                                        <td style="font-weight: bold;">Single Adult Fare Breakup :</td>
                                    </tr>
                                </table>
                                <table class="table table-bordered">
                                    <tbody>
                                    <?php
                                   foreach ($flightDetails['fare']['paxFares']['adt'] as $key => $value) {


                                    ?>
                                          <tr>
                                                <?php
                                                if ($key=='total') {
                                                    if($key == 'total'){  $markup=($_SESSION[session_id()]['agent_markup']+$_SESSION[session_id()]['admin_markup']);}else{ $markup=0; } 
                                                    ?>
                                                    <td style="font-weight:bold;">Total Amount</td>
                                                    <td style="font-weight:bold;">PHP <?php echo (($value['amount']*$adult)+$markup); ?></td>
                                                    <?php
                                                } else {
                                                     $showPrice = ($value['amount']);
                                                    ?>
                                                    <td><?php echo ucfirst($key); ?></td>
                                                    <td>PHP <?php echo $showPrice; ?></td>
                                                    <?php
                                                }
                                                ?>
                                            </tr>
                                            <?php
                                        }
                                    
                                    ?>
                                    </tbody>
                                </table>
                                <?php } ?>
                                <?php
                                if ($searchData['child'] > 0) {
                                    ?>
                                    <table class="table">
                                        <tr>
                                            <td style="font-weight: bold;">Single Child Fare Breakup :</td>
                                        </tr>
                                    </table>
                                    <table class="table table-bordered">
                                        <tbody>
                                       <?php
                                      foreach ($flightDetails['fare']['paxFares']['chd'] as $key => $value) {
                                       
                                            ?>
                                            
                                            <tr>
                                                <?php
                                                if ($key=='total') {
                                                    ?>
                                                    <td style="font-weight:bold;">Total Amount</td>
                                                    <td style="font-weight:bold;">PHP <?php echo ($value['amount']*$adult); ?></td>
                                                    <?php
                                                } else {
                                                   
                                                        $showPrice = ($value['amount']);
                                                    ?>
                                                      <td><?php echo ucfirst($key); ?></td>
                                                    <td>PHP <?php echo $showPrice; ?></td>
                                                    <?php
                                                }
                                                ?>
                                            </tr>
                                            <?php
                                        }
                                    
                                    ?>
                                        </tbody>
                                    </table>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($searchData['infant'] > 0) {
                                    ?>
                                    <table class="table">
                                        <tr>
                                            <td style="font-weight: bold;">Single Infant Fare Breakup :</td>
                                        </tr>
                                    </table>
                                    <table class="table table-bordered">
                                        <tbody>
                                        <?php
                                   
                                        foreach ($flightDetails['fare']['paxFares']['inf'] as $key => $value) {
                                            ?>
                                            
                                            <tr>
                                                <?php
                                               if ($key=='total') {
                                                    ?>
                                                    <td style="font-weight:bold;">Total Amount</td>
                                                    <td style="font-weight:bold;">PHP <?php echo ($value['amount']*$infant); ?></td>
                                                    <?php
                                                } else {
                                                   
                                                        $showPrice = ($value['amount']);
                                                    ?>
                                                      <td><?php echo ucfirst($key); ?></td>
                                                    <td>PHP <?php echo $showPrice; ?></td>
                                                    <?php
                                                }
                                                ?>
                                            </tr>
                                            <?php
                                        }
                                    
                                    ?>
                                        </tbody>
                                    </table>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="border:0px;"></div>
                </div>

            </div>
        </div>
        <div id="baggage_policybeta" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" style="border-radius: 0px;border-top: 3px solid #f74623;border-bottom: 3px solid #f74623;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <span class="modal-title" style="font-size:16px;font-weight:bold">Baggage Policy</span>
                    </div>
                    <div class="modal-body" style="padding-left:20px;">
                        <div class="col-sm-12">
                            <div style="width:100%;">


                             <?php foreach ($flightDetails['flights'] as $flight) { 
                                echo "<p>".$flight['depDetail']['name']." - ".$flight['arrDetail']['name']."</p>";
                             show_keys($flight['amenities']);

                             } 
                               if (isset($flightDetails['ssr']['ssrHeap']['baggage'][0]['data']) && count($flightDetails['ssr']['ssrHeap']['baggage'][0]['data']) > 0) {
                                        ?>
                                    <table class="table">
                                        <tr>
                                            <td style="font-weight: bold;">Baggage price Breakup :</td>
                                        </tr>
                                    </table>
                                <table class="table table-bordered">
                                    <tbody>
                                   
                                  
                                        <thead>
                                        <tr>
                                            <th>Weight ( Kg )</th>
                                            <th>Cost</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        for ($i = 0; $i < count($flightDetails['ssr']['ssrHeap']['baggage'][0]['data']); $i++) {
                                            ?>
                                            <tr>
                                                <td style="padding: 5px;"><?php echo $flightDetails['ssr']['ssrHeap']['baggage'][0]['data'][$i]['desc']; ?></td>
                                                <td>PHP <?php echo $flightDetails['ssr']['ssrHeap']['baggage'][0]['data'][$i]['amount']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                      
                                    </tbody>
                                </table>
                  <?php
                                    }  if (isset($flightDetails['ssr']['ssrHeap']['meal'][0]['data']) && count($flightDetails['ssr']['ssrHeap']['meal'][0]['data']) > 0) {
                                    ?>
                 <table class="table">
                                        <tr>
                                            <td style="font-weight: bold;">Meals price Breakup :</td>
                                        </tr>
                                    </table>
                                <table class="table table-bordered">
                                    <tbody>
                                    <?php
                                   
                                        ?>
                                        <thead>
                                        <tr>
                                            <th>Meals</th>
                                            <th>Cost</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        for ($i = 0; $i < count($flightDetails['ssr']['ssrHeap']['meal'][0]['data']); $i++) {
                                            ?>
                                            <tr>
                                                <td style="padding: 5px;"><?php echo $flightDetails['ssr']['ssrHeap']['meal'][0]['data'][$i]['desc']; ?></td>
                                                <td>PHP <?php echo $flightDetails['ssr']['ssrHeap']['meal'][0]['data'][$i]['amount']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                     
                                    </tbody>
                                </table>
                   <?php
                                    }
                                    ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="border:0px;"></div>
                </div>

            </div>
        </div>
        
        <div id="terms_conditionbeta" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" style="border-radius: 0px;border-top: 3px solid #f74623;border-bottom: 3px solid #f74623;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <span class="modal-title" style="font-size:16px;font-weight:bold">Terms and Conditions</span>
                    </div>
                    <div class="modal-body" style="padding-left:20px;">
                        <div class="col-sm-12">
                            <div style="width:100%;">
                                <?php 

                                if(isset($flightDetails['cndtns']) && !empty($flightDetails['cndtns'])){
                                   $cndtnsarray= $flightDetails['cndtns'];
                       unset($cndtnsarray['sessionTime']);unset($cndtnsarray['name']);unset($cndtnsarray['block']);#unset($cndtnsarray['showNTA']);unset($cndtnsarray['showInc']);
show_keys($cndtnsarray);
                                }

                                if(isset($flightDetails['extraServices']) && !empty($flightDetails['extraServices'])){
show_keys($flightDetails['extraServices']);
                                }
                               /* echo '<pre>';
        print_r($flightDetails['extraServices']);
        echo  '</pre>';*/
        

      
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="border:0px;"></div>
                </div>

            </div>
        </div>
        <!--################################ENDS######################################################-->



  <!-- show_fare_popup Modal -->
<div class="modal fade" id="flightFareModal" tabindex="-1" role="dialog" aria-labelledby="flightFareModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="flightFareModalLabel">Detailed Information</h4>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
<!-- show_fare_popup Modal -->