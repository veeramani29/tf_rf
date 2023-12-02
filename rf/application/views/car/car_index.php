<?php $this->load->view('common/header'); ?>

<div id="SearchCarousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner" role="listbox">
    <!-- Search result Start -->
    <div class="container nopadd container_flightsearch item ">
    </div>
    <!-- Search result End -->
    <!-- Search Engine Start -->
    <div class="container nopadd container_indexpage car_indexpage item active">
      <div class="col-md-9">
        <div class="fullwidthbg_image">
          <img src="<?=ASSETS?>images/FACTORY_RF-02.png" class="factory_imageindexpng visible-lg visible-md">
          <img src="<?=ASSETS?>images/FACTORY_RF-02.svg" class="factory_imageindex2 visible-lg visible-md">
          <img src="<?=ASSETS?>images/FACTORY_MD.svg" class="factory_imageindex2 visible-sm">
          <img src="<?=ASSETS?>images/FACTORY_SM.svg" class="factory_imageindex2 visible-xs invisible_md">
          <img src="<?=ASSETS?>images/FACTORY_SM2.svg" class="factory_imageindex2 visible-xs factory_sm">
          <div class="tab_contents color_white">
            <div class="col-sm-2">
              <h2 class="tc_title"><?php echo lang_line('CARS');?></h2>
            </div>
            <div class="col-xs-12 sm4paddr0">
              <form class="form-inline flight_form" name="car_search" method="post" id="car_search" action="<?php echo WEB_URL;?>/car/search" autocomplete="off">
                <div class="normal">
                  <div class="col-sm-12 nopadd"> 
                    <div class="form-group col-xs-6 padd_l">
                      <label> <?php echo lang_line('ARRIVAL');?></label>
                      <input type="text" class="form-control fromflight full_width input_marker" value="" name='pickup' id="pickup" placeholder="<?php echo lang_line('PICK_UP');?>"   required>
                    </div>
                    <div class="form-group col-xs-6 padd_l">
                      <label> <?php echo lang_line('DEPARTURE');?></label>
                      <input type="text" class="form-control departflight full_width input_marker" value="" name='dropoff' id="dropoff" placeholder="<?php echo lang_line('DROP_OFF');?>"   required>
                    </div>
                  </div>
                  <div class="col-sm-6 padd_l cip_picdrpcon">
                    <div class="form-group col-xs-6 padd_l">
                      <label> <?php echo lang_line('PICK_UP_DATE');?></label>
                      <input type="text" class="form-control  full_width input_calender first"   name='cdepature' id="cdepature" placeholder="dd/mm/yy"  required>
                    </div>
                    <div class="form-group col-xs-3 padd_l">
                      <label> <?php echo lang_line('TIME');?></label>
                      <select name="cdepature_time" class="form-control full_width input_caretdown"> 
                        <?php  for($i = 0; $i <= 24; $i++){?>
                        <option <?php echo (date("H")==$i)?"selected":'';?> value="<?php echo ($i<10)?"0".$i:$i; ?>"><?php echo ($i<10)?"0".$i:$i; ?></option>
                        <?php }?>
                      </select>
                    </div>
                    <div class="form-group col-xs-3 padd_l smpaddr0">
                      <label> &nbsp;</label>
                      <select name="cdepature_min" class="form-control full_width input_caretdown">
                        <option value="00"> 00</option>                         
                        <option value="15"> 15</option>
                        <option value="30"> 30</option>
                        <option value="45"> 45</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6 padd_l cip_picdrpcon">
                    <div class="form-group col-xs-6 smpaddl0">
                      <label> <?php echo lang_line('DROP_OFF_DATE');?></label>
                      <input type="text" class="form-control full_width input_calender second" value="17/12/2015" id="creturn" name='creturn' placeholder="dd/mm/yy"  required>
                    </div>
                    <div class="form-group col-xs-3 padd_l">
                      <label> <?php echo lang_line('TIME');?></label>
                      <select name="creturn_time" class="form-control full_width input_caretdown"> 
                        <?php  for($i = 0; $i <= 24; $i++){?>
                        <option <?php echo (date("H")==$i)?"selected":'';?> value="<?php echo ($i<10)?"0".$i:$i; ?>"><?php echo ($i<10)?"0".$i:$i; ?></option>
                        <?php }?>
                      </select>
                    </div>
                    <div class="form-group col-xs-3 padd_l smpaddr0">
                      <label> &nbsp;</label>
                      <select name="creturn_min" class="form-control full_width input_caretdown"> 
                        <option value="00"> 00</option>               
                        <option value="15"> 15</option>
                        <option value="30"> 30</option>
                        <option value="45"> 45</option>
                      </select>
                    </div>
                  </div>        
                </div>
                <div class="col-xs-12 padd_l sm3paddr0 ff_dropdown carind_advopt">
                  <button class="btn btn-primary ffd_caret" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <span class="caret"></span> <span class="btn_text"> <?php echo lang_line('ADVANCED_OPT');?></span>
                  </button>
                  
                  <div class="collapse" id="collapseExample">
                    <div class="well">
                      <div class="form-group sm3paddr0 col-xs-2 padd_l cid_carcategory">
                        <select name="Car_Category" class="form-control input_caretdown">                
                          <option value=""> <?php echo lang_line('CAR_CATEGORY');?></option>
                         <?php $car_category_arr=lang_line('car_category_arr'); foreach($car_category_arr as $cat_key => $cat_value ){ ?>
                            <option value="<?php echo $cat_key;?>"> <?php echo $cat_value;?></option>
                          <?php } ?>
                                
                        </select>
                      </div>
                      <div class="form-group sm3paddr0 col-xs-2 padd_l cid_doorcount">
                        <select name="Door_Count" class="form-control input_caretdown">                
                          <option value=""> <?php echo lang_line('DOOR_COUNT');?></option>
                           <?php $car_doors_arr=lang_line('car_doors_arr'); foreach($car_doors_arr as $door_key => $door_value ){ ?>
                            <option value="<?php echo $door_key;?>"> <?php echo $door_value;?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group col-xs-2 padd_l">
                        <button type="button" class="btn dropdown-toggle btn-inbox" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <?php echo lang_line('PRICE');?>
                        </button>
                        <ul class="dropdown-menu well_bgwhite" id="price">
                          <div class="well">
                            <div class="departure_time">
                              <p> <?php echo lang_line('PRICE');?></p>
                              <div id="price-range" class="float_lwidth"></div>
                              <input type="hidden" name="MinPrice" id="MinPrice"/>
                              <input type="hidden" name="MaxPrice" id="MaxPrice" />    
                              <span class="time_left" id="left_price"></span>
                              <span class="time_right" id="right_price"></span>
                            </div>                             
                          </div>
                        </ul>
                      </div>
                      <div class="form-group sm3paddr0 col-xs-2 padd_l cid_transmission">
                        <select name="Transmission" class="form-control input_caretdown">                
                          <option value=""> <?php echo lang_line('TXMN');?></option>
                          <?php $car_txmns_arr=lang_line('car_txmns_arr'); foreach($car_txmns_arr as $txmns_key => $txmns_value ){ ?>
                            <option value="<?php echo $txmns_key;?>"> <?php echo $txmns_value;?></option>
                          <?php } ?>

                        </select>
                      </div>
                      <div class="form-group col-xs-2 sm3paddr0 padd_l">
                        <select name="Fuel_Type" class="form-control full_width input_caretdown">                
                          <option value=""> <?php echo lang_line('FUEL_TYPE');?></option>
                           <?php $car_fuels_arr=lang_line('car_fuels_arr'); foreach($car_fuels_arr as $fuels_key => $fuels_value ){ ?>
                            <option value="<?php echo $fuels_key;?>"> <?php echo $fuels_value;?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group sm3paddr0 col-xs-2 padd_l cid_vehicleclass">
                        <select name="Vehicle_Class" class="form-control input_caretdown">                
                          <option value=""> <?php echo lang_line('VEHICLE_CLASS');?></option>
                         
 <?php $car_class_arr=lang_line('car_class_arr'); foreach($car_class_arr as $class_key => $class_value ){ ?>
                            <option value="<?php echo $class_key;?>"> <?php echo $class_value;?></option>
                          <?php } ?>


                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="button_search">
                  <button id='' name='flight_submit' type="submit" class="btn btn-primary"> <?php echo lang_line('SEARCH');?></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view('offer');?>
    </div>
  </div>
</div>
<?php $this->load->view('common/footer');?>