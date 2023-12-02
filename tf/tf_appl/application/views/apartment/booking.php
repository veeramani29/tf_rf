<?php $this->load->view('common/header');
$language = $this->session->userdata('language');
if($language){
  $this->lang->load('Booking_Page_BP', $language);
}else{
  $this->lang->load('Booking_Page_BP', 'english');
}
?>
<div class="lodrefrentwhole"><div class="centerload"></div></div><div class="full marintopcnt witebackgrnd"><div class="container fordetailpage dontpad"><div class="container paymentpage"><?php
$Acount = 0;$Fcount = 0;$Hcount = 0;$Ccount = 0;
$Vcount = 0;
$Total = array();
foreach($cart_global as $key => $cid){
  list($module, $cid) = explode(',', $cid);
  if($module == 'APARTMENT'){
    $Acount = $Acount+1;
  }
  if($module == 'FLIGHT'){
    $Fcount = $Fcount+1;
  }
  if($module == 'HOTEL'){
    $Hcount = $Hcount+1;
  }
  if($module == 'CAR'){
    $Ccount = $Ccount+1;
  }
  if($module == 'VACATION'){
    $Vcount = $Vcount+1;
  }
}
?>
<?php
foreach($cart_global as $key => $cid){
  list($module, $cid) = explode(',', $cid);
  if($module == 'APARTMENT'){
    $book_temp_data = $this->apartment_model->getBookingTemp($cid)->row();
    $Totall[] = $book_temp_data->total;
  }
  if($module == 'FLIGHT'){
    $cart = $this->flight_model->getBookingTemp($cid)->row();
//echo '<pre>';print_r($book_temp_data);
    $Totall[] = $cart->total;
  }
  if($module == 'HOTEL'){
    $cart = $this->hotel_model->getBookingTemp($cid)->row();
    $Totall[] = $cart->total;
  }
  if($module == 'CAR'){
    $cart = $this->car_model->getBookingTemp($cid)->row();
    $Totall[] = $cart->total;
  }
  if($module == 'VACATION'){
    $cart = $this->vacation_model->getBookingTemp($cid)->row();
    $Totall[] = $cart->total;
  }
}
?>
<div class="col-md-4 col-xs-4 nopad sidebuki">
  <div class="cartbukdis">
    <ul class="liscartbuk">
      <?php
      foreach($cart_global as $key => $cid){
        list($module, $cid) = explode(',', $cid);
        ?>
        <?php
        if($module == 'FLIGHT'){
          $cart = $this->cart_model->getCartDataByModule($cid,$module)->row();
          $request = json_decode(base64_decode($cart->request));
          if($request->type == 'O' || $request->type == 'R'){
            $originCity = $this->flight_model->get_airport_cityname($request->origin);
            $destinationCity = $this->flight_model->get_airport_cityname($request->destination);
            $origin = $request->origin;
            $destination = $request->destination;
          }else if ($request->type == 'M') {
//echo '<pre>';print_r($request);die;
            $origin = reset($request->origin);
            $destination = end($request->destination);
            $originCity = $this->flight_model->get_airport_cityname($origin);
            $destinationCity = $this->flight_model->get_airport_cityname($destination);
          }
          ?>
          <li class="lostcart">
            <div class="cartlistingbuk">
              <div class="cartitembuk">
                <div class="col-md-3 celcart">
                  <a class="smalbukcrt"><img src="<?php echo $cart->AirImage;?>" alt=""/></a>
                </div>
                <div class="col-md-8 splcrtpad celcart">
                  <div class="carttitlebuk"><?php echo $originCity.' ('.$origin.') - '.$destinationCity.' ('.$destination.')';?></div>
                  <!-- <div class="cartstar"><img src="<?php echo ASSETS;?>images/bigrating-4.png" alt="" /></div> -->
                  <div class="cartsec"><?php echo date('d M, Y H:i', $cart->DepartureTime).' - '.date('d M, Y H:i', $cart->ArrivalTime);?></div>
                </div>
                <div class="col-md-1 cartfprice celcart">
                  <div class="cartprc">
                    <div class="singecartpricebuk"><?php echo CURR_ICON?><?php echo $cart->TotalPrice;?></div>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <?php }?>
          <?php
          if($module == 'APARTMENT'){
            $cart = $this->cart_model->getCartDataByModule($cid,$module)->row();
            ?>
            <li class="lostcart">
              <div class="cartlistingbuk">
                <div class="cartitembuk">
                  <div class="col-md-3 celcart">
                    <a class="smalbukcrt"><img src="<?php echo $this->apartment_model->view_property_file($cart->PROP_PHOTO);?>" alt=""/></a>
                  </div>
                  <div class="col-md-8 splcrtpad celcart">
                    <div class="carttitlebuk"><?php echo $cart->PROP_NAME;?></div>
                    <!-- <div class="cartstar"><img src="<?php echo ASSETS;?>images/bigrating-4.png" alt="" /></div> -->
                    <div class="cartsec"><?php echo $cart->PROP_ADDR1.', '.$cart->PROP_CITY.', '.$cart->PROP_REGION.', '.$cart->PROP_COUNTRY_NAME;?></div>
                  </div>
                  <div class="col-md-1 cartfprice celcart">
                    <div class="cartprc">
                      <div class="singecartpricebuk"><?php echo CURR_ICON?><?php echo $cart->TOTAL;?></div>
                      <!-- <div class="moreapbk  collasped" data-target="#collapse201" data-toggle="collapse" >More</div> -->
                    </div>
                  </div>
                </div>
<!--
<div class="collapse" id="collapse201">
datail
</div> -->
</div>
</li>
<?php }?>
<?php
if($module == 'HOTEL'){
  $cart = $this->cart_model->getCartDataByModule($cid,$module)->row();
  ?>
  <li class="lostcart">
    <div class="cartlistingbuk">
      <div class="cartitembuk">
        <div class="col-md-3 celcart">
          <a class="smalbukcrt"><img src="<?php echo $cart->imageurl;?>" alt=""/></a>
        </div>
        <div class="col-md-8 splcrtpad celcart">
          <div class="carttitlebuk"><?php echo $cart->hotel_name.' ('.$cart->room_name.')';?></div>
          <!-- <div class="cartstar"><img src="<?php echo ASSETS;?>images/bigrating-4.png" alt="" /></div> -->
          <div class="cartsec"><?php echo $cart->city;?></div>
        </div>
        <div class="col-md-1 cartfprice celcart">
          <div class="cartprc">
            <div class="singecartpricebuk"><?php echo CURR_ICON?><?php echo $cart->total_cost;?></div>
            <!-- <div class="moreapbk  collasped" data-target="#collapse201" data-toggle="collapse" >More</div> -->
          </div>
        </div>
      </div>
<!--
<div class="collapse" id="collapse201">
datail
</div> -->
</div>
</li>
<?php }?>
<?php
if($module == 'CAR'){
  $cart = $this->cart_model->getCartDataByModule($cid,$module)->row();
  ?>
  <li class="lostcart">
    <div class="cartlistingbuk">
      <div class="cartitembuk">
        <div class="col-md-3 celcart">
          <a class="smalbukcrt"><img src="<?php echo $cart->CarImage;?>" alt=""/></a>
        </div>
        <div class="col-md-8 splcrtpad celcart">
          <div class="carttitlebuk"><?php echo $cart->pickupCityName.' ('.$cart->Pickup.') - '.$cart->dropoffCityName.' ('.$cart->Dropoff.')';?></div>
          <!-- <div class="cartstar"><img src="<?php echo ASSETS;?>images/bigrating-4.png" alt="" /></div> -->
          <div class="cartsec"><?php echo date('d M, Y H:i', $cart->DepartureTime).' - '.date('d M, Y H:i', $cart->ReturnTime);?></div>
        </div>
        <div class="col-md-1 cartfprice celcart">
          <div class="cartprc">
            <div class="singecartpricebuk"><?php echo CURR_ICON?><?php echo $cart->TotalPrice;?></div>
            <!-- <div class="moreapbk  collasped" data-target="#collapse201" data-toggle="collapse" >More</div> -->
          </div>
        </div>
      </div>
<!--
<div class="collapse" id="collapse201">
datail
</div> -->
</div>
</li>
<?php }?>
<?php
if($module == 'VACATION'){
  $cart = $this->cart_model->getCartDataByModule($cid,$module)->row();
  $vacation = json_decode(base64_decode($cart->response));
  ?>
  <li class="lostcart">
    <div class="cartlistingbuk">
      <div class="cartitembuk">
        <div class="col-md-3 celcart">
          <a class="smalbukcrt"><img src="<?php echo $cart->VacationImage;?>" alt=""/></a>
        </div>
        <div class="col-md-8 splcrtpad celcart">
          <div class="carttitlebuk"><?php echo $cart->vacCityName.' ('.$cart->city.') - '.date('d M, Y H:i', strtotime($cart->vacDate));?></div>
          <!-- <div class="cartstar"><img src="<?php echo ASSETS;?>images/bigrating-4.png" alt="" /></div> -->
          <div class="cartsec"><?php echo $vacation->package_name.' - '.$vacation->package_type;?></div>
        </div>
        <div class="col-md-1 cartfprice celcart">
          <div class="cartprc">
            <div class="singecartpricebuk"><?php echo CURR_ICON?><?php echo $cart->TotalPrice;?></div>
            <!-- <div class="moreapbk  collasped" data-target="#collapse201" data-toggle="collapse" >More</div> -->
          </div>
        </div>
      </div>
<!--
<div class="collapse" id="collapse201">
datail
</div> -->
</div>
</li>
<?php }?>
<?php }?>
<li class="lostcart">
  <div class="cartlistingbuk">
    <div class="cartitembuk">
      <div class="col-md-12">
        <div class="payblnhmxm"><?php echo $this->lang->line('BP_Promo'); ?></div>
      </div>
    </div>
    <div class="clear"></div>
    <div class="cartitembuk prompform">
      <form id="promocode" name="promocode" action="<?php echo WEB_URL;?>/booking/promo">
        <div class="col-md-8 col-xs-8">
          <div class="cartprc">
            <input type="hidden" name="total" value="<?php echo base64_encode(array_sum($Totall)); ?>">
            <input type="hidden" name="cid" id="cid" value="<?php echo $cart_global_id;?>"/>
            <div class="payblnhm singecartpricebuk ritaln">
              <input type="text" class="promocode" id="code" name="code" placeholder="<?php echo $this->lang->line('BP_Enter_Promo'); ?>" required/>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xs-4">
          <input type="submit" class="promosubmit" name="apply" value="<?php echo $this->lang->line('BP_Apply'); ?>" />
        </div>
      </form>
    </div>
    <div class="clear"></div>
    <div class="savemessage"></div>
  </div>
