<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	private static $instance;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');

		$this->load->initialize();
		
		log_message('debug', "Controller Class Initialized");
	}

	public static function &get_instance()
	{
		return self::$instance;
	}
	
	public function check_modules($controller){
		$this->load->model('Privilege_Model');
		$sub_admin = $this->session->userdata('admin_id');
	  	$modules = $this->Privilege_Model->get_modules_by_sub_admin_id($sub_admin)->result();
	  	//echo $controller;
	  	//echo '<pre>';print_r($modules);
	  	$mod = array('');
	  	foreach ($modules as $value) {
	  		$mod[] = $value->controller;
	  	}
	  	if (!in_array($controller, $mod)) {
	  		redirect('login/logout');
	  	}
	}

	public function validate_modules($controller){
		if($this->session->userdata('b2b_id')){
			$this->load->model('Privilege_Model');
			$b2b_id = $this->session->userdata('b2b_id');
		  	$modules = $this->Privilege_Model->get_modules_by_b2b_id($b2b_id)->result();
		  	//echo $controller;
//		  	echo '<pre>';print_r($modules);die;
		  	$mod = array();
		  	foreach ($modules as $value) {
		  		$mod[] = $value->controller;
		  	}
		  	if (!in_array($controller, $mod)) {
		  		redirect('error/page_missing');
		  	}
	  	}
	}

	public function pre_url(){
		$current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
        $current_url = $this->config->site_url().$this->uri->uri_string(). $current_url;
        $url =  array(
            'continue' => $current_url,
        );
        $this->session->set_userdata($url);
	}

}
// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */
