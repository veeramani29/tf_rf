<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
* Vikas Arora
* contact host: Messaging and conversations.
*/


class Messages extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Message_Model');
		$this->load->model('Auth_Model');

		$this->load->model('Help_Model');
        $this->helpMenuLink = $this->Help_Model->fetchHelpLinks();


		$this->islogged_in();
	}

	public function islogged_in(){
        if($this->session->userdata('b2c_id')) {
        	$current_logged_in_id = $this->session->userdata('b2c_id');
        } else if($this->session->userdata('b2b_id')) {
        	$current_logged_in_id = $this->session->userdata('b2b_id');
        } else {
        	redirect(WEB_URL);
        }
	}

	public function strStar() {
		if($this->session->userdata('b2c_id')) {
        	$user_id = $this->session->userdata('b2c_id');
        } else if($this->session->userdata('b2b_id')) {
        	$user_id = $this->session->userdata('b2b_id');
        } else {
        	$user_id = "";
        }

        if($user_id != "") {
        	$msg_id = $this->input->post('msgId');
			$this->Message_Model->strStar($user_id, $msg_id);
		
			$response = array('status' => 1);
			echo json_encode($response);	
        } else {
        	$response = array('status' => 0);
			echo json_encode($response);	
        }
		
	}

	public function contactHost() { //from the detail page, insert message
		
		if($this->session->userdata('b2c_id')) {
			$current_user_id = $this->session->userdata('b2c_id');	
		} else if($this->session->userdata('b2b_id')) {
			$current_user_id = $this->session->userdata('b2b_id');	
		} else {
			$response = array('status'=>0);
			echo json_encode($response);
			return false;
		}

		$current_user_type = $this->session->userdata('user_type');

		$receiver_id = $this->input->post('cntctrId');
		$receiver_type = $this->input->post('cntctrType');
		$message = $this->input->post('msgCntnt');
		$checkin = $this->input->post('check_in');
		$checkout = $this->input->post('check_out');
		$checkinFormated =  date('Y-m-d', strtotime($checkin));
		$checkoutFormated = date('Y-m-d', strtotime($checkout));
		
		$adultCount = $this->input->post('adltCnt');
		$childCount = $this->input->post('childCount');
		$infantCount = $this->input->post('infantCount');
		$property_id = $this->input->post('prop_id');
		$message_DateTime = date('Y-m-d H:i:s');

		$message_id = $this->generate_random_key(10);

		$data = array('message_id'=>$message_id, 
					  'sender_id'=>$current_user_id, 
					  'receiver_id'=>$receiver_id, 
					  'init_user_id'=>$current_user_id, 
					  'init_receiver_id'=>$receiver_id, 
					  'init_user_type'=>$current_user_type,
					  'init_receiver_type'=>$receiver_type,
					  'check_in'=>$checkinFormated, 
					  'check_out'=>$checkoutFormated, 
					  'message'=>$message,
					  'adult'=>$adultCount, 
					  'children'=>$childCount, 
					  'infant'=>$infantCount,
					  'property_id'=>$property_id,
					  'msg_date_time'=>$message_DateTime);
		
		$this->sms_model->sms_contact_host($current_user_id,$current_user_type,$receiver_id,$receiver_type,$message);

		$insertMsg = $this->Message_Model->insertMessage($data);
		if($insertMsg) {
			$response = array('status'=>1);
			echo json_encode($response);
		}
	}

	public function generate_random_key($length = 50) {
        $alphabets = range('A','Z');
        $numbers = range('0','9');
        $final_array = array_merge($alphabets,$numbers);
        $id = '';
        while($length--) {
          $key = array_rand($final_array);
          $id .= $final_array[$key];
        }
        return $id;
    }

	public function strArchive() {
		if($this->session->userdata('b2c_id')) {
        	$user_id = $this->session->userdata('b2c_id');
        } else if($this->session->userdata('b2b_id')) {
        	$user_id = $this->session->userdata('b2b_id');
        } else {
        	$user_id = "";
        }

		if($user_id != "") {
			$msg_id = $this->input->post('msgId');
			$this->Message_Model->strArchive($user_id, $msg_id);
			$response = array('status' => 1);
			echo json_encode($response);	
		} else {
			$response = array('status' => 0);
			echo json_encode($response);	
		}
		
	}

	public function filter_msg($filterType = null, $ajaxRequest = null) {
		if($this->session->userdata('b2c_id')) {
        	$user_id = $this->session->userdata('b2c_id');
        } else if($this->session->userdata('b2b_id')) {
        	$user_id = $this->session->userdata('b2b_id');
        } else {
        	$user_id = "";
        }
        if($user_id != "") {
        	if($filterType != "") {
				$data['getFilteredMsg'] = $this->Message_Model->getMessage($user_id, $filterType)->result();
				$data['getMsgCount'] = $this->Message_Model->getMessage($user_id, $filterType)->num_rows();
				echo json_encode($data);
			}
        } else {
        	$data['getFilteredMsg'] = array();
			$data['getMsgCount'] = array();
			echo json_encode($data);
        } 
		
	}	

	public function conversation($sender_id, $receiver_id, $msg_id) {
		if($this->session->userdata('b2c_id')) {
        	$user_id = $this->session->userdata('b2c_id');
        } else if($this->session->userdata('b2b_id')) {
        	$user_id = $this->session->userdata('b2b_id');
        } else {
        	redirect(WEB_URL);
        }		
        
		if($user_id != $receiver_id) {
			redirect(WEB_URL);
		}

		$data['conversation'] = $this->Message_Model->getConversation($sender_id, $receiver_id, $msg_id);
		
		if(empty($data['conversation'])) {
			redirect(WEB_URL.'/dashboard/inbox');
		}	
		
		$b2c_sender_info = $this->Message_Model->convUserSenderInfo($sender_id);
		$b2b_sender_info = $this->Message_Model->convUserSenderInfoB2b($sender_id);
		
		if(!empty($b2c_sender_info)) {
			$data['convUserSenderInfo'] = $b2c_sender_info;			
		} else if(!empty($b2b_sender_info)) {
			$data['convUserSenderInfo'] = $b2b_sender_info;			
		} else {
			die("REACHED1");
			redirect(WEB_URL);
		}	


		$b2c_receiver_info = $this->Message_Model->convUserReceiverInfo($receiver_id);
		$b2b_receiver_info = $this->Message_Model->convUserReceiverInfoB2b($receiver_id);

		if(!empty($b2c_receiver_info)) {
			$data['convUserReceiverInfo'] = $b2c_receiver_info;			
		} else if(!empty($b2b_receiver_info)) {
			$data['convUserReceiverInfo'] = $b2b_receiver_info;			
		} else {
			redirect(WEB_URL);
		}	

		$data['checkingTime'] = $this->Message_Model->msgCheckingTime($msg_id);

		$lastConversationArray = end($data['conversation']);
		$propInquiryId = $lastConversationArray->property_id;

		$data['getPropertyName'] = $this->Message_Model->getPropertyDetail($propInquiryId);

		$getMessageResonseData = $this->Message_Model->getMsgHistory($user_id)->result();
		
		$data['responseTime'] = $this->responseTimeCalculation($getMessageResonseData); //get the host response time
		$data['responseRate'] = $this->responseRateCalculation($user_id); //get host response rate
		
		$this->load->view('messages/conversation', $data);
	}

	public function submitMsg() {
		$getMsg = $this->input->post('msgContent');
		$f_getMsg = $this->security->xss_clean($getMsg);

		$f_getMsg = strip_tags($f_getMsg);
		$init_user_id = $this->input->post('init_user_id'); 	//user_id
		$init_user_type = $this->input->post('init_user_type'); 	//user_id
		$init_receiver_id = $this->input->post('init_receiver_id');
		$init_receiver_type = $this->input->post('init_receiver_type');
		$message_id = $this->input->post('message_id');
		$msg_receive_time = $this->input->post('msg_receive_time');
	$this->sms_model->sms_contact_host_reply($init_user_id,$init_user_type,$init_receiver_id,$init_receiver_type);
	
		$msgDateTime = date('Y-m-d H:i:s');
		$conv_property_id = $this->input->post('conv_property_id');


		//$current_user_id = $this->session->userdata('b2c_id');

		if($this->session->userdata('b2c_id')){
            $data['user_type']=$current_user_type = 3;
            $data['user_id']=$current_user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$current_user_type = 2;
            $data['user_id']=$current_user_id = $this->session->userdata('b2b_id');
        }

		if($current_user_id == $init_user_id) {
			$sendMsgTo = $init_receiver_id;
			$sendMsgToType = $init_receiver_type;
		} else {
			$sendMsgTo = $init_user_id;
			$sendMsgToType = $init_user_type;
		}

		$data = array(  'message_id'=>$message_id, 
						'sender_id'=>$current_user_id, 
						'receiver_id'=>$sendMsgTo, 
						'init_user_id'=>$init_user_id, 
						'init_receiver_id'=>$init_receiver_id, 
						'init_user_type'=>$current_user_type,
						'message'=>$f_getMsg, 
						'msg_date_time'=>$msgDateTime,
						'property_id'=>$conv_property_id );

		$msgHistoryObject = $this->Message_Model->checkMessageHistory($message_id); //check if this is the first message between user and host.
		$msgHistoryCount = $msgHistoryObject->num_rows();
		
		if($msgHistoryCount == 0) {
			$receiveTime = $msg_receive_time;
			$replyTime = date('Y-m-d H:i:s');

			$date1 = new DateTime($receiveTime);
			$date2 = new DateTime($replyTime);

			$date1_format = $date1->format('U');
			$date2_format = $date2->format('U');

			$interval = $date2_format - $date1_format;  //in seconds
			$min = $interval/60;
			$hour_difference = $min/60;
			$roundHour = round($hour_difference, 2);

			$dataHistory = array('message_id'=>$message_id, 'sender_user_id'=>$sendMsgTo, 'sender_user_type'=>$sendMsgToType, 'host_id'=>$current_user_id, 'host_type'=>$current_user_type, 'msg_receive_time'=>$msg_receive_time, 'msg_reply_time'=>$replyTime, 'time_difference'=>$roundHour);
			$addMsgHistory = $this->Message_Model->addMsgHistory($dataHistory);
		}

		
		$storeConversation = $this->Message_Model->storeConversation($data);
		if($storeConversation) {
			$response = array('status'=>1, 'msg'=>$f_getMsg);
			echo json_encode($response);
		}
	}

	public function responseTimeCalculation($getMessageResonseData){
		if(!empty($getMessageResonseData)) {
			$msgHistoryCount = count($getMessageResonseData);
			$totalResponseTime = 0;
			foreach($getMessageResonseData as $k) {
				$totalResponseTime = $totalResponseTime + $k->time_difference;
			}
			$avgTime = $totalResponseTime/$msgHistoryCount;
			$roundHour = round($avgTime, 1);
			return $roundHour;
		} else {
			return false;			
		}
	}

	public function responseRateCalculation($user_id) { 
		if($user_id != "") {
			$getAllRepliedMail = $this->Message_Model->getAllRepliedMail($user_id); //get all replied mails
			$getAllReceivedMail = $this->Message_Model->getAllReceivedMail($user_id); //get all received mails

			$repliedMsgCount = $getAllRepliedMail->num_rows();     //get count of records
			$receivedMsgCount = $getAllReceivedMail->num_rows();   //get count of records

			if($receivedMsgCount > 0) {
				$ratio = $repliedMsgCount/$receivedMsgCount; //get replied/received
				$responseRate = $ratio * 100;  				//get the percentage
				return $responseRate;
			} else {
				return false;
			}
		} else {
			redirect(WEB_URL);
		}
	
	}

	
}
