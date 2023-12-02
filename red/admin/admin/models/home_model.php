<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_Model extends CI_Model {

    public function __construct() {


        parent::__construct();
    }

    public function validate_credentials($loginEmailId, $loginPassword) {


        $this->db->select('*')
                ->from('admin_info')
                ->where('login_email', $loginEmailId)
                ->where('login_password', md5($loginPassword))
                ->where('role_id !=', 3)
                ->where('status', 1)
                ->limit(1);


        $query = $this->db->get();





        if ($query->num_rows > 0) {


            return $query->row();
        }





        return false;
    }

    public function insert_login_activity() {


        $admin_id = $this->session->userdata('admin_id');


        $session_id = $this->session->userdata('session_id');


        $ip_address = $this->session->userdata('ip_address');


        $user_agent = $this->session->userdata('user_agent');


        $remote_ip = $_SERVER['REMOTE_ADDR'];





        $data = array('history_id'=>1,'session_id' => $session_id,
            'admin_id' => $admin_id,
            'ip_address' => $ip_address,
            'remote_ip' => $remote_ip,
            'user_agent' => $user_agent
        );





        if ($this->db->insert('admin_login_history', $data)) {


            return true;
        } else {


            return false;
        }
    }

    public function get_admin_info($admin_id) {


        $this->db->select('*')
                ->from('admin_info')
                ->where('admin_id', $admin_id)
                ->where('status', 1)
                ->limit(1);


        $query = $this->db->get();





        if ($query->num_rows > 0) {


            return $query->row();
        }


        return false;
    }

    public function update_admin_profile($login_email, $title, $first_name, $middle_name, $last_name, $mobile_no, $address, $pin_code, $city, $state) {





        $data = array(
            'login_email' => $login_email,
            'title' => $title,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'mobile_no' => $mobile_no,
            'address' => $address,
            'pin_code' => $pin_code,
            'city' => $city,
            'state' => $state
        );





        $admin_id = $this->session->userdata('admin_id');


        $where = "admin_id = '$admin_id'";





        if ($this->db->update('admin_info', $data, $where)) {


            return true;
        } else {


            return false;
        }
    }

    public function update_admin_password($admin_id, $password = '') {


        if (!empty($password)) {


            $data['login_password'] = $password;


            $where = "admin_id = '$admin_id'";


            if ($this->db->update('admin_info', $data, $where)) {


                return true;
            } else {


                return false;
            }
        } else {


            return false;
        }
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

    public function get_currency_list() {


        $this->db->select('*')
                ->from('currency');


        $query = $this->db->get();





        if ($query->num_rows > 0) {


            return $query->result();
        }





        return false;
    }

    public function manage_currency_status($currency_id, $status) {


        $data['status'] = $status;


        $where = "currency_id = '$currency_id'";


        if ($this->db->update('currency', $data, $where)) {


            return true;
        } else {


            return false;
        }
    }

    public function update_currency_values($currency_id, $currency_val) {


        $data['value'] = $currency_val;


        $where = "currency_id = '$currency_id'";


        $this->db->set('updated_datetime', 'Now()', FALSE);


        if ($this->db->update('currency', $data, $where)) {


            return true;
        } else {


            return false;
        }
    }

    public function get_hotel_apis() {


        $this->db->select('*')
                ->from('api_info')
                ->where('service_type', 1);


        $query = $this->db->get();





        if ($query->num_rows > 0) {


            return $query->result();
        }





        return false;
    }

    public function get_flight_apis() {


        $this->db->select('*')
                ->from('api_info')
                ->where('service_type', 2);


        $query = $this->db->get();





        if ($query->num_rows > 0) {


            return $query->result();
        }





        return false;
    }

    public function get_car_apis() {


        $this->db->select('*')
                ->from('api_info')
                ->where('service_type', 3);


        $query = $this->db->get();





        if ($query->num_rows > 0) {


            return $query->result();
        }





        return false;
    }

    public function manage_api_status($api_id, $status) {


        $data['status'] = $status;


        $where = "api_id = '$api_id'";


        if ($this->db->update('api_info', $data, $where)) {


            return true;
        } else {


            return false;
        }
    }

    public function get_payment_gateway_charges() {


        $this->db->select('*')
                ->from('payment_gateway');


        $query = $this->db->get();





        if ($query->num_rows > 0) {


            return $query->result();
        }





        return false;
    }

    public function manage_payment_charge_status($id, $status) {


        $data['status'] = $status;


        $where = "id = '$id'";


        if ($this->db->update('payment_gateway', $data, $where)) {


            return true;
        } else {


            return false;
        }
    }

    public function get_payment_charge($id) {


        $this->db->select('*')
                ->from('payment_gateway')
                ->where('id', $id);


        $query = $this->db->get();





        if ($query->num_rows > 0) {


            return $query->row();
        }


        return false;
    }

    public function update_payment_charge($id, $charge) {


        $data['charge'] = $charge;


        $where = "id = '$id'";


        if ($this->db->update('payment_gateway', $data, $where)) {


            return true;
        } else {


            return false;
        }
    }

    public function get_api_list() {


        $this->db->select('*')
                ->from('api_info')
                ->where('status', 1);


        $query = $this->db->get();





        if ($query->num_rows > 0) {


            return $query->result();
        }





        return false;
    }

    public function get_api_list_by_service($service_type) {


        $this->db->select('*')
                ->from('api_info')
                ->where('service_type', $service_type)
                ->where('status', 1);


        $query = $this->db->get();





        if ($query->num_rows > 0) {


            return $query->result();
        }





        return false;
    }

    public function get_agents_new_deposits() {


        $this->db->select('*')
                ->from('agent_deposit_summary')
                ->where('status', 'Pending')
                ->order_by('transaction_datetime', 'DESC');


        $query = $this->db->get();





        if ($query->num_rows > 0) {


            return $query->result();
        }





        return false;
    }

    public function get_new_booking_request() {


        //$sql = "select count(report_id) as total from flight_booking_reports where Booking_Date between NOW() â€“ INTERVAL DAYOFWEEK(NOW())+3 DAY AND NOW() â€“ INTERVAL DAYOFWEEK(NOW())-1 DAY";


        $this->db->select('count(report_id) as total')
                ->from('flight_booking_reports')
                ->where('Booking_Date >=', '( DATE(NOW()) - INTERVAL 3 DAY + INTERVAL 0 SECOND )');





        $query = $this->db->get();





        if ($query->num_rows > 0) {


            $res = $query->row();


            return $res->total;
        }





        return false;
    }

    
    function addCouponCodeData($service,$code,$price)
    {
        $this->db->query($sql="insert into coupon_codes set service='".$service."',coupon_code='".trim($code)."',amount='".$price."'");
    }
    
    function getAllCouponList()
    {
        $query = $this->db->query($sql="select * from coupon_codes where 1 order by id desc");
        if($query->num_rows() > 0)
        {
            $data = $query->result();
            return $data;
        }
        else
        {
            return '';
        }
    }
    
    function getCouponDataOnId($id)
    {
        $query = $this->db->query($sql="select * from coupon_codes where id='".$id."'");
        if($query->num_rows() > 0)
        {
            $data = $query->row();
            return $data;
        }
        else
        {
            return '';
        }
    }
    
    function doCouponAction($id,$action)
    {
        if($action == '0' || $action == '1')
        {
            $this->db->query($sql="update coupon_codes set status='".$action."' where id='".$id."'");
        }
        if($action == '2')
        {
            $this->db->query($sql="delete from coupon_codes where id='".$id."'");
        }
    }
    
    function add_staff_info($role_id,$login_email, $password, $title, $first_name, $last_name, $mobile_no, $address)
    {
        $this->db->query($sql = "insert into admin_info set role_id='".$role_id."',login_email='".$login_email."',login_password='".md5(mysql_real_escape_string($password))."',title='".$title."',first_name='".mysql_real_escape_string($first_name)."',last_name='".mysql_real_escape_string($last_name)."',mobile_no='".$mobile_no."',address='".mysql_real_escape_string($address)."',status='1'");
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else return false;
    }
    
    function getAllStaffs()
    {
        $query = $this->db->query($sql = "select * from admin_info where role_id='2' order by admin_id desc");
        if($query->num_rows() > 0)
        {
            $res = $query->result();
        }
        else
        {
            $res = '';
        }
        
        return $res;
    }
	
}
