<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------|
| Author: Provab Technosoft Pvt Ltd.									   |
|--------------------------------------------------------------------------|
| Developer: Provab											   |
| Started Date: 2014-09-11T11:45:00										   |
| Ended Date:  										   					   |
|--------------------------------------------------------------------------|
*/

class Xml_Model extends CI_Model {
	
	public function insert_xml_log($xml_log){
		//$this->db->query('SET GLOBAL max_allowed_packet=33554432');
    	$this->db->insert('XML_logs', $xml_log);
    }
}

