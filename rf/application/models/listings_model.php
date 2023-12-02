<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------|
  | Author: Provab Technosoft Pvt Ltd.									   |
  |--------------------------------------------------------------------------|
  | Developer: Sanjay											   |
  | Started Date: 2014-08-25T13:13:00										   |
  | Ended Date:  										   					   |
  |--------------------------------------------------------------------------|
 */

class Listings_Model extends CI_Model {

    public function get_property_types() {
        $this->db->select('*');
        $this->db->from('kigo_property_types');
        $this->db->order_by('PROP_TYPE_LABEL','asc');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }
    
    public function insert_new_listings($data){
		
		$b2c_id = $this->session->userdata('b2c_id');
		$agent_id = $this->session->userdata('b2b_id');

		if(!empty($b2c_id)){
			$user_id = $b2c_id;	
			$user_type = 3;	
		}
		elseif(!empty($agent_id)){
			$user_id = $agent_id;	
			$user_type = 2;			
		}
			
		$data_insert['PROP_NAME'] = $data['property_name'];
		$data_insert['PROP_TYPE_ID'] = $data['property_type'];
		$data_insert['PROP_MAXGUESTS'] = $data['occupancy'];
		$data_insert['PROP_MAXGUESTS_ADULTS'] = $data['occupancy'] -1;
		$data_insert['PROP_MAXGUESTS_CHILDREN'] = $data['occupancy'] -1;
		$data_insert['PROP_MAXGUESTS_BABIES'] = $data['occupancy'] -1;
		$data_insert['PROP_CITY'] = $data['city'];
		$data_insert['PROP_REGION'] = $data['state'];
		$data_insert['PROP_LATITUDE'] = $data['latitude'];
		$data_insert['PROP_LONGITUDE'] = $data['longitude'];
		$data_insert['AUTOCOMPLETE_ADDRESS'] = $data['listings_city'];
		$data_insert['PROPERTY_PHOTO_IMPORT_STATUS'] = 1;
		$data_insert['PROPERTY_PRICING_IMPORT_STATUS'] = 1;
		$data_insert['PROPERTY_STATUS'] = '0';

		$country = $this->get_country_code($data['country']);
		
		$data_insert['PROP_COUNTRY'] = $country->COUNTRY_CODE;
		$data_insert['USER_ID'] = $user_id;
		$data_insert['USER_TYPE'] = $user_type;
		
		$owner_details = $this->get_owner_details($user_id,$user_type);
		$data_insert['PROVIDER_ID'] = $owner_details->property_owner_id;
		$data_insert['PROP_PROVIDER'] = "OWNER";
		
		$this->db->insert('kigo_properties',$data_insert);
		$list_id = $this->db->insert_id();
		
		$models_array = array('listings_general','listings_photos','listings_rent_calculations','listings_pinmap');
		
		foreach($models_array as $key => $value)
		{
			$data_insert_models = "";
			$data_insert_models['listings_id'] = $list_id;
			$data_insert_models['model_name']  = $value;
			$this->db->insert('property_listings_model',$data_insert_models);
		}		
		return $list_id;
	}
	
	public function get_country_code($country_code){
		$this->db->select('*');
		$this->db->from('kigo_countries');
		$this->db->where('COUNTRY_NAME',$country_code);
		
		$query = $this->db->get();
		return $query->row();				
	}
	
	public function get_owner_details($user_id,$user_type){
		if($user_type == 3){
			$this->db->select('*');
			$this->db->from('b2c');
			$this->db->where('user_id',$user_id);
			
			$query = $this->db->get();
			return $query->row();
		}
	}
	
	public function check_b2c_onwer_creation(){
		
		$b2c_id = $this->session->userdata('b2c_id');
		
		$this->db->select('property_owner_created');
		$this->db->from('b2c');
		$this->db->where('user_id',$b2c_id);
		
		$query = $this->db->get();
		return $query->row();
	}

	public function check_b2b_onwer_creation(){
		
		$b2c_id = $this->session->userdata('b2b_id');
		
		$this->db->select('property_owner_created');
		$this->db->from('b2b');
		$this->db->where('agent_id',$b2c_id);
		
		$query = $this->db->get();
		return $query->row();
	}
	
	public function get_property_listings($list_id){
		
		$b2c_id = $this->session->userdata('b2c_id');
		$b2b_id = $this->session->userdata('b2b_id');

		if(!empty($b2c_id)){
			$user_id = $b2c_id; 	
			$user_type = 3; 	
		}elseif(!empty($b2b_id)){
			$user_id = $b2b_id; 	
			$user_type = 2; 	
		}
		
		$this->db->select('*');
		$this->db->from('kigo_properties');
		$this->db->where('PROPERTY_ID',$list_id);
		$this->db->where('USER_ID',$user_id);
		$this->db->where('USER_TYPE',$user_type);
		
		$query = $this->db->get();
		return $query->row();
	}
	
	public function time_slot() {
        $time_slot = array("00:00", "00:30", "01:00", "01:30", "02:00", "02:30", "03:00", "03:30", "04:00", "04:30", "05:00", "05:30", "06:00", "06:30", "07:00", "07:30", "08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30", "19:00", "19:30", "20:00", "20:30", "21:00", "21:30", "22:00", "22:30", "23:00", "23:30");
        return $time_slot;
    }
    
     public function get_currency() {
        $this->db->select('*');
        $this->db->from('kigo_currency');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }
    
