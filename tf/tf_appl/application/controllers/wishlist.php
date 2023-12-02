<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
* Wishlist module.
* Vikas Arora.
* Maps all wishlist related operations.
*/

class Wishlist extends CI_Controller {
    public function __construct(){
        parent::__construct();

        $this->load->model('Auth_Model');
        $this->load->model('account_model');
        $this->load->model('reference_model');
        $this->load->model('email_model');
        $this->load->model('verification_model');
        $this->load->model('Listings_Model');
        $this->load->model('Help_Model');
        $this->load->model('Wishlist_Model');
        $this->load->model('apartment_model');

        $this->helpMenuLink = $this->Help_Model->fetchHelpLinks();
        
        $current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
        $current_url = $this->config->site_url().$this->uri->uri_string(). $current_url;

        $url =  array(
            'continue' => $current_url,
        );
        $this->session->set_userdata($url);
        $this->islogged_in();
    }

    public function islogged_in(){
        if($this->session->userdata('b2c_id')) {
            $current_logged_in_id = $this->session->userdata('b2c_id');
        } else if($this->session->userdata('b2b_id')) {
            $current_logged_in_id = $this->session->userdata('b2b_id');
        } else {
            redirect(WEB_URL);
        }
    }

    public function userAccessCheck() {
        if($this->session->userdata('b2c_id')) {
            $user_id = $this->session->userdata('b2c_id');
        } else if($this->session->userdata('b2b_id')) {
            $user_id = $this->session->userdata('b2b_id');
        }

        if($user_id == "" || empty($user_id) || !isset($user_id) ) {
            $response = array("status"=>0);
        } else {
            $response = array("status"=>1);
        }

        echo json_encode($response);
    }

    public function addWishlistNode() {
        $nodeName = $this->input->post("node_name");
        $privacy = $this->input->post("privacy");

        if($this->session->userdata('b2c_id')){
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        }

        if($nodeName != "") {
            if($this->Wishlist_Model->createWishlistNode($user_id, $user_type, $nodeName, $privacy)) {
                $response = array("status"=>1);
                echo json_encode($response);
            }
        }
    }

    public function getWishlist() {
        if($this->session->userdata('b2c_id')){
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        }
        $wishlist_data = $this->Wishlist_Model->getAllWishlist($user_id, $user_type)->result();
        foreach($wishlist_data as $key) {
            if($key->PHOTO_CONTENT != "") {
                $img = $this->apartment_model->view_property_file($key->PHOTO_CONTENT);
                $key->PHOTO_CONTENT = $img;   //reset array key with actual image
            } else {    
                $key->PHOTO_CONTENT = "";   //reset array key with actual image
            }
            
        }
        $data['wishlist_data'] = $wishlist_data;
        $data['wishlist_count'] = $this->Wishlist_Model->getAllWishlist($user_id, $user_type)->num_rows();
        
        echo json_encode($data);
    }

    public function addWish() {
        if($this->session->userdata('b2c_id')){
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        }

        $product_id = $this->input->post("product_id");
        $product_name = $this->input->post("product_name");
        $wishlist_type_id = $this->input->post("wishlist_type_id");
        $add_note = $this->input->post("add_note");

        if($add_note == "") {
            $add_note = "";
        }

        //prepare data
        $data = array('domain'=>1, 'user_type'=>$user_type, 'user_id'=>$user_id, 'wishlist_type_id'=>$wishlist_type_id, 'product_name'=>$product_name, 'product_id'=>$product_id, 'add_note'=>$add_note );
        
        $checkWish = $this->doesWishlistExist($user_id, $user_type, $wishlist_type_id, $product_id);
        if($checkWish) {
            if($this->Wishlist_Model->addWish($data)) {
                $response = array("status"=>1);
            } else {
                $response = array("status"=>0);
            }
        } else {
            $response = array("status"=>1);    
        }
        echo json_encode($response);
    }


