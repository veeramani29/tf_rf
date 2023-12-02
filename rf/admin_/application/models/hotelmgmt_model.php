<?php

class Hotelmgmt_Model extends CI_Model {
	
	public function __construct()
    {
		parent::__construct();
    }
	
	
function getSuppliers($id)
{		
		$select = "SELECT * FROM supplier where supplier_id='".$id."'";


		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
}
function getSuppliers_hotel($id)
{		
	$this->db->select('*');
	$this->db->from('supplier_hotels');
	$this->db->join('crs_hotels','crs_hotels.sup_hotel_id = supplier_hotels.hotel_id','left');
	$this->db->where('supplier_hotels.supplier_id',$id);
	$query = $this->db->get();
	
	
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
}
function getSuppliers_hotel_bookings($id)
{		
	$this->db->select('booking_hotel.*,booking_global.*');
	$this->db->from('supplier_hotels');
	$this->db->join('booking_hotel','booking_hotel.hotel_code = supplier_hotels.hotel_id','left');
	$this->db->join('booking_global','booking_global.ref_id = booking_hotel.id','left');
	$this->db->where('supplier_hotels.supplier_id',$id);
	$this->db->where('booking_hotel.api','CRS');
	$this->db->where('booking_global.module','HOTEL');
	$query = $this->db->get();
	
	
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
}
}  
?>    
