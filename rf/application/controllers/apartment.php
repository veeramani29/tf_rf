<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Apartment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_Model');
        $this->load->model('apartment_model');
        $this->load->helper('apartment_helper');
        $this->load->model('wishlist_model');
        $this->load->model('account_model');
        $this->load->model('Help_Model');
        $this->load->model('Verification_Model');
        $this->load->model('email_model');
        $this->load->model('booking_model');
        $this->load->model('reviews_model');
        $this->load->model('Message_Model');
        $this->load->model('cart_model');

        $this->helpMenuLink = $this->Help_Model->fetchHelpLinks();

        $this->load->library(array('table', 'form_validation', 'session', 'javascript'));
        $this->load->library('pagination');

        $controller = $this->router->fetch_class();
        parent::validate_modules($controller);
    }

    public function home(){
        $data['banners'] = $this->Help_Model->getHomeSettings();
        $data['portfolio'] = $this->Help_Model->getAllPortfolio();
		$data['background'] = $this->Help_Model->getAllBackgroundimages();
        $this->load->view('apartment/apartment_index',$data);   
    }

    public function index() {
        parent::pre_url();
        $segments = $this->input->get();
        $query_string = $this->input->server('QUERY_STRING');
        //echo '<pre>';print_r($segments);die;
        $address = $this->uri->segment(2);
        $address = urldecode($address);
        $city = explode('-', $address);
        $data['city'] = $city[0];

        $address = str_replace('--', ', ', $address);
        $get = $this->input->get();

        $geometry = AddressToGeometry($address);
        //echo '<pre>';print($city);die;
        //$apartments = $this->apartment_model->getApartmentsByGeometry($geometry['latitude'],$geometry['longitude'])->result();


        $data['geometry'] = json_encode($geometry);
        $filters = array();
        $remove_arr = array();
        if (isset($get['price_min'])) {
            $filters['price_min'] = $get['price_min'];
            $remove_arr[] = 'price_min';
        }
        if (isset($get['price_max'])) {
            $filters['price_max'] = $get['price_max'];
            $remove_arr[] = 'price_max';
        }
        if (isset($get['min_bathrooms'])) {
            $filters['min_bathrooms'] = $get['min_bathrooms'];
            $data['bathrooms'] = $get['min_bathrooms'];
            $remove_arr[] = 'min_bathrooms';
        }
        if (isset($get['min_bedrooms'])) {
            $filters['min_bedrooms'] = $get['min_bedrooms'];
            $data['bedrooms'] = $get['min_bedrooms'];
            $remove_arr[] = 'min_bedrooms';
        }
        if (isset($get['min_beds'])) {
            $filters['min_beds'] = $get['min_beds'];
            $data['beds'] = $get['min_beds'];
            $remove_arr[] = 'min_beds';
        }
        if (isset($get['hosting_amenities'])) {
            $filters['hosting_amenities'] = $get['hosting_amenities'];
            $data['hosting_amenities'] = $get['hosting_amenities'];
            $remove_arr[] = 'hosting_amenities';
        }
        if (isset($get['property_type_id'])) {
            $filters['property_type_id'] = $get['property_type_id'];
            $data['property_type_id'] = $get['property_type_id'];
            $remove_arr[] = 'property_type_id';
        }
        if (isset($get['ib'])) {
            $filters['ib'] = $get['ib'];
            $data['ib'] = $get['ib'];
            $remove_arr[] = 'ib';
        }
        $data['remove_arr'] = $remove_arr;
        //$rows = $this->apartment_model->getApartmentsCount($geometry['latitude'],$geometry['longitude'], $filters)->result();
        //echo '<pre>';print_r($remove_arr);die;
        if ($geometry['status'] == 'OK') {
            $rows = $this->apartment_model->getApartmentsCount($geometry['latitude'], $geometry['longitude'], $filters)->num_rows();
        } else {
            $rows = 0;
        }
        if ($rows > 0) {//$config['base_url'] = WEB_URL.'/apartment/apartmentAjaxSearch?location='.$address.'&page=';
            $config['base_url'] = WEB_URL . '/apartment/apartmentAjaxSearch/' . $address;
            $config['total_rows'] = $rows;
            $config['per_page'] = 4;
            $config["uri_segment"] = 3;
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = "</ul>";
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = "<li class='active'><a href='#'>";
            $config['cur_tag_close'] = "</a></li>";
            $config['next_tag_open'] = "<li>";
            $config['next_link'] = '»';
            $config['next_tagl_close'] = "</li>";
            $config['prev_tag_open'] = "<li>";
            $config['prev_tagl_close'] = "</li>";
            $config['prev_link'] = '«';
            $config['first_tag_open'] = "<li>";
            $config['first_tagl_close'] = "</li>";
            $config['last_tag_open'] = "<li>";
            $config['last_tagl_close'] = "</li>";
            $config['anchor_class'] = 'class="loadAjaxPage"';
            $config['suffix'] = '?' . $query_string;

            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            //$page = $this->uri->segment(3);
            $data["links"] = $this->pagination->create_links();

            $apartments = $data['apartments'] = $this->apartment_model->getApartmentsByGeometrysWithoutLimit($geometry['latitude'], $geometry['longitude'], $filters)->result();
            foreach ($apartments as $key => $apartment) {
                //echo $apartment->PROP_RATE_NIGHTLY_FROM.'--'.$apartment->PROPERTY_ID.'--'.$key.'<br>';
                $PROP_RATE_NIGHTLY_FROM = $this->apartment_model->currency_convertor($apartment->PROP_RATE_NIGHTLY_FROM, $apartment->PROP_RATE_CURRENCY, CURR);
                $price[] = $PROP_RATE_NIGHTLY_FROM;
            }
            if (isset($get['price_min'])) {
                $min = (int) $get['price_min'];
                $data['min'] = $this->account_model->currency_convertor($min);
            } else {
                $min = (int) min($price);
                $data['min'] = $this->account_model->currency_convertor($min);
            }
            if (isset($get['price_max'])) {
                $max = (int) $get['price_max'];
                $data['max'] = $this->account_model->currency_convertor($max);
            } else {
                $max = (int) max($price);
                $data['max'] = $this->account_model->currency_convertor($max);
            }

            $data['rows'] = $rows;

            $apartments = $data['apartments'] = $this->apartment_model->getApartmentsByGeometrys($geometry['latitude'], $geometry['longitude'], $config["per_page"], $page, $filters)->result();

            if ($this->session->userdata('b2c_id')) {
                $data['user_type'] = $user_type = 3;
                $data['user_id'] = $user_id = $this->session->userdata('b2c_id');
            } else if ($this->session->userdata('b2b_id')) {
                $data['user_type'] = $user_type = 2;
                $data['user_id'] = $user_id = $this->session->userdata('b2b_id');
            } else {
                $user_id = "";
                $user_type = "";
            }

            $i = 0;
            foreach ($apartments as $apartment) {
                $images = $this->apartment_model->getApartmentImages($apartment->PROPERTY_ID)->result();
                $ApartmentUser = $this->apartment_model->getApartmentUser($apartment->USER_TYPE, $apartment->USER_ID)->row();
                if($apartment->USER_TYPE == '3'){
                    if($ApartmentUser->profile_photo == ''){
                       $pic = ASSETS.'images/user-avatar.jpg';
                    }else{
                        $pic = $ApartmentUser->profile_photo;
                    }
                }else if($apartment->USER_TYPE == '2'){ 
                //echo '<pre>';print_r($ApartmentUser);die;
                    if($ApartmentUser->agent_logo == ''){
                        $pic = ASSETS.'images/user-avatar.jpg';
                    }else{
                        $pic = $ApartmentUser->agent_logo;
                    }
                }
                
                if ($pic == '') {
                    $pic = ASSETS . 'images/user-avatar.jpg';
                }

                $PROP_RATE_NIGHTLY_FROM = $this->apartment_model->currency_convertor($apartment->PROP_RATE_NIGHTLY_FROM, $apartment->PROP_RATE_CURRENCY, CURR);
                $apts[] = array(
                    'PROPERTY_ID' => $apartment->PROPERTY_ID,
                    'PROP_NAME' => $apartment->PROP_NAME,
                    'PROP_LATITUDE' => $apartment->PROP_LATITUDE,
                    'PROP_LONGITUDE' => $apartment->PROP_LONGITUDE,
                    'PROP_DESCRIPTION' => $apartment->PROP_DESCRIPTION,
                    'PROP_ADDR1' => $apartment->PROP_ADDR1,
                    'PROP_TYPE_LABEL' => $apartment->PROP_TYPE_LABEL,
                    'PROP_RATE_NIGHTLY_FROM' => $PROP_RATE_NIGHTLY_FROM,
                    'ApartmentUserPic' => $pic,
                    'ApartmentUserId' => $apartment->USER_ID,
                    'ApartmentUsertype' => $apartment->USER_TYPE,
                    'Apturl' => WEB_URL . '/apartment/rooms/' . $apartment->PROPERTY_ID . '?' . $query_string,
                    'images' => $images,
                    'PROP_INSTANT_BOOK' => $apartment->PROP_INSTANT_BOOK
                );
                $i++;
            }




            $markers = array();
            foreach ($apartments as $apartment) {
                $ApartmentUser = $this->apartment_model->getApartmentUser($apartment->USER_TYPE, $apartment->USER_ID)->row();
                if($apartment->USER_TYPE == '3'){
                    if($ApartmentUser->profile_photo == ''){
                       $pic = ASSETS.'images/user-avatar.jpg';
                    }else{
                        $pic = $ApartmentUser->profile_photo;
                    }
                }else if($apartment->USER_TYPE == '2'){ 
                //echo '<pre>';print_r($ApartmentUser);die;
                    if($ApartmentUser->agent_logo == ''){
                        $pic = ASSETS.'images/user-avatar.jpg';
                    }else{
                        $pic = $ApartmentUser->agent_logo;
                    }
                }
                if ($pic == '') {
                    $pic = ASSETS . 'images/user-avatar.jpg';
                }
                $aurl = WEB_URL . '/apartment/rooms/' . $apartment->PROPERTY_ID . '?' . $query_string;
                $aurl = $this->apartment_model->parseQueryString($aurl, $remove_arr);
                $PROP_RATE_NIGHTLY_FROM = $this->apartment_model->currency_convertor($apartment->PROP_RATE_NIGHTLY_FROM, $apartment->PROP_RATE_CURRENCY, CURR);
                $mark['PROPERTY_ID'] = $apartment->PROPERTY_ID;
                $mark['title'] = $apartment->PROP_NAME;
                $mark['lat'] = $apartment->PROP_LATITUDE;
                $mark['lng'] = $apartment->PROP_LONGITUDE;
                $mark['description'] = $apartment->PROP_DESCRIPTION;
                $mark['addr'] = $apartment->PROP_ADDR1;
                $mark['type'] = $apartment->PROP_TYPE_LABEL;
                $mark['perNight'] = $this->account_model->currency_convertor($PROP_RATE_NIGHTLY_FROM);
                $mark['CURR_ICON'] = $this->display_icon;
                $mark['ApartmentUserPic'] = $pic;
                $mark['ApartmentUserId'] = $apartment->USER_ID;
                $mark['ApartmentUsertype'] = $apartment->USER_TYPE;
                $mark['Apturl'] = $aurl;


                $inWishlist_count = $this->wishlist_model->inUserWishlist($user_id, $apartment->PROPERTY_ID)->num_rows();
                if ($inWishlist_count > 0) {
                    $mark['inWishlist'] = 1;
                } else {
                    $mark['inWishlist'] = 0;
                }


                $count = $this->apartment_model->getApartmentImages($apartment->PROPERTY_ID)->num_rows();
                if ($count > 0) {
                    $images = $this->apartment_model->getApartmentImages($apartment->PROPERTY_ID)->result();
                    $mark['images'] = $images[0];
                }
                array_push($markers, $mark);
            }


            $data['wishlist'] = $this->wishlist_model->getAllWishlist($user_id, $user_type)->result();
            $data['addedWishlist'] = $this->wishlist_model->getAddedWishlist($user_id, $user_type)->result();

            //echo '<pre>';print_r($apts);die;

            $data['markers'] = json_encode($markers);
            $data['apartments'] = $apts;
        } else {
            $data['mark'] = json_encode(new stdClass);
        }
        $data['amenities'] = $this->apartment_model->getAllAmenities()->result();
        $data['property_types'] = $this->apartment_model->getAllPropertyTypes()->result();
        $data['rows'] = $rows;
        $address = str_replace(', ', '--', $address);
        if (isset($get['price_min'])) {
            $data['temp_min'] = $this->input->get('price_min');
        } else {
            $data['temp_min'] = '0';
        }
        if (isset($get['price_max'])) {
            $data['temp_max'] = $this->input->get('price_max');
        } else {
            $data['temp_max'] = '0';
        }

        //echo "Showing ".( $this->pagination->cur_page * $this->pagination->per_page)." of ". $this->pagination->total_rows." total results";die;
        $data['Apturl'] = WEB_URL . '/apartment/' . $address . '?' . $query_string;
        $data['Filter_Apturl'] = WEB_URL . '/apartment/apartmentAjaxSearch/' . $address . '/0?' . $query_string;
        $this->load->view('apartment/results', $data);
        //echo '<pre>';print_r($apts);
        //echo json_encode($markers);
    }

    public function apartmentAjaxSearch() {
        ob_start("ob_gzhandler");
        $query_string = $this->input->server('QUERY_STRING');
        //die;//$address = $this->input->get('location');
        $address = $this->uri->segment(3);
        $address = str_replace('--', ', ', $address);
        $get = $this->input->get();
        $geometry = AddressToGeometry($address);
        $segments = $this->uri->segment_array();
        //echo '<pre>';print_r($segments);
        // $apartments = $this->apartment_model->getApartmentsByGeometry($geometry['latitude'],$geometry['longitude'])->result();
        // $filters = array(
        //     'price_min' = '',
        //     'price_max' = ''
        // );
        //$data['geometry'] = json_encode($geometry);
        $filters = array();
        $remove_arr = array();
        if (isset($get['price_min'])) {
            $filters['price_min'] = $get['price_min'];
            $remove_arr[] = 'price_min';
        }
        if (isset($get['price_max'])) {
            $filters['price_max'] = $get['price_max'];
            $remove_arr[] = 'price_max';
        }
        if (isset($get['min_bathrooms'])) {
            $filters['min_bathrooms'] = $get['min_bathrooms'];
            $remove_arr[] = 'min_bathrooms';
        }
        if (isset($get['min_bedrooms'])) {
            $filters['min_bedrooms'] = $get['min_bedrooms'];
            $remove_arr[] = 'min_bedrooms';
        }
        if (isset($get['min_beds'])) {
            $filters['min_beds'] = $get['min_beds'];
            $remove_arr[] = 'min_beds';
        }
        if (isset($get['hosting_amenities'])) {
            $filters['hosting_amenities'] = $get['hosting_amenities'];
            $data['hosting_amenities'] = $get['hosting_amenities'];
            $remove_arr[] = 'hosting_amenities';
        }
        if (isset($get['property_type_id'])) {
            $filters['property_type_id'] = $get['property_type_id'];
            $data['property_type_id'] = $get['property_type_id'];
            $remove_arr[] = 'property_type_id';
        }
        if (isset($get['ib'])) {
            $filters['ib'] = $get['ib'];
            $data['ib'] = $get['ib'];
            $remove_arr[] = 'ib';
        }
        //$rows = $this->apartment_model->getApartmentsCount($geometry['latitude'],$geometry['longitude'], $filters)->result();
        //echo '<pre>';print_r($rows);die;
        $rows = $this->apartment_model->getApartmentsCount($geometry['latitude'], $geometry['longitude'], $filters)->num_rows();
        //echo $rows;
        if ($rows > 0) {
            $config['base_url'] = WEB_URL . '/apartment/apartmentAjaxSearch/' . $address;
            $config['total_rows'] = $rows;
            $config['per_page'] = 4;
            $config["uri_segment"] = 4;
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = "</ul>";
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = "<li class='active'><a href='#'>";
            $config['cur_tag_close'] = "</a></li>";
            $config['next_tag_open'] = "<li>";
            $config['next_link'] = '»';
            $config['next_tagl_close'] = "</li>";
            $config['prev_tag_open'] = "<li>";
            $config['prev_tagl_close'] = "</li>";
            $config['prev_link'] = '«';
            $config['first_tag_open'] = "<li>";
            $config['first_tagl_close'] = "</li>";
            $config['first_url'] = WEB_URL . '/apartment/apartmentAjaxSearch/' . $address . '/0?' . $query_string;
            $config['last_tag_open'] = "<li>";
            $config['last_tagl_close'] = "</li>";
            $config['anchor_class'] = 'class="loadAjaxPage"';
            $config['suffix'] = '?' . $query_string;
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            //die;
            //$page = $this->uri->segment(4); 
            // $page = str_replace('/', '', $page);
            $links = $this->pagination->create_links();

            $apartments = $this->apartment_model->getApartmentsByGeometrys($geometry['latitude'], $geometry['longitude'], $config["per_page"], $page, $filters)->result();
            // $this->load->view('apartment/ajax_results',$data);
            if ($this->session->userdata('b2c_id')) {
                $data['user_type'] = $user_type = 3;
                $data['user_id'] = $user_id = $this->session->userdata('b2c_id');
            } else if ($this->session->userdata('b2b_id')) {
                $data['user_type'] = $user_type = 2;
                $data['user_id'] = $user_id = $this->session->userdata('b2b_id');
            } else {
                $user_id = "";
                $user_type = "";
            }
            if($user_id != '' && $user_type != ''){
                $data['addedWishlist'] = $addedWishlist = $this->wishlist_model->getAddedWishlist($user_id, $user_type)->result();
            }else{
                $addedWishlist = array();
            }
            if (empty($addedWishlist)) {
                $as = false;
            } else {
                $as = true;
                foreach ($addedWishlist as $key => $value) {
                    $wish[] = $value->product_id;
                }
            }
            //echo '<pre>';print_r($wish);die;

            $markers = array();
            $i = 0;
            foreach ($apartments as $apartment) {
                $imgs = array();
                $images = $this->apartment_model->getApartmentImages($apartment->PROPERTY_ID)->result();
                $ApartmentUser = $this->apartment_model->getApartmentUser($apartment->USER_TYPE, $apartment->USER_ID)->row();
                if($apartment->USER_TYPE == '3'){
                    if($ApartmentUser->profile_photo == ''){
                       $pic = ASSETS.'images/user-avatar.jpg';
                    }else{
                        $pic = $ApartmentUser->profile_photo;
                    }
                }else if($apartment->USER_TYPE == '2'){ 
                
                    if($ApartmentUser->agent_logo == ''){
                        $pic = ASSETS.'images/user-avatar.jpg';
                    }else{
                        $pic = $ApartmentUser->agent_logo;
                    }
                }
                if ($pic == '') {
                    $pic = ASSETS . 'images/user-avatar.jpg';
                }
                if (!empty($addedWishlist)) {
                    if (in_array($apartment->PROPERTY_ID, $wish)) {
                        $isWish = true;
                    } else {
                        $isWish = false;
                    }
                }else{
                    $isWish = false;
                }
                //echo '<pre>';print_r($images);
                if (count($images) > 0) {
                    $img = '';
                    foreach ($images as $image) {
                        if ($image->PHOTO_CONTENT != '') {
                            $img = $this->apartment_model->view_property_file($image->PHOTO_CONTENT);
                        }
                        break;
                    }
                    if ($img == '') {
                        $img = ASSETS . 'images/nomg.jpg';
                    }

                    foreach ($images as $image) {
                        if ($image->PHOTO_CONTENT != '') {
                            $imgs[]['IMG'] = $this->apartment_model->view_property_file($image->PHOTO_CONTENT);
                        }
                    }

                }
                $aurl = WEB_URL . '/apartment/rooms/' . $apartment->PROPERTY_ID . '?' . $query_string;
                $aurl = $this->apartment_model->parseQueryString($aurl, $remove_arr);
                $PROP_RATE_NIGHTLY_FROM = $this->apartment_model->currency_convertor($apartment->PROP_RATE_NIGHTLY_FROM, $apartment->PROP_RATE_CURRENCY, CURR);
                if ($apartment->PROP_INSTANT_BOOK == '1') {
                    $instant = true;
                } else {
                    $instant = false;
                }
                $apts['apartment'][] = array(
                    'PROPERTY_ID' => $apartment->PROPERTY_ID,
                    'apt_id' => $i,
                    'title' => $apartment->PROP_NAME,
                    'lat' => $apartment->PROP_LATITUDE,
                    'lng' => $apartment->PROP_LONGITUDE,
                    'description' => $apartment->PROP_DESCRIPTION,
                    'addr' => $apartment->PROP_ADDR1,
                    'type' => $apartment->PROP_TYPE_LABEL,
                    'perNight' => $this->account_model->currency_convertor($PROP_RATE_NIGHTLY_FROM),
                    'CURR_ICON' => $this->display_icon,
                    'ApartmentUserPic' => $pic,
                    'ApartmentUserId' => $apartment->USER_ID,
                    'ApartmentUsertype' => $apartment->USER_TYPE,
                    'Apturl' => WEB_URL . '/apartment/rooms/' . $apartment->PROPERTY_ID . '?' . $query_string,
                    'Aurl' => $aurl,
                    'images' => $imgs,
                    'addedWishlist' => $as,
                    'isWish' => $isWish,
                    'image' => $img,
                    'instant' => $instant
                );
                $i++;
            }
//echo '<pre>';print_r($apts);die;

            $wishlist = $this->wishlist_model->getAllWishlist($user_id,$user_type)->result();
            $addedWishlist['addedWishlist'] = $this->wishlist_model->getAddedWishlist($user_id,$user_type)->result();
            //echo '<pre>';print_r($apts['apartment']);die;
            // $apartments = json_encode($apts);


            $markers = array();
            foreach ($apartments as $apartment) {
                $ApartmentUser = $this->apartment_model->getApartmentUser($apartment->USER_TYPE, $apartment->USER_ID)->row();
                if($apartment->USER_TYPE == '3'){
                    if($ApartmentUser->profile_photo == ''){
                       $pic = ASSETS.'images/user-avatar.jpg';
                    }else{
                        $pic = $ApartmentUser->profile_photo;
                    }
                }else if($apartment->USER_TYPE == '2'){ 
                //echo '<pre>';print_r($ApartmentUser);die;
                    if($ApartmentUser->agent_logo == ''){
                        $pic = ASSETS.'images/user-avatar.jpg';
                    }else{
                        $pic = $ApartmentUser->agent_logo;
                    }
                }
                if ($pic == '') {
                    $pic = ASSETS . 'images/user-avatar.jpg';
                }
                $PROP_RATE_NIGHTLY_FROM = $this->apartment_model->currency_convertor($apartment->PROP_RATE_NIGHTLY_FROM, $apartment->PROP_RATE_CURRENCY, CURR);
                $mark['PROPERTY_ID'] = $apartment->PROPERTY_ID;
                $mark['title'] = $apartment->PROP_NAME;
                $mark['lat'] = $apartment->PROP_LATITUDE;
                $mark['lng'] = $apartment->PROP_LONGITUDE;
                $mark['description'] = $apartment->PROP_DESCRIPTION;
                $mark['addr'] = $apartment->PROP_ADDR1;
                $mark['type'] = $apartment->PROP_TYPE_LABEL;
                $mark['perNight'] = $this->account_model->currency_convertor($PROP_RATE_NIGHTLY_FROM);
                $mark['CURR_ICON'] = $this->display_icon;
                $mark['ApartmentUserPic'] = $pic;
                $mark['ApartmentUserId'] = $apartment->USER_ID;
                $mark['ApartmentUsertype'] = $apartment->USER_TYPE;
                $mark['Apturl'] = $aurl;
                $count = $this->apartment_model->getApartmentImages($apartment->PROPERTY_ID)->num_rows();
                if ($count > 0) {
                    $images = $this->apartment_model->getApartmentImages($apartment->PROPERTY_ID)->result();
                    $mark['images'] = $images[0];
                }
                array_push($markers, $mark);
            }
            //$markers = json_encode($markers);
            $results = array(
                'apartments' => $apts,
                'markers' => $markers,
                'pagination' => $links,
                'wishlist' => $wishlist,
                'addedWishlist' => $addedWishlist,
                'rows' => $rows
            );
        } else {
            $results = array(
                'markers' => array(),
                'rows' => $rows
            );
        }
        
        echo json_encode($results);
        ob_end_flush();
        //echo '<pre>';print_r($apts);
    }

    public function search() {
        $address = $this->input->post('address');
        $address = str_replace(', ', '-', $address);
        $checkin = $this->input->post('checkin');
        $checkout = $this->input->post('checkout');
        $adult = $this->input->post('adult');
        $child = $this->input->post('child');
        $infant = $this->input->post('infant');
        $guests = $adult + $child + $infant;
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $request = WEB_URL . '/apartment/' . $address;
        if ((!empty($checkin) && !empty($checkout) && $guests > 1) || (!empty($checkin) && !empty($checkout))) {
            $request = WEB_URL . '/apartment/' . $address . '?';
        }
        if (!empty($checkin)) {
            $request = $request . 'checkin=' . $checkin;
        }
        if (!empty($checkout)) {
            $request = $request . '&checkout=' . $checkout;
        }
        if (empty($checkin) || empty($checkout)) {
            $request = WEB_URL . '/apartment/' . $address . '?';
        }
        if ($guests > 1) {
            $request = $request . '&guests=' . $guests;
        }
        if ($adult >= 1) {
            $request = $request . '&adult=' . $adult;
        }
        if ($child >= 1) {
            $request = $request . '&child=' . $child;
        }
        if ($infant >= 1) {
            $request = $request . '&infant=' . $infant;
        }
        redirect($request);
    }

    public function rooms() {
        parent::pre_url();
        $queries = $this->input->get();
        $assoc = $this->uri->uri_to_assoc(3);
        $PROPERTY_ID = $data['PROPERTY_ID'] = $this->uri->segment(3);
        $data['Apartment'] = $Property = $this->apartment_model->getApartmentDetails($PROPERTY_ID)->row();
        //echo '<pre>';print_r($Property);die;
        $data['Images'] = $Images = $this->apartment_model->getApartmentImages($PROPERTY_ID)->result();
        if(!empty($Property)){
            if ((isset($data['Apartment']->profile_photo) && $data['Apartment']->profile_photo == '') || (isset($data['Apartment']->agent_logo) && $data['Apartment']->agent_logo == '')) {
                $data['profile_photo'] = ASSETS . 'images/user-avatar.jpg';
            } elseif (isset($data['Apartment']->agent_logo)) {
                $data['profile_photo'] = $data['Apartment']->agent_logo;
            } else {
                $data['profile_photo'] = $data['Apartment']->profile_photo;
            }

            if ($this->session->userdata('b2c_id')) {
                $data['user_type'] = $user_type = 3;
                $data['user_id'] = $user_id = $this->session->userdata('b2c_id');
            } else if ($this->session->userdata('b2b_id')) {
                $data['user_type'] = $user_type = 2;
                $data['user_id'] = $user_id = $this->session->userdata('b2b_id');
            } else {
                $data['user_type'] = $user_type = "";
                $data['user_id'] = $user_id = "";
            }

            $data['wishlist'] = $this->wishlist_model->getAllWishlist($user_id, $user_type)->result();
            $data['isInWish'] = $this->wishlist_model->isInWish($user_id, $user_type, $PROPERTY_ID)->num_rows();


            $data['DetailUrl'] = WEB_URL . '/apartment/rooms/' . $PROPERTY_ID . '?';
            $available_dates = $this->apartment_model->get_available_dates($PROPERTY_ID)->result();

            
            $booked_all_dates = array();
            $booked_all_datess = array();
            foreach ($available_dates as $key => $value) {
                $available_all_dates[] = $value;
            }

            if ($Property->KIGO_PROPERTY_ID == NULL) {
                $kigo_booked_dates = array();
                $travelapt_booked_dates = $this->apartment_model->get_kigo_booked_dates($Property->PROPERTY_ID, 'travelapt')->result();
                foreach ($travelapt_booked_dates as $key => $value) {
                    $booked_all_datess[] = $this->apartment_model->get_day_wise_chunks($value->CHECK_IN, $value->CHECK_OUT);
                }
            } else {
                $travelapt_booked_dates = array();
                $kigo_booked_dates = $this->apartment_model->get_kigo_booked_dates($Property->KIGO_PROPERTY_ID, 'kigo')->result();
                foreach ($kigo_booked_dates as $key => $value) {
                    $booked_all_datess[] = $this->apartment_model->get_day_wise_chunks($value->CHECK_IN, $value->CHECK_OUT);
                }
            }

            foreach ($booked_all_datess as $key => $date) {
                if (is_array($date)) {
                    foreach ($date as $k => $d) {
                        $booked_all_dates[] = $d;
                    }
                } else {
                    $booked_all_dates[] = $date;
                }
            }
            //echo '<pre>';print_r($booked_all_dates);die;
            $data['available_all_dates'] = $available_all_dates;
            $data['booked_all_dates'] = $booked_all_dates;

            $data['apartmentUserId'] = $apartmentUserId = $data['Apartment']->USER_ID;
            $data['apartmentUserType'] = $apartmentUserType = $data['Apartment']->USER_TYPE;


            // $data['host_review_count'] = $this->reviews_model->reviewsAboutYouAccepted($apartmentUserId, $apartmentUserType)->num_rows(); 
            $hostReviewCount = $this->reviews_model->get_reviews_about_you($apartmentUserId,$apartmentUserType)->num_rows();
            $guestReviewCount = $this->reviews_model->get_reviews_about_you_guest($apartmentUserId,$apartmentUserType)->num_rows();

            $data['host_review_count'] = $hostReviewCount + $guestReviewCount;

            $userVerifiedObject = $this->Verification_Model->checkB2CVerfication($apartmentUserId, $apartmentUserType);
            $data['verified_id'] = $userVerifiedObject->row();

            //$apt_id, $prop_user_id
            $data['user_ratings'] = $this->getReviews($PROPERTY_ID, $apartmentUserId);

            $getMessageResonseData = $this->Message_Model->getMsgHistory($apartmentUserId)->result();
            $data['responseTime'] = $this->responseTimeCalculation($getMessageResonseData); //get the host response time
            $data['responseRate'] = $this->responseRateCalculation($apartmentUserId); //get host response rate
            
            $data['responseRate'] = (int) $data['responseRate']; //cast to integer to remove floating points
            $this->load->view('apartment/detail', $data);
        }else{
            redirect(WEB_URL);
        }
    }

    public function getReviews($apt_id, $prop_user_id) {
        $getReviewData = $this->reviews_model->getReviews($apt_id)->result();

        $cleanliness = 0;
        $communication = 0;
        $checkin = 0;
        $location = 0;
        $costvalue = 0;
        $accuracy = 0;
        $recommended = 0;

        $verifiedUserCount = $avgFacilityDenoCount = count($getReviewData);

        if ($avgFacilityDenoCount == 0) {
            $data['rating'] = array('clean' => '',
                'communication' => '',
                'checkin' => '',
                'location' => '',
                'costvalue' => '',
                'accuracy' => '',
                'overAllAvg' => '',
                'overAllAvg_prcntge' => '',
                'recommended' => '',
                'ratingRemark' => '',
                'verifiedUserCount' => '');
            return $data;
        }


        foreach ($getReviewData as $key) {
            $cleanliness = $cleanliness + $key->cleanliness;
            $communication = $communication + $key->communication;
            $checkin = $checkin + $key->checkin;
            $location = $location + $key->localtion;
            $costvalue = $costvalue + $key->costvalue;
            $accuracy = $accuracy + $key->accuracy;

            if ($key->recommended == 1) {
                $recommended = $recommended + 1;
            }
        }
        $cleanlinessAvg = $cleanliness / $avgFacilityDenoCount;
        $communication = $communication / $avgFacilityDenoCount;
        $checkin = $checkin / $avgFacilityDenoCount;
        $location = $location / $avgFacilityDenoCount;
        $costvalue = $costvalue / $avgFacilityDenoCount;
        $accuracy = $accuracy / $avgFacilityDenoCount;

        $cleanliness = round($cleanliness, 1);
        $communication = round($communication, 1);
        $checkin = round($checkin, 1);
        $location = round($location, 1);
        $costvalue = round($costvalue, 1);
        $accuracy = round($accuracy, 1);


        $recommendedAvg_prcntge = ($recommended / $avgFacilityDenoCount) * 100;

        //tempfix
        $recommendedAvg_prcntge = round($recommendedAvg_prcntge, -1); //round to nearest tens place like 10, 20, 30..
        //tempfix

        $avgOverallDenoCount = 6;
        $overallAvgAdd = $cleanlinessAvg + $communication + $checkin + $location + $costvalue + $accuracy;

        $overAllAvg = $overallAvgAdd / $avgOverallDenoCount;
        $overAllAvg_round = round($overAllAvg, 1);

        $overAllAvg_prcntge = ($overAllAvg_round / 6) * 100;

        //tempfix
        $overAllAvg_prcntge = round($overAllAvg_prcntge, -1); //round to nearest tens place like 10, 20, 30..
        //tempfix

        if ($overAllAvg_round >= 4 && $overAllAvg_round <= 5) {
            $ratingRemark = "Wonderful!";
        } else if ($overAllAvg_round >= 3 && $overAllAvg_round <= 4) {
            $ratingRemark = "Nice";
        } else if ($overAllAvg_round >= 2 && $overAllAvg_round <= 3) {
            $ratingRemark = "Neutral";
        } else if ($overAllAvg_round >= 1 && $overAllAvg_round <= 2) {
            $ratingRemark = "Neutral";
        } else if ($overAllAvg_round >= 1 && $overAllAvg_round <= 0) {
            $ratingRemark = "Dislike";
        }

        $data['rating'] = array('clean' => $cleanlinessAvg,
            'communication' => $communication,
            'checkin' => $checkin,
            'location' => $location,
            'costvalue' => $costvalue,
            'accuracy' => $accuracy,
            'overAllAvg' => $overAllAvg_round,
            'overAllAvg_prcntge' => $overAllAvg_prcntge,
            'recommended' => $recommendedAvg_prcntge,
            'ratingRemark' => $ratingRemark,
            'verifiedUserCount' => $verifiedUserCount);

        $data['reviews'] = $this->reviews_model->reviewsAboutPropAccepted($prop_user_id, 3)->result();

        return $data;
    }

    public function CalculateRent() {
        $checkin = $this->input->get('checkin');
        $checkout = $this->input->get('checkout');
        $guests = $this->input->get('guests');
        $adult = $this->input->get('adult');
        $child = $this->input->get('child');
        $infant = $this->input->get('infant');
        $nights = $this->input->get('nights');
        $pid = $this->input->get('pid');
        $data['status'] = false;
        $data['available'] = false;
        $data['reason_message'] = '';

        $ex_cin = explode('-', $checkin);
        $ex_cout = explode('-', $checkout);

        $custom_cin = $ex_cin[2] . '-' . $ex_cin[1] . '-' . $ex_cin[0];
        $custom_cout = $ex_cout[2] . '-' . $ex_cout[1] . '-' . $ex_cout[0];

        if (strtotime($checkin) < strtotime(date('d-m-Y')) || strtotime($checkin) >= strtotime($checkout)) {//checkin and checkout validation
            $data['reason_message'] = 'Invalid check in date: ' . $checkin;
        } else {
            $Property = $this->apartment_model->getApartmentDetails($pid)->row();
            $min_stay_unit = $Property->PROP_STAYTIME_MIN_UNIT;
            $min_stay_length = $Property->PROP_STAYTIME_MIN_VALUE;
            if ($min_stay_unit === 'NIGHT') {
                $min_stay_unit = 1;
            } else if ($min_stay_unit === 'MONTH') {
                $min_stay_unit = 30;
            } else if ($min_stay_unit === 'YEAR') {
                $min_stay_unit = 365;
            }
            $max_stay_unit = $Property->PROP_STAYTIME_MAX_UNIT;
            $max_stay_length = $Property->PROP_STAYTIME_MAX_VALUE;
            if ($max_stay_unit === 'NIGHT') {
                $max_stay_unit = 1;
            } else if ($max_stay_unit === 'MONTH') {
                $max_stay_unit = 30;
            } else if ($max_stay_unit === 'YEAR') {
                $max_stay_unit = 365;
            }
            $min_stay_length = $min_stay_length * $min_stay_unit;
            $max_stay_length = $max_stay_length * $max_stay_unit;

            $data['guests'] = $guests;

            $NightlyRent = $this->apartment_model->GetnightlyRental($pid, $custom_cin, $custom_cout);
            //echo '<pre>';print_r($NightlyRent);die;
            if (!empty($NightlyRent) && $NightlyRent != 'weekly') {

                foreach ($NightlyRent as $key => $value) {
                    $temp_date = date('Y-m-d', strtotime('-1 day', strtotime($value->CHECK_OUT)));

                    $temp_date1 = date('Y-m-d', strtotime('+1 day', strtotime($value->CHECK_IN)));
                    $temp_date2 = date('Y-m-d', strtotime('-1 day', strtotime($value->CHECK_OUT)));

                    $nightly_values[$value->CHECK_IN . ',' . $value->CHECK_OUT] = $this->apartment_model->GetNightlyRentalPeriods($value->NIGHTLY_RANDOM);
                    $nightly_values_temp1[] = $temp_date1 . ',' . $temp_date2;
                    $nightly_values_temp[] = $value->CHECK_IN . ',' . $value->CHECK_OUT;
                }
                //print_r($nightly_values_temp1);die;

                foreach ($nightly_values_temp1 as $key => $value) {
                    $explode = explode(',', $value);
                    $apartemnt_night_wise_temp[] = $this->apartment_model->get_day_wise_chunks($explode[0], $explode[1]);
                }

                foreach ($apartemnt_night_wise_temp as $key => $value) {
                    foreach ($value as $skey => $svalue) {
                        $apartemnt_night_wise_temp_1[] = $svalue;
                    }
                }

                $apartemnt_night_wise = $this->apartment_model->get_day_wise_chunks($custom_cin, $custom_cout);
                $apartemnt_night_wise_s = $apartemnt_night_wise;

                $apartemnt_week_wise_temp = $apartemnt_night_wise;

                $i = 0;
                foreach ($apartemnt_week_wise_temp as $key => $value) {
                    if (in_array($value, $apartemnt_night_wise_temp_1)) {
                        unset($apartemnt_week_wise_temp[$i]);
                    }
                    $i++;
                }

                for ($i = 0; $i < count($apartemnt_night_wise); $i++) {
                    if ($apartemnt_night_wise[$i] == $custom_cout) {
                        //unset($apartemnt_night_wise[$i]);
                    }
                }

                foreach ($NightlyRent as $key => $value) {
                    $start_date[] = strtotime($value->CHECK_IN);
                    $end_date[] = strtotime($value->CHECK_OUT);
                    $temp_start_date[] = $value->CHECK_IN;
                    $temp_end_date[] = $value->CHECK_OUT;
                }

                for ($i = 0; $i < count($temp_start_date); $i++) {
                    $temp_night_chunks[] = $this->apartment_model->get_day_wise_chunks($temp_start_date[$i], $temp_end_date[$i]);
                }


                foreach ($temp_night_chunks as $key => $value) {
                    foreach ($value as $skey => $svalue) {
                        $temp_chunks[] = $svalue;
                    }
                }

                foreach ($temp_chunks as $key => $value) {
                    if (in_array($value, $apartemnt_night_wise_s)) {
                        if (($key = array_search($value, $apartemnt_night_wise_s)) !== false) {
                            unset($apartemnt_night_wise_s[$key]);
                        }
                    }
                }

                $min_start_date = date('Y-m-d', min($start_date));
                $min_end_date = date('Y-m-d', min($end_date));

                $rent_sub_total = array();

                foreach ($nightly_values as $key => $value) {
                    $explode_cin_cout_dates = explode(',', $key);

                    //Check for Year
                    $year_nights_module = round($nights / 365);
                    if ($year_nights_module >= 1) {
                        $d_n_module = $year_nights_module;
                        $d_n_u_module = 'YEAR';
                    }

                    //Check for Months
                    $month_nights_module = round(($nights * 12) / 365);
                    if ($month_nights_module >= 1 && $month_nights_module < 12) {
                        $d_n_module = $month_nights_module;
                        $d_n_u_module = 'MONTH';
                    }

                    //Check for Nights
                    $nights_module = $nights / 30;
                    if ($nights_module < 1) {
                        $d_n_module = $nights;
                        $d_n_u_module = 'NIGHT';
                    }


                    if ($NightlyRent[0]->PERGUEST_CHARGE_TYPE == 'ADULTS') {
                        $guests = $adult;
                    } else if ($NightlyRent[0]->PERGUEST_CHARGE_TYPE == 'ADULTS_CHILDREN') {
                        $guests = $adult + $child;
                    } else if ($NightlyRent[0]->PERGUEST_CHARGE_TYPE == 'ADULTS_CHILDREN_BABIES') {
                        $guests = $adult + $child + $infant;
                    }


                    foreach ($value as $sskey => $ssvalue) {
                        foreach ($value as $k => $v) {
                            if ($v->NIGHTLY_STAY_UNIT == 'NIGHT') {
                                if ($v->NIGHTLY_STAY_NUMBER <= $d_n_module) {
                                    $max_n[] = $v->NIGHTLY_STAY_NUMBER;
                                    $max_g[] = $v->NIGHTLY_GUESTS_FROM;
                                }
                            } elseif ($v->NIGHTLY_STAY_UNIT == 'MONTH') {
                                if ($v->NIGHTLY_STAY_NUMBER <= $d_n_module) {
                                    $max_n[] = $v->NIGHTLY_STAY_NUMBER;
                                    $max_g[] = $v->NIGHTLY_GUESTS_FROM;
                                }
                            } elseif ($v->NIGHTLY_STAY_UNIT == 'YEAR') {
                                if ($v->NIGHTLY_STAY_NUMBER <= $d_n_module) {
                                    $max_n[] = $v->NIGHTLY_STAY_NUMBER;
                                    $max_g[] = $v->NIGHTLY_GUESTS_FROM;
                                }
                            }
                        }
                    }

                    $stay_length = max($max_n);
                    $guest_length = end($max_g);

                    //if($nights < 7){
                    if (in_array($custom_cin, $apartemnt_night_wise)) {
                        $key = array_search($custom_cin, $apartemnt_night_wise, false);
                        unset($apartemnt_night_wise[$key]);
                    }
                    // }                            


                    foreach ($apartemnt_night_wise as $skey => $svalue) {
                        if (((strtotime($explode_cin_cout_dates[0]) <= strtotime($svalue)) && (strtotime($explode_cin_cout_dates[1]) >= strtotime($svalue)))) {
                            $week_days = date('N', strtotime($svalue));

                            foreach ($value as $k => $v) {
                                if ($v->NIGHTLY_STAY_UNIT == 'NIGHT' && $v->NIGHTLY_STAY_NUMBER <= $stay_length && $d_n_u_module == 'NIGHT') {

                                    $explode = explode(',', $v->WEEK_NIGHTS);
                                    if (in_array($week_days, $explode)) {
                                        if ($guests == $v->NIGHTLY_GUESTS_FROM) {
                                            $rent_sub_total[] = ($v->NIGHTLY_AMOUNT);
                                            break;
                                        } elseif ($v->NIGHTLY_GUESTS_FROM == $guest_length) {
                                            $rent_sub_total[] = ($v->NIGHTLY_AMOUNT);
                                            break;
                                        }
                                    }
                                }

                                if ($v->NIGHTLY_STAY_UNIT == 'MONTH' && $v->NIGHTLY_STAY_NUMBER == $stay_length && $d_n_u_module == 'MONTH') {

                                    $explode = explode(',', $v->WEEK_NIGHTS);

                                    if (in_array($week_days, $explode)) {
                                        if ($guests == $v->NIGHTLY_GUESTS_FROM) {
                                            $rent_sub_total[] = ($v->NIGHTLY_AMOUNT);
                                            break;
                                        } elseif ($v->NIGHTLY_GUESTS_FROM == $guest_length) {
                                            $rent_sub_total[] = ($v->NIGHTLY_AMOUNT);
                                            break;
                                        }
                                    }
                                }

                                if ($v->NIGHTLY_STAY_UNIT == 'YEAR' && $v->NIGHTLY_STAY_NUMBER == $stay_length && $d_n_u_module == 'YEAR') {
                                    $explode = explode(',', $v->WEEK_NIGHTS);

                                    if (in_array($week_days, $explode)) {
                                        if ($guests == $v->NIGHTLY_GUESTS_FROM) {
                                            $rent_sub_total[] = ($v->NIGHTLY_AMOUNT);
                                            break;
                                        } elseif ($v->NIGHTLY_GUESTS_FROM == $guest_length) {
                                            $rent_sub_total[] = ($v->NIGHTLY_AMOUNT);
                                            break;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                $RentSubtotal = array_sum($rent_sub_total);

                if (in_array($custom_cin, $apartemnt_week_wise_temp)) {
                    $key = array_search($custom_cin, $apartemnt_week_wise_temp, false);
                    unset($apartemnt_week_wise_temp[$key]);
                }

                if (in_array($custom_cout, $apartemnt_week_wise_temp)) {
                    $key = array_search($custom_cout, $apartemnt_week_wise_temp, false);
                    unset($apartemnt_week_wise_temp[$key]);
                }

                if (!empty($apartemnt_week_wise_temp)) {

                    $apartment_week_end_date = date('Y-m-d', strtotime("+1 day", strtotime(end($apartemnt_week_wise_temp))));

                    if ($apartment_week_end_date == $custom_cout) {
                        array_push($apartemnt_week_wise_temp, $custom_cout);
                    }

                    foreach ($apartemnt_week_wise_temp as $key => $value) {
                        $apartment_week_start_date = date('Y-m-d', strtotime("-1 day", strtotime($value)));
                        break;
                    }   

                    if ($apartment_week_start_date == $custom_cin) {
                        array_push($apartemnt_week_wise_temp, $custom_cin);
                    }


                    $temp_weekly_check_in_out = array();

                    $temp_explode_week_wise = array();

                    $all_weekly_rentals = $this->apartment_model->GetAllweeklyRental($pid)->result();

                    foreach ($all_weekly_rentals as $key => $value) {
                        $temp_explode_week_wise[] = $this->apartment_model->get_day_wise_chunks($value->CHECK_IN, $value->CHECK_OUT);
                    }

                    foreach ($temp_explode_week_wise as $key => $value) {
                        foreach ($value as $skey => $svalue) {
                            $temp_explode_weeks[] = $svalue;
                        }
                    }

                    foreach ($apartemnt_week_wise_temp as $key => $value) {
                        $temp_explode_strto_weeks[] = strtotime($value);
                    }

                    $temp_check_in = date('Y-m-d', min($temp_explode_strto_weeks));
                    $temp_check_out = date('Y-m-d', max($temp_explode_strto_weeks));

                    $periods_123 = $this->apartment_model->slice_weekly_rental($temp_check_in, $temp_check_out);

                    $weekly_period_count = 0;

                    foreach ($all_weekly_rentals as $key => $value) {
                        if (in_array($value->CHECK_IN, $temp_explode_weeks) && in_array($value->CHECK_OUT, $temp_explode_weeks)) {
                            $temp_weekly_check_in_out[] = $value->CHECK_IN . ',' . $value->CHECK_OUT;
                        }
                    }

                    if (!empty($temp_weekly_check_in_out)) { 
                        $chunks = $temp_weekly_check_in_out;
                        $count = 0;

                        foreach ($chunks as $key => $value) {

                            $temp_explode = explode(',', $value);

                            $temp_explode_week_wise[] = $this->apartment_model->get_day_wise_chunks($temp_explode[0], $temp_explode[1]);

                            $between_date_range = explode(',', $value);
                            //checking whether if any weekly rental is enabled and periods are there
                            $temp_count = $this->apartment_model->GetweeklyRental($pid, $between_date_range[0], $between_date_range[1])->num_rows();

                            if (!empty($temp_count)) {
                                $count++;
                            }

                            if ($temp_count > 0) {//if weekly periods are there getting periods
                                $temp = $this->apartment_model->GetweeklyRental($pid, $between_date_range[0], $between_date_range[1])->row();
                                $temp_periods[$temp->RENT_ID][] = $temp;
                            } else {//else creating one more array with rest of dates for nightly rental
                                $nightly_chunks[] = $value;
                            }
                        }

                        foreach ($temp_explode_week_wise as $key => $value) {
                            foreach ($value as $skey => $svalue) {
                                $temp_week_wise[] = $svalue;
                            }
                        }

                        $periods = array();
                        $i = 0;

                        if (!empty($temp_periods)) {
                            foreach ($temp_periods as $key => $value) {//Removing duplicate weekly periods
                                $periods[] = $value[0];
                                $periods[$i]->count = count($value);
                                $i++;
                            }

                            $period_checkin_day = strtolower(date('D', strtotime($periods[0]->CHECK_IN)));

                            foreach ($periods as $key => $Rent) {
                                $week_nights = $this->apartment_model->slice_weekly_rental($Rent->CHECK_IN, $Rent->CHECK_OUT);

                                $weekly_guest_from = explode(',', $Rent->WEEKY_GUEST_FROM);
                                $weekly_guest_amount = explode(',', $Rent->WEEKLY_AMOUNT);
                                $weekly_amount = array();

                                for ($i = 0; $i < count($weekly_guest_from); $i++) {
                                    $weekly_amount[$weekly_guest_from[$i]] = $weekly_guest_amount[$i];
                                }

                                if ($Rent->PERGUEST_CHARGE_TYPE == 'ADULTS') {
                                    $guests = $adult;
                                } else if ($Rent->PERGUEST_CHARGE_TYPE == 'ADULTS_CHILDREN') {
                                    $guests = $adult + $child;
                                } else if ($Rent->PERGUEST_CHARGE_TYPE == 'ADULTS_CHILDREN_BABIES') {
                                    $guests = $adult + $child + $infant;
                                }

                                $max_amount = end($weekly_amount);
                                $max_amount_key = end(array_keys($weekly_amount));

                                $weeks_temp = $this->apartment_model->slice_weekly_rental($Rent->CHECK_IN, $Rent->CHECK_OUT); 

                                foreach($weeks_temp['chunks'] as $key => $value){
                                    $temp = explode(',',$value);
                                    $temp_rent_check_in[] = $temp[0];
                                    $temp_rent_check_out[] = $temp[1];
                                }

                                $week_date_available = 0;

                                for($i=0;$i<count($temp_rent_check_in);$i++){
                                    if (in_array($temp_rent_check_in[$i], $apartemnt_week_wise_temp) && in_array($temp_rent_check_out[$i], $apartemnt_week_wise_temp)){
                                        $week_date_available++;                                        
                                    }
                                }

                                if (!empty($week_date_available)) {
                                    $get_day_wise_chunks = $this->apartment_model->get_day_wise_chunks($Rent->CHECK_IN, $Rent->CHECK_OUT);

                                    foreach ($get_day_wise_chunks as $key => $value) {
                                        $temp = array_search($value, $apartemnt_week_wise_temp);
                                        unset($apartemnt_week_wise_temp[$temp]);
                                    }        

                                    foreach ($weekly_amount as $key => $value) {    
                                        if ($guests == $key) {
                                            $weekly_main_amount_temp = (($value) * $Rent->count);
                                            $temp = $this->apartment_model->currency_convertor($weekly_main_amount_temp, $Rent->CURRENCY, CURR);
                                            $weekly_main_amount[] = ($temp * $week_date_available);
                                            break;
                                        } elseif ($guests > $max_amount_key) {
                                            $weekly_main_amount_temp = (($max_amount) * $Rent->count);
                                            $temp = $this->apartment_model->currency_convertor($weekly_main_amount_temp, $Rent->CURRENCY, CURR);
                                            $weekly_main_amount[] = ($temp * $week_date_available);
                                            break;
                                        }
                                    }
                                }

                                $currency_code = $Rent->CURRENCY;
                            }
                            

                            if (empty($week_date_available) && !empty($apartemnt_week_wise_temp)) {

                                if (!empty($apartemnt_week_wise_temp)) {
                                    $data['reason_message'] = 'Those dates are not available';
                                    goto label;
                                }                                
                            } 
                            elseif(!empty($week_date_available) && !empty($apartemnt_week_wise_temp) && count($apartemnt_week_wise_temp) != 1){
                                $data['reason_message'] = 'Those dates are not available';
                                goto label;
                            }
                            elseif(!empty($week_date_available) && empty($apartemnt_week_wise_temp)){
                                $RentSubtotal = $RentSubtotal + ( (array_sum($weekly_main_amount)) );
                            }
                            else {
                                $RentSubtotal = $RentSubtotal;
                            }
                            //}   
                        }

                        foreach ($temp_week_wise as $key => $value) {
                            if (in_array($value, $apartemnt_night_wise_s)) {
                                if (($key = array_search($value, $apartemnt_night_wise_s)) !== false) {
                                    unset($apartemnt_night_wise_s[$key]);
                                }
                            }
                        }
                        
                        if (!empty($apartemnt_night_wise_s)) {
                            $data['reason_message'] = 'Those dates are not available';
                            goto label;
                        }
                    }
                }
                // Get Include in fees rents

                $fees_apartment = $this->apartment_model->GetAllFees($pid)->result();

                $fees_value = array();
                $sl_temp_value = array();

                $check_in_day = strtolower(date('D', strtotime($custom_cin)));
                $check_out_day = strtolower(date('D', strtotime($custom_cout)));

                if (!empty($fees_apartment)) {
                    for ($i = 0; $i < count($fees_apartment); $i++) {

                        if ($check_in_day != 'sat' || $check_in_day != 'sun') {
                            if (isset($fees_apartment[$i]) && !empty($fees_apartment[$i])) {
                                if ($fees_apartment[$i]->FEE_TYPE_LABEL == 'Check-in fees (weekend)' || $fees_apartment[$i]->FEE_TYPE_LABEL == 'Check-out fees (weekend)') {
                                    unset($fees_apartment[$i]);
                                }
                            }
                        }

                        if ($check_out_day == 'sat' || $check_out_day == 'sun') {
                            if (isset($fees_apartment[$i]) && !empty($fees_apartment[$i])) {
                                if ($fees_apartment[$i]->FEE_TYPE_LABEL == 'Check-out fees (weekday)' || $fees_apartment[$i]->FEE_TYPE_LABEL == 'Check-in fees (weekday)') {
                                    unset($fees_apartment[$i]);
                                }
                            }
                        }
                    }
                }

                if (!empty($fees_apartment)) {
                    foreach ($fees_apartment as $key => $value) {

                        if ($value->UNIT == 'AMOUNT') {
                            $temp = json_decode($value->VALUE);
                            $fees_value[] = $temp;
                        } elseif ($value->UNIT == 'PERCENT_RENT') {
                            $temp = json_decode($value->VALUE);
                            $percentage = ($RentSubtotal / $temp);
                            $fees_value[] = $percentage;
                        } elseif ($value->UNIT == 'AMOUNT_PER_GUEST') {

                            $temp = json_decode($value->VALUE);
                            $temp_value = array();
                            if (!empty($adult)) {
                                $temp_value[] = (($adult) * ($temp->AMOUNT_ADULT));
                            }
                            if (!empty($child)) {
                                $temp_value[] = (($child) * ($temp->AMOUNT_CHILD));
                            }
                            if (!empty($infant)) {
                                $temp_value[] = (($infant) * ($temp->AMOUNT_BABY));
                            }

                            $fees_value[] = array_sum($temp_value);
                        } elseif ($value->UNIT == 'AMOUNT_PER_NIGHT_PER_GUEST') {
                            $temp = json_decode($value->VALUE);
                            $temp_value = array();

                            if (!empty($adult)) {
                                $temp_value[] = ($nights) * (($adult) * ($temp->AMOUNT_ADULT));
                            }
                            if (!empty($child)) {
                                $temp_value[] = ($nights) * (($child) * ($temp->AMOUNT_CHILD));
                            }
                            if (!empty($infant)) {
                                $temp_value[] = ($nights) * (($infant) * ($temp->AMOUNT_BABY));
                            }

                            $fees_value[] = array_sum($temp_value);
                        } elseif ($value->UNIT == 'AMOUNT_PER_NIGHT') {
                            $temp = json_decode($value->VALUE);
                            $fees_value[] = ($temp * $nights);
                        } elseif ($value->UNIT == 'STAYLENGTH') {
                            $temp = json_decode($value->VALUE);
                            if ($nights <= 6) {
                                if ($temp[0]->STAY_FROM->UNIT == 'NIGHT' && $temp[0]->STAY_FROM->NUMBER == '1') {
                                    $index = 0;
                                } elseif ($temp[1]->STAY_FROM->UNIT == 'NIGHT' && $temp[1]->STAY_FROM->NUMBER == '1') {
                                    $index = 1;
                                }
                            }

                            if ($nights >= 7) {
                                if ($temp[1]->STAY_FROM->UNIT == 'NIGHT' && $temp[1]->STAY_FROM->NUMBER == '7') {
                                    $index = 1;
                                } elseif ($temp[0]->STAY_FROM->UNIT == 'NIGHT' && $temp[0]->STAY_FROM->NUMBER == '7') {
                                    $index = 0;
                                }
                            }


                            if ($temp[$index]->UNIT == 'AMOUNT_PER_NIGHT_PER_GUEST') {
                                $temp_value_2 = array();
                                if (!empty($adult)) {
                                    $temp_value_2[] = ($nights) * (($adult) * ($temp[$index]->VALUE->AMOUNT_ADULT));
                                }
                                if (!empty($child)) {
                                    $temp_value_2[] = ($nights) * (($child) * ($temp[$index]->VALUE->AMOUNT_CHILD));
                                }
                                if (!empty($infant)) {
                                    $temp_value_2[] = ($nights) * (($infant) * ($temp[$index]->VALUE->AMOUNT_BABY));
                                }
                                $sl_temp_value[] = array_sum($temp_value_2);
                            } elseif ($temp[$index]->UNIT == 'AMOUNT_PER_GUEST') {
                                $temp_value_2 = array();
                                if (!empty($adult)) {
                                    $temp_value_2[] = (($adult) * ($temp[$index]->VALUE->AMOUNT_ADULT));
                                }
                                if (!empty($child)) {
                                    $temp_value_2[] = (($child) * ($temp[$index]->VALUE->AMOUNT_CHILD));
                                }
                                if (!empty($infant)) {
                                    $temp_value_2[] = (($infant) * ($temp[$index]->VALUE->AMOUNT_BABY));
                                }

                                $sl_temp_value[] = array_sum($temp_value_2);
                            } elseif ($temp[$index]->UNIT == 'AMOUNT') {
                                $sl_temp_value[] = ($temp[$index]->VALUE);
                            } elseif ($temp[$index]->UNIT == 'PERCENT_RENT') {
                                $percentage = ($RentSubtotal / $temp[$index]->VALUE);
                                $sl_temp_value[] = $percentage;
                            }
                        }
                    }
                }

                $total_fees_value = ((array_sum($sl_temp_value)) + (array_sum($fees_value)));

                $total_fees_value_con = $this->apartment_model->currency_convertor($total_fees_value, $Property->PROP_RATE_CURRENCY, CURR);


                $RentSubtotal = $RentSubtotal + $total_fees_value;
                

               $RentSubtotal = number_format($RentSubtotal, 2, '.', '');
                
                //Discounts 
                $last_minute_discounts = $this->apartment_model->get_last_minute_discounts($pid);
                $special_discounts = $this->apartment_model->get_special_discounts($pid, $custom_cin, $custom_cout);
                $early_bird_discounts = $this->apartment_model->get_early_bird_discounts($pid);
                $last_minute_discounts = $this->apartment_model->last_minute_discounts($pid);

                $today_date = date('Y-m-d');

                $total_days = (strtotime($custom_cin) - strtotime($today_date)) / (60 * 60 * 24);
                $discount_percentage = array();

                if (!empty($early_bird_discounts->EARLY_BIRD_DISCOUNT_DAYS)) {
                    if ($total_days >= $early_bird_discounts->EARLY_BIRD_DISCOUNT_DAYS) {
                        $discount_percentage[] = $early_bird_discounts->EARLY_BIRD_DISCOUNT_PERCENT;
                    }
                }

                if (!empty($last_minute_discounts)) {
                    foreach ($last_minute_discounts as $key => $value) {
                        $temp_last_minute_discounts[] = (array) $value;
                    }
                    usort($temp_last_minute_discounts, array('apartment', 'sortBySpdv'));

                    foreach ($temp_last_minute_discounts as $key => $value) {
                        if ($value['DISCOUNT_BEFORE_CHECKIN_DAYS'] <= $total_days) {
                            $discount_percentage[] = $value['DISCOUNT_PERCENTAGE'];
                            break;
                        }
                    }
                }

                if (!empty($special_discounts)) {
                    $discount_percentage[] = $this->apartment_model->get_special_discount_per($special_discounts, $custom_cin, $custom_cout);
                }

                $total_per = array_sum($discount_percentage);

                //If not empty of total percentage
                if (!empty($total_per)) {
                    //$amount_minus = ($RentSubtotal / $total_per);
                    $amount_minus = ($total_per / 100) * $RentSubtotal;
                    $RentSubtotal = ($RentSubtotal - $amount_minus);
                }
                
                $temp_num_for = number_format($RentSubtotal);
                

                if (empty($temp_num_for)) {
                    $data['reason_message'] = 'Those dates are not available';
                    goto label;
                }

                $RentSubtotal = $this->apartment_model->currency_convertor($RentSubtotal, $Property->PROP_RATE_CURRENCY, CURR);
                if($nights < 15){
                    $rangeType = 1;
                }else if($nights >= 15){
                    $rangeType = 2;
                }
                $service_charge = $this->apartment_model->get_service_charge('Kigo', $rangeType)->row(); 
                $s_charge = ($RentSubtotal/100) * $service_charge->service_charge;
                $RentFulltotal = $RentSubtotal + $s_charge;
                

                // $RentSubtotal = $this->flight_model->currency_convertor($RentSubtotal,$Property->PROP_RATE_CURRENCY,CURR);
                // $RentFulltotal = $this->flight_model->currency_convertor($RentFulltotal,$Property->PROP_RATE_CURRENCY,CURR);
				
				$data['service_charge_Sys'] = $s_charge;
                $s_charge = $this->account_model->currency_convertor(number_format($s_charge, 0, '.', ''));
                $data['service_charge'] = $s_charge;
                $data['status'] = 'Success';
                $data['available'] = true;
                $data['rentType'] = 'Per Night';
                $data['RentSubtotal'] = $this->account_model->currency_convertor(number_format($RentSubtotal, 0, '.', ''));
                $data['RentSubtotal_Sys'] = $RentSubtotal;
				
                $data['RentFulltotal'] = $this->account_model->currency_convertor(number_format($RentFulltotal, 0, '.', ''));               
                $data['price_per'] = $this->account_model->currency_convertor(number_format(($RentSubtotal / $nights), 0, '.', ''));
                $data['total_price_native'] = $this->account_model->currency_convertor($RentSubtotal);
                $data['total_price_default'] = $this->account_model->currency_convertor($RentSubtotal);
                $data['total_price'] = $this->account_model->currency_convertor(number_format($RentSubtotal, 0, '.', ''));
                $data['total_price_nor'] = number_format($RentFulltotal, 0, '.', '');
                if ($nights > 1) {
                    $data['nights'] = $nights . ' Nights';
                } else {
                    $data['nights'] = $nights . ' Night';
                }

                $data['can_instant_book'] = true;
                echo json_encode($data);
                die;
            } else {
                $weeks = $this->apartment_model->slice_weekly_rental($custom_cin, $custom_cout); //Slicing the checkin and checkout into weeks

                $chunks = $weeks['chunks'];                

                $count = 0;
                foreach ($chunks as $key => $value) {
                    $between_date_range = explode(',', $value);
                    //checking whether if any weekly rental is enabled and periods are there
                    $temp_count = $this->apartment_model->GetweeklyRental($pid, $between_date_range[0], $between_date_range[1])->num_rows();

                    if (!empty($temp_count)) {
                        $count++;
                    }

                    if ($temp_count > 0) {//if weekly periods are there getting periods
                        $temp = $this->apartment_model->GetweeklyRental($pid, $between_date_range[0], $between_date_range[1])->row();
                        $temp_periods[$temp->RENT_ID][] = $temp;
                    } else {//else creating one more array with rest of dates for nightly rental
                        $nightly_chunks[] = $value;
                    }
                }

                

                if ($count > 0) {
                    $periods = array();
                    $i = 0;
                    foreach ($temp_periods as $key => $value) {//Removing duplicate weekly periods
                        $periods[] = $value[0];
                        $periods[$i]->count = count($value);
                        $i++;
                    }

                    $period_checkin_day = strtolower(date('D', strtotime($periods[0]->CHECK_IN)));
                    $checkin_day = strtolower(date('D', strtotime($custom_cin)));

                    if ($checkin_day == $period_checkin_day) {//Checking whether checkin weekday and period weekday is same or not     
                       
                        foreach ($periods as $key => $Rent) {
                            $week_nights = $this->apartment_model->slice_weekly_rental($Rent->CHECK_IN, $Rent->CHECK_OUT);

                            $weekly_guest_from = explode(',', $Rent->WEEKY_GUEST_FROM);
                            $weekly_guest_amount = explode(',', $Rent->WEEKLY_AMOUNT);
                            $weekly_amount = array();

                            for ($i = 0; $i < count($weekly_guest_from); $i++) {
                                $weekly_amount[$weekly_guest_from[$i]] = $weekly_guest_amount[$i];
                            }

                            if ($Rent->PERGUEST_CHARGE_TYPE == 'ADULTS') {
                                $guests = $adult;
                            } else if ($Rent->PERGUEST_CHARGE_TYPE == 'ADULTS_CHILDREN') {
                                $guests = $adult + $child;
                            } else if ($Rent->PERGUEST_CHARGE_TYPE == 'ADULTS_CHILDREN_BABIES') {
                                $guests = $adult + $child + $infant;
                            }

                            $max_amount = end($weekly_amount);
                            $max_amount_key = end(array_keys($weekly_amount));

                            foreach ($weekly_amount as $key => $value) {
                                if ($guests == $key) {
                                    $weekly_main_amount_temp = (($value) * $Rent->count);
                                    $weekly_main_amount[] = $this->apartment_model->currency_convertor($weekly_main_amount_temp, $Rent->CURRENCY, CURR);
                                    break;
                                } elseif ($guests > $max_amount_key) {
                                    $weekly_main_amount_temp = (($max_amount) * $Rent->count);
                                    $weekly_main_amount[] = $this->apartment_model->currency_convertor($weekly_main_amount_temp, $Rent->CURRENCY, CURR);
                                    break;
                                }
                            }
                            $currency_code = $Rent->CURRENCY;
                        }

                        if (isset($weekly_main_amount) && !empty($weekly_main_amount)) {
                            $RentSubtotal = (array_sum($weekly_main_amount));
                        } else {
                            $RentSubtotal = "";
                        }

                        if (!empty($nightly_chunks)) {
                            foreach ($nightly_chunks as $key => $value) {
                                $dates = explode(',', $value);
                                $nightly_dates[] = $dates[0];
                                $nightly_dates[] = $dates[1];
                            }
                        }


                        if (!empty($weeks['night_dates'])) {
                            $night_dates = $weeks['night_dates'];
                        }

                        if (!empty($nightly_dates) && !empty($night_dates)) {
                            $checkin_custom_period_checkin = $nightly_dates[0];
                            $checkin_custom_period_checkout = end($night_dates);
                        } else if (!empty($nightly_dates) && empty($night_dates)) {
                            $checkin_custom_period_checkin = $nightly_dates[0];
                            $checkin_custom_period_checkout = end($nightly_dates);
                        } else if (empty($nightly_dates) && !empty($night_dates)) {
                            if (count($night_dates) > 1) {
                                $checkin_custom_period_checkin = $night_dates[1];
                                $checkin_custom_period_checkout = end($night_dates);
                            } else {
                                $date_raw = end($night_dates);
                                $checkin_custom_period_checkin = date('Y-m-d', strtotime('-1 day', strtotime(end($night_dates))));
                                $checkin_custom_period_checkout = end($night_dates);
                            }
                        }

                        if (isset($checkin_custom_period_checkin) && isset($checkin_custom_period_checkout)) {
                            $Nightlycount = $this->apartment_model->GetWeeklyAfternightlyRental($pid, $checkin_custom_period_checkin, $checkin_custom_period_checkout)->num_rows();
                            if ($Nightlycount > 0) {
                                $NightlyRent = $this->apartment_model->GetWeeklyAfternightlyRental($pid, $checkin_custom_period_checkin, $checkin_custom_period_checkout)->result();
                                foreach ($NightlyRent as $key => $value) {
                                    //$nightly_values[$value->CHECK_IN.','.$value->CHECK_OUT] = $this->apartment_model->GetNightlyRentalPeriods($value->NIGHTLY_RANDOM);
                                    $check_in[] = strtotime($value->CHECK_IN);
                                    $check_out[] = strtotime($value->CHECK_OUT);
                                }


                                $custom_cin_check = date('Y-m-d', min($check_in));
                                $custom_cout_check = date('Y-m-d', max($check_out));

                                $NightlyRent = $this->apartment_model->GetnightlyRental($pid, $custom_cin_check, $custom_cout_check);

                                foreach ($NightlyRent as $key => $value) {
                                    $temp_date = date('Y-m-d', strtotime('-1 day', strtotime($value->CHECK_OUT)));
                                    $nightly_values[$value->CHECK_IN . ',' . $temp_date] = $this->apartment_model->GetNightlyRentalPeriods($value->NIGHTLY_RANDOM);
                                }


                                $apartemnt_night_wise = $this->apartment_model->get_day_wise_chunks($custom_cin, $custom_cout);
                                $rent_sub_total = array();
                                foreach ($NightlyRent as $key => $value) {
                                    $start_date[] = strtotime($value->CHECK_IN);
                                    $end_date[] = strtotime($value->CHECK_OUT);
                                }

                                $min_start_date = date('Y-m-d', min($start_date));
                                $min_end_date = date('Y-m-d', min($end_date));

                                foreach ($nightly_values as $key => $value) {
                                    $explode_cin_cout_dates = explode(',', $key);

                                    //Check for Year
                                    $year_nights_module = round($nights / 365);
                                    if ($year_nights_module >= 1) {
                                        $d_n_module = $year_nights_module;
                                        $d_n_u_module = 'YEAR';
                                    }

                                    //Check for Months
                                    $month_nights_module = round(($nights * 12) / 365);
                                    if ($month_nights_module >= 1 && $month_nights_module < 12) {
                                        $d_n_module = $month_nights_module;
                                        $d_n_u_module = 'MONTH';
                                    }

                                    //Check for Nights
                                    $nights_module = $nights / 30;
                                    if ($nights_module < 1) {
                                        $d_n_module = $nights;
                                        $d_n_u_module = 'NIGHT';
                                    }


                                    if ($NightlyRent[0]->PERGUEST_CHARGE_TYPE == 'ADULTS') {
                                        $guests = $adult;
                                    } else if ($NightlyRent[0]->PERGUEST_CHARGE_TYPE == 'ADULTS_CHILDREN') {
                                        $guests = $adult + $child;
                                    } else if ($NightlyRent[0]->PERGUEST_CHARGE_TYPE == 'ADULTS_CHILDREN_BABIES') {
                                        $guests = $adult + $child + $infant;
                                    }


                                    foreach ($value as $sskey => $ssvalue) {
                                        foreach ($value as $k => $v) {
                                            if ($v->NIGHTLY_STAY_UNIT == 'NIGHT') {
                                                if ($v->NIGHTLY_STAY_NUMBER <= $d_n_module) {
                                                    $max_n[] = $v->NIGHTLY_STAY_NUMBER;
                                                    $max_g[] = $v->NIGHTLY_GUESTS_FROM;
                                                }
                                            } elseif ($v->NIGHTLY_STAY_UNIT == 'MONTH') {
                                                if ($v->NIGHTLY_STAY_NUMBER <= $d_n_module) {
                                                    $max_n[] = $v->NIGHTLY_STAY_NUMBER;
                                                    $max_g[] = $v->NIGHTLY_GUESTS_FROM;
                                                }
                                            } elseif ($v->NIGHTLY_STAY_UNIT == 'YEAR') {
                                                if ($v->NIGHTLY_STAY_NUMBER <= $d_n_module) {
                                                    $max_n[] = $v->NIGHTLY_STAY_NUMBER;
                                                    $max_g[] = $v->NIGHTLY_GUESTS_FROM;
                                                }
                                            }
                                        }
                                    }

                                    $stay_length = max($max_n);
                                    $guest_length = end($max_g);

                                    foreach ($apartemnt_night_wise as $skey => $svalue) {
                                        if ((strtotime($explode_cin_cout_dates[0]) <= strtotime($svalue)) && (strtotime($explode_cin_cout_dates[1]) >= strtotime($svalue))) {
                                            $week_days = date('N', strtotime($svalue));
                                            foreach ($value as $k => $v) {
                                                if ($v->NIGHTLY_STAY_UNIT == 'NIGHT' && $v->NIGHTLY_STAY_NUMBER == $stay_length && $d_n_u_module == 'NIGHT') {
                                                    $explode = explode(',', $v->WEEK_NIGHTS);

                                                    if (in_array($week_days, $explode)) {
                                                        if ($guests == $v->NIGHTLY_GUESTS_FROM) {
                                                            $rent_sub_total[] = ($v->NIGHTLY_AMOUNT);
                                                            break;
                                                        } elseif ($v->NIGHTLY_GUESTS_FROM == $guest_length) {
                                                            $rent_sub_total[] = ($v->NIGHTLY_AMOUNT);
                                                            break;
                                                        }
                                                    }
                                                }

                                                if ($v->NIGHTLY_STAY_UNIT == 'MONTH' && $v->NIGHTLY_STAY_NUMBER == $stay_length && $d_n_u_module == 'MONTH') {
                                                    $explode = explode(',', $v->WEEK_NIGHTS);
                                                    if (in_array($week_days, $explode)) {
                                                        if ($guests == $v->NIGHTLY_GUESTS_FROM) {
                                                            $rent_sub_total[] = ($v->NIGHTLY_AMOUNT);
                                                            break;
                                                        } elseif ($v->NIGHTLY_GUESTS_FROM == $guest_length) {
                                                            $rent_sub_total[] = ($v->NIGHTLY_AMOUNT);
                                                            break;
                                                        }
                                                    }
                                                }

                                                if ($v->NIGHTLY_STAY_UNIT == 'YEAR' && $v->NIGHTLY_STAY_NUMBER == $stay_length && $d_n_u_module == 'YEAR') {
                                                    $explode = explode(',', $v->WEEK_NIGHTS);
                                                    if (in_array($week_days, $explode)) {
                                                        if ($guests == $v->NIGHTLY_GUESTS_FROM) {
                                                            $rent_sub_total[] = ($v->NIGHTLY_AMOUNT);
                                                            break;
                                                        } elseif ($v->NIGHTLY_GUESTS_FROM == $guest_length) {
                                                            $rent_sub_total[] = ($v->NIGHTLY_AMOUNT);
                                                            break;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                $RentSubtotal = $RentSubtotal + array_sum($rent_sub_total);
                            } else {
                                $data['reason_message'] = 'Those dates are not available';
                                goto label;
                            }
                        }
                        //echo '<pre>';print_r($night_dates);
                        // Get Include in fees rents
                        $fees_apartment = $this->apartment_model->GetAllFees($pid)->result();
                        $fees_value = array();
                        $sl_temp_value = array();

                        $check_in_day = strtolower(date('D', strtotime($custom_cin)));
                        $check_out_day = strtolower(date('D', strtotime($custom_cout)));

                        if (!empty($fees_apartment)) {
                            for ($i = 0; $i < count($fees_apartment); $i++) {

                                if ($check_in_day != 'sat' || $check_in_day != 'sun') {
                                    if (isset($fees_apartment[$i]) && !empty($fees_apartment[$i])) {
                                        if ($fees_apartment[$i]->FEE_TYPE_LABEL == 'Check-in fees (weekend)' || $fees_apartment[$i]->FEE_TYPE_LABEL == 'Check-out fees (weekend)') {
                                            unset($fees_apartment[$i]);
                                        }
                                    }
                                }

                                if ($check_out_day == 'sat' || $check_out_day == 'sun') {
                                    if (isset($fees_apartment[$i]) && !empty($fees_apartment[$i])) {
                                        if ($fees_apartment[$i]->FEE_TYPE_LABEL == 'Check-out fees (weekday)' || $fees_apartment[$i]->FEE_TYPE_LABEL == 'Check-in fees (weekday)') {
                                            unset($fees_apartment[$i]);
                                        }
                                    }
                                }
                            }
                        }

                        if (!empty($fees_apartment)) {
                            foreach ($fees_apartment as $key => $value) {

                                if ($value->UNIT == 'AMOUNT') {
                                    $temp = json_decode($value->VALUE);
                                    $fees_value[] = $temp;
                                } elseif ($value->UNIT == 'PERCENT_RENT') {
                                    $temp = json_decode($value->VALUE);
                                    $percentage = ($RentSubtotal / $temp);
                                    $fees_value[] = $percentage;
                                } elseif ($value->UNIT == 'AMOUNT_PER_GUEST') {

                                    $temp = json_decode($value->VALUE);
                                    $temp_value = array();
                                    if (!empty($adult)) {
                                        $temp_value[] = (($adult) * ($temp->AMOUNT_ADULT));
                                    }
                                    if (!empty($child)) {
                                        $temp_value[] = (($child) * ($temp->AMOUNT_CHILD));
                                    }
                                    if (!empty($infant)) {
                                        $temp_value[] = (($infant) * ($temp->AMOUNT_BABY));
                                    }

                                    $fees_value[] = array_sum($temp_value);
                                } elseif ($value->UNIT == 'AMOUNT_PER_NIGHT_PER_GUEST') {
                                    $temp = json_decode($value->VALUE);
                                    $temp_value = array();

                                    if (!empty($adult)) {
                                        $temp_value[] = ($nights) * (($adult) * ($temp->AMOUNT_ADULT));
                                    }
                                    if (!empty($child)) {
                                        $temp_value[] = ($nights) * (($child) * ($temp->AMOUNT_CHILD));
                                    }
                                    if (!empty($infant)) {
                                        $temp_value[] = ($nights) * (($infant) * ($temp->AMOUNT_BABY));
                                    }

                                    $fees_value[] = array_sum($temp_value);
                                } elseif ($value->UNIT == 'AMOUNT_PER_NIGHT') {
                                    $temp = json_decode($value->VALUE);
                                    $fees_value[] = ($temp * $nights);
                                } elseif ($value->UNIT == 'STAYLENGTH') {
                                    $temp = json_decode($value->VALUE);
                                    if ($nights <= 6) {
                                        if ($temp[0]->STAY_FROM->UNIT == 'NIGHT' && $temp[0]->STAY_FROM->NUMBER == '1') {
                                            $index = 0;
                                        } elseif ($temp[1]->STAY_FROM->UNIT == 'NIGHT' && $temp[1]->STAY_FROM->NUMBER == '1') {
                                            $index = 1;
                                        }
                                    }

                                    if ($nights >= 7) {
                                        if ($temp[1]->STAY_FROM->UNIT == 'NIGHT' && $temp[1]->STAY_FROM->NUMBER == '7') {
                                            $index = 1;
                                        } elseif ($temp[0]->STAY_FROM->UNIT == 'NIGHT' && $temp[0]->STAY_FROM->NUMBER == '7') {
                                            $index = 0;
                                        }
                                    }


                                    if ($temp[$index]->UNIT == 'AMOUNT_PER_NIGHT_PER_GUEST') {
                                        $temp_value_2 = array();
                                        if (!empty($adult)) {
                                            $temp_value_2[] = ($nights) * (($adult) * ($temp[$index]->VALUE->AMOUNT_ADULT));
                                        }
                                        if (!empty($child)) {
                                            $temp_value_2[] = ($nights) * (($child) * ($temp[$index]->VALUE->AMOUNT_CHILD));
                                        }
                                        if (!empty($infant)) {
                                            $temp_value_2[] = ($nights) * (($infant) * ($temp[$index]->VALUE->AMOUNT_BABY));
                                        }
                                        $sl_temp_value[] = array_sum($temp_value_2);
                                    } elseif ($temp[$index]->UNIT == 'AMOUNT_PER_GUEST') {
                                        $temp_value_2 = array();
                                        if (!empty($adult)) {
                                            $temp_value_2[] = (($adult) * ($temp[$index]->VALUE->AMOUNT_ADULT));
                                        }
                                        if (!empty($child)) {
                                            $temp_value_2[] = (($child) * ($temp[$index]->VALUE->AMOUNT_CHILD));
                                        }
                                        if (!empty($infant)) {
                                            $temp_value_2[] = (($infant) * ($temp[$index]->VALUE->AMOUNT_BABY));
                                        }

                                        $sl_temp_value[] = array_sum($temp_value_2);
                                    } elseif ($temp[$index]->UNIT == 'AMOUNT') {
                                        $sl_temp_value[] = ($temp[$index]->VALUE);
                                    } elseif ($temp[$index]->UNIT == 'PERCENT_RENT') {
                                        $percentage = ($RentSubtotal / $temp[$index]->VALUE);
                                        $sl_temp_value[] = $percentage;
                                    }
                                }
                            }
                        }

                        $total_fees_value = ((array_sum($sl_temp_value)) + (array_sum($fees_value)));

                        $total_fees_value_con = $this->apartment_model->currency_convertor($total_fees_value, $currency_code, CURR);

                        $RentSubtotal = $RentSubtotal + $total_fees_value;

                        $RentSubtotal = number_format($RentSubtotal, 2, '.', '');



                        //Discounts 
                        $last_minute_discounts = $this->apartment_model->get_last_minute_discounts($pid);
                        $special_discounts = $this->apartment_model->get_special_discounts($pid, $custom_cin, $custom_cout);
                        $early_bird_discounts = $this->apartment_model->get_early_bird_discounts($pid);
                        $last_minute_discounts = $this->apartment_model->last_minute_discounts($pid);

                        $today_date = date('Y-m-d');

                        $total_days = (strtotime($custom_cin) - strtotime($today_date)) / (60 * 60 * 24);
                        $discount_percentage = array();

                        if (!empty($early_bird_discounts->EARLY_BIRD_DISCOUNT_DAYS)) {
                            if ($total_days >= $early_bird_discounts->EARLY_BIRD_DISCOUNT_DAYS) {
                                $discount_percentage[] = $early_bird_discounts->EARLY_BIRD_DISCOUNT_PERCENT;
                            }
                        }

                        if (!empty($last_minute_discounts)) {
                            foreach ($last_minute_discounts as $key => $value) {
                                $temp_last_minute_discounts[] = (array) $value;
                            }
                            usort($temp_last_minute_discounts, array('apartment', 'sortBySpdv'));

                            foreach ($temp_last_minute_discounts as $key => $value) {
                                if ($value['DISCOUNT_BEFORE_CHECKIN_DAYS'] <= $total_days) {
                                    $discount_percentage[] = $value['DISCOUNT_PERCENTAGE'];
                                    break;
                                }
                            }
                        }

                        if (!empty($special_discounts)) {
                            $discount_percentage[] = $this->apartment_model->get_special_discount_per($special_discounts, $custom_cin, $custom_cout);
                        }

                        $total_per = array_sum($discount_percentage);

                        //If not empty of total percentage
                        if (!empty($total_per)) {
                            $amount_minus = ($RentSubtotal / $total_per);
                            $RentSubtotal = ($RentSubtotal - $amount_minus);
                        }

                        $RentSubtotal = $this->apartment_model->currency_convertor($RentSubtotal, $Property->PROP_RATE_CURRENCY, CURR);
                if($nights < 15){
                    $rangeType = 1;
                }else if($nights >= 15){
                    $rangeType = 2;
                }
                $service_charge = $this->apartment_model->get_service_charge('Kigo', $rangeType)->row(); 
                $s_charge = ($RentSubtotal/100) * $service_charge->service_charge;
                $RentFulltotal = $RentSubtotal + $s_charge;
                

                // $RentSubtotal = $this->flight_model->currency_convertor($RentSubtotal,$Property->PROP_RATE_CURRENCY,CURR);
                // $RentFulltotal = $this->flight_model->currency_convertor($RentFulltotal,$Property->PROP_RATE_CURRENCY,CURR);
				$data['service_charge_Sys'] = $s_charge;
                $s_charge = $this->account_model->currency_convertor(number_format($s_charge, 0, '.', ''));
                        $data['service_charge'] = $s_charge;
                        $data['status'] = 'Success';
                        $data['available'] = true;
                        $data['rentType'] = 'Per Night';
                        $data['RentSubtotal'] = $this->account_model->currency_convertor(number_format($RentSubtotal, 0, '.', ''));
                        $data['RentFulltotal'] = $this->account_model->currency_convertor(number_format($RentFulltotal, 0, '.', ''));
						$data['RentSubtotal_Sys'] = $RentSubtotal;
				
                        //$data['price_per_night_native'] = $price_per_night_native;
                        //$data['price_per_night_default'] = $price_per_night_default;
                        $data['price_per'] = $this->account_model->currency_convertor(number_format(($RentSubtotal / $nights), 0, '.', ''));
                        $data['total_price_native'] = $this->account_model->currency_convertor(number_format($RentSubtotal, 0, '.', ''));
                        $data['total_price_default'] = $this->account_model->currency_convertor(number_format($RentSubtotal, 0, '.', ''));
                        $data['total_price'] = $this->account_model->currency_convertor(number_format($RentSubtotal, 0, '.', ''));
                        $data['total_price_nor'] = number_format($RentFulltotal, 0, '.', '');
                        if ($nights > 1) {
                            $data['nights'] = $nights . ' Nights';
                        } else {
                            $data['nights'] = $nights . ' Night';
                        }

                        $data['can_instant_book'] = true;
                    } else {
                        //$data['reason_message'] = 'From '.date('D, d M Y',strtotime($Rent->CHECK_IN)).' to '.date('D, d M Y',strtotime($Rent->CHECK_OUT)).', only '.$period_checkin_day.'-to-'.$period_checkin_day.' weekly rentals are allowed.';                            
                        $data['reason_message'] = 'From ' . date('D, d M Y', strtotime($periods[0]->CHECK_IN)) . ' to ' . date('D, d M Y', strtotime($periods[0]->CHECK_OUT)) . ', only ' . $period_checkin_day . '-to-' . $period_checkin_day . ' weekly rentals are allowed.';
                    }
                } else {
                    $data['reason_message'] = 'These dates are not available';
                }
            }
        }

        label:
        echo json_encode($data);
    }

    function sortBySpdv($x, $y) {
        return $x['DISCOUNT_BEFORE_CHECKIN_DAYS'] - $y['DISCOUNT_BEFORE_CHECKIN_DAYS'];
    }

    public function book_it() {
        //$this->islogged_in();
        $checkin = $this->input->get('checkin');
        $checkout = $this->input->get('checkout');
        $nights = $this->input->get('nights');
        $adult = $this->input->get('adult');
        $child = $this->input->get('child');
        $infant = $this->input->get('infant');
        $pid = $this->input->get('pid');
        $rent = $this->input->get('rent');
        $instatnt = $this->input->get('instatnt');
        $curr = CURR;
        $total = $this->input->get('total');
        if ($this->session->userdata('b2c_id')) {
            $user_type = 3;
            $user_id = $this->session->userdata('b2c_id');
        } else if ($this->session->userdata('b2b_id')) {
            $user_type = 2;
            $user_id = $this->session->userdata('b2b_id');
        } else {
            $user_type = '';
            $user_id = '';
        }
        $ex_cin = explode('-', $checkin);
        $ex_cout = explode('-', $checkout);

        $checkin = $ex_cin[2] . '-' . $ex_cin[1] . '-' . $ex_cin[0];
        $checkout = $ex_cout[2] . '-' . $ex_cout[1] . '-' . $ex_cout[0];

        $Property = $this->apartment_model->getApartmentDetails($pid)->row();
        $Images = $this->apartment_model->getApartmentImages($pid)->row();
        $cart_apartment = array(
            'PROP_ID' => $pid,
            'PROP_NAME' => $Property->PROP_NAME,
            'PROP_STREETNO' => $Property->PROP_STREETNO,
            'PROP_ADDR1' => $Property->PROP_ADDR1,
            'PROP_ADDR2' => $Property->PROP_ADDR2,
            'PROP_AUTOCOMPLETE_ADDRESS' => $Property->AUTOCOMPLETE_ADDRESS,
            'PROP_APTNO' => $Property->PROP_APTNO,
            'PROP_POSTCODE' => $Property->PROP_POSTCODE,
            'PROP_CITY' => $Property->PROP_CITY,
            'PROP_REGION' => $Property->PROP_REGION,
            'PROP_COUNTRY' => $Property->PROP_COUNTRY,
            'PROP_COUNTRY_NAME' => $Property->COUNTRY_NAME,
            'PROP_LATITUDE' => $Property->PROP_LATITUDE,
            'PROP_LONGITUDE' => $Property->PROP_LONGITUDE,
            'PROP_TYPE_LABEL' => $Property->PROP_TYPE_LABEL,
            'PROP_CIN_TIME' => $Property->PROP_CIN_TIME,
            'PROP_COUT_TIME' => $Property->PROP_COUT_TIME,
            'PROP_INSTANT_BOOK' => $Property->PROP_INSTANT_BOOK,
            'PROP_SHORTDESCRIPTION' => $Property->PROP_SHORTDESCRIPTION,
            'PROP_AREADESCRIPTION' => $Property->PROP_AREADESCRIPTION,
            'PROP_RENTAL_DETAILS' => $Property->PROP_RENTAL_DETAILS,
            'PROP_ARRIVAL_SHEET' => $Property->PROP_ARRIVAL_SHEET,
            'PROP_RATE_CURRENCY' => $Property->PROP_RATE_CURRENCY,
            'PROP_CANCELLATION_TYPE' => $Property->can_type,
            'PROP_CANCELLATION_DESC' => $Property->desc,
            'PROP_PHOTO' => $Images->PHOTO_CONTENT,
            'PROP_USER_TYPE' => $Property->USER_TYPE,
            'PROP_USER_ID' => $Property->USER_ID,
            'USER_TYPE' => $user_type,
            'USER_ID' => $user_id,
            'RES_CHECK_IN' => $checkin,
            'RES_CHECK_OUT' => $checkout,
            'NIGHTS' => $nights,
            'RES_N_ADULTS' => $adult,
            'RES_N_CHILDREN' => $child,
            'RES_N_BABIES' => $infant,
            'SITE_CURR' => $curr,
            'TOTAL' => $total,
            'RENT_DATA' => $rent,
            'TIMESTAMP' => date('Y-m-d H:i:s')
        );

        $booking_cart_id = $this->apartment_model->insert_cart_apartment($cart_apartment);
        $session_id = $this->session->userdata('session_id');
        $cart_global = array(
            'parent_cart_id' => 0,
            'ref_id' => $booking_cart_id,
            'module' => 'APARTMENT',
            'prop_id' => $pid,
            'user_type' => $user_type,
            'user_id' => $user_id,
            'session_id' => $session_id,
            'site_curr' => $curr,
            'total' => $total,
            'rent_data' => $rent,
            'ip' => $this->input->ip_address(),
            'timestamp' => date('Y-m-d H:i:s')
        );
        $cart_global_id = $this->apartment_model->insert_cart_global($cart_global);
        $data['status'] = 1;
        $cart_data = $this->cart_model->getCartData($session_id)->result();
        $data['count'] = count($cart_data);
        if (count($cart_data) > 0) {
            $data['isCart'] = true;
        } else {
            $data['isCart'] = false;
        }
        if (!empty($cart_data)) {
            $data['C_URL'] = WEB_URL . '/booking/' . $session_id;
            foreach ($cart_data as $key => $cartt) {
                if ($cartt->module == 'APARTMENT') {
                    $cart = $this->cart_model->getCartDataByModule($cartt->cart_id, $cartt->module)->row();
                    $data['cart'][] = array(
                        'RID' => $session_id . 'cart' . $key,
                        'CID' => $cart->cart_id,
                        'REF_ID' => $cart->ref_id,
                        'TYPE' => 'apartmentcart',
                        'NAME' => $cart->PROP_NAME,
                        'URL' => WEB_URL . '/rooms/' . $cart->PROP_ID,
                        'ADDRESS' => $cart->PROP_ADDR1 . ', ' . $cart->PROP_CITY . ', ' . $cart->PROP_REGION . ', ' . $cart->PROP_COUNTRY_NAME,
                        'TOTAL' => $this->account_model->currency_convertor($cart->TOTAL),
                        'IMAGE' => $this->apartment_model->view_property_file($cart->PROP_PHOTO)
                    );
                    $GRAND_TOTAL[] = $cart->TOTAL;
                } else if ($cartt->module == 'FLIGHT') {
                    $cart = $this->cart_model->getCartDataByModule($cartt->cart_id, $cartt->module)->row();
                    $request = json_decode(base64_decode($cart->request));
                    if ($request->type == 'O' || $request->type == 'R') {
                        $originCity = $this->flight_model->get_airport_cityname($request->origin);
                        $destinationCity = $this->flight_model->get_airport_cityname($request->destination);
                        $origin = $request->origin;
                        $destination = $request->destination;
                    } else if ($request->type == 'M') {
                        //echo '<pre>';print_r($request);die;
                        $origin = reset($request->origin);
                        $destination = end($request->destination);
                        $originCity = $this->flight_model->get_airport_cityname($origin);
                        $destinationCity = $this->flight_model->get_airport_cityname($destination);
                    }

                    $data['cart'][] = array(
                        'RID' => $session_id . 'cart' . $key,
                        'CID' => $cart->cart_id,
                        'REF_ID' => $cart->ref_id,
                        'TYPE' => 'flightcart',
                        'NAME' => $originCity . ' (' . $origin . ') - ' . $destinationCity . ' (' . $destination . ')',
                        'URL' => WEB_URL,
                        'ADDRESS' => date('d M, Y H:i', $cart->DepartureTime) . ' - ' . date('d M, Y H:i', $cart->ArrivalTime),
                        'TOTAL' => $this->account_model->currency_convertor($cart->TotalPrice),
                        'IMAGE' => $cart->AirImage
                    );
                    $GRAND_TOTAL[] = $cart->TotalPrice;
                } else if ($cartt->module == 'HOTEL') {
                    $cart = $this->cart_model->getCartDataByModule($cartt->cart_id, $cartt->module)->row();
                    $data['cart'][] = array(
                        'RID' => $session_id . 'cart' . $key,
                        'CID' => $cart->cart_id,
                        'REF_ID' => $cart->ref_id,
                        'TYPE' => 'hotelcart',
                        'NAME' => $cart->hotel_name . ' (' . $cart->room_name . ')',
                        'URL' => WEB_URL,
                        'ADDRESS' => $cart->city,
                        'TOTAL' => $this->account_model->currency_convertor($cart->total_cost),
                        'IMAGE' => $cart->imageurl
                    );
                    $GRAND_TOTAL[] = $cart->total_cost;
                } else if ($cartt->module == 'CAR') {
                    $cart = $this->cart_model->getCartDataByModule($cartt->cart_id, $cartt->module)->row();
                    //$request = json_decode(base64_decode($cart->request));
                    $data['cart'][] = array(
                        'RID' => $session_id . 'cart' . $key,
                        'CID' => $cart->cart_id,
                        'REF_ID' => $cart->ref_id,
                        'TYPE' => 'carcart',
                        'NAME' => $cart->pickupCityName . ' (' . $cart->Pickup . ') - ' . $cart->dropoffCityName . ' (' . $cart->Dropoff . ')',
                        'URL' => WEB_URL,
                        'ADDRESS' => date('d M, Y H:i', $cart->DepartureTime) . ' - ' . date('d M, Y H:i', $cart->ReturnTime),
                        'TOTAL' => $this->account_model->currency_convertor($cart->TotalPrice),
                        'IMAGE' => $cart->CarImage
                    );
                    $GRAND_TOTAL[] = $cart->TotalPrice;
                } else if ($cartt->module == 'VACATION') {
                    $cart = $this->cart_model->getCartDataByModule($cartt->cart_id, $cartt->module)->row();
                    $vacation = json_decode(base64_decode($cart->response));
                    $data['cart'][] = array(
                        'RID' => $session_id . 'cart' . $key,
                        'CID' => $cart->cart_id,
                        'REF_ID' => $cart->ref_id,
                        'TYPE' => 'vacationcart',
                        'NAME' => $cart->vacCityName . ' (' . $cart->city . ') - ' . date('d M, Y H:i', strtotime($cart->vacDate)),
                        'URL' => WEB_URL,
                        'ADDRESS' => $vacation->package_name . ' - ' . $vacation->package_type,
                        'TOTAL' => $this->account_model->currency_convertor($cart->TotalPrice),
                        'IMAGE' => $cart->VacationImage
                    );
                    $GRAND_TOTAL[] = $cart->TotalPrice;
                }
            }
            $data['GRAND_TOTAL'] = $this->account_model->currency_convertor(array_sum($GRAND_TOTAL));
        }

        //echo '<pre>';print_r($data);
        echo json_encode($data);
        //echo json_encode($data);
        //redirect(WEB_URL.'/apartment/book/'.$cart_global_id);
    }

    public function book($cart_global_id = '') {
        $this->islogged_in();
        if ($cart_global_id == '') {
             $this->load->view('errors/404');
        } else {
            $count = $this->apartment_model->getBookingTemp($cart_global_id)->num_rows();
            if ($count == 1) {
                $data['countries'] = $this->apartment_model->getAllKigoCountries()->result();
                $data['book_temp_data'] = $book_temp_data = $this->apartment_model->getBookingTemp($cart_global_id)->row();
                $data['guests'] = $book_temp_data->RES_N_ADULTS + $book_temp_data->RES_N_CHILDREN + $book_temp_data->RES_N_BABIES;
                $data['RentData'] = json_decode($book_temp_data->RENT_DATA);
                $data['cart_global_id'] = $cart_global_id;
                $b2c_id = $this->session->userdata('b2c_id');
                $data['userInfo'] = $this->account_model->getUserInfo($b2c_id)->row();
                
                if(isset($data['book_temp_data']->profile_photo)) {
                    if($data['book_temp_data']->profile_photo == '') {
                        $data['profile_photo'] = ASSETS . 'images/user-avatar.jpg';
                    } else {
                        $data['profile_photo'] = $data['book_temp_data']->profile_photo;
                    }
                } else if(isset($data['book_temp_data']->agent_logo)) {
                    if($data['book_temp_data']->agent_logo == '') {
                        $data['profile_photo'] = ASSETS . 'images/user-avatar.jpg';
                    } else {
                        $data['profile_photo'] = $data['book_temp_data']->agent_logo;
                    }
                } else {
                    $data['profile_photo'] = ASSETS . 'images/user-avatar.jpg';
                }

               /* if ($data['book_temp_data']->profile_photo == '') {
                    $data['profile_photo'] = ASSETS . 'images/user-avatar.jpg';
                } else {
                    $data['profile_photo'] = $data['book_temp_data']->profile_photo;
                }*/

                $this->load->view('apartment/booking', $data);
            } else {
                 $this->load->view('errors/404');
            }
        }
    }

    public function checkout() {
        $checkout_form = $this->input->post();
        //print_r($checkout_form);
        $cart_apartment_data = $this->apartment_model->getBookingTemp($checkout_form['cid'])->row();
        $booking_apartment = array(
            'PROP_ID' => $cart_apartment_data->PROP_ID,
            'PROP_NAME' => $cart_apartment_data->PROP_NAME,
            'PROP_STREETNO' => $cart_apartment_data->PROP_STREETNO,
            'PROP_ADDR1' => $cart_apartment_data->PROP_ADDR1,
            'PROP_ADDR2' => $cart_apartment_data->PROP_ADDR2,
            'PROP_AUTOCOMPLETE_ADDRESS' => $cart_apartment_data->PROP_AUTOCOMPLETE_ADDRESS,
            'PROP_APTNO' => $cart_apartment_data->PROP_APTNO,
            'PROP_POSTCODE' => $cart_apartment_data->PROP_POSTCODE,
            'PROP_CITY' => $cart_apartment_data->PROP_CITY,
            'PROP_REGION' => $cart_apartment_data->PROP_REGION,
            'PROP_COUNTRY' => $cart_apartment_data->PROP_COUNTRY,
            'PROP_COUNTRY_NAME' => $cart_apartment_data->PROP_COUNTRY_NAME,
            'PROP_LATITUDE' => $cart_apartment_data->PROP_LATITUDE,
            'PROP_LONGITUDE' => $cart_apartment_data->PROP_LONGITUDE,
            'PROP_TYPE_LABEL' => $cart_apartment_data->PROP_TYPE_LABEL,
            'PROP_CIN_TIME' => $cart_apartment_data->PROP_CIN_TIME,
            'PROP_COUT_TIME' => $cart_apartment_data->PROP_COUT_TIME,
            'PROP_INSTANT_BOOK' => $cart_apartment_data->PROP_INSTANT_BOOK,
            'PROP_SHORTDESCRIPTION' => $cart_apartment_data->PROP_SHORTDESCRIPTION,
            'PROP_AREADESCRIPTION' => $cart_apartment_data->PROP_AREADESCRIPTION,
            'PROP_RENTAL_DETAILS' => $cart_apartment_data->PROP_RENTAL_DETAILS,
            'PROP_ARRIVAL_SHEET' => $cart_apartment_data->PROP_ARRIVAL_SHEET,
            'PROP_RATE_CURRENCY' => $cart_apartment_data->PROP_RATE_CURRENCY,
            'PROP_PHOTO' => $cart_apartment_data->PROP_PHOTO,
            'PROP_USER_TYPE' => $cart_apartment_data->PROP_USER_TYPE,
            'PROP_USER_ID' => $cart_apartment_data->PROP_USER_ID,
            'USER_TYPE' => $cart_apartment_data->USER_TYPE,
            'USER_ID' => $cart_apartment_data->USER_ID,
            'RES_CHECK_IN' => $cart_apartment_data->RES_CHECK_IN,
            'RES_CHECK_OUT' => $cart_apartment_data->RES_CHECK_OUT,
            'NIGHTS' => $cart_apartment_data->NIGHTS,
            'RES_N_ADULTS' => $cart_apartment_data->RES_N_ADULTS,
            'RES_N_CHILDREN' => $cart_apartment_data->RES_N_CHILDREN,
            'RES_N_BABIES' => $cart_apartment_data->RES_N_BABIES,
            'RES_GUEST_FIRSTNAME' => $checkout_form['first_name'],
            'RES_GUEST_LASTNAME' => $checkout_form['last_name'],
            'RES_GUEST_EMAIL' => $checkout_form['email'],
            'RES_GUEST_PHONE' => $checkout_form['mobile'],
            'RES_COMMENT_GUEST' => $checkout_form['msg_to_host'],
            'RES_GUEST_COUNTRY' => $checkout_form['country'],
            'RES_GUEST_ADDRESS' => $checkout_form['street_address'] . ', ' . $checkout_form['address2'],
            'RES_GUEST_CITY' => $checkout_form['city'],
            'RES_GUEST_STATE' => $checkout_form['state'],
            'RES_GUEST_ZIP' => $checkout_form['zip'],
            'SITE_CURR' => $cart_apartment_data->SITE_CURR,
            'TOTAL' => $cart_apartment_data->TOTAL,
            'RENT_DATA' => $cart_apartment_data->RENT_DATA,
            'TIMESTAMP' => date('Y-m-d H:i:s')
        );
        $booking_apartment_id = $this->apartment_model->insert_booking_apartment($booking_apartment);
        $this->apartment_model->clearCart($checkout_form['cid']);
        $data['status'] = 1;
        $data['voucher_url'] = WEB_URL . '/apartment/booking/' . $booking_apartment_id;
        echo json_encode($data);
    }

    public function booking($booking_apartment_id) {
        $count = $this->apartment_model->getBookingApartmentTemp($booking_apartment_id)->num_rows();
        if ($count == 1) {
            $count = $this->apartment_model->CheckDuplicateBooking($booking_apartment_id)->num_rows();
            if ($count == 0) {
                $book_temp_data = $this->apartment_model->getBookingApartmentTemp($booking_apartment_id)->row();
                if ($book_temp_data->PROP_INSTANT_BOOK == '1') {
                    $bStatus = 'CONFIRMED';
                    $aStatus = 'CONFIRMED';
                } else {
                    $bStatus = 'PENDING';
                    $aStatus = 'HOLD';
                }

                $booking = array(
                    'module' => 'APARTMENT',
                    'ref_id' => $booking_apartment_id,
                    'user_type' => $book_temp_data->USER_TYPE,
                    'amount' => $book_temp_data->TOTAL,
                    'leadpax' => $book_temp_data->RES_GUEST_FIRSTNAME . ' ' . $book_temp_data->RES_GUEST_LASTNAME,
                    'user_id' => $book_temp_data->USER_ID,
                    'ip' => $this->input->ip_address(),
                    'api_status' => $aStatus,
                    'booking_status' => $bStatus
                );
                $bid = $this->apartment_model->Booking_Global($booking);
                $pnr_no = 'IG00APT000' . $bid;
                $update_booking = array(
                    'pnr_no' => $pnr_no,
                    'booking_no' => 'XXXXXXXXXX'
                );
                $this->apartment_model->Update_Booking_Global($booking_apartment_id, $update_booking);
                if ($book_temp_data->PROP_INSTANT_BOOK == '1') {
                    $this->get_mail_content_apartmentVoucher($pnr_no);
                } else {
                    $this->get_mail_content_apartmentNonInstantVoucher($pnr_no);
                    $host_data = $this->account_model->GetUserData($book_temp_data->PROP_USER_TYPE, $book_temp_data->PROP_USER_ID)->row();
                    $message_id = $this->generate_random_key(10);
                    $message = 'Please accept the request of guest ' . $host_data->firstname . ' to confirm the reservation #' . $pnr_no . ', or decline to cancel reservation';
                    $inbox_data = array(
                        'message_id' => $message_id,
                        'msg_type' => '2',
                        'booking_id' => $pnr_no,
                        'sender_id' => $book_temp_data->USER_ID,
                        'receiver_id' => $book_temp_data->PROP_USER_ID,
                        'init_user_id' => $book_temp_data->USER_ID,
                        'init_receiver_id' => $book_temp_data->PROP_USER_ID,
                        'message' => $message,
                        'msg_date_time' => date('Y-m-d H:i:s')
                    );
                    $this->Message_Model->insertMessage($inbox_data);
                }

                redirect(WEB_URL . '/apartment/confirm/' . $pnr_no);
            } else {
                 $this->load->view('errors/404');
            }
        } else {
             $this->load->view('errors/404');
        }
    }

    public function ChangeBookingStatus() {
        $booking_id = $this->input->post('booking_id');
        $booking_status = $this->input->post('booking_status');
        if ($booking_status == '1') {
            $bStatus = 'CONFIRMED';
            $aStatus = 'CONFIRMED';
        } else {
            $bStatus = 'PENDING';
            $aStatus = 'HOLD';
        }
        $update_booking = array(
            'api_status' => $aStatus,
            'booking_status' => $bStatus
        );
        $this->apartment_model->Update_Booking_GlobalStatus($booking_id, $update_booking);
        if ($booking_status == '1') {
            $this->get_mail_content_apartmentVoucher($booking_id);
        } else {
            
        }
        $response = array('status' => 1);
        echo json_encode($response);
    }

    public function generate_random_key($length = 50) {
        $alphabets = range('A', 'Z');
        $numbers = range('0', '9');
        $final_array = array_merge($alphabets, $numbers);
        $id = '';
        while ($length--) {
            $key = array_rand($final_array);
            $id .= $final_array[$key];
        }
        return $id;
    }

    public function get_mail_content_apartmentVoucher($pnr_no) {
        $data['Booking'] = $Booking = $this->booking_model->getBooking($pnr_no)->row();
        $data['email_access'] = $this->email_model->get_email_acess()->row();
        $email_type = 'ApartmentVoucher';
        $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
		 $data['voucher_details'] = $booking = $this->booking_model->getBookingvoucherinvoicedetails()->row();
        $data['email'] = $Booking->RES_GUEST_EMAIL;
        $data['host_data'] = $this->account_model->GetUserData($Booking->PROP_USER_TYPE, $Booking->PROP_USER_ID)->row();
        $data['Map'] = $this->getStaticMap($data['Booking']->PROP_LATITUDE, $data['Booking']->PROP_LONGITUDE);
        $data['social_url'] = array(
            'facebook_social_url' => 'https://www.facebook.com',
            'twitter_social_url' => 'https://twitter.com',
            'google_social_url' => 'https://google.com',
        );
        $Response = $this->email_model->sendmail_apartmentVoucher($data);
        $this->get_mail_content_apartmentInvoice($pnr_no);
        //return $Response;
    }
 public function get_mail_content_apartmentVoucher_only($pnr_no) {
	 
        $data['Booking'] = $Booking = $this->booking_model->getBooking($pnr_no)->row();
        $data['email_access'] = $this->email_model->get_email_acess()->row();
        $email_type = 'ApartmentVoucher';
        $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
		 $data['voucher_details'] = $booking = $this->booking_model->getBookingvoucherinvoicedetails()->row();
        $data['email'] = $Booking->RES_GUEST_EMAIL;
        $data['host_data'] = $this->account_model->GetUserData($Booking->PROP_USER_TYPE, $Booking->PROP_USER_ID)->row();
        $data['Map'] = $this->getStaticMap($data['Booking']->PROP_LATITUDE, $data['Booking']->PROP_LONGITUDE);
        $data['social_url'] = array(
            'facebook_social_url' => 'https://www.facebook.com',
            'twitter_social_url' => 'https://twitter.com',
            'google_social_url' => 'https://google.com',
        );
        $Response = $this->email_model->sendmail_apartmentVoucher($data);
       
        return $Response;
    }
    public function get_mail_content_apartmentNonInstantVoucher($pnr_no) {
        $data['Booking'] = $Booking = $this->booking_model->getBooking($pnr_no)->row();
        $data['email_access'] = $this->email_model->get_email_acess()->row();
        $email_type = 'ApartmentNonInstantVoucher';
        $data['email_template'] = $this->email_model->get_email_template($email_type)->row();

        $data['email'] = $Booking->RES_GUEST_EMAIL;
        $data['host_data'] = $this->account_model->GetUserData($Booking->PROP_USER_TYPE, $Booking->PROP_USER_ID)->row();
        $data['Map'] = $this->getStaticMap($data['Booking']->PROP_LATITUDE, $data['Booking']->PROP_LONGITUDE);
        $data['social_url'] = array(
            'facebook_social_url' => 'https://www.facebook.com',
            'twitter_social_url' => 'https://twitter.com',
            'google_social_url' => 'https://google.com',
        );
        $Response = $this->email_model->sendmail_apartmentNonInstantVoucher($data);
        //return $Response;
    }

    public function get_mail_content_apartmentInvoice($pnr_no) {
        $data['Booking'] = $Booking = $this->booking_model->getBooking($pnr_no)->row();
        $data['email_access'] = $this->email_model->get_email_acess()->row();
        $email_type = 'ApartmentInvoice';
        $data['email_template'] = $this->email_model->get_email_template($email_type)->row();

        $data['host_data'] = $this->account_model->GetUserData($Booking->PROP_USER_TYPE, $Booking->PROP_USER_ID)->row();
        $data['social_url'] = array(
            'facebook_social_url' => 'https://www.facebook.com',
            'twitter_social_url' => 'https://twitter.com',
            'google_social_url' => 'https://google.com',
        );
        $Response = $this->email_model->sendmail_apartmentInvoice($data);
        return $Response;
    }

    public function get_mail_content_apartmentUserInvoice($pnr_no) {
        $data['Booking'] = $Booking = $this->booking_model->getBooking($pnr_no)->row();
        $data['Transaction'] = $this->booking_model->getBookingApartmentTransaction($pnr_no)->row();
        $data['email_access'] = $this->email_model->get_email_acess()->row();
        $email_type = 'ApartmentUserInvoice';
        $data['email_template'] = $this->email_model->get_email_template($email_type)->row();
        $data['email'] = $Booking->RES_GUEST_EMAIL;
        //$data['user_data'] = $this->account_model->GetUserData($Booking->PROP_USER_TYPE, $Booking->PROP_USER_ID)->row();
        $data['social_url'] = array(
            'facebook_social_url' => 'https://www.facebook.com',
            'twitter_social_url' => 'https://twitter.com',
            'google_social_url' => 'https://google.com',
        );
        $Response = $this->email_model->sendmail_apartmentUserInvoice($data);
        return $Response;
    }

    public function mail_voucher($pnr_no) {
        $Response = $this->get_mail_content_apartmentVoucher($pnr_no);
        echo json_encode($Response);
    }
	 public function mail_voucher_only($pnr_no) {
        $Response = $this->get_mail_content_apartmentVoucher_only($pnr_no);
        echo json_encode($Response);
    }
    public function umail_invoice($pnr_no) {
        $Response = $this->get_mail_content_apartmentUserInvoice($pnr_no);
        echo json_encode($Response);
    }

    public function confirm($pnr_no) {
        $count = $this->booking_model->getBooking($pnr_no)->num_rows();
        if ($count == 1) {
            $data['Booking'] = $this->booking_model->getBooking($pnr_no)->row();
            $data['Map'] = $this->getStaticMap($data['Booking']->PROP_LATITUDE, $data['Booking']->PROP_LONGITUDE);
            $data['host_profile_link'] = WEB_URL . '/users/show/' . $data['Booking']->user_type.'/'.$data['Booking']->user_id;
            $data['apt_link'] = WEB_URL . '/apartment/rooms/' . $data['Booking']->PROP_ID;
            $this->load->view('apartment/voucher', $data);
        } else {
              $this->load->view('errors/404');
        }
    }

    public function voucher($pnr_no) {
        $pnr_no = base64_decode(base64_decode($pnr_no));
        $count = $this->booking_model->getBookingPnr($pnr_no)->num_rows();
        if ($count == 1) {
            $b_data = $this->booking_model->getBookingPnr($pnr_no)->row();
            if ($b_data->module == 'APARTMENT') {
                $data['Booking'] = $booking = $this->booking_model->getBooking($pnr_no)->row();
				  if ($this->session->userdata('b2c_id')) {
               			 $c_user_type = 3;
              			  $c_user_id = $this->session->userdata('b2c_id');
					} else if ($this->session->userdata('b2b_id')) {
						 $c_user_type = 2;
                		$c_user_id = $this->session->userdata('b2b_id');
						
					} else {
						$c_user_type = "";
						$c_user_id = "";
					}

				if($c_user_id!='' && $c_user_type!='' && $data['Booking']->user_id == $c_user_id && $data['Booking']->user_type == $c_user_type)
				{
                $data['Map'] = $this->getStaticMap($data['Booking']->PROP_LATITUDE, $data['Booking']->PROP_LONGITUDE);
                $data['host_profile_link'] = WEB_URL . '/users/show/' . $data['Booking']->PROP_USER_TYPE.'/'.$data['Booking']->PROP_USER_ID;
                $data['apt_link'] = WEB_URL . '/apartment/rooms/' . $data['Booking']->PROP_ID;
                $data['user_data'] = $this->account_model->GetUserData($booking->PROP_USER_TYPE, $booking->PROP_USER_ID)->row();
                $data['global'] = $booking = $this->booking_model->getBookingPnr($pnr_no)->row();
				 $data['voucher_details'] =  $this->booking_model->getBookingvoucherinvoicedetails()->row();
              
                $this->load->view('apartment/voucher_view', $data);
				}
				else
				{
					$this->load->view('errors/404');
				}
            }
			else
				{
					$this->load->view('errors/404');
				}
        } else {
              $this->load->view('errors/404');
        }
    }

    public function invoice($pnr_no) {
        $pnr_no = base64_decode(base64_decode($pnr_no));
        $count = $this->booking_model->getBooking($pnr_no)->num_rows();
        if ($count == 1) {
            $data['Booking'] = $this->booking_model->getBooking($pnr_no)->row();
			 if ($this->session->userdata('b2c_id')) {
               			 $c_user_type = 3;
              			  $c_user_id = $this->session->userdata('b2c_id');
					} else if ($this->session->userdata('b2b_id')) {
						 $c_user_type = 2;
                		$c_user_id = $this->session->userdata('b2b_id');
						
					} else {
						$c_user_type = "";
						$c_user_id = "";
					}

				if($c_user_id!='' && $c_user_type!='' && $data['Booking']->PROP_USER_ID == $c_user_id && $data['Booking']->PROP_USER_TYPE == $c_user_type)
				{
            $data['Transaction'] = $this->booking_model->getBookingApartmentTransaction($pnr_no)->row();
            $data['Map'] = $this->getStaticMap($data['Booking']->PROP_LATITUDE, $data['Booking']->PROP_LONGITUDE);
            $data['host_profile_link'] = WEB_URL . '/users/show/' . $data['Booking']->user_type.'/'.$data['Booking']->user_id;
            $data['apt_link'] = WEB_URL . '/apartment/rooms/' . $data['Booking']->PROP_ID;
            $data['global'] = $booking = $this->booking_model->getBookingPnr($pnr_no)->row();
			 $data['voucher_details'] =  $this->booking_model->getBookingvoucherinvoicedetails()->row();
            $this->load->view('apartment/invoice_view', $data);
			 } else {
             $this->load->view('errors/404');
        }
        } else {
             $this->load->view('errors/404');
        }
    }

    public function uinvoice($pnr_no, $ajax_req=null) {
        $pnr_no = base64_decode(base64_decode($pnr_no));
        $count = $this->booking_model->getBooking($pnr_no)->num_rows();
        if ($count == 1) {
            $data['Booking'] = $this->booking_model->getBooking($pnr_no)->row();
			  if ($this->session->userdata('b2c_id')) {
               			 $c_user_type = 3;
              			  $c_user_id = $this->session->userdata('b2c_id');
					} else if ($this->session->userdata('b2b_id')) {
						 $c_user_type = 2;
                		$c_user_id = $this->session->userdata('b2b_id');
						
					} else {
						$c_user_type = "";
						$c_user_id = "";
					}

				if($c_user_id!='' && $c_user_type!='' && $data['Booking']->user_id == $c_user_id && $data['Booking']->user_type == $c_user_type)
				{
            $data['Transaction'] = $this->booking_model->getBookingApartmentTransaction($pnr_no)->row();
            //echo '<pre>';print_r( $data['Transaction']);die;
            $data['Map'] = $this->getStaticMap($data['Booking']->PROP_LATITUDE, $data['Booking']->PROP_LONGITUDE);
            $data['host_profile_link'] = WEB_URL . '/users/show/' . $data['Booking']->user_type.'/'.$data['Booking']->user_id;
            $data['apt_link'] = WEB_URL . '/apartment/rooms/' . $data['Booking']->PROP_ID;
            $data['global'] = $booking = $this->booking_model->getBookingPnr($pnr_no)->row();
			 $data['voucher_details'] =  $this->booking_model->getBookingvoucherinvoicedetails()->row();
            $this->load->view('apartment/user_invoice_view', $data);
			 } else {
             $this->load->view('errors/404');
        }
        } else {
             $this->load->view('errors/404');
        }
    }

    public function islogged_in() {
        if (!$this->session->userdata('b2c_id')) {
            redirect(WEB_URL . '/apartment/signup_login');
        }
        // }else if($this->session->userdata('b2c_id')){
        //     if($this->session->userdata('b2c_id')){
        //         $user_type = 3;
        //         $user_id = $this->session->userdata('b2c_id');
        //     }
        //     $b2c_data = $this->apartment_model->is_signup($user_id)->num_rows();
        //     if($b2c_data->password == ''){
        //         //redirect(WEB_URL.'/apt/signup_login');
        //     }
        // }
    }

    public function signup_login() {
        $data['msg'] = 'Please Sign up to book';
        $this->load->view('login', $data);
    }

    public function getStaticMap($lat, $long) {
        $locstring = '';
        $firstloc = 0;
        //$long = "77.5667";
        //$lat = "12.9667";

        if ($firstloc == 0) {
            $locstring = $locstring . $lat . ',' . $long . '&markers=icon:'.ASSETS.'images/marker_out.png%7C' . $lat . ',' . $long;
            $firstloc = 1;
        } else {
            $locstring = $locstring . '&markers=icon:http://travelapt.hs24.info/assets/images/marker_out.png%7C' . $lat . ',' . $long;
        }
        $url = "http://maps.googleapis.com/maps/api/staticmap?zoom=16&size=627x327&maptype=ROADMAP&" . urlencode("center") . "=" . $locstring . "&sensor=false";
        return $url;
    }

    public function responseTimeCalculation($getMessageResonseData) {
        if (!empty($getMessageResonseData)) {
            $msgHistoryCount = count($getMessageResonseData);
            $totalResponseTime = 0;
            foreach ($getMessageResonseData as $k) {
                $totalResponseTime = $totalResponseTime + $k->time_difference;
            }
            $avgTime = $totalResponseTime / $msgHistoryCount;
            $roundHour = round($avgTime, 1);
            return $roundHour;
        } else {
            return false;
        }
    }

    public function responseRateCalculation($user_id) {
        if ($user_id != "") {
            $getAllRepliedMail = $this->Message_Model->getAllRepliedMail($user_id); //get all replied mails
            $getAllReceivedMail = $this->Message_Model->getAllReceivedMail($user_id); //get all received mails

            $repliedMsgCount = $getAllRepliedMail->num_rows();     //get count of records
            $receivedMsgCount = $getAllReceivedMail->num_rows();   //get count of records

            if ($receivedMsgCount > 0) {
                $ratio = $repliedMsgCount / $receivedMsgCount; //get replied/received
                $responseRate = $ratio * 100;               //get the percentage
                return $responseRate;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}

/* End of file apartment.php */
/* Location: ./application/controllers/apartment.php */
