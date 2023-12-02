<?php

class B2B_Model extends CI_Model {

    public function __construct() {

        parent::__construct();
    }

    public function get_agent_list() {
        //$select = "SELECT a.*, i.balance_credit FROM agent a left join agent_acc_info i on i.agent_id = a.agent_id where agent_type = 2 $where";
        $this->db->select('b2b.*,domain.*,b2b_acc_info.balance_credit, payment_method.Bank as bank_details, payment_method.Paypal as paypal_details')
                ->from('b2b')
                ->join('domain', 'domain.domain_id  = b2b.domain', 'left')
                ->join('b2b_acc_info', 'b2b_acc_info.agent_id  = b2b.agent_id', 'left')
                ->join('payment_method', 'payment_method.user_id = b2b.agent_id AND payment_method.user_type = 2', 'left');
        $query = $this->db->get();




        if ($query->num_rows > 0) {

            return $query->result();
        }
        return false;
    }

    public function get_agentuser_domian_list($domain_id) {
        //$select = "SELECT a.*, i.balance_credit FROM agent a left join agent_acc_info i on i.agent_id = a.agent_id where agent_type = 2 $where";
        $this->db->select('b2b.*,domain.*,b2b_acc_info.balance_credit, payment_method.Bank as bank_details, payment_method.Paypal as paypal_details')
                ->from('b2b')
                ->join('domain', 'domain.domain_id  = b2b.domain', 'left')
                ->join('b2b_acc_info', 'b2b_acc_info.agent_id  = b2b.agent_id', 'left')
                ->join('payment_method', 'payment_method.user_id=b2b.agent_id AND payment_method.user_type = 2', 'left');
        $this->db->where('b2b.domain', $domain_id);
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

        $this->db->select('*')
                ->from('promo');
        $query = $this->db->get();

        if ($query->num_rows > 0) {

            return $query->result();
        }
        return false;
    }

    public function get_agent_list_id($id) {

        $this->db->select('*')
                ->from('b2b')
                ->where('agent_id', $id)
                ->join('domain', 'domain.domain_id  = b2b.domain', 'left');
                
        $query = $this->db->get();

        if ($query->num_rows > 0) {

            return $query->row();
        }
        return false;
    }
    public function get_agent_log_details($id) {

        $this->db->select('*')
                ->from('user_failed_verifications')
                ->where('user_id', $id)	;
        $query = $this->db->get();

        if ($query->num_rows > 0) {

            return $query->result();
        }
        return false;
    }
    function get_agent_support_ticket($id) {

        $this->db->select('support_ticket_id')
                ->from('support_ticket')->where('user_id', $id)->where('user_type', '2');
        $query = $this->db->get();

        if ($query->num_rows > 0) {

            return $query->result();
        }
        return false;
    }

    public function get_deposit_amount($id) {

        $this->db->select('*')
                ->from('b2b_acc_info')
                ->where('agent_id', $id);

        $query = $this->db->get();

        /*  $this->db->where('status', 'Accepted');
          $this->db->where('agent_id', $id);
          $this->db->select_sum('amount_credit');
          $query = $this->db->get('b2b_deposit');
         */
        if ($query->num_rows > 0) {

            return $query->row();
        }
        return false;
    }

    function update_agent_password($npass, $id) {
        $data = array(
            'password' => $npass
        );
        $where = "agent_id = " . $id;
        $this->db->update('b2b', $data, $where);
        return true;
    }

    function add_agent_user($sal, $company, $office, $pw3, $email3, $address, $phone, $city, $country, $postal, $domain, $image_path) {
        $data = array(
            'name' => $sal,
            'company_name' => $company,
            'office_phone' => $office,
            'password' => $pw3,
            'email_id' => $email3,
            'address' => $address,
            'mobile' => $phone,
            'city' => $city,
            'country' => $country,
            'postal_code' => $postal,
            'domain' => $domain,
            'agent_logo' => $image_path,
            'agent_type' => '2',
            'status' => '1',
            'last_visit_date' => ''
        );

        $this->db->set('register_date', 'NOW()', FALSE);

        $this->db->insert('b2b', $data);
        $id = $this->db->insert_id();
        if (!empty($id)) {

            $data12 = array(
                'agent_id' => $id,
                'balance_credit' => 0.00,
                'last_credit' => 0.00
            );

            $this->db->insert('b2b_acc_info', $data12);
            $this->db->insert_id();

            $city_array = array(198, 844, 4977, 4073, 337, 2087, 481, 5770, 3621, 4239, 3131, 3850, 435, 1753, 3257, 4443, 481, 5770, 3621, 4239);
            $data1 = array();
            for ($k = 0; $k < 16; $k++) {
                $data1 = array(
                    'agent_id' => $id,
                    'citi_id' => $city_array[$k],
                );

                $this->db->insert('b2b_top_cities', $data1);
                $this->db->insert_id();
            }
            return true;
        } else {
            return false;
        }
    }

    function update_agent_status($id, $status) {

        $data = array(
            'status' => $status
        );



        $where = "agent_id = " . $id;
        if ($this->db->update('b2b', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    function update_b2b_agent($id, $name, $address, $phone, $city, $country, $postal, $domain, $company, $office) {
        $data = array(
            'name' => $name,
            'company_name' => $company,
            'office_phone' => $office,
            'address' => $address,
            'mobile' => $phone,
            'city' => $city,
            'country' => $country,
            'postal_code' => $postal,
            'domain' => $domain
        );



        $where = "agent_id = " . $id;
        if ($this->db->update('b2b', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

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

    function insert_agent_value($userid, $usertype, $noteid) {
        $data = array(
            'user_id' => $userid,
            'user_type' => $usertype,
            'notification_id' => $noteid
        );

        $this->db->insert('notification_user_detail', $data);
        return;
    }

    function b2b_users($domain_id) {
        $this->db->select('count(1) as count');
        $this->db->from('b2b');
        if (!empty($domain_id)) {
            $this->db->where('domain', $domain_id);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function export_b2b_users($ids) {
        $this->db->where_in('agent_id', $ids);
        return $this->db->get('b2b');
    }

    function update_b2b_onwer_create($b2b_id,$owner_id) {
        $this->db->where('agent_id', $b2b_id);
        $this->db->update('b2b', array('property_owner_created' => 1,'property_owner_id' => $owner_id, 'property_owner_request' => 1));
    }

}
