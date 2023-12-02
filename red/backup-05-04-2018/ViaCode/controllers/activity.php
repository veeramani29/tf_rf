<?php

defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 0);
error_reporting(E_ALL);
session_start();
####################################
#   API Id - 1 => Tacenter
####################################

class Activity extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Home_Model');
        $this->load->model('Activity_Model');
    }

    public function search() {
        ####################################
        #   API Id - 1 => Tacenter
        ####################################
        $_SESSION[session_id()]['actsearchData'] = '';
        $_SESSION[session_id()]['admin_markup'] = '';
        $_SESSION[session_id()]['agent_markup'] = '';
        $_SESSION['system_currency'] = 'PHP';
        $get = filter_input_array(INPUT_GET);
        $data['searchData'] = $this->searchActivityParams($get);
        if($data['searchData']['city_name'] != '' && $data['searchData']['country_name'] != '' && $data['searchData']['city_code'] != '' && $data['searchData']['country_code'] != ''){
            $_SESSION[session_id()]['actsearchData'] = $data['searchData'];
            $data['api_array'] = array('1');
            $this->load->view('activity/search', $data);
        } else {
            redirect('home');
        }
    }
    
    public function searchActivityParams($data){
        if (strpos($data['act_city'], ',') !== false) {
                $fromArr = explode(',', $data['act_city']);
                $cityName = trim($fromArr[0]);
                $countryName = trim($fromArr[1]);
                $CityCountryCode = $this->Activity_Model->getCityCountryCode($cityName,$countryName);
                if($CityCountryCode != ''){
                    $cityCode = $CityCountryCode->city_code;
                    $countryCode = $CityCountryCode->country_code;
                } else {
                    $cityCode = '';
                    $countryCode = '';
                }
            } else {
                $cityName = '';
                $countryName = '';
                $cityCode = '';
                $countryCode = '';
            }
            
            $searchArr = array('city_name'=>$cityName,'country_name'=>$countryName,'city_code'=>$cityCode,'country_code'=>$countryCode);
            return $searchArr;
    }
    
    public function getActivitySearchData(){
        $data['searchParms'] = $_SESSION[session_id()]['actsearchData'];
        $data['activities'] = $this->Activity_Model->getAllActivityOnSearch($data['searchParms']);
        $serchView = $this->load->view('activity/activity_result',$data,true);
        echo json_encode(
                array(
                    'activity_search_result' => $serchView
                )
        );
    }
    
    public function showInclusionAndCancelation($id){
        $data['details'] = $this->Activity_Model->getInclusionAndCancel($id);
        $view = $this->load->view('activity/inclusion_popup',$data,true);
        echo json_encode(array('view'=>$view));
    }
    
    public function details($id){
        if($id != ''){
            $data['details'] = $this->Activity_Model->getActivityDetailsOnId($id);
            if($data['details'] != ''){
                $activityId = $data['details']->ActivityID;
                $data['details'] = $this->Activity_Model->getActivityDetailsOnId($id);
                $data['tourList'] = $this->Activity_Model->getTourDetailsOnActivityId($activityId);
                $this->load->view('activity/details',$data);
            } else {
                redirect('home');
            }
        }
    }
    
    public function getPriceOfActivity(){
        if($_POST){
            $id = $_POST['act_id'];
            $date = $_POST['act_date'];
            $adult = $_POST['act_adult'];
            $child = $_POST['act_child'];
            $tourList = $_POST['tour_list'];
            if(isset($_POST['act_child_age']) && $_POST['act_child_age'] != ''){
                $childAge = $_POST['act_child_age'];
            } else {
                $childAge = '';
            }
            $data['tourIds'] = $this->Activity_Model->getTourIdOnActivityId($id);
            $data['details'] = $this->Activity_Model->getActivityDetailsOnActId($id);
            $price = $this->Activity_Model->getActivityPrice($id,$data,$date,$adult,$child,$childAge);
            $_SESSION[session_id()]['act_price_data'] = $price;
            echo json_encode(array('price'=>$price['price'],'currency'=>$price['currency'],'error'=>$price['error']));
        }
    }
    
    function pre_booking(){
        if($_POST){
            $data['id'] = $_POST['act_id'];
            $data['date'] = $_POST['act_date'];
            $data['adult'] = $_POST['act_adult'];
            $data['child'] = $_POST['act_child'];
            $data['tourList'] = $_POST['tour_list'];
            if(isset($_POST['act_child_age']) && $_POST['act_child_age'] != ''){
                $data['childAge'] = $_POST['act_child_age'];
            } else {
                $data['childAge'] = '';
            }
            $data['pickupPoints'] = $this->Activity_Model->getPickUpDropOffPoints($data['id']);
            $this->load->view('activity/pre_booking',$data);
        }
    }
    
    function booking_process(){
       // echo $_SESSION['res'];die;
        if($_POST){
            $data['id'] = $_POST['act_id'];
            $data['date'] = $_POST['act_date'];
            $data['adult'] = $_POST['act_adult'];
            $data['child'] = $_POST['act_child'];
            $data['tourList'] = $_POST['tour_list'];
            if(isset($_POST['act_child_age']) && $_POST['act_child_age'] != ''){
                $data['childAge'] = $_POST['act_child_age'];
            } else {
                $data['childAge'] = '';
            }
            
            $data['post_data'] = $_POST;
            
            $data['price_data'] = $_SESSION[session_id()]['act_price_data'];
            $data['tourIds'] = $this->Activity_Model->getTourIdOnActivityId($data['id']);
            $data['details'] = $this->Activity_Model->getActivityDetailsOnActId($data['id']);
            $booking = $this->Activity_Model->getFinalBooking($data);
        }
    }
    
}