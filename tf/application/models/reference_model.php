<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------|
| Author: Provab Technosoft Pvt Ltd.									   |
|--------------------------------------------------------------------------|
| Developer: Provab											   |
| Started Date: 2014-08-19T18:00:00										   |
| Ended Date:  										   					   |
|--------------------------------------------------------------------------|
*/

class Reference_Model extends CI_Model {
	
	public function addReference($reference){
		$this->db->insert('references',$reference);
	}

	public function updateReference($reference,$key){
		$this->db->where('vid', $key);
		$this->db->update('references',$reference);
	}

	public function updateReferenceById($reference,$refid){
		$this->db->where('reference_id', $refid);
		$this->db->update('references',$reference);
	}

	public function getReferenceById($refid){
		$this->db->where('reference_id', $refid);
		return $this->db->get('references');
	}

	public function isvalidKey($key){
		$this->db->where('vid', $key);
		return $this->db->get('references');
	}

	public function get_references_by_you($email, $user_type){
		$this->db->select('a.*, b.firstname as b2c_firstname, c.firstname as b2b_firstname, b.*, c.*');
		$this->db->from('references a');
		$this->db->join('b2c b', 'a.b2c_id = b.user_id AND a.user_type = b.usertype', 'left');
		$this->db->join('b2b c', 'a.b2c_id = c.agent_id AND a.user_type = c.agent_type' , 'left');
		$this->db->where('a.reffered_to', $email);
		$this->db->where('a.m_status', '1');

		return $this->db->get();
	}

	public function get_references_about_you($b2c_id, $user_type, $limitFrom = NULL, $totalResult = NULL){
		$this->db->join('b2c','references.reffered_to = b2c.email', 'left');	
		$this->db->join('b2b','references.reffered_to = b2b.email_id', 'left');	
		$this->db->join('relationship_type','references.relationship = relationship_type.id');
		$this->db->where('references.b2c_id', $b2c_id);
		$this->db->where('references.user_type', $user_type);
		$this->db->where('references.a_status', '1');
		$this->db->where('references.m_status', '1');

		if(!is_null($limitFrom) && !is_null($totalResult)) {
			$this->db->limit($totalResult, $limitFrom);	
		}
		
		return $this->db->get('references');
	}

	public function get_references_about_you_pending($user_id, $user_type){
		$this->db->join('b2c','references.reffered_to = b2c.email', 'left');
		$this->db->join('b2b','references.reffered_to = b2b.email_id', 'left');
		$this->db->where('references.b2c_id', $user_id);
		$this->db->where('references.user_type', $user_type);
		$this->db->where('references.a_status', '0');
		$this->db->where('references.m_status', '1');

		return $this->db->get('references');
	}

	public function getCountryCode() {
		return $this->db->get('country')->result();		
	}
	public function getuserinfo($user_id) {
		$this->db->where('user_id', $user_id);
		return $this->db->get('b2c')->row();		
	}
}

