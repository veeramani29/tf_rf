<?php
 

class Apartment_Model extends CI_Model {
	
	public function __construct()
    {
	
      parent::__construct();
    }
    
     
    function get_flat_info()
    {
   
   	$sql="select a.*, t.apartment_type_id, t.*,r.*, d.* from apartment_info as a 
    	INNER JOIN apartment_type as t on a.apartment_type_id=t.apartment_type_id 
    	INNER JOIN room_type as r on a.room_type=r.room_id 
    	INNER JOIN address_info as d on a.address=d.add_id";
    	
    	
  		 $query= $this->db->query($sql);
	    if($query->num_rows()>0)
    	 
        	{
                return $query->result();
        	}
    		} 
 
    	
    	 function get_flat($pid)
    {
    	
    	$sql="select a.*, t.apartment_type_id, t.*,r.*, d.* from apartment_info as a 
    	INNER JOIN apartment_type as t on a.apartment_type_id=t.apartment_type_id 
    	INNER JOIN room_type as r on a.room_type=r.room_id 
    	INNER JOIN address_info as d on a.address=d.add_id
    	where a.address='$pid'";
    	
    	
  		 $query= $this->db->query($sql);
	    if($query->num_rows()>0)
    	 
        	{
                return $query->row();
        	}
      } 
    	
    	
    	function get_admin_animities($pid)
      {
    	$sql="select a.*,l.* from admin_amenities  as a INNER JOIN amenities_list as l  on a.amenitie_id=l.amenitie_id where a.add_id='$pid'";
    	
  		 $query= $this->db->query($sql);
	    if($query->num_rows()>0)
    	 
        	{
                return $query->result();
        	}
   	  }
    	
    
    function get_apartment_types()
    {
    		$id=1;
      $this->db->select('*');
		$this->db->from('apartment_type');
      $this->db->where('others', $id);
		$query = $this->db->get();

      if ( $query->num_rows > 0)
         
       {
       return  $result =$query->result();
      }
    }
      function get_apartment_invoice_details()
    {
    		
      $this->db->select('*');
		$this->db->from('apartment_invoice');
      $this->db->where('apartment_invoice_id', '1');
		$query = $this->db->get();

      if ( $query->num_rows > 0)
         
       {
       return  $result =$query->row();
      }
    }
    
    function get_amenities_common()
    {	
    	$id=1;
    $this->db->select('*');
    $this->db->from('amenities_list') ;
    $this->db->where('amenite_cat_id', $id);
    $qur1=$this->db->get();
    if($qur1->num_rows > 0)
    {
    	 $result=$qur1->result();
    }
    return $result;
    }
    
    
function get_amenities_extra()
    {
    	$id=2;
    $this->db->select('*');
    $this->db->from('amenities_list') ;
    $this->db->where('amenite_cat_id', $id);
    $qur2=$this->db->get();
    if($qur2->num_rows > 0)
    {
    	return $qur2->result();
    }
    	    	
    	}
    	
    	    
function get_amenities_special()
    {
    	$id=3;
    $this->db->select('*');
    $this->db->from('amenities_list') ;
    $this->db->where('amenite_cat_id', $id);
    $qur3=$this->db->get();
    if($qur3->num_rows > 0)
    {
    	return $qur3->result();
    }
    	    	
    	}
    	
    	    
function get_amenities_home()
    {
    	$id=4;
    $this->db->select('*');
    $this->db->from('amenities_list') ;
    $this->db->where('amenite_cat_id', $id);
    $qur4=$this->db->get();
    if($qur4->num_rows > 0)
    {
    	return $qur4->result();
    }
    	    	
    	}
   
   
   function save_address_info($data1){
   	$this->db->insert('address_info', $data1);
   	return $this->db->insert_id();
   }
   	
   	
function save_amenities_common($ameni,$uid,$role,$last_id)
   {										 
   	 
      $data=array('user_id'=>$uid, 'user_role'=>$role, 'amenitie_id'=>$ameni, 'add_id'=>$last_id);												
      	
      $this->db->insert('admin_amenities', $data);
   	}
  
  
  
   function save_amenities_extra($ameni2,$uid,$role,$last_id)
   {
   	 
      $data2=array('user_id'=>$uid, 'user_role'=>$role, 'amenitie_id'=>$ameni2,  'add_id'=>$last_id);												
      	
      $this->db->insert('admin_amenities', $data2);
   }
   
   
   
     function save_amenities_special($ameni3,$uid,$role,$last_id)
   {
   	 
      $data3=array('user_id'=>$uid, 'user_role'=>$role, 'amenitie_id'=>$ameni3 , 'add_id'=>$last_id);												
      	
      $this->db->insert('admin_amenities', $data3);
   }
   
   
     function save_amenities_home($ameni4,$uid,$role,$last_id)
   {
   	 
      $data4=array('user_id'=>$uid, 'user_role'=>$role, 'amenitie_id'=>$ameni4, 'add_id'=>$last_id);												
      	
      $this->db->insert('admin_amenities', $data4);
   }
   	
   	
   	
