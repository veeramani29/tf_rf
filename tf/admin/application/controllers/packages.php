<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Packages extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->database(); 
		$this->load->library('upload');
		$this->load->model('Admin_Model');
		$this->load->model('Domain_Model');	
		$this->check_isvalidated();	
		$this->load->library('form_validation','session');

		$this->load->model('Support_Model');
		$this->load->model('Home_Model');
		$this->load->model('markup');
		$this->load->model('apartment_model');
		$this->load->model('payment_model');
		$this->load->model('package_model');
		  
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

    private function check_isvalidated(){
		if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in')){
		   redirect('login/index');
	    }
	}

    public function index() {
    	$data['package_view_data'] = $this->package_model->package_view_data()->result();
		
    	// print_r($data['package_view_data']); die();
    	$this->load->view('packages/view_packages', $data);
    }
	
  public function package_type() {
    	$data['package_view_data'] = $this->package_model->package_view_data_types()->result();
    	// print_r($data['package_view_data']); die();
    	$this->load->view('packages/view_packages_types', $data);
    }

    public function add_package() {
    		$data['country'] = $this->package_model->get_cities_country_v2()->result();
		$data['package_type_data'] = $this->package_model->package_type_data()->result();
		$this->load->view("packages/add_package", $data);
    }
	public function add_package_type() {
    	
		$this->load->view("packages/add_package_type");
    }

    public function save_packages() {
    	//echo "<pre>"; print_r($this->input->post()); die();
    	$voucher_no='trip'.(rand());
    	$disn=$this->input->post('disn');
    	$country=$this->input->post('country');
    	
    	$package_name = $this->input->post('name');
    	$description = $this->input->post('Description');
		$package_adult = $this->input->post('package_adult');
		
    	$additional_info = $this->input->post('info');
    	$terms_conditions = $this->input->post('terms');
    	$cancelation=$this->input->post('cancelation');
    	$rating=$this->input->post('Rating');
    	$duration=$this->input->post('package_duration');

    	$package_price = $this->input->post('package_price');
    	$package_cancellation_days = $this->input->post('package_cancellation_days');
    	$package_cancellation_percentage = $this->input->post('package_cancellation_percentage');

    	$pack_image = explode(".",$_FILES["photo"]["name"]);
       	$newfilename = $pack_image[0].rand(1,999999999) . '.' .end($pack_image);
	 	$tmpnamert=$_FILES['photo']['tmp_name'];
	 	$dir = "upload_files/packages/";
       	move_uploaded_file($tmpnamert, $dir.$newfilename);
	
    	$newfilename_dbPath = WEB_URL.'/upload_files/packages/'.$newfilename;
	
    	$add_package_data = array( 
						'package_type'=>$disn,
						'package_cityid'=>$country,
						'package_name'=>$package_name,
						'image'=>$newfilename_dbPath,
						'package_rating'=>$rating,
						'package_description'=>$description,
						'additional_info'=>$additional_info,
						'duration'=>$duration,
						'max_passanger'=>$package_adult,
						'package_price'=>$package_price,
						'package_cancellation_days'=>$package_cancellation_days,
						'package_cancellation_percentage'=>$package_cancellation_percentage,
						'cancel_policy'=>$cancelation,
						'package_terms'=>$terms_conditions,
						'package_voucher'=>$voucher_no,
						'status'=>'1');

		$returnId = $this->package_model->add_package_details($add_package_data);

		$other_photos=$_FILES["other_photos"]["name"];
		$tmp_others=$_FILES["other_photos"]["tmp_name"];
	
		if(!empty($other_photos[0])) {
				 
			for($z=0; $z<count($other_photos); $z++) {
			   	$otherpic = explode(".",$other_photos[$z]);
		       		$other_img = $otherpic[0].rand(1,999999999) . '.' .end($otherpic);
				$other_tmp=$tmp_others[$z];
				$dir_others="upload_files/package_other_pics/";
				$path=$dir_others.$other_img;
				move_uploaded_file($other_tmp, $path);
				$other_img = WEB_URL.$path;
			    $this->package_model->save_package_other_images($returnId, $other_img);
			}
			 
		}

   	   //SAVE DAYS LIST INFO
   	    $day_number = $this->input->post('day_number');
   	    $area = $this->input->post('area');
   	    $title = $this->input->post('title');
       	$hdesc = $this->input->post('hdesc');
   	   	$hphoto = $_FILES['hphoto']['name'];
   	   	$tmpname =$_FILES['hphoto']['tmp_name'];

   	   	if(!empty($_REQUEST)){
   	   		$c = count($title);
   	   		
   	   		for($i=0; $i<$c; $i++) {
   	   			$areaa=$area[$i];
				$htitle=$title[$i];
				$hdescc= $hdesc[$i];
				$file_name = $_FILES['hphoto']['name'][$i];
				$file_size =$_FILES['hphoto']['size'][$i];
				$file_tmp =$_FILES['hphoto']['tmp_name'][$i];
				$file_type=$_FILES['hphoto']['type'][$i];

	
				if($file_size > 8194304) {
					$errors[]='File size must be less than 2 MB';
        			}	
        		$path = WEB_URL."/upload_files/package_duration_images/";
			$file_name1 = $path.$file_name;
        		$query = "insert into package_days_list (package_id,title,area,description,image) values('$returnId', '$htitle','$areaa','$hdescc','$file_name1')";
        		$desired_dir = "upload_files/package_duration_images";

        		if(empty($errors)==true){
        			if(is_dir($desired_dir)==false){
                		mkdir("$desired_dir", 0700);	// Create directory if it does not exist
            		}
            		if(is_dir("$desired_dir/".$file_name)==false){
                		move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
            		}else{
                		$new_dir="$desired_dir/".$file_name.time();
                 		rename($file_tmp,$new_dir) ;	
            		}
            	    mysql_query($query);
        		}
   	   		}
   	   	}
        redirect('packages');
    }
  public function save_packages_type() {
    	//echo "<pre>"; print_r($this->input->post()); die();
    	
    	$package_name = $this->input->post('name');
    
		
		$add_package_data = array( 
						
						'packages_types_name'=>$package_name);
$this->db->insert("packages_types", $add_package_data);
    	
        redirect('packages/package_type');
    }

    public function edit_package($pack_id) {
    	$data['country'] = $this->package_model->get_all_countries()->result();
    	$data['edit_data'] = $this->package_model->get_edit_data($pack_id)->row();
		$data['edit_days'] = $this->package_model->get_edit_days($pack_id)->result();
    	$this->load->view('packages/edit_package', $data);
    }

    public function update_package__() {
    	 echo '<pre/>';
    	 print_r($_POST);exit;
    	 
     }
    public function update_package() {
        //$data['package_country'] = $this->input->post('country');
        $data['package_cityid'] = $this->input->post('city_name');
        $data['package_name'] = $this->input->post('name');
        //$data['image'] = $this->input->post('img');
        $data['package_rating'] = $this->input->post('Rating');
        $data['package_description'] = $this->input->post('Description');
        $data['additional_info'] = $this->input->post('info');
        $data['package_price'] = $this->input->post('package_price');
        $data['package_cancellation_days'] = $this->input->post('package_cancellation_days');
        $data['package_cancellation_percentage'] = $this->input->post('package_cancellation_percentage');
        $data['cancel_policy'] = $this->input->post('cancel_policy');
        $data['package_terms'] = $this->input->post('terms');
	$data['max_passanger'] = $this->input->post('package_adult');

        $package_id = $this->input->post('package_id');

        /*$pack_image = explode(".",$_FILES["photo"]["name"]);
        $newfilename = rand(1,99999) . '.' .end($pack_image);
        $tmpnamert=$_FILES['photo']['tmp_name'];
        $dir = "upload_files/packages/";
        move_uploaded_file($tmpnamert, $dir.$newfilename);
  */
        $this->package_model->update_package_data($package_id, $data);

       /* $other_photos=$_FILES["other_photos"]["name"];
        $tmp_others=$_FILES["other_photos"]["tmp_name"];
    
        if(!empty($other_photos[0])) {
                 
            for($z=0; $z<count($other_photos); $z++) {
                $otherpic = explode(".",$other_photos[$z]);
                $other_img = rand(1,99999) . '.' .end($otherpic);
                $other_tmp=$tmp_others[$z];
                $dir_others="upload_files/package_other_pics/";
                $path=$dir_others.$other_img;
                move_uploaded_file($other_tmp, $path);
                $this->package_model->update_package_other_images($package_id, $other_img);
            }
             
        }*/  
	$packagesdays = $this->input->post('packagesdays');
	$pday_id = $this->input->post('day_id');
	$ptitle = $this->input->post('title');
	$phdesc = $this->input->post('hdesc');
	$parea = $this->input->post('area');
	for($pd=0;$pd<$packagesdays;$pd++){
		$day_data['day_id'] =  $pday_id[$pd];
		$day_data['package_id'] =   $package_id;
		$day_data['title'] =  $ptitle[$pd];
		$day_data['description'] =  $phdesc[$pd];
		$day_data['area'] =  $parea[$pd];
		$this->package_model->update_package_days_list($day_data['day_id'],$day_data);
	}

	     

        redirect('packages');
    }

    public function delete_package($package_id) {
        $this->package_model->delete_package($package_id);
        redirect('packages');
    }
 public function delete_package_type($package_id) {
        $this->package_model->delete_package_type($package_id);
        redirect('packages/package_type');
    }
    public function package_change_status($package_id, $get_status) {
        if($get_status == 1) {
            $this->package_model->package_change_status($package_id, $get_status);  
            redirect('packages');          
        } else if($get_status == 0) {
            $this->package_model->package_change_status($package_id, $get_status);
            redirect('packages');
        } else {
            redirect('packages');
        }
    }

    public function edit_package_images($pack_id) {
	$data['main_image'] = $this->package_model->get_main_images($pack_id)->row();
    	$data['other_images'] = $this->package_model->get_other_images($pack_id)->result();
	$data['day_images'] = $this->package_model->get_day_images($pack_id)->result();
        $this->load->view('packages/edit_package_images', $data);
    }

    public function update_all_images() {
        $main_image = $this->input->post('main_image');
        $other_images = $this->input->post('other_images');
        $day_iamges = $this->input->post('day_images');
		$nodays = $this->input->post('noofdays');

	$noofother = $this->input->post('noofother');
	$day_id =  $this->input->post('day_id');
	
	$other_id =  $this->input->post('other_id');
	$package_id = $this->input->post('package_id');

	//main image


	if($_FILES["main_image"]["name"] !=""){
		$pack_image = explode(".",$_FILES["main_image"]["name"]);
	       	$newfilename = $pack_image[0].rand(1,999999999) . '.' .end($pack_image);
		$tmpnamert=$_FILES['main_image']['tmp_name'];
		$dir = "upload_files/packages/";
	       	move_uploaded_file($tmpnamert, $dir.$newfilename);
	    	$newfilename_dbPath = WEB_URL.'/upload_files/packages/'.$newfilename;
		$image = $newfilename_dbPath;
		$this->package_model->upadate_main_image($package_id, $image);  
            	//redirect('packages'); 
	}
	
	for($nd=0;$nd<$nodays;$nd++){
		
		 //
		if($_FILES["day_images".$nd]["name"] !=""){
			$day_id = $day_id[$nd];
			$pack_image = explode(".",$_FILES["day_images".$nd]["name"]);
		       	$newfilename = $pack_image[0].rand(1,999999999) . '.' .end($pack_image);
			$tmpnamert=$_FILES["day_images".$nd]['tmp_name'];
			$dir =  "upload_files/package_duration_images/";
		       	move_uploaded_file($tmpnamert, $dir.$newfilename);
		    	$newfilename_dbPath = WEB_URL.'/upload_files/package_duration_images/'.$newfilename;
			$image = $newfilename_dbPath;
			$this->package_model->upadate_day_image($day_id, $image);  
		}
	
	}

	for($nd=0;$nd<$noofother;$nd++){
		 
		if($_FILES["other_images".$nd]["name"] !=""){
			$other_id = $other_id[$nd];
			$pack_image = explode(".",$_FILES["other_images".$nd]["name"]);
		       	$newfilename = $pack_image[0].rand(1,999999999) . '.' .end($pack_image);
			$tmpnamert=$_FILES["other_images".$nd]['tmp_name'];
			$dir =  "upload_files/package_other_pics/";
		       	move_uploaded_file($tmpnamert, $dir.$newfilename);
		    	$newfilename_dbPath = WEB_URL.'/upload_files/package_other_pics/'.$newfilename;
			$image = $newfilename_dbPath;
			$this->package_model->upadate_other_image($other_id, $image);  
		}
	
	}

	if($_FILES["new_other_images"]["name"][0] !=""){
		$newother = count($_FILES["new_other_images"]["name"]);
		for($nd=0;$nd<$newother;$nd++){
			$pack_image = explode(".",$_FILES["new_other_images"]["name"][$nd]);
		       	$newfilename = $pack_image[0].rand(1,999999999) . '.' .end($pack_image);
			$tmpnamert=$_FILES["new_other_images"]['tmp_name'][$nd];
			$dir =  "upload_files/package_other_pics/";
		       	move_uploaded_file($tmpnamert, $dir.$newfilename);
		    	$newfilename_dbPath = WEB_URL.'/upload_files/package_other_pics/'.$newfilename;
			$image = $newfilename_dbPath;
			$this->package_model->save_package_other_images($package_id, $image);  
		}
	
	}
	 redirect('packages');
    }
	public function delete_other_image($id,$package_id){
		$this->package_model->delete_other_image($id); 
		redirect('packages/edit_package_images/'.$package_id); 
	}

	public function get_cities($country){
		 
		$country = $this->package_model->get_cities_country_v1($country);
		foreach($country as $coun){
		?>
			<option value='<?php echo $coun->IATA_CODES; ?>'><?php echo $coun->CITY; ?></option>
		<?php
		} 
	}
}
