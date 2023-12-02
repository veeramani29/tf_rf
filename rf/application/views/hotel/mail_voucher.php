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
    <div class="rfboxed-backgroundf">      
      <div class="voucherheader_container">
        <div class="">
        
        <div class="centervoucher2">
        
          <div class="col-md-12">
               <div class="fv_printvoucher">
          <a class="voucher_printer" data-toggle="tooltip" data-placement="top" title="<?php echo lang_line('PRINT_VOUCHER');?>"  onclick="PrintDiv();">
            <i class="fa fa-print"></i>
          </a>
        </div>
            </div>
          
            <div class="clear"></div>
            
          <div class="col-md-6">
            
                    <img src="<?php echo ASSETS;?>images/logo.png" alt="rfactory Logo" class="voucherlogo_width" />
               
            </div>
            
            <div class="col-md-6">
             <div class="pull-right">
         <?php echo $voucher_details->flight_cl_address; ?>
         <div class="iconmania"><span class="icon icon-envelope"></span><a> <?php echo $voucher_details->flight_cl_email; ?></a></div>
         <div class="iconmania"><span class="icon icon-phone"></span> <?php echo $voucher_details->flight_cl_phone; ?></div>
        
                               </div>
            </div>
            <div class="clear"></div>
        
          <div class="col-md-12">
              <div class="witmd6">
              <div class="topvmsg">
                  <h3 class="heloma">Hello, <?php echo $Booking->GUEST_FIRSTNAME;?></h3>
                    <span class="msgvcr"><?php echo lang_line('HOTEL_BOOKING_TNX_MSG');?></span>
                </div>
                <div class="clear"></div>
                
                <div class="topvmsg">
                  <h3 class="detailhedv2"><?php echo lang_line('ITINERY');?></h3>

                <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry"><?php echo lang_line('BOOKING_STATUS');?>:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $Booking->booking_status;?></strong></div>
                        </div>
                    </div>
                    <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry"><?php echo lang_line('CONF_NO');?>:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $Booking->pnr_no;?></strong></div>
                        </div>
                    </div>                     <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry"><?php echo lang_line('RESERVATION_CODE');?>:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $Booking->booking_no;?></strong></div>
                        </div>
                    </div> 


                      <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry"><?php echo lang_line('HOTEL_RESERVATION_CODE');?>:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo ($Booking->ReservationLocatorCode!=null)?$Booking->ReservationLocatorCode:"N/A";?></strong></div>
                        </div>
                    </div> 
                </div>
                
                
                
                <div class="topvmsg">
                  <a href="#" target="new"><h5><?php echo $Booking->hotel_name;?>, <?php echo $Booking->city;?></h5></a>
                     <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry"><?php echo lang_line('ROOM_TYPE');?>:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $Booking->room_name;?></strong></div>
                        </div>
                    </div>
                    
                     <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry"><?php echo lang_line('NO_OF_NIGHTS');?>:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $number_of_nights; ?></strong></div>
                        </div>
                    </div>
                    <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry"><?php echo lang_line('GUESTS');?>:</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $Booking->adult;?></strong></div>
                        </div>
                    </div>

                </div>
                
                <div class="topvmsg">
                  <div class="col-md-5">
                      <div class="wrpdte">
                          <span class="incty"><?php echo lang_line('CHECKIN');?></span>
                            <div class="alldatecty">
                              <?php echo date('D, M', strtotime($Booking->checkin));?><strong> <?php echo date('d', strtotime($Booking->checkin));?></strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                      <div class="aropng">&nbsp;</div>
                    </div>
                    <div class="col-md-5">
                      <div class="wrpdte">
                          <span class="incty"><?php echo lang_line('CHECKOUT');?></span>
                            <div class="alldatecty">
                              <?php echo date('D, M', strtotime($Booking->checkout));?><strong> <?php echo date('d', strtotime($Booking->checkout));?></strong>
                            </div>
                        </div>
                    </div>
                </div>
               </div> 
            </div>
            
            
            <div class="col-md-12">
              <div class="othrdetsv nopad">
                  
                    <div class="rowhost">
                      <h3 class="hosthed"><?php echo lang_line('NAME');?>: <strong><?php echo $Booking->leadpax;?></strong></h3>
                        <div class="hostvdets">
                          <span class="namehstdets">
                               <p><?php echo lang_line('HOTEL_INVOICE_MSG');?></p> 
                <p><?php echo lang_line('Booking_Voucher_Msg');?></p>
                <br />
                <br />
                <p><?php echo lang_line('HOTEL_INVOICE_REGARDS');?><br />
                 <?php echo WEB_NAME;?></p>
                            </span>
                        </div>
                    </div>
                    

                    
                     
                    
                    
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