    public function get_countries() {
        $this->db->select('COUNTRY_CODE as alpha2,COUNTRY_NAME as langEN');
        $this->db->from('kigo_countries');

        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_amenities() {
        $this->db->select('*');
        $this->db->from('kigo_amenities');
        $this->db->join('kigo_amenities_category', 'kigo_amenities_category.AMENITY_CATEGORY_ID = kigo_amenities.AMENITY_CATEGORY_ID');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }
    
    public function get_activities() {
        $this->db->select('*');
        $this->db->from('kigo_activities');
        $this->db->join('kigo_activity_category', 'kigo_activity_category.ACTIVITY_CATEGORY_ID = kigo_activities.ACTIVITY_CATEGORY_ID');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }
    
    public function get_property_udpa() {
        $this->db->select('*');
        $this->db->from('kigo_properties_udpa');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }
    
    public function property_udpa_values($list_id) {
        $this->db->select('*');
        $this->db->from('kigo_properties_userdefined_fields');
        $this->db->where('PROP_ID',$list_id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }
    
    public function get_property_listings_models($list_id, $model_name){
		$this->db->select('*');
        $this->db->from('property_listings_model');
        $this->db->where('listings_id',$list_id);
        $this->db->where('model_name',$model_name);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return "";
        }
	}
	
	public function kigo_properties_pdtp(){
		$this->db->select('*');
        $this->db->from('kigo_properties_pdtp');
        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
	}
	
	public function update_listing_property_step1($data){
		$data_update['PROP_NAME'] = $data['property_name'];
		$data_update['PROP_TYPE_ID'] = $data['property_type'];
		$data_update['PROP_SIZE'] = $data['property_size_value'];
		$data_update['PROP_SIZE_UNIT'] = $data['property_size_unit'];
		$data_update['PROP_BEDROOMS'] = $data['bedrooms'];
		$data_update['PROP_BEDS'] = $data['beds'];
		$data_update['PROP_COUT_TIME'] = $data['checkout'];
		$data_update['PROP_CIN_TIME'] = $data['checkin'];
		$data_update['PROP_FLOOR'] = $data['floor'];
		$data_update['PROP_ELEVATOR'] = $data['elevator'];
		$data_update['PROP_BATHROOMS'] = $data['bathrooms'];
		$data_update['PROP_TOILETS'] = $data['toilets'];
		$data_update['PROP_CLEAN_TIME'] = $data['avg_cleaning_time'];
		$data_update['PROP_RATE_CURRENCY'] = $data['currency'];
		$data_update['PROP_RATE_NIGHTLY_FROM'] = $data['nightly_rate_from'];
		$data_update['PROP_RATE_NIGHTLY_TO'] = $data['nightly_rate_to'];
		$data_update['PROP_RATE_WEEKLY_FROM'] = $data['weekly_rate_from'];
		$data_update['PROP_RATE_WEEKLY_TO'] = $data['weekly_rate_to'];
		$data_update['PROP_RATE_MONTHLY_FROM'] = $data['monthly_rate_from'];
		$data_update['PROP_RATE_MONTHLY_TO'] = $data['monthly_rate_to'];
		$data_update['PROP_MAXGUESTS'] = $data['max_guests'];
		$data_update['PROP_MAXGUESTS_ADULTS'] = $data['max_adults'];
		$data_update['PROP_MAXGUESTS_CHILDREN'] = $data['max_child'];
		$data_update['PROP_MAXGUESTS_BABIES'] = $data['max_babies'];
		$data_update['PROP_STAYTIME_MIN_VALUE'] = $data['min_stay'];
		$data_update['PROP_STAYTIME_MIN_UNIT'] = $data['min_stay_unit'];
		$data_update['PROP_STAYTIME_MAX_VALUE'] = $data['max_stay'];
		$data_update['PROP_STAYTIME_MAX_UNIT'] = $data['max_stay_unit'];
		$data_update['PROP_POSTCODE'] = $data['postal_code'];
		$data_update['PROP_APTNO'] = $data['apartment_no'];
		//$data_update['PROP_ADDR1'] = $data['address1'];
		//$data_update['PROP_ADDR2'] = $data['address2'];
		//$data_update['PROP_ADDR3'] = $data['address3'];
		//$data_update['PROP_CITY'] = $data['city'];
		$data_update['PROP_PHONE'] = $data['phone_no'];
		//$data_update['PROP_REGION'] = $data['region'];
		$data_update['PROP_AXSCODE'] = $data['access_code'];
		//$data_update['PROP_COUNTRY'] = $data['countries'];
		//$data_update['PROP_LATITUDE'] = $data['latitude'];
		//$data_update['PROP_LONGITUDE'] = $data['longitude'];
		$data_update['PROP_SHORTDESCRIPTION'] = $data['short_property_description'];
		$data_update['PROP_DESCRIPTION'] = $data['full_property_description'];
		$data_update['PROP_AREADESCRIPTION'] = $data['area_property_description'];
		$data_update['PROP_RENTAL_DETAILS'] = $data['rental_details'];
		$data_update['PROP_INVENTORY'] = $data['inventory'];
		$data_update['PROP_ARRIVAL_SHEET'] = $data['arrival_sheet'];
		$data_update['PROP_STREETNO'] = $data['street_no'];
		$data_update['PROP_INSTANT_BOOK'] = $data['prop_instant_book'];
		$data_update['PROP_BED_TYPES'] = $data['property_bed_types'];
        $data_update['PROP_CANCELLATION_TYPE'] = $data['cancellation_type'];
        $data_update['PROP_CANCELLATION_DETAILS'] = $data['cancellation_details'];
        $data_update['PROP_CANCELLATION_ADDITIONAL_NOTE'] = $data['additional_note'];
        $data_update['PROP_BEFORE_DAYS'] = $data['cancellation_before_days'];                
		

		if(!empty($data['amentites'])){
			$data_update['PROP_AMENITIES'] = implode(',',$data['amentites']);
		}
		else
		{
			$data_update['PROP_AMENITIES'] = "";
		}
		
		if(!empty($data['activities'])){
			$data_update['PROP_ACTIVITIES'] = implode(',',$data['activities']);
		}
		else
		{
			$data_update['PROP_ACTIVITIES'] = "";
		}
		
		$this->db->where('PROPERTY_ID',$data['list_id']);
		$this->db->update('kigo_properties',$data_update);
				
		$this->db->where('PROP_ID',$data['list_id']);
		$this->db->delete('kigo_properties_userdefined_fields');
		
		for($i=0;$i<count($data['udpa_name']);$i++){
			$data_insert['PROP_ID'] = $data['list_id'];
			$data_insert['UDPA_ID'] = $data['udpa_name'][$i];
			$data_insert['UDPA_TEXT'] = $data['udpa_value'][$i];
			
			$this->db->insert('kigo_properties_userdefined_fields',$data_insert);
		}

		$this->db->select('completed_status');
		$this->db->from('property_listings_model');
		$this->db->where('listings_id',$data['list_id']);
		$this->db->where('model_name','listings_general');

		$query = $this->db->get();
		$result = $query->row();
		$previous_completed_status = $result->completed_status;

		$this->db->select('completed_status');
		$this->db->from('property_listings_model');
		$this->db->where('listings_id',$data['list_id']);
		$this->db->where('completed_status',1);

		$query = $this->db->get();
		$result = $query->result();
		$count_result = count($result);

		$this->db->where('listings_id',$data['list_id']);
		$this->db->where('model_name','listings_general');
		$this->db->update('property_listings_model',array('completed_status' => 1));

		return array('previous_completed_status' => $previous_completed_status, 'count_result' => $count_result);
	}
	
	public function update_listing_property_step2($data){
		
		$this->db->where('PROP_ID',$data['edit_listings_udpa']);
		$this->db->delete('kigo_properties_userdefined_fields');
		
		for($i=0;$i<count($data['name']);$i++){
			$data_insert['PROP_ID'] = $data['edit_listings_udpa'];
			$data_insert['UDPA_ID'] = $data['name'][$i];
			$data_insert['UDPA_TEXT'] = $data['value'][$i];
			
			$this->db->insert('kigo_properties_userdefined_fields',$data_insert);
		}
		
		$this->db->where('listings_id',$data['edit_listings_udpa']);
		$this->db->where('model_name','listings_udpa');
		$this->db->update('property_listings_model',array('completed_status' => 1));	
	}
	
	public function get_user_listings($user_id,$user_type,$ajaxRequest=null, $prop_status=null){
		$query = "SELECT * FROM `kigo_properties`,`kigo_property_types` WHERE `USER_ID` = $user_id AND `USER_TYPE` = $user_type";
		$where = "";

		if(!is_null($prop_status) && $prop_status != "") {
			if($prop_status == 1) { 
				//show all listings
			} else if($prop_status == 2) {				
				$where = " AND `PROPERTY_STATUS` = '1' AND (`ADMIN_APPROVAL_STATUS` = '0' AND `PROP_COUNTRY` != 'AE') ";
			} else if($prop_status == 3) {				
				$where = " AND ( `PROPERTY_STATUS` = '0' OR ( `ADMIN_APPROVAL_STATUS` = '0' AND `PROP_COUNTRY` = 'AE') )  ";				
			}
		}

		$where1 = $where . ' AND kigo_properties.PROP_TYPE_ID = kigo_property_types.PROP_TYPE_ID';
		$sql = $query.$where1;

		$query = mysql_query($sql);
		$result = array();
		while($row = mysql_fetch_object($query)){
			$result[] = $row;
		}

		return $result;
	}

	public function get_public_profile_user_listings($user_id) {
		$this->db->where('USER_ID',$user_id);
		$this->db->where('PROPERTY_STATUS', '1'); //get them when property status is 1.
		$this->db->join('kigo_property_types','kigo_properties.PROP_TYPE_ID = kigo_property_types.PROP_TYPE_ID');
		//$this->db->limit(4);
		$query = $this->db->get('kigo_properties');
		if($query->num_rows() > 0){
			return $query->result();
		}
	}
	
	public function get_property_listings_completed_modules($property_id){
		$this->db->select('*');
		$this->db->from('property_listings_model');
		$this->db->where('listings_id',$property_id);
		
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
		return 0;
		}
	}
	
