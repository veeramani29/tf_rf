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

class Reviews_Model extends CI_Model {
	
public function isvalidKey($key){
		$this->db->where('vid', $key);
		return $this->db->get('reviews_user');
	}
	public function isvalidKey_host($key){
		$this->db->where('vid', $key);
		return $this->db->get('reviews_host');
	}
	public function isvalidKey_guest($key){
		$this->db->where('vid', $key);
		return $this->db->get('reviews_guest');
	}
	public function updateReference($reference,$key){
		$this->db->where('vid', $key);
		$this->db->update('reviews_user',$reference);
	}
	
	public function updateReference_host($reference,$key){
		$this->db->where('vid', $key);
		$this->db->update('reviews_host',$reference);
	}
	
	public function updateReference_guest($reference,$key){
		$this->db->where('vid', $key);
		$this->db->update('reviews_guest',$reference);
	}
	
		public function updateReference1($reference){

		$this->db->insert('reviews_user_data',$reference);
	}
	public function updateReference_host1($reference){

		$this->db->update('reviews_host_data',$reference);
	}
	function deletereview_host($key)
	{
		$this->db->where('vid', $key);
		$this->db->delete('reviews_host');

	}
	function deletereview_user($key)
	{
		$this->db->where('vid', $key);
		$this->db->delete('reviews_user');

	}
	
	public function update_review_to_stop_user($key,$booking_apartment_id){
		$this->db->where('vid', $key);
		$this->db->delete('reviews_user');
		
		$review_status = array(
           'review_user_status' => 1
        );
	  	$this->db->where('ID', $booking_apartment_id);
		$this->db->update('booking_apartment',$review_status);
		
	}
	public function update_review_to_stop_host($key,$booking_apartment_id){
		$this->db->where('vid', $key);
		$this->db->delete('reviews_host');
		
		$review_status = array(
           'review_host_status' => 1
        );
	  	$this->db->where('ID', $booking_apartment_id);
		$this->db->update('booking_apartment',$review_status);
		
	}
	public function update_review_to_stop_guest($key,$booking_apartment_id){
		$this->db->where('vid', $key);
		$this->db->delete('reviews_guest');
		
		$review_status = array(
           'review_guest_status' => 1
        );
	  	$this->db->where('ID', $booking_apartment_id);
		$this->db->update('booking_apartment',$review_status);
		
	}
	 public function get_apartment_data($id){
		 $this->db->select('*');
		$this->db->from('booking_apartment');
		$this->db->where('ID',$id);
		
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() == '' )
		{
		   return '';   
		}
		else
		{
		  return $query->row(); 
		  
		  
		}
    }
	 public function get_verfication_data($id, $user_type){
		 $this->db->select('*');
		$this->db->from('user_verifications');
		$this->db->where('user_id',$id);
		$this->db->where('user_type',$user_type);
		
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() == '' )
		{
		   return '';   
		}
		else
		{
		  return $query->row(); 
		  
		  
		}
    }
	
	public function updatereview_data($review){

		$this->db->insert('reviews_user_data',$review);
	}
	public function updatereview_data_host($review){

		$this->db->insert('reviews_host_data',$review);
	}
	public function updatereview_data_guest($review){

		$this->db->insert('reviews_guest_data',$review);
	}
	
	public function getReviews($apt_id) {
		$this->db->where('property_id', $apt_id);
		$this->db->where('status', 1);
		$query = $this->db->get('reviews_user_data');
		return $query;
	}


	public function reviewsAboutYouPendingHost($user_id, $user_type) {
		$this->db->select('a.*, a.status as r_status, b.*, b.status as b2c_status');
		$this->db->from('reviews_host_data a');
		if($user_type==3)
		{
		$this->db->join('b2c b', 'a.user_id = b.user_id', 'left');
		}
		if($user_type==2)
		{
		$this->db->join('b2b b', 'a.user_id = b.agent_id', 'left');
		}
		$this->db->where('a.user_id', $user_id);
		$this->db->where('a.user_type', $user_type);
		$this->db->where('a.status', 0);

		$query = $this->db->get();
		return $query;
	}

	public function reviewsAboutYouPendingGuest($user_id, $user_type) {
		$this->db->select('a.*, a.status as r_status, b.*, b.status as b2c_status');
		$this->db->from('reviews_guest_data a');
		if($user_type==3)
		{
		$this->db->join('b2c b', 'a.user_id = b.user_id', 'left');
		}
		if($user_type==2)
		{
		$this->db->join('b2b b', 'a.user_id = b.agent_id', 'left');
		}
		$this->db->where('a.host_id', $user_id);
		$this->db->where('a.host_type', $user_type);
		$this->db->where('a.status', 0);

		$query = $this->db->get();
		return $query;
	}

	public function reviewsAboutYouAcceptedHost($user_id, $user_type) {
		$this->db->select('a.*, a.status as r_status, b.*, b.status as b2c_status');
		$this->db->from('reviews_host_data a');
		if($user_type==3)
		{
		$this->db->join('b2c b', 'a.user_id = b.user_id', 'left');
		}
		if($user_type==2)
		{
		$this->db->join('b2b b', 'a.user_id = b.agent_id', 'left');
		}
		$this->db->where('a.user_id', $user_id);
		$this->db->where('a.user_type', $user_type);
		$this->db->where('a.status', 1);

		$query = $this->db->get();

		return $query;
	}

	public function reviewsAboutYouAcceptedGuest($user_id, $user_type) {
		$this->db->select('a.*, a.status as r_status, b.*, b.status as b2c_status');
		$this->db->from('reviews_guest_data a');
		if($user_type==3)
		{
		$this->db->join('b2c b', 'a.user_id = b.user_id', 'left');
		}
		if($user_type==2)
		{
		$this->db->join('b2b b', 'a.user_id = b.agent_id', 'left');
		}
		$this->db->where('a.host_id', $user_id);
		$this->db->where('a.host_type', $user_type);
		$this->db->where('a.status', 1);

		$query = $this->db->get();
		return $query;
	}

	public function reviewAboutYouHostStatus($reviews_host_data_id, $status) {
		$data = array('status'=>$status);
		$this->db->where('reviews_host_data_id', $reviews_host_data_id);

		$this->db->update('reviews_host_data', $data);
		return true;
	}

	public function reviewAboutYouGuestStatus($reviews_guest_data_id, $status) {
		$data = array('status'=>$status);
		$this->db->where('reviews_guest_data_id', $reviews_guest_data_id);

		$this->db->update('reviews_guest_data', $data);
		return true;
	}

	public function reviewAboutPropStatus($reviews_user_data_id, $status) {
		$data = array('status'=>$status);
		$this->db->where('reviews_user_data_id', $reviews_user_data_id);

		$this->db->update('reviews_user_data', $data);
		return true;
	}

	public function reviewsAboutPropPending($user_id, $user_type) {
		$this->db->select('a.*, b.*');
		$this->db->from('reviews_user_data a');
		if($user_type==3)
		{
		$this->db->join('b2c b', 'a.user_id = b.user_id', 'left');
		}
		if($user_type==2)
		{
		$this->db->join('b2b b', 'a.user_id = b.agent_id', 'left');
		}
		$this->db->where('a.host_id', $user_id);
		$this->db->where('a.host_type', $user_type);
		$this->db->where('a.status', 0);

		$query = $this->db->get();
		return $query;
	}

	public function reviewsAboutPropAccepted($user_id, $user_type) {
		$this->db->select('a.*, b.*');
		$this->db->from('reviews_user_data a');
		if($user_type==3)
		{
			$this->db->join('b2c b', 'a.user_id = b.user_id', 'left');
		}
		if($user_type==2)
		{
			$this->db->join('b2b b', 'a.user_id = b.agent_id', 'left');
		}
		$this->db->where('a.host_id', $user_id);
		$this->db->where('a.host_type', $user_type);
		$this->db->where('a.status', 1);
		
		$query = $this->db->get();
		return $query;
	}


