<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Markup_b2c extends CI_Controller {

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
	  		//parent::check_modules($controller);
	  		$this->load->model('Privilege_Model');
	  		$sub_admin_id = $this->session->userdata('admin_id');
	  		$this->data['modules'] = $this->Privilege_Model->get_privileges_by_sub_admin_id($sub_admin_id)->result();
	  }
	 
    }


    function index(){
    //	$data['result'] = $this->markup->fetch_markups()->result();
        $data['result'] = $this->markup->fetch_B2CMarkup();
		$this->load->view('markup_b2c/B2CMarkUpview',$data);
    }


    function b2c_markup_chk()
       {
       	 
     
       	$api=$this->input->post('api');
       	$res = $this->markup->b2c_markup_chk($api);
       	 
       	if($res != 0){
				$data['status'] = '0';
			}else{
 			   $data['status'] = '1';
			}
			echo json_encode($data);
       }
       
       
    function del_mark($id){ 
		if((int)$id > 0){
   			$this->markup->delete_markup($id);  
 	  	}
 	  	redirect('markup_b2c');
    }

    function save_markup_b2c(){ 
    
       $api = $this->input->post('api');
      $markup = $this->input->post('markup');
      $date=date('Y-m-d');
        $data= array(
        'markup_type'=>'Generic',
        'markup'=>$markup,
        'api_id'=>$api,
        'created_date'=>$date,
        'status'=>'1'
         );
         
	  $this->markup->add_markup_b2c($data);	   	
	  redirect('markup_b2c');
	}
	
	
	

	function save_markup_b2c_geo(){ 
	
	  $this->markup->add_markup_b2c_geo();	   	
	  redirect('markup_b2c');
	}
    
	function add_markup_gen(){
      	$data['apis'] = $this->markup->fetch_api();
		//$data['apis'] = $this->Api_Model->get_api_filtered();
		$this->load->view('markup_b2c/markup_b2c_gen',$data);
	}

	function add_markup_geo(){
		$data['countries'] = $this->markup->get_countries_filtered();
		$this->load->view('markup_b2c/markup_b2c_geo',$data);
	}

	/*function edit(){
		$data['result'] = $this->markup->get_b2c_markup_by_id($id,$type)->row();
		$data['id'] = $id;
		$data['type'] = $type;
		//echo '<pre>';print_r($data['result']);
		$this->load->view('markup_b2c/edit_markup');
	}
	*/
	
	function edit($id){
	   //$data['apis'] = $this->markup->fetch_api();
	   //$data['country'] = $this->markup->fetch_countries();
	   $data['result'] = $this->markup->GetMarkupById($id)->row();
	   $data['id'] = $id;
	   $this->load->view('markup_b2c/edit_markup', $data);
	}
	
 
/*	function update(){
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		$markup = $this->input->post('markup');
		$this->markup->update_markup_b2c($id,$markup);
		redirect('markup_b2c');
	}
	 
	 	*/
	 
		 
	function update(){
		$country= $this->input->post('country');
		$api= $this->input->post('api');
		$markup= $this->input->post('markup');
	 	$id = $this->input->post('id');
	 	$data=array('markup'=>$markup, 'api_id'=>$api, 'country'=>$country);
 
		$this->markup->update_markup_b2c($id,$data);
		redirect('markup_b2c');
	}

	function update_b2c_markup($id){
		$markup= $this->input->post('markup');
	 	$data=array('markup'=>$markup);
 		$this->markup->update_markup_b2c($id,$data);
		redirect('markup_b2c');
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
 	{
 		 redirect('markup_b2c/get_markup');
 		}	
	 	}
	 	}
	 
private function check_isvalidated(){
		
		if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in'))
	   {
		       redirect('login/index');
      }
	   }  
	   
	   
     function add_markup_specific(){
      $data['apis'] = $this->markup->fetch_api();
		$data['agents'] = $this->markup->fetch_agents();
      $data['country'] = $this->markup->fetch_countries();
		//$data['agents'] = $this->markup->get_agents_filtered();
		//echo '<pre>';print_r($data['result']);
		$this->load->view('markup_b2c/markup_b2c_spe',$data);
	}
	
	
	function save_markup_specific()
	{
		$country=$this->input->post('country');
		$api=$this->input->post('api');
		$markup=$this->input->post('markup');
		$date=date('Y-m-d');
		
		$data=array('markup_type'=>'Specific',
						'markup'=>$markup,
						'api_id'=>$api,
						'country'=>$country,
						'created_date'=>$date,
						'status'=>'1');
						
		$this->markup->save_markup_spe($data);		
		redirect("markup_b2c");		
 	}
 	
 	
 	   function b2c_spe_markup_chk()
       {
        
       	$country=$this->input->post('con');
       	$api=$this->input->post('api');
       	$res=$this->markup->b2c_spe_markup_chk($country,$api);
        
       	if($res != 0){
				$data['status'] = '0';
			}else{
 			   $data['status'] = '1';
			}
			echo json_encode($data);	
       }


       public function AddB2CMarkup()
	{

		$this->load->view('markup_b2c/AddB2CMarkup');
	}

	public function EditB2CMarkup($MarkupDiscountId)
	{
		
		$data['MDDetail'] = $this->markup->MDDetail($MarkupDiscountId);
		$this->load->view('markup_b2c/EditB2CMarkup',$data);
	}

	public function SaveB2CMarkUp()
	{
		$B2CMarkup = $this->input->post();
		
		if($B2CMarkup['AmountType'] == 'Currency') {
			 $B2CMarkup['Percent'] = '';
		}
		else {
			$B2CMarkup['Currency'] = '';
		}
		if($B2CMarkup['VFrom']!='' && $B2CMarkup['VTo']!='')
		{
			$B2CMarkup['VFrom'] = date('Y-m-d',strtotime($B2CMarkup['VFrom']));
			$B2CMarkup['VTo'] = date('Y-m-d',strtotime($B2CMarkup['VTo']));
		}
		$B2CMarkup['Status'] = 'Active';
		$this->markup->SaveB2CMarkUp($B2CMarkup);
		redirect('markup_b2c','refresh');
	}


	public function UpdateB2CMarkup($MDId)
	{
		$B2CMarkup = $this->input->post();
		
		if($B2CMarkup['AmountType'] == 'Currency') {
			 $B2CMarkup['Percent'] = '';
		}
		else {
			$B2CMarkup['Currency'] = '';
		}
		if($B2CMarkup['VFrom']!='' && $B2CMarkup['VTo']!='')
		{
			$B2CMarkup['VFrom'] = date('Y-m-d',strtotime($B2CMarkup['VFrom']));
			$B2CMarkup['VTo'] = date('Y-m-d',strtotime($B2CMarkup['VTo']));
		}
		$this->markup->UpdateB2CMarkUp($MDId,$B2CMarkup);
		redirect('markup_b2c','refresh');
	}

	public function UpdateB2CMarkupStatus($MDId,$Status)
	{
		$data['Status'] = $Status;
		$this->markup->UpdateB2CMarkupStatus($MDId,$data);
		redirect('markup_b2c','refresh');
	}


       public function DeleteB2CMarkup($MDId)
	{
		$this->markup->DeleteB2CMarkup($MDId);
		redirect('markup_b2c','refresh');
	}
 
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
