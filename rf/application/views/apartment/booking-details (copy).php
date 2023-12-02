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
<link rel="stylesheet" href="http://bootstrapformhelpers.com/assets/css/bootstrap-formhelpers.min.css"/>
<div class="container rftarifs_container container_flightdetails">
  <div class="row">
    <div class="col-md-12">
      <div class="fullwidthbg_image">
        <img src="<?php echo ASSETS;?>images/FLIGHTS_BG_RF.svg" class="fd_bgimage">          
        <div class="fd_content color_white">
          <div class="col-sm-12 nopadd">
            <ul class="nav nav-tabs fd_tabtitle" role="tablist">
              <li role="presentation" ><a class="tarifs_show" href="#tarifs" aria-controls="home" role="tab" data-toggle="tab"><?php echo lang_line('TARIFS');?></a></li>
              <li role="presentation" class="<?php echo ($this->uri->segment(3)=='' && $this->input->get('orderId')=='')?"active":"";?>"><a href="#information" aria-controls="profile" role="tab" data-toggle="tab"><?php echo lang_line('UR_INFO');?></a></li>
              <li role="presentation" class="<?php echo ($this->uri->segment(3)!='' && $this->input->get('orderId')=='')?"active":"";?>"><a href="#overview" aria-controls="messages" role="tab" data-toggle="tab"><?php echo lang_line('OVER_VIEW_PAY');?></a></li>
              <li role="presentation" class="<?php echo ($this->input->get('orderId')!='' && $this->uri->segment(3)=='')?"active":"";?>"><a href="#confirmation" aria-controls="settings" role="tab" data-toggle="tab"><?php echo lang_line('CONF');?></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content fd_tabcontent">
              <div role="tabpanel" class="tab-pane" id="tarifs">              
                <div class="lodrefrentrev imgLoader HSearchLoader">
                  <div class="centerload"></div>
                </div>
              </div><!--first tab-->
              <div role="tabpanel" class="tab-pane <?php echo ($this->uri->segment(3)=='' && $this->input->get('orderId')=='')?"active":"";?>" id="information"><!--second tab-->               
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
                                 //echo '<pre>';print_r($request);
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
                    <div class="col-xs-12 nopadd"><!--col-12 start-->
                     <?php  $usertitle=($checkout_user['selTitle'.$cid]!='')?$checkout_user['selTitle'.$cid]:$userInfo->title;?>
                     <div class="col-sm-2">
                      <label><?php echo lang_line('TITLE');?> *</label>
                      <select class="form-control full_width input_caretdown" name="selTitle<?php echo $cid;?>" id="selTitle<?php echo $cid;?>" required>   
                        <option value="Mr" <?php echo ($usertitle=="Mr")?"selected='selected'":"";?>><?php echo lang_line('MR');?></option>
                        <option value="Mrs" <?php echo ($usertitle=="Mrs")?"selected='selected'":"";?>><?php echo lang_line('MRS');?></option>
                        <option value="Mis" <?php echo ($usertitle=="Mis")?"selected='selected'":"";?>><?php echo lang_line('MIS');?></option>
                        <option value="M/s" <?php echo ($usertitle=="M/s")?"selected='selected'":"";?>><?php echo lang_line('MAST');?></option>
                      </select>
                    </div>
                    <div class="col-sm-3">
                      <label for="exampleInputName2"><?php echo lang_line('F_NAME');?> (<?php echo lang_line('AS_PASS');?>) *</label><br>
                      <input type="text" class="form-control full_width"  value="<?php echo($checkout_user['first_name'.$cid]!='')?$checkout_user['first_name'.$cid]:$userInfo->firstname;?>" name="first_name<?php echo $cid;?>" id="first_name<?php echo $cid;?>" placeholder="<?php echo lang_line('F_NAME');?>" required>
                    </div>
                    <div class="col-sm-3">
                      <label for="exampleInputName2"><?php echo lang_line('L_NAME');?> *</label><br>
                      <input type="text" class="form-control full_width" value="<?php echo($checkout_user['last_name'.$cid]!='')?$checkout_user['last_name'.$cid]:$userInfo->lastname;?>"  placeholder="<?php echo lang_line('L_NAME');?>" name="last_name<?php echo $cid;?>" id="last_name<?php echo $cid;?>" required>
                    </div>
                    <div class="col-sm-4">
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
                  </div><!--col-12 end-->
                  <div class="col-xs-12 nopadd"><!--col-12 start-->
                    <?php  $usergender=($checkout_user['selGender'.$cid]!='')?$checkout_user['selGender'.$cid]:$userInfo->gender;?>
                    <div class="col-sm-2">
                      <label><?php echo lang_line('GENDER');?> *</label>
                      <select name="selGender<?php echo $cid;?>"  class="form-control" id="selGender" required="required" >
                        <option value="Female" <?php echo ($usergender=="Female")?"selected='selected'":"";?>><?php echo lang_line('FEMALE');?></option>
                        <option value="Male" <?php echo ($usergender=="Male")?"selected='selected'":"";?>><?php echo lang_line('MALE');?></option>
                      </select>
                    </div>
                 <!-- <div class="col-sm-3">
                    <label for="exampleInputName2">Email *</label><br>
                   <input type="text" placeholder="Email Address" name="email<?php echo $cid;?>" class="form-control full_width" value="<?php echo($checkout_user['email'.$cid]!='')?$checkout_user['email'.$cid]:$userInfo->email;?>" required/>
                  </div>

                   <div class="form-group col-sm-5">
                    <label>Phone Number *</label>
                    <ul class="list-inline">
                      <li class="col-sm-4">
                       <?php  $Defaultselect=($checkout_user['country_code'.$cid]!='')?$checkout_user['country_code'.$cid]:(($userInfo->billing_country_code!='')?$userInfo->billing_country_code:"NL"); ?>
                          <div class="bfh-selectbox bfh-countries" id="paasengers" tabindex="6"  data-flags="true">
                    <input type="hidden" name="country_code<?php echo $cid;?>" id="country_code1" value="<?php echo $Defaultselect;?>">
                    <a class="bfh-selectbox-toggle form-control" role="button" data-toggle="bfh-selectbox" href="javascript:;">
                      <span class="bfh-selectbox-option" id="paasengers"><i class="glyphicon bfh-flag-<?php echo $Defaultselect;?>"></i> <?php echo $this->apartment_model->get_country_phonecode($Defaultselect);?></span>
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
                      <li class="col-sm-7">
                        <input type="text" class="form-control full_width" id="mobile" data-rule-number="true" data-rule-minlength="10" value="<?php echo($checkout_user['mobile'.$cid]!='')?$checkout_user['mobile'.$cid]:$userInfo->billing_contact;?>" name="mobile<?php echo $cid;?>" placeholder="Phone Number" required>
                      </li>
                    </ul>
                  </div>-->
                </div><!--col-12 end-->
                <?php if(count(array_filter($pass_result))>1){ ?>
                <div class="col-xs-12 fd_moreoption"><!--toggle div start-->
                  <button class="btn btn_transparent" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <span class="fa-stack">
                      <i class="fa fa-square fa-stack-2x"></i>
                      <i class="fa fa-<?php echo (count(array_filter($pass_result))>1)?"minus":"plus";?> fa-stack-1x"></i>
                    </span>
                    <span class="btn_text"><?php echo lang_line('MORE_TRAVELLERS');?></span>
                  </button>
                  <div class="collapse <?php echo (count(array_filter($pass_result))>1)?"in":"";?>" id="collapseExample">
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
                          <h5><?php echo lang_line('TRAVELLER');?> <?php echo ucfirst($key)." ".$sno;?></h5>
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
                        <div class="col-xs-12 nopadd"><!--col-12 start-->
                         <div class="col-sm-1 nopadd">
                          <label>Title *</label>
                          <select class="form-control full_width input_caretdown" name="pselTitle<?php echo $cid;?>[<?php echo $key.$sno;?>]" id="pselTitle<?php echo $cid;?>[<?php echo $key.$sno;?>]" required>   
                           <option value="Mr" <?php echo ($multi_title=="Mr")?"selected='selected'":"";?>><?php echo lang_line('MR');?></option>
                           <option value="Mrs" <?php echo ($multi_title=="Mrs")?"selected='selected'":"";?>><?php echo lang_line('MRS');?></option>
                           <option value="Mis" <?php echo ($multi_title=="Mis")?"selected='selected'":"";?>><?php echo lang_line('MIS');?></option>
                           <option value="M/s" <?php echo ($multi_title=="M/s")?"selected='selected'":"";?>><?php echo lang_line('MAST');?></option>
                         </select>
                       </div>
                       <div class="col-sm-2">
                        <label>Gender *</label>
                        <select class="form-control full_width input_caretdown" name="pselGender<?php echo $cid;?>[<?php echo $key.$sno;?>]"  class="form-control" id="selGender" required >
                          <option value="Female" <?php echo ($multigender=="Female")?"selected":'';?>><?php echo lang_line('FEMALE');?></option>
                          <option value="Male" <?php echo ($multigender=="Male")?"selected":'';?>><?php echo lang_line('MALE');?></option>
                        </select>
                      </div>
                      <div class="col-sm-3">
                        <label for="exampleInputName2"><?php echo lang_line('F_NAME');?> (<?php echo lang_line('AS_PASS');?>) *</label><br>
                        <input type="text" class="form-control full_width"  value="<?php echo $multifname;?>" name="pfirst_name<?php echo $cid;?>[<?php echo $key.$sno;?>]" id="pfirst_name<?php echo $cid;?>[<?php echo $key.$sno;?>]" placeholder="<?php echo lang_line('F_NAME');?>" required>
                      </div>
                      <div class="col-sm-2">
                        <label for="exampleInputName2"><?php echo lang_line('L_NAME');?> *</label><br>
                        <input type="text" class="form-control full_width"  placeholder="<?php echo lang_line('L_NAME');?>" value="<?php echo $multilname;?>" name="plast_name<?php echo $cid;?>[<?php echo $key.$sno;?>]" id="plast_name<?php echo $cid;?>[<?php echo $key.$sno;?>]" required>
                      </div>
                      <div class="col-sm-4 nopadd">
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

                    </div><!--col-12 end-->

                    <?php  }} ?>

                  </div>
                </div>
              </div><!--toggle div end-->

              <?php }} //Flight End
              if($module == 'HOTEL'){

             // $cart = $this->cart_model->getCartDataByModule($cid,$module)->row();

                    $a = $this->hotel_model->getBookingTemp($cid)->row();
                    //print_r($a);
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




                     <div class="booking-info-tab">
                    <!-- <input type="hidden"  id="request_data" value="<?php echo $cart->request;?>"/>-->
                  <h4>Booker</h4>
                  <div class="row">
                    <?php  $usertitle=($checkout_user['selTitle'.$cid]!='')?$checkout_user['selTitle'.$cid]:$userInfo->title;?>
                     <div class="col-sm-2">
                      <label><?php echo lang_line('TITLE');?> *</label>
                      <select class="form-control full_width input_caretdown" name="selTitle<?php echo $cid;?>" id="selTitle<?php echo $cid;?>" required>   
                        <option value="Mr" <?php echo ($usertitle=="Mr")?"selected='selected'":"";?>><?php echo lang_line('MR');?></option>
                        <option value="Mrs" <?php echo ($usertitle=="Mrs")?"selected='selected'":"";?>><?php echo lang_line('MRS');?></option>
                        <option value="Mis" <?php echo ($usertitle=="Mis")?"selected='selected'":"";?>><?php echo lang_line('MIS');?></option>
                        <option value="M/s" <?php echo ($usertitle=="M/s")?"selected='selected'":"";?>><?php echo lang_line('MAST');?></option>
                      </select>
                    </div>
                    

                       <?php  $usergender=($checkout_user['selGender'.$cid]!='')?$checkout_user['selGender'.$cid]:$userInfo->gender;?>
                    <div class="col-sm-2">
                      <label><?php echo lang_line('GENDER');?> *</label>
                      <select name="selGender<?php echo $cid;?>"  class="form-control" id="selGender" required="required" >
                        <option value="Female" <?php echo ($usergender=="Female")?"selected='selected'":"";?>><?php echo lang_line('FEMALE');?></option>
                        <option value="Male" <?php echo ($usergender=="Male")?"selected='selected'":"";?>><?php echo lang_line('MALE');?></option>
                      </select>
                    </div>
                   
                        <div class="col-sm-2">
                      <label for="exampleInputName2"><?php echo lang_line('F_NAME');?>  *</label><br>
                      <input type="text" class="form-control full_width"  value="<?php echo($checkout_user['first_name'.$cid]!='')?$checkout_user['first_name'.$cid]:$userInfo->firstname;?>" name="first_name<?php echo $cid;?>" id="first_name<?php echo $cid;?>" placeholder="<?php echo lang_line('F_NAME');?>" required>
                    </div>
                    <div class="col-sm-2">
                      <label for="exampleInputName2"><?php echo lang_line('L_NAME');?> *</label><br>
                      <input type="text" class="form-control full_width" value="<?php echo($checkout_user['last_name'.$cid]!='')?$checkout_user['last_name'.$cid]:$userInfo->lastname;?>"  placeholder="<?php echo lang_line('L_NAME');?>" name="last_name<?php echo $cid;?>" id="last_name<?php echo $cid;?>" required>
                    </div>
                     
                    <div class="col-sm-4">
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
                  </div>  
                 

                                    <div class="row">
                                       <div class="col-md-4">
                      <img style="width:100%;" src="https://d2whcypojkzby.cloudfront.net/imageRepo/4/0/56/90/641/Standard_Room_E.jpg">

                    </div>
                      <div class="col-md-8">
                        <span><h5>Room type</h5><small><?echo $CartRoomName;?></small></span>
                      <div class="row">
                        <div class="col-md-3">
                          <label for="exampleInputName2">Guests *</label><br>
                          <select class="form-control full_width input_caretdown" name="GuestCount" id="GuestCount" required="" aria-required="true">   
                            <option value="1">1</option>
                            <option value="2">2</option>
                          </select>                          
                        </div>
                        <div class="col-md-4">
                          <label for="exampleInputName2">Full Name guest *</label><br>
                          <input type="text" class="form-control full_width" value="" placeholder="Enter first name &amp; last name" name="guest_full_name" id="guest_full_name" required="" aria-required="true">                
                        </div>
                        <div class="col-md-5">
                          <label for="exampleInputName2">Estimated time of arrival *</label><br>
                          <select class="form-control full_width input_caretdown" name="Estimated_time" id="Estimated_time" required="" aria-required="true">   
                             <?php
                            for ($i=0; $i < 24 ; $i++) {
                              (strlen($i)==1) ? $i='0'.$i : $i=$i;
                              (strlen($i+1)==1) ? $iplus='0'.($i+1) : $iplus = ($i+1);
                              ?>
                              <option value="<?php echo $i.':00 - '.($i+1).':00';?>"><?php echo $i.':00 - '.$iplus.':00';?></option>
                              <?php
                            }
                            ?>
                                                           
                           </select>
                        </div>
                      </div>
                      <label for="exampleInputName2">Speacial requests (Please write in English) *</label><br>
                      <textarea name="SpeacialRequest" class="form-control full_width"></textarea>
                    </div>
                    
                  </div>
                </div>

<?php }

              $i++; }?>
              <input type="hidden" name="cid" id="cid" value="<?php echo $cart_global_id;?>"/>
              <div class="col-xs-12 nopadd">
               <div class="col-sm-3">
                <label><?php echo lang_line('CONTACT_DET');?> *</label>
                    <!--   <select class="form-control full_width input_caretdown">                
                        <option>Enter booker</option>
                       
                      </select> -->
                    </div>
                  </div>
                  <div class="form-group col-sm-3">
                    <label for="street_address"><?php echo lang_line('STREET');?> *</label><br>
                    <input type="text" class="form-control full_width" id="street_address" name="street_address" placeholder="<?php echo lang_line('STREET');?>" value="<?php echo($checkout_user['street_address']!='')?$checkout_user['street_address']:$userInfo->billing_addressA;?>" required>
                  </div>
                  <div class="col-sm-3">
                    <ul class="list-inline">
                      <li class="form-group nopadd col-sm-6">
                        <label for="housenum"><?php echo lang_line('HOUSE_NUM');?> *</label><br>
                        <input type="text" class="form-control full_width" id="housenum" name="housenum" placeholder="<?php echo lang_line('HOUSE_NUM');?>" value="<?php echo($checkout_user['housenum']!='')?$checkout_user['housenum']:'';?>" required>
                      </li>
                      <li class="form-group nopadd col-sm-6">
                        <label for="zip"><?php echo lang_line('ZIPCODE');?> *</label><br>
                        <input type="text" class="form-control full_width"  id="zip" name="zip" value="<?php echo($checkout_user['zip']!='')?$checkout_user['zip']:$userInfo->billing_postal;?>" placeholder="<?php echo lang_line('ZIPCODE');?>" required>
                      </li>
                    </ul>
                  </div>
                  <div class="form-group col-sm-3">
                    <label for="city"><?php echo lang_line('CITY');?> *</label><br>
                    <input type="text" class="form-control full_width" id="city" name="city" placeholder="<?php echo lang_line('CITY');?>" value="<?php echo($checkout_user['city']!='')?$checkout_user['city']:$userInfo->billing_city;?>" required>
                  </div>
                  <div class="form-group col-sm-3">
                    <label for="country"><?php echo lang_line('COUNTRY');?> *</label><br>
                    <?php $Defaultselect2=($userInfo->billing_country!='')?$userInfo->billing_country:"NL"; ?> 
                    <select tabindex="8" class="form-control full_width input_caretdown" name="country" id="country" required>
                      <?php foreach($countries as $country){?>
                      <option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $Defaultselect2) ? "selected" : ""; ?> ><?php echo $country->name;?></option>
                      <?php }?>
                    </select>
                  </div>
                  <div class="form-group col-sm-3">
                    <?php $email1=($checkout_user['email']!='')?$checkout_user['email']:$userInfo->billing_email;?>
                    <label for="email"><?php echo lang_line('EMAIL_ADD');?> *</label><br>
                    <input  class="form-control full_width" id="email" type="email" name="email" value="<?php echo $email1;?>" placeholder="<?php echo lang_line('EMAIL_ADD');?>" required>
                  </div>
                  <div class="form-group col-sm-3">
                    <label for="rptemail"><?php echo lang_line('REPEAT_EMAIL');?> *</label><br>
                    <input  class="form-control full_width" id="rptemail" value="<?php echo($checkout_user['rptemail']!='')?$checkout_user['rptemail']:$email1;?>" type="email" data-rule-equalto="#email" name="rptemail" placeholder="<?php echo lang_line('REPEAT_EMAIL');?>" required>
                  </div>
                  <div class="form-group col-sm-3">
                    <label><?php echo lang_line('PHONE_NUM');?> *</label>
                    <ul class="list-inline">
                      <li class="col-sm-6">
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
                      <li class="col-sm-6">
                        <input type="text" class="form-control full_width" id="mobile" data-rule-number="true"  value="<?php echo($checkout_user['mobile']!='')?$checkout_user['mobile']:$userInfo->billing_contact;?>" name="mobile" placeholder="<?php echo lang_line('PHONE_NUM');?>" required>
                      </li>
                    </ul>
                  </div>
                  <div class="form-group col-sm-3">
                    <label for="txtcmpnyname"><?php echo lang_line('COMPANY_NAME');?> *</label><br>
                    <input type="text" class="form-control full_width" id="txtcmpnyname" name="txtcmpnyname" value="<?php echo($checkout_user['txtcmpnyname']!='')?$checkout_user['txtcmpnyname']:'';?>" placeholder="<?php echo lang_line('COMPANY_NAME');?>" >
                  </div>

                  <div class="col-xs-12">
                    <div class="fd_registerspacer"></div>
                  </div>
                  <?php if($this->session->userdata("b2c_id")==''){?>
                  <div class="col-xs-4">
                    <p><?php echo lang_line('ALREADY_REG');?> <a href="javascript:;" class="fadeandscalereg_close fadeandscale_open"><?php echo lang_line('LOGIN');?></a></p>
                    <label class="txtCreate" for="txtCreate">
                      <input type="checkbox" id="txtCreate"> <?php echo lang_line('CREATE_ACC');?>
                    </label>
                    <div id="openaccount" style="display:none;">
                      <input type="password" class="form-control full_width" name="txtPassword" id="txtPassword" placeholder="<?php echo lang_line('PSWD');?>">
                      <input type="password" class="form-control full_width" data-rule-equalto="#txtPassword" name="txtcPassword" id="txtcPassword" placeholder="<?php echo lang_line('CONF_PSWD');?>">
                    </div>
                  </div>
                  <?php } ?>
                  <div class="col-xs-4 pull-right">
                    <ul class="normal-list fd_buttons text-right">
                      <input type="hidden" id="total_payable" name="total" value="<?php echo base64_encode(array_sum($Total)); ?>"/>
                      <input type="hidden" id="pcode" name="code" value="<?php echo base64_encode('fool'); ?>"/>
                      <li><button type="button" target="tarifs" class="btn btn-secondry btn_inputs tested tarifs_show"><?php echo lang_line('BACK');?></button></li>
                      <li><button target="overview" type="<?php echo ($this->uri->segment(3)!='' || $this->input->get('orderId')!='')?"button":"submit";?>" class="btn btn-primary btn_inputs <?php echo ($this->uri->segment(3)!='' || $this->input->get('orderId')!='')?"tested":"";?>"><?php echo lang_line('NEXT_STEP');?></button></li>

                    </ul>
                  </div>
                </form>
              </div><!--second tab-->



              <div role="tabpanel" class="tab-pane <?php echo ($this->uri->segment(3)!='' && $this->input->get('orderId')=='')?"active":"";?>" id="overview"><!--third tab-->
                <div class="col-sm-12">
                  <div class="spacer30"></div>
                  <ul class="list-inline overview_pay">




                 

                    <li class="col-sm-12">
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

         // $passenger_details=json_decode(base64_decode($cart->passenger_details));
          //print_r($passenger_details);
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


