<?php

class Transaction_Model extends CI_Model {

    public function __construct() {

        parent::__construct();
    }

    public function get_transaction_list_new() {

        $this->db->select('booking_apartment.PROP_PHOTO,apartment_transaction.prop_name,apartment_transaction.host_name
		,apartment_transaction.pnr_no
		,booking_global.api_status
		,booking_global.booking_status
		,booking_global.transaction_status
		,apartment_transaction.net_rate
		,apartment_transaction.transaction_id
		,apartment_transaction.payout_status
		,apartment_transaction.payout_host_status
		,apartment_transaction.apt_charge
		,apartment_transaction.booking_amount
		,apartment_transaction.host_charge
		,apartment_transaction.payout_method
		,apartment_transaction.payout_details
		,apartment_transaction.payout_amount
		
		,apartment_transaction.travel_date
		,booking_global.voucher_date')
                ->from('apartment_transaction')
				->join('booking_global', 'booking_global.id  = apartment_transaction.booking_global_id', 'left')
				->join('booking_apartment', 'booking_apartment.ID  = apartment_transaction.booking_apartment_id', 'left')
				->where('apartment_transaction.payout_status','Analyze');
        $query = $this->db->get();

        if ($query->num_rows > 0) 
		{
            return $query->result();
        }
		else
		{
			return '';
		}

    }
	  public function get_transaction_list_pending() {

        $this->db->select('booking_apartment.PROP_PHOTO,apartment_transaction.prop_name,apartment_transaction.host_name
		,apartment_transaction.pnr_no
		,booking_global.api_status
		,booking_global.booking_status
		,booking_global.transaction_status
		,apartment_transaction.net_rate
		,apartment_transaction.transaction_id
		,apartment_transaction.payout_status
		,apartment_transaction.payout_host_status
		,apartment_transaction.apt_charge
		,apartment_transaction.booking_amount
		,apartment_transaction.host_charge
		,apartment_transaction.payout_amount
		,apartment_transaction.payout_method
		,apartment_transaction.payout_details
		
		,apartment_transaction.travel_date
		,booking_global.voucher_date')
                ->from('apartment_transaction')
				->join('booking_global', 'booking_global.id  = apartment_transaction.booking_global_id', 'left')
				->join('booking_apartment', 'booking_apartment.ID  = apartment_transaction.booking_apartment_id', 'left')
				->where('apartment_transaction.payout_status','Process')->or_where('apartment_transaction.payout_status','Deposit');
        $query = $this->db->get();

        if ($query->num_rows > 0) 
		{
            return $query->result();
        }
		else
		{
			return '';
		}

    }
	  public function get_transaction_list_failed() {

        $this->db->select('booking_apartment.PROP_PHOTO,apartment_transaction.prop_name,apartment_transaction.host_name
		,apartment_transaction.pnr_no
		,booking_global.api_status
		,booking_global.booking_status
		,booking_global.transaction_status
		,apartment_transaction.net_rate
		,apartment_transaction.transaction_id
		,apartment_transaction.payout_status
		,apartment_transaction.payout_host_status
		,apartment_transaction.apt_charge
		,apartment_transaction.booking_amount
		,apartment_transaction.host_charge
		,apartment_transaction.payout_amount
		,apartment_transaction.payout_method
		,apartment_transaction.payout_details
		
		,apartment_transaction.travel_date
		,booking_global.voucher_date')
                ->from('apartment_transaction')
				->join('booking_global', 'booking_global.id  = apartment_transaction.booking_global_id', 'left')
				->join('booking_apartment', 'booking_apartment.ID  = apartment_transaction.booking_apartment_id', 'left')
				->where('apartment_transaction.payout_status','Failed');
        $query = $this->db->get();

        if ($query->num_rows > 0) 
		{
            return $query->result();
        }
		else
		{
			return '';
		}

    }
 public function get_transaction_list_all() {

        $this->db->select('booking_apartment.PROP_PHOTO,apartment_transaction.prop_name,apartment_transaction.host_name
		,apartment_transaction.pnr_no
		,booking_global.api_status
		,booking_global.booking_status
		,booking_global.transaction_status
		,apartment_transaction.net_rate
		,apartment_transaction.apt_charge
		,apartment_transaction.booking_amount
		,apartment_transaction.host_charge
		,apartment_transaction.payout_amount
		,apartment_transaction.transaction_id
		,apartment_transaction.payout_status
		,apartment_transaction.payout_host_status
		,apartment_transaction.payout_method
		,apartment_transaction.payout_details
		,apartment_transaction.travel_date
		,booking_global.voucher_date')
                ->from('apartment_transaction')
				->join('booking_global', 'booking_global.id  = apartment_transaction.booking_global_id', 'left')
				->join('booking_apartment', 'booking_apartment.ID  = apartment_transaction.booking_apartment_id', 'left')
				;
        $query = $this->db->get();

        if ($query->num_rows > 0) 
		{
            return $query->result();
        }
		else
		{
			return '';
		}

    }

 public function get_transaction_list_upcoming() {

        $this->db->select('booking_apartment.PROP_PHOTO,apartment_transaction.prop_name,apartment_transaction.host_name
		,apartment_transaction.pnr_no
		,booking_global.api_status
		,booking_global.booking_status
		,booking_global.transaction_status
		,apartment_transaction.net_rate
		,apartment_transaction.apt_charge
		,apartment_transaction.booking_amount
		,apartment_transaction.host_charge
		,apartment_transaction.payout_amount
		,apartment_transaction.transaction_id
		,apartment_transaction.payout_status
		,apartment_transaction.payout_method
		,apartment_transaction.payout_details
		,apartment_transaction.payout_host_status
		,apartment_transaction.travel_date
		,booking_global.voucher_date')
                ->from('apartment_transaction')
				->join('booking_global', 'booking_global.id  = apartment_transaction.booking_global_id', 'left')
				->join('booking_apartment', 'booking_apartment.ID  = apartment_transaction.booking_apartment_id', 'left')
				->where('apartment_transaction.payout_status','Hold')
				->where('apartment_transaction.travel_date >=',date("Y-m-d"));
        $query = $this->db->get();

        if ($query->num_rows > 0) 
		{
            return $query->result();
        }
		else
		{
			return '';
		}

    }

 public function get_transaction_list_compelted() {

        $this->db->select('booking_apartment.PROP_PHOTO,apartment_transaction.prop_name,apartment_transaction.host_name
		,apartment_transaction.pnr_no
		,booking_global.api_status
		,booking_global.booking_status
		,booking_global.transaction_status
		,apartment_transaction.net_rate
		,apartment_transaction.apt_charge
		,apartment_transaction.booking_amount
		,apartment_transaction.host_charge
		,apartment_transaction.payout_amount
		,apartment_transaction.transaction_id
		,apartment_transaction.payout_status
		,apartment_transaction.payout_host_status
		,apartment_transaction.payout_method
		,apartment_transaction.payout_details
		,apartment_transaction.travel_date
		,booking_global.voucher_date')
                ->from('apartment_transaction')
				->join('booking_global', 'booking_global.id  = apartment_transaction.booking_global_id', 'left')
				->join('booking_apartment', 'booking_apartment.ID  = apartment_transaction.booking_apartment_id', 'left')
				->where('apartment_transaction.payout_status','Recived');
        $query = $this->db->get();

        if ($query->num_rows > 0) 
		{
            return $query->result();
        }
		else
		{
			return '';
		}

    }
	  public function update_transaction_details_status(){


 $date = date('Y-m-d', strtotime("-2 days"));
		$this->db->select('*');
		$this->db->from('apartment_transaction');
		$this->db->where('payout_status','Hold');		
		$this->db->where('travel_date <=',$date);	
		
		$query = $this->db->get();
		
		if ( $query->num_rows > 0 ){      
			$result =  $query->result();
			for($k=0;$k<count($result);$k++)
			{
			  $data = array(
           		 'payout_status' => 'Analyze'
				);
				$where = "transaction_id = " . $result[$k]->transaction_id;
				$this->db->update('apartment_transaction', $data, $where);
				$data_t = array(
           		 'hold' => '1',
				 'analyze' => '1'
				);
				$where_t = "apartment_transaction_id = " . $result[$k]->transaction_id;
				$this->db->update('apartment_transaction_tracking', $data_t, $where_t);
				
				$data_h = array(
				'apartment_transaction_id' =>  $result[$k]->transaction_id,
    	        'host_type' => $result[$k]->host_type,
	            'host_id' => $result[$k]->host_id,
				 'status' => 'Analyze',
				'message' => 'Your Transaction Initated From InnoGlobe.'
          			 );
				$this->db->insert('apartment_transaction_history', $data_h);
			}
		}
return true;
   }
   
	public function update_transaction_status($id, $status,$fail,$message,$host_type,$host_id) {

        $data = array(
            'payout_status' => $status
        );
        $where = "transaction_id = " . $id;
        if ($this->db->update('apartment_transaction', $data, $where)) {
			
       
			
			$data_t='';
			if($status=='Process')
			{
				$data_t = array('hold' => '1','analyze' => '1','process' => '1','deposit' => '0','failed' => '0','current_status' => $message);
			}
			if($status=='Deposit')
			{
				$data_t = array('hold' => '1','analyze' => '1','process' => '1','deposit' => '1','failed' => '0','current_status' => $message);
			}
			if($status=='Failed')
			{
				if($fail==1)
				{
				$data_t = array('hold' => '1','analyze' => '1','process' => '1','deposit' => '0','failed' => '1','failed_stage' => 'Process','current_status' => $message);
				}
				if($fail==2)
				{
				$data_t = array('hold' => '1','analyze' => '1','process' => '1','deposit' => '1','failed' => '1','failed_stage' => 'Deposit','current_status' => $message);
				}
				if($fail==0)
				{
				$data_t = array('hold' => '1','analyze' => '1','process' => '0','deposit' => '0','failed' => '1','failed_stage' => 'Analyze','current_status' => $message);
				}
			}
			if($data_t!='')
			{
				$where_t = "apartment_transaction_id = " . $id;
				if($this->db->update('apartment_transaction_tracking', $data_t, $where_t))
				{
					$data_h = array(
					'apartment_transaction_id' =>  $id,
					'host_type' => $host_type,
					'host_id' => $host_id,
					'status' => $status,
					'message' => $message
						 );
					$this->db->insert('apartment_transaction_history', $data_h);
					
					return true;
				}
			}
			else {
            return false;
        }	
            
        } else {
            return false;
        }
    } public function get_transaction_details($pnr_no) {

        $this->db->select('*')
                ->from('apartment_transaction')
			
				->join('apartment_transaction_tracking', 'apartment_transaction_tracking.apartment_transaction_id  = apartment_transaction.transaction_id', 'left')->where('apartment_transaction.pnr_no',$pnr_no)
				;
        $query = $this->db->get();

        if ($query->num_rows > 0) 
		{
            return $query->row();
        }
		else
		{
			return '';
		}

    }
	public function get_transaction_history($id) {

        $this->db->select('*')
                ->from('apartment_transaction_history')
			
				->where('apartment_transaction_id',$id)
				;
        $query = $this->db->get();

        if ($query->num_rows > 0) 
		{
            return $query->result();
        }
		else
		{
			return '';
		}

    }
	public function get_transaction_details_host($pnr_no) {

        $this->db->select('*')
                ->from('apartment_transaction')
				->join('apartment_transaction_history', 'apartment_transaction_history.apartment_transaction_id  = apartment_transaction.transaction_id', 'left')
				->join('apartment_transaction_tracking', 'apartment_transaction_tracking.apartment_transaction_id  = apartment_transaction.transaction_id', 'left')->where('apartment_transaction.pnr_no',$pnr_no)
				;
        $query = $this->db->get();

        if ($query->num_rows > 0) 
		{
            return $query->row();
        }
		else
		{
			return '';
		}

    }
		public function getBookingbyPnr($pnr_no){
		
			$this->db->where('pnr_no',$pnr_no);
			$this->db->join('booking_apartment','booking_global.ref_id = booking_apartment.ID');
			$data = $this->db->get('booking_global')->row();
			
			$this->db->join('booking_apartment','booking_global.ref_id = booking_apartment.ID');
			$this->db->join('kigo_countries', 'kigo_countries.COUNTRY_CODE = booking_apartment.PROP_COUNTRY');
			if($data->PROP_USER_TYPE == '3'){
				$this->db->join('b2c', 'b2c.user_id = booking_apartment.PROP_USER_ID');
			}else if($data->PROP_USER_TYPE == '2'){
				$this->db->join('b2b', 'b2b.user_id = booking_apartment.PROP_USER_ID');
			}
		
        $this->db->where('pnr_no',$pnr_no);
        return $this->db->get('booking_global');
    }
}
