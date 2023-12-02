<?php
class Home_Settings_Model extends CI_Model {
	
   	public function __construct()
    	{
      		parent::__construct();
    	}

  	public function addPortfolioImages($images){
		$this->db->insert('home_portfolio', $images);
		return $this->db->insert_id();
    	}

    	public function addBackgroundImages($images){
		$this->db->insert('home_background', $images);
		return $this->db->insert_id();
    	}
  	public function addPortfolioLanguages($languages){
		$this->db->insert('home_portfolio_languages', $languages);
		return $this->db->insert_id();
	}
	public function getAllPortfolio(){
		$this->db->select('*')
		->from('home_portfolio');
		$query = $this->db->get();
	      	if ( $query->num_rows > 0 ) {
		 return $query->result();
	      	}
	       return false;
	}
	public function getbackgroundimage(){
		$this->db->select('*')
		->from('home_background');
		$query = $this->db->get();
	      	if ( $query->num_rows > 0 ) {
		 return $query->result();
	      	}
	       return false;
	}
	public function getOnePortfolio($id){
		$this->db->select('*')
		->from('home_portfolio')
		->join('home_portfolio_languages', 'home_portfolio.id  = home_portfolio_languages.home_portfolio_id','left')
		->where('home_portfolio.id', $id);
		/*$query = $this->db->query("SELECT a.id, a.image,a.link, b.id as language_id, b.language, b.title,b.description
					FROM home_portfolio a
					INNER JOIN home_portfolio_languages b
					ON a.id = b.home_portfolio_id
					WHERE a.id = $id");*/

		
		$query = $this->db->get();
	      	if ( $query->num_rows > 0 ) {
		 return $query->result();
	      	}
	       return false;
	}
	
	public function updatePortfolioImages($images,$id){
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->update('home_portfolio', $images); 
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	public function updatePortfolioLanguages($languages,$id){
		$this->db->where('id', $id);
		$this->db->update('home_portfolio_languages', $languages); 
	}
	public function deleteOnePortfolio($id){
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->delete('home_portfolio'); 
		$this->db->trans_complete();
		if($this->db->trans_status()){
			$this->db->where('home_portfolio_id', $id);
			$this->db->delete('home_portfolio_languages'); 
		}
	}
	public function deletebackgroundimage($id){
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->delete('home_background'); 
		$this->db->trans_complete();
		
	}
	public function updatePortfolioStatus($id,$status){
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->update('home_portfolio', $status); 
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	public function updateBackgroundStatus($id,$status){
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->update('home_background', $status); 
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
		
	public function getAllFooterLinks(){
		$query = $this->db->get('footer_links');
		if ( $query->num_rows > 0 ) {
         		return $query->result();
      		}
      		return false;
	}
	
	public function addFooterLinksDetails($labels){
		$this->db->insert('footer_links',$labels);
		return $this->db->insert_id();
	}
	
	public function generalViewLabels($page,$id){
		$this->db->select('*');
		$this->db->where('page',$page);
		$this->db->where('id',$id);
		$query = $this->db->get('footer_links');
		if ( $query->num_rows > 0 ) {
         		return $query->row();
      		}
      		return false;
	}
	
	public function updateGeneralLabels($labels,$id){
		$this->db->trans_start();
		$this->db->where('id',$id);
		$this->db->where('page',$labels['page']);
		$this->db->update('footer_links',$labels);	
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	public function deleteGeneralLabel($page,$id){
		$this->db->trans_start();
		$this->db->where('page', $page);
		$this->db->where('id', $id);
		$this->db->delete('footer_links'); 
		$this->db->trans_complete();
		return $this->db->trans_status();	
	}
	public function get_all_countries_list()
	{
		return $this->db->get('country')->result();
	}
	public function checkcountryname($country,$code,$phone)
	{
		$this->db->where('name', $country);
		$this->db->or_where('country_code', $code);
		return $this->db->get('country');
	}
	public function add_country($country,$code,$phone)
	{
		$data=array('name'=>$country,
					'country_code'=>$code,
					'phonecode'=>$phone);
		return $this->db->insert('country',$data);
	}
	public function countryById($id)
	{
		$this->db->where('country_id', $id);
		return $this->db->get('country')->row();
	}
	public function checkcountrynameforupdate($id,$country,$code,$phone) 
	{
		$query="select * from country where country_id !='".$id."' AND (name ='".$country."' OR country_code ='".$code."')";
		return $this->db->query($query);
	}
	public function update_country($data,$id)
	{
		$this->db->where('country_id', $id);
		return $this->db->update('country',$data);
	}
	public function delete_country($id)
	{
		$this->db->where('country_id', $id);
		return $this->db->delete('country');
	}
}
