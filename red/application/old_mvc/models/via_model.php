<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Via_Model extends CI_Model {

    //private $url = 'http://testph.via.com/webserviceAPI?source=TEST&auth=test@!234&actionId='; ### Test URL

    private $url = 'http://ph.via.com/webserviceAPI?source=REDTAG&auth=redtag@123&actionId='; #### Live URL

    function getFlightAvailabilityOw($searchParms) {
        $request_id = 'RDT' . date('YmdHis');
        $xml = '<AirFareSearchRequest>
                    <RequestId>' . $request_id . '</RequestId>
                    <Route>
                      <Source>' . trim($searchParms['fromCode']) . '</Source>
                      <Destination>' . trim($searchParms['toCode']) . '</Destination>
                      <DateOfDeparture>' . trim($searchParms['sd']) . '</DateOfDeparture>
                    </Route>
                    <PassengerCount>
                      <Adults>' . trim($searchParms['adult']) . '</Adults>
                      <Children>' . trim($searchParms['child']) . '</Children>
                      <Infants>' . trim($searchParms['infant']) . '</Infants>
                     </PassengerCount>
                     <CabinPreference>
                        <SeatingClass>A</SeatingClass>
                    </CabinPreference>
                </AirFareSearchRequest>';
        //echo $xml;die;
        $url = $this->url . 'AirFareSearchRequest';
        //echo $url;die;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "xmlRequest=" . $xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        $response = curl_exec($ch);
        curl_close($ch);
//        echo $response;die;
        if ($response != '') {
            $res = new DOMDocument();
            $res->loadXML($response);
            if (trim($searchParms['fromCountry']) == 'Philippines' && trim($searchParms['toCountry']) == 'Philippines') {
                $data = $this->getOnewayDomFlights($res);
            } else {
                $data = $this->getOnewayIntlFlights($res);
            }
        } else {
            $data = '';
        }
        return $data;
    }

    function getOnewayDomFlights($res) {
        $viaData = '';
        $count = 0;
        $filters = array();
        if ($res->getElementsByTagName('AirFareSearchResponse')->length > 0) {
            if ($res->getElementsByTagName('PricedItineraries')->length > 0) {
                if ($res->getElementsByTagName('OnwardPricedItinerary')->length > 0) {
                    $i = 0;
                    $onwardFlights = $res->getElementsByTagName('OnwardPricedItinerary');
                    foreach ($onwardFlights as $flights) {
                        $viaData[$i]['RequestId'] = $res->getElementsByTagName('RequestId')->item(0)->nodeValue;
                        $viaData[$i]['Inbound']['duration'] = 0;
                        $viaData[$i]['id'] = $i;
                        $viaData[$i]['RequestId'] = $res->getElementsByTagName('RequestId')->item(0)->nodeValue;
                        $viaData[$i]['currency'] = $flights->getElementsByTagName('Pricing')->item(0)->getAttribute('currency');
                        $charges = $flights->getElementsByTagName('ServiceCharges');
                        $k = 0;
                        foreach ($charges as $charge) {
                            $viaData[$i]['Inbound']['fare'][$k]['type'] = $charge->getAttribute('type');
                            $viaData[$i]['Inbound']['fare'][$k]['ChargeType'] = $charge->getAttribute('ChargeType');
                            $viaData[$i]['Inbound']['fare'][$k]['price'] = $charge->nodeValue;
                            if ($charge->getAttribute('type') == 'SingleAdult' && $charge->getAttribute('ChargeType') == 'TotalAmount')
                                $viaData[$i]['Inbound']['adult_fare'] = $charge->nodeValue;
                            if ($charge->getAttribute('type') == 'SingleChild' && $charge->getAttribute('ChargeType') == 'TotalAmount')
                                $viaData[$i]['Inbound']['child_fare'] = $charge->nodeValue;
                            if ($charge->getAttribute('type') == 'SingleInfant' && $charge->getAttribute('ChargeType') == 'TotalAmount')
                                $viaData[$i]['Inbound']['infant_fare'] = $charge->nodeValue;

                            $k++;
                        }

                        $legs = $flights->getElementsByTagName('Flights')->item(0)->getElementsByTagName('Flight');
                        $stops = $flights->getElementsByTagName('Flights')->item(0)->getElementsByTagName('Flight')->length;
                        $viaData[$i]['Inbound']['stops'] = ($stops - 1);
                        $j = 0;
                        foreach ($legs as $leg) {
                            $viaData[$i]['Inbound']['legs'][$j]['Carrier_code'] = $leg->getElementsByTagName('Carrier')->item(0)->getAttribute('id');
                            $viaData[$i]['Inbound']['legs'][$j]['Carrier'] = $leg->getElementsByTagName('Carrier')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['FlightNumber'] = $leg->getElementsByTagName('FlightNumber')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['Source'] = $leg->getElementsByTagName('Source')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['Destination'] = $leg->getElementsByTagName('Destination')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['DepartureTimeStamp'] = $leg->getElementsByTagName('DepartureTimeStamp')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['ArrivalTimeStamp'] = $leg->getElementsByTagName('ArrivalTimeStamp')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['OperatingCarrier'] = $leg->getElementsByTagName('OperatingCarrier')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['Class'] = $leg->getElementsByTagName('Class')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['NumberOfStops'] = $leg->getElementsByTagName('NumberOfStops')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['FareBasis'] = $leg->getElementsByTagName('FareBasis')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['WarningText'] = $leg->getElementsByTagName('WarningText')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['TicketType'] = $leg->getElementsByTagName('TicketType')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['Refundable'] = $leg->getElementsByTagName('Refundable')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['FlyingTime'] = $leg->getElementsByTagName('FlyingTime')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['JourenyTime'] = $leg->getElementsByTagName('JourenyTime')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['DepartureTerminal'] = $leg->getElementsByTagName('DepartureTerminal')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['ArrivalTerminal'] = $leg->getElementsByTagName('ArrivalTerminal')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['SeatLeft'] = $leg->getElementsByTagName('SeatLeft')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['BaggageInfo'] = $leg->getElementsByTagName('BaggageInfo')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['MealInfo'] = $leg->getElementsByTagName('MealInfo')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['duration'] = ($viaData[$i]['Inbound']['duration'] + $leg->getElementsByTagName('JourenyTime')->item(0)->nodeValue);
                            $filters['airlines'][] = $viaData[$i]['Inbound']['legs'][$j]['Carrier'];
                            $filters['stops'][] = $viaData[$i]['Inbound']['legs'][$j]['NumberOfStops'];

                            $j++;
                        }
                        $i++;
                        $count = $count + 1;
                    }
                }
            }
        }
        $filters['count'] = $count;
        return array('via_data' => $viaData, 'filters' => $filters);
    }

    function getOnewayIntlFlights($res) {
        $viaData = '';
        $count = 1;
        $filters = array();
        if ($res->getElementsByTagName('AirFareSearchResponse')->length > 0) {
            if ($res->getElementsByTagName('PricedItineraries')->length > 0) {
                if ($res->getElementsByTagName('Flights')->length > 0) {
                    $i = 0;
                    foreach ($res->getElementsByTagName('PricedItineraries')->item(0)->childNodes as $flights) {
                        $viaData[$i]['RequestId'] = $res->getElementsByTagName('RequestId')->item(0)->nodeValue;
                        $viaData[$i]['Inbound']['duration'] = 0;
                        $viaData[$i]['id'] = $i;
                        $viaData[$i]['RequestId'] = $res->getElementsByTagName('RequestId')->item(0)->nodeValue;
                        $viaData[$i]['currency'] = $flights->getElementsByTagName('Pricing')->item(0)->getAttribute('currency');
                        $charges = $flights->getElementsByTagName('Pricing')->item(0)->getElementsByTagName('ServiceCharges');
                        $k = 0;
                        foreach ($charges as $charge) {
                            $viaData[$i]['Inbound']['fare'][$k]['type'] = $charge->getAttribute('type');
                            $viaData[$i]['Inbound']['fare'][$k]['ChargeType'] = $charge->getAttribute('ChargeType');
                            $viaData[$i]['Inbound']['fare'][$k]['price'] = $charge->nodeValue;
                            if ($charge->getAttribute('type') == 'SingleAdult' && $charge->getAttribute('ChargeType') == 'TotalAmount')
                                $viaData[$i]['Inbound']['adult_fare'] = $charge->nodeValue;
                            if ($charge->getAttribute('type') == 'SingleChild' && $charge->getAttribute('ChargeType') == 'TotalAmount')
                                $viaData[$i]['Inbound']['child_fare'] = $charge->nodeValue;
                            if ($charge->getAttribute('type') == 'SingleInfant' && $charge->getAttribute('ChargeType') == 'TotalAmount')
                                $viaData[$i]['Inbound']['infant_fare'] = $charge->nodeValue;

                            $k++;
                        }

                        $legs = $flights->getElementsByTagName('Flight');
                        $stops = $flights->getElementsByTagName('Flight')->length;
                        $viaData[$i]['Inbound']['stops'] = ($stops - 1);
                        $j = 0;
                        foreach ($legs as $leg) {
                            $viaData[$i]['Inbound']['legs'][$j]['Carrier_code'] = $leg->getElementsByTagName('Carrier')->item(0)->getAttribute('id');
                            $viaData[$i]['Inbound']['legs'][$j]['Carrier'] = $leg->getElementsByTagName('Carrier')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['FlightNumber'] = $leg->getElementsByTagName('FlightNumber')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['Source'] = $leg->getElementsByTagName('Source')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['Destination'] = $leg->getElementsByTagName('Destination')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['DepartureTimeStamp'] = $leg->getElementsByTagName('DepartureTimeStamp')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['ArrivalTimeStamp'] = $leg->getElementsByTagName('ArrivalTimeStamp')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['OperatingCarrier'] = $leg->getElementsByTagName('OperatingCarrier')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['Class'] = $leg->getElementsByTagName('Class')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['NumberOfStops'] = $leg->getElementsByTagName('NumberOfStops')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['FareBasis'] = $leg->getElementsByTagName('FareBasis')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['WarningText'] = $leg->getElementsByTagName('WarningText')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['TicketType'] = $leg->getElementsByTagName('TicketType')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['Refundable'] = $leg->getElementsByTagName('Refundable')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['FlyingTime'] = $leg->getElementsByTagName('FlyingTime')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['JourenyTime'] = $leg->getElementsByTagName('JourenyTime')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['DepartureTerminal'] = $leg->getElementsByTagName('DepartureTerminal')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['ArrivalTerminal'] = $leg->getElementsByTagName('ArrivalTerminal')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['SeatLeft'] = $leg->getElementsByTagName('SeatLeft')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['BaggageInfo'] = $leg->getElementsByTagName('BaggageInfo')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$j]['MealInfo'] = $leg->getElementsByTagName('MealInfo')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['duration'] = ($viaData[$i]['Inbound']['duration'] + $leg->getElementsByTagName('JourenyTime')->item(0)->nodeValue);
                            $filters['airlines'][] = $viaData[$i]['Inbound']['legs'][$j]['Carrier'];
                            $filters['stops'][] = $viaData[$i]['Inbound']['legs'][$j]['NumberOfStops'];

                            $j++;
                        }
                        $i++;
                        $count = $count + 1;
                    }
                }
            }
        }
        $filters['count'] = $count;
        return array('via_data' => $viaData, 'filters' => $filters);
    }

    function getFlightAvailabilityRt($searchParam) {
        $request_id = 'RDT' . date('YmdHis');
        $xml = '<AirFareSearchRequest>
                    <RequestId>' . $request_id . '</RequestId>
                    <Route>
                      <Source>' . trim($searchParam['fromCode']) . '</Source>
                      <Destination>' . trim($searchParam['toCode']) . '</Destination>
                      <DateOfDeparture>' . trim($searchParam['sd']) . '</DateOfDeparture>
                      <DateOfArrival>' . trim($searchParam['ed']) . '</DateOfArrival>
                    </Route>
                    <PassengerCount>
                      <Adults>' . trim($searchParam['adult']) . '</Adults>
                      <Children>' . trim($searchParam['child']) . '</Children>
                      <Infants>' . trim($searchParam['infant']) . '</Infants>
                     </PassengerCount>
                </AirFareSearchRequest>';
//echo $xml;die;
        $url = $this->url . 'AirFareSearchRequest';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "xmlRequest=" . $xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);

        $response = curl_exec($ch);
        curl_close($ch);
