<?php

class Manage_Orders extends CI_Controller{

	public function __construct(){
		parent::__construct();
        $this->load->database();
        $this->load->model('Admin_Model');
        $this->load->model('Domain_Model');
        $this->load->model('B2c_Model');
        $this->load->model('Email_Model');
        $this->load->model('Home_Model');
        $this->load->model('Support_Model');
	    $this->load->model('booking_model');
	    $this->load->model('Manage_Orders_Model');
        $this->check_isvalidated();
        $this->load->library('form_validation');

        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        //$this->domain_id = $this->checkuserdomain();

        if ($this->session->userdata('admin_logged_in')) {
            $this->load->helper('url');
            $controller = $this->router->fetch_class();
            parent::check_modules($controller);
            $this->load->model('Privilege_Model');
            $sub_admin_id = $this->session->userdata('admin_id');
            $this->data['modules'] = $this->Privilege_Model->get_privileges_by_sub_admin_id($sub_admin_id)->result();
        }
    }

    private function check_isvalidated() {
        if (!$this->session->userdata('admin_logged_in') && !$this->session->userdata('sa_logged_in')) {
            redirect('login/index');
        }
    }
	

	public function index()
	{
		$input = $this->input->post();
		if(!empty($input))
		{
			$data['Bookings'] = $this->Manage_Orders_Model->get($input)->result();
			$this->load->view('orders/manage_orders',$data);
		}else{
			$data['Bookings'] = $this->Manage_Orders_Model->get($input='')->result();
			$this->load->view('orders/manage_orders',$data);
		}
	}

	public function get()
	{
		$input = $this->input->post();
		if(!empty($input))
		{
			$data['Bookings'] = $this->Manage_Orders_Model->get($input)->result();
			$this->load->view('orders/view_orders',$data);
		}else{
			$data['Bookings'] = $this->Manage_Orders_Model->get($input='')->result();
			$this->load->view('orders/view_orders',$data);
		}
	}
}