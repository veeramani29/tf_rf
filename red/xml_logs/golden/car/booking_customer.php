<?php 
$this->load->view('header');
if($searchData['trip_type']!=1){ 
    $car_data_reurn=$car_data['return'];
$car_data=$car_data['oneway'];
    }
   ?>
    <style>

        .btn-group-select-num>.btn.active,

        .btn-group-select-num>.btn.active:hover {

            border-color: 0px!important;

            -webkit-box-shadow: none;

            box-shadow: none;

            color: #fff;

        }

.social_icon{padding-left:21%; border-bottom:1px solid #ccc; border-top: 1px solid #ccc;}

    </style>


        <!-- main start -->

            <div class="container ht_cont_padd">

                <div class="col-md-12 pad_left0">

                    <h3 style="color:#1471b2;">CONGRATULATIONS!</h3>

                    <p>You got our lowest price at this hotel - don't pass it up, <span><a href="#">Book Now</a> </span></p>

                </div>

                <div class="col-md-8 pad_0">

                    <div class="col-md-12 pad_left0">

                        <img src="<?php echo base_url(); ?>assets/img/hotel_inner/d4.png" style=" width:50px;"><span class="ht_fot18_1" style=" padding-left:10px;">Activity Details</span>

                    </div>

                    <div class="col-md-12 pad_0 revi_left">

                        <div class="col-md-7 pad_left0" style="padding-top:10px;">

                            <div class="col-md-4 pad_left0">

                                <?php 
 
                                if(is_array($car_data['Image']) && $car_data['Image'] != ''){
                            ?>
                                 <img src="<?php echo str_replace('small', 'large', $car_data['Image'][0]); ?>" width="100%" alt="Image">   
                            <?php
                                } else {
                            ?>
                                 <img src="<?php echo base_url(); ?>assets/img/no_images.jpg" width="100%" alt="Image">
                            <?php
                                }
                            
                            ?>

                            </div>

                            <div class="col-md-8 pad_left0">

                                <div class="col-md-12 pad_0">

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

                                <div class="col-md-12 pad_0">


 
<?php $CancellationPolicy=$car_data['CancellationPolicy'];   if(!empty($CancellationPolicy)){  ?>
  
<?php  foreach ($CancellationPolicy as $key => $CancellationPolicyval) { ?>
    <p><b>Cancellation</b> : <?php echo $car_data['Currency'].$CancellationPolicyval['amount']." ".$CancellationPolicyval['dateFrom']." ".$CancellationPolicyval['time'];?></p>
<?php } }

 ?> 
<p>No waiting time for the customer</p>
 <p>Maximum supplier waiting time (Domestic) <span style="font-size:12px;"><?php echo $car_data['Domestic_waiting']['@attributes']['time']." ".$car_data['Domestic_waiting']['@content'];?></span></p>

                                    <p>Maximum supplier waiting time (International) <span style="font-size:12px;"><?php echo $car_data['International_waiting']['@attributes']['time']." ".$car_data['International_waiting']['@content'];?></span></p>
                         
                          

                         

           

                                </div>

                                <div class="col-md-12 pad_left0">

                                        <img src="<?php echo base_url(); ?>assets/img/hotel_inner/doller.png" style="width:19px;">

                                        <span>Best Price Guarantee</span>

             <p><b><?php echo (isset($car_data['TotalAmount']))?"TotalAmount :".$car_data['Currency'].($car_data['TotalAmount']+$car_data_reurn['TotalAmount']):''; ?><b></p>

              <p><?php echo (isset($car_data['modalities'][0]['comments']))?"<b>Comments / Remarks</b> <br>".$car_data['modalities'][0]['comments']:''; ?></p>
                           

                                    </div>










                            </div>

                        </div>

                        <div class="col-md-5 pad_0">

                          
                           

                            <ul class="check_in">

                                <li>

                                    <p style="text-align:center;"><b>Pick Up  :</b></p>

                                    <p style="text-align:center; font-size:12px;">
                                    <?php echo date('M d, Y',strtotime($searchData['cin'])); ?></p>

                                </li>

                                <li>

                                    <p style="text-align:center;"><b>Drop Off :</b></p>
 <?php  if($searchData['trip_type']==2){ ?>
                                    <p style="text-align:center;"><?php echo date('M d, Y',strtotime($searchData['cout'])); ?></p>
                               <?php  }else { ?>
  <p style="text-align:center;"><?php echo date('M d, Y',strtotime($searchData['cin'])); ?></p>
                         <?php  } ?>

                                </li>

                                <li>

                                    <p style="text-align:center;"><b>No of Day :</b></p>

                                    <p style="text-align:center;"><?php echo ceil($searchData['nights']); ?></p>

                                </li>

                            </ul>

                        </div>

                    </div>

                    <div class="col-md-12 pad_left0">

                        <img src="<?php echo base_url(); ?>assets/img/hotel_inner/bat.png" style=" width:50px;"><span class="ht_fot18_1" style=" padding-left:10px;">Travel Protection Plan</span>

                </div>

                    

                    <div class="col-md-12 pad_0 revi_left">

                        <div class="col-md-12 pad_0" style="border-bottom:1px solid #ccc;">

                            <div class="col-md-7 pad_left0" style="padding-top:10px;border-right: 1px solid #ccc;">

                                <div class="col-md-4 pad_left0">

                                    <img src="<?php echo base_url(); ?>assets/img/hotel_inner/bat.png" style="width:100%;">

                                </div>

                                <div class="col-md-8 pad_left0">

                                    <div class="col-md-12 pad_0">


                                  

                                        

                                    </div>

                                    <div class=" col-md-12 pad_left0">

                                        <p style="font-size: 13px;">Receive Trip Cancellation & Interruption benefits up to $100,000 For Covered Reasons.</p>

                                        <p style="font-size: 13px;">24 Hour emergency assistance service is included with insurance purchase.</p>

                                    </div>











                                </div>

                            </div>

                            <div class="col-md-5 pad_0">

                                <p class="ht_fot18_1 cover">Coverage Includes:</p>



                                <ul class="check_in1">

                                    <li><i class="fa fa-check tick_hotel" aria-hidden="true"></i>Trip Cancellation



                                    </li>

                                    <li>

                                      <i class="fa fa-check tick_hotel" aria-hidden="true"></i>Trip Interruption 

                                    </li>

                                    <li>

                                       <i class="fa fa-check tick_hotel" aria-hidden="true"></i>Trip Delay

                                    </li>

                                    <li>

                                        <i class="fa fa-check tick_hotel" aria-hidden="true"></i>Baggage Delay

                                    </li>

                                </ul>

                            </div>

                        </div>

                        <div class="col-md-12 pad_0">

                            <div class="checkbox pro_plan">

                            <label>

                              <input type="checkbox"><p style=" font-size:12px;"><span class="ht_fot18_1">Yes, add travel protection plan.</span> View Description of Coverage for terms and conditions.</p>

                            </label>

                          </div>

                            <div class="checkbox pro_plan">

                            <label>

                              <input type="checkbox"><p style=" font-size:12px;">No, I wish to decline travel protection and emergency assistance service.</p>

                            </label>

                          </div>

                        </div>

                    </div>

                    <div class="col-md-12 pad_0">

                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-bottom:2px;">

                      <div class="panel panel-default bor_none box_sho">

                        <div class="panel-heading" role="tab" id="headingOne">

                          <h4 class="panel-title">

                            <a role="button" data-parent="#accordion"  aria-expanded="true" aria-controls="collapseTwo" style=" background-color: #f5f5f5;border: 1px solid #e6e6e6;    color: #111;" class="collapsed"><i class="fa fa-user tick_hotel " aria-hidden="true"></i>

                              <span class="ht_fot18_1" >Cancellation Policy </span>
                              <br>
<?php $CancellationPolicy=$car_data['CancellationPolicy'];   if(!empty($CancellationPolicy)){  ?>
  
<?php  foreach ($CancellationPolicy as $key => $CancellationPolicyval) { ?>
    <p><b>Cancellation</b> : <?php echo $car_data['Currency'].$CancellationPolicyval['amount']." ".$CancellationPolicyval['dateFrom']." ".$CancellationPolicyval['time'];?></p>
<?php } } ?> 

                            </a>

                          </h4>

                        </div>

                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" style="border: 1px solid rgb(245, 245, 245); height: 2px;">

                          <div class="panel-body">

                               

                                

                                

                          </div>

                        </div>

                      </div>

                    </div>

                 </div>

                    

                    <div class="col-md-12 pad_0">

                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-bottom:2px;">

                      <div class="panel panel-default bor_none box_sho">

                        <div class="panel-heading" role="tab" id="headingOne">

                          <h4 class="panel-title">

                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style=" background-color: #f5f5f5;border: 1px solid #e6e6e6;" class="collapsed"><i class="fa fa-user tick_hotel " aria-hidden="true"></i>

                              <span class="ht_fot18_1" >Guest Details </span><span style="font-size:12px;">(Enter Guest Names Below)</span><span style="

                                  float: right;padding-right: 13px;">Already a member?</span>

                            </a>

                          </h4>

                        </div>

                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" style="border: 1px solid rgb(245, 245, 245); height: 2px;">

                          <div class="panel-body">

                                <div class="col-md-5 pad_left0">

                                    <h4>Sign in to your account</h4>

                                    <p style="font-size:12px;">Its the fastest way to make your booking</p>

                                </div>

                                <div class="col-md-6 pad_left0">

                                    <form class="form-inline">

                                        <div class="form-group">

                                            <label class="pull-left" for="exampleInputEmail2" style="padding: 7px 35px 7px 7px;">Email</label>

                                            <input type="email" class="form-control pull-left" id="exampleInputEmail2" placeholder="Email">

                                        </div>

                                        <div class="form-group" style="padding-top:10px;">

                                            <label class="pull-left" for="exampleInputEmail2" style="padding:7px;">Password</label>

                                            <input type="email" class="form-control pull-left" id="exampleInputEmail2" placeholder="Password">

                                        </div>

                                    </form>

                                </div>

                                <div class="col-md-1 pad_0">

                                    <div class="col-md-12 pad_0">

                                            <button class="btn btn-primary btn-lg btl" type="submit">Sign in</button>





                                    </div>

                                    <div class="col-md-12 pad_0">

                                        <p style="font-size:12px;"><a href="#">Forgot?</a></p>

                                    </div>

                                </div>

                          </div>

                        </div>

                      </div>

                    </div>

                </div>

                    

                    <div class="col-md-12 pad_0 revi_left">
 <form name="booking" method="POST" action="<?php echo site_url(); ?>/car/booking_process"> 
 <input type="hidden" name="bookingPrepare" value="<?php echo base64_encode(json_encode($ServiceAddedResult));?>">
  <?php  if($searchData['trip_type']==2){ ?>
   <input type="hidden" name="bookingPrepareRound" value="<?php echo base64_encode(json_encode($ServiceAddedResult1));?>">
      <?php } ?>
      <input type="hidden" name="post_service_data" value="<?php echo base64_encode(json_encode($post_service_data));?>">
                        <div class="col-md-12 pad_0" >

                        <div class="col-md-12 pad_left0">

                            <h4 class="ht_fot18_1">Enter Pax Details </h4>
                        </div>



                         <div class="col-md-12 ho_pad0">
                            
                           

                           
                            <div class="col-md-12 pad_left0">

                            <h4 class="ht_fot18_1">Enter Primary Guest </h4>
                            </div>
                          
                           
                            <div class="col-md-12 ho_pad0">
                                <hr>
                            </div>
                            <?php for ($j = 0; $j < $searchData['adult']; $j++){ ?>
                            <div class="col-md-12 ho_pad0">
                                <div class="col-md-2 ho_padleft0">
                                    <p class="ho_font16">Adult <?php echo ($j+1); ?>:</p>
                                </div>
                                <div class="col-md-10 ho_pad0">
                                    <div class="col-md-2 ho_padleft0">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Title</label>
                                            <select class="form-control" name="adulttitle[]" required>
                                                <option value="Mr">Mr</option>
                                                <option value="Mrs">Mrs</option>
                                                   <option value="Miss">Miss</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5 ho_padleft0">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">First Name</label>
                                            <input type="text" class="form-control" name="adultFname[]" required placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-md-5 ho_padleft0">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Last Name</label>
                                            <input type="text" class="form-control" name="adultLname[]" required placeholder="Last Name">
                                        </div>
                                   
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php 
                                if(isset($searchData['child']) && $searchData['child'] > 0){
                                    for ($k = 0; $k < $searchData['child']; $k++){
                            ?>
                            <div class="col-md-12 ho_pad0">
                                <div class="col-md-2 ho_padleft0">
                                    <p class="ho_font16">Child <?php echo ($k+1); ?>:</p>
                                </div>
                                <div class="col-md-10 ho_pad0">
                                    <div class="col-md-2 ho_padleft0">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Title</label>
                                            <select class="form-control" name="childtitle[]" required>
                                                <option value="Mr">Mr</option>
                                                <option value="Mrs">Mrs</option>
                                                   <option value="Miss">Miss</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5 ho_padleft0">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">First Name</label>
                                            <input type="text" class="form-control" name="childFname[]" required placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-md-5 ho_padleft0">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Last Name</label>
                                            <input type="text" class="form-control" name="childLname[]" placeholder="Last Name">
                                        </div>
                                    </div>

                                    <div class="col-md-2 ho_padleft0">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Age</label>
                                            <select  class="form-control" name="childage[]" required>
                                            <?php //for ($ca=1; $ca <17 ; $ca++) { 
                                               // if($searchData['child_age'][0][$k]==$ca){
                                                    $select="selected='selected'";
                                                //}else{
                                                   // $select="";
                                                //}
                                                
                                               echo  "<option ".$select." value='".$searchData['child_age'][0][$k]."'>".$searchData['child_age'][0][$k]."</option>";
                                          // } ?>
                                              
                                               
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php } ?>
                            <?php } ?>


                           
                        </div>
                     
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="outid" value="<?php echo (isset($outid) && $outid!='')?$outid:'';?>">
                   



                       

                       
                        </div>


                        <div class="col-md-12 ho_pad0">
                            <hr>
                        </div>
                        <div class="col-md-12 ho_pad0">
                            <div class="col-md-12 ho_padleft0">
                                <p class="ho_font161">Enter Your Personal Information(Note : voucher will be sent to the below email id.)</p>
                            </div>
                            <div class="col-md-12 ho_pad0">
                                <div class="col-md-2 ho_padleft0">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <select class="form-control" name="user_title">
                                            <option value="Mr">Mr</option>
                                            <option value="Miss">Miss</option>
                                            <option value="Mrs">Mrs</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 ho_padleft0">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">First Name</label>
                                        <input type="text" name="user_fname" class="form-control" id="exampleInputEmail1" placeholder="First Name">
                                    </div>
                                </div>
                                
                                <div class="col-md-3 ho_padleft0">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Last Name</label>
                                        <input type="text" name="user_lname" class="form-control" id="exampleInputEmail1" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="col-md-4 ho_padleft0">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email Id</label>
                                        <input type="email" name="user_email" class="form-control" id="exampleInputEmail1" placeholder="Enter Your Email Id">
                                    </div>
                                </div>
                                <div class="col-md-4 ho_padleft0">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone Number</label>
                                        <input type="text" name="user_phone" class="form-control" id="exampleInputEmail1" placeholder="Enter Your Phone Number">
                                    </div>
                                </div>
                                <div style="clear:both;"></div>
                                <div class="col-md-12 ho_pad0">
                                    <hr>
                                </div>
                               
                            </div>
                        </div>


                        <div class="col-md-12 pad_0" style="    padding: 13px 23px 13px 0px;">

                            <button name="submit" class="btn btn-primary btn-lg btl" type="submit">Proceed To Checkout</button>
                             </div>
</form>
                    </div>

                </div>

                <div class="col-md-4">

                        <h4 style="margin:0px;"><img src="<?php echo base_url(); ?>assets/img/hotel_inner/doller.png" style="width:19px;"><span class="ht_fot18_1">Price Details</span></h4>

                       <div class="col-md-12 pad_0 revi_left">

                            <div class="col-md-12 pad_0">

                                <div class="col-md-8 pad_left0">

                                    <p><b>Subtotal</b></p>

                                </div>

                                <div class="col-md-4 pad_left0">

                                    <p style="text-align:right;"><b><?php   $totalPrice = ($car_data['TotalAmount']+$car_data_reurn['TotalAmount']); ?></b>  <?php echo $car_data['Currency'].number_format($totalPrice,2,'.',','); ?></p>

                                </div>

                            </div>

                           

                           <h4 style="margin:0px;" class="ht_fot18_1">Price Details</h4>

                           <div class="col-md-12 pad_0">

                                <div class="col-md-8 pad_left0">

                                    <form>

                                        <div class="form-group">

                                            <label for="exampleInputEmail1">Enter promotional code</label>

                                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">

                                        </div>

                                    </form>

                                </div>

                                <div class="col-md-4 pad_left0" style="padding-top: 31px;">

                                    <button class="btn btn-primary btn-lg btl" type="submit">Apply</button>

                                </div>

                             </div>

                            <div class="col-md-12 pad_left0">

                                <p style="text-align:right;"><b>Total reservation price:</b></p>
                              
                     <p style="text-align:right; font-size:22px;"><b> <?php echo $car_data['Currency'].number_format($totalPrice,2,'.',','); ?></b></p>
                                   

                               

                            </div>

                           

                           

                           

                        

                       </div> 

                        <div class="col-md-12  pad_0 revi_left">

                            <img src="<?php echo base_url(); ?>assets/img/hotel_inner/i.png" class="i_icon"><span style="font-size:18px;"><a href="#">Cancellation Policy</a></span>

                        </div>

                        <div class="col-md-12  pad_0 revi_left">

                            <div class="col-md-12 pad_0 bod_bott">

                                <div class="col-md-8 pad_left0">

                                    <p class="ht_fot18_1">Secure SSL</p>

                                    <p class="ht_fot18_1" style="font-size:24px;"><b>Booking</b></p>

                                </div>

                                <div class="col-md-4 pad_left0">

                                    <img src="<?php echo base_url(); ?>assets/img/hotel_inner/lock.png" class="lock_im">

                                </div>

                            </div>

                            <div class="col-md-12 pad_0 mc_im">

                                <div class="col-md-5 pad_left0">

                                    <img src="<?php echo base_url(); ?>assets/img/hotel_inner/mc.png" style="width:90px;">

                                    

                                </div>

                                <div class="col-md-7 pad_left0">

                                    <p>CheapOair has passed McAfee SECURE's daily security scan</p>

                                </div>

                            </div>

                            <div class="col-md-12 pad_0 mc_im">

                                <div class="col-md-5 pad_left0">

                                    <img src="<?php echo base_url(); ?>assets/img/hotel_inner/north.png" style="width:90px;">

                                    

                                </div>

                                <div class="col-md-7 pad_left0">

                                    <p>Your booking is SSL secured & encrypted by VeriSign</p>

                                </div>

                            </div>

                            

                        </div>

                    

                    

                </div>

                

               <div class="col-md-12 pad_0 social social_icon">

                <img src="<?php echo base_url(); ?>assets/img/hotel_inner/ia.png">

                <img src="<?php echo base_url(); ?>assets/img/hotel_inner/arc.png">

                <img src="<?php echo base_url(); ?>assets/img/hotel_inner/s.png">

                <img src="<?php echo base_url(); ?>assets/img/hotel_inner/north.png">

                <img src="<?php echo base_url(); ?>assets/img/hotel_inner/master.png">

                <img src="<?php echo base_url(); ?>assets/img/hotel_inner/visa.png">

                <img src="<?php echo base_url(); ?>assets/img/hotel_inner/discover.png">

                <img src="<?php echo base_url(); ?>assets/img/hotel_inner/amer.png">

            </div> 

                

            </div>

            

<div style="clear:both;"></div>


  <?php $this->load->view('footer'); ?>



</html>

