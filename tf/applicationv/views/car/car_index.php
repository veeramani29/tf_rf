<?php $this->load->view('common/header'); ?>
<div class="searchindex">
  <div class="container">
    <div class="col-md-12 full nopad">
      <div class="bs-example bs-example-tabs tabwrap">
        
        <div class="intabs">
          <div class="tab-content2 rittab nopad" id="myTabContent"> 
            
            <!-- Apartments -->
            
            <div id="carr" class="tab-pane fade active in">
              <div class="col-md-9 nopad">
              <form name="cars" id="cars" action="<?php echo WEB_URL;?>/car/search" autocomplete="off">
              <div class="apart">
                <div class="bigsent">Search for cars</div>
                <div class="smalsent"> The best cars for rent </div>
              </div>            
              <div class="clearfix"></div>
              <div class="col-md-12 nopad left marbotom20 my12">
                <div class="col-md-6 md-6 xm-12">
                  <div class="ritsrch">
                    <div class="inbar posrel">
                      <input type="text" class="flyinput fromflight locmark " placeholder="Picking up" name="pickup" required/>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 md-6 xm-12 marxm">
                  <div class="ritsrch">
                    <div class="inbar posrel"> 
                      <input type="text" class="flyinput departflight locmark" placeholder="Dropping off" name="dropoff" required />
                    </div>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-md-12 nopad left marbotom20 my12">
                <div class="col-md-3 md-6 xm-12">
                  <div class="posrel">
                    <input type="text" class="mySelectCalenda calinput flyinput" name="cdepature" id="cdepature" placeholder="Pick up date" required />
                  </div>
                </div>
                <div class="col-md-3 md-6 xm-12 marxm">
                  <div class="posrel myselect">
                    <select class="mySelectBoxClass flyinput persn myselectlespad" id="deptime" name="deptime" required>
                        <?php for($i = 1; $i <= 24; $i++){ for($j=0;$j<=3;$j++){ $s = $j*15;?>
                          <option value="<?php echo date("H:i", strtotime("$i:$s")); ?>"><?php echo date("H:i", strtotime("$i:$s")); ?></option>
                        <?php }}?>
                      </select>
                  </div>
                </div>

                  <div class="col-md-3 md-6 xm-12">
                  <div class="posrel">
                    <input type="text" class="mySelectCalenda calinput flyinput" name="creturn" id="creturn" placeholder="Drop off date" required />
                  </div>
                </div>
                <div class="col-md-3 md-6 xm-12 marxm">
                  <div class="posrel myselect">
                    <select class="mySelectBoxClass flyinput persn myselectlespad" id="rettime" name="rettime" required>
                        <?php for($i = 1; $i <= 24; $i++){ for($j=0;$j<=3;$j++){ $s = $j*15;?>
                          <option value="<?php echo date("H:i", strtotime("$i:$s")); ?>"><?php echo date("H:i", strtotime("$i:$s")); ?></option>
                        <?php }}?>
                      </select>
                  </div>
                </div>
                  

              </div>
              <div class="clearfix"></div>

              <div class="col-md-8 left marbotom20">
                <input class="indxsrch shadows" name="flight_submit" type="submit" value="Search Cars"/>
              </div>
              <div class="clearfix"></div>
              </form>
              </div>
              
              <div class="col-md-3 nopad">
                  <div class="myad"> <img src="images/ad.png" alt="" /> </div>
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
