<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Apartment_kigo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->check_isvalidated();
        $this->load->library('form_validation', 'session');
        $this->load->library('encrypt');
        $this->load->model('Kigo_Model');

        if ($this->session->userdata('admin_logged_in')) {
            $this->load->helper('url');
            $controller = $this->router->fetch_class();
            parent::check_modules($controller);
            $this->load->model('Privilege_Model');
            $sub_admin_id = $this->session->userdata('admin_id');
            $this->data['modules'] = $this->Privilege_Model->get_privileges_by_sub_admin_id($sub_admin_id)->result();
        }
        error_reporting(1);
    }

    private function check_isvalidated() {
        if (!$this->session->userdata('admin_logged_in') && !$this->session->userdata('sa_logged_in')) {
            redirect('login/index');
        }
    }

    public function index() {
        $this->load->view('apartment_kigo/dashboard');
    }

    public function list_owners() {
        $data['result'] = $this->Kigo_Model->get_owners_list();
        $owner_import_status = $this->Kigo_Model->module_import_status('owners');
        $data['owner_import_status'] = $owner_import_status->FIRST_IMPORT_STATUS;
        $this->load->view('apartment_kigo/list_owners', $data);
    }

    public function import_owners_kigo() {
        $result = $this->Kigo_Model->get_kigo_owners_list();
        if (!empty($result->API_REPLY)) {
            foreach ($result->API_REPLY as $key => $value) {
                $aResult = $this->Kigo_Model->read_owner_kigo(trim(stripslashes($value->OWNER_ID)));
                if (!empty($aResult->API_REPLY->OWNER_INFO)) {
                    $owner_info = $aResult->API_REPLY->OWNER_INFO;
                    $data['KIGO_ONWER_ID'] = $value->OWNER_ID;
                    $data['OWNER_FIRSTNAME'] = $owner_info->OWNER_FIRSTNAME;
                    $data['OWNER_LASTNAME'] = $owner_info->OWNER_LASTNAME;
                    $data['OWNER_EMAIL'] = $owner_info->OWNER_EMAIL;
                    $data['OWNER_PHONE_HOME'] = $owner_info->OWNER_PHONE_HOME;
                    $data['OWNER_PHONE_WORK'] = $owner_info->OWNER_PHONE_WORK;
                    $data['OWNER_PHONE_CELL'] = $owner_info->OWNER_PHONE_CELL;
                    $data['OWNER_FAX'] = $owner_info->OWNER_FAX;
                    $data['OWNER_STREETNO'] = $owner_info->OWNER_STREETNO;
                    $data['OWNER_ADDR1'] = $owner_info->OWNER_ADDR1;
                    $data['OWNER_ADDR2'] = $owner_info->OWNER_ADDR2;
                    $data['OWNER_ADDR3'] = $owner_info->OWNER_ADDR3;
                    $data['OWNER_POSTCODE'] = $owner_info->OWNER_POSTCODE;
                    $data['OWNER_CITY'] = $owner_info->OWNER_CITY;
                    $data['OWNER_COUNTRY'] = $owner_info->OWNER_COUNTRY;
                    $data['OWNER_CONTACT_INFO'] = $owner_info->OWNER_CONTACT_INFO;
                    $data['ONWER_TYPE'] = "Kigo";

                    $reference_id = $this->Kigo_Model->insert_onwers($data);

                    $data_notification['MODULE_NAME'] = 'owners';
                    $data_notification['REFERENCE_ID'] = $reference_id;
                    $data_notification['ACTION_STATUS'] = 2;
                    $data_notification['KIGO_PUSH_STATUS'] = 2;
                    $data_notification['KIGO_ACTION_STATUS'] = 1;
                    $this->Kigo_Model->insert_notification($data_notification);
                }
            }
        }
        $this->Kigo_Model->update_module_import_status('owners', 1);
    }

    public function edit_owner($owner_id) {
        $data['owner_info'] = $this->Kigo_Model->read_owner(trim(stripslashes($owner_id)));
        $data['countries'] = $this->Kigo_Model->get_countries();
        $this->load->view('apartment_kigo/edit_owner', $data);
    }

    public function update_owner($owner_id) {
        $data = $_POST;
        $aResult = $this->Kigo_Model->update_owner($data, $owner_id);

        $data_notification['MODULE_NAME'] = 'owners';
        $data_notification['REFERENCE_ID'] = $owner_id;
        $data_notification['ACTION_STATUS'] = 1;
        $data_notification['KIGO_PUSH_STATUS'] = 0;
        $this->Kigo_Model->insert_notification($data_notification);

        redirect('apartment_kigo/list_owners');
    }

    public function update_owner_kigo() {
        $owner_id = $this->input->post('onwer_id');
        $notification_id = $this->input->post('notification_id');
        for ($i = 0; $i
< count($owner_id); $i++) {
            $this->
	Kigo_Model->update_owner_kigo($owner_id[$i], $notification_id[$i]);
        }
    }

    public function notifications() {
        $data['owner_imported_info'] = $this->Kigo_Model->get_owner_notifications(2);
        $data['owner_updated_info'] = $this->Kigo_Model->get_owner_notifications(1);
        $data['owner_new_info'] = $this->Kigo_Model->get_owner_notifications(0);

        $data['property_imported_info'] = $this->Kigo_Model->get_property_notifications(2);
        $data['property_fields_info'] = $this->Kigo_Model->get_property_fields_notifications(2);

        $data['property_updated_info'] = $this->Kigo_Model->get_property_notifications(1);
        $this->load->view('apartment_kigo/notifications/notifications', $data);
    }

    public function add_owner() {
        $data['countries'] = $this->Kigo_Model->get_countries();
        $this->load->view('apartment_kigo/add_owner', $data);
    }

    public function validateOwnerEmail() {
        $owner_email_id = $this->input->post('owner_email');

        $check_email_count = $this->Kigo_Model->checkOwnerEmail($owner_email_id)->num_rows();
        if($check_email_count > 0) {
            $response = array('status'=>1);
        } else {
            $response = array('status'=>0);
        }
        echo json_encode($response);
    }

    public function insert_owner_kigo() {
        $data = $_POST;
        $reference_id = $this->Kigo_Model->insert_owner_kigo($data);

        $data_notification['MODULE_NAME'] = 'owners';
        $data_notification['REFERENCE_ID'] = $reference_id;
        $data_notification['ACTION_STATUS'] = 0;
        $data_notification['KIGO_PUSH_STATUS'] = 0;
        $this->Kigo_Model->insert_notification($data_notification);
        redirect('apartment_kigo/list_owners');
    }

    public function add_owner_kigo() {
        $owner_id = $this->input->post('onwer_id');
        $notification_id = $this->input->post('notification_id');
        for ($i = 0; $i
	< count($owner_id); $i++) {
            $aResult = $this->
		Kigo_Model->add_owner_kigo($owner_id[$i], $notification_id[$i]);
        }
    }
   public function add_owner_kigo_v1($owner_id) {
     
             $this->Kigo_Model->add_owner_kigo_v1($owner_id);
     		redirect('apartment_kigo/list_owners');
    }
    public function import_properties_kigo() {
        $aResult = $this->Kigo_Model->get_properties_kigo();
        $this->Kigo_Model->empty_property();
        if (!empty($aResult->API_REPLY)) {
            foreach ($aResult->API_REPLY as $key => $value) {
                $aResponse = $this->Kigo_Model->readProperty2(trim(stripslashes($value->PROP_ID)));

                $aResultProperty = $aResponse['api_response'];
				
				$travelapt_owner_account = $this->get_travelapt_owner_account();
				
				
                //Property Main Table
                if (isset($aResultProperty->API_REPLY) && !empty($aResultProperty->API_REPLY)) {
                    $property_info = $aResultProperty->API_REPLY;
                    $data_property['KIGO_PROPERTY_ID'] = $property_info->PROP_ID;
                    if (!empty($property_info->PROP_PROVIDER)) {
                        $data_property['PROP_PROVIDER'] = $property_info->PROP_PROVIDER->PROVIDER_TYPE;
                        if (isset($property_info->PROP_PROVIDER->OWNER_ID)) {
                            $data_property['PROVIDER_ID'] = $property_info->PROP_PROVIDER->OWNER_ID;
                        } elseif (isset($property_info->PROP_PROVIDER->RA_ID)) {
                            $data_property['PROVIDER_ID'] = $property_info->PROP_PROVIDER->RA_ID;
                        } else {
                            $data_property['PROVIDER_ID'] = "";
                        }
                        $data_property['USER_ID'] = $travelapt_owner_account->user_id;
                        $data_property['USER_TYPE'] = $travelapt_owner_account->usertype;
                    } else {	
                        $data_property['PROP_PROVIDER'] = "";
                        $data_property['PROVIDER_ID'] = "";
                        $data_property['USER_ID'] = $travelapt_owner_account->user_id;
                        $data_property['USER_TYPE'] = $travelapt_owner_account->usertype;
                    }

                    $data_property['PROP_INSTANT_BOOK'] = $property_info->PROP_INSTANT_BOOK;
                    $data_property['PROP_NAME'] = $property_info->PROP_INFO->PROP_NAME;
                    $data_property['PROP_STREETNO'] = $property_info->PROP_INFO->PROP_STREETNO;
                    $data_property['PROP_ADDR1'] = $property_info->PROP_INFO->PROP_ADDR1;
                    $data_property['PROP_ADDR2'] = $property_info->PROP_INFO->PROP_ADDR2;
                    $data_property['PROP_ADDR3'] = $property_info->PROP_INFO->PROP_ADDR3;
                    $data_property['PROP_APTNO'] = $property_info->PROP_INFO->PROP_APTNO;
                    $data_property['PROP_POSTCODE'] = $property_info->PROP_INFO->PROP_POSTCODE;
                    $data_property['PROP_CITY'] = $property_info->PROP_INFO->PROP_CITY;
                    $data_property['PROP_REGION'] = $property_info->PROP_INFO->PROP_REGION;
                    $data_property['PROP_COUNTRY'] = $property_info->PROP_INFO->PROP_COUNTRY;

                    if (!empty($property_info->PROP_INFO->PROP_LATLNG)) {
                        $data_property['PROP_LATITUDE'] = $property_info->PROP_INFO->PROP_LATLNG->LATITUDE;
                        $data_property['PROP_LONGITUDE'] = $property_info->PROP_INFO->PROP_LATLNG->LONGITUDE;
                    } else {
                        $data_property['PROP_LATITUDE'] = "";
                        $data_property['PROP_LONGITUDE'] = "";
                    }


                    $data_property['PROP_PHONE'] = $property_info->PROP_INFO->PROP_PHONE;
                    $data_property['PROP_AXSCODE'] = $property_info->PROP_INFO->PROP_AXSCODE;
                    $data_property['PROP_BEDROOMS'] = $property_info->PROP_INFO->PROP_BEDROOMS;
                    $data_property['PROP_BEDS'] = $property_info->PROP_INFO->PROP_BEDS;
                    if (!empty($property_info->PROP_INFO->PROP_BED_TYPES)) {
                        $data_property['PROP_BED_TYPES'] = implode(",", $property_info->PROP_INFO->PROP_BED_TYPES);
                    } else {
                        $data_property['PROP_BED_TYPES'] = "";
                    }
                    $data_property['PROP_BATHROOMS'] = $property_info->PROP_INFO->PROP_BATHROOMS;
                    $data_property['PROP_TOILETS'] = $property_info->PROP_INFO->PROP_TOILETS;
                    $data_property['PROP_TYPE_ID'] = $property_info->PROP_INFO->PROP_TYPE_ID;
                    $data_property['PROP_SIZE'] = $property_info->PROP_INFO->PROP_SIZE;
                    $data_property['PROP_SIZE_UNIT'] = $property_info->PROP_INFO->PROP_SIZE_UNIT;
                    $data_property['PROP_MAXGUESTS'] = $property_info->PROP_INFO->PROP_MAXGUESTS;
                    $data_property['PROP_MAXGUESTS_ADULTS'] = $property_info->PROP_INFO->PROP_MAXGUESTS_ADULTS;
                    $data_property['PROP_MAXGUESTS_CHILDREN'] = $property_info->PROP_INFO->PROP_MAXGUESTS_CHILDREN;
                    $data_property['PROP_MAXGUESTS_BABIES'] = $property_info->PROP_INFO->PROP_MAXGUESTS_BABIES;
                    $data_property['PROP_FLOOR'] = $property_info->PROP_INFO->PROP_FLOOR;
                    $data_property['PROP_ELEVATOR'] = $property_info->PROP_INFO->PROP_ELEVATOR;
                    $data_property['PROP_CIN_TIME'] = $property_info->PROP_INFO->PROP_CIN_TIME;
                    $data_property['PROP_COUT_TIME'] = $property_info->PROP_INFO->PROP_COUT_TIME;
                    $data_property['PROP_CLEAN_TIME'] = $property_info->PROP_INFO->PROP_CLEAN_TIME;
                    $data_property['PROP_STAYTIME_MIN_UNIT'] = $property_info->PROP_INFO->PROP_STAYTIME_MIN->UNIT;
                    $data_property['PROP_STAYTIME_MIN_VALUE'] = $property_info->PROP_INFO->PROP_STAYTIME_MIN->NUMBER;
                    $data_property['PROP_STAYTIME_MAX_UNIT'] = $property_info->PROP_INFO->PROP_STAYTIME_MAX->UNIT;
                    $data_property['PROP_STAYTIME_MAX_VALUE'] = $property_info->PROP_INFO->PROP_STAYTIME_MAX->NUMBER;
                    $data_property['PROP_SHORTDESCRIPTION'] = $property_info->PROP_INFO->PROP_SHORTDESCRIPTION;
                    $data_property['PROP_DESCRIPTION'] = $property_info->PROP_INFO->PROP_DESCRIPTION;
                    $data_property['PROP_AREADESCRIPTION'] = $property_info->PROP_INFO->PROP_AREADESCRIPTION;
                    $data_property['PROP_RENTAL_DETAILS'] = $property_info->PROP_INFO->PROP_RENTAL_DETAILS;
                    $data_property['PROP_INVENTORY'] = $property_info->PROP_INFO->PROP_INVENTORY;
                    $data_property['PROP_ARRIVAL_SHEET'] = $property_info->PROP_INFO->PROP_ARRIVAL_SHEET;
                    $data_property['PROPERTY_STATUS'] = '0';

                    if (!empty($property_info->PROP_INFO->PROP_AMENITIES)) {
                        $data_property['PROP_AMENITIES'] = implode(",", $property_info->PROP_INFO->PROP_AMENITIES);
                    } else {
                        $data_property['PROP_AMENITIES'] = "";
                    }

                    if (!empty($property_info->PROP_INFO->PROP_ACTIVITIES)) {
                        $data_property['PROP_ACTIVITIES'] = implode(",", $property_info->PROP_INFO->PROP_ACTIVITIES);
                    } else {
                        $data_property['PROP_ACTIVITIES'] = "";
                    }

                    $data_property['PROP_RATE_CURRENCY'] = $property_info->PROP_RATE->PROP_RATE_CURRENCY;
                    $data_property['PROP_RATE_NIGHTLY_FROM'] = $property_info->PROP_RATE->PROP_RATE_NIGHTLY_FROM;
                    $data_property['PROP_RATE_NIGHTLY_FROM_CURR'] = $this->Kigo_Model->currency_convertor($property_info->PROP_RATE->PROP_RATE_NIGHTLY_FROM,$property_info->PROP_RATE->PROP_RATE_CURRENCY,SITE_CURRENCY);
                    $data_property['PROP_RATE_NIGHTLY_TO'] = $property_info->PROP_RATE->PROP_RATE_NIGHTLY_TO;
                    $data_property['PROP_RATE_WEEKLY_FROM'] = $property_info->PROP_RATE->PROP_RATE_WEEKLY_FROM;
                    $data_property['PROP_RATE_WEEKLY_TO'] = $property_info->PROP_RATE->PROP_RATE_WEEKLY_TO;
                    $data_property['PROP_RATE_MONTHLY_FROM'] = $property_info->PROP_RATE->PROP_RATE_MONTHLY_FROM;
                    $data_property['PROP_RATE_MONTHLY_TO'] = $property_info->PROP_RATE->PROP_RATE_MONTHLY_TO;
                    $data_property['PROP_MODE'] = "Kigo";

                    $reference_id = $this->Kigo_Model->insert_property_info($data_property);

                    if (!empty($property_info->PROP_UDPA)) {
                        foreach ($property_info->PROP_UDPA as $key => $value) {
                            $data_property_udpa['PROP_ID'] = $reference_id;
                            $data_property_udpa['UDPA_ID'] = $value->UDPA_ID;
                            $data_property_udpa['UDPA_TEXT'] = $value->UDPA_TEXT;
                            $this->Kigo_Model->insert_property_udpa($data_property_udpa);
                        }
                    }

                    if (!empty($property_info->PROP_PHOTOS)) {
                        foreach ($property_info->PROP_PHOTOS as $key => $value) {
                            $data_photos['PHOTO_KIGO_ID'] = $value->PHOTO_ID;
                            $data_photos['PHOTO_PANORAMIC'] = $value->PHOTO_PANORAMIC;
                            $data_photos['PHOTO_NAME'] = $value->PHOTO_NAME;
                            $data_photos['PHOTO_COMMENTS'] = $value->PHOTO_COMMENTS;
                            $data_photos['PROP_ID'] = $reference_id;

                            $this->Kigo_Model->insert_property_photo($data_photos);
                        }
                    }

                    $data_notification['MODULE_NAME'] = 'property';
                    $data_notification['REFERENCE_ID'] = $reference_id;
                    $data_notification['ACTION_STATUS'] = 2;
                    $data_notification['KIGO_PUSH_STATUS'] = 2;
                    $data_notification['KIGO_ACTION_STATUS'] = 1;
                    $data_notification['API_REQUEST'] = $aResponse['api_request'];
                    $data_notification['API_RESPONSE'] = json_encode($aResponse['api_response']);
                    $data_notification['API_URL'] = $aResponse['api_url'];
                    $this->Kigo_Model->insert_notification($data_notification);

                    //Property Main Table
                }
            }
            $this->Kigo_Model->update_module_import_status('property', 1);
        }
    }
    
    public function import_new_properties_kigo(){	
		
		$aResult = $this->Kigo_Model->get_properties_kigo();
		
		$list_properties = $this->Kigo_Model->get_properties();
		$property_id = array();
		
		if(!empty($list_properties)){
			foreach($list_properties as $key => $value){
				$property_id[] = $value->KIGO_PROPERTY_ID;
			}
		}
		 
        if (!empty($aResult->API_REPLY)) {
            foreach ($aResult->API_REPLY as $key => $value) {
                $aResponse = $this->Kigo_Model->readProperty2(trim(stripslashes($value->PROP_ID)));

                $aResultProperty = $aResponse['api_response'];
				
				$travelapt_owner_account = $this->get_travelapt_owner_account();
				
                //Property Main Table
                if (isset($aResultProperty->API_REPLY) && !empty($aResultProperty->API_REPLY)) {
                    $property_info = $aResultProperty->API_REPLY;
                    if(!in_array($property_info->PROP_ID,$property_id)){
						
                    $data_property['KIGO_PROPERTY_ID'] = $property_info->PROP_ID;
						
                    if (!empty($property_info->PROP_PROVIDER)) {
                        $data_property['PROP_PROVIDER'] = $property_info->PROP_PROVIDER->PROVIDER_TYPE;
                        if (isset($property_info->PROP_PROVIDER->OWNER_ID)) {
                            $data_property['PROVIDER_ID'] = $property_info->PROP_PROVIDER->OWNER_ID;
                        } elseif (isset($property_info->PROP_PROVIDER->RA_ID)) {
                            $data_property['PROVIDER_ID'] = $property_info->PROP_PROVIDER->RA_ID;
                        } else {
                            $data_property['PROVIDER_ID'] = "";
                        }
                        $data_property['USER_ID'] = $travelapt_owner_account->user_id;
                        $data_property['USER_TYPE'] = $travelapt_owner_account->usertype;
                    } else {	
                        $data_property['PROP_PROVIDER'] = "";
                        $data_property['PROVIDER_ID'] = "";
                        $data_property['USER_ID'] = $travelapt_owner_account->user_id;
                        $data_property['USER_TYPE'] = $travelapt_owner_account->usertype;
                    }

                    $data_property['PROP_INSTANT_BOOK'] = $property_info->PROP_INSTANT_BOOK;
                    $data_property['PROP_NAME'] = $property_info->PROP_INFO->PROP_NAME;
                    $data_property['PROP_STREETNO'] = $property_info->PROP_INFO->PROP_STREETNO;
                    $data_property['PROP_ADDR1'] = $property_info->PROP_INFO->PROP_ADDR1;
                    $data_property['PROP_ADDR2'] = $property_info->PROP_INFO->PROP_ADDR2;
                    $data_property['PROP_ADDR3'] = $property_info->PROP_INFO->PROP_ADDR3;
                    $data_property['PROP_APTNO'] = $property_info->PROP_INFO->PROP_APTNO;
                    $data_property['PROP_POSTCODE'] = $property_info->PROP_INFO->PROP_POSTCODE;
                    $data_property['PROP_CITY'] = $property_info->PROP_INFO->PROP_CITY;
                    $data_property['PROP_REGION'] = $property_info->PROP_INFO->PROP_REGION;
                    $data_property['PROP_COUNTRY'] = $property_info->PROP_INFO->PROP_COUNTRY;

                    if (!empty($property_info->PROP_INFO->PROP_LATLNG)) {
                        $data_property['PROP_LATITUDE'] = $property_info->PROP_INFO->PROP_LATLNG->LATITUDE;
                        $data_property['PROP_LONGITUDE'] = $property_info->PROP_INFO->PROP_LATLNG->LONGITUDE;
                    } else {
                        $data_property['PROP_LATITUDE'] = "";
                        $data_property['PROP_LONGITUDE'] = "";
                    }


                    $data_property['PROP_PHONE'] = $property_info->PROP_INFO->PROP_PHONE;
                    $data_property['PROP_AXSCODE'] = $property_info->PROP_INFO->PROP_AXSCODE;
                    $data_property['PROP_BEDROOMS'] = $property_info->PROP_INFO->PROP_BEDROOMS;
                    $data_property['PROP_BEDS'] = $property_info->PROP_INFO->PROP_BEDS;
                    if (!empty($property_info->PROP_INFO->PROP_BED_TYPES)) {
                        $data_property['PROP_BED_TYPES'] = implode(",", $property_info->PROP_INFO->PROP_BED_TYPES);
                    } else {
                        $data_property['PROP_BED_TYPES'] = "";
                    }
                    $data_property['PROP_BATHROOMS'] = $property_info->PROP_INFO->PROP_BATHROOMS;
                    $data_property['PROP_TOILETS'] = $property_info->PROP_INFO->PROP_TOILETS;
                    $data_property['PROP_TYPE_ID'] = $property_info->PROP_INFO->PROP_TYPE_ID;
                    $data_property['PROP_SIZE'] = $property_info->PROP_INFO->PROP_SIZE;
                    $data_property['PROP_SIZE_UNIT'] = $property_info->PROP_INFO->PROP_SIZE_UNIT;
                    $data_property['PROP_MAXGUESTS'] = $property_info->PROP_INFO->PROP_MAXGUESTS;
                    $data_property['PROP_MAXGUESTS_ADULTS'] = $property_info->PROP_INFO->PROP_MAXGUESTS_ADULTS;
                    $data_property['PROP_MAXGUESTS_CHILDREN'] = $property_info->PROP_INFO->PROP_MAXGUESTS_CHILDREN;
                    $data_property['PROP_MAXGUESTS_BABIES'] = $property_info->PROP_INFO->PROP_MAXGUESTS_BABIES;
                    $data_property['PROP_FLOOR'] = $property_info->PROP_INFO->PROP_FLOOR;
                    $data_property['PROP_ELEVATOR'] = $property_info->PROP_INFO->PROP_ELEVATOR;
                    $data_property['PROP_CIN_TIME'] = $property_info->PROP_INFO->PROP_CIN_TIME;
                    $data_property['PROP_COUT_TIME'] = $property_info->PROP_INFO->PROP_COUT_TIME;
                    $data_property['PROP_CLEAN_TIME'] = $property_info->PROP_INFO->PROP_CLEAN_TIME;
                    $data_property['PROP_STAYTIME_MIN_UNIT'] = $property_info->PROP_INFO->PROP_STAYTIME_MIN->UNIT;
                    $data_property['PROP_STAYTIME_MIN_VALUE'] = $property_info->PROP_INFO->PROP_STAYTIME_MIN->NUMBER;
                    $data_property['PROP_STAYTIME_MAX_UNIT'] = $property_info->PROP_INFO->PROP_STAYTIME_MAX->UNIT;
                    $data_property['PROP_STAYTIME_MAX_VALUE'] = $property_info->PROP_INFO->PROP_STAYTIME_MAX->NUMBER;
                    $data_property['PROP_SHORTDESCRIPTION'] = $property_info->PROP_INFO->PROP_SHORTDESCRIPTION;
                    $data_property['PROP_DESCRIPTION'] = $property_info->PROP_INFO->PROP_DESCRIPTION;
                    $data_property['PROP_AREADESCRIPTION'] = $property_info->PROP_INFO->PROP_AREADESCRIPTION;
                    $data_property['PROP_RENTAL_DETAILS'] = $property_info->PROP_INFO->PROP_RENTAL_DETAILS;
                    $data_property['PROP_INVENTORY'] = $property_info->PROP_INFO->PROP_INVENTORY;
                    $data_property['PROP_ARRIVAL_SHEET'] = $property_info->PROP_INFO->PROP_ARRIVAL_SHEET;
                    $data_property['PROPERTY_STATUS'] = '0';
                    $data_property['PROP_MODE'] = 'Kigo';

                    if (!empty($property_info->PROP_INFO->PROP_AMENITIES)) {
                        $data_property['PROP_AMENITIES'] = implode(",", $property_info->PROP_INFO->PROP_AMENITIES);
                    } else {
                        $data_property['PROP_AMENITIES'] = "";
                    }

                    if (!empty($property_info->PROP_INFO->PROP_ACTIVITIES)) {
                        $data_property['PROP_ACTIVITIES'] = implode(",", $property_info->PROP_INFO->PROP_ACTIVITIES);
                    } else {
                        $data_property['PROP_ACTIVITIES'] = "";
                    }

                    $data_property['PROP_RATE_CURRENCY'] = $property_info->PROP_RATE->PROP_RATE_CURRENCY;
                    $data_property['PROP_RATE_NIGHTLY_FROM'] = $property_info->PROP_RATE->PROP_RATE_NIGHTLY_FROM;
                    $data_property['PROP_RATE_NIGHTLY_FROM_CURR'] = $this->Kigo_Model->currency_convertor($property_info->PROP_RATE->PROP_RATE_NIGHTLY_FROM,$property_info->PROP_RATE->PROP_RATE_CURRENCY,SITE_CURRENCY);
                    $data_property['PROP_RATE_NIGHTLY_TO'] = $property_info->PROP_RATE->PROP_RATE_NIGHTLY_TO;
                    $data_property['PROP_RATE_WEEKLY_FROM'] = $property_info->PROP_RATE->PROP_RATE_WEEKLY_FROM;
                    $data_property['PROP_RATE_WEEKLY_TO'] = $property_info->PROP_RATE->PROP_RATE_WEEKLY_TO;
                    $data_property['PROP_RATE_MONTHLY_FROM'] = $property_info->PROP_RATE->PROP_RATE_MONTHLY_FROM;
                    $data_property['PROP_RATE_MONTHLY_TO'] = $property_info->PROP_RATE->PROP_RATE_MONTHLY_TO;
					
                    $reference_id = $this->Kigo_Model->insert_property_info($data_property);

                    if (!empty($property_info->PROP_UDPA)) {
                        foreach ($property_info->PROP_UDPA as $key => $value) {
                            $data_property_udpa['PROP_ID'] = $reference_id;
                            $data_property_udpa['UDPA_ID'] = $value->UDPA_ID;
                            $data_property_udpa['UDPA_TEXT'] = $value->UDPA_TEXT;
                            $this->Kigo_Model->insert_property_udpa($data_property_udpa);
                        }
                    }

                    if (!empty($property_info->PROP_PHOTOS)) {
                        foreach ($property_info->PROP_PHOTOS as $key => $value) {
                            $data_photos['PHOTO_KIGO_ID'] = $value->PHOTO_ID;
                            $data_photos['PHOTO_PANORAMIC'] = $value->PHOTO_PANORAMIC;
                            $data_photos['PHOTO_NAME'] = $value->PHOTO_NAME;
                            $data_photos['PHOTO_COMMENTS'] = $value->PHOTO_COMMENTS;
                            $data_photos['PROP_ID'] = $reference_id;

                            $this->Kigo_Model->insert_property_photo($data_photos);
                        }
                    }

                    $data_notification['MODULE_NAME'] = 'property';
                    $data_notification['REFERENCE_ID'] = $reference_id;
                    $data_notification['ACTION_STATUS'] = 2;
                    $data_notification['KIGO_PUSH_STATUS'] = 2;
                    $data_notification['KIGO_ACTION_STATUS'] = 1;
                    $data_notification['API_REQUEST'] = $aResponse['api_request'];
                    $data_notification['API_RESPONSE'] = json_encode($aResponse['api_response']);
                    $data_notification['API_URL'] = $aResponse['api_url'];
                    $this->Kigo_Model->insert_notification($data_notification);
                    //Property Main Table
					}
				}            
			}
		}	
	}
    
    public function get_travelapt_owner_account(){
		$this->db->select('*');
		$this->db->from('b2b');
		$this->db->where('owner_account_status','1');
		
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row();
		}
	}

    public function list_properties() {
        $property_import_status = $this->Kigo_Model->module_import_status('property');
        if(!empty($property_import_status)){			
			$data['property_import_status'] = $property_import_status->FIRST_IMPORT_STATUS;
		}else{
			$data['property_import_status'] = '';
		}
        
        $data['properties'] = $this->Kigo_Model->get_properties();

        $aPROPERTY_PHOTO_IMPORT_STATUS = array();
        $aPROPERTY_PRICING_IMPORT_STATUS = array();
        if (!empty($data['properties'])) {
            foreach ($data['properties'] as $key => $value) {
                $aPROPERTY_PHOTO_IMPORT_STATUS[] = $value->PROPERTY_PHOTO_IMPORT_STATUS;
                $aPROPERTY_PRICING_IMPORT_STATUS[] = $value->PROPERTY_PRICING_IMPORT_STATUS;
            }
        }
        $aPROPERTY_PHOTO_IMPORT_STATUS = array_unique($aPROPERTY_PHOTO_IMPORT_STATUS);
        $aPROPERTY_PRICING_IMPORT_STATUS = array_unique($aPROPERTY_PRICING_IMPORT_STATUS);

        if (in_array(0, $aPROPERTY_PHOTO_IMPORT_STATUS)) {
            $data['PROPERTY_PHOTO_IMPORT_STATUS'] = 0;
        } else {
            $data['PROPERTY_PHOTO_IMPORT_STATUS'] = 1;
        }

        if (in_array(0, $aPROPERTY_PRICING_IMPORT_STATUS)) {
            $data['PROPERTY_PRICING_IMPORT_STATUS'] = 0;
        } else {
            $data['PROPERTY_PRICING_IMPORT_STATUS'] = 1;
        }
        $this->load->view('apartment_kigo/list_properties', $data);
    }

    public function properties_udpa() {
        $data['property_udpa'] = $this->Kigo_Model->get_property_udpa();
        $this->load->view('apartment_kigo/list_properties_udpa', $data);
    }
	
	public function updateAdminPropertyStatus($property_id){
		$this->Kigo_Model->updateAdminPropertyStatus($property_id);
		redirect('apartment_kigo/list_properties');
	}
	
    public function import_property_udpa_kigo() {
        $this->Kigo_Model->listUserDefinedPropertyAttributes();
    }

    public function list_countries() {
        $data['countries'] = $this->Kigo_Model->get_kigo_countries();
        $this->load->view('apartment_kigo/list_countries', $data);
    }

    public function list_missing_kigo_system_country(){
    	$countries = $this->Kigo_Model->get_kigo_countries();
    	$system_countries_response = $this->Kigo_Model->get_system_countries();

    	$currency_stauts = array();
    	if(!empty(system_countries_response)){
    		foreach($system_countries_response as $key => $value){
    			$currency_stauts[] = $value->country_code;
    		}
    	}

    	if(!empty($countries)){
    		foreach($countries as $key => $value){
    			if(in_array($value->COUNTRY_CODE,$currency_stauts)){
    				$value->currency_status = 1;
    			}
    			else{
    				$value->currency_status = 0;
    			}
    			$system_countries[] = $value;
    		}    		
    	}

    	$data['countries'] = $system_countries;

    	$this->load->view('apartment_kigo/list_missing_kigo_system_country', $data);	
    }

    public function add_missing_country($id){
    	$data['country_details'] = $this->Kigo_Model->get_country_details($id);
    	$this->load->view('apartment_kigo/add_missing_kigo_system_country', $data);
    }

    public function list_currency() {
        $data['currency'] = $this->Kigo_Model->get_kigo_currency();
        $this->load->view('apartment_kigo/list_currency', $data);
    }   

    public function import_countires_kigo() {
        $this->Kigo_Model->listKigoCountries();
    }

     public function import_currency_kigo() {
        $this->Kigo_Model->listKigoCountries();
    }

    public function properties_pdtp() {
        $data['property_pdtp'] = $this->Kigo_Model->get_property_pdtp();
        $this->load->view('apartment_kigo/list_properties_pdtp', $data);
    }

    public function import_pdtp_kigo() {
        $this->Kigo_Model->listKigoPropertyBedTypes();
    }

    public function properties_amentites() {
        $data['amenity_category'] = $this->Kigo_Model->get_amenity_category();
        $data['amenities'] = $this->Kigo_Model->get_amenities();
        $this->load->view('apartment_kigo/properties_amentites', $data);
    }

    public function import_amenties_kigo() {
        $this->Kigo_Model->listKigoPropertyAmenities();
    }

    public function properties_activities() {
        $data['activity_category'] = $this->Kigo_Model->get_activity_category();
        $data['activities'] = $this->Kigo_Model->get_activities();

        $this->load->view('apartment_kigo/properties_activities', $data);
    }

    public function import_activities_kigo() {
        $this->Kigo_Model->listKigoPropertyActivities();
    }

    public function fees_types() {
        $data['fees_types'] = $this->Kigo_Model->get_fees_types();
        $this->load->view('apartment_kigo/fees_types', $data);
    }

    public function property_types() {
        $data['property_types'] = $this->Kigo_Model->get_property_types();
        $this->load->view('apartment_kigo/property_types', $data);
    }

    public function import_propertytypes_kigo() {
        $this->Kigo_Model->listKigoPropertyTypes();
    }

    public function import_feestypes_kigo() {
        $this->Kigo_Model->listKigoFeeTypes();
    }

    public function readProperty2() {
        $property_id = $this->input->post('property_id');
        $aResult = $this->Kigo_Model->readProperty2(trim(stripslashes($property_id)));
        $data['property_info'] = $aResult->API_REPLY;
        $sHtml = $this->load->view('apartment_kigo/view_property', $data, TRUE);
        echo json_encode(array('result' => $sHtml));
    }

    public function importPropertyPhotos() {
        $property_id = $this->input->post('property_id');

        foreach ($property_id as $mkey => $mvalue) {
            $property_local_id = $this->Kigo_Model->get_property_local_id($mvalue);
            $property_photos = $this->Kigo_Model->get_property_photos($property_local_id);
            $failure = array();

            if (!empty($property_photos)) {
                foreach ($property_photos as $key => $value) {
                    $aResponse = $this->Kigo_Model->readPropertyPhotoFile($mvalue, $value->PHOTO_KIGO_ID);
                    $aResult = $aResponse['api_response'];
                    if (!empty($aResult->API_REPLY)) {
                        $this->Kigo_Model->update_property_photo($value->PHOTO_ID, $aResult->API_REPLY);
                    } else {
                        $failure[] = $property_local_id;
                    }
                }
            }

            if (in_array($property_local_id, $failure)) {
                $this->Kigo_Model->update_propertyphoto_status($property_local_id, 0);
            } else {
                $this->Kigo_Model->update_propertyphoto_status($property_local_id, 1);

                $data_notification['MODULE_NAME'] = 'property_photos';
                $data_notification['REFERENCE_ID'] = $property_local_id;
                $data_notification['ACTION_STATUS'] = 2;
                $data_notification['KIGO_PUSH_STATUS'] = 2;
                $data_notification['KIGO_ACTION_STATUS'] = 1;
                $data_notification['API_REQUEST'] = $aResponse['api_request'];
                $data_notification['API_RESPONSE'] = json_encode($aResponse['api_response']);
                $data_notification['API_URL'] = $aResponse['api_url'];
                $this->Kigo_Model->insert_notification($data_notification);
            }
        }
    }

    public function importPropertyPricing() {
        $property_id = $this->input->post('property_id');

        foreach ($property_id as $mkey => $mvalue) {
            $property_local_id = $this->Kigo_Model->get_property_local_id($mvalue);
            $aResponse = $this->Kigo_Model->readPropertyPricingSetup($mvalue);

            $aResult = $aResponse['api_response'];
            $this->Kigo_Model->add_property_pricing($aResult->API_REPLY->PRICING->FEES, $property_local_id);
            $this->Kigo_Model->add_property_discount($aResult->API_REPLY->PRICING->DISCOUNTS, $property_local_id);
            $this->Kigo_Model->update_property_deposit($aResult->API_REPLY->PRICING->DEPOSIT, $property_local_id);
            $this->Kigo_Model->add_property_pricing_rent($aResult->API_REPLY->PRICING->RENT, $aResult->API_REPLY->PRICING->CURRENCY, $property_local_id);
            $this->Kigo_Model->update_propertyprice_status($property_local_id, 1);

            $data_notification['MODULE_NAME'] = 'property_pricing';
            $data_notification['REFERENCE_ID'] = $property_local_id;
            $data_notification['ACTION_STATUS'] = 2;
            $data_notification['KIGO_PUSH_STATUS'] = 2;
            $data_notification['KIGO_ACTION_STATUS'] = 1;
            $data_notification['API_REQUEST'] = $aResponse['api_request'];
            $data_notification['API_RESPONSE'] = json_encode($aResponse['api_response']);
            $data_notification['API_URL'] = $aResponse['api_url'];
            $this->Kigo_Model->insert_notification($data_notification);
        }
    }

    public function view_property_file($photo_id) {
        $image = $this->Kigo_Model->get_photo_by_photoid($photo_id);
        file_put_contents(IMAGE_UPLOAD_PATH . 'temp_image/image.jpg', base64_decode($image->PHOTO_CONTENT));

        header('Content-type: data:image/png;base64');
        echo file_get_contents(WEB_DIR . 'upload_files/temp_image/image.jpg');
    }

    public function edit_property($property_id) {
        $data['property_info'] = $this->Kigo_Model->get_property_by_id($property_id);
        $data['property_pricing_info'] = $this->Kigo_Model->get_property_pricing_by_id($property_id);
        $data['property_photos'] = $this->Kigo_Model->get_property_photos($property_id);
        $data['property_udpa'] = $this->Kigo_Model->get_property_udpa_by_id($property_id);
        $data['property_special_discounts'] = $this->Kigo_Model->get_property_special_discounts($property_id);
        $data['property_lastminute_discounts'] = $this->Kigo_Model->get_property_lastminute_discounts($property_id);
        $amenties = $this->Kigo_Model->get_amenities();

        $arraychunk = array();
        foreach ($amenties as $key => $value) {
            $arraychunk[$value->AMENITY_CATEGORY_LABEL][] = $value;
        }
        $data['amenties'] = $arraychunk;

        $activites = $this->Kigo_Model->get_activities();

        $arraychunk = array();
        foreach ($activites as $key => $value) {
            $arraychunk[$value->ACTIVITY_CATEGORY_LABEL][] = $value;
        }
        $data['activities'] = $arraychunk;

        $data['fees_types'] = $this->Kigo_Model->get_fees_types();
        $data['property_fees_types'] = $this->Kigo_Model->property_fees_types($property_id);
        $data['property_types'] = $this->Kigo_Model->get_property_types();
        $data['time_slot'] = $this->Kigo_Model->time_slot();
        $data['currency'] = $this->Kigo_Model->get_currency();
        $data['countries'] = $this->Kigo_Model->get_countries();
        $data['property_id'] = $property_id;
        $data['property_owners'] = $this->Kigo_Model->get_owners_list();
        $this->load->view('apartment_kigo/edit_property', $data);
    }

    public function update_property($property_id) {
        $this->Kigo_Model->update_property_step1($property_id, $_POST);
        $this->Kigo_Model->update_property_step2($property_id, $_POST);
        $this->Kigo_Model->update_property_step3($property_id, $_POST);
        $this->Kigo_Model->update_property_step4($property_id, $_POST);
        $this->Kigo_Model->update_property_step5($property_id, $_POST);
        $this->Kigo_Model->update_property_step6($property_id, $_POST);

        $data_notification['MODULE_NAME'] = 'property';
        $data_notification['REFERENCE_ID'] = $property_id;
        $data_notification['ACTION_STATUS'] = 1;
        $data_notification['KIGO_PUSH_STATUS'] = 0;
        $data_notification['KIGO_ACTION_STATUS'] = 0;
        $this->Kigo_Model->insert_notification($data_notification);
        
        redirect('apartment_kigo/list_properties');
    }

    public function get_property_bed_types() {
        $prop_id = $this->input->post('prop_id');
        $bed_type = $this->input->post('bed_type');
        $property_bed_types = $this->Kigo_Model->get_property_pdtp();

        $property_details = $this->Kigo_Model->get_property_by_id($prop_id);
        $sHtml = "";

        if (!empty($bed_type)) {
            $p_bed_types = explode(',', $property_details->PROP_BED_TYPES);

            for ($i = 1; $i
		<= $bed_type; $i++) {
                $sHtml .= "<div style='float: left;margin-top: 20px;margin-left: 10px;width: 5%;'>" . $i . "</div>";
                $sHtml .= "<select style='margin-top: 13px;width: 50%;' name='prop_beds_types[]' class='select2 form-control'>";
                if (!empty($property_bed_types)) {
                    foreach ($property_bed_types as $key => $value) {
                        if (isset($p_bed_types[$i - 1])) {
                            if ($value->BED_TYPE_ID == $p_bed_types[$i - 1]) {
                                $selected = "selected=selected";
                            } else {
                                $selected = "";
                            }
                        } else {
                            $selected = "";
                        }

                        $sHtml .= "<option value='" . $value->BED_TYPE_ID . "' " . $selected . ">" . $value->BED_TYPE_LABEL . "</option>";
                    }
                }
                $sHtml .= "</select>";
            }
        }
        echo json_encode(array('result' => $sHtml));
        exit;
    }

    public function get_max_abc_info() {
        $value = $this->input->post('value');

        $adult_html = '<select id="validation_max_adults" data-rule-required="true" name="max_adults" class="select2 form-control">';
        $child_html = '<select id="validation_max_child" data-rule-required="true" name="max_child" class="select2 form-control">';
        $baby_html = '<select id="validation_max_babies" data-rule-required="true" name="max_babies" class="select2 form-control">';

        if (!empty($value)) {
            for ($i = 0; $i<= $value; $i++) {$adult_html .= "<option selected='selected' value='" . $i . "'>" . $i . "</option>";
            }
            for ($j = 0; $j< $value; $j++) {$child_html .= "<option selected='selected' value='" . $j . "'>" . $j . "</option>";
            }
            for ($k = 0; $k< $value; $k++) {$baby_html .= "<option selected='selected' value='" . $k . "'>" . $k . "</option>";
            }
        }

        $adult_html .= "</select>";
        $child_html .= "</select>";
        $baby_html .= "</select>";

        echo json_encode(array('adult_result' => $adult_html, 'child_html' => $child_html, 'baby_html' => $baby_html));
        exit;
    }

    public function get_min_stay_value() {
        $value = $this->input->post('value');
        $select_id = $this->input->post('select_id');

        $sHtml = '
		<div class="controls"><select id="' . $select_id . '" data-rule-required="true" name="min_stay_value" class="select2 form-control custom_class">';

        if (!empty($value)) {
            if ($value == "NIGHT") {
                $unit_value = 27;
            } elseif ($value == "MONTH") {
                $unit_value = 12;
            } elseif ($value == "YEAR") {
                $unit_value = 5;
            }

            for ($i = 1; $i<= $unit_value; $i++) {$sHtml .= "<option value='" . $i . "'>" . $i . "</option>";
            }
        }
        $sHtml .= "</select></div>";

        echo json_encode(array('result' => $sHtml));
        exit;
    }

    public function get_price_min_stay_value() {
        $value = $this->input->post('value');
        $select_id = $this->input->post('select_id');

        $sHtml = '<select id="' . $select_id . '" data-rule-required="true" name="price_min_stay_value[]" class="select2 form-control custom_class">';

        if (!empty($value)) {
            if ($value == "NIGHT") {
                $unit_value = 27;
            } elseif ($value == "MONTH") {
                $unit_value = 12;
            } elseif ($value == "YEAR") {
                $unit_value = 5;
            }

            for ($i = 1; $i<= $unit_value; $i++) {$sHtml .= "<option value='" . $i . "'>" . $i . "</option>";
            }
        }
        $sHtml .= "</select>";

        echo json_encode(array('result' => $sHtml));
        exit;
    }

    public function get_period_range_value() {
        $value = $this->input->post('value');

        $sHtml = '<select id="period_range_unit" data-rule-required="true" name="period_range_unit" class="select2 form-control">';

        if (!empty($value)) {
            if ($value == "NIGHT") {
                $unit_value = 27;
            } elseif ($value == "MONTH") {
                $unit_value = 12;
            } elseif ($value == "YEAR") {
                $unit_value = 5;
            }

            for ($i = 1; $i<= $unit_value; $i++) {$sHtml .= "<option value='" . $i . "'>" . $i . "</option>";
            }
        }
        $sHtml .= "</select>";

        echo json_encode(array('result' => $sHtml));
        exit;
    }

    public function get_max_stay_value() {
        $value = $this->input->post('value');

        $sHtml = '<div class="controls"><select id="validation_max_stay" data-rule-required="true" name="max_stay_value" class="select2 form-control">';

        if (!empty($value)) {
            if ($value == "NIGHT") {
                $unit_value = 27;
            } elseif ($value == "MONTH") {
                $unit_value = 12;
            } elseif ($value == "YEAR") {
                $unit_value = 5;
            }

            for ($i = 1; $i<= $unit_value; $i++) {$sHtml .= "<option value='" . $i . "'>" . $i . "</option>";
            }
        }
        $sHtml .= "</select></div>";

        echo json_encode(array('result' => $sHtml));
        exit;
    }

    public function get_lmd() {
        $value = $this->input->post('value');

        $sHtml = '<script src="' . base_url() . 'assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
		<script src="' . base_url() . 'assets/javascripts/theme.js" type="text/javascript"></script>
		<script src="' . base_url() . 'assets/javascripts/plugins/common/moment.min.js" type="text/javascript"></script>
		<script src="' . base_url() . 'assets/javascripts/plugins/select2/select2.js" type="text/javascript"></script>
		<link href=""' . base_url() . 'assets/stylesheets/plugins/select2/select2.css" media="all" rel="stylesheet" type="text/css" />';

        $sHtml .= '<div id="lmd_' . $value . '">';
        $sHtml .= '<p style="float: left;font-size: 14px;font-weight: bold;padding-right: 11px;">If reservation created</p>';
        $sHtml .= '<select data-rule-required="true" name="lastminute_discounts_days[]" class="select2 form-control" style="float: left;margin-right: 10px;margin-top: -7px;width: 100px;">';

        for ($i = 1; $i<= 99; $i++) {$sHtml .= '<option value="' . $i . '">' . $i . '</option>';
    }

        $sHtml .= '</select>';
        $sHtml .= '<p style="float: left;font-size: 14px;font-weight: bold;padding-right: 11px;">days or more before check-in</p>';
        $sHtml .= '<input class="form-control" type="text" data-rule-required="true" style="float: left;margin-right: 10px;margin-top: -7px;width: 55px;" name="lastminute_discounts[]" class="form-control" placeholder="Discount in %">';
        $sHtml .= '<p style="float: left;font-size: 14px;font-weight: bold;padding-right: 11px;">% Discount is provided</p>';
        $sHtml .= '<a class="btn btn-danger btn-xs has-tooltip" data-placement="top" title="Delete Discount" onclick="delete_lmd(' . $value . ')" href="javascript:void(0)"> <i class="icon-remove"></i></a>';
        $sHtml .= '<div style="clear: both;"></div>';

        echo json_encode(array('result' => $sHtml));
        exit;
    }

    function get_spd() {
        $value = $this->input->post('value');

        $sHtml = '<script src="' . base_url() . 'assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
			<script src="' . base_url() . 'assets/javascripts/theme.js" type="text/javascript"></script>
			<script src="' . base_url() . 'assets/javascripts/plugins/common/moment.min.js" type="text/javascript"></script>
			<script src="' . base_url() . 'assets/javascripts/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.js" type="text/javascript"></script>
			<script src="' . base_url() . 'assets/javascripts/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.js" type="text/javascript"></script>
			';

        $sHtml .= '<div id="spd_' . $value . '">';
        $sHtml .= '<label class="control-label" style="float: left;padding-right: 6px;padding-top: 6px;">Check-in</label>';
        $sHtml .= '<div class="datepicker-input input-group" style="float: left;padding-right: 6px;"><input data-rule-required="true" class="form-control" name="psd_checkin[]" data-format="YYYY-MM-DD" placeholder="Check-in" type="text" style="width: 155px;"><span class="input-group-addon" style="float: right;padding: 9px;width: 40px;"><span data-date-icon="icon-calendar" data-time-icon="icon-time"></span></span></div>';
        $sHtml .= '<label class="control-label" style="float: left;padding-right: 6px;padding-top: 6px;">Check-out</label>
				<div class="datepicker-input input-group" style="float: left;padding-right: 6px;">
					<input class="form-control" data-rule-required="true" name="psd_checkout[]" data-format="YYYY-MM-DD" placeholder="Check-out" type="text" style="width: 155px;">
					<span class="input-group-addon" style="float: right;padding: 9px;width: 40px;">
						<span data-date-icon="icon-calendar" data-time-icon="icon-time"></span>
					</span>
				</div>';
        $sHtml .= '<label class="control-label" style="float: left;padding-right: 6px;padding-top: 6px;">Valid From</label>
				<div class="datepicker-input input-group" style="float: left;padding-right: 6px;">
					<input name="psd_validfrom[]" data-rule-required="true" class="form-control" data-format="YYYY-MM-DD" placeholder="Valid from" type="text" style="width: 155px;">
					<span class="input-group-addon" style="float: right;padding: 9px;width: 40px;">
						<span data-date-icon="icon-calendar" data-time-icon="icon-time"></span>
					</span>
				</div>';
        $sHtml .= '<label class="control-label" style="float: left;padding-right: 11px;padding-top: 6px;">Valid To</label>
				<div class="datepicker-input input-group" style="float: left;padding-right: 6px;">
					<input name="psd_validto[]" data-rule-required="true" class="form-control" data-format="YYYY-MM-DD" placeholder="Valid To" type="text" style="width: 155px;">
					<span class="input-group-addon" style="float: right;padding: 9px;width: 40px;">
						<span data-date-icon="icon-calendar" data-time-icon="icon-time"></span>
					</span>
				</div>';
        $sHtml .= '<label class="control-label" style="float: left;padding-right: 39px;padding-top: 6px;">Name</label>
				<div class="input-group" style="float: left;padding-right: 6px;">
					<input name="psd_discount_name[]" class="form-control"  data-rule-required="true" placeholder="Discount Name" type="text" style="width: 195px;"></div>';
        $sHtml .= '<label class="control-label" style="float: left;padding-right: 1px;padding-top: 6px;">Discount %</label>
				<div class="input-group" style="float: left;padding-right: 6px;">
					<input name="psd_discount_per[]" class="form-control" data-rule-required="true" placeholder="Discount %" type="text" style="width: 155px;"></div>';
        $sHtml .= '
				<a class="btn btn-danger btn-xs has-tooltip" data-placement="top" title="Delete Discount" onclick="delete_spd(' . $value . ')" href="javascript:void(0)"> <i class="icon-remove"></i>
				</a>
				';
        $sHtml .= '<div style="clear: both; padding-bottom: 20px;"></div>';
        $sHtml .= '</div>';

        echo json_encode(array('result' => $sHtml));
        exit;
    }

    function convertImage($originalImage, $outputImage, $quality)
    {
        // jpg, png, gif or bmp?
        $exploded = explode('.',$originalImage);
        $ext = $exploded[count($exploded) - 1]; 

        if (preg_match('/jpg|jpeg/i',$ext))
            $imageTmp=imagecreatefromjpeg($originalImage);
        else if (preg_match('/png/i',$ext))
            $imageTmp=imagecreatefrompng($originalImage);
        else if (preg_match('/gif/i',$ext))
            $imageTmp=imagecreatefromgif($originalImage);
        else if (preg_match('/bmp/i',$ext))
            $imageTmp=imagecreatefrombmp($originalImage);
        else
            return 0;

        // quality is a value from 0 (worst) to 100 (best)
        imagejpeg($imageTmp, $outputImage, $quality);
        imagedestroy($imageTmp);

        return 1;
    }

    public function upload_property_photo() {
        $ext = end(explode('/', $_FILES["myfile"]["type"]));
        $tmp_name = $_FILES["myfile"]["tmp_name"];
        $unique_id = uniqid();
        $name = $unique_id . '.' . $ext;
        $uploads_dir = "";
        move_uploaded_file($tmp_name, IMAGE_UPLOAD_PATH . 'apartment/' . $name);

        $name2 = $unique_id . '.jpg';
        $image_jpeg = $this->convertImage(IMAGE_UPLOAD_PATH . 'apartment/' . $name,IMAGE_UPLOAD_PATH . 'apartment/temp_images/' . $name2,100);
        
        $image_link = base_url() . 'upload_files/apartment/temp_images/' . $name2;
        $base64_image = base64_encode(file_get_contents($image_link));        
        $unique_photo_id = uniqid();

        $sHtml = '
			<div style="padding-top: 20px;clear:both;" id="' . $unique_id . '">
				';
        $sHtml .= '<div style="border: 1px solid #ccc;padding: 20px;min-height: 180px;" class="col-sm-3">
					<img src="' . $image_link . '"  width="200" height="100" style="clear: both;float: left;"/>
					<input type="hidden" name="image[' . $unique_photo_id . '][]"  value="' . $base64_image . '"/>
					<input type="checkbox" name="panaromic_view[' . $unique_photo_id . '][]" style="clear: both;float: left;"/>
					<label class="control-label" style="float: left; padding-left: 6px;">Panoramic view</label>
				</div>';
        $sHtml .= '<div style="border: 1px solid #ccc;padding: 20px 20px;min-height: 180px;margin-left:20px;" class="col-sm-4">
					<label class="control-label" style="float: left; padding-left: 6px;">Name</label>
					<input type="text" name="name[' . $unique_photo_id . '][]" placeholder="Name" class="form-control"/>
				</div>';
        $sHtml .= '<div style="border: 1px solid #ccc;padding: 20px 20px;min-height: 180px;margin-left:20px;" class="col-sm-4">
					<label class="control-label" style="float: left; padding-left: 6px;">Comment</label>
					<textarea  name="comment[' . $unique_photo_id . '][]" placeholder="Comment" id="validation_comment" class="form-control" style="margin-top: 10px;"></textarea>
				</div>';
        $sHtml .= '<a class="btn btn-danger btn-xs has-tooltip" data-placement="top" title="Delete Photo" onclick="delete_photo(\'' . $unique_id . '\')" href="javascript:void(0)">
					<i class="icon-remove"></i>
				</a>';
        $sHtml .= '</div>';
        echo $sHtml;
        exit;
    }

    function get_property_perguest() {
        $perguest_type = $this->input->post('perguest_type');
        $perguest_standard_occupancy = $this->input->post('perguest_standard_occupancy');
        if (empty($perguest_standard_occupancy)) {
            $perguest_standard_occupancy = 1;
        }
        $perguest_max_occupancy = $this->input->post('perguest_max_occupancy');
        if (empty($perguest_max_occupancy)) {
            $perguest_max_occupancy = $perguest_max_occupancy + 1;
        }
        $perguest_type_options = array('ADULTS' => 'Adults', 'ADULTS_CHILDREN' => 'Adults + Children', 'ADULTS_CHILDREN_BABIES' => 'Adults + Children + Babies');

        $sHmtl = '<div style="margin-left:150px;">';
        $sHmtl .= '<h3>Per Guest Charge Settings</h3><div style="clear:both;"></div>';
        $sHmtl .= '<label class="control-label">Applies to</label>';
        $sHmtl .= '<select name="perguest_sel_type" id="perguest_sel_type" class="select2 form-control" style="width: 50%;">';
        foreach ($perguest_type_options as $key => $value) {
            if ($key == $perguest_type) {
                $selected = "selected=selected";
            } else {
                $selected = "";
            }
            $sHmtl .= '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
        }
        $sHmtl .= '</select><div style="clear:both;"></div>';

        $sHmtl .= '<label class="control-label" >Standard occupancy</label>';
        $sHmtl .= '<select onclick="change_max_occupancy(this.value)" style="width: 50%;" name="perguest_sel_standard_occupancy" class="select2 form-control" id="perguest_sel_standard_occupancy">';
        for ($i = 1; $i<= 29; $i++) {
            if ($perguest_standard_occupancy == $i) {
                $selected = "selected=selected";
            } else {
                $selected = "";
            }
            $sHmtl .= '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
        }
        $sHmtl .= '</select><div style="clear:both;"></div>';

        $sHmtl .= '<label class="control-label">Max. occupancy</label>';
        $sHmtl .= '<div id="max_occu_dyn">';
        $sHmtl .= '<select style="width: 50%;" name="perguest_sel_max_occupancy" id="perguest_sel_max_occupancy" class="select2 form-control">';
        for ($i = $perguest_standard_occupancy + 1; $i<= 30; $i++) {
            if ($perguest_max_occupancy == $i) {
                $selected = "selected=selected";
            } else {
                $selected = "";
            }
            $sHmtl .= '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>
						';
        }
        $sHmtl .= '</select></div><div style="clear:both;padding-bottom:15px;"></div>';
        $sHmtl .= '<button onclick="change_property_pgc()" type="button" class="btn btn-primary"><i class="icon-save"></i>Save</button>';
        $sHmtl .= '</div>';

        echo json_encode(array('result' => $sHmtl));
        exit;
    }

    function get_changed_property_now_epc($period_range_count = '', $enable_now = '', $perguest_standard_occupancy = '', $perguest_max_occupancy = '', $enable_pgc = '', $period_range_json_value = '', $period_total_count = '', $period_id_value = '') {
        $return = 0;
        if ($period_range_count !== "") {
            $return = 1;
        }

        if ($period_range_count === "") {
            $period_range_count = $this->input->post('period_range_count');
        }

        if ($enable_now === "") {
            $enable_now = $this->input->post('enable_now');
        }

        if ($perguest_standard_occupancy === "") {
            $perguest_standard_occupancy = $this->input->post('perguest_standard_occupancy');
        }

        if ($perguest_max_occupancy === "") {
            $perguest_max_occupancy = $this->input->post('perguest_max_occupancy');
        }

        if ($enable_pgc === "") {
            $enable_pgc = $this->input->post('enable_pgc');
        }

        if ($period_range_json_value === "") {
            $period_range_json_value = $this->input->post('period_range_json_value');
        }

        if ($period_total_count === "") {
            $period_total_count = (int) trim(stripslashes($this->input->post('period_total_count')));
        }

        $temp_new = array();
        if (isset($period_range_json_value['NIGHT']) && !empty($period_range_json_value['NIGHT'])) {
            foreach ($period_range_json_value['NIGHT'] as $key => $value) {
                $temp_new[] = $key . '-N';
            }
        }

        if (isset($period_range_json_value['MONTH']) && !empty($period_range_json_value['MONTH'])) {
            foreach ($period_range_json_value['MONTH'] as $key => $value) {
                $temp_new[] = $key . '-M';
            }
        }

        if (isset($period_range_json_value['YEAR']) && !empty($period_range_json_value['YEAR'])) {
            foreach ($period_range_json_value['YEAR'] as $key => $value) {
                $temp_new[] = $key . '-Y';
            }
        }

        if ($enable_now == 1) {
            if ($enable_pgc == 1) {
                $sHtml = array();
                $uniqid = uniqid();
                for ($kk = 0; $kk
			<= $period_total_count; $kk++) {
                    $ttt = $kk + 1;
                    $week_days = array('1' =>
				'Mon', '2' => 'Tue', '3' => 'Wed', '4' => 'Thur', '5' => 'Fri', '6' => 'Sat', '7' => 'Sun');
                    $sHtml1 = "";
                    $sHtml1 .= '<tr class="night_after_append">';
                    $sHtml1 .= '<td>';
                    foreach ($week_days as $wk => $wv) {
                        if (!empty($period_id_value)) {
                            $sHtml1 .= '<input type="checkbox" data-id="' . $uniqid . '" value="' . $wk . '" class="kon_' . $period_id_value . '_1" onclick="change_now_selction(' . $period_id_value . ',1,' . $wk . ',this);" />' . $wv;
                        } else {
                            $sHtml1 .= '<input type="checkbox" data-id="' . $uniqid . '" value="' . $wk . '" class="kon_' . $kk . '_1"  onclick="change_now_selction(' . $kk . ',1,' . $wk . ',this);"  />' . $wv;
                        }
                    }
                    $sHtml1 .= '</td>';
                    $sHtml1 .= '<td></td>';

                    for ($j = 0; $j< $period_range_count; $j++) {
                    $sHtml1 .= '<td></td>';
                    }
                    $sHtml1 .= '</tr>';


                    for ($i = $perguest_standard_occupancy; $i<= $perguest_max_occupancy; $i++) {
                        $sHtml1 .= '<tr class="dyna_night_pricing">';
                        $sHtml1 .= '<td></td>';
                        if ($i == $perguest_standard_occupancy) {
                            $sHtml1 .= '<td>' . $i . ' and less than ' . $i . ' guests</td>';
                        } elseif ($i == $perguest_max_occupancy) {
                            $sHtml1 .= '<td>' . $i . ' + guests</td>';
                        } else {
                            $sHtml1 .= '<td>' . $i . '</td>';
                        }

                        for ($j = 0; $j
					< $period_range_count; $j++) {
                            $temp = explode('-', $temp_new[$j]);
                            if ($temp[1] == 'N') {
                                $placeholder = "NIGHT";
                            } elseif ($temp[1] == 'M') {
                                $placeholder = "MONTH";
                            } elseif ($temp[1] == 'Y') {
                                $placeholder = "YEAR";
                            }

                            if (!empty($period_id_value)) {
                                $sHtml1 .= '<td><input type="text" class="form-control nightly_amount_' . $period_id_value . '_1" name="nightly_amount[' . $period_id_value . '][1,2,3,4,5,6,7][' . $i . '][' . $temp[0] . '][' . $placeholder . ']"></td>';
                            } else {
                                $sHtml1 .= '<td><input type="text" class="form-control nightly_amount_' . $kk . '_1" name="nightly_amount[' . $kk . '][1,2,3,4,5,6,7][' . $i . '][' . $temp[0] . '][' . $placeholder . ']"></td>';
                            }
                        }
                        $sHtml1 .= '</tr>';
                    }
                    $sHtml[] = $sHtml1;
                }
            } else {
                $sHtml = array();
                $uniqid = uniqid();
                for ($kk = 0; $kk
				<= $period_total_count; $kk++) {
                    $ttt = $kk + 1;
                    $week_days = array('1' =>
					'Mon', '2' => 'Tue', '3' => 'Wed', '4' => 'Thur', '5' => 'Fri', '6' => 'Sat', '7' => 'Sun');
                    $sHtml1 = "";
                    $sHtml1 .= '<tr class="night_after_append">';
                    $sHtml1 .= '<td>';
                    foreach ($week_days as $wk => $wv) {
                        if (!empty($period_id_value)) {
                            $sHtml1 .= '
							<input type="checkbox" value="' . $wk . '" data-id="' . $uniqid . '" class="kon_' . $period_id_value . '_1" onclick="change_now_selction(' . $period_id_value . ',1,' . $wk . ',this);"/>' . $wv;
                        } else {
                            $sHtml1 .= '<input type="checkbox" value="' . $wk . '" data-id="' . $uniqid . '" class="kon_' . $kk . '_1" onclick="change_now_selction(' . $kk . ',1,' . $wk . ',this);"/>' . $wv;
                        }
                    }
                    $sHtml1 .= '</td>';
                    $sHtml1 .= '<td></td>';

                    for ($j = 0; $j
						< $period_range_count; $j++) {

                        $temp = explode('-', $temp_new[$j]);
                        if ($temp[1] == 'N') {
                            $placeholder = "NIGHT";
                        } elseif ($temp[1] == 'M') {
                            $placeholder = "MONTH";
                        } elseif ($temp[1] == 'Y') {
                            $placeholder = "YEAR";
                        }

                        if (!empty($period_id_value)) {
                            $sHtml1 .= '<td><input type="text" class="form-control nightly_amount_' . $period_id_value . '_1" name="nightly_amount[' . $period_id_value . '][1,2,3,4,5,6,7][1][' . $temp[0] . '][' . $placeholder . ']"></td>
						';
                        } else {
                            $sHtml1 .= '<td><input type="text" class="form-control nightly_amount_' . $kk . '_1" name="nightly_amount[' . $kk . '][1,2,3,4,5,6,7][1][' . $temp[0] . '][' . $placeholder . ']"></td>';
                        }
                    }

                    $sHtml1 .= '
					</tr>
					';
                    $sHtml[] = $sHtml1;
                }
            }
        } else {
            if ($enable_pgc == 1) {
                $sHtml = array();

                for ($kk = 0; $kk
					<= $period_total_count; $kk++) {
                    $sHtml1 = "";
                    for ($i = $perguest_standard_occupancy; $i <= $perguest_max_occupancy; $i++) {
                        $sHtml1 .= '<tr class="dyna_night_pricing">
						';
                        $sHtml1 .= '
						<td></td>
						';
                        if ($i == $perguest_standard_occupancy) {
                            $sHtml1 .= '
						<td>' . $i . ' and less than ' . $i . ' guests</td>
						';
                        } elseif ($i == $perguest_max_occupancy) {
                            $sHtml1 .= '
						<td>' . $i . ' + guests</td>
						';
                        } else {
                            $sHtml1 .= '
						<td>' . $i . '</td>
						';
                        }

                        for ($j = 0; $j
						< $period_range_count; $j++) {
                            $temp = explode('-', $temp_new[$j]);
                            if ($temp[1] == 'N') {
                                $placeholder = "NIGHT";
                            } elseif ($temp[1] == 'M') {
                                $placeholder = "MONTH";
                            } elseif ($temp[1] == 'Y') {
                                $placeholder = "YEAR";
                            }

                            if (!empty($period_id_value)) {
                                $sHtml1 .= '<td><input type="text" class="form-control" name="nightly_amount[' . $period_id_value . '][1,2,3,4,5,6,7][' . $i . '][' . $temp[0] . '][' . $placeholder . ']"></td>';
                            } else {
                                $sHtml1 .= '<td><input type="text" class="form-control" name="nightly_amount[' . $kk . '][1,2,3,4,5,6,7][' . $i . '][' . $temp[0] . '][' . $placeholder . ']"></td>';
                            }
                        }
                        $sHtml1 .= '
					</tr>
					';
                    }
                    $sHtml[] = $sHtml1;
                }
            } else {
                $sHtml = array();

                for ($kk = 0; $kk
					<= $period_total_count; $kk++) {
                    $sHtml1 = "";
                    $sHtml1 .= '<tr class="dyna_night_pricing">';
                    $sHtml1 .= '<td></td>';
                    $sHtml1 .= '<td></td>';
                    for ($j = 0; $j
						< $period_range_count; $j++) {

                        $temp = explode('-', $temp_new[$j]);
                        if ($temp[1] == 'N') {
                            $placeholder = "NIGHT";
                        } elseif ($temp[1] == 'M') {
                            $placeholder = "MONTH";
                        } elseif ($temp[1] == 'Y') {
                            $placeholder = "YEAR";
                        }
                        if (!empty($period_id_value)) {
                            $sHtml1 .= '<td><input type="text" class="form-control" name="nightly_amount[' . $period_id_value . '][1,2,3,4,5,6,7][1][' . $temp[0] . '][' . $placeholder . ']"></td>';
                        } else {
                            $sHtml1 .= '<td><input type="text" class="form-control" name="nightly_amount[' . $kk . '][1,2,3,4,5,6,7][1][' . $temp[0] . '][' . $placeholder . ']"></td>';
                        }
                    }
                    $sHtml1 .= '</tr>';
                    $sHtml[] = $sHtml1;
                }
            }
        }

        if ($return == 1) {
            return $sHtml;
        } else {
            echo json_encode(array('result' => $sHtml));
            exit;
        }
    }

    function add_new_now() {
        $period_range_count = $this->input->post('period_range_count');
        $enable_now = $this->input->post('enable_now');
        $perguest_standard_occupancy = $this->input->post('perguest_standard_occupancy');
        $perguest_max_occupancy = $this->input->post('perguest_max_occupancy');
        $enable_pgc = $this->input->post('enable_pgc');
        $period_total_count = $this->input->post('period_total_count');
        $period_range_json_value = $this->input->post('period_range_json_value');
        $now_count = $this->input->post('now_count');
        $id = $this->input->post('id');
        $now_count++;

        $temp_new = array();
        if (isset($period_range_json_value['NIGHT']) && !empty($period_range_json_value['NIGHT'])) {
            foreach ($period_range_json_value['NIGHT'] as $key => $value) {
                $temp_new[] = $key . '-N';
            }
        }

        if (isset($period_range_json_value['MONTH']) && !empty($period_range_json_value['MONTH'])) {
            foreach ($period_range_json_value['MONTH'] as $key => $value) {
                $temp_new[] = $key . '-M';
            }
        }

        if (isset($period_range_json_value['YEAR']) && !empty($period_range_json_value['YEAR'])) {
            foreach ($period_range_json_value['YEAR'] as $key => $value) {
                $temp_new[] = $key . '-Y';
            }
        }

        if ($enable_pgc == 1) {
            $week_days = array('1' => 'Mon', '2' => 'Tue', '3' => 'Wed', '4' => 'Thur', '5' => 'Fri', '6' => 'Sat', '7' => 'Sun');
            $uniqid = uniqid();

            $sHtml = '<tr class="night_after_append ' . $uniqid . '">';
            $sHtml .= '<td>';
            foreach ($week_days as $wk => $wv) {
                $sHtml .= '<input type="checkbox" value="' . $wk . '" data-id="' . $uniqid . '" class="kon_' . $period_total_count . '_' . $now_count . '" onclick="change_now_selction(' . $period_total_count . ',' . $now_count . ',' . $wk . ',this);"/>' . $wv;
            }
            $sHtml .= '</td>';
            $sHtml .= '<td></td>';
            for ($j = 0; $j< $period_range_count; $j++) {$sHtml .= '<td></td>';
            }
            $sHtml .= '</tr>';

            for ($i = $perguest_standard_occupancy; $i
					<= $perguest_max_occupancy; $i++) {
                $sHtml .= '<tr class="dyna_night_pricing ' . $uniqid . '" >';
                $sHtml .= '<td></td>';
                if ($i == $perguest_standard_occupancy) {
                    $sHtml .= '<td>' . $i . ' and less than ' . $i . ' guests</td>';
                } elseif ($i == $perguest_max_occupancy) {
                    $sHtml .= '<td>' . $i . ' + guests</td>';
                } else {
                    $sHtml .= '<td>' . $i . '</td>';
                }

                for ($j = 0; $j
						< $period_range_count; $j++) {
                    $temp = explode('-', $temp_new[$j]);
                    if ($temp[1] == 'N') {
                        $placeholder = "NIGHT";
                    } elseif ($temp[1] == 'M') {
                        $placeholder = "MONTH";
                    } elseif ($temp[1] == 'Y') {
                        $placeholder = "YEAR";
                    }
                    $sHtml .= '<td><input type="text" class="form-control nightly_amount_' . $period_total_count . '_' . $now_count . '" name="nightly_amount[' . $period_total_count . '][1,2,3,4,5,6,7][' . $i . '][' . $temp[0] . '][' . $placeholder . ']"></td>';
                }
                $sHtml .= '</tr>';
            }
            $sHtml .= '<tr class="' . $uniqid . '"><td><a href="javascript:void(0);" onclick="delete_now(\'' . $uniqid . '\',\'' . $now_count . '\',\'' . $id . '\')">Delete Week Group</a><td></tr>';

            echo json_encode(array('result' => $sHtml));
            exit;
        } else {
            $uniqid = uniqid();
            $week_days = array('1' => 'Mon', '2' => 'Tue', '3' => 'Wed', '4' => 'Thur', '5' => 'Fri', '6' => 'Sat', '7' => 'Sun');
            $sHtml = "";
            $sHtml .= '<tr class="night_after_append ' . $uniqid . '" >';
            $sHtml .= '<td>';
            foreach ($week_days as $wk => $wv) {
                $sHtml .= '<input type="checkbox" data-id="' . $uniqid . '" value="' . $wk . '" class="kon_' . $period_total_count . '_' . $now_count . '" onclick="change_now_selction(' . $period_total_count . ',' . $now_count . ',' . $wk . ',this);"/>' . $wv;
            }
            $sHtml .= '</td>';
            $sHtml .= '<td></td>';
            for ($j = 0; $j< $period_range_count; $j++) {
                $temp = explode('-', $temp_new[$j]);
                if ($temp[1] == 'N') {
                    $placeholder = "NIGHT";
                } elseif ($temp[1] == 'M') {
                    $placeholder = "MONTH";
                } elseif ($temp[1] == 'Y') {
                    $placeholder = "YEAR";
                }

                $sHtml .= '<td><input type="text" class="form-control nightly_amount_' . $period_total_count . '_' . $now_count . '" name="nightly_amount[' . $period_total_count . '][1,2,3,4,5,6,7][1][' . $temp[0] . '][' . $placeholder . ']"></td>';
            }
            $sHtml .= '</tr>';
            $sHtml .= '<tr class="' . $uniqid . '"><td><a href="javascript:void(0);" onclick="delete_now(\'' . $uniqid . '\',\'' . $now_count . '\',\'' . $id . '\')">Delete Week Group</a><td></tr>';
            echo json_encode(array('result' => $sHtml));
            exit;
        }
    }

    function add_new_period() {
        $period_range_count = $this->input->post('period_range_count');
        $enable_now = $this->input->post('enable_now');
        $perguest_standard_occupancy = $this->input->post('perguest_standard_occupancy');
        $perguest_max_occupancy = $this->input->post('perguest_max_occupancy');
        $enable_pgc = $this->input->post('enable_pgc');
        $period_range_value = explode(',', $this->input->post('period_range_value'));
        $period_total_count = $this->input->post('period_total_count');
        $period_range_json_value = $this->input->post('period_range_json_value');

        $period_total_count++;

        $sHTml1 = '<script src="' . base_url() . 'assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script><script src="' . base_url() . 'assets/javascripts/theme.js" type="text/javascript"></script><script src="' . base_url() . 'assets/javascripts/plugins/common/moment.min.js" type="text/javascript"></script><script src="' . base_url() . 'assets/javascripts/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.js" type="text/javascript"></script><script src="' . base_url() . 'assets/javascripts/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.js" type="text/javascript"></script>';

        $sHTml1 .= '<div style="border: 1px solid #CCCCCC;clear: both; margin-bottom: 30px;padding: 20px;" id="main_container_content_' . $period_total_count . '">';
        $sHTml1 .= '<div>';
        $sHTml1 .= '<div style="clear: both;margin-top: 10px;" class="col-sm-3 marginbtm"><label class="control-label" for="validation_name">Check-in:</label><br><div style="float: left;padding-right: 6px;" class="datepicker-input input-group"><input type="text" class="form-control" data-rule-required="true" name="price_check_in[]" placeholder="Check-in" data-format="YYYY-MM-DD"><span style="padding: 9px;width: 40px;" class="input-group-addon"><span data-time-icon="icon-time" data-date-icon="icon-calendar" class="icon-calendar"></span></span></div></div>';
        $sHTml1 .= '<div style="margin-top: 10px;" class="col-sm-3 marginbtm"><label class="control-label" for="validation_name">Check-out:</label><br><div style="float: left;padding-right: 6px;" class="datepicker-input input-group"><input type="text" class="form-control" data-rule-required="true" name="price_check_out[]" placeholder="Check-out" data-format="YYYY-MM-DD"><span style="padding: 9px;width: 40px;" class="input-group-addon"><span data-time-icon="icon-time" data-date-icon="icon-calendar" class="icon-calendar"></span></span></div></div>';
        $sHTml1 .= '<div style="margin-top: 10px;" class="col-sm-2 marginbtm"><label class="control-label" for="validation_name">Period name:</label><br><input type="text" class="form-control" data-rule-required="true" name="price_period_name[]" placeholder="Period Name"></div>';
        $sHTml1 .= '<div style="margin-top: 10px;" class="col-sm-2 marginbtm"><label class="control-label" for="validation_name">Minimum stay:</label><br><div id="price_min_stay_' . $period_total_count . '">';
        $sHTml1 .= '<select class="select2 form-control" id="validation_price_min_stay_' . $period_total_count . '" data-rule-required="true" name="price_min_stay_value[]" class="select2 form-control">';
        for ($i = 1; $i<= 27; $i++) {
            $sHTml1 .= '<option value="' . $i . '">' . $i . '</option>';
        }
        $sHTml1 .= '</select></div>';
        $sHTml1 .= '<select class="select2 form-control" onclick="get_min_price_stay_value(this.value,' . $period_total_count . ');"  name="price_min_stay_unit[]" data-rule-required="true" id="validation_price_min_stay_unit_' . $period_total_count . '" tabindex="-1"><option value="">Please select</option><option selected="selected" value="NIGHT">Night</option><option value="MONTH">Month</option><option value="YEAR">Year</option></select></div>';

        $sHTml1 .= '<div style="clear: both;float: left;"><label class="control-label">Weekly Rental</label><input type="checkbox"  name="weekly_rental_' . $period_total_count . '" class="weekly_rental" id="toggle_weekly_rental_' . $period_total_count . '" onclick="toggle_weekly_rental(\'' . $period_total_count . '\')" style="clear: both;float: left;margin-bottom: 13px;margin-right: 10px;margin-top: 10px;"/></div>';
        $sHTml1 .= '</div>';
        $sHTml1 .= '<div style="clear: both;"></div>';

        $response = $this->get_changed_property_now_epc($period_range_count, $enable_now, $perguest_standard_occupancy, $perguest_max_occupancy, $enable_pgc, $period_range_json_value, 0, $period_total_count);

        $sHTml1 .= '<div class="responsive-table">';
        $sHTml1 .= '<div class="scrollable-area">';
        $sHTml1 .= '<table id="property_pricing_display_' . $period_total_count . '" style="margin-bottom:0;" class="table table-bordered table-striped property_pricing_display">';
        $sHTml1 .= '<thead><tr><th>Night of week</th><th>For</th>';
        foreach ($period_range_value as $key => $value) {
            $sHTml1 .= '<th>' . $value . '</th>';
        }
        $sHTml1 .= '<th><a data-toggle="modal" href="#modal-example3">Add</a></th>';
        $sHTml1 .= '</tr></thead>';

        $sHTml1 .= '<tbody>' . implode("", $response) . '</tbody></table>';
        if ($enable_now == 1) {
            $sHTml1 .= '<table class="add_new_now"><thead></thead><tbody><tr><td><a onclick="add_new_now(1, this.id);" id="add_new_now_' . $period_total_count . '" class="add_new_now_class" href="javascript:void(0);">Add a new night-of-week group</a></td></tr></tbody></table>';
        }
        $sHTml1 .= '</div></div>';
        $sHTml1 .= '<a onclick="delete_period(\'main_container_content_' . $period_total_count . '\');" href="javascript:void(0)" style="clear: both;float: right;font-weight: bold;margin-bottom: 25px;margin-top: 40px;text-decoration: underline;width: 10%;">Delete Period</a>';

        echo json_encode(array('result' => $sHTml1));
        exit;
    }

    function add_new_night_period() {
        $period_range_count = $this->input->post('period_range_count');
        $enable_now = $this->input->post('enable_now');
        $perguest_standard_occupancy = $this->input->post('perguest_standard_occupancy');
        $perguest_max_occupancy = $this->input->post('perguest_max_occupancy');
        $enable_pgc = $this->input->post('enable_pgc');
        $period_range_value = explode(',', $this->input->post('period_range_value'));
        $period_total_count = $this->input->post('period_total_count');
        $period_range_json_value = $this->input->post('period_range_json_value');
        $period_total_count++;

        $response = $this->get_changed_property_now_epc($period_range_count, $enable_now, $perguest_standard_occupancy, $perguest_max_occupancy, $enable_pgc, $period_range_json_value, $period_total_count);

        $sHtml = array();
        foreach ($response as $mkey => $mvalue) {
            $sHTml1 = '';
            $sHTml1 .= '<thead><tr><th>Night of week</th><th>For</th>';
            foreach ($period_range_value as $key => $value) {
                $sHTml1 .= '<th>' . $value . '</th>';
            }
            $sHTml1 .= '<th><a data-toggle="modal" href="#modal-example3">Add</a></th>';
            $sHTml1 .= '</tr></thead>';
            $sHTml1 .= '<tbody>' . $mvalue . '</tbody>';
            $sHtml[] = $sHTml1;
        }

        echo json_encode(array('result' => $sHtml));
        exit;
    }

    function ed_week_rental() {

        $perguest_standard_occupancy = $this->input->post('perguest_standard_occupancy');
        $perguest_max_occupancy = $this->input->post('perguest_max_occupancy');
        $c_period_count = $this->input->post('c_period_count');

        $sHtml = '';

        if (!empty($perguest_standard_occupancy)) {
            for ($i = $perguest_standard_occupancy; $i<= $perguest_max_occupancy; $i++) {
                if ($i == $perguest_standard_occupancy) {
                    $sHtml .= '<tr><td></td><td><p style="float: left;width: 100%;">' . $i . ' and less than ' . $i . ' guests</p>';
                } elseif ($i == $perguest_max_occupancy) {
                    $sHtml .= '<tr><td></td><td><p style="float: left;width: 100%;">' . $i . ' + guests</p>';
                } else {
                    $sHtml .= '<tr><td></td><td><p style="float: left;width: 100%;">' . $i . '</p>';
                }

                $sHtml .= '<input type="text" name="weekly_amount[' . $c_period_count . '][' . $i . ']" style="width: 100%;"  class="form-control"></td></tr>';
            }
        } else {
            $sHtml .= '<tr><td></td><td>
                            <input type="text" name="weekly_amount[0][1]"  style="width: 100%;" name="" class="form-control"></td>  
                        </tr>';
        }
        echo json_encode(array('result' => $sHtml));
    }

    public function update_property_kigo() {
        $property_id = $this->input->post('property_id');
        $notification_id = $this->input->post('notification_id');
        for ($i = 0; $i< count($property_id); $i++) {
            $this->Kigo_Model->update_property_kigo($property_id[$i], $notification_id[$i]);
        }
    }

    public function add_property() {

        $amenties = $this->Kigo_Model->get_amenities();
		
        $arraychunk = array();
        foreach ($amenties as $key => $value) {
            $arraychunk[$value->AMENITY_CATEGORY_LABEL][] = $value;
        }
        $data['amenties'] = $arraychunk;

        $activites = $this->Kigo_Model->get_activities();

        $arraychunk = array();
        foreach ($activites as $key => $value) {
            $arraychunk[$value->ACTIVITY_CATEGORY_LABEL][] = $value;
        }
        $data['activities'] = $arraychunk;

        $data['fees_types'] = $this->Kigo_Model->get_fees_types();
        $data['property_types'] = $this->Kigo_Model->get_property_types();
        $data['time_slot'] = $this->Kigo_Model->time_slot();
        $data['currency'] = $this->Kigo_Model->get_currency();
        $data['countries'] = $this->Kigo_Model->get_countries();
        $data['property_udpa'] = $this->Kigo_Model->get_property_udpa();
        $data['fees_types'] = $this->Kigo_Model->get_fees_types();
        $data['property_owners'] = $this->Kigo_Model->get_owners_list();
        $this->load->view('apartment_kigo/add_property', $data);
    }

    public function get_add_property_bed_types() {
        $property_bed_types = $this->Kigo_Model->get_property_pdtp();

        $sHtml = "";
        $bed_type = $this->input->post('bed_type');

        for ($i = 1; $i<= $bed_type; $i++) {
            $sHtml .= '<div style="float: left;margin-top: 20px;margin-left: 10px;width: 5%;">' . $i . '</div>';
            $sHtml .= '<select style="margin-top: 13px;width: 50%;" name="prop_beds_types[]" class="select2 form-control">';
            foreach ($property_bed_types as $key => $value) {
                $sHtml .= '<option value="' . $value->BED_TYPE_ID . '">' . $value->BED_TYPE_LABEL . '</option>';
            }
            $sHtml .= '</select>';
        }
        echo json_encode(array('result' => $sHtml));
    }

    public function insert_property() {
		if(empty($_POST)){
			redirect('apartment_kigo/add_property/');
		}
        $property_id = $this->Kigo_Model->add_property_step1($_POST);
        $this->Kigo_Model->add_property_step2($property_id, $_POST);
        $this->Kigo_Model->add_property_step3($property_id, $_POST);
        $this->Kigo_Model->add_property_step4($property_id, $_POST);
        $this->Kigo_Model->add_property_step5($property_id, $_POST);        
        $this->Kigo_Model->add_property_step6($property_id, $_POST);
        
        $data_notification['MODULE_NAME'] = 'property';
        $data_notification['REFERENCE_ID'] = $property_id;
        $data_notification['ACTION_STATUS'] = 0;
        $data_notification['KIGO_PUSH_STATUS'] = 0;
        $data_notification['KIGO_ACTION_STATUS'] = 0;
        $this->Kigo_Model->insert_notification($data_notification);
        
        redirect('apartment_kigo/list_properties');
    }
	
    public function updateInstantBooking($id,$value){
	$status = array('PROP_INSTANT_BOOK'=>$value);
	$res = $this->Kigo_Model->updateInstantBooking($id, $status);
	if($res){
		$response = array('success'=>'Instant booking status updated','status'=>1);
	}else{
		$response = array('success'=>'Instant booking status not updated','status'=>0);
	}
	echo json_encode($response);
    }
	
    public function updatePropertyStatus($id,$value){
	$status = array('PROPERTY_STATUS'=>$value);
	$res = $this->Kigo_Model->updatePropertyStatus($id, $status);
	if($res){
		redirect('apartment_kigo/list_properties');
	}
    }
    
    public function importnewreservation(){
		$res = $this->Kigo_Model->importnewreservation();
	}
}

?>