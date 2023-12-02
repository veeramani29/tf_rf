<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rooms_model extends CI_Model

{
	
public function __construct() {

parent::__construct();

}


public function get_rooms(){
	
$this->db->select('*');
$this->db->from('rooms');
$this->db->order_by('id', 'DESC');
//$this->db->limit(5);
$query = $this->db->get();
return $query;

}
public function category($id = NULL)
{
	$query  = $this->db->get_where('category',array('id =' => $id))->row();		  
	return $query;
}
function  categories()
{

$query = $this->db->get('category');
return $query;
}

public function create_rooms($data)
{
$this->db->insert('rooms', $data);
$poll_id = $this->db->insert_id();
return $poll_id;
}


function update_rooms($data,$id)
{
$res = $this->db->update('rooms', $data, array('id' => $id));
return $res;
}


public function edit_rooms($id = NULL)
{
$query  = $this->db->get_where('rooms',array('id =' => $id))->row();		  
return $query;
}


public function delete_rooms($id)
{

$delete  = $this->db->delete('rooms', array('id' => $id)); 
return $delete;
			
}

function update_ads($data,$id)
{
$res = $this->db->update('rooms', $data, array('id' => $id));
return $res;
}

function delete($ids){
$ids = $ids;
$count = 0;
foreach ($ids as $id){
$did = intval($id).'<br>';
$this->db->where('id', $did);
$this->db->delete('rooms');  
$count = $count+1;
}

echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
'.$count.' Item deleted successfully
</div>';
$count = 0;
}

public function get_hotel_country_list()
{   
$this->db->select('country_name')
->from('roomsxml_city_list')
->group_by('country_name');

$query = $this->db->get();
if($query->num_rows > 0 ) 
{      
return $query->result();
}
return false;
}


public function get_hotel_list()
{   
$this->db->select('id,hotel_name')
->from('hotels');
$query = $this->db->get();

if($query->num_rows > 0 ) 
{      
return $query->result();
}

return false;

}

public function get_hotel_city_list($val=NULL)
{   
$this->db->select('region_name')
->from('roomsxml_city_list')
->where('country_name',$val)
->group_by('region_name');

$query = $this->db->get();

if($query->num_rows > 0 ) 
{      
return $query->result();
}

return false;

}


}
