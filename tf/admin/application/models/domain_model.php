<?php

class Domain_Model extends CI_Model {
	
	public function __construct()
    {
	
      parent::__construct();
    }
	public function get_domain_list()
   	{
   
		$this->db->select('*')
		->from('domain');
		
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
   
	public function get_domain_list_id($id)
   	{
   
		$this->db->select('*')
		->from('domain')->where('domain_id',$id);
		
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }
    function get_domain_list_cities($id)
   	{
   
		$this->db->select('*')
		->from('domain_cities')->where('domain_id',$id);
		
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
   function get_cityname($nama)
   {
	   $this->db->select('city_name,country_name')
		->from('priceline_city')->where('degree_city_id',$nama);
		
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         $a= $query->row();
		
		 return $a->city_name.', '.$a->country_name;
      }
      return false;
   }
    public function get_country_list()
   	{
   
		$this->db->select('*')
		->from('country');
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
    function get_country_data()
   {
	   	$this->db->select('country_code,country_name')
		->from('priceline_city')->group_by('country_name');
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
   function add_city_data($id,$city)
   {
	   
	   	$data = array(
		'domain_id' => $id,
		'cityid' => $city
		);
			
		
		$this->db->insert('domain_cities', $data);
		$id = $this->db->insert_id();
		if (!empty($id)) {				
			return true;
		} else {
			return false;
		}
   
   }
     public function get_usertypes_list()
   	{
   
		$this->db->select('*')
		->from('user_types');
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
   function update_domain_color($id,$fcolor,$bcolor)
   {
	    
		$data = array(
			'domain_fcolor' => $fcolor,
			'domain_bcolor' => $bcolor
			);
		
		
			
			$where = "domain_id = ".$id;
		if ($this->db->update('domain', $data, $where)) {
			return true;
		} else {
			return false;
		}
	
   }
   function update_domain_logo($id,$image_path)
   {
	   $data = array(
			'domain_logo' => $image_path
		
			);
		
				
			$where = "domain_id = ".$id;
		if ($this->db->update('domain', $data, $where)) {
			return true;
		} else {
			return false;
		}
	
	   
   }
    function update_domain_bimage($id,$image_path)
   {
	   $data = array(
			'domain_backimage' => $image_path
		
			);
		
				
			$where = "domain_id = ".$id;
		if ($this->db->update('domain', $data, $where)) {
			return true;
		} else {
			return false;
		}
	
	   
   }
	
		
}

