<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------|
| Author: Provab Technosoft Pvt Ltd.									   |
|--------------------------------------------------------------------------|
| Developer: Provab											   |
| Started Date: 2014-08-19T18:00:00										   |
| Ended Date:  										   					   |
|--------------------------------------------------------------------------|
*/

class Account_Model extends CI_Model {
	public function isRegistered($email){
		//echo $email;exit;
		$this->db->where('email', $email);
		return $this->db->get('b2c');
	}

	public function createUsers($postData){
		return $this->db->insert('b2c',$postData);
	}

	public function isValidUser($email, $password){
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		return $this->db->get('b2c');
	}

	public function getUserInfo($b2c_id){
		$this->db->where('user_id', $b2c_id);
		return $this->db->get('b2c');
	}

	public function getUserInfoEmail($email){
		$this->db->where('email', $email);
		return $this->db->get('b2c');
	}

	public function getUserInfoEmailB2b($email){
		$this->db->where('email_id', $email);
		return $this->db->get('b2b');
	}

	public function updatePwdResetLink($b2c_id,$key,$secret){
		$update = array(
			'key' => $key,
			'secret' => $secret
		);
		$this->db->where('user_id', $b2c_id);
		return $this->db->update('b2c', $update);
	}

	public function updatePwdResetLinkB2b($user_id,$key,$secret){
		$update = array(
			'key' => $key,
			'secret' => $secret
		);
		$this->db->where('agent_id', $user_id);
		return $this->db->update('b2b', $update);
	}

	public function isvalidSecrect($key,$secret){  //this method is valid for b2c only. the b2b sign up process will ensure the genuinity of the email.
		$this->db->where('key', $key);
		$this->db->where('secret', $secret);
		return $this->db->get('b2c');
	}

	public function update_b2c($update,$email){
		$this->db->where('email', $email);
		$this->db->update('b2c', $update);
	}

	public function update_b2b($update,$email){
		$this->db->where('email_id', $email);
		$this->db->update('b2b', $update);
	}
public function assignDefaultverfication($user_id,$user_type) {
	
		$data = array('user_type'=>'3', 'user_id'=>$user_id);
		$this->db->insert('user_verifications', $data);
		return true;
	}
public function assignDefaultverfication_agent($user_id,$user_type) {
	
		$data = array('user_type'=>'2', 'user_id'=>$user_id);
		$this->db->insert('user_verifications', $data);
		return true;
	}

	public function update_b2c_user($update,$b2c_id){
		$this->db->where('user_id', $b2c_id);
		if($this->db->update('b2c', $update)) {
			return true;
		}
	}

	public function update_b2b_user($update,$b2b_id){
		$this->db->where('agent_id', $b2b_id);
		if($this->db->update('b2b', $update)) {
			return true;
		}
	}

	public function getUserEmergency($user_type,$b2c_id){
		$this->db->where('user_type', $user_type);
		$this->db->where('user_id', $b2c_id);
		return $this->db->get('emergency_contact');
	}

	public function GetUserData($user_type, $user_id){

		if($user_type == '3'){
			$this->db->where('user_id', $user_id);
            return $this->db->get('b2c');
        }else if($user_type == '2'){
        	$this->db->where('agent_id', $user_id);
            return $this->db->get('b2b');
        }
	}

	public function update_emergency_contact($update,$user_type,$b2c_id){
		$this->db->where('user_type', $user_type);
		$this->db->where('user_id', $b2c_id);
		$this->db->update('emergency_contact', $update);
	}

	public function createEmergency($emergency){
		return $this->db->insert('emergency_contact',$emergency);
	}
	
	public function validatePassword($user_id,$opassword){
		$this->db->where('user_id', $user_id);
		$this->db->where('password', $opassword);
		return $this->db->get('b2c');
	}

	public function validatePasswordB2b($user_id,$opassword){
		$this->db->where('agent_id', $user_id);
		$this->db->where('password', $opassword);
		return $this->db->get('b2b');
	}

