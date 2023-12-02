<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hotel_Model extends CI_Model {
    
    function getCityDetailsOnName($city,$country,$state)
    {
        if($state == ''){
            $query = $this->db->query($sql = "select IFNULL((select region_id from roomsxml_city_list where region_name='".$city."' and country_name='".$country."'),'') as locId union
                                             select IFNULL((select DestinationId from hotelspro_city where City='".$city."' and Country='".$country."'),'') as locId");
        }else{
            $query = $this->db->query($sql = "select IFNULL((select region_id from roomsxml_city_list where region_name='".$city."' and country_name='".$country."' and state='".$state."'),'') as locId union
                                              select IFNULL((select DestinationId from hotelspro_city where City='".$city."' and Country='".$country."' and State='".$state."'),'') as locId");
        }
        
        if($query->num_rows() > 0){
            $data = $query->result();
        }
        else
        {
            $data = '';
        }
        return $data;
    }
    
    function getCityDetailsOnNameHotelspro($city)
    {
            $this->db->select('*');
            $this->db->from('hotelspro_city');
            $this->db->where('City',$city);
            $query = $this->db->get();

            if($query->num_rows() == '' )
            {
               return '';   
            }
            else
            {
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
    
     function addBookingData($apiId,$postData,$details,$room_data,$userId)
    {
        $refId = 'RKL'.date('YmdHis');
        $this->db->query($sql="insert into hotel_booking_master set api='hotelspro', ref_id = '".$refId."',
                                                                    api_ref_id='XXXXXXXXX',
                                                                    user_id = '".$_SESSION['agent']['user_id']."',
                                                                    user_type='".$_SESSION['agent']['user_type']."',
                                                                    xml_price='".$room_data->booking_price_xml."',
                                                                    price='".$room_data->total_room_cost."',
                                                                    admin_markup='".$_SESSION['admin_markup']."',
                                                                    agent_markup='".$_SESSION['agent_markup']."',
                                                                    sub_agent_markup='".$_SESSION['sub_agent_markup']."',
                                                                    booking_status='Pending',
                                                                    payment_satus='Pending',
                                                                    location_code='".$_SESSION['agent_city_code']."',
                                                                    location='".$_SESSION['agent_city']."',
                                                                    room_count='".$_SESSION['agent_room_count']."',
                                                                    cin='".$_SESSION['agent_cin']."',
                                                                    cout='".$_SESSION['agent_cout']."',
                                                                    adult='".$_SESSION['agent_adult_count']."',
                                                                    child='".$_SESSION['agent_child_count']."'");
        $master_id = $this->db->insert_id();
        
        $this->db->query($sql="insert into hotel_booking_room_details set master_id = '".$master_id."',
                                                                    hotel_code='".$details['hotel_code']."',
                                                                    room_category='".$room_data->room_category."',
                                                                    inclusion='".$room_data->inclusion."',
                                                                    cancellation_policy='xxxxxxxxx'");
        
        for($i=0;$i<count($postData['adulttitle']);$i++)
        {
            $this->db->query($sql="insert into hotel_booking_pax_details set master_id = '".$master_id."',
                                                                    title='".$postData['adulttitle'][$i]."',
                                                                    first_name='".$postData['adultFname'][$i]."',
                                                                    last_name='".$postData['adultLname'][$i]."',
                                                                    type='Adult',
                                                                    age='0'");
        }
        
        if(isset($postData['childtitle']))
        {
            for($i=0;$i<count($postData['childtitle']);$i++)
            {
                $this->db->query($sql="insert into hotel_booking_pax_details set master_id = '".$master_id."',
                                                                        title='".$postData['childtitle'][$i]."',
                                                                        first_name='".$postData['childFname'][$i]."',
                                                                        last_name='".$postData['childLname'][$i]."',
                                                                        type='Child',
                                                                        age='".$postData['childage'][$i]."'");
            }
        }
        
        $this->db->query($sql="insert into hotel_booking_customer_details set master_id = '".$master_id."',
                                                                    title='".$postData['user_title']."',
                                                                    first_name='".trim($postData['user_fname'])."',
                                                                    last_name='".trim($postData['user_lname'])."',
                                                                    address='".trim($postData['user_address'])."',
                                                                    city='".trim($postData['user_city'])."',
                                                                    pincode='".trim($postData['user_pincode'])."',
                                                                    state='".trim($postData['user_pincode'])."',
                                                                    country='".trim($postData['user_country'])."',
                                                                    email='".trim($postData['user_email'])."',
                                                                    mobile='".trim($postData['user_mobile'])."'");
        return $master_id;
    }
    
    function registerWalkingUser($postData)
    {
        $password = 'RKL'.rand(1,9999999);
        $this->db->query($sql="insert into agent_info set user_email='".trim($postData['user_email'])."',
                                                         user_password='".$password."',
                                                         title='".$postData['user_title']."',
                                                         first_name='".trim($postData['user_fname'])."',
                                                         last_name='".trim($postData['user_lname'])."',
                                                         mobile_no='".trim($postData['user_mobile'])."',
                                                         address='".trim($postData['user_address'])."',
                                                         pin_code='".trim($postData['user_pincode'])."',
                                                         city='".trim($postData['user_city'])."',
                                                         state='".trim($postData['user_pincode'])."',
                                                         country='".trim($postData['user_country'])."',
                                                         register_date='".date('Y-m-d H:i:s')."',
                                                         status='1'");
        $id=$this->db->insert_id();
        $_SESSION['agent_user']['email'] = trim($postData['user_email']);
        $_SESSION['agent_user']['uid'] = $id;
        $_SESSION['agent_user']['first_name'] = trim($postData['user_fname']);
        $_SESSION['agent_user']['last_name'] = trim($postData['user_lname']);
        
        return $password;
    }
    
    function getBookingData($masterId)
    {
        $query = $this->db->query($sql="select a.*,b.*,c.* from hotel_booking_master as a left outer join hotel_booking_room_details as b on a.id=b.master_id left outer join hotel_booking_customer_details as c on a.id=c.master_id where a.id='".$masterId."'");
        if($query->num_rows() > 0)
        {
            $data = $query->row();
        }
        else $data = '';
        
        return $data;
    }
    
    function getBookingPaxData($masterId)
    {
        $query = $this->db->query($sql="select * from hotel_booking_pax_details where master_id='".$masterId."'");
        if($query->num_rows() > 0)
        {
            $data = $query->result();
        }
        else
            $data = '';
        
        return $data;
    }
    
    function getBookingHotelData($hotel_code)
    {
        $qry = $this->db->query($sql="select a.*,b.*,c.* from hotelspro_hotels_list as a left outer join hotelspro_hotels_desc as b on a.HotelCode=b.HotelCode left outer join hotelspro_hotels_amenities as c on a.HotelCode=c.HotelCode where a.HotelCode='".$hotel_code."'");
        if($qry->num_rows() > 0)
        {
            $data= $qry->row();
        }
        else
            $data = '';
        
        return $data;
    }
    
    function addBookingDataRoomsxml($apiId,$postData,$details,$room_id,$userId,$roomDetails,$totalPrice,$totalOrgPrice,$searchData,$cur_val,$admin_markup,$agent_markup)
    {
        if($cur_val != 0){ $totalPrice = $totalPrice*number_format((float)$cur_val, 2, '.', ''); }
        if($admin_markup['type'] == 'fixed'){
            $mTyp = $searchData['type'];
            $admMark = $admin_markup[$mTyp];
            $totalPrice = $totalPrice+$admMark;
        } else {
            $mTyp = $searchData['type'];
            $admMark = (($admin_markup[$mTyp]/100)*$totalPrice);
            $totalPrice = ($totalPrice+$admMark);
        }

        if($agent_markup['type'] == 'fixed'){
            $amTyp = $searchData['type'];
            $agntmark = $agent_markup[$amTyp];
            $totalPrice = $totalPrice+$agntmark;
        } else {
            $amTyp = $searchData['type'];
            $agntmark = (($agent_markup[$amTyp]/100)*$totalPrice);
            $totalPrice = ($totalPrice+$agntmark);
        }
        
        $refId = 'RDT'.date('YmdHis');
        $this->db->trans_start();
        $this->db->query($sql="insert into hotel_booking_master set api='roomsxml', ref_id = '".$refId."',
                                                                    api_ref_id='XXXXXXXXX',
                                                                    confirmation_number='xxxxxxxx',
                                                                    user_id = '".$_SESSION['user']['user_id']."',
                                                                    user_type='".$_SESSION['user']['user_type']."',
                                                                    xml_price='".$totalOrgPrice."',
                                                                    price='".$totalPrice."',
                                                                    admin_markup='".$admMark."',
                                                                    agent_markup='".$agntmark."',
                                                                    sub_agent_markup='',
                                                                    currency_val='".$cur_val."',
                                                                    booking_status='Pending',
                                                                    payment_status='Pending',
                                                                    location_code='".$searchData['rmxml_code']."',
                                                                    location='".$searchData['dest_city']."',
                                                                    room_count='".$searchData['room_count']."',
                                                                    cin='".$searchData['cin']."',
                                                                    cout='".$searchData['cout']."',
                                                                    adult='".$searchData['adult_count']."',
                                                                    child='".$searchData['child_count']."'");
        $master_id = $this->db->insert_id();
        
        $this->db->query($sql="insert into hotel_booking_room_details set master_id = '".$master_id."',
                                                                    hotel_code='".$details['hotel_id']."',
                                                                    hotel_name='".$details['name']."',
                                                                    room_category='".$details['room'][$room_id]['room_type_text']."',
                                                                    inclusion='".$details['room'][$room_id]['meal_type_text']."',
                                                                    cancellation_policy='xxxxxxxxx'");
        
        for($r=0;$r<$searchData['room_count'];$r++)
        {
            for($i=0;$i<count($postData['adulttitle'][$r]);$i++)
            {
                $this->db->query($sql="insert into hotel_booking_pax_details set master_id = '".$master_id."',
                                                                        title='".$postData['adulttitle'][$r][$i]."',
                                                                        first_name='".$postData['adultFname'][$r][$i]."',
                                                                        last_name='".$postData['adultLname'][$r][$i]."',
                                                                        type='Adult',
                                                                        age='0'");
            }

            if(isset($postData['childtitle'][$r]))
            {
                for($i=0;$i<count($postData['childtitle'][$r]);$i++)
                {
                    $this->db->query($sql="insert into hotel_booking_pax_details set master_id = '".$master_id."',
                                                                            title='".$postData['childtitle'][$r][$i]."',
                                                                            first_name='".$postData['childFname'][$r][$i]."',
                                                                            last_name='".$postData['childLname'][$r][$i]."',
                                                                            type='Child',
                                                                            age='".$searchData['child_age'][$r][$i]."'");
                }
            }
        }
        $this->db->query($sql="insert into hotel_booking_customer_details set master_id = '".$master_id."',
                                                                    title='".$postData['adulttitle'][0][0]."',
                                                                    first_name='".$postData['adultFname'][0][0]."',
                                                                    last_name='".$postData['adultLname'][0][0]."',
                                                                    address='',
                                                                    city='',
                                                                    pincode='',
                                                                    state='',
                                                                    country='',
                                                                    email='".trim($postData['user_email'])."',
                                                                    mobile='".trim($postData['user_mobile'])."'");
        $this->db->trans_complete();
        return array('master_id'=>$master_id,'cur_val'=>$cur_val,'admin_markup'=>$admMark,'agent_markup'=>$agntmark,'total_price'=>$totalPrice);
    }
    
    function getHotelFilterDataOnId($codev1)
    {
        $qry = $this->db->query($sql="select a.HotelArea,b.PAmenities from hotelspro_hotels_list as a left outer join hotelspro_hotels_amenities as b on a.HotelCode=b.HotelCode where a.HotelCode='".$codev1."'");
        if($qry->num_rows() > 0)
        {
            $data= $qry->row();
        }
        else
            $data = '';
        
        return $data;
    }
    
     function getPesoCurrencyOnUsd(){
        $query = $this->db->query($sql = "select value from currency where currency_code='PHP'");
        if($query->num_rows() > 0){
            $res = $query->row();
            $image = $res->value;
        } else {
            $image ='0';
        }
        return $image;
    }
    
    function getUserDataOnId($id){
        $qry = $this->db->query($sql="select * from agent_info where user_id='".$id."'");
        if($qry->num_rows() > 0)
        {
            $data= $qry->row();
        }
        else
            $data = '';
        
        return $data;
    }
    
    function deleteFailedHotelData($masterId){
        $this->db->query($sql = "delete from hotel_booking_master where id='".$masterId."'");
    }
    
    function getPhpToUsdCurrency(){
        $query = $this->db->query($sql = 'select php from currency_converter where id=1');
        if($query->num_rows() > 0){
            $data = $query->row();
            $cur = $data->php;
        } else {
            $cur = 0;
        }
        
        return $cur;
    }
    
}
