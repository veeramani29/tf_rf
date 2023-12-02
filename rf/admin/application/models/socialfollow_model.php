<?php

class Socialfollow_Model extends CI_Model {
	
	public function __construct()
    {
	
      parent::__construct();
    }
    
    
    public function get_domain_list()
   	{
   
		$this->db->select('*')
		->from('domain');
		
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }  
    function get_social_detail_list()
	   {
	   	$this->db->select('*')
	   	->from('social_follow');
		  $query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		      {
        		 return $query->result();
        }
      return false;
	    }
	
	    	function get_socialfollow_detail_single($id)
	    {
		
			$this->db->select('*')
		->from('social_follow')	->where('follow_id', $id);
		
	  	$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		      {
        		 return $query->row();
        }
      return false;
		
	   	}

	   	function insert_socialfollow_detail($twitter,$facebook,$google,$domain)
	   	{
	   		
	   		 $domain_detail  = $this->get_domain_list_id($domain);
	   		 
	   		  	$data = array(
		     'domain' => $domain,
		      'facebook_url'=>$facebook,
		      'twitter_url'=>$twitter,
		      'google_url'=>$google,
	      	'domain_name' => $domain_detail->domain_name,
		     'domain_url' => $domain_detail->domain_url,
		      'status'=>'1'
		      );
			
	
		$this->db->insert('social_follow', $data);
  	return true;	
	 
	   		}
	 
	   		function update_socialfollow_detail($id,$facebook,$twitter,$google)
			{
	
   	$data = array(
		'facebook_url' => $facebook,
		'twitter_url' => $twitter,
		'google_url'=>$google
		  );
	
     $this->db->where('follow_id',$id);
				$this->db->update('social_follow', $data);
			
				}
				
				public function get_domain_list_id($id)
   	{
   
		$this->db->select('*')
		->from('domain')->where('domain_id',$id);
		
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }  
 
		
}

