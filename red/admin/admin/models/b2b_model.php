<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class B2b_Model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function check_email_availability($email) {
        $this->db->select('*')
                ->from('agent_info')
                ->where('user_email', $email)
                ->limit('1');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
        return '';
    }

    public function add_user($user_email, $user_password, $title, $first_name, $middle_name, $last_name,$company_name, $mobile_no, $address, $pin_code, $city, $state, $country, $image_path) {
        
        $lastId = $this->db->query($sql = "select user_no from agent_info where user_type='1' order by user_id desc limit 0,1");
        if($lastId->num_rows() > 0)
        { 
            $user_no = $lastId->row()->user_no; 
            $ex = explode('ASFRA',$user_no);
            $user_no = ($ex[1]+1);
        }
        else $user_no = '10888';
        
        $data = array(
            'user_no' => 'ASFRA'.$user_no,
            'user_type' =>'1',
            'user_email' => $user_email,
            'user_password' => md5($user_password),
            'title' => $title,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'company_name' => $company_name,
            'mobile_no' => $mobile_no,
            'address' => $address,
            'pin_code' => $pin_code,
            'city' => $city,
            'state' => $state,
            'country' => $country,
            'user_logo' => $image_path,
            'status' => 1,
        );
        
        
        
        $this->db->set('register_date', 'NOW()', FALSE);
        $this->db->insert('agent_info', $data);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            $data = array('id'=>$id,'user_email'=>mysql_real_escape_string($user_email),'name'=>mysql_real_escape_string($company_name),'pass'=>mysql_real_escape_string($user_password));
            return $data;
        } else {
            return '';
        }
    }

    public function get_user_list() {
        $this->db->select('*')
                ->from('agent_info')->where('user_type','1');
        $this->db->order_by('user_id', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
        return false;
    }

    public function manage_user_status($user_id, $status) {
        $data['status'] = $status;
        $where = "user_id = '$user_id'";
        if ($this->db->update('agent_info', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_agent_info_by_id($user_id) {
        $this->db->select('*')
                ->from('agent_info')
                ->where('user_id', $user_id)
                ->limit('1');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $res = $query->result();
            return $res[0];
        }
        return false;
    }

    public function update_user($user_id, $title, $first_name, $middle_name, $last_name,$company_name, $mobile_no, $address, $pin_code, $city, $state, $country, $user_logo) {
        $data = array(
            'title' => $title,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'company_name' => $company_name,
            'mobile_no' => $mobile_no,
            'address' => $address,
            'pin_code' => $pin_code,
            'city' => $city,
            'state' => $state,
            'country' => $country,
            'user_logo' => $user_logo,
        );
        $this->db->where('user_id', $user_id);
        if ($this->db->update('agent_info', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function update_user_password($user_id, $password = '') {
        if (!empty($password)) {
            $data['user_password'] = $password;
            $where = "user_id = '$user_id'";
            if ($this->db->update('agent_info', $data, $where)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_hotel_markup_list() {
        $this->db->select('*')
                ->from('b2c_markup_info')
                ->where('service_type', 1);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_flight_markup_list() {
        $this->db->select('*')
                ->from('b2c_markup_info')
                ->where('service_type', 2);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_car_markup_list() {
        $this->db->select('*')
                ->from('b2c_markup_info')
                ->where('service_type', 3);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
        return false;
    }

    function delete_b2c_markup($markup_type, $service_type) {
        $where = "markup_type = '$markup_type' AND service_type = '$service_type'";
        if ($this->db->delete('b2c_markup_info', $where)) {
            return true;
        } else {
            return false;
        }
    }

    function b2c_markup_checking($country, $city, $hotel, $airline, $api_name, $markup_type, $service_type, $currency) {
        $this->db->select('*');
        $this->db->from('b2c_markup_info');
        $this->db->where('country', $country);
        if ($city != NULL) {
            $this->db->where('city', $city);
        }
        if ($hotel != NULL) {
            $this->db->where('hotel', $hotel);
        }
        if ($airline != NULL) {
            $this->db->where('airline', $airline);
        }
        $this->db->where('api_name', $api_name);
        $this->db->where('markup_type', $markup_type);
        $this->db->where('service_type', $service_type);
        $this->db->where('currency', $currency);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->row();
        }
    }

    function add_b2c_markup($country, $city, $hotel, $airline, $api_name, $markup, $markup_type, $service_type, $currency) {
        $data = array(
            'country' => $country,
            'city' => $city,
            'hotel' => $hotel,
            'airline' => $airline,
            'api_name' => $api_name,
            'currency' => $currency,
            'markup' => $markup,
            'markup_type' => $markup_type,
            'service_type' => $service_type,
            'status' => 1
        );
        //$this->db->set('register_date', 'NOW()', FALSE);
        $this->db->insert('b2c_markup_info', $data);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            return true;
        } else {
            return false;
        }
    }

    function delete_id_b2c_markup($country, $city, $hotel, $airline, $api_name, $markup_type, $service_type, $currency) {
        $this->db->where('country', $country);
        if ($city != NULL) {
            $this->db->where('city', $city);
        }
        if ($hotel != NULL) {
            $this->db->where('hotel', $hotel);
        }
        if ($airline != NULL) {
            $this->db->where('airline', $airline);
        }
        $this->db->where('api_name', $api_name);
        $this->db->where('markup_type', $markup_type);
        $this->db->where('service_type', $service_type);
        $this->db->where('currency', $currency);
        if ($this->db->delete('b2c_markup_info')) {
            return true;
        } else {
            return false;
        }
    }

    public function manage_b2c_markup_status($markup_id, $status) {
        $data['status'] = $status;
        $where = "markup_id = '$markup_id'";
        if ($this->db->update('b2c_markup_info', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    function delete_b2c_markup_status($markup_id) {
        $where = "markup_id = '$markup_id'";
        if ($this->db->delete('b2c_markup_info', $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_b2c_flight_booking_summary() {
        $this->db->select('fr.*,fp.*')
                ->from('flight_booking_reports fr')
                ->join('flight_booking_passengers fp', 'fr.AirlinersRefNo = fp.AirlinersRefNo')
                ->where('fr.agent_id', 0)
                ->order_by('fr.report_id', 'DESC')
                ->group_by('fp.AirlinersRefNo');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_b2c_hotel_booking_summary() {
        $this->db->select('hr.*,hh.city as hotel_city,hh.*,hp.*')
                ->from('hotel_booking_reports hr')
                ->join('hotel_booking_hotels_info hh', 'hr.AL_RefNo = hh.AL_RefNo')
                ->join('hotel_booking_passengers_info hp', 'hr.AL_RefNo = hp.AL_RefNo')
                ->where('hr.agent_id', 0)
                ->order_by('hr.report_id', 'DESC')
                ->group_by('hp.AL_RefNo');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_b2c_car_booking_summary() {
        $this->db->select('cr.*,cp.*')
                ->from('car_booking_reports cr')
                ->join('car_booking_passengers cp', 'cr.AirlinersRefNo = cp.AirlinersRefNo')
                ->where('cr.agent_id', 0)
                ->order_by('cr.report_id', 'DESC')
                ->group_by('cp.AirlinersRefNo');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_hotel_country_list() {
        $this->db->select('country_name')
                ->from('roomsxml_city_list')
                ->group_by('country_name');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_hotel_city_list() {
        $this->db->select('region_name')
                ->from('roomsxml_city_list');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_flight_country_list() {
        $this->db->select('airport_country as country_name')
                ->from('airport_list')
                ->group_by('airport_country');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_flight_city_list() {
        $this->db->select('airport_city as city_name')
                ->from('airport_list')
                ->group_by('airport_city');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_airlines_list() {
        $this->db->select('airline_name')
                ->from('airlines_list')
                ->group_by('airline_name');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_currency_list() {
        $this->db->select('currency_code,currency_name')
                ->where('status', 1)
                ->from('currency');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
        return false;
    }
    
    public function get_user_info_by_id($user_id)
    {   
        $this->db->select('*')
                        ->from('agent_info')
                        ->where('user_id',$user_id)
                        ->limit('1');
        $query = $this->db->get();
          if($query->num_rows > 0) 
          {   
                 $res = $query->result();
                 return $res[0];
          }
          return false;
    }
    
    public function manage_markup_status($user_id, $status) {
        $data['status'] = $status;
        $where = "id = '$user_id'";
        if ($this->db->update('b2b_markup', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }
    
    function getAllDepositData()
    {
        $query = $this->db->query($sql="select * from b2b_deposit_payment_history order by id desc");
        if($query->num_rows() > 0)
        {
            $data = $query->result();
        }
        else $data = '';
        
        return $data;
    }
    
    function getDepositDataOnId($agentId){
        $query = $this->db->query($sql="select * from b2b_deposit_payment_history where agent_id='".$agentId."'");
        if($query->num_rows() > 0)
        {
            $data = $query->row();
        }
        else $data = '';
        
        return $data;
    }
    
    function getCompanyNameOnId($id)
    {
        $query = $this->db->query($sql="select company_name,user_email,mobile_no from agent_info where user_id = '".$id."'");
        if($query->num_rows() > 0)
        {
            $data = $query->row();
        }
        else $data = '';
        
        return $data;
    }
    
    function addDepositMoney($add_val,$deposit_type,$deposit_amount,$mobile_number,$transection_id,$deposit_bank,$bank_branch,$cheque_drawn_bank,$cheque_issue_date,$cheque_no,$scanCopy)
    {
        $this->db->query($sql="insert into b2b_deposit_money_details set agent_id='".$add_val."',
                                                                         deposit_type = '".$deposit_type."',
                                                                         deposit_amount = '".$deposit_amount."',
                                                                         mobile_number = '".$mobile_number."',
                                                                         transection_id = '".$transection_id."',
                                                                         deposit_bank = '".$deposit_bank."',
                                                                         bank_branch = '".$bank_branch."',
                                                                         cheque_drawn_bank = '".$cheque_drawn_bank."',
                                                                         cheque_issue_date = '".$cheque_issue_date."',
                                                                         cheque_no = '".$cheque_no."',
                                                                         scan_copy = '".$scanCopy."'
                                                                         add_date = '".date('Y-m-d H:i:s')."',
                                                                         added_by = 'Admin',
                                                                         status = '0'
                                                                       ");
        $check = $this->db->query($sql="select * from b2b_deposit_payment_history where agent_id='".$add_val."'");
        if($check->num_rows() > 0)
        {
            $data = $check->row();
            $totDeposit = $data->total_deposit_amount;
            $totBalance = $data->total_balance_amount;
            if($totBalance == '')
            {
                $newDeposit = $deposit_amount;
                $newBalance = $deposit_amount;
                
            }
            else
            {
                $newDeposit = ($deposit_amount);
                $newBalance = ($deposit_amount+$totBalance);
            }
            
            $this->db->query($sql="update b2b_deposit_payment_history set total_deposit_amount='".$newDeposit."',total_balance_amount='".$newBalance."',last_deposit_date='".date('Y-m-d H:i:s')."' where agent_id='".$add_val."'");
        }
        else
        {
            $this->db->query($sql="insert into b2b_deposit_payment_history set agent_id='".$add_val."', total_deposit_amount='".$deposit_amount."',total_balance_amount='".$deposit_amount."',last_deposit_date='".date('Y-m-d H:i:s')."'");
        }
    }
    
    function getAllDepositHistoryById($id)
    {
        $query = $this->db->query($sql="select * from b2b_deposit_money_details where agent_id = '".$id."' order by id desc");
        if($query->num_rows() > 0)
        {
            $data = $query->result();
        }
        else $data = '';
        
        return $data;
    }
    
    function getAllNewDepositRequest()
    {
        $query = $this->db->query($sql="select * from b2b_deposit_money_details where (status = '0' or status='2') order by id desc");
        if($query->num_rows() > 0)
        {
            $data = $query->result();
        }
        else $data = '';
        
        return $data;
    }
    
    function getTransectionDetailsOnId($id)
    {
        $query = $this->db->query($sql="select * from b2b_deposit_money_details where id='".$id."'");
        if($query->num_rows() > 0)
        {
            $data = $query->row();
        }
        else $data = '';
        
        return $data;
    }
    
    function activateUserDepositRequest($depId,$status)
    {
        $this->db->query($sql = "update b2b_deposit_money_details set status = '".$status."' where id = '".$depId."'");
        if($status == '1')
        {
            $agentIdQuery = $this->db->query($sql = "select * from b2b_deposit_money_details where id='".$depId."'");
            $row = $agentIdQuery->row();
            $agentId = $row->agent_id;
            $deposit_amount = $row->deposit_amount;
            $check = $this->db->query($sql="select * from b2b_deposit_payment_history where agent_id='".$agentId."'");
            if($check->num_rows() > 0)
            {
                $data = $check->row();
                $totDeposit = $data->total_deposit_amount;
                $totBalance = $data->total_balance_amount;
                if($totBalance == '')
                {
                    $newDeposit = $row->deposit_amount;
                    $newBalance = $row->deposit_amount;

                }
                else
                {
                    $newDeposit = $row->deposit_amount;
                    $newBalance = ($row->deposit_amount+$totBalance);
                }

                $this->db->query($sql="update b2b_deposit_payment_history set total_deposit_amount='".$newDeposit."',total_balance_amount='".$newBalance."',last_deposit_date='".date('Y-m-d H:i:s')."' where agent_id='".$agentId."'");
            }
            else
            {
                $this->db->query($sql="insert into b2b_deposit_payment_history set agent_id='".$agentId."', total_deposit_amount='".$deposit_amount."',total_balance_amount='".$deposit_amount."',last_deposit_date='".$row->add_date."',status='1'");
            }
        }
    }
    
    function add_markup($domFlight,$IntFlight,$hotel,$car,$package,$sightseen)
    {
        $query = $this->db->query($sql = "select user_id from agent_info");
        if($query->num_rows() > 0)
        {
            $data = $query->result();
            foreach($data as $sub)
            {
                $subCheck = $this->db->query($sql = "select id from admin_markup where agent_id='".$sub->user_id."'");
                if($subCheck->num_rows() > 0)
                {
                    $this->db->query($sql = "update admin_markup set InternationalFlights='".$IntFlight."',DomesticFlights='".$domFlight."',Hotels='".$hotel."',Cars='".$car."',Sightseen='".$sightseen."',Packages='".$package."' where agent_id='".$sub->user_id."' and module_type='b2b'");
                }
                else
                {
                    $this->db->query($sql = "insert into admin_markup set agent_id='".$sub->user_id."',module_type='b2b',InternationalFlights='".$IntFlight."',DomesticFlights='".$domFlight."',Hotels='".$hotel."',Cars='".$car."',Sightseen='".$sightseen."',Packages='".$package."'");
                }
            }
            return true;
        }
        else
            return false;
    }
    
    function add_markup_agent($agent_id,$domFlight,$IntFlight,$hotel,$car,$package,$sightseen)
    {
        $check = $this->db->query($sql="select * from admin_markup where module_type='b2b' and agent_id='".$agent_id."'");
        if($check->num_rows() > 0)
        {
            //echo 'ddddd';die;
            //echo $sql = "update admin_markup set InternationalFlights='".$IntFlight."',DomesticFlights='".$domFlight."',Hotels='".$hotel."',Cars='".$car."',Sightseen='".$sightseen."',Packages='".$package."' where module_type='b2b' and agent_id='".$agent_id."'";die;
            $this->db->query($sql = "update admin_markup set InternationalFlights='".$IntFlight."',DomesticFlights='".$domFlight."',Hotels='".$hotel."',Cars='".$car."',Sightseen='".$sightseen."',Packages='".$package."' where module_type='b2b' and agent_id='".$agent_id."'");
        }
        else
        {
            //echo 'ssssss';die;
            $this->db->query($sql = "insert into admin_markup set module_type='b2b',agent_id='".$agent_id."',InternationalFlights='".$IntFlight."',DomesticFlights='".$domFlight."',Hotels='".$hotel."',Cars='".$car."',Sightseen='".$sightseen."',Packages='".$package."'");
        }
        return true;
    }

    function getAgentDetailsOnId($id){
        $query = $this->db->query($sql = "select * from agent_info where user_id='".$id."'");
        if($query->num_rows() > 0){
            $data = $query->row();
        }
        else{
            $data = '';
        }
        
        return $data;
    }
    
    function getAllAgentList(){
        $query = $this->db->query($sql = "select * from agent_info where user_type='1' and status='1' order by user_id desc");
        if($query->num_rows() > 0){
            $data = $query->result();
        }
        else{
            $data = '';
        }
        
        return $data;
    }
    
    function getAgentMarkupInfoOnId($id){
        $query = $this->db->query($sql="select * from admin_markup where agent_id='".$id."'");
        if($query->num_rows() > 0)
        {
            $markup_list = $query->row();
        }
        else
        {
            $markup_list = '';
        }
        
        return $markup_list;
    }
    
    function getAllHotelBookings(){
        $query = $this->db->query($sql = "select * from hotel_booking_master where user_type='1' order by id desc");
        if($query->num_rows() > 0){
            $data = $query->result();
        }else{
            $data = '';
        }
        return $data;
    }
    
    function getAgentCodeOnId($id){
        $query = $this->db->query($sql = "select user_no from agent_info where user_id='".$id."'");
        if($query->num_rows() > 0){
            $data = $query->row();
        }else{
            $data = '';
        }
        return $data;
    }
    
    function updateAgentFlightMarkup($data){
        $check = $this->db->query($sql = "select agent_id from admin_markup where agent_id='".$data['agent']."'");
        if($check->num_rows() > 0){
        $this->db->query($sql = "update admin_markup set AirPhilExpress='".$data['AirPhilExpress']."',
                                                                       SeaAir='".$data['SeaAir']."',
                                                                       CebuPacific='".$data['CebuPacific']."',
                                                                       ZestAir='".$data['ZestAir']."',
                                                                       PhilpinesAirline='".$data['PhilpinesAirline']."',
                                                                       international='".$data['international']."',
                                                                       	type='".$data['markup_type']."' where agent_id='".$data['agent']."'");
        } else {
            $this->db->query($sql = "insert into admin_markup set agent_id='".$data['agent']."', AirPhilExpress='".$data['AirPhilExpress']."',
                                                                       SeaAir='".$data['SeaAir']."',
                                                                       CebuPacific='".$data['CebuPacific']."',
                                                                       ZestAir='".$data['ZestAir']."',
                                                                       PhilpinesAirline='".$data['PhilpinesAirline']."',
                                                                       international='".$data['international']."',
                                                                       	type='".$data['markup_type']."'");
        }
    }
    
    function updateAgentHotelMarkup($data){
        $check = $this->db->query($sql = "select agent_id from admin_markup where agent_id='".$data['agent']."'");
        if($check->num_rows() > 0){
        $this->db->query($sql = "update admin_markup set intl_hotel_markup='".$data['international']."',
                                                                       dom_hotel_markup='".$data['domestic']."',
                                                                       	hotel_markup_type='".$data['markup_type']."' where agent_id='".$data['agent']."'");
        } else {
            $this->db->query($sql = "insert into admin_markup set agent_id='".$data['agent']."', intl_hotel_markup='".$data['international']."',
                                                                       dom_hotel_markup='".$data['domestic']."',
                                                                       hotel_markup_type='".$data['markup_type']."'");
        }
    }
    
}
