<!DOCTYPE html>
<html>
<head>

<style type="text/css">
  .full{float:left;width:100%;}
  .marintopcnt{margin: 60px 0 0;}
  .contentvcr{background:#f6f6f6;}
  .container{max-width: 1170px;}
  .offset-0{padding-left:0px; padding-right:0px!important;}
  .centervoucher2 {
    display: table;
    margin: 0 auto;
    padding: 20px 0;
    width: 70%;}
  .col-md-12{
    width: 100%;
  }
  .col-md-12, .col-md-6, .col-md-4, .col-md-8 , .col-md-5, .col-md-2{
    position: relative;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
  }
  .alliconfrmt{display: block;
    overflow: hidden;
    padding: 15px 0 30px;
    text-align: right;}
  .clear{clear:both;}
  .col-md-6 {
    width: 50%;
    float: left;
  }
  .vocrlogo{display: block;
    overflow: hidden;
    padding: 20px 0;}
  .vcradrss{color: #666;
    display: block;
    line-height: 20px;
    overflow: hidden;
    text-align: right;}
  .iconmania{}
  .iconmania .icon{margin-right: 5px;}
  .witmd6{background: none repeat scroll 0 0 #fff;
    display: block;
    margin: 20px 0;
    overflow: hidden;
    padding: 15px;}
  .topvmsg{ display: block;
    margin-bottom: 10px;
    overflow: hidden;}
  .heloma{color: #333;
    display: block;
    font-size:16px;
    margin: 10px 0;
    overflow: hidden;}
  .msgvcr{color: #666;
    display: block;
    line-height: 20px;
    overflow: hidden;
    text-align: justify;}
  .detailhedv2 {color: #009dc3;
    display: block;
    font-size: 22px;
    margin-bottom: 12px;
    overflow: hidden;
    padding: 10px 0 25px;
    position: relative;}
  .col-md-4 {
    width: 33.33333333333333%;
    float: left;
  }
  .nopad{padding:0 !important;}
  .labliternry{color: #555;
    display: block;
    overflow: hidden;
    padding: 5px;}
  .col-md-8 {
    width: 66.66666666666666%;
    float: left;
  }
  .col-md-5 {
    width: 41.66666666666667%;
    float: left;
  }
  .wrpdte{border: 1px solid #e9e9e9;
    display: block;
    overflow: hidden;}
  .incty{background: none repeat scroll 0 0 #eee;
    display: block;
    overflow: hidden;
    padding: 10px;
    text-align: center;}
  .alldatecty{background: none repeat scroll 0 0 #fff;
    color: #666;
    display: block;
    font-size: 15px;
    overflow: hidden;
    padding: 10px;
    text-align: center;
    text-transform: uppercase;}
  .col-md-2 {
    width: 16.666666666666664%;
    float: left;
  }
  .aropng{background: url("../images/arow.png") no-repeat scroll center center rgba(0, 0, 0, 0);
    display: table;
    height: 40px;
    margin: 55px auto;
    width: 20px;}
  .othrdetsv{display: block;
    margin: 20px 0;
    overflow: hidden;
    padding-left: 30px;}
  .rowhost{display: block;
    margin-bottom: 15px;
    overflow: hidden;}
    .hosthed{border-bottom: 1px dotted #d8d8d8;}
    .hostvdets{display: block;
    overflow: hidden;}
    .namehstdets{color: #666;
    display: block;
    line-height: 20px;
    overflow: hidden;}
  div {outline:none !important;}
  </style>
</head>
<body>
<div class="full marintopcnt contentvcr" id="voucher">
    <div class="container">
        <div class="container offset-0">
        
        <div class="centervoucher2">
        
            <div class="clear"></div>
            
          <div class="col-md-6">
              <div class="vocrlogo"><img src="<?php echo ASSETS;?>images/logo.png" alt="<?php echo PROJECT_NAME;?> Logo" /></div>
            </div>
            
            <div class="col-md-6">
              <div class="vcradrss">
                  <?php echo PROJECT_NAME;?> office address<br />
                    Location of office
                  <div class="iconmania"><span class="icon icon-envelope"></span><a>office@<?php echo PROJECT_NAME;?>.com</a></div>
                   <div class="iconmania"><span class="icon icon-phone"></span> +91 123 456 7890</div>
                </div>
            </div>
            <div class="clear"></div>
        
          <div class="col-md-12">
              <div class="witmd6">
              <div class="topvmsg">
                  <h3 class="heloma">Hello, <?php echo $Booking->GUEST_FIRSTNAME;?></h3>
                    <span class="msgvcr">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod Tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo </span>
                </div>
                <div class="clear"></div>
                
                <div class="topvmsg">
                  <h3 class="detailhedv2">Itinerary</h3>
                    <!-- <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry">Confirmation code:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $Booking->booking_no;?></strong></div>
                        </div>
                    </div> -->
                    <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry">Booking Status:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $Booking->booking_status;?></strong></div>
                        </div>
                    </div>
                    <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry">Confirmation No:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $Booking->pnr_no;?></strong></div>
                        </div>
                    </div>
                    
                   <!--  <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry">Reference Number: </div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong>ITMBWWN15J</strong></div>
                        </div>
                    </div> -->
                </div>
                
                
                
                <div class="topvmsg">
                  <a href="#" target="new"><h3 class="detailhedv2"><?php echo $Booking->hotel_name;?>, <?php echo $Booking->city;?></h3></a>
                     <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry">Room Type:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $Booking->room_name;?></strong></div>
                        </div>
                    </div>
                    
                     <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry">Number of nights:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong>2</strong></div>
                        </div>
                    </div>
                    <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry">Guests:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $Booking->adult;?></strong></div>
                        </div>
                    </div>
                    <!-- <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry">Inclusion:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong>Room and Breakfast (Continental Breakfast)</strong></div>
                        </div>
                    </div> -->
                </div>
                
                <div class="topvmsg">
                  <div class="col-md-5">
                      <div class="wrpdte">
                          <span class="incty">Check In</span>
                            <div class="alldatecty">
                              <?php echo date('D, M', strtotime($Booking->checkin));?><strong><?php echo date('d', strtotime($Booking->checkin));?></strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                      <div class="aropng">&nbsp;</div>
                    </div>
                    <div class="col-md-5">
                      <div class="wrpdte">
                          <span class="incty">Check Out</span>
                            <div class="alldatecty">
                              <?php echo date('D, M', strtotime($Booking->checkout));?><strong><?php echo date('d', strtotime($Booking->checkout));?></strong>
                            </div>
                        </div>
                    </div>
                </div>
               </div> 
            </div>
            
            
            <div class="col-md-12">
              <div class="othrdetsv nopad">
                  
                    <div class="rowhost">
                      <h3 class="hosthed">Guest Name: <strong><?php echo $Booking->leadpax;?></strong></h3>
                        <div class="hostvdets">
                          <span class="namehstdets">
                              <p>You're advised to print the Voucher in the attachment above for your convenience. You're requested to present this voucher upon your arrival at hotel front desk. </p> 
                              <p>Thank you for using <?php echo PROJECT_NAME;?> online booking system. </p>
                              <br />
                              <br />
                              <p>With Compliments and Regards,<br />
              <?php echo PROJECT_NAME;?> Management</p>
                            </span>
                        </div>
                    </div>
                    

                    
                     
                    
                    
                </div>
            </div>
            
        </div>
    </div>
</div>
</div>

</body>
</html>