</li>
<li class="lostcart">
  <div class="cartlistingbuk">
    <div class="cartitembuk">
      <div class="col-md-8 celcart">
        <div class="payblnhm"><?php echo $this->lang->line('BP_SubTotal'); ?></div>
      </div>
      <div class="col-md-4 celcart">
        <div class="cartprc">
          <div class="ritaln cartcntamnt normalprc"><?php echo CURR_ICON?><?php echo array_sum($Totall);?></div>
        </div>
      </div>
    </div>
    <div class="cartitembuk">
      <div class="col-md-8 celcart">
        <div class="payblnhm"><?php echo $this->lang->line('BP_SubTotal'); ?></div>
      </div>
      <div class="col-md-4 celcart">
        <div class="cartprc">
          <div class="ritaln cartcntamnt normalprc discount"><?php echo CURR_ICON?><span class="amount">0.00</span></div>
        </div>
      </div>
    </div>
  </div>
  <div class="clear"></div>
  <div class="cartlistingbuk nomarr">
    <div class="cartitembuk">
      <div class="col-md-8 celcart">
        <div class="payblnhm"><?php echo $this->lang->line('BP_Total'); ?></div>
      </div>
      <div class="col-md-4 celcart">
        <div class="cartprc">
          <div class="ritaln cartcntamnt bigclrfnt finalAmt"><?php echo CURR_ICON?><span class="amount"><?php echo array_sum($Totall);?></span></div>
        </div>
      </div>
    </div>
  </div>
