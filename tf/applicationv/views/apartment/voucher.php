<?php $this->load->view('common/header');?>
<div class="full marintopcnt onlycontent">
<div class="full splalert">
    <div class="container">
        <div class="container offset-0">
        	<div class="tickapt">
            	<span class="iconaptcheck"><img src="<?php echo ASSETS;?>images/aptcheck.png" alt="" /></span>
                <span class="msgofapt">Thank you for order</span>
            </div>
            
        </div>
    </div>
</div>

<div class="clear"></div>

<div class="full contentvcr">
    <div class="container">
        <div class="container offset-0">
        	<div class="col-md-6 nopad">
            	<div class="witmd6">
            	<div class="topvmsg">
                	<h3 class="heloma">Hello, <?php echo $Booking->RES_GUEST_FIRSTNAME;?></h3>
                    <span class="msgvcr">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod Tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo </span>
                </div>
                <div class="clear"></div>
                
                <div class="topvmsg">
                	<h3 class="vcrhed">Itinerary</h3>
                   <!--  <div class="fulcodec">
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
                </div>
                
                <div class="topvmsg">
                	<div class="mapmensn">
                    	<img src="<?php echo $Map; ?>" alt=""/>
                    </div>
                </div>
                
                <div class="topvmsg">
                	<a href="<?php echo $apt_link;?>" target="new"><h3 class="vcrhed"><?php echo $Booking->PROP_NAME;?>, <?php echo $Booking->PROP_CITY;?> and <?php echo $Booking->PROP_COUNTRY_NAME;?></h3></a>
                     <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry">Apartment</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $Booking->PROP_TYPE_LABEL;?></strong></div>
                        </div>
                    </div>
                    <?php $guests = $Booking->RES_N_ADULTS+$Booking->RES_N_CHILDREN+$Booking->RES_N_BABIES;?>
                     <div class="fulcodec">
                        <div class="col-md-4 nopad">
                            <div class="labliternry">Guest</div>
                        </div>
                        <div class="col-md-8">
                            <div class="labliternry"><strong><?php echo $guests;?></strong></div>
                        </div>
                    </div>
                </div>
                
                <div class="topvmsg">
                	<div class="col-md-5">
                    	<div class="wrpdte">
                        	<span class="incty">Check In</span>
                            <div class="alldatecty">
                            	<?php echo date('D, M', strtotime($Booking->RES_CHECK_IN));?><strong><?php echo date('d', strtotime($Booking->RES_CHECK_IN));?></strong>
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
                            	<?php echo date('D, M', strtotime($Booking->RES_CHECK_OUT));?><strong><?php echo date('d', strtotime($Booking->RES_CHECK_OUT));?></strong>
                            </div>
                        </div>
                    </div>
                </div>
               </div> 
            </div>
            
            
            <div class="col-md-6 nopad">
            	<div class="othrdetsv">
                	<div class="rowhost">
                    	<h3 class="hosthed">Your host</h3>
                        <div class="colhostimg"><a href="<?php echo $host_profile_link;?>" target="new"><img src="<?php echo $Booking->profile_photo;?>" alt="" /></a></div>
                        <div class="hostvdets">
                        	<a href="<?php echo $host_profile_link;?>" target="new" class="hostlink"><span class="namehst"><?php echo $Booking->firstname.' '.$Booking->lastname;?></span></a>
                            <span class="phonenumhst"><?php echo $Booking->contact_no;?></span>
                            <!-- <a class="hostlink">Message the host a message</a> -->
                        </div>
                    </div>
                    <div class="rowhost">
                    	<h3 class="hosthed">Directions</h3>
                        <div class="hostvdets">
                        	<span class="namehstdets">
                            	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod Tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo 
                            </span>
                        </div>
                    </div>
                    
                     <div class="rowhost">
                    	<h3 class="hosthed">Payment</h3>
                        <div class="hostvdets">
                        	<span class="namehstdets">
                            	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod Tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo 
                            </span>
                        </div>
                    </div>
                    
                     <div class="rowhost">
                    	<h3 class="hosthed">Cancellation policy</h3>
                        <div class="hostvdets">
                        	<span class="namehstdets">
                            	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod Tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo 
                            </span>
                        </div>
                    </div>
                    
                     <div class="rowhost">
                    	<h3 class="hosthed">Customer service</h3>
                        <div class="hostvdets">
                        	<span class="namehstdets">
                            	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod Tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo 
                            </span>
                        </div>
                    </div>
                    <?php $RentData = json_decode($Booking->RENT_DATA);?>
                     <div class="rowhost">
                    	<h3 class="hosthed">Statement</h3>
                        <div class="hostvdets">
                        	<div class="rowstate">
                            	<div class="col-md-7 nopad">
                                	<div class="lblstate">Accommodations</div>
                                </div>
                                <div class="col-md-5 nopad">
                                	<div class="stateamnt"><?php echo CURR_ICON?><?php echo $RentData->RentSubtotal;?> (<?php echo CURR_ICON?><?php echo $RentData->price_per;?> Avg/Night)</div>
                                </div>
                            </div>
                            
                            <div class="rowstate">
                            	<div class="col-md-7 nopad">
                                	<div class="lblstate">InnoGlobe service fee (TAX INCL)</div>
                                </div>
                                <div class="col-md-5 nopad">
                                	<div class="stateamnt">$0</div>
                                </div>
                            </div>
                            
                            <div class="rowstate martopstate">
                            	<div class="col-md-7 nopad">
                                	<div class="lblstate textalignrit">Grand total</div>
                                </div>
                                <div class="col-md-5 nopad">
                                	<div class="stateamnt orange"><?php echo CURR_ICON?><?php echo $RentData->total_price;?></div>
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

<?php $this->load->view('common/footer');?>

</body>
</html>