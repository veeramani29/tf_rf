<?php
class CMS_Model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
	}
	public function getAllPages(){
		$this->db->select('*');
		$query = $this->db->get('app_routes');
		if ( $query->num_rows > 0 ) {
	 		return $query->result();
		}
		return false;		
	}
	public function pageBySlug($slug){
		$this->db->select('*');
		$this->db->where('slug',$slug);
		$this->db->where('status','1');
		$query = $this->db->get('app_routes');
		if ( $query->num_rows > 0 ) {
         		return $query->row();
      		}else{
      			return array();
      		}
      		
	}
	public function pageById($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$this->db->where('status','1');
		$query = $this->db->get('app_routes');
		if ( $query->num_rows > 0 ) {
         		return $query->row();
      		}else{
      			return array();
      		}
      		
	}
}
?>
