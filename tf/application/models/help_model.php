<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Help_Model extends CI_Model 
{
	public function getAllMenu(){
		$this->db->order_by('menu_id');
		return $this->db->get('crs_help_center_options')->result();
	}

	public function getHeaderMenu(){
		
		return $this->db->get('header_links')->result();
	}

	public function getSubMenu($mainMenuId)
	{
		$this->db->select('*');
		$this->db->from('crs_sub_menus');
		$this->db->where('menu_id', $mainMenuId);

		$getSubMenu_query = $this->db->get()->result();
		return $getSubMenu_query;
	}

	public function fetchContent($menuMasterId=null, $subMenuId=null) 
	{
		$this->db->select('*');
		$this->db->from('crs_submenu_content');
		$this->db->where('menu_id', $menuMasterId);
		
		if(!empty($subMenuId)) {
			$this->db->where('sub_menu_id', $subMenuId);	
		}

		$this->updatePopularSearch($menuMasterId, $subMenuId);
		$query = $this->db->get()->result();
		return $query;
 	}

 	public function updatePopularSearch($menuMasterId=null, $subMenuId=null) 
 	{
 		$query = "UPDATE crs_submenu_content SET popular=popular+1 WHERE menu_id=$menuMasterId AND sub_menu_id=$subMenuId";
 		$this->db->query($query);
		return true; 		
    }

/*Search Help Center*/

 	public function searchHelpArticle($q) 
 	{
 		$this->db->select('a.*, b.*');
 		$this->db->from('crs_sub_menus a');
 		$this->db->join('crs_submenu_content b', 'a.menu_id = b.menu_id AND a.sub_menu_id=b.sub_menu_id');
 		$this->db->where('sub_menu_title LIKE "%'.$q.'%" OR  con_title LIKE "%'.$q.'%" OR hedding LIKE "%'.$q.'%"');

 		$this->db->limit(5);

 		$query = $this->db->get();

 		$data['searchResult'] = $query->result();
 		$data['searchCount'] = $query->num_rows();
 		return $data;

 	}

 	public function getPopularSearchKeyword() {
 		$this->db->join('crs_sub_menus', 'crs_submenu_content.menu_id = crs_sub_menus.menu_id AND crs_submenu_content.sub_menu_id=crs_sub_menus.sub_menu_id','left');
 		$this->db->where('crs_submenu_content.content_type != 3');
 		$this->db->order_by('crs_submenu_content.popular', 'desc');
 		$this->db->limit(4);
 		return $this->db->get('crs_submenu_content')->result();
 	}

 	public function fetchContentTitle($menuMasterId, $subMenuId) {
 		if($subMenuId != 0) {
	 		$where = "sub_menu_id = ".$subMenuId." AND menu_id = ".$menuMasterId;
	 		$this->db->select('sub_menu_title');
	 		$this->db->from('crs_sub_menus');
	 		$this->db->where($where);
 		} else {
 			$where = "menu_id = ".$menuMasterId;
 			$this->db->select('menu_option');
	 		$this->db->from('crs_help_center_options');
	 		$this->db->where($where);
 		}
 		return $this->db->get()->result();
 	}

 	public function fetchHelpLinks() {
 		$getmenu_subId = $this->db->get('crs_help_links')->result();
 		
 		foreach($getmenu_subId as $id_key) {
 			$link_array[] = $this->getHelpLinks($id_key->menu_id, $id_key->sub_menu_id);
 		}
 		return $link_array;
 	}

 	public function getHelpLinks($menu_id, $sub_menu_id) {
 		$where = 'menu_id = '.$menu_id.' AND sub_menu_id = '.$sub_menu_id;
 		$this->db->select('*');
 		$this->db->from('crs_sub_menus');
 		$this->db->where($where);

 		return $this->db->get()->result();

 	}

 	public function fetchLinkContent($menuMasterId, $subMenuId, $cont_id) {
 		$where = "menu_id = ".$menuMasterId." AND sub_menu_id=".$subMenuId." AND cont_id=".$cont_id;
 		$this->db->select('*');
 		$this->db->from('crs_submenu_content');
 		$this->db->where($where);

 		return $this->db->get()->row();
 	}

 	public function checkUserReview($menu_id=NULL, $submenu_id=NULL, $cont_id=NULL, $user_ip=NULL) {
 		if($cont_id == 0) {
 			$cont_id = 0;
 		}

 		$where = "menu_id = ".$menu_id." AND submenu_id = ".$submenu_id." AND cont_id = ".$cont_id."  AND user_ip = '".$user_ip."'";

 		$this->db->select('*');
 		$this->db->from('crs_help_feedback');
 		$this->db->where($where);

 		$query = $this->db->get()->num_rows();
 		if($query > 0) {
 			return false;
 		} else {
 			return true;
 		}
 	}

 	public function addFeedback($data) {
 		$this->db->insert('crs_help_feedback', $data);
 		return true;
 	}

	public function getHomeSettings(){
		$query = $this->db->get('homepage_settings', 1, 0);
		return $query->row();
	}

	public function getsocial_links(){
		$query = $this->db->get('social_links', 1, 0);
		return $query->row();
	}
	public function getAllPortfolio(){
		$this->db->select('*')
		->from('home_portfolio')
		->join('home_portfolio_languages', 'home_portfolio.id  = home_portfolio_languages.home_portfolio_id','left');
		$query = $this->db->get();
	      	if ( $query->num_rows > 0 ) {
		 return $query->result();
	      	}
	       return false;
	}
	public function getAllBackgroundimages(){
		$this->db->select('*')
		->from('home_background');
		$this->db->where('status', 1);
		$query = $this->db->get();
		 return $query->result();
	      
	}
	public function getAllFooterLinks(){
		$query = $this->db->get('footer_links');
		if ( $query->num_rows > 0 ) {
         		return $query->result();
      		}
      		return false;
	}
	
	public function getAllcheck_In(){
	$this->db->where('status','1');
		$query = $this->db->get('check_in_details');
		if ( $query->num_rows > 0 ) {
         		return $query->result_array();
      		}
      		return false;
	}

	public function get_open_type($slug){
		$this->db->where('slug',$slug);
		$query = $this->db->get('app_routes');
		if ( $query->num_rows > 0 ) {
         		return $query->result_array();
      		}
      		return false;
	}

}