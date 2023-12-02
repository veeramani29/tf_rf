<?php

class Api_Model extends CI_Model {
	
	public function __construct()
    {
	
      parent::__construct();
    }
	function get_api_list_id($id)
	{
		
		$this->db->select('*')
		->from('api')
		->where('api_id',$id)
		;
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
	}
	function get_api_list_domain_id($id, $domain)
	{
		
		$this->db->select('*')
		->from('api_domian_status')
		->where('domain_id',$domain)
		->where('api_id',$id)
		;
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
	}
	public function get_api_list_domain($id)
   	{
   
		$this->db->select('*')
		->from('api_domian_status')
		->where('api_id', $id)
		->join('domain', 'domain.domain_id  = api_domian_status.domain_id', 'left')
		;
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
	public function get_api_list(){
   		$this->db->select('*')
		->from('api')
		;
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
   public function get_api_filtered(){
   	$apis = array('');
   	$data = $this->db->get('markup_b2c')->result();
   	foreach ($data as $value) {
   		$apis[] = $value->api_id;
   	}
   	$this->db->where_not_in('api_id', $apis);
   	return $this->db->get('api')->result();
	}

	public function get_api_filtered_b2b(){
	   	$apis = array('');
	   	$data = $this->db->get('markup_b2b')->result();
	   	foreach ($data as $value) {
	   		$apis[] = $value->api_id;
	   	}
	   	$this->db->where_not_in('api_id', $apis);
	   	return $this->db->get('api')->result();
	}
	  function update_api_status($id, $val) {

        $data = array(
            'status' => $val
            
           
        );



        $where = "api_id = " . $id;
        if ($this->db->update('api', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }
}

