<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$hook['post_controller_constructor'][] = array(
	'class'    => 'Currency',
	'function' => 'initializeData',
	'filename' => 'currency.php',
	'filepath' => 'hooks',
	'params'   => array()
);

$hook['post_controller_constructor'][] = array(
	'class'    => 'LanguageLoader',
	'function' => 'initialize',
	'filename' => 'LanguageLoader.php',
	'filepath' => 'hooks',
	'params'   => array()
);


