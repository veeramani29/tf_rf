<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------|
| Author: Provab Technosoft Pvt Ltd.									   |
|--------------------------------------------------------------------------|
| Developer: Provab											   |
| Started Date: 2014-11-06T16:450:00									   |
| Ended Date:  										   					   |
|--------------------------------------------------------------------------|
*/

class Car_Model extends CI_Model {
	public function get_vendor_details($code){
        $this->db->where('alternate_vendor_code', $code);
        $data = $this->db->get('car_vendors')->row();
        return $data->short_name;
    }

    public function insert_cart_car($cart_car){
        $this->db->insert('cart_car',$cart_car);
        return $this->db->insert_id();
    }
	
	public function getBookingTemp($cart_global_id){
        $this->db->where('cart_id',$cart_global_id);
        $this->db->join('cart_car','cart_car.ID = cart_global.ref_id');
        return $this->db->get('cart_global');
    }
	public function insert_booking_car($booking_car){
        $this->db->insert('booking_car',$booking_car);
        return $this->db->insert_id();
    }
	
	public function getBookingCarTemp($booking_car_id){
        $this->db->where('ID',$booking_car_id);
        return $this->db->get('booking_car');
    }
	
	public function CheckDuplicateBooking($booking_flight_id){
        $this->db->where('ref_id',$booking_flight_id);
		$this->db->where('module','FLIGHT');
        return $this->db->get('booking_global');
    }
	
	public function Booking_Global($booking){
        $this->db->insert('booking_global', $booking);
        return $this->db->insert_id();
    }
	public function Update_Booking_Global($booking_temp_id, $update_booking, $module){
        $this->db->where('id',$booking_temp_id);
		$this->db->where('module',$module);
        $this->db->update('booking_global', $update_booking);
    }

    

    public function clearCart($cart_id){
        $this->db->select('ref_id');
        $this->db->where('cart_id',$cart_id);
        $data = $this->db->get('cart_global')->row();
        $ref_id = $data->ref_id;

        $this->db->where('ID',$ref_id);
        $this->db->delete('cart_car');
        
        $this->db->where('cart_id',$cart_id);
        $this->db->delete('cart_global');
    }
	 public function Update_Booking_car($booking_temp_id, $update_booking){
        $this->db->where('ID',$booking_temp_id);
        $this->db->update('booking_car', $update_booking);
    }
}

