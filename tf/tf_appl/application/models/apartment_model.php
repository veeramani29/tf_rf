<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------|
| Author: Provab Technosoft Pvt Ltd.									   |
|--------------------------------------------------------------------------|
| Developer: Provab											   |
| Started Date: 2014-09-11T11:45:00										   |
| Ended Date: 2014-10-13T19:00:00 										   |
|--------------------------------------------------------------------------|
*/

class Apartment_Model extends CI_Model {
	
	public function getApartmentsByGeometry($latitude, $longitude, $miles='20'){
		//$query = "select `PROPERTY_ID`, `PROP_LATITUDE`, `PROP_LONGITUDE`, ( 3959 * acos( cos( radians(37) ) * cos( radians( `PROP_LATITUDE` ) ) * cos( radians( `PROP_LONGITUDE` ) - radians(-122.517349) ) + sin( radians(37.780182) ) * sin( radians( `PROP_LATITUDE` ) ) ) ) AS distance FROM kigo_properties HAVING distance < 10000 ORDER BY distance LIMIT 0 , 50";
		//return $this->db->query($query);
		$this->db->select("PROPERTY_ID,PROP_LATITUDE,PROP_LONGITUDE,PROP_DESCRIPTION,PROP_NAME,PROP_ADDR1, ( 3959 * acos( cos( radians($latitude) ) * cos( radians( PROP_LATITUDE ) ) * cos( radians( PROP_LONGITUDE ) - radians($longitude) ) + sin( radians($latitude) ) * sin( radians( PROP_LATITUDE ) ) ) ) AS distance");                         
		$this->db->having('distance <= ' . $miles);                     
		$this->db->order_by('distance','desc');                    
		$this->db->limit(20, 0);
		return $this->db->get('kigo_properties');
	}
	public function get_reviews_about_you($b2c_id){
	
		$this->db->where('user_id', $b2c_id);
			$this->db->where('status', 1);
		return $this->db->get('reviews_host_data');
	}

	public function getApartmentsCount($latitude, $longitude, $filters=array(), $miles='20'){
		//$query = "select `PROPERTY_ID`, `PROP_LATITUDE`, `PROP_LONGITUDE`, ( 3959 * acos( cos( radians(37) ) * cos( radians( `PROP_LATITUDE` ) ) * cos( radians( `PROP_LONGITUDE` ) - radians(-122.517349) ) + sin( radians(37.780182) ) * sin( radians( `PROP_LATITUDE` ) ) ) ) AS distance FROM kigo_properties HAVING distance < 10000 ORDER BY distance LIMIT 0 , 50";
		//return $this->db->query($query);
		$this->db->select("PROPERTY_ID,PROP_LATITUDE,PROP_LONGITUDE,PROP_NAME,PROP_RATE_NIGHTLY_FROM,PROP_RATE_NIGHTLY_FROM_CURR,PROP_RATE_CURRENCY,PROP_BATHROOMS,PROP_BEDROOMS,PROP_BEDS,PROP_AMENITIES,kigo_properties.PROP_TYPE_ID, ( 3959 * acos( cos( radians($latitude) ) * cos( radians( PROP_LATITUDE ) ) * cos( radians( PROP_LONGITUDE ) - radians($longitude) ) + sin( radians($latitude) ) * sin( radians( PROP_LATITUDE ) ) ) ) AS distance");
		$this->db->join('kigo_property_types', 'kigo_property_types.PROP_TYPE_ID = kigo_properties.PROP_TYPE_ID');
		//$this->db->join('kigo_properties_photo', 'kigo_properties_photo.PROP_ID = kigo_properties.PROPERTY_ID');
		//$this->db->where('kigo_properties.PROPERTY_PHOTO_IMPORT_STATUS','1');
		if(!empty($filters)){
			if(isset($filters['price_min'])){
				$this->db->where('kigo_properties.PROP_RATE_NIGHTLY_FROM_CURR >=',$filters['price_min']);                         
			}
			if(isset($filters['price_max'])){
				$this->db->where('kigo_properties.PROP_RATE_NIGHTLY_FROM_CURR <=',$filters['price_max']);                         
			}
			if(isset($filters['min_bathrooms'])){
            	$this->db->where('kigo_properties.PROP_BATHROOMS >=',$filters['min_bathrooms']);
	        }
	        if(isset($filters['min_bedrooms'])){
	            $this->db->where('kigo_properties.PROP_BEDROOMS >=',$filters['min_bedrooms']);
	        }
	        if(isset($filters['min_beds'])){
	            $this->db->where('kigo_properties.PROP_BEDS >=',$filters['min_beds']);
	        }
	        if(isset($filters['hosting_amenities'])){
	        	$amenities = $filters['hosting_amenities'];
	        	foreach ($amenities as $key => $value) {
	        		$this->db->where("FIND_IN_SET($value,kigo_properties.PROP_AMENITIES) !=", 0);
	        	}
	        }
	        if(isset($filters['property_type_id'])){
	            $this->db->where_in('kigo_properties.PROP_TYPE_ID',$filters['property_type_id']);
	        }
	        if(isset($filters['ib'])){
	            $this->db->where('kigo_properties.PROP_INSTANT_BOOK',1);
	        }
		}
		$this->db->where('kigo_properties.PROPERTY_STATUS','1');                         
		$this->db->having('distance <= ' . $miles);                     
		$this->db->order_by('distance','desc');                    
		$this->db->limit(100, 0);
		return $this->db->get('kigo_properties');
	}

