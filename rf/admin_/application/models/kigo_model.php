<?php
class Kigo_Model extends CI_Model {

    protected $temp;

    public function __construct() {
        parent::__construct();
        $this->load->library('Kigo');
    }

    public function get_owners_list() {
        $this->db->select('*');
        $this->db->from('kigo_owners');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }

    public function get_kigo_owners_list() {
        $aResult = $this->kigo->get_owners_list();
        return $aResult;
    }

    public function module_import_status($module_name) {
        $this->db->select('*');
        $this->db->from('kigo_modules');
        $this->db->where('MODULE_NAME', $module_name);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return "";
        }
    }

    function get_country_details($id){
        $this->db->select('*');
        $this->db->from('kigo_countries');
        $this->db->where('COUNTRY_ID', $id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return "";
        }      
    }

    function update_module_import_status($module, $status) {
        $this->db->where('MODULE_NAME', $module);
        $this->db->update('kigo_modules', array('FIRST_IMPORT_STATUS' => $status));
    }

    function insert_onwers($data) {
        $this->db->insert('kigo_owners', $data);
        return $this->db->insert_id();
    }

    function insert_notification($data) {
        $this->db->insert('kigo_apartment_notifications', $data);
    }

    function get_owner_notifications($action_status) {
        $this->db->select('*');
        $this->db->from('kigo_apartment_notifications');
        $this->db->join('kigo_owners', 'kigo_apartment_notifications.REFERENCE_ID = kigo_owners.ONWER_ID');
        $this->db->where('ACTION_STATUS', $action_status);
        $this->db->where('MODULE_NAME', 'owners');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }

    function get_property_notifications($action_status) {
        $this->db->select('kigo_apartment_notifications.*,kigo_properties.PROPERTY_ID,kigo_properties.KIGO_PROPERTY_ID,kigo_properties.PROP_NAME,kigo_properties.PROP_CITY,kigo_properties.PROP_COUNTRY,kigo_properties.PROP_PHONE,kigo_properties.PROP_ADDR1');
        $this->db->from('kigo_apartment_notifications');
        $this->db->join('kigo_properties', 'kigo_apartment_notifications.REFERENCE_ID = kigo_properties.PROPERTY_ID');
        $this->db->where('ACTION_STATUS', $action_status);
        $this->db->where_in('MODULE_NAME', array('property', 'property_photos', 'property_pricing'));

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }

    public function read_owner_kigo($owner_id) {
        $aResult = $this->kigo->read_owner($owner_id);
        return $aResult;
    }

    public function read_owner($owner_id) {
        $this->db->select('*');
        $this->db->from('kigo_owners');
        $this->db->where('ONWER_ID', $owner_id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return "";
        }
    }

    public function read_owner_by_kigo_id($owner_id) {
        $this->db->select('*');
        $this->db->from('kigo_owners');
        $this->db->where('ONWER_ID', $owner_id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
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

    public function add_owner_kigo($owner_id, $notification_id) {
        $data = $this->read_owner($owner_id);
        $aResponse = $this->kigo->add_owner($data);

        $owner_info = json_decode($aResponse['api_response']);

        if ($owner_info->API_RESULT_CODE != "E_OK") {
            $this->db->where('NOTIFICATION_ID', $notification_id);
            $this->db->update('kigo_apartment_notifications', array('KIGO_ACTION_STATUS' => 2, 'API_REQUEST' => $aResponse['api_request'], 'API_RESPONSE' => $aResponse['api_response'], 'API_URL' => $aResponse['api_url']));
        } else {
            $this->db->where('ONWER_ID', $owner_id);
            $this->db->update('kigo_owners', array('KIGO_ONWER_ID' => $owner_info->API_REPLY->OWNER_ID));

            $this->db->where('NOTIFICATION_ID', $notification_id);
            $this->db->update('kigo_apartment_notifications', array('KIGO_PUSH_STATUS' => 1, 'KIGO_ACTION_STATUS' => 1, 'API_REQUEST' => $aResponse['api_request'], 'API_RESPONSE' => $aResponse['api_response'], 'API_URL' => $aResponse['api_url']));
        }
    }
  public function add_owner_kigo_v1($owner_id) {
        $data = $this->read_owner($owner_id);
        $aResponse = $this->kigo->add_owner($data);

        $owner_info = json_decode($aResponse['api_response']);

        if ($owner_info->API_RESULT_CODE != "E_OK") {
          
            
            $this->db->insert('kigo_apartment_notifications', array('MODULE_NAME' => 'owners','REFERENCE_ID' => $owner_id,'ACTION_STATUS' => 1,'KIGO_PUSH_STATUS' => 1, 'KIGO_ACTION_STATUS' => 2, 'API_REQUEST' => $aResponse['api_request'], 'API_RESPONSE' => $aResponse['api_response'], 'API_URL' => $aResponse['api_url']));
            
        } else {
            $this->db->where('ONWER_ID', $owner_id);
            $this->db->update('kigo_owners', array('KIGO_ONWER_ID' => $owner_info->API_REPLY->OWNER_ID));

           
            $this->db->insert('kigo_apartment_notifications', array('MODULE_NAME' => 'owners','REFERENCE_ID' => $owner_id,'ACTION_STATUS' => 1,'KIGO_PUSH_STATUS' => 1, 'KIGO_ACTION_STATUS' => 1, 'API_REQUEST' => $aResponse['api_request'], 'API_RESPONSE' => $aResponse['api_response'], 'API_URL' => $aResponse['api_url']));
        }
    }
    public function insert_owner_kigo($data) {
        $this->db->insert('kigo_owners', $data);
        return $this->db->insert_id();
    }

    public function update_owner($data, $owner_id) {
        $this->db->where('ONWER_ID', $owner_id);
        $this->db->update('kigo_owners', $data);
        return $aResult;
    }

    public function update_owner_kigo($owner_id, $notification_id) {
        $aResult = $this->read_owner($owner_id);
        $aResponse = $this->kigo->update_owner($aResult, $aResult->KIGO_ONWER_ID);

        $owner_info = json_decode($aResponse['api_response']);

        if ($owner_info->API_RESULT_CODE != "E_OK") {
            $this->db->where('NOTIFICATION_ID', $notification_id);
            $this->db->update('kigo_apartment_notifications', array('KIGO_ACTION_STATUS' => 2, 'API_REQUEST' => $aResponse['api_request'], 'API_RESPONSE' => $aResponse['api_response'], 'API_URL' => $aResponse['api_url']));
        } else {
            $this->db->where('NOTIFICATION_ID', $notification_id);
            $this->db->update('kigo_apartment_notifications', array('KIGO_PUSH_STATUS' => 1, 'KIGO_ACTION_STATUS' => 1, 'API_REQUEST' => $aResponse['api_request'], 'API_RESPONSE' => $aResponse['api_response'], 'API_URL' => $aResponse['api_url']));
        }
    }

    public function get_properties_kigo() {
        $aResult = $this->kigo->get_properties();
        return $aResult;
    }

    public function readProperty2($property_id) {
        $aResult = $this->kigo->readProperty2($property_id);
        return $aResult;
    }

    public function readPropertyPhotoFile($property_id, $photo_id) {
        $aResult = $this->kigo->readPropertyPhotoFile($property_id, $photo_id);
        return $aResult;
    }

    public function readPropertyPricingSetup($prop_id) {
        $aResult = $this->kigo->readPropertyPricingSetup($prop_id);
        return $aResult;
    }

    public function listUserDefinedPropertyAttributes() {
        $aResponse = $this->kigo->listUserDefinedPropertyAttributes();
        $aResult = $aResponse['api_response'];

        $this->db->empty_table('kigo_properties_udpa');

        if (!empty($aResult->API_REPLY)) {
            foreach ($aResult->API_REPLY as $key => $value) {
                $data['UDPA_TYPE'] = $value->UDPA_TYPE;
                $data['UDPA_NAME'] = $value->UDPA_NAME;
                $data['UDPA_ID'] = $value->UDPA_ID;

                $this->db->insert('kigo_properties_udpa', $data);
            }
            $data_notification['MODULE_NAME'] = 'property_udpa';
            $data_notification['REFERENCE_ID'] = '';
            $data_notification['ACTION_STATUS'] = 2;
            $data_notification['KIGO_PUSH_STATUS'] = 2;
            $data_notification['KIGO_ACTION_STATUS'] = 1;
            $data_notification['API_REQUEST'] = $aResponse['api_request'];
            $data_notification['API_RESPONSE'] = json_encode($aResponse['api_response']);
            $data_notification['API_URL'] = $aResponse['api_url'];

            $this->Kigo_Model->insert_notification($data_notification);
        }
    }

    public function listKigoCountries() {
        $aResponse = $this->kigo->listKigoCountries();
        $aResult = $aResponse['api_response'];

        $this->db->empty_table('kigo_countries');

        if (!empty($aResult->API_REPLY)) {
            foreach ($aResult->API_REPLY as $key => $value) {
                $data['COUNTRY_CODE'] = $value->COUNTRY_ISO_3166_1_ALPHA_2;
                $data['COUNTRY_NAME'] = $value->COUNTRY_NAME;

                $this->db->insert('kigo_countries', $data);
            }

            $data_notification['MODULE_NAME'] = 'kigo_countries';
            $data_notification['REFERENCE_ID'] = '';
            $data_notification['ACTION_STATUS'] = 2;
            $data_notification['KIGO_PUSH_STATUS'] = 2;
            $data_notification['KIGO_ACTION_STATUS'] = 1;
            $data_notification['API_REQUEST'] = $aResponse['api_request'];
            $data_notification['API_RESPONSE'] = json_encode($aResponse['api_response']);
            $data_notification['API_URL'] = $aResponse['api_url'];

            $this->Kigo_Model->insert_notification($data_notification);
        }
    }

    public function listKigoPropertyBedTypes() {
        $aResponse = $this->kigo->listKigoPropertyBedTypes();
        $aResult = $aResponse['api_response'];

        $this->db->empty_table('kigo_properties_pdtp');

        if (!empty($aResult->API_REPLY)) {
            foreach ($aResult->API_REPLY as $key => $value) {
                $data['BED_TYPE_ID'] = $value->BED_TYPE_ID;
                $data['BED_TYPE_LABEL'] = $value->BED_TYPE_LABEL;

                $this->db->insert('kigo_properties_pdtp', $data);
            }

            $data_notification['MODULE_NAME'] = 'properties_pdtp';
            $data_notification['REFERENCE_ID'] = '';
            $data_notification['ACTION_STATUS'] = 2;
            $data_notification['KIGO_PUSH_STATUS'] = 2;
            $data_notification['KIGO_ACTION_STATUS'] = 1;
            $data_notification['API_REQUEST'] = $aResponse['api_request'];
            $data_notification['API_RESPONSE'] = json_encode($aResponse['api_response']);
            $data_notification['API_URL'] = $aResponse['api_url'];

            $this->Kigo_Model->insert_notification($data_notification);
        }
    }

    public function listKigoPropertyAmenities() {
        $aResponse = $this->kigo->listKigoPropertyAmenities();
        $aResult = $aResponse['api_response'];

        $this->db->empty_table('kigo_amenities');
        $this->db->empty_table('kigo_amenities_category');

        if (!empty($aResult->API_REPLY)) {

            foreach ($aResult->API_REPLY->AMENITY_CATEGORY as $key => $value) {
                $data['AMENITY_CATEGORY_ID'] = $value->AMENITY_CATEGORY_ID;
                $data['AMENITY_CATEGORY_LABEL'] = $value->AMENITY_CATEGORY_LABEL;

                $this->db->insert('kigo_amenities_category', $data);
            }

            foreach ($aResult->API_REPLY->AMENITY as $key => $value) {
                $sdata['KIGO_AMENITY_ID'] = $value->AMENITY_ID;
                $sdata['AMENITY_CATEGORY_ID'] = $value->AMENITY_CATEGORY_ID;
                $sdata['AMENITY_LABEL'] = $value->AMENITY_LABEL;

                $this->db->insert('kigo_amenities', $sdata);
            }

            $data_notification['MODULE_NAME'] = 'properties_amenities';
            $data_notification['REFERENCE_ID'] = '';
            $data_notification['ACTION_STATUS'] = 2;
            $data_notification['KIGO_PUSH_STATUS'] = 2;
            $data_notification['KIGO_ACTION_STATUS'] = 1;
            $data_notification['API_REQUEST'] = $aResponse['api_request'];
            $data_notification['API_RESPONSE'] = json_encode($aResponse['api_response']);
            $data_notification['API_URL'] = $aResponse['api_url'];

            $this->Kigo_Model->insert_notification($data_notification);
        }
    }

    public function listKigoPropertyActivities() {
        $aResponse = $this->kigo->listKigoPropertyActivities();
        $aResult = $aResponse['api_response'];

        $this->db->empty_table('kigo_activities');
        $this->db->empty_table('kigo_activity_category');

        if (!empty($aResult->API_REPLY)) {

            foreach ($aResult->API_REPLY->ACTIVITY_CATEGORY as $key => $value) {
                $data['ACTIVITY_CATEGORY_ID'] = $value->ACTIVITY_CATEGORY_ID;
                $data['ACTIVITY_CATEGORY_LABEL'] = $value->ACTIVITY_CATEGORY_LABEL;

                $this->db->insert('kigo_activity_category', $data);
            }

            foreach ($aResult->API_REPLY->ACTIVITY as $key => $value) {
                $sdata['ACTIVITY_KIGO_ID'] = $value->ACTIVITY_ID;
                $sdata['ACTIVITY_CATEGORY_ID'] = $value->ACTIVITY_CATEGORY_ID;
                $sdata['ACTIVITY_LABEL'] = $value->ACTIVITY_LABEL;

                $this->db->insert('kigo_activities', $sdata);
            }

            $data_notification['MODULE_NAME'] = 'properties_activities';
            $data_notification['REFERENCE_ID'] = '';
            $data_notification['ACTION_STATUS'] = 2;
            $data_notification['KIGO_PUSH_STATUS'] = 2;
            $data_notification['KIGO_ACTION_STATUS'] = 1;
            $data_notification['API_REQUEST'] = $aResponse['api_request'];
            $data_notification['API_RESPONSE'] = json_encode($aResponse['api_response']);
            $data_notification['API_URL'] = $aResponse['api_url'];

            $this->Kigo_Model->insert_notification($data_notification);
        }
    }

    public function listKigoFeeTypes() {
        $aResponse = $this->kigo->listKigoFeeTypes();
        $aResult = $aResponse['api_response'];

        $this->db->empty_table('kigo_fees_types');

        if (!empty($aResult->API_REPLY)) {
            foreach ($aResult->API_REPLY as $key => $value) {
                $data['FEE_TYPE_ID'] = $value->FEE_TYPE_ID;
                $data['FEE_TYPE_LABEL'] = $value->FEE_TYPE_LABEL;
                $data['FEE_TYPE_INCLUDE_IN_RENT'] = $value->FEE_TYPE_INCLUDE_IN_RENT;
                if (!empty($value->FEE_TYPE_UNITS)) {
                    $data['FEE_TYPE_UNITS'] = implode(",", $value->FEE_TYPE_UNITS);
                } else {
                    $data['FEE_TYPE_UNITS'] = "";
                }

                $this->db->insert('kigo_fees_types', $data);
            }

            $data_notification['MODULE_NAME'] = 'fees_types';
            $data_notification['REFERENCE_ID'] = '';
            $data_notification['ACTION_STATUS'] = 2;
            $data_notification['KIGO_PUSH_STATUS'] = 2;
            $data_notification['KIGO_ACTION_STATUS'] = 1;
            $data_notification['API_REQUEST'] = $aResponse['api_request'];
            $data_notification['API_RESPONSE'] = json_encode($aResponse['api_response']);
            $data_notification['API_URL'] = $aResponse['api_url'];

            $this->Kigo_Model->insert_notification($data_notification);
        }
    }

    public function listKigoPropertyTypes() {
        $aResponse = $this->kigo->listKigoPropertyTypes();
        $aResult = $aResponse['api_response'];
        $this->db->empty_table('kigo_property_types');

        if (!empty($aResult->API_REPLY)) {
            foreach ($aResult->API_REPLY as $key => $value) {
                $data['PROP_TYPE_ID'] = $value->PROP_TYPE_ID;
                $data['PROP_TYPE_LABEL'] = $value->PROP_TYPE_LABEL;

                $this->db->insert('kigo_property_types', $data);
            }

            $data_notification['MODULE_NAME'] = 'property_types';
            $data_notification['REFERENCE_ID'] = '';
            $data_notification['ACTION_STATUS'] = 2;
            $data_notification['KIGO_PUSH_STATUS'] = 2;
            $data_notification['KIGO_ACTION_STATUS'] = 1;
            $data_notification['API_REQUEST'] = $aResponse['api_request'];
            $data_notification['API_RESPONSE'] = json_encode($aResponse['api_response']);
            $data_notification['API_URL'] = $aResponse['api_url'];

            $this->Kigo_Model->insert_notification($data_notification);
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

    public function get_kigo_countries() {
        $this->db->select('*');
        $this->db->from('kigo_countries');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }

     public function get_system_countries() {
        $this->db->select('*');
        $this->db->from('country');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }    

    public function get_kigo_currency() {
        $this->db->select('*');
        $this->db->from('kigo_currency');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }

    public function get_property_pdtp() {
        $this->db->select('*');
        $this->db->from('kigo_properties_pdtp');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }

    public function get_amenity_category() {
        $this->db->select('*');
        $this->db->from('kigo_amenities_category');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
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

    public function get_activity_category() {
        $this->db->select('*');
        $this->db->from('kigo_activity_category');

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

    public function get_property_types() {
        $this->db->select('*');
        $this->db->from('kigo_property_types');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }

    public function insert_property_info($data) {
        $this->db->insert('kigo_properties', $data);
        return $this->db->insert_id();
    }

    public function insert_property_udpa($data) {
        $this->db->insert('kigo_properties_userdefined_fields', $data);
    }

    public function insert_property_photo($data) {
        $this->db->insert('kigo_properties_photo', $data);
    }

    public function empty_property() {
        $this->db->empty_table('kigo_properties');
    }

    public function get_properties() {
        $this->db->select('*');
        $this->db->from('kigo_properties');
        $this->db->join('kigo_owners', 'kigo_properties.PROVIDER_ID = kigo_owners.KIGO_ONWER_ID', 'left');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return '';
    }

    public function get_property_photos($property_id) {
        $this->db->select('*');
        $this->db->from('kigo_properties_photo');
        $this->db->where('PROP_ID', $property_id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return '';
    }

    public function update_property_photo($photo_id, $photo_content) {
        $this->db->where('PHOTO_ID', $photo_id);
        $this->db->update('kigo_properties_photo', array('PHOTO_CONTENT' => $photo_content));
    }

    public function update_propertyphoto_status($property_id, $status) {
        $this->db->where('PROPERTY_ID', $property_id);
        $this->db->update('kigo_properties', array('PROPERTY_PHOTO_IMPORT_STATUS' => $status));
    }

    public function update_propertyprice_status($property_id, $status) {
        $this->db->where('PROPERTY_ID', $property_id);
        $this->db->update('kigo_properties', array('PROPERTY_PRICING_IMPORT_STATUS' => $status));
    }

    public function get_property_images($property_id) {

        $this->db->select('*');
        $this->db->from('kigo_properties_photo');
        $this->db->where('PROP_ID', $property_id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return '';
    }

    public function get_photo_by_photoid($photoid) {

        $this->db->select('PHOTO_CONTENT');
        $this->db->from('kigo_properties_photo');
        $this->db->where('PHOTO_ID', $photoid);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return '';
    }

    public function add_property_pricing($fees, $property_id) {
        if (!empty($fees->FEES)) {
            $array = array();
            foreach ($fees->FEES as $key => $value) {
                $array = array('FEE_TYPE_ID' => $value->FEE_TYPE_ID, 'PROP_ID' => $property_id, 'INCLUDE_IN_RENT' => $value->INCLUDE_IN_RENT, 'UNIT' => $value->UNIT, 'VALUE' => json_encode($value->VALUE));
                $this->db->insert('kigo_properties_pricing_fees', $array);
            }
        }
    }

    public function add_property_discount($discount, $property_id) {
        if (!empty($discount->EARLY_BIRD)) {
            $array = array();
            $array = array('EARLY_BIRD_DISCOUNT_DAYS' => $discount->EARLY_BIRD->DAYS, 'EARLY_BIRD_DISCOUNT_PERCENT' => $discount->EARLY_BIRD->PERCENT);
            $this->db->where('PROPERTY_ID', $property_id);
            $this->db->update('kigo_properties', $array);
        }

        if (!empty($discount->LAST_MINUTE)) {
            $array = array();
            foreach ($discount->LAST_MINUTE as $key => $value) {
                $array = array('DISCOUNT_BEFORE_CHECKIN_DAYS' => $value->DAYS, 'PROP_ID' => $property_id, 'DISCOUNT_PERCENTAGE' => $value->PERCENT);
                $this->db->insert('kigo_properties_lastminute_discounts', $array);
            }
        }


        if (!empty($discount->SPECIAL)) {
            $array = array();
            foreach ($discount->SPECIAL as $key => $value) {
                $array = array('DISCOUNT_NAME' => $value->NAME, 'PROP_ID' => $property_id, 'DISCOUNT_PERCENTAGE' => $value->PERCENT, 'VALID_FROM' => $value->VALID_FROM, 'VALID_TO' => $value->VALID_TO, 'CHECK_IN' => $value->CHECK_IN, 'CHECK_OUT' => $value->CHECK_OUT);
                $this->db->insert('kigo_properties_special_discounts', $array);
            }
        }
    }

    public function update_property_deposit($deposit, $property_id) {
        if (!empty($deposit)) {
            $this->db->where('PROPERTY_ID', $property_id);
            $this->db->update('kigo_properties', array('DEPOSIT_UNIT' => $deposit->UNIT, 'DEPOSIT_VALUE' => $deposit->VALUE));
        }
    }

    public function add_property_pricing_rent($rent, $currency, $property_id) {
        if (!empty($rent->PERIODS)) {
            foreach ($rent->PERIODS as $key => $value) {
                if ($value->WEEKLY == 1) {
                    $data['CHECK_IN'] = $value->CHECK_IN;
                    $data['CHECK_OUT'] = $value->CHECK_OUT;
                    $data['NAME'] = $value->NAME;
                    $data['STAY_MIN_UNIT'] = $value->STAY_MIN->UNIT;
                    $data['STAY_MIN_VALUE'] = $value->STAY_MIN->NUMBER;
                    $data['WEEKLY_PRICING'] = 1;

                    $guest_from = array();
                    $amount = array();

                    if (!empty($value->WEEKLY_AMOUNTS)) {
                        foreach ($value->WEEKLY_AMOUNTS as $skey => $svalue) {
                            $guest_from[] = $svalue->GUESTS_FROM;
                            $amount[] = $svalue->AMOUNT;
                        }
                        $data['WEEKY_GUEST_FROM'] = implode(',', $guest_from);
                        $data['WEEKLY_AMOUNT'] = implode(',', $amount);
                    }
                    $data['CURRENCY'] = $currency;
                    if (!empty($rent->PERGUEST_CHARGE)) {
                        $data['PERGUEST_CHARGE_TYPE'] = $rent->PERGUEST_CHARGE->TYPE;
                        $data['PERGUEST_CHARGE_STANDARD_OCCUPANCY'] = $rent->PERGUEST_CHARGE->STANDARD;
                        $data['PERGUEST_CHARGE_MAX_OCCUPANCY'] = $rent->PERGUEST_CHARGE->MAX;
                    } else {
                        $data['PERGUEST_CHARGE_TYPE'] = "";
                        $data['PERGUEST_CHARGE_STANDARD_OCCUPANCY'] = "";
                        $data['PERGUEST_CHARGE_MAX_OCCUPANCY'] = "";
                    }
                    $data['PROP_ID'] = $property_id;

                    $this->db->insert('kigo_properties_pricing_rent', $data);
                } else {
                    $data['CHECK_IN'] = $value->CHECK_IN;
                    $data['CHECK_OUT'] = $value->CHECK_OUT;
                    $data['NAME'] = $value->NAME;
                    $data['STAY_MIN_UNIT'] = $value->STAY_MIN->UNIT;
                    $data['STAY_MIN_VALUE'] = $value->STAY_MIN->NUMBER;
                    $data['WEEKLY_PRICING'] = 0;
                    $data['WEEKY_GUEST_FROM'] = "";
                    $data['WEEKLY_AMOUNT'] = "";
                    $data['CURRENCY'] = $currency;
                    if (!empty($rent->PERGUEST_CHARGE)) {
                        $data['PERGUEST_CHARGE_TYPE'] = $rent->PERGUEST_CHARGE->TYPE;
                        $data['PERGUEST_CHARGE_STANDARD_OCCUPANCY'] = $rent->PERGUEST_CHARGE->STANDARD;
                        $data['PERGUEST_CHARGE_MAX_OCCUPANCY'] = $rent->PERGUEST_CHARGE->MAX;
                    } else {
                        $data['PERGUEST_CHARGE_TYPE'] = "";
                        $data['PERGUEST_CHARGE_STANDARD_OCCUPANCY'] = "";
                        $data['PERGUEST_CHARGE_MAX_OCCUPANCY'] = "";
                    }
                    $data['PROP_ID'] = $property_id;
                    $data['NIGHTLY_RANDOM'] = uniqid('NW');
                    $this->db->insert('kigo_properties_pricing_rent', $data);

                    if (!empty($value->NIGHTLY_AMOUNTS)) {
                        foreach ($value->NIGHTLY_AMOUNTS as $skey => $svalue) {
                            $data_nightly['NIGHTLY_GUESTS_FROM'] = $svalue->GUESTS_FROM;
                            $data_nightly['NIGHTLY_STAY_UNIT'] = $svalue->STAY_FROM->UNIT;
                            $data_nightly['NIGHTLY_STAY_NUMBER'] = $svalue->STAY_FROM->NUMBER;
                            $data_nightly['NIGHTLY_AMOUNT'] = $svalue->AMOUNT;
                            $data_nightly['PROP_ID'] = $property_id;
                            $data_nightly['NIGHTLY_RANDOM_ID'] = $data['NIGHTLY_RANDOM'];
                            $weekly_nights = array();
                            foreach ($svalue->WEEK_NIGHTS as $sskey => $ssvalue) {
                                $weekly_nights[] = $ssvalue;
                            }
                            $data_nightly['WEEK_NIGHTS'] = implode(',', $weekly_nights);
                            $this->db->insert('kigo_properties_pricing_nightly_rent', $data_nightly);
                        }
                    }
                }
            }
        }
    }

    public function get_property_fields_notifications($action_status) {
        $this->db->select('*');
        $this->db->from('kigo_apartment_notifications');
        $this->db->where('ACTION_STATUS', $action_status);
        $this->db->where_in('MODULE_NAME', array('property_udpa', 'kigo_countries', 'properties_pdtp', 'properties_amenities', 'properties_activities', 'fees_types', 'property_types'));

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }

    public function get_property_by_id($property_id) {
        $this->db->select('*');
        $this->db->from('kigo_properties');
        $this->db->where('PROPERTY_ID', $property_id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return "";
        }
    }

    public function get_property_local_id($prop_id) {
        $this->db->select('PROPERTY_ID');
        $this->db->from('kigo_properties');
        $this->db->where('KIGO_PROPERTY_ID', $prop_id);

        $query = $this->db->get();
        return $query->row()->PROPERTY_ID;
    }

    public function get_property_pricing_by_id($property_id) {
        $this->db->select('*');
        $this->db->from('kigo_properties_pricing_rent');
        $this->db->where('PROP_ID', $property_id);
        $this->db->order_by('CHECK_IN','ASC');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }

    public function get_property_udpa_by_id($property_id) {
        $this->db->select('*');
        $this->db->from('kigo_properties_userdefined_fields');
        $this->db->join('kigo_properties_udpa', 'kigo_properties_userdefined_fields.UDPA_ID = kigo_properties_udpa.UDPA_ID');
        $this->db->where('PROP_ID', $property_id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }

    public function get_property_special_discounts($property_id) {
        $this->db->select('*');
        $this->db->from('kigo_properties_special_discounts');
        $this->db->where('PROP_ID', $property_id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
    }

    public function get_property_lastminute_discounts($property_id) {
        $this->db->select('*');
        $this->db->from('kigo_properties_lastminute_discounts');
        $this->db->where('PROP_ID', $property_id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "";
        }
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

    public function update_property_step1($property_id, $data) {
        $data_update['PROP_NAME'] = $data['property_name'];
        $data_update['PROP_TYPE_ID'] = $data['property_type'];
        $data_update['PROP_SIZE'] = $data['property_size'];
        $data_update['PROP_SIZE_UNIT'] = $data['property_size_unit'];
        $data_update['PROP_BEDROOMS'] = $data['property_bedrooms'];
        $data_update['PROP_BEDS'] = $data['property_beds'];
        $data_update['PROP_COUT_TIME'] = $data['check_out'];
        $data_update['PROP_CIN_TIME'] = $data['check_in'];
        $data_update['PROP_FLOOR'] = $data['floor'];
        $data_update['PROP_ELEVATOR'] = $data['elevator'];
        $data_update['PROP_BATHROOMS'] = $data['bathrooms'];
        $data_update['PROP_TOILETS'] = $data['toilet'];
        $data_update['PROP_CLEAN_TIME'] = $data['cleaning_time'];
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
        $data_update['PROP_STAYTIME_MIN_VALUE'] = $data['min_stay_value'];
        $data_update['PROP_STAYTIME_MIN_UNIT'] = $data['min_stay_unit'];
        $data_update['PROP_STAYTIME_MAX_VALUE'] = $data['max_stay_value'];
        $data_update['PROP_STAYTIME_MAX_UNIT'] = $data['max_stay_unit'];

        $data_update['PROP_STREETNO'] = $data['street_no'];
        $data_update['PROP_POSTCODE'] = $data['postal_code'];
        $data_update['PROP_APTNO'] = $data['apt_no'];
        $data_update['PROP_ADDR1'] = $data['address1'];
        $data_update['PROP_ADDR2'] = $data['address2'];
        $data_update['PROP_ADDR3'] = $data['address3'];
        $data_update['PROP_CITY'] = $data['city'];
        $data_update['PROP_PHONE'] = $data['prop_phone_no'];

        $data_update['PROP_REGION'] = $data['region'];
        $data_update['PROP_AXSCODE'] = $data['access_code'];
        $data_update['PROP_COUNTRY'] = $data['country'];
        $data_update['PROP_LATITUDE'] = $data['latitude'];
        $data_update['PROP_LONGITUDE'] = $data['longitude'];

        $data_update['PROP_RENTAL_DETAILS'] = $data['rental_details'];
        $data_update['PROP_INVENTORY'] = $data['inventory'];
        $data_update['PROP_ARRIVAL_SHEET'] = $data['arrival_sheet'];
        $data_update['PROP_SHORTDESCRIPTION'] = $data['short_desc'];
        $data_update['PROP_DESCRIPTION'] = $data['full_desc'];
        $data_update['PROP_AREADESCRIPTION'] = $data['area_desc'];
        $data_update['PROVIDER_ID'] = $data['owner_id'];

        if (!empty($data['amenities'])) {
            $data_update['PROP_AMENITIES'] = implode(',', $data['amenities']);
        } else {
            $data_update['PROP_AMENITIES'] = '';
        }

        if (!empty($data['activities'])) {
            $data_update['PROP_ACTIVITIES'] = implode(',', $data['activities']);
        } else {
            $data_update['PROP_ACTIVITIES'] = '';
        }

        $data_update['PROP_BED_TYPES'] = implode(',', $data['prop_beds_types']);
        $data_update['EARLY_BIRD_DISCOUNT_DAYS'] = $data['early_bird_days'];
        $data_update['EARLY_BIRD_DISCOUNT_PERCENT'] = $data['early_bird_discount'];
        $data_update['PROP_RATE_NIGHTLY_FROM_CURR'] = $this->currency_convertor($data['nightly_rate_from'],$data['currency'],SITE_CURRENCY);
        $this->db->where('PROPERTY_ID', $property_id);
        $this->db->update('kigo_properties', $data_update);
    }

    public function update_property_step2($property_id, $data) {

        $this->db->where('PROP_ID', $property_id);
        $this->db->delete('kigo_properties_lastminute_discounts');
        $data_upadte = "";
        if (!empty($data['lastminute_discounts_days'])) {
            for ($i = 0; $i< count($data['lastminute_discounts_days']); $i++) {
                $data_upadte['PROP_ID'] = $property_id;
                $data_upadte['DISCOUNT_BEFORE_CHECKIN_DAYS'] = $data['lastminute_discounts_days'][$i];
                $data_upadte['DISCOUNT_PERCENTAGE'] = $data['lastminute_discounts'][$i];

                $this->
    db->insert('kigo_properties_lastminute_discounts', $data_upadte);
            }
        }

        $this->db->where('PROP_ID', $property_id);
        $this->db->delete('kigo_properties_special_discounts');
        $data_upadte = "";
        if (!empty($data['psd_checkin'])) {
            for ($i = 0; $i< count($data['psd_checkin']); $i++) {
                $data_upadte['PROP_ID'] = $property_id;
                $data_upadte['CHECK_IN'] = $data['psd_checkin'][$i];
                $data_upadte['CHECK_OUT'] = $data['psd_checkout'][$i];
                $data_upadte['VALID_TO'] = $data['psd_validto'][$i];
                $data_upadte['VALID_FROM'] = $data['psd_validfrom'][$i];
                $data_upadte['DISCOUNT_NAME'] = $data['psd_discount_name'][$i];
                $data_upadte['DISCOUNT_PERCENTAGE'] = $data['psd_discount_per'][$i];

                $this->
        db->insert('kigo_properties_special_discounts', $data_upadte);
            }
        }
    }

    function update_property_step3($property_id, $data) {

        $this->db->where('PROP_ID', $property_id);
        $this->db->delete('kigo_properties_userdefined_fields');

        $data_upadte = "";

        if (!empty($data['udpa_id'])) {
            for ($i = 0; $i
        < count($data['udpa_id']); $i++) {
                $data_upadte['UDPA_ID'] = $data['udpa_id'][$i];
                $data_upadte['UDPA_TEXT'] = $data['udpa_value'][$i];
                $data_upadte['PROP_ID'] = $property_id;

                $this->
            db->insert('kigo_properties_userdefined_fields', $data_upadte);
            }
        }
    }

    function update_property_step4($property_id, $data) {
        $data_upadte = "";

        $this->db->where('PROP_ID', $property_id);
        $this->db->where('PHOTO_KIGO_ID', "");
        $this->db->delete('kigo_properties_photo');

        if (isset($data['image']) && !empty($data['image'])) {
            foreach ($data['image'] as $key => $value) {
                $data_upadte['PHOTO_CONTENT'] = $value[0];
                $data_upadte['PROP_ID'] = $property_id;
                $data_upadte['PHOTO_COMMENTS'] = $data['comment'][$key][0];
                $data_upadte['PHOTO_NAME'] = $data['name'][$key][0];

                if (isset($data['panaromic_view'][$key])) {
                    $data_upadte['PHOTO_PANORAMIC'] = 1;
                } else {
                    $data_upadte['PHOTO_PANORAMIC'] = 0;
                }

                $this->db->insert('kigo_properties_photo', $data_upadte);
            }
        }
    }

    function update_property_step5($property_id, $data) {
        $fees_types_value = array();

        $this->db->where('PROP_ID', $property_id);
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
                    $temp->VALUE = number_format($data['fees_value_' . $value],2);
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
                    $temp->VALUE->AMOUNT_ADULT = number_format($data['fees_value_adult_' . $value],2);
                    $temp->VALUE->AMOUNT_CHILD = number_format($data['fees_value_child_' . $value],2);
                    $temp->VALUE->AMOUNT_BABY = number_format($data['fees_value_baby_' . $value],2);
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
                                    $kkr->VALUE->AMOUNT_ADULT = number_format($vrr,2);
                                    $kkr->VALUE->AMOUNT_CHILD = number_format($data['fees_value_staylength_value_child_' . $value][$kr][$krr],2);
                                    $kkr->VALUE->AMOUNT_BABY = number_format($data['fees_value_staylength_value_baby_' . $value][$kr][$krr],2);
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
                                    $kkr->VALUE = number_format($vrr,2);
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
                                    $kkr->VALUE->AMOUNT_ADULT = number_format($vrr,2);
                                    $kkr->VALUE->AMOUNT_CHILD = number_format($data['fees_value_staylength_value_child_apg' . $value][$kr][$krr],2);
                                    $kkr->VALUE->AMOUNT_BABY = number_format($data['fees_value_staylength_value_baby_apg' . $value][$kr][$krr],2);
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
                                    $kkr->VALUE = number_format($vrr,2);
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
                $data_insert['PROP_ID'] = $property_id;
                $data_insert['FEE_TYPE_ID'] = $value->FEE_TYPE_ID;
                $data_insert['INCLUDE_IN_RENT'] = $value->INCLUDE_IN_RENT;
                $data_insert['UNIT'] = $value->UNIT;
                $data_insert['VALUE'] = json_encode($value->VALUE);
                $this->db->insert('kigo_properties_pricing_fees', $data_insert);
            }
        }
    }

    public function update_property_step6($property_id, $data) {
        if (!empty($data['price_check_in'])) {

            $this->db->where('PROP_ID', $property_id);
            $this->db->delete('kigo_properties_pricing_rent');

            $this->db->where('PROP_ID', $property_id);
            $this->db->delete('kigo_properties_pricing_nightly_rent');

            for ($i = 0; $i< count($data['price_check_in']); $i++) {
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
                $data_insert['PROP_ID'] = $property_id;
                $data_insert['CURRENCY'] = $data['currency'];
                if (isset($data['weekly_amount'][$i]) && !empty($data['weekly_amount'][$i])) {
                    $data_insert['WEEKLY_PRICING'] = 0;
                    foreach ($data['weekly_amount'][$i] as $key =>
                $value) {
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
                                    $data_insert_night['PROP_ID'] = $property_id;
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
        }
    }

    public function update_property_kigo($property_id, $notification_id) {
        $data['property_info'] = $this->get_property_by_id($property_id);
        $data['property_pricing_info'] = $this->get_property_pricing_by_id($property_id);
        $data['property_photos'] = $this->get_property_photos($property_id);
        $data['property_udpa'] = $this->get_property_udpa_by_id($property_id);
        $data['property_special_discounts'] = $this->get_property_special_discounts($property_id);
        $data['property_lastminute_discounts'] = $this->get_property_lastminute_discounts($property_id);
        $amenties = $this->Kigo_Model->get_amenities();
        $data['property_fees_types'] = $this->Kigo_Model->property_fees_types($property_id);

        $aResponse = $this->kigo->update_property($data, $data['property_info']->KIGO_PROPERTY_ID);

        $owner_info = json_decode($aResponse['api_response']);

        if ($owner_info->API_RESULT_CODE != "E_OK") {
            $this->db->where('NOTIFICATION_ID', $notification_id);
            $this->db->update('kigo_apartment_notifications', array('KIGO_ACTION_STATUS' => 2, 'API_REQUEST' => $aResponse['api_request'], 'API_RESPONSE' => $aResponse['api_response'], 'API_URL' => $aResponse['api_url']));
        } else {
            $this->db->where('NOTIFICATION_ID', $notification_id);
            $this->db->update('kigo_apartment_notifications', array('KIGO_PUSH_STATUS' => 1, 'KIGO_ACTION_STATUS' => 1, 'API_REQUEST' => $aResponse['api_request'], 'API_RESPONSE' => $aResponse['api_response'], 'API_URL' => $aResponse['api_url']));
        }
    }

    function add_property_step1($data) {
        $data_add['PROP_NAME'] = $data['property_name'];
        $data_add['PROP_TYPE_ID'] = $data['property_type'];
        $data_add['PROP_SIZE'] = $data['property_size'];
        $data_add['PROP_SIZE_UNIT'] = $data['property_size_unit'];
        $data_add['PROP_BEDROOMS'] = $data['property_bedrooms'];
        $data_add['PROP_BEDS'] = $data['property_beds'];
        $data_add['PROP_COUT_TIME'] = $data['check_out'];
        $data_add['PROP_CIN_TIME'] = $data['check_in'];
        $data_add['PROP_FLOOR'] = $data['floor'];
        $data_add['PROP_ELEVATOR'] = $data['elevator'];
        $data_add['PROP_BATHROOMS'] = $data['bathrooms'];
        $data_add['PROP_TOILETS'] = $data['toilet'];
        $data_add['PROP_CLEAN_TIME'] = $data['cleaning_time'];
        $data_add['PROP_RATE_CURRENCY'] = $data['currency'];
        $data_add['PROP_RATE_NIGHTLY_FROM'] = $data['nightly_rate_from'];
        $data_add['PROP_RATE_NIGHTLY_TO'] = $data['nightly_rate_to'];
        $data_add['PROP_RATE_WEEKLY_FROM'] = $data['weekly_rate_from'];
        $data_add['PROP_RATE_WEEKLY_TO'] = $data['weekly_rate_to'];
        $data_add['PROP_RATE_MONTHLY_FROM'] = $data['monthly_rate_from'];
        $data_add['PROP_RATE_MONTHLY_TO'] = $data['monthly_rate_to'];
        $data_add['PROP_MAXGUESTS'] = $data['max_guests'];
        $data_add['PROP_MAXGUESTS_ADULTS'] = $data['max_adults'];
        $data_add['PROP_MAXGUESTS_CHILDREN'] = $data['max_child'];
        $data_add['PROP_MAXGUESTS_BABIES'] = $data['max_babies'];
        $data_add['PROP_STAYTIME_MIN_VALUE'] = $data['min_stay_value'];
        $data_add['PROP_STAYTIME_MIN_UNIT'] = $data['min_stay_unit'];
        $data_add['PROP_STAYTIME_MAX_VALUE'] = $data['max_stay_value'];
        $data_add['PROP_STAYTIME_MAX_UNIT'] = $data['max_stay_unit'];
        $data_add['PROVIDER_ID'] = $data['owner_id'];
        $data_add['PROP_PROVIDER'] = 'OWNER';

        $data_add['PROP_STREETNO'] = $data['street_no'];
        $data_add['PROP_POSTCODE'] = $data['postal_code'];
        $data_add['PROP_APTNO'] = $data['apt_no'];
        $data_add['PROP_ADDR1'] = $data['address1'];
        $data_add['PROP_ADDR2'] = $data['address2'];
        $data_add['PROP_ADDR3'] = $data['address3'];
        $data_add['PROP_CITY'] = $data['city'];
        $data_add['PROP_PHONE'] = $data['prop_phone_no'];

        $data_add['PROP_REGION'] = $data['region'];
        $data_add['PROP_AXSCODE'] = $data['access_code'];
        $data_add['PROP_COUNTRY'] = $data['country'];
        $data_add['PROP_LATITUDE'] = $data['latitude'];
        $data_add['PROP_LONGITUDE'] = $data['longitude'];

        $data_add['PROP_RENTAL_DETAILS'] = $data['rental_details'];
        $data_add['PROP_INVENTORY'] = $data['inventory'];
        $data_add['PROP_ARRIVAL_SHEET'] = $data['arrival_sheet'];
        $data_add['PROP_SHORTDESCRIPTION'] = $data['short_desc'];
        $data_add['PROP_DESCRIPTION'] = $data['full_desc'];
        $data_add['PROP_AREADESCRIPTION'] = $data['area_desc'];
        $data_add['PROPERTY_STATUS'] = '0';
        
        if (!empty($data['amenities'])) {
            $data_add['PROP_AMENITIES'] = implode(',', $data['amenities']);
        } else {
            $data_add['PROP_AMENITIES'] = '';
        }

        if (!empty($data['activities'])) {
            $data_add['PROP_ACTIVITIES'] = implode(',', $data['activities']);
        } else {
            $data_add['PROP_ACTIVITIES'] = '';
        }

        $data_add['PROP_BED_TYPES'] = implode(',', $data['prop_beds_types']);
        $data_add['EARLY_BIRD_DISCOUNT_DAYS'] = $data['early_bird_days'];
        $data_add['EARLY_BIRD_DISCOUNT_PERCENT'] = $data['early_bird_discount'];
        
        
        $this->db->insert('kigo_properties', $data_add);
        return $this->db->insert_id();
    }

    public function add_property_step2($property_id, $data) {
        $data_add = "";
        if (!empty($data['lastminute_discounts_days'])) {
            for ($i = 0; $i< count($data['lastminute_discounts_days']); $i++) {
                $data_add['PROP_ID'] = $property_id;
                $data_add['DISCOUNT_BEFORE_CHECKIN_DAYS'] = $data['lastminute_discounts_days'][$i];
                $data_add['DISCOUNT_PERCENTAGE'] = $data['lastminute_discounts'][$i];

                $this->
                    db->insert('kigo_properties_lastminute_discounts', $data_add);
            }
        }

        $data_add = "";

        if (!empty($data['psd_checkin'])) {
            for ($i = 0; $i< count($data['psd_checkin']); $i++) {
                $data_add['PROP_ID'] = $property_id;
                $data_add['CHECK_IN'] = $data['psd_checkin'][$i];
                $data_add['CHECK_OUT'] = $data['psd_checkout'][$i];
                $data_add['VALID_TO'] = $data['psd_validto'][$i];
                $data_add['VALID_FROM'] = $data['psd_validfrom'][$i];
                $data_add['DISCOUNT_NAME'] = $data['psd_discount_name'][$i];
                $data_add['DISCOUNT_PERCENTAGE'] = $data['psd_discount_per'][$i];

                $this->db->insert('kigo_properties_special_discounts', $data_add);
            }
        }
    }

    function add_property_step3($property_id, $data) {

        $data_add = "";

        if (!empty($data['udpa_id'])) {
            for ($i = 0; $i< count($data['udpa_id']); $i++) {
                $data_add['UDPA_ID'] = $data['udpa_id'][$i];
                $data_add['UDPA_TEXT'] = $data['udpa_value'][$i];
                $data_add['PROP_ID'] = $property_id;

                $this->db->insert('kigo_properties_userdefined_fields', $data_add);
            }
        }
    }

    function add_property_step4($property_id, $data) {
        $data_add = "";

        if (isset($data['image']) && !empty($data['image'])) {
            foreach ($data['image'] as $key => $value) {
                $data_add['PHOTO_CONTENT'] = $value[0];
                $data_add['PROP_ID'] = $property_id;
                $data_add['PHOTO_COMMENTS'] = $data['comment'][$key][0];
                $data_add['PHOTO_NAME'] = $data['name'][$key][0];

                if (isset($data['panaromic_view'][$key])) {
                    $data_add['PHOTO_PANORAMIC'] = 1;
                } else {
                    $data_add['PHOTO_PANORAMIC'] = 0;
                }

                $this->db->insert('kigo_properties_photo', $data_add);
            }
        }
    }

    function add_property_step5($property_id, $data) {
        $fees_types_value = array();

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
                $data_insert['PROP_ID'] = $property_id;
                $data_insert['FEE_TYPE_ID'] = $value->FEE_TYPE_ID;
                $data_insert['INCLUDE_IN_RENT'] = $value->INCLUDE_IN_RENT;
                $data_insert['UNIT'] = $value->UNIT;
                $data_insert['VALUE'] = json_encode($value->VALUE);
                $this->db->insert('kigo_properties_pricing_fees', $data_insert);
            }
        }
    }

    public function add_property_step6($property_id, $data) {
        if (!empty($data['price_check_in'])) {

            for ($i = 0; $i
                            < count($data['price_check_in']); $i++) {
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
                $data_insert['PROP_ID'] = $property_id;
                $data_insert['CURRENCY'] = $data['currency'];
                if (isset($data['weekly_amount'][$i]) && !empty($data['weekly_amount'][$i])) {
                    $data_insert['WEEKLY_PRICING'] = 0;
                    foreach ($data['weekly_amount'][$i] as $key =>
                                $value) {
                        $weekly_guest_from[] = $key;
                        $weekly_amount[] = $value;
                    }
                    $data_insert['WEEKY_GUEST_FROM'] = implode(',', $weekly_guest_from);
                    $data_insert['WEEKLY_AMOUNT'] = implode(',', $weekly_amount);
                    $data_insert['WEEKLY_PRICING'] = 1;
                } else {
                    $data_insert['WEEKLY_PRICING'] = 0;
                    $data_insert['NIGHTLY_RANDOM'] = uniqid('NW');
                    
                    if(!empty($data['nightly_amount'][$i]) && is_array($data['nightly_amount'][$i])){                       
                    foreach ($data['nightly_amount'][$i] as $key => $value) {
                        if(!empty($value)){
                        foreach ($value as $sk => $sv) {
                            foreach ($sv as $ssk => $ssv) {
                                foreach ($ssv as $sssk => $sssv) {
                                    $data_insert_night['NIGHTLY_STAY_NUMBER'] = $ssk;
                                    $data_insert_night['NIGHTLY_GUESTS_FROM'] = $sk;
                                    $data_insert_night['WEEK_NIGHTS'] = $key;
                                    $data_insert_night['NIGHTLY_RANDOM_ID'] = $data_insert['NIGHTLY_RANDOM'];
                                    $data_insert_night['PROP_ID'] = $property_id;
                                    $data_insert_night['NIGHTLY_STAY_UNIT'] = $sssk;
                                    $data_insert_night['NIGHTLY_AMOUNT'] = $sssv;

                                    $this->db->insert('kigo_properties_pricing_nightly_rent', $data_insert_night);
                                }
                            }
                        }
                        }
                    }
                    }                    
                }
                $this->db->insert('kigo_properties_pricing_rent', $data_insert);
            }
        }
    }
    
    public function updateInstantBooking($id, $status){
    $this->db->trans_start();
    $this->db->where('PROPERTY_ID',$id);
    $this->db->update('kigo_properties',$status);   
    $this->db->trans_complete();
    return $this->db->trans_status();
    }

    public function updatePropertyStatus($id,$status){
    $this->db->trans_start();
    $this->db->where('PROPERTY_ID',$id);
    $this->db->update('kigo_properties',$status);   
    $this->db->trans_complete();
    return $this->db->trans_status();
    }
    
    public function currency_convertor($amount,$from,$to){
        //echo $to;die;
        $from = strtoupper($from);
        //$this->db->select('value');
        $this->db->where('country',$from);
        $price = $this->db->get('currency_converter')->row();
        $value = $price->value;
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
    
    public function get_owner_by_id($owner_id){
        $this->db->select('*');
        $this->db->from('kigo_owners');
        $this->db->where('ONWER_ID',$owner_id);
        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return "";
        }
    }
    
    public function updateAdminPropertyStatus($property_id){                
        $this->db->where('PROPERTY_ID', $property_id);
        $this->db->update('kigo_properties', array('ADMIN_APPROVAL_STATUS' => 1));
    }
    
    public function importnewreservation(){
        $this->db->where('RES_IS_FOR','1');
        $this->db->delete('kigo_reservation_calender');
        
        $aResponse = $this->kigo->importnewreservation();
        if(isset($aResponse->API_REPLY->RES_LIST) && !empty($aResponse->API_REPLY->RES_LIST)){
            foreach($aResponse->API_REPLY->RES_LIST as $key => $value){
                $data['RES_ID'] = $value->RES_ID;
                $data['PROP_ID'] = $value->PROP_ID;
                $data['RES_STATUS'] = $value->RES_STATUS;
                $data['RES_CHECK_IN'] = $value->RES_CHECK_IN;
                $data['RES_CHECK_OUT'] = $value->RES_CHECK_OUT;
                $data['RES_IS_FOR'] = $value->RES_IS_FOR;
                
                $this->db->insert('kigo_reservation_calender', $data); 
            }
        }
    }

    public function checkOwnerEmail($owner_email_id) {
        $this->db->select('OWNER_EMAIL');
        $this->db->from('kigo_owners');
        $this->db->where('OWNER_EMAIL', $owner_email_id);
        
        return $this->db->get();
    }
}
