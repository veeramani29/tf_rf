<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------|
| Author: Provab Technosoft Pvt Ltd.									   |
|--------------------------------------------------------------------------|
| Developer: Provab											   |
| Started Date: 2014-09-11T11:45:00										   |
| Ended Date:  										   					   |
|--------------------------------------------------------------------------|
*/

class Sms_Model extends CI_Model {
	
	public function send_mobileVerification_sms($mobile_number,$mobile_opt_number)
	{
		  $text_message = "Your Ticketfinder verification code is ".$mobile_opt_number;
        $from = "Ticketfinder";
    //  uncomment to send sms
       
    
        //$response = file(WEB_URL.'/agent/mobile_test?test=hello world'); //get response from the dummy function.
       return  ''; //get response from the url
	}
	public function send_verifytwostep_sms($mobile_number,$mobile_opt_number)
	{
		 $text_message = "Your Ticketfinder verification code is ".$mobile_opt_number;
			$from = "Ticketfinder";

		 //   uncomment to send sms
         
			
			
       return  '';
	}
	public function sms_change_password($user_type,$user_id)
	{
					$this->db->where('user_id',$user_id);
					$this->db->where('user_type',"$user_type");  
					$this->db->where('mobile','1');      
					$query1 = $this->db->get('user_verifications'); 
					
					if ($query1->num_rows() > 0) {
					
							if($user_type=3)
							{
								
								$this->db->where('user_id',$user_id);
								$query2 = $this->db->get('b2c');   
								if ($query2->num_rows() > 0) {
										$user_details = $query2->row();
										$contact_no =$user_details->contact_no;
										$firstname =$user_details->firstname;
										
										$this->db->where('user_id',$user_id);
										$this->db->where('user_type',$user_type);
										$this->db->where('alert_action_id','2');   
										$this->db->where('alert_status','1');   
										$query3 = $this->db->get('sms_alert_enabled');   
										if ($query3->num_rows() > 0) {
										
											
												
													
													
												
										
										}
								}
							}
							if($user_type=2)
							{
								
								$this->db->where('agent_id',$user_id);
								$query2 = $this->db->get('b2b');   
								if ($query2->num_rows() > 0) {
										$user_details = $query2->row();
										$contact_no =$user_details->mobile;
										$firstname =$user_details->firstname;
										
										$this->db->where('user_id',$user_id);
										$this->db->where('user_type',$user_type);
										$this->db->where('alert_action_id','2');   
										$this->db->where('alert_status','1');   
										$query3 = $this->db->get('sms_alert_enabled');   
										if ($query3->num_rows() > 0) {
										
										
													
												
										
										}
								}
							}
					}
	}
	public function sms_contact_host($current_user_id,$current_user_type,$receiver_id,$receiver_type,$message)
	{
				
		 			$this->db->where('user_id',$receiver_id);
					$this->db->where('user_type',$receiver_type);  
					$this->db->where('mobile','1');      
					$query1 = $this->db->get('user_verifications'); 
					
					if ($query1->num_rows() > 0) {
					
							if($receiver_type=3)
							{
								
								$this->db->where('user_id',$receiver_id);
								$query2 = $this->db->get('b2c');   
								if ($query2->num_rows() > 0) {
										$user_details = $query2->row();
										$contact_no =$user_details->contact_no;
										$firstname =$user_details->firstname;
										
										$this->db->where('user_id',$receiver_id);
										$this->db->where('user_type',$receiver_type);
										$this->db->where('alert_action_id','4');   
										$this->db->where('alert_status','1');   
										$query3 = $this->db->get('sms_alert_enabled');   
										if ($query3->num_rows() > 0) {
										
												if($current_user_type==3)
												{
													$this->db->where('user_id',$current_user_id);
													$query4 = $this->db->get('b2c');   
													if ($query4->num_rows() > 0) {
														$user_details2 = $query4->row();
														$firstname1 =$user_details2->firstname;
													
													}
												}
												if($current_user_type==2)
												{
													$this->db->where('agent_id',$current_user_id);
													$query4 = $this->db->get('b2b');   
													if ($query4->num_rows() > 0) {
											
																
														$user_details2 = $query4->row();
														$firstname1 =$user_details2->firstname;
									
													}
												}
										
										}
								}
							}
							if($user_type=2)
							{
								
								$this->db->where('agent_id',$receiver_id);
								$query2 = $this->db->get('b2b');   
								if ($query2->num_rows() > 0) {
										$user_details = $query2->row();
										$contact_no =$user_details->mobile;
										$firstname =$user_details->firstname;
										
										$this->db->where('user_id',$receiver_id);
										$this->db->where('user_type',$receiver_type);
										$this->db->where('alert_action_id','4');   
										$this->db->where('alert_status','1');   
										$query3 = $this->db->get('sms_alert_enabled');   
										if ($query3->num_rows() > 0) {
										
												if($current_user_type==3)
												{
													$this->db->where('user_id',$current_user_id);
													$query4 = $this->db->get('b2c');   
													if ($query4->num_rows() > 0) {
														$user_details2 = $query4->row();
														$firstname1 =$user_details2->firstname;
												}
												}
												if($current_user_type==2)
												{
													$this->db->where('agent_id',$current_user_id);
													$query4 = $this->db->get('b2b');   
													if ($query4->num_rows() > 0) {
											
																
														$user_details2 = $query4->row();
														$firstname1 =$user_details2->firstname;
										
													}
												}
										
										}
								}
							}
					}
								
		
	}
	