	public function getApartmentsByGeometrys($latitude, $longitude, $limit, $start, $filters='', $miles='20'){
		//$query = "select `PROPERTY_ID`, `PROP_LATITUDE`, `PROP_LONGITUDE`, ( 3959 * acos( cos( radians(37) ) * cos( radians( `PROP_LATITUDE` ) ) * cos( radians( `PROP_LONGITUDE` ) - radians(-122.517349) ) + sin( radians(37.780182) ) * sin( radians( `PROP_LATITUDE` ) ) ) ) AS distance FROM kigo_properties HAVING distance < 10000 ORDER BY distance LIMIT 0 , 50";
		//return $this->db->query($query);
		$this->db->select("PROPERTY_ID,PROP_LATITUDE,PROP_LONGITUDE,PROP_DESCRIPTION,PROP_NAME,PROP_ADDR1,PROP_TYPE_LABEL,PROP_RATE_NIGHTLY_FROM,PROP_RATE_NIGHTLY_TO,USER_TYPE,USER_ID,PROP_RATE_CURRENCY,PROP_INSTANT_BOOK, ( 3959 * acos( cos( radians($latitude) ) * cos( radians( PROP_LATITUDE ) ) * cos( radians( PROP_LONGITUDE ) - radians($longitude) ) + sin( radians($latitude) ) * sin( radians( PROP_LATITUDE ) ) ) ) AS distance");                         
		$this->db->join('kigo_property_types', 'kigo_property_types.PROP_TYPE_ID = kigo_properties.PROP_TYPE_ID');
				
		if(!empty($filters)){
			if(isset($filters['price_min'])){
				$this->db->where('kigo_properties.PROP_RATE_NIGHTLY_FROM_CURR >=',$filters['price_min']);                         
			}
			if(isset($filters['price_max'])){
				$this->db->where('kigo_properties.PROP_RATE_NIGHTLY_FROM_CURR <=',$filters['price_max']);                         
			}
			if(isset($filters['min_bathrooms'])){
            	$this->db->where('kigo_properties.PROP_BATHROOMS >=',$filters['min_bathrooms']);
	        }
	        if(isset($filters['min_bedrooms'])){
	            $this->db->where('kigo_properties.PROP_BEDROOMS >=',$filters['min_bedrooms']);
	        }
	        if(isset($filters['min_beds'])){
	            $this->db->where('kigo_properties.PROP_BEDS >=',$filters['min_beds']);
	        }
	        if(isset($filters['hosting_amenities'])){
	        	$amenities = $filters['hosting_amenities'];
	        	foreach ($amenities as $key => $value) {
	        		$this->db->where("FIND_IN_SET($value,kigo_properties.PROP_AMENITIES) !=", 0);
	        	}
	        }
	        if(isset($filters['property_type_id'])){
	            $this->db->where_in('kigo_properties.PROP_TYPE_ID',$filters['property_type_id']);
	        }
	        if(isset($filters['ib'])){
	            $this->db->where('kigo_properties.PROP_INSTANT_BOOK',1);
	        }
		}
		$this->db->where('kigo_properties.PROPERTY_STATUS','1');
		$this->db->having('distance <= ' . $miles);                     
		$this->db->order_by('distance','desc');                    
		$this->db->limit($limit, $start);
		return $this->db->get('kigo_properties');
	}
	
