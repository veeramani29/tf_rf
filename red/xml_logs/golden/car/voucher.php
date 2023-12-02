<?php 
    $bookedDate = explode(' ',$bookingData->timestamp);
    if($bookingData->bookingPrepare!=''){
     $bookingPrepare_data=json_decode(base64_decode($bookingData->bookingPrepare));
     
     #$Destination=$bookingPrepare_data->ServiceDetail->Destination;   
     # $CancellationPolicy=$bookingPrepare_data->ServiceDetail->CancellationPolicy;   
    }
    #if(empty($CancellationPolicy)){
        $booking_response_data=json_decode(base64_decode($bookingData->booking_response));

         #$CancellationPolicy=$booking_response_data->CancellationPolicy; 
    #}
$return_TransferBulletPoint=array();
     if($bookingData->ticket_searchresponse!=''){
$TicketData_=json_decode(base64_decode($bookingData->ticket_searchresponse));
if($TicketData_->oneway!=null){
    $TicketData=$TicketData_->oneway;
    $TicketData_return=$TicketData_->return;
}else{
  $TicketData=$TicketData_;   
}

$oneway_TransferBulletPoint=$TicketData->TransferBulletPoint;
  $oneway_TransferBulletPoint=(array) $oneway_TransferBulletPoint;
if($TicketData_->return!=null){
    $returnTicketData=$TicketData_->oneway;
    $return_TransferBulletPoint=$returnTicketData->TransferBulletPoint;
     $return_TransferBulletPoint=(array) $return_TransferBulletPoint;
}

     }
     $TransferBulletPoint=(array_merge($oneway_TransferBulletPoint,$return_TransferBulletPoint));
    $TransferBulletPoint = array_values(array_combine(array_map(function ($i) { return $i->type; }, $TransferBulletPoint), $TransferBulletPoint));

  # echo "<pre>";print_r($booking_response_data);
?>




<html>
    <head></head>

    <body>
        <div style="width:850px; padding: 0 25px 25px 10px; border: 2px solid #a7a7a7; height:auto; margin:0 auto;background-color: #fbfbfb;">
            <div style="width:810px;padding:10px;">
                <div style="width:400px; float:left;">
                    <h2 style="font-family: Verdana, Geneva, sans-serif; color: #545454; margin-left:5px;">Transfer VOUCHER</h2>
                    <h4 style="font-family: Verdana, Geneva, sans-serif; color: #545454; margin-left:5px; font-weight:normal;">Date: <?php echo date('D, d M Y',  strtotime($bookedDate[0])); ?></h4>

                    <?php if($TicketData->transferType=='TER'){?>
 <h4 style="font-family: Verdana, Geneva, sans-serif; color: #545454; margin-left:5px; font-weight:normal;"> Service Name : 
  <strong><?php echo $TicketData->MasterServiceType; ?></strong>
                            <span><?php echo $TicketData->MasterProductType; ?></span>
                            <i><?php echo $TicketData->MasterVehicleType; ?></i>
                           <!-- <br>
                           TransferType :--> <?php //echo $TicketData->transferType;  ?>

                    </h4>
                    <?php }else{ ?>

                     <h4 style="font-family: Verdana, Geneva, sans-serif; color: #545454; margin-left:5px; font-weight:normal;"> Service Name (<?php echo $TicketData->transferType; ?>): 
  <strong><?php echo $TicketData->MasterServiceType; ?></strong>
                            <span><?php echo $TicketData->MasterProductType; ?></span>
                            <i><?php echo $TicketData->MasterVehicleType; ?></i>
                        

                    </h4>

                  <?php  if($TicketData_->return!=null){ ?>
 <h4 style="font-family: Verdana, Geneva, sans-serif; color: #545454; margin-left:5px; font-weight:normal;"> Service Name (<?php echo $TicketData_return->transferType; ?>): 
  <strong><?php echo $TicketData_return->MasterServiceType; ?></strong>
                            <span><?php echo $TicketData_return->MasterProductType; ?></span>
                            <i><?php echo $TicketData_return->MasterVehicleType; ?></i>
                        

                    </h4>

                    <?php } } ?>
                
                   
                     <!--  <h4 style="font-family: Verdana, Geneva, sans-serif; color: #545454; margin-left:5px; font-weight:normal;">Code: <?php echo $TicketData->Code; ?></h4>

                       <h4 style="font-family: Verdana, Geneva, sans-serif; color: #545454; margin-left:5px; font-weight:normal;">VehicleType: <?php echo $TicketData->VehicleType; ?></h4> -->

                      
                    
                     <h4 class="recent">Route:</h4>
                        <?php 
