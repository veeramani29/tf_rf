<?php
class Language_library_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
	}
	public function getAllPages(){
		$this->db->distinct('pages');
		$query = $this->db->get('language_pages');
		if ( $query->num_rows > 0 ) {
         		return $query->result();
      		}
      		return false;
	}
	public function getAllModules(){
		$this->db->distinct('module');
		$query = $this->db->get('language_pages');
		if ( $query->num_rows > 0 ) {
         		return $query->result();
      		}
      		return false;
	}
	public function getAllSections(){
		$this->db->distinct('section');
		$query = $this->db->get('language_pages');
		if ( $query->num_rows > 0 ) {
         		return $query->result();
      		}
      		return false;
	}
	public function getAllTypes(){
		$this->db->distinct('type');
		$query = $this->db->get('language_pages');
		if ( $query->num_rows > 0 ) {
         		return $query->result();
      		}
      		return false;
	}
	public function addPages($pages){
		$this->db->insert('language_pages',$pages);
		return $this->db->insert_id();
	}
	public function addGeneralLabels($labels){
		$this->db->insert('language_library',$labels);
		return $this->db->insert_id();
	}
	public function getAllLanguagePages(){
		$this->db->select('*');
		$query = $this->db->get('language_pages');
		if ( $query->num_rows > 0 ) {
         		return $query->result();
      		}
      		return false;
	}
	public function getOneLanguagePage($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get('language_pages');
		if ( $query->num_rows > 0 ) {
         		return $query->row();
      		}
      		return false;
	}
	public function generalView($module,$page){
		$this->db->select('*');
		$this->db->where('module',$module);
		if($page!= false){
			$this->db->where('page',$page);
		}
		$query = $this->db->get('language_library');
		if ( $query->num_rows > 0 ) {
         		return $query->result();
      		}
      		return false;
	}
	
	public function apartmentView($module,$page){
		$this->db->select('*');
		$this->db->where('module',$module);
		if($page!= false){
			$this->db->where('page',$page);
		}
		$query = $this->db->get('language_library');
		if ( $query->num_rows > 0 ) {
         		return $query->result();
      		}
      		return false;
	}
	
	
	
	public function updateGeneralLabels($labels,$id){
		$this->db->trans_start();
		$this->db->where('id',$id);
		$this->db->where('page',$labels['page']);
		$this->db->where('label',$labels['label']);
		$this->db->where('module',$labels['module']);
		$this->db->update('language_library',$labels);	
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	public function deleteGeneralLabel($page,$id){
		$this->db->trans_start();
		$this->db->where('page', $page);
		$this->db->where('id', $id);
		$this->db->delete('language_library'); 
		$this->db->trans_complete();
		return $this->db->trans_status();	
	}
	public function generalViewLabels($module,$page,$label){
		$this->db->select('*');
		$this->db->where('module',$module);
		$this->db->where('page',$page);
		$this->db->where('label',$label);
		$query = $this->db->get('language_library');
		if ( $query->num_rows > 0 ) {
         		return $query->row();
      		}
      		return false;
	}
	
	public function generalHomeLanguage($page,$module){
		$this->db->select('*');
		$this->db->where('module',$module);
		$this->db->where('page',$page);
		if($page == 'dashboard' || $page == 'your_listing' ||  $page == 'your_profile' || $page == 'newsletter' || $page == 'settings' ||  $page == 'your_trips' ||  $page == 'inbox' ||  $page == 'wishlist' ||  $page == 'booking'){
		   $page_array = array('dashboard','your_listing','your_profile','newsletter','settings','your_trips','inbox','wishlist','booking');		
		   $this->db->or_where_in('page', $page_array);
		}
		else if($page == 'search' || $page == 'result')
		{
		$page_array = array('search','result');		
		$this->db->or_where_in('page', $page_array);	
		}
			
		return 	$this->db->get('language_library');
	}

	public function getContent(){
		 $this->db->distinct();
		$this->db->select('page');
		$query = $this->db->get('language_library');
		if($query->num_rows()){
			return $query->result();
		}else{
			return array();
		}
	}

	public function viewContent($page){

		$this->db->where('page',$page);
		$query = $this->db->get('language_library');
		//echo $this->db->last_query();exit();
		if($query->num_rows()){
			return $query->result();
		}else{
			return array();
		}
	}
	public function editlanguages($id){
		$this->db->where('id',$id);
		$query = $this->db->get('language_library');
		//echo $this->db->last_query();exit();
		if($query->num_rows()){
			return $query->row();
		}else{
			return array();
		}
	}

	 public function update_language($english, $arabic, $french, $german, $spanish, $farsi,$id) {

        $data = array(
            'english' => $english,
            'arabic' => $arabic,
            'french' => $french,
            'german' => $german,
            'spanish' => $spanish,
            'farsi' => $farsi
        );
       			$where = "id = ".$id;
        		if ($this->db->update('language_library', $data, $where)) {
        			return true;
        		} else {
        			return false;
        		}
           
    }
	
	
}
