<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

$config =
	array(
		// set on "base_url" the relative url that point to HybridAuth Endpoint
		'base_url' => '/auth/endpoint',

		"providers" => array (
			// openid providers
			"OpenID" => array (
				"enabled" => true
			),

			"Yahoo" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "", "secret" => "" ),
			),

			"AOL"  => array (
				"enabled" => true
			),

			"Google" => array (
				"enabled" => true,
				//live /"keys"    => array ( "id" => "527652186444-pvbu4fl1qs5v1p659omrraua36b7pt1r.apps.googleusercontent.com", "secret" => "-nSFWaD0Qyb3WGbQV9ESZs6o" ),
				"keys"    => array ( "id" => "262270009046-2kmrbm9s8oucau22erc0u4r8s6ppd95q.apps.googleusercontent.com", "secret" => "L234LhQAe-ZQEcepdLhJiwLO" ),
			),

			"Facebook" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "938026536257954", "secret" => "ef954d8557745cf6359459a75c5ee22c" ),
				//live/"keys"    => array ( "id" => "1517429698501225", "secret" => "935308f3fa89373ecb7accd71c357249" ),
			),

			"Twitter" => array (
				"enabled" => true,
				"keys"    => array ( "key" => "eZTtr5FpjvslFYmQqh2Jmc6Qv", "secret" => "Jxh9FCU5YeqvHWcfxp8OQrHQgFIwPAKRXM1uHtgLXsF2j2tokX" )
				// live/"keys"    => array ( "key" => "KpjcbyKW9coz3yuoSoGV2GCi2", "secret" => "XIikOvzVX0EwFdVciIUaxMfMSAOWfuQmAlJdRF8K1meAlWwJ9p" )
			),

			// windows live
			"Live" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "", "secret" => "" )
			),

			"MySpace" => array (
				"enabled" => true,
				"keys"    => array ( "key" => "", "secret" => "" )
			),

			"LinkedIn" => array (
				"enabled" => true,
				"keys"    => array ( "key" => "", "secret" => "" )
			),

			"Foursquare" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "", "secret" => "" )
			),
		),

		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		"debug_mode" => (ENVIRONMENT == 'development'),

		"debug_file" => APPPATH.'/logs/hybridauth.log',
	);


/* End of file hybridauthlib.php */
/* Location: ./application/config/hybridauthlib.php */
