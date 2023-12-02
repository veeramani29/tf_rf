<!-- Your listing -->
<div class="tab-pane padding20me <?php if (!empty($page_type) && $page_type == "listing") {
    echo "active";
} ?>" id="yourlisting">
<?php 
if($userInfo->property_owner_request == 0) { 
    echo '<div class="owner_steps tomato">Request admin for approval in order to list your property.</div>';
} else if($userInfo->property_owner_request == 1) { 
    if(isset($currentVerifications->email) && isset($currentVerifications->mobile)) { 
        if($currentVerifications->email == 1 && $currentVerifications->mobile == 1){ 
            if(isset($bank_details->Bank) || isset($bank_details->Paypal)) { 
                if($bank_details->Bank == 1 || $bank_details->Paypal == 1) {
                    if($userInfo->property_owner_created == 0){
                        echo '<div class="owner_steps cornflower">Yor request for property listing is in process with admin. We\'ll be back soon.</div>';
                    }
                } else { 
                    echo '<div class="owner_steps tomato">Provide your details for Bank or Paypal.</div>';
                } 
            } else {
                echo '<div class="owner_steps tomato">Provide your details for Bank or Paypal.</div>';
            } 
        } else{ 
            echo '<div class="owner_steps tomato">Verify your Mobile and Email id. <a target="_blank" href="'.WEB_URL.'/dashboard/profile/verifications">Click here to verify</a></div>';
        } 
    } else { 
        echo '<div class="owner_steps tomato">Verify your Mobile and Email id. <a target="_blank" href="'.WEB_URL.'/dashboard/profile/verifications">Click here to verify</a></div>';
    } 

 } 
