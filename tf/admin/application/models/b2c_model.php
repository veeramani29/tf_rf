<?php

class B2c_Model extends CI_Model {

    public function __construct() {

        parent::__construct();
    }


  public function get_user_list_old() {

        $this->db->select('b2c.*,user_verifications.email as v_email, user_verifications.mobile as v_mobile, payment_method.Bank as bank_details, payment_method.Paypal as paypal_details')
                ->from('b2c')
                 ->where('user_verifications.user_type','3')
                ->join('user_verifications', 'user_verifications.user_id  = b2c.user_id', 'left')
                ->join('payment_method', 'payment_method.user_id = b2c.user_id AND payment_method.user_type = b2c.usertype', 'left');
        $query = $this->db->get();

       // echo $this->db->last_query();

        if ($query->num_rows > 0) {

            return $query->result();
        }
        return false;
    }

    public function get_user_list() {

        $this->db->select('*')
                ->from('b2c');
				// ->where('user_verifications.user_type','3')
                //->join('user_verifications', 'user_verifications.user_id  = b2c.user_id', 'left')
               // ->join('payment_method', 'payment_method.user_id = b2c.user_id AND payment_method.user_type = b2c.usertype', 'left');
        $query = $this->db->get();

       // echo $this->db->last_query();

        if ($query->num_rows > 0) {

            return $query->result();
        }
        return false;
    }
public function checkTwoStepVerification($user_id,$user_type) {
		$where = "user_type = '".$user_type."' AND user_id = ".$user_id." AND two_step_verification = '1'";
		$this->db->where($where);
		$query_output = $this->db->get('user_verifications');

		if($query_output->num_rows() > 0) {
			return $query_output->row(); 
		} else {
			return false;
		}
		
	}
    public function get_user_domian_list($domain_id) {

        $this->db->select('*')->from('b2c')->join('domain', 'domain.domain_id  = b2c.domain', 'left');
        $this->db->where('b2c.domain', $domain_id);
        $query = $this->db->get();

        if ($query->num_rows > 0) {

            return $query->result();
        }
        return false;
    }

    public function get_user_list_id($id) {

        $this->db->select('*')
                ->from('b2c')
                ->where('user_id', $id)
                ->join('domain', 'domain.domain_id  = b2c.domain', 'left');
        $query = $this->db->get();

        if ($query->num_rows > 0) {

            return $query->row();
        }
        return false;
    }
	  public function view_payment_method($id) {

        $this->db->select('*')
                ->from('payment_method')
                ->where('user_id', $id)->where('user_type', '3')
              ;
        $query = $this->db->get();

        if ($query->num_rows > 0) {

            return $query->row();
        }
		else
		{
        return '';
		}
    }
 public function get_user_list_id_owner($id) {

        $this->db->select('*')
                ->from('b2c')
                ->where('user_id', $id)
               ->where('property_owner_created', '0');
        $query = $this->db->get();

        if ($query->num_rows > 0) {

            return $query->row();
        }
		else
		{
        return '';
		}
    }
    function update_b2c_user($id, $sal, $fnam, $mnam,$lname, $address, $phone, $city, $country, $postal, $domain) {

        $data = array(
            'title' => $sal,
            'firstname' => $fnam,
            'middlename' => $mnam,
            'lastname' => $lname,
            'address' => $address,
            'contact_no' => $phone,
            'city' => $city,
            'country' => $country,
            'postal_code' => $postal,
            'domain' => $domain
        );



        $where = "user_id = " . $id;
        if ($this->db->update('b2c', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    function update_user_status($id, $status) {

        $data = array(
            'status' => $status
        );
        $where = "user_id = " . $id;
        if ($this->db->update('b2c', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    function get_user_support_ticket($id) {

        $this->db->select('support_ticket_id')
                ->from('support_ticket')->where('user_id', $id)->where('user_type', '3');
        $query = $this->db->get();

        if ($query->num_rows > 0) {

            return $query->result();
        }
        return false;
    }

    function get_promo_code_id($id) {
        $this->db->select('*')
                ->from('promo')->where('promo_id', $id);
        $query = $this->db->get();

        if ($query->num_rows > 0) {

            return $query->row();
        }
        return false;
    }

    public function get_promo_list() {
        
 $qry="SELECT * FROM promo WHERE exp_date >= CURDATE() ";
            $data=$this->db->query($qry);
       
       

        if ($data->num_rows > 0) {

            return $data->result();
        }
        return false;
    }

    public function get_country_list() {

        $this->db->select('*')
                ->from('country');
        $query = $this->db->get();

        if ($query->num_rows > 0) {

            return $query->result();
        }
        return false;
    }

    function add_b2c_user($sal, $fnam, $lname, $pw3, $email3, $address, $phone, $city, $country, $postal, $domain, $image_path) {
        $data = array(
            'title' => $sal,
            'firstname' => $fnam,
            'lastname ' => $lname,
            'password' => $pw3,
            'email' => $email3,
            'address' => $address,
            'contact_no' => $phone,
            'city' => $city,
            'country' => $country,
            'postal_code' => $postal,
            'domain' => $domain,
            'profile_photo' => $image_path,
            'usertype' => '3',
            'status' => '1',
            'last_visit_date' => ''
        );

        $this->db->set('register_date', 'NOW()', FALSE);

        $this->db->insert('b2c', $data);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            return true;
        } else {
            return false;
        }
    }

    /* Notification */

    function insert_notification_value($nodeval, $domain) {

        $data = array(
            'note_value' => $nodeval,
            'domain' => $domain,
            'status' => '1'
        );

        $this->db->set('date', 'NOW()', FALSE);

        $this->db->insert('notification', $data);
        return $this->db->insert_id();
    }

    function insert_user_value($userid, $usertype, $noteid) {
        $data = array(
            'user_id' => $userid,
            'user_type' => $usertype,
            'notification_id' => $noteid
        );

        $this->db->insert('notification_user_detail', $data);
        return;
    }

    function b2c_users($domain_id) {
        $this->db->select('count(1) as count');
        $this->db->from('b2c');
        if (!empty($domain_id)) {
            $this->db->where('domain', $domain_id);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function export_b2c_users($ids) {
        $this->db->where_in('user_id', $ids);
        return $this->db->get('b2c');
    }

    function export_b2c_users1($id) {
        $this->db->where('user_id', $id);
        return $this->db->get('b2c');
    }

    function export_b2kjhkh_users($value) {
        if (!empty($value)) {
            $this->load->dbutil();

            @$query = $this->db->query("SELECT usertype,twitter_id,email,firstname,lastname,address,ship_address,contact_no,city,postal_code FROM b2c where user_id='$value'");

            $delimiter = ",";
            $newline = "\r\n";

            echo $this->dbutil->csv_from_result($query, $delimiter, $newline);
        }
    }
    
    function update_b2c_onwer_create($b2c_id,$owner_id){
		$this->db->where('user_id',$b2c_id);
		$this->db->update('b2c',array('property_owner_created' => 1,'property_owner_id' => $owner_id, 'property_owner_request' => 1));
	}

}
