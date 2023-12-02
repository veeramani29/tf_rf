<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

	

		public function __construct()
		{
		parent::__construct();
		$this->load->model('Products_Model');


		
		}

		public function index()
		{


		$get_all_status=$this->Products_Model->get_all_status();
		$data['get_all_status']=$get_all_status;

$config['base_url'] = base_url('products');
$config['total_rows'] = $get_all_status['status']['Total'];
$config['per_page'] = 10; 
$config["uri_segment"] = 2;

// Use pagination number for anchor URL.
$config['use_page_numbers'] = TRUE;
//$config['page_query_string'] = TRUE;
$config['num_links'] = $get_all_status['status']['Total'];
//Adding Enclosing Markup
$config['full_tag_open'] = '<ul class="pagination">';
$config['full_tag_close'] = '</ul>';
//Customizing the First Link
$config['first_link'] = 'First';
$config['first_tag_open'] = '<li>';
$config['first_tag_close'] = '</li>';
//Customizing the Last Link
$config['last_link'] = 'Last';
$config['last_tag_open'] = '<li>';
$config['last_tag_close'] = '</li>';
//Customizing the "Next" Link
$config['next_link'] = '»';
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '</li>';
//Customizing the "Previous" Link
$config['prev_link'] = '«';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';
//Customizing the "Digit" Link
$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';
//Customizing the "Current Page" Link
$config['cur_tag_open'] = '<li><a class="current">';
$config['cur_tag_close'] = '</a></li>';



$page = ($this->uri->segment(2)) ? $this->uri->segment(2)-10 : 0;
$this->pagination->initialize($config); 
$data["links"] =$this->pagination->create_links();
$get_all_products=$this->Products_Model->get_all_products($config["per_page"], $page);
$data['all_products']=$get_all_products;

		$this->load->view('productlist',$data);
		}

	public function edit($edit_id='')
	{

		if($edit_id!=null){

$data['error_msg']='';$data['success_msg']='';

$editor_id=$this->session->userdata('admin_data')['user_id'];
//$this->form_validation->set_rules('product_name', 'Product Name', 'trim|required');
$this->form_validation->set_rules('product_title', 'Product Title', 'trim|required|xss_clean|is_unique_edit['.PRODUCTS.'.product_title.product_id.'.$edit_id.']');
$this->form_validation->set_rules('product_desc', 'Product Desc', 'trim|required|xss_clean');
$this->form_validation->set_rules('product_features_desc', 'Product Features', 'trim|required|xss_clean');
//$this->form_validation->set_message('error_msg', 'text dont match captcha');


		if ($this->form_validation->run() == TRUE)
		{ 


		$config['upload_path'] = '../product_img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('product_image') && $this->upload->data('product_logo_image_url')==null)
		{
			$data = array('error_msg' => $this->upload->display_errors());

		}
		else
		{
			$upload_data =$this->upload->data();
			
			$post_data=$this->input->post();
			$post_data['modified_by']=$editor_id;
			$post_data['modified_on']=date("Y-m-d H:i:s");
			if($upload_data['file_name']!=null){
				$time_conc=time().$upload_data['file_ext'];
			rename($upload_data['full_path'], $upload_data['file_path'].$time_conc);
			$post_data['product_logo_image_url']=$time_conc;
			}
			if(isset($post_data['product_img_val'])){

				unset($post_data['product_img_val']);
			}
			
			$get_results=$this->Products_Model->update_products($post_data,$edit_id);
			$data['success_msg']='Successfully updated products details';
			
		}



			
		}


		$get_all_product_imgs=$this->Products_Model->get_products_images($edit_id);

		$get_all_products=$this->Products_Model->get_edit_products($edit_id);
		$data['edit_products']=$get_all_products;
		$data['edit_product_imgs']=$get_all_product_imgs;
		$this->load->view('add_product',$data);
		}else{
		$this->load->view('errors/error_404');
		}
	}