//        echo $response;die; 
        if ($response != '') {
            $res = new DOMDocument();
            $res->loadXML($response);
            if (trim($searchParam['fromCountry']) == 'Philippines' && trim($searchParam['toCountry']) == 'Philippines') {
                $data = $this->getRoundTripDomFlights($res);
            } else {
                $data = $this->getRoundTripIntlFlights($res);
            }
        } else {
            $data = '';
        }

        return $data;
    }

    function getRoundTripDomFlights($res) {
        $viaData = '';
        $count = 1;
        $filters = array();
        if ($res->getElementsByTagName('AirFareSearchResponse')->length > 0) {
            if ($res->getElementsByTagName('PricedItineraries')->length > 0) {
                if ($res->getElementsByTagName('OnwardPricedItinerary')->length > 0) {
                    $i = 0;
                    $onwardFlights = $res->getElementsByTagName('OnwardPricedItinerary');
                    $viaData['RequestId'] = $res->getElementsByTagName('RequestId')->item(0)->nodeValue;

                    foreach ($onwardFlights as $flights) {
                        $viaData['Inbound'][$i]['duration'] = 0;
                        $viaData['Inbound'][$i]['id'] = $i;
                        if ($i == 0) {
                            $viaData['currency'] = $flights->getElementsByTagName('Pricing')->item(0)->getAttribute('currency');
                        }
                        $charges = $flights->getElementsByTagName('ServiceCharges');
                        $k = 0;
                        foreach ($charges as $charge) {
                            $viaData['Inbound'][$i]['fare'][$k]['type'] = $charge->getAttribute('type');
                            $viaData['Inbound'][$i]['fare'][$k]['ChargeType'] = $charge->getAttribute('ChargeType');
                            $viaData['Inbound'][$i]['fare'][$k]['price'] = $charge->nodeValue;
                            if ($charge->getAttribute('type') == 'SingleAdult' && $charge->getAttribute('ChargeType') == 'TotalAmount')
                                $viaData['Inbound'][$i]['adult_fare'] = $charge->nodeValue;
                            if ($charge->getAttribute('type') == 'SingleChild' && $charge->getAttribute('ChargeType') == 'TotalAmount')
                                $viaData['Inbound'][$i]['child_fare'] = $charge->nodeValue;
                            if ($charge->getAttribute('type') == 'SingleInfant' && $charge->getAttribute('ChargeType') == 'TotalAmount')
                                $viaData['Inbound'][$i]['infant_fare'] = $charge->nodeValue;

                            $k++;
                        }

                        $legs = $flights->getElementsByTagName('Flights')->item(0)->getElementsByTagName('Flight');
                        $stops = $flights->getElementsByTagName('Flights')->item(0)->getElementsByTagName('Flight')->length;
                        $viaData['Inbound'][$i]['stops'] = ($stops - 1);
                        $j = 0;
                        foreach ($legs as $leg) {
                            $viaData['Inbound'][$i]['legs'][$j]['Carrier_code'] = $leg->getElementsByTagName('Carrier')->item(0)->getAttribute('id');
                            $viaData['Inbound'][$i]['legs'][$j]['Carrier'] = $leg->getElementsByTagName('Carrier')->item(0)->nodeValue;

                            $viaData['Inbound'][$i]['legs'][$j]['FlightNumber'] = $leg->getElementsByTagName('FlightNumber')->item(0)->nodeValue;
                            $viaData['Inbound'][$i]['legs'][$j]['Source'] = $leg->getElementsByTagName('Source')->item(0)->nodeValue;
                            $viaData['Inbound'][$i]['legs'][$j]['Destination'] = $leg->getElementsByTagName('Destination')->item(0)->nodeValue;
                            $viaData['Inbound'][$i]['legs'][$j]['DepartureTimeStamp'] = $leg->getElementsByTagName('DepartureTimeStamp')->item(0)->nodeValue;
                            $viaData['Inbound'][$i]['legs'][$j]['ArrivalTimeStamp'] = $leg->getElementsByTagName('ArrivalTimeStamp')->item(0)->nodeValue;
                            $viaData['Inbound'][$i]['legs'][$j]['OperatingCarrier'] = $leg->getElementsByTagName('OperatingCarrier')->item(0)->nodeValue;
                            $viaData['Inbound'][$i]['legs'][$j]['Class'] = $leg->getElementsByTagName('Class')->item(0)->nodeValue;
                            $viaData['Inbound'][$i]['legs'][$j]['NumberOfStops'] = $leg->getElementsByTagName('NumberOfStops')->item(0)->nodeValue;
                            $viaData['Inbound'][$i]['legs'][$j]['FareBasis'] = $leg->getElementsByTagName('FareBasis')->item(0)->nodeValue;
                            $viaData['Inbound'][$i]['legs'][$j]['WarningText'] = $leg->getElementsByTagName('WarningText')->item(0)->nodeValue;
                            $viaData['Inbound'][$i]['legs'][$j]['TicketType'] = $leg->getElementsByTagName('TicketType')->item(0)->nodeValue;
                            $viaData['Inbound'][$i]['legs'][$j]['Refundable'] = $leg->getElementsByTagName('Refundable')->item(0)->nodeValue;
                            $viaData['Inbound'][$i]['legs'][$j]['FlyingTime'] = $leg->getElementsByTagName('FlyingTime')->item(0)->nodeValue;
                            $viaData['Inbound'][$i]['legs'][$j]['JourenyTime'] = $leg->getElementsByTagName('JourenyTime')->item(0)->nodeValue;
                            $viaData['Inbound'][$i]['legs'][$j]['DepartureTerminal'] = $leg->getElementsByTagName('DepartureTerminal')->item(0)->nodeValue;
                            $viaData['Inbound'][$i]['legs'][$j]['ArrivalTerminal'] = $leg->getElementsByTagName('ArrivalTerminal')->item(0)->nodeValue;
                            $viaData['Inbound'][$i]['legs'][$j]['SeatLeft'] = $leg->getElementsByTagName('SeatLeft')->item(0)->nodeValue;
                            $viaData['Inbound'][$i]['legs'][$j]['BaggageInfo'] = $leg->getElementsByTagName('BaggageInfo')->item(0)->nodeValue;
                            $viaData['Inbound'][$i]['legs'][$j]['MealInfo'] = $leg->getElementsByTagName('MealInfo')->item(0)->nodeValue;

                            $viaData['Inbound'][$i]['duration'] = ($viaData['Inbound'][$i]['duration'] + $leg->getElementsByTagName('JourenyTime')->item(0)->nodeValue);

                            $filters['airlines'][] = $viaData['Inbound'][$i]['legs'][$j]['Carrier'];
                            $filters['stops'][] = $viaData['Inbound'][$i]['legs'][$j]['NumberOfStops'];

                            $j++;
                        }
                        $i++;
                        $count = $count + 1;
                    }
                }

                if ($res->getElementsByTagName('ReturnPricedItinerary')->length > 0) {
                    $i = 0;
                    $returnFlights = $res->getElementsByTagName('ReturnPricedItinerary');

                    foreach ($returnFlights as $flights) {
                        $viaData['Outbound'][$i]['duration'] = 0;
                        $viaData['Outbound'][$i]['id'] = $i;

                        $charges = $flights->getElementsByTagName('ServiceCharges');
                        $k = 0;
                        foreach ($charges as $charge) {
                            $viaData['Outbound'][$i]['fare'][$k]['type'] = $charge->getAttribute('type');
                            $viaData['Outbound'][$i]['fare'][$k]['ChargeType'] = $charge->getAttribute('ChargeType');
                            $viaData['Outbound'][$i]['fare'][$k]['price'] = $charge->nodeValue;
                            if ($charge->getAttribute('type') == 'SingleAdult' && $charge->getAttribute('ChargeType') == 'TotalAmount')
                                $viaData['Outbound'][$i]['adult_fare'] = $charge->nodeValue;
                            if ($charge->getAttribute('type') == 'SingleChild' && $charge->getAttribute('ChargeType') == 'TotalAmount')
                                $viaData['Outbound'][$i]['child_fare'] = $charge->nodeValue;
                            if ($charge->getAttribute('type') == 'SingleInfant' && $charge->getAttribute('ChargeType') == 'TotalAmount')
                                $viaData['Outbound'][$i]['infant_fare'] = $charge->nodeValue;

                            $k++;
                        }

                        $legs = $flights->getElementsByTagName('Flights')->item(0)->getElementsByTagName('Flight');
                        $stops = $flights->getElementsByTagName('Flights')->item(0)->getElementsByTagName('Flight')->length;
                        $viaData['Outbound'][$i]['stops'] = ($stops - 1);
                        $j = 0;
                        foreach ($legs as $leg) {
                            $viaData['Outbound'][$i]['legs'][$j]['Carrier_code'] = $leg->getElementsByTagName('Carrier')->item(0)->getAttribute('id');
                            $viaData['Outbound'][$i]['legs'][$j]['Carrier'] = $leg->getElementsByTagName('Carrier')->item(0)->nodeValue;

                            $viaData['Outbound'][$i]['legs'][$j]['FlightNumber'] = $leg->getElementsByTagName('FlightNumber')->item(0)->nodeValue;
                            $viaData['Outbound'][$i]['legs'][$j]['Source'] = $leg->getElementsByTagName('Source')->item(0)->nodeValue;
                            $viaData['Outbound'][$i]['legs'][$j]['Destination'] = $leg->getElementsByTagName('Destination')->item(0)->nodeValue;
                            $viaData['Outbound'][$i]['legs'][$j]['DepartureTimeStamp'] = $leg->getElementsByTagName('DepartureTimeStamp')->item(0)->nodeValue;
                            $viaData['Outbound'][$i]['legs'][$j]['ArrivalTimeStamp'] = $leg->getElementsByTagName('ArrivalTimeStamp')->item(0)->nodeValue;
                            $viaData['Outbound'][$i]['legs'][$j]['OperatingCarrier'] = $leg->getElementsByTagName('OperatingCarrier')->item(0)->nodeValue;
                            $viaData['Outbound'][$i]['legs'][$j]['Class'] = $leg->getElementsByTagName('Class')->item(0)->nodeValue;
                            $viaData['Outbound'][$i]['legs'][$j]['NumberOfStops'] = $leg->getElementsByTagName('NumberOfStops')->item(0)->nodeValue;
                            $viaData['Outbound'][$i]['legs'][$j]['FareBasis'] = $leg->getElementsByTagName('FareBasis')->item(0)->nodeValue;
                            $viaData['Outbound'][$i]['legs'][$j]['WarningText'] = $leg->getElementsByTagName('WarningText')->item(0)->nodeValue;
                            $viaData['Outbound'][$i]['legs'][$j]['TicketType'] = $leg->getElementsByTagName('TicketType')->item(0)->nodeValue;
                            $viaData['Outbound'][$i]['legs'][$j]['Refundable'] = $leg->getElementsByTagName('Refundable')->item(0)->nodeValue;
                            $viaData['Outbound'][$i]['legs'][$j]['FlyingTime'] = $leg->getElementsByTagName('FlyingTime')->item(0)->nodeValue;
                            $viaData['Outbound'][$i]['legs'][$j]['JourenyTime'] = $leg->getElementsByTagName('JourenyTime')->item(0)->nodeValue;
                            $viaData['Outbound'][$i]['legs'][$j]['DepartureTerminal'] = $leg->getElementsByTagName('DepartureTerminal')->item(0)->nodeValue;
                            $viaData['Outbound'][$i]['legs'][$j]['ArrivalTerminal'] = $leg->getElementsByTagName('ArrivalTerminal')->item(0)->nodeValue;
                            $viaData['Outbound'][$i]['legs'][$j]['SeatLeft'] = $leg->getElementsByTagName('SeatLeft')->item(0)->nodeValue;
                            $viaData['Outbound'][$i]['legs'][$j]['BaggageInfo'] = $leg->getElementsByTagName('BaggageInfo')->item(0)->nodeValue;
                            $viaData['Outbound'][$i]['legs'][$j]['MealInfo'] = $leg->getElementsByTagName('MealInfo')->item(0)->nodeValue;

                            $viaData['Outbound'][$i]['duration'] = ($viaData['Outbound'][$i]['duration'] + $leg->getElementsByTagName('JourenyTime')->item(0)->nodeValue);

                            $j++;
                        }
                        $i++;
                        $count = $count + 1;
                    }
                }
            }
        }
        $filters['count'] = $count;
        return array('via_data' => $viaData, 'filters' => $filters);
    }

    function getRoundTripIntlFlights($res) {
        $count = 1;
        $filters = array();
        $viaData = '';
        if ($res->getElementsByTagName('AirFareSearchResponse')->length > 0) {
            if ($res->getElementsByTagName('PricedItineraries')->length > 0) {
                if ($res->getElementsByTagName('Flights')->length > 0) {
                    $i = 0;
                    foreach ($res->getElementsByTagName('PricedItineraries')->item(0)->childNodes as $flights) {
                        $viaData[$i]['Inbound']['duration'] = 0;
                        $viaData[$i]['id'] = $i;
                        $viaData[$i]['RequestId'] = $res->getElementsByTagName('RequestId')->item(0)->nodeValue;
                        $viaData[$i]['currency'] = $flights->getElementsByTagName('Pricing')->item(0)->getAttribute('currency');
                        $charges = $flights->getElementsByTagName('ServiceCharges');
                        $c = 0;
                        foreach ($charges as $charge) {
                            $viaData[$i]['Inbound']['fare'][$c]['type'] = $charge->getAttribute('type');
                            $viaData[$i]['Inbound']['fare'][$c]['ChargeType'] = $charge->getAttribute('ChargeType');
                            $viaData[$i]['Inbound']['fare'][$c]['price'] = $charge->nodeValue;
                            if ($charge->getAttribute('type') == 'SingleAdult' && $charge->getAttribute('ChargeType') == 'TotalAmount')
                                $viaData[$i]['Inbound']['adult_fare'] = $charge->nodeValue;
                            if ($charge->getAttribute('type') == 'SingleChild' && $charge->getAttribute('ChargeType') == 'TotalAmount')
                                $viaData[$i]['Inbound']['child_fare'] = $charge->nodeValue;
                            if ($charge->getAttribute('type') == 'SingleInfant' && $charge->getAttribute('ChargeType') == 'TotalAmount')
                                $viaData[$i]['Inbound']['infant_fare'] = $charge->nodeValue;

                            $c++;
                        }
                        $legs_one = $flights->getElementsByTagName('OnwardPricedItinerary')->item(0)->getElementsByTagName('Flight');
                        $stops_one = $flights->getElementsByTagName('OnwardPricedItinerary')->item(0)->getElementsByTagName('Flight')->length;
                        $viaData[$i]['Inbound']['stops'] = ($stops_one - 1);
                        $k = 0;
                        foreach ($legs_one as $leg_one) {
                            $viaData[$i]['Inbound']['legs'][$k]['Carrier_code'] = $leg_one->getElementsByTagName('Carrier')->item(0)->getAttribute('id');
                            $viaData[$i]['Inbound']['legs'][$k]['Carrier'] = $leg_one->getElementsByTagName('Carrier')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$k]['FlightNumber'] = $leg_one->getElementsByTagName('FlightNumber')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$k]['Source'] = $leg_one->getElementsByTagName('Source')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$k]['Destination'] = $leg_one->getElementsByTagName('Destination')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$k]['DepartureTimeStamp'] = $leg_one->getElementsByTagName('DepartureTimeStamp')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$k]['ArrivalTimeStamp'] = $leg_one->getElementsByTagName('ArrivalTimeStamp')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$k]['OperatingCarrier'] = $leg_one->getElementsByTagName('OperatingCarrier')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$k]['Class'] = $leg_one->getElementsByTagName('Class')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$k]['NumberOfStops'] = $leg_one->getElementsByTagName('NumberOfStops')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$k]['FareBasis'] = $leg_one->getElementsByTagName('FareBasis')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$k]['WarningText'] = $leg_one->getElementsByTagName('WarningText')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$k]['TicketType'] = $leg_one->getElementsByTagName('TicketType')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$k]['Refundable'] = $leg_one->getElementsByTagName('Refundable')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$k]['FlyingTime'] = $leg_one->getElementsByTagName('FlyingTime')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$k]['JourenyTime'] = $leg_one->getElementsByTagName('JourenyTime')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$k]['DepartureTerminal'] = $leg_one->getElementsByTagName('DepartureTerminal')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$k]['ArrivalTerminal'] = $leg_one->getElementsByTagName('ArrivalTerminal')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$k]['SeatLeft'] = $leg_one->getElementsByTagName('SeatLeft')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$k]['BaggageInfo'] = $leg_one->getElementsByTagName('BaggageInfo')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['legs'][$k]['MealInfo'] = $leg_one->getElementsByTagName('MealInfo')->item(0)->nodeValue;
                            $viaData[$i]['Inbound']['duration'] = ($viaData[$i]['Inbound']['duration'] + $leg_one->getElementsByTagName('JourenyTime')->item(0)->nodeValue);
                            $filters['airlines'][] = $viaData[$i]['Inbound']['legs'][$k]['Carrier'];
                            $filters['stops'][] = $viaData[$i]['Inbound']['legs'][$k]['NumberOfStops'];
                            $k++;
                        }
                        ####################### RETURN FLIGHT DATA ###############################################
                        $legs = $flights->getElementsByTagName('ReturnPricedItinerary')->item(0)->getElementsByTagName('Flight');
                        $stops = $flights->getElementsByTagName('ReturnPricedItinerary')->item(0)->getElementsByTagName('Flight')->length;
                        $viaData[$i]['Outbound']['stops'] = ($stops - 1);
                        $viaData[$i]['Outbound']['duration'] = 0;
                        $j = 0;
                        foreach ($legs as $leg) {
                            $viaData[$i]['Outbound']['legs'][$j]['Carrier_code'] = $leg->getElementsByTagName('Carrier')->item(0)->getAttribute('id');
                            $viaData[$i]['Outbound']['legs'][$j]['Carrier'] = $leg->getElementsByTagName('Carrier')->item(0)->nodeValue;
                            $viaData[$i]['Outbound']['legs'][$j]['FlightNumber'] = $leg->getElementsByTagName('FlightNumber')->item(0)->nodeValue;
                            $viaData[$i]['Outbound']['legs'][$j]['Source'] = $leg->getElementsByTagName('Source')->item(0)->nodeValue;
                            $viaData[$i]['Outbound']['legs'][$j]['Destination'] = $leg->getElementsByTagName('Destination')->item(0)->nodeValue;
                            $viaData[$i]['Outbound']['legs'][$j]['DepartureTimeStamp'] = $leg->getElementsByTagName('DepartureTimeStamp')->item(0)->nodeValue;
                            $viaData[$i]['Outbound']['legs'][$j]['ArrivalTimeStamp'] = $leg->getElementsByTagName('ArrivalTimeStamp')->item(0)->nodeValue;
                            $viaData[$i]['Outbound']['legs'][$j]['OperatingCarrier'] = $leg->getElementsByTagName('OperatingCarrier')->item(0)->nodeValue;
                            $viaData[$i]['Outbound']['legs'][$j]['Class'] = $leg->getElementsByTagName('Class')->item(0)->nodeValue;
                            $viaData[$i]['Outbound']['legs'][$j]['NumberOfStops'] = $leg->getElementsByTagName('NumberOfStops')->item(0)->nodeValue;
                            $viaData[$i]['Outbound']['legs'][$j]['FareBasis'] = $leg->getElementsByTagName('FareBasis')->item(0)->nodeValue;
                            $viaData[$i]['Outbound']['legs'][$j]['WarningText'] = $leg->getElementsByTagName('WarningText')->item(0)->nodeValue;
                            $viaData[$i]['Outbound']['legs'][$j]['TicketType'] = $leg->getElementsByTagName('TicketType')->item(0)->nodeValue;
                            $viaData[$i]['Outbound']['legs'][$j]['Refundable'] = $leg->getElementsByTagName('Refundable')->item(0)->nodeValue;
                            $viaData[$i]['Outbound']['legs'][$j]['FlyingTime'] = $leg->getElementsByTagName('FlyingTime')->item(0)->nodeValue;
                            $viaData[$i]['Outbound']['legs'][$j]['JourenyTime'] = $leg->getElementsByTagName('JourenyTime')->item(0)->nodeValue;
                            $viaData[$i]['Outbound']['legs'][$j]['DepartureTerminal'] = $leg->getElementsByTagName('DepartureTerminal')->item(0)->nodeValue;
                            $viaData[$i]['Outbound']['legs'][$j]['ArrivalTerminal'] = $leg->getElementsByTagName('ArrivalTerminal')->item(0)->nodeValue;
                            $viaData[$i]['Outbound']['legs'][$j]['SeatLeft'] = $leg->getElementsByTagName('SeatLeft')->item(0)->nodeValue;
                            $viaData[$i]['Outbound']['legs'][$j]['BaggageInfo'] = $leg->getElementsByTagName('BaggageInfo')->item(0)->nodeValue;
                            $viaData[$i]['Outbound']['legs'][$j]['MealInfo'] = $leg->getElementsByTagName('MealInfo')->item(0)->nodeValue;
                            $viaData[$i]['Outbound']['duration'] = ($viaData[$i]['Outbound']['duration'] + $leg->getElementsByTagName('JourenyTime')->item(0)->nodeValue);
                            $j++;
                        }
                        $i++;
                        $count = $count + 1;
                    }
                }
            }
        }
        //echo '<pre />';print_r($viaData);die;
        $filters['count'] = $count;
        return array('via_data' => $viaData, 'filters' => $filters);
    }

    function flightDetails($onward, $return = '', $requestId = '', $searchData, $admin_markup) {
        $booking_final_data = '';
        $mid = '';
        $mark = 0;
        if ($searchData['journey_type'] == 'one_way') {
            $request = $requestId;
            $flCode = $onward['Inbound']['legs'][0]['Carrier_code'];
            foreach ($onward['Inbound']['legs'] as $leg) {
                $mid .= '<OnwardFlights>
                            <Flight>
                              <CarrierId>' . $leg['Carrier_code'] . '</CarrierId>
                              <FlightNumber>' . $leg['FlightNumber'] . '</FlightNumber>
                              <Source>' . $leg['Source'] . '</Source>
                              <Destination>' . $leg['Destination'] . '</Destination>
                              <DepartureTimeStamp>' . $leg['DepartureTimeStamp'] . '</DepartureTimeStamp>
                              <ArrivalTimeStamp>' . $leg['ArrivalTimeStamp'] . '</ArrivalTimeStamp>
                              <Class>' . $leg['Class'] . '</Class>
                              <FareBasis>' . $leg['FareBasis'] . '</FareBasis>
                            </Flight>
                        </OnwardFlights>';
            }
        } else {
            $request = $requestId;
            $flCode = $onward['legs'][0]['Carrier_code'];
            $flCodeR = $return['legs'][0]['Carrier_code'];
            foreach ($onward['legs'] as $leg) {
                $mid .= '<OnwardFlights>
                            <Flight>
                              <CarrierId>' . $leg['Carrier_code'] . '</CarrierId>
                              <FlightNumber>' . $leg['FlightNumber'] . '</FlightNumber>
                              <Source>' . $leg['Source'] . '</Source>
                              <Destination>' . $leg['Destination'] . '</Destination>
                              <DepartureTimeStamp>' . $leg['DepartureTimeStamp'] . '</DepartureTimeStamp>
                              <ArrivalTimeStamp>' . $leg['ArrivalTimeStamp'] . '</ArrivalTimeStamp>
                              <Class>' . $leg['Class'] . '</Class>
                              <FareBasis>' . $leg['FareBasis'] . '</FareBasis>
                            </Flight>
                        </OnwardFlights>';
            }
            foreach ($return['legs'] as $leg) {
                $mid .= '<ReturnFlights>
                            <Flight>
                              <CarrierId>' . $leg['Carrier_code'] . '</CarrierId>
                              <FlightNumber>' . $leg['FlightNumber'] . '</FlightNumber>
                              <Source>' . $leg['Source'] . '</Source>
                              <Destination>' . $leg['Destination'] . '</Destination>
                              <DepartureTimeStamp>' . $leg['DepartureTimeStamp'] . '</DepartureTimeStamp>
                              <ArrivalTimeStamp>' . $leg['ArrivalTimeStamp'] . '</ArrivalTimeStamp>
                              <Class>' . $leg['Class'] . '</Class>
                              <FareBasis>' . $leg['FareBasis'] . '</FareBasis>
                            </Flight>
                        </ReturnFlights>';
            }
        }

        $xml = '<AirPriceRequest>
                    <RequestId>' . $request . '</RequestId>
                     <Itinerary>
                        ' . $mid . '
                    </Itinerary>
                    <PassengerCount>
                      <Adults>' . $searchData['adult'] . '</Adults>
                      <Children>' . $searchData['child'] . '</Children>
                      <Infants>' . $searchData['infant'] . '</Infants>
                    </PassengerCount>
                </AirPriceRequest>';
//        echo $xml;die;
        $url = $this->url . 'AirPriceRequest';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "xmlRequest=" . $xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        $response = curl_exec($ch);
        curl_close($ch);
//        echo $response;die; 
        $res = new DOMDocument();
        $res->loadXML($response);
        if ($res->getElementsByTagName('Error')->length > 0) {
            $booking_final_data = '';
        } else {
            if ($searchData['journey_type'] == 'one_way') {
                if ($res->getElementsByTagName('AirPriceResponse')->length > 0) {
                    $booking_final_data['isBlockingAllowed'] = $res->getElementsByTagName('isBlockingAllowed')->item(0)->nodeValue;
                    $booking_final_data['OperatingCarrier'] = $res->getElementsByTagName('OperatingCarrier')->item(0)->nodeValue;

                    if ($res->getElementsByTagName('PricedItinerary')->length > 0) {
                        $flights = $res->getElementsByTagName('PricedItinerary');
                        $onwardFlights = $res->getElementsByTagName('OnwardFlights');
                        $charges = $flights->item(0)->getElementsByTagName('Pricing')->item(0)->getElementsByTagName('ServiceCharges');
                        $tot = $flights->item(0)->getElementsByTagName('Pricing')->item(0)->getElementsByTagName('TotalAmount')->item(0)->nodeValue;
                        $booking_final_data['TotalAmount_org'] = ($tot);
                        
                        if (array_key_exists($flCode, $admin_markup)) {
                            if ($admin_markup['type'] == 'fixed') {
                                $mark = $admin_markup[$flCode];
                                $tot = ($tot + $mark);
                            } else {
                                $mark = (($admin_markup[$flCode] / 100) * $tot);
                                $tot = $tot + $mark;
                            }
                        } else {
                            $mark = 0;
                        }
                        $booking_final_data['TotalAmount'] = ($tot);
                        
                        $k = 0;
                        foreach ($charges as $charge) {
                            $booking_final_data['fare'][$k]['type'] = $charge->getAttribute('type');
                            $booking_final_data['fare'][$k]['ChargeType'] = $charge->getAttribute('ChargeType');
                            if ($k == 0) {
                                $booking_final_data['fare'][$k]['price'] = ($charge->nodeValue + $mark);
                            } else {
                                $booking_final_data['fare'][$k]['price'] = $charge->nodeValue;
                            }
                            $k++;
                        }

                        $legs = $onwardFlights->item(0)->getElementsByTagName('Flight');
                        $j = 0;
                        foreach ($legs as $leg) {
                            $booking_final_data['Inbound']['legs'][$j]['Carrier_code'] = $leg->getElementsByTagName('Carrier')->item(0)->getAttribute('id');
                            $booking_final_data['Inbound']['legs'][$j]['Carrier'] = $leg->getElementsByTagName('Carrier')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['FlightNumber'] = $leg->getElementsByTagName('FlightNumber')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['Source'] = $leg->getElementsByTagName('Source')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['Destination'] = $leg->getElementsByTagName('Destination')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['DepartureTimeStamp'] = $leg->getElementsByTagName('DepartureTimeStamp')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['ArrivalTimeStamp'] = $leg->getElementsByTagName('ArrivalTimeStamp')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['Class'] = $leg->getElementsByTagName('Class')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['FareBasis'] = $leg->getElementsByTagName('FareBasis')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['WarningText'] = $leg->getElementsByTagName('WarningText')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['TicketType'] = $leg->getElementsByTagName('TicketType')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['Refundable'] = $leg->getElementsByTagName('Refundable')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['SeatLeft'] = $leg->getElementsByTagName('SeatLeft')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['BaggageInfo'] = $leg->getElementsByTagName('BaggageInfo')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['MealInfo'] = $leg->getElementsByTagName('MealInfo')->item(0)->nodeValue;

                            $j++;
                        }

                        if ($onwardFlights->item(0)->getElementsByTagName('SinglePassengerBaggageOptions')->length > 0) {
                            $baggages = $onwardFlights->item(0)->getElementsByTagName('SinglePassengerBaggageOptions')->item(0)->getElementsByTagName('option');
                            $m = 0;
                            foreach ($baggages as $baggage) {
                                $booking_final_data['Inbound']['baggage'][$m]['size'] = $baggage->getAttribute('size');
                                $booking_final_data['Inbound']['baggage'][$m]['price'] = $baggage->getAttribute('price');
                                $m++;
                            }
                        }
                    }
                    //echo '<pre />';print_r($booking_final_data);die;
                }
            } else {
                if ($res->getElementsByTagName('AirPriceResponse')->length > 0) {
                    $booking_final_data['isBlockingAllowed'] = $res->getElementsByTagName('isBlockingAllowed')->item(0)->nodeValue;
                    $booking_final_data['OperatingCarrier'] = $res->getElementsByTagName('OperatingCarrier')->item(0)->nodeValue;

                    if ($res->getElementsByTagName('PricedItinerary')->length > 0) {
                        $flights = $res->getElementsByTagName('PricedItinerary');
                        $onwardFlights = $res->getElementsByTagName('OnwardFlights');
                        $returnFlights = $res->getElementsByTagName('ReturnFlights');
                        $charges = $flights->item(0)->getElementsByTagName('Pricing')->item(0)->getElementsByTagName('ServiceCharges');
                        $tot = $flights->item(0)->getElementsByTagName('Pricing')->item(0)->getElementsByTagName('TotalAmount')->item(0)->nodeValue;
                        $booking_final_data['TotalAmount_org'] = ($tot);
                        
                        if (array_key_exists($flCode, $admin_markup)) {
                            if ($admin_markup['type'] == 'fixed') {
                                $markOn = ($admin_markup[$flCode]/2);
                                $markRt = ($admin_markup[$flCodeR]/2);
                                $mark = ($markOn+$markRt);
                                $tot = ($tot + $mark);
                            } else {
                                $markOn = ((($admin_markup[$flCode] / 100) * $tot)/2);
                                $markRt = ((($admin_markup[$flCodeR] / 100) * $tot)/2);
                                $mark = ($markOn+$markRt);
                                $tot = $tot + $mark;
                            }
                        } else {
                            $mark = 0;
                        }
                        $booking_final_data['TotalAmount'] = ($tot);
                        $k = 0;
                        foreach ($charges as $charge) {
                            $booking_final_data['fare'][$k]['type'] = $charge->getAttribute('type');
                            $booking_final_data['fare'][$k]['ChargeType'] = $charge->getAttribute('ChargeType');
                            if ($k == 0 && $booking_final_data['fare'][$k]['ChargeType'] != 'totalAmount') {
                                $booking_final_data['fare'][$k]['price'] = ($charge->nodeValue + $mark);
                            } else if($booking_final_data['fare'][$k]['ChargeType'] == 'totalAmount'){
                                $booking_final_data['fare'][$k]['price'] = ($charge->nodeValue+$mark);
                            } else {
                                $booking_final_data['fare'][$k]['price'] = $charge->nodeValue;
                            }
                            $k++;
                        }

                        $legs = $onwardFlights->item(0)->getElementsByTagName('Flight');
                        $j = 0;
                        foreach ($legs as $leg) {
                            $booking_final_data['Inbound']['legs'][$j]['Carrier_code'] = $leg->getElementsByTagName('Carrier')->item(0)->getAttribute('id');
                            $booking_final_data['Inbound']['legs'][$j]['Carrier'] = $leg->getElementsByTagName('Carrier')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['FlightNumber'] = $leg->getElementsByTagName('FlightNumber')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['Source'] = $leg->getElementsByTagName('Source')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['Destination'] = $leg->getElementsByTagName('Destination')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['DepartureTimeStamp'] = $leg->getElementsByTagName('DepartureTimeStamp')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['ArrivalTimeStamp'] = $leg->getElementsByTagName('ArrivalTimeStamp')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['Class'] = $leg->getElementsByTagName('Class')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['FareBasis'] = $leg->getElementsByTagName('FareBasis')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['WarningText'] = $leg->getElementsByTagName('WarningText')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['TicketType'] = $leg->getElementsByTagName('TicketType')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['Refundable'] = $leg->getElementsByTagName('Refundable')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['SeatLeft'] = $leg->getElementsByTagName('SeatLeft')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['BaggageInfo'] = $leg->getElementsByTagName('BaggageInfo')->item(0)->nodeValue;
                            $booking_final_data['Inbound']['legs'][$j]['MealInfo'] = $leg->getElementsByTagName('MealInfo')->item(0)->nodeValue;

                            $j++;
                        }

                        $baggages = $onwardFlights->item(0)->getElementsByTagName('SinglePassengerBaggageOptions')->item(0)->getElementsByTagName('option');
                        $m = 0;
                        foreach ($baggages as $baggage) {
                            $booking_final_data['Inbound']['baggage'][$m]['size'] = $baggage->getAttribute('size');
                            $booking_final_data['Inbound']['baggage'][$m]['price'] = $baggage->getAttribute('price');
                            $m++;
                        }

                        $legs = $returnFlights->item(0)->getElementsByTagName('Flight');
                        $j = 0;
                        foreach ($legs as $leg) {
                            $booking_final_data['Outbound']['legs'][$j]['Carrier_code'] = $leg->getElementsByTagName('Carrier')->item(0)->getAttribute('id');
                            $booking_final_data['Outbound']['legs'][$j]['Carrier'] = $leg->getElementsByTagName('Carrier')->item(0)->nodeValue;
                            $booking_final_data['Outbound']['legs'][$j]['FlightNumber'] = $leg->getElementsByTagName('FlightNumber')->item(0)->nodeValue;
                            $booking_final_data['Outbound']['legs'][$j]['Source'] = $leg->getElementsByTagName('Source')->item(0)->nodeValue;
                            $booking_final_data['Outbound']['legs'][$j]['Destination'] = $leg->getElementsByTagName('Destination')->item(0)->nodeValue;
                            $booking_final_data['Outbound']['legs'][$j]['DepartureTimeStamp'] = $leg->getElementsByTagName('DepartureTimeStamp')->item(0)->nodeValue;
                            $booking_final_data['Outbound']['legs'][$j]['ArrivalTimeStamp'] = $leg->getElementsByTagName('ArrivalTimeStamp')->item(0)->nodeValue;
                            $booking_final_data['Outbound']['legs'][$j]['Class'] = $leg->getElementsByTagName('Class')->item(0)->nodeValue;
                            $booking_final_data['Outbound']['legs'][$j]['FareBasis'] = $leg->getElementsByTagName('FareBasis')->item(0)->nodeValue;
                            $booking_final_data['Outbound']['legs'][$j]['WarningText'] = $leg->getElementsByTagName('WarningText')->item(0)->nodeValue;
                            $booking_final_data['Outbound']['legs'][$j]['TicketType'] = $leg->getElementsByTagName('TicketType')->item(0)->nodeValue;
                            $booking_final_data['Outbound']['legs'][$j]['Refundable'] = $leg->getElementsByTagName('Refundable')->item(0)->nodeValue;
                            $booking_final_data['Outbound']['legs'][$j]['SeatLeft'] = $leg->getElementsByTagName('SeatLeft')->item(0)->nodeValue;
                            $booking_final_data['Outbound']['legs'][$j]['BaggageInfo'] = $leg->getElementsByTagName('BaggageInfo')->item(0)->nodeValue;
                            $booking_final_data['Outbound']['legs'][$j]['MealInfo'] = $leg->getElementsByTagName('MealInfo')->item(0)->nodeValue;

                            $j++;
                        }

                        $baggages = $returnFlights->item(0)->getElementsByTagName('SinglePassengerBaggageOptions')->item(0)->getElementsByTagName('option');
                        $m = 0;
                        foreach ($baggages as $baggage) {
                            $booking_final_data['Outbound']['baggage'][$m]['size'] = $baggage->getAttribute('size');
                            $booking_final_data['Outbound']['baggage'][$m]['price'] = $baggage->getAttribute('price');
                            $m++;
                        }
                    }
                    //echo '<pre />';print_r($booking_final_data);die;
                }
            }
        }
        //echo $mark;die;
        return array('booking_final_data' => $booking_final_data, 'admin_markup' => $mark);
    }

    function flightDetailsIntl($onward, $return = '', $requestId = '', $searchData, $admin_markup) {
        $booking_final_data = '';
        $mid = '';
        $mark = 0;
        $request = $requestId;
        foreach ($onward['Inbound']['legs'] as $leg) {
            $mid .= '<OnwardFlights>
                        <Flight>
                          <CarrierId>' . $leg['Carrier_code'] . '</CarrierId>
                          <FlightNumber>' . $leg['FlightNumber'] . '</FlightNumber>
                          <Source>' . $leg['Source'] . '</Source>
                          <Destination>' . $leg['Destination'] . '</Destination>
                          <DepartureTimeStamp>' . $leg['DepartureTimeStamp'] . '</DepartureTimeStamp>
                          <ArrivalTimeStamp>' . $leg['ArrivalTimeStamp'] . '</ArrivalTimeStamp>
                          <Class>' . $leg['Class'] . '</Class>
                          <FareBasis>' . $leg['FareBasis'] . '</FareBasis>
                        </Flight>
                    </OnwardFlights>';
        }
        foreach ($onward['Inbound']['legs'] as $leg) {
            $mid .= '<ReturnFlights>
                        <Flight>
                          <CarrierId>' . $leg['Carrier_code'] . '</CarrierId>
                          <FlightNumber>' . $leg['FlightNumber'] . '</FlightNumber>
                          <Source>' . $leg['Source'] . '</Source>
                          <Destination>' . $leg['Destination'] . '</Destination>
                          <DepartureTimeStamp>' . $leg['DepartureTimeStamp'] . '</DepartureTimeStamp>
                          <ArrivalTimeStamp>' . $leg['ArrivalTimeStamp'] . '</ArrivalTimeStamp>
                          <Class>' . $leg['Class'] . '</Class>
                          <FareBasis>' . $leg['FareBasis'] . '</FareBasis>
                        </Flight>
                    </ReturnFlights>';
        }
        $xml = '<AirPriceRequest>
                    <RequestId>' . $request . '</RequestId>
                     <Itinerary>
                        ' . $mid . '
                    </Itinerary>
                    <PassengerCount>
                      <Adults>' . $searchData['adult'] . '</Adults>
                      <Children>' . $searchData['child'] . '</Children>
                      <Infants>' . $searchData['infant'] . '</Infants>
                    </PassengerCount>
                </AirPriceRequest>';

        //echo $xml;die;
        $url = $this->url . 'AirPriceRequest';

        //setting the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // Following line is compulsary to add as it is:
        curl_setopt($ch, CURLOPT_POSTFIELDS, "xmlRequest=" . $xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        //echo $response;die; 
        $res = new DOMDocument();
        $res->loadXML($response);

        if($res->getElementsByTagName('Error')->length > 0){
            $booking_final_data = '';
            $mark = 0;
        } else {
            if ($res->getElementsByTagName('AirPriceResponse')->length > 0) {
            $booking_final_data['isBlockingAllowed'] = $res->getElementsByTagName('isBlockingAllowed')->item(0)->nodeValue;
            $booking_final_data['OperatingCarrier'] = $res->getElementsByTagName('OperatingCarrier')->item(0)->nodeValue;

            if ($res->getElementsByTagName('PricedItinerary')->length > 0) {
                $flights = $res->getElementsByTagName('PricedItinerary');
                $onwardFlights = $res->getElementsByTagName('OnwardFlights');
                $returnFlights = $res->getElementsByTagName('ReturnFlights');
                $charges = $flights->item(0)->getElementsByTagName('Pricing')->item(0)->getElementsByTagName('ServiceCharges');

                $tot = $flights->item(0)->getElementsByTagName('Pricing')->item(0)->getElementsByTagName('TotalAmount')->item(0)->nodeValue;
                $booking_final_data['TotalAmount_org'] = $tot;
                if ($admin_markup['type'] == 'fixed') {
                    $mark = $admin_markup['international'];
                    $tot = ($tot + $admin_markup['international']);
                } else {
                    $mark = (($admin_markup['international'] / 100) * $tot);
                    $tot = $tot + $mark;
                }
                $booking_final_data['TotalAmount'] = $tot;
                $k = 0;
                foreach ($charges as $charge) {
                    $booking_final_data['fare'][$k]['type'] = $charge->getAttribute('type');
                    $booking_final_data['fare'][$k]['ChargeType'] = $charge->getAttribute('ChargeType');
                    if ($k == 0 && $booking_final_data['fare'][$k]['ChargeType'] != 'totalAmount') {
                        $booking_final_data['fare'][$k]['price'] = ($charge->nodeValue + $mark);
                    } else if($booking_final_data['fare'][$k]['ChargeType'] == 'totalAmount'){
                        $booking_final_data['fare'][$k]['price'] = ($charge->nodeValue + $mark);
                    } else {
                        $booking_final_data['fare'][$k]['price'] = $charge->nodeValue;
                    }
                    $k++;
                }

                $legs = $onwardFlights->item(0)->getElementsByTagName('Flight');
                $j = 0;
                foreach ($legs as $leg) {
                    $booking_final_data['Inbound']['legs'][$j]['Carrier_code'] = $leg->getElementsByTagName('Carrier')->item(0)->getAttribute('id');
                    $booking_final_data['Inbound']['legs'][$j]['Carrier'] = $leg->getElementsByTagName('Carrier')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['FlightNumber'] = $leg->getElementsByTagName('FlightNumber')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['Source'] = $leg->getElementsByTagName('Source')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['Destination'] = $leg->getElementsByTagName('Destination')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['DepartureTimeStamp'] = $leg->getElementsByTagName('DepartureTimeStamp')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['ArrivalTimeStamp'] = $leg->getElementsByTagName('ArrivalTimeStamp')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['Class'] = $leg->getElementsByTagName('Class')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['FareBasis'] = $leg->getElementsByTagName('FareBasis')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['WarningText'] = $leg->getElementsByTagName('WarningText')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['TicketType'] = $leg->getElementsByTagName('TicketType')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['Refundable'] = $leg->getElementsByTagName('Refundable')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['SeatLeft'] = $leg->getElementsByTagName('SeatLeft')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['BaggageInfo'] = $leg->getElementsByTagName('BaggageInfo')->item(0)->nodeValue;
                    $booking_final_data['Inbound']['legs'][$j]['MealInfo'] = $leg->getElementsByTagName('MealInfo')->item(0)->nodeValue;

                    $j++;
                }

                if ($onwardFlights->item(0)->getElementsByTagName('SinglePassengerBaggageOptions')->length > 0) {
                    $baggages = $onwardFlights->item(0)->getElementsByTagName('SinglePassengerBaggageOptions')->item(0)->getElementsByTagName('option');
                    $m = 0;
                    foreach ($baggages as $baggage) {
                        $booking_final_data['Inbound']['baggage'][$m]['size'] = $baggage->getAttribute('size');
                        $booking_final_data['Inbound']['baggage'][$m]['price'] = $baggage->getAttribute('price');
                        $m++;
                    }
                }


                $legs = $returnFlights->item(0)->getElementsByTagName('Flight');
                $j = 0;
                foreach ($legs as $leg) {
                    $booking_final_data['Outbound']['legs'][$j]['Carrier_code'] = $leg->getElementsByTagName('Carrier')->item(0)->getAttribute('id');
                    $booking_final_data['Outbound']['legs'][$j]['Carrier'] = $leg->getElementsByTagName('Carrier')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['FlightNumber'] = $leg->getElementsByTagName('FlightNumber')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['Source'] = $leg->getElementsByTagName('Source')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['Destination'] = $leg->getElementsByTagName('Destination')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['DepartureTimeStamp'] = $leg->getElementsByTagName('DepartureTimeStamp')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['ArrivalTimeStamp'] = $leg->getElementsByTagName('ArrivalTimeStamp')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['Class'] = $leg->getElementsByTagName('Class')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['FareBasis'] = $leg->getElementsByTagName('FareBasis')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['WarningText'] = $leg->getElementsByTagName('WarningText')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['TicketType'] = $leg->getElementsByTagName('TicketType')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['Refundable'] = $leg->getElementsByTagName('Refundable')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['SeatLeft'] = $leg->getElementsByTagName('SeatLeft')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['BaggageInfo'] = $leg->getElementsByTagName('BaggageInfo')->item(0)->nodeValue;
                    $booking_final_data['Outbound']['legs'][$j]['MealInfo'] = $leg->getElementsByTagName('MealInfo')->item(0)->nodeValue;

                    $j++;
                }

                if ($returnFlights->item(0)->getElementsByTagName('SinglePassengerBaggageOptions')->length > 0) {
                    $baggages = $returnFlights->item(0)->getElementsByTagName('SinglePassengerBaggageOptions')->item(0)->getElementsByTagName('option');
                    $m = 0;
                    foreach ($baggages as $baggage) {
                        $booking_final_data['Outbound']['baggage'][$m]['size'] = $baggage->getAttribute('size');
                        $booking_final_data['Outbound']['baggage'][$m]['price'] = $baggage->getAttribute('price');
                        $m++;
                    }
                }
            }
        }
        }
        
        return array('booking_final_data' => $booking_final_data, 'admin_markup' => $mark);
    }

    function booking($postData, $onwardDetails, $requestData, $priceFinalData, $requestId, $masterId) {
        die;
        $pax = '';
        $onward = '';
        $i = 0;
        $totalFare = 0;
        foreach ($priceFinalData['Inbound']['legs'] as $leg) {
            $onward .= '<Flight>
                          <CarrierId>' . $leg['Carrier_code'] . '</CarrierId>
                          <FlightNumber>' . $leg['FlightNumber'] . '</FlightNumber>
                          <Source>' . $leg['Source'] . '</Source>
                          <Destination>' . $leg['Destination'] . '</Destination>
                          <DepartureTimeStamp>' . $leg['DepartureTimeStamp'] . '</DepartureTimeStamp>
                          <ArrivalTimeStamp>' . $leg['ArrivalTimeStamp'] . '</ArrivalTimeStamp>
                          <Class>' . $leg['Class'] . '</Class>
                          <FareBasis>' . $onwardDetails['Inbound']['legs'][$i]['FareBasis'] . '</FareBasis>
                        </Flight>';
            $i++;
        }

        for ($i = 0; $i < count($postData['adulttitle']); $i++) {
            $pax .= '<Passenger>
                        <Type>A</Type>
                        <Title>' . $postData['adulttitle'][$i] . '</Title>
                        <FirstName>' . $postData['adultFname'][$i] . '</FirstName>
                        <LastName>' . $postData['adultLname'][$i] . '</LastName>
                        <DOB>18/02/1986</DOB>';
            if ($postData['adultBaggageOnward'][$i] != '') {
                $pax .= '<OnwardBagageOption>' . $postData['adultBaggageOnward'][$i] . '</OnwardBagageOption>';
            }
            $pax .= '</Passenger>';
        }

        if ($requestData['child'] > 0) {
            for ($i = 0; $i < count($postData['childtitle']); $i++) {
                $pax .= '<Passenger>
                        <Type>C</Type>
                        <Title>' . $postData['childtitle'][$i] . '</Title>
                        <FirstName>' . $postData['childFname'][$i] . '</FirstName>
                        <LastName>' . $postData['childLname'][$i] . '</LastName>
                        <DOB>' . $postData['child_dob'][$i] . '</DOB>';
                if ($postData['childBaggageOnward'][$i] != '') {
                    $pax .= '<OnwardBagageOption>' . $postData['childBaggageOnward'][$i] . '</OnwardBagageOption>';
                }
                $pax .= '</Passenger>';
            }
        }

        if ($requestData['infant'] > 0) {
            for ($i = 0; $i < count($postData['infanttitle']); $i++) {
                $pax .= '<Passenger>
                        <Type>I</Type>
                        <Title>' . $postData['infanttitle'][$i] . '</Title>
                        <FirstName>' . $postData['infantFname'][$i] . '</FirstName>
                        <LastName>' . $postData['infantLname'][$i] . '</LastName>
                        <DOB>' . $postData['infant_dob'][$i] . '</DOB>';
                if ($postData['infantBaggageOnward'][$i] != '') {
                    $pax .= '<OnwardBagageOption>' . $postData['infantBaggageOnward'][$i] . '</OnwardBagageOption>';
                }
                $pax .= '</Passenger>';
            }
        }

        $xml = '<AirBookingRequest>
                <RequestId>' . $requestId . '</RequestId>
                <Mobile>' . $postData['mobile_code'] . '-' . $postData['phone_number'] . '</Mobile>
                <Email>' . $postData['user_email'] . '</Email>
                <BookingRequestId>RDT' . date('YmdHis') . '</BookingRequestId>
                 <Itinerary>
                    <OnwardFlights>
                    ' . $onward . '
                    </OnwardFlights>
                 </Itinerary>
                 <Passengers>
                    ' . $pax . '
                </Passengers>
                <DeliveryInformation>
                  <Street></Street>
                  <City></City>
                  <Zipcode></Zipcode>
                  <Phone>' . $postData['mobile_code'] . '-' . $postData['phone_number'] . '</Phone>
                </DeliveryInformation>
                <PaymentInformation>
                  <PaymentType>2</PaymentType>
                </PaymentInformation>
              </AirBookingRequest>';
        //echo $xml;die;
        $url = $this->url . 'AirBookingRequest';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "xmlRequest=" . $xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        $response = curl_exec($ch);
        curl_close($ch);
        //echo $response; //die; 
        $res = new DOMDocument();
        $res->loadXML($response);
        //echo '<pre>'; print_r($response); exit;
        $path = $_SERVER['DOCUMENT_ROOT'] . '/assets/xml_logs/' . $masterId . '_' . date('Y-m-d H:i:s') . '_booking_prepare.txt';
        $logFile = fopen($path, "w");
        fwrite($logFile, $response);
        fclose($logFile);
        $requestId = '';
        $status = '';
        $pnr = '';
        $bookingId = '';
        $BookingStatus = '';
        if($res->getElementsByTagName('Error')->length > 0 ){
            $BookingStatus = 'Failed';
            $this->db->query($sql = "update flight_booking set pnr = '', booking_ref='', booking_status='" . $BookingStatus . "' where id='" . $masterId . "'");
        } else {
            if ($res->getElementsByTagName('AirBookingResponse')->length > 0) {
                if ($res->getElementsByTagName('RequestId')->length > 0) {
                    $requestId = $res->getElementsByTagName('RequestId')->item(0)->nodeValue;
                }

                if ($res->getElementsByTagName('Status')->length > 0) {
                    $status = $res->getElementsByTagName('Status')->item(0)->nodeValue;
                }

                if ($status == 'Passed') {
                    if ($res->getElementsByTagName('BookingId')->length) {
                        $bookingId = $res->getElementsByTagName('BookingId')->item(0)->nodeValue;
                    }
                    $BookingStatus = 'Passed';
                } else {
                    $BookingStatus = 'Failed';
                }
            } else {
                $BookingStatus = 'Failed';
                $this->db->query($sql = "update flight_booking set pnr = '', booking_ref='', booking_status='" . $BookingStatus . "' where id='" . $masterId . "'");
            }
            
            if ($bookingId != '' && $BookingStatus == 'Passed') {
                $xmlFinal = '<AirBookingStatusRequest>
                            <RequestID>' . $requestId . '</RequestID>
                            <BookingID>' . $bookingId . '</BookingID>
                          </AirBookingStatusRequest>';
                $url = $this->url . 'AirBookingStatusRequest';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "xmlRequest=" . $xmlFinal);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
                $responseFinal = curl_exec($ch);
                curl_close($ch);
                //echo $responseFinal;die;
                $path = $_SERVER['DOCUMENT_ROOT'] . '/assets/xml_logs/' . $masterId . '_' . date('Y-m-d H:i:s') . '_booking_final.txt';
                $logFile = fopen($path, "w");
                fwrite($logFile, $responseFinal);
                fclose($logFile);
                $resFinal = new DOMDocument();
                $resFinal->loadXML($responseFinal);
                if($res->getElementsByTagName('Error')->length > 0 ){
                    $BookingStatus = 'Failed';
                    $this->db->query($sql = "update flight_booking set pnr = '" . $pnr . "', booking_ref='" . $bookingId . "', booking_status='" . $BookingStatus . "' where id='" . $masterId . "'");
                } else {
                    if ($resFinal->getElementsByTagName('Bookings')->length > 0) {
                        $status = $resFinal->getElementsByTagName('Status')->item(0)->nodeValue;
                        $Flights = $resFinal->getElementsByTagName('Flight');
                        foreach ($Flights as $flight) {
                            $pnr .= $flight->getElementsByTagName('AirlinePNR')->item(0)->nodeValue . '<br>';
                        }
                        $totalFare = $resFinal->getElementsByTagName('Pricing')->item(0)->getElementsByTagName('TotalFare')->item(0)->nodeValue;
                        if($status == 'Aborted'){
                            $BookingStatus = 'Failed';
                            $this->db->query($sql = "update flight_booking set pnr = '" . $pnr . "', booking_ref='" . $bookingId . "', booking_status='" . $BookingStatus . "' where id='" . $masterId . "'");
                        } else {
                            $BookingStatus = $status;
                            $this->db->query($sql = "update flight_booking set pnr = '" . $pnr . "', booking_ref='" . $bookingId . "', booking_status='" . $BookingStatus . "' ,TotalFare_org='".$totalFare."' where id='" . $masterId . "'");
                        }
                    } else {
                        $BookingStatus = 'Failed';
                        $this->db->query($sql = "update flight_booking set pnr = '" . $pnr . "', booking_ref='" . $bookingId . "', booking_status='" . $BookingStatus . "' where id='" . $masterId . "'");
                    }
                }
            } else {
                $this->db->query($sql = "update flight_booking set pnr = '', booking_ref='', booking_status='" . $BookingStatus . "' where id='" . $masterId . "'");
            }

            
            return array('status'=>$BookingStatus,'fare'=>$totalFare);
        }
    }

    function bookingRound($onwardDetails, $returnDetails, $postData, $requestData, $priceFinalData, $requestId, $masterId) {
        die;
        $pax = '';
        $onward = '';
        $return = '';
        $i = 0;
        $totalFare = 0;
        foreach ($priceFinalData['Inbound']['legs'] as $leg) {
            $onward .= '<Flight>
                          <CarrierId>' . $leg['Carrier_code'] . '</CarrierId>
                          <FlightNumber>' . $leg['FlightNumber'] . '</FlightNumber>
                          <Source>' . $leg['Source'] . '</Source>
                          <Destination>' . $leg['Destination'] . '</Destination>
                          <DepartureTimeStamp>' . $leg['DepartureTimeStamp'] . '</DepartureTimeStamp>
                          <ArrivalTimeStamp>' . $leg['ArrivalTimeStamp'] . '</ArrivalTimeStamp>
                          <Class>' . $leg['Class'] . '</Class>
                          <FareBasis>' . $onwardDetails['legs'][$i]['FareBasis'] . '</FareBasis>
                        </Flight>';
            $i++;
        }

        $i = 0;
        foreach ($priceFinalData['Outbound']['legs'] as $leg) {
            $return .= '<Flight>
                          <CarrierId>' . $leg['Carrier_code'] . '</CarrierId>
                          <FlightNumber>' . $leg['FlightNumber'] . '</FlightNumber>
                          <Source>' . $leg['Source'] . '</Source>
                          <Destination>' . $leg['Destination'] . '</Destination>
                          <DepartureTimeStamp>' . $leg['DepartureTimeStamp'] . '</DepartureTimeStamp>
                          <ArrivalTimeStamp>' . $leg['ArrivalTimeStamp'] . '</ArrivalTimeStamp>
                          <Class>' . $leg['Class'] . '</Class>
                          <FareBasis>' . $returnDetails['legs'][$i]['FareBasis'] . '</FareBasis>
                        </Flight>';
            $i++;
        }

        for ($i = 0; $i < count($postData['adulttitle']); $i++) {
            $pax .= '<Passenger>
                        <Type>A</Type>
                        <Title>' . $postData['adulttitle'][$i] . '</Title>
                        <FirstName>' . $postData['adultFname'][$i] . '</FirstName>
                        <LastName>' . $postData['adultLname'][$i] . '</LastName>
                        <DOB>18/02/1986</DOB>';
            if (isset($postData['adultBaggageOnward']) && $postData['adultBaggageOnward'][$i] != '') {
                $pax .= '<OnwardBagageOption>' . $postData['adultBaggageOnward'][$i] . '</OnwardBagageOption>';
            }
            if (isset($postData['adultBaggageReturn']) && $postData['adultBaggageReturn'][$i] != '') {
                $pax .= '<ReturnBagageOption>' . $postData['adultBaggageReturn'][$i] . '</ReturnBagageOption>';
            }
            $pax .= '</Passenger>';
        }



        if ($requestData['child'] > 0) {
            for ($i = 0; $i < count($postData['childtitle']); $i++) {
                $pax .= '<Passenger>
                        <Type>C</Type>
                        <Title>' . $postData['childtitle'][$i] . '</Title>
                        <FirstName>' . $postData['childFname'][$i] . '</FirstName>
                        <LastName>' . $postData['childLname'][$i] . '</LastName>
                        <DOB>' . $postData['child_dob'][$i] . '</DOB>';
                if (isset($postData['childBaggageOnward']) && $postData['childBaggageOnward'][$i] != '') {
                    $pax .= '<OnwardBagageOption>' . $postData['childBaggageOnward'][$i] . '</OnwardBagageOption>';
                }
                if (isset($postData['childBaggageReturn']) && $postData['childBaggageReturn'][$i] != '') {
                    $pax .= '<ReturnBagageOption>' . $postData['childBaggageReturn'][$i] . '</ReturnBagageOption>';
                }
                $pax .= '</Passenger>';
            }
        }


        if ($requestData['infant'] > 0) {
            for ($i = 0; $i < count($postData['infanttitle']); $i++) {
                $pax .= '<Passenger>
                        <Type>I</Type>
                        <Title>' . $postData['infanttitle'][$i] . '</Title>
                        <FirstName>' . $postData['infantFname'][$i] . '</FirstName>
                        <LastName>' . $postData['infantLname'][$i] . '</LastName>
                        <DOB>' . $postData['infant_dob'][$i] . '</DOB>';
                if (isset($postData['infantBaggageOnward']) && $postData['infantBaggageOnward'][$i] != '') {
                    $pax .= '<OnwardBagageOption>' . $postData['infantBaggageOnward'][$i] . '</OnwardBagageOption>';
                }
                if (isset($postData['infantBaggageReturn']) && $postData['infantBaggageReturn'][$i] != '') {
                    $pax .= '<ReturnBagageOption>' . $postData['infantBaggageReturn'][$i] . '</ReturnBagageOption>';
                }
                $pax .= '</Passenger>';
            }
        }

        $request_id = 'RDT' . date('YmdHis');
        $xml = '<AirBookingRequest>
                <RequestId>' . $requestId . '</RequestId>
                <Mobile>' . $postData['mobile_code'] . '-' . $postData['phone_number'] . '</Mobile>
                <Email>' . $postData['user_email'] . '</Email>
                <BookingRequestId>RDT' . date('YmdHis') . '</BookingRequestId>
                 <Itinerary>
                    <OnwardFlights>
                    ' . $onward . '
                    </OnwardFlights>
                    <ReturnFlights>
                    ' . $return . '
                    </ReturnFlights>
                 </Itinerary>
                 <Passengers>
                    ' . $pax . '
                </Passengers>
                <DeliveryInformation>
                  <Street></Street>
                  <City></City>
                  <Zipcode></Zipcode>
                  <Phone>' . $postData['mobile_code'] . '-' . $postData['phone_number'] . '</Phone>
                </DeliveryInformation>
                <PaymentInformation>
                  <PaymentType>2</PaymentType>
                </PaymentInformation>
              </AirBookingRequest>';
//echo $xml;die;
        $url = $this->url . 'AirBookingRequest';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "xmlRequest=" . $xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;//die;
        $res = new DOMDocument();
        $res->loadXML($response);
        $path = $_SERVER['DOCUMENT_ROOT'] . '/assets/xml_logs/' . $masterId . '_' . date('Y-m-d H:i:s') . '_booking_prepare.txt';
        $logFile = fopen($path, "w");
        fwrite($logFile, $response);
        fclose($logFile);
        $requestId = '';
        $status = '';
        $pnr = '';
        $bookingId = '';
        $BookingStatus = '';
        if($res->getElementsByTagName('Error')->length > 0 ){
            $BookingStatus = 'Failed';
            $this->db->query($sql = "update flight_booking set pnr = '', booking_ref='', booking_status='" . $BookingStatus . "' where id='" . $masterId . "'");
        } else {
            if ($res->getElementsByTagName('AirBookingResponse')->length > 0) {
                if ($res->getElementsByTagName('RequestId')->length > 0) {
                    $requestId = $res->getElementsByTagName('RequestId')->item(0)->nodeValue;
                }

                if ($res->getElementsByTagName('Status')->length > 0) {
                    $status = $res->getElementsByTagName('Status')->item(0)->nodeValue;
                }

                if ($status == 'Passed') {
                    if ($res->getElementsByTagName('BookingId')->length) {
                        $bookingId = $res->getElementsByTagName('BookingId')->item(0)->nodeValue;
                    }
                    $BookingStatus = 'Passed';
                } else {
                    $BookingStatus = 'Failed';
                }
            }

            if ($bookingId != '' && $BookingStatus == 'Passed') {
                $xmlFinal = '<AirBookingStatusRequest>
                            <RequestID>' . $requestId . '</RequestID>
                            <BookingID>' . $bookingId . '</BookingID>
                          </AirBookingStatusRequest>';
                $url = $this->url . 'AirBookingStatusRequest';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "xmlRequest=" . $xmlFinal);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
                $responseFinal = curl_exec($ch);
                curl_close($ch);
                //echo $responseFinal;die;
                $path = $_SERVER['DOCUMENT_ROOT'] . '/assets/xml_logs/' . $masterId . '_' . date('Y-m-d H:i:s') . '_booking_final.txt';
                $logFile = fopen($path, "w");
                fwrite($logFile, $responseFinal);
                fclose($logFile);
                $resFinal = new DOMDocument();
                $resFinal->loadXML($responseFinal);
                if($res->getElementsByTagName('Error')->length > 0 ){
                    $BookingStatus = 'Failed';
                    $this->db->query($sql = "update flight_booking set pnr = '" . $pnr . "', booking_ref='" . $bookingId . "', booking_status='" . $BookingStatus . "' where id='" . $masterId . "'");
                } else {
                    if ($resFinal->getElementsByTagName('Bookings')->length > 0) {
                        $status = $resFinal->getElementsByTagName('Status')->item(0)->nodeValue;
                        $Flights = $resFinal->getElementsByTagName('Flight');
                        foreach ($Flights as $flight) {
                            $pnr .= $flight->getElementsByTagName('AirlinePNR')->item(0)->nodeValue . '<br>';
                        }
                        $totalFare = $resFinal->getElementsByTagName('Pricing')->item(0)->getElementsByTagName('TotalFare')->item(0)->nodeValue;
                        if($status == 'Aborted'){
                            $BookingStatus = 'Failed';
                            $this->db->query($sql = "update flight_booking set pnr = '" . $pnr . "', booking_ref='" . $bookingId . "', booking_status='" . $BookingStatus . "' where id='" . $masterId . "'");
                        } else {
                            $BookingStatus = $status;
                            $this->db->query($sql = "update flight_booking set pnr = '" . $pnr . "', booking_ref='" . $bookingId . "', booking_status='" . $BookingStatus . "' ,TotalFare_org='".$totalFare."' where id='" . $masterId . "'");
                        }
                    } else {
                        $BookingStatus = 'Failed';
                        $this->db->query($sql = "update flight_booking set pnr = '" . $pnr . "', booking_ref='" . $bookingId . "', booking_status='" . $BookingStatus . "' where id='" . $masterId . "'");
                    }
                }
            } else {
                $this->db->query($sql = "update flight_booking set pnr = '', booking_ref='', booking_status='" . $BookingStatus . "' where id='" . $masterId . "'");
            }

            
            return array('status'=>$BookingStatus,'fare'=>$totalFare);
        }
    }

    function getCurl($url) {
        //echo $url;die;
        $header[] = "Accept: application/xml";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        //echo curl_error($ch);die;
        return $response;
    }

}