	public function get_country_name($code){
		
       $this->db->select('name');
        $this->db->where('country_code', $code);
		
        $data = $this->db->get('country')->row();
        if($data->name!=''){
		
		    return $data->name;
		}else{
			 return "N/A";
		}
    }
    
    public function get_country_phonecode($code,$name=0){
       $this->db->select('phonecode');
       $this->db->select('name');
        $this->db->where('country_code', $code);
		
        $data = $this->db->get('country')->row();
        if($name==0){
        if($data->phonecode!=''){
		
		    return $data->phonecode;
		}else{
			 return "N/A";
		}
	}else{
		if($data->name!=''){
		
		    return $data->name." (".$data->phonecode." )";
		}else{
			 return "N/A";
		}
	}
    }

	public function getApartmentsByGeometrysWithoutLimit($latitude, $longitude, $filters='', $miles='20'){
		//$query = "select `PROPERTY_ID`, `PROP_LATITUDE`, `PROP_LONGITUDE`, ( 3959 * acos( cos( radians(37) ) * cos( radians( `PROP_LATITUDE` ) ) * cos( radians( `PROP_LONGITUDE` ) - radians(-122.517349) ) + sin( radians(37.780182) ) * sin( radians( `PROP_LATITUDE` ) ) ) ) AS distance FROM kigo_properties HAVING distance < 10000 ORDER BY distance LIMIT 0 , 50";
		//return $this->db->query($query);
		$this->db->select("PROPERTY_ID,PROP_LATITUDE,PROP_LONGITUDE,PROP_DESCRIPTION,PROP_NAME,PROP_ADDR1,PROP_TYPE_LABEL,PROP_RATE_NIGHTLY_FROM,PROP_RATE_NIGHTLY_TO,USER_TYPE,USER_ID,PROP_RATE_CURRENCY,PROP_INSTANT_BOOK, ( 3959 * acos( cos( radians($latitude) ) * cos( radians( PROP_LATITUDE ) ) * cos( radians( PROP_LONGITUDE ) - radians($longitude) ) + sin( radians($latitude) ) * sin( radians( PROP_LATITUDE ) ) ) ) AS distance");                         
		$this->db->join('kigo_property_types', 'kigo_property_types.PROP_TYPE_ID = kigo_properties.PROP_TYPE_ID');
				
		if(!empty($filters)){
			if(isset($filters['price_min'])){
				$this->db->where('kigo_properties.PROP_RATE_NIGHTLY_FROM_CURR >=',$filters['price_min']);                         
			}
			if(isset($filters['price_max'])){
				$this->db->where('kigo_properties.PROP_RATE_NIGHTLY_FROM_CURR <=',$filters['price_max']);                         
			}
			if(isset($filters['min_bathrooms'])){
            	$this->db->where('kigo_properties.PROP_BATHROOMS >=',$filters['min_bathrooms']);
	        }
	        if(isset($filters['min_bedrooms'])){
	            $this->db->where('kigo_properties.PROP_BEDROOMS >=',$filters['min_bedrooms']);
	        }
	        if(isset($filters['min_beds'])){
	            $this->db->where('kigo_properties.PROP_BEDS >=',$filters['min_beds']);
	        }
	        if(isset($filters['hosting_amenities'])){
	        	$amenities = $filters['hosting_amenities'];
	        	foreach ($amenities as $key => $value) {
	        		$this->db->where("FIND_IN_SET($value,kigo_properties.PROP_AMENITIES) !=", 0);
	        	}
	        }
	        if(isset($filters['property_type_id'])){
	            $this->db->where_in('kigo_properties.PROP_TYPE_ID',$filters['property_type_id']);
	        }
	        if(isset($filters['ib'])){
	            $this->db->where('kigo_properties.PROP_INSTANT_BOOK',1);
	        }
		}
		$this->db->where('kigo_properties.PROPERTY_STATUS','1');
		$this->db->having('distance <= ' . $miles);                     
		$this->db->order_by('distance','desc');                    
		return $this->db->get('kigo_properties');
	}

