<?php

class Xml_Logs_Model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	public function getAllXmlLogs(){
		$this->db->select('*');
		$this->db->from('XML_logs');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return array();
		}
	}
		
	public function getOneXmlLogs($id){
		$this->db->select('*');
		$this->db->from('XML_logs');
		$this->db->where('XML_logs_id',$id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return array();
		}
	}
}
