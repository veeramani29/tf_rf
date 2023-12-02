<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class bellowbanner_model extends CI_Model

{
	
public function __construct() {

parent::__construct();

}


public function get_bellowbanner(){
	
$this->db->select('*');
$this->db->from('bellowbanner');
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

public function create_bellowbanner($data)
{
$this->db->insert('bellowbanner', $data);
$poll_id = $this->db->insert_id();
return $poll_id;
}


function update_bellowbanner($data,$id)
{
$res = $this->db->update('bellowbanner', $data, array('id' => $id));
return $res;
}


public function edit_bellowbanner($id = NULL)
{
$query  = $this->db->get_where('bellowbanner',array('id =' => $id))->row();		  
return $query;
}


public function delete_bellowbanner($id)
{

$delete  = $this->db->delete('bellowbanner', array('id' => $id)); 
return $delete;
			
}

function update_ads($data,$id)
{
$res = $this->db->update('bellowbanner', $data, array('id' => $id));
return $res;
}

function delete($ids){
$ids = $ids;
$count = 0;
foreach ($ids as $id){
$did = intval($id).'<br>';
$this->db->where('id', $did);
$this->db->delete('bellowbanner');  
$count = $count+1;
}

echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
'.$count.' Item deleted successfully
</div>';
$count = 0;
}


}
