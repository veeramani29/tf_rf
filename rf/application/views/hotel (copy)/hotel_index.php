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
                    <label> Going To</label><br>
                    <input type="text" class="form-control full_width input_marker" name='hotel_city' id="hotel_autocomplete" placeholder="Destination / Address" value=' Amsterdam, Netherlands  - AMS' autofocus required>
                  </div>
                </div>
                <div class="form-group col-xs-3 padd_l sm3paddr0 sm2marb0">
                  <label> Check-In</label><br>
                  <input type="text" class="form-control full_width input_calender first" name='hotel_checkin' id="hotel_checkin" placeholder="dd/mm/yy" value='31/10/2015' required>
                </div>
                <div class="form-group col-xs-3 sm2paddl0 sm2paddr0 sm2marb0">
                  <label> Check-Out</label><br>
                  <input type="text" class="form-control full_width input_calender second" id="hotel_checkout" name='hotel_checkout' placeholder="dd/mm/yy" value='02/11/2015' required>
                </div>
                <div class="col-sm-5 padd_l">
                  <div class="form-group col-xs-5 sm2paddl0 sm2paddr0 sm2marb0">
                    <label> Rooms</label><br>
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
                    <label> Adults</label><br>
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
                  <label> Childrens</label><br>
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
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
              <span class="caret"></span> <span class="btn_text"> <?php echo lang_line('ADVANCED_OPT');?></span>
            </button>
            <div class="collapse" id="collapseExample">
              <div class="well">
                <div class="form-group col-xs-3 sm3paddr0 padd_l">
                  <select name="Accom" class="form-control full_width input_caretdown sm2marb0">                
                    <option value=""> Accommodation</option>
                    <?php foreach ($hotel_amenities as $Accommodation) { ?>
                    <option value="<?php echo stripslashes($Accommodation->universal_api_code);?>"> <?php echo stripslashes($Accommodation->universal_api_description);?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-xs-3 sm3paddr0 padd_l">
                  <select name="Facil" class="form-control full_width input_caretdown sm2marb0">                
                    <option value=""> Facilities</option>
                    <option value="AICO|AICA"> Air</option>
                    <option value="ALGF"> Alergy-Free</option>
                    <option value="BALC"> Balcony</option>
                    <option value="BRST"> Bridal Suite</option>
                    <option value="FAPL|FARM"> Family Rooms</option>
                    <option value="HSPI|INSV|HWFR|INWI|HWFR"> Internet</option>
                    <option value="FXSV"> Fax Service</option>
                    <option value="BRST"> Lunch to Go</option>
                    <option value="BRFT|BRBF|RSBK|COBR"> Breakfast</option>
                  </select>
                </div>
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
                    <option value=""> Area</option>
                   
                  </select>
                </div>
                <div class="form-group col-xs-2 sm3paddr0 padd_l">
                  <select name="RoomType" class="form-control full_width input_caretdown">                
                    <option value=""> Room Type</option>
                    <option value="RollawayAdult"> RollawayAdult</option>
                    <option value="Crib"> Crib</option>
                    <option value="Crib"> Queen</option>
                    <option value="Crib"> King</option>
                    <option value="Crib"> Double</option>                  
                    <?php foreach ($room_types as $room_type) { ?>
                    <option value="<?php echo stripslashes($room_type->room_type);?>"> <?php echo stripslashes($room_type->room_type);?></option>
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

