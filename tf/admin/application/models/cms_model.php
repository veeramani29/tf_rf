<?php
class CMS_Model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
	}
	public function isTitleExists($title){
		$this->db->select('*');
		$this->db->where('slug',$title);
		$query = $this->db->get('app_routes');
		if ( $query->num_rows > 0 ) {
         		return true;
      		}
      		return false;
	}
	public function addNewPageDetails($labels){
		$this->db->insert('app_routes',$labels);
		$id = $this->db->insert_id();
		$labels['guid'] = base_url()."cms/page/".$id;
		$labels['url'] = base_url()."cms/page/".$labels['slug'];
		$this->db->trans_start();
		$this->db->where('id',$id);
		$this->db->update('app_routes',$labels);	
		//echo $this->db->last_query();
		
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	public function viewAllPages(){
		$this->db->select('*');
		$query = $this->db->get('app_routes');
		if ( $query->num_rows > 0 ) {
         		return $query->result();
      		}
      		return false;
	}
	
	public function editPage($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get('app_routes');
		if ( $query->num_rows > 0 ) {
         		return $query->row();
      		}
      		return false;
	}
	
	public function updatePage($labels){
		$this->db->trans_start();
		$this->db->where('id',$labels['id']);
		$this->db->update('app_routes',$labels);	
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	public function updatePageStatus($id,$status){
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->update('app_routes', $status); 
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	public function deletePage($id){
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->delete('app_routes'); 
		$this->db->trans_complete();
		return $this->db->trans_status();	
	}
		public function addcontact($data) {
		$this->db->where('contact_id', 1); //we are hard coding the contact_id as there will be only single row for contact details..
		$this->db->update('contact_details', $data);
	}

	public function currentAddress() {
		return $this->db->get('contact_details');
	}
	
	
}
?>
