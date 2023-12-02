<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promo extends CI_Controller {

	public function __construct()
    {
      parent::__construct();
	  $this->load->database(); 
	  $this->load->model('Admin_Model');
	   $this->load->model('Domain_Model');
	   $this->load->model('Promo_Model');
	    $this->load->model('Email_Model');
	     $this->load->model('Support_Model');
	     $this->load->model('Home_Model');
	$this->load->model('Newsletter_Model');
	  $this->check_isvalidated();	
   		$this->load->library('form_validation');
			
	  $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      $this->output->set_header("Pragma: no-cache");
		
	  if($this->session->userdata('admin_logged_in')){
	  		$this->load->helper('url');
	  		$controller = $this->router->fetch_class();
	  		//parent::check_modules($controller);
	  		$this->load->model('Privilege_Model');
	  		$sub_admin_id = $this->session->userdata('admin_id');
	  		$this->data['modules'] = $this->Privilege_Model->get_privileges_by_sub_admin_id($sub_admin_id)->result();
	  }
	  
    }
	  private function check_isvalidated(){
		
		if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in'))
	   {
		       redirect('login/index');
       }
		
		
		
    }
	function add_new_promo()
	{
		$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$res = "";
		for ($i = 0; $i < 10; $i++) {
			$res .= $chars[mt_rand(0, strlen($chars)-1)];
		}
		$data['promo_code'] = $res;
		$this->load->view('promo/add_promo',$data);
	}
	function add_promo_new()
	{
			$promo_code = $_POST['promo_code'];
			$discount = $_POST['discount'];
			$exp_date = $_POST['exp_date'];
			$e_date = explode("/",$_POST['exp_date']);
			
			$yy = explode(" ",$e_date[2]);
			//echo '<pre>';print_r($e_date);
			$e_date1 = $yy[0].'-'.$e_date[0].'-'.$e_date[1].' 00:00:00.000000';
			//echo $e_date1;die;
		$Query="select * from  promo  where promo_code ='".$promo_code."' ";
	 
		 $query=$this->db->query($Query);
		
		if ($query->num_rows() > 0)
		{
			
			$data['status'] = '<div class="alert alert-block alert-danger">
							   <a href="#" data-dismiss="alert" class="close">×</a>
							   <h4 class="alert-heading">Already Promo Code Registered!</h4>
							   kindly Use Another One !!!
							   </div>';
			$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$res = "";
			for ($i = 0; $i < 10; $i++) {
				$res .= $chars[mt_rand(0, strlen($chars)-1)];
			}
			$data['promo_code'] = $res;
			$this->load->view('promo/add_promo',$data);
		
		}
		else
		{
			if($this->Promo_Model->add_promo_new($discount,$promo_code,$e_date1))
			{
				redirect('promo/promo_view','refresh');
			}
			
		}
	}
	
	function add_promo_new_amount()
	{
			$promo_code = $_POST['promo_code'];
			$discount = $_POST['discount'];
			$exp_date = $_POST['exp_date'];
			$promo_amount = $_POST['promo_amount'];
			$e_date = explode("/",$_POST['exp_date']);
			$yy = explode(" ",$e_date[2]);
			//echo '<pre>';print_r($e_date);
			$e_date1 = $yy[0].'-'.$e_date[0].'-'.$e_date[1].' 00:00:00.000000';
			//echo $e_date1;die;
		$Query="select * from  promo  where promo_code ='".$promo_code."' ";
	 
		 $query=$this->db->query($Query);
		
		if ($query->num_rows() > 0)
		{
			
			$data['status'] = '<div class="alert alert-block alert-danger">
							   <a href="#" data-dismiss="alert" class="close">×</a>
							   <h4 class="alert-heading">Already Promo Code Registered!</h4>
							   kindly Use Another One !!!
							   </div>';
			$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$res = "";
			for ($i = 0; $i < 10; $i++) {
				$res .= $chars[mt_rand(0, strlen($chars)-1)];
			}
			$data['promo_code'] = $res;
			$this->load->view('promo/add_promo',$data);
		
		}
		else
		{
			if($this->Promo_Model->add_promo_new_amount($discount,$promo_code,$e_date1,$promo_amount))
			{
				redirect('promo/promo_view','refresh');
			}
			
		}
	}
	
	function add_promo_new_spending()
	{
			$promo_code = $_POST['promo_code'];
			$discount = $_POST['discount'];
			$exp_date = $_POST['exp_date'];
			$promo_amount = $_POST['promo_amount'];
			
			$e_date = explode("/",$_POST['exp_date']);
			$e_date1 = $e_date[2].'-'.$e_date[0].'-'.$e_date[1].' 00:00:00';
		$Query="select * from  promo  where promo_code ='".$promo_code."' ";
	 
		 $query=$this->db->query($Query);
		
		if ($query->num_rows() > 0)
		{
			
			$data['status'] = '<div class="alert alert-block alert-danger">
							   <a href="#" data-dismiss="alert" class="close">×</a>
							   <h4 class="alert-heading">Already Promo Code Registered!</h4>
							   kindly Use Another One !!!
							   </div>';
			$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$res = "";
			for ($i = 0; $i < 10; $i++) {
				$res .= $chars[mt_rand(0, strlen($chars)-1)];
		}
		$data['promo_code'] = $res;
		$this->load->view('promo/add_promo',$data);
		
		}
		else
		{
			if($this->Promo_Model->add_promo_new_spending($discount,$promo_code,$e_date1,$promo_amount))
			{
				redirect('promo/promo_view','refresh');
			}
			
		}
	}
	
	function send_user_mail($id)
	{
		
	
		$data['id']= $id;
		$this->load->view('promo/send_mail',$data);
		
	}
		
	public function promo_view()
	{ 
		
		$data['promo'] = $this->Promo_Model->get_promo_list(); 
		$this->load->view('promo/view',$data);
    }
    
    
	function send_mail_user_new($id)
	{
		$email  = '';
		if(isset($_POST['b2c']))	
		{
			$b2c = $this->Promo_Model->get_user_list(); 
			for($i=0;$i<count($b2c);$i++)
			{
				$email  .= $b2c[$i]->email.', ';
			}
		}
		if(isset($_POST['b2b']))	
		{
			$b2b = $this->Promo_Model->get_agent_list(); 
			for($i=0;$i<count($b2b);$i++)
			{
				$email  .= $b2b[$i]->email_id.', ';
			}
		}if(isset($_POST['newsletter'])){
			$subs = $this->Newsletter_Model->get_all_subscribers();
			foreach($subs as $sb){
				$email  .= $sb->email_id.', ';
			}
		}
		if($_POST['emailid'] !='')	
		{
			
				$email  .= $_POST['emailid'] ;
			
		}
		$promo_value = $this->Promo_Model->get_promo_code_id($id); 
		$data['promo_code'] = $promo_value;
        	$exp_date = date('M j,Y', strtotime($promo_value->exp_date));
		$data['email_template'] = $this->Email_Model->get_email_template('promo_code')->row();
		/*$message = '<br>Take it your promo code.<br><br>';
		$message .='Please note, your discount code is <font color="#990033"><blink>'.$promo_value->promo_code.'</blink></font> which can be used to get <strong>'.$promo_value->discount.'% </strong>off while using our services.<br>
		This code is valid upto '.$exp_date;
		$message_header='Promo Code';*/
		$data['emailid'] = $email;
		$data['firstname'] = $fnam = 'Customer';
		$data['email_template']->subject = $_POST['subject'];
		$this->Email_Model->send_promocode_mail($data);
		//$this->Email_Model->send_email($fnam,$subject,$email,$message_header,$message);
		redirect('promo/promo_view','refresh');
		
	}
	function update_promo_status($id,$status)
	{
		
		if($status==2)
		{
				$wheres = "promo_id = $id";
				$this->db->delete('promo', $wheres);
				
		}
		else
		{
			
		 $this->Promo_Model->update_promo_status($id,$status); 
		
		}
			redirect('promo/promo_view','refresh');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
