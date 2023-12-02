<?php
 

class Help_Model extends CI_Model {
	
	public function __construct()
    {
      parent::__construct();
    }
    
     
     // Fetch Help Options
      function get_helpcenter_opt()
      {
        $qur = $this->db->get('crs_help_center_options');
        

      	if($qur->num_rows()> 0)
      	{
      		return $qur->result();
      	}
     	}
/*
*Added by: Vikas Arora
*name: submenu_exist_change::Change the state of main menu from not having submenu to having submenu
******if submenu_exist(default) = 0 then no submenu, else if 1, then it has submenu.
*Wednesday, 27
*/
      function submenu_exist_change($mid) 
      {
        $data = array('submenu_exist'=> 1);

        $this->db->where('menu_id', $mid);
        $this->db->update('crs_help_center_options', $data);
      }

      function update_content_status($mid)
      {
        $data = array('content_exist'=> 1);
        
        $this->db->where('menu_id', $mid);
        $this->db->update('crs_help_center_options', $data);
      }

      function update_submenu_content_status($mid, $submenu_id) 
      {
        $data = array('content_exist'=> 1);
        
        $this->db->where('menu_id', $mid);
        $this->db->where('sub_menu_id', $submenu_id);
        $this->db->update('crs_sub_menus', $data);
      }

     	
     	//Add option
     	function add_option($data)
     	{
     		 
     		$this->db->insert('crs_help_center_options', $data);
      }
     	
     	// Delete Help Option
     	function delete_option($id)
     	{ 
     	$this->db->where('menu_id', $id);
		if($this->db->delete('crs_help_center_options', $where))
		{
		return true;		
		}     		
     	}
     	
     	// Edit Menu option
     	function edit_menu($mid)
     	{
     		$this->db->where('menu_id', $mid);
     		$qur=$this->db->get('crs_help_center_options');
     			if($qur->num_rows()> 0)
    	{
    		return $qur->row();
    	}
     		
     	}
     	
     	// Update Menu Option
     	function update_menu($id,$data)
     	{
       $this->db->where('menu_id',$id);
       $this->db->update('crs_help_center_options', $data);
     	}
     	
     	//Update Status
     	function update_status($sid)
 		{
      $where = "menu_id = ".$sid;	
 	   $sql="select * from crs_help_center_options where menu_id='$sid'";
 	   $query=$this->db->query($sql);
 	   $res = $query->row();
 
  	   if($res->status=='0')
      {
   	$data=array('status'=>'1');
   	
   	if($this->db->update('crs_help_center_options', $data, $where))
   	{
   		return true;
		} 	
		else { return false; }
      }
      
      else
      {
     	$data=array('status'=>'0');
   	
   	if($this->db->update('crs_help_center_options', $data, $where))
   	{
   		return true;
		} 	
		else { return false; }
      }
      }
      
      //get submenus
      function sub_menus($mid)
      {	
      	$this->db->where('menu_id', $mid);
      	$qur=$this->db->get('crs_sub_menus');
      	if($qur->num_rows()>0)
      	{
      	return $qur->result();	
      	}
      	
      }
      
      //Add Submenu
      function sub_menu_add($data)
      {      
      $this->db->insert('crs_sub_menus', $data);
      }
      
      function get_menu($mid)
      {
      	$this->db->where('menu_id', $mid);
      	$qur=$this->db->get('crs_help_center_options');
      	if($qur->num_rows()>0)
      	{
			return $qur->row();      		
      	}
      }
      
      function get_submenu($mid)
      {
      	$this->db->where('menu_id', $mid);
      	$qur=$this->db->get('crs_sub_menus');
      	if($qur->num_rows()>0)
      	{
			return $qur->row();      		
      	}
      }
      
      
      function get_menu_id($mid)
      {
      	$this->db->where('menu_id', $mid);
      	$qur=$this->db->get('crs_help_center_options');
      	if($qur->num_rows()>0)
      	{
			return $qur->row();      		
      	}
      }
      
     function get_submenu_content($mid) {
      	$this->db->where('sub_menu_id', $mid);
      	$qur=$this->db->get('crs_sub_menus');
      	if($qur->num_rows()>0) {
			   return $qur->row();      		
      	}
      }

      //delete submenus
	   function delete_submenus($id,$mid){ 
  
     	$this->db->where('sub_menu_id', $id);
		  if($this->db->delete('crs_sub_menus', $where)) {
		    return true;		
		  }     		
     	}
     	
     	
	//Update Status
    function update_submenu_status($sid,$mid)
 		{
      $where = "sub_menu_id = ".$sid;	
 	   $sql="select * from crs_sub_menus where sub_menu_id='$sid'";
 	   $query=$this->db->query($sql);
 	   $res = $query->row();
 
  	   if($res->status=='0')
      {
   	$data=array('status'=>'1');
   	
   	if($this->db->update('crs_sub_menus', $data, $where))
   	{
   		return true;
		} 	
		else { return false; }
      }
      
      else
      {
     	$data=array('status'=>'0');
   	
   	if($this->db->update('crs_sub_menus', $data, $where))
   	{
   		return true;
		} 	
		else { return false; }
      }
      }
      
