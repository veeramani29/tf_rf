<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_Settings extends CI_Controller {

	
	public function __construct(){
		parent::__construct();
		$this->load->database(); 
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
		$this->load->model('Discount_Model');
		   $this->load->model('booking_model');
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
	public function index(){
		$data['isExists'] = $this->Admin_Model->getHomeSettings();
		$this->load->view('settings/home_settings',$data);	
	}
	public function addHomeSettings(){
		
		$this->form_validation->set_rules('tag_line', 'Tag Line', 'required');
		
		
			
		$values = array(
				'tag_line'=>$this->input->post('tag_line'),
				'banner_title'=>$this->input->post('banner_title'),
				'flight_offer_title'=>$this->input->post('offer_title'),
				'flight_offer_desc'=>$this->input->post('offer_desc'),
				'news_letter_title'=>$this->input->post('newsletter_title'),
				'loading_text'=>$this->input->post('loading_text'),
				'tf_offer'=>$this->input->post('offer_text'),
				'customer_support_email'=>$this->input->post('customer_support_email'),
				'customer_support_phone'=>$this->input->post('customer_support_phone'),
				'footer_copyright' => $this->input->post('footer_copyright'),
				'visa' => $this->input->post('payment_visa'),
				'master' => $this->input->post('payment_master'),
				'ideal' => $this->input->post('payment_ideal'),
				'paypal' => $this->input->post('payment_paypal'),
				'usa_exp' => $this->input->post('payment_usa_exp'),
				'other' => $this->input->post('payment_other'),
				'cert_iata' => $this->input->post('cert_iata'),
				'cert_anvr' => $this->input->post('cert_anvr'),
				'cert_nga' => $this->input->post('cert_nga'),
				'cert_woonborg' => $this->input->post('cert_woonborg')
				
				);
		$id=5;
		if($id){
			$return = $this->Admin_Model->addHomeSettings($values,$id);		
		}
		redirect('home_settings','refresh');		
	}

		public function social_links(){
		$data['results'] = $this->Admin_Model->getsocial_links();
		$this->load->view('settings/social_links',$data);
		}


	public function insurance_settings(){
		$data['results'] = $this->Admin_Model->getinsurance_settings();
		$this->load->view('settings/insurance_settings',$data);
	}


	public function insurance_settings_update(){
	$values = array(
				'local_travel_insurance'=>$this->input->post('local_travel_insurance'),
				'local_travel_insurance_tax'=>$this->input->post('local_travel_insurance_tax'),
				'travel_insurance'=>$this->input->post('travel_insurance'),
				'travel_insurance_tax'=>$this->input->post('travel_insurance_tax'),
				'cancel_insurance'=>$this->input->post('cancel_insurance'),
				'cancel_insurance_perc'=>$this->input->post('cancel_insurance_perc')

				
				
				);
		$id=1;
		if($id){
			$return = $this->Admin_Model->insurance_settings_update($values,$id);	
			
		}

		redirect('home_settings/insurance_settings','refresh');		
	}

public function social_linksupdate(){
	$values = array(
				'facebook'=>$this->input->post('Facebook'),
				'twitter'=>$this->input->post('Twitter'),
				'google'=>$this->input->post('Google'),
				'linkedin'=>$this->input->post('Linkedin'),
				'vimeo'=>$this->input->post('Vimeo'),
				'flickr'=>$this->input->post('Flickr'),
				'dribbble'=>$this->input->post('Dribbble')
				);
		$id=1;
		if($id){
			$return = $this->Admin_Model->social_linksupdate($values,$id);	
			
		}

		redirect('home_settings/social_links','refresh');		
	}

	public function backgroundForm(){

		$this->load->view('settings/backgroundForm');
	}

	public function addbackground(){
		
		$config['upload_path'] = IMAGE_UPLOAD_PATH.'home/portfolio/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('image'))
		{
			$data = array('error' => $this->upload->display_errors());
			$this->load->view('settings/backgroundForm',$data);
		}else{
			$cc = $this->upload->data('image');
    			$image_path = WEB_DIR.'upload_files/home/portfolio/'.$cc['file_name'];
		 
		}
		
		$image = $image_path;
		$images = array(
					'background_image'=>$image_path	
					);
			$return = $this->Home_Settings_Model->addBackgroundImages($images);
		
		redirect('home_settings/backgroundbanner');
	}
	public function backgroundbanner(){
		$data['background']=$this->Home_Settings_Model->getbackgroundimage();
		$this->load->view('settings/backgroundBanner',$data);
	}
	public function deletebackgroundimage($id){
		$bac = $this->Home_Settings_Model->deletebackgroundimage($id);
		redirect('home_settings/backgroundbanner');
	}
	public function updateBackgroundStatus($id,$value){
		$status = array('status'=>$value);
		$return = $this->Home_Settings_Model->updateBackgroundStatus($id,$status);
		if($return){
			redirect('home_settings/backgroundbanner');		
		}else{
			redirect('home_settings/backgroundbanner');
		}
	}
	
	public function portfolioForm(){
		$this->load->view('settings/portfolio_form');	
	}
	
	public function addPortfolio(){
		
		$config['upload_path'] = IMAGE_UPLOAD_PATH.'home/portfolio/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('image'))
		{
			$data = array('error' => $this->upload->display_errors());
			$this->load->view('settings/portfolio_form',$data);
		}else{
			$cc = $this->upload->data('image');
    			$image_path = WEB_DIR.'upload_files/home/portfolio/'.$cc['file_name'];
		 
		}
		$languages = $this->input->post('language');

		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$image = $image_path;
		$link = $this->input->post('link');
		if(is_array($languages)&&count($languages)>0){

			$images = array(
					'image'=>$image_path,
					'link'=>$link						
					);
			$return = $this->Home_Settings_Model->addPortfolioImages($images);

			if($return){
				for($i=0;$i<count($languages);$i++){
					$language = array(
							'language' => $languages[$i],
							'title'=>$title[$i],
							'description'=>$description[$i],
							'home_portfolio_id'=>$return
							);
					
					$returnid = $this->Home_Settings_Model->addPortfolioLanguages($language);	
				}
			}

		}
		redirect('home_settings/getAllPortfolio');
		
	}
	public function updatePortfolio(){

		if($_FILES['image']['name'] !== ''){
			$config['upload_path'] = IMAGE_UPLOAD_PATH.'home/portfolio/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('image'))
			{
				$data = array('error' => $this->upload->display_errors());
				$this->load->view('settings/portfolio_form',$data);
			}else{
				$cc = $this->upload->data('image');
	    			$image_path = WEB_DIR.'upload_files/home/portfolio/'.$cc['file_name'];
			 
			}
		}
		else{
			$image_path = $this->input->post('hidden_image');
		}	
		$languages = $this->input->post('languages');
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$image = $image_path;
		$link = $this->input->post('link');
		$imagesid = $this->input->post('image_id');
		$language_id = $this->input->post('language_id');
		if(is_array($languages)&&count($languages)>0){

			$images = array(
					'image'=>$image_path,
					'link'=>$link						
					);
			$return = $this->Home_Settings_Model->updatePortfolioImages($images,$imagesid);

			if($return){
				for($i=0;$i<count($languages);$i++){
					$language = array(
							'language' => $languages[$i],
							'title'=>$title[$i],
							'description'=>$description[$i],
							'home_portfolio_id'=>$imagesid
							);
					
					$languageid = $language_id[$i];
					$returnid = $this->Home_Settings_Model->updatePortfolioLanguages($language,$languageid);	
				}
			}

		}
		redirect('home_settings/getAllPortfolio');
	}
	
	public function getAllPortfolio(){
		$data['portfolio'] = $this->Home_Settings_Model->getAllPortfolio();
		$this->load->view('settings/portfolio',$data);	
	}
	
	public function getOnePortfolio($id){
		$data['edit'] = $this->Home_Settings_Model->getOnePortfolio($id);
		$this->load->view('settings/edit_portfolio',$data);		
	}
	public function deleteOnePortfolio($id){
		$ret = $this->Home_Settings_Model->deleteOnePortfolio($id);
		redirect('home_settings/getAllPortfolio');	
	}
	
	public function updatePortfolioStatus($id,$value){
		$status = array('status'=>$value);
		$return = $this->Home_Settings_Model->updatePortfolioStatus($id,$status);
		if($return){
			redirect('home_settings/getAllPortfolio');		
		}else{
			redirect('home_settings/getAllPortfolio');
		}
	}
	
	public function addFooterLinks(){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			$data['links'] = $this->Home_Settings_Model->getAllFooterLinks();
			$this->load->view('settings/add_footer_links',$data);
		}else{
		  redirect('','refresh');
		}
	}

	public function headerLinks(){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			$data['privileges'] = $this->Privilege_Model->get_module_privileges_list()->result();  
			$data['modules'] = $this->Home_Settings_Model->getAllHeaderLinks();
			
			$this->load->view('settings/edit_privileges',$data);
		}else{
		  redirect('','refresh');
		}
	}

	public function updateheaderlinks(){

		$values = array(
				'apartment'=>$this->input->post('privilege_apt'),
				'car'=>$this->input->post('privilege_car'),
				'flight'=>$this->input->post('privilege_flight'),
				'hotel'=>$this->input->post('privilege_hotel'),
				'vacation'=>$this->input->post('privilege_vac'),
				'discover'=>$this->input->post('privilege_dis'),
				'check_in'=>$this->input->post('privilege_check_in')
				
				
				);
		$this->db->where('id',1);
		$this->db->update('header_links',$values);
		  redirect('home_settings/headerLinks','refresh');
		
	}
	
	public function addFooterLinksDetails(){
		
		$this->load->helper('text');
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			$url = $this->input->post('url');
			$page = $this->input->post('page');
			$type = $this->input->post('label');
			$label = $this->uniqueLabel(substr($type, 0,25));
			$english = $this->input->post('english');
			$dutch = $this->input->post('dutch');
			
			$labels = array(
					'page' => $page,
					'url' => $url,
					'title' => $type,
					'slug' => $label,
					'english' => $english,
					'dutch' => $dutch
							
					);			
			$res = $this->Home_Settings_Model->addFooterLinksDetails($labels);
			if($res){
				redirect('home_settings/addFooterLinks');			
			}
		}else{
		  redirect('','refresh');
		}
	
	}

	public function generalViewLabels(){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			$page = $this->input->post('page');
			$id = $this->input->post('id');
			if($page && $id){
				$data = $this->Home_Settings_Model->generalViewLabels($page,$id);
				if(!empty($data)){
					$response = array(
							  'id' => $data->id,
							  'label'=>$data->slug,
							  'url'=>$data->url,
							  'english'=>$data->english,
							  'dutch'=>$data->dutch,
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
	
	public function updateGeneralLabels(){
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('sa_logged_in')){
			$page = $this->input->post('page');
			$id = $this->input->post('id');
			$url = $this->input->post('url');
			$english = $this->input->post('english');
			$dutch = $this->input->post('dutch');
			
			$labels = array(
					'url' => $url,
					'page' => $page,
					'english' => $english,
					'dutch' => $dutch
							
					);			
			$res = $this->Home_Settings_Model->updateGeneralLabels($labels,$id);
			
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
		$res = $this->Home_Settings_Model->deleteGeneralLabel($page,$id);
		if($res){
			redirect('home_settings/addFooterLinks');	
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
	public function country_management()
	{
		$data['countrydata'] = $this->Home_Settings_Model->get_all_countries_list();
		$this->load->view('settings/view_country',$data);
	}
	public function add_country()
	{
		$this->form_validation->set_rules('phonecode', 'phonecode', 'required');
		$this->form_validation->set_rules('country_code', 'Country Code', 'required');
		$this->form_validation->set_rules('country_name', 'Country Name', 'required');
		
		if($this->form_validation->run()==FALSE)
		{
	  		
			$this->load->view('settings/add_country');
		}
		else
		{
				$country = $_POST['country_name'];
				$code = $_POST['country_code'];
				$phone = $_POST['phonecode'];

				$result = $this->Home_Settings_Model->checkcountryname($country,$code,$phone);
			
			if ($result->num_rows() > 0)
			{
				
				$data['status'] = '<div class="alert alert-block alert-danger">
								  <a href="#" data-dismiss="alert" class="close">×</a>
								  <h4 class="alert-heading">One of these values already Exist.</h4>
								 
								</div>';
				
				$this->load->view('settings/add_country',$data);
			}
			else
			{
				
			 
				if($this->Home_Settings_Model->add_country($country,$code,$phone))
				{
						redirect('home_settings/country_management','refresh');
				}
				else
				{
					$data['status'] = '<div class="alert alert-block alert-danger">
								  <a href="#" data-dismiss="alert" class="close">×</a>
								  <h4 class="alert-heading">One of these values already Exist.</h4>
								 
								</div>';
				
					$this->load->view('settings/add_country',$data);
				
				}
			}
		}
		
	}
	public function edit_country($id="")
	{
		if(isset($id) && $id>0){
			$data['country']=$this->Home_Settings_Model->countryById($id);
			$this->load->view('settings/edit_country',$data);
		}else{
			redirect('home_settings/country_management','refresh');
		}
	}
	public function update_country()
	{
			$id = $_POST['country_id'];
			$country = $_POST['country_name'];
			$code = $_POST['country_code'];
			$phone = $_POST['phonecode'];

			$result = $this->Home_Settings_Model->checkcountrynameforupdate($id,$country,$code,$phone);
			
			if ($result->num_rows() > 0)
			{
			
			$data['status'] = '<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">One of these values already Exist.</h4>
							 
							</div>';
			
			$data['country']=$this->Home_Settings_Model->countryById($id);
			$this->load->view('settings/edit_country',$data);
		}
		else
		{
			$data=array('name'=>$country,
					'country_code'=>$code,
					'phonecode'=>$phone);
			$this->Home_Settings_Model->update_country($data,$id);
			redirect('home_settings/country_management','refresh');
		}
	}
	public function delete_country($id)
	{
		$this->Home_Settings_Model->delete_country($id);
		redirect('home_settings/country_management','refresh');
	}
	
	
	
	public function get_cities($country){
		 
		$country = $this->package_model->get_cities_country_v1($country);
		foreach($country as $coun){
		?>
			<option value='<?php echo $coun->IATA_CODES; ?>'><?php echo $coun->CITY; ?></option>
		<?php
		} 
	}
	
	
	
	
	public function check_in($id=''){




		$data['pages'] = $this->Home_Settings_Model->get_check_in_details($id);
		$this->load->view('settings/manage_check_in',$data);
	}

	public function add_check_in($id=''){
		//error_reporting(0);

		$data['check_in_details']='';
			$airline_code= $this->input->post('airline_list');
			$url= $this->input->post('txtUrl');
			$new_filename= $airline_code.".png";
			
			$this->form_validation->set_rules('airline_list', 'Airline', 'trim|required|xss_clean');
        	$this->form_validation->set_rules('txtUrl', 'Airline Url', 'trim|required|min_length[3]|xss_clean');
        	
			

        	
        	
        	
			if($this->input->post('check_in')=='submit'){
				
			if($this->form_validation->run() == true){
				
			
			
			if($id!=''){
				   $date_text='mod_date';
					}else{
						$date_text='add_date';
					}
					
			
			
			$data=array(
				   'airline_code'=>$airline_code,
				   'url'=>$url,
					"$date_text"=>date("Y-m-d H:i:s"),
				   'icon'=>$new_filename
				);
				if($id!=''){
				$this->db->where('id', $id);
				$this->db->update('check_in_details', $data); 
				$flight_id=$id;
				//echo $this->db->last_query();exit;
			}else{
				$this->db->insert('check_in_details', $data);
				$flight_id=$this->db->insert_id();
			}
			
				redirect('home_settings/check_in');
			}else{
				
				$data['err_msg']="Marked fields are mandatory";
			}
}
		if($id!=''){
		$data['check_in_details'] = $this->Home_Settings_Model->get_check_in_details($id);

			}
			 $data['airline_list']=$this->Discount_Model->get_airline_list();
		$this->load->view('settings/add_check_in',$data);
	}
	
	
	
	
	public function check_in_delete($id){
		$res = $this->Home_Settings_Model->check_in_delete($id);
		if($res){
			redirect('home_settings/check_in','refresh');
		}
	}
	public function check_in_updateStatus($id,$value){
		$status = array('status'=>$value);
		$res = $this->Home_Settings_Model->check_in_updateStatus($id,$status);
		if($res){
			redirect('home_settings/check_in','refresh');
		}
	}
	
	public function isTitleExists(){
		$data=$this->input->post('data');
		
		$exists = $this->Home_Settings_Model->isTitleExists($data);
		if($exists){
			$response = array('s'=>'Sorry Dear, This Airline already exists please try anothere','status'=>0);
		}else{
			$response = array('s'=>'This Airline available','status'=>1);
		}
		echo json_encode($response);
	}
}