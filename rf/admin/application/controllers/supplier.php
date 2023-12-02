	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier extends CI_Controller {

	public function __construct(){
      parent::__construct();
	  $this->load->database(); 
	  $this->load->library('upload');	

	
	 // $this->check_isvalidated();	
      $this->load->library('form_validation','session');
      
		//$this->load->helper('csv');  
		$this->load->dbutil();
      $this->load->model('Hotelcrs_model');
	
	  $this->load->model('Supplier_model');
	
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


private function check_isvalidated(){
		
		if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in'))
	   {
		       redirect('login/index');
      }
	   }
 

    function index(){
    	
    	if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in'))
	   {
		       redirect('login/index');
      }
      else{
   $data['result'] = $this->Supplier_model->getSuppliers();
    	$this->load->view('suppliers/suppliers', $data);
    } }
 
    function delete_supplier($id)
	{
		$this->Supplier_model->delete_supplier($id);
		redirect('supplier');
	}
   	function add_supplier()
	{ 
if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in'))
	   {
		       redirect('login/index');
      } else {	
	 	$data['hotel']=$this->Supplier_model->fetch_hotelcrs();
		$data['hotel_list'] = $this->Supplier_model->view_all_hotels_admin();
		$data['country_list'] = $this->Hotelcrs_model->fetch_country_list();
		$this->load->view('suppliers/add_supplier',$data);
	}
}

function insert_supplier()
	{
		//$country = implode(',',$_POST['country']);
		//$city = implode(',',$_POST['city']);
		$select = "SELECT * FROM supplier where email='".$_POST['emailid']."'";
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
				$data['error']='Email Address Already Exists!!!!';
			 	$data['hotel']=$this->Supplier_model->fetch_hotelcrs();
		$data['hotel_list'] = $this->Supplier_model->view_all_hotels_admin();
		$data['country_list'] = $this->Hotelcrs_model->fetch_country_list();
		$this->load->view('suppliers/add_supplier',$data);
		
		} else {
			
		$hotel = $_POST['hotel'];
		
		$data['email'] = $_POST['emailid'];
		$data['password'] = $_POST['password'];
		$data['firstname'] = $_POST['fname'];
		$data['lastname'] = $_POST['lname'];
		$data['address'] = $_POST['address'];
		$data['contact_no'] = $_POST['ph_no'];
		$data['city'] = $city;
		$data['postal_code'] = $_POST['post_code'];
		$data['country'] = '';
		$data['hotel_id'] = '';
		$data['status'] = 1;		
		
		$this->Supplier_model->insert_supplier($data);
		
	 			
		redirect('supplier');
		}
		
	}

public function update_supplier($id){
        if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in'))
	{
            redirect('login/index');
	}
        $data['hotel']=$this->Supplier_model->fetch_hotelcrs();
        $data['hotel_list']=$this->Supplier_model->view_all_hotels_admin($id);
        $data['country_list'] = $this->Hotelcrs_model->fetch_country_list();
        $data['result'] = $this->Supplier_model->getSuppliers($id);
        $this->load->view('suppliers/update_supplier',$data);
}



public function update_supplierbyId($id){
	
    if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in'))
    {
        redirect('login/index');
    }     
    
  //  print_r($_POST); exit();   
    $result = $this->Supplier_model->updateSupplier($_POST,$id);
    redirect('supplier','refresh');
}




public function add_hotels($id){
	
    if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in'))
    {
        redirect('login/index');
    }     
    
  	//  print_r($_POST); exit();   
   $data['result'] = $this->Supplier_model->getSuppliers_hotels($id);
   $data['id']=$id;
   $this->load->view('suppliers/suppliers_hotel', $data);
}


public function add_supplier_hotel($id){
	
    if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in'))
    {
        redirect('login/index');
    }     
    
  	//  print_r($_POST); exit();   
   $data['result'] = $this->Supplier_model->fetch_hotelcrs();
   $data['supp_id']=$id;
   $this->load->view('suppliers/add_supplier_hotel', $data);
}
public function delete_hotels_to_supplier($id,$sid){
	
    if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in'))
    {
        redirect('login/index');
    }     
    
  	//  print_r($_POST); exit();   
 
   $this->Supplier_model->delete_supplier_hotel($id);
	  $data['id']=$sid;
    
 $data['result'] = $this->Supplier_model->getSuppliers_hotels($sid);

   $this->load->view('suppliers/suppliers_hotel', $data);
		
		
}
public function add_hotels_to_supplier($hotel_id,$supplier_id){
	
    if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in'))
    {
        redirect('login/index');
    }     
    
  	//  print_r($_POST); exit();   
  $this->Supplier_model->update_hotel_suppiler($hotel_id,$supplier_id);

   $data['id']=$supplier_id;
    
 $data['result'] = $this->Supplier_model->getSuppliers_hotels($supplier_id);

   $this->load->view('suppliers/suppliers_hotel', $data);
}



   	}
/* End of file apartment.php */
/* Location: ./application/controllers/apartment.php */
