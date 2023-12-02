<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hotel_Model extends CI_Model {

    function getCityDetailsOnName($city, $country, $state) {
        if ($state == '') {
            $query = $this->db->query($sql = "select region_id as locId,country_name as conId from roomsxml_city_list where region_name='" . $city . "' and country_name='" . $country . "'");
            $query1 = $this->db->query($sql = "select city_code as locId,country_code as conId from rezlive_city_list where name='" . $city . "' and country_name='" . $country . "'");
            $query2 = $this->db->query($sql = "select city_code as locId,country_code as conId from tacenter_city_list where city_name='" . $city . "' and country_name='" . $country . "'");
        } else {
            $query = $this->db->query($sql = "select region_name as locId,country_name as conId from roomsxml_city_list where region_name='" . $city . "' and country_name='" . $country . "' and state='" . $state . "'");
            $query1 = $this->db->query($sql = "select city_code as locId,country_code as conId from rezlive_city_list where name='" . $city . "' and country_name='" . $country . "'");
            $query2 = $this->db->query($sql = "select city_code as locId,country_code as conId from tacenter_city_list where city_name='" . $city . "' and country_name='" . $country . "'");
        }
        $res = '';
        if ($query->num_rows() > 0) {
            $data = $query->row();
            $res[0] = array('locId' => $data->locId, 'conId' => $data->conId);
        } else {
            $res[0] = array('locId' => '', 'conId' => '');
        }
        if ($query1->num_rows() > 0) {
            $data1 = $query1->row();
            $res[1] = array('locId' => $data1->locId, 'conId' => $data1->conId);
        } else {
            $res[1] = array('locId' => '', 'conId' => '');
        }
        if ($query2->num_rows() > 0) {
            $data2 = $query2->row();
            $res[2] = array('locId' => $data2->locId, 'conId' => $data2->conId);
        } else {
            $res[2] = array('locId' => '', 'conId' => '');
        }
        return $res;
    }

    function getCityDetailsOnNameHotelspro($city) {
        $this->db->select('*');
        $this->db->from('hotelspro_city');
        $this->db->where('City', $city);
        $query = $this->db->get();

        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->row();
        }
    }

    function get_currecy_details($currency) {
        $que = "select * from  currency_converter where country='$currency' ";
        $query = $this->db->query($que);
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->row();
        }
    }

    public function moneytoint($str) {
        $amount = preg_replace("/([^0-9\\.])/i", "", $str);
        return $amount;
    }

    function cus_number_format($value) {
        $value1 = number_format($value, 2);
        return $this->moneytoint($value1);
    }

    function getBookingData($masterId) {
        $query = $this->db->query($sql = "select a.*,b.*,c.* from hotel_booking_master as a left outer join hotel_booking_room_details as b on a.id=b.master_id left outer join hotel_booking_customer_details as c on a.id=c.master_id where a.id='" . $masterId . "'");
        if ($query->num_rows() > 0) {
            $data = $query->row();
        } else
            $data = '';

        return $data;
    }

    function getBookingPaxData($masterId) {
        $query = $this->db->query($sql = "select * from hotel_booking_pax_details where master_id='" . $masterId . "'");
        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else
            $data = '';

        return $data;
    }

    function getBookingHotelData($hotel_code) {
        $qry = $this->db->query($sql = "select a.*,b.*,c.* from hotelspro_hotels_list as a left outer join hotelspro_hotels_desc as b on a.HotelCode=b.HotelCode left outer join hotelspro_hotels_amenities as c on a.HotelCode=c.HotelCode where a.HotelCode='" . $hotel_code . "'");
        if ($qry->num_rows() > 0) {
            $data = $qry->row();
        } else
            $data = '';

        return $data;
    }

    function addBookingDataRoomsxml($apiId, $postData, $details, $room_id, $userId, $roomDetails, $totalPrice, $totalOrgPrice, $searchData, $cur_val, $admin_markup, $agent_markup) {
        if ($cur_val != 0) {
            $totalPrice = $totalPrice * number_format((float) $cur_val, 2, '.', '');
        }
        if ($admin_markup['type'] == 'fixed') {
            $mTyp = $searchData['type'];
            $admMark = $admin_markup[$mTyp];
            $totalPrice = $totalPrice + $admMark;
        } else {
            $mTyp = $searchData['type'];
            $admMark = (($admin_markup[$mTyp] / 100) * $totalPrice);
            $totalPrice = ($totalPrice + $admMark);
        }

        if ($agent_markup['type'] == 'fixed') {
            $amTyp = $searchData['type'];
            $agntmark = $agent_markup[$amTyp];
            $totalPrice = $totalPrice + $agntmark;
        } else {
            $amTyp = $searchData['type'];
            $agntmark = (($agent_markup[$amTyp] / 100) * $totalPrice);
            $totalPrice = ($totalPrice + $agntmark);
        }

        $refId = 'RDT' . date('YmdHis');
        $this->db->trans_start();
        $this->db->query($sql = "insert into hotel_booking_master set api='roomsxml', ref_id = '" . $refId . "',
                                                                    api_ref_id='XXXXXXXXX',
                                                                    confirmation_number='xxxxxxxx',
                                                                    user_id = '" . $_SESSION['user']['user_id'] . "',
                                                                    user_type='" . $_SESSION['user']['user_type'] . "',
                                                                    xml_price='" . $totalOrgPrice . "',
                                                                    price='" . $totalPrice . "',
                                                                    admin_markup='" . $admMark . "',
                                                                    agent_markup='" . $agntmark . "',
                                                                    sub_agent_markup='',
                                                                    currency_val='" . $cur_val . "',
                                                                    booking_status='Pending',
                                                                    payment_status='Pending',
                                                                    location_code='" . $searchData['rmxml_code'] . "',
                                                                    location='" . $searchData['dest_city'] . "',
                                                                    room_count='" . $searchData['room_count'] . "',
                                                                    cin='" . $searchData['cin'] . "',
                                                                    cout='" . $searchData['cout'] . "',
                                                                    adult='" . $searchData['adult_count'] . "',
                                                                    child='" . $searchData['child_count'] . "'");
        $master_id = $this->db->insert_id();

        $this->db->query($sql = "insert into hotel_booking_room_details set master_id = '" . $master_id . "',
                                                                    hotel_code='" . $details['hotel_id'] . "',
                                                                    hotel_name='" . $details['name'] . "',
                                                                    room_category='" . $details['room'][$room_id]['room_type_text'] . "',
                                                                    inclusion='" . $details['room'][$room_id]['meal_type_text'] . "',
                                                                    cancellation_policy='xxxxxxxxx'");

        for ($r = 0; $r < $searchData['room_count']; $r++) {
            for ($i = 0; $i < count($postData['adulttitle'][$r]); $i++) {
                $this->db->query($sql = "insert into hotel_booking_pax_details set master_id = '" . $master_id . "',
                                                                        title='" . $postData['adulttitle'][$r][$i] . "',
                                                                        first_name='" . $postData['adultFname'][$r][$i] . "',
                                                                        last_name='" . $postData['adultLname'][$r][$i] . "',
                                                                        type='Adult',
                                                                        age='0'");
            }

            if (isset($postData['childtitle'][$r])) {
                for ($i = 0; $i < count($postData['childtitle'][$r]); $i++) {
                    $this->db->query($sql = "insert into hotel_booking_pax_details set master_id = '" . $master_id . "',
                                                                            title='" . $postData['childtitle'][$r][$i] . "',
                                                                            first_name='" . $postData['childFname'][$r][$i] . "',
                                                                            last_name='" . $postData['childLname'][$r][$i] . "',
                                                                            type='Child',
                                                                            age='" . $searchData['child_age'][$r][$i] . "'");
                }
            }
        }
        $this->db->query($sql = "insert into hotel_booking_customer_details set master_id = '" . $master_id . "',
                                                                    title='" . $postData['adulttitle'][0][0] . "',
                                                                    first_name='" . $postData['adultFname'][0][0] . "',
                                                                    last_name='" . $postData['adultLname'][0][0] . "',
                                                                    address='',
                                                                    city='',
                                                                    pincode='',
                                                                    state='',
                                                                    country='',
                                                                    email='" . trim($postData['user_email']) . "',
                                                                    mobile='" . trim($postData['user_mobile']) . "'");
        $this->db->trans_complete();
        return array('master_id' => $master_id, 'cur_val' => $cur_val, 'admin_markup' => $admMark, 'agent_markup' => $agntmark, 'total_price' => $totalPrice);
    }

    function addBookingDataRezlive($apiId, $postData, $details, $room_id, $userId, $roomDetails, $totalPrice, $totalOrgPrice, $searchData, $cur_val, $admin_markup, $agent_markup) {
        if ($cur_val != 0) {
            $totalPrice = $totalPrice * number_format((float) $cur_val, 2, '.', '');
        }
        if ($admin_markup['type'] == 'fixed') {
            $mTyp = $searchData['type'];
            $admMark = $admin_markup[$mTyp];
            $totalPrice = $totalPrice + $admMark;
        } else {
            $mTyp = $searchData['type'];
            $admMark = (($admin_markup[$mTyp] / 100) * $totalPrice);
            $totalPrice = ($totalPrice + $admMark);
        }

        if ($agent_markup['type'] == 'fixed') {
            $amTyp = $searchData['type'];
            $agntmark = $agent_markup[$amTyp];
            $totalPrice = $totalPrice + $agntmark;
        } else {
            $amTyp = $searchData['type'];
            $agntmark = (($agent_markup[$amTyp] / 100) * $totalPrice);
            $totalPrice = ($totalPrice + $agntmark);
        }

        $refId = 'RDT' . date('YmdHis');
        $this->db->trans_start();
        $this->db->query($sql = "insert into hotel_booking_master set api='rezlive', ref_id = '" . $refId . "',
                                                                    api_ref_id='XXXXXXXXX',
                                                                    confirmation_number='xxxxxxxx',
                                                                    user_id = '" . $_SESSION['agent']['user_id'] . "',
                                                                    user_type='" . $_SESSION['agent']['user_type'] . "',
                                                                    xml_price='" . $totalOrgPrice . "',
                                                                    price='" . $totalPrice . "',
                                                                    admin_markup='" . $admMark . "',
                                                                    agent_markup='" . $agntmark . "',
                                                                    sub_agent_markup='',
                                                                    currency_val='" . $cur_val . "',
                                                                    booking_status='Pending',
                                                                    payment_status='Pending',
                                                                    location_code='" . $searchData['rez_code'] . "',
                                                                    location='" . $searchData['dest_city'] . "',
                                                                    room_count='" . $searchData['room_count'] . "',
                                                                    cin='" . $searchData['cin'] . "',
                                                                    cout='" . $searchData['cout'] . "',
                                                                    adult='" . $searchData['adult_count'] . "',
                                                                    child='" . $searchData['child_count'] . "'");
        $master_id = $this->db->insert_id();
        if ($details['rooms'][$room_id]['RoomDescription'] != '' && $details['rooms'][$room_id]['TermsAndConditions'] = !'') {
            $roomdesc_terms = $details['rooms'][$room_id]['RoomDescription'] . " " . $details['rooms'][$room_id]['TermsAndConditions'];
        } elseif ($details['rooms'][$room_id]['RoomDescription'] != '' && $details['rooms'][$room_id]['TermsAndConditions'] == '') {
            $roomdesc_terms = $details['rooms'][$room_id]['RoomDescription'];
        } elseif ($details['rooms'][$room_id]['TermsAndConditions'] != '' && $details['rooms'][$room_id]['RoomDescription'] == '') {
            $roomdesc_terms = $details['rooms'][$room_id]['TermsAndConditions'];
        }
        $this->db->query($sql = "insert into hotel_booking_room_details set master_id = '" . $master_id . "',
                                                                    hotel_code='" . $details['hotel_id'] . "',
                                                                    hotel_name='" . $details['name'] . "',
                                                                    room_category='" . $details['rooms'][$room_id]['Type'] . "',
                                                                    inclusion='" . $details['rooms'][$room_id]['BoardBasis'] . "',
                                                                    room_desc='" . $roomdesc_terms . "',
                                                                    room_terms_con='" . $roomDetails['TermsAndConditions'] . "',
                                                                    cancellation_policy_info='" . $roomDetails['cancelInfo'] . "',
                                                                    cancellation_policy='" . mysql_real_escape_string($roomDetails['cancelData']) . "'");

        for ($r = 0; $r < $searchData['room_count']; $r++) {
            for ($i = 0; $i < count($postData['adulttitle'][$r]); $i++) {
                $this->db->query($sql = "insert into hotel_booking_pax_details set master_id = '" . $master_id . "',
                                                                        title='" . $postData['adulttitle'][$r][$i] . "',
                                                                        first_name='" . $postData['adultFname'][$r][$i] . "',
                                                                        last_name='" . $postData['adultLname'][$r][$i] . "',
                                                                        type='Adult',
                                                                        age='0'");
            }

            if (isset($postData['childtitle'][$r])) {
                for ($i = 0; $i < count($postData['childtitle'][$r]); $i++) {
                    $this->db->query($sql = "insert into hotel_booking_pax_details set master_id = '" . $master_id . "',
                                                                            title='" . $postData['childtitle'][$r][$i] . "',
                                                                            first_name='" . $postData['childFname'][$r][$i] . "',
                                                                            last_name='" . $postData['childLname'][$r][$i] . "',
                                                                            type='Child',
                                                                            age='" . $searchData['child_age'][$r][$i] . "'");
                }
            }
        }
        $this->db->query($sql = "insert into hotel_booking_customer_details set master_id = '" . $master_id . "',
                                                                    title='" . $postData['adulttitle'][0][0] . "',
                                                                    first_name='" . $postData['adultFname'][0][0] . "',
                                                                    last_name='" . $postData['adultLname'][0][0] . "',
                                                                    address='',
                                                                    city='',
                                                                    pincode='',
                                                                    state='',
                                                                    country='',
                                                                    email='" . trim($postData['user_email']) . "',
                                                                    mobile='" . trim($postData['user_mobile']) . "'");
        $this->db->trans_complete();
        return array('master_id' => $master_id, 'cur_val' => $cur_val, 'admin_markup' => $admMark, 'agent_markup' => $agntmark, 'total_price' => $totalPrice);
    }

    function addBookingDataTacenter($apiId, $postData, $details, $room_id, $userId, $totalPrice, $totalOrgPrice, $searchData, $cur_val, $admin_markup, $agent_markup) {
        //echo '<pre />';print_r($details['room'][$room_id]);die;
        if ($admin_markup['type'] == 'fixed') {
            $mTyp = $searchData['type'];
            $admMark = $admin_markup[$mTyp];
            $totalPrice = $totalPrice + $admMark;
        } else {
            $mTyp = $searchData['type'];
            $admMark = (($admin_markup[$mTyp] / 100) * $totalPrice);
            $totalPrice = ($totalPrice + $admMark);
        }

        if ($agent_markup['type'] == 'fixed') {
            $amTyp = $searchData['type'];
            $agntmark = $agent_markup[$amTyp];
            $totalPrice = $totalPrice + $agntmark;
        } else {
            $amTyp = $searchData['type'];
            $agntmark = (($agent_markup[$amTyp] / 100) * $totalPrice);
            $totalPrice = ($totalPrice + $agntmark);
        }

        $refId = 'RDT' . date('YmdHis');
        $this->db->trans_start();
        $this->db->query($sql = "insert into hotel_booking_master set api='tacenter', ref_id = '" . $refId . "',
                                                                    api_ref_id='XXXXXXXXX',
                                                                    confirmation_number='xxxxxxxx',
                                                                    user_id = '" . $_SESSION['agent']['user_id'] . "',
                                                                    user_type='" . $_SESSION['agent']['user_type'] . "',
                                                                    xml_price='" . $totalOrgPrice . "',
                                                                    price='" . $totalPrice . "',
                                                                    admin_markup='" . $admMark . "',
                                                                    agent_markup='" . $agntmark . "',
                                                                    sub_agent_markup='',
                                                                    currency_val='" . $cur_val . "',
                                                                    booking_status='Pending',
                                                                    payment_status='Pending',
                                                                    location_code='" . $searchData['ta_code'] . "',
                                                                    location='" . $searchData['dest_city'] . "',
                                                                    room_count='" . $searchData['room_count'] . "',
                                                                    cin='" . $searchData['cin'] . "',
                                                                    cout='" . $searchData['cout'] . "',
                                                                    adult='" . $searchData['adult_count'] . "',
                                                                    child='" . $searchData['child_count'] . "'");
        $master_id = $this->db->insert_id();

        $this->db->query($sql = "insert into hotel_booking_room_details set master_id = '" . $master_id . "',
                                                                    hotel_code='" . $details['hotel_id'] . "',
                                                                    hotel_name='" . $details['name'] . "',
                                                                    room_category='" . $details['room'][$room_id]['RoomName'] . "',
                                                                    inclusion='" . (isset($details['room'][$room_id]['inc'][0]) ? $details['room'][$room_id]['inc'][0]['Inclusion'] : '') . "',
                                                                    cancellation_policy='xxxxxxxxx'");

        for ($r = 0; $r < $searchData['room_count']; $r++) {
            for ($i = 0; $i < count($postData['adulttitle'][$r]); $i++) {
                $this->db->query($sql = "insert into hotel_booking_pax_details set master_id = '" . $master_id . "',
                                                                        title='" . $postData['adulttitle'][$r][$i] . "',
                                                                        first_name='" . $postData['adultFname'][$r][$i] . "',
                                                                        last_name='" . $postData['adultLname'][$r][$i] . "',
                                                                        type='Adult',
                                                                        age='0'");
            }

            if (isset($postData['childtitle'][$r])) {
                for ($i = 0; $i < count($postData['childtitle'][$r]); $i++) {
                    $this->db->query($sql = "insert into hotel_booking_pax_details set master_id = '" . $master_id . "',
                                                                            title='" . $postData['childtitle'][$r][$i] . "',
                                                                            first_name='" . $postData['childFname'][$r][$i] . "',
                                                                            last_name='" . $postData['childLname'][$r][$i] . "',
                                                                            type='Child',
                                                                            age='" . $searchData['child_age'][$r][$i] . "'");
                }
            }
        }
        $this->db->query($sql = "insert into hotel_booking_customer_details set master_id = '" . $master_id . "',
                                                                    title='" . $postData['adulttitle'][0][0] . "',
                                                                    first_name='" . $postData['adultFname'][0][0] . "',
                                                                    last_name='" . $postData['adultLname'][0][0] . "',
                                                                    address='',
                                                                    city='',
                                                                    pincode='',
                                                                    state='',
                                                                    country='',
                                                                    email='" . trim($postData['user_email']) . "',
                                                                    mobile='" . trim($postData['user_mobile']) . "'");
        $this->db->trans_complete();
        return array('master_id' => $master_id, 'cur_val' => $cur_val, 'admin_markup' => $admMark, 'agent_markup' => $agntmark, 'total_price' => $totalPrice);
    }

    function getHotelFilterDataOnId($codev1) {
        $qry = $this->db->query($sql = "select a.HotelArea,b.PAmenities from hotelspro_hotels_list as a left outer join hotelspro_hotels_amenities as b on a.HotelCode=b.HotelCode where a.HotelCode='" . $codev1 . "'");
        if ($qry->num_rows() > 0) {
            $data = $qry->row();
        } else
            $data = '';

        return $data;
    }

    function getPesoCurrencyOnUsd() {
        $query = $this->db->query($sql = "select value from currency where currency_code='PHP'");
        if ($query->num_rows() > 0) {
            $res = $query->row();
            $image = $res->value;
        } else {
            $image = '0';
        }
        return $image;
    }

    function getUserDataOnId($id) {
        $qry = $this->db->query($sql = "select * from agent_info where user_id='" . $id . "'");
        if ($qry->num_rows() > 0) {
            $data = $qry->row();
        } else
            $data = '';

        return $data;
    }

    function deleteFailedHotelData($masterId) {
        $this->db->query($sql = "delete from hotel_booking_master where id='" . $masterId . "'");
    }

    function getPhpToUsdCurrency() {
        $query = $this->db->query($sql = 'select php from currency_converter where id=1');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            $cur = $data->php;
        } else {
            $cur = 0;
        }

        return $cur;
    }

    function getTacenterHotelInformation($hotelId) {
        $query = $this->db->query($sql = "select * from tacenter_hotel_list where HotelId='" . $hotelId . "'");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }

    function getRezliveHotelDesc($id) {
        $query = $this->db->query($sql = "select * from rezlive_hotel_desc where hotel_id='" . $id . "'");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }

    function getRezliveHotelInformation($hotelId) {
        $query = $this->db->query($sql = "select * from rezlive_hotel_list where HotelCode='" . $hotelId . "'");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }

    function getRezliveHotelDetails($hotelId) {
        $query = $this->db->query($sql = "select HotelAddress from rezlive_hotel_list where HotelCode='" . $hotelId . "'");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }

}
