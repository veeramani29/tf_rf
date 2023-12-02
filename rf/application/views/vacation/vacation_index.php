<?php $this->load->view('common/header'); ?>
<div class="searchindex">
  <div class="container">
    <div class="col-md-12 full nopad">
      <div class="bs-example bs-example-tabs tabwrap">
        
        <div class="intabs">
          <div class="tab-content2 rittab nopad" id="myTabContent"> 
            
            <!-- Apartments -->
            
            <div id="vacation" class="tab-pane fade active in">
              <div class="col-md-9 nopad">
              <form name="vacation" id="vacations" action="<?php echo WEB_URL;?>/vacation/search" autocomplete="off">
              <div class="apart">
                <div class="bigsent">Book Domestic & International Holiday packages </div>
              </div>            
              <div class="clearfix"></div>
              <div class="col-md-12 nopad left marbotom20 my12">
                <div class="col-md-10">
                  <div class="ritsrch">
                    <div class="inbar posrel">
                      <input type="text" class="flyinput vac_city locmark" placeholder="Type specific destination" name="vac_city" required/>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class="clearfix"></div>
              <div class="col-md-12 nopad left marbotom20 my12">
              
              	<div class="col-md-6 marxm">
                  <div class="posrel myselect siderit">
                    <select class="mySelectBoxClass flyinput persn myselectlespad" id="vac_type" name="vac_type" required>
                        <option value="all" selected="selected">Select holiday type</option>
                        <?php foreach($vacation_types as $vacation){?>
                          <option <?php echo $vacation->packages_types_name;?>><?php echo ucfirst($vacation->packages_types_name);?></option>
                        <?php }?>
                      </select>
                  </div>
                </div>
              
                <div class="col-md-4">
                  <div class="posrel">
                    <input type="text" class="mySelectCalenda calinput flyinput" name="vac_date" id="vac_date" placeholder="Trip start date" required />
                  </div>
                </div>
                

                  
                
                  

              </div>
              <div class="clearfix"></div>

              <div class="col-md-8 left marbotom20">
                <input class="indxsrch shadows" name="flight_submit" type="submit" value="Search Holidays"/>
              </div>
              <div class="clearfix"></div>
              </form>
              </div>
              
              <div class="col-md-3 nopad">
                  <div class="myad"> <img src="images/ad.png" alt="Sell your property free!" /> </div>
                </div>
              
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
