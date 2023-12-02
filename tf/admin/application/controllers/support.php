<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support extends CI_Controller {
	
	protected $domain_id;
	
	public function __construct()
    {
      parent::__construct();
	  $this->load->database(); 
	  $this->load->model('Admin_Model');
	   $this->load->model('Domain_Model');
	   $this->load->model('Support_Model');
	   $this->load->model('Home_Model');
	   $this->load->model('Email_Model');
	    
	  $this->check_isvalidated();	
   		$this->load->library('form_validation');
	  	
	  $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      $this->output->set_header("Pragma: no-cache");
	  $this->domain_id = $this->checkuserdomain();	

	  if($this->session->userdata('admin_logged_in')){
	  		$this->load->helper('url');
	  		$controller = $this->router->fetch_class();
	  		parent::check_modules($controller);
	  		$this->load->model('Privilege_Model');
	  		$sub_admin_id = $this->session->userdata('admin_id');
	  		$this->data['modules'] = $this->Privilege_Model->get_privileges_by_sub_admin_id($sub_admin_id)->result();
	  }
    }
	  private function check_isvalidated()
	  {
		   if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in'))
		   {
				   redirect('login/index');
		   }
		
      }
	  function download_file($file)
	{
		$this->load->helper('download');
			$name=	base64_decode($file);
		$data = file_get_contents($name); // Read the file's contents
		$a = explode('support_ticket', $name);
		$name1 = substr($a[1],2);

force_download($name1, $data); 


	
	
	}
	function view_ticket($id)
	{
		$data['status'] = '';
		$data['ticket'] = $this->Support_Model->get_support_list_id($id); 
		$data['ticketrow'] = $this->Support_Model->get_support_list_id_row($id); 
		$data['id']=$id;
		
		if(isset($this->domain_id) && !empty($this->domain_id))
		{
			if($data['ticketrow']->domain != $this->domain_id)
			{
				redirect('support/support_view');
			}
		}
		$this->load->view('support/view_ticket',$data);
	}
	
	function reply_ticket($id)
	{
		
		
		$this->form_validation->set_rules('textcounter', 'textcounter', 'required');
		if($this->form_validation->run()==FALSE){
	  		redirect('support/view_ticket/'.$id,'refresh');
		}else{
			

				$domain = $_POST['domain'];
				$usertype = $_POST['user_type'];
				$user = $_POST['user_id'];
				$sub = $_POST['subject'];
				$message = $_POST['textcounter'];
				$support_ticket_id = $_POST['support_ticket_id'];


				//	  echo 'asdas';exit;

				$config['upload_path'] = './upload_files/support_ticket/'.$domain;
				$config['allowed_types'] = '*';
				$this->load->library('upload', $config);

				if($_FILES['file_name']['name']!='')
				{
				if ( ! $this->upload->do_upload('file_name'))
				{
					$error = array('error' => $this->upload->display_errors());
					$data['status'] ='<div class="alert alert-block alert-danger">
					<a href="#" data-dismiss="alert" class="close">×</a>
					<h4 class="alert-heading">Attachment File Failed!</h4>
					'.$error['error'].'
					</div>';
					$data['ticket'] = $this->Support_Model->get_support_list_id($id); 
					$data['ticketrow'] = $this->Support_Model->get_support_list_id_row($id); 
					$data['id']=$id;

					$this->load->view('support/view_ticket',$data);
				}
					$cc = $this->upload->data('file');
					$image_path = 'upload_files/support_ticket/'.$domain.'/'.$cc['file_name'];
				}
				else
				{
					$image_path = '';
				}

				$this->Support_Model->add_new_support_ticket_updates($support_ticket_id,$domain,$usertype,$user,$sub,$message,$image_path);
				$userdata = $this->Support_Model->get_user_details($usertype,$user);
				$mail['firstname'] = $firstname = $userdata->name;
		        $mail['mailid']= $mailid = $userdata->email;
		        $mail['subject']= $subject = "Support Ticket Reply "."-".$this->input->post('subject');
		        $mail['message']=  $message = $this->input->post('textcounter');
				$mail['email_template'] = $this->Email_Model->get_email_template('send_mail_to_user')->row();
		        $this->Email_Model->send_mail_to_user($mail);
				redirect('support/reply_ticket/'.$id,'refresh');
		}
	
		
	}
	function close_ticket($sid)
	{
		$ticket = $this->Support_Model->getSupportTicket($sid);
		$userdata = $this->Support_Model->get_user_details($ticket->user_type,$ticket->user_id);
		$mail['firstname'] = $firstname = $userdata->name;
        $mail['mailid']= $mailid = $userdata->email;
        $mail['subject']= $subject = "Your Support Ticket has closed "."-".$ticket->subject;
        $mail['message']=  $message = $ticket->message;
		$mail['email_template'] = $this->Email_Model->get_email_template('send_mail_to_user')->row();
        $this->Email_Model->send_mail_to_user($mail);

        
		$this->Support_Model->close_ticket($sid); 
		redirect('support/support_view','refresh');	
	}
	
	public function support_view()
		{
			if(isset($this->domain_id) && !empty($this->domain_id))	
			{
				$data['support'] = $this->Support_Model->get_support_list($this->domain_id); 
				$data['support_pending'] = $this->Support_Model->get_support_list_pending($this->domain_id); 
				$data['support_sent'] = $this->Support_Model->get_support_list_sent($this->domain_id); 
				$data['support_close'] = $this->Support_Model->get_support_list_close($this->domain_id); 
			}
			else
			{
				$data['support'] = $this->Support_Model->get_support_list(); 
				$data['support_pending'] = $this->Support_Model->get_support_list_pending(); 
				$data['support_sent'] = $this->Support_Model->get_support_list_sent(); 
				$data['support_close'] = $this->Support_Model->get_support_list_close(); 
			}	
			$this->load->view('support/view',$data);
		}
		
		/*public function support_view()
		{
			if(isset($this->domain_id) && !empty($this->domain_id))	
			{
				$data['support'] = $this->Support_Model->get_support_list($this->domain_id); 
				$data['support_pending'] = $this->Support_Model->get_support_list_pending($this->domain_id); 
				$data['support_sent'] = $this->Support_Model->get_support_list_sent($this->domain_id); 
				$data['support_close'] = $this->Support_Model->get_support_list_close($this->domain_id); 
			}
			else
			{
				$data['support'] = $this->Support_Model->get_support_list(); 
				$data['support_pending'] = $this->Support_Model->get_support_list_pending(); 
				$data['support_sent'] = $this->Support_Model->get_support_list_sent(); 
				$data['support_close'] = $this->Support_Model->get_support_list_close(); 
			}	
			$this->load->view('support/view',$data);
		}
		*/
		public function add_subject()
		{
			$data['support_ticket_subject'] = $this->Support_Model->get_support_subject_list(); 
			$this->load->view('support/support_ticket_subject',$data);
		}
		
		public function add_ticket(){
			$data['country'] = $this->Domain_Model->get_country_list(); 
			$data['domain_list'] = $this->Domain_Model->get_domain_list(); 
			$data['usertypes'] = $this->Domain_Model->get_usertypes_list(); 
			$data['support_ticket_subject'] = $this->Support_Model->get_support_subject_list(); 
			$this->load->view('support/add_ticket',$data);
		}
		function get_user_data_ajax($domain,$uertype){
				
				/*if($get_data!=''){
					echo '<select class="form-control" data-rule-required="true" id="user" name="user">';
                          
					for($i=0;$i<count($get_data);$i++){
						echo '<option value="'.$get_data[$i]->id.'">'.$get_data[$i]->email_id.'</option>';
					}
					
					echo '</select>';
				}else{
					echo "<input class='form-control' data-rule-required='true' id='user' name='user' placeholder='User' type='text' readonly>";
				}*/
				ini_set('memory_limit', '-1');
		        $term = $this->input->get('term'); //retrieve the search term that autocomplete sends
		        $term = trim(strip_tags($term));
		        $users = $this->Support_Model->get_user_data_ajax_list($domain,$uertype,$term);
		        $result = array();
		        foreach ($users as $user) {
		            $auto['value'] = $user->email_id;
		            $auto['id'] = $user->id;
		            $result[] = $auto;
		        }
		        //print_r($result);
		        echo json_encode($result); //format the array into json data
		}
		function get_other_sub_ajax($id){
			if($id==1){
				echo "<input class='form-control' data-rule-required='true' id='sub' name='sub' placeholder='User' type='text'>
				<span class='input-group-addon'><i class='icon-external-link'></i></span>
                            <a style='margin-left:10px;'' ><button class='btn btn-primary' type='button' onClick='others(2)'>
                                <i class='icon-reply'></i> Back</button></a>";
										
			}if($id==2){
					$support_ticket_subject = $this->Support_Model->get_support_subject_list(); 
					echo "<select class='form-control' data-rule-required='true' id='sub' name='sub'>";
                    for($i=0;$i<count($support_ticket_subject);$i++){
						echo '<option value="'.$support_ticket_subject[$i]->support_ticket_subject_value.'">'.$support_ticket_subject[$i]->support_ticket_subject_value.'</option>';
					}
					echo "</select><span class='input-group-addon'><i class='icon-th-list'></i></span>
                            <a style='margin-left:10px;' ><button class='btn btn-primary' type='button' onClick='others(1)'>
                                <i class='icon-external-link'></i> Other</button></a>";
			}
		}
		function add_subject_new(){
		
			$data12 = array(
			'support_ticket_subject_value' => $_POST['curr']
			);
			
			$this->db->insert('support_ticket_subject', $data12);
			$this->db->insert_id();
			redirect('support/add_subject','refresh');
		}
		function add_new_ticket(){
			$this->form_validation->set_rules('user', 'User', 'required');
			$this->form_validation->set_rules('message', 'Message', 'required');
		
			if($this->form_validation->run()==FALSE){
	  			redirect('support/add_ticket','refresh');
			}else{
				$domain = $_POST['domain'];
				$usertype = $_POST['usertype'];
				$user = $_POST['user'];
				$sub = $_POST['sub'];
				$message = $_POST['message'];
			
				$config['upload_path'] = './upload_files/support_ticket/'.$domain;
				$config['allowed_types'] = '*';
				$this->load->library('upload', $config);

				if($_FILES['file_name']['name']!=''){
					
					if ( ! $this->upload->do_upload('file_name')){
						$error = array('error' => $this->upload->display_errors());
						$data['status'] = "<div class='alert alert-danger alert-dismissable'>
								             <a class='close' data-dismiss='alert' href='#'>&times;</a>
								                File Attachment Failed!
								              </div>";
						$data['country'] = $this->Domain_Model->get_country_list(); 
					
						$data['domain_list'] = $this->Domain_Model->get_domain_list(); 
						$data['usertypes'] = $this->Domain_Model->get_usertypes_list(); 
						$data['support_ticket_subject'] = $this->Support_Model->get_support_subject_list(); 
						$this->load->view('support/add_ticket',$data);
					}
						$cc = $this->upload->data('file');
						$image_path = 'upload_files/support_ticket/'.$domain.'/'.$cc['file_name'];
				}else{
		
					$image_path = '';
				}
				
				
				 
					$this->Support_Model->add_new_support_ticket($domain,$usertype,$user,$sub,$message,$image_path);
					
					$data['status'] = "<div class='alert alert-success alert-dismissable'>
						             <a class='close' data-dismiss='alert' href='#'>&times;</a>
						                Ticket has been created Successfully!
						              </div>";
					$data['country'] = $this->Domain_Model->get_country_list(); 
				
					$data['domain_list'] = $this->Domain_Model->get_domain_list(); 
					$data['usertypes'] = $this->Domain_Model->get_usertypes_list(); 
					$data['support_ticket_subject'] = $this->Support_Model->get_support_subject_list(); 

					$userdata = $this->Support_Model->get_user_details($usertype,$user);
					$mail['firstname'] = $firstname = $userdata->name;
			        $mail['mailid']= $mailid = $userdata->email;
			        $mail['subject']= $subject = "New Support Ticket From Admin "."-".$this->input->post('sub');
			        $mail['message']=  $message = $this->input->post('message');
				 $mail['email_template'] = $this->Email_Model->get_email_template('send_mail_to_user')->row();
			        $this->Email_Model->send_mail_to_user($mail);

					$this->load->view('support/add_ticket',$data);
			}
		}
		function delete_ticket($id)
		{
			 $wheres = "support_ticket_id = '$id'";
			 $this->db->delete('support_ticket', $wheres);
			 $this->db->delete('support_ticket_history', $wheres);
			redirect('support/support_view','refresh');
		}
		function delete_subject($id)
		{
		
			  $wheres = "support_ticket_subject_id = $id";
				$this->db->delete('support_ticket_subject', $wheres);
			redirect('support/add_subject','refresh');
		}
		
		function checkuserdomain()
		{
			$domain_id = $this->session->userdata('domain_id');
			if(!empty($domain_id))
			{
				return $domain_id;
			}
			else
			{
				return false;
			}	
		}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
