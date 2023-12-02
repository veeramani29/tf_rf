<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller {

    protected $domain_id;
    public function __construct()
    {
          parent::__construct();
          $this->load->database(); 
          $this->load->model('Admin_Model');
          $this->load->model('B2b_Model');
          $this->load->model('Home_Model');
          $this->load->model('Domain_Model');
          $this->load->model('Deposit_Model');
          $this->load->model('Support_Model');
          $this->load->model('Email_Model');
          $this->check_isvalidated();   
          $this->load->library('form_validation');
            
          $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
          $this->output->set_header("Pragma: no-cache");
          $this->domain_id = $this->checkuserdomain();

          if($this->session->userdata('admin_logged_in'))
          {
            $this->load->helper('url');
            $controller = $this->router->fetch_class();
            //  parent::check_modules($controller);
            $this->load->model('Privilege_Model');
            $sub_admin_id = $this->session->userdata('admin_id');
            $this->data['modules'] = $this->Privilege_Model->get_privileges_by_sub_admin_id($sub_admin_id)->result();
          }
    }

    public function check_isvalidated()
    {
        if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in'))
        {
            redirect('login/index');
        }
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

   /*Load the view of the email table, showing all the emails stored inside the database*/
   /*
    *@author; Vikas Arora
              Email Module starts here
   */
    public function manage_emails()
    {
        $data['title'] = 'Manage Emails';
        $data['breadcrumb']['Manage Emails'] = '';
        $data['manage_email_data'] = $this->Admin_Model->get_all_email_data();

        $this->load->view('manage_edit_email/manage_emails/view', $data);  
    }

    /*Go to the email edit page using id to fetch the placeholder records for fields*/
    public function edit_emails($id)
    {
        $data['title'] = 'Edit Email';
        $data['breadcrumb']['Edit Email'] = '';
            
        $data['email_data'] = $this->Admin_Model->get_single_email_details($id);

        $this->load->view('manage_edit_email/manage_emails/edit_email',$data);
    }       

    /*Update the email details in the database*/
    public function update_email($id)
    {
        $data['subject'] = $this->input->post('subject');
        $data['email_from'] = $this->input->post('email_from');
        $data['email_from_name'] = $this->input->post('email_from_name');
        $data['to_email'] = $this->input->post('to_email');
        $data['message'] = $this->input->post('email_body');

        $this->Admin_Model->update_email($id,$data);
        redirect('email/manage_emails');  
    }    


    /*Fetch template via ajax request*/
    public function fetch_email_template($id)
    {
        $template_data = $this->Admin_Model->fetch_email_template($id);
        echo json_encode($template_data); /*Return back the json object to the AJAX request.*/
    }
/*Email Module End*/
}


