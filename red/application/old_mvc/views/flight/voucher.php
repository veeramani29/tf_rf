<!DOCTYPE html>
<html>
    <head>
        <title>Redtag Travels</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body style="margin:auto;padding:auto;">
        <div style="width:700px;text-align:center;margin:auto;">
            <div style="margin-top:10px;margin-bottom:20px;text-align:center;">
                <a href="javascript:window.print()"><img src="<?php echo base_url(); ?>assets/images/printer.png" width="80" height="40" border="0" /></a>
            </div>
            <div class="via_intrnl_comn_hd_bg">
                <div class="via_hd_font_align">
                    <table width="100%">
                        <tbody><tr>
                                <td style="padding:0;">Booking Details</td>
                                <td style="padding:0;">
                                    <div align="right">
                                        <b>Your Booking Reference Number: &nbsp;&nbsp;<span style="font-size:18px"><?php echo $flightDetails->booking_ref; ?></span></b>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="background-color:white ;padding:14px;border-color: honeydew;border-style: solid;">
                <div class="via_intl_panel_div">
                    <div class="via_intl_book_panel_div">
                        <div style="font-size: large; font-family: sans-serif">
                            <img src="<?php echo base_url(); ?>assets/images/logo.png" height="130px;" width="350px;">
                        </div>
                        <div>
                            <h4>Booking Date : <?php echo date('D, d M Y', strtotime($flightDetails->booked_date)); ?></h4>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="u_paddedTable via_glob_font_size" style="margin:0px; padding:0px; border-width:0px;">
                            <tbody>
                                <tr>
                                    <td>
                                        <div style="">
                                            <div style="background-color:#fefefe;padding:8px;color:#000;font-size:15px;font-weight:bold;margin-bottom:10px;">
                                                Ticket - 1 : &nbsp;&nbsp;
                                                <b style="color:#404040;"> Airline PNR : <span style="font-size:17px"><?php echo ($flightDetails->pnr != '' ? $flightDetails->pnr : '------') ?></span></b>
                                                <hr>
                                            </div>
                                            <div class="via_glob_font_size" style="padding-left:30px;">
                                                <!--<b>Please note your Airline PNR: <span style='font-size:17px'>AIRASIAPNR</span></b>-->
                                            </div>   
                                        </div>  
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table width="90%" border="0" cellpadding="4" cellspacing="0" style="margin-top:5px;margin-left:30px;font-size:12px;" class="via_glob_font_size">
                            <tbody>
                                <tr valign="top">
                                    <td><b style="font-size:13px;">Airline</b></td>
                                    <td><b style="font-size:13px;">Flight</b></td>
                                    <td><b style="font-size:13px;">Departure City-Time-Date</b></td>
                                    <td><b style="font-size:13px;">Arrival City-Time-Date</b></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="padding:0;"><div style="height:1px;border-bottom:5px solid #d0d0d0;"></div></td>
                                </tr>
                                <?php
                                $OperatingAirline_Code = explode('<br>', $flightDetails->OperatingAirline_Code);
                                $airlineName = explode('<br>', $flightDetails->airline_name);
                                $FlightNumber = explode('<br>', $flightDetails->FlightNumber);
                                $Departure_LocationCode = explode('<br>', $flightDetails->Departure_LocationCode);
                                $Departure_TerminalID = explode('<br>', $flightDetails->Departure_TerminalID);
                                $Arrival_LocationCode = explode('<br>', $flightDetails->Arrival_LocationCode);
                                $Arrival_TerminalID = explode('<br>', $flightDetails->Arrival_TerminalID);
                                $DepartureDateTime = explode('<br>', $flightDetails->DepartureDateTime);
                                $ArrivalDateTime = explode('<br>', $flightDetails->ArrivalDateTime);
                                if ($flightDetails->stops == 0) {
                                    for ($i = 0; $i <= $flightDetails->stops; $i++) {
                                        $depArvAirport = $this->Flight_Model->getDepArvAirportOnCode($Departure_LocationCode[$i], $Arrival_LocationCode[$i]);
                                        $depDateTime = explode('T', $DepartureDateTime[$i]);
                                        $arvDateTime = explode('T', $ArrivalDateTime[$i]);
                                        $time_in_12_hour_format_dep = date("g:i a", strtotime($depDateTime[1]));
                                        $time_in_12_hour_format_arv = date("g:i a", strtotime($arvDateTime[1]));
                                        ?>
                                        <tr valign="top">
                                            <td><img src="<?php echo base_url(); ?>assets/images/airlines/<?php echo $OperatingAirline_Code[$i] . '_small' ?>.gif" alt=""></td>
                                            <td><?php echo $OperatingAirline_Code[$i] . '-' . $FlightNumber[$i]; ?></td>
                                            <td><?php echo $depArvAirport[0]['airport_name'] . ',' . $depArvAirport[0]['airport_city'] ?><br /><?php echo date('D d, M', strtotime($depDateTime[0])); ?> at <?php echo $time_in_12_hour_format_dep; ?></td>
                                            <td><?php echo $depArvAirport[1]['airport_name'] . ',' . $depArvAirport[1]['airport_city'] ?><br /><?php echo date('D d, M', strtotime($arvDateTime[0])); ?> at <?php echo $time_in_12_hour_format_arv; ?></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr valign="top">
                                            <td colspan="5" align="center">Airlines : <?php echo $airlineName[$i]; ?></td>
                                        </tr>
                                        <?php
                                            if ($i > 0) {
                                        ?>
                                        <tr valign="top">
                                            <td colspan="5" style="border-top:1px solid #d0d0d0;">&nbsp;</td>
                                        </tr>
                                        <?php
                                                }
                                            }
                                        }
                                        ?>
                            </tbody>
                        </table>
                        
                        <table width="90%" border="0" cellpadding="4" cellspacing="0" style="margin-top:5px;margin-left:30px;font-size:12px;" class="via_glob_font_size">
                            <tbody>
                                <tr valign="top">
                                    <td><b style="font-size:13px;">Airline</b></td>
                                    <td><b style="font-size:13px;">Flight</b></td>
                                    <td><b style="font-size:13px;">Departure City-Time-Date</b></td>
                                    <td><b style="font-size:13px;">Arrival City-Time-Date</b></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="padding:0;"><div style="height:1px;border-bottom:5px solid #d0d0d0;"></div></td>
                                </tr>
                                <?php
                                $OperatingAirline_Code = explode('<br>', $roundDetails->OperatingAirline_Code);
                                $airlineName = explode('<br>', $roundDetails->airline_name);
                                $FlightNumber = explode('<br>', $roundDetails->FlightNumber);
                                $Departure_LocationCode = explode('<br>', $roundDetails->Departure_LocationCode);
                                $Departure_TerminalID = explode('<br>', $roundDetails->Departure_TerminalID);
                                $Arrival_LocationCode = explode('<br>', $roundDetails->Arrival_LocationCode);
                                $Arrival_TerminalID = explode('<br>', $roundDetails->Arrival_TerminalID);
                                $DepartureDateTime = explode('<br>', $roundDetails->DepartureDateTime);
                                $ArrivalDateTime = explode('<br>', $roundDetails->ArrivalDateTime);
                                if ($roundDetails->stops == 0) {
                                    for ($i = 0; $i <= $roundDetails->stops; $i++) {
                                        $depArvAirport = $this->Flight_Model->getDepArvAirportOnCode($Departure_LocationCode[$i], $Arrival_LocationCode[$i]);
                                        $depDateTime = explode('T', $DepartureDateTime[$i]);
                                        $arvDateTime = explode('T', $ArrivalDateTime[$i]);
                                        $time_in_12_hour_format_dep = date("g:i a", strtotime($depDateTime[1]));
                                        $time_in_12_hour_format_arv = date("g:i a", strtotime($arvDateTime[1]));
                                        ?>
                                        <tr valign="top">
                                            <td><img src="<?php echo base_url(); ?>assets/images/airlines/<?php echo $OperatingAirline_Code[$i] . '_small' ?>.gif" alt=""></td>
                                            <td><?php echo $OperatingAirline_Code[$i] . '-' . $FlightNumber[$i]; ?></td>
                                            <td><?php echo $depArvAirport[0]['airport_name'] . ',' . $depArvAirport[0]['airport_city'] ?><br /><?php echo date('D d, M', strtotime($depDateTime[0])); ?> at <?php echo $time_in_12_hour_format_dep; ?></td>
                                            <td><?php echo $depArvAirport[1]['airport_name'] . ',' . $depArvAirport[1]['airport_city'] ?><br /><?php echo date('D d, M', strtotime($arvDateTime[0])); ?> at <?php echo $time_in_12_hour_format_arv; ?></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr valign="top">
                                            <td colspan="5" align="center">Airlines : <?php echo $airlineName[$i]; ?></td>
                                        </tr>
                                        <?php
                                            if ($i > 0) {
                                        ?>
                                        <tr valign="top">
                                            <td colspan="5" style="border-top:1px solid #d0d0d0;">&nbsp;</td>
                                        </tr>
                                        <?php
                                                }
                                            }
                                        }
                                        ?>
                            </tbody>
                        </table>
                        <br><br>
                        <table border="0" style="margin-top:2px;margin-left:30px;width:90%;font-size:12px;" cellspacing="4">
                            <tbody>
                            <?php
                                $baggagePrice = 0;
                                foreach ($paxDetails as $pax) {
                                    if ($pax->title == 1)
                                        $title = 'Mr';
                                    else if ($pax->title == 2)
                                        $title = 'Mrs';
                                    else if ($pax->title == 3)
                                        $title = 'Miss';
                                    else
                                        $title = 'Mstr';
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
                                        if ($pax->pass_no != '') {
                                            ?>
                                            <td>Passport No<br /><?php echo $pax->pass_no; ?></td>	
                                            <?php
                                        } else {
                                            ?>
                                            <td>&nbsp;</td>
                                            <?php
                                        }
                                        if ($pax->extra_baggage_onward != '') {
                                            $baggage = explode(';', $pax->extra_baggage_onward);
                                            $baggagePrice = ($baggagePrice + $baggage[1]);
                                            ?>
                                            <td>Onward Baggage<br /><?php echo $baggage[0] . 'Kg - PHP' . $baggage[1]; ?></td>
                                            <?php
                                        } else {
                                            ?>
                                            <td>&nbsp;</td>
                                            <?php
                                        }

                                        if ($pax->extra_baggage_return != '') {
                                            $baggageR = explode(';', $pax->extra_baggage_return);
                                            $baggagePrice = ($baggagePrice + $baggageR[1]);
                                            ?>
                                            <td>Return Baggage<br /><?php echo $baggageR[0] . 'Kg - PHP' . $baggageR[1]; ?></td>
                                            <?php
                                        } else {
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
                            </tbody>
                        </table>	
                        <br>
                    <!-- 	<style type="text/css">.via_pass_ticket_details td{border-bottom:1px solid #d0d0d0!important;}</style>
                        -->
                        <br>
                        <div style="padding:0px;margin-left:30px;margin-right:55px;" align="right">
                            <span style="font-size:15px;color:#000;">
                                Flight Fare: &nbsp; PHP <?php echo ($flightDetails->TotalFare); ?>
                            </span>
                            <hr>
                        </div>
                        <?php
                            if ($baggagePrice != 0) {
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
                                Total Price: &nbsp; PHP <?php echo ($flightDetails->TotalFare + $baggagePrice); ?>
                            </span>
                            <hr>
                        </div>
                        <br><br>
                        <div style=""><b><font>Please note:</font></b></div>
                        <!-- -->
                        <div style="" class="via_plz_note_div">
                            <ol style="list-style: none;">
                                <li><b>Please note your Airline PNR No. You can use this PNR no. for reference at any of the airline counters at the airport or airline offices at your city.</b></li>
                                <li><b>You can reach us through&nbsp; support@redtagtravels.com / (63) (02) 8012620 or Email Us.</b></li>
                            </ol>
                        </div>
                        <style>.via_plz_note_div ol li {list-style:none;line-height:1.5;font-size:11px;}</style>
                        <div style="height:1px;border-bottom:1px solid #ccc;">&nbsp;</div>
                        <table width="100%" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td style="padding-top:10px;width:85%;"></td>
                                    <td>
                                        <div align="right"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>