$PickupLocation=(array)$TicketData->PickupLocation;
$DestinationLocation=(array)$TicketData->DestinationLocation;
 ?>
<p><?php echo $PickupLocation['Name']." (".$PickupLocation['Code'].") -> ".$DestinationLocation['Name']." (".$DestinationLocation['Code'].")";?></p>

<?php if($TicketData_->return!=null){ ?>
  <p>Return - Route : <?php echo $DestinationLocation['Name']." (".$DestinationLocation['Code'].") -> ".$PickupLocation['Name']." (".$PickupLocation['Code'].")";?></p>

<?php } ?>
                </div>
                <div style="width: 250px;float: right;text-align: right;">
                    <img src="<?php echo base_url(); ?>assets/img/logo12.png" class="img-responsive" style='width:140px;'>
                </div>
                <div style="clear:both;">
                    <p style="font-family:Verdana, Geneva, sans-serif; font-size:13px;  padding: 0px 5px 5px 5px; color:#a3b50f;font-weight: bold;">
                        The booking you recently made on the Goldenedge Travels website is confirmed. Your reservation details are below.
                    </p>
                </div>
                <table style="width:80%; font-family: Verdana, Geneva, sans-serif; font-size:14px;padding:5px;margin-left:70px;color: #353535;"
                       cellspacing="0" cellpadding="15">
                    <tbody><tr>
                            <td style="padding:15px 10px 15px 10px; border:1px solid #bdbcbc; margin-left:10px;">Customer Name:</td>
                            <td style="padding:15px 10px 15px 10px;  border:1px solid #bdbcbc; margin-bottom:10px;"><?php echo $bookingData->title.' '.$bookingData->first_name.' '.$bookingData->last_name; ?></td>
                        </tr>
                        <tr style="height: 5px;"></tr>
                        <tr>
                            <td style="padding:15px 10px 15px 10px; border:1px solid #bdbcbc;">Customer Email:</td>
                            <td style="padding:15px 10px 15px 10px; border:1px solid #bdbcbc;"><?php echo $bookingData->email; ?></td>
                        </tr>
                        <tr style="height: 5px;"></tr>
                        <tr>
                             <td style="padding:15px 10px 15px 10px; border:1px solid #bdbcbc;">Ticket Conformation Number:</td>
                            <td style="padding:15px 10px 15px 10px; border:1px solid #bdbcbc;"><?php echo $bookingData->confirmation_number; ?> <?php echo ($booking_response_data->RoundFileNumber_!='')?" , ".$booking_response_data->RoundFileNumber_:''; ?></td>
                        </tr>
                        <tr style="height: 5px;"></tr>
                      <!--   <tr>
                            <td style="padding:15px 10px 15px 10px; border:1px solid #bdbcbc;">Provider Reference:</td>
                            <td style="padding:15px 10px 15px 10px; border:1px solid #bdbcbc;"><?php if($bookingData->provider_ref != ''){ $ref= explode('<br />',$bookingData->provider_ref); echo $ref[0]; } else echo '';  ?></td>
                        </tr>
                        <tr style="height: 5px;"></tr>
                        <tr>
                            <td style="padding:15px 10px 15px 10px; border:1px solid #bdbcbc;">Provider Name:</td>
                            <td style="padding:15px 10px 15px 10px; border:1px solid #bdbcbc;"><?php if($bookingData->provider_name != ''){ $ref= $bookingData->provider_name; echo $ref; } else echo '';  ?></td>
                        </tr>
                        <tr style="height: 5px;"></tr>
                        <tr>
                            <td style="padding:15px 10px 15px 10px; border:1px solid #bdbcbc;">Provider Phone:</td>
                            <td style="padding:15px 10px 15px 10px; border:1px solid #bdbcbc;"><?php if($bookingData->provider_phone != ''){ $ref= $bookingData->provider_phone; echo $ref; } else echo '-----------';  ?></td>
                        </tr> -->
                          <tr style="height: 5px;"></tr>
                        <tr>
                            <td style="padding:15px 10px 15px 10px; border:1px solid #bdbcbc;">Hotelbeds Booking Reference Number:</td>
                            <td style="padding:15px 10px 15px 10px; border:1px solid #bdbcbc;"><?php echo $bookingData->hotelbeds_refrence; ?> </td>
                        </tr>
                        <tr>
                            <td style="padding:15px 10px 15px 10px; border:1px solid #bdbcbc;">Reference Number:</td>
                            <td style="padding:15px 10px 15px 10px; border:1px solid #bdbcbc;"><?php echo $bookingData->ref_id; ?></td>
                        </tr>
                        <tr style="height: 5px;"></tr>
                        
                        <tr style="height: 5px;"></tr>
                        <tr>
                            <td style="padding:15px 10px 15px 10px; border:1px solid #bdbcbc;">Booking Date:</td>
                            <td style="padding:15px 10px 15px 10px; border:1px solid #bdbcbc;"><?php echo date('D, d M Y',  strtotime($bookedDate[0])); ?></td>
                        </tr>
                    </tbody>
                </table>
                
                <table  style="width:100%; font-family: Verdana, Geneva, sans-serif; font-size:14px; padding:5px;"
                        border="0" cellspacing="0" cellpadding="10">
                    <tbody>
                        <tr>
                            <td style="border:1px solid #bdbcbc;">Pick Up:</td>
                            <td style="border:1px solid #bdbcbc;">Droff Off:</td>
                            <td align="center" style="border:1px solid #bdbcbc;">Number of nights:</td>
                            <td align="center" style="border:1px solid #bdbcbc;">Number of guests:</td>
                        </tr>
                        <tr style="">
                            <td style="border:1px solid #bdbcbc;"><?php echo date('m/d/y',strtotime($bookingData->cin)); ?></td>
                            <td style="border:1px solid #bdbcbc;"><?php echo date('m/d/y',strtotime($bookingData->cout)); ?></td>
                            <td style="border:1px solid #bdbcbc;" align="center">
                                <?php 
                                    $diff = strtotime($bookingData->date_to) - strtotime($bookingData->date_from);
                                    $sec = $diff % 60;
                                    $diff = intval($diff / 60);
                                    $min = $diff % 60;
                                    $diff = intval($diff / 60);
                                    $hours = $diff % 24;
                                    echo (intval($diff / 24)+1);
                                ?>
                            </td>
                            <td style="border:1px solid #bdbcbc;" align="center">Adult: <?php echo $bookingData->adult; ?> <?php echo($bookingData->child>0?"Child :".$bookingData->child:''); ?></td>
                            
                        </tr>
                    </tbody>
                </table>
                <?php
                    if(isset($paxDetails))
                    {
                        if($paxDetails != '') 
                        { 
                            //echo '<pre />';print_r($paxDetails);die;
                            foreach($paxDetails as $ps)
                            { 
                                $contactName = $ps->first_name." ".$ps->last_name;
                                break;
                            }
                        }
                    }
                ?>
                <div style="width:100%; height:50px;">
                    <h3 style="font-family: Verdana, Geneva, sans-serif; margin:0; color:#a3b50f;text-align:center; padding:15px 15px 15px 15px; font-size:15px; font-weight:normal;">Transfer  Information</h3>
                </div>
                <table border="0" cellspacing="0" cellpadding="15" style="width:100%; font-family: Verdana, Geneva, sans-serif; font-size:14px; padding:5px;">
                    <tbody>
                        <tr>
                            <td style="border:1px solid #bdbcbc;">S.No</td>
                            <td style="border:1px solid #bdbcbc;">Service Name</td>
                             <td style="border:1px solid #bdbcbc;">transferType</td>
                            <td style="border:1px solid #bdbcbc;">Reserved For</td>
                            <td style="border:1px solid #bdbcbc;">Status</td>

                            <td style="border:1px solid #bdbcbc;">Conformation Number</td>
                             <!--   <td style="border:1px solid #bdbcbc;">Price</td> -->
                        </tr>
                        <tr>
                            <td style="border:1px solid #bdbcbc;">1</td>
                            <td style="border:1px solid #bdbcbc;">
                                <strong><?php echo $TicketData->MasterServiceType; ?></strong>
                            <span><?php echo $TicketData->MasterProductType; ?></span>
                            <i><?php echo $TicketData->MasterVehicleType; ?></i>
                            </td>
                              <td style="border:1px solid #bdbcbc;"><?php echo $TicketData->transferType; ?> </td>
                            <td style="border:1px solid #bdbcbc;"><?php echo $contactName; ?></td>
                            <td style="border:1px solid #bdbcbc;"><?php echo $bookingData->booking_status; ?> </td>
                            <td style="border:1px solid #bdbcbc;">
