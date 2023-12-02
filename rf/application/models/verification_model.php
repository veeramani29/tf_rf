<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------|
| Author: Provab Technosoft Pvt Ltd.									   |
|--------------------------------------------------------------------------|
| Developer: Provab and Vikas Arora							   |
| Started Date: 2014-08-25T14:45:00										   |
| Ended Date:  										   					   |
|--------------------------------------------------------------------------|
*/

class Verification_Model extends CI_Model {
	
	public function checkB2CVerfication($user_id, $user_type) {
        $this->db->where('user_id', $user_id);
        $this->db->where('user_type', (string)$user_type); 
        return $this->db->get('user_verifications');
    }

    public function updateB2CVerification($b2c_id,$update){
        $this->db->where('user_id', $b2c_id);
        return $this->db->update('user_verifications',$update);
    }

    public function insertB2CVerification($verification){
        $this->db->insert('user_verifications',$verification);
    }

    public function checkSecurityQuestion($user_id){
        $this->db->select('security_question, security_answer');
        $this->db->from('b2c');
        $this->db->where('user_id', $user_id);

        return $this->db->get()->result();
    }

    public function checkSecurityQuestionB2b($user_id){
        $this->db->select('security_question, security_answer');
        $this->db->from('b2b');
        $this->db->where('agent_id', $user_id);

        return $this->db->get()->result();
    }

    public function twoStepTypeEnabled($user_id, $user_type) {
        $this->db->select('two_step_verification, two_step_type');
        $this->db->from('user_verifications');
        $this->db->where('user_id', $user_id);
        $this->db->where('user_type', $user_type);

        return $this->db->get()->result();
    }

    public function enableTwoStepVerification($user_id, $user_type, $verificationType, $verificationEnable){
        $this->db->where('user_id', $user_id);
        $this->db->where('user_type', $user_type);
        $data = array('two_step_verification'=>$verificationEnable, 'two_step_type'=>$verificationType);
        if($this->db->update('user_verifications', $data)) {
            return true;    
        }
    }

    public function disableTwoStepVerification($user_id, $user_type) {
        $data = array('two_step_verification'=>'0', 'two_step_type'=>0);
        $this->db->where('user_id', $user_id);
        $this->db->where('user_type', $user_type);
        $this->db->update('user_verifications', $data);        
        return true;
    }

    public function b2c_setSecurityQuestion($user_id, $security_question, $security_answer) {
        $this->db->where('user_id', $user_id);
        $data = array('security_question'=>$security_question, 'security_answer'=>$security_answer);
        if($this->db->update('b2c', $data)) {
            return true;
        }
    }

    public function b2b_setSecurityQuestion($user_id, $security_question, $security_answer) {
        $this->db->where('agent_id', $user_id);
        $data = array('security_question'=>$security_question, 'security_answer'=>$security_answer);
        if($this->db->update('b2b', $data)) {
            return true;
        }
    }

    public function reVerifyQuesAns($user_id) { //not in use. if any error comes up using this, use account_model->GetUserData
        $this->db->select('*');
        $this->db->from('b2c');
        $this->db->where('user_id', $user_id);
        return $this->db->get()->row();
    }

    public function reVerifyEmailMobile($user_id, $user_type) {
        $this->db->select('*');
        $this->db->from('user_verifications');
        $this->db->where('user_id', $user_id);
        $this->db->where('user_type', $user_type);
        return $this->db->get()->row();
    }

    public function getTwoStepVeriStatus($user_id, $user_type) {
        $this->db->select('*');
        $this->db->from('user_verifications');
        $this->db->where('user_id', $user_id);
        $this->db->where('user_type', $user_type);

        return $this->db->get()->result();

    }

    public function getUserInfo($user_id) { //for showing details in the 2 step verification page

    }

    public function checkVerificationType($user_id,$user_type) {
        $where = "user_id = ".$user_id." AND user_type='".$user_type."'" ;

        $this->db->select('*');
        $this->db->from('user_verifications');
        $this->db->where($where);

        $result_object = $this->db->get()->row();

        if(!empty($result_object)) {
           if($result_object->two_step_type == 1) {
            return '1';
           } else if($result_object->two_step_type == 2) {
            return '2';
           } else {
            return false;
           }
        }
    }

    public function checkEmailVerification($user_id) {
        $this->db->select('email');
        $this->db->from('user_verifications');
        $this->db->where('user_id', $user_id);
        $this->db->where('user_id', $user_type);

        $query = $this->db->get();
        return $query->row();
    }

    public function isTwoStepEnabled($user_id, $user_type) {
        $this->db->where('user_id', $user_id);
        $this->db->where('user_type', $user_type);
        $query = $this->db->get('user_verifications')->row();
        if(!empty($query)) {
            if($query->two_step_verification == 1) {
                return true;
            } else {
                return false;
            }    
        } else {
            return false;
        }
    }

    public function updatePwdTwoStep($user_type,$user_id, $twoStepRandomNumber) {
        $update = array(
            'opt' => $twoStepRandomNumber
        );
        if($user_type == 3){
            $this->db->where('user_id', $user_id);
            return $this->db->update('b2c', $update);
        }else if($user_type == 2){
            $this->db->where('agent_id', $user_id);
            return $this->db->update('b2b', $update);
        }
        
    }

    public function verifyTwoStepPassword($user_type,$user_id, $twoStepPwd) {
        $this->db->select('*');
        if($user_type == 3){
            $this->db->from('b2c');
            $this->db->where('user_id', $user_id);
        }else if($user_type == 2){
            $this->db->from('b2b');
            $this->db->where('agent_id', $user_id);
        }
        $this->db->where('opt', $twoStepPwd);

        if($query = $this->db->get()) {
            if($query->num_rows() == 1) {
                return $query->row();
            } else {
                return false;
            }
        }
    }

    public function getSecurityQuestion($user_id) {
        $this->db->select('security_question');
        $this->db->from('b2c');
        $this->db->where('user_id', $user_id);

        $query = $this->db->get();
        return $query->row();
    } 

    public function checkSecurityAnswer($user_id) {
        $this->db->select('user_id, security_question, security_answer');
        $this->db->from('b2c');
        $this->db->where('user_id', $user_id);

        $query = $this->db->get();
        return $query->row();
    }

    public function updateUserContact($user_id, $contact) {
        $data = array('contact_no'=>$contact);
        $this->db->where('user_id', $user_id);
        $this->db->update('b2c', $data);
            return true;
        
    }

    public function activateB2cMobileVerification($user_id) {
        $this->db->select('*');
        $this->db->from('user_verifications');
        $this->db->where('user_id', $user_id);

        $query = $this->db->get();
        $query_num = $query->num_rows();
        if($query_num == 0) {                   //insert if record is not already there in b2c_verification
            $data = array('user_type'=> 3, 'user_id'=>$user_id, 'mobile'=>'1');
            $this->db->insert('user_verifications', $data);
            return true;
        } else {                                   //update if it is there.
            $data = array('mobile'=>'1');       
            $this->db->where('user_id', $user_id);
            $this->db->update('user_verifications', $data);
            return true;
        }
    }

    public function getSMSalertList($user_id, $user_type) {
        $this->db->select('*');
        $this->db->from('sms_alert');
        $query = $this->db->get()->result();
        return $query;
    }

    public function getSMSalertData($user_id, $user_type) {
        $this->db->select('a.*, b.*');
        $this->db->from('sms_alert a');
        $this->db->join('sms_alert_enabled b', 'a.sms_alert_id = b.alert_action_id');
        $this->db->where('b.user_id', $user_id);
        $this->db->where('b.user_type', $user_type);
        $query = $this->db->get()->result();
        return $query;
    }

    public function changeSMSalertstatus($user_id, $user_type, $alert_id) {
        $this->db->select("*");
        $this->db->from("sms_alert_enabled");
        $this->db->where("user_id", $user_id);
        $this->db->where("user_type", $user_type);
        $this->db->where("alert_action_id", $alert_id);
        $query_rows = $this->db->get()->num_rows();

        if($query_rows == 1) {
            if($this->updateSMSalertStatus($user_id, $user_type, $alert_id)) {
                return true;
            }
        } else {
            if($this->insertSMSalertStatus($user_id, $user_type, $alert_id)) {
                return true;
            }
        }
    }

    public function insertSMSalertStatus($user_id, $user_type, $alert_id) {
        $data = array('user_id'=>$user_id, 'user_type'=>$user_type, 'alert_action_id'=>$alert_id, 'alert_status'=>'1');
        $this->db->insert('sms_alert_enabled', $data);
        return true;
        
    }

    public function updateSMSalertStatus($user_id, $user_type, $alert_id) {
        /*
        *Note: Not using codeigniter syntax for this query as codeigniter throws unedxpected errors.
        */

        $toggleStatus = "UPDATE sms_alert_enabled
                         SET alert_status=1-alert_status 
                         WHERE user_id=".mysql_real_escape_string($user_id)." AND user_type=".mysql_real_escape_string($user_type)." AND alert_action_id=".mysql_real_escape_string($alert_id);

        if($this->db->query($toggleStatus)) {
            return true;
        } else {
            return false;
        }
    
    }



}

