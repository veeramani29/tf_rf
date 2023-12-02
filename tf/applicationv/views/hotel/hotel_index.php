<?php $this->load->view('common/header'); 
$language = $this->session->userdata('language');

  if($language){
	 $this->lang->load('Home_Page_HM', $language);
	  }else{
	 $this->lang->load('Home_Page_HM', 'english');
	  }

?>
<div class="searchindex">
  <div class="container">
    <div class="col-md-12 full nopad">
      <div class="bs-example bs-example-tabs tabwrap">
        
        <div class="intabs">
          <div class="tab-content2 rittab nopad" id="myTabContent"> 
            
            <!-- Apartments -->
            
            <div id="hoteltab" class="tab-pane fade active in">
              <form name="hotel_search" id="hotel_search" action="<?php echo WEB_URL; ?>/hotel/search" method="get" autocomplete="off">
                <div class="col-md-8 nopad">
                  <div class="apart">
                    <div class="bigsent"><?php echo $this->lang->line('HM_S_Hotel_title'); ?></div>
                    <div class="smalsent"><?php echo $this->lang->line('HM_S_Hotel_description'); ?></div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-12 nopad left marbotom20 my12">
                    <div class="col-md-12 md-12 xmd-12 xm-12">
                      <div class="ritsrch">
                        <div class="inbar posrel">
                          <input type="text" id="hotel_autocomplete" class="flyinput locmark hotel_autocomplete" name="city" placeholder="<?php echo $this->lang->line('HM_S_Hotel_placeholder_from'); ?>" onFocus="geolocate()" required/>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-12 md-12 nopad left marbotom20">
                    <div class="col-md-4 md-4 xmd-6 xm-12 marxmxl">
                      <div class="posrel">
                        <input type="text" class="mySelectCalenda calinput flyinput" name="hotel_checkin" id="hotel_checkin" placeholder="<?php echo $this->lang->line('HM_S_Hotel_placeholder_checkin'); ?>" required/>
                      </div>
                    </div>
                    <div class="col-md-4 md-4 xmd-6 xm-12 marxmxl">
                      <div class="posrel">
                        <input type="text" class="mySelectCalenda calinput flyinput" name="hotel_checkout" id="hotel_checkout" placeholder="<?php echo $this->lang->line('HM_S_Hotel_placeholder_checkout'); ?>" required/>
                      </div>
                    </div>
                    <div class="col-md-4 md-4 xmd-12 xm-12 marxmd">
                      <div class="leftsrch">
                        <div class="inlabel rumnoc"><?php echo $this->lang->line('HM_S_Hotel_placeholder_rooms'); ?></div>
                      </div>
                      <div class="ritsrch">
                        <div class="inbar posrel myselect">
                          <select class="mySelectBoxClass flyinput text-right persn" name="rooms" required>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  
                  
                  
                  <div class="col-md-12 md-12 nopad left marbotom20">
                  
                  	<div class="col-md-4 md-4 xmd-6 xm-12">
                       	<div class="roomnum">
                          <span class="numroom"><?php echo $this->lang->line('HM_S_Hotel_passenger'); ?></span>
                         </div>
                    </div>
                    
                     <div class="col-md-4 md-4 xmd-6 xm-12">
                          <div class="leftsrch">
                            <div class="inlabelnew psnico"><?php echo $this->lang->line('HM_S_Hotel_placeholder_adult'); ?><strong>12+ yrs</strong></div>
                          </div>
                          <div class="ritsrch">
                            <div class="inbar posrel myselect">
                             <select class="mySelectBoxClass flyinput text-right persn" name="adult" required>

                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                            </div>
                          </div>
                    </div>
                    
                    

                  
                  </div>
                  <div class="clearfix"></div>
                  
                  <div class="col-md-12 left marbotom20">
                    <input class="indxsrch shadows" type="submit" value="<?php echo $this->lang->line('HM_S_Hotel_search'); ?>" name="submit"/>
                  </div>
                </div>
                <div class="col-md-4 nopad">

                  <div class="myad"> <img src="<?php echo $banners->hotel_image; ?>" alt="Sell your property free!" /> </div>
                </div>
              </form>
              <div class="clearfix"></div>
            </div>
            
            <!--Flight starts here -->
            
            
            
            <!--Flight End  here -->
            
            
            
            <!--End of 2nd tab -->
            
            
            <!--End of car tab -->
            
            
            
            
            

            
            
            
            
            
            
            
            
            
          </div>
        </div>
        <div class="searchbg2" style="display:none;">
          <div class="left ca01"><a href="#">Advanced +</a></div>
          <form action="list4.html">
            <button type="submit" class="btn-search right mr30"><?php echo $this->lang->line('search'); ?></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="clear"></div>
<div class="contentindex">
  
</div>




<?php $this->load->view('common/index_footer');?>
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
