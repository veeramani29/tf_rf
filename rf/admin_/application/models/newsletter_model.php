<?php

class Newsletter_Model extends CI_Model {
	
	public function __construct() {
      	parent::__construct();
      	
    }

    public function get_all_newsletter_list() {
    	$this->db->select('*');
        $this->db->from('newsletter_templates');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function fetch_newsletter_template($id) {
        $this->db->select('template_content');
        $this->db->from('newsletter_templates');
        $this->db->where('id', $id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }

    public function save_newsletter($data) {
        $this->db->insert('newsletter_templates', $data);
        return true;
    }

    public function change_newsletter_status($id, $status) {
        $this->db->where('id', $id);

        $this->db->update('newsletter_templates', array('template_status' => $status));
        return true;
    }

    public function delete_newsletter($id) {
        $this->db->where('id', $id);
        $this->db->delete('newsletter_templates');
        return true;
    }

    public function get_single_newsletter_details($id) {
        $this->db->select('*');
        $this->db->from('newsletter_templates');
        $this->db->where('id', $id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }

    public function update_newsletter($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('newsletter_templates', $data);
        return true;
    }

    public function get_all_campaign_list() {
        $this->db->select('*');
        $this->db->from('campaign_data');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function fetch_campaign_template($id) {
        $this->db->select('campaign_template');
        $this->db->from('campaign_data');
        $this->db->where('id', $id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }

    public function get_single_campaign_details($id) {
        $this->db->select('*');
        $this->db->from('campaign_data');
        $this->db->where('id', $id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }

    public function add_campaign($id, $data) {
        $this->db->insert('campaign_data', $data);
        return true;
    }

    public function update_campaign($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('campaign_data', $data);
        return true;
    }

    public function delete_campaign($id) {
        $this->db->where('id', $id);
        $this->db->delete('campaign_data');
        return true;
    }
    
   public function get_all_subscribers(){
	$this->db->select('*');
        $this->db->from('newsletter_subscriber');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
   }

   public function unregistered_deleteSubscriber($id) {
        $this->db->where('id', $id);
        $this->db->delete('newsletter_subscriber');
    }

    public function get_b2c_subscribers(){
        $this->db->select('user_id, email');
        $this->db->from('b2c');
        $this->db->where('newsletter_subscribe', '1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
   }

   public function b2c_deleteSubscriber($id) {
        $update_array = array('newsletter_subscribe'=>0);
        $this->db->where('user_id', $id);
        $this->db->update('b2c', $update_array);
        return true;
    }

    public function get_b2b_subscribers(){
        $this->db->select('agent_id, email_id');
        $this->db->from('b2b');
        $this->db->where('newsletter_subscribe', '1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function b2b_deleteSubscriber($id) {
        $update_array = array('newsletter_subscribe'=>0);
        $this->db->where('agent_id', $id);
        $this->db->update('b2b', $update_array);
        return true;
    }



}
