<?php
error_reporting(1);
defined('BASEPATH') OR exit('No direct script access allowed');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class packages extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->database();
        $this->load->model('packages_model');
        $this->is_admin_logged_in();
    }

    private function is_admin_logged_in() {

        if (!$this->session->userdata('admin_logged_in')) {

            redirect('login/index');
        }
    }

    public function index() {

        redirect('home/dashboard');
    }

//redirect if needed, otherwise display the user list

    function manage_gallery($msg = NULL) {



        $this->data['packages'] = $this->packages_model->get_packages()->result();
//print("<pre>");print_r($this->data['galleries']);exit;

        $this->load->view("packages/view_album", $this->data);
    }

// create a new group

    function create_album() {

        $this->data['country_list'] = $this->packages_model->get_hotel_country_list();
        $this->data['city_list'] = $this->packages_model->get_hotel_city_list_all();
        $this->data['title'] = "Add Slide";


        $this->form_validation->set_rules('package_name', "package name", 'xss_clean|required');
        $this->form_validation->set_rules('package_country', "package country", 'xss_clean|required');
        $this->form_validation->set_rules('package_city', "package city", 'xss_clean|required');
        $this->form_validation->set_rules('price', "price", 'xss_clean|required');
        $this->form_validation->set_rules('package_show_date', "package show date", 'xss_clean|required');
        $this->form_validation->set_rules('package_hide_date', "package hide date", 'xss_clean|required');
        $this->form_validation->set_rules('hotel_name', "hotel name", 'xss_clean|required');
        $this->form_validation->set_rules('hotel_rating', "hotel rating", 'xss_clean|required');
        $this->form_validation->set_rules('room_type', "room type", 'xss_clean|required');
        $this->form_validation->set_rules('visa', "visa", 'xss_clean|required');
        $this->form_validation->set_rules('total_nights', "total nights", 'xss_clean|required');
        $this->form_validation->set_rules('adult', "Adult", 'xss_clean|required');
        $this->form_validation->set_rules('child', "Child", 'xss_clean|required');
        $this->form_validation->set_rules('airline', "airline", 'xss_clean|required');
        $this->form_validation->set_rules('transportation', "transportation", 'xss_clean|required');
        $this->form_validation->set_rules('offerings', "offerings", 'xss_clean|required');
        $this->form_validation->set_rules('package_desc', "package desc", 'xss_clean|required');

        if ($this->form_validation->run() == TRUE) {

            $data['package_image'] = $this->upload_slide();
            $data['hotel_image'] = $this->upload_slide1();


            $data['package_name'] = $this->input->post('package_name');
            $data['package_country'] = $this->input->post('package_country');
            $data['package_city'] = $this->input->post('package_city');
            $data['price'] = $this->input->post('price');
            $data['package_show_date'] = $this->input->post('package_show_date');
            $data['package_hide_date'] = $this->input->post('package_hide_date');
            $data['hotel_name'] = $this->input->post('hotel_name');
            $data['hotel_rating'] = $this->input->post('hotel_rating');
            $data['room_type'] = $this->input->post('room_type');
            $data['visa'] = $this->input->post('visa');
            $data['total_nights'] = $this->input->post('total_nights');
            $data['adult'] = $this->input->post('adult');
            $data['child'] = $this->input->post('child');
            $data['airline'] = $this->input->post('airline');
            $data['transportation'] = $this->input->post('transportation');
            $data['offerings'] = $this->input->post('offerings');
            $data['package_desc'] = $this->input->post('package_desc');


            $gallery_id = $this->packages_model->create_packages($data);


            if ($gallery_id) {

//$this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("packages/manage_gallery");
            }
        } else {


            $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

            $this->load->view("packages/create_album", $this->data);
        }
    }

    public function upload_slide() {

        $uniqe = time();

        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '20480';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $this->load->library('upload', $config);

//$this->upload->initialize($config);	
        $new_img = $uniqe . "_" . $_FILES['package_image']['name'];

        $tmpName = $_FILES['package_image']['tmp_name'];

//$this->dashboard_model->update_image($agent_id,$new_img);

        $data = array('upload_data' => move_uploaded_file($tmpName, "./upload/packages/$new_img"));

        return $new_img;
    }

    public function upload_slide1() {

        $uniqe = time();

        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '20480';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $this->load->library('upload', $config);

//$this->upload->initialize($config);	
        $new_img1 = $uniqe . "_" . $_FILES['hotel_image']['name'];

        $tmpName = $_FILES['hotel_image']['tmp_name'];

//$this->dashboard_model->update_image($agent_id,$new_img);

        $data = array('upload_data' => move_uploaded_file($tmpName, "./upload/packages_hotel/$new_img1"));

        return $new_img1;
    }

    function edit_album($id) {
        $this->data['country_list'] = $this->packages_model->get_hotel_country_list();
        $this->data['city_list'] = $this->packages_model->get_hotel_city_list_all();
        $this->data['packages'] = $this->packages_model->edit_packages($id);

//validate form input
        $this->form_validation->set_rules('title', "title", 'xss_clean');

        if ($this->form_validation->run() == TRUE) {

            $package_image = $_FILES['package_image']['name'];
            $hotel_image = $_FILES['hotel_image']['name'];

            if ($package_image != '' && $hotel_image != '') {

                $data['package_image'] = $this->upload_slide();
                $data['hotel_image'] = $this->upload_slide1();


                $data['package_name'] = $this->input->post('package_name');
                $data['package_country'] = $this->input->post('package_country');
                $data['package_city'] = $this->input->post('package_city');
                $data['price'] = $this->input->post('price');
                $data['package_show_date'] = $this->input->post('package_show_date');
                $data['package_hide_date'] = $this->input->post('package_hide_date');
                $data['hotel_name'] = $this->input->post('hotel_name');
                $data['hotel_rating'] = $this->input->post('hotel_rating');
                $data['room_type'] = $this->input->post('room_type');
                $data['visa'] = $this->input->post('visa');
                $data['total_nights'] = $this->input->post('total_nights');
                $data['adult'] = $this->input->post('adult');
                $data['child'] = $this->input->post('child');
                $data['airline'] = $this->input->post('airline');
                $data['transportation'] = $this->input->post('transportation');
                $data['offerings'] = $this->input->post('offerings');
                $data['package_desc'] = $this->input->post('package_desc');
            } else if ($hotel_image != '') {


                $data['hotel_image'] = $this->upload_slide1();

                $data['package_name'] = $this->input->post('package_name');
                $data['package_country'] = $this->input->post('package_country');
                $data['package_city'] = $this->input->post('package_city');
                $data['price'] = $this->input->post('price');
                $data['package_show_date'] = $this->input->post('package_show_date');
                $data['package_hide_date'] = $this->input->post('package_hide_date');
                $data['hotel_name'] = $this->input->post('hotel_name');
                $data['hotel_rating'] = $this->input->post('hotel_rating');
                $data['room_type'] = $this->input->post('room_type');
                $data['visa'] = $this->input->post('visa');
                $data['total_nights'] = $this->input->post('total_nights');
                $data['adult'] = $this->input->post('adult');
                $data['child'] = $this->input->post('child');
                $data['airline'] = $this->input->post('airline');
                $data['transportation'] = $this->input->post('transportation');
                $data['offerings'] = $this->input->post('offerings');
                $data['package_desc'] = $this->input->post('package_desc');
            } else if ($package_image != '') {

                $data['package_image'] = $this->upload_slide();


                $data['package_name'] = $this->input->post('package_name');
                $data['package_country'] = $this->input->post('package_country');
                $data['package_city'] = $this->input->post('package_city');
                $data['price'] = $this->input->post('price');
                $data['package_show_date'] = $this->input->post('package_show_date');
                $data['package_hide_date'] = $this->input->post('package_hide_date');
                $data['hotel_name'] = $this->input->post('hotel_name');
                $data['hotel_rating'] = $this->input->post('hotel_rating');
                $data['room_type'] = $this->input->post('room_type');
                $data['visa'] = $this->input->post('visa');
                $data['total_nights'] = $this->input->post('total_nights');
                $data['adult'] = $this->input->post('adult');
                $data['child'] = $this->input->post('child');
                $data['airline'] = $this->input->post('airline');
                $data['transportation'] = $this->input->post('transportation');
                $data['offerings'] = $this->input->post('offerings');
                $data['package_desc'] = $this->input->post('package_desc');
            } else {

                $data['package_name'] = $this->input->post('package_name');
                $data['package_country'] = $this->input->post('package_country');
                $data['package_city'] = $this->input->post('package_city');
                $data['price'] = $this->input->post('price');
                $data['package_show_date'] = $this->input->post('package_show_date');
                $data['package_hide_date'] = $this->input->post('package_hide_date');
                $data['hotel_name'] = $this->input->post('hotel_name');
                $data['hotel_rating'] = $this->input->post('hotel_rating');
                $data['adult'] = $this->input->post('adult');
                $data['child'] = $this->input->post('child');
                $data['room_type'] = $this->input->post('room_type');
                $data['visa'] = $this->input->post('visa');
                $data['total_nights'] = $this->input->post('total_nights');
                $data['airline'] = $this->input->post('airline');
                $data['transportation'] = $this->input->post('transportation');
                $data['offerings'] = $this->input->post('offerings');
                $data['package_desc'] = $this->input->post('package_desc');
            }

            $gallery_id = $this->packages_model->update_packages($data, $id);

//echo $new_category_id;exit;

            if ($gallery_id) {

//$this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("packages/manage_gallery");
            }
        } else {

            $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
            $this->load->view("packages/edit_album", $this->data);
        }
    }

    function delete_album($id) {

        $page_delete = $this->packages_model->delete_packages($id);
//unlink("./upload/packages/cover_pic/$img");
        redirect("packages/manage_gallery");
    }

    function get_city() {


        $val = $_REQUEST['val'];
        $city_list = $this->packages_model->get_hotel_city_list($val);
        $data1['city_list'] = $city_list;
        echo json_encode($data1);
    }

    public function delete() {
        $ids = ( explode(',', $this->input->get_post('ids')));
        $this->packages_model->delete($ids);
    }

    function add_groups() {
        $this->form_validation->set_rules('group_name', "Group Name", 'xss_clean|required');
        if ($this->form_validation->run() == TRUE) {
            $data['group_name'] = $this->input->post('group_name');
            $data['admin_id'] = $this->session->userdata('admin_logged_in');
            ######################## Meta Data ##########################
            $data['meta_title'] = $this->input->post('meta_title');
            $data['meta_keyword'] = $this->input->post('meta_keyword');
            $data['meta_desc'] = $this->input->post('meta_desc');
            #############################################################
            $group_id = $this->packages_model->addGroup($data);
            if ($group_id) {
                //$this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("packages/manage_groups");
            }
        } else {
            $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
            $this->load->view("packages/add_group", $this->data);
        }
    }

    function edit_groups($id) {
        if ($id != '') {
            $this->form_validation->set_rules('group_name', "Group Name", 'xss_clean|required');
            if ($this->form_validation->run() == TRUE) {
                $data['group_name'] = $this->input->post('group_name');
                $data['admin_id'] = $this->session->userdata('admin_logged_in');
                $this->packages_model->editGroup($data);
                redirect("packages/manage_groups");
            } else {
                $this->data['id'] = $id;
                $this->data['group'] = $this->packages_model->getGroupById($id);
                $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
                $this->load->view("packages/edit_group", $this->data);
            }
        }
    }

    function manage_groups() {
        $data['groups'] = $this->packages_model->getAllGroups();
        $this->load->view('packages/manage_groups', $data);
    }

    function delete_groups($id) {
        if ($id != '') {
            $this->packages_model->deleteGroup($id);
        } 
        
        redirect('packages/manage_groups');
    }

    function add_category() {
        
        $this->form_validation->set_rules('category_name', "Category Name", 'xss_clean|required');
        $this->form_validation->set_rules('category_title', "Category Title", 'xss_clean|required');
        $this->form_validation->set_rules('group_id', "Group Name", 'xss_clean|required');
        if ($this->form_validation->run() == TRUE){
            $data['category_name'] = $this->input->post('category_name');
            $data['category_title'] = $this->input->post('category_title');
            $data['group_id'] = $this->input->post('group_id');
            $data['parent_category'] = $this->input->post('parent_category');
            $data['content'] = $this->input->post('content');
            ######################## Meta Data ##########################
            $data['meta_title'] = $this->input->post('meta_title');
            $data['meta_keyword'] = $this->input->post('meta_keyword');
            $data['meta_desc'] = $this->input->post('meta_desc');
            #############################################################
            if($_FILES['category_thumb'] != ''){
                $ext = pathinfo($_FILES['category_thumb']['name'],PATHINFO_EXTENSION);
                if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif'){
                    $uploadPath = Image_Path;
                    $newFileName = 'cat_'.date('YmdHis').'.'.$ext;
                    //echo $uploadPath.$newFileName;die;
                    move_uploaded_file($_FILES['category_thumb']['tmp_name'],$uploadPath.$newFileName);
                    
                    $data['category_thumb'] = $newFileName;
                } else {
                    $data['category_thumb'] = '';
                } 
            } else {
                $data['category_thumb'] = '';
            }
            $this->packages_model->addCategoryData($data);
            redirect('packages/manage_category');
            
        } else {
            $data['groups'] = $this->packages_model->getAllGroups();
            $this->load->view('packages/add_category',$data);
        }
    }
    
    function edit_category($id){
        if($id != ''){
            $this->form_validation->set_rules('category_name', "Category Name", 'xss_clean|required');
            $this->form_validation->set_rules('category_title', "Category Title", 'xss_clean|required');
            $this->form_validation->set_rules('group_id', "Group Name", 'xss_clean|required');
            if ($this->form_validation->run() == TRUE){
                $data['cat_id'] = $this->input->post('cat_id');
                $data['category_name'] = $this->input->post('category_name');
                $data['category_title'] = $this->input->post('category_title');
                $data['group_id'] = $this->input->post('group_id');
                $data['parent_category'] = $this->input->post('parent_category');
                $data['content'] = $this->input->post('content');
                
                if($_FILES['category_thumb'] != ''){
                    $ext = pathinfo($_FILES['category_thumb']['name'],PATHINFO_EXTENSION);
                    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif'){
                        $uploadPath = Image_Path;
                        $newFileName = 'cat_'.date('YmdHis').'.'.$ext;
                        //echo $newFileName;die;
                        move_uploaded_file($_FILES['category_thumb']['tmp_name'],$uploadPath.$newFileName);
                        $data['category_thumb'] = $newFileName;
                    } else {
                        $data['category_thumb'] = $this->input->post('old_thumb');
                    } 
                } else {
                    $data['category_thumb'] = $this->input->post('old_thumb');
                }
               // print_r($data);die;
                $this->packages_model->editCategoryData($data);
                redirect('packages/manage_category');

            } else {
                $data['id'] = $id;
                $data['category'] = $this->packages_model->getCategoryOnId($id);
                $data['groups'] = $this->packages_model->getAllGroups();
                $this->load->view('packages/edit_category',$data);
            }
        }
    }
    
    function delete_category($id){
        if($id != ''){
            $this->packages_model->deleteCategoryOnId($id);
        }
        redirect('packages/manage_category');
    }
    
    
    function manage_category(){
        $data['categorys'] = $this->packages_model->getAllCategoryList();
        $this->load->view('packages/manage_category',$data);
    }

    function getParentCategoryOnGroup() {
        $groupId = $_GET['group'];
        $html = '';
        $catList = $this->packages_model->getParentCategoryOnGroup($groupId);
        if($catList != ''){
            foreach($catList as $cat){
                $html .= '<option value="0">Root</option>
                          <option value="'.$cat->id.'">'.$cat->category_name.'</option>';
            }
        } else {
             $html .= '<option value="0">Root</option>';
        }
        
        echo json_encode(array(
            'parent_category'=>$html
        ));
    }
    
    function add_type(){
        $this->form_validation->set_rules('group_id', "Group Name", 'xss_clean|required');
        $this->form_validation->set_rules('business_type', "Business Type", 'xss_clean|required');
        if ($this->form_validation->run() == TRUE) {
            $data['group_id'] = $this->input->post('group_id');
            $data['business_type'] = $this->input->post('business_type');
            $data['admin_id'] = $this->session->userdata('admin_logged_in');
            $type_id = $this->packages_model->addType($data);
            if ($type_id) {
                //$this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("packages/manage_type");
            }
        } else {
            $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
            $data['groups'] = $this->packages_model->getAllGroups();
            $this->load->view("packages/add_type", $data);
        }
    }
    
    function edit_type($id){
        if($id != ''){
            $this->form_validation->set_rules('group_id', "Group Name", 'xss_clean|required');
            $this->form_validation->set_rules('business_type', "Business Type", 'xss_clean|required');
            if ($this->form_validation->run() == TRUE) {
                $data['type_id'] = $this->input->post('type_id');
                $data['group_id'] = $this->input->post('group_id');
                $data['business_type'] = $this->input->post('business_type');
                $data['admin_id'] = $this->session->userdata('admin_logged_in');
                $this->packages_model->editType($data);
                redirect("packages/manage_type");
            } else {
                $data['id'] = $id;
                $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
                $data['groups'] = $this->packages_model->getAllGroups();
                $data['type'] = $this->packages_model->getTypeOnId($id);
                $this->load->view("packages/add_group", $data);
            }
        }
    }
    
    function delete_type($id){
        if($id != ''){
            $this->packages_model->deleteTypeOnId($id);
        }
        redirect('packages/manage_type');
    }
    
    function manage_type(){
        $data['types'] = $this->packages_model->getAllTourTypes();
        $this->load->view('packages/manage_type',$data);
    }
    
    function add_tour(){
        
        if($_POST){
            //echo '<pre />';print_r($_POST);die;
            
            $data['tour_name'] = $this->input->post('tour_name');
            $data['tour_operator'] = $this->input->post('tour_operator');
            $data['group_id'] = $this->input->post('group_id');
            $data['type_id'] = $this->input->post('type_id');
            $data['category'] = $this->input->post('category');
            $data['short_overview'] = $this->input->post('short_overview');
            $data['adult_price'] = $this->input->post('adult_price');
            $data['child_price'] = $this->input->post('child_price');
            $data['infant_price'] = $this->input->post('infant_price');
            $data['price_type'] = $this->input->post('price_type');
            $data['payment_desc'] = $this->input->post('payment_desc');
            $data['country'] = $this->input->post('country');
            $data['state'] = $this->input->post('state');
            $data['city'] = $this->input->post('city');
            $data['post_code'] = $this->input->post('post_code');
            $data['tour_duration'] = $this->input->post('tour_duration');
            $data['rating'] = $this->input->post('rating');
            $data['tour_code'] = $this->input->post('tour_code');
            $data['nights'] = $this->input->post('nights');
            $data['days'] = $this->input->post('days');
            $data['meta_title'] = $this->input->post('meta_title');
            $data['meta_keyword'] = $this->input->post('meta_keyword');
            $data['meta_desc'] = $this->input->post('meta_desc');
            
            $data['start_city'] = $this->input->post('start_city');
            $data['end_city'] = $this->input->post('end_city');
            $data['visiting_city'] = $this->input->post('visiting_city');
            $data['operating_on'] = $this->input->post('operating_on');
            $data['sightseeing'] = $this->input->post('sightseeing');
            $data['no_of_acomodates'] = $this->input->post('no_of_acomodates');
            $data['guide_tape'] = $this->input->post('guide_tape');
            $data['pickup_service'] = $this->input->post('pickup_service');
            $data['room_addon_facility'] = $this->input->post('room_addon_facility');
            $data['dropoff_service'] = $this->input->post('dropoff_service');
            $data['entertainments'] = $this->input->post('entertainments');
            $data['view_location_type'] = $this->input->post('view_location_type');
            $data['itinerary_title'] = $this->input->post('itinerary_title');
            $data['itenerary_detail'] = $this->input->post('itenerary_detail');
            $data['available_from_date'] = $this->input->post('available_from_date');
            $data['available_to_date'] = $this->input->post('available_to_date');
            $data['google_map'] = $this->input->post('google_map');
            $data['tour_highlights'] = $this->input->post('tour_highlights');
            $data['tour_policy'] = $this->input->post('tour_policy');
            $data['terms_condition'] = $this->input->post('terms_condition');
            if(isset($_POST['send_confirmation_email_user']))
                $data['send_confirmation_email_user'] = $this->input->post('send_confirmation_email_user');
            else $data['send_confirmation_email_user'] = '';
            
            $data['conf_email_id_user'] = $this->input->post('conf_email_id_user');
            
            if(isset($_POST['send_conf_email_user_pay_invoice']))
                $data['send_conf_email_user_pay_invoice'] = $this->input->post('send_conf_email_user_pay_invoice');
            else $data['send_conf_email_user_pay_invoice'] = '';
            $data['conf_invoice_pay_email_id'] = $this->input->post('conf_invoice_pay_email_id');
            
            if(isset($_POST['send_confirmation_email_cancel_order']))
                $data['send_confirmation_email_cancel_order'] = $this->input->post('send_confirmation_email_cancel_order');
            else $data['send_confirmation_email_cancel_order'] = '';
            
            $data['conf_cancel_order_email_id'] = $this->input->post('conf_cancel_order_email_id');
            $data['email_id_payment_info'] = $this->input->post('email_id_payment_info');
            $data['item_desc'] = $this->input->post('item_desc');
            
            if(isset($_POST['inclusions'])){
                $data['inclusions'] = implode('|',$this->input->post('inclusions'));
            }
            else $data['inclusions'] = '';
            
            if(isset($_POST['exclusions']))
                $data['exclusions'] = implode('|',$this->input->post('exclusions'));
            else $data['exclusions'] = '';
            
            if(isset($_POST['related_tour']) && $_POST['related_tour'] != ''){
                $related_tours = implode('|',$_POST['related_tour']);
            }
            
            $data['related_tours'] = $related_tours;
            $uploadPath = Image_Path;
            if(!empty($_FILES['images'])){
                
                //print_r($_FILES['images']);die;
                for($i=0 ;$i<count($_FILES['images']);$i++){
                    $ext = pathinfo($_FILES['images']['name'][$i],PATHINFO_EXTENSION);
                    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif'){
                        $newFileName = 'tour_'.date('YmdHis').'.'.$ext;
                        //echo $uploadPath.$newFileName;die;
                        //echo $uploadPath.$newFileName;die;
                        move_uploaded_file($_FILES['images']['tmp_name'][$i],$uploadPath.$newFileName);

                        $images[] = $newFileName;
                    }
                }
            } else {
                $images[] = '';
            }
            //die;
            $data['date_added'] = date('Y-m-d');
            
            $this->packages_model->addTourPackages($data,$images);
            redirect('packages/manage_tour');
            
        } else {
            $data['groups'] = $this->packages_model->getAllGroups();
            $data['countryList'] = $this->packages_model->getAllCountryList();
            $data['related_tours'] = $this->packages_model->getAllToursListName();
            $this->load->view('packages/add_tour',$data);
        }
    }
    
    function manage_tour(){
        $data['tours'] = $this->packages_model->getAllTours();
        $this->load->view('packages/manage_tour',$data);
    }
    
    function edit_tour($id){
        if($id != ''){
            if($_POST){
                $data['tour_id'] = $this->input->post('tour_id');
                $data['tour_name'] = $this->input->post('tour_name');
                $data['tour_operator'] = $this->input->post('tour_operator');
                $data['group_id'] = $this->input->post('group_id');
                $data['type_id'] = $this->input->post('type_id');
                $data['category'] = $this->input->post('category');
                $data['short_overview'] = $this->input->post('short_overview');
                $data['adult_price'] = $this->input->post('adult_price');
                $data['child_price'] = $this->input->post('child_price');
                $data['infant_price'] = $this->input->post('infant_price');
                $data['price_type'] = $this->input->post('price_type');
                $data['payment_desc'] = $this->input->post('payment_desc');
                $data['country'] = $this->input->post('country');
                $data['state'] = $this->input->post('state');
                $data['city'] = $this->input->post('city');
                $data['post_code'] = $this->input->post('post_code');
                $data['tour_duration'] = $this->input->post('tour_duration');
                $data['rating'] = $this->input->post('rating');
                $data['tour_code'] = $this->input->post('tour_code');
                $data['nights'] = $this->input->post('nights');
                $data['days'] = $this->input->post('days');
                $data['meta_title'] = $this->input->post('meta_title');
                $data['meta_keyword'] = $this->input->post('meta_keyword');
                $data['meta_desc'] = $this->input->post('meta_desc');

                $data['start_city'] = $this->input->post('start_city');
                $data['end_city'] = $this->input->post('end_city');
                $data['visiting_city'] = $this->input->post('visiting_city');
                $data['operating_on'] = $this->input->post('operating_on');
                $data['sightseeing'] = $this->input->post('sightseeing');
                $data['no_of_acomodates'] = $this->input->post('no_of_acomodates');
                $data['guide_tape'] = $this->input->post('guide_tape');
                $data['pickup_service'] = $this->input->post('pickup_service');
                $data['room_addon_facility'] = $this->input->post('room_addon_facility');
                $data['dropoff_service'] = $this->input->post('dropoff_service');
                $data['entertainments'] = $this->input->post('entertainments');
                $data['view_location_type'] = $this->input->post('view_location_type');
                $data['itinerary_title'] = $this->input->post('itinerary_title');
                $data['itenerary_detail'] = $this->input->post('itenerary_detail');
                $data['available_from_date'] = $this->input->post('available_from_date');
                $data['available_to_date'] = $this->input->post('available_to_date');
                $data['google_map'] = $this->input->post('google_map');
                $data['tour_highlights'] = $this->input->post('tour_highlights');
                $data['tour_policy'] = $this->input->post('tour_policy');
                $data['terms_condition'] = $this->input->post('terms_condition');
                if(isset($_POST['send_confirmation_email_user']))
                    $data['send_confirmation_email_user'] = $this->input->post('send_confirmation_email_user');
                else $data['send_confirmation_email_user'] = '';

                $data['conf_email_id_user'] = $this->input->post('conf_email_id_user');

                if(isset($_POST['send_conf_email_user_pay_invoice']))
                    $data['send_conf_email_user_pay_invoice'] = $this->input->post('send_conf_email_user_pay_invoice');
                else $data['send_conf_email_user_pay_invoice'] = '';
                $data['conf_invoice_pay_email_id'] = $this->input->post('conf_invoice_pay_email_id');

                if(isset($_POST['send_confirmation_email_cancel_order']))
                    $data['send_confirmation_email_cancel_order'] = $this->input->post('send_confirmation_email_cancel_order');
                else $data['send_confirmation_email_cancel_order'] = '';

                $data['conf_cancel_order_email_id'] = $this->input->post('conf_cancel_order_email_id');
                $data['email_id_payment_info'] = $this->input->post('email_id_payment_info');
                $data['item_desc'] = $this->input->post('item_desc');

                if(isset($_POST['inclusions'])){
                    $data['inclusions'] = implode('|',$this->input->post('inclusions'));
                }
                else $data['inclusions'] = '';

                if(isset($_POST['exclusions']))
                    $data['exclusions'] = implode('|',$this->input->post('exclusions'));
                else $data['exclusions'] = '';
                
                if(isset($_POST['related_tour']) && $_POST['related_tour'] != ''){
                    $related_tours = implode('|',$_POST['related_tour']);
                }
            
                $data['related_tours'] = $related_tours;

                $uploadPath = Image_Path;
                if(!empty($_FILES['images'])){

                    //print_r($_FILES['images']);die;
                    for($i=0 ;$i<count($_FILES['images']);$i++){
                        $ext = pathinfo($_FILES['images']['name'][$i],PATHINFO_EXTENSION);
                        if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif'){
                            $newFileName = 'tour_'.date('YmdHis').'.'.$ext;
                            //echo $uploadPath.$newFileName;die;
                            //echo $uploadPath.$newFileName;die;
                            move_uploaded_file($_FILES['images']['tmp_name'][$i],$uploadPath.$newFileName);

                            $images[] = $newFileName;
                        }
                    }
                } else {
                    $images[] = '';
                }
                //die;
                $data['date_added'] = date('Y-m-d');

                $this->packages_model->editTourPackages($data,$images);
                redirect('packages/manage_tour');
            } else {
                $data['tour'] = $this->packages_model->getTourDetailsOnId($id);
                $data['groups'] = $this->packages_model->getAllGroups();
                $data['countryList'] = $this->packages_model->getAllCountryList();
                $data['related_tours'] = $this->packages_model->getAllToursListName();
                $data['id'] = $id;
                $this->load->view('packages/edit_tour',$data);
            }
        }
    }
    
    function delete_tour($id){
        $this->db->query($sql = "delete from tour_packages where id='".$id."'");
        redirect('packages/manage_tour');
    }
    
    function getParentCategoryAndTypeOnGroup() {
        $groupId = $_GET['group'];
        $html = '';
        $typeHtml = '';
        $catList = $this->packages_model->getCategoryListOnGroup($groupId);
        $typeList = $this->packages_model->getTypeListOnGroup($groupId);
        $html .= '<option value="0">Root</option>';
        if($catList != ''){
            
            foreach($catList as $cat){
                $html .= '<option value="'.$cat->id.'">'.$cat->category_name.'</option>';
            }
        } else {
             $html .= '<option value="0">Root</option>';
        }
        
        $typeHtml .= '<option value="">Select a Type</option>';
        if($typeList != ''){
            foreach($typeList as $type){
                $typeHtml .= '<option value="'.$type->id.'">'.$type->business_type.'</option>';
            }
        } else {
            $typeHtml .= '<option value="">Select a Type</option>';
        }
        
        echo json_encode(array(
            'parent_category'=>$html,
            'type_id'=>$typeHtml
        ));
    }
    
    function getStateListOnCountry(){
        $country = $_GET['country'];
        $html = '';
        $stateList = $this->packages_model->getStateListOnCountry($country);
        $html .= '<option value="">Select a state</option>';
        if($stateList != ''){
            foreach($stateList as $state){
                $html .= '<option value="'.$state->id.'">'.$state->name.'</option>';
            }
        } else {
            $html .= '<option value="">No states found</option>';
        }
        
        echo json_encode(array(
            'states'=>$html
        ));
        
    }
    
    function getCityListOnState(){
        $state = $_GET['state'];
        $html = '';
        $cityList = $this->packages_model->getCityListOnState($state);
        $html .= '<option value="">Select a city</option>';
        if($cityList != ''){
            foreach($cityList as $city){
                $html .= '<option value="'.$city->id.'">'.$city->name.'</option>';
            }
        } else {
            $html .= '<option value="">No city found</option>';
        }
        
        echo json_encode(array(
            'city'=>$html
        ));
    }
    

}
