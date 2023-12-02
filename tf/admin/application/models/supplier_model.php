<?php

class Supplier_model extends CI_Model {
	
	public function __construct()
    {
		parent::__construct();
    }

function getSuppliers($id='')
{		if($id==''){
		$select = "SELECT * FROM supplier";
	}else{
		$select = "SELECT * FROM supplier where supplier_id='".$id."'";
	}

		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
}
function getSuppliers_hotels($id)
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
public function update_hotel_suppiler($hotel_id,$supplier_id)
{
	$this->db->select('*');
	$this->db->from('supplier_hotels');
	$this->db->where('supplier_hotels.supplier_id',$supplier_id);
	$this->db->where('supplier_hotels.hotel_id',$hotel_id);
	$query = $this->db->get();
	if ($query->num_rows() > 0)
		{
			return false;	
			
		} else {
			$data['hotel_id'] = $hotel_id;
			$data['supplier_id'] = $supplier_id;
			$this->db->insert('supplier_hotels',$data);
		}
}
public function delete_supplier($id)	
{
	$this->db->delete('supplier', array('supplier_id' => $id)); 
	return true;
}
public function delete_supplier_hotel($id)	
{
	$this->db->delete('supplier_hotels', array('supplier_hotels_id' => $id)); 
	return true;
}
public function insert_supplier($data)
{
	$this->db->insert('supplier',$data);
	return true;
}

public function fetch_hotelcrs()
{
	$this->db->select('*');	
	$this->db->from('crs_hotels');
 
 	$query = $this->db->get();
	if($query->num_rows() > 0)
	{
		return $query->result();
	}
	else
	{
		return '';
	}
	
	}
	
	function view_all_hotels_admin($id='')
	{

		$select ="SELECT * FROM crs_hotels";
		$query=$this->db->query($select);
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->result();
		}
	}
	public function updateSupplier($data,$id){	
		//$country = implode(',',$data['country']);	
		//$city = implode(',',$data['city']);	
		//$hotel = implode(',',$data['hotel']);	
		
		$up = "update supplier set password='".$data['password']."',firstname='".$data['fname']."',lastname ='".$data['lname']."',address='".$data['address']."',contact_no='".$data['mobile']."',postal_code='".$data['post_code']."' where  supplier_id='".$id."'";
		$this->db->query($up);
	}

}  
?>    
