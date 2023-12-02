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

class Hotel_Model extends CI_Model {
    



    public function travelport_hotel_amenities(){
        
         $query =$this->db->get('travelport_hotel_amenities');

         return $query->result();
    }
   

    public function room_types(){
        
         $query =$this->db->get('room_type');

         return $query->result();
    }

    public function get_hotels_list($city){
        $this->db->select('*');
        $this->db->from('hotel_cities');
        $this->db->like('hotel_cities.CITY',$city);
        $this->db->join('hotel_countries','hotel_cities.COUNTRY_CODE = hotel_countries.COUNTRY_CODE');
        $this->db->order_by("hotel_cities.CITY", "asc"); 
        //$this->db->limit(10);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_hotel_refrence_points($term){
    	  
        $this->db->select('*');
         
         $this->db->like('refrence_point_name', $term, 'after'); 
        $this->db->from('travelport_refrence_points');
        $query = $this->db->get();
     
        return $query->result();
    }
    
    public function get_api_result(){
        $this->db->select('*');
        $this->db->from('api');
        $this->db->where('api_name', 'Travelport-Hotel');
		$this->db->where('status', 1); 
		$query = $this->db->get();
		if($query->num_rows() != 0 )
		{
			return $query->row();
		}
		else
		{
			return '';
		}
		
       
    }
	 function insert_temp_result($data)
	{
		//echo '<pre/>';
		//print_r($data);exit;

		$this->db->delete('api_hotel_detail_temp', array('session_id' => $this->session->userdata('session_id'), 'hotel_code' => $data['hotelid'], 'chain_code' => $data['sid'], 'room_code' => $data['RatePlanType'])); 
		 
		 	
		$this->db->select('hotel_cities.CITY, hotel_countries.COUNTRY_NAME');
		$this->db->from('hotel_cities');
		$this->db->where('hotel_cities.IATA_CODES',$data['city_code']);
		$this->db->join('hotel_countries','hotel_cities.COUNTRY_CODE = hotel_countries.COUNTRY_CODE');
		$query = $this->db->get();
		
		if($query->num_rows() == 0 )
		{
			return '';
		}
		else
		{
			$response =  $query->row();
			$COUNTRY_NAME = $response->COUNTRY_NAME;
			$CITY = $response->CITY;
			$cout = $data['checkout'];
			$cin = $data['checkin'];
			$desc='';
			//echo '<pre/>';
		//	print_r($data['RoomRateDescription']);exit;
			for($k=0;$k<count($data['RoomRateDescription']);$k++)
			{
				if(is_array($data['RoomRateDescription'][$k][1]))
				{
					if($data['RoomRateDescription'][$k][0]!="Commission" && $data['RoomRateDescription'][$k][0]!="Guarantee"){
					$desc .= '<div class="mensionspl"><strong>'.$data['RoomRateDescription'][$k][0].'</strong><span class="menlbl">'.implode(" ",$data['RoomRateDescription'][$k][1]).'</span></div>';
					}
				}
				else
				{
					if($data['RoomRateDescription'][$k][0]!="Commission" && $data['RoomRateDescription'][$k][0]!="Guarantee"){
					$desc .= '<div class="mensionspl"><strong>'.$data['RoomRateDescription'][$k][0].'</strong><span class="menlbl">'.$data['RoomRateDescription'][$k][1].'</span></div>';
				}
			}
				
			}
			$data=array('session_id'=> $this->session->userdata('session_id'),
			'api'=>'Travelport',
			'hotel_code'=>$data['hotelid'],
			'chain_code'=>$data['sid'],
			'checkin'=>$cin,
			'checkout'=>$cout,
			'room_name'=>$data['room_name'],
			'hotel_addresses' =>str_replace("<br>", "|||", $data['address_details']),
			'image_url'=>'',
			'room_code'=>$data['RatePlanType'],
			'hotel_name'=>$data['hotel_name'],
			'city'=>$CITY.', '.$COUNTRY_NAME,
			'city_code'=>$data['city_code'],
			'roomdescription'=>$desc,
			'MyMarkup' => $data['MyMarkup'],
			'total_cost'=>$data['Total'],
			'currency'=>'USD',
			'base_cost'=>$data['Surcharge'],
			'org_amount'=>$data['org_Total'],
			'NonRefundableStayIndicator'=>$data['NonRefundableStayIndicator'],
			'CancelDeadline'=>$data['CancelDeadline'],
			'CancelPenaltyAmount'=>substr($data['CancelPenaltyAmount'],3),			
			'CancelPenaltyAmount_currency'=>substr($data['CancelPenaltyAmount'],0,3),
			'search_request'=>$data['search_request'],
			'child'=>$data['child'],		
			'status'=>'Available',
			'adult'=>$data['adult'],
			'room_count'=>$data['roomcount']
			
			);
			
			$this->db->insert('api_hotel_detail_temp',$data);
			//echo $this->db->last_query();exit;
		   return $this->db->insert_id();
		}

			
		
	}

