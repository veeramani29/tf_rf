<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 0);
error_reporting(0);
session_start();

class Affiliate extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Home_Model');
    }
    
    public function register(){
        $data['country_list'] = $this->Home_Model->getAllCountryList();
        $this->load->view('affiliate/register',$data);
    }
    
    public function register_affiliate(){
        if($_POST){
            $data = $_POST;
            $add = $this->Home_Model->addNewAffiliateRequest($data);
            if($add != ''){
                $error = 0;
                $to = 'sales@redtagtravels.com';
                $subject = 'New Affiliate Request';
                $headers = "From: sales@redtagtravels.com\r\n";
                $headers .= "Reply-To: sales@redtagtravels.com\r\n";
                $headers .= "CC: pm.ajtravellabs@gmail.com\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $message = '<table>'
                        . '<tr>'
                        . '<td>'
                        . 'Redtag Team,<br/>'
                        . '</td>'
                        . '</tr>'
                        . '<tr>'
                        . '<td>'
                        . 'Below are the details of the Affiliate.'
                        . '</td>'
                        . '</tr>'
                        . '<tr>'
                        . '<tr>'
                        . '<td>'
                        . 'Company Name : '.$data['comp_name']
                        . '</td>'
                        . '</tr>'
                        . '<tr>'
                        . '<td>'
                        . 'Name : '.$data['fname'].' '.$data['lname']
                        . '</td>'
                        . '</tr>'
                        . '<tr>'
                        . '<td>'
                        . 'Email : '.$data['email_id']
                        . '</td>'
                        . '</tr>'
                        . '<tr>'
                        . '<td>'
                        . 'Phone No : '.$data['promo_code']
                        . '</td>'
                        . '</tr>'
                         . '<tr>'
                        . '<td>'
                        . 'Website : '.$data['site_url']
                        . '</td>'
                        . '</tr>'
                        . '</table>';
                mail($to, $subject, $message, $headers);
            } else {
                $error = '1';
            }
        } else {
            $error = '1';
        }
        
        echo json_encode(array('status'=>$error));
    }
    
    function getJsonAirport(){
        $query = $this->db->query($sql = "select * from airlines_list");
        if($query->num_rows() > 0){
            $data = $query->result();
            $json_data=array();
            
            foreach($data as $list){
                $json_array['airline_id'] = $list->airline_id;
                $json_array['airline_code'] = $list->airline_code;
                $json_array['airline_name'] = $list->airline_name;
                array_push($json_data,$json_array);
            }
            
            $jsonData = json_encode($json_data);
            file_put_contents($_SERVER['DOCUMENT_ROOT'].'/airline_list.json',$jsonData);
            echo 'done';
        }
    }
}