</li>
</ul>
</div>
</div>
<div class="col-md-8 col-xs-8 nopad fulbuki">
  <form name="checkout-apartment" id="checkout-apartment" autocomplete="off" action="<?php echo WEB_URL;?>/booking/checkout">
    <div class="col-md-12 padleftpay">
      <div class="wrappay">
        <h3 class="inpagehed"><?php echo $this->lang->line('BP_Traveller'); ?></h3>
        <?php if($Acount > 0){?>
        <div class="sectionbuk">
          <button class="collapsebtn2 bukcolsp" data-target="#collapse101" data-toggle="collapse" type="button">
            <?php echo $this->lang->line('BP_A_Bookings'); ?> (<?php echo $Acount;?>)
            <span class="collapsearrow"></span>
            <span class="editbuk"><?php echo $this->lang->line('BP_Edit'); ?></span>
          </button>
          <div class="collapse in" id="collapse101">
            <?php
            $i=1;
            foreach($cart_global as $key => $cid){
              list($module, $cid) = explode(',', $cid);
              if($module == 'APARTMENT'){
                $book_temp_data = $this->apartment_model->getBookingTemp($cid)->row();
                $Total[] = $book_temp_data->total;
// echo '<pre>';print_r($book_temp_data);die;
                if(isset($book_temp_data->profile_photo) && $book_temp_data->profile_photo != "") {
                  $profile_photo = $book_temp_data->profile_photo;
                } else if(isset($book_temp_data->agent_logo) && $book_temp_data->agent_logo != "") {
                  $profile_photo = $book_temp_data->agent_logo;
                } else {
                  $profile_photo = ASSETS.'images/user-avatar.jpg';
                }
                ?>
                <div class="onedept">
                  <h3 class="inpagehedbuk">
                    <span class="bookingcnt"><?php echo $i;?>. </span>
                    <span class="aptbokname"><?php echo $book_temp_data->PROP_NAME;?> </span>
                    <span class="brktnit">(<?php echo $book_temp_data->NIGHTS;?> <?php echo $this->lang->line('BP_Nights'); ?>)</span>
                  </h3>
                  <div class="payrow">
                    <div class="col-md-6">
                      <div class="paylabel"><?php echo $this->lang->line('BP_Fname'); ?></div>
                      <input type="text" name="first_name<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_firstname != NULL){echo $userInfo->billing_firstname;}?>" required/>
                    </div>
                    <div class="col-md-6">
                      <div class="paylabel"><?php echo $this->lang->line('BP_Lname'); ?></div>
                      <input type="text" name="last_name<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_lastname != NULL){echo $userInfo->billing_lastname;}?>" required/>
                    </div>
                  </div>
                  <div class="payrow">
                    <div class="col-md-6">
                      <div class="paylabel"><?php echo $this->lang->line('BP_Email'); echo '<pre/>';print_r($userInfo); ?></div>
                      <input type="text" name="email<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_email != NULL){echo $userInfo->billing_email;}?>" required/>
                    </div>
                    <div class="col-md-6">
                      <div class="paylabel"><?php echo $this->lang->line('BP_Contact'); ?></div>
                      <input type="text" name="mobile<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_contact != NULL){echo $userInfo->billing_contact;}?>" required/>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="offset-2"><hr class="featurette-divider3"></div>
                  <h3 class="inpagehedbuk"><?php echo $this->lang->line('BP_Tell_Host'); ?> <?php echo ucfirst($book_temp_data->firstname);?>, <?php echo $this->lang->line('BP_Hello'); ?></h3>
                  <span class="helosent"><?php echo $this->lang->line('BP_Let'); ?> <?php echo ucfirst($book_temp_data->firstname);?> <?php echo $this->lang->line('BP_Purpose_Of _Trip'); ?></span>
                  <div class="col-md-2 nopad">
                    <div class="userpayreview">
                      <img src="<?php echo $profile_photo;?>" alt="" title="<?php echo $book_temp_data->firstname;?>" />
                    </div>
                  </div>
                  <div class="col-md-10">
                    <textarea class="mesgfrnd" placeholder="<?php echo $this->lang->line('BP_Message_Host'); ?>" name="msg_to_host<?php echo $cid;?>" required></textarea>
                  </div>
                </div>
                <?php $i++;}}?>
              </div>
            </div>
            <?php }?>
            <?php if($Fcount > 0){?>
            <div class="sectionbuk">
              <button class="collapsebtn2 collapsed bukcolsp" data-target="#collapse102" data-toggle="collapse" type="button">
                <?php echo $this->lang->line('BP_F_Bookings'); ?> (<?php echo $Fcount;?>)
                <span class="collapsearrow"></span>
                <span class="editbuk"><?php echo $this->lang->line('BP_Edit'); ?></span>
              </button>
              <div class="collapse" id="collapse102">
                <?php
                $i=1;
                foreach($cart_global as $key => $cid){
//echo '<pre>';print_r($cid);
                  list($module, $cid) = explode(',', $cid);
                  if($module == 'FLIGHT'){
                    $cart = $this->flight_model->getBookingTemp($cid)->row();
//echo '<pre>';print_r($book_temp_data);
                    $Total[] = $cart->total;
                    ?>
                    <div class="onedept">
                      <h3 class="inpagehedbuk">
                        <span class="bookingcnt"><?php echo $i;?>.</span>
                        <span class="aptbokname"><?php echo $cart->fromCityName;?> (<?php echo $cart->Origin;?>) - <?php echo $cart->toCityName;?> (<?php echo $cart->Destination;?>)</span>
                      </h3>
                      <div class="payrow">
                        <div class="col-md-6">
                          <div class="paylabel"><?php echo $this->lang->line('BP_Fname'); ?></div>
                          <input type="text" name="first_name<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_firstname != NULL){echo $userInfo->billing_firstname;}?>" required/>
                        </div>
                        <div class="col-md-6">
                          <div class="paylabel"><?php echo $this->lang->line('BP_Lname'); ?></div>
                          <input type="text" name="last_name<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_lastname != NULL){echo $userInfo->billing_lastname;}?>" required/>
                        </div>
                      </div>
                      <div class="payrow">
                        <div class="col-md-6">
                          <div class="paylabel"><?php echo $this->lang->line('BP_Email'); ?></div>
                          <input type="text" name="email<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_email != NULL){echo $userInfo->billing_email;}?>" required/>
                        </div>
                        <div class="col-md-6">
                          <div class="paylabel"><?php echo $this->lang->line('BP_Contact'); ?></div>
                          <input type="text" name="mobile<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_contact != NULL){echo $userInfo->billing_contact;}?>" required/>
                        </div>
                      </div>
                    </div>
                    <?php $i++;}}?>
                  </div>
                </div>
                <?php }?>
                <?php if($Hcount > 0){?>
                <div class="sectionbuk">
                  <button class="collapsebtn2 collapsed bukcolsp" data-target="#collapse102s" data-toggle="collapse" type="button">
                    <?php echo $this->lang->line('BP_H_Bookings'); ?> (<?php echo $Hcount;?>)
                    <span class="collapsearrow"></span>
                    <span class="editbuk"><?php echo $this->lang->line('BP_Edit'); ?></span>
                  </button>
                  <div class="collapse" id="collapse102s">
                    <?php
                    $i=1;
                    foreach($cart_global as $key => $cid){
//echo '<pre>';print_r($cid);
                      list($module, $cid) = explode(',', $cid);
                      if($module == 'HOTEL'){
                        $cart = $this->hotel_model->getBookingTemp($cid)->row();
                        $Total[] = $cart->total;
//echo '<pre>';print_r($book_temp_data);
                        ?>
                        <div class="onedept">
                          <h3 class="inpagehedbuk">
                            <span class="bookingcnt"><?php echo $i;?>.</span>
                            <span class="aptbokname"><?php echo $cart->hotel_name;?> (<?php echo $cart->room_name;?>)</span>
                          </h3>
                          <div class="payrow">
                            <div class="col-md-6">
                              <div class="paylabel"><?php echo $this->lang->line('BP_Fname'); ?></div>
                              <input type="text" name="first_name<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_firstname != NULL){echo $userInfo->billing_firstname;}?>" required/>
                            </div>
                            <div class="col-md-6">
                              <div class="paylabel"><?php echo $this->lang->line('BP_Lname'); ?></div>
                              <input type="text" name="last_name<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_lastname != NULL){echo $userInfo->billing_lastname;}?>" required/>
                            </div>
                          </div>
                          <div class="payrow">
                            <div class="col-md-6">
                              <div class="paylabel"><?php echo $this->lang->line('BP_Email'); ?></div>
                              <input type="text" name="email<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_email != NULL){echo $userInfo->billing_email;}?>" required/>
                            </div>
                            <div class="col-md-6">
                              <div class="paylabel"><?php echo $this->lang->line('BP_Contact'); ?></div>
                              <input type="text" name="mobile<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_contact != NULL){echo $userInfo->billing_contact;}?>" required/>
                            </div>
                          </div>
                        </div>
                        <?php $i++;}}?>
                      </div>
                    </div>
                    <?php }?>
                    <?php if($Ccount > 0){?>
                    <div class="sectionbuk">
                      <button class="collapsebtn2 collapsed bukcolsp" data-target="#collapse102c" data-toggle="collapse" type="button">
                        <?php echo $this->lang->line('BP_C_Bookings'); ?> (<?php echo $Ccount;?>)
                        <span class="collapsearrow"></span>
                        <span class="editbuk"><?php echo $this->lang->line('BP_Edit'); ?></span>
                      </button>
                      <div class="collapse" id="collapse102c">
                        <?php
                        $i=1;
                        foreach($cart_global as $key => $cid){
//echo '<pre>';print_r($cid);
                          list($module, $cid) = explode(',', $cid);
                          if($module == 'CAR'){
                            $cart = $this->car_model->getBookingTemp($cid)->row();
                            $Total[] = $cart->total;
//echo '<pre>';print_r($book_temp_data);
                            ?>
                            <div class="onedept">
                              <h3 class="inpagehedbuk">
                                <span class="bookingcnt"><?php echo $i;?>.</span>
                                <span class="aptbokname"><?php echo $cart->pickupCityName;?> (<?php echo $cart->Pickup;?>) - <?php echo $cart->dropoffCityName;?> (<?php echo $cart->Dropoff;?>)</span>
                              </h3>
                              <div class="payrow">
                                <div class="col-md-6">
                                  <div class="paylabel"><?php echo $this->lang->line('BP_Fname'); ?></div>
                                  <input type="text" name="first_name<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_firstname != NULL){echo $userInfo->billing_firstname;}?>" required/>
                                </div>
                                <div class="col-md-6">
                                  <div class="paylabel"><?php echo $this->lang->line('BP_Lname'); ?></div>
                                  <input type="text" name="last_name<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_lastname != NULL){echo $userInfo->billing_lastname;}?>" required/>
                                </div>
                              </div>
                              <div class="payrow">
                                <div class="col-md-6">
                                  <div class="paylabel"><?php echo $this->lang->line('BP_Email'); ?></div>
                                  <input type="text" name="email<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_email != NULL){echo $userInfo->billing_email;}?>" required/>
                                </div>
                                <div class="col-md-6">
                                  <div class="paylabel"><?php echo $this->lang->line('BP_Contact'); ?></div>
                                  <input type="text" name="mobile<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_contact != NULL){echo $userInfo->billing_contact;}?>" required/>
                                </div>
                              </div>
                            </div>
                            <?php $i++;}}?>
                          </div>
                        </div>
                        <?php }?>
                        <?php if($Vcount > 0){?>
                        <div class="sectionbuk">
                          <button class="collapsebtn2 collapsed bukcolsp" data-target="#collapse102c" data-toggle="collapse" type="button">
                            <?php echo $this->lang->line('BP_V_Bookings'); ?> (<?php echo $Vcount;?>)
                            <span class="collapsearrow"></span>
                            <span class="editbuk"><?php echo $this->lang->line('BP_Edit'); ?></span>
                          </button>
                          <div class="collapse" id="collapse102c">
                            <?php
                            $i=1;
                            foreach($cart_global as $key => $cid){
//echo '<pre>';print_r($cid);
                              list($module, $cid) = explode(',', $cid);
                              if($module == 'VACATION'){
                                $cart = $this->vacation_model->getBookingTemp($cid)->row();
                                $vacation = json_decode(base64_decode($cart->response));
                                $Total[] = $cart->total;
                                ?>
                                <div class="onedept">
                                  <h3 class="inpagehedbuk">
                                    <span class="bookingcnt"><?php echo $i;?>.</span>
                                    <span class="aptbokname"><?php echo $cart->vacCityName;?> (<?php echo $cart->city;?>) - <?php echo $vacation->package_name;?></span>
                                  </h3>
                                  <div class="payrow">
                                    <div class="col-md-6">
                                      <div class="paylabel"><?php echo $this->lang->line('BP_Fname'); ?></div>
                                      <input type="text" name="first_name<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_firstname != NULL){echo $userInfo->billing_firstname;}?>" required/>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="paylabel"><?php echo $this->lang->line('BP_Lname'); ?></div>
                                      <input type="text" name="last_name<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_lastname != NULL){echo $userInfo->billing_lastname;}?>" required/>
                                    </div>
                                  </div>
                                  <div class="payrow">
                                    <div class="col-md-6">
                                      <div class="paylabel"><?php echo $this->lang->line('BP_Email'); ?></div>
                                      <input type="text" name="email<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_email != NULL){echo $userInfo->billing_email;}?>" required/>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="paylabel"><?php echo $this->lang->line('BP_Contact'); ?></div>
                                      <input type="text" name="mobile<?php echo $cid;?>" class="payinput" value="<?php if($userInfo->billing_contact != NULL){echo $userInfo->billing_contact;}?>" required/>
                                    </div>
                                  </div>
                                </div>
                                <?php $i++;}}?>
                              </div>
                            </div>
                            <?php }?>
                            <br />
                            <br />
                            <h3 class="inpagehed"><?php echo $this->lang->line('BP_Billing_Address'); ?></h3>
                            <div class="payrow">
                              <div class="col-md-6">
                                <div class="paylabel"><?php echo $this->lang->line('BP_Fname'); ?></div>
                                <input type="text" name="first_name" class="payinput" value="<?php if($userInfo->billing_firstname != NULL){echo $userInfo->billing_firstname;} else {echo $userInfo->firstname;} ?>" required/>
                              </div>
                              <div class="col-md-6">
                                <div class="paylabel"><?php echo $this->lang->line('BP_Lname'); ?></div>
                                <input type="text" name="last_name" class="payinput" value="<?php if($userInfo->billing_lastname != NULL){echo $userInfo->billing_lastname;} else {echo $userInfo->lastname;}?>" required/>
                              </div>
                            </div>
                            <div class="payrow">
                              <div class="col-md-6">
                                <div class="paylabel"><?php echo $this->lang->line('BP_Address1'); ?></div>
                                <input type="text" name="street_address" class="payinput" value="<?php if($userInfo->billing_addressA != NULL){echo $userInfo->billing_addressA;}?>" required/>
                              </div>
                              <div class="col-md-6">
                                <div class="paylabel"><?php echo $this->lang->line('BP_Address2'); ?></div>
                                <input type="text" name="address2" class="payinput" value="<?php if($userInfo->billing_addressB != NULL){echo $userInfo->billing_addressB;}?>"/>
                              </div>
                            </div>
                            <input type="hidden" name="cid" id="cid" value="<?php echo $cart_global_id;?>"/>
                            <div class="payrow">
                              <div class="col-md-4">
                                <div class="paylabel"><?php echo $this->lang->line('BP_Email'); ?></div>
                                <input type="text" name="email" class="payinput" value="<?php if($email != NULL){echo $email;}?>" required/>
                              </div>
                              <div class="col-md-4">
                                <div class="paylabel"><?php echo $this->lang->line('BP_Contact'); ?></div>
                                <input type="text" name="mobile" class="payinput" value="<?php if($userInfo->billing_contact != NULL){echo $userInfo->billing_contact;}?>" required/>
                              </div>
                              <div class="col-md-4">
                                <div class="paylabel"><?php echo $this->lang->line('BP_Country'); ?></div>
                                <select class="fpayinselect mySelectBoxClass hasCustomSelect" name="country" required>
                                  <?php foreach($countries as $country){?>
                                  <option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $userInfo->billing_country) ? "selected" : ""; ?> ><?php echo $country->name;?></option>
                                  <?php }?>
                                </select>
                                <!-- <input type="text" name="country" class="payinput" value="<?php if($userInfo->billing_country != NULL){echo $userInfo->billing_country;}?>" required/> -->
                              </div>
                            </div>
                            <div class="payrow">
                              <div class="col-md-4">
                                <div class="paylabel"><?php echo $this->lang->line('BP_City'); ?></div>
                                <input type="text" name="city" class="payinput" value="<?php if($userInfo->billing_city != NULL){echo $userInfo->billing_city;}?>" required/>
                              </div>
                              <div class="col-md-4">
                                <div class="paylabel"><?php echo $this->lang->line('BP_State'); ?></div>
                                <input type="text" name="state" class="payinput" value="<?php if($userInfo->billing_state != NULL){echo $userInfo->billing_state;}?>" required/>
                              </div>
                              <div class="col-md-4">
                                <div class="paylabel"><?php echo $this->lang->line('BP_Postal'); ?></div>
                                <input type="text" name="zip" class="payinput" value="<?php if($userInfo->billing_postal != NULL){echo $userInfo->billing_postal;}?>" required/>
                              </div>
                            </div>
                            <span class="noteclick">
                              <?php echo $this->lang->line('BP_Bookit'); ?>
                            </span>
                            <div class="clearfix"></div>
                            <div class="offset-2"><hr class="featurette-divider3"></div>
                            <div class="clearfix"></div>
                            <div class="clearfix"></div>
                            <div class="offset-2"><hr class="featurette-divider3"></div>
                            <div class="clearfix"></div>
                            <div class="col-md-12 nopad">
                              <div class="leftcheck">
                                <input type="checkbox" id="confirm" name="confirm" class="checkleft" required/>
                              </div>
                              <div class="checkcontent">
                                <label for="confirm"> <?php echo $this->lang->line('BP_Bookit1'); ?><a class="colorbl"><?php echo $this->lang->line('BP_Terms_Of_Service'); ?></a>, <a class="colorbl"><?php echo $this->lang->line('BP_Cancellation_Policy'); ?></a> <?php echo $this->lang->line('BP_And'); ?> <a class="colorbl"><?php echo $this->lang->line('BP_Guest_Policy'); ?></a>.</label>
                              </div>
                            </div>
                            <input type="hidden" id="total_payable" name="total" value="<?php echo base64_encode(array_sum($Total)); ?>"/>
                            <input type="hidden" id="pcode" name="code" value="<?php echo base64_encode('fool'); ?>"/>
                            <div class="clear"></div>
                            <div class="payrowsubmt">
                              <div class="col-md-3 col-xs-3 fulat500 nopad">
                                <input type="submit" class="paysubmit" name="continue" id="continue" value="<?php echo $this->lang->line('BP_Continue'); ?>" disabled/>
                              </div>
                              <div class="col-md-9 col-xs-3 fulat500 nopad">
                                <span class="verifycod"><?php echo $this->lang->line('BP_Verify_ID'); ?></span>
                              </div>
                              <div class="clear"></div>
                              <div class="lastnote">
                                <?php echo $this->lang->line('BP_Payment'); ?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div id="houserules" class="provabpopups popuofixissue">
                <span class="buttonclose pop-close"><span>X</span></span>
                <div class="listingpopupnor">
                  <div class="popuphed">
                    <span class="popbighed">House Rules</span>
                  </div>
                  <div class="popconyent">
                    <div class="poprow">
                      <span class="popupnotes">
                        How can I use simple sql queries with Between-clause if I use Active record? Manual didn’t give any clear guide with that or maybe I’m just blind.
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div id="balancealert" class="provabpopups popuofixissue">
                <span class="buttonclose pop-close"><span>X</span></span>
                <div class="listingpopupnor">
                  <div class="popuphed">
                    <span class="popbighed"><?php echo $this->lang->line('BP_Alert'); ?></span>
                  </div>
                  <div class="popconyent">
                    <div class="poprow">
                      <span class="popupnoteswithout">
                        <?php echo $this->lang->line('BP_No_Balance'); ?>
                      </span>
                    </div>
                  </div>
                  <div class="popfooter">
                    <a href="<?php echo WEB_URL;?>/dashboard/deposit" target="_blank" class="popbutton blubutton"><?php echo $this->lang->line('BP_Deposit'); ?></a>
                    <button class="popbutton pop-close"><?php echo $this->lang->line('BP_Cancel'); ?></button>
                  </div>
                </div>
              </div>
              <script type="text/javascript">
              function inform(){
                $('#balancealert').provabPopup({
                  modalClose: true,
                  zIndex: 10000005
                });
              }
              $(document).ready(function(){
                $('.houserules').click(function(){
                  $('#houserules').provabPopup({
                    modalClose: true,
                    zIndex: 10000005
                  });
                });
                $(".infoside, .smalinfo").tooltip();
                $('#confirm').change(function() {
                  if($(this).prop('checked') == true){
                    $('#continue').removeAttr('disabled');
                  }else{
                    $('#continue').attr('disabled','disabled');
                  }
                });
              });
              </script>
              <?php $this->load->view('common/footer');?>
            </body>
            </html>