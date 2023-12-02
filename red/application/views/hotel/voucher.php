<?php 
    $bookedDate = explode(' ',$bookingData->timestamp);
?>
<html>
    <head><title><?php echo Site_Title; ?></title></head>
    <body>
        <div style="width:850px; padding: 0 25px 25px 10px; border: 2px solid #a7a7a7; height:auto; margin:0 auto;background-color: #fbfbfb;">
            <div style="width:810px;padding:10px;">
                <div style="width:400px; float:left;">
                    <h2 style="font-family: Verdana, Geneva, sans-serif; color: #545454; margin-left:5px;">HOTEL VOUCHER</h2>
                    <h4 style="font-family: Verdana, Geneva, sans-serif; color: #545454; margin-left:5px; font-weight:normal;">Date: <?php echo date('D, d M Y',  strtotime($bookedDate[0])); ?></h4>
                    <h4 style="font-family: Verdana, Geneva, sans-serif; color: #545454; margin-left:5px; font-weight:normal;">Hotel Name: <?php echo $bookingData->hotel_name; ?></h4>
                </div>
                <div style="width: 250px;float: right;text-align: right;">
                    <img src="<?php echo base_url(); ?>assets/images/logo.png" class="img-responsive" style="width: 300;" >
                </div>
                <div style="clear:both;">
                    <p style="font-family:Verdana, Geneva, sans-serif; font-size:13px;  padding: 0px 5px 5px 5px; color:#a3b50f;font-weight: bold;">
                        The booking you recently made on the Redtag Travels website is confirmed. Your reservation details are below.
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
                            <td style="padding:15px 10px 15px 10px; border:1px solid #bdbcbc;">Hotel Itinerary Number:</td>
                            <td style="padding:15px 10px 15px 10px; border:1px solid #bdbcbc;"><?php echo $bookingData->api_ref_id; ?></td>
                        </tr>
                        <tr style="height: 5px;"></tr>
                        <tr>
                            <td style="padding:15px 10px 15px 10px; border:1px solid #bdbcbc;">Reference Number:</td>
                            <td style="padding:15px 10px 15px 10px; border:1px solid #bdbcbc;"><?php echo $bookingData->ref_id; ?></td>
                        </tr>
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
                            <td style="border:1px solid #bdbcbc;">Check In:</td>
                            <td style="border:1px solid #bdbcbc;">Check Out:</td>
                            <td align="center" style="border:1px solid #bdbcbc;">Number of nights:</td>
                            <td align="center" style="border:1px solid #bdbcbc;">Number of guests:</td>
                        </tr>
                        <tr style="">
                            <td style="border:1px solid #bdbcbc;"><?php echo $bookingData->cin; ?></td>
                            <td style="border:1px solid #bdbcbc;"><?php echo $bookingData->cout; ?></td>
                            <td style="border:1px solid #bdbcbc;" align="center">
                                <?php 
                                    $diff = strtotime($bookingData->cout) - strtotime($bookingData->cin);
                                    $sec = $diff % 60;
                                    $diff = intval($diff / 60);
                                    $min = $diff % 60;
                                    $diff = intval($diff / 60);
                                    $hours = $diff % 24;
                                    echo intval($diff / 24);
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
                    <h3 style="font-family: Verdana, Geneva, sans-serif; margin:0; color:#a3b50f;text-align:center; padding:15px 15px 15px 15px; font-size:15px; font-weight:normal;">Room Information</h3>
                </div>
                <table border="0" cellspacing="0" cellpadding="15" style="width:100%; font-family: Verdana, Geneva, sans-serif; font-size:14px; padding:5px;">
                    <tbody>
                        <tr>
                            <td style="border:1px solid #bdbcbc;">S.No</td>
                            <td style="border:1px solid #bdbcbc;">Room Type</td>
                            <td style="border:1px solid #bdbcbc;">Reserved For</td>
                            <td style="border:1px solid #bdbcbc;">Status</td>
                            <td style="border:1px solid #bdbcbc;">Conformation Number</td>
                        </tr>
                        <tr>
                            <td style="border:1px solid #bdbcbc;">1</td>
                            <td style="border:1px solid #bdbcbc;"><?php echo $bookingData->room_category; ?> </td>
                            <td style="border:1px solid #bdbcbc;"><?php echo $contactName; ?></td>
                            <td style="border:1px solid #bdbcbc;"><?php echo $bookingData->booking_status; ?> </td>
                            <td style="border:1px solid #bdbcbc;"><?php echo $bookingData->api_ref_id; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div style="width:100%; height:50px;">
                    <h3 style="font-family: Verdana, Geneva, sans-serif; margin:0; color:#a3b50f; padding:15px 15px 10px 15px; font-size:15px; font-weight:normal;
                        border-bottom:1px solid #bdbcbc; text-align:center;">Booking Remarks</h3>
                </div>
                <p style="padding: 0 10px 10px 10px;">
                    <?php 
                        echo $bookingData->remarks;
                    ?>
                </p>
                
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
                <div style="width:100%; height:50px;">
                    <h3 style="font-family: Verdana, Geneva, sans-serif; margin:0; color:#a3b50f; padding:15px 15px 10px 15px; font-size:15px; font-weight:normal;
                        border-bottom:1px solid #bdbcbc; text-align:center;">Cancellation Policy</h3>
                </div>
                <p style="padding: 0 10px 10px 10px;">
                    <?php 
                        echo $bookingData->cancellation_policy;
                    ?>
                </p>
                
                <div style="width:100%; height:50px;">
                    <h3 style="font-family: Verdana, Geneva, sans-serif; margin:0; color:#a3b50f; padding:15px 15px 10px 15px; font-size:15px; font-weight:normal;
                        border-bottom:1px solid #bdbcbc; text-align:center;">Customer Support Contact Information</h3>
                </div>
                <p style="padding: 0 10px 10px 10px;">
                    Please Contact this Number for any Queries : +33 2 222 1111
                </p>
                <p style="padding: 0 10px 10px 10px;">
                    Email Us at  : support@redtagtravels.com
                </p>
                <p style="font-family: Verdana, Geneva, sans-serif; font-size:11px; padding:10px;">*Please note: Preferences and special requests cannot be guaranteed. Special requests are subject to availability upon check-in and may include additional charges.</p>
                
            </div>
        </div>
    </body>
</html>