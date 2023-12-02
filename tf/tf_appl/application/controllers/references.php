<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class References extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('account_model');
        $this->load->model('reference_model');
        $this->load->model('Auth_Model');
        $this->load->model('email_model');
        $this->load->model('verification_model');
        $current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
        $current_url = $this->config->site_url().$this->uri->uri_string(). $current_url;
        $url =  array(
            'continue' => $current_url,
        );
        $this->session->set_userdata($url);
        $this->load->model('Help_Model');
        $this->helpMenuLink = $this->Help_Model->fetchHelpLinks();
    }

	public function index($ref_id,$a_status){
        $reference = array(
            'a_status' => $a_status
        );
        $this->reference_model->updateReferenceById($reference,$ref_id);
        redirect(WEB_URL.'/dashboard/profile/references');
    }

    

}

/* End of file users.php */
/* Location: ./application/controllers/users.php */
