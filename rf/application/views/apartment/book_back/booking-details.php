<?php 
$this->load->view('common/header');
error_reporting(0);
$Acount = 0;$Fcount = 0;$Hcount = 0;$Ccount = 0;
$Vcount = 0;
$Total = array();
foreach($cart_global as $key => $cid){
  list($module, $cid) = explode(',', $cid);
  if($module == 'FLIGHT'){
    $Fcount = $Fcount+1;
  }
  if($module == 'HOTEL'){
    $Hcount = $Hcount+1;
  }
}
?>
<script src="<?php echo ASSETS;?>js/star-rating.js"></script>

<div class="container rftarifs_container container_flightdetails">

<div class="lodrefrentrev imgLoader" style="display:none;">
                  <div class="centerload"></div>
                </div>

  <div class="row">
    <div class="col-md-12">
      <div class="fullwidthbg_image">
        <img src="<?php echo ASSETS;?>images/FLIGHTS_BG_RF.svg" class="fd_bgimage fs_title">          
        <div class="fd_content color_white">
          <div class="col-sm-12 nopadd">
            <ul class="nav nav-tabs fd_tabtitle" role="tablist">
              <li role="presentation" >
                <a class="tarifs_show" which-type="<?php echo $module;?>" href="#tarifs" aria-controls="home" role="tab" data-toggle="tab"><?php echo lang_line('TARIFS');?></a>
              </li>
              <li role="presentation" class="<?php echo ($this->uri->segment(3)=='' && $this->input->get('orderId')=='')?"active":"";?>">
                <a href="#information" aria-controls="profile" role="tab" data-toggle="tab"><?php echo lang_line('UR_INFO');?></a>
              </li>
              <li role="presentation" class="<?php echo ($this->uri->segment(3)!='' && $this->input->get('orderId')=='')?"active":"";?>">
                <a href="#overview" aria-controls="messages" role="tab" data-toggle="tab"><?php echo lang_line('OVER_VIEW_PAY');?></a>
              </li>
              <li role="presentation" class="<?php echo ($this->input->get('orderId')!='' && $this->uri->segment(3)=='')?"active":"";?>">
                <a href="#confirmation" aria-controls="settings" role="tab" data-toggle="tab"><?php echo lang_line('CONF');?></a>
              </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content fd_tabcontent">
              <!--first tab-->
              <div role="tabpanel" class="tab-pane" id="tarifs">              
                
              </div>
              <!--second tab-->
              <div role="tabpanel" class="tab-pane <?php echo ($this->uri->segment(3)=='' && $this->input->get('orderId')=='')?"active":"";?>" id="information">

             <?php if($this->session->flashdata('price_change_msg')!=null){ ?>
              <div class="alert alert-success" style="text-align: center;margin: 10px 0px -18px 0px;"><?php echo  $this->session->flashdata('price_change_msg');?></div>
<?php } ?>
                <form class="form-inline flightdetails_form" name="checkout-apartment" role="form" id="checkout-apartment" method="post"  autocomplete="off" action="<?php echo WEB_URL;?>/booking/checkout">
                  <?php
                  $i=1;
                  foreach($cart_global as $key => $cid){
                    list($module, $cid) = explode(',', $cid);
                    if($module == 'FLIGHT'){
                      $a = $this->flight_model->getBookingTemp($cid)->row();
                      if(!empty($a)){
                        $cart=$a;
                        $Total[] = $cart->total;
                      }else{
                        $cart = $this->cart_model->get_booking($cid,$module)->row();
                        $Total[] = $cart->TotalPrice;
                      }
                      $tot_pass = $this->cart_model->getCartDataByModule($cid,$module)->row();
                      $request = json_decode(base64_decode($tot_pass->request));
                      $passenger__price_details=$tot_pass->passenger_details;
                      $from=$cart->fromCityName.","."(".$cart->Origin.")";
                      $to=$cart->toCityName.","."(".$cart->Destination.")";
                      $adults=$request->ADT;
                      $childs=$request->CHD;
                      $infants=$request->INF;
                      $pass_result = compact("adults","childs","infants");
                      $total_passanger=$adults+$childs+$infants;
                      $checkout_user=$this->session->userdata('checkout');
                      ?>
                      <div class="col-xs-12">
                        <div class="spacer30"></div>
                        <h4> <?php echo lang_line('TRAVELLER_DETAILS');?> - <small><?php echo $cart->fromCityName;?> (<?php echo $cart->Origin;?>) - <?php echo $cart->toCityName;?> (<?php echo $cart->Destination;?>)</small></h4>
                        <h5><?php echo lang_line('TRAVELLER');?> 1: <?php echo lang_line('ADULT');?></h5>
                      </div>
                      <input type="hidden" name="passengers" value="<?php echo base64_encode(json_encode($pass_result));?>"/>
                      <input type="hidden" name="passengers_with_price" value="<?php echo $passenger__price_details;?>"/>
                      <input type="hidden"  id="request_data" value="<?php echo $cart->request;?>"/>
                      <div class="col-xs-12 nopadd fd_namecontainer"><!--col-12 start-->
                       <?php  $usertitle=($checkout_user['selTitle'.$cid]!='')?$checkout_user['selTitle'.$cid]:$userInfo->title;?>
                       <div class="col-xs-6 nopadd fd_name">
                        <div class="col-xs-2 padd_r">
                          <label><?php echo lang_line('TITLE');?> *</label>
                          <select class="form-control full_width input_caretdown" name="selTitle<?php echo $cid;?>" id="selTitle<?php echo $cid;?>" required>   
                            <option value="Mr" <?php echo ($usertitle=="Mr")?"selected='selected'":"";?>><?php echo lang_line('MR');?></option>
                            <option value="Mrs" <?php echo ($usertitle=="Mrs")?"selected='selected'":"";?>><?php echo lang_line('MRS');?></option>
                            <option value="Mis" <?php echo ($usertitle=="Mis")?"selected='selected'":"";?>><?php echo lang_line('MIS');?></option>
                            <option value="M/s" <?php echo ($usertitle=="M/s")?"selected='selected'":"";?>><?php echo lang_line('MAST');?></option>
                          </select>
                        </div>
                        <div class="col-xs-5 padd_r">
                          <label for="exampleInputName2"><?php echo lang_line('F_NAME');?> (<?php echo lang_line('AS_PASS');?>) *</label><br>
                          <input type="text" class="form-control full_width"  value="<?php echo($checkout_user['first_name'.$cid]!='')?$checkout_user['first_name'.$cid]:$userInfo->firstname;?>" name="first_name<?php echo $cid;?>" id="first_name<?php echo $cid;?>" placeholder="<?php echo lang_line('F_NAME');?>" required>
                        </div>
                        <div class="col-xs-5">
                          <label for="exampleInputName2"><?php echo lang_line('L_NAME');?> *</label><br>
                          <input type="text" class="form-control full_width" value="<?php echo($checkout_user['last_name'.$cid]!='')?$checkout_user['last_name'.$cid]:$userInfo->lastname;?>"  placeholder="<?php echo lang_line('L_NAME');?>" name="last_name<?php echo $cid;?>" id="last_name<?php echo $cid;?>" required>
                        </div>
                      </div>
                      <div class="col-xs-4 padd_r">
                        <label for="exampleInputName2"><?php echo lang_line('DOB');?> *</label>
                        <ul class="list-inline fd_dateob mar0">
                          <?php
                          if($checkout_user['birth_day'.$cid]!=''){
                            $dobdd=$checkout_user['birth_day'.$cid];
                            $dobmm=$checkout_user['birth_month'.$cid];
                            $dobyy=$checkout_user['birth_year'.$cid];
                            $d_ofbirth=$checkout_user['birth_day'.$cid].'/'.$checkout_user['birth_month'.$cid].'/'.$checkout_user['birth_year'.$cid];
                          }else{
                            $doba=explode("-",$userInfo->dob);
                            $dob_exp=array_reverse($dob_exp);
                            $d_ofbirth=implode("/",$dob_exp);
                            $dobdd=$doba[2];
                            $dobmm=$doba[1];
                            $dobyy=$doba[0];
                          }
                          ?>
                          <li class="date">
                            <select class="form-control input_caretdown" name="birth_day<?php echo $cid;?>" id="birth_day<?php echo $cid;?>" required>
                              <option value=""><?php echo lang_line('DATE');?></option>
                              <?php for($d=1;$d<=31;$d++) {echo  ($d<10)?'<option value="0'.$d.'" '.($d ==$dobdd ? 'selected' : '').'>0'.$d.'</option>':'<option value="'.$d.'" '.($d ==$dobdd ? 'selected' : '').'>'.$d.'</option>'; }?>
                            </select>
                          </li>
                          <li class="month">
                            <select class="form-control input_caretdown" name="birth_month<?php echo $cid;?>" id="birth_month<?php echo $cid;?>" required>                
                              <option value=""><?php echo lang_line('MONTH');?></option>
                              <?php for($m=1;$m<=12;$m++) { echo  ($m<10)?'<option value="0'.$m.'" '.($m ==$dobmm ? 'selected' : '').'>'.date("F",strtotime('2015-' . $m . '-01')).'</option>':'<option value="'.$m.'" '.($m ==$dobmm ? 'selected' : '').'>'.date("F",strtotime('2015-' . $m . '-01')).'</option>'; }?>
                            </select>
                          </li>
                          <li class="year">
                            <select class="form-control input_caretdown" name="birth_year<?php echo $cid;?>" id="birth_year<?php echo $cid;?>" required>                
                              <option value=""><?php echo lang_line('YEAR');?></option>
                              <?php for($y=date("Y");$y>1900;$y--) { echo  ($y<10)?'<option value="0'.$y.'" '.($y ==$dobyy ? 'selected' : '').'>0'.$y.'</option>':'<option value="'.$y.'" '.($y ==$dobyy ? 'selected' : '').'>'.$y.'</option>'; }?>
                            </select>
                          </li>
                        </ul>
                      </div>
                      <?php  $usergender=($checkout_user['selGender'.$cid]!='')?$checkout_user['selGender'.$cid]:$userInfo->gender;?>
                      <div class="col-xs-2">
                        <label><?php echo lang_line('GENDER');?> *</label>
                        <select name="selGender<?php echo $cid;?>"  class="form-control input_caretdown full_width" id="selGender" required="required" >
                          <option value="Female" <?php echo ($usergender=="Female")?"selected='selected'":"";?>><?php echo lang_line('FEMALE');?></option>
                          <option value="Male" <?php echo ($usergender=="Male")?"selected='selected'":"";?>><?php echo lang_line('MALE');?></option>
                        </select>
                      </div>
                    </div><!--col-12 end-->
                    <?php if(array_sum($pass_result) > 1) { ?>
                    <div class="col-xs-12 fd_moreoption"><!--toggle div start-->
                      <button class="btn btn_transparent" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <span class="fa-stack">
                          <i class="fa fa-square fa-stack-2x"></i>
                          <i class="fa fa-<?php echo (array_sum($pass_result) > 1)?"minus":"plus";?> fa-stack-1x"></i>
                        </span>
                        <span class="btn_text"><?php echo lang_line('MORE_TRAVELLERS');?></span>
                      </button>
                      <div class="collapse <?php echo (array_sum($pass_result) > 1)?"in":"";?>" id="collapseExample">
                        <div class="well well_transparent">
                          <?php
                          foreach($pass_result as $key=>$value){
                            if($key=="adults"){
                              $start=1;
                            }else{
                              $start=0;
                            }
                            for($pa=$start;$pa<$value;$pa++){ $sno=$pa+1; ?>
                            <div class="col-xs-12 nopadd">
                              <h5>
                                <?php echo lang_line('TRAVELLER');?> <?php echo ucfirst($key)." ".$sno;?>
                              </h5>
                            </div>
                            <?php
                            $ttt=$key.$sno;
                            $multifname=($checkout_user['pfirst_name'.$cid][$ttt]!='')?$checkout_user['pfirst_name'.$cid][$ttt]:'';
                            $multimname=($checkout_user['pmiddle_name'.$cid][$ttt]!='')?$checkout_user['pmiddle_name'.$cid][$ttt]:'';
                            $multilname=($checkout_user['plast_name'.$cid][$ttt]!='')?$checkout_user['plast_name'.$cid][$ttt]:'';
                            $multidob=$checkout_user['pbirth_year'.$cid][$ttt].$checkout_user['pbirth_month'.$cid][$ttt].$checkout_user['pbirth_day'.$cid][$ttt];
                            $multigender=($checkout_user['pfirst_name'.$cid][$ttt]!='')?$checkout_user['pfirst_name'.$cid][$ttt]:'';
                            $multi_title=($checkout_user['pselTitle'.$cid][$ttt]!='')?$checkout_user['pselTitle'.$cid][$ttt]:'';
                            $doba=explode("-",$multidob);
                            $dobdd=$doba[2];
                            $dobmm=$doba[1];
                            $dobyy=$doba[0];
                            ?>
                            <div class="col-xs-12 nopadd fd_namecontainer"><!--col-12 start-->
                              <div class="col-xs-6 nopadd fd_name">
                                <div class="col-xs-2 nopadd">
                                  <label>Title *</label>
                                  <select class="form-control full_width input_caretdown" name="pselTitle<?php echo $cid;?>[<?php echo $key.$sno;?>]" id="pselTitle<?php echo $cid;?>[<?php echo $key.$sno;?>]" required>   
                                    <option value="Mr" <?php echo ($multi_title=="Mr")?"selected='selected'":"";?>><?php echo lang_line('MR');?></option>
                                    <option value="Mrs" <?php echo ($multi_title=="Mrs")?"selected='selected'":"";?>><?php echo lang_line('MRS');?></option>
                                    <option value="Mis" <?php echo ($multi_title=="Mis")?"selected='selected'":"";?>><?php echo lang_line('MIS');?></option>
                                    <option value="M/s" <?php echo ($multi_title=="M/s")?"selected='selected'":"";?>><?php echo lang_line('MAST');?></option>
                                  </select>
                                </div>
                                <div class="col-xs-5 padd_r">
                                  <label for="exampleInputName2"><?php echo lang_line('F_NAME');?> (<?php echo lang_line('AS_PASS');?>) *</label><br>
                                  <input type="text" class="form-control full_width"  value="<?php echo $multifname;?>" name="pfirst_name<?php echo $cid;?>[<?php echo $key.$sno;?>]" id="pfirst_name<?php echo $cid;?>[<?php echo $key.$sno;?>]" placeholder="<?php echo lang_line('F_NAME');?>" required>
                                </div>
                                <div class="col-xs-5">
                                  <label for="exampleInputName2"><?php echo lang_line('L_NAME');?> *</label><br>
                                  <input type="text" class="form-control full_width"  placeholder="<?php echo lang_line('L_NAME');?>" value="<?php echo $multilname;?>" name="plast_name<?php echo $cid;?>[<?php echo $key.$sno;?>]" id="plast_name<?php echo $cid;?>[<?php echo $key.$sno;?>]" required>
                                </div>
                              </div>
                              <div class="col-xs-4 padd_r">
                                <label for="exampleInputName2"><?php echo lang_line('DOB');?> *</label>
                                <ul class="list-inline fd_dateob mar0">
                                  <li class="date">
                                    <select class="form-control input_caretdown" name="pbirth_day<?php echo $cid;?>[<?php echo $key.$sno;?>]" id="pbirth_day<?php echo $cid;?>[<?php echo $key.$sno;?>]" required>
                                      <option value=""><?php echo lang_line('DATE');?></option>
                                      <?php for($d=1;$d<=31;$d++) { echo  ($d<10)?'<option value="0'.$d.'" '.($d ==$dobdd ? 'selected' : '').'>0'.$d.'</option>':'<option value="'.$d.'" '.($d ==$dobdd ? 'selected' : '').'>'.$d.'</option>'; }?>
                                    </select>
                                  </li>
                                  <li class="month">
                                    <select class="form-control input_caretdown" name="pbirth_month<?php echo $cid;?>[<?php echo $key.$sno;?>]" id="pbirth_month<?php echo $cid;?>[<?php echo $key.$sno;?>]" required>                
                                      <option value=""><?php echo lang_line('MONTH');?></option>
                                      <?php for($m=1;$m<=12;$m++) { echo  ($m<10)?'<option value="0'.$m.'" '.($m ==$dobmm ? 'selected' : '').'>'.date("F",strtotime('2015-' . $m . '-01')).'</option>':'<option value="'.$m.'" '.($m ==$dobmm ? 'selected' : '').'>'.date("F",strtotime('2015-' . $m . '-01')).'</option>'; }?>
                                    </select>
                                  </li>
                                  <li class="year">
                                    <select class="form-control input_caretdown" name="pbirth_year<?php echo $cid;?>[<?php echo $key.$sno;?>]" id="pbirth_year<?php echo $cid;?>[<?php echo $key.$sno;?>]" required>                
                                      <option value=""><?php echo lang_line('YEAR');?></option>
                                      <?php if($key=='childs'){ $year=date("Y")-12; }elseif ($key=='infants') { $year=date("Y")-3; }else{ $year=1900; } ?>

                                      <?php for($y=date("Y");$y>$year;$y--) { echo  ($y<10)?'<option value="0'.$y.'" '.($y ==$dobyy ? 'selected' : '').'>0'.$y.'</option>':'<option value="'.$y.'" '.($y ==$dobyy ? 'selected' : '').'>'.$y.'</option>'; }?>
                                    </select>
                                  </li>
                                </ul>
                              </div>
                              <div class="col-xs-2">
                                <label>Gender *</label>
                                <select class="form-control full_width input_caretdown" name="pselGender<?php echo $cid;?>[<?php echo $key.$sno;?>]"  class="form-control" id="selGender" required >
                                  <option value="Female" <?php echo ($multigender=="Female")?"selected":'';?>><?php echo lang_line('FEMALE');?></option>
                                  <option value="Male" <?php echo ($multigender=="Male")?"selected":'';?>><?php echo lang_line('MALE');?></option>
                                </select>
                              </div>
                            </div><!--col-12 end-->
                            <?php  }
                          } ?>
                        </div>
                      </div>
                    </div><!--toggle div end-->
                    <?php }} //Flight End
                    if($module == 'HOTEL' || $module == 'CAR'){
                      if($module == 'HOTEL'){
                        $a = $this->hotel_model->getBookingTemp($cid)->row();
                      }else{
                       $a = $this->Car_Model->getBookingTemp($cid)->row();
                     }
                     if(!empty($a)){
                      $cart=$a;
                    }else{
                      $cart = $this->cart_model->get_booking($cid,$module)->row();
                    }
                    $Total[] = $cart->total;
                    $CartHotelImage = $cart->imageurl;
                    $CartHotelName = $cart->hotel_name;
                    $CartRoomName = $cart->room_name;
                    $checkout_user=$this->session->userdata('checkout'); 
                    ?>
                    <div class="">
                      <input type="hidden"  id="request_data" name="request_data" value="<?php echo ($cart->search_request!='')?$cart->search_request:$cart->request;?>"/>
                      <input type="hidden"  id="hotel_addresses" name="hotel_addresses" value="<?php echo base64_encode($cart->hotel_addresses);?>"/>
                      <div class="col-xs-12"><h4><?php echo lang_line('BOOKER');?></h4></div>
                      <div class="col-xs-12 nopadd fd_namecontainer">
                        <?php  $usertitle=($checkout_user['selTitle'.$cid]!='')?$checkout_user['selTitle'.$cid]:$userInfo->title;?>
                        <div class="col-xs-6 nopadd fd_name">
                          <div class="col-xs-2 padd_r">
                            <label><?php echo lang_line('TITLE');?> *</label>
                            <select class="form-control full_width input_caretdown" name="selTitle<?php echo $cid;?>" id="selTitle<?php echo $cid;?>" required>   
                              <option value="Mr" <?php echo ($usertitle=="Mr")?"selected='selected'":"";?>><?php echo lang_line('MR');?></option>
                              <option value="Mrs" <?php echo ($usertitle=="Mrs")?"selected='selected'":"";?>><?php echo lang_line('MRS');?></option>
                              <option value="Mis" <?php echo ($usertitle=="Mis")?"selected='selected'":"";?>><?php echo lang_line('MIS');?></option>
                              <option value="M/s" <?php echo ($usertitle=="M/s")?"selected='selected'":"";?>><?php echo lang_line('MAST');?></option>
                            </select>
                          </div>
                          <div class="col-xs-5 padd_r">
                            <label for="exampleInputName2"><?php echo lang_line('F_NAME');?>  *</label><br>
                            <input type="text" class="form-control full_width"  value="<?php echo($checkout_user['first_name'.$cid]!='')?$checkout_user['first_name'.$cid]:$userInfo->firstname;?>" name="first_name<?php echo $cid;?>" id="first_name<?php echo $cid;?>" placeholder="<?php echo lang_line('F_NAME');?>" required>
                          </div>
                          <div class="col-xs-5">
                            <label for="exampleInputName2"><?php echo lang_line('L_NAME');?> *</label><br>
                            <input type="text" class="form-control full_width" value="<?php echo($checkout_user['last_name'.$cid]!='')?$checkout_user['last_name'.$cid]:$userInfo->lastname;?>"  placeholder="<?php echo lang_line('L_NAME');?>" name="last_name<?php echo $cid;?>" id="last_name<?php echo $cid;?>" required>
                          </div>
                        </div>
                        <div class="col-xs-4 padd_r">
                         <label for="exampleInputName2"><?php echo lang_line('DOB');?> *</label>
                         <ul class="list-inline fd_dateob mar0">
                          <?php
                          if($checkout_user['birth_day'.$cid]!=''){
                            $dobdd=$checkout_user['birth_day'.$cid];
                            $dobmm=$checkout_user['birth_month'.$cid];
                            $dobyy=$checkout_user['birth_year'.$cid];
                            $d_ofbirth=$checkout_user['birth_day'.$cid].'/'.$checkout_user['birth_month'.$cid].'/'.$checkout_user['birth_year'.$cid];
                          }else{
                            $doba=explode("-",$userInfo->dob);
                            $dob_exp=array_reverse($dob_exp);
                            $d_ofbirth=implode("/",$dob_exp);
                            $dobdd=$doba[2];
                            $dobmm=$doba[1];
                            $dobyy=$doba[0];
                          }
                          ?>
                          <li class="date">
                            <select class="form-control input_caretdown" name="birth_day<?php echo $cid;?>" id="birth_day<?php echo $cid;?>" required>
                              <option value=""><?php echo lang_line('DATE');?></option>
                              <?php for($d=1;$d<=31;$d++) {echo  ($d<10)?'<option value="0'.$d.'" '.($d ==$dobdd ? 'selected' : '').'>0'.$d.'</option>':'<option value="'.$d.'" '.($d ==$dobdd ? 'selected' : '').'>'.$d.'</option>'; }?>
                            </select>
                          </li>
                          <li class="month">
                            <select class="form-control input_caretdown" name="birth_month<?php echo $cid;?>" id="birth_month<?php echo $cid;?>" required>                
                              <option value=""><?php echo lang_line('MONTH');?></option>
                              <?php for($m=1;$m<=12;$m++) { echo  ($m<10)?'<option value="0'.$m.'" '.($m ==$dobmm ? 'selected' : '').'>'.date("F",strtotime('2015-' . $m . '-01')).'</option>':'<option value="'.$m.'" '.($m ==$dobmm ? 'selected' : '').'>'.date("F",strtotime('2015-' . $m . '-01')).'</option>'; }?>
                            </select>
                          </li>
                          <li class="year">
                            <select class="form-control input_caretdown" name="birth_year<?php echo $cid;?>" id="birth_year<?php echo $cid;?>" required>                
                              <option value=""><?php echo lang_line('YEAR');?></option>
                              <?php for($y=date("Y");$y>1900;$y--) { echo  ($y<10)?'<option value="0'.$y.'" '.($y ==$dobyy ? 'selected' : '').'>0'.$y.'</option>':'<option value="'.$y.'" '.($y ==$dobyy ? 'selected' : '').'>'.$y.'</option>'; }?>
                            </select>
                          </li>
                        </ul>
                      </div>
                      <div class="col-xs-2">
                        <?php  $usergender=($checkout_user['selGender'.$cid]!='')?$checkout_user['selGender'.$cid]:$userInfo->gender;?>
                        <label><?php echo lang_line('GENDER');?> *</label>
                        <select class="form-control full_width input_caretdown" name="selGender<?php echo $cid;?>" id="selGender" required="required" >
                          <option value="Female" <?php echo ($usergender=="Female")?"selected='selected'":"";?>><?php echo lang_line('FEMALE');?></option>
                          <option value="Male" <?php echo ($usergender=="Male")?"selected='selected'":"";?>><?php echo lang_line('MALE');?></option>
                        </select>                    
                      </div>
                    </div>
                    <div class="spacer20"></div>
                    <?php if($module == 'HOTEL'){ ?>
                    <div class="hbook_imgtype">
                      <div class="col-xs-4">
                        <img src="<?php echo $CartHotelImage;?>">
                      </div>
                      <div class="col-xs-8">
                        <h5 class="mart0"><?php echo lang_line('ROOM_TYPE');?></h5>
                        <p><?echo $CartRoomName;?></p>
                      </div>
                    </div>
                    <?php }?>
                  </div>
                  <?php }
                  $i++; }?>
                  <input type="hidden" name="cid" id="cid" value="<?php echo $cart_global_id;?>"/>
                  <div class="col-xs-12 nopadd">
                   <div class="col-sm-3">
                    <h5><?php echo lang_line('CONTACT_DET');?> *</h5>
                  </div>
                </div>
                <div class="form-group col-xs-3 fd_street">
                  <label for="street_address"><?php echo lang_line('STREET');?> *</label><br>
                  <input type="text" class="form-control full_width" id="street_address" name="street_address" placeholder="<?php echo lang_line('STREET');?>" value="<?php echo($checkout_user['street_address']!='')?$checkout_user['street_address']:$userInfo->billing_addressA;?>" required>
                </div>
                <div class="col-xs-3 fd_housezip">
                  <ul class="list-inline">
                    <li class="form-group nopadd col-xs-6">
                      <label for="housenum"><?php echo lang_line('HOUSE_NUM');?> *</label><br>
                      <input type="text" class="form-control full_width" id="housenum" name="housenum" placeholder="<?php echo lang_line('HOUSE_NUM');?>" value="<?php echo($checkout_user['housenum']!='')?$checkout_user['housenum']:$userInfo->billing_home_no;?>" required>
                    </li>
                    <li class="form-group nopadd col-xs-6">
                      <label for="zip"><?php echo lang_line('ZIPCODE');?> *</label><br>
                      <input type="text" class="form-control full_width"  id="zip" name="zip" value="<?php echo($checkout_user['zip']!='')?$checkout_user['zip']:$userInfo->billing_postal;?>" placeholder="<?php echo lang_line('ZIPCODE');?>" required>
                    </li>
                  </ul>
                </div>
                <div class="form-group col-xs-3 fd_city">
                  <label for="city"><?php echo lang_line('CITY');?> *</label><br>
                  <input type="text" class="form-control full_width" id="city" name="city" placeholder="<?php echo lang_line('CITY');?>" value="<?php echo($checkout_user['city']!='')?$checkout_user['city']:$userInfo->billing_city;?>" required>
                </div>
                <div class="form-group col-xs-4 col-sm-4 col-md-3 fd_country">
                  <label for="country"><?php echo lang_line('COUNTRY');?> *</label><br>
                  <?php $Defaultselect2=($userInfo->billing_country!='')?$userInfo->billing_country:"NL"; ?> 
                  <select tabindex="8" class="form-control full_width input_caretdown" name="country" id="country" required>
                    <?php foreach($countries as $country){?>
                    <option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $Defaultselect2) ? "selected" : ""; ?> ><?php echo $country->name;?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="form-group col-xs-4 col-sm-4 col-md-3 sm2padr0 fd_email">
                  <?php $email1=($checkout_user['email']!='')?$checkout_user['email']:$userInfo->billing_email;?>
                  <label for="email"><?php echo lang_line('EMAIL_ADD');?> *</label><br>
                  <input  class="form-control full_width" id="email" type="email" name="email" value="<?php echo $email1;?>" placeholder="<?php echo lang_line('EMAIL_ADD');?>" required>
                </div>
                <div class="form-group col-xs-4 col-sm-4 col-md-3 fd_remail">
                  <label for="rptemail"><?php echo lang_line('REPEAT_EMAIL');?> *</label><br>
                  <input  class="form-control full_width" id="rptemail" value="<?php echo($checkout_user['rptemail']!='')?$checkout_user['rptemail']:$email1;?>" type="email" data-rule-equalto="#email" name="rptemail" placeholder="<?php echo lang_line('REPEAT_EMAIL');?>" required>
                </div>
                <div class="form-group col-xs-6 col-sm-4 col-md-3 fd_phnumber">
                  <label><?php echo lang_line('PHONE_NUM');?> *</label>
                  <ul class="list-inline">
                    <li class="col-xs-4 col-md-6">
                     <?php  $Defaultselect1=($checkout_user['country_code'.$cid]!='')?$checkout_user['country_code'.$cid]:(($userInfo->billing_country_code!='')?$userInfo->billing_country_code:"NL"); ?>
                     <div class="bfh-selectbox bfh-countries" id="billaddress" tabindex="6"  data-flags="true">
                      <input type="hidden" name="country_code" id="country_code" value="<?php echo $Defaultselect1;?>">
                      <a class="bfh-selectbox-toggle form-control" role="button" data-toggle="bfh-selectbox" href="javascript:;">
                        <span class="bfh-selectbox-option" id="billaddress"><i class="glyphicon bfh-flag-<?php echo $Defaultselect1;?>"></i> <?php echo $this->apartment_model->get_country_phonecode($Defaultselect1);?></span>
                        <span class="caret selectbox-caret"></span></a>
                        <div class="bfh-selectbox-options">
                          <div role="listbox">
                            <ul role="option">
                              <?php foreach($countries as $country){?>
                              <li><a style="overflow-x: visible !important;" tabindex="-1" href="javascript:;" data-option="<?php echo $country->country_code;?>"><i class="glyphicon bfh-flag-<?php echo $country->country_code;?>"></i><?php echo $country->phonecode;?></a></li>
                              <?php }?>
                            </ul>
                          </div>
                        </div>
                      </div>  
                    </li>
                    <li class="col-xs-8 col-md-6">
                      <input type="text" class="form-control full_width" id="mobile" data-rule-number="true"  value="<?php echo($checkout_user['mobile']!='')?$checkout_user['mobile']:$userInfo->billing_contact;?>" name="mobile" placeholder="<?php echo lang_line('PHONE_NUM');?>" required>
                    </li>
                  </ul>
                </div>
                <div class="form-group col-xs-6 col-sm-4 col-md-3 fd_company">
                  <label for="txtcmpnyname"><?php echo lang_line('COMPANY_NAME');?></label><br>
                  <input type="text" class="form-control full_width" id="txtcmpnyname" name="txtcmpnyname" value="<?php echo($checkout_user['txtcmpnyname']!='')?$checkout_user['txtcmpnyname']:'';?>" placeholder="<?php echo lang_line('COMPANY_NAME');?>">
                </div>
                <div class="col-xs-12">
                  <div class="fd_registerspacer"></div>
                </div>
                <?php if($this->session->userdata("b2c_id")==''){?>
                <div class="col-xs-8 fd_registered">
                  <p><?php echo lang_line('ALREADY_REG');?> <a href="javascript:;" class="fadeandscalereg_close fadeandscale_open"><?php echo lang_line('LOGIN');?></a></p>
                  <label class="txtCreate" for="txtCreate">
                    <input type="checkbox" id="txtCreate"> <?php echo lang_line('CREATE_ACC');?>
                  </label>
                  <div id="openaccount" class="full-widthd" style="display:none;">
                    <div class="col-sm-6 padd_l">
                      <input type="password" class="form-control full_width" name="txtPassword" id="txtPassword" placeholder="<?php echo lang_line('PSWD');?>">
                    </div>
                    <div class="col-sm-6 padd_l">
                      <input type="password" class="form-control full_width" data-rule-equalto="#txtPassword"  name="txtcPassword" id="txtcPassword" placeholder="<?php echo lang_line('CONF_PSWD');?>">
                    </div>
                  </div>
                </div>
                <?php } ?>
                <div class="col-xs-4 pull-right fd_btns">
                  <ul class="normal-list fd_buttons text-right">
                    <input type="hidden" id="total_payable" name="total" value="<?php echo base64_encode(array_sum($Total)); ?>"/>
                    <input type="hidden" id="pcode" name="code" value="<?php echo base64_encode('fool'); ?>"/>
                    <li><button type="button" target="tarifs" which-type="<?php echo $module;?>" class="btn btn-secondry btn_inputs tested tarifs_show"><?php echo lang_line('BACK');?></button></li>
                    <li><button target="overview" type="<?php echo ($this->uri->segment(3)!='' || $this->input->get('orderId')!='')?"button":"submit";?>" class="btn btn-primary btn_inputs <?php echo ($this->uri->segment(3)!='' || $this->input->get('orderId')!='')?"tested":"";?>"><?php echo lang_line('NEXT_STEP');?></button></li>
                  </ul>
                </div>
              </form>
            </div><!--second tab-->
            <div role="tabpanel" class="tab-pane <?php echo ($this->uri->segment(3)!='' && $this->input->get('orderId')=='')?"active":"";?>" id="overview"><!--third tab-->
              <div class="col-xs-12">
                <div class="spacer30"></div>
                <ul class="list-inline overview_pay">
                  <li class="col-xs-12">
                    <p><?php echo lang_line('CHECK_UR_DETAILS');?></p>
                  </li>
                  <?php
                  $AllVisibleMarkupDiscount = array();
                  $adult_total_MarkupDiscount = 0;
                  foreach($cart_global as $key => $cid){
                    list($module, $cid) = explode(',', $cid);
                    if($module == 'FLIGHT'){
                      $a = $this->cart_model->getCartDataByModule($cid,$module)->row();
                      if(!empty($a)){
                        $cart=$a;
                        $passenger_details=json_decode(base64_decode($cart->passenger_details));
                      }else{
                       $cart = $this->cart_model->get_booking($cid,$module)->row();
                       $passenger_details=json_decode(base64_decode($cart->passenger_price_details));
                     }
                     $request = json_decode(base64_decode($cart->request));
                     $response_details=json_decode(base64_decode($cart->response));
                     $AllVisibleMarkupDiscountDescoded = json_decode($cart->VisibleMarkupDiscount);
                     $adult_total_MarkupDiscount+=$cart->HiddenMarkupDiscount;
                     $AllVisibleMarkupDiscount = array_merge($AllVisibleMarkupDiscount,$AllVisibleMarkupDiscountDescoded);
                     $adult_total[]=count($passenger_details->ADT);
                     foreach($passenger_details->ADT as $adultdetails){
                      $adult_base_price[]=$adultdetails->BasePrice;
                      $adult_tax_price[]=$adultdetails->Taxes;
                      $adult_total_price[]=$adultdetails->TotalPrice;
                    }
                    if(isset($passenger_details->CNN)){
                      $childs_total[]=count($passenger_details->CNN);
                      foreach($passenger_details->CNN as $childdetails){
                        $childs_base_price[]=$childdetails->BasePrice;
                        $childs_tax_price[]=$childdetails->Taxes;
                        $child_total_price[]=$childdetails->TotalPrice;
                      }
                    }
                    if(isset($passenger_details->INF)){
                      $infants_total[]=count($passenger_details->INF);
                      foreach($passenger_details->INF as $infantdetails){
                        $infants_base_price[]=$infantdetails->BasePrice;
                        $infants_tax_price[]=$infantdetails->Taxes;
                        $infant_total_price[]=$infantdetails->TotalPrice;
                      }
                    }
                    if($request->type!=''){
                      if($request->type=='R'){
                        $onward_first_seg = reset($response_details->onward->segments);
                        $onward_last_seg = end($response_details->onward->segments);
                        $Stops = count($response_details->onward->segments)-1;
                        $onward_DepartureDateTime = $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime);
                        $onward_ArrivalDateTime = $this->flight_model->get_unixtimestamp($onward_last_seg->ArrivalTime);
                        $onward_dur = $this->flight_model->get_duration(strtotime($onward_first_seg->DepartureTime),strtotime($onward_last_seg->ArrivalTime));
                        $onward_originCity = $this->flight_model->get_airport_cityname($onward_first_seg->Origin);
                        $onward_destinationCity = $this->flight_model->get_airport_cityname($onward_last_seg->Destination);
                        $onward_origin = $onward_first_seg->Origin;
                        $onward_destination = $onward_last_seg->Destination;
                        $return_first_seg = reset($response_details->return->segments);
                        $return_last_seg = end($response_details->return->segments);
                        $retStops = count($response_details->return->segments)-1;
                        $return_DepartureDateTime = $this->flight_model->get_unixtimestamp($return_first_seg->DepartureTime);
                        $return_ArrivalDateTime = $this->flight_model->get_unixtimestamp($return_last_seg->ArrivalTime);
                        $return_dur =  $this->flight_model->get_duration(strtotime($return_first_seg->DepartureTime),strtotime($return_last_seg->ArrivalTime));
                        $return_originCity = $this->flight_model->get_airport_cityname($return_first_seg->Origin);
                        $return_destinationCity = $this->flight_model->get_airport_cityname($return_last_seg->Destination);
                        $return_origin = $return_first_seg->Origin;
                        $return_destination = $return_last_seg->Destination;
                      }else if($request->type=='O'){
                        $onward_first_seg = reset($response_details->segments);
                        $onward_last_seg = end($response_details->segments);
                        $Stops = count($response_details->segments)-1;
                        $onward_DepartureDateTime = $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime);
                        $onward_ArrivalDateTime = $this->flight_model->get_unixtimestamp($onward_last_seg->ArrivalTime);
                        $onward_dur = $this->flight_model->get_duration(strtotime($onward_first_seg->DepartureTime),strtotime($onward_last_seg->ArrivalTime));
                        $onward_originCity = $this->flight_model->get_airport_cityname($onward_first_seg->Origin);
                        $onward_destinationCity = $this->flight_model->get_airport_cityname($onward_last_seg->Destination);
                        $onward_origin = $onward_first_seg->Origin;
                        $onward_destination = $onward_last_seg->Destination;
                      }else if($request->type=='M'){
                        $v=0;
                        foreach($response_details->segments as $multisegments){
                          if(is_array($multisegments)){
                            $onward_first_seg = reset($multisegments);
                            $onward_last_seg = end($multisegments);
                            $Stops = count($multisegments)-1;
                            $dur = $this->flight_model->get_duration(strtotime($onward_first_seg->DepartureTime),strtotime($onward_last_seg->ArrivalTime));
                          }else{
                            $onward_first_seg = $multisegments;
                            $onward_last_seg = $multisegments;
                            $Stops = count($multisegments)-1;
                            $dur = $this->flight_model->get_duration(strtotime($onward_first_seg->DepartureTime),strtotime($onward_last_seg->ArrivalTime));
                          }
                          ?>
                          <?php $vv=$v+1;
                          $range=($vv==1)?'st':(($vv==2)?'nd':(($vv==3)?'rd':(($vv>3)?'th':'')));
                          ?> 
                          <!-- multicity way details -->
                          <li class="text-uppercase col-xs-12"><?php if($v==0) { ?><b><?php echo lang_line('MULTI_CITY');?></b> <?php } echo ($vv)."<sup>".$range."</sup>".lang_line('CHILD');?></li>
                          <li class="col-xs-12">
                            <p><b><?php echo $this->flight_model->get_airport_cityname($onward_first_seg->Origin);?></b> , <?php echo  $this->flight_model->get_airport_name($onward_first_seg->Origin).'&nbsp; <span class="text-info">('.$onward_first_seg->Origin.')</span>';?> - <b><?php echo $this->flight_model->get_airport_cityname($onward_last_seg->Destination);?></b> , <?php echo  $this->flight_model->get_airport_name($onward_last_seg->Destination).' <span class="text-info">('.$onward_last_seg->Destination.')</span>';?></p>
                          </li>
                          <li class="col-xs-4 col-md-3 flightbook_departure">
                            <p>
                             <?php echo date('l d F', $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime));?><br/>
                             <?php echo lang_line('DEPARTURE');?><br/>
                             <?php echo date('g:i A', $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime));?>
                           </p>
                         </li>
                         <li class="col-xs-4 col-md-3 flightbook_stops">
                          <p>
                            <?php echo (($Stops>1)?$Stops.lang_line('STOPS'):(($Stops==0)?lang_line('NONSTOP'):$Stops.lang_line('STOP')));?><br/>
                            <?php echo lang_line('ARRIVAL');?><br/>
                            <?php echo date('g:i A', $this->flight_model->get_unixtimestamp($onward_last_seg->ArrivalTime));?>
                          </p>
                        </li>
                        <li class="col-xs-4 col-md-3 flightbook_jurneytime">
                          <p>
                            <?php echo $onward_first_seg->Carrier;?><?php echo (isset($onward_first_seg->Equipment))?"-".$onward_first_seg->Equipment:"";?><br/>
                            <?php echo lang_line('JOURNEY_TIME');?><br/>
                            <?php echo $dur;?>
                          </p>
                        </li>
                        <!-- multicity way details -->
                        <?php $v++;} }
                        $BasePrice[]= $cart->BasePrice;
                        $TaxPrice[]= $cart->TaxPrice;
                        $Totalprice[]= $cart->TotalPrice;
                  }//if type not eql null
                  ?>
                  <?php if($request->type!='M'){ ?>
                  <!-- One way details -->
                  <li class="text-uppercase col-xs-12"><b><?php echo ($request->type=='O')?lang_line('ONE_WAY'):(($request->type=='M')?"":''.lang_line('ROUND_TRIP').' ('.lang_line('ONWARD').')');?></b></li>
                  <li class="col-xs-12">
                    <p><b><?php echo $onward_originCity;?></b> , <?php echo  $this->flight_model->get_airport_name($onward_origin).'&nbsp; <span class="text-info">('.$onward_origin.')</span>';?> - <b><?php echo $onward_destinationCity;?></b> , <?php echo  $this->flight_model->get_airport_name($onward_destination).' <span class="text-info">('.$onward_destination.')</span>';?></p>
                  </li>
                  <li class="col-xs-4 col-md-3 flightbook_departure">
                    <p>
                     <?php echo date('l d F', $onward_DepartureDateTime);?><br/>
                     Departure<br/>
                     <?php echo date('g:i A', $onward_DepartureDateTime);?>
                   </p>
                 </li>
                 <li class="col-xs-4 col-md-3 flightbook_stops">
                  <p>
                    <?php echo (($Stops>1)?$Stops.lang_line('STOPS'):(($Stops==0)?lang_line('NONSTOP'):$Stops.lang_line('STOP')));?><br/>
                    Arrival<br/>
                    <?php echo date('g:i A', $onward_ArrivalDateTime);?>
                  </p>
                </li>
                <li class="col-xs-4 col-md-3 flightbook_jurneytime">
                  <p>
                    <?php echo $onward_first_seg->Carrier;?><?php echo (isset($onward_first_seg->Equipment))?"-".$onward_first_seg->Equipment:"";?><br/>
                    <?php echo lang_line('JOURNEY_TIME');?><br/>
                    <?php echo $onward_dur;?>
                  </p>
                </li>
                <!-- One way details -->
                <?php } if($request->type=='R'){ ?>
                <!-- round trip booking details -->
                <li class="text-uppercase col-xs-12"><b><?php echo lang_line('RETURN');?></b></li>
                <li class="col-xs-12">
                  <p><b><?php echo $return_originCity;?></b> , <?php echo  $this->flight_model->get_airport_name($return_origin). '&nbsp; <span class="text-info">('.$return_origin.')</span>';?> - <b><?php echo $return_destinationCity;?></b> , <?php echo  $this->flight_model->get_airport_name($return_destination).' <span class="text-info">('.$return_destination.')</span>';?></p>
                </li>
                <li class="col-xs-4 col-md-3 flightbook_departure">
                  <p>
                   <?php echo date('l d F', $return_DepartureDateTime);?><br/>
                   <?php echo lang_line('DEPARTURE');?><br/>
                   <?php echo date('g:i A', $return_DepartureDateTime);?>
                 </p>
               </li>
               <li class="col-xs-4 col-md-3 flightbook_stops">
                <p>
                  <?php echo (($retStops>1)?$retStops.lang_line('STOPS'):(($retStops==0)?lang_line('NONSTOP'):$retStops.lang_line('STOP')));?><br/>
                  <?php echo lang_line('ARRIVAL');?><br/>
                  <?php echo date('g:i A', $return_ArrivalDateTime);?>
                </p>
              </li>
              <li class="col-xs-4 col-md-3 flightbook_jurneytime">
                <p>
                  <?php echo $onward_first_seg->Carrier;?><?php echo (isset($onward_first_seg->Equipment))?"-".$onward_first_seg->Equipment:"";?><br/>
                  <?php echo lang_line('JOURNEY_TIME');?><br/>
                  <?php echo $return_dur;?>
                </p>
              </li>
              <!-- round trip booking details end -->
              <?php } ?>
              <li class="borb1 full_width"></li>
              <li class="col-xs-12">
                <p><b><?php echo lang_line('PRICE_LIST');?></b></p>
              </li>
              <li class="col-xs-3 flightbook_details">
                <p><?php echo lang_line('DETAILS');?></p>
                <p><?php echo lang_line('ADULTS')." ".lang_line('PRICE');?> (<?php echo array_sum($adult_total);?>)</p>
                <?php if(array_sum($childs_total)!=0){ ?>
                <p><?php echo lang_line('CHILD')." ".lang_line('PRICE');?> (<?php echo array_sum($childs_total);?>)</p>
                <?php }  if(array_sum($infants_total)!=0){?>
                <p><?php echo lang_line('INFANTS')." ".lang_line('PRICE');?> (<?php echo array_sum($infants_total);?>)</p>
                <?php } ?>
              </li>
              <li class="col-xs-3 flightbook_price">
                <p><?php echo lang_line('PRICE');?></p>
                <p><?php echo CURR_ICON.' '.array_sum($adult_base_price);?></p>
                <?php if(array_sum($childs_total)!=0){ ?>
                <p><?php echo CURR_ICON.' '.array_sum($childs_base_price);?></p>
                <?php }  if(array_sum($infants_total)!=0){?>
                <p><?php echo CURR_ICON.' '.array_sum($infants_base_price);?></p>
                <?php } ?>
              </li>
              <li class="col-xs-3 flightbook_tax">
                <p><?php echo lang_line('TAX_SUBCHARGE');?></p>
                <p><?php echo CURR_ICON.' '.(array_sum($adult_tax_price)+$adult_total_MarkupDiscount);?></p>
                <?php if(array_sum($childs_total)!=0){ ?>
                <p><?php echo CURR_ICON.' '.(array_sum($childs_tax_price));?></p>
                <?php }  if(array_sum($infants_total)!=0){?>
                <p><?php echo CURR_ICON.' '.(array_sum($infants_tax_price));?></p>
                <?php } ?>
              </li>
              <li class="col-xs-3 flightbook_subtotal">
                <p><?php echo lang_line('SUB_TOT');?></p>
                <p><?php echo CURR_ICON.' '.(array_sum($adult_total_price)+$adult_total_MarkupDiscount);?></p>
                <?php if(array_sum($childs_total)!=0){ ?>
                <p><?php echo array_sum($child_total_price);?></p>
                <?php }  if(array_sum($infants_total)!=0){?>
                <p><?php echo array_sum($infant_total_price);?></p>
                <?php } ?>
              </li>
              <li class="total full_width">
                <div class="col-xs-6">
                  <h5 class="total_text"><?php echo lang_line('TOTAL');?></h5>
                </div>
                <div class="col-xs-6">
                  <h5><?php echo CURR_ICON.' '.(array_sum($TaxPrice) + array_sum($BasePrice));?></h5>
                </div>
              </li>
              <?php  } //if flight module*/  ?>
              <?php   if($module == 'HOTEL' || $module == 'CAR'){ 
                $a = $this->cart_model->getCartDataByModule($cid,$module)->row();
                if(!empty($a)){
                  $cart=$a;
                }else{
                 $cart = $this->cart_model->get_booking($cid,$module)->row();
               }
               $Totalprice= $cart->total;
               ?>
               <?php   if($module == 'HOTEL'){  ?>
               <li class="lostcart">
                <div class="cartlistingbuk">
                 <div class="cartitembuk hoteltitembuk">
                  <div class="col-xs-3 padd_l celcart">
                    <a class="smalbukcrt">
                      <img src="<?php echo $cart->imageurl;?>" alt="HotelImg"/>
                    </a>
                  </div>
                  <div class="col-xs-7 splcrtpad celcart">
                    <div class="carttitlebuk"><?php echo $cart->hotel_name.' ('.$cart->room_name.')';?></div>
                    <div class="cartsec"><?php echo $cart->city;?></div>             
                  </div>
                  <div class="col-xs-2 cartfprice celcart">
                    <div class="cartprc">
                      <div class="singecartpricebuk"><?php echo CURR_ICON?><?php echo $cart->total_cost;?></div>
                      <div class="moreapbk  collasped" data-target="#collapse201" data-toggle="collapse" ><?php echo lang_line('MORE');?></div> 
                    </div>
                  </div>
                </div>
                <div class="collapse" id="collapse201">
                 <?php echo $cart->roomdescription;?>
               </div> 
             </div>
           </li>
           <?php } ?>
           <?php   if($module == 'CAR'){  ?>
           <li class="lostcart full_width">
            <div class="cartlistingbuk">
             <div class="cartitembuk">
              <div class="col-xs-2 padd_l celcart">
                <a class="smalbukcrt">
                  <img src="<?php echo $cart->CarImage;?>" alt="HotelImg"/>
                </a>
              </div>
              <div class="col-xs-7 splcrtpad celcart">
                <div class="carttitlebuk"><?php echo $cart->pickupCityName.' ('.$cart->Pickup.')';?>- <?php echo $cart->dropoffCityName.' ('.$cart->Dropoff.')';?></div>
                <div class="cartsec"><?php echo date("d M Y g:i",$cart->DepartureTime);?> - <?php echo date("d M Y g:i",$cart->ReturnTime);?></div>             
              </div>
              <div class="col-xs-3 cartfprice celcart">
                <div class="cartprc">
                  <div class="singecartpricebuk">
                    <?php echo CURR_ICON?><?php echo $cart->TotalPrice;?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </li>
        <?php } ?>
        <li class="borb1 full_width"></li>
        <li class="col-xs-12">
          <p><b><?php echo lang_line('PRICE_LIST');?></b></p>
        </li>
        <li class="col-xs-3 flightbook_details caralter_price">
          <p class="marb0">&nbsp;</p>
          <p><?php echo lang_line('PRICE');?> </p>
        </li>
        <li class="col-xs-3 flightbook_price caralter_price">
          <p class="marb0"><?php echo lang_line('PRICE');?></p>
          <p><?php echo CURR_ICON.' '.$Totalprice;?></p>
        </li>
        <li class="col-xs-3 flightbook_tax caralter_price">
          <p class="marb0"><?php echo lang_line('TAX_SUBCHARGE');?></p>
          <p><?php echo CURR_ICON.'0';?></p>
        </li>
        <li class="col-xs-3 flightbook_subtotal caralter_price">
          <p class="marb0"><?php echo lang_line('SUB_TOT');?></p>
          <p><?php echo CURR_ICON.' '.($Totalprice);?></p>
        </li>
        <li class="total full_width">
          <div class="col-xs-6 nopadd">
            <h5 class="total_text"><?php echo lang_line('TOTAL');?></h5>
          </div>
          <div class="col-xs-6 nopadd text-right">
            <h5 class="total_price"><?php echo CURR_ICON.' '.($Totalprice);?></h5>
          </div>
        </li>
        <?php } ?>
        <?php 
        if($this->session->userdata('checkout')!=null || $this->session->userdata('user_data')!=null) { ?>
        <li class="col-sm-12">
          <?php   if($module == 'HOTEL'){ ?>
          <p><b><?php echo "Check your ".lang_line('DETAILS');?></b></p>
          <?php } else{ ?>
          <p><b><?php echo lang_line('TRAVELLER')." ".lang_line('DETAILS');?></b></p>
          <?php } ?>
        </li>
        <?php
        if($checkout_user['birth_day'.$cid]!=''){
          $d_ofbirth=$checkout_user['birth_day'.$cid].'/'.$checkout_user['birth_month'.$cid].'/'.$checkout_user['birth_year'.$cid];
        }else{
          $doba=explode("-",$userInfo->dob);
          $dob_exp=array_reverse($dob_exp);
          $d_ofbirth=implode("/",$dob_exp);
        }
        ?>
        <li class="col-sm-3">
          <p><?php echo ($usergender!='')?$usergender:'N/A';?></p>
        </li>
        <li class="col-sm-3">
          <?php
          $title=($usertitle!='')?$usertitle:'N/A';
          $f_name=($checkout_user['first_name'.$cid]!='')?$checkout_user['first_name'.$cid]:$userInfo->firstname;
          $l_name=($checkout_user['last_name'.$cid]!='')?$checkout_user['last_name'.$cid]:$userInfo->lastname;
          ?>
          <p><?php echo $title." ".$f_name.$l_name;?> </p>
        </li>
        <li class="col-sm-3">
          <p><?php echo ($d_ofbirth!='')?$d_ofbirth:'N/A';?></p>
        </li>
        <li class="col-sm-3">
          <p></p>
        </li>
        <li class="borb1 full_width"></li>
        <li class="col-sm-12">
          <p><b><?php echo lang_line('CONTACT_DET');?></b></p>
        </li>
        <li class="col-sm-3">
          <p>
            <?php echo($checkout_user['street_address']!='')?$checkout_user['street_address']:$userInfo->billing_addressA;?><br/>
            <?php echo($checkout_user['housenum']!='')?$checkout_user['housenum']:'';?>
          </p>
        </li>
        <li class="col-sm-3">
          <p>
            <?php echo($checkout_user['city']!='')?$checkout_user['city']:$userInfo->billing_city;?><br/>
            <?php echo($checkout_user['zip']!='')?$checkout_user['zip']:$userInfo->billing_postal;?>
          </p>
        </li>
        <li class="col-sm-3">
          <p>
            <?php echo $Defaultselect2=($userInfo->billing_country!='')?$userInfo->billing_country:"NL"; ?> 
            <br/>
          </p>
        </li>
        <li class="col-sm-3">
          <p>
            <?php echo $email1=($checkout_user['email']!='')?$checkout_user['email']:$userInfo->billing_email;?> <br/>
            <?php echo($checkout_user['mobile']!='')?$checkout_user['mobile']:$userInfo->billing_contact;?>
          </p>
        </li>
        <li class="borb1 full_width"></li>
        <?php  }   ?>
        <!-- <li class="col-xs-12">
          <p><b><?php echo lang_line('INSURANCE');?></b></p>
        </li>
        <li class="col-xs-12">
          <p><?php echo lang_line('INSURANCE_MSG');?></p>
        </li>
        <li class="full_width">
          <ul class="list-inline ov_radio">
            <li>
              <div class="checkbox">
                <label for="checkPolicy">
                  Yes<br/><input id="checkPolicy" name="checkPolicy" type="checkbox">
                </label>
              </div>
            </li>
            <li>
              <div class="checkbox">
                <label>
                  No<br/><input type="checkbox" id="checkPolicy1" name="checkPolicy" checked>
                </label>
              </div>
            </li>
            <li>
              <p><?php echo lang_line('CANCEL_INSURANCE');?> <i class="fa fa-question-circle" title='<?php echo lang_line('CANCEL_INSURANCE_EXP');?>'></i></p>
            </li>
          </ul>
        </li>
        <li class="borb1 full_width"></li> -->
        <li class="col-xs-12 ov_checkbox">
          <?php
          $pnr=json_decode(base64_decode($this->uri->segment(3)));
          $global_book_count=$this->flight_model->get_globalbooking_FlightData($pnr)->num_rows();
          if($global_book_count>0){
            $global_book=$this->flight_model->get_globalbooking_FlightData($pnr)->row();
            $final_paymentprice = base64_encode($global_book->amount);
          }else{
           $final_paymentprice = base64_encode(($Totall));
         }
         ?>
         <form name="payment" id="payment" method="post" price="<?php echo base64_decode($final_paymentprice);?>" action="<?php echo WEB_URL."/booking/doPaymentGate/".$final_paymentprice."/".$this->uri->segment(3)."/".$email1;?>">
          <input type="hidden" name="module" value="<?php echo $module;?>">
          <input type="hidden" name="CN_NAME" value="<?php echo $title." ".$f_name.' '.$l_name;?>">
          <div class="col-sm-12 nopadd">
            <div class="ft_paymentradio">
              <p><b><?php echo lang_line('PAY_METH');?></b></p>
              <?php  if($module == 'FLIGHT'){ ?>
              <div class="col-sm-12 col-md-9 nopadd ft_paymentradio">
                <div class="col-xs-4">
                  <div class="radio-inline ">
                    <input type="radio" name="payment_type" id="payment_type1" class="triprad iradio_flat-blue" value="Ideal"  checked/>        
                    <label for="payment_type1">
                      <span class="fa-stack">
                        <i class="fa fa-circle fa-stack-1x circle"></i>
                        <i class="fa fa-circle fa-stack-1x circle-yellow"></i>
                      </span>
                      <?php echo lang_line('IDEAL');?>
                    </label>
                  </div>
                </div>
                <?php } ?>
                <div class="col-xs-4">
                  <div class="radio-inline ">
                    <input type="radio" name="payment_type" checked="" required id="payment_type1" class="triprad iradio_flat-blue" value="VI"  />        
                    <label for="payment_type1">
                      <span class="fa-stack">
                        <i class="fa fa-circle fa-stack-1x circle"></i>
                        <i class="fa fa-circle fa-stack-1x circle-yellow"></i>
                      </span>
                      <?php echo lang_line('VISA');?>
                    </label>
                  </div>
                </div>
                <div class="col-xs-4 car_american">
                  <div class="radio-inline">
                    <input type="radio" name="payment_type" required id="payment_type2" class="triprad iradio_flat-blue" value="AX"  />        
                    <label for="payment_type2">
                      <span class="fa-stack">
                        <i class="fa fa-circle fa-stack-1x circle"></i>
                        <i class="fa fa-circle fa-stack-1x circle-yellow"></i>
                      </span>
                      <?php echo lang_line('AMERICAN');?>
                    </label>
                  </div>
                </div>
                <div class="col-xs-4">
                  <div class="radio-inline">
                    <input type="radio" name="payment_type"  id="payment_type4" class="triprad iradio_flat-blue" value="MC"  />        
                    <label for="payment_type4">
                      <span class="fa-stack">
                        <i class="fa fa-circle fa-stack-1x circle"></i>
                        <i class="fa fa-circle fa-stack-1x circle-yellow"></i>
                      </span>
                      <?php echo lang_line('MASTER');?>
                    </label>
                  </div>
                </div>
                <?php  if($module == 'FLIGHT'){ ?>
                <div class="col-xs-4">
                  <div class="radio-inline ">
                    <input type="radio" name="payment_type" required id="payment_type3" class="triprad iradio_flat-blue" value="MC"  />        
                    <label for="payment_type3">
                      <span class="fa-stack">
                        <i class="fa fa-circle fa-stack-1x circle"></i>
                        <i class="fa fa-circle fa-stack-1x circle-yellow"></i>
                      </span>
                      <?php echo lang_line('BAN_MISTER');?>
                    </label>
                  </div>
                </div>              
              </div>
              <?php } ?>
            </div>
            <?php  if($module == 'FLIGHT'){ ?>
            <div class="col-xs-12 col-sm-9 nopadd">
              <div class="checkbox">
                <label>
                  <input type="checkbox" id="termscon" value="1" checked>
                  <?php echo lang_line('INSURANCE_AGREE_MSG');?>
                </label>
              </div>
            </div>
            <?php } ?>
            <?php if($module!='FLIGHT'){ ?>
            <div class="col-sm-12 col-md-9 nopadd <?php echo ($module!='FLIGHT')?'paydiv':'';?>">
              <div class="row paydivrow">
                <div class="col-xs-6">
                  <label><?php echo lang_line('CARD_NUM');?></label>
                  <br>
                  <input type="number" autocomplete="off" data-rule-number="true" data-rule-creditcard="true" class="form-control full_width gray" data-rule-maxlength="16" name="Card_Num" required maxlength="16" id="Card_Num" placeholder="<?php echo lang_line('ENTER_CARD_NUM');?>">
                </div>
                <div class="col-xs-6 nopadd car_cardexpdate">
                  <div class="col-xs-12">
                    <label><?php echo lang_line('CARD_EXP_DATE');?></label>
                  </div>
                  <div class="col-xs-6">
                    <select class="form-control full_width gray" name="Exp_Month" id="Exp_Month" required>
                      <option value=""><?php echo lang_line('MONTH');?></option>
                      <?php for($m=1;$m<=12;$m++) { echo  ($m<10)?'<option value="0'.$m.'" '.($m ==date("m") ? 'selected' : '').'>'.date("F",strtotime('2015-' . $m . '-01')).'</option>':'<option value="'.$m.'" '.($m ==date("m") ? 'selected' : '').'>'.date("F",strtotime('2015-' . $m . '-01')).'</option>'; }?>
                    </select>
                  </div>
                  <div class="col-xs-6">
                    <select class="form-control full_width gray" name="Exp_Year" id="Exp_Year" required>
                      <option value=""><?php echo lang_line('YEAR');?></option>
                      <?php for($y=date("Y",strtotime("+10 Years"));$y>=date("Y");$y--) { echo  ($y<10)?'<option value="0'.$y.'" '.($y ==date("Y") ? 'selected' : '').'>0'.$y.'</option>':'<option value="'.$y.'" '.($y ==date("Y") ? 'selected' : '').'>'.$y.'</option>'; }?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row paydivrow">
                <div class="col-xs-6 car_cardname">
                  <label> <?php echo lang_line('NAME');?> (<?php echo lang_line('APPEAR_CARD_NAME');?>)</label>
                  <br>
                  <input type="text" class="form-control full_width gray" name="Card_Name" required  id="Card_Name" placeholder="<?php echo lang_line('ENTER_NAME');?>">
                </div>
                <div class="col-xs-6 car_securitycode">
                  <label><?php echo lang_line('SECURITY_CODE');?></label>
                  <br>
                  <input type="number" class="form-control full_width gray" data-rule-number="true" name="Card_Cvc" data-rule-maxlength="3" required maxlength="3" id="Card_Cvc" placeholder="<?php echo lang_line('ENTER_CODE');?>">
                </div>
              </div>
            </div>
            <?php  if($module != 'FLIGHT'){ ?>
            <div class="col-sm-9 nopadd">
              <div class="checkbox">
                <label>
                  <input type="checkbox" id="termscon" value="1" checked>
                  <?php echo lang_line('INSURANCE_AGREE_MSG');?>
                </label>
              </div>
            </div>
            <?php } ?>
            <?php } ?>
            <div class="col-xs-12 col-sm-3">
              <ul class="normal-list fd_buttons text-right" >
                <li>
                  <button type="button" target="information"  class="btn btn-secondry btn_inputs tested"><?php echo lang_line('BACK');?></button>
                </li>
                <?php if($this->uri->segment(3)!=''){
                  if($this->input->post('payment_type')==null) { 
                    ?>
                    <li><button  type="submit" class="btn btn-primary btn_inputs" ><?php echo lang_line('NEXT_STEP');?></button></li>
                    <?php } }else{ ?>
                    <li><button target="confirmation" type="button" class="btn btn-primary btn_inputs tested" ><?php echo lang_line('NEXT_STEP');?></button></li>
                    <?php } ?>
                  </ul>
                </div>
              </form>
            </li>
            <?php } /*for loop*/ ?> 
          </ul>
        </div>
      </div><!--third tab-->
      <div role="tabpanel" class="tab-pane <?php echo ($this->input->get('orderId')!='' && $this->uri->segment(3)=='')?"active":"";?>" id="confirmation">
        <?php   if(isset($pnr_nos) && $pnr_nos!='') {
          $voucher_data=$pnr_nos; $this->load->view('common/voucher_new', $voucher_data);

        }else{ echo "<p class='note_conformation'>".lang_line('COMPLETE_PREV_STEP')."</p>";
      } ?>
    </div><!--fouth tab-->
  </div>
