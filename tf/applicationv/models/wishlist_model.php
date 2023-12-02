<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
* Created by Vikas Arora
* maintains wishlist data
*/


class Wishlist_Model extends CI_Model {

	public function createWishlistNode($user_id, $user_type, $nodeName, $privacy=null) {
		$data = array('domain'=>1, 'user_type'=>$user_type, 'user_id'=>$user_id, 'wishlist_type_name'=>$nodeName, 'privacy'=>$privacy);
		$this->db->insert('wishlist_type', $data);
		return true;
	}

	public function getAllWishlist($user_id, $user_type) {
		$this->db->select('a.*, b.*, c.*');
		$this->db->from('wishlist_type a');
		$this->db->join('(SELECT wishlist_type_id as wish_id, product_id, count(*) as counter from wishlist group by wishlist_type_id) b','a.wishlist_type_id = b.wish_id' , 'left');
		$this->db->join('(SELECT PROP_ID, PHOTO_CONTENT FROM kigo_properties_photo group by PROP_ID) c ', 'b.product_id = c.PROP_ID', 'left');
		$this->db->where('a.user_id', $user_id);
		$this->db->where('a.user_type', $user_type);
		$this->db->order_by('user_delete_access', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function addWish($data) {
		$this->db->insert('wishlist', $data);
		return true;
	}

	public function saveEditedWishlist($user_id, $user_type, $wishlistid, $wishlistName, $wishlistPrivacy) {
		$data = array('wishlist_type_name'=>$wishlistName, 'privacy'=>$wishlistPrivacy);
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type', $user_type);
		$this->db->where('wishlist_type_id', $wishlistid);
		$this->db->update('wishlist_type', $data);
		return true;
	}

	public function doesWishlistExist($user_id, $user_type, $wishlist_type_id, $product_id) {
		$this->db->select("*");
		$this->db->from("wishlist");
		$this->db->where("user_id", $user_id);
		$this->db->where("user_type", $user_type);
		$this->db->where("wishlist_type_id", $wishlist_type_id);
		$this->db->where("product_id", $product_id);

		$query = $this->db->get();
		return $query;
	}

	public function getAddedWishlist($user_id, $user_type) {
		$this->db->select("*");
		$this->db->from("wishlist");
		$this->db->where("user_id", $user_id);
		$this->db->where("user_type", $user_type);
		$this->db->group_by("product_id");
		
		$query = $this->db->get();
		return $query;
	}

	public function getWishListing($user_id, $data) {
		$list_count_array = array();
		foreach($data as $data_key) {
			$this->db->select('wishlist_type_id, count(*) as listing_count ');
			$this->db->from('wishlist');
			$this->db->where('wishlist_type_id', $data_key->wishlist_type_id);

			$query = $this->db->get()->result();
			array_push($list_count_array, $query);
		} 
		return $list_count_array;
	}

	public function getUserBasedWishlist($user_id, $user_type, $wishlist_id) {
		$this->db->select("a.*, b.*");
		$this->db->from("wishlist a");
		$this->db->join("kigo_properties b", "a.product_id = b.PROPERTY_ID", "left");
		$this->db->where('a.user_id', $user_id);
		$this->db->where('a.user_type', $user_type);
		$this->db->where('wishlist_type_id', $wishlist_id);

		$query = $this->db->get();
		return $query;
	}

	public function userInfo($user_id) { // Not used.. only for the sake of avoiding error ..if it exists
		$this->db->select("*");
		$this->db->from("b2c");
		$this->db->where("user_id", $user_id);

		$query = $this->db->get()->row();
		return $query;
	}

	public function removeWish($user_id, $data) {
		$this->db->delete('wishlist', $data);
		return true;
	}

	public function countWishlist($user_id) {
		$this->db->select("*");
		$this->db->from("wishlist_type");
		$this->db->where("user_id", $user_id);

		$query = $this->db->get()->num_rows();
		return $query;
	}

	public function assignDefaultWishlist($user_id, $user_type) {
		$data = array('domain'=>1, 'user_type'=>$user_type, 'user_id'=>$user_id, 'wishlist_type_name'=>'Dream Places', 'privacy'=>0, 'user_delete_access'=> '1');
		$this->db->insert('wishlist_type', $data);
		return true;
	}

/*Used in users public profile to grab public wishlist*/
	public function getPublicWishlist($user_id, $user_type) {
		$this->db->select('a.*, b.*');
		$this->db->from('wishlist_type a');
		$this->db->join('(SELECT wishlist_type_id as wish_id , count(*) as counter from wishlist group by wishlist_type_id) b','a.wishlist_type_id = b.wish_id' , 'left');
		$this->db->where('a.user_id', $user_id);
		$this->db->where('a.user_type', $user_type);
		$this->db->where('a.privacy', 1);
		$this->db->order_by('user_delete_access', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function isInWish($user_id, $user_type, $PROPERTY_ID) {
		$this->db->select('*');
		$this->db->from('wishlist');
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type', $user_type);
		$this->db->where('product_id', $PROPERTY_ID);

		$query = $this->db->get();
		return $query;
	}

	public function inUserWishlist($user_id, $apt_id) {
		$this->db->select('*');
		$this->db->from('wishlist');
		$this->db->where('user_id', $user_id);
		$this->db->where('product_id', $apt_id);

		$query = $this->db->get();
		return $query;
	}

	public function deleteWishlist($wishlistid) {
		$this->db->where('wishlist_type_id', $wishlistid);
		$this->db->where('user_delete_access', '0');
		$deleteWishlist = $this->db->delete('wishlist_type');
		
		if($deleteWishlist) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteWishes($wishlistId) {
		$this->db->where('wishlist_type_id', $wishlistId);
		$deleteWishes = $this->db->delete('wishlist');

		if($deleteWishes) {
			return true;
		} else {
			return false;
		}
	}

}