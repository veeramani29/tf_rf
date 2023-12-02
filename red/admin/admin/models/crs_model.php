<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Crs_Model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    function getAllCountryList()
    {
        $query = $this->db->query($sql = "select Country from hotelspro_city group by Country order by Country asc");
        if($query->num_rows() > 0)
        {
            $result = $query->result();
        }
        else
            $result = '';
        
        return $result;
    }
    
    function getAllCityListOnCountry($country)
    {
        $query = $this->db->query($sql = "select City from hotelspro_city where Country='".$country."' order by City asc");
        if($query->num_rows() > 0)
        {
            $result = $query->result();
        }
        else
            $result = '';
        
        return $result;
    }
    
    function addHotelData($insertArr)
    {
        $this->db->query($sql="insert into hotel_crs set country='".$insertArr['country']."',
                                                         city='".$insertArr['city']."',
                                                         hotel_name='".mysql_real_escape_string($insertArr['hotel_name'])."',
                                                         hotel_address='".mysql_real_escape_string($insertArr['hotel_address'])."',
                                                         hotel_contact='".mysql_real_escape_string($insertArr['hotel_contact'])."',
                                                         hotel_email='".mysql_real_escape_string($insertArr['hotel_email'])."',
                                                         hotel_latitude='".mysql_real_escape_string($insertArr['hotel_latitude'])."',
                                                         hotel_longitude='".mysql_real_escape_string($insertArr['hotel_longitude'])."',
                                                         on_sale='".mysql_real_escape_string($insertArr['on_sale'])."',
                                                         hotel_description='".mysql_real_escape_string($insertArr['hotel_description'])."',
                                                         star_rating='".mysql_real_escape_string($insertArr['star_rating'])."',
                                                         hotel_amenity='".mysql_real_escape_string($insertArr['hotel_amenity'])."',
                                                         hotel_what_we_know='".mysql_real_escape_string($insertArr['hotel_what_we_know'])."',
                                                         hotel_what_we_love='".mysql_real_escape_string($insertArr['hotel_what_we_love'])."',
                                                         image='".mysql_real_escape_string($insertArr['imagesArray'][0])."'");
        
        if($this->db->affected_rows() > 0)
        {
            $masterId = $this->db->insert_id();
            
            foreach($insertArr['imagesArray'] as $image)
            {
                $this->db->query($sql="insert into hotel_crs_images set master_id='".$masterId."',image='".mysql_real_escape_string($image)."'");
            }
            
            return 'true';
        }
        else
        {
            return 'false';
        }
    }
    
    function getAllCrsHotels()
    {
        $query = $this->db->query($sql = "select * from hotel_crs order by id desc");
        if($query->num_rows() > 0)
        {
            $result = $query->result();
        }
        else
            $result = '';
        
        return $result;
    }

    function changeHotelStatus($id,$status)
    {
        if($status != '2')
        {
            $this->db->query($sql="update hotel_crs set status='".$status."' where id='".$id."'");
        }
        else
        {
            $this->db->query($sql="delete from hotel_crs where id='".$id."'");
        }
    }
    
    function changeHotelRoomStatus($id,$status)
    {
        if($status != '2')
        {
            $this->db->query($sql="update hotel_crs_rooms set status='".$status."' where id='".$id."'");
        }
        else
        {
            $this->db->query($sql="delete from hotel_crs_rooms where id='".$id."'");
        }
    }
    
    function getHotelCrsDataOnId($id)
    {
        $query = $this->db->query($sql = "select * from hotel_crs where id='".$id."'");
        if($query->num_rows() > 0)
        {
            $result = $query->row();
        }
        else
            $result = '';
        
        return $result;
        
    }
    
    function addHotelRoomData($insertArr)
    {
        
        $this->db->query($sql="insert into hotel_crs_rooms set `hotel_id`='".$insertArr['hotel_id']."',
                                                         `room_type`='".$insertArr['room_type']."',
                                                         `room_desc`='".$insertArr['room_desc']."',
                                                         `room_inclusion`='".mysql_real_escape_string($insertArr['room_inclusion'])."',
                                                         `room_price`='".mysql_real_escape_string($insertArr['room_price'])."',
                                                         `from_date`='".mysql_real_escape_string($insertArr['from_date'])."',
                                                         `date_to`='".mysql_real_escape_string($insertArr['date_to'])."',
                                                         `no_of_rooms`='".mysql_real_escape_string($insertArr['no_of_rooms'])."',
                                                         `pax_count`='".mysql_real_escape_string($insertArr['pax_count'])."',
                                                         `image`='".mysql_real_escape_string($insertArr['imagesArray'][0])."'");
        
        if($this->db->affected_rows() > 0)
        {
            return 'true';
        }
        else
        {
            return 'false';
        }
    }
    
    function editHotelRoomData($insertArr)
    {
        
        $this->db->query($sql="update hotel_crs_rooms set `room_type`='".$insertArr['room_type']."',
                                                         `room_inclusion`='".mysql_real_escape_string($insertArr['room_inclusion'])."',
                                                         `room_price`='".mysql_real_escape_string($insertArr['room_price'])."',
                                                         `from_date`='".mysql_real_escape_string($insertArr['from_date'])."',
                                                         `date_to`='".mysql_real_escape_string($insertArr['date_to'])."',
                                                         `no_of_rooms`='".mysql_real_escape_string($insertArr['no_of_rooms'])."',
                                                         `pax_count`='".mysql_real_escape_string($insertArr['pax_count'])."',
                                                         `image`='".mysql_real_escape_string($insertArr['imagesArray'][0])."' where `id`='".$insertArr['room_id']."'");
        
        if($this->db->affected_rows() > 0)
        {
            return 'true';
        }
        else
        {
            return 'false';
        }
    }
    
    function getHotelRoomsOnHotelId($id)
    {
        $query = $this->db->query($sql = "select * from hotel_crs_rooms where hotel_id='".$id."'");
        if($query->num_rows() > 0)
        {
            $result = $query->result();
        }
        else
            $result = '';
        
        return $result;
    }
    
    function getRoomDataOnId($id)
    {
        $query = $this->db->query($sql = "select * from hotel_crs_rooms where id='".$id."'");
        if($query->num_rows() > 0)
        {
            $result = $query->row();
        }
        else
            $result = '';
        
        return $result;
    }
    
    function getHotelCancelPolicy($id)
    {
        $query = $this->db->query($sql = "select cancel_policy from hotel_crs where id='".$id."'");
        if($query->num_rows() > 0)
        {
            $result = $query->row();
        }
        else
            $result = '';
        
        return $result;
    }
    
    function getAllHotelImagesOnId($id)
    {
        $query = $this->db->query($sql = "select image from hotel_crs_images where master_id='".$id."'");
        if($query->num_rows() > 0)
        {
            $result = $query->result();
        }
        else
            $result = '';
        
        return $result;
    }
    
    function editHotelData($insertArr,$hotel_id)
    {
        $this->db->query($sql = "delete from hotel_crs_images where master_id='".$hotel_id."'");
        $this->db->query($sql = "update hotel_crs set image='' where id='".$hotel_id."'");
        $this->db->query($sql="update hotel_crs set country='".$insertArr['country']."',
                                                         city='".$insertArr['city']."',
                                                         hotel_name='".mysql_real_escape_string($insertArr['hotel_name'])."',
                                                         hotel_address='".mysql_real_escape_string($insertArr['hotel_address'])."',
                                                         hotel_contact='".mysql_real_escape_string($insertArr['hotel_contact'])."',
                                                         hotel_email='".mysql_real_escape_string($insertArr['hotel_email'])."',
                                                         hotel_latitude='".mysql_real_escape_string($insertArr['hotel_latitude'])."',
                                                         hotel_longitude='".mysql_real_escape_string($insertArr['hotel_longitude'])."',
                                                         on_sale='".mysql_real_escape_string($insertArr['on_sale'])."',
                                                         hotel_description='".mysql_real_escape_string($insertArr['hotel_description'])."',
                                                         star_rating='".mysql_real_escape_string($insertArr['star_rating'])."',
                                                         hotel_amenity='".mysql_real_escape_string($insertArr['hotel_amenity'])."',
                                                         hotel_what_we_know='".mysql_real_escape_string($insertArr['hotel_what_we_know'])."',
                                                         hotel_what_we_love='".mysql_real_escape_string($insertArr['hotel_what_we_love'])."',
                                                         image='".mysql_real_escape_string($insertArr['imagesArray'][0])."' where id='".$hotel_id."'");
        
        
        //echo '<pre >';print_r($insertArr["imagesArray"]);die;
            
            
            foreach($insertArr["imagesArray"] as $image)
            {
                $this->db->query($sql="insert into hotel_crs_images set master_id='".$hotel_id."',image='".mysql_real_escape_string($image)."'");
            }
            
            return 'true';
       
    }


}
