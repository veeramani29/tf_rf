<?php

class Promo_Model extends CI_Model {
	
	public function __construct()
    {
	    parent::__construct();
    }
	public function get_promo_list()
   	{
   
		$this->db->select('*')
		->from('promo');
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
  		
   function add_promo_new($discount,$promo_code,$exp_date)
   {
	   	$data = array(
		'discount' => $discount,
		'promo_code' => $promo_code,
		'exp_date' => $exp_date,
		'status' => '1',
		'promo_type' => '1'
		);
			
		$this->db->set('creation_date', 'NOW()', FALSE); 
		
		$this->db->insert('promo', $data);
		$id = $this->db->insert_id();
		if (!empty($id)) {				
			return true;
		} else {
			return false;
		}
   
   }
   
   function add_promo_new_amount($discount,$promo_code,$exp_date,$promo_amount)
   {
	   	$data = array(
		'discount' => $discount,
		'promo_code' => $promo_code,
		'exp_date' => $exp_date,
		'status' => '1',
		'promo_amount' => $promo_amount,
		'promo_type' => '2'
		);
			
		$this->db->set('creation_date', 'NOW()', FALSE); 
		
		$this->db->insert('promo', $data);
		$id = $this->db->insert_id();
		if (!empty($id)) {				
			return true;
		} else {
			return false;
		}
   
   }
   
   function add_promo_new_spending($discount,$promo_code,$exp_date,$promo_amount)
   {
	   	$data = array(
		'discount' => $discount,
		'promo_code' => $promo_code,
		'exp_date' => $exp_date,
		'status' => '1',
		'promo_type' => '3',
		'promo_amount' => $promo_amount
		);
			
		$this->db->set('creation_date', 'NOW()', FALSE); 
		
		$this->db->insert('promo', $data);
		$id = $this->db->insert_id();
		if (!empty($id)) {				
			return true;
		} else {
			return false;
		}
   
   }
   
   public function get_user_list()
   	{
   
		$this->db->select('email')
		->from('b2c');
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
   function get_promo_code_id($id)
   {
	   	$this->db->select('*')
		->from('promo')->where('promo_id',$id);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }
    function update_promo_status($id,$status)
   {
	   
		$data = array(
			'status' => $status
			
			);
		
		
			
			$where = "promo_id = ".$id;
		if ($this->db->update('promo', $data, $where)) {
			return true;
		} else {
			return false;
		}
	
		
   }
    public function get_agent_list()
   	{
   
		$this->db->select('email_id')
		->from('b2b');
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
		
}

