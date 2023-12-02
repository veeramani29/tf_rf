<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hotels_model extends CI_Model {

    public function __construct() {

        parent::__construct();
    }

    public function get_hotels() {

        $this->db->select('*');
        $this->db->from('hotels');
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

    public function create_hotels($data) {
        $this->db->insert('hotels', $data);
        $poll_id = $this->db->insert_id();
        return $poll_id;
    }

    function update_hotels($data, $id) {
        $res = $this->db->update('hotels', $data, array('id' => $id));
        return $res;
    }

    public function edit_hotels($id = NULL) {
        $query = $this->db->get_where('hotels', array('id =' => $id))->row();
        return $query;
    }

    public function delete_hotels($id) {

        $delete = $this->db->delete('hotels', array('id' => $id));
        return $delete;
    }

    function update_ads($data, $id) {
        $res = $this->db->update('hotels', $data, array('id' => $id));
        return $res;
    }

    function delete($ids) {
        $ids = $ids;
        $count = 0;
        foreach ($ids as $id) {
            $did = intval($id) . '<br>';
            $this->db->where('id', $did);
            $this->db->delete('hotels');
            $count = $count + 1;
        }

        echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
' . $count . ' Item deleted successfully
</div>';
        $count = 0;
    }

    public function get_hotel_country_list() {
        $this->db->select('country_name')
                ->from('roomsxml_city_list')
                ->group_by('country_name');

        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_hotel_city_list_all() {
        $this->db->select('region_name')
                ->from('roomsxml_city_list')
                ->group_by('region_name');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_hotel_city_list($val = NULL) {
        $this->db->select('region_name')
                ->from('roomsxml_city_list')
                ->where('country_name', $val)
                ->group_by('region_name');

        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }
    
    ############################################## Group Queries #######################################################################
    
    function addGroup($data)
    {
        $this->db->insert('hotelcrs_groups', $data);
        $poll_id = $this->db->insert_id();
        return $poll_id;
    }
    
    function editGroup($data)
    {
        $this->db->query($sql = "update hotelcrs_groups set group_name='".$data['group_name']."',type_name='".$data['type_name']."',meta_title='".$data['meta_title']."',meta_keyword='".$data['meta_keyword']."',meta_desc='".$data['meta_desc']."' where id='".$data['group_id']."'");
    }
    
    function deleteGroup($id){
        $this->db->query($sql = "delete from hotelcrs_groups where id='".$id."'");
    }
    
    function getAllGroups()
    {
        $query = $this->db->query($sql = "select * from hotelcrs_groups order by id desc");
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
        $query = $this->db->query($sql = "select * from hotelcrs_groups where id='".$id."'");
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
    
    ####################################### Category Queries ############################################################
    function getParentCategoryOnGroup($groupId){
        $query = $this->db->query($sql = "select id,category_name from hotelcrs_category where group_id='".$groupId."' and parent_category='0'");
        if($query->num_rows() > 0){
            $result = $query->result();
        }else{
            $result = '';
        }
        
        return $result;
    }
    
    function getCategoryListOnGroup($groupId){
        $query = $this->db->query($sql = "select id,category_name from hotelcrs_category where group_id='".$groupId."'");
        if($query->num_rows() > 0){
            $result = $query->result();
        }else{
            $result = '';
        }
        
        return $result;
    }
    
    function getTypeListOnGroup($groupId){
        $query = $this->db->query($sql = "select id,business_type from hotelcrs_type where group_id='".$groupId."'");
        if($query->num_rows() > 0){
            $result = $query->result();
        }else{
            $result = '';
        }
        
        return $result;
    }
    
    function addCategoryData($data){
        $this->db->query($sql = "insert into hotelcrs_category set category_name='".mysql_real_escape_string($data['category_name'])."',
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
        $this->db->query($sql = "update hotelcrs_category set category_name='".mysql_real_escape_string($data['category_name'])."',
                                                            category_title='".mysql_real_escape_string($data['category_name'])."',
                                                            group_id='".$data['group_id']."',  
                                                            parent_category='".$data['parent_category']."',
                                                            category_thumb='".$data['category_thumb']."',
                                                            content='".mysql_real_escape_string($data['content'])."' where id='".$data['cat_id']."'");
    }
    
    function deleteCategoryOnId($id){
        $this->db->query($sql = "delete from hotelcrs_category where id='".$id."'");
    }
    
    function getAllCategoryList(){
        $query = $this->db->query($sql = "select * from hotelcrs_category order by id desc");
        if($query->num_rows() > 0){
            $result = $query->result();
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    function getGroupNameOnID($id){
        $query = $this->db->query($sql = "select group_name from hotelcrs_groups where id='".$id."'");
        if($query->num_rows() > 0){
            $result = $query->row();
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    function getCategoryOnId($id){
        $query = $this->db->query($sql = "select * from hotelcrs_category where id='".$id."'");
        if($query->num_rows() > 0){
            $result = $query->row();
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    ################################# Price Plan Query #################################################################

    function getRoomTypesOnPricePlan(){
        $query = $this->db->query($sql = "select id,plan_name from hotelcrs_price_plan order by id asc");
        if($query->num_rows() > 0){
            $result = $query->result();
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    function getRoomTypesOnPricePlanId($id){
        $query = $this->db->query($sql = "select * from hotelcrs_room_type where price_plan_id='".$id."'");
        if($query->num_rows() > 0){
            $result = $query->result();
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    function addPricePlanData($data){
        $this->db->query($sql = "insert into hotelcrs_price_plan set hotel_id='".mysql_real_escape_string($data['hotel_id'])."',
                                                            room_type_id='".mysql_real_escape_string($data['room_type'])."',
                                                            min_stay_through='".mysql_real_escape_string($data['min_stay_through'])."',  
                                                            nights='".$data['nights']."',
                                                            price_per_night='".$data['price_per_night']."',
                                                            price_after_discount='".mysql_real_escape_string($data['price_after_discount'])."'");
    }
    
    function getAllPricePlan(){
         $query = $this->db->query($sql = "select * from hotelcrs_price_plan order by id desc");
        if($query->num_rows() > 0){
            $result = $query->result();
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    function deletePricePlanOnId($id){
        $this->db->query($sql = "delete from hotelcrs_price_plan where id='".$id."'");
    }
    
    function getPlanDetailsOnId($id){
        $query = $this->db->query($sql = "select * from hotelcrs_price_plan where id='".$id."'");
        if($query->num_rows() > 0){
            $result = $query->row();
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    function editPricePlanData($data){
        $this->db->query($sql = "update hotelcrs_price_plan set hotel_id='".mysql_real_escape_string($data['hotel_id'])."',
                                                            room_type_id='".mysql_real_escape_string($data['room_type'])."',
                                                            min_stay_through='".mysql_real_escape_string($data['min_stay_through'])."',  
                                                            nights='".$data['nights']."',
                                                            price_per_night='".$data['price_per_night']."',
                                                            price_after_discount='".mysql_real_escape_string($data['price_after_discount'])."' where id='".$data['plan_id']."'");
    }
    
    ################################ Room Type Query ####################################################################
    
    function getAllHotelsListOnlyName(){
        $query = $this->db->query($sql = "select id,hotel_name from hotelcrs_hotels order by id desc");
        if($query->num_rows() > 0){
            $result = $query->result();
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    function getAllPricePlans(){
        $query = $this->db->query($sql = "select id,hotel_id from hotelcrs_price_plan order by id desc");
        if($query->num_rows() > 0){
            $result = $query->result();
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    function addRoomTypeData($data){
        $this->db->query($sql = "insert into hotelcrs_room_type set hotel_id='".mysql_real_escape_string($data['hotel'])."',
                                                            room_type='".mysql_real_escape_string($data['room_type'])."',
                                                            max_adult='".$data['max_people']."',
                                                            max_child='".$data['max_child']."',
                                                            description='".mysql_real_escape_string($data['description'])."',
                                                            room_condition='".mysql_real_escape_string($data['room_condition'])."',room_image='".$data['room_image']."'");
    }
    
    function getAllRoomTypes(){
         $query = $this->db->query($sql = "select * from hotelcrs_room_type order by hotel_id desc");
        if($query->num_rows() > 0){
            $result = $query->result();
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    function getHotelNameOnId($id){
         $query = $this->db->query($sql = "select hotel_name from hotelcrs_hotels where id='".$id."'");
        if($query->num_rows() > 0){
            $res = $query->row();
            $result = $res->hotel_name;
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    function getRoomTypeOnId($id){
         $query = $this->db->query($sql = "select * from hotelcrs_room_type where id='".$id."'");
        if($query->num_rows() > 0){
            $result = $query->row();
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    function editRoomTypeData($data){
        $this->db->query($sql = "update hotelcrs_room_type set hotel_id='".mysql_real_escape_string($data['hotel'])."',
                                                            room_type='".mysql_real_escape_string($data['room_type'])."',
                                                            max_adult='".$data['max_people']."',
                                                            max_child='".$data['max_child']."',
                                                            description='".mysql_real_escape_string($data['description'])."',
                                                            room_condition='".mysql_real_escape_string($data['room_condition'])."',room_image='".$data['room_image']."' where id='".$data['room_id']."'");
    }
    
    function deleteRoomTypeOnId($id){
        $this->db->query($sql = "delete from hotelcrs_room_type where id='".$id."'");
    }
    
    function getRoomTypesOnHotelId($id){
        $query = $this->db->query($sql = "select * from hotelcrs_room_type where hotel_id='".$id."'");
        if($query->num_rows() > 0){
            $result = $query->result();
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    function addRoomData($data){
        $this->db->query($sql = "insert into hotelcrs_room set hotel_id='".mysql_real_escape_string($data['hotel'])."',
                                                            room_type='".mysql_real_escape_string($data['room_type'])."',
                                                            room_name='".mysql_real_escape_string($data['room_name'])."',
                                                            description='".mysql_real_escape_string($data['description'])."',
                                                            room_condition='".mysql_real_escape_string($data['room_condition'])."'");
    }
    
    function editRoom($data){
        $this->db->query($sql = "update hotelcrs_room set hotel_id='".mysql_real_escape_string($data['hotel_id'])."',
                                                            room_type='".mysql_real_escape_string($data['room_type'])."',
                                                            room_name='".mysql_real_escape_string($data['room_name'])."',
                                                            description='".mysql_real_escape_string($data['description'])."',
                                                            room_condition='".mysql_real_escape_string($data['room_condition'])."' where id='".$data['room_id']."'");
    }
    
    function getRoomDataOnId($id)
    {
        $query = $this->db->query($sql = "select * from hotelcrs_room where id='".$id."'");
        if($query->num_rows() > 0){
            $result = $query->row();
            
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    
    
    function getRoomTypeNameOnId($id){
        $query = $this->db->query($sql = "select room_type from hotelcrs_room_type where id='".$id."'");
        if($query->num_rows() > 0){
            $res = $query->row();
            $result = $res->room_type;
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    function getAllRooms(){
         $query = $this->db->query($sql = "select * from hotelcrs_room order by id desc");
        if($query->num_rows() > 0){
            $result = $query->result();
        } else {
            $result = '';
        }
        
        return $result;
    }
    
    function addType($data){
        $this->db->insert('hotelcrs_type', $data);
        $poll_id = $this->db->insert_id();
        return $poll_id;
    }
    
    function editType($data){
        $this->db->query($sql = "update hotelcrs_type set business_type='".$data['business_type']."' where id='".$data['type_id']."'");
    }
    
    function deleteTypeOnId($id){
        $this->db->query($sql = "delete from hotelcrs_type where id='".$id."'");
    }
    
    function getAllTourTypes(){
        $query = $this->db->query($sql = "select * from hotelcrs_type order by id asc");
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
    
    function getTypeOnId($id){
        $query = $this->db->query($sql = "select * from hotelcrs_type where id='".$id."'");
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
    
    function addHotelsData($data,$images,$imagesInt){
        $this->db->query($sql = "insert into hotelcrs_hotels set hotel_name='".mysql_real_escape_string($data['hotel_name'])."',
                                                                hotel_rating='".mysql_real_escape_string($data['hotel_rating'])."',
                                                                hotel_status='".$data['hotel_status']."',
                                                                group_id='".$data['group_id']."',
                                                                type_id='".$data['type_id']."',
                                                                room_type_id='".$data['room_type_id']."',
                                                                category='".mysql_real_escape_string($data['category'])."',
                                                                hotel_desc='".mysql_real_escape_string($data['hotel_desc'])."',
                                                                country='".mysql_real_escape_string($data['country'])."',
                                                                state='".mysql_real_escape_string($data['state'])."',
                                                                city='".mysql_real_escape_string($data['city'])."',
                                                                hotel_loc='".mysql_real_escape_string($data['hotel_loc'])."',
                                                                hotel_phone='".mysql_real_escape_string($data['hotel_phone'])."',
                                                                hotel_fax='".mysql_real_escape_string($data['hotel_fax'])."',
                                                                hotel_email='".mysql_real_escape_string($data['hotel_email'])."',
                                                                post_code='".mysql_real_escape_string($data['post_code'])."',
                                                                hotel_address='".mysql_real_escape_string($data['hotel_address'])."',
                                                                meta_title = '".mysql_real_escape_string($data['meta_title'])."',
                                                                meta_keyword='".mysql_real_escape_string($data['meta_keyword'])."',
                                                                meta_desc='".mysql_real_escape_string($data['meta_desc'])."',
                                                                google_map='".mysql_real_escape_string($data['google_map'])."',
                                                                hotel_policy='".mysql_real_escape_string($data['hotel_policy'])."',
                                                                cancel_policy='".mysql_real_escape_string($data['cancel_policy'])."',
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
                                                                exclusions='".mysql_real_escape_string($data['exclusions'])."',
                                                                date_added='".mysql_real_escape_string($data['date_added'])."'");
        $poll_id = $this->db->insert_id();
        
        if(!empty($images)){
            foreach($images as $image){
                $this->db->query($sql = "insert into hotelcrs_images set hotel_id='".$poll_id."',image_type='Ext',image='".$image."'");
            }
        }
        
        if(!empty($imagesInt)){
            foreach($imagesInt as $image){
                $this->db->query($sql = "insert into hotelcrs_images set hotel_id='".$poll_id."',image_type='Int',image='".$image."'");
            }
        }
        
    }
    
    function getAllHotels(){
        $query = $this->db->query($sql = "select * from hotelcrs_hotels order by id desc");
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
    
    function getCountryNameOnId($id){
        $query = $this->db->query($sql = "select name from countries where id='".$id."'");
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
    
    function getCityNameOnId($id){
        $query = $this->db->query($sql = "select name from cities where id='".$id."'");
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
    
    function getAllBusinessTypes(){
        $query = $this->db->query($sql = "select * from hotelcrs_type order by id asc");
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
    
    function getTypeNameOnId($id){
        $query = $this->db->query($sql = "select * from hotelcrs_type where id='".$id."'");
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
    
    function getAllRoomTypesOnHotelId($id){
        $query = $this->db->query($sql = "select * from hotelcrs_room_type where hotel_id='".$id."'");
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
    
    
}