	function insert_temp_result_crs($data, $room_id, $hotelid, $city_code){
		//echo '<pre/>';
		//print_r($data);exit;
		$delete = array(
			'session_id' => $this->session->userdata('session_id'), 
			'hotel_id' => $hotelid, 
			'city_code' => $city_code, 
			'room_id' => $room_id
		);
		$this->db->delete('api_hotel_detail_temp_crs', $delete);

		$this->db->select('hotel_cities.CITY, hotel_countries.COUNTRY_NAME');
		$this->db->from('hotel_cities');
		$this->db->where('hotel_cities.IATA_CODES',$data['city_code']);
		$this->db->join('hotel_countries','hotel_cities.COUNTRY_CODE = hotel_countries.COUNTRY_CODE');
		$query = $this->db->get();
		$response =  $query->row();
		$COUNTRY_NAME = $response->COUNTRY_NAME;
		$CITY = $response->CITY;

		 	$data = array(
		 		'session_id'=> $this->session->userdata('session_id'),
				'api'=>'CRS',
				'hotel_id'=>$data['hotelid'],
				'checkin'=>$data['checkin'],
				'checkout'=>$data['checkout'],
				'room_name'=>$data['room_name'],
				'image_url'=>'',
				'room_id'=>$data['room_id'],
				'hotel_name'=>$data['hotel_name'],
				'city'=>$CITY.', '.$COUNTRY_NAME,
				'city_code'=>$data['city_code'],
				'roomdescription'=>$data['desc'],
				'MyMarkup' => $data['MyMarkup'],
				'total_cost'=>$data['Total'],
				'currency'=>'USD',
				'CancelPolicy'=>$data['CancelPolicy'],
				'CancelDeadline'=>$data['CancelDeadline'],
				'CancelCommision'=>$data['CancelCommision'],		
				'status'=>'Available',
				'adult'=>$data['adult'],
				'room_count'=>$data['roomcount']
			);
			
			$this->db->insert('api_hotel_detail_temp_crs',$data);
			//echo $this->db->last_query();exit;
		   return $this->db->insert_id();
		}

			
		
	
		
function get_temp_result($sid, $hotelid)
{
		$this->db->select('*');
		$this->db->from('api_hotel_detail_temp');
		$this->db->where('session_id',$this->session->userdata('session_id'));
		$this->db->where('chain_code',$sid);
		$this->db->where('hotel_code',$hotelid);
		$this->db->where('total_cost  !=','0.00');
		$query = $this->db->get();
		
		if($query->num_rows() == 0 )
		{
			return '';
		}
		else
		{
		return  $query->result();
		}

}

	function get_temp_result_crs($temp_id){
		$this->db->where('api_hotel_detail_temp_id',$temp_id);
		return $this->db->get('api_hotel_detail_temp_crs');
	}
		
function get_temp_result_id($hotel_id)
{
		$this->db->select('*');
		$this->db->from('api_hotel_detail_temp');
		$this->db->where('api_hotel_detail_temp_id',$hotel_id);
		
		$query = $this->db->get();
		
		if($query->num_rows() == 0 )
		{
			return '';
		}
		else
		{
		return  $query->row();
		}

}

