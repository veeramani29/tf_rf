<?php 
    $po = $getAptTransaction; 
    $analyze = $po->analyze;   
    $process = $po->process;   
    $deposit = $po->deposit;    
    $recived = $po->recived;
    $failed = $po->failed;
    $failed_stage = $po->failed_stage;
    $pnr = $po->pnr_no;
    $payout_status = $po->payout_status;

    if($analyze == 1 && $process == 0 && $deposit == 0 && $recived == 0) {
        $analyze = 1;
        $process = $deposit = $recived = 0;
        $pinnedStatus = array($analyze, $process, $deposit, $recived);
    }
    elseif($analyze == 1 && $process == 1 && $deposit == 0 && $recived == 0) {
        $analyze = $process = 1;
        $deposit = $recived = 0;
        $pinnedStatus = array($analyze, $process, $deposit, $recived);
    }
    elseif($analyze == 1 && $process == 1 && $deposit == 1 && $recived == 0) {
        $analyze = $process = $deposit = 1;
        $recived = 0;
        $pinnedStatus = array($analyze, $process, $deposit, $recived);
    }
    elseif($analyze == 1 && $process == 1 && $deposit == 1 && $recived == 1) {
        $analyze = $process = $deposit = $recived = 1;
        $pinnedStatus = array($analyze, $process, $deposit, $recived);
    }    
?>

