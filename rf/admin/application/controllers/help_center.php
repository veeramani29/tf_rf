<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Help_center extends CI_Controller {

	public function __construct() {
       parent::__construct();
     
	   $this->load->database(); 
	   $this->load->library('upload');
	 	
	   $this->check_isvalidated();	
       $this->load->library('form_validation','session');
 
	   $this->load->model('help_model');
 	
	  
	   $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
       $this->output->set_header("Pragma: no-cache");

      if($this->session->userdata('admin_logged_in')){
	  		$this->load->helper('url');
	  		$controller = $this->router->fetch_class();
	  		parent::check_modules($controller);
	  		$this->load->model('Privilege_Model');
	  		$sub_admin_id = $this->session->userdata('admin_id');
	  		$this->data['modules'] = $this->Privilege_Model->get_privileges_by_sub_admin_id($sub_admin_id)->result();
	  }
	   
    }

	private function check_isvalidated()
	{
		if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in'))
		{
		    redirect('login/index');
	    }
	}


    function index()
    {
   		$data['result'] = $this->help_model->get_helpcenter_opt();
     	$this->load->view('help_center/view',$data);
    }
 

	 function delete_option($id)
	 {
 	 $opt_del=$this->help_model->delete_option($id);
 	 if($opt_del)
 	 {
	 redirect('help_center/index'); 		
 	 }
 	 }
 	 
 	 function add_option()
 	 { 
	 $opt=$this->input->post('opt');
 	 $date= date("Y-m-d");
 	 $data=array('menu_option'=>$opt, 'created_date'=>$date, 'status'=>'1');
 	 $this->help_model->add_option($data);
 	 redirect('help_center/index', 'refresh');
 
 	 }
 	
 	 function edit_menu($mid)
 	 {
 	 	$data['result2']=$this->help_model->main_menu($mid);
 	 	$data['result']= $this->help_model->edit_menu($mid);
 	 	$this->load->view('help_center/edit_menu', $data);
 	 	
 	 }
 	 
 	 function update_menu()
 	 {
 	 $id=$this->input->post('mid');
 	 $menu=$this->input->post('menu');
 	 $data=array('menu_option'=>$menu);
 	 $this->help_model->update_menu($id,$data);
 	 redirect('help_center/index');
 	 }
 	 
 	 
 	 function status($sid)
	 {
	 if($this->help_model->update_status($sid))
 	 {
 	 redirect('help_center/index');
 	 }	
	 }
	 
	 function add_sub_menu($mid)
	 {
		 $data['result2']=$this->help_model->get_menu_id($mid);
		 $data['result']=$this->help_model->main_menu($mid);
		 $data['result1']=$this->help_model->get_submenu($mid);
		 $data['res']=$this->help_model->get_menu($mid);
		 $this->load->view('help_center/add_sub_menu',$data);	
	 }
	 
	   
	 function sub_menu_add()
	 { 
	 	$sub_menu=$this->input->post('sub_menu');
	 	$mid=$this->input->post('mid');
	 	$date=date('Y-m-d');
	 	$data=array('sub_menu_title'=>$sub_menu, 'menu_id'=>$mid, 'created_date'=>$date, 'status'=>'1');

	   	if(isset($_POST['submit']))
	   	{
	 		$this->help_model->sub_menu_add($data);
	 		$this->help_model->submenu_exist_change($mid);
	 		redirect('help_center/sub_menus/'.$mid);
	  	}
	  }
	  
	  
	 function sub_menus($mid) {
	 	$data['result1']=$this->help_model->main_menu($mid);
	 	$data['res']=$this->help_model->get_submenu($mid);
	 	$data['result']=$this->help_model->sub_menus($mid);
	  	$this->load->view('help_center/sub_menus', $data);	
	 }
	  
	 function add_sub_menu_content($mid) {
	 	$data['result']=$this->help_model->get_submenu_content($mid);
	 	$this->load->view('help_center/content', $data);	
	 }


/*Vikas arora*/
	 function add_main_menu_content($mid) {
	 	$data['main_menu_id'] = $mid;
		$this->load->view('help_center/main_menu_content', $data);	
	 }

	function addhelplink(){
		$data['link_data'] = $this->help_model->getAllSubmenu();
		$this->load->view('help_center/addhelplink_view', $data);
	}

	function updateHelpLink() 
	{
		$chkbox_array = $this->input->post('helpLinkArray');
		$clear_link_table = $this->help_model->clear_link_table();

		foreach($chkbox_array as $chkbox) {
			
			$a = explode('/', $chkbox);
			
			$menu_id = $a[0];
			$submenu_id = $a[1];
			$this->help_model->updateHelpLink($menu_id, $submenu_id);
		}

		$this->addhelplink();
	}



	 //delete submenus
	 
	 function delete_submenus($id,$mid)
	 { 
	 	 $sub_opt=$this->help_model->delete_submenus($id,$mid);
	 	 if($sub_opt)
	 	 {
		 redirect('help_center/sub_menus/'.$mid); 		
	 	 }
 	 }
 	 
 	 
 	 function update_submenu_status($sid,$mid)
	 {
		 if($this->help_model->update_submenu_status($sid))
	 	 {
	 	 	redirect('help_center/sub_menus/'.$mid);
	 	 }	
	 }
	 
	 function edit_submenu($id,$mid)
	 {
	 $data['result2']=$this->help_model->main_menu($mid);
	 $data['result1']=$this->help_model->get_submenu($mid);
	 $data['result']= $this->help_model->edit_submenu($id);
	 $this->load->view('help_center/edit_submenu', $data);	
	 }
	 
	 
	 function update_sub_menu(){
	 $mid=$this->input->post('mid');
 	 $id=$this->input->post('subid');
 	 $submenu=$this->input->post('submenu');
 	 $data=array('sub_menu_title'=>$submenu);
 	 $this->help_model->update_sub_menu($id,$data,$mid);
 	 redirect('help_center/sub_menus/'.$mid);
 	 }
 	 
 	 
 	 function add_content_image() {
        $menuimage =$_FILES['photo']['name'];
        $tmpnamert  =$_FILES['photo']['tmp_name']; 	
        $dir = "upload_files/help_desk/";
        move_uploaded_file($tmpnamert, $dir . $menuimage);

        $title=$this->input->post('title');
        $con_img=$this->input->post('con_img');
        $submenu_id=$this->input->post('sub_id');
        
        $menu_id=$this->input->post('menu_id');
        $date=date('Y-m-d');
        $status='1';

        if(!empty($submenu_id)) {
        	//echo 'reached1'; die();
        	$data=array('content_type'=>1, 'con_title'=>$title, 'content'=>$con_img, 'sub_image'=>$menuimage, 'menu_id'=>$menu_id, 'sub_menu_id'=>$submenu_id, 'created_date'=>$date, 'status'=>$status);
   	  		$this->help_model->update_submenu_content_status($menu_id, $submenu_id);
   	  		$this->help_model->add_content_image($data);
   	  		redirect('help_center/index'.$menu_id);
   	  	} else {
   	  		$data=array('content_type'=>1, 'con_title'=>$title, 'content'=>$con_img, 'sub_image'=>$menuimage, 'menu_id'=>$menu_id, 'sub_menu_id'=>0, 'created_date'=>$date, 'status'=>$status);
   	 		$this->help_model->update_content_status($menu_id);
            $this->help_model->add_content_image($data);
            redirect('help_center/index/'.$menu_id);
   	  	}
   	  	
 	 	redirect('help_center/index/'.$menu_id);
 	}
 	
 	
 	
 	function add_content()
 	{
 	 	$title=$this->input->post('title');
 	 	$con=$this->input->post('con');
 	 	$submenu_id=$this->input->post('sub_id');
    	$menu_id=$this->input->post('menu_id');

 	 	$date=date('Y-m-d');
 	 	$status='1';
 	 	if(!empty($submenu_id)) {
 	 		$data=array('content_type'=>2, 'con_title'=>$title, 'content'=>$con, 'sub_image'=>'no image', 'menu_id'=>$menu_id, 'sub_menu_id'=>$submenu_id, 'created_date'=>$date, 'status'=>$status);
   	  		$this->help_model->update_submenu_content_status($menu_id, $submenu_id);
   	  		$this->help_model->add_content_image($data);
            redirect('help_center/index/'.$menu_id);
   	  	} else {
			$data=array('content_type'=>2, 'con_title'=>$title, 'content'=>$con, 'sub_image'=>'no image', 'menu_id'=>$menu_id, 'sub_menu_id'=>0, 'created_date'=>$date, 'status'=>$status);   	  		
   	  		
            $this->help_model->update_content_status($menu_id);
            $this->help_model->add_content_image($data);
            redirect('help_center/index/'.$menu_id);
        }
	   	
 	}

 	
/*
*@author: Updated By: Vikas Arora
*@Desc: To handle the Linked content
*/
 	
 	 function add_content_link($ajaxRequest=null) {
 	 	$title=$this->input->post('title');
 	 	$heading=$this->input->post('heading');
 	 	$link_content=$this->input->post('link_content');
 	 	$submenu_id=$this->input->post('sub_id');
      	$menu_id=$this->input->post('menu_id');
      	$content_type = $this->input->post('content_type');
      	
 	 	$date=date('Y-m-d');
 	 	$status='1';
 	 	/*
		*Content type: 1->Content and Image
					   2-> Only Content
					   3-> Content Link
 	 	*/
 	 	$data=array('content_type'=>$content_type, 'con_title'=>$title, 'hedding'=>$heading, 'content'=>$link_content, 'sub_image'=>'no image', 'menu_id'=>$menu_id, 'sub_menu_id'=>$submenu_id, 'created_date'=>$date, 'status'=>$status);

   		$this->help_model->add_content_image($data);

   		if($ajaxRequest == 1) {
   			echo "LINK_SUCCESS";
   		} else {
   			redirect('help_center/index/'.$menu_id);	
   		}
 	 	
  	}
 	
 	function content_view($menu_id=null, $submenu_id=null) {
 		if(!is_null($submenu_id)) {
			$checkContentType = $this->help_model->checkContentType($menu_id, $submenu_id);

			if(!empty($checkContentType)) {
				if($checkContentType->content_type == 3) {
					$data['result']=$this->help_model->view_link_content($menu_id, $submenu_id);
					$this->load->view('help_center/content_link_view', $data);
				} else {
					$data['result']=$this->help_model->view_content($menu_id, $submenu_id);
					$this->load->view('help_center/content_view', $data);			
				}	

			} else {
				$data['result']=$this->help_model->view_content($menu_id, $submenu_id);
				$this->load->view('help_center/content_view', $data);	
			}
		} else {
			$checkContentType = $this->help_model->checkContentTypeMainMenu($menu_id);			
			if(!empty($checkContentType)) {
				if($checkContentType->content_type == 3) {
					$data['result']=$this->help_model->view_link_content($menu_id, $submenu_id);
					$this->load->view('help_center/content_link_view', $data);
				} else {
					$data['result']=$this->help_model->view_content_main_menu($menu_id);
					$this->load->view('help_center/content_view', $data);			
				}				
			}
		}
		
	}
	
	public function edit_content_view($cont_id){
		$checkContentType = $this->help_model->edit_view_content($cont_id);
		if(!empty($checkContentType)) {
			if($checkContentType->content_type == 3) {
				$data['result']=$this->help_model->edit_view_content($cont_id);
				$this->load->view('help_center/edit_content_links', $data);
			} else {
				$data['result']=$this->help_model->edit_view_content($cont_id);
				$this->load->view('help_center/edit_content_view', $data);			
			}	

		} else {
			$data['result']=$this->help_model->edit_view_content($cont_id);
			$this->load->view('help_center/edit_content_view', $data);	
		}		
	}
	
	public function update_content_image($cont_id){
		
		if($_FILES['photo']['name'] != ''){
			$menuimage =$_FILES['photo']['name'];
			$tmpnamert  =$_FILES['photo']['tmp_name']; 	
			$dir = "upload_files/help_desk/";
			move_uploaded_file($tmpnamert, $dir . $menuimage);
		}else if($_FILES['photo']['name']=='' && $this->input->post('hidden_content_image') != ''){
			$menuimage = $this->input->post('hidden_content_image');
		}
		$title=$this->input->post('title');
		$con_img=$this->input->post('con_img');
		$submenu_id=$this->input->post('sub_id');
		$menu_id=$this->input->post('menu_id');

        	if(!empty($submenu_id)) {
        		$data=array( 'con_title'=>$title, 'content'=>$con_img, 'sub_image'=>$menuimage);
   	  		$this->help_model->update_content_image($cont_id, $data);
   	  		redirect('help_center/sub_menus/'.$menu_id);
   	  	}

 	 	redirect('help_center/sub_menus/'.$menu_id);
	
	}
	
	public function update_content_links($cont_id){
		
		$title=$this->input->post('title');
 	 	$heading=$this->input->post('Hedding');
 	 	$link_content=$this->input->post('con_link');
		$menu_id=$this->input->post('menu_id');
 	 	$data=array('con_title'=>$title, 'hedding'=>$heading, 'content'=>$link_content);

   		$this->help_model->update_content_image($cont_id,$data);
		redirect('help_center/sub_menus/'.$menu_id);	
   		
	
	}
}
