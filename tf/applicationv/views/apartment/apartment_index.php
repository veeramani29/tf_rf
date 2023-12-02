<?php $this->load->view('common/header'); 
$language = $this->session->userdata('language');

  if($language){
	 $this->lang->load('Home_Page_HM', $language);
	  }else{
	 $this->lang->load('Home_Page_HM', 'english');
	  }
$this->load->view('common/header'); ?>
<div class="searchindex">
  <div class="container">
    <div class="col-md-12 full nopad">
      <div class="bs-example bs-example-tabs tabwrap">
        <div class="intabs">
          <div class="tab-content2 rittab nopad" id="myTabContent"> 
            <!-- Apartments -->
            <div id="cruise2" class="tab-pane fade active in">
              <form name="apartment" id="apartment" action="<?php echo WEB_URL.'/apartment/search'?>" method="post" autocomplete="off">
                <div class="col-md-8 nopad">
                  <div class="apart">
                    <div class="bigsent"> <?php echo $this->lang->line('HM_S_Apartments_title'); ?> </div>
                    <div class="smalsent"> <?php echo $this->lang->line('HM_S_Apartments_description'); ?> </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-12 nopad left marbotom20 my12">
                    <div class="col-md-12 md-12 xmd-12 xm-12">
                      <div class="ritsrch">
                        <div class="inbar posrel">
                          <input type="text" class="flyinput locmark" name="address" id="autocomplete" placeholder="<?php echo $this->lang->line('HM_S_Apartment_placeholder_city'); ?>" onFocus="geolocate()" onkeypress="return dontSubmit(event);" required/>
                          <input type="hidden" id="street_number" name="street_number"></input>
                          <input type="hidden" id="route" name="route"></input>
                          <input type="hidden" id="locality" name="city"></input>
                          <input type="hidden" id="administrative_area_level_1" name="state"></input>
                          <input type="hidden" id="postal_code" name="zip"></input>
                          <input type="hidden" id="country" name="country"></input>
                          <input type="hidden" id="latitude" name="latitude"></input>
                          <input type="hidden" id="longitude" name="longitude"></input>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-12 md-12 nopad left marbotom20">
                    <div class="col-md-6 md-6 xmd-6 xm-12">
                      <div class="posrel">
                        <input type="text" class="mySelectCalenda calinput flyinput" name="checkin" id="checkin" placeholder="<?php echo $this->lang->line('HM_S_Apartment_placeholder_checkin'); ?>" />
                      </div>
                    </div>
                    <div class="col-md-6 md-6 xmd-6 xm-12 marxm">
                      <div class="posrel">
                        <input type="text" class="mySelectCalenda calinput flyinput" name="checkout" id="checkout" placeholder="<?php echo $this->lang->line('HM_S_Apartment_placeholder_checkout'); ?>" />
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-12 md-12 nopad left marbotom20">
                      <div class="col-md-4 md-4 xmd-12 xm-12 marxmd">
                          <div class="leftsrch">
                            <div class="inlabel psnico"><?php echo $this->lang->line('HM_S_Apartment_adult'); ?></div>
                          </div>
                          <div class="ritsrch">
                            <div class="inbar posrel myselect">
                              <select class="mySelectBoxClass flyinput text-right persn" name="adult" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16+</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-md-4 md-4 xmd-12 xm-12 marxmd">
                          <div class="leftsrch">
                            <div class="inlabel chilic"><?php echo $this->lang->line('HM_S_Apartment_children'); ?></div>
                          </div>
                          <div class="ritsrch">
                            <div class="inbar posrel myselect">
                              <select class="mySelectBoxClass flyinput text-right persn" name="child" required>
                                <option value="1">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16+</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-md-4 md-4 xmd-12 xm-12 marxmd">
                          <div class="leftsrch">
                            <div class="inlabel chi"><?php echo $this->lang->line('HM_S_Apartment_infant'); ?></div>
                          </div>
                          <div class="ritsrch">
                            <div class="inbar posrel myselect">
                              <select class="mySelectBoxClass flyinput text-right persn" name="infant" required>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16+</option>
                              </select>
                            </div>
                          </div>
                        </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-12 left marbotom20">
                    <input class="indxsrch shadows" type="submit" value="<?php echo $this->lang->line('HM_S_Apartment_search'); ?>" name="submit"/>
                  </div>
                </div>
                <div class="col-md-4 nopad">
                  <div class="myad"> <img src="<?php echo $banners->apartment_image; ?>" alt="<?php echo $this->lang->line('HM_S_Apartment_search'); ?>" /> </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>
<div class="clear"></div>
<div class="contentindex">
</div>
<?php

 $this->load->view('common/index_footer');?>
</body>
</html>
<script type="text/javascript">
function createPagination() {}
function createListingPagination() {}
function createReservationHistoryPagination() {}
function BookingPagination() {}
function createRvwPagination() {}
function createRefByYouPagination() {}
</script>