<span class="size16 padtabne ">Transaction Status</span>
<div class="rowit">
    <div class="lodref"></div>
        <div class="col-md-12 nopad sturte">

            <div class="col-xs-3 nopad">
            
                <div class="aftrwrp <?php if($failed_stage != "Analyze") { if($po->analyze == 1) { echo "completed"; } } else{ echo "notcompleted"; } ?>">
                    <div class="smalstep">
                        <div class="glumpo bacsux"></div>
                    </div>
                </div>
                <div class="stepmensn">Analyze</div>
            </div>
            <div class="col-xs-3 nopad">
                <?php //echo "<pre>"; print_r($po->process); echo "</pre>"; ?>
                <div class="aftrwrp <?php if($failed_stage != "Process") { if($po->process == 1) { echo "completed"; } } else{ echo "notcompleted"; } ?>">
                    <div class="smalstep">
                        <div class="glumpo bacsux"></div>
                    </div>
                </div>
                <div class="stepmensn">Process</div>
            </div>
            <div class="col-xs-3 nopad">
                <div class="aftrwrp <?php if($failed_stage != "Deposit") { if($po->deposit == 1) { echo "completed"; } } else{ echo "notcompleted"; } ?>">
                    <div class="smalstep">
                        <div class="glumpo bacsux"></div>
                    </div>
                </div>
                <div class="stepmensn">Deposit</div>
            </div>
            <div class="col-xs-3 nopad">
                
                <div class="aftrwrp rcievdPay lastchi <?php if($failed_stage != "Recived") { if($po->recived == 1) { echo "completed"; } } else{ echo "notcompleted"; } ?>">
                    <div class="smalstep">
                        <div class="glumpo bacsux"></div>
                    </div>
                </div>
                <div class="stepmensn">Received</div>
            </div>
            
            
            <div class="clear"></div>
            
            <?php if($payout_status == "Deposit") { ?>
            <div class="transactionRecievedBx">
                <h4 class="procsgding" style="font-size: 15px">Money has been depoited to your account. Please click Received to complete transaction.</h4>
                <div style="width: 208px; margin: 0 auto">
                    <button data-accept="1" data-pnr="<?php echo $pnr; ?>" class="btn btn-success transAccept">Received</button>
                    <button data-accept="0" data-pnr="<?php echo $pnr; ?>" class="btn btn-danger transAccept">Not Received</button>
                </div>    
            </div>
            <?php } ?>
            
            <?php if(!empty($getTransactionHistory)){ ?>
            <div class="procesdesc">
                <?php $latestUpdate = reset($getTransactionHistory); ?>
                <?php $latestStatus = $latestUpdate->status; $latestMsg = $latestUpdate->message; ?>
                <h3 class="procsgding"><?php echo $latestStatus; ?></h3>
                <p><?php echo $latestMsg; ?></p>
            </div>
            
            <div class="linsteop">
                <h3 class="procsgding">Transaction History</h3>
                <ul class="timelinexv">
                    
                    <?php foreach($getTransactionHistory as $th_k){ ?>
                    <?php  
                        
                        switch($th_k->status) {
                            case "Analyze":
                                $icon = "icon-search";
                                $icon_bg = "blue-background";
                                break;
                            case "Process":
                                $icon = "icon-refresh";
                                $icon_bg = "purple-background";
                                break;
                            case "Failed":
                                $icon = "icon-warning-sign ";
                                $icon_bg = "red-background";
                                break;
                            case "Deposit":
                                $icon = "icon-money";
                                $icon_bg = "orange-background";
                                break;
                            default:
                                $icon = "icon-search";
                                $icon_bg = "blue-background";
                                break;
                        }
                    ?>
                    <li>                        
                      <div class="icon <?php echo $icon_bg; ?>">
                        <i class="<?php echo $icon; ?>"></i>
                      </div>
                      <div class="title">
                        <?php echo $th_k->status; ?>
                        <?php  
                            $htime = $th_k->m_datetime;
                            $htime_format = date("M d, Y, H:i a", strtotime($htime));
                        ?>
                        <small class="text-muted"><?php echo $htime_format; ?></small>
                      </div>
                      <div class="content">
                       <?php echo $th_k->message; ?>
                      </div>
                    </li>
                    <?php } ?>
                    
                </ul>
            </div>
            <?php } ?>

            <div class="procesdesc">
                <h3 class="procsgding">Hold</h3>
                <p>Your transaction has not been currently processed by InnoGlobe.</p>
            </div>           
            
            
            <div class="clear"></div>
            
            <div class="topvmsg">
                <h3 class="vcrhed">Payment Details </h3>
                
                <div class="fulcodec">
                    <!-- <div class="col-md-4 nopad">
                        <div class="labliternry">Receive payment </div>
                    </div>
                    <div class="col-md-8">
                    </div> -->
                </div>
            </div>


            <div class="clear"></div>
            <?php $RentData = json_decode($Booking->RENT_DATA);?>
            <div class="hostvdets">
                <div class="rowstate">
                    <div class="col-md-7 nopad">
                        <div class="lblstate">Net Rate</div>
                    </div>
                    <div class="col-md-5 nopad">
                        <div class="stateamnt"><?php echo CURR_ICON?> <?php echo $Transaction->net_rate;?></div>
                    </div>
                </div>
                
                <div class="rowstate">
                    <div class="col-md-7 nopad">
                        <div class="lblstate">Service Charge</div>
                    </div>
                    <div class="col-md-5 nopad">
                        <div class="stateamnt"><?php echo CURR_ICON?> <?php echo $Transaction->host_charge; ?></div>
                    </div>
                </div>
                
                <div class="rowstate martopstate">
                    <div class="col-md-7 nopad">
                        <div class="lblstate ">Grand Total</div>
                    </div>
                    <div class="col-md-5 nopad">
                        <div class="stateamnt orange"><?php echo CURR_ICON?> <?php echo $Transaction->payout_amount;?></div>
                    </div>
                </div>
                                                            
                
            </div>
                    
                    
        <div class="clear"></div>      

        <div class="splacv splampot">
            <div class="topvmsg">
                <h3 class="vcrhed">Invoice</h3>
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
            
            
            <div class="rowing">
                <div class="col-md-6">
                    <div class="rowhost">
                        <h3 class="hosthed">
                            <span class="imageinvc"><img src="<?php echo ASSETS;?>images/useri.png" alt="" /></span> Name
                        </h3>
                        <div class="hostvdets">
                            <span class="namehstdets">
                                <!-- http://192.168.0.139/APT_Server/users/show/3/1 -->
                                <?php //echo "<pre>"; print_r($Booking); echo "</pre>"; ?>
                                <a href="<?php echo WEB_URL.'/users/show/'.$Booking->user_type.'/'.$Booking->user_id; ?>">
                                    <?php echo $Booking->RES_GUEST_FIRSTNAME.' '.$Booking->RES_GUEST_LASTNAME;?> 
                                </a>
                            </span>
                        </div>
                    </div>
                    </div>
                <div class="col-md-6">
                    <div class="rowhost">
                        <h3 class="hosthed">
                            <span class="imageinvc"><img src="<?php echo ASSETS;?>images/marker.png" alt="" /></span> Destination
                        </h3>
                        <div class="hostvdets">
                            <span class="namehstdets">
                                <?php echo $Booking->PROP_CITY.', '.$Booking->PROP_REGION;?><br />
                                    <?php echo $Booking->PROP_COUNTRY_NAME;?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="rowing">
                <div class="col-md-6">
                    <div class="rowhost">
                        <h3 class="hosthed">
                            <span class="imageinvc"><img src="<?php echo ASSETS;?>images/nav.png" alt="" /></span> Address of the accommodation
                        </h3>
                        <div class="hostvdets">
                            <span class="namehstdets">
                                <?php echo $Booking->PROP_ADDR1.', '.$Booking->PROP_ADDR2;?><br />
                                    <?php echo $Booking->PROP_CITY.', '.$Booking->PROP_REGION.', '.$Booking->PROP_COUNTRY_NAME;?>
                            </span>
                        </div>
                    </div>
                    </div>
                <div class="col-md-6">
                    <div class="rowhost">
                        <h3 class="hosthed">
                            <span class="imageinvc"><img src="<?php echo ASSETS;?>images/pro.png" alt="" /></span> Property
                        </h3>
                        <div class="hostvdets">
                            <span class="namehstdets">
                                <?php echo $Booking->PROP_NAME;?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div class="rowing">
                <div class="col-md-6">
                    <div class="rowhost">
                        <h3 class="hosthed">
                            <span class="imageinvc"><img src="<?php echo ASSETS;?>images/allapt.png" alt="" /></span> Type of apartment
                        </h3>
                        <div class="hostvdets">
                            <span class="namehstdets">
                                <?php echo $Booking->PROP_TYPE_LABEL;?>
                            </span>
                        </div>
                    </div>
                    </div>
                <div class="col-md-6">
                    <div class="rowhost">
                        <h3 class="hosthed">
                            <span class="imageinvc"><img src="<?php echo ASSETS;?>images/night.png" alt="" /></span> Nights
                        </h3>
                        <div class="hostvdets">
                            <span class="namehstdets">
                                <?php echo $Booking->NIGHTS;?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div class="rowing">
                <div class="col-md-6">
                    <div class="rowhost">
                        <h3 class="hosthed">
                            <span class="imageinvc"><img src="<?php echo ASSETS;?>images/in.png" alt="" /></span> Check In
                        </h3>
                        <div class="hostvdets">
                            <span class="namehstdets">
                                <?php echo date('D, d M Y', strtotime($Booking->RES_CHECK_IN));?> <br /> <?php echo $Booking->PROP_CIN_TIME;?> 
                            </span>
                        </div>
                    </div>
                    </div>
                <div class="col-md-6">
                    <div class="rowhost">
                        <h3 class="hosthed">
                            <span class="imageinvc"><img src="<?php echo ASSETS;?>images/out.png" alt="" /></span> Check Out
                        </h3>
                        <div class="hostvdets">
                            <span class="namehstdets">
                                <?php echo date('D, d M Y', strtotime($Booking->RES_CHECK_OUT));?> <br /> <?php echo $Booking->PROP_COUT_TIME;?> 
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>