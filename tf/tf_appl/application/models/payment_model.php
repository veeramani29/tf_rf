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
		//$this->db->where('payment_status','5');
		$this->db->where("(payment_status=5 OR payment_status=9 )");
		return $this->db->get('booking_global');
	}
	public function update_transaction($order_id,$transaction){
		$this->db->where('parent_pnr',$order_id);
		$this->db->update('booking_global',$transaction);
	}
	public function update_loayalty($order_id){
		$BookingDetail = $this->validate_order_id_org($order_id);
		$BookingDetail = $BookingDetail->row();
		$PnrNo = $BookingDetail->pnr_no;
		$this->db->where('BookingId',$PnrNo);
		$LoyalTransaction = $this->db->get('LoyaltyPointsStatement');
		$LoyalTransaction = $LoyalTransaction->row();
		$NWERTransactionType = $LoyalTransaction->TransactionType;
		$PointsInTransaction = $LoyalTransaction->Points;
		if($this->session->userdata('b2c_id')){
            $user_type = 3;
            $user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $user_type = 2;
            $user_id = $this->session->userdata('b2b_id');
        }
        else{
			 $user_type = 0;
			 $user_id = 0;
        }
        $this->db->where('user_id',$user_id);
        $this->db->where('UserType',$user_type);
        $UserLoyalty = $this->db->get('user_loyalty_info');
        $UserLoyaltyNum = $UserLoyalty->num_rows();
        if($UserLoyaltyNum == 1){
	        $UserLoyaltyRow = $UserLoyalty->row();
	        $PreviousBalance = $UserLoyaltyRow->balance_points;
	        
	        // Update Balance
	        if($NWERTransactionType == 'CREDIT'){
		        $UpdateBalance = array(
		        		'balance_points'=> $PreviousBalance+$PointsInTransaction,
		        		'last_credit' => $PointsInTransaction
		        );	        
		    }elseif($NWERTransactionType == 'DEBIT'){
		        $UpdateBalance = array(
		        		'balance_points'=> ($PreviousBalance-$PointsInTransaction)+$LoyalTransaction->currPoints,
		        		'last_credit' => $LoyalTransaction->currPoints,
		        		'last_debit' => $PointsInTransaction
		        );	        
		    }
	        $this->db->where('user_id',$user_id);
	        $this->db->where('UserType',$user_type);
			$this->db->update('user_loyalty_info',$UpdateBalance);
			// echo $this->db->last_query();exit;
        }
        else{
        	// Insert Balance
	        if($NWERTransactionType == 'CREDIT'){
	        	$InsertBalance = array(
		        		'user_id'=> $user_id,
		        		'UserType' => $user_type,
		        		'balance_points' => $PointsInTransaction,
		        		'last_credit' => $PointsInTransaction
		        );       
		    }elseif($NWERTransactionType == 'DEBIT'){
	        	$InsertBalance = array(
		        		'user_id'=> $user_id,
		        		'UserType' => $user_type,
		        		'balance_points' => $PointsInTransaction,
		        		'last_debit' => $PointsInTransaction
		        );	        
		    }
			$this->db->insert('user_loyalty_info',$InsertBalance);
        }
		// Committ Loyalty Transaction
		if($NWERTransactionType == 'CREDIT'){
			$CommittTrasaction = array(
	        		'TransactionStatus' => 'CREDITED'
	        );
	    }elseif($NWERTransactionType == 'DEBIT'){
			$CommittTrasaction = array(
	        		'TransactionStatus' => 'DEBITED'
	        );     
	    }
		$this->db->where('BookingId',$PnrNo);
		$this->db->update('LoyaltyPointsStatement',$CommittTrasaction);
	}
}