	public function getAllAmenities(){
		$this->db->limit(15);
		return $this->db->get('kigo_amenities');
	}

	public function getAllPropertyTypes(){
		$this->db->limit(15);
		return $this->db->get('kigo_property_types');
	}

	public function getApartmentImages($PROPERTY_ID){
		$this->db->where('PROP_ID',$PROPERTY_ID);
		return $this->db->get('kigo_properties_photo');
	}

	public function getApartmentUser($user_type,$user_id){
		if($user_type == '3'){
			$this->db->where('user_id',$user_id);
			return $this->db->get('b2c');
		}else if($user_type == '2'){
			$this->db->where('agent_id',$user_id);
			return $this->db->get('b2b');
		}
	}

	public function getApartmentDetails($PROPERTY_ID){
		$this->db->where('kigo_properties.PROPERTY_ID',$PROPERTY_ID);
		$apartment = $this->db->get('kigo_properties')->row();
		if($apartment->USER_TYPE == '3'){
			$this->db->join('b2c', 'b2c.user_id = kigo_properties.USER_ID');
		}else if($apartment->USER_TYPE == '2'){
			$this->db->join('b2b', 'b2b.agent_id = kigo_properties.USER_ID');
		}
		$this->db->join('kigo_countries', 'kigo_countries.COUNTRY_CODE = kigo_properties.PROP_COUNTRY');
		$this->db->join('kigo_property_types', 'kigo_property_types.PROP_TYPE_ID = kigo_properties.PROP_TYPE_ID');
		//$this->db->join('kigo_properties_pdtp', 'kigo_properties_pdtp.TYPE_ID = kigo_properties.PROP_BED_TYPES');
		$this->db->join('cancellation_types', 'cancellation_types.id = kigo_properties.PROP_CANCELLATION_TYPE');
		$this->db->where('kigo_properties.PROPERTY_ID',$PROPERTY_ID);
		return $this->db->get('kigo_properties');
	}
	
	public function view_property_file($PHOTO_CONTENT) {
		$uniqid = uniqid('TAPT'); 
        file_put_contents(FRONT_UPLOAD_PATH . 'temp_image/'.$uniqid.'.jpg', base64_decode($PHOTO_CONTENT));
		
		$url = ASSETS.'upload_files/temp_image/'.$uniqid.'.jpg';
		return $url;
    }

    public function getApartmentActivities($activity_id){
    	$this->db->where('ACTIVITY_KIGO_ID',$activity_id);
    	return $this->db->get('kigo_activities');
    }

    public function getApartmentAmenities($amenity_id){
    	$this->db->where('KIGO_AMENITY_ID',$amenity_id);
    	return $this->db->get('kigo_amenities');
    }

    public function getApartmentBetTypes($BedType){
    	$this->db->where('TYPE_ID',$BedType);
    	return $this->db->get('kigo_properties_pdtp');
    }

    public function parseQueryString($url,$remove_arr) {
    	$infos=parse_url($url);
    	//echo $infos;
    	//echo '<pre>';print_r($infos);die;
    	if(!empty($infos) && isset($infos["query"])){
    		$str=$infos["query"];	
    	}else{
    		$str='';
    	}
        
        $op = array();
        $pairs = explode("&", $str);
        //echo '<pre>';print_r($pairs);
        //unset($pairs[0]);
        //echo '<pre>';print_r($pairs);die;
        foreach ($pairs as $pair) {
        	if($pair != ''){
        		list($k, $v) = array_map("urldecode", explode("=", $pair));
           		$op[$k] = $v;
        	}
        }
        foreach($remove_arr as $remove){
            if(isset($op[$remove])){
                unset($op[$remove]);
            }
        }

        return str_replace($str,http_build_query($op),$url);

    }

