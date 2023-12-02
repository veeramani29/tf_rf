<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {

	public function __construct(){
      parent::__construct();
	  $this->load->database(); 
	  $this->load->model('Admin_Model');
	  $this->load->model('Domain_Model');
	  $this->load->model('Api_Model');
	  $this->check_isvalidated();	
      $this->load->library('form_validation');
     
	  $this->load->model('Support_Model');
	  $this->load->model('Home_Model');
	  
	   $this->load->model('markup');
	   $this->load->model('payment_model');
		//$this->load->model('markup_b2c_model', 'markup_b2c_model', true);	  
	  
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


    function index(){
    	$data['result'] = $this->payment_model->fetch_charges()->result();
    	//echo '<pre>';print_r($data['result']);
    	$this->load->view('payment_gateway/view',$data);
    }

    function del_mark($id){ 
		if((int)$id > 0){
   			$this->payment_model->delete_charges($id);  
 	  	}
 	  	redirect('payment');
    }

    function save_charges(){ 
	  $this->payment_model->add_charges();	   	
	  redirect('payment');
	}

 
	
	function save_charges_geo(){ 
	  $this->payment_model->add_charges_geo();	   	
	  redirect('payment');
	}
    
	function add_charges_gen(){
		$data['products'] = $this->payment_model->get_products();
		//$data['apis'] = $this->payment_model->get_api_filtered();
		$this->load->view('payment_gateway/charges_gen',$data);
	}

	function add_charges_geo(){
		$data['countries'] = $this->payment_model->get_countries_filtered();
		$this->load->view('payment_gateway/charges_country',$data);
	}

	function edit($id,$type){
		$data['result'] = $this->payment_model->get_charges_by_id($id,$type)->row();
		$data['id'] = $id;
		$data['type'] = $type;
		//echo '<pre>';print_r($data['result']);
		$this->load->view('payment_gateway/edit_charges',$data);
	}
	function update(){
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		$markup = $this->input->post('markup');
		$this->payment_model->update_charges($id,$markup);
		redirect('payment');
	}

	  
	 
		private function check_isvalidated(){
		
		if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in'))
	   {
		       redirect('login/index');
      }
	   }
	   
	   function view_service_charge()
	   {
		 $data["result"]=$this->payment_model->get_apart_service_charges();
	    	$this->load->view('payment_gateway/service_view', $data);
	   }
	   
	   function add_service_charge()
	   {
		$data['products'] = $this->payment_model->get_products();
		$data['apis'] = $this->payment_model->get_api_filtered_service();
	    	$this->load->view('payment_gateway/add_service_charge',$data);
	    }
	   
	   
	    function save_service_charges()
      	   { 
	   	$api = $this->input->post('api');
       		$service = $this->input->post('service');
       		$data= array('service_charge'=>$service, 'api_id'=>$api);
	   	$this->payment_model->save_service_charges($data);	   	
	   	redirect('payment/view_service_charge');
	  }
	  
	  
     function del_charge($id){ 
	 if((int)$id > 0){
   	 $this->payment_model->delete_service_charge($id);  
 	 }
 	   redirect('payment/view_service_charge');
     }
     
     function edit_service_charges($eid)
     {
	  $data["eid"]=$eid;
	  $data["result"]=$this->payment_model->get_pay_service_charges_by_id($eid);
	 	$this->load->view('payment_gateway/edit_charge',$data); 
	 }
	 
	 
	 function update_charge()
	 {
		$charge=$this->input->post("charge");
		 $id=$this->input->post("id");
		 
		 $data=array('service_charge'=>$charge);
		 $this->payment_model->update_charge($data,$id);
		  redirect('payment/view_service_charge');		 
	 }
	
	public function isProductExists(){
		$id = $this->input->post('data');
		$res = $this->payment_model->isServiceExists($id);
		if(!empty($res)){
			$response = array('msg'=>'Service charge is already added for the product, Please update it','status'=>0);
		}else{
			$response = array('msg'=>'Service charge is available, please add it','status'=>1);
		}
		echo json_encode($response);
	} 
	public function isPaymentProductExists(){
		$id = $this->input->post('data');
		$res = $this->payment_model->isPaymentProductExists($id);
		if(!empty($res)){
			$response = array('msg'=>'Payment gateway charge is already added for the product, Please update it','status'=>0);
		}else{
			$response = array('msg'=>'Payment gateway charge is available, please add it','status'=>1);
		}
		echo json_encode($response);
	} 
	 
 
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
