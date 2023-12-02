<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');





class Cards_Model extends CI_Model {
    public function __construct()
    {	
        parent::__construct();
    }
    
    function addCardType($name){
       $this->db->query($sql = "insert into cards_type set name='".mysql_real_escape_string($name)."'");
    }
    
    function getCardDetailsOnId($id){
        $query = $this->db->query($sql = "select * from cards_type where id='".$id."'");
        if($query->num_rows() > 0){
            $data = $query->row();
            return $data;
        } else {
            return '';
        }
    }
    
    function updateCardTypeOnId($id,$type_name){
        $this->db->query($sql = "update cards_type set name='".mysql_real_escape_string($type_name)."' where id='".$id."'");
    }
    
    function getAllCardTypes(){
        $query = $this->db->query($sql = "select * from cards_type order by id desc");
        if($query->num_rows() > 0){
            $data = $query->result();
            return $data;
        } else {
            return '';
        }
    }

    function deleteCardTypeOnId($id){
        $this->db->query($sql = "delete from cards_type where id='".$id."'");
    }
    
    function addCards($card_type,$card_count,$exp_month,$exp_year){
        //echo date('Ymdmis');die;
        $cardsList = array();
        for($i = 0;$i<$card_count;$i++){
            $cardsList[] = $card_type.date('Ymdmis').$i;
        }
        //echo '<pre />';print_r($cardsList);die;
        $this->db->query($sql = "update cards_list set print_status='Printed' where card_type='".$card_type."'");
        
        foreach($cardsList as $card){
            $pin = mt_rand(1000,9999);
            $this->db->query($sql = "insert into cards_list set card_type='".$card_type."',card_number='".$card."',exp_month='".$exp_month."',exp_year='".$exp_year."',pin='".$pin."',print_status='Not Printed',status='Active',user_status='Deactive'");
        }
    }
    
    function getNotPrintedCardList(){
        $query = $this->db->query($sql = "select * from cards_list where print_status='Not Printed' and user_status='Deactive' order by id desc");
        if($query->num_rows() > 0){
            $data = $query->result();
            return $data;
        } else {
            return '';
        }
    }
    
    function getPrintedCardList(){
        $query = $this->db->query($sql = "select * from cards_list where print_status='Printed' and user_status='Deactive' order by id desc");
        if($query->num_rows() > 0){
            $data = $query->result();
            return $data;
        } else {
            return '';
        }
    }
    
    function getTypeNameOnId($id){
        $query = $this->db->query($sql = "select name from cards_type where id='".$id."'");
        if($query->num_rows() > 0){
            $data = $query->row();
            return $data;
        } else {
            return '';
        }
    }
    
    function deleteCardOnId($id){
        $this->db->query($sql = "delete from cards_list where id='".$id."'");
    }
    
    
}




