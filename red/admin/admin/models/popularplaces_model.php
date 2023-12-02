<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Popularplaces_model extends CI_Model

{
	
public function __construct() {

parent::__construct();

}


public function get_popularplaces(){
	
$this->db->select('*');
$this->db->from('popularplaces');
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

public function create_popularplaces($data)
{
$this->db->insert('popularplaces', $data);
$poll_id = $this->db->insert_id();
return $poll_id;
}


function update_popularplaces($data,$id)
{
$res = $this->db->update('popularplaces', $data, array('id' => $id));
return $res;
}


public function edit_popularplaces($id = NULL)
{
$query  = $this->db->get_where('popularplaces',array('id =' => $id))->row();		  
return $query;
}


public function delete_popularplaces($id)
{

$delete  = $this->db->delete('popularplaces', array('id' => $id)); 
return $delete;
			
}

function update_ads($data,$id)
{
$res = $this->db->update('popularplaces', $data, array('id' => $id));
return $res;
}

function delete($ids){
$ids = $ids;
$count = 0;
foreach ($ids as $id){
$did = intval($id).'<br>';
$this->db->where('id', $did);
$this->db->delete('popularplaces');  
$count = $count+1;
}

echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
'.$count.' Item deleted successfully
</div>';
$count = 0;
}


}
