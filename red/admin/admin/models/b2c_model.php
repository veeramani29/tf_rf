<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');





class B2c_Model extends CI_Model {


	


	public function __construct()


    {	


      parent::__construct();


    }


	


	public function check_email_availability($email)


   	{   		


		$this->db->select('*')


				->from('user_info')


				->where('user_email',$email)


				->limit('1');


		$query = $this->db->get();





      	if($query->num_rows > 0) 


		{      


         	return $query->result();


		}


				


      	return '';


		


   }   


   


   public function add_user($user_email,$user_password,$title,$first_name,$middle_name,$last_name,$mobile_no,$address,$pin_code,$city,$state,$country,$image_path)


   {
       
       $lastId = $this->db->query($sql = "select user_no from user_info order by user_id desc limit 0,1");
        if($lastId->num_rows() > 0)
        { 
            $user_no = $lastId->row()->user_no; 
            $ex = explode('RATC',$user_no);
            $user_no = ($ex[1]+1);
        }
        else $user_no = '101888';


	   	$data = array(

                'user_no' => 'RATC'.$user_no,
		'user_email' => $user_email,


		'user_password' => $user_password,


		'title' => $title,


		'first_name' => $first_name,


		'middle_name' => $middle_name,


		'last_name' => $last_name,


		'mobile_no' => $mobile_no,		


		'address' => $address,


		'pin_code' => $pin_code,


 		'city' => $city,


		'state' => $state,


		'country' => $country,


		'user_logo' => $image_path,


		'status' => 1,		


		


		);


			


		$this->db->set('register_date', 'NOW()', FALSE); 


		


		$this->db->insert('user_info', $data);


		$id = $this->db->insert_id();


		if(!empty($id))


		{

			return true;

		} 


		else 


		{


			return false;


		}





   }


   


   public function get_user_list()


   {   		


		$this->db->select('*')


				->from('user_info');			


		$this->db->order_by('user_id', 'DESC');		


		$query = $this->db->get();





      if($query->num_rows > 0) 


	  {	  


         return $query->result();


      }


	  


      return false;


  }


  


   public function manage_user_status($user_id,$status)


   {


		$data['status'] = $status;	


		$where = "user_id = '$user_id'";


		if($this->db->update('user_info', $data, $where)) 


		{


			return true;


		} 


		else 


		{


			return false;


		}		





   }


   


   public function get_user_info_by_id($user_id)


   	{   		


		$this->db->select('*')


				->from('user_info')				


				->where('user_id',$user_id)


				->limit('1');


		$query = $this->db->get();





		  if($query->num_rows > 0) 


		  {      


			 $res = $query->result();


			 return $res[0];


		  }	


		    


		  return false;


	  


  	}


	


	public function update_user($user_id,$title,$first_name,$middle_name,$last_name,$mobile_no,$address,$pin_code,$city,$state,$country,$user_logo)


   {


	   	$data = array(		


		'title' => $title,


		'first_name' => $first_name,


		'middle_name' => $middle_name,


		'last_name' => $last_name,


		'mobile_no' => $mobile_no,		


		'address' => $address,


		'pin_code' => $pin_code,


 		'city' => $city,


		'state' => $state,


		'country' => $country,


		'user_logo' => $user_logo,				


		);


		


		$this->db->where('user_id',$user_id);	


	


		if($this->db->update('user_info', $data))


		{		


			return true;


		} 


		else 


		{


			return false;


		}





   }


   


   public function update_user_password($user_id,$password='')


   {


		if(!empty($password)) 


		{


			$data['user_password'] = $password;	


			$where = "user_id = '$user_id'";


			if($this->db->update('user_info', $data, $where)) 


			{


				return true;


			} 


			else 


			{


				return false;


			}		


		}			


		else 


		{


			return false;


		}





   }	


   


    public function get_hotel_markup_list()


   	{   


		$this->db->select('*')


				->from('b2c_markup_info')


				->where('service_type',1);


		$query = $this->db->get();





      	if($query->num_rows > 0 ) 


		{      


         	return $query->result();


      	}


		


      	return false;


   }


   


   public function get_flight_markup_list()


   	{   


		$this->db->select('*')


				->from('b2c_markup_info')


				->where('service_type',2);


		$query = $this->db->get();





      	if($query->num_rows > 0 ) 


		{      


         	return $query->result();


      	}


		


      	return false;


   }


   


   public function get_car_markup_list()


