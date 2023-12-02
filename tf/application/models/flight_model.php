<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------|
| Author: Provab Technosoft Pvt Ltd.									   |
|--------------------------------------------------------------------------|
| Developer: Provab											   |
| Started Date: 2014-10-14T10:45:00										   |
| Ended Date:  										   					   |
|--------------------------------------------------------------------------|
*/

class Flight_Model extends CI_Model {
	
	
	public function get_airport_list($query){
		$first_Arr=array();$sec_Arr=array();$all_list['airport']=array();
		if(strlen($query)<=3){
				if($query=="goa"){
				$this->db->like('airport_code', $query);
				$this->db->or_like('airport_city', $query);
				$this->db->group_by("airport_city_code"); 
				$this->db->having('COUNT(*)>', 0);
				$f_q=$this->db->get('flight_airport_list');
				 $tot_first=$f_q->num_rows();
				 $air_tot=0;
				$city_tot=0;
				}else{
				$air_tot=0;
				$this->db->like('airport_city_code', $query);
				$this->db->having('COUNT(*)>', 0); 
				$this->db->order_by("airport_city_code","asc");
				$f_q=$this->db->get('flight_airport_list'); 
				$city_tot=$f_q->num_rows();
				$tot_first=$city_tot;
				if($city_tot==0){
					$city_tot=0;
				$this->db->like('airport_code', $query); 
				$this->db->having('COUNT(*)>', 0); 
				$this->db->order_by("airport_city_code","asc");
				$f_q=$this->db->get('flight_airport_list'); 
				$air_tot=$f_q->num_rows();
				$tot_first=$air_tot;
				}		
				}
		 }else{
		$this->db->like('airport_city', $query);
		$this->db->or_like('country', $query);
		$this->db->group_by("airport_city_code"); 
		$this->db->having('COUNT(*)>', 0); 
		$this->db->order_by("airport_city_code","asc");
		$f_q=$this->db->get('flight_airport_list');
		$tot_first=$f_q->num_rows();
		$air_tot=0;
		$city_tot=0;
		}
		if($tot_first>0){
			$firstresult_arr=$f_q->result_array();
				$a=0;
		foreach($firstresult_arr as $first_Arr){
			
			$all_list['airport'][$a][]=$first_Arr;	
			if($air_tot>0){	
				$this->db->like('airport_code', $first_Arr['airport_code']);	
				}else{
				$this->db->like('airport_city_code', $first_Arr['airport_city_code']);
		}	
			$this->db->order_by("airport_code","asc");
			$s_q=$this->db->get('flight_airport_list');
			$tot_sec=$s_q->num_rows();
			if($tot_sec>0){
				$second_result_arr=$s_q->result_array();
				foreach($second_result_arr as $sec_Arr){			
					$all_list['airport'][$a][] = $sec_Arr;
					}
				}
			$a++;
			}
		}
			return $all_list;
	}

	public function get_api_credentials($service=''){
		if($service!=''){
		$this->db->where('api_name', 'Travelport-'.$service.'');
		}else{
			$this->db->where('api_name', 'Travelport-Flight');
		}
		
		$this->db->where('status', 1);
		$query = $this->db->get('api');
		if($query->num_rows() != 0 )
		{
			return $query->row();
		}
		else
		{
			return '';
		}
	}
public function get_car_api_credentials(){
		$this->db->where('api_name', 'Travelport-Car');
		$this->db->where('status', 1);
		$query = $this->db->get('api');
		if($query->num_rows() != 0 )
		{
			return $query->row();
		}
		else
		{
			return '';
		}
		
	}
	public function get_pnr_api_credentials(){
		$this->db->where('api_name', 'Travelport-PNR');
		$this->db->where('status', 1);
		$query = $this->db->get('api');
		if($query->num_rows() != 0 )
		{
			return $query->row();
		}
		else
		{
			return '';
		}
		
	}
	public function currency_convertor($amount,$from,$to){
    	$from = strtoupper($from);
    	//$this->db->select('value');
    	$this->db->where('country',$from);
    	$price = $this->db->get('currency_converter')->row();
    	//echo $this->db->last_query();
    	$value = $price->value;
    	//echo '<pre>';print_r($price);die;
    	if($from === $to){
    		$amount = $amount/1;
    		return number_format(($amount) ,2,'.','');
    	}else{
    		//echo 100.00/64.7325;
    		//echo $amount.'/'.$value;
    		$amount = ($amount)/($value);
    		return number_format(($amount) ,2,'.','');
    	}
    }

