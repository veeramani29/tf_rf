<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Affiliate_Model extends CI_Model {

    public function __construct() {


        parent::__construct();
    }

    function updateAffiliateTemplate($id,$header,$footer)
    {
        $query = $this->db->query($sql = "select * from affiliate_template where affiliate_id='".$id."'");
        if($query->num_rows() > 0)
        {
            $this->db->query($sql = "update affiliate_template set header='".mysql_real_escape_string($header)."',footer='".mysql_real_escape_string($footer)."' where affiliate_id='".$id."'");
        }
        else
        {
            $this->db->query($sql = "insert into affiliate_template set  affiliate_id='".$id."',header='".mysql_real_escape_string($header)."',footer='".mysql_real_escape_string($footer)."'");
        }
    }
    
    function getSiteTemplateOnId($id)
    {
        $query = $this->db->query($sql = "select * from affiliate_template where affiliate_id='".$id."'");
        if($query->num_rows() > 0)
        {
            $res = $query->row();
        }
        else $res = '';
        
        return $res;
    }
	
}
