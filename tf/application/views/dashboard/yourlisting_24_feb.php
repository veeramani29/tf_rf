<!-- Your listing -->
<div class="tab-pane padding20me <?php if (!empty($page_type) && $page_type == "listing") {
    echo "active";
} ?>" id="yourlisting">
    <div class="col-md-3">
        <ul class="sideul">
            <li class="sidepro active" id="manageListingHandle"><a href="#mangelisting" data-toggle="tab">Manage Listing</a></li>
            <li class="sidepro" id="reserHistoryHandle"><a href="#ureservations" data-toggle="tab">Reservation History</a></li>
            <li class="sidepro" id="paymentHandle"><a href="#paymentmethod" data-toggle="tab">Payment Method</a></li>
            <li class="sidepro" id="transactHandle"><a href="#resrvationreq" data-toggle="tab">Transaction History</a></li>
        </ul>
    </div>

    <div class="col-md-9">
        <div class="tab-content5">
            <br>
            <div class="tab-pane active" id="mangelisting">
                <span class="size16 padtabne bold">
                    <select class="verifysel" id="mngList">
                        <option value="1">Show all-listing</option>
                        <option value="2">Show active</option>
                        <option value="3">Show hidden</option>
                    </select>
                </span>
                <div class="withedrow">
                    <div class="rowit">
                        <div id="LstngLdr" class="lodrefrentrev imgLoader">
                            <div class="centerload"></div>
                        </div>
                        <ul id="lstContainer">
                            
                           <?php if(!empty($get_user_listings)) { foreach($get_user_listings as $key => $value) { 
                                  $completed_status = $this->Listings_Model->get_property_listings_completed_modules($value->PROPERTY_ID);  
                                  $completed_status_count = 4;
                                  if(!empty($completed_status))
                                  {
                                  foreach($completed_status as $skey => $svalue){
                                      if($svalue->completed_status == 1){
                                         $completed_status_count--; 
                                      }
                                  }
                                }
                           ?>
                                <li class="mesginbox celbig">
                                <div class="col-md-2 celtbl urlistimg">
                                    <div class="inboximg">
                                        <?php if($value->PROPERTY_STATUS == 1) { ?>
                                            <a class="" href="<?php echo WEB_URL; ?>/apartment/rooms/<?php echo $value->PROPERTY_ID; ?>">
                                        <?php } ?>
                                            <?php $image = $this->Listings_Model->get_property_photos($value->PROPERTY_ID,1);
                                                if(!empty($image)){?>
                                                    <img width="96" height="61" style="clear: both;float: left;" src="data:image/png;base64,<?php echo $image[0]->PHOTO_CONTENT; ?>">  
                                                <?php }else{?>
                                                <img src="<?php echo ASSETS; ?>images/smallthumb-1.jpg" alt=""  />      
                                            <?php } ?>                                          
                                        <?php if($value->PROPERTY_STATUS == 1) { ?>
                                            </a>
                                        <?php } ?>  
                                    </div>
                                </div>
                                <div class="col-md-4 celtbl">
                                    <div class="inboxlabl">
                                        <a class="listaptname" href="<?php echo WEB_URL; ?>/listings/edit_listings/<?php echo $value->PROPERTY_ID; ?>"><?php echo $value->PROP_TYPE_LABEL; ?> in <?php echo $value->PROP_CITY; ?></a>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 celtbl urlistimg">
                                <?php if($completed_status_count != 0) { ?>
                                <div class="vertymid">
                                    <a class="tomorelist" href="<?php echo WEB_URL; ?>/listings/edit_listings/<?php echo $value->PROPERTY_ID; ?>"><?php echo $completed_status_count; ?> Steps to list</a>
                                </div>
                                <?php } elseif($value->PROP_COUNTRY == 'AE' && $value->ADMIN_APPROVAL_STATUS == 0) { ?>
                                    <div class="vertymid">
                                        <p style="color:red;">Require approval from admin</p>
                                    </div>                                                                      
                                <?php } elseif($completed_status_count == 0) { ?>
                                      <select name="edit_listings_status" id="edit_listings_status" class="form-control lastsel" required onchange="change_listings_status('<?php echo $value->PROPERTY_ID; ?>',this.value);">
                                            <option value="1" <?php if($value->PROPERTY_STATUS == 1) {echo "selected=selected"; } ?> >List</option>
                                            <option value="0" <?php if($value->PROPERTY_STATUS == 0) {echo "selected=selected"; } ?> >Unlist</option>
                                      </select>
                                <?php } ?>
                                </div>
                                
                                </li>
                            <?php } } else { ?>
                                <div class="col-md-12" style="margin: 0 auto; text-align: center;">
                                    <div class="srywrap"><span class="sorrydiv"><img src="<?php echo WEB_URL; ?>/assets/images/sorry.png" alt="" /></span><b>Nothing here</b></div>
                                </div>
                            <?php } ?>
                        </ul>
                        <div class="holdere"></div>
                        <?php if(isset($userInfo->user_id)) { ?>
                        <p class="normalpara">
                            <?php if ($userInfo->property_owner_created == 1) { ?>                          
                            <?php } elseif ($userInfo->property_owner_request == 1) { ?>    
                                <p style="color:red;">Request have been sent to admin approval</p>
                            <?php } elseif ($userInfo->property_owner_created == 0) { ?>                                
                            
                            <form method="post" id="ownerReq" name="listings" action="<?php echo WEB_URL; ?>/account/updateB2cUserListingAjax">
                                <input type="checkbox" required="required" name="access_listings" style="clear: both;float: left;margin-right: 15px;"/>
                                Please request admin approval for adding the property listings.                             
                                <button class="btn-search5" type="submit" style="clear: both;float: left;margin-top: 19px;">Save changes</button>
                            </form>
                            
                            <?php } ?>
                        </p>
                        <?php } elseif(isset($userInfo->agent_id)) { ?>
                            <p class="normalpara">
                                <?php if ($userInfo->property_owner_created == 1) { ?>                          
                                <?php } elseif ($userInfo->property_owner_request == 1) { ?>    
                                   <p style="color:red;">Request have been sent to admin approval</p> 
                                <?php } elseif ($userInfo->property_owner_created == 0) { ?>                                
                                <form method="post" name="listings" action="<?php echo WEB_URL; ?>/account/update_b2b_user_listing_property_access">
                                    <input type="checkbox" required="required" name="access_listings" style="clear: both;float: left;margin-right: 15px;"/>
                                    Please request admin approval for adding the property listings.                             
                                    <button class="btn-search5" type="submit" style="clear: both;float: left;margin-top: 19px;">Save changes</button>
                                </form>
                                <?php } ?>
                            </p>
                        <?php } ?>
                    </div>
                </div>
            </div> 
            <div class="tab-pane" id="ureservations">
                <span class="size16 padtabne bold">Reservation History</span>
                <div class="withedrow">
                    <ul id="rsrvtnHistory" class="rowit">
                    <?php
                        if(!empty($HostBookings)){ foreach($HostBookings as $booking){
                            //echo $booking->user_type.'ham';
                        $UserInfo = $this->account_model->GetUserData($booking->user_type, $booking->user_id)->row();
                        //print_r($hostUserInfo);
                        if($booking->user_type == '3'){
                            if($UserInfo->profile_photo == ''){
                                $profile_photo = ASSETS.'images/user-avatar.jpg';
                            }else{
                                $profile_photo = $UserInfo->profile_photo;
                            }
                            $email = $UserInfo->email;
                            $contact_no = $UserInfo->contact_no;
                        }else if($booking->user_type == '2'){
                            if($UserInfo->agent_logo == ''){
                                $profile_photo = ASSETS.'images/user-avatar.jpg';
                            }else{
                                $profile_photo = $UserInfo->agent_logo;
                            }
                            $email = $UserInfo->email_id;
                            $contact_no = $UserInfo->mobile;
                        }
                    ?>                    
                    <li class="mesginbox rehistory">
                    <div class="lodrefrent"><div class="centerload"></div></div>
                    <div class="nopwrap">
                    <div class="col-md-2 nopad nop nopwit">
                        <a href="<?php echo WEB_URL.'/users/show/'.$booking->USER_ID;?>"><div class="userimagere"><img src="<?php echo $profile_photo;?>" alt="" /></div></a>
                        <a href="<?php echo WEB_URL.'/users/show/'.$booking->USER_ID;?>"><span class="usrnamere"><?php echo $UserInfo->firstname.' '.$UserInfo->lastname;?></span></a>
                    </div>
                    <div class="col-md-10 nopad nop">
                        <div class="col-md-2 padforhe"> 
                          <a class="fullpikr" href="<?php echo WEB_URL.'/apartment/rooms/'.$booking->PROP_ID;?>">
                            <?php $img = $this->apartment_model->view_property_file($booking->PROP_PHOTO);?>
                            <img src="<?php echo $img;?>" alt="" width="99" height="91"/>
                          </a> 
                        </div>
                        
                        <div class="col-md-10 nopad">
                        <div class="topfis">
                        <div class="col-md-5">
                            <div class="fiscal mincal">
                                <div class="lablofuxhed">Check In</div>
                                <div class="answrfuxdes">
                                    <span class="dvasam"><?php echo date('d', strtotime($booking->RES_CHECK_IN));?></span>
                                    <span class="varsham"><?php echo date('D M Y', strtotime($booking->RES_CHECK_IN));?></span>
                                </div>
                            </div>

                            <div class="fiscal mincal">
                                <div class="lablofuxhed">Check Out</div>
                                <div class="answrfuxdes">
                                    <span class="dvasam"><?php echo date('d', strtotime($booking->RES_CHECK_OUT));?></span>
                                    <span class="varsham"><?php echo date('D M Y', strtotime($booking->RES_CHECK_OUT));?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-7 nopad">
                            <div class="rowfux">
                                <div class="col-md-6 nopad">
                                    <div class="lablofux">Reservation Date</div>
                                </div>
                                <div class="col-md-6 nopad">
                                    <div class="answrfux"> <?php echo date('D, d M Y', strtotime($booking->voucher_date));?></div>
                                </div>
                            </div>
                            
                            <div class="rowfux">
                                <div class="col-md-6 nopad">
                                    <div class="lablofux">Confirmation No</div>
                                 </div>
                                <div class="col-md-6 nopad">
                                    <div class="answrfux"> <?php echo $booking->pnr_no;?></div>
                                </div>
                            </div>
                            
                            <div class="rowfux">
                                <div class="col-md-6 nopad">
                                    <div class="lablofux nomarb">Booking Status</div>
                                </div>
                                <div class="col-md-6 nopad">
                                    <div class="answrfux nomarb bstatus"> <?php echo $booking->booking_status;?></div>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        
                        <div class="clear"></div>
                        
                        <div class="col-md-6 padforhe">
                            <div class="flikrallll">
                          <a href="<?php echo WEB_URL.'/apartment/rooms/'.$booking->PROP_ID;?>" class="dark flikrdesc"><?php echo $booking->PROP_NAME;?></a> 
                          <span class="grayish size12"><?php echo $booking->PROP_CITY;?> - <?php echo $booking->COUNTRY_NAME;?></span><br>
                          <span class="green bold size20"><?php echo CURR_ICON?><?php echo $booking->amount;?></span> 
                          </div>
                       </div>
                
                        <div class="col-md-6 nopad">
                            <div class="botufis heyu">
                                <?php //if($booking->booking_status == 'PENDING'){?>
                                    <a title="Actions" data-placement="top" id="<?php echo $booking->pnr_no;?>" class="btn btn-danger btn-xs tooltiph dropdown-toggle delact" data-toggle="dropdown">
                                                    <i class="icon-plus"></i>
                                                  </a>
                                                  <ul class="dropdown-menu imptop"> 
                                                  <?php if($booking->booking_status == 'PENDING'){?>
                                                      <li class="actionlink"><a class="inqrbk" data-booking-id="<?php echo $booking->pnr_no;?>" data-booking-status="1">
                                                        <span class="icon icon-check"></span> Accept</a></li>
                                                <?php }?>
                                                      <li class="actionlink"><a class="inqrbk" data-booking-id="<?php echo $booking->pnr_no;?>" data-booking-status="0">
                                                        <span class="icon icon-off"></span>Decline</a></li>
                                                   </ul>
                                <?php //}?>
                                   <a href="<?php echo WEB_URL.'/apartment/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" title="View Invoice" data-placement="top" class="btn btn-success btn-xs tooltiph" >
                                              <i class="icon-tags"></i><span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                            </a>
                                    
                                    <a href="<?php echo WEB_URL.'/apartment/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="new" data-placement="top" class="btn btn-primary btn-xs tooltiph" title="View Voucher">
                                        <i class="icon-ticket"></i>
                                    </a>
                                </div>
                        </div>
                        
                    </div>
                    </div>
                    
                    </li>
<?php }} else { ?>
                <div class="col-md-12" style="margin: 0 auto; text-align: center;">
                    <div class="srywrap"><span class="sorrydiv"><img src="<?php echo WEB_URL; ?>/assets/images/sorry.png" alt="" /></span><b>Nothing here</b></div>
                </div>
<?php } ?>                   
                    
                    
                    
                       <!-- <p class="normalpara">
                            <?php if ($userInfo->property_owner_created == 1) { ?>                          

                            <?php } elseif ($userInfo->property_owner_request == 1) { ?>    
                                Request have been sent to admin approval
                        <?php } elseif ($userInfo->property_owner_created == 0) { ?>                                
                            <form method="post" name="listings" action="<?php echo WEB_URL; ?>/account/update_b2c_user_listing_property_access">
                                <input type="checkbox" required="required" name="access_listings" style="clear: both;float: left;margin-right: 15px;"/>
                                Please request admin approval for adding the property listings.                             
                                <button class="btn-search5" type="submit" style="clear: both;float: left;margin-top: 19px;">Save changes</button>
                            </form>
                        <?php } ?>
                        </p>-->
                    </ul>
                    <div class="holderResHistory"></div>
                </div>
            </div>
            <div class="tab-pane" id="paymentmethod">
                <span class="size16 padtabne bold">Payment Method</span>
                <div class="withedrow">
                    <div class="rowit">
                        <p class="normalpara">
                            Select a payment option in order to enable your listing owner account.
                        </p>
                        <div class="clear"></div>
                        <div class="col-md-6 nopad">
                            <form action="">
                            
                            <div class="paymentbank">
                            
                                <div class="paymentheading">Payment by bank</div>
                                
                                <div class="wrappayment">
                                <div class="phlabl">Name on account:</div>
                                <input class="form-control" type="text" id="" placeholder="">
                                <span style="color: red; font-size:small" class="errPhone"></span>
                                </div>

                                <div class="wrappayment">
                                <div class="phlabl">Name of bank:</div>
                                <input class="form-control" type="text" id="" placeholder="">
                                <span style="color: red; font-size:small" class="errPhone"></span>
                                </div> 
                                
                                <div class="wrappayment">
                                <div class="phlabl">Type of account:</div>
                                <select class="form-control hasCustomSelect cpwidth3" id="countryPhoneCode">
                                    <option value="">Select Country</option>
                                    <?php foreach($countryCode as $code_key) { ?> 
                                      <option value="<?php echo $code_key->phonecode; ?>"><?php echo $code_key->name; ?></option>
                                    <?php } ?>
                                </select>
                                <span style="color: red; font-size:small" class="errCountry"></span>
                                </div>
                                
                                <br>
                                <button class="btn-search5" id="" type="submit">Proceed</button>
                                <img class="sendingLoader" src=" <?php echo ASSETS.'/images/loader.gif' ?>  ">
                             </div>
                            
                            </form>    
                        </div>

                        <div class="col-md-6 nopad">
                        
                            <div class="paymentpaypal">
                            
                                <div class="paymentheading">Payment by paypal</div>
                                
                                <div class="wrappayment">
                                <div class="phlabl">Name on account:</div>
                                <input class="form-control" type="text" id="" placeholder="">
                                <span style="color: red; font-size:small" class="errPhone"></span>
                                </div>

                                <div class="wrappayment">
                                <div class="phlabl">Name of bank:</div>
                                <input class="form-control" type="text" id="" placeholder="">
                                <span style="color: red; font-size:small" class="errPhone"></span>
                                </div> 
                                
                                <div class="wrappayment">
                                <div class="phlabl">Type of account:</div>
                                <select class="form-control hasCustomSelect cpwidth3" id="countryPhoneCode">
                                    <option value="">Select Country</option>
                                    <?php foreach($countryCode as $code_key) { ?> 
                                      <option value="<?php echo $code_key->phonecode; ?>"><?php echo $code_key->name; ?></option>
                                    <?php } ?>
                                </select>
                                <span style="color: red; font-size:small" class="errCountry"></span>
                                </div>
                                
                                <br>
                                <button class="btn-search5" id="" type="submit">Proceed</button>
                                <img class="sendingLoader" src=" <?php echo ASSETS.'/images/loader.gif' ?>  ">
                             </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="resrvationreq">
                <span class="size16 padtabne bold">Transaction History</span>
                <div class="withedrow">
                    <div class="rowit">
                        <p class="normalpara">
                            <?php if ($userInfo->property_owner_created == 1) { ?>                          

                            <?php } elseif ($userInfo->property_owner_request == 1) { ?>    
                                Request have been sent to admin approval
                            <?php } elseif ($userInfo->property_owner_created == 0) { ?>                                
                            <form method="post" name="listings" action="<?php echo WEB_URL; ?>/account/update_b2c_user_listing_property_access">
                                <input type="checkbox" required="required" name="access_listings" style="clear: both;float: left;margin-right: 15px;"/>
                                Please request admin approval for adding the property listings.                             
                                <button class="btn-search5" type="submit" style="clear: both;float: left;margin-top: 19px;">Save changes</button>
                            </form>
                        <?php } ?>
                        </p>
                    </div>
                </div>
            </div> 



        </div>
        <div class="clearfix"></div>
    </div>

