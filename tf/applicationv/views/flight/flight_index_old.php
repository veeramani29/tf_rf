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
            
            <div id="air2" class="tab-pane fade active in">
            <form name="flight" id="flight" action="<?php echo WEB_URL;?>/flight/search" autocomplete="off">
              <div class="col-md-12 left marbotom20 my12">
                <label class="tripmen">
                  <input type="radio" class="triprad iradio_flat-blue" name="trip_type" value="oneway"/>
                  <strong><?php echo $this->lang->line('HM_S_Flights_ow'); ?></strong> </label>
                <label class="tripmen">
                  <input type="radio" class="triprad iradio_flat-blue" name="trip_type" value="circle" checked/>
                  <strong><?php echo $this->lang->line('HM_S_Flights_rd'); ?></strong> </label>
                <label class="tripmen">
                  <input type="radio" class="triprad iradio_flat-blue" name="trip_type" value="multicity"/>
                  <strong><?php echo $this->lang->line('HM_S_Flights_md'); ?></strong> </label>
              </div>
              <div class="clearfix"></div>
              
              
              <div class="multyflightwrap">
              <!--normal-->
              <div class="full normal">
              <div class="col-md-12 nopad left marbotom20 my12">
                <div class="col-md-6 md-6 xm-12">
                  <div class="ritsrch">
                    <div class="inbar posrel">
                    	<span class="flightfrom"></span>
                      <input type="text" class="flyinput fromflight" placeholder="<?php echo $this->lang->line('HM_S_Flights_placeholder_from'); ?>" name="from" required/>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 md-6 xm-12 marxm">
                  <div class="ritsrch">
                    <div class="inbar posrel"> 
                      <span class="flighttoo"></span>
                      <input type="text" class="flyinput departflight" placeholder="<?php echo $this->lang->line('HM_S_Flights_placeholder_to'); ?>" name="to" required />
                    </div>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-md-12 nopad left marbotom20 my12">
                <div class="col-md-4 md-4 xm-12">
                  <div class="posrel">
                    <input type="text" class="mySelectCalenda calinput flyinput" name="depature" id="depature" placeholder="<?php echo $this->lang->line('HM_S_Flights_placeholder_depart'); ?>" required/>
                  </div>
                </div>
                <div class="col-md-4 md-4 xm-12 marxm">
                  <div class="posrel" id="returnDiv">
                  	<div class="onwayonly"></div>
                    <input type="text" class="mySelectCalenda calinput flyinput" name="return" id="return" placeholder="<?php echo $this->lang->line('HM_S_Flights_placeholder_return'); ?>" required/>
                  </div>
                </div>
                <div class="col-md-4 md-4 xm-12 marxm">
                  <div class="leftcsrch">
                    <div class="inlabel noiconc"><?php echo $this->lang->line('HM_S_Flights_class'); ?></div>
                  </div>
                  <div class="ritsrch">
                    <div class="inbar posrel myselect">
                      <select class="mySelectBoxClass flyinput text-right persn" id="class" name="class" required>
                        <option value="Economy"><?php echo $this->lang->line('HM_S_Flights_class_e'); ?></option>
                        <option value="PremiumEconomy"><?php echo $this->lang->line('HM_S_Flights_class_p'); ?></option>
                        <option value="Business"><?php echo $this->lang->line('HM_S_Flights_class_b'); ?></option>
                        <option value="First"><?php echo $this->lang->line('HM_S_Flights_class_f'); ?></option>
                        <option value="PremiumFirst"><?php echo $this->lang->line('HM_S_Flights_class_pf'); ?></option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-md-8 md-12 nopad left marbotom20">
                <div class="col-md-4 md-4 xm-12 marxm">
                  <div class="leftsrch">
                    <div class="inlabel psnico"><?php echo $this->lang->line('HM_S_Apartment_adult'); ?></div>
                  </div>
                  <div class="ritsrch">
                    <div class="inbar posrel myselect">
                      <select class="mySelectBoxClass flyinput text-right persn" id="adult" name="adult" required>
                        <option selected>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 md-4 xm-12 marxm">
                  <div class="leftsrch">
                    <div class="inlabel chilic"><?php echo $this->lang->line('HM_S_Apartment_children'); ?></div>
                  </div>
                  <div class="ritsrch">
                    <div class="inbar posrel myselect">
                      <select class="mySelectBoxClass flyinput text-right persn" id="child" name="child" required>
                        <option>0</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 md-4 xm-12 marxm">
                  <div class="leftsrch">
                    <div class="inlabel chi"><?php echo $this->lang->line('HM_S_Apartment_infant'); ?></div>
                  </div>
                  <div class="ritsrch">
                    <div class="inbar posrel myselect">
                      <select class="mySelectBoxClass flyinput text-right persn" id="infant" name="infant" required>
                        <option>0</option>
                        <option>1</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              </div>
              <!--normal end-->
              
              
              <!--    multycity     -->
            <div class="full multicity" style="display:none;">
            <div class="addedCities">
              <div class="col-md-12 nopad multyflight">
              <div class="col-md-11 col-xs-11 xm-12 nopad left marbotom20">
                <div class="col-md-4 md-4 xm-12 marxm">
                  <div class="ritsrch">
                    <div class="inbar posrel">
                    	<span class="flightfrom"></span>
                      <input type="text" class="flyinput fromflight" placeholder="<?php echo $this->lang->line('HM_S_Flights_placeholder_from'); ?>" name="mfrom[0]" id="from1" required/>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 md-4 xm-12 marxm">
                  <div class="ritsrch">
                    <div class="inbar posrel"> 
                      <span class="flighttoo"></span>
                      <input type="text" class="flyinput departflight" placeholder="<?php echo $this->lang->line('HM_S_Flights_placeholder_to'); ?>" name="mto[0]" id="to1" required />
                    </div>
                  </div>
                </div>
                
                <div class="col-md-4 md-4 xm-12 marxm">
                  <div class="posrel">
                    <input type="text" class="mySelectCalenda calinput flyinput" placeholder="<?php echo $this->lang->line('HM_S_Flights_placeholder_depart'); ?>" name="mdepature[0]" id="depature1" required/>
                  </div>
                </div>
                
              </div>
              <div class="col-md-1 xm-12"></div>
              </div>
              
              <div class="col-md-12  nopad multyflight">
              <div class="col-md-11 col-xs-11 xm-12 nopad left marbotom20">
                <div class="col-md-4 md-4 xm-12 marxm">
                  <div class="ritsrch">
                    <div class="inbar posrel">
                    	<span class="flightfrom"></span>
                      <input type="text" class="flyinput fromflight" placeholder="<?php echo $this->lang->line('HM_S_Flights_placeholder_from'); ?>" name="mfrom[1]" id="from2" required/>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 md-4 xm-12 marxm">
                  <div class="ritsrch">
                    <div class="inbar posrel"> 
                      <span class="flighttoo"></span>
                      <input type="text" class="flyinput departflight" placeholder="<?php echo $this->lang->line('HM_S_Flights_placeholder_to'); ?>" name="mto[1]" id="to2" required />
                    </div>
                  </div>
                </div>
                
                <div class="col-md-4 md-4 xm-12 marxm">
                  <div class="posrel">
                    <input type="text" class="mySelectCalenda calinput flyinput" placeholder="<?php echo $this->lang->line('HM_S_Flights_placeholder_depart'); ?>" name="mdepature[1]" id="depature2" required/>
                  </div>
                </div>
                
              </div>
              <div class="col-md-1 xm-12"></div>
              </div>
              
              
            </div>
              <div class="clearfix"></div>
              
             <!-- add button-->
              
              <div class="col-md-11 col-xs-11 xm-12">
              	<div class="addflight"><span class="icon icon-plus"></span><?php echo $this->lang->line('HM_F_Add_city'); ?></div>
              </div>
              <div class="col-md-1 col-xs-1">	
              &nbsp;
              </div>
              
              <!-- add button end-->
              
              <div class="clearfix"></div>
              
              
              <div class="clearfix"></div>
              <div class="col-md-11 col-xs-11 xm-12 nopad left marbotom20">
              	<div class="col-md-3 col-xs-3 fifmb xm-12 marxm">
                  <div class="leftcsrch classonly">
                    <div class="inlabel noiconc"><?php echo $this->lang->line('HM_S_Flights_class'); ?></div>
                  </div>
                  <div class="ritsrch">
                    <div class="inbar posrel myselect">
                      <select class="mySelectBoxClass flyinput text-right persn musthunded" id="class" name="class" required>
                       <option value="Economy"><?php echo $this->lang->line('HM_S_Flights_class_e'); ?></option>
                        <option value="PremiumEconomy"><?php echo $this->lang->line('HM_S_Flights_class_p'); ?></option>
                        <option value="Business"><?php echo $this->lang->line('HM_S_Flights_class_b'); ?></option>
                        <option value="First"><?php echo $this->lang->line('HM_S_Flights_class_f'); ?></option>
                        <option value="PremiumFirst"><?php echo $this->lang->line('HM_S_Flights_class_pf'); ?></option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-xs-3 fifmb xm-12 marxm">
                  <div class="leftsrch">
                    <div class="inlabel psnico"><?php echo $this->lang->line('HM_S_Flights_adult'); ?></div>
                  </div>
                  <div class="ritsrch">
                    <div class="inbar posrel myselect">
                      <select class="mySelectBoxClass flyinput text-right persn musthunded multi_adt" id="adult" name="adult" required>
                        <option selected>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-xs-3 fifmb xm-12 marxm">
                  <div class="leftsrch">
                    <div class="inlabel chilic"><?php echo $this->lang->line('HM_S_Flights_children'); ?></div>
                  </div>
                  <div class="ritsrch">
                    <div class="inbar posrel myselect">
                      <select class="mySelectBoxClass flyinput text-right persn musthunded multi_chd" id="child" name="child" required>
                        <option>0</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-xs-3 fifmb xm-12 marxm">
                  <div class="leftsrch">
                    <div class="inlabel chi"><?php echo $this->lang->line('HM_S_Flights_infant'); ?></div>
                  </div>
                  <div class="ritsrch">
                    <div class="inbar posrel myselect">
                      <select class="mySelectBoxClass flyinput text-right persn musthunded multi_inf" id="infant" name="infant" required>
                        <option>0</option>
                        <option>1</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-1"></div>
              </div>
              <!--    multycity  end   -->
              </div>
              
              
              <div class="clearfix"></div>
              <div class="col-md-8 left marbotom20">
                <input class="indxsrch shadows" name="flight_submit" type="submit" value="<?php echo $this->lang->line('HM_S_Flights_search_flights'); ?>"/>
              </div>
              <div class="clearfix"></div>
              <div class="flitad"> <span class="glyphicon glyphicon-ok"></span>
                <div class="adcap"> <strong><?php echo $this->lang->line('HM_S_Flights_title'); ?></strong><br />
                 <?php echo $this->lang->line('HM_S_Flights_description'); ?> </div>
              </div>
              </form>
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
