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
		$this->db->where('booking_global.module', 'APARTMENT');
		$this->db->order_by('booking_global.id','desc');
		return $this->db->get('booking_global');
	}

	public function getBookingvoucherinvoicedetails(){

        return $this->db->get('apartment_invoice');
    }
	public function getHotelBookings($user_id, $user_type){
		$this->db->join('booking_hotel','booking_global.ref_id = booking_hotel.ID');
		$this->db->join('kigo_countries', 'kigo_countries.COUNTRY_CODE = booking_hotel.BILLING_COUNTRY');
		$this->db->where('booking_hotel.api', 'Travelport');
		$this->db->where('booking_global.user_type', $user_type);
		$this->db->where('booking_global.user_id', $user_id);
		$this->db->where('booking_global.module', 'HOTEL');
		$this->db->order_by('booking_global.id','desc');
		return $this->db->get('booking_global');
	}
	public function getHotelCRSBookings($user_id, $user_type){
		$this->db->join('booking_hotel','booking_global.ref_id = booking_hotel.ID');
		$this->db->join('kigo_countries', 'kigo_countries.COUNTRY_CODE = booking_hotel.BILLING_COUNTRY');
		$this->db->where('booking_hotel.api', 'CRS');
		$this->db->where('booking_global.user_type', $user_type);
		$this->db->where('booking_global.user_id', $user_id);
		$this->db->where('booking_global.module', 'HOTEL');
		$this->db->order_by('booking_global.id','desc');
		return $this->db->get('booking_global');
	}
	public function getFlightBookings($user_id, $user_type){
		$this->db->join('booking_flight','booking_global.ref_id = booking_flight.ID');
		$this->db->join('kigo_countries', 'kigo_countries.COUNTRY_CODE = booking_flight.BILLING_COUNTRY');
		$this->db->where('booking_global.user_type', $user_type);
		$this->db->where('booking_global.user_id', $user_id);
		$this->db->where('booking_global.module', 'FLIGHT');
		$this->db->order_by('booking_global.id','desc');
		return $this->db->get('booking_global');
	}
	public function getCarBookings($user_id, $user_type){
		$this->db->join('booking_car','booking_global.ref_id = booking_car.ID');
		$this->db->join('kigo_countries', 'kigo_countries.COUNTRY_CODE = booking_car.BILLING_COUNTRY');
		$this->db->where('booking_global.user_type', $user_type);
		$this->db->where('booking_global.user_id', $user_id);
		$this->db->where('booking_global.module', 'CAR');
		$this->db->order_by('booking_global.id','desc');
		return $this->db->get('booking_global');
	}
	public function getVacationBookings($user_id, $user_type){
		$this->db->join('booking_vacation','booking_global.ref_id = booking_vacation.ID');
		$this->db->join('kigo_countries', 'kigo_countries.COUNTRY_CODE = booking_vacation.BILLING_COUNTRY');
		$this->db->where('booking_global.user_type', $user_type);
		$this->db->where('booking_global.user_id', $user_id);
		$this->db->where('booking_global.module', 'VACATION');
		$this->db->order_by('booking_global.id','desc');
		return $this->db->get('booking_global');
	}
	public function getAllBookings(){
		$this->db->order_by('booking_global.id','desc');
		return $this->db->get('booking_global');
	}
	public function getAllBookings_b2c(){
		$this->db->order_by('booking_global.id','desc');
		$this->db->where('booking_global.user_type','3'); 
		return $this->db->get('booking_global');
	}
	public function getAllBookings_b2b(){
		$this->db->order_by('booking_global.id','desc');
		$this->db->where('booking_global.user_type','2'); 
		return $this->db->get('booking_global');
	}
	public function getAllBookings_guest(){
		$this->db->order_by('booking_global.id','desc');
		$this->db->where('booking_global.user_type','4'); 
		return $this->db->get('booking_global');
	}
	public function gethostBookings($user_id, $user_type){
		$this->db->join('booking_apartment','booking_global.ref_id = booking_apartment.ID');
		$this->db->join('kigo_countries', 'kigo_countries.COUNTRY_CODE = booking_apartment.PROP_COUNTRY');
		$this->db->where('booking_apartment.user_type', $user_type);
		$this->db->where('booking_apartment.user_id', $user_id);
		$this->db->order_by('booking_global.id','desc'); 
		return $this->db->get('booking_global');
	}

	public function getBooking($pnr_no){
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

    public function get_duration($DepartureDateTime,$ArrivalDateTime){
        $seconds = $ArrivalDateTime - $DepartureDateTime;
        $jms = $seconds/60;
        $days = floor($seconds / 86400);
        $hours = floor(($seconds - ($days * 86400)) / 3600);
        $minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
        // $seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
        if($days==0){
            $dur=$hours."h ".$minutes."m";  
        }else{
            $dur=$days."d ".$hours."h ".$minutes."m";
        }
        return $dur;
    }

    public function get_unixtimestamp($DateTime){
        //Exploding T from arrival time  
        list($date, $time) = explode('T', $DateTime);
        $time = preg_replace("/[.]/", " ", $time);
        list($time, $TimeOffSet) = explode(" ", $time);
        $DateTime = $date." ".$time; //Exploding T and adding space
        $timestamp = strtotime($DateTime);
        return $timestamp;
    }

    public function get_airport_name($code){
        $this->db->select('airport_name as airport');
        $this->db->where('airport_code', $code);
        $data = $this->db->get('flight_airport_list')->row();
        return $data->airport;
    }

    public function get_airline_name($code){
        $this->db->select('airline_name as airline');
        $this->db->where('airline_code', $code);
        $data = $this->db->get('airlines_list')->row();
        return $data->airline;
    }
	
	public function getBookingsByUser($user_id, $user_type){
		$this->db->where('booking_global.user_type', $user_type);
		$this->db->where('booking_global.user_id', $user_id);
        return $this->db->get('booking_global');
    }

    public function getBookingPnr($pnr_no){
		$this->db->where('pnr_no',$pnr_no);
        return $this->db->get('booking_global');
    }
public function get_vendor_details($code){
        $this->db->where('alternate_vendor_code', $code);
        $data = $this->db->get('car_vendors')->row();
        return $data->short_name;
    }

    public function getBookingApartmentTransaction($pnr_no){
		$this->db->where('pnr_no',$pnr_no);
        return $this->db->get('apartment_transaction');
    }

    public function GetUserData($user_type, $user_id){

		if($user_type == '3'){
			$this->db->where('user_id', $user_id);
            return $this->db->get('b2c');
        }else if($user_type == '2'){
        	$this->db->where('agent_id', $user_id);
            return $this->db->get('b2b');
        }
	}
	public function updateRefundAmount($array,$module,$pnr_no){
		if(!empty($array) && ($pnr_no))
		{	
			$this->db->trans_start();
			$this->db->where('module', $module);
			$this->db->where('pnr_no', $pnr_no);
			$this->db->update('booking_global', $array); 
			$this->db->trans_complete();
			return $this->db->trans_status();
		}else{
			return false;
		}
	}

}

