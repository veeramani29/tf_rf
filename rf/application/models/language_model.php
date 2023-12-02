<?php
class Language_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
	}
	public function getAllFooterLinks(){
		$query = $this->db->get('footer_links');
		if ( $query->num_rows > 0 ) {
         		return $query->result();
      		}
      		return false;
	}
	public function getlangdata($lang,$page)
	{
		$this->db->select($lang.', label');
		$this->db->where('page',$page);
		return $this->db->get('language_library')->result();
	}
}
?>
