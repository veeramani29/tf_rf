<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kigo {

    protected $kigo_end_url;
    protected $kigo_username;
    protected $kigo_password;

    public function __construct() {
        $this->CI = &get_instance();
        $this->CI->load->library('session');
        $this->CI->load->database();
        
        $response = $this->get_api_result();
        
        $this->kigo_end_url  = $response->url1;
        $this->kigo_username = $response->username;
        $this->kigo_password = $response->password;
        
        define('KIGO_END_URL',$response->url1);
        define('KIGO_USERNAME',$response->username);
        define('KIGO_PASSWORD',$response->password);
    }
    
    public function get_api_result(){
        $this->CI->db->select('*');
        $this->CI->db->from('api');
        $this->CI->db->where('api_name','Kigo');
        
        $query =  $this->CI->db->get();        
        return $query->row();
    }

    public function get_owners_list() {
        $api_url = $this->kigo_end_url . 'listOwners';
        $jResult = $this->get_result($api_url, json_encode(null));
        return json_decode($jResult);
    }

    public function read_owner($owner_id) {
        $api_url = $this->kigo_end_url . 'readOwner';
        $jResult = $this->get_result($api_url, json_encode(array('OWNER_ID' => (int) $owner_id)));
        return json_decode($jResult);
    }

    public function add_owner($data) {
        $init = new stdClass;
        $init->OWNER_FIRSTNAME = (string) $data->OWNER_FIRSTNAME;
        $init->OWNER_LASTNAME = (string) $data->OWNER_LASTNAME;
        $init->OWNER_EMAIL = (string) $data->OWNER_EMAIL;
        $init->OWNER_PHONE_HOME = (string) $data->OWNER_PHONE_HOME;
        $init->OWNER_PHONE_WORK = (string) $data->OWNER_PHONE_WORK;
        $init->OWNER_PHONE_CELL = (string) $data->OWNER_PHONE_CELL;
        $init->OWNER_FAX = (string) $data->OWNER_FAX;
        $init->OWNER_STREETNO = (string) $data->OWNER_STREETNO;
        $init->OWNER_ADDR1 = (string) $data->OWNER_ADDR1;
        $init->OWNER_ADDR2 = (string) $data->OWNER_ADDR2;
        $init->OWNER_ADDR3 = (string) $data->OWNER_ADDR3;
        $init->OWNER_POSTCODE = (string) $data->OWNER_POSTCODE;
        $init->OWNER_CITY = (string) $data->OWNER_CITY;
        $init->OWNER_COUNTRY = (string) $data->OWNER_COUNTRY;
        $init->OWNER_CONTACT_INFO = (string) $data->OWNER_CONTACT_INFO;

        $owner_info = new stdClass;
        $owner_info->OWNER_INFO = $init;
        $api_url = $this->kigo_end_url . 'addOwner';
        $jResult = $this->get_result($api_url, json_encode($owner_info));

        $return_data['api_request'] = json_encode($owner_info);
        $return_data['api_response'] = $jResult;
        $return_data['api_url'] = $api_url;

        return $return_data;
    }

    public function update_owner($data, $owner_id) {
        $init = new stdClass;
        $init->OWNER_FIRSTNAME = (string) $data->OWNER_FIRSTNAME;
        $init->OWNER_LASTNAME = (string) $data->OWNER_LASTNAME;
        $init->OWNER_EMAIL = (string) $data->OWNER_EMAIL;
        $init->OWNER_PHONE_HOME = (string) $data->OWNER_PHONE_HOME;
        $init->OWNER_PHONE_WORK = (string) $data->OWNER_PHONE_WORK;
        $init->OWNER_PHONE_CELL = (string) $data->OWNER_PHONE_CELL;
        $init->OWNER_FAX = (string) $data->OWNER_FAX;
        $init->OWNER_STREETNO = (string) $data->OWNER_STREETNO;
        $init->OWNER_ADDR1 = (string) $data->OWNER_ADDR1;
        $init->OWNER_ADDR2 = (string) $data->OWNER_ADDR2;
        $init->OWNER_ADDR3 = (string) $data->OWNER_ADDR3;
        $init->OWNER_POSTCODE = (string) $data->OWNER_POSTCODE;
        $init->OWNER_CITY = (string) $data->OWNER_CITY;
        $init->OWNER_COUNTRY = (string) $data->OWNER_COUNTRY;
        $init->OWNER_CONTACT_INFO = (string) $data->OWNER_CONTACT_INFO;

        $owner_info = new stdClass;
        $owner_info->OWNER_ID = (int) $owner_id;
        $owner_info->OWNER_INFO = $init;

        $api_url = $this->kigo_end_url . 'updateOwner';
        $jResult = $this->get_result($api_url, json_encode($owner_info));
        $return_data['api_request'] = json_encode($owner_info);
        $return_data['api_response'] = $jResult;
        $return_data['api_url'] = $api_url;

        return $return_data;
    }

    public function get_properties() {
        $api_url = $this->kigo_end_url . 'listProperties2';
        $jResult = $this->get_result($api_url, json_encode(null));
        return json_decode($jResult);
    }

    public function readProperty2($property_id) {
        $api_url = $this->kigo_end_url . 'readProperty2';
        $jResult = $this->get_result($api_url, json_encode(array('PROP_ID' => (int) $property_id)));
        return array('api_response' => json_decode($jResult), 'api_url' => $api_url, 'api_request' => json_encode(array('PROP_ID' => (int) $property_id)));
    }

    public function readPropertyPhotoFile($property_id, $photo_id) {
        $api_url = $this->kigo_end_url . 'readPropertyPhotoFile';
        $jResult = $this->get_result($api_url, json_encode(array('PROP_ID' => (int) $property_id, 'PHOTO_ID' => $photo_id)));
        return array('api_response' => json_decode($jResult), 'api_url' => $api_url, 'api_request' => json_encode(array('PROP_ID' => (int) $property_id, 'PHOTO_ID' => $photo_id)));
    }

    public function readPropertyPricingSetup($prop_id) {
        $api_url = $this->kigo_end_url . 'readPropertyPricingSetup';
        $jResult = $this->get_result($api_url, json_encode(array('PROP_ID' => (int) $prop_id)));
        return array('api_response' => json_decode($jResult), 'api_url' => $api_url, 'api_request' => json_encode(array('PROP_ID' => (int) $prop_id)));
    }

    public function listUserDefinedPropertyAttributes() {
        $api_url = $this->kigo_end_url . 'listUserDefinedPropertyAttributes';
        $jResult = $this->get_result($api_url, json_encode(null));
        return array('api_response' => json_decode($jResult), 'api_request' => json_encode(null), 'api_url' => $api_url);
    }

    public function listKigoCountries() {
        $api_url = $this->kigo_end_url . 'listKigoCountries';
        $jResult = $this->get_result($api_url, json_encode(null));
        return array('api_response' => json_decode($jResult), 'api_request' => json_encode(null), 'api_url' => $api_url);
    }

    public function listKigoPropertyBedTypes() {
        $api_url = $this->kigo_end_url . 'listKigoPropertyBedTypes';
        $jResult = $this->get_result($api_url, json_encode(null));
        return array('api_response' => json_decode($jResult), 'api_request' => json_encode(null), 'api_url' => $api_url);
    }

    public function listKigoPropertyActivities() {
        $api_url = $this->kigo_end_url . 'listKigoPropertyActivities';
        $jResult = $this->get_result($api_url, json_encode(null));
        return array('api_response' => json_decode($jResult), 'api_request' => json_encode(null), 'api_url' => $api_url);
    }

    public function listKigoPropertyAmenities() {
        $api_url = $this->kigo_end_url . 'listKigoPropertyAmenities';
        $jResult = $this->get_result($api_url, json_encode(null));
        return array('api_response' => json_decode($jResult), 'api_request' => json_encode(null), 'api_url' => $api_url);
    }

    public function listKigoFeeTypes() {
        $api_url = $this->kigo_end_url . 'listKigoFeeTypes';
        $jResult = $this->get_result($api_url, json_encode(null));
        return array('api_response' => json_decode($jResult), 'api_request' => json_encode(null), 'api_url' => $api_url);
    }

    public function listKigoPropertyTypes() {
        $api_url = $this->kigo_end_url . 'listKigoPropertyTypes';
        $jResult = $this->get_result($api_url, json_encode(null));
        return array('api_response' => json_decode($jResult), 'api_request' => json_encode(null), 'api_url' => $api_url);
    }

    protected function get_result($api_url, $data) {
        $headers = array(
            "Content-Type: application/json",
            "Cache-Control: no-cache",
            "Content-length: " . strlen($data),
        );

        // PHP cURL  for https connection with auth
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_USERPWD, $this->kigo_username . ':' . $this->kigo_password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // the SOAP request
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
        $response = curl_exec($ch);

        $data_insert["Api"] = "Kigo";
        $data_insert["XML_Type"] = "Apartment";
        $data_insert["XML_Request"] = $data;
        $data_insert["XML_Response"] = $response;
        $data_insert["Ip_address"] = $this->get_client_ip();
        $aResult = json_decode($response);
        if (empty($aResult->API_REPLY) || !isset($aResult->API_REPLY)) {
            $this->CI->db->insert("XML_logs", $data_insert); 
        }
        return $response;
    }

    public function get_client_ip() {
            $ipaddress = '';
            if (getenv('HTTP_CLIENT_IP'))
                $ipaddress = getenv('HTTP_CLIENT_IP');
            else if(getenv('HTTP_X_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
            else if(getenv('HTTP_X_FORWARDED'))
                $ipaddress = getenv('HTTP_X_FORWARDED');
            else if(getenv('HTTP_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_FORWARDED_FOR');
            else if(getenv('HTTP_FORWARDED'))
               $ipaddress = getenv('HTTP_FORWARDED');
            else if(getenv('REMOTE_ADDR'))
                $ipaddress = getenv('REMOTE_ADDR');
            else
                $ipaddress = 'UNKNOWN';
            return $ipaddress;
    }

    public function update_property($data, $property_id) {
        $m_property_info = new stdClass;
        $m_property_info->PROP_ID = (int) $property_id;
        $s_property_info = new stdClass;
        $s_property_info->PROP_NAME = (string) $data['property_info']->PROP_NAME;
        $s_property_info->PROP_STREETNO = (string) $data['property_info']->PROP_STREETNO;
        $s_property_info->PROP_ADDR1 = (string) $data['property_info']->PROP_ADDR1;
        $s_property_info->PROP_ADDR2 = (string) $data['property_info']->PROP_ADDR2;
        $s_property_info->PROP_ADDR3 = (string) $data['property_info']->PROP_ADDR3;
        $s_property_info->PROP_APTNO = (string) $data['property_info']->PROP_APTNO;
        $s_property_info->PROP_POSTCODE = (string) $data['property_info']->PROP_POSTCODE;
        $s_property_info->PROP_CITY = (string) $data['property_info']->PROP_CITY;
        $s_property_info->PROP_REGION = (string) $data['property_info']->PROP_REGION;
        $s_property_info->PROP_COUNTRY = (string) $data['property_info']->PROP_COUNTRY;
        $temp_latlng = new stdClass();
        $temp_latlng->LATITUDE = (float) $data['property_info']->PROP_LATITUDE;
        $temp_latlng->LONGITUDE = (float) $data['property_info']->PROP_LONGITUDE;        

        $s_property_info->PROP_LATLNG  = null;
        $s_property_info->PROP_PHONE = (string) $data['property_info']->PROP_PHONE;
        $s_property_info->PROP_AXSCODE = (string) $data['property_info']->PROP_AXSCODE;
        $s_property_info->PROP_BEDROOMS = (int) $data['property_info']->PROP_BEDROOMS;
        $s_property_info->PROP_BEDS = (int) $data['property_info']->PROP_BEDS;
        
        $custom_property_bed_types = explode(',', $data['property_info']->PROP_BED_TYPES);
        $property_bed_types = array();
        
        if(!empty($custom_property_bed_types)){
            foreach($custom_property_bed_types as $key => $value){ 
                $property_bed_types[] = (int) $value;
            }
        }
        $s_property_info->PROP_BED_TYPES = (array) $property_bed_types;
        $s_property_info->PROP_BATHROOMS = (int) $data['property_info']->PROP_BATHROOMS;
        $s_property_info->PROP_TOILETS = (int) $data['property_info']->PROP_TOILETS;
        $s_property_info->PROP_TYPE_ID = (int) $data['property_info']->PROP_TYPE_ID;
        $s_property_info->PROP_SIZE = (int) $data['property_info']->PROP_SIZE;
        $s_property_info->PROP_SIZE_UNIT = (string) $data['property_info']->PROP_SIZE_UNIT;        
        $s_property_info->PROP_MAXGUESTS = (int) $data['property_info']->PROP_MAXGUESTS;
        $s_property_info->PROP_MAXGUESTS_ADULTS = (int) $data['property_info']->PROP_MAXGUESTS_ADULTS;
        $s_property_info->PROP_MAXGUESTS_CHILDREN = (int) $data['property_info']->PROP_MAXGUESTS_CHILDREN;
        $s_property_info->PROP_MAXGUESTS_BABIES = (int) $data['property_info']->PROP_MAXGUESTS_BABIES;
        $s_property_info->PROP_FLOOR = (string) $data['property_info']->PROP_FLOOR;
        $s_property_info->PROP_ELEVATOR = (bool) $data['property_info']->PROP_ELEVATOR;
        $s_property_info->PROP_CIN_TIME = (string) $data['property_info']->PROP_CIN_TIME;
        $s_property_info->PROP_COUT_TIME = (string) $data['property_info']->PROP_COUT_TIME;
        $s_property_info->PROP_CLEAN_TIME = (string) $data['property_info']->PROP_CLEAN_TIME;
        
        $temp = new stdClass();
        $temp->UNIT = (string) $data['property_info']->PROP_STAYTIME_MIN_UNIT;
        $temp->NUMBER = (int) $data['property_info']->PROP_STAYTIME_MIN_VALUE;
        $s_property_info->PROP_STAYTIME_MIN = (object) $temp;
        $temp = new stdClass();
        $temp->UNIT = (string) $data['property_info']->PROP_STAYTIME_MAX_UNIT;
        $temp->NUMBER = (int) $data['property_info']->PROP_STAYTIME_MAX_VALUE;
        $s_property_info->PROP_STAYTIME_MAX = (object) $temp;
        
        $s_property_info->PROP_SHORTDESCRIPTION = (string) $data['property_info']->PROP_SHORTDESCRIPTION;
        $s_property_info->PROP_DESCRIPTION = (string) $data['property_info']->PROP_DESCRIPTION;
        $s_property_info->PROP_AREADESCRIPTION = (string) $data['property_info']->PROP_AREADESCRIPTION;
        $s_property_info->PROP_RENTAL_DETAILS = (string) $data['property_info']->PROP_RENTAL_DETAILS;
        $s_property_info->PROP_INVENTORY = (string) $data['property_info']->PROP_INVENTORY;
        $s_property_info->PROP_ARRIVAL_SHEET = (string) $data['property_info']->PROP_ARRIVAL_SHEET;

        $custom_amenities = array();
        $amenities = explode(",", $data['property_info']->PROP_AMENITIES);

        if(!empty($amenities) && $amenities[0] != 0){
            foreach($amenities as $key => $value){
                $custom_amenities[] = (int) $value;
            }
        }else{
            $custom_amenities[] = "";
        }

        $s_property_info->PROP_AMENITIES = (array) $custom_amenities;                
        $custom_activities = array();
        $activities = explode(",", $data['property_info']->PROP_ACTIVITIES);
        
        if(!empty($activities) && $activities[0] != 0){
            foreach($activities as $key => $value){
                $custom_activities[] = (int) $value;
            }
        }else{
            $custom_activities[] = "";
        }
        
        $s_property_info->PROP_ACTIVITIES = (array) $custom_activities;           

        $m_property_info->PROP_INFO = $s_property_info;      

        $s_property_rate = new stdClass();
        $s_property_rate->PROP_RATE_CURRENCY = (string) $data['property_info']->PROP_RATE_CURRENCY;
        $s_property_rate->PROP_RATE_NIGHTLY_FROM = (string) $data['property_info']->PROP_RATE_NIGHTLY_FROM;
        $s_property_rate->PROP_RATE_NIGHTLY_TO = (string) $data['property_info']->PROP_RATE_NIGHTLY_TO;
        $s_property_rate->PROP_RATE_WEEKLY_FROM = (string) $data['property_info']->PROP_RATE_WEEKLY_FROM;
        $s_property_rate->PROP_RATE_WEEKLY_TO = (string) $data['property_info']->PROP_RATE_WEEKLY_TO;
        $s_property_rate->PROP_RATE_MONTHLY_FROM = (string) $data['property_info']->PROP_RATE_MONTHLY_FROM;
        $s_property_rate->PROP_RATE_MONTHLY_TO = (string) $data['property_info']->PROP_RATE_MONTHLY_TO;
        
        //$m_property_info->PROP_RATE = $s_property_rate;
        
        $s_property_udpa = array();

        if (!empty($data['property_udpa'])) {
            foreach ($data['property_udpa'] as $key => $value) {
                $temp = new stdClass();

                $temp->UDPA_ID = $value->UDPA_ID;
                $temp->UDPA_TEXT = $value->UDPA_TEXT;
                $s_property_udpa[] = $temp;
            }
        }

        //$m_property_info->PROP_UDPA = $s_property_udpa;               
        
        $s_property_photos = array();
        
        if(!empty($data['property_photos'])){
            foreach($data['property_photos'] as $key => $value){
                $temp = new stdClass();
                
                if(!empty($value->PHOTO_KIGO_ID)){
                    $temp->PHOTO_ID  = (string) $value->PHOTO_KIGO_ID;
                }else{
                    $temp->PHOTO_ID  = (string) uniqid();
                }
                
                $temp->PHOTO_PANORAMIC = (bool) $value->PHOTO_PANORAMIC;
                $temp->PHOTO_NAME  = (string) $value->PHOTO_NAME;
                $temp->PHOTO_COMMENTS  = (string) $value->PHOTO_COMMENTS;
                
                $s_property_photos[] = $temp;
            }
        }
        
        //$m_property_info->PROP_PHOTOS = $s_property_photos;         
        
        //echo json_encode($m_property_info);die;
        $api_url = $this->kigo_end_url . 'updateProperty';
        $jResult = $this->get_result($api_url, json_encode($m_property_info));
        echo $jResult;die;
        
        $return_data['api_request'] = json_encode($m_property_info);
        $return_data['api_response'] = $jResult;
        $return_data['api_url'] = $api_url;

        $property_photos = array();

        if (!empty($data['property_photos'])) {
            foreach ($data['property_photos'] as $key => $value) {
                if (empty($value->PHOTO_KIGO_ID)) {
                    $temp = new stdClass();
                    $temp->PROP_ID = (int) $property_id;
                    $temp->PHOTO_CONTENT = (string) $value->PHOTO_CONTENT;
                    $temp->PHOTO_PANORAMIC = (bool) $value->PHOTO_PANORAMIC;
                    $temp->PHOTO_NAME = (string) $value->PHOTO_NAME;
                    $temp->PHOTO_COMMENTS = (string) $value->PHOTO_COMMENTS;

                    $api_url = $this->kigo_end_url . 'uploadPropertyPhotoFile';

                    $jResult = $this->get_result($api_url, json_encode($temp));
                    $response = json_decode($jResult);

                    $this->CI->db->where('PHOTO_ID', $value->PHOTO_ID);
                    $this->CI->db->update('kigo_properties_photo', array('PHOTO_KIGO_ID' => $response->API_REPLY->PHOTO_ID));
                }
            }
        }


        $m_obj = new stdClass();

        foreach ($data['property_pricing_info'] as $key => $value) {
            $periods = array();
            $temp = new stdClass();
            $temp->CHECK_IN = (string) $value->CHECK_IN;
            $temp->CHECK_OUT = (string) $value->CHECK_OUT;
            $temp->NAME = (string) $value->NAME;

            $temp1 = new stdClass();
            $temp1->UNIT = (string) $value->STAY_MIN_UNIT;
            $temp1->NUMBER = (int) $value->STAY_MIN_VALUE;

            $temp->STAY_MIN = (object) $temp1;

            if (empty($value->WEEKLY_PRICING)) {
                $temp->WEEKLY = "";

                $this->CI->db->select('*');
                $this->CI->db->from('kigo_properties_pricing_nightly_rent');
                $this->CI->db->where('NIGHTLY_RANDOM_ID', $value->NIGHTLY_RANDOM);

                $query = $this->CI->db->get();
                $result = $query->result();

                if (!empty($result)) {
                    $nightly_amounts = array();
                    foreach ($result as $sskey => $ssvalue) {
                        $temp_n_a = new stdClass();
                        $temp_n_a->GUESTS_FROM = (int) $ssvalue->NIGHTLY_GUESTS_FROM;
                        $temp_n_a->WEEK_NIGHTS = (array) array_map('intval', explode(",", $ssvalue->WEEK_NIGHTS));

                        $temp_na_a1 = new stdClass();
                        $temp_na_a1->UNIT = (string) $ssvalue->NIGHTLY_STAY_UNIT;
                        $temp_na_a1->NUMBER = (int) $ssvalue->NIGHTLY_STAY_NUMBER;

                        $temp_n_a->STAY_FROM = $temp_na_a1;
                        $temp_n_a->AMOUNT = (string) $ssvalue->NIGHTLY_AMOUNT;

                        $nightly_amounts[] = $temp_n_a;
                    }
                    $temp->NIGHTLY_AMOUNTS = $nightly_amounts;
                }
            } else {
                $temp->WEEKLY = 1;
                $temp_ex_a = (array) array_map('intval', explode(",", $value->WEEKLY_AMOUNT));
                $temp_ex_g = (array) array_map('intval', explode(",", $value->WEEKY_GUEST_FROM));

                $weekly_amounts = array();
                for ($i = 0; $i < count($temp_ex_a); $i++) {
                    $temp_w_a = new stdClass();
                    $temp_w_a->GUESTS_FROM = (int) $temp_ex_g[$i];
                    $temp_w_a->AMOUNT = (double) $temp_ex_a[$i];
                    
                    $weekly_amounts[] =  $temp_w_a;
                }
                $temp->WEEKLY_AMOUNTS = (array) $weekly_amounts;
            }
            $periods[] = (object) $temp;
        }
        
        $o_rent = new stdClass();

        $o_per_geust_charge = new stdClass();
        $o_per_geust_charge->TYPE = (string) $data['property_pricing_info'][0]->PERGUEST_CHARGE_TYPE;
        $o_per_geust_charge->STANDARD = (int) $data['property_pricing_info'][0]->PERGUEST_CHARGE_STANDARD_OCCUPANCY;
        $o_per_geust_charge->MAX = (int) $data['property_pricing_info'][0]->PERGUEST_CHARGE_MAX_OCCUPANCY;

        $o_rent->PERGUEST_CHARGE = (object) $o_per_geust_charge;
        $o_rent->PERIODS = (array) $periods;

        $m_obj->RENT = (object) $o_rent;

        $o_fess = array();
        if (!empty($data['property_fees_types'])) {
            foreach ($data['property_fees_types'] as $key => $value) {
                $temp = new stdClass();
                $temp->FEE_TYPE_ID = (int) $value->FEE_TYPE_ID;
                $temp->INCLUDE_IN_RENT = (bool) $value->INCLUDE_IN_RENT;
                $temp->UNIT = (string) $value->UNIT;
                $temp->VALUE = json_decode($value->VALUE);
                $o_fess[] = $temp;
            }
        }
        
        $temp_obj = new stdClass();
        $temp_obj->FEES = $o_fess;
        //$m_obj->FEES = $temp_obj;

        if (!empty($data['property_info']->EARLY_BIRD_DISCOUNT_DAYS)) {
            $temp = new stdClass();
            $temp->DAYS = (int) $data['property_info']->EARLY_BIRD_DISCOUNT_DAYS;
            $temp->PERCENT = (string) $data['property_info']->EARLY_BIRD_DISCOUNT_PERCENT;
            $early_bird_d = new stdClass();
            $early_bird_d = $temp;
        } else {
            $early_bird_d = new stdClass();
            $early_bird_d = null;
        }


        if (!empty($data['property_lastminute_discounts'])) {
            $lmd_d = array();
            foreach ($data['property_lastminute_discounts'] as $key => $value) {
                $temp = new stdClass();
                $temp->DAYS = (int) $value->DISCOUNT_BEFORE_CHECKIN_DAYS;
                $temp->PERCENT = (string) $value->DISCOUNT_PERCENTAGE;
                $lmd_d[] = $temp;
            }
        } else {
            $lmd_d = new stdClass();
            $lmd_d = null;
        }

        if (!empty($data['property_special_discounts'])) {
            $special_d = array();
            foreach ($data['property_special_discounts'] as $key => $value) {
                $temp = new stdClass();
                $temp->NAME = (string) $value->DISCOUNT_NAME;
                $temp->PERCENT = (string) $value->DISCOUNT_PERCENTAGE;
                $temp->VALID_FROM = (string) $value->VALID_FROM;
                $temp->VALID_TO = (string) $value->VALID_TO;
                $temp->CHECK_OUT = (string) $value->CHECK_OUT;
                $temp->CHECK_IN = (string) $value->CHECK_IN;
                $special_d[] = $temp;
            }
        } else {
            $special_d = new stdClass();
            $special_d = null;
        }

        $discounts = new stdClass();
        $discounts->EARLY_BIRD = $early_bird_d;
        $discounts->LAST_MINUTE = $lmd_d;
        $discounts->SPECIAL = $special_d;

        //$m_obj->DISCOUNTS = $discounts;

        if (!empty($data['property_info']->DEPOSIT_VALUE)) {
            $deposit = new stdClass();
            $deposit->UNIT = (string) $data['property_info']->DEPOSIT_UNIT;
            $deposit->VALUE = (string) $data['property_info']->DEPOSIT_VALUE;
        } else {
            $deposit = new stdClass();
            $deposit = null;
        }

        //$m_obj->DEPOSIT = $deposit;
        $sm_obj = new stdClass();

        //$m_obj->CURRENCY = (string) $data['property_info']->PROP_RATE_CURRENCY;print_r($m_obj);die;
        $sm_obj->PROP_ID = (int) $property_id;
        $sm_obj->PRICING = (object) $m_obj;        
        
        $api_url = $this->kigo_end_url . 'updatePropertyPricingSetup';

        $jResult = $this->get_result($api_url, json_encode($sm_obj)); 
        $response = json_decode($jResult);        
        print_r($jResult);die;       

    }
    
    public function importnewreservation(){
        $api_url = $this->kigo_end_url . 'diffPropertyCalendarReservations';
        
        $jResult = $this->get_result($api_url, json_encode(array('DIFF_ID' => null)));        
        $response = json_decode($jResult);
        
        return $response;        
    }

}
