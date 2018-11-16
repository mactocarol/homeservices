<?php

$con = mysqli_connect("localhost","carolhhp_service","L-7HF&gG0(GV","carolhhp_services");
//$con = mysqli_connect("localhost","evyntsco_evynts","evynts@123","evyntsco_evynts");

//$base_url="http://localhost/vendor/";
$base_url="http://democarol.com/homeservices/";

$config =array(
		"base_url" => "http://democarol.com/homeservices/hybridauth/", 
		"providers" => array ( 

			"Google" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "144487482440-q7rjf93c2al3ddo48ah6st5c9oo87m6p.apps.googleusercontent.com", "secret" => "JL90zViob6RaHpFExkClZpGg" ), 
			),

			"Facebook" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "1881355838794429", "secret" => "3aa26a89671c15724dff1ddbff6d87ac" ), 
			)
//            "Facebook" => array ( 
//				"enabled" => true,
//				"keys"    => array ( "id" => "1871879703131479", "secret" => "07818056e7fa51c6369b542a4647ee9d" ), 
//			)

			/*"Twitter" => array ( 
				"enabled" => true,
				"keys"    => array ( "key" => "OHwg7DSy4UqKOssruHzFM1M5J", "secret" => "pYlHENr6DPp9VZ9hXuRhBzUu7dmklpcqHzuljNgwI2apKKC2gP" ) 
			),
			
			"LinkedIn" => array ( // 'key' is your twitter application consumer key
               "enabled" => true,
               "keys" => array ( "key" => "", "secret" => "" )
            ),*/
		),
		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		"debug_mode" => false,
		"debug_file" => "",
	);