    public function doesWishlistExist($user_id, $user_type, $wishlist_type_id, $product_id) {
        $count_wish = $this->Wishlist_Model->doesWishlistExist($user_id, $user_type, $wishlist_type_id, $product_id)->num_rows();
        if($count_wish > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function openWishlist($wishlist_id=null) {
        if($wishlist_id != "") {
            if($this->session->userdata('b2c_id')){
                $data['user_type']=$user_type = 3;
                $data['user_id']=$user_id = $this->session->userdata('b2c_id');
            }else if($this->session->userdata('b2b_id')){
                $data['user_type']=$user_type = 2;
                $data['user_id']=$user_id = $this->session->userdata('b2b_id');
            }

            $data['getWishes_num_rows'] = $this->Wishlist_Model->getUserBasedWishlist($user_id, $user_type, $wishlist_id)->num_rows(); 
            
            $data['getWishes'] = $this->Wishlist_Model->getUserBasedWishlist($user_id, $user_type, $wishlist_id)->result(); //all wishlists

            $data['userInfo'] = $this->account_model->GetUserData($user_type, $user_id)->row();
            
            $all_images = array();
            foreach($data['getWishes'] as $data_key) {
                
                $count = $this->apartment_model->getApartmentImages($data_key->PROPERTY_ID)->num_rows();
            
                if($count > 0){
                    $getBaseImage = $this->apartment_model->getApartmentImages($data_key->PROPERTY_ID)->result();
                    array_push($all_images, $getBaseImage);
                }    
            }
            
            $data['wishImgPack'] = $all_images;
            $this->load->view('dashboard/wishlist_content_view', $data);
        } else {
            redirect(WEB_URL.'/dashboard/wishlist');
        }
    }

    public function removeWish() {
        $wishlist_typeId = $this->input->post("tid");
        $wishlist_productId = $this->input->post("pid");
        
        if($this->session->userdata('b2c_id')){
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        }

        
        if(isset($wishlist_typeId) && trim($wishlist_typeId) != "" && 
            isset($wishlist_productId) && trim($wishlist_productId) != "" &&
             isset($user_id) && trim($user_id)) {
            $data = array("user_id" => $user_id, "user_type"=> $user_type, "wishlist_type_id" => $wishlist_typeId, "product_id" => $wishlist_productId);

            if($this->Wishlist_Model->removeWish($user_id, $data)) {
                $updatedCount = $this->Wishlist_Model->getUserBasedWishlist($user_id, $user_type, $wishlist_typeId)->num_rows();
                $response = array("status" => 1, "updatedCount"=>$updatedCount);
            } else {
                $response = array("status" => 0);
            }
            echo json_encode($response);
        }

    }

    public function saveEditedWishlist() {
        if($this->session->userdata('b2c_id')){
            $data['user_type']=$user_type = 3;
            $data['user_id']=$user_id = $this->session->userdata('b2c_id');
        }else if($this->session->userdata('b2b_id')){
            $data['user_type']=$user_type = 2;
            $data['user_id']=$user_id = $this->session->userdata('b2b_id');
        } else {
            return false;
        }

        $wishlistName = $this->input->post('wishlistName');
        $wishlistPrivacy = $this->input->post('wishlistPrivacy');
        $wishlistid = $this->input->post('wishlistid');

        if($this->Wishlist_Model->saveEditedWishlist($user_id, $user_type, $wishlistid, $wishlistName, $wishlistPrivacy)) {
            $response = array('status'=>1);
        } else {
            $response = array('status'=>0);
        }

        echo json_encode($response);
    }

    public function deleteWishlist() {
        $wishlistId = $this->input->post('wishlistId');
        $deleteWishlist = $this->Wishlist_Model->deleteWishlist($wishlistId); //delete wishlist container
        if($deleteWishlist) {
            $deleteWish = $this->Wishlist_Model->deleteWishes($wishlistId); //delete all wishes inside the wishlist
            if($deleteWish) {
                $response = array('status'=>1);
                echo json_encode($response);
            }
        }
    }

}