<?php 
class Support_Model extends CI_Model {

    function __construct()
    {
		
        // Call the Model constructorf
        parent::__construct();
		
	
			
    }
function get_support_list_pending($b2c_id,$b2c_type,$domain_id )
	{
		$this->db->select('*')
		->from('support_ticket')->where('last_updated_by =', 'Admin')->where('status', '1')	 ->where('user_id', $b2c_id)	->where('user_type',$b2c_type)	->where('domain', $domain_id)	
		->group_by('support_ticket_id');
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->result();
        }
      return false;
	}
	function get_support_list($b2c_id,$b2c_type,$domain_id )
	{
		$this->db->select('*')
		->from('support_ticket')->where('status !=', '0')  ->where('user_id', $b2c_id)	->where('user_type',$b2c_type)	->where('domain', $domain_id);
		
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->result();
        }
      return false;
	}
	function get_support_list_sent($b2c_id,$b2c_type,$domain_id )
	{
		$this->db->select('*')
		->from('support_ticket')->where('last_updated_by !=', 'Admin')->where('status', '1')  ->where('user_id', $b2c_id)	->where('user_type',$b2c_type)	->where('domain', $domain_id);
		
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->result();
        }
      return false;
	}
	function get_support_list_close($b2c_id,$b2c_type,$domain_id )
	{
		$this->db->select('*')
		->from('support_ticket')->where('status', '0') ->where('user_id', $b2c_id)	->where('user_type',$b2c_type)	->where('domain', $domain_id);
		
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->result();
        }
      return false;
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
	function add_new_support_ticket($domain,$usertype,$user,$sub,$message,$image_path)
	{
		if($this->session->userdata('b2c_id'))
		{
			$last_pdate= 'B2C';
		}
		if($this->session->userdata('b2b_id'))
		{
			$last_pdate= 'B2B';
		}
		  $select2 = "select max(id)+1 as max from support_ticket";
		  $query=$this->db->query($select2);
		  $aa = $query->row();
		  $m_id1 = 0;
		  if($aa!='')
		  {
		   $m_id1=  $aa->max;
		  }
  		$m_id =  'ST'.date('d').date('m').($m_id1+10000);
  		$data = array( 'domain' => $domain,
						'user_type' => $usertype,
						'user_id' => $user,
						'subject' => $sub,
						'message' => $message,
						'file_path' => $image_path,
						'status' => '1',
						'support_ticket_id'=>$m_id,
						'last_updated_by' => $last_pdate
						);
			
			
		$this->db->set('created_time', 'NOW()', FALSE); 
		$this->db->set('last_update_time', 'NOW()', FALSE); 
		$this->db->insert('support_ticket', $data);
		$suprtid = $this->db->insert_id();
		$data = array(
		'support_ticket_id' => $m_id,
		'message' => $message,
		'file_path' => $image_path,
		'status' => '1',
		'last_updated_by' => $last_pdate
		);
		$this->db->set('last_update_time', 'NOW()', FALSE); 
		$this->db->insert('support_ticket_history', $data);
		return $suprtid;
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
	function calculate_time_ago($ptime)
	{		
	$sss = date('Y-m-d H:i:s');
    $etime = strtotime($sss) - strtotime($ptime);
    if( $etime < 1 )
    {
        return lang('less than 1 second ago');
    }

    $a = array( 12 * 30 * 24 * 60 * 60  =>  lang('year'),
                30 * 24 * 60 * 60       =>  lang('month'),
                24 * 60 * 60            =>  lang('day'),
                60 * 60             =>  lang('hour'),
                60                  =>  lang('minute'),
                1                   =>  lang('second')
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
	function add_new_support_ticket_updates($s_id,$domain,$usertype,$user,$sub,$message,$image_path)
	{
			if($this->session->userdata('b2c_id'))
		{
			$last_pdate= 'B2C';
		}
		if($this->session->userdata('b2b_id'))
		{
			$last_pdate= 'B2B';
		}
		
	
		 	$data = array(
		'message' => $message,
		'file_path' => $image_path,
		'status' => '1',
		'support_ticket_id'=>$s_id,
		'last_updated_by' => $last_pdate
		);
			
	
		$this->db->set('last_update_time', 'NOW()', FALSE); 
		$this->db->insert('support_ticket_history', $data);
		$last_id = $this->db->insert_id();
		$this->db->where('support_ticket_id', $s_id);
		$this->db->update('support_ticket',array('last_updated_by'=>$last_pdate));

		return $last_id;
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

	function getSupportHistoryRow($id)
	{
		$this->db->select('*')
		->from('support_ticket_history')->where('support_ticket_history_id', $id);;
		
		$query = $this->db->get();
	    if ( $query->num_rows > 0 ) 
		{
        		 return $query->row();
        }
      return false;
	}
}

