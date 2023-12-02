<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Message_Model extends CI_Model {

/*
** Vikas Arora 
*/
	public function getMessage($user_id, $filter = null) {
		$this->db->select('a.*, b.*, c.*, d.booking_status, e.firstname as b2b_name');
		$this->db->from('user_messages a');
		$this->db->join('b2c b', 'a.init_user_id = b.user_id', 'left');
		$this->db->join('b2b e', 'a.init_user_id = e.agent_id', 'left');
		$this->db->join('kigo_properties c', 'c.PROPERTY_ID = a.property_id', 'left');
		$this->db->join('booking_global d', 'd.pnr_no = a.booking_id', 'left');
		$this->db->where('a.receiver_id', $user_id);
		$this->db->group_by('a.message_id');

		if($filter == 1) {
			$this->db->where('a.archive', 0);
		}

		if($filter != "") {
			switch($filter) {
				case 1:
					$this->db->where('a.archive', 0);
					break;
				case 2:
					break;
				case 3:
					$this->db->where('a.starred', 1);
					break;
				case 4:
					$this->db->where('a.msg_read', 0);
					break;
				case 5:
					$this->db->where('a.archive', 1);
					break;
				default:
					break;
			}
		}
		$this->db->order_by('id','desc'); 
		return $this->db->get();
	}

	public function strStar($user_id, $msg_id) {
		/*this toggle query gives error when using codeigniter syntax*/
		$strStar_query = "UPDATE user_messages SET starred = 1-starred WHERE receiver_id = $user_id AND message_id = '$msg_id'";		
		$this->db->query($strStar_query);
		
		return true;
	}

	public function strArchive($user_id, $msg_id) {
		/*this toggle query gives error when using codeigniter syntax*/
		$strStar_query = "UPDATE user_messages SET archive = 1-archive WHERE receiver_id = $user_id AND message_id = '$msg_id'";		
		$this->db->query($strStar_query);
		
		return true;
	}

	public function getConversation($sender_id, $receiver_id, $message_id) {
		$this->db->where('message_id', $message_id);
		$this->db->order_by('msg_date_time', 'desc');

		$query = $this->db->get('user_messages');
		$query_result =  $query->result();

		return $query_result;
	}

	public function convUserSenderInfo($sender_id) {
		$this->db->select('*');
		$this->db->from('b2c');
		$this->db->where('user_id', $sender_id);

		$query = $this->db->get();
		$query_result = $query->row();

		return $query_result;
	}

	public function convUserSenderInfoB2b($sender_id) {
		$this->db->select('*');
		$this->db->from('b2b');
		$this->db->where('agent_id', $sender_id);

		$query = $this->db->get();
		$query_result = $query->row();

		return $query_result;
	}

	public function convUserReceiverInfo($receiver_id) {
		$this->db->select('*');
		$this->db->from('b2c');
		$this->db->where('user_id', $receiver_id);

		$query = $this->db->get();
		$query_result = $query->row();

		return $query_result;
	}

	public function convUserReceiverInfoB2b($receiver_id) {
		$this->db->select('*');
		$this->db->from('b2b');
		$this->db->where('agent_id', $receiver_id);

		$query = $this->db->get();
		$query_result = $query->row();

		return $query_result;
	}

	public function msgCheckingTime($msg_id) {
		$this->db->select('check_in, check_out');
		$this->db->from('user_messages');
		$this->db->where('message_id', $msg_id);
		$this->db->limit(1);

		$query = $this->db->get();
		$query_row = $query->row();
		return $query_row;
	}

	public function getPropertyDetail($prop_id) {
		$this->db->select('PROP_NAME');
		$this->db->from('kigo_properties');
		$this->db->where('PROPERTY_ID', $prop_id);

		$query = $this->db->get();
		$query_row = $query->row();
		return $query_row;

	}


	public function storeConversation($data) {
		$this->db->insert('user_messages', $data);
		return true;
	}

	public function insertMessage($data){
		$this->db->insert('user_messages', $data);
		return true;
	}

	public function checkMessageHistory($message_id) {
		$this->db->where('message_id', $message_id);

		$query = $this->db->get('user_message_history');
		return $query;
	}

	public function addMsgHistory($data) {
		$this->db->insert('user_message_history', $data);
		return true;
	}

	public function getMsgHistory($user_id) {
		$this->db->where('host_id', $user_id);
		$query = $this->db->get('user_message_history');
		return $query;
	}

	public function getAllRepliedMail($user_id) {
		$this->db->select('a.*');
		$this->db->from('user_messages a');
		$this->db->where('init_receiver_id', $user_id);
		$this->db->where('`a`.`sender_id` = `a`.`init_receiver_id`');
		$this->db->group_by('message_id');

		$query = $this->db->get();
		return $query;
	}

	public function getAllReceivedMail($user_id) {
		$this->db->select('*');
		$this->db->from('user_messages a');
		$this->db->where('init_receiver_id', $user_id);
		$this->db->group_by('message_id');

		$query = $this->db->get();
		return $query;
	}

}