	public function update_b2c_user_listing_property_access($data){
		if($data['access_listings'] == 'on'){
			$this->db->where('user_id', $this->session->userdata('b2c_id'));
			$this->db->update('b2c', array('property_owner_request' => 1));
		}		
	}

	public function update_b2b_user_listing_property_access($data){
		if($data['access_listings'] == 'on'){
			$this->db->where('agent_id', $this->session->userdata('b2b_id'));
			$this->db->update('b2b', array('property_owner_request' => 1));
		}		
	}

	public function getTimeZones(){
		return $this->db->get('timezones');
	}

	public function getLanguages(){
		return $this->db->get('language');
	}

	public function getLanguageById($code){
		$this->db->where('code', $code);
		return $this->db->get('language');
	}

	//Public Profile
	public function getPublicProfile($user_id,$user_type){
		if($user_type == '3'){
			$this->db->where('user_id', $user_id);
            return $this->db->get('b2c');
        }else if($user_type == '2'){
        	$this->db->where('agent_id', $user_id);
            return $this->db->get('b2b');
        }
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

	public function checkPswrdAvail($user_id) {
		$this->db->select('password');
		$this->db->from('b2c');
		$this->db->where('user_id', $user_id);

		$query = $this->db->get();
		return $query->row();
	}

	public function B2b_checkPswrdAvail($user_id) {
		$this->db->select('password');
		$this->db->from('b2b');
		$this->db->where('agent_id', $user_id);

		$query = $this->db->get();
		return $query->row();
	}

	//Delete user account and other data for b2c {
	public function deleteUserAccount($user_id) {

		$this->db->where('user_id', $user_id);
		$this->db->delete('b2c');

		return true;
	}

	public function deleteb2cverification($user_id, $user_type) {
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type', $user_type);
		$this->db->delete('user_verifications');

		return true;
	}

	public function deleteWishlist($user_id, $user_type) {
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type', $user_type);
		$this->db->delete('wishlist');

		return true;
	}

	public function deleteWishlist_type($user_id, $user_type) {
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type', $user_type);
		$this->db->delete('wishlist_type');

		return true;
	}	

	public function deleteSMSalertType($user_id, $user_type) {
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type', $user_type);
		$this->db->delete('sms_alert_enabled');

		return true;
	}

	public function getSupportTicketNumber($user_id, $user_type) {
		$this->db->select('support_ticket_id');
		$this->db->from('support_ticket');
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type', $user_type);

		return $this->db->get();
	}

	public function deleteSupportTicketHistory($support_id) {
		$this->db->where('support_ticket_id', $support_id);
		$this->db->delete('support_ticket_history');
	}

	public function deleteSupportTicket($user_id, $user_type) {
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type', $user_type);
		$this->db->delete('support_ticket');
	}

	public function deleteMessagesInit($user_id, $user_type) {
		$this->db->where('init_user_id', $user_id);
		$this->db->where('init_user_type', $user_type);
		$this->db->delete('user_messages');
	}	

	public function deleteMessagesRece($user_id, $user_type) {
		$this->db->where('init_receiver_id', $user_id);
		$this->db->where('init_receiver_type', $user_type);
		$this->db->delete('user_messages');
	}

	public function deleteReference($user_id, $user_type) {
		$this->db->where('b2c_id', $user_id);
		$this->db->where('user_type', $user_type);
		$this->db->delete('references');
	}

	public function deleteReviewGuestBy($user_id, $user_type) {
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type', $user_type);
		$this->db->delete('reviews_guest');
	}

	public function deleteReviewGuestTo($user_id, $user_type) {
		$this->db->where('review_to', $user_id);
		$this->db->where('review_user_type', $user_type);
		$this->db->delete('reviews_guest');
	}

	public function deleteReviewGuestDataTo($user_id, $user_type) {
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type', $user_type);
		$this->db->delete('reviews_guest_data');
	}

	public function deleteReviewGuestDataHost($user_id, $user_type) {
		$this->db->where('host_id', $user_id);
		$this->db->where('host_type', $user_type);
		$this->db->delete('reviews_guest_data');
	}

	public function deleteReviewHostTo($user_id, $user_type) {
		$this->db->where('host_id', $user_id);
		$this->db->where('host_type', $user_type);
		$this->db->delete('reviews_host');
	}

	public function deleteReviewHostBy($user_id, $user_type) {
		$this->db->where('review_to', $user_id);
		$this->db->where('review_user_type', $user_type);
		$this->db->delete('reviews_host');
	}

	public function deleteReviewHostDataTo($user_id, $user_type) {
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type', $user_type);
		$this->db->delete('reviews_host_data');
	}

	public function deleteReviewHostDataBy($user_id, $user_type) {
		$this->db->where('host_id', $user_id);
		$this->db->where('host_type', $user_type);
		$this->db->delete('reviews_host_data');
	}

	public function deleteReviewUserTo($user_id, $user_type) {
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type', $user_type);
		$this->db->delete('reviews_user');
	}

	public function deleteReviewUserBy($user_id, $user_type) {
		$this->db->where('host_id', $user_id);
		$this->db->where('host_type', $user_type);
		$this->db->delete('reviews_user');
	}

	public function deleteReviewUserDataTo($user_id, $user_type) {
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type', $user_type);
		$this->db->delete('reviews_user_data');
	}

	public function deleteReviewUserDataBy($user_id, $user_type) {
		$this->db->where('host_id', $user_id);
		$this->db->where('host_type', $user_type);
		$this->db->delete('reviews_user_data');
	}

	//End of user account deletion block }

	//Delete user account and other data for B2B {

	public function b2b_deleteUserAccount($user_id) {
		$this->db->where('agent_id', $user_id);
		$this->db->delete('b2b');

		return true;
	}

	public function b2b_deleteb2cverification($user_id, $user_type) {
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type', $user_type);
		$this->db->delete('user_verifications');

		return true;
	}

	public function b2b_deleteWishlist($user_id, $user_type) {
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type', $user_type);
		$this->db->delete('wishlist');

		return true;
	}

	public function b2b_deleteWishlist_type($user_id, $user_type) {
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type', $user_type);
		$this->db->delete('wishlist_type');

		return true;
	}	

	public function b2b_deleteSMSalertType($user_id, $user_type) {
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type', $user_type);
		$this->db->delete('sms_alert_enabled');

		return true;
	}

	public function deleteB2bAccountInfo($user_id) {
		$this->db->where('agent_id', $user_id);
		$this->db->delete('b2b_acc_info');

		return true;
	}

	public function deleteB2bDeposit($user_id) {
		$this->db->where('agent_id', $user_id);
		$this->db->delete('b2b_deposit');

		return true;	
	}

	public function deleteB2bTopCities($user_id) {
		$this->db->where('agent_id', $user_id);
		$this->db->delete('b2b_top_cities');

		return true;	
	}

	//End of delete user account and other data for B2B }



	public function addSubscriberEmail($data) {
		$insertData = $this->db->insert('newsletter_subscriber', $data);
		
		if($insertData) {
			return true;
		} else {
			return false;
		}
	}	

	public function addB2cNewsletterSub($user_id) {
		$data = array('newsletter_subscribe' => 1);
		$this->db->where('user_id', $user_id);
		
		$this->db->update('b2c', $data);
		return true;
	}

	public function addB2bNewsletterSub($user_id) {
		$data = array('newsletter_subscribe' => 1);
		$this->db->where('agent_id', $user_id);
		
		$this->db->update('b2b', $data);
		return true;
	}

	public function checkSubEmailB2c($current_b2c_session, $subscriberEmail){
		$this->db->select('email');
		$this->db->from('b2c');
		$this->db->where('email', $subscriberEmail);
		$this->db->where('user_id', $current_b2c_session);

		$query = $this->db->get();
		return $query;
	}

	public function checkSubEmailB2b($current_b2c_session, $subscriberEmail){
		$this->db->select('email_id');
		$this->db->from('b2b');
		$this->db->where('email_id', $subscriberEmail);
		$this->db->where('agent_id', $current_b2c_session);

		$query = $this->db->get();
		return $query;
	}

	public function addB2cNewsletterSubCheckBx($user_id, $data) {
		$this->db->where('user_id', $user_id);
		$this->db->update('b2c', $data);
		return true;
	}

	public function addB2bNewsletterSubCheckBx($user_id, $data) {
		$this->db->where('agent_id', $user_id);
		$this->db->update('b2b', $data);
		return true;
	}

	public function getNewsletterStatus($user_id,$user_type) {
		$this->db->select('newsletter_subscribe');
		if($user_type == '3'){
			$this->db->where('user_id', $user_id);
            return $this->db->get('b2c');
        }else if($user_type == '2'){
        	$this->db->where('agent_id', $user_id);
            return $this->db->get('b2b');
        }
	}

	public function isSubscribed($subscriberEmail) {
		$this->db->where('email_id', $subscriberEmail);
		$query = $this->db->get('newsletter_subscriber');
		return $query;
	}

	//Agent starts here

	public function isAgentRegistered($email){
		$this->db->where('email_id', $email);
		return $this->db->get('b2b');
	}

	public function isValidAgent($email, $password){
		$this->db->where('email_id', $email);
		$this->db->where('password', $password);
		return $this->db->get('b2b');
	}

	public function createAgent($postData){
		return $this->db->insert('b2b',$postData);
	}

	public function verifyAgentContactDetails($agent_id, $email_code, $mobile_code) {
		$this->db->select('*');
		$this->db->from('b2b');
		$this->db->where('agent_id', $agent_id);
		$this->db->where('temp_email_opt', $email_code);

		return $this->db->get();
	}
public function verifyAgentContactDetails_v1($vid, $email_code, $mobile_code) {
		$this->db->select('*');
		$this->db->from('b2b');
		$this->db->where('verification_code', $vid);
		$this->db->where('temp_email_opt', $email_code);
		$this->db->where('temp_mobile_opt', $mobile_code);

		return $this->db->get();
	}
public function verifyAgentContactDetails_v2($vid) {
		$this->db->select('*');
		$this->db->from('b2b');
		$this->db->where('verification_code', $vid);
	

		return $this->db->get();
	}
	public function changeAgentStatus($b2b_id) {
		$data = array('status'=>0);
		$this->db->where('agent_id', $b2b_id);
		$this->db->update('b2b', $data);
		return true;
	}

	public function agent_deposit_details($b2b_id) {
		$this->db->where('agent_id', $b2b_id);
		return $this->db->get('b2b_deposit');
	}
	public function get_account_statment($b2b_id) {
		$this->db->where('user_id', $b2b_id);
		$this->db->order_by('statdate', 'DESC');
		return $this->db->get('account_statment');
	}
	public function get_deposit_amount($b2b_id) {
		$this->db->where('agent_id', $b2b_id);
		return $this->db->get('b2b_acc_info');
	}

	public function saveDeposit_model($agent_id, $amount, $deposit_date, $remark) {

		$this->db->select('max(deposit_id)+1 as max_id');
		$this->db->from('b2b_deposit');
		$query_run = $this->db->get();

		$query_row = $query_run->row();
		
		if(!empty($query_row)) {
			$m_id = $query_row->max_id;
		}
		$transaction_id = 'AT'.date('d').date('m').($m_id+10000);

		$data = array(
					'agent_id'=>$agent_id,
					'amount_credit'=>$amount,
					'deposited_date'=>$deposit_date,
					'transaction_id'=>$transaction_id,
					'remarks'=>$remark
				);
		$this->db->insert('b2b_deposit', $data);
		return true;
	}

	public function contactAdmin_model($data) {
		$this->db->insert('user_failed_verifications', $data);
		return true;
	}

	public function initializeAccountInfo_model($agent_id) {
        $data = array('agent_id'=>$agent_id, 'balance_credit'=>0, 'last_credit'=>0);
        $this->db->insert('b2b_acc_info', $data);
        return true;
    }

    public function update_credit_amount($update_credit_amount,$b2b_id){
		$this->db->where('agent_id',$b2b_id);
		$this->db->update('b2b_acc_info',$update_credit_amount); 
	}

	public function update_payment_transaction($payment_transaction){
		$this->db->insert('booking_transaction',$payment_transaction); 
	}
public function update_account_transaction($account_transaction){
		$this->db->insert('account_statment',$account_transaction); 
		$bid = $this->db->insert_id();
		$timing = date('Ymd');
		$timing1 = date('His');
		$txno = 'TX'.$timing.$bid.$timing1;
					$update_account = array(
						'statment_number' => $txno
					);
					
		$this->db->where('account_statment_id',$bid);
		
        $this->db->update('account_statment', $update_account);
					
	}

	public function get_markup($module){
    	//Get Markup Starts
		if($this->session->userdata('b2b_id')) {
			$user_type = '2';
			$b2b_id = $this->session->userdata('b2b_id');
			$markup = $this->get_agent_markup($b2b_id,$module);
			//echo '<pre>';print_r($markup->hotel_markup);
			if(!empty($markup->markup)){
				$aMarkup = array(
					'markup' => $markup->markup,
					'module' => $module,
					'type' => 'b2b'
				);	
			}else{
				$aMarkup = array(
					'markup' => 0,
					'module' => $module,
					'type' => 'b2b'
				);
			}
			return $aMarkup;
		}else{
			$markup = $this->get_user_markup($module);
			if(!empty($markup->markup)){
				
				$aMarkup = array(
					'markup' => $markup->markup,
					'module' => $module,
					'type' => 'b2c'
				);
				
			}else{
				$aMarkup = array(
					'markup' => 0,
					'module' => $module,
					'type' => 'b2c'
				);
			}
			//echo '<pre>';print_r($aMarkup);
			return $aMarkup;
		}
		//Get Markup Ends
		//echo '<pre>';print_r($aMarkup);
    }


	public function get_agent_markup($b2b_id,$module){
		//$this->db->where('hotel_country_id',$country);
		$this->db->where('agent_id',$b2b_id);
		$this->db->where('product',$module); 
		$this->db->where('markup_type','Specific'); 
		$query = $this->db->get('markup_b2b');
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			//$this->db->where('agent_id',$b2b_id);
			$this->db->where('product',$module); 
			$this->db->where('markup_type','Generic');   
			$query = $this->db->get('markup_b2b');
			if ($query->num_rows() > 0) {
				return $query->row();
			}else{
				return 0;
			}
		}
	}
	public function get_user_markup($module){
		//$this->db->where('b2c_country_id',$country);
		$this->db->where('product',$module);    
		$this->db->where('markup_type','Generic');
		$query = $this->db->get('markup_b2c');   
		//echo $this->db->last_query();
		if ($query->num_rows() > 0) {
		
			return $query->row();
		}else{
			$markup = $this->get_user_markup($module);
			if(!empty($markup->markup)){
				
				$aMarkup = array(
					'markup' => $markup->markup,
					'module' => $module,
					'type' => 'b2c'
				);
			}else{
				$aMarkup = array(
					'markup' => 0,
					'module' => $module,
					'type' => 'b2c'
				);
			}
			return $aMarkup;
		}
	}