public function view($view_id='')
	{
		if($view_id!=null){
		$get_all_products=$this->Products_Model->get_edit_products($view_id);
		$data['view_products']=$get_all_products;
		$this->load->view('view_product',$data);
		}else{
		$this->load->view('errors/error_404');
		}
		
	}

	public function upload_img($id='')
	{
		$data['pro_id']=$id;
		$this->load->view('ajax/photo',$data);
	}

	public function uploading_img()
	{

		$editor_id=$this->session->userdata('admin_data')['user_id'];

				$post_images=array();$get_last_id=array();
			$target_dir =PRO_IMAGES;
			$j = 0; 
			$target_path='';
				for ($i = 0; $i < count($_FILES['product_images']['name']); $i++) {
				$validextensions = array("jpeg", "jpg", "png");
				$ext = explode('.', basename($_FILES['product_images']['name'][$i]));   
				 $file_extension = end($ext); // Store extensions in the variable.
				
				 $time_conc=time().rand().".".$file_extension;
				  $target_path = $target_dir . $time_conc;   
				$j = $j + 1;     
				if (($_FILES["product_images"]["size"][$i] < 100000)    
				&& in_array($file_extension, $validextensions)) {
				if (move_uploaded_file($_FILES['product_images']['tmp_name'][$i], $target_path)) {
				$post_data['product_images_url']=$time_conc;
				$post_data['product_id']=$this->input->post('pro_id');
				$post_data['added_by']=$editor_id;
				$post_data['added_on']=date("Y-m-d H:i:s");
				$get_last_id[]=$this->Products_Model->insert_products_images($post_data);
				$post_images[]=$time_conc;
				$r=1;
				} else {    
				echo $j. ').please try again!.';
				}
				} else {   
				echo $j. ').***Invalid file Size or Type***';
				}

				}

if($r==1){
	echo json_encode(array('response'=>1,'product_images_url'=>$post_images,'id'=>$get_last_id));
}
				
				// rename($upload_data['full_path'], $upload_data['file_path'].$time_conc);
			
			
			
			
		

	
	}

	public function add()
	{

$post_image=array();
$data['error_msg']='';
$data['success_msg']='';
$this->form_validation->set_rules('product_name', 'Product Name', 'trim|required|xss_clean|is_unique['.PRODUCTS.'.product_name]');

$this->form_validation->set_rules('product_title', 'Product Title', 'trim|required|xss_clean|is_unique['.PRODUCTS.'.product_title]');
$this->form_validation->set_rules('product_desc', 'Product Desc', 'trim|required|xss_clean');
$this->form_validation->set_rules('product_features_desc', 'Product Features', 'trim|required|xss_clean');



		if ($this->form_validation->run() == TRUE)
		{ 
			

			$config['upload_path'] = '../product_img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload('product_image'))
		{
			$data = array('error_msg' => $this->upload->display_errors());

		}
		else
		{
			$upload_data =$this->upload->data();
			$time=time().$upload_data['file_ext'];
			rename($upload_data['full_path'], $upload_data['file_path'].$time);
			
			$post_data=$this->input->post();
			$post_data['product_logo_image_url']=$time;
			$post_data['added_by']=$this->session->userdata('admin_data')['user_id'];
			$post_data['added_on']=date("Y-m-d H:i:s");
			if(isset($post_data['product_img_val'])){

				$post_image=$post_data['product_img_val'];
				unset($post_data['product_img_val']);
			}
			
			
			$get_last_id=$this->Products_Model->insert_products($post_data);
			
			if(array_key_exists(0, $post_image)){
				
			$this->Products_Model->update_products_images($post_image,$get_last_id);
			}
			$this->Products_Model->unlink_unwanted_images();
			$data['success_msg']='Successfully added  products details';
			
		}



			
		}


	
		$this->load->view('add_product',$data);
	}
			public function	delete($id){
						$this->db->where('product_id',$id);
						$this->db->delete(PRODUCTS);
						redirect(base_url('products'));
						}

						public function	delete_img($id){
						$this->db->where('id',$id);
						$this->db->delete(TBL_PRODUCT_IMAGES);
						
						}

			public function	inactive($id){
			
			$this->db->where('product_id',$id);
			$this->db->update(PRODUCTS,array('product_status' => 'Inactive' ));
			redirect(base_url('products'));
			}
			public function	active($id){
			
			$this->db->where('product_id',$id);
			$this->db->update(PRODUCTS,array('product_status' => 'Active' ));
			redirect(base_url('products'));
			}
	
}