	public function sms_contact_host_reply($current_user_id,$current_user_type,$receiver_id,$receiver_type)
	{
				
		 			$this->db->where('user_id',$receiver_id);
					$this->db->where('user_type',$receiver_type);  
					$this->db->where('mobile','1');      
					$query1 = $this->db->get('user_verifications'); 
					
					if ($query1->num_rows() > 0) {
					
							if($receiver_type=3)
							{
								
								$this->db->where('user_id',$receiver_id);
								$query2 = $this->db->get('b2c');   
								if ($query2->num_rows() > 0) {
										$user_details = $query2->row();
										$contact_no =$user_details->contact_no;
										$firstname =$user_details->firstname;
										
										$this->db->where('user_id',$receiver_id);
										$this->db->where('user_type',$receiver_type);
										$this->db->where('alert_action_id','4');   
										$this->db->where('alert_status','1');   
										$query3 = $this->db->get('sms_alert_enabled');   
										if ($query3->num_rows() > 0) {
										
												if($current_user_type==3)
												{
													$this->db->where('user_id',$current_user_id);
													$query4 = $this->db->get('b2c');   
													if ($query4->num_rows() > 0) {
														$user_details2 = $query4->row();
														$firstname1 =$user_details2->firstname;
														
													}
												}
												if($current_user_type==2)
												{
													$this->db->where('agent_id',$current_user_id);
													$query4 = $this->db->get('b2b');   
													if ($query4->num_rows() > 0) {
											
																
														$user_details2 = $query4->row();
														$firstname1 =$user_details2->firstname;
																			
													}
												}
										
										}
								}
							}
							if($user_type=2)
							{
								
								$this->db->where('agent_id',$receiver_id);
								$query2 = $this->db->get('b2b');   
								if ($query2->num_rows() > 0) {
										$user_details = $query2->row();
										$contact_no =$user_details->mobile;
										$firstname =$user_details->firstname;
										
										$this->db->where('user_id',$receiver_id);
										$this->db->where('user_type',$receiver_type);
										$this->db->where('alert_action_id','4');   
										$this->db->where('alert_status','1');   
										$query3 = $this->db->get('sms_alert_enabled');   
										if ($query3->num_rows() > 0) {
										
												if($current_user_type==3)
												{
													$this->db->where('user_id',$current_user_id);
													$query4 = $this->db->get('b2c');   
													if ($query4->num_rows() > 0) {
														$user_details2 = $query4->row();
														$firstname1 =$user_details2->firstname;
													
													}
												}
												if($current_user_type==2)
												{
													$this->db->where('agent_id',$current_user_id);
													$query4 = $this->db->get('b2b');   
													if ($query4->num_rows() > 0) {
											
																
														$user_details2 = $query4->row();
														$firstname1 =$user_details2->firstname;
												
													}
												}
										
										}
								}
							}
					}
								
		
	}
	
