<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Home_Model extends CI_Model {

    function convertToHoursMins($time, $format = '%02d:%02d') {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}

    function getFlightAutoFillData($input) {
        $sql = "select * from airport_list where (airport_city like '%$input%' or airport_code like '%$input%') order by airport_code desc, airport_city desc ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else
            return '';
    }
    
    function getActivityAutoFillData($input) {
        $sql = "select * from tacenter_tour_city_list where city_name like '%$input%' order by city_name desc";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else
            return '';
    }
    
    function getPreferredAirline($input){
        $sql = "select * from airlines_list where airline_name like '%$input%' order by airline_name desc";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else
            return '';
    }

    function getHotelAutoFillData($input) {
        $sql = "select * from roomsxml_city_list where (region_name like '%" . $input . "%' or country_name like '%" . $input . "%') order by region_name asc,country_name asc";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $roomsxml = $query->result_array();
        } else {
            $roomsxml = '';
        }
        
        $sql2 = "select * from rezlive_city_list where (name like '%".$input."%' or country_name like '%".$input."%') order by name asc,country_name asc";
        $query2=$this->db->query($sql2);
        if($query2->num_rows() > 0)
        {
             $rezlive = $query2->result_array();
        } else {
            $rezlive = '';
        }
        
        $sql1 = "select * from tacenter_city_list where (city_name like '%".$input."%' or country_name like '%".$input."%') order by city_name asc,country_name asc";
        $query1=$this->db->query($sql1);
        if($query1->num_rows() > 0)
        {
             $tacenter = $query1->result_array();
        } else { 
            $tacenter = '';
        }


        $list = array('roomsxml' => $roomsxml, 'tacenter' => $tacenter,'rezlive'=>$rezlive);

        return $list;
    }



    function checkUserLoginExist($data) {

        $sql = "select * from agent_info where user_email = '" . $data['agent_email'] . "' and user_password = '" . md5($data['agent_pass']) . "' and status='1'";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {

            $data = $query->row();

            return $data;

        } else

            return '';

    }
	
	
	 function checkExitsPassword($oldPass) {
		 
        $sql = "select * from agent_info where  user_password = '" . md5($oldPass) . "'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
           return "true";
        } else
		{
			 return "false";

		}
		
    }



    function registerNewUserData($data) {

        $pass = 'ASFAR' . rand(1, 9999);

        $userNoQuery = $this->db->query($sql = "select user_no from agent_info where user_type='1' order by user_id desc limit 0,1");

        if ($userNoQuery->num_rows() > 0) {

            $user_no = $userNoQuery->row()->user_no;

            $ex = explode('TA', $user_no);

            $userNo = ($ex[1] + 1);

        } else {

            $userNo = '1888';

        }

        $query = $this->db->query($sql = "insert into agent_info set user_type='1',

                                                                     user_email='" . $data['agent_email'] . "',

                                                                     user_password='" . md5($pass) . "',

                                                                     user_no='" . 'TA' . $userNo . "',

                                                                     first_name='" . $data['agent_name'] . "',

                                                                     company_name='" . $data['company_name'] . "',

                                                                     phone_code='" . $data['phone_code'] . "',

                                                                     mobile_no='" . $data['phone_no'] . "',

                                                                     city='" . $data['agent_city'] . "',

                                                                     country='" . $data['agent_country'] . "',

                                                                     comments='" . mysql_real_escape_string($data['agent_comments']) . "',

                                                                     status='3'");



        $id = $this->db->insert_id();

        if (!empty($id)) {

            $userInfo = array('password' => $pass, 'user_no' => 'TA' . $userNo);

            return $userInfo;

        } else {

            return '';

        }

    }
	
	
	function registerNewStaffData($data) {

        $userNoQuery = $this->db->query($sql = "select user_no from agent_info where user_type='2' order by user_id desc limit 0,1");

        if ($userNoQuery->num_rows() > 0) {

            $user_no = $userNoQuery->row()->user_no;

            $ex = explode('TA', $user_no);

            $userNo = ($ex[1] + 1);

        } else {

            $userNo = '1888';

        }

        $query = $this->db->query($sql = "insert into agent_info set user_type='2',

                                                                     user_email='" . $data['user_email'] . "',
																	 
																	 master_agent_id='" . $_SESSION['agent']['user_id'] . "',

                                                                     user_password='" . md5($data['user_password']) . "',

                                                                     user_no='" . 'TA' . $userNo . "',

                                                                     first_name='" . $data['agent_name'] . "',

                                                                     staff_type='" . $data['staff_type'] . "',
																	 
                                                                     status='1'");



        $id = $this->db->insert_id();

        if (!empty($id)) {
			
			$pass = $data['user_password'];

            $userInfo = array('password' => $pass, 'user_no' => 'TA' . $userNo);

            return $userInfo;

        } else {

            return '';

        }

    }



    function checkEmailExistForgotPassword($email) {

        $pass = '';

        $sql = "select * from agent_info where user_email = '" . trim($email) . "'";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {

            $pass = 'ASFAR' . rand(1, 999999);

            $data = $query->row;

            $this->db->query($sql = "update agent_info set user_password ='" . md5($pass) . "' where user_email='" . $email . "'");

            return array('agent_data'=>$data,'pass'=>$pass);

        } else

            return '';

    }



    function getAllCountryList() {

        $query = $this->db->query($sql = "select * from countries order by name asc");

        if ($query->num_rows() > 0) {

            $data = $query->result();

        } else {

            $data = '';

        }

        return $data;

    }
	
	
	 function getAllStatesList() {

        $query = $this->db->query($sql = "select * from states order by id asc");

        if ($query->num_rows() > 0) {

            $data = $query->result();

        } else {

            $data = '';

        }

        return $data;

    }
	
	function getAllCitiesByState($stateId) {

        $query = $this->db->query($sql = "SELECT * FROM cities  WHERE  state_id = '".$stateId."'");

        if ($query->num_rows() > 0) {

            $data = $query->result();

        } else {

            $data = '';

        }

        return $data;

    }



    function getUserInfoOnId($id) {

        $query = $this->db->query($sql = "select user_no,first_name,company_name from agent_info where user_id = '" . $id . "'");

        if ($query->num_rows() > 0) {

            $data = $query->row();

        } else {

            $data = '';

        }



        return $data;

    }



    function getUserDetails($id) {

        $query = $this->db->query($sql = "select user_id,user_email,user_password,user_logo,first_name,company_name,phone_code,mobile_no,address,pin_code,city,state,country,phone_number from agent_info where user_id = '" . $id . "'");

        if ($query->num_rows() > 0) {

            $data = $query->row();

            return $data;

        } else

            return '';

    }
	
	
	function getAgentStaffDetails($id) {

        $query = $this->db->query($sql = "select user_id,user_email,user_password,user_logo,first_name,company_name,phone_code,mobile_no,address,pin_code,city,state,country,phone_number from agent_info where 	master_agent_id  = '" . $id . "'");

        if ($query->num_rows() > 0) {

            $data = $query->result();

            return $data;

        } else

            return '';

    }



    function getAgentDepositList($id) {

        $query = $this->db->query($sql = "select * from b2b_deposit_money_details where agent_id='" . $id . "' order by id desc");

        if ($query->num_rows() > 0) {

            $data = $query->result();

        } else {

            $data = '';

        }



        return $data;

    }



    function getAllSubAgentListOnAgentId($id) {

        $query = $this->db->query($sql = "select * from agent_info where master_agent_id='" . $id . "' and user_type='2' order by user_id desc");

        if ($query->num_rows() > 0) {

            $data = $query->result();

        } else {

            $data = '';

        }



        return $data;

    }



    function getAgentHotelBookings($id) {

        $query = $this->db->query($sql = "select * from hotel_booking_master where user_id='" . $id . "' and user_type='1'");

        if ($query->num_rows() > 0) {

            $data = $query->result();

        } else {

            $data = '';

        }



        return $data;

    }



    function addDepositMoney($add_val, $agentType, $deposit_type, $deposit_amount, $mobile_number, $transection_id, $deposit_bank, $bank_branch, $cheque_drawn_bank, $cheque_issue_date, $cheque_no, $fileName) {

        $this->db->trans_start();

        $id = 0;

        $this->db->query($sql = "insert into b2b_deposit_money_details set agent_id='" . $add_val . "',

                                                                         user_type='" . $agentType . "',

                                                                         deposit_type = '" . $deposit_type . "',

                                                                         deposit_amount = '" . $deposit_amount . "',

                                                                         mobile_number = '" . $mobile_number . "',

                                                                         transection_id = '" . $transection_id . "',

                                                                         deposit_bank = '" . $deposit_bank . "',

                                                                         bank_branch = '" . $bank_branch . "',

                                                                         cheque_drawn_bank = '" . $cheque_drawn_bank . "',

                                                                         cheque_issue_date = '" . $cheque_issue_date . "',

                                                                         cheque_no = '" . $cheque_no . "',

                                                                         scan_copy = '" . $fileName . "',

                                                                         add_date = '" . date('Y-m-d H:i:s') . "',

                                                                         added_by = 'Agent',

                                                                         status = '0'

                                                                       ");

#echo $this->db->last_query();

        $id = $this->db->insert_id();

        $this->db->trans_complete();



        return $id;

    }



    function updateUserData($user_id, $agent_name, $address, $city, $phone_code, $phone_no, $company_name, $zip_code, $country, $newFileName) {

        $this->db->trans_start();

        $this->db->query($sql = "update agent_info set user_logo='" . $newFileName . "',

                                                                         first_name='" . mysql_real_escape_string($agent_name) . "',

                                                                         company_name = '" . mysql_real_escape_string($company_name) . "',

                                                                         address = '" . mysql_real_escape_string($address) . "',

                                                                         mobile_no = '" . $phone_no . "',

                                                                         phone_code = '" . $phone_code . "',

                                                                         pin_code = '" . $zip_code . "',

                                                                         city = '" . $city . "',

                                                                         country = '" . $country . "' where user_id='" . $user_id . "'");



        $id = $this->db->affected_rows();

        $this->db->trans_complete();



        return $id;

    }
	
	 function updateStaffPassword($data) {
		 
		 $password = md5($data['user_password']);
		 $staff_id = $data['user_id'];

        $this->db->trans_start();

        $this->db->query($sql = "update agent_info set user_password='" . $password . "' where user_id='" . $staff_id . "'");

        $id = $this->db->affected_rows();

        $this->db->trans_complete();



        return $id;

    }
	
	
	 function updateUserDetailsFromControlPanel($user_id,$address,$phone_number,$state,$city,$pin_code) {

        $this->db->trans_start();

        $this->db->query($sql = "update agent_info set address = '" . mysql_real_escape_string($address) . "',

                                                                         phone_number = '" . $phone_number . "',

                                                                         state = '" . $state . "',

                                                                         pin_code = '" . $pin_code . "',

                                                                         city = '" . $city . "' where user_id='" . $user_id . "'");



        $id = $this->db->affected_rows();

        $this->db->trans_complete();


        return $id;

    }
	
	
	 function updateUserLogo($user_id,$newFileName) {

        $this->db->trans_start();

        $this->db->query($sql = "update agent_info set user_logo='".$newFileName."' where user_id='".$user_id."'");
		
        $id = $this->db->affected_rows();

        $this->db->trans_complete();



        return $id;

    }
	



    function updateUserPassword($id, $data) {

        $this->db->trans_start();

        $query = $this->db->query($sql = "select user_password from agent_info where user_id='" . $id . "'");

        if ($query->num_rows() > 0) {

            $pass = $query->row();

            if ($pass->user_password == md5(trim($data['old_pass']))) {

                $this->db->query($sql = "update agent_info set user_password='" . md5($data['new_pass']) . "' where user_id='" . $id . "'");

                $id = $this->db->affected_rows();

            } else {

                $id = '';

            }

        } else {

            $id = '';

        }



        $this->db->trans_complete();



        return $id;

    }



    function addSubAgentData($agentId, $agent_name, $address, $city, $phone_code, $phone_no, $company_name, $zip_code, $country, $newFileName, $email, $pass) {

        $this->db->trans_start();

        $checkQuery = $this->db->query($sql = "select user_id from agent_info where user_email='" . trim($email) . "'");

        if ($checkQuery->num_rows() > 0) {

            $err = 2;

        } else {

            $userNoQuery = $this->db->query($sql = "select user_no from agent_info where user_type='2' order by user_id desc limit 0,1");

            if ($userNoQuery->num_rows() > 0) {

                $user_no = $userNoQuery->row()->user_no;

                $ex = explode('TSA', $user_no);

                $userNo = ($ex[1] + 1);

            } else {

                $userNo = '1888';

            }

            $this->db->query($sql = "insert into agent_info set user_type='2',master_agent_id='" . $agentId . "',

                                                    user_email='" . $email . "',

                                                    user_password='" . md5($pass) . "',

                                                    user_no='" . 'TSA' . $userNo . "',

                                                    first_name='" . mysql_real_escape_string($agent_name) . "',

                                                    address='" . mysql_real_escape_string($address) . "',

                                                    company_name='" . $company_name . "',

                                                    phone_code='" . $phone_code . "',

                                                    mobile_no='" . $phone_no . "',

                                                    city='" . mysql_real_escape_string($city) . "',

                                                    country='" . $country . "',

                                                    pin_code='" . $zip_code . "',

                                                    user_logo='" . $newFileName . "',

                                                    status='1'");



            $id = $this->db->insert_id();

            if ($id != '' && $id > 0) {

                $err = 0;

            } else {

                $err = 1;

            }

            

        }

        $this->db->trans_complete();

        $data = array('err'=>$err,'user_no'=>'TSA'.$userNo);

        return $data;

    }



    function getAllAirlineList() {

        $query = $this->db->query($sql = "select * from airlines_list group by airline_code order by airline_name asc");

        if ($query->num_rows() > 0) {

            $data = $query->result();

            return $data;

        } else

            return '';

    }



    function getAgentFlightMarkupOnId($agentId,$user_type) {

        $query = $this->db->query($sql = "select * from agent_markup where agent_id='" . $agentId . "' and user_type='".$user_type."'");

        if ($query->num_rows() > 0) {

            $data = $query->row();

            return $data;

        } else

            return '';

    }



    function getAgentHotelMarkupOnId($agentId,$user_type) {

        $query = $this->db->query($sql = "select * from agent_markup where agent_id='" . $agentId . "' and user_type='1'");

        if ($query->num_rows() > 0) {

            $data = $query->row();

            return $data;

        } else

            return '';

    }



    function updateAgentFlightMarkup($agentId, $agentType, $data) {

        $this->db->trans_start();

        $query = $this->db->query($sql = "select agent_id from agent_markup where agent_id='" . $agentId . "'");

        if ($query->num_rows() > 0) {

            $this->db->query($sql = "update agent_markup set type='" . $data['flight_markup_type'] . "',AirPhilExpress='" . $data['AirPhilExpress'] . "',SeaAir='" . $data['SeaAir'] . "',CebuPacific='" . $data['CebuPacific'] . "',ZestAir='".$data['ZestAir']."',PhilpinesAirline='".$data['PhilpinesAirline']."',international='".$data['intel_flight_amount']."' where agent_id='" . $agentId . "'");

            $id = $this->db->affected_rows();

            $type = 'update';

        } else {

            $this->db->query($sql = "insert into agent_markup set agent_id='".$agentId."',user_type='".$agentType."', type='" . $data['flight_markup_type'] . "',AirPhilExpress='" . $data['AirPhilExpress'] . "',SeaAir='" . $data['SeaAir'] . "',CebuPacific='" . $data['CebuPacific'] . "',ZestAir='".$data['ZestAir']."',PhilpinesAirline='".$data['PhilpinesAirline']."',international='".$data['intel_flight_amount']."'");

            $id = $this->db->insert_id();

            $type = 'insert';

        }



        $this->db->trans_complete();



        return array('id' => $id, 'type' => $type);

    }

    function updateSubAgentFlightMarkup($data,$agentId) {

        $this->db->trans_start();

        $query = $this->db->query($sql = "select sub_agent_id from sub_agent_markup where agent_id='".$agentId."' and sub_agent_id='" . $data['sub_id'] . "'");

        if ($query->num_rows() > 0) {

            $this->db->query($sql = "update sub_agent_markup set type='" . $data['flight_markup_type'] . "',AirPhilExpress='" . $data['AirPhilExpress'] . "',SeaAir='" . $data['SeaAir'] . "',CebuPacific='" . $data['CebuPacific'] . "',ZestAir='".$data['ZestAir']."',PhilpinesAirline='".$data['PhilpinesAirline']."',international='".$data['intel_flight_amount']."' where sub_agent_id='" . $data['sub_id'] . "'");

            $id = $this->db->affected_rows();

            $type = 'update';

        } else {

            $this->db->query($sql = "insert into sub_agent_markup set agent_id='".$agentId."',sub_agent_id='".$data['sub_id']."', type='" . $data['flight_markup_type'] . "',AirPhilExpress='" . $data['AirPhilExpress'] . "',SeaAir='" . $data['SeaAir'] . "',CebuPacific='" . $data['CebuPacific'] . "',ZestAir='".$data['ZestAir']."',PhilpinesAirline='".$data['PhilpinesAirline']."',international='".$data['intel_flight_amount']."'");

            $id = $this->db->insert_id();

            $type = 'insert';

        }



        $this->db->trans_complete();



        return array('id' => $id, 'type' => $type);

    }



    function updateAgentHotelMarkup($agentId, $agentType, $markupType, $domMark, $intlMark) {

        $this->db->trans_start();

        $query = $this->db->query($sql = "select agent_id from agent_markup where agent_id='" . $agentId . "'");

        if ($query->num_rows() > 0) {

            $this->db->query($sql = "update agent_markup set hotel_markup_type='" . $markupType . "',dom_hotel_markup='" . $domMark . "',intl_hotel_markup='".$intlMark."' where agent_id='" . $agentId . "'");

            $id = $this->db->affected_rows();

            $type = 'update';

        } else {

            $this->db->query($sql = "insert into agent_markup set agent_id='" . $agentId . "',user_type='" . $agentType . "', hotel_markup_type='" . $markupType . "',dom_hotel_markup='" . $domMark . "',intl_hotel_markup='".$intlMark."'");

            $id = $this->db->insert_id();

            $type = 'insert';

        }



        $this->db->trans_complete();



        return array('id' => $id, 'type' => $type);

    }

    

    function updateSubAgentHotelMarkup($subAgentId,$agentId, $agentType, $markupType, $domMark, $intlMark) {

        $this->db->trans_start();

        $query = $this->db->query($sql = "select agent_id from sub_agent_markup where sub_agent_id='" . $subAgentId . "'");

        if ($query->num_rows() > 0) {

            $this->db->query($sql = "update sub_agent_markup set hotel_markup_type='" . $markupType . "',dom_hotel_markup='" . $domMark . "',intl_hotel_markup='".$intlMark."' where sub_agent_id='".$subAgentId."' and agent_id='" . $agentId . "'");

            $id = $this->db->affected_rows();

            $type = 'update';

        } else {

            $this->db->query($sql = "insert into sub_agent_markup set agent_id='" . $agentId . "',sub_agent_id='".$subAgentId."', user_type='" . $agentType . "', hotel_markup_type='" . $markupType . "',dom_hotel_markup='" . $domMark . "',intl_hotel_markup='".$intlMark."'");

            $id = $this->db->insert_id();

            $type = 'insert';

        }



        $this->db->trans_complete();



        return array('id' => $id, 'type' => $type);

    }



    function getSubAgentFlightMarkupOnId($subAgentId,$agentId) {

        $query = $this->db->query($sql = "select * from sub_agent_markup where agent_id='".$agentId."' and sub_agent_id='" . $subAgentId . "'");

        if ($query->num_rows() > 0) {

            $data = $query->row();

            return $data;

        } else

            return '';

    }



    function getSubAgentHotelMarkupOnId($subAgentId,$agentId) {

        $query = $this->db->query($sql = "select * from sub_agent_markup where agent_id='".$agentId."' and sub_agent_id='" . $subAgentId . "'");

        if ($query->num_rows() > 0) {

            $data = $query->row();

            return $data;

        } else

            return '';

    }



    function getSubAgentDepositBalance($id) {

        $query = $this->db->query($sql = "select * from b2b_deposit_payment_history where agent_id='" . $id . "'");

        if ($query->num_rows() > 0) {

            $data = $query->row();

            return $data;

        } else

            return '';

    }



    function addSubAgentDeposit($agentId, $subAgentId, $depositAmount) {

        $query = $this->db->query($sql = "select * from agent_info where user_id='" . $subAgentId . "' and user_type='2'");

        if ($query->num_rows() > 0) {

            $data = $query->row();

            if ($data->master_agent_id == $agentId) {

                $agentBalQuery = $this->db->query($sql = "select total_balance_amount from b2b_deposit_payment_history where agent_id='" . $agentId . "'");

                if ($agentBalQuery->num_rows() > 0) {

                    $agentBal = $agentBalQuery->row();

                    if ($agentBal->total_balance_amount > $depositAmount) {

                        $subAgentBalQuery = $this->db->query($sql = "select total_balance_amount from b2b_deposit_payment_history where agent_id='" . $subAgentId . "'");

                        if ($subAgentBalQuery->num_rows() > 0) {

                            $subAgentBal = $subAgentBalQuery->row();

                            $newSubAgentBal = ($subAgentBal->total_balance_amount + $depositAmount);

                            $this->db->query($sql = "update b2b_deposit_payment_history set total_deposit_amount='" . $depositAmount . "',total_balance_amount='" . $newSubAgentBal . "',last_deposit_date='" . date('Y-m-d H:i:s') . "',status='1' where agent_id='" . $subAgentId . "'");

                        } else {

                            $this->db->query($sql = "insert into  b2b_deposit_payment_history set agent_id='" . $subAgentId . "',total_deposit_amount='" . $depositAmount . "',total_balance_amount='" . $depositAmount . "',last_deposit_date='" . date('Y-m-d H:i:s') . "',status='1'");

                        }



                        $agentNawBalance = ($agentBal->total_balance_amount - $depositAmount);



                        $this->db->query($sql = "insert into b2b_deposit_money_details set agent_id='" . $subAgentId . "',user_type='2',deposit_type='By Agent',deposit_amount='" . $depositAmount . "',transection_id='*********',add_date='" . date('Y-m-d H:i:s') . "',added_by='Agent',status='1'");



                        $this->db->query($sql = "insert into b2b_deposit_money_details set agent_id='" . $agentId . "',deposit_type='Sub Agent',deposit_amount='" . $depositAmount . "',transection_id='Towards Sub-Agent',add_date='" . date('Y-m-d H:i:s') . "',added_by='Self',status='1'");

                        $this->db->query($sql = "update b2b_deposit_payment_history set total_balance_amount='" . $agentNawBalance . "',total_deposit_amount='-" . $depositAmount . "',last_deposit_date='" . date('Y-m-d H:i:s') . "',status='1' where agent_id='" . $agentId . "'");

                    } else

                        $status = false;

                }

                $status = true;

            } else

                $status = false;

        } else

            $status = false;

        

        $deposit = array('status'=>$status,'sub_data'=>$data);

    }



    function changeSubAgentStatus($agentId, $subAgentId, $status) {

        $query = $this->db->query($sql = "select * from agent_info where user_id='" . $subAgentId . "' and user_type='2'");

        if ($query->num_rows() > 0) {

            $data = $query->row();

            if ($data->master_agent_id == $agentId) {

                $this->db->query($sql = "update agent_info set status='" . $status . "' where user_id='" . $subAgentId . "'");

                return true;

            } else

                return false;

        } else

            return false;

    }



    function editSubAgentData($agentId, $sub_id, $agent_name, $address, $city, $phone_code, $phone_no, $company_name, $zip_code, $country, $newFileName) {

        $this->db->trans_start();

        $checkQuery = $this->db->query($sql = "select user_id from agent_info where user_id='" . $sub_id . "' and master_agent_id='" . $agentId . "'");

        if ($checkQuery->num_rows() > 0) {

            $id = '';

            $this->db->query($sql = "update agent_info set first_name='" . mysql_real_escape_string($agent_name) . "',

                                                    address='" . mysql_real_escape_string($address) . "',

                                                    company_name='" . $company_name . "',

                                                    phone_code='" . $phone_code . "',

                                                    mobile_no='" . $phone_no . "',

                                                    city='" . mysql_real_escape_string($city) . "',

                                                    country='" . $country . "',

                                                    pin_code='" . $zip_code . "',

                                                    user_logo='" . $newFileName . "' where user_id='".$sub_id."'");



            $id = $this->db->affected_rows();

            if ($id !== '' && $id >= 0) {

                $err = 0;

            } else {

                $err = 1;

            }

        } else {

            $err = 2;

        }

        $this->db->trans_complete();

        return $err;

    }



    function getSubAgentDetailsOnId($subAgentId) {

        $query = $this->db->query($sql = "select * from agent_info where user_id='" . $subAgentId . "' and user_type='2'");

        if ($query->num_rows() > 0) {

            $data = $query->row();

        } else {

            $data = '';

        }

        return $data;

    }

    

    function getAgentDepositBalance($id) {

        $query = $this->db->query($sql = "select total_balance_amount from b2b_deposit_payment_history where agent_id='" . $id . "'");

        if ($query->num_rows() > 0) {

            $data = $query->row();

            $deposit = $data->total_balance_amount;

        } else

            $deposit = 0;



        return $deposit;

    }

    

    function deductAgentDepositOnBooking($agentId,$userType,$hotelPrice,$adminMarkup,$agentMarkup,$subAgentMarkup){

        $query = $this->db->query($sql = "select * from b2b_deposit_payment_history where agent_id='".$agentId."'");

        if($query->num_rows() > 0){

            $data = $query->row();

            $balance = $data->total_balance_amount;

            if($userType == '1'){

                $newBalance = ($balance-($hotelPrice-$agentMarkup));

            }

            else if($userType == '2'){

                $newBalance = ($balance-($hotelPrice-($agentMarkup+$subAgentMarkup)));

            }

            else{

                $newBalance = ($balance-$hotelPrice);

            }

            

            $this->db->query($sql = "update b2b_deposit_payment_history set total_balance_amount='".$newBalance."' where agent_id='".$agentId."'");

        }

    }

    

    function deductFlAgentDepositOnBooking($agentId,$userType,$hotelPrice,$adminMarkup,$agentMarkup,$subAgentMarkup){

        $query = $this->db->query($sql = "select * from b2b_deposit_payment_history where agent_id='".$agentId."'");

        if($query->num_rows() > 0){

            $data = $query->row();

            $balance = $data->total_balance_amount;

            if($userType == '1'){

                $newBalance = ($balance-($hotelPrice+$adminMarkup));

            }

            else if($userType == '2'){

                $newBalance = ($balance-($hotelPrice+($adminMarkup+$agentMarkup)));

            }

            else{

                $newBalance = ($balance-$hotelPrice);

            }

            

            $this->db->query($sql = "update b2b_deposit_payment_history set total_balance_amount='".$newBalance."' where agent_id='".$agentId."'");

        }

    }

    

    function getAllCountryPhoneCodes(){

        $query = $this->db->query($sql = "select countries_name,countries_isd_code from country_phone_code order by countries_name asc");

        if($query->num_rows() > 0){

            return $query->result();

        } else {

            return '';

        }

    }

    

    function getAdminMarkup($agentId){

        $markup = '';

        $query = $this->db->query($sql = "select * from admin_markup where agent_id='0' union select * from admin_markup where agent_id='".$agentId."'");

        if($query->num_rows() > 0){

            $data = $query->result_array();

            if(count($data) == 2){

                $markup['2P'] = ($data[1]['AirPhilExpress'] != '0' ? $data[1]['AirPhilExpress'] : $data[0]['AirPhilExpress']);

                $markup['DG'] = ($data[1]['SeaAir'] != '0' ? $data[1]['SeaAir'] : $data[0]['SeaAir']);

                $markup['5J'] = ($data[1]['CebuPacific'] != '0' ? $data[1]['CebuPacific'] : $data[0]['CebuPacific']);

                $markup['Z2'] = ($data[1]['ZestAir'] != '0' ? $data[1]['ZestAir'] : $data[0]['ZestAir']);

                $markup['PR'] = ($data[1]['PhilpinesAirline'] != '0' ? $data[1]['PhilpinesAirline'] : $data[0]['PhilpinesAirline']);

                $markup['international'] = ($data[1]['international'] != '0' ? $data[1]['international'] : $data[0]['international']);

                $markup['type'] = ($data[1]['type'] != '0' ? $data[1]['type'] : $data[0]['type']);

            } else {

                $markup['2P'] = $data[0]['AirPhilExpress'];

                $markup['DG'] = $data[0]['SeaAir'];

                $markup['5J'] = $data[0]['CebuPacific'];

                $markup['Z2'] = $data[0]['ZestAir'];

                $markup['PR'] = $data[0]['PhilpinesAirline'];

                $markup['international'] = $data[0]['international'];

                $markup['type'] = $data[0]['type'];

            }

        } else {

            $markup['2P'] = 0;

            $markup['DG'] = 0;

            $markup['5J'] = 0;

            $markup['Z2'] = 0;

            $markup['PR'] = 0;

            $markup['international'] = 0;

            $markup['type'] = 'fixed';

        }

        return $markup;

    }

    

    function getAgentMarkup($agentId){
        $markup = '';
        $query = $this->db->query($sql = "select * from agent_markup where agent_id='".$agentId."'");
        if($query->num_rows() > 0){
            $data = $query->result_array();
            $markup['2P'] = ($data[0]['AirPhilExpress'] != '' ? $data[0]['AirPhilExpress'] : 0);
            $markup['DG'] = ($data[0]['SeaAir'] != '' ? $data[0]['SeaAir'] : 0);
            $markup['5J'] = ($data[0]['CebuPacific'] != '' ? $data[0]['CebuPacific'] : 0);
            $markup['Z2'] = ($data[0]['ZestAir'] != '' ? $data[0]['ZestAir'] : 0);
            $markup['PR'] = ($data[0]['PhilpinesAirline'] != '' ? $data[0]['PhilpinesAirline'] : 0);
            $markup['international'] = ($data[0]['international'] != '' ? $data[0]['international'] : 0);
            $markup['type'] = ($data[0]['type'] != '' ? $data[0]['type'] : 'fixed');
        } else {
            $markup['2P'] = 0;
            $markup['DG'] = 0;
            $markup['5J'] = 0;
            $markup['Z2'] = 0;
            $markup['PR'] = 0;
            $markup['international'] = 0;
            $markup['type'] = 'fixed';
        }
        return $markup;
    }

    

    function getHotelAdminMarkup($agentId){

        $markup = '';

        $query = $this->db->query($sql = "select hotel_markup_type,intl_hotel_markup,dom_hotel_markup from admin_markup where agent_id='0' union select hotel_markup_type,intl_hotel_markup,dom_hotel_markup from admin_markup where agent_id='".$agentId."'");

        if($query->num_rows() > 0){

            $data = $query->result_array();

            if(count($data) == 2){

                $markup['dom'] = ($data[1]['dom_hotel_markup'] != '0' ? $data[1]['dom_hotel_markup'] : $data[0]['dom_hotel_markup']);

                $markup['intl'] = ($data[1]['intl_hotel_markup'] != '0' ? $data[1]['intl_hotel_markup'] : $data[0]['intl_hotel_markup']);

                $markup['type'] = ($data[1]['hotel_markup_type'] != '0' ? $data[1]['hotel_markup_type'] : $data[0]['hotel_markup_type']);

            } else {

                $markup['dom'] = $data[0]['dom_hotel_markup'];

                $markup['intl'] = $data[0]['intl_hotel_markup'];

                $markup['type'] = $data[0]['hotel_markup_type'];

            }

        } else {

            $markup['dom'] = 0;

            $markup['intl'] = 0;

            $markup['type'] = 'fixed';

        }

        return $markup;

    }

    

    function getHotelAgentMarkup($agentId){

        $markup = '';

        //echo $sql = "select hotel_markup_type,intl_hotel_markup,dom_hotel_markup from agent_markup where agent_id='".$agentId."'";die;

        $query = $this->db->query($sql = "select hotel_markup_type,intl_hotel_markup,dom_hotel_markup from agent_markup where agent_id='".$agentId."'");

        if($query->num_rows() > 0){

            $data = $query->result_array();

            $markup['dom'] = ($data[0]['dom_hotel_markup'] == '' ? '0' : $data[0]['dom_hotel_markup']);

            $markup['intl'] = ($data[0]['intl_hotel_markup'] == '' ? 0 : $data[0]['intl_hotel_markup']);

            $markup['type'] = $data[0]['hotel_markup_type'];

        } else {

            $markup['dom'] = 0;

            $markup['intl'] = 0;

            $markup['type'] = 'fixed';

        }

        return $markup;

    }

    

    function checkSubagentOnAgent($agentId,$subAgentId){

        $query = $this->db->query($sql = "select user_id,master_agent_id from agent_info where user_id='".$subAgentId."' and master_agent_id='".$agentId."'");

        if($query->num_rows() > 0){

            return true;

        } else return false;

    }

    

    function getFlightBookingsOnId($id,$type){

        $query = $this->db->query($sql = "select id,pnr,booking_ref,booking_status,journeyType,Departure_LocationCode,Arrival_LocationCode,TotalFare,agent_markup from flight_booking where user_id='".$id."' and user_type='".$type."'");

        if($query->num_rows() > 0){

            $data = $query->result();

        } else {

            $data = '';

        }

        

        return $data;

    }

    

    function getHotelBookingsOnId($id,$type){

        $query = $this->db->query($sql = "select id,ref_id,confirmation_number,price,agent_markup,booking_status,location from hotel_booking_master where user_id='".$id."' and user_type='".$type."'");

        if($query->num_rows() > 0){

            $data = $query->result();

        } else {

            $data = '';

        }

        

        return $data;

    }

    

    function addNewAffiliateRequest($data){

        $query = $this->db->query($sql = "insert into affiliate_info set comp_name='".mysql_real_escape_string($data['comp_name'])."',

                                                                         fname='".mysql_real_escape_string($data['fname'])."',

                                                                         lname='".mysql_real_escape_string($data['lname'])."',

                                                                         email_id='".mysql_real_escape_string($data['email_id'])."',

                                                                         country='".mysql_real_escape_string($data['country'])."',

                                                                         site_url='".mysql_real_escape_string($data['site_url'])."',

                                                                         phone_no='".mysql_real_escape_string($data['promo_code'])."'");

        $id = $this->db->insert_id();

        return $id;

    }

    function getNationalityList(){
        $query = $this->db->query($sql = "select * from rezlive_country_list order by name asc");
        if($query->num_rows() > 0){
            return $query->result();
        } else return '';
    }

}

