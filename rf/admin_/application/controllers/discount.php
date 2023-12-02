<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Discount extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database(); 
		
		$this->load->library('form_validation');
		
		$this->load->model('Discount_Model');
		$this->load->model('Privilege_Model');
		$this->check_isvalidated();
		if($this->session->userdata('admin_logged_in')){
			$this->load->helper('url');
			$controller = $this->router->fetch_class();
		
			$sub_admin_id = $this->session->userdata('admin_id');
			$this->data['modules'] = $this->Privilege_Model->get_privileges_by_sub_admin_id($sub_admin_id)->result();
		}

	}
	  
	private function check_isvalidated(){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
	    	}else{
	    		redirect('login/index');
	    	}
	}
	
	public function index(){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			$data['pages'] = $this->Discount_Model->get_all_discounted_flights();
			$this->load->view('discount/manage_fligt_offers', $data);
		}else{
		  redirect('','refresh');
		}	
	}
	
	public function add_new_offer($id=''){
			
		error_reporting(0);
	if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			
			
			$origin = $this->input->post('origin');
			$destination = $this->input->post('destination');
			$short_desc = $this->input->post('txtshort');
			$price = $this->input->post('txtPrice');
			$exp_date = $this->input->post('exp_date');
			$to_date = $this->input->post('to_date');
			$type = $this->input->post('txtoffertype');
			$about_city = $this->input->post('aboutcity');
			$old_file = $this->input->post('hdnoldfile');
			$airline_list = $this->input->post('airline_list');
			$provider = $this->input->post('txtprovider');
			$offer_for=$this->input->post('offer_for');

			$this->form_validation->set_rules('offer_for', 'offer_for', 'required|xss_clean');
			$this->form_validation->set_rules('origin', 'origin', 'trim|required|min_length[3]|xss_clean');
        	$this->form_validation->set_rules('txtPrice', 'txtPrice', 'required|xss_clean');
        	$this->form_validation->set_rules('txtshort', 'txtshort', 'required|xss_clean');
			$this->form_validation->set_rules('exp_date', 'exp_date', 'trim|required|min_length[3]|xss_clean');
			$this->form_validation->set_rules('exp_date', 'to_date', 'trim|required|min_length[3]|xss_clean');
			if($offer_for!="Hotel"){
			$this->form_validation->set_rules('txtprovider', 'txtprovider', 'trim|required|xss_clean');  
        	$this->form_validation->set_rules('txtoffertype', 'txtoffertype', 'trim|required|xss_clean');  
        	$this->form_validation->set_rules('destination', 'destination', 'trim|required|min_length[3]|xss_clean'); 
        	$this->form_validation->set_rules('airline_list', 'airline_list', 'required|xss_clean');
        }
        	$this->form_validation->set_rules('aboutcity', 'aboutcity', 'required|xss_clean');
        	
        	
        	
        	
			if($this->input->post('offersub')=='submit'){
				
			if($this->form_validation->run() == true){
				
				
				if(is_array($_FILES) == true && $_FILES['file']['error'] == 0 && $_FILES['file']['size'] > 0) {
				$config['upload_path']='../uploads/discount_small_image';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '1000';
				$config['max_width']  = '';
				$config['max_height']  = '';
				$config['remove_spaces']  = false;
							
			
												
				$this->load->library('upload', $config);
				if (! $this->upload->do_upload('file')) {
					echo $this->upload->display_errors();
				}else{
						$image_data =  $this->upload->data();
						//print_r($image_data);
					 $new_filename=time().$image_data['file_ext'];
					rename($image_data['full_path'],$image_data['file_path'].$new_filename);
				
				}
							
			}else{
				$new_filename=$old_file;
			}
			
			
			if(is_array($_FILES) == true && is_array($_FILES['bannerfile']['error']) && is_array($_FILES['bannerfile']['size'])) {
				
			
				$new_filename1=array();
				$cc=count($_FILES['bannerfile']['name']);
				for($i=0; $i<$cc; $i++) {
  
					$tmpFilePath = $_FILES['bannerfile']['tmp_name'][$i];

					if ($tmpFilePath != ""){
    
						 $newFilePath = "../uploads/discount_banner_image/".$_FILES['bannerfile']['name'][$i];

    
						if(move_uploaded_file($tmpFilePath, $newFilePath)) {

                             $banner_new_filename=time().rand(10, 9999999).'.'. pathinfo($newFilePath, PATHINFO_EXTENSION);
                             $new_filename1[] =$banner_new_filename;
							 rename($newFilePath,"../uploads/discount_banner_image/".$banner_new_filename);

						} 
					}
				}
				
					
			}
			
			if($id!=''){
				   $date_text='mod_date';
					}else{
						$date_text='add_date';
					}
					
			$airline_code='';
			$airline_code=implode(",", $airline_list);
			
			$data=array(
				   'offer_for'=>$offer_for,
				    'origin'=>$origin,
				   'destination'=>$destination,
				   'price'=>$price,
				   'airline_code'=>(($airline_code!='')?$airline_code:''),
				   'to_date'=>$to_date,
				   'exp_date'=>$exp_date,
				   'provider'=>$provider,
				   'type'=>$type,
					'short_desc'=>$short_desc,
					'aboutcity'=>$about_city,
					"$date_text"=>date("Y-m-d H:i:s"),
				   'small_image'=>$new_filename
				);
				if($id!=''){
				$this->db->where('id', $id);
				$this->db->update('discounted_flights', $data); 
				$flight_id=$id;
				//echo $this->db->last_query();exit;
			}else{
				$this->db->insert('discounted_flights', $data);
				$flight_id=$this->db->insert_id();
			}
				
				
								
				if(is_array($_FILES) == true && is_array($_FILES['bannerfile']['error']) && is_array($_FILES['bannerfile']['size'])) {
					
					foreach($new_filename1 as $v){
						$data=array(
						    'flight_id'=>$flight_id,
						    'image'=>$v,
						    'add_date'=>date("Y-m-d H:i:s")
						);
					$this->db->insert('discounted_flight_images', $data); 
					}
					
				}
				redirect('discount/');
			}else{
				
				$data['err_msg']="Marked fields are mandatory";
			}
			
		}
		if($id!=''){
			$data['offer_details'] = $this->Discount_Model->get_offer_details($id);
			$data['offer_images'] = $this->Discount_Model->get_offer_images($id);
		}
		    $data['airline_list']=$this->Discount_Model->get_airline_list();
			$data['airports'] = $this->Discount_Model->get_airport_list();
			$this->load->view('discount/add_new_offer',$data);
		}else{
		 redirect('login/index');
		}	
	}
	public function delete_discount_img($imgid,$offerid){
		$res = $this->Discount_Model->delete_discount_img($imgid);
		if($res){
			redirect('discount/add_new_offer/'.$offerid,'refresh');
		}
	}

	
	
	public function isDetailsExists($date){
		
		
		$exists = $this->Discount_Model->isDetailsExists($date);
		if($exists){
			$response = array('s'=>'Sorry Dear, This Flight Details already exists please try anothere','status'=>0);
		}else{
			$response = array('s'=>'Flight Details available','status'=>1);
		}
		echo json_encode($response);
	}
	
	
	
	
	
	public function delete($id){
		$res = $this->Discount_Model->delete($id);
		if($res){
			redirect('discount/','refresh');
		}
	}
	
	public function updateStatus($id,$value){
		$status = array('status'=>$value);
		$res = $this->Discount_Model->updateStatus($id,$status);
		if($res){
			redirect('discount/','refresh');
		}
	}
	public function uniqueLabel($string) {
		//Lower case everything
		$string = strtolower($string);
		//Make alphanumeric (removes all other characters)
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		//Clean up multiple dashes or whitespaces
		$string = preg_replace("/[\s-]+/", " ", $string);
		//Convert whitespaces and underscore to dash
		$string = preg_replace("/[\s_]/", "-", $string);
		return $string;
	}
	
	
}
?>
