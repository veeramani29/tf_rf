<?php

class Markup extends CI_Model {
	
	public function __construct(){
	     parent::__construct();
  }

// B2C Markup Starts Here

  function fetch_markups(){
  //  $this->db->join('country','country.country_id = markup_b2c.country_id',  'left');
   // $this->db->join('api','api.api_id = markup_b2c.api_id',  'left');
    return $this->db->get('markup_b2c');
  }

  function delete_markup($id){
    $this->db->delete('markup_b2c', array('markup_id' => $id)); 
  }
    
  function add_markup_b2c($data){  
    $this->db->insert('markup_b2c', $data); 
  }

  function add_markup_b2c_geo($data){
  
    $this->db->insert('markup_b2c',$data);
  }

  function get_countries_filtered(){
    $countries = array();
    $data = $this->db->get('markup_b2c')->result();
    foreach ($data as $value) {
      $countries[] = $value->country_id;
    }
    //echo '<pre>';print_r($countries);
    $this->db->where_not_in('country_id', $countries);
    return $this->db->get('country')->result();
  }

  function get_b2c_markup_by_id($id,$type){
    if($type == '1'){
      $this->db->select('api.api_name as a, markup_b2c.markup, markup_b2c.markup_id');
      $this->db->where('markup_b2c.markup_id', $id);
      $this->db->join('api','api.api_id = markup_b2c.api_id');
    }else{
      $this->db->select('country.name as a, markup_b2c.markup, markup_b2c.markup_id');
      $this->db->where('markup_b2c.markup_id', $id);
      $this->db->join('country','country.country_id = markup_b2c.country_id',  'left');
    }
    return $this->db->get('markup_b2c');
  }


  function GetMarkupById($id){
    $this->db->where('markup_b2c.markup_id', $id);
    return $this->db->get('markup_b2c');
  }
  function update_markup_b2c($id,$data){
  
      $this->db->where('markup_id',$id);
      $this->db->update('markup_b2c', $data); 
  }
  
// B2C Markup Ends Here

// B2B Markup Starts Here

  function fetch_markups_b2b(){
 //   $this->db->join('b2b','b2b.agent_id = markup_b2b.agent_id', 'left');
 //   $this->db->join('api','api.api_id = markup_b2b.api_id', 'left');
  // return $this->db->get('markup_b2b');
    

	$sql="select m.*, a.*, c.name as countryy,b.agent_id, b.name as bname from markup_b2b as m LEFT JOIN api as a on m.api_id=a.api_id 
			LEFT JOIN country as c on m.country=c.country_id
			LEFT JOIN b2b as b on m.agent_id=b.agent_id";
			$qur=$this->db->query($sql);
			if($qur->num_rows()>0)
			{
			return $qur->result();	
			}
  
  }
  
    function fetch_markups_b2c(){
 //   $this->db->join('b2b','b2b.agent_id = markup_b2b.agent_id', 'left');
 //   $this->db->join('api','api.api_id = markup_b2b.api_id', 'left');
  // return $this->db->get('markup_b2b');
    

	$sql="select m.*, a.*, c.name as countryy from markup_b2c as m LEFT JOIN api as a on m.api_id=a.api_id 
			LEFT JOIN country as c on m.country=c.country_id";
			$qur=$this->db->query($sql);
			if($qur->num_rows()>0)
			{
			return $qur->result();	
			}
  
  }

  function fetch_markup_b2c(){
    return $this->db->get('markup_b2c');
  }

  function fetch_markup_b2b(){
    $this->db->select('markup_b2b.markup_id, markup_b2b.markup_type, markup_b2b.markup, markup_b2b.product, markup_b2b.agent_id, b2b.company_name, b2b.firstname');
    $this->db->join('b2b','b2b.agent_id = markup_b2b.agent_id', 'left');
    return $this->db->get('markup_b2b');
  }
  

  
  

  function add_markup_b2b($data){
    
    $this->db->insert('markup_b2b', $data); 
  }

  function get_agents_filtered(){
    $agents = array('');
    $data = $this->db->get('markup_b2b')->result();
    foreach ($data as $value) {
      $agents[] = $value->agent_id;
    }
    //echo '<pre>';print_r($countries);
    $this->db->where_not_in('agent_id', $agents);
    return $this->db->get('b2b')->result();
  }

  function add_markup_b2b_agent($data){
    
    $this->db->insert('markup_b2b',$data);
  }

  function delete_markup_b2b($id){
    $this->db->delete('markup_b2b', array('markup_id' => $id)); 
  }

  function get_b2b_markup_by_id($id,$type){
    if($type == '1'){
      $this->db->select('markup_b2b.markup_id, markup_b2b.markup_type, markup_b2b.markup, markup_b2b.product');
    }else if($type == '2'){
      $this->db->select('markup_b2b.markup_id, markup_b2b.markup_type, markup_b2b.markup, markup_b2b.product, markup_b2b.agent_id, b2b.company_name, b2b.firstname');
      $this->db->join('b2b','b2b.agent_id = markup_b2b.agent_id', 'left');
    }
    $this->db->where('markup_id', $id);
    return $this->db->get('markup_b2b');
  }


