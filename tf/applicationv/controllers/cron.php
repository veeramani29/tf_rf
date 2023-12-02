<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('Cron_Model');
        $this->load->model('email_model');
	    $this->load->model('account_model');
		$this->load->model('apartment_model');
		
    }

	
	function send_email_review()
	{
		$result = $this->Cron_Model->get_global_booking_data();
							
		if($result!='')
		{
			for($k=0;$k<count($result);$k++)
			{
					$key = $this->generate_random_key();
					$apartment_id = $result[$k]->PROP_ID;
					
					$user_id = $result[$k]->USER_ID;		//guest
					$user_type = $result[$k]->USER_TYPE;    //guest
					
					$host_type =  $result[$k]->PROP_USER_TYPE;  //owner of the property
					$host_id = $result[$k]->PROP_USER_ID;       //owner of the property

					//###########################     USER REVIEW    ##########################################
					if($result[$k]->review_user_status==0)
					{ 
					
					$email_type = 'User Reviews About Property';
        			$data_user['email_template'] = $this->email_model->get_email_template($email_type)->row();
        
					$data_user['user_data'] = $this->account_model->GetUserData($user_type, $user_id)->row(); //about guest
					$data_user['host_data'] = $this->account_model->GetUserData($host_type, $host_id)->row(); //about host
					$data_user['PROPIMAGE'] = $this->apartment_model->view_property_file($result[$k]->PROP_PHOTO);
					$data_user['PROPCITY'] =$result[$k]->PROP_CITY.', '.$result[$k]->PROP_COUNTRY_NAME;
					$data_user['PROPNAME'] =$result[$k]->PROP_NAME;
       				$data_user['email_access'] = $this->email_model->get_email_acess()->row();
					
					if(isset($data_user['user_data']->email) && $data_user['user_data']->email != "") {
						$user_email_id = $data_user['user_data']->email;
						$user_type_toSecret = 3;
						$secret_user = md5($user_email_id);	
					} else if(isset($data_user['user_data']->email_id) && $data_user['user_data']->email_id != ""){
						$user_email_id = $data_user['user_data']->email_id;
						$user_type_toSecret = 2;
						$secret_user = md5($user_email_id);	
					} else {
						return false;
					}

					$User_review = array(
						'user_id' => $user_id,
						'user_type' => $user_type,
						'apartment_id' => $apartment_id,
						'secret' =>$secret_user,
						'booking_apartment_id' =>$result[$k]->ID,
						'host_id' => $host_id,
						'host_type' => $host_type,
						'vid' => $key
					);

					$user_type_secret = md5($user_type_toSecret);
					
					$data_user['review_link_user'] = WEB_URL.'/users/validateReview/'.$key.'/'.$secret_user.'/'.$user_type_secret;
					$data_user['REVIEWSTOPLINK'] = WEB_URL.'/users/validateReview/'.$key.'/'.$secret_user.'/'.$user_type_secret.'/1';
						
					$this->Cron_Model->addReferenceuser($User_review);
					$data_user['user_email'] = $user_email_id;

					$this->email_model->send_email_review_user($data_user);
					}
					//###########################     USER REVIEW About Property  ##########################################
					
					
					//###########################     HOST REVIEW     ##########################################
					
					if($result[$k]->review_guest_status==0)
					{ 
					$email_type = 'User Reviews About Host';
        			$data_host['email_template'] = $this->email_model->get_email_template($email_type)->row();
       				$data_host['host_data'] = $this->account_model->GetUserData($host_type, $host_id)->row();
					$data_host['user_data'] = $this->account_model->GetUserData($user_type, $user_id)->row();
       				$data_host['email_access'] = $this->email_model->get_email_acess()->row();
					
					if(isset($data_user['user_data']->email) && $data_user['user_data']->email != "") {
						$user_email_id = $data_user['user_data']->email;
						$user_type_toSecret = 3;
						$secret_user = md5($user_email_id);	
					} else if(isset($data_user['user_data']->email_id) && $data_user['user_data']->email_id != ""){
						$user_email_id = $data_user['user_data']->email_id;
						$user_type_toSecret = 2;
						$secret_user = md5($user_email_id);	
					} else {
						return false;
					}

					$secret_host = md5($user_email_id);
					$host_review = array(
						'user_id' => $user_id,
						'user_type' => $user_type,
						'review_to' => $host_id,
						'review_user_type' => $host_type,
						'secret' =>$secret_host,
						'booking_apartment_id' =>$result[$k]->ID,
						'vid' => $key
					);

					$user_type_secret = md5($user_type_toSecret);

					$data_host['review_link_host'] = WEB_URL.'/users/validateguestReview/'.$key.'/'.$secret_host.'/'.$user_type_secret;
					$data_host['REVIEWSTOPLINK'] = WEB_URL.'/users/validateguestReview/'.$key.'/'.$secret_host.'/'.$user_type_secret.'/1';
					
					$this->Cron_Model->addReferenceguest($host_review);
					$data_host['host_email'] = $user_email_id;
					
					$this->email_model->send_email_review_guest($data_host);
					}
					//###########################     HOST REVIEW     ##########################################
					//###########################     HOST REVIEW     ##########################################
					
					if($result[$k]->review_host_status==0)
					{
						
					$email_type = 'Host Reviews About Guest';
        			$data_host['email_template'] = $this->email_model->get_email_template($email_type)->row();
       				$data_host['host_data'] = $this->account_model->GetUserData($host_type, $host_id)->row();
					$data_host['user_data'] = $this->account_model->GetUserData($user_type, $user_id)->row();
       				$data_host['email_access'] = $this->email_model->get_email_acess()->row();
					
					if(isset($data_host['host_data']->email) && $data_host['host_data']->email != "") {
						$host_email_id = $data_host['host_data']->email;
						$secret_host = md5($data_host['host_data']->email);
						$host_type_toSecret = 3;
					} else if(isset($data_host['host_data']->email_id) && $data_host['host_data']->email_id != "") {
						$host_email_id = $data_host['host_data']->email_id;
						$secret_host = md5($data_host['host_data']->email_id);
						$host_type_toSecret = 2;
					} else {
						return false;
					}

					
					$host_type_secret = md5($host_type_toSecret);

					$host_review = array(
						'host_id' => $host_id,
						'host_type' => $host_type,
						'review_to' => $user_id,
						'review_user_type' => $user_type,
						'secret' =>$secret_host,
						'booking_apartment_id' =>$result[$k]->ID,
						'vid' => $key
					);
					$data_host['review_link_host'] = WEB_URL.'/users/validatehostReview/'.$key.'/'.$secret_host.'/'.$host_type_secret;
					$data_host['REVIEWSTOPLINK'] = WEB_URL.'/users/validatehostReview/'.$key.'/'.$secret_host.'/'.$host_type_secret.'/1';
					
					$this->Cron_Model->addReferencehost($host_review);
					$data_host['host_email'] = $host_email_id;
					$this->email_model->send_email_review_host($data_host);
					}
					//###########################     HOST REVIEW     ##########################################
					
			}
			
		}
	}
    
	 public function generate_random_key($length = 50) {
			$alphabets = range('A','Z');
			$numbers = range('0','9');
			$additional_characters = array('_','.');
			$final_array = array_merge($alphabets,$numbers,$additional_characters);
				 
			$id = '';
		  
			while($length--) {
			  $key = array_rand($final_array);
			  $id .= $final_array[$key];
			}
			return $id;
		}
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */
