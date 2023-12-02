<?php 
$this->load->view('common/header'); 
//print_r($hotel_amenities);die;
?>
<div id="SearchCarousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner" role="listbox">
    <!-- <ol class="carousel-indicators">
      <li data-target="#SearchCarousel" data-slide-to="0"></li>
      <li data-target="#SearchCarousel" data-slide-to="1" class="active"></li>
    </ol> -->
    <!-- Search result Start -->
    <div class="container nopadd container_flightsearch item ">
      
  </div>
  <!-- Search result End -->
  <!-- Search Engine Start -->
  <div class="container nopadd container_indexpage item active">
    <div class="col-md-9">
      <div class="fullwidthbg_image">
        <img src="<?=ASSETS?>images/FACTORY_RF-02.png" class="factory_imageindexpng visible-lg">
        <img src="<?=ASSETS?>images/FACTORY_RF-02.svg" class="factory_imageindex2 visible-lg">
        <img src="<?=ASSETS?>images/FACTORY_MD.svg" class="factory_imageindex2 visible-sm">
        <img src="<?=ASSETS?>images/FACTORY_SM.svg" class="factory_imageindex2 visible-xs invisible_md">
        <img src="<?=ASSETS?>images/FACTORY_SM2.svg" class="factory_imageindex2 visible-xs factory_sm">
        <div class="tab_contents color_white">
          <div class="col-sm-2">
            <h2 class="tc_title"><?php echo lang_line('HOTELS');?></h2>
          </div>
          <div class="col-xs-12">
            <form class="form-inline flight_form" name="hotel_search" method="post" id="hotel_search" action="<?php echo WEB_URL;?>/hotel/search" autocomplete="off">
              <div class="normal">
                <div class="col-sm-12 nopadd"> 
                  <div class="form-group col-xs-6 padd_l sm2paddr0">
                    <label> <?php echo lang_line('GOING_TO');?></label><br>
                    <input type="text" class="form-control full_width input_marker" name='hotel_city' id="hotel_autocomplete" placeholder="<?php echo lang_line('DESTI_ADDRESS');?>" value='' autofocus required>
                  </div>
                </div>
                <div class="form-group col-xs-3 padd_l sm3paddr0 sm2marb0">
                  <label> <?php echo lang_line('CHECKIN');?></label><br>
                  <input type="text" class="form-control full_width input_calender first" name='hotel_checkin' id="hotel_checkin" placeholder="dd/mm/yy" value='' required>
                </div>
                <div class="form-group col-xs-3 sm2paddl0 sm2paddr0 sm2marb0">
                  <label> <?php echo lang_line('CHECKOUT');?></label><br>
                  <input type="text" class="form-control full_width input_calender second" id="hotel_checkout" name='hotel_checkout' placeholder="dd/mm/yy" value='' required>
                </div>
                <div class="col-sm-5 padd_l">
                  <div class="form-group col-xs-5 sm2paddl0 sm2paddr0 sm2marb0">
                    <label> <?php echo lang_line('ROOMS');?></label><br>
                    <select name="rooms" class="form-control full_width input_caretdown">
                      <option value="1"> 1</option>
                      <option value="2"> 2</option>
                      <option value="3"> 3</option>
                       <option value="4"> 4</option>
                   <option value="5"> 5</option>
                   <option value="6"> 6</option>
                    </select>
                  </div>
                  <div class="form-group col-xs-3 padd_l sm2paddl0 sm2paddr0 sm2marb0">
                    <label> <?php echo lang_line('ADULTS');?></label><br>
                    <select name="adult" class="form-control full_width input_caretdown">                
                     <option value="1"> 1</option>
                     <option value="2"> 2</option>
                     <option value="3"> 3</option>
                      <option value="4"> 4</option>
                   <option value="5"> 5</option>
                   <option value="6"> 6</option>
                   </select>
                 </div>
                 <div class="form-group col-xs-3 padd_l sm2paddl0 sm2paddr0 sm2marb0">
                  <label> <?php echo lang_line('CHILDRENS');?></label><br>
                  <select name="child" class="form-control full_width input_caretdown">                
                   <option value="1"> 1</option>
                   <option value="2"> 2</option>
                   <option value="3"> 3</option>
                   <option value="4"> 4</option>
                   <option value="5"> 5</option>
                   <option value="6"> 6</option>
                 </select>
               </div>
             </div>        
          </div>
          <div class="col-xs-12 padd_l sm3paddr0 sm2paddr0 ff_dropdown">
            <button class="btn btn-primary ffd_caret" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
              <span class="caret"></span> <span class="btn_text"> <?php echo lang_line('ADVANCED_OPT');?></span>
            </button>
            <div class="collapse" id="collapseExample">
              <div class="well">
                <div class="form-group col-xs-2 padd_l sm2paddr0">
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
                <div class="form-group col-xs-2 sm3paddr0 padd_l">
                  <select name="Area" class="form-control full_width input_caretdown">
                    <option value="">  <?php echo lang_line('AREA');?></option>
                  </select>
                </div>
                <div class="button-group col-sm-8 nopadd ff_facilitydp">
                  <button type="button" class="btn dropdown-toggle btn-inbox" data-toggle="dropdown"><?php echo lang_line('FACILITIES');?></button>
                  <ul class="dropdown-menu ffdp_dp">
                      <?php foreach ($hotel_amenities as $facilities) { ?>
                    <li class="col-sm-4 nopadd">
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
          <div class="full_width">
            <ul class="hotelpreferences allamn hotel_preferances">
              <li title="Air Conditioning" class="hotel-aico"></li>
              <li title="High Speed Internet" class="hotel-hspi"></li>
              <li title="Breakfast" class="hotel-brft"></li>
              <li title="Coffee Shop" class="hotel-cosh"></li>
              <li title="Children Stay Free" class="hotel-csfr"></li>
              <li title="Computer Bus Center" class="hotel-cobu"></li>
              <li title="Connect Rooms" class="hotel-coro"></li>
              <li title="Continental Breakfast" class="hotel-cobr"></li>
              <li title="Dinner" class="hotel-dinr"></li>
              <li title="Elevators" class="hotel-elev"></li>
              <li title="Family Plan" class="hotel-fapl"></li>
              <li title="Free Transportation" class="hotel-frtr"></li>
              <li title="Handicap Facilities" class="hotel-hafa"></li>
              <li title="Health Club" class="hotel-hecl"></li>
              <li title="Lounge" class="hotel-luge"></li>
              <li title="Lunch" class="hotel-lnch"></li>
              <li title="Meal Plan" class="hotel-mepl"></li>
              <li title="Meeting Facilities" class="hotel-mefa"></li>
              <li title="Non-Smoking Room" class="hotel-nsmr"></li>
              <li title="Parking" class="hotel-park"></li>
              <li title="Free Parking" class="hotel-fprk"></li>
              <li title="Small Pets Allowed" class="hotel-spal"></li>
              <li title="Phone Service" class="hotel-phsv"></li>
              <li title="Restaurant" class="hotel-rtnt"></li>
              <li title="Safe in Room" class="hotel-sair"></li>
              <li title="Safe Deposit" class="hotel-sade"></li>
              <li title="Shower" class="hotel-shwr"></li>
              <li title="Television" class="hotel-telv"></li>
              <li title="Cable TV" class="hotel-cbtv"></li>
              <li title="Private Bath" class="hotel-prbt"></li>
              <li title="Sofa Bed" class="hotel-sfbd"></li>
              <li title="Bath Tub" class="hotel-batb"></li>
              <li title="Fire Safety" class="hotel-fsty"></li>
              <li title="Entertainment" class="hotel-entr"></li>
              <li title="Game Room" class="hotel-garo"></li>
              <li title="Gift Shop" class="hotel-gish"></li>
              <li title="Movies In Room" class="hotel-moir"></li>
              <li title="Pool" class="hotel-pool"></li>
              <li title="Indoor Pool" class="hotel-inpl"></li>
              <li title="Refrigerator" class="hotel-rfgr"></li>
              <li title="Room Service" class="hotel-rose"></li>
              <li title="Sauna" class="hotel-saun"></li>
              <li title="Spa" class="hotel-spaa"></li>
              <li title="Fax Service" class="hotel-fxsv"></li>
              <li title="Photo Copy Service" class="hotel-phco"></li>
              <li title="Concierge Desk" class="hotel-code"></li>
              <li title="Laundry/Valet" class="hotel-lava"></li>
              <li title="Mini Bar" class="hotel-miba"></li>
              <li title="Child Care" class="hotel-chca"></li>
              <li title="Hair Salon" class="hotel-hasa"></li>
              <li title="Concierge Level" class="hotel-cole"></li>
              <li title="Wet Bar" class="hotel-wtbr"></li>
              <li title="220AC" class="hotel-a220"></li>
              <li title="220DC" class="hotel-d220"></li>
              <li title="Balcony" class="hotel-balc"></li>
              <li title="Fireplace" class="hotel-fplc"></li>
              <li title="Multilingual" class="hotel-mtgl"></li>
              <li title="Porters" class="hotel-ptrs"></li>
              <li title="Airline Desk" class="hotel-aide"></li>
              <li title="Childrens Programs" class="hotel-chpr"></li>
              <li title="Car Rental Desk" class="hotel-care"></li>
              <li title="Golf" class="hotel-golf"></li>
              <li title="Outdoor Pool" class="hotel-oupl"></li>
              <li title="Secretarial Service" class="hotel-sccv"></li>
              <li title="Tennis Court" class="hotel-tnct"></li>
              <li title="Tour Desk" class="hotel-trdk"></li>
              <li title="Kitchen" class="hotel-ktcn"></li>
              <li title="Casino" class="hotel-casi"></li>
              <li title="Efficiencies" class="hotel-effi"></li>
              <li title="Microwave Oven" class="hotel-miov"></li>
              <li title="Oriental Room Style" class="hotel-orro"></li>
              <li title="Western Room Style" class="hotel-wero"></li>
              <li title="Skiing" class="hotel-skii"></li>
              <li title="Snow Skiing" class="hotel-sski"></li>
              <li title="Water Skiing" class="hotel-wtki"></li>
              <li title="VCR" class="hotel-vdcr"></li>
              <li title="Waterbed" class="hotel-wtbd"></li>
              <li title="Kitchen" class="hotel-a120"></li>
              <li title="Kitchen" class="hotel-jgtk"></li>
              <li title="Kitchen" class="hotel-d120"></li>
            </ul>
          </div>
          <div class="col-sm-12">
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

