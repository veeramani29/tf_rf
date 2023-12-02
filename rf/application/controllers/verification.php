<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verification extends CI_Controller {
	public function __construct(){
        parent::__construct();
     	$this->load->model('account_model');
     	$this->load->model('email_model'); 
     	$this->load->model('verification_model');
     	$this->load->model('Auth_Model');   
     	$this->load->model('Help_Model');
		$this->helpMenuLink = $this->Help_Model->fetchHelpLinks();
    }

	public function email($key,$secret){
    	if($key == '' || $secret == ''){
    		$data['msg'] = 'The link you followed is no longer valid. You can attempt sending another verification email from your Dashboard.';
    		$data['status'] = '0';
    		if (!$this->session->userdata('b2c_id')) {
    			$this->load->view('login');
	    	}else{
	    		echo '<html><body>
						<form id="vForm1" action="'.WEB_URL.'/dashboard" method="POST">
							<input type="hidden" name="v_err" value="The link you followed is no longer valid. You can attempt sending another verification email from your Dashboard."/>
						</form>
						<script>document.getElementById("vForm1").submit();</script>
					 </body></html>';
	    	}
    	}else{
    		$count = $this->account_model->isvalidSecrect($key,$secret)->num_rows();
    		if($count == 1){
    			$user_data = $this->account_model->isvalidSecrect($key,$secret)->row();

    			$data['status'] = '1';
    			$data['email'] = $user_data->email;
    			$b2c_session =  array(
	                'b2c_id' => $user_data->user_id,
	                'provider' => 'rfactory'
	            );
	            $b2c_id = $user_data->user_id;
	            $b2c_type = $user_data->usertype;
	            $b2c_type_str = (string)$b2c_type;
	            $count = $this->verification_model->checkB2CVerfication($b2c_id, $b2c_type_str)->num_rows();
	            
	            if($count == 1){
	            	$update = array(
		            	'email' => '1'
		            );
		            $this->verification_model->updateB2CVerification($b2c_id,$update);
	            }else{
	            	$verification = array(
		            	'user_id' => $b2c_id,
		            	'email' => '1'
		            );
		            $this->verification_model->insertB2CVerification($verification);
	            }
	            if (!$this->session->userdata('b2c_id')) {
	            	$this->session->set_userdata($b2c_session);
	        	}
	            echo '<html><body>
					<form id="vForm" action="'.WEB_URL.'/dashboard" method="POST">
					<input type="hidden" name="email_v" value="Your Email is verified"/>
					</form>
					<script>document.getElementById("vForm").submit();</script></body></html>';
	        }else{
    			$data['msg'] = 'The link you followed is no longer valid. You can attempt sending another verification email from your Dashboard.';
				$data['status'] = '0';
				if (!$this->session->userdata('b2c_id')) {
		    		$this->load->view('login');
		    	}else{
		    		echo '<html><body>
							<form id="vForm" action="'.WEB_URL.'/dashboard" method="POST">
								<input type="hidden" name="err_v" value="The link you followed is no longer valid. You can attempt sending another verification email from your Dashboard."/>
							</form>
							<script>document.getElementById("vForm").submit();</script>
						 </body></html>';
		    	}
    		}
    	}
    	
    }

/* End of file account.php */
/* Location: ./application/controllers/account.php */

	public function changeSMSalertstatus() { 
		if($this->session->userdata('b2c_id')){
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        }

		$alert_id = $this->input->post('alert_id');
		if($this->verification_model->changeSMSalertstatus($user_id, $user_type, $alert_id)) {
			echo "DONE";
		} else {
			echo "Failed";
		}
	}

	
}

