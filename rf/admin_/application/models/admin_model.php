<?php

class Admin_Model extends CI_Model {
	
	public function __construct()
    {
	
      parent::__construct();
    }
	public function get_domain_list()
   	{
   
		$this->db->select('*')
		->from('domain')
		->join('admin', 'domain.domain_id  = admin.domain')
		->group_by('domain_name');
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
   public function get_admin_list()
   	{
   
		$this->db->select('*')
		->from('admin_login');
		#->where('usertype', 1);
		#->join('domain', 'domain.domain_id  = admin_login.domain', 'left');
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
    public function get_currency_list()
   	{
   
		$this->db->select('*')
		->from('currency_converter');
		
		
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
   
   function getCurrencyData($id)
	{
		
		$this->db->select('*')
		->from('currency_converter')
		->where('cur_id',$id);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;	
		}
	}
	
	function deleteCurrencyData($id){
		
		
		$where = "cur_id = $id";
		if ($this->db->delete('currency_converter', $where)) {
			return true;
		} else {
			return false;
		}
	}
	
	function add_currency($currency,$value,$code,$name)
   {
	   	$data = array(
		'country' => $currency,
		'value' => $value,
		'country_code'=>$code,
		'currency_name'=>$name
		
		);
			
		$this->db->set('date_time', 'NOW()', FALSE); 
		
		$this->db->insert('currency_converter', $data);
		$id = $this->db->insert_id();
		if (!empty($id)) {				
			return true;
		} else {
			return false;
		}
   }
     function update_admin_password(  $password='',$id)
	{
	
	
		if (!empty($password)) {
			
			$data['password'] = $password;	
			$where = "user_id = '".$id."'";
		if ($this->db->update('admin', $data, $where)) {
		//	echo $this->db->last_query();exit;
			return true;
		} else {
			return false;
		}		
		}
			
		else {
			return false;
		}

	}
     public function get_admin_list_id($id)
   	{
   
		$this->db->select('*')
		->from('admin')
		->where('usertype', 1)
		->where('user_id', $id)
		->join('domain', 'domain.domain_id  = admin.domain', 'left');
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }
   function update_admin_profile( $firstname,  $email, $contact_no, $address, $id)
	{
	
		$data = array(
			'firstname' => $firstname,
		
			'email' => $email,
			'contact_no' => $contact_no,
			'address' => $address
			);
		
		
			
			$where = "user_id = ".$id;
		if ($this->db->update('admin', $data, $where)) {
			return true;
		} else {
			return false;
		}

	}
     public function check_admin_login($id)
   	{
   
		$this->db->select('*')
			->from('admin')
            ->where('domain', $id)
			->where('usertype', 1)
			->where('status', 1)
			->join('domain', 'domain.domain_id  = admin.domain', 'left')
			->limit(1);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }
   
   
   function add_new_admin($name,$pw3,$email3,$address,$phone,$domain){
	   	$data = array(
		'firstname' => $name,
		'password' => $pw3,
		'email' => $email3,
		'address' => $address,
		'contact_no' => $phone,
		'domain' => $domain,
		'usertype' => '1',
		'status' => '1',
		'last_visit_date' => ''
		);
			
		$this->db->set('register_date', 'NOW()', FALSE); 
		
		$this->db->insert('admin', $data);
		return $this->db->insert_id();
		// if (!empty($id)) {				
		// 	return true;
		// } else {
		// 	return false;
		// }
   }

/*
@author: Vikas Arora ************
@Description: Emaqil module******
******************Start***************
*/


   	public function get_all_email_data()
	{
	    $this->db->select('*');
	    $this->db->from('email_template');

	    $query = $this->db->get();
	    if($query->num_rows() > 0)
	    {
	        return $query->result();
	    }    
	    else 
	    {
	        return '';
	    }     

	}

	public function get_single_email_details($id)
    {
        $this->db->select('*');
        $this->db->from('email_template');
        $this->db->where('id',$id);
   
        $query = $this->db->get();
        if($query->num_rows() > 0)
        { 
            return $query->row();
        }    
        else 
        {
            return '';
        }     
    }

    public function update_email($id, $data)
    {
        $this->db->where('id',$id);
        $this->db->update('email_template',$data);
        return true;
    }

    public function fetch_email_template($id)
    {
        $this->db->select('message');
        $this->db->from('email_template');
        $this->db->where('id', $id);

        $query = $this->db->get();
        if($query->num_rows() > 0)
        { 
            return $query->row();
        }    
        else 
        {
            return '';
        }     
    }

    public function addHomeSettings($values,$id){
		if($id){
			$this->db->trans_start();
			$this->db->update('homepage_settings', $values, "id = $id");
			$this->db->trans_complete();
			return $this->db->trans_status();
		}else{
			$this->db->insert('homepage_settings', $values);
			return $this->db->insert_id();
		}
    }
    public function getHomeSettings(){
		$query = $this->db->get('homepage_settings', 1, 0);
		return $query->row();
    }

    public function change_admin_status($id, $status) {
    	$data = array('status'=>$status);
    	$this->db->where('user_id', $id);
    	$this->db->update('admin', $data);
    	return true;
    }

    public function getbackgroundimage(){
    	
    	$this->db->select('*')
		->from('homepage_settings');
		$query = $this->db->get();
	      	
		 return $query->result();
	      
    }


    public function social_linksupdate($values,$id){
		if($id){
			$this->db->trans_start();
			$this->db->update('social_links', $values, "id = $id");
			$this->db->trans_complete();
			return $this->db->trans_status();
		}
    }
    public function getsocial_links(){
		$query = $this->db->get('social_links', 1, 0);
		return $query->row();
    }

/**************End of Email Module********************/
		
}