	public function get_my_markup(){
    	//Get Markup Starts
		if($this->session->userdata('b2b_id')) {
			$user_type = '2';
			$b2b_id = $this->session->userdata('b2b_id');
			$userdata = $this->GetUserData($user_type,$b2b_id)->row();
			$markup = $userdata->markup;
			//echo '<pre>';print_r($markup->hotel_markup);
			if(!empty($userdata->markup) && $markup != 0.00){
				$aMarkup = array(
					'markup' => $userdata->markup,
					'type' => 'b2b'
				);	
			}else{
				$aMarkup = array(
					'markup' => 0,
					'type' => 'b2b'
				);
			}
			return $aMarkup;
		}else{
			$aMarkup = array(
				'markup' => 0,
				'type' => 'mymarkup'
			);
			return $aMarkup;
		}
		//Get Markup Ends
		//echo '<pre>';print_r($aMarkup);
    }

	public function PercentageToAmount($total,$percentage){
		
		$amount = ($percentage/100) * $total;
		$total = number_format(($total+$amount) ,2,'.','');
		return $total;
	}

	public function PercentageMinusAmount($total,$amount){
		//$amount = ($percentage/100) * $total;
		$total = number_format(($total-$amount) ,2,'.','');
		return $total;
	}

	public function PercentageAmount($total,$percentage){
		$amount = ($percentage/100) * $total;
		$amount = number_format(($amount) ,2,'.','');
		return $amount;
	}

	public function get_curr_val($curr){
		$curr = strtoupper($curr);
    	//$this->db->select('value');
    	$this->db->where('country',$curr);
    	$price = $this->db->get('currency_converter')->row();
    	return $value = $price->value;
    }

	public function currency_convertor($amount){
		if($this->display_currency === CURR){
    		$amount = $amount*1;
    		return number_format(($amount) ,2,'.','');
    	}else{
    		$amount = ($amount)*($this->curr_val);
    		return number_format(($amount) ,2,'.','');
    	}
	}

	public function insertInUserVerification($insert_data) {
		$this->db->insert('user_verifications', $insert_data);
		return true;
	}

	public function addMarkUp_model($agent_id, $data) {
		$this->db->where('agent_id', $agent_id);
		$this->db->update('b2b', $data);
		return true;
	}

	public function checkVerifications($user_id, $user_type) {
		$user_type = (string)$user_type;
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type', $user_type);
		return $this->db->get('user_verifications');
	}

	public function addBankDetails($data) {
		$this->db->insert('payment_method', $data);
	}

	public function checkBankDetailsExist($user_id, $user_type) {
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type', $user_type);
		return $this->db->get('payment_method');
	}

	public function updateBankDetails($data, $user_id, $user_type) {
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type', $user_type);
		$this->db->update('payment_method', $data);
	}

