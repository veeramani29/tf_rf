<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language_Library extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database(); 
		$this->load->model('Language_Library_Model');
		$this->load->model('Admin_Model');
		$this->load->model('Domain_Model');
		$this->load->model('Home_Settings_Model');
		$this->load->library('form_validation');
		$this->load->model('Support_Model');
		$this->load->model('Email_Model');
		$this->load->model('Home_Model');
		$this->load->model('B2c_Model');
		$this->load->model('B2B_Model');
		$this->load->model('Privilege_Model');
		$this->check_isvalidated();
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		if($this->session->userdata('admin_logged_in')){
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
	public function addPagesForm(){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			$data['modules'] = $this->Language_Library_Model->getAllModules();
			$data['pages'] = $this->Language_Library_Model->getAllPages();
			$data['sections'] = $this->Language_Library_Model->getAllSections();
			$data['types'] = $this->Language_Library_Model->getAllTypes();
			$this->load->view('language/addPages', $data);
		}else{
		  redirect('','refresh');
		}	
	}
	public function addPages(){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			$module = $this->input->post('module');
			if($module == "othermodule") $module = $this->input->post('othermodule');
			$page = $this->input->post('page');
			if($page == "otherpage") $page = $this->input->post('otherpage');
			$section = $this->input->post('section');
			if($section == "othersection") $section = $this->input->post('othersection');
			$type = $this->input->post('type');
			if($type == "othertype") $type = $this->input->post('othertype');
			$pages = array(
					'module' => $module,
					'page' => $page,
					'section' => $section,
					'type' => $type				
					);			
			$res = $this->Language_Library_Model->addPages($pages);
			if($res){
				redirect('language_library/addPagesForm');			
			}
		}else{
		  redirect('','refresh');
		}
	}
	
	public function addLanguageLabelsForm(){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			$data['modules'] = $this->Language_Library_Model->getAllModules();
			$data['pages'] = $this->Language_Library_Model->getAllPages();
			$data['sections'] = $this->Language_Library_Model->getAllSections();
			$data['types'] = $this->Language_Library_Model->getAllTypes();
			$this->load->view('language/addLanguageLabel', $data);
		}else{
		  redirect('','refresh');
		}	
	}
	
	public function addGeneralLabels(){
		$this->load->helper('text');
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			//$module = 'general';
			$page = $this->input->post('page');
			$type = $this->input->post('label');
			$label = $this->uniqueLabel($type);
			$english = $this->input->post('english');
			$arabic = $this->input->post('arabic');
			$french = $this->input->post('french');
			$german = $this->input->post('german');
			$spanish = $this->input->post('spanish');
			$farsi = $this->input->post('farsi');
			$labels = array(
					//'module' => $module,
					'page' => $page,
					'label' => $label,
					'english' => $english,
					'arabic' => $arabic,
					'french' => $french,
					'german' => $german,
					'spanish' => $spanish,
					'farsi' => $farsi
								
					);			
			$res = $this->Language_Library_Model->addGeneralLabels($labels);
			if($res){
				redirect('language_library/generalView/home');			
			}
		}else{
		  redirect('','refresh');
		}
	}
	
	public function generalView($page=false){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			$module = 'Booking_Page_BP';
			$data['labels'] = $this->Language_Library_Model->generalView($module,$page);
			$this->load->view('language/allGeneralLabels',$data);	
		}else{
			  redirect('','refresh');
		}
	}
	
		public function apartmentlView($page=false){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			$module = 'apartment';
			$data['labels'] = $this->Language_Library_Model->apartmentView($module,$page);
			$this->load->view('language/allapartmentLabels',$data);	
		}else{
			  redirect('','refresh');
		}
	}
	
	
	public function generalViewLabels(){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			$module = $this->input->post('module');
			$page = $this->input->post('page');
			$labels = $this->input->post('label');
			$label = $this->uniqueLabel($labels);
			if($label && $page && $module){
				$data = $this->Language_Library_Model->generalViewLabels($module,$page,$label);
				if(!empty($data)){
					$response = array(
							  'id' => $data->id,
							  'label'=>$data->label,
							  'english'=>$data->english,
							  'arabic'=>$data->arabic,
							  'german'=>$data->german,
							  'french'=>$data->french,
							  'spanish'=>$data->spanish,
							  'farsi'=>$data->farsi,
							  'status'=>1
							);
				}else{
					$response = array('error'=>'There was an error, Please check it','status'=>0);
				}
				
			}else{
				$response = array('error'=>'There was an error, Please check it','status'=>0);
			}
			echo json_encode($response);
		}else{
			  redirect('','refresh');
		}
	}
	public function getGeneralLabels($home){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			$return = $this->Language_Library_Model->getGeneralLabels($home);
			
		}else{
			  redirect('','refresh');
		}
	}
	public function updateGeneralLabels(){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			$module = $this->input->post('module');
		 // echo $module; exit();
			$page = $this->input->post('page');
				 // echo $page; exit();
			$id = $this->input->post('id');
			$label = $this->input->post('label');
			$english = $this->input->post('english');
			$arabic = $this->input->post('arabic');
			$french = $this->input->post('french');
			$german = $this->input->post('german');
			$spanish = $this->input->post('spanish');
			$farsi = $this->input->post('farsi');
			$labels = array(
					'label' => $label,
					'module' => $module,
					'page' => $page,
					'english' => $english,
					'arabic' => $arabic,
					'french' => $french,
					'german' => $german,
					'spanish' => $spanish,
					'farsi' => $farsi
				 	);	
				//	print_r($labels);  	
			$res = $this->Language_Library_Model->updateGeneralLabels($labels,$id);
			$languages = array('english','arabic','german','french','spanish','farsi');
			for($l=0;$l<count($languages);$l++){
				if($module == 'general' && ($page == 'home')){
					//echo "home_lang.php";  exit();
					$res = $this->updatelangfile($languages[$l],'home_lang.php',$page,$module);
					//$res = $this->updatelangfile($languages[$l],'test_home.php',$page,$module);
				}else if($module == 'apartment'){
				//	echo "apartment_lang.php";  exit();
					$res = $this->updatelangfile($languages[$l],'apartment_lang.php',$page,$module);
					//$res = $this->updatelangfile($languages[$l],'test_apart.php',$page,$module);
				}else if(($module == 'general') && ($page != 'home')){
				//echo "dashboard_lang.php";  exit();
					$res = $this->updatelangfile($languages[$l],'dashboard_lang.php',$page,$module);
					//$res = $this->updatelangfile($languages[$l],'dashboard_lang.php',$page,$module);
				}
			}
			//exit();
			if($res){
				$response = array('msg'=>'updated successfully','status'=>1);	
			}else{
				$response = array('msg'=>'There was an error','status'=>0);	
			}
			
		}else{
		  redirect('','refresh');
		}
		echo json_encode($response);
	}
	public function deleteGeneralLabel($page,$id){
		$res = $this->Language_Library_Model->deleteGeneralLabel($page,$id);
		if($res){
			redirect('language_library/generalView/'.$page);	
		}
	}
	public function getAllLanguagePages(){
		$data['pages'] = $this->Language_Library_Model->getAllLanguagePages();
		$this->load->view('language/viewLanguagePages',$data);	
	}
	
	public function getOneLanguagePage($id){
		$data['edit'] = $this->Language_Library_Model->getOneLanguagePage($id);
		$this->load->view('settings/editLanguagePage',$data);	
	}
	public function getPages($module){
		$data['modules'] = $this->Language_Library_model->getPages($module);
	}
	
	public function getSections($module,$pages){
		$data['sections'] = $this->Language_Library_model->getSections($module,$pages);
	}
	
	public function getTypes($module,$pages,$sections){
		$data['types'] = $this->Language_Library_model->getTypes($module,$pages,$sections);
	}
	
	public function uniqueLabel($string) {
		//Lower case everything
		$string = ucwords($string);
		//Make alphanumeric (removes all other characters)
		/*$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		//Clean up multiple dashes or whitespaces
		$string = preg_replace("/[\s-]+/", " ", $string);
		//Convert whitespaces and underscore to dash
		$string = preg_replace("/[\s_]/", "-", $string);*/
		return $string;
	}
	
	public function updatelangfile($my_lang,$my_file,$page,$module){
		$this->load->helper('file');
		$query = $this->Language_Library_Model->generalHomeLanguage($page,$module);

		//echo "<pre/>"; print_r($query->result()); exit;
		$lang=array();
		$langstr="<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		       "."\n\n";
		foreach ($query->result() as $row){
			$val =  $row->$my_lang;
		    //$lang['error_csrf'] = 'This form post did not pass our security checks.';
		    $langstr.= "\$lang['".$row->label."'] = \"$val\";"."\n";
		}
		if ( !write_file('../application/language/'.$my_lang.'/'.$my_file, $langstr))
		{
		     return false;
		}
		else
		{
		     return true;
		}
	
    	}

    	public function language(){
    		$data['languages'] = $this->Language_Library_Model->getContent();
    		//echo print_r($data);exit;
    		$this->load->view('language/language',$data);
    	}

    	public function view_content($page){

    		$data['content'] = $this->Language_Library_Model->viewContent($page);
    		$this->load->view('language/view_content',$data);
    	}
    	public function getlanguage($id){
    		$data['edit'] = $this->Language_Library_Model->editlanguages($id);
    		//echo print_r($data);exit;
    		$this->load->view('language/editLanguage',$data);
    	}

    	public function update_language($id){
    	
    	$english = $this->input->post('english');
    	$arabic = $this->input->post('arabic');
    	$french = $this->input->post('french');
    	$german = $this->input->post('german');
    	$spanish = $this->input->post('spanish');
    	$farsi = $this->input->post('farsi');
        
        $this->Language_Library_Model->update_language($english, $arabic, $french, $german, $spanish, $farsi,$id);
            redirect('language_library/language', 'refresh');
        
    	}
}