// echo "<pre>";
 //print_r($adult_base_price);

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
                            <li class="text-uppercase col-sm-12"><?php if($v==0) { ?><b><?php echo lang_line('MULTI_CITY');?></b> <?php } echo ($vv)."<sup>".$range."</sup>".lang_line('CHILD');?></li>
                            <li class="col-sm-12">
                              <p><b><?php echo $this->flight_model->get_airport_cityname($onward_first_seg->Origin);?></b> , <?php echo  $this->flight_model->get_airport_name($onward_first_seg->Origin).'<span class="text-info">('.$onward_first_seg->Origin.')</span>';?> - <?php echo $this->flight_model->get_airport_cityname($onward_last_seg->Destination);?></b> , <?php echo  $this->flight_model->get_airport_name($onward_last_seg->Destination).' <span class="text-info">('.$onward_last_seg->Destination.')</span>';?></p>
                            </li>
                            <li class="col-sm-3">
                              <p>
                               <?php echo date('l d F', $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime));?><br/>
                               <?php echo lang_line('DEPARTURE');?><br/>
                               <?php echo date('g:i A', $this->flight_model->get_unixtimestamp($onward_first_seg->DepartureTime));?>
                             </p>
                           </li>
                           <li class="col-sm-3">
                            <p>
                              <?php echo (($Stops>1)?$Stops.lang_line('STOPS'):(($Stops==0)?lang_line('NONSTOP'):$Stops.lang_line('STOP')));?><br/>
                              <?php echo lang_line('ARRIVAL');?><br/>
                              <?php echo date('g:i A', $this->flight_model->get_unixtimestamp($onward_last_seg->ArrivalTime));?>
                            </p>
                          </li>
                          <li class="col-sm-3">
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
          } //if type not eql null

       

        ?>

        <?php if($request->type!='M'){ ?>
        <!-- One way details -->
        <li class="text-uppercase col-sm-12"><b><?php echo ($request->type=='O')?lang_line('ONE_WAY'):(($request->type=='M')?"":''.lang_line('ROUND_TRIP').' ('.lang_line('ONWARD').')');?></b></li>
        <li class="col-sm-12">
          <p><b><?php echo $onward_originCity;?></b> , <?php echo  $this->flight_model->get_airport_name($onward_origin).'<span class="text-info">('.$onward_origin.')</span>';?> - <?php echo $onward_destinationCity;?></b> , <?php echo  $this->flight_model->get_airport_name($onward_destination).' <span class="text-info">('.$onward_destination.')</span>';?></p>
        </li>
        <li class="col-sm-3">
          <p>
           <?php echo date('l d F', $onward_DepartureDateTime);?><br/>
           Departure<br/>
           <?php echo date('g:i A', $onward_DepartureDateTime);?>
         </p>
       </li>
       <li class="col-sm-3">
        <p>
          <?php echo (($Stops>1)?$Stops.lang_line('STOPS'):(($Stops==0)?lang_line('NONSTOP'):$Stops.lang_line('STOP')));?><br/>
          Arrival<br/>
          <?php echo date('g:i A', $onward_ArrivalDateTime);?>
        </p>
      </li>
      <li class="col-sm-3">
        <p>
          <?php echo $onward_first_seg->Carrier;?><?php echo (isset($onward_first_seg->Equipment))?"-".$onward_first_seg->Equipment:"";?><br/>
          <?php echo lang_line('JOURNEY_TIME');?><br/>
          <?php echo $onward_dur;?>
        </p>
      </li>
      <!-- One way details -->
      <?php } if($request->type=='R'){ ?>
      <!-- round trip booking details -->
      <li class="text-uppercase col-sm-12"><b><?php echo lang_line('RETURN');?></b></li>
      <li class="col-sm-12">
        <p><b><?php echo $return_originCity;?></b> , <?php echo  $this->flight_model->get_airport_name($return_origin).'<span class="text-info">('.$return_origin.')</span>';?> - <?php echo $return_destinationCity;?></b> , <?php echo  $this->flight_model->get_airport_name($return_destination).' <span class="text-info">('.$return_destination.')</span>';?></p>
      </li>
      <li class="col-sm-3">
        <p>
         <?php echo date('l d F', $return_DepartureDateTime);?><br/>
         <?php echo lang_line('DEPARTURE');?><br/>
         <?php echo date('g:i A', $return_DepartureDateTime);?>
       </p>
     </li>
     <li class="col-sm-3">
      <p>
        <?php echo (($retStops>1)?$retStops.lang_line('STOPS'):(($retStops==0)?lang_line('NONSTOP'):$retStops.lang_line('STOP')));?><br/>
        <?php echo lang_line('ARRIVAL');?><br/>
        <?php echo date('g:i A', $return_ArrivalDateTime);?>
      </p>
    </li>
    <li class="col-sm-3">
      <p>
        <?php echo $onward_first_seg->Carrier;?><?php echo (isset($onward_first_seg->Equipment))?"-".$onward_first_seg->Equipment:"";?><br/>
        <?php echo lang_line('JOURNEY_TIME');?><br/>
        <?php echo $return_dur;?>
      </p>
    </li>
    <!-- round trip booking details end -->
    <?php } ?>

    <li class="borb1 full_width"></li>
    <li class="col-sm-12">
      <p><?php echo lang_line('PRICE_LIST');?></p>
    </li>
    <li class="col-sm-3">
      <p><?php echo lang_line('DETAILS');?></p>
    </li>
    <li class="col-sm-3">
      <p><?php echo lang_line('PRICE');?></p>
    </li>
    <li class="col-sm-3">
      <p><?php echo lang_line('TAX_SUBCHARGE');?></p>
      <p></p>
    </li>
    <li class="col-sm-3">
      <p><?php echo lang_line('SUB_TOT');?></p>
    </li>


    <li class="col-sm-3">
      <p><?php echo lang_line('ADULTS')." ".lang_line('PRICE');?> (<?php echo array_sum($adult_total);?>)</p>
    </li>
    <li class="col-sm-3">
      <p><?php echo CURR_ICON.' '.array_sum($adult_base_price);?></p>
    </li>
    <li class="col-sm-3">
      <p><?php echo CURR_ICON.' '.(array_sum($adult_tax_price)+$adult_total_MarkupDiscount);?></p>
      <p></p>
    </li>
    <li class="col-sm-3">
      <p><?php echo CURR_ICON.' '.(array_sum($adult_total_price)+$adult_total_MarkupDiscount);?></p>
    </li>
    <?php if(array_sum($childs_total)!=0){ ?>
    <li class="col-sm-3">
      <p><?php echo lang_line('CHILD')." ".lang_line('PRICE');?> (<?php echo array_sum($childs_total);?>)</p>
    </li>
    <li class="col-sm-3">
      <p><?php echo CURR_ICON.' '.array_sum($childs_base_price);?></p>
    </li>
    <li class="col-sm-3">
      <p><?php echo CURR_ICON.' '.(array_sum($childs_tax_price));?></p>
      <p></p>
    </li>
    <li class="col-sm-3">
      <p><?php echo array_sum($child_total_price);?></p>
    </li>
    <?php }  if(array_sum($infants_total)!=0){?>
    <li class="col-sm-3">
      <p><?php echo lang_line('INFANTS')." ".lang_line('PRICE');?> (<?php echo array_sum($infants_total);?>)</p>
    </li>
    <li class="col-sm-3">
      <p><?php echo CURR_ICON.' '.array_sum($infants_base_price);?></p>
    </li>
    <li class="col-sm-3">
      <p><?php echo CURR_ICON.' '.(array_sum($infants_tax_price));?></p>
      <p></p>
    </li>
    <li class="col-sm-3">
      <p><?php echo array_sum($infant_total_price);?></p>
    </li>
    <?php } ?>
   
                  <li class="total full_width">
                    <div class="col-sm-6">
                      <h5><?php echo lang_line('TOTAL');?></h5>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                      <h5><?php echo CURR_ICON.' '.(array_sum($TaxPrice) + array_sum($BasePrice));?></h5>
                    </div>
                  </li>
