<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class packages_model extends CI_Model {

    public function __construct() {

        parent::__construct();
    }

    public function get_packages() {

        $this->db->select('*');
        $this->db->from('packages');
        $this->db->order_by('id', 'DESC');
//$this->db->limit(5);
        $query = $this->db->get();
        return $query;
    }

    public function category($id = NULL) {
        $query = $this->db->get_where('category', array('id =' => $id))->row();
        return $query;
    }

    function categories() {

        $query = $this->db->get('category');
        return $query;
    }

    public function create_packages($data) {
        $this->db->insert('packages', $data);
        $poll_id = $this->db->insert_id();
        return $poll_id;
    }

    function update_packages($data, $id) {
        $res = $this->db->update('packages', $data, array('id' => $id));
        return $res;
    }

    public function edit_packages($id = NULL) {
        $query = $this->db->get_where('packages', array('id =' => $id))->row();
        return $query;
    }

    public function delete_packages($id) {

        $delete = $this->db->delete('packages', array('id' => $id));
        return $delete;
    }

    function update_ads($data, $id) {
        $res = $this->db->update('packages', $data, array('id' => $id));
        return $res;
    }

    function delete($ids) {
        $ids = $ids;
        $count = 0;
        foreach ($ids as $id) {
            $did = intval($id) . '<br>';
            $this->db->where('id', $did);
            $this->db->delete('packages');
            $count = $count + 1;
        }

        echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
' . $count . ' Item deleted successfully
</div>';
        $count = 0;
    }

    public function get_hotel_country_list() {
        $this->db->select('Country')
                ->from('hotelspro_city')
                ->group_by('Country');

        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_hotel_city_list_all() {
        $this->db->select('City')
                ->from('hotelspro_city')
                ->group_by('City');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_hotel_city_list($val = NULL) {
        $this->db->select('City')
                ->from('hotelspro_city')
                ->where('Country', $val)
                ->group_by('City');

        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }
###################################################################################################################################
    function addTourPackages($data,$images){
        $this->db->query($sql = "insert into tour_packages set tour_name='".mysql_real_escape_string($data['tour_name'])."',
                                                                tour_operator='".mysql_real_escape_string($data['tour_operator'])."',
                                                                group_id='".$data['group_id']."',
                                                                type_id='".$data['type_id']."',
                                                                category='".$data['category']."',
                                                                short_overview='".mysql_real_escape_string($data['short_overview'])."',
                                                                adult_price='".mysql_real_escape_string($data['adult_price'])."',
                                                                child_price='".mysql_real_escape_string($data['child_price'])."',
                                                                infant_price='".mysql_real_escape_string($data['infant_price'])."',
                                                                price_type='".mysql_real_escape_string($data['price_type'])."',
                                                                payment_desc='".mysql_real_escape_string($data['payment_desc'])."',
                                                                country='".mysql_real_escape_string($data['country'])."',
                                                                state='".mysql_real_escape_string($data['state'])."',
                                                                city='".mysql_real_escape_string($data['city'])."',
                                                                post_code='".mysql_real_escape_string($data['post_code'])."',
                                                                tour_duration='".mysql_real_escape_string($data['tour_duration'])."',
                                                                related_tour = '".$data['related_tours']."',
                                                                rating='".mysql_real_escape_string($data['rating'])."',
                                                                tour_code='".mysql_real_escape_string($data['tour_code'])."',
                                                                nights='".mysql_real_escape_string($data['nights'])."',
                                                                days='".mysql_real_escape_string($data['days'])."',
                                                                meta_title='".mysql_real_escape_string($data['meta_title'])."',
                                                                meta_keyword='".mysql_real_escape_string($data['meta_keyword'])."',
                                                                meta_desc='".mysql_real_escape_string($data['meta_desc'])."',
                                                                start_city='".mysql_real_escape_string($data['start_city'])."',
                                                                end_city='".mysql_real_escape_string($data['end_city'])."',
                                                                visiting_city='".mysql_real_escape_string($data['visiting_city'])."',
                                                                operating_on='".mysql_real_escape_string($data['operating_on'])."',
                                                                sightseeing='".mysql_real_escape_string($data['sightseeing'])."',
                                                                no_of_acomodates='".mysql_real_escape_string($data['no_of_acomodates'])."',
                                                                guide_tape='".mysql_real_escape_string($data['guide_tape'])."',
                                                                pickup_service='".mysql_real_escape_string($data['pickup_service'])."',
                                                                room_addon_facility='".mysql_real_escape_string($data['room_addon_facility'])."',
                                                                dropoff_service='".mysql_real_escape_string($data['dropoff_service'])."',
                                                                entertainments='".mysql_real_escape_string($data['entertainments'])."',
                                                                view_location_type='".mysql_real_escape_string($data['view_location_type'])."',
                                                                itinerary_title='".mysql_real_escape_string($data['itinerary_title'])."',
                                                                itenerary_detail='".mysql_real_escape_string($data['itenerary_detail'])."',
                                                                available_from_date='".mysql_real_escape_string($data['available_from_date'])."',
                                                                available_to_date='".mysql_real_escape_string($data['available_to_date'])."',
                                                                google_map='".mysql_real_escape_string($data['google_map'])."',
                                                                tour_highlights='".mysql_real_escape_string($data['tour_highlights'])."',
                                                                tour_policy='".mysql_real_escape_string($data['tour_policy'])."',
                                                                terms_condition='".mysql_real_escape_string($data['terms_condition'])."',
                                                                send_confirmation_email_user='".mysql_real_escape_string($data['send_confirmation_email_user'])."',
                                                                conf_email_id_user='".mysql_real_escape_string($data['conf_email_id_user'])."',
                                                                send_conf_email_user_pay_invoice='".mysql_real_escape_string($data['send_conf_email_user_pay_invoice'])."',
                                                                conf_invoice_pay_email_id='".mysql_real_escape_string($data['conf_invoice_pay_email_id'])."',
                                                                send_confirmation_email_cancel_order='".mysql_real_escape_string($data['send_confirmation_email_cancel_order'])."',
                                                                conf_cancel_order_email_id='".mysql_real_escape_string($data['conf_cancel_order_email_id'])."',
                                                                email_id_payment_info='".mysql_real_escape_string($data['email_id_payment_info'])."',
                                                                item_desc='".mysql_real_escape_string($data['item_desc'])."',
                                                                inclusions='".mysql_real_escape_string($data['inclusions'])."',
                                                                exclusions='".mysql_real_escape_string($data['exclusions'])."',date_added='".$data['date_added']."'");
        $poll_id = $this->db->insert_id();
        
        if(!empty($images)){
            foreach($images as $image){
                $this->db->query($sql = "insert into tour_images set tour_id='".$poll_id."',images='".$image."'");
            }
        }
        
    }
    
    function editTourPackages($data,$images){
        $this->db->query($sql = "update tour_packages set tour_name='".mysql_real_escape_string($data['tour_name'])."',
                                                                tour_operator='".mysql_real_escape_string($data['tour_operator'])."',
                                                                group_id='".$data['group_id']."',
                                                                type_id='".$data['type_id']."',
                                                                category='".$data['category']."',
                                                                short_overview='".mysql_real_escape_string($data['short_overview'])."',
                                                                adult_price='".mysql_real_escape_string($data['adult_price'])."',
                                                                child_price='".mysql_real_escape_string($data['child_price'])."',
                                                                infant_price='".mysql_real_escape_string($data['infant_price'])."',
                                                                price_type='".mysql_real_escape_string($data['price_type'])."',
                                                                payment_desc='".mysql_real_escape_string($data['payment_desc'])."',
                                                                country='".mysql_real_escape_string($data['country'])."',
                                                                state='".mysql_real_escape_string($data['state'])."',
                                                                city='".mysql_real_escape_string($data['city'])."',
                                                                post_code='".mysql_real_escape_string($data['post_code'])."',
                                                                tour_duration='".mysql_real_escape_string($data['tour_duration'])."',
                                                                related_tour = '".$data['related_tours']."',
                                                                rating='".mysql_real_escape_string($data['rating'])."',
                                                                tour_code='".mysql_real_escape_string($data['tour_code'])."',
                                                                nights='".mysql_real_escape_string($data['nights'])."',
                                                                days='".mysql_real_escape_string($data['days'])."',
                                                                meta_title='".mysql_real_escape_string($data['meta_title'])."',
                                                                meta_keyword='".mysql_real_escape_string($data['meta_keyword'])."',
                                                                meta_desc='".mysql_real_escape_string($data['meta_desc'])."',
                                                                start_city='".mysql_real_escape_string($data['start_city'])."',
                                                                end_city='".mysql_real_escape_string($data['end_city'])."',
                                                                visiting_city='".mysql_real_escape_string($data['visiting_city'])."',
                                                                operating_on='".mysql_real_escape_string($data['operating_on'])."',
                                                                sightseeing='".mysql_real_escape_string($data['sightseeing'])."',
                                                                no_of_acomodates='".mysql_real_escape_string($data['no_of_acomodates'])."',
                                                                guide_tape='".mysql_real_escape_string($data['guide_tape'])."',
                                                                pickup_service='".mysql_real_escape_string($data['pickup_service'])."',
                                                                room_addon_facility='".mysql_real_escape_string($data['room_addon_facility'])."',
                                                                dropoff_service='".mysql_real_escape_string($data['dropoff_service'])."',
                                                                entertainments='".mysql_real_escape_string($data['entertainments'])."',
                                                                view_location_type='".mysql_real_escape_string($data['view_location_type'])."',
                                                                itinerary_title='".mysql_real_escape_string($data['itinerary_title'])."',
                                                                itenerary_detail='".mysql_real_escape_string($data['itenerary_detail'])."',
                                                                available_from_date='".mysql_real_escape_string($data['available_from_date'])."',
                                                                available_to_date='".mysql_real_escape_string($data['available_to_date'])."',
                                                                google_map='".mysql_real_escape_string($data['google_map'])."',
                                                                tour_highlights='".mysql_real_escape_string($data['tour_highlights'])."',
                                                                tour_policy='".mysql_real_escape_string($data['tour_policy'])."',
                                                                terms_condition='".mysql_real_escape_string($data['terms_condition'])."',
                                                                send_confirmation_email_user='".mysql_real_escape_string($data['send_confirmation_email_user'])."',
                                                                conf_email_id_user='".mysql_real_escape_string($data['conf_email_id_user'])."',
                                                                send_conf_email_user_pay_invoice='".mysql_real_escape_string($data['send_conf_email_user_pay_invoice'])."',
                                                                conf_invoice_pay_email_id='".mysql_real_escape_string($data['conf_invoice_pay_email_id'])."',
                                                                send_confirmation_email_cancel_order='".mysql_real_escape_string($data['send_confirmation_email_cancel_order'])."',
                                                                conf_cancel_order_email_id='".mysql_real_escape_string($data['conf_cancel_order_email_id'])."',
                                                                email_id_payment_info='".mysql_real_escape_string($data['email_id_payment_info'])."',
                                                                item_desc='".mysql_real_escape_string($data['item_desc'])."',
                                                                inclusions='".mysql_real_escape_string($data['inclusions'])."',
                                                                exclusions='".mysql_real_escape_string($data['exclusions'])."' where id='".$data['tour_id']."'");
        
        
        
        if(!empty($images)){
            
            $this->db->query($sql = "delete from tour_images where tour_id='".$data['tour_id']."'");
            foreach($images as $image){
                $this->db->query($sql = "insert into tour_images set tour_id='".$data['tour_id']."',images='".$image."'");
            }
        }
        
    }
    
    function getAllTours(){
        $query = $this->db->query($sql = "select id,category,tour_name,date_added from tour_packages order by id desc");
        if($query->num_rows()> 0)
        {
            $result = $query->result();
        }
        else
        {
            $result = '';
        }
        return $result;
    }
    
    function getCategoryNameOnId($id){
        $query = $this->db->query($sql = "select category_name from tour_category where id='".$id."'");
        if($query->num_rows()> 0)
        {
            $result = $query->row();
            $res = $result->category_name;
        }
        else
        {
            $res = '';
        }
        return $res;
    }
    
    function addGroup($data)
    {
        $this->db->insert('tour_groups', $data);
        $poll_id = $this->db->insert_id();
        return $poll_id;
    }
    
    function editGroup($data)
    {
        $this->db->query($sql = "update tour_groups set group_name='".$data['group_name']."' where id='".$data['admin_id']."'");
    }
    
    function deleteGroup($id){
        $this->db->query($sql = "delete from tour_groups where id='".$id."'");
    }
    
    function addType($data){
        $this->db->insert('tour_type', $data);
        $poll_id = $this->db->insert_id();
        return $poll_id;
    }
    
    function editType($data){
        $this->db->query($sql = "update tour_type set group_id='".$data['group_id']."',business_type='".$data['business_type']."' where id='".$data['type_id']."'");
    }
    
    function deleteTypeOnId($id){
        $this->db->query($sql = "delete from tour_type where id='".$id."'");
    }
    
    function getAllTourTypes(){
        $query = $this->db->query($sql = "select * from tour_type order by id desc");
        if($query->num_rows()> 0)
        {
            $result = $query->result();
        }
        else
        {
            $result = '';
        }
        return $result;
    }
    
    function getAllGroups()
    {
        $query = $this->db->query($sql = "select * from tour_groups order by id desc");
        if($query->num_rows()> 0)
        {
            $result = $query->result();
        }
        else
        {
            $result = '';
        }
        return $result;
    }
    
    function getGroupById($id)
    {
        $query = $this->db->query($sql = "select * from tour_groups where id='".$id."'");
        if($query->num_rows()> 0)
        {
            $result = $query->row();
        }
        else
        {
            $result = '';
        }
        return $result;
    }
    
    function getParentCategoryOnGroup($groupId){
        $query = $this->db->query($sql = "select id,category_name from tour_category where group_id='".$groupId."' and parent_category='0'");
        if($query->num_rows() > 0){
            $result = $query->result();
        }else{
            $result = '';
        }
        
        return $result;
    }
    
    function getCategoryListOnGroup($groupId){
        $query = $this->db->query($sql = "select id,category_name from tour_category where group_id='".$groupId."'");
        if($query->num_rows() > 0){
            $result = $query->result();
        }else{
            $result = '';
        }
        
        return $result;
    }
    
    function getTypeListOnGroup($groupId){
        $query = $this->db->query($sql = "select id,business_type from tour_type where group_id='".$groupId."'");
        if($query->num_rows() > 0){
            $result = $query->result();
        }else{
            $result = '';
        }
        
        return $result;
    }
    
    function addCategoryData($data){
        $this->db->query($sql = "insert into tour_category set category_name='".mysql_real_escape_string($data['category_name'])."',
                                                                category_title='".mysql_real_escape_string($data['category_name'])."',
                                                                group_id='".$data['group_id']."',
                                                                parent_category='".$data['parent_category']."',
                                                                category_thumb='".$data['category_thumb']."',
                                                                content='".mysql_real_escape_string($data['content'])."',added_on='".date('Y-m-d')."',
                                                                meta_title='".mysql_real_escape_string($data['meta_title'])."',
                                                                meta_keyword='".mysql_real_escape_string($data['meta_keyword'])."',
                                                                meta_desc='".mysql_real_escape_string($data['meta_desc'])."'");
    }
    
    function editCategoryData($data){
        $this->db->query($sql = "update tour_category set category_name='".mysql_real_escape_string($data['category_name'])."',
                                                            category_title='".mysql_real_escape_string($data['category_name'])."',
                                                            group_id='".$data['group_id']."',  
                                                            parent_category='".$data['parent_category']."',
                                                            category_thumb='".$data['category_thumb']."',
                                                            content='".mysql_real_escape_string($data['content'])."' where id='".$data['cat_id']."'");
    }
    
    function deleteCategoryOnId($id){
        $this->db->query($sql = "delete from tour_category where id='".$id."'");
    }
    
    function getAllCategoryList(){
        $query = $this->db->query($sql = "select * from tour_category order by id desc");
        if($query->num_rows() > 0){
            $result = $query->result();
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    function getGroupNameOnID($id){
        $query = $this->db->query($sql = "select group_name from tour_groups where id='".$id."'");
        if($query->num_rows() > 0){
            $result = $query->row();
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    function getCategoryOnId($id){
        $query = $this->db->query($sql = "select * from tour_category where id='".$id."'");
        if($query->num_rows() > 0){
            $result = $query->row();
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    function getTypeOnId($id){
        $query = $this->db->query($sql = "select * from tour_type where id='".$id."'");
        if($query->num_rows() > 0){
            $result = $query->row();
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    function getAllCountryList(){
        $query = $this->db->query($sql = "select * from countries order by name asc");
        if($query->num_rows() > 0){
            $result = $query->result();
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    function getStateListOnCountry($country){
        $query = $this->db->query($sql = "select * from states where country_id='".$country."'");
        if($query->num_rows() > 0){
            $result = $query->result();
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    function getCityListOnState($state){
        $query = $this->db->query($sql = "select * from cities where state_id='".$state."'");
        if($query->num_rows() > 0){
            $result = $query->result();
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    function getAllToursListName(){
        $query = $this->db->query($sql = "select id,tour_name from tour_packages order by tour_name asc");
        if($query->num_rows() > 0){
            $result = $query->result();
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    function getTourDetailsOnId($id){
        $query = $this->db->query($sql = "select * from tour_packages where id='".$id."'");
        if($query->num_rows() > 0){
            $result = $query->row();
        } else {
            $result = '';
        }
        
        return $result;
    }
        
    

}