/*User profile reviews*/
	public function get_reviews_about_you($user_id, $user_type){
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type', $user_type);
		$this->db->where('status', 1);		
		return $this->db->get('reviews_host_data');
	}
	
	public function get_reviews_about_you_guest($user_id, $user_type, $limit=null) {

		$this->db->where('host_id', $user_id);
		$this->db->where('host_type', $user_type);
		$this->db->where('status', 1);
		
		if($limit != "" && !empty($limit)) {
			$this->db->limit($limit);
		}
		return $this->db->get('reviews_guest_data');	
	}

	public function get_reviews_about_prop($b2c_id){
		$this->db->where('host_id', $b2c_id);
		$this->db->where('status', 1);
		return $this->db->get('reviews_user_data');
	}

	public function getUserReviews($user_id, $user_type, $limitFrom = NULL, $totalResult = NULL){
		$this->db->select('a.*, b.*');
		$this->db->from('reviews_host_data a');
		if($user_type==3)
		{
		$this->db->join('b2c b', 'a.user_id = b.user_id', 'left');
		}
		if($user_type==2)
		{
		$this->db->join('b2b b', 'a.user_id = b.agent_id', 'left');
		}
		$this->db->where('a.user_id', $user_id);
		$this->db->where('a.user_type', $user_type);
		$this->db->where('a.status', 1);

		if(!is_null($limitFrom) && !is_null($totalResult)) {
			$this->db->limit($totalResult, $limitFrom);	
		}
		return $this->db->get();
	}

	public function getGuestReview($b2c_id,$user_type, $limitFrom = NULL, $totalResult = NULL) {
		$this->db->select('a.*, b.*');
		
		$this->db->from('reviews_guest_data a');
		if($user_type==3)
		{
		$this->db->join('b2c b', 'a.user_id = b.user_id', 'left');
		}
		if($user_type==2)
		{
		$this->db->join('b2b b', 'a.user_id = b.agent_id', 'left');
		}
		$this->db->where('a.host_id', $b2c_id);
		$this->db->where('a.status', 1);

		if(!is_null($limitFrom) && !is_null($totalResult)) {
			$this->db->limit($totalResult, $limitFrom);	
		}
		return $this->db->get();	
	}


}