       	// Edit Menu option
     	function edit_submenu($id)
     	{
     		$this->db->where('sub_menu_id', $id);
     		$qur=$this->db->get('crs_sub_menus');
     			if($qur->num_rows()> 0)
    	{
    		return $qur->row();
    	}
     		
     	}
     	
     		// Update Submenu Option
     	function update_sub_menu($id,$data,$mid)
     	{
       $this->db->where('sub_menu_id',$id);
       $this->db->update('crs_sub_menus', $data);
     	}
     	
     	
     	
    function add_content_image($data)
 	  {
 	 	  $this->db->insert('crs_submenu_content', $data);
 	 	}
 	 	 
 	  
  
     
   function save_submenu_img($hotelimage,$submenu_id)
   {
   	$data=array('img_name'=>$hotelimage, 'sub_menu_id'=>$submenu_id);												
      	//print_r($data); exit();
      $this->db->insert('crs_sub_menus_images', $data);
   	}
     	
     	
 	function view_content($menu_id, $submenu_id)
 	{
       	$where = "menu_id = ".$menu_id." AND sub_menu_id = ".$submenu_id;
        $this->db->where($where);
       	$qur=$this->db->get('crs_submenu_content');
     		if($qur->num_rows()>0)
     		{
     		    return $qur->row();	
     		}
 	}

  function view_content_main_menu($menu_id)
  {
        $where = "menu_id = ".$menu_id." AND sub_menu_id = 0";
        $this->db->where($where);
        $qur=$this->db->get('crs_submenu_content');
        if($qur->num_rows()>0)
        {
            return $qur->row(); 
        }
  }

  /*Vikas Arora*/

  function checkContentType($menu_id, $submenu_id)
  {
      $where = "menu_id = ".$menu_id." AND sub_menu_id = ".$submenu_id;
      $this->db->select('content_type');
      $this->db->from('crs_submenu_content');
      $this->db->where($where);
      $qur=$this->db->get();
      if($qur->num_rows()>0)
      {
          return $qur->row(); 
      }
  }

  function checkContentTypeMainMenu($menu_id)
  { 
      $where = "menu_id = ".$menu_id." AND sub_menu_id = 0";
     
      $this->db->select('content_type');
      $this->db->from('crs_submenu_content');
      $this->db->where($where);
      $qur=$this->db->get();
      if($qur->num_rows()>0)
      {
          return $qur->row(); 
      }
  }

  function view_link_content($menu_id, $submenu_id)
  {
      $where = "menu_id = ".$menu_id." AND sub_menu_id = ".$submenu_id;
      $this->db->where($where);
      $qur=$this->db->get('crs_submenu_content');
      if($qur->num_rows()>0)
      {
          return $qur->result(); 
      }
  }
   function view_one_link_content($cont_id)
  {
      $where = "cont_id = ".$cont_id;
      $this->db->where($where);
      $qur=$this->db->get('crs_submenu_content');
      if($qur->num_rows()>0)
      {
          return $qur->row(); 
      }
  }


  /***********/
     	
     	
 	function main_menu($mid)
 	{
 		$this->db->where('menu_id', $mid);
 		$qur=$this->db->get('crs_help_center_options');
 		if($qur->num_rows()>0)
 		{
 			return $qur->row();
 		}
 	}
/*Vikas Arora
* Fetch all the submenus to appear in the "Add help menu option" page 
*/
      function getAllSubmenu()
      {
        $where = 'status = 1 AND content_exist = 1';
        $this->db->select('a.*, b.menu_id as select_menu, b.sub_menu_id as sub_select');
        $this->db->from('crs_sub_menus a');
        $this->db->join('crs_help_links b', 'a.menu_id = b.menu_id AND a.sub_menu_id = b.sub_menu_id', 'left');
        $this->db->where($where);
        return $this->db->get()->result();


      }

      function getSelectedHelpLink()
      {
        $this->db->select("*");
        $this->db->from('crs_help_links');

        return $this->db->get()->result();
      }


      function clear_link_table() 
      {
        $this->db->truncate('crs_help_links');
      }

/*update new helper links. These will appear in the topbar in frontend*/
      function updateHelpLink($menu_id, $submenu_id) 
      {
        $data = array('menu_id'=> $menu_id, 'sub_menu_id'=>$submenu_id);
        
        $this->db->insert('crs_help_links', $data);
        return true;

      }

      function update_content_image($cont_id, $data) 
      {
	$this->db->where('cont_id', $cont_id);
        $this->db->update('crs_submenu_content', $data);
      }

	function edit_view_content($cont_id)
 	{
       	$where = "cont_id = ".$cont_id;
        $this->db->where($where);
       	$qur=$this->db->get('crs_submenu_content');
     		if($qur->num_rows()>0)
     		{
     		    return $qur->row();	
     		}
 	}
/***************/
}

