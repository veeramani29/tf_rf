<?php

class Home_Model extends CI_Model {
	
	public function __construct()
    {
	
      parent::__construct();
    }
	function calculate_time_ago($ptime)
	{
		
	$sss = date('Y-m-d H:i:s');
    $etime = strtotime($sss) - strtotime($ptime);
    if( $etime < 1 )
    {
        return 'less than 1 second ago';
    }

    $a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60             =>  'hour',
                60                  =>  'minute',
                1                   =>  'second'
    );

    foreach( $a as $secs => $str )
    {
        $d = $etime / $secs;

        if( $d >= 1 )
        {
            $r = round( $d );
            return '' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
	}
	
	   public function check_sa_login($email, $password,$usertype)
   	{
   
		$this->db->select('*')
			->from('admin')
			->where('email ', $email)
            ->where('password', $password)
			->where('usertype', $usertype)
		->where('status', 1)
			->limit(1);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }
    public function check_admin_login($email, $password){
   
		$this->db->select('*')->from('admin')->where('email ', $email)->where('password', $password)
		->where('status', 1)->limit(1);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }
   
   public function check_supplier_login($email, $password){
   
		$this->db->select('*')->from('supplier')->where('email ', $email)->where('password', $password)
		->where('status', 1)->limit(1);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }
   
   public function get_sa_login()
   	{
   
		$this->db->select('*')
		->from('admin')
		->where('usertype', '0')
		->where('status', 1)
		->limit(1);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }
   public function get_biz_alert_details()
   	{
   
		$this->db->select('*')
		->from('biz_rules_alert');
		
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
    public function get_biz_margin_details()
   	{
   
		$this->db->select('*')
		->from('biz_rules_margin');
		
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         $a= $query->row();
		 return $a->value;
      }
      return false;
   }
      public function get_biz_margin_details_()
   	{
   
		$this->db->select('*')
		->from('biz_rules_margin');
		
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         $a= $query->result();
		 return $a;
      }
      return false;
   }
    public function get_email_acess()
		{
	   
			$this->db->select('*')
				->from('email_access');
			
			$query = $this->db->get();
	
		  if ( $query->num_rows > 0 ) {
		  
			 return $query->row();
		  }
		  return false;
	   }
   function update_sa_password(  $password='')
	{
	
	
		if (!empty($password)) {
			$data['password'] = $password;	
			$where = "usertype = 0";
		if ($this->db->update('admin', $data, $where)) {
			return true;
		} else {
			return false;
		}		
		}
			
		else {
			return false;
		}

	}
	  public function get_country_list()
   	{
   
		$this->db->select('*')
		->from('country');
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
     public function get_country_list_id($country_id)
   	{
   
		$this->db->select('*')
		->from('country')
		->where('country_id',$country_id);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }
		function update_sa_profile( $firstname,  $email, $contact_no, $address)
	{
	
		$data = array(
			'firstname' => $firstname,
		
			'email' => $email,
			'contact_no' => $contact_no,
			'address' => $address
			);
		
			//echo $this->db->last_query();
			
			$where = "usertype = 0";
		if ($this->db->update('admin', $data, $where)) {
			return true;
		} else {
			return false;
		}

	}
	
	
	function fetch_tracking_detail()
	{

		$arrval	= array();
		$mntCount		= 5;
		$j=0;
		for($i=0;$i<$mntCount; $i++)
		{
			
			$arrval[$i] =  date("M",strtotime("$j Months"));
			$j--;
		}
		
		//~ $arrval['0'] =  date("M",strtotime("0 Months"));
		//~ $arrval['1'] = date("M",strtotime("-1 Months"));
		//~ $arrval['2'] = date("M",strtotime("-2 Months"));
		//$arrval	= array(0,1,2);
		 //~ print_r($arrval);exit;
		$page0 = "192.168.0.245/InnoGlobe/";
		$page1 = "192.168.0.245/InnoGlobe/index.php/hotel/search";
		$page2 = "192.168.0.245/InnoGlobe/index.php/hotel/hotel_details/";
		$page3 = "192.168.0.245/InnoGlobe/index.php/cart/booking";
		$page4 = "192.168.0.245/InnoGlobe/index.php/wishlist/";
         //print_r($arrval);
		foreach($arrval as $key=>$arrmon)
		{
			$mainArr['monName'][$key]=0;
			$mainArr['homeCnt'][$key]=0;
			$mainArr['searchCnt'][$key]=0;
			$mainArr['bookCnt'][$key]=0;
			$mainArr['detailCnt'][$key]=0;
			$mainArr['wishlistCnt'][$key]=0;
			$selectQue			= "SELECT * FROM tracking_detail
			WHERE  MONTH(date) = MONTH(CURRENT_DATE - INTERVAL $key MONTH)";
			$mainArr[$arrmon]	= $this->db->query($selectQue)->result();
			$mainArr['monName'][$key] = $arrmon ;
			//~ echo '<pre/>';print_r($mainArr['homeCnt'][$arrmon]);
			//~ exit;	
			foreach($mainArr[$arrmon] as $arrmonn)
			{
				
				
				if($page0	==$arrmonn->page_url )
				{
					$mainArr['homeCnt'][$key]++;
				}
				else if($page1	==$arrmonn->page_url )
				{
					$mainArr['searchCnt'][$key]++;
				}
				else if($page3	==$arrmonn->page_url )
				{
					$mainArr['bookCnt'][$key]++;
				}
				else if(strstr($arrmonn->page_url, 'hotel_details', true))
				{
					$mainArr['detailCnt'][$key]++;
				}
				else if(strstr($arrmonn->page_url, 'wishlist', true))
				{
					$mainArr['wishlistCnt'][$key]++;
				}

			}
		}
			 
		// echo '<pre/>';print_r($mainArr);exit;
		return $mainArr;

	}
	
	
	function fetch_b2c_useronline()
	{
		
		mysql_query("DELETE FROM user_online WHERE date<SUBTIME(NOW(),'0 0:10:0')");
		
			$this->db->select('*')
		->from('user_online')
		->join('b2c', 'b2c.user_id = user_online.user_id')
			->where('user_online.user_type','3');
		  $query = $this->db->get();
  //echo $this->db->last_query(); exit;
      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return '0';
		
	}
	
	
	function fetch_b2b_useronline()
	{
		$this->db->select('*')->from('user_online')->join('b2b', 'b2b.agent_id = user_online.user_id')->where('user_online.user_type','2');
		  $query = $this->db->get();
  
		if ( $query->num_rows > 0 ){      
         return $query->result();
      }
      return '0';		
	}
	
	function get_overall_booking()
	{
		$this->db->select('sum(amount) as total_amount');
		$this->db->from('booking_global');
		$query = $this->db->get();
		if ( $query->num_rows > 0 ){      
			return $query->result();
		}
      return '0';
	}
	
	function get_b2c_users()
	{
		$this->db->select('count(1) as count');
		$this->db->from('b2c');
		$query = $this->db->get();
		if ( $query->num_rows > 0 ){      
			return $query->result();
		}
      return '0';
	}
	
	function get_b2b_users()
	{
		$this->db->select('count(1) as count');
		$this->db->from('b2b');
		$query = $this->db->get();
		if ( $query->num_rows > 0 ){      
			return $query->result();
		}
      return '0';
	}
	
	function get_booking_detail_count()
	{
		$this->db->select('count(1) as count');
		$this->db->from('booking_global');
		$query = $this->db->get();
		if ( $query->num_rows > 0 ){      
			return $query->result();
		}
      return '0';
	}
	
	function get_booking_details()
	{
		$this->db->select('*');
		$this->db->from('booking_global');
		$this->db->limit(10);
		
		$query = $this->db->get();
		if ( $query->num_rows > 0 ){      
			return $query->result();
		}
      return '0';
	}
	
	function domain_list()
	{
		$this->db->select('domain_id,domain_name');
		$this->db->from('domain');
		
		$query = $this->db->get();
		if ( $query->num_rows > 0 ){      
			return $query->result();
		}
      return '';
	}
	
	function getEmailContent()
	{
		$this->db->select('*');
		$this->db->from('email_content');
		$this->db->join('domain','email_content.domain_id = domain.domain_id');		
		
		$query = $this->db->get();
		if ( $query->num_rows > 0 ){      
			return $query->result();
		}
      return '';
	}
	
	function get_single_email_content($id)
	{
		$this->db->select('*');
		$this->db->from('email_content');
		$this->db->where('id',$id);
		
		$query = $this->db->get();
		if ( $query->num_rows > 0 ){      
			return $query->result();
		}
      return '';
	}
	
	function get_b2c_stats_model() {
		$this->db->select('count(user_id) as reg_count, DATE(register_date) as reg_date');
		$this->db->from('b2c');
		$this->db->group_by('reg_date');
		$this->db->limit(30);

		$query = $this->db->get();
		return $query;
	}

	function get_b2b_stats_model() {
		$this->db->select('count(agent_id) as reg_count, DATE(register_date) as reg_date');
		$this->db->from('b2b');
		$this->db->group_by('reg_date');
		$this->db->limit(30);

		$query = $this->db->get();
		return $query;	
	}
 	
 	function get_flight_booking_stats_model() {
 		$this->db->select('count(*) as flight_count, sum(amount) as total_amount, DATE(voucher_date) as book_date');
 		$this->db->from('booking_global');
		$this->db->where('module', 'FLIGHT'); 		
		$this->db->where('booking_status', 'CONFIRMED'); 
		$this->db->group_by('book_date');

		$query = $this->db->get();
		return $query;			
 	}

 	function get_hotel_booking_stats_model() {
 		$this->db->select('count(*) as hotel_count, sum(amount) as total_amount, DATE(voucher_date) as book_date');
 		$this->db->from('booking_global');
		$this->db->where('module', 'HOTEL'); 		
		$this->db->where('booking_status', 'CONFIRMED'); 			
		$this->db->group_by('book_date');

		$query = $this->db->get();
		return $query;	
 	}

 	function get_apt_booking_stats_model() {
 		$this->db->select('count(*) as apt_count, sum(amount) as total_amount, DATE(voucher_date) as book_date');
 		$this->db->from('booking_global');
		$this->db->where('module', 'APARTMENT'); 		
		// $this->db->where('booking_status', 'CONFIRMED'); 			
		$this->db->group_by('book_date');

		$query = $this->db->get();
		// print_r($query->result()); die();
		return $query;	
 	}


 	function get_car_booking_stats_model() {
 		$this->db->select('count(*) as car_count, sum(amount) as total_amount, DATE(voucher_date) as book_date');
 		$this->db->from('booking_global');
		$this->db->where('module', 'CAR'); 		
		// $this->db->where('booking_status', 'CONFIRMED'); 			
		$this->db->group_by('book_date');

		$query = $this->db->get();
		// print_r($query->result()); die();
		return $query;	
 	}
	
	public function get_deposit_request(){
   
		$this->db->select('b2b.agent_id, b2b.company_name as username, b2b.agent_logo as userimage, b2b_deposit.transaction_id,b2b_deposit.agent_id')->from('b2b_deposit')
		->join('b2b','b2b.agent_id = b2b_deposit.agent_id','left')
		->where('b2b_deposit.status', 'Pending')->order_by('b2b_deposit.deposit_id','desc')->limit(10);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      $data['result'] = $query->result();
	  $data['cnt'] = $query->num_rows;
         return $data;
      }
	  else
	  {
		  $data['result'] = '';
	  $data['cnt'] = 0;
         return $data;
	  }

   }
   public function get_b2b_agent(){
   
		$this->db->select('b2b.agent_id,b2b.register_date, b2b.company_name as username, b2b.agent_logo as userimage')->from('b2b')
		
		->where('b2b.status', '0')->order_by('b2b.agent_id','desc')->limit(10);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      $data['result'] = $query->result();
	  $data['cnt'] = $query->num_rows;
         return $data;
      }
	  else
	  {
		  $data['result'] = '';
	  $data['cnt'] = 0;
         return $data;
	  }

   }
    public function get_b2b_support_ticket(){
   
		$this->db->select('b2b.agent_id,support_ticket.support_ticket_id,support_ticket.id as sid, b2b.company_name as username, b2b.agent_logo as userimage')->from('support_ticket')
		->join('b2b','b2b.agent_id = support_ticket.user_id','left')
		->where('support_ticket.user_type', '2')
		->where('support_ticket.status', '1')->where('support_ticket.last_updated_by', 'B2B')
		->order_by('support_ticket.id','desc')->limit(10);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      $data['result'] = $query->result();
	  $data['cnt'] = $query->num_rows;
         return $data;
      }
	  else
	  {
		  $data['result'] = '';
	  $data['cnt'] = 0;
         return $data;
	  }

   }
     public function get_b2c_support_ticket(){
   
		$this->db->select('b2c.user_id,support_ticket.support_ticket_id,support_ticket.id as sid, b2c.firstname as username, b2c.profile_photo as userimage')->from('support_ticket')
		->join('b2c','b2c.user_id = support_ticket.user_id','left')
		->where('support_ticket.user_type', '3')
		->where('support_ticket.status', '1')->where('support_ticket.last_updated_by', 'B2C')
		->order_by('support_ticket.id','desc')
		->limit(10);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      $data['result'] = $query->result();
	  $data['cnt'] = $query->num_rows;
         return $data;
      }
	  else
	  {
		  $data['result'] = '';
	  $data['cnt'] = 0;
         return $data;
	  }

   }
    public function update_transaction_details_status(){


 $date = date('Y-m-d', strtotime("+2 days"));
		$this->db->select('*');
		$this->db->from('apartment_transaction');
		$this->db->where('payout_status','Hold');		
		$this->db->where('travel_date >=',$Hold);	
		
		$query = $this->db->get();
		echo $query->num_rows;exit;
		if ( $query->num_rows > 0 ){      
			return $query->result();
		}

   }
   public function get_b2b_transaction_details(){
   
		$this->db->select('b2b.agent_id,apartment_transaction.pnr_no as pnr, b2b.company_name as username, b2b.agent_logo as userimage')->from('apartment_transaction')
		->join('b2b','b2b.agent_id = apartment_transaction.user_id','left')
		->where('apartment_transaction.user_type', '2')->order_by('apartment_transaction.transaction_id','desc')
		->limit(10);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      $data['result'] = $query->result();
	  $data['cnt'] = $query->num_rows;
         return $data;
      }
	  else
	  {
		  $data['result'] = '';
	  $data['cnt'] = 0;
         return $data;
	  }

   }
    public function get_b2c_transaction_details(){
   
		$this->db->select('b2c.user_id,apartment_transaction.pnr_no as pnr, b2c.firstname as username, b2c.profile_photo as userimage')->from('apartment_transaction')
		->join('b2c','b2c.user_id = apartment_transaction.user_id','left')
		->where('apartment_transaction.user_type', '3')->order_by('apartment_transaction.transaction_id','desc')
		->limit(10);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      $data['result'] = $query->result();
	  $data['cnt'] = $query->num_rows;
         return $data;
      }
	  else
	  {
		  $data['result'] = '';
	  $data['cnt'] = 0;
         return $data;
	  }


   }
}