<?php  } //if flight module*/  ?>



   <?php   if($module == 'HOTEL'){ 


                        $a = $this->cart_model->getCartDataByModule($cid,$module)->row();

                        if(!empty($a)){
                          $cart=$a;
                          }else{
                         $cart = $this->cart_model->get_booking($cid,$module)->row();
                         }
                          //echo "<pre>";
                         //print_r($cart);die;


                         
                          $Totalprice= $cart->total;

                       ?>



                  <li class="lostcart">
                <div class="cartlistingbuk">
                 <div class="cartitembuk">
                    <div class="col-md-3 celcart">
                        <a class="smalbukcrt"><img src="<?php echo $cart->imageurl;?>" alt="HotelImg"/></a>
                    </div>
                    <div class="col-md-8 splcrtpad celcart">
                        <div class="carttitlebuk"><?php echo $cart->hotel_name.' ('.$cart->room_name.')';?></div> 
                        
                        <div class="cartsec"><?php echo $cart->city;?></div>             
                    </div>
                    <div class="col-md-1 cartfprice celcart">
                        <div class="cartprc">
                            <div class="singecartpricebuk"><?php echo CURR_ICON?><?php echo $cart->total_cost;?></div>
                            
                            <div class="moreapbk  collasped" data-target="#collapse201" data-toggle="collapse" >More</div> 
                        </div>
                    </div>
                 </div>  
                
                 <div class="collapse" id="collapse201">
                   <?php echo $cart->roomdescription;?>
                 </div> 
                 </div>
            </li> 


    <li class="borb1 full_width"></li>
    <li class="col-sm-12">
      <p><?php echo lang_line('PRICE_LIST');?></p>
    </li>
    <li class="col-sm-3">
      <p><?php echo lang_line('DETAILS');?></p>
    </li>
    <li class="col-sm-3">
      <p><?php echo lang_line('PRICE');?></p>
    </li>
    <li class="col-sm-3">
      <p><?php echo lang_line('TAX_SUBCHARGE');?></p>
      <p></p>
    </li>
    <li class="col-sm-3">
      <p><?php echo lang_line('SUB_TOT');?></p>
    </li>


    <li class="col-sm-3">
      <p><?php echo lang_line('PRICE');?> </p>
    </li>
    <li class="col-sm-3">
      <p><?php echo CURR_ICON.' '.$Totalprice;?></p>
    </li>
    <li class="col-sm-3">
      <p><?php echo CURR_ICON.'0';?></p>
      <p></p>
    </li>
    <li class="col-sm-3">
      <p><?php echo CURR_ICON.' '.($Totalprice);?></p>
    </li>
   
   
                  <li class="total full_width">
                    <div class="col-sm-6">
                      <h5><?php echo lang_line('TOTAL');?></h5>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                      <h5><?php echo CURR_ICON.' '.($Totalprice);?></h5>
                    </div>
                  </li>

   <?php } ?>
                  <?php //print_r($this->session->userdata);die; // if($this->session->userdata('checkout')!=null || $this->session->userdata('user_data')!=null) { ?>
                  <li class="col-sm-12">
                  <?php   if($module == 'HOTEL'){ ?>
                    <p><?php echo "Booker".lang_line('DETAILS');?></p>
                    <?php } else{ ?>
                <p><?php echo lang_line('TRAVELLER')." ".lang_line('DETAILS');?></p>
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
                    <p><?php echo lang_line('CONTACT_DET');?></p>
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
                     <?php echo $Defaultselect2=($userInfo->billing_country!='')?$userInfo->billing_country:"NL"; ?> <br/>

                   </p>
                 </li>
                 <li class="col-sm-3">
                  <p>
                    <?php echo $email1=($checkout_user['email']!='')?$checkout_user['email']:$userInfo->billing_email;?> <br/>
                    <?php echo($checkout_user['mobile']!='')?$checkout_user['mobile']:$userInfo->billing_contact;?>
                  </p>
                </li>
                <li class="borb1 full_width"></li>
                <?php // }   ?>

                <li class="col-sm-12">
                  <p><?php echo lang_line('INSURANCE');?></p>
                </li>
                <li class="col-sm-12">
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
                      <p><?php echo lang_line('CANCEL_INSURANCE');?> <i class="fa fa-question-circle"></i></p>
                    </li>
                  </ul>
                </li>
                <li class="borb1 full_width"></li>
                <li class="col-sm-12 ov_checkbox">
                  <?php 

                  $pnr=json_decode(base64_decode($this->uri->segment(3)));
                  $global_book_count=$this->flight_model->get_globalbooking_FlightData($pnr)->num_rows();
                  if($global_book_count>0){
                    $global_book=$this->flight_model->get_globalbooking_FlightData($pnr)->row();
                    $final_paymentprice = base64_encode($global_book->amount);
                  }else{
                   $final_paymentprice = base64_encode(array_sum($Totall));
                 }
                 //echo $global_book->amount;

        //$url_string="total_amount=".$final_paymentprice."&orderId=".$this->uri->segment(3);
                 ?>
                 <form name="payment" id="payment" method="post" action="<?php echo WEB_URL."/booking/doPaymentGate/".$final_paymentprice."/".$this->uri->segment(3)."/".$email1;?>">
                  <div class="col-sm-9">
                    <p><?php echo lang_line('PAY_METH');?></p>
                    <div class="col-sm-4">
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
                    <div class="col-sm-4">
                      <div class="radio-inline ">
                        <input type="radio" name="payment_type" id="payment_type2" class="triprad iradio_flat-blue" value="Bancontact"  />        
                        <label for="payment_type2">
                          <span class="fa-stack">
                            <i class="fa fa-circle fa-stack-1x circle"></i>
                            <i class="fa fa-circle fa-stack-1x circle-yellow"></i>
                          </span>
                          <?php echo lang_line('VISA');?>
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="radio-inline ">
                        <input type="radio" name="payment_type" id="payment_type3" class="triprad iradio_flat-blue" value="Visa"  />        
                        <label for="payment_type3">
                          <span class="fa-stack">
                            <i class="fa fa-circle fa-stack-1x circle"></i>
                            <i class="fa fa-circle fa-stack-1x circle-yellow"></i>
                          </span>
                          <?php echo lang_line('AMERICAN');?>
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="radio-inline ">
                        <input type="radio" name="payment_type" id="payment_type4" class="triprad iradio_flat-blue" value="Master"  />        
                        <label for="payment_type4">
                          <span class="fa-stack">
                            <i class="fa fa-circle fa-stack-1x circle"></i>
                            <i class="fa fa-circle fa-stack-1x circle-yellow"></i>
                          </span>
                          <?php echo lang_line('BAN_MISTER');?>
                        </label>
                      </div>

                    </div>
                    <div class="col-sm-4">
                      <div class="radio-inline">
                        <input type="radio" name="payment_type" id="payment_type5" class="triprad iradio_flat-blue" value="American"  />        
                        <label for="payment_type5">
                          <span class="fa-stack">
                            <i class="fa fa-circle fa-stack-1x circle"></i>
                            <i class="fa fa-circle fa-stack-1x circle-yellow"></i>
                          </span>
                          <?php echo lang_line('MASTER');?>
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-12 nopadd">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" id="termscon" value="1" checked>
                          <?php echo lang_line('INSURANCE_AGREE_MSG');?>
                        </label>
                      </div>
                    </div>

                  </div>
                  <div class="col-sm-3">
                    <ul class="normal-list fd_buttons text-right" >
                      <li class="spacer30"></li>
                      <li>
                        <button type="button" target="information"  class="btn btn-secondry btn_inputs tested"><?php echo lang_line('BACK');?></button>

                      </li>
                      <?php if($this->uri->segment(3)!=''){
                        if($this->input->post('payment_type')==null) { ?>
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
              <?php
       /* if($this->input->post('payment_type')!=null && $this->input->post('payment_type')=='Ideal') { ?>
                  <div class="col-sm-12 nopadd">
                      <?php
       
        $pnr=json_decode(base64_decode($this->uri->segment(3)));
        $global_book_count=$this->flight_model->get_globalbooking_FlightData($pnr)->num_rows();
        if($global_book_count>0){
          $global_book=$this->flight_model->get_globalbooking_FlightData($pnr)->row();
           $final_paymentprice = base64_encode($global_book->amount);
        }else{
           $final_paymentprice = base64_encode(array_sum($Totall));
        }
        $view_data = array('amount' => $final_paymentprice,'entranceCode'=>$this->uri->segment(3));
        $this->load->ext_view('third_party/ideal/pay', 'requestTransaction', $view_data);
        ?>
            </div>
            <?php }*/ ?>
        
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


$('.tarifs_show').click(function() {
  var request=$('#request_data').val()
  var len=$('#tarifs').find('ul li').length;

  if(len==0){
    $.ajax({
     type:'GET',
     url: '<?php echo WEB_URL;?>/flight/GetAgain/'+request,
     beforeSend: function(XMLHttpRequest){
      $('div#tarifs div.imgLoader').fadeIn();
    },
    success: function(response) {
      $('#tarifs').html(response);
      $('.imgLoader').fadeOut();

    }
  });
  }
});



$(document).ready(function(){

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
</script>