	public function addPaypalDetails($data) {
		$this->db->insert('payment_method', $data);
	}

	public function updatePaypalDetails($data, $user_id, $user_type) {
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type', $user_type);
		$this->db->update('payment_method', $data);
	}

	/*public function current_agent_markup_model() {
		$this->db->select('markup')
	}*/


	public function getBankDetails($user_id,$user_type) {
		$this->db->where('user_id', $user_id);
		$this->db->where('user_type', $user_type);

		return $this->db->get('payment_method');
	}

	public function getUpComingTransaction($user_id, $user_type) {
		$this->db->where('host_id', $user_id);
		$this->db->where('host_type', $user_type);
		$this->db->where('payout_status', 'Hold');
		$this->db->where('travel_date >= curdate()');

		return $this->db->get('apartment_transaction');
	}

	public function getCompletedTransaction($user_id, $user_type) {
		$this->db->where('host_id', $user_id);
		$this->db->where('host_type', $user_type);
		$this->db->where('payout_status', 'Recived');

		return $this->db->get('apartment_transaction');
	}

	public function getCurrentTransaction($user_id, $user_type) {
		
		$status = array('Process', 'Analyze', 'Deposit');
		$this->db->where('host_id', $user_id);
		$this->db->where('host_type', $user_type);
		$this->db->where_in('payout_status', $status);

		return $this->db->get('apartment_transaction');
	}

