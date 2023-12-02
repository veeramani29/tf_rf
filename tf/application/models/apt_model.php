<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------|
| Author: Provab Technosoft Pvt Ltd.									   |
|--------------------------------------------------------------------------|
| Developer: Provab											   |
| Started Date: 2014-09-11T11:45:00										   |
| Ended Date:  										   					   |
|--------------------------------------------------------------------------|
*/

class Apt_Model extends CI_Model {
	
	public function insert_cart_apartment($cart_apartment){
    	$this->db->insert('cart_apartment', $cart_apartment);
    	return $this->db->insert_id();
    }

    public function insert_cart_global($cart_global){
        $this->db->insert('cart_global', $cart_global);
        return $this->db->insert_id();
    }

    public function getBookingTemp($cart_global_id){
        $this->db->where('cart_id',$cart_global_id);
        $this->db->join('cart_apartment','cart_apartment.ID = cart_global.ref_id');
        $data = $this->db->get('cart_global')->row();
        $this->db->join('cart_apartment','cart_apartment.ID = cart_global.ref_id');
        if($data->USER_TYPE == '3'){
            $this->db->join('b2c', 'b2c.user_id = cart_apartment.USER_ID');
        }else if($data->USER_TYPE == '2'){
            $this->db->join('b2b', 'b2b.user_id = cart_apartment.USER_ID');
        }
        $this->db->where('cart_id',$cart_global_id);
        return $this->db->get('cart_global');
    }

    public function clearCart($cart_apartment_id){
        $this->db->where('ID',$cart_apartment_id);
        $this->db->delete('cart_apartment');
        $this->db->where('ref_id',$cart_apartment_id);
        $this->db->delete('cart_global');
    }

    public function insert_booking_apartment($booking_apartment){
        $this->db->insert('booking_apartment', $booking_apartment);
        return $this->db->insert_id();
    }

    public function getBookingApartmentTemp($booking_apartment_id){
        $this->db->where('ID',$booking_apartment_id);
        return $this->db->get('booking_apartment');
    }

    public function CheckDuplicateBooking($booking_apartment_id){
        $this->db->where('ref_id',$booking_apartment_id);
        return $this->db->get('booking_global');
    }



    public function Booking_Global($booking){
        $this->db->insert('booking_global', $booking);
        return $this->db->insert_id();
    }

    

    public function Update_Booking_Global($booking_temp_id, $update_booking){
        $this->db->where('ref_id',$booking_temp_id);
        $this->db->update('booking_global', $update_booking);
    }

    public function getBooking($booking_no){
        $this->db->where('pnr_no',$booking_no);
        return $this->db->get('booking_global');
    }

    public function getAllKigoCountries(){
    	return $this->db->get('kigo_countries');
    }

    public function is_signup($user_id){
    	$this->db->select('password');
    	$this->db->where('user_id',$user_id);
    	return $this->db->get('b2c');
    }

    public function UpdateBookingTemp($booking_temp_id, $checkout){
        $this->db->where('ID',$booking_temp_id);
        $this->db->update('apartment_booking_cart', $checkout);
    }

    
}