 // function get_b2b_markup_by_id($id){
 	
 // 	  	$sql="select m.*, a.*, c.name as countryy,b.agent_id, b.name as bname from markup_b2b as m LEFT JOIN api as a on m.api_id=a.api_id 
	// 		LEFT JOIN country as c on m.country=c.country_id
	// 		LEFT JOIN b2b as b on m.agent_id=b.agent_id where m.markup_id='$id'";  
	// 		$qur=$this->db->query($sql);
	// 		if($qur->num_rows()>0)
	// 		{
	// 		return $qur->row();	
	// 		}
 	
 // 	}
 	
  function update_markup_b2b($id,$data){
      
      $this->db->where('markup_id',$id);
      $this->db->update('markup_b2b', $data); 
  }
  
  
  function fetch_agents(){
    $qur=$this->db->get("b2b");
  	return $qur->result();
  }
  
  function fetch_countries()
  {
   $qur=$this->db->get("country");
  	return $qur->result();
  }
  
   function fetch_api()
  {
   $qur=$this->db->get("api");
  	return $qur->result();
  }
  
     function add_markup_chk($agent,$country,$api)
       {  
        $this->db->where('agent_id', $agent);
  		  $this->db->where('country', $country);
        $this->db->where('api_id', $api);
        
  		  $qur=$this->db->get('markup_b2b');
  		 //print_r($qur);
  		  return $qur->num_rows();
  	 	}
  		 	
  		 function add_spe_markup_chk($age,$country,$api)
       {
       
  		  $this->db->where('agent_id', $age);
  		  $this->db->where('country', $country);
        $this->db->where('api_id', $api);
        $qur=$this->db->get('markup_b2b');
          return $qur->num_rows();
  		 	}
  		 	
  		 	
  		 function b2c_markup_chk($api)
       {  
   
  		 
        $this->db->where('api_id', $api);
        
  		  $qur=$this->db->get('markup_b2c');
  		 //print_r($qur);
  		  return $qur->num_rows();
  		  
  		 	}
  		 	
  		function save_markup_spe($data)
		{
		$this->db->insert('markup_b2c', $data);		
		}
		
		
	    function  b2c_spe_markup_chk($country,$api)
       { 
        $this->db->where('country', $country);
        $this->db->where('api_id', $api);
        $qur=$this->db->get('markup_b2c');
          return $qur->num_rows();
  		 }
  		 
  		 
  		  function b2c_markup_by_id($id){
 	
 	   	$sql="select m.*, a.*, c.name as countryy from markup_b2c as m LEFT JOIN api as a on m.api_id=a.api_id 
			LEFT JOIN country as c on m.country=c.country_id where m.markup_id='$id'";  
			$qur=$this->db->query($sql);
			if($qur->num_rows()>0)
			{
			return $qur->row();	
			}
 	
 	}

  public function get_all_airlines()
  {
    $AirlinesList = $this->db->get('airlines_list');
    return $AirlinesList->result();
  }

  public function get_all_airlines_codes($AllAirlines,$ExceptAirlines)
  {
    $this->db->select('airline_code');
    $AirlinesList = $this->db->get('airlines_list');
    $AirlinesList = $AirlinesList->result();
    $FinalAirlines = array();
    if ($AllAirlines == 'Y') {
      foreach($AirlinesList as $Airline) {
        $FinalAirlines[] = $Airline->airline_code;
      }
    }
    else {
      foreach($AirlinesList as $Airline) {
        if(in_array($Airline->airline_code, $ExceptAirlines)) {
          
        }else{
          $FinalAirlines[] = $Airline->airline_code;
        }
      }
    }
    return $FinalAirlines;
  }

  public function SaveB2CMarkUp($B2CMarkup)
  {
    $this->db->insert('B2CMarkupDiscount', $B2CMarkup);
  }

  public function UpdateB2CMarkUp($MDId,$B2CMarkup)
  {
    $this->db->where('MDId',$MDId);
    $this->db->update('B2CMarkupDiscount', $B2CMarkup);
    // echo $this->db->last_query();exit;
  }

  public function fetch_B2CMarkup()
  {
    $this->db->order_by('MDId','Desc');
    $B2CMarkups = $this->db->get('B2CMarkupDiscount');
    return $B2CMarkups->result();
  }  

  public function UpdateB2CMarkupStatus($MId,$data)
  {    
    $this->db->where('MDId',$MId);
    $this->db->update('B2CMarkupDiscount', $data); 
  }

  public function DeleteB2CMarkup($MId)
  {    
    $this->db->delete('B2CMarkupDiscount', array('MDId' => $MId)); 
  }

  public function MDDetail($MarkupDiscountId)
  {
    $this->db->where('MDId',$MarkupDiscountId);
    return $this->db->get('B2CMarkupDiscount')->row();
  }
}

