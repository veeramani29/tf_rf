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

class Discount_Model extends CI_Model {
	
	public function __construct()
    {
	
      parent::__construct();
    }
    
    public function get_all_discounted_flights(){
		
		$f_results=$this->db->get('discounted_flights');
		return $f_results->result();
	}
	
	public function get_offer_details($id){
		$this->db->where('id', $id);
		$f_results=$this->db->get('discounted_flights');
		return $f_results->result();
	}
	
	public function get_offer_images($id){
		$this->db->where('flight_id', $id);
		$f_results=$this->db->get('discounted_flight_images');
		return $f_results->result();
	}
	
	public function get_airport_list(){
		
		$f_results=$this->db->get('flight_airport_list');
		//echo $this->db->last_query();
		return $f_results->result();
	}
	
	
	
	public function updateStatus($id,$status){
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->update('discounted_flights', $status); 
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	public function delete($id){
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->delete('discounted_flights'); 
		$this->db->where('flight_id', $id);
		$this->db->delete('discounted_flight_images'); 
		$this->db->trans_complete();
		return $this->db->trans_status();	
	}
	
	public function delete_discount_img($id){
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->delete('discounted_flight_images'); 
		$this->db->trans_complete();
		return $this->db->trans_status();	
	}
	
	public function isDetailsExists($date){
		$this->db->select('*');
		$this->db->where('exp_date',$date);
		$query = $this->db->get('discounted_flights');
		if ( $query->num_rows > 0 ) {
         		return true;
      		}
      		return false;
	}
	
	public function get_airline_list(){
		return $this->db->query('select * from airlines_list order by airline_name asc')->result();
	}
	
}
	
