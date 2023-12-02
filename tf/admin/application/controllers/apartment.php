<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apartment extends CI_Controller {

	public function __construct(){
    parent::__construct();
	  $this->load->database(); 
	  $this->check_isvalidated();	
    $this->load->model('apartment_model');
	    
	  if($this->session->userdata('admin_logged_in')){
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

  public function index(){
    $data['properties'] = $this->apartment_model->get_properties()->result();
    //echo '<pre>';print_r($data['properties']);die;
    $this->load->view('properties/properties', $data);
  }

  public function updatePropertyStatus($id,$value){
    $status = array('PROPERTY_STATUS'=>$value);
    $res = $this->Kigo_Model->updatePropertyStatus($id, $status);
    if($res){
      redirect('apartment');
    }
  }

  public function bookings($prop_id){
    $data['Bookings'] = $this->apartment_model->getPropertyBookings($prop_id)->result();
    //echo '<pre>';print_r($data['Bookings']);die;
    $this->load->view('orders/prop_orders',$data);
  }

























  //Old Functions Start
  function invoice(){
      $data['result']=$this->apartment_model->get_apartment_invoice_details();
      //print_r($data); exit();
      $this->load->view('apartment/edit_invoice',$data);
  }
  
  function confirmation_letter(){
      $data['result']=$this->apartment_model->get_apartment_invoice_details();
      $this->load->view('apartment/edit_confirmationletter',$data);
  }

  function flight_confirmation(){
    $data['result']=$this->apartment_model->get_apartment_invoice_details();
    $this->load->view('apartment/edit_flightconfirmation',$data); 
  }
function hotel_confirmation(){
  $data['result']=$this->apartment_model->get_apartment_invoice_details();
  $this->load->view('apartment/edit_hotelconfirmation',$data); 
}
  
  function update_invoice() {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
        
    $data = array(
        'in_address' => $address,
        'in_phone' => $phone,
        'in_email' => $email
    );

    $where = "apartment_invoice_id = 1";
    if ($this->db->update('apartment_invoice', $data, $where)) {
       $data['status'] = '<div class="alert alert-block alert-success">
            <a href="#" data-dismiss="alert" class="close">×</a>
            <h4 class="alert-heading">Success!</h4>
            Update Has Been Completed !!!
          </div>';
     
    } else {
        $data['status'] = '<div class="alert alert-block alert-danger">
            <a href="#" data-dismiss="alert" class="close">×</a>
            <h4 class="alert-heading">Error!</h4>
            Update Has not Been Completed !!!
          </div>';
     
    }
   
    $data['result']=$this->apartment_model->get_apartment_invoice_details();
    $this->load->view('apartment/edit_invoice',$data);
  }

  function update_hotelconfirmation() {
         $hotel_cl_email = $_POST['hemail'];
        $hotel_cl_phone = $_POST['hphone'];
        $hotel_cl_address = $_POST['haddress'];
        $hotel_cl_header_cnt =$_POST['headline'];
        $hotel_cl_terms = $_POST['conditions'];
        
    $data = array(
            'hotel_cl_email' =>$hotel_cl_email,
            'hotel_cl_phone' =>$hotel_cl_phone,
            'hotel_cl_address'=>$hotel_cl_address,
            'hotel_cl_header_cnt'=>$hotel_cl_header_cnt,
            'hotel_cl_terms' =>$hotel_cl_terms
    );

    $where = "apartment_invoice_id = 1";
    if ($this->db->update('apartment_invoice', $data, $where)) {
       $data['status'] = '<div class="alert alert-block alert-success">
            <a href="#" data-dismiss="alert" class="close">×</a>
            <h4 class="alert-heading">Success!</h4>
            Update Has Been Completed !!!
          </div>';
     
    } else {
        $data['status'] = '<div class="alert alert-block alert-danger">
            <a href="#" data-dismiss="alert" class="close">×</a>
            <h4 class="alert-heading">Error!</h4>
            Update Has not Been Completed !!!
          </div>';
     
    }
   
    $data['result']=$this->apartment_model->get_apartment_invoice_details();
    $this->load->view('apartment/edit_hotelconfirmation',$data);
  }

  function update_flightconfirmation() {
          $flight_cl_email = $_POST['femail'];
        $flight_cl_phone = $_POST['fphone'];
        $flight_cl_address = $_POST['faddress'];
        $flight_cl_terms = $_POST['terms'];
        
    $data = array(
            'flight_cl_email' =>$flight_cl_email,
            'flight_cl_phone' =>$flight_cl_phone,
            'flight_cl_address' =>$flight_cl_address,
            'flight_cl_terms' =>$flight_cl_terms
    );

    $where = "apartment_invoice_id = 1";
    if ($this->db->update('apartment_invoice', $data, $where)) {
       $data['status'] = '<div class="alert alert-block alert-success">
            <a href="#" data-dismiss="alert" class="close">×</a>
            <h4 class="alert-heading">Success!</h4>
            Update Has Been Completed !!!
          </div>';
     
    } else {
        $data['status'] = '<div class="alert alert-block alert-danger">
            <a href="#" data-dismiss="alert" class="close">×</a>
            <h4 class="alert-heading">Error!</h4>
            Update Has not Been Completed !!!
          </div>';
     
    }
   
    $data['result']=$this->apartment_model->get_apartment_invoice_details();
    $this->load->view('apartment/edit_flightconfirmation',$data);
  }

  function update_letter() {

        $cl_email = $_POST['email'];
        $cl_phone = $_POST['phone'];
        $cl_address = $_POST['address'];
        $cl_heading_line = $_POST['address1'];
        $cl_payment = $_POST['address2'];
        $cl_service = $_POST['address3'];
        
    $data = array(
            'cl_email' => $cl_email,
            'cl_phone' => $cl_phone,
            'cl_address' => $cl_address,
      'cl_heading_line' => $cl_heading_line,
            'cl_payment' => $cl_payment,
            'cl_service' => $cl_service
            
        );

        $where = "apartment_invoice_id = 1";
        if ($this->db->update('apartment_invoice', $data, $where)) {
           $data['status'] = '<div class="alert alert-block alert-success">
                <a href="#" data-dismiss="alert" class="close">×</a>
                <h4 class="alert-heading">Success!</h4>
                Update Has Been Completed !!!
              </div>';
         
        } else {
            $data['status'] = '<div class="alert alert-block alert-danger">
                <a href="#" data-dismiss="alert" class="close">×</a>
                <h4 class="alert-heading">Error!</h4>
                Update Has not Been Completed !!!
              </div>';
         
        }
       
        $data['result']=$this->apartment_model->get_apartment_invoice_details();
      //print_r($data); exit();
      $this->load->view('apartment/edit_confirmationletter',$data);
        
    }
  
}