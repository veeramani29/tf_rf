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
                        <input type="hidden" name="cityId" id="cityId">
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-12 md-12 nopad left marbotom20">
                    <div class="col-md-6 md-6 xmd-6 xm-12 marxmxl">
                      <div class="posrel">
                        <input type="text" class="mySelectCalenda calinput flyinput" name="hotel_checkin" id="hotel_checkin" placeholder="<?php echo $this->lang->line('HM_S_Hotel_placeholder_checkin'); ?>" required/>
                      </div>
                    </div>
                    <div class="col-md-6 md-6 xmd-6 xm-12 marxmxl">
                      <div class="posrel">
                        <input type="text" class="mySelectCalenda calinput flyinput" name="hotel_checkout" id="hotel_checkout" placeholder="<?php echo $this->lang->line('HM_S_Hotel_placeholder_checkout'); ?>" required/>
                      </div>
                    </div>
                    <!--<div class="col-md-4 md-4 xmd-12 xm-12 marxmd">
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
                    </div>-->
                  </div>
                  <div class="clearfix"></div>
                  
                  
                  
                  <div class="col-md-12 md-12 nopad left marbotom20">
                  
                  	<div class="col-md-6 md-6 xmd-6 xm-12">
                       	<div class="roomnum">
                          <span class="numroom"><?php echo $this->lang->line('HM_S_Hotel_passenger'); ?></span>
                         </div>
                    </div>
                    
                     <div class="col-md-6 md-6 xmd-6 xm-12">
                          <div class="leftsrch">
                            <div class="inlabelnew psnico"><?php echo $this->lang->line('HM_S_Hotel_placeholder_adult'); ?><strong>12+ yrs</strong></div>
                          </div>
                          <div class="ritsrch">
                            <div class="inbar posrel myselect">
                             
                                                    <div class="form-field field-select">
                            <a class="mySelectBoxClass flyinput text-right persn" id="adul" name="adul" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"></a>
                            <div class="collapse panel_addroom" id="collapseExample">
                              <div class="well">
                                <div id="cmn">
                                  <div class="par_roomcon" id="Room1">
                                    <h5>Room 1</h5>
                                    <div class="par_aduchild">
                                      <div class="par_textcon">Adult (+12)</div>
                                      <div class="incdec_buttons">
                                        <a href="#" id="rm1plus" class="btn btn-increment">+</a>
                                        <input type="text" name="txt1plus" id="txt1plus" class="form-control" placeholder="0" required="required" />
                                        <a href="#" id="rm1minus" class="btn btn-decrement">-</a>
                                      </div>
                                    </div>
                                    <div class="par_aduchild">
                                      <div class="par_textcon">Children <span>( 0-11 )</span></div>
                                      <div class="incdec_buttons">
                                        <a href="#" id="rm1plusChild" class="btn btn-increment">+</a>
                                        <input type="text" class="form-control" name="txt1plusChild" id="txt1plusChild" placeholder="0" />
                                        <a href="#" id="rm1minusChild" class="btn btn-decrement">-</a>
                                      </div>
                                    </div>
                                    <div class="par_aduchild childage">
                                      
                                    </div>
                                  </div>

                                </div>
                                <div class="par_adrobtn">
                                  <div class="col-sm-6 pad0">
                                    <a href="#" id="remove"><span>-</span>Remove Room</a>
                                  </div>
                                  <div class="col-sm-6 pad0 parab_dec">
                                    <a href="#" id="add"><span>+</span>Add Room</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                            </div>
                          </div>
                          
                    </div>
                    
                    

                  
                  </div>
                  <div class="clearfix"></div>
                  <div class="form-submit">
                <input type="hidden" value="0" name="total_adults" id="total_adults" />
                <input type="hidden" value="0" name="total_children" id="total_children" />
                <input type="hidden" value="0" name="total_rooms" id="total_rooms" />
                
    
              </div>
                  
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
