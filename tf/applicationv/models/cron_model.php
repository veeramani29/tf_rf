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

class Cron_Model extends CI_Model {
	
	

    public function get_global_booking_data(){
		$this->db->select('*');
		$this->db->from('booking_apartment');
		$this->db->where('RES_CHECK_OUT <',date('Y-m-d'));
		
		$query = $this->db->get();

		if($query->num_rows() == '' )
		{
		   return '';   
		}
		else
		{
		  return $query->result(); 
		}
    }
	
	
	
	
	public function addReferenceuser($reference){
		$this->db->insert('reviews_user',$reference);
	}
	
	public function addReferencehost($reference){
		$this->db->insert('reviews_host',$reference);
	}
	
	public function addReferenceguest($reference){
		$this->db->insert('reviews_guest',$reference);
	}
}

