	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel_mgmt extends CI_Controller {

	public function __construct(){
      parent::__construct();
	  $this->load->database(); 
	  $this->load->library('upload');	

	
	  $this->check_isvalidated();	
      $this->load->library('form_validation','session');
      
		//$this->load->helper('csv');  
	  $this->load->dbutil();
      $this->load->model('Hotelmgmt_Model');
	  $this->load->model('booking_model');
	  //$this->load->model('markup_b2c_model', 'markup_b2c_model', true);	  
	  
	  $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      $this->output->set_header("Pragma: no-cache");

     
    }


private function check_isvalidated(){
		
		if(! $this->session->userdata('supplier_logged_in'))
	   {
		       redirect('login/supplier_login');
      }
	   }
 

    function index(){
    	
    	if(! $this->session->userdata('supplier_logged_in'))
	   {
		       redirect('login/supplier_login');
      }
      else{
		 $sup_id =   $this->session->userdata('supplier_id');
  		 $data['result'] = $this->Hotelmgmt_Model->getSuppliers($sup_id);
		  $data['result_view']=$this->Hotelmgmt_Model->getSuppliers_hotel($sup_id);
     $data['id']=$sup_id;
    	$this->load->view('hotel_crs/view', $data);
    } }
 
   function my_bookings()
   {
	   	if(! $this->session->userdata('supplier_logged_in'))
	   {
		       redirect('login/supplier_login');
      }
      else{
		 $sup_id =   $this->session->userdata('supplier_id');
  		 $data['Bookings'] = $this->Hotelmgmt_Model->getSuppliers_hotel_bookings($sup_id);
		 
     $data['id']=$sup_id;
    	$this->load->view('hotel_crs/orders', $data);
    } 
   }

    public function voucher($module,$pnr_no){
        $pnr_no = base64_decode(base64_decode($pnr_no));
        $data['Booking'] = $booking = $this->booking_model->getBookingbyPnr($pnr_no,$module)->row();
        //echo '<pre>';print_r($data['Booking']);die;
        if($module == 'APARTMENT'){
            $data['Map'] = $this->getStaticMap($data['Booking']->PROP_LATITUDE, $data['Booking']->PROP_LONGITUDE);
            $data['host_profile_link'] = WEB_URL.'users/show/'.$data['Booking']->user_id;
            $data['apt_link'] = WEB_URL.'apartment/rooms/'.$data['Booking']->PROP_ID;
            $this->load->view('orders/apartment_voucher',$data);
        }else if($module == 'FLIGHT'){
            $this->load->view('orders/flight_voucher',$data);
        }else if($module == 'HOTEL'){

            $checkin_date = strtotime($booking->checkin);
            $checkout_date = strtotime($booking->checkout);
                
            $absDateDiff = abs($checkout_date - $checkin_date);
            $data['number_of_nights'] = floor($absDateDiff/(60*60*24));

            $this->load->view('orders/hotel_voucher',$data);
        }else if($module == 'CAR'){
			  
            $this->load->view('orders/car_voucher',$data);
        }else if($module == 'VACATION'){
            $this->load->view('orders/vacation_voucher',$data);
        }
        
    }

    public function getStaticMap($lat, $long){
        $locstring='';$firstloc=0;
        $long="77.5667";
        $lat="12.9667";
                        
        if($firstloc==0){
            $locstring=$locstring.$lat.','.$long.'&markers=icon:'.WEB_FRONT_DIR.'assets/images/marker_out.png%7C'.$lat.','.$long;
            $firstloc=1;
        }else{
            $locstring=$locstring.'&markers=icon:'.ASSETS.'images/marker_out.png%7C'.$lat.','.$long;
        }        
        $url="http://maps.googleapis.com/maps/api/staticmap?zoom=16&size=627x327&maptype=ROADMAP&".urlencode("center")."=".$locstring."&sensor=false";
        return $url;
    }
   	}
/* End of file apartment.php */
/* Location: ./application/controllers/apartment.php */
