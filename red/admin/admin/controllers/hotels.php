<?php
error_reporting(E_ALL);
defined('BASEPATH') OR exit('No direct script access allowed');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class hotels extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->database();
        $this->load->model('hotels_model');
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
################################################################################################
    
    
    function add_groups() {
        $this->form_validation->set_rules('group_name', "Group Name", 'xss_clean|required');
        if ($this->form_validation->run() == TRUE) {
            $data['group_name'] = $this->input->post('group_name');
            $data['type_name'] = $this->input->post('type_name');
            $data['admin_id'] = $this->session->userdata('admin_logged_in');
            ######################## Meta Data ##########################
            $data['meta_title'] = $this->input->post('meta_title');
            $data['meta_keyword'] = $this->input->post('meta_keyword');
            $data['meta_desc'] = $this->input->post('meta_desc');
            #############################################################
            $group_id = $this->hotels_model->addGroup($data);
            if ($group_id) {
                //$this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("hotels/manage_groups");
            }
        } else {
            $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
            $this->data['types'] = $this->hotels_model->getAllBusinessTypes();
            $this->load->view("hotels/add_group", $this->data);
        }
    }

    function edit_groups($id) {
        if ($id != '') {
            $this->form_validation->set_rules('group_name', "Group Name", 'xss_clean|required');
            if ($this->form_validation->run() == TRUE) {
                $data['group_id'] = $this->input->post('group_id');
                $data['group_name'] = $this->input->post('group_name');
                $data['type_name'] = $this->input->post('type_name');
                $data['admin_id'] = $this->session->userdata('admin_logged_in');
                ######################## Meta Data ##########################
                $data['meta_title'] = $this->input->post('meta_title');
                $data['meta_keyword'] = $this->input->post('meta_keyword');
                $data['meta_desc'] = $this->input->post('meta_desc');
                #############################################################
                $this->hotels_model->editGroup($data);
                redirect("hotels/manage_groups");
            } else {
                $this->data['id'] = $id;
                $this->data['group'] = $this->hotels_model->getGroupById($id);
                $this->data['types'] = $this->hotels_model->getAllBusinessTypes();
                $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
                $this->load->view("hotels/edit_group", $this->data);
            }
        }
    }

    function manage_groups() {
        $data['groups'] = $this->hotels_model->getAllGroups();
        $this->load->view('hotels/manage_groups', $data);
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
                    $newFileName = 'hotelcat_'.date('YmdHis').'.'.$ext;
                    //echo $uploadPath.$newFileName;die;
                    move_uploaded_file($_FILES['category_thumb']['tmp_name'],$uploadPath.$newFileName);
                    
                    $data['category_thumb'] = $newFileName;
                } else {
                    $data['category_thumb'] = '';
                } 
            } else {
                $data['category_thumb'] = '';
            }
            $this->hotels_model->addCategoryData($data);
            redirect('hotels/manage_category');
            
        } else {
            $data['groups'] = $this->hotels_model->getAllGroups();
            $this->load->view('hotels/add_category',$data);
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
                        $newFileName = 'hotelcat_'.date('YmdHis').'.'.$ext;
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
                $this->hotels_model->editCategoryData($data);
                redirect('hotels/manage_category');

            } else {
                $data['id'] = $id;
                $data['category'] = $this->hotels_model->getCategoryOnId($id);
                $data['groups'] = $this->hotels_model->getAllGroups();
                $this->load->view('hotels/edit_category',$data);
            }
        }
    }
    
    function delete_category($id){
        if($id != ''){
            $this->hotels_model->deleteCategoryOnId($id);
        }
        redirect('hotels/manage_category');
    }
    
    function delete_groups($id){
        if($id != ''){
            $this->db->query($sql = "delete from hotelcrs_groups where id='".$id."'");
        }
        redirect('hotels/manage_groups');
    }
    
    
    function manage_category(){
        $data['categorys'] = $this->hotels_model->getAllCategoryList();
        $this->load->view('hotels/manage_category',$data);
    }

    function getParentCategoryOnGroup() {
        $groupId = $_GET['group'];
        $html = '';
        $catList = $this->hotels_model->getParentCategoryOnGroup($groupId);
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
    
    function add_room_type(){
        $this->form_validation->set_rules('hotel', "Hotel", 'xss_clean|required');
        $this->form_validation->set_rules('room_type', "Room Type", 'xss_clean|required');
        if ($this->form_validation->run() == TRUE){
            $data['hotel'] = $this->input->post('hotel');
            $data['room_type'] = $this->input->post('room_type');
            $data['max_people'] = $this->input->post('max_people');
            $data['max_child'] = $this->input->post('max_child');
            $data['room_condition'] = $this->input->post('room_condition');
            $data['description'] = $this->input->post('description');
           
            if($_FILES['room_image'] != ''){
                $ext = pathinfo($_FILES['room_image']['name'],PATHINFO_EXTENSION);
                if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif'){
                    $uploadPath = Image_Path;
                    $newFileName = 'roomtype_'.date('YmdHis').'.'.$ext;
                    //echo $uploadPath.$newFileName;die;
                    move_uploaded_file($_FILES['room_image']['tmp_name'],$uploadPath.$newFileName);
                    
                    $data['room_image'] = $newFileName;
                } else {
                    $data['room_image'] = '';
                } 
            } else {
                $data['room_image'] = '';
            }
            $this->hotels_model->addRoomTypeData($data);
            redirect('hotels/manage_room_type');
            
        } else {
            $data['hotels'] = $this->hotels_model->getAllHotelsListOnlyName();
            $this->load->view('hotels/add_room_type',$data);
        }
    }
    
    function manage_room_type(){
        $data['types'] = $this->hotels_model->getAllRoomTypes();
        $this->load->view('hotels/manage_room_type', $data);
    }
    
    function edit_room_type($id){
        if($id != ''){
            $this->form_validation->set_rules('hotel', "Hotel Name", 'xss_clean|required');
            $this->form_validation->set_rules('room_type', "Room Type", 'xss_clean|required');
            if ($this->form_validation->run() == TRUE){
                $data['room_id'] = $this->input->post('room_id');
                $data['hotel'] = $this->input->post('hotel');
                $data['room_type'] = $this->input->post('room_type');
                $data['max_people'] = $this->input->post('max_people');
                $data['max_child'] = $this->input->post('max_child');
                $data['room_condition'] = $this->input->post('room_condition');
                $data['description'] = $this->input->post('description');
                
                if($_FILES['room_image'] != ''){
                    $ext = pathinfo($_FILES['room_image']['name'],PATHINFO_EXTENSION);
                    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif'){
                        $uploadPath = Image_Path;
                        $newFileName = 'roomtype_'.date('YmdHis').'.'.$ext;
                        //echo $newFileName;die;
                        move_uploaded_file($_FILES['room_image']['tmp_name'],$uploadPath.$newFileName);
                        $data['room_image'] = $newFileName;
                    } else {
                        $data['room_image'] = $this->input->post('old_thumb');
                    } 
                } else {
                    $data['room_image'] = $this->input->post('old_thumb');
                }
               // print_r($data);die;
                $this->hotels_model->editRoomTypeData($data);
                redirect('hotels/manage_room_type');

            } else {
                $data['id'] = $id;
                $data['room_type'] = $this->hotels_model->getRoomTypeOnId($id);
                $data['hotels'] = $this->hotels_model->getAllHotelsListOnlyName();
                $this->load->view('hotels/edit_room_type',$data);
            }
        }
    }
    
    function delete_room_type($id){
         if($id != ''){
            $this->hotels_model->deleteRoomTypeOnId($id);
        }
        redirect('hotels/manage_room_type');
    }
    
    
    function add_price_plan(){
        if($_POST){
            $data['hotel_id'] = $this->input->post('hotel_id');
            $data['room_type'] = $this->input->post('room_type');
            $data['min_stay_through'] = $this->input->post('min_stay_through');
            $data['nights'] = $this->input->post('nights');
            $data['price_per_night'] = $this->input->post('price_per_night');
            $data['price_after_discount'] = $this->input->post('price_after_discount');
            $this->hotels_model->addPricePlanData($data);
            redirect('hotels/manage_price_plan');
        }
        else{
            $data['hotel_list'] = $this->hotels_model->getAllHotels();
            $this->load->view('hotels/add_price_plan',$data);
        }
    }
    
    function manage_price_plan(){
        $data['plans'] = $this->hotels_model->getAllPricePlan();
        $this->load->view('hotels/manage_price_plan', $data);
    }
    
    function delete_price_plan($id){
        if($id != ''){
            $this->hotels_model->deletePricePlanOnId($id);
        }
        redirect('hotels/manage_price_plan');
    }
    
    function edit_price_plan($id){
        if($id != ''){
            $this->form_validation->set_rules('plan_name', "Plan Name", 'xss_clean|required');
            
            if ($this->form_validation->run() == TRUE){
                $data['plan_id'] = $this->input->post('plan_id');
                $data['hotel_id'] = $this->input->post('hotel_id');
                $data['room_type'] = $this->input->post('room_type');
                $data['min_stay_through'] = $this->input->post('min_stay_through');
                $data['nights'] = $this->input->post('nights');
                $data['price_per_night'] = $this->input->post('price_per_night');
                $data['price_after_discount'] = $this->input->post('price_after_discount');
                
                
               // print_r($data);die;
                $this->hotels_model->editPricePlanData($data);
                redirect('hotels/manage_price_plan');

            } else {
                $data['id'] = $id;
                $data['plan'] = $this->hotels_model->getPlanDetailsOnId($id);
                $data['hotel_list'] = $this->hotels_model->getAllHotels();
                $this->load->view('hotels/edit_price_plan',$data);
            }
        }
    }

    
    function add_room(){
        $this->form_validation->set_rules('hotel', "Hotel", 'xss_clean|required');
        $this->form_validation->set_rules('room_type', "Room Type", 'xss_clean|required');
        if ($this->form_validation->run() == TRUE){
            $data['hotel'] = $this->input->post('hotel');
            $data['room_type'] = $this->input->post('room_type');
            $data['room_name'] = $this->input->post('room_name');
            $data['room_condition'] = $this->input->post('room_condition');
            $data['description'] = $this->input->post('description');
            $this->hotels_model->addRoomData($data);
            redirect('hotels/manage_room');
            
        } else {
            $data['hotels'] = $this->hotels_model->getAllHotelsListOnlyName();
            $this->load->view('hotels/add_room',$data);
        }
    }
    
    function getRoomTypeOnHotelId(){
        $val = $_REQUEST['group'];
        $roomTypes = $this->hotels_model->getRoomTypesOnHotelId($val);
        $html = '<option value="">Select room type</option>';
        if($roomTypes != ''){
            foreach($roomTypes as $types){
                $html .= '<option value="'.$types->id.'">'.$types->room_type.'</option>';
            }
        }
        echo json_encode(array('room_type'=>$html));
    }
    
    function manage_room(){
        $data['types'] = $this->hotels_model->getAllRooms();
        $this->load->view('hotels/manage_room', $data);
    }
    
    function edit_room($id){
        if($id != ''){
            $this->form_validation->set_rules('hotel_id', "Hotel Name", 'xss_clean|required');
            $this->form_validation->set_rules('room_type', "Room Type", 'xss_clean|required');
            $this->form_validation->set_rules('room_name', "Room NAme", 'xss_clean|required');
            if ($this->form_validation->run() == TRUE){
                $data['room_id'] = $this->input->post('room_id');
                $data['hotel_id'] = $this->input->post('hotel_id');
                $data['room_type'] = $this->input->post('room_type');
                $data['room_name'] = $this->input->post('room_name');
                $data['room_condition'] = $this->input->post('room_condition');
                $data['description'] = $this->input->post('description');
                
                $this->hotels_model->editRoom($data);
                redirect('hotels/manage_room');

            } else {
                $data['id'] = $id;
                $data['room_data'] = $this->hotels_model->getRoomDataOnId($id);
                $data['room_type'] = $this->hotels_model->getRoomTypeNameOnId($data['room_data']->room_type);
                $data['hotels'] = $this->hotels_model->getAllHotelsListOnlyName();
                $this->load->view('hotels/edit_room',$data);
            }
        }
    }
    
    
    function add_type($status=''){
        $this->form_validation->set_rules('business_type', "Business Type", 'xss_clean|required');
        if ($this->form_validation->run() == TRUE) {
            $data['business_type'] = $this->input->post('business_type');
            $data['admin_id'] = $this->session->userdata('admin_logged_in');
            $type_id = $this->hotels_model->addType($data);
            if ($type_id) {
                redirect("hotels/add_type/1");
            }
        } else {
            $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
            $data['status'] = $status;
            $this->load->view("hotels/add_type", $data);
        }
    }
    
    function edit_type($id){
        if($id != ''){
            $this->form_validation->set_rules('business_type', "Business Type", 'xss_clean|required');
            if ($this->form_validation->run() == TRUE) {
                $data['type_id'] = $this->input->post('type_id');
                $data['business_type'] = $this->input->post('business_type');
                $data['admin_id'] = $this->session->userdata('admin_logged_in');
                $this->hotels_model->editType($data);
                redirect("hotels/manage_type");
            } else {
                $data['id'] = $id;
                $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
                $data['groups'] = $this->hotels_model->getAllGroups();
                $data['type'] = $this->hotels_model->getTypeOnId($id);
                $this->load->view("hotels/edit_type", $data);
            }
        }
    }
    
    function delete_type($id){
        if($id != ''){
            $this->hotels_model->deleteTypeOnId($id);
        }
        redirect('hotels/manage_type');
    }
    
    function manage_type(){
        $data['types'] = $this->hotels_model->getAllTourTypes();
        $this->load->view('hotels/manage_type',$data);
    }
    
    function add_hotel(){
        
        if($_POST){
            //echo '<pre />';print_r($_POST);die;
            
            $data['hotel_name'] = $this->input->post('hotel_name');
            $data['hotel_rating'] = $this->input->post('hotel_rating');
            $data['hotel_status'] = $this->input->post('hotel_status');
            $data['group_id'] = $this->input->post('group_id');
            $data['type_id'] = $this->input->post('type_id');
            $data['category'] = $this->input->post('category');
            $data['hotel_desc'] = $this->input->post('hotel_desc');
            $data['country'] = $this->input->post('country');
            $data['state'] = $this->input->post('state');
            $data['city'] = $this->input->post('city');
            $data['hotel_loc'] = $this->input->post('hotel_loc');
            $data['hotel_phone'] = $this->input->post('hotel_phone');
            $data['hotel_fax'] = $this->input->post('hotel_fax');
            $data['hotel_email'] = $this->input->post('hotel_email');
            $data['post_code'] = $this->input->post('post_code');
            $data['hotel_address'] = $this->input->post('hotel_address');
          
            $data['meta_title'] = $this->input->post('meta_title');
            $data['meta_keyword'] = $this->input->post('meta_keyword');
            $data['meta_desc'] = $this->input->post('meta_desc');
            
            $data['google_map'] = $this->input->post('google_map');
            $data['hotel_policy'] = $this->input->post('hotel_policy');
            $data['cancel_policy'] = $this->input->post('cancel_policy');
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
            
//            if(isset($_POST['room_type_id']) && $_POST['room_type_id'] != ''){
//                $data['room_type_id'] = implode('|',$this->input->post('room_type_id'));
//            }
            $data['room_type_id'] = '';
            
           $images = array();
           $imagesInt = array();
            $uploadPath = Image_Path;
            if(!empty($_FILES['exterior_images'])){
                
                
                for($i=0 ;$i<count($_FILES['exterior_images']['name']);$i++){
                    $ext = pathinfo($_FILES['exterior_images']['name'][$i],PATHINFO_EXTENSION);
                    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif'){
                        $newFileName = 'hotelext_'.date('YmdHis').$i.'.'.$ext;
                        
                        move_uploaded_file($_FILES['exterior_images']['tmp_name'][$i],$uploadPath.$newFileName);

                        $images[] = $newFileName;
                    }
                }
            } else {
                $images[] = '';
            }
            
            if(!empty($_FILES['interior_images'])){
                
                //print_r($_FILES['images']);die;
                for($i=0 ;$i<count($_FILES['interior_images']['name']);$i++){
                    $ext = pathinfo($_FILES['interior_images']['name'][$i],PATHINFO_EXTENSION);
                    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif'){
                        $newFileName = 'hotelint_'.date('YmdHis').$i.'.'.$ext;
                        
                        move_uploaded_file($_FILES['interior_images']['tmp_name'][$i],$uploadPath.$newFileName);

                        $imagesInt[] = $newFileName;
                    }
                }
            } else {
                $imagesInt[] = '';
            }
            //die;
            $data['date_added'] = date('Y-m-d');
            
            $this->hotels_model->addHotelsData($data,$images,$imagesInt);
            redirect('hotels/manage_hotel');
            
        } else {
            $data['groups'] = $this->hotels_model->getAllGroups();
            $data['countryList'] = $this->hotels_model->getAllCountryList();
            $data['room_types'] = $this->hotels_model->getAllRoomTypes();
            $data['types'] = $this->hotels_model->getAllBusinessTypes();
            $this->load->view('hotels/add_hotel',$data);
        }
    }
    
    function manage_hotel(){
        $data['hotels'] = $this->hotels_model->getAllHotels();
        $this->load->view('hotels/manage_hotel',$data);
    }
    
    function delete_hotel($id){
        if($id != ''){
            $this->db->query($sql = "delete from hotelcrs_hotels where id='".$id."'");
        }
        redirect('hotels/manage_hotel');
    }
    
    
    function delete_room($id){
         if($id != ''){
            $this->db->query($sql = "delete from hotelcrs_room where id='".$id."'");
        }
        redirect('hotels/manage_room');
    }
    
    
