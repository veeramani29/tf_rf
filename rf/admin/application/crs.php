<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crs extends CI_Controller {

	/**
	 * Home Constructor
	 *
	 * The constructor runs the login routines automatically
	 * whenever the class is instantiated.
	 */
	public function __construct()
    {
      	parent::__construct();
	  	$this->load->model('Crs_Model');
	 
		$this->is_admin_logged_in();
		
		$this->output->set_header("HTTP/1.1 200 OK");		
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
		$this->output->set_header("Pragma: no-cache");
    }
	
	/**
	 * index
	 * 
	 * Loading the default home dashboard page
	 *
	 * @access	public
	 * @return	bool
	 */ 
	public function index()
	{
		$this->load->view('dashboard');
		
	}
	
	/**
	 * is_admin_logged_in
	 * 
	 * Check the current admin session data if it exists or not and if it is not exists will redirect to login page
	 *
	 * @access	private
	 * @return	bool
	 */    
	private function is_admin_logged_in()
	{		  
        if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('login/index');
        }
    }
	
	/**
     * dashboard
     * 
	* Loading the admin dashboard view page
	*
	* @access	public
	* @return	void
	*/	
	public function dashboard()
	{
		$this->load->view('dashboard');
	}
	
	public function hotel_manager()
	{
		$data['hotels_list'] = $this->Crs_Model->get_all_hotel_list(); 	
		$data[] = array();
		$this->load->view('crs/hotel_manager',$data);
	}
	
    public function add_hotel_ad($sup_id)
    {
    	$data['status']='';
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
        $data['cities'] =$this->Crs_Model->get_all_city_list();
       if($_POST){
			$_POST['sup_id']=$sup_id;
			$data['all_hotel_details']=$this->Crs_Model->add_hotel_ad($_POST); 

            if($data['all_hotel_details'] == true)
            {
            redirect("crs/hotel_manager","refresh");
            }
        }else{
			$this->load->view('crs/add_hotel');
		}
    }

     public function edit_hotel_ad($sup_hotel_id)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
       	$data['status']='';
            $data['cities'] =$this->Crs_Model->get_all_city_list();
            $data['result1'] = $this->Crs_Model->detail_location($sup_hotel_id);
            $this->load->view('crs/edit_hotel_ad',$data);
    }

    public function update_hotel($supid, $id)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
            $hotel_chain_name = $this->input->post('hotel_name');
			$city = $this->input->post('city_id');
			$main_first_name = $this->input->post('first_name');
			$main_last_name = $this->input->post('last_name');
			$main_email = $this->input->post('email_id');
			$hotel_address = $this->input->post('hotel_address');
			$main_phone = $this->input->post('phone');
			$main_fax = $this->input->post('fax');
		    $hotel_desc  = $this->input->post('hotel_description');
		    $nearby_airport = $this->input->post('near_by_airport');
		    $latitude = $this->input->post('latitude');
		    $longitude = $this->input->post('longitude');
			 $city_name = $this->input->post('searchid');
            $data['all_hotel_details']=$this->Crs_Model->update_contact_info($id,$supid,$hotel_chain_name,$city, 
            	          $main_first_name, $main_last_name,
                          $main_email, $hotel_address, 
                          $main_phone,$main_fax,$hotel_desc,
                          $nearby_airport, $latitude, $longitude,$city_name
                         ); 
             redirect("crs/hotel_manager",'refresh');
    }

    function room_type_list(){
		if (!$this->session->userdata('role_id')) {
			redirect('login/index', 'refresh'); 
		}
		$supplier_id = $this->session->userdata('admin_id');
		$data['room_category']=$this->Crs_Model->room_type_list($supplier_id);
		redirect('crs/room_category'); 
	} 

    function edit_room_type(){
		if (!$this->session->userdata('role_id')) {
				redirect('login/index', 'refresh'); 
		}
		if($_POST){
			$data['room_type'] = $this->Crs_Model->edit_room_type_details($_POST);
			redirect('crs/room_type_list'); 
		}else if(isset($_GET['id'])){	
			$data['room_type'] = $this->Crs_Model->view_room_type($_GET['id']);
			$data['sup_hotel_room_type_id'] = $_GET['id'];
			$this->load->view('crs/edit_room_type',$data);
		}else{
			$this->load->view('crs/edit_room_type');
		}
	}

	public function city_list()
	{
		$this->load->view('crs/city_list');
	}
