<?php

class Email_Model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	function send_email($name,$subject='',$to='',$message_header='',$message='',$attach=''){
		$message1 ='Dear '.$name.',<br><br>'; 
		$message1 .= 'Greetings From TicketFinder<br>';
		$message1 .= $message;
		$message1 .= '<br><br>Best regards, <br>Team TicketFinder';
		$data['message']= $message1;
		$data['message_header']= $message_header;
		$body = $this->load->view('email/email',$data,true);
		$access = $this->get_email_acess();
		$this->load->library('email');
		$config['protocol'] = 'mail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['mailtype'] = 'html';
		$config['protocol'] = $access->smtp;
		$config['smtp_host'] = $access->host;
		$config['smtp_port'] = $access->port;
		$config['smtp_user'] = $access->username;
		$config['smtp_pass'] = $access->password;
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";
		$this->email->initialize($config);
		 $this->email->from('ticketfinder@gmail.com', 'TicketFinder');
		$to=trim($to);
		$this->email->to($to); 
		$this->email->subject($subject);
		$this->email->message($body);
		if($attach!='')
		{	
			$this->email->attach($attach);
		}
		if($this->email->send())
		{
			return true;
		}
		else
		{
			return false;
		}

	}
		 
	 function send_email_normal($subject,$mailid,$message){

			$data['message']= $message;
			$data['message_header']= '';
			 
			$body = $this->load->view('email/email',$data,true);
			 
			$access = $this->get_email_acess();
			$this->load->library('email');
			$config['protocol'] = 'mail';
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['charset'] = 'iso-8859-1';
			
			$config['mailtype'] = 'html';
			$config['protocol'] = $access->smtp;
			$config['smtp_host'] = $access->host;
			$config['smtp_port'] = $access->port;
			$config['smtp_user'] = $access->username;
			$config['smtp_pass'] = $access->password;
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$this->email->initialize($config);
			
			
            $this->email->from('ticketfinder@gmail.com', 'TicketFinder');
			$to=trim($mailid);
			$this->email->to($to); 
			$this->email->subject($subject);
			$this->email->message($body);
			
			if($this->email->send())
			{
				return true;
			}
			else
			{
			  	return false;
			}
			 
		 }
		public function get_email_acess()
		{
			$this->db->select('*')
				->from('email_access');
			$query = $this->db->get();
			if ( $query->num_rows > 0 ) {
			 return $query->row();
			}
			return false;
		}

