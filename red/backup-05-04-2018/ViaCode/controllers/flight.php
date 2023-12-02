<?php

defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 0);
error_reporting(0);
session_start();
####################################
#   API Id - 1 => Via
#   API ID - 2 => MistiFly
####################################

class Flight extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Home_Model');
        $this->load->model('Flight_Model');
        $this->load->model('Via_Model');
    }

    public function search() {
        ####################################
        #   API Id - 1 => Via
        ####################################
        $_SESSION[session_id()]['flsearchData'] = '';
        $_SESSION[session_id()]['Via_data'] = '';
        $_SESSION[session_id()]['Via_booking_final'] = '';
        $_SESSION[session_id()]['admin_markup'] = '';
        $_SESSION[session_id()]['agent_markup'] = '';
        $_SESSION['system_currency'] = 'PHP';
        $get = filter_input_array(INPUT_GET);
        if (isset($get['journey_type'])) {
            if ($get['journey_type'] == 'one_way') {
                $data['searchData'] = $this->searchOneWay($get);
                $_SESSION[session_id()]['flsearchData'] = $data['searchData'];
                $data['api_array'] = array('1');
                $this->load->view('flight/search', $data);
            } else if ($get['journey_type'] == 'round_trip') {
                $data['searchData'] = $this->searchRoundTrip($get);
                $_SESSION[session_id()]['flsearchData'] = $data['searchData'];
                $data['api_array'] = array('1');
                $this->load->view('flight/search', $data);
            } else if ($get['journey_type'] == 'multi_city') {
                $this->searchMultiCity($get);
            } else {
                redirect('home');
            }
        } else {
            redirect('home');
        }
    }

    public function searchOneWay($data) {
        if ($data['from'] != '' && $data['to'] != '' && $data['sd'] != '') {
            $fromCity = $data['from'];
            $toCity = $data['to'];
            if (strpos($fromCity, ',') !== false) {
                $fromArr = explode(',', $fromCity);
                $fromCode = end($fromArr);
                $from = $fromArr[0] . ',' . $fromArr[1];
                $fromCountry = $fromArr[1];
                $fromCity = $fromArr[0];
            } else {
                $fromCode = '';
                $from = $fromCity;
                $fromCountry = '';
                $fromCity = '';
            }

            if (strpos($toCity, ',') !== false) {
                $toArr = explode(',', $toCity);
                $toCode = end($toArr);
                $to = $toArr[0] . ',' . $toArr[1];
                $toCountry = $toArr[1];
                $toCity = $toArr[0];
            } else {
                $toCode = '';
                $to = $toCity;
                $toCountry = '';
                $toCity = '';
            }

            $date = $data['sd'];
            $adult = $data['fl_adult'];
            $travelClass = $data['fl_class'];
            $prefAirline = $data['pref_air'];
            if(isset($data['senior_ctzn'])){
                $srCitizen = 'true';
                $child = 0;
                $infant = 0;
            } else {
                $srCitizen = 'false';
                $child = $data['fl_child'];
                $infant = $data['fl_infant'];
            }
            
            $nonStopOnly = '';
            $searchArr = array(
                'from' => $from, 'to' => $to, 'fromCode' => $fromCode,
                'toCode' => $toCode, 'sd' => $date, 'adult' => $adult, 'child' => $child,
                'infant' => $infant, 'travelClass' => $travelClass, 'nonStopOnly' => $nonStopOnly,'pref_airline'=>$prefAirline,'sr_ctzn'=>$srCitizen,
                'journey_type' => 'one_way', 'fromCountry' => $fromCountry, 'toCountry' => $toCountry, 'fromCity' => $fromCity, 'toCity' => $toCity
            );

            return $searchArr;
        }
    }

    public function searchRoundTrip($data) {
        if ($data['from'] != '' && $data['to'] != '' && $data['sd'] != '' && $data['ed'] != '') {
            $fromCity = $data['from'];
            $toCity = $data['to'];
            if (strpos($fromCity, ',') !== false) {
                $fromArr = explode(',', $fromCity);
                $fromCode = end($fromArr);
                $from = $fromArr[0] . ', ' . $fromArr[1];
                $fromCountry = $fromArr[1];
                $fromCity = $fromArr[0];
            } else {
                $fromCode = '';
                $from = $fromCity;
                $fromCountry = '';
                $fromCity = '';
            }

            if (strpos($toCity, ',') !== false) {
                $toArr = explode(',', $toCity);
                $toCode = end($toArr);
                $to = $toArr[0] . ', ' . $toArr[1];
                $toCountry = $toArr[1];
                $toCity = $toArr[0];
            } else {
                $toCode = '';
                $to = $toCity;
                $toCountry = '';
                $toCity = '';
            }

            $date = $data['sd'];
            $returnDate = $data['ed'];
            $adult = $data['fl_adult'];
            $travelClass = $data['fl_class'];
            $prefAirline = $data['pref_air'];
            if(isset($data['senior_ctzn'])){
                $srCitizen = 'true';
                $child = 0;
                $infant = 0;
            } else {
                $srCitizen = 'false';
                $child = $data['fl_child'];
                $infant = $data['fl_infant'];
            }
            $nonStopOnly = '';
            $searchArr = array(
                'from' => $from, 'to' => $to, 'fromCode' => $fromCode,
                'toCode' => $toCode, 'sd' => $date, 'ed' => $returnDate, 'adult' => $adult, 'child' => $child,
                'infant' => $infant, 'travelClass' => $travelClass, 'nonStopOnly' => $nonStopOnly,'pref_airline'=>$prefAirline,'sr_ctzn'=>$srCitizen,
                'journey_type' => 'round_trip', 'fromCountry' => $fromCountry, 'toCountry' => $toCountry, 'fromCity' => $fromCity, 'toCity' => $toCity
            );

            return $searchArr;
        }
    }

    public function getSearchData($apiId) {


        $flag = 'filter';
        $data['admin_markup'] = $this->Home_Model->getAdminMarkup($_SESSION['agent']['user_id']);
        $data['agent_markup'] = $this->Home_Model->getAgentMarkup($_SESSION['agent']['user_id']);
        $data['searchParms'] = $_SESSION[session_id()]['flsearchData'];
        if ($data['searchParms']['journey_type'] == 'round_trip') {
            $data['flights'] = $this->Via_Model->getFlightAvailabilityRt($data['searchParms']);
            if(isset($data['flights']['via_data'])){
                $_SESSION[session_id()]['Via_data'] = $data['flights']['via_data'];
            }
            if (trim($data['searchParms']['fromCountry']) == 'Philippines' && trim($data['searchParms']['toCountry']) == 'Philippines') {
                $serchView = $this->load->view('flight/search_result_ajax_round', $data, true);
                $flag = 'round_filter';
            } else {
                $serchView = $this->load->view('flight/search_result_ajax_roundintl', $data, true);
            }
        } else {
            $data['flights'] = $this->Via_Model->getFlightAvailabilityOw($data['searchParms']);
            if(isset($data['flights']['via_data'])){
                $_SESSION[session_id()]['Via_data'] = $data['flights']['via_data'];
            }
            $serchView = $this->load->view('flight/search_result_ajax', $data, true);
        }

        $airlines = '';
        $Rairlines = '';
        $count = 0;
        if ($data['flights']['via_data'] != '') {
            if ($data['flights']['filters']['airlines'] != '') {
                $airlineList = array_unique($data['flights']['filters']['airlines']);

                foreach ($airlineList as $name) {
                    $airlines .= '<li style="width: 100%;padding: 7px 0 5px 15px;" ><label style="font-weight:normal;width: 84%" onclick="filter();"><span style="margin-top:3px;"><input type="checkbox" name="airlines" class="air_filter" value="' . $name . '" style="width:15px;height:15px;margin-right:10px;" checked="checked" onclick="filter();"></span>' . $name . '</label></li>';
                }
            }
            
           // print_r($data['flights']['filters']['Rairlines']);die;
            if(isset($data['flights']['filters']['Rairlines'])){
                if ($data['flights']['filters']['Rairlines'] != '') {
                    $airlineList = array_unique($data['flights']['filters']['Rairlines']);

                    foreach ($airlineList as $name) {
                        $Rairlines .= '<li style="width: 100%;padding: 7px 0 5px 15px;" ><label style="font-weight:normal;width: 84%" onclick="filter();"><span style="margin-top:3px;"><input type="checkbox" name="Rairlines" class="Rair_filter" value="' . $name . '" style="width:15px;height:15px;margin-right:10px;" checked="checked" onclick="filter();"></span>' . $name . '</label></li>';
                    }
                }
            }
            
            $count = $data['flights']['filters']['count'];
        }
        
        echo json_encode(
                array(
                    'flight_search_result' => $serchView,
                    'airlines' => $airlines,
                    'Rairlines' => $Rairlines,
                    'flight_count' => $count,
                    'flag'=>$flag
                )
        );
    }

    public function details($id = '', $outId = '') {
        $_SESSION[session_id()]['Via_booking_final'] = '';
        $admin_markup = $this->Home_Model->getAdminMarkup($_SESSION['agent']['user_id']);
        $agent_markup = $this->Home_Model->getAgentMarkup($_SESSION['agent']['user_id']);
        $data['searchData'] = $_SESSION[session_id()]['flsearchData'];
        $data['flight_id'] = $id;
        $data['return_id'] = $outId;
        if ($data['searchData']['journey_type'] == 'one_way') {
            $data['flightData'] = $_SESSION[session_id()]['Via_data'][$id];
            $requestId = $data['flightData']['RequestId'];
            if (trim($data['searchData']['fromCountry']) == 'Philippines' && trim($data['searchData']['toCountry']) == 'Philippines') {
                $flightType = 'dom';
            } else {
                $flightType = 'intl';
            }
            $flightDetails = $this->Via_Model->flightDetails($data['flightData'], $returnId = '', $requestId, $data['searchData'], $admin_markup, $agent_markup, $flightType);
            $data['flightDetails'] = $flightDetails['booking_final_data'];
            $_SESSION[session_id()]['Via_booking_final'] = $data['flightDetails'];
            $_SESSION[session_id()]['admin_markup'] = $flightDetails['admin_markup'];
            $_SESSION[session_id()]['agent_markup'] = $flightDetails['agent_markup'];
            $data['phone_codes'] = $this->Home_Model->getAllCountryPhoneCodes();
            if ($flightDetails['booking_final_data'] != '') {
                $depositBalance = $this->Home_Model->getAgentDepositBalance($_SESSION['agent']['user_id']);
                if ($flightDetails['booking_final_data']['TotalAmount'] > $depositBalance) {
                    $data['lowBalance'] = true;
                } else {
                    $data['lowBalance'] = false;
                }
            }
            $this->load->view('flight/details', $data);
        } else {
            if (trim($data['searchData']['fromCountry']) == 'Philippines' && trim($data['searchData']['toCountry']) == 'Philippines') {
                $data['flightData'] = $_SESSION[session_id()]['Via_data']['Inbound'][$id];
                $data['roundData'] = $_SESSION[session_id()]['Via_data']['Outbound'][$outId];
                $requestId = $_SESSION[session_id()]['Via_data']['RequestId'];
                $flightType = 'dom';
                $flightDetails = $this->Via_Model->flightDetails($data['flightData'], $data['roundData'], $requestId, $data['searchData'], $admin_markup, $agent_markup, $flightType);
                $data['flightDetails'] = $flightDetails['booking_final_data'];
            } else {
                
                $onwardId = $_SESSION[session_id()]['Via_data'][$id];
                $requestId = $_SESSION[session_id()]['Via_data'][$id]['RequestId'];
                $data['flightData'] = $_SESSION[session_id()]['Via_data'][$id]['Inbound'];
                $data['roundData'] = $_SESSION[session_id()]['Via_data'][$id]['Outbound'];
                $flightType = 'intl';
                $flightDetails = $this->Via_Model->flightDetailsIntl($onwardId, $returnId = '', $requestId, $data['searchData'], $admin_markup, $agent_markup, $flightType);
                $data['flightDetails'] = $flightDetails['booking_final_data'];
            }
            $_SESSION[session_id()]['Via_booking_final'] = $flightDetails['booking_final_data'];
            $_SESSION[session_id()]['admin_markup'] = $flightDetails['admin_markup'];
            $data['phone_codes'] = $this->Home_Model->getAllCountryPhoneCodes();
            if ($flightDetails['booking_final_data'] != '') {
                $depositBalance = $this->Home_Model->getAgentDepositBalance($_SESSION['agent']['user_id']);
                if ($flightDetails['booking_final_data']['TotalAmount'] > $depositBalance) {
                    $data['lowBalance'] = true;
                } else {
                    $data['lowBalance'] = false;
                }
            }
            $this->load->view('flight/details_round', $data);
        }
    }

    public function showTfFlightDetailsOw($id) {
        $data['flightId'] = $id;
        $data['flight'] = $_SESSION[session_id()]['Via_data'][$id];
        $view = $this->load->view('flight/search_flight_popup', $data, true);
        echo json_encode(array('view' => $view));
    }

    public function showTfFlightDetailsRtDom($id, $type) {
        $data['flightId'] = $id;
        if ($type == 'outward') {
            $data['flight'] = $_SESSION[session_id()]['Via_data']['Inbound'][$id];
        } else {
            $data['flight'] = $_SESSION[session_id()]['Via_data']['Outbound'][$id];
        }
        $view = $this->load->view('flight/search_flight_rounddom_popup', $data, true);
        echo json_encode(array('view' => $view));
    }

    public function showTfFlightDetailsRtIntl($id) {
        $data['flightId'] = $id;
        $data['flight'] = $_SESSION[session_id()]['Via_data'][$id];
        $view = $this->load->view('flight/search_flight_roundintl_popup', $data, true);
        echo json_encode(array('view' => $view));
    }

    function showInboundFlight() {
        $id = $_POST['flightId'];
        $outId = $_POST['outId'];
        $flightData = $_SESSION[session_id()]['Via_data'];
        $searchParms = $_SESSION[session_id()]['flsearchData'];
        if ($flightData != '') {
            $html = '';
            $html1 = '';
            $childFare = 0;
            $infantFare = 0;
            $adult = $searchParms['adult'];
            $child = $searchParms['child'];
            $infant = $searchParms['infant'];
            $flight = $flightData['Inbound'][$id];
            $endLeg = end($flight['legs']);
            $depDetails = explode('T', $flight['legs'][0]['DepartureTimeStamp']);
            $arvDetails = explode('T', $endLeg['ArrivalTimeStamp']);
            $chunks = str_split($depDetails[1], 2);
            $depTime = implode(':', $chunks);
            $chunks1 = str_split($arvDetails[1], 2);
            $arvTime = implode(':', $chunks1);
            $duration = explode(':', gmdate("H:i", ($flight['duration'] * 60)));
            $durHour = $duration[0];
            $durMin = $duration[1];
            $totalDur = $flight['duration'];
            $adultFare = ($flight['adult_fare'] * $adult);
            if ($child > 0) {
                $childFare = ($flight['child_fare'] * $child);
            }
            if ($infant > 0) {
                $infantFare = ($flight['infant_fare'] * $infant);
            }
            $totalFare = $adultFare + $childFare + $infantFare;
            $admin_markup = $this->Home_Model->getAdminMarkup($_SESSION['agent']['user_id']);
            $agent_markup = $this->Home_Model->getAgentMarkup($_SESSION['agent']['user_id']);
            if (array_key_exists($flight['legs'][0]['Carrier_code'], $admin_markup)) {
                $airCode = $flight['legs'][0]['Carrier_code'];
                if ($admin_markup['type'] == 'fixed') {
                    $admMark = ($admin_markup[$airCode]);
                    $totalFare = ($totalFare + $admMark);
                } else {
                    $admMark = (($admin_markup[$airCode] / 100) * $totalFare);
                    $totalFare = ($admMark + $totalFare);
                }
            }
            
            if (array_key_exists($flight['legs'][0]['Carrier_code'], $agent_markup)) {
                $airCode = $flight['legs'][0]['Carrier_code'];
                if ($agent_markup['type'] == 'fixed') {
                    $agentMark = ($agent_markup[$airCode]);
                    $totalFare = ($totalFare + $agentMark);
                } else {
                    $agentMark = (($agent_markup[$airCode] / 100) * $totalFare);
                    $totalFare = ($agentMark + $totalFare);
                }
            }

            $html .= '<div class="row">
                        <div class="col-sm-12 fli_round_ser" style="background-color: #ffffff;padding:0;">
                            <table id="t02">
                                <tr class="fli_round_ser1">
                                    <td colspan="5" style="color: #8A8A8A;text-align:center;font-weight:bold;">Onward Flight</td>
                                </tr>
                                <tr class="fli_round_ser1">
                                    <td style="color: #8A8A8A;">Airline</td>
                                    <td style="color: #8A8A8A;">Depart</td>
                                    <td style="color: #8A8A8A;">Arrival</td>
                                    <td style="color: #8A8A8A;">Duration</td>
                                    <td style="color: #8A8A8A;">Price</td>
                                </tr>
                                <tr class="fli_round_ser1">
                                    <td>
                                        <div class="icon">&nbsp;&nbsp;<img src="' . base_url() . 'assets/images/airlines/icons/' . $flight['legs'][0]['Carrier_code'] . '.gif" width="30" height="30" /><br />
                                            <span style="font-size:x-small;margin-left: 0px;">' . $flight['legs'][0]['Carrier_code'] . '-' . $flight['legs'][0]['FlightNumber'] . '</span>
                                        </div>
                                    </td>
                                    <td>' . $depTime . '</td>
                                    <td>' . $arvTime . '</td>
                                    <td style="width: 28%;">' . $durHour . 'h ' . $durMin . 'm<br /><span style="font-size:x-small;font-weight:bold;">' . $flight['stops'] . ' Stops</span></td>
                                    <td><p><b>&#8369;' . number_format($totalFare, 2, '.', ',') . '</b></p></td>
                                </tr>
                            </table>
                        </div>
                    </div>';

            if ($outId != '') {
                $flight1 = $flightData['Outbound'][$outId];
                $adultFare = ($flight1['adult_fare'] * $adult);
                if ($child > 0) {
                    $childFare = ($flight1['child_fare'] * $child);
                }
                if ($infant > 0) {
                    $infantFare = ($flight1['infant_fare'] * $infant);
                }
                $outTotalFare = $adultFare + $childFare + $infantFare;
                if (array_key_exists($flight1['legs'][0]['Carrier_code'], $admin_markup)) {
                    $airCode = $flight1['legs'][0]['Carrier_code'];
                    if ($admin_markup['type'] == 'fixed') {
                        $admMark = ($admin_markup[$airCode]);
                        $outTotalFare = ($outTotalFare + $admMark);
                    } else {
                        $admMark = (($admin_markup[$airCode] / 100) * $outTotalFare);
                        $outTotalFare = ($admMark + $outTotalFare);
                    }
                }
                
                if (array_key_exists($flight1['legs'][0]['Carrier_code'], $agent_markup)) {
                    $airCode = $flight1['legs'][0]['Carrier_code'];
                    if ($agent_markup['type'] == 'fixed') {
                        $agentMark = ($agent_markup[$airCode]);
                        $outTotalFare = ($outTotalFare + $agentMark);
                    } else {
                        $agentMark = (($agent_markup[$airCode] / 100) * $outTotalFare);
                        $outTotalFare = ($agentMark + $outTotalFare);
                    }
                }
                
            } else {
                $outTotalFare = 0;
            }

            $finalPrice = $totalFare + $outTotalFare;

            $html1 .= '<div class="row">
                                <div class="col-sm-12 fli_round_ser" style="background-color: #ffffff">
                                    <table id="t02">
                                        <tr class="fli_round_ser1">
                                            <td colspan="5" style="color: #8A8A8A;text-align:center;font-weight:bold;">Total Fare</td>
                                        </tr>
                                        <tr class="fli_round_ser1">
                                            <td style="color: #8A8A8A;font-weight:bold;text-align:center;">&#8369; ' . number_format($finalPrice, 2, '.', ',') . '</td>
                                        </tr>
                                        <tr class="fli_round_ser1">
                                            <td><button type="button" class="awe-btn" style="padding:0px 10px;" onclick="checkBothFlight();">Book Now</button></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>';

            echo json_encode(
                    array(
                        'show_inbound' => $html,
                        'show_price' => $html1
                    )
            );
        }
    }

    function showOutboundFlight() {
        $id = $_POST['flightId'];
        $outId = $_POST['outId'];
        $flightData = $_SESSION[session_id()]['Via_data'];
        $searchParms = $_SESSION[session_id()]['flsearchData'];
        if ($flightData != '') {
            $html = '';
            $html1 = '';
            $childFare = 0;
            $infantFare = 0;
            $adult = $searchParms['adult'];
            $child = $searchParms['child'];
            $infant = $searchParms['infant'];
            $flight = $flightData['Outbound'][$id];
            $endLeg = end($flight['legs']);
            $depDetails = explode('T', $flight['legs'][0]['DepartureTimeStamp']);
            $arvDetails = explode('T', $endLeg['ArrivalTimeStamp']);
            $chunks = str_split($depDetails[1], 2);
            $depTime = implode(':', $chunks);
            $chunks1 = str_split($arvDetails[1], 2);
            $arvTime = implode(':', $chunks1);
            $duration = explode(':', gmdate("H:i", ($flight['duration'] * 60)));
            $durHour = $duration[0];
            $durMin = $duration[1];
            $totalDur = $flight['duration'];
            $adultFare = ($flight['adult_fare'] * $adult);
            if ($child > 0) {
                $childFare = ($flight['child_fare'] * $child);
            }
            if ($infant > 0) {
                $infantFare = ($flight['infant_fare'] * $infant);
            }
            $totalFare = $adultFare + $childFare + $infantFare;
            $admin_markup = $this->Home_Model->getAdminMarkup($_SESSION['agent']['user_id']);
            $agent_markup = $this->Home_Model->getAgentMarkup($_SESSION['agent']['user_id']);
            if (array_key_exists($flight['legs'][0]['Carrier_code'], $admin_markup)) {
                $airCode = $flight['legs'][0]['Carrier_code'];
                if ($admin_markup['type'] == 'fixed') {
                    $admMark = ($admin_markup[$airCode]);
                    $totalFare = ($totalFare + $admMark);
                } else {
                    $admMark = (($admin_markup[$airCode] / 100) * $totalFare);
                    $totalFare = ($admMark + $totalFare);
                }
            }
            
            if (array_key_exists($flight['legs'][0]['Carrier_code'], $agent_markup)) {
                $airCode = $flight['legs'][0]['Carrier_code'];
                if ($agent_markup['type'] == 'fixed') {
                    $agentMark = ($agent_markup[$airCode]);
                    $totalFare = ($totalFare + $agentMark);
                } else {
                    $agentMark = (($agent_markup[$airCode] / 100) * $totalFare);
                    $totalFare = ($agentMark + $totalFare);
                }
            }

            $html .= '<div class="row">
                        <div class="col-sm-12 fli_round_ser" style="background-color: #ffffff;padding:0;">
                            <table id="t02">
                                <tr class="fli_round_ser1">
                                    <td colspan="5" style="color: #8A8A8A;text-align:center;font-weight:bold;">Return Flight</td>
                                </tr>
                                <tr class="fli_round_ser1">
                                    <td style="color: #8A8A8A;">Airline</td>
                                    <td style="color: #8A8A8A;">Depart</td>
                                    <td style="color: #8A8A8A;">Arrival</td>
                                    <td style="color: #8A8A8A;">Duration</td>
                                    <td style="color: #8A8A8A;">Price</td>
                                </tr>
                                <tr class="fli_round_ser1">
                                    <td>
                                        <div class="icon">&nbsp;&nbsp;<img src="' . base_url() . 'assets/images/airlines/icons/' . $flight['legs'][0]['Carrier_code'] . '.gif" width="30" height="30" /><br />
                                            <span style="font-size:x-small;margin-left: 0px;">' . $flight['legs'][0]['Carrier_code'] . '-' . $flight['legs'][0]['FlightNumber'] . '</span>
                                        </div>
                                    </td>
                                    <td>' . $depTime . '</td>
                                    <td>' . $arvTime . '</td>
                                    <td style="width: 34%;">' . $durHour . 'h ' . $durMin . 'm<br /><span style="font-size:x-small;font-weight:bold;">' . $flight['stops'] . ' Stops</span></td>
                                    <td><p><b>&#8369;' . number_format($totalFare, 2, '.', ',') . '</b></p></td>
                                </tr>
                            </table>
                        </div>
                    </div>';

            if ($outId != '') {
                $flight1 = $flightData['Inbound'][$outId];
                $adultFare = ($flight1['adult_fare'] * $adult);
                if ($child > 0) {
                    $childFare = ($flight1['child_fare'] * $child);
                }
                if ($infant > 0) {
                    $infantFare = ($flight1['infant_fare'] * $infant);
                }
                $outTotalFare = $adultFare + $childFare + $infantFare;
                if (array_key_exists($flight1['legs'][0]['Carrier_code'], $admin_markup)) {
                    $airCode = $flight1['legs'][0]['Carrier_code'];
                    if ($admin_markup['type'] == 'fixed') {
                        $admMark = ($admin_markup[$airCode]);
                        $outTotalFare = ($outTotalFare + $admMark);
                    } else {
                        $admMark = (($admin_markup[$airCode] / 100) * $outTotalFare);
                        $outTotalFare = ($admMark + $outTotalFare);
                    }
                }
                if (array_key_exists($flight1['legs'][0]['Carrier_code'], $agent_markup)) {
                    $airCode = $flight1['legs'][0]['Carrier_code'];
                    if ($agent_markup['type'] == 'fixed') {
                        $agentMark = ($agent_markup[$airCode]);
                        $outTotalFare = ($outTotalFare + $agentMark);
                    } else {
                        $agentMark = (($agent_markup[$airCode] / 100) * $outTotalFare);
                        $outTotalFare = ($agentMark + $outTotalFare);
                    }
                }
                
            } else {
                $outTotalFare = 0;
            }

            $finalPrice = $totalFare + $outTotalFare;

            $html1 .= '<div class="row">
                                <div class="col-sm-12 fli_round_ser" style="background-color: #ffffff">
                                    <table id="t02">
                                        <tr class="fli_round_ser1">
                                            <td colspan="5" style="color: #8A8A8A;text-align:center;font-weight:bold;">Total Fare</td>
                                        </tr>
                                        <tr class="fli_round_ser1">
                                            <td style="color: #8A8A8A;font-weight:bold;text-align:center;">&#8369; ' . number_format($finalPrice, 2, '.', ',') . '</td>
                                        </tr>
                                        <tr class="fli_round_ser1">
                                            <td><button type="button" class="awe-btn" style="padding:0px 10px;" onclick="checkBothFlight();">Book Now</button></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>';

            echo json_encode(
                    array(
                        'show_outbound' => $html,
                        'show_price' => $html1
                    )
            );
        }
    }

    public function booking() {
        $post = filter_input_array(INPUT_POST);


        if (isset($post['flight_id']) && isset($post['return_id'])) {
            $searchParms = $_SESSION[session_id()]['flsearchData'];
            $agentData = $_SESSION['agent'];
            if (trim($searchParms['journey_type']) == 'one_way') {
                $flight_id = $post['flight_id'];
                $requestId = $_SESSION[session_id()]['Via_data'][$flight_id]['RequestId'];
                $onwardDetails = $_SESSION[session_id()]['Via_data'][$flight_id];
                $priceFinalData = $_SESSION[session_id()]['Via_booking_final'];
                $masterId = $this->Flight_Model->addFlightBookingDetails($post, $onwardDetails, $searchParms, $priceFinalData, $agentData, $_SESSION[session_id()]['admin_markup'], $_SESSION[session_id()]['agent_markup']);
                $booking = $this->Via_Model->booking($post, $onwardDetails, $searchParms, $priceFinalData, $requestId, $masterId);
                if ($booking['status'] != 'Failed') {
                    $this->Home_Model->deductFlAgentDepositOnBooking($_SESSION['agent']['user_id'], $_SESSION['agent']['user_type'], $booking['fare'], $_SESSION[session_id()]['admin_markup'], $_SESSION[session_id()]['agent_markup'], '0');
                    redirect('flight/thankyou/' . $masterId);
                } else {
                    redirect('flight/booking_failed/');
                }
            } else {
                $flight_id = $_POST['flight_id'];
                $return_id = $_POST['return_id'];
                if (trim($searchParms['fromCountry']) == 'Philippines' && trim($searchParms['toCountry']) == 'Philippines') {
                    $requestId = $_SESSION[session_id()]['Via_data']['RequestId'];
                    $onwardDetails = $_SESSION[session_id()]['Via_data']['Inbound'][$flight_id];
                    $returnDetails = $_SESSION[session_id()]['Via_data']['Outbound'][$return_id];
                } else {
                    $requestId = $_SESSION[session_id()]['Via_data'][$flight_id]['RequestId'];
                    $onwardDetails = $_SESSION[session_id()]['Via_data'][$flight_id]['Inbound'];
                    $returnDetails = $_SESSION[session_id()]['Via_data'][$flight_id]['Outbound'];
                }
                $priceFinalData = $_SESSION[session_id()]['Via_booking_final'];
                $masterId = $this->Flight_Model->addFlightBookingDetailsRound($onwardDetails, $returnDetails, $post, $searchParms, $priceFinalData, $agentData, $_SESSION[session_id()]['admin_markup'], $_SESSION[session_id()]['agent_markup']);
                $booking = $this->Via_Model->bookingRound($onwardDetails, $returnDetails, $post, $searchParms, $priceFinalData, $requestId, $masterId);
                if ($booking == 'Success') {
                    $this->Home_Model->deductFlAgentDepositOnBooking($_SESSION['agent']['user_id'], $_SESSION['agent']['user_type'], $booking['fare'], $_SESSION[session_id()]['admin_markup'], $_SESSION[session_id()]['agent_markup'], '0');
                    redirect('flight/thankyou/' . $masterId);
                } else {
                    redirect('flight/booking_failed/');
                }
            }
        }
    }


    public function booking_failed() {
        unset($_SESSION[session_id()]['flsearchData']);
        unset($_SESSION[session_id()]['Via_data']);
        unset($_SESSION[session_id()]['Via_booking_final']);
        unset($_SESSION[session_id()]['admin_markup']);
        unset($_SESSION[session_id()]['agent_markup']);
        $this->load->view('flight/booking_failed');
    }

    public function thankyou($masterId) {
        unset($_SESSION[session_id()]['flsearchData']);
        unset($_SESSION[session_id()]['Via_data']);
        unset($_SESSION[session_id()]['Via_booking_final']);
        unset($_SESSION[session_id()]['admin_markup']);
        unset($_SESSION[session_id()]['agent_markup']);
        $data['flightDetails'] = $this->Flight_Model->getBookingData($masterId);
        if ($data['flightDetails']->journeyType == 'round_trip') {
            $data['roundDetails'] = $this->Flight_Model->getBookingRoundData($masterId);
        }
        $data['paxDetails'] = $this->Flight_Model->getBookingPaxData($masterId);
        ##################### MAIL TO USER  ##################################
        $to = $data['flightDetails']->user_email;
        $subject = 'Flight Booking Voucher';
        $subject1 = 'Flight Booking Invoice';
        $headers = "From: support@redtagtravels.com\r\n";
        $headers .= "Reply-To: support@redtagtravels.com\r\n";
        $headers .= "CC: support@redtagtravels.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $message = $this->load->view('flight/voucher', $data, true);
        $message1 = $this->load->view('flight/invoice', $data, true);

        mail($to, $subject, $message, $headers);
        mail($to, $subject1, $message1, $headers);

        #######################################################
        $this->load->view('flight/voucher', $data);
    }

}