</div>
</div>
</div>
</div>
</div>
</div>

<?$this->load->view('common/footer.php');?>

<script type="text/javascript">



$(document).ready(function(){

  $('#payment').validate();
  $( ".fs_title" ).on( "click", function() {

   $(".animated-thumbnials").each(function(){
    $(this).data('lightGallery').destroy(true);
    $(this).lightGallery();
  }); 
 }); 

  $(".btn_transparent").click(function(){

    if($(this).find("i").hasClass("fa-plus")){
      $(this).find("i").removeClass("fa-plus");
      $(this).find("i").addClass("fa-minus");
    }else{
      $(this).find("i").removeClass("fa-minus");
      $(this).find("i").addClass("fa-plus");
    }
  });
  $("#txtCreate,label.txtCreate").click(function(){
    if($('#txtCreate').is(':checked')){
      $('#openaccount').show();
      $("#txtPassword").prop("required",true);
      $("#txtcPassword").prop("required",true);
    }else{
      $("#txtPassword").val('');
      $("#txtcPassword").val('');
      $('#openaccount').hide();
      $("#txtPassword").prop("required",false);
      $("#txtcPassword").prop("required",false);
    }
  });

  $("#txtcPassword").blur(function(){
    if($("#txtPassword").val()!=$("#txtcPassword").val()){
      alert($pass_not_match);
      $("#txtcPassword").val('');
      return false;
    }else{
      return true;
    }
  });

  $('#billaddress').on('click', function() {
    $( this ).toggleClass( "open" );
    $( this ).parent().find('ul li a').on('click', function() {

      $('#country_code').val($( this ).attr("data-option"));

      $('span#billaddress').html($( this ).html());


    });

  });

  $('#paasengers').on('click', function() {
    $( this ).toggleClass( "open" );
    $( this ).parent().find('ul li a').on('click', function() {
      $('#country_code1').val($( this ).attr("data-option"));
      $('span#paasengers').html($( this ).html());


    });

  });



  $('.tested').on('click', function() {
    $('li[role="presentation"]').removeClass('active');
    $('div[role="tabpanel"]').removeClass('active');
    var id=$(this).attr('target');
    $('div#'+id).addClass('active');
    $("a[href='#"+id+"']").closest('li').addClass('active');

  }); 
});