</div>

<script type="text/javascript" src="<?php echo ASSETS.'/js/listing/listing.js' ?>"></script>

<script type="text/javascript">
$(document).ready(function() {
    $(".tooltiph").tooltip();
});
$(document).on('click', '.inqrbk', function() {
    var booking_id = $(this).data('booking-id');
    var booking_status = $(this).data('booking-status');
    var thisItem = $(this);
    $.ajax({
        url: WEB_URL+'/apartment/ChangeBookingStatus',
        data: {'booking_id' : booking_id, 'booking_status' : booking_status},
        method: 'POST',
        dataType: 'json',
        beforeSend: function(){
            thisItem.closest('.rehistory').addClass('wantldr');
        },
        success: function(r) {
            thisItem.closest('.rehistory').removeClass('wantldr');
            $('#'+booking_id).remove();
            //console.log(thisItem.closest('div.bstatus'));
            location.reload();
            if(booking_status == '1'){
                thisItem.closest('div.bstatus').html('CONFIRMED');
            }else{
                thisItem.closest('div.bstatus').html('CANCELLED');
            }
        }
    })
})
</script>

<script type="text/javascript">

$(document).on('ready', function(){

    createListingPagination();
    $('#ureservations').addClass('active');
    createReservationHistoryPagination();
    $('#ureservations').removeClass('active');
});
</script>

<script>
function createListingPagination() { 
    $("div.holdere").proPages({
        containerID: "lstContainer",
        perPage: 5,
        keyBrowse: true,
        scrollBrowse: false,
        // animation: "flipInX",
        callback: function (pages,items) {
                if(items.count > 3) {
                    $("#legend1").html("Page " + pages.current + " of " + pages.count);
                    $("#legend2").html("Elements "+items.range.start + " - " + items.range.end + " of " + items.count);
                } else {
                    $("div.holdere").html('');
                }
            }
        });
}
</script>

<script type="text/javascript">

function createReservationHistoryPagination() { 
    $("div.holderResHistory").proPages({
        containerID: "rsrvtnHistory",
        perPage: 3,
        keyBrowse: true,
        scrollBrowse: false,
        // animation: "flipInX",
        callback: function (pages,items) {
                if(items.count > 3) {
                    $("#legend1").html("Page " + pages.current + " of " + pages.count);
                    $("#legend2").html("Elements "+items.range.start + " - " + items.range.end + " of " + items.count);
                } else {
                    $("div.holderResHistory").html('');
                }
            }
        });
}


</script>
<!-- Your listing End-->

