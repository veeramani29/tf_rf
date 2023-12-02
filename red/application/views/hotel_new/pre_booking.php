<?php
$i = 0;
$totalPrice = 0;
if($api_id == 1 || $api_id == 3){
    if ($bookingPrepare != '') {
        if($api_id == 1){
            foreach ($bookingPrepare['rooms'] as $room) {
                $roomPrice = $room['TotalSellingPrice'];
                if ($cur_val != 0) {
                    $roomPrice = $roomPrice * number_format((float) $cur_val, 2, '.', '');
                }
                if ($i == 0) {
                    if ($admin_markup['type'] == 'fixed') {
                        $mTyp = $searchData['type'];
                        $roomPrice = $roomPrice + $admin_markup[$mTyp];
                    } else {
                        $mTyp = $searchData['type'];
                        $roomPrice = ((($admin_markup[$mTyp] / 100) * $roomPrice) + $roomPrice);
                    }

                    if ($agent_markup['type'] == 'fixed') {
                        $amTyp = $searchData['type'];
                        $roomPrice = $roomPrice + $agent_markup[$amTyp];
                    } else {
                        $amTyp = $searchData['type'];
                        $roomPrice = ((($agent_markup[$amTyp] / 100) * $roomPrice) + $roomPrice);
                    }
                }

                $totalPrice = $totalPrice + $roomPrice;
                $i++;
            }
        }
        if($api_id == 3){
            $roomPrice = $bookingPrepare['final_price'];
            if ($cur_val != 0) {
                $roomPrice = $roomPrice * number_format((float) $cur_val, 2, '.', '');
            }

            if ($admin_markup['type'] == 'fixed') {
                $mTyp = $searchData['type'];
                $roomPrice = $roomPrice + $admin_markup[$mTyp];
            } else {
                $mTyp = $searchData['type'];
                $roomPrice = ((($admin_markup[$mTyp] / 100) * $roomPrice) + $roomPrice);
            }

            if ($agent_markup['type'] == 'fixed') {
                $amTyp = $searchData['type'];
                $roomPrice = $roomPrice + $agent_markup[$amTyp];
            } else {
                $amTyp = $searchData['type'];
                $roomPrice = ((($agent_markup[$amTyp] / 100) * $roomPrice) + $roomPrice);
            }
            $totalPrice = $totalPrice + $roomPrice;
        }
    }
} else {
    $roomPrice = $room_data['price'];
    if ($admin_markup['type'] == 'fixed') {
        $mTyp = $searchData['type'];
        $roomPrice = $roomPrice + $admin_markup[$mTyp];
    } else {
        $mTyp = $searchData['type'];
        $roomPrice = ((($admin_markup[$mTyp] / 100) * $roomPrice) + $roomPrice);
    }

    if ($agent_markup['type'] == 'fixed') {
        $amTyp = $searchData['type'];
        $roomPrice = $roomPrice + $agent_markup[$amTyp];
    } else {
        $amTyp = $searchData['type'];
        $roomPrice = ((($agent_markup[$amTyp] / 100) * $roomPrice) + $roomPrice);
    }
    $totalPrice = $totalPrice + $roomPrice;
}
?>

    
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/hotel-style12.css">
   
      
   
    <!--########################### HEADER STARTS HERE ###############################################################-->
    <?php $this->load->view('common/header'); ?>
    <!--############################ HEADER ENDS HERE ##############################################################-->

      <section class="">
         
    
    <!-- Breadcrumbs -->
    <div class="container breadcrub">
        <div>
            <a class="homebtn left" href="<?php echo site_url();?>"></a>
            <div class="left">
                <ul class="bcrumbs">
                    <li>/</li>
                    <li><a href="javascript:;"><?php echo ucfirst($this->router->fetch_class());?></a></li>
                    <li>/</li>
                    <li><a href="javascript:;"><?php echo $searchData['dest_city'];?></a></li>
                    <li>/</li>                  
                    <li><a href="javascript:;" class=""><?php echo $hotel_data['name'];?></a></li>  
                    <li>/</li>                  
                    <li><a href="javascript:;" class="active">Booking</a></li>     
                   
                </ul>               
            </div>
            <a class="backbtn right" href="#"></a>
        </div>
        <div class="clearfix"></div>
        <div class="brlines"></div>
    </div>  
    <!-- / Breadcrumbs -->
        <div class="container re_pad0">
            <div class="col-md-12 re_pad0">
                <?php if(isset($depositBalance) && ($totalPrice  > $depositBalance)){ ?>
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <strong>Low Balance!</strong> Your account deposit balance is lower than the hotel booking cost. Kindly add deposit then book the hotel.
                    </div>
                </div>
                <?php } ?>
                <div class="col-md-12 re_padleft0">
                    <h4>Traveler Details</h4>
                </div>
               
            </div>
            <div class="col-md-12 re_pad0">
                <div class="col-md-9 re_padleft0 re_padbottom20">
                    <div class="col-md-12 re_padleft0">
                        <div class="col-md-12 hotel-item"  style="padding-top:15px; padding-bottom:15px;">
                            <div class="col-md-4 re_padleft0">
                                <?php 
                                    if($api_id == 2){
                                ?>
                                    <img src="<?php echo $photo_url; ?>" alt="">
                                <?php
                                    } else {
                                ?>
                                <img src="<?php echo base_url(); ?>assets/images/img/11.jpg" alt="">
                                    <?php } ?>
                            </div>
                            <div class="col-md-8 re_padleft0">
                                <h4><?php echo $hotel_data['name']; ?></h4>
                                <div class="col-md-12 re_padleft0" style="padding-bottom: 10px;">
                                    <?php if($star == 1){ ?>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <?php } else if($star == 1.5){ ?>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star-half-o pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <?php } else if($star == 2){ ?>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <?php } else if($star == 2.5){ ?>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-half-o pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <?php } else if($star == 3){ ?>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <?php } else if($star == 3.5){ ?>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star-half-o pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <?php } else if($star == 4){ ?>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <?php } else if($star == 4.5){ ?>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-half-o pull-left" aria-hidden="true"></i>
                                    <?php } else if($star == 5){ ?>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i><i class="fa fa-star pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star pull-left" aria-hidden="true"></i>
                                    <?php } else { ?>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i><i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <i class="fa fa-star-o pull-left" aria-hidden="true"></i>
                                    <?php } ?>
                                </div>
                                
                                <p class="re_marbottom0"><?php echo $address; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php if(isset($bookingPrepare) && $bookingPrepare != ''){ ?>
                    <div class="col-md-12 re_padleft0">
                        <div class="col-md-12 re_pad0">
                            <h5>Cancellation and Notes</h5>
                        </div>
                        <?php $i = 0; ?>
                        <?php if($bookingPrepare != ''){ ?>
                        <?php if($api_id == 1){ ?>
                        <div class="col-md-12 hotel-item">
                        <?php foreach($bookingPrepare['rooms'] as $room){ ?>
                            <div class="col-md-12 re_pad0"><h6>Room <?php echo ($i+1); ?></h6></div>
                            <div class="col-md-12 re_pad0">
                                <?php 
                                    if(isset($room['message']) && !empty($room['message'])){
                                        echo '<p>'.$room['message'][0]['Text'].'</p>';
                                    }

                                    $cancel_policy = '';
                                    
                                    foreach ($room['cancelData'] as $key => $value) {
                                        $roomPrice = $value['Amount'];
                                        if($cur_val != 0){ $roomPrice = $roomPrice*number_format((float)$cur_val, 2, '.', ''); }
                                        
                                        if($admin_markup['type'] == 'fixed'){
                                            $mTyp = $searchData['type'];
                                            $roomPrice = $roomPrice+$admin_markup[$mTyp];
                                        } else {
                                            $mTyp = $searchData['type'];
                                            $roomPrice = ((($admin_markup[$mTyp]/100)*$roomPrice)+$roomPrice);
                                        }

                                        if($agent_markup['type'] == 'fixed'){
                                            $amTyp = $searchData['type'];
                                            $roomPrice = $roomPrice+$agent_markup[$amTyp];
                                        } else {
                                            $amTyp = $searchData['type'];
                                            $roomPrice = ((($agent_markup[$amTyp]/100)*$roomPrice)+$roomPrice);
                                        }
                                       
                                        $cancel_policy .= "Cancellation penalty for cancellation done on or after <b>" . ($value['from']) . "</b> before the check in date <b>" . $searchData['cin'] . "</b> , <b>&#8369; ".number_format($roomPrice,2,'.',',') . "</b> will be charged.<br />";
                                    }
                                    echo '<p>'.$cancel_policy.'</p>';
                                ?>
                            </div>
                        <?php $i++; ?>
                        <?php } ?>
                        </div>
                        <?php } else if($api_id == 2){ ?>
                        <div class="col-md-12 re_pad0">
                                <?php 
                                    if(isset($bookingPrepare['cancelInfo']) && !empty($bookingPrepare['cancelInfo'])){
                                        echo '<p>'.$bookingPrepare['cancelInfo'].'</p>';
                                    }

                                    $cancel_policy = '';
                                    if($bookingPrepare['cancelData'] != ''){
                                        $cancelDataArr = explode('<br>',$bookingPrepare['cancelData']);
                                        $c = 0;
                                        foreach($cancelDataArr as $cancel){
                                            if($c < count($cancelDataArr)-1){
                                                $cancelData = explode('|',$cancel);
                                                if($cancelData[2] == 'Amount'){
                                                    $roomPrice = $cancelData[3];
                                                    if($admin_markup['type'] == 'fixed'){
                                                        $mTyp = $searchData['type'];
                                                        $roomPrice = $roomPrice+$admin_markup[$mTyp];
                                                    } else {
                                                        $mTyp = $searchData['type'];
                                                        $roomPrice = ((($admin_markup[$mTyp]/100)*$roomPrice)+$roomPrice);
                                                    }

                                                    if($agent_markup['type'] == 'fixed'){
                                                        $amTyp = $searchData['type'];
                                                        $roomPrice = $roomPrice+$agent_markup[$amTyp];
                                                    } else {
                                                        $amTyp = $searchData['type'];
                                                        $roomPrice = ((($agent_markup[$amTyp]/100)*$roomPrice)+$roomPrice);
                                                    }
                                                } else {
                                                    $roomPrice = $cancelData[3];
                                                }
                                                
                                                if($cancelData[2] == 'Amount'){
                                                    $val = 'an amount of '.$cancelData[4].' '.$cancelData[3].' will be charged.';
                                                } else {
                                                    $val = $cancelData[3].' percentage of room price will be charged.';
                                                }
                                                $cancel_policy .= "Cancellation penalty for cancellation done between <b>" . ($cancelData[0]) . "</b> and <b>".($cancelData[1])."</b> , ".$val."  <br />";
                                            }
                                            
                                            $c++;
                                        }
                                    }
                                    echo '<p>'.$cancel_policy.'</p>';   
                                 ?>
                                </div>
                        <?php } else {
                            echo '';
                        } ?>
                        <?php if($api_id == 3){ ?>
                        <div class="col-md-12 re_pad0">
                            <h5 class="text-info">Contract Comment (or) Trems && Condtions</h5>
                        </div>

                        <div class="col-md-12 re_pad0">
                            <p><?php echo ($bookingPrepare['TermsAndConditions']!='')?$bookingPrepare['TermsAndConditions']:'N/A';?></p>
                        </div>
                        <?php } ?>
                        <div class="col-md-12 re_pad0">
                            <h5>Passenger Details</h5>
                        </div>
                        <form name="booking" method="POST" action="<?php echo site_url(); ?>/hotel/booking_process">  
                            <?php for ($i = 0; $i < $searchData['room_count']; $i++){ ?>
                            <div class="col-md-12 hotel-item">
                                <div class="col-md-12 re_pad0"><h6>Room <?php echo ($i+1); ?></h6></div>
                                <?php for ($j = 0; $j < $searchData['adult'][$i]; $j++){ ?>
                                <div class="col-md-12 re_pad0">
                                    <div class="col-md-2 re_padleft0">
                                        <p class="re_padtop31">Adult <?php echo ($j+1); ?> :</p>
                                    </div>
                                    <div class="col-md-2 re_padleft0">
                                        <label for="exampleInputEmail1">Title:</label>
                                        <select class="form-control" name="adulttitle[<?php echo $i; ?>][]" required>
                                            <option value="Mr">Mr</option>
                                            <option value="Mrs">Mrs</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 re_padleft0">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">First Name</label>
                                                <input type="text" class="form-control" name="adultFname[<?php echo $i; ?>][]" required placeholder="First Name">
                                            </div>
                                    </div>
                                    <div class="col-md-4 re_padleft0">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Last Name</label>
                                                <input type="text" class="form-control" name="adultLname[<?php echo $i; ?>][]" required placeholder="Last Name">
                                            </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php 
                                    if(isset($searchData['child'][$i]) && $searchData['child'][$i] > 0){
                                        for ($k = 0; $k < $searchData['child'][$i]; $k++){
                                ?>
                                        <div class="col-md-12 re_pad0">
                                            <div class="col-md-2 re_padleft0">
                                                <p class="re_padtop31">Child <?php echo ($k+1); ?> :</p>
                                            </div>
                                            <div class="col-md-2 re_padleft0">
                                                <label for="exampleInputEmail1">Title:</label>
                                                <select class="form-control" name="childtitle[<?php echo $i; ?>][]" required>
                                                    <option value="Mr">Mr</option>
                                                    <option value="Mrs">Mrs</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 re_padleft0">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">First Name</label>
                                                        <input type="text" class="form-control" name="childFname[<?php echo $i; ?>][]" required placeholder="First Name">
                                                    </div>
                                            </div>
                                            <div class="col-md-4 re_padleft0">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Last Name</label>
                                                        <input type="text" class="form-control" name="childLname[<?php echo $i; ?>][]" placeholder="Last Name">
                                                    </div>
                                            </div>
                                        </div>
                                <?php
                                        }
                                    }
                                ?>
                            </div>
                            <?php } ?>

                            <div class="col-md-12 re_pad0">
                                <h5>Enter Your Personal Information(Note : voucher will be sent to the below email id.)</h5>
                            </div>
                            <div class="col-md-12 hotel-item" style="padding-top:15px; padding-bottom:15px;">
                                
                                <div class="col-md-12 re_pad0">

                                    <div class="col-md-4 re_padleft0">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email id</label>
                                                <input type="email" class="form-control" name="user_email" required placeholder="Email id">
                                            </div>
                                    </div>
                                    <div class="col-md-4 re_padleft0">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Phone Number</label>
                                                <input type="text" class="form-control" name="user_mobile" required placeholder="Phone Number">
                                            </div>
                                    </div>
                                    <div style="clear:both;"></div>
                                    <div class="col-md-12 re_pad0"><hr></div>
                                </div>
                                <input type="hidden" name="aid" value="<?php echo $api_id; ?>">
                                <input type="hidden" name="mid" value="<?php echo $id; ?>">
                                <input type="hidden" name="rid" value="<?php echo $room_id; ?>">
                                <div class="col-md-12 re_pad0">

<!--                                    <div class="col-md-4 re_padleft0">
                                        <form>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email id</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email id">
                                            </div>
                                        </form>
                                    </div>-->
<!--                                    <div class="col-md-3 re_padleft0">
                                        <input type="submit" name="submit" value="Redeem" id="agent_login_submit" class="_travelRegister btn orange" onclick="return validateAgentLogin();" style="background: #f74623;border-color:#f74623;color:#ffffff; margin-top: 24px;">
                                    </div>-->
                                    <div style="clear:both;"></div>
                                    <?php if(isset($depositBalance) && ($totalPrice  > $depositBalance)){ ?>
                                    <div class="col-md-3 re_padleft0">
                                        <input type="submit" name="submit" value="Continue to Payment" id="agent_login_submit" class="_travelRegister btn orange" onclick="return validateAgentLogin();" style="background: #f74623;border-color:#f74623;color:#ffffff;">
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php } else { ?>
                    <div class="col-md-12 re_pad0">
                        <h5>Oop's! This room is no longer available. Try searching again and book the hotel. </h5>
                    </div>
                   <?php } ?>
                    
                </div>
                <?php } ?>
                <?php if(isset($bookingPrepare) && $bookingPrepare != ''){ ?>
                <div class="col-md-3 re_padright0">
                    <div class="col-md-12 hotel-item">
                        <div class="col-md-12 re_padleft0">
                            <h5>Your Booking Details</h5>
                        </div>
                        <div class="col-md-12 re_pad0">
                            <hr class="re_martop0">
                        </div>
                        <div class="col-md-12 re_pad0">
                            <div class="col-md-4 re_pad0">
                                <p class="re_font13">Check In :</p>
                            </div>
                            <div class="col-md-8 re_pad0">
                                <p class="re_font12"><?php echo date('D d, M, Y',strtotime($searchData['cin'])); ?></p>
                            </div>
                        </div>
                        <div class="col-md-12 re_pad0">
                            <hr class="re_martop0">
                        </div>
                        <div class="col-md-12 re_pad0">
                            <div class="col-md-4 re_pad0">
                                <p class="re_font13">Check Out :</p>
                            </div>
                            <div class="col-md-8 re_pad0">
                                <p class="re_font12"><?php echo date('D d, M, Y',strtotime($searchData['cout'])); ?></p>
                            </div>
                        </div>
                        <div class="col-md-12 re_pad0">
                            <hr class="re_martop0">
                        </div>
                        <div class="col-md-12 re_pad0">
                            <div class="col-md-5 re_pad0">
                                <p class="re_font13">Total stay:</p>
                            </div>
                            <div class="col-md-7 re_pad0">
                                <p class="re_font12"><?php echo $searchData['nights']; ?> night(s)</p>
                            </div>
                        </div>
                        <div class="col-md-12 re_pad0">
                            <hr class="re_martop0">
                        </div>
                        <div class="col-md-12 re_pad0">
                            <div class="col-md-4 re_pad0">
                                <p class="re_font13">You selected :</p>
                            </div>
                            <div class="col-md-8 re_pad0">
                                <p class="re_font12">
                                    <?php
                                    if($api_id == 1){
                                        echo $bookingPrepare['rooms'][0]['room_type_text']; 
                                    } else if($api_id == 2){
                                        echo $room_data['RoomName']; 
                                    } else if($api_id == 3){
                                        echo $room_data['Type'];
                                    } else {
                                        echo '';
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                        <?php if($api_id == 3){ ?>
                        <div class="col-md-12 re_pad0">
                            <hr class="re_martop0">
                        </div>
                        <div class="col-md-12 re_pad0">
                            <div class="col-md-4 re_pad0">
                                <p class="re_font13">Room Description :</p>
                            </div>
                            <div class="col-md-8 re_pad0">
                                <p class="re_font12">
                                    <?php 
                                        echo($roomDesc!='')?$roomDesc:'N/A'; 
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-12 re_pad0">
                            <div class="col-md-4 re_pad0">
                                <p class="re_font13">BoardBasis / Meal Plan :</p>
                            </div>
                            <div class="col-md-8 re_pad0">
                                <p class="re_font12"><?php echo($room_data['BoardBasis']!=null ? $room_data['BoardBasis']:'N/A'); ?></p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col-md-12 hotel-item">
                        <div class="col-md-12 re_padleft0">
                            <h5>Price Details</h5>
                        </div>
                        <div class="col-md-12 re_pad0">
                            <hr class="re_martop0">
                        </div>
                        <?php 
                        $i = 0;
                        $totalPrice = 0;
                        if($bookingPrepare != ''){
                            foreach($bookingPrepare['rooms'] as $room){
                            $roomPrice = $room['TotalSellingPrice'];
                            if($cur_val != 0){ $roomPrice = $roomPrice*number_format((float)$cur_val, 2, '.', ''); }
                            if($i == 0){
                                if($admin_markup['type'] == 'fixed'){
                                    $mTyp = $searchData['type'];
                                    $roomPrice = $roomPrice+$admin_markup[$mTyp];
                                } else {
                                    $mTyp = $searchData['type'];
                                    $roomPrice = ((($admin_markup[$mTyp]/100)*$roomPrice)+$roomPrice);
                                }

                                if($agent_markup['type'] == 'fixed'){
                                    $amTyp = $searchData['type'];
                                    $roomPrice = $roomPrice+$agent_markup[$amTyp];
                                } else {
                                    $amTyp = $searchData['type'];
                                    $roomPrice = ((($agent_markup[$amTyp]/100)*$roomPrice)+$roomPrice);
                                }
                            }
                        ?>
                        Room <?php echo ($i+1); ?>
                        <div class="col-md-12 re_pad0">
                            <div class="col-md-6 re_pad0">
                                <p class="re_font13">Base Price :</p>
                            </div>
                            <div class="col-md-6 re_pad0">
                                <p class="re_font12">&#8369; <?php echo number_format($roomPrice,2,'.',','); ?></p>
                            </div>
                        </div>
                        <div class="col-md-12 re_pad0">
                            <hr class="re_martop0">
                        </div>
                        <div class="col-md-12 re_pad0">
                            <div class="col-md-6 re_pad0">
                                <p class="re_font13">Taxes and Fees:</p>
                            </div>
                            <div class="col-md-6 re_pad0">
                                <p class="re_font12">&#8369; 0.00</p>
                            </div>
                        </div>
                        
                        <?php 
                                $totalPrice = $totalPrice+$roomPrice;
                                $i++;
                            }
                        } 
                        ?>
                        
                        <div class="col-md-12 re_pad0">
                            <hr class="re_martop0">
                        </div>
                        <div class="col-md-12 re_pad0">
                            <div class="col-md-6 re_pad0">
                                <h5 class="re_martop0">Total Price</h5>
                            </div>
                            <div class="col-md-6 re_pad0">
                                <p class="re_font12" style="font-weight: bold;padding-top: 4px;font-size: 14px;">&#8369; <?php echo number_format($totalPrice,2,'.',','); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 hotel-item" style="padding-top:20px; padding-bottom:25px;">
                        <div class="col-md-12 re_pad0">
                            <h5 class="re_mar0">Need Redtag Help?</h5>
                        </div>
                        <div class="col-md-12 re_pad0">
                            <p class="re_font13" style="color:#515151;">We would be happy to help you!</p>
                        </div>
                        <div class="col-md-12 re_pad0">
                            <span class="glyphicon glyphicon-earphone"></span>
                            <a href="tel:(63) (02) 8012620, +639253115987">(63) (02) 8012620 / +639253115987</a>
                        </div>
                    </div>

                </div>
                
                <?php } ?>
            </div>
            
        </div>
           </section>
        <div style="clear:both;"></div>
    <!--######################### FOOTER STARTS HERE #################################################################-->
    <?php $this->load->view('common/footer'); ?>
    <!--######################### FOOTER ENDS HERE #################################################################-->