?>
    <div class="col-md-3">
        <ul class="sideul">
            <li class="sidepro active" id="manageListingHandle"><a href="#mangelisting" data-toggle="tab">Manage Listing</a></li>
            
            <?php if($userInfo->property_owner_created == 1){ ?>
            
            <li class="sidepro" id="reserHistoryHandle"><a href="#ureservations" data-toggle="tab">Reservation History</a></li>
            <li class="sidepro" id="paymentHandle"><a href="#paymentmethod" data-toggle="tab">Payment Method</a></li>
            <li class="sidepro" id="transactHandle"><a href="#resrvationreq" data-toggle="tab">Transaction History</a></li>
            <li class="sidepro" id="transactHandle"><a href="#transactionTrack" data-toggle="tab">Transaction Tracking</a></li>
            <li class="sidepro" id="resReqHandle">
                <a href="#resReq" data-toggle="tab">Reservation Requirements</a>
            </li>
            <?php } else if($userInfo->property_owner_request == 0) { ?>
            <li class="sidepro" id="reserHistoryHandle">
                <a  style="color: #dedede" onclick="return false;" href="">Reservation History</a>
            </li>

            <li class="sidepro" id="paymentHandle">
                <a style="color: #dedede" onclick="return false;" href="#paymentmethod">Payment Method</a>
            </li>

            <li class="sidepro" id="transactHandle">
                <a  style="color: #dedede" onclick="return false;" href="">Transaction History</a>
            </li>      
            <li class="sidepro" id="resReqHandle">
                <a href="#resReq" data-toggle="tab">Reservation Requirements</a>
            </li>
            
            <?php } else if($userInfo->property_owner_request == 1){ ?>
            <li class="sidepro" id="reserHistoryHandle">
                <a  style="color: #dedede" onclick="return false;" href="">Reservation History</a>
            </li>
            
            <?php //echo "<pre>"; print_r($currentVerifications); echo "</pre>"; ?>
            <?php if(isset($currentVerifications->email) && isset($currentVerifications->mobile)){ ?>
                
                <?php if($currentVerifications->email == 1 && $currentVerifications->mobile == 1){ ?>
                <li class="sidepro" id="paymentHandle1">
                    <a href="#paymentmethod" data-toggle="tab">Payment Method</a>
                </li>
                <?php } else { ?>
                <li class="sidepro" id="paymentHandle">
                    <a style="color: #dedede" onclick="return false;" href="#paymentmethod">Payment Method</a>
                </li>
                <?php } ?>
            <?php } else { ?>
                <li class="sidepro" id="paymentHandle">
                    <a style="color: #dedede" onclick="return false;" href="#paymentmethod">Payment Method</a>
                </li>
            <?php } ?>
            <li class="sidepro" id="transactHandle">
                <a  style="color: #dedede" onclick="return false;" href="">Transaction History</a>
            </li>
            <li class="sidepro" id="resReqHandle">
                <a href="#resReq" data-toggle="tab">Reservation Requirements</a>
            </li>
            <?php } ?>

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
                                <div class="col-xs-8  urlistimg urlisfg">
                                    <div class="col-xs-4 centgytabl">
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
                                    <div class="col-xs-8 centgytabl lefhgt">
                                        <div class="inboxlabl">
                                            <a class="listaptname" href="<?php echo WEB_URL; ?>/listings/edit_listings/<?php echo $value->PROPERTY_ID; ?>"><?php echo $value->PROP_TYPE_LABEL; ?> in <?php echo $value->PROP_CITY; ?></a>
                                        </div>
                                    </div>
                                </div>
                               
                               <div class="col-xs-4 centgytabl  urlistimg urlisfg">
                                <?php if($completed_status_count != 0) { ?>
                                <div class="vertymid">
                                    <a class="tomorelist" href="<?php echo WEB_URL; ?>/listings/edit_listings/<?php echo $value->PROPERTY_ID; ?>"><?php echo $completed_status_count; ?> Steps to list</a>
                                </div>
                                <?php } elseif($value->PROP_COUNTRY == 'AE' && $value->ADMIN_APPROVAL_STATUS == 0) { ?>
                                    <div class="vertymid">
                                        <p style="color:red;">Require approval from admin</p>
                                    </div>                                                                      
                                <?php } elseif($completed_status_count == 0) { ?>
                                      
                                      <label class="switch-light switch-ios ioand">
                                          <input <?php if($value->PROPERTY_STATUS == 1) {echo "checked"; } ?> name="edit_listings_statusa" data-propid="<?php echo $value->PROPERTY_ID; ?>" class="edit_listings_statusa" type="checkbox" />
                                          <span class="htspan">
                                            <span>Unlist</span>
                                            <span>List</span>
                                          </span>
                                          <a></a>
                                      </label>

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
                                <form method="post" id="ownerReq" name="listings" action="<?php echo WEB_URL; ?>/account/updateB2bUserListingAjax">
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
                    <div class="col-xs-2 nopad nop nopwit fiwful fiwfulstp">
                        <a href="<?php echo WEB_URL.'/users/show/'.$booking->user_type.'/'.$booking->USER_ID;?>"><div class="userimagere"><img src="<?php echo $profile_photo;?>" alt="" /></div></a>
                        <a href="<?php echo WEB_URL.'/users/show/'.$booking->user_type.'/'.$booking->USER_ID;?>"><span class="usrnamere"><?php echo $UserInfo->firstname.' '.$UserInfo->lastname;?></span></a>
                    </div>
                    <div class="col-xs-10 nopad nop fiwful">
                        <div class="col-xs-2 padforhe fiwalso"> 
                          <a class="fullpikr" href="<?php echo WEB_URL.'/apartment/rooms/'.$booking->PROP_ID;?>">
                            <?php $img = $this->apartment_model->view_property_file($booking->PROP_PHOTO);?>
                            <img src="<?php echo $img;?>" alt="" width="99" height="91"/>
                          </a> 
                        </div>
                        
                        <div class="col-xs-10 nopad fiwalso">
                        <div class="topfis">
                        <div class="col-md-5 chkcal">
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
                        
                        <div class="col-md-7 nopad cleardty">
                            <div class="rowfux">
                                <div class="col-xs-6 nopad">
                                    <div class="lablofux">Reservation Date</div>
                                </div>
                                <div class="col-xs-6 nopad">
                                    <div class="answrfux"> <?php echo date('D, d M Y', strtotime($booking->voucher_date));?></div>
                                </div>
                            </div>
                            
                            <div class="rowfux">
                                <div class="col-xs-6 nopad">
                                    <div class="lablofux">Confirmation No</div>
                                 </div>
                                <div class="col-xs-6 nopad">
                                    <div class="answrfux"> <?php echo $booking->pnr_no;?></div>
                                </div>
                            </div>
                            
                            <div class="rowfux">
                                <div class="col-xs-6 nopad">
                                    <div class="lablofux nomarb">Booking Status</div>
                                </div>
                                <div class="col-xs-6 nopad">
                                    <div class="answrfux nomarb bstatus"> <?php echo $booking->booking_status;?></div>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        
                        <div class="clear"></div>
                        
                        <div class="col-xs-6 padforhe fiwful">
                            <div class="flikrallll">
                          <a href="<?php echo WEB_URL.'/apartment/rooms/'.$booking->PROP_ID;?>" class="dark flikrdesc"><?php echo $booking->PROP_NAME;?></a> 
                          <span class="grayish size12"><?php echo $booking->PROP_CITY;?> - <?php echo $booking->COUNTRY_NAME;?></span><br>
                          <span class="green bold size20"><?php echo CURR_ICON?><?php echo $booking->amount;?></span> 
                          </div>
                       </div>
                
                        <div class="col-xs-6 nopad fiwful">
                            <div class="botufis dfgh heyu">
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
                    <div class="clear"></div>
                    <div class="holderResHistory padpagen"></div>
                </div>
            </div>
            <div class="tab-pane" id="paymentmethod">
                <span class="size16 padtabne bold">Payment Method</span>
                <div class="withedrow" style="position: relative">
                    <div class="chkVeriLoader lodrefrentrev imgLoader" style="display: none;">
                        <a href="#" class="closePayBx" style="float: right">Close</a>
                      <div class="centerload"></div>
                      <div class="centerLoadText" id="verifyMsg">
                          You have to verify your email and contact number in order to create listing owner account. 
                          Please <a href="'+WEB_URL+'/dashboard/verifications'+'">Click here to verify</a>
                      </div>
                    </div>
                    <div class="rowit">
                        <p class="normalpara">
                            Enter the below details in order to enable your listing owner account.
                        </p>
                        <div class="clear"></div>
                        <div class="col-md-6 nopad">
                            <form action="<?php echo WEB_URL.'/account/addBankDetails'; ?>" id="addBankDetails">
                            
                                <div class="paymentbank">
                                
                                    <div class="paymentheading">Payment by bank</div>
                                    
                                    <div class="wrappayment">
                                        <div class="phlabl">Name on account:</div>
                                        <input class="form-control" required type="text" value="<?php echo (isset($bank_details->bank_account_name) ? $bank_details->bank_account_name : '' ); ?>" name="account_name" id="" placeholder="">
                                        <span style="color: red; font-size:small" class="errPhone"></span>
                                    </div>

                                    <div class="wrappayment">
                                        <div class="phlabl">Name of bank:</div>
                                        <input class="form-control" minlength="5" required type="text" value="<?php echo (isset($bank_details->bank_name) ? $bank_details->bank_name : '' ); ?>" name="bank_name" id="" placeholder="">
                                        <span style="color: red; font-size:small" class="errPhone"></span>
                                    </div> 

                                    <div class="wrappayment">
                                        <div class="phlabl">Account Number</div>
                                        <input class="form-control" minlength="5" required type="text" value="<?php echo (isset($bank_details->bank_account_number) ? $bank_details->bank_account_number : '' ); ?>"  name="bank_acc_number" id="" placeholder="">
                                        <span style="color: red; font-size:small" class="errPhone"></span>
                                    </div> 

                                    <div class="wrappayment">
                                        <div class="phlabl">Card Number</div>
                                        <input class="form-control" minlength="8"  required type="number" value="<?php echo (isset($bank_details->bank_card_number) ? $bank_details->bank_card_number : '' ); ?>" name="bank_card_number" id="" placeholder="">
                                        <span style="color: red; font-size:small" class="errPhone"></span>
                                    </div> 

                                    <div class="wrappayment">
                                        <div class="phlabl">Card CVV Number</div>
                                        <input class="form-control" minlength="3" maxlength="3" required type="text" value="<?php echo (isset($bank_details->bank_account_cvv) ? $bank_details->bank_account_cvv : '' ); ?>" name="bank_cvv_number" id="" placeholder="">
                                        <span style="color: red; font-size:small" class="errPhone"></span>
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
                                <form id="addPaypalDetails" action="<?php echo WEB_URL.'/account/addPaypalDetails'; ?>">
                                    <div class="wrappayment">
                                        <div class="phlabl">Paypal account name</div>
                                        <input class="form-control" required name="paypal_acc_name" type="text" value="<?php echo (isset($bank_details->paypal_account_name) ? $bank_details->paypal_account_name : '' ); ?>" id="" placeholder="">
                                        <span style="color: red; font-size:small" class="errPhone"></span>
                                    </div>

                                    <div class="wrappayment">
                                        <div class="phlabl">Paypal Email ID</div>
                                        <input class="form-control" required name="paypal_email_id" type="email" value="<?php echo (isset($bank_details->paypal_email_id) ? $bank_details->paypal_email_id : '' ); ?>" id="" placeholder="">
                                        <span style="color: red; font-size:small" class="errPhone"></span>
                                    </div> 
                                    
                                    <br>
                                    <button class="btn-search5" id="" type="submit">Proceed</button>
                                    <img class="sendingLoader" src="<?php echo ASSETS.'/images/loader.gif' ?>  ">
                                </form>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="resrvationreq">
                <ul class="nav reviewtab">
                  <li class="reviwli active" id="upcomtranx"> <a href="#upcomtran" data-toggle="tab">Upcoming Transaction</a> </li>
                  <li class="reviwli" id="coptranx"> <a href="#coptran" data-toggle="tab">Completed Transactions</a></li>
                  <li class="reviwli" id="coptranx"> <a href="#currentTrans" data-toggle="tab">Current Transactions</a></li>
                  <li class="reviwli" id="coptranx"> <a href="#failedTrans" data-toggle="tab">Failed Transactions</a></li>
                </ul>
                
                
                <div class="tab-content5">
                   
                   <div class="tab-pane active" id="upcomtran">
                    <div class="withedrow">
                            <span class="size16 padtabne ">Upcoming Transaction</span>
                            <div class="rowit">
                            <div class="lodref"></div>
                                <div class="col-md-12 nopad">
                                
                                    <div class='responsive-table'>
                                        <div class='scrollable-area'>
                                            <table id="upcomtransctn" class='data-table-column-filter table table-bordered table-striped table-stripedxx' cellspacing="0" width="100%">
                                                <thead>
                                                    <tr class="sortablehed">
                                                        <th>S.No</th>
                                                        <th>Transaction ID</th>
                                                        <th>Date</th>
                                                        <th>Net Rate</th>
                                                        <th>Service Charge</th>
                                                        <th>Payout Amount</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            
                                                <tbody>
                                                    <?php if(!empty($upcoming_transaction)){ ?>
                                                        <?php $s_no = 1; ?>
                                                        <?php foreach($upcoming_transaction as $up_k){ ?>
                                                    
                                                            <tr class="confirmedtr">
                                                                <td><?php echo $s_no; ?> </td>
                                                                <td><?php echo $up_k->pnr_no; ?></td>
                                                                <td style="white-space: nowrap"><?php echo $up_k->travel_date; ?></td>
                                                                <td><?php echo CURR_ICON.$up_k->net_rate; ?></td>
                                                                <td><?php echo CURR_ICON.$up_k->host_charge; ?></td>
                                                                <td><?php echo CURR_ICON.$up_k->payout_amount; ?></td>
                                                                <td>
                                                                    <a class="statusa" title="Some description">
                                                                        <?php echo $up_k->payout_status; ?>
                                                                    </a>
                                                                </td>
                                                                <td width="100">
                                                                    <a href="<?php echo WEB_URL.'/apartment/voucher/'.base64_encode(base64_encode($up_k->pnr_no));?>" class="glyphicon glyphicon-eye-open btn btn-primary xcv" title="View Voucher"></a>
                                                                    <a href="<?php echo WEB_URL.'/apartment/invoice/'.base64_encode(base64_encode($up_k->pnr_no));?>" class="glyphicon glyphicon-eye-open btn btn-info btn-primary xcv" title="Host Invoice"></a>
                                                                </td>
                                                            </tr>   
                                                            <?php $s_no++; ?>

                                                        <?php } ?>
                                                    <?php } ?>
                                                </tbody>
                                               
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                          </div> 
                   </div>
                   
                   <div class="tab-pane" id="coptran">
                        <div class="withedrow">
                            <span class="size16 padtabne ">Completed Transactions</span>
                            <div class="rowit">
                            <div class="lodref"></div>
                                <div class="col-md-12 nopad">
                                
                                    <div class='responsive-table'>
                                        <div class='scrollable-area'>
                                            <table id="compltrans" class='data-table-column-filter table table-bordered table-striped' cellspacing="0" width="100%">
                                                <thead>
                                                    <tr class="sortablehed">
                                                        <th>S.No</th>
                                                        <th>Transaction ID</th>
                                                        <th>Date</th>
                                                        <th>Net Rate</th>
                                                        <th>Service Charge</th>
                                                        <th>Payout Amount</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                        
                                                    </tr>
                                                </thead>
                                            
                                                <tbody>
                                                    <?php if(!empty($completed_transaction)){ ?>
                                                        <?php $s_no = 1; ?>
                                                        <?php foreach($completed_transaction as $ct_k){ ?>
                                                    
                                                            <tr class="confirmedtr">
                                                                <td><?php echo $s_no; ?> </td>
                                                                <td><?php echo $ct_k->pnr_no; ?></td>
                                                                <td style="white-space: nowrap"><?php echo $ct_k->travel_date; ?></td>
                                                                <td><?php echo CURR_ICON.$ct_k->net_rate; ?></td>
                                                                <td><?php echo CURR_ICON.$ct_k->host_charge; ?></td>
                                                                <td><?php echo CURR_ICON.$ct_k->payout_amount; ?></td>
                                                                <td>
                                                                    <a class="statusa" title="Some description">
                                                                        <?php echo $ct_k->payout_status; ?>
                                                                    </a>
                                                                </td>
                                                                <td width="100">
                                                                    <a href="<?php echo WEB_URL.'/apartment/voucher/'.base64_encode(base64_encode($ct_k->pnr_no));?>" class="glyphicon glyphicon-eye-open btn btn-primary xcv" title="View Voucher"></a>
                                                                    <a href="<?php echo WEB_URL.'/apartment/invoice/'.base64_encode(base64_encode($ct_k->pnr_no));?>" class="glyphicon glyphicon-eye-open btn btn-info btn-primary xcv" title="Host Invoice"></a>
                                                                </td>
                                                            </tr>   
                                                            <?php $s_no++; ?>

                                                        <?php } ?>
                                                    <?php } ?>
                                                </tbody>
                                               
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                          </div>
                   </div>
                    
                    <div class="tab-pane" id="currentTrans">
                        <div class="withedrow">
                            <span class="size16 padtabne ">Current Transactions</span>
                            <div class="rowit">
                            <div class="lodref"></div>
                                <div class="col-md-12 nopad">
                                
                                    <div class='responsive-table'>
                                        <div class='scrollable-area'>
                                            <table id="compltrans" class='data-table-column-filter table table-bordered table-striped' cellspacing="0" width="100%">
                                                <thead>
                                                    <tr class="sortablehed">
                                                        <th>S.No</th>
                                                        <th>Transaction ID</th>
                                                        <th>Date</th>
                                                        <th>Net Rate</th>
                                                        <th>Service Charge</th>
                                                        <th>Payout Amount</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                        
                                                    </tr>
                                                </thead>
                                            
                                                <tbody>
                                                    <?php if(!empty($current_transaction)){ ?>
                                                        <?php $s_no = 1; ?>
                                                        <?php foreach($current_transaction as $cut_k){ ?>
                                                    
                                                            <tr class="confirmedtr">
                                                                <td><?php echo $s_no; ?> </td>
                                                                <td><?php echo $cut_k->pnr_no; ?></td>
                                                                <td style="white-space: nowrap"><?php echo $cut_k->travel_date; ?></td>
                                                                <td><?php echo CURR_ICON.$cut_k->net_rate; ?></td>
                                                                <td><?php echo CURR_ICON.$cut_k->host_charge; ?></td>
                                                                <td><?php echo CURR_ICON.$cut_k->payout_amount; ?></td>
                                                                <td>
                                                                    <a class="statusa" title="Some description">
                                                                        <?php echo $cut_k->payout_status; ?>
                                                                    </a>
                                                                </td>
                                                                <td width="100">
                                                                    <?php if($cut_k->payout_status == "Deposit"){ ?>
                                                                    <div class="botufis heyu recieveTrans">
                                                                    <a title="Actions" data-placement="top" id="" class="btn btn-danger btn-xs tooltiph dropdown-toggle delact" data-toggle="dropdown">
                                                                        <i class="icon-plus"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu imptop"> 
                                                                  

                                                                        <li class="actionlink">
                                                                            <a class="accept-deposit" data-pnr="<?php echo $cut_k->pnr_no; ?>" data-trans-accept-status="1">
                                                                                <span class="icon icon-check"></span>Payment Received
                                                                            </a>
                                                                        </li>
                                                                
                                                                        <li class="actionlink">
                                                                            <a class="accept-deposit" data-pnr="<?php echo $cut_k->pnr_no; ?>" data-trans-accept-status="0">
                                                                                <span class="icon icon-off"></span>Payment Not Received
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                    </div>
                                                                    <?php } ?>
                                                                    <a href="<?php echo WEB_URL.'/apartment/voucher/'.base64_encode(base64_encode($cut_k->pnr_no));?>" class="glyphicon glyphicon-eye-open btn btn-primary xcv" title="View Voucher"></a>
                                                                    <a href="<?php echo WEB_URL.'/apartment/invoice/'.base64_encode(base64_encode($cut_k->pnr_no));?>" class="glyphicon glyphicon-eye-open btn btn-info btn-primary xcv" title="Host Invoice"></a>
                                                                </td>
                                                            </tr>   
                                                            <?php $s_no++; ?>



                                                        <?php } ?>
                                                    <?php } ?>
                                                </tbody>
                                               
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                          </div>
                    </div>

                    <div class="tab-pane" id="failedTrans">
                        <div class="withedrow">
                            <span class="size16 padtabne ">Failed Transactions</span>
                            <div class="rowit">
                            <div class="lodref"></div>
                                <div class="col-md-12 nopad">
                                
                                    <div class='responsive-table'>
                                        <div class='scrollable-area'>
                                            <table id="compltrans" class='data-table-column-filter table table-bordered table-striped' cellspacing="0" width="100%">
                                                <thead>
                                                    <tr class="sortablehed">
                                                        <th>S.No</th>
                                                        <th>Transaction ID</th>
                                                        <th>Date</th>
                                                        <th>Net Rate</th>
                                                        <th>Service Charge</th>
                                                        <th>Payout Amount</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                        
                                                    </tr>
                                                </thead>
                                            
                                                <tbody>
                                                    <?php if(!empty($failed_transaction)){ ?>
                                                        <?php $s_no = 1; ?>
                                                        <?php foreach($failed_transaction as $ft_k){ ?>
                                                    
                                                            <tr class="confirmedtr">
                                                                <td><?php echo $s_no; ?> </td>
                                                                <td><?php echo $ft_k->pnr_no; ?></td>
                                                                <td style="white-space: nowrap"><?php echo $ft_k->travel_date; ?></td>
                                                                <td><?php echo CURR_ICON.$ft_k->net_rate; ?></td>
                                                                <td><?php echo CURR_ICON.$ft_k->host_charge; ?></td>
                                                                <td><?php echo CURR_ICON.$ft_k->payout_amount; ?></td>
                                                                <td>
                                                                    <a class="statusa" title="Some description">
                                                                        <?php echo $ft_k->payout_status; ?>
                                                                    </a>
                                                                </td>
                                                                <td width="100">
                                                                    <a href="<?php echo WEB_URL.'/apartment/voucher/'.base64_encode(base64_encode($ft_k->pnr_no));?>" class="glyphicon glyphicon-eye-open btn btn-primary xcv" title="View Voucher"></a>
                                                                    <a href="<?php echo WEB_URL.'/apartment/invoice/'.base64_encode(base64_encode($ft_k->pnr_no));?>" class="glyphicon glyphicon-eye-open btn btn-info btn-primary xcv" title="Host Invoice"></a>
                                                                </td>
                                                            </tr>   
                                                            <?php $s_no++; ?>

                                                        <?php } ?>
                                                    <?php } ?>
                                                </tbody>
                                               
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                          </div>
                    </div>
                </div>
                
            </div>

            <div class="tab-pane" id="transactionTrack">
                <div class="withedrow">
                    <span class="size16 padtabne ">Transaction Tracking</span>
                    <div class="rowit">
                    <div class="lodref"></div>
                        <div class="col-md-12 nopad">
                        
                            <div class="col-lg-3 col-md-3 col-sm-12">
                              <div class="prolabel">InnoGlobe Confirmation Number:</div>
                            </div>
                            
                            <form id="trackTransaction" action="<?php echo WEB_URL.'/account/trackTransaction' ?>">
                                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                                    <input type="text" class="form-control" name="track_id" placeholder="IG00A00000000" value="" required/>
                                </div>
                                <button type="submit" class="bluebtn margtop20">Tracking</button>
                            </form>
                        </div>
                    </div>
                </div>
                <br />
                
                <div style="height: 100px; position: relative">
                    <div class="lodrefrentrev imgLoader" id="loaderTransHist">
                      <div class="centerload"></div>
                    </div>
                </div>
                <div id="transactContainer" style="height: 100px; position: relative"></div>
            </div> 

            <div class="tab-pane" id="resReq">
                <span class="size16 padtabne bold">Reservation Requirements</span>
                <div class="withedrow">
                    <div class="rowit">
                        <p class="normalpara">
                            The following is the list of requirements you need to fulfill before listing your property on InnoGlobe
                        </p>
                        <ul>
                            
                            <li class="reres">
                                <span class="ownCmpltStepAA icon"></span>
                                <span class="arovld">Ask for the Admin Approval</span>
                            </li>
                            <li class="reres">
                                <span class="ownCmpltStepUV icon"></span>
                                <span class="arovld">Verify your Email ID and Mobile phone number. <a target="_blank" href="<?php echo WEB_URL.'/dashboard/profile/verifications'; ?>">Click here to verify</a></span>
                            </li>
                            <li class="reres">
                                <span class="ownCmpltStepBV icon"></span>
                                <span class="arovld">Add bank or paypal details</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>  



        </div>
        <div class="clearfix"></div>
    </div>

</div>

<script type="text/javascript" src="<?php echo ASSETS.'/js/listing/listing.js' ?>"></script>


<script type="text/javascript">
$(function() {
  
	$('#compltrans, #upcomtransctn').DataTable( {
	
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "<?php echo ASSETS;?>swf/copy_csv_xls_pdf.swf"
        }
    } );
})
</script>


<script type="text/javascript">
$(document).ready(function() {
    $(".tooltiph, .statusa, .xcv").tooltip();
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

<script>
    $(document).on('click', '.accept-deposit', function() {
        var accept_bit = $(this).data('trans-accept-status');
        var accept_pnr = $(this).data('pnr');
        var selectedObj = $(this);
        $.ajax({
            url: WEB_URL+'/account/transactionStatusChange',
            method: "POST",
            data: {"accept_pnr": accept_pnr, "accept_bit": accept_bit},
            dataType: "JSON",

            success: function(r) {
                if(r.status == 1) {
                    console.log(selectedObj.parent().parent().parent('.recieveTrans'));
                    selectedObj.parent().parent().parent('.recieveTrans').remove();
                }
            }
        })        

        
    })
</script>
<!-- Your listing End-->

