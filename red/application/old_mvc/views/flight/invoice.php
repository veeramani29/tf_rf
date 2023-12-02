<!DOCTYPE html>
<html>
    <head>
        <title>Red Tag Travels</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
        
        <link href='https://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.png" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url(); ?>favicon.png" type="image/x-icon">
        
        <style type="text/css">
            .buttonStyles{
                width:182px;
                height:22px;
                float:right !important;
                margin-right:8px !important;
            }
            td, th {border: 0px solid #000; padding: .5em;}
            table {margin-bottom: 0px}
            .pdfLink {display: block;}
            .alert-err{color: #ffffff; background-color: #ff0000;background-image: url('/static/img/icons/gn_icons.gif');background-position: -4px -162px;margin: 10px 0;background-repeat: no-repeat;padding: 17px 63px;font-weight: bold;font-family: arial;}
            .formtext {font-style: normal !important;}
            .print_ticket{
                border: none;background: none;-webkit-border-radius:5px;
                background-image: url("/static/img/interface_elements/button_small_right.png");background-position: top right;background-repeat: no-repeat;padding: 0px 9px 0px 0px;margin: 0px;height: 32px;color: #fff;font-stretch: wider;font-family: arial, sans-serif;font-size: 9pt;font-weight: bolder;cursor: pointer;float: right;padding-right: 22px;margin-right: 90px;text-align: center;
                padding: 3px;color: white;height: 21px;float: right;font-weight: normal;text-align: -webkit-center;
            }
            .ticket_detail_background{
                background-color:white ;padding:14px;border-color: honeydew;border-style: solid;
            }
            .button{ font-size: 15.5px; margin-top: 20px; padding: 4px 10px; background-color: #5FA910; color: floralwhite; border-radius: 5px; font-weight: bold !important; font-family: arial !important; }
            .fareChangeMsg{ width: 45%; text-align:center;}
            .fareChangeText { font-weight: bold;font-size: 19px; }
            .priceText { font-size: 19px; }
            #oldPrice { color:#FF0000; text-decoration: line-through; }
            #newPrice { color:#5fa910; }
            div.buttonImg, #doc2 div.buttonImg, div.buttonImg { padding: 0px 9px;}
        </style>

    </head>
    <body>
        <div style="width:700px;text-align:center;display: inline-block;">
            <div style="margin-top:10px;margin-bottom:20px;text-align:center;">
                <a href="javascript:window.print()"><img src="<?php echo base_url(); ?>assets/images/printer.png" width="30" height="24" border="0" /></a>
            </div>
            <div class="via_intrnl_comn_hd_bg"><div class="via_hd_font_align">
                    <table width="100%">
                        <tbody><tr>
                                <td style="padding:0;">Booking Details</td>
                                <td style="padding:0;">
                                    <div align="right">
                                        <b>Your Booking Reference Number: &nbsp;&nbsp;<span style="font-size:18px"><?php echo $flightDetails->booking_ref; ?></span></b>
                                    </div>
                                </td>
                            </tr>
                        </tbody></table>
                </div></div>
            <div class="ticket_detail_background">
                <div class="via_intl_panel_div">
                    <div class="via_intl_book_panel_div">

                        <div style="font-size: large; font-family: sans-serif">
                            <img src="<?php echo base_url(); ?>assets/images/LATEST.png" height="130px;" width="350px;">
                        </div>
                        <div>
                            <h4>Booking Date : <?php echo date('D, d M Y', strtotime($flightDetails->booked_date)); ?></h4>
                        </div>
                        <div>
                            <h4>Email Id : <?php echo $flightDetails->user_email; ?></h4>
                        </div>
                        <div>
                            <h4>Contact No. : <?php echo $flightDetails->user_mobile; ?></h4>
                        </div>
                        
                        <div>
                            <h4>Transection Id : <?php echo $flightDetails->payment_transection_id; ?></h4>
                        </div>
                        <div class="hdopen"><div class="hdopen-1"><div class="hdopen-2"><div class="hdopen-3"><div class="hdopen-4">
                                            




                                                <br>


                                                
                                                <br><br>
                                                <table border="0" style="margin-top:2px;margin-left:30px;width:90%;font-size:12px;" cellspacing="4" class="via_glob_font_size via_pass_ticket_details">

                                                    <tbody>
                                                        <?php 
                                                            $baggagePrice = 0;
                                                            foreach ($paxDetails as $pax)
                                                            {
                                                                if($pax->title == 1) $title = 'Mr';
                                                                else if($pax->title == 2) $title = 'Mrs';
                                                                else if($pax->title == 3) $title = 'Miss';
                                                                else $title = 'Mstr';
                                                        ?>
                                                        <tr valign="top">
                                                            <td colspan="6" align="center"><b>Passenger Details :</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="6" style="padding:0;"><div style="height:1px;border-bottom:5px solid #d0d0d0;"></div></td>
                                                        </tr>
                                                                <tr valign="top">
                                                                    <td>
                                                                        <b style="font-size:13px;">1.</b>
                                                                    </td>
                                                                    <td class="kSearchLAResultText" ><?php echo $title; ?>.&nbsp;<?php echo $pax->last_name; ?>&nbsp;<?php echo $pax->first_name; ?></td>
                                                                    <td class="kSearchLAResultText" >(<?php echo $pax->type; ?>)</td>
                                                                    <?php 
                                                                        if($pax->pass_no != '')
                                                                        {
                                                                    ?>
                                                                            <td>Passport No<br /><?php echo $pax->pass_no; ?></td>	
                                                                    <?php 
                                                                        }
                                                                        else
                                                                        {
                                                                    ?>
                                                                            <td>&nbsp;</td>
                                                                    <?php
                                                                        }
                                                                        if($pax->extra_baggage_onward != '')
                                                                        {
                                                                            $baggage = explode(';',$pax->extra_baggage_onward);
                                                                            $baggagePrice = ($baggagePrice+$baggage[1]);
                                                                    ?>
                                                                            <td>Onward Baggage<br /><?php echo $baggage[0].'Kg - PHP'.$baggage[1]; ?></td>
                                                                    <?php
                                                                        }
                                                                        else
                                                                        {
                                                                    ?>
                                                                            <td>&nbsp;</td>
                                                                    <?php
                                                                        }
                                                                        
                                                                        if($pax->extra_baggage_return != '')
                                                                        {
                                                                            $baggageR = explode(';',$pax->extra_baggage_return);
                                                                            $baggagePrice = ($baggagePrice+$baggageR[1]);
                                                                    ?>
                                                                            <td>Return Baggage<br /><?php echo $baggageR[0].'Kg - PHP'.$baggageR[1]; ?></td>
                                                                    <?php
                                                                        }
                                                                        else
                                                                        {
                                                                    ?>
                                                                            <td>&nbsp;</td>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                     
                                                        </tr>
                                                        <tr valign="top">
                                                            <td colspan="6" style="border-top:1px solid #d0d0d0;">&nbsp;</td>
                                                        </tr>
                                                        <?php
                                                            }
                                                        ?>
                                                        

                                                    </tbody></table>	
                                                <br>


                    <!-- 	<style type="text/css">.via_pass_ticket_details td{border-bottom:1px solid #d0d0d0!important;}</style>
                                                -->





                                                <br>

                                                <div style="padding:0px;margin-left:30px;margin-right:55px;" align="right">
                                                    <span style="font-size:15px;color:#000;">
                                                        Flight Fare: &nbsp; PHP <?php echo ($flightDetails->TotalFare - $baggagePrice); ?>
                                                    </span><hr>
                                                </div>
                                                <?php 
                                                    if($baggagePrice != 0)
                                                    {
                                                ?>
                                                <div style="padding:0px;margin-left:30px;margin-right:55px;" align="right">
                                                    <span style="font-size:15px;color:#000;">
                                                        Baggage Fare: &nbsp; PHP <?php echo $baggagePrice; ?>
                                                    </span>
                                                </div>
                                                <?php 
                                                    }
                                                ?>
                                                <div style="padding:10px 0px;margin-left:30px;margin-right:55px;" align="right">
                                                    <span style="font-weight:bold;font-size:15px;color:#000;"><hr>
                                                        Total Price: &nbsp; PHP <?php echo ($flightDetails->TotalFare); ?>
                                                    </span><hr>
                                                </div>




                                                <br>
                                                <br>



                                                <div style="margin-left:30px;"><b><font>Please note:</font></b></div>


                                                <!-- -->


                                                <div style="margin-left:30px;" class="via_plz_note_div">


                                                    <ol style="list-style: none;">
                                                        <li><b>Please note your Airline PNR No. You can use this PNR no. for reference at any of the airline counters at the airport or airline offices at your city.</b>

                                                        </li><li><b>You can reach us through&nbsp; support@redtagtravels.com / (63) (02) 8012620 or Email Us.</b></li>

                                                    </ol>




                                                </div>
                                                <style>.via_plz_note_div ol li {list-style:circle;line-height:1.5;font-size:11px;}</style>



                                                <div style="height:1px;border-bottom:1px solid #ccc;">&nbsp;</div>



                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                    <tbody><tr>
                                                            <td style="padding-top:10px;width:85%;">	


                                                            </td>
                                                            <td>
                                                                <div align="right">




                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">

                                                            </td>
                                                        </tr>
                                                    </tbody></table>







                                            
                                        </div></div></div></div></div>
                    </div></div></div>
        </div>
    </body>
</html>