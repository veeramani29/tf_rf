<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------|
| Author: Provab Technosoft Pvt Ltd.									   |
|--------------------------------------------------------------------------|
| Developer: Provab											   |
| Started Date: 2014-10-07T10:30:00										   |
| Ended Date:  										   					   |
|--------------------------------------------------------------------------|
*/

class Booking_Model extends CI_Model {
	
	public function getApartmentBookings($user_id, $user_type){
		$this->db->join('booking_apartment','booking_global.ref_id = booking_apartment.ID');
		$this->db->join('kigo_countries', 'kigo_countries.COUNTRY_CODE = booking_apartment.PROP_COUNTRY');
		$this->db->where('booking_global.user_type', $user_type);
		$this->db->where('booking_global.user_id', $user_id);
		$this->db->order_by('booking_global.id','desc');
		return $this->db->get('booking_global');
	}
public function getoverallBookings($user_id, $user_type){
		
		$this->db->where('booking_global.user_type', $user_type);
		$this->db->where('booking_global.user_id', $user_id);
		$this->db->order_by('booking_global.id','desc');
		return $this->db->get('booking_global');
	}

	public function gethostBookings($user_id, $user_type){
		$this->db->join('booking_apartment','booking_global.ref_id = booking_apartment.ID');
		$this->db->join('kigo_countries', 'kigo_countries.COUNTRY_CODE = booking_apartment.PROP_COUNTRY');
		$this->db->where('booking_apartment.PROP_USER_TYPE', $user_type);
		$this->db->where('booking_apartment.PROP_USER_ID', $user_id);
		$this->db->where('booking_global.module', 'APARTMENT');
		$this->db->order_by('booking_global.id','desc'); 
		return $this->db->get('booking_global');
	}

	public function getBooking($pnr_no){
		$this->db->where('pnr_no',$pnr_no);
		$this->db->join('booking_apartment','booking_global.ref_id = booking_apartment.ID');
		$s = $this->db->get('booking_global');
		$count = $s->num_rows();
		if($count == 1){
			$data = $s->row();
			$p = '1';
		}else{
			$p = '-1';
		}
		//echo '<pre>';print_r($data);die;
		//$this->db->select('booking_global.user_type as u_type, booking_global.user_id as u_id, booking_apartment.*, kigo_countries.*, b2c.*, b2b.*, booking_global.*');
        $this->db->join('booking_apartment','booking_global.ref_id = booking_apartment.ID');
		$this->db->join('kigo_countries', 'kigo_countries.COUNTRY_CODE = booking_apartment.PROP_COUNTRY');
		if($p != '-1'){
			if($data->PROP_USER_TYPE == '3'){
	            //$this->db->join('b2c', 'b2c.user_id = booking_apartment.PROP_USER_ID');
	        }else if($data->PROP_USER_TYPE == '2'){
	            //$this->db->join('b2b', 'b2b.agent_id = booking_apartment.PROP_USER_ID');
	        }
    	}
    	
        $this->db->where('pnr_no',$pnr_no);
        return $this->db->get('booking_global');
    }

    public function getBookingByParentPnr($parent_pnr){
		/*$this->db->join('booking_apartment','booking_global.ref_id = booking_apartment.ID');
		$data = $this->db->get('booking_global')->row();
		
        $this->db->join('booking_apartment','booking_global.ref_id = booking_apartment.ID');
		$this->db->join('kigo_countries', 'kigo_countries.COUNTRY_CODE = booking_apartment.PROP_COUNTRY');
		if($data->PROP_USER_TYPE == '3'){
            $this->db->join('b2c', 'b2c.user_id = booking_apartment.PROP_USER_ID');
        }else if($data->PROP_USER_TYPE == '2'){
            $this->db->join('b2b', 'b2b.user_id = booking_apartment.PROP_USER_ID');
        }*/
        $this->db->where('parent_pnr',$parent_pnr);
       
        return $this->db->get('booking_global');
    }
	