    public function get_airport_cityname($code){
       $this->db->select('airport_name, airport_city');
        $this->db->where('airport_code', $code);
		$this->db->or_where('airport_city_code', $code); 
        $data = $this->db->get('flight_airport_list')->row();
        if($data->airport_city!=''){
		
		    return $data->airport_city;
		}else{
			 return $data->airport_name;
		}
    }
    
    public function get_airport_citycode($code){
       $this->db->select('airport_city_code');
        $this->db->where('airport_code', $code);
        $data = $this->db->get('flight_airport_list')->row();
        if($data->airport_city_code!=''){
		
		    return $data->airport_city_code;
		}
    }

    public function get_airport_details($code){
      
        $this->db->where('airport_code', $code);
		$this->db->or_where('airport_city_code', $code); 
        $data = $this->db->get('flight_airport_list')->row();
      
		
		    return $data;
		
    }
/*
 *  public function get_airport_details($code){
        $this->db->where('airport_code', $code);
        $data = $this->db->get('flight_airport_list')->row();
        return $data;
    }*/
    public function get_airport_name($code){
        $this->db->select('airport_name as airport');
        $this->db->where('airport_code', $code);
        $data = $this->db->get('flight_airport_list')->row();
        return $data->airport;
    }
    
    public function get_airport_countryname($code){
        $this->db->select('country');
        $this->db->where('airport_city_code', $code);
        $data = $this->db->get('flight_airport_list')->row();
        return $data->country;
    }

    public function get_airportcode_countryname($code){
        $this->db->select('country');
        $this->db->where('airport_code', $code);
        $data = $this->db->get('flight_airport_list')->row();
        return $data->country;
    }

    public function get_airline_name($code){
        $this->db->select('airline_name as airline');
        $this->db->where('airline_code', $code);
        $data = $this->db->get('airlines_list')->row();
        return $data->airline;
    }
    
    public function get_discounted_flights(){
			 $qry="SELECT * FROM discounted_flights WHERE status='1' and exp_date >= CURDATE() limit 0,5";
			$data=$this->db->query($qry);
     
       if($data->num_rows()>0){
		   return $data->result_array();
	   }
    }

    public function get_why_we_details(){

				$this->db->select('*');
				$this->db->limit(4);
				$this->db->where('status',1);
       		 $data = $this->db->get('why_we');
			if($data->num_rows()>0){
			   return $data->result_array();
		   }
    }
    
    public function get_particular_discounted_flights($id){
			$this->db->where("id",$id);
			$data=$this->db->get("discounted_flights");
       if($data->num_rows()>0){
		   return $data->result_array();
	   }else{
		   return false;
		   }
    }
    
    public function get_discounted_flights_banners($id){
			$this->db->where("flight_id",$id);
			$data=$this->db->get("discounted_flight_images");
       if($data->num_rows()>0){
		   return $data->result_array();
	   }else{
		   return false;
		   }
    }
    
    public function get_duration($DepartureDateTime,$ArrivalDateTime){
        $seconds = $ArrivalDateTime - $DepartureDateTime;
        $jms = $seconds/60;
        $days = floor($seconds / 86400);
        $hours = floor(($seconds - ($days * 86400)) / 3600);
        $minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
        if($days==0){
            $dur=$hours."h ".$minutes."m";  
        }else{
            $dur=$days."d ".$hours."h ".$minutes."m";
        }
        return $dur;
    }

    public function get_unixtimestamp($DateTime){
       
        $date_time = str_replace('T'," " ,$DateTime);
       
        $DateTime = substr_replace($date_time,"",-6);
        $timestamp = strtotime($DateTime);
        return $timestamp;
    }

    public function insert_cart_flight($cart_flight){
        $this->db->insert('cart_flight',$cart_flight);
        return $this->db->insert_id();
    }
	
	public function getBookingTemp($cart_global_id){
        $this->db->where('cart_id',$cart_global_id);
        $this->db->join('cart_flight','cart_flight.ID = cart_global.ref_id');
        return $this->db->get('cart_global');
    }

    public function clearCart($cart_id){
        $this->db->select('ref_id');
        $this->db->where('cart_id',$cart_id);
        $data = $this->db->get('cart_global')->row();
        $ref_id = $data->ref_id;

        $this->db->where('ID',$ref_id);
        $this->db->delete('cart_flight');
        
        $this->db->where('cart_id',$cart_id);
        $this->db->delete('cart_global');
    }

	public function insert_booking_flight($booking_flight){
        $this->db->insert('booking_flight',$booking_flight);
        return $this->db->insert_id();
    }

    public function insert_loyalty_points($LoyaltyTranactionArray){
        $this->db->insert('LoyaltyPointsStatement',$LoyaltyTranactionArray);
    }
	
	public function getBookingFlightTemp($booking_flight_id){
        $this->db->where('ID',$booking_flight_id);
        return $this->db->get('booking_flight');
    }
	
	public function CheckDuplicateBooking($booking_flight_id){
        $this->db->where('ref_id',$booking_flight_id);
		$this->db->where('module','FLIGHT');
        return $this->db->get('booking_global');
    }
    
    public function get_globalbooking_FlightData($pnr){
        $this->db->where('parent_pnr',$pnr);
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
		public function Update_Booking_Global_sol($booking_temp_id, $update_booking){
        $this->db->where('id',$booking_temp_id);
		
        $this->db->update('booking_global', $update_booking);
    }
    public function Update_Booking_flight($booking_temp_id, $update_booking){
        $this->db->where('ID',$booking_temp_id);
        $this->db->update('booking_flight', $update_booking);
    }
    public function get_first_img($id=0){
		return $this->db->query('select airline_code from discounted_flights where id='.$id.'')->result_array();
	}
	public function Get_Markups(){
		$ResMarkups = $this->db->get('B2CMarkupDiscount');
		return $ResMarkups->result();
	}

	public function Get_bookingfee(){
		$this->db->where('HiddenStatus','N');
		$ResMarkups = $this->db->get('B2CMarkupDiscount');
		return $ResMarkups->result();
	}


	public function WholeMCalcCarrier($MCalcCarrier,$MCalcDepartureDate){
		$MarkupsQuery = "SELECT * FROM B2CMarkupDiscount 
						WHERE ApplicableAirlines 
						LIKE '%$MCalcCarrier%' 
						AND ( ( VFrom <= '$MCalcDepartureDate' AND VTo >= '$MCalcDepartureDate' ) || ( VFrom = '0000-00-00' AND VTo = '0000-00-00' ) )
						AND Status = 'Active'
						";
		$ResMarkups = $this->db->query($MarkupsQuery);
		return $ResMarkups->result();
	}

	public function Insurance_Details($insurance_details){
        $this->db->insert('insurance_details', $insurance_details);
       
        return $this->db->insert_id();
    }


	public function get_insurance($pnr){

		$this->db->where('pnr_no',$pnr);
		return $this->db->get('insurance_details');
		
	}
public function Update_insurance_details($pnr_no, $up_ins){
        $this->db->where('pnr_no',$pnr_no);
        $this->db->update('insurance_details', $up_ins);
    }

public function get_airline_list(){
		return $this->db->query('select * from airlines_list order by airline_name asc')->result();
	}
	
}

