<?php
class Privilege_Model extends CI_Model {
	
	public function __construct(){
	    parent::__construct();
    }
	
	public function get_modules_by_b2b_id($agent){
		$this->db->select('product.controller');
		$this->db->where('b2b_id',$agent);
		$this->db->join('product', 'product.product_id = b2b_privileges.product_id');
		return $this->db->get('b2b_privileges');
	}
  				
}