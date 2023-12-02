<?php

class Deposit_Model extends CI_Model {
	
	public function __construct()
    {
	
      parent::__construct();
    }
		function agent_deposit_details($agent_id)
	{
		$select = "SELECT *, date_format(deposited_date, '%d/%m/%Y') as deposited FROM b2b_deposit WHERE agent_id = $agent_id";
		
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
	}
	function get_deposit_details($id)
	{
		$select = "SELECT *, date_format(deposited_date, '%d/%m/%Y') as deposited FROM b2b_deposit WHERE deposit_id = $id";
		
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;	
		}
	}
	function agent_deposit_details_overall()
	{
		$select = "SELECT *, date_format(deposited_date, '%d/%m/%Y') as deposited FROM b2b_deposit";
		
		$query=$this->db->query($select);
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} else {
			return false;	
		}
	}
	function add_agent_deposit($agent_id, $amount_credit, $deposited_date, $remarks)
	{
		$select2 = "select max(deposit_id)+1 as max from b2b_deposit";
		$query=$this->db->query($select2);
		$aa = $query->row();
		$m_id1 = 0;
		if($aa!='')
		{
			$m_id1=  $aa->max;
		}
		
		$m_id =  'AT'.date('d').date('m').($m_id1+10000);
	
		$data = array(
			'agent_id' => $agent_id,
			'amount_credit' => $amount_credit,
			'deposited_date' => $deposited_date,
			'remarks' => $remarks,
				'transaction_id' => $m_id,
			
			'status' => 'Accepted'
		);
			
		$this->db->insert('b2b_deposit', $data);
		$id = $this->db->insert_id();
		if (!empty($id)) {
			// Update Agent Acc info
			$select = "SELECT agent_acc_info_id FROM  b2b_acc_info where agent_id = $agent_id limit 1";
			//echo $select;exit;
			$query=$this->db->query($select);
			if ($query->num_rows() > 0)
			{
				$qry = "update b2b_acc_info set balance_credit = (balance_credit + $amount_credit), last_credit = $amount_credit where agent_id = $agent_id";

			} else {
				$qry = "insert into  b2b_acc_info set agent_id = $agent_id, balance_credit = $amount_credit, last_credit = $amount_credit";
			}
			//echo $qry;exit;
			$query=$this->db->query($qry);
			////////////////////////////////////////////////////
			$select2 = "SELECT * FROM  b2b_acc_info where agent_id = $agent_id limit 1";
			//echo $select;exit;
			$query2=$this->db->query($select2);
			if ($query2->num_rows() > 0)
			{
				$am_result = $query2->row();
	
				$description='Deposit - : '.$m_id;
			
					$account_transaction = array(
						'statment_type' => 'DEPOSIT',
						'tranx_number' => $m_id,
						'user_type' => '2',
						'user_id' => $agent_id,
						'amount' => $amount_credit,
						'balance_amount' => $am_result->balance_credit,
						'description' => $description
					);
					$this->db->insert('account_statment',$account_transaction); 
					$bid = $this->db->insert_id();
					$timing = date('Ymd');
					$timing1 = date('His');
					$txno = 'TX'.$timing.$bid.$timing1;
								$update_account = array(
									'statment_number' => $txno
								);
								
					$this->db->where('account_statment_id',$bid);
					
					$this->db->update('account_statment', $update_account);
			}
			
		////////////////////////////////////////
		
			
			return $id;
			
			
			
		} else {
			return false;
		}

	}
	function update_deposit_status($id,$status,$agent_id,$amount_credit)
	{
			if($status=='Accepted')
			{
				$qry = "update b2b_acc_info set balance_credit = (balance_credit + $amount_credit), last_credit = $amount_credit where agent_id = $agent_id";

				$query=$this->db->query($qry);
				$select2 = "SELECT * FROM  b2b_deposit where deposit_id = $id limit 1";
					//echo $select;exit;
					$query2=$this->db->query($select2);
					if ($query2->num_rows() > 0)
					{
						$am_result = $query2->row();
					
						$description='Deposit - : '.$am_result->transaction_id;
							$select3 = "SELECT * FROM  b2b_acc_info where agent_id = $agent_id limit 1";
					//echo $select;exit;
					$query3=$this->db->query($select3);
					if ($query3->num_rows() > 0)
					{
						$am_result3 = $query3->row();
						
							$account_transaction = array(
								'statment_type' => 'DEPOSIT',
								'tranx_number' => $am_result->transaction_id,
								'user_type' => '2',
								'user_id' => $agent_id,
								'amount' => $amount_credit,
								'balance_amount' => $am_result3->balance_credit,
								'description' => $description
							);
							$this->db->insert('account_statment',$account_transaction); 
							$bid = $this->db->insert_id();
							$timing = date('Ymd');
							$timing1 = date('His');
							$txno = 'TX'.$timing.$bid.$timing1;
									$update_account = array(
											'statment_number' => $txno
											);
							$this->db->where('account_statment_id',$bid);
							$this->db->update('account_statment', $update_account);
					}
					}
			}
			$data = array(
				'status' => $status
				
				);
				$where = "deposit_id = ".$id;
				$this->db->update('b2b_deposit', $data, $where);
				
				return true;
	}

	
	
}