   	function save_flat_info($data_flat)
   	{
    		$this->db->insert('apartment_info', $data_flat);
    
      }
      
       function remove_apartment($id)
 		{
 		 
   	 $this->db->delete('apartment_info', array('address' => $id)); 
 		}
 		
 		
 		function get_flat_eid($pid)
 		{
    	
      $this->db->select('*');
		$this->db->from('apartment_type');
      $this->db->where('others', $id);
		$query = $this->db->get();

      if ( $query->num_rows > 0)
         
       {
       return  $result =$query->result();
      }
    }
		
 
 
 
  function get_apartments()
    {
    		//$id=1;
      $this->db->select('*');
		$this->db->from('apartment_type');
    	$query = $this->db->get();

      if ( $query->num_rows > 0)
         
       {
       return  $result =$query->result();
      }
    }
    
    
     function get_room_type()
    {
    		//$id=1;
      $this->db->select('*');
		$this->db->from('room_type');
    	$query = $this->db->get();

      if ( $query->num_rows > 0)
         
       {
       return  $result =$query->result();
      }
    }
    
    
    function get_admin_flat($pid)
	{ 
      $this->db->select('*');
		$this->db->from('apartment_info');
		$this->db->where('address', $pid);
    	$query = $this->db->get();

      if ( $query->num_rows > 0)
         
       {
       return  $result =$query->row();
      }
    }
    
    
    
    
   function upd_basics($post,$id)
   { 
   	 $this->db->where('address', $id);
   	 $this->db->update('apartment_info', $post);
   	{
			return true;
		} 
   } 
   
   
  
   function upd_price($post,$id)
   { 
   	 $this->db->where('address', $id);
   	 $this->db->update('apartment_info', $post);
   	{
			return true;
		} 
   } 
 
 
 	function upd_summary($post,$id)
   { 
   	 $this->db->where('address', $id);
   	 $this->db->update('apartment_info', $post);
   	{
			return true;
		} 
   } 
   
   
     function get_amenitie_id($pid)
    {
   
   	$sql="select amenitie_id from admin_amenities where add_id='$pid'";
    	 $query= $this->db->query($sql);
	    if($query->num_rows()>0)
    	 
        	{
                return $query->result();
        	}
    		} 
    		
 
   
   function del_amenities($id)
	{
 		 
   	 $this->db->delete('admin_amenities', array('add_id' => $id));
   	 return true; 
 	}
  
  
  
  
    function update_amenities($amenite9,$uid,$role,$id)
   {
   	 
 		$post=array('user_id'=>$uid, 'user_role'=>$role, 'amenitie_id'=>$amenite9 , 'add_id'=>$id);												
      	
      $this->db->insert('admin_amenities', $post);
   }
   
   
   
   function get_address($pid)
    {
    	
    		//$id=1;
      $this->db->select('*');
		$this->db->from('address_info');
		$this->db->where('add_id', $pid);
    	$query = $this->db->get();

      if ( $query->num_rows > 0)
         
       {
       return  $result =$query->row();
      }
    }
    
    
 	function udate_address($post,$id)
   {  
   	 $this->db->where('add_id', $id);
   	 $this->db->update('address_info', $post);
   	{
			return true;
		} 
   } 
   
   
   
   function udate_lisiting($post,$id)
   {  
   //echo $id; echo "<pre>";
 // print_r($post); exit();
   	 $this->db->where('address', $id);
   	 $this->db->update('apartment_info', $post);
   	{
			return true;
		} 
   } 
   
   function save_apartment_img($hotelimage,$last_id)
   {
   	$data=array('apartment_photos'=>$hotelimage, 'add_id'=>$last_id);												
      	
      $this->db->insert('apartment_images', $data);
   	}
   	
   	
      function get_apartment_images($pid)
      {
   	$this->db->select('*');
		$this->db->from('apartment_images');
		$this->db->where('add_id', $pid);
    	$query = $this->db->get();
    	//echo $pid;
    //echo "<pre>";	print_r($query); exit();

      if ( $query->num_rows > 0)
         
       {
       return  $result =$query->result();
      }
   	 
   	}
   	
   	
   	
   	   function del_apartmant_pics($id)
	{
 		 
   	 $this->db->delete('apartment_images', array('add_id' => $id));
   	 return true; 
 	}
  
  
  
  
     function update_apartment_img($hotelimage,$id)
   {
   	$data=array('apartment_photos'=>$hotelimage, 'add_id'=>$id);												
      	
      $this->db->insert('apartment_images', $data);
   	}
   	
   	
   	
   	
  function get_country_currency()
      { 
   	$this->db->select('*');
		$this->db->from('currency_converter'); 
		$query = $this->db->get();
    
      if ( $query->num_rows > 0)
         
       {
       return  $result =$query->result();
      }
      
       
   	}