   	{   


		$this->db->select('*')


				->from('b2c_markup_info')


				->where('service_type',3);


		$query = $this->db->get();





      	if($query->num_rows > 0 ) 


		{      


         	return $query->result();


      	}


		


      	return false;


   }


   


   function delete_b2c_markup($markup_type,$service_type)


	{


		$where = "markup_type = '$markup_type' AND service_type = '$service_type'";


		if ($this->db->delete('b2c_markup_info', $where)) 


		{


			return true;


		} 


		else 


		{


			return false;


		}


		


	}


	


	function b2c_markup_checking($country, $city, $hotel, $airline, $api_name, $markup_type, $service_type, $currency)


	{


		$this->db->select('*');


		$this->db->from('b2c_markup_info');


		$this->db->where('country',$country);


		if($city != NULL)


		{


			$this->db->where('city',$city);


		}


		if($hotel != NULL)


		{


			$this->db->where('hotel',$hotel);


		}


		if($airline != NULL)


		{


			$this->db->where('airline',$airline);


		}


		$this->db->where('api_name',$api_name);


		$this->db->where('markup_type',$markup_type);


		$this->db->where('service_type',$service_type);


		$this->db->where('currency',$currency);


		


		$query = $this->db->get();


		


		if($query->num_rows() == '')


		{


			return '';			


		}


		else


		{


			return $query->row();				


		}


		


	}


	


	function add_b2c_markup($country, $city, $hotel, $airline, $api_name, $markup, $markup_type, $service_type, $currency)


	{	


		$data = array(


			'country' => $country,


			'city' => $city,


			'hotel' => $hotel,


			'airline' => $airline,


			'api_name' => $api_name,


			'currency' => $currency,


			'markup' => $markup,


			'markup_type' => $markup_type,


			'service_type' => $service_type,


			'status' => 1


			);


			


		//$this->db->set('register_date', 'NOW()', FALSE); 


		$this->db->insert('b2c_markup_info', $data);


		$id = $this->db->insert_id();


		if(!empty($id)) 


		{


			return true;


		} 


		else 


		{


			return false;


		}





	}


	


	function delete_id_b2c_markup($country, $city, $hotel, $airline, $api_name, $markup_type, $service_type, $currency)


	{


		$this->db->where('country',$country);


		if($city != NULL)


		{


			$this->db->where('city',$city);


		}


		if($hotel != NULL)


		{


			$this->db->where('hotel',$hotel);


		}


		if($airline != NULL)


		{


			$this->db->where('airline',$airline);


		}


		$this->db->where('api_name',$api_name);


		$this->db->where('markup_type',$markup_type);


		$this->db->where('service_type',$service_type);


		$this->db->where('currency',$currency);


				


		if($this->db->delete('b2c_markup_info')) 


		{


			return true;


		} 


		else 


		{


			return false;


		}


		


	}


	


   public function manage_b2c_markup_status($markup_id,$status)


   {


		$data['status'] = $status;	


		$where = "markup_id = '$markup_id'";


		if($this->db->update('b2c_markup_info', $data, $where)) 


		{


			return true;


		} 


		else 


		{


			return false;


		}		





   }


   


   function delete_b2c_markup_status($markup_id)


	{


		$where = "markup_id = '$markup_id'";


		if ($this->db->delete('b2c_markup_info', $where)) 


		{


			return true;


		} 


		else 


		{


			return false;


		}


		


	}


	


	public function get_b2c_flight_booking_summary() 


	{


        $this->db->select('fr.*,fp.*')


                ->from('flight_booking_reports fr')


                ->join('flight_booking_passengers fp', 'fr.AirlinersRefNo = fp.AirlinersRefNo')				


				->where('fr.agent_id', 0)


                ->order_by('fr.report_id', 'DESC')


				->group_by('fp.AirlinersRefNo');


        $query = $this->db->get();





        if ($query->num_rows > 0) 


		{


            return $query->result();


        }





        return false;


		


    }


	


	 public function get_b2c_hotel_booking_summary() 


	 {


        $this->db->select('hr.*,hh.city as hotel_city,hh.*,hp.*')


                ->from('hotel_booking_reports hr')


                ->join('hotel_booking_hotels_info hh', 'hr.AL_RefNo = hh.AL_RefNo')


				->join('hotel_booking_passengers_info hp', 'hr.AL_RefNo = hp.AL_RefNo')				


				->where('hr.agent_id', 0)                


                ->order_by('hr.report_id', 'DESC')


				->group_by('hp.AL_RefNo');


        $query = $this->db->get();





        if ($query->num_rows > 0) 


		{


            return $query->result();


        }





        return false;


    }


	


