<?php
$prod_conf =  [
	
 	'DB_ENGINE' => 'mysql',
	'DB_HOST' => 'localhost',
	'DB_NAME' => 'forum',
	'DB_USERNAME' => 'root',
	'DB_PASSWORD' => 'hisoka999'
				
];


$config = [
	'DB_CONF' => [
		'PRODUCTION' => $prod_conf
	],
	'PATHS' => [
		'BASE_URL' => '/sites/smf2/',
		'CONTROLLER' => 'controller'
	]
	
];