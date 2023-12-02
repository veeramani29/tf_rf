<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class api_model extends CI_Model

{
	
public function __construct() {

parent::__construct();

}


public function get_api(){
	
$this->db->select('*');
$this->db->from('api_info');
$this->db->order_by('api_id', 'DESC');
//$this->db->limit(5);
$query = $this->db->get();
return $query;

}

public function create_api($data)
{
$this->db->insert('api_info', $data);
$poll_id = $this->db->insert_id();
return $poll_id;
}


function update_api($data,$api_id)
{
$res = $this->db->update('api_info', $data, array('api_id' => $api_id));
return $res;
}


public function edit_api($api_id = NULL)
{
$query  = $this->db->get_where('api_info',array('api_id =' => $api_id))->row();		  
return $query;
}


public function delete_api($api_id)
{

$delete  = $this->db->delete('api_info', array('api_id' => $api_id)); 
return $delete;
			
}

public function manage_api_status($api_id, $status) {


        $data['status'] = $status;


        $where = "api_id = '$api_id'";


        if ($this->db->update('api_info', $data, $where)) {


            return true;
        } else {


            return false;
        }
    }


function delete($api_ids){
$api_ids = $api_ids;
$count = 0;
foreach ($api_ids as $api_id){
$did = intval($api_id).'<br>';
$this->db->where('id', $did);
$this->db->delete('api');  
$count = $count+1;
}

echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
'.$count.' Item deleted successfully
</div>';
$count = 0;
}


}