$('.tarifs_show').click(function() {
  var request=$('#request_data').val()
  var len=$('#tarifs').find('ul li').length;

  if(len==0){

    if($(this).attr("which-type")=="FLIGHT"){
      $.ajax({
       type:'GET',
       url: WEB_URL+'/flight/GetAgain/'+request,
       beforeSend: function(){
       $(".lodrefrentrev").fadeIn(); 
      },
      success: function(response) {
        $('#tarifs').html(response);
        $('.imgLoader').fadeOut();

      }
    });
    }else if($(this).attr("which-type")=="HOTEL"){
     $.ajax({
       type:'GET',
      async: true,
      cache: false,
      dataType: 'json',
      contentType: "application/json",
      url: WEB_URL+'/hotel/GetAgain/'+request,
      beforeSend: function(){
       $(".lodrefrentrev").fadeIn();
      
      },
       
      success: function(response) {
       
        $('#tarifs').html(response.result);
        $('.lodrefrentrev').fadeOut();
        $('.allamn li').tooltip();
        $('input.rating').rating();
        $('.animated-thumbnials').lightGallery(); 

      }
    });
   }else{
     $.ajax({
       type:'GET',
       async: true,
       cache: false,
       dataType: 'json',
       contentType: "application/json",
       url: WEB_URL+'/car/GetAgain/'+request,
       beforeSend: function(){
        $(".lodrefrentrev").fadeIn();
      },
      success: function(response) {
        $('#tarifs').html(response.result);
        $('.imgLoader').fadeOut();
        $('.allamn li').tooltip();
        $('input.rating').rating();
        $('.animated-thumbnials').lightGallery(); 

      }
    });
   }
 }
});


</script>