	public function get_b2c_car_booking_summary() 


	{


        $this->db->select('cr.*,cp.*')


                ->from('car_booking_reports cr')


                ->join('car_booking_passengers cp', 'cr.AirlinersRefNo = cp.AirlinersRefNo')			


				->where('cr.agent_id', 0)


                ->order_by('cr.report_id', 'DESC')


				->group_by('cp.AirlinersRefNo');


        $query = $this->db->get();





        if ($query->num_rows > 0) 


		{


            return $query->result();


        }





        return false;


		


    }


	


	public function get_hotel_country_list()


   	{   


		$this->db->select('country_name')


				->from('roomsxml_city_list')


				->group_by('country_name');


		$query = $this->db->get();





      	if($query->num_rows > 0 ) 


		{      


         	return $query->result();


      	}


		


      	return false;


   }


   


   public function get_hotel_city_list()


   {   


		$this->db->select('region_name')


				->from('roomsxml_city_list');


				

		$query = $this->db->get();





      	if($query->num_rows > 0 ) 


		{      


         	return $query->result();


      	}


		


      	return false;


   }


   


   public function get_flight_country_list()


   {   


		$this->db->select('airport_country as country_name')


				->from('airport_list')


				->group_by('airport_country');


		$query = $this->db->get();





      	if($query->num_rows > 0 ) 


		{      


         	return $query->result();


      	}


		


      	return false;


   }


   


   public function get_flight_city_list()


   {   


		$this->db->select('airport_city as city_name')


				->from('airport_list')


				->group_by('airport_city');


		$query = $this->db->get();





      	if($query->num_rows > 0 ) 


		{      


         	return $query->result();


      	}


		


      	return false;


   }


   


   public function get_airlines_list()


   {   


		$this->db->select('airline_name')


				->from('airlines_list')


				->group_by('airline_name');


		$query = $this->db->get();





      	if($query->num_rows > 0 ) 


		{      


         	return $query->result();


      	}


		


      	return false;


   }


   


   public function get_currency_list()


   {   


		$this->db->select('currency_code,currency_name')


				->where('status',1)


				->from('currency');


		$query = $this->db->get();





      	if($query->num_rows > 0 ) 


		{      


         	return $query->result();


      	}


		


      	return false;


   }

   public function manage_markup_status($user_id, $status) {
        $data['status'] = $status;
        $where = "id = '$user_id'";
        if ($this->db->update('b2c_markup', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }
    
    function add_markup($domFlight,$IntFlight,$hotel,$car,$package,$sightseen)
    {
        $check = $this->db->query($sql="select * from admin_markup where module_type='b2c'");
        if($check->num_rows() > 0)
        {
            $this->db->query($sql = "update admin_markup set InternationalFlights='".$IntFlight."',DomesticFlights='".$domFlight."',Hotels='".$hotel."',Cars='".$car."',Sightseen='".$sightseen."',Packages='".$package."' where module_type='b2c'");
        }
        else
        {
            $this->db->query($sql = "insert into admin_markup set module_type='b2c',InternationalFlights='".$IntFlight."',DomesticFlights='".$domFlight."',Hotels='".$hotel."',Cars='".$car."',Sightseen='".$sightseen."',Packages='".$package."'");
        }
        return true;
    }
	

    ################################ NEW CODE ###########################################
    
    function getB2cFlightMarkupList(){
        $query = $this->db->query($sql = "select * from b2c_markup_list order by airline_name asc");
        if($query->num_rows() > 0){
            $data = $query->result();
            return $data;
        }
        else{
            return '';
        }
    }
    
    function getFlightMarkupOnId($id){
        $query = $this->db->query($sql = "select * from b2c_markup_list where id='".$id."'");
        if($query->num_rows() > 0){
            $data = $query->row();
            return $data;
        }
        else{
            return '';
        }
    }
     
    function updateFlightMarkup($markup_id,$twoer_code,$yq,$discount,$discount_to_user,$discount_type,$from_date,$to_date){
        $this->db->query($sql = "update b2c_markup_list set tower_code='".$twoer_code."', yq='".$yq."',discount='".$discount."',discount_to_b2c='".$discount_to_user."',discount_type='".$discount_type."',from_date='".$from_date."',to_date='".$to_date."' where id='".$markup_id."'");
    }


		


}