public function get_social_links()
		{
			$this->db->select('*')
				->from('social_links');
			$query = $this->db->get();
			if ( $query->num_rows > 0 ) {
			 return $query->row();
			}
			return false;
		}
		 
		 
		 
		 function send_email_newsletter($name,$subject='',$bcc='',$message_header='',$message='',$attach='')
		 {
			 $message1 ='Dear '.$name.',<br><br>'; 
			 $message1 .= 'Greetings From TicketFinder<br>';
			  $message1 .= $message;
			  $message1 .= '<br><br>Best regards, <br>Team TicketFinder';
			$data['message']= $message1;
			$data['message_header']= $message_header;
			 
			$body = $this->load->view('email/email',$data,true);
			 
			$access = $this->get_email_acess();
			$this->load->library('email');
			$config['protocol'] = 'mail';
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['charset'] = 'iso-8859-1';
			
			$config['mailtype'] = 'html';
			$config['protocol'] = $access->smtp;
			$config['smtp_host'] = $access->host;
			$config['smtp_port'] = $access->port;
			$config['smtp_user'] = $access->username;
			$config['smtp_pass'] = $access->password;
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$this->email->initialize($config);
			
			 $this->email->from('ticketfinder@gmail.com', 'TicketFinder');
			$bcc=trim($bcc);
			$this->email->to('ticketfinder@gmail.com'); 
			$this->email->bcc($bcc); 		
			$this->email->subject($subject);
			$this->email->message($body);
			if($attach!='')
			{	
			  $this->email->attach($attach);
			}
			if($this->email->send())
			{
				return true;
			}
			else
			{
			  	return false;
			}
			 
		 }

	public function get_b2c_email_id() {
        $this->db->select('email');
        $this->db->from('b2c');
        $this->db->where('newsletter_subscribe', 1);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function get_b2b_email_id() {
        $this->db->select('email_id');
        $this->db->from('b2b');
        $this->db->where('newsletter_subscribe', 1);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function get_allSub_email_id() {
    	$this->db->select('email_id');
        $this->db->from('newsletter_subscriber');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function get_additional_campaign_email($id) {
        $this->db->select('campaign_email_to');
        $this->db->from('campaign_data');
        $this->db->where('id', $id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function get_from_email($id) {
    	$this->db->select('email_from');
        $this->db->from('campaign_data');
        $this->db->where('id', $id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return '';
        }
    }

    public function get_email_access_details() {
        $this->db->select('*');
        $this->db->from('email_access');

        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return 0;
        }
    }

    public function sendCampaignEmail($email_id, $mail_content, $data, $email_from_id) {

        $config = Array(
            'protocol' => $data->smtp,
            'smtp_host' => $data->host,
            'smtp_port' => $data->port,
            'smtp_user' => $data->username,
            'smtp_pass' => $data->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        
        $this->load->library('email', $config);

        $this->email->set_newline("\r\n");
        $this->email->from($email_from_id);
        $this->email->bcc($email_id);
        $this->email->subject($mail_content->email_subject);
        $this->email->message($mail_content->campaign_template);

        if ($this->email->send()) {
            echo json_encode(array('status' => 1));
        } else {
            echo json_encode(array('status' => 0));
        }
    }

    public function sendmail_reg($email_id, $mail_content, $data) {
        $config = Array(
            'protocol' => $data->smtp,
            'smtp_host' => $data->host,
            'smtp_port' => $data->port,
            'smtp_user' => $data->username,
            'smtp_pass' => $data->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);

        $this->email->set_newline("\r\n");
        $this->email->from($mail_content->email_from);
        $this->email->bcc($email_id);
        $this->email->subject($mail_content->email_subject);
        $this->email->message($mail_content->campaign_template);

        if ($this->email->send()) {
            echo json_encode(array('status' => 1));
        } else {
            echo json_encode(array('status' => 0));
        }
    }
	
   public function get_email_template($email_type) {
        $this->db->where('email_type', $email_type);
        return $this->db->get('email_template');
    }

   public function send_promocode_mail($data){
	$message1 = $data['email_template']->message;
        $message1 = str_replace("{%%FIRSTNAME%%}", $data['firstname'], $message1);
        $message1 = str_replace("{%%PROMOCODE%%}", $data['promo_code']->promo_code, $message1);
        $message1 = str_replace("{%%DISCOUNT%%}", $data['promo_code']->discount, $message1);
		$message1 = str_replace("{%%WEB_URL%%}", WEB_FRONT_URL, $message1);
        $message1 = str_replace("{%%EXPIRYDATE%%}", date('M j,Y', strtotime($data['promo_code']->exp_date)), $message1);
$data['email_access'] = $this->get_email_acess();
$socials=$this->get_social_links();
$message1 = str_replace("{%%FB%%}", $socials->facebook, $message1);
$message1 = str_replace("{%%TW%%}", $socials->twitter, $message1);
$message1 = str_replace("{%%GP%%}", $socials->google, $message1);
        $data['email_access'] = $this->get_email_acess();
	   $delimiters = $data['email_template']->to_email;
        $email_to = explode(";", $delimiters);
        $email_to_1 = isset($email_to[0])?$email_to[0]:'';
        $email_to_2 = isset($email_to[1])?$email_to[1]:'';

        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
		$this->email->to($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->bcc($data['emailid'], $email_to_1, $email_to_2);
        $this->email->subject($data['email_template']->subject);
        $this->email->message($message1);
        $this->email->send();
   }

  public function send_agentverfication_mail($data){
	$message1 = $data['email_template']->message;
        $message1 = str_replace("{%%FIRSTNAME%%}", $data['firstname'], $message1);
        $message1 = str_replace("{%%emailverficationcode%%}", $data['temp_email_opt'], $message1);
        $message1 = str_replace("{%%CONFIRMLINK%%}", $data['confirm_url'], $message1);
		$message1 = str_replace("{%%WEB_URL%%}", WEB_FRONT_URL, $message1);
        
        $data['email_access'] = $this->get_email_acess();
	$delimiters = $data['email_template']->to_email;
        $email_to = explode(";", $delimiters);
        $email_to_1 = isset($email_to[0])?$email_to[0]:'';
        $email_to_2 = isset($email_to[1])?$email_to[1]:'';
        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($data['emailid'], $email_to_1, $email_to_2);
        $this->email->subject($data['email_template']->subject);
        $this->email->message($message1);
        $this->email->send();
   }

   public function send_mail_to_user($data){
	$message1 = $data['email_template']->message;
        $message1 = str_replace("{%%FIRSTNAME%%}", $data['firstname'], $message1);
        $message1 = str_replace("{%%MESSAGE%%}", $data['message'], $message1);
		$message1 = str_replace("{%%WEB_URL%%}", WEB_FRONT_URL, $message1);
	$data['email_access'] = $this->get_email_acess();
$socials=$this->get_social_links();
$message1 = str_replace("{%%FB%%}", $socials->facebook, $message1);
$message1 = str_replace("{%%TW%%}", $socials->twitter, $message1);
$message1 = str_replace("{%%GP%%}", $socials->google, $message1);
	$delimiters = $data['email_template']->to_email;
        $email_to = explode(";", $delimiters);
        $email_to_1 =isset($email_to[0])?$email_to[0]:'';
        $email_to_2 = isset($email_to[1])?$email_to[1]:'';
        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($data['mailid'], $email_to_1, $email_to_2);
        $this->email->subject($data['subject']);
       // echo $message1;die;
 $this->email->message($message1);
        $this->email->send();
   }

    public function send_agent_deposit_mail($data){
	$message1 = $data['email_template']->message;
        $message1 = str_replace("{%%FIRSTNAME%%}", $data['firstname'], $message1);
        $message1 = str_replace("{%%AMOUNT%%}", $data['amount'], $message1);
	$message1 = str_replace("{%%CURAMOUNT%%}", $data['current_amount'], $message1);
	$message1 = str_replace("{%%TRANSID%%}", $data['trans_id'], $message1);
	$message1 = str_replace("{%%TOTALAMOUNT%%}", $data['total_amount'], $message1);
$message1 = str_replace("{%%WEB_URL%%}", WEB_FRONT_URL, $message1);
	$subject = $data['email_template']->subject;
	$subject = str_replace("{%%TRANSID%%}", $data['trans_id'], $subject);
	
	$data['email_access'] = $this->get_email_acess();
	$delimiters = $data['email_template']->to_email;
        $email_to = explode(";", $delimiters);
        $email_to_1 = isset($email_to[0])?$email_to[0]:'';
        $email_to_2 = $email_to[1];
        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($data['emailid'], $email_to_1, $email_to_2);
        $this->email->subject($subject);
        $this->email->message($message1);
        $this->email->send();
   }

   public function send_admin_access($data){
	
	$message1 = $data['email_template']->message;
        $message1 = str_replace("{%%FIRSTNAME%%}", $data['firstname'], $message1);
        $message1 = str_replace("{%%USERNAME%%}", $data['emailid'], $message1);
	$message1 = str_replace("{%%PASSWORD%%}", $data['password'], $message1);
	$message1 = str_replace("{%%URL%%}", $data['url'], $message1);
	$message1 = str_replace("{%%WEB_URL%%}", WEB_FRONT_URL, $message1);
	$data['email_access'] = $this->get_email_acess();
	$delimiters = $data['email_template']->to_email;
$socials=$this->get_social_links();
$message1 = str_replace("{%%FB%%}", $socials->facebook, $message1);
$message1 = str_replace("{%%TW%%}", $socials->twitter, $message1);
$message1 = str_replace("{%%GP%%}", $socials->google, $message1);
        $email_to = explode(";", $delimiters);
        $email_to_1 = isset($email_to[0])?$email_to[0]:'';
        $email_to_2 = isset($email_to[1])?$email_to[1]:'';
        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($data['emailid'], $email_to_1, $email_to_2);
        $this->email->subject($data['email_template']->subject);
        $this->email->message($message1);
        $this->email->send();
   
   }
	
    public function send_admin_change_password($data){
	$socials=$this->get_social_links();
	$message1 = $data['email_template']->message;
    $message1 = str_replace("{%%FIRSTNAME%%}", $data['firstname'], $message1);
	$message1 = str_replace("{%%PASSWORD%%}", $data['password'], $message1);
	$message1 = str_replace("{%%WEB_URL%%}", WEB_FRONT_URL, $message1);
$message1 = str_replace("{%%FB%%}", $socials->facebook, $message1);
$message1 = str_replace("{%%TW%%}", $socials->twitter, $message1);
$message1 = str_replace("{%%GP%%}", $socials->google, $message1);


	$data['email_access'] = $this->get_email_acess();
	
	$delimiters = $data['email_template']->to_email;
        $email_to = explode(";", $delimiters);
        $email_to_1 = isset($email_to[0])?$email_to[0]:'';
        $email_to_2 = isset($email_to[1])?$email_to[1]:'';
        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($data['emailid'], $email_to_1, $email_to_2);
        $this->email->subject($data['email_template']->subject);
        $this->email->message($message1);
        $this->email->send();
   
   }
	

    public function delete_admin_email($data){
        $message1 = $data['email_template']->message;
$socials=$this->get_social_links();
$message1 = str_replace("{%%FB%%}", $socials->facebook, $message1);
$message1 = str_replace("{%%TW%%}", $socials->twitter, $message1);
$message1 = str_replace("{%%GP%%}", $socials->google, $message1);
        $message1 = str_replace("{%%FIRSTNAME%%}", $data['admin_firstname'], $message1);
$message1 = str_replace("{%%WEB_URL%%}", WEB_FRONT_URL, $message1);
        $data['email_access'] = $this->get_email_acess();
        $delimiters = $data['email_template']->to_email;
        
        $email_to = $data['admin_email_id'];

        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
            $this->email->to($email_to);
            $this->email->subject($data['email_template']->subject);
            $this->email->message($message1);
            $this->email->send();
    }


   public function send_add_user_active($data){

	$message1 = $data['email_template']->message;
    $message1 = str_replace("{%%FIRSTNAME%%}", $data['firstname'], $message1);
	$message1 = str_replace("{%%USERNAME%%}", $data['emailid'], $message1);
	$message1 = str_replace("{%%PASSWORD%%}", $data['password'], $message1);
	$socials=$this->get_social_links();
$message1 = str_replace("{%%FB%%}", $socials->facebook, $message1);
$message1 = str_replace("{%%TW%%}", $socials->twitter, $message1);
$message1 = str_replace("{%%GP%%}", $socials->google, $message1);
	$message1 = str_replace("{%%USER%%}", $data['user'], $message1);
	$message1 = str_replace("{%%USERIMAGE%%}", $data['image'], $message1);
	$message1 = str_replace("{%%WEB_URL%%}", WEB_FRONT_URL, $message1);
if($data['user']='User'){
$url=WEB_FRONT_URL;
}else{
$url=WEB_FRONT_URL.'/admin';
}

	$message1 = str_replace("{%%URL%%}", $url, $message1);
	$subject = $data['email_template']->subject;
	$subject = str_replace("{%%USER%%}", $data['user'], $subject);

	$data['email_access'] = $this->get_email_acess();
	$delimiters = $data['email_template']->to_email;
        $email_to = explode(";", $delimiters);
        $email_to_1 = isset($email_to[0])?$email_to[0]:'';
        $email_to_2 = isset($email_to[1])?$email_to[1]:'';
        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($data['emailid'], $email_to_1, $email_to_2);
        $this->email->subject($subject);
        $this->email->message($message1);
        $this->email->send();
   }	
      public function send_transaction_details($data){
	$message1 = $data['email_template']->message;
    $message1 = str_replace("{%%HOSTIMAGE%%}", $data['HOSTIMAGE'], $message1);
	$message1 = str_replace("{%%HOSTNAME%%}", $data['HOSTNAME'], $message1);
	$message1 = str_replace("{%%PNR%%}", $data['PNR'], $message1);
	$message1 = str_replace("{%%STATUS%%}", $data['STATUS'], $message1);
	$message1 = str_replace("{%%COMMENTS%%}", $data['COMMENTS'], $message1);
	$message1 = str_replace("{%%REFERENCELINK%%}", $data['REFERENCELINK'], $message1);
		$message1 = str_replace("{%%NET_RATE%%}", $data['NET_RATE'], $message1);
			$message1 = str_replace("{%%PROPNAME%%}", $data['PROPNAME'], $message1);
				$message1 = str_replace("{%%TOTAL%%}", $data['TOTAL'], $message1);
					$message1 = str_replace("{%%TAX%%}", $data['TAX'], $message1);
	$message1 = str_replace("{%%WEB_URL%%}", WEB_FRONT_URL, $message1);
	$subject = $data['email_template']->subject;
	$subject = str_replace("{%%PNR%%}", $data['PNR'], $subject);

	$data['email_access'] = $this->get_email_acess();

        $config = array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($data['emailid'],$data['HOSTNAME']);
        $this->email->subject($subject);
        $this->email->message($message1);
        $this->email->send();
   }	

   //for Apartment Voucher
    public function sendmail_apartmentVoucher($data) {
        $Booking = $data['Booking'];
        $social_url = $data['social_url'];
        $message = $data['email_template']->message;
        $to = $data['email'];
        //echo '<pre>';print_r($data['host_data']);die;
        if(isset($data['host_data']->profile_photo)) {
            $profile_photo = $data['host_data']->profile_photo;
            $user_id = $data['host_data']->user_id;
            $user_type = '3';
            $contact_no = $data['host_data']->contact_no;
        } else if(isset($data['host_data']->agent_logo)) {
            $profile_photo = $data['host_data']->agent_logo;
            $user_id = $data['host_data']->agent_id;
            $user_type = '2';
            $contact_no = $data['host_data']->mobile;
        } else {
            $profile_photo = ASSETS.'images/user-avatar.jpg';
        }


        if($Booking->PROP_CANCELLATION_DESC != ''){
            $CANCELLATION = $Booking->PROP_CANCELLATION_DESC;
        }else{
            $CANCELLATION = 'NA';
        }

        if($Booking->PROP_AREADESCRIPTION != ''){
            $AREA = $Booking->PROP_AREADESCRIPTION;
        }else{
            $AREA = 'NA';
        }

        if($Booking->PROP_ARRIVAL_SHEET != ''){
            $CUSTOMER = $Booking->PROP_ARRIVAL_SHEET;
        }else{
            $CUSTOMER = 'NA';
        }

        $apt_link = WEB_URL.'/apartment/rooms/'.$data['Booking']->PROP_ID;
        $host_profile_link = WEB_URL.'/users/show/'.$user_type.'/'.$user_id;
        $guests = $Booking->RES_N_ADULTS+$Booking->RES_N_CHILDREN+$Booking->RES_N_BABIES;
        $RentData = json_decode($Booking->RENT_DATA);

        $message = str_replace("{%%NAME%%}", $data['Booking']->RES_GUEST_FIRSTNAME, $message);
        $message = str_replace("{%%STATUS%%}", $data['Booking']->booking_status, $message);
        $message = str_replace("{%%PNR%%}", $data['Booking']->pnr_no, $message);
        $message = str_replace("{%%MAP%%}", $data['Map'], $message);
        $message = str_replace("{%%APT_LINK%%}", $apt_link, $message);
        $message = str_replace("{%%APARTMENT%%}", $data['Booking']->PROP_NAME.', '.$data['Booking']->PROP_CITY.' and '.$data['Booking']->PROP_COUNTRY_NAME, $message);
        $message = str_replace("{%%APT_TYPE%%}", $data['Booking']->PROP_TYPE_LABEL, $message);
        $message = str_replace("{%%GUEST%%}", $guests, $message);
        $message = str_replace("{%%CHECKIN_DAY%%}", date('D, M', strtotime($Booking->RES_CHECK_IN)), $message);
        $message = str_replace("{%%CHECKIN_DATE%%}", date('d', strtotime($Booking->RES_CHECK_IN)), $message);
        $message = str_replace("{%%CHECKOUT_DAY%%}", date('D, M', strtotime($Booking->RES_CHECK_OUT)), $message);
        $message = str_replace("{%%CHECKOUT_DATE%%}", date('d', strtotime($Booking->RES_CHECK_OUT)), $message);
        $message = str_replace("{%%HOST_IMAGE%%}", $profile_photo, $message);
        $message = str_replace("{%%HOST_LINK%%}", $host_profile_link, $message);
        $message = str_replace("{%%HOST_NAME%%}", $data['host_data']->firstname.' '.$data['host_data']->lastname, $message);
        $message = str_replace("{%%HOST_PHONE%%}", $contact_no, $message);
        $message = str_replace("{%%RENT_SUBTOTAL%%}", CURR_ICON.$data['Booking']->amount, $message);
        //$message = str_replace("{%%RENT_PER%%}", CURR_ICON.$RentData->price_per, $message);
        $message = str_replace("{%%SERVICE_TAX%%}", CURR_ICON.'0', $message);
        $message = str_replace("{%%TOTAL%%}", CURR_ICON.$data['Booking']->amount, $message);
        $message = str_replace("{%%SOCIALURLFACE%%}", $social_url['facebook_social_url'], $message);
        $message = str_replace("{%%SOCIALURLTWIT%%}", $social_url['twitter_social_url'], $message);
        $message = str_replace("{%%SOCIALURLGPLUS%%}",$social_url['google_social_url'], $message);
        $message = str_replace("{%%YEAR%%}", date('Y'), $message);
        $message = str_replace("{%%CANCELLATION%%}", $CANCELLATION, $message);
        $message = str_replace("{%%AREA%%}", $AREA, $message);
        $message = str_replace("{%%CUSTOMER%%}", $CUSTOMER, $message);
        $message = str_replace("{%%WEB_URL%%}", WEB_FRONT_DIR, $message);
        //echo $message;die;
        $subject = $data['email_template']->subject;
        //$subject = str_replace("{%%NAME%%}", $data['user_data']->firstname.' '.$data['user_data']->lastname, $subject);

        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }

     public function sendmail_apartmentUserInvoice($data) {
        $Booking = $data['Booking'];
        $social_url = $data['social_url'];
        $message = $data['email_template']->message;
        $to = $data['email'];
        
        
        
        $RentData = json_decode($Booking->RENT_DATA);

        $message = str_replace("{%%NAME%%}", $data['Booking']->RES_GUEST_FIRSTNAME.' '.$data['Booking']->RES_GUEST_LASTNAME, $message);
        $message = str_replace("{%%STATUS%%}", $data['Booking']->booking_status, $message);
        $message = str_replace("{%%PNR%%}", $data['Booking']->pnr_no, $message);
        $message = str_replace("{%%PROP_NAME%%}", $data['Booking']->PROP_NAME, $message);
        $message = str_replace("{%%CITY_STATE%%}", $data['Booking']->PROP_CITY.', '.$data['Booking']->PROP_REGION, $message);
        $message = str_replace("{%%COUNTRY%%}", $data['Booking']->PROP_COUNTRY_NAME, $message);
        $message = str_replace("{%%ADDRESS1%%}", $data['Booking']->PROP_ADDR1, $message);
        $message = str_replace("{%%ADDRESS2%%}", $data['Booking']->PROP_ADDR2, $message);

        $message = str_replace("{%%APT_TYPE%%}", $data['Booking']->PROP_TYPE_LABEL, $message);
        $message = str_replace("{%%NIGHTS%%}", $data['Booking']->NIGHTS, $message);
        $message = str_replace("{%%CHECKIN%%}", date('D, d M Y', strtotime($Booking->RES_CHECK_IN)), $message);
        $message = str_replace("{%%CHECKIN_TIME%%}", $Booking->PROP_CIN_TIME, $message);
        $message = str_replace("{%%CHECKOUT%%}", date('D, d M Y', strtotime($Booking->RES_CHECK_OUT)), $message);
        $message = str_replace("{%%CHECKOUT_TIME%%}", $Booking->PROP_COUT_TIME, $message);
        $message = str_replace("{%%PAYMENT_DATE%%}", date('D, M d, Y', strtotime($Booking->voucher_date)), $message);
        $message = str_replace("{%%INVOICE%%}", 'XXXXXXXXXX', $message);
        $message = str_replace("{%%INVOICE_DATE%%}", date('D, M d, Y', strtotime($Booking->voucher_date)), $message);
        $message = str_replace("{%%RENT_SUBTOTAL%%}", CURR_ICON.$data['Transaction']->net_rate, $message);
        //$message = str_replace("{%%RENT_PER%%}", CURR_ICON.$RentData->price_per, $message);
        $message = str_replace("{%%SERVICE_TAX%%}", CURR_ICON.$data['Transaction']->apt_charge, $message);
        $message = str_replace("{%%TOTAL%%}", CURR_ICON.$data['Transaction']->booking_amount, $message);
        $message = str_replace("{%%SOCIALURLFACE%%}", $social_url['facebook_social_url'], $message);
        $message = str_replace("{%%SOCIALURLTWIT%%}", $social_url['twitter_social_url'], $message);
        $message = str_replace("{%%SOCIALURLGPLUS%%}",$social_url['google_social_url'], $message);
        $message = str_replace("{%%YEAR%%}", date('Y'), $message);
         $message = str_replace("{%%WEB_URL%%}", WEB_FRONT_DIR, $message);

        
        //echo $message;die;
        $subject = $data['email_template']->subject;
        //$subject = str_replace("{%%NAME%%}", $data['user_data']->firstname.' '.$data['user_data']->lastname, $subject);

        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }

     //for Flight Voucher
    public function sendmail_flightVoucher($data) {
       
        $message = $data['message'];

        $message = str_replace("{%%WEB_URL%%}", WEB_FRONT_DIR, $message);
$socials=$this->get_social_links();
$message = str_replace("{%%FB%%}", $socials->facebook, $message);
$message = str_replace("{%%TW%%}", $socials->twitter, $message);
$message = str_replace("{%%GP%%}", $socials->google, $message);
      
         $to = ($data['Booking']->GUEST_EMAIL!='')?$data['Booking']->GUEST_EMAIL:$data['Booking']->BILLING_EMAIL;
        
        $subject = 'Booking '.$data['booking_status'].' - TicketFinder';
       

        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
 
        $this->email->message($message);
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }

    //for Flight Voucher
    public function sendmail_flightInvoice($data) {
       
        $message = $data['message'];
       $to = ($data['Booking']->GUEST_EMAIL!='')?$data['Booking']->GUEST_EMAIL:$data['Booking']->BILLING_EMAIL;
        $message = str_replace("{%%WEB_URL%%}", WEB_FRONT_DIR, $message);
$socials=$this->get_social_links();
$message = str_replace("{%%FB%%}", $socials->facebook, $message);
$message = str_replace("{%%TW%%}", $socials->twitter, $message);
$message = str_replace("{%%GP%%}", $socials->google, $message);
        $subject = 'Booking Invoice - TicketFinder';
       

        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }

    //for Hotel Voucher
    public function sendmail_hotelVoucher($data) {
        $social_url = $data['social_url'];
        $message = $data['message'];
        $to = $data['to'];
        $message = str_replace("{%%WEB_URL%%}", WEB_FRONT_DIR, $message);
        
        $subject = 'Booking confirmed - TicketFinder';
        //$subject = str_replace("{%%NAME%%}", $data['user_data']->firstname.' '.$data['user_data']->lastname, $subject);

        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }

    //for Car Voucher
    public function sendmail_carVoucher($data) {
        $social_url = $data['social_url'];
        $message = $data['message'];
        $to = $data['to'];
        $message = str_replace("{%%WEB_URL%%}", WEB_FRONT_DIR, $message);
        $subject = 'Booking '.$data['booking_status'].' - TicketFinder';
        //$subject = str_replace("{%%NAME%%}", $data['user_data']->firstname.' '.$data['user_data']->lastname, $subject);

        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }

    //for Car Invoice
    public function sendmail_carInvoice($data) {
        $social_url = $data['social_url'];
        $message = $data['message'];
        $to = $data['to'];
        $message = str_replace("{%%WEB_URL%%}", WEB_FRONT_DIR, $message);
        $subject = 'Booking Invoice - TicketFinder';
        //$subject = str_replace("{%%NAME%%}", $data['user_data']->firstname.' '.$data['user_data']->lastname, $subject);

        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }

    //
    public function sendmail_refund($data){
        $Booking = $data['Booking'];

       
        $message = $data['email_template']->message;
       $to = ($data['Booking']->GUEST_EMAIL!='')?$data['Booking']->GUEST_EMAIL:$data['Booking']->BILLING_EMAIL;

        $message = str_replace("{%%NAME%%}", $data['Booking']->GUEST_FIRSTNAME.' '.$data['Booking']->GUEST_LASTNAME, $message);
        $message = str_replace("{%%REFUND_SUBJECT%%}", $data['Booking']->refund_subject, $message);
        $message = str_replace("{%%REFUND_DESCRIPTION%%}", $data['Booking']->refund, $message);
        $message = str_replace("{%%REFUND_AMOUNT%%}", $data['Booking']->refund_amount, $message);
        $message = str_replace("{%%BOOKING_STATUS%%}", $data['Booking']->booking_status, $message);
        $message = str_replace("{%%API_STATUS%%}", $data['Booking']->api_status, $message);
        $message = str_replace("{%%TRANSACTIONID%%}", $data['Booking']->transaction_id, $message);
        $message = str_replace("{%%MODULE%%}", $data['Booking']->module, $message);
        $message = str_replace("{%%VOUCHERDATE%%}", $data['Booking']->voucher_date, $message);

		$socials=$this->get_social_links();
		$message = str_replace("{%%FB%%}", $socials->facebook, $message);
		$message = str_replace("{%%TW%%}", $socials->twitter, $message);
		$message = str_replace("{%%GP%%}", $socials->google, $message);
        $message = str_replace("{%%YEAR%%}", date('Y'), $message);
        $message = str_replace("{%%WEB_URL%%}", WEB_FRONT_DIR, $message);

        
        //echo $message;die;
        $subject = $data['email_template']->subject;
        $subject = str_replace("{%%MODULE%%}", $data['Booking']->module, $subject);
        $subject = str_replace("{%%PNRNO%%}", $data['Booking']->pnr_no, $subject);
        //$subject = str_replace("{%%NAME%%}", $data['user_data']->firstname.' '.$data['user_data']->lastname, $subject);

        $config = Array(
            'protocol' => $data['email_access']->smtp,
            'smtp_host' => $data['email_access']->host,
            'smtp_port' => $data['email_access']->port,
            'smtp_user' => $data['email_access']->username,
            'smtp_pass' => $data['email_access']->password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['email_template']->email_from, $data['email_template']->email_from_name);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
            return 1;
        }else{
            return 0;
        }
    }
}