	public function insert_cart_hotel($cart_hotel){
		$this->db->insert('cart_hotel',$cart_hotel);
		return $this->db->insert_id();
	}

	public function getBookingTemp($cart_global_id){
        $this->db->where('cart_id',$cart_global_id);
        $this->db->join('cart_hotel','cart_hotel.ID = cart_global.ref_id');
        return $this->db->get('cart_global');
    }
		public function gethotel_amentities($hotel_id){
         $this->db->where('hotel_amenities.hotel_id',$hotel_id);
        $this->db->join('travelport_hotel_amenities','travelport_hotel_amenities.id = hotel_amenities.amenity_id','left');
        return $this->db->get('hotel_amenities');
    }
    public function getBookingHotelTemp($booking_hotel_id){
        $this->db->where('ID',$booking_hotel_id);
        return $this->db->get('booking_hotel');
    }
    public function insert_booking_hotel($booking_hotel){
        $this->db->insert('booking_hotel',$booking_hotel);
        return $this->db->insert_id();
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
        $this->db->delete('cart_hotel');
        
        $this->db->where('cart_id',$cart_id);
        $this->db->delete('cart_global');
    }

    //CRS Starts Here
    public function getCRSHotels($city_code){
		 $this->db->select('*');
        $this->db->from('api');
        $this->db->where('api_name', 'CRS-Hotel');
		$this->db->where('status', 1); 
		$query = $this->db->get();
		if($query->num_rows() != 0 )
		{
			$this->db->where('hotel_chain_name',$city_code);
			$this->db->where('status','1');
			$c = $this->db->get('crs_hotels');
			return $c->result();
		}
		else
		{
			return '';
		}
    	
    }
    public function getCRSHotelbyid($hotel_id){
    	$this->db->where('sup_hotel_id',$hotel_id);
        return $this->db->get('crs_hotels');
    }
	  public function getam_name($am_id){
    	$this->db->where('universal_api_code',$am_id);
        return $this->db->get('travelport_hotel_amenities');
    }
    public function getCRSImages($hotel_id){
    	$this->db->where('hotel_id',$hotel_id);
        return $this->db->get('hotel_images');
    }
    public function getCRSRooms($hotel_id){
    	$this->db->where('hotel_id',$hotel_id);
        return $this->db->get('hotelcrs_rooms');
    }
    public function get_day_wise_chunks($custom_cin,$custom_cout){
		$begin = new DateTime( $custom_cin );
		$end = new DateTime( $custom_cout );
		$end = $end->modify( '+1 day' );

		$interval = new DateInterval('P1D');
		$daterange = new DatePeriod($begin, $interval ,$end);
		
		$i=0;
		$temp_date = array();
		
		foreach($daterange as $date){
			$temp_date[] = $date->format("Y-m-d");
		}		
		return $temp_date;				
	}
	public function getPeriods($room_id){
		$this->db->where('room_id',$room_id);
        return $this->db->get('room_pricing');
	}
	public function get_adult_wise_price($price_id,$adult){
		$this->db->where('price_id',$price_id);
		$this->db->where('adult',$adult);
		$this->db->where('type','Period');
        return $this->db->get('room_pricing_adt');
	}
	public function getSpecificPeriods($room_id,$date){
		$this->db->where('room_id',$room_id);
		$this->db->where('to >=', $date);
		$this->db->where('from <=', $date);
        return $this->db->get('room_pricing_specific');
	}
	public function get_sepecific_adult_wise_price($price_id,$adult){
		$this->db->where('price_id',$price_id);
		$this->db->where('adult',$adult);
		$this->db->where('type','Specific');
        return $this->db->get('room_pricing_adt_specific');
	}
	 public function Update_Booking_hotel($booking_temp_id, $update_booking){
        $this->db->where('ID',$booking_temp_id);
        $this->db->update('booking_hotel', $update_booking);
    }



   

}