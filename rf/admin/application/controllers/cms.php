<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CMS extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database(); 
		
		$this->load->library('form_validation');
		
		$this->load->model('Email_Model');
		$this->load->model('Home_Model');
		
		$this->load->model('CMS_Model');
		$this->load->model('Privilege_Model');
		$this->check_isvalidated();
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		if($this->session->userdata('admin_logged_in')){
			$this->load->helper('url');
			$controller = $this->router->fetch_class();
			$this->load->model('Privilege_Model');
			$sub_admin_id = $this->session->userdata('admin_id');
			$this->data['modules'] = $this->Privilege_Model->get_privileges_by_sub_admin_id($sub_admin_id)->result();
		}

	}
	  
	private function check_isvalidated(){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
	    	}else{
	    		redirect('login/index');
	    	}
	}
	public function addNewPageForm(){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			$this->load->view('CMS/addNewPagesForm');
		}else{
		  redirect('','refresh');
		}	
	}
	
	public function addNewPageDetails(){
		
		$this->load->helper('text');
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			
			$title = $this->input->post('title');
			$label = $this->uniqueLabel(substr($title, 0,100));
			$english = $this->input->post('english');
			/*$arabic = $this->input->post('arabic');
			$french = $this->input->post('french');
			$german = $this->input->post('german');
			$spanish = $this->input->post('spanish');*/
			$dutch = $this->input->post('dutch');
			$this->form_validation->set_rules('english', 'english', 'trim|required|min_length[3]|xss_clean');
        	/*$this->form_validation->set_rules('arabic', 'arabic', 'trim|required|min_length[3]|xss_clean');        
        	$this->form_validation->set_rules('french', 'french', 'required|xss_clean');
			$this->form_validation->set_rules('german', 'german', 'trim|required|min_length[3]|xss_clean');
        	$this->form_validation->set_rules('spanish', 'spanish', 'trim|required|min_length[3]|xss_clean'); */       
        	$this->form_validation->set_rules('dutch', 'dutch', 'required|xss_clean');
			$exists = $this->CMS_Model->isTitleExists($label);
			if($this->form_validation->run($this) == FALSE) 
			{
			    $data['notvalid'] = "Please enter the content for all the languages";		
			    $this->load->view('CMS/addNewPagesForm',$data);	
			}else if($exists){
				$data['notvalid'] = "Page title already Exists, Please use another one";		
			    $this->load->view('CMS/addNewPagesForm',$data);
			}else{
				$labels = array(
						'title' => $title,
						'english' => $english,
						/*'arabic' => $arabic,
						'french' => $french,
						'german' => $german,
						'spanish' => $spanish,*/
						'dutch' => $dutch,
						'slug' => $label,
						'url' => '',
						'guid' => ''			
						);			
				$res = $this->CMS_Model->addNewPageDetails($labels);
				if($res){
					redirect('cms/viewAllPages');			
				}
			}
		}else{
		  redirect('','refresh');
		}
	}
	
	public function isTitleExists(){
		$type = $this->input->post('data');
		$label = $this->uniqueLabel(substr($type, 0,100));
		$exists = $this->CMS_Model->isTitleExists($label);
		if($exists){
			$response = array('s'=>'Sorry Dear, Page title is already exists please use another title','status'=>0);
		}else{
			$response = array('s'=>'Page title available','status'=>1);
		}
		echo json_encode($response);
	}
	
	public function viewAllPages(){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			$data['pages'] = $this->CMS_Model->viewAllPages();
			$this->load->view('CMS/viewPages',$data);
		}else{
		  redirect('','refresh');
		}	
	}
	
	public function editPage($id){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			if($id){
				$data['edit'] = $this->CMS_Model->editPage($id);
				$this->load->view('CMS/editPage',$data);
			}else{
				redirect('cms/viewAllPages');
			}
			
		}else{
		  redirect('','refresh');
		}	
	}
	
	public function updatePage($id){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			if($id){
				$english = $this->input->post('english');
				/*$arabic = $this->input->post('arabic');
				$french = $this->input->post('french');
				$german = $this->input->post('german');
				$spanish = $this->input->post('spanish');*/
				$dutch = $this->input->post('dutch');
				$this->form_validation->set_rules('english', 'english', 'trim|required|min_length[3]|xss_clean');
				/*$this->form_validation->set_rules('arabic', 'arabic', 'trim|required|min_length[3]|xss_clean');        
				$this->form_validation->set_rules('french', 'french', 'required|xss_clean');
				$this->form_validation->set_rules('german', 'german', 'trim|required|min_length[3]|xss_clean');
				$this->form_validation->set_rules('spanish', 'spanish', 'trim|required|min_length[3]|xss_clean');*/        
				$this->form_validation->set_rules('dutch', 'dutch', 'required|xss_clean');
				if($this->form_validation->run($this) == FALSE) 
				{
					$data['notvalid'] = "Please enter the content for all the languages";
					$data['edit'] = $this->CMS_Model->editPage($id);
					$this->load->view('CMS/editPage',$data);	
				}else{
					$labels = array(
							'id' => $id,
							'english' => $english,
							/*'arabic' => $arabic,
							'french' => $french,
							'german' => $german,
							'spanish' => $spanish,*/
							'dutch' => $dutch,
							);			
					$res = $this->CMS_Model->updatePage($labels);
					if($res){
						redirect('cms/viewAllPages');			
					}
				}
			}else{
				redirect('cms/viewAllPages');
			}
			
		}else{
		  redirect('','refresh');
		}
	}
	
	public function deletePage($id){
		$res = $this->CMS_Model->deletePage($id);
		if($res){
			redirect('cms/viewAllPages');	
		}
	}
	
	public function updatePageStatus($id,$value){
		$status = array('status'=>$value);
		$res = $this->CMS_Model->updatePageStatus($id,$status);
		if($res){
			redirect('cms/viewAllPages');	
		}
	}
	public function uniqueLabel($string) {
		//Lower case everything
		$string = strtolower($string);
		//Make alphanumeric (removes all other characters)
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		//Clean up multiple dashes or whitespaces
		$string = preg_replace("/[\s-]+/", " ", $string);
		//Convert whitespaces and underscore to dash
		$string = preg_replace("/[\s_]/", "-", $string);
		return $string;
	}
	public function contact(){
		$data['currentAddress'] = $this->CMS_Model->currentAddress()->row();
		$this->load->view('CMS/view_contact', $data);
	}

	public function addcontact() {
		$address = $this->input->post('address');
		$contact = $this->input->post('contact');
		$email = $this->input->post('email');
		$website = $this->input->post('website');

		
		$data = array('address'=>$address, 
					  'contact'=>$contact,
					  'email'=>$email,
					  'website'=>$website);


		$this->CMS_Model->addcontact($data);

		redirect(WEB_URL.'cms/contact');
	}
	
}
?>
