<?php 
    $bookedDate = explode(' ',$bookingData->timestamp);
?>
<html>
    <head><title><?php echo Site_Title; ?></title></head>

    <body>
        <div style="width:850px; padding: 0 25px 25px 10px; border: 2px solid #a7a7a7; height:auto; margin:0 auto;background-color: #fbfbfb;">
            <div style="width:810px;padding:10px;">
                <div style="width:400px; float:left;">
                    <h2 style="font-family: Verdana, Geneva, sans-serif; color: #545454; margin-left:5px;">HOTEL INVOICE</h2>
                    <h4 style="font-family: Verdana, Geneva, sans-serif; color: #545454; margin-left:5px; font-weight:normal;">Date: <?php echo date('D, d M Y',  strtotime($bookedDate[0])); ?></h4>
                    <h4 style="font-family: Verdana, Geneva, sans-serif; color: #545454; margin-left:5px; font-weight:normal;">Hotel Name: <?php echo $bookingData->hotel_name; ?></h4>
                </div>
                <div style="width: 250px;float: right;text-align: right;">
                    <img src="<?php echo base_url(); ?>assets/images/logo.png" class="img-responsive" style="width: 300;" >
                </div>
                <div style="clear:both;">
                    <p style="font-family:Verdana, Geneva, sans-serif; font-size:13px;  padding: 0px 5px 5px 5px; color:#a3b50f;font-weight: bold;">
                        The booking you recently made on the Redtag Travels website is confirmed. Your invoice details are below.
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
                
                
                <div style="width:100%; height:50px;">
                    <h3 style="font-family: Verdana, Geneva, sans-serif; margin:0; color:#a3b50f;text-align:center; padding:15px 15px 15px 15px; font-size:15px; font-weight:normal;">Total Booking Cost (PHP)</h3>
                    
                </div>
                <table border="0" cellspacing="0" cellpadding="15" style="width:100%; font-family: Verdana, Geneva, sans-serif; font-size:14px;  padding:5px;">
                    <tbody>

                        <tr>
                            <td style="border:1px solid #bdbcbc;">Total </td>
                            <td style="border:1px solid #bdbcbc; text-align:center;">PHP <?php echo $bookingData->price; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div style="width:100%; height:auto;  padding:0px; ">
                <h3 style="font-family: Verdana, Geneva, sans-serif; margin:0;  padding:5px; font-size:15px; font-weight:normal;color:#a3b50f;
                    padding:15px 15px 15px 15px; text-align:center;">	Total cost for entire stay in PHP ( Including tax recovery charges and service fees )</h3>

                <table border="0" cellspacing="0" cellpadding="15" style="width:100%; font-family: Verdana, Geneva, sans-serif; font-size:14px;   padding:5px;">
                    <tbody>
                        <tr>
                            <td  style=" border:1px solid #bdbcbc;">Payment Status</td>
                            <td  style=" border:1px solid #bdbcbc;">Total Cost to Pay</td>
                        </tr>
                        <tr>
                            <td style=" border:1px solid #bdbcbc;">Confirmed</td>
                            <td style=" border:1px solid #bdbcbc;">PHP <?php echo $bookingData->price; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
                
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