	public function getBookingbyPnr($pnr_no,$module){
		if($module == 'APARTMENT'){
			$this->db->where('pnr_no',$pnr_no);
			$this->db->join('booking_apartment','booking_global.ref_id = booking_apartment.ID');
			$data = $this->db->get('booking_global')->row();
			
			$this->db->join('booking_apartment','booking_global.ref_id = booking_apartment.ID');
			$this->db->join('kigo_countries', 'kigo_countries.COUNTRY_CODE = booking_apartment.PROP_COUNTRY');
			if($data->PROP_USER_TYPE == '3'){
				$this->db->join('b2c', 'b2c.user_id = booking_apartment.PROP_USER_ID');
			}else if($data->PROP_USER_TYPE == '2'){
				$this->db->join('b2b', 'b2b.agent_id = booking_apartment.PROP_USER_ID');
			}
		}else if($module == 'FLIGHT'){
			$this->db->join('booking_flight','booking_global.ref_id = booking_flight.ID');
		}else if($module == 'HOTEL'){
			$this->db->join('booking_hotel','booking_global.ref_id = booking_hotel.ID');
		}else if($module == 'CAR'){
			$this->db->join('booking_car','booking_global.ref_id = booking_car.ID');
		}else if($module == 'VACATION'){
			$this->db->join('booking_vacation','booking_global.ref_id = booking_vacation.ID');
		}

        $this->db->where('pnr_no',$pnr_no);
        return $this->db->get('booking_global');
    }
	
	public function getBookingsByUser($user_id, $user_type){
		$this->db->where('booking_global.user_type', $user_type);
		$this->db->where('booking_global.user_id', $user_id);
		$this->db->order_by('id','DESC');
        return $this->db->get('booking_global');
    }

    public function getBookingPnr($pnr_no){
		$this->db->where('pnr_no',$pnr_no);
        return $this->db->get('booking_global');
    }
 public function getBookingvoucherinvoicedetails(){

        return $this->db->get('apartment_invoice');
    }
    public function Update_Booking_Global($pnr_no, $update_booking, $module){
        $this->db->where('pnr_no',$pnr_no);
		$this->db->where('module',$module);
        $this->db->update('booking_global', $update_booking);
    }

    public function check_promocode($promo_code){
    	$this->db->where('promo_code',$promo_code);
		$this->db->where('status',1);
		return $this->db->get('promo');
    }

    public function getBillingDetailsB2c($user_id) {
    	$this->db->select('billing_firstname, 
    					   billing_lastname, 
    					   billing_addressA, 
    					   billing_addressB, 
    					   billing_email, 
    					   billing_contact, 
    					   billing_country, 
    					   billing_home_no,
    					   billing_city, 
    					   billing_state, 
    					   billing_postal');
    	$this->db->from('b2c');
    	$this->db->where('user_id', $user_id);

    	return $this->db->get();
    }

    public function getBillingDetailsB2b($user_id) {
    	$this->db->select('billing_firstname, 
    					   billing_lastname, 
    					   billing_addressA, 
    					   billing_addressB, 
    					   billing_email, 
    					   billing_contact, 
    					   billing_country, 
    					   billing_city, 
    					   billing_state, 
    					   billing_postal');
    	$this->db->from('b2b');
    	$this->db->where('agent_id', $user_id);

    	return $this->db->get();
    }

    public function updateBillingDetailsB2c($user_id, $billing) {
    	$this->db->where('user_id', $user_id);
    	$this->db->update('b2c', $billing);
    	return true;
    }

    public function updateBillingDetailsB2b($user_id, $billing_data) {
    	$this->db->where('agent_id', $user_id);
    	$this->db->update('b2b', $billing_data);
    	return true;
    }

    public function getBookingApartmentTransaction($pnr_no){
		$this->db->where('pnr_no',$pnr_no);
        return $this->db->get('apartment_transaction');
    }

}

