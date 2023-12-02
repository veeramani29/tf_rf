<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Affiliate extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model('Affiliate_Model');
    }

    public function update_template() {
        $admin_id = $this->session->userdata('admin_id');
        if($_POST)
        {
            $header = $this->input->post('header');
            $footer = $this->input->post('footer');
            
            $this->Affiliate_Model->updateAffiliateTemplate($admin_id,$header,$footer);
            redirect('affiliate/update_template');
        }
        else
        {
            $data['result'] = $this->Affiliate_Model->getSiteTemplateOnId($admin_id);
            $this->load->view('affiliate/index',$data);
        }
    }
    
    private function is_logged_in() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('login/admin_login');
        }
    }
    
}