	public function send_booking_sms($pnr)
	{
	
			$this->db->where('pnr_no',$pnr);    
			$query = $this->db->get('booking_global');   
			if ($query->num_rows() > 0) {
				$book_details = $query->row();
				$user_id =$book_details->user_id;
				$user_type = $book_details->user_type;
				
					$this->db->where('user_id',$user_id);
					$this->db->where('user_type',$user_type);  
					$this->db->where('mobile','1');      
					$query1 = $this->db->get('user_verifications'); 
					
					if ($query1->num_rows() > 0) {
					
							if($user_type=3)
							{
								
								$this->db->where('user_id',$user_id);
								$query2 = $this->db->get('b2c');   
								if ($query2->num_rows() > 0) {
										$user_details = $query2->row();
										$contact_no =$user_details->contact_no;
										
										$this->db->where('user_id',$user_id);
										$this->db->where('user_type',$user_type);
										$this->db->where('alert_action_id','1');   
										$this->db->where('alert_status','1');   
										$query3 = $this->db->get('sms_alert_enabled');   
										if ($query3->num_rows() > 0) {
										
										$pnr_no = $book_details->pnr_no;
										$module = $book_details->module;
										$leadpax = $book_details->leadpax;
										$booking_status = $book_details->booking_status;
										
									
										}
								}
							}
							if($user_type=2)
							{
								$this->db->where('agent_id',$user_id);
								$query2 = $this->db->get('b2b');   
								if ($query2->num_rows() > 0) {
										$user_details = $query2->row();
										$contact_no =$user_details->mobile;
										
										$this->db->where('user_id',$user_id);
										$this->db->where('user_type',$user_type);
										$this->db->where('alert_action_id','1');   
										$this->db->where('alert_status','1');   
										$query3 = $this->db->get('sms_alert_enabled');   
										if ($query3->num_rows() > 0) {
										
										$pnr_no = $book_details->pnr_no;
										$module = $book_details->module;
										$leadpax = $book_details->leadpax;
										$booking_status = $book_details->booking_status;
									
										}
								}
							}
					}
				
			}
		
}

public function send_booking_host_sms($user_type,$user_id,$pnr,$status_n)
	{
	$status='';
	if($status_n=='1')
	{
		$status = ' and waiting for your confrimation';
	}
			$this->db->where('pnr_no',$pnr);    
			$query = $this->db->get('booking_global');   
			if ($query->num_rows() > 0) {
				$book_details = $query->row();
				
					$this->db->where('user_id',$user_id);
					$this->db->where('user_type',$user_type);  
					$this->db->where('mobile','1');      
					$query1 = $this->db->get('user_verifications'); 
					
					if ($query1->num_rows() > 0) {
					
							if($user_type=3)
							{
								
								$this->db->where('user_id',$user_id);
								$query2 = $this->db->get('b2c');   
								if ($query2->num_rows() > 0) {
										$user_details = $query2->row();
										$contact_no =$user_details->contact_no;
										$firstname =$user_details->firstname;
										$this->db->where('user_id',$user_id);
										$this->db->where('user_type',$user_type);
										$this->db->where('alert_action_id','3');   
										$this->db->where('alert_status','1');   
										$query3 = $this->db->get('sms_alert_enabled');   
										if ($query3->num_rows() > 0) {
										
										$pnr_no = $book_details->pnr_no;
										$module = $book_details->module;
										$leadpax = $book_details->leadpax;
										$booking_status = $book_details->booking_status;
										
										
										}
								}
							}
							if($user_type=2)
							{
								
								$this->db->where('agent_id',$user_id);
								$query2 = $this->db->get('b2b');   
								if ($query2->num_rows() > 0) {
										$user_details = $query2->row();
										$contact_no =$user_details->mobile;
										$firstname =$user_details->firstname;
										$this->db->where('user_id',$user_id);
										$this->db->where('user_type',$user_type);
										$this->db->where('alert_action_id','3');   
										$this->db->where('alert_status','1');   
										$query3 = $this->db->get('sms_alert_enabled');   
										if ($query3->num_rows() > 0) {
										
										$pnr_no = $book_details->pnr_no;
										$module = $book_details->module;
										$leadpax = $book_details->leadpax;
										$booking_status = $book_details->booking_status;
										
									
										}
								}
							}
					}
				
			}
		
}
	
	
}

