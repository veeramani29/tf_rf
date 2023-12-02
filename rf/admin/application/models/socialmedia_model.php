<?php

class Socialmedia_Model extends CI_Model {
	
	public function __construct()
    {
	
      parent::__construct();
    }
    
    function get_social_detail_list()
	   {
	   	$this->db->select('*')
	   	->from('social_access');
		  $query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		      {
        		 return $query->result();
        }
      return false;
	    }
	    
	    
	    	function get_socialmedia_detail_single($id)
	    {
		
			$this->db->select('*')
		->from('social_access')	->where('id', $id);
		
	  	$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		      {
        		 return $query->row();
        }
      return false;
		
		
	   	}
	   	
	  
	   		function update_socialmedia_detail($id,$appkey,$secretkey,$returnurl)
			{
	
   	$data = array(
		'app_key' => $appkey,
		'secret_key' => $secretkey,
		'return_url'=>$returnurl
		  );
	
     $this->db->where('id',$id);
				$this->db->update('social_access', $data);
			
				}
    
 
		
}

