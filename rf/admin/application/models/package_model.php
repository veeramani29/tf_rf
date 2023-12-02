<?php

class Package_Model extends CI_Model {
	
	public function __construct() {
      parent::__construct();
    }

    public function get_all_countries() {
    	return $this->db->get('country');
    }
   public function get_all_cities() {
		$this->db->select('airport_code,airport_city, airport_id, country');
		$this->db->group_by("country"); 
   	return $this->db->get('flight_airport_list');
    }
  public function get_cities_country($country){
		$this->db->select('airport_code,airport_city, airport_id, country');
		$this->db->where("country",$country); 
   	return $this->db->get('flight_airport_list');
  }
    public function get_cities_country_v2(){
	    $this->db->select('*');
        $this->db->from('hotel_countries');

        $this->db->order_by("COUNTRY_NAME", "asc"); 
       $this->db->group_by("COUNTRY_NAME"); 
      return    $this->db->get();
       
		
  }
  public function get_cities_country_v1($country){
	    $this->db->select('*');
        $this->db->from('hotel_cities');
        $this->db->like('hotel_cities.COUNTRY_CODE',$country);
        $this->db->join('hotel_countries','hotel_cities.COUNTRY_CODE = hotel_countries.COUNTRY_CODE');
        $this->db->order_by("hotel_cities.CITY", "asc"); 
      
        $query = $this->db->get();
        return $query->result();
		
  }
   public function get_cities_country_v4($country){
	    $this->db->select('*');
        $this->db->from('hotel_cities');
        $this->db->like('hotel_cities.IATA_CODES',$country);
        $this->db->join('hotel_countries','hotel_cities.COUNTRY_CODE = hotel_countries.COUNTRY_CODE');
        $this->db->order_by("hotel_cities.CITY", "asc"); 
      
        $query = $this->db->get();
        return $query->row();
		
  }
 public function package_type_data() {
    	return $this->db->get('packages_types');
    }
    public function add_package_details($data) {
    	$this->db->insert("packages", $data);
    	return $this->db->insert_id();
    }

    public function save_package_other_images($uid, $img) {
    	$data=array("package_id"=>$uid, "other_image"=>$img);	
	  	$this->db->insert("package_other_images", $data);
    }

    public function package_view_data() {
    	return $this->db->get('packages');
    }
 public function package_view_data_types() {
    	return $this->db->get('packages_types');
    }
    public function get_country_name($country_code) {
    	$this->db->where('country_id', $country_code);
    	return $this->db->get('country')->row();
    }
 public function get_city_name($country_code) {
    	$this->db->where('airport_code', $country_code);
    	return $this->db->get('flight_airport_list')->row();
    }

    public function get_edit_data($pack_id) {
    	$this->db->where('package_id', $pack_id);
    	return $this->db->get('packages');
    }
 public function get_edit_days($pack_id) {
    	$this->db->where('package_id', $pack_id);
    	return $this->db->get('package_days_list');
    }
    public function get_main_images($pack_id) {
    	$this->db->where('package_id', $pack_id);
    	return $this->db->get('packages');
    }
   public function get_other_images($pack_id) {
    	$this->db->where('package_id', $pack_id);
    	return $this->db->get('package_other_images');
    }
   public function get_day_images($pack_id) {
    	$this->db->where('package_id', $pack_id);
    	return $this->db->get('package_days_list');
    }

    public function update_package_data($package_id, $data) {

    	$this->db->where('package_id', $package_id);
    	$this->db->update('packages', $data);

    	return true;
    }
   public function update_package_days_list($day_id, $data) {

    	$this->db->where('day_id', $day_id);
    	$this->db->update('package_days_list', $data);

    	return true;
    }
    public function update_package_other_images($package_id, $img) {
    	$this->db->where('package_id', $package_id);
    	$count = $this->db->get('package_other_images')->num_rows();
    	if($count > 0) {
    		$data=array("other_image"=>$img);	
    		$this->db->where('package_id', $package_id);
	  		$this->db->update("package_other_images", $data);
	  		return true;	
    	} else {
    		$data=array("package_id"=>$package_id, "other_image"=>$img);	
	  		$this->db->insert("package_other_images", $data);
	  		return true;
    	}
    }

    public function delete_package($package_id) {
    	$data = array('package_id'=>$package_id);
    	$this->db->delete('packages', $data);
    	$affected_row_count = $this->db->affected_rows();
    	
    	if($affected_row_count > 0) {
    		$this->db->where('package_id', $package_id);
    		$this->db->delete('package_other_images');

            $this->db->where('package_id', $package_id);
            $this->db->delete('package_days_list');
    	}

    	return true;
    }
 public function delete_package_type($package_id) {
    	$data = array('packages_types_id'=>$package_id);
    	$this->db->delete('packages_types', $data);
    	$affected_row_count = $this->db->affected_rows();
   	return true;
    }
    public function package_change_status($package_id, $get_status) {
    	$this->db->where('package_id', $package_id);
    	$data = array('status'=>$get_status);
    	$this->db->update('packages', $data);
    	return true;
    }
	
     public function upadate_main_image($package_id, $main_image) {
	$data = array('image'=>$main_image);
    	$this->db->where('package_id', $package_id);
    	$this->db->update('packages', $data);
    	return true;
    }
	
     public function upadate_day_image($day_id, $main_image) {
	$data = array('image'=>$main_image);
    	$this->db->where('day_id', $day_id);
    	$this->db->update('package_days_list', $data);
    	return true;
    }
	
      public function upadate_other_image($other_id, $main_image) {
	$data = array('other_image'=>$main_image);
    	$this->db->where('img_id', $other_id);
    	$this->db->update('package_other_images', $data);
    	return true;
    }
	
    public function delete_other_image($id){
	$data = array('img_id'=>$id);
    	$this->db->delete('package_other_images', $data);
    }


}
