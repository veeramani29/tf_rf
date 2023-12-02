<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*<Vikas Arora>*/


class Home_Model extends CI_Model {

	public function getSlideData() {
		$this->db->where('status', 1);
		return $this->db->get('homepage_slider_images');
	}

	public function getTopDestinations() {
		return $this->db->get('top_destinations');
	}

	public function getCityName($id) {
		$this->db->where('city_id', $id);
		return $this->db->get('api_hotels_city');
	}

	public function getFeaturedHotels() {
		return $this->db->get('featured_hotels');
	}

	public function getDeals() {
		return $this->db->get('deals');	
	}

	public function getNews($group_id) {
		$this->db->select('a.*, b.*');
		$this->db->from('news_management a');
		$this->db->join('news_classified_users b', 'a.id = b.news_id', 'left');
		$this->db->where('b.group_id', $group_id);

		return $this->db->get();
	}

	public function getExploreMore() {
		return $this->db->get('explore_more');
	}

	public function getBanner() {
		return $this->db->get('banner_images');
	}
	public function applyJob($data){
		if(!empty($data)){
			$this->db->insert('sky_jobs',$data);
			return $this->db->insert_id();
		}else{
			return false;
		}
	}
	public function getAllFAQ(){
		$this->db->select('*');
		$query = $this->db->get('cms_faq');
		if ( $query->num_rows > 0 ) {
	 		return $query->result();
		}else{
			return array();
		}		
	}

	public function addCaptcha($data){
		$query = $this->db->insert_string('captcha', $data);
	  	$this->db->query($query);
	}

	public function captchaValidation($captcha){
		// First, delete old captchas
		$expiration = time()-7200; // Two hour limit
		$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);	

		// Then see if a captcha exists:
		$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
		$binds = array($captcha, $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		return $query->row();

	}
	
	public function getcontact()
	{
		return $this->db->get('contact_details')->row();
	}
	
		public function getCouponDiscountBanner()
	{
		return $this->db->get('discounted_flights')->row();
	}
	
	
	public function get_app_routes($slug)
	{

		$this->db->where('slug',$slug);
		return $this->db->get('app_routes')->row();
	}
}



/*</Vikas Arora>*/