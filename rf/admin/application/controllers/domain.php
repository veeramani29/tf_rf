<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Domain extends CI_Controller {

	public function __construct(){
      parent::__construct();
	  $this->load->database(); 
	  $this->load->model('Admin_Model');
	  $this->load->model('Domain_Model');
	  $this->check_isvalidated();
	   $this->load->model('Support_Model');
	  $this->load->library('form_validation');
	  $this->load->model('Home_Model');
	  	
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
	public function index(){
		$data['domain_list'] = $this->Domain_Model->get_domain_list(); 
		$this->load->view('domain/view',$data);
	}

	function change_color($id)
	{
		
		$data['domain_list_id'] = $this->Domain_Model->get_domain_list_id($id); 
		$data['id']=$id;
		$this->load->view('domain/color',$data);
	}
	function update_domain_color($id)
	{
		$fcolor= $_POST['fcolor'];
		$bcolor= $_POST['bcolor'];
	    $this->Domain_Model->update_domain_color($id,$fcolor,$bcolor); 
		redirect('domain/index','refresh');
	}
	function change_logo($id)
	{
		
		$data['domain_list_id'] = $this->Domain_Model->get_domain_list_id($id); 
		$data['id']=$id;
		$this->load->view('domain/logo',$data);
	}
	function change_bimage($id)
	{
		
		$data['domain_list_id'] = $this->Domain_Model->get_domain_list_id($id); 
		$data['id']=$id;
		$this->load->view('domain/bimage',$data);
	}
	function update_city($id)
	{
		$data['domain_list_cities'] = $this->Domain_Model->get_domain_list_cities($id); 
		$data['id']=$id;
	
		$this->load->view('domain/city_list',$data);
	}
	function delete_city($id,$d_id)
	{
		   $wheres = "domain_cities_id = $id";
				$this->db->delete('domain_cities', $wheres);
				redirect('domain/update_city/'.$d_id,'refresh');
	}
	function add_city($id)
	{
		$data['id']=$id;
		$data['country_list'] = $this->Domain_Model->get_country_data(); 
		$this->load->view('domain/add_city',$data);
	}
	function add_city_list($id)
	{
		//echo '<pre/>';
		//print_r($_POST);exit;
		//$city = $_POST['city'];
		for($c=0;$c<count($_POST['cityid']);$c++)
		{
		$this->Domain_Model->add_city_data($id,$_POST['cityid'][$c]);
		}
		redirect('domain/update_city/'.$id,'refresh');
	}
	function get_citylist($id)
	{
		$country = $_POST['country'];
		$data['result'] = $this->Hoteldata_Model->get_city_data($country); 
		$data['id'] = $id;
		$this->load->view('domain/view_city_list_all',$data);
		
		/*$city_list = $this->Hoteldata_Model->get_city_data($county_code); 
		echo '<label for="req" class="control-label">City Name</label>
		<div class="controls">
		<select name="city" id="selsear1" class="cho">';
		for($cm=0;$cm<count($city_list);$cm++)
		echo '<option value="'.$city_list[$cm]->cityid.'">'.$city_list[$cm]->city_name.'</option>';
												}		
		echo '</select>
									</div>';*/
	}
	function update_domain_logo($id)
	{
	    $config['upload_path'] = APP_BASE_PATH.'/admin/upload_files/'.$id.'/logo';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file'))
		{
			$error = array('error' => $this->upload->display_errors());

			$data['status'] ='<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Profile Photo!</h4>
							  '.$error['error'].'
							</div>';
				$data['domain_list_id'] = $this->Domain_Model->get_domain_list_id($id); 
				$data['id']=$id;
				$this->load->view('domain/logo',$data);
		}
		else
		{
			$cc = $this->upload->data('file');
    	
		    $image_path = WEB_DIR.'upload_files/'.$id.'/logo/'.$cc['file_name'];
			 $this->Domain_Model->update_domain_logo($id,$image_path); 
			redirect('domain/index','refresh');
		
		}
	   
	}
	function update_domain_bimage($id)
	{
	    $config['upload_path'] = APP_BASE_PATH.'/admin/upload_files/'.$id.'/logo';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file'))
		{
			$error = array('error' => $this->upload->display_errors());

			$data['status'] ='<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Profile Photo!</h4>
							  '.$error['error'].'
							</div>';
				$data['domain_list_id'] = $this->Domain_Model->get_domain_list_id($id); 
				$data['id']=$id;
				$this->load->view('domain/bimage',$data);
		}
		else
		{
			$cc = $this->upload->data('file');
    	
		    $image_path = WEB_DIR.'upload_files/'.$id.'/logo/'.$cc['file_name'];
			 $this->Domain_Model->update_domain_bimage($id,$image_path); 
			redirect('domain/index','refresh');
		
		}
	   
	}
	
	
	  private function check_isvalidated(){
		  
        if(! $this->session->userdata('sa_logged_in')){
            redirect('login/admin_login');
        }
    }
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
