<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class General_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

function login($username,$password)
{
	$sql = $this->db->query('SELECT * FROM  admin_login where username="'.$username.'" and password="'.md5($password).'"');
	return $sql->result_array();
	/* you simply return the results as an object
	 * also note you can use the ActiveRecord class for this...might make it easier
	 */
	
}
function line_upload($image)
{
	
	$sql = "INSERT INTO cruise_line_image (image_name,dateadded) VALUES ('$image',NOW())";	
	$sql1 = $this->db->query($sql);
	return $sql1;
	/* you simply return the results as an object
	 * also note you can use the ActiveRecord class for this...might make it easier
	 */
	
}
function banner_upload($image,$name)
{
	
	 $sql = 'UPDATE `cruise_banner_image` SET image_name = "'.$image.'" ,url_link = "'.$name.'", dateadded = NOW() WHERE banner_image = 1';
	
	$sql1 = $this->db->query($sql);
	return $sql1;
	/* you simply return the results as an object
	 * also note you can use the ActiveRecord class for this...might make it easier
	 */
	
}
function image_line()
{
	$sql = $this->db->query('SELECT * FROM  cruise_line_image');
	return $sql->result_array();
	/* you simply return the results as an object
	 * also note you can use the ActiveRecord class for this...might make it easier
	 */
	
}
function image_banner()
{
	$sql = $this->db->query('SELECT * FROM  cruise_banner_image');
	return $sql->result_array();
	/* you simply return the results as an object
	 * also note you can use the ActiveRecord class for this...might make it easier
	 */
	
}
function line_text()
{
	$sql = $this->db->query('SELECT * FROM  cruise_line_text');
	return $sql->result_array();
	/* you simply return the results as an object
	 * also note you can use the ActiveRecord class for this...might make it easier
	 */
	
}
function linefull_text()
{
	$sql = $this->db->query('SELECT * FROM  cruise_ship_extra');
	return $sql->result_array();
	/* you simply return the results as an object
	 * also note you can use the ActiveRecord class for this...might make it easier
	 */
	
}
function image_update($id,$i)
{
	$sql = $this->db->query('UPDATE `cruise_line_image` SET `status` = "'.$id.'" WHERE `cruise_line_image`.`line_image` = "'.$i.'"');

	/* you simply return the results as an object
	 * also note you can use the ActiveRecord class for this...might make it easier
	 */
	
}
function image_delete($id)
{
	$sql = $this->db->query('DELETE FROM cruise_line_image
WHERE line_image="'.$id.'"');

	/* you simply return the results as an object
	 * also note you can use the ActiveRecord class for this...might make it easier
	 */
	
}
function line_text_up($id)
{
	$sql = $this->db->query("UPDATE `cruise_line_text` SET `text` = ".$this->db->escape($id)." WHERE `cruise_line_text`.`t_id` = 1");

	/* you simply return the results as an object
	 * also note you can use the ActiveRecord class for this...might make it easier
	 */
	
}
function line_linetext_up($id,$text)
{
	$sql = $this->db->query("UPDATE cruise_ship_extra SET data_text = ".$this->db->escape($text)." WHERE cse = '$id'");

	/* you simply return the results as an object
	 * also note you can use the ActiveRecord class for this...might make it easier
	 */
	
}
}