//     function add_tour(){
//        
//        if($_POST){
//            //echo '<pre />';print_r($_POST);die;
//            
//            $data['tour_name'] = $this->input->post('tour_name');
//            $data['tour_operator'] = $this->input->post('tour_operator');
//            $data['group_id'] = $this->input->post('group_id');
//            $data['type_id'] = $this->input->post('type_id');
//            $data['category'] = $this->input->post('category');
//            $data['short_overview'] = $this->input->post('short_overview');
//            $data['adult_price'] = $this->input->post('adult_price');
//            $data['child_price'] = $this->input->post('child_price');
//            $data['infant_price'] = $this->input->post('infant_price');
//            $data['price_type'] = $this->input->post('price_type');
//            $data['payment_desc'] = $this->input->post('payment_desc');
//            $data['country'] = $this->input->post('country');
//            $data['state'] = $this->input->post('state');
//            $data['city'] = $this->input->post('city');
//            $data['post_code'] = $this->input->post('post_code');
//            $data['tour_duration'] = $this->input->post('tour_duration');
//            $data['rating'] = $this->input->post('rating');
//            $data['tour_code'] = $this->input->post('tour_code');
//            $data['nights'] = $this->input->post('nights');
//            $data['days'] = $this->input->post('days');
//            $data['meta_title'] = $this->input->post('meta_title');
//            $data['meta_keyword'] = $this->input->post('meta_keyword');
//            $data['meta_desc'] = $this->input->post('meta_desc');
//            
//            $data['start_city'] = $this->input->post('start_city');
//            $data['end_city'] = $this->input->post('end_city');
//            $data['visiting_city'] = $this->input->post('visiting_city');
//            $data['operating_on'] = $this->input->post('operating_on');
//            $data['sightseeing'] = $this->input->post('sightseeing');
//            $data['no_of_acomodates'] = $this->input->post('no_of_acomodates');
//            $data['guide_tape'] = $this->input->post('guide_tape');
//            $data['pickup_service'] = $this->input->post('pickup_service');
//            $data['room_addon_facility'] = $this->input->post('room_addon_facility');
//            $data['dropoff_service'] = $this->input->post('dropoff_service');
//            $data['entertainments'] = $this->input->post('entertainments');
//            $data['view_location_type'] = $this->input->post('view_location_type');
//            $data['itinerary_title'] = $this->input->post('itinerary_title');
//            $data['itenerary_detail'] = $this->input->post('itenerary_detail');
//            $data['available_from_date'] = $this->input->post('available_from_date');
//            $data['available_to_date'] = $this->input->post('available_to_date');
//            $data['google_map'] = $this->input->post('google_map');
//            $data['tour_highlights'] = $this->input->post('tour_highlights');
//            $data['tour_policy'] = $this->input->post('tour_policy');
//            $data['terms_condition'] = $this->input->post('terms_condition');
//            if(isset($_POST['send_confirmation_email_user']))
//                $data['send_confirmation_email_user'] = $this->input->post('send_confirmation_email_user');
//            else $data['send_confirmation_email_user'] = '';
//            
//            $data['conf_email_id_user'] = $this->input->post('conf_email_id_user');
//            
//            if(isset($_POST['send_conf_email_user_pay_invoice']))
//                $data['send_conf_email_user_pay_invoice'] = $this->input->post('send_conf_email_user_pay_invoice');
//            else $data['send_conf_email_user_pay_invoice'] = '';
//            $data['conf_invoice_pay_email_id'] = $this->input->post('conf_invoice_pay_email_id');
//            
//            if(isset($_POST['send_confirmation_email_cancel_order']))
//                $data['send_confirmation_email_cancel_order'] = $this->input->post('send_confirmation_email_cancel_order');
//            else $data['send_confirmation_email_cancel_order'] = '';
//            
//            $data['conf_cancel_order_email_id'] = $this->input->post('conf_cancel_order_email_id');
//            $data['email_id_payment_info'] = $this->input->post('email_id_payment_info');
//            $data['item_desc'] = $this->input->post('item_desc');
//            
//            if(isset($_POST['inclusions'])){
//                $data['inclusions'] = implode('|',$this->input->post('inclusions'));
//            }
//            else $data['inclusions'] = '';
//            
//            if(isset($_POST['exclusions']))
//                $data['exclusions'] = implode('|',$this->input->post('exclusions'));
//            else $data['exclusions'] = '';
//            
//            if(isset($_POST['related_tour']) && $_POST['related_tour'] != ''){
//                $related_tours = implode('|',$_POST['related_tour']);
//            }
//            
//            $data['related_tours'] = $related_tours;
//            $uploadPath = $_SERVER['DOCUMENT_ROOT'].'/upload/';
//            if(!empty($_FILES['images'])){
//                
//                //print_r($_FILES['images']);die;
//                for($i=0 ;$i<count($_FILES['images']);$i++){
//                    $ext = pathinfo($_FILES['images']['name'][$i],PATHINFO_EXTENSION);
//                    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif'){
//                        $newFileName = 'tour_'.date('YmdHis').'.'.$ext;
//                        //echo $uploadPath.$newFileName;die;
//                        //echo $uploadPath.$newFileName;die;
//                        move_uploaded_file($_FILES['images']['tmp_name'][$i],$uploadPath.$newFileName);
//
//                        $images[] = $newFileName;
//                    }
//                }
//            } else {
//                $images[] = '';
//            }
//            //die;
//            $data['date_added'] = date('Y-m-d');
//            
//            $this->packages_model->addTourPackages($data,$images);
//            redirect('packages/manage_tour');
//            
//        } else {
//            $data['groups'] = $this->hotels_model->getAllGroups();
//            $data['countryList'] = $this->hotels_model->getAllCountryList();
//            $data['room_types'] = $this->hotels_model->getAllRoomTypes();
//            $this->load->view('packages/add_tour',$data);
//        }
//    }
    
    
    ############################################################################
    function get_city() {
        $val = $_REQUEST['val'];
        $city_list = $this->hotels_model->get_hotel_city_list($val);
        $data1['city_list'] = $city_list;
        echo json_encode($data1);
    }

    public function delete() {
        $ids = ( explode(',', $this->input->get_post('ids')));
        $this->hotels_model->delete($ids);
    }

    function getParentCategoryAndTypeOnGroup() {
        $groupId = $_GET['group'];
        $html = '';
        $typeHtml = '';
        $catList = $this->hotels_model->getCategoryListOnGroup($groupId);
        
        $html .= '<option value="0">Root</option>';
        if($catList != ''){
            
            foreach($catList as $cat){
                $html .= '<option value="'.$cat->id.'">'.$cat->category_name.'</option>';
            }
        } else {
             $html .= '<option value="0">Root</option>';
        }
        
        
        
        echo json_encode(array(
            'parent_category'=>$html,
            'type_id'=>$typeHtml
        ));
    }
    
    function getRoomTypeListOnHotel($id){
        $roomTypes = $this->hotels_model->getAllRoomTypesOnHotelId($id);
        $html = '<option value="">select type</option>';
        if($roomTypes != ''){
            foreach($roomTypes as $type){
                $html .= '<option value="'.$type->id.'">'.$type->room_type.'</option>';
            }
        }
        
        echo json_encode(array(
            'room_type'=>$html
        ));
    }
    

}