    public function currency_convertor($amount,$from,$to){
    	//echo $amount;die;
    	$from = strtoupper($from);
    	//$this->db->select('value');
    	$this->db->where('country',$from);
    	$price = $this->db->get('currency_converter')->row();
    	$value = $price->value;
    	//echo '<pre>';print_r($price);die;
    	if($from === $to){
    		$amount = $amount/1;
    		$amount = number_format(($amount) ,2,'.','');
    	}else{
    		//echo 100.00/64.7325;
    		//echo $amount.'/'.$value;
    		$amount = ($amount)/($value);
    		$amount = number_format(($amount) ,2,'.','');
    	}
    	return $amount;
    	//return $amount;
    }

    public function GetweeklyRental($pid,$checkin,$checkout){
    	/*$this->db->where('PROP_ID',$pid);
    	$this->db->where('WEEKLY_PRICING','1');
    	$this->db->where('CHECK_IN >= ',$checkin); 
    	$this->db->where('CHECK_OUT <= ',$checkout); */
    	
    	$sql = "SELECT * FROM (`kigo_properties_pricing_rent`) WHERE `PROP_ID` =  '$pid' AND `WEEKLY_PRICING` = 1 AND UNIX_TIMESTAMP('$checkin') >= UNIX_TIMESTAMP(`CHECK_IN`) AND UNIX_TIMESTAMP('$checkout') <= UNIX_TIMESTAMP(`CHECK_OUT`)";
    	return $this->db->query($sql);    	
    }
    
    public function GetAllweeklyRental($pid){
    	/*$this->db->where('PROP_ID',$pid);
    	$this->db->where('WEEKLY_PRICING','1');
    	$this->db->where('CHECK_IN >= ',$checkin); 
    	$this->db->where('CHECK_OUT <= ',$checkout); */
    	
    	$sql = "SELECT * FROM (`kigo_properties_pricing_rent`) WHERE `PROP_ID` =  '$pid' AND `WEEKLY_PRICING` = 1";
    	return $this->db->query($sql);    	
    }

    public function GetnightlyRental($pid,$checkin,$checkout){
    	/*$this->db->where('PROP_ID',$pid);
    	$this->db->where('WEEKLY_PRICING','1');
    	$this->db->where('CHECK_IN >= ',$checkin); 
    	$this->db->where('CHECK_OUT <= ',$checkout); */
    	
    	$ucheckin = strtotime($checkin);
    	$ucheckout = strtotime($checkout);
    	
    	$sql = "SELECT * FROM (`kigo_properties_pricing_rent`) WHERE `PROP_ID` =  '$pid' AND `WEEKLY_PRICING` = 1 && UNIX_TIMESTAMP(`CHECK_IN`) = UNIX_TIMESTAMP('$checkin') && UNIX_TIMESTAMP(`CHECK_OUT`) = UNIX_TIMESTAMP('$checkout')";    	    	
    	
    	if($this->db->query($sql)->num_rows() > 0){
			return 'weekly';	
		}
		
    	
    	$sql = "SELECT * FROM (`kigo_properties_pricing_rent`) WHERE `PROP_ID` =  '$pid' AND `WEEKLY_PRICING` = 0";    	    	
    	
    	/*if($this->db->query($sql)->num_rows() <= 0){
			return 'weekly';
		}
    	$result1 =  $this->db->query($sql)->result();    	
    	
    	$sql = "SELECT * FROM (`kigo_properties_pricing_rent`) WHERE `PROP_ID` =  '$pid' AND `WEEKLY_PRICING` = 0 && UNIX_TIMESTAMP(`CHECK_OUT`) >= UNIX_TIMESTAMP('$checkout') && UNIX_TIMESTAMP(`CHECK_IN`) < UNIX_TIMESTAMP('$checkout')";    	
    	
    	$result2 =  $this->db->query($sql)->result();  
    	
    	$temp = array();
    	
    	if(!empty($result2)){
			foreach($result2 as $key => $value){
				$temp[] = $value;
				$temp_ids[] = $value->RENT_ID;
			}
			foreach($result1 as $key => $value){
				if(!in_array($value->RENT_ID,$temp_ids)){
					$temp[] = $value;
				}				
			}
		}
		else{						
			foreach($result1 as $key => $value){
					$temp[] = $value;
			}
		}*/
		
		return $this->db->query($sql)->result();      	
    }
    
