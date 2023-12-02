<?php

class Payment_Model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
    }
	public function validate_order_id($order_id){
		$this->db->where('parent_pnr',$order_id);
		$this->db->where('transaction_status','PROCESS');
		return $this->db->get('booking_global');
	}
	
	public function validate_order_id_org($order_id){
		$this->db->where('parent_pnr',$order_id);
		return $this->db->get('booking_global');
	}

	public function validate_order_id_v1($order_id){
		$this->db->where('parent_pnr',$order_id);
		//$this->db->where("(payment_status=5 OR payment_status=9 )");
		$this->db->where('payment_status','5');
		return $this->db->get('booking_global');
	}
	public function update_transaction($order_id,$transaction){
		$this->db->where('parent_pnr',$order_id);
		$this->db->update('booking_global',$transaction);
	}

}