	public function update_listing_property_step3($data){

		$this->db->where('PROP_ID',$data['property_id']);
		$this->db->delete('kigo_properties_photo');

		if(!empty($data['image']))
		{
			for($i=0;$i<count($data['image']);$i++){				
			    $data_insert['PROP_ID'] = $data['property_id'];
			    $data_insert['PHOTO_COMMENTS'] = $data['image_comment'][$i];
			    $data_insert['PHOTO_NAME'] = $data['image_name'][$i];
			    $data_insert['PHOTO_PANORAMIC'] = $data['image_panaromic'][$i];
			    $data_insert['PHOTO_CONTENT'] = $data['image'][$i];

			    $this->db->insert('kigo_properties_photo',$data_insert);
		    }
		}

		$this->db->select('completed_status');
		$this->db->from('property_listings_model');
		$this->db->where('listings_id',$data['property_id']);
		$this->db->where('model_name','listings_photos');

		$query = $this->db->get();
		$result = $query->row();
		$previous_completed_status = $result->completed_status;

		$this->db->select('completed_status');
		$this->db->from('property_listings_model');
		$this->db->where('listings_id',$data['property_id']);
		$this->db->where('completed_status',1);

		$query = $this->db->get();
		$result = $query->result();
		$count_result = count($result);

		$this->db->where('listings_id',$data['property_id']);
		$this->db->where('model_name','listings_photos');
		$this->db->update('property_listings_model',array('completed_status' => 1));

		return array('previous_completed_status' => $previous_completed_status, 'count_result' => $count_result);
    }
	
