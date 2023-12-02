<?php
class Privilege_Model extends CI_Model {
	
	public function __construct(){
	    parent::__construct();
    }
	public function get_privileges_list(){
   		return $this->db->get('privileges');
	}
	public function add_privilege($priv_post){
		$this->db->insert('subadmin_privileges',$priv_post);
	}
	public function get_privileges_by_sub_admin_id($sub_admin_id){
		$this->db->where('subadmin_id',$sub_admin_id);
		$this->db->join('privileges', 'privileges.id = subadmin_privileges.privilege_id');
		return $this->db->get('subadmin_privileges');
	}
	public function get_modules_by_sub_admin_id($sub_admin){
		$this->db->select('privileges.controller');
		$this->db->where('subadmin_id',$sub_admin);
		$this->db->join('privileges', 'privileges.id = subadmin_privileges.privilege_id');
		return $this->db->get('subadmin_privileges');
	}
	public function get_modules_by_sub_admin($sub_admin){
		$this->db->select('privileges.id');
		$this->db->where('subadmin_id',$sub_admin);
		$this->db->join('privileges', 'privileges.id = subadmin_privileges.privilege_id');
		return $this->db->get('subadmin_privileges');
	}
	public function delete_privileges($sub_admin){
		$this->db->where('subadmin_id',$sub_admin);
		$this->db->delete('subadmin_privileges');
	}

	public function get_module_privileges_list(){
   		return $this->db->get('product');
	}
	public function get_modules_by_agent($agent){
		$this->db->select('product.product_id');
		$this->db->where('b2b_id',$agent);
		$this->db->join('product', 'product.product_id = b2b_privileges.product_id');
		return $this->db->get('b2b_privileges');
	}
	public function delete($agent){
		$this->db->where('b2b_id',$agent);
		$this->db->delete('b2b_privileges');
	}
	public function add($priv_post){
		$this->db->insert('b2b_privileges',$priv_post);
	}
	public function get_modules_by_b2b_id($agent){
		$this->db->select('product.controller');
		$this->db->where('b2b_id',$agent);
		$this->db->join('product', 'product.product_id = b2b_privileges.product_id');
		return $this->db->get('b2b_privileges');
	}
  				
}