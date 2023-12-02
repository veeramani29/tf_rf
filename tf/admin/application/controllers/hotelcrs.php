	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotelcrs extends CI_Controller {

	public function __construct(){
      parent::__construct();
	  $this->load->database(); 
	  $this->load->library('upload');	

	  
	  // $this->check_isvalidated();	
      $this->load->library('form_validation','session');
      //$this->load->helper('csv');  
	  $this->load->dbutil();
     
	
	  $this->load->model('Hotelcrs_model');
	
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
		
		if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in') && ! $this->session->userdata('supplier_logged_in'))
	   {
		       redirect('login/index');
      }
	   }
 

    function index(){
    	
    	if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in') && ! $this->session->userdata('supplier_logged_in'))
	   {
		       redirect('login/index');
      }
      else{
     $data['result_view']=$this->Hotelcrs_model->view_all_hotels();
     $data['id']='admin';
    	$this->load->view('hotel_crs/view', $data);
    } }
 
     function add_hotel(){
     	if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in')){
		       redirect('login/index');
      } else{
           $data['citylist'] = $this->Hotelcrs_model->fetch_city_list()->result();
           $data['amenites'] = $this->Hotelcrs_model->fetch_amenities_list()->result();
           //echo '<pre>';print_r($data['citylist']);die;
           $data['country_list'] = $this->Hotelcrs_model->fetch_country_list();
    	     $this->load->view('hotel_crs/add_hotel', $data);
      }
     }
    
    
    function delete_hotel_ad($supid,$id)
    {
        $this->Hotelcrs_model->delete_hotel($supid,$id); 
        redirect("hotelcrs/index",'refresh');
    }
	
	function get_city()
	{
		$country = $_REQUEST['country_id'];		
		$city_list = $this->Hotelcrs_model->fetch_city_list_by_country($country);
		
		$html = '';
		if(!empty($city_list))
		{			
			$html .= '<option value="">Select</option>';
			foreach($city_list as $key => $value)
			{
				$html .= '<option value="'.$value->city_name.'">'.$value->city_name.'</option>';
			}
		}
		
		$json = array('city_list' => $html);
		echo json_encode($json);
	}
	
 	function get_hotels()
	{
		$city = $_REQUEST['city_id'];
		$hotel_list = $this->Hotelcrs_model->fetch_hotels($city);
		
		$html = '';
		if(!empty($hotel_list))
		{			
			$html .= '<option value="">Select</option>';
			foreach($hotel_list as $key => $value)
			{
				$html .= '<option value="'.$value->hotel_name.'">'.$value->hotel_name.'</option>';
			}
		}
		
		$json = array('hotel_list' => $html);
		echo json_encode($json);
	}
	
    
    
    // ADD HOTEL
    	function add_data($sup_id){      
       // PRINT_R($sup_id);EXIT;
        $this->form_validation->set_rules('pro_name', 'Hotel Name', 'required');
        $anotherval='';
        
        if($this->input->post('pro_name') == ''){
			     $pro_name = $this->input->post('hotel');
           $hotel_chain_name = substr(chop(substr($this->input->post('country_val'), -5), ')'), -3);
           $city_country = $this->Hotelcrs_model->get_city_country($this->input->post('city'),$this->input->post('country'));
			     $cityval = $city_country->city;
		    }else{
			     if($this->input->post('country_val')==''){				
				      $cityval = $this->input->post('ancity').','.$this->input->post('ancountry');
				      //$this->Hotelcrs_model->add_hotel_city($this->input->post('ancity'),$this->input->post('ancountry'));				
			     }else{
				      $cityval = $this->input->post('country_val');
			  }
			     $pro_name = $this->input->post('pro_name');
           $hotel_chain_name = substr(chop(substr($this->input->post('country_val'), -5), ')'), -3);
		  }	
        
     
            
            $city = $cityval;
        	$main_first_name = $this->input->post('main_first_name');
            $main_last_name = $this->input->post('main_last_name');
            $main_email = $this->input->post('main_email');
            $star=$this->input->post('hotel_star');
            $hotel_address = $this->input->post('hotel_address');
		   $main_phone = $this->input->post('main_phone');
		   $main_fax = $this->input->post('main_fax');
		 
		   $hotel_desc  = $this->input->post('hotel_desc');
		   $hotel_policy = $this->input->post('hotel_policy');
		   $nearby_airport = $this->input->post('nearby_area');
		   $nearby_attraction = $this->input->post('nearby_attraction');
		   $latitude = $this->input->post('latitude');
		   $longitude = $this->input->post('longitude');
       $amenities = $this->input->post('amenity');

       
		   
		  $rs_status=$this->Hotelcrs_model->add_contact_inf($sup_id,$star, $city, $pro_name, $main_first_name, $main_last_name, $main_email, $hotel_chain_name,$hotel_address,$main_phone,$main_fax,$hotel_desc,$nearby_attraction,$nearby_airport,$latitude,$longitude);             

      if(!empty($amenities)){
        //echo '<pre>';print_r($amenities);die; 
        foreach ($amenities as $key => $amenity) {
          $amenity_data = array(
            'hotel_id' => $rs_status,
            'amenity_id' => $amenity
          );
          //echo '<pre>';print_r($amenity_data);die; 
          $this->Hotelcrs_model->add_amenities($amenity_data);
        }
      }

        redirect('hotelcrs/index/'.$sup_id,'refresh');
         
    }
    
    
    // For Status Change
    
      function update_all_hotel_status($sup_id,$id,$status)
    {
      	if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in') && ! $this->session->userdata('supplier_logged_in')){
		       redirect('login/index');
      } else{
		  if($this->session->userdata('supplier_logged_in'))
		  {
			 $hotel_check =  $this->Hotelcrs_model->validate_hotel($sup_id,$id);
			  if($sup_id == $this->session->userdata('supplier_id') && $hotel_check=='1')
			  {
				$this->Hotelcrs_model->update_hotel_status($id,$status);
				redirect('hotelcrs/index/'.$sup_id,'refresh');
			  }
			  else
			  {
				  redirect('hotelcrs/index/'.$sup_id,'refresh');
			  }
		  }
		  else
		  {
			   $this->Hotelcrs_model->update_hotel_status($id,$status);
       		   redirect('hotelcrs/index/'.$sup_id,'refresh');
		  }
	  }
    }
    
    
    
    // EDIT HOTEL
  function edit_hotel_ad($supplier_id,$property_id='')
    {
    	
	if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in') && ! $this->session->userdata('supplier_logged_in'))
	   {
		       redirect('login/index');
      } else{
		  
	
	 if($this->session->userdata('supplier_logged_in'))
		  {
			 $hotel_check =  $this->Hotelcrs_model->validate_hotel($supplier_id,$property_id);
			  if($supplier_id == $this->session->userdata('supplier_id') && $hotel_check=='1')
			  {		  
		  
	
		  
		  
   
        $supplier_id=$this->uri->segment(3);
        $property_id=$this->uri->segment(4);
        $data['time_zone']=$this->Hotelcrs_model->fetch_time_zone();
        $data['currency']=$this->Hotelcrs_model->fetch_currency_val();
        $data['contact_inf']=$this->Hotelcrs_model->contact_inform_edit($supplier_id,$property_id);
        $data['prop_inf']=$this->Hotelcrs_model->contact_prop_edit($supplier_id, $property_id);
        //$data['country_list']=$this->Hotelcrs_model->fetch_country();
        $data['amenites'] = $this->Hotelcrs_model->fetch_amenities_list()->result();
        $am = $this->Hotelcrs_model->get_hotel_amenities($property_id)->result_array();
        //$data['language_list']=$this->Hotelcrs_model->fetch_language();
        //$data['facility_iist']= $this->Hotelcrs_model->fetch_home_facility($property_id);
        //$data['room_fac_list'] = $this->Hotelcrs_model->fetch_room_facility($property_id);
        $data['result']=$this->Hotelcrs_model->get_settings_val($property_id);
        $data['citylist'] = $this->Hotelcrs_model->fetch_city_list();
        $ame = array();
        foreach ($am as $key => $value) {
          $ame[] = $value['amenity_id'];
        }
        $data['ame'] = $ame;
        //echo '<pre>';print_r($data['ame']);die; 
        $prop_id=$property_id;
        if(isset($prop_id) && $prop_id!= "")    
        {   
            $data['result1'] = $this->Hotelcrs_model->detail_location($prop_id);
            //echo $result1[0]->sup_detailedlocation_id;
            $this->load->view('hotel_crs/edit_hotel_ad',$data);
        }
        else
        {
            $this->load->view('hotel_crs/edit_hotel_ad');
        }
    
	
	
			  }
			  else
			  {
				  redirect('hotelcrs','refresh');
			  }
		  }
		  else
		  {
			  
	
		  
		  
   
        $supplier_id=$this->uri->segment(3);
        $property_id=$this->uri->segment(4);
        $data['time_zone']=$this->Hotelcrs_model->fetch_time_zone();
        $data['currency']=$this->Hotelcrs_model->fetch_currency_val();
        $data['contact_inf']=$this->Hotelcrs_model->contact_inform_edit($supplier_id,$property_id);
        $data['prop_inf']=$this->Hotelcrs_model->contact_prop_edit($supplier_id, $property_id);
        //$data['country_list']=$this->Hotelcrs_model->fetch_country();
        $data['amenites'] = $this->Hotelcrs_model->fetch_amenities_list()->result();
        $am = $this->Hotelcrs_model->get_hotel_amenities($property_id)->result_array();
        //$data['language_list']=$this->Hotelcrs_model->fetch_language();
        //$data['facility_iist']= $this->Hotelcrs_model->fetch_home_facility($property_id);
        //$data['room_fac_list'] = $this->Hotelcrs_model->fetch_room_facility($property_id);
        $data['result']=$this->Hotelcrs_model->get_settings_val($property_id);
        $data['citylist'] = $this->Hotelcrs_model->fetch_city_list();
        $ame = array();
        foreach ($am as $key => $value) {
          $ame[] = $value['amenity_id'];
        }
        $data['ame'] = $ame;
        //echo '<pre>';print_r($data['ame']);die; 
        $prop_id=$property_id;
        if(isset($prop_id) && $prop_id!= "")    
        {   
            $data['result1'] = $this->Hotelcrs_model->detail_location($prop_id);
            //echo $result1[0]->sup_detailedlocation_id;
            $this->load->view('hotel_crs/edit_hotel_ad',$data);
        }
        else
        {
            $this->load->view('hotel_crs/edit_hotel_ad');
        }
    
	
	
		  }
	
	
	}
    }
    
    //UPDATE HOTEL
       function update_hotel($supid, $id)
    {
       
        //$supplier_id=$this->session->userdata('supplier_id');
        $supplier_id=$supid;
        $id=$id;
          if($this->session->userdata('supplier_logged_in'))
		  {
				
			  if($supid == $this->session->userdata('supplier_id'))
			  {
				  	
        $sup_prop_id1=$this->session->set_userdata($id);
        $hotel_chain_name = substr(chop(substr($this->input->post('country_val'), -5), ')'), -3);
        $data = array(
                        "hotel_name" => $this->input->post('pro_name'),
                        "hotel_chain_name" => $hotel_chain_name,
                        "city" => $this->input->post('country_val'),

                        "main_first_name" => $this->input->post('main_first_name'),
                        "main_last_name" => $this->input->post('main_last_name'),
                        "main_email" => $this->input->post('main_email'),
                       
                        "res_phone" => $this->input->post('main_phone'),
                        "res_fax" => $this->input->post('main_fax'),
                        "star" => $this->input->post('hotel_star'),
                        "address" =>    $this->input->post('hotel_address'),
                        "descrip" => $this->input->post('hotel_desc'),
                        "nearby_airport" => $this->input->post('nearby_area'),
                        "nearby_placeinterest" =>  $this->input->post('nearby_attraction'),
                        "latitude" => $this->input->post('latitude'),
                        "longitude" => $this->input->post('longitude')
                      
                    );
					
        $amenities = $this->input->post('amenity');
        $this->Hotelcrs_model->update_contact_info($data,$supplier_id,$id);
        $this->Hotelcrs_model->clear_amenities($id);
        if(!empty($amenities)){
        //echo '<pre>';print_r($amenities);die; 
          foreach ($amenities as $key => $amenity) {
            $amenity_data = array(
              'hotel_id' => $id,
              'amenity_id' => $amenity
            );
            //echo '<pre>';print_r($amenity_data);die; 
            $this->Hotelcrs_model->add_amenities($amenity_data);
          }
        }
			  
			  }
			  else
			  {
				  redirect("hotelcrs",'refresh');
			  }
		  }
		  else
		  {
					
        $sup_prop_id1=$this->session->set_userdata($id);
        $hotel_chain_name = substr(chop(substr($this->input->post('country_val'), -5), ')'), -3);
        $data = array(
                        "hotel_name" => $this->input->post('pro_name'),
                        "hotel_chain_name" => $hotel_chain_name,
                        "city" => $this->input->post('country_val'),

                        "main_first_name" => $this->input->post('main_first_name'),
                        "main_last_name" => $this->input->post('main_last_name'),
                        "main_email" => $this->input->post('main_email'),
                       
                        "res_phone" => $this->input->post('main_phone'),
                        "res_fax" => $this->input->post('main_fax'),
                        "star" => $this->input->post('hotel_star'),
                        "address" =>    $this->input->post('hotel_address'),
                        "descrip" => $this->input->post('hotel_desc'),
                        "nearby_airport" => $this->input->post('nearby_area'),
                        "nearby_placeinterest" =>  $this->input->post('nearby_attraction'),
                        "latitude" => $this->input->post('latitude'),
                        "longitude" => $this->input->post('longitude'),
                      
                    );
        $amenities = $this->input->post('amenity');
        $this->Hotelcrs_model->update_contact_info($data,$supplier_id,$id);
        $this->Hotelcrs_model->clear_amenities($id);
        if(!empty($amenities)){
        //echo '<pre>';print_r($amenities);die; 
          foreach ($amenities as $key => $amenity) {
            $amenity_data = array(
              'hotel_id' => $id,
              'amenity_id' => $amenity
            );
            //echo '<pre>';print_r($amenity_data);die; 
            $this->Hotelcrs_model->add_amenities($amenity_data);
          }
        }
			  
		  }
	
//        redirect("hotelcrs/index/$supplier_id",'refresh');
        redirect("hotelcrs",'refresh');
    }

 // Function for Room Types

    function pricing($supplier_id='',$hotel_id='',$room_id=''){
      if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in') && ! $this->session->userdata('supplier_logged_in')){
           redirect('login/index');
      } else{
        if($supplier_id != '' && $hotel_id != ''){
			
			 if($this->session->userdata('supplier_logged_in'))
		  {
			 $hotel_check =  $this->Hotelcrs_model->validate_hotel($supplier_id,$hotel_id);
			  if($supplier_id == $this->session->userdata('supplier_id') && $hotel_check=='1')
			  {	
			  
			
			
          $data['supplier_id'] = $supplier_id;
          $data['hotel_id'] = $hotel_id;
          $data['room_id'] = $room_id;
          $data['hotel_data'] = $this->Hotelcrs_model->view_all_hotels_by_id($hotel_id);  
          //echo '<pre>';print_r($data['hotel_data']);die;
           $data['pricings'] = $this->Hotelcrs_model->get_all_pricings($room_id)->result(); 
           $data['pricings_s'] = $this->Hotelcrs_model->get_all_pricings_specific($room_id)->result();        
           $data['pricings'] = array_merge($data['pricings'],$data['pricings_s']);
          // $data['all_hotels']=$this->Hotelcrs_model->view_all_hotels(); 
           //echo '<pre>';print_r($data['pricings']);die;
          $this->load->view('hotel_crs/pricing',$data);
        
			  }
			  else
			  {
				  redirect("hotelcrs",'refresh'); 
			  }
		  }else
		  {
			  
          $data['supplier_id'] = $supplier_id;
          $data['hotel_id'] = $hotel_id;
          $data['room_id'] = $room_id;
          $data['hotel_data'] = $this->Hotelcrs_model->view_all_hotels_by_id($hotel_id);  
          //echo '<pre>';print_r($data['hotel_data']);die;
           $data['pricings'] = $this->Hotelcrs_model->get_all_pricings($room_id)->result(); 
           $data['pricings_s'] = $this->Hotelcrs_model->get_all_pricings_specific($room_id)->result();        
           $data['pricings'] = array_merge($data['pricings'],$data['pricings_s']);
          // $data['all_hotels']=$this->Hotelcrs_model->view_all_hotels(); 
           //echo '<pre>';print_r($data['pricings']);die;
          $this->load->view('hotel_crs/pricing',$data);
        
		  }
		
		}else{
          redirect("hotelcrs",'refresh');
        }
      }
    }

    function del_price($supplier_id='',$hotel_id='',$room_id='',$price_id='',$type=''){
		
		 if($this->session->userdata('supplier_logged_in'))
		  {
			 $hotel_check =  $this->Hotelcrs_model->validate_hotel($supplier_id,$hotel_id);
			  if($supplier_id == $this->session->userdata('supplier_id') && $hotel_check=='1')
			  {	
      if($type == 'Period'){
        $this->Hotelcrs_model->del_price($price_id);  
      }else if($type == 'Specific'){
        $this->Hotelcrs_model->del_price_specific($price_id);  
      }
			  }
			  else
			  {
				  redirect('hotelcrs/pricing/'.$supplier_id.'/'.$hotel_id.'/'.$room_id, 'refresh');
			  }
		  }else
		  {
			  if($type == 'Period'){
        $this->Hotelcrs_model->del_price($price_id);  
      }else if($type == 'Specific'){
        $this->Hotelcrs_model->del_price_specific($price_id);  
      } 
		  }
      redirect('hotelcrs/pricing/'.$supplier_id.'/'.$hotel_id.'/'.$room_id, 'refresh');
      
    }

    function addPrice($supplier_id='',$hotel_id='',$room_id=''){
      if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in') && ! $this->session->userdata('supplier_logged_in')){
           redirect('login/index');
      } else{
        if($supplier_id != '' && $hotel_id != '' && $room_id != ''){
		 if($this->session->userdata('supplier_logged_in'))
		  {
			 $hotel_check =  $this->Hotelcrs_model->validate_hotel($supplier_id,$hotel_id);
			  if($supplier_id == $this->session->userdata('supplier_id') && $hotel_check=='1')
			  {		
			
			
          $data['supplier_id'] = $supplier_id;
          $data['hotel_id'] = $hotel_id;
          $data['room_id'] = $room_id;
          $data['hotel_data'] = $this->Hotelcrs_model->view_all_hotels_by_id($hotel_id);  
          //echo '<pre>';print_r($data['hotel_data']);die;
          $data['result']=$this->Hotelcrs_model->get_all_hotel_facility();        
          $data['all_hotels']=$this->Hotelcrs_model->view_all_hotels(); 
          $this->load->view('hotel_crs/addPrice',$data);
        
		
			  }
			  else
			  {
				   redirect("hotelcrs",'refresh');
			  }
		  }
		  else
		  {
			  
          $data['supplier_id'] = $supplier_id;
          $data['hotel_id'] = $hotel_id;
          $data['room_id'] = $room_id;
          $data['hotel_data'] = $this->Hotelcrs_model->view_all_hotels_by_id($hotel_id);  
          //echo '<pre>';print_r($data['hotel_data']);die;
          $data['result']=$this->Hotelcrs_model->get_all_hotel_facility();        
          $data['all_hotels']=$this->Hotelcrs_model->view_all_hotels(); 
          $this->load->view('hotel_crs/addPrice',$data);
        
		  }
		}else{
          redirect("hotelcrs",'refresh');
        }
      }
    }


    function add_price_details($supplier_id='',$hotel_id='',$room_id=''){
		
		 if($this->session->userdata('supplier_logged_in'))
		  {
			 $hotel_check =  $this->Hotelcrs_model->validate_hotel($supplier_id,$hotel_id);
			  if($supplier_id == $this->session->userdata('supplier_id') && $hotel_check=='1')
			  {	
      $var = $this->input->post();
      $price_data = array(
        'room_id' => $room_id,
        'type' => 'Period',
        'from' => $this->input->post('daterange_start'),
        'to' => $this->input->post('daterange_end'),
        'per_adult' => $this->input->post('aPrice')
      );
      $price_id = $this->Hotelcrs_model->add_room_pricing($price_data);
      if(isset($var['adt'])){
        foreach ($var['adt'] as $key => $value) {
          $adt_data = array(
            'room_id' => $room_id,
            'price_id' => $price_id,
            'type' => 'Period',
            'from' => $this->input->post('daterange_start'),
            'to' => $this->input->post('daterange_end'),
            'adult' => $value,
            'price' => $var['adt_price'][$key]
          );
          $this->Hotelcrs_model->add_room_adt_pricing($adt_data);
          //echo '<pre>';print_r($adt_data);die;
        }
      }
			  }
			  else
			  {
				    redirect('hotelcrs/pricing/'.$supplier_id.'/'.$hotel_id.'/'.$room_id, 'refresh');
			  }
		  }
		  else
		  {
			   $var = $this->input->post();
      $price_data = array(
        'room_id' => $room_id,
        'type' => 'Period',
        'from' => $this->input->post('daterange_start'),
        'to' => $this->input->post('daterange_end'),
        'per_adult' => $this->input->post('aPrice')
      );
      $price_id = $this->Hotelcrs_model->add_room_pricing($price_data);
      if(isset($var['adt'])){
        foreach ($var['adt'] as $key => $value) {
          $adt_data = array(
            'room_id' => $room_id,
            'price_id' => $price_id,
            'type' => 'Period',
            'from' => $this->input->post('daterange_start'),
            'to' => $this->input->post('daterange_end'),
            'adult' => $value,
            'price' => $var['adt_price'][$key]
          );
          $this->Hotelcrs_model->add_room_adt_pricing($adt_data);
          //echo '<pre>';print_r($adt_data);die;
        }
      }
		  }
      redirect('hotelcrs/pricing/'.$supplier_id.'/'.$hotel_id.'/'.$room_id, 'refresh');
      
    }

    function add_price_specific($supplier_id='',$hotel_id='',$room_id=''){
      if($this->session->userdata('supplier_logged_in'))
		  {
			 $hotel_check =  $this->Hotelcrs_model->validate_hotel($supplier_id,$hotel_id);
			  if($supplier_id == $this->session->userdata('supplier_id') && $hotel_check=='1')
			  {	
	 
	  $var = $this->input->post();
      $price_data = array(
        'room_id' => $room_id,
        'type' => 'Specific',
        'from' => $this->input->post('daterange_start'),
        'to' => $this->input->post('daterange_end'),
        'per_adult' => $this->input->post('aPrice')
      );
      $price_id = $this->Hotelcrs_model->add_room_pricing_specific($price_data);
      if(isset($var['adt'])){
        foreach ($var['adt'] as $key => $value) {
          $adt_data = array(
            'room_id' => $room_id,
            'price_id' => $price_id,
            'type' => 'Specific',
            'from' => $this->input->post('daterange_start'),
            'to' => $this->input->post('daterange_end'),
            'adult' => $value,
            'price' => $var['adt_price'][$key]
          );
          $this->Hotelcrs_model->add_room_adt_pricing_specific($adt_data);
          //echo '<pre>';print_r($adt_data);die;
        }
      }
			  }
			  else
			  {
				   redirect('hotelcrs/pricing/'.$supplier_id.'/'.$hotel_id.'/'.$room_id, 'refresh');
			  }
		  }
		  else
		  {
			   $var = $this->input->post();
      $price_data = array(
        'room_id' => $room_id,
        'type' => 'Specific',
        'from' => $this->input->post('daterange_start'),
        'to' => $this->input->post('daterange_end'),
        'per_adult' => $this->input->post('aPrice')
      );
      $price_id = $this->Hotelcrs_model->add_room_pricing_specific($price_data);
      if(isset($var['adt'])){
        foreach ($var['adt'] as $key => $value) {
          $adt_data = array(
            'room_id' => $room_id,
            'price_id' => $price_id,
            'type' => 'Specific',
            'from' => $this->input->post('daterange_start'),
            'to' => $this->input->post('daterange_end'),
            'adult' => $value,
            'price' => $var['adt_price'][$key]
          );
          $this->Hotelcrs_model->add_room_adt_pricing_specific($adt_data);
          //echo '<pre>';print_r($adt_data);die;
        }
      }
		  }
      redirect('hotelcrs/pricing/'.$supplier_id.'/'.$hotel_id.'/'.$room_id, 'refresh');
      
    }

    public function get_hotel_city_suggestions() {
        ini_set('memory_limit', '-1');
        $term = $this->input->get('term'); //retrieve the search term that autocomplete sends
        $term = trim(strip_tags($term));
        $hotels = $this->Hotelcrs_model->get_hotels_list($term);
        $result = array();

        foreach ($hotels as $hotel) {
            $apts['label'] = $hotel->CITY . ', ' . $hotel->COUNTRY_NAME ;
            $apts['value'] = ' ' . $hotel->CITY. ', ' . $hotel->COUNTRY_NAME . '  - ' . $hotel->IATA_CODES;
            $apts['id'] = $hotel->ID;
            $result[] = $apts;
        }
        //print_r($result);
        echo json_encode($result); //format the array into json data
    }
 
    function gallery($supplier_id='',$hotel_id=''){
      if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in') && ! $this->session->userdata('supplier_logged_in')){
           redirect('login/index');
      } else{
        if($supplier_id != '' && $hotel_id != ''){
			 if($this->session->userdata('supplier_logged_in'))
		  {
			 $hotel_check =  $this->Hotelcrs_model->validate_hotel($supplier_id,$hotel_id);
			  if($supplier_id == $this->session->userdata('supplier_id') && $hotel_check=='1')
			  {	
			
          $data['supplier_id'] = $supplier_id;
          $data['hotel_id'] = $hotel_id;
          $data['hotel_data'] = $this->Hotelcrs_model->view_all_hotels_by_id($hotel_id);
          $data['images'] = $this->Hotelcrs_model->get_images($hotel_id)->result();  
          //echo '<pre>';print_r($data['hotel_data']);die;
          $this->load->view('hotel_crs/gallery',$data);
        
			  }
			  else
			  {
				     redirect("hotelcrs",'refresh');
			  }
		  }
		  else
		  {
			 
          $data['supplier_id'] = $supplier_id;
          $data['hotel_id'] = $hotel_id;
          $data['hotel_data'] = $this->Hotelcrs_model->view_all_hotels_by_id($hotel_id);
          $data['images'] = $this->Hotelcrs_model->get_images($hotel_id)->result();  
          //echo '<pre>';print_r($data['hotel_data']);die;
          $this->load->view('hotel_crs/gallery',$data);
         
		  }
		}else{
          redirect("hotelcrs",'refresh');
        }
      }
    }

    function add_gallery($supplier_id='',$hotel_id=''){
      if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in') && ! $this->session->userdata('supplier_logged_in')){
           redirect('login/index');
      } else{
        if($supplier_id != '' && $hotel_id != ''){
		 if($this->session->userdata('supplier_logged_in'))
		  {
			 $hotel_check =  $this->Hotelcrs_model->validate_hotel($supplier_id,$hotel_id);
			  if($supplier_id == $this->session->userdata('supplier_id') && $hotel_check=='1')
			  {	
			
			
          $data['supplier_id'] = $supplier_id;
          $data['hotel_id'] = $hotel_id;
          $data['hotel_data'] = $this->Hotelcrs_model->view_all_hotels_by_id($hotel_id);  
          //echo '<pre>';print_r($data['hotel_data']);die;
          $data['result']=$this->Hotelcrs_model->get_all_hotel_facility();        
          $data['all_hotels']=$this->Hotelcrs_model->view_all_hotels(); 
          $this->load->view('hotel_crs/add_gallery',$data);
        
			  }
			  else
			  {
				   redirect("hotelcrs",'refresh');
			  }
		  }
		  else
		  {
			
          $data['supplier_id'] = $supplier_id;
          $data['hotel_id'] = $hotel_id;
          $data['hotel_data'] = $this->Hotelcrs_model->view_all_hotels_by_id($hotel_id);  
          //echo '<pre>';print_r($data['hotel_data']);die;
          $data['result']=$this->Hotelcrs_model->get_all_hotel_facility();        
          $data['all_hotels']=$this->Hotelcrs_model->view_all_hotels(); 
          $this->load->view('hotel_crs/add_gallery',$data);
          
		  }
		
		}else{
          redirect("hotelcrs",'refresh');
        }
      }
    }

    function upload_gallery($supplier_id='',$hotel_id=''){
		 if($this->session->userdata('supplier_logged_in'))
		  {
			 $hotel_check =  $this->Hotelcrs_model->validate_hotel($supplier_id,$hotel_id);
			  if($supplier_id == $this->session->userdata('supplier_id') && $hotel_check=='1')
			  {	
      $data['supplier_id'] = $supplier_id;
      $data['hotel_id'] = $hotel_id;
      $this->hotel_id = $hotel_id;
      $params = array('hotel_id' => $hotel_id);
      $this->load->library('UploadHandler', $params); 
			  }
			  else
			  {
				  
			  }
		  }
		  else
		  {
			   $data['supplier_id'] = $supplier_id;
      $data['hotel_id'] = $hotel_id;
      $this->hotel_id = $hotel_id;
      $params = array('hotel_id' => $hotel_id);
      $this->load->library('UploadHandler', $params); 
		  }
      //echo '<pre>';print_r($this->UploadHandler->image);die;
    }

    function del_hotel_img($supplier_id='',$hotel_id='',$img_id=''){
		 if($this->session->userdata('supplier_logged_in'))
		  {
			 $hotel_check =  $this->Hotelcrs_model->validate_hotel($supplier_id,$hotel_id);
			  if($supplier_id == $this->session->userdata('supplier_id') && $hotel_check=='1')
			  {	
      $this->Hotelcrs_model->del_hotel_img($img_id); 
      redirect('hotelcrs/gallery/'.$supplier_id.'/'.$hotel_id, 'refresh');
			  }
			  else
			  {
				     redirect('hotelcrs/gallery/'.$supplier_id.'/'.$hotel_id, 'refresh');
	
			  }
		  }
		  else
		  {
			 $this->Hotelcrs_model->del_hotel_img($img_id); 
      redirect('hotelcrs/gallery/'.$supplier_id.'/'.$hotel_id, 'refresh');
	  
		  }
    }

   function room_type_list($supplier_id='',$hotel_id=''){
    	if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in') && ! $this->session->userdata('supplier_logged_in')){
		       redirect('login/index');
      } else{
        if($supplier_id != '' && $hotel_id != ''){
		 if($this->session->userdata('supplier_logged_in'))
		  {
			 $hotel_check =  $this->Hotelcrs_model->validate_hotel($supplier_id,$hotel_id);
			  if($supplier_id == $this->session->userdata('supplier_id') && $hotel_check=='1')
			  {	
			
				
          $data['supplier_id'] = $supplier_id;
          $data['hotel_id'] = $hotel_id;
          $data['hotel_data'] = $this->Hotelcrs_model->view_all_hotels_by_id($hotel_id);  
		  
          //echo '<pre>';print_r($data['hotel_data']);die;
          $data['hotel_rooms'] = $this->Hotelcrs_model->room_list($hotel_id)->result();   
  		  $this->load->view('hotel_crs/room_type_list',$data);
        
		
			  }
			   else
				  {
					   redirect("hotelcrs",'refresh');
				  }
		  }
		  else
		  {
				  
          $data['supplier_id'] = $supplier_id;
          $data['hotel_id'] = $hotel_id;
          $data['hotel_data'] = $this->Hotelcrs_model->view_all_hotels_by_id($hotel_id);  
          //echo '<pre>';print_r($data['hotel_data']);die;
          $data['hotel_rooms'] = $this->Hotelcrs_model->room_list($hotel_id)->result();   
  		    $this->load->view('hotel_crs/room_type_list',$data);
        
		  }
		
		}else{
          redirect("hotelcrs",'refresh');
        }
	    }
	 }


	
	
		function add_room_type($supplier_id='',$hotel_id=''){
      if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in') && ! $this->session->userdata('supplier_logged_in')){
           redirect('login/index');
      } else{
        if($supplier_id != '' && $hotel_id != ''){
          $data['supplier_id'] = $supplier_id;
          $data['hotel_id'] = $hotel_id;
          $data['hotel_data'] = $this->Hotelcrs_model->view_all_hotels_by_id($hotel_id);  
          //echo '<pre>';print_r($data['hotel_data']);die;
          $data['result']=$this->Hotelcrs_model->get_all_hotel_facility();        
          $data['all_hotels']=$this->Hotelcrs_model->view_all_hotels(); 
          $this->load->view('hotel_crs/add_room_type',$data);
        }else{
          redirect("hotelcrs",'refresh');
        }
      }
    }



	function add_room_type_details($supplier_id='',$hotel_id=''){
    if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in') && ! $this->session->userdata('supplier_logged_in')){
      redirect('login/index');
    } else{
      if($supplier_id != '' && $hotel_id != ''){
         $room_name = $this->input->post('room_name');
         $room_desc = $this->input->post('room_desc');
         $cancel_policy = $this->input->post('cancel_policy');
         $cancel_policy_nights = $this->input->post('cancel_policy_nights');
         $cancel_policy_percent = $this->input->post('cancel_policy_percent');


         $target= "upload_files/room_image/";
         move_uploaded_file($_FILES['room_image']['tmp_name'],$target.$_FILES['room_image']['name']);
         $fileimage = $_FILES['room_image']['name'];
         $config['upload_path'] = "upload_files/room_image/";
         $config['allowed_types'] = 'gif|jpeg|png|jpg';
         $config['overwrite'] = TRUE;
         $this->load->library('upload', $config);
         $fileimage = $_FILES['room_image']['name'];

         $room_data = array(
          'hotel_id' => $hotel_id,
          'room_name' => $room_name,
          'room_desc' => $room_desc,
          'room_image' => $fileimage,
          'cancel_policy' => $cancel_policy,
          'cancel_policy_nights' => $cancel_policy_nights,
          'cancel_policy_percent' => $cancel_policy_percent
         );
         //echo '<pre>';print_r($room_data);die;
         $this->Hotelcrs_model->add_hotel_room($room_data);
         redirect('hotelcrs/room_type_list/'.$supplier_id.'/'.$hotel_id, 'refresh');
      }else{
        redirect("hotelcrs",'refresh');
      }
    }
  }


  function update_room($supplier_id='',$hotel_id='',$room_id=''){
    if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in') && ! $this->session->userdata('supplier_logged_in')){
      redirect('login/index');
    } else{
      if($room_id != ''){
		 if($this->session->userdata('supplier_logged_in'))
		  {
			 $hotel_check =  $this->Hotelcrs_model->validate_hotel($supplier_id,$hotel_id);
			  if($supplier_id == $this->session->userdata('supplier_id') && $hotel_check=='1')
			  {	  
		  
		  
         $room_name = $this->input->post('room_name');
         $room_desc = $this->input->post('room_desc');
         $cancel_policy = $this->input->post('cancel_policy');
         $cancel_policy_nights = $this->input->post('cancel_policy_nights');
         $cancel_policy_percent = $this->input->post('cancel_policy_percent');
         $fileimage = $_FILES['room_image']['name'];
         if($fileimage != ''){
             $target= "upload_files/room_image/";
             move_uploaded_file($_FILES['room_image']['tmp_name'],$target.$_FILES['room_image']['name']);
             $fileimage = $_FILES['room_image']['name'];
             $config['upload_path'] = "upload_files/room_image/";
             $config['allowed_types'] = 'gif|jpeg|png|jpg';
             $config['overwrite'] = TRUE;
             $this->load->library('upload', $config);
             $fileimage = $_FILES['room_image']['name'];
         }else{
              $room_data = $this->Hotelcrs_model->get_room_details($room_id)->row();
              $fileimage = $room_data->room_image;
         }
         

         $room_data = array(
          'room_name' => $room_name,
          'room_desc' => $room_desc,
          'room_image' => $fileimage,
          'cancel_policy' => $cancel_policy,
          'cancel_policy_nights' => $cancel_policy_nights,
          'cancel_policy_percent' => $cancel_policy_percent
         );
         //echo '<pre>';print_r($room_data);die;
         $this->Hotelcrs_model->update_hotel_room($room_id,$room_data);
         //die;
         redirect('hotelcrs/room_type_list/'.$supplier_id.'/'.$hotel_id, 'refresh');
      
			  }
			  else
			  {
				   redirect("hotelcrs",'refresh');
			  }
		  }
		  else
		  {
			  
         $room_name = $this->input->post('room_name');
         $room_desc = $this->input->post('room_desc');
         $cancel_policy = $this->input->post('cancel_policy');
         $cancel_policy_nights = $this->input->post('cancel_policy_nights');
         $cancel_policy_percent = $this->input->post('cancel_policy_percent');
         $fileimage = $_FILES['room_image']['name'];
         if($fileimage != ''){
             $target= "upload_files/room_image/";
             move_uploaded_file($_FILES['room_image']['tmp_name'],$target.$_FILES['room_image']['name']);
             $fileimage = $_FILES['room_image']['name'];
             $config['upload_path'] = "upload_files/room_image/";
             $config['allowed_types'] = 'gif|jpeg|png|jpg';
             $config['overwrite'] = TRUE;
             $this->load->library('upload', $config);
             $fileimage = $_FILES['room_image']['name'];
         }else{
              $room_data = $this->Hotelcrs_model->get_room_details($room_id)->row();
              $fileimage = $room_data->room_image;
         }
         

         $room_data = array(
          'room_name' => $room_name,
          'room_desc' => $room_desc,
          'room_image' => $fileimage,
          'cancel_policy' => $cancel_policy,
          'cancel_policy_nights' => $cancel_policy_nights,
          'cancel_policy_percent' => $cancel_policy_percent
         );
         //echo '<pre>';print_r($room_data);die;
         $this->Hotelcrs_model->update_hotel_room($room_id,$room_data);
         //die;
         redirect('hotelcrs/room_type_list/'.$supplier_id.'/'.$hotel_id, 'refresh');
      
		  }
	  }else{
        redirect("hotelcrs",'refresh');
      }
    }
  }
    
    
      function delete_room_type($sup_hotel_room_type_id)
    {
        $result =$this->Hotelcrs_model->delete_room_type($sup_hotel_room_type_id);
        redirect('hotelcrs/room_type_list','refresh');
    }
    
    
     function edit_room_type($supplier_id='',$hotel_id='',$room_id=''){
      if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in') && ! $this->session->userdata('supplier_logged_in')){
           redirect('login/index');
      } else{
        if($supplier_id != '' && $hotel_id != ''){
		
		 if($this->session->userdata('supplier_logged_in'))
		  {
			 $hotel_check =  $this->Hotelcrs_model->validate_hotel($supplier_id,$hotel_id);
			  if($supplier_id == $this->session->userdata('supplier_id') && $hotel_check=='1')
			  {	
			  	
			
          $data['supplier_id'] = $supplier_id;
          $data['hotel_id'] = $hotel_id;
          $data['room_id'] = $room_id;
          $data['hotel_data'] = $this->Hotelcrs_model->view_all_hotels_by_id($hotel_id);  
          //echo '<pre>';print_r($data['hotel_data']);die;
          $data['room_data'] = $this->Hotelcrs_model->get_room_details($room_id)->row();
          $data['all_hotels']=$this->Hotelcrs_model->view_all_hotels();
          $this->load->view('hotel_crs/edit_room_type',$data);
        
		
			  }
			  else
			  {
				  redirect("hotelcrs",'refresh');
			  }
		  }
		  else
		  {
			  
          $data['supplier_id'] = $supplier_id;
          $data['hotel_id'] = $hotel_id;
          $data['room_id'] = $room_id;
          $data['hotel_data'] = $this->Hotelcrs_model->view_all_hotels_by_id($hotel_id);  
          //echo '<pre>';print_r($data['hotel_data']);die;
          $data['room_data'] = $this->Hotelcrs_model->get_room_details($room_id)->row();
          $data['all_hotels']=$this->Hotelcrs_model->view_all_hotels();
          $this->load->view('hotel_crs/edit_room_type',$data);
        
		  }
		}else{
          redirect("hotelcrs",'refresh');
        }
      }
    }

    function del_room_type($supplier_id='',$hotel_id='',$room_id=''){
      if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in') && ! $this->session->userdata('supplier_logged_in')){
           redirect('login/index');
      } else{
        if($supplier_id != '' && $hotel_id != ''){
			 if($this->session->userdata('supplier_logged_in'))
		  {
			 $hotel_check =  $this->Hotelcrs_model->validate_hotel($supplier_id,$hotel_id);
			  if($supplier_id == $this->session->userdata('supplier_id') && $hotel_check=='1')
			  {	
			  
          $this->Hotelcrs_model->delete_hotel_room($room_id);
          redirect('hotelcrs/room_type_list/'.$supplier_id.'/'.$hotel_id,'refresh');
			  }
			  else
			  {
				   redirect('hotelcrs/room_type_list/'.$supplier_id.'/'.$hotel_id,'refresh');
			  }
		  }
		  else
		  {
			  $this->Hotelcrs_model->delete_hotel_room($room_id);
          redirect('hotelcrs/room_type_list/'.$supplier_id.'/'.$hotel_id,'refresh');  
		  }
        }else{
          redirect('hotelcrs/room_type_list/'.$supplier_id.'/'.$hotel_id,'refresh');
        }
      }
    }
    
       function edit_room_type_details($sup_hotel_room_type_id)
    {
            //print_r($_FILES); exit();
            $servicesss=serialize($_POST['facility_name']);
            //print_r($a); 
            //exit();
        if (!$this->session->userdata('sa_logged_in')) {
            redirect('login/admin_login', 'refresh'); 
        }
        
        $this->form_validation->set_rules('hotel_name', 'Hotel Name', 'required');
        $this->form_validation->set_rules('room_type', 'Room Type', 'required');
        $this->form_validation->set_rules('services', 'Services', 'required');
        
        if($this->form_validation->run()==FALSE)
        {
            $this->load->view('hotel_crs/edit_room_type',$sup_hotel_room_type_id);
        }
           
        
        $hotel_name = $this->input->post('hotel_name');
        $room_type = $this->input->post('room_type');
        $services = $servicesss;
        $room_desc = $this->input->post('room_desc');
        $result =$this->Hotelcrs_model->edit_room_type_details($sup_hotel_room_type_id, $hotel_name, $room_type, $services,$room_desc);
       
        redirect('hotelcrs/room_type_list','refresh');
    }
    
    
    
      function capacity_list()
    {
    	if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in') && ! $this->session->userdata('supplier_logged_in'))
	   {
		       redirect('login/index');
      } else {
         $data['result_view']=$this->Hotelcrs_model->capacity_list();
         $this->load->view('hotel_crs/capacity_list',$data);
    }
    }
    
    function add_room_capacity()
    {
    	if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in') && ! $this->session->userdata('supplier_logged_in'))
	   {
		       redirect('login/index');
      } else {
		$data['all_hotels']=$this->Hotelcrs_model->view_all_hotels();
        $this->load->view('hotel_crs/add_room_capacity',$data);
    }
    }
    
      function add_room_capacity_details()
    {	 
        $hotel_name = $this->input->post('hotel_name');
        $capacity_title = $this->input->post('capacity_title');
        $capacity = $this->input->post('capacity');
        $child_capacity = $this->input->post('child_capacity');
        $this->Hotelcrs_model->add_room_capacity_details($hotel_name, $capacity_title, $capacity, $child_capacity);
        redirect('hotelcrs/capacity_list','refresh'); 
    }
    
    
      function delete_capacity($capacity_id)
    {
        $result =$this->Hotelcrs_model->delete_capacity($capacity_id);
        redirect('hotelcrs/capacity_list','refresh');
    }
    
    
     function edit_room_capacity($capacity_id)
    {
    	if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in') && ! $this->session->userdata('supplier_logged_in'))
	   {
		       redirect('login/index');
      } else
      {
        $data['room_capacity'] = $this->Hotelcrs_model->view_room_capacity($capacity_id);
        $data['all_hotels']=$this->Hotelcrs_model->view_all_hotels();
        $data['capacity_id'] = $capacity_id;
        $this->load->view('hotel_crs/edit_room_capacity',$data);
    }
    }
    
    
      function edit_room_capacity_details($capacity_id)
    {
            $hotel_name = $this->input->post('hotel_name');
            $capacity_title = $this->input->post('capacity_title');
            $capacity = $this->input->post('capacity');
            $child_capacity = $this->input->post('child_capacity');
   

        $result =$this->Hotelcrs_model->edit_room_capacity_details($capacity_id, $hotel_name, $capacity_title, $capacity, $child_capacity);
       
        redirect('hotelcrs/capacity_list','refresh');
        
    }
    
    
    // AMENITIE FUNCTIONS..........................
    
     function amenity_list()
    {
 if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in') && ! $this->session->userdata('supplier_logged_in'))
	   {
		       redirect('login/index');
      } else {
      	
        $data['result'] =$this->Hotelcrs_model->get_global_amenities();
        $this->load->view('hotel_crs/hotel_amenity_list',$data);
        
    }
    }
    
    
   function update_amenity_list($id,$status)
    {
    	  
       
        $this->Hotelcrs_model->update_amenity_list($id,$status);
        redirect('hotelcrs/amenity_list/update', 'refresh'); 
    }
    
    
    function del_amenitie($id)
    {
    //	echo $id; exit();
    $this->Hotelcrs_model->del_amenitie($id);
    
       redirect('hotelcrs/amenity_list', 'refresh'); 
    }
    	
 function add_hotel_amenities()
    {
        $amenity_name = $this->input->post('amenity_name');
        $this->Hotelcrs_model->add_hotel_amenities($amenity_name);
        redirect('hotelcrs/amenity_list/update', 'refresh'); 
    }
    
    
    
    // Price list functions
    
      function price_list()
    {
    	if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in') && ! $this->session->userdata('supplier_logged_in'))
	   {
		       redirect('login/index');
      } else {
         //$data['result_view']=$this->Hotel_Model->extra_service_list();
         $data['result_view']=$this->Hotelcrs_model->price_list();
        // $data['id']=$id;
         $this->load->view('hotel_crs/price_list',$data);
    }
    }
    
    
    function add_price()
    {
    	if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in') && ! $this->session->userdata('supplier_logged_in'))
	   {
		       redirect('login/index');
      } else {
        $this->load->view('hotel_crs/add_price');
    }
    }
    
    
 
    
    
	function getDates()
	{ 
		if($_POST){
			$results = $this->Hotelcrs_model->getDates($_POST);
		}
	}
	
		function add_rate_plan()
	{
		 
      //  $target= $_SERVER['DOCUMENT_ROOT']."/WDM/vayago/public/hotelpriceimg/";
		
		   $target= "upload_files/room_image/";
		   
		move_uploaded_file($_FILES['main_image']['tmp_name'],$target.$_FILES['main_image']['name']);
		$fileimage=$_FILES['main_image']['name'];

		move_uploaded_file($_FILES['image1']['tmp_name'],$target.$_FILES['image1']['name']);
		$fileimage1=$_FILES['image1']['name'];

		move_uploaded_file($_FILES['image2']['tmp_name'],$target.$_FILES['image2']['name']);
		$fileimage2=$_FILES['image2']['name'];

		move_uploaded_file($_FILES['image3']['tmp_name'],$target.$_FILES['image3']['name']);
		$fileimage3=$_FILES['image3']['name'];
		
		
		      
      $config['upload_path'] = "upload_files/room_image/";
			$config['allowed_types'] = 'gif|jpeg|png|jpg';
			$config['overwrite'] = TRUE;

			$this->load->library('upload', $config);
			
			$fileimage = $_FILES['main_image']['name'];;
			$fileimage2 = $_FILES['image2']['name'];
			$fileimage1 = $_FILES['image1']['name'];
			$fileimage3 = $_FILES['image3']['name'];
			
			/*$main_image = $_FILES['main_image']['name'];;
			$image2 = $_FILES['image2']['name'];
			$image1 = $_FILES['image1']['name'];
			$image3 = $_FILES['image3']['name'];
			 
          
            if(!empty($_FILES['main_image']['name']))
            {
                    $hotelimage        =$_FILES['main_image']['name'];
   	 	 	     	  $tmpnamert        =$_FILES['main_image']['tmp_name'];
   	 	 	        $dir = "upload_files/room_image/";
   	 	 	        move_uploaded_file($tmpnamert, $dir.$hotelimage);		
            }
            
             if(!empty($_FILES['image1']['name']))
            {
          			  $hotelimage2=$_FILES['image1']['name'];
   	 	 	     	  $tmpnamert2       =$_FILES['image1']['tmp_name'];
   	 	 	        $dir2 = "upload_files/room_image/";
   	 	 	        move_uploaded_file($tmpnamert2, $dir2.$hotelimage2);					
            }
            
            if(!empty($_FILES['image2']['name']))
            {
                    $hotelimage3        =$_FILES['image2']['name'];
   	 	 	     	  $tmpnamert3        =$_FILES['image2']['tmp_name'];
   	 	 	        $dir3 = "upload_files/room_image/";
   	 	 	        move_uploaded_file($tmpnamert3, $dir3.$hotelimage3);					
            }
            
            if(!empty($_FILES['image3']['name']))
            {
                    $hotelimage4 =$_FILES['image3']['name'];
   	 	 	     	  $tmpnamert4=$_FILES['image3']['tmp_name'];
   	 	 	        $dir4 = "upload_files/room_image/";
   	 	 	        move_uploaded_file($tmpnamert4, $dir4.$hotelimage4);						
            }
          
          */
          
		$prop_id = $this->input->post('hotel_name');
		$room_cate = $this->input->post('room_type');
		$room_type = $this->input->post('capacity_type');
		$child_policy = $this->input->post('child_policy');
		
		$cancel_policy_nights = $this->input->post('cancel_policy_nights');
		$cancel_policy_percent = $this->input->post('cancel_policy_percent');
		$cancel_policy_charge = $this->input->post('cancel_policy_charge');
		$cancel_policy_from = $this->input->post('cancel_policy_from');
		$cancel_policy_to = $this->input->post('cancel_policy_to');
		
		$supplement_rate = $this->input->post('roomsrates');
		
		if(is_array($this->input->post('sd'))) 
		{
		  $room_avail_date_from = $this->input->post('sd');
		}else{
			$room_avail_date_from = $this->input->post('sd'); 
		}
		if(is_array($this->input->post('ed'))) 
		{
			$room_avail_date_to = $this->input->post('ed');
		}else{
			$room_avail_date_to = $this->input->post('ed');
		}
		$dates = $this->input->post('dates'); 
		$weekday = $this->input->post('weekday'); 
		$price = $this->input->post('price'); 
		$extra_bed_price = $this->input->post('extra_bed_price'); 
		$avail = $this->input->post('avail'); 
		$aadult = $this->input->post('adult'); 
		$achild = $this->input->post('child');
		$child_price = $this->input->post('child_price');
		$infant = $this->input->post('infant');
		$supplier_id=$this->session->userdata('supplier_id');
		$board_type= $this->input->post('board_type');
		
		$this->Hotelcrs_model->add_rate_plans($supplier_id,$board_type,$prop_id,$room_cate,$room_type,$child_policy,
		$cancel_policy_nights,$cancel_policy_percent,$cancel_policy_charge,$cancel_policy_from,$cancel_policy_to,$room_avail_date_from,
		$room_avail_date_to,$dates,$weekday,$price,$avail,
		$aadult,$achild,$child_price,$fileimage,$fileimage1,$fileimage2,$fileimage3);
		redirect('hotelcrs/price_list','refresh');
	}
	
	
	
    
        function add_rate_plan_old($supplier_id)
    {
        //print'<pre />';print_r($_POST);exit;
        $this->form_validation->set_rules('hotel_name', 'Hotel Name', 'required');
        $this->form_validation->set_rules('room_type', 'Room Category', 'required');
        $this->form_validation->set_rules('capacity_type', 'Room Type', 'required');
        if($this->form_validation->run()==FALSE)
        {
            $data['exist'] = "";
            $data['hotel_name'] = $this->input->post('hotel_name');
            $this->load->view('hotel_crs/add_price',$data);
        }
        else
        {
        	//echo "<pre>";print_r($_POST);echo "</pre>";exit();

          //  print_r($_FILES);exit();
        	
            
        	$config['upload_path'] = "upload_files/room_image/";
			$config['allowed_types'] = 'gif|jpeg|png|jpg';
			$config['overwrite'] = TRUE;

			$this->load->library('upload', $config);
			
			$main_image = $_FILES['main_image']['name'];;
			$image2 = $_FILES['image2']['name'];
			$image1 = $_FILES['image1']['name'];
			$image3 = $_FILES['image3']['name'];
			
          
            if(!empty($_FILES['main_image']['name']))
            {
                    $hotelimage        =$_FILES['main_image']['name'];
   	 	 	     	  $tmpnamert        =$_FILES['main_image']['tmp_name'];
   	 	 	        $dir = "upload_files/room_image/";
   	 	 	        move_uploaded_file($tmpnamert, $dir.$hotelimage);		
            }
            
             if(!empty($_FILES['image1']['name']))
            {
          			  $hotelimage2=$_FILES['image1']['name'];
   	 	 	     	  $tmpnamert2       =$_FILES['image1']['tmp_name'];
   	 	 	        $dir2 = "upload_files/room_image/";
   	 	 	        move_uploaded_file($tmpnamert2, $dir2.$hotelimage2);					
            }
            
            if(!empty($_FILES['image2']['name']))
            {
                    $hotelimage3        =$_FILES['image2']['name'];
   	 	 	     	  $tmpnamert3        =$_FILES['image2']['tmp_name'];
   	 	 	        $dir3 = "upload_files/room_image/";
   	 	 	        move_uploaded_file($tmpnamert3, $dir3.$hotelimage3);					
            }
            
            if(!empty($_FILES['image3']['name']))
            {
                    $hotelimage4 =$_FILES['image3']['name'];
   	 	 	     	  $tmpnamert4=$_FILES['image3']['tmp_name'];
   	 	 	        $dir4 = "upload_files/room_image/";
   	 	 	        move_uploaded_file($tmpnamert4, $dir4.$hotelimage4);						
            }
            
            
            
			
            $prop_id = $this->input->post('hotel_name');
            $room_cate = $this->input->post('room_type');
            $room_type = $this->input->post('capacity_type');
            $season = $this->input->post('season');
            $allocation_rooms = $this->input->post('allocation_rooms');
            $allocation_release_days = $this->input->post('allocation_release_days');
            $allocation_release_period = $this->input->post('allocation_release_period');
            
            $sd = $this->input->post('sds');
            if($sd != '')
            {
            $sds = explode("-",$sd);
            $allocation_validity_from = $sds[2].'-'.$sds[1].'-'.$sds[0];
            }
            else
            {
                $allocation_validity_from = "0000-00-00";
            }
            $ed = $this->input->post('eds');
            if($ed != '') {
            $eds = explode("-",$ed);
            $allocation_validity_to = $eds[2].'-'.$eds[1].'-'.$eds[0];
            }
            else{
                $allocation_validity_to = "0000-00-00";
            }
            
            $child_below_age = $this->input->post('child_below_age');
            $child_above_age = $this->input->post('child_above_age');
            /*$child_above_age_charge = $this->input->post('child_above_age_charge');
            $child_extra_bed_charge = $this->input->post('child_extra_bed_charge');
            $no_of_infants = $this->input->post('no_of_infants');*/

	    $child_above_age_charge = "";
            $child_extra_bed_charge = "";
            $no_of_infants = "";

            $meal_plan = $this->input->post('meal_plan');
            
            $meal_plan_lunch = $this->input->post('meal_plan_lunch');
            $meal_plan_breakfast = $this->input->post('meal_plan_breakfast');
                
            $lunch=''; 
            if($meal_plan_lunch == 'Lunch')
            {
                $lunch = $meal_plan_lunch;
            }
            else if($this->input->post('lunch') == 'Lunch')
            {
                $lunch = $this->input->post('lunch');
            }
            
            $dinner='';
            if($meal_plan_lunch == 'Dinner')
            {
                $dinner = $meal_plan_lunch;
            }
            else if($this->input->post('dinner') == 'Dinner')
            {
                $dinner = $this->input->post('dinner');
            }
            
            $breakfast='';
            if($meal_plan_breakfast == 'Breakfast')
            {
                $breakfast = $meal_plan_breakfast;
            }
            
            
            $breakfast_type = $this->input->post('breakfast_type');
            
            $adult_breakfast_rate = $this->input->post('adult_meal_plan_breakfast_rate');
            $adult_lunch_rate = $this->input->post('adult_meal_plan_lunch_rate');
            $adult_dinner_rate = $this->input->post('adult_meal_plan_dinner_rate'); 
            
            $child_breakfast_rate = $this->input->post('child_meal_plan_breakfast_rate');
            $child_lunch_rate = $this->input->post('child_meal_plan_lunch_rate');
            $child_dinner_rate = $this->input->post('child_meal_plan_dinner_rate'); 
            
            $child_policy = $this->input->post('child_policy');
            $remarks = $this->input->post('remarks');
            $cancel_policy_nights = $this->input->post('cancel_policy_nights');
            $cancel_policy_percent = $this->input->post('cancel_policy_percent');
            $cancel_policy_charge = $this->input->post('cancel_policy_charge');
            $cancel_policy_from = $this->input->post('cancel_policy_from'); // Not used
            $cancel_policy_to = $this->input->post('cancel_policy_to'); // Not used
		$cancellation_before_days = $this->input->post('cancellation_before_days');
            
            $cancel_policy_desc = 'cancel';
            $supplement_rate = '0';
            
            if(is_array($this->input->post('sd'))) 
            {
              $room_avail_date_from = $this->input->post('sd');
            }
            else
            {
                $room_avail_date_from = $this->input->post('sd'); 
            }
            
            
            if(is_array($this->input->post('ed'))) 
            {
                $room_avail_date_to = $this->input->post('ed');
            }
            else
            {
                $room_avail_date_to = $this->input->post('ed');
            }
            
           //print'<pre>';print_r($room_avail_date_from);exit;
            $dates = $this->input->post('dates'); 
            $weekday = $this->input->post('weekday'); 
            $price = $this->input->post('price'); 
            $extra_bed_price = $this->input->post('extra_bed_price'); 
            $avail = $this->input->post('avail'); 
            $aadult = $this->input->post('adult'); 
            $achild = $this->input->post('child');
            $child_price = $this->input->post('child_price');
            $infant = $this->input->post('infant');
            $sup_charge = $this->input->post('sup_charge');
            
        
            $this->Hotelcrs_model->add_rate_plans($supplier_id, $prop_id, $room_cate, $room_type, $season, $allocation_rooms, $allocation_release_days, $allocation_release_period, $allocation_validity_from, $allocation_validity_to, $child_below_age, $child_above_age, $child_above_age_charge, $child_extra_bed_charge, $no_of_infants, $breakfast, $breakfast_type, $meal_plan, $lunch, $dinner, $adult_breakfast_rate, $adult_lunch_rate, $adult_dinner_rate, $child_breakfast_rate, $child_lunch_rate,$child_dinner_rate, $child_policy, $remarks, $cancel_policy_nights, $cancel_policy_percent, $cancel_policy_charge, $cancel_policy_from, $cancel_policy_to, $cancel_policy_desc, $room_avail_date_from, $room_avail_date_to, $dates, $weekday, $price, $extra_bed_price, $avail, $aadult, $achild, $child_price, $infant, $sup_charge, $supplement_rate,$main_image,$image1,$image2,$image3,$cancellation_before_days);
            
            
            redirect('hotelcrs/price_list','refresh');
        }
    }
    
    
        function getRoomType($hotel_id)
    {
        //echo $hotel_id;exit;
        $data['room_type'] = $this->Hotelcrs_model->getRoomType($hotel_id);
        //echo "<pre/>";print_r($data);exit;
    }
    
    
     //admin get acvail dates
	function getAvailDates()
	{
		
		 $results = $this->Hotelcrs_model->getAvailDates();
	}
	
	
    
  function edit_price($sup_id,$prop_id,$id)
    {
    	
    	if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in') && ! $this->session->userdata('supplier_logged_in'))
	   {
		       redirect('login/index');
      } else {
      	
      	$data['sdays']=$this->Hotelcrs_model->get_sel_days($id);
      	$data['days']=$this->Hotelcrs_model->get_days();
      	
      	//echo "<pre>"; print_r($data); exit();
      	$data['smart2']=$this->Hotelcrs_model->smart_update2($id);
      	//echo "<pre>"; print_r($data); exit();
		$data['smart']=$this->Hotelcrs_model->smart_update($id);
        $data['rat_tac_details'] = $this->Hotelcrs_model->view_rate_tactics_details($id);
        $data['maintain_month_detail'] = $this->Hotelcrs_model->fetch_maintain_month_details($id);//print_r($data['maintain_month_detail']);exit();
        $data['prop_id'] = $prop_id;
        $data['id'] = $id;
        $data['sup_id']=$sup_id;
      
      //echo "<pre/>";print_r($data['rat_tac_details']);exit;
      
        $this->load->view('hotel_crs/edit_price',$data);
    }
    }
    
    
    
    function smart_update()
    {
    	
    //	$this->db->get->(sup_rate_tactics`
    	
    	
    	}
    
    
    
    function edit_rate_plan()
    {
		$this->form_validation->set_rules('hotel_name', 'Hotel Name', 'required');
        $this->form_validation->set_rules('room_type', 'Room Category', 'required');
        $this->form_validation->set_rules('capacity_type', 'Room Type', 'required');
        if($this->form_validation->run()==FALSE)
        {
            $data['exist'] = "";
            $data['hotel_name'] = $this->input->post('hotel_name');
            $this->load->view('hotelcrs/edit_price',$data);
        }else{
			$hotel_name = $this->input->post('hotel_name');
            $room_cate = $this->input->post('room_type');
            $room_type = $this->input->post('capacity_type');
            $child_policy=$this->input->post('child_policy');
            $cancel_policy_desc=$this->input->post('cancel_policy_desc');
            $hid=$this->input->post('hid');
            $avail_dates = $this->input->post('dates'); 
            $avail_weekday = $this->input->post('weekday'); 
            $avail_price = $this->input->post('price'); 
            $avail_rooms = $this->input->post('avail'); 
            $avail_adult = $this->input->post('adult'); 
            $avail_child = $this->input->post('child');
            $hid=$this->input->post('hid');
            
			$main_img=$_FILES['main_image']['name'];
			if(!empty($main_img))
			{
				$main_image=$_FILES['main_image']['name'];
			}else{
				$main_image=$this->input->post('MI');
			}
            $image1=$_FILES['image1']['name'];
			if(!empty($image1))
			{
				$image1=$_FILES['image1']['name'];
			}else{
				$image1=$this->input->post('im1');
			}
            $image2=$_FILES['image2']['name'];
			if(!empty($image2))
			{
				$image2=$_FILES['image2']['name'];
			}else{
				$image2=$this->input->post('im2');
			}
			$image3=$_FILES['image3']['name'];
			if(!empty($image3))
			{
				$image3=$_FILES['image3']['name'];
			}else{
				$image3=$this->input->post('im3');
			}
			
			if($_FILES['main_image']['name']!=''){
				$hotelimage=$_FILES['main_image']['name'];
				$tmpnamert=$_FILES['main_image']['tmp_name'];
				$dir = "upload_files/room_image/";
				move_uploaded_file($tmpnamert, $dir.$hotelimage);
			}
			if($_FILES['image1']['name']!=''){
				$hotelimage2=$_FILES['image1']['name'];
				$tmpnamert2=$_FILES['image1']['tmp_name'];
				$dir2 = "upload_files/room_image/";
				move_uploaded_file($tmpnamert2, $dir2.$hotelimage2);
			}
			if($_FILES['image2']['name']!=''){
				$hotelimage3=$_FILES['image2']['name'];
				$tmpnamert3=$_FILES['image2']['tmp_name'];
				$dir3 = "upload_files/room_image/";
				move_uploaded_file($tmpnamert3, $dir3.$hotelimage3);
			}
			if($_FILES['image3']['name']!=''){
				$hotelimage4=$_FILES['image3']['name'];
				$tmpnamert4=$_FILES['image3']['tmp_name'];
				$dir4 = "upload_files/room_image/";
				move_uploaded_file($tmpnamert4, $dir4.$hotelimage4);
			}
			
            $data9=array(
				'hotel_id'=>$hotel_name,
				'category_type'=>$room_cate,
				'main_image'=>$main_image,
				'image1'=>$image1,
				'image2'=>$image2, 
				'image3'=>$image3,
				'child_policy'=>$child_policy,
				'cancel_policy_desc'=>$cancel_policy_desc, 
				'room_type'=> $room_type
			);
            $config['upload_path'] = APP_BASE_PATH.'/upload_files/room_image';
            $config['allowed_types'] = 'gif|jpeg|png|jpg';
            $config['overwrite'] = TRUE;
			$this->load->library('upload', $config);
            
            if(is_array($this->input->post('sd'))) 
            {
                $room_avail_date_from = $this->input->post('sd');
            }else{
                $room_avail_date_from = $this->input->post('sd');
            }
            if(is_array($this->input->post('ed'))) 
            {
                $room_avail_date_to = $this->input->post('ed');
            }else{
                $room_avail_date_to = $this->input->post('ed');
            }
            
           /*$cancel_policy_nights = $this->input->post('cancel_policy_nights');
            $cancel_policy_percent = $this->input->post('cancel_policy_percent');
            $cancel_policy_charge = $this->input->post('cancel_policy_charge');
            $cancel_policy_from = $this->input->post('cancel_policy_from');
            $cancel_policy_to = $this->input->post('cancel_policy_to');
            $cancel_policy_desc = $this->input->post('cancel_policy_desc');
			*/
			$this->Hotelcrs_model->edit_rate_plan($hotel_name,$main_image,$image1,$image2,$image3,$hid, $room_cate, $room_type,$child_policy,$cancel_policy_desc,$room_avail_date_from, $room_avail_date_to, $avail_dates, $avail_weekday, $avail_price,$avail_rooms, $avail_adult, $avail_child);
            //$this->Hotelcrs_model->edit_rate_plan2($data9, $hid);
           redirect('hotelcrs/price_list');
        }
    }
    
    
    
   
   /* 
    function edit_rate_plan($supplier_id,$prop_id, $id)
    {
        
         //print'<pre />';print_r($_POST);exit;
        $this->form_validation->set_rules('hotel_name', 'Hotel Name', 'required');
        $this->form_validation->set_rules('room_type', 'Room Category', 'required');
        $this->form_validation->set_rules('capacity_type', 'Room Type', 'required');
        if($this->form_validation->run()==FALSE)
        {
            $data['exist'] = "";
            $data['hotel_name'] = $this->input->post('hotel_name');
            $this->load->view('hotel_crs/edit_price',$data);
        }
        else
        {

            $config['upload_path'] = APP_BASE_PATH.'/upload_files/room_image';
            
            $config['allowed_types'] = 'gif|jpeg|png|jpg';
            $config['overwrite'] = TRUE;

            $this->load->library('upload', $config);
            
            $main_image = "";
            $image2 = "";
            $image1 = "";
            $image3 = "";
            
            if(!empty($_FILES['main_image']['name']))
            {
                $config['upload_path'] = IMAGE_UPLOAD_PATH.'/room_image/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|JPEG|PNG';
                $this->load->library('upload', $config);
                $this->upload->do_upload('main_image');                 
                $simg = $this->upload->data('file');
                $main_image = WEB_DIR.'upload_files/room_image/'.$_FILES['main_image']['name']; 
                //echo $main_image;exit();                       
            }
            
             if(!empty($_FILES['image1']['name']))
            {
                $config['upload_path'] = IMAGE_UPLOAD_PATH.'/room_image/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|JPEG|PNG';
                $this->load->library('upload', $config);
                $this->upload->do_upload('image1');                 
                $simg = $this->upload->data('file');
                $image1 = WEB_DIR.'upload_files/room_image/'.$_FILES['image1']['name'];                        
            }
            
            if(!empty($_FILES['image2']['name']))
            {
                $config['upload_path'] = IMAGE_UPLOAD_PATH.'/room_image/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|JPEG|PNG';
                $this->load->library('upload', $config);
                $this->upload->do_upload('image2');                 
                $simg = $this->upload->data('file');
                $image2 = WEB_DIR.'upload_files/room_image/'.$_FILES['image2']['name'];                        
            }
            
            if(!empty($_FILES['image3']['name']))
            {
                $config['upload_path'] = IMAGE_UPLOAD_PATH.'/room_image/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|JPEG|PNG';
                $this->load->library('upload', $config);
                $this->upload->do_upload('image3');                 
                $simg = $this->upload->data('file');
                $image3 = WEB_DIR.'upload_files/room_image/'.$_FILES['image3']['name'];                        
            }
            

            $prop_id = $this->input->post('hotel_name');
            $room_cate = $this->input->post('room_type');
            $room_type = $this->input->post('capacity_type');
            $season= $this->input->post('season');
            $allocation_rooms = $this->input->post('allocation_rooms');
            $allocation_release_days = $this->input->post('allocation_release_days');
            $allocation_release_period = $this->input->post('allocation_release_period');
            
            $sd = $this->input->post('sd');
            
            
            if($sd != '')
            {
                $sds = explode("/",$sd);
                $allocation_validity_from = $sds[2].'-'.$sds[1].'-'.$sds[0];
            }
            else
            {
                $allocation_validity_from = "0000-00-00";
            }
            $ed = $this->input->post('ed');
            if($ed!='') 
            {
                $eds = explode("/",$ed);
                $allocation_validity_to = $eds[2].'-'.$eds[1].'-'.$eds[0];
            }
            else
            {
                $allocation_validity_to = "0000-00-00";
            }
            //echo $allocation_validity_from."-----------".$allocation_validity_to;exit();
            $child_below_age = $this->input->post('child_below_age');
            $child_above_age = $this->input->post('child_above_age');
            //$child_above_age_charge = $this->input->post('child_above_age_charge');
            //$child_extra_bed_charge = $this->input->post('child_extra_bed_charge');
            //$no_of_infants = $this->input->post('no_of_infants');

	         $child_above_age_charge = "";
            $child_extra_bed_charge = "";
            $no_of_infants = "";
            $meal_plan = $this->input->post('meal_plan');
            
            $meal_plan_lunch = $this->input->post('meal_plan_lunch');
            $meal_plan_breakfast = $this->input->post('meal_plan_breakfast');
            
                
            $lunch=''; 
            if($meal_plan_lunch == 'Lunch')
            {
                $lunch = $meal_plan_lunch;
            }
            else if($this->input->post('lunch') == 'Lunch')
            {
                $lunch = $this->input->post('lunch');
            }
            
            
            $dinner='';
            if($meal_plan_lunch == 'Dinner')
            {
                $dinner = $meal_plan_lunch;
            }
            else if($this->input->post('dinner') == 'Dinner')
            {
                $dinner = $this->input->post('dinner');
            }
            
            $breakfast='';
            if($meal_plan_breakfast == 'Breakfast')
            {
                $breakfast = $meal_plan_breakfast;
            }
            
            $breakfast_type = $this->input->post('breakfast_type');
            
            $adult_breakfast_rate = $this->input->post('adult_meal_plan_breakfast_rate');
            $adult_lunch_rate = $this->input->post('adult_meal_plan_lunch_rate');
            $adult_dinner_rate = $this->input->post('adult_meal_plan_dinner_rate'); 
            
            $child_breakfast_rate = $this->input->post('child_meal_plan_breakfast_rate');
            $child_lunch_rate = $this->input->post('child_meal_plan_lunch_rate');
            $child_dinner_rate = $this->input->post('child_meal_plan_dinner_rate'); 
            
            $child_policy = $this->input->post('child_policy');
            $remarks = $this->input->post('remarks');
            $cancel_policy_nights = $this->input->post('cancel_policy_nights');
            $cancel_policy_percent = $this->input->post('cancel_policy_percent');
            $cancel_policy_charge = $this->input->post('cancel_policy_charge');
            $cancel_policy_from = $this->input->post('cancel_policy_from');
            $cancel_policy_to = $this->input->post('cancel_policy_to');
            $cancel_policy_desc = $this->input->post('cancel_policy_desc');

            $supplement_rate ='';
            if($meal_plan =='3')
            {
                 $supplement_rate = $this->input->post('supplement_rate');
            }else {
                
                $supplement_rate ='0';
            }
            
            if(is_array($this->input->post('sd'))) 
            {
              $room_avail_date_from = $this->input->post('sd');
              
            }
            else
            {
                $room_avail_date_from = $this->input->post('sd');
                
            }
            
            if(is_array($this->input->post('ed'))) 
            {
                $room_avail_date_to = $this->input->post('ed');
                
            }
            else
            {
                $room_avail_date_to = $this->input->post('ed');
                
            }
            
            $avail_dates = $this->input->post('dates'); 
            $avail_weekday = $this->input->post('weekday'); 
            $avail_price = $this->input->post('price'); 
            $extra_bed_price = $this->input->post('extra_bed_price'); 
            $avail_rooms = $this->input->post('avail'); 
            $avail_adult = $this->input->post('adult'); 
            $avail_child = $this->input->post('child');
            $avail_child_price = $this->input->post('child_price');
            $avail_infant = $this->input->post('infant');
            $avail_sup_charge = $this->input->post('sup_charge');
            $avail_datess = $this->input->post('datess'); 
           
            
          //  $this->Hotelcrs_model->edit_rate_plan($main_image,$image1,$image2,$image3,$supplier_id, $prop_id, $id, 
         // $room_cate, $room_type, $season, $allocation_rooms, $allocation_release_days, $allocation_release_period, $allocation_validity_from,
          // $allocation_validity_to, $child_below_age, $child_above_age, $child_above_age_charge,$child_extra_bed_charge, $no_of_infants, 
          // $breakfast, $breakfast_type, $adult_breakfast_rate, $adult_lunch_rate,$adult_dinner_rate,$child_breakfast_rate,$child_lunch_rate,
         //  $child_dinner_rate, $meal_plan, $lunch, $dinner, $child_policy, $remarks, $cancel_policy_nights, $cancel_policy_percent, 
          // $cancel_policy_charge, $cancel_policy_from, $cancel_policy_to, $cancel_policy_desc, $room_avail_date_from,
          //  $room_avail_date_to, $avail_dates, $avail_weekday, $avail_price, $extra_bed_price, $avail_rooms, $avail_adult, $avail_child, 
          //  $avail_child_price, $avail_infant, $avail_sup_charge, $avail_datess, $supplement_rate);
            
            
           
		 
            
            $hotel_name = $this->input->post('hotel_name');
            $room_cate = $this->input->post('room_type');
            $room_type = $this->input->post('capacity_type');
            $child_policy=$this->input->post('child_policy');
            $cancel_policy_desc=$this->input->post('cancel_policy_desc');
            $hid=$this->input->post('hid');
            
            
            $main_img=$_FILES['main_image']['name'];
            if(!empty($main_img))
            {
            	$mimg=$_FILES['main_image']['name'];
            	}
            	else 
            	{
            		$mimg=$this->input->post('MI');
            	}
            	
            	
            	 $image1=$_FILES['image1']['name'];
            if(!empty($image1))
            {
            	$im1=$_FILES['image1']['name'];
            	}
            	else 
            	{
            		$im1=$this->input->post('im1');
            	}
            	
            	
            		 $image2=$_FILES['image2']['name'];
            if(!empty($image2))
            {
            	$im2=$_FILES['image2']['name'];
            	}
            	else 
            	{
            		$im2=$this->input->post('im2');
            	}


					 $image3=$_FILES['image3']['name'];
            if(!empty($image3))
            {
            	$im3=$_FILES['image3']['name'];
            	}
            	else 
            	{
            		$im3=$this->input->post('im3');
            	}

        		  
                
                
//print_r($main_image); exit();
  
   	 	      	  $hotelimage        =$_FILES['main_image']['name'];
   	 	 	     	  $tmpnamert        =$_FILES['main_image']['tmp_name'];
   	 	 	        $dir = "upload_files/room_image/";
   	 	 	        move_uploaded_file($tmpnamert, $dir.$hotelimage);
   	 	 	        
   	 	 	        
   	 	 	        $hotelimage2       =$_FILES['image1']['name'];
   	 	 	     	  $tmpnamert2       =$_FILES['image1']['tmp_name'];
   	 	 	        $dir2 = "upload_files/room_image/";
   	 	 	        move_uploaded_file($tmpnamert2, $dir2.$hotelimage2);
   	 	 	        
   	 	 	         $hotelimage3        =$_FILES['image2']['name'];
   	 	 	     	  $tmpnamert3        =$_FILES['image2']['tmp_name'];
   	 	 	        $dir3 = "upload_files/room_image/";
   	 	 	        move_uploaded_file($tmpnamert3, $dir3.$hotelimage3);
   	 	 	        
   	 	 	         $hotelimage4        =$_FILES['image3']['name'];
   	 	 	     	  $tmpnamert4        =$_FILES['image3']['tmp_name'];
   	 	 	        $dir4 = "upload_files/room_image/";
   	 	 	        move_uploaded_file($tmpnamert4, $dir4.$hotelimage4);
      

           // echo $hid; exit();
            
            
            	$data=array('hotel_id'=>$hotel_name,'category_type'=>$room_cate,
            	'main_image'=>$mimg, 'image1'=>$im1, 'image2'=>$im2, 'image3'=>$im3,
            	'child_policy'=>$child_policy,'cancel_policy_desc'=>$cancel_policy_desc, 'room_type'=> $room_type);
           
            
          
 			 $this->Hotelcrs_model->edit_rate_plan($data, $hid);
 				
 			 
          redirect('hotelcrs/price_list');
        }
   
   }
   
  */
   
   function edit_amenitie($id)
   {
   	if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in') && ! $this->session->userdata('supplier_logged_in'))
	   {
		       redirect('login/index');
      }
      else{
   $data['result']= $this->Hotelcrs_model->edit_amenities($id);
   $this->load->view('hotel_crs/edit_amenitie',  $data);
   }
   }
   
   function updat_amenitie()
   {
   	$id=$this->input->post('id');
 $ame=$this->input->post('amenitie');
   	
   	$sus=$this->Hotelcrs_model->update_amenitie($ame,$id);
   	if($sus)
   	{
		redirect('hotelcrs/amenity_list');   		
   		}
   	}
   
   
   
   
   
     function get_usersss()
    {
     
      $value=$this->input->post('cid');
   	 	//  print_r($value); exit();
   	 	 for($m=0;$m<count($value);$m++){
   	 	 	     $user_data =$value[$m];
   	 	 	    // print_r($user_data); exit();
   	 	 $data= $this->Hotelcrs_model->get_uses($value[$m]);
           
           
             redirect('hotel_crs/cvs_export', 'refresh');
   	 	  	}
     	}
   
   function sel_usersss()
    {   	
	$data['res']=$this->Hotelcrs_model->usrs();
   $this->load->view('hotel_crs/cvs_export', $data);
    }
  
  
  
     function delete_price($sup_rate_tactics_id)
    {
        $result =$this->Hotelcrs_model->delete_price($sup_rate_tactics_id);
        redirect('hotelcrs/price_list','refresh');
    }
    
    
    
    

	
			function verifyVisitors()
	{
		
		 $value=$this->input->post('cid');
		$contents="";
		
 for($m=0;$m<count($value);$m++){
   	 	 	     $user_data =$value[$m];
   	 	 	    // print_r($user_data); exit();
   	 	   $this->Hotelcrs_model->get_uses($value[$m]);
       
   	 	  	}
    
  	
		$visitorList =  $this->Hotelcrs_model->get_uses();
		 
		
		for($i=0;$i<count($visitorList);$i++)
		{
			 $contents.=$visitorList[$i]->usertype."\t";
			 $contents.=$visitorList[$i]->twitter_id."\t";
			 $contents.=$visitorList[$i]->email."\t";
			 $contents.=$visitorList[$i]->firstname."\t";
			 $contents.=$visitorList[$i]->lastname."\t";
			 
			 $contents.=$visitorList[$i]->address."\t";
			 $contents.=$visitorList[$i]->MobilePhone."\t";
			 $contents.=$visitorList[$i]->ship_addressship_address."\t";
			 
			 	 $contents.=$visitorList[$i]->contact_no."\t";
			 $contents.=$visitorList[$i]->city."\t";
			 $contents.=$visitorList[$i]->postal_code."\t";
			 
			 $datetime=$visitorList[$i]->register_date;
			 if (strpos($datetime,' ') !== false)
			{
				$datetime1=str_replace(' ','_',$datetime);
				//echo $special1;
			}
			else{
				
				$datetime1=$datetime;
				
					}
			 $contents.=$datetime1."\t"; 
			 $verdatetime=$visitorList[$i]->VerificationDate;
			 if (strpos($verdatetime,' ') !== false)
			{
				$verdatetime1=str_replace(' ','_',$verdatetime);
				//echo $special1;
			}
			else{
				
				$verdatetime1=$verdatetime;
				
					}
				 $contents.=$verdatetime1."\r\n"; 	
			  
		}
		
		header("Content-type: application/octet-stream");
	    header("Content-Disposition: attachment; filename=B2C.cvs");
	    header("Pragma: no-cache");
	    header("Expires: 0");
    echo $contents;
		
	}    	
    
    function test_apt()
    {
    	 $data['result_view']=$this->Hotelcrs_model->view_all_hotels();
     $data['id']='admin';
    	
    	$this->load->view('hotel_crs/test_apt',  $data);
    	
    	}
    
   	
   	}
/* End of file apartment.php */
/* Location: ./application/controllers/apartment.php */