	public function update_listing_property_step4($data){
		
		if(isset($data['early_bird_days']))
		{
			$early_bird_days = $data['early_bird_days'];
			$early_bird_discount = $data['early_bird_discount'];
			
			$data_insert = ""; 
			
			$data_insert = array(
               'EARLY_BIRD_DISCOUNT_DAYS' => $early_bird_days,
               'EARLY_BIRD_DISCOUNT_PERCENT' => $early_bird_discount
            );
            
			$this->db->where('PROPERTY_ID',$data['edit_listings_discounts']);
			$this->db->update('kigo_properties',$data_insert); 
		}	
		
		
		$this->db->where('PROP_ID',$data['edit_listings_discounts']);
		$this->db->delete('kigo_properties_lastminute_discounts');
		
		$data_insert = "";
		
		if(!empty($data['lmd_days'])){
			for($i=0;$i<count($data['lmd_days']);$i++){
				$data_insert['DISCOUNT_BEFORE_CHECKIN_DAYS'] = $data['lmd_days'][$i];
				$data_insert['DISCOUNT_PERCENTAGE'] = $data['lmd_discount'][$i];
				$data_insert['PROP_ID'] = $data['edit_listings_discounts'];		
				
				$this->db->insert('kigo_properties_lastminute_discounts',$data_insert);		
			}
		}
		
		$this->db->where('PROP_ID',$data['edit_listings_discounts']);
		$this->db->delete('kigo_properties_special_discounts');
		
		$data_insert = "";
		if(!empty($data['spd_checkin'])){
			for($i=0;$i<count($data['spd_checkin']);$i++){
				$data_insert['CHECK_IN'] = $data['spd_checkin'][$i];
				$data_insert['CHECK_OUT'] = $data['spd_checkout'][$i];
				$data_insert['VALID_FROM'] = $data['spd_validfrom'][$i];
				$data_insert['VALID_TO'] = $data['spd_validto'][$i];
				$data_insert['DISCOUNT_NAME'] = $data['spd_valid_disountname'][$i];
				$data_insert['DISCOUNT_PERCENTAGE'] = $data['spd_valid_disountper'][$i];
				$data_insert['PROP_ID'] = $data['edit_listings_discounts'];
				
				$this->db->insert('kigo_properties_special_discounts',$data_insert);		
			}
		}
		
		$this->db->where('listings_id',$data['edit_listings_discounts']);
		$this->db->where('model_name','listings_discounts');
		$this->db->update('property_listings_model',array('completed_status' => 1));	
	}
	
