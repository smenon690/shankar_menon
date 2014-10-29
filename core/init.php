<?php

session_start();
$GLOBALS['config'] = array(
	'mysql'	=> array(
		'host' 		=> '127.0.0.1',
		'user_name'	=>	'root',
		'password'	=>	'',
		'db'		=>	'shankar_test'
	),
	'remember'	=>	array(
		'cookie_name'	=>	'hash',
		'cookie_expiry'	=>	'604800'
	),
	'session'	=>	array(
		'session_name'	=>	'users',
		'token_name'	=>	'csrf_token'
	)
);

function __autoload($class) {
	require_once 'classes/' . $class . '.php';
}