    public function GetWeeklyAfternightlyRental($pid,$checkin,$checkout){
    	/*$this->db->where('PROP_ID',$pid);
    	$this->db->where('WEEKLY_PRICING','1');
    	$this->db->where('CHECK_IN >= ',$checkin); 
    	$this->db->where('CHECK_OUT <= ',$checkout); */
    	
    	$sql = "SELECT * FROM (`kigo_properties_pricing_rent`) WHERE `PROP_ID` =  '$pid' AND `WEEKLY_PRICING` = 0";
    	return $this->db->query($sql);    	
    }

    public function GetAllFees($pid){
		$this->db->select('*');
		$this->db->from('kigo_properties_pricing_fees');
		$this->db->join('kigo_fees_types','kigo_properties_pricing_fees.FEE_TYPE_ID = kigo_fees_types.FEE_TYPE_ID');
    	$this->db->where('kigo_properties_pricing_fees.PROP_ID',$pid);
    	$this->db->where('kigo_properties_pricing_fees.INCLUDE_IN_RENT','1');
    	return $this->db->get();
    }
    
    public function slice_weekly_rental($check_in,$check_out){
		$begin = new DateTime( $check_in );
		$end = new DateTime( $check_out );
		$end = $end->modify( '+1 day' );

		$interval = new DateInterval('P7D');
		
		$daterange = new DatePeriod($begin, $interval ,$end);
		
		$i=0;
		$temp_date = array();
		
		foreach($daterange as $date){
			$temp_date[] = $date->format("Y-m-d");
		}
		
		$chunks = array();		
		for($i=0;$i<count($temp_date);$i++){
			if(isset($temp_date[$i+1])){
				$chunks[] = $temp_date[$i].','.$temp_date[$i+1];
			}		
		}
		
		$last_week_date = end($temp_date);
		
		$begin = new DateTime( $last_week_date );
		$end = new DateTime( $check_out );
		$end = $end->modify( '+1 day' );

		$interval = new DateInterval('P1D');
		
		$daterange = new DatePeriod($begin, $interval ,$end);
		
		$night_dates = array();
		
		foreach($daterange as $date){
			$night_dates[] = $date->format("Y-m-d");
		}
		unset($night_dates[0]);
		
		//print_r($chunks);
		//print_r($night_dates);
		//die;
		
		return array('chunks' => $chunks, 'night_dates' => $night_dates);		
	}
	
	public function get_available_dates($pid){
		$this->db->select('CHECK_IN,CHECK_OUT');
		$this->db->where('PROP_ID',$pid);    	
		$this->db->order_by('RENT_ID','DESC');    	
    	return $this->db->get('kigo_properties_pricing_rent');
	}

	public function insert_reservation_calender($reservation_calender){
		$this->db->insert('kigo_reservation_calender', $reservation_calender);
	}

	public function get_kigo_booked_dates($kpid, $type){
		$this->db->select('RES_CHECK_IN as CHECK_IN,RES_CHECK_OUT as CHECK_OUT');
		if($type == 'kigo'){
			//$this->db->where('RES_IS_FOR','1');  
		}else if($type == 'Ticketfinder'){
			//$this->db->where('RES_IS_FOR','0');  
		}
		$this->db->where('PROP_ID',$kpid);
		$this->db->where('RES_STATUS','CONFIRMED');    	
		return $this->db->get('kigo_reservation_calender');
	}
	