	public function getFailedTransaction($user_id, $user_type) {
		$this->db->where('host_id', $user_id);
		$this->db->where('host_type', $user_type);
		$this->db->where('payout_status', 'Failed');

		return $this->db->get('apartment_transaction');
	}

	public function updateTransactionHostStatus($user_id, $user_type, $accept_pnr, $depositStatus) {
		$this->db->where("host_id", $user_id);
		$this->db->where("host_type", $user_type);
		$this->db->where("pnr_no", $accept_pnr);

		if($this->db->update("apartment_transaction", $depositStatus)) {
			$this->db->where("pnr_no", $accept_pnr);
			return $this->db->get('apartment_transaction')->row(); //doing this to get the updated id
		}


		return true;
	}

	public function updateTransactionTracking($user_id, $user_type, $transId, $bitTrackingStatus) {
		$user_id = (int)$user_id;
		$user_type = (int)$user_type;
		$transId = (int)$transId;

		$this->db->where("host_id", $user_id);
		$this->db->where("host_type", $user_type);
		$this->db->where("apartment_transaction_id", $transId);
		$this->db->update('apartment_transaction_tracking', $bitTrackingStatus);
	}

	public function getAllCountries(){
    	return $this->db->get('country');
    }


	public function getCuntries(){
		return $this->db->get('kigo_countries');
	}

