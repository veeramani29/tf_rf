<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Markup_b2b extends CI_Controller {

	public function __construct(){
      parent::__construct();
	  $this->load->database(); 
	  $this->load->model('Admin_Model');
	  $this->load->model('Domain_Model');
	  $this->load->model('Api_Model');
	  $this->check_isvalidated();	
      $this->load->library('form_validation');
     
	  $this->load->model('Support_Model');
	  $this->load->model('Home_Model');
	  
	   $this->load->model('markup');
		//$this->load->model('markup_b2c_model', 'markup_b2c_model', true);	  
	  
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


    function index(){
    //	$data['result'] = $this->markup->fetch_markups_b2b()->result();
    	$data['result'] = $this->markup->fetch_markup_b2b()->result();
    	//echo '<pre>';print_r($data['result']);die;
    	$this->load->view('markup_b2b/view',$data);
    }

    function del_mark($id){ 
		if((int)$id > 0){
   			$this->markup->delete_markup_b2b($id);  
 	  	}
 	  	redirect('markup_b2b');
    }

    function save_markup_b2b(){ 
    $agent=$this->input->post('agent');
    $api = $this->input->post('api');
    $mark_up = $this->input->post('markup');
    $date=date('Y-m-d');
    $data= array(
     			 'markup_type'=>"Geniric",
             'markup'=>$mark_up,
             'agent_id'=>$agent,
             'api_id'=>$api,
             'created_date'=>$date,
             'status'=>1
    );
    
	  $this->markup->add_markup_b2b($data);	   	
	  redirect('markup_b2b');
	}

	function save_markup_b2b_agent(){ 
		// $res = $this->input->post();
		// echo '<pre>';print_r($res);die;
		$agent=$this->input->post('agent');
	    $markup = $this->input->post('markup');
	    $product = $this->input->post('api');
	    //$country = $this->input->post('country');
	    $date=date('Y-m-d');
    
	    $data= array(
	        'markup_type'=>"Specific",
	        'markup'=>$markup,
	        'agent_id'=>$agent,
	        'product'=>$product,
	        'created_date'=>$date,
	        'status'=>1
	    );
    
		$this->markup->add_markup_b2b_agent($data);	   	
		redirect('markup_b2b');
	}
    
	function add_markup_gen(){
		$data['agents'] = $this->markup->fetch_agents();
	//echo "<pre>";	print_r($data['agents']);
		$data['apis'] = $this->markup->fetch_api();
		$this->load->view('markup_b2b/markup_b2b_gen',$data);
	}

	function add_markup_agent(){
      $data['apis'] = $this->markup->fetch_api();
	  $data['agents'] = $this->markup->fetch_agents();
      $data['country'] = $this->markup->fetch_countries();
		//$data['agents'] = $this->markup->get_agents_filtered();
		//echo '<pre>';print_r($data['result']);
		$this->load->view('markup_b2b/markup_b2b_agent',$data);
	}

/*	function edit($id,$type){
		$data['result'] = $this->markup->get_b2b_markup_by_id($id,$type)->row();
		$data['id'] = $id;
		$data['type'] = $type;
		//echo '<pre>';print_r($data['result']);
		$this->load->view('markup_b2b/edit_markup',$data);
	}
	*/
	
	function edit($id,$type){
		// $data['country'] = $this->markup->fetch_countries();
	   	$data['agents'] = $this->markup->fetch_agents();
		$data['result'] = $this->markup->get_b2b_markup_by_id($id,$type)->row();
		$data['type'] = $type;
		$data['id'] = $id;
		//echo '<pre>';print_r($data['result']);die;
 		$this->load->view('markup_b2b/edit_markup',$data);
	}
	
	
	
	function update(){
		$agent= $this->input->post('agent');
		$country= $this->input->post('country');
		$api= $this->input->post('api');
		$markup= $this->input->post('markup');
	 	$id = $this->input->post('id');
	 	$data=array('markup'=>$markup,'agent_id'=>$agent, 'api_id'=>$api, 'country'=>$country);
 
		$this->markup->update_markup_b2b($id,$data);
		redirect('markup_b2b');
	}

	function update_b2b_markup($id,$type){
		//$res = $this->input->post();
		//echo '<pre>';print_r($res);die;
		$markup= $this->input->post('markup');
		if($type == 1){
			$data=array('markup'=>$markup);
		}else if($type == 2){
			$agent= $this->input->post('agent');
			$data=array('markup'=>$markup,'agent_id'=>$agent);
		}
		$this->markup->update_markup_b2b($id,$data);
		redirect('markup_b2b');
	}



    //    function index(){
	   // 	$data['result'] = $this->markup->get_all_countries();
	   // 	$this->load->view('markup_b2c/markup_b2c',$data);
	   // }
	   
	   function get_markup(){
	   	//$this->markup->update_status($sid);
	   	$data['result'] = $this->markup->fetch_markups()->result();
	   	//echo '<pre>';print_r($data['result']);
	   	$this->load->view('markup_b2c/view',$data);
	   }
	   
	   
    
    
    function save_markup_all()
    {
    	 ;
    	 
    if($this->input->post('generic') && $this->input->post('generic')=='Submit')
    {
    	$this->markup->add_markup_b2c_all();    	
    }
       redirect('markup_b2c/get_markup');
    }
    
     



public function edit_mar_b2c($eid)
	{
		
		$data['result'] = $this->markup->edit_b2c_markup($eid);
		 //echo '<pre>';print_r($data['result']); exit();
		$data['res'] = $this->markup->get_all_countries();
		$this->load->view('markup_b2c/edit_markup_b2c',$data);
	}
	
	
public function get_b2b()
	{
		$data['result'] = $this->markup->get_b2b_markups();
		$this->load->view('markup_b2b/view',$data);
	}




 function update_b2c($sid)
	   { 
	     //  $this->markup->update_status($sid);
	   	if($this->input->post('b2c') && $this->input->post('b2c')=='Submit')
	   {
//	   	 print_r($this->markup->update_markup_b2c($eid)); exit();
	   		$this->markup->update_markup_b2c();
	   }
	   		 redirect('markup_b2c/get_markup');
 	   }
	 
	 function status($sid)
	 {
 	if($this->markup->update_status($sid))
 	{
 		 redirect('markup_b2c/get_markup');
 		}	
	 	}
	 
private function check_isvalidated(){
		
		if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in'))
	   {
		       redirect('login/index');
      }
	   }
	   
	   
       function add_markup_chk()
       {
       	 
       	$agent=$this->input->post('agent');
 			$country=$this->input->post('country');
       	$api=$this->input->post('api');
       	$res = $this->markup->add_markup_chk($agent,$country,$api);
       	 
       	if($res != 0){
       	//	$data['mid'] = $res->markup_id();
				$data['status'] = '0';
			}else{
				//$data['mid'] = $res->markup_id();
 			   $data['status'] = '1';
			}
			echo json_encode($data);
       }
       
       
     function add_spe_markup_chk()
       {
       	$age=$this->input->post('age');
       	$country=$this->input->post('con');
       	$api=$this->input->post('api');
        
       	 
        	$res=$this->markup->add_spe_markup_chk($age,$country,$api);
        
       	if($res != 0){
				$data['status'] = '0';
			}else{
 			   $data['status'] = '1';
			}
			echo json_encode($data);	
       }
 
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */