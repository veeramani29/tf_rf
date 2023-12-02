<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------|
| Author: Provab Technosoft Pvt Ltd.									   |
|--------------------------------------------------------------------------|
| Developer: Provab											   |
| Started Date: 2014-08-06T16:28:00										   |
| Ended Date:  										   					   |
|--------------------------------------------------------------------------|
*/

class Auth_Model extends CI_Model {
	public function login_auth($post,$auth_id){
		$this->db->where('facebook_id', $auth_id);
		$this->db->or_where('google_id', $auth_id);
		$this->db->or_where('twitter_id', $auth_id);
		$query = $this->db->get('b2c');
		if($query->num_rows() == 1){
			$this->db->where('facebook_id', $auth_id);
			$this->db->or_where('google_id', $auth_id);
			$this->db->or_where('twitter_id', $auth_id);
			$this->db->update('b2c',$post);
			$b2c_data = $query->row();
			return $b2c_data->user_id;
		}else{
			$this->db->insert('b2c',$post);
			return $this->db->insert_id();
		}
	}

	public function logout_auth($update,$user_id,$user_type){
		if($user_type == '3'){
			$this->db->where('user_id', $user_id);
            $this->db->update('b2c',$update);
        }else if($user_type == '2'){
        	$this->db->where('agent_id', $user_id);
            $this->db->update('b2b',$update);
        }
	}

	public function check_islogged_in($b2c_id){
		$this->db->where('user_id', $b2c_id);
		$query = $this->db->get('b2c');
		$b2c_data = $query->row();
		return $b2c_data->logged_in;
	}

	public function getUserData($b2c_id){
		$this->db->where('user_id', $b2c_id);
		return $this->db->get('b2c')->row();
	}

	public function isRegistered($email){
		$this->db->where('email', $email);
		return $this->db->get('b2c');
	}

	public function update_login_auth($update,$auth_id,$email){
		$this->db->where('email', $email);
		$this->db->update('b2c',$update);
	}

}