      function save_apt($data)
      {
      	
      $this->db->insert('apartment_type', $data);
      }
      
      
      
      
      function fetch_apartments() 
            { 
   	$this->db->select('*');
		$this->db->from('apartment_type'); 
		$query = $this->db->get();
    
      if ( $query->num_rows > 0)
         
       {
       return  $result =$query->result();
      }
   	}
   	
   	
   	    function get_apt_id($id) 
            { 
   	$this->db->select('*');
		$this->db->from('apartment_type'); 
		$this->db->where('apartment_type_id', $id);
		$query = $this->db->get();
    
      if ( $query->num_rows > 0)
         
       {
       return  $result =$query->row();
      } 
      	}
      	
      	
      	
   function udate_apartment($post,$id)
   {  
     
  		 $this->db->where('apartment_type_id', $id);
   	 $this->db->update('apartment_type', $post);
   	{
			return true;
		} 
   } 
      	
      	
  function remove_apt($id)
 		{
 		 
   	 $this->db->delete('apartment_type', array('apartment_type_id' => $id)); 
 		}
 		
 		
    function fetch_room_type()
          { 
   	$this->db->select('*');
		$this->db->from('room_type'); 
		$query = $this->db->get();
    
      if ( $query->num_rows > 0)
         
       {
       return  $result =$query->result();
      }
   	}
      	
   	
   	
 function add_room($data)
      {
      	
      $this->db->insert('room_type', $data);
      }
  
  
    function remove_room($id)
 		{
 		 
   	 $this->db->delete('room_type', array('room_id' => $id)); 
 		}
 		
 		
 		  function get_room_id($id) 
            { 
   	$this->db->select('*');
		$this->db->from('room_type'); 
		$this->db->where('room_id', $id);
		$query = $this->db->get();
    
      if ( $query->num_rows > 0)
         
       {
       return  $result =$query->row();
      } 
      	}
      	
      	
     function udate_room($post,$id)
  		 {  
     
  		 $this->db->where('room_id', $id);
   	 $this->db->update('room_type', $post);
   	{
			return true;
		} 
   } 
   
   
   
   // AMENITIES FUNCTIONS................
     
       function fetch_amenities()
            {
   
   	$sql="select a.*, t.* from amenities_list as a INNER JOIN apartment_amenities as t on a.amenite_cat_id=t.amenite_cat_id";
    
  		 $query= $this->db->query($sql);
	    if($query->num_rows()>0)
	   
    	 
        	{
                return $query->result();
        	}
    		} 
    		
    	
    	function get_amenitie_cat()
    	 { 
   	$this->db->select('*');
		$this->db->from('apartment_amenities'); 
		$query = $this->db->get();
    
      if ( $query->num_rows > 0)
         
       {
       return  $result =$query->result();
      }
      }
   	 
 	
 		function add_amenitie($data)
      {
       $this->db->insert('amenities_list', $data);
      }
      
      
      
      function fetch_amenitie_id($id) 
       { 
   	$this->db->select('*');
		$this->db->from('amenities_list'); 
		$this->db->where('amenitie_id', $id);
		$query = $this->db->get();
    
      if ( $query->num_rows > 0)
         
       {
       return  $result =$query->row();
      } 
      	}
      	
      	
       function upd_amenitie($post,$id)
  		 {  
     
  		 $this->db->where('amenitie_id', $id);
   	 $this->db->update('amenities_list', $post);
   	{
			return true;
		} 
   } 
   
   
      	
      	
      
      
       function remove_amenitie($id)
 		{
 		 
   	 $this->db->delete('amenities_list', array('amenitie_id' => $id)); 
 		}

    //Property starts

    public function get_properties() {
        //$this->db->join('kigo_owners', 'kigo_properties.PROVIDER_ID = kigo_owners.KIGO_ONWER_ID', 'left');
        return $this->db->get('kigo_properties');
    }

    public function GetUserData($user_type, $user_id){
      if($user_type == '3'){
        $this->db->where('user_id', $user_id);
        return $this->db->get('b2c');
      }else if($user_type == '2'){
        $this->db->where('agent_id', $user_id);
        return $this->db->get('b2b');
      }
    }

    public function getPropertyBookings($prop_id){
      $this->db->join('booking_apartment', 'booking_apartment.ID = booking_global.ref_id');
      $this->db->where('booking_apartment.PROP_ID', $prop_id);
      return $this->db->get('booking_global');
    }

}