////check
	function view_all_hotels($id)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
         $data['result_view']=$this->admin_model->view_all_hotels();
         $data['id']=$id;
         $this->load->view('admin/view_all_hotels',$data);
    }

    /**
	 * Room Category
	 * 
	 * Updating Promotions
	 *
	 * @access	public
	 * @return	void
	 */
	 function room_category()
	 {
	 	 if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('login/index');
        }
         $data['result_view']=$this->Crs_Model->room_type_list();
         
         $this->load->view('crs/room_category', $data);
	}

	//delete supplier hotel room
	function delete_room_type(){
		if (!$this->session->userdata('role_id')) {
				redirect('login/index', 'refresh'); 
		}
		if(isset($_GET['id'])){	
			$data['room_type'] = $this->Crs_Model->delete_room_type($_GET['id']);
			redirect('crs/room_category'); 
		}
	}

	function capacity_list()
    {
       if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('login/index');
        }
         $data['result_view']=$this->Crs_Model->capacity_list();
         //$data['id']=$id;
         $this->load->view('crs/capacity_list',$data);
    }

    //Home adding room category 
	function add_room_type(){
		if (!$this->session->userdata('role_id')) {
				redirect('login/index', 'refresh'); 
		}
		$data['all_hotels'] = $this->Crs_Model->view_all_hotels();
		if($_POST){
			$_POST['supplier_id']=$this->session->userdata('admin_id');
			$data['room_type'] = $this->Crs_Model->add_room_type_details($_POST);
			redirect('crs/room_category');
		}else{
			$this->load->view('crs/add_room_type', $data);
		}
	}
	//Home edit capacity room 
	function edit_room_capacity()
	{
		if (!$this->session->userdata('role_id')) {
				redirect('login/index', 'refresh'); 
		}
		if($_POST){
			$data['room_capacity'] = $this->Crs_Model->edit_room_capacity_details($_POST);
			redirect('crs/capacity_list'); 
		}else if(isset($_GET['id'])){
			$data['room_capacity'] = $this->Crs_Model->view_room_capacity($_GET['id']);
			$this->load->view('crs/edit_room_capacity',$data);
		}else{
			$this->load->view('crs/edit_room_capacity');
		}
	}
	////check
      //Home edit capacity room 
	 function edit_room_capacity_details($capacity_id)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
        $this->form_validation->set_rules('hotel_name', 'Hotel Name', 'required');
        $this->form_validation->set_rules('capacity_title', 'Room Type', 'required');
        $this->form_validation->set_rules('capacity', 'Capacity', 'required');
        if($this->form_validation->run()==FALSE)
        {
            $this->load->view('admin/edit_room_capacity/'.$capacity_id);
        }
        
            $hotel_name = $this->input->post('hotel_name');
            $capacity_title = $this->input->post('capacity_title');
            $capacity = $this->input->post('capacity');
            $child_capacity = $this->input->post('child_capacity');
            $result =$this->admin_model->edit_room_capacity_details($capacity_id, $hotel_name, $capacity_title, $capacity, $child_capacity);
       
            redirect('admin/capacity_list','refresh');
        }

    //Home delete capacity room 
	function delete_capacity()
	{
		if (!$this->session->userdata('role_id')) {
				redirect('login/index', 'refresh'); 
		}
		if(isset($_GET['id'])){
		$result =$this->Crs_Model->delete_capacity($_GET['id']);
			redirect('crs/capacity_list'); 
		}else{
			redirect('crs/capacity_list'); 
		}
	}

	//Home add capacity room
	function add_room_capacity()
	{
		if (!$this->session->userdata('role_id')) {
				redirect('login/index', 'refresh'); 
		}
		$data['all_hotels'] = $this->Crs_Model->view_all_hotels();
		if($_POST){
			$_POST['supplier_id']=$this->session->userdata('admin_id');
			$result =$this->Crs_Model->add_room_capacity_details($_POST);
			redirect('crs/capacity_list'); 
		}else{
			$this->load->view('crs/add_room_capacity', $data);
		}
	}

    //Home add capacity room details
	function add_room_capacity_details()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
            $hotel_name = $this->input->post('hotel_name');
            $capacity_title = $this->input->post('capacity_title');
            $capacity = $this->input->post('capacity');
            $child_capacity = $this->input->post('child_capacity');
            $this->Crs_Model->add_capacity_details($hotel_name, $capacity_title, $capacity, $child_capacity);
            redirect('crs/capacity_list','refresh');
    }

    //Home add capacity room list
    function all_hotel_room_list()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
        $data['result_view'] = $this->Crs_Model->all_hotel_room_list();
        $this->load->view('crs/all_hotel_room_lists',$data);
    }

    //Home delete room
    function delete_room($sup_inv_cate_type_id)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('index/login', 'refresh'); 
        }
        $result =$this->Crs_Model->delete_room($sup_inv_cate_type_id);
        redirect('crs/all_hotel_room_list','refresh');
    }
    
    //Home add room
    function add_room(){
		if (!$this->session->userdata('admin_logged_in')) {
            redirect('index/login', 'refresh'); 
        }
		$data['all_hotels'] = $this->Crs_Model->view_all_hotels();
		if($_POST){
			$_POST['sup_id']=$this->session->userdata('admin_id');
			$data['result'] = $this->Crs_Model->add_rooms_list($_POST);
			redirect('crs/all_hotel_room_list'); 
		}else{
			$this->load->view('crs/add_room', $data);
		}
	}

	//home get no of rooms per hotel using id
	function get_hotelroom(){
		if (!$this->session->userdata('role_id')) {
				redirect('login/index', 'refresh'); 
		}
		if(isset($_GET['id'])){
			$data['result'] = $this->Crs_Model->edit_rooms_list($_GET['id']);
			echo json_encode($data['result']);exit;	
		}
	}

	//home get no of house rules list
	function house_rules_list()
    {
        if (!$this->session->userdata('role_id')) {
				redirect('login/index', 'refresh'); 
		}
         $data['result_view']=$this->Crs_Model->house_rules_list();
         $this->load->view('crs/house_rules_list',$data);
    }

    //home get no of house rules list 
    function house_rules($prop_id,$sup_apart_houserules_id)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
        $data['result'] = $this->Crs_Model->get_house_rules($prop_id, $sup_apart_houserules_id);
        $data['sup_apart_houserules_id']=$sup_apart_houserules_id;
        $this->load->view('crs/house_rules',$data);
    }
       
    //home edit no of house rules list    
       function edit_house_rules($id)
    {
      
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
           
          $this->Crs_Model->edit_house_rules($id,$_POST);
          redirect('crs/house_rules_list','refresh');
        }

     //home get all amenity list    
       public function amenity_list()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
        $data['result'] =$this->Crs_Model->get_global_amenities();
        $this->load->view('crs/amenity_list',$data);
    }

     //home redirction amenity list    
     public function amenity()
     {
     	$this->load->view('crs/amenity');
     }
     
      //home update amenity list
    public function update_amenity_list($id,$status,$action='')
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
        if($action == 'edit'){
           $data['result_byid']=$this->Crs_Model->get_amenity_details($id); 
           $data['action'] = "editaminity";
           $data['result'] =$this->Crs_Model->get_global_amenities();
           $this->load->view('crs/amenity_list',$data);
        }else{
           $this->Crs_Model->update_amenity_list($id,$status);
           redirect('crs/amenity_list/update', 'refresh'); 
        }
     }
 
      //home update amenity list
      public function update_amenity($id)
     {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
        $data['result']=$this->Crs_Model->get_amenity_details($id); 
        $this->load->view('crs/update_amenity', $data);
     }
     
     //home update amenity name
     public function update_amenity_name($id)
     {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
        $amenity_name=$this->input->post('amenity_name');
        //echo $amenity_name; die();
        $data['result']=$this->Crs_Model->update_amenity_name($id, $amenity_name); 
        if($data['result'] =true)
        {
        redirect('crs/amenity_list', 'refresh');
        }
     }

     //home add aminities
     function add_hotel_amenities(){
	
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
		if($_POST['Amenities']!=''){
			$this->Crs_Model->add_hotel_amenities($_POST['Amenities']);
			redirect('crs/amenity_list', 'refresh'); 
		}else{
			redirect('crs/amenity_list', 'refresh'); 
		}
	 }

	 //add amenity to the price manager
	 public function price_manager()
	 {
	 	$this->load->view('crs/price_manager');
	 }

     //add amenity to the price list
	 function price_list()
     {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
        $data['result_view']=$this->Crs_Model->price_list();
        $this->load->view('crs/price_list',$data);
     }
	
	//admin delete hotel price
	function delete_price()
	{
		if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
		if(isset($_GET['id'])){
			$this->Crs_Model->delete_price($_GET['id']);
			redirect('crs/price_list','refresh');
		}else{
			redirect('crs/price_list','refresh');
		}
	}

	//admin hotel edit_price
	function edit_price()
	{
		if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
        $path= $_SERVER['DOCUMENT_ROOT']."/WDM/vayago/public/hotelpriceimg/";
		if($_FILES){
			if(isset($_FILES['roomimage'])){
					 move_uploaded_file($_FILES["roomimage"]["tmp_name"],$path.$_FILES["roomimage"]["name"]);
					 $_POST['roomimage']=$_FILES["roomimage"]["name"];
				}if(isset($_FILES['image1'])){
					 move_uploaded_file($_FILES["image1"]["tmp_name"],$path.$_FILES["image1"]["name"]);
					 $_POST['image1']=$_FILES["image1"]["name"];
				}if(isset($_FILES['image2'])){
					 move_uploaded_file($_FILES["image2"]["tmp_name"],$path.$_FILES["image2"]["name"]);
					 $_POST['image2']=$_FILES["image2"]["name"];
				}if(isset($_FILES['image3'])){
					 move_uploaded_file($_FILES["image3"]["tmp_name"],$path.$_FILES["image3"]["name"]);
					 $_POST['image3']=$_FILES["image3"]["name"];
				}
		}
		if($_POST){
			$_POST['sup_id']=$this->session->userdata('admin_id');
			$data['rat_tac_details'] = $this->Crs_Model->update_rate_tactics_details($_POST);
			redirect('crs/price_list','refresh');
		}else if(isset($_GET['id'])){
			$data['rat_tac_details'] = $this->Crs_Model->view_rate_tactics_details($_GET['id']);
			$data['sup_rate_tactics_id']=$_GET['id'];
			$data['img_path']="http://".$_SERVER['HTTP_HOST']."/WDM/vayago/public/hotelpriceimg/";
			
			$this->load->view('crs/edit_price',$data);
		}else{
			redirect('crs/price_list','refresh');
		}
	}

	//admin add price
	function add_price()
	{
		if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
        $path= $_SERVER['DOCUMENT_ROOT']."/WDM/vayago/public/hotelpriceimg/";
		if($_FILES){
			if(isset($_FILES['roomimage'])){
				 move_uploaded_file($_FILES["roomimage"]["tmp_name"],$path.$_FILES["roomimage"]["name"]);
				 $_POST['roomimage']=$_FILES["roomimage"]["name"];
			}if(isset($_FILES['image1'])){
				 move_uploaded_file($_FILES["image1"]["tmp_name"],$path.$_FILES["image1"]["name"]);
				 $_POST['image1']=$_FILES["image1"]["name"];
			}if(isset($_FILES['image2'])){
				 move_uploaded_file($_FILES["image2"]["tmp_name"],$path.$_FILES["image2"]["name"]);
				 $_POST['image2']=$_FILES["image2"]["name"];
			}if(isset($_FILES['image3'])){
				 move_uploaded_file($_FILES["image3"]["tmp_name"],$path.$_FILES["image3"]["name"]);
				 $_POST['image3']=$_FILES["image3"]["name"];
			}
		}
		$data['all_hotels'] = $this->Crs_Model->view_all_hotels();
		if($_POST){
			$_POST['sup_id']=$this->session->userdata('admin_id');
			$data['add_rate_plans'] = $this->Crs_Model->add_rate_plans($_POST);
			redirect('crs/price_list','refresh');
		}else{
			
			$this->load->view('crs/add_price', $data);
		}
	}

	//admin add supplier
	function add_supplier(){
		$this->load->view('crs/add_supplier');
	}

	//admin getting all supplier list
	function supplier_list(){
		if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
		$data['user_info']=$this->Crs_Model->supplier_list();
		$this->load->view('crs/supplier_list',$data);
	}

	//admin deactivate supplier
	function inactive_supplier(){
		if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
		if(isset($_GET['id'])){
			$data['email_check'] = $this->Crs_Model->supplier_inactive($_GET['id']);
			redirect('crs/supplier_list', 'refresh'); 
		}
	}

	//admin activate the supplier
	function active_supplier(){
		if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
		if(isset($_GET['id'])){
			$data['email_check'] = $this->Crs_Model->supplier_active($_GET['id']);
			redirect('crs/supplier_list', 'refresh'); 
		}
	}

	//admin delete the supplier
	function delete_supplier(){
		if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
		if(isset($_GET['id'])){
			$data['email_check'] = $this->Crs_Model->supplier_delete($_GET['id']);
			redirect('crs/supplier_list', 'refresh'); 
		}
	}

	//admin active suppliers
	function active_supplierlist(){
		if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
		$data['user_info']=$this->Crs_Model->active_supplierlist();
		$this->load->view('crs/supplier_list',$data);
	}

	//admin create the user
	function create_supplier(){
		if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
		$data['country_list'] = $this->Crs_Model->get_country_list();
		if($_POST){
				$data['email_check'] = $this->Crs_Model->check_email_availability($_POST['user_email']);
			if($data['email_check']==0){
				$data['country_list'] = $this->Crs_Model->add_supplier($_POST);
				redirect('crs/supplier_list', 'refresh'); 
			}else{
				$data['fail']='fail';
				$this->load->view('crs/create_supplier',$data);
			}
		}else{
			$this->load->view('crs/create_supplier',$data);
		}
	}

    //admin create getdates
	function getDates()
	{
		if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
		if($_POST){
			$results = $this->Crs_Model->getDates($_POST);
		}
	}
    
    //admin create get room type
	function getRoomType($hotel_id)
	{
		if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
		$data['room_type'] = $this->Crs_Model->getRoomType($hotel_id);
	}

    //admin create add rate plan
	function add_rate_plan()
	{
		if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
        $target= $_SERVER['DOCUMENT_ROOT']."/WDM/vayago/public/hotelpriceimg/";
		
		move_uploaded_file($_FILES['filepath']['tmp_name'],$target.$_FILES['filepath']['name']);
		$fileimage=$_FILES['filepath']['name'];

		move_uploaded_file($_FILES['filepath1']['tmp_name'],$target.$_FILES['filepath1']['name']);
		$fileimage1=$_FILES['filepath1']['name'];

		move_uploaded_file($_FILES['filepath2']['tmp_name'],$target.$_FILES['filepath2']['name']);
		$fileimage2=$_FILES['filepath2']['name'];

		move_uploaded_file($_FILES['filepath3']['tmp_name'],$target.$_FILES['filepath3']['name']);
		$fileimage3=$_FILES['filepath3']['name'];
		
		$prop_id = $this->input->post('hotel_name');
		$room_cate = $this->input->post('room_type');
		$room_type = $this->input->post('capacity_type');
		$child_policy = $this->input->post('child_policy');
		
		$cancel_policy_nights = $this->input->post('cancel_policy_nights');
		$cancel_policy_percent = $this->input->post('cancel_policy_percent');
		$cancel_policy_charge = $this->input->post('cancel_policy_charge');
		$cancel_policy_from = $this->input->post('cancel_policy_from');
		$cancel_policy_to = $this->input->post('cancel_policy_to');
		
		$supplement_rate = $this->input->post('roomsrates');
		
		if(is_array($this->input->post('sd'))) 
		{
		  $room_avail_date_from = $this->input->post('sd');
		}else{
			$room_avail_date_from = $this->input->post('sd'); 
		}
		if(is_array($this->input->post('ed'))) 
		{
			$room_avail_date_to = $this->input->post('ed');
		}else{
			$room_avail_date_to = $this->input->post('ed');
		}
		$dates = $this->input->post('dates'); 
		$weekday = $this->input->post('weekday'); 
		$price = $this->input->post('price'); 
		$extra_bed_price = $this->input->post('extra_bed_price'); 
		$avail = $this->input->post('avail'); 
		$aadult = $this->input->post('adult'); 
		$achild = $this->input->post('child');
		$child_price = $this->input->post('child_price');
		$infant = $this->input->post('infant');
		$supplier_id=$this->session->userdata('supplier_id');
		$board_type= $this->input->post('board_type');
		
		$this->Crs_Model->add_rate_plans($supplier_id,$board_type,$prop_id,$room_cate,$room_type,$child_policy,$cancel_policy_nights,$cancel_policy_percent,$cancel_policy_charge,$cancel_policy_from,$cancel_policy_to,$room_avail_date_from,$room_avail_date_to,$dates,$weekday,$price,$extra_bed_price,$avail,$aadult,$achild,$child_price,$infant,$fileimage,$fileimage1,$fileimage2,$fileimage3);
		redirect('crs/price_list','refresh');
	}
    
    //admin create edit rate plan
	function edit_rate_plan(){
		if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
		$fileimage='';$fileimage1='';$fileimage2='';$fileimage3='';
		if($_FILES){
			$target= $_SERVER['DOCUMENT_ROOT']."/WDM/vayago/public/hotelpriceimg/";
			if(isset($_FILES['filepath']['name'])){
				move_uploaded_file($_FILES['filepath']['tmp_name'],$target.$_FILES['filepath']['name']);
				$fileimage=$_FILES['filepath']['name'];
				
			}
			if(isset($_FILES['filepath1']['name'])){
				move_uploaded_file($_FILES['filepath1']['tmp_name'],$target.$_FILES['filepath1']['name']);
				$fileimage1=$_FILES['filepath1']['name'];
			}
			if(isset($_FILES['filepath2']['name'])){
				move_uploaded_file($_FILES['filepath2']['tmp_name'],$target.$_FILES['filepath2']['name']);
				$fileimage2=$_FILES['filepath2']['name'];
			}
			if(isset($_FILES['filepath3']['name'])){
				move_uploaded_file($_FILES['filepath3']['tmp_name'],$target.$_FILES['filepath3']['name']);
				$fileimage3=$_FILES['filepath3']['name'];
			}
		}
		if($_POST){
			
			$cancel_policy_nights = $this->input->post('cancel_policy_nights');
			$cancel_policy_percent = $this->input->post('cancel_policy_percent');
			$cancel_policy_charge = $this->input->post('cancel_policy_charge');
			$cancel_policy_from = $this->input->post('cancel_policy_from');
			$cancel_policy_to = $this->input->post('cancel_policy_to');
			
			$prop_id = $this->input->post('hotel_name');
			
			$prop_id = $this->input->post('hotel_name');
			$room_cate = $this->input->post('room_type');
			$room_type = $this->input->post('capacity_type');
			$child_policy = $this->input->post('child_policy');
			$cancellation_policy = $this->input->post('cancellation_policy');
			if(is_array($this->input->post('sd'))) 
			{
			  $room_avail_date_from = $this->input->post('sd');
			}else{
				$room_avail_date_from = $this->input->post('sd');
				
			}
			if(is_array($this->input->post('ed'))) 
			{
				$room_avail_date_to = $this->input->post('ed');
			}else{
				$room_avail_date_to = $this->input->post('ed');
			}
			$allocation_release_days = $this->input->post('day');
			$avail_price = $this->input->post('price'); 
			$extra_bed_price = $this->input->post('extra_bed_price'); 
			$avail_rooms = $this->input->post('avail'); 
			$avail_adult = $this->input->post('adult'); 
			$avail_child = $this->input->post('child');
			$avail_child_price = $this->input->post('child_price');
			$avail_infant = $this->input->post('infant');
			if($_POST['dates'][0]=='0000-00-00' && $_POST['dates'][1]=='0000-00-00'){
				$_POST['dates'][0]=$_POST['sd'][0];
				$_POST['dates'][1]=$_POST['ed'][0];
			}
			$avail_dates = $this->input->post('dates'); 
			$avail_weekday = $this->input->post('weekday'); 
			$supplier_id=$this->session->userdata('supplier_id');
			$id = $this->input->post('sup_rate_tactics_id');
			
			$this->Crs_Model->edit_rate_plan($cancel_policy_nights,$cancel_policy_percent,$cancel_policy_charge,$cancel_policy_from,$fileimage,$fileimage1,$fileimage2,$fileimage3,$supplier_id, $cancellation_policy, $prop_id, $id, $room_cate, $room_type,$allocation_release_days,$room_avail_date_from, $room_avail_date_to, $avail_dates, $avail_weekday, $avail_price,$extra_bed_price, $avail_rooms, $avail_adult, $avail_child, $avail_child_price, $avail_infant,$child_policy);
			//redirect('crs/price_list');
		
		}
	}
    
    //admin get acvail dates
	function getAvailDates()
	{
		if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
		 $results = $this->Crs_Model->getAvailDates();
	}

	//get all city
	function getCity(){
		$all_cites = $this->Crs_Model->all_cites($_GET['term']);
		$return = array();
		foreach($all_cites as $city){
			array_push($return,array('label'=>$city->city_name.'('.$city->country_name.')','value'=>$city->city_name.'('.$city->country_name.')','id'=>$city->city_id));
		}
		echo(json_encode($return));
		exit;
	}
	
    //get all hotel status
    function update_all_hotel_status($sup_id,$id,$status)
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login', 'refresh'); 
        }
        $this->Crs_Model->update_hotel_status($id,$status);
        redirect('crs/hotel_manager','refresh');
    }
 }
/* End of file home.php */
/* Location: ./admin/controllers/home.php */
