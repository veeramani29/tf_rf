<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cards extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Cards_Model');
        $this->load->model('Home_Model');
        $this->is_admin_logged_in();
    }

    private function is_admin_logged_in() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('login/index');
        }
    }
    
    function add_type(){
        if($_POST){
            $type_name = $this->input->post('type_name');
            if($type_name != ''){
                $this->Cards_Model->addCardType($type_name);
                redirect('cards/manage_type');
            } else {
                $this->load->view('cards/add_type');
            }
        } else {
            $this->load->view('cards/add_type');
        }
    }
    
    function manage_type(){
        $data['type_list'] = $this->Cards_Model->getAllCardTypes();
        $this->load->view('cards/manage_type',$data);
    }
    
    function edit_type($id){
        if($id != ''){
            if($_POST){
                $type_id = $this->input->post('type_id');
                $type_name = $this->input->post('type_name');
                $this->Cards_Model->updateCardTypeOnId($type_id,$type_name);
                redirect('cards/manage_type');
            } else {
                $data['type_id'] = $id;
                $data['type_details'] = $this->Cards_Model->getCardDetailsOnId($id);
                $this->load->view('cards/edit_type',$data);
            }
        } else {
            redirect('cards/manage_type');
        }
    }
    
    function delete_type($id){
        if($id != ''){
            $this->Cards_Model->deleteCardTypeOnId($id);
            redirect('cards/manage_type');
        } else {
            redirect('cards/manage_type');
        }
    }
    
    function add_card(){
        if($_POST){
            $card_type = $this->input->post('card_type');
            $card_count = $this->input->post('card_count');
            $exp_month = $this->input->post('exp_month');
            $exp_year = $this->input->post('exp_year');
            $this->Cards_Model->addCards($card_type,$card_count,$exp_month,$exp_year);
            redirect('cards/manage_card');
        } else {
            $data['type_list'] = $this->Cards_Model->getAllCardTypes();
            $this->load->view('cards/add_card',$data);
        }
    }
    
    function manage_card(){
        $data['not_printed'] = $this->Cards_Model->getNotPrintedCardList();
        $data['printed'] = $this->Cards_Model->getPrintedCardList();
        $this->load->view('cards/manage_card',$data);
    }
    
    function delete_card($id){
        if($id != ''){
            $this->Cards_Model->deleteCardOnId($id);
            redirect('cards/manage_card');
        } else {
            redirect('cards/manage_card');
        }
    }
    
    function export_cards(){
        die;
        ob_end_clean();
// I assume you already have your $result
        $result = $this->Cards_Model->getNotPrintedCardList();
        $num_fields = count($result);

// Fetch MySQL result headers
        $headers = array();
        $headers[] = "[Row]";
        for ($i = 0; $i < $num_fields; $i++) {
            $headers[] = strtoupper(mysql_field_name($result, $i));
        }

// Filename with current date
        $current_date = date("y/m/d");
        $filename = "MyFileName" . $current_date . ".csv";

// Open php output stream and write headers
        $fp = fopen('php://output', 'w');
        if ($fp && $result) {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename=' . $filename);
            header('Pragma: no-cache');
            header('Expires: 0');
            echo "Title of Your CSV File\n\n";
            // Write mysql headers to csv
            fputcsv($fp, $headers);
            $row_tally = 0;
            // Write mysql rows to csv
            while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                $row_tally = $row_tally + 1;
                echo $row_tally . ",";
                fputcsv($fp, array_values($row));
            }
            die;
        }
    }
    
}