	public function update_listing_property_step5($data){		
		$fees_types_value = array();

        $this->db->where('PROP_ID', $data['edit_listings_otherfees']);
        $this->db->delete('kigo_properties_pricing_fees');

        if (!empty($data['fees_types'])) {
            foreach ($data['fees_types'] as $key => $value) {
                if ($data['unit_' . $value] == 'AMOUNT' || $data['unit_' . $value] == 'AMOUNT_PER_NIGHT' || $data['unit_' . $value] == 'PERCENT_RENT') {
                    $temp = new stdClass();
                    $temp->FEE_TYPE_ID = $value;
                    if (!empty($data['fees_types_inr']) && in_array($value, $data['fees_types_inr'])) {
                        $temp->INCLUDE_IN_RENT = 1;
                    } else {
                        $temp->INCLUDE_IN_RENT = "";
                    }
                    $temp->UNIT = $data['unit_' . $value];
                    $temp->VALUE = $data['fees_value_' . $value];
                    $fees_types_value[] = $temp;
                }
                if ($data['unit_' . $value] == 'AMOUNT_PER_GUEST' || $data['unit_' . $value] == 'AMOUNT_PER_NIGHT_PER_GUEST') {
                    $temp = new stdClass();
                    $temp->FEE_TYPE_ID = $value;
                    if (!empty($data['fees_types_inr']) && in_array($value, $data['fees_types_inr'])) {
                        $temp->INCLUDE_IN_RENT = 1;
                    } else {
                        $temp->INCLUDE_IN_RENT = "";
                    }
                    $temp->UNIT = $data['unit_' . $value];
                    $temp->VALUE = new stdClass();
                    $temp->VALUE->AMOUNT_ADULT = $data['fees_value_adult_' . $value];
                    $temp->VALUE->AMOUNT_CHILD = $data['fees_value_child_' . $value];
                    $temp->VALUE->AMOUNT_BABY = $data['fees_value_baby_' . $value];
                    $fees_types_value[] = $temp;
                }
                if ($data['unit_' . $value] == 'STAYLENGTH') {
                    $temp = new stdClass();
                    $temp->FEE_TYPE_ID = $value;

                    if (!empty($data['fees_types_inr']) && in_array($value, $data['fees_types_inr'])) {
                        $temp->INCLUDE_IN_RENT = 1;
                    } else {
                        $temp->INCLUDE_IN_RENT = "";
                    }
                    $temp->UNIT = $data['unit_' . $value];
                    $temp->VALUE = array();

                    foreach ($data['fees_value_staylength_unit_' . $value] as $skey => $svalue) {
                        if ($svalue == "AMOUNT_PER_NIGHT_PER_GUEST") {
                            foreach ($data['fees_value_staylength_value_adult_' . $value] as $kr => $vr) {
                                foreach ($vr as $krr => $vrr) {
                                    $kkr = new stdClass();
                                    $kkr->STAY_FROM = new stdClass();
                                    $kkr->STAY_FROM->UNIT = $krr;
                                    $kkr->STAY_FROM->NUMBER = $kr;
                                    $kkr->UNIT = $svalue;
                                    $kkr->VALUE = new stdClass();
                                    $kkr->VALUE->AMOUNT_ADULT = $vrr;
                                    $kkr->VALUE->AMOUNT_CHILD = $data['fees_value_staylength_value_child_' . $value][$kr][$krr];
                                    $kkr->VALUE->AMOUNT_BABY = $data['fees_value_staylength_value_baby_' . $value][$kr][$krr];
                                    $temp->VALUE[] = $kkr;
                                    unset($data['fees_value_staylength_value_adult_' . $value][$kr]);
                                }
                            }
                        }
                        if ($svalue == "AMOUNT") {
                            foreach ($data['fees_value_staylength_value_amt_' . $value] as $kr => $vr) {
                                foreach ($vr as $krr => $vrr) {
                                    $kkr = new stdClass();
                                    $kkr->STAY_FROM = new stdClass();
                                    $kkr->STAY_FROM->UNIT = $krr;
                                    $kkr->STAY_FROM->NUMBER = $kr;
                                    $kkr->UNIT = "AMOUNT";
                                    $kkr->VALUE = $vrr;
                                    $temp->VALUE[] = $kkr;
                                    unset($data['fees_value_staylength_value_amt_' . $value][$kr]);
                                }
                            }
                        }
                        if ($svalue == "AMOUNT_PER_GUEST") {
                            foreach ($data['fees_value_staylength_value_adult_apg' . $value] as $kr => $vr) {
                                foreach ($vr as $krr => $vrr) {
                                    $kkr = new stdClass();
                                    $kkr->STAY_FROM = new stdClass();
                                    $kkr->STAY_FROM->UNIT = $krr;
                                    $kkr->STAY_FROM->NUMBER = $kr;
                                    $kkr->UNIT = $svalue;
                                    $kkr->VALUE = new stdClass();
                                    $kkr->VALUE->AMOUNT_ADULT = $vrr;
                                    $kkr->VALUE->AMOUNT_CHILD = $data['fees_value_staylength_value_child_apg' . $value][$kr][$krr];
                                    $kkr->VALUE->AMOUNT_BABY = $data['fees_value_staylength_value_baby_apg' . $value][$kr][$krr];
                                    $temp->VALUE[] = $kkr;
                                    unset($data['fees_value_staylength_value_adult_apg' . $value][$kr]);
                                }
                            }
                        }
                        if ($svalue == "PERCENT_RENT") {
                            foreach ($data['fees_value_staylength_value_pct_' . $value] as $kr => $vr) {
                                foreach ($vr as $krr => $vrr) {
                                    $kkr = new stdClass();
                                    $kkr->STAY_FROM = new stdClass();
                                    $kkr->STAY_FROM->UNIT = $krr;
                                    $kkr->STAY_FROM->NUMBER = $kr;
                                    $kkr->UNIT = "PERCENT_RENT";
                                    $kkr->VALUE = $vrr;
                                    $temp->VALUE[] = $kkr;
                                    unset($data['fees_value_staylength_value_pct_' . $value][$kr]);
                                }
                            }
                        }
                    }
                    $fees_types_value[] = $temp;
                }
            }
            foreach ($fees_types_value as $key => $value) {
                $data_insert['PROP_ID'] = $data['edit_listings_otherfees'];
                $data_insert['FEE_TYPE_ID'] = $value->FEE_TYPE_ID;
                $data_insert['INCLUDE_IN_RENT'] = $value->INCLUDE_IN_RENT;
                $data_insert['UNIT'] = $value->UNIT;
                $data_insert['VALUE'] = json_encode($value->VALUE);
                $this->db->insert('kigo_properties_pricing_fees', $data_insert);
            }
        }
        
        $this->db->where('listings_id',$data['edit_listings_otherfees']);
		$this->db->where('model_name','listings_fees_deposits');
		$this->db->update('property_listings_model',array('completed_status' => 1));
	}
	