<?php echo $bookingData->confirmation_number; ?> 
                           </td>
                         
                        </tr>

                        <?php if($TicketData->transferType!='TER'){ ?>
 <tr>
                            <td style="border:1px solid #bdbcbc;">1</td>
                            <td style="border:1px solid #bdbcbc;">
                                <strong><?php echo $TicketData_return->MasterServiceType; ?></strong>
                            <span><?php echo $TicketData_return->MasterProductType; ?></span>
                            <i><?php echo $TicketData_return->MasterVehicleType; ?></i>
                            </td>
                              <td style="border:1px solid #bdbcbc;"><?php echo $TicketData_return->transferType; ?> </td>
                            <td style="border:1px solid #bdbcbc;"><?php echo $contactName; ?></td>
                            <td style="border:1px solid #bdbcbc;"><?php echo $bookingData->booking_status; ?> </td>
                            <td style="border:1px solid #bdbcbc;">
<?php echo ($booking_response_data->RoundFileNumber_!='')?$booking_response_data->RoundFileNumber_:''; ?>
                           </td>
                         
                        </tr>
                      <?php  } ?>
                    </tbody>
                </table>
                <div style="width:100%; height:50px;">
                    <h3 style="font-family: Verdana, Geneva, sans-serif; margin:0; color:#a3b50f; padding:15px 15px 10px 15px; font-size:15px; font-weight:normal;
                        border-bottom:1px solid #bdbcbc; text-align:center;">TransferPickupInformation / Contract Comments</h3>
                </div>
                <p style="padding: 0 10px 10px 10px;">
                    <?php 

   echo ($booking_response_data->TransferPickupTime!=null)?"<b>TransferPickupTime  (".$TicketData_return->transferType.") :</b>".$booking_response_data->TransferPickupTime->date." :".$booking_response_data->TransferPickupTime->time:'';
                    
  echo "<br>";
                        echo ($TicketData->TransferPickupInformation!=null)?"<b>TransferPickupInformation   (".$TicketData->transferType.") :</b>".$TicketData->TransferPickupInformation:'';
                          echo ($bookingData->contract_comments!=null)?"<b>Comments :</b>".$bookingData->contract_comments:'';
                        
                    ?>
                </p>

   <?php if($TicketData->transferType!='TER'){ ?>
                 <p style="padding: 0 10px 10px 10px;">
                    <?php 
                    #print_r($booking_response_data->Return_TransferPickupTime);
                     echo ($booking_response_data->Return_TransferPickupTime!=null)?"<b>TransferPickupTime  (".$TicketData_return->transferType.") :</b>".$booking_response_data->Return_TransferPickupTime->date." :".$booking_response_data->Return_TransferPickupTime->time:'';
                     echo "<br>";
                        echo ($TicketData_return->TransferPickupInformation!=null)?"<b>TransferPickupInformation  (".$TicketData_return->transferType.") :</b>".$TicketData_return->TransferPickupInformation:'';
                        
                        
                    ?>
                </p>
                <?php } ?>
                <div style="width:100%; height:40px;">
                    <h3 style="font-family: Verdana, Geneva, sans-serif; margin:0; color:#a3b50f; padding:15px 15px 15px 15px;
                        font-size:15px; font-weight:normal; text-align:center;">Passenger Details</h3>
                </div>
                <table border="0" cellspacing="0" cellpadding="10" style="width:100%; font-family: Verdana, Geneva, sans-serif; font-size:14px; padding:5px;">
                    <tbody>
                        <tr>
                            <td style="border:1px solid #bdbcbc;">Passenger Name</td>
                            <td style="border:1px solid #bdbcbc;">Passenger Type</td>
                            <td style="border:1px solid #bdbcbc;">Age</td>
                        </tr>
                        <?php   if(isset($paxDetails))
                                {
                                    if($paxDetails != '') 
                                    { 
                                        //echo '<pre />';print_r($paxDetails);die;
                                        foreach($paxDetails as $ps)
                                        { 
                                            $contactName = $ps->first_name." ".$ps->last_name;
                       // echo $ps->title." ".$ps->first_name." ".$ps->last_name;
                        ?>
                        <tr>
                            <td style="border:1px solid #bdbcbc;"><?php echo $ps->first_name." ".$ps->last_name; ?></td>
                            <td style="border:1px solid #bdbcbc;"><?php echo $ps->type ?></td>
                            <td style="border:1px solid #bdbcbc;"><?php echo($ps->type=='Adult'?'--':$ps->age); ?></td>
                        </tr>
                        <?php 
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
              <!--  <div style="width:100%; height:50px;">
                    <h3 style="font-family: Verdana, Geneva, sans-serif; margin:0; color:#a3b50f; padding:15px 15px 10px 15px; font-size:15px; font-weight:normal;
                        border-bottom:1px solid #bdbcbc; text-align:center;">Cancellation Policy</h3>
                </div>
                <p style="padding: 0 10px 10px 10px;">






                                <?php  

                                 if($TicketData->CancellationPolicy!=null){ 
                                    $CancellationPolicy=$TicketData->CancellationPolicy;
                                   
                                   

                                    foreach ($CancellationPolicy as $key => $CancellationPolicyvalue) { $CancellationPolicyvalue=(array)$CancellationPolicyvalue; ?>
  

                   
<p>Cancellation : <b>Amount</b> <?php  echo ($CancellationPolicyvalue['amount']!=null)?$TicketData->Currency.($CancellationPolicyvalue['amount']):'00'; ?>
<br>
<b>Date </b> <?php echo ($CancellationPolicyvalue['dateFrom']!=null)?date('Y-M-d',strtotime($CancellationPolicyvalue['dateFrom'])):'N/A'; ?> - (hhmm)<?php echo ($CancellationPolicyvalue['time']!=null)?$CancellationPolicyvalue['time']:'N/A'; ?>
</p>
<?php  } }  ?>


<?php   if($returnTicketData->CancellationPolicy!=null){
 $returnCancellationPolicy=$returnTicketData->CancellationPolicy;

 foreach ($returnCancellationPolicy as $key => $CancellationPolicyvalue) {  $CancellationPolicyvalue=(array)$CancellationPolicyvalue; ?>
  

                   
<p>Cancellation : <b>Amount</b> <?php  echo ($CancellationPolicyvalue['amount']!=null)?$TicketData->Currency.($CancellationPolicyvalue['amount']):'00'; ?>
<br>
<b>Date </b> <?php echo ($CancellationPolicyvalue['dateFrom']!=null)?date('Y-M-d',strtotime($CancellationPolicyvalue['dateFrom'])):'N/A'; ?> - (hhmm)<?php echo ($CancellationPolicyvalue['time']!=null)?$CancellationPolicyvalue['time']:'N/A'; ?>
</p>
<?php  } }  ?>


               

                 * Cancellation policies showing the total amount  to pay in case of cancellation between the dates indicated in from date to date.
                 
            (The cancellation policies based in hours and dates of the destination <b><?php echo isset($PickupLocation['Name'])? $PickupLocation['Name'].' ('.$PickupLocation['Code'].')' : 'N/A'; ?></b>.)
                         
                </p> -->


                <div style="width:100%; height:50px;">
                    <h3 style="font-family: Verdana, Geneva, sans-serif; margin:0; color:#a3b50f; padding:15px 15px 10px 15px; font-size:15px; font-weight:normal;
                        border-bottom:1px solid #bdbcbc; text-align:center;">Service Information</h3>
                </div>
                <p style="padding: 0 10px 10px 10px;">
                <?php foreach($TransferBulletPoint  as $key => $TransferBulletPointvalue) {
                   
                  echo $TransferBulletPointvalue->description."<br>";
                } ?>

                </p>

  <div style="width:100%; height:50px;">
                    <h3 style="font-family: Verdana, Geneva, sans-serif; margin:0; color:#a3b50f; padding:15px 15px 10px 15px; font-size:15px; font-weight:normal;
                        border-bottom:1px solid #bdbcbc; text-align:center;">Waiting time:</h3>
                </div>
                

     <div class="col-md-10 pad_left0">
  <?php if($TicketData->Domestic_waiting!=null){ $Domestic_waiting= (array) $TicketData->Domestic_waiting;
echo "<p>Maximum supplier waiting time:". $Domestic_waiting['@attributes']->time .$Domestic_waiting['@content']." (Domestic)</p>";
}
?>

<?php if($TicketData->International_waiting!=null){ $International_waiting= (array) $TicketData->International_waiting;
echo "<p>Maximum supplier waiting time:". $International_waiting['@attributes']->time .$International_waiting['@content']." (International)</p>";
}

                                ?>
                                </div>


                <div style="width:100%; height:50px;">
                    <h3 style="font-family: Verdana, Geneva, sans-serif; margin:0; color:#a3b50f; padding:15px 15px 10px 15px; font-size:15px; font-weight:normal;
                        border-bottom:1px solid #bdbcbc; text-align:center;">Transfer guidelines </h3>
                </div>
                <p style="padding: 0 10px 10px 10px;">
                <?php foreach($TicketData->GenericTransferBulletPoint  as $key => $Tgl) {
                  echo "<h5>".$Tgl->description."</h5>";
                  echo $Tgl->detail_description."<br>";
                } ?>

                </p>

<div style="width:100%; height:50px;">
                    <h3 style="font-family: Verdana, Geneva, sans-serif; margin:0; color:#a3b50f; padding:15px 15px 10px 15px; font-size:15px; font-weight:normal;
                        border-bottom:1px solid #bdbcbc; text-align:center;">Specific Transfer information </h3>
                </div>
                <p style="padding: 0 10px 10px 10px;">
                <?php foreach($TicketData->SpecificTransferInfoList  as $key => $sti) {
                 
                  echo $sti->description."<br>";
                } ?>

                </p>


          <?php if($TicketData->transferType!='TER'){?>
 <div style="width:100%; height:50px;">
                    <h3 style="font-family: Verdana, Geneva, sans-serif; margin:0; color:#a3b50f; padding:15px 15px 10px 15px; font-size:15px; font-weight:normal;
                        border-bottom:1px solid #bdbcbc; text-align:center;">Disclaimer</h3>
                </div>
                <p style="padding: 0 10px 10px 10px;">
                   Transfer web information: <a href="<?php echo ($bookingPrepare_data->TransferWebInformation!='')?$bookingPrepare_data->TransferWebInformation:$booking_response_data->Return_TransferWebInformation;?>"><?php echo ($bookingPrepare_data->TransferWebInformation!='')?$bookingPrepare_data->TransferWebInformation:$booking_response_data->Return_TransferWebInformation;?></a><br>
                   Time before consulting web: <?php echo ($bookingPrepare_data->TimeBeforeConsultingWeb!='')?$bookingPrepare_data->TimeBeforeConsultingWeb:$booking_response_data->Return_TimeBeforeConsultingWeb;?>



                </p>
          <?php } ?>


                 <div style="width:100%; height:50px;">
                    <h3 style="font-family: Verdana, Geneva, sans-serif; margin:0; color:#a3b50f; padding:15px 15px 10px 15px; font-size:15px; font-weight:normal;
                        border-bottom:1px solid #bdbcbc; text-align:center;">Payment Information</h3>
                </div>
                <p style="padding: 0 10px 10px 10px;">

*Your have to pay at destination.
<br>
"Payable through     <?php echo $bookingData->hotelbeds_supplier_name;?>, acting as agent for the service operating company, details of which can be provided upon request. VAT:     <?php echo $bookingData->hotelbeds_vat_number;?> Reference:     <?php echo $bookingData->hotelbeds_refrence;?>"

                
                </p>



                
                
                <div style="width:100%; height:50px;">
                    <h3 style="font-family: Verdana, Geneva, sans-serif; margin:0; color:#a3b50f; padding:15px 15px 10px 15px; font-size:15px; font-weight:normal;
                        border-bottom:1px solid #bdbcbc; text-align:center;">Customer Support Contact Information</h3>
                </div>
                <p style="padding: 0 10px 10px 10px;">
                    Please Contact this Number for any Queries : +11 22 999 8888
                </p>
                <p style="padding: 0 10px 10px 10px;">
                    Email Us at  : support@goldenedge.com
                </p>
                <p style="font-family: Verdana, Geneva, sans-serif; font-size:11px; padding:10px;">*Please note: Preferences and special requests cannot be guaranteed. Special requests are subject to availability upon check-in and may include additional charges.</p>
                
            </div>
        </div>
    </body>
</html>