	public function get_last_minute_discounts($prop_id){
		$this->db->select('*');
		$this->db->from('kigo_properties_lastminute_discounts');
		$this->db->where('PROP_ID',$prop_id);		
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_special_discounts($prop_id,$check_in,$check_out){
		$this->db->select('*');
		$this->db->from('kigo_properties_special_discounts');
		$this->db->where('PROP_ID',$prop_id);		
		$this->db->where('VALID_FROM <=',date('Y-m-d'));
		$this->db->where('VALID_TO >=',date('Y-m-d'));
		$this->db->where('CHECK_IN >=',$check_in);
		$this->db->where('CHECK_OUT <=',$check_out);
		$query = $this->db->get();
		return $query->result();
		//return $this->db->last_query();
	}
	
	public function get_early_bird_discounts($prop_id){
		$this->db->select('EARLY_BIRD_DISCOUNT_DAYS,EARLY_BIRD_DISCOUNT_PERCENT');
		$this->db->from('kigo_properties');
		$this->db->where('PROPERTY_ID',$prop_id);		
		$query = $this->db->get();
		return $query->row();
	}
	
	public function last_minute_discounts($prop_id){
		$this->db->select('*');
		$this->db->from('kigo_properties_lastminute_discounts');
		$this->db->where('PROP_ID',$prop_id);		
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_special_discount_per($special_discounts,$custom_cin,$custom_cout){
		
		$result1 = array();
		$result = array();
		$result2 = array();
		
		$result = $this->get_day_wise_chunks($custom_cin,$custom_cout);
			
		foreach($special_discounts as $key => $value){
			$result1[$value->DISCOUNT_PERCENTAGE] = $this->get_day_wise_chunks($value->CHECK_IN,$value->CHECK_OUT);
		}
		
		
		foreach($result1 as $key => $value){
			$day_wise_per = ($key/count($value));
			foreach($value as $skey => $svalue){
				$date_special[] = $svalue;
				$per_special[] = $day_wise_per;
			}			
		}
		$percentage_special = array();
		
		foreach($result as $key => $value){
			if(in_array($value,$date_special)){
				$temp = array_search($value,$date_special);				
				$percentage_special[] = $per_special[$temp];
			}
		}
		
		return array_sum($percentage_special);
	}
	
	public function get_key_by_value(){
		
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
	
	public function GetNightlyRentalPeriods($random_id){
		$this->db->select('*');
		$this->db->from('kigo_properties_pricing_nightly_rent');
		$this->db->where('NIGHTLY_RANDOM_ID',$random_id);
		
		$query = $this->db->get();
		return $query->result();
	}

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
        if($data->PROP_USER_TYPE == '3'){
            $this->db->join('b2c', 'b2c.user_id = cart_apartment.PROP_USER_ID');
        }else if($data->PROP_USER_TYPE == '2'){
            $this->db->join('b2b', 'b2b.agent_id = cart_apartment.PROP_USER_ID');
        }
        $this->db->where('cart_id',$cart_global_id);
        return $this->db->get('cart_global');
    }

    public function clearCart($cart_id){
        $this->db->select('ref_id');
        $this->db->where('cart_id',$cart_id);
        $data = $this->db->get('cart_global')->row();
        $ref_id = $data->ref_id;

        $this->db->where('ID',$ref_id);
        $this->db->delete('cart_apartment');
        
        $this->db->where('cart_id',$cart_id);
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
		$this->db->where('module','APARTMENT');
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

    public function getBookingInfo($booking_id){
        $this->db->where('id',$booking_id);
		return $this->db->get('booking_global');
    }

    

    public function Update_Booking_GlobalStatus($booking_id, $update_booking){
        $this->db->where('pnr_no',$booking_id);
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

    public function get_service_charge($api_name, $rangeType){
    	$this->db->join('service_charges','api.api_id = service_charges.api_id');
    	$this->db->where('api.api_name',$api_name);
    	$this->db->where('service_charges.service_type','Guest');
    	$this->db->where('service_charges.service_range',$rangeType);
		return $this->db->get('api');
    }

    public function get_host_charge($api_name, $rangeType){
    	$this->db->join('service_charges','api.api_id = service_charges.api_id');
    	$this->db->where('api.api_name',$api_name);
    	$this->db->where('service_charges.service_type','Host');
    	$this->db->where('service_charges.service_range',$rangeType);
		return $this->db->get('api');
    }

    public function ApartmentTransaction($apartment_transaction){
    	$this->db->insert('apartment_transaction',$apartment_transaction);
    	return $this->db->insert_id();
    }

    public function ApartmentTransactionTracking($apartment_transaction_tracking){
    	$this->db->insert('apartment_transaction_tracking',$apartment_transaction_tracking);
    }
}

