<?php 
$this->load->view('common/header'); 
//print_r($hotel_amenities);die;
?>
<div id="SearchCarousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner" role="listbox">
    <!-- Search result Start -->
    <div class="container nopadd container_flightsearch item"></div>
    <!-- Search result End -->
    <!-- Search Engine Start -->
    <div class="container nopadd container_indexpage hotelcontainer_indexpage item active">
      <div class="col-md-9">
        <div class="fullwidthbg_image">
          <img src="<?=ASSETS?>images/FACTORY_RF-02.png" class="factory_imageindexpng visible-md visible-lg">
          <img src="<?=ASSETS?>images/FACTORY_RF-02.svg" class="factory_imageindex2 visible-md visible-lg">
          <img src="<?=ASSETS?>images/FACTORY_MD.svg" class="factory_imageindex2 visible-sm">
          <img src="<?=ASSETS?>images/FACTORY_SM.svg" class="factory_imageindex2 visible-xs invisible_md">
          <img src="<?=ASSETS?>images/FACTORY_SM2.svg" class="factory_imageindex2 visible-xs factory_sm">
          <div class="tab_contents color_white">
            <div class="col-sm-2">
              <h2 class="tc_title"><?php echo lang_line('HOTELS');?></h2>
            </div>
            <div class="col-xs-12 sm4paddr0">
              <form class="form-inline flight_form" name="hotel_search" method="post" id="hotel_search" action="<?php echo WEB_URL;?>/hotel/search" autocomplete="off">
                <div class="normal">
                  <div class="col-sm-12 nopadd float_lwidth"> 
                    <div class="form-group hotelplace_input col-xs-6 padd_l">
                      <label> <?php echo lang_line('GOING_TO');?></label><br>
                      <input type="text" class="form-control full_width input_marker" name='hotel_city' id="hotel_autocomplete" placeholder="<?php echo lang_line('DESTI_ADDRESS');?>" value='' autofocus required>
                    </div>
                  </div>
                  <div class="form-group col-xs-3 padd_l">
                    <label> <?php echo lang_line('CHECKIN');?></label><br>
                    <input type="text" class="form-control full_width input_calender first" name='hotel_checkin' id="hotel_checkin" placeholder="dd/mm/yy"  required>
                  </div>
                  <div class="form-group col-xs-3 smpaddl0">
                    <label> <?php echo lang_line('CHECKOUT');?></label><br>
                    <input type="text" class="form-control full_width input_calender second" id="hotel_checkout" name='hotel_checkout' placeholder="dd/mm/yy"  required>
                  </div>
                  <div class="col-xs-6 col-sm-5 hotelroom_container">
                    <div class="form-group col-xs-4 col-sm-5 smpaddl0">
                      <label> <?php echo lang_line('ROOMS');?></label><br>
                      <select name="rooms" class="form-control full_width input_caretdown">
                      <?php for ($r=1; $r <=6 ; $r++) { ?><option value="<?php echo $r;?>"><?php echo $r;?></option><?php } ?> 
                      </select>
                    </div>
                    <div class="form-group col-xs-4 col-sm-3 padd_l sm2paddl0">
                      <label> <?php echo lang_line('ADULTS');?></label><br>
                      <select name="adult" class="form-control full_width input_caretdown">                
                       <?php for ($i=1; $i <10 ; $i++) { ?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?> 
                      </select>
                    </div>
                    <div class="form-group col-xs-4 col-sm-3 padd_l sm2paddl0">
                      <label> <?php echo lang_line('CHILDRENS');?></label><br>
                      <select name="child" class="form-control full_width input_caretdown"> 
                       <?php for ($i=0; $i <=6 ; $i++) { ?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?> 
                      </select>
                    </div>
                    </div> 
                  
                  <div class="checkbox col-xs-12 padd_l">
                    <label id="more_person">
                      <a style="color: #FFF;" href="home/more_passangers"><?php echo lang_line('MORE_THAN_PERSON');?></a>
                    </label>
                  </div>       
                </div>
                <div class="col-xs-12 padd_l sm3paddr0 ff_dropdown">
                  <button class="btn btn-primary ffd_caret" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <span class="caret"></span>
                    <span class="btn_text"> <?php echo lang_line('ADVANCED_OPT');?></span>
                  </button>
                  <div class="collapse" id="collapseExample">
                    <div class="well">
                      <div id="hotel_price" class="form-group col-xs-2 padd_l">
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
                      <div class="form-group col-xs-2 padd_l">
                        <select name="Area" class="form-control full_width input_caretdown">
                          <option value="">  <?php echo lang_line('AREA');?></option>
                        </select>
                      </div>
                      <div class="button-group col-xs-2 nopadd ff_facilitydp facilitydp_right">
                        <button type="button" class="btn dropdown-toggle btn-inbox" data-toggle="dropdown"><?php echo lang_line('FACILITIES');?></button>
                        <ul class="dropdown-menu ffdp_dp">
                          <?php foreach ($hotel_amenities as $facilities) { ?>
                          <li class="col-xs-6 nopadd">
                            <label for="<?php echo stripslashes($facilities->universal_api_code);?>">
                              <input name="Facil[]" id="<?php echo stripslashes($facilities->universal_api_code);?>" type="checkbox" value="<?php echo stripslashes($facilities->universal_api_code);?>"/><?php echo ($facilities->universal_api_description!='')?stripslashes($facilities->universal_api_description):$facilities->universal_api_code;?>
                            </label>
                          </li>
                          <?php } ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12">
                </div>
                <div class="button_search">
                  <button id='' name='flight_submit' type="submit" class="btn btn-primary"> 
                    <?php echo lang_line('SEARCH');?>
                  </button>
                  <!-- <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="left" title="Tooltip on left">Tooltip on left</button> 
                  <div class="tooltip left" role="tooltip">
                    <div class="tooltip-arrow"></div>
                    <div class="tooltip-inner">
                      Tooltip on the left
                    </div>
                  </div>
                  <script>
                  $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                  })
                  </script>-->
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