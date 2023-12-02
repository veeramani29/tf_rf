<?php

class Manage_Orders_Model extends CI_Model {
	
	public function __construct()
    {
	    parent::__construct();
    }

    public function get($input='')
    {
    	if(!empty($input))
    	{
            $user_type = $input['user_type'];
            unset($input['user_type']);
            /*$this->db->select("booking_global.*,booking_hotel.api");
            $this->db->from('booking_global');
            if($input['module'] == 'APARTMENT'){
                $this->db->join('booking_apartment','booking_global.ref_id = booking_apartment.ID');
            }else if($input['module'] == 'FLIGHT'){
                $this->db->join('booking_flight','booking_global.ref_id = booking_flight.ID');
            }else if($input['module'] == 'HOTEL'){
                $this->db->join('booking_hotel','booking_global.ref_id = booking_hotel.ID');
                $this->db->like('booking_hotel.api',$input['api']);
            }else if($input['module'] == 'CAR'){
                $this->db->join('booking_car','booking_global.ref_id = booking_car.ID');
            }else if($input['module'] == 'VACATION'){
                $this->db->join('booking_vacation','booking_global.ref_id = booking_vacation.ID');
            }*/
            $this->db->like('booking_global.user_type', $user_type);
    		$this->db->like($input);

            return $this->db->get('booking_global');
    	}else{
           return $this->db->get('booking_global'); 
        }
    	
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

    public function get_vendor_details($code){
        $this->db->where('alternate_vendor_code', $code);
        $data = $this->db->get('car_vendors')->row();
        return $data->short_name;
    }
}