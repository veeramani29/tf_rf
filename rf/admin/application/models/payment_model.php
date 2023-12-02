<?php

class Payment_Model extends CI_Model {
	
	public function __construct(){
	     parent::__construct();
  }

// B2C Markup Starts Here

  function fetch_charges(){
   // $this->db->join('country','country.country_id = payment_gateway_charges.country_id',  'left');
    $this->db->join('product','product.product_id = payment_gateway_charges.api_id',  'left');
    return $this->db->get('payment_gateway_charges');
  }

  function delete_charges($id){
    $this->db->delete('payment_gateway_charges', array('markup_id' => $id)); 
  }
  
  public function get_api_filtered(){
      $apis = array('');
      $data = $this->db->get('payment_gateway_charges')->result();
      foreach ($data as $value) {
        $apis[] = $value->api_id;
      }
      $this->db->where_not_in('api_id', $apis);
      return $this->db->get('api')->result();
  }
  
  
   
  
  

  function add_charges(){
    $api = $this->input->post('api');
    $mark_up = $this->input->post('markup');
    $data= array(
             'markup'=>$mark_up,
             'country_id'=>0,
             'api_id'=>$api
    );
    $this->db->insert('payment_gateway_charges', $data); 
  }
  
 

  function add_charges_geo(){
    $country = $this->input->post('country');
    $markup = $this->input->post('markup');
    
    $data= array(
        'markup'=>$markup,
        'country_id'=>$country,
        'api_id'=>0
    );
    $this->db->insert('payment_gateway_charges',$data);
  }

  function get_countries_filtered(){
    $countries = array();
    $data = $this->db->get('payment_gateway_charges')->result();
    foreach ($data as $value) {
      $countries[] = $value->country_id;
    }
    //echo '<pre>';print_r($countries);
    $this->db->where_not_in('country_id', $countries);
    return $this->db->get('country')->result();
  }

  function get_charges_by_id($id,$type){
    if($type == '1'){
      $this->db->select('product.product_name as a, payment_gateway_charges.markup, payment_gateway_charges.markup_id');
      $this->db->where('payment_gateway_charges.markup_id', $id);
      $this->db->join('product','product.product_id = payment_gateway_charges.api_id');
    }else{
      $this->db->select('country.name as a, payment_gateway_charges.markup, payment_gateway_charges.markup_id');
      $this->db->where('payment_gateway_charges.markup_id', $id);
      $this->db->join('country','country.country_id = payment_gateway_charges.country_id',  'left');
    }
    return $this->db->get('payment_gateway_charges');
  }
    
  function update_charges($id,$markup){
      $data = array(
        'markup' => $markup
      );
      $this->db->where('markup_id',$id);
      $this->db->update('payment_gateway_charges', $data); 
  }
  
  
   function save_service_charges($data)
    {
      $this->db->insert('service_charges', $data); 
    }
    
  function get_service_charges()
  {
	$sql="select s.*, a.* from service_charges as s INNER JOIN product as a on s.api_id=a.product_id";
	$qur=$this->db->query($sql);  
	 return $qur->result();
  }
  function get_apart_service_charges()
  {
	$sql="select * from service_charges";
	$qur=$this->db->query($sql);  
	 return $qur->result();
  }
    function delete_service_charge($id){
    $this->db->delete('service_charges', array('charge_id' => $id)); 
  }
  
  function get_service_charges_by_id($eid)
  { 
    $sql="select s.*, a.* from service_charges as s INNER JOIN product as a on s.api_id=a.product_id where charge_id='$eid'";
	$qur=$this->db->query($sql);  
	 return $qur->row();
  }
   function get_pay_service_charges_by_id($eid)
  { 
    $sql="select * from service_charges where charge_id='$eid'";
	$qur=$this->db->query($sql);  
	 return $qur->row();
  }
  
  function update_charge($data,$id)
  {
	$this->db->where('charge_id',$id);
	$this->db->update('service_charges', $data);  
  }
  
    public function get_api_filtered_service(){
      $apis = array('');
      $data = $this->db->get('service_charges')->result();
      foreach ($data as $value) {
        $apis[] = $value->api_id;
      }
      $this->db->where_not_in('api_id', $apis);
      return $this->db->get('api')->result();
  }
// B2C Markup Ends Here
  
  public function get_products(){
	$this->db->select("*");
        $this->db->from('product');
        return $this->db->get()->result();
  }
  public function isServiceExists($id){
	$this->db->select("*");
	 $this->db->where('api_id',$id);
	$qur=$this->db->get('service_charges');
	if($qur->num_rows()>0){
        	return $qur->row();
	}
	return array();
	
  }

  public function isPaymentProductExists($id){
	$this->db->select("*");
	 $this->db->where('api_id',$id);
	$qur=$this->db->get('payment_gateway_charges');
	if($qur->num_rows()>0){
        	return $qur->row();
	}
	return array();
	
  }


}

