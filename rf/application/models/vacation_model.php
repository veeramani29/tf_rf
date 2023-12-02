<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------|
| Author: Provab Technosoft Pvt Ltd.									   |
|--------------------------------------------------------------------------|
| Developer: Provab											   |
| Started Date: 2014-11-07T16:00:00									       |
| Ended Date:  										   					   |
|--------------------------------------------------------------------------|
*/

class Vacation_Model extends CI_Model {

    public function get_vacations($cityid,$type){
        $this->db->where('package_cityid', $cityid);
        if($type != 'all'){
            $this->db->where('package_type', $type);
        }
        $this->db->where('status', 1);
        return $this->db->get('packages');
    }

    public function get_vacation_detail($package_id){
        $this->db->where('package_id', $package_id);
        $this->db->where('status', 1);
        //$this->db->join('packages_types','packages_types.packages_types_id = packages.ref_id');
        return $this->db->get('packages');
    }

    public function get_vacation_days($package_id){
        $this->db->where('package_id', $package_id);
        return $this->db->get('package_days_list');
    }

    public function get_vacation_images($package_id){
        $this->db->where('package_id', $package_id);
        return $this->db->get('package_other_images');
    }
    public function getVacationTypes(){
        $this->db->distinct();
        return $this->db->get('packages_types');
    }

    public function insert_cart_vacation($cart_vacation){
        $this->db->insert('cart_vacation',$cart_vacation);
        return $this->db->insert_id();
    }
	
	public function getBookingTemp($cart_global_id){
        $this->db->where('cart_id',$cart_global_id);
        $this->db->join('cart_vacation','cart_vacation.ID = cart_global.ref_id');
        return $this->db->get('cart_global');
    }
	public function insert_booking_vacation($booking_vacation){
        $this->db->insert('booking_vacation',$booking_vacation);
        return $this->db->insert_id();
    }
	
	public function getBookingVacationTemp($booking_vacation_id){
        $this->db->where('ID',$booking_vacation_id);
        return $this->db->get('booking_vacation');
    }
	
	public function CheckDuplicateBooking($booking_flight_id){
        $this->db->where('ref_id',$booking_flight_id);
		$this->db->where('module','VACATION');
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
        $this->db->delete('cart_vacation');
        
        $this->db->where('cart_id',$cart_id);
        $this->db->delete('cart_global');
    }
	 public function Update_Booking_vacation($booking_temp_id, $update_booking){
        $this->db->where('ID',$booking_temp_id);
        $this->db->update('booking_vacation', $update_booking);
    }
}