	public function getcount($code){
		$this->db->where('country_code', $code);
		return $this->db->get('country');
	}

	public function updateCuntries($update){
		$this->db->insert('country', $update);
	}

	public function getAptTransaction($pnr) {
		$this->db->where('a.pnr_no', $pnr);
		$this->db->join('apartment_transaction_tracking b', 'a.transaction_id=b.apartment_transaction_id', 'left');
		return $this->db->get('apartment_transaction a');
	}

	public function getTransactionHistory($transactionId) {
		$this->db->where('apartment_transaction_id', $transactionId);
		$this->db->order_by('m_datetime', 'desc');
		return $this->db->get('apartment_transaction_history');
	}

	public function checkAdminReq($user_id, $user_type) {
		$this->db->select('property_owner_request');
		
		if($user_type == 3){   //b2c
			$this->db->from('b2c');
			$this->db->where('user_id', $user_id);
		} else if($user_type == 2) {   //b2b
			$this->db->from('b2b');
			$this->db->where('agent_id', $user_id);
		}

		return $this->db->get();
	} 

	public function checkUserVerif($user_id, $user_type) {
		$this->db->where('user_type', (string)$user_type);
		$this->db->where('user_id', $user_id);

		return $this->db->get('user_verifications');
	}

	public function checkBankDetails($user_id, $user_type) {
		$this->db->where('user_type', $user_type);
		$this->db->where('user_id', $user_id);

		return $this->db->get('payment_method');
	}

	public function get_loyalty_points_balance($user_id, $user_type) {
		$this->db->where('UserType', $user_type);
		$this->db->where('user_id', $user_id);
		$UserLoyaltyPoints = $this->db->get('user_loyalty_info');
		 $UserLoyaltyPointsNum = $UserLoyaltyPoints->num_rows();
		if($UserLoyaltyPointsNum == 1){
			$UserLoyaltyPointsRow = $UserLoyaltyPoints->row();
			
			return $UserLoyaltyPointsRow->balance_points;
		}else{
			return '0';
		}
	}

    public function ReturnRedeemPoints($TotalAmount){
    	if(isset($_SESSION['RedeemStatus']) && $_SESSION['RedeemStatus'] == 'Yes'){
	        $user_type = $this->session->userdata('user_type');
	        $user_id = $this->session->userdata('b2c_id');
	        $PointsDetails = $this->account_model->get_loyalty_points_balance($user_id, $user_type);
	        /*if($TotalAmount > $PointsDetails){
	        	$TotalPayableAmt = $TotalAmount - $PointsDetails;
	        }
	        elseif($PointsDetails > $TotalAmount){
        		$TotalPayableAmt = 0;
	        }
	        else{
        		$TotalPayableAmt = $TotalAmount;
	        }*/
	        $_SESSION['RedeemPoints'] = $PointsDetails;
	        return $PointsDetails;
       }else{
       		return "NR";
       }
    }
}

