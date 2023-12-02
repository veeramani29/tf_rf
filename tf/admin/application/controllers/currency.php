<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Currency extends CI_Controller {

	public function __construct()
    {
      parent::__construct();
	  $this->load->database(); 
	  $this->load->model('Admin_Model');
	  $this->load->model('Domain_Model');
	  $this->check_isvalidated();	
   	  $this->load->library('form_validation');
	   $this->load->model('Support_Model');
	   $this->load->model('Home_Model');
	   	
	  $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      $this->output->set_header("Pragma: no-cache");

      if($this->session->userdata('admin_logged_in')){
	  		$this->load->helper('url');
	  		$controller = $this->router->fetch_class();
	  		parent::check_modules($controller);
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
	function currency_converter()
	{
	  $data['currency'] = $this->Admin_Model->get_currency_list(); 
	  $this->load->view('currency/currency_converter',$data);
		
	}
	
	function edit_currency($id){
		
		$data['currency'] = $this->Admin_Model->getCurrencyData($id);
		
		//print_r($data['currency']);exit;
			
		$this->load->view('currency/edit_currency',$data);	
	}
	
	function delete_currency($id){
		
		$this->Admin_Model->deleteCurrencyData($id);
		
		//print_r($data['currency']);exit;
			
		 redirect('currency/currency_converter','refresh');
	}
	
	function update_currency($id)
	{
		//print_r($_POST);exit;
		$currency= $_POST['currency'];
		$value=$_POST['value'];
		$code=$_POST['country_code'];
		$name=$_POST['currency_name'];
		$data=array('country' => $currency,'value' => $value,'country_code'=>$code,'currency_name'=>$name);
		$this->db->where('cur_id',$id);
		$this->db->update('currency_converter',$data);
		redirect('currency/currency_converter','refresh');
	}
	
	function add_currency()
	{
		//echo '<pre/>';
		//print_r($_POST);exit;
		$this->form_validation->set_rules('curr', 'Currency Code', 'required');
		$this->form_validation->set_rules('val', 'Value', 'required');
		$this->form_validation->set_rules('country_code', 'Country Code', 'required');
		$this->form_validation->set_rules('currency_name', 'Currency Name', 'required');
		
		if($this->form_validation->run()==FALSE)
		{
	  		
			$this->load->view('currency/add_currency');
		}
		else
		{
			$currency = $_POST['curr'];
			$value = $_POST['val'];
			
			$Query="select * from  currency_converter  where country ='".$currency."' ";
	 
		 	$query=$this->db->query($Query);
		
		if ($query->num_rows() > 0)
		{
			
			$data['status'] = '<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Currency Code Already Exists!</h4>
							 
							</div>';
			
			$this->load->view('currency/add_currency',$data);
		}
		else
		{
			
		 
			if($this->Admin_Model->add_currency($currency,$value,$code,$name))
			{
					redirect('currency/currency_converter','refresh');
			}
			else
			{
				$data['status'] = '<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Currency Code Already Exists!</h4>
							 
							</div>';
			
			$this->load->view('currency/add_currency',$data);
			
			}


		
	
	  		
		}
		}
	}
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */