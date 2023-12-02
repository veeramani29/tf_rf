<?php

class Support_Model extends CI_Model {
	
	public function __construct()
    {
	
      parent::__construct();
    }
	function get_support_list($domain_id = "")
	{
		$this->db->select('*')->from('support_ticket')->where('status !=', '0')->group_by('support_ticket_id');
		
		if(isset($domain_id) && !empty($domain_id))
		{
			$this->db->where('domain',$domain_id);
		}
		
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->result();
        }
      return false;
	}
	function get_support_list_pending($domain_id = "")
	{
		$this->db->select('*')->from('support_ticket')->where('last_updated_by !=', 'Admin')->where('status', '1');
		
		if(isset($domain_id) && !empty($domain_id))
		{
			$this->db->where('domain',$domain_id);
		}
		
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->result();
        }
      return false;
	}
	function get_support_list_sent($domain_id = "")
	{
		$this->db->select('*')->from('support_ticket')->where('last_updated_by', 'Admin')->where('status', '1');
		
		if(isset($domain_id) && !empty($domain_id))
		{
			$this->db->where('domain',$domain_id);
		}
		
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->result();
        }
      return false;
	}
	function get_support_list_close($domain_id = "")
	{
		$this->db->select('*')->from('support_ticket')->where('status', '0');
		
		if(isset($domain_id) && !empty($domain_id))
		{
			$this->db->where('domain',$domain_id);
		}
		
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->result();
        }
      return false;
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
	
	
	function get_support_list_id($id)
	{
		$this->db->select('*')
		->from('support_ticket')->where('id', $id);
		
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 $a = $query->row();
										 
										 $this->db->select('*')
								->from('support_ticket_history')->where('support_ticket_id', $a->support_ticket_id)->order_by('last_update_time','ASC');
								
								$query = $this->db->get();
								if ( $query->num_rows > 0 ) 
								{
										 return $query->result();
								}
								
								
        }
      return false;
		
	}
	function get_support_list_id_row($id)
	{
		$this->db->select('*')
		->from('support_ticket')->where('id', $id);;
		
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->row();
        }
      return false;
		
	}
	function getSupportTicket($id)
	{
		$this->db->select('*')
		->from('support_ticket')->where('support_ticket_id', $id);;
		
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->row();
        }
      return false;
		
	}
	
	function close_ticket($id)
	{
		$data = array(
			'status' => '0'
			
			);
		
			
			$where = "support_ticket_id = '$id'";
		if ($this->db->update('support_ticket', $data, $where)) {
			return true;
		} else {
			return false;
		}
	}
	
	function get_usertype_details($id)
	{
		$this->db->select('*')
		->from('user_types')->where('user_type_id', $id);;
		
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->row();
        }
      return false;
	}
	function get_domain_details($id)
	{
		$this->db->select('domain_name')
		->from('domain')->where('domain_id', $id);;
		
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->row();
        }
      return false;
	}
	function get_user_data_ajax_list($domain,$uertype,$email)
	{
		if($uertype == 2)
		{
		$this->db->select('email_id,agent_id as id ')
		->from('b2b')->where('domain',$domain)->where('agent_type',$uertype);
		$this->db->like('email_id',$email);
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->result();
        }
    	return false;
		}
		elseif($uertype == 3)
		{ 
		$this->db->select('email as email_id,user_id  as id')
		->from('b2c')->where('domain',$domain)->where('usertype',$uertype);
		$this->db->like('email',$email);
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->result();
        }
    	return false;
		}
		elseif($uertype == 6)
		{
		$this->db->select('email as email_id,user_id  as id')
		->from('admin')->where('domain',$domain)->where('usertype',1);
		$this->db->like('email',$email);
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->result();
        }
    	return false;
		}
		else
		{
				return false;
		}
	}
		function get_support_subject_list()
	{
		$this->db->select('*')
		->from('support_ticket_subject');
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->result();
        }
      return false;
	}
	function add_new_support_ticket($domain,$usertype,$user,$sub,$message,$image_path)
	{
		$select2 = "select max(id)+1 as max from support_ticket";
  $query=$this->db->query($select2);
  $aa = $query->row();
  $m_id1 = 0;
  if($aa!='')
  {
   $m_id1=  $aa->max;
  }
  
  $m_id =  'ST'.date('d').date('m').($m_id1+10000);
  
		 	$data = array(
		'domain' => $domain,
		'user_type' => $usertype,
		'user_id' => $user,
		'subject' => $sub,
		'message' => $message,
		'file_path' => $image_path,
		'status' => '1',
		'support_ticket_id'=>$m_id,
	
		'last_updated_by' => 'Admin'
		);
			
		$this->db->set('created_time', 'NOW()', FALSE); 
			$this->db->set('last_update_time', 'NOW()', FALSE); 
		$this->db->insert('support_ticket', $data);
		
			$data = array(
		'support_ticket_id' => $m_id,
		'message' => $message,
		'file_path' => $image_path,
		'status' => '1',
		'last_updated_by' => 'Admin'
		);
		$this->db->set('last_update_time', 'NOW()', FALSE); 
		$this->db->insert('support_ticket_history', $data);
	}
	function add_new_support_ticket_updates($s_id,$domain,$usertype,$user,$sub,$message,$image_path)
	{
	
		 	$data = array(
		'message' => $message,
		'file_path' => $image_path,
		'status' => '1',
		'support_ticket_id'=>$s_id,
		'last_updated_by' => 'Admin'
		);
			
	
		$this->db->set('last_update_time', 'NOW()', FALSE); 
		$this->db->insert('support_ticket_history', $data);
		
				$this->db->where('support_ticket_id', $s_id);
				$this->db->update('support_ticket',array('last_updated_by'=>'Admin'));
	}
	
	
	/*function get_user_details($usertype,$userid)
	{   
		if($usertype == 2)
		{
			//$sql="select name, email_id as email ,city,country,mobile,agent_logo from b2b where agent_id='$userid'";
		 $this->db->select('name, email_id as email,city,country,mobile,agent_logo')->from('b2b')->where('agent_id',$userid);
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->row();
        }	
    	return false;
		}
		elseif($usertype == 3)
		{
		$this->db->select('firstname as name, email,city,country,contact_no as mobile,profile_photo')
		->from('b2c')->where('user_id',$userid);
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->row();
        }
    	return false;
		}
		else
		{
				return false;
		}
	
	}
	*/	
	
		function get_user_details($usertype,$userid)
	{
		
		if($usertype == 2)
		{
		$this->db->select('name, email_id as email,city,country,mobile,agent_logo image')
		->from('b2b')->where('agent_id',$userid);
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->row();
        }
    	return false;
		}
		elseif($usertype == 3)
		{
		$this->db->select('firstname as name, email,city,country,	contact_no as mobile,profile_photo image')
		->from('b2c')->where('user_id',$userid);
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->row();
        }
    	return false;
		}
		else
		{
				return false;
		}
	
	}
}