	public function get_property_special_discounts($property_id){
		$this->db->select('*');
		$this->db->from('kigo_properties_special_discounts');
		$this->db->where('PROP_ID',$property_id);
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
	
	public function get_property_lastminute_discounts($property_id){
		$this->db->select('*');
		$this->db->from('kigo_properties_lastminute_discounts');
		$this->db->where('PROP_ID',$property_id);
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
	
	public function get_property_photos($property_id, $limit = null){   //$limit added by vikas to get single photo (for profile view page)
		
		$this->db->select('*');
		$this->db->from('kigo_properties_photo');
		$this->db->where('PROP_ID',$property_id);
		$this->db->where('PHOTO_CONTENT !=','');
		
		if($limit == 1) {
			$this->db->limit(1);
		} 

		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		
	}
	
	public function get_fees_types() {
        $this->db->select('*');
        $this->db->from('kigo_fees_types');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }
    
    public function property_fees_types($property_id) {
        $this->db->select('*');
        $this->db->from('kigo_properties_pricing_fees');
        $this->db->where('PROP_ID', $property_id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }
    
    public function get_property_pricing_by_id($property_id) {
        $this->db->select('*');
        $this->db->from('kigo_properties_pricing_rent');
        $this->db->where('PROP_ID', $property_id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }
    
    public function update_listing_property_step6($data){
		
		$fees_types_value = array();

        $this->db->where('PROP_ID', $data['edit_listings_rent']);
        $this->db->delete('kigo_properties_pricing_fees');

        if (!empty($data['fees_types'])) {
            foreach ($data['fees_types'] as $key => $value) {
                if ($data['unit_' . $value] == 'AMOUNT' || $data['unit_' . $value] == 'AMOUNT_PER_NIGHT' || $data['unit_' . $value] == 'PERCENT_RENT') {
                    $temp = new stdClass();
                    $temp->FEE_TYPE_ID = $value;
                    if (!empty($data['fees_types_inr']) && in_array($value, $data['fees_types_inr'])) {
                        $temp->INCLUDE_IN_RENT = 1;
                    } else {
                        $temp->INCLUDE_IN_RENT = "";
                    }
                    $temp->UNIT = $data['unit_' . $value];
                    $temp->VALUE = $data['fees_value_' . $value];
                    $fees_types_value[] = $temp;
                }
                if ($data['unit_' . $value] == 'AMOUNT_PER_GUEST' || $data['unit_' . $value] == 'AMOUNT_PER_NIGHT_PER_GUEST') {
                    $temp = new stdClass();
                    $temp->FEE_TYPE_ID = $value;
                    if (!empty($data['fees_types_inr']) && in_array($value, $data['fees_types_inr'])) {
                        $temp->INCLUDE_IN_RENT = 1;
                    } else {
                        $temp->INCLUDE_IN_RENT = "";
                    }
                    $temp->UNIT = $data['unit_' . $value];
                    $temp->VALUE = new stdClass();
                    $temp->VALUE->AMOUNT_ADULT = $data['fees_value_adult_' . $value];
                    $temp->VALUE->AMOUNT_CHILD = $data['fees_value_child_' . $value];
                    $temp->VALUE->AMOUNT_BABY = $data['fees_value_baby_' . $value];
                    $fees_types_value[] = $temp;
                }
                if ($data['unit_' . $value] == 'STAYLENGTH') {
                    $temp = new stdClass();
                    $temp->FEE_TYPE_ID = $value;

                    if (!empty($data['fees_types_inr']) && in_array($value, $data['fees_types_inr'])) {
                        $temp->INCLUDE_IN_RENT = 1;
                    } else {
                        $temp->INCLUDE_IN_RENT = "";
                    }
                    $temp->UNIT = $data['unit_' . $value];
                    $temp->VALUE = array();

                    foreach ($data['fees_value_staylength_unit_' . $value] as $skey => $svalue) {
                        if ($svalue == "AMOUNT_PER_NIGHT_PER_GUEST") {
                            foreach ($data['fees_value_staylength_value_adult_' . $value] as $kr => $vr) {
                                foreach ($vr as $krr => $vrr) {
                                    $kkr = new stdClass();
                                    $kkr->STAY_FROM = new stdClass();
                                    $kkr->STAY_FROM->UNIT = $krr;
                                    $kkr->STAY_FROM->NUMBER = $kr;
                                    $kkr->UNIT = $svalue;
                                    $kkr->VALUE = new stdClass();
                                    $kkr->VALUE->AMOUNT_ADULT = $vrr;
                                    $kkr->VALUE->AMOUNT_CHILD = $data['fees_value_staylength_value_child_' . $value][$kr][$krr];
                                    $kkr->VALUE->AMOUNT_BABY = $data['fees_value_staylength_value_baby_' . $value][$kr][$krr];
                                    $temp->VALUE[] = $kkr;
                                    unset($data['fees_value_staylength_value_adult_' . $value][$kr]);
                                }
                            }
                        }
                        if ($svalue == "AMOUNT") {
                            foreach ($data['fees_value_staylength_value_amt_' . $value] as $kr => $vr) {
                                foreach ($vr as $krr => $vrr) {
                                    $kkr = new stdClass();
                                    $kkr->STAY_FROM = new stdClass();
                                    $kkr->STAY_FROM->UNIT = $krr;
                                    $kkr->STAY_FROM->NUMBER = $kr;
                                    $kkr->UNIT = "AMOUNT";
                                    $kkr->VALUE = $vrr;
                                    $temp->VALUE[] = $kkr;
                                    unset($data['fees_value_staylength_value_amt_' . $value][$kr]);
                                }
                            }
                        }
                        if ($svalue == "AMOUNT_PER_GUEST") {
                            foreach ($data['fees_value_staylength_value_adult_apg' . $value] as $kr => $vr) {
                                foreach ($vr as $krr => $vrr) {
                                    $kkr = new stdClass();
                                    $kkr->STAY_FROM = new stdClass();
                                    $kkr->STAY_FROM->UNIT = $krr;
                                    $kkr->STAY_FROM->NUMBER = $kr;
                                    $kkr->UNIT = $svalue;
                                    $kkr->VALUE = new stdClass();
                                    $kkr->VALUE->AMOUNT_ADULT = $vrr;
                                    $kkr->VALUE->AMOUNT_CHILD = $data['fees_value_staylength_value_child_apg' . $value][$kr][$krr];
                                    $kkr->VALUE->AMOUNT_BABY = $data['fees_value_staylength_value_baby_apg' . $value][$kr][$krr];
                                    $temp->VALUE[] = $kkr;
                                    unset($data['fees_value_staylength_value_adult_apg' . $value][$kr]);
                                }
                            }
                        }
                        if ($svalue == "PERCENT_RENT") {
                            foreach ($data['fees_value_staylength_value_pct_' . $value] as $kr => $vr) {
                                foreach ($vr as $krr => $vrr) {
                                    $kkr = new stdClass();
                                    $kkr->STAY_FROM = new stdClass();
                                    $kkr->STAY_FROM->UNIT = $krr;
                                    $kkr->STAY_FROM->NUMBER = $kr;
                                    $kkr->UNIT = "PERCENT_RENT";
                                    $kkr->VALUE = $vrr;
                                    $temp->VALUE[] = $kkr;
                                    unset($data['fees_value_staylength_value_pct_' . $value][$kr]);
                                }
                            }
                        }
                    }
                    $fees_types_value[] = $temp;
                }
            }
            foreach ($fees_types_value as $key => $value) {
                $data_insert['PROP_ID'] = $data['edit_listings_rent'];
                $data_insert['FEE_TYPE_ID'] = $value->FEE_TYPE_ID;
                $data_insert['INCLUDE_IN_RENT'] = $value->INCLUDE_IN_RENT;
                $data_insert['UNIT'] = $value->UNIT;
                $data_insert['VALUE'] = json_encode($value->VALUE);
                $this->db->insert('kigo_properties_pricing_fees', $data_insert);
            }
        }
        
        //Discounts
        
        if(isset($data['early_bird_days']))
		{
			$early_bird_days = $data['early_bird_days'];
			$early_bird_discount = $data['early_bird_discount'];
			
			$data_insert = ""; 
			
			$data_insert = array(
               'EARLY_BIRD_DISCOUNT_DAYS' => $early_bird_days,
               'EARLY_BIRD_DISCOUNT_PERCENT' => $early_bird_discount
            );
            
			$this->db->where('PROPERTY_ID',$data['edit_listings_rent']);
			$this->db->update('kigo_properties',$data_insert); 
		}	
		
		
		$this->db->where('PROP_ID',$data['edit_listings_rent']);
		$this->db->delete('kigo_properties_lastminute_discounts');
		
		$data_insert = "";
		
		if(!empty($data['lastminute_discounts_days'])){
			for($i=0;$i<count($data['lastminute_discounts_days']);$i++){
				$data_insert['DISCOUNT_BEFORE_CHECKIN_DAYS'] = $data['lastminute_discounts_days'][$i];
				$data_insert['DISCOUNT_PERCENTAGE'] = $data['lastminute_discounts'][$i];
				$data_insert['PROP_ID'] = $data['edit_listings_rent'];		
				
				$this->db->insert('kigo_properties_lastminute_discounts',$data_insert);		
			}
		}
		
		$this->db->where('PROP_ID',$data['edit_listings_rent']);
		$this->db->delete('kigo_properties_special_discounts');
		
		$data_insert = "";
		if(!empty($data['psd_checkin'])){
			for($i=0;$i<count($data['psd_checkin']);$i++){
				$data_insert['CHECK_IN'] = $data['psd_checkin'][$i];
				$data_insert['CHECK_OUT'] = $data['psd_checkout'][$i];
				$data_insert['VALID_FROM'] = $data['psd_validfrom'][$i];
				$data_insert['VALID_TO'] = $data['psd_validto'][$i];
				$data_insert['DISCOUNT_NAME'] = $data['psd_discount_name'][$i];
				$data_insert['DISCOUNT_PERCENTAGE'] = $data['psd_discount_per'][$i];
				$data_insert['PROP_ID'] = $data['edit_listings_discounts'];
				
				$this->db->insert('kigo_properties_special_discounts',$data_insert);		
			}
		}
		
        // Rent calculation
		
		if (!empty($data['price_check_in'])) {

            $this->db->where('PROP_ID', $data['edit_listings_rent']);
            $this->db->delete('kigo_properties_pricing_rent');

            $this->db->where('PROP_ID', $data['edit_listings_rent']);
            $this->db->delete('kigo_properties_pricing_nightly_rent');
			
			$data_insert = "";
			
            for ($i = 0; $i < count($data['price_check_in']); $i++) {
                $weekly_guest_from = array();
                $weekly_amount = array();
				
                $data_insert['CHECK_IN'] = $data['price_check_in'][$i];
                $data_insert['CHECK_OUT'] = $data['price_check_out'][$i];
                $data_insert['STAY_MIN_UNIT'] = $data['price_min_stay_unit'][$i];
                $data_insert['STAY_MIN_VALUE'] = $data['price_min_stay_value'][$i];
                $data_insert['NAME'] = $data['price_period_name'][$i];
                $data_insert['PERGUEST_CHARGE_TYPE'] = $data['perguest_type'];
                $data_insert['PERGUEST_CHARGE_STANDARD_OCCUPANCY'] = $data['perguest_standard_occupancy'];
                $data_insert['PERGUEST_CHARGE_MAX_OCCUPANCY'] = $data['perguest_max_occupancy'];
                $data_insert['PROP_ID'] = $data['edit_listings_rent'];
                $data_insert['CURRENCY'] = "USD";
                
                if (isset($data['weekly_amount'][$i]) && !empty($data['weekly_amount'][$i])) {
                    $data_insert['WEEKLY_PRICING'] = 0;
                    foreach ($data['weekly_amount'][$i] as $key => $value) {
                        $weekly_guest_from[] = $key;
                        $weekly_amount[] = $value;
                    }
                    $data_insert['WEEKY_GUEST_FROM'] = implode(',', $weekly_guest_from);
                    $data_insert['WEEKLY_AMOUNT'] = implode(',', $weekly_amount);
                    $data_insert['WEEKLY_PRICING'] = 1;
                } else {
                    $data_insert['WEEKLY_PRICING'] = 0;
                    $data_insert['NIGHTLY_RANDOM'] = uniqid('NW');
                    
                    foreach ($data['nightly_amount'][$i] as $key => $value) {
                        foreach ($value as $sk => $sv) {
                            foreach ($sv as $ssk => $ssv) {
                                foreach ($ssv as $sssk => $sssv) {
                                    $data_insert_night['NIGHTLY_STAY_NUMBER'] = $ssk;
                                    $data_insert_night['NIGHTLY_GUESTS_FROM'] = $sk;
                                    $data_insert_night['WEEK_NIGHTS'] = $key;
                                    $data_insert_night['NIGHTLY_RANDOM_ID'] = $data_insert['NIGHTLY_RANDOM'];
                                    $data_insert_night['PROP_ID'] = $data['edit_listings_rent'];
                                    $data_insert_night['NIGHTLY_STAY_UNIT'] = $sssk;
                                    $data_insert_night['NIGHTLY_AMOUNT'] = $sssv;

                                    $this->db->insert('kigo_properties_pricing_nightly_rent', $data_insert_night);
                                }
                            }
                        }
                    }
                }
               
                $this->db->insert('kigo_properties_pricing_rent', $data_insert);
            }

            $this->db->select('completed_status');
			$this->db->from('property_listings_model');
			$this->db->where('listings_id',$data['edit_listings_rent']);
			$this->db->where('model_name','listings_rent_calculations');

			$query = $this->db->get();		
			
			$result = $query->row();
			$previous_completed_status = $result->completed_status;	
			
			$this->db->select('completed_status');
			$this->db->from('property_listings_model');
			$this->db->where('listings_id',$data['edit_listings_rent']);
			$this->db->where('completed_status',1);

			$query = $this->db->get();
			$result = $query->result();
			$count_result = count($result);		

			$this->db->where('listings_id',$data['edit_listings_rent']);
			$this->db->where('model_name','listings_rent_calculations');
			$this->db->update('property_listings_model',array('completed_status' => 1));		
        }	

		return array('previous_completed_status' => $previous_completed_status, 'count_result' => $count_result);
	}
	
	public function update_listing_property_step7($data){
		$data_update['AUTOCOMPLETE_ADDRESS'] = $data['listings_city'];
		$data_update['PROP_ADDR1'] = $data['address_line_1'];
		$data_update['PROP_ADDR2'] = $data['address_line_2'];
		$data_update['PROP_ADDR3'] = $data['address_line_3'];
		$data_update['PROP_POSTCODE'] = $data['postal_code'];
		$data_update['PROP_CITY'] = $data['city'];
		$data_update['PROP_COUNTRY'] = $data['country'];
		
		$this->db->where('PROPERTY_ID',$data['edit_listings_pinmap']);		
		$this->db->update('kigo_properties',$data_update);
	}
	
	public function get_property_night_pricing($random_value) {
        $this->db->select('*');
        $this->db->from('kigo_properties_pricing_nightly_rent');
        $this->db->where('NIGHTLY_RANDOM_ID', $random_value);
        $this->db->order_by('NIGHTLY_STAY_NUMBER', 'asc');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }
    
    public function update_listing_property_step8($data){
		$data_update['PROP_LATITUDE'] = $data['latitude'];
		$data_update['PROP_LONGITUDE'] = $data['longitude'];
		
		$this->db->where('PROPERTY_ID',$data['edit_listings_pinmap']);		
		$this->db->update('kigo_properties',$data_update);
	}

	public function get_map_static_image($data){
		$this->db->select('completed_status');
		$this->db->from('property_listings_model');
		$this->db->where('listings_id',$data);
		$this->db->where('model_name','listings_pinmap');

		$query = $this->db->get();		

		$result = $query->row();

		$previous_completed_status = $result->completed_status;

		$this->db->select('completed_status');
		$this->db->from('property_listings_model');
		$this->db->where('listings_id',$data);
		$this->db->where('completed_status',1);

		$query = $this->db->get();
		$result = $query->result();
		$count_result = count($result);

		$this->db->where('listings_id',$data);
		$this->db->where('model_name','listings_pinmap');
		$this->db->update('property_listings_model',array('completed_status' => 1));		

		return array('previous_completed_status' => $previous_completed_status, 'count_result' => $count_result);
	}
	
	public function get_property_bed_types(){
		$this->db->select('*');
        $this->db->from('kigo_property_types');
        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
	}
	
	public function getStaticMap($lat, $long){
        $locstring=$lat.','.$long;

        //$firstloc=0;
                        
        /*if($firstloc==0){
            $locstring=$locstring.$lat.','.$long.'&markers=icon:http://travelapt.hs24.info/assets/images/marker_out.png%7C'.$lat.','.$long;
            $firstloc=1;
        }else{
            $locstring=$locstring.'&markers=icon:http://assets/images/marker_out.png%7C'.$lat.','.$long;
        }*/        
       //$url = "http://maps.googleapis.com/maps/api/staticmap?zoom=13&size=627x327&maptype=ROADMAP&".urlencode("center")."=".$locstring."&sensor=false";
      
	    $url = 'http://maps.google.com/maps/api/staticmap?center='.$lat.','.$long.'&markers=icon:images/marker_out.png|'.$lat.','.$long.'&zoom=16&size=627x457&sensor=false&maptype=ROADMAP';        
		//$url = 'http://maps.google.com/maps/api/staticmap?center=9.543999999999999,78.59100000000001&markers=icon:http://tinyurl.com/2ftvtt6|9.543999999999999,78.59100000000001&zoom=12&size=400x400&sensor=false';        
        return $url;
    }

    public function get_cancellation_types(){
    	$this->db->select('*');
    	$this->db->from('cancellation_types');

    	$query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }

    public function get_completed_status($prop_id){
    	$this->db->select('*');
    	$this->db->from('property_listings_model');
    	$this->db->where('listings_id',$prop_id);
    	$this->db->where('completed_status','0');

    	$query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }
}
